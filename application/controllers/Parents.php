<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	/*  
		*  @author     : Searchnative India
		*  date        : 02 Nov, 2015
		*  Smart School system
		*  http://searchnative.in
		*  hello@searchnative.in
	*/
	
	class Parents extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
			error_reporting(0);
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');
			$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		}
		
		/***default functin, redirects to login page if no admin logged in yet***/
		public function index()
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
			if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
		}
		
		/***ADMIN DASHBOARD***/
		function dashboard()
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			$page_data['page_name']  = 'dashboard';
			$page_data['page_title'] = get_phrase('parent_dashboard');
			$this->load->view('backend/index', $page_data);
		}
		
		
		/****MANAGE TEACHERS*****/
		function teacher_list($param1 = '', $param2 = '', $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			if ($param1 == 'personal_profile') {
				$page_data['personal_profile']   = true;
				$page_data['current_teacher_id'] = $param2;
			}
			$page_data['teachers']   = $this->db->get('teacher')->result_array();
			$page_data['page_name']  = 'teacher';
			$page_data['page_title'] = 'Teacher';
			$this->load->view('backend/index', $page_data);
		}
		
		
		/***********************************************************************************************************/
		
		
		
		/****MANAGE SUBJECTS*****/
		function subject($param1 = '', $param2 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			$parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
			))->row();
			$parent_class_id        = $parent_profile->class_id;
			$page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $parent_class_id
			))->result_array();
			$page_data['page_name']  = 'subject';
			$page_data['page_title'] = get_phrase('manage_subject');
			$this->load->view('backend/index', $page_data);
		}
		
		/******MANAGE BILLING / INVOICES WITH STATUS*****/
		function invoice($student_id = '' , $param1 = '', $param2 = '', $param3 = '')
		{
			//if($this->session->userdata('parent_login')!=1)redirect(base_url() , 'refresh');
			if ($param1 == 'make_payment') {
				$invoice_id      = $this->input->post('invoice_id');
				$system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
				))->row();
				$invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
				))->row();
				
				/****TRANSFERRING USER TO PAYPAL TERMINAL****/
				$this->paypal->add_field('rm', 2);
				$this->paypal->add_field('no_note', 0);
				$this->paypal->add_field('item_name', $invoice_details->title);
				$this->paypal->add_field('amount', $invoice_details->amount);
				$this->paypal->add_field('custom', $invoice_details->invoice_id);
				$this->paypal->add_field('business', $system_settings->description);
				$this->paypal->add_field('notify_url', base_url() . 'index.php?parents/invoice/paypal_ipn');
				$this->paypal->add_field('cancel_return', base_url() . 'index.php?parents/invoice/paypal_cancel');
				$this->paypal->add_field('return', base_url() . 'index.php?parents/invoice/paypal_success');
				
				$this->paypal->submit_paypal_post();
				// submit the fields to paypal
			}
			if ($param1 == 'paypal_ipn') {
				if ($this->paypal->validate_ipn() == true) {
					$ipn_response = '';
					foreach ($_POST as $key => $value) {
						$value = urlencode(stripslashes($value));
						$ipn_response .= "\n$key=$value";
					}
					$data['payment_details']   = $ipn_response;
					$data['payment_timestamp'] = strtotime(date("m/d/Y"));
					$data['payment_method']    = 'paypal';
					$data['status']            = 'paid';
					$invoice_id                = $_POST['custom'];
					$this->db->where('invoice_id', $invoice_id);
					$this->db->update('invoice', $data);
					
					$data2['method']='paypal';
					$data2['invoice_id']=$_POST['custom'];
					$data2['timestamp']=strtotime(date("m/d/Y"));
					$data2['payment_type']='income';
					$data2['title']=$this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
					$data2['description']=$this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
					$data2['student_id']=$this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
					$data2['amount']=$this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
					$this->db->insert('payment' , $data2);
				}
			}
			if ($param1 == 'paypal_cancel') {
				$this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
				redirect(base_url() . 'index.php?parents/invoice/' . $student_id, 'refresh');
			}
			if ($param1 == 'paypal_success') {
				$this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
				redirect(base_url() . 'index.php?parents/invoice/' . $student_id, 'refresh');
			}
			$parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
			))->row();
			$page_data['student_id'] = $student_id;
			$page_data['page_name']  = 'invoice';
			$page_data['page_title'] = get_phrase('manage_invoice/payment');
			$this->load->view('backend/index', $page_data);
		}
		/**********WATCH NOTICEBOARD AND EVENT ********************/
		function noticeboard($param1 = '', $param2 = '', $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
			
			$page_data['notices']    = $this->db->get('noticeboard')->result_array();
			$page_data['page_name']  = 'noticeboard';
			$page_data['page_title'] = get_phrase('noticeboard');
			$this->load->view('backend/index', $page_data);
			
		}
		/* private messaging */
		
		function message($param1 = 'message_home', $param2 = '', $param3 = '') {
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			if($param1 == 'message_read1')
			{
				$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
				$this->student_model->mark_thread_messages_read($param2);	
				$data['msg']=$this->db->get_where('message',array('message_id'=>$param2))->result();
				$this->load->view('backend/parents/reply_modal',$data);
			}
			else
			{
				if ($param1 == 'message_read') {
					$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
					$this->teacher_model->mark_thread_messages_read($param2);
				}
				if ($param1 == 'send_new') {
					$message_thread_code = $this->parent_model->send_new_private_message();
					$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
					redirect(base_url() . 'index.php?parents/message/message_read/' . $message_thread_code, 'refresh');
				}				
				if ($param1 == 'send_reply') {
					$this->parent_model->send_reply_message($param2);  //$param2 = message_thread_code
					$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
					redirect(base_url() . 'index.php?parents/message');
				}				
				$page_data['message_inner_page_name']   = $param1;
				$page_data['page_name']                 = 'message';
				$page_data['page_title']                = get_phrase('private_messaging');
				
				$this->load->view('backend/index', $page_data);
			}
		}
		function get_receiver()	
		{
			
			$ids=$this->input->post('ids');
			$groupid=$this->db->get_where('group',array('group_id'=>$this->input->post('type')))->row();			
			$type=$groupid->user_type;	
			if($type == 1){					
				$all	=	$this->db->get('teacher')->result_array();					
				}elseif($type == 2){					
				$all	=	$this->db->get('student')->result_array();					
				}elseif($type == 3){					
				$all	=	$this->db->get_where('teacher',array('teaching_type'=>2))->result_array();						
				}elseif($type == 4){					
				$all	=	$this->db->get('parent')->result_array();					
			}
			elseif($groupid->user_type==5)
			{
				$all	=	$this->db->get('admin')->result_array();
			}
			
			foreach($ids as $id)
			{
				if($type == 1){
					foreach($all as $rec)
					{
						if($rec['teacher_id']==$id)
						{
							$allid[] = $rec['teacher_id'];
							$name[] = $rec['name'];
						}
					}		
				}
				elseif($type == 2){
					foreach($all as $rec)
					{
						if($rec['student_id']==$id)
						{								//echo $rec['name']."<br>";
							$allid[] = $rec['student_id'];
							$name[] = $rec['name']; 
						} 
					}
				}
				
				elseif($type == 3){
					foreach($all as $rec)
					{						
					 	if($rec['student_id']==$id)
						{
							$allid[] = $rec['student_id'];
							$name[] = $rec['name'];	
						} 
					}
				}
				
				elseif($type == 4){
					foreach($all as $rec)
					{						
						if($rec['parent_id']==$id)
						{
							$allid[] = $rec['parent_id'];
							$name[] = $rec['name'];
						} 
					}
				}	
				elseif($type == 5){
					foreach($all as $rec)
					{						
						if($rec['admin_id']==$id)
						{
							$allid[] = $rec['admin_id'];
							$name[] = $rec['name'];
						} 
					}
				}
			} 
			$string['name']=implode(',',$name);
			$string['ids']=implode(',',$allid);
			$string['type']=$type;
			echo json_encode($string);
		}
		/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
		function manage_profile($param1 = '', $param2 = '', $param3 = '')
		{ 
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
			if ($param1 == 'update_profile_info') {
				$data['name']        = $this->input->post('name');
				$data['parent_email']       = $this->input->post('email');
				$data['mother_name']       = $this->input->post('mother_name');
				$data['address']       = $this->input->post('address');
			    
			$student_email_duplicate = $this->db->get_where('student', array('email' => $this->input->post('email')))->num_rows();
			$teacher_email_duplicate = $this->db->get_where('teacher', array('email' => $this->input->post('email')))->num_rows();
			if($student_email_duplicate > 0 || $teacher_email_duplicate > 0){
			$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));	
			}else{
				if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				$path = "uploads/parent_image/" . $this->session->userdata('parent_id') . '.jpg';
			    unlink($path);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $this->session->userdata('parent_id') . '.jpg');
			$data['parent_image']= $this->session->userdata('parent_id').'.jpg';
			    }
				
				$this->db->where('parent_id', $this->session->userdata('parent_id'));
                $this->db->update('parent', $data);
			}
			redirect(base_url() . 'index.php?parents/manage_profile/', 'refresh');
			}
			if ($param1 == 'change_password') {
				$data['real_pass']             = $this->input->post('password');
				$data['new_password']         = $this->input->post('new_password');
				$data['confirm_new_password'] = $this->input->post('confirm_new_password');
				
				$current_password = $this->db->get_where('parent', array(
                'parent_id' => $this->session->userdata('parent_id')
				))->row()->real_pass;
				if ($current_password == $data['real_pass'] && $data['new_password'] == $data['confirm_new_password']) {
					$this->db->where('parent_id', $this->session->userdata('parent_id'));
					$this->db->update('parent', array('real_pass'=>$data['new_password'],'password'=>md5($data['new_password'])
					));
					$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
					} else {
					$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
				}
				redirect(base_url() . 'index.php?parents/manage_profile/', 'refresh');
			}
			$page_data['page_name']  = 'manage_profile';
			$page_data['page_title'] = get_phrase('manage_profile');
			$page_data['edit_data']  = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
			))->result_array();
			$this->load->view('backend/index', $page_data);
		}
		
		/**** Assessment *****/
		/**** Develop By Hardik Bhut 18-January-2015 *****/
		function assessment($param1 = '', $param2 = '' , $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
			if ($param1 == 'create')
			{
				$data['class_id']    = $this->input->post('class_name');
				$data['student_id']  = $this->input->post('student_name');
				$data['behaviour']   = $this->input->post('behaviour');
				$this->db->insert('assessment', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
				redirect(base_url() . 'index.php?parents/assessment', 'refresh');
			}
			if ($param1 == 'do_update') {
				$data['class_id']    = $this->input->post('class_name');
				$data['student_id']  = $this->input->post('student_name');
				$data['behaviour']   = $this->input->post('behaviour');
            	$this->db->where('assessment_id', $param2);
            	$this->db->update('assessment', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            	redirect(base_url() . 'index.php?parents/assessment/', 'refresh');
				} else if ($param1 == 'edit') {
				$page_data['edit_data'] = $this->db->get_where('assessment', array(
                'assessment_id' => $param2
				))->result_array();
			}
			if ($param1 == 'delete') {
				$this->db->where('assessment_id', $param2);
				$this->db->delete('assessment');
				$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
				redirect(base_url() . 'index.php?parents/assessment/', 'refresh');
			}
			$page_data['page_name']  = 'assessment';
			$page_data['page_title'] = 'Assessment';
			$this->load->view('backend/index', $page_data);
		}
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function get_classes($class_id)
		{
			$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
			echo '<option value="">Select student</option>';
			foreach ($get_student_list as $row_value){
				echo '<option value="'.$row_value['student_id'].'">'.$row_value['name'].'</option>';
			}
		}
		function get_behaviour($student_id)
		{
			$get_behaviour = $this->db->get_where('assessment' , array('student_id' => $student_id))->row();
			$arr = array('behaviour' =>$get_behaviour->behaviour,'behaviour_id' =>$get_behaviour->assessment_id);
			echo json_encode($arr);
		}
		/* Develop By Hardik Bhut 19-January-2016 */
		function get_subject_data_table()
		{
			$data['list']=$_POST['list'];
			$data['student_id']=$_POST['student_id'];
			
			$this->load->view('backend/parents/get_data_table',$data);		 
		}
		function get_share_material_data_table()
		{
			$data['list']=$_POST['list'];
			$data['student_id']=$_POST['student_id'];
			
			$this->load->view('backend/parents/get_data_table',$data);		 
		}
		function get_exam()
		{
			$this->db->distinct('name');
			$this->db->group_by('name');
			 $this->db->where('class_id',$this->input->post('class_id'));
			 $q=$this->db->get('exam')->result_array();	
			// echo $this->db->last_query()."<br>";
			 echo json_encode($q);
			 
		}
		/* Develop By Hardik Bhut 19-January-2016 */
		function get_exam_data_table()
		{
			$data['list']=$_POST['list'];
			$data['student_name']=$_POST['student_name'];
			$data['exam_name']=$_POST['exam_name'];
			$this->load->view('backend/parents/get_data_table',$data);		 
		}
		
		/**** Student Attendance *****/
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function student_attendance($param1 = '', $param2 = '' , $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1){
				$this->session->set_userdata('last_page' , current_url());
				redirect(base_url(), 'refresh');
			}
			if ($param1 == 'create') {
				$test = explode('/',$this->input->post('date'));
				$date_final = $test[2].'-'.$test[0].'-'.$test[1];
				$data['date']                     = $date_final;
				$data['attandence_class']         = $this->input->post('classes');
				$data['student_id']               = $this->input->post('student');
				$data['description']      		  = $this->input->post('description');
				$data['status']  				   = 2;
				$data['month']  				    = $test[0];
				
				$this->db->select('*')->from('attendance');
				$this->db->where('attandence_class',$this->input->post('classes')); 
				$this->db->where('student_id',$this->input->post('student')); 
				$this->db->where('date',$date_final); 
				$query = $this->db->get(); 
				$duplicate_student_entry=$query->num_rows();
				
				$student_holiday_check=$this->db->get_where('holiday',
				array('holiday_date' =>$this->input->post('date')))->row();
				if(count($student_holiday_check)>0){
					$this->session->set_flashdata('flash_message' , get_phrase('this_day_is_already_holiday'));
				}
				else if($duplicate_student_entry > 0){
					$this->session->set_flashdata('flash_message' , get_phrase('do_not_add_this record_again')); 
					redirect(base_url() . 'index.php?parents/student_attendance', 'refresh');
				}
				else{
					$this->db->insert('attendance', $data);
					$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully')); 
					redirect(base_url() . 'index.php?parents/student_attendance', 'refresh');
				}
			}
			$page_data['page_name']  = 'student_attendance';
			$page_data['page_title'] = 'Student Attendance';
			$this->load->view('backend/index', $page_data);
		}
		// Use for Student Month Attendance
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function get_student_month_attendance($month)
		{
			
			$array = array("attendance.status"=>2,"attendance.student_id !="=>0,"attendance.month"=>$month);
			$this->db->select('*');
			$this->db->from('attendance');
			$this->db->join('student', 'student.student_id = attendance.student_id');
			$this->db->where($array);
			$query = $this->db->get();
			$attendance =$query->result();
			//echo $this->db->last_query();
			
			foreach($attendance as $row)
			{
				echo '
				<tr class="gradeA"><td>' .date("d-M-Y", strtotime($row->date)) . '</td>
				<td>'. $row->class_id.'</td>	
				<td>'. $row->name.'</td>
				<td>'. $row->description.'</td>
				</tr>';
			} 
		}
		// Use for Student Class Attendance
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function get_student_class_attendance($class_id)
		{
			$array = array("attendance.status"=>2,"attendance.student_id !="=>0,"attendance.attandence_class"=>$class_id);
			$this->db->select('*');
			$this->db->from('attendance');
			$this->db->join('student', 'student.student_id = attendance.student_id');
			$this->db->where($array);
			$query = $this->db->get();
			$attendance =$query->result();
			foreach($attendance as $row){
				echo '<tr class="gradeA"><td>' .date("d-M-Y", strtotime($row->date)) . '</td>
				<td>'. $row->class_id.'</td>	
				<td>'. $row->name.'</td>
				<td>'. $row->description.'</td>
				</tr>';
			} 
		}
		// Use for Student Search Name Attendance
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function get_month_attendance_student_name($search_keyword="")
		{
			if($search_keyword != ""){	
				$array = array("attendance.status"=>2,"attendance.student_id !="=>0,"student.student_id"=>$search_keyword);
				}else{
				$array = array("attendance.status"=>2,"attendance.student_id !="=>0);	
			}
			$this->db->select('*');
			$this->db->from('attendance');
			$this->db->join('student', 'student.student_id = attendance.student_id');
			$this->db->where($array);
			$query = $this->db->get();
			$attendance =$query->result();		
			
			foreach($attendance as $row){
				echo '
				<tr class="gradeA"><td>' .date("F d, Y", strtotime($row->date)) . '</td>
				<td>'. $row->description.'</td>
				<td>'. $row->leave_type.'</td>
				</tr>';
			} 
		}
		
		/**** Time Table *****/ 
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		
		function time_table($param1 = '', $param2 = '', $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1){
				$this->session->set_userdata('last_page' , current_url());
				redirect(base_url(), 'refresh');
			}
			if ($param1 == 'create') {
				$timestamp = strtotime($this->input->post('date'));
				$data['class_id']   = $this->input->post('class_id');
				$data['subject_id'] = $this->input->post('subject_id');
				$data['teacher_id'] = $this->input->post('teacher_id');
				$data['date']       = $this->input->post('date');
				$data['month']      = date("m", strtotime($this->input->post('date')));
				$data['week']       = ceil( date( 'j', strtotime($this->input->post('date')) ) / 7 );
				$data['day']        = date('l', $timestamp); 
				$data['time_start'] = $this->input->post('time_start');
				$data['time_end']   = $this->input->post('time_end');
				
				$this->db->insert('time_table', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
				redirect(base_url() . 'index.php?parents/time_table/', 'refresh');
			}
			if ($param1 == 'do_update') {
				$timestamp = strtotime($this->input->post('date'));
				$data['class_id']   = $this->input->post('class_id');
				$data['subject_id'] = $this->input->post('subject_id');
				$data['teacher_id'] = $this->input->post('teacher_id');
				$data['date']       = $this->input->post('date');
				$data['week']       = ceil( date( 'j', strtotime($this->input->post('date')) ) / 7 );
				$data['day']        = date('l', $timestamp); 
				$data['time_start'] = $this->input->post('time_start');
				$data['time_end']   = $this->input->post('time_end');
				$this->db->where('time_table_id', $param2);
				$this->db->update('time_table', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
				redirect(base_url() . 'index.php?parents/time_table/', 'refresh');
				} else if ($param1 == 'edit') {
				$page_data['edit_data'] = $this->db->get_where('time_table', array(
                'time_table_id' => $param2
				))->result_array();
			}
			if ($param1 == 'delete') {
				$this->db->where('time_table_id', $param2);
				$this->db->delete('time_table');
				$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
				redirect(base_url() . 'index.php?parents/time_table/', 'refresh');
			}
			$page_data['page_name']  = 'time_table';
			$page_data['page_title'] = 'Time Table';
			$this->load->view('backend/index', $page_data);
		}
		/**** Use for time_table *****/ 
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function get_class_subject($class_id)
		{
			$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
			echo '<option value="">Select Subject</option>';
			foreach ($subjects as $row) {
				echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
			}
		}
		/* Develop By Hardik Bhut 19-January-2016 */
		function get_time_table_data()
		{
		$this->load->view('backend/parents/get_time_table_data', $_POST['student_name'],$_POST['month'],$_POST['week']);							    }
		
		function financial_structure($param1 = '', $param2 = '', $param3 = '')
		{	
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			$page_data['page_name']  = 'financial_structure';
			$page_data['page_title'] = 'Payment';
		$this->load->view('backend/index', $page_data);    }
		
		/* Develop By Hardik Bhut 16-January-2016 */
		function exam($param1 = '', $param2 = '' , $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1){
				$this->session->set_userdata('last_page' , current_url());
				redirect(base_url(), 'refresh');
			}
			$page_data['page_name']  = 'exam';
			$page_data['page_title'] = 'Exam';
			$this->load->view('backend/index', $page_data);
		}
		/**** Develop By Hardik Bhut 19-January-2016 *****/
		function get_student_name($class_id)
		{
			$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
			echo '<option value="">Select student</option>';
			foreach ($get_student_list as $row_value)
			{
				echo '<option value="' . $row_value['name'].' '.$row_value['father_name'].'">' . $row_value['name'] . '</option>';
			}
		}
		/**** Develop By Brijesh Dhami 22-december-2015 *****/
		function notification($param1 = '', $param2 = '', $param3 = '')
		{	
			
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			if ($param1 == 'create') {
				$data['notice_name']     = $this->session->userdata('name');
				$data['notice']          = $this->input->post('notice');           
				$this->db->insert('noticeboard', $data);            
				
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
				redirect(base_url() . 'index.php?parents/notification/', 'refresh');
			}        
			
			$page_data['page_name']  = 'notification';
			$page_data['page_title'] = 'Manage Notification';
			$this->db->order_by('notice_id','desc');
			$page_data['notices']    =$this->db->get('noticeboard')->result_array();
			$this->load->view('backend/index', $page_data);
		}
		
		/**** Develop By Hardik Bhut 18-January-2016 *****/
		function share_material($param1 = '', $param2 = '', $param3 = '')
		{
			
			if ($this->session->userdata('parent_login') != 1){
				$this->session->set_userdata('last_page' , current_url());
				redirect(base_url(), 'refresh');
			}
			$get_student=$this->db->get_where('parent',array('parent_id'=>$this->session->userdata('parent_id')))->row();
			$page_data['share_material'] = $this->db->get_where('share_material',array('class_id'=>$get_student->class_id))->result_array();
			$page_data['page_name']  = 'share_material';
			$page_data['page_title'] = "Share Study material";
			$this->load->view('backend/index', $page_data);
			
		}
		
		function mark($param1 = '', $param2 = '' , $param3 = '')
		{
			if ($this->session->userdata('parent_login') != 1){
				$this->session->set_userdata('last_page' , current_url());
				redirect(base_url(), 'refresh');
			}
			$page_data['page_name']  = 'mark';
			$page_data['page_title'] = 'Mark';
			$this->load->view('backend/index', $page_data);
		}
		function get_mark_data_table()
		{
			$data['list']=$_POST['list'];
			$data['student_name']=$_POST['student_name'];
			$data['exam_name']=$_POST['exam_name'];
			$this->load->view('backend/parents/get_data_table',$data);   
		}
		function history($param1 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			$page_data['page_name']  = 'history';
			$page_data['page_title'] = 'History';
			$this->load->view('backend/index', $page_data);
		}
		
		function holiday($param1 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			$page_data['page_name']  = 'holiday';
			$page_data['page_title'] = 'Manage Holiday';
			$this->load->view('backend/index', $page_data);
		}
		/****MANAGE parent *****/
		function parent($param1 = '')
		{
			if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
			
			$page_data['page_name']  = 'parent';
			$page_data['page_title'] = 'Parent';
			$this->load->view('backend/index', $page_data);
		}
		
		
		
		
		
	}

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

class Teacher extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		error_reporting(0);
    }
    
    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
    }
    
    /***TEACHER DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = 'Staff dashboard';
        $this->load->view('backend/index', $page_data);
    }
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['birthday']   = $this->input->post('birthday');
            $data['sex']        = $this->input->post('sex');
            $data['address']    = $this->input->post('address');
            $data['phone']      = $this->input->post('phone');
            $data['email']      = $this->input->post('email');
            $data['password']   = $this->input->post('password');
            $data['class_id']   = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['parent_id']  = $this->input->post('parent_id');
            $data['roll']       = $this->input->post('roll');
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?teacher/student_add/' . $data['class_id'], 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['class_id']    = $this->input->post('class_id');
            $data['section_id']  = $this->input->post('section_id');
            $data['parent_id']   = $this->input->post('parent_id');
            $data['roll']        = $this->input->post('roll');
            
            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();
            
            redirect(base_url() . 'index.php?teacher/student_information/' . $param1, 'refresh');
        } 
		
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?teacher/student_information/' . $param1, 'refresh');
        }
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = 'Teachers';
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
		$page_data['page_name']  = 'subject';
        $page_data['page_title'] = 'Subject';
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
			
			$student_email_duplicate = $this->db->get_where('student', array('email' => $this->input->post('email')))->num_rows();
			$parent_email_duplicate = $this->db->get_where('parent', array('parent_email' => $this->input->post('email')))->num_rows();
		 	$teacher_email_duplicate = $this->db->get_where('teacher', array('email' => $this->input->post('email'),'teacher_id !=' =>$this->session->userdata('teacher_id')))->num_rows();
			if($student_email_duplicate > 0 || $parent_email_duplicate > 0 || $teacher_email_duplicate > 0){
			$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));	
			}else{
				if($_FILES['userfile']['name'] != ""){
				$path = "uploads/teacher_image/" . $this->session->userdata('teacher_id') . '.jpg';
			    unlink($path);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
			$data['staff_image']= $this->session->userdata('teacher_id').'.jpg';
			}
				$this->db->where('teacher_id', $this->session->userdata('teacher_id'));
				$this->db->update('teacher', $data);
				$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			}
			redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
		
        if ($param1 == 'change_password') {
			
            $data['real_pass']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('teacher', array(
                'teacher_id' => $this->session->userdata('teacher_id')
            ))->row()->real_pass;
            if ($current_password == $data['real_pass'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
                $this->db->update('teacher', array('real_pass' => $data['new_password'],'password'=>
				md5($data['new_password'])));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('teacher', array(
            'teacher_id' => $this->session->userdata('teacher_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
			if ($this->session->userdata('teacher_login') != 1)
			{
				$this->session->set_userdata('last_page' , current_url());
				redirect(base_url(), 'refresh');
			}
			if($param1 == 'message_read1')
			{
				$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
				$this->student_model->mark_thread_messages_read($param2);	
				$data['msg']=$this->db->get_where('message',array('message_id'=>$param2))->result();
				$this->load->view('backend/teacher/reply_modal',$data);
			}
			else
			{
				
				if ($param1 == 'send_new') {
					$message_thread_code = $this->teacher_model->send_new_private_message();
					$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
					redirect(base_url() . 'index.php?teacher/message/message_read/' . $message_thread_code, 'refresh');
				}
				
				if ($param1 == 'send_reply') {
					$this->teacher_model->send_reply_message($param2);  //$param2 = message_thread_code
					$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
					redirect(base_url() . 'index.php?teacher/message/message_read/' . $param2, 'refresh');
				}
				
				if ($param1 == 'message_read') {
					$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
					$this->teacher_model->mark_thread_messages_read($param2);
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
	 /**** Assessment *****/
	/**** Develop By Hardik Bhut 18-January-2015 *****/
	function assessment($param1 = '', $param2 = '' , $param3 = '')
	{
		if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

		if ($param1 == 'create')
		 {
			$data['class_id']    = $this->input->post('class_name');
           	$data['student_id']  = $this->input->post('student_name');
			$data['behaviour']   = $this->input->post('behaviour');
			$data['created_date']= date('Y-m-d H:i:s', time());
			$this->db->insert('assessment', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?teacher/assessment', 'refresh');
        }
		if ($param1 == 'do_update') {
			$data['class_id']    = $this->input->post('class_name');
           	$data['student_id']  = $this->input->post('student_name');
			$data['behaviour']   = $this->input->post('behaviour');
			$data['created_date']= date('Y-m-d H:i:s', time());
            	$this->db->where('assessment_id', $param2);
            	$this->db->update('assessment', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            	redirect(base_url() . 'index.php?teacher/assessment/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('assessment', array(
                'assessment_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
			$this->db->where('assessment_id', $param2);
            $this->db->delete('assessment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/assessment/', 'refresh');
        }
		$page_data['page_name']  = 'assessment';
        $page_data['page_title'] = 'Assessment';
		$this->load->view('backend/index', $page_data);
	}

		/**** Develop By Hardik Bhut 16-January-2016 *****/
	function get_classes($class_id)
	{
		$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
			echo '<option value="">Select student</option>';
		foreach ($get_student_list as $row_value)
		 {
			echo '<option value="' . $row_value['student_id'] . '">' . $row_value['name'] . '</option>';
		 }
	}
			/**** Develop By Hardik Bhut 16-January-2016 *****/
	function get_student_name($class_id)
	{
		$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
		echo '<option value="">Select student</option>';
		foreach ($get_student_list as $row_value)
		 {
			echo '<option value="' . $row_value['name'].' '.$row_value['father_name'].'">' . $row_value['name'] . '</option>';
		 }
	}
	function get_student_id($class_id)
	{
		$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
		echo '<option value="">Select student</option>';
		foreach ($get_student_list as $row_value)
		 {
			echo '<option value="'.$row_value['student_id'].'">'.$row_value['name'].'</option>';
		 }
	}


	function get_behaviour($student_id)
	{
		$get_behaviour = $this->db->get_where('assessment' , array('student_id' => $student_id))->row();
		$arr = array('behaviour' =>$get_behaviour->behaviour,'behaviour_id' =>$get_behaviour->assessment_id);
		echo json_encode($arr);
	}
		/* Develop By Hardik Bhut 16-January-2016 */
	function get_subject_data_table()
	{
		$data['list']=$_POST['list'];
		$data['class_id']=$_POST['class_id'];
		$this->load->view('backend/teacher/get_data_table',$data);		 
	}

	/* Develop By Hardik Bhut 16-January-2016 */
	function get_exam_data_table()
	{
		$data['list']=$_POST['list'];
		$data['student_name']=$_POST['student_name'];
		$data['exam_name']=$_POST['exam_name'];
        $this->load->view('backend/teacher/get_data_table',$data);		 
	}
   /* Develop By Hardik Bhut 16-January-2016 */
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1){
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
		if ($param1 == 'import_excel')
		{
			$data['year'] = $this->input->post('year_name');
            $data['class_id'] = $this->input->post('class_id');
			$data['uplaoded_file_name'] = $_FILES['userfile']['name']; 
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/mark_sheet/'.$_FILES['userfile']['name']);
			include 'excel_reader2.php';
			$excel = new Spreadsheet_Excel_Reader();
			$excel->read('uploads/mark_sheet/'.$_FILES['userfile']['name']);    
			$x=6;
			while($x<=$excel->sheets[0]['numRows']) {
		$year =   isset($excel->sheets[0]['cells'][2][2]) ? $excel->sheets[0]['cells'][2][2] : '';
		$data['exam_id'] =   isset($excel->sheets[0]['cells'][3][2]) ? $excel->sheets[0]['cells'][3][2] : '';
		$class_id =  isset($excel->sheets[0]['cells'][4][2]) ? $excel->sheets[0]['cells'][4][2] : '';
		$data['student_name'] =   isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
		for($a=2; $a<=5; $a++){
		$data['subject_id']=isset($excel->sheets[0]['cells'][5][$a]) ? $excel->sheets[0]['cells'][5][$a] : '';	
		$data['mark_obtained']=isset($excel->sheets[0]['cells'][$x][$a]) ? $excel->sheets[0]['cells'][$x][$a] : '';
		
			$file_exist=$this->db->get_where('mark',array('uplaoded_file_name'=>$_FILES['userfile']['name']))->row();
			if($year==$data['year'] && $class_id==$data['class_id'] && count($file_exist)>0){
				$this->db->insert('mark', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			}else{
				//$path = "uploads/mark_sheet/" . $_FILES['userfile']['name'];
				//unlink($path);
				$this->session->set_flashdata('flash_message' , get_phrase('report_not_match_with_this_system'));
			}
		}
		$x++;
		}
			redirect(base_url() . 'index.php?teacher/mark/', 'refresh');
		}
        
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = 'Exam';
        $this->load->view('backend/index', $page_data);
    }
		/****Use For Mark *****/ 
	/**** Develop By Hardik Bhut 18-January-2016 *****/
	function download_mark_excelsheet($param1 = '')
	{
		$page_data['class_id']=$param1;
		$page_data['page_name']  = 'download_mark_excelsheet';
		$page_data['page_title'] = 'Mark';
        $this->load->view('backend/index', $page_data);
	}
	
	/**** Student Attendance *****/
	/**** Develop By Hardik Bhut 18-January-2016 *****/
	function student_attendance($param1 = '', $param2 = '' , $param3 = '')
	{
		if ($this->session->userdata('teacher_login') != 1){
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
            redirect(base_url() . 'index.php?teacher/student_attendance', 'refresh');
			}
			else{
			$this->db->insert('attendance', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully')); 
            redirect(base_url() . 'index.php?teacher/student_attendance', 'refresh');
			}
        }
		if ($param1 == 'delete') {
			$this->db->where('attendance_id', $param2);
            $this->db->delete('attendance');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/student_attendance/', 'refresh');
        }
		$page_data['page_name']  = 'student_attendance';
        $page_data['page_title'] = 'Student Attendance';
		$this->load->view('backend/index', $page_data);
	}
	// Use for Student Month Attendance
	/**** Develop By Hardik Bhut 16-december-2015 *****/
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
								<tr class="gradeA"><td>' .date("F d, Y",strtotime($row->date)) . '</td>
									  <td>'. $row->class_id.'</td>	
									  <td>'. $row->name.'</td>
									  <td>'. $row->description.'</td>
									  <td>'. $row->leave_type.'</td>
									  <td><div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="'.base_url().'index.php?teacher/student_attendance/delete/'.$row->attendance_id.'"><i class="entypo-trash"></i>Delete</a></li></ul></div></td></tr>';
					 } 
	}
			// Use for Student Class Attendance
	/**** Develop By Hardik Bhut 16-december-2015 *****/
	function get_student_class_attendance($class_id)
	{
	$array = array("attendance.status"=>2,"attendance.student_id !="=>0,"attendance.attandence_class"=>$class_id);
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
								<tr class="gradeA"><td>' .date("F d, Y",strtotime($row->date)) . '</td>
									  <td>'. $row->class_id.'</td>	
									  <td>'. $row->name.'</td>
									  <td>'. $row->description.'</td>
									  <td>'. $row->leave_type.'</td>
									  <td><div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="'.base_url().'index.php?teacher/student_attendance/delete/'.$row->attendance_id.'"><i class="entypo-trash"></i>Delete</a></li></ul></div></td></tr>';
					 } 
	}
		// Use for Student Search Name Attendance
	/**** Develop By Hardik Bhut 21-december-2015 *****/
	function get_month_attendance_student_name($search_keyword="")
	{
	if($search_keyword != ""){	
		$array = array("attendance.status"=>2,"attendance.student_id !="=>0,"student.name LIKE"=>"%".$search_keyword."%");
	}else{
		$array = array("attendance.status"=>2,"attendance.student_id !="=>0);	
	}
			$this->db->select('*');
			$this->db->from('attendance');
			$this->db->join('student', 'student.student_id = attendance.student_id');
			$this->db->where($array);
			$query = $this->db->get();
			$attendance =$query->result();
			//echo $this->db->last_query();
		
                     foreach($attendance as $row){
						echo '
								<tr class="gradeA"><td>' .date("F d, Y",strtotime($row->date)) . '</td>
									  <td>'. $row->class_id.'</td>	
									  <td>'. $row->name.'</td>
									  <td>'. $row->description.'</td>
									  <td>'. $row->leave_type.'</td>
									  <td><div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="'.base_url().'index.php?teacher/student_attendance/delete/'.$row->attendance_id.'"><i class="entypo-trash"></i>Delete</a></li></ul></div></td></tr>';
					 } 
	}
	
		/**** Develop By Hardik Bhut 18-January-2016 *****/
    function share_material($param1 = '', $param2 = '', $param3 = '')
    {
		
        if ($this->session->userdata('teacher_login') != 1){
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['class_id']         = $this->input->post('class_id');
            $data['subject_id'] 	   = $this->input->post('subject_id');
            $data['topic_name']       = $this->input->post('topic_name');           
			
				$fileName     = $_FILES["m_filename"]["name"];				
				$random = rand(1111,9999);
				$data['m_filename'] =$random.$fileName;
				move_uploaded_file($_FILES["m_filename"]["tmp_name"], "uploads/study_material/" . $data['m_filename']);
			
            $this->db->insert('share_material', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/share_material', 'refresh');
        }        
        if ($param1 == 'delete') {
			$mat		=	$this->db->get_where('share_material' , array('material_id' => $param2))->result_array();			
			$path = "uploads/study_material/" . $mat[0]['m_filename'];
			unlink($path);
            $this->db->where('material_id', $param2);
            $this->db->delete('share_material');
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/share_material', 'refresh');
        }
        $page_data['share_material'] = $this->db->get('share_material')->result_array();
        $page_data['page_name']  = 'share_material';
        $page_data['page_title'] = "Share Study material";
        $this->load->view('backend/index', $page_data);
        
    }
	//Use for mark 
	/**** Develop By Hardik Bhut 18-January-2016 *****/
	function update_student_mark()
    {
		$_POST['mark_id'];
		$data['mark_obtained']=$_POST['mark_obtained'];
		$data['mark_total']=$_POST['mark_total'];
		
		$this->db->where('mark_id',$_POST['mark_id']);
        $this->db->update('mark', $data);
	}
	/**** End Study Material *****/
	
		/**** Time Table *****/ 
	/**** Develop By Hardik Bhut 19-January-2016 *****/

    function time_table($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1){
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
            redirect(base_url() . 'index.php?teacher/time_table/', 'refresh');
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
            redirect(base_url() . 'index.php?teacher/time_table/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('time_table', array(
                'time_table_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('time_table_id', $param2);
            $this->db->delete('time_table');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?teacher/time_table/', 'refresh');
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
	    $this->load->view('backend/teacher/get_time_table_data', $_POST['class_id'],$_POST['month'],$_POST['week']);							    }
	
	function notification($param1 = '', $param2 = '', $param3 = '')
    {	
		
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_name']     = $this->session->userdata('name');
            $data['notice']          = $this->input->post('notice');           
            $this->db->insert('noticeboard', $data);            

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?teacher/notification/', 'refresh');
        }        
       
        $page_data['page_name']  = 'notification';
        $page_data['page_title'] = 'Manage Notification';
        						  $this->db->order_by('notice_id','desc');
		$page_data['notices']    =$this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	function get_year($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
      
	    $data['list']=$_POST['list'];
		$data['year']=$_POST['year'];
		$this->load->view('backend/teacher/get_data_table',$data);	
    }
	
		/* Develop By Hardik Bhut 16-January-2016 */
    function mark($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1){
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
		if($param1=='do_update'){
			$_POST['mark_id'];
			$data['mark_obtained']=$_POST['mark_obtained'];
			$data['mark_total']=$_POST['mark_total'];
		
			$this->db->where('mark_id',$_POST['mark_id']);
       		$this->db->update('mark', $data);
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
		$this->load->view('backend/teacher/get_data_table',$data);   
	}
		/****MANAGE financial_structure *****/
    function financial_structure($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
      
	    $page_data['page_name']  = 'financial_structure';
        $page_data['page_title'] = 'Payment';
        $this->load->view('backend/index', $page_data);
    }
		/****MANAGE History *****/
    function history($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
      
	    $page_data['page_name']  = 'history';
        $page_data['page_title'] = 'History';
        $this->load->view('backend/index', $page_data);
    }
		/****MANAGE Holidays *****/
    function holiday($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
      
	    $page_data['page_name']  = 'holiday';
        $page_data['page_title'] = 'Manage Holiday';
        $this->load->view('backend/index', $page_data);
    }
		/****MANAGE parent *****/
    function parent($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
      
	    $page_data['page_name']  = 'parent';
        $page_data['page_title'] = 'Parent';
        $this->load->view('backend/index', $page_data);
    }
	function get_parent_data_table()
	{
		$data['list']=$_POST['list'];
		$data['class_id']=$_POST['class_id'];
		$data['student_name']=$_POST['student_name'];
        $this->load->view('backend/teacher/get_data_table',$data);		 
	}




	/*           Teacher Reports     Develop by mayur panchal    */
	
	/*  Pdf functions */
	
	public function sidebar_ind_student_pdf()
	{
		$class_id = $this->input->post("class_id");
		$student_id = $this->input->post("student_id");
		$data['class_id'] = $class_id;
		$data['student_id'] = $student_id;
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/teacher/sidebar_ind_student_pdf', $data, true));		
		$pdfFilePath = "individual_student_report_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
	public function parent_list_pdf(){
		$class_id = $this->input->post("class_id");
		$data['class_id'] = $class_id;
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/teacher/parent_list_pdf', $data, true));		
		$pdfFilePath = "parent_list_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
	/*   */
	
	/*  Mayur   */
	
	public function individual_student()
	{
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
		$class_id = $this->input->post("class_id");
		$student_id = $this->input->post("student_id");
		
		$page_data['page_name']  = 'sidebar_ind_student';
        $page_data['page_title'] = get_phrase('individual_student_report');
		$page_data['class_id'] = $class_id;
		$page_data['student_id'] = $student_id;
		$this->load->view('backend/index', $page_data);
		
		}
		
		
	}
	function class_wise_teacher_pdf(){
		$class_id = $this->input->post("class_id");
		$data['class_id'] = $class_id;
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/teacher/class_wise_teacher_pdf', $data, true));		
		$pdfFilePath = "class_wise_teacher_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
	function standard_wise_teacher_pdf()
	{
		$standard_id = $this->input->post("standard_id");
		$data['standard_id'] = $standard_id;
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/teacher/standard_wise_teacher_pdf', $data, true));		
		$pdfFilePath = "standard_wise_teacher.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	function subject_wise_teacher_pdf()
	{
		$subject_name = $this->input->post("subject_name");
		$data['subject_name'] = $subject_name;
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/teacher/subject_wise_teacher_pdf', $data, true));		
		$pdfFilePath = "subject_wise_teacher.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	function all_teacher_pdf()
	{
		
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/teacher/all_teacher_pdf', $data, true));		
		$pdfFilePath = "all_teacher.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
	function class_wise_timetable_pdf(){
	
	$class_id = $this->input->post('class_id');
		$month = $this->input->post('month');
		$week = $this->input->post('week');
		$data['class_id'] = $class_id;
		$data['month'] = $month;
		$data['week'] = $week;
		$html =  utf8_encode($this->load->view('backend/teacher/class_wise_timetable_pdf', $data, true));		
		$pdfFilePath = "class_wise_timetable.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
	function timetables($param='')
	{
		
		if($param=="class_wise_timetable")
		{
			
			if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
			{
		$class_id = $this->input->post('class_id');
		$month = $this->input->post('month');
		$week = $this->input->post('week');
		$page_data['class_id'] = $class_id;
		$page_data['month'] = $month;
		$page_data['week'] = $week;
			}
		
		$page_data['page_name']  = 'teacher_timetable';
        $page_data['page_title'] = get_phrase('timetable');
		
		//$page_data['student_id'] = $student_id;
		$this->load->view('backend/index', $page_data);
		}
		
	}
	function get_student_list_markid($class_id)
	{
		$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
		echo '<option value="">Select Student</option>';
		foreach ($get_student_list as $row_value){
			echo '<option value="'.$row_value['student_id'].'">' . $row_value['name'] . '</option>';
		 }
	}
	function teacher_lists($param='')
	{
	
		if($param=='subject')
		{
		$subject_name  = $this->input->post('subject_name');
	
		$page_data['page_name']  = 'subject_wise_teacher';
        $page_data['page_title'] = get_phrase('Teacher List');
		$page_data['subject_name'] = $subject_name;
		//$page_data['student_id'] = $student_id;
		$this->load->view('backend/index', $page_data);
		}
		elseif($param=='class_wise')
		{
		$class_id  = $this->input->post('class_id');
			
		$page_data['page_name']  = 'class_wise_teacher';
        $page_data['page_title'] = get_phrase('Teacher List');
		
		$page_data['class_id'] = $class_id;
		$this->load->view('backend/index', $page_data);	
		}
		elseif($param=='standard_wise')
		{
			$standard_id  = $this->input->post('standard_id');
			
		$page_data['page_name']  = 'standard_wise_teacher';
        $page_data['page_title'] = get_phrase('Teacher List');
		
		$page_data['standard_id'] = $standard_id;
		$this->load->view('backend/index', $page_data);	
			
		}
		elseif($param=='all_teacher')
		{
		$page_data['page_name']  = 'all_teacher_list';
        $page_data['page_title'] = get_phrase('Teacher List');
		
		$page_data['standard_id'] = $standard_id;
		$this->load->view('backend/index', $page_data);	
		}
		
	}
	function parent_list()
	{
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")	
		{
			$class_id = $this->input->post("class_id");
		//$student_id = $this->input->post("student_id");
		
		$page_data['page_name']  = 'parent_list';
        $page_data['page_title'] = get_phrase('parent_list');
		$page_data['class_id'] = $class_id;
		//$page_data['student_id'] = $student_id;
		$this->load->view('backend/index', $page_data);
		}
	}
	
	function getstudents($class_id = '')
	{
		
			$students = $this->db->get_where("student",array("class_id"=>$class_id))->result_array();
			echo '<option value="">Select Student</option>';
			foreach ($students as $row_value){
			echo '<option value="'.$row_value['student_id'].'">' . $row_value['name'] . '</option>';
		 }
	}
	public function share_materials_pdf()
	{
			$html =  utf8_encode($this->load->view('backend/teacher/share_materials_pdf', $data, true));		
		$pdfFilePath = "share_materials.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	public function sidebar_holiday_pdf()
	{
			$html =  utf8_encode($this->load->view('backend/teacher/sidebar_holiday_pdf', $data, true));		
		$pdfFilePath = "sidebar_holiday.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	public function student_attendance_pdf(){
		$data['class_id'] = $this->input->post('class_id');
		$data['student_id'] = $this->input->post('student_id');
		$html =  utf8_encode($this->load->view('backend/teacher/student_attendance_pdf', $data, true));		
		$pdfFilePath = "student_attendance.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	public function non_teaching_pdf()
	{
		$html =  utf8_encode($this->load->view('backend/teacher/non_teaching_pdf', $data, true));		
		$pdfFilePath = "non_teaching_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	/*    */
	
	function staff_attendence_pdf(){
			$html =  utf8_encode($this->load->view('backend/teacher/staff_attendence_pdf', $data, true));		
		$pdfFilePath = "staff_attendence.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
	function attendance($param ='')
	{
		if($param=='class_wise_attendance')
		{
		$page_data['class_id'] = $this->input->post('class_id');
		$page_data['student_id'] = $this->input->post('student_id');
			$page_data['page_name']  = 'attendance_class_wise';
      	  $page_data['page_title'] = 'Attendance';
      	  $this->load->view('backend/index', $page_data);
		}
		elseif($param=='self_attendance')
		{
			$page_data['page_name']  = 'staff_attendence_list';
      	  $page_data['page_title'] = 'Attendance';
      	  $this->load->view('backend/index', $page_data);
		}
			
	}
	
	public function exam_mark_pdf($param1 = '' , $param2 = '')
	{
		if($param1 == "class_wise_exam"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');
			$data['exam_id']     = $this->input->post('exam_id');
			$html =  utf8_encode($this->load->view('backend/teacher/class_wise_exam_pdf', $data, true));		
			$pdfFilePath = "class_wise_exam.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "student_mark"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');
			$data['exam_id']     = $this->input->post('exam_id');
			$data['student_id']     = $this->input->post('student_id');
			$html =  utf8_encode($this->load->view('backend/teacher/student_mark_pdf', $data, true));		
			$pdfFilePath = "student_mark.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "class_wise_top3_student"){		
			$data = array();
			$data['class_id']    = $this->input->post('class_id');
			$data['exam_id']     = $this->input->post('exam_id');
			$html =  utf8_encode($this->load->view('backend/teacher/class_wise_top3_student_pdf', $data, true));		
			$pdfFilePath = "class_wise_top3_student.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "subject_wise_top3_student"){		
			$data = array();
			$data['subject']    = $this->input->post('subject');
			$data['standard']     = $this->input->post('standard');
			$html =  utf8_encode($this->load->view('backend/teacher/subject_wise_top3_student_pdf', $data, true));		
			$pdfFilePath = "subject_wise_top3_student.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
	}
	
	function reports($param = '')
	{
		
		if($param=='ind_student')
		{
		$page_data['page_name']  = 'sidebar_ind_student';
      	  $page_data['page_title'] = 'Individual Student Report';
      	  $this->load->view('backend/index', $page_data);
		}
		elseif($param=='parent_list')
		{
		$page_data['page_name']  = 'parent_list';
      	  $page_data['page_title'] = 'Parent List';
      	  $this->load->view('backend/index', $page_data);
		}
		elseif($param=='non_teaching_list')
		{
			$page_data['page_name']  = 'non_teaching_list';
      	  $page_data['page_title'] = 'Non-Teaching Staff Listing';
      	  $this->load->view('backend/index', $page_data);
		}
		elseif($param=='teacher_lists')
		{
			$page_data['page_name']  = 'teacher_list';
      	  $page_data['page_title'] = 'Teacher List';
      	  $this->load->view('backend/index', $page_data);
		}
		elseif($param=='timetable')
		{
			$page_data['page_name']  = 'teacher_timetable';
        	$page_data['page_title'] = get_phrase('timetable');
			$this->load->view('backend/index', $page_data);	
		}
		elseif($param=='attendance')
		{
			$page_data['page_name']  = 'attendance_class_wise';
        	$page_data['page_title'] = get_phrase('attendance');
			$this->load->view('backend/index', $page_data);	
			
		}
		elseif($param=='holiday')
		{
			$page_data['page_name']  = 'sidebar_holiday_list';
        	$page_data['page_title'] = get_phrase('Holiday');
			$this->load->view('backend/index', $page_data);	
		}
		elseif($param=='study_materials')
		{
			$page_data['page_name']  = 'share_materials_list';
        	$page_data['page_title'] = get_phrase('Study_Materials');
			$this->load->view('backend/index', $page_data);	
		}
		elseif($param=='exam_list')
		{
			$page_data['page_name']  = 'exam_mark_list';
      	  $page_data['page_title'] = 'Exam List';
      	  $this->load->view('backend/index', $page_data);
		}
		elseif($param=='marks')
		{
			$page_data['page_name']  = 'student_mark_list';
        	$page_data['page_title'] = get_phrase('Marks');
			
	
			$this->load->view('backend/index', $page_data);
			
		}
	}
	function get_exam_list_mark($class_id)
	{
		$this->db->group_by('name');
		$get_student_list = $this->db->get_where('exam' , array('class_id' => intval($class_id)))->result_array();
		echo '<option value="">Select Exam</option>';
		foreach ($get_student_list as $row_value){
			echo '<option value="'.$row_value['name'].'">' . $row_value['name'] . '</option>';
		 }
	}
	// Herry 
	function get_exam($class_id)
    {
		
		$this->db->group_by('name');
        $exam = $this->db->get_where('exam' , array('class_id' => $class_id))->result_array();
		
		if($exam[0] == ""){
			echo '<option value="">No Exam</option>';
		}else{
			echo '<option value="">Select Exam</option>';
	    	foreach ($exam as $row) {
           	 echo '<option value="'.$row['exam_id'].'">'.$row['name'].'</option>';
        	}
		}
    }
	public function exam_list($param=null)
	{
		
		if($param=="class_wise_exam")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['exam_id']     = $this->input->post('exam_id');
			$page_data['page_name']  = 'class_wise_exam_list';
       		$page_data['page_title'] = get_phrase('Exams');
	
			$this->load->view('backend/index', $page_data);
		}elseif($param=="student_mark")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['exam_id']     = $this->input->post('exam_id');
			$page_data['student_id']     = $this->input->post('student_id');
			$res = $this->db->get_where("student",array("student_id"=>$page_data['student_id']))->result_array();
			$page_data['student_name'] = $res[0]['name'];
			$page_data['page_name']  = 'student_mark_list';
       		$page_data['page_title'] = get_phrase('Marks');
	
			$this->load->view('backend/index', $page_data);
			
		}elseif($param=="class_wise_top3_student")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['exam_id']     = $this->input->post('exam_id');
			$page_data['student_id']     = $this->input->post('student_id');
			$page_data['page_name']  = 'class_wise_top3_student_list';
       		$page_data['page_title'] = get_phrase('Marks');
	
			$this->load->view('backend/index', $page_data);
		}elseif($param=="subject_wise_top3_student")
		{
			
			$page_data['subject']    = $this->input->post('subject');
			$page_data['standard']     = $this->input->post('standard');
			$page_data['page_name']  = 'subject_wise_top3_student_list';
       		$page_data['page_title'] = get_phrase('Marks');
	
			$this->load->view('backend/index', $page_data);
			
		}
		else
		{
			$page_data['page_name']  = 'sidebar_exam_mark_list';
        $page_data['page_title'] = get_phrase('exam_and_mark');
	
		$this->load->view('backend/index', $page_data);
		}
		
	}
public function getweeks()
 {
  $month = $this->input->post("month");
     $year=date("Y");
     
     $num_of_days = date("t", mktime(0,0,0,$month,1,$year));
     $date = "01-".$month."-".$year;
  $monthName = date("F", mktime(0, 0, 0, $month, 10));
  $datename =  date('D', strtotime($date));
  if($datename=="Mon")
  {
   $start_day_of_week = 1;
  }
  if($datename=="Tue")
  {
   $start_day_of_week = 2;
  }
  
  if($datename=="Wed")
  {
   $start_day_of_week = 3;
  }
  if($datename=="Thu")
  {
   $start_day_of_week = 4;
  }
  
  if($datename=="Fri")
  {
   $start_day_of_week = 5;
  }
  if($datename=="Sat")
  {
   $start_day_of_week = 1;
  }
  if($datename=="Sun")
  {
   $start_day_of_week = 0;
  }
  
  $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

  $week_day = date("N", mktime(0,0,0,$month,$start_day_of_week,$year));

  $weeks = ceil(($days + $week_day) / 7);

  echo $weeks; 
 }
	
	
	
	




}
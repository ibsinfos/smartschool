<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Lorebrain
 *	Date	: 02 Nov, 2015
 *  Name:-Institute Management System
 *	http://www.searchnative.in/hosting/loreBrain/
 */

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		error_reporting(0);
		$this->load->driver('cache');
		$this->cache->clean();
		$this->output->cache(0);
		$this->output->nocache();
		date_default_timezone_set('Asia/Kolkata');
				
		// Check Login 
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        // Set Academy Year
		 $get_academic_year = $this->db->get_where('academic_year', array('current_year_status'=>'active'))->row();
         $data = array('start_date' => $get_academic_year->start_date,'end_date' =>  $get_academic_year->end_date, 'is_logged_in' => TRUE);
		 $this->session->set_userdata('start_date', $get_academic_year->start_date);
         $this->session->set_userdata('end_date', $get_academic_year->end_date);

	}
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    function dashboard()
    {
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    function admin($param1='',$param2='',$param3='')
    {
		 if ($param1 == 'create')
		 {
			$data['name']       	= $this->input->post('fullname');
			$data['father_name']    = $this->input->post('father_name');
			$data['mother_name']    = $this->input->post('mother_name');			
		    $data['birthdate']   	= $this->input->post('birthday');
		    $data['sex']   	   		= $this->input->post('sex');
		    $data['blood_group']    = $this->input->post('blood_group');
		   	$data['address']    	= $this->input->post('address');
		    $data['phone']      	= $this->input->post('phone_code').",".$this->input->post('phone');           
		    $data['password']  		= md5($this->input->post('password'));
			$data['pass']  	        = $this->input->post('password');
			$data['email']  		= $this->input->post('email');
			$data['level']  		= 2;
			
$duplicate_admin_email = $this->db->get_where('admin', array('email' => $this->input->post('email'),'level !=' => 1))->num_rows();		
$duplicate_student_email = $this->db->get_where('student', array('email' => $this->input->post('email')))->num_rows();
$duplicate_parent_email = $this->db->get_where('parent', array('parent_email' => $this->input->post('email')))->num_rows();
$duplicate_teacher_email = $this->db->get_where('teacher', array('email' => $this->input->post('email')))->num_rows();

			if($duplicate_student_email > 0 || $duplicate_parent_email > 0 || $duplicate_teacher_email > 0 || $duplicate_admin_email >0)
			{
				$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));
				redirect(base_url() . 'index.php?admin/admin' , 'refresh');
			}
			else
			{
				$this->db->insert('admin',$data);
				$admin_id = $this->db->insert_id();
					 
			   	if($_FILES['userfile']['name'] != "")
				{
					move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/'.$admin_id.".jpg");
					$data_update['admin_image']=$admin_id.".jpg";
					$this->db->where('admin_id', $admin_id);
		   	   		$this->db->update('admin', $data_update);
				}
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully')); 
			 }
			 redirect(base_url() . 'index.php?admin/admin/', 'refresh');
		 }
		 if ($param1 == 'do_update')
		 {
			$data['name']       	= $this->input->post('fullname');
			$data['father_name']    = $this->input->post('father_name');
			$data['mother_name']    = $this->input->post('mother_name');			
			$data['birthdate']   	= $this->input->post('birthday');
			$data['sex']        	= $this->input->post('sex');
			$data['address']    	= $this->input->post('address');
			$data['phone']      	= $this->input->post('phone_code').",".$this->input->post('phone');           
			$data['password']  		= md5($this->input->post('password'));
			$data['pass']  			= $this->input->post('password');
			$data['email']  		= $this->input->post('email');
			$data['level']  		= 2;
			
$duplicate_admin_email = $this->db->get_where('admin', array('email' => $this->input->post('email'),'admin_id !=' =>$param2 ))->num_rows();		
$duplicate_student_email = $this->db->get_where('student', array('email' => $this->input->post('email')))->num_rows();
$duplicate_parent_email = $this->db->get_where('parent', array('parent_email' => $this->input->post('email')))->num_rows();
$duplicate_teacher_email = $this->db->get_where('teacher', array('email' => $this->input->post('email')))->num_rows();

			if($duplicate_student_email > 0 || $duplicate_parent_email > 0 || $duplicate_teacher_email > 0 || $duplicate_admin_email >0)
			{
					$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));
					redirect(base_url() . 'index.php?admin/admin' , 'refresh');
		    }
			else
			{
				     if($_FILES['userfile']['name'] != "")
				     {
						unlink("uploads/admin_image/".$param2.".jpg"); 
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/'.$param2.".jpg");
						$data['admin_image']=$param2.".jpg";
				     }
				     $this->db->where('admin_id', $param2);
		   	   	     $this->db->update('admin', $data);
				     $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully')); 
			}
			redirect(base_url() . 'index.php?admin/admin/', 'refresh');
	 	}
		if ($param1 == 'delete')
 		{
            $this->db->where('admin_id', $param2);
            $this->db->delete('admin');
			$path = "uploads/admin_image/".$param2.'.jpg';
			unlink($path);				
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/admin/', 'refresh');
        }
		$page_data['page_name']  = 'admin';
		$page_data['page_title'] = 'Admin';
		$page_data['admin']=$this->db->get_where('admin',array('level !='=>'1'))->result_array();
		$this->load->view('backend/index', $page_data);
    }

    function student_management()
    {
		$page_data['page_name']  = 'student_management';
		$page_data['page_title'] = 'Student Management';
		$this->load->view('backend/index', $page_data);
    }
    function student($param1 = '', $param2 = '', $param3 = '')
    {
		$this->load->library('form_validation');	
        if ($param1 == 'create')
		{
		    	$data['name']       	= $this->input->post('name');
				$data['father_name']    = $this->input->post('father_name');
				$data['mother_name']    = $this->input->post('mother_name');			
           		$data['birthday']   	= $this->input->post('birthday');
            	$data['sex']        	= $this->input->post('sex');
            	$data['blood_group']    = $this->input->post('blood_group');
            	$data['address']    	= $this->input->post('address');
            	$data['phone']      	= $this->input->post('phone_code').",".$this->input->post('phone');           
            	$data['std_status']     = $this->input->post('std_status');
            	$data['password']  	= md5($this->input->post('password'));
				$data['roll']           = $this->input->post('roll');
		if(empty($data['roll']))
		{
			$this->session->set_flashdata('flash_message' , get_phrase('Please_enter_roll_number'));
			redirect(base_url() . 'index.php?admin/student_management/' , 'refresh');
		}
		if($data['roll'] != "")
		{
			$duplicate_roll = $this->db->get_where('student', array('roll' => $this->input->post('roll')))->num_rows();
      	}
		$data['class_id']   = $this->input->post('class_id');
        $data['real_pass']   = $this->input->post('password');           
$duplicate_student_email = $this->db->get_where('student', array('email' => $this->input->post('email')))->num_rows();
$duplicate_parent_email = $this->db->get_where('parent', array('parent_email' => $this->input->post('email')))->num_rows();
$duplicate_teacher_email = $this->db->get_where('teacher', array('email' => $this->input->post('email')))->num_rows();
$duplicate_admin_email = $this->db->get_where('admin', array('email' => $this->input->post('email')))->num_rows();
		
	      if($duplicate_roll > 0 )
	      { 
				$this->session->set_flashdata('flash_message' , get_phrase('Roll_number_already_exist'));
				redirect(base_url() . 'index.php?admin/student_management/' , 'refresh');
	      }
	      	if($duplicate_student_email > 0 || $duplicate_parent_email > 0 || $duplicate_teacher_email > 0 || $duplicate_admin_email >0)
	      	{
				$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));
				redirect(base_url() . 'index.php?admin/student_management/' , 'refresh');
	      	}	
	      	else
	      	{
				$data['email']= $this->input->post('email');
				$this->db->insert('student', $data);
				$student_id = $this->db->insert_id();
				if($_FILES['userfile']['name'] != "")
				{
					$ext=pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
					$data_Id_num['student_image'] = $student_id.'.'.$ext;
					move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/'.$data_Id_num['student_image']);
			 	}
			 	$data_Id_num['identification_num']   = $student_id;
			 	$this->db->where('student_id', $student_id);
           	 	$this->db->update('student', $data_Id_num);
			 	$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));			
	      	}
	      	$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/student_management/' , 'refresh');
        }
        if ($param2 == 'do_update') 
		{
            	$data['name']       	= $this->input->post('name');
				$data['father_name']    = $this->input->post('father_name');
				$data['mother_name']    = $this->input->post('mother_name');			
            	$data['birthday']   	= $this->input->post('birthday');
            	$data['sex']        	= $this->input->post('sex');
            	$data['blood_group']    = $this->input->post('blood_group');
            	$data['address']    	= $this->input->post('address');
            	$data['phone']      	= $this->input->post('phone_code').",".$this->input->post('phone');
            	$data['email']      	= $this->input->post('email');
				$data['std_status']     = $this->input->post('std_status');
            	$data['password']  	= md5($this->input->post('password'));
            	$data['roll']           = $this->input->post('roll');
            	$data['class_id']       = $this->input->post('class_id');
				$data['real_pass']      = $this->input->post('password');
			
$duplicate_rollno=$this->db->get_where('student',array('roll'=>$this->input->post('roll')))->num_rows();
$student_email_duplicate = $this->db->get_where('student', array('email' => $this->input->post('email'),'student_id !=' => $param3))->num_rows();
$parent_email_duplicate = $this->db->get_where('parent', array('parent_email' => $this->input->post('email')))->num_rows();
$teacher_email_duplicate = $this->db->get_where('teacher', array('email' => $this->input->post('email')))->num_rows();
$duplicate_admin_email = $this->db->get_where('admin', array('email' => $this->input->post('email')))->num_rows();
		if($_FILES['userfile']['name'] !="")
		{
	   		unlink("uploads/student_image/".$param3."jpg");   
    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/'.$param3.".jpg");
			$data['student_image'] = $param3.'.jpg';
   		}
		if($duplicate_rollno > 0)
		{
			$this->session->set_flashdata('flash_message' , get_phrase('Roll No Already Exist'));
		}
		if($student_email_duplicate > 0 || $parent_email_duplicate > 0 || $teacher_email_duplicate > 0 || $duplicate_admin_email > 0)
		{
			$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));
		}
		else
		{
		    $this->db->where('student_id', $param3);
        	$this->db->update('student', $data);
     		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
		}
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/student_management/', 'refresh');
        } 
			
        if ($param1 == 'delete') 
		{
        	$this->db->where('student_id', $param2);
        	$this->db->delete('student');
	    	$path = "uploads/student_image/" . $param2.'.jpg';
	    	unlink($path);				
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/student_management/' . $param2, 'refresh');
        }
    }
	/***** Check Roll in student Module 
	  By : Brijesh Dhami****/
	function check_roll($roll = '' ,$edit_roll = '')
	{		
		if(!empty($_POST['roll']) && !empty($_POST['id'])) 
		{
			  $query = $this->db->get_where('student', array('roll' => $_POST['roll'] ,'student_id !=' => $_POST['id']));
			  $user_count = $query->num_rows();
			  if($user_count>0) 
			  {
				  echo "<span class='status-not-available' style='color:red'> Rollno Is Already Insert.</span>";
			  }
		}
		elseif(!empty($_POST['roll']) || !empty($_POST['id'])) 
		{
			$query = $this->db->get_where('student', array('roll' => $_POST['roll']));
			$user_count = $query->num_rows();
			if($user_count>0) 
			{
				echo "<span class='status-not-available' style='color:red'> Rollno Is Already Insert.</span>";
			}		
		}			
	}
	
	function check_email($email = '' ,$edit_std = '')
	{		
		if(!empty($_POST['email']) && !empty($_POST['id'])) 
		{
			 $query = $this->db->get_where('student', array('email' => $_POST['email'],'student_id !=' => $_POST['id']));
			 $tech = $this->db->get_where('teacher', array('email' => $_POST['email'],'teacher_id !=' => $_POST['id']));
			 $par = $this->db->get_where('parent', array('parent_email' => $_POST['email']));
			 $email_count = $query->num_rows();			  
			 $email_tech = $tech->num_rows();			  
			 $email_par = $par->num_rows();	
			 if($email_count>0 || $email_tech>0 || $email_par>0)
			 {
				  echo "<span class='status-not-available' style='color:red'> Email Is Already Exists.</span>";
   		         }
		}
		elseif(!empty($_POST['email']) || !empty($_POST['id'])) 
		{			
			 $query = $this->db->get_where('student', array('email' => $_POST['email']));
			 $tech = $this->db->get_where('teacher', array('email' => $_POST['email']));
			 $par = $this->db->get_where('parent', array('parent_email' => $_POST['email']));
			 $email_count = $query->num_rows();			  
			 $email_tech = $tech->num_rows();			  
			 $email_par = $par->num_rows();			  
			 if($email_count>0 || $email_tech>0 || $email_par>0) 
			 {
				  echo "<span class='status-not-available' style='color:red'> Email Is Already Exists.</span>";
			 }
		}		
	}
	
	function check_par_email($email = '')
	{		
		if(!empty($_POST['email'])) 
		{
			 $query = $this->db->get_where('student', array('email' => $_POST['email']));
			 $tech = $this->db->get_where('teacher', array('email' => $_POST['email']));			 
			 $email_count = $query->num_rows();			  
			 $email_tech = $tech->num_rows();	
			 if($email_count>0 || $email_tech>0) 
			 {
				echo "<span class='status-not-available' style='color:red'> Email Is Already Exists.</span>";
			 }
		}		
	}
     /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create')
		{
			$data['name']          = $this->input->post('father_name');
			$data['mother_name']   = $this->input->post('mother_name');
            $data['parent_email']  = $this->input->post('email');
            $data['password']      = md5($this->input->post('password'));
           	$data['phone']         = $this->input->post('phone_code').",".$this->input->post('phone');
            $data['address']       = $this->input->post('address');
			$data['real_pass'] 	   = $this->input->post('password');
			$data['student_id']    = $this->input->post('student_id');
			$data['class_id'] 	   = $this->input->post('class_id');
			
			$duplicate_student=$this->db->get_where('parent',array('student_id'=>$data['student_id']))->num_rows();	
			if($duplicate_student >0)
			{
				$this->session->set_flashdata('flash_message' , get_phrase('data_already_exists'));
			}
			else
			{
				$this->db->insert('parent', $data);
				$inserted_id = $this->db->insert_id();
				$ssdata['parent_email']       	= $this->input->post('email');
				$ssdata['parent_real_pass']     = $this->input->post('password');
				$ssdata['parent_pass']       	= md5($this->input->post('password'));
				$parentdata['parent_identification']     = $inserted_id;
			
				if($_FILES['userfile']['name'] !="")
				{
	   				move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/'.
					$inserted_id.".jpg");
					$parentdata['parent_image'] = $inserted_id.'.jpg';
   				}
				$this->db->where('parent_id' , $inserted_id);
            	$this->db->update('parent' , $parentdata);
				$this->db->where('student_id' ,$this->input->post('student_id'));
            	$this->db->update('student' , $ssdata);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			}
            		redirect(base_url() . 'index.php?admin/student_management/', 'refresh');
        }
        if ($param1 == 'edit')
		{
            	$data['name']        			= $this->input->post('name'); 
				$data['mother_name'] 			= $this->input->post('mother_name');
				$data['parent_email']       		= $this->input->post('email');			
            	$data['password']    			= md5($this->input->post('password'));
            	$data['phone']       			= $this->input->post('phone_code').",".$this->input->post('phone');
            	$data['address']     			= $this->input->post('address');			
				$data['real_pass'] 			= $this->input->post('password');
			
			if($_FILES['userfile']['name'] !="")
			{
	   			unlink("uploads/parent_image/".$param2.".jpg");   
	    		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/'.
				$param2.".jpg");
				$data['parent_image'] = $param2.'.jpg';
   			}
		        $this->db->where('parent_id' , $param2);
            	$this->db->update('parent' , $data);
			
			$ssdata['parent_email']       	= $this->input->post('email');
			$ssdata['parent_real_pass']     = $this->input->post('password');
			$ssdata['parent_pass']       	= md5($this->input->post('password'));
			
			$this->db->where('student_id' ,$this->input->post('student_id'));
           	$this->db->update('student' , $ssdata);
			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'delete')
		{
		    $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
		    $path = "uploads/parent_image/" . $param2.'.jpg';
		    unlink($path);
        	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
	$parent_list = $this->crud_model->get_parent();	
	$page_data['parent_list'] = $parent_list ;
        $page_data['page_title'] 	= get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }
    /********** MANAGE Staff  *************/
    function staff($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') 
		{
	    	$data['teaching_type']      = $this->input->post('teaching_type');
            $data['name']        	= $this->input->post('name');
            $data['father_name']        = $this->input->post('father_name');
            $data['mother_name']        = $this->input->post('mother_name');
            $data['birthday']    	= $this->input->post('birthday');
            $data['sex']         	= $this->input->post('sex');
            $data['blood_group']        = $this->input->post('blood_group');
            $data['address']     	= $this->input->post('address');
            $data['phone']       	= $this->input->post('phone_code').",".$this->input->post('phone');
            $data['email']       	= $this->input->post('email');
            $data['password']   	= md5($this->input->post('password'));
            $data['real_pass']   	= $this->input->post('password');
	    	$data['designation']   	= $this->input->post('designation');
            $data['stf_status']    	= $this->input->post('stf_status');
			
	    if($data['teaching_type'] == 1)
	    {
	     	$fileName     = $_FILES["uploadcv"]["name"];				
			$random       =rand(1111,9999);
			$data['file_name'] =$random.$fileName;
			move_uploaded_file($_FILES["uploadcv"]["tmp_name"], "uploads/teacher_resume/" . $data['file_name']);
        }
$duplicate_email_teacher=$this->db->get_where('teacher',array('email'=>$data['email'],'teacher_id !='=>$param2))->num_rows();
$duplicate_email_parent=$this->db->get_where('parent',array('parent_email'=>$data['email']))->num_rows();
$duplicate_email_student=$this->db->get_where('student',array('email'=>$data['email']))->num_rows();
$duplicate_admin_email = $this->db->get_where('admin', array('email' =>$data['email']))->num_rows();
	   	if($duplicate_email_teacher>0 || $duplicate_email_parent >0 || $duplicate_email_student >0 || $duplicate_admin_email >0 )
	   	{
			$this->session->set_flashdata('flash_message' , get_phrase('Email Already Exists'));
	   	}
	   	else
	    {
           	$teacher_id=$this->db->insert('teacher', $data);
	        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        }
	   	if($_FILES['userfile']['name'] != '')
	   	{
			unlink("uploads/teacher_image/".$teacher_id.".jpg");  
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
			$data1['staff_image']  = $teacher_id.'.jpg';
			$this->db->where('teacher_id', $teacher_id);
            $this->db->update('teacher', $data1);
        }
	   else 
	   {
		
	   }
	   $data_Id_num['identification_num']   = $teacher_id;
	   $this->db->where('teacher_id', $teacher_id);
           $this->db->update('teacher', $data_Id_num);
           redirect(base_url() . 'index.php?admin/staff/', 'refresh');
        }
        if ($param1 == 'do_update') 
		{
	    	$data['teaching_type']      = $this->input->post('teaching_type');
            $data['name']        	= $this->input->post('name');
            $data['father_name']        = $this->input->post('father_name');
            $data['mother_name']        = $this->input->post('mother_name');
            $data['birthday']    	= $this->input->post('birthday');
            $data['sex']         	= $this->input->post('sex');
            $data['blood_group']        = $this->input->post('blood_group');
            $data['address']     	= $this->input->post('address');
            $data['phone']       	= $this->input->post('phone_code').",".$this->input->post('phone');
            $data['email']       	= $this->input->post('email');
            $data['password']   	= md5($this->input->post('password'));
            $data['real_pass']   	= $this->input->post('password');
            $data['designation']   	= $this->input->post('designation');
            $data['stf_status']    	= $this->input->post('stf_status');
			
	    if($data['teaching_type'] == 1 && $_FILES["uploadcv"]["name"] != '')
	    {				
			$temp_resume= $this->input->post('temp_resume');
			$path = "uploads/teacher_resume/" . $temp_resume;
			unlink($path);
			$fileName     = $_FILES["uploadcv"]["name"];				
			$random=rand(111111,999999);
			$data['file_name'] =$random.$fileName;
			move_uploaded_file($_FILES["uploadcv"]["tmp_name"], "uploads/teacher_resume/" . $data['file_name']);
            }
	    if($_FILES['userfile']['name'] != "")
	    {
			unlink("uploads/teacher_image/".$param2.".jpg");
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2. '.jpg');
			$data['staff_image']  = $param2.'.jpg';
	    }
$duplicate_email_teacher=$this->db->get_where('teacher',array('email'=>$data['email'],'teacher_id !='=>$param2))->num_rows();
$duplicate_email_parent=$this->db->get_where('parent',array('parent_email'=>$data['email']))->num_rows();
$duplicate_email_student=$this->db->get_where('student',array('email'=>$data['email']))->num_rows();
$duplicate_admin_email = $this->db->get_where('admin', array('email' =>$data['email']))->num_rows();
	if($duplicate_email_teacher>0 || $duplicate_email_parent >0 || $duplicate_email_student >0 || $duplicate_admin_email >0 )
	{
		 $this->session->set_flashdata('flash_message' , get_phrase('Email Already Exists'));
	}
	else
	{
        $this->db->where('teacher_id', $param2);
        $this->db->update('teacher', $data);
		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
	}
    redirect(base_url() . 'index.php?admin/staff/', 'refresh');
    }
	else if ($param1 == 'personal_profile') 
	{
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
    }
	else if ($param1 == 'edit') 
	{
            $page_data['edit_data'] = $this->db->get_where('teacher', array('teacher_id' => $param2))->result_array();
    }
    if ($param1 == 'delete') 
	{
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $path = "uploads/teacher_image/" . $param2.'.jpg';
	    	unlink($path);
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/staff/', 'refresh');
    }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'staff';
        $page_data['page_title'] = 'Manage Staff';
        $this->load->view('backend/index', $page_data);
    }	
	/********** MANAGE Studey Materials ********************/
    function share_material($param1 = '', $param2 = '', $param3 = '')
    {
		
        if ($param1 == 'create')
		{
            $data['class_id']  = $this->input->post('class_id');
            $data['subject_id']= $this->input->post('subject_id');
            $data['topic_name']= $this->input->post('topic_name');           
	    	$fileName     = $_FILES["m_filename"]["name"];				
            $random = rand(1111,9999);
	    	$data['m_filename'] =$random.$fileName;
	    	move_uploaded_file($_FILES["m_filename"]["tmp_name"], "uploads/study_material/" . $data['m_filename']);
	    	$this->db->insert('share_material', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/share_material', 'refresh');
        }        
        if ($param1 == 'delete')
		{
			$mat=$this->db->get_where('share_material' , array('material_id' => $param2))->result_array();			
			$path = "uploads/study_material/" . $mat[0]['m_filename'];
			unlink($path);
            $this->db->where('material_id', $param2);
            $this->db->delete('share_material');
	        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/share_material', 'refresh');
        }
        $year_start_date=$this->session->userdata('start_date');
        $year_end_date=$this->session->userdata('end_date');
        $page_data['share_material'] = $this->db->get_where('share_material',array('created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array();
        $page_data['page_name']  = 'share_material';
        $page_data['page_title'] = "Share Study material";
        $this->load->view('backend/index', $page_data);
        
    }
    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') 
	{
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['password']    = $this->input->post('password');
            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        if ($param1 == 'do_update')
	{
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        } 
	else if ($param1 == 'personal_profile') 
	{
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
	else if ($param1 == 'edit') 
	{
            $page_data['edit_data'] = $this->db->get_where('teacher', array('teacher_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        
        if ($param1 == 'create')
	{
            $data['name']       = trim($this->input->post('name'));
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
	    $subject_duplicate_check=$this->db->get_where('subject',
	    array('name' => trim($this->input->post('name')),'class_id'=>$this->input->post('class_id')))->row();
	    if(count($subject_duplicate_check)>0)
	    {
		 $this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_duplicate_subject'));
	    }
	    else
	    {
             	 $this->db->insert('subject', $data);
            	 $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
	    }
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        if ($param1 == 'do_update') 
	{
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
			
            $subject_duplicate_check=$this->db->get_where('subject',
	    array('name' => trim($this->input->post('name')),'subject_id !='=>$param2))->row();
	    if(count($subject_duplicate_check)>0)
	    {
		 $this->session->set_flashdata('flash_message' , get_phrase('do_not_update_duplicate_subject'));
	    }
	    else
	    {
		$this->db->where('subject_id', $param2);
		$this->db->update('subject', $data);
		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
	    }
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
	else if ($param1 == 'edit') 
	{
            $page_data['edit_data'] = $this->db->get_where('subject', array('subject_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') 
	{
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/subject/'.$param3, 'refresh');
        }
        $page_data['subjects']   = $this->db->get('subject')->result_array();
	$page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = 'Manage Subject';
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($param1 == 'create') 
	{
		$data['class_id'] = $this->input->post('class_id');
                $data['teacher_id']   = $this->input->post('teacher_id');
		$this->db->where(array('teacher_id ' => $this->input->post('teacher_id'),'class_id ' => 
		$this->input->post('class_id')));
		$class_count=$this->db->count_all_results('teacher_class_association');
		if($class_count > 0)
		{
			$this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_value_again')); 
            		redirect(base_url() . 'index.php?admin/classes/', 'refresh');
		}
		else
		{
			$this->db->insert('teacher_class_association', $data);
		}
	        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') 
	{
		$data['class_id']     = $this->input->post('class_id');
                $data['teacher_id']   = $this->input->post('teacher_id');
			$this->db->where(array('teacher_id' => $this->input->post('teacher_id'),'class_id' => $this->input->post('class_id'),'tca_id !=' => $param2));
			$class_count=$this->db->count_all_results('teacher_class_association');
			if($class_count > 0)
			{
				$this->session->set_flashdata('flash_message' , get_phrase('do_not_update_duplicate_value'));
			}
			else
			{
				$this->db->where('tca_id', $param2);
	          		$this->db->update('teacher_class_association', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			}
	                redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } 
	else if ($param1 == 'edit') 
	{
		$page_data['edit_data'] = $this->db->get_where('teacher_class_association', array('tca_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') 
	{
            $this->db->where('tca_id', $param2);
            $this->db->delete('teacher_class_association');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = 'Manage Teacher-Class Association';
        $this->load->view('backend/index', $page_data);
    }
	
	/****MANAGE Holidays *****/
    function holiday($param1 = '', $param2 = '')
    {
        if ($param1 == 'create')
	{
        $data['holiday_name'] = $this->input->post('holiday_name');
        $data['holiday_date'] = $this->input->post('holiday_date');
	    $data['user_id'] = $this->input->post('user_id');
	    $data['holiday_detail'] = $this->input->post('holiday_detail');
	    $holiday_duplicate=$this->db->get_where('holiday',
	    array('holiday_date' =>$this->input->post('holiday_date')))->num_rows();

	    $today=date('d-m-Y');

	    if($holiday_duplicate>0)
	    {
			$this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_duplicate_holiday'));
	    }
	    else
	    {
	    	if (date('d-m-Y',strtotime($data['holiday_date'])) < $today) 
	    	{

	    		$this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_past_date'));
            }
            else
            {
            	$this->db->insert('holiday', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            }
	    }			
            redirect(base_url() . 'index.php?admin/holiday/', 'refresh');
        }
        if ($param1 == 'do_update') 
		{
            	$data['holiday_name']= $this->input->post('holiday_name');
            	$data['holiday_date'] = $this->input->post('holiday_date');
				$data['user_id'] = $this->input->post('user_id');
				$data['holiday_detail'] = $this->input->post('holiday_detail');
				$holiday_duplicate_check=$this->db->get_where('holiday',
				array('holiday_date' => trim($this->input->post('holiday_date')),'h_id !=' =>$param2))->row();

				$today=date('d-m-Y');

		if(count($holiday_duplicate_check)>0)
		{
			 $this->session->set_flashdata('flash_message' , get_phrase('do_not_update_duplicate_holiday'));
		}
		else
		{
			if (date('d-m-Y',strtotime($data['holiday_date'])) < $today) 
	    	{
	    		$this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_past_date'));
            }
            else
            {
	            $this->db->where('h_id', $param2);
	            $this->db->update('holiday', $data);
           		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
           	}
		}
                redirect(base_url() . 'index.php?admin/holiday/', 'refresh');
        } 
	else if ($param1 == 'edit') 
	{
            $page_data['edit_data'] = $this->db->get_where('holiday', array('h_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') 
		{
            $this->db->where('h_id', $param2);
            $this->db->delete('holiday');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/holiday/', 'refresh');
        }
        $year_start_date=$this->session->userdata('start_date');
        $year_end_date=$this->session->userdata('end_date');
        $page_data['holiday']    = $this->db->get_where('holiday',array('created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array();
        $page_data['page_name']  = 'holiday';
        $page_data['page_title'] = 'Manage Holiday';
        $this->load->view('backend/index', $page_data);
    }
	
    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
        foreach ($sections as $row)
	{
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array('class_id' => intval($class_id)))->result_array();
	echo '<option value="">Select Subject</option>';
        foreach ($subjects as $row) 
	{
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_teacher_using_subject($subject)
    {
	$this->db->join('teacher', 'teacher.teacher_id = subject.teacher_id');			
        $teachers = $this->db->get_where('subject' , array('subject_id' => $subject))->result_array();
	echo '<option value="">Select Teacher</option>';
        foreach ($teachers as $row) 
	{
            echo '<option value="' . $row['teacher_id'] . '">' . $row['name'] . '</option>';
        }
    }

    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($param1 == 'create') 
		{
			
	            $data['name']        = $this->input->post('name');
	            $data['class_id']    = $this->input->post('class_id');
	            $data['subject_id']  = $this->input->post('subject_id');
	            $data['date']        = $this->input->post('date');
      		    $data['time_start']  = $this->input->post('time_start');
		    	$data['time_end']    = $this->input->post('time_end');
		    	$data['out_of_marks']= $this->input->post('out_of_marks');
		    	$data['minimum_mark']= $this->input->post('minimum_mark');

		    $exam_duplicate_check=$this->db->get_where('exam',array('class_id' => trim($this->input->post('class_id')),'subject_id' => trim($this->input->post('subject_id')),'date' => trim($this->input->post('date'))))->row();
		    $get_holiday=$this->db->get_where('holiday',array('holiday_date'=>$data['date']))->num_rows();
			if(count($exam_duplicate_check)>0)
			{
				 $this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_duplicate_exam'));
			}
			else
			{
				if($get_holiday>0)
				{
					$this->session->set_flashdata('flash_message' , get_phrase('this_day_is_already_holiday'));			
				}
				else
				{
            			$this->db->insert('exam', $data);
            			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
				}
            		redirect(base_url() . 'index.php?admin/exam/', 'refresh');
           } 		
    }
    if ($param1 == 'exam_master') 
    {
			
            $data['master_exam_name']    = $this->input->post('master_exam_name');
            $master_exam_duplicate_check=$this->db->get_where('exam_master',
	    array('master_exam_name' => trim($this->input->post('master_exam_name'))))->row();
	    if(count($master_exam_duplicate_check)>0)
	    {
		 $this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_duplicate_exam'));
            }
	    else
	    {
            	$this->db->insert('exam_master', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
	    }
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') 
	{
            	$data['name']        = $this->input->post('name');
            	$data['class_id']    = $this->input->post('class_id');
				$data['subject_id']  = $this->input->post('subject_id');
            	$data['date']        = $this->input->post('date');
            	$data['time_start']  = $this->input->post('time_start');
				$data['time_end']    = $this->input->post('time_end');
				$data['out_of_marks']= $this->input->post('out_of_marks');
				$data['minimum_mark']= $this->input->post('out_of_marks');
				
				$exam_duplicate_check=$this->db->get_where('exam',array('class_id' => trim($this->input->post('class_id')),'subject_id' => trim($this->input->post('subject_id')),'date' => trim($this->input->post('date')),'exam_id !=' => $param3))->row();
				$get_holiday=$this->db->get_where('holiday',array('holiday_date'=>$data['date']))->num_rows();
		if(count($exam_duplicate_check)>0)
		{
			 $this->session->set_flashdata('flash_message' , get_phrase('do_not_update_duplicate_exam'));
		}
		else
		{
			if($get_holiday>0)
			{
				$this->session->set_flashdata('flash_message' , get_phrase('this_day_is_already_holiday'));			
			}
			else
			{
				$this->db->where('exam_id', $param3);	
	        	$this->db->update('exam', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			}	

	        
		}
          	 redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } 
	else if ($param1 == 'edit') 
	{
            $page_data['edit_data'] = $this->db->get_where('exam', array('exam_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') 
	{
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        
        if ($param1 == 'do_update')
	{
			
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone_code').",".$this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('userfile');
            $this->db->where('type' , 'userfile');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);
			
	    $as = move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/system_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') 
		{
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') 
		{
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh'); 
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($param1 == 'clickatell') 
	{
            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') 
		{
            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') 
	{

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'update_profile_info') 
	{
		if(!empty($_POST))
		{
			$data['name']  = $this->input->post('name');
			$data['father_name'] = $this->input->post('father_name');
			$data['mother_name']  = $this->input->post('mother_name');
			$data['birthdate'] = $this->input->post('birthdate');
			$data['sex']  = $this->input->post('sex');
			$data['blood_group'] = $this->input->post('blood_group');
			$data['address']  = $this->input->post('address');
			$data['phone'] = $this->input->post('phone');
			$data['email'] = $this->input->post('email');
			$data['password']   = md5($this->input->post('password'));				
			$data['pass']   = $this->input->post('password');
			$admin_email_duplicate = $this->db->get_where('admin', array('email' => $this->input->post('email'),'admin_id !=' => $this->session->userdata('admin_id')))->num_rows();		
			$student_email_duplicate = $this->db->get_where('student', array('email' => $this->input->post('email')))->num_rows();
			$parent_email_duplicate = $this->db->get_where('parent', array('parent_email' => $this->input->post('email')))->num_rows();
			$teacher_email_duplicate = $this->db->get_where('teacher', array('email' => $this->input->post('email')))->num_rows();
			
			if($_FILES['userfile']['name'] != "")
		 	{
				unlink("uploads/admin_image/".$this->session->userdata('admin_id').".jpg"); 
				move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
			}
		}	
		if($student_email_duplicate > 0 || $parent_email_duplicate > 0 || $teacher_email_duplicate > 0 || $admin_email_duplicate > 0)
		{
			$this->session->set_flashdata('flash_message' , get_phrase('Email_already_exist'));	
		}
		else
		{				   
				$this->db->where('admin_id', $this->session->userdata('admin_id'));
				$this->db->update('admin', $data);
				$this->session->set_flashdata('flash_message', get_phrase('profile_updated'));
		}
		redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /* Develop By Hardik Bhut 16-december-2015 */
    function get_classes($class_id)
    {
    	$year_start_date=$this->session->userdata('start_date');
        $year_end_date=$this->session->userdata('end_date');   
	  $get_student_list = $this->db->get_where('student' , array('class_id' => $class_id,'curr_date >='=>$year_start_date,'curr_date <='=>$year_end_date))->result_array();
	  echo '<option value="">Select Student</option>';
	  foreach ($get_student_list as $row_value)
	  {
			echo '<option value="' . $row_value['student_id'] . '">' . $row_value['name'] . '</option>';
	  }
    }
    /* Develop By Brijesh Bhut 24-december-2015 */
    function get_parent_name($class_id)
    {		 
	$get_student_list = $this->db->get_where('student' , array('student_id' => $class_id))->result_array(); 
	foreach ($get_student_list as $row_value)
	{
		echo '<input type="text" name="father_name" class="form-control" value="'. $row_value['father_name'] .'" readonly />';
        }
    }
    function get_mother_name($class_id)
    {		 
	$get_student_list = $this->db->get_where('student' , array('student_id' => $class_id))->result_array(); 
	foreach ($get_student_list as $row_value)
	{
		echo '<input type="text" name="mother_name" class="form-control" value="'. $row_value['mother_name'] .'" readonly />';
	}
    }
    /* Develop By Hardik Bhut 24-december-2015 */
    function get_student_name($class_id)
    {

       		$year_start_date=$this->session->userdata('start_date');
       		$year_end_date=$this->session->userdata('end_date');		
       		$this->db->order_by("name", "asc"); 
	   		$get_student_list1 = $this->db->get_where('student' , array('class_id' => $class_id,'curr_date >='=>$year_start_date,'curr_date <='=>$year_end_date));
	   		$get_student_list=$get_student_list1->result_array();
    
			if(count($get_student_list) > 0)
			{
				echo '<option value="">Select Student</option>';
			}
	  		else if($class_id==0 && $class_id !="")
	  		{
	  			echo '<option value="0">All Student</option>';
	  		}
	  		foreach ($get_student_list as $row_value)
	  		{	
				if(count($get_student_list) > 0)
				{
					echo '<option value="' . $row_value['student_id'] . '">' . $row_value['name'] . '</option>';
				}
	   		}
	 }
	 /* Develop By Hardik Bhut 24-december-2015 */
	 function get_data_table()
	 {
        $this->load->view('backend/admin/get_data_table', $_POST['class_id'],$_POST['list'],$_POST['student_id']);		 
	 }
	 /* Develop By Hardik Bhut 25-december-2015 */
	 function get_alldata_table()
	 {
        $this->load->view('backend/admin/get_data_table',$_POST['list'], $_POST['class_id'],$_POST['student_id']);		 
	 }
	 /**** Assessment *****/
	/**** Develop By Hardik Bhut 18-december-2015 *****/
	function assessment($param1 = '', $param2 = '' , $param3 = '')
	{
		if ($param1 == 'create'){
			$data['class_id']    = $this->input->post('class_name');
           	$data['student_id']  = $this->input->post('student_name');
			$data['behaviour']   = $this->input->post('behaviour');
			$data['created_date']= date('Y-m-d H:i:s', time());
			$this->db->insert('assessment', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			redirect(base_url() . 'index.php?admin/assessment', 'refresh');
        }
		if ($param1 == 'do_update') {
			$data['class_id']    = $this->input->post('class_name');
           	$data['student_id']  = $this->input->post('student_name');
			$data['behaviour']   = $this->input->post('behaviour');
			$data['created_date']= date('m-d-Y H:i:s', time());
            	$this->db->where('assessment_id', $param2);
            	$this->db->update('assessment', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            	redirect(base_url() . 'index.php?admin/assessment/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('assessment', array(
                'assessment_id' => $param2
            ))->result_array();
        }if ($param1 == 'delete') {
			$this->db->where('assessment_id', $param2);
            $this->db->delete('assessment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/assessment/', 'refresh');
        }
		$page_data['page_name']  = 'assessment';
        $page_data['page_title'] = 'Assessment';
		$this->load->view('backend/index', $page_data);
	}
		/**** Student Attendance *****/
	/**** Develop By Hardik Bhut 16-december-2015 *****/
	function student_attendance($param1 = '', $param2 = '' , $param3 = '')
	{
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
            redirect(base_url() . 'index.php?admin/student_attendance', 'refresh');
			}else if(date("m/d/Y") < $this->input->post('date')){
				$this->session->set_flashdata('flash_message' , get_phrase('do_not_add_futur_date')); 
            redirect(base_url() . 'index.php?admin/student_attendance', 'refresh');
			}else{
			$this->db->insert('attendance', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully')); 
            redirect(base_url() . 'index.php?admin/student_attendance', 'refresh');
			}
        }
		if ($param1 == 'delete') {
			$this->db->where('attendance_id', $param2);
            $this->db->delete('attendance');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/student_attendance/', 'refresh');
        }
		$page_data['page_name']  = 'student_attendance';
        $page_data['page_title'] = 'Student Attendance';
		$this->load->view('backend/index', $page_data);
	}
		/**** Student Attendance *****/
	/**** Develop By Hardik Bhut 16-december-2015 *****/
	function teacher_attendance($param1 = '', $param2 = '' , $param3 = '')
	{
		if ($param1 == 'create') {
			$test = explode('/',$this->input->post('date'));
			$date_final = $test[2].'-'.$test[0].'-'.$test[1];
		    $data['date']                     = $date_final;
           	$data['teacher_id']               = $this->input->post('staff');
			$data['description']    		  = $this->input->post('description');
			$data['status']  				   = 2;
			$data['month']  				    = $test[0];
			
			$this->db->select('*')->from('attendance');
			$this->db->where('teacher_id',$this->input->post('staff')); 
			$this->db->where('date',$date_final); 
			$query = $this->db->get(); 
			$duplicate_teacher_entry=$query->num_rows();
			$student_holiday_check=$this->db->get_where('holiday',
			array('holiday_date' =>$this->input->post('date')))->row();
			if(count($student_holiday_check)>0){
				 $this->session->set_flashdata('flash_message' , get_phrase('this_day_is_already_holiday'));
			}else if($duplicate_teacher_entry > 0){
				$this->session->set_flashdata('flash_message' , get_phrase('do_not_add_this record_again')); 
            redirect(base_url() . 'index.php?admin/teacher_attendance', 'refresh');
			}else if(date("m/d/Y") < $this->input->post('date')){
				$this->session->set_flashdata('flash_message' , get_phrase('do_not_add_futur_date')); 
            redirect(base_url() . 'index.php?admin/teacher_attendance', 'refresh');
			}else{
			$this->db->insert('attendance', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully')); 
            redirect(base_url() . 'index.php?admin/teacher_attendance', 'refresh');
			}
        }
	if ($param1 == 'delete') {
			$this->db->where('attendance_id', $param2);
            $this->db->delete('attendance');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/teacher_attendance/', 'refresh');
        }
		$page_data['page_name']  = 'teacher_attendance';
        $page_data['page_title'] = 'Staff Attendance';
		$this->load->view('backend/index', $page_data);
	}
	// Use for Teacher Month Attendance
	/**** Develop By Hardik Bhut 16-december-2015 *****/
	function get_teacher_month_attendance($month)
	{
		$data['month']=$month;
        $this->load->view('backend/admin/get_data_attendance_teacher',$data);	
	}
	// Use for Student Month Attendance
	/**** Develop By Hardik Bhut 16-december-2015 *****/
	function get_student_month_attendance($month)
	{
		$data['month']=$month;
        $this->load->view('backend/admin/get_data_attendance',$data);	
	}
		// Use for Student Class Attendance
	/**** Develop By Hardik Bhut 16-december-2015 *****/
	function get_student_class_attendance($class_id)
	{
		$data['class_id']=$class_id;
        $this->load->view('backend/admin/get_data_attendance',$data);
	}

	// Use for Teacher Search Name Attendance
	/**** Develop By Hardik Bhut 21-december-2015 *****/
	function get_month_attendance_teacher_name($search_keyword="")
	{
		$data['search_keyword']=$search_keyword;
        $this->load->view('backend/admin/get_data_attendance_teacher',$data);	 
	}
	
	// Use for Student Search Name Attendance
	/**** Develop By Hardik Bhut 21-december-2015 *****/
	function get_month_attendance_student_name($search_keyword="")
	{
		$data['search_keyword']=$search_keyword;
        $this->load->view('backend/admin/get_data_attendance',$data);	
	}
		/**** Mark *****/ 
	/**** Develop By Hardik Bhut 22-december-2015 *****/
	function mark($param1 = '')
	{
		if ($param1 == 'import_excel'){
			
			$data['year'] = $this->input->post('year_name');
            $data['class_id'] = $this->input->post('class_id');
			$data['exam_id'] = $this->input->post('exam_id');
			$data['uplaoded_file_name'] = $_FILES['userfile']['name']; 
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/mark_sheet/'.$_FILES['userfile']['name']);
			include 'excel_reader2.php';
			$excel = new Spreadsheet_Excel_Reader();
			$excel->read('uploads/mark_sheet/'.$_FILES['userfile']['name']);    
			$x=7;
			while($x<=$excel->sheets[0]['numRows']) {
			$year =   isset($excel->sheets[0]['cells'][2][2]) ? $excel->sheets[0]['cells'][2][2] : '';
			//$data['exam_id'] =   isset($excel->sheets[0]['cells'][3][2]) ? $excel->sheets[0]['cells'][3][2] : '';
			$class_id =  isset($excel->sheets[0]['cells'][4][2]) ? $excel->sheets[0]['cells'][4][2] : '';
			$data['student_id'] =   isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
			$data['student_name'] =   isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
			$data['roll_no'] =   isset($excel->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
			$count_subject=$this->db->where('class_id',intval($data['class_id']))->count_all_results('subject');
			$count_subject1=$count_subject+3;
			for($a=4; $a<=$count_subject1; $a++){
		    $data['subject_id']  =isset($excel->sheets[0]['cells'][6][$a]) ? $excel->sheets[0]['cells'][6][$a] : '';
			 //$data['subject_id']
			$sub_name=$this->db->get_where('subject',array('name'=>$data['subject_id']))->row();
			$data['subject_name']=$sub_name->subject_id;
			$data['mark_obtained']=isset($excel->sheets[0]['cells'][$x][$a]) ? $excel->sheets[0]['cells'][$x][$a] : '';
			
			
			$file_exist=$this->db->get_where('mark',array('uplaoded_file_name'=>$_FILES['userfile']['name']))->row();
			if(count($file_exist)>0){
				
				$get_student_id=$this->db->get_where('mark',array('student_id'=>$data['student_id'],'subject_id'=>$data['subject_id'],'exam_id'=>$data['exam_id']))->row();
				if($data['student_id']==$get_student_id->student_id){
					
					$this->db->where('mark_id', $get_student_id->mark_id);
            		$this->db->update('mark', $data);
					$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
				}else{
					$this->db->insert('mark', $data);
					$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));}
			}else{
				$this->session->set_flashdata('flash_message' , get_phrase('report_not_match_with_this_system'));
			}
		}
		$x++;
		}redirect(base_url() . 'index.php?admin/mark/', 'refresh');
		}
		if($param1=='do_update'){
			$mark_ids=$this->input->post('mark_id');
			$marks = $this->input->post('mark_obtained');
			$marks_table =   array_combine ($mark_ids ,  $marks );
			foreach($marks_table as $mark_id => $mark):
				$this->db->where('mark_id',$mark_id);
				$data =array('mark_obtained'=>$mark);
       			$this->db->update('mark', $data);	
			endforeach;
		}
		$page_data['page_name']  = 'mark';
		$page_data['page_title'] = 'Marks';
		$this->load->view('backend/index', $page_data);
	}
	/****Use For Mark *****/ 
	/**** Develop By Hardik Bhut 22-december-2015 *****/
	function download_mark_excelsheet($param1 = '',$param2 = '',$param3 = '')
	{
		$page_data['class_id']=$param1;
		$page_data['exam_id']=urldecode($param2);
		$page_data['year_name']=$param3;
		$page_data['page_name']  = 'download_mark_excelsheet';
		$page_data['page_title'] = 'Mark';
        $this->load->view('backend/index', $page_data);
	}
	   /**** Develop By Brijesh Dhami 22-december-2015 *****/
    function notification($param1 = '', $param2 = '', $param3 = '')
    {	
        if ($param1 == 'create') {
            $data['notice_name']     = $this->session->userdata('name');
            $data['notice']          = $this->input->post('notice');           
            $this->db->insert('noticeboard', $data);            

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/notification/', 'refresh');
        }        
        $year_start_date=$this->session->userdata('start_date');
        $year_end_date=$this->session->userdata('end_date');
        $page_data['page_name']  = 'notification';
        $page_data['page_title'] = 'Manage Notification';
	    $this->db->order_by('create_timestamp','desc');
		$page_data['notification']=$this->db->get_where('noticeboard',array('create_timestamp >='=>$year_start_date,'create_timestamp <='=>$year_end_date))->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
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
	
	function get_exam_name($class_id)
    {
				$this->db->distinct('name');
				$this->db->group_by('name');
        $exam = $this->db->get_where('exam' , array('class_id' => intval($class_id)))->result_array();
		if($exam[0] == ""){
			echo '<option value="">No Exam</option>';
		}else{
			echo '<option value="">Select Exam</option>';
	    	foreach ($exam as $row) {
           	 echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        	}
		}
    }

    /****GROUP MANAGEMENT*****/
	/****Develop By Hardik Bhut 14-december-2015*****/
	function create_group($param1 = '', $param2 = '' , $param3 = '')
	{
        if ($param1 == 'create') {
            $data['group_name']       = $this->input->post('group_name');
            $data['user_type']   = $this->input->post('user_type');
			if($this->input->post('user_type')==3){
				 $data['user_type']   = 1;
			}
			 $data['user_role']   = implode(',',$this->input->post('user_role'));
			 $check_already_exist_name=$this->db->get_where('group',array('group_name'=>$this->input->post('group_name')))->row();
			 if(count($check_already_exist_name)>0){
         	   $this->session->set_flashdata('flash_message' , get_phrase('group_name_already_exist.'));	 
			 }else{
            	$this->db->insert('group', $data);
         	   $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
			 }
            redirect(base_url() . 'index.php?admin/create_group', 'refresh');
        }
		$page_data['user_role']   = $param1;
        $page_data['groups']   = $this->db->get('group')->result_array();
		$page_data['groups']   = $this->db->get_where('group' , array('user_role' => $param1))->result_array();
        $page_data['page_name']  = 'create_group';
        $page_data['page_title'] = get_phrase('Create Group');
		$this->load->view('backend/index', $page_data);
	}
	function list_group($param1 = '', $param2 = '' , $param3 = '')
	{
        
        if ($param1 == 'delete') {
			$this->input->post('group_name_delete');
            $this->db->where('group_id', $this->input->post('group_name_delete'));
            $this->db->delete('group');
		    $this->db->where('group_id', $this->input->post('group_name_delete'));
            $this->db->delete('assign_module');
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/list_group', 'refresh');
        }

		$page_data['user_role']   = $param1;
        $page_data['group_list']   = $this->db->get_where('group')->result_array();
		$page_data['groups']   = $this->db->get_where('group' , array('user_role' => $param1))->result_array();
        $page_data['page_name']  = 'list_group';
        $page_data['page_title'] = get_phrase('List Group');
		$this->load->view('backend/index', $page_data);
	}
	function update_group($param1 = '', $param2 = '' , $param3 = '')
	{
        if ($param1 == 'do_update') {
			$data['user_role']   = implode(',',$this->input->post('user_role'));
            $this->db->where('group_id', $this->input->post('group_name'));
            $this->db->update('group', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
            redirect(base_url() . 'index.php?admin/update_group', 'refresh');
        }
		
		$page_data['user_role']   = $param1;
        $page_data['group_list']   = $this->db->get_where('group')->result_array();
		$page_data['groups']   = $this->db->get_where('group' , array('user_role' => $param1))->result_array();
        $page_data['page_name']  = 'update_group';
        $page_data['page_title'] = get_phrase('Update Group');
		$this->load->view('backend/index', $page_data);
	}
	
    /****Develop By Hardik Bhut 14-december-2015*****/
	function get_user($user_id)
    {
		//For Teacher
		if($user_id=='1')
		{
			$sections=$this->db->get_where('teacher' , array('user_type' => $user_id,'teaching_type' => 1))->result_array();
			foreach ($sections as $row) {
				echo '<option value="'.$row['teacher_id'] . '">' . $row['name'].'</option>';
			}
		}
		//For Student
		if($user_id=='2')
		{
		    $sections = $this->db->get_where('student' , array('user_type' => $user_id))->result_array();
			foreach ($sections as $row) {
				echo '<option value="' . $row['student_id'] . '">' . $row['name'] . '</option>';
			}
		}
		//For Non Technical
		if($user_id=='3')
		{
			$sections = $this->db->get_where('teacher' , array('teaching_type' => 2))->result_array();
			foreach ($sections as $row) {
				echo '<option value="' . $row['teacher_id'] . '">' . $row['name'] . '</option>';
			}
		}
		//For Parents
		if($user_id=='4')
		{
			$sections = $this->db->get_where('parent' , array('user_type' => $user_id))->result_array();
			foreach ($sections as $row) {
				echo '<option value="' . $row['parent_id'] . '">' . $row['name'] . '</option>';
			}
		}
		//For Admin
		if($user_id=='5')
		{
			$sections=$this->db->get_where('admin' , array('user_type' => $user_id,
			'level !=' => 1))->result_array();
			foreach ($sections as $row) {
				echo '<option value="' . $row['admin_id'] . '">' . $row['name'] . '</option>';
			}
		}
    }
	/****Develop By Hardik Bhut 14-december-2015*****/
	function get_group_ajax($group_id)
    {
		$get_group_list = $this->db->get_where('group' , array('group_id' => $group_id))->result_array();
		foreach ($get_group_list as $row_key => $row_value)
		 {
			$user_role=explode(',',$row_value['user_role']);
			$user_type[]=$row_value['user_type'];
			if($row_value['user_type']==1){
				  $user_type[]='<option value="1">Teacher</option>';
			$sections=$this->db->get_where('teacher' , array('user_type' =>$row_value['user_type'],'teaching_type' => 1))->result_array();
			foreach ($sections as $row) {
				if(!in_array($row['teacher_id'],$user_role))
				{
					$full_user_list[]= '<option value="' . $row['teacher_id'] . '">' . $row['name'] . '</option>';
					}
				}
			}if($row_value['user_type']==2){
				 $user_type[]='<option value="2">Student</option>';
				 $sections = $this->db->get_where('student' , array('user_type' => $row_value['user_type']))->result_array();
				  foreach ($sections as $row) {
					if(!in_array($row['student_id'],$user_role))
					{
						$full_user_list[]= '<option value="' . $row['student_id'] . '">' . $row['name'] . '</option>';
					}
				}
					
			}if($row_value['user_type']==4){
				  $user_type[]='<option value="4">Parent</option>';
				  $sections = $this->db->get_where('parent' , array('user_type' =>$row_value['user_type']))->result_array();
				  foreach ($sections as $row) {
					if(!in_array($row['parent_id'],$user_role)){
					$full_user_list[]='<option value="' . $row['parent_id'] . '">' . $row['name'] . '</option>';	
					}
				  }
			}if($row_value['user_type']==5){
				  $user_type[]='<option value="5">Sub Admin</option>';
				  $sections = $this->db->get_where('admin' , array('user_type' =>$row_value['user_type']))->result_array();
				  foreach ($sections as $row) {
					if(!in_array($row['admin_id'],$user_role)){
					$full_user_list[]='<option value="' . $row['admin_id'] . '">' . $row['name'] . '</option>';	
					}
				  }
			}
			foreach ($user_role as $user_role_value)
			{
				
				if($row_value['user_type']=='1')
				{
					$user_role_query = $this->db->get_where('teacher' , array('teacher_id' => $user_role_value))->result_array();
					foreach ($user_role_query as $user_role_row)
					{
						$group[]= '<option value="' . $user_role_row['teacher_id'] . '">' . $user_role_row['name'] . '</option>';
					}
				}
				if($row_value['user_type']=='2')
				{
					
					$user_role_student_query = $this->db->get_where('student' , array('student_id' => $user_role_value))->result_array();
					foreach ($user_role_student_query as $user_role_student_row)
					{
						$group[]= '<option value="' . $user_role_student_row['student_id'] . '">' . $user_role_student_row['name'] . '</option>';
					}
				}
				if($row_value['user_type']=='4')
				{
					$user_role_query = $this->db->get_where('parent' , array('parent_id' => $user_role_value))->result_array();
					foreach ($user_role_query as $user_role_row)
					{
						$group[]= '<option value="' . $user_role_row['parent_id'] . '">' . $user_role_row['name'] . '</option>';
					}
				}
				if($row_value['user_type']=='5')
				{
					$user_role_query = $this->db->get_where('admin' , array('admin_id' => $user_role_value))->result_array();
					foreach ($user_role_query as $user_role_row)
					{
						$group[]= '<option value="' . $user_role_row['admin_id'] . '">' . $user_role_row['name'] . '</option>';
					}
				}
			}
			$out = array('group'=>$group,'user_type'=>$user_type,'full_user_list'=>$full_user_list); 
			echo json_encode($out);
		}
		
	}
	/**** Develop By Hardik Bhut 15-december-2015 *****/
	
	function assign_module($param1 = '', $param2 = '' , $param3 = '')
	{
		if ($param1 == 'create') {
            $data['group_id']       = $this->input->post('group_name');
            $data['module_id']   = implode(',',$this->input->post('module_name'));
			
			$this->db->where(array('group_id' => $this->input->post('group_name')));
			$module_row=$this->db->get('assign_module')->row();
			$this->db->where(array('group_id' => $this->input->post('group_name')));
			$group_count=$this->db->count_all_results('assign_module');
			
				if($group_count > 0)
				{
					$this->db->where('assign_module_id',$module_row->assign_module_id);
					$this->db->update('assign_module', $data);
				}
				else
				{
					$this->db->insert('assign_module', $data);
				}		
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully')); 
            redirect(base_url() . 'index.php?admin/assign_module', 'refresh');
	    }
		$page_data['page_name']  = 'assign_module';
        $page_data['page_title'] = get_phrase('Assign Module');
		$this->load->view('backend/index', $page_data);	
	}
	function list_module($param1 = '', $param2 = '' , $param3 = '')
	{
		$page_data['page_name']  = 'list_module';
        $page_data['page_title'] = 'List Module';
		$this->load->view('backend/index', $page_data);	
	}
	function update_module($param1 = '', $param2 = '' , $param3 = '')
	{
		if ($param1 == 'do_update') {
            $data['group_id']       = $this->input->post('group_name');
            $data['module_id']   = implode(',',$this->input->post('module_name'));
			  $this->db->where('group_id',$data['group_id']);
			  $this->db->update('assign_module', $data);
		    $this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully')); 
            redirect(base_url() . 'index.php?admin/update_module', 'refresh');
	    }
		$page_data['page_name']  = 'update_module';
        $page_data['page_title'] = 'Update Module';
		$this->load->view('backend/index', $page_data);	
	}
	/**** Develop By Hardik Bhut 15-december-2015 *****/
	function get_module_ajax($group_id)
	{
		$get_assign_module_list = $this->db->get_where('assign_module' , array('group_id' => $group_id))->result_array();
		
		foreach ($get_assign_module_list as $row_key => $row_value)
		{
			$module_record=explode(',',$row_value['module_id']);
			$get_group_user_type = $this->db->get_where('group' , array('group_id' => $group_id))->result_array();
			foreach ($get_group_user_type as $row_user_type){
				if($row_user_type['user_type']==5){
					$modules_query = $this->db->get('modules')->result_array();
				}else{
					$modules_query = $this->db->get_where('modules',array('assign_type'=>0))->result_array();
				}
			}
			foreach ($modules_query as $modules_row){
					if(!in_array($modules_row['module_id'],$module_record)){
						$full_module_list[]='<option value="' . $modules_row['module_id'] . '">' . $modules_row['module_name'] . '</option>';	
						}
				}
			foreach ($module_record as $module_record_value)
			{
				$user_role_query = $this->db->get_where('modules' , array('module_id' => $module_record_value))->result_array();
					foreach ($user_role_query as $user_role_row){
						$assigned_module_list[]='<option value="' . $user_role_row['module_id'] . '">' . $user_role_row['module_name'] . '</option>';
					
				}
			}
		}
		$out = array('assigned_module_list'=>$assigned_module_list,'full_module_list'=>$full_module_list); 
		echo json_encode($out);
	}
	
		/**** Academic Year *****/ 
	/**** Develop By Hardik Bhut 21-december-2015 *****/
	function academic_year($param1 = '', $param2 = '', $param3 = '')
	{
		$page_data['academy']=$this->db->get('academic_year')->result_array();
		$page_data['page_name']  = 'academic_year';
        $page_data['page_title'] = 'Academic Year';
        $this->load->view('backend/index', $page_data);
	}
	
	/* Develop By Hardik Bhut 16-January-2016 */
	function get_exam_data_table()
	{
		$data['list']=$_POST['list'];
		$data['student_name']=$_POST['student_name'];
		$data['exam_name']=$_POST['exam_name'];
        $this->load->view('backend/admin/get_data_table',$data);		 
	}
	
	/**** Time Table *****/ 
	/**** Develop By Hardik Bhut 18-december-2015 *****/

    function time_table($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
			$timestamp = strtotime($this->input->post('date'));
			//Start Script For Get Week
			$maxday    = date("t",$timestamp);
			$thismonth = getdate($timestamp);
			$timeStamp = mktime(0,0,0,$thismonth['mon'],1,$thismonth['year']);
			$startday  = date('w',$timeStamp);
			$day = $thismonth['mday'];
			$weeks = 0;
			$week_num = 0;
			for ($i=0; $i<($maxday+$startday); $i++) {
				if(($i % 7) == 0){$weeks++;}
				if($day == ($i - $startday + 1)){$week_num = $weeks;}
			  }     
    		//End Script Week
			$data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
			$data['teacher_id'] = $this->input->post('teacher_id');
			$data['date']       = $this->input->post('date');
			$data['month']      = date("m", strtotime($this->input->post('date')));
			$data['week']       = $week_num;
			$data['day']        = date('l', $timestamp); 
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
			
            $now =date("m/d/Y");
			$condition_array1=array('class_id'=>$data['class_id'],'teacher_id '=>$data['teacher_id'],'date'=>$data['date']);
			$condition_array2=array('class_id'=>$data['class_id'],'date'=>$data['date']);
			$condition_array3=array('teacher_id '=>$data['teacher_id'],'date'=>$data['date']);
			
			$this->db->where('time_start >=', $data['time_start']);
          	$this->db->where('time_end <=', $data['time_end'] ); 
			$this->db->where($condition_array1);
			$query1 = $this->db->get(time_table);
			
			$this->db->where('time_start >=', $data['time_start']);
          	$this->db->where('time_end <=', $data['time_end'] ); 
			$this->db->where($condition_array2);
			$query2 = $this->db->get(time_table);
			
			$this->db->where('time_start >=', $data['time_start']);
          	$this->db->where('time_end <=', $data['time_end'] ); 
			$this->db->where($condition_array3);
			$query3 = $this->db->get(time_table);

			$rowcount1 = $query1->num_rows(); 
			$rowcount2 = $query2->num_rows(); 
			$rowcount3 = $query3->num_rows();
			$get_holiday=$this->db->get_where('holiday',array('holiday_date'=>$data['date']))->num_rows();
			if($rowcount1>0){
				$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist'));
			}elseif($rowcount2>0){
				$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist_same_date_and_time'));
			}elseif($rowcount3>0){
				$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist_same_date_and_time'));
			}else{
				if(($data['date'] < $now)) {
					$this->session->set_flashdata('flash_message' , get_phrase('Past date not allowed in new date'));
					
				}elseif(($data['time_start'] >= $data['time_end'])){
					$this->session->set_flashdata('flash_message' , get_phrase('Entered start time and end time is mismatch.'));
				}elseif($get_holiday>0){
					$this->session->set_flashdata('flash_message' , get_phrase('this_day_is_already_holiday'));
				}
				else{
					$this->db->insert('time_table', $data);
					$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
				}
			}
            redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $timestamp = strtotime($this->input->post('date'));
			//Start Script For Get Week
			$maxday    = date("t",$timestamp);
			$thismonth = getdate($timestamp);
			$timeStamp = mktime(0,0,0,$thismonth['mon'],1,$thismonth['year']);
			$startday  = date('w',$timeStamp);
			$day = $thismonth['mday'];
			$weeks = 0;
			$week_num = 0;
			for ($i=0; $i<($maxday+$startday); $i++) {
				if(($i % 7) == 0){$weeks++;}
				if($day == ($i - $startday + 1)){$week_num = $weeks;}
			  }     
    		//End Script Week

			$data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
			$data['teacher_id'] = $this->input->post('teacher_id');
			$data['date']       = $this->input->post('date');
			$data['week']       = $week_num;
			$data['day']        = date('l', $timestamp); 
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $this->db->where('time_table_id', $param2);
            $this->db->update('time_table', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('time_table', array(
                'time_table_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('time_table_id', $param2);
            $this->db->delete('time_table');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
        }
		if ($param1 == 'replicate') {

			$class_id_replicate = $this->input->post('class_id_replicate');
			$old_date = $this->input->post('old_date');
			$new_date = $this->input->post('new_date');
			$timestamp = strtotime($this->input->post('new_date'));

			//Start Script For Get Week
			$maxday    = date("t",$timestamp);
			$thismonth = getdate($timestamp);
			$timeStamp = mktime(0,0,0,$thismonth['mon'],1,$thismonth['year']);
			$startday  = date('w',$timeStamp);
			$day = $thismonth['mday'];
			$weeks = 0;
			$week_num = 0;
			for ($i=0; $i<($maxday+$startday); $i++) {
				if(($i % 7) == 0){$weeks++;}
				if($day == ($i - $startday + 1)){$week_num = $weeks;}
			  }     
    		//End Script Week
			
			$data['new_month']      = date("m", strtotime($this->input->post('new_date')));
			$data['new_week']       = ceil( date( 'j', strtotime($this->input->post('new_date')) ) / 7 );
			$data['new_day']        = date('l', $timestamp); 
			$new_month  = $data['new_month'];
			$new_week = $data['new_week'];
			$new_day = $data['new_day'];
			$now_day = date('m/d/Y');
			 $new_now =date("Y-m-d H:i:s");

			if($new_date <  $now_day) {
					$this->session->set_flashdata('flash_message' , get_phrase('do_not_insert_past_date'));
					 redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
			}elseif($new_date==$old_date){
				$this->session->set_flashdata('flash_message' , "Do not insert same date");
				 redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
			}elseif($new_date < $old_date)
			{
				$this->session->set_flashdata('flash_message' , get_phrase('Past date not allowed in new date'));
				redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
			}
			$getquery = $this->db->get_where('time_table' , array('class_id' => $class_id_replicate,'date' => $old_date))->result_array();
				
			if(empty($getquery)){
				$this->session->set_flashdata('flash_message' , get_phrase('record_not_found')); 
				redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
			}
			$user_role_query = $this->db->get_where('time_table' , array('class_id' => $class_id_replicate,'date' => $old_date))->result_array();
			foreach ($user_role_query as $row){
			$getquery = $this->db->get_where('time_table' , array('class_id' => $class_id_replicate,'date' => $new_date))->num_rows();
				 if($getquery > 0){
						$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist')); 
						 redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
				}
				else{
				$array = array("class_id"=>$row['class_id'],
								"subject_id"=>$row['subject_id'],
								"teacher_id"=>$row['teacher_id'],
								"time_start"=>$row['time_start'],
								"time_end"=>$row['time_end'],
								"date"=>$new_date,
								"month"=>$new_month,
								"week"=>$week_num,
								"day"=>$new_day,
								"created_date"=>$new_now);
				$this->db->insert("time_table",$array);
				 $this->session->set_flashdata('flash_message' , get_phrase('data_replicated_successfully'));		
				}}
            redirect(base_url() . 'index.php?admin/time_table/', 'refresh');
		}
        $page_data['page_name']  = 'time_table';
        $page_data['page_title'] = 'Time Table';
        $this->load->view('backend/index', $page_data);
    }
	/* Develop By Nikita Patel 25-Feb-2016 */
	function get_time_table_data()
	{
	    $this->load->view('backend/admin/get_time_table_data', $_POST['class_id'],$_POST['month'],$_POST['week']);
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

		/* Develop By Brijesh Dhami 4-january-2016 */
		function message($param1 = 'message_home', $param2 = '', $param3 = '') {
			if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
			if($param1 == 'message_read1')
			{
				$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
				//$page_data['type']=$this->input->post('type');
				$this->student_model->mark_thread_messages_read($param2);	
				$data['msg']=$this->db->get_where('message',array('message_id'=>$param2))->result();
				$this->load->view('backend/admin/reply_modal',$data);
			}
			else
			{
				if ($param1 == 'send_new') {
					$message_thread_code = $this->crud_model->send_new_private_message();
					$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
					redirect(base_url() . 'index.php?admin/message', 'refresh');
				}
				
				if ($param1 == 'send_reply') {
					$this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
					$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
					redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
				}
				
				if ($param1 == 'message_read') {
					$m_id = $this->uri->segment(4);	
					$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
					$this->crud_model->mark_thread_sender_read($m_id);
				}
				
				$page_data['message_inner_page_name']   = $param1;
				$page_data['page_name']                 = 'message';
				$page_data['page_title']                = get_phrase('private_messaging');
				
				$this->load->view('backend/index', $page_data);
			}    
		}
			 /* Brijesh Dhami 
	  Desc : --  All reports views 
	 */
	
	 public function reports(){
		$page_data['page_name']  = 'reports';
        $page_data['page_title'] = 'Reports';
		$this->load->view('backend/index', $page_data);		
		 
	 }
	
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Holiday Listing Report 
	***********/
	public function holiday_pdf()
	{		
		$data = array();	
         $html =  utf8_encode($this->load->view('backend/admin/holiday_pdf', $data, true));		
		$data['page_name'] = 'holiday_pdf';
		
        //this the the PDF filename that user will get to download
		$pdfFilePath = "holiday_list.pdf";
		
        //load mPDF library
		$this->load->library('m_pdf');
		
		
		//load the view and saved it into $html variable
       //generate the PDF from the given html
		$this->m_pdf->pdf->WriteHTML($html);

        //download it.
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/************** End Here *************/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Notification Listing Report 
	***********/
	public function notification_pdf()
	{		
		$data = array();	
        $html =  utf8_encode($this->load->view('backend/admin/notification_pdf', $data, true));		
		$pdfFilePath = "notice_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Non Teaching Listing Report 
	***********/
	public function non_teaching_pdf()
	{		
		$data = array();	
        $html =  utf8_encode($this->load->view('backend/admin/non_teaching_pdf', $data, true));		
		$pdfFilePath = "non_teaching_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Group Listing Report 
	***********/
	public function group_list_pdf()
	{		
		$data = array();	
        $html =  utf8_encode($this->load->view('backend/admin/group_list_pdf', $data, true));		
		$pdfFilePath = "Group_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Fees Report 
	***********/
	public function fees_list_pdf()
	{		
		$data = array();	
		$data['standard'] = $this->input->post('standard');
        $html =  utf8_encode($this->load->view('backend/admin/fees_list_pdf', $data, true));		
		$pdfFilePath = "Fees_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Study Materials Uploaded Report 
	***********/
	public function share_materials_pdf()
	{	
		
		$data = array();
        $html =  utf8_encode($this->load->view('backend/admin/share_materials_pdf', $data, true));		
		$pdfFilePath = "study_materials_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Study Materials Uploaded Report 
	***********/
	public function staff_attendence_pdf()
	{	
		$data = array();
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$data['month']= $this->input->post('month');
		}
        $html =  utf8_encode($this->load->view('backend/admin/staff_attendence_pdf', $data, true));		
		$pdfFilePath = "staff_attendance_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Brijesh Dhami
		Desc :-> Study Materials Uploaded Report 
	***********/
	public function ind_student_pdf()
	{	
		$data = array();		
		$data['student_name']       = $this->input->post('student_name');		
        $html =  utf8_encode($this->load->view('backend/admin/individual_student_pdf', $data, true));		
		$pdfFilePath = "individual_student_report_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
	/******** End Here ********/
		/***********
		Dev :-> Brijesh Dhami
		Desc :-> student list classwise Report 
	***********/
	public function std_list_pdf($param1 = '')
	{
		if($param1 == "class_wise_std"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');			
			$html =  utf8_encode($this->load->view('backend/admin/student_class_pdf', $data, true));		
			$pdfFilePath = "classwise_student_list.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}elseif($param1 == "standard_student"){
			$data = array();
			$data['std_name']       = $this->input->post('std_name');			
			$html =  utf8_encode($this->load->view('backend/admin/student_standard_pdf', $data, true));		
			$pdfFilePath = "stdwise_student_list.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}elseif($param1 == "all_student"){		
			$data = array();						
			$html =  utf8_encode($this->load->view('backend/admin/student_all_list_pdf', $data, true));		
			$pdfFilePath = "std_classwise_list.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Sachin
		Desc :-> Study Materials Uploaded Report 
	***********/
	public function parent_list_pdf()
	{	
		//die("Fdf");
		$data = array();			
		$data['parent_option'] = $this->input->post('poption');
		
		//die($data['parent_option']);
		if(isset($data['parent_option']) && $data['parent_option'] == 1){		
	
		$data['parent_class']       = $this->input->post('pclass');
        $html =  utf8_encode($this->load->view('backend/admin/parent_list_pdf', $data, true));		
		$pdfFilePath = "parent_class_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");	
		
		}
		
		if(isset($data['parent_option']) && $data['parent_option'] == 2)
		{	//die("std");
			$data['parent_stand']       = $this->input->post('pstand');
			//die($data['parent_stand']);
			$html =  utf8_encode($this->load->view('backend/admin/parent_list_pdf', $data, true));		
			$pdfFilePath = "parent_standard_list.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
		
		if(isset($data['parent_option']) && $data['parent_option'] == 3 )
		{	
			$data['option']       = '3';
			//die($data['parent_stand']);
			$html =  utf8_encode($this->load->view('backend/admin/parent_list_pdf', $data, true));		
			$pdfFilePath = "parent_all_list.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
	}
	/******** End Here ********/
	
		public function exam_list_pdf()
		{
			$data = array();			
			$data['exam_name']       = $this->input->post('examlist');
			//die($this->input->post('examlist'));	
			$html =  utf8_encode($this->load->view('backend/admin/exam_list_pdf', $data, true));		
			$pdfFilePath = "exam_list.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
	/***********
		Dev :-> Hardik Bhut
		Desc :-> Attendance Listing Report 
	***********/
	public function attendance_pdf($param1 = '' , $param2 = '')
	{
		if($param1 == "class_wise_attendance"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');
			$data['from_date']       = $this->input->post('from_date');
			$data['to_date']       = $this->input->post('to_date');	
			$html =  utf8_encode($this->load->view('backend/admin/attendance_pdf_class_wise', $data, true));		
			$pdfFilePath = "class_wise_attendance.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "standard_attendance"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');
			$data['from_date']       = $this->input->post('from_date');
			$data['to_date']       = $this->input->post('to_date');	
			$html =  utf8_encode($this->load->view('backend/admin/attendance_standard_pdf', $data, true));		
			$pdfFilePath = "standard_attendance.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "all_attendance"){		
			$data = array();
			$data['from_date']       = $this->input->post('from_date');
			$data['to_date']       = $this->input->post('to_date');	
			$html =  utf8_encode($this->load->view('backend/admin/attendance_all_pdf', $data, true));		
			$pdfFilePath = "standard_attendance.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
	}
	/******** End Here ********/
	
		/***********
		Dev :-> Hardik Bhut
		Desc :-> Time Table Listing Report 
	***********/
	public function timetable_pdf($param1 = '' , $param2 = '')
	{
		if($param1 == "class_wise_timetable"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');
			$data['month']       = $this->input->post('month');
			$data['week']       = $this->input->post('week');	
			$html =  utf8_encode($this->load->view('backend/admin/timetable_class_wise_pdf', $data, true));		
			$pdfFilePath = "timetable_class_wise.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "teacher_wise_timetable"){		
			$data = array();
			$data['teacher_id']       = $this->input->post('teacher_id');
			$data['month']       = $this->input->post('month');
			$data['week']       = $this->input->post('week');	
			$html =  utf8_encode($this->load->view('backend/admin/timetable_teacher_wise_pdf', $data, true));		
			$pdfFilePath = "timetable_teacher_wise.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
	}
	/******** End Here ********/
	
	/***********
		Dev :-> Hardik Bhut
		Desc :-> Exam & Mark Listing Report 
	***********/
	public function exam_mark_pdf($param1 = '' , $param2 = '')
	{
		if($param1 == "class_wise_exam"){		
			$data = array();
			$data['class_id']       = $this->input->post('class_id');
			$data['exam_id']     = $this->input->post('exam_id');
			$html =  utf8_encode($this->load->view('backend/admin/class_wise_exam_pdf', $data, true));		
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
			$html =  utf8_encode($this->load->view('backend/admin/student_mark_pdf', $data, true));		
			$pdfFilePath = "student_mark.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "class_wise_top3_student"){		
			$data = array();
			$data['class_id']    = $this->input->post('class_id');
			$data['exam_id']     = $this->input->post('exam_id');
			$html =  utf8_encode($this->load->view('backend/admin/class_wise_top3_student_pdf', $data, true));		
			$pdfFilePath = "class_wise_top3_student.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
		if($param1 == "subject_wise_top3_student"){		
			$data = array();
			$data['subject']    = $this->input->post('subject');
			$data['standard']     = $this->input->post('standard');
			$html =  utf8_encode($this->load->view('backend/admin/subject_wise_top3_student_pdf', $data, true));		
			$pdfFilePath = "subject_wise_top3_student.pdf";		
			$this->load->library('m_pdf');		
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");		
		}
	}
	
	
		/**** Develop By Hardik Bhut 11-january-2016 *****/
	function get_student_list_mark($class_id)
	{
		
		$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
		echo '<option value="">Select Staudent</option>';
		foreach ($get_student_list as $row_value){
			echo '<option value="'.$row_value['name'].' '.$row_value['father_name'].'">' . $row_value['name'] . '</option>';
		 }
	}
	/**** Develop By Hardik Bhut 11-january-2016 *****/
	function get_exam_list_mark($class_id)
	{
		$this->db->group_by('name');
		$get_student_list = $this->db->get_where('exam' , array('class_id' => intval($class_id)))->result_array();
		echo '<option value="">Select Exam</option>';
		foreach ($get_student_list as $row_value){
			echo '<option value="'.$row_value['name'].'">' . $row_value['name'] . '</option>';
		 }
	}
	
	
	
	
		/******* Mayur *******/
	
	function get_student_list_markid($class_id)
	{
		$get_student_list = $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
		echo '<option value="">Select Student</option>';
		foreach ($get_student_list as $row_value){
			echo '<option value="'.$row_value['student_id'].'">' . $row_value['name'] . '</option>';
		 }
	}
	function get_exam_list_markid($class_id)
	{
		$this->db->group_by('name');
		$get_student_list = $this->db->get_where('exam' , array('class_id' => intval($class_id)))->result_array();
		echo $this->db->last_query();
		echo '<option value="">Select Exam</option>';
		foreach ($get_student_list as $row_value){
			echo '<option value="'.$row_value['exam_id'].'">' . $row_value['name'] . '</option>';
		 }
	}
	
	/* Mayur Panchal */
		/*  Mayur   */
	function getstudents($class_id = '')
	{
		
			$students = $this->db->get_where("student",array("class_id"=>$class_id))->result_array();
			echo '<option value="">Select Student</option>';
			foreach ($students as $row_value){
			echo '<option value="'.$row_value['student_id'].'">' . $row_value['name'] . '</option>';
		 }
	}
	
	
	/*    */
	
		/* Left Panel */
	public function sidebar_teacher_pdf()
	{
			$html =  utf8_encode($this->load->view('backend/admin/sidebar_teacher_pdf', $data, true));		
		$pdfFilePath = "sidebar_teacher_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");	
	}
	
	public function sidebar_notification_pdf(){
		$html =  utf8_encode($this->load->view('backend/admin/sidebar_notification_pdf', $data, true));		
		$pdfFilePath = "sidebar_notification_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	public function sidebar_non_teaching_pdf()
	{
		$html =  utf8_encode($this->load->view('backend/admin/sidebar_non_teaching_pdf', $data, true));		
		$pdfFilePath = "sidebar_non_teaching_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	public function sidebar_holiday_pdf(){
		$html =  utf8_encode($this->load->view('backend/admin/sidebar_holiday_pdf', $data, true));		
		$pdfFilePath = "sidebar_holiday_pdf.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
		
	}
	
	public function sidebar_ind_student_pdf()
	{
		$class_id = $this->input->post("class_id");
		$student_id = $this->input->post("student_id");
		$data['class_id'] = $class_id;
		$data['student_id'] = $student_id;
		//$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		
 		$html =  utf8_encode($this->load->view('backend/admin/sidebar_ind_student_pdf', $data, true));		
		$pdfFilePath = "individual_student_report_list.pdf";		
		$this->load->library('m_pdf');		
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
	
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
	/*   */
	
	
	public function searchstudent()
	{
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
		$student_name = $this->input->post('student_name');	
		
		$this->db->like('name',$student_name); 
		$result = $this->db->get("student")->result_array();
		$page_data['page_name']  = 'sidebar_ind_student';
        $page_data['page_title'] = get_phrase('individual_student_report');
		$page_data['students'] = $result;
		$page_data['student_name'] = $student_name;
		$this->load->view('backend/index', $page_data);
		}
		else{$page_data['page_name']  = 'sidebar_ind_student';
        $page_data['page_title'] = get_phrase('individual_student_report');
		//$page_data['students'] = $result;
		//$page_data['student_name'] = $student_name;
		$this->load->view('backend/index', $page_data);
		}
	}
	
	public function attendance_list($param = null)
	{
		if($param=="class_wise_attendance"){
			
		$data = array();
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['from_date']       = $this->input->post('from_date');
			$page_data['to_date']       = $this->input->post('to_date');	
			//$html =  utf8_encode($this->load->view('backend/admin/attendance_pdf_class_wise', $data, true));	
		$page_data['page_name']  = 'sidebar_attendance_class_wise';
        $page_data['page_title'] = get_phrase('attendance');
		//$page_data['student_name']       = $this->input->post('student_name');	
		$this->load->view('backend/index', $page_data);
		}elseif($param=="standard_attendance")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['from_date']       = $this->input->post('from_date');
			$page_data['to_date']       = $this->input->post('to_date');	
			$page_data['page_name']  = 'sidebar_attendance_standard_list';
        $page_data['page_title'] = get_phrase('attendance');
		//$page_data['student_name']       = $this->input->post('student_name');	
		$this->load->view('backend/index', $page_data);
			
			
		}elseif($param=="all_attendance")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['from_date']       = $this->input->post('from_date');
			$page_data['to_date']       = $this->input->post('to_date');	
			$page_data['page_name']  = 'sidebar_all_attendance_list';
       		 $page_data['page_title'] = get_phrase('attendance');
		//$page_data['student_name']       = $this->input->post('student_name');	
		$this->load->view('backend/index', $page_data);
		}
		else
		{
			$page_data['page_name']  = 'attendance_view';
        $page_data['page_title'] = get_phrase('attendance');
	
		$this->load->view('backend/index', $page_data);
		}
		
		
	}
	
	function delete_data($param='',$param2='')
	{
		
		
		if($param=="ind_student")
		{
		$array = array("ind_student"=>'');
		
		$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		
		if($param=="non_teaching_list"){
			$array = array("non_teaching_list"=>'');
		
		$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		
		if($param=="fees_listing_page")
		{
			$array = array("fees_listing_page"=>'');
		
		$this->db->update("saved_reports",$array,array("report_id"=>$param2));
				
		}
		
		if($param=="holiday_list"){
			$array = array("holiday_list"=>'');
			$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		
		if($param=="notification_list"){
			$array = array("notification_list"=>'');
			$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		
		if($param=="share_materials_list"){
			$array = array("share_materials_list"=>'');
			$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="staff_attendence_list")
		{
				$array = array("staff_attendence_list"=>'');		
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="group_list")
		{
				$array = array("group_list"=>'');
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="attendance_view")
		{
			$array = array("attendance_view"=>'');
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="timetable_list")
		{
			$array = array("timetable_list"=>'');
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="exam_mark_list")
		{
			$array = array("exam_mark_list"=>'');
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="teacher_list")
		{
			$array = array("teacher_list"=>'');
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		if($param=="marks_list")
		{
			$array = array("marks_list"=>'');
				$this->db->update("saved_reports",$array,array("report_id"=>$param2));
		}
		
		
		//$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"ind_student"=>"1"))->result_array();
			
		
	}
	
	function checkreport($param='')
	{
		$report = $this->db->get_where("saved_reports",array($param=>"1"))->result_array();
		
		if(empty($report)){
			echo "1";	
		}
		else{
			echo "0";
			}
			
		
	}
	
	function checkprint(){
		echo phpinfo();
		
		ini_set('display_errors',1);
		error_reporting(E_ALL);
			
		$contents="Test print.";
		eval("\$output = \"$contents\";");
		$handle = printer_open();
			 if($handle)
				  echo "connected";
			 else
				  echo "not connected";    
		printer_set_option($handle, PRINTER_MODE, "raw"); 
		printer_write($handle,$output);
		printer_close($handle);

	}
	
	function save_data($param='',$param2='')
	{
		
		
		if($param=="ind_student")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"ind_student"=>"1"))->result_array();
			
			if(empty($report[0]['ind_student']))
			{
				$update = array("ind_student"=>"1",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "ind_student";
				$this->session->set_flashdata('flash_message' , get_phrase('report_saved'));
			}
			else
			{
				echo "ind_student";
				$this->session->set_flashdata('flash_message' , get_phrase('report_saved'));
			}
		}
		
		if($param=="non_teaching_list")
		{
				$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"non_teaching_list"=>"1"))->result_array();
			
			if(empty($report[0]['non_teaching_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"1",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "non_teaching_list";
			}
			else
			{ 
				echo "non_teaching_list";
			}
		}
			
		if($param=="fees_listing_page")
		{
				$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"fees_listing_page"=>"1"))->result_array();
			
			if(empty($report[0]['fees_listing_page']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"1",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "fees_listing_page";
			}
			else
			{ 
				echo "fees_listing_page";
			}
		}
			
		if($param=="holiday_list")
		{
				$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"holiday_list"=>"1"))->result_array();
			
			if(empty($report[0]['holiday_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"1",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "holiday_list";
			}
			else
			{
				echo "holiday_list";
			}
				
		}
			
		if($param=="notification_list")
		{
				$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"notification_list"=>"1"))->result_array();
			
			if(empty($report[0]['notification_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"1",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "notification_list";
			}
			else
			{ 
				echo "notification_list";
			}
				
		}
		if($param=="share_materials_list")
		{
				$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"share_materials_list"=>"1"))->result_array();			
			if(empty($report[0]['share_materials_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"1",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "share_materials_list";
			}
			else
			{ 
				echo "share_materials_list";
			}
				
		}
		
		if($param=="staff_attendence_list")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"staff_attendence_list"=>"1"))->result_array();			
			if(empty($report[0]['staff_attendence_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"1",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "staff_attendence_list";
			}
			else
			{ 
				echo "staff_attendence_list";
			}
		}
			
		if($param=="group_list")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"group_list"=>"1"))->result_array();			
			if(empty($report[0]['group_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"1",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "group_list";
			}
			else
			{ 
				echo "group_list";
			}
			
		}
		
		if($param=="attendance_view")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"attendance_view"=>"1"))->result_array();			
			if(empty($report[0]['attendance_view']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"1",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "attendance_view";
			}
			else
			{ 
				echo "attendance_view";
			}
			
			
		}
		if($param=="timetable_list")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"timetable_list"=>"1"))->result_array();			
			if(empty($report[0]['timetable_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"1",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "timetable_list";
			}
			else
			{
				echo "timetable_list";
			}
		}
		if($param=="exam_mark_list")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"exam_mark_list"=>"1"))->result_array();			
			if(empty($report[0]['exam_mark_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"1",
								"teacher_list"=>"",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "exam_mark_list";
			}
			else
			{
				echo "exam_mark_list";				
			}
		}
		if($param=="teacher_list")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"teacher_list"=>"1"))->result_array();			
			if(empty($report[0]['teacher_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"1",
								"marks_list"=>"");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "teacher_list";
			}
			else
			{
				echo "teacher_list";				
			}
		}
		if($param=="marks_list")
		{
			$report = $this->db->get_where("saved_reports",array("report_id"=>$param2,"teacher_list"=>"1"))->result_array();			
			if(empty($report[0]['marks_list']))
			{
				$update = array("ind_student"=>"",
								"non_teaching_list"=>"",
								"fees_listing_page"=>"",
								"holiday_list"=>"",
								"notification_list"=>"",
								"share_materials_list"=>"",
								"staff_attendence_list"=>"",
								"group_list"=>"",
								"attendance_view"=>"",
								"timetable_list"=>"",
								"exam_mark_list"=>"",
								"teacher_list"=>"",
								"marks_list"=>"1");
				$this->db->update("saved_reports",$update,array("report_id"=>$param2));
				echo "marks_list";
			}
			else
			{
				echo "marks_list";				
			}
		}
		
		
			
	}
	
	public function timetable($param=null)
	{
		if($param=="class_wise_timetable")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['month']       = $this->input->post('month');
			$page_data['week']       = $this->input->post('week');
			$page_data['page_name']  = 'sidebar_timetable_class_wise_list';
       	 $page_data['page_title'] = get_phrase('timetable');
	
		$this->load->view('backend/index', $page_data);
		}elseif($param=="teacher_wise_timetable")
		{
			$page_data['teacher_id']       = $this->input->post('teacher_id');
			$page_data['month']       = $this->input->post('month');
			$page_data['week']       = $this->input->post('week');
			$page_data['page_name']  = 'sidebar_timetable_teacher_wise_list';
       	 $page_data['page_title'] = get_phrase('timetable');
	
		$this->load->view('backend/index', $page_data);
		}else
		{
		$page_data['page_name']  = 'sidebar_timetable_list';
        $page_data['page_title'] = get_phrase('timetable');
	
		$this->load->view('backend/index', $page_data);
		}
	}
	
	public function exam_mark($param=null)
	{
		
		if($param=="class_wise_exam")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['exam_id']     = $this->input->post('exam_id');
			$page_data['page_name']  = 'sidebar_class_wise_exam_list';
       		$page_data['page_title'] = get_phrase('Exams');
	
			$this->load->view('backend/index', $page_data);
		}elseif($param=="student_mark")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['exam_id']     	 = $this->input->post('exam_id');
			$page_data['student_id']     = $this->input->post('student_id');
			$res = $this->db->get_where("student",array("student_id"=>$page_data['student_id']))->result_array();
			$page_data['student_name']   = $res[0]['name'];
			$page_data['page_name']      = 'sidebar_student_mark_list';
       		$page_data['page_title']     = get_phrase('Marks');
	
			$this->load->view('backend/index', $page_data);
			
		}elseif($param=="class_wise_top3_student")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['exam_id']     = $this->input->post('exam_id');
			$page_data['student_id']     = $this->input->post('student_id');
			$page_data['page_name']  = 'sidebar_class_wise_top3_student_list';
       		$page_data['page_title'] = get_phrase('Marks');
	
			$this->load->view('backend/index', $page_data);
		}elseif($param=="subject_wise_top3_student")
		{
			
			$page_data['subject']    = $this->input->post('subject');
			$page_data['standard']     = $this->input->post('standard');
			$page_data['page_name']  = 'sidebar_subject_wise_top3_student_list';
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
	
	
	public function report_newlist($param = null){
		
	
		if($param=="ind_student")
		{
			$page_data['page_name']  = 'sidebar_ind_student';
        $page_data['page_title'] = get_phrase('individual_student_report');
		
		$this->load->view('backend/index', $page_data);
			
			//$this->load->view('backend/admin/ind_student',$data);	
		}elseif($param=="non_teaching")
		{
			$page_data['page_name']  = 'sidebar_non_teaching_list';
       		 $page_data['page_title'] = get_phrase('non_teaching_staff_listing');
	
		$this->load->view('backend/index', $page_data);
		}
		elseif($param=="fees_listing")
		{
			if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
			{
				$page_data['standard'] = $this->input->post('standard');	
			}
			$page_data['page_name']  = 'sidebar_fees_listing';
        $page_data['page_title'] = get_phrase('fees_listing');
	
		$this->load->view('backend/index', $page_data);
				
			
		}elseif($param=="holiday_list")
		{
			$page_data['page_name']  = 'sidebar_holiday_list';
        $page_data['page_title'] = get_phrase('holiday');
	
		$this->load->view('backend/index', $page_data);
			
		}elseif($param=="notification_list"){
			$page_data['page_name']  = 'sidebar_notification';
        $page_data['page_title'] = get_phrase('notification');
	
		$this->load->view('backend/index', $page_data);
		}elseif($param=="study_materials")
		{
		$page_data['page_name']  = 'share_materials_list';
        $page_data['page_title'] = get_phrase('share_materials');
	
		$this->load->view('backend/index', $page_data);	
		}elseif($param=="staff_attendence")
		{
			if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
			{
				$page_data['month'] = $this->input->post('month');
			}
			$page_data['page_name']  = 'sidebar_staff_attendance_list';
        $page_data['page_title'] = get_phrase('staff_attendence');
	
		$this->load->view('backend/index', $page_data);
			
		}elseif($param=="group_list")
		{
		$page_data['page_name']  = 'group_list';
        $page_data['page_title'] = get_phrase('group_list');
	
		$this->load->view('backend/index', $page_data);
			
		}elseif($param=="attendance")
		{
		$page_data['page_name']  = 'sidebar_attendance';
        $page_data['page_title'] = get_phrase('attendance');
	
		$this->load->view('backend/index', $page_data);
		}elseif($param=="timetable")
		{
		$page_data['page_name']  = 'sidebar_timetable_list';
        $page_data['page_title'] = get_phrase('timetable');
	
		$this->load->view('backend/index', $page_data);
			
		}elseif($param=="exam_mark")
		{
			$page_data['page_name']  = 'sidebar_exam_mark_list';
        $page_data['page_title'] = get_phrase('exams');
	
		$this->load->view('backend/index', $page_data);
		}
		elseif($param=='marks')
		{
			$page_data['page_name']  = 'sidebar_student_mark_list';
        	$page_data['page_title'] = get_phrase('Marks');
	
		$this->load->view('backend/index', $page_data);
			
		}
		elseif($param=='teacher_list')
		{
			$page_data['page_name']  = 'sidebar_teacher_list';
        $page_data['page_title'] = get_phrase('Teachers');
	
		$this->load->view('backend/index', $page_data);
			
		}
		else{
		
	
		//$data= '';
		$page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
		
		$this->load->view('backend/index', $page_data);
		}
	}
		/* Mayur Panchal 
		MANAGE Import 
		Name :-- Brijesh Dhami 	*/
		
    function import($param1 = '', $param2 = '', $param3 = '')
    {
		$this->load->library('csvimport');
		$this->upload->initialize($config);	
		
		if($param1 == 'download')
		{
		    	$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			$head = "";
			if ($param2 == 'student')
			{
				$filename = "student_sample.csv";
				$head = "Full Name, Father Name, Mother Name, Birthday(mm/dd/yyyy), Sex(male/female), Blood Group, Address, Phone, Email, Password, Roll No ,Class";
			}
			elseif($param2 == 'teacher')
			{
				$filename = "teacher_sample.csv";
				$head = "Full Name, Father Name, Mother Name, Birthday(mm/dd/yyyy), Sex(male/female), Blood Group, Address, Phone, Email, Password,Designation";
			}
			elseif($param2 == 'holiday') 
			{
				$filename = "holiday_sample.csv";
				$head = "Holiday Name, Holiday Date(mm/dd/yyyy),Details";
			}
			elseif($param2 == 'student_attendance') 
			{
				$filename = "student_attendance_sample.csv";
				$head = "Student Full Name,Class Name,Description,Date(mm/dd/yyyy),Leave Type";
			}
			elseif($param2 == 'staff_attendance')
			{
				$filename = "staff_attendance_sample.csv";
				$head = "Staff Full Name,Description,Date(mm/dd/yyyy),Leave Type";
			}
			elseif($param2 == 'teacher_class_association')
			{
				$filename = "teacher_class_association_sample.csv";
				$head = "Class,Name";
			}
			elseif($param2 == 'exam_timetable')
			{
				$filename = "exam_timetable_sample.csv";
				$head = "Exam Name,Class,Subject,Date(mm/dd/yyyy),Start Time(hh:mm am),End Time(hh:mm am),Out of Mark";
			}
			elseif($param2 == 'timetable')
			{
				$filename = "timetable_sample.csv";
				$head = "Class,Subject,Teacher,Date(mm/dd/yyyy),Start Time(hh:mm am),End Time(hh:mm am)";
			}
			elseif($param2 == 'study_material')
			{
				$filename = "study_material_sample.csv";
				$head = "Class,Subject,Topic Name,Path";
			}
			force_download($filename, $head);
		}
		if ($param1 == 'data') 
		{
				$data['error'] = '';    //initialize image upload error array to empty
				$config['upload_path'] = './uploads/bulk_csv/';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
	   			
				if (!$this->upload->do_upload())
				{
	           			 $data['error'] = $this->upload->display_errors();
					 $data['page_name']  = 'import';
					 $data['page_title'] = 'Import manager';
					 $this->session->set_flashdata('flash_message',get_phrase('file_upload_failed'));
					 redirect(base_url() . 'index.php?admin/import', 'refresh');
        			}
				else
				{
					$file_data = $this->upload->data();
		 	 		$file_path = $file_data['full_path']; 
		        		if ($this->csvimport->get_array($file_path))
					{
		        			$csv_array1 = $this->csvimport->get_array($file_path);
					        $file_check=preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_data['file_name']); 
						// For Student CSV	
						if($this->input->post('module_id')==$file_check&&$this->input->post('module_id')=='student_sample')
						{
				 			foreach($csv_array1 as $key =>$csv_array)
							{
							      $insert_data['name']=$csv_array['Full Name'];
							      $insert_data['father_name']=$csv_array['Father Name'];
							      $insert_data['mother_name']=$csv_array['Mother Name'];
							      $insert_data['birthday']=$csv_array['Birthday(mm/dd/yyyy)'];
							      $insert_data['sex']=$csv_array['Sex(male/female)'];
							      $insert_data['religion']='';
							      $insert_data['blood_group']=$csv_array['Blood Group'];
							      $insert_data['address']=$csv_array['Address'];
							      $insert_data['phone']=$csv_array['Phone'];
							      $insert_data['email']=$csv_array['Email'];
							      $insert_data['parent_email']='';
							      $insert_data['real_pass']=$csv_array['Password'];
					  		      $insert_data['password']=md5($csv_array['Password']);
							      $insert_data['roll']=$csv_array['Roll No'];
							      $insert_data['class_id']=$csv_array['Class'];
                                       			      $insert_data['group_id']=2;
					  		      if($insert_data['roll'] != "" || $insert_data['email'] != "")
							      {
									$this->db->where('roll',$insert_data['roll']);
									$this->db->or_where('email',$insert_data['email']);
									$duplicate_rollno=$this->db->get('student')->num_rows();	
							      }
							      else
							      {
									$duplicate_rollno='';
							      }
					  		      if($duplicate_rollno > 0)
							      {
								  $this->session->set_flashdata('flash_message',get_phrase('data already exist')); 
								  unlink($file_path);
								  redirect(base_url() . 'index.php?admin/import', 'refresh');
							      }
							      else
							      {
								$this->db->insert('student', $insert_data);
								$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
							      }
				 		       }
							unlink($file_path);
							redirect(base_url() . 'index.php?admin/import', 'refresh'); 
						}
						
			// For Teacher CSV	
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='teacher_sample')
			{
				foreach($csv_array1 as $key =>$csv_array)
				{
				      $insert_data['name']=$csv_array['Full Name'];
				      $insert_data['father_name']=$csv_array['Father Name'];
				      $insert_data['mother_name']=$csv_array['Mother Name'];
				      $insert_data['birthday']='0'.$csv_array['Birthday(mm/dd/yyyy)'];
				      $insert_data['sex']=$csv_array['Sex(male/female)'];
				      $insert_data['religion']='';
				      $insert_data['blood_group']=$csv_array['Blood Group'];
				      $insert_data['address']=$csv_array['Address'];
				      $insert_data['phone']=$csv_array['Phone'];
				      $insert_data['email']=$csv_array['Email'];
				      $insert_data['real_pass']=$csv_array['Password'];
				      $insert_data['password']=md5($csv_array['Password']);
				      $insert_data['designation']=$csv_array['Designation'];
				      $insert_data['teaching_type']=1;
				      $insert_data['group_id']=1;
				      
				      $duplicate_teacher_email=$this->db->get_where('teacher',array('email'=>$insert_data['email']))->num_rows();
					if($duplicate_teacher_email > 0)
					{
						  $this->session->set_flashdata('flash_message',get_phrase('Email '.$insert_data['email'].' already exist')); 
						   unlink($file_path);
						   redirect(base_url() . 'index.php?admin/import', 'refresh');
					 }
					 else
					 {
	                  			$this->db->insert('teacher', $insert_data);
						$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully')); 
					 }
				 }
				unlink($file_path);
				redirect(base_url() . 'index.php?admin/import', 'refresh'); 
			}
			// For Holiday CSV
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='holiday_sample')
			{
				 foreach($csv_array1 as $key =>$csv_array)
				 {
				      $insert_data['holiday_name']=$csv_array['Holiday Name'];
               			      $insert_data['holiday_date']=$csv_array['Holiday Date(mm/dd/yyyy)'];
				      $insert_data['holiday_detail']=$csv_array['Details'];
				      $duplicate_holiday=$this->db->get_where('holiday',array('holiday_date'=>$insert_data['holiday_date']))->row();
				      if(count($duplicate_holiday)>0)
				      {
					 $this->session->set_flashdata('flash_message',get_phrase('Data already exist')); 
					 unlink($file_path);
					 redirect(base_url() . 'index.php?admin/import', 'refresh');
				      }
				      else
				      {
				      	$this->db->insert('holiday', $insert_data);
					$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
				      }
				 }
				unlink($file_path);
				redirect(base_url() . 'index.php?admin/import', 'refresh'); 
			}
			// For student attendance CSV
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='student_attendance_sample')
			{
				 foreach($csv_array1 as $key =>$csv_array)
				 {
					  $test = explode('/',$csv_array['Date(mm/dd/yyyy)']);
					  $data['student_id']=$csv_array['Student Full Name'];
					  $insert_data['attandence_class']=$csv_array['Class Name'];
					  $insert_data['description']=$csv_array['Description'];
					  $insert_data['date']=$test[2].'-'.$test[0].'-'.$test[1];
                      			  $insert_data['status']=2;
					  $insert_data['month']=$test[0];
					  $insert_data['leave_type']=$csv_array['Leave Type'];
					  $student_fullname=$this->db->get_where('student',array('name'=>$data['student_id']))->row();
					  $insert_data['student_id']=$student_fullname->student_id;
					  $duplicate_student_attendance=$this->db->get_where('attendance',array('student_id'=>				  $student_fullname->student_id,'date'=>$insert_data['date']))->row();
					  if(count($duplicate_student_attendance)>0)
					  {
						  $this->session->set_flashdata('flash_message',get_phrase('Data already exist')); 
						  unlink($file_path);
						  redirect(base_url() . 'index.php?admin/import', 'refresh');
					  }
					  if(count($student_fullname)>0)
					  {
						 $this->db->insert('attendance', $insert_data);
						 $this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
					  }
					  else
					  {
						 $this->session->set_flashdata('flash_message',get_phrase('Your '.$data["student_id"].' not match with out system')); 
						 unlink($file_path);
						 redirect(base_url() . 'index.php?admin/import', 'refresh');
					  }
				 }
				 unlink($file_path);
				 redirect(base_url() . 'index.php?admin/import', 'refresh'); 
			}
			// For staff attendance CSV
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='staff_attendance_sample')
			{
				 foreach($csv_array1 as $key =>$csv_array)
				 {
					  $test = explode('/',$csv_array['Date(mm/dd/yyyy)']);
					  $data['teacher_id']=$csv_array['Staff Full Name'];
					  $insert_data['description']=$csv_array['Description'];
					  $insert_data['date']=$test[2].'-'.$test[0].'-'.$test[1];
					  $insert_data['status']=2;
					  $insert_data['month']=$test[0];
					  $insert_data['leave_type']=$csv_array['Leave Type'];
					  $teacher_fullname=$this->db->get_where('teacher',array('name'=>$data['teacher_id']))->row();
					  $insert_data['teacher_id']=$teacher_fullname->teacher_id;
			
					  $duplicate_teacher_attendance=$this->db->get_where('attendance',array('teacher_id'=>$teacher_fullname->teacher_id,'date'=>$insert_data['date']))->row();
					 if(count($duplicate_teacher_attendance)>0)
					 {
						   $this->session->set_flashdata('flash_message',get_phrase('Data already exist')); 
						   unlink($file_path);
						   redirect(base_url() . 'index.php?admin/import', 'refresh');
					 }
					 else if(count($teacher_fullname)>0)
					 {
						$this->db->insert('attendance', $insert_data);
						$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));
					 }
					 else
					 {
					     $this->session->set_flashdata('flash_message',get_phrase('Your '.$data["teacher_id"].' not match with out system')); 
					     unlink($file_path);
					     redirect(base_url() . 'index.php?admin/import', 'refresh');
					 }
				 }
				 unlink($file_path);
				 redirect(base_url() . 'index.php?admin/import', 'refresh'); 
			}
			// For Teacher class association CSV
			if($this->input->post('module_id')==$file_check&&$this->input->post('module_id')=='teacher_class_association_sample')		
			{ 
				foreach($csv_array1 as $key =>$csv_array)
				{
					  $insert_data['class_id']=$csv_array['Class'];
			                  $data['teacher_name']=$csv_array['Name'];
					  $this->db->like('name',$data['teacher_name']);
					  $teacher_name=$this->db->get('teacher')->row();
					  $insert_data['teacher_id']=$teacher_name->teacher_id;
					  $get_teacher=$this->db->get_where('teacher',array('teacher_id'=>$insert_data['teacher_id']))->row();
			
					  $duplicate_teacher=$this->db->get_where('teacher_class_association',array('class_id'=>$insert_data['class_id'],'teacher_id'=>$insert_data['teacher_id']))->row();
					 
					  if(count($duplicate_teacher)>0)
					  {
						  $this->session->set_flashdata('flash_message',get_phrase($data['teacher_name'].' already Exit with class '.$insert_data['class_id']));
						  unlink($file_path);
						  redirect(base_url() . 'index.php?admin/import', 'refresh'); 
				          }
					  else
					  {
					  	  if(count($get_teacher)>0)
						  {
						  	$this->db->insert('teacher_class_association', $insert_data);
						 	$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
						  }
						  else
						  {

						  }
					  }
				 }
 				 unlink($file_path);
				 redirect(base_url() . 'index.php?admin/import', 'refresh');
			}
			// For Exam TimeTable CSV
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='exam_timetable_sample')
			{
				foreach($csv_array1 as $key =>$csv_array)
				{
					  $insert_data['name']=$csv_array['Exam Name'];
					  $insert_data['class_id']=$csv_array['Class'];
					  $insert_data['date']=$csv_array['Date(mm/dd/yyyy)'];
					  $insert_data['time_start']=$csv_array['Start Time(hh:mm am)'];
					  $insert_data['time_end']=$csv_array['End Time(hh:mm am)'];
					  $insert_data['out_of_marks']=$csv_array['Out of Mark'];
					  $data['subject_name']=$csv_array['Subject'];
					  $insert_data['subject_id']='';
					  $this->db->like('name',$data['subject_name']);
					  $subject_name=$this->db->get('subject')->row();
					  $insert_data['subject_id']=$subject_name->subject_id;
					  $condition_array1=array('class_id'=>$insert_data['class_id'],'date'=>$insert_data['date']);
					  $this->db->where('time_start >=', $insert_data['time_start']);
			    	 	  $this->db->where('time_end <=', $insert_data['time_end']); 
					  $this->db->where($condition_array1);
					  $duplicate_exam=$this->db->get('exam')->row();
					  
					  if(count($duplicate_exam)>0)
					  {
						$this->session->set_flashdata('flash_message',get_phrase('Exam already Exist'));
						unlink($file_path);
						redirect(base_url() . 'index.php?admin/import', 'refresh'); 
					  }
					  else
					  { 
					  	$this->db->insert('exam', $insert_data);
						$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
					  }
				 }
				unlink($file_path);
				redirect(base_url() . 'index.php?admin/import', 'refresh'); 
			}
			// For Daily TimeTable CSV
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='timetable_sample')
			{ 
				 foreach($csv_array1 as $key =>$csv_array)
				 {
				 	  $insert_data['class_id']=$csv_array['Class'];
					  $data['subject_name']=$csv_array['Subject'];
					  $data['teacher_name']=$csv_array['Teacher'];
					  $insert_data['date']=$csv_array['Date(mm/dd/yyyy)'];
					  $insert_data['time_start']=$csv_array['Start Time(hh:mm am)'];
					  $insert_data['time_end']=$csv_array['End Time(hh:mm am)'];
					  $insert_data['month']= date("m", strtotime($insert_data['date']));
					  $insert_data['week'] = ceil( date( 'j', strtotime($insert_data['date']) ) / 8 );
					  $insert_data['day']= date('l', strtotime($insert_data['date'])); 
					  
					  $this->db->like('name',$data['subject_name']);
					  $subject_name=$this->db->get('subject')->row();
					  
					  $this->db->like('name',$data['teacher_name']);
					  $teacher_name=$this->db->get('teacher')->row();
					  
					  $insert_data['subject_id']=$subject_name->subject_id;
					  $insert_data['teacher_id']=$teacher_name->teacher_id;
					  
					  $now =date("m/d/Y");
					  $condition_array1=array('class_id'=>$insert_data['class_id'],'teacher_id '=>$teacher_name->teacher_id,'date'=>$insert_data['date']);
					  $condition_array2=array('class_id'=>$insert_data['class_id'],'date'=>$insert_data['date']);
					  $condition_array3=array('teacher_id '=>$teacher_name->teacher_id,'date'=>$insert_data['date']);
					  $this->db->where($condition_array1);
					  $rowcount1 = $this->db->get(time_table)->num_rows(); ;	
			
					if($rowcount1>0) 
					{
						$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist'));
						unlink($file_path);
						redirect(base_url() . 'index.php?admin/import', 'refresh');
					}
					else
					{
						$this->db->insert('time_table', $insert_data);
						$this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
					}
				}
				unlink($file_path);
				redirect(base_url() . 'index.php?admin/import', 'refresh');
			}
			// For Study material CSV
			if($this->input->post('module_id')==$file_check && $this->input->post('module_id')=='study_material_sample')
			{
				 foreach($csv_array1 as $key =>$csv_array)
				 {
					  $insert_data['class_id']=$csv_array['Class'];
					  $data['subject_name']=$csv_array['Subject'];
					  $insert_data['topic_name']=$csv_array['Topic Name'];
					  $insert_data['m_filename']=$csv_array['Path'];
					  $this->db->like('name',$data['subject_name']);
					  $subject_name=$this->db->get('subject')->row(); 
					  $insert_data['subject_id']=$subject_name->subject_id;
					  
					  $this->db->insert('share_material', $insert_data);
					  $this->session->set_flashdata('flash_message',get_phrase('file_upload_successfully'));               
				}
				unlink($file_path);
				redirect(base_url() . 'index.php?admin/import', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('flash_message',get_phrase('file_does_not_match'));
				unlink($file_path);
				redirect(base_url() . 'index.php?admin/import', 'refresh');
			}
			unlink($file_path);
			redirect(base_url() . 'index.php?admin/import', 'refresh');
            } 
	    else 
            	unlink($file_path);
		$this->session->set_flashdata('flash_message',get_phrase('file_upload_failed'));	
                redirect(base_url() . 'index.php?admin/import', 'refresh');   
            }
        }
 	$page_data['page_name']  = 'import';
        $page_data['page_title'] = 'Import manager';
        $this->load->view('backend/index', $page_data);
    }
	// GET Week of Month for Time table 
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
 
  public function history_staff_detail(){
	 $page_data['page_name']  = 'history_staff_detail';
     $page_data['page_title'] = 'Staff History';
     $this->load->view('backend/index', $page_data);
 }

	/* Develop By Hardik Bhut 1-March-2016 */
  function get_history_staff($year)
  {
	  $get_staff_history = $this->db->get_where('history_staff' , array('staff_year' => $year))->result_array();
	  echo '<option value="">Select Staff</option>';
	  foreach ($get_staff_history as $row_staff_history){
			echo '<option value="'.$row_staff_history['staff_id'].'">'.$row_staff_history['staff_fullname'].'</option>';
	   }
  }
   /* Develop By Hardik Bhut 1-March-2016 */
  function history_staff_detail_individual()
  {
	  $this->load->view('backend/admin/history_staff_detail_individual', $_POST['year'],$_POST['staff_name']);	
	  
  }
  public function history_student()
  {
			$page_data['page_name']  = 'history_student';
       		$page_data['page_title'] = get_phrase('student_history');
			$this->load->view('backend/index', $page_data);	
 }
 public function gethistorystudent()
 {
	 $year = $this->input->post('years');
	 $years = explode("/",$year);
	 $start = $years[0];
	 $end = $years[1];
	 $this->db->distinct('roll');
	 
								$this->db->select('name,roll');
								  $students = $this->db->get_where('history_student',array('history_start'=>$start,'history_end'=>$end))->result_array(); 
								  $html = '<option value="">Select Student</option>';
                                   foreach($students as $std): 
                                    $html .='<option value="'.$std['roll'].'">'.$std['name'].'</option>';
                                     endforeach; 
									 echo $html;
			 
}
 public function addacademic()
 {
	$start_dates =  $this->input->post('from_date');
	$end_dates =  $this->input->post('to_date'); 
	$date1 = explode("/",$start_dates);
	$date2 = explode("/",$end_dates);
	
	$start_month = $date1[0];
	$start_date = $date1[1];
	$start_year =$date1[2];
	
	$end_month = $date2[0];
	$end_date = $date2[1];
	$end_year =$date2[2];
		
	$start_dates = date("Y-m-d",strtotime($start_dates));
	
	$end_dates = date("Y-m-d",strtotime($end_dates));
	if($start_dates==$end_dates)
	{
		$this->session->set_flashdata('flash_message' , get_phrase('same_date_not_allowed!'));
 	    redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');	
	}
	
	if($start_dates > $end_dates)
	{
		$this->session->set_flashdata('flash_message' , get_phrase('past_date_not_allowed!'));
 	    redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');	
	}
	
	$result = $this->db->get_where("academic_year",array("start_year"=>$start_year))->result_array();
	
	if(!empty($result))
	{
		$this->session->set_flashdata('flash_message' , get_phrase('this_year_is_already_added_in_academic_year'));
    	redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');
	}
	else{
		$data = array("from_month"=>$start_month,
						"to_month"=>$end_month,
						"start_date"=>$start_dates,
						"end_date"=>$end_dates,
						"start_year"=>$start_year,
						"end_year"=>$end_year);	
		$this->db->insert("academic_year",$data);				
		$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
    	redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');
		}
 }
 public function update_academic_year()
 {
 	$update1 = array("current_year_status"=>"active");
 	$update2 = array("current_year_status"=>"inactive");

	$this->db->update("academic_year",$update1,array("academic_id"=>$this->input->post('set_academic_year')));
	$this->db->update("academic_year",$update2,array("academic_id !="=>$this->input->post('set_academic_year')));
	
	$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));
 	redirect(base_url() . 'index.php?admin/academic_year/', 'refresh');
 }
  /**** Develop By Hardik Bhut 11-january-2016 *****/
	function get_module($group_id)
	{
	   $get_group = $this->db->get_where('group' , array('group_id' => $group_id))->result_array();
		
		foreach ($get_group as $row_value){
			if($row_value['user_type']==5){
				$get_module = $this->db->get('modules')->result_array();
				foreach ($get_module as $row){
				echo '<option value="'.$row['module_id'].'">'.$row['module_name'].'</option>';
				}
			}else{
				$get_module = $this->db->get_where('modules',array('assign_type'=>0))->result_array();
				foreach ($get_module as $row){
				echo '<option value="'.$row['module_id'].'">'.$row['module_name'].'</option>';
				}
			}
		 }
	}
	/*********************** Mayur Panchal 07-03-2016*******************************/
 public function delete_all_students()
 {
			$class_id = $this->input->post('class_id');
			if(isset($class_id))
			{
				$delete_id  = $this->input->post('delete_id');
				$implode = implode(",",$delete_id);
				$explode = explode(",",$implode);
				
				if(!empty($explode))
				{
					foreach($explode as $row):
					$get = $this->db->get_where("student",array("student_id"=>$row,"class_id"=>$class_id))->result_array();
					
					$get_delete = $this->db->delete("student",array("student_id"=>$row,"class_id"=>$class_id));
					$get_parent = $this->db->get_where("parent",array("student_id"=>$row,"class_id"=>$class_id))->result_array();
					$this->db->delete("parent",array("student_id"=>$row,"class_id"=>$class_id));
					$get_marks = $this->db->get_where("mark",array("student_id"=>$row,"class_id"=>$class_id))->result_array();
					foreach($get_marks as $marks):
						$get_del = $this->db->delete("mark",array("mark_id"=>$marks['mark_id']));
						endforeach;
						$get_attend = $this->db->get_where("attendance",array("student_id"=>$row,"attandence_class"=>$class_id,"status"=>'2'))->result_array();
						foreach($get_attend as $attend):
							$get_del = $this->db->delete("attendance",array("student_id"=>$row,"attandence_class"=>$class_id,"status"=>'2'));
						endforeach;
						$get_assess = $this->db->get_where("assessment",array("student_id"=>$row,"class_id"=>$class_id))->result_array();
						
						
						foreach($get_assess as $assess):
								$get_del = $this->db->delete("assessment",array("assessment_id"=>$assess['assessment_id']));
						
						endforeach;
					endforeach;
				}
			}
			else{
				$delete_id  = $this->input->post('delete_id');
				$implode = implode(",",$delete_id);
				$explode = explode(",",$implode);
				
				foreach($explode as $row):
					$get = $this->db->get_where("student",array("student_id"=>$row))->result_array();
					
					$get_delete = $this->db->delete("student",array("student_id"=>$row));
					$get_parent = $this->db->get_where("parent",array("student_id"=>$row))->result_array();
					$this->db->delete("parent",array("student_id"=>$row));
					
					$get_marks = $this->db->get_where("mark",array("student_id"=>$row))->result_array();
					
					foreach($get_marks as $marks):
								$get_del = $this->db->delete("mark",
								array("mark_id"=>$marks['mark_id']));
					endforeach;
					$get_attend = $this->db->get_where("attendance",array("student_id"=>$row,"status"=>'2'))->result_array();
						foreach($get_attend as $attend):
								$get_del = $this->db->delete("attendance",array("student_id"=>$row,"status"=>'2'));
						endforeach;
						$get_assess = $this->db->get_where("assessment",array("student_id"=>$row))->result_array();
						
						foreach($get_assess as $assess):
								$get_del = $this->db->delete("assessment",array("assessment_id"=>$assess['assessment_id']));
						endforeach;
						$get_mark = $this->db->get_where("mark",array("student_id"=>$row))->result_array();
						foreach($get_mark as $marks):
								$get_del = $this->db->delete("mark",array("mark_id"=>$marks['mark_id']));
						endforeach;
					endforeach;
				}
			$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    		redirect(base_url() . 'index.php?admin/student_management/', 'refresh');
 }
 
 public function delete_all_staff()
 {
	$teacher_id = $this->input->post('delete_id');
	$teacher  = implode(",",$teacher_id);
	$teachers = explode(",",$teacher);
	foreach($teachers as $teach ):
		//$this->db->get_where("teacher",array("teacher_id"=>$teach))->result_array();
		$this->db->delete("teacher",array("teacher_id"=>$teach));
		$timetable = $this->db->get_where("time_table",array("teacher_id"=>$teach))->result_array();
		foreach($timetable as $time):
			$this->db->delete("time_table",array("time_table_id"=>$time['time_table_id']));
		endforeach;
		
		$class_ass = $this->db->get_where("teacher_class_association",array("teacher_id"=>$teach))->result_array();
		foreach($class_ass as $asses):
			$this->db->delete("teacher_class_association",array("tca_id"=>$asses['tca_id']));
		endforeach;
		$attend = $this->db->get_where("attendance",array("teacher_id"=>$teach))->result_array();
		foreach($attend as $atend):
				$get_del = $this->db->delete("attendance",array("attendance_id"=>$atend['attendance_id'],"status"=>'2'));
		endforeach;
	endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/staff/', 'refresh');
	 }

	public function delete_all_association()
	{
		$assces_id = $this->input->post('delete_id');
		$assces  = implode(",",$assces_id);
		$asscess = explode(",",$assces);
		foreach($asscess as $association):
			$this->db->delete('teacher_class_association',array('tca_id'=>$association));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/classes/', 'refresh');
	}
	
	public function delete_holiday()
	{
		$holiday = $this->input->post('delete_id');
		$holiday  = implode(",",$holiday);
		$holidays = explode(",",$holiday);
		foreach($holidays as $holid):
			$this->db->delete('holiday',array('h_id'=>$holid));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/holiday/', 'refresh');
	}
	
	public function delete_exam()
	{
		$exam = $this->input->post('delete_id');
		$exam_id  = implode(",",$exam);
		$exams = explode(",",$exam_id);
		foreach($exams as $exam_id):
			$this->db->delete('exam',array('exam_id'=>$exam_id));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/exam/', 'refresh');
		
	}
	
	public function delete_attendance()
	{
		$attend = $this->input->post('delete_id');
		$attend  = implode(",",$attend);
		$attend = explode(",",$attend);
		//$attend = $this->db->get_where("attendance",array("attendance_id"=>$teach))->result_array();
		foreach($attend as $atend):
			$get_del = $this->db->delete("attendance",array("attendance_id"=>$atend['attendance_id'],"status"=>'2'));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/student_attendance', 'refresh');
	}
	
	public function delete_staffattend()
	{
		$attend = $this->input->post('delete_id');
		$attend  = implode(",",$attend);
		$attend = explode(",",$attend);
		//$attend = $this->db->get_where("attendance",array("attendance_id"=>$teach))->result_array();
		foreach($attend as $atend):
			$get_del = $this->db->delete("attendance",array("attendance_id"=>$atend,"status"=>'2'));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/teacher_attendance', 'refresh');
	}
	
	public function delete_studymaterial()
	{
		$material = $this->input->post('delete_id');
		$material  = implode(",",$material);
		$materials = explode(",",$material);
		
		//$attend = $this->db->get_where("attendance",array("attendance_id"=>$teach))->result_array();
		foreach($materials as $mat):
			$get_del = $this->db->delete("share_material",array("material_id"=>$mat));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/share_material', 'refresh');
			
	}
	
	public function delete_all_subject()
	{
		$material = $this->input->post('delete_id');
		$material  = implode(",",$material);
		$materials = explode(",",$material);
		foreach($materials as $mat):
			$get_del = $this->db->delete("subject",array("subject_id"=>$mat));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/subject', 'refresh');
			
	}
	/*************************End  07-03-2016 *****************************/
	/* Develop by Herry Patel 9-March-2015 */
	public function sms_management($param1="",$param2="",$param3="")
	{
		 $page_data['page_name']  = 'sms_management';
		 $page_data['page_title'] = 'SMS Management';
		 $this->load->view('backend/index', $page_data);
	}
	function getinfostudent()
	{
		$page_data['page_name']  = 'get_sms_student';        
		$this->load->view('backend/get_sms_student', $page_data);
	}

	function get_receiver1()	
	{
		$ids=$this->input->post('ids');
		$all=$this->db->get('parent')->result_array();					
			foreach($ids as $id)
			{
					foreach($all as $rec)
					{						
						if($rec['parent_id']==$id)
						{
							$allid[] ="+237".str_replace("-","",$rec['phone']);
							$name[] =  $rec['name'];
						} 
					}
			} 
			$string['name']=implode(',',$name);
			$string['ids']=implode(',',$allid);
			$string['type']=$type;
			echo json_encode($string);
		}

	/**** Develop By Hardik Bhut 12-April-2016 *****/

	function grade($param1 = '', $param2 = '')
    {
        if ($param1 == 'create')
		{
	        $data['grade_name'] = $this->input->post('grade_name');
	        $data['from_mark']  = $this->input->post('from_mark');
		    $data['to_mark']    = $this->input->post('to_mark'); 
		    $grade_duplicate_mark=$this->db->get_where('grade',array('from_mark >=' =>$data['from_mark'],'from_mark <=' =>$data['to_mark']))->num_rows();
		    $grade_duplicate=$this->db->get_where('grade',array('grade_name' =>$data['grade_name']))->num_rows();
	        
	        if($grade_duplicate > 0)
		    {
				$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist'));
		    }
		    else if($grade_duplicate_mark > 0)
		    {
		    	$this->session->set_flashdata('flash_message' , get_phrase('Mark_already_exist'));
		    }
		    else
		    {
		    	$this->db->insert('grade', $data);
	            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
	            
	        }			
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
       	}
        if ($param1 == 'do_update') 
		{
            $data['grade_name']= $this->input->post('grade_name');
            $data['from_mark'] = $this->input->post('from_mark');
			$data['to_mark'] = $this->input->post('to_mark');
			
			$grade_duplicate_mark=$this->db->get_where('grade',array('grade_id !='=>$param2,'from_mark >=' =>$data['from_mark'],'from_mark <=' =>$data['to_mark']))->num_rows();
		    $grade_duplicate=$this->db->get_where('grade',array('grade_id !='=>$param2,'grade_name' =>$data['grade_name']))->num_rows();
	        
	        if($grade_duplicate > 0)
		    {
				$this->session->set_flashdata('flash_message' , get_phrase('data_already_exist'));
		    }
		    else if($grade_duplicate_mark > 0)
		    {
		    	$this->session->set_flashdata('flash_message' , get_phrase('Mark_already_exist'));
		    }
			else
			{
				$this->db->where('grade_id', $param2);
	            $this->db->update('grade', $data);
           		$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			}
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } 
		else if ($param1 == 'edit') 
		{
            $page_data['edit_data'] = $this->db->get_where('holiday', array('h_id' => $param2))->result_array();
    	}
        if ($param1 == 'delete') 
		{
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
       
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = 'Grade';
        $this->load->view('backend/index', $page_data);
    }

    public function delete_grade()
	{
		$grade = $this->input->post('delete_id');
		$grade  = implode(",",$grade);
		$grades = explode(",",$grade);
		foreach($grades as $row):
			$this->db->delete('grade',array('grade_id'=>$row));
		endforeach;
		$this->session->set_flashdata('flash_message' , get_phrase('data_deleted_successful'));
    	redirect(base_url() . 'index.php?admin/grade/', 'refresh');
	}

	public function transport($param1 = '', $param2 = '',$param3 = '')
	{ 

		if ($param1 == 'create')
		{
				$data['registration_no']  	 = $this->input->post('register_no');
				$data['vehical_type']  	     = $this->input->post('vehical_type1');
				$data['register_owner']      = $this->input->post('register_owner');
				$data['address']    	     = $this->input->post('address');
            	$data['seat_capacity']       = $this->input->post('seat_capacity');
				$data['maker']               = $this->input->post('maker');
				$data['mfg_year']            = $this->input->post('mfg_year');
				$data['colour']              = $this->input->post('colour');
				
				$duplicate_registerno=$this->db->get_where('transport',array('registration_no' =>$data['registration_no']))->num_rows();
				if($duplicate_registerno > 0)
				{
					$this->session->set_flashdata('flash_message' , get_phrase('Register number already exist'));			
				}
				else
				{
					$this->db->insert('transport', $data);
					$transport_insert_id=$this->db->insert_id();
					if($_FILES['userfile']['name'] != "")
					{
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/transport/'.$transport_insert_id.'.jpg');
						$data_update['photo']=$transport_insert_id.'.jpg';
						$this->db->where('transport_id', $transport_insert_id);
	        	    	$this->db->update('transport', $data_update);
					}
					$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));		
				}	
	      
	        redirect(base_url() . 'index.php?admin/transport/','refresh');
        }
        if ($param1 == 'transport_do_update')
		{
				$data['registration_no']  	 = $this->input->post('register_no');
				$data['vehical_type']  	     = $this->input->post('vehical_type');
				$data['register_owner']      = $this->input->post('register_owner');
				$data['address']    	     = $this->input->post('address');
            	$data['seat_capacity']       = $this->input->post('seat_capacity');
				$data['colour']              = $this->input->post('colour');
				$data['maker']               = $this->input->post('maker');
				$data['mfg_year']            = $this->input->post('mfg_year');
				$duplicate_registerno=$this->db->get_where('transport',array('registration_no' =>$data['registration_no'],'transport_id !='=>$param2))->num_rows();
				if($duplicate_registerno > 0)
				{
					$this->session->set_flashdata('flash_message' , get_phrase('Register number already exist'));			
				}
				else
				{
					$this->db->where('transport_id', $param2);
	        	    $this->db->update('transport', $data);
	        	    if($_FILES['userfile']['name'] != "")
					{
						unlink("uploads/transport/".$param2.".jpg");   
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/transport/'.$param2.'.jpg');
						$data_update['photo']=$param2.'.jpg';
						$this->db->where('transport_id', $param2);
	        	    	$this->db->update('transport', $data_update);
					}
					$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));			
				}
	     	   redirect(base_url() . 'index.php?admin/transport/','refresh');
        }
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = 'Transport';
        $this->load->view('backend/index', $page_data);
	
	}
	public function route($param1 = '', $param2 = '',$param3 = '')
	{
		if ($param1 == 'create_route')
		{
				$data['route_name']  	 = $this->input->post('route_name');
				$data['vehical']         = $this->input->post('vehical');
				$data['driver_name']     = $this->input->post('driver_name');			
				$data['mobile_number']   = $this->input->post('mobile_number');			
           		$data['amount']   	     = $this->input->post('amount');
            	
            	$this->db->insert('transport_route', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));			
	      
	        redirect(base_url() . 'index.php?admin/route/','refresh');
        }
        if ($param1 == 'transport_route_do_update')
		{
				$data['route_name']  	 = $this->input->post('route_name');
				$data['vehical']         = $this->input->post('vehical');
				$data['driver_name']     = $this->input->post('driver_name');			
				$data['mobile_number']   = $this->input->post('mobile_number');			
           		$data['amount']   	     = $this->input->post('amount');
           
           		$this->db->where('transport_route_id', $param2);
	            $this->db->update('transport_route', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));			
	      
	        redirect(base_url() . 'index.php?admin/route/','refresh');

		}
		if ($param1 == 'transport_route_stop_create')
		{
				$data['route_id']  	 	 = $this->input->post('route_id');
				$data['stop_name']  	 = $this->input->post('stop_name1');			
           		
				$this->db->insert('transport_route_stop', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));			
	      
	        redirect(base_url() . 'index.php?admin/route/','refresh');
        }
        if ($param1 == 'transport_route_stop_update')
		{
				$data['route_id']  	 	 = $this->input->post('route_id');
				$data['stop_name']  	 = $this->input->post('stop_name1');			
           		
           		$this->db->where('transport_route_stop_id', $param2);
	            $this->db->update('transport_route_stop', $data);
				$this->session->set_flashdata('flash_message' , get_phrase('data_updated_successfully'));			
	      
	        redirect(base_url() . 'index.php?admin/route/','refresh');

		}
		if ($param1 == 'delete') 
		{
        	$this->db->where('transport_route_stop_id', $param2);
        	$this->db->delete('transport_route_stop');
	    	$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/route/', 'refresh');
        }
        
		$page_data['page_name']  = 'route';
        $page_data['page_title'] = 'Manage Route';
        $this->load->view('backend/index', $page_data);

	}
	public function route_assign_student($param1 = '', $param2 = '',$param3 = '')
	{
		if ($param1 == 'assign_route_student')
		{
				$data['class_id']  	 		= $this->input->post('class_id');
				$data['student_id']         = $this->input->post('student_id');
				$data['route_id']     		= $this->input->post('route_name1');			
				$data['stop_name']       	= $this->input->post('stop_name1');
            	$duplicate_student=$this->db->get_where('transport_assign_student_route',array('student_id'=>$data['student_id']))->num_rows();
            	if($duplicate_student > 0)
            	{
            		$this->session->set_flashdata('flash_message' , get_phrase('Already assign the route'));				
            	}
            	else
            	{
            		$this->db->insert('transport_assign_student_route', $data);
					$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));			
            	}
		        redirect(base_url() . 'index.php?admin/route_assign_student/','refresh');
        }
		$page_data['page_name']  = 'route_assign_student';
        $page_data['page_title'] = 'Route Assign Student';
        $this->load->view('backend/index', $page_data);
	}

	/* Develop By Hardik Bhut 25-april-2016 */
    function get_route($route_id)
    {
    	$this->db->select('transport.seat_capacity,transport.registration_no,transport.vehical_type,transport_route.amount,transport_route.driver_name,transport_route.mobile_number');
    	$this->db->join('transport','transport.registration_no=transport_route.vehical');
    	$get_route_detail = $this->db->get_where('transport_route' , array('transport_route_id' => $route_id))->result_array();

    	$this->db->select('transport_route_stop.transport_route_stop_id,transport_route_stop.stop_name');
		$this->db->join('transport_route','transport_route_stop.route_id=transport_route.transport_route_id');	
		$get_stop_detail = $this->db->get_where('transport_route_stop' , array('route_id' => $route_id))->result_array();
		foreach ($get_route_detail as $row_route_detail)
	  	{
			$vehical[]=$row_route_detail['registration_no'].' - '.$row_route_detail['vehical_type'];
			$seat_capacity[]=$row_route_detail['seat_capacity'];
			$amount[]=$row_route_detail['amount'];
			$driver_name[]=$row_route_detail['driver_name'];
			$mobile_no[]=$row_route_detail['mobile_number'];
		}
		$stop_name[]='<option value="">Select Stop</option>';
		foreach ($get_stop_detail as $row_stop_detail)
		{
			$stop_name[]='<option value="'.$row_stop_detail['transport_route_stop_id'].'">'.$row_stop_detail['stop_name'].'</option>';
		}

	  	$response = array('mobile_no'=>$mobile_no,'driver_name'=>$driver_name,'vehical'=>$vehical,'seat_capacity'=>$seat_capacity,'route_amount'=>$amount,'stop_name'=>$stop_name); 
		echo json_encode($response);
    }


}

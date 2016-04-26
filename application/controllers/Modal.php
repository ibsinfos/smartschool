<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends CI_Controller {

	
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
    }
	
	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{
		
	}
	
	
	public function exam($page_name = '' , $param2 = '' , $param3 = '')
	{
				if($page_name=="class_wise_exam_list")
				{
					if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
					{
						$page_data['class_id']       = $this->input->post('class_id');
						$page_data['exam_id']     = $this->input->post('exam_id');
					}
				}
				if($page_name=="student_mark_list")
				{
				
					$page_data['class_id']       = $this->input->post('class_id');
					$page_data['exam_id']     = $this->input->post('exam_id');
					$page_data['student_id']     = $this->input->post('student_id');
				}
				
				if($page_name=="class_wise_top3_student_list")
				{
					$page_data['class_id']       = $this->input->post('class_id');
					$page_data['exam_id']     = $this->input->post('exam_id');
					$page_data['student_id']     = $this->input->post('student_id');
				}
				
				if($page_name=="subject_wise_top3_student_list")
				{
					$page_data['subject']    = $this->input->post('subject');
					$page_data['standard']     = $this->input->post('standard');
				}
		
	
		
		
		
				$account_type		=	$this->session->userdata('login_type');
				$page_data['param2']		=	$param2;
				$page_data['param3']		=	$param3;
				$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
				echo '<script src="assets/js/neon-custom-ajax.js"></script>';
		
	}
	
	
		function fees_listing($page_name='', $param2 = '' , $param3 = '')
		{
			
		
		if($page_name=="fees_listing_page")
				{
					if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
					{
						
						$page_data['standard']       = $this->input->post('standard');
						
					}
				}
				
					$account_type		=	$this->session->userdata('login_type');
				$page_data['param2']		=	$param2;
				$page_data['param3']		=	$param3;
				$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
				echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	
		}
	/*
	*	$page_name		=	The name of page
	*/
		function timetable($page_name = '' , $param2 = '' , $param3 = '')
		{
				if($page_name=="timetable_class_wise_list")
				{
					if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
					{
						$page_data['class_id']       = $this->input->post('class_id');
						$page_data['month']       = $this->input->post('month');
						$page_data['week']       = $this->input->post('week');	
					}
				}
				if($page_name=="timetable_teacher_wise_list")
				{
					if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
					{
						$page_data['teacher_id']       = $this->input->post('teacher_id');
						$page_data['month']       = $this->input->post('month');
						$page_data['week']       = $this->input->post('week');	
					}
				}
		
	
		
		
		
				$account_type		=	$this->session->userdata('login_type');
				$page_data['param2']		=	$param2;
				$page_data['param3']		=	$param3;
				$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
				echo '<script src="assets/js/neon-custom-ajax.js"></script>';
		}
		
		
		function staffattendance($page_name = '' , $param2 = '' , $param3 = '')
	{
		
		if($page_name=="staff_attendence_list")
				{
					if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
					{
						
						$page_data['month']       = $this->input->post('month');
						
					}
				}
				
					$account_type		=	$this->session->userdata('login_type');
				$page_data['param2']		=	$param2;
				$page_data['param3']		=	$param3;
				$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
				echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
	
	function ind_student($page_name = '', $param2 = '',$param3 = '')
	{
		
		
			$page_data['class_id'] = $this->input->post('class_id');
			$page_data['student_id'] = $this->input->post('student_id');
			$account_type		=	$this->session->userdata('login_type');
			$page_data['param2']		=	$param2;
			$page_data['param3']		=	$param3;
		$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
			
	}
	
	function popup2($page_name = '' , $param2 = '' , $param3 = '')
	{
		if($page_name=="attendance_class_wise_list")
		{
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$page_data['class_id']       = $this->input->post('class_id');
			$page_data['from_date']       = $this->input->post('from_date');
			$page_data['to_date']       = $this->input->post('to_date');		
		}
		}
		
		if($page_name=="attendance_standard_list")
		{
			if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
			{
				$page_data['class_id']       = $this->input->post('class_id');
				$page_data['from_date']       = $this->input->post('from_date');
				$page_data['to_date']       = $this->input->post('to_date');			
			}	
		}
		if($page_name=="all_attendance_list")
		{
			if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
			{
				$page_data['class_id']       = $this->input->post('class_id');
				$page_data['from_date']       = $this->input->post('from_date');
				$page_data['to_date']       = $this->input->post('to_date');			
			}	
		}
		
		
		
		$account_type		=	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
		$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
		echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
	
	
	
	
	function popup($page_name = '' , $param2 = '' , $param3 = '')
	{
		
		
		
		$account_type		=	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
		$this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
		echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
	
}


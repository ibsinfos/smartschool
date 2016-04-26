<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 
 * @author  : Searchnative India
 * date  : 02 Nov, 2015
 *  Smart School system
 * http://searchnative.in
 * hello@searchnative.in
 */

class History extends CI_Controller
{
 function __construct()
 {
  parent::__construct();
 }
 
 
 
 public function student()
	{
		
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$roll = $this->input->post("student_id");
			$academic_id = $this->input->post("academic_id");
			$years = explode("/",$academic_id);
			$history_start = $years[0];
			$history_end = $years[1];
			
			$basic_info = $this->db->get_where("history_student",array("roll"=>$roll,"history_start"=>$history_start,"history_end"=>$history_end))->result_array();
		            
			$page_data['basic_info'] = $basic_info;
			     
		}	
			$page_data['page_name']  = 'history_student';
       		$page_data['page_title'] = get_phrase('student_history');
	
			$this->load->view('backend/index', $page_data);	
		
	}
 public function index()
 {
  
  
  $get_staff=$this->db->get('teacher')->result_array();
  foreach($get_staff as $row_staff):
  $data['staff_fullname']=$row_staff['name'];
  $data['staff_fathername']=$row_staff['father_name'];
  $data['staff_mothername']=$row_staff['mother_name'];
  $data['staff_birthday']=$row_staff['birthday'];
  $data['staff_sex']=$row_staff['sex'];
  $data['staff_blood_group']=$row_staff['blood_group'];
  $data['staff_phone']=$row_staff['phone'];
  $data['staff_email']=$row_staff['email'];
  $data['staff_designation']=$row_staff['designation'];
  $data['staff_id']=$row_staff['teacher_id'];
  $data['staff_address']=$row_staff['address'];
  $data['staff_teaching_type']=$row_staff['teaching_type'];
  $data['staff_year']=date('Y', strtotime($row_staff['created_date']));
  $data['staff_month']=date('m', strtotime($row_staff['created_date']));
  $this->db->insert('history_staff',$data); 
  endforeach;
  
$get_staff_attendance=$this->db->get_where('attendance',array('teacher_id !='=>0))->result_array();
	  foreach($get_staff_attendance as $row_staff_attendance):
	   $data_staff_attendance['staff_id']=$row_staff_attendance['teacher_id'];
	   $data_staff_attendance['staff_description']=$row_staff_attendance['description'];
	   $data_staff_attendance['staff_attendance_date']=$row_staff_attendance['date'];
	   $data_staff_attendance['leave_type']=$row_staff_attendance['leave_type'];
	   $data_staff_attendance['statt_attendance_year']=date('Y', strtotime($row_staff_attendance['created_date']));
  	   $data_staff_attendance['statt_attendance_month']=date('m', strtotime($row_staff_attendance['created_date']));
	   $this->db->insert('history_staff_attendance',$data_staff_attendance); 
       endforeach;
	   
	   
	   
	   /*  Developed By Mayur Panchal */
	   
		
		
		$history_start = '2016';
			$history_end = '2017';
			
			$get_students = $this->db->get_where('history_student',array('history_start'=>$history_start,"history_end"=>$history_end))->result_array();
			
			if(empty($get_students))
			{
			$this->db->distinct('name_numeric');		
			$result = $this->db->get('class')->result_array();
			
			foreach($result as $row):
			$class_id = $row['name_numeric'];
			$students = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
				foreach($students as $std):
				
						$data = array("student_id"=>$std['student_id'],
									"name"=>$std['name'],
									"birthday"=>$std['birthday'],
									"sex"=>$std['sex'],
									"religion"=>$std['religion'],
									"blood_group"=>$std['blood_group'],
									"address"=>$std['address'],
									"phone"=>$std['phone'],
									"email"=>$std['email'],
									"password"=>$std['password'],
									"father_name"=>$std['father_name'],
									"mother_name"=>$std['mother_name'],
									"parent_email"=>$std['parent_email'],
									"parent_pass"=>$std['parent_pass'],
									"parent_real_pass"=>$std['parent_real_pass'],
									"student_image"=>$std['student_image'],
									"class_id"=>$std['class_id'],
									"identification_num"=>$std['identification_num'],
									"transport_id"=>$std['transport_id'],
									"dormitory_id"=>$std['dormitory_id'],
									"roll"=>$std['roll'],
									"real_pass"=>$std['real_pass'],
									"std_status"=>$std['std_status'],
									"group_id"=>$std['group_id'],
									"user_type"=>$std['user_type'],
									"curr_date"=>$std['curr_date'],
									"history_start"=>$history_start,
									"history_end"=>$history_end);
						
						$this->db->insert("history_student",$data);
						
						
						
						
				endforeach;
				
					
			endforeach;
			
			
			}
			
			$history_exam = $this->db->get_where("history_exam",array("history_start"=>$history_start,"history_end"=>$history_end))->result_array();
			if(empty($history_exam))
			{
				
			$exam = $this->db->get("exam")->result_array();
			foreach($exam as $rowexam):					
					$exam_data = array("exam_id"=>$rowexam['exam_id'],
					"name"=>$rowexam['name'],
					"class_id"=>$rowexam['class_id'],
					"subject_id"=>$rowexam['subject_id'],
					"date"=>$rowexam['date'],
					"time_start"=>$rowexam['time_start'],
					"time_end"=>$rowexam['time_end'],
					"out_of_marks"=>$rowexam['out_of_marks'],
					"created_date"=>$rowexam['created_date'],
					"history_start"=>$history_start,
					"history_end"=>$history_end);
					
					
			$this->db->insert("history_exam",$exam_data);
					
					
			endforeach;
			
			}
	
			
			$history_mark = $this->db->get_where("history_mark",array("history_start"=>$history_start,"history_end"=>$history_end))->result_array();
			if(empty($history_mark))
			{
			$mark = $this->db->get('mark')->result_array();
			
			
			
			
			foreach($mark as $rows):
				
				$mark_data = array("mark_id"=>$rows['mark_id'],
				"mark_id"=>$rows['mark_id'],
				"student_id"=>$rows['student_id'],
				"student_name"=>$rows['student_name'],
				"roll_no"=>$rows['roll_no'],
				"subject_id"=>$rows['subject_id'],
				"subject_name"=>$rows['subject_name'],
				"class_id"=>$rows['class_id'],
				"exam_id"=>$rows['exam_id'],
				"mark_obtained"=>$rows['mark_obtained'],
				"mark_total"=>$rows['mark_total'],
				"mark_id"=>$rows['mark_id'],
				"year"=>$rows['year'],
				"uplaoded_file_name"=>$rows['uplaoded_file_name'],
				"created_date"=>$rows['created_date'],
				"history_start"=>$history_start,
				"history_end"=>$history_end);
				
				$this->db->insert("history_mark",$mark_data);
			endforeach;
			
			
			}
			$get_student_history_attend =$this->db->get_where('history_student_attendance',array('history_start'=>$history_start,"history_end"=>$history_end))->result_array();
			if(empty($get_student_history_attend))
			{
			
			$get_student_attend =$this->db->get_where('attendance',array('student_id !='=>0))->result_array();
			foreach($get_student_attend as $attend):
				
				$attand_data = array("attendance_id"=>$attend['attendance_id'],
				"status"=>$attend['status'],
				"student_id"=>$attend['student_id'],
				"teacher_id"=>$attend['teacher_id'],
				"attandence_class"=>$attend['attandence_class'],
				"description"=>$attend['description'],
				"date"=>$attend['date'],
				"month"=>$attend['month'],
				"leave_type"=>$attend['leave_type'],
				"created_date"=>$attend['created_date'],
				"history_start"=>$history_start,
				"history_end"=>$history_end);
				
				$this->db->insert("history_student_attendance",$attand_data);
				
			endforeach;
			
			
			}
			$history_assessment = $this->db->get_where("history_assessment",array("history_start"=>$history_start,"history_end"=>$history_end))->result_array();
			
			if(empty($history_assessment))
			{
			
			$assessment = $this->db->get("assessment")->result_array();
			foreach($assessment as $rowas):
				
				$ass_data = array("assessment_id"=>$rowas['assessment_id'],
				"class_id"=>$rowas['class_id'],
				"student_id"=>$rowas['student_id'],
				"behaviour"=>$rowas['behaviour'],
				"created_date"=>$rowas['created_date'],
				"history_start"=>$history_start,
				"history_end"=>$history_end
				);
				
				$this->db->insert("history_assessment",$ass_data);
				
			
			endforeach;
			
			
			}
			
			/* End Mayur Panchal */
    
 }
 
 
 
 
 
}
  	//$this->db->truncate('attendance');
	//$this->db->truncate('teacher');
	// $this->db->truncate('exam'); 
   // $this->db->truncate('assessment'); 
   // $this->db->truncate('attendance'); 
   // $this->db->truncate('mark');
?>
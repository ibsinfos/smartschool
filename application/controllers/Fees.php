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

class Fees extends CI_Controller
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
	 }
 
 function reciept()
 {
	 	$page_data['class_id'] = $this->input->post('class_id');
		$page_data['student'] = $this->input->post('student');
		$page_data['page_name']  = 'fees_reciept';
       	$page_data['page_title'] = get_phrase('reciept');
	
		$this->load->view('backend/index', $page_data);
	
	 
	 
	}
 		
 	function index()
	{
			$fees = $this->db->get("invoice")->result_array();
			$page_data['fees']= $fees;
			$page_data['page_name']  = 'student_fees';
       		$page_data['page_title'] = get_phrase('fees');
	
			$this->load->view('backend/index', $page_data);		
			
	}
	
	function delete($param='')
	{
		$this->db->delete("invoice",array("invoice_id"=>$param));
		$this->session->set_flashdata('flash_message' , get_phrase('delete_successfully')); 
		redirect(base_url() . 'index.php?fees/', 'refresh');
		
	}
	
	function editfees()
	{
		
		$class = $this->input->post('class');
			$invoice = $this->input->post('invoice');
		$fees_type	 = $this->input->post('fees_type');
		$amount_paid	 = $this->input->post('amount_paid');
		$outstanding = $this->input->post('outstanding');
		$status = $this->input->post('status');
		$date = $this->input->post('date');
		$payment_details = $this->input->post('payment_details');
		$paid_date = date('Y-m-d',strtotime($date));
		
			$array = array("amount_paid"=>$amount_paid,
					 "invoice_type"=>$fees_type,
					 "payment_details"=>$payment_details,
					 "outstanding"=>$outstanding,
					 "status"=>$status,
					 "paid_date"=>$paid_date);
		$this->db->update("invoice",$array,array("invoice_id"=>$invoice));
		$this->session->set_flashdata('flash_message' , get_phrase('update_successfully')); 
		redirect(base_url() . 'index.php?fees/', 'refresh');
		
	}
	
	function addfees()
	{
		
		$student = $this->input->post('student');
		$class = $this->input->post('class');
		$fees_type	 = $this->input->post('fees_type');
		$amount_paid	 = $this->input->post('amount_paid');
		$outstanding = $this->input->post('outstanding');
		$status = $this->input->post('status');
		$date = $this->input->post('date');
		$payment_details = $this->input->post('payment_details');
		$paid_date = date('Y-m-d',strtotime($date));
		
		$get_student = $this->db->get_where("student",array("student_id"=>$student))->result_array();
		if(empty($get_student[0]['name']))
		{
			$this->session->set_flashdata('flash_message' , get_phrase('student_not_found')); 
			redirect(base_url() . 'index.php?fees/', 'refresh');
		}
		$name = $get_student[0]['name'];
		$array = array("student_id"=>$student,
						"student_name"=>$name,						
					 "class"=>$class,
					 "amount_paid"=>$amount_paid,
					 "invoice_type"=>$fees_type,
					 "payment_details"=>$payment_details,
					 "outstanding"=>$outstanding,
					 "status"=>$status,
					 "paid_date"=>$paid_date);
		$this->db->insert("invoice",$array);
		$this->session->set_flashdata('flash_message' , get_phrase('fees_added_successfully')); 
		redirect(base_url() . 'index.php?fees/', 'refresh');
	}
 
 
 
}
  	//$this->db->truncate('attendance');
	//$this->db->truncate('teacher');
	// $this->db->truncate('exam'); 
   // $this->db->truncate('assessment'); 
   // $this->db->truncate('attendance'); 
   // $this->db->truncate('mark');
?>
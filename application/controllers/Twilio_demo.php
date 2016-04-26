<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twilio_demo extends CI_Controller {

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

	function index()
	{
		
		 $row = $this->db->get_where('settings',array('settings_id'=>'17'))->result_array();

 $row2 = $this->db->get_where('settings',array('settings_id'=>'18'))->result_array();	
  $row3 = $this->db->get_where('settings',array('settings_id'=>'19'))->result_array();
  
  $account_sid   = $row[0]['description'];
	$this->session->set_userdata('account_sid',$account_sid );
	/**
	 * Auth Token
	 **/
	$auth_token    = $row2[0]['description'];
$this->session->set_userdata('auth_token',$auth_token );
	/**
	 * API Version
	 **/


	/**
	 * Twilio Phone Number
	 **/
	$number        = $row3[0]['description'];
	$this->session->set_userdata('number',$number );
		
		$this->load->library('twilio');
	

		if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
		{
			$from = '12015319463';
			$to = $this->input->post('phone_number');
			$message = $this->input->post('message');
	
			$response = $this->twilio->sms($from, $to, $message);
			 $this->session->set_flashdata('flash_message',get_phrase('message_sent_successfully')); 
			
		}
		 $page_data['page_name']  = 'sms_management';
        $page_data['page_title'] = 'SMS';
        $this->load->view('backend/index', $page_data);
		
	}

}

/* End of file twilio_demo.php */

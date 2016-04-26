<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Getinfo  extends CI_Controller {
		
		
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
		public function index()
		{
			
		}
		function getinfo($param1 = '')
		{
			if (isset($_POST) && isset($_POST['entity'])) {
				//echo $_POST['entity'];
				
				$page_data['page_name']  = 'getinfo';        
				$this->load->view('backend/getinfo', $page_data);
				}else {
				redirect(base_url(), 'refresh');
			}
		}
		function getinfostudent()
		{
			$page_data['page_name']  = 'getinfostudent';        
			$this->load->view('backend/getinfostudent', $page_data);
			
		}
		function getinfoparent()
		{
			$page_data['page_name']  = 'getinfoparent';     
			
			$this->load->view('backend/getinfoparent', $page_data);
		}
		function fromstudent($param1 = '')
		{
			if (isset($_POST) && isset($_POST['entity'])) {
				//echo $_POST['entity'];
				
				$page_data['page_name']  = 'getstudent';        
				$this->load->view('backend/getstudent', $page_data);
				}else {
				redirect(base_url(), 'refresh');
			}
		}
		function fromteacher()
		{
			if (isset($_POST) && isset($_POST['entity'])) {
				$page_data['page_name']  = 'getteacher';        
				$this->load->view('backend/getteacher', $page_data);
				}else {
				redirect(base_url(), 'refresh');
			}
		}
		function fromparent()
		{
			if (isset($_POST) && isset($_POST['entity'])) {
				$page_data['page_name']  = 'getparent';        
				$this->load->view('backend/getparent', $page_data);
				}else {
				redirect(base_url(), 'refresh');
			}
		}
                function getallstudent()
                {
                    $all=$this->db->get('student')->result();
                   // print_r($all);
                    foreach($all as $rec)
                        {							
                            $allid[] = $rec->student_id;
                            $name[] = $rec->name; 
                        }
                        $string['name']=implode(',',$name);
			$string['ids']=implode(',',$allid);
			$string['type']=2;
			echo json_encode($string);
                }

	}
	

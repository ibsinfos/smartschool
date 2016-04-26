<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

	/**
	 * Mode ("sandbox" or "prod")
	 **/
	 //$this->load->database();
	 
		 
	$config['mode']   = 'sandbox';

	/**
	 * Account SID
	 **/
	$config['account_sid']   = $_SESSION['account_sid'];

	/**
	 * Auth Token
	 **/
	$config['auth_token']    = $_SESSION['auth_token'];

	/**
	 * API Version
	 **/
	$config['api_version']   = '2010-04-01';

	/**
	 * Twilio Phone Number
	 **/
	$config['number']        = $_SESSION['number'];


/* End of file twilio.php */
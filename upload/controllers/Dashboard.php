<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();		
        $this->load->library('template');
	}
	
	public function index()
	{	
		
		$this->template->view('template/content');
	}

	
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('log_in') == TRUE){
			$where_admin['username']		= $this->session->userdata('username');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			redirect("majalah/edisi");
		} else {
			redirect("login");
		}
	 }
}
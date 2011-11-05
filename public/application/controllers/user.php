<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$data=array();
		$this->template->load('template', 'user/index_view', $data);
	}
	public function back(){
		$o_code=$_GET['code'];
		$git_user=$this->curl->simple_get("https://api.github.com/user?access_token=".$o_code);
		$user_data=json_decode($git_user);
		print_r($user_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
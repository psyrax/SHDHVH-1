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
		//Getting User OAuth
		$o_code=$_GET['code'];
		$url = "https://github.com/login/oauth/access_token";
		$postData = array(
			"client_id" => "bd01925d961b7962f327", 
			"client_secret" => "ec02e79e203ada11e82318c1d69e3bee2e8d12fb"
		);
		/*Convierte el array en el formato adecuado para cURL*/
		$elements = array();
		foreach ($postData as $name=>$value) {
			$elements[] = "{$name}=".urlencode($value);
		}
		$handler = curl_init();
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_POST, 1);
		curl_setopt($handler, CURLOPT_POSTFIELDS, "client_id=bd01925d961b7962f327&client_secret=ec02e79e203ada11e82318c1d69e3bee2e8d12fb");
		$response = curl_exec ($handler);
		curl_close($handler);
		echo 'otra cosa';
		echo $response;
		/*
		$handler = curl_init("https://api.github.com/user?access_token".$o_code);
		$response = curl_exec ($handler);
		curl_close($handler);
		echo $response;*/
		//print_r($user_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
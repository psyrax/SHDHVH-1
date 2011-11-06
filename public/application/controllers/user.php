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
		$this->load->model('users_model', '', TRUE);
		$this->load->helper('url');
		//Getting User OAuth
		$o_code=$_GET['code'];
		$url = "https://github.com/login/oauth/access_token";
		/*Convierte el array en el formato adecuado para cURL*/
		$handler = curl_init();
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_POST, 1);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($handler, CURLOPT_POSTFIELDS, "client_id=bd01925d961b7962f327&client_secret=ec02e79e203ada11e82318c1d69e3bee2e8d12fb&code=".$o_code);
		$response = curl_exec ($handler);
		curl_close($handler);
		$res_data=explode("&", $response);
		if($res_data[0]!="error"):
			$ses_data=array();
			$oauth_data=explode("=", $res_data[0]);
			$ses_data['token']=$oauth_data[1];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://api.github.com/");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$oauth_data[1]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$user_json = curl_exec ($ch);
			curl_close($ch);
			$user_data=json_decode($user_json);
			if(!isset($user_data->message)):
				$login=$this->users_model->get_user('users', $user_data->id);
				if(!$login):
					$insert_data=array(
						'git_id'=>$user_data->id,
						'email'=>$user_data->email,
						'login'=>$user_data->login,
						'git_json'=>$user_json
					);
					$this->users_model->create_user('users', $insert_data);
					$ses_data['git_id']=$user_data->id;
				else:
					$ses_data['git_id']=$login->git_id;
				endif;
			endif;
			$this->session->set_userdata($ses_data);
			redirect('/user/repos', 'refresh');
		else:
			echo "Error";
		endif;
		//print_r($user_data);
	}
	public function repos(){
		$token=$this->session->userdata('token');
		echo $token;
		echo "<hr />";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.github.com/user/repos");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: token '.$token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  			"name": "Hello-World",
  			"description": "This is your first repo",
  			"homepage": "https://github.com",
  			"public": true,
  			"has_issues": true,
  			"has_wiki": true,
  			"has_downloads": true}'
  		);
  		$repo_json = curl_exec ($ch);
  		curl_close($ch);
  		$repo_data=json_decode($repo_json);
  		echo "<h1><a href=\"".$repo_data->html_url."\">Repo created</a>";
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
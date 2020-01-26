<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('M_login');
    }
	
	function index()
	{
		redirect("welcome");
	}
	
	function check()
	{
		$this->form_validation->set_rules('pass', 'E-mail', 'required');
		$this->form_validation->set_rules('identity', 'Password', 'required');
		
		if($this->form_validation->run() == TRUE)
		{
			$data = $this->M_login->check();
			
			if($data == TRUE)
			{
				$data = array(
					'program' => 'Bintang Laundry',
					'pt' => 'PT. Bintang Inti Global',
					'versi' => '1.0.0',
					'lisensi' => '@2018 - ary winar'
					);
				$this->session->set_userdata($data);
				$this->session->set_flashdata('message', $this->messages());
				echo '<script>
                            function refresh() {
                                window.location = "'.base_url().'Dash/";
							}
                            setTimeout("refresh()", 10);
					</script>';
			}
			else
			{
				$this->session->set_flashdata('message', $this->wrongpass());
				redirect('welcome');				
			}
		}
		else
		{
			$this->session->set_flashdata('message', $this->errorvalid());
			redirect('welcome');
		}
	}
	
	public function messages() {
        $_output = '<strong>Success!</strong> Logged in.';
       
        return $_output;
    }
	
	public function wrongpass(){
		$output = '<strong>Error! </strong><br>Wrong Username or Password!';
		return $output;
	}
	
	public function errorvalid(){
		$output ='<strong>Error! Access</strong>';
		return $output;
	}
	
	function signout()
	{
		$this->db->query("update mstlogin set ipaddress='".$this->M_login->get_ip_address()."',lastlogin='".date("Y-m-d")."' where userid=".$this->session->userdata('userid'));
		$this->session->sess_destroy();
		
		redirect('welcome'); // sesudah logout di redirect ke halaman login admin
	}
}
?>
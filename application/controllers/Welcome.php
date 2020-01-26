<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */	
		$this->load->model('M_dasb');
		$this->load->model('M_master');
	}
	
	public function index()
	{
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->load->view('welcome_message',$data);
	}
	
	function showdata(){
		$username=$this->session->userdata('username');
		if(empty($username)){
			redirect("Dash");
		}else{
			$modul=$this->input->post('modul');
			$id=$this->input->post('id');
			$time = strtotime(date("Ymd"));
			$period = date("Ym", strtotime("-1 month", $time));
				
			switch($modul){
				case "tampil_cklreg":
					echo $this->M_dasb->getcklreg($id);
					break;
				
				case "tampil_cklsreg":
					echo $this->M_dasb->getcklreg($id);
					break;
				
				case "tampil_cklexp":
					echo $this->M_dasb->getcklexp($id);
					break;
				
				case "tampil_cklsexp":
					echo $this->M_dasb->getcklexp($id);
					break;
					
				case "tampil_customer":
					echo $this->M_dasb->getcustomer($id);
					break;
				
				case "tampil_tariff":
					echo $this->M_dasb->gettariff($id);
					break;
					
				case "tampil_kilo":
					$data = $this->M_dasb->kilotipe($id);
					echo json_encode($data);
					break;
					
				case "tampil_jenis":
					$data = $this->M_dasb->kilojenis($id);
					echo json_encode($data);
					break;
				
				case "tampil_table":
					$data = $this->M_dasb->kilotable($id);
					echo json_encode($data);
					break;
					
				default:
				break;
			}	
		}
	}
}

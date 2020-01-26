<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {
	 function __construct() {
        parent::__construct();
		$this->load->model('M_login');
		$this->load->model('M_dasb');
		
        if(!$this->session->userdata('outletuser'))
		{ 
			redirect('welcome'); 
		}
    }
	
	 function index() {
		$bln = date("m");
		$data = array(
					'uid' => $this->session->userdata('userid'),
					'uname' => $this->session->userdata('username'),
					'levelid' => $this->session->userdata('levelid'),
					'outletid' => $this->session->userdata('outletid'),
					'status' => $this->session->userdata('status'),
					'foto' => $this->session->userdata('foto'),
					'outletuser' => $this->session->userdata('outletuser'),
					'program' => $this->session->userdata('program'),
					'pt' => $this->session->userdata('pt'),
					'versi' => $this->session->userdata('versi'),
					'lisensi' => $this->session->userdata('lisensi'),
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),
					'totalcash' => $this->M_dasb->gettotalcash(),
					'totalprod' => $this->M_dasb->gettotalprod(),
					'revenue' => $this->M_dasb->getrevenue($bln),
					'produksi' => $this->M_dasb->getproduk($bln),
					'menit' => $this->M_dasb->menitcashier(),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
			
		$this->template->display('dashboard/index', $data);
		
	 }
	
}
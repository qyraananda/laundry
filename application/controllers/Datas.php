<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Datas extends CI_Controller {
	 function __construct() {
        parent::__construct();
		$this->load->model('M_login');
		$this->load->model('M_dasb');
		$this->load->model('M_master');
		
        if(!$this->session->userdata('outletuser'))
		{ 
			redirect('welcome'); 
		}
    }
	
	function harga() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
							'uid' => $this->session->userdata('userid'),
							'levelid' => $this->session->userdata('levelid'),
							'outletid' => $this->session->userdata('outletid'),
							'foto' => $this->session->userdata('foto'),
							'outletuser' => $this->session->userdata('outletuser'),
							'program' => $this->session->userdata('program'),
							'pt' => $this->session->userdata('pt'),
							'versi' => $this->session->userdata('versi'),
							'lisensi' => $this->session->userdata('lisensi'),
							
							"notif" => $this->M_dasb->gettotalcash(),
							'dtlnotif' => $this->M_dasb->totalcash(),
							'harga' => $this->M_dasb->dttariff1(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('datas/harga_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function harga_create(){
		 $session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
					'button' => 'Create',
					'action' => site_url('Datas/harga_createaction'),
					'uid' => $this->session->userdata('userid'),
					'levelid' => $this->session->userdata('levelid'),
					#'outletid' => $this->session->userdata('outletid'),
					'foto' => $this->session->userdata('foto'),
					'outletuser' => $this->session->userdata('outletuser'),
					'program' => $this->session->userdata('program'),
					'pt' => $this->session->userdata('pt'),
					'versi' => $this->session->userdata('versi'),
					'lisensi' => $this->session->userdata('lisensi'),
					'outletid' => '',
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),
					'tariffid' => set_value('tariffid'),
					'tariff' => set_value('tariff'),
					'harga' => set_value('harga'),
					'diskon' => set_value('diskon'),
					'diskondate' => set_value('diskondate'),
					'satuan' => set_value('satuan'),
					'jenis' => set_value('jenis'),
					'tipe' => set_value('tipe'),
					'perkg' => '',
					
					'dd_outlet' => $this->M_dasb->dd_outlet(),
					'dd_satuan' => $this->M_master->status("dttariff","satuan"),
					'dd_tipe' => $this->M_master->status("dttariff","tipe"),
					'dd_jenis' => $this->M_master->status("dttariff","jenis"),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('datas/harga_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function harga_createaction() {
		$fields = array("0"=>"tariff");
		$display = array("tariff"=>"Tariff");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->harga();
        } else{
			try{
				$foto = $this->M_master->set_file_upload('foto','assets/uploads/files');
				$data = array(
						'outletid' => $this->input->post('outletid'),
						'tariff' => $this->input->post('tariff'),
						'harga' => $this->input->post('harga'),
						'diskon' => $this->input->post('diskon'),
						'diskondate' => $this->input->post('diskondate'),
						'satuan' => $this->input->post('satuan'),
						'jenis' => $this->input->post('jenis'),
						'tipe' => $this->input->post('tipe'),
						'perkg' => $this->input->post('perkg')
					);	
				    
					if(!empty($foto)){
						$data['foto'] = $foto;
					}
					
					$this->M_master->insert("dttariff", $data);
					$this->harga();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function harga_update($id) {
		$row = $this->M_master->get_by_id("dttariff","tariffid",$id);
		
        if ($row) {
			$data = array(
				   'button' => 'Update',
				    'action' => site_url('Datas/harga_updateaction'),
				    'foto' => $this->session->userdata('foto'),
					'uid' => $this->session->userdata('userid'),
				    'outletuser' => $this->session->userdata('outletuser'),
				    'program' => $this->session->userdata('program'),
				    'pt' => $this->session->userdata('pt'),
				    'versi' => $this->session->userdata('versi'),
				    'lisensi' => $this->session->userdata('lisensi'),
					
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),
					'outletid' => set_value('outletid',$row->outletid),
					'tariffid' => set_value('tariffid',$row->tariffid),
					'tariff' => set_value('tariff',$row->tariff),
					'harga' => set_value('harga',$row->harga),
					'diskon' => set_value('diskon',$row->diskon),
					'diskondate' => set_value('diskondate',$row->diskondate),
					'satuan' => set_value('satuan',$row->satuan),
					'jenis' => set_value('jenis',$row->jenis),
					'tipe' => set_value('tipe',$row->tipe),
					'perkg' => set_value('perkg',$row->perkg),
					
					'dd_outlet' => $this->M_dasb->dd_outlet(),
					'dd_satuan' => $this->M_master->status("dttariff","satuan"),
					'dd_tipe' => $this->M_master->status("dttariff","tipe"),
					'dd_jenis' => $this->M_master->status("dttariff","jenis"),
					'daftarmenu'=>$this->M_dasb->mstmenu(),
					'menulogin' => $this->M_dasb->menulogin(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('datas/harga_form', $data);
		}
	 }
	 
	 function harga_updateaction() {
		$fields = array("0"=>"tariff");
		$display = array("tariff"=>"Tariff");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->harga();
        } else{
			try{
				$foto = $this->M_master->set_file_upload('foto','assets/uploads/files');
				$data = array(
						'outletid' => $this->input->post('outletid'),
						'tariff' => $this->input->post('tariff'),
						'harga' => $this->input->post('harga'),
						'diskon' => $this->input->post('diskon'),
						'diskondate' => $this->input->post('diskondate'),
						'satuan' => $this->input->post('satuan'),
						'jenis' => $this->input->post('jenis'),
						'tipe' => $this->input->post('tipe'),
						'perkg' => $this->input->post('perkg')
					);	
					
					if(!empty($foto)){
						$data['foto'] = $foto;
					}
					
					$this->M_master->update("dttariff","tariffid",$this->input->post('tariffid'), $data);
					$this->harga();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());	
			}
		}
	 }
	 
	 function customer() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
							'uid' => $this->session->userdata('userid'),
							'levelid' => $this->session->userdata('levelid'),
							'outletid' => $this->session->userdata('outletid'),
							'foto' => $this->session->userdata('foto'),
							'outletuser' => $this->session->userdata('outletuser'),
							'program' => $this->session->userdata('program'),
							'pt' => $this->session->userdata('pt'),
							'versi' => $this->session->userdata('versi'),
							'lisensi' => $this->session->userdata('lisensi'),
							
							"notif" => $this->M_dasb->gettotalcash(),
							'dtlnotif' => $this->M_dasb->totalcash(),
							'customer' => $this->M_dasb->dtcustomer(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('datas/customer_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function customer_create() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
							'button' => 'Create',
							'action' => site_url('Datas/customer_createaction'),
							'uid' => $this->session->userdata('userid'),
							'levelid' => $this->session->userdata('levelid'),
							'foto' => $this->session->userdata('foto'),
							'outletuser' => $this->session->userdata('outletuser'),
							'program' => $this->session->userdata('program'),
							'pt' => $this->session->userdata('pt'),
							'versi' => $this->session->userdata('versi'),
							'lisensi' => $this->session->userdata('lisensi'),
							
							"notif" => $this->M_dasb->gettotalcash(),
							'dtlnotif' => $this->M_dasb->totalcash(),
							'customerid' => set_value('customerid'),
							'customer' => set_value('customer'),
							'outletid' => set_value('outletid'),
							'alamat' => set_value('alamat'),
							'handphone' => set_value('handphone'),
							
							'dd_outlet' => $this->M_dasb->dd_outlet(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('datas/customer_form', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function customer_createaction() {
		$fields = array("0"=>"customer");
		$display = array("customer"=>"Customer");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->customer();
        } else{
			try{
				
				$data = array(
						'customer' => $this->input->post('customer'),
						'alamat' => $this->input->post('alamat'),
						'outletid' => $this->input->post('outletid'),
						'handphone' => $this->input->post('handphone'),
					);	
										
					$this->M_master->insert("dtcustomer", $data);
					$this->customer();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function customer_update($id) {
		$row = $this->M_master->get_by_id("dtcustomer","customerid",$id);
		
        if ($row) {
			$data = array(
				   'button' => 'Update',
				    'action' => site_url('Datas/customer_updateaction'),
				    'foto' => $this->session->userdata('foto'),
					'uid' => $this->session->userdata('userid'),
				    'outletuser' => $this->session->userdata('outletuser'),
				    'program' => $this->session->userdata('program'),
				    'pt' => $this->session->userdata('pt'),
				    'versi' => $this->session->userdata('versi'),
				    'lisensi' => $this->session->userdata('lisensi'),
					
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),					
					'customerid' => set_value('customerid',$row->customerid),
					'customer' => set_value('customer',$row->customer),
					'outletid' => set_value('outletid',$row->outletid),
					'alamat' => set_value('alamat',$row->alamat),
					'handphone' => set_value('handphone',$row->handphone),
					
					
					'dd_outlet' => $this->M_dasb->dd_outlet(),
					'daftarmenu'=>$this->M_dasb->mstmenu(),
					'menulogin' => $this->M_dasb->menulogin(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('datas/customer_form', $data);
		}
	 }
	 
	 function customer_updateaction() {
		$fields = array("0"=>"customer");
		$display = array("customer"=>"Customer");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->customer();
        } else{
			try{
				
				$data = array(
						'customer' => $this->input->post('customer'),
						'alamat' => $this->input->post('alamat'),
						'outletid' => $this->input->post('outletid'),
						'handphone' => $this->input->post('handphone'),
					);	
										
					$this->M_master->update("dtcustomer","customerid",$this->input->post("customerid"), $data);
					$this->customer();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
}
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Controller {
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
	
	 function daftarmenu() {
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
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/daftarmenu_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function daftarmenu_create(){
		 $session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
					'button' => 'Create',
					'action' => site_url('Masters/daftarmenu_createaction'),
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
					'parent' => set_value('parent'),
					'header' => set_value('header'),
					'submenu' => set_value('submenu'),
					'class_icon' => set_value('class_icon'),
					'status' => set_value('status'),
					'menuid' => set_value('menuid'),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/daftarmenu_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	
	public function daftarmenu_createaction(){
		$fields = array("0"=>"header","1"=>"submenu");
		$display = array("header"=>"Header","submenu"=>"Submenu");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->daftarmenu();
        } else {
            $data = array(
				'parent' => $this->input->post('parent',TRUE),
                'header' => $this->input->post('header', TRUE),
				'submenu' => $this->input->post('submenu',TRUE),
				'class_icon' => $this->input->post('class_icon',TRUE),
				'status' => $this->input->post('status', TRUE)
            );
            $this->M_master->insert("mstmenu", $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->daftarmenu();
        }			
	}
	
	public function daftarmenu_update($id) {
        $row = $this->M_master->get_by_id("mstmenu","menuid",$id);
		
        if ($row) {
				$data = array(
					'button' => 'Update',
					'action' => site_url('Masters/daftarmenu_updateaction'),
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
					'parent' => set_value('parent',$row->parent),
					'header' => set_value('header',$row->header),
					'submenu' => set_value('submenu',$row->submenu),
					'class_icon' => set_value('class_icon',$row->class_icon),
					'status' => set_value('status',$row->status),
					'menuid' => set_value('menuid',$row->menuid),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));
				
				$this->template->display('masters/daftarmenu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->positions();
        }
    }
	
	public function daftarmenu_updateaction(){
		$fields = array("0"=>"header","1"=>"submenu");
		$display = array("header"=>"Header","submenu"=>"Submenu");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->daftarmenu();
        } else {
            $data = array(
				'parent' => $this->input->post('parent',TRUE),
                'header' => $this->input->post('header', TRUE),
				'submenu' => $this->input->post('submenu',TRUE),
				'class_icon' => $this->input->post('class_icon',TRUE),
				'status' => $this->input->post('status', TRUE)
            );
            $this->M_master->update("mstmenu","menuid",$this->input->post('menuid'), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->daftarmenu();
        }			
	}
	
	function menulogin() {
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
							'daftarmenu'=>$this->M_dasb->mstmenu(),
							'menulogin' => $this->M_dasb->menulogin(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/menulogin_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function menulogin_create(){
		 $session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
					'button' => 'Create',
					'action' => site_url('Masters/menulogin_createaction'),
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
					'menuid' => set_value('menuid'),
					'urlmenu' => set_value('urlmenu'),
					'add' => set_value('add'),
					'edit' => set_value('edit'),
					'delete' => set_value('delete'),
					'approve' => set_value('approve'),
					'print' => set_value('print'),
					'id' => set_value('id'),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')),
					'dd_level' => $this->M_dasb->dd_level(),
					'dd_menu' => $this->M_dasb->dd_menu());	
					
					$this->template->display('masters/menulogin_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function menulogin_createaction(){
		$fields = array("0"=>"urlmenu");
		$display = array("urlmenu"=>"Urlmenu");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->menulogin();
        } else {
            $data = array(
				'levelid' => $this->input->post('levelid',TRUE),
                'menuid' => $this->input->post('menuid', TRUE),
				'urlmenu' => $this->input->post('urlmenu',TRUE),
				'add' => $this->input->post('add',TRUE),
				'edit' => $this->input->post('edit', TRUE),
				'delete' => $this->input->post('delete', TRUE),
				'approve' => $this->input->post('approve', TRUE),
				'print' => $this->input->post('print', TRUE)
            );
            $this->M_master->insert("menulogin", $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->menulogin();
        }	
	 }
	 
	 public function menulogin_update($id) {
        $row = $this->M_master->get_by_id("menulogin","id",$id);
		
        if ($row) {
				$data = array(
					'button' => 'Update',
					'action' => site_url('Masters/menulogin_updateaction'),
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
					'levelid' => set_value('levelid',$row->levelid),
					'menuid' => set_value('menuid',$row->menuid),
					'urlmenu' => set_value('urlmenu',$row->urlmenu),
					'add' => set_value('add',$row->add),
					'edit' => set_value('edit',$row->edit),
					'delete' => set_value('delete',$row->delete),
					'approve' => set_value('approve', $row->approve),
					'print' => set_value('print',$row->print),
					'id' => set_value('id',$row->id),
					'dd_level' => $this->M_dasb->dd_level(),
					'dd_menu' => $this->M_dasb->dd_menu(),	
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));
				
				$this->template->display('masters/menulogin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->positions();
        }
    }
	
	function menulogin_updateaction(){
		$fields = array("0"=>"urlmenu");
		$display = array("urlmenu"=>"Urlmenu");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->menulogin();
        } else {
            $data = array(
				'levelid' => $this->input->post('levelid',TRUE),
                'menuid' => $this->input->post('menuid', TRUE),
				'urlmenu' => $this->input->post('urlmenu',TRUE),
				'add' => $this->input->post('add',TRUE),
				'edit' => $this->input->post('edit', TRUE),
				'delete' => $this->input->post('delete', TRUE),
				'approve' => $this->input->post('approve', TRUE),
				'print' => $this->input->post('print', TRUE)
            );
            $this->M_master->update("menulogin","id",$this->input->post('id'), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->menulogin();
        }	
	 }
	 
	 function store() {
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
							'store'=>$this->M_dasb->mststore(),
							'daftarmenu'=>$this->M_dasb->mstmenu(),
							'menulogin' => $this->M_dasb->menulogin(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/store_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function store_create() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
					'button' => 'Create',
					'action' => site_url('Masters/store_createaction'),
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
					'outlet' => set_value('outlet'),
					'alamat' => set_value('alamat'),
					'kota' => set_value('kota'),
					'picname' => set_value('picname'),
					'kontrakdate' => set_value('kontrakdate'),
					'telephone' => set_value('telephone'),
					'lat' => set_value('lat'),
					'lng' => set_value('lng'),
					
					'store'=>$this->M_dasb->mststore(),
					'daftarmenu'=>$this->M_dasb->mstmenu(),
					'menulogin' => $this->M_dasb->menulogin(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/store_form', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function store_createaction(){
		$fields = array("0"=>"outlet","1"=>"alamat","2"=>"kota");
		$display = array("outlet"=>"Store","alamat"=>"Address","kota"=>"City");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->store();
        } else {
            $data = array(
				'outlet' => $this->input->post('outlet',TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
				'kota' => $this->input->post('kota',TRUE),
				'telephone' => $this->input->post('telephone',TRUE),
				'picname' => $this->input->post('picname', TRUE),
				'kontrakdate' => date('Y-m-d',strtotime($this->input->post('kontrakdate', TRUE))),
				'lat' => $this->input->post('lat', TRUE),
				'lng' => $this->input->post('lng', TRUE),
				'username' => $this->session->userdata('username')
            );
            $this->M_master->insert("mstoutlet", $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->store();
        }	
	 }
	 
	 public function store_update($id) {
        $row = $this->M_master->get_by_id("mstoutlet","outletid",$id);
		
        if ($row) {
				$data = array(
					'button' => 'Update',
					'action' => site_url('Masters/store_updateaction'),
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
					'outletid' => set_value('outletid',$row->outletid),
					'outlet' => set_value('outlet',$row->outlet),
					'alamat' => set_value('alamat',$row->alamat),
					'kota' => set_value('kota',$row->kota),
					'telephone' => set_value('telephone',$row->telephone),
					'picname' => set_value('picname',$row->picname),
					'kontrakdate' => set_value('kontrakdate',$row->kontrakdate),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));
				
				$this->template->display('masters/store_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->store();
        }
    }
	
	function store_updateaction(){
		$fields = array("0"=>"outlet","1"=>"alamat","2"=>"kota");
		$display = array("outlet"=>"Store","alamat"=>"Address","kota"=>"City");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->store();
        } else {
            $data = array(
				'outlet' => $this->input->post('outlet',TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
				'kota' => $this->input->post('kota',TRUE),
				'telephone' => $this->input->post('telephone',TRUE),
				'picname' => $this->input->post('picname', TRUE),
				'kontrakdate' => date('Y-m-d',strtotime($this->input->post('kontrakdate', TRUE))),
				'lat' => $this->input->post('lat', TRUE),
				'lng' => $this->input->post('lng', TRUE),
				'username' => $this->session->userdata('username')
            );
            $this->M_master->update("mstoutlet","outletid",$this->input->post('outletid'), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->store();
        }	
	 }
	 
	 function userlevel() {
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
							'userlevel'=>$this->M_dasb->mstlevel(),
							'daftarmenu'=>$this->M_dasb->mstmenu(),
							'menulogin' => $this->M_dasb->menulogin(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/userlevel_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function userlevel_create() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
						'button' => 'Create',
						'action' => site_url('Masters/userlevel_createaction'),
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
						'levelid' => set_value('levelid'),
						'level' => set_value('level'),
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/userlevel_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function userlevel_createaction(){
		$fields = array("0"=>"level");
		$display = array("level"=>"Level");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlevel();
        } else {
            $data = array(
				'level' => $this->input->post('level', TRUE)
            );
            $this->M_master->insert("mstlevel", $data);
            $this->session->set_flashdata('message', '<b>Create Record Success</b>');
            $this->userlevel();
        }	
	 }
	 
	 function userlevel_update($id) {
		$row = $this->M_master->get_by_id("mstlevel","levelid",$id);
		
        if ($row) {
			$data = array(
						'button' => 'Update',
						'action' => site_url('Masters/userlevel_updateaction'),
						'foto' => $this->session->userdata('foto'),
						'uid' => $this->session->userdata('userid'),
						'outletuser' => $this->session->userdata('outletuser'),
						'program' => $this->session->userdata('program'),
						'pt' => $this->session->userdata('pt'),
						'versi' => $this->session->userdata('versi'),
						'lisensi' => $this->session->userdata('lisensi'),
						"notif" => $this->M_dasb->gettotalcash(),
						'dtlnotif' => $this->M_dasb->totalcash(),
						'levelid' => set_value('levelid',$row->levelid),
						'level' => set_value('level',$row->level),
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/userlevel_form', $data);
		}
	 }
	 
	 function userlevel_updateaction(){
		$fields = array("0"=>"level");
		$display = array("level"=>"Level");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlevel();
        } else {
            $data = array(
				'level' => $this->input->post('level', TRUE)
            );
            $this->M_master->update("mstlevel","levelid",$this->input->post('levelid'), $data);
            $this->session->set_flashdata('message', '<b>Update Record Success</b>');
            $this->userlevel();
        }	
	 }
	 
	 function employee() {
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
							'employee'=>$this->M_dasb->mstuser(),
							'daftarmenu'=>$this->M_dasb->mstmenu(),
							'menulogin' => $this->M_dasb->menulogin(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/employee_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function employee_create() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
						'button' => 'Create',
						'action' => site_url('Masters/employee_createaction'),
						'uid' => $this->session->userdata('userid'),
						'outletid' => $this->session->userdata('outletid'),
						'foto' => $this->session->userdata('foto'),
						'outletuser' => $this->session->userdata('outletuser'),
						'program' => $this->session->userdata('program'),
						'pt' => $this->session->userdata('pt'),
						'versi' => $this->session->userdata('versi'),
						'lisensi' => $this->session->userdata('lisensi'),
						"notif" => $this->M_dasb->gettotalcash(),
						'dtlnotif' => $this->M_dasb->totalcash(),
						'levelid' => set_value('levelid'),
						'userid' => set_value('userid'),
						'leader' => set_value('leader'),
						'name' => set_value('name'),
						'address' => set_value('address'),
						'phone' => set_value('phone'),
						'hp' => set_value('hp'),
						'ktp' => set_value('ktp'),
						'rmcode' => set_value('rmcode'),
						'email' => set_value('email'),
						'foto' => set_value('foto'),
						'ktpjpeg' => set_value('ktpjpeg'),
						'npwpjpeg' => set_value('npwpjpeg'),
						'kkjpeg' => set_value('kkjpeg'),
						'jkelamin' => set_value('jkelamin'),
						'birthdate' => '',
						'emergency' => set_value('emergency'),
						'activedate' => '',
						'resigndate' => '',
						'status' => set_value('status'),
						'dd_level' => $this->M_dasb->dd_level(),
						'dd_leader' => $this->M_dasb->dd_leader(),
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/employee_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function employee_createaction(){
		$fields = array("0"=>"name");
		$display = array("name"=>"Name");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlevel();
        } else {
			$foto = $this->M_master->set_file_upload('foto','assets/uploads/files');
			$ktpjpeg = $this->M_master->set_file_upload('ktpjpeg','assets/uploads/files');
			$npwpjpeg = $this->M_master->set_file_upload('npwpjpeg','assets/uploads/files');
			$kkjpeg = $this->M_master->set_file_upload('kkjpeg','assets/uploads/files');
			
            $data = array(
				'levelid' => $this->input->post('levelid', TRUE),
				'leader' => $this->input->post('leader', TRUE),
				'name' => $this->input->post('name',TRUE),
				'address' => $this->input->post('address',TRUE),
				'phone' => $this->input->post('phone',TRUE),
				'hp' => $this->input->post('hp',TRUE),
				'ktp' => $this->input->post('ktp',TRUE),
				'rmcode' => $this->input->post('rmcode',TRUE),
				'email' => $this->input->post('email',TRUE),
				'jkelamin' => $this->input->post('jkelamin', TRUE),
				'birthdate' => date('Y-m-d', strtotime($this->input->post('birthdate', TRUE))),
				'emergency' => $this->input->post('emergency', TRUE),
				'activedate' => date('Y-m-d', strtotime($this->input->post('activedate', TRUE))),
				'status' => $this->input->post('status', TRUE),
            );
			
			if(!empty($foto)){
				$data['foto'] = $foto;
			}
			if(!empty($ktpjpeg)){
				$data['ktpjpeg'] = $ktpjpeg;
			}
			if(!empty($npwpjpeg)){
				$data['npwpjpeg'] = $npwpjpeg;
			}
			if(!empty($kkjpeg)){
				$data['kkjpeg'] = $kkjpeg;
			}
			
            $this->M_master->insert("mstuser", $data);
            #$this->session->set_flashdata('message', '<b>Create Record Success</b>');
            $this->employee();
        }	
	 }
	 
	 function employee_update($id) {
		$row = $this->M_master->get_by_id("mstuser","userid",$id);
		
        if ($row) {
			$data = array(
						'button' => 'Update',
						'action' => site_url('Masters/employee_updateaction'),
						'foto' => $this->session->userdata('foto'),
						'uid' => $this->session->userdata('userid'),
						'outletuser' => $this->session->userdata('outletuser'),
						'program' => $this->session->userdata('program'),
						'pt' => $this->session->userdata('pt'),
						'versi' => $this->session->userdata('versi'),
						'lisensi' => $this->session->userdata('lisensi'),
						"notif" => $this->M_dasb->gettotalcash(),
						'dtlnotif' => $this->M_dasb->totalcash(),
						'userid' => set_value('userid',$row->userid),
						'levelid' => set_value('levelid',$row->levelid),
						'leader' => set_value('leader',$row->leader),
						'name' => set_value('name',$row->name),
						'address' => set_value('address',$row->address),
						'phone' => set_value('phone',$row->phone),
						'hp' => set_value('hp',$row->hp),
						'ktp' => set_value('ktp',$row->ktp),
						'rmcode' => set_value('rmcode',$row->rmcode),
						'email' => set_value('email',$row->email),
						'foto' => set_value('foto',$row->foto),
						'ktpjpeg' => set_value('ktpjpeg',$row->ktpjpeg),
						'npwpjpeg' => set_value('npwpjpeg',$row->npwpjpeg),
						'kkjpeg' => set_value('kkjpeg',$row->kkjpeg),
						'jkelamin' => set_value('jkelamin',$row->jkelamin),
						'birthdate' => set_value('birthdate',$row->birthdate),
						'emergency' => set_value('emergency',$row->emergency),
						'activedate' => set_value('activedate',$row->activedate),
						'resigndate' => set_value('resigndate',$row->resigndate),
						'status' => set_value('status',$row->status),
						'dd_level' => $this->M_dasb->dd_level(),
						'dd_leader' => $this->M_dasb->dd_leader(),
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/employee_form', $data);
		}
	 }
	 
	 function employee_updateaction(){
		$fields = array("0"=>"name");
		$display = array("name"=>"Name");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlevel();
        } else {
			$foto = $this->M_master->set_file_upload('foto','assets/uploads/files');
			$ktpjpeg = $this->M_master->set_file_upload('ktpjpeg','assets/uploads/files');
			$npwpjpeg = $this->M_master->set_file_upload('npwpjpeg','assets/uploads/files');
			$kkjpeg = $this->M_master->set_file_upload('kkjpeg','assets/uploads/files');
			
            $data = array(
				'levelid' => $this->input->post('levelid', TRUE),
				'leader' => $this->input->post('leader', TRUE),
				'name' => $this->input->post('name',TRUE),
				'address' => $this->input->post('address',TRUE),
				'phone' => $this->input->post('phone',TRUE),
				'hp' => $this->input->post('hp',TRUE),
				'ktp' => $this->input->post('ktp',TRUE),
				'rmcode' => $this->input->post('rmcode',TRUE),
				'email' => $this->input->post('email',TRUE),
				'jkelamin' => $this->input->post('jkelamin', TRUE),
				'birthdate' => date('Y-m-d', strtotime($this->input->post('birthdate', TRUE))),
				'emergency' => $this->input->post('emergency', TRUE),
				'activedate' => date('Y-m-d', strtotime($this->input->post('activedate', TRUE))),
				'status' => $this->input->post('status', TRUE),
            );
			
			if(!empty($foto)){
				$data['foto'] = $foto;
			}
			if(!empty($ktpjpeg)){
				$data['ktpjpeg'] = $ktpjpeg;
			}
			if(!empty($npwpjpeg)){
				$data['npwpjpeg'] = $npwpjpeg;
			}
			if(!empty($kkjpeg)){
				$data['kkjpeg'] = $kkjpeg;
			}
			
            $this->M_master->update("mstuser","userid",$this->input->post('userid'), $data);
           # $this->session->set_flashdata('message', '<b>Update Record Success</b>');
            $this->employee();
        }	
	 }
	 
	 function userlogin() {
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
							'userlogin'=>$this->M_dasb->mstlogin(),
							'daftarmenu'=>$this->M_dasb->mstmenu(),
							'menulogin' => $this->M_dasb->menulogin(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/userlogin_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function userlogin_create() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
						'button' => 'Create',
						'action' => site_url('Masters/userlogin_createaction'),
						'uid' => $this->session->userdata('userid'),
						'foto' => $this->session->userdata('foto'),
						'outletuser' => $this->session->userdata('outletuser'),
						'program' => $this->session->userdata('program'),
						'pt' => $this->session->userdata('pt'),
						'versi' => $this->session->userdata('versi'),
						'lisensi' => $this->session->userdata('lisensi'),
						"notif" => $this->M_dasb->gettotalcash(),
						'dtlnotif' => $this->M_dasb->totalcash(),
						'loginid' => set_value('loginid'),
						'levelid' => set_value('levelid'),
						'outletid' => set_value('outletid'),
						'userid' => set_value('userid'),
						'username' => set_value('username'),
						'password' => set_value('password'),
						'foto' => set_value('foto'),
						'status' => set_value('status'),
						
						'dd_outlet' => $this->M_dasb->dd_outlet(),
						'dd_level' => $this->M_dasb->dd_level(),
						'dd_username' => $this->M_dasb->dd_username(),
						'dd_status' => array(""=>"","0" => "Not Active", "1" => "Active"),
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/userlogin_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function userlogin_createaction() {
		$fields = array("0"=>"username");
		$display = array("username"=>"Username");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlogin();
        } else{
			try{
				$foto = $this->M_master->set_file_upload('foto','assets/dist/img');
				$data = array(
						'levelid' => $this->input->post('levelid'),
						'outletid' => $this->input->post('outletid'),
						'userid' => $this->input->post('userid'),
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password')),
						'status' => $this->input->post('status')
						
					);	
					
					if(!empty($foto)){
						$data['foto'] = $foto;
					}
					
					$this->M_master->insert("mstlogin", $data);
					#$this->session->set_flashdata('message', '<b>Create Record Success</b>');
					$this->userlogin();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function userlogin_update($id) {
		$row = $this->M_master->get_by_id("mstlogin","loginid",$id);
		
        if ($row) {
			$data = array(
						'button' => 'Update',
						'action' => site_url('Masters/userlogin_updateaction'),
						'foto' => set_value('foto',$row->foto),
						'uid' => $this->session->userdata('userid'),
						'outletuser' => $this->session->userdata('outletuser'),
						'program' => $this->session->userdata('program'),
						'pt' => $this->session->userdata('pt'),
						'versi' => $this->session->userdata('versi'),
						'lisensi' => $this->session->userdata('lisensi'),
						"notif" => $this->M_dasb->gettotalcash(),
						'dtlnotif' => $this->M_dasb->totalcash(),
						'loginid' => set_value('loginid',$row->loginid),
						'levelid' => set_value('levelid',$row->levelid),
						'outletid' => set_value('outletid',$row->outletid),
						'userid' => set_value('userid',$row->userid),
						'username' => set_value('username',$row->username),
						'password' => set_value('password',$row->password),
						'status' => set_value('level',$row->status),
						
						'dd_outlet' => $this->M_dasb->dd_outlet(),
						'dd_level' => $this->M_dasb->dd_level(),
						'dd_username' => $this->M_dasb->dd_username(),
						'dd_status' => array(""=>"","0" => "Not Active", "1" => "Active"),
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('masters/userlogin_form', $data);
		}
	 }
	 
	 function userlogin_updateaction() {
		$fields = array("0"=>"username");
		$display = array("username"=>"Username");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlogin();
        } else{
			try{
				$outlet='';
				$ol = $this->input->post('outlet');
				#echo $ol;
				$foto = $this->M_master->set_file_upload('foto','assets/dist/img');
				$pos = (strpos($this->input->post('outletid'),",") > 0?implode(",",$this->input->post('outlet')):$this->input->post('outletid'));
				$thru = $this->M_dasb->getpa($this->input->post('loginid'));
				
				$data = array(
						'levelid' => $this->input->post('levelid'),
						'outletid' => $pos,
						
						'userid' => $this->input->post('userid'),
						'username' => $this->input->post('username'),
						
						'status' => $this->input->post('status')
						
					);	
					if($thru != $this->input->post('password')){
						$data['password'] = md5($this->input->post('password'));
					}
					if(!empty($foto)){
						$data['foto'] = $foto;
					}
				
					$this->M_master->update("mstlogin","loginid",$this->input->post('loginid'), $data);
					#$this->session->set_flashdata('message', '<b>Update Record Success</b>');
					$this->userlogin();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
}
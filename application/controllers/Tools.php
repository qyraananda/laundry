<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {
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
	
	function printer(){
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
							'printer' => $this->M_dasb->tlsprinter(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid'))
							);	
					
					$this->template->display('tools/printer_list', $data);
			   }catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
	function printer_create(){
		 $session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
					'button' => 'Create',
					'action' => site_url('Tools/printer_createaction'),
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
					'outletid' => set_value('outletid'),
					'printerid' => set_value('printerid'),
					'printer' => '',
					'port' => '',
					'dd_outlet' => $this->M_dasb->dd_outlet(),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('Tools/printer_form', $data);
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function printer_createaction() {
		$fields = array("0"=>"printer");
		$display = array("printer"=>"Printer");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->printer();
        } else{
			try{
				
				$data = array(
						'outletid' => $this->input->post('outletid'),
						'printer' => $this->input->post('printer'),
						'port' => $this->input->post('port')
					);	
					
					$this->M_master->insert("tlsprinter", $data);
					$this->printer();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function printer_update($id) {
		$row = $this->M_master->get_by_id("tlsprinter","printerid",$id);
		
        if ($row) {
			$data = array(
						'button' => 'Update',
						'action' => site_url('Tools/printer_updateaction'),
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
						'printerid' => set_value('printerid',$row->printerid),
						'printer' => set_value('printer',$row->printer),
						'port' => set_value('port',$row->port),
						
						'dd_outlet' => $this->M_dasb->dd_outlet(),
					
						'daftarmenu'=>$this->M_dasb->mstmenu(),
						'menulogin' => $this->M_dasb->menulogin(),
						"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('Tools/printer_form', $data);
		}
	 }
	 
	 function printer_updateaction() {
		$fields = array("0"=>"printer");
		$display = array("printer"=>"Printer");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->userlogin();
        } else{
			try{
								
				$data = array(
						'outletid' => $this->input->post('outletid'),
						'printer' => $this->input->post('printer'),
						'port' => $this->input->post('port')
						
					);	
				
					$this->M_master->update("tlsprinter","printerid",$this->input->post('printerid'), $data);
					$this->printer();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }

	 function backupdata(){
	 		$database_name = "biglaundry";
	 	 	$backup_file_name = $database_name . '_backup_' . time() . '.sql';
		    $fileHandler = fopen($backup_file_name, 'w+');
		    $number_of_lines = fwrite($fileHandler, $sqlScript);
		    fclose($fileHandler); 

		    // Download the SQL backup file to the browser
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($backup_file_name));
		    ob_clean();
		    flush();
		    readfile($backup_file_name);
		    exec('rm ' . $backup_file_name); 
	 }
}
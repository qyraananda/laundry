<?php
error_reporting(E_ALL ^ E_DEPRECATED);
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {
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
	
	function cashier() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$this->cart->destroy();
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
							'cashiers' => $this->M_dasb->hdrcashier(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('activities/cashier_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 function cashier_create() {
		$session=$this->session->userdata('outletuser');
		if($session==""){
			redirect('Dash');
		}else{
			try{
				$data = array(
							'button' => 'Create',
							"aktifs" => "in active",
							'action' => site_url('Activities/cashier_createaction'),
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
							'hdrcashid' => set_value('hdrcashid'),
							'noresi' => date("YmdHis"),
							
							'customerid' => set_value('customerid'),
							'outletid' => set_value('outletid'),
							'tariffid' => set_value('tariffid'),
							'alamat' => set_value('alamat'),
							'handphone' => set_value('handphone'),
							'pembayaran' => set_value('pembayaran'),
							'satuan' => set_value('satuan'),
							'tipe' => set_value('tipe'),
							'ckl' => '',
							'jenis' => set_value('jenis'),
							'harga' => set_value('harga'),
							'diskon' => set_value('diskon'),
							'jumlah' => set_value('jumlah'),
							'bayar' => 0,
							'sisa' => 0,
							'subtotal' => 0,
							'total' => 0,
							'keterangan' => '',
							'itembrg' => '',
							'hargabrg' => '',
							'diskonbrg' => '',
							'jumlahbrg' => '',
							'perkg' => '',
							'hargapaket' => '',
							'diskonpaket' => '',
							'jumlahpaket' => '',
							'paketkg' => '',
							'customers' => '',
							
							'dd_paket' => $this->M_dasb->dd_paket(),
							'dd_tipe' => $this->M_dasb->dd_tipe(),
							'dd_jenis' => '',
							'dd_bayar' => $this->M_master->status("hdrcashier","pembayaran"),
							'dd_tariff' => $this->M_dasb->dd_tariff(),
							'dd_customer' => $this->M_dasb->dd_customer(),
							'dd_outlet' => $this->M_dasb->dd_outlet(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('activities/cashier_form', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	
	public function cashier_createaction(){
		$fields = array("0"=>"pembayaran");
		$display = array("pembayaran"=>"Pembayaran");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->cashier();
        } else {
           		
			date_default_timezone_set("Asia/Bangkok");
			
            $a = date("Ymd");
			$cust = ""; 
			
			$option = $this->input->post('exampleRadios'); #--- new customer option1---
			$hasil = $this->input->post("hasil");
			
			$noresi = $a.$this->M_master->nomor_resi();
			
			if($option == "option1"){
				$cust = array("customer" => $this->input->post("customern"),
						"alamat" => $this->input->post("alamat"),
						"outletid" => $this->session->userdata("outletid"),
						"handphone" => $this->input->post("handphone"));
				
				$this->M_master->insert("dtcustomer",$cust);
				
				$cust = $this->M_dasb->getlastcustomer();
			}else{
				$cust = $this->input->post("pelanggan");
			}
								
			if($hasil == "satuan"){
				$datas = array("noresi"=> $noresi,
				"customerid" => $cust,
				"outletid"=>$this->session->userdata('outletid'),
				"userid" => $this->session->userdata('userid'),
				"pembayaran" => $this->input->post('pembayaran'),
				"kartu" => $this->input->post('kartu'),
				"total"=>str_replace(".","",$this->input->post('total')),
				"bayar" => str_replace(".","",$this->input->post('bayar')),
				"sisa" => str_replace(".","",$this->input->post('kembali')),
				"username"=>$this->session->userdata('username'));
			
				$this->M_master->insert("hdrcashier", $datas);
				
				foreach($this->input->post('qtys') as $s => $val){	
					$checkid = $this->input->post('ids['.$s.']');
					$tariffid = $this->input->post('dtlid['.$s.']');
					$qty = $this->input->post('qtys['.$s.']');
					
					if($qty > 0){	
						$harga = $this->input->post('harga['.$s.']');
						$diskon = $this->M_dasb->getdiskon($tariffid);
						$hrg = ($harga - ($harga * $diskon/100));
						$data = array("noresi"=>$noresi,
							"tariffid"=>$tariffid,
							"harga"=>$hrg,
							"diskon"=>$diskon,
							"jumlah"=>$qty,
							"subtotal"=>($hrg * $qty),
							"keterangan" => $this->input->post('keterangan'),
							"tglterima"=>date("Y-m-d"));
						#var_dump($data);
						$this->M_master->insert("dtlcashier", $data);
					}
				}
				
			} #--- satuan ---
			
			if($hasil == "kiloan"){
				$datas = array("noresi"=> $noresi,
				"customerid" => $cust,
				"outletid"=>$this->session->userdata('outletid'),
				"userid" => $this->session->userdata('userid'),
				"pembayaran" => $this->input->post('pembayaran'),
				"kartu" => $this->input->post('kartu'),
				"total"=>str_replace(".","",$this->input->post('total')),
				"bayar" => str_replace(".","",$this->input->post('bayar')),
				"sisa" => str_replace(".","",$this->input->post('kembali')),
				"username"=>$this->session->userdata('username'));
			
				$this->M_master->insert("hdrcashier", $datas);
				#var_dump($datas);
				
				$harga = $this->input->post('hargabrg');
				$diskon = $this->input->post('diskonbrg');
				$hrg = ($harga - ($harga * $diskon/100));
				
				$data = array("noresi"=>$noresi,
						"tariffid"=>$this->input->post('tariffidbrg'),
						"harga"=>$harga,
						"diskon"=>$diskon,
						"jumlah"=>$this->input->post('jumlahbrg'),
						"subtotal"=>($hrg * $this->input->post('jumlahbrg')),
						"keterangan" => $this->input->post('keterangan'),
						"tglterima"=>date("Y-m-d"));
			
					$this->M_master->insert("dtlcashier", $data);
				#var_dump($data);
			} #--- kiloan ---
			
			if($hasil == "paket"){
				$datas = array("noresi"=> $noresi,
				"customerid" => $cust,
				"outletid"=>$this->session->userdata('outletid'),
				"userid" => $this->session->userdata('userid'),
				"pembayaran" => $this->input->post('pembayaran'),
				"kartu" => $this->input->post('kartu'),
				"total"=>str_replace(".","",$this->input->post('total')),
				"bayar" => str_replace(".","",$this->input->post('bayar')),
				"sisa" => str_replace(".","",$this->input->post('kembali')),
				"username"=>$this->session->userdata('username'));
			
				$this->M_master->insert("hdrcashier", $datas);
				
				$harga = $this->input->post('hargapaket');
				$diskon = $this->input->post('diskonpaket');
				$hrg = ($harga - ($harga * $diskon/100));
				
				$data = array("noresi"=>$noresi,
						"tariffid"=>$this->input->post('tariffidpaket'),
						"harga"=>$hrg,
						"diskon"=>$diskon,
						"jumlah"=>$this->input->post('jumlahpaket'),
						"subtotal"=>($hrg * $this->input->post('jumlahpaket')),
						"keterangan" => $this->input->post('keterangan'),
						"tglterima"=>date("Y-m-d"));
			
					$this->M_master->insert("dtlcashier", $data);
				
			}
			$this->cashier();
        }			
	}
	
	public function cashier_update($id) {
        $row = $this->M_master->getAll_cash($id);
		
        if ($row) {
				$this->cart->destroy();
				$dt = $this->M_dasb->getUpCash($row->noresi);
				$data = array(
					'button' => 'Update',
					'action' => site_url('Activities/cashier_updateaction'),
					'uid' => $this->session->userdata('userid'),
					'levelid' => $this->session->userdata('levelid'),
					'foto' => $this->session->userdata('foto'),
					'outletuser' => $this->session->userdata('outletuser'),
					'program' => $this->session->userdata('program'),
					'pt' => $this->session->userdata('pt'),
					'versi' => $this->session->userdata('versi'),
					'lisensi' => $this->session->userdata('lisensi'),
					'hdrcashid' => set_value('hdrcashid',$row->hdrcashid),
					'outletid' => set_value('outletid',$row->outletid),
					'noresi' => set_value('noresi',$row->noresi),
					'pembayaran' => set_value('pembayaran',$row->pembayaran),
					'kartu' => set_value('kartu',$row->kartu),
					'bayar' => set_value('bayar',$row->bayar),
					'sisa' => set_value('sisa',$row->sisa),
					'diskon' => set_value('diskon',$row->diskon),
					'total' => set_value('total',$row->total),
					'outletid' => '',
					'tariffid' =>'',
					'jenis' => set_value('jenis',$this->M_dasb->getjenis($row->noresi)),
					
					'hargapaket' => '',
					'diskonpaket' => '',
					'paketkg' => '',
					'jumlahpaket' => '',
					
					'hargabrg' => '',
					'diskonbrg' => '',
					'perkg' => '',
					'jumlahbrg' => '',
					
					'satuan' => '',		
					'customerid' => set_value('customerid',$row->customerid),
					'tipe' => set_value('tipe',$this->M_dasb->gettipe($row->noresi)),
					'harga' => set_value('harga',$row->harga),
					'jumlah' => set_value('jumlah',$row->jumlah),
					'customers' => $this->M_dasb->getcust($row->noresi),	
					'alamat' => $this->M_dasb->getalamat($row->noresi),
					'handphone' => $this->M_dasb->gethandphone($row->noresi),
					'keterangan' => set_value('keterangan',$row->keterangan),
					
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),
					
					'dd_paket' => $this->M_dasb->dd_paket(),
					'dd_tipe' => $this->M_dasb->dd_tipe(),
					'dd_jenis' => '',
					'dd_bayar' => $this->M_master->status("hdrcashier","pembayaran"),
					'ddtariff' => $this->M_dasb->dtlcashier($row->noresi),
					'dd_tariff' => $this->M_dasb->dd_tariff(),
					'dd_customer' => $this->M_dasb->dd_customer(),
					'dd_outlet' => $this->M_dasb->dd_outlet(),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));
				
				if($this->M_dasb->getjenis($row->noresi)=="Satuan"){
					$data["aktifs"] = "in active";
				}	
				if($this->M_dasb->getjenis($row->noresi)=="Kiloan"){
					$data["aktifk"] = "in active";
					$data['jenis'] = set_value('jenis',$row->tariffid);
					$data['dd_jenis'] = $this->M_dasb->dd_jenis();
					$data['hargabrg'] = set_value('hargabrg',$row->harga);
					$data['diskonbrg'] = set_value('diskonbrg',$row->diskon);
					$data['perkg'] = set_value('perkg',$this->M_dasb->getperkg($row->noresi));
					$data['jumlahbrg'] = set_value('jumlahbrg',$row->jumlah);
					$data['total'] = set_value('total',$row->total);
				}
				
				if($this->M_dasb->getjenis($row->noresi)=="Paket"){
					$data["aktifp"] = "in active";
					$data['satuan'] = set_value('satuan',$row->tariffid);
					$data['hargapaket'] = set_value('hargapaket',$row->harga);
					$data['diskonpaket'] = set_value('diskonpaket',$row->diskon);
					$data['paketkg'] = set_value('paketkg',$this->M_dasb->getperkg($row->noresi));
					$data['jumlahpaket'] = set_value('jumlahpaket',$row->jumlah);
					$data['total'] = set_value('total',$row->total);
				}
				
				$this->template->display('activities/cashier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->cashier();
        }
    }
	
	public function cashier_updateaction(){
		$fields = array("0"=>"pembayaran");
		$display = array("pembayaran"=>"Pembayaran");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->cashier();
        } else {
           		
			date_default_timezone_set("Asia/Bangkok");
			$option = $this->input->post('exampleRadios');
			$hasil = $this->input->post("hasil");
			$noresi = $this->input->post("noresi");
			
			$cust="";
			if($option == "option1"){
				$cust = array("customer" => $this->input->post("customern"),
						"alamat" => $this->input->post("alamat"),
						"outletid" => $this->session->userdata("outletid"),
						"handphone" => $this->input->post("handphone"));
				
				$this->M_master->insert("dtcustomer",$cust);
				
				$cust = $this->M_dasb->getlastcustomer();
			}else{
				$cust = $this->input->post("pelanggan");
			}
			
			if($hasil == "satuan"){
				$datas = array(
				"noresi"=> $noresi,
				"customerid" => $cust,
				"outletid"=>$this->session->userdata('outletid'),
				"userid" => $this->session->userdata('userid'),
				"pembayaran" => $this->input->post('pembayaran'),
				"kartu" => $this->input->post('kartu'),
				"total"=>str_replace(".","",$this->input->post('total')),
				"bayar" => str_replace(".","",$this->input->post('bayar')),
				"sisa" => str_replace(".","",$this->input->post('kembali')),
				"username"=>$this->session->userdata('username'));
			
				$this->M_master->update("hdrcashier", "noresi",$noresi,$datas);
				
				foreach($this->input->post('qtys') as $s => $val){	
					$checkid = $this->input->post('ids['.$s.']');
					$tariffid = $this->input->post('dtlid['.$s.']');
					$qty = $this->input->post('qtys['.$s.']');
					
					if($qty > 0){	
						$harga = $this->input->post('harga['.$s.']');
						$diskon = $this->M_dasb->getdiskon($tariffid);
						$hrg = ($harga - ($harga * $diskon/100));
						$data = array("noresi"=>$noresi,
							"tariffid"=>$tariffid,
							"harga"=>$hrg,
							"diskon"=>$diskon,
							"jumlah"=>$qty,
							"subtotal"=>($hrg * $qty),
							"keterangan" => $this->input->post('keterangan'),
							"tglterima"=>date("Y-m-d"));
							
						$this->M_master->update("dtlcashier","noresi",$noresi, $data);
					}
				}
				
			} #--- satuan ---
			
			if($hasil == "kiloan"){
				$datas = array(
				"noresi"=> $noresi,
				"customerid" => $cust,
				"outletid"=>$this->session->userdata('outletid'),
				"userid" => $this->session->userdata('userid'),
				"pembayaran" => $this->input->post('pembayaran'),
				"kartu" => $this->input->post('kartu'),
				"total"=>str_replace(".","",$this->input->post('total')),
				"bayar" => str_replace(".","",$this->input->post('bayar')),
				"sisa" => str_replace(".","",$this->input->post('kembali')),
				"username"=>$this->session->userdata('username'));
			
				$this->M_master->update("hdrcashier", "noresi",$noresi,$datas);
				#var_dump($datas);
				
				$harga = $this->input->post('hargabrg');
				$diskon = $this->input->post('diskonbrg');
				$hrg = ($harga - ($harga * $diskon/100));
				
				$data = array("noresi"=>$noresi,
						"tariffid"=>$this->input->post('tariffidbrg'),
						"harga"=>$harga,
						"diskon"=>$diskon,
						"jumlah"=>$this->input->post('jumlahbrg'),
						"subtotal"=>($hrg * $this->input->post('jumlahbrg')),
						"keterangan" => $this->input->post('keterangan'),
						"tglterima"=>date("Y-m-d"));
			
					$this->M_master->update("dtlcashier","noresi",$noresi, $data);
				#var_dump($data);
			} #--- kiloan ---
			
			if($hasil == "paket"){
				$datas = array(
				"noresi"=> $noresi,
				"customerid" => $cust,
				"outletid"=>$this->session->userdata('outletid'),
				"userid" => $this->session->userdata('userid'),
				"pembayaran" => $this->input->post('pembayaran'),
				"kartu" => $this->input->post('kartu'),
				"total"=>str_replace(".","",$this->input->post('total')),
				"bayar" => str_replace(".","",$this->input->post('bayar')),
				"sisa" => str_replace(".","",$this->input->post('kembali')),
				"username"=>$this->session->userdata('username'));
			
				$this->M_master->update("hdrcashier", "noresi",$noresi,$datas);
				
				$harga = $this->input->post('hargapaket');
				$diskon = $this->input->post('diskonpaket');
				$hrg = ($harga - ($harga * $diskon/100));
				
				$data = array("noresi"=>$noresi,
						"tariffid"=>$this->input->post('tariffidpaket'),
						"harga"=>$hrg,
						"diskon"=>$diskon,
						"jumlah"=>$this->input->post('jumlahpaket'),
						"subtotal"=>($hrg * $this->input->post('jumlahpaket')),
						"keterangan" => $this->input->post('keterangan'),
						"tglterima"=>date("Y-m-d"));
			#var_dump($data);
					$this->M_master->update("dtlcashier","noresi",$noresi, $data);
				
			}
			$this->cashier();
			
        }			
	}
	
	public function cashier_print($id){
		$row = $this->M_master->get_by_id("hdrcashier","noresi",$id);
		
        if ($row) {
			$data = array(
					'uid' => $this->session->userdata('userid'),
					'levelid' => $this->session->userdata('levelid'),
					'program' => $this->session->userdata('program'),
					'pt' => $this->session->userdata('pt'),
					'versi' => $this->session->userdata('versi'),
					'lisensi' => $this->session->userdata('lisensi'),
					
					'list' => $this->M_dasb->Cetak($id),
					'title' => 'Form Laundry',
					'config' => $this->M_master->get_outlet($id),
					'sale' => $this->M_master->get_nota($id),
					
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid'))
				);
			
			$this->template->display('activities/cashier_cetak', $data);
		}
	}
	
	function tglkirimcash($id){
		$session=$this->session->userdata('outletuser');
		if($session==""){
			$this->salesplan();
		}else{
			try{
			date_default_timezone_set("Asia/Bangkok");
			
			#--- update status di header ---
			$data = array("tglkirimcash" => $this->input->post('value').' '.date("H:i"));
			$this->M_master->update("hdrcashier","noresi",$id,$data);
			
		}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
	function tglterimaprod($id){
		$session=$this->session->userdata('outletuser');
		if($session==""){
			$this->salesplan();
		}else{
			try{
			date_default_timezone_set("Asia/Bangkok");
			
			#--- update status di header ---
			$data = array("tglterimaprod" => $this->input->post('value').' '.date("H:i"));
			$this->M_master->update("hdrcashier","noresi",$id,$data);
			
		}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
	function tglkirimprod($id){
		$session=$this->session->userdata('outletuser');
		if($session==""){
			$this->salesplan();
		}else{
			try{
			date_default_timezone_set("Asia/Bangkok");
			
			#--- update status di header ---
			$data = array("tglkirimprod" => $this->input->post('value').' '.date("H:i"));
			$this->M_master->update("hdrcashier","noresi",$id,$data);
			
		}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
	function tglterimacash($id){
		$session=$this->session->userdata('outletuser');
		if($session==""){
			$this->salesplan();
		}else{
			try{
			date_default_timezone_set("Asia/Bangkok");
			
			#--- update status di header ---
			$data = array("tglterimacash" => $this->input->post('value').' '.date("H:i"));
			$this->M_master->update("hdrcashier","noresi",$id,$data);
			
		}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
	function cashstatus($id){
		$session=$this->session->userdata('outletuser');
		if($session==""){
			$this->salesplan();
		}else{
			try{
			date_default_timezone_set("Asia/Bangkok");
			
			#--- update tgl terima di detail ---
			$data = array("tglselesai" => date("Y-m-d"));
			$this->M_master->update("dtlcashier","noresi",$id,$data);
			
			#--- update status di header ---
			$byr = $this->M_dasb->getbayar($id);
			$sisa = $this->M_dasb->getsisa($id);
			$bayar = ($byr>0?$byr+$this->input->post('value'):$this->input->post('value'));
			$data = array("status" => "Finish","bayar" => $bayar,"sisa" => 0,"total" => $bayar);
			$this->M_master->update("hdrcashier","noresi",$id,$data);
			
		}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
	function production() {
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
							'productions' => $this->M_dasb->hdrcashier(),
							'daftarmenu' => $this->M_dasb->mstmenu(),
							"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));	
					
					$this->template->display('activities/production_list', $data);
				}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	 }
	 
	 public function production_update($id) {
        $row = $this->M_master->get_by_id("hdrcashier","hdrcashid",$id);
		
        if ($row) {
				$this->cart->destroy();
				$dt = $this->M_dasb->getUpCash($row->noresi);
				$data = array(
					'button' => 'Update',
					'action' => site_url('Activities/production_updateaction'),
					'uid' => $this->session->userdata('userid'),
					'levelid' => $this->session->userdata('levelid'),
					'foto' => $this->session->userdata('foto'),
					'outletuser' => $this->session->userdata('outletuser'),
					'program' => $this->session->userdata('program'),
					'pt' => $this->session->userdata('pt'),
					'versi' => $this->session->userdata('versi'),
					'lisensi' => $this->session->userdata('lisensi'),
					'hdrcashid' => set_value('hdrcashid',$row->hdrcashid),
					'outletid' => set_value('outletid',$row->outletid),
					'noresi' => set_value('noresi',$row->noresi),
					'pembayaran' => set_value('pembayaran',$row->pembayaran),
					'kartu' => set_value('kartu',$row->kartu),
					'bayar' => set_value('bayar',$row->bayar),
					'sisa' => set_value('sisa',$row->sisa),
					'diskon' => set_value('diskon',0),
					'total' => set_value('total',$row->total),
					'outletid' => '',
					'status' => set_value('status',$row->status),
					'customerid' => $this->M_dasb->getcust($row->noresi),	
					'alamat' => $this->M_dasb->getalamat($row->noresi),
					'handphone' => $this->M_dasb->gethandphone($row->noresi),
					
					"notif" => $this->M_dasb->gettotalcash(),
					'dtlnotif' => $this->M_dasb->totalcash(),
					
					'productions' => $this->M_dasb->dtlcashier($row->noresi),
					'dd_status' => $this->M_master->status("hdrcashier","status"),
					'daftarmenu' => $this->M_dasb->mstmenu(),
					"access" => $this->M_dasb->accessmnulogin($this->session->userdata('levelid')));
				
				$this->template->display('Activities/production_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->production();
        }
    }
	
	public function production_updateaction(){
		$fields = array("0"=>"alamat");
		$display = array("alamat"=>"Alamat");
		$this->M_master->_setrules($fields,$display);
		
		if ($this->form_validation->run() == FALSE) {
            $this->production();
        } else {
           		try{
					date_default_timezone_set("Asia/Bangkok");
					#echo count($this->input->post('tanggal'));
					for($i=0; $i <= count($this->input->post('tanggal')); $i++){
						echo  $this->input->post('tglproduksi'.$i);
						$data = array("tglproduksi" => $this->input->post('tglproduksi'.$i));
						$this->M_master->update("dtlcashier","dtlcashid",$this->input->post('dtlcashid'.$i),$data);
						#echo $this->input->post('dtlcashid'.$i).'-'.$this->input->post('tglproduksi'.$i).'-'.$this->input->post('status').'<br>';
					}
					
					$data = array("status"=>$this->input->post('status'),"createdate" => $this->input->post('tglproduksi0'));
					$id = $this->input->post('hdrcashid');
					$this->M_master->update("hdrcashier","hdrcashid",$id,$data);
					
					$this->production();
				}catch(Exception $e){
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
	}
	
}
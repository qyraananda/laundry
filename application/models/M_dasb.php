<?php
class M_dasb extends CI_Model
{

	public function mstmenu(){
		$q = $this->db->query("select * from mstmenu order by menuid");
		return $q;
	}
	
	public function accessmnulogin($id)
	{
		$query=$this->db->query("select * from menulogin join mstlevel on menulogin.levelid=mstlevel.levelid join mstmenu on menulogin.menuid=mstmenu.menuid where mstmenu.status=1 and menulogin.levelid=$id");
		
		return $query;
	}
	
	public function menulogin()
	{
		$query=$this->db->query("select * from menulogin left join mstlevel on menulogin.levelid=mstlevel.levelid left join mstmenu on menulogin.menuid=mstmenu.menuid order by id");
		
		return $query;
	}
	
	public function mststore(){
		$q = $this->db->query("select * from mstoutlet order by outletid");
		return $q;
	}
	
	public function mstlevel(){
		$q = $this->db->query("select * from mstlevel order by levelid");
		return $q;
	}
	
	public function mstuser(){
		$q = $this->db->query("select * from mstuser order by userid");
		return $q;
	}
	
	public function mstlogin(){
		$q = $this->db->query("select * from mstlogin order by loginid");
		return $q;
	}
	
	public function dttariff1(){
		$q = $this->db->query("select * from dttariff order by tariffid");
		return $q;
	}
	
	public function dttariff(){
		$q = $this->db->query("select * from dttariff where satuan='Satuan' order by tariffid");
		return $q;
	}
	
	public function dtcustomer(){
		$q = $this->db->query("select * from dtcustomer order by customerid");
		return $q;
	}
	
	public function tlsprinter(){
		$q = $this->db->query("select * from tlsprinter order by printerid");
		return $q;
	}
	
	public function hdrcashier(){
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		if($level != 1){
			$ol = " where outletid in (".$outlet.")";
		}else{
			$ol = "";
		}
		$q = $this->db->query("select * from hdrcashier ".$ol." order by hdrcashid desc");
		#echo $this->db->last_query();
		return $q;
	}
	
	public function dtlcashier($noresi){
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		
		$q = $this->db->query("select * from dtlcashier where noresi='".$noresi."' order by dtlcashid");
		#echo $this->db->last_query();
		return $q;
	}
	
	public function menitcashier(){
		$this->db->select('createdate');
		$this->db->from('hdrcashier');
		$this->db->order_by('createdate','desc');
		$this->db->limit(1);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->createdate)?date("i",strtotime($no->createdate)):"0");
	}
	
	public function totalcash(){
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		if($level != 1){
			$ol = " and outletid in (".$outlet.")";
		}else{
			$ol = "";
		}
		$q = $this->db->query("select * from hdrcashier where (status='' or status is null) ".$ol." order by hdrcashid");
		
		return $q;
	}
	
	public function getrevenue($mth){
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		if($level != 1){
			$ol = " and outletid in (".$outlet.")";
		}else{
			$ol = "";
		}
		
		$q = $this->db->query('SELECT day(createdate) as tgl,dayname(createdate) as hari,count(*) as jml FROM `hdrcashier` where MONTH(createdate)="'.$mth.'" '.$ol.' group by tgl,hari');
		return $q;
	}
	
	public function getproduk($mth){
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		if($level != 1){
			$ol = " and outletid in (".$outlet.")";
		}else{
			$ol = "";
		}
		
		$q = $this->db->query('SELECT day(createdate) as tgl,dayname(createdate) as hari,count(*) as jml FROM `hdrcashier` where MONTH(createdate)="'.$mth.'" and status in ("Process","Finish") '.$ol.' group by tgl,hari');
		
		return $q;
	}
	
	public function getlevel($id){
		$where = $id;
		$this->db->select('level');
		$this->db->from('mstlevel');
		$this->db->where('levelid',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->level)?$no->level:$id);
	}
	
	public function getuser($id){
		$where = $id;
		$this->db->select('name');
		$this->db->from('mstuser');
		$this->db->where('userid',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->name)?$no->name:$id);
	}
	
	public function gettotalcash(){
		$status = "(status = '' or status is null)";
		
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		if($level != 1){
			$ol = array($outlet);
		}else{
			$ol = "";
		}
		
		$this->db->select('count(*) as jumlah');
		$this->db->from('hdrcashier');
		$this->db->where($status);
		if($level != 1){
			$this->db->where_in("outletid",$ol);
		}
		$data = $this->db->get();
		#echo $this->db->last_query();
		$no = $data->row(0);
		
		return (isset($no->jumlah)?$no->jumlah:"0");
	}
	
	public function gettotalprod(){
		$level = $this->session->userdata('levelid');
		$outlet = $this->session->userdata('outletid');
		if($level != 1){
			$ol = array($outlet);
		}else{
			$ol = "";
		}
		
		$this->db->select('count(*) as jumlah');
		$this->db->from('hdrcashier');
		$this->db->where('status','Process');
		if($level != 1){
			$this->db->where_in("outletid",$ol);
		}
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->jumlah)?$no->jumlah:"0");
	}
	
	public function gettariffid($tipe,$nama){
		$where = array("tariff"=>$nama,"tipe"=>$tipe);
		$this->db->select('tariffid');
		$this->db->from('dttariff');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->tariffid)?$no->tariffid:$tipe);
	}
	
	public function gettipe($noresi){
		$where = array("noresi"=>$noresi);
		$this->db->select('tipe');
		$this->db->from('dtlcashier');
		$this->db->join('dttariff','dtlcashier.tariffid=dttariff.tariffid','inner');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->tipe)?$no->tipe:$noresi);
	}
	
	public function getharga($noresi){
		$where = array("noresi"=>$noresi);
		$this->db->select('harga');
		$this->db->from('dtlcashier');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->harga)?$no->harga:$noresi);
	}
	
	public function getperkg($noresi){
		$where = array("noresi"=>$noresi);
		$this->db->select('perkg');
		$this->db->from('dtlcashier');
		$this->db->join('dttariff','dttariff.tariffid=dtlcashier.tariffid','inner');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->perkg)?$no->perkg:$noresi);
	}
	
	public function getjumlah($noresi){
		$where = array("noresi"=>$noresi);
		$this->db->select('sum(jumlah) as jumlah');
		$this->db->from('dtlcashier');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->jumlah)?$no->jumlah:$noresi);
	}
	
	public function getdtlid($noresi,$tariffid){
		$where = array("noresi"=>$noresi,"tariffid"=>$tariffid);
		$this->db->select('dtlcashid');
		$this->db->from('dtlcashier');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->dtlcashid)?$no->dtlcashid:"");
	}
	
	public function gethargacash($noresi,$tariffid){
		$where = array("noresi"=>$noresi,"tariffid"=>$tariffid);
		$this->db->select('harga');
		$this->db->from('dtlcashier');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->harga)?$no->harga:"");
	}
	
	public function getjumlahcash($noresi,$tariffid){
		$where = array("noresi"=>$noresi,"tariffid"=>$tariffid);
		$this->db->select('jumlah');
		$this->db->from('dtlcashier');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->jumlah)?$no->jumlah:"");
	}
	
	public function getsubtotcash($noresi,$tariffid){
		$where = array("noresi"=>$noresi,"tariffid"=>$tariffid);
		$this->db->select('subtotal');
		$this->db->from('dtlcashier');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->subtotal)?$no->subtotal:"");
	}
	
	public function gettarifname($id){
		$where = $id;
		$this->db->select('tariff,jenis');
		$this->db->from('dttariff');
		$this->db->where('tariffid',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->tariff)?$no->tariff:$id);
	}
	
	public function getdiskon($id){
		$where = array("tariffid"=>$id);
		$this->db->select('diskon');
		$this->db->from('dttariff');
		$this->db->where($where);
		$data = $this->db->get();
		
		$no = $data->row(0);
		
		return (isset($no->diskon)?$no->diskon:$id);
	}
	
	public function getcklreg($id){
		$where = array("tipe"=>"Reguler","tariff"=>$id);
		$this->db->select("*")
				 ->from('dttariff')
				 ->where($where);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("harga" => $row->harga, "diskon" => $row->diskon);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	public function getcklexp($id){
		$where = array("tipe"=>"Express","tariff"=>$id);
		$this->db->select("*")
				 ->from('dttariff')
				 ->where($where);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("harga" => $row->harga, "diskon" => $row->diskon);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
		
	public function getoutlet($id){
		$where = $id;
		$this->db->select('outlet');
		$this->db->from('mstoutlet');
		$this->db->where('outletid',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->outlet)?$no->outlet:$id);
	}
	
	public function getjenis($id){
		$where = $id;
		$this->db->select('satuan');
		$this->db->from('dttariff');
		$this->db->join('dtlcashier','dtlcashier.tariffid=dttariff.tariffid','inner');
		$this->db->where('noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->satuan)?$no->satuan:$id);
	}
	
	public function getlastcustomer(){
		$this->db->select('customerid');
		$this->db->from('dtcustomer');
		$this->db->order_by('customerid','desc');
		$this->db->limit(1);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->customerid)?$no->customerid:$id);
	}
	
	public function getcust($id){
		$where = $id;
		$this->db->select('customer');
		$this->db->from('dtcustomer');
		$this->db->join('hdrcashier','hdrcashier.customerid=dtcustomer.customerid','inner');
		$this->db->where('hdrcashier.noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->customer)?$no->customer:$id);
	}
	
	public function getalamat($id){
		$where = $id;
		$this->db->select('alamat');
		$this->db->from('dtcustomer');
		$this->db->join('hdrcashier','hdrcashier.customerid=dtcustomer.customerid','inner');
		$this->db->where('hdrcashier.noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->alamat)?$no->alamat:$id);
	}
	
	public function gethandphone($id){
		$where = $id;
		$this->db->select('handphone');
		$this->db->from('dtcustomer');
		$this->db->join('hdrcashier','hdrcashier.customerid=dtcustomer.customerid','inner');
		$this->db->where('hdrcashier.noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->handphone)?$no->handphone:$id);
	}
	
	public function getterima($id){
		$where = $id;
		$this->db->select('tglterima');
		$this->db->from('dtlcashier');
		$this->db->where('noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->tglterima)?$no->tglterima:"");
	}
	
	public function getproduksi($id){
		$where = $id;
		$this->db->select('tglproduksi');
		$this->db->from('dtlcashier');
		$this->db->where('noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->tglproduksi)?$no->tglproduksi:"");
	}
		
	public function getUpCash($id_sale) 
	{
	  	
	  	$this->db->order_by("tariffid", "ASC");
		$this->db->where('hdrcashier.noresi', $id_sale);
		$this->db->select("tariffid, harga, jumlah as qty, hdrcashier.username AS username_sale, sisa, bayar,diskon, hdrcashier.noresi, 
			hdrcashier.createdate, hdrcashier.total, dtlcashier.subtotal,pembayaran,customerid");
		$this->db->from('dtlcashier');
		$this->db->join('hdrcashier', 'hdrcashier.noresi = dtlcashier.noresi');
				
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			foreach($q->result_array() as $row)
			{
				$data[]=$row;
			}
		}
		$q->free_result();
		return $data;		
	}
	
	function Cetak($id_sale)
	{
		$data = array();
		$this->db->order_by("tariffid", "ASC");
		$this->db->where('hdrcashier.noresi', $id_sale);
		$this->db->select("*");
		$this->db->from('dtlcashier');
		$this->db->join('hdrcashier', 'hdrcashier.noresi = dtlcashier.noresi');
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			foreach($q->result_array() as $row)
			{
				$data[]=$row;
			}
		}
		$q->free_result();
		return $data;
	}
	
	function dd_level(){
		 $this -> db -> select('*');
		 $query = $this -> db ->order_by('levelid','asc')-> get('mstlevel');
		 
		$level = array();
		 
		if ($query -> result()) {
		 foreach ($query->result() as $levelid) {
			$level[$levelid -> levelid] = $levelid -> level;
		 }
			return $level;
		 } else {
			return FALSE;
		 }
		 
	}
	
	function dd_menu(){
		 $this -> db -> select('*');
		 $query = $this -> db ->order_by('menuid','asc')-> get('mstmenu');
		 
		$menu = array();
		 
		if ($query -> result()) {
		 foreach ($query->result() as $menuid) {
			$menu[$menuid -> menuid] = $menuid -> submenu;
		 }
			return $menu;
		 } else {
			return FALSE;
		 } 
	}
	
	function dd_leader(){
		 $where = array('2','3','5');
		
		$this->db->select('*');
		$this->db->from('mstuser');
		$this->db->where("status","1");
		$query = $this->db->get();
		
		$leader = array();
		 
		if ($query -> result()) {
			$leader[] = "";
		 foreach ($query->result() as $userid) {
			$leader[$userid -> userid] = $userid -> name;
		 }
			return $leader;
		 } else {
			return FALSE;
		 }
	}
	
	function dd_username(){
		 $this -> db -> select('*');
		 $query = $this -> db ->order_by('userid','asc')-> get('mstuser');
		 
		$menu = array();
		 
		if ($query -> result()) {
		 foreach ($query->result() as $menuid) {
			$menu[$menuid -> userid] = $menuid -> name;
		 }
			return $menu;
		 } else {
			return FALSE;
		 } 
	}
	
	function dd_outlet(){
		 $this -> db -> select('*');
		 $query = $this -> db ->order_by('outletid','asc')-> get('mstoutlet');
		 
		$menu = array();
		 
		if ($query -> result()) {
			$menu[0] = '';
		 foreach ($query->result() as $menuid) {
			$menu[$menuid -> outletid] = $menuid -> outlet;
		 }
			return $menu;
		 } else {
			return FALSE;
		 } 
	}
	
	function dd_customer(){
		$level = $this->session->userdata('levelid');
		
		$this->db->select('customerid,customer,handphone');
		if($level != "1"){
			$this->db->where("outletid",$this->session->userdata('outletid'));
		}
		return $this->db->get("dtcustomer")->result();
	}
	
	function dd_tariff(){
		$this->db->select('*');
		return $this->db->get("dttariff")->result();
	}
	
	function dd_tipe(){
		$level = $this->session->userdata('levelid');
		
		$this->db->select('tipe');
		if($level != "1"){
			$this->db->where("outletid",$this->session->userdata('outletid'));
		}
		$this->db->where("satuan","Kiloan");
		$this->db->group_by("tipe");
		$query = $this -> db ->order_by('tipe','asc')-> get('dttariff');
		 
		$menu = array();
		 
		if ($query -> result()) {
			$menu[0] = '';
		 foreach ($query->result() as $menuid) {
			$menu[$menuid -> tipe] = $menuid -> tipe;
		 }
			return $menu;
		 } else {
			return FALSE;
		 } 
	}
	
	function dd_paket(){
		$level = $this->session->userdata('levelid');
		
		$this->db->select('tariffid,tariff');
		if($level != "1"){
			$this->db->where("outletid",$this->session->userdata('outletid'));
		}
		$this->db->where("satuan","Paket");
		$this->db->group_by("tariffid,tariff");
		$query = $this -> db ->order_by('tipe','asc')-> get('dttariff');
		 
		$menu = array();
		 
		if ($query -> result()) {
			$menu[0] = '';
		 foreach ($query->result() as $menuid) {
			$menu[$menuid -> tariffid] = $menuid -> tariff;
		 }
			return $menu;
		 } else {
			return FALSE;
		 } 
	}
	
	function dd_jenis(){
		$level = $this->session->userdata('levelid');
		
		$this->db->select('tariffid,jenis');
		if($level != "1"){
			$this->db->where("outletid",$this->session->userdata('outletid'));
		}
		$this->db->where("satuan","Kiloan");
		$this->db->group_by("tariffid,jenis");
		$query = $this -> db ->order_by('tipe','asc')-> get('dttariff');
		 
		$menu = array();
		 
		if ($query -> result()) {
			$menu[0] = '';
		 foreach ($query->result() as $menuid) {
			$menu[$menuid -> tariffid] = $menuid -> jenis;
		 }
			return $menu;
		 } else {
			return FALSE;
		 } 
	}
	
	function kilotipe($id){
		$this->db->select('tipe');
		$this->db->from('dttariff');
		$this->db->where("satuan",$id);
		$this->db->group_by('tipe');
		$query = $this->db->get();
		#echo $this->db->last_query();
		if ($query -> result()) {
		 foreach ($query->result() as $kabid) {
			$result[] = array(
			'tipe' => $kabid -> tipe,
			);
		 }
			return $result;
		 } else {
			return FALSE;
		 }
	}
	
	function kilojenis($id){
		$this->db->select('tariffid,jenis');
		$this->db->from('dttariff');
		$this->db->where("tipe",$id);
		$this->db->group_by('jenis');
		$query = $this->db->get();
		#echo $this->db->last_query();
		if ($query -> result()) {
		 foreach ($query->result() as $kabid) {
			$result[] = array(
			'tariffid' => $kabid->tariffid,
			'jenis' => $kabid -> jenis,
			);
		 }
			return $result;
		 } else {
			return FALSE;
		 }
	}
	
	function kilotable($id){
		$this->db->select('*');
		$this->db->from('dttariff');
		$this->db->where("tariffid",$id);
		$query = $this->db->get();
		#echo $this->db->last_query();
		if ($query -> result()) {
		 foreach ($query->result() as $kabid) {
			$result[] = array(
			'tariffid' => $kabid->tariffid,'tariff' => $kabid->tariff,'harga' => $kabid->harga,
			'diskon'=> $kabid->diskon,
			);
		 }
			return $result;
		 } else {
			return FALSE;
		 }
	}
	
	function getcustomer($id)
	{
		$custID = $id;
		
		$this->db->select("*")
				 ->from('dtcustomer')
				 ->where('customerid', $custID);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("cust" => $row->customer, "alamat" => $row->alamat, "hp" => $row->handphone);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	function gettariff($id)
	{
		$custID = $id;
		
		$this->db->select("*")
				 ->from('dttariff')
				 ->where('tariffid', $custID);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("harga" => $row->harga, "diskon" => $row->diskon, "perkg" => $row->perkg,"tariffid" => $row->tariffid);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	function getproduct($id)
	{ 
			$code = $this->db->where('tariffid',$id)
							->limit(1)
							->get('dttariff');
			if ($code->num_rows() > 0 )
				{
					return $code->row();
				}else {
					return array();
				}//end if code->num_rows > 0 
				
	}
	
	function getbayar($id){
		$where = $id;
		$this->db->select('bayar');
		$this->db->from('hdrcashier');
		$this->db->where('noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->bayar)?$no->bayar:0);
	}
	
	function getsisa($id){
		$where = $id;
		$this->db->select('sisa');
		$this->db->from('hdrcashier');
		$this->db->where('noresi',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->sisa)?$no->sisa:0);
	}
	
	function getpa($id){
		$where = $id;
		$this->db->select('password');
		$this->db->from('mstlogin');
		$this->db->where('loginid',$where);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->password)?$no->password:"");
	}
	
}
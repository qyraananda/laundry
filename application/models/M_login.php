<?php
class M_login extends CI_Model
{
	
	function check()
	{
		$this->db->where('username', $this->input->post('pass', TRUE));  
		$this->db->where('password', md5($this->input->post('identity', TRUE)));
		$data = array("status"=>"1");
		$query = $this->db->get_where('mstlogin',$data);; 

		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			$getmy = date("Ymdhs");
			$data = array(
					'userid' => $result['userid'],
					'username' => $result['username'],
					'nama'  => $result['username'],
					'levelid' => $result['levelid'],
					'outletid' => $result['outletid'],
					'status' => $result['status'],
					'lastlogin' => $result['lastlogin'],
					'foto' => $result['foto'],
					'outletuser' => $getmy,
					'program' => 'Bintang Laundry',
					'pt' => 'PT. Bintang Inti Global',
					'versi' => '1.0.0',
					'lisensi' => '@2018 - ary winar',
					'logged_on' => TRUE);		
			$this->session->set_userdata($data);
			
			$date=date_create(date("Y-m-d h:m:s"));
			date_add($date,date_interval_create_from_date_string("12 hours"));
			$sub = date_format($date,"Y-m-d");
			
			$this->db->query("update mstlogin set ipaddress='".$this->get_ip_address()."',lokasi='".$this->input->post('latitude').":".$this->input->post('longitude')."',lastlogin='".$sub."' where userid=".$result['userid']);
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
		
	function get_ip_address() {
		 $ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
}
?>
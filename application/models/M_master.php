<?php
class M_master extends CI_Model
{
	
	function getAll_Cash($id_sale){
		$this->db->order_by("tariffid", "ASC");
		$this->db->where('hdrcashier.hdrcashid', $id_sale);
		$this->db->select("*");
		$this->db->from('dtlcashier');
		$this->db->join('hdrcashier', 'hdrcashier.noresi = dtlcashier.noresi');
				
		return $this->db->get()->row();
	}
	
	function get_by_id($table,$tableid,$id) {
        $this->db->where($tableid, $id);
        return $this->db->get($table)->row();
    }
	
	// insert data
    function insert($table,$data) {
        $this->db->insert($table, $data);
		$error = $this->db->error();	
		
		if (!empty($error['message'])) { 
			$error = "<b>Error ".$error["code"]." create ".$error["message"]."\n</b>"; 
			$this->session->set_flashdata('message',$error);
			#return false;
		}else{
			$this->session->set_flashdata('message','<b>Create Record Success</b>');
			#return true;
		}
		
    }

    // update data
    function update($table,$tableid,$id, $data) {	
        $this->db->where($tableid, $id);
        $this->db->update($table, $data);
		
		$error = $this->db->error();	
		if (!empty($error['message'])) { 
			$error = "<b>Error ".$error["code"]." update ".$error["message"]."\n</b>"; 
			$this->session->set_flashdata('message',$error);
			#return "error";
		}else{
			$this->session->set_flashdata('message','<b>Update Record Success</b>');
			#return true;
		}
    }

    // delete data
    function delete($table,$tableid,$id) {
        $this->db->where($tableid, $id);
        $this->db->delete($table);
		
		$error = $this->db->error();		
		if (!empty($error['message'])) { 
			$error = "<b>Error ".$error["code"]." delete ".$error["message"]."\n</b>"; 
			$this->session->set_flashdata('message',$error);
			#return "error";
		}else{
			$this->session->set_flashdata('message','<b>Delete Record Success</b>');
			#return true;
		}
    }
	
	function Get_Outlet($id)
	{
		$data = array();
		$this->db->order_by("mstoutlet.outletid", "DESC");
		$this->db->where('hdrcashier.noresi', $id);
		$this->db->select("mstoutlet.outletid,outlet, picname, alamat, telephone, kota");
		$this->db->from('mstoutlet');
		$this->db->join('hdrcashier', 'hdrcashier.outletid = mstoutlet.outletid');
		
		$q = $this->db->get();
		#echo $this->db->last_query();
		  if($q->num_rows() > 0)
		  {
		  	$data = $q->row_array();
		  }
		$q->free_result();
		return $data;
	}
	
	function Get_Nota($id_sale)
	{		
		$data = array();
		$this->db->select("*");
		if(!empty($id_sale)){$this->db->where('noresi', $id_sale);}
		$this->db->order_by('hdrcashid','DESC');
		$this->db->limit(1);
		$q = $this->db->get('hdrcashier');
		  if($q->num_rows() > 0)
		  {
		  	$data = $q->row_array();
		  }
		$q->free_result();
		#echo $this->db->last_query();
		return $data;
	}
	
	function nomor_resi()
	{		
		$this->db->select('hdrcashid');
		$this->db->from('hdrcashier');
		$this->db->order_by('hdrcashid',"DESC");
		$this->db->limit(1);
		$data = $this->db->get();
		$no = $data->row(0);
		
		return (isset($no->hdrcashid)?$this->tambahnol($no->hdrcashid):$this->tambahnol("0"));
	}
	
	function tambahnol($no){
		#echo $no;
		if($no > 99999){
			$no = 0;
		}
		
		if($no == 0){
			return "00001";
		}
		if($no > 0 && $no < 9){
			$no = $no + 1;
			return "0000".$no;
		}
		if($no > 8 && $no < 99){
			$no = $no + 1;
			return "000".$no;
		}
		if($no > 98 && $no < 999){
			$no = $no + 1;
			return "00".$no;
		}
		if($no > 999 && $no < 9999){
			$no = $no + 1;
			return "0".$no;
		}
		if($no > 9999 && $no < 99999){
			$no = $no + 1;
			return $no;
		}
		
	}
	
	function _setrules($add_fields,$field_types){
		foreach($add_fields as $add_field)
			{
				$field_name = $add_field;
				#$this->form_validation->set_rules($field_name, $field_types[$field_name]->display_as, 'trim|required');
				$this->form_validation->set_rules($field_name, $this->display_as($field_name,null), 'trim|required');
			}
	
        $this->form_validation->set_error_delimiters('<span class="text-red">', '</span>');
	}
	
	public function display_as($field_name, $display_as = null)
	{
		if(is_array($field_name))
		{
			foreach($field_name as $field => $display_as)
			{
				$this->display_as[$field] = $display_as;
			}
		}
		elseif($display_as !== null)
		{
			$this->display_as[$field_name] = $display_as;
		}
		return $this;
	}
	
	function set_file_upload($nmfield,$folder){
		#$row = $this->get_by_id($table,$tableid,$id);

		if ($_FILES AND $_FILES[$nmfield]['name']) {
				// Start uploading file
				$config = array(
						'upload_path' => ''.$folder.'',
						'allowed_types' => 'jpeg|jpg|png',
						'max_size' => '2048',
						'max_width' => '2000',
						'max_height' => '2000'
				);
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload($nmfield)) {
						$this->session->set_flashdata('message', "<div style='color:#ff0000;'>" . $this->upload->display_errors() . "</div>");
						return false;
				} else {

						// Remove old image in folder 'images' using unlink()
						// unlink() use for delete files like image.
						
						 if (file_exists($folder.'/'.$nmfield)) {
							unlink(''.$folder.'/'.$nmfield);
						 }
						$file = $this->upload->data();
						
						return $file['file_name'];
				}
		}
		// Do this if there's no image file uploaded
		else {
				return false;
		}
	}
	
	function status($table,$field){
		$enums = array();
        if ($table == '' || $field == '') return $enums;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value) {
            $enums[$value] = $value; 
        }
		#echo $this->db->last_query();
        return $enums;
	}
}
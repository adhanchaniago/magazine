<?php
class M_admin extends CI_Model  {

    public function __contsruct(){
        parent::Model();
    }

	//CONFIGURATION TABEL edisi
	public function insert_edisi($data){
        $this->db->insert("edisi",$data);
    }
    
    public function update_edisi($where,$data){
        $this->db->update("edisi",$data,$where);
    }

    public function delete_edisi($where){
        $this->db->delete("edisi", $where);
    }

	public function get_edisi($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("edisi");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_edisi($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("edisi");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_edisi($where="", $like=""){
        $this->db->select("*");
        $this->db->from("edisi");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	//CONFIGURATION TABEL Sekolah
	public function select_sekolah(){
		$data = $this->db->get('sekolah')->result();
		return $data;
	}

	public function insert_sekolah($data){
        $this->db->insert("sekolah",$data);
    }
    
    public function update_sekolah($where,$data){
        $this->db->update("sekolah",$data,$where);
    }

    public function delete_sekolah($where){
        $this->db->delete("sekolah", $where);
    }

	public function get_sekolah($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("sekolah");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_sekolah($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("sekolah");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_sekolah($where="", $like=""){
        $this->db->select("*");
        $this->db->from("sekolah");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	
	//CONFIGURATION TABEL Pegawai
	public function select_pegawai(){
		$data = $this->db->get('pegawai')->result();
		return $data;
	}

	public function insert_pegawai($data){
        $this->db->insert("pegawai",$data);
    }
    
    public function update_pegawai($where,$data){
        $this->db->update("pegawai",$data,$where);
    }

    public function delete_pegawai($where){
        $this->db->delete("pegawai", $where);
    }

	public function get_pegawai($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("pegawai AS p");
		$this->db->join('sekolah AS s', 'p.sekolah_id = s.sekolah_id');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_pegawai($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pegawai AS p");
		$this->db->join('sekolah AS s', 'p.sekolah_id = s.sekolah_id');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_pegawai($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pegawai");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
		//CONFIGURATION TABEL artikel
	public function select_artikel(){
		$data = $this->db->get('artikel')->result();
		return $data;
	}

	public function insert_artikel($data){
        $this->db->insert("artikel",$data);
    }
    
    public function update_artikel($where,$data){
        $this->db->update("artikel",$data,$where);
    }

    public function delete_artikel($where){
        $this->db->delete("artikel", $where);
    }

	public function get_artikel($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("artikel AS a");
		$this->db->join('pegawai AS p', 'a.pegawai_nip = p.pegawai_nip');
		$this->db->join('edisi AS e', 'a.edisi_id = e.edisi_id');
		$this->db->join('sekolah AS s', 'p.sekolah_id = s.sekolah_id');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_artikel($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("artikel AS a");
		$this->db->join('pegawai AS p', 'a.pegawai_nip = p.pegawai_nip');
		$this->db->join('edisi AS e', 'a.edisi_id = e.edisi_id');
		$this->db->join('sekolah AS s', 'p.sekolah_id = s.sekolah_id');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_artikel($where="", $like=""){
        $this->db->select("*");
        $this->db->from("artikel");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	public function grid_all_artikel2($select, $orderBy, $sortBy, $limit, $start, $month="", $year="", $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("artikel AS a");
		$this->db->join('pegawai AS p', 'a.pegawai_nip = p.pegawai_nip');
		$this->db->join('edisi AS e', 'a.edisi_id = e.edisi_id');
		$this->db->join('sekolah AS s', 'p.sekolah_id = s.sekolah_id');
		if ($month){
			$this->db->where("DATE_FORMAT(artikel_created,'%m')", $month);
			$this->db->where("DATE_FORMAT(artikel_created,'%Y')", $year);
		}
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
	}
	public function count_all_artikel2($month="", $year="", $where="", $like=""){
        $this->db->select("*");
        $this->db->from("artikel");
		if ($where){$this->db->where($where);}
		if ($month){
			$this->db->where("DATE_FORMAT(artikel_created,'%m')", $month);
			$this->db->where("DATE_FORMAT(artikel_created,'%Y')", $year);
		}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	//CONFIGURATION TABEL Jabatan
	public function select_jabatan(){
		$data = $this->db->get('jabatan')->result();
		return $data;
	}

	public function insert_jabatan($data){
        $this->db->insert("jabatan",$data);
    }
    
    public function update_jabatan($where,$data){
        $this->db->update("jabatan",$data,$where);
    }

    public function delete_jabatan($where){
        $this->db->delete("jabatan", $where);
    }

	public function get_jabatan($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("jabatan");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_jabatan($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("jabatan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_jabatan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("jabatan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABEL USER
	public function select_admin(){
		$data = $this->db->get('user')->result();
		return $data;
	}

	public function insert_admin($data){
        $this->db->insert("user",$data);
    }
    
    public function update_admin($where,$data){
        $this->db->update("user",$data,$where);
    }

    public function delete_admin($where){
        $this->db->delete("user", $where);
    }

	public function get_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("user");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("user");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_admin($where="", $like=""){
        $this->db->select("*");
        $this->db->from("user");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABEL IDENTITAS
	public function select_identitas(){
		$data = $this->db->get('identitas')->result();
		return $data;
	}

	public function insert_identitas($data){
        $this->db->insert("identitas",$data);
    }
    
    public function update_identitas($where,$data){
        $this->db->update("identitas",$data,$where);
    }

    public function delete_identitas($where){
        $this->db->delete("identitas", $where);
    }

	public function get_identitas($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_identitas($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit, $start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_identitas($where="", $like=""){
        $this->db->select("*");
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	public function identitaswebsite(){
        $data = "";
		$where['identitas_id'] = 1;
		$this->db->select("*");
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    
    // CONFIGURATION COMBO BOX WITH DATABASE WITH VALIDASI
	public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}

    // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box2($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	   // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box3($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name'  style='display:none;' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_kelas($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->kelas_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function listarray($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo $row->$name_value.", ";
			}
		}
	}
}
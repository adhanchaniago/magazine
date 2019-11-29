<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index()
	{
		if($this->session->userdata('log_in') == TRUE){
			$where_admin['username']		= $this->session->userdata('username');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			redirect("majalah/edisi");
		} else {
			redirect("login");
		}
	 }

	 //FUNCTION Sekolah
	public function sekolah($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('log_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Sekolah';
				$data['content'] 			= 'backend/content/master/sekolah';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('sekolah_nama'=>'Nama',
														'sekolah_alamat'=>'Alamat');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'sekolah_nama';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_sekolah[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_sekolah('', $like_sekolah);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					$data['validate']			= array('sekolah_id'=>'ID',
													'sekolah_nama'=>'Nama',
													'sekolah_alamat'=>'Alamat'
												);
					$data['onload']				= 'sekolah_id';
					$data['sekolah_id']			= ($this->input->post('sekolah_id'))?$this->input->post('sekolah_id'):'';
					$data['sekolah_nama']			= ($this->input->post('sekolah_nama'))?$this->input->post('sekolah_nama'):'';
					$data['sekolah_alamat']		= ($this->input->post('sekolah_alamat'))?$this->input->post('sekolah_alamat'):'';		
					
					$simpan						= $this->input->post('simpan');
					if ($simpan){								
						$insert['sekolah_id']		= validasi_sql($data['sekolah_id']);
						$insert['sekolah_nama']		= validasi_sql($data['sekolah_nama']);
						$insert['sekolah_alamat']		= validasi_sql($data['sekolah_alamat']);
						$this->ADM->insert_sekolah($insert);
						$this->session->set_flashdata('success','Sekolah baru telah berhasil ditambahkan!,');
						redirect("master/sekolah");
					}
				} elseif ($data['action'] == 'edit'){				
					$where['username']		       = $filter2; 
					$data['validate']			= array('sekolah_nama'=>'Nama',
														'sekolah_alamat'=>'Alamat'
														);
					$data['onload']					= 'sekolah_id';
					$where_sekolah['sekolah_id']		= $filter2; 
					$sekolah							= $this->ADM->get_sekolah('*', $where_sekolah);
					$data['sekolah_id']				= ($this->input->post('sekolah_id'))?$this->input->post('sekolah_id'):$sekolah->sekolah_id;
					$data['sekolah_nama']				= ($this->input->post('sekolah_nama'))?$this->input->post('sekolah_nama'):$sekolah->sekolah_nama;				
					$data['sekolah_alamat']				= ($this->input->post('sekolah_alamat'))?$this->input->post('sekolah_alamat'):$sekolah->sekolah_alamat;				
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['sekolah_id']	= validasi_sql($data['sekolah_id']);
						$edit['sekolah_nama']			= validasi_sql($data['sekolah_nama']);
						$edit['sekolah_alamat']			= validasi_sql($data['sekolah_alamat']);
						$this->ADM->update_sekolah($where_edit, $edit);
						$this->session->set_flashdata('success','Sekolah telah berhasil diedit!,');
						redirect("master/sekolah");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'sekolah_id';
					$where_sekolah['sekolah_id']		        = $filter2; 
					$data['sekolah']							= $this->ADM->get_sekolah('*', $where_sekolah);
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['sekolah_id'] = validasi_sql($filter2);
					$this->ADM->delete_sekolah($where_delete);
					$this->session->set_flashdata('warning','Sekolah telah berhasil dihapus!,');
					redirect("master/sekolah");
				}
			} else {
				redirect("majalah/edisi");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
    // ================================================== END Sekolah ================================================== //
	
	// ================================================== Pegawai ================================================== //
	//FUNCTION Pegawai
	public function pegawai($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('log_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Pegawai';
				$data['content'] 			= 'backend/content/master/pegawai';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('pegawai_nip'=>'NIP Pegawai',
														'pegawai_nama'=>'Nama Pegawai');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pegawai_nip';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_pegawai[$data['cari']]	= $data['q'];
					
			if ($data['admin']->user_role === 'admin') {
					$data['jml_data']			= $this->ADM->count_all_pegawai('', $like_pegawai);
			} else {
				$where['pegawai_nip'] = $data['admin']->username;
				$data['jml_data']			= $this->ADM->count_all_pegawai($where, $like_pegawai);
			}
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					if ($data['admin']->user_role === 'admin' ) {
					$data['validate']			= array('pegawai_nip'=>'NIP Pegawai',
														'pegawai_nama'=>'Nama Pegawai',
														'pegawai_alamat'=>'Alamat Pegawai',
														'pegawai_password'=>'Password Pegawai',
														'sekolah_id'=>'ID Sekolah',
														'jabatan'=>'ID Jabatan',
														'golongan'=>'ID Golongan'
												);
					$data['onload']				= 'pegawai_nip';
					$data['pegawai_nip']			= ($this->input->post('pegawai_nip'))?$this->input->post('pegawai_nip'):'';
					$data['pegawai_nama']			= ($this->input->post('pegawai_nama'))?$this->input->post('pegawai_nama'):'';
					$data['pegawai_alamat']			= ($this->input->post('pegawai_alamat'))?$this->input->post('pegawai_alamat'):'';
					$data['pegawai_password']			= ($this->input->post('pegawai_password'))?$this->input->post('pegawai_password'):'';	
					$data['sekolah_id']			= ($this->input->post('sekolah_id'))?$this->input->post('sekolah_id'):'';	
					$data['jabatan']			= ($this->input->post('jabatan'))?$this->input->post('jabatan'):'';	
					$data['golongan']			= ($this->input->post('golongan'))?$this->input->post('golongan'):'';		
					
					$where['username']		= $data['pegawai_nip'];
					$jml_pengguna				= $this->ADM->count_all_admin($where);
																				
					$simpan						= $this->input->post('simpan');
					if ($simpan && $jml_pengguna < 1 ){								
						$insert['username']		= validasi_sql($data['pegawai_nip']);
						$insert['password']		= validasi_sql(do_hash(($data['pegawai_password']), 'md5'));
						$insert['user_nama']		= validasi_sql($data['pegawai_nama']);
						$insert['user_role']		= 'user';
						$this->ADM->insert_admin($insert);

						$insert2['pegawai_nip']		= validasi_sql($data['pegawai_nip']);
						$insert2['pegawai_password']		= validasi_sql(do_hash(($data['pegawai_password']), 'md5'));
						$insert2['pegawai_nama']		= validasi_sql($data['pegawai_nama']);
						$insert2['pegawai_alamat']		= validasi_sql($data['pegawai_alamat']);
						$insert2['sekolah_id']		= validasi_sql($data['sekolah_id']);
						$insert2['jabatan']		= validasi_sql($data['jabatan']);
						$insert2['golongan']		= validasi_sql($data['golongan']);
						$this->ADM->insert_pegawai($insert2);

						$this->session->set_flashdata('success','Pegawai baru telah berhasil ditambahkan!,');
						redirect("master/pegawai");
					} elseif ($simpan && $jml_pengguna > 0 ){
						echo '<script type="text/javascript">
								alert("Pegawai telah terdaftar!,");
							</script>';
					}
				} else {
					redirect("master/pegawai");
				}
				} elseif ($data['action'] == 'edit'){				
					$where['pegawai_nip']		       = $filter2; 
					$data['validate']			= array('pegawai_nip'=>'NIP Pegawai',
														'pegawai_nama'=>'Nama Pegawai',
														'pegawai_alamat'=>'Alamat Pegawai',
														'pegawai_password'=>'Password Pegawai',
														'sekolah_id'=>'ID Sekolah',
														'jabatan'=>'ID Jabatan',
														'golongan'=>'ID Golongan'
												);
					$data['onload']					= 'pegawai_nip';
					$where_pegawai['pegawai_nip']	= $filter2; 
					$pegawai						= $this->ADM->get_pegawai('*', $where_pegawai);
					if ($data['admin']->user_role === 'admin' || $data['admin']->username === $pegawai->pegawai_nip) {
					$data['pegawai_nip']			= ($this->input->post('pegawai_nip'))?$this->input->post('pegawai_nip'):$pegawai->pegawai_nip;
					$data['pegawai_password']		= ($this->input->post('pegawai_password'))?$this->input->post('pegawai_password'):'';				
					$data['pegawai_nama']			= ($this->input->post('pegawai_nama'))?$this->input->post('pegawai_nama'):$pegawai->pegawai_nama;				
					$data['pegawai_alamat']			= ($this->input->post('pegawai_alamat'))?$this->input->post('pegawai_alamat'):$pegawai->pegawai_alamat;						
					$data['sekolah_id']			= ($this->input->post('sekolah_id'))?$this->input->post('sekolah_id'):$pegawai->sekolah_id;						
					$data['jabatan']			= ($this->input->post('jabatan'))?$this->input->post('jabatan'):$pegawai->jabatan;					
					$data['golongan']			= ($this->input->post('golongan'))?$this->input->post('golongan'):$pegawai->golongan;						
					$data['sekolah_nama']			= ($this->input->post('sekolah_nama'))?$this->input->post('sekolah_nama'):$pegawai->sekolah_nama;		
					
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['username']	= validasi_sql($data['pegawai_nip']);
						if ($data['pegawai_password'] <> '') {						
						$edit['password']			= validasi_sql(do_hash(($data['pegawai_password']), 'md5')); }
						$edit['user_nama']			= validasi_sql($data['pegawai_nama']);
						$this->ADM->update_admin($where_edit, $edit);

						$where_edit2['pegawai_nip']	= validasi_sql($data['pegawai_nip']);
						if ($data['pegawai_password'] <> '') {						
						$edit2['pegawai_password']			= validasi_sql(do_hash(($data['pegawai_password']), 'md5')); }
						$edit2['pegawai_nama']			= validasi_sql($data['pegawai_nama']);
						$edit2['pegawai_alamat']			= validasi_sql($data['pegawai_alamat']);
						$edit2['sekolah_id']			= validasi_sql($data['sekolah_id']);
						$edit2['jabatan']			= validasi_sql($data['jabatan']);
						$edit2['golongan']			= validasi_sql($data['golongan']);
						$this->ADM->update_pegawai($where_edit2, $edit2);

						$this->session->set_flashdata('success','Pegawai telah berhasil diedit!,');
						redirect("master/pegawai");
					}
				} else {
					redirect("master/pegawai");
				}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'pegawai_nip';
					$where_pegawai['pegawai_nip']		        = $filter2; 
					$data['pegawai']							= $this->ADM->get_pegawai('*', $where_pegawai);
					if ($data['admin']->user_role === 'admin' || $data['admin']->username === $filter2) {

					} else {
						redirect("master/pegawai");
					}
				} elseif ($data['action'] == 'hapus'){			
					if ($data['admin']->user_role === 'admin') {	
					$where_delete['pegawai_nip'] = validasi_sql($filter2);
					$this->ADM->delete_pegawai($where_delete);
					$where_delete2['username'] = validasi_sql($filter2);
					$this->ADM->delete_admin($where_delete2);
					$this->session->set_flashdata('warning','Pegawai telah berhasil dihapus!,');
					redirect("master/pegawai");
					} else {
						
					redirect("master/pegawai");
					}
				}
			} else {
				redirect("majalah/edisi");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Pegawai ================================================== //
}

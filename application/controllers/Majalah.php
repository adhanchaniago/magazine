<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Majalah extends CI_Controller {

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
     
    // ================================================== Edisi ================================================== //
	//FUNCTION Edisi
	public function edisi($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('log_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'user' || $data['admin']->user_role === 'kepegum') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Edisi';
				$data['content'] 			= 'backend/content/majalah/edisi';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('edisi_nama'=>'Nama Edisi');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'edisi_nama';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_edisi[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_edisi('', $like_edisi);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					if ($data['admin']->user_role === 'admin') {
					$data['validate']			= array('edisi_id'=>'ID Edisi', 'edisi_nama'=>'Nama Edisi');
					$data['onload']				= 'edisi_id';
					$data['edisi_id']		= ($this->input->post('edisi_id'))?$this->input->post('edisi_id'):'';	
					$data['edisi_nama']		= ($this->input->post('edisi_nama'))?$this->input->post('edisi_nama'):'';	
					$simpan						= $this->input->post('simpan');
					if ($simpan){
						$insert['edisi_id']			= validasi_sql($data['edisi_id']);
						$insert['edisi_nama']			= validasi_sql($data['edisi_nama']);
						$this->ADM->insert_edisi($insert);
						$this->session->set_flashdata('success','Edisi baru telah berhasil ditambahkan!,');
						redirect("majalah/edisi");
					}
				} else {
					redirect("majalah/edisi");
				}
				} elseif ($data['action'] == 'edit'){	
					if ($data['admin']->user_role === 'admin') {			
					$where['edisi_id']		       = $filter2; 
					$data['validate']				= array(
														'edisi_nama'=>'Nama Edisi'
														);
					$data['onload']					= 'edisi_id';
					$where_edisi['edisi_id']			= $filter2; 
					$edisi							= $this->ADM->get_edisi('*', $where_edisi);
					$data['edisi_id']					= ($this->input->post('edisi_id'))?$this->input->post('edisi_id'):$edisi->edisi_id;
					$data['edisi_nama']				= ($this->input->post('edisi_nama'))?$this->input->post('edisi_nama'):$edisi->edisi_nama;	
					$data['edisi_status']					= ($this->input->post('edisi_status'))?$this->input->post('edisi_status'):$edisi->edisi_status;
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['edisi_id']		= validasi_sql($data['edisi_id']);
						$edit['edisi_nama']			= validasi_sql($data['edisi_nama']);
						$edit['edisi_status']			= validasi_sql($data['edisi_status']);
						$this->ADM->update_edisi($where_edit, $edit);
						$this->session->set_flashdata('success','Edisi telah berhasil diedit!,');
						redirect("majalah/edisi");
					}
				} else {
					redirect("majalah/edisi");
				}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'edisi_id';
					$where_edisi['edisi_id']		    = $filter2; 
					$where_artikel['edisi_id']		= $filter2;
					$where_artikel['artikel_approve'] = 1;

					$data['edisi']					= $this->ADM->get_edisi('*', $where_edisi);

					$data['berdasarkan']		= array('artikel_judul'=>'Judul Artikel');
$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'artikel_judul';
$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
$data['halaman']			= (empty($filter2))?1:$filter2;
$data['batas']				= 10000;
$data['page']				= ($data['halaman']-1) * $data['batas'];
$like_artikel[$data['cari']]	= $data['q'];
$data['jml_data']			= $this->ADM->count_all_artikel($where_artikel, $like_artikel);
$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
					} elseif ($data['action'] == 'artikel'){		
					$data['onload']					= 'artikel_id';
					$where_rak['artikel_id']		    = $filter2; 

					$data['batas']				= 10000;
					$data['artikel']					= $this->ADM->get_artikel('*', $where_artikel);

				} elseif ($data['action'] == 'hapus'){			
					if ($data['admin']->user_role === 'admin') {		
					$where_delete['edisi_id'] = validasi_sql($filter2);
					$this->ADM->delete_edisi($where_delete);
					$this->session->set_flashdata('warning','Edisi telah berhasil dihapus!,');
					redirect("majalah/edisi");
					} else {
						redirect("majalah/edisi");
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
	// ================================================== END Edisi ================================================== //
	
	
	// ================================================== artikel ================================================== //
	//FUNCTION artikel
	public function artikel($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('log_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'user' || $data['admin']->user_role === 'kepegum') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Artikel';
				$data['content'] 			= 'backend/content/majalah/artikel';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['month'] ="";
					$data['year'] ="";
					$month = "";
					$year ="2018";
					$data['kirim']				= $this->input->post('kirim');
					if ($this->input->post('month')) {
						$month = $this->input->post('month');
						$year = $this->input->post('year');
					}
					
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];


					if ($data['admin']->user_role === 'user') {
						$where['pegawai_nip']	= $data['admin']->username;
						$data['jml_data']			= $this->ADM->count_all_artikel2($month, $year, $where, '');
					} else {
						$data['jml_data']			= $this->ADM->count_all_artikel2($month, $year, '', '');
					}


					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);

				} elseif ($data['action'] == 'tambah'){
					if ($data['admin']->user_role === 'user') {
					$data['validate']			= array('artikel_id'=>'ID Artikel',
														'artikel_judul'=>'Judul Artikel',
														'pegawai_nip'=>'Pengirim',
														'edisi_id'=>'Edisi');
														$data['onload']				= 'artikel_id';
					$data['artikel_id']		= ($this->input->post('artikel_id'))?$this->input->post('artikel_id'):'';	
					$data['artikel_judul']		= ($this->input->post('artikel_judul'))?$this->input->post('artikel_judul'):'';	
					$data['edisi_id']		= ($this->input->post('edisi_id'))?$this->input->post('edisi_id'):'';	
					$data['artikel_dok']		= ($this->input->post('artikel_dok'))?$this->input->post('artikel_dok'):'';	
					
					$simpan						= $this->input->post('simpan');
					if ($simpan){


						$insert['artikel_id']	= validasi_sql($data['artikel_id']);
						$insert['artikel_judul']	= validasi_sql($data['artikel_judul']);
						$insert['pegawai_nip']		= $data['admin']->username;
						$insert['edisi_id']			= validasi_sql($data['edisi_id']);
					
						$config['upload_path']          = './assets/files/artikel_dok/'; 
						$config['allowed_types']        = 'docx|doc|DOC|DOCX';
						$config['encrypt_name'] 		= TRUE;
						$config['max_size']             = 11000;
						$config['max_width']            = 4096;
						$config['max_height']           = 2048;

						$this->upload->initialize($config);
						if ($this->upload->do_upload('artikel_dok'))
						{
							
						$data = array('upload_data' => $this->upload->data());
						$insert['artikel_dok'] 	= $this->upload->data('file_name');
						}
				
							$this->ADM->insert_artikel($insert);
							$this->session->set_flashdata('success','Artikel baru telah berhasil ditambahkan!,');
							redirect("majalah/artikel");
						}
					} else {
						redirect("majalah/artikel");
					}
				} elseif ($data['action'] == 'edit'){				
					$where['artikel_id']		       = $filter2; 	
					$data['validate']			= array('artikel_judul'=>'Judul Artikel',
														'pegawai_nip'=>'Pengirim',
														'edisi_id'=>'Edisi');
					$data['onload']					= 'artikel_id';
					$where_artikel['artikel_id']			= $filter2; 
					$artikel							= $this->ADM->get_artikel('*', $where_artikel);

					if ($data['admin']->username === $artikel->pegawai_nip) {
					$data['artikel_id']					= ($this->input->post('artikel_id'))?$this->input->post('artikel_id'):$artikel->artikel_id;
					$data['pegawai_nip']					= ($this->input->post('pegawai_nip'))?$this->input->post('pegawai_nip'):$artikel->pegawai_nip;
					$data['edisi_id']					= ($this->input->post('edisi_id'))?$this->input->post('edisi_id'):$artikel->edisi_id;
					$data['artikel_judul']					= ($this->input->post('artikel_judul'))?$this->input->post('artikel_judul'):$artikel->artikel_judul;
					$data['artikel_dok']					= ($this->input->post('artikel_dok'))?$this->input->post('artikel_dok'):$artikel->artikel_dok;
				
					$data['pegawai_nama']					= ($this->input->post('pegawai_nama'))?$this->input->post('pegawai_nama'):$artikel->pegawai_nama;
					$data['edisi_nama']					= ($this->input->post('edisi_nama'))?$this->input->post('edisi_nama'):$artikel->edisi_nama;
					

					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['artikel_id']		= validasi_sql($data['artikel_id']);

						$edit['pegawai_nip']			= validasi_sql($data['pegawai_nip']);
						$edit['edisi_id']				= validasi_sql($data['edisi_id']);
						$edit['artikel_judul']			= validasi_sql($data['artikel_judul']);

						$config['upload_path']          = './assets/files/artikel_dok/'; 
						$config['allowed_types']        = 'docx|doc|DOC|DOCX';
						$config['encrypt_name'] 		= TRUE;
						$config['max_size']             = 11000;
						$config['max_width']            = 4096;
						$config['max_height']           = 2048;
					
					$this->upload->initialize($config);
					if ($this->upload->do_upload('artikel_dok'))
					{
						unlink("./assets/files/artikel_dok/".$artikel->artikel_dok);

						$data = array('upload_data' => $this->upload->data());
						$edit['artikel_dok'] 	= $this->upload->data('file_name');
					}

					$this->ADM->update_artikel($where_edit, $edit);
					$this->session->set_flashdata('success','Artikel telah berhasil diedit!,');
					redirect("majalah/artikel");
					}
				} else {
					redirect("majalah/artikel");
				}
			} elseif ($data['action'] == 'approve'){	
				$where_artikel['artikel_id']			= $filter2; 

				$edit['artikel_approve']			= 1;

			$this->ADM->update_artikel($where_artikel, $edit);
			$this->session->set_flashdata('success','Artikel telah berhasil diapprove!,');
			redirect("majalah/artikel");
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'artikel_id';
					$where_rak['artikel_id']		    = $filter2; 

					$data['batas']				= 10000;
					$where_artikel['artikel_id']		= $filter2;
					$data['artikel']					= $this->ADM->get_artikel('*', $where_artikel);
				} elseif ($data['action'] == 'hapus'){			
					$where_artikel['artikel_id']			= $filter2; 
					$artikel							= $this->ADM->get_artikel('*', $where_artikel);	
					if ($data['admin']->username === $artikel->pegawai_nip || $data['admin']->user_role === 'admin') {
						unlink("./assets/files/artikel_dok/".$artikel->artikel_dok);
					$where_delete['artikel_id'] = validasi_sql($filter2);
					$this->ADM->delete_artikel($where_delete);
					$this->session->set_flashdata('warning','Artikel telah berhasil dihapus!,');
					redirect("majalah/artikel");
					} else {
						redirect("majalah/artikel");
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
	// ================================================== END artikel ================================================== //

	// ================================================== grafik ================================================== //
	//FUNCTION grafik
	public function grafik($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('log_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'user' || $data['admin']->user_role === 'kepegum') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Grafik Artikel';
				$data['content'] 			= 'backend/content/majalah/grafik';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['year'] ="";
					$month = "";
					$data['year'] ="2018";
					$year ="2018";
					$data['kirim']				= $this->input->post('kirim');
					if ($this->input->post('year')) {
						$year = $this->input->post('year');
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
	// ================================================== END grafik ================================================== //

	public function artikelpdf($filter1='', $filter2='', $filter3=''){
		if ($this->session->userdata('log_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin') {
				$data['web']				= $this->ADM->identitaswebsite();
				$data['title'] = 'Cetak Laporan Artikel'; 

				if ($filter1) {
					$data['filter1']	        = $filter1; 
					$data['filter2']	        = $filter2; 
					$data['month']	        = $filter1; 
					$data['year']	        = $filter2; 
					$this->load->view('backend/content/majalah/pdf/artikel', $data);
					$paper_size  = 'A4'; 
					$orientation = 'potrait'; 
					$html = $this->output->get_output();
					def("DOMPDF_ENABLE_REMOTE", false);
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("laporanartikel-".$filter2."-".$filter1.".pdf", array('Attachment'=>0));
				} else {
					$data['filter1']	        = ''; 
					$data['filter2']	        = ''; 
					$data['month']	        = ''; 
					$data['year']	        = ''; 
					$this->load->view('backend/content/majalah/pdf/artikel', $data);
					$paper_size  = 'A4'; 
					$orientation = 'potrait'; 
					$html = $this->output->get_output();
					def("DOMPDF_ENABLE_REMOTE", false);
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("laporanartikelsemua.pdf", array('Attachment'=>0));
				}
			} else {
				redirect("majalah/artikel");
			}
		} else {
			redirect("wp_login");
		}  
	}
}

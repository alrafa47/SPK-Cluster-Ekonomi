<?php 
	/**
	 * 
	 */
	class Mahasiswa extends CI_Controller
	{

		public $stat_rumah = array(
			"kos"=>"1",
			"sewa"=>"2",
			"hak milik sendiri"=>"3"
		);
		public $datalistrik = array(
			"450 W"=>"1",
			"900 W"=>"2",
			"1300 W"=>"3"
		);
		public $pekerjaan = array(
			"tidak bekerja" => "1",
			"buruh"=>"1",
			"petani"=>"1",
			"nelayan"=>"2",
			"pedagang"=>"2",
			"pns"=>"3",
			"polri/tni"=>"3"
		);

		
		function __construct()
		{
			parent ::__construct();
			$this->load->model('M_Mahasiswa');

		}

		public function index()
		{
			$data['stat_rumah'] = $this->stat_rumah;
			$data['pekerjaan'] = $this->pekerjaan;
			$data['datalistrik'] = $this->datalistrik;
			if (!empty($this->M_Mahasiswa->joinWithEkonomi())) {
				$data['mahasiswa'] = $this->M_Mahasiswa->joinWithEkonomi();
				$data['HasCount'] = 1;
			}else{
				$data['mahasiswa'] = $this->M_Mahasiswa->getAllData();
				$data['HasCount'] = 0;
			}
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('V_Mahasiswa', $data);
			$this->load->view('templates/footer');
		}

		public function validation_form(){
			$this->form_validation->set_rules("nim", "NIM", "required|is_unique[mahasiswa.nim]|max_length[12]");
			$this->form_validation->set_rules("nama", "Nama ", "required");
			$this->form_validation->set_rules("pekerjaan_ayah", "Pekerjaan Ayah ", "required");
			$this->form_validation->set_rules("pekerjaan_ibu", "Pekerjaan Ibu ", "required");
			$this->form_validation->set_rules("gaji_ayah", "Gaji Ayah", "required");
			$this->form_validation->set_rules("gaji_ibu", "Gaji Ibu", "required");
			$this->form_validation->set_rules("status_rumah", "Status Rumah", "required");
			$this->form_validation->set_rules("pbb", "PBB", "required");
			$this->form_validation->set_rules("dayalistrik", "Daya Listrik", "required");
			$this->form_validation->set_rules("reklistrik", "Rek Listrik", "required");

			// $this->form_validation->set_rules("status_ekonomi", "Status Ekonomi", "required");

			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}
			else
			{
				$this->M_Mahasiswa->tambah_data();
				$this->session->set_flashdata('flash', 'Disimpan');
				redirect('Mahasiswa');
			}	
		}

		public function hapus($nim)
		{
			$this->M_Mahasiswa->del($nim);
			$this->session->set_flashdata('flash', 'Dihapus');
			redirect('Mahasiswa');
		}

		public function ubah($nim)
		{
			// $this->form_validation->set_rules("nim", "NIM", "required|is_unique[mahasiswa.nim]|max_length[12]");
			$this->form_validation->set_rules("nama", "Nama ", "required");
			$this->form_validation->set_rules("pekerjaan_ayah", "Pekerjaan Ayah ", "required");
			$this->form_validation->set_rules("pekerjaan_ibu", "Pekerjaan Ibu ", "required");
			$this->form_validation->set_rules("gaji_ayah", "Gaji Ayah", "required");
			$this->form_validation->set_rules("gaji_ibu", "Gaji Ibu", "required");
			// $this->form_validation->set_rules("kesejahteraan", "Kesejahteraan ", "required");
			$this->form_validation->set_rules("status_rumah", "Status Rumah", "required");
			$this->form_validation->set_rules("pbb", "PBB", "required");
			$this->form_validation->set_rules("dayalistrik", "Daya Listrik", "required");
			$this->form_validation->set_rules("reklistrik", "Rek Listrik", "required");

			// $this->form_validation->set_rules("status_ekonomi", "Status Ekonomi", "required");

			if ($this->form_validation->run() == FALSE)
			{
				$data['stat_rumah'] = $this->stat_rumah;
				$data['pekerjaan'] = $this->pekerjaan;
				$data['datalistrik'] = $this->datalistrik;
				$data['ubah']= $this->M_Mahasiswa->detail_data($nim);
				$this->load->view('templates/header');
				$this->load->view('templates/sidebar');
				$this->load->view('V_UbahMahasiswa', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				$this->M_Mahasiswa->ubah_data();
				$this->session->set_flashdata('flash', 'DiUbah');
				redirect('Mahasiswa');
			}	
		}
	}
	?>
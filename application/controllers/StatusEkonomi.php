<?php 
/**
 * 
 */
class StatusEkonomi extends CI_Controller
{
	public function __construct()
	{
		parent ::__construct();
		$this->load->model('M_StatusEkonomi');
	}

	public function index(){
		$data['Status'] = $this->M_StatusEkonomi->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('V_StatusEkonomi', $data);
		$this->load->view('templates/footer');
	}

	public function addData(){
		$this->form_validation->set_rules('tingkat_status', 'tingkat status', 'required|is_unique[status_ekonomi.tingkat_status]|max_length[3]');
		$this->form_validation->set_rules('golonganEkonomi', 'Golongan Ekonomi', 'required|is_unique[status_ekonomi.nama_status]|min_length[5]|max_length[32]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->M_StatusEkonomi->addData();
			$this->session->set_flashdata('flash', 'Ditambah');
			redirect('StatusEkonomi');
		}
	}

	public function ubah($id){
		$data['ubah'] = $this->M_StatusEkonomi->getDataByid($id);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('V_UbahStatusEkonomi', $data);
		$this->load->view('templates/footer');	
	}

	public function deleteData($id)
	{
		$this->M_StatusEkonomi->deleteData($id);
		redirect('StatusEkonomi');
			$this->session->set_flashdata('flash', 'Dihapus');

	}



	public function getDataByid($id){
		$data = $this->M_StatusEkonomi->getDataByid($id);
	}

	public function updateData($id){
		$this->form_validation->set_rules('id_status', 'id status', 'min_length[2]|max_length[3]');
		$this->form_validation->set_rules('golonganEkonomi', 'Golongan ekonomi', 'required|is_unique[status_ekonomi.nama_status]|min_length[5]|max_length[32]');
		if ($this->form_validation->run() == FALSE) {
			$this->ubah($id);
		}else{
			$this->M_StatusEkonomi->updateData($id);
			redirect('StatusEkonomi');
		}
	}

}
?>
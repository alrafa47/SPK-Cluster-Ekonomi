<?php 
/**
 * 
 */

class Centroid extends CI_Controller
{
	
	public $tempArrayGruoping = array();
	public $newCentroid = array();
	public $ulang = 0;

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
		$this->load->model('M_Centroid');
		$this->load->model('M_DetailCentroid');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_StatusEkonomi');

	}

	function index(){
		$data['status'] = $this->M_StatusEkonomi->getAllData();
		$data['mahasiswa'] = $this->M_Mahasiswa->getAllData();
		$data['centroid'] = $this->M_Centroid->getAllData();
		$data['detailCentroid'] = $this->M_DetailCentroid->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('V_Centroid', $data);
		$this->load->view('templates/footer');
	}


	function checkData(){
		$jmlStatus = sizeof($this->M_StatusEkonomi->getAllData());
		$jmlCentroid = sizeof($this->M_Centroid->getAllData());
		return $status = ($jmlStatus == $jmlCentroid) ? true : false ;
	}

	function setCentroidOtomatis(){
		$hasil = array();
		$rank = array();
		$mahasiswa = $this->convertData($this->M_Mahasiswa->getAllData());
		$jmlStatus = sizeof($this->M_StatusEkonomi->getAllData());
		$valCentroid = array();
		
		foreach ($mahasiswa as $key => $value) {
			$hasil[$value->nim] = round(($mahasiswa[$key]->pekerjaan_ayah+$mahasiswa[$key]->pekerjaan_ibu+$mahasiswa[$key]->gaji_ayah+$mahasiswa[$key]->gaji_ibu+$mahasiswa[$key]->kesejahteraan+$mahasiswa[$key]->status_rumah+$mahasiswa[$key]->pbb+$mahasiswa[$key]->dayalistrik+$mahasiswa[$key]->reklistrik)/9, 1);
		}
		
		arsort($hasil);
		foreach ($hasil as $key => $value) {
			$rank[] = $key;
		}

		$first = reset($rank);
		$last = end($rank);

		foreach ($this->M_StatusEkonomi->getAllData() as $key => $value) {
			if ($key == 0) {
				$valCentroid[$value->id_status] = $last;
			}elseif ($key == ($jmlStatus-1)){
				$valCentroid[$value->id_status] = $first;
			}elseif($key == floor($jmlStatus/2)){
				$valCentroid[$value->id_status] = $rank[floor(sizeof($rank)/2)];
			}else{
				if ($key > floor($jmlStatus/2)) {
					$lop_a = 1;
					$valCentroid[$value->id_status] = $rank[floor(sizeof($rank)/2)-$lop_a];
					$lop_a++;
				}else{
					$lop_b = 1;
					$valCentroid[$value->id_status] = $rank[floor(sizeof($rank)/2)+$lop_b];
					$lop_b++;

				}
			}
		}

		print_r($valCentroid);
		$this->M_Centroid->autoAddData($valCentroid);
		$this->session->set_flashdata('flash', 'Diset');
		redirect('Perhitungan');
	}

	function convertData($data){
		foreach ($data as $value) {
			$value->gaji_ayah = intval($value->gaji_ayah); 
			$value->gaji_ibu = intval($value->gaji_ibu);
			$value->kesejahteraan = intval($value->kesejahteraan); 
			$value->pbb = intval($value->pbb);
			$value->reklistrik = intval($value->reklistrik);
			$value->pekerjaan_ayah = intval($this->pekerjaan[$value->pekerjaan_ayah]);
			$value->pekerjaan_ibu = intval($this->pekerjaan[$value->pekerjaan_ibu]);
			$value->status_rumah = intval($this->stat_rumah[$value->status_rumah]);
			$value->dayalistrik = intval($this->datalistrik[$value->dayalistrik]);
		}
		return $data;
	}

	function convertDataArray($data){
		foreach ($data as &$value) {
			$value['gaji_ayah'] = intval($value['gaji_ayah']); 
			$value['gaji_ibu'] = intval($value['gaji_ibu']);
			$value['kesejahteraan'] = intval($value['kesejahteraan']); 
			$value['pbb'] = intval($value['pbb']);
			$value['reklistrik'] = intval($value['reklistrik']);
			$value['pekerjaan_ayah'] = intval($this->pekerjaan[$value['pekerjaan_ayah']]);
			$value['pekerjaan_ibu'] = intval($this->pekerjaan[$value['pekerjaan_ibu']]);
			$value['status_rumah'] = intval($this->stat_rumah[$value['status_rumah']]);
			$value['dayalistrik'] = intval($this->datalistrik[$value['dayalistrik']]);
		}
		unset($value);
		return $data;
	}

	function setCentroid(){
		/////////////////////////////////////////////////////////////////////////////
		$id_status = $this->has_dupes($this->input->post('id_status'));
		$golonganEkonomi = $this->has_dupes($this->input->post('golonganEkonomi'));
		$id_centroid = $this->has_dupes($this->input->post('id_centroid'));
		if (!$id_status and !$golonganEkonomi and !$id_centroid) {
			$this->M_Centroid->addData($this->input->post('id_centroid'), $this->input->post('id_status'), $this->input->post('golonganEkonomi'));
			$this->Counting();

		}else{
			echo "terdapat dubplikasi ";
			redirect('Perhitungan');
		}

	}


	function has_dupes($array) {
		return count($array) !== count(array_unique($array)); 
	}

}

?>
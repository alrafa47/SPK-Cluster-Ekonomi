<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_Controller
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

	public function __construct(){
		parent::__construct();
		$this->load->model('M_Centroid');
		$this->load->model('M_DetailCentroid');
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_StatusEkonomi');
	}
	
	public function index(){
		$data['sumMahasiswa'] = sizeof($this->M_Mahasiswa->getAllData());
		$data['sumStatus'] = sizeof($this->M_StatusEkonomi->getAllData());
		$data['chart'] = $this->Chart();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}

	function Chart(){
		$dataMahasiswa = $this->convertData($this->M_Mahasiswa->joinWithEkonomi());
		$dataFinal = $this->convertDataFinal($this->M_Centroid->getFinalCentroid());
		$status_ekonomi = $this->M_StatusEkonomi->getAllData();
		$data_chart = array();
		foreach ($status_ekonomi as $value) {
			$myObj = new stdClass();
			$myObj->type = 'scatter';
			$myObj->markerSize = 10;
			$myObj->markerType="circle";
			$myObj->color = $value->warna;
			$myObj->name = $value->nama_status;
			$myObj->showInLegend = true;
			$myObj->toolTipContent = "<span style='color:".$value->warna."'>{name}</span><br> Skor : {x}<br>Mahasiswa : {z}";
			$arr = array();
			foreach ($dataMahasiswa as $v) {
				if ($value->id_status == $v['status_ekonomi']){
					$arr[]= array('x'=>$v['total'], 'y'=>1, 'z'=>$v['nama']);
				}
			}
			$myObj->dataPoints = $arr;
			$data_chart[] = $myObj; 
		}


		foreach ($dataFinal as $value) {
			$myObj = new stdClass();
			$myObj->type = 'scatter';
			$myObj->markerSize = 15;
			$myObj->markerType="cross";
			$myObj->color = $value ['warna'];
			$myObj->name = $value ['id_centroid'];
			$myObj->showInLegend = true;
			$myObj->toolTipContent = "<span style='color:".$value['warna']."'>{name}</span><br> Skor : {x}";
			$myObj->dataPoints[] = array('x'=>$value['total'], 'y'=>1);;
			$data_chart[] = $myObj; 
		}
		return $myJSON = json_encode($data_chart);
	}

	function convertData($data){
		$arr = array();
		foreach ($data as $value) {
			$val = 0;
			$value->gaji_ayah = intval($value->gaji_ayah); 
			$value->gaji_ibu = intval($value->gaji_ibu);
			$value->kesejahteraan = intval($value->kesejahteraan); 
			$value->pbb = intval($value->pbb);
			$value->reklistrik = intval($value->reklistrik);
			$value->pekerjaan_ayah = intval($this->pekerjaan[$value->pekerjaan_ayah]);
			$value->pekerjaan_ibu = intval($this->pekerjaan[$value->pekerjaan_ibu]);
			$value->status_rumah = intval($this->stat_rumah[$value->status_rumah]);
			$value->dayalistrik = intval($this->datalistrik[$value->dayalistrik]);
			$val = $value->gaji_ayah+$value->gaji_ibu+$value->kesejahteraan+$value->pbb+$value->reklistrik+$value->pekerjaan_ayah+$value->pekerjaan_ibu+$value->status_rumah+$value->dayalistrik;
			$arr[]= array('nim' => $value->nim, 'nama' => $value->nama,'total'=>$val, 'status_ekonomi' => $value->status_ekonomi, 'warna'=>$value->warna);
		}
		return $arr;
	}

	function convertDataFinal($data){
		$arr = array();
		foreach ($data as $value) {
			$val = 0;
			$val = $value->gaji_ayah+$value->gaji_ibu+$value->kesejahteraan+$value->pbb+$value->reklistrik+$value->pekerjaan_ayah+$value->pekerjaan_ibu+$value->status_rumah+$value->dayalistrik;
			$arr[]= array('id_centroid' => $value->id_centroid,'total'=>$val, 'warna'=>$value->warna);
		}
		return $arr;
	}

}
?>
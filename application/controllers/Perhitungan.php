<?php 
ob_start();
class Perhitungan extends CI_Controller
{
	public $tempArrayGruoping = array();
	public $newCentroid = array();
	public $ulang = 0;
	public $hasil_perhitungan="";

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
		if (!empty($this->M_Mahasiswa->joinWithEkonomi())) {
			$data['mahasiswa'] = $this->M_Mahasiswa->joinWithEkonomi();
			$data['HasCount'] = 1;
		}else{
			$data['mahasiswa'] = $this->M_Mahasiswa->getAllData();
			$data['HasCount'] = 0;
		}
		$data['centroid'] = $this->M_Centroid->joinWithEkonomi_Mahasiswa();
		$data['detailCentroid'] = $this->M_DetailCentroid->getAllData();
		$data['checkCentroid'] = $this->checkData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('V_Perhitungan', $data);
		$this->load->view('templates/footer');
	}

	public function emptyData()
	{
		$this->M_Centroid->emptyDataCentroid();
		$this->session->set_flashdata('flash', "Di Unset");
		redirect('Perhitungan');
	}

	function checkData(){
		$jmlStatus = sizeof($this->M_StatusEkonomi->getAllData());
		$jmlCentroid = sizeof($this->M_Centroid->getAllData());
		return $status = ($jmlStatus == $jmlCentroid) ? true : false ;
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
			// $this->Counting();
		}else{
			echo "terdapat dubplikasi ";
			redirect('Perhitungan');
		}

	}
	function has_dupes($array) {
		return count($array) !== count(array_unique($array)); 
	}

	function Counting ($centroid = array(), $output = ""){
		$iterasi = array();
		$mahasiswa = $this->convertData($this->M_Mahasiswa->getAllData());
		if (empty($centroid)) {
			$centroid =  $this->convertDataArray($this->M_Centroid->getDataWithJoin());
			$output .= "<table class='table table-sm table-bordered'>";
			$output .= "<tr><th colspan='10'>CENTROID AWAL</th></tr>";
			$output .= "<tr>
			<th>id_centroid</th>
			<th>pekerjaan_ayah</th>
			<th>pekerjaan_ibu</th>
			<th>gaji_ayah</th>
			<th>gaji_ibu</th>
			<th>kesejahteraan</th>
			<th>status_rumah</th>
			<th>pbb</th>
			<th>dayalistrik</th>
			<th>reklistrik</th>
			</tr>";
			foreach ($centroid as $key) {
				$output .= "<tr>";
				$output .= "<td>".$key['id_centroid']."</td>";
				$output .= "<td>".$key['pekerjaan_ayah']."</td>";
				$output .= "<td>".$key['pekerjaan_ibu']."</td>";
				$output .= "<td>".$key['gaji_ayah']."</td>";
				$output .= "<td>".$key['gaji_ibu']."</td>";
				$output .= "<td>".$key['kesejahteraan']."</td>";
				$output .= "<td>".$key['status_rumah']."</td>";
				$output .= "<td>".$key['pbb']."</td>";
				$output .= "<td>".$key['dayalistrik']."</td>";
				$output .= "<td>".$key['reklistrik']."</td>";
				$output .= "</tr>";
			}
			$output .= "</table>";
			$output .="<br>";

			$output .="<br>";
		}
		foreach ($mahasiswa as $mhs) {
			// [d1][d2]
			$d1 = $mhs->nim;
			foreach ($centroid as $ctr) {
				$hasil = SQRT(pow($mhs->pekerjaan_ayah-$ctr['pekerjaan_ayah'] ,2)+pow($mhs->pekerjaan_ibu-$ctr['pekerjaan_ibu'] ,2)+pow($mhs->gaji_ayah-$ctr['gaji_ayah'] ,2)+pow($mhs->gaji_ibu-$ctr['gaji_ibu'] ,2)+pow($mhs->kesejahteraan-$ctr['kesejahteraan'] ,2)+pow($mhs->status_rumah-$ctr['status_rumah'] ,2)+pow($mhs->pbb-$ctr['pbb'] ,2)+pow($mhs->dayalistrik-$ctr['dayalistrik'] ,2)+pow($mhs->reklistrik-$ctr['reklistrik'] ,2));
				// masukan hasil
				$iterasi[$d1][$ctr['id_centroid']]=round($hasil, 1) ;
			}
		}
		$output .= "<table class='table table-sm table-bordered'>";
		$output .= "<tr><th colspan='".(1+sizeof($centroid))."'>HASIL RUMUS ECLUDIAN Ke-".$this->ulang."</th></tr>";
		$output .= "<tr>";
		$output .= "<th>NIM</th>";
		foreach ($centroid as $value) {
			$output .= "<th>".$value['id_centroid']."</th>";
		}
		$output .= "</tr>";
		foreach ($mahasiswa as $mhs) {
			// [d1][d2]
			$d1 = $mhs->nim;
			$output .= "<tr>";
			$output .= "<td>$d1</td>";
			foreach ($centroid as $ctr) {
				$output .= "<td>".$iterasi[$d1][$ctr['id_centroid']]."</td>";
			}
			$output .= "</tr>";
		}
		$output .= "</table>";
		$output .="<br>";

		////////////////////////////////////////////////////////////////////////////////
		$newGrouping = array();
		foreach ($mahasiswa as $mhs) {
			// [d1][d2]
			$d1 = $mhs->nim;
			$temp_hasil = array();
			foreach ($centroid as $ctr) {
				$temp_hasil[$ctr['id_centroid']] = $iterasi[$d1][$ctr['id_centroid']];
			}
			$newGrouping[$d1] = array_search(min($temp_hasil),$temp_hasil); 
		}
		
		$output .= "<div class='table-responsive'>";
		$output .= "<table class='table table-sm table-bordered'>";
		$output .= "<tr><th colspan='".(sizeof($mahasiswa)+1)."'>GROUPING Ke-".$this->ulang."</th></tr>";
		$output .= "<tr>";
		$output .= "<th>Grup Lama</th>";
		if (empty($this->tempArrayGruoping)) {
			$output .= "<td colspan='".(sizeof($mahasiswa)+1)."'>Masih Kosong</td>";
		}
		foreach ($this->tempArrayGruoping as $key => $value) {
			$output .= "<td>$key Cluster : $value</td>";
		}
		$output .= "</tr>";
		$output .= "<tr>";
		$output .= "<th>Grup Baru</th>";
		foreach ($newGrouping as $key => $value) {
			$output .= "<td>$key Cluster : $value</td>";
		}
		$output .= "</tr>";
		$output .= "</table>";
		$output .= "</div>";
		$output .="<br>";


		// $output .= "<table class='table table-sm table-bordered'>";
		// $output .= "<tr>";
		// $output .= "<th>Grup Baru</th>";
		// foreach ($newGrouping as $key => $value) {
		// 	$output .= "<td>$key Cluster : $value</td>";
		// }
		// $output .= "</tr>";
		// $output .= "</table>";
		// 	$output .="<br>";

		$output .= "<b>CHECK KESAMAAN GRUP Ke-".$this->ulang."</b><br>";
		// perulangan check apakah perlu diulang lagi
		if (empty(array_diff_assoc($newGrouping, $this->tempArrayGruoping))) {
			$output .= '
			<div class="alert alert-success" role="alert">
			<b>
			Hasil : Sama
			</b>
			</div>
			';
			$output .= "<br><b>FINISH</b><br>";
			$output .= "<b>jumlah iterasi : $this->ulang Kali</b><br>";
			$output .= "<table class='table table-sm table-bordered'>";
			$output .= "<tr><th colspan='".(sizeof($this->M_Centroid->getAllData())+1)."'>NILAI AKHIR CENTROID</th></tr>";
			$output .= "<tr>";
			$output .= "<th>NIM</th>";
			foreach ($this->M_Centroid->getAllData() as $value) {
				$output .= "<th>".$value->id_centroid."</th>";
			}
			$output .= "</tr>";
			$this->M_DetailCentroid->emptyTable();
			foreach ($mahasiswa as $mhs) {
			// [d1][d2]
				$d1 = $mhs->nim;
				$output .= "<tr>";
				$output .= "<td>";
				$output .= $d1;
				$output .= "</td>";
				foreach ($centroid as $ctr) {
					$this->M_DetailCentroid->addData($d1, $ctr['id_centroid'], $iterasi[$d1][$ctr['id_centroid']]);
					$output .= "<td>";
					$output .= $iterasi[$d1][$ctr['id_centroid']];
					$output .= "</td>";
				}
				$output .= "</tr>";
			}
			$output .= "</table>";
			$output .="<br>";

			$output .= "<table class='table table-sm table-bordered'>";
			$output .= "<tr><th colspan='10'>CENTROID</th></tr>";
			$output .= "<tr>
			<th>id_centroid</th>
			<th>pekerjaan_ayah</th>
			<th>pekerjaan_ibu</th>
			<th>gaji_ayah</th>
			<th>gaji_ibu</th>
			<th>kesejahteraan</th>
			<th>status_rumah</th>
			<th>pbb</th>
			<th>dayalistrik</th>
			<th>reklistrik</th>
			</tr>";
			foreach ($this->newCentroid as $key) {
				$output .= "<tr>";
				$output .= "<td>".$key['id_centroid']."</td>";
				$output .= "<td>".$key['pekerjaan_ayah']."</td>";
				$output .= "<td>".$key['pekerjaan_ibu']."</td>";
				$output .= "<td>".$key['gaji_ayah']."</td>";
				$output .= "<td>".$key['gaji_ibu']."</td>";
				$output .= "<td>".$key['kesejahteraan']."</td>";
				$output .= "<td>".$key['status_rumah']."</td>";
				$output .= "<td>".$key['pbb']."</td>";
				$output .= "<td>".$key['dayalistrik']."</td>";
				$output .= "<td>".$key['reklistrik']."</td>";
				$output .= "</tr>";
			}
			$output .= "</table>";
			$output .="<br>";

			foreach ($this->tempArrayGruoping as &$ganti) {
				foreach ($this->M_Centroid->getAllData() as $value) {
					if ($ganti == $value->id_centroid) {
						$ganti = $value->id_status;					
					}
				}
			}
			unset($ganti);
			$output .= "<div class='table-responsive'>";
			$output .= "<table class='table table-sm table-bordered'>";
			$output .= "<tr><th colspan='".(sizeof($mahasiswa)+1)."'>CONVERT GROUPING </th></tr>";

			$output .= "<tr>";
			foreach ($this->tempArrayGruoping as $key => $value) {
				$output .= "<td>NIM : $key Id Status : $value</td>";
			}
			$output .= "</tr>";
			$output .= "</table>";
			$output .="</div>";
			$output .="<br>";

			$this->M_DetailCentroid->setStatus($this->tempArrayGruoping);
			$this->M_Centroid->setFinalCentroid($this->newCentroid);
			if ($this->input->post('view')=='check') {
				$this->session->set_flashdata('perhitungan', $output);
			}
			$this->session->set_flashdata('flash', "Di hitung");
			redirect('Perhitungan');
		}else{
			$output .= '
			<div class="alert alert-danger" role="alert">
			<b>
			Hasil : Beda
			</b>
			</div>
			';
			$this->tempArrayGruoping = $newGrouping;
			// kosongkan kembali centroid
			$this->newCentroid=array();

			foreach ($centroid as $ctr) {
				$no = 0;
				$pekerjaan_ayah= 0;
				$pekerjaan_ibu= 0;
				$gaji_ayah= 0;
				$gaji_ibu= 0;
				$kesejahteraan= 0;
				$status_rumah= 0;
				$pbb= 0;
				$dayalistrik= 0;
				$reklistrik= 0;
				// $id_centroid = '';
				foreach ($newGrouping as $key => $value) {
					if ($value == $ctr['id_centroid']) {
						$id_centroid=$ctr['id_centroid'];
						// $val = $this->convertDataArray($this->M_Mahasiswa->getDataBynim($key));
						$val = $this->M_Mahasiswa->getDataBynim($key);
						$pekerjaan_ayah += intval($this->pekerjaan[$val['pekerjaan_ayah']]);
						$pekerjaan_ibu+= intval($this->pekerjaan[$val['pekerjaan_ibu']]);
						$gaji_ayah+= intval($val['gaji_ayah']);
						$gaji_ibu+= intval($val['gaji_ibu']);
						$kesejahteraan+= intval($val['kesejahteraan']);
						$status_rumah+= intval($this->stat_rumah[$val['status_rumah']]);
						$pbb+= intval($val['pbb']);
						$dayalistrik+= intval($this->datalistrik[$val['dayalistrik']]);
						$reklistrik+= intval($val['reklistrik']);
						$no+=1;
					}
				}
				$a = array(
					'id_centroid'		=>$ctr['id_centroid'],
					'pekerjaan_ayah'	=>round($pekerjaan_ayah/$no, 1),
					'pekerjaan_ibu'		=>round($pekerjaan_ibu/$no, 1),
					'gaji_ayah'			=>round($gaji_ayah/$no, 1),
					'gaji_ibu'			=>round($gaji_ibu/$no, 1),
					'kesejahteraan'		=>round($kesejahteraan/$no, 1),
					'status_rumah'		=>round($status_rumah/$no, 1),
					'pbb'				=>round($pbb/$no, 1),
					'dayalistrik'		=>round($dayalistrik/$no, 1),
					'reklistrik'		=>round($reklistrik/$no, 1)			
				);
				$this->newCentroid[]= $a;
			}
			// print_r($this->newCentroid);
			$output .= "<table class='table table-sm table-bordered'>";
			$output .= "<tr><th colspan='10'>SET CENTROID BARU</th></tr>";
			$output .= "<tr>
			<th>id_centroid</th>
			<th>pekerjaan_ayah</th>
			<th>pekerjaan_ibu</th>
			<th>gaji_ayah</th>
			<th>gaji_ibu</th>
			<th>kesejahteraan</th>
			<th>status_rumah</th>
			<th>pbb</th>
			<th>dayalistrik</th>
			<th>reklistrik</th>
			</tr>";
			foreach ($this->newCentroid as $key) {
				$output .= "<tr>";
				$output .= "<td>".$key['id_centroid']."</td>";
				$output .= "<td>".$key['pekerjaan_ayah']."</td>";
				$output .= "<td>".$key['pekerjaan_ibu']."</td>";
				$output .= "<td>".$key['gaji_ayah']."</td>";
				$output .= "<td>".$key['gaji_ibu']."</td>";
				$output .= "<td>".$key['kesejahteraan']."</td>";
				$output .= "<td>".$key['status_rumah']."</td>";
				$output .= "<td>".$key['pbb']."</td>";
				$output .= "<td>".$key['dayalistrik']."</td>";
				$output .= "<td>".$key['reklistrik']."</td>";
				$output .= "</tr>";
			}
			$output .= "</table>";
			$output .="<br>";

		//////////////////////////////////////////////////////////////////////////////////
			$this->ulang++;
			$this->Counting($this->newCentroid, $output);
		}
	}



}
ob_flush();
?>
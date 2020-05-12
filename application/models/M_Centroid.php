<?php 
	/**
	 * 
	 */
	class M_Centroid extends CI_Model
	{
		public $arrFinalCentroid;
		public function getAllData(){
			return $this->db->get('centroid')->result();
		}

		public function getDataWithJoin(){
			$this->db->select('*, 
				mahasiswa.pekerjaan_ayah, mahasiswa.pekerjaan_ibu, 
				mahasiswa.gaji_ayah, mahasiswa.gaji_ibu, 
				mahasiswa.kesejahteraan, mahasiswa.status_rumah, 
				mahasiswa.pbb, mahasiswa.dayalistrik, 
				mahasiswa.reklistrik
				');
			$this->db->from('centroid');
			$this->db->join('mahasiswa', 'centroid.nim = mahasiswa.nim');
			// $this->db->order_by('centroid.id_status', 'ASC');
			$this->db->order_by('centroid.id_centroid', 'ASC');
			return $this->db->get()->result_array();
		}

		public function addData($id_centroid, $id_status, $golonganEkonomi)
		{
			for ($i=0; $i <=sizeof($id_status)-1 ; $i++) { 
				$data = array(
					'id_centroid' => $id_centroid[$i],
					'id_status' => $id_status[$i], 
					'nim'=>$golonganEkonomi[$i]
				);
				$this->db->insert('centroid', $data);
			}
		}

		public function autoAddData($data)
		{
			$no = 1;
			foreach ($data as $key => $value) {
				$data = array(
					'id_centroid' => 'C'.$no,
					'id_status' => $key, 
					'nim'=>$value
				);
				$this->db->insert('centroid', $data);
				$no++;
			}
		}

		public function joinWithEkonomi()
		{
			$this->db->select('*');
			$this->db->from('centroid');
			$this->db->join('status_ekonomi', 'status_ekonomi.id_status = centroid.id_status');
			return $this->db->get()->result();
		}
		public function joinWithEkonomi_Mahasiswa()
		{
			$this->db->select('*');
			$this->db->from('centroid');
			$this->db->join('status_ekonomi', 'status_ekonomi.id_status = centroid.id_status');
			$this->db->join('mahasiswa', 'mahasiswa.nim = centroid.nim');
			return $this->db->get()->result();
		}

		public function updateData(){

		}

		public function deleteData(){
			
		}

		public function emptyDataCentroid(){
			$this->db->empty_table('detail_centroid');
			$this->emptyDataFinalCentroid();
			$this->db->empty_table('centroid');
		}

		public function emptyDataFinalCentroid(){
			$this->db->empty_table('final_centroid');
		}

		public function setFinalCentroid($newCentroid)
		{
			$this->emptyDataFinalCentroid();
			foreach ($newCentroid as $key => $value) {
				$data =  array(
					'id_centroid'=>$value['id_centroid'],
					'pekerjaan_ayah'=>$value['pekerjaan_ayah'],
					'pekerjaan_ibu'=>$value['pekerjaan_ibu'],
					'gaji_ayah'=>$value['gaji_ayah'],
					'gaji_ibu'=>$value['gaji_ibu'],
					'kesejahteraan'=>$value['kesejahteraan'],
					'status_rumah'=>$value['status_rumah'],
					'pbb'=>$value['pbb'],
					'dayalistrik'=>$value['dayalistrik'],
					'reklistrik' =>$value['reklistrik']
					
				);
				$this->db->insert('final_centroid', $data);
			} 
		}

		public function getFinalCentroid()
		{
			$this->db->select('*');
			$this->db->from('final_centroid');
			$this->db->join('centroid', 'final_centroid.id_centroid = centroid.id_centroid');
			$this->db->join('status_ekonomi', 'status_ekonomi.id_status= centroid.id_status');
			return $this->db->get()->result();
		}
	}

	?>
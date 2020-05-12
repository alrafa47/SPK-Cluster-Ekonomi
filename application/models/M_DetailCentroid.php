<?php 
	/**
	 * 
	 */
	class M_DetailCentroid extends CI_Model
	{
		public function getAllData(){

		}
		public function emptyTable()
		{
			$this->db->empty_table('detail_centroid');
		}
		public function addData($nim, $id_status, $hasil)
		{
			$data = array(
				'nim' => $nim,
				'id_centroid' => $id_status,
				'nilai' => round($hasil, 1)
			);
			$this->db->insert('detail_centroid', $data);
		}

		public function updateData(){

		}

		public function deleteData(){
			
		}

		public function setStatus($data){
			foreach ($data as $key => $value) {
				$this->db->set('status_ekonomi', $value);
				$this->db->where('nim', $key);
				$this->db->update('mahasiswa');
			}
		}
	}
	?>
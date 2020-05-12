<?php 
	/**
	 * 
	 */
	class M_Mahasiswa extends CI_Model
	{
		public function getAllData(){
			return $this->db->get('mahasiswa')->result();
		}

		public function tambah_data(){
			$kesejahteraan = ($this->input->post('gaji_ayah', true) + $this->input->post('gaji_ibu', true) ) - ($this->input->post('pbb', true) + $this->input->post('reklistrik', true));
			$data = array(
				'nim' => $this->input->post('nim', true),
				'nama' => $this->input->post('nama', true),
				'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', true),
				'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', true),
				'gaji_ayah' => $this->input->post('gaji_ayah', true),
				'gaji_ibu' => $this->input->post('gaji_ibu', true),
				'kesejahteraan' => $kesejahteraan ,
				'status_rumah' => $this->input->post('status_rumah', true),
				'pbb' => $this->input->post('pbb', true),
				'dayalistrik' => $this->input->post('dayalistrik', true),
				'reklistrik' => $this->input->post('reklistrik', true)
				// 'status_ekonomi' => $this->input->post('status_ekonomi', true)
			);

			$this->db->insert('mahasiswa', $data);
		} 

		public function ubah_data(){
			$data = array(
				'nim' => $this->input->post('nim', true),
				'nama' => $this->input->post('nama', true),
				'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', true),
				'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', true),
				'gaji_ayah' => $this->input->post('gaji_ayah', true),
				'gaji_ibu' => $this->input->post('gaji_ibu', true),
				'kesejahteraan' => $this->input->post('kesejahteraan', true),
				'status_rumah' => $this->input->post('status_rumah', true),
				'pbb' => $this->input->post('pbb', true),
				'dayalistrik' => $this->input->post('dayalistrik', true),
				'reklistrik' => $this->input->post('reklistrik', true)
				// 'status_ekonomi' => $this->input->post('status_ekonomi', true)
			);
			$this->db->where('nim', $this->input->post('nim', true));
			$this->db->update('mahasiswa', $data);
		}

		function del($nim){
			$this->db->where('nim',$nim);
			$this->db->delete('mahasiswa');
		}

		function getDataBynim($nim){

			$this->db->select('*');
			$this->db->where('nim', $nim);
			return $this->db->get('mahasiswa')->row_array();

		}

		function detail_data($nim){
			return $this->db->get_where('mahasiswa', ['nim'=> $nim])->row_array();
		}

		public function joinWithEkonomi()
		{
			$this->db->select('*');
			$this->db->from('mahasiswa');
			$this->db->join('status_ekonomi', 'mahasiswa.status_ekonomi = status_ekonomi.id_status');
			return $this->db->get()->result();
		}
	}

	?>
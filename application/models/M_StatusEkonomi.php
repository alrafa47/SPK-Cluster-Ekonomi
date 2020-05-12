<?php 
	/**
	 * 
	 */
	class M_StatusEkonomi extends CI_Model
	{
		public function getAllData(){
			$this->db->order_by('tingkat_status', 'ASC');
			return $this->db->get('status_ekonomi')->result();
		}

		public function addData()
		{
			$data = array(
				'tingkat_status' => $this->input->post('tingkat_status'),
				'nama_status' => $this->input->post('golonganEkonomi')
			);

			$this->db->insert('status_ekonomi', $data);
		}

		function getDataByid($id){
			$this->db->where('id_status', $id);
			return $this->db->get('status_ekonomi')->row();

		}

		public function updateData(){
			$data = array(
				'nama_status' => $this->input->post('golonganEkonomi'),
				'tingkat_status' => $this->input->post('tingkat_status')
			);

			$this->db->where('id_status', $this->input->post('id_status'));
			$this->db->update('status_ekonomi', $data);
		}

		public function deleteData($id){
			// $this->db->where('id_status', $this->encrypt->decode($id));
			$this->db->where('id_status',$id);
			$this->db->delete('status_ekonomi');
		}
	}

	?>
<?php 
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mahasiswa');

		$this->methods['index_get']['limit'] = 20;
	}

	// fungsi GET untuk mengambil data dari database
	public function index_get() {
		$id = $this->get('id');
		if($id === null) {
			$mahasiswa = $this->mahasiswa->getMahasiswa();
		} else {
			$mahasiswa = $this->mahasiswa->getMahasiswa($id);
		}
		
		if($mahasiswa) {
			$this->response([
				'status' => true,
				'data' => $mahasiswa
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Id not found BGST!'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	// fungsi DELETE untuk menghapus data dari database
	public function index_delete() {
		$id = $this->delete('id');

		if($id === null) {
			$this->response([
				'status' => false,
				'message' => 'Provide an id BGST!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if($this->mahasiswa->deleteMahasiswa($id) > 0) {
				// OK
				$this->response([
					'status' => true,
					'id' => $id,
					'message' => 'Data is Deleted!'
				], REST_Controller::HTTP_NO_CONTENT);
			} else {
				// Id not found
				$this->response([
					'status' => false,
					'message' => 'Id not found BGST!'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	// fungsi POST untuk menambah data dari database
	public function index_post() {
		$data = [
			'nrp' => $this->post('nrp'),
			'nama' => $this->post('nama'),
			'email' => $this->post('email'),
			'jurusan' => $this->post('jurusan')
		];

		if($this->mahasiswa->createMahasiswa($data) > 0) {
			$this->response([
					'status' => true,
					'message' => 'New Mahasiswa has been added'
				], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
					'status' => false,
					'message' => 'Failed to created new data, Nyinx!'
				], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	// fungsi PUT untuk mengubah data dari database
	public function index_put() {
		$id = $this->put('id');
		$data = [
			'nrp' => $this->put('nrp'),
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'jurusan' => $this->put('jurusan')
		];

		if($this->mahasiswa->updateMahasiswa($data, $id) > 0) {
			$this->response([
					'status' => true,
					'message' => 'New Mahasiswa has been modified'
				], REST_Controller::HTTP_OK);
		} else {
			$this->response([
					'status' => false,
					'message' => 'Failed to update data, Nyinx!'
				], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
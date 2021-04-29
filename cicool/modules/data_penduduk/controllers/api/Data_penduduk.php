<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_penduduk extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_penduduk');
	}

	/**
	 * @api {get} /data_penduduk/all Get all data_penduduks.
	 * @apiVersion 0.1.0
	 * @apiName AllDatapenduduk 
	 * @apiGroup data_penduduk
	 * @apiHeader {String} X-Api-Key Data penduduks unique access-key.
	 * @apiHeader {String} X-Token Data penduduks unique token.
	 * @apiPermission Data penduduk Cant be Accessed permission name : api_data_penduduk_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data penduduks.
	 * @apiParam {String} [Field="All Field"] Optional field of Data penduduks : nik, no_kk, nama_penduduk, jenis_kelamin, alamat_penduduk.
	 * @apiParam {String} [Start=0] Optional start index of Data penduduks.
	 * @apiParam {String} [Limit=10] Optional limit data of Data penduduks.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_penduduk.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData penduduk Data penduduk data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_penduduk_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['nik', 'no_kk', 'nama_penduduk', 'jenis_kelamin', 'alamat_penduduk'];
		$data_penduduks = $this->model_api_data_penduduk->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_penduduk->count_all($filter, $field);
		$data_penduduks = array_map(function($row){
						
			return $row;
		}, $data_penduduks);

		$data['data_penduduk'] = $data_penduduks;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data penduduk',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /data_penduduk/detail Detail Data penduduk.
	 * @apiVersion 0.1.0
	 * @apiName DetailData penduduk
	 * @apiGroup data_penduduk
	 * @apiHeader {String} X-Api-Key Data penduduks unique access-key.
	 * @apiHeader {String} X-Token Data penduduks unique token.
	 * @apiPermission Data penduduk Cant be Accessed permission name : api_data_penduduk_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data penduduks.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_penduduk.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data pendudukNotFound Data penduduk data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_penduduk_detail');

		$this->requiredInput(['nik']);

		$id = $this->get('nik');

		$select_field = ['nik', 'no_kk', 'nama_penduduk', 'jenis_kelamin', 'alamat_penduduk'];
		$data_penduduk = $this->model_api_data_penduduk->find($id, $select_field);

		if (!$data_penduduk) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['data_penduduk'] = $data_penduduk;
		if ($data['data_penduduk']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data penduduk',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data penduduk not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_penduduk/add Add Data penduduk.
	 * @apiVersion 0.1.0
	 * @apiName AddData penduduk
	 * @apiGroup data_penduduk
	 * @apiHeader {String} X-Api-Key Data penduduks unique access-key.
	 * @apiHeader {String} X-Token Data penduduks unique token.
	 * @apiPermission Data penduduk Cant be Accessed permission name : api_data_penduduk_add
	 *
 	 * @apiParam {String} No_kk Mandatory no_kk of Data penduduks. Input No Kk Max Length : 11. 
	 * @apiParam {String} Nama_penduduk Mandatory nama_penduduk of Data penduduks. Input Nama Penduduk Max Length : 255. 
	 * @apiParam {String} Jenis_kelamin Mandatory jenis_kelamin of Data penduduks. Input Jenis Kelamin Max Length : 255. 
	 * @apiParam {String} Alamat_penduduk Mandatory alamat_penduduk of Data penduduks.  
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_data_penduduk_add');

		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_penduduk', 'Nama Penduduk', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat_penduduk', 'Alamat Penduduk', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'nama_penduduk' => $this->input->post('nama_penduduk'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat_penduduk' => $this->input->post('alamat_penduduk'),
			];
			
			$save_data_penduduk = $this->model_api_data_penduduk->store($save_data);

			if ($save_data_penduduk) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Validation Errors.',
				'errors' 	=> $this->form_validation->error_array()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /data_penduduk/update Update Data penduduk.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData penduduk
	 * @apiGroup data_penduduk
	 * @apiHeader {String} X-Api-Key Data penduduks unique access-key.
	 * @apiHeader {String} X-Token Data penduduks unique token.
	 * @apiPermission Data penduduk Cant be Accessed permission name : api_data_penduduk_update
	 *
	 * @apiParam {String} No_kk Mandatory no_kk of Data penduduks. Input No Kk Max Length : 11. 
	 * @apiParam {String} Nama_penduduk Mandatory nama_penduduk of Data penduduks. Input Nama Penduduk Max Length : 255. 
	 * @apiParam {String} Jenis_kelamin Mandatory jenis_kelamin of Data penduduks. Input Jenis Kelamin Max Length : 255. 
	 * @apiParam {String} Alamat_penduduk Mandatory alamat_penduduk of Data penduduks.  
	 * @apiParam {Integer} nik Mandatory nik of Data Penduduk.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_data_penduduk_update');

		
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_penduduk', 'Nama Penduduk', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat_penduduk', 'Alamat Penduduk', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'nama_penduduk' => $this->input->post('nama_penduduk'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat_penduduk' => $this->input->post('alamat_penduduk'),
			];
			
			$save_data_penduduk = $this->model_api_data_penduduk->change($this->post('nik'), $save_data);

			if ($save_data_penduduk) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Validation Errors.',
				'errors' 	=> $this->form_validation->error_array()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /data_penduduk/delete Delete Data penduduk. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData penduduk
	 * @apiGroup data_penduduk
	 * @apiHeader {String} X-Api-Key Data penduduks unique access-key.
	 * @apiHeader {String} X-Token Data penduduks unique token.
	 	 * @apiPermission Data penduduk Cant be Accessed permission name : api_data_penduduk_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data penduduks .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_data_penduduk_delete');

		$data_penduduk = $this->model_api_data_penduduk->find($this->post('nik'));

		if (!$data_penduduk) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data penduduk not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_penduduk->remove($this->post('nik'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data penduduk deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data penduduk not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Data penduduk.php */
/* Location: ./application/controllers/api/Data penduduk.php */
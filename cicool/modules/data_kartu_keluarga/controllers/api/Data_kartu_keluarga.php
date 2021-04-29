<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_kartu_keluarga extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_kartu_keluarga');
	}

	/**
	 * @api {get} /data_kartu_keluarga/all Get all data_kartu_keluargas.
	 * @apiVersion 0.1.0
	 * @apiName AllDatakartukeluarga 
	 * @apiGroup data_kartu_keluarga
	 * @apiHeader {String} X-Api-Key Data kartu keluargas unique access-key.
	 * @apiHeader {String} X-Token Data kartu keluargas unique token.
	 * @apiPermission Data kartu keluarga Cant be Accessed permission name : api_data_kartu_keluarga_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data kartu keluargas.
	 * @apiParam {String} [Field="All Field"] Optional field of Data kartu keluargas : no_kk, nik.
	 * @apiParam {String} [Start=0] Optional start index of Data kartu keluargas.
	 * @apiParam {String} [Limit=10] Optional limit data of Data kartu keluargas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_kartu_keluarga.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData kartu keluarga Data kartu keluarga data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_kartu_keluarga_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['no_kk', 'nik'];
		$data_kartu_keluargas = $this->model_api_data_kartu_keluarga->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_kartu_keluarga->count_all($filter, $field);
		$data_kartu_keluargas = array_map(function($row){
						
			return $row;
		}, $data_kartu_keluargas);

		$data['data_kartu_keluarga'] = $data_kartu_keluargas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data kartu keluarga',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /data_kartu_keluarga/detail Detail Data kartu keluarga.
	 * @apiVersion 0.1.0
	 * @apiName DetailData kartu keluarga
	 * @apiGroup data_kartu_keluarga
	 * @apiHeader {String} X-Api-Key Data kartu keluargas unique access-key.
	 * @apiHeader {String} X-Token Data kartu keluargas unique token.
	 * @apiPermission Data kartu keluarga Cant be Accessed permission name : api_data_kartu_keluarga_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data kartu keluargas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_kartu_keluarga.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data kartu keluargaNotFound Data kartu keluarga data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_kartu_keluarga_detail');

		$this->requiredInput(['no_kk']);

		$id = $this->get('no_kk');

		$select_field = ['no_kk', 'nik'];
		$data_kartu_keluarga = $this->model_api_data_kartu_keluarga->find($id, $select_field);

		if (!$data_kartu_keluarga) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['data_kartu_keluarga'] = $data_kartu_keluarga;
		if ($data['data_kartu_keluarga']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data kartu keluarga',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data kartu keluarga not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_kartu_keluarga/add Add Data kartu keluarga.
	 * @apiVersion 0.1.0
	 * @apiName AddData kartu keluarga
	 * @apiGroup data_kartu_keluarga
	 * @apiHeader {String} X-Api-Key Data kartu keluargas unique access-key.
	 * @apiHeader {String} X-Token Data kartu keluargas unique token.
	 * @apiPermission Data kartu keluarga Cant be Accessed permission name : api_data_kartu_keluarga_add
	 *
 	 * @apiParam {String} Nik Mandatory nik of Data kartu keluargas. Input Nik Max Length : 11. 
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
		$this->is_allowed('api_data_kartu_keluarga_add');

		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nik' => $this->input->post('nik'),
			];
			
			$save_data_kartu_keluarga = $this->model_api_data_kartu_keluarga->store($save_data);

			if ($save_data_kartu_keluarga) {
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
	 * @api {post} /data_kartu_keluarga/update Update Data kartu keluarga.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData kartu keluarga
	 * @apiGroup data_kartu_keluarga
	 * @apiHeader {String} X-Api-Key Data kartu keluargas unique access-key.
	 * @apiHeader {String} X-Token Data kartu keluargas unique token.
	 * @apiPermission Data kartu keluarga Cant be Accessed permission name : api_data_kartu_keluarga_update
	 *
	 * @apiParam {String} Nik Mandatory nik of Data kartu keluargas. Input Nik Max Length : 11. 
	 * @apiParam {Integer} no_kk Mandatory no_kk of Data Kartu Keluarga.
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
		$this->is_allowed('api_data_kartu_keluarga_update');

		
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nik' => $this->input->post('nik'),
			];
			
			$save_data_kartu_keluarga = $this->model_api_data_kartu_keluarga->change($this->post('no_kk'), $save_data);

			if ($save_data_kartu_keluarga) {
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
	 * @api {post} /data_kartu_keluarga/delete Delete Data kartu keluarga. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData kartu keluarga
	 * @apiGroup data_kartu_keluarga
	 * @apiHeader {String} X-Api-Key Data kartu keluargas unique access-key.
	 * @apiHeader {String} X-Token Data kartu keluargas unique token.
	 	 * @apiPermission Data kartu keluarga Cant be Accessed permission name : api_data_kartu_keluarga_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data kartu keluargas .
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
		$this->is_allowed('api_data_kartu_keluarga_delete');

		$data_kartu_keluarga = $this->model_api_data_kartu_keluarga->find($this->post('no_kk'));

		if (!$data_kartu_keluarga) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data kartu keluarga not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_kartu_keluarga->remove($this->post('no_kk'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data kartu keluarga deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data kartu keluarga not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Data kartu keluarga.php */
/* Location: ./application/controllers/api/Data kartu keluarga.php */
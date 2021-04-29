<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_jenis_lembaga_desa extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_jenis_lembaga_desa');
	}

	/**
	 * @api {get} /data_jenis_lembaga_desa/all Get all data_jenis_lembaga_desas.
	 * @apiVersion 0.1.0
	 * @apiName AllDatajenislembagadesa 
	 * @apiGroup data_jenis_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data jenis lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis lembaga desas unique token.
	 * @apiPermission Data jenis lembaga desa Cant be Accessed permission name : api_data_jenis_lembaga_desa_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data jenis lembaga desas.
	 * @apiParam {String} [Field="All Field"] Optional field of Data jenis lembaga desas : id_lembaga, nama_lembaga.
	 * @apiParam {String} [Start=0] Optional start index of Data jenis lembaga desas.
	 * @apiParam {String} [Limit=10] Optional limit data of Data jenis lembaga desas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_jenis_lembaga_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData jenis lembaga desa Data jenis lembaga desa data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_jenis_lembaga_desa_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_lembaga', 'nama_lembaga'];
		$data_jenis_lembaga_desas = $this->model_api_data_jenis_lembaga_desa->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_jenis_lembaga_desa->count_all($filter, $field);

		$data['data_jenis_lembaga_desa'] = $data_jenis_lembaga_desas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data jenis lembaga desa',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_jenis_lembaga_desa/detail Detail Data jenis lembaga desa.
	 * @apiVersion 0.1.0
	 * @apiName DetailData jenis lembaga desa
	 * @apiGroup data_jenis_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data jenis lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis lembaga desas unique token.
	 * @apiPermission Data jenis lembaga desa Cant be Accessed permission name : api_data_jenis_lembaga_desa_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data jenis lembaga desas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_jenis_lembaga_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data jenis lembaga desaNotFound Data jenis lembaga desa data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_jenis_lembaga_desa_detail');

		$this->requiredInput(['id_lembaga']);

		$id = $this->get('id_lembaga');

		$select_field = ['id_lembaga', 'nama_lembaga'];
		$data['data_jenis_lembaga_desa'] = $this->model_api_data_jenis_lembaga_desa->find($id, $select_field);

		if ($data['data_jenis_lembaga_desa']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data jenis lembaga desa',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data jenis lembaga desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_jenis_lembaga_desa/add Add Data jenis lembaga desa.
	 * @apiVersion 0.1.0
	 * @apiName AddData jenis lembaga desa
	 * @apiGroup data_jenis_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data jenis lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis lembaga desas unique token.
	 * @apiPermission Data jenis lembaga desa Cant be Accessed permission name : api_data_jenis_lembaga_desa_add
	 *
 	 * @apiParam {String} Nama_lembaga Mandatory nama_lembaga of Data jenis lembaga desas. Input Nama Lembaga Max Length : 50. 
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
		$this->is_allowed('api_data_jenis_lembaga_desa_add');

		$this->form_validation->set_rules('nama_lembaga', 'Nama Lembaga', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_lembaga' => $this->input->post('nama_lembaga'),
			];
			
			$save_data_jenis_lembaga_desa = $this->model_api_data_jenis_lembaga_desa->store($save_data);

			if ($save_data_jenis_lembaga_desa) {
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
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /data_jenis_lembaga_desa/update Update Data jenis lembaga desa.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData jenis lembaga desa
	 * @apiGroup data_jenis_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data jenis lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis lembaga desas unique token.
	 * @apiPermission Data jenis lembaga desa Cant be Accessed permission name : api_data_jenis_lembaga_desa_update
	 *
	 * @apiParam {String} Nama_lembaga Mandatory nama_lembaga of Data jenis lembaga desas. Input Nama Lembaga Max Length : 50. 
	 * @apiParam {Integer} id_lembaga Mandatory id_lembaga of Data Jenis Lembaga Desa.
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
		$this->is_allowed('api_data_jenis_lembaga_desa_update');

		
		$this->form_validation->set_rules('nama_lembaga', 'Nama Lembaga', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_lembaga' => $this->input->post('nama_lembaga'),
			];
			
			$save_data_jenis_lembaga_desa = $this->model_api_data_jenis_lembaga_desa->change($this->post('id_lembaga'), $save_data);

			if ($save_data_jenis_lembaga_desa) {
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
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /data_jenis_lembaga_desa/delete Delete Data jenis lembaga desa. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData jenis lembaga desa
	 * @apiGroup data_jenis_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data jenis lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis lembaga desas unique token.
	 	 * @apiPermission Data jenis lembaga desa Cant be Accessed permission name : api_data_jenis_lembaga_desa_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data jenis lembaga desas .
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
		$this->is_allowed('api_data_jenis_lembaga_desa_delete');

		$data_jenis_lembaga_desa = $this->model_api_data_jenis_lembaga_desa->find($this->post('id_lembaga'));

		if (!$data_jenis_lembaga_desa) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data jenis lembaga desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_jenis_lembaga_desa->remove($this->post('id_lembaga'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data jenis lembaga desa deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data jenis lembaga desa not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data jenis lembaga desa.php */
/* Location: ./application/controllers/api/Data jenis lembaga desa.php */
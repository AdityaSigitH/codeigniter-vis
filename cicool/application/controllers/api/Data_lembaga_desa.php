<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_lembaga_desa extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_lembaga_desa');
	}

	/**
	 * @api {get} /data_lembaga_desa/all Get all data_lembaga_desas.
	 * @apiVersion 0.1.0
	 * @apiName AllDatalembagadesa 
	 * @apiGroup data_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data lembaga desas unique token.
	 * @apiPermission Data lembaga desa Cant be Accessed permission name : api_data_lembaga_desa_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data lembaga desas.
	 * @apiParam {String} [Field="All Field"] Optional field of Data lembaga desas : id_lembaga, nama_lembaga, jenis_lembaga.
	 * @apiParam {String} [Start=0] Optional start index of Data lembaga desas.
	 * @apiParam {String} [Limit=10] Optional limit data of Data lembaga desas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_lembaga_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData lembaga desa Data lembaga desa data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_lembaga_desa_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_lembaga', 'nama_lembaga', 'jenis_lembaga'];
		$data_lembaga_desas = $this->model_api_data_lembaga_desa->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_lembaga_desa->count_all($filter, $field);

		$data['data_lembaga_desa'] = $data_lembaga_desas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data lembaga desa',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_lembaga_desa/detail Detail Data lembaga desa.
	 * @apiVersion 0.1.0
	 * @apiName DetailData lembaga desa
	 * @apiGroup data_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data lembaga desas unique token.
	 * @apiPermission Data lembaga desa Cant be Accessed permission name : api_data_lembaga_desa_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data lembaga desas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_lembaga_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data lembaga desaNotFound Data lembaga desa data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_lembaga_desa_detail');

		$this->requiredInput(['id_lembaga']);

		$id = $this->get('id_lembaga');

		$select_field = ['id_lembaga', 'nama_lembaga', 'jenis_lembaga'];
		$data['data_lembaga_desa'] = $this->model_api_data_lembaga_desa->find($id, $select_field);

		if ($data['data_lembaga_desa']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data lembaga desa',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data lembaga desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_lembaga_desa/add Add Data lembaga desa.
	 * @apiVersion 0.1.0
	 * @apiName AddData lembaga desa
	 * @apiGroup data_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data lembaga desas unique token.
	 * @apiPermission Data lembaga desa Cant be Accessed permission name : api_data_lembaga_desa_add
	 *
 	 * @apiParam {String} Nama_lembaga Mandatory nama_lembaga of Data lembaga desas. Input Nama Lembaga Max Length : 255. 
	 * @apiParam {String} Jenis_lembaga Mandatory jenis_lembaga of Data lembaga desas. Input Jenis Lembaga Max Length : 255. 
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
		$this->is_allowed('api_data_lembaga_desa_add');

		$this->form_validation->set_rules('nama_lembaga', 'Nama Lembaga', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jenis_lembaga', 'Jenis Lembaga', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_lembaga' => $this->input->post('nama_lembaga'),
				'jenis_lembaga' => $this->input->post('jenis_lembaga'),
			];
			
			$save_data_lembaga_desa = $this->model_api_data_lembaga_desa->store($save_data);

			if ($save_data_lembaga_desa) {
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
	 * @api {post} /data_lembaga_desa/update Update Data lembaga desa.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData lembaga desa
	 * @apiGroup data_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data lembaga desas unique token.
	 * @apiPermission Data lembaga desa Cant be Accessed permission name : api_data_lembaga_desa_update
	 *
	 * @apiParam {String} Nama_lembaga Mandatory nama_lembaga of Data lembaga desas. Input Nama Lembaga Max Length : 255. 
	 * @apiParam {String} Jenis_lembaga Mandatory jenis_lembaga of Data lembaga desas. Input Jenis Lembaga Max Length : 255. 
	 * @apiParam {Integer} id_lembaga Mandatory id_lembaga of Data Lembaga Desa.
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
		$this->is_allowed('api_data_lembaga_desa_update');

		
		$this->form_validation->set_rules('nama_lembaga', 'Nama Lembaga', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jenis_lembaga', 'Jenis Lembaga', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_lembaga' => $this->input->post('nama_lembaga'),
				'jenis_lembaga' => $this->input->post('jenis_lembaga'),
			];
			
			$save_data_lembaga_desa = $this->model_api_data_lembaga_desa->change($this->post('id_lembaga'), $save_data);

			if ($save_data_lembaga_desa) {
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
	 * @api {post} /data_lembaga_desa/delete Delete Data lembaga desa. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData lembaga desa
	 * @apiGroup data_lembaga_desa
	 * @apiHeader {String} X-Api-Key Data lembaga desas unique access-key.
	 * @apiHeader {String} X-Token Data lembaga desas unique token.
	 	 * @apiPermission Data lembaga desa Cant be Accessed permission name : api_data_lembaga_desa_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data lembaga desas .
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
		$this->is_allowed('api_data_lembaga_desa_delete');

		$data_lembaga_desa = $this->model_api_data_lembaga_desa->find($this->post('id_lembaga'));

		if (!$data_lembaga_desa) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data lembaga desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_lembaga_desa->remove($this->post('id_lembaga'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data lembaga desa deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data lembaga desa not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data lembaga desa.php */
/* Location: ./application/controllers/api/Data lembaga desa.php */
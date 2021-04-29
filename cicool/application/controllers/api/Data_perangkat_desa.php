<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_perangkat_desa extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_perangkat_desa');
	}

	/**
	 * @api {get} /data_perangkat_desa/all Get all data_perangkat_desas.
	 * @apiVersion 0.1.0
	 * @apiName AllDataperangkatdesa 
	 * @apiGroup data_perangkat_desa
	 * @apiHeader {String} X-Api-Key Data perangkat desas unique access-key.
	 * @apiHeader {String} X-Token Data perangkat desas unique token.
	 * @apiPermission Data perangkat desa Cant be Accessed permission name : api_data_perangkat_desa_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data perangkat desas.
	 * @apiParam {String} [Field="All Field"] Optional field of Data perangkat desas : id_perangkat_desa, nama_perangkat_desa, jabatan.
	 * @apiParam {String} [Start=0] Optional start index of Data perangkat desas.
	 * @apiParam {String} [Limit=10] Optional limit data of Data perangkat desas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_perangkat_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData perangkat desa Data perangkat desa data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_perangkat_desa_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_perangkat_desa', 'nama_perangkat_desa', 'jabatan'];
		$data_perangkat_desas = $this->model_api_data_perangkat_desa->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_perangkat_desa->count_all($filter, $field);

		$data['data_perangkat_desa'] = $data_perangkat_desas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data perangkat desa',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_perangkat_desa/detail Detail Data perangkat desa.
	 * @apiVersion 0.1.0
	 * @apiName DetailData perangkat desa
	 * @apiGroup data_perangkat_desa
	 * @apiHeader {String} X-Api-Key Data perangkat desas unique access-key.
	 * @apiHeader {String} X-Token Data perangkat desas unique token.
	 * @apiPermission Data perangkat desa Cant be Accessed permission name : api_data_perangkat_desa_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data perangkat desas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_perangkat_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data perangkat desaNotFound Data perangkat desa data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_perangkat_desa_detail');

		$this->requiredInput(['id_perangkat_desa']);

		$id = $this->get('id_perangkat_desa');

		$select_field = ['id_perangkat_desa', 'nama_perangkat_desa', 'jabatan'];
		$data['data_perangkat_desa'] = $this->model_api_data_perangkat_desa->find($id, $select_field);

		if ($data['data_perangkat_desa']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data perangkat desa',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data perangkat desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_perangkat_desa/add Add Data perangkat desa.
	 * @apiVersion 0.1.0
	 * @apiName AddData perangkat desa
	 * @apiGroup data_perangkat_desa
	 * @apiHeader {String} X-Api-Key Data perangkat desas unique access-key.
	 * @apiHeader {String} X-Token Data perangkat desas unique token.
	 * @apiPermission Data perangkat desa Cant be Accessed permission name : api_data_perangkat_desa_add
	 *
 	 * @apiParam {String} Nama_perangkat_desa Mandatory nama_perangkat_desa of Data perangkat desas. Input Nama Perangkat Desa Max Length : 50. 
	 * @apiParam {String} Jabatan Mandatory jabatan of Data perangkat desas. Input Jabatan Max Length : 50. 
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
		$this->is_allowed('api_data_perangkat_desa_add');

		$this->form_validation->set_rules('nama_perangkat_desa', 'Nama Perangkat Desa', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_perangkat_desa' => $this->input->post('nama_perangkat_desa'),
				'jabatan' => $this->input->post('jabatan'),
			];
			
			$save_data_perangkat_desa = $this->model_api_data_perangkat_desa->store($save_data);

			if ($save_data_perangkat_desa) {
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
	 * @api {post} /data_perangkat_desa/update Update Data perangkat desa.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData perangkat desa
	 * @apiGroup data_perangkat_desa
	 * @apiHeader {String} X-Api-Key Data perangkat desas unique access-key.
	 * @apiHeader {String} X-Token Data perangkat desas unique token.
	 * @apiPermission Data perangkat desa Cant be Accessed permission name : api_data_perangkat_desa_update
	 *
	 * @apiParam {String} Nama_perangkat_desa Mandatory nama_perangkat_desa of Data perangkat desas. Input Nama Perangkat Desa Max Length : 50. 
	 * @apiParam {String} Jabatan Mandatory jabatan of Data perangkat desas. Input Jabatan Max Length : 50. 
	 * @apiParam {Integer} id_perangkat_desa Mandatory id_perangkat_desa of Data Perangkat Desa.
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
		$this->is_allowed('api_data_perangkat_desa_update');

		
		$this->form_validation->set_rules('nama_perangkat_desa', 'Nama Perangkat Desa', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_perangkat_desa' => $this->input->post('nama_perangkat_desa'),
				'jabatan' => $this->input->post('jabatan'),
			];
			
			$save_data_perangkat_desa = $this->model_api_data_perangkat_desa->change($this->post('id_perangkat_desa'), $save_data);

			if ($save_data_perangkat_desa) {
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
	 * @api {post} /data_perangkat_desa/delete Delete Data perangkat desa. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData perangkat desa
	 * @apiGroup data_perangkat_desa
	 * @apiHeader {String} X-Api-Key Data perangkat desas unique access-key.
	 * @apiHeader {String} X-Token Data perangkat desas unique token.
	 	 * @apiPermission Data perangkat desa Cant be Accessed permission name : api_data_perangkat_desa_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data perangkat desas .
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
		$this->is_allowed('api_data_perangkat_desa_delete');

		$data_perangkat_desa = $this->model_api_data_perangkat_desa->find($this->post('id_perangkat_desa'));

		if (!$data_perangkat_desa) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data perangkat desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_perangkat_desa->remove($this->post('id_perangkat_desa'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data perangkat desa deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data perangkat desa not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data perangkat desa.php */
/* Location: ./application/controllers/api/Data perangkat desa.php */
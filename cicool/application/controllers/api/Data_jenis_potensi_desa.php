<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_jenis_potensi_desa extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_jenis_potensi_desa');
	}

	/**
	 * @api {get} /data_jenis_potensi_desa/all Get all data_jenis_potensi_desas.
	 * @apiVersion 0.1.0
	 * @apiName AllDatajenispotensidesa 
	 * @apiGroup data_jenis_potensi_desa
	 * @apiHeader {String} X-Api-Key Data jenis potensi desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis potensi desas unique token.
	 * @apiPermission Data jenis potensi desa Cant be Accessed permission name : api_data_jenis_potensi_desa_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data jenis potensi desas.
	 * @apiParam {String} [Field="All Field"] Optional field of Data jenis potensi desas : id_jenis_potensi, nama_potensi.
	 * @apiParam {String} [Start=0] Optional start index of Data jenis potensi desas.
	 * @apiParam {String} [Limit=10] Optional limit data of Data jenis potensi desas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_jenis_potensi_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData jenis potensi desa Data jenis potensi desa data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_jenis_potensi_desa_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_jenis_potensi', 'nama_potensi'];
		$data_jenis_potensi_desas = $this->model_api_data_jenis_potensi_desa->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_jenis_potensi_desa->count_all($filter, $field);

		$data['data_jenis_potensi_desa'] = $data_jenis_potensi_desas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data jenis potensi desa',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_jenis_potensi_desa/detail Detail Data jenis potensi desa.
	 * @apiVersion 0.1.0
	 * @apiName DetailData jenis potensi desa
	 * @apiGroup data_jenis_potensi_desa
	 * @apiHeader {String} X-Api-Key Data jenis potensi desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis potensi desas unique token.
	 * @apiPermission Data jenis potensi desa Cant be Accessed permission name : api_data_jenis_potensi_desa_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data jenis potensi desas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_jenis_potensi_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data jenis potensi desaNotFound Data jenis potensi desa data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_jenis_potensi_desa_detail');

		$this->requiredInput(['id_jenis_potensi']);

		$id = $this->get('id_jenis_potensi');

		$select_field = ['id_jenis_potensi', 'nama_potensi'];
		$data['data_jenis_potensi_desa'] = $this->model_api_data_jenis_potensi_desa->find($id, $select_field);

		if ($data['data_jenis_potensi_desa']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data jenis potensi desa',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data jenis potensi desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_jenis_potensi_desa/add Add Data jenis potensi desa.
	 * @apiVersion 0.1.0
	 * @apiName AddData jenis potensi desa
	 * @apiGroup data_jenis_potensi_desa
	 * @apiHeader {String} X-Api-Key Data jenis potensi desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis potensi desas unique token.
	 * @apiPermission Data jenis potensi desa Cant be Accessed permission name : api_data_jenis_potensi_desa_add
	 *
 	 * @apiParam {String} Nama_potensi Mandatory nama_potensi of Data jenis potensi desas. Input Nama Potensi Max Length : 50. 
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
		$this->is_allowed('api_data_jenis_potensi_desa_add');

		$this->form_validation->set_rules('nama_potensi', 'Nama Potensi', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_potensi' => $this->input->post('nama_potensi'),
			];
			
			$save_data_jenis_potensi_desa = $this->model_api_data_jenis_potensi_desa->store($save_data);

			if ($save_data_jenis_potensi_desa) {
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
	 * @api {post} /data_jenis_potensi_desa/update Update Data jenis potensi desa.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData jenis potensi desa
	 * @apiGroup data_jenis_potensi_desa
	 * @apiHeader {String} X-Api-Key Data jenis potensi desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis potensi desas unique token.
	 * @apiPermission Data jenis potensi desa Cant be Accessed permission name : api_data_jenis_potensi_desa_update
	 *
	 * @apiParam {String} Nama_potensi Mandatory nama_potensi of Data jenis potensi desas. Input Nama Potensi Max Length : 50. 
	 * @apiParam {Integer} id_jenis_potensi Mandatory id_jenis_potensi of Data Jenis Potensi Desa.
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
		$this->is_allowed('api_data_jenis_potensi_desa_update');

		
		$this->form_validation->set_rules('nama_potensi', 'Nama Potensi', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_potensi' => $this->input->post('nama_potensi'),
			];
			
			$save_data_jenis_potensi_desa = $this->model_api_data_jenis_potensi_desa->change($this->post('id_jenis_potensi'), $save_data);

			if ($save_data_jenis_potensi_desa) {
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
	 * @api {post} /data_jenis_potensi_desa/delete Delete Data jenis potensi desa. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData jenis potensi desa
	 * @apiGroup data_jenis_potensi_desa
	 * @apiHeader {String} X-Api-Key Data jenis potensi desas unique access-key.
	 * @apiHeader {String} X-Token Data jenis potensi desas unique token.
	 	 * @apiPermission Data jenis potensi desa Cant be Accessed permission name : api_data_jenis_potensi_desa_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data jenis potensi desas .
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
		$this->is_allowed('api_data_jenis_potensi_desa_delete');

		$data_jenis_potensi_desa = $this->model_api_data_jenis_potensi_desa->find($this->post('id_jenis_potensi'));

		if (!$data_jenis_potensi_desa) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data jenis potensi desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_jenis_potensi_desa->remove($this->post('id_jenis_potensi'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data jenis potensi desa deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data jenis potensi desa not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data jenis potensi desa.php */
/* Location: ./application/controllers/api/Data jenis potensi desa.php */
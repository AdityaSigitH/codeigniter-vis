<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Desa extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_desa');
	}

	/**
	 * @api {get} /desa/all Get all desas.
	 * @apiVersion 0.1.0
	 * @apiName AllDesa 
	 * @apiGroup desa
	 * @apiHeader {String} X-Api-Key Desas unique access-key.
	 * @apiHeader {String} X-Token Desas unique token.
	 * @apiPermission Desa Cant be Accessed permission name : api_desa_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Desas.
	 * @apiParam {String} [Field="All Field"] Optional field of Desas : id, desa, deskripsi.
	 * @apiParam {String} [Start=0] Optional start index of Desas.
	 * @apiParam {String} [Limit=10] Optional limit data of Desas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataDesa Desa data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_desa_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id', 'desa', 'deskripsi'];
		$desas = $this->model_api_desa->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_desa->count_all($filter, $field);
		$desas = array_map(function($row){
						
			return $row;
		}, $desas);

		$data['desa'] = $desas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Desa',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /desa/detail Detail Desa.
	 * @apiVersion 0.1.0
	 * @apiName DetailDesa
	 * @apiGroup desa
	 * @apiHeader {String} X-Api-Key Desas unique access-key.
	 * @apiHeader {String} X-Token Desas unique token.
	 * @apiPermission Desa Cant be Accessed permission name : api_desa_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Desas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError DesaNotFound Desa data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_desa_detail');

		$this->requiredInput(['id']);

		$id = $this->get('id');

		$select_field = ['id', 'desa', 'deskripsi'];
		$desa = $this->model_api_desa->find($id, $select_field);

		if (!$desa) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['desa'] = $desa;
		if ($data['desa']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Desa',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /desa/add Add Desa.
	 * @apiVersion 0.1.0
	 * @apiName AddDesa
	 * @apiGroup desa
	 * @apiHeader {String} X-Api-Key Desas unique access-key.
	 * @apiHeader {String} X-Token Desas unique token.
	 * @apiPermission Desa Cant be Accessed permission name : api_desa_add
	 *
 	 * @apiParam {String} Desa Mandatory desa of Desas. Input Desa Max Length : 255. 
	 * @apiParam {String} Deskripsi Mandatory deskripsi of Desas.  
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
		$this->is_allowed('api_desa_add');

		$this->form_validation->set_rules('desa', 'Desa', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'desa' => $this->input->post('desa'),
				'deskripsi' => $this->input->post('deskripsi'),
			];
			
			$save_desa = $this->model_api_desa->store($save_data);

			if ($save_desa) {
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
	 * @api {post} /desa/update Update Desa.
	 * @apiVersion 0.1.0
	 * @apiName UpdateDesa
	 * @apiGroup desa
	 * @apiHeader {String} X-Api-Key Desas unique access-key.
	 * @apiHeader {String} X-Token Desas unique token.
	 * @apiPermission Desa Cant be Accessed permission name : api_desa_update
	 *
	 * @apiParam {String} Desa Mandatory desa of Desas. Input Desa Max Length : 255. 
	 * @apiParam {String} Deskripsi Mandatory deskripsi of Desas.  
	 * @apiParam {Integer} id Mandatory id of Desa.
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
		$this->is_allowed('api_desa_update');

		
		$this->form_validation->set_rules('desa', 'Desa', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'desa' => $this->input->post('desa'),
				'deskripsi' => $this->input->post('deskripsi'),
			];
			
			$save_desa = $this->model_api_desa->change($this->post('id'), $save_data);

			if ($save_desa) {
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
	 * @api {post} /desa/delete Delete Desa. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteDesa
	 * @apiGroup desa
	 * @apiHeader {String} X-Api-Key Desas unique access-key.
	 * @apiHeader {String} X-Token Desas unique token.
	 	 * @apiPermission Desa Cant be Accessed permission name : api_desa_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Desas .
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
		$this->is_allowed('api_desa_delete');

		$desa = $this->model_api_desa->find($this->post('id'));

		if (!$desa) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_desa->remove($this->post('id'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Desa deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Desa not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Desa.php */
/* Location: ./application/controllers/api/Desa.php */
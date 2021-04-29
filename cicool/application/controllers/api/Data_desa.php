<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_desa extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_desa');
	}

	/**
	 * @api {get} /data_desa/all Get all data_desas.
	 * @apiVersion 0.1.0
	 * @apiName AllDatadesa 
	 * @apiGroup data_desa
	 * @apiHeader {String} X-Api-Key Data desas unique access-key.
	 * @apiHeader {String} X-Token Data desas unique token.
	 * @apiPermission Data desa Cant be Accessed permission name : api_data_desa_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data desas.
	 * @apiParam {String} [Field="All Field"] Optional field of Data desas : id_desa, nama_desa, alamat_lengkap, deskripsi.
	 * @apiParam {String} [Start=0] Optional start index of Data desas.
	 * @apiParam {String} [Limit=10] Optional limit data of Data desas.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData desa Data desa data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_desa_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_desa', 'nama_desa', 'alamat_lengkap', 'deskripsi'];
		$data_desas = $this->model_api_data_desa->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_desa->count_all($filter, $field);

		$data['data_desa'] = $data_desas;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data desa',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_desa/detail Detail Data desa.
	 * @apiVersion 0.1.0
	 * @apiName DetailData desa
	 * @apiGroup data_desa
	 * @apiHeader {String} X-Api-Key Data desas unique access-key.
	 * @apiHeader {String} X-Token Data desas unique token.
	 * @apiPermission Data desa Cant be Accessed permission name : api_data_desa_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data desas.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_desa.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data desaNotFound Data desa data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_desa_detail');

		$this->requiredInput(['id_desa']);

		$id = $this->get('id_desa');

		$select_field = ['id_desa', 'nama_desa', 'alamat_lengkap', 'deskripsi'];
		$data['data_desa'] = $this->model_api_data_desa->find($id, $select_field);

		if ($data['data_desa']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data desa',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_desa/add Add Data desa.
	 * @apiVersion 0.1.0
	 * @apiName AddData desa
	 * @apiGroup data_desa
	 * @apiHeader {String} X-Api-Key Data desas unique access-key.
	 * @apiHeader {String} X-Token Data desas unique token.
	 * @apiPermission Data desa Cant be Accessed permission name : api_data_desa_add
	 *
 	 * @apiParam {String} Nama_desa Mandatory nama_desa of Data desas. Input Nama Desa Max Length : 255. 
	 * @apiParam {String} Alamat_lengkap Mandatory alamat_lengkap of Data desas.  
	 * @apiParam {String} Deskripsi Mandatory deskripsi of Data desas.  
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
		$this->is_allowed('api_data_desa_add');

		$this->form_validation->set_rules('nama_desa', 'Nama Desa', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_desa' => $this->input->post('nama_desa'),
				'alamat_lengkap' => $this->input->post('alamat_lengkap'),
				'deskripsi' => $this->input->post('deskripsi'),
			];
			
			$save_data_desa = $this->model_api_data_desa->store($save_data);

			if ($save_data_desa) {
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
	 * @api {post} /data_desa/update Update Data desa.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData desa
	 * @apiGroup data_desa
	 * @apiHeader {String} X-Api-Key Data desas unique access-key.
	 * @apiHeader {String} X-Token Data desas unique token.
	 * @apiPermission Data desa Cant be Accessed permission name : api_data_desa_update
	 *
	 * @apiParam {String} Nama_desa Mandatory nama_desa of Data desas. Input Nama Desa Max Length : 255. 
	 * @apiParam {String} Alamat_lengkap Mandatory alamat_lengkap of Data desas.  
	 * @apiParam {String} Deskripsi Mandatory deskripsi of Data desas.  
	 * @apiParam {Integer} id_desa Mandatory id_desa of Data Desa.
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
		$this->is_allowed('api_data_desa_update');

		
		$this->form_validation->set_rules('nama_desa', 'Nama Desa', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama_desa' => $this->input->post('nama_desa'),
				'alamat_lengkap' => $this->input->post('alamat_lengkap'),
				'deskripsi' => $this->input->post('deskripsi'),
			];
			
			$save_data_desa = $this->model_api_data_desa->change($this->post('id_desa'), $save_data);

			if ($save_data_desa) {
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
	 * @api {post} /data_desa/delete Delete Data desa. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData desa
	 * @apiGroup data_desa
	 * @apiHeader {String} X-Api-Key Data desas unique access-key.
	 * @apiHeader {String} X-Token Data desas unique token.
	 	 * @apiPermission Data desa Cant be Accessed permission name : api_data_desa_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data desas .
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
		$this->is_allowed('api_data_desa_delete');

		$data_desa = $this->model_api_data_desa->find($this->post('id_desa'));

		if (!$data_desa) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data desa not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_desa->remove($this->post('id_desa'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data desa deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data desa not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data desa.php */
/* Location: ./application/controllers/api/Data desa.php */
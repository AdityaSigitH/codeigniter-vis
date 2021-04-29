<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_jenis_surat extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_jenis_surat');
	}

	/**
	 * @api {get} /data_jenis_surat/all Get all data_jenis_surats.
	 * @apiVersion 0.1.0
	 * @apiName AllDatajenissurat 
	 * @apiGroup data_jenis_surat
	 * @apiHeader {String} X-Api-Key Data jenis surats unique access-key.
	 * @apiHeader {String} X-Token Data jenis surats unique token.
	 * @apiPermission Data jenis surat Cant be Accessed permission name : api_data_jenis_surat_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data jenis surats.
	 * @apiParam {String} [Field="All Field"] Optional field of Data jenis surats : id_jenis_surat, id_surat_master, id_surat_masuk, id_surat_keluar.
	 * @apiParam {String} [Start=0] Optional start index of Data jenis surats.
	 * @apiParam {String} [Limit=10] Optional limit data of Data jenis surats.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_jenis_surat.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData jenis surat Data jenis surat data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_jenis_surat_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_jenis_surat', 'id_surat_master', 'id_surat_masuk', 'id_surat_keluar'];
		$data_jenis_surats = $this->model_api_data_jenis_surat->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_jenis_surat->count_all($filter, $field);

		$data['data_jenis_surat'] = $data_jenis_surats;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data jenis surat',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_jenis_surat/detail Detail Data jenis surat.
	 * @apiVersion 0.1.0
	 * @apiName DetailData jenis surat
	 * @apiGroup data_jenis_surat
	 * @apiHeader {String} X-Api-Key Data jenis surats unique access-key.
	 * @apiHeader {String} X-Token Data jenis surats unique token.
	 * @apiPermission Data jenis surat Cant be Accessed permission name : api_data_jenis_surat_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data jenis surats.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_jenis_surat.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data jenis suratNotFound Data jenis surat data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_jenis_surat_detail');

		$this->requiredInput(['id_jenis_surat']);

		$id = $this->get('id_jenis_surat');

		$select_field = ['id_jenis_surat', 'id_surat_master', 'id_surat_masuk', 'id_surat_keluar'];
		$data['data_jenis_surat'] = $this->model_api_data_jenis_surat->find($id, $select_field);

		if ($data['data_jenis_surat']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data jenis surat',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data jenis surat not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_jenis_surat/add Add Data jenis surat.
	 * @apiVersion 0.1.0
	 * @apiName AddData jenis surat
	 * @apiGroup data_jenis_surat
	 * @apiHeader {String} X-Api-Key Data jenis surats unique access-key.
	 * @apiHeader {String} X-Token Data jenis surats unique token.
	 * @apiPermission Data jenis surat Cant be Accessed permission name : api_data_jenis_surat_add
	 *
 	 * @apiParam {String} Id_surat_master Mandatory id_surat_master of Data jenis surats. Input Id Surat Master Max Length : 255. 
	 * @apiParam {String} Id_surat_masuk Mandatory id_surat_masuk of Data jenis surats. Input Id Surat Masuk Max Length : 255. 
	 * @apiParam {String} Id_surat_keluar Mandatory id_surat_keluar of Data jenis surats. Input Id Surat Keluar Max Length : 255. 
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
		$this->is_allowed('api_data_jenis_surat_add');

		$this->form_validation->set_rules('id_surat_master', 'Id Surat Master', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('id_surat_masuk', 'Id Surat Masuk', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('id_surat_keluar', 'Id Surat Keluar', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'id_surat_master' => $this->input->post('id_surat_master'),
				'id_surat_masuk' => $this->input->post('id_surat_masuk'),
				'id_surat_keluar' => $this->input->post('id_surat_keluar'),
			];
			
			$save_data_jenis_surat = $this->model_api_data_jenis_surat->store($save_data);

			if ($save_data_jenis_surat) {
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
	 * @api {post} /data_jenis_surat/update Update Data jenis surat.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData jenis surat
	 * @apiGroup data_jenis_surat
	 * @apiHeader {String} X-Api-Key Data jenis surats unique access-key.
	 * @apiHeader {String} X-Token Data jenis surats unique token.
	 * @apiPermission Data jenis surat Cant be Accessed permission name : api_data_jenis_surat_update
	 *
	 * @apiParam {String} Id_surat_master Mandatory id_surat_master of Data jenis surats. Input Id Surat Master Max Length : 255. 
	 * @apiParam {String} Id_surat_masuk Mandatory id_surat_masuk of Data jenis surats. Input Id Surat Masuk Max Length : 255. 
	 * @apiParam {String} Id_surat_keluar Mandatory id_surat_keluar of Data jenis surats. Input Id Surat Keluar Max Length : 255. 
	 * @apiParam {Integer} id_jenis_surat Mandatory id_jenis_surat of Data Jenis Surat.
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
		$this->is_allowed('api_data_jenis_surat_update');

		
		$this->form_validation->set_rules('id_surat_master', 'Id Surat Master', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('id_surat_masuk', 'Id Surat Masuk', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('id_surat_keluar', 'Id Surat Keluar', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'id_surat_master' => $this->input->post('id_surat_master'),
				'id_surat_masuk' => $this->input->post('id_surat_masuk'),
				'id_surat_keluar' => $this->input->post('id_surat_keluar'),
			];
			
			$save_data_jenis_surat = $this->model_api_data_jenis_surat->change($this->post('id_jenis_surat'), $save_data);

			if ($save_data_jenis_surat) {
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
	 * @api {post} /data_jenis_surat/delete Delete Data jenis surat. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData jenis surat
	 * @apiGroup data_jenis_surat
	 * @apiHeader {String} X-Api-Key Data jenis surats unique access-key.
	 * @apiHeader {String} X-Token Data jenis surats unique token.
	 	 * @apiPermission Data jenis surat Cant be Accessed permission name : api_data_jenis_surat_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data jenis surats .
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
		$this->is_allowed('api_data_jenis_surat_delete');

		$data_jenis_surat = $this->model_api_data_jenis_surat->find($this->post('id_jenis_surat'));

		if (!$data_jenis_surat) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data jenis surat not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_jenis_surat->remove($this->post('id_jenis_surat'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data jenis surat deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data jenis surat not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data jenis surat.php */
/* Location: ./application/controllers/api/Data jenis surat.php */
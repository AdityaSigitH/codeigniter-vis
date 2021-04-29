<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_surat_masuk extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_surat_masuk');
	}

	/**
	 * @api {get} /data_surat_masuk/all Get all data_surat_masuks.
	 * @apiVersion 0.1.0
	 * @apiName AllDatasuratmasuk 
	 * @apiGroup data_surat_masuk
	 * @apiHeader {String} X-Api-Key Data surat masuks unique access-key.
	 * @apiHeader {String} X-Token Data surat masuks unique token.
	 * @apiPermission Data surat masuk Cant be Accessed permission name : api_data_surat_masuk_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data surat masuks.
	 * @apiParam {String} [Field="All Field"] Optional field of Data surat masuks : id_surat_masuk, id_jenis_surat, tgl_masuk, perihal.
	 * @apiParam {String} [Start=0] Optional start index of Data surat masuks.
	 * @apiParam {String} [Limit=10] Optional limit data of Data surat masuks.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_surat_masuk.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData surat masuk Data surat masuk data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_surat_masuk_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_surat_masuk', 'id_jenis_surat', 'tgl_masuk', 'perihal'];
		$data_surat_masuks = $this->model_api_data_surat_masuk->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_surat_masuk->count_all($filter, $field);

		$data['data_surat_masuk'] = $data_surat_masuks;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data surat masuk',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_surat_masuk/detail Detail Data surat masuk.
	 * @apiVersion 0.1.0
	 * @apiName DetailData surat masuk
	 * @apiGroup data_surat_masuk
	 * @apiHeader {String} X-Api-Key Data surat masuks unique access-key.
	 * @apiHeader {String} X-Token Data surat masuks unique token.
	 * @apiPermission Data surat masuk Cant be Accessed permission name : api_data_surat_masuk_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data surat masuks.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_surat_masuk.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data surat masukNotFound Data surat masuk data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_surat_masuk_detail');

		$this->requiredInput(['id_surat_masuk']);

		$id = $this->get('id_surat_masuk');

		$select_field = ['id_surat_masuk', 'id_jenis_surat', 'tgl_masuk', 'perihal'];
		$data['data_surat_masuk'] = $this->model_api_data_surat_masuk->find($id, $select_field);

		if ($data['data_surat_masuk']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data surat masuk',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data surat masuk not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_surat_masuk/add Add Data surat masuk.
	 * @apiVersion 0.1.0
	 * @apiName AddData surat masuk
	 * @apiGroup data_surat_masuk
	 * @apiHeader {String} X-Api-Key Data surat masuks unique access-key.
	 * @apiHeader {String} X-Token Data surat masuks unique token.
	 * @apiPermission Data surat masuk Cant be Accessed permission name : api_data_surat_masuk_add
	 *
 	 * @apiParam {String} Id_jenis_surat Mandatory id_jenis_surat of Data surat masuks. Input Id Jenis Surat Max Length : 11. 
	 * @apiParam {String} Tgl_masuk Mandatory tgl_masuk of Data surat masuks.  
	 * @apiParam {String} Perihal Mandatory perihal of Data surat masuks.  
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
		$this->is_allowed('api_data_surat_masuk_add');

		$this->form_validation->set_rules('id_jenis_surat', 'Id Jenis Surat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tgl_masuk', 'Tgl Masuk', 'trim|required');
		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'id_jenis_surat' => $this->input->post('id_jenis_surat'),
				'tgl_masuk' => $this->input->post('tgl_masuk'),
				'perihal' => $this->input->post('perihal'),
			];
			
			$save_data_surat_masuk = $this->model_api_data_surat_masuk->store($save_data);

			if ($save_data_surat_masuk) {
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
	 * @api {post} /data_surat_masuk/update Update Data surat masuk.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData surat masuk
	 * @apiGroup data_surat_masuk
	 * @apiHeader {String} X-Api-Key Data surat masuks unique access-key.
	 * @apiHeader {String} X-Token Data surat masuks unique token.
	 * @apiPermission Data surat masuk Cant be Accessed permission name : api_data_surat_masuk_update
	 *
	 * @apiParam {String} Id_jenis_surat Mandatory id_jenis_surat of Data surat masuks. Input Id Jenis Surat Max Length : 11. 
	 * @apiParam {String} Tgl_masuk Mandatory tgl_masuk of Data surat masuks.  
	 * @apiParam {String} Perihal Mandatory perihal of Data surat masuks.  
	 * @apiParam {Integer} id_surat_masuk Mandatory id_surat_masuk of Data Surat Masuk.
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
		$this->is_allowed('api_data_surat_masuk_update');

		
		$this->form_validation->set_rules('id_jenis_surat', 'Id Jenis Surat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tgl_masuk', 'Tgl Masuk', 'trim|required');
		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'id_jenis_surat' => $this->input->post('id_jenis_surat'),
				'tgl_masuk' => $this->input->post('tgl_masuk'),
				'perihal' => $this->input->post('perihal'),
			];
			
			$save_data_surat_masuk = $this->model_api_data_surat_masuk->change($this->post('id_surat_masuk'), $save_data);

			if ($save_data_surat_masuk) {
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
	 * @api {post} /data_surat_masuk/delete Delete Data surat masuk. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData surat masuk
	 * @apiGroup data_surat_masuk
	 * @apiHeader {String} X-Api-Key Data surat masuks unique access-key.
	 * @apiHeader {String} X-Token Data surat masuks unique token.
	 	 * @apiPermission Data surat masuk Cant be Accessed permission name : api_data_surat_masuk_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data surat masuks .
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
		$this->is_allowed('api_data_surat_masuk_delete');

		$data_surat_masuk = $this->model_api_data_surat_masuk->find($this->post('id_surat_masuk'));

		if (!$data_surat_masuk) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data surat masuk not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_surat_masuk->remove($this->post('id_surat_masuk'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data surat masuk deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data surat masuk not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data surat masuk.php */
/* Location: ./application/controllers/api/Data surat masuk.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_surat_keluar extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_surat_keluar');
	}

	/**
	 * @api {get} /data_surat_keluar/all Get all data_surat_keluars.
	 * @apiVersion 0.1.0
	 * @apiName AllDatasuratkeluar 
	 * @apiGroup data_surat_keluar
	 * @apiHeader {String} X-Api-Key Data surat keluars unique access-key.
	 * @apiHeader {String} X-Token Data surat keluars unique token.
	 * @apiPermission Data surat keluar Cant be Accessed permission name : api_data_surat_keluar_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data surat keluars.
	 * @apiParam {String} [Field="All Field"] Optional field of Data surat keluars : No_id_Surat, id_surat_keluar, tgl_keluar, Perihal.
	 * @apiParam {String} [Start=0] Optional start index of Data surat keluars.
	 * @apiParam {String} [Limit=10] Optional limit data of Data surat keluars.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_surat_keluar.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData surat keluar Data surat keluar data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_surat_keluar_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['No_id_Surat', 'id_surat_keluar', 'tgl_keluar', 'Perihal'];
		$data_surat_keluars = $this->model_api_data_surat_keluar->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_surat_keluar->count_all($filter, $field);

		$data['data_surat_keluar'] = $data_surat_keluars;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data surat keluar',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /data_surat_keluar/detail Detail Data surat keluar.
	 * @apiVersion 0.1.0
	 * @apiName DetailData surat keluar
	 * @apiGroup data_surat_keluar
	 * @apiHeader {String} X-Api-Key Data surat keluars unique access-key.
	 * @apiHeader {String} X-Token Data surat keluars unique token.
	 * @apiPermission Data surat keluar Cant be Accessed permission name : api_data_surat_keluar_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data surat keluars.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_surat_keluar.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data surat keluarNotFound Data surat keluar data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_surat_keluar_detail');

		$this->requiredInput(['No_id_Surat']);

		$id = $this->get('No_id_Surat');

		$select_field = ['No_id_Surat', 'id_surat_keluar', 'tgl_keluar', 'Perihal'];
		$data['data_surat_keluar'] = $this->model_api_data_surat_keluar->find($id, $select_field);

		if ($data['data_surat_keluar']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data surat keluar',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data surat keluar not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_surat_keluar/add Add Data surat keluar.
	 * @apiVersion 0.1.0
	 * @apiName AddData surat keluar
	 * @apiGroup data_surat_keluar
	 * @apiHeader {String} X-Api-Key Data surat keluars unique access-key.
	 * @apiHeader {String} X-Token Data surat keluars unique token.
	 * @apiPermission Data surat keluar Cant be Accessed permission name : api_data_surat_keluar_add
	 *
 	 * @apiParam {String} Id_surat_keluar Mandatory id_surat_keluar of Data surat keluars. Input Id Surat Keluar Max Length : 255. 
	 * @apiParam {String} Tgl_keluar Mandatory tgl_keluar of Data surat keluars.  
	 * @apiParam {String} Perihal Mandatory Perihal of Data surat keluars.  
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
		$this->is_allowed('api_data_surat_keluar_add');

		$this->form_validation->set_rules('id_surat_keluar', 'Id Surat Keluar', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tgl_keluar', 'Tgl Keluar', 'trim|required');
		$this->form_validation->set_rules('Perihal', 'Perihal', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'id_surat_keluar' => $this->input->post('id_surat_keluar'),
				'tgl_keluar' => $this->input->post('tgl_keluar'),
				'Perihal' => $this->input->post('Perihal'),
			];
			
			$save_data_surat_keluar = $this->model_api_data_surat_keluar->store($save_data);

			if ($save_data_surat_keluar) {
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
	 * @api {post} /data_surat_keluar/update Update Data surat keluar.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData surat keluar
	 * @apiGroup data_surat_keluar
	 * @apiHeader {String} X-Api-Key Data surat keluars unique access-key.
	 * @apiHeader {String} X-Token Data surat keluars unique token.
	 * @apiPermission Data surat keluar Cant be Accessed permission name : api_data_surat_keluar_update
	 *
	 * @apiParam {String} Id_surat_keluar Mandatory id_surat_keluar of Data surat keluars. Input Id Surat Keluar Max Length : 255. 
	 * @apiParam {String} Tgl_keluar Mandatory tgl_keluar of Data surat keluars.  
	 * @apiParam {String} Perihal Mandatory Perihal of Data surat keluars.  
	 * @apiParam {Integer} No_id_Surat Mandatory No_id_Surat of Data Surat Keluar.
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
		$this->is_allowed('api_data_surat_keluar_update');

		
		$this->form_validation->set_rules('id_surat_keluar', 'Id Surat Keluar', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tgl_keluar', 'Tgl Keluar', 'trim|required');
		$this->form_validation->set_rules('Perihal', 'Perihal', 'trim|required');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'id_surat_keluar' => $this->input->post('id_surat_keluar'),
				'tgl_keluar' => $this->input->post('tgl_keluar'),
				'Perihal' => $this->input->post('Perihal'),
			];
			
			$save_data_surat_keluar = $this->model_api_data_surat_keluar->change($this->post('No_id_Surat'), $save_data);

			if ($save_data_surat_keluar) {
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
	 * @api {post} /data_surat_keluar/delete Delete Data surat keluar. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData surat keluar
	 * @apiGroup data_surat_keluar
	 * @apiHeader {String} X-Api-Key Data surat keluars unique access-key.
	 * @apiHeader {String} X-Token Data surat keluars unique token.
	 	 * @apiPermission Data surat keluar Cant be Accessed permission name : api_data_surat_keluar_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data surat keluars .
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
		$this->is_allowed('api_data_surat_keluar_delete');

		$data_surat_keluar = $this->model_api_data_surat_keluar->find($this->post('No_id_Surat'));

		if (!$data_surat_keluar) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data surat keluar not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_surat_keluar->remove($this->post('No_id_Surat'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data surat keluar deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data surat keluar not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Data surat keluar.php */
/* Location: ./application/controllers/api/Data surat keluar.php */
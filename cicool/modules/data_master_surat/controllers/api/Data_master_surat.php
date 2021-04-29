<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_master_surat extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_master_surat');
	}

	/**
	 * @api {get} /data_master_surat/all Get all data_master_surats.
	 * @apiVersion 0.1.0
	 * @apiName AllDatamastersurat 
	 * @apiGroup data_master_surat
	 * @apiHeader {String} X-Api-Key Data master surats unique access-key.
	 * @apiHeader {String} X-Token Data master surats unique token.
	 * @apiPermission Data master surat Cant be Accessed permission name : api_data_master_surat_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data master surats.
	 * @apiParam {String} [Field="All Field"] Optional field of Data master surats : id_surat, No_surat, keterangan_surat, kepada, Alamat, tanggal, tempat, kepala_desa.
	 * @apiParam {String} [Start=0] Optional start index of Data master surats.
	 * @apiParam {String} [Limit=10] Optional limit data of Data master surats.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_master_surat.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData master surat Data master surat data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_master_surat_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_surat', 'No_surat', 'keterangan_surat', 'kepada', 'Alamat', 'tanggal', 'tempat', 'kepala_desa'];
		$data_master_surats = $this->model_api_data_master_surat->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_master_surat->count_all($filter, $field);
		$data_master_surats = array_map(function($row){
						
			return $row;
		}, $data_master_surats);

		$data['data_master_surat'] = $data_master_surats;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data master surat',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /data_master_surat/detail Detail Data master surat.
	 * @apiVersion 0.1.0
	 * @apiName DetailData master surat
	 * @apiGroup data_master_surat
	 * @apiHeader {String} X-Api-Key Data master surats unique access-key.
	 * @apiHeader {String} X-Token Data master surats unique token.
	 * @apiPermission Data master surat Cant be Accessed permission name : api_data_master_surat_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data master surats.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_master_surat.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data master suratNotFound Data master surat data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_master_surat_detail');

		$this->requiredInput(['id_surat']);

		$id = $this->get('id_surat');

		$select_field = ['id_surat', 'No_surat', 'keterangan_surat', 'kepada', 'Alamat', 'tanggal', 'tempat', 'kepala_desa'];
		$data_master_surat = $this->model_api_data_master_surat->find($id, $select_field);

		if (!$data_master_surat) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['data_master_surat'] = $data_master_surat;
		if ($data['data_master_surat']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data master surat',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data master surat not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_master_surat/add Add Data master surat.
	 * @apiVersion 0.1.0
	 * @apiName AddData master surat
	 * @apiGroup data_master_surat
	 * @apiHeader {String} X-Api-Key Data master surats unique access-key.
	 * @apiHeader {String} X-Token Data master surats unique token.
	 * @apiPermission Data master surat Cant be Accessed permission name : api_data_master_surat_add
	 *
 	 * @apiParam {String} No_surat Mandatory No_surat of Data master surats. Input No Surat Max Length : 255. 
	 * @apiParam {String} Keterangan_surat Mandatory keterangan_surat of Data master surats.  
	 * @apiParam {String} Kepada Mandatory kepada of Data master surats. Input Kepada Max Length : 255. 
	 * @apiParam {String} Alamat Mandatory Alamat of Data master surats.  
	 * @apiParam {String} Tanggal Mandatory tanggal of Data master surats.  
	 * @apiParam {String} Tempat Mandatory tempat of Data master surats.  
	 * @apiParam {String} Kepala_desa Mandatory kepala_desa of Data master surats. Input Kepala Desa Max Length : 11. 
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
		$this->is_allowed('api_data_master_surat_add');

		$this->form_validation->set_rules('No_surat', 'No Surat', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('keterangan_surat', 'Keterangan Surat', 'trim|required');
		$this->form_validation->set_rules('kepada', 'Kepada', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('Alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim|required');
		$this->form_validation->set_rules('kepala_desa', 'Kepala Desa', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'No_surat' => $this->input->post('No_surat'),
				'keterangan_surat' => $this->input->post('keterangan_surat'),
				'kepada' => $this->input->post('kepada'),
				'Alamat' => $this->input->post('Alamat'),
				'tanggal' => $this->input->post('tanggal'),
				'tempat' => $this->input->post('tempat'),
				'kepala_desa' => $this->input->post('kepala_desa'),
			];
			
			$save_data_master_surat = $this->model_api_data_master_surat->store($save_data);

			if ($save_data_master_surat) {
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
	 * @api {post} /data_master_surat/update Update Data master surat.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData master surat
	 * @apiGroup data_master_surat
	 * @apiHeader {String} X-Api-Key Data master surats unique access-key.
	 * @apiHeader {String} X-Token Data master surats unique token.
	 * @apiPermission Data master surat Cant be Accessed permission name : api_data_master_surat_update
	 *
	 * @apiParam {String} No_surat Mandatory No_surat of Data master surats. Input No Surat Max Length : 255. 
	 * @apiParam {String} Keterangan_surat Mandatory keterangan_surat of Data master surats.  
	 * @apiParam {String} Kepada Mandatory kepada of Data master surats. Input Kepada Max Length : 255. 
	 * @apiParam {String} Alamat Mandatory Alamat of Data master surats.  
	 * @apiParam {String} Tanggal Mandatory tanggal of Data master surats.  
	 * @apiParam {String} Tempat Mandatory tempat of Data master surats.  
	 * @apiParam {String} Kepala_desa Mandatory kepala_desa of Data master surats. Input Kepala Desa Max Length : 11. 
	 * @apiParam {Integer} id_surat Mandatory id_surat of Data Master Surat.
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
		$this->is_allowed('api_data_master_surat_update');

		
		$this->form_validation->set_rules('No_surat', 'No Surat', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('keterangan_surat', 'Keterangan Surat', 'trim|required');
		$this->form_validation->set_rules('kepada', 'Kepada', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('Alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim|required');
		$this->form_validation->set_rules('kepala_desa', 'Kepala Desa', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'No_surat' => $this->input->post('No_surat'),
				'keterangan_surat' => $this->input->post('keterangan_surat'),
				'kepada' => $this->input->post('kepada'),
				'Alamat' => $this->input->post('Alamat'),
				'tanggal' => $this->input->post('tanggal'),
				'tempat' => $this->input->post('tempat'),
				'kepala_desa' => $this->input->post('kepala_desa'),
			];
			
			$save_data_master_surat = $this->model_api_data_master_surat->change($this->post('id_surat'), $save_data);

			if ($save_data_master_surat) {
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
	 * @api {post} /data_master_surat/delete Delete Data master surat. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData master surat
	 * @apiGroup data_master_surat
	 * @apiHeader {String} X-Api-Key Data master surats unique access-key.
	 * @apiHeader {String} X-Token Data master surats unique token.
	 	 * @apiPermission Data master surat Cant be Accessed permission name : api_data_master_surat_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data master surats .
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
		$this->is_allowed('api_data_master_surat_delete');

		$data_master_surat = $this->model_api_data_master_surat->find($this->post('id_surat'));

		if (!$data_master_surat) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data master surat not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_master_surat->remove($this->post('id_surat'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data master surat deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data master surat not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Data master surat.php */
/* Location: ./application/controllers/api/Data master surat.php */
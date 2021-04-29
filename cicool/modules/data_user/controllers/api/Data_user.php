<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Data_user extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_data_user');
	}

	/**
	 * @api {get} /data_user/all Get all data_users.
	 * @apiVersion 0.1.0
	 * @apiName AllDatauser 
	 * @apiGroup data_user
	 * @apiHeader {String} X-Api-Key Data users unique access-key.
	 * @apiHeader {String} X-Token Data users unique token.
	 * @apiPermission Data user Cant be Accessed permission name : api_data_user_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Data users.
	 * @apiParam {String} [Field="All Field"] Optional field of Data users : id_user, password, nik.
	 * @apiParam {String} [Start=0] Optional start index of Data users.
	 * @apiParam {String} [Limit=10] Optional limit data of Data users.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_user.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataData user Data user data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_data_user_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id_user', 'password', 'nik'];
		$data_users = $this->model_api_data_user->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_data_user->count_all($filter, $field);
		$data_users = array_map(function($row){
						
			return $row;
		}, $data_users);

		$data['data_user'] = $data_users;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Data user',
			'data'	 	=> $data,
			'total' 	=> $total,
		], API::HTTP_OK);
	}

		/**
	 * @api {get} /data_user/detail Detail Data user.
	 * @apiVersion 0.1.0
	 * @apiName DetailData user
	 * @apiGroup data_user
	 * @apiHeader {String} X-Api-Key Data users unique access-key.
	 * @apiHeader {String} X-Token Data users unique token.
	 * @apiPermission Data user Cant be Accessed permission name : api_data_user_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Data users.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of data_user.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Data userNotFound Data user data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_data_user_detail');

		$this->requiredInput(['id_user']);

		$id = $this->get('id_user');

		$select_field = ['id_user', 'password', 'nik'];
		$data_user = $this->model_api_data_user->find($id, $select_field);

		if (!$data_user) {
			$this->response([
					'status' 	=> false,
					'message' 	=> 'Blog not found'
				], API::HTTP_NOT_FOUND);
		}

					
		$data['data_user'] = $data_user;
		if ($data['data_user']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Data user',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data user not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /data_user/add Add Data user.
	 * @apiVersion 0.1.0
	 * @apiName AddData user
	 * @apiGroup data_user
	 * @apiHeader {String} X-Api-Key Data users unique access-key.
	 * @apiHeader {String} X-Token Data users unique token.
	 * @apiPermission Data user Cant be Accessed permission name : api_data_user_add
	 *
 	 * @apiParam {String} Password Mandatory password of Data users. Input Password Max Length : 255. 
	 * @apiParam {String} Nik Mandatory nik of Data users. Input Nik Max Length : 255. 
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
		$this->is_allowed('api_data_user_add');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'password' => $this->input->post('password'),
				'nik' => $this->input->post('nik'),
			];
			
			$save_data_user = $this->model_api_data_user->store($save_data);

			if ($save_data_user) {
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
	 * @api {post} /data_user/update Update Data user.
	 * @apiVersion 0.1.0
	 * @apiName UpdateData user
	 * @apiGroup data_user
	 * @apiHeader {String} X-Api-Key Data users unique access-key.
	 * @apiHeader {String} X-Token Data users unique token.
	 * @apiPermission Data user Cant be Accessed permission name : api_data_user_update
	 *
	 * @apiParam {String} Password Mandatory password of Data users. Input Password Max Length : 255. 
	 * @apiParam {String} Nik Mandatory nik of Data users. Input Nik Max Length : 255. 
	 * @apiParam {Integer} id_user Mandatory id_user of Data User.
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
		$this->is_allowed('api_data_user_update');

		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'password' => $this->input->post('password'),
				'nik' => $this->input->post('nik'),
			];
			
			$save_data_user = $this->model_api_data_user->change($this->post('id_user'), $save_data);

			if ($save_data_user) {
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
	 * @api {post} /data_user/delete Delete Data user. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteData user
	 * @apiGroup data_user
	 * @apiHeader {String} X-Api-Key Data users unique access-key.
	 * @apiHeader {String} X-Token Data users unique token.
	 	 * @apiPermission Data user Cant be Accessed permission name : api_data_user_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Data users .
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
		$this->is_allowed('api_data_user_delete');

		$data_user = $this->model_api_data_user->find($this->post('id_user'));

		if (!$data_user) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data user not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_data_user->remove($this->post('id_user'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Data user deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Data user not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
}

/* End of file Data user.php */
/* Location: ./application/controllers/api/Data user.php */
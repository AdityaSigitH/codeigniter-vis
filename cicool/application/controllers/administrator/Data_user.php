<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Data User Controller
*| --------------------------------------------------------------------------
*| Data User site
*|
*/
class Data_user extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_data_user');
	}

	/**
	* show all Data Users
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('data_user_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['data_users'] = $this->model_data_user->get($filter, $field, $this->limit_page, $offset);
		$this->data['data_user_counts'] = $this->model_data_user->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/data_user/index/',
			'total_rows'   => $this->model_data_user->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data User List');
		$this->render('backend/standart/administrator/data_user/data_user_list', $this->data);
	}
	
	/**
	* Add new data_users
	*
	*/
	public function add()
	{
		$this->is_allowed('data_user_add');

		$this->template->title('Data User New');
		$this->render('backend/standart/administrator/data_user/data_user_add', $this->data);
	}

	/**
	* Add New Data Users
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('data_user_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'password' => $this->input->post('password'),
				'nik' => $this->input->post('nik'),
			];

			
			$save_data_user = $this->model_data_user->store($save_data);

			if ($save_data_user) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_data_user;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/data_user/edit/' . $save_data_user, 'Edit Data User'),
						anchor('administrator/data_user', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/data_user/edit/' . $save_data_user, 'Edit Data User')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_user');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_user');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Data Users
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('data_user_update');

		$this->data['data_user'] = $this->model_data_user->find($id);

		$this->template->title('Data User Update');
		$this->render('backend/standart/administrator/data_user/data_user_update', $this->data);
	}

	/**
	* Update Data Users
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('data_user_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'password' => $this->input->post('password'),
				'nik' => $this->input->post('nik'),
			];

			
			$save_data_user = $this->model_data_user->change($id, $save_data);

			if ($save_data_user) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/data_user', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_user');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_user');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Data Users
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('data_user_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'data_user'), 'success');
        } else {
            set_message(cclang('error_delete', 'data_user'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Data Users
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('data_user_view');

		$this->data['data_user'] = $this->model_data_user->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data User Detail');
		$this->render('backend/standart/administrator/data_user/data_user_view', $this->data);
	}
	
	/**
	* delete Data Users
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$data_user = $this->model_data_user->find($id);

		
		
		return $this->model_data_user->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('data_user_export');

		$this->model_data_user->export('data_user', 'data_user');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('data_user_export');

		$this->model_data_user->pdf('data_user', 'data_user');
	}
}


/* End of file data_user.php */
/* Location: ./application/controllers/administrator/Data User.php */
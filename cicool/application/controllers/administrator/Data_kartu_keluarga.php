<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Data Kartu Keluarga Controller
*| --------------------------------------------------------------------------
*| Data Kartu Keluarga site
*|
*/
class Data_kartu_keluarga extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_data_kartu_keluarga');
	}

	/**
	* show all Data Kartu Keluargas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('data_kartu_keluarga_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['data_kartu_keluargas'] = $this->model_data_kartu_keluarga->get($filter, $field, $this->limit_page, $offset);
		$this->data['data_kartu_keluarga_counts'] = $this->model_data_kartu_keluarga->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/data_kartu_keluarga/index/',
			'total_rows'   => $this->model_data_kartu_keluarga->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Kartu Keluarga List');
		$this->render('backend/standart/administrator/data_kartu_keluarga/data_kartu_keluarga_list', $this->data);
	}
	
	/**
	* Add new data_kartu_keluargas
	*
	*/
	public function add()
	{
		$this->is_allowed('data_kartu_keluarga_add');

		$this->template->title('Data Kartu Keluarga New');
		$this->render('backend/standart/administrator/data_kartu_keluarga/data_kartu_keluarga_add', $this->data);
	}

	/**
	* Add New Data Kartu Keluargas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('data_kartu_keluarga_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik' => $this->input->post('nik'),
			];

			
			$save_data_kartu_keluarga = $this->model_data_kartu_keluarga->store($save_data);

			if ($save_data_kartu_keluarga) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_data_kartu_keluarga;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/data_kartu_keluarga/edit/' . $save_data_kartu_keluarga, 'Edit Data Kartu Keluarga'),
						anchor('administrator/data_kartu_keluarga', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/data_kartu_keluarga/edit/' . $save_data_kartu_keluarga, 'Edit Data Kartu Keluarga')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_kartu_keluarga');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_kartu_keluarga');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Data Kartu Keluargas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('data_kartu_keluarga_update');

		$this->data['data_kartu_keluarga'] = $this->model_data_kartu_keluarga->find($id);

		$this->template->title('Data Kartu Keluarga Update');
		$this->render('backend/standart/administrator/data_kartu_keluarga/data_kartu_keluarga_update', $this->data);
	}

	/**
	* Update Data Kartu Keluargas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('data_kartu_keluarga_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik' => $this->input->post('nik'),
			];

			
			$save_data_kartu_keluarga = $this->model_data_kartu_keluarga->change($id, $save_data);

			if ($save_data_kartu_keluarga) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/data_kartu_keluarga', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_kartu_keluarga');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_kartu_keluarga');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Data Kartu Keluargas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('data_kartu_keluarga_delete');

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
            set_message(cclang('has_been_deleted', 'data_kartu_keluarga'), 'success');
        } else {
            set_message(cclang('error_delete', 'data_kartu_keluarga'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Data Kartu Keluargas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('data_kartu_keluarga_view');

		$this->data['data_kartu_keluarga'] = $this->model_data_kartu_keluarga->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data Kartu Keluarga Detail');
		$this->render('backend/standart/administrator/data_kartu_keluarga/data_kartu_keluarga_view', $this->data);
	}
	
	/**
	* delete Data Kartu Keluargas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$data_kartu_keluarga = $this->model_data_kartu_keluarga->find($id);

		
		
		return $this->model_data_kartu_keluarga->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('data_kartu_keluarga_export');

		$this->model_data_kartu_keluarga->export('data_kartu_keluarga', 'data_kartu_keluarga');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('data_kartu_keluarga_export');

		$this->model_data_kartu_keluarga->pdf('data_kartu_keluarga', 'data_kartu_keluarga');
	}
}


/* End of file data_kartu_keluarga.php */
/* Location: ./application/controllers/administrator/Data Kartu Keluarga.php */
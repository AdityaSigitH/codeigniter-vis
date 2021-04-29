<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Data Surat Keluar Controller
*| --------------------------------------------------------------------------
*| Data Surat Keluar site
*|
*/
class Data_surat_keluar extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_data_surat_keluar');
	}

	/**
	* show all Data Surat Keluars
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('data_surat_keluar_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['data_surat_keluars'] = $this->model_data_surat_keluar->get($filter, $field, $this->limit_page, $offset);
		$this->data['data_surat_keluar_counts'] = $this->model_data_surat_keluar->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/data_surat_keluar/index/',
			'total_rows'   => $this->model_data_surat_keluar->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Surat Keluar List');
		$this->render('backend/standart/administrator/data_surat_keluar/data_surat_keluar_list', $this->data);
	}
	
	/**
	* Add new data_surat_keluars
	*
	*/
	public function add()
	{
		$this->is_allowed('data_surat_keluar_add');

		$this->template->title('Data Surat Keluar New');
		$this->render('backend/standart/administrator/data_surat_keluar/data_surat_keluar_add', $this->data);
	}

	/**
	* Add New Data Surat Keluars
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('data_surat_keluar_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('id_surat_keluar', 'Id Surat Keluar', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tgl_keluar', 'Tgl Keluar', 'trim|required');
		$this->form_validation->set_rules('Perihal', 'Perihal', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_surat_keluar' => $this->input->post('id_surat_keluar'),
				'tgl_keluar' => $this->input->post('tgl_keluar'),
				'Perihal' => $this->input->post('Perihal'),
			];

			
			$save_data_surat_keluar = $this->model_data_surat_keluar->store($save_data);

			if ($save_data_surat_keluar) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_data_surat_keluar;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/data_surat_keluar/edit/' . $save_data_surat_keluar, 'Edit Data Surat Keluar'),
						anchor('administrator/data_surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/data_surat_keluar/edit/' . $save_data_surat_keluar, 'Edit Data Surat Keluar')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_surat_keluar');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_surat_keluar');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Data Surat Keluars
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('data_surat_keluar_update');

		$this->data['data_surat_keluar'] = $this->model_data_surat_keluar->find($id);

		$this->template->title('Data Surat Keluar Update');
		$this->render('backend/standart/administrator/data_surat_keluar/data_surat_keluar_update', $this->data);
	}

	/**
	* Update Data Surat Keluars
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('data_surat_keluar_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('id_surat_keluar', 'Id Surat Keluar', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tgl_keluar', 'Tgl Keluar', 'trim|required');
		$this->form_validation->set_rules('Perihal', 'Perihal', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_surat_keluar' => $this->input->post('id_surat_keluar'),
				'tgl_keluar' => $this->input->post('tgl_keluar'),
				'Perihal' => $this->input->post('Perihal'),
			];

			
			$save_data_surat_keluar = $this->model_data_surat_keluar->change($id, $save_data);

			if ($save_data_surat_keluar) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/data_surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_surat_keluar');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_surat_keluar');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Data Surat Keluars
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('data_surat_keluar_delete');

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
            set_message(cclang('has_been_deleted', 'data_surat_keluar'), 'success');
        } else {
            set_message(cclang('error_delete', 'data_surat_keluar'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Data Surat Keluars
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('data_surat_keluar_view');

		$this->data['data_surat_keluar'] = $this->model_data_surat_keluar->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data Surat Keluar Detail');
		$this->render('backend/standart/administrator/data_surat_keluar/data_surat_keluar_view', $this->data);
	}
	
	/**
	* delete Data Surat Keluars
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$data_surat_keluar = $this->model_data_surat_keluar->find($id);

		
		
		return $this->model_data_surat_keluar->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('data_surat_keluar_export');

		$this->model_data_surat_keluar->export('data_surat_keluar', 'data_surat_keluar');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('data_surat_keluar_export');

		$this->model_data_surat_keluar->pdf('data_surat_keluar', 'data_surat_keluar');
	}
}


/* End of file data_surat_keluar.php */
/* Location: ./application/controllers/administrator/Data Surat Keluar.php */
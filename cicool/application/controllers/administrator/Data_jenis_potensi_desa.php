<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Data Jenis Potensi Desa Controller
*| --------------------------------------------------------------------------
*| Data Jenis Potensi Desa site
*|
*/
class Data_jenis_potensi_desa extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_data_jenis_potensi_desa');
	}

	/**
	* show all Data Jenis Potensi Desas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('data_jenis_potensi_desa_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['data_jenis_potensi_desas'] = $this->model_data_jenis_potensi_desa->get($filter, $field, $this->limit_page, $offset);
		$this->data['data_jenis_potensi_desa_counts'] = $this->model_data_jenis_potensi_desa->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/data_jenis_potensi_desa/index/',
			'total_rows'   => $this->model_data_jenis_potensi_desa->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Jenis Potensi Desa List');
		$this->render('backend/standart/administrator/data_jenis_potensi_desa/data_jenis_potensi_desa_list', $this->data);
	}
	
	/**
	* Add new data_jenis_potensi_desas
	*
	*/
	public function add()
	{
		$this->is_allowed('data_jenis_potensi_desa_add');

		$this->template->title('Data Jenis Potensi Desa New');
		$this->render('backend/standart/administrator/data_jenis_potensi_desa/data_jenis_potensi_desa_add', $this->data);
	}

	/**
	* Add New Data Jenis Potensi Desas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('data_jenis_potensi_desa_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_potensi', 'Nama Potensi', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_potensi' => $this->input->post('nama_potensi'),
			];

			
			$save_data_jenis_potensi_desa = $this->model_data_jenis_potensi_desa->store($save_data);

			if ($save_data_jenis_potensi_desa) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_data_jenis_potensi_desa;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/data_jenis_potensi_desa/edit/' . $save_data_jenis_potensi_desa, 'Edit Data Jenis Potensi Desa'),
						anchor('administrator/data_jenis_potensi_desa', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/data_jenis_potensi_desa/edit/' . $save_data_jenis_potensi_desa, 'Edit Data Jenis Potensi Desa')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_jenis_potensi_desa');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_jenis_potensi_desa');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Data Jenis Potensi Desas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('data_jenis_potensi_desa_update');

		$this->data['data_jenis_potensi_desa'] = $this->model_data_jenis_potensi_desa->find($id);

		$this->template->title('Data Jenis Potensi Desa Update');
		$this->render('backend/standart/administrator/data_jenis_potensi_desa/data_jenis_potensi_desa_update', $this->data);
	}

	/**
	* Update Data Jenis Potensi Desas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('data_jenis_potensi_desa_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_potensi', 'Nama Potensi', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_potensi' => $this->input->post('nama_potensi'),
			];

			
			$save_data_jenis_potensi_desa = $this->model_data_jenis_potensi_desa->change($id, $save_data);

			if ($save_data_jenis_potensi_desa) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/data_jenis_potensi_desa', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_jenis_potensi_desa');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_jenis_potensi_desa');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Data Jenis Potensi Desas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('data_jenis_potensi_desa_delete');

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
            set_message(cclang('has_been_deleted', 'data_jenis_potensi_desa'), 'success');
        } else {
            set_message(cclang('error_delete', 'data_jenis_potensi_desa'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Data Jenis Potensi Desas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('data_jenis_potensi_desa_view');

		$this->data['data_jenis_potensi_desa'] = $this->model_data_jenis_potensi_desa->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data Jenis Potensi Desa Detail');
		$this->render('backend/standart/administrator/data_jenis_potensi_desa/data_jenis_potensi_desa_view', $this->data);
	}
	
	/**
	* delete Data Jenis Potensi Desas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$data_jenis_potensi_desa = $this->model_data_jenis_potensi_desa->find($id);

		
		
		return $this->model_data_jenis_potensi_desa->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('data_jenis_potensi_desa_export');

		$this->model_data_jenis_potensi_desa->export('data_jenis_potensi_desa', 'data_jenis_potensi_desa');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('data_jenis_potensi_desa_export');

		$this->model_data_jenis_potensi_desa->pdf('data_jenis_potensi_desa', 'data_jenis_potensi_desa');
	}
}


/* End of file data_jenis_potensi_desa.php */
/* Location: ./application/controllers/administrator/Data Jenis Potensi Desa.php */
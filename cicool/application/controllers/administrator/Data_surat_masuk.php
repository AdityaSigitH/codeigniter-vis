<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Data Surat Masuk Controller
*| --------------------------------------------------------------------------
*| Data Surat Masuk site
*|
*/
class Data_surat_masuk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_data_surat_masuk');
	}

	/**
	* show all Data Surat Masuks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('data_surat_masuk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['data_surat_masuks'] = $this->model_data_surat_masuk->get($filter, $field, $this->limit_page, $offset);
		$this->data['data_surat_masuk_counts'] = $this->model_data_surat_masuk->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/data_surat_masuk/index/',
			'total_rows'   => $this->model_data_surat_masuk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Surat Masuk List');
		$this->render('backend/standart/administrator/data_surat_masuk/data_surat_masuk_list', $this->data);
	}
	
	/**
	* Add new data_surat_masuks
	*
	*/
	public function add()
	{
		$this->is_allowed('data_surat_masuk_add');

		$this->template->title('Data Surat Masuk New');
		$this->render('backend/standart/administrator/data_surat_masuk/data_surat_masuk_add', $this->data);
	}

	/**
	* Add New Data Surat Masuks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('data_surat_masuk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('id_jenis_surat', 'Id Jenis Surat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tgl_masuk', 'Tgl Masuk', 'trim|required');
		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_jenis_surat' => $this->input->post('id_jenis_surat'),
				'tgl_masuk' => $this->input->post('tgl_masuk'),
				'perihal' => $this->input->post('perihal'),
			];

			
			$save_data_surat_masuk = $this->model_data_surat_masuk->store($save_data);

			if ($save_data_surat_masuk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_data_surat_masuk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/data_surat_masuk/edit/' . $save_data_surat_masuk, 'Edit Data Surat Masuk'),
						anchor('administrator/data_surat_masuk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/data_surat_masuk/edit/' . $save_data_surat_masuk, 'Edit Data Surat Masuk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_surat_masuk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_surat_masuk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Data Surat Masuks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('data_surat_masuk_update');

		$this->data['data_surat_masuk'] = $this->model_data_surat_masuk->find($id);

		$this->template->title('Data Surat Masuk Update');
		$this->render('backend/standart/administrator/data_surat_masuk/data_surat_masuk_update', $this->data);
	}

	/**
	* Update Data Surat Masuks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('data_surat_masuk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('id_jenis_surat', 'Id Jenis Surat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tgl_masuk', 'Tgl Masuk', 'trim|required');
		$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_jenis_surat' => $this->input->post('id_jenis_surat'),
				'tgl_masuk' => $this->input->post('tgl_masuk'),
				'perihal' => $this->input->post('perihal'),
			];

			
			$save_data_surat_masuk = $this->model_data_surat_masuk->change($id, $save_data);

			if ($save_data_surat_masuk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/data_surat_masuk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_surat_masuk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_surat_masuk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Data Surat Masuks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('data_surat_masuk_delete');

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
            set_message(cclang('has_been_deleted', 'data_surat_masuk'), 'success');
        } else {
            set_message(cclang('error_delete', 'data_surat_masuk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Data Surat Masuks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('data_surat_masuk_view');

		$this->data['data_surat_masuk'] = $this->model_data_surat_masuk->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data Surat Masuk Detail');
		$this->render('backend/standart/administrator/data_surat_masuk/data_surat_masuk_view', $this->data);
	}
	
	/**
	* delete Data Surat Masuks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$data_surat_masuk = $this->model_data_surat_masuk->find($id);

		
		
		return $this->model_data_surat_masuk->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('data_surat_masuk_export');

		$this->model_data_surat_masuk->export('data_surat_masuk', 'data_surat_masuk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('data_surat_masuk_export');

		$this->model_data_surat_masuk->pdf('data_surat_masuk', 'data_surat_masuk');
	}
}


/* End of file data_surat_masuk.php */
/* Location: ./application/controllers/administrator/Data Surat Masuk.php */
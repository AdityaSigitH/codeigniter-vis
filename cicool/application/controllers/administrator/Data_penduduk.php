<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Data Penduduk Controller
*| --------------------------------------------------------------------------
*| Data Penduduk site
*|
*/
class Data_penduduk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_data_penduduk');
	}

	/**
	* show all Data Penduduks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('data_penduduk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['data_penduduks'] = $this->model_data_penduduk->get($filter, $field, $this->limit_page, $offset);
		$this->data['data_penduduk_counts'] = $this->model_data_penduduk->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/data_penduduk/index/',
			'total_rows'   => $this->model_data_penduduk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Penduduk List');
		$this->render('backend/standart/administrator/data_penduduk/data_penduduk_list', $this->data);
	}
	
	/**
	* Add new data_penduduks
	*
	*/
	public function add()
	{
		$this->is_allowed('data_penduduk_add');

		$this->template->title('Data Penduduk New');
		$this->render('backend/standart/administrator/data_penduduk/data_penduduk_add', $this->data);
	}

	/**
	* Add New Data Penduduks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('data_penduduk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_penduduk', 'Nama Penduduk', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat_penduduk', 'Alamat Penduduk', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'nama_penduduk' => $this->input->post('nama_penduduk'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat_penduduk' => $this->input->post('alamat_penduduk'),
			];

			
			$save_data_penduduk = $this->model_data_penduduk->store($save_data);

			if ($save_data_penduduk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_data_penduduk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/data_penduduk/edit/' . $save_data_penduduk, 'Edit Data Penduduk'),
						anchor('administrator/data_penduduk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/data_penduduk/edit/' . $save_data_penduduk, 'Edit Data Penduduk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_penduduk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_penduduk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Data Penduduks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('data_penduduk_update');

		$this->data['data_penduduk'] = $this->model_data_penduduk->find($id);

		$this->template->title('Data Penduduk Update');
		$this->render('backend/standart/administrator/data_penduduk/data_penduduk_update', $this->data);
	}

	/**
	* Update Data Penduduks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('data_penduduk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_penduduk', 'Nama Penduduk', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat_penduduk', 'Alamat Penduduk', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'nama_penduduk' => $this->input->post('nama_penduduk'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat_penduduk' => $this->input->post('alamat_penduduk'),
			];

			
			$save_data_penduduk = $this->model_data_penduduk->change($id, $save_data);

			if ($save_data_penduduk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/data_penduduk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/data_penduduk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/data_penduduk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Data Penduduks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('data_penduduk_delete');

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
            set_message(cclang('has_been_deleted', 'data_penduduk'), 'success');
        } else {
            set_message(cclang('error_delete', 'data_penduduk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Data Penduduks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('data_penduduk_view');

		$this->data['data_penduduk'] = $this->model_data_penduduk->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data Penduduk Detail');
		$this->render('backend/standart/administrator/data_penduduk/data_penduduk_view', $this->data);
	}
	
	/**
	* delete Data Penduduks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$data_penduduk = $this->model_data_penduduk->find($id);

		
		
		return $this->model_data_penduduk->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('data_penduduk_export');

		$this->model_data_penduduk->export('data_penduduk', 'data_penduduk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('data_penduduk_export');

		$this->model_data_penduduk->pdf('data_penduduk', 'data_penduduk');
	}
}


/* End of file data_penduduk.php */
/* Location: ./application/controllers/administrator/Data Penduduk.php */
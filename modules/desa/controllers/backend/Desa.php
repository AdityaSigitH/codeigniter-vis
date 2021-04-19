<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Desa Controller
*| --------------------------------------------------------------------------
*| Desa site
*|
*/
class Desa extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_desa');
		$this->load->model('group/model_group');
		$this->lang->load('web_lang', $this->current_lang);
	}

	/**
	* show all Desas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('desa_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['desas'] = $this->model_desa->get($filter, $field, $this->limit_page, $offset);
		$this->data['desa_counts'] = $this->model_desa->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/desa/index/',
			'total_rows'   => $this->data['desa_counts'],
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Desa List');
		$this->render('backend/standart/administrator/desa/desa_list', $this->data);
	}
	
	/**
	* Add new desas
	*
	*/
	public function add()
	{
		$this->is_allowed('desa_add');

		$this->template->title('Desa New');
		$this->render('backend/standart/administrator/desa/desa_add', $this->data);
	}

	/**
	* Add New Desas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('desa_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		

		$this->form_validation->set_rules('desa', 'Desa', 'trim|required|max_length[255]');
		

		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'desa' => $this->input->post('desa'),
				'deskripsi' => $this->input->post('deskripsi'),
			];

			
			
			$save_desa = $this->model_desa->store($save_data);
            

			if ($save_desa) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_desa;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/desa/edit/' . $save_desa, 'Edit Desa'),
						anchor('administrator/desa', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/desa/edit/' . $save_desa, 'Edit Desa')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/desa');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/desa');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = 'Opss validation failed';
			$this->data['errors'] = $this->form_validation->error_array();
		}

		$this->response($this->data);
	}
	
		/**
	* Update view Desas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('desa_update');

		$this->data['desa'] = $this->model_desa->find($id);

		$this->template->title('Desa Update');
		$this->render('backend/standart/administrator/desa/desa_update', $this->data);
	}

	/**
	* Update Desas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('desa_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
				$this->form_validation->set_rules('desa', 'Desa', 'trim|required|max_length[255]');
		

		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		

		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'desa' => $this->input->post('desa'),
				'deskripsi' => $this->input->post('deskripsi'),
			];


			
			
			$save_desa = $this->model_desa->change($id, $save_data);

			if ($save_desa) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/desa', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/desa');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/desa');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = 'Opss validation failed';
			$this->data['errors'] = $this->form_validation->error_array();
		}

		$this->response($this->data);
	}
	
	/**
	* delete Desas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('desa_delete');

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
            set_message(cclang('has_been_deleted', 'desa'), 'success');
        } else {
            set_message(cclang('error_delete', 'desa'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Desas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('desa_view');

		$this->data['desa'] = $this->model_desa->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Desa Detail');
		$this->render('backend/standart/administrator/desa/desa_view', $this->data);
	}
	
	/**
	* delete Desas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$desa = $this->model_desa->find($id);

		
		
		return $this->model_desa->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('desa_export');

		$this->model_desa->export(
			'desa', 
			'desa',
			$this->model_desa->field_search
		);
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('desa_export');

		$this->model_desa->pdf('desa', 'desa');
	}


	public function single_pdf($id = null)
	{
		$this->is_allowed('desa_export');

		$table = $title = 'desa';
		$this->load->library('HtmlPdf');
      
        $config = array(
            'orientation' => 'p',
            'format' => 'a4',
            'marges' => array(5, 5, 5, 5)
        );

        $this->pdf = new HtmlPdf($config);
        $this->pdf->setDefaultFont('stsongstdlight'); 

        $result = $this->db->get($table);
       
        $data = $this->model_desa->find($id);
        $fields = $result->list_fields();

        $content = $this->pdf->loadHtmlPdf('core_template/pdf/pdf_single', [
            'data' => $data,
            'fields' => $fields,
            'title' => $title
        ], TRUE);

        $this->pdf->initialize($config);
        $this->pdf->pdf->SetDisplayMode('fullpage');
        $this->pdf->writeHTML($content);
        $this->pdf->Output($table.'.pdf', 'H');
	}

	
}


/* End of file desa.php */
/* Location: ./application/controllers/administrator/Desa.php */
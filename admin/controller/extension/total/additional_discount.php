<?php
class ControllerExtensionTotalAdditionalDiscount extends Controller {
	private $error = array();

	public function index(){
		$this->load->language('extension/total/additional_discount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('total_additional_discount', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=total', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_group'] = $this->language->get('text_all_group');
		$data['text_percentage'] = $this->language->get('text_percentage');
		$data['text_fixed'] = $this->language->get('text_fixed');
		
		$data['text_default'] = $this->language->get('text_default');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_discount_type'] = $this->language->get('entry_discount_type');
		$data['entry_discount'] = $this->language->get('entry_discount');
		$data['entry_action'] = $this->language->get('entry_action');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_discount_add'] = $this->language->get('button_discount_add');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			if (isset($this->error['title' . $language['language_id']])) {
				$data['error_title' . $language['language_id']] = $this->error['title' . $language['language_id']];
			} else {
				$data['error_title' . $language['language_id']] = '';
			}
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=total', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/total/additional_discount', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['action'] = $this->url->link('extension/total/additional_discount', 'user_token=' . $this->session->data['user_token'], 'SSL');

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=total', true);
		
		foreach ($languages as $language) {
			if (isset($this->request->post['total_additional_discount_title' . $language['language_id']])) {
				$data['total_additional_discount_title'][$language['language_id']] = $this->request->post['total_additional_discount_title' . $language['language_id']];
			} else {
				$data['total_additional_discount_title'][$language['language_id']] = $this->config->get('total_additional_discount_title' . $language['language_id']);
			}
		}
		
		
		$data['languages'] = $languages;

		if (isset($this->request->post['total_additional_discount_status'])) {
			$data['total_additional_discount_status'] = $this->request->post['total_additional_discount_status'];
		} else {
			$data['total_additional_discount_status'] = $this->config->get('total_additional_discount_status');
		}
		
		if (isset($this->request->post['total_additional_discount_array'])) {
			$data['total_additional_discount_array'] = $this->request->post['total_additional_discount_array'];
		}elseif($this->config->get('total_additional_discount_array')){
			$data['total_additional_discount_array'] = $this->config->get('total_additional_discount_array');
		}else {
			$data['total_additional_discount_array'] = array();
		}
		
		if (isset($this->request->post['total_additional_discount_sort_order'])) {
			$data['total_additional_discount_sort_order'] = $this->request->post['total_additional_discount_sort_order'];
		} else {
			$data['total_additional_discount_sort_order'] = $this->config->get('total_additional_discount_sort_order');
		}
		
		
		$this->load->model('customer/customer_group');
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups($filter_data=array());
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/total/additional_discount', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/total/additional_discount')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			if (empty($this->request->post['total_additional_discount_title' . $language['language_id']])) {
				$this->error['title' .  $language['language_id']] = $this->language->get('error_title');
			}
		}

		return !$this->error;
	}
}
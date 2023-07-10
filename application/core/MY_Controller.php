<?php
	class MY_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();

			// Auth check
			if (
				current_url() != base_url('admin/auth/login') && 
				current_url() != base_url('admin/TukdBank/update_status_pembayaran') && 
				current_url() != base_url('admin/TukdBank/update_status_pembayaran2') && 
				current_url() != base_url('admin/TukdBank/status_payment_pajak') && 
				current_url() != base_url('api/config_get') &&
				current_url() != base_url('api/noreff_get') && 
				current_url() != base_url('api/noreff_update') && 
				current_url() != base_url('admin/TukdBank/noreff_update') && 
				current_url() != base_url('admin/TukdBank/getPostObject'))  {
				$user_id = $this->session->userdata('user_id');
				if ($user_id) {
					$userCount = $this->db->where('user_id', $user_id)->count_all_results('ci_users');
					if ($userCount == 0) {
						$this->session->sess_destroy();
						redirect(base_url('admin/auth/login'));
					}
				} else {
					redirect(base_url('admin/auth/login'));
				}
			}

			$this->load->model('admin/setting_model', 'setting_model');

			//general settings

	        $global_data['general_settings'] = $this->setting_model->get_general_settings();

	        $this->general_settings = $global_data['general_settings'];

	        //set timezone

	        date_default_timezone_set($this->general_settings['timezone']);

	        //recaptcha status

	        $global_data['recaptcha_status'] = true;

	        if (empty($this->general_settings['recaptcha_site_key']) || empty($this->general_settings['recaptcha_secret_key'])) {

	            $global_data['recaptcha_status'] = false;

	        }

	        $this->recaptcha_status = $global_data['recaptcha_status'];

	        $site_language = ($this->general_settings['default_language'] != "")?$this->general_settings['default_language'] : "english";
			$language = ($this->session->userdata('site_lang') != "") ? $this->session->userdata('site_lang') : $site_language;
			$language = strtolower(get_lang_name_by_id($language));

			$this->config->set_item('language', $language);
			$this->lang->load(array('site'), $language);

		}

		//verify recaptcha
	    public function recaptcha_verify_request()
	    {
	        if (!$this->recaptcha_status) {
	            return true;
	        }

	        $this->load->library('recaptcha');
	        $recaptcha = $this->input->post('g-recaptcha-response');
	        if (!empty($recaptcha)) {
	            $response = $this->recaptcha->verifyResponse($recaptcha);
	            if (isset($response['success']) && $response['success'] === true) {
	                return true;
	            }
	        }
	        return false;
	    }

	}



?>



    
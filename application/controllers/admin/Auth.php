<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('mailer');
		$this->load->model('admin/auth_model', 'auth_model');
	}

	//--------------------------------------------------------------
	public function index()
	{

		
		if ($this->session->has_userdata('is_admin_login')) {
			redirect('admin/dashboard');
		} else {
			redirect('admin/auth/login');
		}
	}

	//--------------------------------------------------------------
	public function login()
	{
		
		if ($this->input->post('submit')) {
			$encryptedData = $this->input->post('data');
			$decoded = base64_decode($encryptedData);
			$private_key = $this->session->userdata('private_key');
			openssl_private_decrypt($decoded, $output, openssl_pkey_get_private($private_key, ''));
			$output = json_decode($output, true);
			$username = $output['username'];
			$password = $output['password'];
			$_POST['username'] = $username;
			$_POST['password'] = $password;
			// var_dump($output);
			// return;
			// $_POST['g-recaptcha-response'] = $output('g-recaptcha-response');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			$recaptcha = $this->input->post('g-recaptcha-response');
			$response = $this->recaptcha->verifyResponse($recaptcha);

			

			if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true ) {
				$data = array(
					'errors' => validation_errors()
				);
				

				$this->session->set_flashdata('Error', 'Sorry Google Recaptcha Unsuccessful!!');
				redirect(base_url('admin/auth/login'));
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$result = $this->auth_model->login($data);
				if ($result) {
					if ($result['is_verify'] == 0) {
						$this->session->set_flashdata('error', 'Please verify your email address!');
						redirect(base_url('admin/auth/login'));
						exit();
					}
					if ($result['is_active'] == 0) {
						$this->session->set_flashdata('error', 'Account is disabled by Admin!');
						redirect(base_url('admin/auth/login'));
						exit();
					}
					if ($result['is_admin'] == 1) {
						$admin_data = array(
							'user_id' => $result['user_id'],
							'username' => $result['username'],
							'admin_role_id' => $result['admin_role_id'],
							'admin_role' => $result['admin_role_title'],
							'is_supper' => $result['is_supper'],
							'name_user' => $result['firstname'].' '.$result['lastname'],
							'is_admin_login' => TRUE
						);
						$this->session->set_userdata($admin_data);
						$this->rbac->set_access_in_session(); // set access in session

						if ($result['is_supper'])
							redirect(base_url('admin/dashboard/index'), 'refresh');
						else
							redirect(base_url('admin/dashboard/index'), 'refresh');
					}
				} else {
					$this->session->set_flashdata('errors', 'Invalid Username or Password!');
					redirect(base_url('admin/auth/login'));
				}
			}
		} else {
			$data['title'] = 'Login';
			$data['navbar'] = false;
			$data['sidebar'] = false;
			$data['footer'] = false;
			$data['bg_cover'] = true;

			$config = [
				'config' => config_item('openssl_path'),
			];
			$res = openssl_pkey_new($config);
			openssl_pkey_export($res, $private_key, '', $config);
			$this->session->set_userdata('private_key', $private_key);
			$public_key = openssl_pkey_get_details($res)['key'];
			$data1=array(
				'captcha' => $this->recaptcha->getWidget(),
				'script_captcha' => $this->recaptcha->getScriptTag(),
				'public_key' => $public_key
			);
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('auth/login', $data1);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------------------------
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('admin/auth/login'), 'refresh');
	}

	public function cek_mac()
	{
		$full_address = exec('getmac');
		$full_address = strtok($full_address, ' ');
		echo "YOUR MAC address of client is: $full_address";
	}
}  // end class

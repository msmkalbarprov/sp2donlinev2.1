<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {
	
	public function __construct(){
		
		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/admin_model', 'admin_model');
	}

	//-------------------------------------------------------------------------
	public function index(){

		if($this->input->post('submit')){
            $pin = $this->input->post('pin');
            if ($pin!='871261'){
                $this->session->set_flashdata('errors', 'PIN Salah!');
				redirect(base_url('admin/setting'), 'refresh');
                return;
            }

			if ($this->input->post('clientid')=='' || $this->input->post('client_secret')=='' || $this->input->post('noreference')==''){
				$data = array(
					'nip' => $this->input->post('nip'),
					'nama' => $this->input->post('nama'),
					'nohp' => $this->input->post('nohp'),
					'email' => $this->input->post('email')
				);
			}else{
				$data = array(
					'nip' => $this->input->post('nip'),
					'nama' => $this->input->post('nama'),
					'nohp' => $this->input->post('nohp'),
					'email' => $this->input->post('email'),
					'client_id' => $this->encrypt->encode($this->input->post('clientid')),
					'client_secret' => $this->encrypt->encode($this->input->post('client_secret')),
					'reference_no' => $this->encrypt->encode($this->input->post('noreference'))
				);
			}
			
			$data = $this->security->xss_clean($data);
			$result = $this->admin_model->update_setting($data,$pin);
			if($result){
				$this->session->set_flashdata('success', 'Data has been Updated Successfully!');
				redirect(base_url('admin/setting'), 'refresh');
			}
		}
		else{

			$data['title'] = 'Setting';
			$data['admin'] = $this->admin_model->get_setting();
			
			$this->load->view('includes/_header');
			$this->load->view('pengaturan/index', $data);
			$this->load->view('includes/_footer');
		}
	}

}

?>	
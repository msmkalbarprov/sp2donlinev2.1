<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	public function get_user_detail(){
		$id = $this->session->userdata('user_id');
		$query = $this->db->get_where('ci_users', array('user_id' => $id));
		return $result = $query->row_array();
	}

	public function get_setting(){
		$query = $this->db->get('ci_setting');
		return $result = $query->row_array();
	}

	public function get_config(){
		$query = $this->db->get('ci_setting');
		return $query->result();
	}

	public function get_noreff(){
		$query = $this->db->get('noref_MPN');
		return $query->result();
	}

	public function update_noreff($data){
		$this->db->update('noref_MPN', $data);
		return true;
	}

	//--------------------------------------------------------------------
	public function update_user($data){
		$id = $this->session->userdata('user_id');
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}

	public function update_setting($data,$pin){
		$this->db->where('pin', $pin);
		$this->db->update('ci_setting', $data);
		return true;
	}
	//--------------------------------------------------------------------
	public function change_pwd($data, $id){
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}
	//-----------------------------------------------------
	function get_admin_roles()
	{
		$this->db->from('ci_admin_roles');
		$this->db->where('admin_role_status',1);
		$query=$this->db->get();
		return $query->result_array();
	}

	//-----------------------------------------------------
	function get_admin_by_id($id)
	{
		$this->db->from('ci_users');
		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id = ci_users.admin_role_id');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}

	//-----------------------------------------------------
	function get_all()
	{

		$this->db->from('ci_users');

		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_users.admin_role_id');

		if($this->session->userdata('filter_type')!='')

			$this->db->where('ci_users.admin_role_id',$this->session->userdata('filter_type'));

		if($this->session->userdata('filter_status')!='')

			$this->db->where('ci_users.is_active',$this->session->userdata('filter_status'));


		$filterData = $this->session->userdata('filter_keyword');

		$this->db->like('ci_admin_roles.admin_role_title',$filterData);
		$this->db->or_like('ci_users.firstname',$filterData);
		$this->db->or_like('ci_users.lastname',$filterData);
		$this->db->or_like('ci_users.email',$filterData);
		$this->db->or_like('ci_users.mobile_no',$filterData);
		$this->db->or_like('ci_users.username',$filterData);

		$this->db->where('ci_users.is_supper !=', 1);

		$this->db->order_by('ci_users.user_id','desc');

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}

		return $module;
	}

	//-----------------------------------------------------
public function add_admin($data){
	$this->db->insert('ci_users', $data);
	return true;
}

	//---------------------------------------------------
	// Edit Admin Record
public function edit_admin_user_password($data, $ids){
	//  		  $this->db->where($ids);
	//  $query = $this->db->update('ci_userss', $data);
				$update_data['admin_role_id'] 		= $data['admin_role_id'];
				$update_data['username'] 			= $data['username'];
				$update_data['firstname']			= $data['firstname'];
				$update_data['lastname'] 			= $data['lastname'];
				$update_data['email'] 				= $data['email'];
				$update_data['mobile_no'] 			= $data['mobile_no'];
				$update_data['password']			= $data['password'];
				$update_data['is_active']			= $data['is_active'];
				$update_data['updated_at']			= date("Y-m-d h:i:s");
				$this->db->where($ids);
				$this->db->update('ci_users', $update_data);
				return true;

}

public function edit_admin_user($data, $ids){
	//  		  $this->db->where($ids);
	//  $query = $this->db->update('ci_userss', $data);
				$update_data['admin_role_id'] 		= $data['admin_role_id'];
				$update_data['username'] 			= $data['username'];
				$update_data['firstname']			= $data['firstname'];
				$update_data['lastname'] 			= $data['lastname'];
				$update_data['email'] 				= $data['email'];
				$update_data['mobile_no'] 			= $data['mobile_no'];
				$update_data['is_active']			= $data['is_active'];
				$update_data['updated_at']			= date("Y-m-d h:i:s");
				$this->db->where($ids);
				$this->db->update('ci_users', $update_data);
				return true;
}

	//-----------------------------------------------------
function change_status()
{		
	$this->db->set('is_active',$this->input->post('status'));
	$this->db->where('user_id',$this->input->post('id'));
	$this->db->update('ci_users');
} 

	//-----------------------------------------------------
function delete($id)
{		
	$this->db->where('user_id',$id);
	$this->db->delete('ci_users');
} 

}

?>
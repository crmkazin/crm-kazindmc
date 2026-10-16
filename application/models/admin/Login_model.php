<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
	
	public function login(){
 		$this->db->where('email', $this->security->xss_clean($this->input->post('email')));
 		$this->db->where('password', $this->security->xss_clean($this->input->post('password')));
 		$this->db->where('status', 1);
 		$result = $this->db->get('admin');
 		return $result->row();	

		/*$this->db->select('admin.*,user_rights.userid,user_rights.products,user_rights.products_group,user_rights.organization,user_rights.enquiry,user_rights.quotations,user_rights.tender,user_rights.bid,user_rights.oa,user_rights.report,user_rights.invoice,user_rights.expense,user_rights.date');
			$this->db->where('admin.email', $this->security->xss_clean($this->input->post('email')));
			$this->db->where('admin.password', $this->security->xss_clean($this->input->post('password')));
			$this->db->where('admin.status', 1);
			$this->db->join('user_rights','user_rights.userid = admin.id');
			$result = $this->db->get('admin');
			return $result->row();	
		*/
	}

	public function profile(){
		$this->db->where('email', $email);
		$result = $this->db->get('admin');
		return $result->row();	
	}

}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{	

    public function add_user(){	
        
        $data = array(
            'name'      =>$this->input->post('name'),
            'email'     =>$this->input->post('email'),
            'password'  =>$this->input->post('password'),
            'status'    =>$this->input->post('status'),
            'type'      =>$this->input->post('type'),
            'contact_number'  =>$this->input->post('mobile'),
            // 'location'      =>$this->input->post('location'),
			'location' =>implode(',', $this->input->post('location')),
            'country'   =>$this->input->post('country'),
            'state'     =>$this->input->post('state'),
            'city'      =>$this->input->post('city'),
            'isd_code'  =>$this->input->post('isd_codes'),
            'combo_access'     => $this->input->post('combo_access'),
            'region'    =>'',
// 			'hod_id'    =>$this->input->post('hod_type'),
		);
        //echo '<pre>';print_r($this->input->post());exit;
		$department_heads = [];
        if($this->input->post('type') == '5' && array_key_exists('region', $this->input->post()) && $this->input->post('region')[0]<>''){
            //$data = $data + ['region'=>implode(',',$this->input->post('region'))];
			$data['region'] = implode(',',$this->input->post('region'));
			if(array_key_exists('head_admin_id', $this->input->post()) && $this->input->post('head_admin_id')<>''){
				$department_heads = ['head_admin_id'=>$this->input->post('head_admin_id'),'department'=>'sales','created'=>date('Y-m-d H:i:s')];
			}
        }
		if($this->input->post('type') == '6' && array_key_exists('region_international', $this->input->post()) && $this->input->post('region_international')[0]<>''){
			$data['region'] = implode(',',$this->input->post('region_international'));
			if(array_key_exists('head_admin_id', $this->input->post()) && $this->input->post('head_admin_id')<>''){
				$department_heads = ['head_admin_id'=>$this->input->post('head_admin_id'),'department'=>'sales_international','created'=>date('Y-m-d H:i:s')];
			}
        }
		if($this->input->post('type') == '3' && array_key_exists('accounts_usertype', $this->input->post())){
            $data = $data + ['admin_type'=>$this->input->post('accounts_usertype')];
        }
		//echo '<pre>';print_r($data);exit; 
		$this->db->insert('admin',$data);  
        $id = $this->db->insert_id();
	 
		if($id){
			if(!empty($department_heads)){
				$department_heads['admin_id'] = $id;
				$this->db->insert('department_heads',$department_heads); 
			}
			$this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');
			redirect('all-user');	    
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger">Error! Please Try Again!</div>');
			redirect($_SERVER['HTTP_REFERER']);	    
		}
    }
	
    // public function all_user($filters = []){
	// 	if (!empty($filters['country'])) {
    //         $this->db->where('country', $filters['country']);
    //     }
	// 	$this->db->where('status!=','0'); 
	// 	$this->db->order_by('name','ASC');    
	// 	$result = $this->db->get('admin');  
	// 	return $result->result();
    // }	
	
	public function all_user($filters = []) 
	{
		if (!empty($filters['countries'])) {
			$this->db->where_in('country_id', $filters['countries']);
		}

		if (!empty($filters['status'])) {
			// Map 'active' and 'inactive' to your actual DB values, assuming 1 and 2
			$statusValue = ($filters['status'] === 'active') ? '1' : '2';
			$this->db->where('status', $statusValue);
		}
		if($this->session->userdata('type') == '7'){
			$this->db->select('u1.*, u2.name as hod_name');
			$this->db->from('admin u1');
			$this->db->join('admin u2', 'u1.hod_id = u2.id', 'inner'); // or just omit 'inner', it's default
			$query = $this->db->get();
			return $query->result();
		}else {
			$this->db->where('status !=', '0'); // Not deleted
			$this->db->order_by('name', 'ASC');
			$result = $this->db->get('admin');
			return $result->result();
		}
	}
	
	public function all_user_enquiry($filters = []) 
	{
		if (!empty($filters['countries'])) {
			$this->db->where_in('country_id', $filters['countries']);
		}

		if (!empty($filters['status'])) {
			// Map 'active' and 'inactive' to your actual DB values, assuming 1 and 2
			$statusValue = ($filters['status'] === 'active') ? '1' : '2';
			$this->db->where('status', $statusValue);
		}
		if($this->session->userdata('type') == '7'){
			$this->db->select('u1.*, u2.name as hod_name');
			$this->db->from('admin u1');
			$this->db->join('admin u2', 'u1.hod_id = u2.id', 'inner'); // or just omit 'inner', it's default
			$query = $this->db->get();
			return $query->result();
		}else {
			$this->db->where('status =', '1'); // Not deleted
			$this->db->order_by('name', 'ASC');
			$result = $this->db->get('admin');
			return $result->result();
		}
	}

    public function edit_product(){	    
		$this->db->where('id',$this->uri->segment(1));    
		$result = $this->db->get('enquiry');
		return $result->row();
    }
	
    public function delete_user()
	{
        $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
        
        $this->db->select('admin.*');
		$this->db->where('admin.id',$this->uri->segment(1));
		$result = $this->db->get('admin');
        $result = $result->result();
        //echo '<pre>';print_r($this->session->userdata()); print_r($result); exit;
        //if($this->session->userdata('type')=='1')
        
		if(in_array($result[0]->email,$super_admins)){
				$this->session->set_flashdata('message','<div class="alert alert-danger">Cannot Delete Admin Account!</div>');
				redirect($_SERVER['HTTP_REFERER']);	
			}
			$data = array(            
				'status' =>0           
		); 
		$this->db->where('id',$this->uri->segment(1));
		$this->db->update('admin',$data); 
		
		if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');
				redirect($_SERVER['HTTP_REFERER']);	    
		}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger">Error!Try Again</div>');
				redirect($_SERVER['HTTP_REFERER']);    
		}
	    
    }
	
    public function get_user(){
    
		// $this->db->where('id',$this->uri->segment(1));
		// $result = $this->db->get('admin');
		// return $result->row();
    
        $this->db->select('admin.*,user_rights.userid,user_rights.products,user_rights.products_group,user_rights.organization,user_rights.enquiry,user_rights.quotations,user_rights.tender,user_rights.bid,user_rights.oa,user_rights.report,user_rights.date,user_rights.invoice,user_rights.expense');	
		$this->db->join('user_rights','user_rights.userid = admin.id','LEFT');
		$this->db->where('admin.id',$this->uri->segment(1));
		$result = $this->db->get('admin');
        return $result->row();
    }
	
     public function update_user() {
		$user_id = $this->input->post('hdn_update_id');
		$existing_user = $this->user_model->get_user($user_id);

		// Store previous values in log before updating
		$previous_data = [
			'email' => $existing_user->email,
			'mobile' => $existing_user->contact_number,
			'name' => $existing_user->name,
// 			'region_international' => $existing_user->region_international,
			'region_international' => $existing_user->region,
// 			'accounts_usertype' => $existing_user->accounts_usertype,
			'accounts_usertype' => $existing_user->admin_type,
			'location' => $existing_user->location,
			'country' => $existing_user->country,
			'city' => $existing_user->city,
			'status' => $existing_user->status,
			'state' => $existing_user->state,
			'booking_type' => $existing_user->booking_type,
			'combo_access'     => $existing_user->combo_access,
		];
		log_user_activity('User Update (Before Change)', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));

		$booking_types = $this->input->post('bookingtype');

		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'status' => $this->input->post('status'),
			'type' => $this->input->post('type'),
			'contact_number' => $this->input->post('mobile'),
			'location' => implode(',', $this->input->post('location')),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'isd_code' => $this->input->post('isd_codes'),
			'booking_type' => is_array($booking_types) ? implode(',', $booking_types) : $booking_types,
			'combo_access'     => $this->input->post('combo_access'),
		];

		$sales_id = $sales_affected_rows = 0;

		// Sales
		if ($this->input->post('type') == '5' && !empty($this->input->post('region')[0])) {
			$data['region'] = implode(',', $this->input->post('region'));

			if ($this->input->post('head_admin_id') !== '' && $this->input->post('hdn_update_id') == '') {
				$sales_data = [
					'admin_id' => $this->uri->segment(1),
					'head_admin_id' => $this->input->post('head_admin_id'),
					'department' => 'sales',
					'created' => date('Y-m-d H:i:s')
				];
				$this->db->insert('department_heads', $sales_data);
				$sales_id = $this->db->insert_id();
			} elseif ($this->input->post('hdn_update_id') != '') {
				$update_arr = ['modified' => date('Y-m-d H:i:s'), 'department' => 'sales'];
				$update_arr += ($this->input->post('head_admin_id') == '' ) ? ['status' => 'deleted'] : ['head_admin_id' => $this->input->post('head_admin_id')];
				$this->db->where('id', $this->input->post('hdn_update_id'));
				$sales_affected_rows = $this->db->update('department_heads', $update_arr);
			}
		}

		// Sales International
		elseif ($this->input->post('type') == '6' && !empty($this->input->post('region_international')[0])) {
			$data['region'] = implode(',', $this->input->post('region_international'));

			if ($this->input->post('head_admin_id') !== '' && $this->input->post('hdn_update_id') == '') {
				$sales_data = [
					'admin_id' => $this->uri->segment(1),
					'head_admin_id' => $this->input->post('head_admin_id'),
					'department' => 'sales_international',
					'created' => date('Y-m-d H:i:s')
				];
				$this->db->insert('department_heads', $sales_data);
				$sales_id = $this->db->insert_id();
			} elseif ($this->input->post('hdn_update_id') != '') {
				$update_arr = ['modified' => date('Y-m-d H:i:s'), 'department' => 'sales_international'];
				$update_arr += ($this->input->post('head_admin_id') == '' ) ? ['status' => 'deleted'] : ['head_admin_id' => $this->input->post('head_admin_id')];
				$this->db->where('id', $this->input->post('hdn_update_id'));
				$sales_affected_rows = $this->db->update('department_heads', $update_arr);
			}
		}

		// If not Sales or Sales Intl, clear region
		else {
			$data['region'] = '';
		}

		// Delete old department head entry if user type is not sales-related
		if (!in_array($this->input->post('type'), ['5', '6']) && $this->input->post('hdn_update_id') != '') {
			$update_arr = ['modified' => date('Y-m-d H:i:s'), 'status' => 'deleted'];
			$this->db->where('id', $this->input->post('hdn_update_id'));
			$sales_affected_rows = $this->db->update('department_heads', $update_arr);
		}

		// Set admin_type for Accounts user
		if ($this->input->post('type') == '3' && array_key_exists('accounts_usertype', $_POST)) {
			$data['admin_type'] = $this->input->post('accounts_usertype');
		}

		// Final update
		$this->db->where('id', $this->uri->segment(1));
		$this->db->update('admin', $data);

		if ($this->db->affected_rows() > 0 || $sales_id || $sales_affected_rows) {
			$this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
			redirect('all-user');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Error! You Have Not Changed Anything!</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


}
?>
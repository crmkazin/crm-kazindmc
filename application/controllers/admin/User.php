<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        check_delete();
        
        if (!in_array($this->session->userdata('type'), ['1', '7']) && $this->uri->segment(1) != 'change_password') {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }

        $this->load->model(['admin/user_model','common_model']);
    }		
	
    public function index(){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|callback_mobile_unique');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('email_unique', '&nbsp;&nbsp;Email Id Already Registered');
        $this->form_validation->set_message('mobile_unique', '&nbsp;&nbsp;Mobile Number Already Registered');
        if($this->form_validation->run() == FALSE){
          
         // echo validation_errors(); // Prints all validation errors

             $log_array = ['Name' => $this->input->post('name'),
             'Email' => $this->input->post('email'),
             'ISD Code' => $this->input->post('isd_codes'),
             'Mobile' => $this->input->post('mobile'),
             'Password' => $this->input->post('password'),
             'Type' => $this->input->post('type'),
             'Reporting Manager' => $this->input->post('head_admin_id'),
             'Region' => $this->input->post('region'),
             'International Region' => $this->input->post('region_international'),
             'Accounts User Type' => $this->input->post('accounts_usertype'),
            //  'Location' => $this->input->post('location'),
             'Location' => is_array($this->input->post('location')) ? implode(',', $this->input->post('location')) : '',
             'Status' => $this->input->post('status'),
             'Country'  => $this->input->post('country_id'),
             'State'     => $this->input->post('state_id'),
             'City'     => $this->input->post('city'),
             'combo_access'     => $this->input->post('combo_access'),
             'Created'  => date('Y-m-d H:i:s'),
             'Time' => time()
            ];

            log_user_activity('Error :'. html_entity_decode(strip_tags(validation_errors())),$this->session->userdata('id'), 'Detail: ' . json_encode($log_array));
            $data['states'] = $this->common_model->get_data('states','', '', '*','states.country_id=101','', $count = false);
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $data['countries'] = $this->common_model->get_data('countries','', '', '*','countries.id != 101','', $count = false);
            $data['sales'] = $this->common_model->get_data('admin','', '', '*','admin.type IN (5,6) AND admin.status=1','', $count = false);
            $this->db->where('status', 1);
            $this->db->where('type', 7);
            $query = $this->db->get('admin');
            $data['user_data'] = $query->result();
            $data['content'] = 'admin/user';
            $this->load->view('admin/layout',$data);
        }else{
           // echo '<pre>';print_r($this->input->post());exit;
            
            $log_array = ['Name' => $this->input->post('name'),
             'Email' => $this->input->post('email'),
             'ISD Code' => $this->input->post('isd_codes'),
             'Mobile' => $this->input->post('mobile'),
             'Password' => $this->input->post('password'),
             'Type' => $this->input->post('type'),
             'Reporting Manager' => $this->input->post('head_admin_id'),
             'Region' => $this->input->post('region'),
             'International Region' => $this->input->post('region_international'),
             'Accounts User Type' => $this->input->post('accounts_usertype'),
            //  'Location' => $this->input->post('location'),
            'Location' => is_array($this->input->post('location')) ? implode(',', $this->input->post('location')) : '',
             'Status' => $this->input->post('status'),
             'Country'  => $this->input->post('country_id'),
             'State'     => $this->input->post('state_id'),
             'City'     => $this->input->post('city'),
             'combo_access'     => $this->input->post('combo_access'),
             'Created'  => date('Y-m-d H:i:s'),
             'Time' => time()
            ];
               //echo "<PRE>"; print_r($insert_array); exit;
               
              log_user_activity('User Created',$this->session->userdata('id'), 'Detail: ' . json_encode($log_array));
                       
            $this->user_model->add_user();	
        }
       	    
    }
    
    
    public function get_users_by_booking_type()
    {
        $booking_type = $this->input->post('booking_type');

        if (!$booking_type) {
            echo json_encode([]);
            return;
        }

        // Get users with matching booking_type
        $this->db->select('id, name');
        $this->db->from('admin');
        $this->db->where("FIND_IN_SET('{$booking_type}', booking_type) >", 0);
        $this->db->where('status', '1');
        $this->db->where('type', '2');
        $query = $this->db->get();

        $users = $query->result();

        echo json_encode($users);
    }
    
    public function email_unique(){
        $where = ' status != "0" AND email = "'.$this->input->post('email').'"'; 
        if($this->uri->segment(2)<>'' && $this->uri->segment(2)=='edit-user'){
            $where = ' status != "0" AND email = "'.$this->input->post('email').'" AND id != '.$this->uri->segment(1);
        }
        $select = 'id';
        $count = $this->common_model->get_data('admin','', '', $select,$where,'', $count = true);
        if($count){
            return false;
        }else { return true; }
    }
    
    public function mobile_unique(){
        $where = ' status != "0" AND contact_number = "'.$this->input->post('mobile').'"'; 
        if($this->uri->segment(2)<>'' && $this->uri->segment(2)=='edit-user'){
            $where = ' status != "0" AND contact_number = "'.$this->input->post('mobile').'" AND id != '.$this->uri->segment(1);
        }
        $select = 'id';                   
        $count = $this->common_model->get_data('admin','', '', $select,$where,'', $count = true);
        if($count){
            return false;
        }else { return true; }
    }
    
    public function user_list(){
        log_user_activity('User View',$this->session->userdata('id'),'User: View');
        $filters = [];
        if ($this->input->get('submit')) {
            $filters = [
                'country' => $this->input->get('country'),
                'status' => $this->input->get('status'),
            ];
            log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
        }

        $select = 'admin.*, admin.location';
        $where = 'type = "2" AND status != "0"';
        $data['all_user'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);

        $data['users'] = $this->user_model->all_user($filters);
        $data['content'] = 'admin/user_list';   
        $this->load->view('admin/layout',$data);	    
    }

    public function check_booking_type_availability()
    {
        $booking_types = $this->input->post('booking_types');
        if (!$booking_types) {
            echo json_encode(['status' => false, 'message' => 'No booking types provided.']);
            return;
        }

        $booking_types = is_array($booking_types) ? $booking_types : explode(',', $booking_types);

        $existing = $this->db->where('status', 'active')->select('booking_type')->get('hod_detail')->result_array();
        $assigned_types = [];

        foreach ($existing as $row) {
            $types = explode(',', $row['booking_type']);
            $assigned_types = array_merge($assigned_types, $types);
        }

        $conflict = array_intersect($booking_types, $assigned_types);

        if (!empty($conflict)) {
            echo json_encode(['status' => false, 'message' => 'Booking type(s) already assigned: ' . implode(', ', $conflict)]);
        } else {
            echo json_encode(['status' => true]);
        }
    }

    public function get_all_hod_details()
    {
        $data = $this->db->where('status', 'active')->order_by('created_at', 'DESC')->get('hod_detail')->result();
        echo json_encode($data);
    }

    // public function delete_hod_detail()
    // {
    //     $id = $this->input->post('id');
    //     $this->db->where('id', $id)->update('hod_detail', ['status' => 'delete']);
    //     echo json_encode(['status' => true]);
    // }
    
    // public function update_status($id, $data)
    // {
    //     $this->db->where('id', $id);
    //     return $this->db->update('hod_detail', $data);
    // }

    // public function delete_hod($id)
    // {
    //     $data = ['status' => 'delete'];

    //     if ($this->update_status($id, $data)) {
    //         echo json_encode(['status' => 'success', 'message' => 'HOD deleted successfully.']);
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Failed to delete HOD.']);
    //     }
    // }
    
    public function getUserDetailsByName()
    {
        $name = $this->input->post('name');
        if (!$name) {
            echo json_encode(['status' => false, 'message' => 'Name is required']);
            return;
        }

        $user = $this->db->select('id, name, email, location')
                        ->where('id', $name)
                        ->where('type', 2)
                        ->where('status', 1)
                        ->get('admin')
                        ->row_array();

        if ($user) {
            $locations = explode(',', strtolower(str_replace(' ', '', $user['location'])));

            $bookingtype = [ 
                'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                'belarus' => ['FBZ', 'GBZ', 'IBZ'],
                'georgia' => ['FGE', 'GGE', 'IGE'],
                'armenia' => ['FAR','GAR','IAR'],
                'uzbekistan' => ['FUZ','GUZ','IUZ'],
                'combo' => ['CMB'],
                'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR', 'FUZ','GUZ','IUZ','CMB']
            ];

            $user_booking_types = [];

            if (in_array('all', $locations)) {
                $user_booking_types = $bookingtype['all'];
            } else {
                foreach ($locations as $loc) {
                    if (isset($bookingtype[$loc])) {
                        $user_booking_types = array_merge($user_booking_types, $bookingtype[$loc]);
                    }
                }
            }

            echo json_encode([
                'status' => true,
                'email' => $user['email'],
                'locations' => implode(', ', array_map('ucfirst', $locations)),
                'booking_types' => array_unique($user_booking_types)
            ]);
        } else {
            echo json_encode(['status' => false, 'message' => 'User not found']);
        }
    }

    public function save_hod_details()
    {
        $user_id = $this->input->post('name'); // 'name' is actually user_id from the dropdown
        $email = $this->input->post('email');
        $booking_types = $this->input->post('booking_type');
        $locations = $this->input->post('location');

        // Get user name from admin table
        $user = $this->db->get_where('admin', ['id' => $user_id])->row_array();
        $name = $user['name'] ?? '';

        $data = [
            'user_id' => $user_id,
            'name' => $name,
            'email' => $email,
            'location' => is_array($locations) ? implode(',', $locations) : $locations,
            'booking_type' => is_array($booking_types) ? implode(',', $booking_types) : $booking_types,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Insert into hod_detail table
        if ($this->db->insert('hod_detail', $data)) {
            // Update 'hod' column to 'yes' in admin table
            $this->db->where('id', $user_id);
            $this->db->update('admin', ['hod' => 'yes']);

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success']));
        } else {
            // Handle insert error
            $error = $this->db->error();
            log_message('error', 'DB Insert Error: ' . print_r($error, true));
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => $error['message']]));
        }
    }
    
    
    public function delete_hod()
    {
        $hodDetailId = $this->input->post('id');

        if ($hodDetailId) {
            // Get the user_id from hod_detail
            $hod_detail = $this->db->get_where('hod_detail', ['id' => $hodDetailId])->row();

            if ($hod_detail) {
                $userId = $hod_detail->user_id;

                // Update hod_detail status to inactive
                $this->db->where('id', $hodDetailId);
                $this->db->update('hod_detail', ['status' => 'delete']);

                // Update admin table hod = 'no' where id = user_id
                $this->db->where('id', $userId);
                $this->db->update('admin', ['hod' => 'no']);

                echo json_encode(['status' => true]);
            } else {
                echo json_encode(['status' => false, 'message' => 'HOD detail not found.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid ID']);
        }
    }

    public function delete_user(){
        //echo preg_match_all("/delete/i", $this->router->fetch_class()).'__'.preg_match_all("/delete/i", $this->router->fetch_method())."<br>";
        //echo $this->router->fetch_class().'_'.$this->router->fetch_method(); exit;
        log_user_activity('User Delete',$this->session->userdata('id'),'User: Deleted');
        $this->user_model->delete_user();    
    }

    public function edit_user()
    {
        log_user_activity('User Edit', $this->session->userdata('id'), 'User: Edit');
    
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|callback_mobile_unique');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('email_unique', '&nbsp;&nbsp;Email Id Already Registered');
        $this->form_validation->set_message('mobile_unique', '&nbsp;&nbsp;Mobile Number Already Registered');
    
        if ($this->form_validation->run() == FALSE) {
            $data['states'] = $this->common_model->get_data('states', '', '', '*', 'states.country_id=101', '', false);
            $data['user'] = $this->user_model->get_user(); 
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', false);
            $data['countries'] = $this->common_model->get_data('countries', '', '', '*', 'countries.id != 101', '', false);
            
            $join = [['type' => 'LEFT', 'join_table' => 'department_heads', 'condition' => '(department_heads.admin_id = admin.id AND department_heads.status="active")']];
            $data['sales'] = $this->common_model->get_data('admin', '', '', 'admin.*,department_heads.head_admin_id,department_heads.id AS department_heads_id', 'admin.type IN (5,6)', '', false, $join);
            $this->db->where('status', 1);
            $this->db->where('type', 7);
            $query = $this->db->get('admin');
            $data['user_data'] = $query->result();
            $data['content'] = 'admin/edit_user';
            $this->load->view('admin/layout', $data);
        } else {    
            $this->user_model->update_user();
      }
    }
	
    public function change_password(){
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if($this->form_validation->run() == FALSE){
            $data['content'] = 'admin/change_password';
            $this->load->view('admin/layout',$data);
            log_user_activity('Change Password Edit',$this->session->userdata('id'), 'Change Password: Edit');
        }else{
            $where = 'id='.$this->session->userdata('id');
            $result = $this->common_model->get_data('admin','', '', 'password',$where,'', $count = false);
            if($result[0]->password<>$this->input->post('current_password')){
                $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid current password!</div>');
                log_user_activity('Change Password: Update Error',$this->session->userdata('id'), 'Invalid current password!');
                redirect('change_password');
            }else{
                $update_arr = ['password'=>$this->input->post('new_password')];
                $this->common_model->update_data(['table_name'=>'admin','update_data'=>$update_arr,
                                            'condition'=>['id'=>$this->session->userdata('id')]]);
                log_user_activity('Change Password: Update',$this->session->userdata('id'), 'New Password:'.json_encode($update_arr) );
                $this->session->set_flashdata('message','<div class="alert alert-success">Password Changed Successfully!</div>');
                redirect('change_password');
                
            }
            //echo '<pre>';print_r($result);exit; 
        }
        
    }
    
    // For Combo File
    
	
}

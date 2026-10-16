<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Controller {
    
    var $locations = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ'],
        'georgia' => ['FGE', 'GGE', 'IGE'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE']
    ];
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library(['pagination','upload']);
        /*if(!in_array($this->session->userdata('id'),['8','13'])){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }*/
    }		

    public function index(){ 
        $where = 'sites.status != "deleted"';
        if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
           $where .= ' AND LOWER(sites.country) = "'.strtolower($this->session->userdata('locations')).'"'; 
        }
        $data['result'] = $this->common_model->get_data('sites','', '', '*',$where, ' ORDER BY sites.id DESC', $count = false);
        //echo '<pre>';print_r($data['result']);exit;
        $this->load->view('admin/itinerary_masters_list',$data);
    }
    
    public function create(){
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        //$this->form_validation->set_rules('country_id', 'Select Country', 'trim|required',['required'=>'&nbsp;Select Country From List']);
        $this->form_validation->set_rules('operational_days[]', 'Operation Days', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');  
        if($this->form_validation->run() == FALSE){
            $data['country'] = ['label'=>'','country_id'=>''];
            if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                $data['country'] = $this->company_model->get_country_ajax(['search'=>ucfirst($this->session->userdata('locations'))])[0];
            }
            
            $this->load->view('admin/itinerary_masters_create',$data);
        }else {
            $operational_days = implode(',',$this->input->post('operational_days[]'));
            $location_ids = (!empty($this->input->post('location_ids[]')))?implode(',',$this->input->post('location_ids[]')):'0';
            $location_name = '';
            if($location_ids <> 0){
                $select = 'GROUP_CONCAT(location_masters.location SEPARATOR " + ") AS location_names';
                $where = 'location_masters.id IN ('.$location_ids.')'; 
                $result = $this->common_model->get_data('location_masters','', '', $select,$where, ' GROUP BY location_masters.country', $count = false)[0];
                $location_name = $result->location_names;
            }
            $insert_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),
                            'site_name'=>$this->input->post('name'),'category'=>$this->input->post('category'),
                            'entry_ticket'=>$this->input->post('entry_ticket'),'departing_time_from_hotel'=>$this->input->post('departing_time'),
                            'duration'=>$this->input->post('duration'),'description'=>$this->input->post('description'),
                            'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s'),'days_of_operation'=>$operational_days,'location_ids'=>$location_ids,'location_name'=>$location_name];
            $id = $this->common_model->insert_data(['table_name'=>'sites','insert_data'=>$insert_arr]);
            if($id){
                $insert_arr=[];
                $cnt = ($this->input->post("remarks")[0]<>'')?count($this->input->post("remarks")):0;
                for($i=0;$i<$cnt;$i++){
                    $insert_arr[$i] = ['remarks'=>$this->input->post("remarks")[$i],'sites_id'=>$id,'created'=>date('Y-m-d H:i:s')];
                }
                if(!empty($insert_arr)){
                    $this->common_model->insert_data_batch(['table_name'=>'itinerary_masters_remarks','insert_data'=>$insert_arr]);
                }
                $this->session->set_flashdata('message','<div class="alert alert-success">Created Successfully!</div>');
                redirect('all-masters');
            }
        }
        
    }
    
    public function edit(){
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('operational_days[]', 'Operation Days', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert-danger">', '</div>');
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-masters');
        if($this->form_validation->run() == FALSE){ 
            $where = 'sites.id= '.$id;
            $data['result'] = $this->common_model->get_data('sites','', '', '*',$where,'', $count = false)[0];
            if(empty($data['result'])){
                redirect('all-masters');
            }
            $where = 'sites_id = '.$data['result']->id;
            $data['result_remarks'] = $this->common_model->get_data('itinerary_masters_remarks','', '', '*',$where,'', $count = false);
            $data['country_id'] = $this->company_model->get_country_ajax(['search'=>$data['result']->country])[0]['country_id'];
            
            $where = 'location_masters.status = "active" AND location_masters.country = "'.$data['result']->country.'"';
            $data['location_masters'] = $this->common_model->get_data('location_masters','', '', '*',$where,'', $count = false);
            
            $this->load->view('admin/itinerary_masters_edit',$data);
        }else {
            $operational_days = implode(',',$this->input->post('operational_days[]'));
            $location_ids = (!empty($this->input->post('location_ids[]')))?implode(',',$this->input->post('location_ids[]')):'0';
            $location_name = '';
            if($location_ids <> 0){
                $select = 'GROUP_CONCAT(location_masters.location SEPARATOR " + ") AS location_names';
                $where = 'location_masters.id IN ('.$location_ids.')'; 
                $result = $this->common_model->get_data('location_masters','', '', $select,$where, ' GROUP BY location_masters.country', $count = false)[0];
                $location_name = $result->location_names;
            }
            $update_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),
                            'site_name'=>$this->input->post('name'),'category'=>$this->input->post('category'),
                            'entry_ticket'=>$this->input->post('entry_ticket'),'departing_time_from_hotel'=>$this->input->post('departing_time'),
                            'duration'=>$this->input->post('duration'),'description'=>$this->input->post('description'),
                            'admin_id'=>$this->session->userdata('id'),'days_of_operation'=>$operational_days,'location_ids'=>$location_ids,'location_name'=>$location_name];
            $update_data = ['table_name'=>'sites','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            if($affected_rows){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
            }
            
            $edit_cnt = (array_key_exists('edit_remarks',$this->input->post()) && $this->input->post("edit_remarks")[0]<>'')?count($this->input->post("edit_remarks")):0;
            
            for($i=0;$i<$edit_cnt;$i++){
                $update_arr = '';
                $edit_id = $this->input->post('edit_id_remarks')[$i];
                $update_arr = ['remarks'=>$this->input->post("edit_remarks")[$i],'created'=>date('Y-m-d H:i:s')];
                $update_data = ['table_name'=>'itinerary_masters_remarks','update_data'=>$update_arr,'condition'=>['id'=>$edit_id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }
                        
            $insert_arr=[];
            $cnt = ($this->input->post("remarks")[0]<>'')?count($this->input->post("remarks")):0;
            for($i=0;$i<$cnt;$i++){
                $insert_arr[$i] = ['remarks'=>$this->input->post("remarks")[$i],'sites_id'=>$id,'created'=>date('Y-m-d H:i:s')];
            }
            if(!empty($insert_arr)){
                $this->common_model->insert_data_batch(['table_name'=>'itinerary_masters_remarks','insert_data'=>$insert_arr]);
            }
            redirect('all-masters');
        }
        
    }
    
    public function get_locations(){
        $country = $this->input->post('country');
        $where = 'location_masters.status = "active" AND location_masters.country = "'.strtolower($country).'"' ;
        $location_masters = $this->common_model->get_data('location_masters','', '', '*',$where,'', $count = false);
        echo json_encode(['response'=>'s','details'=>$location_masters]);
    }
    
    public function create_restaurants(){
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            $data['country'] = ['label'=>'','country_id'=>''];
            if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                $data['country'] = $this->company_model->get_country_ajax(['search'=>ucfirst($this->session->userdata('locations'))])[0];
            }
            $this->load->view('admin/itinerary_masters_create_restaurant',$data);
        }else {
            $image = '';
            if($_FILES['image']['name'] != ""){
                $config = array(
                    'upload_path' 	=> "uploads/restaurants/",
                    'allowed_types' => "jpg|jpeg|png|JPG|PNG|JPEG",
                    'detect_mime' => true, 
                    'overwrite' => true,
                    'max_size' => '2048',
                    'encrypt_name' => true,
                );			
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $data_img = $this->upload->data();			
                    $image = $data_img['file_name'];
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                    redirect('itinerary-masters-create-restaurants');
                }
            }
            $cuisine = implode(', ',($this->input->post('cuisine')<>'')?$this->input->post('cuisine'):[]);
            $insert_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),
                            'map' => $this->input->post('map'),
                            'name'=>$this->input->post('name'),'image'=>$image,
                            'restaurant_address'=>$this->input->post('restaurant_address'),
                            'contact_number'=>$this->input->post('contact_number'),
                            'price_range'=>$this->input->post('price_range'),
                            'description'=>$this->input->post('description'),'cuisine'=>$cuisine,
                            'seating_capacity'=>$this->input->post('seating_capacity'),
                            'opening_time'=>$this->input->post('opening_time'),
                            'closing_time'=>$this->input->post('closing_time'),
                            'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
            $id = $this->common_model->insert_data(['table_name'=>'restaurants','insert_data'=>$insert_arr]);
            if($id){
                $insert_arr=[];
                $cnt = ($this->input->post("remarks")[0]<>'')?count($this->input->post("remarks")):0;
                for($i=0;$i<$cnt;$i++){
                    $insert_arr[$i] = ['remarks'=>$this->input->post("remarks")[$i],'restaurant_id'=>$id,'created'=>date('Y-m-d H:i:s')];
                }
                if(!empty($insert_arr)){
                    $this->common_model->insert_data_batch(['table_name'=>'restaurants_remarks','insert_data'=>$insert_arr]);
                }
                $this->session->set_flashdata('message','<div class="alert alert-success">Created Successfully!</div>');
                redirect('all-masters-restaurants');
            }
        }
    }
    
    public function restaurants(){
        $where = 'restaurants.status != "deleted"';
        if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
           $where .= ' AND LOWER(restaurants.country) = "'.strtolower($this->session->userdata('locations')).'"'; 
        }
        $data['result'] = $this->common_model->get_data('restaurants','', '', '*',$where, ' ORDER BY restaurants.id DESC', $count = false);
        //echo '<pre>';print_r($data['result']);exit;
        $this->load->view('admin/itinerary_masters_list_restaurants',$data);
    }
    
    public function edit_restaurants(){
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-masters-restaurants');
        if($this->form_validation->run() == FALSE){            
            $where = 'restaurants.id= '.$id;
            $data['result'] = $this->common_model->get_data('restaurants','', '', '*',$where,'', $count = false)[0];
            if(empty($data['result'])){
                redirect('all-masters-restaurants');
            }
            $where = 'restaurant_id = '.$data['result']->id;
            $data['result_remarks'] = $this->common_model->get_data('restaurants_remarks','', '', '*',$where,'', $count = false);
            $data['country_id'] = $this->company_model->get_country_ajax(['search'=>$data['result']->country])[0]['country_id'];
            $this->load->view('admin/itinerary_masters_edit_restaurant',$data);
        }else {
            $image = '';
            if($_FILES['image']['name'] != ""){
                $config = array(
                    'upload_path' 	=> "uploads/restaurants/",
                    'allowed_types' => "jpg|jpeg|png|JPG|PNG|JPEG",
                    'detect_mime' => true, 
                    'overwrite' => true,
                    'max_size' => '2048',
                    'encrypt_name' => true,
                );			
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $data_img = $this->upload->data();			
                    $image = $data_img['file_name'];
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                    redirect('edit_restaurants_masters?id='.$this->input->get('id'));
                }
            }
            $cuisine = implode(', ',($this->input->post('cuisine')<>'')?$this->input->post('cuisine'):[]);
            $update_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),'map' => $this->input->post('map'),
                            'name'=>$this->input->post('name'),'price_range'=>$this->input->post('price_range'),
                            'restaurant_address'=>$this->input->post('restaurant_address'),
                            'contact_number'=>$this->input->post('contact_number'),
                            'description'=>$this->input->post('description'),'cuisine'=>$cuisine,
                            'seating_capacity'=>$this->input->post('seating_capacity'),
                            'opening_time'=>$this->input->post('opening_time'),
                            'closing_time'=>$this->input->post('closing_time'),
                            'admin_id'=>$this->session->userdata('id')];
            if($image<>''){
                $update_arr = $update_arr + ['image'=>$image];
            }
            $update_data = ['table_name'=>'restaurants','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            if($affected_rows){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');    
            }
            
            $edit_cnt = (array_key_exists('edit_remarks',$this->input->post()) && $this->input->post("edit_remarks")[0]<>'')?count($this->input->post("edit_remarks")):0;
            
            for($i=0;$i<$edit_cnt;$i++){
                $update_arr = '';
                $edit_id = $this->input->post('edit_id_remarks')[$i];
                $update_arr = ['remarks'=>$this->input->post("edit_remarks")[$i],'created'=>date('Y-m-d H:i:s')];
                $update_data = ['table_name'=>'restaurants_remarks','update_data'=>$update_arr,'condition'=>['id'=>$edit_id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }
                        
            $insert_arr=[];
            $cnt = ($this->input->post("remarks")[0]<>'')?count($this->input->post("remarks")):0;
            for($i=0;$i<$cnt;$i++){
                $insert_arr[$i] = ['remarks'=>$this->input->post("remarks")[$i],'restaurant_id'=>$id,'created'=>date('Y-m-d H:i:s')];
            }
            if(!empty($insert_arr)){
                $this->common_model->insert_data_batch(['table_name'=>'restaurants_remarks','insert_data'=>$insert_arr]);
            }
            redirect('all-masters-restaurants');
        }
    }
    
    public function delete_masters(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-masters');
        $update_arr = ['status'=>'deleted'];
        $affected = $this->common_model->update_data_limit(['table_name'=>'sites','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($affected){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('all-masters');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function delete_masters_restaurant(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-masters-restaurants');
        
        $where = ' restaurant_menus.restaurant_id = '.$id;
        $restaurant_menus = $this->common_model->get_data('restaurant_menus', '', '', '*', $where, '', $count = true);
        if($restaurant_menus){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Restaurant Menus Found. Restaurant cannot be deleted.</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $update_arr = ['status'=>'deleted'];
        $affected = $this->common_model->update_data_limit(['table_name'=>'restaurants','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($affected){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('all-masters-restaurants');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function edit_remove_remarks(){
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('id','ID','required|integer');
        $this->form_validation->set_rules('sites_id','Itinerary Masters ID','required|integer');
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>validation_errors()];
            echo json_encode($response);exit;
        }
        $this->db->limit(1);
        $this->db->where(['id'=>$this->input->post('id'),'sites_id'=>$this->input->post('sites_id')]);
        $this->db->delete('itinerary_masters_remarks');
        
        $response = ['response'=>'s','details'=>'','msg'=>'Deleted Successfully!'];
        echo json_encode($response);exit;
    }
    
    public function remove_remarks_restaurant(){
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('id','ID','required|integer');
        $this->form_validation->set_rules('restaurant_id','Restaurant ID','required|integer');
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>validation_errors()];
            echo json_encode($response);exit;
        }
        $this->db->limit(1);
        $this->db->where(['id'=>$this->input->post('id'),'restaurant_id'=>$this->input->post('restaurant_id')]);
        $this->db->delete('restaurants_remarks');
        
        $response = ['response'=>'s','details'=>'','msg'=>'Deleted Successfully!'];
        echo json_encode($response);exit;
    }
    

    //13 May 2024
    public function site_cost()
    {
        $site_id = ($this->input->get('site_id') <> '' && base64_decode($this->input->get('site_id')) <> '') ? base64_decode($this->input->get('site_id')) : redirect('all-masters');
        $id = base64_decode($this->input->get('id'));

        $select = 'sites.site_name';
        $where = 'id = ' . $site_id;
        $data['site_name'] = $this->common_model->get_data('sites', '', '', $select, $where, '', $count = false);


        $where = 'site_id = ' . $site_id;
        $data['site_cost'] = $this->common_model->get_data('site_costs', '', '', '*', $where, '', $count = false);

        if (empty($data['site_cost'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
        }

        if (!empty($id)) {
            $where = 'id = ' . $id;
            $data['site_costs'] = $this->common_model->get_data('site_costs', '', '', '*', $where, '', $count = false)[0];
        }

        $this->form_validation->set_rules('valid_from', 'Valid From', 'trim|required');
        $this->form_validation->set_rules('valid_to', 'Valid To', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('cost_type', 'Cost Type', 'trim|required');
        $this->form_validation->set_rules('cost', 'Cost', 'trim|required|integer');
        // $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/site_cost', $data);
        } else {

            $valid_from = $this->input->post('valid_from');
            $valid_to = $this->input->post('valid_to');

            foreach ($data['site_cost'] as $site) {
                $existing_valid_from = $site->valid_from;
                $existing_valid_to = $site->valid_to;
                if (
                    ($valid_from >= $existing_valid_from && $valid_from <= $existing_valid_to) ||
                    ($valid_to >= $existing_valid_from && $valid_to <= $existing_valid_to)
                ) {
                    // Dates overlap, show error message
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing record!</div>');
                    redirect('site-cost?site_id=' . base64_encode($site_id));
                }
            }

            $arr = array(
                'valid_from' => $valid_from,
                'valid_to' => $valid_to,
                'title' => $this->input->post('title'),
                'cost_type' => $this->input->post('cost_type'),
                'cost' => $this->input->post('cost'),
                // 'status' => $this->input->post('status')
            );

            // if ($this->input->post('cost_for') == 'per-person') {
            //     $arr['cost_adult'] = $this->input->post('cost');
            //     $arr['cost_child'] = $this->input->post('cost');
            // }
            // if ($this->input->post('cost_for') == 'per-adult') {
            //     $arr['cost_adult'] = $this->input->post('cost');
            // }
            // if ($this->input->post('cost_for') == 'per-child') {
            //     $arr['cost_child'] = $this->input->post('cost');
            // }

            if ($id <> '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                $this->common_model->update_data_limit(['table_name' => 'site_costs', 'update_data' => $arr, 'condition' => ['id' => $id]]);
            } else {
                $insert_arr = $arr + ['site_id' => $site_id];
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                $id = $this->common_model->insert_data(['table_name' => 'site_costs', 'insert_data' => $insert_arr]);
            }
            redirect('site-cost?site_id=' . base64_encode($site_id));

        }

    }
    
    public function blackout_dates_list(){
        $where = 'black_out_dates.status != "deleted"';        
        $data['result'] = $this->common_model->get_data('black_out_dates','', '', '*',$where, ' ORDER BY black_out_dates.id DESC', $count = false);
        
        $id = '';
        if ($this->input->get('id') <> '') {
            $id = base64_decode($this->input->get('id'));
            ($id == '') ? redirect('blackout-dates') : '';
            $where = 'id = ' . $id;
            $data['blackout_dates'] = $this->common_model->get_data('black_out_dates', '', '', '*', $where, '', $count = false)[0];
            if (empty($data['blackout_dates'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
                redirect('blackout-dates');
            }
            $select = 'black_out_dates_hotels.*,hotels.name';
            $where = 'black_out_dates_hotels.status="active" AND black_out_dates_hotels.black_out_dates_id = '.$id;
            $join = [['type' => '', 'join_table' => 'black_out_dates_hotels', 'condition' => 'black_out_dates_hotels.black_out_dates_id = black_out_dates.id'],
                    ['type' => '', 'join_table' => 'hotels', 'condition' => 'hotels.id = black_out_dates_hotels.hotel_id']];
            $data['blackout_dates_hotels'] = $this->common_model->get_data('black_out_dates', '', '', $select, $where, '', $count = false, $join);
            
            //echo '<pre>';print_R($data['blackout_dates_hotels']);exit;
        }
        $data['locations'] = $this->locations;
        $this->form_validation->set_rules('event_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('from_date', 'From', 'trim|required');
        $this->form_validation->set_rules('to_date', 'To', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if ($this->form_validation->run() == FALSE) {
             $this->load->view('admin/blackoutdates_list_view',$data);
        } else {
            $arr = array(
                'name' => $this->input->post('event_name'),
                'from_date' => $this->input->post('from_date'),
                'to_date' => $this->input->post('to_date'),
                'status' => $this->input->post('status'),
                'admin_id' => $this->session->userdata('id'),
            );
            if ($id <> '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                $this->common_model->update_data_limit(['table_name' => 'black_out_dates', 'update_data' => $arr, 'condition' => ['id' => $id]]);
                if($id && !empty($this->input->post('hotel_id'))){
                    $created = date('Y-m-d H:i:s'); $insert_hotels = [];
                    foreach($this->input->post('hotel_id') AS $list){                        
                        $hotel_id_index = array_search($list, array_column($data['blackout_dates_hotels'], 'hotel_id'));
                        if($hotel_id_index !== false && $data['blackout_dates_hotels'][$hotel_id_index]->black_out_dates_id == $id){ 
                            continue; 
                        }
                        $insert_hotels[] = ['black_out_dates_id'=>$id,'hotel_id'=>$list,'created'=>$created];
                    }
                    if(!empty($insert_hotels)){
                        $this->common_model->insert_data_batch(['table_name'=>'black_out_dates_hotels','insert_data'=>$insert_hotels]);
                    }
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                $insert_arr = $arr + ['created' => date('Y-m-d H:i:s')];
                $id = $this->common_model->insert_data(['table_name' => 'black_out_dates', 'insert_data' => $insert_arr]);
                if($id && !empty($this->input->post('hotel_id'))){
                    $created = date('Y-m-d H:i:s');
                    foreach($this->input->post('hotel_id') AS $list){
                        $insert_hotels[] = ['black_out_dates_id'=>$id,'hotel_id'=>$list,'created'=>$created];
                    }
                    $this->common_model->insert_data_batch(['table_name'=>'black_out_dates_hotels','insert_data'=>$insert_hotels]);
                }
            }
            redirect('blackout-dates');
        }
    }
    
    public function delete_blackout_dates(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('blackout-dates');
        $update_arr = ['status'=>'deleted'];
        $affected = $this->common_model->update_data_limit(['table_name'=>'black_out_dates','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($affected){            
            $where = ['black_out_dates_id'=>$id];
            $arr = ['status'=>'deleted','modified'=>date('Y-m-d H:i:s')];
            $affected_rows = $this->common_model->update_data(['table_name' => 'black_out_dates_hotels', 'update_data' => $arr, 'condition' => $where]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('blackout-dates');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function delete_blackout_hotels(){
        $this->form_validation->set_rules('black_out_dates_hotels_id', 'Black Out Date ID', 'trim|required|integer');
        $this->form_validation->set_rules('hotel_id', 'Hotel Id', 'trim|required|integer');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }
        $where = ['id'=>$this->input->post('black_out_dates_hotels_id'),'hotel_id'=>$this->input->post('hotel_id')];
        $arr = ['status'=>'deleted','modified'=>date('Y-m-d H:i:s')];
        $affected_rows = $this->common_model->update_data_limit(['table_name' => 'black_out_dates_hotels', 'update_data' => $arr, 'condition' => $where]);
        
        if ($affected_rows) {
            echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Hotel Removed Successfully!</div>']);
            exit;
        }
    }
    
    public function location_master_list()
    {
        $data['locations'] = $this->locations;
        $data['result'] = $this->common_model->get_data('location_masters', '', '', '*', '', ' ORDER BY location_masters.id DESC', $count = false);

        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $id = base64_decode($this->input->get('id'));

        $arr = array(
            'country' => $this->input->post('country'),
            'location' => $this->input->post('location'),
            'status' => $this->input->post('status'),
            'destination_type' => $this->input->post('destination_type'),
        );

        if ($this->input->get('id') <> '') {
            ($id == '') ? redirect('location-master') : '';
            $where = 'id = ' . $id;
            $data['result_data'] = $this->common_model->get_data('location_masters', '', '', '*', $where, '', $count = false)[0];
            if (empty($data['result_data'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
                redirect('location-master');
            }
        }

        $where = "country = " . $this->db->escape($this->input->post('country')) . 
        " AND location = " . $this->db->escape($this->input->post('location'));

       $exist_record = $this->common_model->get_data('location_masters', '', '', '*', $where, '', $count = false);

        // Check form validation
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/location_master', $data);
        } else {
            if (!empty($exist_record)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Record already exists! Please edit.!!</div>');
            } 
            else if (!empty($id)) {
                // Update existing record
                $update_condition = ['id' => $id];
                $this->common_model->update_data_limit([
                    'table_name' => 'location_masters',
                    'update_data' => $arr,
                    'condition' => $update_condition
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Location Master Updated Successfully!</div>');
            } else {
                    $this->common_model->insert_data([
                        'table_name' => 'location_masters',
                        'insert_data' => $arr
                    ]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Location Master added successfully!!</div>');
            }
            redirect('location-master');
        }
    }
    
}
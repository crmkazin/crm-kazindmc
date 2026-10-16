<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Controller {
    
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
        $data['result'] = $this->common_model->get_data('sites','', '', '*',$where, ' ORDER BY sites.id DESC', $count = false);
        //echo '<pre>';print_r($data['result']);exit;
        $this->load->view('admin/itinerary_masters_list',$data);
    }
    
    public function create(){
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/itinerary_masters_create');
        }else {
            $insert_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),
                            'site_name'=>$this->input->post('name'),'category'=>$this->input->post('category'),
                            'entry_ticket'=>$this->input->post('entry_ticket'),'departing_time_from_hotel'=>$this->input->post('departing_time'),
                            'duration'=>$this->input->post('duration'),'description'=>$this->input->post('description'),
                            'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
            $id = $this->common_model->insert_data(['table_name'=>'sites','insert_data'=>$insert_arr]);
            if($id){
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
        $this->form_validation->set_error_delimiters('', '<br>');
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-masters');
        if($this->form_validation->run() == FALSE){            
            $where = 'sites.id= '.$id;
            $data['result'] = $this->common_model->get_data('sites','', '', '*',$where,'', $count = false)[0];
            if(empty($data['result'])){
                redirect('all-masters');
            }
            $this->load->view('admin/itinerary_masters_edit',$data);
        }else {
            $update_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),
                            'site_name'=>$this->input->post('name'),'category'=>$this->input->post('category'),
                            'entry_ticket'=>$this->input->post('entry_ticket'),'departing_time_from_hotel'=>$this->input->post('departing_time'),
                            'duration'=>$this->input->post('duration'),'description'=>$this->input->post('description'),
                            'admin_id'=>$this->session->userdata('id')];
            $update_data = ['table_name'=>'sites','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            if($affected_rows){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
            }
            redirect('all-masters');
        }
        
    }
    
    public function create_restaurants(){
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/itinerary_masters_create_restaurant');
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
                            'name'=>$this->input->post('name'),'image'=>$image,'price_range'=>$this->input->post('price_range'),
                            'description'=>$this->input->post('description'),'cuisine'=>$cuisine,
                            'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
            $id = $this->common_model->insert_data(['table_name'=>'restaurants','insert_data'=>$insert_arr]);
            if($id){
                $this->session->set_flashdata('message','<div class="alert alert-success">Created Successfully!</div>');
                redirect('all-masters-restaurants');
            }
        }
    }
    
    public function restaurants(){
        $where = 'restaurants.status != "deleted"';
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
            $update_arr = ['country'=>$this->input->post('country'),'city'=>$this->input->post('city'),
                            'name'=>$this->input->post('name'),'price_range'=>$this->input->post('price_range'),
                            'description'=>$this->input->post('description'),'cuisine'=>$cuisine,
                            'admin_id'=>$this->session->userdata('id')];
            if($image<>''){
                $update_arr = $update_arr + ['image'=>$image];
            }
            $update_data = ['table_name'=>'restaurants','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            if($affected_rows){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');    
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
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(['admin/hotel_model','hotel_model','admin/user_model','common_model']);
        check_delete();
    }	

    public function index() {
        $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
      //  $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
       // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'trim|required');
       // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
       // $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        // $this->form_validation->set_rules('category', 'Category', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if($this->form_validation->run() == FALSE) {
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $this->load->view('admin/hotel', $data);

        } else {
            
            $response = $this->hotel_model->add_new_hotel();
            
            if($response['success'] == 1){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                redirect('all-hotel');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function edit() {
        $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
      //  $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
       // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'trim|required');
       // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
       // $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        // $this->form_validation->set_rules('category', 'Category', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
       
        $hotel_id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-hotel');
        
        if($this->form_validation->run() == FALSE) {
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            $where = 'id = '.$hotel_id;
            $data['hotels'] = $this->common_model->get_data('hotels','', '', '*',$where,'', $count = false)[0];
            
            $this->load->view('admin/hotel_edit', $data);

        } else {
            $data = array(
                'name'                => $this->input->post('name'),
                'address_1'           => $this->input->post('address_1'),
                'address_2'           => $this->input->post('address_2'),
                'city'                => $this->input->post('city'),
                'state'               => $this->input->post('state'),
                'country'             => $this->input->post('country'),
                'email'               => $this->input->post('email'),
                'isd_codes'           => $this->input->post('isd_codes'),
                'mobile'              => $this->input->post('mobile'),
                'contact_person_name' => $this->input->post('contact_person_name'),
                'remarks'             => $this->input->post('remarks'),
                'pincode'             => $this->input->post('pincode'),
                'status'              => 'active',
                'map'                 => $this->input->post('map'),
                'category'          => $this->input->post('category')
            );
            
            if($_FILES['hotel_image']['name']!=''){
                $this->load->library('upload');
                $config['upload_path'] = './uploads/hotels/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['hotel_image']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('hotel_image')){ 
                    //echo $this->upload->display_errors();
                }else{
                    $file = $this->upload->data();
                    $data['image'] = $file['file_name']; 
                }
            }
            $id = $this->common_model->update_data_limit(['table_name'=>'hotels','update_data'=>$data,'condition'=>['id'=>$hotel_id]]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                redirect('all-hotel');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function hotel_list(){
        $country = '';
        if($this->session->userdata('admin_type') != 'superadmin'){
            $country = ($this->session->userdata('locations')!='all')?ucfirst($this->session->userdata('locations')):'';
        }
        $data['hotels'] = $this->hotel_model->all_hotels($country);   
        $this->load->view('admin/hotel_list',$data);	    
    }

    public function room_category(){
        $hotel_id = ($this->input->get('hotel_id')<>'' && base64_decode($this->input->get('hotel_id'))<>'')?base64_decode($this->input->get('hotel_id')):redirect('all-hotel');
        $where = 'hotel_id = '.$hotel_id;
        $data['categories'] = $this->common_model->get_data('hotel_room_categories','', '', '*',$where,'', $count = false);
        $category_id = '';
        if($this->input->get('category_id')<>''){
            $category_id = base64_decode($this->input->get('category_id'));
            ($category_id=='')?redirect('room-category-hotel?hotel_id='.base64_encode($hotel_id)):'';
            $where = 'hotel_id = '.$hotel_id.' AND id = '.$category_id;
            $data['category'] = $this->common_model->get_data('hotel_room_categories','', '', '*',$where,'', $count = false)[0];
            if(empty($data['category'])) { 
                $this->session->set_flashdata('message','<div class="alert alert-danger">No Records Found!</div>');  
                redirect('room-category-hotel?hotel_id='.base64_encode($hotel_id));
            } 
        }
        
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
        $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/hotel_room_category',$data);
        }else{
             $arr = array(
        		'category_name'     =>$this->input->post('category_name'),
        		'number_adults'     =>$this->input->post('adult_number'),
        		'number_childs'		=>$this->input->post('child_number'),
        		'child_bed'	        =>$this->input->post('child_bed'),
        		'added_by'          =>$this->session->userdata('id'),
            );
            if($category_id <>''){
                $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');  
                $id = $this->common_model->update_data_limit(['table_name'=>'hotel_room_categories','update_data'=>$arr,'condition'=>['id'=>$category_id,'hotel_id'=>$hotel_id]]);
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>');  
                $insert_arr = $arr + ['hotel_id'=>$hotel_id,'created'=>date('Y-m-d H:i:s')];
                $id = $this->common_model->insert_data(['table_name'=>'hotel_room_categories','insert_data'=>$insert_arr]);    
            }
            redirect('room-category-hotel?hotel_id='.base64_encode($hotel_id));
        }
    }
    
    public function get_rooms_category(){
        $this->form_validation->set_rules('hotel_id', 'Hotel', 'trim|required|integer');
        
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>validation_errors()];
            echo json_encode($response);exit;
        }
        $hotel_id = $this->input->post('hotel_id');
        $where = 'hotel_id = '.$hotel_id;
        $data['room_categories'] = $this->common_model->get_data('hotel_room_categories','', '', '*',$where,'', $count = false);
        
        $enq_id = $this->input->post('enq_id');
        $details_id = $this->input->post('hotel_details_id');
        $where = 'hotel_id = '.$hotel_id . ' AND enquiry_id = '.$enq_id.' AND id = '.$details_id;
        $data['hotel_details'] = $this->common_model->get_data('arrival_hotel_details','', '', '*',$where,'', $count = false)[0];
        
        if(empty($data)){
            $response = ['response'=>'e','details'=>'','msg'=>'No room categories found!'];
            echo json_encode($response);exit;
        }else{
            $response = ['response'=>'s','details'=>$data,'msg'=>''];
            echo json_encode($response);exit;    
        }
        
    }
    
    public function delete_hotel(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-hotel');
        $update_arr = ['status'=>'deleted'];
        $id = $this->common_model->update_data_limit(['table_name'=>'hotels','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($id){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('all-hotel');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
    }
    
}

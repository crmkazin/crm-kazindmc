<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guide extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model(['admin/guide_model','guide_model','admin/user_model','common_model']);
        check_delete();
    }	

    public function index(){
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim');
        //$this->form_validation->set_rules('photo', 'Photo', 'callback_check_photo');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //$this->form_validation->set_message('check_photo', 'The file must be a JPG, JPEG, or PNG image.');
       
        if($this->form_validation->run() == FALSE){
            $this->load->model(['admin/user_model','common_model']);
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            log_user_activity('Guide Add',$this->session->userdata('id'), 'Guide: Add');
            $data['content'] = 'admin/guide';
            $this->load->view('admin/layout', $data);
        } else {
            $response = $this->guide_model->add_guide();
            if($response['success'] == 1){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Guide Add New',$this->session->userdata('id'), 'Guide: Add New');
                redirect('all-guide');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Guide Add Error',$this->session->userdata('id'), 'Guide: Add(Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
       	    
    }

    public function guide_list(){
        log_user_activity('Guide View',$this->session->userdata('id'), 'Guide: View');
        $filters = [];
        if ($this->input->get('submit')) {
            $filters = [
                'country' => $this->input->get('country'),
                'state' => $this->input->get('state'),
                'city'    => $this->input->get('city')
            ];
            log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
        }
        $data['guides'] = $this->guide_model->all_guides($filters);    
        $data['content'] = 'admin/guide_list';
        $this->load->view('admin/layout',$data);	    
    }

    public function check_photo($str)
    {
         // Check if a file has been uploaded
        if (!empty($_FILES['photo']['name'])) {
            $allowed_extensions = ['jpg', 'jpeg', 'png'];

            // Get the uploaded file's extension
            $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

            // Check if the file extension is in the list of allowed extensions
            if (!in_array($file_extension, $allowed_extensions)) {
                return false;
            }
        }
        return true;
    }
    
    public function edit(){
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim');
        //$this->form_validation->set_rules('photo', 'Photo', 'callback_check_photo');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //$this->form_validation->set_message('check_photo', 'The file must be a JPG, JPEG, or PNG image.');
       
        $guide_id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-guide');
       
        $where1 = 'id = '.$guide_id;
        $existing = $this->common_model->get_single(['table_name' => 'guides', 'condition'  => $where1 ]);

            if (!empty($existing)) {
                $previous_data = [
                    'country' => $existing['country'],
                    'state'         => $existing['state'],
                    'city'         => $existing['city'],
                    'name'         => $existing['name'],
                    'last_name'         => $existing['last_name'],
                    'gender'         => $existing['gender'],
                    'isd_codes'         => $existing['isd_codes'],
                    'contact_number'         => $existing['contact_number'],
                    'remarks'         => $existing['remarks'],
                    'location'         => $existing['location'],
                    'status'         => $existing['status'],
                    'languages'         => $existing['languages'],
                    'photo'         => $existing['photo'],
                ];
            } else {
                $previous_data = []; 
            }

        if($this->form_validation->run() == FALSE){
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            
            $where = 'id = '.$guide_id;
            $data['guide'] = $this->common_model->get_data('guides','', '', '*',$where,'', $count = false)[0];
            log_user_activity('Guide: Edit',$this->session->userdata('id'), 'Guide: Edit');
            $data['content'] = 'admin/guide_edit';
            $this->load->view('admin/layout', $data);
        } else {
            $languages = (array_key_exists('languages', $this->input->post()) && $this->input->post('languages')[0]<>'')?implode(',',$this->input->post('languages')):'';
            $data = array(
                'country'        => $this->input->post('country'),
                'state'          => $this->input->post('state'),
                'city'           => $this->input->post('city'),
                'name'           => $this->input->post('name'),
                'last_name'      => $this->input->post('last_name'),
                'gender'         => $this->input->post('gender'),
                'isd_codes'      => $this->input->post('isd_codes'),
                'contact_number' => $this->input->post('mobile'),
                'remarks'        => $this->input->post('remarks') ?? '',
                'location'       => $this->input->post('location'),
                'status'         => 'active',
                'languages'      => $languages
            );
            
            if($_FILES['photo']['name']!=''){
                $this->load->library('upload');
                $config['upload_path'] = './assets/guide/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['photo']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('photo')){ 
                    //echo $this->upload->display_errors();
                }else{
                    $file = $this->upload->data();
                    $data['photo'] = $file['file_name']; 
                }
            }
            
            $rows = $this->common_model->update_data_limit(['table_name'=>'guides','update_data'=>$data,'condition'=>['id'=>$guide_id]]);
            if($rows){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Guide: Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
                redirect('all-guide');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Guide: Update Error',$this->session->userdata('id'), 'Guide:Update (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        
    }
    
    public function delete_guide(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-guide');
        $update_arr = ['status'=>'deleted'];
        $id = $this->common_model->update_data_limit(['table_name'=>'guides','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($id){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Guide Delete',$this->session->userdata('id'), 'Guide: Deleted');
            redirect('all-guide');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Guide Delete Error',$this->session->userdata('id'), 'Guide: Deleted (Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
    }
    
    public function get_prices(){
        $guide_id = ($this->input->post('guide_id')<>'')?base64_decode($this->input->post('guide_id')):'';
        $where = 'guide_id = '.$guide_id;
        $select = 'guide_costing.*,DATE_FORMAT(guide_costing.created,"%d-%b-%Y %h:%i %p") AS created';
        $guide_prices = $this->common_model->get_data('guide_costing','', '', $select,$where,'', $count = false);
        echo json_encode(['response' => 's', 'details' => $guide_prices, 'msg' => '']);
        exit;
    }

    public function add_prices(){
        //echo '<pre>';print_r($this->input->post('hdn_guide_costing_id'));exit;
        $this->form_validation->set_rules('guide_id', 'Guide', 'trim|required');
        //$this->form_validation->set_rules('day_fixed_prices', 'Day Fixed Prices', 'trim|required|integer');
        //$this->form_validation->set_rules('day_hourly_prices', 'Day Hourly Prices', 'trim|required|integer');
        //$this->form_validation->set_rules('night_fixed_prices', 'Night Fixed Prices', 'trim|required|integer');
        //$this->form_validation->set_rules('night_hourly_prices', 'Night Hourly Prices', 'trim|required|integer');        
        $this->form_validation->set_error_delimiters('', '<br>');
        $guide_id = ($this->input->post('guide_id')<>'')?base64_decode($this->input->post('guide_id')):'';
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }
        $created = date('Y-m-d H:i:s');$insert = 0;
        if($this->input->post('day_fixed_prices') <> '' || $this->input->post('day_hourly_prices') <> ''){
            $ins_data = ['shift_type' => 'day','fixed_prices'=>$this->input->post('day_fixed_prices'),
                        'hourly_prices'=>$this->input->post('day_hourly_prices'),'guide_id' => $guide_id,
                        'created'=>$created,'added_by'=>$this->session->userdata('id')];
            $insert = $this->common_model->insert_data(['table_name' => 'guide_costing', 'insert_data' => $ins_data]);
            if(!empty($this->input->post('hdn_guide_costing_id[]'))){
                $update_data = ['status' => 'inactive'];
                $this->db->where('guide_id', $guide_id);
                $this->db->where('shift_type', 'day');
                $this->db->where_in('id', $this->input->post('hdn_guide_costing_id[]'));
                $this->db->update('guide_costing', $update_data);
            }
        }
        if($this->input->post('night_fixed_prices') <> '' || $this->input->post('night_hourly_prices') <> ''){
            $ins_data = ['shift_type' => 'night','fixed_prices'=>$this->input->post('night_fixed_prices'),
                        'hourly_prices'=>$this->input->post('night_hourly_prices'),'guide_id' => $guide_id,
                        'created'=>$created,'added_by'=>$this->session->userdata('id')];

            $insert = $this->common_model->insert_data(['table_name' => 'guide_costing', 'insert_data' => $ins_data]);
            if(!empty($this->input->post('hdn_guide_costing_id[]'))){
                $update_data = ['status' => 'inactive'];
                $this->db->where('guide_id', $guide_id);
                $this->db->where('shift_type', 'night');
                $this->db->where_in('id', $this->input->post('hdn_guide_costing_id[]'));
                $this->db->update('guide_costing', $update_data);
            }
        }
        
        if (!$insert) {
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Guide prices not added!</div>']);
            log_user_activity('Guide Price Add Error',$this->session->userdata('id'), 'Guide Price Add(Guide prices not added!)');
            exit;
        }
        log_user_activity('Guide Price Add',$this->session->userdata('id'), 'Guide Price Add');
        echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Guide prices added successully!</div>']);
        exit;
    }
    
    public function print_guide_details(){
        $guide_id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):'';
        $where = 'id = '.$guide_id;
        $select = 'guides.*';
        $data['guide'] = $this->common_model->get_data('guides','', '', $select,$where,'', $count = false)[0];
        //echo '<pre>';print_r($data['guide']);exit;
        if ($this->input->get('print') == 'pdf') {
            log_user_activity('Guide: Guide Details Save as PDF',$this->session->userdata('id'), 'Guide: Guide Details Save as PDF');
            // $data['content'] = 'admin/print_guide_details_pdf';
            $this->load->view('admin/print_guide_details_pdf', $data);
        } else {
            log_user_activity('Guide: Print Guide Details',$this->session->userdata('id'), 'Guide: Print Guide Details');
            // $data['content'] = 'admin/print_guide_details';
            $this->load->view('admin/print_guide_details', $data);
        }
    }
    
}

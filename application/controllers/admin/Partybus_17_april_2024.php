<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partybus extends CI_Controller {

    var $allowed_users = ['1','2','3'];
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
                redirect('login');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model','admin/partybus_model']);
        $this->load->library('pagination');
    }		

    public function add(){
        
        $data_arr = array(
            'table_name' => 'packages',
            'condition' => array('status' => 'active') // Example condition
        );
        
        $data['packages'] = $this->common_model->get_rows($data_arr);
        $this->load->view('admin/add_party_bus',$data);
    }
    
    public function add_data()
    {
        $this->form_validation->set_rules('file_number', 'File Number', 'trim|required');
        $this->form_validation->set_rules('date_of_booking', 'Date of Booking', 'trim|required');
        $this->form_validation->set_rules('time_slot','Time Slot' ,'trim|required');
        $this->form_validation->set_rules('reporting_location','Reporting Location' ,'trim|required');
        $this->form_validation->set_rules('end_location','End Location' ,'trim|required');
        $this->form_validation->set_rules('package','Package' ,'trim|required|integer');
        $this->form_validation->set_rules('passengers','Passengers' ,'trim|required|integer');
        $this->form_validation->set_rules('currency','Currency' ,'trim|required');
        $this->form_validation->set_rules('package_price','Package Price' ,'trim|required|integer');
        $this->form_validation->set_rules('payment_recieved','Payment Recieved' ,'trim|required|integer');
        $this->form_validation->set_rules('balance','Balance' ,'trim|required|integer');

        // print_r($this->input->post());
        // exit;
        if (!$this->form_validation->run()) {
            $data_arr = array(
                'table_name' => 'packages',
                'condition' => array('status' => 'active') 
            );
            $data['packages'] = $this->common_model->get_rows($data_arr);
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Fill form Currectly to add the Bus..</div>');
            $this->load->view('admin/add_party_bus',$data);
        } else {
            $result = $this->partybus_model->add_bus();
            if ($result) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                redirect('party-bus');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error!</div>');
                redirect('party-bus');
            }
        }
    }


    public function index(){        
        $data['buses'] = $this->partybus_model->get_rows();
        $this->load->view('admin/party_bus',$data);
    }
    
    public function delete_bus(){        
        $result = $this->partybus_model->delete_bus();    
        if($result){
            $this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');	
            redirect('party-bus');		
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Try Again!</div>');	
            redirect('party-bus');		
        }    
    }
}
?>
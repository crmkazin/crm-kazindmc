<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(['admin/flight_model','flight_model']);
    }	

    public function index(){

        $this->form_validation->set_rules('airline_id', 'Airline Id', 'trim|required');
        $this->form_validation->set_rules('flight_number', 'Flight Number', 'trim|required');
        $this->form_validation->set_rules('flight_type', 'Flight Type', 'trim|required');
        $this->form_validation->set_rules('departure_city', 'Departure City', 'trim|required');
        $this->form_validation->set_rules('arrival_city', 'Arrival City', 'trim|required');
        $this->form_validation->set_rules('departure_date', 'Departure Date', 'trim|required');
        $this->form_validation->set_rules('arrival_date', 'Arrival Date', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if($this->form_validation->run() == FALSE){
            $data['airlines'] = $this->flight_model->all_airlines();   
            $this->load->view('admin/flight', $data);	    
        } else {
            $response = $this->flight_model->add_flight();
            if($response['success'] == 1){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                redirect('all-flight');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        
    }

    public function flight_list(){
        $data['flights'] = $this->flight_model->all_flight();    
        $this->load->view('admin/flight_list', $data);	    
    }

   
    
}

?>
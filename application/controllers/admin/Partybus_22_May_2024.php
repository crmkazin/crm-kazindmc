<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partybus extends CI_Controller
{

    var $allowed_users = ['1', '2', '3','4'];
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        if (!in_array($this->session->userdata('type'),$this->allowed_users) || !in_array(strtolower($this->session->userdata('locations')),['kazakhstan','all'])) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model', 'common_model', 'admin/company_model', 'admin/user_model', 'admin/dashboard_model', 'admin/partybus_model']);
        $this->load->library('pagination');
    }

    public function add()
    {

        $data_arr = array(
            'table_name' => 'packages',
            'condition' => array('status' => 'active')
        );

        $query = $this->db->select_max('id')
            ->get('party_bus');
        $row = $query->row_array();
        $last_id = $row['id'];

        $data['insert_on'] = $last_id + 1;

        $data['packages'] = $this->common_model->get_rows($data_arr);
        $this->load->view('admin/add_party_bus', $data);
    }

    public function add_data()
    {
        $this->form_validation->set_rules('file_number', 'File Number', 'trim|required');
        $this->form_validation->set_rules('enquiry_form', 'File Number', 'trim|required');
        $this->form_validation->set_rules('date_of_booking', 'Date of Booking', 'trim|required');
        $this->form_validation->set_rules('start_time', 'Start Time Slot', 'trim|required');
        $this->form_validation->set_rules('end_time', 'End Time Slot', 'trim|required');
        $this->form_validation->set_rules('reporting_location', 'Reporting Location', 'trim|required');
        $this->form_validation->set_rules('end_location', 'End Location', 'trim|required');
        $this->form_validation->set_rules('passengers', 'Passengers', 'trim|required|integer');
        $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        $this->form_validation->set_rules('package_price', 'Package Price', 'trim|required|integer');
        $this->form_validation->set_rules('payment_recieved', 'Payment Recieved', 'trim|required|integer');
        $this->form_validation->set_rules('balance', 'Balance', 'trim|required|integer');

        if (!$this->form_validation->run()) {
            $data_arr = array(
                'table_name' => 'packages',
                'condition' => array('status' => 'active')
            );
            $data['packages'] = $this->common_model->get_rows($data_arr);
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Fill form Currectly to add the Bus..</div>');
            $this->load->view('admin/add_party_bus', $data);
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

    public function edit()
    {
        $id = base64_decode($this->input->get('id'));

        $data_arr = array(
            'table_name' => 'packages',
            'condition' => array('status' => 'active')
        );
        $data['packages'] = $this->common_model->get_rows($data_arr);

        $data_arr = array(
            'table_name' => 'party_bus',
            'condition' => array('id' => $id)
        );
        $data['party_bus'] = $this->common_model->get_rows($data_arr);
        $this->load->view('admin/edit_party_bus', $data);
    }

    public function data_edit()
    {
        $id = $this->input->post('bus_id');

        $update_arr = array(
            'file_Number' => $this->input->post('file_number'),
            'enquiry_form' => $this->input->post('enquiry_form'),
            'kazin_query' => empty($this->input->post('kazin_query')) ? '' : $this->input->post('kazin_query'),
            'date_of_booking' => $this->input->post('date_of_booking'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'reporting_location' => $this->input->post('reporting_location'),
            'end_location' => $this->input->post('end_location'),
            'package' => empty($this->input->post('package')) ? '' : $this->input->post('package'),
            'number_of_passengers' => $this->input->post('passengers'),
            'currency' => $this->input->post('currency'),
            'package_price' => $this->input->post('package_price'),
            'payment_recieved' => $this->input->post('payment_recieved'),
            'balance' => $this->input->post('balance'),
            'status' => '1'
        );

        $update_data = ['table_name' => 'party_bus', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
        $update = $this->common_model->update_data_limit($update_data);

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Upadted Successfully!</div>');
            redirect('party-bus');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Not Anything Updated!</div>');
            redirect('party-bus');
        }

    }


    public function index()
    {
        $data['buses'] = $this->partybus_model->get_rows();
        $this->load->view('admin/party_bus', $data);
    }

    public function delete_bus()
    {
        $result = $this->partybus_model->delete_bus();
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect('party-bus');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
            redirect('party-bus');
        }
    }
}
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partybus extends CI_Controller
{

    var $allowed_users = ['1','3','4'];
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        if (!in_array($this->session->userdata('type'), $this->allowed_users) || !in_array(strtolower($this->session->userdata('locations')), ['kazakhstan', 'all'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
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
            'purchase_cost' => $this->input->post('purchase_cost'),
            'net_margin' => $this->input->post('net_margin'),
            'remarks' => $this->input->post('remarks'),
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
        $data_arr = array(
            'table_name' => 'packages',
            'condition' => array('status' => 'active')
        );
        $data['packages'] = $this->common_model->get_rows($data_arr);

        $result_cnt = $this->partybus_model->count_rows();

        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'party-bus?' . $search[0];
        $config["total_rows"] = $result_cnt;
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="paginate_button page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item">';
        $config['num_tag_close'] = '</li>';
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;
        $data['buses'] = $this->partybus_model->get_rows($config["per_page"], $offset);
        $data['links'] = $this->pagination->create_links();
        $this->load->view('admin/party_bus', $data);
    }


    public function excel_download()
    {
        $this->db->select('party_bus.*, packages.package');
        $this->db->join('packages', 'packages.id = party_bus.package', 'left');
        $this->db->where('party_bus.status', 1);

        if ($this->input->get('submit') == '') {
            $this->db->where('party_bus.date_of_booking>=', date('Y-m-d'));
        }

        if ($this->input->get('booking_date') <> '') {
            $booking_date = urldecode($this->input->get('booking_date'));
            $this->db->where('party_bus.date_of_booking', $booking_date);
        }

        if (!empty($this->input->get('file_number'))) {
            $file_number = urldecode($this->input->get('file_number'));
            $this->db->where('party_bus.file_number', $file_number);
        }
        if (!empty($this->input->get('kazin_query'))) {
            $kazin_query = urldecode($this->input->get('kazin_query'));
            $this->db->where('party_bus.kazin_query', $kazin_query);
        }
        if (!empty($this->input->get('package'))) {
            $package = urldecode($this->input->get('package'));
            $this->db->where('party_bus.package ', $package);
        }

        $this->db->order_by('party_bus.date_of_booking', 'ASC');
        $query = $this->db->get('party_bus');
        $result = $query->result();

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Date Of Booking	');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Start Time');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'End Time');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'File No.');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Kazin Query');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'No. of Passengers	');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Package');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Package Price	');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Balance');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Purchase Cost');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Net Margin');

        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $val) {

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, date('d-M-Y', strtotime($val->date_of_booking)));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $val->start_time);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->end_time);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, ucfirst($val->file_number));
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $val->kazin_query);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $val->number_of_passengers);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $val->package);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $val->package_price);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $val->balance);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $val->purchase_cost);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $val->net_margin);
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="' . 'Party-Bus_' . date('d-m-Y') . '.xlsx' . '"');

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


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
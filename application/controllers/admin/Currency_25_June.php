<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends CI_Controller {
    
    var $currency_name = ['azerbaijan'=>['name'=>'manat','abbr'=>'AZN'],'belarus'=>['name'=>'ruble','abbr'=>'BYN'],
                        'georgia'=>['name'=>'lari','abbr'=>'GEL'],'kazakhstan'=>['name'=>'tenge','abbr'=>'KZT']];

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library('pagination');
        /*if(!in_array($this->session->userdata('id'),['8','13'])){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }*/
    }		
	
    public function index(){
        $where = 'currency_value.status = "active"';
        $join = [['type'=>'','join_table'=>'admin','condition'=>'currency_value.admin_id = admin.id'],];
        
        $select = 'currency_value.*,admin.name';
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'currency_list/?'.$search[0];
        $config["total_rows"] = $this->common_model->get_data('currency_value','', '', 'currency_value.id',$where, '', $count = true);
        $config["per_page"] = 10;
        //$config["uri_segment"] = 2;
        $config['full_tag_open'] = '<ul class="pagination float-right">';
        $config['full_tag_close'] = '</ul>';
        //$config['first_link'] = True;
        //$config['last_link'] = True;
        //$config['first_link'] = 'First';
        //$config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        //$config['prev_tag_open'] = '<li class="prev">';
        //$config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a style="color: #fff;" href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['page_query_string'] = TRUE;
        //$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;
        $data['result'] = $this->common_model->get_data('currency_value',$offset, $config["per_page"], $select,$where, ' ORDER BY currency_value.id DESC', $count = false,$join);
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($data['result']);exit;
        $data['total'] = $config["total_rows"];
        $data['links'] = $this->pagination->create_links(); 
        $this->load->view('admin/currency_list',$data);
    }
    
    public function add_value(){
        if ($this->session->userdata('type') != 1 && $this->session->userdata('type') != 3 && $this->session->userdata('type') != 5) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('inr_value', 'INR Value', 'trim|required|decimal');
        $this->form_validation->set_error_delimiters('<div class="alert-danger" style="padding:4px;">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $select = 'countries.*';
            $where = 'countries.id IN("15", "20", "81", "112")';
            $data['countries'] = $this->common_model->get_data('countries', '', '', $select, $where, '', $count = false);
            $data['currency_name'] = $this->currency_name;        
            $this->load->view('admin/add_currency_value',$data);
        }else{
            $country = $this->input->post('country');
            $curr_name = $this->currency_name[$country]['name'];
            $curr_abbr = $this->currency_name[$country]['abbr'];
            $data = ['currency_name' => $curr_name,'currency_abbr' => $curr_abbr,'country'=>$country,'inr_value'=>trim($this->input->post('inr_value')),
                    'admin_id'=>$this->session->userdata('id'), 'created'=>date('Y-m-d H:i:s'),'modified'=>date('Y-m-d H:i:s')];
            $insert = $this->common_model->insert_data(['table_name' => 'currency_value', 'insert_data' => $data]);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Currency Value Added Successfully!</div>');
            redirect('currency_list');
        }
        
    }
       
}
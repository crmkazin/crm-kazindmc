<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itinerary extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library('pagination');
    }		
	
    public function index(){
        $where = 'itinerary.status != "deleted" GROUP BY itinerary.arrival_id';
        $join = [['type'=>'','join_table'=>'arrivals','condition'=>'arrivals.id = itinerary.arrival_id'],
                ['type'=>'','join_table'=>'enquiry','condition'=>'enquiry.id = arrivals.enquiry_id']];
        
        $select = 'enquiry.enquiry_no,enquiry.number_persons,enquiry.number_child,enquiry.check_in_date,enquiry.check_out_date,arrivals.group_type,itinerary.content,itinerary.arrival_id';
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'all-itinerary/?'.$search[0];

        $config["total_rows"] = $this->common_model->get_data('itinerary','', '', 'itinerary.id',$where, '', $count = true);
        $config["per_page"] = 10;
        //$config["uri_segment"] = 2;
        $config['full_tag_open'] = '<ul class="pagination">';
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
        $data['result'] = $this->common_model->get_data('itinerary',$offset, $config["per_page"], $select,$where, ' ORDER BY itinerary.id DESC', $count = false,$join);
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($data['result']);exit;
        $data['links'] = $this->pagination->create_links(); 
        $this->load->view('admin/itinerary_list',$data);
    }
    
    public function create(){
        
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-itinerary');
        
        $query = 'SELECT CONCAT_WS("|",hotels.name,hotels.address_1,hotels.city,hotels.state,hotels.country,hotels.contact_person_name) AS hotel, ';
        $query .= 'CONCAT_WS("|",transportation.vehicle_type,transportation.vehicle_name,transportation.capacity,transportation.luggage) AS trans, ';
        $query .= 'CONCAT_WS("|",CONCAT(guides.name," ",guides.last_name),guides.contact_number,guides.photo) AS guide ';
        $query .= 'FROM arrivals LEFT JOIN hotels ON hotels.id = arrivals.hotel_id LEFT JOIN transportation ON transportation.id = arrivals.transportation_id ';
        $query .= 'LEFT JOIN guides ON guides.id = arrivals.guide_id WHERE arrivals.id = '.$id;
        $data['suggestions'] = $this->common_model->custom_query($query);
        
        $query1 = 'SELECT enquiry.*,arrivals.*,transportation.vehicle_type,transportation.vehicle_name,hotels.name AS hotel_name, ';
        $query1 .= 'company.name AS agent,CONCAT(guides.name," ",guides.last_name) AS guide_name ';
        $query1 .= 'FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id LEFT JOIN transportation ON transportation.id = arrivals.transportation_id ';
        $query1 .= 'LEFT JOIN company ON company.company_id = enquiry.company_id ';
        $query1 .= 'LEFT JOIN hotels ON hotels.id = arrivals.hotel_id ';
        $query1 .= 'LEFT JOIN guides ON guides.id = arrivals.guide_id WHERE arrivals.id = '.$id;
        $data['details'] = $this->common_model->custom_query($query1)[0];
        
        $query2 = 'SELECT arrival_flight_details.*';
        $query2 .= 'FROM arrival_flight_details LEFT JOIN arrivals ON arrival_flight_details.enquiry_id = arrivals.enquiry_id ';
        $query2 .= 'WHERE arrivals.id = '.$id;
        $data['flight_details'] = $this->common_model->custom_query($query2);
        //echo '<pre>';print_r($data['flight_details']);exit;
        $this->load->view('admin/itinerary',$data);
    }
    public function save(){
        //echo '<pre>';print_r($_POST);exit;
        $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
        $this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');
        $this->form_validation->set_rules('itinerary_text_0[]', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $cnt = count($this->input->post('itinerary_date'));
        $created = date('Y-m-d H:i:s');
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        for($i=0;$i<$cnt;$i++){
            $cnt_text = count($this->input->post('itinerary_text_'.$i));
            for($j=0;$j<$cnt_text;$j++){
                $insert_array[] = ['date'=>$this->input->post('itinerary_date')[$i],
                                    'content'=>$this->input->post('itinerary_text_'.$i)[$j],
                                    'time'=>$this->input->post('itinerary_time_'.$i)[$j],
                                    'remarks'=>$this->input->post('itinerary_remarks_'.$i)[$j],
                                    'arrival_id'=>$arrival_id,'admin_id'=>$this->session->userdata('id'),'created'=>$created];
            }
        }
        $this->common_model->insert_data_batch(['table_name'=>'itinerary','insert_data'=>$insert_array]);
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Created Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function edit(){
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-itinerary');
        
        $query = 'SELECT CONCAT_WS("|",hotels.name,hotels.address_1,hotels.city,hotels.state,hotels.country,hotels.contact_person_name) AS hotel, ';
        $query .= 'CONCAT_WS("|",transportation.vehicle_type,transportation.vehicle_name,transportation.capacity,transportation.luggage) AS trans, ';
        $query .= 'CONCAT_WS("|",CONCAT(guides.name," ",guides.last_name),guides.contact_number,guides.photo) AS guide ';
        $query .= 'FROM arrivals LEFT JOIN hotels ON hotels.id = arrivals.hotel_id LEFT JOIN transportation ON transportation.id = arrivals.transportation_id ';
        $query .= 'LEFT JOIN guides ON guides.id = arrivals.guide_id WHERE arrivals.id = '.$id;
        $data['suggestions'] = $this->common_model->custom_query($query);
        
        $query1 = 'SELECT enquiry.*,arrivals.*,transportation.vehicle_type,transportation.vehicle_name,hotels.name AS hotel_name, ';
        $query1 .= 'company.name AS agent,CONCAT(guides.name," ",guides.last_name) AS guide_name ';
        $query1 .= 'FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id LEFT JOIN transportation ON transportation.id = arrivals.transportation_id ';
        $query1 .= 'LEFT JOIN company ON company.company_id = enquiry.company_id ';
        $query1 .= 'LEFT JOIN hotels ON hotels.id = arrivals.hotel_id ';
        $query1 .= 'LEFT JOIN guides ON guides.id = arrivals.guide_id WHERE arrivals.id = '.$id;
        $data['details'] = $this->common_model->custom_query($query1)[0];
        
        $query2 = 'SELECT arrival_flight_details.*';
        $query2 .= 'FROM arrival_flight_details LEFT JOIN arrivals ON arrival_flight_details.enquiry_id = arrivals.enquiry_id ';
        $query2 .= 'WHERE arrivals.id = '.$id;
        $data['flight_details'] = $this->common_model->custom_query($query2);
        
        $where = 'itinerary.arrival_id= '.$id;
        $data['itinerary'] = $this->common_model->get_data('itinerary','', '', '*',$where,' ORDER BY itinerary.date ASC', $count = false);
        
        //echo '<pre>';print_r($data['itinerary']);exit;
        $this->load->view('admin/itinerary_edit',$data);
    }
    
    public function update(){
        $this->form_validation->set_rules('time', 'Itinerary Time', 'trim|required');
        $this->form_validation->set_rules('txt', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Id', 'trim|required');
        $this->form_validation->set_rules('u_id', 'Itinerary Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $itinerary_id = base64_decode($this->input->post('u_id'));
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $update_arr = ['time'=>$this->input->post('time'),'content'=>$this->input->post('txt'),
                        'remarks'=>$this->input->post('remarks')];
        $update_data = ['table_name'=>'itinerary','update_data'=>$update_arr,'condition'=>['id'=>$itinerary_id,'arrival_id'=>$arrival_id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        if($affected_rows){
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Updated Successfully</div>'];
        }else{ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Error! Try Again.</div>'];
        }
        echo json_encode($response);
    }
    
    public function add_update(){
        //echo '<pre>';print_r($_POST);exit;
        $this->form_validation->set_rules('date', 'Itinerary Date', 'trim|required');
        $this->form_validation->set_rules('time', 'Itinerary Time', 'trim|required');
        $this->form_validation->set_rules('txt', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $created = date('Y-m-d H:i:s');
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $insert_array = ['date'=>$this->input->post('date'),'content'=>$this->input->post('txt'),
                        'time'=>$this->input->post('time'),'remarks'=>$this->input->post('remarks'),
                        'arrival_id'=>$arrival_id,'admin_id'=>$this->session->userdata('id'),'created'=>$created];
        $this->common_model->insert_data(['table_name'=>'itinerary','insert_data'=>$insert_array]);
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Added And Updated Successfully</div>'];
        echo json_encode($response);
        exit;
    }
}
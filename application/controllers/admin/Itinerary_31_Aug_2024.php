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
        /*if(!in_array($this->session->userdata('id'),['8','13'])){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }*/
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
        if($this->session->userdata('type')!=1){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-itinerary');
        
        $where = 'itinerary.arrival_id= '.$id;
        $cnt_itinerary = $this->common_model->get_data('itinerary','', '', '*',$where,' ORDER BY itinerary.date ASC', $count = true);
        if($cnt_itinerary){
            redirect('edit_itinerary?id='.base64_encode($id));
        }
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
        
        $char = substr($data['details']->enquiry_abbr,1,1);
        $country = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        
        $query2 = 'SELECT arrival_flight_details.*';
        $query2 .= 'FROM arrival_flight_details LEFT JOIN arrivals ON arrival_flight_details.enquiry_id = arrivals.enquiry_id ';
        $query2 .= 'WHERE arrivals.id = '.$id;
        $data['flight_details'] = $this->common_model->custom_query($query2);

        $data['arrival_date'] = $arrival_date = $data['departure_date'] = $departure_date = '';
        $arrival_time = $departure_time = '';

        $qry1 = 'SELECT min(arrival_flight_details.arrival_date) AS arrivalDate,min(arrival_flight_details.arrival_time) AS arrivalTime FROM `arrival_flight_details` JOIN arrivals ON arrival_flight_details.enquiry_id=arrivals.enquiry_id WHERE arrival_flight_details.flight_mode="inbound" AND arrivals.id='.$id;
        $arrival_date_result = $this->common_model->custom_query($qry1); 
        $arrival_date = $arrival_date_result[0]->arrivalDate;
        $arrival_time = $arrival_date_result[0]->arrivalTime;

        $qry2 = 'SELECT max(arrival_flight_details.departure_date) AS departureDate,max(arrival_flight_details.departure_time) AS departureTime FROM `arrival_flight_details` JOIN arrivals ON arrival_flight_details.enquiry_id=arrivals.enquiry_id WHERE arrival_flight_details.flight_mode="outbound" AND arrivals.id='.$id;
        $departure_date_result = $this->common_model->custom_query($qry2);
        $departure_date = $departure_date_result[0]->departureDate; 
        $departure_time = $departure_date_result[0]->departureTime;
        
        if($departure_time<>''){
            $arr = explode(':',$departure_time);
            if((int)$arr[0]<3){
                $departure_time = '00:'.$arr[1];
            }else{ 
                $t = ((int)$arr[0]-3);
                $t = (strlen($t)==2)?$t:'0'.$t;
                $departure_time = $t.':'.$arr[1];                    
            }
        }
        $departure_time = ($departure_time<>'')?$departure_time:'08:00';

        //echo '<pre>';print_r($data['flight_details']);exit;
        //$template_id = 1;
        $where = 'country = "'.$country[$char] .'" AND itinerary_templates_content.status != "deleted"';
        $template = $this->common_model->get_data('itinerary_templates_content','', '', '*',$where, ' ORDER BY itinerary_templates_content.id ASC', $count = false);
        
        $start_date = new DateTime($arrival_date);
        $last_date = new DateTime($departure_date);
        $diff = $last_date->diff($start_date);
        $data['duration'] = $diff->d;
        for($i=0;$i<=$diff->d;$i++){
            $date = date('Y-m-d', strtotime($arrival_date)+($i*24*60*60));
            if($i==0){
                //$arrival_time = (isset($data['flight_details'][0]) && $data['flight_details'][0]->arrival_time<>'')?$data['flight_details'][0]->arrival_time:'10:00';
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>$arrival_time,'content'=>$template[0]->content,'remarks'=>''];
            }else if($i==$diff->d){                
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>$departure_time,'content'=>$template[2]->content,'remarks'=>''];
            }else{
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>'07:00','content'=>$template[1]->content,'remarks'=>''];
            }
        }
        //echo '<pre>';print_r($data);exit;
        
        $this->load->view('admin/itinerary',$data);
    }
    public function save(){
        //echo '<pre>';print_r($_POST);exit;
        $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
        $this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');
        //$this->form_validation->set_rules('itinerary_text_0[]', 'Itinerary Text', 'trim|required');
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
                                    'title'=>$this->input->post('itinerary_title_'.$i)[$j],
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
        if($this->session->userdata('type')!=1){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
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
        $data['arrival_date'] = $arrival_date = $data['departure_date'] =$departure_date = '';
        foreach($data['flight_details'] AS $list){
            if($list->flight_mode == 'inbound'){
                $data['arrival_date'] = $arrival_date = $list->arrival_date;
            }elseif($list->flight_mode == 'outbound'){
                $data['departure_date'] = $departure_date = $list->departure_date;
            }
        }
        $start_date = new DateTime($arrival_date);
        $last_date = new DateTime($departure_date);
        $diff = $last_date->diff($start_date);
        $data['duration'] = $diff->d;
        
        $where = 'itinerary.arrival_id= '.$id .' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary','', '', '*',$where,' ORDER BY itinerary.date,itinerary.time ASC', $count = false);
        
        //echo '<pre>';print_r($data['itinerary']);exit;
        $this->load->view('admin/itinerary_edit',$data);
    }
    
    public function update(){
        $this->form_validation->set_rules('time', 'Itinerary Time', 'trim|required');
        //$this->form_validation->set_rules('txt', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Id', 'trim|required');
        $this->form_validation->set_rules('u_id', 'Itinerary Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $itinerary_id = base64_decode($this->input->post('u_id'));
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $update_arr = ['time'=>$this->input->post('time'),'title'=>$this->input->post('title'),
                        'content'=>$this->input->post('txt'),
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
        //$this->form_validation->set_rules('txt', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $created = date('Y-m-d H:i:s');
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $insert_array = ['date'=>$this->input->post('date'),'title'=>$this->input->post('title'),
                        'content'=>$this->input->post('txt'),
                        'time'=>$this->input->post('time'),'remarks'=>$this->input->post('remarks'),
                        'arrival_id'=>$arrival_id,'admin_id'=>$this->session->userdata('id'),'created'=>$created];
        $this->common_model->insert_data(['table_name'=>'itinerary','insert_data'=>$insert_array]);
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Added And Updated Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function template(){
        $this->load->view('admin/itinerary_template');
    }
    public function save_template(){
        if(!array_key_exists('template_id', $this->input->post())){
            $this->form_validation->set_rules('template_name', 'Itinerary Template Name', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('itinerary_day[]', 'Itinerary Day', 'trim|required');
            $this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');
            $this->form_validation->set_rules('itinerary_text_0[]', 'Itinerary Text', 'trim|required');

            $this->form_validation->set_error_delimiters('', '<br>');  
            if($this->form_validation->run() == FALSE){
                echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
                exit;
            }
        }
        $created = date('Y-m-d H:i:s');
        if(array_key_exists('template_id', $this->input->post()) && $this->input->post('template_id')<>''){
            $update_arr = ['name'=>$this->input->post('template_name'),'country'=>$this->input->post('country'),
                            'city'=>$this->input->post('city'),'admin_id'=>$this->session->userdata('id')];
            $template_id = base64_decode($this->input->post('template_id'));
            $update_data = ['table_name'=>'itinerary_templates','update_data'=>$update_arr,'condition'=>['id'=>$template_id]];
            $this->common_model->update_data_limit($update_data);
        }else{            
            $insert_arr = ['name'=>$this->input->post('template_name'),'country'=>$this->input->post('country'),
                            'city'=>$this->input->post('city'),'admin_id'=>$this->session->userdata('id'),'created'=>$created];
            $template_id = $this->common_model->insert_data(['table_name'=>'itinerary_templates','insert_data'=>$insert_arr]);
        }
        $cnt = (array_key_exists('itinerary_day', $this->input->post()))?count($this->input->post('itinerary_day')):0;
        if($cnt){
            for($i=0;$i<$cnt;$i++){
                $cnt_text = count($this->input->post('itinerary_text_'.$i));
                for($j=0;$j<$cnt_text;$j++){
                    $insert_array[] = ['day'=>$this->input->post('itinerary_day')[$i],
                                        'content'=>$this->input->post('itinerary_text_'.$i)[$j],
                                        'time'=>$this->input->post('itinerary_time_'.$i)[$j],
                                        'remarks'=>$this->input->post('itinerary_remarks_'.$i)[$j],
                                        'template_id'=>$template_id,'admin_id'=>$this->session->userdata('id'),'created'=>$created];
                }
            }
            $this->common_model->insert_data_batch(['table_name'=>'itinerary_templates_content','insert_data'=>$insert_array]);
        }
        
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Template Created Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function all_templates(){
        $where = 'itinerary_templates.status != "deleted"';
        if($this->input->get('submit')=='Search'){
            if($this->input->get('name')<>''){
                $where_and = ($where!='')?' AND ':'';
                $where .= $where_and.'itinerary_templates.name LIKE "%'.urldecode($this->input->get('name')).'%"';
            }
            if($this->input->get('country')<>''){
                $where_and = ($where!='')?' AND ':'';
                $where .= $where_and.'LOWER(itinerary_templates.country)="'.strtolower($this->input->get('country')).'"';
            }
        }
        
        $select = '*';
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'all-templates/?'.$search[0];
        $config["total_rows"] = $this->common_model->get_data('itinerary_templates','', '', 'itinerary_templates.id',$where, '', $count = true);
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
        $data['result'] = $this->common_model->get_data('itinerary_templates',$offset, $config["per_page"], $select,$where, ' ORDER BY itinerary_templates.id DESC', $count = false);
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($data['result']);exit;
        $data['links'] = $this->pagination->create_links(); 
        $this->load->view('admin/itinerary_templates_list',$data);
    }
    
    public function template_edit(){
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-templates');
        $select = 'itinerary_templates.name,itinerary_templates.country,itinerary_templates.city, itinerary_templates_content.*';
        $where = 'itinerary_templates.id= '.$id.' AND itinerary_templates_content.status != "deleted"';
        $join = [['type'=>'LEFT','join_table'=>'itinerary_templates_content','condition'=>'itinerary_templates.id = itinerary_templates_content.template_id']];
        $data['template_content'] = $this->common_model->get_data('itinerary_templates','', '', $select,$where,' ORDER  BY itinerary_templates_content.day,itinerary_templates_content.time ASC', $count = false,$join);
        if(empty($data['template_content'][0])){
            redirect('all-templates');
        }
        //echo '<pre>';print_r($data);exit;
        $this->load->view('admin/itinerary_template_edit',$data);
    }
    
    public function update_template(){
        $this->form_validation->set_rules('time', 'Itinerary Time', 'trim|required');
        $this->form_validation->set_rules('txt', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('u_id', 'Itinerary Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $template_id = base64_decode($this->input->post('u_id'));
        $update_arr = ['time'=>$this->input->post('time'),'content'=>$this->input->post('txt'),
                        'remarks'=>$this->input->post('remarks')];
        $update_data = ['table_name'=>'itinerary_templates_content','update_data'=>$update_arr,'condition'=>['id'=>$template_id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        if($affected_rows){
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Template Updated Successfully</div>'];
        }else{ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Error! Try Again.</div>'];
        }
        echo json_encode($response);
    }
    
    public function add_update_template(){
        $this->form_validation->set_rules('day', 'Itinerary Day', 'trim|required');
        $this->form_validation->set_rules('time', 'Itinerary Time', 'trim|required');
        $this->form_validation->set_rules('txt', 'Itinerary Text', 'trim|required');
        $this->form_validation->set_rules('template_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $created = date('Y-m-d H:i:s');
        $template_id = base64_decode($this->input->post('template_id'));
        $insert_array = ['day'=>$this->input->post('day'),'content'=>$this->input->post('txt'),
                        'time'=>$this->input->post('time'),'remarks'=>$this->input->post('remarks'),
                        'template_id'=>$template_id,'admin_id'=>$this->session->userdata('id'),'created'=>$created];
        $this->common_model->insert_data(['table_name'=>'itinerary_templates_content','insert_data'=>$insert_array]);
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Template Added And Updated Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    public function get_city(){
        $country_id = $this->input->post('country_id');
        $search = $this->input->post('search');
        $query = 'SELECT cities.name AS label FROM cities '; 
        $query .= 'JOIN states ON states.id=cities.state_id '; 
        $query .= 'JOIN countries ON countries.id=states.country_id WHERE countries.id = '. $country_id;
        $query .= ' AND cities.name LIKE "%'.$search.'%" LIMIT 10';
        $suggestions = $this->common_model->custom_query($query);
        echo json_encode($suggestions); 
    }
    
    public function get_suggesstions(){
        $type = $this->input->post('type');
        $char = substr($this->input->post('location'),1,1);
        $locations = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        if(in_array($type, ["sitescene", "night-life", "activity", "transfers", "miscellaneous"])){
            $select = 'sites.id,sites.site_name,sites.description,sites.departing_time_from_hotel,UPPER(sites.entry_ticket) AS entry_ticket';
            $where = 'sites.status= "active" AND sites.category = "'.$type.'" AND LOWER(sites.country) = "'.$locations[$char].'"';        
            $details = $this->common_model->get_data('sites','', '', $select,$where,'', $count = false);
        }else if($type=='restaurants'){
            $select = 'restaurants.name,UPPER(restaurants.cuisine) AS cuisine,restaurants.id,restaurants.description';
            $where = 'restaurants.status= "active" AND LOWER(restaurants.country) = "'.$locations[$char].'"';        
            $details = $this->common_model->get_data('restaurants','', '', $select,$where,'', $count = false);
        }
        $response = ['response'=>'s','details'=>$details,'msg'=>'<div class="alert alert-success">Details Fetched Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function update_remove(){
        $this->form_validation->set_rules('arrival_id', 'Id', 'trim|required');
        $this->form_validation->set_rules('u_id', 'Itinerary Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $itinerary_id = base64_decode($this->input->post('u_id'));
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $update_arr = ['status'=>'deleted','admin_id'=>$this->session->userdata('id')];
        $update_data = ['table_name'=>'itinerary','update_data'=>$update_arr,'condition'=>['id'=>$itinerary_id,'arrival_id'=>$arrival_id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        if($affected_rows){
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Itinerary Deleted Successfully</div>'];
        }else{ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Error! Try Again.</div>'];
        }
        echo json_encode($response);
    }
    
    public function template_update_remove(){
        $this->form_validation->set_rules('template_id', 'Id', 'trim|required');
        $this->form_validation->set_rules('u_id', 'Itinerary Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $itinerary_id = base64_decode($this->input->post('u_id'));
        $template_id = base64_decode($this->input->post('template_id'));
        $update_arr = ['status'=>'deleted','admin_id'=>$this->session->userdata('id')];
        $update_data = ['table_name'=>'itinerary_templates_content','update_data'=>$update_arr,'condition'=>['id'=>$itinerary_id,'template_id'=>$template_id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        if($affected_rows){
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Template Itinerary Deleted Successfully</div>'];
        }else{ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Error! Try Again.</div>'];
        }
        echo json_encode($response);
    }
    
    public function get_itinerary_master_remarks(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $type_arr = ['sites'=>['table'=>'itinerary_masters_remarks','column'=>'sites_id'],
                'restaurants'=>['table'=>'restaurants_remarks','column'=>'restaurant_id']];
        $select = '*';
        $where = $type_arr[$type]['column'].' = '.$id;
        $data['remarks'] = $this->common_model->get_data($type_arr[$type]['table'],'', '', $select,$where,'', $count = false);
        $response = ['response'=>'s','details'=>$data['remarks'],'msg'=>'<div class="alert alert-success">Details Fetched Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function update_itinerary_dates(){
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $cnt = count($this->input->post('date_itinerary[]'));
        //echo '<pre>'.$cnt;print_r($this->input->post());exit;
        for($i=0;$i<$cnt;$i++){
            $query = 'UPDATE itinerary SET date = "'.$this->input->post('date_itinerary')[$i].'" WHERE id IN ('.$this->input->post('hdn_itinerary_ids')[$i].') AND arrival_id = '.$arrival_id;
            $this->db->query($query);
        }
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Updated Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function guide_details(){
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $where = 'arrivals.id = '.$arrival_id .' GROUP BY guide_costing.guide_id';
        $join = [['type'=>'','join_table'=>'enquiry_guide','condition'=>'enquiry_guide.enquiry_id = arrivals.enquiry_id'],
                ['type'=>'LEFT','join_table'=>'guide_costing','condition'=>'(guide_costing.guide_id = enquiry_guide.guide_id AND guide_costing.status="active")'],
                ['type'=>'','join_table'=>'guides','condition'=>'guides.id = enquiry_guide.guide_id'],];
        $select = 'guides.id,guides.name,GROUP_CONCAT(UPPER(guide_costing.shift_type)," : ",IF(guide_costing.hourly_prices!="",guide_costing.hourly_prices,"NA")," (Hourly) , ",If(guide_costing.fixed_prices!="",guide_costing.fixed_prices,"NA")," (Fixed)" ORDER BY guide_costing.shift_type ASC SEPARATOR " | ") AS details';
        $guides = $this->common_model->get_data('arrivals','', '', $select,$where,'', $count = false,$join);
        
        $where = 'arrivals_guide_costing.arrival_id = '.$arrival_id.' AND arrivals_guide_costing.status = "active"';
        $order_by = ' ORDER BY arrivals_guide_costing.date ASC';
        $join = [['type'=>'','join_table'=>'guides','condition'=>'arrivals_guide_costing.guide_id = guides.id'],];
        $select = 'guides.name,DATE_FORMAT(arrivals_guide_costing.date,"%d-%b-%Y") AS d, arrivals_guide_costing.*';
        $added_guides = $this->common_model->get_data('arrivals_guide_costing','', '', $select,$where,$order_by, $count = false,$join);
        
        $response = ['response'=>'s','details'=>$guides,'added_guides'=>$added_guides,'msg'=>''];
        echo json_encode($response);
        exit;
        
    }
    
    public function add_guide_cost(){
        $this->form_validation->set_rules('guide_id', 'Guide', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('shift_type', 'Shift Type', 'trim|required');
        $this->form_validation->set_rules('cost_type', 'Cost Type', 'trim|required');
        $this->form_validation->set_rules('arrival_id', 'Arrivals ID', 'trim|required');
        if($this->input->post('cost_type') == 'hourly'){
            $this->form_validation->set_rules('number_of_hours', 'Number of hours', 'trim|required|integer');
        }else{ $_POST['number_of_hours']=''; }
        
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $arr = ['fixed'=>'fixed_prices','hourly'=>'hourly_prices'];
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $where = 'guide_costing.guide_id = '.$this->input->post('guide_id').' AND guide_costing.shift_type = "'.$this->input->post('shift_type').'" AND guide_costing.status="active"';
        $select = 'guide_costing.'.$arr[$this->input->post('cost_type')];
        $guide_prices = $this->common_model->get_data('guide_costing','', '', $select,$where,'', $count = false)[0];
        $guide_prices = (array)$guide_prices;
        if(empty($guide_prices) || $guide_prices[$arr[$this->input->post('cost_type')]]==''){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">No costing found.</div>']);
            exit;
        }
        
        $where = 'arrivals_guide_costing.guide_id = '.$this->input->post('guide_id').' AND arrivals_guide_costing.shift_type = "'.$this->input->post('shift_type').'" AND arrivals_guide_costing.arrival_id='.$arrival_id;
        $where .= ' AND arrivals_guide_costing.cost_type = "'.$this->input->post('cost_type').'" AND arrivals_guide_costing.date = "'.$this->input->post('date').'" AND arrivals_guide_costing.status = "active"';
        $select = 'arrivals_guide_costing.id';
        $guide_prices_exists = $this->common_model->get_data('arrivals_guide_costing','', '', $select,$where,'', $count = true);
        
        if($guide_prices_exists){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">Already costing added!</div>']);
            exit;
        }
        
        $insert_arr = ['arrival_id'=>$arrival_id,'guide_id'=>$this->input->post('guide_id'),'date'=>$this->input->post('date'),
                        'cost'=>$guide_prices[$arr[$this->input->post('cost_type')]],'cost_type'=>$this->input->post('cost_type'),
                        'shift_type'=>$this->input->post('shift_type'),'number_of_hours'=>$this->input->post('number_of_hours'),
                        'added_by'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
        $insert = $this->common_model->insert_data(['table_name' => 'arrivals_guide_costing', 'insert_data' => $insert_arr]);
        if($insert){
            echo json_encode(['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Guide costing added successully!</div>']);
            exit;
        }
    }
    
    public function guidecosting_remove(){
        $this->form_validation->set_rules('id', 'Costing Id', 'trim|required|integer');
        $this->form_validation->set_rules('arrival_id', 'Arrivals ID', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $arrival_id = base64_decode($this->input->post('arrival_id'));
        $update_arr = ['status'=>'deleted','modified'=>date('Y-m-d H:i:s'),'updated_by'=>$this->session->userdata('id')];
        $update_data = ['table_name'=>'arrivals_guide_costing','update_data'=>$update_arr,'condition'=>['id'=>$this->input->post('id'),'arrival_id'=>$arrival_id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        if($affected_rows){
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Guide costing removed successfully</div>'];
        }else{ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">Error! Try Again.</div>'];
        }
        echo json_encode($response);
    }
    
    
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrivalchart extends CI_Controller {
    
    var $locations = ['kazakhstan'=>['FKZ','GKZ','IKZ'],'azerbaijan'=>['FAZ','GAZ','IAZ'],'belarus'=>['FBZ','GBZ','IBZ'],'georgia'=>['FGE','GGE','IGE'],
                    'all'=>['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE']];
    var $allowed_users = ['1','2'];
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
                redirect('login');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library('pagination');
    }		
	
    public function index()
    {   
        $data['counts'] = $this->dashboard_model->arrival_status_count();
        $where = '';
        if($this->session->userdata('type') == 2){
            //$where = 'arrivals.added_by='.$this->session->userdata('id');    
        }
        
        if($this->input->SERVER('QUERY_STRING')==''){
            $where_and = ($where!='')?' AND ':'';
            $where.= $where_and.'date(arrivals.arrival_date) >= "'.date('Y-m-d').'"';
        }
        
        if($this->input->get('date_from') <> '' && $this->input->get('date_to') <> ''){
            $where_and = ($where!='')?' AND ':'';
            $where.= $where_and.'date(arrivals.arrival_date) >="'.$this->input->get('date_from').'" AND date(arrivals.arrival_date) <="'.$this->input->get('date_to').'"';
        }
        if($this->input->get('status') <> ''){
            $where_and = ($where!='')?' AND ':'';
            $where.= $where_and.'arrivals.status ="'.urldecode($this->input->get('status')).'"';
        }
        $enquiry_join = 'enquiry.id = arrivals.enquiry_id';
        if($this->input->get('country') <> ''){
            $enquiry_join .= ' AND SUBSTR(enquiry.enquiry_abbr, 2, 1) = "'.urldecode($this->input->get('country')).'"';
        }
        if($this->input->get('query_number') <> ''){
            $enquiry_join .= ' AND enquiry.enquiry_no = "'.urldecode($this->input->get('query_number')).'"';
        }
        
        $select = 'arrivals.*,transportation.vehicle_type,guides.name AS guide,enquiry.enquiry_no,enquiry.number_persons,enquiry.number_child,enquiry.number_of_nights,admin.name AS staff_name,company.name';
        $join = [['type'=>'','join_table'=>'enquiry','condition'=>'('.$enquiry_join.')'],
                ['type'=>'LEFT','join_table'=>'transportation','condition'=>'transportation.id = arrivals.transportation_id'],
                ['type'=>'LEFT','join_table'=>'guides','condition'=>'guides.id = arrivals.guide_id'],
                ['type'=>'LEFT','join_table'=>'admin','condition'=>'admin.id = arrivals.handling_staff_id'],
                ['type'=>'LEFT','join_table'=>'company','condition'=>'company.company_id = enquiry.company_id'],];
        
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'arrivals/?'.$search[0];

        $config["total_rows"] = $this->common_model->get_data('arrivals','', '', 'arrivals.id',$where, '', $count = true,$join);
        //echo $this->db->last_query();
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
        $data['result'] = $this->common_model->get_data('arrivals',$offset, $config["per_page"], $select,$where, ' ORDER BY arrivals.arrival_date ASC', $count = false,$join);
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($data['result']);exit;
        $data['links'] = $this->pagination->create_links();     
        $this->load->view('admin/arrivals_list',$data);
    }	
	
    public function add(){
        if(!in_array($this->session->userdata('type'),$this->allowed_users)){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
	    //$this->form_validation->set_rules('arrival_date', 'Arrival date', 'trim|required');  
	    $this->form_validation->set_rules('handling_staff', 'Handling Staff', 'trim|required');  
	    //$this->form_validation->set_rules('transportation', 'Transportation', 'trim|required'); 
	    //$this->form_validation->set_rules('transportation_id', 'Transportation Selection', 'trim|required|integer'); 
	    //$this->form_validation->set_rules('guide', 'Guide', 'trim|required'); 
	    //$this->form_validation->set_rules('guide_id', 'Guide Selection', 'trim|required|integer'); 
	    $this->form_validation->set_rules('group_type', 'Group', 'trim|required'); 
	    $this->form_validation->set_rules('handover_to_client', 'Client Handover', 'trim|required'); 
	    $this->form_validation->set_rules('handover_to_kazin', 'Kazin Handover', 'trim|required'); 
	    $this->form_validation->set_rules('handover_to_client', 'Group', 'trim|required'); 
	    $this->form_validation->set_rules('enq_id', 'Enquiry', 'trim|required'); 
	    if(in_array($this->session->userdata('type'),['1','3'])){
                $this->form_validation->set_rules('client_billing', 'Client Billing', 'trim|required|integer'); 
                $this->form_validation->set_rules('payment_india', 'Payment India', 'trim|required|integer'); 
                $this->form_validation->set_rules('payment_almaty', 'Payment Almaty', 'trim|required|integer'); 
                $this->form_validation->set_rules('currency', 'Currency', 'trim|required'); 
            }
	    
        if($this->form_validation->run() == FALSE){
            $data['locations'] = $this->locations;
            $id = base64_decode($this->input->get('enq_id'));
            $where = 'enquiry.id= '.$id;
            $join = [['type'=>'LEFT','join_table'=>'company','condition'=>'enquiry.company_id = company.company_id'],];
            $enquiry = $this->common_model->get_data('enquiry','', '', 'enquiry.*,company.name',$where,'', $count = false,$join);
            if(empty($enquiry)){
                redirect('enquiry-followup');
            }
            $data['enquiry'] = $enquiry[0];
            
            $data['users'] = $this->user_model->all_user();
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            //echo '<pre>';print_r($data['enquiry']);exit;
            
            $where = 'arrival_room_details.enquiry_id= '.$id;
            $select = 'arrival_room_details.*,hotels.name AS hotel_name';
            $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_room_details.hotel_id'],];
            $data['arrival_room'] = $this->common_model->get_data('arrival_room_details','', '', $select,$where,'', $count = false,$join);
            
            foreach($data['arrival_room'] AS $list){
                $where = 'arrival_persons_details.arrival_room_details_id = '.$list->id;
                $data['arrival_persons'][$list->id] = $this->common_model->get_data('arrival_persons_details','', '', '*',$where,'', $count = false);
            }
            
            $where = 'arrival_flight_details.enquiry_id= '.$id;
            $select = 'arrival_flight_details.*,airlines.*';
            $join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
            $data['arrival_flights'] = $this->common_model->get_data('arrival_flight_details','', '', $select,$where,'', $count = false,$join);
            
            $where = '';
            $select = 'DISTINCT flight_schedule.departure_airport';
            //$join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
            $data['departure_airports'] = $this->common_model->get_data('flight_schedule','', '', $select,$where,'', $count = false);
            
            $where = 'arrival_hotel_details.enquiry_id = '.$id;
            $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
            $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_hotel_details.hotel_id'],];
            $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,'', $count = false,$join);
            //echo '<pre>';print_r($data);exit;
            $this->load->view('admin/add_arrivalchart',$data);
        }
        else{ 
            $lead_photo = '';
            if($_FILES['lead_photo']['name'] != ''){
                $this->load->library('upload');
                $config['upload_path'] = './uploads/lead_photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['lead_photo']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('lead_photo')){ 
                    //echo $this->upload->display_errors();
                }else{
                    $filename = $this->upload->data();
                    $lead_photo = $filename['file_name'];
                }          
                    
            }
            
            // add new arrival chart
            $insert_arr = array(
        		'arrival_date' =>   $this->input->post('hdn_arrival_date'),
        		'handling_staff_id' =>$this->input->post('handling_staff'),
        		'enquiry_id'		=>$this->input->post('enq_id'),
        		'transportation_id'	=>$this->input->post('transportation_id'),
        		'guide_id'		=> $this->input->post('guide_id'),
        		'hotel_id'		=> ($this->input->post('hotel_id')<>'')?$this->input->post('hotel_id'):0,
        		'lead_name'		=> $this->input->post('lead_name'),
        		'lead_isd_code'=> $this->input->post('lead_isd_code'),
        		'lead_contact'	=> $this->input->post('lead_contact'),
        		'lead_photo'    => $lead_photo,
        		'number_rooms'		=> $this->input->post('number_rooms'),
            		'group_type'=>      $this->input->post('group_type'),
        		'handover_to_client'=>$this->input->post('handover_to_client'),
        		'handover_to_kazin'=> $this->input->post('handover_to_kazin'),
        		'added_by'=>$this->session->userdata('id'),
        		'status'=>'in-progress',
        		'created'		=>date('Y-m-d H:i:s'),
            );
            if(in_array($this->session->userdata('type'),['1','3'])){
                $balance = $this->input->post('client_billing') - ($this->input->post('payment_india')+$this->input->post('payment_almaty'));
                $insert_arr = $insert_arr + ['client_billing'=>$this->input->post('client_billing'),
                                    'payment_received_india'=>$this->input->post('payment_india'),
                                    'payment_received_almaty'=>$this->input->post('payment_almaty'),
                                    'balance_amount'=> $balance,//$this->input->post('balance_amount'),
                                    'currency'=>$this->input->post('currency')];
            } 
             
            $id = $this->common_model->insert_data(['table_name'=>'arrivals','insert_data'=>$insert_arr]);
            if($id){
                $enq_id = $this->input->post('enq_id');
                $update_arr = ['number_persons'=>$this->input->post('number_persons'),'number_child'=>$this->input->post('number_child')];
                $update_data = ['table_name'=>'enquiry','update_data'=>$update_arr,'condition'=>['id'=>$enq_id]];
                $this->common_model->update_data_limit($update_data);
                $this->session->set_flashdata('message','<div class="alert alert-success">Added Successfully!</div>'); 
            }
            else{ $this->session->set_flashdata('message','<div class="alert alert-error">Error in adding. Try Again!</div>'); }
            redirect('arrivals');
        }
	}

    public function edit(){
	    //$this->form_validation->set_rules('arrival_date', 'Arrival date', 'trim|required');  
	    //$this->form_validation->set_rules('handling_staff', 'Handling Staff', 'trim|required');  
	    //$this->form_validation->set_rules('transportation', 'Transportation', 'trim|required'); 
	    //$this->form_validation->set_rules('transportation_id', 'Transportation Selection', 'trim|required|integer'); 
	    //$this->form_validation->set_rules('guide', 'Guide', 'trim|required'); 
	    //$this->form_validation->set_rules('guide_id', 'Guide Selection', 'trim|required|integer'); 
	    //$this->form_validation->set_rules('group_type', 'Group', 'trim|required'); 
	    //$this->form_validation->set_rules('handover_to_client', 'Client Handover', 'trim|required'); 
	    //$this->form_validation->set_rules('handover_to_kazin', 'Kazin Handover', 'trim|required'); 
	    //$this->form_validation->set_rules('currency', 'Currency', 'trim|required'); 
	    //$this->form_validation->set_rules('handover_to_client', 'Group', 'trim|required'); 
	    $this->form_validation->set_rules('arrival_id', 'Arrival', 'trim|required'); 
	    if(in_array($this->session->userdata('type'),['1','3'])){
                $this->form_validation->set_rules('client_billing', 'Client Billing', 'trim|required|integer'); 
                $this->form_validation->set_rules('payment_india', 'Payment India', 'trim|required|integer'); 
                $this->form_validation->set_rules('payment_almaty', 'Payment Almaty', 'trim|required|integer'); 
            }
	    
        if($this->form_validation->run() == FALSE){
            $data['locations'] = $this->locations;
            $id = base64_decode($this->input->get('id'));
            $where = 'arrivals.id= '.$id;
            $select = 'enquiry.id AS enq_id,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.number_persons,enquiry.number_child,enquiry.check_in_date,enquiry.number_of_nights,enquiry.check_out_date,company.name,arrivals.* ,';
            $select .= 'guides.name AS guide,transportation.vehicle_name,hotels.name AS hotel_name';
            $join = [['type'=>'LEFT','join_table'=>'enquiry','condition'=>'enquiry.id = arrivals.enquiry_id'],
                    ['type'=>'LEFT','join_table'=>'company','condition'=>'enquiry.company_id = company.company_id'],
                    ['type'=>'LEFT','join_table'=>'transportation','condition'=>'transportation.id = arrivals.transportation_id'],
                    ['type'=>'LEFT','join_table'=>'guides','condition'=>'guides.id = arrivals.guide_id'],
                    ['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrivals.hotel_id'],];
            $arrivals = $this->common_model->get_data('arrivals','', '', $select,$where,'', $count = false,$join);
            if(empty($arrivals)){
                redirect('arrivals');
            }
            $data['arrivals'] = $arrivals[0];
            $data['users'] = $this->user_model->all_user();
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes','', '', '*','','', $count = false);
            
            $where = 'arrival_room_details.enquiry_id= '.$arrivals[0]->enq_id;
            $select = 'arrival_room_details.*,hotels.name AS hotel_name,hotels.id AS hotel_id';
            $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_room_details.hotel_id'],];
            $data['arrival_room'] = $this->common_model->get_data('arrival_room_details','', '', $select,$where,'', $count = false,$join);
            
            foreach($data['arrival_room'] AS $list){
                $where = 'arrival_persons_details.arrival_room_details_id = '.$list->id;
                $data['arrival_persons'][$list->id] = $this->common_model->get_data('arrival_persons_details','', '', '*',$where,'', $count = false);
            }
            
            $where = 'arrival_flight_details.enquiry_id= '.$arrivals[0]->enq_id;
            $select = 'arrival_flight_details.*,airlines.name,airlines.id AS a_id';
            $join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
            $data['arrival_flights'] = $this->common_model->get_data('arrival_flight_details','', '', $select,$where,'', $count = false,$join);
            $data['allowed_users'] = $this->allowed_users;
            
            $where = 'hotel_id = '.$arrivals[0]->hotel_id;
            $data['hotel_room_categories'] = $this->common_model->get_data('hotel_room_categories','', '', '*',$where,'', $count = false);
            
            $where = '';
            $select = 'DISTINCT flight_schedule.departure_airport';
            //$join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
            $data['departure_airports'] = $this->common_model->get_data('flight_schedule','', '', $select,$where,'', $count = false);
            
            $where = 'arrival_hotel_details.enquiry_id = '.$arrivals[0]->enq_id;
            $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
            $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_hotel_details.hotel_id'],];
            $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,'', $count = false,$join);
            
            //echo '<pre>';print_r($data);exit;
            $this->load->view('admin/edit_arrivalchart',$data);
        }
        else{
            
            $update_arr = array(
        		'arrival_date' =>   $this->input->post('hdn_arrival_date'),
        		'handling_staff_id' =>$this->input->post('handling_staff'),
        		'transportation_id'	=>$this->input->post('transportation_id'),
        		'guide_id'		=> $this->input->post('guide_id'),
        		'hotel_id'		=> $this->input->post('hotel_id'),
        		'lead_name'		=> $this->input->post('lead_name'),
        		'lead_isd_code'=> $this->input->post('lead_isd_code'),
        		'lead_contact'		=> $this->input->post('lead_contact'),
        		'number_rooms'		=> $this->input->post('number_rooms'),
        		'group_type'=>      $this->input->post('group_type'),
        		'handover_to_client'=>$this->input->post('handover_to_client'),
        		'handover_to_kazin'=> $this->input->post('handover_to_kazin'),
        		'added_by'=>$this->session->userdata('id'),
        		'status'=>$this->input->post('status'),
            );
            if(in_array($this->session->userdata('type'),['1','3'])){
                $balance = $this->input->post('client_billing') - ($this->input->post('payment_india')+$this->input->post('payment_almaty'));
                $update_arr = $update_arr + ['client_billing'=>$this->input->post('client_billing'),
                    'payment_received_india'=>$this->input->post('payment_india'),
                    'payment_received_almaty'=>$this->input->post('payment_almaty'),
                    'balance_amount'=> $balance,//$this->input->post('balance_amount'),
                    'currency'=>$this->input->post('currency')];
            }
            
            if($_FILES['lead_photo']['name'] != ''){
                $this->load->library('upload');
                $config['upload_path'] = './uploads/lead_photo/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['detect_mime'] = TRUE;
                $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['lead_photo']['name']);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('lead_photo')){ 
                    //echo $this->upload->display_errors();
                }else{
                    $filename = $this->upload->data();
                    $update_arr['lead_photo'] = $filename['file_name'];
                }          
                    
            }
            
            if(!in_array($this->session->userdata('type'),$this->allowed_users)){
                $update_arr = array(
            		'transportation_id'	=>$this->input->post('transportation_id'),
            		'guide_id'		=> $this->input->post('guide_id'),
            		//'payment_received_almaty'=>$this->input->post('payment_almaty'),
            		//'balance_amount'=> $balance,//$this->input->post('balance_amount'),
            		'added_by'=>$this->session->userdata('id'),
            		'status'=>$this->input->post('status'),
                );
            }
            
            $id = base64_decode($this->input->post('arrival_id'));
            $update_data = ['table_name'=>'arrivals','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            
            $enq_id = $this->input->post('enq_id');
            $update_array = ['number_persons'=>$this->input->post('number_persons'),'number_child'=>$this->input->post('number_child')];
            $update = ['table_name'=>'enquiry','update_data'=>$update_array,'condition'=>['id'=>$enq_id]];
            $this->common_model->update_data_limit($update);
            
            //if($affected_rows){
            $this->session->set_flashdata('message','<div class="alert alert-success">Updated Successfully!</div>');
            //}else{ $this->session->set_flashdata('message','<div class="alert alert-danger">Error in updating. Try Again!</div>'); }
            redirect('arrivals');
        }
	}


    public function add_hotel(){
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('person_name', 'Contact Person Name', 'trim|required');
        $this->form_validation->set_rules('hotel_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_number', 'Contact Person Number', 'trim|required|integer');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        
        $where = ' LOWER(name)= "'. strtolower(trim($this->input->post('hotel_name'))).'" AND status!="deleted"';
        $res_hotels = $this->common_model->get_data('hotels','', '', '*',$where, '', $count = true);
        //echo $res_company;exit;
        if($res_hotels > 0){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-warning">Hotel with name ('.$this->input->post('hotel_name').') exists!</div>']);
            exit;
        }        
        $hotel_name = ucwords(strtolower($this->input->post('hotel_name')));
        
        $data = array(
        		'name' =>   $this->security->xss_clean($hotel_name),
        		'country'		=>$this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
        		'state'			=>$this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
        		'city'			=>$this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
        		'address_1'		=>$this->security->xss_clean($this->input->post('address_1')),
        		'address_2'		=>$this->security->xss_clean($this->input->post('address_2')),
        		'contact_person_name'=>$this->security->xss_clean(ucwords(strtolower($this->input->post('person_name')))),
        		'isd_codes'=>$this->security->xss_clean($this->input->post('isd_codes')),
        		'mobile'=>$this->security->xss_clean($this->input->post('contact_number')),
        		'email'			=>$this->security->xss_clean($this->input->post('hotel_email')),
        		'created'		=>date('Y-m-d H:i:s'),
                'remarks'			=>$this->security->xss_clean($this->input->post('remarks')),
                'pincode'			=>$this->security->xss_clean($this->input->post('pincode')),
                'category'			=>$this->security->xss_clean($this->input->post('category')),
            );
            $this->db->insert('hotels',$data);
            $id = $this->db->insert_id();
            echo json_encode(['response'=>'s','details'=>['hotel_name'=>$hotel_name,'h_id'=>$id],'msg'=>'<div class="alert alert-success">Hotel created successully!</div>']);
    }
    
    public function add_transportation(){
        $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'trim|required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        
        $where = ' LOWER(vehicle_type)= "'. strtolower(trim($this->input->post('vehicle_type'))).'" AND capacity = "'.trim($this->input->post('capacity')).'" AND status!="deleted"';
        $res_hotels = $this->common_model->get_data('transportation','', '', '*',$where, '', $count = true);
        //echo $res_company;exit;
        if($res_hotels > 0){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-warning">Vehicle with type ('.$this->input->post('vehicle_type').') and capacity exists!</div>']);
            exit;
        }        
        if($_FILES['upload_images']['name'][0]!=''){
            $cnt = count($_FILES['upload_images']['name']);
            if($cnt > 6){
                echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">Maximum 6 Images Allowed!</div>']);
                exit;    
            }
        }
        $data = array(
        		'vehicle_type' =>   $this->input->post('vehicle_type'),
        		'capacity' =>   $this->input->post('capacity'),
        		'created'		=>date('Y-m-d H:i:s'),
                'remarks'			=>$this->security->xss_clean($this->input->post('remarks')),
                'year' =>   $this->input->post('year'),
        		'make' =>   $this->input->post('make'),
        		'luggage' =>   $this->input->post('luggage'),
            );
        $this->db->insert('transportation',$data);
        $id = $this->db->insert_id();
        
        if($id){
            $this->load->library('upload');
            $insert_uploads = [];
            if($_FILES['upload_images']['name'][0]!=''){
                $cnt = count($_FILES['upload_images']['name']);
                $FILES['images'] = $_FILES['upload_images'];                
                $created = date('Y-m-d H:i:s');
                for($i=0;$i<$cnt;$i++) { 
                    $filename=[];$_FILES['inv']=[];
                    $_FILES['img']['name'] = $FILES['images']['name'][$i];
                    $_FILES['img']['type'] = $FILES['images']['type'][$i];
                    $_FILES['img']['tmp_name'] = $FILES['images']['tmp_name'][$i];
                    $_FILES['img']['error'] = $FILES['images']['error'][$i];
                    $_FILES['img']['size'] = $FILES['images']['size'][$i];
                    $config['upload_path'] = './uploads/transportation/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = $id.'_'.time().'_'.str_replace(' ','_',$_FILES['img']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('img')){ 
                        //echo $this->upload->display_errors();
                    }else{
                        $filename = $this->upload->data();
                    }          
                    $insert_uploads[$i] = ['transportation_id'=>$id,'image'=>$filename['file_name'],'created'=>$created];
                }
            }
            if(!empty($insert_uploads)){
                $this->common_model->insert_data_batch(['table_name'=>'transportation_images','insert_data'=>$insert_uploads]);
            }
        }
        echo json_encode(['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Transportation created successully!</div>']);
    }
    
    public function add_guide(){
        $this->form_validation->set_rules('guide_name', 'Guide Name', 'trim|required');
        $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required|integer');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $photo = '';
        if($_FILES['photo']['name'] != ""){
            $this->load->library('upload');
            $config = array(
                'upload_path' 	=> "assets/guide/",
                'allowed_types' => "jpg|jpeg|png|JPG|PNG|JPEG",
                'detect_mime' => true, 
                'overwrite' => true,
                'max_size' => '2048',
                'file_name' => time().'_'.str_replace(' ','_',$_FILES['photo']['name'])
            );			
            $this->upload->initialize($config);
            if($this->upload->do_upload('photo')){
                $data_img = $this->upload->data();				
                $photo = $data_img['file_name'];
            }else{
                $response = ['response'=>'e','details'=>'','msg'=>$this->upload->display_errors()];
                exit;
            }
        }else{
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">Guide Photo is required!</div>']);
            exit;
        }
        
        $where = ' LOWER(name)= "'. strtolower(trim($this->input->post('guide_name'))).'" AND location = "'.trim($this->input->post('location')).'" AND status!="deleted"';
        $res_hotels = $this->common_model->get_data('guides','', '', '*',$where, '', $count = true);
        //echo $res_company;exit;
        if($res_hotels > 0){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-warning">Vehicle with type ('.$this->input->post('guide_name').') and location exists!</div>']);
            exit;
        }        
        
        $data = array(
        		'name' =>   $this->input->post('guide_name'),
        		'last_name' =>   $this->input->post('guide_last_name'),
        		'gender' =>   $this->input->post('gender'),
        		'isd_codes' =>   $this->input->post('isd_codes'),
        		'contact_number' =>  $this->input->post('contact_number'),
        		'location' =>  $this->input->post('location'),
        		'created'		=>date('Y-m-d H:i:s'),
        		'photo' => $photo,
                'remarks'	=>$this->security->xss_clean($this->input->post('remarks')),
            );
            $this->db->insert('guides',$data);
            $id = $this->db->insert_id();
            echo json_encode(['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Guide added successully!</div>']);
    }
    
    public function hotel_name_suggesstion(){
        $char = substr($this->input->post('location'),1,1);
        $locations = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("name like '%".trim($this->input->post('search'))."%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('hotels')->result();
        foreach($records as $row ){
            $response[] = array("h_id"=>$row->id,"label"=>trim($row->name));
        }
        echo json_encode($response);	
    }
    
    public function transportation_name_suggesstion(){
        $char = substr($this->input->post('location'),1,1);
        $locations = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("vehicle_name like '%".trim($this->input->post('search'))."%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('transportation')->result();
        foreach($records as $row ){
            $response[] = array("t_id"=>$row->id,"label"=>trim($row->vehicle_name));
        }
        echo json_encode($response);	
    }
    
    public function guide_name_suggesstion(){
        $char = substr($this->input->post('location'),1,1);
        $locations = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("name like '%".trim($this->input->post('search'))."%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('guides')->result();
        foreach($records as $row ){
            $response[] = array("g_id"=>$row->id,"label"=>trim($row->name));
        }
        echo json_encode($response);	
    }
    
    public function airline_name_suggesstion(){
        $response = array();
        $this->db->select('*');
        $this->db->where("name like '%".trim($this->input->post('search'))."%' ");
        $this->db->where('status', 'active');
        $this->db->limit(10);
        $records = $this->db->get('airlines')->result();
        foreach($records as $row ){
            $response[] = array("a_id"=>$row->id,"label"=>trim($row->name));
        }
        echo json_encode($response);	
    }
    
    public function company_name_unique(){
        $where = ' LOWER(name)= "'. strtolower(trim($this->input->post('company'))).'" AND is_deleted ="0"';
        $count = $this->common_model->get_data('company','', '', '*',$where, '', $count = true);
        if($count){
            return false;
        }else { return true; }
    }
    
    public function get_staff(){
        $location = $this->input->post('location');
        $where = 'admin.status=1 AND admin.location="'.$location.'" '; 
        $orderby = ' ORDER BY admin.name';
        $select = '*';
        $data = $this->common_model->get_data('admin','', '', $select,$where, $orderby, $count = false);
        echo json_encode(['response'=>'s','details'=>$data,'msg'=>'']);
    }
    
    public function arrival_personal_details(){
        $this->form_validation->set_rules('first_name[]', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name[]', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('person_category[]', 'Category', 'trim|required');
        $this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
            echo json_encode($response);
            exit;
        }
        if($this->input->post('first_name')[0]<>''){
            $cnt = count($this->input->post('first_name'));
            $insert_array = [];
            $number_persons = $this->input->post('number_adult');
            $number_child = $this->input->post('number_child');
            for($i=0;$i<$cnt;$i++){
                $insert_array[$i] = ['first_name'=>$this->input->post('first_name')[$i],'last_name'=>$this->input->post('last_name')[$i],'gender'=>$this->input->post('gender')[$i],
                        'category'=>$this->input->post('person_category')[$i],'age'=>$this->input->post('age')[$i],'enquiry_id'=>$this->input->post('id'),'created'=>date('Y-m-d H:i:s')]; 
                        
                ($this->input->post('person_category')[$i] == 'adult')?$number_persons++:$number_child++;
            }
            $this->common_model->insert_data_batch(['table_name'=>'arrival_persons_details','insert_data'=>$insert_array]);
            $update_arr = array(
        		'number_persons' =>   $number_persons,
        		'number_child' =>$number_child
            );
            $id = $this->input->post('id');
            $update_data = ['table_name'=>'enquiry','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }
    
    public function edit_arrival_personal_details(){
        if(!isset($this->input->post('edit_first_name')[0]) || $this->input->post('edit_first_name')[0]==''){
            $this->form_validation->set_rules('first_name[]', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name[]', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('person_category[]', 'Category', 'trim|required');
            $this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
            if($this->form_validation->run() === FALSE){ 
                $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
                echo json_encode($response);
                exit;
            }
        }
        $number_persons = $number_child = 0;
        if($this->input->post('edit_first_name')[0]<>''){
            $cnt = count($this->input->post('edit_first_name'));
            $update_array = [];
            for($i=0;$i<$cnt;$i++){
                $update_array = ['first_name'=>$this->input->post('edit_first_name')[$i],'last_name'=>$this->input->post('edit_last_name')[$i],'gender'=>$this->input->post('edit_gender')[$i],
                        'category'=>$this->input->post('edit_person_category')[$i],'age'=>$this->input->post('edit_age')[$i],]; 
                        
                ($this->input->post('edit_person_category')[$i] == 'adult')?$number_persons++:$number_child++;
                $id = $this->input->post('edit_persondetails')[$i];
                $update_data = ['table_name'=>'arrival_persons_details','update_data'=>$update_array,'condition'=>['id'=>$id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }
        }
        
        if($this->input->post('first_name')[0]<>''){
            $cnt = count($this->input->post('first_name'));
            $insert_array = [];
            
            for($i=0;$i<$cnt;$i++){
                $insert_array[$i] = ['first_name'=>$this->input->post('first_name')[$i],'last_name'=>$this->input->post('last_name')[$i],'gender'=>$this->input->post('gender')[$i],
                        'category'=>$this->input->post('person_category')[$i],'age'=>$this->input->post('age')[$i],'enquiry_id'=>$this->input->post('id'),'created'=>date('Y-m-d H:i:s')]; 
                        
                ($this->input->post('person_category')[$i] == 'adult')?$number_persons++:$number_child++;
            }
            $this->common_model->insert_data_batch(['table_name'=>'arrival_persons_details','insert_data'=>$insert_array]);
        }
        $update_arr = array('number_persons' =>   $number_persons,'number_child' =>$number_child);
        $id = $this->input->post('id');
        $update_data = ['table_name'=>'enquiry','update_data'=>$update_arr,'condition'=>['id'=>$id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Details Added Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function arrival_room_details(){
        //$this->form_validation->set_rules('hotel_names[]', 'Hotel', 'trim|required');
        $this->form_validation->set_rules('hotel_details_ids[]', 'Hotel id', 'trim|required|integer');
        //$this->form_validation->set_rules('physical_arrival_date[]', 'Arrival Date', 'trim|required');
        $this->form_validation->set_rules('rooms_check_in[]', 'Check-in Date', 'trim|required');
        $this->form_validation->set_rules('rooms_check_out[]', 'Check-out Date', 'trim|required');
        $this->form_validation->set_rules('room_category[]', 'Category', 'trim|required');
        $this->form_validation->set_rules('number_adults[]', 'Number Adults', 'trim|required');
        $this->form_validation->set_rules('number_child[]', 'Number Child', 'trim|required');
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
            echo json_encode($response);
            exit;
        }
        //$confirmation_number = $this->input->post('confirmation_number');
        if($this->input->post('rooms_check_in')[0]<>''){
            $cnt = count($this->input->post('rooms_check_in'));
            
            $insert_array = $insert_array_persons = []; $start = 0;
            for($i=0;$i<$cnt;$i++){
                $insert_array = ['hotel_id'=>$this->input->post('hotel_details_ids')[$i],/*'physical_arrival_date'=>$this->input->post('physical_arrival_date')[$i],*/'checkin_date'=>$this->input->post('rooms_check_in')[$i],'checkout_date'=>$this->input->post('rooms_check_out')[$i],
                        'category'=>$this->input->post('room_category')[$i],'number_adults'=>$this->input->post('number_adults')[$i],'number_child'=>$this->input->post('number_child')[$i],
                        'child_bed'=>$this->input->post('child_bed')[$i],'enquiry_id'=>$this->input->post('id'),'created'=>date('Y-m-d H:i:s'),
                        'hotel_confirmation_num'=>$this->input->post('confirmation_number')[$i]];
                $id = $this->common_model->insert_data(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);
                $total_persons = $this->input->post('number_adults')[$i] + $this->input->post('number_child')[$i];
                $k='';
                for($j=$start;$j<$total_persons+$start;$j++){
                    $insert_array_persons[$j] = ['first_name'=>$this->input->post('first_name')[$j],'last_name'=>$this->input->post('last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
                        'category'=>$this->input->post('person_category')[$j],'age'=>$this->input->post('age')[$j],'enquiry_id'=>$this->input->post('id'),
                        'passport_number'=>$this->input->post('passport_number')[$j],'nationality'=>$this->input->post('nationality')[$j],'smoking_status'=>$this->input->post('smoking')[$j],
                        'meals'=>$this->input->post('meals')[$j],'remarks'=>$this->input->post('remarks')[$j],'arrival_room_details_id'=>$id, 'created'=>date('Y-m-d H:i:s')];
                    $k=$j;    
                }
                $start = $k+1;
                $this->common_model->insert_data_batch(['table_name'=>'arrival_persons_details','insert_data'=>$insert_array_persons]);
                $insert_array_persons = [];
                
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);
            
            $date_checkin = new DateTime($this->input->post('rooms_check_in')[0]);
            $date_checkout = new DateTime($this->input->post('rooms_check_out')[$cnt-1]);
            $interval = $date_checkin->diff($date_checkout);
            
            $update_arr = array('check_in_date'=>$this->input->post('rooms_check_in')[0],'check_out_date'=>$this->input->post('rooms_check_out')[$cnt-1],'number_of_nights'=>$interval->days);
            $id = $this->input->post('id');
            $update_data = ['table_name'=>'enquiry','update_data'=>$update_arr,'condition'=>['id'=>$id]];
            $affected_rows = $this->common_model->update_data_limit($update_data);
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }
    
    public function edit_arrival_room_details(){
        if(!isset($this->input->post('edit_rooms_check_in')[0]) || $this->input->post('edit_rooms_check_in')[0]==''){
            //$this->form_validation->set_rules('hotel_names[]', 'Hotel', 'trim|required');
            //$this->form_validation->set_rules('hotel_ids[]', 'Hotel id', 'trim|required|integer');
            //$this->form_validation->set_rules('physical_arrival_date[]', 'Arrival Date', 'trim|required');
            $this->form_validation->set_rules('rooms_check_in[]', 'Check-in Date', 'trim|required');
            $this->form_validation->set_rules('rooms_check_out[]', 'Check-out Date', 'trim|required');
            $this->form_validation->set_rules('room_category[]', 'Category', 'trim|required');
            $this->form_validation->set_rules('number_adults[]', 'Number Adults', 'trim|required');
            $this->form_validation->set_rules('number_child[]', 'Number Child', 'trim|required');
            if($this->form_validation->run() === FALSE){ 
                $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
                echo json_encode($response);
                exit;
            }
        }
        //$confirmation_number = $this->input->post('confirmation_number');
        if(array_key_exists('edit_rooms_check_in',$this->input->post()) && $this->input->post('edit_rooms_check_in')[0]<>''){
            $cnt = count($this->input->post('edit_rooms_check_in'));
            $update_array = $update_array_persons = [];$start = 0;
            
            for($i=0;$i<$cnt;$i++){
                $update_array = [/*'hotel_id'=>$this->input->post('edit_hotel_ids')[$i],'physical_arrival_date'=>$this->input->post('edit_physical_arrival_date')[$i],*/'checkin_date'=>$this->input->post('edit_rooms_check_in')[$i],'checkout_date'=>$this->input->post('edit_rooms_check_out')[$i],
                        'category'=>$this->input->post('edit_room_category')[$i],'number_adults'=>$this->input->post('edit_number_adults')[$i],'number_child'=>$this->input->post('edit_number_child')[$i],
                        'child_bed'=>$this->input->post('edit_child_bed')[$i],'hotel_confirmation_num'=>$this->input->post('edit_confirmation_number')[$i]];
                $id = $this->input->post('edit_roomdetails')[$i];
                $update_data = ['table_name'=>'arrival_room_details','update_data'=>$update_array,'condition'=>['id'=>$id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
                
                $total_persons = $this->input->post('edit_number_adults')[$i] + $this->input->post('edit_number_child')[$i];
                $k='';
                for($j=$start;$j<$total_persons+$start;$j++){
                    $update_array_persons = ['first_name'=>$this->input->post('edit_first_name')[$j],'last_name'=>$this->input->post('edit_last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
                        'category'=>$this->input->post('edit_person_category')[$j],'age'=>$this->input->post('edit_age')[$j],'enquiry_id'=>$this->input->post('id'),
                        'passport_number'=>$this->input->post('edit_passport_number')[$j],'nationality'=>$this->input->post('edit_nationality')[$j],'smoking_status'=>$this->input->post('edit_smoking')[$j],
                        'meals'=>$this->input->post('edit_meals')[$j],'remarks'=>$this->input->post('edit_remarks')[$j],'arrival_room_details_id'=>$id, 'created'=>date('Y-m-d H:i:s')];
                    $update_data_persons = ['table_name'=>'arrival_persons_details','update_data'=>$update_array_persons,'condition'=>['id'=>$this->input->post('edit_person_details')[$j]]];   
                    $this->common_model->update_data_limit($update_data_persons);
                    $k=$j;    
                }
                $start = $k+1;
                $update_array_persons = [];
            }
        }
        
        if($this->input->post('rooms_check_in')[0]<>''){
            $cnt = count($this->input->post('rooms_check_in'));
            $insert_array =  $insert_array_persons = []; $start = 0;
            for($i=0;$i<$cnt;$i++){
                $insert_array = ['hotel_id'=>$this->input->post('hotel_details_ids')[$i],/*'physical_arrival_date'=>$this->input->post('physical_arrival_date')[$i],*/'checkin_date'=>$this->input->post('rooms_check_in')[$i],'checkout_date'=>$this->input->post('rooms_check_out')[$i],
                        'category'=>$this->input->post('room_category')[$i],'number_adults'=>$this->input->post('number_adults')[$i],'number_child'=>$this->input->post('number_child')[$i],
                        'child_bed'=>$this->input->post('child_bed')[$i],'enquiry_id'=>$this->input->post('id'),'created'=>date('Y-m-d H:i:s'),
                        'hotel_confirmation_num'=>$this->input->post('confirmation_number')[$i]];
                        
                $id = $this->common_model->insert_data(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);
                $total_persons = $this->input->post('number_adults')[$i] + $this->input->post('number_child')[$i];
                $k='';
                for($j=$start;$j<$total_persons+$start;$j++){
                    $insert_array_persons[$j] = ['first_name'=>$this->input->post('first_name')[$j],'last_name'=>$this->input->post('last_name')[$j],/*'gender'=>$this->input->post('gender')[$j],*/
                        'category'=>$this->input->post('person_category')[$j],'age'=>$this->input->post('age')[$j],'enquiry_id'=>$this->input->post('id'),
                        'passport_number'=>$this->input->post('passport_number')[$j],'nationality'=>$this->input->post('nationality')[$j],'smoking_status'=>$this->input->post('smoking')[$j],
                        'meals'=>$this->input->post('meals')[$j],'remarks'=>$this->input->post('remarks')[$j],'arrival_room_details_id'=>$id, 'created'=>date('Y-m-d H:i:s')];
                    $k=$j;    
                }
                $start = $k+1;
                $this->common_model->insert_data_batch(['table_name'=>'arrival_persons_details','insert_data'=>$insert_array_persons]);
                $insert_array_persons = [];
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_room_details','insert_data'=>$insert_array]);
            
        }
        $edit_cnt = array_key_exists('edit_rooms_check_in',$this->input->post())?count($this->input->post('edit_rooms_check_in')):0;
        $cnt_rooms = count($this->input->post('rooms_check_in'));
        
        $checkin = (array_key_exists('edit_rooms_check_in',$this->input->post()) && $this->input->post('edit_rooms_check_in')[0]<>'')?$this->input->post('edit_rooms_check_in')[0]:$this->input->post('rooms_check_in')[0];
        $checkout = ($this->input->post('rooms_check_in')[0]<>'')?$this->input->post('rooms_check_out')[$cnt_rooms-1]:$this->input->post('edit_rooms_check_out')[$edit_cnt-1];
        $date_checkin = new DateTime($checkin);
        $date_checkout = new DateTime($checkout);
        $interval = $date_checkin->diff($date_checkout);
        
        $update_arr = array('check_in_date'=>$checkin,'check_out_date'=>$checkout,'number_of_nights'=>$interval->days);
        $id = $this->input->post('id');
        $update_data = ['table_name'=>'enquiry','update_data'=>$update_arr,'condition'=>['id'=>$id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);
        
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Details Added Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function arrival_flight_details(){
        $this->form_validation->set_rules('airline_name[]', 'Airline', 'trim|required');
        $this->form_validation->set_rules('airline_ids[]', 'Airline id', 'trim|required|integer');
        $this->form_validation->set_rules('flight_number[]', 'Flight Number', 'trim|required');
        //$this->form_validation->set_rules('flight_type[]', 'Flight Type', 'trim|required');
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
            echo json_encode($response);
            exit;
        }
        if($this->input->post('flight_number')[0]<>''){
            $cnt = count($this->input->post('flight_number'));
            $insert_array = [];
            for($i=0;$i<$cnt;$i++){
                $insert_array[$i] = ['airline_id'=>$this->input->post('airline_ids')[$i],'flight_number'=>$this->input->post('flight_number')[$i],/*'flight_type'=>$this->input->post('flight_type')[$i],*/
                                    'departure_airport'=>$this->input->post('departure_airport')[$i],
                                    'departure_city'=>$this->input->post('departure_city')[$i],'departure_date'=>$this->input->post('departure_date')[$i],'departure_time'=>$this->input->post('departure_time')[$i],
                                    'arrival_city'=>$this->input->post('arrival_city')[$i],'arrival_date'=>$this->input->post('arrival_date')[$i],'arrival_time'=>$this->input->post('arrival_time')[$i],
                                    'number_persons'=>$this->input->post('number_persons')[$i],'enquiry_id'=>$this->input->post('id'),'flight_mode'=>$this->input->post('flight_mode')[$i],'created'=>date('Y-m-d H:i:s')];
            }
            $this->common_model->insert_data_batch(['table_name'=>'arrival_flight_details','insert_data'=>$insert_array]);
            
            //$date_checkin = new DateTime($this->input->post('rooms_check_in')[0]);
            //$date_checkout = new DateTime($this->input->post('rooms_check_out')[$cnt-1]);
            //$interval = $date_checkin->diff($date_checkout);
            $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }
    
    public function edit_arrival_flight_details(){
        if(!isset($this->input->post('edit_flight_number')[0]) || $this->input->post('edit_flight_number')[0]==''){
            $this->form_validation->set_rules('airline_name[]', 'Airline', 'trim|required');
            $this->form_validation->set_rules('airline_ids[]', 'Airline id', 'trim|required|integer');
            $this->form_validation->set_rules('flight_number[]', 'Flight Number', 'trim|required');
            //$this->form_validation->set_rules('flight_type[]', 'Flight Type', 'trim|required');
            if($this->form_validation->run() === FALSE){ 
                $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
                echo json_encode($response);
                exit;
            }
        }
        
        if(isset($this->input->post('edit_flight_number')[0]) && $this->input->post('edit_flight_number')[0]<>''){
            $cnt = count($this->input->post('edit_flight_number'));
            $update_array = [];
            for($i=0;$i<$cnt;$i++){
                $update_array = ['airline_id'=>$this->input->post('edit_airline_ids')[$i],'flight_number'=>$this->input->post('edit_flight_number')[$i],/*'flight_type'=>$this->input->post('edit_flight_type')[$i],*/
                                'departure_airport'=>$this->input->post('edit_departure_airport')[$i],
                                'departure_city'=>$this->input->post('edit_departure_city')[$i],'departure_date'=>$this->input->post('edit_departure_date')[$i],'departure_time'=>$this->input->post('edit_departure_time')[$i],
                                'arrival_city'=>$this->input->post('edit_arrival_city')[$i],'arrival_date'=>$this->input->post('edit_arrival_date')[$i],'arrival_time'=>$this->input->post('edit_arrival_time')[$i],
                                'number_persons'=>$this->input->post('edit_number_persons')[$i],'flight_mode'=>$this->input->post('edit_flight_mode')[$i]];
                $id = $this->input->post('edit_flightdetails')[$i];
                $update_data = ['table_name'=>'arrival_flight_details','update_data'=>$update_array,'condition'=>['id'=>$id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
            }
        }
        
        if($this->input->post('airline_name')[0]<>''){
            $cnt = count($this->input->post('flight_number'));
            $insert_array = [];
            for($i=0;$i<$cnt;$i++){
                $insert_array[$i] = ['airline_id'=>$this->input->post('airline_ids')[$i],'flight_number'=>$this->input->post('flight_number')[$i]/*,'flight_type'=>$this->input->post('flight_type')[$i]*/,
                                    'departure_airport'=>$this->input->post('departure_airport')[$i],
                                    'departure_city'=>$this->input->post('departure_city')[$i],'departure_date'=>$this->input->post('departure_date')[$i],'departure_time'=>$this->input->post('departure_time')[$i],
                                    'arrival_city'=>$this->input->post('arrival_city')[$i],'arrival_date'=>$this->input->post('arrival_date')[$i],'arrival_time'=>$this->input->post('arrival_time')[$i],
                                    'number_persons'=>$this->input->post('number_persons')[$i],'enquiry_id'=>$this->input->post('id'),'flight_mode'=>$this->input->post('flight_mode')[$i],'created'=>date('Y-m-d H:i:s')];
            }
            $this->common_model->insert_data_batch(['table_name'=>'arrival_flight_details','insert_data'=>$insert_array]);
            //$date_checkin = new DateTime($this->input->post('rooms_check_in')[0]);
            //$date_checkout = new DateTime($this->input->post('rooms_check_out')[$cnt-1]);
            //$interval = $date_checkin->diff($date_checkout);
        }
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Details Updated Successfully</div>'];
        echo json_encode($response);
        exit;
    }
    
    public function edit_remove_details(){
        //echo '<pre>';print_r($this->input->post());exit;
        $this->form_validation->set_rules('module_id','ID','required|integer');
        $this->form_validation->set_rules('enq_id','Enquiry ID','required|integer');
        $this->form_validation->set_rules('module','Module','required');
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>validation_errors()];
            echo json_encode($response);exit;
        }
        $tbl_arr = ['person_details'=>['col_name'=>'enquiry_id','tbl'=>'arrival_persons_details'], 'room_details'=>['col_name'=>'enquiry_id','tbl'=>'arrival_room_details'],
                    'flight_details'=>['col_name'=>'enquiry_id','tbl'=>'arrival_flight_details'],'arrival_hotels'=>['col_name'=>'enquiry_id','tbl'=>'arrival_hotel_details']];
        $this->db->limit(1);
        $this->db->where(['id'=>$this->input->post('module_id'),$tbl_arr[$this->input->post('module')]['col_name']=>$this->input->post('enq_id')]);
        $this->db->delete($tbl_arr[$this->input->post('module')]['tbl']);
        
        if($this->input->post('module') == 'room_details'){
            $this->db->where(['arrival_room_details_id'=>$this->input->post('module_id'),$tbl_arr[$this->input->post('module')]['col_name']=>$this->input->post('enq_id')]);
            $this->db->delete('arrival_persons_details');
        }
        
        $response = ['response'=>'s','details'=>'','msg'=>'Deleted Successfully!'];
        echo json_encode($response);exit;
    }
    
    public function print_arrivals(){
        if($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))){
            redirect('arrivals');
        }
        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id='.$id;
        $select = 'arrivals.*,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,hotels.name AS hotel_name,hotels.address_1,hotels.address_2,';
        $select .= 'enquiry.check_in_date,enquiry.check_out_date,company.name AS filename,';
        $select .= 'transportation.vehicle_type,transportation.capacity,transportation.remarks,transportation.vehicle_name,';
        $select .= 'guides.name AS guide,guides.gender,guides.isd_codes,guides.contact_number,guides.location,guides.remarks AS guide_remarks,guides.photo';
        $join = [['type'=>'LEFT','join_table'=>'enquiry','condition'=>'enquiry.id = arrivals.enquiry_id'],
                ['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrivals.hotel_id'],
                ['type'=>'LEFT','join_table'=>'transportation','condition'=>'transportation.id = arrivals.transportation_id'],
                ['type'=>'LEFT','join_table'=>'guides','condition'=>'guides.id = arrivals.guide_id'],['type'=>'LEFT','join_table'=>'company','condition'=>'enquiry.company_id = company.company_id'],];
        $arrivals = $this->common_model->get_data('arrivals','', '', $select,$where, '', $count = false,$join);
        $data['arrivals'] = $arrivals[0];
        $where = 'arrival_persons_details.enquiry_id= '.$arrivals[0]->enquiry_id;
        $data['arrival_persons'] = $this->common_model->get_data('arrival_persons_details','', '', '*',$where,'', $count = false);
        
        $select = 'GROUP_CONCAT(arrival_persons_details.first_name," ",arrival_persons_details.last_name,IF(arrival_persons_details.category!="adult", CONCAT("(",arrival_persons_details.age,")") ,"") SEPARATOR ", ") AS persons_details,';
        $select .= 'arrival_room_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile';
        $where = 'arrival_room_details.enquiry_id= '.$arrivals[0]->enquiry_id;
        $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_room_details.hotel_id'],
                ['type'=>'LEFT','join_table'=>'arrival_persons_details','condition'=>'arrival_persons_details.arrival_room_details_id  = arrival_room_details.id'],];
        $data['arrival_room'] = $this->common_model->get_data('arrival_room_details','', '', $select,$where,' GROUP BY arrival_persons_details.arrival_room_details_id', $count = false,$join);
        //echo '<pre>';print_r($data['arrival_room']);exit;
        $select = 'transportation_images.image';
        $where = 'transportation_images.transportation_id= '.$arrivals[0]->transportation_id;
        $data['transportation_images'] = $this->common_model->get_data('transportation_images','', '', $select,$where,'', $count = false);
        
        $where = 'arrival_flight_details.enquiry_id = '.$arrivals[0]->enquiry_id;
        $join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
        $select = 'arrival_flight_details.*,airlines.name';
        $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details','', '', $select,$where,'', $count = false,$join);
        
        $where = 'itinerary.arrival_id= '.$id .' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary','', '', '*',$where,' ORDER BY itinerary.date,itinerary.time ASC', $count = false);
        
        $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1';
        $where = 'arrival_hotel_details.enquiry_id = '.$arrivals[0]->enquiry_id;
        $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_hotel_details.hotel_id'],];
        $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,'', $count = false,$join);
        
        $char = substr($arrivals[0]->enquiry_abbr,1,1);
        $locations = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        $where = 'LOWER(company_addresses.country) = "'.$locations[$char].'"';
        $select = 'company_addresses.name,company_addresses.address,company_addresses.person_name,company_addresses.contact_number,company_addresses.country';
        $company = $this->common_model->get_data('company_addresses','', '', $select,$where, '', $count = false);
        $data['company'] = $company[0];
        //echo '<pre>';print_r($data);exit;
        $this->load->view('admin/print_arrival_view',$data);
    }
    
    // 16 Feb 2024
    
      public function print_service_voucher(){
        if($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))){
            redirect('arrivals');
        }
        $id = base64_decode($this->input->get('id'));
        $where = 'arrivals.id='.$id;
        $select = 'arrivals.*,enquiry.enquiry_no,enquiry.enquiry_abbr,enquiry.check_in_date,enquiry.check_out_date,enquiry.number_of_nights,hotels.name AS hotel_name,hotels.address_1,hotels.address_2,';
        $select .= 'enquiry.check_in_date,enquiry.check_out_date,company.name AS filename,';
        $select .= 'transportation.vehicle_type,transportation.capacity,transportation.remarks,transportation.vehicle_name,';
        $select .= 'guides.name AS guide,guides.gender,guides.isd_codes,guides.contact_number,guides.location,guides.remarks AS guide_remarks,guides.photo';
        $join = [['type'=>'LEFT','join_table'=>'enquiry','condition'=>'enquiry.id = arrivals.enquiry_id'],
                ['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrivals.hotel_id'],
                ['type'=>'LEFT','join_table'=>'transportation','condition'=>'transportation.id = arrivals.transportation_id'],
                ['type'=>'LEFT','join_table'=>'guides','condition'=>'guides.id = arrivals.guide_id'],['type'=>'LEFT','join_table'=>'company','condition'=>'enquiry.company_id = company.company_id'],];
        $arrivals = $this->common_model->get_data('arrivals','', '', $select,$where, '', $count = false,$join);
        $data['arrivals'] = $arrivals[0];
        $where = 'arrival_persons_details.enquiry_id= '.$arrivals[0]->enquiry_id;
        $data['arrival_persons'] = $this->common_model->get_data('arrival_persons_details','', '', '*',$where,'', $count = false);
        
        $select = 'GROUP_CONCAT(arrival_persons_details.first_name," ",arrival_persons_details.last_name,IF(arrival_persons_details.category!="adult", CONCAT("(",arrival_persons_details.age,")") ,"") SEPARATOR ", ") AS persons_details,';
        $select .= 'arrival_room_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile';
        $where = 'arrival_room_details.enquiry_id= '.$arrivals[0]->enquiry_id;
        $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_room_details.hotel_id'],
                ['type'=>'LEFT','join_table'=>'arrival_persons_details','condition'=>'arrival_persons_details.arrival_room_details_id  = arrival_room_details.id'],];
        $data['arrival_room'] = $this->common_model->get_data('arrival_room_details','', '', $select,$where,' GROUP BY arrival_persons_details.arrival_room_details_id', $count = false,$join);
        //echo '<pre>';print_r($data['arrival_room']);exit;
        $select = 'transportation_images.image';
        $where = 'transportation_images.transportation_id= '.$arrivals[0]->transportation_id;
        $data['transportation_images'] = $this->common_model->get_data('transportation_images','', '', $select,$where,'', $count = false);
        
        $where = 'arrival_flight_details.enquiry_id = '.$arrivals[0]->enquiry_id;
        $join = [['type'=>'LEFT','join_table'=>'airlines','condition'=>'airlines.id = arrival_flight_details.airline_id'],];
        $select = 'arrival_flight_details.*,airlines.name';
        $data['arrival_flight'] = $this->common_model->get_data('arrival_flight_details','', '', $select,$where,'', $count = false,$join);
        
        $where = 'itinerary.arrival_id= '.$id .' AND itinerary.status != "deleted"';
        $data['itinerary'] = $this->common_model->get_data('itinerary','', '', '*',$where,' ORDER BY itinerary.date,itinerary.time ASC', $count = false);
        
        $select = 'arrival_hotel_details.*,hotels.name AS hotel,hotels.contact_person_name,hotels.email,hotels.mobile,hotels.address_1';
        $where = 'arrival_hotel_details.enquiry_id = '.$arrivals[0]->enquiry_id;
        $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_hotel_details.hotel_id'],];
        $data['arrival_hotel_details'] = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,'', $count = false,$join);
        
        $char = substr($arrivals[0]->enquiry_abbr,1,1);
        $locations = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
        $where = 'LOWER(company_addresses.country) = "'.$locations[$char].'"';
        $select = 'company_addresses.name,company_addresses.address,company_addresses.person_name,company_addresses.contact_number,company_addresses.country';
        $company = $this->common_model->get_data('company_addresses','', '', $select,$where, '', $count = false);
        $data['company'] = $company[0];
        //echo '<pre>';print_r($data);exit;
        $this->load->view('admin/print_service_voucher',$data);
    }
    
    
    
    public function add_airline(){
        $this->form_validation->set_rules('airline_name', 'Airline Name', 'trim|required');
        $this->form_validation->set_rules('airline_code', 'Airline Code', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger" style="padding: 0 5px;">'.validation_errors().'</div>']);
            exit;
        }
        
        $where = ' LOWER(name)= "'. strtolower(trim($this->input->post('airline_name'))).'" AND LOWER(code) = "'.strtolower(trim($this->input->post('airline_code'))).'" AND status!="deleted"';
        $res_airlines = $this->common_model->get_data('airlines','', '', '*',$where, '', $count = true);
        //echo $res_company;exit;
        if($res_airlines > 0){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-warning">Airline with name ('.$this->input->post('airline_name').') and code exists!</div>']);
            exit;
        }        
        
        $data = array(
        		'name' =>   $this->input->post('airline_name'),
        		'code' =>   $this->input->post('airline_code'),
        		'created'		=>date('Y-m-d H:i:s'),
            );
        $this->db->insert('airlines',$data);
        $id = $this->db->insert_id();
        echo json_encode(['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success" style="padding: 0 5px;">Airline added successully!</div>']);
    }
    
    public function add_hotel_details(){
        $this->form_validation->set_rules('check_in[]', 'Check In', 'trim|required');
        $this->form_validation->set_rules('check_out[]', 'Check Out', 'trim|required');
        $this->form_validation->set_rules('hotel_ids[]', 'Hotel', 'trim|required');
        
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">'.validation_errors().'</div>'];
            echo json_encode($response);
            exit;
        }
        if($this->input->post('check_in')[0]<>''){
            $cnt = count($this->input->post('check_in'));
            $insert_array = $return_arr = [];
            for($i=0;$i<$cnt;$i++){
                $insert_array = ['checkin_date'=>$this->input->post('check_in')[$i],'checkout_date'=>$this->input->post('check_out')[$i],
                                    'hotel_name'=>$this->input->post('hotel')[$i],'hotel_id'=>$this->input->post('hotel_ids')[$i],
                                    'enquiry_id'=>$this->input->post('id'),'created'=>date('Y-m-d H:i:s')];
                $id = $this->common_model->insert_data(['table_name'=>'arrival_hotel_details','insert_data'=>$insert_array]);
                $return_arr[$i] = ['id'=>$id] + $insert_array; 
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_hotel_details','insert_data'=>$insert_array]);
            
            $response = ['response'=>'s','details'=>$return_arr,'msg'=>'<div class="alert alert-success">Details Added Successfully</div>'];
            echo json_encode($response);
            exit;
        }
    }
    
    public function update_hotel_details(){
        $msg_update = $msg_insert = '';
        if(isset($this->input->post('edit_checkin')[0]) && $this->input->post('edit_checkout')[0]<>''){
            $cnt = count($this->input->post('edit_checkin'));
            $update_array = [];
            for($i=0;$i<$cnt;$i++){
                $update_array = ['checkin_date'=>$this->input->post('edit_checkin')[$i],'checkout_date'=>$this->input->post('edit_checkout')[$i],
                                'hotel_name'=>$this->input->post('edit_hotel')[$i],'hotel_id'=>$this->input->post('edit_hotel_ids')[$i],
                                'enquiry_id'=>$this->input->post('id')];
                $id = $this->input->post('edit_hotel_details_id')[$i];
                $update_data = ['table_name'=>'arrival_hotel_details','update_data'=>$update_array,'condition'=>['id'=>$id]];
                $affected_rows = $this->common_model->update_data_limit($update_data);
                if($affected_rows){
                    $msg_update = '<div class="alert alert-success">Hotel Details Updated Successfully!</div>';
                }
            }
        }
        /*$this->form_validation->set_rules('check_in[]', 'Check In', 'trim|required');
        $this->form_validation->set_rules('check_out[]', 'Check Out', 'trim|required');
        $this->form_validation->set_rules('hotel_ids[]', 'Hotel', 'trim|required');
        
        if($this->form_validation->run() === FALSE){ 
            $response = ['response'=>'e','details'=>'','msg'=>$msg.'<div class="alert alert-danger">'.validation_errors().'</div>'];
            echo json_encode($response);
            exit;
        }*/
        $insert_array = $return_arr = [];
        if($this->input->post('check_in')[0]<>'' && $this->input->post('check_out')[0]<>'' && $this->input->post('hotel_ids')[0]){
            $cnt = count($this->input->post('check_in'));            
            for($i=0;$i<$cnt;$i++){
                $insert_array = ['checkin_date'=>$this->input->post('check_in')[$i],'checkout_date'=>$this->input->post('check_out')[$i],
                                    'hotel_name'=>$this->input->post('hotel')[$i],'hotel_id'=>$this->input->post('hotel_ids')[$i],
                                    'enquiry_id'=>$this->input->post('id'),'created'=>date('Y-m-d H:i:s')];
                $id = $this->common_model->insert_data(['table_name'=>'arrival_hotel_details','insert_data'=>$insert_array]);
                $return_arr[$i] = ['id'=>$id] + $insert_array; 
            }
            //$this->common_model->insert_data_batch(['table_name'=>'arrival_hotel_details','insert_data'=>$insert_array]);
            $msg_insert = '<div class="alert alert-success">Details Added Successfully</div>';
        }
        $response = ['response'=>'s','details'=>$return_arr,'msg'=>$msg_update.$msg_insert];
        echo json_encode($response);
        exit;
    }
    
    public function get_hotel_details(){
        $enq_id = $this->input->post('enq_id');
        $where = 'arrival_hotel_details.enquiry_id ='.$enq_id; 
        $select = 'arrival_hotel_details.*,hotels.name AS hotel_name';
        $join = [['type'=>'LEFT','join_table'=>'hotels','condition'=>'hotels.id = arrival_hotel_details.hotel_id'],];
        $data = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where, '', $count = false,$join);
        if(empty($data)){
           $response = json_encode(['response'=>'e','details'=>'','msg'=>'']);
        }else{
           $response = json_encode(['response'=>'s','details'=>$data,'msg'=>'']);
        }
        echo $response; exit;
    }
}

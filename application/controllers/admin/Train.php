<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Train extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model(['admin/train_model','admin/flight_model','common_model']);
        $this->load->library(['pagination']);
        check_delete();
    }	

    public function add_train()
    {
        
        $this->form_validation->set_rules('train_name', 'Train Name', 'trim|required');		
        $this->form_validation->set_rules('country', 'Country Name', 'trim|required');		
        $this->form_validation->set_error_delimiters('<p class="red" style="margin: 0px !important;">', '</p>');

        if($this->form_validation->run() == FALSE){
            $data['trains'] = $this->train_model->all_trains(); 
            $data['content'] = 'admin/train'; 
            $this->load->view('admin/layout', $data);	    
            log_user_activity('Train Add',$this->session->userdata('id'), 'Train: Add');
        } else {
            //$response = $this->flight_model->add_flight();
            $insert_arr = ['train_name'=>$this->input->post('train_name'),'country'=>$this->input->post('country'),
                            ];
            $id = $this->common_model->insert_data(['table_name'=>'train','insert_data'=>$insert_arr]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Train Add New ',$this->session->userdata('id'), 'Train: Add New');
                redirect('all-train');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Train Add Error',$this->session->userdata('id'), 'Train: Add (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function train_list(){
        log_user_activity('Train View',$this->session->userdata('id'), 'Train: View');
        $data['trains'] = $this->train_model->all_trains(); 
        $data['content'] = 'admin/train_list'; 
        $this->load->view('admin/layout', $data);	    
    }

    public function train_edit()
    {
        $this->form_validation->set_rules('train_name', 'Train Name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red" style="margin: 0px !important;">', '</p>');

        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-train');
        $where = ' status!="deleted" AND id='.$id;
        $data['trains'] = $this->common_model->get_data('train','', '', '*',$where, '', $count = false)[0];
        if(empty($data['trains'])) { 
            $this->session->set_flashdata('message','<div class="alert alert-danger">No Records Found!</div>'); 
            
            redirect('all-train'); 
        } 
        $where1 = ['id' => $id]; 

            $existing = $this->common_model->get_single(['table_name' => 'train', 'condition'  => $where1 ]);

            if (!empty($existing)) {
                $previous_data = [
                    'train_name' => $existing['train_name'],
                    'country'         => $existing['country']
                ];
            } else {
                $previous_data = []; 
            }

        if($this->form_validation->run() == FALSE){
            log_user_activity('Trains Edit',$this->session->userdata('id'), 'Trains: Edit'); 
             $data['content'] = 'admin/edit_train';
            $this->load->view('admin/layout', $data);	    
        } else {
            $update_arr = ['train_name'=>$this->input->post('train_name'),'country'=>$this->input->post('country'),
                            ];
            $id = $this->common_model->update_data_limit(['table_name'=>'train','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Trains Update', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));
                redirect('all-train');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Same record! Make changes to update.</div>');
                log_user_activity('Trains Update', $this->session->userdata('id'), 'Previous Data: (Same record! Make changes to update)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function train_delete(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-train');
        $update_arr = ['status'=>'deleted'];
        $id = $this->common_model->update_data_limit(['table_name'=>'train','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($id){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Trains Delete',$this->session->userdata('id'), 'Trains: Deleted');
            redirect('all-train');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Trains Delete Error',$this->session->userdata('id'), 'Trains: Deleted(Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
    }

    public function add_train_schedule(){
        $this->form_validation->set_rules('train_id', 'Train Name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('train_number', 'Train Number', 'trim|required');
        $this->form_validation->set_rules('departing_station', 'Departing Station', 'trim|required');
        $this->form_validation->set_rules('arrival_station', 'Arrival Station ', 'trim|required');
         $this->form_validation->set_rules('type[]', 'Type', 'trim|required');
        // $this->form_validation->set_rules('ticket_price', 'Ticket Price', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red" style="margin: 0px !important;">', '</p>');

        if($this->form_validation->run() == FALSE){ 
            $data['content'] = 'admin/train_schedule'; 
            $this->load->view('admin/layout', $data);
            log_user_activity('Train Schedule Add',$this->session->userdata('id'), 'Train: Train Schedule: Add');
        } 
        else 
        {
            $train_id = $this->input->post('train_id');
            $train_number = $this->input->post('train_number');
            $departing_station = $this->input->post('departing_station');
            $arrival_station = $this->input->post('arrival_station');

            $this->db->where('train_id', $train_id);
            $this->db->where('train_number', $train_number);
            $this->db->where('status !=', 'deleted'); 
            $this->db->where('departing_station', $departing_station); 
            $this->db->where('arrival_station', $arrival_station); 
            $existing_schedule = $this->db->get('train_schedule')->row();
                
            if ($existing_schedule) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! This train number already exists for the selected train.</div>');
                log_user_activity('Train Schedule Add New',$this->session->userdata('id'), 'Error: (This train number already exists for the selected train.)');
                redirect($_SERVER['HTTP_REFERER']);
            }
            
            $operational_days = $this->input->post('operational_days'); 
            $departure_times = $this->input->post('departure_time'); 
            $arrival_times = $this->input->post('arrival_time');
            
            $days_map = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            
            $departure_data = [];
            $arrival_data = [];
            
            foreach($days_map as $index => $day) {
                if(in_array($day, $operational_days)) {
                    $departure_data[$day] = isset($departure_times[$index]) ? $departure_times[$index] : '';
                    $arrival_data[$day] = isset($arrival_times[$index]) ? $arrival_times[$index] : '';
                } else {
                    $departure_data[$day] = '';
                    $arrival_data[$day] = '';
                }
            }
            
            $insert_array = [
                'train_id' => $this->input->post('train_id'),
                'country' => $this->input->post('country'),
                'train_number' => $this->input->post('train_number'),
                'departing_station' => $this->input->post('departing_station'),
                'arrival_station' => $this->input->post('arrival_station'),
                'type' => json_encode($this->input->post('type')),
                'ticket_price' => $this->input->post('ticket_price'),
                'economy_ticket_price' => $this->input->post('economy_ticket_price'),
                'first_class_ticket_price' => $this->input->post('first_class_ticket_price'),
                'second_class_ticket_price' => $this->input->post('second_class_ticket_price'),
                
                'business_child_ticket_price' => $this->input->post('business_child_ticket_price'),
                'economy_child_ticket_price'  => $this->input->post('economy_child_ticket_price'),
                'first_class_child_ticket_price' => $this->input->post('first_class_child_ticket_price'),
                'second_class_child_ticket_price' => $this->input->post('second_class_child_ticket_price'),

                'bussines_child_age' => $this->input->post('bussines_child_age'),
                'economy_child_age' => $this->input->post('economy_child_age'),
                'first_child_age' => $this->input->post('first_child_age'),
                'second_child_age' => $this->input->post('second_child_age'),
                'sitting_child_age' => $this->input->post('sitting_child_age'),
                'vip_child_age' => $this->input->post('vip_child_age'),
                'sleeper_child_age' => $this->input->post('sleeper_child_age'),
                'coupe_child_age' => $this->input->post('coupe_child_age'),
                'sv_child_age' => $this->input->post('sv_child_age'),

                'sitting_ticket_price' => $this->input->post('sitting_ticket_price'),
                'vip_ticket_price' => $this->input->post('vip_ticket_price'),
                'sleeper_class_ticket_price' => $this->input->post('sleeper_class_ticket_price'),
                'coupe_class_ticket_price' => $this->input->post('coupe_class_ticket_price'),
                'sv_class_ticket_price' => $this->input->post('sv_class_ticket_price'),

                'sitting_child_ticket_price' => $this->input->post('sitting_child_ticket_price'),
                'vip_child_ticket_price' => $this->input->post('vip_child_ticket_price'),
                'sleeper_class_child_ticket_price' => $this->input->post('sleeper_class_child_ticket_price'),
                'coupe_class_child_ticket_price' => $this->input->post('coupe_class_child_ticket_price'),
                'sv_class_child_ticket_price' => $this->input->post('sv_class_child_ticket_price'),
                
                'same_time_checkbox' => $this->input->post('same_time_checkbox') ?? 0,
                
                // Correct column names based on your table structure
                'mon_dep_time' => $departure_data['monday'],    
                'mon_arr_time' => $arrival_data['monday'],
                'tue_dep_time' => $departure_data['tuesday'],
                'tue_arr_time' => $arrival_data['tuesday'],
                'wed_dep_time' => $departure_data['wednesday'],
                'wed_arr_time' => $arrival_data['wednesday'],
                'thu_dep_time' => $departure_data['thursday'],
                'thu_arr_time' => $arrival_data['thursday'],
                'fri_dep_time' => $departure_data['friday'],
                'fri_arr_time' => $arrival_data['friday'],
                'sat_dep_time' => $departure_data['saturday'],
                'sat_arr_time' => $arrival_data['saturday'],
                'sun_dep_time' => $departure_data['sunday'],
                'sun_arr_time' => $arrival_data['sunday'],
                'days_of_operations' => implode(',', $operational_days),
                'created_by' => $this->session->userdata('id'),
            ];

            $id = $this->common_model->insert_data(['table_name'=>'train_schedule','insert_data'=>$insert_array]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Train Schedule Created Successfully!</div>');
                log_user_activity('Train Schedule Add New',$this->session->userdata('id'), 'Add New: '. json_encode($insert_array));
                redirect('all-train-schedule');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Train Schedule Add New',$this->session->userdata('id'), 'Error: (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function get_trains_by_country() {
        $country = $this->input->post('country');
        
        if($country) {
            $country = trim($country);
            
            // For case-insensitive search
            $this->db->select('id, train_name, country');
            $this->db->where('LOWER(country)', strtolower($country)); // Case-insensitive
            $this->db->where('status', 'active');
            $this->db->order_by('train_name', 'ASC');
            $trains = $this->db->get('train')->result_array();
            
            echo json_encode([
                'status' => 'success',
                'trains' => $trains,
                'count' => count($trains)
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Country name is required'
            ]);
        }
    }
    
    public function train_schedule_list(){

        $where = 'train_schedule.status != "deleted"';
        
        if($this->input->get('train_number') <> ''){
            $where .= ' AND train_schedule.train_number = "'.trim(urldecode($this->input->get('train_number'))).'"';
            log_user_activity('Train Schedule List Search',$this->session->userdata('id'), 'Search: '.$this->input->get('train_number'));
        }

        $join = [['type'=>'','join_table'=>'train','condition'=>'train.id = train_schedule.train_id']];

        $select = 'train_schedule.*,train.train_name';

        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'all-train-schedule/?'.$search[0];
            
        $config["total_rows"] = $this->common_model->get_data('train_schedule','', '', 'train_schedule.id',$where, '', $count = true);
        $data["total"] = $this->common_model->get_data('train_schedule','', '', 'train_schedule.id',$where, '', $count = true);
        
        $config["per_page"] = 10;
        //$config["uri_segment"] = 2;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
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
        $this->pagination->initialize($config);
        $offset = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['offset'] = $offset;
        $data['result'] = $this->common_model->get_data('train_schedule',$offset, $config["per_page"], $select,$where, ' ORDER BY train_schedule.id ASC', $count = false,$join);
   
        log_user_activity('Train Schedule List: View',$this->session->userdata('id'), 'Train: Train Schedule List: View');
        $data['links'] = $this->pagination->create_links(); 
        $data['content'] = 'admin/train_schedule_list'; 
        $this->load->view('admin/layout', $data);	
    }

    public function edit_train_schedule()
    {
        $schedule_id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-train-schedule');
        
        $this->form_validation->set_rules('train_id', 'Train Name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('train_number', 'Train Number', 'trim|required');
        $this->form_validation->set_rules('departing_station', 'Departing Station', 'trim|required');
        $this->form_validation->set_rules('arrival_station', 'Arrival Station ', 'trim|required');
        $this->form_validation->set_rules('type[]', 'Type', 'trim|required');
        // $this->form_validation->set_rules('ticket_price', 'Ticket Price', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red" style="margin: 0px !important;">', '</p>');

        $where = ' status!="deleted" AND id='.$schedule_id;
        $data['train_schedule'] = $this->common_model->get_data('train_schedule','', '', '*',$where, '', $count = false)[0];

        $existing = $this->common_model->get_single(['table_name' => 'train_schedule', 'condition'  => $where ]);

        if (!empty($existing)) {
            $previous_data = [
                'id'            => $existing['id'],
                'train_id'            => $existing['train_id'],
                'country'             => $existing['country'],
                'train_number'        => $existing['train_number'],
                'departing_station'   => $existing['departing_station'],
                'arrival_station'     => $existing['arrival_station'],
                'type'                => $existing['type'],
                'ticket_price'        => $existing['ticket_price'],
                'economy_ticket_price' => $existing['economy_ticket_price'],
                'first_class_ticket_price' => $existing['first_class_ticket_price'],
                'second_class_ticket_price' => $existing['second_class_ticket_price'],
                'luxe_ticket_price' => $existing['luxe_ticket_price'],
                'open_plan_ticket_price' => $existing['open_plan_ticket_price'],
                'couple_ticket_price' => $existing['couple_ticket_price'],
                
                'business_child_ticket_price' => $existing['business_child_ticket_price'],
                'economy_child_ticket_price'  => $existing['economy_child_ticket_price'],
                'first_class_child_ticket_price' => $existing['first_class_child_ticket_price'],
                'second_class_child_ticket_price' => $existing['second_class_child_ticket_price'],
                'luxe_child_ticket_price' => $existing['luxe_child_ticket_price'],
                'open_plan_child_ticket_price' => $existing['open_plan_child_ticket_price'],
                'couple_child_ticket_price' => $existing['couple_child_ticket_price'],

                'bussines_child_age' => $existing['bussines_child_age'],
                'economy_child_age' => $existing['economy_child_age'],
                'first_child_age' => $existing['first_child_age'],
                'second_child_age' => $existing['second_child_age'],
                'luxe_child_age' => $existing['luxe_child_age'],
                'open_plan_child_age' => $existing['open_plan_child_age'],
                'couple_child_age' => $existing['couple_child_age'],
                'sitting_child_age' => $existing['sitting_child_age'],
                'vip_child_age' => $existing['vip_child_age'],
                'sleeper_child_age' => $existing['sleeper_child_age'],
                'coupe_child_age' => $existing['coupe_child_age'],
                'sv_child_age' => $existing['sv_child_age'],

                'sitting_ticket_price' => $existing['sitting_ticket_price'],
                'vip_ticket_price' => $existing['vip_ticket_price'],
                'sleeper_class_ticket_price' => $existing['sleeper_class_ticket_price'],
                'coupe_class_ticket_price' => $existing['coupe_class_ticket_price'],
                'sv_class_ticket_price' => $existing['sv_class_ticket_price'],

                'sitting_child_ticket_price' => $existing['sitting_child_ticket_price'],
                'vip_child_ticket_price' => $existing['vip_child_ticket_price'],
                'sleeper_class_child_ticket_price' => $existing['sleeper_class_child_ticket_price'],
                'coupe_class_child_ticket_price' => $existing['coupe_class_child_ticket_price'],
                'sv_class_child_ticket_price' => $existing['sv_class_child_ticket_price'],
                
                'mon_dep_time'     => $existing['mon_dep_time'],
                'mon_arr_time'       => $existing['mon_arr_time'],
                'tue_dep_time'    => $existing['tue_dep_time'],
                'tue_arr_time'      => $existing['tue_arr_time'],
                'wed_dep_time'  => $existing['wed_dep_time'],
                'wed_arr_time'    => $existing['wed_arr_time'],
                'thu_dep_time'   => $existing['thu_dep_time'],
                'thu_arr_time'     => $existing['thu_arr_time'],
                'fri_dep_time'     => $existing['fri_dep_time'],
                'fri_arr_time'       => $existing['fri_arr_time'],
                'sat_dep_time'   => $existing['sat_dep_time'],
                'sat_arr_time'     => $existing['sat_arr_time'],
                'sun_dep_time'     => $existing['sun_dep_time'],
                'sun_arr_time'       => $existing['sun_arr_time'],
                'days_of_operations'        => $existing['days_of_operations'],
                'same_time_checkbox'        => $existing['same_time_checkbox'],
                'created_by'                => $existing['created_by'],
            ];
        } else {
            $previous_data = []; 
        }
        
        if($this->form_validation->run() == FALSE)
        {
            $data['trains'] = $this->train_model->all_trains();  
            log_user_activity('Train Schedule: Edit',$this->session->userdata('id'), 'Train: Train Schedule: Edit');
            $data['content'] = 'admin/train_schedule_edit'; 
            $this->load->view('admin/layout', $data);	    
        } 
        else 
        {
            $train_id = $this->input->post('train_id');
            $train_number = $this->input->post('train_number');
            $departing_station = $this->input->post('departing_station');
            $arrival_station = $this->input->post('arrival_station');

            $this->db->where('train_id', $train_id);
            $this->db->where('train_number', $train_number);
            $this->db->where('status !=', 'deleted');
            $this->db->where('id !=', $schedule_id); 
            $this->db->where('departing_station', $departing_station); 
            $this->db->where('arrival_station', $arrival_station);
            $query = $this->db->get('train_schedule');
            
            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! This train number already exists for the selected train.</div>');
                log_user_activity('Train Schedule Update', $this->session->userdata('id'), 'Error: (This train number already exists for the selected train.)');
                redirect($_SERVER['HTTP_REFERER']);
            }
            
            $operational_days = $this->input->post('operational_days'); 
            $departure_times = $this->input->post('departure_time'); 
            $arrival_times = $this->input->post('arrival_time');
            
            // Map days to correct indices
            $days_map = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $departure_data = [];
            $arrival_data = [];
            
            foreach($days_map as $index => $day) {
                if(in_array($day, $operational_days)) {
                    $departure_data[$day] = isset($departure_times[$index]) ? $departure_times[$index] : '';
                    $arrival_data[$day] = isset($arrival_times[$index]) ? $arrival_times[$index] : '';
                } else {
                    $departure_data[$day] = '';
                    $arrival_data[$day] = '';
                }
            }
            
            $update_array = [
                'train_id'          => $this->input->post('train_id'),
                'country'           => $this->input->post('country'),
                'train_number'      => $this->input->post('train_number'),
                'departing_station' => $this->input->post('departing_station'),
                'arrival_station'   => $this->input->post('arrival_station'),
                'type' => json_encode($this->input->post('type')),
                'ticket_price'      => $this->input->post('ticket_price'),
                'economy_ticket_price'      => $this->input->post('economy_ticket_price'),
                'first_class_ticket_price'      => $this->input->post('first_class_ticket_price'),
                'second_class_ticket_price'      => $this->input->post('second_class_ticket_price'),
                'luxe_ticket_price' =>$this->input->post('luxe_class_ticket_price'),
                'open_plan_ticket_price' => $this->input->post('open_plan_ticket_price'),
                'couple_ticket_price' => $this->input->post('couple_ticket_price'),
                
                'business_child_ticket_price' => $this->input->post('business_child_ticket_price'),
                'economy_child_ticket_price'  => $this->input->post('economy_child_ticket_price'),
                'first_class_child_ticket_price' => $this->input->post('first_class_child_ticket_price'),
                'second_class_child_ticket_price' => $this->input->post('second_class_child_ticket_price'),
                'luxe_child_ticket_price' => $this->input->post('luxe_child_ticket_price'),
                'open_plan_child_ticket_price' => $this->input->post('open_plan_child_ticket_price'),
                'couple_child_ticket_price' => $this->input->post('couple_child_ticket_price'),

                'bussines_child_age' => $this->input->post('bussines_child_age'),
                'economy_child_age' => $this->input->post('economy_child_age'),
                'first_child_age' => $this->input->post('first_child_age'),
                'second_child_age' => $this->input->post('second_child_age'),
                'luxe_child_age' => $this->input->post('luxe_child_age'),
                'open_plan_child_age' => $this->input->post('open_plan_child_age'),
                'couple_child_age' => $this->input->post('couple_child_age'),
                'sitting_child_age' => $this->input->post('sitting_child_age'),
                'vip_child_age' => $this->input->post('vip_child_age'),
                'sleeper_child_age' => $this->input->post('sleeper_child_age'),
                'coupe_child_age' => $this->input->post('coupe_child_age'),
                'sv_child_age' => $this->input->post('sv_child_age'),

                'sitting_ticket_price' => $this->input->post('sitting_ticket_price'),
                'vip_ticket_price' => $this->input->post('vip_ticket_price'),
                'sleeper_class_ticket_price' => $this->input->post('sleeper_class_ticket_price'),
                'coupe_class_ticket_price' => $this->input->post('coupe_class_ticket_price'),
                'sv_class_ticket_price' => $this->input->post('sv_class_ticket_price'),

                'sitting_child_ticket_price' => $this->input->post('sitting_child_ticket_price'),
                'vip_child_ticket_price' => $this->input->post('vip_child_ticket_price'),
                'sleeper_class_child_ticket_price' => $this->input->post('sleeper_class_child_ticket_price'),
                'coupe_class_child_ticket_price' => $this->input->post('coupe_class_child_ticket_price'),
                'sv_class_child_ticket_price' => $this->input->post('sv_class_child_ticket_price'),
                
                'same_time_checkbox' => $this->input->post('same_time_checkbox'),
                
                // Correct column names
                'mon_dep_time'     => $departure_data['monday'],
                'mon_arr_time'       => $arrival_data['monday'],
                'tue_dep_time'    => $departure_data['tuesday'],
                'tue_arr_time'      => $arrival_data['tuesday'],
                'wed_dep_time'  => $departure_data['wednesday'],
                'wed_arr_time'    => $arrival_data['wednesday'],
                'thu_dep_time'   => $departure_data['thursday'],
                'thu_arr_time'     => $arrival_data['thursday'],
                'fri_dep_time'     => $departure_data['friday'],
                'fri_arr_time'       => $arrival_data['friday'],
                'sat_dep_time'   => $departure_data['saturday'],
                'sat_arr_time'     => $arrival_data['saturday'],
                'sun_dep_time'     => $departure_data['sunday'],
                'sun_arr_time'       => $arrival_data['sunday'],
                'days_of_operations' => implode(',', $operational_days),
            ];
            
            $id = $this->common_model->update_data_limit(['table_name'  => 'train_schedule','update_data' => $update_array,'condition'   => ['id' => $schedule_id]
            ]);
            
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Train Schedule Updated Successfully!</div>');
                log_user_activity('Train Schedule Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
                redirect('all-train-schedule');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Train Schedule Update Error',$this->session->userdata('id'), 'Previous Data: Error! Please Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function delete_train_schedule()
    {
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-train-schedule');
        //echo $id;exit;
        $train_num = ($this->input->get('train_num')<>'')?base64_decode($this->input->get('train_num')):redirect('all-train-schedule');
        // echo $train_num;exit;        
        $where = ' train_schedule.train_number = "'.trim($train_num).'" AND train_schedule.status = "active" AND train_schedule.id = '.trim($id);
        $train_schedule = $this->common_model->get_data('train_schedule', '', '', '*', $where, '', $count = true);
        if($train_schedule)
        {
            $update_arr = ['status'=>'deleted'];
            $id = $this->common_model->update_data_limit(['table_name'=>'train_schedule','update_data'=>$update_arr,'condition'=>['id'=>trim($id)]]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
                log_user_activity('Train Schedule: Delete',$this->session->userdata('id'), 'Train Schedule: Deleted');
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Train Schedule: Delete Error',$this->session->userdata('id'), 'Train Schedule: Deleted (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Train Schedule: Delete Error',$this->session->userdata('id'), 'Train Schedule: Deleted (Cannot delete schedule!)');
            redirect($_SERVER['HTTP_REFERER']);      
        }
    }

   // Train_schedule controller में
    public function get_cities_autocomplete() {
        $search = $this->input->get('term');
        $country = $this->input->get('country');
        
        $this->db->select('c.name as city_name, c.id');
        $this->db->from('cities c');
        
        if ($country) {
            $this->db->join('states s', 's.id = c.state_id');
            $this->db->join('countries co', 'co.id = s.country_id');
            $this->db->where('co.name', $country);
        }
        
        if ($search) {
            $this->db->like('c.name', $search);
        }
        
        $this->db->order_by('c.name', 'ASC');
        $this->db->limit(10);
        $query = $this->db->get();
        
        $cities = [];
        foreach ($query->result() as $row) {
            $cities[] = [
                'label' => $row->city_name,
                'value' => $row->city_name,
                'id' => $row->id
            ];
        }
        
        echo json_encode($cities);
    }
   
    public function save_child_age_price()
    {
        $train_schedule_id = $this->input->post('train_schedule_id');
        $class_type        = $this->input->post('class_type');
        $from_age          = $this->input->post('from_age');
        $to_age            = $this->input->post('to_age');
        $price             = $this->input->post('price');

        $data = [
            'train_schedule_id' => $train_schedule_id,
            'class_type'        => $class_type,
            'age_from'          => $from_age,
            'age_to'            => $to_age,
            'price'             => $price,
            'status'            => 'active'
        ];

        // Check overlap
        $this->db->where('train_schedule_id', $train_schedule_id);
        $this->db->where('class_type', $class_type);
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->where('age_from <=', $to_age);
        $this->db->where('age_to >=', $from_age);
        $this->db->group_end();

        $exists = $this->db->get('train_child_age_price')->row();

        if($exists){
            echo json_encode([
                'status'=>false,
                'msg'=>'Age range already exists or overlapping!'
            ]);
            return;
        }

        $this->db->insert('train_child_age_price', $data);

        // Update train_schedule table column
        if($class_type == "business"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['bussines_child_age'=>'yes']);
        }

        if($class_type == "economy"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['economy_child_age'=>'yes']);
        }

        if($class_type == "first"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['first_child_age'=>'yes']);
        }

        if($class_type == "second"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['second_child_age'=>'yes']);
        }

        if($class_type == "sitting"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['sitting_child_age'=>'yes']);
        }

        if($class_type == "vip"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['vip_child_age'=>'yes']);
        }

        if($class_type == "sleeper"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['sleeper_child_age'=>'yes']);
        }

        if($class_type == "coupe"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['coupe_child_age'=>'yes']);
        }

        if($class_type == "sv"){
            $this->db->where('id',$train_schedule_id);
            $this->db->update('train_schedule',['sv_child_age'=>'yes']);
        }

        echo json_encode(['status'=>true]);
    }

    public function get_single_age_price()
    {
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $data = $this->db->get('train_child_age_price')->row();
        echo json_encode($data);
    }

    public function get_child_age_price()
    {
        $train_schedule_id = $this->input->post('train_schedule_id');
        $class_type        = $this->input->post('class_type');

        $this->db->where('train_schedule_id',$train_schedule_id);
        $this->db->where('class_type',$class_type);
        $this->db->where('status','active');

        $records = $this->db->get('train_child_age_price')->result();

        foreach($records as $row){

            echo "<tr>

            <td>".$row->age_from."</td>
            <td>".$row->age_to."</td>
            <td>".$row->class_type."</td>
            <td>".$row->price."</td>

            <td>

            <i class='fa fa-edit editAge'
            data-id='".$row->id."'
            style='cursor:pointer;color:blue'></i>

            &nbsp;

            <i class='fa fa-trash deleteAge'
            data-id='".$row->id."'
            style='cursor:pointer;color:red'></i>

            </td>

            </tr>";
        }
    }

    public function update_child_age_price()
    {
        $id      = $this->input->post('id');
        $from    = $this->input->post('from_age');
        $to      = $this->input->post('to_age');
        $type    = $this->input->post('class_type');
        $price   = $this->input->post('price');

        $data = [
            'age_from'=>$from,
            'age_to'=>$to,
            'class_type'=>$type,
            'price'=>$price
        ];

        $this->db->where('id !=', $id);
        $this->db->where('train_schedule_id', $this->input->post('train_schedule_id'));
        $this->db->where('class_type', $type);
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->where('age_from <=', $to);
        $this->db->where('age_to >=', $from);
        $this->db->group_end();

        $exists = $this->db->get('train_child_age_price')->row();

        if($exists){
            echo json_encode([
                'status'=>false,
                'msg'=>'Age range overlap not allowed!'
            ]);
            return;
        }

        $this->db->where('id',$id);
        $this->db->update('train_child_age_price',$data);
        echo json_encode(['status'=>true]);
    }

    public function delete_child_age_price()
    {
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->update('train_child_age_price',[
            'status'=>'inactive'
        ]);
        echo json_encode(['status'=>true]);
    }
    
}

?>
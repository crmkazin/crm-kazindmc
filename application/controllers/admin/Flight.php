<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model(['admin/flight_model','flight_model','common_model']);
        $this->load->library(['pagination']);
        check_delete();
    }	

    public function index()
    {
        

        $this->form_validation->set_rules('airline_name', 'Airline Name', 'trim|required');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|callback_airline_name_code_unique');
        $this->form_validation->set_message('airline_name_code_unique', '&nbsp;&nbsp;Airline name with same code exists!');
		
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if($this->form_validation->run() == FALSE){
            $data['airlines'] = $this->flight_model->all_airlines(); 
            $data['content'] = 'admin/flight'; 
            $this->load->view('admin/layout', $data);	    
            log_user_activity('Airlines Add',$this->session->userdata('id'), 'Airlines: Add');
        } else {
            //$response = $this->flight_model->add_flight();
            $insert_arr = ['name'=>$this->input->post('airline_name'),'code'=>$this->input->post('code'),
                            'created'=>date('Y-m-d H:i:s')];
            $id = $this->common_model->insert_data(['table_name'=>'airlines','insert_data'=>$insert_arr]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Airlines Add New ',$this->session->userdata('id'), 'Airlines: Add New');
                redirect('all-flight');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Airlines Add Error',$this->session->userdata('id'), 'Airlines: Add (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

	public function airline_name_code_unique(){
		$where = ' status != "deleted" AND name = "'.$this->input->post('airline_name').'" AND code = "'.$this->input->post('code').'"'; 
		if($this->uri->segment(1)<>'' && $this->uri->segment(1)=='edit-airlines' && $this->input->get('id')<>''){
			$id = base64_decode($this->input->get('id'));
			$where = ' status != "deleted" AND name = "'.$this->input->post('airline_name').'" AND code = "'.$this->input->post('code').'" AND id != '.$id; 
		}
		$select = 'id';
		$count = $this->common_model->get_data('airlines','', '', $select,$where,'', $count = true);
		if($count){
			return false;
		}else { return true; }
	}

    public function flight_list(){
        //$data['flights'] = $this->flight_model->all_flight(); 
        log_user_activity('Airlines View',$this->session->userdata('id'), 'Airlines: View');

        $data['flights'] = $this->flight_model->all_airlines(); 
        $data['content'] = 'admin/flight_list'; 
        $this->load->view('admin/layout', $data);	    
    }

   public function edit(){
        $this->form_validation->set_rules('airline_name', 'Airline Name', 'trim|required');
        $this->form_validation->set_rules('code', 'Code', 'trim|required|callback_airline_name_code_unique');
		$this->form_validation->set_message('airline_name_code_unique', '&nbsp;&nbsp;Airline name with same code exists!');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        
        $id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-flight');
        $where = ' status!="deleted" AND id='.$id;
        $data['airlines'] = $this->common_model->get_data('airlines','', '', '*',$where, '', $count = false)[0];
        if(empty($data['airlines'])) { 
            $this->session->set_flashdata('message','<div class="alert alert-danger">No Records Found!</div>'); 
            
            redirect('all-flight'); 
        } 
        $where1 = ['id' => $id]; 

            $existing = $this->common_model->get_single(['table_name' => 'airlines', 'condition'  => $where1 ]);

            if (!empty($existing)) {
                $previous_data = [
                    'airline_name' => $existing['name'],
                    'code'         => $existing['code']
                ];
            } else {
                $previous_data = []; 
            }

        if($this->form_validation->run() == FALSE){
            log_user_activity('Airlines Edit',$this->session->userdata('id'), 'Airlines: Edit'); 
             $data['content'] = 'admin/edit_flight';
            $this->load->view('admin/layout', $data);	    
        } else {
            $update_arr = ['name'=>$this->input->post('airline_name'),'code'=>$this->input->post('code')];
            $id = $this->common_model->update_data_limit(['table_name'=>'airlines','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Airlines Update', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));
                redirect('all-flight');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Same record! Make changes to update.</div>');
                log_user_activity('Airlines Update', $this->session->userdata('id'), 'Previous Data: (Same record! Make changes to update)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function delete(){
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-flight');
        $update_arr = ['status'=>'deleted'];
        $id = $this->common_model->update_data_limit(['table_name'=>'airlines','update_data'=>$update_arr,'condition'=>['id'=>$id]]);
        if($id){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Airlines Delete',$this->session->userdata('id'), 'Airlines: Deleted');
            redirect('all-flight');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Airlines Delete Error',$this->session->userdata('id'), 'Airlines: Deleted(Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
    }
    
    public function schedule(){
        $this->form_validation->set_rules('airline_id', 'Airline Name', 'trim|required');
        $this->form_validation->set_rules('flight_number', 'Flight No.', 'trim|required');
        $this->form_validation->set_rules('departure_airport', 'Departing Airport', 'trim|required');
        $this->form_validation->set_rules('departure_city', 'Departing City', 'trim|required');
        // $this->form_validation->set_rules('departure_time', 'Departing Time', 'trim|required');
        $this->form_validation->set_rules('arrival_airport', 'Arrival Airport', 'trim|required');
        $this->form_validation->set_rules('arrival_city', 'Arrival City', 'trim|required');
        // $this->form_validation->set_rules('arrival_time', 'Arrival Time', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if($this->form_validation->run() == FALSE){
            $data['airlines'] = $this->flight_model->all_airlines();   
            $data['content'] = 'admin/flight_schedule'; 
            $this->load->view('admin/layout', $data);
            log_user_activity('Airlines Schedule Add',$this->session->userdata('id'), 'Airlines: Airlines Schedule: Add');
        } 
        else 
        {
            $airline_id = $this->input->post('airline_id');
            $flight_number = $this->input->post('flight_number');

            $this->db->where('airline_id', $airline_id);
            $this->db->where('flight_number', $flight_number);
            $this->db->where('status !=', 'deleted'); 
            $existing_flight = $this->db->get('flight_schedule')->result();
                
            if ($existing_flight) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! This flight number already exists for the selected airline.</div>');
                log_user_activity('Airlines Schedule Add New',$this->session->userdata('id'), 'Error: (This flight number already exists for the selected airline.)');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $operational_days = $this->input->post('operational_days'); 
            $departure_times = $this->input->post('departure_time'); 
            $arrival_times = $this->input->post('arrival_time');     

            $insert_array = [
                            'airline_id'=>$this->input->post('airline_id'),
                            'flight_number'=>$this->input->post('flight_number'),
                            'departure_airport'=>$this->input->post('departure_airport'),
                            'departure_city'=>$this->input->post('departure_city'),
                            'departure_time'=>isset($departure_times[0]) ? $departure_times[0] : '',
                            'arrival_airport'=>$this->input->post('arrival_airport'),
                            'arrival_city'=>$this->input->post('arrival_city'),
                            'arrival_time'=>isset($arrival_times[0]) ? $arrival_times[0] : '',
                            'tuesday_departure_time'=>isset($departure_times[1]) ? $departure_times[1] : '',
                            'tuesday_arrival_time'=>isset($arrival_times[1]) ? $arrival_times[1] : '',
                            'wednesday_departure_time'=>isset($departure_times[2]) ? $departure_times[2] : '',
                            'wednesday_arrival_time'=>isset($arrival_times[2]) ? $arrival_times[2] : '',
                            'thursday_departure_time'=>isset($departure_times[3]) ? $departure_times[3] : '',
                            'thursday_arrival_time'=>isset($arrival_times[3]) ? $arrival_times[3] : '',
                            'friday_departure_time'=>isset($departure_times[4]) ? $departure_times[4] : '',
                            'friday_arrival_time'=>isset($arrival_times[4]) ? $arrival_times[4] : '',
                            'saturday_departure_time'=>isset($departure_times[5]) ? $departure_times[5] : '',
                            'saturday_arrival_time'=>isset($arrival_times[5]) ? $arrival_times[5] : '',
                            'sunday_departure_time'=>isset($departure_times[6]) ? $departure_times[6] : '',
                            'sunday_arrival_time'=>isset($arrival_times[6]) ? $arrival_times[6] : '',
                            'days_of_operations' => implode(',', $operational_days),
                            'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];

            $id = $this->common_model->insert_data(['table_name'=>'flight_schedule','insert_data'=>$insert_array]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Created Successfully!</div>');
                log_user_activity('Airlines Flight Schedule Add New',$this->session->userdata('id'), 'Add New: '. json_encode($insert_array));
                redirect('all-flight-schedule');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Airlines Flight Schedule Add New',$this->session->userdata('id'), 'Error: (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public function flight_schedule_list(){

        $where = 'flight_schedule.status != "deleted"';
        
        if($this->input->get('flight_number') <> ''){
            $where .= ' AND flight_schedule.flight_number = "'.trim(urldecode($this->input->get('flight_number'))).'"';
            log_user_activity('Flight Schedule List Search',$this->session->userdata('id'), 'Search: '.$this->input->get('flight_number'));
        }
        
        $join = [['type'=>'','join_table'=>'airlines','condition'=>'airlines.id = flight_schedule.airline_id']];
        
        $select = 'flight_schedule.*,airlines.name,airlines.code';
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'all-flight-schedule/?'.$search[0];

        $config["total_rows"] = $this->common_model->get_data('flight_schedule','', '', 'flight_schedule.id',$where, '', $count = true);
        $data["total"] = $this->common_model->get_data('flight_schedule','', '', 'flight_schedule.id',$where, '', $count = true);
        
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
        $data['result'] = $this->common_model->get_data('flight_schedule',$offset, $config["per_page"], $select,$where, ' ORDER BY flight_schedule.id ASC', $count = false,$join);
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($data['result']);exit;
        log_user_activity('Flight Schedule List: View',$this->session->userdata('id'), 'Airlines: Flight Schedule List: View');

        $data['links'] = $this->pagination->create_links(); 
        $data['content'] = 'admin/flight_schedule_list'; 
        $this->load->view('admin/layout', $data);	
    }
    
    public function edit_schedule(){
        $schedule_id = ($this->input->get('id')<>'' && base64_decode($this->input->get('id'))<>'')?base64_decode($this->input->get('id')):redirect('all-flight-schedule');
        
        $this->form_validation->set_rules('airline_id', 'Airline Name', 'trim|required');
        $this->form_validation->set_rules('flight_number', 'Flight No.', 'trim|required');
        $this->form_validation->set_rules('departure_airport', 'Departing Airport', 'trim|required');
        $this->form_validation->set_rules('departure_city', 'Departing City', 'trim|required');
        // $this->form_validation->set_rules('departure_time', 'Departing Time', 'trim|required');
        $this->form_validation->set_rules('arrival_airport', 'Arrival Airport', 'trim|required');
        $this->form_validation->set_rules('arrival_city', 'Arrival City', 'trim|required');
        // $this->form_validation->set_rules('arrival_time', 'Arrival Time', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        $where = ' status!="deleted" AND id='.$schedule_id;
        $data['flight_schedule'] = $this->common_model->get_data('flight_schedule','', '', '*',$where, '', $count = false)[0];

            $existing = $this->common_model->get_single(['table_name' => 'flight_schedule', 'condition'  => $where ]);

            if (!empty($existing)) {
                $previous_data = [
                    'airline_id' => $existing['airline_id'],
                    'flight_number'         => $existing['flight_number'],
                    'departure_airport'         => $existing['departure_airport'],
                    'departure_city'         => $existing['departure_city'],
                    'departure_time'         => $existing['departure_time'],
                    'arrival_airport'         => $existing['arrival_airport'],
                    'arrival_city'         => $existing['arrival_city'],
                    'arrival_time'         => $existing['arrival_time'],
                    'tuesday_departure_time'         => $existing['tuesday_departure_time'],
                    'tuesday_arrival_time'         => $existing['tuesday_arrival_time'],
                    'wednesday_departure_time'         => $existing['wednesday_departure_time'],
                    'wednesday_arrival_time'         => $existing['wednesday_arrival_time'],
                    'thursday_departure_time'         => $existing['thursday_departure_time'],
                    'thursday_arrival_time'         => $existing['thursday_arrival_time'],
                    'friday_departure_time'         => $existing['friday_departure_time'],
                    'friday_arrival_time'         => $existing['friday_arrival_time'],
                    'saturday_departure_time'         => $existing['saturday_departure_time'],
                    'saturday_arrival_time'         => $existing['saturday_arrival_time'],
                    'sunday_departure_time'         => $existing['sunday_departure_time'],
                    'sunday_arrival_time'         => $existing['sunday_arrival_time'],
                    'days_of_operations'         => $existing['days_of_operations'],
                    'admin_id'         => $this->session->userdata('id'),
                ];
            } else {
                $previous_data = []; 
            }
        if($this->form_validation->run() == FALSE)
        {
            $data['airlines'] = $this->flight_model->all_airlines();   
            log_user_activity('Flight Schedule: Edit',$this->session->userdata('id'), 'Airlines: Flight Schedule: Edit');
            $data['content'] = 'admin/flight_schedule_edit'; 
            $this->load->view('admin/layout', $data);	    
        } else {
            $airline_id = $this->input->post('airline_id');
            $flight_number = $this->input->post('flight_number');

            $this->db->where('airline_id', $airline_id);
            $this->db->where('flight_number', $flight_number);
            $this->db->where('status !=', 'deleted');
            $this->db->where('id !=', $schedule_id); 
            $query = $this->db->get('flight_schedule');
            
            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! This flight number already exists for the selected airline.</div>');
                log_user_activity('Airlines Schedule Update', $this->session->userdata('id'), 'Error: (This flight number already exists for the selected airline.)');
                redirect($_SERVER['HTTP_REFERER']);
            }
            
            $operational_days = $this->input->post('operational_days'); 
            $departure_times = $this->input->post('departure_time'); 
            $arrival_times = $this->input->post('arrival_time');     
            $update_array = [
                            'airline_id'=>$this->input->post('airline_id'),
                            'flight_number'=>$this->input->post('flight_number'),
                            'departure_airport'=>$this->input->post('departure_airport'),
                            'departure_city'=>$this->input->post('departure_city'),
                            'departure_time'=>isset($departure_times[0]) ? $departure_times[0] : '',
                            'arrival_airport'=>$this->input->post('arrival_airport'),
                            'arrival_city'=>$this->input->post('arrival_city'),
                            'arrival_time'=>isset($arrival_times[0]) ? $arrival_times[0] : '',
                            'tuesday_departure_time'=>isset($departure_times[1]) ? $departure_times[1] : '',
                            'tuesday_arrival_time'=>isset($arrival_times[1]) ? $arrival_times[1] : '',
                            'wednesday_departure_time'=>isset($departure_times[2]) ? $departure_times[2] : '',
                            'wednesday_arrival_time'=>isset($arrival_times[2]) ? $arrival_times[2] : '',
                            'thursday_departure_time'=>isset($departure_times[3]) ? $departure_times[3] : '',
                            'thursday_arrival_time'=>isset($arrival_times[3]) ? $arrival_times[3] : '',
                            'friday_departure_time'=>isset($departure_times[4]) ? $departure_times[4] : '',
                            'friday_arrival_time'=>isset($arrival_times[4]) ? $arrival_times[4] : '',
                            'saturday_departure_time'=>isset($departure_times[5]) ? $departure_times[5] : '',
                            'saturday_arrival_time'=>isset($arrival_times[5]) ? $arrival_times[5] : '',
                            'sunday_departure_time'=>isset($departure_times[6]) ? $departure_times[6] : '',
                            'sunday_arrival_time'=>isset($arrival_times[6]) ? $arrival_times[6] : '',
                            'days_of_operations' => implode(',', $operational_days),
                            'admin_id'=>$this->session->userdata('id')];
            $id = $this->common_model->update_data_limit(['table_name'=>'flight_schedule','update_data'=>$update_array,'condition'=>['id'=>$schedule_id]]);
            if($id){
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                log_user_activity('Flight Schedule Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
                redirect('all-flight-schedule');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Flight Schedule Update Error',$this->session->userdata('id'), 'Previous Data: Error! Please Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
   
    
    public function delete_schedule()
    {
        $id = ($this->input->get('id')<>'')?base64_decode($this->input->get('id')):redirect('all-flight-schedule');
        //echo $id;exit;
        $flight_num = ($this->input->get('flight_num')<>'')?base64_decode($this->input->get('flight_num')):redirect('all-flight-schedule');
        $airline_id = ($this->input->get('airline_id')<>'')?base64_decode($this->input->get('airline_id')):redirect('all-flight-schedule');
        
        $where = ' arrival_flight_details.flight_number = "'.trim($flight_num).'" AND arrival_flight_details.airline_id = '.trim($airline_id);
        $arrival_flight_details = $this->common_model->get_data('arrival_flight_details', '', '', '*', $where, '', $count = true);
        
        $where = ' flight_schedule.flight_number = "'.trim($flight_num).'" AND flight_schedule.status = "active" AND flight_schedule.airline_id = '.trim($airline_id);
        $flight_schedule = $this->common_model->get_data('flight_schedule', '', '', '*', $where, '', $count = true);
        
        if($arrival_flight_details > 0 && $flight_schedule == 1){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Arrivals flight details found. Flight schedule cannot be deleted.</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $update_arr = ['status'=>'deleted'];
        $id = $this->common_model->update_data_limit(['table_name'=>'flight_schedule','update_data'=>$update_arr,'condition'=>['id'=>trim($id)]]);
        if($id){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Flight Schedule: Delete',$this->session->userdata('id'), 'Flight Schedule: Deleted');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Flight Schedule: Delete Error',$this->session->userdata('id'), 'Flight Schedule: Deleted (Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
    }
    
    public function get_schedule(){
        $this->form_validation->set_rules('flight_number', 'Flight Number', 'trim|required');
        $this->form_validation->set_rules('airline_id', 'Airline', 'trim|required');
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $flight_number = $this->input->post('flight_number');
        $airline_id = $this->input->post('airline_id');
        $where = ' status="active" AND flight_number = "'.$flight_number.'" AND airline_id = '.$airline_id;
        $schedule = $this->common_model->get_data('flight_schedule','', '', '*',$where, '', $count = false);
        if(!empty($schedule)){
            $response = ['response'=>'s','details'=>$schedule[0],'msg'=>''];
        }else{
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">No Details Found!</div>'];
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_flight_numbers(){
        $this->form_validation->set_rules('airport', 'Airport', 'trim|required');
        $this->form_validation->set_rules('airline_id', 'Airline ID', 'trim|required');
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $airport = $this->input->post('airport');
        $airline_id = $this->input->post('airline_id');
        $where = ' status="active" AND departure_airport = "'.$airport.'" AND airline_id = '.$airline_id;
        $flight_numbers = $this->common_model->get_data('flight_schedule','', '', 'flight_number',$where, '', $count = false);
        if(!empty($flight_numbers)){
            $response = ['response'=>'s','details'=>$flight_numbers,'msg'=>''];
        }else{
            $response = ['response'=>'e','details'=>'','msg'=>'<div class="alert alert-danger">No Details Found!</div>'];
        }
        echo json_encode($response);
        exit;
    }
    public function get_airline_code() 
    {
        $airline_id = $this->input->post('airline_id');
    
        if (!empty($airline_id)) {$airline = $this->common_model->get_single(['table_name' => 'airlines','condition'  => ['id' => $airline_id]]);
    
            if (!empty($airline)) {
                echo json_encode(['status' => 'success', 'code' => $airline['code']]);
            } else {
                echo json_encode(['status' => 'error', 'code' => '']);
            }
        } else {
            echo json_encode(['status' => 'error', 'code' => '']);
        }
    }
    
    
}

?>
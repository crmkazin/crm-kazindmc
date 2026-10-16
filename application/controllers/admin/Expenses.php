<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model('common_model');
    }		

    public function travel()
    {
        $this->form_validation->set_rules('claimer_name', 'Name', 'trim|required');
         $this->form_validation->set_rules('location', 'Location', 'trim|required');
         $this->form_validation->set_rules('grade', 'Grade', 'trim|required');
         $this->form_validation->set_rules('city_visited', 'City Visited', 'trim|required');
         $this->form_validation->set_rules('duration', 'Duration', 'trim|required');
         $this->form_validation->set_rules('visited_for', 'Visited For', 'trim|required');
         //$this->form_validation->set_rules('bill_amount', 'Bill Amount', 'trim|required');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/travel_expense_view');
        }else{  
            $intercity=$this->input->post('intercity_travel_amount'); 
            $local=$this->input->post('local_amount'); 
            $accomdation=$this->input->post('acc_food_amount'); 
            $misslenious=$this->input->post('expense_amount'); 
            $intersity_1= array_sum($intercity); 
            $local_1=array_sum($local);
            $accomdation_1=array_sum($accomdation);
            $misslenoius_1=array_sum($misslenious);
            $total_amount=$intersity_1 + $local_1 + $accomdation_1 + $misslenoius_1;
           // echo $total_amount;
            
            
            
            //exit;      
            $created = date('Y-m-d H:i:s');
            $bill_date = explode('-',$this->input->post('bill_date'));
            $bill_date = $bill_date[2].'-'.$bill_date[1].'-'.$bill_date[0];
            
            $traveled_on = explode('-',$this->input->post('traveled_on'));
            $traveled_on = $traveled_on[2].'-'.$traveled_on[1].'-'.$traveled_on[0];
            
            $returned_on = explode('-',$this->input->post('returned_on'));
            $returned_on = $returned_on[2].'-'.$returned_on[1].'-'.$returned_on[0];
            
            $insert_array = ['claimer_name'=>$this->input->post('claimer_name'),'bill_date'=>$bill_date,
                            'location'=>$this->input->post('location'),'traveled_on'=>$traveled_on,
                            'grade'=>$this->input->post('grade'),'returned_on'=>$returned_on,
                            'city_visited'=>$this->input->post('city_visited'),'duration'=>$this->input->post('duration'),
                            'visited_for'=>$this->input->post('visited_for'),'total_bill_amount'=>$total_amount,
                            'created'=>$created];
            $travel_expenses_id = $this->common_model->insert_data(['table_name'=>'travel_expenses','insert_data'=>$insert_array]);
            
            if($this->input->post('travel_date')[0]<>''){
               // print_r($_POST);EXIT;
                $cnt = count($this->input->post('travel_date'));
                $insert_array = [];
                for($i=0;$i<$cnt;$i++){
                    $travel_date = explode('-',$this->input->post('travel_date')[$i]);
                    $travel_date = $travel_date[2].'-'.$travel_date[1].'-'.$travel_date[0];
                    
                    $insert_array[$i] = ['travel_date'=>$travel_date,'travel_mode'=>$this->input->post('intercity_travel_mode')[$i],
                            'from_place'=>$this->input->post('from_place')[$i],'to_place'=>$this->input->post('to_place')[$i],
                            'departure_time'=>$this->input->post('departure_time')[$i],'arrival_time'=>$this->input->post('arrival_time')[$i],
                            'intercity_amount'=>$this->input->post('intercity_travel_amount')[$i],'travel_expenses_id'=>$travel_expenses_id,                            
                            'created'=>$created]; 
                }
                $this->common_model->insert_data_batch(['table_name'=>'intercity_travel_expenses','insert_data'=>$insert_array]);
            }
            
            if($this->input->post('local_travel_date')[0]<>''){
                $cnt = count($this->input->post('local_travel_date'));
                $insert_array = [];
                for($i=0;$i<$cnt;$i++){
                    $local_travel_date = explode('-',$this->input->post('local_travel_date')[$i]);
                    $local_travel_date = $local_travel_date[2].'-'.$local_travel_date[1].'-'.$local_travel_date[0];
                    
                    $insert_array[$i] = ['travel_date'=>$local_travel_date,'from_local_place'=>$this->input->post('from_local_place')[$i],
                            'to_local_place'=>$this->input->post('to_local_place')[$i],'local_amount'=>$this->input->post('local_amount')[$i],
                            'local_travel_mode'=>$this->input->post('mode')[$i],
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created]; 
                }
                $this->common_model->insert_data_batch(['table_name'=>'local_travel_expenses','insert_data'=>$insert_array]);
            }


            if($this->input->post('acc_food_city_visited')[0]<>''){
                $cnt = count($this->input->post('acc_food_city_visited'));
                $insert_array = [];
                for($i=0;$i<$cnt;$i++){
                    $insert_array[$i] = ['city_visited'=>$this->input->post('acc_food_city_visited')[$i],'hotel_amount'=>$this->input->post('hotel')[$i],
                            'food_amount'=>$this->input->post('food')[$i],'hour_day'=>$this->input->post('hour_day')[$i],
                            'amount'=>$this->input->post('acc_food_amount')[$i],
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created]; 
                }
                $this->common_model->insert_data_batch(['table_name'=>'accomodation_food','insert_data'=>$insert_array]);
            }


            if($this->input->post('expenses')[0]<>''){
                $cnt = count($this->input->post('expenses'));
                $insert_array = [];
                for($i=0;$i<$cnt;$i++){
                    $insert_array[$i] = ['expenses_with_remarks'=>$this->input->post('expenses')[$i],'amount'=>$this->input->post('expense_amount')[$i],
                            
                            
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created]; 
                }
                $this->common_model->insert_data_batch(['table_name'=>'miscellaneous_expenses','insert_data'=>$insert_array]);
            }








            
           // echo '<pre>';print_r($_POST);
                       // if(!empty($_FILES['reports'])){
            //     $cnt = count($_FILES['reports']['name']);
            //     $FILES['reports'] = $_FILES['reports'];                
            //     for($i=0;$i<$cnt;$i++) { 
            //         $filename=[];$_FILES['inv']=[];
            //         $_FILES['inv']['name'] = $FILES['reports']['name'][$i];
            //         $_FILES['inv']['type'] = $FILES['reports']['type'][$i];
            //         $_FILES['inv']['tmp_name'] = $FILES['reports']['tmp_name'][$i];
            //         $_FILES['inv']['error'] = $FILES['reports']['error'][$i];
            //         $_FILES['inv']['size'] = $FILES['reports']['size'][$i];
            //         $config['upload_path'] = './uploaded_reports/';
            //         $config['allowed_types'] = 'xlsx|xls|pdf';
            //         $config['max_size'] = '2048';
            //         $config['max_width'] = '0';
            //         $config['max_height'] = '0';
            //         $config['detect_mime'] = TRUE;
            //         $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
            //         $this->upload->initialize($config);
            //         if (!$this->upload->do_upload('inv')){ 
            //             echo $this->upload->display_errors();
            //         }else{
            //             $filename = $this->upload->data();
            //         }          
            //         $insert_reports[] = $filename['file_name'];
            //     }                
            // }

            //test

            //echo '<pre>'; print_r($_FILES);exit;
             $this->load->library('upload');
            $insert_invoices = $insert_reports = [];

            if(!empty($_FILES['intercity_travel_bills'])){
                $cnt = count($_FILES['intercity_travel_bills']['name']);
               // echo $cnt;exit;
                $insert_array = [];
                $FILES['intercity_travel_bills'] = $_FILES['intercity_travel_bills'];                
                for($i=0;$i<$cnt;$i++) { 
                    $filename=[];$_FILES['inv']=[];
                    $_FILES['inv']['name'] = $FILES['intercity_travel_bills']['name'][$i];
                    $_FILES['inv']['type'] = $FILES['intercity_travel_bills']['type'][$i];
                    $_FILES['inv']['tmp_name'] = $FILES['intercity_travel_bills']['tmp_name'][$i];
                    $_FILES['inv']['error'] = $FILES['intercity_travel_bills']['error'][$i];
                    $_FILES['inv']['size'] = $FILES['intercity_travel_bills']['size'][$i];
                    $config['upload_path'] = './uploaded_bills/';
                    $config['allowed_types'] = 'pdf|jpg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('inv')){ 
                        //echo $this->upload->display_errors();
                    }else{
                        $filename = $this->upload->data();
                        $insert_array[$i] = ['type'=>'intercity','uploaded_bill'=>$filename['file_name'],
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created];
                        
                    }          

                }
               // print_r($insert_array);exit;
                if(!empty($insert_array)){
                    $this->common_model->insert_data_batch(['table_name'=>'travel_expenses_bills','insert_data'=>$insert_array]);
                }
            }
            //test

            
            //test


            if(!empty($_FILES['local_travel_bills'])){
                $cnt = count($_FILES['local_travel_bills']['name']);
                $insert_array = [];
                $FILES['local_travel_bills'] = $_FILES['local_travel_bills'];                
                for($i=0;$i<$cnt;$i++) { 
                    $filename=[];$_FILES['inv']=[];
                    $_FILES['inv']['name'] = $FILES['local_travel_bills']['name'][$i];
                    $_FILES['inv']['type'] = $FILES['local_travel_bills']['type'][$i];
                    $_FILES['inv']['tmp_name'] = $FILES['local_travel_bills']['tmp_name'][$i];
                    $_FILES['inv']['error'] = $FILES['local_travel_bills']['error'][$i];
                    $_FILES['inv']['size'] = $FILES['local_travel_bills']['size'][$i];
                    $config['upload_path'] = './uploaded_bills/';
                    $config['allowed_types'] = 'pdf|jpg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('inv')){ 
                        //echo $this->upload->display_errors();
                    }else{
                        $filename = $this->upload->data();
                        $insert_array[$i] = ['type'=>'local_travel','uploaded_bill'=>$filename['file_name'],
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created];
                        
                    }          

                }
                if(!empty($insert_array)){
                    $this->common_model->insert_data_batch(['table_name'=>'travel_expenses_bills','insert_data'=>$insert_array]);
                }
               
            }

            if(!empty($_FILES['accomodation_food_bills'])){
                $cnt = count($_FILES['accomodation_food_bills']['name']);
                $insert_array = [];
                $FILES['accomodation_food_bills'] = $_FILES['accomodation_food_bills'];                
                for($i=0;$i<$cnt;$i++) { 
                    $filename=[];$_FILES['inv']=[];
                    $_FILES['inv']['name'] = $FILES['accomodation_food_bills']['name'][$i];
                    $_FILES['inv']['type'] = $FILES['accomodation_food_bills']['type'][$i];
                    $_FILES['inv']['tmp_name'] = $FILES['accomodation_food_bills']['tmp_name'][$i];
                    $_FILES['inv']['error'] = $FILES['accomodation_food_bills']['error'][$i];
                    $_FILES['inv']['size'] = $FILES['accomodation_food_bills']['size'][$i];
                    $config['upload_path'] = './uploaded_bills/';
                    $config['allowed_types'] = 'pdf|jpg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('inv')){ 
                        //echo $this->upload->display_errors();
                    }else{
                        $filename = $this->upload->data();
                        $insert_array[$i] = ['type'=>'accomodation_food','uploaded_bill'=>$filename['file_name'],
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created];
                        
                    }          

                }
                if(!empty($insert_array)){
                    $this->common_model->insert_data_batch(['table_name'=>'travel_expenses_bills','insert_data'=>$insert_array]);
                }    
            }

            if(!empty($_FILES['miscellaneous_bills'])){
                $cnt = count($_FILES['miscellaneous_bills']['name']);
                $insert_array = [];
                $FILES['miscellaneous_bills'] = $_FILES['miscellaneous_bills'];                
                for($i=0;$i<$cnt;$i++) { 
                    $filename=[];$_FILES['inv']=[];
                    $_FILES['inv']['name'] = $FILES['miscellaneous_bills']['name'][$i];
                    $_FILES['inv']['type'] = $FILES['miscellaneous_bills']['type'][$i];
                    $_FILES['inv']['tmp_name'] = $FILES['miscellaneous_bills']['tmp_name'][$i];
                    $_FILES['inv']['error'] = $FILES['miscellaneous_bills']['error'][$i];
                    $_FILES['inv']['size'] = $FILES['miscellaneous_bills']['size'][$i];
                    $config['upload_path'] = './uploaded_bills/';
                    $config['allowed_types'] = 'pdf|jpg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('inv')){ 
                        //echo $this->upload->display_errors();
                    }else{
                        $filename = $this->upload->data();
                        $insert_array[$i] = ['type'=>'miscellaneous','uploaded_bill'=>$filename['file_name'],
                            'travel_expenses_id'=>$travel_expenses_id,'created'=>$created];
                        
                    }          

                }
                if(!empty($insert_array)){
                    $this->common_model->insert_data_batch(['table_name'=>'travel_expenses_bills','insert_data'=>$insert_array]);
                }
            }
           
            //test
           redirect('expenses/travel-expenses-details'); 
        }
        
    }

    public function expenses_list()
    {
        $data['expenses']=$this->db->select('*')->from('travel_expenses')->order_by('id','DESC')->get()->result();
        $this->load->view('admin/list-expenses',$data);
    }

    public function expenses_data($id)
    {
        $id=base64_decode($id);
        $data['expenses']=$this->db->select('*')->from('travel_expenses')->where('id',$id)->get()->result();
       // print_r($data['expenses']);exit;
$data['local_travel_expenses']=$this->db->select('*')->from('local_travel_expenses')->where('travel_expenses_id',$id)->get()->result();
//print_r($data['local_travel_expenses']);exit;
$data['miscellaneous_expenses']=$this->db->select('*')->from('miscellaneous_expenses')->where('travel_expenses_id',$id)->get()->result();
$data['travel_expenses_bills']=$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->get()->result();
$data['intercity_travel_expenses']=$this->db->select('*')->from('intercity_travel_expenses')->where('travel_expenses_id',$id)->get()->result();
$data['accomodation_food']=$this->db->select('*')->from('accomodation_food')->where('travel_expenses_id',$id)->get()->result();
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','intercity');
$data['intercity']=$this->db->get()->num_rows();
//print_r($data['intercity']);
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','accomodation_food');
$data['accomodation_food1']=$this->db->get()->num_rows();
//print_r($data['accomodation_food']);
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','miscellaneous');
$data['miscellaneous']=$this->db->get()->num_rows();
//print_r($data['miscellaneous']);
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','local_travel');
$data['local_travel']=$this->db->get()->num_rows();
//print_r($data['local_travel']);

$this->load->view('admin/new_expense_bill_16',$data);
       
    }

    public function expenses_data2($id)
    {
        $id=base64_decode($id);
        $data['expenses']=$this->db->select('*')->from('travel_expenses')->where('id',$id)->get()->result();
       // print_r($data['expenses']);exit;
$data['local_travel_expenses']=$this->db->select('*')->from('local_travel_expenses')->where('travel_expenses_id',$id)->get()->result();
//print_r($data['local_travel_expenses']);exit;
$data['miscellaneous_expenses']=$this->db->select('*')->from('miscellaneous_expenses')->where('travel_expenses_id',$id)->get()->result();
$data['travel_expenses_bills']=$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->get()->result();
$data['intercity_travel_expenses']=$this->db->select('*')->from('intercity_travel_expenses')->where('travel_expenses_id',$id)->get()->result();
$data['accomodation_food']=$this->db->select('*')->from('accomodation_food')->where('travel_expenses_id',$id)->get()->result();
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','intercity');
$data['intercity']=$this->db->get()->num_rows();
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','intercity');
$data['intercity_bills']=$this->db->get()->result();
//print_r($data['intercity']);
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','accomodation_food');
$data['accomodation_food1']=$this->db->get()->num_rows();
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','accomodation_food');
$data['accomodation_food1_bill']=$this->db->get()->result();
//print_r($data['accomodation_food']);
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','miscellaneous');
$data['miscellaneous']=$this->db->get()->num_rows();
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','miscellaneous');
$data['miscellaneous_bill']=$this->db->get()->result();
//print_r($data['miscellaneous']);
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','local_travel');
$data['local_travel']=$this->db->get()->num_rows();
$this->db->select('*')->from('travel_expenses_bills')->where('travel_expenses_id',$id)->where('type','local_travel');
$data['local_travel_bills']=$this->db->get()->result();
//print_r($data['local_travel']);

$this->load->view('admin/bills-expenses-data',$data);
       
    }
    // public function expenses_view(){
    //      $this->load->view('admin/mislinous-travel-form');
    //  }


     public function miscellinous_expenses()
     {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        //$this->form_validation->set_rules('bill_amount', 'Bill Amount', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/mislinous-travel-form');
        }else{ 
            $misc=$this->input->post('expense_amount');
           // print_r($misc);
            $miscellinous= array_sum($misc); 
            //echo $miscellinous;exit;

            $created = date('Y-m-d H:i:s');
            $d = explode('-',$this->input->post('date'));
            $insert_array = ['name'=>$this->input->post('name'),'grade'=>$this->input->post('grade'),'location'=>$this->input->post('location'),'date'=>$d[2].'-'.$d[1].'-'.$d[0],'bill_amount'=>$miscellinous,
                            'created'=>$created];
            $travel_expenses_id = $this->common_model->insert_data(['table_name'=>'miscellinous_details','insert_data'=>$insert_array]);
            $this->session->set_flashdata('message','details submited');
            
            if($this->input->post('expenses')[0]<>''){
                $cnt = count($this->input->post('expenses'));
                $insert_array = [];
                for($i=0;$i<$cnt;$i++){
                    
                    $insert_array[$i] = ['bill_date'=>$this->input->post('bill_date')[$i],'bill_no'=>$this->input->post('bill_no')[$i],'expenses_remarks'=>$this->input->post('expenses')[$i],'amount'=>$this->input->post('expense_amount')[$i],
                            
                            
                            'miscell_id'=>$travel_expenses_id,'created'=>$created]; 
                }
                $this->common_model->insert_data_batch(['table_name'=>'miscellinous_details_2','insert_data'=>$insert_array]);
            }
            $this->load->library('upload');
            if(!empty($_FILES['miscellaneous_bills'])){
                $cnt = count($_FILES['miscellaneous_bills']['name']);
                $insert_array = [];
                $FILES['miscellaneous_bills'] = $_FILES['miscellaneous_bills'];                
                for($i=0;$i<$cnt;$i++) { 
                    $filename=[];$_FILES['inv']=[];
                    $_FILES['inv']['name'] = $FILES['miscellaneous_bills']['name'][$i];
                    $_FILES['inv']['type'] = $FILES['miscellaneous_bills']['type'][$i];
                    $_FILES['inv']['tmp_name'] = $FILES['miscellaneous_bills']['tmp_name'][$i];
                    $_FILES['inv']['error'] = $FILES['miscellaneous_bills']['error'][$i];
                    $_FILES['inv']['size'] = $FILES['miscellaneous_bills']['size'][$i];
                    $config['upload_path'] = './uploaded_miscellinous_bills/';
                    $config['allowed_types'] = 'pdf|jpg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';
                    $config['detect_mime'] = TRUE;
                    $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('inv')){ 
                        //echo $this->upload->display_errors();
                    }else{
                        $filename = $this->upload->data();
                        $insert_array[$i] = ['type'=>'miscellaneous_bills','uploaded_bill'=>$filename['file_name'],
                            'miscellinius_id'=>$travel_expenses_id,'created'=>$created];
                        
                    } 
                }
                if(!empty($insert_array)){
                    $this->common_model->insert_data_batch(['table_name'=>'miscellinous_bills','insert_data'=>$insert_array]);
                }
            
            }
                
$this->session->set_flashdata('message','details submit successfully');
            redirect('admin/expenses/miscellinous_expenses');


        }
                      

     }

     public function intercity_form()
     {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
       // $this->form_validation->set_rules('bill_amount', 'Bill Amount', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
    //    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/Intercity-form');
        }else{ 
            $intercity=$this->input->post('intercity_travel_amount');
           // print_r($misc);
            $intercity_amount= array_sum($intercity); 
        
            $created = date('Y-m-d H:i:s');
            $d = explode('-',$this->input->post('date'));
            $insert_array = ['name'=>$this->input->post('name'),'date'=>$d[2].'-'.$d[1].'-'.$d[0],
                            'phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'),'grade'=>$this->input->post('grade'),
                            'amount'=>$intercity_amount,
                            'created'=>$created];
          
                            $travel_expenses_id = $this->common_model->insert_data(['table_name'=>' intercity_expenses_data','insert_data'=>$insert_array]);


                            if($this->input->post('travel_date')[0]<>''){
                                $cnt = count($this->input->post('travel_date'));
                                $insert_array = [];
                                for($i=0;$i<$cnt;$i++){
                                    $d = explode('-',$this->input->post('travel_date')[$i]);
                                    $insert_array[$i] = ['place_visited'=>$this->input->post('place_visited')[$i],'travel_date'=>$d[2].'-'.$d[1].'-'.$d[0],'mode'=>$this->input->post('intercity_travel_mode')[$i],
                                    'from_place'=>$this->input->post('from_place')[$i],'to_place'=>$this->input->post('to_place')[$i],'km'=>$this->input->post('km')[$i],'remark'=>$this->input->post('remark')[$i],
                                    'dp_time'=>$this->input->post('departure_time')[$i],'ar_time'=>$this->input->post('arrival_time')[$i],
                                    'amount'=>$this->input->post('intercity_travel_amount')[$i],'intercity_id'=>$travel_expenses_id,                            
                                    'created'=>$created];
                                  
                                }
                                $this->common_model->insert_data_batch(['table_name'=>'intercity_travel_data','insert_data'=>$insert_array]);
                            }
                            $this->load->library('upload');
                            if(!empty($_FILES['intercity_travel_bills'])){
                                $cnt = count($_FILES['intercity_travel_bills']['name']);
                               // echo $cnt;exit;
                                $insert_array = [];
                                $FILES['intercity_travel_bills'] = $_FILES['intercity_travel_bills'];                
                                for($i=0;$i<$cnt;$i++) { 
                                    $filename=[];$_FILES['inv']=[];
                                    $_FILES['inv']['name'] = $FILES['intercity_travel_bills']['name'][$i];
                                    $_FILES['inv']['type'] = $FILES['intercity_travel_bills']['type'][$i];
                                    $_FILES['inv']['tmp_name'] = $FILES['intercity_travel_bills']['tmp_name'][$i];
                                    $_FILES['inv']['error'] = $FILES['intercity_travel_bills']['error'][$i];
                                    $_FILES['inv']['size'] = $FILES['intercity_travel_bills']['size'][$i];
                                    $config['upload_path'] = './intercity_bills/';
                                    $config['allowed_types'] = 'pdf|jpg';
                                    $config['max_size'] = '2048';
                                    $config['max_width'] = '0';
                                    $config['max_height'] = '0';
                                    $config['detect_mime'] = TRUE;
                                    $config['file_name'] = substr(rand(),0,5).time().'_'.str_replace(' ','_',$_FILES['inv']['name']);
                                    $this->upload->initialize($config);
                                    if (!$this->upload->do_upload('inv')){ 
                                        //echo $this->upload->display_errors();
                                    }else{
                                        $filename = $this->upload->data();
                                        $insert_array[$i] = ['type'=>'intercity','uploaded_bill'=>$filename['file_name'],
                                            'intercity_id'=>$travel_expenses_id,'created'=>$created];
                                        
                                    }          
                
                                }
                               // print_r($insert_array);exit;
                                if(!empty($insert_array)){
                                    $this->common_model->insert_data_batch(['table_name'=>'intercity_bills','insert_data'=>$insert_array]);
                                }
                            }
                           
                            $this->session->set_flashdata('message','details submit successfully');
                            redirect('admin/expenses/intercity_form');
        }

     }
     public function local_travel()
     {
        $this->load->view('admin/local-travel-form');
     }

     public function miscellinous()
     {
        $data['miscellinous']=$this->db->select('*')->from('miscellinous_details')->get()->result();
        $this->load->view('admin/list-miscellnious',$data);
     }
     public function miscellinous_record($id)
     {
        $id=base64_decode($id);
        $data['miscellinous']=$this->db->select('*')->from('miscellinous_details')->where('id',$id)->get()->result();
        $data['miscellinous_detail']=$this->db->select('*')->from('miscellinous_details_2')->where('miscell_id',$id)->get()->result();
        $this->db->select('*')->from('miscellinous_bills')->where('miscellinius_id',$id);
$data['miscellinous_bills']=$this->db->get()->num_rows();
       //print_r ($data['accomodation_food1']);exit;
        $this->load->view('admin/new_mis_bill_23',$data);

     }
     public function list_intercity()
     {
        $data['intercity']=$this->db->select('*')->from('intercity_expenses_data')->get()->result();
        $this->load->view('admin/list-intercity',$data);

     }
     public function intercity_data($id)
     {
        $id=base64_decode($id);
        $data['intercity']=$this->db->select('*')->from('intercity_expenses_data')->where('id',$id)->get()->result();
        $data['intercity_detail']=$this->db->select('*')->from(' intercity_travel_data')->where('intercity_id',$id)->get()->result();
        $this->db->select('*')->from('intercity_bills')->where('intercity_id',$id);
$data['intercity_bills']=$this->db->get()->num_rows();
$this->load->view('admin/new_intercity_bill_17',$data);
   
        

     }

     public function new()
     {
        $this->load->view('admin/new-travel-expenses');
     }
}
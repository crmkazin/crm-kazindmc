<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['admin/login_model','common_model']);
	}

	public function index()
	{
		
            if($this->input->post('login')){
                $auth = $this->login_model->login();
                if(!empty($auth)){
                    $this->session->set_userdata('id', $auth->id);
                        $this->session->set_userdata('name', $auth->name);
                        $this->session->set_userdata('email',$this->security->xss_clean($this->input->post('email')));
                        $this->session->set_userdata('type',$auth->type);
                        $this->session->set_userdata('admin_type',$auth->admin_type);
                        $this->session->set_userdata('contact_number',$auth->contact_number);
                        $this->session->set_userdata('locations',$auth->location);

                        redirect('dashboard');	
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid Email or Password!</div>');	
                    redirect($_SERVER['HTTP_REFERER']);		
                }	
            }

            $this->load->view('admin/login');
	}
	
	public function logout(){
	$this->session->sess_destroy();
	redirect('login');
	}	
	
	public function indiamart_enquiry(){
	   
    $this->load->model('admin/enquiry_model');

	$json_url = "https://mapi.indiamart.com/wservce/enquiry/listing/GLUSR_MOBILE/9250059892/GLUSR_MOBILE_KEY/MTU5ODYwMDUwMS4xOTkjMzM0ODIwOA==/";  
	$crl = curl_init();
	curl_setopt($crl, CURLOPT_URL, $json_url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, FALSE); 
	$json = curl_exec($crl);
	curl_close($crl);
	$enq = json_decode($json, TRUE);
	//echo '<pre>';print_r($enq);exit;
	$this->enquiry_model->indiamart_enquiry($enq);	
    	
	}	
	
	public function indiamart_enquiry_new(){
            $json_url = "https://mapi.indiamart.com/wservce/crm/crmListing/v2/?glusr_crm_key=mR22E7Fu7H/HSPes4nWJ7lqNp1vGnTk=";  
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $json_url);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, FALSE); 
            $json = curl_exec($crl);
            curl_close($crl);
            $enq = json_decode($json);
            //echo '<pre>';print_r($enq);exit;
            if($enq->STATUS=='SUCCESS'){
                foreach($enq->RESPONSE AS $list){
                    $where = 'enquiry.indiamart_query_id = "'.$list->UNIQUE_QUERY_ID.'"';
                    $cnt = $this->common_model->get_data('enquiry','', '','enquiry.id',$where, '', $count = true);
                    if($cnt == '0'){
                        $where = 'UPPER(company.name) = "'.strtoupper($list->SENDER_COMPANY).'"';
                        $join = [['type'=>'LEFT','join_table'=>'branch','condition'=>'branch.company_id = company.company_id']];
                        $company = $this->common_model->get_data('company','', '','*',$where, '', $count = false,$join);
                        if(empty($company[0])){
                            $company_id = rand(100,999).uniqid();
                            $branch_id = rand(100,999).uniqid();
                            $sender_company = ($list->SENDER_COMPANY<>'')?$list->SENDER_COMPANY:$list->UNIQUE_QUERY_ID;
                            $insert_data = ['company_id'=>$company_id,'name'=>$sender_company,'date'=>date("Y-m-d")];
                            $id = $this->common_model->insert_data(['table_name'=>'company','insert_data'=>$insert_data]);
                            if($id){
                                $where = 'UPPER(countries.sortname)="'.strtoupper($list->SENDER_COUNTRY_ISO).'"';
                                $country = $this->common_model->get_data('countries','', '','countries.name',$where, '', $count = false)[0];
                                $branch_data = array('company_id'=>$company_id,'branch_id'=>$branch_id,'country'=>$country->name,
                                                    'state'=>$list->SENDER_STATE,'city'=>$list->SENDER_CITY,
                                                    'address'=>$list->SENDER_ADDRESS,'contact_person'=>$list->SENDER_NAME,
                                                    'contact_number'=>$list->SENDER_MOBILE,'email'=>$list->SENDER_EMAIL,'date'=>date("Y-m-d"));
                                $id = $this->common_model->insert_data(['table_name'=>'branch','insert_data'=>$branch_data]);
                            }
                        }else{
                            $company_id = $company[0]->company_id;
                            $branch_id = '';
                            foreach($company AS $key=>$val){
                                if(strtoupper($val->city) == strtoupper($list->SENDER_CITY)){ 
                                    $branch_id = $val->branch_id;
                                    break;
                                }
                            }
                            if($branch_id==''){
                                $branch_id = rand(100,999).uniqid();
                                $branch_data = array('company_id'=>$company_id,'branch_id'=>$branch_id,'country'=>$country->name,
                                                    'state'=>$list->SENDER_STATE,'city'=>$list->SENDER_CITY,
                                                    'address'=>$list->SENDER_ADDRESS,'contact_person'=>$list->SENDER_NAME,
                                                    'contact_number'=>$list->SENDER_MOBILE,'email'=>$list->SENDER_EMAIL,'date'=>date("Y-m-d"));
                                $this->common_model->insert_data(['table_name'=>'branch','insert_data'=>$branch_data]);
                            }
                        }
                        $insert_data = array('indiamart_query_id'=>$list->UNIQUE_QUERY_ID,'mode'=>'Indiamart',
                                    'company'=>$company_id,'branch'=>$branch_id,'enquiry_for'=>$list->QUERY_PRODUCT_NAME,
                                    'enquiry_type' =>'Indiamart','status'=>'automated-enquiry','remarks'=>$list->QUERY_MESSAGE,
                                    'date'=>date("Y-m-d"));
                        $this->common_model->insert_data(['table_name'=>'enquiry','insert_data'=>$insert_data]);
                    }
                }
            }
        }
	
	
}

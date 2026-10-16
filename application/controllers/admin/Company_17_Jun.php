<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
                redirect('login');
        }
        check_delete();
        
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library('pagination');
    }	

    public function get_country_ajax(){
    // POST data
        $postData = $this->input->post();
    // get data
        $data = $this->company_model->get_country_ajax($postData);
        echo json_encode($data);
    }
    
    public function get_country_ajax_new(){
    // POST data
        $postData = $this->input->post();
    // get data
        $data = $this->company_model->get_country_ajax_new($postData);
        echo json_encode($data);
    }
	
	public function get_state_ajax(){
    $postData = $this->input->post();
    $data = $this->company_model->get_state_ajax($postData);
    echo json_encode($data);	
	}	
	
	public function get_city_ajax(){
    $postData = $this->input->post();
    $data = $this->company_model->get_city_ajax($postData);
    echo json_encode($data);	
	}	
	
	public function get_branch_ajax(){
            $this->company_model->get_branch_ajax();	
	}
	
	public function branch_detail_ajax(){
	$this->company_model->branch_detail_ajax();
	}	
	
	public function company_name_suggesstion(){
    // POST data
    $postData = $this->input->post();

    // get data
    $data = $this->company_model->company_name_suggesstion($postData);

    echo json_encode($data);
	}
	
	public function enquiry_suggesstion(){

    $postData = $this->input->post();
    $data = $this->company_model->enquiry_suggesstion($postData);

    echo json_encode($data);
	}	

    public function index()
    {
    $allowed_users = ['1','3','5'];
    if(!in_array($this->session->userdata('type'),$allowed_users)){
        $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
        redirect('dashboard');
    }
    $this->load->model('admin/group_model');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique');
    $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required|integer|callback_mobile_unique');
    $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
    $this->form_validation->set_message('email_unique', '&nbsp;&nbsp;Email Id Already Registered');
    $this->form_validation->set_message('mobile_unique', '&nbsp;&nbsp;Mobile Number Already Registered');

    if ($this->form_validation->run() == FALSE) {
        $data['groups'] = $this->group_model->all_groups();
        $data['countries'] = $this->company_model->all_countries();
        $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
        $this->load->view('admin/company', $data);
    } else {
        if ($this->input->post('company_id') == '') {
            $where = ' LOWER(name)= "' . strtolower(trim($this->input->post('name'))) . '" AND is_deleted ="0"';
            $res_company = $this->common_model->get_data('company', '', '', '*', $where, '', $count = true);
            if ($res_company > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Company with name (' . $this->input->post('name') . ') exists!</div>');
                redirect('company');
            }
        }

        $result = $this->company_model->new_company();
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
            redirect('clients');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error!</div>');
            redirect('clients');
        }
    }
}
	
        public function email_unique(){
            $where = ' status != "deleted" AND email = "'.$this->input->post('email').'"'; 
            if($this->uri->segment(2)<>'' && $this->uri->segment(2)=='edit-client'){
                $where = ' status != "deleted" AND email = "'.$this->input->post('email').'" AND company_id != '.$this->uri->segment(1);
            }
            $select = 'company_id';
            $count = $this->common_model->get_data('company_details','', '', $select,$where,'', $count = true);
            if($count){
                return false;
            }else { return true; }
        }
        
        public function mobile_unique(){
            $where = ' status != "deleted" AND contact_person_number = "'.$this->input->post('contact_number').'"'; 
            if($this->uri->segment(2)<>'' && $this->uri->segment(2)=='edit-client'){
                $where = ' status != "deleted" AND contact_person_number = "'.$this->input->post('contact_number').'" AND company_id != '.$this->uri->segment(1);
            }
            $select = 'company_id';                   
            $count = $this->common_model->get_data('company_details','', '', $select,$where,'', $count = true);
            if($count){
                return false;
            }else { return true; }
        }
    
    public function clients(){
        $allowed_users = ['1','3','5'];
        if(!in_array($this->session->userdata('type'),$allowed_users)){
            $this->session->set_flashdata('msg','<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $name = $this->input->get('name');
        $agent = $this->input->get('agent');
        $contact = $this->input->get('contact');
        $email = $this->input->get('email');
        $city = $this->input->get('city');
        $state = $this->input->get('state');
        $country = $this->input->get('country');
        $designation = $this->input->get('designation');

        $result_cnt = $this->company_model->count_all_company();
        $search = explode('&per_page',$this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'clients?'.$search[0];
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
        $data['company'] = $this->company_model->all_company_enquiry($config["per_page"],$offset);
        
        $data['company_details'] = $this->company_model->company_details_data();
        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
 
        $this->load->view('admin/all_client',$data);        
    }
		
	public function branch()
	{
		if($this->input->post('submit') == 'Submit'){
			
		$result = $this->company_model->new_branch();
		
		if($result){
		$this->session->set_flashdata('message','Added Successfully!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}else{
		$this->session->set_flashdata('message','Error!');	
		redirect($_SERVER['HTTP_REFERER']);			
		}
		}
		$data['company'] = $this->company_model->company_name();
		$data['countries'] = $this->company_model->all_countries();	
		$this->load->view('admin/branch',$data);
	}	
	
    public function delete_client(){        
        $result = $this->company_model->delete_client();    
        if($result){
            $this->session->set_flashdata('message','<div class="alert alert-success">Deleted Successfully!</div>');	
            redirect($_SERVER['HTTP_REFERER']);			
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger">Error! Try Again!</div>');	
            redirect($_SERVER['HTTP_REFERER']);			
        }    
    }

    public function get_sales(){
        $company = $this->input->post('company');
        $where = 'company_details.status = "active" AND company_details.company = "'.$company.'" '; 
        $select = 'company_details.state';
        $company_data = $this->common_model->get_data('company_details','', '', $select,$where,'', $count = false)[0];
        
        $query = 'SELECT * FROM admin WHERE FIND_IN_SET("'.trim($company_data->state).'",admin.region) AND admin.type=5';
        $data['sales_team'] = $this->common_model->custom_query($query);
        
        echo json_encode(['response'=>'s','details'=>$data,'msg'=>'']);
    }
    
    public function excel_download()
    {
        $this->db->select('company.name, company.company_logo, company_details.*');
        $this->db->select('COUNT(company_details.company) as totalRows');
        $this->db->join('company', 'company.company_id = company_details.company', 'left');
        $this->db->where('company.is_deleted !=', '1');
        $this->db->where('company_details.status', 'active');

        if ($this->input->get('country') <> '') {
            $country = strtolower(urldecode($this->input->get('country')));
            $this->db->where('LOWER(company_details.country)', $country);
        }
        if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',',$state);
            $arr = array_map('trim', $arr);
            if(end($arr) == ''){ unset($arr[count($arr)-1]); }
            $this->db->where_in('LOWER(company_details.state)', $arr);
        }
        if (array_key_exists('city',$this->input->get()) && $this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',',$city);
            $arr = array_map('trim', $arr);
            if(end($arr) == ''){ unset($arr[count($arr)-1]); }
            $this->db->where_in('LOWER(company_details.city)', $arr);
        }
        if ($this->input->get('company_id') <> '') {
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }
        if ($this->input->get('agent') <> '') {
            $agent = urldecode($this->input->get('agent'));
            $this->db->where('company_details.contact_person', $agent);
        }
        if ($this->input->get('email') <> '') {
            $email = urldecode($this->input->get('email'));
            $this->db->where('company_details.email', $email);
        }

        $this->db->group_by('company_details.company');
        $this->db->order_by('company_details.company_id', 'DESC');

        $query = $this->db->get('company_details');
        $result = $query->result();

        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();
        
        $objPHPExcel->setActiveSheetIndex(0);
        

        //$objPHPExcel->getProperties()->setTitle('Candidate Details Reports '.date('Y-m-d'))->setDescription('Candidate Details Reports '.date('Y-m-d'));

        $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S. No.');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Company Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Total Agents');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Agent');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Contact Number');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Email');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'State');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Designation');

        $row = 2;
        $sr = 1;
        if (isset($result[0])) {
            foreach ($result as $val) {

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sr);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $val->name);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $val->totalRows);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $val->contact_person);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $val->contact_person_number);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $val->email);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, ucwords(strtolower($val->city)));
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, ucwords(strtolower($val->state)));
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, ucwords(strtolower($val->country)));
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, date('d-M-Y', strtotime($val->creation_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, ucwords(strtolower($val->designation)));
                $row++;
                $sr++;
            }
        }

        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . 'All-Clients_' . date('d-m-Y') . '.xlsx' . '"'); 
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }
	
}
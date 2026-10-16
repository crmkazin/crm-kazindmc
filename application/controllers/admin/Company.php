<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        check_delete();

        $this->load->model(['admin/enquiry_model', 'common_model', 'admin/company_model', 'admin/user_model', 'admin/dashboard_model']);
        $this->load->library('pagination');
    }

    public function get_country_ajax()
    {
        // POST data
        $postData = $this->input->post();
        // get data
        $data = $this->company_model->get_country_ajax($postData);
        echo json_encode($data);
    }

    public function get_country_ajax_new()
    {
        // POST data
        $postData = $this->input->post();
        // get data
        $data = $this->company_model->get_country_ajax_new($postData);
        echo json_encode($data);
    }

    public function get_state_ajax()
    {
        $postData = $this->input->post();
        $data = $this->company_model->get_state_ajax($postData);
        echo json_encode($data);
    }

    public function get_city_ajax()
    {
        $postData = $this->input->post();
        $data = $this->company_model->get_city_ajax($postData);
        echo json_encode($data);
    }

    public function get_branch_ajax()
    {
        $this->company_model->get_branch_ajax();
    }

    public function branch_detail_ajax()
    {
        $this->company_model->branch_detail_ajax();
    }

    public function company_name_suggesstion()
    {
        // POST data
        $postData = $this->input->post();

        // get data
        $data = $this->company_model->company_name_suggesstion($postData);

        echo json_encode($data);
    }

    public function enquiry_suggesstion()
    {

        $postData = $this->input->post();
        $data = $this->company_model->enquiry_suggesstion($postData);

        echo json_encode($data);
    }

    public function index()
    {
        log_user_activity('Database Add',$this->session->userdata('id'), 'Database: Add ');
        // $allowed_users = ['1', '3', '5'];
        // if (!in_array($this->session->userdata('type'), $allowed_users)) {
        //     $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
        //     redirect('dashboard');
        // }
        
        $allowed_users = ['1', '3', '5'];
        $allowed_user_emails = ['bo.geo@kazindmc.com', 'dev@thavertech.com','uz.backoffice@kazindmc.com'];
        $user_type  = $this->session->userdata('type');
        $user_email = $this->session->userdata('email');

        // If not in allowed types AND not in allowed emails → deny
        if (!in_array($user_type, $allowed_users) && !in_array($user_email, $allowed_user_emails)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
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
            $select = 'admin.*';
            $where = 'type IN (5,6) AND status = 1';
            $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
            $data['content'] = 'admin/company';
            $this->load->view('admin/layout', $data);
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
                log_user_activity('Database Add New Company',$this->session->userdata('id'), 'Database: Add New Company ');
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                redirect('clients');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error!</div>');
                redirect('clients');
            }
        }
    }

    public function email_unique()
    {
        $where = ' status != "deleted" AND email = "' . $this->input->post('email') . '"';
        if ($this->uri->segment(2) <> '' && $this->uri->segment(2) == 'edit-client') {
            $where = ' status != "deleted" AND email = "' . $this->input->post('email') . '" AND company_id != ' . $this->uri->segment(1);
        }
        $select = 'company_id';
        $count = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = true);
        if ($count) {
            return false;
        } else {
            return true;
        }
    }

    public function mobile_unique()
    {
        $where = ' status != "deleted" AND contact_person_number = "' . $this->input->post('contact_number') . '"';
        if ($this->uri->segment(2) <> '' && $this->uri->segment(2) == 'edit-client') {
            $where = ' status != "deleted" AND contact_person_number = "' . $this->input->post('contact_number') . '" AND company_id != ' . $this->uri->segment(1);
        }
        $select = 'company_id';
        $count = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = true);
        if ($count) {
            return false;
        } else {
            return true;
        }
    }

    public function clients()
    {
        $allowed_users = ['1', '2','3', '5','6'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Database: Error',$this->session->userdata('id'), 'Error: (Not Allowed. Permission Denied!)');
            redirect('dashboard');
        }
        if($this->input->get('submit') <>'')
        {
            $search_data = [
                'country'        => $this->input->get('country'),
                'state'          => $this->input->get('state'),
                'city'           => $this->input->get('city'),
                'company_id'     => $this->input->get('company_id'),
                'agent'          => $this->input->get('agent'),
                'email'          => $this->input->get('email'),
                'mobile'         => $this->input->get('mobile'),
                'year'           => $this->input->get('year'),
                'months'         => $this->input->get('months'),
                'enquiry_status' => $this->input->get('enquiry_status'),
                'acquiring_source' => $this->input->get('acquiring_source'),
                'exhibition_source' => $this->input->get('exhibition'),
                'road_show'         => $this->input->get('road_show'),
                'sales'             => $this->input->get('sales'),
                'pincode' => $this->input->get('pincode'),
                'from'             => $this->input->get('from'),
                'to'               => $this->input->get('to') 

            ];
            log_user_activity('Database Search',$this->session->userdata('id'), 'Search: '. json_encode($search_data));
        }
        else
        {
            if ($this->session->userdata('type') == '2') {
                log_user_activity('Database View', $this->session->userdata('id'), 'View: Default company list with no filters.');
            }
        }
        
        $qry = $this->company_model->all_company_enquiry();
		$result_qry = 'SELECT t.* FROM ('.$qry.') AS t';
// 		if ($this->session->userdata('type') == '2' && $this->input->get('submit ') == '') {
//             $result_qry .= ' WHERE t.enquiry_status = "open"'; 
//         }
// 		if($this->input->get('enquiry_status')<>''){
// 			$result_qry .= ' WHERE t.enquiry_status = "'.$this->input->get('enquiry_status').'"';
// 		}
        $conditions = [];

        // if ($this->session->userdata('type') == '2' && $this->input->get('submit') == '') {
        //     $conditions[] = 't.enquiry_status = "cancel"';
        // }
        $userType  = $this->session->userdata('type');
        $userEmail = strtolower($this->session->userdata('email'));

        $allowedEmails = [
            'uz.backoffice@kazindmc.com',
            'bo.geo@kazindmc.com'
        ];

        if (
            $userType == '2' &&
            $this->input->get('submit') == '' &&
            !in_array($userEmail, $allowedEmails)
        ) {
            $conditions[] = 't.enquiry_status = "cancel"';
        }
        if ($this->input->get('enquiry_status') != '') {
            $conditions[] = 't.enquiry_status = "'.$this->input->get('enquiry_status').'"';
        }
        if (!empty($conditions)) {
            $result_qry .= ' WHERE ' . implode(' AND ', $conditions);
        }
        
		$result_cnt = $this->db->query($result_qry);
		
        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'clients?' . $search[0];
        $config["total_rows"] = $result_cnt->num_rows();
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
		
		$result_qry .= ' LIMIT '.$config["per_page"].' OFFSET '.$offset;
		//echo $result_qry;exit;
		$data['company'] = $this->db->query($result_qry)->result();
		$select = 'admin.*';
        $where = 'type IN (5,6) AND status = 1';
        $data['sales_team'] = $this->common_model->get_data('admin', '', '', $select, $where, '', $count = false);
        //$data['company'] = $this->company_model->all_company_enquiry($config["per_page"], $offset);

        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt->num_rows();
        log_user_activity('Database View',$this->session->userdata('id'), 'Database: View');
        $data['content'] = 'admin/all_client';
        $this->load->view('admin/layout', $data);
    }

    public function all_company_data()
    {
        log_user_activity('Database All Company Details',$this->session->userdata('id'), 'Database: All Company Details');

        $company_id = $this->uri->segment(1);

        $this->db->where('company_details.status', 'active');
        $this->db->select('company_details.*');
        $this->db->where('company_details.company', $company_id);
        $this->db->order_by('company_details.company_id', 'DESC');

        $query = $this->db->get('company_details');

        $data['company_details'] = $query->result();
        $data['content'] = 'admin/all_company_data';
        $this->load->view('admin/layout', $data);
    }

    public function company_all_details()
    {
        $company_id = $this->uri->segment(1);

        $this->db->where('company_details.status', 'active');
        $this->db->select('company_details.*');
        $this->db->where('company_details.company', $company_id);
        $this->db->order_by('company_details.company_id', 'DESC');

        $query = $this->db->get('company_details');

        $data['company_details'] = $query->result();
        $data['content'] = 'admin/company_all_details';
        log_user_activity('Database Merge Address',$this->session->userdata('id'), 'Database: Merge Address: Company All Details');
        $this->load->view('admin/layout', $data);
    }

    public function branch()
    {
        if ($this->input->post('submit') == 'Submit') {

            $result = $this->company_model->new_branch();

            if ($result) {
                $this->session->set_flashdata('message', 'Added Successfully!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('message', 'Error!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $data['company'] = $this->company_model->company_name();
        $data['countries'] = $this->company_model->all_countries();
        $data['content'] = 'admin/branch';
        $this->load->view('admin/layout', $data);
    }

    public function delete_client()
    {
       
        $where = ' enquiry.company_details_id = '.$this->uri->segment(1);
        $enquiries = $this->common_model->get_data('enquiry', '', '', '*', $where, '', $count = true);
        if($enquiries){
            log_user_activity('Database Agents Details Not Delete',$this->session->userdata('id'), 'Enquiries Found. Agent cannot be deleted.');
            $this->session->set_flashdata('message','<div class="alert alert-danger">Enquiries Found. Agent cannot be deleted.</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        $result = $this->company_model->delete_client();
        if ($result) {
            log_user_activity('Database Agents Details Delete',$this->session->userdata('id'), 'Database: All Company Details :Deleted');
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            log_user_activity('Database Agents Details Not Delete',$this->session->userdata('id'), 'Database: All Company Details : Deleted(Error! Try Again!)');
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Try Again!</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

public function get_sales()
{
    $company = $this->db->escape($this->input->post('company'));
    $where = 'company_details.status = "active" AND company_details.company = ' . $company;
    $rows = $this->common_model->get_data('company_details', '', '', 'company_details.state,company_details.country', $where, '', false);
    if (empty($rows)) {
        echo json_encode(['response' => 'e', 'details' => [], 'msg' => 'Company not found']);
        return;
    }
    $company_data = $rows[0];

    $state = trim($company_data->state);
    if (strtolower(trim($company_data->country)) != 'india') {
        $state = trim($company_data->country);
    }
    $st = $this->db->escape($state);

    // region me spaces ho to bhi match ho
    $regionMatch = 'FIND_IN_SET(' . $st . ', REPLACE(admin.region, " ", ""))';
    // agar state me space hai (Uttar Pradesh), to dono side se space hatao:
    $regionMatch = 'FIND_IN_SET(REPLACE(' . $st . ', " ", ""), REPLACE(admin.region, " ", ""))';

    $qry  = 'SELECT admin.id, admin.name, admin.contact_number, department_heads.admin_id, department_heads.head_admin_id FROM admin ';
    $qry .= 'JOIN department_heads ON (department_heads.admin_id = admin.id AND department_heads.status="active") ';
    $qry .= 'WHERE ' . $regionMatch . ' AND admin.type = 5 AND admin.status = 1';
    $qry_result = $this->common_model->custom_query($qry);

    $admin_ids = [];
    $sales_team = [];
    foreach ($qry_result as $list) {
        $admin_ids[] = (int)$list->admin_id;
        if (!empty($list->head_admin_id)) {
            $admin_ids[] = (int)$list->head_admin_id;
        }
        $sales_team[] = ['id' => $list->id, 'name' => $list->name, 'number' => $list->contact_number];
    }

    $query = 'SELECT admin.id, admin.name, admin.contact_number FROM admin WHERE ' . $regionMatch . ' AND admin.type IN (5,6) AND admin.status = 1';
    if (!empty($admin_ids)) {
        $query .= ' AND admin.id NOT IN (' . implode(',', array_unique($admin_ids)) . ')';
    }
    $query_result = $this->common_model->custom_query($query);
    foreach ($query_result as $list) {
        $sales_team[] = ['id' => $list->id, 'name' => $list->name, 'number' => $list->contact_number];
    }

    echo json_encode(['response' => 's', 'details' => ['sales_team' => $sales_team], 'msg' => '']);
}

    public function excel_download()
    {
        /*$this->db->select('company.name, company.company_logo, company_details.*');
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
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $this->db->where_in('LOWER(company_details.state)', $arr);
        }
        if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
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
        $result = $query->result();*/
        log_user_activity('Database Excel Download',$this->session->userdata('id'), 'Database: Excel Downloaded');

		$qry = $this->company_model->all_company_enquiry();
		$result_qry = 'SELECT t.* FROM ('.$qry.') AS t';
		if($this->input->get('enquiry_status')<>''){
			$result_qry .= ' WHERE t.enquiry_status = "'.$this->input->get('enquiry_status').'"';
		}
		$result = $this->db->query($result_qry)->result();
		
		//echo '<pre>';print_r($result);exit;
		
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
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Pincode');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Address');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'City');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'State');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Country');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Designation');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Acquiring Source');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Exhibition Source');
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
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, ucwords(strtolower($val->pincode)));
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $val->address.(($val->address_2<>'')?', '.$val->address_2:''));
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, ucwords(strtolower($val->city)));
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, ucwords(strtolower($val->state)));
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, ucwords(strtolower($val->country)));
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, date('d-M-Y', strtotime($val->creation_date)));
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, ucwords(strtolower($val->designation)));
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, ucwords(strtolower($val->acquiring_source)));
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, ucwords(strtolower($val->exhibition_source)));
                $row++;
                $sr++;
            }
        }
		
		$enquiry_status = ($this->input->get('enquiry_status')<>'')?$this->input->get('enquiry_status').'_':'';
		
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . 'All-Clients_'.$enquiry_status. date('d-m-Y') . '.xls' . '"');
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

    public function merge()
    {
        $allowed_users = ['1', '3'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Database Merge Address Error',$this->session->userdata('id'), 'Database: Merge Address (Not Allowed. Permission Denied!)');
            redirect('dashboard');
        }

        $result_cnt = $this->company_model->count_all_companies();
        $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
        $config = array();
        $config["base_url"] = base_url() . 'merge-address?' . $search[0];
        $config["total_rows"] = $result_cnt;
        $config["per_page"] = 20000;
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
        $data['company'] = $this->company_model->all_company_enquiries($config["per_page"], $offset);

        $data['links'] = $this->pagination->create_links();
        $data['total'] = $result_cnt;
        log_user_activity('Database Merge Address',$this->session->userdata('id'), 'Database: Merge Address');
        $data['content'] = 'admin/merge_address';
        $this->load->view('admin/layout', $data);
    }

    public function merge_same_address()
    {
        if ($this->session->userdata('type') == 3) {
            redirect('clients');
        }

        if (empty($this->input->post('ids'))) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Please Select Any Other Address.</div>');
            log_user_activity('Merge Address Update Error',$this->session->userdata('id'), 'Database Merge Address (Please Select Any Other Address.)');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = array(
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),
            'address_2' => $this->input->post('address_2'),
            'address_3' => $this->input->post('address_3'),
            'pincode' => $this->input->post('pincode'),
            'gstin' => $this->input->post('gst'),
        );

        $this->db->where('company_id', $this->input->post('ids'));
        $this->db->update('company', $data);
        $merge = $this->db->affected_rows();


        if ($merge > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            log_user_activity('Database Merge Address Update',$this->session->userdata('id'), ' Merge Address: '. json_encode($data));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! You have not changed anything!</div>');
            log_user_activity('Database Merge Address Error',$this->session->userdata('id'), ' Merge Address (Error! You have not changed anything!)');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }
    
    // 8 Sep 2026
    
    public function merge_companies()
{
    $allowed_users = ['1'];
    $allowed_users_emails = ['bo.geo@kazindmc.com'];
    if (!in_array($this->session->userdata('type'), $allowed_users) && !in_array($this->session->userdata('email'), $allowed_users_emails)) {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
        log_user_activity('Database Merge Companies Error', $this->session->userdata('id'), ' Merge Companies (Not Allowed. Permission Denied!)');
        redirect('dashboard');
    }

    $this->form_validation->set_rules('main_company_id', 'Main Company', 'trim|required');
    $this->form_validation->set_rules('companies_merger[]', 'Merging Company', 'trim|required');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    if ($this->form_validation->run() == FALSE) {
        log_user_activity('Merge Companies View', $this->session->userdata('id'), ' Database: Merge Companies: View');
        $data['content'] = 'admin/merge_companies';
        $this->load->view('admin/layout', $data);
        return;
    }

    $company_merger_arr = $this->input->post('companies_merger');
    $main_company_id    = $this->input->post('main_company_id');

    // Prevent merging a company into itself
    if (in_array($main_company_id, $company_merger_arr)) {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">A company cannot be merged into itself.</div>');
        redirect($_SERVER['HTTP_REFERER'] ?? 'dashboard');
        return;
    }

    $this->db->trans_start();

    // Safe, parameterized IN clause
    $placeholders = implode(',', array_fill(0, count($company_merger_arr), '?'));

    $sql_company_details = 'UPDATE `company_details`
        SET company_details.previous_company = company_details.company,
            company_details.company = ?
        WHERE company_details.company IN (' . $placeholders . ')';
    $this->db->query($sql_company_details, array_merge([$main_company_id], $company_merger_arr));

    $sql_company = 'UPDATE `company`
        SET is_deleted = "1",
            company.main_company_id = ?,
            company.merge_status = "yes",
            company.modified = ?
        WHERE company.company_id IN (' . $placeholders . ')';
    $this->db->query($sql_company, array_merge([$main_company_id, date('Y-m-d H:i:s')], $company_merger_arr));

    $merged_log = [];

    foreach ($company_merger_arr as $list) {
        $where = ['enquiry.company_id' => $list]; // use array binding instead of a raw string
        $enquiries = $this->common_model->get_data('enquiry', '', '', '*', $where, '', $count = false);

        foreach ($enquiries as $enq) {
            $insert_arr = [
                'enquiry_id'         => $enq->id,
                'previous_company_id'=> $list,
                'main_company_id'    => $main_company_id,
                'admin_id'           => $this->session->userdata('id'),
                'created'            => date('Y-m-d H:i:s'),
            ];
            $id = $this->common_model->insert_data(['table_name' => 'enquiry_company_update_logs', 'insert_data' => $insert_arr]);

            if ($id) {
                $update_arr  = ['company_id' => $main_company_id];
                $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                $this->common_model->update_data_limit($update_data);
                $merged_log[] = $insert_arr;
            }
        }
    }

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">Merge failed. No changes were saved.</div>');
        log_user_activity('Database Merge Companies Error', $this->session->userdata('id'), ' Merge Companies (Transaction failed)');
    } else {
        $this->session->set_flashdata('message', '<div class="alert alert-success">Companies Merged Successfully.</div>');
        log_user_activity('Database Companies Merged', $this->session->userdata('id'), 'Merged Companies: ' . json_encode($merged_log));
    }

    redirect($_SERVER['HTTP_REFERER'] ?? 'dashboard');
}

///
    
    
    public function merge_companies_OLD()
    {
         $allowed_users = ['1'];
        $allowed_users_emails = ['bo.geo@kazindmc.com'];
        if (!in_array($this->session->userdata('type'), $allowed_users) && !in_array($this->session->userdata('email'), $allowed_users_emails)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Database Merge Companies Error',$this->session->userdata('id'), ' Merge Companies (Not Allowed. Permission Denied!)');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('main_company_id', 'Main Company', 'trim|required');
        $this->form_validation->set_rules('companies_merger[]', 'Merging Company', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Merge Companies View',$this->session->userdata('id'), ' Database: Merge Companies: View');
            $data['content'] = 'admin/merge_companies';
            $this->load->view('admin/layout',$data);
        } else {
            //echo '<pre>';print_r($this->input->post());exit;
            $company_merger_arr = $this->input->post('companies_merger');
            $main_company_id = $this->input->post('main_company_id');
            $company_merger = implode('","',$company_merger_arr);
            
            $sql_company_details = 'UPDATE `company_details` SET company_details.previous_company = company_details.company, company_details.company="'.$main_company_id.'" WHERE company_details.company IN("'.$company_merger.'")';
            $this->db->query($sql_company_details);
            
            $sql_company = 'UPDATE `company` SET is_deleted="1", company.main_company_id = "'.$main_company_id.'", company.merge_status="yes", company.modified = "'.date('Y-m-d H:i:s').'" WHERE company.company_id IN("'.$company_merger.'")';
            $this->db->query($sql_company);
            
            foreach($company_merger_arr AS $list){
                $where = ' enquiry.company_id = "' .$list.'"';
                $enquiries = $this->common_model->get_data('enquiry', '', '', '*', $where, '', $count = false);
                foreach($enquiries AS $enq){
                    $insert_arr = ['enquiry_id'=>$enq->id,'previous_company_id'=>$list,'main_company_id'=>$main_company_id,
                                    'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
                    $id = $this->common_model->insert_data(['table_name' => 'enquiry_company_update_logs', 'insert_data' => $insert_arr]);
                    if($id){
                        $update_arr = ['company_id' => $main_company_id];
                        $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                        $this->common_model->update_data_limit($update_data);
                    }
                }
            }
            $this->session->set_flashdata('message','<div class="alert alert-success">Companies Merged Successfully.</div>');
            log_user_activity('Database Companies Merged',$this->session->userdata('id'), 'Merged Companies:'. json_encode($insert_arr));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function company_names_merge(){
        //echo '<pre>';print_r($this->input->post());exit;
        $main_company_id[] = $this->input->post('main_company_id');
        $company_ids = array_merge($main_company_id, (!empty($this->input->post('companies_merger')))?$this->input->post('companies_merger'):[]);
        
        $response = array();
        $this->db->select('*');
        if(!empty($this->input->post('search'))) {
            $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('is_deleted !=', '1');
            $this->db->where_not_in('company_id', $company_ids);
            $this->db->limit(10);
            $records = $this->db->get('company')->result();
            foreach ($records as $row) {
                $response[] = array("company_id" => $row->company_id, "label" => trim($row->name));
            }
        }
        echo json_encode($response);
    }
    
    public function get_merged_companies(){
        //echo '<pre>';print_r($this->input->post());exit;
        $main_company_id = $this->input->post('revoke_main_company_id');
        $where = 'company.main_company_id = "'.$main_company_id.'"';
        $select = 'company.*';
        $data['merged_companies'] = $this->common_model->get_data('company', '', '', $select, $where, '', $count = false);
        echo json_encode($data);
    }
    
    public function revoke_merged_company(){
        
        $this->form_validation->set_rules('company_id', 'Company To Revoke', 'trim|required');
        $this->form_validation->set_rules('revoke_main_company_id', 'Main Company To Revoke', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            log_user_activity('Database Companies Rollbacked',$this->session->userdata('id'), 'Error :'. validation_errors());
            exit;
        }
        $company_revoke_id = $this->input->post('company_id');
        $revoke_main_company_id = $this->input->post('revoke_main_company_id');
        
        $where = 'enquiry_company_update_logs.status = "active" AND enquiry_company_update_logs.previous_company_id = "' . $company_revoke_id . '" ';
        $select = '*';
        $company_data = $this->common_model->get_data('enquiry_company_update_logs', '', '', $select, $where, '', $count = false);
        //echo '<pre>';print_r($company_data);exit;
        
        $sql_company_details = 'UPDATE `company_details` SET company_details.previous_company = "0", company_details.company="'.$company_revoke_id.'" WHERE company_details.previous_company =  "'.$company_revoke_id.'"';
        $this->db->query($sql_company_details);
        
        $sql_logs = 'UPDATE `enquiry_company_update_logs` SET enquiry_company_update_logs.status = "rollback", enquiry_company_update_logs.modified="'.date('Y-m-d H:i:s').'", enquiry_company_update_logs.rollback_admin_id = '.$this->session->userdata('id').' WHERE enquiry_company_update_logs.main_company_id = "'.$revoke_main_company_id.'" AND enquiry_company_update_logs.previous_company_id = "'.$company_revoke_id.'" AND enquiry_company_update_logs.status="active"';
        $this->db->query($sql_logs);
        
        $sql_company = 'UPDATE `company` SET is_deleted="0", company.main_company_id = "0", company.merge_status="no", company.modified = "'.date('Y-m-d H:i:s').'" WHERE company.company_id = "'.$company_revoke_id.'"';
        $this->db->query($sql_company);
        
        if(!empty($company_data)){
            $enquiry_ids = [];
            foreach($company_data AS $list){
                $enquiry_ids[] = $list->enquiry_id;
            }
            $enquiries = implode(',',$enquiry_ids);
            $sql_enquiry = 'UPDATE `enquiry` SET enquiry.company_id = "'.$company_revoke_id .'" WHERE enquiry.id IN('.$enquiries.')';
            $this->db->query($sql_enquiry);
        }
        $insert_arr=['company_revoke_id'=>$company_revoke_id,'revoke_main_company_id'=>$revoke_main_company_id];
        echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Company rollbacked successfully!</div>']);
        log_user_activity('Database Companies Rollbacked',$this->session->userdata('id'), 'Rollbacked Companies:'. json_encode($insert_arr));
        exit;
    }
    
    // ******************************** Agents Merge *********************************
    
    public function agent_name_suggesstion()
    {
        $company_id = trim($this->input->post('company_id'));
        $search = trim($this->input->post('search'));
        $where = 'company_details.company = "'.$company_id.'" AND company_details.status="active"';
        $where .= ' AND company_details.contact_person LIKE "%'.$search.'%"';
        $select = 'company_details.contact_person AS label,company_details.company_id';
        $data['agents'] = $this->common_model->get_data('company_details', '', '', $select, $where, ' LIMIT 10 ', $count = false);
        
        echo json_encode($data['agents']);
    }
    
    public function agent_names_merge(){
        //echo '<pre>';print_r($this->input->post());exit;
        $main_agent_id[] = $this->input->post('main_agent_id');
        $agent_ids = array_merge($main_agent_id, (!empty($this->input->post('agents_merger')))?$this->input->post('agents_merger'):[]);
        
        $response = array();
        $this->db->select('*');
        if(!empty($this->input->post('search'))) {
            $this->db->where("contact_person like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('status', 'active');
            $this->db->where('company', trim($this->input->post('company_id')));
            $this->db->where_not_in('company_id', $agent_ids);
            $this->db->limit(10);
            $records = $this->db->get('company_details')->result();
            foreach ($records as $row) {
                $response[] = array("company_id" => $row->company_id, "label" => trim($row->contact_person));
            }
        }
        echo json_encode($response);
    }
    
    public function merge_agents()
    {
        $allowed_users = ['1'];
        $allowed_users_emails = ['bo.geo@kazindmc.com'];
        if (!in_array($this->session->userdata('type'), $allowed_users) && !in_array($this->session->userdata('email'), $allowed_users_emails)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Database Merge Agent ',$this->session->userdata('id'), 'Error: (Not Allowed. Permission Denied!)');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('main_agent_id', 'Main Agent', 'trim|required');
        $this->form_validation->set_rules('agents_merger[]', 'Merging Agents', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Database Merge Agent ',$this->session->userdata('id'), 'Merge Agents: View');
            $data['content'] = 'admin/merge_agents';
            $this->load->view('admin/layout',$data);
        } else {
            //echo '<pre>';print_r($this->input->post());exit;
            $agent_merger_arr = $this->input->post('agents_merger');
            $main_agent_id = $this->input->post('main_agent_id');
            $agent_merger = implode('","',$agent_merger_arr);
            
            $sql_agent_details = 'UPDATE `company_details` SET company_details.merge_status = "yes", company_details.main_company_details_id="'.$main_agent_id.'",company_details.modified="'.date('Y-m-d H:i:s').'",company_details.status="deleted" WHERE company_details.company_id IN("'.$agent_merger.'")';
            $this->db->query($sql_agent_details);
            
            foreach($agent_merger_arr AS $list){
                $where = ' enquiry.company_details_id = "' .$list.'"';
                $enquiries = $this->common_model->get_data('enquiry', '', '', '*', $where, '', $count = false);
                foreach($enquiries AS $enq){
                    $insert_arr = ['enquiry_id'=>$enq->id,'previous_company_details_id'=>$list,'main_company_details_id'=>$main_agent_id,
                                    'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
                    $id = $this->common_model->insert_data(['table_name' => 'enquiry_company_details_update_logs', 'insert_data' => $insert_arr]);
                    if($id){
                        $update_arr = ['company_details_id' => $main_agent_id];
                        $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                        $this->common_model->update_data_limit($update_data);
                    }
                }
            }
            $this->session->set_flashdata('message','<div class="alert alert-success">Agents Merged Successfully.</div>');
            log_user_activity('Database Merged Agent ',$this->session->userdata('id'), 'Merged Agents: '.json_encode($insert_arr));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    // ***** Revoke *****
    
    public function get_merged_agents(){
        //echo '<pre>';print_r($this->input->post());exit;
        $main_company_details_id = $this->input->post('revoke_main_company_details_id');
        $where = 'company_details.main_company_details_id = "'.$main_company_details_id.'"';
        $select = 'company_details.*';
        $data['merged_agents'] = $this->common_model->get_data('company_details', '', '', $select, $where, '', $count = false);
        echo json_encode($data);
    }
    
    public function revoke_merged_agents(){
        
        $this->form_validation->set_rules('company_id', 'Agent To Revoke', 'trim|required');
        $this->form_validation->set_rules('revoke_main_company_details_id', 'Main Company To Revoke', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            log_user_activity('Database Rollbacked Agent ',$this->session->userdata('id'), 'Error: '.validation_errors());
            exit;
        }
        $company_revoke_id = $this->input->post('company_id');
        $revoke_main_company_details_id = $this->input->post('revoke_main_company_details_id');
        
        $where = 'enquiry_company_details_update_logs.status = "active" AND enquiry_company_details_update_logs.previous_company_details_id = "' . $company_revoke_id . '" ';
        $select = '*';
        $company_details_data = $this->common_model->get_data('enquiry_company_details_update_logs', '', '', $select, $where, '', $count = false);
        //echo '<pre>';print_r($company_data);exit;
        
        $sql_logs = 'UPDATE `enquiry_company_details_update_logs` SET enquiry_company_details_update_logs.status = "rollback", enquiry_company_details_update_logs.modified="'.date('Y-m-d H:i:s').'", enquiry_company_details_update_logs.rollback_admin_id = '.$this->session->userdata('id').' WHERE enquiry_company_details_update_logs.main_company_details_id = "'.$revoke_main_company_details_id.'" AND enquiry_company_details_update_logs.previous_company_details_id = "'.$company_revoke_id.'" AND enquiry_company_details_update_logs.status="active"';
        $this->db->query($sql_logs);
        
        $sql_company = 'UPDATE `company_details` SET status="active", company_details.main_company_details_id = "0", company_details.merge_status="no", company_details.modified = "'.date('Y-m-d H:i:s').'" WHERE company_details.company_id = "'.$company_revoke_id.'"';
        $this->db->query($sql_company);
        
        if(!empty($company_details_data)){
            $enquiry_ids = [];
            foreach($company_details_data AS $list){
                $enquiry_ids[] = $list->enquiry_id;
            }
            $enquiries = implode(',',$enquiry_ids);
            $sql_enquiry = 'UPDATE `enquiry` SET enquiry.company_details_id = "'.$company_revoke_id .'" WHERE enquiry.id IN('.$enquiries.')';
            $this->db->query($sql_enquiry);
        }
        $insert_arr=['company_revoke_id'=>$company_revoke_id,'revoke_main_company_details_id'=>$revoke_main_company_details_id];
        echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Agent rollbacked successfully!</div>']);
        log_user_activity('Database Rollbacked Agent ',$this->session->userdata('id'), 'Rollbacked Agents: '.json_encode($insert_arr));
        exit;
    }
    
    //************ Transfer Agents ***************
    
    public function transfer_agents()
    {
         $allowed_users = ['1'];
        $allowed_users_emails = ['bo.geo@kazindmc.com'];

        if (!in_array($this->session->userdata('type'), $allowed_users) && !in_array($this->session->userdata('email'), $allowed_users_emails)) {
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            log_user_activity('Database Transfer Agents View',$this->session->userdata('id'), 'Error:(Not Allowed. Permission Denied!)');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('main_company_id', 'Main Company', 'trim|required');
        $this->form_validation->set_rules('transfer_company_id', 'Transfer Company', 'trim|required');
        $this->form_validation->set_rules('agents_transfer[]', 'Transfer Agents', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Database Transfer Agents View',$this->session->userdata('id'), 'Database: Transfer Agents: View ');
            $data['content'] = 'admin/transfer_agents';
            $this->load->view('admin/layout',$data);
        } else {
            //echo '<pre>';print_r($this->input->post());exit;
            $agents_transfer_arr = $this->input->post('agents_transfer');
            $main_company_id = $this->input->post('main_company_id');
            $transfer_company_id = $this->input->post('transfer_company_id');
            $agents_transfer = implode('","',$agents_transfer_arr);
            
            $sql_agent_details = 'UPDATE `company_details` SET company_details.company = "'.$transfer_company_id.'" WHERE company_details.company_id IN("'.$agents_transfer.'")';
            $this->db->query($sql_agent_details);
            
            foreach($agents_transfer_arr AS $list){
                $where = ' enquiry.company_details_id = "' .$list.'"';
                $enquiries = $this->common_model->get_data('enquiry', '', '', '*', $where, '', $count = false);
                foreach($enquiries AS $enq){
                    $insert_arr = ['enquiry_id'=>$enq->id,'previous_company'=>$main_company_id,'new_company'=>$transfer_company_id,
                                    'company_details_id'=>$list,'admin_id'=>$this->session->userdata('id'),'created'=>date('Y-m-d H:i:s')];
                    $id = $this->common_model->insert_data(['table_name' => 'enquiry_agents_transfer_logs', 'insert_data' => $insert_arr]);
                    if($id){
                        $update_arr = ['company_id' => $transfer_company_id];
                        $update_data = ['table_name' => 'enquiry', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                        $this->common_model->update_data_limit($update_data);
                    }
                }
            }
            $this->session->set_flashdata('message','<div class="alert alert-success">Agents Transferred Successfully.</div>');
            log_user_activity('Database Transfered Agents ',$this->session->userdata('id'), 'Transfered Agents:  '.json_encode($insert_arr));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function agent_names_transfer(){
        //echo '<pre>';print_r($this->input->post());exit;
        $agent_ids = (!empty($this->input->post('agents_transfer')))?$this->input->post('agents_transfer'):[];
        
        $response = array();
        $this->db->select('*');
        if(!empty($this->input->post('search'))) {
            $this->db->where("contact_person like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('status', 'active');
            $this->db->where('company', trim($this->input->post('main_company_id')));
            if(!empty($agent_ids)){
                $this->db->where_not_in('company_id', $agent_ids);
            }
            $this->db->limit(10);
            $records = $this->db->get('company_details')->result();
            foreach ($records as $row) {
                $response[] = array("company_id" => $row->company_id, "label" => trim($row->contact_person));
            }
        }
        echo json_encode($response);
    }
    
    public function get_company_names(){
        //echo '<pre>';print_r($this->input->post());exit;
        $records = [];
        if($this->input->post('search')<>''){
            $search = explode(' ',$this->input->post('search'));        
            $this->db->select('company.company_id,company.name AS label');
            $this->db->where("name like '%" . trim($search[0]) . "%' ");
            $this->db->where('is_deleted !=', '1');
            $this->db->limit(15);
            $records = $this->db->get('company')->result();
        }
        echo json_encode($records);
    }
    public function time()
    {
        echo date_default_timezone_get(); 
        
    }
    
}
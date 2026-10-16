<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    var $locations = ['kazakhstan'=>['FKZ','GKZ','IKZ'],'azerbaijan'=>['FAZ','GAZ','IAZ'],'belarus'=>['FBZ','GBZ','IBZ'],'georgia'=>['FGE','GGE','IGE'],
                    'all'=>['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE']];
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
                redirect('login');
        }
        $this->load->model(['admin/dashboard_model','admin/quotation_model','common_model']);
        
    }	

    public function index()
    {
        $counts = $this->dashboard_model->enquiry_status_count();
        $data['counts'] = $counts;
        /*$sql = 'SELECT * FROM currency_value WHERE id IN(SELECT max(id) FROM `currency_value` GROUP BY currency_name) ORDER BY country';
        $data['currency_rates'] = $this->common_model->custom_query($sql);
        
        $url = 'https://openexchangerates.org/api/latest.json?app_id=4f98ba0637344efa848e5c3c6f3371b7&symbols=AZN,BYN,GEL,KZT';
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
            )
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($output);
        $data['live_currency_rates'] = $result;*/
        
        //$query = 'SELECT followups.followup_status,enquiry.enquiry_abbr FROM followups JOIN enquiry ON enquiry.id=followups.enquiry_id JOIN arrivals ON arrivals.enquiry_id=enquiry.id ';
        //$query .= 'WHERE followups.id IN ( SELECT MAX(followups.id) FROM followups ';
        //$query .= 'WHERE followups.date = "'.date('Y-m-d').'" GROUP BY followups.enquiry_id) AND followups.followup_status="confirm"';
        
        $query = 'SELECT count(arrivals.id) as cnt FROM arrivals JOIN enquiry ON enquiry.id=arrivals.enquiry_id WHERE arrivals.status="in-progress" AND date(arrivals.created) = "'.date('Y-m-d').'"';
        if ($this->session->userdata('admin_type') != 'superadmin') {
            $assigned_loc = implode('","', $this->locations[$this->session->userdata('locations')]);
            $query .=' AND enquiry.enquiry_abbr IN ("'.$assigned_loc.'")';
        }
        $result = $this->common_model->custom_query($query);
        $data['confirm_today'] = $result[0]->cnt;
        
        $this->load->view('admin/dashboard',$data);
    }
    
    public function counts_data()
    {
        $query = 'SELECT count(arrivals.id) as cnt FROM arrivals JOIN enquiry ON enquiry.id=arrivals.enquiry_id WHERE arrivals.status="in-progress" AND date(arrivals.created) = "' . date('Y-m-d') . '"';
        if ($this->session->userdata('admin_type') != 'superadmin') {
            $assigned_loc = implode('","', $this->locations[$this->session->userdata('locations')]);
            $query .= ' AND enquiry.enquiry_abbr IN ("' . $assigned_loc . '")';
        }
        $result = $this->common_model->custom_query($query);
        $count = $result[0]->cnt;
        echo json_encode(['response' => 's', 'data' => $count]);
    }

    
    public function pdf_preview(){
        $this->load->view('admin/mail_pdf_preview');
    }
    
    public function masters(){
        $counts = $this->dashboard_model->enquiry_status_count();
        $data['counts'] = $counts;
        $this->load->view('admin/masters',$data);
    }
    
}

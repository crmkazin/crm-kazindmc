<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comparisons extends CI_Controller
{

    var $locations = [
        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
        'belarus' => ['FBZ', 'GBZ', 'IBZ'],
        'georgia' => ['FGE', 'GGE', 'IGE'],
        'all' => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE']
    ];
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
             redirect('login');
        }        
        $allowed_users = ['1', '3'];

        $this->load->model(['admin/group_model', 'common_model', 'admin/user_model', 'admin/report_model', 'admin/dashboard_model', 'admin/company_model','admin/restaurantmenumaster_model']);
        $this->load->library('pagination');
    }
	
	public function index(){
		log_user_activity('Comparisons Charts View',$this->session->userdata('id'), 'Comparisons Charts: View');
		$data['content'] = 'admin/comparison_charts';
		$this->load->view('admin/layout',$data);
	}
		
	public function get_data(){
		
		$tenure = explode('-',$this->input->post('tenure'));
		$graph_type = $this->input->post('graph_type');
		switch($graph_type){
			case 'query':
				$qry1 = 'SELECT DATE_FORMAT(enquiry.query_received_date, "%m") AS month, count(enquiry.id) AS cnt FROM `enquiry` WHERE DATE_FORMAT(enquiry.query_received_date, "%Y")= '.$tenure[0].' GROUP BY DATE_FORMAT(enquiry.query_received_date, "%Y-%m")';
				$qry2 = 'SELECT DATE_FORMAT(enquiry.query_received_date, "%m") AS month, count(enquiry.id) AS cnt FROM `enquiry` WHERE DATE_FORMAT(enquiry.query_received_date, "%Y")= '.$tenure[1].' GROUP BY DATE_FORMAT(enquiry.query_received_date, "%Y-%m")';
				$data1 = $this->common_model->custom_query($qry1);
				$data2 = $this->common_model->custom_query($qry2);
				//echo '<pre>';print_r($data1);print_r($data2);
				log_user_activity('Comparisons Charts View',$this->session->userdata('id'), 'Comparisons Charts: View Query');
				break;
			case 'revenue':
				$qry1 = 'SELECT DATE_FORMAT(arrivals.created, "%m") AS month,SUM(arrivals.client_billing) AS cnt FROM arrivals WHERE arrivals.status IN ("complete","file-closed","in-progress") AND DATE_FORMAT(arrivals.created,"%Y")= '.$tenure[0].' GROUP BY DATE_FORMAT(arrivals.created, "%Y-%m")';
				$qry2 = 'SELECT DATE_FORMAT(arrivals.created, "%m") AS month,SUM(arrivals.client_billing) AS cnt FROM arrivals WHERE arrivals.status IN ("complete","file-closed","in-progress") AND DATE_FORMAT(arrivals.created,"%Y")= '.$tenure[1].' GROUP BY DATE_FORMAT(arrivals.created, "%Y-%m")';
				$data1 = $this->common_model->custom_query($qry1);
				$data2 = $this->common_model->custom_query($qry2);
				log_user_activity('Comparisons Charts View revenue',$this->session->userdata('id'), 'Comparisons Charts: View revenue');
				break;
			case 'agents':
				$qry1 = 'SELECT DATE_FORMAT(company_details.creation_date, "%m") AS month,COUNT(company_details.company_id) AS cnt FROM company_details WHERE company_details.status = "active" AND DATE_FORMAT(company_details.creation_date,"%Y") = '.$tenure[0].' GROUP BY DATE_FORMAT(company_details.creation_date, "%Y-%m")';
				$qry2 = 'SELECT DATE_FORMAT(company_details.creation_date, "%m") AS month,COUNT(company_details.company_id) AS cnt FROM company_details WHERE company_details.status = "active" AND DATE_FORMAT(company_details.creation_date,"%Y") = '.$tenure[1].' GROUP BY DATE_FORMAT(company_details.creation_date, "%Y-%m")';
				$data1 = $this->common_model->custom_query($qry1);
				$data2 = $this->common_model->custom_query($qry2);
				log_user_activity('Comparisons Charts View Agents',$this->session->userdata('id'), 'Comparisons Charts: View Agents');
				break;
		}	
		$response = $d1 = $d2 = [];
		for($i=1;$i<=12;$i++){
			$key1 = array_search($i, array_column($data1, 'month'));
			if($key1 !== false){
				$d1[$i] = $data1[$key1]->cnt;
			}else{ $d1[$i] = '0'; }
			
			$key2 = array_search($i, array_column($data2, 'month'));
			if($key2 !== false){
				$d2[$i] = $data2[$key2]->cnt;
			}else{ $d2[$i] = '0'; }
		}
		$response = ['label1'=>$tenure[0],'label2'=>$tenure[1],'data1'=>$d1,'data2'=>$d2];
		echo json_encode(['response'=>'s','details'=>$response, 'msg'=> '']);
        exit;
	}

}
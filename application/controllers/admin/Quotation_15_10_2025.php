<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'sendinblue/vendor/autoload.php';
class Quotation extends CI_Controller {
    
    var $locations = LOCATIONS;
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        check_delete();
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $this->load->library(['pagination','upload']);
    }		

    // ************************************* 11 Dec 2024 ************************************
	public function fetch_suggesstions(){
        //echo '<pre>';print_r($this->input->post());exit;
        $capacity = $this->input->post('capacity');
        $char = substr($this->input->post('enquiry_num'), 1, 2);
	    $enquiry_id = base64_decode($this->input->post('enquiry_id'));
	    $transport_id ='8';
        
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $prefilled_city = ['azerbaijan'=>'Baku','belarus'=>'Minsk','georgia'=>'Tbilisi','kazakhstan'=>'Almaty'];
        $data['prefilled_city'] = $prefilled_city[$country[$char]];
        if($prefilled_city[$country[$char]] <>''){
            $where = ' transportation.status = "active" AND LOWER(transportation.city) = "'.strtolower($prefilled_city[$country[$char]]).'"';
        }else{
            $where = ' transportation.status = "active" AND LOWER(transportation.country) = "'.$country[$char].'"';
        }
        $where .= ' AND (transportation.capacity >='.$capacity.' AND transportation.capacity <='.($capacity+1).')';
        $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, ' LIMIT 1', $count = false);

        $join = [
            [
                'type' => 'LEFT',
                'join_table' => 'location_masters',
                'condition' => 'location_masters.id = sites.location_ids'
            ],
            [
                'type' => 'LEFT',
                'join_table' => 'outsidecity_transportation_costs',
                'condition' => 'outsidecity_transportation_costs.sites_id = sites.id'
            ]
        ];

        $type = 'sitescene';
        $select = 'sites.id, sites.site_name, sites.days_of_operation, sites.entry_ticket_fee, sites.child_entry_ticket_fee, 
                sites.duration, sites.departing_time_from_hotel, sites.duration_hours, sites.duration_minutes, outsidecity_transportation_costs.est_hour';

        $base_where = 'sites.status = "active" 
                    AND sites.category = "' . $type . '" 
                    AND LOWER(sites.country) = "' . strtolower($country[$char]) . '" 
                    AND LOWER(sites.city) = "' . strtolower($prefilled_city[$country[$char]]) . '" 
                    AND outsidecity_transportation_costs.transport_id = "' . (int)$transport_id . '"';

        $where_outsidecity = $base_where . ' AND location_masters.destination_type = "outsidecity"';
        $data['sites_outsidecity'] = $this->common_model->get_data('sites', '', '', $select, $where_outsidecity, '', false, $join);

        $select_inside = 'sites.id, sites.site_name, sites.days_of_operation, sites.entry_ticket_fee, sites.child_entry_ticket_fee, 
                sites.duration, sites.departing_time_from_hotel, sites.duration_hours, sites.duration_minutes';
        $base_where_inside = 'sites.status = "active" 
            AND sites.category = "' . $type . '" 
            AND LOWER(sites.country) = "' . strtolower($country[$char]) . '" 
            AND LOWER(sites.city) = "' . strtolower($prefilled_city[$country[$char]]) . '"';
        $where_insidecity = $base_where_inside . ' AND sites.location_ids = "0"';
        $insidecity_join ='';
        $data['sites_insidecity'] = $this->common_model->get_data('sites', '', '', $select_inside, $where_insidecity, '', false, $insidecity_join);

        $where = 'currency_value.country ="'.strtolower($country[$char]).'" AND currency_value.status = "active"';
        $data['currency'] = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];
        
        $where = 'auxiliary_miscellaneous.country ="'.strtolower($country[$char]).'" AND auxiliary_miscellaneous.status="active"';
        $data['mandatory_services'] = $this->common_model->get_data('auxiliary_miscellaneous','', '', '*',$where, '', $count = false);
        
        $where = 'auxiliary_transportation.country ="'.strtolower($country[$char]).'" AND auxiliary_transportation.status="active"';
        $data['luggage_vehicle'] = $this->common_model->get_data('auxiliary_transportation','', '', '*',$where, ' LIMIT 1 ', $count = false);
        
        $where = 'quotations.enquiry_id = '.$enquiry_id;
        $data['quotations'] = $this->common_model->get_data('quotations','', '', 'quotations.id',$where, '', $count = false);
        
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    }
    // public function fetch_suggesstions(){
    //     //echo '<pre>';print_r($this->input->post());exit;
    //     $capacity = $this->input->post('capacity');
    //     $char = substr($this->input->post('enquiry_num'), 1, 2);
	   // $enquiry_id = base64_decode($this->input->post('enquiry_id'));
        
    //     $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
    //     $prefilled_city = ['azerbaijan'=>'Baku','belarus'=>'Minsk','georgia'=>'Tbilisi','kazakhstan'=>'Almaty'];
    //     $data['prefilled_city'] = $prefilled_city[$country[$char]];
    //     if($prefilled_city[$country[$char]] <>''){
    //         $where = ' transportation.status = "active" AND LOWER(transportation.city) = "'.strtolower($prefilled_city[$country[$char]]).'"';
    //     }else{
    //         $where = ' transportation.status = "active" AND LOWER(transportation.country) = "'.$country[$char].'"';
    //     }
    //     $where .= ' AND (transportation.capacity >='.$capacity.' AND transportation.capacity <='.($capacity+1).')';
    //     $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, ' LIMIT 2', $count = false);

    //     $type = 'sitescene';
    //     $select = 'sites.id,sites.site_name,sites.days_of_operation,sites.entry_ticket_fee,sites.child_entry_ticket_fee, sites.duration, sites.departing_time_from_hotel, sites.duration_hours, sites.duration_minutes';
    //     $where = 'sites.status= "active" AND sites.category = "'.$type.'" AND LOWER(sites.country) = "'.$country[$char].'"';
    //     //$where .= ' AND location_masters.status = "active"';
    // 	$join = [['type' => 'LEFT', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = sites.location_ids'],];
    // 	$where_outsidecity = '';//' AND location_masters.destination_type = "outsidecity"';
    //     $data['sites_outsidecity'] = $this->common_model->get_data('sites','', '', $select,$where.$where_outsidecity,'', $count = false,$join);

    //     $where_insidecity = '';//' AND location_masters.destination_type = "insidecity"';
    //     //$data['sites_insidecity'] = $this->common_model->get_data('sites','', '', $select,$where.$where_insidecity,'', $count = false,$join);
    //     $data['sites_insidecity'] = [];
        
    //     $where = 'currency_value.country ="'.strtolower($country[$char]).'" AND currency_value.status = "active"';
    //     $data['currency'] = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];
        
    //     $where = 'auxiliary_miscellaneous.country ="'.strtolower($country[$char]).'" AND auxiliary_miscellaneous.status="active"';
    //     $data['mandatory_services'] = $this->common_model->get_data('auxiliary_miscellaneous','', '', '*',$where, '', $count = false);
        
    //     $where = 'auxiliary_transportation.country ="'.strtolower($country[$char]).'" AND auxiliary_transportation.status="active"';
    //     $data['luggage_vehicle'] = $this->common_model->get_data('auxiliary_transportation','', '', '*',$where, ' LIMIT 1 ', $count = false);
        
    //     $where = 'quotations.enquiry_id = '.$enquiry_id;
    //     $data['quotations'] = $this->common_model->get_data('quotations','', '', 'quotations.id',$where, '', $count = false);
        
    //     echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    // }
	
    public function get_hotel_comparison_prices(){
        //echo '<pre>';print_r($this->input->post());exit;
        $type = implode('","',$this->input->post('type'));
        $hotel_ids = $this->input->post('hotel_id');
        $room_type = $this->input->post('room_type');
        
        $select = 'room_category_costing.price_with_breakfast,hotels.id,hotels.name';
        $join = [['type' => '', 'join_table' => 'room_category_costing', 'condition' => 'room_category_costing.hotel_id=hotels.id'],];
        $person_count = ['single'=>'1','twin'=>'2','triple'=>'3'];
        $data['hotel_min_price'] = [];
        //$data['hotel_max_price'] = '';
        foreach($hotel_ids AS $k=>$list){            
            foreach($person_count AS $key=>$person){
                if(in_array($key,$room_type)){
                    $where = ' hotels.status = "active" AND hotels.id = '.$list;
                    $where .= ' AND hotels.category ="'.$type.'"';
                    $where .= ' AND room_category_costing.person_count='.$person.' AND room_category_costing.type="adult" AND room_category_costing.status="active"';
                    $hotel_min_price = $this->common_model->get_data('hotels','', '', $select,$where, ' ORDER BY room_category_costing.price_with_breakfast ASC LIMIT 1', $count = false,$join);
                    if(!empty($hotel_min_price)){
                        $data['hotel_min_price'][$k][$key] = $hotel_min_price[0]->price_with_breakfast;
                        //$data['hotel_max_price'] = $this->common_model->get_data('hotels','', '', $select,$where.' AND hotels.id != '.$data['hotel_min_price'][0]->id, ' ORDER BY room_category_costing.price_with_breakfast DESC LIMIT 1', $count = false,$join);
                    }else{
                        $data['hotel_min_price'][$k][$key] = '';
                    }
                }else{
                    $data['hotel_min_price'][$k][$key] = '';
                }
            }
            $data['hotel_min_price'][$k]['hotel_name'] = $hotel_min_price[0]->name;
        }
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
    
    public function aux_transportation_suggesstion()
    {
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("vehicle_type like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('auxiliary_transportation')->result();
        foreach ($records as $row) {
            $response[] = array("t_id" => $row->id, "label" => trim($row->vehicle_type),"price"=>trim($row->price));
        }
        echo json_encode($response);
    }
    
    // public function get_transportation_suggesstion()
    // {
    //     $city = $this->input->post('city');
    //     $char = substr($this->input->post('location'), 1, 2);
    //     $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where("vehicle_name like '%" . trim($this->input->post('search')) . "%' ");
    //     $this->db->where('status', 'active');
    //     if($city <> ''){
    //         $this->db->where('LOWER(city)', strtolower($city));
    //     }else{
    //         $this->db->where('LOWER(country)', $locations[$char]);
    //     }
    //     $this->db->limit(10);
    //     $records = $this->db->get('transportation')->result();
    //     foreach ($records as $row) {
    //         $response[] = array("t_id" => $row->id, "label" => trim($row->vehicle_name),'luggage_vehicle'=>$row->luggage_transport,'capacity'=>$row->capacity);
    //     }
    //     echo json_encode($response);
    // }
    public function get_transportation_suggesstion()
    {
        $city = $this->input->post('city');
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR;
        $response = array();

        $this->db->distinct();
        $this->db->select('transportation.id, transportation.vehicle_name, transportation.luggage_transport, transportation.capacity');
        $this->db->from('transportation');
        $this->db->join('transportation_costs', 'transportation_costs.transport_id = transportation.id', 'INNER');
        $this->db->where("vehicle_name LIKE '%" . trim($this->input->post('search')) . "%'");
        $this->db->where('transportation.status', 'active');
        $this->db->where("transportation_costs.price != ''");

        if ($city != '') {
            $this->db->where('LOWER(transportation.city)', strtolower($city));
        } else {
            $this->db->where('LOWER(transportation.country)', $locations[$char]);
        }

        $this->db->limit(10);
        $records = $this->db->get()->result();

        foreach ($records as $row) {
            $response[] = array(
                "t_id" => $row->id,
                "label" => trim($row->vehicle_name),
                "luggage_vehicle" => $row->luggage_transport,
                "capacity" => $row->capacity
            );
        }

        echo json_encode($response);
    }
    
    public function get_hotels(){
        //echo '<pre>';print_r($this->input->post());exit;
        $type = implode('","',$this->input->post('type'));
        $select = 'hotels.id,hotels.name';
        $where = ' hotels.status = "active" AND LOWER(hotels.city) = "'.strtolower(trim($this->input->post('hotel_city'))).'"';
        $where .= ' AND hotels.category IN ("'.$type.'")';
        $data['hotels'] = $this->common_model->get_data('hotels','', '', $select,$where, '',$count = false);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }


    public function hotel_city(){
        $char = substr($this->input->post('enquiry_num'), 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('DISTINCT(hotels.city)');
        $this->db->where("hotels.city like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('hotels.status', 'active');
        $this->db->where('LOWER(hotels.country)',$country[$char]);
        $this->db->limit(10);
        $records = $this->db->get('hotels')->result();
        foreach ($records as $row) {
            $response[] = array("hotel_city" => trim($row->city), "label" => trim($row->city));
        }
        echo json_encode($response);
    }

    public function transport_prices(){
        //echo '<pre>';print_r($this->input->post());exit;
        $check_in = $this->input->post('checkin_date');
        $check_out = $this->input->post('checkout_date');
        $site_id = $this->input->post('site_id');
        $transport_id = $this->input->post('transports_id');

        $where = 'outsidecity_transportation_costs.sites_id = '.$site_id.' AND outsidecity_transportation_costs.transport_id IN ('.$transport_id.') AND outsidecity_transportation_costs.status = "active"';
        $where .= ' AND date(outsidecity_transportation_costs.valid_from) <= "'.$check_in.'" AND date(outsidecity_transportation_costs.valid_to) >= "'.$check_out.'"';
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = outsidecity_transportation_costs.transport_id'],];
        $data['transportation'] = $this->common_model->get_data('outsidecity_transportation_costs','', '', '*',$where, '', $count = false,$join);
		
        //if(empty($data['transportation'])){
        $where = ' transportation_costs.transport_id IN ('.$transport_id.') AND transportation_costs.type IN ("full-day")';
        $where .= ' AND date(transportation_costs.valid_from) <= "'.$check_in.'" AND date(transportation_costs.valid_to) >= "'.$check_out.'"';
        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = transportation_costs.transport_id'],];
        $data['transportation_cost'] = $this->common_model->get_data('transportation_costs','', '', '*',$where, '', $count = false,$join);
        //}
        //echo $this->db->last_query();'<pre>';print_R($data);exit;
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
	
    public function save_and_email(){
	//echo '<pre>'; print_r($this->input->post());exit;
		
        $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
        //$this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');        
        $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $cnt = count($this->input->post('itinerary_date'));
        $created = date('Y-m-d H:i:s');
        $enquiry_id = $this->input->post('enquiry_id');
        
        $where = ' enquiry.id = '.$enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
                        ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
        $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

        //echo '<pre>';print_r($enquiry);exit;
        $total_persons = $enquiry->number_persons + $enquiry->number_child;
        $char = substr($enquiry->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'Azerbaijan', 'B' => 'Belarus', 'G' => 'Georgia', 'K' => 'Kazakhstan'];
        $where = 'currency_value.country ="'.strtolower($country[$char]).'"';
        $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

        $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);

        $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
            <tbody>
            <tr style="height:21px">
                    <td style="border:1px solid rgb(0,0,0);overflow:hidden;padding:2px 3px;vertical-align:bottom;background-color:rgb(255,242,204);font-size:11pt;font-weight:bold;text-align:center" rowspan="1" colspan="5">Day wise Itinerary - 4 Night - 5 Days
                    </td>
            </tr><tr style="">
            <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
        $html = '';
        $total_transportation_outside = 0;
        $total_transportation_inside = 0;
        $total_transportation = 0;
        for($i=0;$i<$cnt;$i++){
            $cnt_text = count($this->input->post('itinerary_title_search_'.$i));
            for($j=0;$j<$cnt_text;$j++){
                    if($j==0){
                            $html .= $this->input->post('itinerary_date')[$i].'<ol>'; 
                    }
                    $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
                    $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
            }
            $html .= '</ol><br>';
            if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
                    $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
            }
            if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
                    $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
            }
        }
        $total_transportation = $total_transportation_outside + $total_transportation_inside;
        if(array_key_exists('hdn_airport_in_total',$this->input->post())){
                $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
        }
        if(array_key_exists('hdn_airport_out_total',$this->input->post())){
                $total_transportation = $total_transportation + $this->input->post('hdn_airport_out_total');
        }
        $table_itinerary.= $html.'</td></tr></tbody></table>';

        //echo 'Transportation : '.$total_transportation;

        $grand_total_1 = $total_transportation + $this->input->post('hotel_total_1');
        $grand_total_1 = $grand_total_1 + ($grand_total_1 * ($this->input->post('markup_percentage')/100));
        $grand_total_2 = $total_transportation + $this->input->post('hotel_total_2');
        $grand_total_2 = $grand_total_2 + ($grand_total_2 * ($this->input->post('markup_percentage')/100));

        //echo 'Total 1:'. $grand_total_1.'__Total 2:'.$grand_total_2;

        $per_person_cost_1 = round($grand_total_1/$total_persons);
        $per_person_cost_1 = round($per_person_cost_1/$currency->country_currency_value); // In dollars

        $per_person_cost_2 = round($grand_total_2/$total_persons);
        $per_person_cost_2 = round($per_person_cost_2/$currency->country_currency_value); // In dollars
        //echo 'PP 1 :'.$per_person_cost_1.'__PP 2'.$per_person_cost_2;exit;
        $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => $email_subject,
            'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'to' => [[ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
					[ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
					],
            //'cc' => [['name' => 'Rohit', 'email' => 'rohit@kazindmc.com']],
            //'bcc' => [['name' => '', 'email' => '']],
            'htmlContent' => '<!DOCTYPE html><html><head>
                        <style>
                        th, td {
                          padding: 5px;
                          text-align: left;
                        }
                        </style>
                    </head><body>
                    <table style="width:100%">
                    <tr><td colspan="12" align="left">Dear Team,</td></tr><tr><td colspan="12"></td></tr>
                    <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                    <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
                    <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?"<label style=`color:#33d70b;`>With Hotel</label>":"<label style=`color:#ff2c17;`>Without Hotel</label>").')</td></tr>
                    <tr><td colspan="12" align="left">Cost : U$ '.$per_person_cost_1.' PP [ '.$this->input->post('hotel_names_1').' ]</td></tr>
                    <tr><td colspan="12" align="left">Cost : U$ '.$per_person_cost_2.' PP [ '.$this->input->post('hotel_names_2').' ]</td></tr>

                    <tr><td colspan="12" align="left">'.$table_itinerary.'</td></tr>
                    <tr><td colspan="12" align="left"><mark>IMPORTANT NOTE:</mark> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
                    <tr><td colspan="12" align="left"><mark>INCLUSIONS:</mark> <br>'.$this->input->post('inclusions').' </td></tr>  
                    <tr><td colspan="12" align="left"><mark>EXCLUSIONS:</mark> <br>'.$this->input->post('exclusions').' </td></tr>  
                    <tr><td colspan="12" align="left"><mark>IMPORTANT NOTES:</mark> <br>'.$this->input->post('important_notes').' </td></tr>  
                    <tr><td colspan="12" align="left"><mark>CANCELLATION POLICY:</mark> <br>'.$this->input->post('cancellation_policy').' </td></tr>  
                    <tr><td colspan="12" align="left" height="25px"></td></tr><tr><td colspan="12" align="left">Regards,    </td></tr>
                    <tr><td colspan="12" align="left">Jasmine <br>
						OPS - FIT DESK (KAZAKHSTAN) </td></tr>
                    </table></body></html>',
             /*'params' => ['bodyMessage' => '']*/
        ]);

        try {
            $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
            //print_r($sendinblue_response);
        } catch (Exception $e) {
            //echo $e->getMessage(),PHP_EOL;
        }
		
        
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
        echo json_encode($response);
        exit;		
	}
	 public function save_and_email_new(){
	//echo '<pre>'; print_r($this->input->post());exit;
		
        $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
        //$this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');        
        $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
        $this->form_validation->set_error_delimiters('', '<br>');  
        if($this->form_validation->run() == FALSE){
            echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
            exit;
        }
        $cnt = count($this->input->post('itinerary_date'));
        $created = date('Y-m-d H:i:s');
        $enquiry_id = $this->input->post('enquiry_id');
        // $where2='enquiry_id ='.$enquiry_id;
        // $arrivals = $this->common_model->get_data('arrivals', '', '', 'id, enquiry_id', $where2, '', $count = false, '');
        // $arrival_id= $arrivals[0]->id;
    
        $where = ' enquiry.id = '.$enquiry_id;
        $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
                 ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
        $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

        //echo '<pre>';print_r($enquiry);exit;
        $total_persons = $enquiry->number_persons + $enquiry->number_child;
        $char = substr($enquiry->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'Azerbaijan', 'B' => 'Belarus', 'G' => 'Georgia', 'K' => 'Kazakhstan'];
        $where = 'currency_value.country = "'.strtolower($country[$char]).'" AND currency_value.status = "active"';
        $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

        $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);
        
        $stay_html = '';
        /*if(array_key_exists('hotel_nights', $this->input->post())){
            $stay_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
            $stay_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">STAY</span>';
            $stay_html .= '<ol>';
            $hotel_nights = json_decode($this->input->post('hotel_nights'));
            foreach($hotel_nights AS $key=>$list){
                $h_name = explode('_',$key);
                $stay_html .= '<li>'.$h_name[0].' ('.$list.' nights)</li>';
            }
            $stay_html .= '</ol></td></tr>';
        }*/
        
        $transportation_guide = '<tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">TRANSPORTATION & GUIDE</span> <br>'.$this->input->post('inclusions').' </td></tr>';
        
        $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
            <div>
            <h4 class="title">Day wise Itinerary - '.$enquiry->number_of_nights.' Night - '.($enquiry->number_of_nights+1).' Days
                <h4>
            </div>
        <tbody>
            '.$stay_html.$transportation_guide.'<tr style="">
            <td style="border-width:1px;overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
        $html = '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">ENTRANCE & ACTIVITIES</span><br>';
        $total_transportation_outside = 0;
        $total_transportation_inside = 0;
        $hdn_travel_city_cost = 0;
        $total_transportation = 0;
        $n=0;
        $html .= '<ol>'; 
        for($i=0;$i<$cnt;$i++){            
            $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i))?count($this->input->post('itinerary_title_search_'.$i)):0;
            for($j=0;$j<$cnt_text;$j++){
                if($j==0){
                    //$html .= /*$this->input->post('itinerary_date')[$i].*/'<ol>'; 
                }
                $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
                $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
                //if(array_key_exists('itinerary_activities_'.$i.'_'.$n, $this->input->post()) && $this->input->post('itinerary_activities_'.$i.'_'.$n) != ""){
                if(!empty($this->input->post('itinerary_activities_'.$i))){
                    $html .= '<ul>';
                    foreach($this->input->post('itinerary_activities_'.$i) AS $activity){
                        if($activity != ""){
                            $html .= '<li>'.$activity.'</li>';
                        }
                    }
                    $html .= '</ul>';
                }
            }
            $n++;
            if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
                $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
            }
            if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
                $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
            }
            if(array_key_exists('hdn_travel_city_cost_'.$i,$this->input->post())){
                $hdn_travel_city_cost = $hdn_travel_city_cost + $this->input->post('hdn_travel_city_cost_'.$i);
            }
        }
        $html .= '</ol><br>';
        
        $meals_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
        $meals_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">MEALS</span>';
        $meals_html .= '<ol><li>Breakfast</li></ol></td></tr>';
        
        $table_itinerary.= $html.'</td></tr>'.$meals_html.'</tbody></table>';
        
        $total_transportation = $total_transportation_outside + $total_transportation_inside;
        if(array_key_exists('hdn_airport_in_total',$this->input->post())){
            $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
        }
        if(array_key_exists('hdn_airport_out_total',$this->input->post())){
            $total_transportation = $total_transportation + $this->input->post('hdn_airport_out_total');
        }
        
        //echo 'Transportation : '.$total_transportation.'<br>';
        
        $activities_total = 0;
        if(array_key_exists('hdn_activities_total',$this->input->post()) && !empty($this->input->post('hdn_activities_total'))){
            foreach($this->input->post('hdn_activities_total') AS $list)
                {
                $activities_total = $activities_total + (int)$list;
            }
        }
        $restaurants_grand_total = 0;
        /*if(array_key_exists('hdn_restaurants_grand_total',$this->input->post())){
            $restaurants_grand_total = $restaurants_grand_total + $this->input->post('hdn_restaurants_grand_total');
        }*/
        $guide_grand_total = 0;
        if(array_key_exists('hdn_guide_grand_total',$this->input->post())){
            $guide_grand_total = (int)$guide_grand_total + (int)$this->input->post('hdn_guide_grand_total');
        }
        //echo 'Guide : '.$guide_grand_total. '<br>';
        $hdn_mandatory_grand_total = 0;
        if(array_key_exists('hdn_mandatory_grand_total',$this->input->post())){
            $hdn_mandatory_grand_total = $hdn_mandatory_grand_total + $this->input->post('hdn_mandatory_grand_total');
        }
        //echo 'Mandatory : '.$hdn_mandatory_grand_total. '<br>';
        $hdn_lugguage_total = 0;
        if(array_key_exists('hdn_luggage_price',$this->input->post())){
            $hdn_lugguage_total = $hdn_lugguage_total + (int)$this->input->post('hdn_luggage_price');
        }
        $hdn_final_ticket_price = 0;
        if(array_key_exists('hdn_final_ticket_price',$this->input->post())){
            $hdn_final_ticket_price = $hdn_final_ticket_price + $this->input->post('hdn_final_ticket_price');
        }
        /*$grand_total_1 = $total_transportation + $this->input->post('hotel_total_1') + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
        $grand_total_1 = $grand_total_1 + ($grand_total_1 * ($this->input->post('markup_percentage')/100));
        //$grand_total_2 = $total_transportation + $this->input->post('hotel_total_2');
        //$grand_total_2 = $grand_total_2 + ($grand_total_2 * ($this->input->post('markup_percentage')/100));
        
        $per_person_cost_1 = round($grand_total_1/$total_persons);
        $per_person_cost_1 = round($per_person_cost_1/$currency->country_currency_value); // In dollars
        */
        if(array_key_exists('hotel_names_category_wise', $this->input->post())){
            // $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'));
            $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'), true);
            // print_r($hotel_names_category_wise);
        }
        if(array_key_exists('hotel_costing_category_wise', $this->input->post())){
            // $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'));
            $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'), true);
        //  print_r($hotel_costing_category_wise);
            
        }
        if(array_key_exists('hotel_room_category_names_wise', $this->input->post())){
            $hotel_room_category_names_wise = json_decode($this->input->post('hotel_room_category_names_wise'), true);
            // print_r($hotel_room_category_names_wise);
        }
        //echo '<pre>';print_r($hotel_costing_category_wise);print_r($hotel_names_category_wise);exit;
 
// die();
        $cost_html = '';
        if ($this->input->post('hdn_group_type') == 'family') 
        {
            $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
                $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
                    ? $hotel_room_category_names_wise[$rating_key]
                    : [];
        
                $colspan = count($room_cat_list);
                $rating_display = ucwords(str_replace('_', ' ', $rating_key));
        
                $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
            }
            $cost_html .= '</tr>';
        
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
                $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
                    ? $hotel_room_category_names_wise[$rating_key]
                    : [];
        
                for ($i = 0; $i < count($room_cat_list); $i++) {
                    $hotel_name = isset($hotel_list[$i]) ? $hotel_list[$i] : '-';
                    $cost_html .= '<td style="background-color: #f2f5d6;">' . $hotel_name . '</td>';
                }
            }
            $cost_html .= '</tr>';
        
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
            foreach ($hotel_room_category_names_wise as $rating_key => $room_cat_list) {
                if (!is_array($room_cat_list)) continue;
                foreach ($room_cat_list as $room_cat_name) {
                    $cost_html .= '<td style="background-color: #f2dafc;">' . $room_cat_name . '</td>';
                }
            }
            $cost_html .= '</tr>';
        
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
            foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
                $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
                    ? $hotel_room_category_names_wise[$rating_key]
                    : [];
        
                foreach ($room_cat_list as $index => $room_cat_name) {
                    $hotel_cost = isset($hotel_costing_category_wise[$rating_key][$index]) ? $hotel_costing_category_wise[$rating_key][$index] : 0;
                    $grand_total = $total_transportation + $hotel_cost + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price + $hdn_travel_city_cost;
                    $markup_percentage = floatval($this->input->post('markup_percentage'));
                    $grand_total += ($grand_total * ($markup_percentage / 100));
        
                    $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
                        ? round(($grand_total / $total_persons) / $currency->country_currency_value)
                        : 0;
                    $cost_html .= '<td style="background-color: #f8d9d9;">$' . $per_person_cost . '</td>';
                }
            }
            // die();
                $cost_html .= '</tr>';
                $cost_html .= '</table>';
        }
        else if ($this->input->post('hdn_group_type') == 'individual') 
        {
            $grand_total = $total_transportation + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price + $hdn_travel_city_cost;
            $grand_total_pp = $grand_total / $total_persons;

            $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                $colspan = 0;
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                         if (is_array($occupancies)) {
                            $colspan += count($occupancies); 
                         }
                    }
                }
                $rating_display = ucwords(str_replace('_', ' ', $rating_key));
                $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) { 
                    $occ_count = 0;
                    foreach ($categories as $cat => $occupancies) {
                        if ($cat === "nights") continue;
                        $occ_count += count($occupancies);
                    }
                    $nights = isset($categories['nights']) ? $categories['nights'] : 0;
                    $hotel_display = $hotel_name . ($nights ? " ({$nights}N)" : "");
                    $cost_html .= '<td colspan="' . $occ_count . '" style="background-color: #f2f5d6; font-weight:bold;">' . $hotel_display . '</td>';
                }
            }
            $cost_html .= '</tr>';
           $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    $roomCats = [];
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $roomCats[] = $cat;
                        }
                    }
                    $prev = null;
                    $span = 0;
                    foreach ($roomCats as $i => $cat) {
                        if ($cat === $prev) {
                            $span++;
                        } else {
                            if ($prev !== null) {
                                $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
                                $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
                            }
                            $prev = $cat;
                            $span = 1;
                        }
                    }
                    if ($prev !== null) {
                        $colspan = ($span > 1) ? ' colspan="'.$span.'"' : '';
                        $cost_html .= '<td'.$colspan.' style="background-color: #f2dafc;">'.$prev.'</td>';
                    }
                }
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Occupancy</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $occ_arr = explode('__', $occ);
                            $occupancy_type = isset($occ_arr[0]) ? $occ_arr[0] : '';
                            $cost_html .= '<td style="background-color: #e2f0cb;">' . $occupancy_type . '</td>';
                        }
                    }
                }
            }
            $cost_html .= '</tr>';
            $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
            foreach ($hotel_costing_category_wise as $rating_key => $hotels) {
                foreach ($hotels as $hotel_name => $categories) {
                    foreach ($categories as $cat => $occupancies) {
                        if (!is_array($occupancies)) continue;
                        foreach ($occupancies as $occ) {
                            $occ_arr = explode('__', $occ);
                            $occupancy_cost = isset($occ_arr[1]) ? floatval($occ_arr[1]) : 0;

                            $cost_with_total = $occupancy_cost + $grand_total_pp;
                            $converted = ($currency->country_currency_value > 0) ? round($cost_with_total / $currency->country_currency_value) : 0;

                            $cost_html .= '<td style="background-color: #f8d9d9;">$' . $converted . '</td>';
                        }
                    }
                }
            }
            $cost_html .= '</tr>';
            $cost_html .= '</table>';
        }

        // else if($this->input->post('hdn_group_type') == 'individual')
        // {
        //     $grand_total = $total_transportation + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
        //     $grand_total_pp = $grand_total/$total_persons;
        //     foreach($hotel_costing_category_wise AS $key=>$hotel_names){                
        //         foreach($hotel_names AS $h_name=>$categories){
        //             $cnt = 1;
        //             $cost_html.= '<tr style="background-color:#f1f8ff;"><td colspan="12" align="left">'.$h_name.' ('.str_replace('_',' ',$key).')'.'</td></tr>';
        //             foreach($categories AS $c_name=>$occupancy){
        //                 foreach($occupancy AS $occ){
        //                     $occ_arr = explode('__',$occ);
        //                     $txt = $occ_arr[0]. ' '.round(($occ_arr[1]+$grand_total_pp)/$currency->country_currency_value).' U$';
        //                     $cost_html.= '<tr style="font-weight:bold;"><td colspan="12" align="left">'.$cnt.'). '.$c_name.' - '.$txt.' (PP)</td></tr>';
        //                     $cnt++;
        //                 }
        //             }
        //         }
        //     }
            
        // }
        //  echo $cost_html;die();
        $flight_details='<div class="title"><h4>FLIGHT DETAILS</h4></div>
                        <div class="text">
                            <div class="flight-wrapper">
                                <div class="flight-card from">
                                    <div class="card-header"> <i class="fa-solid fa-plane-departure"></i> From (Departure)</div>
                                    <div class="flight-row">
                                        <div class="label">City Of Origin:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('origin_city').'</div>
                                    </div>
                                    <div class="flight-row">
                                        <div class="label">City of Arrival:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_city').'</div>
                                    </div>
                                    <div class="flight-row">
                                        <div class="label">Arrival Airline:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_airline').'</div>
                                    </div>
                                    <div class="flight-row">
                                        <div class="label">Arrival Time:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('arrival_time').'</div>
                                    </div>
                                </div>
                                <div class="flight-card to">
                                    <div class="card-header"><i class="fa-solid fa-plane-arrival"></i> To (Arrival)</div>
                                    <div class="flight-row">
                                        <div class="label">Departure City:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('departure_city').'</div>
                                    </div>
                                    <div class="flight-row">
                                        <div class="label">Departing Airline:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_airline').'</div>
                                    </div>
                                    <div class="flight-row">
                                        <div class="label">Departing Time:</div>
                                        <div class="value">&nbsp;&nbsp;'.$this->input->post('departing_time').'</div>
                                    </div>
                                </div>
                            </div>
                    </div>';

        $only_itinerary_html = '
        <div class="text">
            <div class="itinerary-table">
                <div class="itinerary-header">
                    <div class="col-one">
                        <b>Day</b>
                    </div>
                    <div class="col-two">
                        <b>Activity</b>
                    </div>
                </div>';

        $total_transportation_outside = 0;
        $total_transportation_inside = 0;
        $n = 0;

        for ($i = 0; $i < $cnt; $i++) {
            $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i)) ? count($this->input->post('itinerary_title_search_'.$i)) : 0;
            
            // Skip day if no activity
            if ($cnt_text == 0) continue;

            $only_itinerary_html .= '
                <div class="itinerary-item">
                    <div class="col-one">
                        <span>Day ' . ($i + 1) . '</span>
                    </div>
                    <div class="col-two">
                        <ul style="padding: 0;">';

            for ($j = 0; $j < $cnt_text; $j++) {
                $t = ($this->input->post('itinerary_time_' . $i)[$j] != '') ? '(' . $this->input->post('itinerary_time_' . $i)[$j] . ') ' : '';
                $only_itinerary_html .= '<li>' . $t . $this->input->post('itinerary_title_search_' . $i)[$j] . '</li>';

                if (!empty($this->input->post('itinerary_activities_'.$i))) {
                    foreach ($this->input->post('itinerary_activities_'.$i) as $activity) {
                        if ($activity != "") {
                            $only_itinerary_html .= '<li style="margin-left:15px;">' . $activity . '</li>';
                        }
                    }
                }
            }
            $only_itinerary_html .= '
                        </ul>
                    </div>
                </div>';

            $n++;

            if (array_key_exists('hdn_transportation_outside_'.$i, $this->input->post())) {
                $total_transportation_outside += $this->input->post('hdn_transportation_outside_'.$i);
            }

            if (array_key_exists('hdn_transportation_inside_'.$i, $this->input->post())) {
                $total_transportation_inside += $this->input->post('hdn_transportation_inside_'.$i);
            }
        }

        $only_itinerary_html .= '
            </div>
        </div>';

        // echo $only_itinerary_html;
        // die();

                $short_itinerary='<div class="title">
                    <h4>DAY WISE SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights+1).' DAYS</h4>
                </div>';
                
                $inclusions=' <div class="title">
                    <h4>OUR INCLUSIONS</h4>
                </div>
                <div class="text" style="margin-top:-20px !important;">
                    <div class="our-inclusion">
                    <div class="inclusion-item">
                            <div class="box">
                                <h4>Complementory Services</h4>
                                <ul>';
                        $mandatory_services_json = $_POST['mandatory_services'] ?? '[]';
                        $mandatory_services = json_decode($mandatory_services_json, true);
                                    if (!empty($mandatory_services)) {
                                        foreach ($mandatory_services as $service) {
                                            $service_text = explode("_|_", $service['service'])[0];
                                            $price = explode("_|_", $service['service'])[1];
                                            $qnty = $service['qnty'];
                                            $inclusions .="<li>{$service_text} - {$qnty}</li>";
                                        }
                                    } else {
                                        $inclusions .="<li>No mandatory services provided.</li>";
                                    }

                    $inclusions.='</li></div>
                        </div>
                        <div class="inclusion-item">
                            <div class="box">
                                <h4>Transportation</h4>
                                <ul>
                                    <li>All transfers & sightseeing by private vehicle ( Sedan ) for 12 Hrs (10AM – 10PM Only, Within City Limits)  </li>
                                    <li>Airport – hotel – airport transfers</li>
                                    <li>Airprt Pic</li>
                                    <li>Airport Drop</li>
                                    <li>Dinner Transfers</li>
                                </ul>
                            </div>
                        </div>
                        <div class="inclusion-item">
                            <div class="box">
                                <h4>Guide</h4>
                                <ul>
                                    <li>All transfers & sightseeing include services of an English-speaking Guide.</li>
                                    <li>Airport meet & greet by our English-speaking staff.</li>
                                    <li>Departure souvenir gift.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>';
                // die();
                
        $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => $email_subject,
            'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
            'to' => [[ 'name' => 'Sumeet Verma', 'email' => 'back.office@kazindmc.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'rohit@kazindmc.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
                    [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
                    ],
            'htmlContent' => '<!DOCTYPE html><html><head>
        <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
                <style>
                    th, td {
                        padding: 5px;
                        text-align: left;
                    }
                    .header {
                        background-color: #cfe0f2;
                        margin: -50px -50px !important;
                        text-align: left ;
                    }
                        .title {
            padding: 12px 20px;
            margin:15px 0px;
            background-color: antiquewhite;
            text-align: center;
        }
                    label {
                        font-weight: bold;
                    }
                        .flight-wrapper {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .flight-card {
            background-color: #fff;
            border: solid 1px #ccc;
            width: calc(50% - 10px);
            padding: 15px 24px;
        }
            .card-header {
            font-size: 16px;
            font-weight: 600;
            color: #2e3b4e;
            border-bottom: dashed 1px #ccc;
            margin-bottom: 6px;
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .flight-row {
            margin-bottom: 4px;
            display: flex;
            justify-content: space-between;
        }
            .label {
            font-size: 12px;
            color: #778093;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .value {
            font-size: 14px;
            font-weight: 500;
            color: #2d3748;
        }
            .title>h4 {
            padding: 0;
            margin: 0;
            color: #000;
            text-decoration: none;
            text-transform: capitalize;
        }
            .itinerary-header {
            color: #fff;
            /* color: #fff; */
            /* background-color: #f56100e3; */
            background-color: #8299b0;
            display: flex;
            padding: 10px;
        }

        .col-one {
            width: 20% !important;
        }

        .itinerary-item {
            display: flex;
            padding: 8px 10px;
            /* border-bottom: solid 2px #8299b0; */
            /* border-bottom: solid 2px #e4e4e4; */
            /* border-bottom: dashed 2px #e4e4e4; old*/
            border-bottom: dashed 1.6px #8299b070;
            align-items: center;
        }

        .col-one>span {
            font-size: 18px;
            color: #3c556e;
            font-weight: 500;
        }

        .col-two {
            border-left: solid 1px #8299b0;
            padding-left: 45px;
            width: 80% !important;
        }

        .col-two>ul {
            margin: 0;
        }
            .our-inclusion {
            display: flex;
            gap: 20px;
        }

        .inclusion-item {
            width: 33%;
        }

        .box {
            width: 100%;
            height: 90%;
            border-left: solid 1px #ccc;
            background-color: #ebf3fa;
          
        }

        .box h4 {
            padding-left: 12px;
            padding-top: 12px;
        }

        .inclusion-item ul li {
            position: relative;
            list-style: none;
            color: #555555;
        }

        .inclusion-item ul li::before {
            
            position: absolute;
            color: #242424;
            left: -22px;
            font-size: 11px;
            top: 0;
        }
          .activites-item {
            background: #fffbfb;
            display: flex;
            /* width: 33.33%; */
            padding: 8px 20px;
            margin-bottom: 6px;
        }
        .our-activites {
            display: flex;
        }
        .activites-item>div:nth-child(1) {
            width: 10%;
        }
        .activites-item>div:nth-child(2) {
            width: 6%;
        }
        .activites-item>div:nth-child(3) {
            width: 80%;
        }
        .our-activites>div {
            width: 33.33%;
        }
        .activites-item i {
            color: #6c6c6c;
        }
                </style>
            </head><body>
                <div class="table-container">
                    <div class="header">
                        <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">
                    </div>
                    <table style="width:100%;">
                        <tr><td colspan="12" align="left">Dear Team,</td></tr>
                        <tr><td colspan="12"></td></tr>
                        <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                        <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
                        <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:#33d70b;">With Hotel</label>':'<label style="color:#ff2c17;">Without Hotel</label>').')</td></tr>
                        <tr><td colspan="12" align="left">'.$cost_html.'</td></tr>
                        <tr><td colspan="12" align="left">'.$flight_details.'</td></tr>
                        <tr><td colspan="12" align="left">'.$short_itinerary.'</td></tr>
                        <tr><td colspan="12" align="left">'.$only_itinerary_html.'</td></tr>
                        <tr><td colspan="12" align="left">'.$inclusions.'</td></tr>
                        <br>
                        <tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;color:red;">IMPORTANT NOTE:</span> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
                    <br><br>
                        <tr><td style="background-color:#f2dafc;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br>'.$this->input->post('exclusions').'</td></tr>  
                        <tr><td style="background-color:#44f8db40;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br>'.$this->input->post('important_notes').'</td></tr>  
                        <tr><td style="background-color:#5f9ea040;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br>'.$this->input->post('cancellation_policy').'</td></tr>  
                        <tr><td colspan="12" align="left">Click here for brief itinerary <a href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">(Link)</a></td></tr>
                        <tr><td colspan="12" align="left" height="25px"></td></tr>
                        <tr><td colspan="12" align="left">Regards,</td></tr>
                        <tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>
                    </table>
                </div>
            </body></html>',
             /*'params' => ['bodyMessage' => '']*/
        ]);

        try {
            $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
            //print_r($sendinblue_response);
        } catch (Exception $e) {
            //echo $e->getMessage(),PHP_EOL;
        }
        
        $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
        echo json_encode($response);
        exit;		
    }   
    
//     public function save_and_email_new(){
// 	//echo '<pre>'; print_r($this->input->post());exit;
		
//         $this->form_validation->set_rules('itinerary_date[]', 'Itinerary Date', 'trim|required');
//         //$this->form_validation->set_rules('itinerary_time_0[]', 'Itinerary Time', 'trim|required');        
//         $this->form_validation->set_rules('enquiry_id', 'Id', 'trim|required');
//         $this->form_validation->set_error_delimiters('', '<br>');  
//         if($this->form_validation->run() == FALSE){
//             echo json_encode(['response'=>'e','msg'=> '<div class="alert alert-danger">'.validation_errors().'</div>']);
//             exit;
//         }
//         $cnt = count($this->input->post('itinerary_date'));
//         $created = date('Y-m-d H:i:s');
//         $enquiry_id = $this->input->post('enquiry_id');
        
//         $where = ' enquiry.id = '.$enquiry_id;
//         $join = [['type' => 'LEFT', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
//                  ['type' => 'LEFT', 'join_table' => 'company', 'condition' => 'company.company_id = enquiry.company_id'],];
//         $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false,$join)[0];

//         //echo '<pre>';print_r($enquiry);exit;
//         $total_persons = $enquiry->number_persons + $enquiry->number_child;
//         $char = substr($enquiry->enquiry_abbr, 1, 2);
//         $country = COUNTRY_ABBR;//['A' => 'Azerbaijan', 'B' => 'Belarus', 'G' => 'Georgia', 'K' => 'Kazakhstan'];
//         $where = 'currency_value.country = "'.strtolower($country[$char]).'" AND currency_value.status = "active"';
//         $currency = $this->common_model->get_data('currency_value','', '', '*',$where, '', $count = false)[0];

//         $email_subject = $enquiry->enquiry_no.' / '.$enquiry->name.' / '.$enquiry->enquiry_abbr.' - '.$enquiry->contact_person.' X '.$total_persons.' - KAZIN '.strtoupper($country[$char]);
        
//         $stay_html = '';
//         /*if(array_key_exists('hotel_nights', $this->input->post())){
//             $stay_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//             $stay_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">STAY</span>';
//             $stay_html .= '<ol>';
//             $hotel_nights = json_decode($this->input->post('hotel_nights'));
//             foreach($hotel_nights AS $key=>$list){
//                 $h_name = explode('_',$key);
//                 $stay_html .= '<li>'.$h_name[0].' ('.$list.' nights)</li>';
//             }
//             $stay_html .= '</ol></td></tr>';
//         }*/
        
//         $transportation_guide = '<tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">TRANSPORTATION & GUIDE</span> <br>'.$this->input->post('inclusions').' </td></tr>';
        
//         $table_itinerary='<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;border-collapse:collapse;border:none">
//             <tbody>
//             <tr style="height:21px" style="margin-top:5px;">
//                 <td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;background-color:rgb(255,242,204);font-size:11pt;font-weight:bold;text-align:center" rowspan="1" colspan="5">Day wise Itinerary - '.$enquiry->number_of_nights.' Night - '.($enquiry->number_of_nights+1).' Days
//                 </td>
//             </tr>'.$stay_html.$transportation_guide.'<tr style="">
//             <td style="border-width:1px;overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//         $html = '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">ENTRANCE & ACTIVITIES</span><br>';
//         $total_transportation_outside = 0;
//         $total_transportation_inside = 0;
//         $total_transportation = 0;
//         $n=0;
//         $html .= '<ol>'; 
//         for($i=0;$i<$cnt;$i++){            
//             $cnt_text = !empty($this->input->post('itinerary_title_search_'.$i))?count($this->input->post('itinerary_title_search_'.$i)):0;
//             for($j=0;$j<$cnt_text;$j++){
//                 if($j==0){
//                     //$html .= /*$this->input->post('itinerary_date')[$i].*/'<ol>'; 
//                 }
//                 $t = (($this->input->post('itinerary_time_' . $i)[$j]<>'')?'('.$this->input->post('itinerary_time_' . $i)[$j].') ':'');
//                 $html .= '<li>'.$t.$this->input->post('itinerary_title_search_' . $i)[$j].'</li>';
//                 //if(array_key_exists('itinerary_activities_'.$i.'_'.$n, $this->input->post()) && $this->input->post('itinerary_activities_'.$i.'_'.$n) != ""){
//                 if(!empty($this->input->post('itinerary_activities_'.$i))){
//                     $html .= '<ul>';
//                     foreach($this->input->post('itinerary_activities_'.$i) AS $activity){
//                         if($activity != ""){
//                             $html .= '<li>'.$activity.'</li>';
//                         }
//                     }
//                     $html .= '</ul>';
//                 }
//             }
//             $n++;
//             if(array_key_exists('hdn_transportation_outside_'.$i,$this->input->post())){
//                 $total_transportation_outside = $total_transportation_outside + $this->input->post('hdn_transportation_outside_'.$i);
//             }
//             if(array_key_exists('hdn_transportation_inside_'.$i,$this->input->post())){
//                 $total_transportation_inside = $total_transportation_inside + $this->input->post('hdn_transportation_inside_'.$i);
//             }
//         }
//         $html .= '</ol><br>';
        
//         $meals_html = '<tr style=""><td style="overflow:hidden;padding:2px 3px;vertical-align:bottom;font-size:11pt" rowspan="1" colspan="5">';
//         $meals_html .= '<span style="color:#1974D2;text-decoration:underline;font-weight:bold;">MEALS</span>';
//         $meals_html .= '<ol><li>Breakfast</li></ol></td></tr>';
        
//         $table_itinerary.= $html.'</td></tr>'.$meals_html.'</tbody></table>';
        
//         $total_transportation = $total_transportation_outside + $total_transportation_inside;
//         if(array_key_exists('hdn_airport_in_total',$this->input->post())){
//             $total_transportation = $total_transportation + $this->input->post('hdn_airport_in_total');
//         }
//         if(array_key_exists('hdn_airport_out_total',$this->input->post())){
//             $total_transportation = $total_transportation + $this->input->post('hdn_airport_out_total');
//         }
        
//         //echo 'Transportation : '.$total_transportation.'<br>';
        
//         $activities_total = 0;
//         if(array_key_exists('hdn_activities_total',$this->input->post()) && !empty($this->input->post('hdn_activities_total'))){
//             foreach($this->input->post('hdn_activities_total') AS $list){
//                 $activities_total = $activities_total + (int)$list;
//             }
//         }
//         $restaurants_grand_total = 0;
//         /*if(array_key_exists('hdn_restaurants_grand_total',$this->input->post())){
//             $restaurants_grand_total = $restaurants_grand_total + $this->input->post('hdn_restaurants_grand_total');
//         }*/
//         $guide_grand_total = 0;
//         if(array_key_exists('hdn_guide_grand_total',$this->input->post())){
//             $guide_grand_total = $guide_grand_total + $this->input->post('hdn_guide_grand_total');
//         }
//         //echo 'Guide : '.$guide_grand_total. '<br>';
//         $hdn_mandatory_grand_total = 0;
//         if(array_key_exists('hdn_mandatory_grand_total',$this->input->post())){
//             $hdn_mandatory_grand_total = $hdn_mandatory_grand_total + $this->input->post('hdn_mandatory_grand_total');
//         }
//         //echo 'Mandatory : '.$hdn_mandatory_grand_total. '<br>';
//         $hdn_lugguage_total = 0;
//         if(array_key_exists('hdn_luggage_price',$this->input->post())){
//             $hdn_lugguage_total = $hdn_lugguage_total + (int)$this->input->post('hdn_luggage_price');
//         }
//         $hdn_final_ticket_price = 0;
//         if(array_key_exists('hdn_final_ticket_price',$this->input->post())){
//             $hdn_final_ticket_price = $hdn_final_ticket_price + $this->input->post('hdn_final_ticket_price');
//         }
//         /*$grand_total_1 = $total_transportation + $this->input->post('hotel_total_1') + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
//         $grand_total_1 = $grand_total_1 + ($grand_total_1 * ($this->input->post('markup_percentage')/100));
//         //$grand_total_2 = $total_transportation + $this->input->post('hotel_total_2');
//         //$grand_total_2 = $grand_total_2 + ($grand_total_2 * ($this->input->post('markup_percentage')/100));
        
//         $per_person_cost_1 = round($grand_total_1/$total_persons);
//         $per_person_cost_1 = round($per_person_cost_1/$currency->country_currency_value); // In dollars
//         */
//         if(array_key_exists('hotel_names_category_wise', $this->input->post())){
//             // $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'));
//             $hotel_names_category_wise = json_decode($this->input->post('hotel_names_category_wise'), true);
//         }
//         if(array_key_exists('hotel_costing_category_wise', $this->input->post())){
//             // $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'));
//             $hotel_costing_category_wise = json_decode($this->input->post('hotel_costing_category_wise'), true);
//         }
//         if(array_key_exists('hotel_room_category_names_wise', $this->input->post())){
//             $hotel_room_category_names_wise = json_decode($this->input->post('hotel_room_category_names_wise'), true);
//         }
//         //echo '<pre>';print_r($hotel_costing_category_wise);print_r($hotel_names_category_wise);exit;
 

//         $cost_html = '';
//         if ($this->input->post('hdn_group_type') == 'family') {
        
//             $cost_html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width:99%; text-align: center; margin:5px;">';
        
//             // 1. Rating Header Row
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Rating</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
//                 $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
//                     ? $hotel_room_category_names_wise[$rating_key]
//                     : [];
        
//                 $colspan = count($room_cat_list);
//                 $rating_display = ucwords(str_replace('_', ' ', $rating_key));
        
//                 $cost_html .= '<th colspan="' . $colspan . '" style="background-color: #d0fae8;">' . $rating_display . '</th>';
//             }
//             $cost_html .= '</tr>';
        
//             // 2. Hotel Name Row
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Hotel</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
//                 $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
//                     ? $hotel_room_category_names_wise[$rating_key]
//                     : [];
        
//                 for ($i = 0; $i < count($room_cat_list); $i++) {
//                     $hotel_name = isset($hotel_list[$i]) ? $hotel_list[$i] : '-';
//                     $cost_html .= '<td style="background-color: #f2f5d6;">' . $hotel_name . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';
        
//             // 3. Room Category Row
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Room Category</th>';
//             foreach ($hotel_room_category_names_wise as $rating_key => $room_cat_list) {
//                 if (!is_array($room_cat_list)) continue;
//                 foreach ($room_cat_list as $room_cat_name) {
//                     $cost_html .= '<td style="background-color: #f2dafc;">' . $room_cat_name . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';
        
//             // 4. Cost Per Person Row
//             $cost_html .= '<tr><th style="background-color: #90e0ef;">Cost Per Person</th>';
//             foreach ($hotel_names_category_wise as $rating_key => $hotel_list) {
//                 $room_cat_list = (isset($hotel_room_category_names_wise[$rating_key]) && is_array($hotel_room_category_names_wise[$rating_key]))
//                     ? $hotel_room_category_names_wise[$rating_key]
//                     : [];
        
//                 foreach ($room_cat_list as $index => $room_cat_name) {
//                     $hotel_cost = isset($hotel_costing_category_wise[$rating_key][$index]) ? $hotel_costing_category_wise[$rating_key][$index] : 0;
        
//                     // Calculate total cost
//                     $grand_total = $total_transportation + $hotel_cost + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
//                     $markup_percentage = floatval($this->input->post('markup_percentage'));
//                     $grand_total += ($grand_total * ($markup_percentage / 100));
        
//                     $per_person_cost = ($total_persons > 0 && $currency->country_currency_value > 0)
//                         ? round(($grand_total / $total_persons) / $currency->country_currency_value)
//                         : 0;
        
//                     $cost_html .= '<td style="background-color: #f8d9d9;">$' . $per_person_cost . '</td>';
//                 }
//             }
//             $cost_html .= '</tr>';
        
//             $cost_html .= '</table>';
//             // echo $cost_html;
//             // die();
//         }
//         else if($this->input->post('hdn_group_type') == 'individual'){
//             $grand_total = $total_transportation + $restaurants_grand_total + $guide_grand_total + $activities_total + $hdn_mandatory_grand_total + $hdn_lugguage_total + $hdn_final_ticket_price;
//             $grand_total_pp = $grand_total/$total_persons;
//             foreach($hotel_costing_category_wise AS $key=>$hotel_names){                
//                 foreach($hotel_names AS $h_name=>$categories){
//                     $cnt = 1;
//                     $cost_html.= '<tr style="background-color:#f1f8ff;"><td colspan="12" align="left">'.$h_name.' ('.str_replace('_',' ',$key).')'.'</td></tr>';
//                     foreach($categories AS $c_name=>$occupancy){
//                         foreach($occupancy AS $occ){
//                             $occ_arr = explode('__',$occ);
//                             $txt = $occ_arr[0]. ' '.round(($occ_arr[1]+$grand_total_pp)/$currency->country_currency_value).' U$';
//                             $cost_html.= '<tr style="font-weight:bold;"><td colspan="12" align="left">'.$cnt.'). '.$c_name.' - '.$txt.' (PP)</td></tr>';
//                             $cnt++;
//                         }
//                     }
//                 }
                
//             }
//         }

//         $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
//         $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

//         $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
//             'subject' => $email_subject,
//             'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
//             'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
//             'to' => [[ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
//                     // [ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
//                     [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
//                     ],
//             'htmlContent' => '<!DOCTYPE html><html><head>
//                 <style>
//                     th, td {
//                         padding: 5px;
//                         text-align: left;
//                     }
//                     .header {
//                         background-color: #cfe0f2;
//                         margin: -50px -50px !important;
//                         text-align: left ;
//                     }
//                     label {
//                         font-weight: bold;
//                     }
//                 </style>
//             </head><body>
//                 <div class="table-container">
//                     <div class="header">
//                         <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">
//                     </div>
//                     <table style="width:100%;">
//                         <tr><td colspan="12" align="left">Dear Team,</td></tr>
//                         <tr><td colspan="12"></td></tr>
//                         <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
//                         <tr><td colspan="12" align="left">COMMERCIAL PROPOSAL OF ALMATY FOR '.$enquiry->number_of_nights.'N/'.($enquiry->number_of_nights+1).'D based on '.$total_persons.' Pax : -</td></tr>
//                         <tr><td colspan="12" align="left">'.$enquiry->number_of_nights.'N Land Package ('.(($this->input->post('hotel_status')=="yes")?'<label style="color:#33d70b;">With Hotel</label>':'<label style="color:#ff2c17;">Without Hotel</label>').')</td></tr>
//                         '.$cost_html.'
//                         <tr><td colspan="12" align="left">'.$table_itinerary.'</td></tr>
//                         <tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;">IMPORTANT NOTE:</span> - The above package has been calculated based on today’s ROE of 1 USD = '.$currency->currency_abbr.' '.$currency->country_currency_value.'. Any change in currency fluctuation will affect your final package cost which will be calculated on the day of final payment.</td></tr>  
//                     <br><br>
//                         <tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br>'.$this->input->post('exclusions').'</td></tr>  
//                         <tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br>'.$this->input->post('important_notes').'</td></tr>  
//                         <tr><td colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br>'.$this->input->post('cancellation_policy').'</td></tr>  
//                         <tr><td colspan="12" align="left" height="25px"></td></tr>
//                         <tr><td colspan="12" align="left">Regards,</td></tr>
//                         <tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>
//                     </table>
//                 </div>
//             </body></html>',
//              /*'params' => ['bodyMessage' => '']*/
//         ]);

//         try {
//             $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
//             //print_r($sendinblue_response);
//         } catch (Exception $e) {
//             //echo $e->getMessage(),PHP_EOL;
//         }
        
//         $response = ['response'=>'s','details'=>'','msg'=>'<div class="alert alert-success">Quotation Emailed Successfully!</div>'];
//         echo json_encode($response);
//         exit;		
//     }    
    
    public function airline_city(){
        $response = array();
        $this->db->select('DISTINCT(departure_city)');
        $this->db->where("departure_city like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->limit(10);
        $records = $this->db->get('flight_schedule')->result();
        foreach ($records as $row) {
            $response[] = array("departure_city" => trim($row->departure_city), "label" => trim($row->departure_city));
        }
        echo json_encode($response);
    }

    public function get_airlines(){
        $departure_city = $this->input->post('departure_city');
        $arrival_city = $this->input->post('arrival_city');
        $search = trim($this->input->post('search'));
        $where = '';
        if($departure_city != "" && $arrival_city != ""){
            $where = ' flight_schedule.departure_city = "'.$departure_city.'" AND flight_schedule.arrival_city = "'.$arrival_city.'" AND ';
        }else if($departure_city != "" && $arrival_city == ""){
            $where = ' flight_schedule.departure_city = "'.$departure_city.'" AND ';
        }
        $where .= ' flight_schedule.status = "active" AND airlines.status="active"';
        if($this->input->post('start_day')<>''){
            $where .= ' AND (flight_schedule.days_of_operations LIKE "%'.trim($this->input->post('start_day')).'%"';
            $where .= ' OR flight_schedule.days_of_operations  = "daily")';
        }else if($this->input->post('end_day')<>''){
            $where .= ' AND (flight_schedule.days_of_operations LIKE "%'.trim($this->input->post('end_day')).'%"';
            $where .= ' OR flight_schedule.days_of_operations  = "daily")';
        }
        // $where .= ' AND LOWER(airlines.name) LIKE "%'.$search.'%"';
        if (preg_match('/^([a-zA-Z]+)(\d+)$/', $search, $matches)) 
        {
            $airline_code = strtoupper($matches[1]); 
            $flight_number = $matches[2];
            $where .= ' AND ( UPPER(airlines.code) LIKE "%' . $airline_code . '%" AND flight_schedule.flight_number LIKE "%' . $flight_number . '%" )';
        } else {
                $where .= ' AND (LOWER(airlines.name) LIKE "%' . $search . '%" OR UPPER(airlines.code) LIKE "%' . strtoupper($search) . '%" OR CAST(flight_schedule.flight_number AS CHAR) LIKE "%' . $search . '%")';
        }

        $join = [['type' => '', 'join_table' => 'airlines', 'condition' => 'flight_schedule.airline_id = airlines.id'],];
        $data = $this->common_model->get_data('flight_schedule','', '', '*',$where, '', $count = false,$join);
        //echo $this->db->last_query();'<pre>';print_R($data);exit;
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name.' ('.$row->code.$row->flight_number.')'),'departure_time'=>trim($row->departure_time),'arrival_time'=>trim($row->arrival_time));
        }
        echo json_encode($response);
        exit;
    }

    // **************************************************************************************
	
	
    public function index(){
        
        if ($this->input->get('id') == '' || !is_numeric(base64_decode($this->input->get('id')))) {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid details!</div>');
            redirect('enquiry-followup');
        }
        $id = base64_decode($this->input->get('id'));
        
        $where = 'enquiry.id = '.$id;
        $quotation_enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false)[0];
        $data['details'] = $quotation_enquiry;
        //echo '<pre>';print_r($quotation_enquiry);exit;
        $capacity = $quotation_enquiry->number_persons + $quotation_enquiry->number_child;        
        
        $where = 'enquiry.status = "confirm" AND enquiry.enquiry_abbr = "'.$quotation_enquiry->enquiry_abbr.'" AND enquiry.number_of_nights <= '.$quotation_enquiry->number_of_nights;
        $where .= ' AND enquiry.number_persons <= '.$quotation_enquiry->number_persons .' AND enquiry.number_child <= '.$quotation_enquiry->number_child; 
        $where .= ' AND date(enquiry.date) >= "'.date('Y-m-d', strtotime('-30 days')).'"';
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
                ['type' => '', 'join_table' => 'itinerary', 'condition' => '(itinerary.arrival_id = arrivals.id AND itinerary.status="active")'],];
        $data['itinerary'] = $this->common_model->get_data('enquiry','', '', 'DISTINCT enquiry.enquiry_no,enquiry.*,arrivals.id AS arrival_id',$where, '', $count = false,$join);
        //echo $this->db->last_query();exit;
        
        $select = 'hotels.id,hotels.name';
        $where = 'enquiry.status = "confirm" AND enquiry.enquiry_abbr = "'.$quotation_enquiry->enquiry_abbr.'" AND enquiry.number_of_nights = '.$quotation_enquiry->number_of_nights;
        $join = [['type' => '', 'join_table' => 'arrivals', 'condition' => 'enquiry.id = arrivals.enquiry_id'],
                ['type' => '', 'join_table' => 'arrival_hotel_details', 'condition' => 'arrivals.enquiry_id = arrival_hotel_details.enquiry_id'],
                ['type' => '', 'join_table' => 'hotels', 'condition' => 'hotels.id = arrival_hotel_details.hotel_id'],];
        $data['hotels'] = $this->common_model->get_data('enquiry','', '', $select,$where, ' GROUP BY hotels.id', $count = false,$join);
        
        $char = substr($quotation_enquiry->enquiry_abbr, 1, 2);
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $where = ' transportation.status = "active" AND LOWER(transportation.country) = "'.$country[$char].'"';
        $where .= ' AND (transportation.capacity >='.$capacity.' AND transportation.capacity <='.($capacity+1).')';
        $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, '', $count = false);
        
        //echo '<pre>';print_r($data);exit;
         
        $this->load->view('admin/quotation_suggesstions',$data);
    }
    
    public function create(){
        $_GET = $_POST;
        //echo '<pre>';print_r($this->input->get());exit;
		
        $enquiry_id = base64_decode(urldecode($this->input->get('enquiry_id')));
        $where = 'enquiry.id = '.$enquiry_id;
        $data['details'] = $enquiry = $this->common_model->get_data('enquiry','', '', '*',$where, '', $count = false)[0];
		
	$char = substr($enquiry->enquiry_abbr,1,1);
        $country = ['A'=>'azerbaijan','B'=>'belarus','G'=>'georgia','K'=>'kazakhstan'];
		$data['country'] = $country[$char];

	$where = 'country = "'.$country[$char] .'" AND itinerary_templates_content.status != "deleted"';
        $template = $this->common_model->get_data('itinerary_templates_content','', '', '*',$where, ' ORDER BY itinerary_templates_content.id ASC', $count = false);
        
	    /*$select = 'sites.*'; // For later use
        $where = 'location_masters.destination_type = "outsidecity" AND location_masters.status = "active" AND LOWER(location_masters.country)="'.$country[$char].'"';
        $join = [['type' => '', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = sites.location_ids'],];
        $sites = $this->common_model->get_data('sites','', '', $select,$where, '', $count = false,$join);*/
		
        $data['airport_transfer_in'] = $data['airport_transfer_out'] = [];
        if($this->input->get('airport_pick_drop')=='yes' && $this->input->get('chk_vehicle')<>''){
            $transport_id = implode(',',$this->input->get('chk_vehicle'));
            $where = ' transportation_costs.transport_id IN ('.$transport_id.') AND transportation_costs.type IN ("airport-transfer-in","airport-transfer-out")';
            $where .= ' AND date(transportation_costs.valid_from) <= "'.$data['details']->check_in_date.'" AND date(transportation_costs.valid_to) >= "'.$data['details']->check_out_date.'"';
            $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = transportation_costs.transport_id'],];
            $airport_transportation = $this->common_model->get_data('transportation_costs','', '', '*',$where, '', $count = false,$join);

            foreach($airport_transportation AS $list){
                if($list->type == 'airport-transfer-in'){
                    $key = array_search($list->id, $this->input->get('chk_vehicle[]'));
                    $data['airport_transfer_in'][] = ['vehicle_name'=>$list->vehicle_name,'price'=>$list->price,'currency'=>$list->currency,
                                                                        'quantity'=>$this->input->get('vehicle_quantity')[$key]];
                }elseif($list->type == 'airport-transfer-out'){
                    $key = array_search($list->id, $this->input->get('chk_vehicle[]'));
                    $data['airport_transfer_out'][] = ['vehicle_name'=>$list->vehicle_name,'price'=>$list->price,'currency'=>$list->currency,
                                                                        'quantity'=>$this->input->get('vehicle_quantity')[$key]];
                }
            }
        }
        $data['transportation'] = [];
        if($this->input->get('chk_vehicle')<>''){
            $transport_id = implode(',',$this->input->get('chk_vehicle'));
            $where = ' transportation.id IN ('.$transport_id.') AND transportation.status = "active"';
            $data['transportation'] = $this->common_model->get_data('transportation','', '', '*',$where, '', $count = false);
        }
		
        $start_date = new DateTime($enquiry->check_in_date);
        $last_date = new DateTime($enquiry->check_out_date);
        $diff = $last_date->diff($start_date);
        $data['duration'] = $diff->d;
		
        $arrival_time = ($this->input->get('hdn_arrival_time')<>'')?$this->input->get('hdn_arrival_time'):'08:00';
        $departure_time = ($this->input->get('hdn_departure_time')<>'')?$this->input->get('hdn_departure_time'):'20:00';
		
        for($i=0;$i<=$diff->d;$i++){
            $date = date('Y-m-d', strtotime($enquiry->check_in_date)+($i*24*60*60));
            if($i==0){
                if($this->input->get('airport_pick_drop') == 'no'){
                    $template[0]->content = explode('After',$template[0]->content)[0];
                }
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>$arrival_time,'content'=>$template[0]->content,'remarks'=>''];
            }else if($i==$diff->d){
                if($this->input->get('airport_pick_drop') == 'no'){
                    $template[2]->content = explode('Our',$template[2]->content)[0];
                }
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>$departure_time,'content'=>$template[2]->content,'remarks'=>''];
            }else{
                $data['template_content'][] = (object)['id'=>$i,'date'=>$date,'time'=>'07:00','content'=>'','remarks'=>''];
            }
        }
	    //echo '<pre>';print_R($data);exit;
		$data['content'] = 'admin/quotation_create';
        $this->load->view('admin/layout',$data);
    }    
    
    public function get_hotel_prices(){ //echo '<br>'; print_r($this->input->post());exit;
        $hotel_id = $this->input->post('hotel_id');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');
        $type = $this->input->post('type');//implode('","',$this->input->post('type'));
        $where = 'hotel_room_categories.hotel_id = '.$hotel_id.' AND hotel_room_categories.status = "active" ';
        $where .= ' AND hotels.category IN ("'.$type.'")';
        $where .= ' AND date(room_category_costing.from_date) <= "'.$check_in.'" AND date(room_category_costing.to_date) >= "'.$check_out.'"';
        $qry = 'SELECT hotels.name,hotels.location,hotel_room_categories.id,hotel_room_categories.category_name, GROUP_CONCAT( CONCAT(room_category_costing.person_count,"(",if(room_category_costing.type="adult", "A","C") ,") ",room_category_costing.price_with_breakfast," ",room_category_costing.child_bed) ORDER BY room_category_costing.type,room_category_costing.person_count SEPARATOR ",") AS details ';
        $qry .= 'FROM hotel_room_categories JOIN room_category_costing ON (room_category_costing.category_id = hotel_room_categories.id AND room_category_costing.status="active") ';
        $qry .= 'JOIN hotels ON hotels.id = hotel_room_categories.hotel_id WHERE '.$where.' GROUP BY hotel_room_categories.id ';
        //echo $qry;exit;
        $data['result'] = $this->common_model->custom_query($qry);
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
    
    public function get_cities(){
        $char = substr($this->input->post('enq_no'),1,2);
        $search = trim($this->input->post('search'));
        $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $select = 'cities.name';
        $where = 'LOWER(countries.name) = "'.$locations[$char].'" AND cities.name LIKE "%'.$search.'%"';
        $join = [['type' => '', 'join_table' => 'states', 'condition' => 'cities.state_id = states.id'],
                ['type' => '', 'join_table' => 'countries', 'condition' => 'countries.id = states.country_id'],];
        $data = $this->common_model->get_data('cities','', '', $select,$where, ' LIMIT 10', $count = false,$join);
        //echo '<pre>';print_r((array)$data);exit;
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name),'suburb_flag'=>false);
        }
        if(empty($response)){
            $select = 'suburbs.name';
            $where = 'LOWER(countries.name) = "'.$locations[$char].'" AND suburbs.name LIKE "%'.$search.'%"';
            $join = [['type' => '', 'join_table' => 'suburbs', 'condition' => 'suburbs.city_id = cities.id'],
                    ['type' => '', 'join_table' => 'states', 'condition' => 'cities.state_id = states.id'],
                    ['type' => '', 'join_table' => 'countries', 'condition' => 'countries.id = states.country_id'],];
            $data = $this->common_model->get_data('cities','', '', $select,$where, ' LIMIT 10', $count = false,$join);
            //echo '<pre>';print_r((array)$data);exit;
            foreach ($data as $row) {
                $response[] = array("label" => trim($row->name),'suburb_flag'=>true);
            }
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_hotel_citywise(){
        //echo '<pre>';print_r($this->input->post());exit;
        $city = $this->input->post('city');
        $search = trim($this->input->post('search'));
        $selected_hotel_ids = $this->input->post('hotel_ids');
        //echo '<pre>';print_R($selected_hotel_ids);exit;
        //$type = (count($this->input->post('type'))>1)?implode('","',$this->input->post('type')):$this->input->post('type')[0];
        $type = $this->input->post('type');
        $select = 'hotels.name,hotels.id';
        $where = 'LOWER(hotels.city) = "'.strtolower($city).'" AND hotels.name LIKE "%'.$search.'%"';
        if(array_key_exists('suburb',$this->input->post())){
            $where = 'LOWER(hotels.suburb) = "'.strtolower($city).'" AND hotels.name LIKE "%'.$search.'%"';
        }
        $where .= ' AND hotels.status = "active" AND hotels.category IN ("'.$type.'")';
        $filteredArray = array_filter($selected_hotel_ids, function($value) {
            return !empty($value) && trim($value) !== '';
        });
        if(!empty($filteredArray)){            
            $where .= ' AND hotels.id NOT IN ('.implode(',',$filteredArray).')';
        }
        $data = $this->common_model->get_data('hotels','', '', $select,$where, ' LIMIT 10', $count = false);
        //echo $this->db->last_query();exit;
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name),'hotel_id'=>$row->id);
        }

        $where = 'suburbs.name = "'.$city.'"';
        $join = [['type' => 'LEFT', 'join_table' => 'cities', 'condition' => 'cities.id = suburbs.city_id'],];
        $data_suburbs = $this->common_model->get_data('suburbs','', '', 'suburbs.name',$where, '', $count = false,$join);
        if(empty($response) && !empty($data_suburbs)){
            $_POST['city'] = $data_suburbs[0]->name;
            $_POST['suburb'] = $data_suburbs[0]->name;
            $this->get_hotel_citywise();
        }

        echo json_encode($response);
        exit;
    }
    
    public function get_restaurants_citywise(){
        //echo '<pre>';print_R($this->input->post());exit;
        $city = $this->input->post('city');
        $search = trim($this->input->post('search'));
        $select = 'restaurants.name,restaurants.id';
        $where = 'LOWER(restaurants.city) = "'.strtolower($city).'" AND restaurants.name LIKE "%'.$search.'%"';        
        $where .= ' AND restaurants.status = "active"';
        $data = $this->common_model->get_data('restaurants','', '', $select,$where, ' LIMIT 10', $count = false);
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name),'restaurants_id'=>$row->id);
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_sites(){
        $char = substr($this->input->post('enq_no'),1,2);
        $search = trim($this->input->post('search'));
        $city = $this->input->post('city');
        $country = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $select = 'sites.id,sites.site_name AS label,sites.days_of_operation,sites.entry_ticket_fee,sites.child_entry_ticket_fee';
        $where = 'sites.status= "active" AND LOWER(sites.country) = "'.$country[$char].'" AND sites.site_name LIKE "%'.$search.'%" AND FIND_IN_SET(LOWER("'.$city.'"), LOWER(sites.city)) LIMIT 15';
        //$join = [['type' => 'LEFT', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = sites.location_ids'],];
    	$sites = $this->common_model->get_data('sites','', '', $select,$where,'', $count = false);
        echo json_encode($sites);
        exit;
    }
    
    public function get_activities(){
        $site_id = $this->input->post('site_id');
        $select = 'site_activities_costs.*';
        $where = 'site_activities_costs.sites_id = '.$site_id;
    	$site_activities = $this->common_model->get_data('site_activities_costs','', '', $select,$where,'', $count = false);
        echo json_encode(['response' => 's', 'details' => $site_activities, 'msg' => '']);
        exit;
    }
    
    public function get_restaurants_prices(){
        //echo '<pre>';print_R($this->input->post());exit;
        $restaurant_id = $this->input->post('restaurant_id');
        $meals = trim($this->input->post('meals'));
        $meals_type = trim($this->input->post('meals_type'));
        $select = 'restaurant_cuisine_prices.*';
        $where = 'LOWER(restaurant_cuisine_prices.type) = "'.strtolower($meals_type).'" AND LOWER(restaurant_cuisine_prices.buffet_name) = "'.strtolower($meals).'"';        
        $where .= ' AND restaurant_cuisine_prices.status = "active" AND restaurant_cuisine_prices.restaurant_id = '.$restaurant_id;
        $data = $this->common_model->get_data('restaurant_cuisine_prices','', '', $select,$where, '', $count = false);
        //echo $this->db->last_query();exit;
        if(!empty($data)){
            $data = $data[0];
        }
        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
        exit;
    }
    
    public function get_guides()
    {
        $city = $this->input->post('city');
        $search = trim($this->input->post('search'));
        $select = 'guides.name,guides.last_name,guides.id';
        $where = 'LOWER(guides.city) = "'.strtolower($city).'" AND guides.status = "active"';        
        $where .= ' AND (guides.name LIKE "%'.$search.'%" OR guides.last_name LIKE "%'.$search.'%")';
        $data = $this->common_model->get_data('guides','', '', $select,$where, ' LIMIT 10', $count = false);
        $response = [];
        foreach ($data as $row) {
            $response[] = array("label" => trim($row->name).' '.trim($row->last_name),'guide_id'=>$row->id);
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_mandatory_services(){
        $char = substr($this->input->post('location'), 1, 2);
        $locations = COUNTRY_ABBR;//['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $response = array();
        $this->db->select('*');
        $this->db->where("auxiliary_miscellaneous.title like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        $this->db->where('LOWER(auxiliary_miscellaneous.country)', $locations[$char]);
        $this->db->limit(10);
        $records = $this->db->get('auxiliary_miscellaneous')->result();
        foreach ($records as $row) {
            // $response[] = array("t_id" => $row->id, "label" => trim($row->title),'price'=>$row->adult_price);
             $response[] = array(
                "t_id" => $row->id,
                "label" => trim($row->title),
                "price" => $row->adult_price,
                "quantity" => $row->quantity,
                "cost_by" => $row->cost_by, 
                "group_type" => $row->group_type
            );
        }
        echo json_encode($response);
    }
    
    // public function save_quotation(){
    //     //echo '<pre>';print_r(json_decode($this->input->post('quotation_arr')));
    //     //echo '<pre>';print_r(json_decode($this->input->post('hotel_arr')));exit;
    //     $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Quotation Not Saved. Try Again!</div>'];
    //     if($this->input->post('quotation_arr') <> '' && $this->input->post('hotel_arr') <> ''){
    //         $quotation_arr = json_decode($this->input->post('quotation_arr'),true);
    //         // $quotation_arr = $quotation_arr + ['created'=>date('Y-m-d H:i:s'),'modified'=>date('Y-m-d H:i:s')];
    //         if ($quotation_arr) {
    //             $quotation_arr += ['created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')];
    //         } else {
    //             echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">Invalid quotation data.</div>']);
    //             exit;
    //         }
    //         $id = $this->common_model->insert_data(['table_name' => 'quotations', 'insert_data' => $quotation_arr]);
    //         if($id){
    //             $hotel_arr = json_decode($this->input->post('hotel_arr'),true);
    //             //echo '<pre>';print_r($hotel_arr);exit;
    //             foreach($hotel_arr AS $arr){
    //                 $hotel_details[] = $arr + ['quotation_id' => $id,'created' => date('Y-m-d H:i:s')];
    //             }
    //             if(!empty($hotel_details)){
    //                 $this->common_model->insert_data_batch(['table_name' => 'quotation_hotel_details', 'insert_data' => $hotel_details]);
    //             }
    //             $response = ['response' => 's', 'details' => '', 'msg' => '<div class="alert alert-success">Saved Successfully!</div>'];
    //         }
    //     }
    //     echo json_encode($response);
    //     exit;
    // }
    public function save_quotation(){
        $response = [
            'response' => 'e',
            'details' => '',
            'msg' => '<div class="alert alert-danger">Quotation Not Saved. Try Again!</div>'
        ];

        if($this->input->post('quotation_arr') && $this->input->post('hotel_arr')){

            $quotation_arr = json_decode($this->input->post('quotation_arr'), true);
            if ($quotation_arr) {
                $quotation_arr += [
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];
            } else {
                echo json_encode([
                    'response' => 'e',
                    'msg' => '<div class="alert alert-danger">Invalid quotation data.</div>'
                ]);
                exit;
            }

            // Insert into `quotations` table
            $id = $this->common_model->insert_data([
                'table_name' => 'quotations',
                'insert_data' => $quotation_arr
            ]);

            if ($id) {
                $hotel_arr = json_decode($this->input->post('hotel_arr'), true);
                $hotel_details = [];

                foreach ($hotel_arr as $arr) {
                    $hotel_detail = [
                        'quotation_id'   => $id,
                        'hotel_category' => $arr['hotel_category'] ?? '',
                        'night'          => $arr['night'] ?? '',
                        'hotel_name'     => $arr['hotel_name'] ?? '',
                        'hotel_id'       => $arr['hotel_id'] ?? '',
                        'created'        => date('Y-m-d H:i:s'),
                    ];

                    // If `hotel_room_details` exists, store it as JSON
                    if (!empty($arr['hotel_room_details'])) {
                        $hotel_detail['hotel_room_details'] = json_encode($arr['hotel_room_details'], JSON_UNESCAPED_UNICODE);
                    } else {
                        $hotel_detail['hotel_room_details'] = null;
                    }

                    $hotel_details[] = $hotel_detail;
                }

                if (!empty($hotel_details)) {
                    $this->common_model->insert_data_batch([
                        'table_name'  => 'quotation_hotel_details',
                        'insert_data' => $hotel_details
                    ]);
                }

                $response = [
                    'response' => 's',
                    'details' => '',
                    'msg' => '<div class="alert alert-success">Saved Successfully!</div>'
                ];
            }
        }

        echo json_encode($response);
        exit;
    }
    
    public function fetch_quotation(){
        //echo '<pre>';print_r($this->input->post('id'));exit;
        $response = ['response' => 'e', 'details' => '', 'msg' => '<div class="alert alert-danger">Invalid Id. Try Again!</div>'];
        
        if($this->input->post('id') <> '' && is_numeric($this->input->post('id'))){
            $join = [['type' => 'LEFT', 'join_table' => 'quotation_hotel_details', 'condition' => 'quotations.id = quotation_hotel_details.quotation_id'],];
            $where = ' quotations.id = '.$this->input->post('id');
            $select = 'quotations.*,quotation_hotel_details.hotel_category,quotation_hotel_details.hotel_name,quotation_hotel_details.hotel_id,quotation_hotel_details.hotel_room_details,quotation_hotel_details.night';
            $data['quotation'] = $this->common_model->get_data('quotations','', '', $select,$where,'', $count = false,$join);
            //echo '<pre>';print_r($data['quotation']);exit;
            $data['sites_table_data'] = $this->db->get('sites')->result_array();
             $data['hotels'] = $this->db->where('quotation_id', $this->input->post('id'))->get('quotation_hotel_details')->result_array();
            $data['saved_hotels'] = $this->db->where('quotation_id', $this->input->post('id'))->get('quotation_hotel_details')->result_array();
            $response = ['response' => 's', 'details' => $data, 'msg' => '<div class="alert alert-success">Quotation Found Successfully!</div>'];
        }
        echo json_encode($response);
        exit;
    }
    
    public function get_by_id(){
        //echo '<pre>';print_r($this->input->post());exit;
        $table_name = $this->input->post('tname');
        $where = $table_name.'.id = '.$this->input->post('id');
        $select = '*';
        $data['result'] = $this->common_model->get_data($table_name,'', '', $select,$where,'', $count = false);
        $response = ['response' => 's', 'details' => $data, 'msg' => ''];
        echo json_encode($response);
        exit;
    }
    public function getItineraryContent()
    {   
        $enquiry_no = $this->input->get('enquiry_no');

        $sql = "
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = ?
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        ";

        $result = $this->db->query($sql, [$enquiry_no])->result();

        $firstDay = '';
        $lastDay  = '';

        if (!empty($result)) {
            foreach ($result as $row) {
                $decodedContent = urldecode($row->content); 
                $decodedContent = html_entity_decode($decodedContent, ENT_QUOTES, 'UTF-8');

                if ($row->day == 'start') {
                    $firstDay = $decodedContent;
                }
                if ($row->day == 'last') {
                    $lastDay = $decodedContent;
                }
            }
        }

        echo json_encode([
            'status'   => 'success',
            'firstDay' => $firstDay,
            'lastDay'  => $lastDay
        ]);
    }
    public function generate_itinerary()
    {
        $check_in_time = $this->input->post('arrival_time');
        $check_out_time = $this->input->post('departure_time');
        $check_in_date = $this->input->post('check_in');
        $check_out_date = $this->input->post('check_out');

        $this->db->where('city', 'Almaty');
        $this->db->where('category', 'sitescene');
        $query = $this->db->get('sites'); 
        $sites = $query->result_array();

        if (empty($sites)) {
            echo "No sites found in the database.";
            return;
        }

        $siteDescriptions = array_map(function($site) {
            return $site['id'] . '. ' . $site['site_name'] . 
            ' (Duration: ' . $site['duration_hours'] . 'h, Days: ' . $site['days_of_operation'] . 
            ', Location ID: ' . $site['location_ids'] . ', Start Time: ' . $site['departing_time_from_hotel'] .
            ', Entry Fee: ' . $site['entry_ticket_fee'] . ', Child Fee: ' . $site['child_entry_ticket_fee'] . ')';
        }, $sites);
        $siteList = implode(", ", $siteDescriptions);

        $start = new DateTime($check_in_date);
        $end = new DateTime($check_out_date);
        $end->modify('+1 day'); // include checkout day
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($start, $interval, $end);

        $days = [];
        foreach ($dateRange as $index => $date) {
            $dayNum = $index + 1;
            $dayName = $date->format('l'); // Monday, Tuesday etc
            $dateStr = $date->format('Y-m-d');
            $days[] = [
                'day' => $dayNum,
                'date' => $dateStr,
                'day_name' => $dayName
            ];
        }

        $dayConditions = [];
        foreach ($days as $day) {
            if ($day['day'] === 1 || $day['day'] === count($days)) {
                $dayConditions[] = "Day {$day['day']} ({$day['date']}) is for location_id = 0 (inside city only)";
            } else {
                $dayConditions[] = "Day {$day['day']} ({$day['date']}) allows 1 site with location_id != 0 (outside city) first, then location_id = 0 if time remains.";
            }
        }

        $dayLogic = implode("\n- ", $dayConditions);
        
        $prompt = <<<EOD
        You are a travel itinerary planner for tourists visiting Kazakhstan.

        Generate a JSON itinerary using the following site list:
        $siteList

        Constraints:

        1. **Travel Dates**:
        - Check-in: $check_in_date at $check_in_time
        - Check-out: $check_out_date at $check_out_time

        2. **General Rules**:
        - Activities must not overlap.
        - Insert a **1-hour rest gap** between activities.
        - Include `departing_time_from_hotel`, `start_time`, `end_time`, and `duration_hours` in each activity.
            - Each activity must start at or after departing_time_from_hotel, which is the same as start_time
            - No activity should begin before start_time.

        3. **Day 1 (Arrival Day)**:
        - If check-in time is after 17:00 (5:00 PM), skip Day 1 entirely — no activity should be scheduled.
        - If check-in time is before 08:00 AM, start the first activity from **10:00 AM** onward.
        - If check-in time is between 08:00 and 17:00:
            - Allow Day 1 activities only if (check-in time + 2 hours) is before 22:00.
            - First activity must start after (check-in + 2 hours).
            - No activity should end after 22:00.


        4. **Middle Days (Day 2 to Day N-1)**:
        - Activities must start no earlier than **10:00 AM**.
        - Activities must end no later than **10:00 PM**.

        5. **Last Day (Checkout Day)**:
        - If check-out time is before 15:00 (3:00 PM), do not schedule any activities on the last day. Skip Last Day completely.
        - If check-out time is **at or after 15:00 (3:00 PM)**:
            - Activities may be scheduled only if they can **end at least 5 hours before check-out time**.
            - No activity should end later than **(check-out time - 5 hours)**.
            
        6. **Day Tagging**:
        - Include `day`, `date`, and list of `activities` for each day.
        - Ensure dates are sequential from check-in to check-out.

        - $dayLogic

        Output format: JSON array. Each object must have:

        ```json
        {
        "day": 1,
        "date": "YYYY-MM-DD",
        "activities": [
            {
            "id": 0,
            "site_name": "...",
            "start_time": "HH:MM",
            "end_time": "HH:MM",
            "duration_hours": 0,
            "departing_time_from_hotel": "HH:MM",
            "entry_ticket_fee": 0,
            "child_entry_ticket_fee": 0,
            "day_of_operation_used": "Monday"
            }
        ]
        }
        EOD;

        $apiKey = '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';
        $endpoint = 'https://api.openai.com/v1/chat/completions';

        $postData = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful travel planner. Respond only with valid JSON.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer ' . $apiKey
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['choices'][0]['message']['content'])) {
            $content = $result['choices'][0]['message']['content'];

            $cleaned = trim($content);
            $cleaned = preg_replace('/^```(json)?/i', '', $cleaned); 
            $cleaned = preg_replace('/```$/', '', $cleaned);       
            $cleaned = str_replace(['“', '”'], '"', $cleaned);

            $itinerary = json_decode($cleaned, true);

            if (json_last_error() === JSON_ERROR_NONE) 
            {
                header('Content-Type: application/json');
                echo json_encode($itinerary);
            } else {
                http_response_code(500);
                echo json_encode([
                    'error' => 'JSON parsing failed',
                    'raw_response' => $content,
                    'error_message' => json_last_error_msg()
                ]);
            }

        } else {
            echo "❌ Failed to generate itinerary: <pre>" . print_r($result, true) . "</pre>";
        }
    }
    
}
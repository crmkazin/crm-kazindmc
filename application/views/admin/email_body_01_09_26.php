
<?php 
$transportation_cost = json_decode($transportationData, true);
$saved_created_date = $saved_created_date ?? '';
$cutoff_date = '2026-03-01';
$itinerary_entry_ticket_html = '';
if (!empty($itinerary_entry_ticket) && is_array($itinerary_entry_ticket)) 
    {
        $unique_tickets = array_unique($itinerary_entry_ticket);
    foreach ($unique_tickets as $ticket) {
        $itinerary_entry_ticket_html .= '<li style="position:relative; color:#555555; margin-bottom:6px;">' . $ticket . '</li>';
    }
}
$daywise_transfer_data = json_decode($daywise_transfer_data, true);
$routewise_transfer_data = json_decode($routewise_transfer_data, true);

if (!is_array($daywise_transfer_data)) {
    $daywise_transfer_data = [];
}
if (!is_array($routewise_transfer_data)) {
    $routewise_transfer_data = [];
}

/* =====================================================
   STEP 1: Collect ALL train IDs (daywise + routewise)
===================================================== */
$train_ids = [];

foreach ($daywise_transfer_data as $item) {
    if (!empty($item['transfer_mode']) && $item['transfer_mode'] === 'train') {
        $train_ids[] = $item['train_id'];
    }
}

foreach ($routewise_transfer_data as $item) {
    if (!empty($item['transfer_mode']) && $item['transfer_mode'] === 'train') {
        $train_ids[] = $item['train_id'];
    }
}

$train_ids = array_unique($train_ids);

/* =====================================================
   STEP 2: Fetch Train Schedules (ONLY ONCE)
===================================================== */
$schedules = [];

if (!empty($train_ids)) {
    $this->db->select('train_schedule.*, train.train_name');
    $this->db->from('train_schedule');
    $this->db->join('train', 'train.id = train_schedule.train_id', 'left');
    $this->db->where_in('train_schedule.id', $train_ids);
    $query = $this->db->get();

    foreach ($query->result() as $row) {
        $schedules[$row->id] = $row;
    }
}

/* =====================================================
   STEP 3: Build Output
===================================================== */
$output = '';

/* =========================
   DAYWISE TRAIN DATA
========================= */
$count = count($daywise_transfer_data);

for ($i = 0; $i < $count; $i++) {

    $item = $daywise_transfer_data[$i];

    if (empty($item['transfer_mode']) || $item['transfer_mode'] !== 'train') {
        continue;
    }

    $day         = $item['day'];
    $train_id    = $item['train_id'];
    $ticket_type = $item['type'] ?? '';

    if (!isset($schedules[$train_id])) {
        $output .= "<li>Day $day: Train details not found (ID: $train_id)</li>";
        continue;
    }

    $schedule     = $schedules[$train_id];
    $train_name   = $schedule->train_name;
    $train_number = $schedule->train_number;
    $departing    = $schedule->departing_station;
    $arrival      = $schedule->arrival_station;

    $ticket_label = ucwords(str_replace('_', ' ', $ticket_type));

    // Combine same train for next day
    $combined = false;

    if ($i + 1 < $count) {
        $next = $daywise_transfer_data[$i + 1];

        if (!empty($next['transfer_mode']) && $next['transfer_mode'] === 'train') {

            $next_train_id = $next['train_id'];
            $next_ticket   = $next['type'] ?? '';

            if (isset($schedules[$next_train_id])) {
                $next_schedule = $schedules[$next_train_id];

                if ($next_schedule->train_name == $train_name && $next_ticket == $ticket_type) {

                    $next_departing = $next_schedule->departing_station;
                    $next_arrival   = $next_schedule->arrival_station;

                    $output .= "
                        <li style='color:#555; margin-bottom:6px;'>
                            <i class='fa fa-train'></i> 
                            $train_name ($ticket_label) – 
                            $departing → $arrival AND $next_departing → $next_arrival
                            <strong>(subject to availability)</strong>
                        </li>
                    ";

                    $combined = true;
                    $i++; // skip next
                }
            }
        }
    }

    if (!$combined) {
        $output .= "
            <li style='color:#555; margin-bottom:6px;'>
                <i class='fa fa-train'></i> 
                Day $day: 
                $train_name ($train_number) ($ticket_label) – 
                $departing → $arrival
                <strong>(subject to availability)</strong>
            </li>
        ";
    }
}

/* =========================
   ROUTEWISE TRAIN DATA
========================= */

foreach ($routewise_transfer_data as $item) {

    if (empty($item['transfer_mode']) || $item['transfer_mode'] !== 'train') {
        continue;
    }

    $day         = $item['day'];
    $train_id    = $item['train_id'];
    $ticket_type = $item['ticket_type'] ?? '';
    $from_city   = $item['from_city'] ?? '';
    $to_city     = $item['to_city'] ?? '';
    $depart      = $item['train_depart'] ?? '';
    $arrive      = $item['train_arrive'] ?? '';

    if (!isset($schedules[$train_id])) {
        $output .= "<li>Day $day: Train not found (ID: $train_id)</li>";
        continue;
    }

    $schedule     = $schedules[$train_id];
    $train_name   = $schedule->train_name;
    $train_number = $schedule->train_number;

    $ticket_label = ucwords(str_replace('_', ' ', $ticket_type));

    $output .= "
        <li style='color:#555; margin-bottom:6px;list-style-type: disc;'>
            <i class='fa fa-train'></i> 
            Day $day: 
            $train_name ($train_number) ($ticket_label) – 
            $from_city → $to_city 
            <strong>(subject to availability)</strong>
        </li>
    ";
}

$flight_details = '
<table width="100%" bgcolor="#d6d8d9" style="background-color: #d6d8d9; border-collapse: collapse;">
    <tr>
        <td class="title" bgcolor="#d6d8d9" style="padding: 12px 20px; background-color: #d6d8d9; text-align: center;">
            <h4 style="padding: 0; margin: 0; color: red; text-decoration: none; text-transform: capitalize;">FLIGHT ENVISAGED</h4>
        </td>
    </tr>
     <tr bgcolor="#ffffff"><td height="3"></td></tr>
    <tr>
        <td style="padding:5px 12px;">
            <table width="100%" class="flight-wrapper" style="border-collapse: collapse;">
                <!-- ARRIVAL CARD ROW -->
                <tr class="flight-card from">
                    <td class="card-header" bgcolor="#ffffff" style="background: #ffffff; border: 1px solid #ccc; padding: 10px 15px; width: 24%; vertical-align: top;">
                        <i class="fa-solid fa-plane-arrival"></i>
                        <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize; display: inline;">Arrival</h4>
                    </td>
                    <td width="76%" bgcolor="#ffffff" style="background: #ffffff; border: 1px solid #ccc; padding: 10px 15px;">';
if ($this->input->post('arrival_airline') != '') {
    $flight_details .= '
                        <table width="100%" class="flight-row" style="border-collapse: collapse;">
                            <tr>
                                <td width="50%" class="label" style="font-size: 12px; color: #555; text-transform: uppercase;">Airline:</td>
                                <td width="50%" align="right" class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;' . $this->input->post('arrival_airline') . '</td>
                            </tr>
                        </table>';
}
    $flight_details .= '
                        <table width="100%" class="flight-row" style="border-collapse: collapse;">
                            <tr>
                                <td width="50%" class="label" style="font-size: 12px; color: #555; text-transform: uppercase;">Time:</td>
                                <td width="50%" align="right" class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;' . ucfirst($this->input->post('arrival_time')) . '</td>
                            </tr>
                        </table>
                    </td>
                </tr>';

// ========== DEPARTURE CARD ROW ==========
$flight_details .= '
    <tr class="flight-card to">
        <td class="card-header" bgcolor="#ffffff" style="background: #ffffff; border: 1px solid #ccc; padding: 10px 15px; width: 24%; vertical-align: top;">
            <i class="fa-solid fa-plane-departure"></i>
            <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize; display: inline;">Departure</h4>
        </td>
        <td width="76%" bgcolor="#ffffff" style="background: #ffffff; border: 1px solid #ccc; padding: 10px 15px;">';
if ($this->input->post('departing_airline') != '') {
    $flight_details .= '
            <table width="100%" class="flight-row" style="border-collapse: collapse;">
                <tr>
                    <td width="50%" class="label" style="font-size: 12px; color: #555; text-transform: uppercase;">Airline:</td>
                    <td width="50%" align="right" class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;' . $this->input->post('departing_airline') . '</td>
                </tr>
            </table>';
}
$flight_details .= '
            <table width="100%" class="flight-row" style="border-collapse: collapse;">
                <tr>
                    <td width="50%" class="label" style="font-size: 12px; color: #555; text-transform: uppercase;">Time:</td>
                    <td width="50%" align="right" class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;' . ucfirst($this->input->post('departing_time')) . '</td>
                </tr>
            </table>
        </td>
    </tr>
            </table>
        </td>
    </tr>
</table>';


$enquiry_id = $postData['enquiry_id'];
$this->db->select('company_details_id');
$this->db->where('id', $enquiry_id);

$enquiryData = $this->db
    ->get('enquiry')
    ->row_array();
    
$companyDetailsId = $enquiryData['company_details_id'] ?? null;

$agentData = [];

if ($companyDetailsId) {
    $this->db->select('contact_person, contact_person_number, contact_person_isd_code');
    $this->db->where('company_id', $companyDetailsId);

    $agentData = $this->db
        ->get('company_details')
        ->row_array();
}

$savedAgentMobile = preg_replace(
    '/[^0-9]/',
    '',
    (string) ($agentData['contact_person_number'] ?? '')
);

$savedAgentIsd = preg_replace(
    '/[^0-9]/',
    '',
    (string) ($agentData['contact_person_isd_code'] ?? '')
);

if (
    $savedAgentIsd !== '' &&
    strpos($savedAgentMobile, $savedAgentIsd) === 0 &&
    strlen($savedAgentMobile) > strlen($savedAgentIsd) + 5
) {
    $savedAgentMobile = substr(
        $savedAgentMobile,
        strlen($savedAgentIsd)
    );
}

$short_itinerary='<table class="title" width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="width:100%;background-color:#d6d8d9;padding:12px 20px;border-collapse:collapse;">
                      <tr bgcolor="#ffffff"><td bgcolor="#ffffff" width="100%" height="1" style="padding: 5px;"></td></tr>
                
                    <tr>
                        <td align="center" style="padding: 10px 0 0;">
                            <h4 style="margin:0;color:red;text-transform:capitalize;">
                                SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights + 1).' DAYS
                            </h4>
                        </td>
                    </tr>
                
                    <tr>
                        <td align="center" style="padding: 10px 0 10px;">
                            <a href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '"
                               target="_blank"
                               style="color:blue;font-weight:bold;">
                                Click here for detailed itinerary.
                            </a>
                        </td>
                    </tr>
                    <tr bgcolor="#ffffff"><td bgcolor="#ffffff" width="100%" height="1" style="padding: 3px;"></td></tr>
                
                </table>';


if($postData['guideyes'] == 'yes'){
    $guide = $postData['driver_cum_guide'] == 'guide' ? 'Guide' : 'Driver Cum Guide';
}else{
    $guide = 'Driver';
}

if(!empty($vehicle_name))
{
    $vehicle_name = $vehicle_name;
}else{
    $vehicle_name = 'No Vehicle';
}

$country_lower = strtolower($country);
if ($country_lower === 'georgia') {
    $time_text = '9 Hrs (10AM – 7PM Only)';
} elseif ($country_lower === 'uzbekistan' || $country_lower === 'azerbaijan') {
    $time_text = '10 Hrs (10AM – 8PM Only)';
} else {
    // Default for Kazakhstan and any other country
    $time_text = '12 Hrs (10AM – 10PM Only)';
}
    
    $inclusions=' <table width="100%" cellpadding="10" cellspacing="0" border="0" bgcolor="#d6d8d9" style="background:#d6d8d9; background-color:#d6d8d9;">';
    
    $inclusions .='<tr><td class="title" style=" background-color: #d6d8d9; text-align: center;">
                    <h4 style="padding: 12px 20px 0px 20px; margin: 0; color:red; text-decoration: none; text-transform: capitalize;">ABOVE PRICE INCLUDES</h4>
                    </td></tr>';

    $inclusions.='<tr><td style="padding-top:0;">
                <table class="our-inclusion" width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#d6d8d9" style="background-color:#d6d8d9;padding: 14px;">';
                    if($this->input->post('hotel_status')=="yes")
            {
                $inclusions.='<tr bgcolor="#ffffff" style=" background-color: #fff; margin: 10px 0px;width:100%;" >
                <td width="100%" style="width:100%;padding:10px 15px;border:solid 1px #ccc;">
                <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Stay :</h4>
                <p style="padding: 0; margin: 0;display: inline;color:#555555;">As Mentioned Above</p>';
                if (strtolower($country) == 'uzbekistan') {
                    $inclusions.='<ul style="margin:0; padding-left:20px;"><li style="position:relative;  color:#555555; margin-bottom:6px;">Tourist tax is included.</li></ul>';
                }elseif(strtolower($country) == 'azerbaijan'){
                    $inclusions.='<ul style="margin:0; padding-left:25px;"><li style="position:relative;  color:#555555; margin-bottom:6px;">Municipality tax is included.</li></ul>';
                }
                    $inclusions.='</td></tr>
                    <tr><td  style="padding:0;height:6px;">&nbsp;</td></tr>';
                }

    $inclusions.='<tr  class="inclusion-item" bgcolor="#ffffff" style="background-color: #fff;margin: 0px 0px 10px 0px;width:100%;">
                         <td width="100%" class="box" bgcolor="#ffffff"style="padding: 15px 15px 7px 15px;border-left:1px solid #cccccc;background:#ffffff;background-color:#ffffff;">
                               
                                <h4 style=" margin: 0px 0px;">Transportation & Guide Services</h4>
                                <ol style="margin:0px 0;padding-left:25px;">';?>
                                <?php 
                                  $vehicle_links = [];
                                    if (!empty($transportation_cost) && (is_array($transportation_cost) || is_object($transportation_cost))) {
                                        foreach ($transportation_cost as $d) {
            
                                            $vehicle_links[] = '<a href="'.base_url('transport-details/'.base64_encode($d['transport_id'])).'" 
                                            target="_blank" 
                                            style="color:#555555; text-decoration:none; border-bottom:1px solid blue;">
                                            '.$d['vehicle_name'].'</a>';
                                        }
                                    }
            
                                    $vehicle_names = implode(', ', $vehicle_links);
                                 ?>  
                                    <?php 
                                    $inclusions .= '<li style="position:relative;    list-style-type: disc; color:#555555; margin-bottom:6px;">
                                    All transfers & sightseeing by private vehicle (' . ($vehicle_name ? $vehicle_names : $vehicle_name) . ') for ' . $time_text . '
                                    </li>
                                    <li style="position:relative;    list-style-type: disc;  color:#555555; margin-bottom:6px;">Airport – hotel – airport transfers</li>';
                                   
                                    if (strtolower($country) == 'kazakhstan') {
                                        $inclusions.='<li style="position:relative;    list-style-type: disc;  color:#555555; margin-bottom:6px;">Dinner Transfers Only</li>';
                                    }
                                    $inclusions.='<li style="position:relative;    list-style-type: disc;  color:#555555; margin-bottom:6px;">All transfers & sightseeing include services of an English-speaking '.$guide.'.</li>';
                                    
                                    if (strtolower($country) != 'georgia') {
                                        $inclusions.='<li style="position:relative;    list-style-type: disc;  color:#555555; margin-bottom:6px;">Airport meet & greet by our English-speaking staff.</li>';
                                    }
                                
                                if (!empty($postData['luggage_vehicle']))   {
                                     $inclusions.='<li style="position:relative;     list-style-type: disc; color:#555555; margin-bottom:6px;">• Luggage Vehicle</li>';
                                    }
                                    
                                   if (in_array(strtolower($country), ['georgia','uzbekistan'])) {
                                        $inclusions.=  $output;
                                    }
                                $inclusions.='</ol>
                            </td>
                        </tr>
                        <tr><td  style="padding:0;height:6px;">&nbsp;</td></tr>';

            $meal_type_daywise_price = $postData['meal_type_daywise_price'] ?? '';

            $meal_data = json_decode($meal_type_daywise_price, true);

            $meal_counts = [];

            if (is_array($meal_data)) {

                foreach ($meal_data as $day => $meals) {

                    if (!is_array($meals)) {
                        continue;
                    }

                    foreach ($meals as $meal_type => $meal_values) {

                        // -----------------------------------
                        // CASE 1: Meal IDs inside array
                        // -----------------------------------
                        if (is_array($meal_values)) {

                            $has_numeric_keys = false;

                            foreach ($meal_values as $key => $val) {

                                if (is_numeric($key)) {
                                    $has_numeric_keys = true;

                                    if (isset($meal_counts[$key])) {
                                        $meal_counts[$key]++;
                                    } else {
                                        $meal_counts[$key] = 1;
                                    }
                                }
                            }

                            // -----------------------------------
                            // CASE 2: Meal type only
                            // -----------------------------------
                            if (!$has_numeric_keys) {

                                $meal_type_clean = strtolower(
                                    str_replace(' ', '_', trim($meal_type))
                                );

                                if (isset($meal_counts[$meal_type_clean])) {
                                    $meal_counts[$meal_type_clean]++;
                                } else {
                                    $meal_counts[$meal_type_clean] = 1;
                                }
                            }

                        } else {

                            // -----------------------------------
                            // CASE 3: Direct meal type string
                            // -----------------------------------
                            $meal_type_clean = strtolower(
                                str_replace(' ', '_', trim($meal_type))
                            );

                            if (isset($meal_counts[$meal_type_clean])) {
                                $meal_counts[$meal_type_clean]++;
                            } else {
                                $meal_counts[$meal_type_clean] = 1;
                            }
                        }
                    }
                }
            }

        $inclusions.='
            <tr class="inclusion-item" bgcolor="#ffffff" style="width:100%;">
                <td class="box" width="100%" style="padding: 15px;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff; bgcolor="#ffffff"">
                    <h4 style=" margin: 0px 0px;">Entrance & Activities</h4>
                    <ul style="margin:0; padding-left:25px;">
                    '.$itinerary_entry_ticket_html.'
                    '.$day_wise_entrance.'
                         ' . $activites;
                    if (!empty($postData['final_toll_price']) && $postData['final_toll_price'] > 0) {
                        $inclusions .= '<li style="color:#555555;">Toll Included</li>';
                    }
                    $inclusions .= '
                    </ul>
                </td>
            </tr>
            <tr><td  style="padding:0;height:6px;">&nbsp;</td></tr>';
                     
                
        if($this->input->post('hotel_status') == "yes" || !empty($meal_counts)) {
        $inclusions .= '<tr class="inclusion-item" bgcolor="#ffffff"  style=" background-color: #fff; margin: 10px 0px;width:100%;">
                    <td class="box" width="100%" style="padding: 15px;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff !important;">
                        <h4 style="padding-bottom: 0; margin: 0px 0px;">Meals</h4>
                        <ul style="margin:0; padding-left:25px;">';
                            if($this->input->post('hotel_status') == "yes") {
                                    $inclusions .= "<li style='position:relative; color:#555555; margin-bottom:6px; margin-left:0px;'>Breakfast at your hotel.</li>";
                                }
                                $meal_ids = array_keys($meal_counts);
    
                                if (!empty($meal_ids)) {
                                    $query = $this->db
                                        ->select('*')
                                        ->from('meal_per_person_cost')
                                        ->where_in('id', $meal_ids)
                                        ->where('status', 'active')
                                        ->get();
                                
                                    $result = $query->result_array();
                                } else {
                                    $result = [];
                                }
    
                                if (empty($saved_created_date) || (strtotime($saved_created_date) && date('Y-m-d', strtotime($saved_created_date)) > $cutoff_date)) {
                                    foreach ($meal_counts as $type => $count) {
                                        if ($count > 0) {
    
                                            foreach ($result as $row) {
    
                                                if ($row['id'] == $type) {
    
                                                    $buffetId   = base64_encode($row['id']);
                                                    $buffetName = ucfirst($row['Buffet']);
                                                    $remarks    = trim($row['remarks']);
                                                    $cType    = trim($row['ctype']);
    
                                                    // Check if remarks exist
                                                    if (!empty($remarks)) {
    
                                                        // Create hyperlink only if remarks available
                                                        $url = base_url("meal-menu/" . $buffetId);
    
                                                        $buffetDisplay = '<a href="'.$url.'" target="_blank" 
                                                            style="color:#000; text-decoration:none; border-bottom:1px solid #007bff;" title="click on the link to view meal menu">
                                                            '.$buffetName.'</a>';
    
                                                    } else {
    
                                                        $buffetDisplay = '<span style="font-weight:500;">'.$buffetName.'</span>';
                                                    }
                                                    $email_summary = $count . ' X ' . ucfirst($cType) . ' ' . $buffetDisplay;
                                                    $inclusions .= "<li style='position:relative;color:#555;margin-bottom:6px;'>$email_summary</li>";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    foreach ($meal_counts as $meal_id => $count) {
                                        if ($count > 0) {
                                            // Find the matching meal record
                                            $buffet_name = null;
                                            foreach ($result as $row) {
                                                if ($row['id'] == $meal_id) {
                                                    $buffet_name = ucfirst($row['Buffet']);
                                                    break;
                                                }
                                            }
                                            if ($buffet_name) {
                                                $email_summary = $count . ' - ' . $buffet_name;
                                                $inclusions .= "<li style='position:relative; color:#555555; margin-bottom:6px;'>$email_summary</li>";
                                            }
                                        }
                                    }
                                }
    
                        $inclusions.='</ul>
                    </td>
                </tr>
                <tr><td  style="padding:0;height:6px;">&nbsp;</td></tr>'; 
            }
                
            $inclusions.='<tr style=" background-color: #fff;width:100%;  margin: 10px 0px;" bgcolor="#ffffff">
                    <td width="100%" class="box" style="padding: 15px;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff !important;">
                        <h4 style=" margin: 0px 0px;display: block;">Complimentary Services</h4>
                        <ol style="margin:0;padding-left:25px;">';
                        $mandatory_services_json = $form['mandatory_services'] ?? '[]';
                        $mandatory_services = json_decode($mandatory_services_json, true);
                            if (!empty($mandatory_services)) {
                               
                                 if (isset($mandatory_services[0]['service'])) {
                                    $service_text1 = rtrim(explode("|", $mandatory_services[0]['service'])[0], "_");
                                    $price1        = explode("|", $mandatory_services[0]['service'])[1];
                                    $qnty1         = $mandatory_services[0]['qnty'];
                                }
    
                                if (isset($mandatory_services[1]['service'])) {
                                    $service_text2 = rtrim(explode("|", $mandatory_services[1]['service'])[0], "_");
                                    $price2        = explode("|", $mandatory_services[1]['service'])[1];
                                    $qnty2         = $mandatory_services[1]['qnty'];
                                }
    
                                if (isset($mandatory_services[2]['service'])) {
                                    $service_text3 = rtrim(explode("|", $mandatory_services[2]['service'])[0], "_");
                                    $price3        = explode("|", $mandatory_services[2]['service'])[1];
                                    $qnty3         = $mandatory_services[2]['qnty'];
                                }
    
                                if (isset($mandatory_services[3]['service'])) {
                                    $service_text4 = rtrim(explode("|", $mandatory_services[3]['service'])[0], "_");
                                    $price4        = explode("|", $mandatory_services[3]['service'])[1];
                                    $qnty4         = $mandatory_services[3]['qnty'];
                                }
    
    
                                if (isset($mandatory_services[2]['service'])) $inclusions .= "<li style='list-style-type: disc;color:#555;margin-bottom:6px;'>$service_text3</li>";
                                if (isset($mandatory_services[1]['service'])) $inclusions .= "<li style='list-style-type: disc;color:#555;margin-bottom:6px;'>$service_text2</li>";
                                if (isset($mandatory_services[3]['service'])) $inclusions .= "<li style='list-style-type: disc;color:#555;margin-bottom:6px;'>$service_text4</li>";
                                if (isset($mandatory_services[0]['service'])) $inclusions .= "<li style='list-style-type: disc;color:#555;margin-bottom:6px;'>$service_text1</li>";

                            } else {
                                $inclusions .="<li style='position:relative;  color:#555555; margin-bottom:6px;list-style-type: disc;'>No mandatory services provided.</li>";
                            }
                        $inclusions.='</ol>
                    </td>
                </tr>';
       $inclusions.='
    </table></td></tr>';
    
    $inclusions.='
</table>';
$href = ($country === 'kazakhstan')
    ? 'href="' . base_url('assets/additional_activities.pdf') . '" target="_blank"'
    : '';
$activities_html='<br><span><b style="font-size: 18px;"><i class="fas fa-tasks"></i> Click here for <a ' . $href . '>Additional Activities.</b></a></span><br><br>';
$fremark = $postData['fremark'] 

?>
<!DOCTYPE html><html><head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- <style>
       @media screen and (max-width:576px) {
        
            .flight-card{
                width:100% !important;
                margin-bottom: 5px;
            }
            tr.responsive-row {
            display: flex;
            flex-wrap: wrap;
            }
            tr.responsive-row>td{
                width:100% !important;
            }
        }

        th, td {
            padding:5px 5px 3px 5px;
         
        }
 
        .title {
      
            background-color: antiquewhite;
            background-color: #d6d8d9;
            text-align: center;
        }
        label {
            font-weight: bold;
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
        
        .box {
            width: 100%;
           
        }

        .box h4 {
            padding-left: 12px;
            padding-top: 12px;
        }

        .activites-item {
            background: #d6d8d9;
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

        .btn-container {
            text-align: center;
            margin-top: 40px;
        }

        #copyBtn {
            background: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 24px;
            border: none; 
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        #copyBtn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0,0,0,0.15);
        }

        #copyBtn:active {
            transform: translateY(1px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
    </style> -->
    </head>

    <body style="max-width:1200px; margin:50px auto;">
        <div class="table-container" style="p:0; margin:0;" id ="emailBody">
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                   style="background-color:#d6d8d9;border-collapse:collapse;">
                <tr>
                    <td width="15%" valign="middle" align="left">
                        <img src="https://crm.kazindmc.com/assets/images/login-logo.png"
                             alt="Logo"
                             width="95"
                             style="display:block;border:0;">
                    </td>
            
                    <td width="85%" valign="middle" align="right"
                        style="font-size:15px;color:#2e3b4e;padding-right:8px;">
            
                    <span style="font-weight:bold;">
                        The Most Trusted, Reliable &amp; Innovative DMC for
                    </span>
                    <br>
        
                    <span style="font-size:10px;color:#ed1e88;">• KAZAKHSTAN</span>
                    &nbsp;&nbsp;
                    <span style="font-size:10px;color:#31448e;">• GEORGIA</span>
                    &nbsp;&nbsp;
                    <span style="font-size:10px;color:#ec1f23;">• AZERBAIJAN</span>
                    &nbsp;&nbsp;
                    <span style="font-size:10px;color:#1ca9c9;">• UZBEKISTAN</span>
                    &nbsp;&nbsp;
                    <span style="font-size:10px;color:#B85C38;">• ARMENIA</span>
                    &nbsp;&nbsp;
                    <span style="font-size:10px;color:#d0a600;">• BELARUS</span>

                </td>
                </tr>
            </table>

            <table style="width:100%;">
               <?php  $check_in_date = date('d M Y', strtotime($enquiry->check_in_date)); 
                 $check_out_date = date('d M Y', strtotime($enquiry->check_out_date)); ?>
                <tr><td colspan="12" align="left">Dear Mr/Ms <?= $this->input->post('agent_name'); ?>,</td></tr>
                <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                <!--<tr><td colspan="12" align="left" style="padding-top: 20px;">Please find given below Commercial Proposal of (<?= ucfirst($country) ?>)<b> No of pax(<?=$total_persons?>)</b> <?php if($total_child > 0){ echo '- ('.$total_adults.' Adult, '.$total_child.' Child)'; } ?> <span style="color: #6060a9;"> <b>For <?= $enquiry->number_of_nights?>N</b>/<b><?=($enquiry->number_of_nights+1)?>D</b></span></td></tr>-->
                
                <tr>
                    <td colspan="12" align="left" style="padding-top: 20px;">
                        Please find given below Commercial Proposal of (<?= ucfirst($country) ?>)
                        <b> No of pax(<?= $total_persons ?>)</b> 

                        <?php if ($total_child > 0) { ?>
                            - (<?= $total_adults ?> Adult, <?= $total_child ?> Child<?php if ($enquiry->child_age != '') { ?> - Age: <?= str_replace(['[', ']'], '', $enquiry->child_age); ?><?php } ?>)
                        <?php } ?>

                        <span style="color: #6060a9;">
                            <b>For <?= $enquiry->number_of_nights ?>N</b>/
                            <b><?= ($enquiry->number_of_nights + 1) ?>D</b>
                        </span>
                    </td>
                </tr>         
                <tr><td colspan="12" align="left" style="padding-top: 10px;"><b>Check In:</b> <?= $check_in_date ?></td></tr>
                <tr><td colspan="12" align="left" style="padding-top: 10px;"><b>Check Out:</b> <?= $check_out_date ?></td></tr>
                <?php if($fremark !=''){?>
                <tr>
                    <td colspan="12" style="padding:0;">
                        <div style="background-color:#d6d8d9;padding:3px 3px;display:inline-block;">
                            <div style="background-color:#fff;padding:5px 8px;display:inline-block;line-height:20px;word-break:break-word;">
                                <strong style="color:#000;">Remark :</strong>
                                <span><?= $fremark; ?></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr><td colspan="12" align="left" style="padding-top: 14px;"><?= $enquiry->number_of_nights;?>N Land Package (<?= (($this->input->post('hotel_status')=="yes")?'<label style="color:red;">With Hotel</label>':'<label style="color:red;">Without Hotel</label>')?>)</td></tr>
                <?php
                    // Build note items conditionally
                    $note_parts = [];
                    
                    // Hotel and room category only if hotel is enabled
                    if ($this->input->post('hotel_status') == "yes") {
                        $note_parts[] = '<u>hotel name</u>';
                        $note_parts[] = '<u>room category</u>';
                    }
                    
                    // Vehicle is always included if links exist (or you can check $vehicle_links)
                    if (!empty($vehicle_links)) {
                        $note_parts[] = '<u>vehicle name</u>';
                    }
                    
                    // Meal name only if meals exist
                    if (!empty($meal_counts)) {
                        $note_parts[] = '<u>meal</u>';
                    }
                    
                    // Only show the note if there is at least one item
                    if (!empty($note_parts)) {
                        // Format: "A, B or C"
                        $last = array_pop($note_parts);
                        if (!empty($note_parts)) {
                            $note_text = implode(', ', $note_parts) . ' or ' . $last;
                        } else {
                            $note_text = $last;
                        }
                        ?>
                    <tr><td>
                        <p style="font-size:14px; color:#555; margin-bottom:6px;margin-top:4px;background:#f9f9f9; padding:6px 10px; border-left:3px solid #6060a9;">
                            <strong>📌 Note:</strong> Click on <?php echo $note_text; ?> to view pictures.
                        </p>
                    </td></tr>
                <?php } ?>
                <tr><td colspan="12" align="left"><?= $cost_html;?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $inclusions; ?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $flight_details; ?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $short_itinerary; ?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $only_itinerary_html; ?></td></tr>
                <br>
                <tr><td colspan="12" align="left"><?php echo $activities_html; ?></td></tr>
                
            <tr class="responsive-row">
                    <td colspan="12" bgcolor="#d6d8d9" style="background-color:#d6d8d9;padding:20px 20px 5px 20px;"  align="left"><span style="padding-left:10px;color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br><?= $this->input->post('exclusions')?>
                
                </td>
                </tr>
                <tr>
                    <td colspan="12" bgcolor="#d6d8d9"  style="background-color:#d6d8d9;padding:20px 20px 2px 20px;"  align="left"><span style="padding-left:10px;color:#1974D2;text-decoration:underline;font-weight:bold;
                         display: inline-block;">IMPORTANT NOTES:</span><br>
                         
                         
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:5px;border-collapse:collapse;">
                      
                            <tr>
                                <td style="color:red;">
                                    <ol style="margin-left: 0px;margin-top:10px;margin-right:0px;margin-bottom:0px;">

                                        <li>Above quote is valid for 72 hrs.</li>

                                        <li>Above quote is subject to currency fluctuation.</li>

                                        <li>
                                            This costing is calculated at an ROE of 
                                            1 USD = <?= $postData['roe'] ? $postData['roe'] : $currency->country_currency_value; ?> 
                                            <?= $currency_abbr; ?>.
                                        </li>

                                        <li>
                                            We encourage our partners to conduct due diligence and review hotel feedback online before making any bookings.
                                        </li>

                                        <?php if($country == 'uzbekistan'){ ?>

                                            <li>
                                                Train Tickets (Subject to Availability)
                                                <ol style="list-style-type: lower-roman; padding-left:20px; margin-top:5px;">
                                                    <li>
                                                        If the Afrosiyob (Bullet train) is not available, the Sharq train will be arranged as an alternative.
                                                    </li>
                                                    <li>
                                                        Train tickets can only be booked up to 60 days before the date of travel.
                                                    </li>
                                                </ol>
                                            </li>

                                        <?php } elseif($country == 'kazakhstan'){ ?>

                                            <li>
                                                <b>Blackout Dates:-</b> 
                                                Rates are not valid during blackout dates:
                                                19-27 Feb, 8-14 Mar, 1-4 Apr, 6-11 Apr, 21-26 Apr,
                                                11-15 May, 19-23 May, 27-30 May, 22-29 Jun,
                                                26-30 Jul, 19 - 23 Aug, 02-07 Sep, 15-21 Sep, 29 Sep-03 Oct,
                                                12-16 Oct, 27-30 Oct, 11-13 Nov.
                                            </li>

                                            <li>
                                                Train Tickets (Subject to Availability)
                                            </li>

                                        <?php } ?>
                                        <li>The above proposal is for quotation purposes only. No rooms have been reserved at this stage, and all Hotel bookings are subject to availability at the time of final confirmation.</li>

                                    </ol>
                                </td>
                            </tr>
                        </table>
                        <?= $this->input->post('important_notes')?>
            
                    </td>
                </tr>
                <tr width="100%" bgcolor="#d6d8d9">
            <td width="100%" bgcolor="#d6d8d9"  style="background-color:#d6d8d9;padding-top: 10px;padding-bottom: 10px;padding-left:20px;margin-bottom: 4px;">
               
                <span style="padding-left:10px;color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br><div style="padding-left: 7px;"><?= $this->input->post('cancellation_policy')?></div>
            </td>  
                </tr>  
            </table>
        </div>
    </body>
</html>

<!-- Copy button -->
<?php 
    $email_preview = $this->input->get('email');
?>
<!-- Copy button -->
<div class="btn-container" style="text-align: center; <?= ($email_preview == 'preview') ? 'display:none;' : '' ?>">
    <button id="copyBtn" style="background: #4CAF50; color: white; font-size: 16px; font-weight: 600; margin-bottom: 12px; margin-top: 12px; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s ease;">Copy Email Body</button>
</div>

 <!-- WhatsApp sending section -->
<div class="btn-container" style="text-align:center; margin-top:12px; <?= ($email_preview == 'preview') ? 'display:none;' : '' ?>">
    <form id="whatsappForm" method="post">
        <div style="display:inline-flex; align-items:center; gap:6px; flex-wrap:wrap; justify-content:center;">

            <select id="isd_code" name="isd_code" class="isd_code" style="padding:8px; width:170px; border:1px solid #ccc; border-radius:5px;">
                <option value="">Select ISD</option>

                <?php foreach ($country_isd_codes as $isdRow): ?>

                    <?php
                        $countryName = trim((string) ($isdRow->country ?? ''));
                        $countryCode = trim((string) ($isdRow->country_code ?? ''));
                        $isdDisplay  = trim((string) ($isdRow->isd_codes ?? ''));

                        $isdDigits = preg_replace(
                            '/[^0-9]/',
                            '',
                            $isdDisplay
                        );

                        $savedIsdDigits = preg_replace(
                            '/[^0-9]/',
                            '',
                            (string) ($agentData['contact_person_isd_code'] ?? '')
                        );

                        $selected = (
                            $savedIsdDigits !== '' &&
                            $savedIsdDigits === $isdDigits
                        ) ? 'selected' : '';
                    ?>

                    <option
                        value="<?= html_escape($isdDigits); ?>"
                        <?= $selected; ?>
                    >
                        <?= html_escape($countryName); ?>
                        (+<?= html_escape($isdDigits); ?>)
                    </option>

                <?php endforeach; ?>
            </select>
            <?php //echo html_escape($savedAgentMobile); ?>
            <input type="text" id="mobile_number" class="mobile_number" name="mobile_number" value="<?= html_escape($savedAgentMobile); ?>" placeholder="Enter mobile number" inputmode="numeric" autocomplete="tel" style="padding:8px; width:220px; border:1px solid #ccc; border-radius:5px;">

            <button type="submit" id="sendWhatsAppBtn" style="background:#25D366; color:white; padding:10px 20px; border:none; border-radius:6px; cursor:pointer;">
                <i class="fab fa-whatsapp"></i>
                Send via WhatsApp
            </button>

            <button type="button" id="downloadWordBtn" style="background:#1974D2;color:#fff;padding:10px 20px;border:none;border-radius:6px;cursor:pointer;">
                <i class="fa fa-file-word"></i> Download DOC
            </button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document
    .getElementById('copyBtn')
    .addEventListener('click', function () {

        var emailBodyElement =
            document.getElementById('emailBody');

        if (!emailBodyElement) {
            alert('Email body not found.');
            return;
        }

        var emailBody = emailBodyElement.innerHTML;
        var copyButton = $('#copyBtn');

        var agentName =
            <?= json_encode($this->input->post('agent_name')) ?>;

        var QuotationID =
            <?= json_encode($this->input->post('quotation_id')) ?>;

        var destination =
            <?= json_encode($country) ?>;

        var enquiryId =
            <?= json_encode($this->input->post('enquiry_id')) ?>;

        if (
            !navigator.clipboard ||
            typeof ClipboardItem === 'undefined'
        ) {
            alert(
                'Your browser does not support HTML clipboard copying.'
            );
            return;
        }

        copyButton
            .prop('disabled', true)
            .html(
                '<i class="fa fa-spinner fa-spin"></i> Copying...'
            );

        navigator.clipboard.write([
            new ClipboardItem({
                'text/html': new Blob(
                    [emailBody],
                    {
                        type: 'text/html'
                    }
                ),

                'text/plain': new Blob(
                    [emailBodyElement.innerText],
                    {
                        type: 'text/plain'
                    }
                )
            })
        ]).then(function () {

            /*
            |--------------------------------------------------------------------------
            | Copy successful hone ke baad WhatsApp schedule
            |--------------------------------------------------------------------------
            */

            copyButton.html(
                '<i class="fa fa-spinner fa-spin"></i> Scheduling WhatsApp...'
            );

            $.ajax({
                url:
                    '<?= base_url(
                        "schedule-whatsapp-doc"
                    ) ?>',

                type: 'POST',
                dataType: 'json',

                data: {
                    email_body_html: emailBody,
                    agent_name: agentName,
                    destination: destination,
                    enquiry_id: enquiryId,
                    quote_id: QuotationID,
                    send_now: 0
                },

                success: function (response) {
                    copyButton
                        .prop('disabled', false)
                        .html('Copy Email Body');

                    if (
                        response.status === 'success' ||
                        response.success === true
                    ) {
                        alert(
                            'Email body with design copied successfully.\n\n' +
                            'WhatsApp document scheduled successfully.\n' +
                            'Number: ' +
                            response.masked_mobile +
                            '\n' +
                            'Send time: ' +
                            response.send_at_text
                        );
                    } else {
                        alert(
                            'Email body copied successfully, but WhatsApp ' +
                            'scheduling failed:\n' +
                            (
                                response.message ||
                                'Unknown scheduling error.'
                            )
                        );
                    }
                },

                error: function (xhr, status, error) {
                    copyButton
                        .prop('disabled', false)
                        .html('Copy Emails Body');

                    console.error(xhr.responseText);

                    alert(
                        'Email body copied successfully, but WhatsApp ' +
                        'scheduling request failed: ' +
                        error
                    );
                }
            });

        }).catch(function (error) {
            copyButton
                .prop('disabled', false)
                .html('Copy Emails Body');

            console.error(error);

            alert(
                'Failed to copy email body: ' +
                error
            );
        });
    });

    $(document).on('submit','#whatsappForm',function(e){
        e.preventDefault();

        var emailBodyElement=document.getElementById('emailBody');

        if(!emailBodyElement){
            alert('Email body not found.');
            return;
        }

        var isdCode=$('#isd_code').val();
        var mobileNumber=$('#mobile_number').val().trim();

        if(!isdCode){
            alert('Please select ISD code.');
            $('#isd_code').focus();
            return;
        }

        if(!mobileNumber){
            alert('Please enter mobile number.');
            $('#mobile_number').focus();
            return;
        }

        mobileNumber=mobileNumber.replace(/[^0-9]/g,'');

        if(mobileNumber.length<7||mobileNumber.length>15){
            alert('Please enter a valid mobile number.');
            $('#mobile_number').focus();
            return;
        }

        if(!confirm('Send quotation immediately on WhatsApp?')){
            return;
        }

        var btn=$('#sendWhatsAppBtn');
        var emailBody=emailBodyElement.innerHTML;
        var agentName=<?= json_encode($this->input->post('agent_name')) ?>;
        var quotationId=<?= json_encode($this->input->post('quotation_id')) ?>;
        var destination=<?= json_encode($country) ?>;
        var enquiryId=<?= json_encode($this->input->post('enquiry_id')) ?>;

        btn.prop('disabled',true).html(
            '<i class="fa fa-spinner fa-spin"></i> Sending...'
        );

        $.ajax({
            url:'<?= base_url("schedule-whatsapp-doc") ?>',
            type:'POST',
            dataType:'json',
            data:{
                email_body_html:emailBody,
                agent_name:agentName,
                destination:destination,
                enquiry_id:enquiryId,
                quote_id:quotationId,
                send_now:1,
                isd_code:isdCode,
                mobile_number:mobileNumber
            },
            success:function(response){
                btn.prop('disabled',false).html(
                    '<i class="fab fa-whatsapp"></i> Send via WhatsApp'
                );

                if(response.success===true){
                    alert(
                        response.message||
                        'Quotation sent successfully on WhatsApp.'
                    );

                    $('#documentShareResult').html(
                        '<div style="padding:12px;background:#f4f8ff;border:1px solid #cdddf5;border-radius:6px;">'+
                            '<strong>Document sent:</strong>'+
                            '<a href="'+response.preview_url+'" target="_blank" style="margin-left:10px;">Preview</a>'+
                            '<a href="'+response.download_url+'" target="_blank" style="margin-left:15px;">Download DOC</a>'+
                            '<a href="'+response.pdf_download_url+'" target="_blank" style="margin-left:15px;">Download PDF</a>'+
                        '</div>'
                    );
                }else{
                    alert(
                        response.message||
                        'WhatsApp message could not be sent.'
                    );
                }
            },
            error:function(xhr,status,error){
                btn.prop('disabled',false).html(
                    '<i class="fab fa-whatsapp"></i> Send via WhatsApp'
                );

                console.error('Status:',status);
                console.error('Error:',error);
                console.error('Response:',xhr.responseText);

                alert(
                    'WhatsApp request failed.\n'+
                    (
                        xhr.responseText||
                        error||
                        'Unknown server error'
                    )
                );
            }
        });
    });

    $(document).on('click','#downloadWordBtn',function(){
        var emailBodyElement=document.getElementById('emailBody');

        if(!emailBodyElement){
            alert('Email body not found.');
            return;
        }

        var btn=$(this);
        var originalHtml=btn.html();

        btn.prop('disabled',true).html(
            '<i class="fa fa-spinner fa-spin"></i> Generating...'
        );

        $.ajax({
            url:'<?= base_url("generate-download-doc") ?>',
            type:'POST',
            data:{
                email_body_html:emailBodyElement.innerHTML,
                enquiry_id:<?= json_encode($this->input->post('enquiry_id')) ?>,
                quotation_id:<?= json_encode($this->input->post('quotation_id')) ?>
            },
            xhrFields:{
                responseType:'blob'
            },
            success:function(blob,status,xhr){
                btn.prop('disabled',false).html(originalHtml);

                var contentType=xhr.getResponseHeader('Content-Type')||'';

                if(contentType.indexOf('application/json')!==-1){
                    blob.text().then(function(text){
                        var response=JSON.parse(text);
                        alert(response.message||'DOC file could not be generated.');
                    });
                    return;
                }

                var filename='quotation.doc';
                var disposition=xhr.getResponseHeader('Content-Disposition');

                if(disposition){
                    var utfMatch=disposition.match(/filename\*=UTF-8''([^;]+)/i);
                    var normalMatch=disposition.match(/filename="?([^"]+)"?/i);

                    if(utfMatch&&utfMatch[1]){
                        filename=decodeURIComponent(utfMatch[1]);
                    }else if(normalMatch&&normalMatch[1]){
                        filename=normalMatch[1];
                    }
                }

                var downloadUrl=window.URL.createObjectURL(blob);
                var link=document.createElement('a');

                link.href=downloadUrl;
                link.download=filename;

                document.body.appendChild(link);
                link.click();
                link.remove();

                window.URL.revokeObjectURL(downloadUrl);
            },
            error:function(xhr,status,error){
                btn.prop('disabled',false).html(originalHtml);

                if(xhr.response instanceof Blob){
                    xhr.response.text().then(function(text){
                        try{
                            var response=JSON.parse(text);
                            alert(response.message||'DOC generation failed.');
                        }catch(e){
                            alert('DOC generation failed: '+error);
                        }
                    });
                }else{
                    alert('DOC generation failed: '+error);
                }
            }
        });
    });
</script>
<script>
    // document.getElementById("copyBtn").addEventListener("click", function () {
    //     let emailBody = document.getElementById("emailBody").innerHTML;

    //     // Use Clipboard API with HTML support
    //     navigator.clipboard.write([
    //         new ClipboardItem({
    //             "text/html": new Blob([emailBody], { type: "text/html" }),
    //             "text/plain": new Blob([emailBody], { type: "text/plain" })
    //         })
    //     ]).then(function () {
    //         alert("Email body with design copied! Paste it into your email.");
    //     }).catch(function (err) {
    //         alert("Failed to copy: " + err);
    //     });
    // });
</script>
</body>
</html>
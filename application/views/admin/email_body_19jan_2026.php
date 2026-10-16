<?php 
$itinerary_entry_ticket_html = '';
if (!empty($itinerary_entry_ticket) && is_array($itinerary_entry_ticket)) 
    {
        $unique_tickets = array_unique($itinerary_entry_ticket);
    foreach ($unique_tickets as $ticket) {
        $itinerary_entry_ticket_html .= '<li style="position:relative; color:#555555; margin-bottom:6px;">' . $ticket . '</li>';
    }
}
$flight_details=
'<div style="background-color: #d6d8d9;padding: 0 10px 10px;">
<div class="title" style="padding: 12px 20px; margin: 0 0 5px; background-color: #d6d8d9; text-align: center;"><h4 style="padding: 0; margin: 0; color: #6060a9; text-decoration: none; text-transform: capitalize;">FLIGHT ENVISAGED</h4></div>
    <div class="text">
        <div class="flight-wrapper">
            <div class="flight-card from" style="width:100%;margin:5px 0px; display: flex;  padding: 12px; background-color: #fff;box-sizing: border-box;">
            
                <div class="card-header" style="width: 24%; font-size: 15px; font-weight: 600; color: #2e3b4e; border-right: dashed 1px #ccc; margin-bottom: 6px; padding-bottom: 15px; display: flex;  align-items: center; gap: 8px;"> <i class="fa-solid fa-plane-arrival"></i> <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Arrival</h4></div>
                <div style="width: 75%;padding-left: 20px;">';
    if($this->input->post('arrival_airline') !=''){
    $flight_details.='
                <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="label" style="font-size: 12px; color: #555; text-transform: uppercase;margin-bottom: 4px;">Airline:</div>
                    <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.$this->input->post('arrival_airline').'</div>
                </div>';
    }
    $flight_details.='<div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="label" style="font-size: 12px; color: #555; text-transform: uppercase;margin-bottom: 4px;">Time:</div>
                    <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.ucfirst($this->input->post('arrival_time')).'</div>
                </div>
                </div>
            </div>
            <div class="flight-card to" style="width: 100%;margin:5px 0px; display: flex;  padding: 12px; background-color: #fff;box-sizing: border-box;">
            
                <div class="card-header" style="width: 24%; font-size: 15px; font-weight: 600; color: #2e3b4e; border-right: dashed 1px #ccc; margin-bottom: 6px; padding-bottom: 15px; display: flex;  align-items: center; gap: 8px;"><i class="fa-solid fa-plane-departure"></i> <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Departure</h4></div>
                <div style="width: 75%;padding-left: 20px;">';
                if($this->input->post('departing_airline') !=''){
    $flight_details.='
                <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="label" style="font-size: 12px; color: #555; text-transform: uppercase;margin-bottom: 4px;">Airline:</div>
                    <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.$this->input->post('departing_airline').'</div>
                </div>';
    }
    $flight_details.='
                <div class="flight-row" style="margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="label" style="font-size: 12px; color: #555; text-transform: uppercase;margin-bottom: 4px;">Time:</div>
                    <div class="value" style="font-size: 14px; font-weight: 500; color: #2d3748;">&nbsp;&nbsp;'.ucfirst($this->input->post('departing_time')).'</div>
                </div>
                </div>
            </div>
        </div>
        </div>
</div>
</div>';


$enquiry_id = $postData['enquiry_id'];
$short_itinerary='<div class="title" style="padding: 12px 20px; background-color: #d6d8d9; text-align:center;margin-top: 0px; display: inline-block;
    width: 100%;    position: relative;    margin-bottom: -12px;
    box-sizing: border-box; justify-content: space-between; align-items: center;">
                   
                    <h4 style="padding: 0; margin: 0; color: #6060a9; text-decoration: none; text-transform: capitalize; flex: 1; text-align: center;">SHORT ITINERARY - '.$enquiry->number_of_nights.' NIGHT - '.($enquiry->number_of_nights+1).' DAYS</h4>
                   <b style="color:blue;text-decoration:none; white-space: nowrap;text-align: center;
    width: 100%;display: inline-block;">
                            <a style="color:blue;" href="' . base_url('brief-itinerary/' . base64_encode($enquiry_id)) . '" target="_blank">Click here for detailed itinerary.</a>
                        </b>
                    
                </div>';

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
$time_text = (strtolower($country) === 'georgia')
    ? '9 Hrs (10AM – 7PM Only)'
    : '12 Hrs (10AM – 10PM Only)';
    
$inclusions=' <div style="background-color: #d6d8d9;padding-bottom: 10px;">
    <div class="title" style=" background-color: #d6d8d9; text-align: center;">
        <h4 style="padding: 12px 20px; margin: 0; color:red; text-decoration: none; text-transform: capitalize;">ABOVE PRICE INCLUDES</h4>
    </div>';
     if($this->input->post('hotel_status')=="yes"){
    $inclusions.='<div style="padding: 10px 15px;margin: 0 10px;background-color: #fff;">
    <h4 style="padding: 0; margin: 0; color: #000; text-decoration: none; text-transform: capitalize;display: inline;">Stay :</h4>
    <p style="padding: 0; margin: 0;display: inline;color:#555555;">As Mentioned Above</p>
    </div>';}

    $inclusions.='<div class="text">
    
        <div class="our-inclusion" style="padding: 0 10px;">
        
            <div class="inclusion-item" style="background-color: #fff;margin: 10px 0px;}">
            
                <div class="box" style="padding: 10px 0;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff !important;">
                    <h4 style="padding-left: 12px;padding-top: 0; margin: 10px 0px;">Transportation & Guide Services</h4>
                    <ul style="margin:0; padding-left:25px;">
                        <li style="position:relative;  color:#555555; margin-bottom:6px;">All transfers & sightseeing by private vehicle ('.$vehicle_name.') for '.$time_text.'</li>
                        <li style="position:relative;  color:#555555; margin-bottom:6px;">Airport – hotel – airport transfers</li>';
                       
                        if (strtolower($country) !== 'georgia') {
                            $inclusions.='<li style="position:relative;  color:#555555; margin-bottom:6px;">Dinner Transfers Only</li>';
                        }
                        $inclusions.='<li style="position:relative;  color:#555555; margin-bottom:6px;">All transfers & sightseeing include services of an English-speaking '.$guide.'.</li>
                        <li style="position:relative;  color:#555555; margin-bottom:6px;">Airport meet & greet by our English-speaking staff.</li>';
                    if (!empty($postData['luggage_vehicle']))   {
                         $inclusions.='<li style="position:relative;  color:#555555; margin-bottom:6px;">Luggage Vehicle</li>';
                        }
                    $inclusions.='</ul>
                </div>
            </div>';
            
            $meal_type_daywise_price =  $postData['meal_type_daywise_price'];
          $meal_data = json_decode($meal_type_daywise_price, true);
          $meal_counts = [];

          if (is_array($meal_data)) {
            foreach ($meal_data as $day => $meals) {
                foreach ($meals as $meal_type => $details) {
                    $meal_type_clean = strtolower(str_replace(' ', '_', $meal_type));

                    if (isset($meal_counts[$meal_type_clean])) {
                        $meal_counts[$meal_type_clean]++;
                    } else {
                        $meal_counts[$meal_type_clean] = 1;
                    }
                }
            }
        }

        $inclusions.='
            <div class="inclusion-item" style="background-color: #fff;margin: 10px 0px;">
                <div class="box" style="padding: 10px 0;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff !important;">
                    <h4 style="padding-left: 12px; padding-top: 0; margin: 10px 0px;">Entrance & Activities</h4>
                    <ul style="margin:0; padding-left:25px;">
                    '.$itinerary_entry_ticket_html.'
                         ' . $activites;
                    if (!empty($postData['final_toll_price']) && $postData['final_toll_price'] > 0) {
                        $inclusions .= '<li style="color:#555555;">Toll Included</li>';
                    }
                    $inclusions .= '
                    </ul>
                </div>
            </div>
            
            <div class="inclusion-item" style=" background-color: #fff; margin: 10px 0px;">
                <div class="box" style="padding: 10px 0;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff !important;">
                    <h4 style="padding-left: 12px;padding-top: 0; margin: 10px 0px;">Meals</h4>
                    <ul style="margin:0; padding-left:25px;">';
                            $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>Breakfast at your hotel</li>";
                            //  foreach ($meal_counts as $type => $count) {
                            //     if ($count > 0) {
                            //         $email_summary = $count . ' - ' . ucfirst(str_replace('_', ' ', $type)) . '<br>';
                            //         $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>$email_summary</li>";
                            //     }
                            // }
                            
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

                            // $query = $this->db
                            //     ->select('*')
                            //     ->from('meal_per_person_cost')
                            //     ->where_in('id', $meal_ids)
                            //     ->where('status', 'active')
                            //     ->get();
                                
                            // $result = $query->result_array();
    
                            foreach ($meal_counts as $type => $count) {
                                if ($count > 0) {
                                    // Corrected: Need to check if the meal type exists in the result array
                                    $buffet = false;
                                    foreach ($result as $row) {
                                        // Assuming 'type' column exists in your database table
                                        if ($row['id'] == $type) {
                                            $buffet = true;
                                            break;
                                        }
                                    }
                                    
                                    // $email_summary = $count . ' - ' . ucfirst(str_replace('_', ' ', $type)) . '<br>';
                                    // $email_summary = $count . ' - '  . ucfirst(str_replace('_', ' ', $row['Buffet']))  . ' - ' . '('. $row['remarks'] .')' . '<br>';
                                    $email_summary = $count . ' - '  . ucfirst(str_replace('_', ' ', $row['Buffet']))  . '<br>';
                                    $inclusions .= "<li style='position:relative; color:#555555; margin-bottom:6px;'>$email_summary</li>";
                                }
                            }
                    $inclusions.='</ul>
                </div>
                 </div>
                
            <div class="inclusion-item" style=" background-color: #fff; margin: 10px 0px;">
                <div class="box" style="padding: 10px 0;width: 100%; height: 100%; border-left: solid 1px #ccc; background-color: #fff !important;">
                    <h4 style="padding-left: 12px;padding-top: 5px; margin: 10px 0px;">Complimentary Services</h4>
                    <ul style="margin:0; padding-left:25px;">';
                    $mandatory_services_json = $form['mandatory_services'] ?? '[]';
                    $mandatory_services = json_decode($mandatory_services_json, true);
                        if (!empty($mandatory_services)) {
                            // $service_text1 = rtrim(explode("|", $mandatory_services[0]['service'])[0], "_");
                            // $price1        = explode("|", $mandatory_services[0]['service'])[1];
                            // $qnty1         = $mandatory_services[0]['qnty'];

                            // $service_text2 = rtrim(explode("|", $mandatory_services[1]['service'])[0], "_");
                            // $price2        = explode("|", $mandatory_services[1]['service'])[1];
                            // $qnty2         = $mandatory_services[1]['qnty'];

                            // $service_text3 = rtrim(explode("|", $mandatory_services[2]['service'])[0], "_");
                            // $price3        = explode("|", $mandatory_services[2]['service'])[1];
                            // $qnty3         = $mandatory_services[2]['qnty'];

                            // $service_text4 = rtrim(explode("|", $mandatory_services[3]['service'])[0], "_");
                            // $price4        = explode("|", $mandatory_services[3]['service'])[1];
                            // $qnty4         = $mandatory_services[3]['qnty'];
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


                            // $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>$service_text3</li>";
                            // $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>$service_text2</li>";
                            // $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>$service_text4</li>";
                            // $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>$service_text1</li>";
                            if (isset($mandatory_services[2]['service'])) $inclusions .= "<li style='color:#555;margin-bottom:6px;'>$service_text3</li>";
                            if (isset($mandatory_services[1]['service'])) $inclusions .= "<li style='color:#555;margin-bottom:6px;'>$service_text2</li>";
                            if (isset($mandatory_services[3]['service'])) $inclusions .= "<li style='color:#555;margin-bottom:6px;'>$service_text4</li>";
                            if (isset($mandatory_services[0]['service'])) $inclusions .= "<li style='color:#555;margin-bottom:6px;'>$service_text1</li>";


                            // foreach ($mandatory_services as $service) {
                            //     // print_r()
                                // $service_text = rtrim(explode("|", $service['service'])[0], "_");
                                // $price = explode("|", $service['service'])[1];
                                // $qnty = $service['qnty'];
                            //     $inclusions .= "<li style='position:relative;  color:#555555; margin-bottom:6px;'>{$service_text}</li>";
                            // }
                        } else {
                            $inclusions .="<li style='position:relative;  color:#555555; margin-bottom:6px;'>No mandatory services provided.</li>";
                        }
                    $inclusions.='</ul>
                </div>
            </div>
             
        </div>
    </div>
</div>';

$activities_html='<br><span><b style="font-size: 18px;"><i class="fas fa-tasks"></i> Click here for <a href="'.base_url('assets/additional_activities.pdf').'" target="_blank" >Additional Activities.</b></a></span><br><br>';
$fremark = $postData['fremark'] 
// $activities_html = '
//     <div style="margin-top:20px;">
//     <h4 style="color:#2e3b4e; padding: 12px 20px; margin:15px 0px; background-color:#d6d8d9; font-size:16px; text-align:center;">
//         SPICE UP YOUR TRIP BY CHOOSING FROM OUR LIST OF ACTIVITIES
//     </h4>
//     <table border="1" cellspacing="0" cellpadding="6" width="100%" 
//           style="border-collapse:collapse; font-size:14px; color:#333; text-align:center;">
//         <thead>
//             <tr style="background-color:#d6d8d9; font-weight:bold; text-align:center;">
//                 <th style="width:50px;">S.NO</th>
//                 <th>Additional Activity Name</th>
//             </tr>
//         </thead>
//         <tbody>
//             <tr><td>1</td><td>Private outdoor picnic set-up with lunch near River/Lakeside</td></tr>
//             <tr><td>2</td><td>Party in a stretch Limo with music, Hostesses & champagne (2 hours)</td></tr>
//             <tr><td>3</td><td>Paragliding</td></tr>
//             <tr><td>4</td><td>Go-Karting + Buggy adventure</td></tr>
//             <tr><td>5</td><td>Double barrel shotgun shooting experience</td></tr>
//             <tr><td>6</td><td>Night club hopping</td></tr>
//             <tr><td>7</td><td>3rd Longest Zipline in the world</td></tr>
//             <tr><td>8</td><td>Private Pool Villa party</td></tr>
//             <tr><td>9</td><td>Hot Air Ballooning</td></tr>
//             <tr><td>10</td><td>River Rafting</td></tr>
//             <tr><td>11</td><td>Picnic lunch near the river side</td></tr>
//             <tr><td>12</td><td>Yacht Party</td></tr>
//             <tr><td>13</td><td>GyroPlane experience</td></tr>
//             <tr><td>14</td><td>Cessna – Learn to fly a plane</td></tr>
//             <tr><td>15</td><td>Visit Big Almaty Lake on an E-Bikes/E-Cycles</td></tr>
//             <tr><td>16</td><td>E-Scootie experience in the city</td></tr>
//             <tr><td>17</td><td>Casino visit</td></tr>
//             <tr><td>18</td><td>ATV ride</td></tr>
//             <tr><td>19</td><td>Falcon show</td></tr>
//             <tr><td>20</td><td>Dolphin Show</td></tr>
//             <tr><td>21</td><td>Huns Ethno Village</td></tr>
//             <tr><td>22</td><td>Wine Tasting</td></tr>
//             <tr><td>23</td><td>Party Bus</td></tr>
//             <tr><td>24</td><td>Rifle Shooting (Asanov)</td></tr>
//             <tr><td>25</td><td>Qazaq Shooters (Carbine, Sniper, Revolver, Glock, Mosin, Steyr Aug etc)</td></tr>
//         </tbody>
//     </table>
// </div>';
?>
<!DOCTYPE html><html><head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
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
    </style>
    </head>

    <body style="max-width:1200px; margin:50px auto;">
        <div class="table-container" style="p:0; margin:0;" id ="emailBody">
            
            <!--<div class="header" style="background-color:#d6d8d9;margin: -50px 0 !important;;-->
            <!--display:flex; align-items:center; justify-content:space-between; padding:10px 20px;">-->
            
            <!--    <img style="max-width:95px;" src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="">-->

            <!--    <span style="font-size:16px;color:#2e3b4e;max-width:600px;">-->
            <!--        <span style="font-weight:700;">The Most Trusted, Reliable & Innovative DMC for</span><br> <span style="text-transform:uppercase;">Armenia, Kazakhstan, Azerbaijan, Belarus, Georgia and Uzbekistan</span>-->
            <!--    </span>-->
            <!--</div>-->
            
             <table class="top-table header" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#d6d8d9;">
                        <tr>
                            <!-- Logo column -->
                            <td align="left" style="">
                            <img src="https://crm.kazindmc.com/assets/images/login-logo.png" alt="Logo" width="95" style="display:block; border:0; max-width:95px;">
                            </td>

                            <!-- Text column -->
                            <td align="right" style="font-size:15px;color:#2e3b4e;padding-right:8px;">
                            <span style="font-weight:700;">The Most Trusted, Reliable & Innovative DMC for</span><br>
                 
                            <span style="display: block;width: 100%;"><ul style="text-transform:uppercase;display: inline-flex;margin:0px;">
                            <!--<li style="padding-right: 18px;font-size: 12px;color:#B85C38;">Armenia</li>-->
                            <!--<li style="color:#ed1e88;padding-right: 18px;font-size: 12px;">Kazakhstan</li>-->
                            <!--<li style="color:#ec1f23;padding-right: 18px;font-size: 12px;">Azerbaijan</li>-->
                            <!--<li style="color:#d0a600;padding-right: 18px;font-size: 12px;">Belarus</li>-->
                            <!--<li style="color:#31448e;padding-right: 18px;font-size: 12px;">Georgia</li>-->
                            <!--<li style="color:#1ca9c9;font-size: 12px;">Uzbekistan</li>-->
                            <li style="color:#ed1e88;padding-right: 18px;font-size: 12px;">Kazakhstan</li>
                            <li style="color:#31448e;padding-right: 18px;font-size: 12px;">Georgia</li>
                            <li style="color:#ec1f23;padding-right: 18px;font-size: 12px;">Azerbaijan</li>
                            <li style="color:#1ca9c9;padding-right: 18px;font-size: 12px;">Uzbekistan</li>
                            <li style="padding-right: 18px;font-size: 12px;color:#B85C38;">Armenia</li>
                            <li style="color:#d0a600;font-size: 12px;">Belarus</li>
                            </ul></span>
                            
                            </td>
                        </tr>
                    </table>

            <table style="width:100%;">
               
                <tr><td colspan="12" align="left">Dear Mr/Mrs <?= $this->input->post('agent_name'); ?>,</td></tr>
                <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                <tr><td colspan="12" align="left" style="padding-top: 20px;">Please find given below Commercial Proposal of <?= $this->input->post('arrival_city') ?> (<?= ucfirst($country) ?>)<b> No of pax(<?=$total_persons?>)</b> <?php if($total_child > 0){ echo '- ('.$total_adults.' Adult, '.$total_child.' Child)'; } ?> <span style="color: #6060a9;"> <b>For <?= $enquiry->number_of_nights?>N</b>/<b><?=($enquiry->number_of_nights+1)?>D</b></span></td></tr>
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
                
                <tr><td colspan="12" align="left"><?= $cost_html;?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $inclusions; ?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $flight_details; ?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $short_itinerary; ?></td></tr>
                <tr><td colspan="12" align="left"><?php echo $only_itinerary_html; ?></td></tr>
                <br>
                <tr><td colspan="12" align="left"><?php echo $activities_html; ?></td></tr>
                
                <!--<tr><td colspan="12" align="left"><span style="text-decoration:underline;font-weight:bold;color:black;">IMPORTANT NOTE:</span> - -->
                <!--<div style="color:red;">1. Above quote is valid for 72 hrs</div>-->
                <!--<div style="color:red;">2. Above quote is subject to currency fluctuation</div>-->
                <!--<div style="color:red;">3. Today's ROE 1U$= <?= $currency->currency_abbr; ?>'<?= $postData['roe'] ? $postData['roe'] : $currency->country_currency_value; ?> Tenge</div>-->
                <!--<div style="color:red;">4. We encourage our partners to conduct due diligence and review hotel feedback online before making any bookings.</div>-->
                <!--</td></tr>-->
                <br><br>
                <!--<tr><td style="background-color:#d6d8d9;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">EXCLUSIONS:</span><br><?= $this->input->post('exclusions')?></td></tr>  -->
                <!--<tr><td style="background-color:#d6d8d9;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">IMPORTANT NOTES:</span><br><?= $this->input->post('important_notes')?></td></tr>  -->
                <!--<tr><td style="background-color:#d6d8d9;" colspan="12" align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;">CANCELLATION POLICY:</span><br><?= $this->input->post('cancellation_policy')?></td></tr>  -->
               
                <tr class="responsive-row">
                    <td colspan="12" style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;"  align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;">EXCLUSIONS:</span><br><?= $this->input->post('exclusions')?>
                
                </td>
                </tr>
                <tr>
                    <td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;"  align="left"><span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;
                         display: inline-block;">IMPORTANT NOTES:</span><br><div style="padding-left:24px;margin-top:5px;"> 
                         <div style="color:red;">1. Above quote is valid for 72 hrs</div>
                         <div style="color:red;">2. Above quote is subject to currency fluctuation</div>
                        <div style="color:red;">3. This costing is calculated at an ROE  of 1 USD = <?= $postData['roe'] ? $postData['roe'] : $currency->country_currency_value; ?> <?= $currency_abbr; ?>.</div>

                        <div style="color:red;">4. We encourage our partners to conduct due diligence and review hotel feedback online before making any bookings.</div></div><?= $this->input->post('important_notes')?>
            
                    </td>
                </tr>
                <tr>
            <td style="background-color:#d6d8d9;padding-top: 10px;display: block;margin-bottom: 4px;">
               
                <span style="color:#1974D2;text-decoration:underline;font-weight:bold;padding-left: 15px;">CANCELLATION POLICY:</span><br><div style="padding-left: 20px;"><?= $this->input->post('cancellation_policy')?></div>
            </td>  
                </tr>  
                <!--<tr><td colspan="12" align="left" height="25px"></td></tr>-->
                <!--<tr><td colspan="12" align="left">Regards,</td></tr>-->
                <!--<tr><td colspan="12" align="left">Jasmine<br>OPS - FIT DESK (KAZAKHSTAN)</td></tr>-->
            </table>
        </div>
    </body>
</html>

<!-- Copy button -->
<?php $email_preview = $this->input->get('email');?>
<!-- Copy button -->
<div class="btn-container" <?= ($email_preview === 'preview') ? 'style="display:none;"' : '' ?>>
    <button id="copyBtn">Copy Email Body</button>
</div>
<script>
    document.getElementById("copyBtn").addEventListener("click", function () {
        let emailBody = document.getElementById("emailBody").innerHTML;

        // Use Clipboard API with HTML support
        navigator.clipboard.write([
            new ClipboardItem({
                "text/html": new Blob([emailBody], { type: "text/html" }),
                "text/plain": new Blob([emailBody], { type: "text/plain" }) // fallback plain text
            })
        ]).then(function () {
            alert("Email body with design copied! Paste it into your email.");
        }).catch(function (err) {
            alert("Failed to copy: " + err);
        });
    });
</script>
</body>
</html>

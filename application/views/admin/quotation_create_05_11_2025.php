    <style>
        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index:9;
        }
        .my-card {
            background-color: #ffffff;
            margin-bottom: 25px;
            padding: 0 15px;
        }

        ul.timeline>li {
            margin: 5px 0;
            padding-left: 10px;
			border-bottom : 6px solid #FFF;
        }

        ul.timeline>li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index:9;
        }

        div.info>div {
            border: 1px solid #efecec;
        }

        .lbl-bold {
            font-weight: 600 !important;
        }

        .select2-container--bootstrap {
            box-shadow: 0px 0px 5px 2px #e2e2e3 !important;
        }

        .select2-container--bootstrap .select2-dropdown--below .select2-results {
            max-height: 400px;
            overflow-y: scroll;
        }
		#cke_1_contents { height:80px !important; }
		.alert { padding: .25rem 1.00rem !important; }
    </style>
    <script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.config.toolbar = [{
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl',
                    'Language'
                ]
            },
            '/',
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'insert',
                items: ['Table']
            }
        ];
    </script>

    <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">

                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <?php 
                                    $vehicles = [];
                                    $guides = [];
                                    $mandatory_services = [];
                                    $hotel_details = [];
                                    $family_details = [];
                                    
                                    $enquiry_id = base64_decode($this->input->get('enquiry_id'));
                                    if(array_key_exists('chk_vehicle', $this->input->get())){
                                        foreach($this->input->get('chk_vehicle') AS $key=>$val){
                                            $vehicles[] = ['vehicle_id'=>$val,'qnty'=>$this->input->get('vehicle_quantity')[$key]] ;
                                        }
                                    }
                                    if($this->input->get('guide')=='yes'){
                                        $pattern = '/^guide_languages_/i';
                                        $guide_arr = array_filter($this->input->get(), function($key) use ($pattern) {
                                            return preg_match($pattern, $key);
                                        }, ARRAY_FILTER_USE_KEY );
                                        $i=0;
                                        foreach($guide_arr AS $key=>$val){
                                            $guides[] = ['guide_languages'=>implode(',',$this->input->get($key)),'qnty'=>$this->input->get('guide_quantity')[$i], 'type' => $this->input->get('driver_cum_guide')] ;
                                            $i++;
                                        }                                        
                                    }
                                    foreach($this->input->get('hdn_mandatory_services') AS $key=>$val){
                                        $mandatory_services[] = ['service'=>$val,'qnty'=>$this->input->get('mandatory_services_qnty')[$key]];
                                    }
                                    $roomData = [];

                                    foreach ($_POST as $key => $value) {
                                        if (preg_match('/^family_(\d+)_adults$/', $key, $matches)) {
                                            $i = $matches[1]; // family number
                                            $adults = $this->input->post("family_{$i}_adults");
                                            $children = $this->input->post("family_{$i}_child");

                                            if (is_array($adults)) {
                                                foreach ($adults as $room_no => $adultCount) {
                                                    $roomData[] = [
                                                        'family_no' => $i,
                                                        'room_no' => $room_no + 1,
                                                        'adults' => (int)$adultCount,
                                                        'children' => isset($children[$room_no]) ? (int)$children[$room_no] : 0
                                                    ];
                                                }
                                            }
                                        }
                                    }


                                    // foreach ($adults as $key => $val) {
                                    //     $family_details[] = (object)[
                                    //         'adults' => (int)$val,
                                    //         'children' => isset($children[$key]) ? (int)$children[$key] : 0
                                    //     ];
                                    // }
                                if($this->input->get('hotel') =='yes'){
                                    foreach($this->input->get('hotel_category') AS $key=>$val){
                                        $hotel_details[] = ['category'=>$val,'qnty'=>$this->input->get('num_comparison_hotels')[$key],
                                                                'room_type'=>$this->input->get(str_replace(' ','_', strtolower($val)).'_room_type')];
                                    }
                                }
                                    
                                    $city_names   = $this->input->post('arrival_cities');
                                    $city_names   = is_array($city_names) ? $city_names : [];
                                    array_unshift($city_names, "");

                                    $city_details = $this->input->post('city_details');
                                    $city_details = is_array($city_details) ? $city_details : [];
                                    $city_detail_data = [];

                                    foreach ($city_names as $dayIndex => $cityName) {
                                        if ($dayIndex === 0) {
                                            $city_detail_data[$dayIndex] = ["city" => "", "qtn-transfer" => ""];
                                            continue;
                                        }

                                        // Get safely from array
                                        $transfer        = $city_details[$dayIndex]['qtn-transfer']       ?? '';
                                        $transfer_date   = $city_details[$dayIndex]['qtn-transfer-date']  ?? '';
                                        $arrival_time    = $city_details[$dayIndex]['city_arrival_time']  ?? '';

                                        if (!empty($city_details[$dayIndex])) {
                                            $city_detail_data[$dayIndex] = [
                                                "city"              => $cityName,
                                                "qtn-transfer"      => $transfer,
                                                "qtn-transfer-date" => $transfer_date,
                                                "city_arrival_time" => $arrival_time,
                                            ];
                                        } else {
                                            $city_detail_data[$dayIndex] = [
                                                "city"              => $cityName,
                                                "qtn-transfer"      => "",
                                                "qtn-transfer-date" => "",
                                                "city_arrival_time" => "",
                                            ];
                                        }
                                    }
                                    
                                    $saved_guide_costs = json_decode($this->input->get('guide_cost'), true) ?? [];
                                    $saved_itinerary_details = json_decode($this->input->get('itinerary_details'), true) ?? [];
                                    $saved_airport_pic_drop_cost = json_decode($this->input->get('airport_pic_drop_cost'), true) ?? [];
                                    $saved_luggage_vehicle_cost = json_decode($this->input->get('luggage_vehicle_cost'), true) ?? [];
                                    $saved_vehicle = json_decode($this->input->get('saved_vehicle'), true) ?? [];
                                    $saved_overnight_cost = json_decode($this->input->get('saved_overnight_cost'), true) ?? [];
                                    $saved_outside_cost = json_decode($this->input->get('saved_outside_cost'), true) ?? [];
                                    $saved_full_day_cost = json_decode($this->input->get('saved_full_day_cost'), true) ?? [];
                                    if (!function_exists('getSavedDayCost')) {
                                        function getSavedDayCost($day, $vehicleName, $saved_full_day_cost) {
                                            foreach ($saved_full_day_cost as $saved) {
                                                if ((int)$saved['day'] === (int)$day) {
                                                    foreach ($saved['vehicles'] as $veh) {
                                                        if (strtolower($veh['vehicle_name']) === strtolower($vehicleName)) {
                                                            return $veh; 
                                                        }
                                                    }
                                                }
                                            }
                                            return null;
                                        }
                                    }
                                    $saved_total_transport_without_tol= $this->input->get('saved_total_transport_without_tol');
                                    //echo '<pre>';print_r($hotel_details);exit;
                                    $luggage_vehicle = $this->input->get('luggage_vehicle') == 'yes' ? implode(',', (array) $this->input->get('hdn_luggage_vehicle')) : '';

                                    $same_hotels_all_nights = (array_key_exists('chk_all_hotels', $this->input->get()))?'yes':'no';
                                    $markup_split = $this->input->get('markup_split');
                                    $hotel_markup_percentage = ($markup_split == 'yes') ? $this->input->get('hotel_markup_percentage') : '';
                                    $cusine = $this->input->get('cusine');
                                    $days = $this->input->get('days');
                                    $data_meal = $this->input->get('meals');
                                    $final_meal_data = [
                                        'cusine' => $cusine,
                                        'days'   => $days,
                                        'meals'  => $data_meal
                                    ];
                                    $meal_json = json_encode($final_meal_data);
                                    $adults_num = (int)$this->input->get('number_of_adults');
                                    $child_num = (int)$this->input->get('number_of_child');
                                    $total_persons = $adults_num + $child_num;
                                    $total_meal_cost = 0;

                                    // Check if "all" meals or day-wise
                                    $total_meal_cost = 0;
                                    $all_day_meal_prices = [];
                                   

                                    if (!empty($data_meal) && is_array($data_meal)) {

                                        // Check if "all" meals or day-wise
                                        if (isset($data_meal['all']) && is_array($data_meal['all'])) {
                                            // For "all" — same meals apply to every day
                                            $meal_types = array_keys($data_meal['all']);
                                            $total_days = (int)$this->input->get('number_of_nights') + 1;

                                            for ($i = 1; $i <= $total_days; $i++) {
                                                $day = "Day_{$i}";
                                                foreach ($meal_types as $buffet_type) {
                                                    // Fetch price from DB
                                                    $price = $this->db->select('price')
                                                                    ->from('meal_per_person_cost')
                                                                    ->where('ctype', $cusine)
                                                                    ->where('buffet', $buffet_type)
                                                                    ->get()
                                                                    ->row('price');

                                                    $meal_total = $price * $total_persons;
                                                    $total_meal_cost += $meal_total;
                                                }
                                            }

                                        } else {
                                            // Day-wise meals (day_1, day_2, ...)
                                            foreach ($data_meal as $day => $meals) {
                                                if (!empty($meals) && is_array($meals)) {
                                                    foreach ($meals as $buffet_type => $val) {
                                                        if ($val == 1) {
                                                            $price = $this->db->select('price')
                                                                            ->from('meal_per_person_cost')
                                                                            ->where('ctype', $cusine)
                                                                            ->where('buffet', $buffet_type)
                                                                            ->get()
                                                                            ->row('price');

                                                            $meal_total = $price * $total_persons;
                                                            $total_meal_cost += $meal_total;
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                    } else {
                                        // If $data_meal is null or empty
                                        $total_meal_cost = 0;
                                        $all_day_meal_prices = [];
                                    }

                                    // echo "<h4 class='grandTotalMeal'>" . number_format($total_meal_cost) . "</h4>";
                                    // echo ""; 
                                    
                                    $quotation_save = ['roe'=>$this->input->get('roe'),'currency'=>$this->input->get('hdn_roe_name'),
                                        'city_of_origin'=>$this->input->get('origin_city'),'city_of_arrival'=>$this->input->get('arrival_city'),
                                        'arrival_airline'=>$this->input->get('arrival_airline'),'arrival_time'=>$this->input->get('arrival_time'),
                                        'departure_city'=>$this->input->get('departure_city'),'departing_airline'=>$this->input->get('departing_airline'),
                                        'departing_time'=>$this->input->get('departing_time'),'city_details'=>implode(',',$this->input->get('arrival_cities')),
                                        'city_transfer'=> json_encode($city_detail_data), 'meal'=> $this->input->get('meal'),
                                        'airport_pick_drop'=>$this->input->get('airport_pick_drop'),'vehicles'=>json_encode($vehicles),
                                        'luggage_vehicle'=>$luggage_vehicle,'guide_details'=>json_encode($guides),
                                        'group_type'=>$this->input->get('group_type'),'created_by'=>$this->session->userdata('id'),
                                        'markup_split' => $markup_split, 'hotel_markup_percentage' => $hotel_markup_percentage,
                                        'same_hotels_all_nights'=>$same_hotels_all_nights,'hotel_details'=>json_encode($hotel_details),'enquiry_id'=>$enquiry_id,
                                        'family_details'=>json_encode($roomData),'meal_type'=>$meal_json];
                                    
                                    $start_date = new DateTime($details->check_in_date);
                                    $last_date = new DateTime($details->check_out_date);
                                    $diff = $last_date->diff($start_date);
                                    $nights = $diff->days;
                                    
                                     $vehicles_json = '';
                                    if (!empty($vehicles)) {
                                        $vehicles_json = json_encode($vehicles); 
                                    }
                                ?>
                                <input type="hidden" value='<?= $vehicles_json; ?>' name="vehicless" id="vehicless">
                                <input type="hidden" value="<?=$this->input->get('origin_city');?>" name="origin_city" id="origin_city">
                                <input type="hidden" value="<?=$this->input->get('arrival_city');?>" name="arrival_city" id="arrival_city">
                                <input type="hidden" value="<?=$this->input->get('arrival_airline');?>" name="arrival_airline" id="arrival_airline">
                                <input type="hidden" value="<?=$this->input->get('arrival_time');?>" name="arrival_time" id="arrival_time">
                                <input type="hidden" value="<?=$this->input->get('departure_city');?>" name="departure_city" id="departure_city">
                                <input type="hidden" value="<?=$this->input->get('departing_airline');?>" name="departing_airline" id="departing_airline">
                                <input type="hidden" value="<?=$this->input->get('departing_time');?>" name="departing_time" id="departing_time">
                                <input type="hidden" value="<?=$this->input->get('airport_pick_drop');?>" name="airport_pick_drop" id="airport_pick_drop">
                                <input type="hidden" value="<?= htmlspecialchars(json_encode($mandatory_services), ENT_QUOTES, 'UTF-8'); ?>" name="mandatory_services" id="mandatory_services">
                                <input type="hidden" value="<?=$this->input->get('driver_cum_guide');?>" name="driver_cum_guide" id="driver_cum_guide">
                                <input type="hidden" value="<?=$this->input->get('roe');?>" name="roe" id="roe">
                                <input type="hidden" value="<?=$this->input->get('agent_name');?>" name="agent_name" id="agent_name">

                                <div class="card-head p-3 mt-3" style="background-color: #3333 !important; color:#fff !important;">
                                    <header>Create Quotation (<?php echo $nights.' Nights / '.($nights+1).' Days'; ?>)</header>
                                    <div class="tools">
                                    </div>
                                </div>
								
                                <div class="card-body row">                                   

                                    <div class="col-lg-8" style="background-color:#f8fcff;">
                                        <?php echo form_open_multipart('', ['id' => 'frm-timeline']); ?>
                                        <input type="hidden" name="enquiry_id" value="<?=$details->id ?>">
                                        <input type="hidden" name="hotel_status" value="<?=$this->input->get('hotel') ?>">
                                        <input type="hidden" name="hdn_group_type" value="<?=$this->input->get('hdn_group_type') ?>">
                                        <div class="row">

                                            <div class="col-md-10 pt-3">
                                                <h4 class="lbl-bold" style="text-align:center;">Quotation Itinerary Timeline</h4>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                               
                                                <ul class="timeline">
                                                    <?php if (!empty($template_content)): ?>
                                                        <?php
                                                        $i = 0;
                                                        $itinerary_date = $template_content[0]->date;
                                                        $luggage_vehicle_price = 0;
                                                        $final_ticket_price = 0;
                                                        $guide_pick_drop = [];
                                                        $guide_days = [];
                                                        $quotation_itinerary = [];
                                                        $temp_itinerary = [];
                                                        $all_days_total = 0;
                                                        $day_travel_total = 0;
                                                        $all_days_outside_transport = 0;
                                                        $all_days_full_day_total = 0;
                                                        $all_day_luggage_total = 0;
                                                        $all_days_airport_total = 0;
                                                        $all_day_activities_total = 0;
                                                        $outside_hotel_toll = 0;
                                                        $overnight_toll_price = 0;
                                                        $outside_toll_price = 0;
                                                        ?>

                                                        <?php foreach ($template_content as $key => $list): ?>
                                                            <?php
                                                            $outsidecity_flag = $insidecity_flag = true;

                                                            // Get itinerary data
                                                            $itinerary_sites_id = $this->input->get('hdn_site_id');
                                                            $itinerary_sites = $this->input->get('hdn_itinerary_content');
                                                            $itinerary_activities = $this->input->get('hdn_activities');
                                                            $hasItinerary = false;
                                                            
                                                            if (!empty($itinerary_sites_id[$key])):
                                                                foreach ($itinerary_sites_id[$key] as $site):
                                                                    if (!empty($site)):
                                                                        $hasItinerary = true;
                                                                        break;
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                            ?>

                                                            <?php if ($key == 0 || $itinerary_date != $list->date): ?>
                                                                <li class="itinerary_li">
                                                                    <input type="radio" name="rdo-edit" class="rdo">
                                                                    <span class="label label-primary itinerary_date" style="padding:10px;">
                                                                        <span style="font-size:13px;">Day : <?= $i + 1 ?></span>
                                                                    </span>
                                                                    <span style="display:inline-flex;">
                                                                        <input type="text" name="" class="ms-1 form-control dt-dateformat-show" value="<?php echo date('d-M-Y', strtotime($list->date)); ?>" style="width:45%;" readonly>
                                                                        <input type="date" value="<?php echo $list->date; ?>" class="ms-1 dt-dateformat" name="itinerary_date[]" style="width: 5%;background: transparent;border: 0;position: relative;right: 10%;">
                                                                    </span>
                                                                    <span id="" style="margin-left: -165px; font-weight: bold;"><?php echo date('l', strtotime($list->date)); ?></span>
                                                                    <br>

                                                                    <?php
                                                                    $i++;
                                                                    $itinerary_sites_id = $this->input->get('hdn_site_id');
                                                                    $itinerary_sites = $this->input->get('hdn_itinerary_content');
                                                                    $itinerary_activities = $this->input->get('hdn_activities');
                                                                    
                                                                    if ($this->input->get('chk_vehicle') != ''):
                                                                        $transport_id = implode(',', $this->input->get('chk_vehicle'));
                                                                        $where = ' transportation_costs.transport_id IN (' . $transport_id . ') AND transportation_costs.type IN ("full-day")';
                                                                        $where .= ' AND date(transportation_costs.valid_from) <= "' . $details->check_in_date . '" AND date(transportation_costs.valid_to) >= "' . $details->check_out_date . '"';
                                                                        $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = transportation_costs.transport_id']];
                                                                        $transportation_cost = $this->common_model->get_data('transportation_costs', '', '', '*', $where, '', $count = false, $join);
                                                                    endif;

                                                                    $hasOutsideArr = [];
                                                                    $dayHasOnlyMiscNoCost = false;
                                                                    
                                                                    if (!empty($itinerary_sites_id[$key])):
                                                                        $miscSites = 0;
                                                                        $totalSites = count($itinerary_sites_id[$key]);
                                                                        foreach ($itinerary_sites_id[$key] as $site_id):
                                                                            $whereMisc = 'sites.id=' . $site_id . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                                                                            $siteCheck = $this->common_model->get_data('sites', '', '', '*', $whereMisc, '', '', '');
                                                                            if (!empty($siteCheck)):
                                                                                $miscSites++;
                                                                            endif;
                                                                        endforeach;
                                                                        
                                                                        if ($miscSites == $totalSites):
                                                                            $dayHasOnlyMiscNoCost = true;
                                                                        endif;
                                                                    endif;

                                                                    $dayHasOnlyMiscNoCostArr[$key] = $dayHasOnlyMiscNoCost;

                                                                    $hasOutside = false;
                                                                    if (!empty($itinerary_sites_id[$key])):
                                                                        foreach ($itinerary_sites_id[$key] as $site_id):
                                                                            $where2 = 'sites.id=' . $site_id . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost" ';
                                                                            $sites = $this->common_model->get_data('sites', '', '', '*', $where2, '', '', '');
                                                                            if (!empty($sites) && $sites[0]->location_ids > 0):
                                                                                $hasOutside = true;
                                                                                break;
                                                                            endif;
                                                                        endforeach;
                                                                    endif;
                                                                    $hasOutsideArr[$key] = $hasOutside;
                                                                    ?>

                                                                    <!-- REMOVED MEAL TABLE FROM HERE -->

                                                                    <?php if ($this->input->get('guide') == 'yes'): ?>
                                                                        <?php
                                                                        $pattern = '/^guide_languages_/i';
                                                                        $guide_arr = array_filter(
                                                                            $this->input->get(),
                                                                            function ($key) use ($pattern) {
                                                                                return preg_match($pattern, $key);
                                                                            },
                                                                            ARRAY_FILTER_USE_KEY
                                                                        );

                                                                        $guides = [];
                                                                        $gIndex = 0;
                                                                        foreach ($guide_arr as $gKey => $val):
                                                                            $saved_costs = $saved_qty = $saved_total = null;
                                                                            // compare saved vs current itinerary
                                                                            $currentSites = $itinerary_sites_id[$key] ?? [];
                                                                            $savedDaySites = array_column($saved_itinerary_details['itinerary_sites_id_' . ($key + 1)]['itinerary'] ?? [], 'site_id');
                                                                            $itineraryMatches = !array_diff($currentSites, $savedDaySites) && !array_diff($savedDaySites, $currentSites);

                                                                            if ($itineraryMatches && !empty($saved_guide_costs)):
                                                                                foreach ($saved_guide_costs as $saved):
                                                                                    if ((int) $saved['day'] === (int) $key && (int) $saved['index'] === $gIndex + 1):
                                                                                        $saved_costs = $saved['costs'];
                                                                                        $saved_qty = $saved['qty'];
                                                                                        $saved_total = $saved['total'];
                                                                                        break;
                                                                                    endif;
                                                                                endforeach;
                                                                            endif;

                                                                            $guides[] = [
                                                                                'guide_languages' => implode(',', $this->input->get($gKey)),
                                                                                'qnty' => $this->input->get('guide_quantity')[$gIndex],
                                                                                'type' => $this->input->get('driver_cum_guide'),
                                                                                'saved_costs' => $saved_costs,
                                                                                'saved_qty' => $saved_qty,
                                                                                'saved_total' => $saved_total,
                                                                            ];
                                                                            $gIndex++;
                                                                        endforeach;
                                                                        ?>

                                                                        <?php
                                                                        $main_arrival_city = strtolower($this->input->get('arrival_city'));
                                                                        $arrival_cities = array_map('strtolower', $this->input->get('arrival_cities') ?? []);
                                                                        $day_city = strtolower($arrival_cities[$key] ?? '');
                                                                        $isDifferentCity = $day_city !== $main_arrival_city;
                                                                        $isFirstOrLast = $key == 0 || $key == count($template_content) - 1;
                                                                        $airportPickDrop = $this->input->get('airport_pick_drop') == 'yes';

                                                                        $hasDriverCumGuide = false;
                                                                        foreach ($guides as $g):
                                                                            if ($g['type'] == 'driver_guide'):
                                                                                $hasDriverCumGuide = true;
                                                                                break;
                                                                            endif;
                                                                        endforeach;
                                                                        
                                                                        if (empty($itinerary_sites_id[$key]) && !($isFirstOrLast && $airportPickDrop) && !$isDifferentCity):
                                                                            // No Charge (No Itinerary) - continue
                                                                        else:
                                                                            if (!empty($guides)):
                                                                                $day_total = 0;
                                                                                ?>
                                                                                
                                                                                <div class="alert alert-dark mt-2" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                    <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                        <div class="col-md-2"><span style="color:#ef2100;float:left;"><i class="fa fa-user"></i> Guide</span></div>
                                                                                        <div class="col-md-1">Languages</div>
                                                                                        <?php if ($isDifferentCity): ?>
                                                                                            <div class="col-md-2">Food</div>
                                                                                            <div class="col-md-2">Accommodation</div>
                                                                                            <div class="col-md-2">Day charge</div>
                                                                                        <?php elseif (!empty($hasOutsideArr[$key]) && $hasOutsideArr[$key]): ?>
                                                                                            <div class="col-md-6">Outside Cost</div>
                                                                                        <?php else: ?>
                                                                                            <div class="col-md-6">Per Day Cost</div>
                                                                                        <?php endif; ?>
                                                                                        <div class="col-md-1">Qty</div>
                                                                                        <div class="col-md-2">Total</div>
                                                                                    </div>

                                                                                    <?php foreach ($guides as $g): ?>
                                                                                        <?php
                                                                                        $where = 'LOWER(auxiliary_guide.location) = "' . strtolower($country) . '" 
                                                                                            AND auxiliary_guide.languages = "' . strtolower($g['guide_languages']) . '" 
                                                                                            AND auxiliary_guide.status = "active" ';

                                                                                        // if (!empty($g['type'])):
                                                                                        //     $arr_map = ['guide' => 'guide', 'driver_guide' => 'driver_cum_guide'];
                                                                                        //     $where .= ' AND auxiliary_guide.guide_type = "' . $arr_map[$g['type']] . '"';
                                                                                        // endif;
                                                                                        if (!empty($g['type'])):
                                                                                            $arr_map = ['guide' => 'guide', 'driver_guide' => 'driver_cum_guide'];
                                                                                            
                                                                                            if($g['type'] == 'driver_guide'){
                                                                                                $transport_ids = $this->input->get('chk_vehicle') ?? [];
                                                                                                // print_r($transport_ids);
                                                                                                if (!empty($transport_ids)) {
                                                                                                    $transport_ids_str = implode(',', array_map('intval', $transport_ids));
                                                                                                    $where2 = "transportation.id IN (" . $transport_ids_str . ")";
                                                                                                    $select2 = 'transportation.vehicle_name as vehicle';
                                                                                                    $dbData = $this->common_model->get_data('transportation', '', '', $select2, $where2, '', $count = false);
                                                                                                    
                                                                                                    if (in_array(8, $transport_ids) || in_array(6, $transport_ids)) {
                                                                                                        if (!empty($dbData)) {
                                                                                                            $vehicle_names = array_map(fn($v) => strtolower(trim($v->vehicle)), $dbData);
                                                                                                            $vehicle_list = '"' . implode('","', $vehicle_names) . '"';
                                                                                                            $where .= ' AND auxiliary_guide.guide_type = "' . $arr_map[$g['type']] . '" AND LOWER(vehicle) IN (' . $vehicle_list . ')';
                                                                                                        }
                                                                                                    } else {
                                                                                                        $where .= ' AND auxiliary_guide.guide_type = "' . $arr_map[$g['type']] . '" AND vehicle IS NULL';
                                                                                                    }
                                                                                                } else {
                                                                                                    echo "No transport IDs selected";
                                                                                                }
                                                                                            }
                                                                                            else{
                                                                                                 $where .= ' AND auxiliary_guide.guide_type = "' . $arr_map[$g['type']] . '" ';
                                                                                            }
                                                                                        endif;

                                                                                        $guide_prices = $this->common_model->get_data('auxiliary_guide', '', '', '*', $where, '', false);
                                                                                        if (!empty($guide_prices)):
                                                                                            ?>
                                                                                            <div class="row p-2 bg-grey" style="line-height:0.7">
                                                                                                <div class="col-md-2"><?= ucwords(str_replace('_', ' ', $arr_map[$g['type']])) ?></div>
                                                                                                <div class="col-md-1"><?= strtoupper($g['guide_languages']) ?></div>
                                                                                                <?php
                                                                                                // ---------------- GUIDE CHARGES LOGIC ----------------
                                                                                                if (!empty($dayHasOnlyMiscNoCostArr[$key]) && $dayHasOnlyMiscNoCostArr[$key]):
                                                                                                    $cost = 0;
                                                                                                    echo '<div class="col-md-6">No Charge</div>';
                                                                                                elseif ($isDifferentCity):
                                                                                                    $food_charge = $g['saved_costs'][0] ?? $guide_prices[0]->food_charge;
                                                                                                    $accommodation_charge = $g['saved_costs'][1] ?? $guide_prices[0]->accommodation_charge;
                                                                                                    $day_charge = $g['saved_costs'][2] ?? $guide_prices[0]->day_charge;

                                                                                                    $cost = $food_charge + $accommodation_charge + $day_charge;

                                                                                                    echo '<div class="col-md-2"><input type="text" value="' . $food_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                    echo '<div class="col-md-2"><input type="text" value="' . $accommodation_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                    echo '<div class="col-md-2"><input type="text" value="' . $day_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                // elseif ($isFirstOrLast):
                                                                                                //     if (empty($itinerary_sites_id[$key])):
                                                                                                //         $cost = 0;
                                                                                                //         echo '<div class="col-md-6">No Charge</div>';
                                                                                                //     else:
                                                                                                //         $day_charge = $g['saved_costs'][0] ?? $guide_prices[0]->day_charge;
                                                                                                //         $cost = $day_charge;

                                                                                                //         echo '<div class="col-md-6"><input type="text" value="' . $day_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                //     endif;
                                                                                                elseif ($isFirstOrLast):
                                                                                                    if (empty($itinerary_sites_id[$key])):
                                                                                                        $cost = 0;
                                                                                                        echo '<div class="col-md-6">No Charge</div>';
                                                                                                    else:
                                                                                                        $day_charge = $g['saved_costs'][0] ?? $guide_prices[0]->day_charge;

                                                                                                        // First day handling (arrival time)
                                                                                                        if ($key == 0) {
                                                                                                            $firstDaySpecial = false;
                                                                                                            if (!empty($itinerary_sites_id[0])) {
                                                                                                                foreach ($itinerary_sites_id[0] as $sId) {
                                                                                                                    if (empty($sId)) continue;
                                                                                                                    $whereSpec = 'sites.id=' . $sId . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                                                                                                                    $sp = $this->common_model->get_data('sites', '', '', '*', $whereSpec, '', '', '');
                                                                                                                    if (!empty($sp)) {
                                                                                                                        $firstDaySpecial = true;
                                                                                                                        break;
                                                                                                                    }
                                                                                                                }
                                                                                                            }

                                                                                                            if ($firstDaySpecial) {
                                                                                                                $arrival_time = $this->input->get('arrival_time');
                                                                                                                if (!empty($arrival_time)) {
                                                                                                                    // arrival >= 16:00 => half day
                                                                                                                    if (strtotime($arrival_time) >= strtotime('16:00')) {
                                                                                                                        $day_charge = ceil($day_charge / 2);
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }

                                                                                                        // Last day handling (departure time)
                                                                                                        $lastIndex = count($template_content) - 1;
                                                                                                        if ($key == $lastIndex) {
                                                                                                            $lastDaySpecial = false;
                                                                                                            if (!empty($itinerary_sites_id[$lastIndex])) {
                                                                                                                foreach ($itinerary_sites_id[$lastIndex] as $sId) {
                                                                                                                    if (empty($sId)) continue;
                                                                                                                    $whereSpec = 'sites.id=' . $sId . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                                                                                                                    $sp = $this->common_model->get_data('sites', '', '', '*', $whereSpec, '', '', '');
                                                                                                                    if (!empty($sp)) {
                                                                                                                        $lastDaySpecial = true;
                                                                                                                        break;
                                                                                                                    }
                                                                                                                }
                                                                                                            }

                                                                                                            if ($lastDaySpecial) {
                                                                                                                $departing_time = $this->input->get('departing_time');
                                                                                                                if (!empty($departing_time)) {
                                                                                                                    // departing before 10:00 => no charge
                                                                                                                    if (strtotime($departing_time) < strtotime('10:00')) {
                                                                                                                        $day_charge = 0;
                                                                                                                    }
                                                                                                                    // departing >=10:00 and <16:00 => half day
                                                                                                                    else if (strtotime($departing_time) < strtotime('16:00')) {
                                                                                                                        $day_charge = ceil($day_charge / 2);
                                                                                                                    }
                                                                                                                    // departing >=16:00 => full day (keep $day_charge)
                                                                                                                }
                                                                                                            }
                                                                                                        }

                                                                                                        $cost = $day_charge;
                                                                                                        echo '<div class="col-md-6"><input type="text" value="' . $day_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                    endif;
                                                                                                elseif (!empty($hasOutsideArr[$key]) && $hasOutsideArr[$key]):
                                                                                                    $day_charge = $g['saved_costs'][0] ?? $guide_prices[0]->outday_charge;
                                                                                                    $cost = $day_charge;

                                                                                                    echo '<div class="col-md-6"><input type="text" value="' . $day_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                else:
                                                                                                    $day_charge = $g['saved_costs'][0] ?? $guide_prices[0]->day_charge;
                                                                                                    $cost = $day_charge;

                                                                                                    echo '<div class="col-md-6"><input type="text" value="' . $day_charge . '" class="guide-price" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                endif;

                                                                                                $qty = $g['saved_qty'] ?? $g['qnty'];
                                                                                                $total_cost = $g['saved_total'] ?? $cost * $qty;
                                                                                                $day_total += $total_cost;

                                                                                                echo '<div class="col-md-1"><input type="text" value="' . $qty . '" class="guide-qty" data-day="' . $key . '" data-index="' . $gIndex . '"></div>';
                                                                                                echo '<div class="col-md-2"><input type="text" value="' . $total_cost . '" class="guide-total" data-day="' . $key . '" data-index="' . $gIndex . '" readonly></div>';
                                                                                                ?>  
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>

                                                                                    <input type="hidden" value="<?= $day_total ?>" class="day-total" data-day="<?= $key ?>">
                                                                                </div>
                                                                                <?php $all_days_total += $day_total; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>

                                                                    <?php
                                                                    $main_arrival_city = strtolower($this->input->get('arrival_city'));
                                                                    $arrival_cities = array_map('strtolower', $this->input->get('arrival_cities') ?? []);
                                                                    $day_city = strtolower($arrival_cities[$key] ?? '');
                                                                    $prev_day_city = strtolower($arrival_cities[$key - 1] ?? '');
                                                                    $isDifferentCity = $day_city !== $main_arrival_city;
                                                                    $isChargeDay = $day_city !== '' && $day_city !== $main_arrival_city && $prev_day_city === $main_arrival_city;

                                                                    $wasDifferentYesterday = $prev_day_city !== '' && $prev_day_city !== $main_arrival_city;
                                                                    $skipOutsideCharge = $isDifferentCity || $wasDifferentYesterday;

                                                                    if ($isChargeDay): ?>
                                                                        <div class="alert alert-dark mt-2 outside-section" data-day="<?= $key ?>" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                            <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:2px;">
                                                                                <div class="col-md-3"><span style="color:#ef2100;"><i class="fa fa-car"></i> Overnight <?= ucfirst($day_city) ?></span></div>
                                                                                <div class="col-md-3">Vehicle Name</div>
                                                                                <div class="col-md-2">Price</div>
                                                                                <div class="col-md-2">Qty</div>
                                                                                <div class="col-md-2">Total</div>
                                                                            </div>
                                                                            <?php if ($this->input->get('chk_vehicle') != ''):
                                                                                $transport_ids = $this->input->get('chk_vehicle') ?? [];
                                                                                $qntyArr = $this->input->get('vehicle_quantity') ?? [];
                                                                                $day_travel_total = 0;

                                                                                if (!empty($transport_ids)):
                                                                                    foreach ($transport_ids as $idx => $t_id):
                                                                                        $qty = 1;
                                                                                        $travel_price = $toll_price = $total = 0;
                                                                                        $vehicle_name = '';

                                                                                        $stay_city = "Overnight Stay " . ucfirst($day_city);
                                                                                        $where = "outsidecity_transportation_costs.transport_id = " . $t_id . " 
                                                                                            AND location_masters.location = '" . $stay_city . "'";
                                                                                        $select = 'outsidecity_transportation_costs.*, transportation.vehicle_name as vehicle';
                                                                                        $join = [
                                                                                            ['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = outsidecity_transportation_costs.transport_id'],
                                                                                            ['type' => 'LEFT', 'join_table' => 'location_masters', 'condition' => 'location_masters.id = outsidecity_transportation_costs.location_ids'],
                                                                                        ];
                                                                                        $dbData = $this->common_model->get_data('outsidecity_transportation_costs', '', '', $select, $where, '', $count = false, $join);

                                                                                        $db_vehicle_name = '';
                                                                                        $db_price = $db_toll = 0;
                                                                                        if (!empty($dbData)):
                                                                                            $d = $dbData[0];
                                                                                            $db_vehicle_name = ucfirst($d->vehicle ?? '');
                                                                                            $db_price = (float) $d->price;
                                                                                            $db_toll = (float) $d->toll_price;
                                                                                        endif;

                                                                                        $savedRow = null;
                                                                                        foreach ($saved_overnight_cost as $s):
                                                                                            if ($s['day'] == $key && isset($s['vehicle_name']) && strtolower($s['vehicle_name']) == strtolower($db_vehicle_name)):
                                                                                                $savedRow = $s;
                                                                                                break;
                                                                                            endif;
                                                                                        endforeach;

                                                                                        if ($savedRow):
                                                                                            $vehicle_name = $savedRow['vehicle_name'];
                                                                                            $qty = (int) $savedRow['qty'];
                                                                                            $travel_price = (float) $savedRow['travel'];
                                                                                            $toll_price = (float) $savedRow['toll'];
                                                                                            $total = (float) $savedRow['total'];
                                                                                        else:
                                                                                            $vehicle_name = $db_vehicle_name;
                                                                                            $qty = (int) ($qntyArr[$idx] ?? 1);
                                                                                            $travel_price = $db_price;
                                                                                            $toll_price = $db_toll;
                                                                                            $total = $travel_price * $qty;
                                                                                        endif;
                                                                                        ?>
                                                                                        <div class="row travel-row" data-day="<?= $key ?>" data-vehicle="<?= ucfirst($vehicle_name) ?>">
                                                                                            <div class="col-md-3"></div>
                                                                                            <div class="col-md-3">
                                                                                                <?= ucfirst($d->vehicle) ?><br>
                                                                                                Toll: <input type="text" value="<?= $toll_price ?>" class="toll-price">
                                                                                            </div>
                                                                                            <div class="col-md-2"><input type="text" value="<?= $travel_price ?>" class="travel-price"></div>
                                                                                            <div class="col-md-2"><input type="text" value="<?= $qty ?>" class="travel-qty"></div>
                                                                                            <div class="col-md-2"><input type="text" value="<?= $total ?>" class="travel-total" readonly></div>
                                                                                        </div>
                                                                                        <?php
                                                                                        $day_travel_total += $total;
                                                                                        $overnight_toll_price += $toll_price;
                                                                                    endforeach;
                                                                                endif;
                                                                            endif; ?>
                                                                        </div>
                                                                        <input type="hidden" class="travel-grand" name="hdn_travel_city_cost_<?= $key ?>" id="hdn_travel_city_cost_<?= $key ?>" value="<?= $day_travel_total ?>"/>
                                                                    <?php endif; ?>
                                                                    
                                                                    <?php if ($list->content != ''): ?>
                                                                        <div style="margin:0 0 !important;">
                                                                            <i title="Remove" class="fa fa-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>
                                                                            
                                                                            <?php
                                                                            if ($key == 0 && !empty($airport_transfer_in)):
                                                                                $airport_transfer = $airport_transfer_in;
                                                                                $input_name = 'hdn_airport_in_total';
                                                                                $airport_pick_drop = '<span style="color:#ef2100;"><i class="fa fa-plane"></i> Airport Pickup</span>';
                                                                                $guide_pick_drop[] = '0.5';
                                                                            elseif ($key == count($template_content) - 1 && !empty($airport_transfer_out)):
                                                                                $airport_transfer = $airport_transfer_out;
                                                                                $input_name = 'hdn_airport_out_total';
                                                                                $airport_pick_drop = '<span style="color:#ef2100;"><i class="fa fa-plane"></i> Airport Drop</span>';
                                                                                $guide_pick_drop[] = '0.5';
                                                                            else:
                                                                                $airport_transfer = [];
                                                                            endif;
                                                                            
                                                                            if (!empty($airport_transfer)): ?>
                                                                                <?php if ($key == 0 && !empty($airport_transfer_in)): ?>
                                                                                    <div class="airport-section airport-pickup">
                                                                                        <div class="alert alert-dark" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                            <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                                <div class="col-md-3"><?= $airport_pick_drop ?></div>
                                                                                                <div class="col-md-4">Vehicle Name</div>
                                                                                                <div class="col-md-2">Price</div>
                                                                                                <div class="col-md-1">Qty.</div>
                                                                                                <div class="col-md-2">Total</div>
                                                                                            </div>
                                                                                            <?php
                                                                                            $aIndex = 0;
                                                                                            $total = 0;
                                                                                            foreach ($airport_transfer_in as $airport_in):
                                                                                                $qty = $airport_in['quantity'] ?? 1;
                                                                                                $price = $airport_in['price'] ?? 0;

                                                                                                foreach ($saved_airport_pic_drop_cost as $saved):
                                                                                                    if ($saved['type'] === 'pickup' && $saved['vehicle_name'] === $airport_in['vehicle_name']):
                                                                                                        $price = $saved['price'] ?? $price;
                                                                                                        $qty = $saved['quantity'] ?? $qty;
                                                                                                        break;
                                                                                                    endif;
                                                                                                endforeach;
                                                                                                $rowTotal = $price * $qty;
                                                                                                ?>
                                                                                                <div class="row airport-row" data-index="<?= $aIndex ?>">
                                                                                                    <div class="col-md-3"></div>
                                                                                                    <div class="col-md-4"><?= $airport_in['vehicle_name'] ?></div>
                                                                                                    <div class="col-md-2"><input type="text" value="<?= $price ?>" class="airport-price"></div>
                                                                                                    <div class="col-md-1"><input type="text" value="<?= $qty ?>" class="airport-qty"></div>
                                                                                                    <div class="col-md-2"><input type="text" value="<?= $rowTotal ?>" class="airport-total" readonly></div>
                                                                                                </div>
                                                                                                <?php $aIndex++; ?>
                                                                                            <?php endforeach; ?>
                                                                                            <?php $all_days_airport_total += $rowTotal; ?>
                                                                                            <input type="hidden" class="airport-grand" id="hdn_airport_in_total" name="hdn_airport_in_total" value="<?= $rowTotal ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                                <?php if ($key == count($template_content) - 1 && !empty($airport_transfer_out)): ?>
                                                                                    <div class="airport-section airport-drop">
                                                                                        <div class="alert alert-dark" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                            <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                                <div class="col-md-3"><?= $airport_pick_drop ?></div>
                                                                                                <div class="col-md-4">Vehicle Name</div>
                                                                                                <div class="col-md-2">Price</div>
                                                                                                <div class="col-md-1">Qty.</div>
                                                                                                <div class="col-md-2">Total</div>
                                                                                            </div>
                                                                                            <?php
                                                                                            $aIndex = 0;
                                                                                            $total = 0;
                                                                                            foreach ($airport_transfer_out as $airport_out):
                                                                                                $qty = $airport_out['quantity'] ?? 1;
                                                                                                $price = $airport_out['price'] ?? 0;

                                                                                                foreach ($saved_airport_pic_drop_cost as $saved):
                                                                                                    if ($saved['type'] === 'drop' && $saved['vehicle_name'] === $airport_out['vehicle_name']):
                                                                                                        $price = $saved['price'] ?? $price;
                                                                                                        $qty = $saved['quantity'] ?? $qty;
                                                                                                        break;
                                                                                                    endif;
                                                                                                endforeach;
                                                                                                $rowTotal = $price * $qty;
                                                                                                ?>
                                                                                                <div class="row airport-row" data-index="<?= $aIndex ?>">
                                                                                                    <div class="col-md-3"></div>
                                                                                                    <div class="col-md-4"><?= $airport_out['vehicle_name'] ?></div>
                                                                                                    <div class="col-md-2"><input type="text" value="<?= $price ?>" class="airport-price"></div>
                                                                                                    <div class="col-md-1"><input type="text" value="<?= $qty ?>" class="airport-qty"></div>
                                                                                                    <div class="col-md-2"><input type="text" value="<?= $rowTotal ?>" class="airport-total" readonly></div>
                                                                                                </div>
                                                                                                <?php $aIndex++; ?>
                                                                                            <?php endforeach; ?>
                                                                                            <?php $all_days_airport_total += $rowTotal; ?>
                                                                                            <input type="hidden" class="airport-grand" id="hdn_airport_out_total" name="hdn_airport_out_total" value="<?= $rowTotal ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endif; ?>

                                                                                <?php if ($this->input->get('luggage_vehicle') == 'yes'):
                                                                                    $luggage_vehicle = $this->input->get('hdn_luggage_vehicle');
                                                                                    $luggage_total = 0;
                                                                                    ?>
                                                                                    <div class="alert alert-dark luggage-section" style="margin-bottom:2px !important;padding:1px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                        <?php
                                                                                        $lIndex = 0;
                                                                                        foreach ($luggage_vehicle as $luggage_list):
                                                                                            $luggage_arr = explode('__', $luggage_list);
                                                                                            $vehicleName = $luggage_arr[0] ?? '';
                                                                                            $price = $luggage_arr[1] ?? 0;
                                                                                            $qty = $luggage_arr[2] ?? 1;
                                                                                            
                                                                                            foreach ($saved_luggage_vehicle_cost as $saved):
                                                                                                if ($saved['vehicle_name'] === $vehicleName):
                                                                                                    $price = $saved['price'] ?? $price;
                                                                                                    $qty = $saved['quantity'] ?? $qty;
                                                                                                    break;
                                                                                                endif;
                                                                                            endforeach;
                                                                                            $rowTotal = $price * $qty;
                                                                                            $luggage_total += $rowTotal;
                                                                                            ?>
                                                                                            <div class="row luggage-row" data-index="<?= $lIndex ?>" style="line-height: 15px;margin-top: 1px;">
                                                                                                <div class="col-md-7">
                                                                                                    <span style="color:#ef2100;float:left;">
                                                                                                        <i class="fa fa-car"></i> Luggage Vehicle
                                                                                                    </span>
                                                                                                    <?= $vehicleName ?>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <input type="text" value="<?= $price ?>" class="luggage-price" data-index="<?= $lIndex ?>">
                                                                                                </div>
                                                                                                <div class="col-md-1">
                                                                                                    <input type="text" value="<?= $qty ?>" class="luggage-qty" data-index="<?= $lIndex ?>">
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <input type="text" value="<?= $rowTotal ?>" class="luggage-total" data-index="<?= $lIndex ?>" readonly>
                                                                                                </div>										
                                                                                            </div>
                                                                                            <?php $lIndex++; ?>
                                                                                        <?php endforeach; ?>
                                                                                        <?php $all_day_luggage_total += $luggage_total; ?>
                                                                                        <input type="hidden" name="hdn_luggage_price" id="hdn_luggage_price" class="luggage-grand" value="<?= $luggage_total ?>"/>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>	
                                                                            
                                                                            <span>
                                                                                <i class="fas fa-hand-point-right" style="cursor:pointer;display:inline-flex; width:2%;" title="Edit" id="<?php echo $list->id; ?>"></i>
                                                                            </span>
                                                                            <span class="txt-edit" style="display:inline-table; width:97%;padding:3px;"><?php echo urldecode($list->content); ?></span>
                                                                            <input type="hidden" name="itinerary_title_<?= $i ?>[]" value="<?= urldecode($list->content) ?>">
                                                                            <input type="hidden" name="itinerary_title_search_<?= $i ?>[]" value="<?= urldecode($list->content) ?>">
                                                                            <input type="hidden" name="itinerary_sites_id_<?= $i ?>[]" value="0">
                                                                            <input type="hidden" name="itinerary_text_<?= $i ?>[]" value="<?= urldecode($list->content) ?>">
                                                                            <input type="hidden" name="itinerary_remarks_<?= $i ?>[]" value="<?= $list->remarks ?>">
                                                                            <input type="hidden" name="itinerary_time_<?= $i ?>[]" value="<?= $list->time ?>">
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php
                                                                    $main_arrival_city = strtolower($this->input->get('arrival_city'));
                                                                    $arrival_cities = array_map('strtolower', $this->input->get('arrival_cities') ?? []);
                                                                    $day_city = strtolower($arrival_cities[$key] ?? '');
                                                                    $isDifferentCity = $day_city !== $main_arrival_city && $day_city != '';
                                                                    static $prevDifferentCity = false;

                                                                    if ($isDifferentCity || $prevDifferentCity):
                                                                        if (!empty($transportation_cost) && $insidecity_flag && $this->input->get('chk_vehicle[]') != ''):
                                                                            $qnty = $this->input->get('vehicle_quantity[]');
                                                                            $vehicles = $this->input->get('chk_vehicle[]');
                                                                            ?>
                                                                            <div class="alert alert-dark mt-2" data-day="<?= $key + 1 ?>" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                    <div class="col-md-3"><span style="color:#ef2100;"><i class="fa fa-taxi"></i> Full Day Tour</span></div>
                                                                                    <div class="col-md-4">Vehicle Name</div>
                                                                                    <div class="col-md-2">Price</div>
                                                                                    <div class="col-md-1">Qty.</div>
                                                                                    <div class="col-md-2">Total</div>
                                                                                </div>
                                                                                <?php
                                                                                $transportation_total = 0;
                                                                                foreach ($transportation_cost as $d):
                                                                                    $key_index = array_search($d->id, $vehicles);
                                                                                    if ($key_index !== false):
                                                                                        $savedVeh = getSavedDayCost($key + 1, $d->vehicle_name, $saved_full_day_cost);
                                                                                        if ($savedVeh):
                                                                                            $price = $savedVeh['price'];
                                                                                            $qty = $savedVeh['qty'];
                                                                                            $total = $savedVeh['total'];
                                                                                        else:
                                                                                            $price = $d->price;
                                                                                            $qty = $qnty[$key_index];
                                                                                            $total = $price * $qty;
                                                                                        endif;
                                                                                        ?>
                                                                                        <div class="row full-transport-row" style="line-height: 15px;margin-top: 2px;">
                                                                                            <div class="col-md-3"></div>
                                                                                            <div class="col-md-4"><?= $d->vehicle_name ?></div>
                                                                                            <div class="col-md-2"><input type="text" class="full_price" value="<?= $price ?>"></div>
                                                                                            <div class="col-md-1"><input type="text" class="full_qty" value="<?= $qty ?>"></div>
                                                                                            <div class="col-md-2"><input type="text" class="full_total" value="<?= $total ?>" readonly></div>
                                                                                        </div>
                                                                                        <?php $transportation_total += $total; ?>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; ?>
                                                                                <?php $all_days_full_day_total += $transportation_total; ?>
                                                                                <input type="hidden" class="total" name="hdn_transportation_inside_<?= $key ?>" value="<?= $transportation_total ?>">
                                                                            </div>
                                                                            <?php $insidecity_flag = false; ?>
                                                                        <?php endif; ?>
                                                                    <?php else:
                                                                        $dayHasOnlyMiscNoCost = false;
                                                                        $dayHasNoItinerary = empty($itinerary_sites_id[$key]);
                                                                        if (!$dayHasNoItinerary):
                                                                            $miscSites = 0;
                                                                            $totalSites = count($itinerary_sites_id[$key]);
                                                                            foreach ($itinerary_sites_id[$key] as $site_id):
                                                                                $whereMisc = 'sites.id=' . $site_id . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                                                                                $siteCheck = $this->common_model->get_data('sites', '', '', '*', $whereMisc);
                                                                                if (!empty($siteCheck)):
                                                                                    $miscSites++;
                                                                                endif;
                                                                            endforeach;
                                                                            if ($miscSites == $totalSites):
                                                                                $dayHasOnlyMiscNoCost = true;
                                                                            endif;
                                                                        endif;

                                                                        if (!empty($transportation_cost) && $this->input->get('chk_vehicle[]') != ''):
                                                                            $qnty = $this->input->get('vehicle_quantity[]');
                                                                            $vehicles = $this->input->get('chk_vehicle[]');

                                                                            if ($dayHasNoItinerary || $dayHasOnlyMiscNoCost):
                                                                                echo '<input type="hidden" class="total" name="hdn_transportation_inside_' . $key . '" value="0">';
                                                                            else:
                                                                                ?>
                                                                                <div class="alert alert-dark mt-2" data-day="<?= $key + 1 ?>" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                    <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                        <div class="col-md-3"><span style="color:#ef2100;"><i class="fa fa-taxi"></i> Full Day Tour</span></div>
                                                                                        <div class="col-md-4">Vehicle Name</div>
                                                                                        <div class="col-md-2">Price</div>
                                                                                        <div class="col-md-1">Qty.</div>
                                                                                        <div class="col-md-2">Total</div>
                                                                                    </div>
                                                                                    <?php
                                                                                    // $transportation_total = 0;
                                                                                    // foreach ($transportation_cost as $d):
                                                                                    //     $key_index = array_search($d->id, $vehicles);
                                                                                    //     if ($key_index !== false):
                                                                                    //         $savedVeh = getSavedDayCost($key + 1, $d->vehicle_name, $saved_full_day_cost);
                                                                                    //         if ($savedVeh):
                                                                                    //             $price = $savedVeh['price'];
                                                                                    //             $qty = $savedVeh['qty'];
                                                                                    //             $total = $savedVeh['total'];
                                                                                    //         else:
                                                                                    //             $price = $d->price;
                                                                                    //             $qty = $qnty[$key_index];
                                                                                    //             $total = $price * $qty;
                                                                                    //         endif;
                                                                                            ?>
                                                                                            <!--<div class="row full-transport" style="line-height: 15px;margin-top: 2px;">-->
                                                                                            <!--    <div class="col-md-3"></div>-->
                                                                                            <!--    <div class="col-md-4"><?= $d->vehicle_name ?></div>-->
                                                                                            <!--    <div class="col-md-2"><input type="text" class="full_i_price" value="<?= $price ?>"></div>-->
                                                                                            <!--    <div class="col-md-1"><input type="text" class="full_i_qty" value="<?= $qty ?>"></div>-->
                                                                                            <!--    <div class="col-md-2"><input type="text" class="full_i_total" value="<?= $total ?>" readonly></div>-->
                                                                                            <!--</div>-->
                                                                                            <?php //$transportation_total += $total; ?>
                                                                                        <?php //endif; ?>
                                                                                    <?php //endforeach; ?>
                                                                                    <?php  $transportation_total = 0;
                                                                                        foreach ($transportation_cost as $d):
                                                                                            $key_index = array_search($d->id, $vehicles);
                                                                                            if ($key_index !== false):
                                                                                                $savedVeh = getSavedDayCost($key + 1, $d->vehicle_name, $saved_full_day_cost);
                                                                                                if ($savedVeh):
                                                                                                    $effectivePrice = $savedVeh['price'];
                                                                                                    $qty = $savedVeh['qty'];
                                                                                                    $total = $savedVeh['total'];
                                                                                                else:
                                                                                                    $price = $d->price;
                                                                                                    $qty = $qnty[$key_index];
                                                                                                    
                                                                                                    $effectivePrice = $price;
                                                                                                    $lastIndex = count($template_content) - 1;
                                                                                                    
                                                                                                    // FIRST DAY LOGIC
                                                                                                    if ($key == 0) {
                                                                                                        $firstDaySpecial = false;
                                                                                                        if (!empty($itinerary_sites_id[0])) {
                                                                                                            foreach ($itinerary_sites_id[0] as $sId) {
                                                                                                                if (empty($sId)) continue;
                                                                                                                $whereSpec = 'sites.id=' . $sId . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                                                                                                                $sp = $this->common_model->get_data('sites', '', '', '*', $whereSpec, '', '', '');
                                                                                                                if (!empty($sp)) { 
                                                                                                                    $firstDaySpecial = true; 
                                                                                                                    break;
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        if ($firstDaySpecial) {
                                                                                                            $arrival_time = $this->input->get('arrival_time');
                                                                                                            if (!empty($arrival_time) && strtotime($arrival_time) >= strtotime('16:00')) {
                                                                                                                // Fetch half-day price from database instead of calculating
                                                                                                                $whereHalfDay = 'transportation_costs.transport_id = ' . $d->transport_id . ' AND transportation_costs.type = "halfday"';
                                                                                                                $whereHalfDay .= ' AND date(transportation_costs.valid_from) <= "' . $details->check_in_date . '" AND date(transportation_costs.valid_to) >= "' . $details->check_out_date . '"';
                                                                                                                $halfDayCost = $this->common_model->get_data('transportation_costs', '', '', 'price', $whereHalfDay, '', false);
                                                                                                                
                                                                                                                if (!empty($halfDayCost) && isset($halfDayCost[0]->price)) {
                                                                                                                    $effectivePrice = $halfDayCost[0]->price;
                                                                                                                } else {
                                                                                                                    // Fallback to half of full day price if no half-day price found
                                                                                                                    $effectivePrice = ceil($price / 2);
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    
                                                                                                    // LAST DAY LOGIC
                                                                                                    if ($key == $lastIndex) {
                                                                                                        $lastDaySpecial = false;
                                                                                                        if (!empty($itinerary_sites_id[$lastIndex])) {
                                                                                                            foreach ($itinerary_sites_id[$lastIndex] as $sId) {
                                                                                                                if (empty($sId)) continue;
                                                                                                                $whereSpec = 'sites.id=' . $sId . ' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                                                                                                                $sp = $this->common_model->get_data('sites', '', '', '*', $whereSpec, '', '', '');
                                                                                                                if (!empty($sp)) { 
                                                                                                                    $lastDaySpecial = true; 
                                                                                                                    break;
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        if ($lastDaySpecial) {
                                                                                                            $departing_time = $this->input->get('departing_time');
                                                                                                            if (!empty($departing_time)) {
                                                                                                                if (strtotime($departing_time) < strtotime('10:00')) {
                                                                                                                    $effectivePrice = 0;
                                                                                                                } elseif (strtotime($departing_time) < strtotime('16:00')) {
                                                                                                                    // Fetch half-day price from database instead of calculating
                                                                                                                    $whereHalfDay = 'transportation_costs.transport_id = ' . $d->transport_id . ' AND transportation_costs.type = "halfday"';
                                                                                                                    $whereHalfDay .= ' AND date(transportation_costs.valid_from) <= "' . $details->check_in_date . '" AND date(transportation_costs.valid_to) >= "' . $details->check_out_date . '"';
                                                                                                                    $halfDayCost = $this->common_model->get_data('transportation_costs', '', '', 'price', $whereHalfDay, '', false);
                                                                                                                    
                                                                                                                    if (!empty($halfDayCost) && isset($halfDayCost[0]->price)) {
                                                                                                                        $effectivePrice = $halfDayCost[0]->price;
                                                                                                                    } else {
                                                                                                                        // Fallback to half of full day price if no half-day price found
                                                                                                                        $effectivePrice = ceil($price / 2);
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    $effectivePrice = $price;
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    
                                                                                                    $total = $effectivePrice * $qty;
                                                                                                endif;
                                                                                                ?>
                                                                                                <div class="row full-transport" style="line-height: 15px;margin-top: 2px;">
                                                                                                    <div class="col-md-3"></div>
                                                                                                    <div class="col-md-4"><?= $d->vehicle_name ?></div>
                                                                                                    <div class="col-md-2"><input type="text" class="full_i_price" value="<?= $effectivePrice ?>"></div>
                                                                                                    <div class="col-md-1"><input type="text" class="full_i_qty" value="<?= $qty ?>"></div>
                                                                                                    <div class="col-md-2"><input type="text" class="full_i_total" value="<?= $total ?>" readonly></div>
                                                                                                </div>
                                                                                            <?php
                                                                                            $transportation_total += $total;
                                                                                            endif;
                                                                                        endforeach; ?>
                                                                                    <?php $all_days_full_day_total += $transportation_total; ?>
                                                                                    <input type="hidden" class="total" name="hdn_transportation_inside_<?= $key ?>" value="<?= $transportation_total ?>">
                                                                                </div>
                                                                                <?php
                                                                            endif;
                                                                            $insidecity_flag = false;
                                                                        endif;
                                                                    endif;
                                                                    $prevDifferentCity = $isDifferentCity;
                                                                    ?>

                                                                    <?php
                                                                    $k = 0;
                                                                    $outsidecity_flag = $insidecity_flag = true;
                                                                    if (array_key_exists($key, $itinerary_sites_id)):
                                                                        $guide_days[$key] = 1;

                                                                        foreach ($itinerary_sites_id[$key] as $k => $site_id):
                                                                            $outsidecity_transportation = [];
                                                                            if ($this->input->get('chk_vehicle') != '' && is_numeric($site_id)):
                                                                                $where = 'outsidecity_transportation_costs.sites_id = ' . $site_id . ' AND outsidecity_transportation_costs.transport_id IN (' . $transport_id . ') AND outsidecity_transportation_costs.status = "active"';
                                                                                $where .= ' AND date(outsidecity_transportation_costs.valid_from) <= "' . $details->check_in_date . '" AND date(outsidecity_transportation_costs.valid_to) >= "' . $details->check_out_date . '"';
                                                                                $join = [['type' => 'LEFT', 'join_table' => 'transportation', 'condition' => 'transportation.id = outsidecity_transportation_costs.transport_id']];
                                                                                $outsidecity_transportation = $this->common_model->get_data('outsidecity_transportation_costs', '', '', '*', $where, '', $count = false, $join);
                                                                            endif;
                                                                            ?>
                                                                            <div style="margin:0 0 !important;">
                                                                                <i title="Remove" class="fa fa-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>
                                                                                <span>
                                                                                    <i class="fas fa-hand-point-right" style="cursor:pointer;display:inline-flex; width:2%;" title="Edit" id="<?php echo $list->id; ?>"></i>
                                                                                </span>
                                                                                <span class="txt-edit" style="display:inline-table; width:85%;padding:3px;font-weight:600;"><?php echo urldecode($itinerary_sites[$key][$k]); ?></span>
                                                                                
                                                                                <?php
                                                                                $temp_itinerary['itinerary'][] = ['site_id' => $itinerary_sites_id[$key][$k], 'site_text' => $itinerary_sites[$key][$k]];
                                                                                
                                                                                $where = ' sites.id = ' . $site_id;
                                                                                $sites_ticket = $this->common_model->get_data('sites', '', '', '*', $where, '', $count = false);
                                                                                $adult_ticket = (int) $sites_ticket[0]->entry_ticket_fee;
                                                                                $child_ticket = $sites_ticket[0]->child_entry_ticket_fee;
                                                                                
                                                                                if ($sites_ticket[0]->entry_ticket == 'yes'):
                                                                                    $adults_num = $this->input->get('number_of_adults');
                                                                                    $child_num = $this->input->get('number_of_child');
                                                                                    
                                                                                    if ((int) $sites_ticket[0]->number_of_persons == '0' && ($adult_ticket !== 0 && (int) $child_ticket !== 0)):
                                                                                        $total_tickets = (int) $adults_num * (int) $adult_ticket + (int) $child_num * (int) $child_ticket;
                                                                                        ?>
                                                                                        <div class="alert alert-dark" style="margin:0 0 !important;padding:2px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                            <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                                <div class="col-md-4"><span style="color:#ef2100;float:left;"><i class="fa fa-file-text"></i>Ticket For </span></div>
                                                                                                <div class="col-md-2">Adult Cost</div>
                                                                                                <div class="col-md-1">Adults</div>
                                                                                                <?php if ($child_num != 0): ?>
                                                                                                    <div class="col-md-2">Child Cost</div>
                                                                                                    <div class="col-md-1">Child</div>
                                                                                                <?php endif; ?>
                                                                                                <div class="col-md-2">Total</div>    
                                                                                            </div>    
                                                                                            <div class="row ticket-row">
                                                                                                <div class="col-md-4" style="font-weight: 400;"><span style="float:left;"><?php echo $sites_ticket[0]->entry_ticket_for; ?></span></div>
                                                                                                <div class="col-md-2"><input type="text" class="adult_ticket" value="<?php echo (int) $adult_ticket; ?>" data-adults="<?php echo (int) $adults_num; ?>"> </div>
                                                                                                <div class="col-md-1">x <?php echo (int) $adults_num; ?></div>
                                                                                                <?php if ($child_num != 0): ?>
                                                                                                    <div class="col-md-2"><input type="text" class="child_ticket" value="<?php echo (int) $child_ticket; ?>" data-children="<?php echo (int) $child_num; ?>"> </div>
                                                                                                    <div class="col-md-1"> x <?php echo (int) $child_num; ?></div>
                                                                                                <?php endif; ?>
                                                                                                <div class="col-md-2"><input type="text" class="ticket_total" value="<?php echo $total_tickets; ?>" readonly></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php $final_ticket_price = $final_ticket_price + $total_tickets; ?>
                                                                                    <?php elseif ((int) $sites_ticket[0]->number_of_persons != '0' && (int) $sites_ticket[0]->group_entry_ticket_fee !== 0):
                                                                                        $persons_group = ceil(($adults_num + $child_num) / $sites_ticket[0]->number_of_persons);
                                                                                        $total_tickets = $persons_group * $sites_ticket[0]->group_entry_ticket_fee;
                                                                                        ?>
                                                                                        <div class="alert alert-dark" style="margin:0 0 !important;padding:2px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                            <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                                <div class="col-md-3"><span style="color:#ef2100;float:left;"><i class="fa fa-file-text"></i>Ticket For </span></div>
                                                                                                <div class="col-md-3">Perons in Group</div>
                                                                                                <div class="col-md-2">Group Cost</div>
                                                                                                <div class="col-md-2">Group</div>
                                                                                                <div class="col-md-2">Total</div>    
                                                                                            </div>    
                                                                                            <div class="row ticket-row">
                                                                                                <div class="col-md-3" style="font-weight: 400;"><span style="float:left;"><?php echo $sites_ticket[0]->entry_ticket_for; ?></span></div>
                                                                                                <div class="col-md-3"><?= $sites_ticket[0]->number_of_persons ?></div>
                                                                                                <div class="col-md-2"><input type="text" class="group_ticket" value="<?= $sites_ticket[0]->group_entry_ticket_fee ?>" data-group-size="<?= $sites_ticket[0]->number_of_persons ?>"></div>
                                                                                                <div class="col-md-2"> <input type="text" class="group_count" value="<?= $persons_group ?>"></div>
                                                                                                <div class="col-md-2"><input type="text" class="ticket_total" value="<?php echo $total_tickets; ?>" readonly></div>
                                                                                            </div>   
                                                                                        </div>
                                                                                        <?php $final_ticket_price = $final_ticket_price + $total_tickets; ?>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>

                                                                                <?php
                                                                                $activities_total = 0;
                                                                                if ($itinerary_activities[$key][$k] != ''):
                                                                                    ?>
                                                                                    <ol class="alert alert-dark" style="line-height:0.5rem;margin:0 0 !important;margin-top: 5px !important;">
                                                                                        <?php
                                                                                        $temp_itinerary['itinerary_activities'][] = $itinerary_activities[$key][$k];
                                                                                        $activities = explode(',', $itinerary_activities[$key][$k]);
                                                                                        foreach ($activities as $idx => $act):
                                                                                            $a = explode('_|_', $act);
                                                                                            $act_name_prices = explode('__', $a[0]);
                                                                                            $persons = explode('__', $a[1]);
                                                                                            $rowId = "row_" . $key . "_" . $k . "_" . $idx;
                                                                                            ?>
                                                                                            <li class="<?= $idx == 0 ? 'mt-2' : '' ?>">
                                                                                                <label style="width:30%;"><strong style="font-weight:600;"><?= $act_name_prices[0] ?></strong></label>
                                                                                                <label style="width:25%;">
                                                                                                    <strong>Adult Price:</strong>
                                                                                                    <input type="number" class="adult_price" data-row="<?= $rowId ?>" value="<?= $act_name_prices[1] ?>" style="max-width:60px;">
                                                                                                    x <?= $persons[0] ?>
                                                                                                    <input type="hidden" class="adults_count" data-row="<?= $rowId ?>" value="<?= $persons[0] ?>">
                                                                                                </label>
                                                                                                <?php if ($child_num != 0): ?>
                                                                                                    <label style="width:25%;">
                                                                                                        <strong>Child Price:</strong>
                                                                                                        <input type="number" class="child_price" data-row="<?= $rowId ?>" value="<?= $act_name_prices[2] ?>" style="max-width:60px;">
                                                                                                        x <?= $persons[1] ?>
                                                                                                        <input type="hidden" class="children_count" data-row="<?= $rowId ?>" value="<?= $persons[1] ?>">
                                                                                                    </label>
                                                                                                <?php endif; ?>
                                                                                                <label style="width:10%;">
                                                                                                    <strong>Total:</strong>
                                                                                                    <input type="number" class="activity_total" id="<?= $rowId ?>" 
                                                                                                        value="<?= (int) $act_name_prices[1] * (int) $persons[0] + (int) $act_name_prices[2] * (int) $persons[1] ?>" 
                                                                                                        readonly>
                                                                                                </label>
                                                                                            </li>
                                                                                            <input type="hidden" name="itinerary_activities_<?= $i ?>[]" 
                                                                                                value="<?= $act_name_prices[0] . ' Adult: ' . $persons[0] . ' Child: ' . $persons[1] ?>">
                                                                                            <?php $activities_total += (int) $act_name_prices[1] * (int) $persons[0] + (int) $act_name_prices[2] * (int) $persons[1]; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </ol>
                                                                                <?php endif; ?>
                                                                                <?php $all_day_activities_total += $activities_total; ?>

                                                                                <?php if (!$skipOutsideCharge && !empty($outsidecity_transportation) && $outsidecity_flag && $this->input->get('chk_vehicle[]') != ''):
                                                                                    $qnty = $this->input->get('vehicle_quantity[]');
                                                                                    $vehicles = $this->input->get('chk_vehicle[]');
                                                                                    if (!empty($outsidecity_transportation && $outsidecity_flag)):
                                                                                        ?>
                                                                                        <div class="alert alert-dark " style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                            <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">
                                                                                                <div class="col-md-2"><span style="color:#ef2100;"><i class="fa fa-taxi"></i> Outside City</span></div>
                                                                                                <div class="col-md-3">Vehicle Name</div>
                                                                                                <div class="col-md-2">Price</div>
                                                                                                <div class="col-md-2">Parking</div>
                                                                                                <div class="col-md-1">Qty.</div>
                                                                                                <div class="col-md-2">Total</div>
                                                                                            </div>
                                                                                            <?php
                                                                                            $transportation_total2 = 0;
                                                                                            $outside_toll_price = 0;
                                                                                            foreach ($outsidecity_transportation as $d):
                                                                                                $key_index = array_search($d->id, $vehicles);
                                                                                                if ($key_index !== false):
                                                                                                    // Default (from DB)
                                                                                                    $price = $d->price;
                                                                                                    $toll = $d->toll_price;
                                                                                                    $parking = $d->parking_price;
                                                                                                    $qty = $qnty[$key_index];
                                                                                                    $total = ($price + $parking) * $qty;

                                                                                                    if (isset($savedByDayVehicle[$i][$d->vehicle_name])):
                                                                                                        $saved = $savedByDayVehicle[$i][$d->vehicle_name];
                                                                                                        $price = $saved['price'];
                                                                                                        $toll = $saved['toll'];
                                                                                                        $parking = $saved['parking'];
                                                                                                        $qty = $saved['qty'];
                                                                                                        $total = $saved['total'];
                                                                                                    endif;
                                                                                                    ?>
                                                                                                    <div class="row outside-transport-row" style="line-height: 15px;margin-top: 2px;">
                                                                                                        <div class="col-md-2"></div>
                                                                                                        <div class="col-md-3">
                                                                                                            <?= $d->vehicle_name ?><br>
                                                                                                            Toll: <input type="text" name="" class="out_toll" value="<?= $toll ?>">
                                                                                                        </div>
                                                                                                        <div class="col-md-2"><input type="text" name="" class="out_price" value="<?= $price ?>"></div>
                                                                                                        <div class="col-md-2"><input type="text" name="" class="out_parking" value="<?= $parking ?>"></div>
                                                                                                        <div class="col-md-1"><input type="text" class="out_qty" value="<?= $qty ?>"></div>
                                                                                                        <div class="col-md-2"><input type="text" class="out_total" value="<?= $total ?>" readonly></div>
                                                                                                    </div>
                                                                                                    <?php
                                                                                                    $transportation_total2 = $transportation_total2 + $total;
                                                                                                    $outside_toll_price += $toll;
                                                                                                endif;
                                                                                            endforeach;
                                                                                            ?>
                                                                                            <input type="hidden" class="total-outside" name="hdn_transportation_outside_<?= $key ?>" value="<?= $transportation_total2 ?>">
                                                                                        </div>
                                                                                        <?php $all_days_outside_transport += $transportation_total2; ?>
                                                                                    <?php endif; ?>
                                                                                    <?php $outsidecity_flag = false; ?>
                                                                                <?php endif; ?>

                                                                                <input type="hidden" name="itinerary_title_<?= $i ?>[]" value="<?php echo urldecode($itinerary_sites[$key][$k]); ?>">
                                                                                <input type="hidden" name="itinerary_title_search_<?= $i ?>[]" value="<?php echo urldecode($itinerary_sites[$key][$k]); ?>">
                                                                                <input type="hidden" name="itinerary_sites_id_<?= $i ?>[]" value="<?php echo urldecode($itinerary_sites_id[$key][$k]); ?>">
                                                                                <input type="hidden" name="itinerary_text_<?= $i ?>[]" value="<?php echo urldecode($itinerary_sites[$key][$k]); ?>">
                                                                                <input type="hidden" name="itinerary_remarks_<?= $i ?>[]" value="">
                                                                                <input type="hidden" name="itinerary_time_<?= $i ?>[]" value="">
                                                                                <?php if($sites_ticket[0]->entry_ticket == 'yes'){ 
                                                                                    $ticket_for = $sites_ticket[0]->entry_ticket_for;
                                                                                    $site_name = $sites_ticket[0]->site_name;
                                                                                
                                                                                    if (!empty($ticket_for)) {
                                                                                        $ticket_for_with_site = $ticket_for . ' (' . $site_name . ')';?>
                                                                                        <input type="hidden" name="itinerary_entry_ticket_<?= $i ?>[]" value="<?= htmlspecialchars($ticket_for_with_site, ENT_QUOTES, 'UTF-8'); ?>">
                                                                                <?php } 
                                                                                } ?>

                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    <?php else:
                                                                        $guide_days[$key] = 0;
                                                                    endif;
                                                                    
                                                                    $itinerary_date = $list->date;
                                                                    if (!array_key_exists($key + 1, $template_content) || $itinerary_date != $template_content[$key + 1]->date):
                                                                        $quotation_itinerary['itinerary_sites_id_' . $i] = !empty($temp_itinerary) ? $temp_itinerary : [];
                                                                        $temp_itinerary = []; ?>

                                                                            <!-- ================== MEAL DETAILS TABLE - MOVED TO END ================== -->
                                                                                <?php if($data_meal && ($this->input->get('meal') =='yes') ): 
                                                                                // Static test data for arrival and departure times
                                                                                $static_arrival_time = $this->input->get('arrival_time');
                                                                                $static_departure_time = $this->input->get('departing_time');
                                                                                $total_days = $this->input->get('number_of_nights') + 1;

                                                                                // Convert to decimal for comparison (same logic as JS)
                                                                                $arrival_decimal = null;
                                                                                $departure_decimal = null;
                                                                                
                                                                                if ($static_arrival_time) {
                                                                                    list($arrival_hours, $arrival_minutes) = explode(':', $static_arrival_time);
                                                                                    $arrival_decimal = (int)$arrival_hours + ((int)$arrival_minutes / 60);
                                                                                }
                                                                                
                                                                                if ($static_departure_time) {
                                                                                    list($departure_hours, $departure_minutes) = explode(':', $static_departure_time);
                                                                                    $departure_decimal = (int)$departure_hours + ((int)$departure_minutes / 60);
                                                                                }
                                                                                
                                                                                $meal_price_data = json_decode($this->input->get('meal_price'), true);
                                                                                $current_day_number = $key + 1;
                                                                                
                                                                                if($this->input->get('days') == 'all'){
                                                                                    $day_key = "Day_" . $current_day_number;
                                                                                } else {
                                                                                    $day_key = "day_" . $current_day_number;
                                                                                }
                                                                            ?>
                                                                            <div class="alert mt-2" style="background-color:#3333;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                                <h6 align="left" style="margin-bottom:5px;color:#ef2100; font-weight:600">
                                                                                    <i class="fa fa-cutlery"></i> Meals
                                                                                </h6>
                                                                                <?php
                                                                                echo '<table border="1" cellpadding="6" cellspacing="0" class="table table-sm table-bordered text-center" style="">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Meal Type</th>
                                                                                                <th>Cuisine Type</th>
                                                                                                <th>Price</th>
                                                                                                <th>No. of Persons</th>
                                                                                                <th>Total</th>
                                                                                            </tr>
                                                                                        </thead><tbody>';

                                                                                $total_meal_cost = 0;
                                                                                $has_meals_for_day = false;
                                                                                // Handle "all" meals (same for every day)
                                                                                if (isset($data_meal['all'])) {
                                                                                    $meal_types = array_keys($data_meal['all']);
                                                                                    $day_form_key = "Day_" . $current_day_number;

                                                                                    foreach ($meal_types as $buffet_type) {
                                                                                        // Apply buffet exclusion logic for "all" days (same as JS logic)
                                                                                        $should_disable = false;
                                                                                        $disable_reason = '';
                                                                                    
                                                                                        // For Day 1 meals
                                                                                        if ($current_day_number == 1 && $arrival_decimal !== null) {
                                                                                            switch($buffet_type) {
                                                                                                case 'lunch':
                                                                                                    if ($arrival_decimal >= 14.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Lunch not available (Arrival at {$static_arrival_time})";
                                                                                                    }
                                                                                                    break;
                                                                                                case 'dinner':
                                                                                                    if ($arrival_decimal >= 20.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Dinner not available (Arrival at {$static_arrival_time})";
                                                                                                    }
                                                                                                    break;
                                                                                                case 'gala_dinner':
                                                                                                    if ($arrival_decimal >= 22.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Gala Dinner not available (Arrival at {$static_arrival_time})";
                                                                                                    }
                                                                                                    break;
                                                                                                case 'cocktail_dinner':
                                                                                                    if ($arrival_decimal >= 23.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Cocktail Dinner not available (Arrival at {$static_arrival_time})";
                                                                                                    }
                                                                                                    break;
                                                                                            }
                                                                                        }
                                                                                        
                                                                                        // For Last Day meals
                                                                                        if ($current_day_number == $total_days && $departure_decimal !== null) {
                                                                                            switch($buffet_type) {
                                                                                                case 'lunch':
                                                                                                    if ($departure_decimal < 14.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Lunch not available (Departure at {$static_departure_time})";
                                                                                                    }
                                                                                                    break;
                                                                                                case 'dinner':
                                                                                                    if ($departure_decimal < 20.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Dinner not available (Departure at {$static_departure_time})";
                                                                                                    }
                                                                                                    break;
                                                                                                case 'gala_dinner':
                                                                                                    if ($departure_decimal < 22.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Gala Dinner not available (Departure at {$static_departure_time})";
                                                                                                    }
                                                                                                    break;
                                                                                                case 'cocktail_dinner':
                                                                                                    if ($departure_decimal < 23.0) {
                                                                                                        $should_disable = true;
                                                                                                        $disable_reason = "Cocktail Dinner not available (Departure at {$static_departure_time})";
                                                                                                    }
                                                                                                    break;
                                                                                            }
                                                                                        }
                                                                                        
                                                                                        // Skip disabled buffets
                                                                                        if ($should_disable) {
                                                                                            continue;
                                                                                        }
                                                                                        
                                                                                        if (isset($meal_price_data[$day_key][$buffet_type]['price'])) {
                                                                                            $price = $meal_price_data[$day_key][$buffet_type]['price'];
                                                                                        } else {
                                                                                            // Otherwise, fetch old price from DB
                                                                                            $price = $this->db
                                                                                                ->select('price')
                                                                                                ->from('meal_per_person_cost')
                                                                                                ->where('ctype', $cusine)
                                                                                                ->where('buffet', $buffet_type)
                                                                                                ->get()
                                                                                                ->row('price');
                                                                                        }

                                                                                        $meal_total = $price * $total_persons;
                                                                                        $total_meal_cost += $meal_total;
                                                                                        $has_meals_for_day = true;
                                                                                        $buffet_type_display = str_replace('_', ' ', $buffet_type);

                                                                                        echo "
                                                                                        <tr>
                                                                                            <td>{$buffet_type_display}</td>
                                                                                            <td>{$cusine}</td>
                                                                                            <td>
                                                                                                <input type='number' 
                                                                                                    class='meal-price form-control form-control-sm' 
                                                                                                    name='meal_price[{$day_form_key}][{$buffet_type}]' 
                                                                                                    value='{$price}' 
                                                                                                    data-persons='{$total_persons}'>
                                                                                            </td>
                                                                                            <td>{$total_persons}</td>
                                                                                            <td>
                                                                                                <input type='number' 
                                                                                                    class='meal-total form-control form-control-sm' 
                                                                                                    value='{$meal_total}' readonly>
                                                                                            </td>
                                                                                        </tr>";
                                                                                    }
                                                                                }

                                                                                // Handle day-wise meals
                                                                                elseif (isset($data_meal[$day_key]) && !empty($data_meal[$day_key] && ($this->input->get('meal') =='yes') )) {
                                                                                    foreach ($data_meal[$day_key] as $buffet_type => $val) {
                                                                                        if ($val == 1) {
                                                                                            // Apply buffet exclusion logic for day-wise meals
                                                                                            $should_disable = false;
                                                                                            $disable_reason = '';
                                                                                            
                                                                                            // For Day 1 meals
                                                                                            if ($current_day_number == 1 && $arrival_decimal !== null) {
                                                                                                switch($buffet_type) {
                                                                                                    case 'lunch':
                                                                                                        if ($arrival_decimal >= 14.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'dinner':
                                                                                                        if ($arrival_decimal >= 20.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'gala_dinner':
                                                                                                        if ($arrival_decimal >= 22.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'cocktail_dinner':
                                                                                                        if ($arrival_decimal >= 22.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                }
                                                                                            }
                                                                                            
                                                                                            // For Last Day meals
                                                                                            if ($current_day_number == $total_days && $departure_decimal !== null) {
                                                                                                switch($buffet_type) {
                                                                                                    case 'lunch':
                                                                                                        if ($departure_decimal < 14.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'dinner':
                                                                                                        if ($departure_decimal < 20.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'gala_dinner':
                                                                                                        if ($departure_decimal < 18.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'cocktail_dinner':
                                                                                                        if ($departure_decimal < 18.0) {
                                                                                                            $should_disable = true;
                                                                                                        }
                                                                                                        break;
                                                                                                }
                                                                                            }
                                                                                            
                                                                                            // Skip disabled buffets
                                                                                            if ($should_disable) {
                                                                                                continue;
                                                                                            }

                                                                                            if (isset($meal_price_data[$day_key][$buffet_type]['price'])) {
                                                                                                $price = $meal_price_data[$day_key][$buffet_type]['price'];
                                                                                            } else {
                                                                                                // Otherwise, fetch old price from DB
                                                                                                $price = $this->db
                                                                                                    ->select('price')
                                                                                                    ->from('meal_per_person_cost')
                                                                                                    ->where('ctype', $cusine)
                                                                                                    ->where('buffet', $buffet_type)
                                                                                                    ->get()
                                                                                                    ->row('price');
                                                                                            }
                                                                                            
                                                                                            $meal_total = $price * $total_persons;
                                                                                            $total_meal_cost += $meal_total;
                                                                                            $has_meals_for_day = true;
                                                                                            $buffet_type_display = str_replace('_', ' ', $buffet_type);

                                                                                            echo "<tr>
                                                                                                <td>{$buffet_type_display}</td>
                                                                                                <td>{$cusine}</td>
                                                                                                <td>
                                                                                                    <input type='number' 
                                                                                                        class='meal-price form-control form-control-sm' 
                                                                                                        name='meal_price[{$day_key}][{$buffet_type}]' 
                                                                                                        value='{$price}' 
                                                                                                        data-persons='{$total_persons}'>
                                                                                                </td>
                                                                                                <td>{$total_persons}</td>
                                                                                                <td>
                                                                                                    <input type='number' 
                                                                                                        class='meal-total form-control form-control-sm' 
                                                                                                        value='{$meal_total}' readonly>
                                                                                                </td>
                                                                                            </tr>";
                                                                                        }
                                                                                    }
                                                                                }

                                                                                if (!$has_meals_for_day) {
                                                                                    echo "<tr><td colspan='5'>No meals for this day</td></tr>";
                                                                                }

                                                                                echo "</tbody></table>";
                                                                                ?>
                                                                            </div>
                                                                            <?php endif; ?>
                                                                                
                                                                                <?php
                                                                                    $all_day_meal_prices = [];

                                                                                    // Ensure $data_meal is an array
                                                                                    if (!empty($data_meal) && is_array($data_meal)) {
                                                                                        foreach ($data_meal as $day_key => $day_meals) {
                                                                                            // Ensure $day_meals is an array
                                                                                            if (!empty($day_meals) && is_array($day_meals)) {
                                                                                                foreach ($day_meals as $buffet_type => $val) {
                                                                                                    if ($val == 1 || $day_key == 'all') {
                                                                                                        $price = $this->db
                                                                                                            ->select('price')
                                                                                                            ->from('meal_per_person_cost')
                                                                                                            ->where('ctype', $cusine)
                                                                                                            ->where('buffet', $buffet_type)
                                                                                                            ->get()
                                                                                                            ->row('price');

                                                                                                        $all_day_meal_prices[$day_key][$buffet_type] = [
                                                                                                            'price' => $price,
                                                                                                            'total_persons' => $total_persons,
                                                                                                            'meal_total' => $price * $total_persons,
                                                                                                            'cusine' => $cusine
                                                                                                        ];
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    } else {
                                                                                        // Initialize empty array to avoid undefined variable issues
                                                                                        $all_day_meal_prices = [];
                                                                                    }
                                                                                    ?>


                                                                            <!-- ================== END MEAL TABLE ================== -->
                                                                        </li>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            
                                                            <input type="radio" name="rdo-edit" class="rdo hide" value="new">
                                                        <?php endif; ?>
                                                    </ul>
                    </div>
                                <!--div class="col-md-2">Remarks</div-->
                    
                </div>
                                        
                        <input type="hidden" id="hdn-operational-days" value="">
                        <input type="hidden" name="markup_percentage" value="<?=$this->input->get('markup_percentage')?>">
                        <input type="hidden" name="hotel_markup_percentage" value="<?=$hotel_markup_percentage;?>">
                        <!-- <input type="hidden" name="hdn_final_ticket_price" id="hdn_final_ticket_price" value="<?php echo $final_ticket_price; ?>"/> -->
                        <?php echo form_close(); ?>
                    </div>	
                                    
                                    <div class="col-lg-4">
                                        <div id="msg"></div>
                                        <?php echo form_open_multipart('', ['id' => 'frm1']); ?>
										
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20 hide">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="itinerary_type" id="itinerary_type"
                                                        class="mdl-textfield__input" style="padding-top:13px;">
                                                        <option value=""></option>
                                                        <option value="sitescene">Sightseeing</option>
                                                        <!--option value="activity">Activity</option>
                                                        <option value="night-life">Night Life</option>
                                                        <option value="restaurants">Restaurants</option>
                                                        <option value="transfers">Transfers</option>
                                                        <option value="miscellaneous">Miscellaneous</option-->
                                                    </select>
                                                    <label class="mdl-textfield__label">Suggestions</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20 hide">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="padding-top:27px;">
                                                    <select name="itinerary_values" id="itinerary_values"
                                                        class="mdl-textfield__input" style="padding-top:13px;">
                                                        <option value=""></option>
                                                    </select>
                                                    <!--label class="mdl-textfield__label">Select..</label-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20 hide">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display: inline-flex;">
                                                    <input type="text" name="" class="mdl-textfield__input dt-date-show"
                                                        value="" style="width:90%;" readonly>
                                                    <input type="date" id="frm_date" name=""
                                                        class="mdl-textfield__input dt-date" style="width:7%;">
                                                    <label class="mdl-textfield__label">Date</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20 hide">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="time" id="frm_time" name=""
                                                        class="mdl-textfield__input">
                                                    <label class="mdl-textfield__label">Time</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 hide" id="chk_suggestions"
                                                style="background-color:#f8fcff;display:none;padding:7px;word-wrap:break-word;">

                                            </div>
                                            <div class="col-lg-12 p-t-20 hide">
                                                <label class="" style="font-weight: 600;font-size: 14px">Title</label>
                                                <textarea class="form-control" name="title" id="title" required=""></textarea>
                                                <script>
                                                    CKEDITOR.replace('title');
                                                </script>
                                                <br>
                                            </div>
											
                                            <div class="col-lg-8 p-t-2 hide">
						                    <div id="msg-show" style=""></div>
                                            </div>
                                            <div class="col-lg-4 p-t-2 hide">
                                                <button type="button" class="btn btn-primary" id="btn-add-update" style="float:right;">Add & Update >></button><br>
                                            </div>
                                            
                                            <div class="col-lg-12 p-t-20">
                                                <div class="panel-group" id="accordion">
                                                        <div class="">
                                                                <div class="">
                                                                        <h6 class="panel-title"><i class="fa fa-edit"></i>
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                                        Inclusions</a>
                                                                        </h6>
                                                                </div>
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                        <div class="panel-body">
                                                                                <textarea class="form-control" name="inclusions" id="inclusions" required="">
                                                                                <ul>
                                                                                        <?php if(!empty($transportation)){ ?>
                                                                                                <li>Complimentary access to&nbsp;Free-WiFi&nbsp;in the vehicle during tours.</li>
                                                                                                <li>Welcome with chocolates &amp; refreshing napkins.</li>
                                                                                                <li>All transfers &amp; sightseeing by private vehicle&nbsp;(&nbsp;<?php echo implode(' , ', array_column($transportation, 'vehicle_name')); ?>&nbsp;)&nbsp;for 12 Hrs (10AM – 10PM Only, Within City Limits)&nbsp;&nbsp;&nbsp;</li>
                                                                                                <li>All transfers &amp; sightseeing include services of an English-speaking&nbsp;Guide.</li>
                                                                                        <?php } if(!empty($airport_transfer_in)){  ?>
                                                                                                <li>Airport meet&nbsp;&amp; greet by our English-speaking staff.</li>
                                                                                        <?php } 
                                                                                        $itinerary_html = $this->input->get('hdn_itinerary_content');
                                                                                        if(!empty($itinerary_html)){
                                                                                                foreach($itinerary_html AS $html){
                                                                                                        foreach($html AS $li){
                                                                                                                echo '<li>'.$li.'</li>';
                                                                                        }}} ?>
                                                                                        <li>2 bottles of water per person during all excursions &amp; transfers.</li>
                                                                                        <li>A parting gift courtesy&nbsp;Kazin DMC.&nbsp;</li>
                                                                                        <li>Hotel taxes included.</li>
                                                                                        <li>24 x 7 assistance by our ground staff.</li>
                                                                                </ul>
                                                                                </textarea>
                                                                                <script>
                                                                                        CKEDITOR.replace('inclusions');
                                                                                </script>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="">
                                                                <div class="">
                                                                        <h6 class="panel-title"><i class="fa fa-edit"></i>
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                                        Exclusions</a>
                                                                        </h6>
                                                                </div>
                                                                <div id="collapse2" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                                <textarea class="form-control" name="exclusions" id="exclusions" required="">
                                                                                <ol><li>Extra excursions. Any expenditure of Personal nature. E.g., Laundry, Tips, phone calls etc.</li><li>Meals, unless or otherwise specified in the above quote.</li><li>Anything not mentioned above</li><li>Entrance charges to Nightclubs, monuments etc.</li><li>Consumption of food &amp; beverages at Nightclub/s.</li><li>Beverage consumption during lunches &amp; dinner.<br></li></ol>
                                                                                </textarea>
                                                                                <script>
                                                                                        CKEDITOR.replace('exclusions');
                                                                                </script>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="">
                                                                <div class="">
                                                                        <h6 class="panel-title"><i class="fa fa-edit"></i>
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                                        Important Notes</a>
                                                                        </h6>
                                                                </div>
                                                                <div id="collapse3" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <textarea class="form-control" name="important_notes" id="important_notes" required="">
                                                                        <ol>
                                                                            <li>Airfare is not included and may change at the time of finalization of the booking.</li>
                                                                            <li>The above package is based on the exact number of PAX mentioned.</li>
                                                                            <li>Check-in time: 14:00 – 15:00 hrs & Check-out time: 11:00 – 12:00 hrs, and may vary by property.</li>
                                                                            <li>The above is just a quotation and is subject to availability &amp; currency fluctuation.</li>
                                                                            <li>Above is just a quote and we are not holding reservations.</li>
                                                                            <li>While we may make recommendations for hotels all around the world, we do not guarantee and are not responsible for the services or the hardware provided by the hotel/s suggested by us. We strongly urge you to do your own research and make an informed choice.</li>
                                                                            <li><b>Some hotels may require a mandatory security deposit of USD 100–200 per room, per stay (refundable as per hotel policy).</b><br></li>
                                                                        </ol>
                                                                        </textarea>
                                                                        <script>
                                                                            CKEDITOR.replace('important_notes');
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="">
                                                                <div class="">
                                                                        <h6 class="panel-title"><i class="fa fa-edit"></i>
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                                        Cancellation Policy</a>
                                                                        </h6>
                                                                </div>
                                                                <div id="collapse4" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                                <textarea class="form-control" name="cancellation_policy" id="cancellation_policy" required="">
                                                                                <p><strong>Standard FIT Cancellation Policy</strong></p><ul><li style="margin-left: 47.25pt;">Within 72 hrs of departure – 100% Non-Refundable</li><li style="margin-left: 47.25pt;">Before 72 hrs of Departure – Nil Cancellation</li></ul><p><strong>Groups Cancellation Policy - 100% Non-Refundable once booked</strong></p>
                                                                                </textarea>
                                                                                <script>
                                                                                    CKEDITOR.replace('cancellation_policy');
                                                                                </script>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                    </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                        <div class="my-card">
                                <?php 
                                 $updown_total=0;
                        if($this->input->get('hotel') == 'yes'){  
                            if($this->input->get('hdn_group_type') == 'family')
                            {
                                $hotel_costing = $hotel_names = []; 
                                $num = 1;
                                $hotel_nights = [];
                                $number_of_nights = $this->input->get('number_of_nights');
                                $nights = 1;
                               
                                $quotation_hotel_details = [];
                                $hotel_costing_category_wise = [];
                                $hotel_names_category_wise  = [];
                                $hotel_room_category_names_wise = [];
                                $temp_arr = [];
                            
                            foreach($this->input->get('hotel_category') AS $category){ 
                                $hotel_costing = [];
                                $hotel_names = [];
                                $temp_arr = ['hotel_category'=>$category];  

                                if(array_key_exists('chk_all_hotels', $this->input->get()))
                                {
                                    $allHotelsArr = [];
                                    for($i = 1; $i <= $number_of_nights; $i++){
                                        $nightHotels = $this->input->get('hdn_night_'.$i.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                        if(!empty($nightHotels)){
                                            sort($nightHotels);
                                            $allHotelsArr[] = implode('|', $nightHotels);
                                        }
                                    }
                                    $allSameHotels = count(array_unique($allHotelsArr)) === 1;
                                    if($allSameHotels){
                                        $number_of_nights = 1;
                                        $nights = $this->input->get('number_of_nights');
                                        if ($this->input->get('early_checkin') == 'on') {
                                            $nights++;
                                        }
                                    } else {
                                        $number_of_nights = $this->input->get('number_of_nights');
                                        $nights = 1;

                                        $hotelNightWise = [];
                                        for($i = 1; $i <= $this->input->get('number_of_nights'); $i++){
                                            $nightHotels = $this->input->get('hdn_night_'.$i.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                            if(!empty($nightHotels)){
                                                foreach($nightHotels as $hId){
                                                    if($hId == '') continue;
                                                    if(!isset($hotelNightWise[$hId])) $hotelNightWise[$hId] = 0;
                                                    $hotelNightWise[$hId]++;
                                                }
                                            }
                                        }
                                        $hotel_nights[$category] = $hotelNightWise;
                                    }
                                }
                                ?>
                                <div class="col-md-12 text-center pt-2">
                                    <h5 class="bold" style="padding: 10px;background-color: #f1f6f9;"><?php echo $category; ?></h5>
                                </div> 
                                <?php
                               
                                // $hotel_night_count = [];
                                // for($n=1; $n <= $number_of_nights; $n++){ 
                                //     // $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.''.str_replace(' ', '', strtolower($category)).'_ids');
                                //       $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                //     if (!empty($hdn_hotel_ids)) {
                                //         $uniqueHotels = array_unique($hdn_hotel_ids);

                                //         foreach($uniqueHotels AS $list){
                                //             if($list == '') continue;
                                //             if (!isset($hotel_night_count[$list])) {
                                //                 $hotel_night_count[$list] = 0;
                                //             }
                                //             $hotel_night_count[$list]++; 
                                //         }
                                //     }
                                // }
                                 $hotel_night_count = [];
                                for ($n = 1; $n <= $number_of_nights; $n++) { 
                                    $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                    if (!empty($hdn_hotel_ids)) {
                                        $uniqueHotels = array_unique($hdn_hotel_ids);

                                        foreach ($uniqueHotels as $list) {
                                            if ($list == '') continue;

                                            // Initialize array if not already
                                            if (!isset($hotel_night_count[$list])) {
                                                $hotel_night_count[$list] = [];
                                            }

                                            // Add night number instead of incrementing count
                                            $hotel_night_count[$list][] = $n;
                                        }
                                    }
                                }

                                $earlyCheckinHotels = [];
                                if ($this->input->get('early_checkin') == 'on') {
                                    $day1_hotels = $this->input->get('hdn_night_1_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                    if (!empty($day1_hotels)) {
                                        foreach ($day1_hotels as $day1_hotel_id) {
                                            if ($day1_hotel_id != '') {
                                                $earlyCheckinHotels[] = $day1_hotel_id;
                                                $hotel_night_count[$day1_hotel_id] = $hotel_night_count[$day1_hotel_id] ?? [];
                                                $hotel_night_count[$day1_hotel_id][] = 0; 
                                                // if (isset($hotel_night_count[$day1_hotel_id])) {
                                                //     $hotel_night_count[$day1_hotel_id] += 1;
                                                // } else {
                                                //     $hotel_night_count[$day1_hotel_id] = 1;
                                                // }
                                            }
                                        }
                                    }
                                }

                                for($n=1;$n<=$number_of_nights;$n++){ 
                                    $temp_arr['night'] = $n;
                                    
                                ?>
                                <div class="card-body row">
                                                   
                                    <?php
                                    $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                    foreach($hdn_hotel_ids AS $list){
                                        if($list == ''){ continue; }
                                        $grand_total = 0;
                                        $where = 'hotels.id = '.$list;
                                        $hotel_name = $this->common_model->get_data('hotels','', '', 'hotels.name,hotels.id, hotels.city, hotels.destination',$where, '', $count = false);
                                        $temp_category_all = [];
                                        $hotel_id = $hotel_name[0]->id ?? ''; 
                                        if (in_array($hotel_id, $earlyCheckinHotels)) {
                                            $night_text = '(Nights + Early Checkin)';
                                        } else {
                                            $night_text = '(Nights)';
                                        }
                                        
                                        if (!empty($hotel_name) && isset($hotel_name[0]->id)) {
                                            $currentDestination = $hotel_name[0]->destination;
                                            $isOutsideDestination = (strtolower($currentDestination) !== strtolower($main_arrival_city));

                                            $temp_arr_1 = $temp_arr + [
                                                    'hotel_name' => $hotel_name[0]->name,
                                                    'hotel_city' => $hotel_name[0]->city,
                                                    'hotel_id'   => $hotel_name[0]->id
                                                ];
                                        } else {
                                                $temp_arr_1 = $temp_arr + [
                                                    'hotel_name' => 'NA (Proceed without hotel)',
                                                    'hotel_city' => '',
                                                    'hotel_id'   => 0
                                                ];
                                        }
                                        
                                    ?>
                                            
                                        <?php if(!empty($this->input->get('night_'.$n.'_category_ids_'.$list)) && $this->input->get('hotel')=='yes'){
                                                
                                                $grand_total=0;
                                                $temp_category_all = [];
                                                // $category_cnt = count($this->input->get('night_'.$n.'_category_ids_'.$list)); ?>
                                                
                                                <div class="col-md-6" style="border:1px solid;">
                                                    <div class="col-md-12 text-center bg-info" style="color:#FFF;font-weight:600;padding:2px;">
                                                        <h5 class="bold"><?php echo ($this->input->get('hotel')=='yes')?'Hotel Costing ('.ucfirst($hotel_name[0]->name).')':'<label style="color:#ff0202;">Without Hotel</label>'; ?></h5>
                                                    </div>
                                                <?php   
                                                // $temp_category = [];
                                                foreach($this->input->get('night_'.$n.'_category_ids_'.$list) AS $c){
                                                    $k=0;
                                                    $category_arr = explode('_', $c);
                                            
                                                    $cat_key = str_replace(' ', '_', $category);
                                                    if (!isset($hotel_room_category_names_wise[$cat_key])) {
                                                        $hotel_room_category_names_wise[$cat_key] = [];
                                                    }
                                                   if (!isset($hotel_room_category_names_wise[$cat_key][$hotel_name[0]->id])) {
                                                        $hotel_room_category_names_wise[$cat_key][$hotel_name[0]->id] = [];
                                                    }
                                                    if (!in_array($category_arr[1], $hotel_room_category_names_wise[$cat_key][$hotel_name[0]->id])) {
                                                        $hotel_room_category_names_wise[$cat_key][$hotel_name[0]->id][] = $category_arr[1];
                                                    }
                                        ?>
                                        
                                            <div class="row mb-2">
                                                <div class="col-md-12 bold text-center">&nbsp;</div>
                                                <div class="col-md-4 bold">Category</div>
                                                <div class="col-md-8 bold" style="text-align:right;">Costing</div>
                                            </div>

                                            <div class="row p-2 bg-grey" style="line-height:1.2">             
                                                <div class="col-md-4" style="font-weight:600;"><?php echo $category_arr[1]; ?></div>
                                                <div class="col-md-8 hotel-block" style="text-align:right;" >
                                                    <ul style="list-style-type:none;font-size: inherit;line-height: inherit;">
                                                        <?php 
                                                        $sub_total = 0;
                                                        $tt=0;
                                                        $temp_category = [];
                                                        foreach($this->input->get('night_'.$n.'_'.$category_arr[0].'_'.$list.'_hotel_prices') AS $key=>$val){
                                                                $total=0; 
                                                                $temp_category[] = ['room_type'=>$val,'room_count'=>$this->input->get($category_arr[0].'_room_cnt')[$key]];
                                                                
                                                                foreach($val AS $pr){
                                                                    $prices = explode(' ',$pr);
                                                                    $str = $pr;
                                                                    // Separate room occupancy
                                                                    preg_match('/\d+\(A\)/', $str, $matchesOccupancy);
                                                                    preg_match('/\d+\((A|C)\)/', $str, $matchesOccupancy);
                                                                    $room_occupancy = isset($matchesOccupancy[0]) ? $matchesOccupancy[0] : '';
                                                                    $occLabel = [
                                                                    '1(A)' => 'Single Occupancy',
                                                                    '2(A)' => 'Double Occupancy',
                                                                    '3(A)' => 'Triple Occupancy',
                                                                    '1(C)' => 'Single Child Occupancy',
                                                                    '2(C)' => 'Single Child Occupancy',
                                                                    '3(C)' => 'Single Child Occupancy',
                                                                ];
                                                                $occupancyText = $occLabel[$room_occupancy] ?? '';

                                                        ?>
                                                        <li>
                                                            <div class="hotel-row"
                                                                data-category="<?= str_replace(' ', '_', $category) ?>"
                                                                data-hotel-id="<?= htmlspecialchars($hotel_id) ?>"
                                                                data-room="<?= htmlspecialchars($category_arr[1]) ?>" data-occupancy="<?= $occupancyText ?>" >
                                                            <?php
                                                            // $hotel_nights = $hotel_night_count[$hotel_name[0]->id] ?? 1;
                                                            // $hotel_night_value = $hotel_night_count[$hotel_name[0]->id] ?? 1;
                                                            $hotel_nights_array = $hotel_night_count[$hotel_name[0]->id] ?? [1]; 
                                                            $hotel_night_value = count($hotel_nights_array);
                                                            $indexKey = $hotel_name[0]->id . '_' . $c . '_' . $tt;
                                                                if($number_of_nights !=1){
                                                                    echo $pr ?><input type="text" value="<?=$prices[1];?>" class="per-night" style="max-width:70px !important;" data-nights="<?= $hotel_night_value ?>" data-rooms="<?= $this->input->get($category_arr[0].'_room_cnt')[$key]; ?>" data-index="<?= $indexKey ?>" > x <?=$hotel_night_value.$night_text ?> = <label style="font-weight:600;">
                                                                    <?php  $amt=$hotel_night_value*$prices[1]; $total=$total+$amt;?>
                                                                    <input type="text" value="<?=$amt;?>" class="night-total" data-index="<?= $indexKey ?>"  style="max-width:90px !important;" readonly>
                                                              <?php  }else{
                                                                    echo $pr; ?><input type="text" value="<?=$prices[1];?>" class="per-night" style="max-width:70px !important;" data-nights="<?= $nights ?>"  data-rooms="<?= $this->input->get($category_arr[0].'_room_cnt')[$key]; ?>" data-index="<?= $indexKey ?>" > x <?=$nights.$night_text ?> = <label style="font-weight:600;">
                                                                    <?php  $amt=$nights*$prices[1]; $total=$total+$amt;?>
                                                                    <input type="text" value="<?=$amt;?>" class="night-total" data-index="<?= $indexKey ?>"  style="max-width:90px !important;" readonly>
                                                            <?php    }    ?></label></div></li>
                                                        <?php   } ?>
                                                        <li class="mb-2">Number Of Rooms: <?=$this->input->get($category_arr[0].'_room_cnt')[$key]; $total = $total * $this->input->get($category_arr[0].'_room_cnt')[$key]; ?></li>
                                                        <hr style="margin-top:0;margin-bottom:8px;">
                                                        
                                                        <?php $sub_total = $sub_total + $total;  
                                                      $tt++;  }  
                                                        //echo '<pre>';print_r($temp_category);
                                                        // $temp_arr_1 = $temp_arr_1+['hotel_room_details'=>json_encode([$c=>$temp_category])]; 
                                                        ?>
                                                        <li><span style="font-weight: 600;border-top: 1px solid #a19e9e;border-bottom: 1px solid #a19e9e;">Total : <input type="text" value="<?=$sub_total?>" class="hotel-sub-total" style="max-width:90px !important;" readonly></li>

                                                    </ul>
                                                </div>
                                            </div>
                                                <?php $grand_total = $grand_total + $sub_total; 
                                                // $temp_arr_1['hotel_room_details_all'][$c] = $temp_category;
                                                $temp_category_all[$c] = $temp_category;
                                                
                                        }  ?> 
                                        <div class="row">
                                            <div class="col-md-12 text-right" style="font-weight:600;font-size:15px;">
                                            <span style="float:right;">Total: <input type="text" value="<?=$grand_total?>" class="hotel-grand-total" style="max-width:120px !important;" readonly></span>
                                            </div>
                                        </div>
                                        <?php 
                                        $updown_total=0;
                                            if ($isOutsideDestination) {
                                                $where = 'outsidecity_transportation_costs.location_ids = '.$hotel_name[0]->id.'
                                                        AND outsidecity_transportation_costs.transport_id IN ('.$transport_id.')
                                                        AND outsidecity_transportation_costs.status = "active" 
                                                        AND outsidecity_transportation_costs.hotel_outside_status = 1 ';
                                                $where .= ' AND date(outsidecity_transportation_costs.valid_from) <= "'.$details->check_in_date.'"
                                                        AND date(outsidecity_transportation_costs.valid_to) >= "'.$details->check_out_date.'"';

                                                $join = [
                                                    ['type' => 'LEFT','join_table' => 'transportation','condition' => 'transportation.id = outsidecity_transportation_costs.transport_id']
                                                ];

                                                $outsidecity_transportation = $this->common_model->get_data(
                                                    'outsidecity_transportation_costs','', '', '*',$where, '', $count = false,$join
                                                );

                                                $qntyArr = $this->input->get('vehicle_quantity') ?? [];
                                                $vehicles = $this->input->get('chk_vehicle') ?? [];

                                                if (!empty($outsidecity_transportation)) {
                                                    $outsidetotal = 0;
                                                    foreach ($outsidecity_transportation as $d) {
                                                        $key_index = array_search($d->transport_id, $vehicles);
                                                        if ($key_index !== false) {
                                                            $qty   = (int)($qntyArr[$key_index] ?? 1);
                                                            $total = ($d->price + $d->parking_price) * $qty;
                                                            $outsidetotal += $total;
                                                            $updown_total = $total * 2;
                                                            $outside_hotel_toll= $d->toll_price;
                                                            ?>
                                                            <div class="alert alert-dark mt-2" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                <div class=""><span style="color:#ef2100;font-weight:600;"><i class="fa fa-bus"></i> Travelling Outside Hotel Cost</span></div>
                                                                <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:2px;">
                                                                    <div class="col-md-2">Vehicle Name</div>
                                                                    <div class="col-md-1">Toll</div>
                                                                    <div class="col-md-1">Price</div>
                                                                    <div class="col-md-2">Parking</div>
                                                                    <div class="col-md-1">Qty</div>
                                                                    <div class="col-md-2">One Way</div>
                                                                    <div class="col-md-3">Up & Down</div>
                                                                </div>
                                                                <div class="row transport-row_out_hotel" data-transport-id="<?= $d->transport_id ?>" data-key="<?= $key_index ?>">
                                                                    <div class="col-md-2"><?= $d->vehicle_name ?? '-' ?></div>
                                                                    <div class="col-md-1"><input type="number" class="toll" value="<?= $d->toll_price ?>"></div>
                                                                    <div class="col-md-1"><input type="number" class=" price" value="<?= $d->price ?>"></div>
                                                                    <div class="col-md-2"><input type="number" class="parking" value="<?= $d->parking_price ?>"></div>
                                                                    <div class="col-md-1"><input type="number" class="qty" value="<?= $qty ?>"></div>
                                                                    <div class="col-md-2"><input type="text" class="total" value="<?= $total ?>" readonly></div>
                                                                    <div class="col-md-3"><input type="text" class="updown_total" value="<?= $updown_total ?>" readonly></div>
                                                                </div>

                                                            </div>
                                                            <!-- <input type="hidden" class="total" name="hdn_transportation_outside_<?= $key ?>" value="<?= $outsidetotal ?>"> -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            </div>
                                        <?php  } 
                                       $catKey = str_replace(' ', '_', $category);
                                        $hotelId = $hotel_name[0]->id ?? 0;
                                        $hotelLabel = !empty($hotel_name[0]->name) ? $hotel_name[0]->name : "NA";

                                        // if (!isset($hotel_costing_category_wise[$catKey][$hotelId])) {
                                        //     $hotel_costing_category_wise[$catKey][$hotelId] = 0;
                                        //     $hotel_names_category_wise[$catKey][$hotelId] = $hotelLabel;
                                        // }
                                        // $hotel_costing_category_wise[$catKey][$hotelId] += $sub_total;
                                        if (!isset($hotel_costing_category_wise[$catKey][$hotelId])) {
                                            $hotel_costing_category_wise[$catKey][$hotelId] = 0;

                                            // hotel nights calculation
                                            if ($number_of_nights != 1) {
                                                $hotelNightCount = $hotel_night_count[$hotelId] ?? $nights;
                                                $hotel_names_category_wise[$catKey][$hotelId] = [
                                                'hotel_id'   => $hotelId,
                                                'hotel_name' => $hotelLabel,
                                                'hotel_city' => $hotel_name[0]->city ?? '',
                                                'nights'     => $hotelNightCount
                                            ];
                                            } else {
                                                $hotelNightCount = $nights;
                                                 $hotel_names_category_wise[$catKey][$hotelId] = [
                                                    'hotel_name' => $hotelLabel
                                                 ];
                                            }

                                            // push full details instead of just label
                                            
                                        }

                                        $hotel_costing_category_wise[$catKey][$hotelId] += $grand_total;
                                       
                                     $temp_arr_1['hotel_room_details'] = json_encode($temp_category_all);
                                    array_push($quotation_hotel_details, $temp_arr_1);
                                    } ?> </div> <?php }  
                                    }
                                        //  echo '<pre>';print_r($hotel_names_category_wise);
                                        // echo '<pre>';print_r($hotel_room_category_names_wise);
                                      //  echo '<pre>';print_r($hotel_costing_category_wise);
                                // echo '<pre>';print_r($quotation_hotel_details);exit;    
                                ?>
                                <input type="hidden" name="hotel_costing_category_wise" id="hotel_costing_category_wise" value='<?=json_encode($hotel_costing_category_wise) ?>'>
                                <input type="hidden" name="hotel_names_category_wise" id="hotel_names_category_wise" value='<?=json_encode($hotel_names_category_wise)?>'>
                                <input type="hidden" name="hotel_room_category_names_wise" id="hotel_room_category_names_wise" value='<?=json_encode($hotel_room_category_names_wise) ?>'>
                                
                                <input type="hidden" name="hotel_nights" id="hotel_nights" value='<?=json_encode($hotel_nights)?>'>
                                
                        
                            <?php }
                            
                            else if($this->input->get('hdn_group_type') == 'individual')
                            {
                                $occupancy_arr = ['1(A)'=>'Single','2(A)'=>'Double','3(A)'=>'Triple'];
                                $divide_by = ['1(A)'=>1,'2(A)'=>2,'3(A)'=>3];
                                $hotel_costing = $hotel_names = []; $num = 1;
                                $hotel_nights = [];
                                
                                $number_of_nights = $this->input->get('number_of_nights');
                                // $nights = 1;
                                // if(array_key_exists('chk_all_hotels',$this->input->get())){
                                //     $number_of_nights = 1;
                                //     $nights = $this->input->get('number_of_nights');
                                // }
                                $quotation_hotel_details = [];
                                $temp_arr = [];
                            foreach($this->input->get('hotel_category') AS $category)
                            { 
                                $hotel_costing = [];
                                $hotel_names = [];
                                $temp_arr = ['hotel_category'=>$category];
                                
                                if(array_key_exists('chk_all_hotels', $this->input->get())){
                                    $allHotelsArr = [];
                                    for($i = 1; $i <= $number_of_nights; $i++){
                                        $nightHotels = $this->input->get('hdn_night_'.$i.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                        if(!empty($nightHotels)){
                                            sort($nightHotels);
                                            $allHotelsArr[] = implode('|', $nightHotels);
                                        }
                                    }
                                    $allSameHotels = count(array_unique($allHotelsArr)) === 1;

                                    if($allSameHotels){
                                        $number_of_nights = 1;
                                        $nights = $this->input->get('number_of_nights');
                                        if ($this->input->get('early_checkin') == 'on') {
                                            $nights++;
                                        }
                                    } else {
                                        $number_of_nights = $this->input->get('number_of_nights');
                                        $nights = 1;

                                        $hotelNightWise = [];
                                        $hotel_nights = [];
                                        for($i = 1; $i <= $this->input->get('number_of_nights'); $i++){
                                            $nightHotels = $this->input->get('hdn_night_'.$i.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                            if(!empty($nightHotels)){
                                                foreach($nightHotels as $hId){
                                                    if($hId == '') continue;
                                                    if(!isset($hotelNightWise[$hId])) $hotelNightWise[$hId] = 0;
                                                    $hotelNightWise[$hId]++;
                                                }
                                            }
                                        }
                                        $hotel_nights[$category] = $hotelNightWise;
                                    }
                                }
                                ?>
                                <div class="col-md-12 text-center pt-2">
                                    <h5 class="bold" style="padding: 10px;background-color: #cad6ddff;"><?php echo $category; ?></h5>
                                </div> 
                                <?php
                                // $hotel_night_count = [];
                                
                                // for($n=1; $n <= $number_of_nights; $n++){ 
                                //     $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                //     if (!empty($hdn_hotel_ids)) {
                                //         foreach($hdn_hotel_ids AS $list){
                                //             if($list == '') continue;
                                //             if (!isset($hotel_night_count[$list])) {
                                //                 $hotel_night_count[$list] = 0;
                                //             }
                                //             $hotel_night_count[$list]++; 
                                //         }
                                //     }
                                // }
                                
                                // if ($this->input->get('early_checkin') == 'on') {
                                //     $firstHotelId = array_key_first($hotel_night_count);
                                //     if ($firstHotelId !== null) {
                                //         $hotel_night_count[$firstHotelId] += 1;
                                //     }
                                // }
                                // $hotel_night_count = [];
                                // for($n=1; $n <= $number_of_nights; $n++){ 
                                //     // $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.''.str_replace(' ', '', strtolower($category)).'_ids');
                                //     $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                //     if (!empty($hdn_hotel_ids)) {
                                //         $uniqueHotels = array_unique($hdn_hotel_ids);

                                //         foreach($uniqueHotels AS $list){
                                //             if($list == '') continue;
                                //             if (!isset($hotel_night_count[$list])) {
                                //                 $hotel_night_count[$list] = 0;
                                //             }
                                //             $hotel_night_count[$list]++; 
                                //         }
                                //     }
                                // }
                                $hotel_night_count = [];
                                for ($n = 1; $n <= $number_of_nights; $n++) { 
                                    $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                    if (!empty($hdn_hotel_ids)) {
                                        $uniqueHotels = array_unique($hdn_hotel_ids);

                                        foreach ($uniqueHotels as $list) {
                                            if ($list == '') continue;

                                            // Initialize array if not already
                                            if (!isset($hotel_night_count[$list])) {
                                                $hotel_night_count[$list] = [];
                                            }

                                            // Add night number instead of incrementing count
                                            $hotel_night_count[$list][] = $n;
                                        }
                                    }
                                }
                                
                                $earlyCheckinHotels = [];
                                if ($this->input->get('early_checkin') == 'on') {
                                    $day1_hotels = $this->input->get('hdn_night_1_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                    if (!empty($day1_hotels)) {
                                        foreach ($day1_hotels as $day1_hotel_id) {
                                            if ($day1_hotel_id != '') {
                                                $earlyCheckinHotels[] = $day1_hotel_id;
                                                // if (isset($hotel_night_count[$day1_hotel_id])) {
                                                //     $hotel_night_count[$day1_hotel_id] += 1;
                                                // } else {
                                                //     $hotel_night_count[$day1_hotel_id] = 1;
                                                // }
                                                $hotel_night_count[$day1_hotel_id] = $hotel_night_count[$day1_hotel_id] ?? [];
                                                $hotel_night_count[$day1_hotel_id][] = 0; 
                                            }
                                        }
                                    }
                                }

                                $response_arr = [];
                                for($n=1;$n<=$number_of_nights;$n++){ 
                                    $temp_arr['night'] = $n;
                                    //  print_r($temp_arr['night']);
                                //     $night['night'] = $n;
                                //     $temp_arr = $temp_arr + parseInt($night['night']);
                                //  print_r(array_push($temp_arr,$night['night']));

                                ?>
                                <div class="card-body row">              
                                    <?php
                                    $lastDestination = '';
                                    $hdn_hotel_ids = $this->input->get('hdn_night_'.$n.'_'.str_replace(' ', '_', strtolower($category)).'_ids');
                                    foreach($hdn_hotel_ids AS $list){
                                        if($list == ''){ continue; }

                                        $where = 'hotels.id = '.$list;
                                        $hotel_name = $this->common_model->get_data('hotels','', '', 'hotels.name,hotels.id, hotels.city, hotels.destination',$where, '', $count = false);
                                        $temp_category_all = [];
                                        //$nights = $this->input->get('hdn_hotel_nights')[$key];
                                        // $night_text = ' (Nights)';
                                        $hotel_id = $hotel_name[0]->id ?? ''; 
                                        if (in_array($hotel_id, $earlyCheckinHotels)) {
                                            $night_text = '(Nights + Early Checkin)';
                                        } else {
                                            $night_text = '(Nights)';
                                        }
                                        
                                        // $temp_arr_1 = $temp_arr+['hotel_name'=>$hotel_name[0]->name,'hotel_id'=>$hotel_name[0]->id];
                                        if (!empty($hotel_name) && isset($hotel_name[0]->id)) {
                                            $currentDestination = $hotel_name[0]->destination;
                                            $isOutsideDestination = (strtolower($currentDestination) !== strtolower($main_arrival_city));

                                            $temp_arr_1 = $temp_arr + [
                                                'hotel_name' => $hotel_name[0]->name,
                                                'hotel_city' => $hotel_name[0]->city,
                                                'hotel_id'   => $hotel_name[0]->id
                                            ];
                                        } else {
                                            $temp_arr_1 = $temp_arr + [
                                                'hotel_name' => 'NA (Proceed without hotel)',
                                                'hotel_city' => '',
                                                'hotel_id'   => 0
                                            ];
                                        }

                                        // print_r($temp_arr_1);
                                        // if($num==1 && array_key_exists('early_checkin',$this->input->get()) && $this->input->get('early_checkin')=='on'){
                                        //     $nights++;
                                        //     $night_text = ' (Nights + Early Checkin Night)';
                                        // }
                                        // $night_text = ($this->input->get('early_checkin') == 'on') ? ' (Nights + Early Checkin Night)' : ' (Nights)';
                                    ?>
                                            
                                        <?php if(!empty($this->input->get('night_'.$n.'_category_ids_'.$list)) && $this->input->get('hotel')=='yes'){
                                                
                                                $grand_total=0;
                                                $category_cnt = count($this->input->get('night_'.$n.'_category_ids_'.$list)); ?>
                                                
                                                <div class="col-md-6" style="border:1px solid;">
                                                    <div class="col-md-12 text-center bg-info" style="color:#FFF;font-weight:600;padding:2px;">
                                                        <h5 class="bold"><?php echo ($this->input->get('hotel')=='yes')?'Hotel Costing ('.ucfirst($hotel_name[0]->name).')':'<label style="color:#ff0202;">Without Hotel</label>'; ?></h5>
                                                    </div>
                                        <?php   
                                        // $temp_category = [];
                                        foreach($this->input->get('night_'.$n.'_category_ids_'.$list) AS $c){
                                                    $k=0;                                                    
                                                    $category_arr = explode('_', $c);
                                                    //$where = 'hotel_room_categories.hotel_id = '.$c.' AND hotel_room_categories.status = "active" ';
                                                    //$join = [['type' => '', 'join_table' => 'hotels', 'condition' => 'hotel_room_categories.hotel_id=hotels.id'],];
                                                    //$categories = $this->common_model->get_data('hotel_room_categories','', '', 'hotels.name,hotel_room_categories.id',$where, '', $count = false,$join);
                                       
                                       ?>
                                        
                                            <div class="row mb-2">
                                                <div class="col-md-12 bold text-center">&nbsp;</div>
                                                <div class="col-md-4 bold">Category</div>
                                                <div class="col-md-8 bold" style="text-align:right;">Costing</div>
                                            </div>

                                            <div class="row p-2 bg-grey" style="line-height:1.2">             
                                                <div class="col-md-4" style="font-weight:600;"><?php echo $category_arr[1]; ?></div>
                                                <div class="col-md-8" style="text-align:right;">
                                                    <ul style="list-style-type:none;font-size: inherit;line-height: inherit;">
                                                        <?php 
                                                        
                                                        $sub_total = 0;
                                                        $tt=0;
                                                        $temp_category = [];
                                                        foreach($this->input->get('night_'.$n.'_'.$category_arr[0].'_'.$list.'_hotel_prices') AS $key=>$val){
                                                                $total=0; 
                                                                $arr_temp = [];
                                                                $temp_category[] = ['room_type'=>$val,'room_count'=>''];
                                                               
                                                                foreach($val AS $pr){
                                                                    $prices = explode(' ',$pr);  
                                                                   
                                                                // $hotelNightCount = $hotel_night_count[$hotel_name[0]->id] ?? $nights;
                                                                $hotel_nights_array = $hotel_night_count[$hotel_name[0]->id] ?? [1]; 
                                                                $hotelNightCount = count($hotel_nights_array);
                                                                                                                         
                                                        ?>
                                                                <li>
                                                                    <div class="hotel-row"
                                                                        data-category="<?= str_replace(' ', '_', $category) ?>"
                                                                        data-hotel="<?= $hotel_name[0]->name ?>"
                                                                        data-room="<?= $category_arr[1] ?>"
                                                                        <?php if(!$allSameHotels): ?>
                                                                            data-hotel-id="<?= $hotel_name[0]->id ?>"
                                                                            data-hotel-city="<?= $hotel_name[0]->city ?>"
                                                                            data-nights="<?= $hotelNightCount ?>"
                                                                        <?php endif; ?>
                                                                        data-occupancy="<?= $occupancy_arr[$prices[0]] ?> Occupancy">
                                                                        <?php 
                                                                // $hotel_nights = $hotel_night_count[$hotel_name[0]->id] ?? 1;
                                                                $hotel_nights_array = $hotel_night_count[$hotel_name[0]->id] ?? [1]; 
                                                                $hotel_nights = count($hotel_nights_array);
                                                                if (array_key_exists('early_checkin', $this->input->get()) && $this->input->get('early_checkin') == 'on' && isset($hotel_night_count[0]) && $hotel_name[0]->id == 0) {
                                                                    $hotel_nights++;
                                                                }
                                                                $indexKey = $hotel_name[0]->id . '_' . $c . '_' . $tt;
                                                            if($number_of_nights != 1){
                                                                // $baseNights       = $nights;
                                                                // $hotelNightCount  = $hotel_night_count[$hotel_name[0]->id] ?? $baseNights;
                                                                // $night_text = ($hotelNightCount > $baseNights) 
                                                                //     ? ' (Nights + Early Checkin Night)' 
                                                                //   : ' (Nights)';
                                                                if($markup_split =='yes'){
                                                                    $perNight = ceil($prices[1]);
                                                                    $amt = ceil($prices[1]);
                                                                }
                                                                else
                                                                {
                                                                    $perNight = ceil(($prices[1])/$divide_by[$prices[0]]);
                                                                    $amt = ceil(($hotel_nights*$prices[1])/$divide_by[$prices[0]]);
                                                                }
                                                               
                                                                $total = $total + $amt;
                                                                ?>
                                                                <?= $occupancy_arr[$prices[0]] ?> Occupancy
                                                                <input type="text" value="<?= $perNight; ?>" class="per-night" style="max-width:60px;" data-nights="<?= $hotel_nights ?>" data-index="<?= $indexKey ?>"> 
                                                              <?php  if($markup_split =='yes'){ 
                                                                echo "<b>(PRPN)</b>";
                                                              }else{ ?>
                                                                x <?= $hotel_nights.$night_text ?> = 
                                                                <label style="font-weight:600;"><input type="text" value="<?= $amt; ?>" class="night-total" data-index="<?= $indexKey ?>"   style="max-width:80px !important;" readonly>
                                                                (PP)
                                                                <?php  } ?>

                                                            <?php } else {
                                                                $perNight = ceil(($prices[1])/$divide_by[$prices[0]]);
                                                                $amt = ceil(($nights*$prices[1])/$divide_by[$prices[0]]);
                                                                $total = $total + $amt;
                                                                ?>
                                                                <?= $occupancy_arr[$prices[0]] ?> Occupancy
                                                                <input type="text" value="<?= $perNight; ?>" class="per-night" style="max-width:60px;" data-nights="<?= $nights ?>" data-index="<?= $indexKey ?>"> 
                                                                x <?= $nights.$night_text ?> = 
                                                                <label style="font-weight:600;"><input type="text" value="<?= $amt; ?>" class="night-total"  data-index="<?= $indexKey ?>"  style="max-width:80px !important;" readonly>
                                                                (PP)
                                                            <?php } 
                                                                    ?> </label></div></li>
                                                                
                                                        <?php
                                                                    if($number_of_nights !=1)
                                                                    {
                                                                        $hotelNightCount = $hotel_night_count[$hotel_name[0]->id] ?? $nights;
                                                                        if (!isset($response_arr[$hotel_name[0]->name])) {
                                                                            $response_arr[$hotel_name[0]->name] = [
                                                                                'hotel_id'   => $hotel_name[0]->id,
                                                                                'hotel_city' => $hotel_name[0]->city,
                                                                                // 'nights'     => $hotelNightCount
                                                                                 'nights'     => implode(',', $hotel_night_count[$hotel_name[0]->id] ?? [])
                                                                            ];
                                                                        } else {
                                                                            $response_arr[$hotel_name[0]->name]['nights'] = max(
                                                                                $response_arr[$hotel_name[0]->name]['nights'],
                                                                                $hotelNightCount
                                                                            );
                                                                        }
                                                                    }
                                                                $response_arr[$hotel_name[0]->name][$category_arr[1]][] = $occupancy_arr[$prices[0]] .' Occupancy__'.$amt;
                                                               } 
                                                                 $tt++; 
                                                        ?>
                                                        
                                                        <hr style="margin-top:0;margin-bottom:8px;">
                                                        <?php $sub_total = $sub_total + $total;  }  
                                                        // $temp_arr_1 = $temp_arr_1+['hotel_room_details'=>json_encode([$c=>$temp_category])]; 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                                <?php $grand_total = $grand_total + $sub_total;
                                                // $temp_arr_1['hotel_room_details_all'][$c] = $temp_category;
                                                $temp_category_all[$c] = $temp_category;
                                        } ?>
                                         <?php 
                                         $updown_total=0;
                                            if ($isOutsideDestination) {
                                                $where = 'outsidecity_transportation_costs.location_ids = '.$hotel_name[0]->id.'
                                                        AND outsidecity_transportation_costs.transport_id IN ('.$transport_id.')
                                                        AND outsidecity_transportation_costs.status = "active" 
                                                        AND outsidecity_transportation_costs.hotel_outside_status = 1 ';
                                                $where .= ' AND date(outsidecity_transportation_costs.valid_from) <= "'.$details->check_in_date.'"
                                                        AND date(outsidecity_transportation_costs.valid_to) >= "'.$details->check_out_date.'"';

                                                $join = [
                                                    ['type' => 'LEFT','join_table' => 'transportation','condition' => 'transportation.id = outsidecity_transportation_costs.transport_id']
                                                ];

                                                $outsidecity_transportation = $this->common_model->get_data(
                                                    'outsidecity_transportation_costs','', '', '*',$where, '', $count = false,$join
                                                );

                                                $qntyArr = $this->input->get('vehicle_quantity') ?? [];
                                                $vehicles = $this->input->get('chk_vehicle') ?? [];

                                                if (!empty($outsidecity_transportation)) {
                                                    $outsidetotal = 0;
                                                    foreach ($outsidecity_transportation as $d) {
                                                        // find which vehicle this record corresponds to
                                                        $key_index = array_search($d->transport_id, $vehicles);
                                                        if ($key_index !== false) {
                                                            $qty   = (int)($qntyArr[$key_index] ?? 1);
                                                            $total = ($d->price + $d->parking_price) * $qty;
                                                            $outsidetotal += $total;
                                                            $updown_total = $total * 2;
                                                            $outside_hotel_toll= $d->toll_price;
                                                            ?>
                                                            <div class="alert alert-dark mt-2" style="margin-bottom:2px !important;padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">
                                                                <div class=""><span style="color:#ef2100;font-weight:600;"><i class="fa fa-bus"></i> Travelling Outside Hotel Cost</span></div>
                                                                <div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:2px;">
                                                                    <div class="col-md-2">Vehicle Name</div>
                                                                    <div class="col-md-1">Toll</div>
                                                                    <div class="col-md-1">Price</div>
                                                                    <div class="col-md-2">Parking</div>
                                                                    <div class="col-md-1">Qty</div>
                                                                    <div class="col-md-2">One Way</div>
                                                                    <div class="col-md-3">Up & Down</div>
                                                                </div>
                                                                <div class="row transport-row_out_hotel" data-transport-id="<?= $d->transport_id ?>" data-key="<?= $key_index ?>">
                                                                    <div class="col-md-2"><?= $d->vehicle_name ?? '-' ?></div>
                                                                    <div class="col-md-1"><input type="number" class="toll" value="<?= $d->toll_price ?>"></div>
                                                                    <div class="col-md-1"><input type="number" class="price" value="<?= $d->price ?>"></div>
                                                                    <div class="col-md-2"><input type="number" class="parking" value="<?= $d->parking_price ?>"></div>
                                                                    <div class="col-md-1"><input type="number" class="qty" value="<?= $qty ?>"></div>
                                                                    <div class="col-md-2"><input type="number" class="total" value="<?= $total ?>" readonly></div>
                                                                    <div class="col-md-3"><input type="number" class="updown_total" value="<?= $updown_total ?>" readonly></div>
                                                                </div>
                                                            </div>
                                                            <!-- <input type="hidden" class="total" name="hdn_transportation_outside_<?= $key ?>" value="<?= $updown_total ?>"> -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            </div>
                                         <?php  } 
                                        ?>
                                            
                                    <?php 
                                    $temp_arr_1['hotel_room_details'] = json_encode($temp_category_all);
                                    array_push($quotation_hotel_details, $temp_arr_1);
                                    } ?> 
                                </div> 
                                <?php }  
                                        $hotel_costing_category_wise[str_replace(' ', '_', $category)] = $response_arr;                                          
                                    }
                                    // echo '<pre>';print_r($hotel_costing_category_wise);
                                ?>
                                <input type="hidden" name="hotel_costing_category_wise" id="hotel_costing_category_wise" value='<?=json_encode($hotel_costing_category_wise) ?>'>
                                <input type="hidden" name="hotel_nights" id="hotel_nights" value='<?=json_encode($hotel_nights)?>'>
                                
                            <?php } 
                        }
                            $nights = (int) $this->input->get('number_of_nights');
                            $total_days = $nights + 1;

                            // Fill itinerary daywise
                            for ($i = 1; $i <= $total_days; $i++) {
                                $day_key = 'itinerary_sites_id_' . $i;

                                if (!isset($quotation_itinerary[$day_key])) {
                                    // Empty day with empty itinerary
                                    $quotation_itinerary[$day_key] = (object)['itinerary' => []];
                                } else {
                                    // Day exists, ensure itinerary is a flat array of objects
                                    if (is_object($quotation_itinerary[$day_key])) {
                                        if (isset($quotation_itinerary[$day_key]->itinerary)) {
                                            // If nested array exists, flatten it
                                            if (is_array($quotation_itinerary[$day_key]->itinerary)) {
                                                $flattened = [];
                                                foreach ($quotation_itinerary[$day_key]->itinerary as $item) {
                                                    if (is_array($item)) {
                                                        $flattened = array_merge($flattened, $item);
                                                    } else {
                                                        $flattened[] = $item;
                                                    }
                                                }
                                                $quotation_itinerary[$day_key]->itinerary = $flattened;
                                            }
                                        } else {
                                            // If itinerary key missing, create empty array
                                            $quotation_itinerary[$day_key]->itinerary = [];
                                        }
                                    } elseif (is_array($quotation_itinerary[$day_key])) {
                                        // Convert array to object with flat itinerary
                                        $flattened = [];
                                        foreach ($quotation_itinerary[$day_key] as $item) {
                                            if (is_array($item)) {
                                                $flattened = array_merge($flattened, $item);
                                            } else {
                                                $flattened[] = $item;
                                            }
                                        }
                                        $quotation_itinerary[$day_key] = (object)['itinerary' => $flattened];
                                    }
                                }
                            }

                            // Sort by day number to ensure correct order
                            ksort($quotation_itinerary, SORT_NATURAL);
                            // Encode JSON
                            $quotation_save['itinerary_details'] = json_encode($quotation_itinerary, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                            
                            // $quotation_save['itinerary_details'] = json_encode($quotation_itinerary);
                            ?>
                            <!--<form id="frm-quotation">-->
                            <!--     <input type="hidden" name="quotation_arr" value='<?= htmlspecialchars(json_encode($quotation_save), ENT_QUOTES, 'UTF-8'); ?>' />-->
                            <!--    <input type="hidden" name="hotel_arr" value='<?= htmlspecialchars(json_encode($quotation_hotel_details), ENT_QUOTES, 'UTF-8'); ?>' />-->
                            <!--</form>    -->

                            <?php 
                            // $hasOutsideArr = [];
                            // foreach($template_content as $key => $list){
                            //     $dayHasOnlyMiscNoCost = false;
                            //     if (!empty($itinerary_sites_id[$key])) {
                            //         $miscSites = 0;
                            //         $totalSites = count($itinerary_sites_id[$key]);
                            //         foreach($itinerary_sites_id[$key] as $site_id){
                            //             $whereMisc = 'sites.id='.$site_id.' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost"';
                            //             $siteCheck = $this->common_model->get_data('sites','', '', '*',$whereMisc, '', '','');
                            //             if (!empty($siteCheck)) {
                            //                 $miscSites++;
                            //             }
                            //         }
                            //         if ($miscSites == $totalSites) {
                            //             $dayHasOnlyMiscNoCost = true;
                            //         }
                            //     }

                            //     $dayHasOnlyMiscNoCostArr[$key] = $dayHasOnlyMiscNoCost;

                            //     $hasOutside = false;
                            //     if (!empty($itinerary_sites_id[$key])) {
                            //         foreach($itinerary_sites_id[$key] as $site_id){
                            //             $where2 = 'sites.id='.$site_id.' AND (category="miscellaneous" OR category="transfers") AND miscellaneous_cost="withoutcost" ';
                            //             $sites = $this->common_model->get_data('sites','', '', '*',$where2, '', '','');
                            //             if (!empty($sites) && $sites[0]->location_ids > 0) {
                            //                 $hasOutside = true;
                            //                 break;
                            //             }
                            //         }
                            //     }
                            //     $hasOutsideArr[$key] = $hasOutside;
                            // }

                            // if ($this->input->get('guide') == 'yes') {
                            //     $pattern = '/^guide_languages_/i';
                            //     $guide_arr = array_filter($this->input->get(), function($key) use ($pattern) {
                            //         return preg_match($pattern, $key);
                            //     }, ARRAY_FILTER_USE_KEY);

                            //     $guides = [];
                            //     $gIndex = 0;
                            //     foreach ($guide_arr as $gKey => $val) {
                            //         $guides[] = [
                            //             'guide_languages' => implode(',', $this->input->get($gKey)),
                            //             'qnty' => $this->input->get('guide_quantity')[$gIndex],
                            //             'type' => $this->input->get('driver_cum_guide')
                            //         ];
                            //         $gIndex++;
                               // } ?>

                          
                                  <!-- <div class="card-body row">
                                    <div class="col-md-12 text-center">
                                        <h5 class="bold" style="font-weight: 600;font-size:1.3rem;">Guides</h5> -->
                                        <?php   
                                        // $main_arrival_city = strtolower($this->input->get('arrival_city'));
                                        // $arrival_cities = array_map('strtolower', $this->input->get('arrival_cities') ?? []);

                                        // $all_days_total = 0; 

                                        // foreach($template_content as $key => $list){
                                        //     $day_city = strtolower($arrival_cities[$key] ?? '');
                                        //     $isDifferentCity = ($day_city !== $main_arrival_city);
                                        //     $isFirstOrLast = ($key == 0 || $key == (count($template_content) - 1));
                                        //     $airportPickDrop = ($this->input->get('airport_pick_drop') == 'yes');

                                        //     $hasDriverCumGuide = false;
                                        //     foreach ($guides as $g) {
                                        //         if ($g['type'] == 'driver_guide') {
                                        //             $hasDriverCumGuide = true;
                                        //             break;
                                        //         }
                                        //     }
                                        //     if (empty($itinerary_sites_id[$key]) && !($isFirstOrLast && $airportPickDrop) && !($isDifferentCity)) {
                                                ?>
                                                <!-- <div class="row mt-2 p-1" style="font-weight:600;color:#FFF;background-color:#207da6;">
                                                    <div class="col-md-2">Day <?= ($key+1) ?> - <?= date("d M Y", strtotime($list->date)) ?></div>
                                                    <div class="col-md-10 text-left">No Charge (No Itinerary)</div>
                                                </div> -->
                                                <?php
                                            //     continue;
                                            // }
                                            // if (!empty($guides)) { 
                                              //  $day_total = 0; ?>
                                                
                                                <!-- <div class="row  mt-2 p-1" style="font-weight:600;margin-bottom:6px;color:#FFF;background-color:#207da6;">
                                                    <div class="col-md-2">Day <?= ($key+1) ?> - <?= date("d M Y", strtotime($list->date)) ?></div>
                                                    <div class="col-md-2">Guide</div>
                                                    <div class="col-md-1">Languages</div> -->
                                                    <?php //if ($isDifferentCity) { ?>
                                                        <!-- <div class="col-md-1">Food</div>
                                                        <div class="col-md-1">Accommodation</div>
                                                        <div class="col-md-2">Day charge</div> -->
                                                    <?php //} elseif (!empty($hasOutsideArr[$key]) && $hasOutsideArr[$key]) { ?>
                                                        <!-- <div class="col-md-4">Outside Cost</div> -->
                                                    <?php //} else { ?>
                                                        <!-- <div class="col-md-4">Per Day Cost</div> -->
                                                    <?php //} ?>
                                                    <!-- <div class="col-md-1">Number</div>
                                                    <div class="col-md-2">Total</div>
                                                </div> -->

                                                <?php 
                                                // foreach ($guides as $g) {
                                                //     $where = 'LOWER(auxiliary_guide.location) = "'.strtolower($country).'" 
                                                //             AND auxiliary_guide.languages = "'.strtolower($g['guide_languages']).'" 
                                                //             AND auxiliary_guide.status = "active" ';

                                                //     if (!empty($g['type'])) {
                                                //         $arr_map = ['guide'=>'guide','driver_guide'=>'driver_cum_guide'];
                                                //         $where .= ' AND auxiliary_guide.guide_type = "'.$arr_map[$g['type']].'"';
                                                //     }

                                                //     $guide_prices = $this->common_model->get_data('auxiliary_guide', '', '', '*', $where, '', false);
                                                //     if (!empty($guide_prices)) {
                                                        ?>
                                                        <!-- <div class="row p-2 bg-grey" style="line-height:0.7">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-2" style="font-weight:500"><?= ucwords(str_replace('_', ' ', $arr_map[$g['type']])); ?></div>
                                                            <div class="col-md-1" style="font-weight:500"><?= strtoupper($g['guide_languages']); ?></div> -->
                                                        <?php   

                                                        // if (!empty($dayHasOnlyMiscNoCostArr[$key]) && $dayHasOnlyMiscNoCostArr[$key]) {
                                                        //     $cost = 0;
                                                        //     echo '<div class="col-md-4">No Charge</div>';
                                                        // }
                                                        // elseif ($isDifferentCity) {
                                                        //         $cost = $guide_prices[0]->food_charge + $guide_prices[0]->accommodation_charge + $guide_prices[0]->day_charge;
                                                        //         echo '<div class="col-md-1"><input type="text" value="'.$guide_prices[0]->food_charge.'" class="guide-price" data-day="'.$key.'" data-index="'.$gIndex.'"></div>';
                                                        //         echo '<div class="col-md-1"><input type="text" value="'.$guide_prices[0]->accommodation_charge.'" class="guide-price" data-day="'.$key.'" data-index="'.$gIndex.'"></div>';
                                                        //         echo '<div class="col-md-2"><input type="text" value="'.$guide_prices[0]->day_charge.'" class="guide-price" data-day="'.$key.'" data-index="'.$gIndex.'"></div>';
                                                        // }
                                                        // elseif ($isFirstOrLast) 
                                                        // {
                                                        //     if (empty($itinerary_sites_id[$key])) {
                                                        //         $cost = 0; 
                                                        //         echo '<div class="col-md-4">No Charge</div>';
                                                        //     } elseif(!empty($itinerary_sites_id[$key])) {
                                                        //         $cost = $guide_prices[0]->day_charge; 
                                                        //         echo '<div class="col-md-4"><input type="text" value="'.$guide_prices[0]->day_charge.'" class="guide-price" data-day="'.$key.'" data-index="'.$gIndex.'"></div>';
                                                        //     }
                                                        // } 
                                                        // elseif (!empty($hasOutsideArr[$key]) && $hasOutsideArr[$key]) {
                                                        //     $cost = $guide_prices[0]->outday_charge;
                                                        //     echo '<div class="col-md-4"><input type="text" value="'.$guide_prices[0]->outday_charge.'" class="guide-price" data-day="'.$key.'" data-index="'.$gIndex.'"> </div>';
                                                        // } 
                                                        // else {
                                                        //     $cost = $guide_prices[0]->day_charge;
                                                        //     echo '<div class="col-md-4"><input type="text" value="'.$guide_prices[0]->day_charge.'" class="guide-price" data-day="'.$key.'" data-index="'.$gIndex.'"></div>';
                                                        // }

                                                        // $total_cost = $cost * $g['qnty'];
                                                        // $day_total += $total_cost; ?>
                                                            <!-- <div class="col-md-1" style="font-weight:500"><input type="text" value="<?= $g['qnty']; ?>" class="guide-qty" data-day="<?= $key ?>" data-index="<?= $gIndex ?>"></div>
                                                            <div class="col-md-2" style="font-weight:500"><input type="text" value="<?= $total_cost; ?>" class="guide-total" data-day="<?= $key ?>" data-index="<?= $gIndex ?>"></div>
                                                        </div> -->
                                                    <?php //} 
                                               // } ?>

                                                <!-- <div class="row p-1" style="font-weight:600;background:#1d819214;">
                                                    <div class="col-md-10 text-right"><span style="float: right;">Day Total :</span></div>
                                                    <div class="col-md-2"><input type="text" value="<?= $day_total; ?>" class="day-total" data-day="<?= $key ?>"></div>
                                                </div> -->
                                            <?php 
                                        //     $all_days_total += $day_total; 
                                        //     } 
                                        // } ?>

                                        <!-- <div class="row p-1 mt-2" style="font-weight:600;background:#6bafba7a;    border-top: solid 1px #000;">
                                            <div class="col-md-10 text-right"><span style="float: right;">All Days Total :</span></div>
                                            <div class="col-md-2"><input type="text" name="" value="<?= $all_days_total; ?>" id="all_days_total" ></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="hdn_guide_grand_total" name="hdn_guide_grand_total" value="<?=$all_days_total?>"/> -->
                            <?php //} ?>

               
                                <!-- <div class="card-body row">
                                    <div class="col-md-12 text-center">
                                        <h5 class="bold">Guides</h5>
                                    <div class="row bg-info mb-2" style="color:#FFF;font-weight:600;">    
                                        <div class="col-md-3" style="font-weight:600;">Guide</div>
                                        <div class="col-md-3" style="font-weight:600;">Languages</div>
                                        <div class="col-md-3" style="font-weight:600;">Cost</div>
                                        <div class="col-md-1" style="font-weight:600;">Number</div>
                                        <div class="col-md-2" style="font-weight:600;">Duration</div>
                                    </div>
                                    </div>
                                     
                                    <div class="col-md-12 text-center"> -->
                                        <?php //echo '<pre>'; print_r($guide_pick_drop); print_r($guide_days);exit;
                                        $guide_grand_total = 0;
                                    if($this->input->get('guide')=='yes'){
                                        $pattern = '/^guide_languages_/i';
                                        $guide_matches = array_filter($this->input->get(), function($key) use ($pattern) {
                                            return preg_match($pattern, $key);
                                        }, ARRAY_FILTER_USE_KEY );
                                        $j = 0;
                                        $guide_working_days = 0;
                                        
                                        foreach($guide_matches AS $key=>$guide_list){
                                            sort($guide_list);
                                            $where = 'LOWER(auxiliary_guide.location) = "'.strtolower($country).'" AND auxiliary_guide.languages = "'.implode(',',$guide_list).'" AND auxiliary_guide.status = "active" ';
                                            if(array_key_exists('driver_cum_guide', $this->input->get()) && $this->input->get('driver_cum_guide') <> ''){
                                                $arr_map = ['guide'=>'guide','driver_guide'=>'driver_cum_guide'];
                                                $where .= ' AND auxiliary_guide.guide_type = "'.$arr_map[$this->input->get('driver_cum_guide')].'"';
                                            }
                                            $guide_prices = $this->common_model->get_data('auxiliary_guide','', '', '*',$where, '', $count = false);
                                            if(!empty($guide_prices)){
                                                if($guide_prices[0]->guide_type == 'guide')
                                                {
                                                    foreach($guide_days AS $d){
                                                        if($d == 1) 
                                                        { 
                                                            $guide_working_days = $guide_working_days + 1; }
                                                        }
                                                }
                                                else if ($guide_prices[0]->guide_type == 'driver_cum_guide')
                                                {
                                                    foreach($guide_days AS $k=>$d){
                                                        if($k == 0 && $d == 0 && !empty($guide_pick_drop)) { 
                                                            $guide_working_days = $guide_working_days + 0.5;
                                                        }else if($k == count($guide_days)-1 && $d == 0 && !empty($guide_pick_drop)){
                                                            $guide_working_days = $guide_working_days + 0.5;
                                                        }else if($d==1){
                                                            $guide_working_days = $guide_working_days + 1;
                                                        }
                                                    }
                                                }
                                                
                                        ?>
                                            <!-- <div class="row p-2 bg-grey" style="line-height:1.2">             
                                                <div class="col-md-3" style="font-weight:600;"><?php echo 'Guide '.($j+1); ?></div>
                                                <div class="col-md-3" style="font-weight:600;"><?php echo strtoupper(implode(' , ',$guide_list)); ?></div>
                                                <div class="col-md-3" style="font-weight:600;"><?php echo (!empty($guide_prices))?$guide_prices[0]->day_charge:''; ?></div>
                                                <div class="col-md-1" style="font-weight:600;"><?php echo $this->input->get('guide_quantity')[$j]; ?></div>
                                                <div class="col-md-2" style="font-weight:600;"><?=$guide_working_days?></div>
                                            </div> -->
                                        <?php  
                                            $guide_grand_total = $guide_grand_total + ($guide_prices[0]->day_charge * $this->input->get('guide_quantity')[$j] * ($guide_working_days));
                                            }else {
                                               // echo 'No Matching Language Guides Found.';
                                            }
                                            $j++;
                                        } ?>
                                        
                                        <!-- <div class="row" style="background-color: #f5f5f5;font-weight:600;border-top:1px solid;">
                                            <div class="offset-9 col-md-3" style="font-weight:600;text-align: right;padding: 0 22px;"><?php echo $guide_grand_total; ?></div>
                                        </div> -->
                                     
                                    <?php } 
                                    else{ //echo 'No Guide';
                                     }?>
                                    <!-- <input type="hidden" id="hdn_guide_grand_total" name="hdn_guide_grand_total" value="<?=$guide_grand_total?>"/>
                                    </div>  
                                </div> -->
                                
                                <form id="frm-quotation">
                                <input type="hidden" name="quotation_arr" value='<?= htmlspecialchars(json_encode($quotation_save), ENT_QUOTES, 'UTF-8'); ?>' />
                                <input type="hidden" name="hotel_arr" value='<?= htmlspecialchars(json_encode($quotation_hotel_details), ENT_QUOTES, 'UTF-8'); ?>' />
                                <input type="hidden" id="hdn_guide_arr" name="guide_arr">
                                <input type="hidden" id="airport_pic_drop" name="airport_pic_drop">
                                <input type="hidden" id="luggage_vehicle_cost" name="luggage_vehicle_cost">
                                <input type="hidden" id="full_day_cost" name="full_day_cost">
                                <input type="hidden" id="overnight_cost" name="overnight_cost">
                                <input type="hidden" id="outside_cost" name="outside_cost">
                                <input type="hidden" id="meal_type_daywise_price" name="meal_type_daywise_price" value='<?= json_encode($all_day_meal_prices); ?>'>
                                <input type='hidden' class='grandTotalMeal' name='meal_cost' value="<?php echo $total_meal_cost; ?>">

                                <div class="card-body row">
                                    <div class="col-md-8">
                                        <h5 class="bold text-center" style="font-weight: 600;font-size:1.3rem;">Mandatory Services</h5>
                                    <div class="row  mb-2 p-1" style="color:#FFF;font-weight:600;background-color:#207da6;">    
                                        <div class="col-md-3" style="font-weight:600;">Name</div>
                                        <div class="col-md-3" style="font-weight:600;">Cost</div>
                                        <div class="col-md-3" style="font-weight:600;">Quantity</div>
                                        <div class="col-md-3" style="font-weight:600;">Total</div>
                                    </div>
                                    <!-- </div>
                                     
                                    <div class="col-md-8 text-center"> -->
                                        <?php
                                        // $mandatory_grand_total = 0;
                                        // $j = 0;
                                        // foreach($this->input->get('hdn_mandatory_services') AS $services_list){ 
                                        //     $arr = explode('_|_',$services_list);
                                        //     $cost = $arr[1];
                                        //     $qnty = $this->input->get('mandatory_services_qnty')[$j];
                                        //     $total = $cost * $qnty;
                                         if (!empty($template_content)) {
                                        $lastIndex = count($template_content) - 1;
                                        $allSiteIds = (array) ($this->input->get('hdn_site_id') ?? []);
                                        $lastDaySiteIds = isset($allSiteIds[$lastIndex]) ? (array) $allSiteIds[$lastIndex] : [];
                                        $filtered = array_values(array_filter($lastDaySiteIds, fn($v) => $v !== '' && is_numeric($v)));
                                        if (!empty($filtered)) {
                                            $site_ids_str = implode(',', $filtered);
                                            $where2 = "sites.id IN ($site_ids_str) AND (category='miscellaneous' OR category='transfers') AND miscellaneous_cost='withoutcost'";
                                            
                                            $matching_sites = $this->common_model->get_data('sites', '', '', '*', $where2, '', '', '');
                                            
                                            $matching_ids = [];
                                            foreach ($matching_sites as $site) {
                                                $matching_ids[] = $site->id;
                                            }
                                            $non_matching_ids = array_diff($filtered, $matching_ids);
                                             count($non_matching_ids);
                                            if(count($non_matching_ids) == 0) {
                                                $total_guest = (int)$this->input->get('number_of_adults') + (int)$this->input->get('number_of_child');
                                                $bottle= $total_guest*2;
                                            }else{
                                                $bottle= 0;
                                            }
                          
                                        }
                                    }

                                        $mandatory_grand_total = 0;
                                        $j = 0;
                                        $mandatory_services = $this->input->get('hdn_mandatory_services');
                                        $total_items = count($mandatory_services);
                                        $index = 0;
                                        foreach($this->input->get('hdn_mandatory_services') AS $services_list){ 

                                            $arr = explode('_|_',$services_list);
                                            $cost = $arr[1];
                                            $qnty = $this->input->get('mandatory_services_qnty')[$index];
                                           
                                            if ($index === $total_items - 1) {
                                                if(empty($saved_itinerary_details))
                                                {
                                                    $qnty = (int)$qnty - (int)$bottle;
                                                }else{
                                                    $qnty = (int)$qnty;
                                                }
                                                if ($qnty < 0) $qnty = 0;
                                            }

                                            $total = $cost * $qnty;
                                            $index++;
                                        ?>
                                            <div class="row p-2 bg-grey mandatory-row" data-index="<?= $j ?>" style="line-height:1.2">             
                                                <div class="col-md-3" style="font-weight:600;"><?= $arr[0]; ?></div>
                                                <div class="col-md-3" style="font-weight:600;">
                                                    <input type="text" name="mandatory_services_cost[]"  value="<?= $cost ?>" class="mandatory-cost" data-index="<?= $j ?>">
                                                </div>
                                                <div class="col-md-3" style="font-weight:600;">
                                                    <input type="text"  name="mandatory_services_qnty[]" value="<?= $qnty ?>" class="mandatory-qty" data-index="<?= $j ?>">
                                                    <input type="hidden" name="mandatory_services_name[]" value="<?= $arr[0] ?>">
                                                </div>
                                                <div class="col-md-3" style="font-weight:600;">
                                                    <input type="text" value="<?= $total ?>" class="mandatory-total" data-index="<?= $j ?>" readonly>
                                                </div>
                                            </div>
                                        <?php 
                                            $mandatory_grand_total += $total;                                            
                                            $j++;
                                        } ?>
                                        <div class="row p-1" style="background:#6bafba7a;font-weight:600;border-top:1px solid;">
                                            <div class="offset-9 col-md-3" style="font-weight:600;">
                                                <input type="text" value="<?= $mandatory_grand_total; ?>" id="mandatory_grand_total" readonly>
                                            </div>
                                        </div>
                                        <!-- <input type="text" id="hdn_mandatory_grand_total" name="hdn_mandatory_grand_total" value="<?= $mandatory_grand_total ?>"/> -->
                                    </div>                                    
            <input type="hidden" value="<?=$all_days_airport_total;?>" id="all_days_airport_total">
            <input type="hidden" value="<?=$all_day_luggage_total;?>" id="all_day_luggage_total">
            <input type="hidden" value="<?=$day_travel_total;?>" id="day_travel_total">
            <input type="hidden" value="<?=$all_days_outside_transport;?>" id="all_days_outside_transport">
            <input type="hidden" value="<?=$all_days_full_day_total;?>" id="all_days_full_day_total">
            <input type="hidden" value="<?=$updown_total;?>" id="updown_total">

            <input type="hidden" value="<?=$overnight_toll_price;?>" id="overnight_toll_price">
            <input type="hidden" value="<?=$outside_toll_price;?>" id="outside_toll_price">
            <input type="hidden" value="<?=$outside_hotel_toll;?>" id="outside_hotel_toll">

                            <?php $final_transport=$all_days_full_day_total+ $updown_total +$day_travel_total+ $all_days_outside_transport + $all_day_luggage_total + $all_days_airport_total;
                            $final_transport_without_toll = $final_transport;
                            $final_toll_price = $overnight_toll_price+$outside_toll_price+$outside_hotel_toll;
                            ?>
           
                            
                        <!-- <div class="alert pt-5" style="margin-bottom:4px !important;padding:6px;font-size:14px;"> -->
                            <div class="col-md-1" ></div>
                            <div class="col-md-3" style="">
                                <h5 class="bold text-center" style="font-weight: 600;font-size:1.3rem;">Transport Bundle</h5>
                            <div class="row p-1" style="color:#FFF;font-weight:600;background-color:#207da6;">
                                <div class="col-md-7 text-right">Type</div>
                                <div class="col-md-5 text-right">Price</div>
                                <!-- <div class="col-md-4 text-right">Changed Price</div> -->
                            </div>
                            <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-7 text-right">Transport Bundle</div>
                                 <input type="hidden" value="<?php echo $saved_total_transport_without_tol;?>" id="saved_total_transport_without_tol">
                                <div class="col-md-5 text-right"><input type="text" name="final_transport_without_toll" value="<?= ($saved_total_transport_without_tol > 0) 
                                        ? $saved_total_transport_without_tol 
                                        : $final_transport_without_toll; ?>"
                           <?= ($saved_total_transport_without_tol > 0) ? '' : 'id="final_transport_without_toll"' ?>>
                            </div>
                            </div>
                            <div class="row" style="font-weight:600;">
                                <div class="col-md-12" class="form-group">
                                    <label for=""><b>Remark</b></label>
                                    <textarea type="text" name="fremark" id="fremark" placeholder="Enter Remark" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-right">
                                <button type="button" id="btn-submit-save"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info">Save</button>
                                <button type="button" id="btn-submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Email</button>
                                <a href="#" id="btn-email-body" target="_blank" 
                                class="p-1 mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info">
                                Email Body
                                </a>
                            </div>
                            <div class="col-lg-12 p-t-20 text-right">
                                <div id="msg_div"></div>
                            </div>
                            </div>
                            <!-- <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-7 text-right">Toll</div>
                                <div class="col-md-5 text-right"> -->
                                    <input type="hidden" value="<?=$final_toll_price;?>" id="final_toll_price" name="final_toll_price" readonly>
                                <!-- </div>
                            </div>
                            <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-7 text-right">Updated </div>
                                <div class="col-md-5 text-right"> -->
                                    <input type="hidden" value="<?=$final_transport;?>" id="final_transport" name="final_transport">
                                <!-- </div>
                            </div> -->
                            <!-- <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-4 text-right">Sitescene</div>
                                <div class="col-md-4 text-right"><span><?=$final_ticket_price;?></span></div>
                                <div class="col-md-4 text-right"> -->
                                    <input type="hidden" value="<?=$final_ticket_price;?>" id="hdn_final_ticket_price" name="hdn_final_ticket_price">
                                <!-- </div>
                            </div>
                            <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-4 text-right">Activities</div>
                                <div class="col-md-4 text-right"><span><?=$all_day_activities_total;?></span></div>
                                <div class="col-md-4 text-right"> -->
                                    <input type="hidden" value="<?=$all_day_activities_total;?>" id="all_day_activities_total" name="all_day_activities_total">
                                <!-- </div>
                            </div>
                            <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-4 text-right">Guide</div>
                                <div class="col-md-4 text-right"><span><?= $all_days_total; ?></span></div>
                                <div class="col-md-4 text-right"> -->
                                    <input type="hidden" value="<?= $all_days_total; ?>" id="hdn_guide_grand_total" name="hdn_guide_grand_total">
                                <!-- </div>
                            </div>
                            <div class="row p-1" style="font-weight:600;">
                                <div class="col-md-4 text-right">Mandatory Services</div>
                                <div class="col-md-4 text-right"><span><?=$mandatory_grand_total;?></span></div>
                                <div class="col-md-4 text-right"> -->
                                    <input type="hidden" id="hdn_mandatory_grand_total" name="hdn_mandatory_grand_total" value="<?= $mandatory_grand_total ?>"/>
                                <!-- </div>
                            </div> -->
                            </div>
                            </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </div>
    </div>
</div>
   
<script>
    $(document).ready(function() {
        $("#itinerary_values").select2({
            placeholder: "Select.."
        });

        $("#itinerary_values").on("change", function() {
            var opts = $(this).val().split("|");
            var html = '';
            const v = ["sitescene", "night-life", "activity", "transfers", "miscellaneous"];
            if (v.indexOf($("#itinerary_type").val()) !== -1) {
                var labels = ['Name', 'Departing Time', 'Entry Ticket','Days Of Operation'];
                var class_name;
                $.each(opts, function(i, val) {
                    class_name = '';
                    if(labels[i] == 'Days Of Operation'){
                        class_name = 'text-capitalize';
                        if(val == ""){ val = 'monday,tuesday,wednesday,thursday,friday,saturday,sunday'; }
                        $("#hdn-operational-days").val(val);
                    }
                    html += '<label class="bold" style="line-height:0 !important;">' + labels[i] +
                        ': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">' +
                        val + '</span><br>';
                    CKEDITOR.instances["title"].setData('<strong>' + opts[0] +
                        '</strong>');
                });
                $("#frm_time").val(opts[2]).parent("div").addClass("is-focused");
            } else if ($("#itinerary_type").val() === "restaurants") {
                var labels = ['Name', 'Cuisine', 'Description'];
                $.each(opts, function(i, val) {
                    html += '<label class="bold">' + labels[i] +
                        ': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">' +
                        val + '</span><br>';
                    CKEDITOR.instances["title"].setData('<strong>' + opts[0] +
                        '</strong>');
                });
            }
            var id = $(this).find(':selected').attr("data-id");
            var type = $(this).find(':selected').attr("data-type");
            /*$.ajax({
                url: "<?php //echo site_url('get-itinerary-master-remarks'); ?>",
                type: "post",
                data: {
                    'id': id,
                    'type': type
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                success: function(data) {
                    if (data.response === "s") {
                        html += '<label class="bold">Remarks:</label><br><ol>';
                        $.each(data.details, function(i, val) {
                            html +=
                                '<li class="add-remarks" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to remarks">' +
                                val["remarks"] + '</li>';
                        });
                        html += '</ol>';
                    } else if (data.response === "e") {

                    }
                },
                complete: function() {
                    $("#chk_suggestions").fadeIn().html(html);
                }
            });*/
            $("#chk_suggestions").fadeIn().html(html);
        });

        $("#itinerary_type").on("change", function() {
            var d = $(this).val();
            $("#chk_suggestions").html("").fadeOut();
            $.ajax({
                url: "<?php echo site_url('get-itinerary-suggesstions'); ?>",
                type: "post",
                data: {
                    "type": d,
                    "location": "<?php echo $details->enquiry_abbr; ?>"
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                success: function(data) {
                    $("#msg").html("").html(data.msg);
                    $("#itinerary_values").empty().append(
                        '<option value=""></option>');
                    if (data.response === "s") {
                        const v = ["sitescene", "night-life", "activity",
                            "transfers", "miscellaneous"
                        ];
                        if (v.indexOf($("#itinerary_type").val()) !== -1) {
                            $.each(data.details, function(i, val) {
                                $("#itinerary_values").append(
                                    '<option data-type="sites" data-id="' + val.id + '" value="' + val.site_name + '|' + val
                                    .departing_time_from_hotel +
                                    '|' + val.entry_ticket + '|' +val.days_of_operation + '">' +
                                    val.site_name + '</option>');
                            });
                        } else if ($("#itinerary_type").val() ===
                            "restaurants") {
                            $.each(data.details, function(i, val) {
                                $("#itinerary_values").append(
                                    '<option data-type="restaurants" data-id="' +
                                    val.id + '" value="' + val
                                    .name + '|' + val.cuisine +
                                    '|' + val.description + '">' +
                                    val.name + '</option>');
                            });
                        }
                    } else if (data.response === "e") {

                    }
                }
            });
        });

        $("#frm1").on('click', '.suggesstions', function() {
            CKEDITOR.instances["description"].insertHtml($(this).html());
        });

        $("#frm1").on('click', '.add-remarks', function() {
            CKEDITOR.instances["itinerary_remarks"].insertHtml($(this).html());
        });

        function stripHtmlTags(input) {
            var div = document.createElement('div');
            div.innerHTML = input;
            return div.textContent || div.innerText || "";
        }

        // Remove special characters and extra spaces
        function cleanText(input) {
            var decodedText = decodeURIComponent(input);

            // Strip HTML tags, but keep special characters
            var plainText = decodedText.replace(/<\/?[^>]+(>|$)/g, "").trim();

            return plainText;
        }

        $("#btn-add").on("click", function() {
            //var txt = CKEDITOR.instances["description"].getData();
            var title = CKEDITOR.instances["title"].getData();
            var remarks = CKEDITOR.instances["itinerary_remarks"].getData();
            var sites_id = $("#itinerary_values").find(':selected').attr("data-id");
            if(!sites_id){
                $("#msg-show").html('<div class="alert alert-danger">Itinerary Title Not Selected!</div>');                                
                return false;
            }
            if ($("#frm_date").val() === "" || $("#frm_time").val() ===
                "" /*|| txt === ""*/ ) {
                $("#msg-show").html(
                    '<div class="alert alert-danger">Date, Time Are Mandatory!</div>');
                //$("html, body").animate({ scrollTop: 0 }, 3000);
                return false;
            } 
            const frm_date = new Date($("#frm_date").val());
            const day_Name = new Date(frm_date).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
            var operational_days = ($("#hdn-operational-days").val()!="")?$("#hdn-operational-days").val().split(","):['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            if($.inArray(day_Name, operational_days) === -1){
                alert("Not operational on "+day_Name);
                return false;
            }
            
            const formattedDate = frm_date.toLocaleString("en-GB", {
                day: "numeric",
                month: "short",
                year: "numeric"
            });
            var num_class = $('li.itinerary_li').length;

            //txt = txt.replace(/(<p>|<\/p>)/g, "");
            title = title.replace(/(<p>|<\/p>)/g, "");
            remarks = remarks.replace(/(<p>|<\/p>)/g, "");
            if (num_class === 0) {
                html =
                    '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">' +
                    formattedDate + '</span><br>';
                html += '<input type="hidden" value="' + $("#frm_date").val() +
                    '" name="itinerary_date[]"></li>';
                $(".timeline").append(html);
            } else if ($("input[name='itinerary_date[]']").eq(num_class - 1).val() !== $(
                    "#frm_date").val()) {
                html =
                    '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">' +
                    formattedDate + '</span><br>';
                html += '<input type="hidden" value="' + $("#frm_date").val() +
                    '" name="itinerary_date[]"></li>';
                $(".timeline").append(html);
            }
            var idx = $('#frm-timeline li.itinerary_li').last().index() - 1;
            html_li = '<div style="margin:7px 0 0;">';
            html_li +=
                '<i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>';
            html_li += '<label class="lbl-bold">' + $("#frm_time").val() +
                'Hrs</label> <span style="display:inline-flex; width:59%; flex-flow: wrap ;border-right:1px solid #f3f0ed;padding:3px;">' +
                title + '</span>';
            html_li +=
                '<span style="display:inline-flex; width:25%padding:6px;">' +
                remarks + '</span>';
            html_li += '<input type="hidden" name="itinerary_title_' + idx + '[]" value="' +
                encodeURI(title) + '" >';
            html_li += '<input type="hidden" name="itinerary_title_search_' + idx + '[]" value="' +
                cleanText(title) + '" >';
            html_li += '<input type="hidden" name="itinerary_sites_id_' + idx + '[]" value="' +
                sites_id + '" >';
            html_li += '<input type="hidden" name="itinerary_text_' + idx + '[]" value="' +
                encodeURI(txt) + '" >';
            html_li += '<input type="hidden" name="itinerary_remarks_' + idx +
                '[]" value="' + encodeURI(remarks) + '">';
            html_li += '<input type="hidden" name="itinerary_time_' + idx + '[]" value="' +
                $("#frm_time").val() + '"></div>';

            $('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
            CKEDITOR.instances["description"].setData('');
            CKEDITOR.instances["title"].setData('');
            $("#itinerary_remarks").val('');
            //$("html, body").animate({ scrollTop: 0 }, 3000);
            $("#frm_time").val('');
            $("#msg-show").html(
                '<div class="alert alert-success">Added Successfully</div>');
        });
        
        $("#btn-email-body").on("click", function(event) {
            event.preventDefault(); // Prevent default anchor behavior

            let myForm = document.getElementById("frm-timeline");
            var data = new FormData(myForm);

            // Add CKEditor and other fields like in your button handler
            data.set('inclusions', CKEDITOR.instances["inclusions"].getData());
            data.set('exclusions', CKEDITOR.instances["exclusions"].getData());
            data.set('important_notes', CKEDITOR.instances["important_notes"].getData());
            data.set('cancellation_policy', CKEDITOR.instances["cancellation_policy"].getData());
            data.set('origin_city', $("#origin_city").val());
            data.set('arrival_city', $("#arrival_city").val());
            data.set('arrival_airline', $("#arrival_airline").val());
            data.set('arrival_time', $("#arrival_time").val());
            data.set('departure_city', $("#departure_city").val());
            data.set('departing_airline', $("#departing_airline").val());
            data.set('departing_time', $("#departing_time").val());
            data.set('airport_pick_drop', $("#airport_pick_drop").val());
            data.set('mandatory_services', $("#mandatory_services").val());
            data.set('driver_cum_guide', $("#driver_cum_guide").val());
             data.set('vehicless', $("#vehicless").val());
            data.set('roe', $("#roe").val());
            data.set('agent_name', $("#agent_name").val());
            data.set('fremark', $("#fremark").val());
            data.set('final_toll_price', $("#final_toll_price").val());
            
            if($("#hotel_total").length > 0){
                data.set('hotel_total',$("#hotel_total").val());
            }else{ data.set('hotel_total','0'); }

            if($("#hotel_total_1").length > 0){
                data.set('hotel_total_1',$("#hotel_total_1").val());
            }else{ data.set('hotel_total_1','0'); }

            if($("#hotel_total_2").length > 0){
                data.set('hotel_total_2',$("#hotel_total_2").val());
            }else{ data.set('hotel_total_2','0'); }

            if($("#hotel_names_1").length > 0){
                data.set('hotel_names_1',$("#hotel_names_1").val());
            }else{ data.set('hotel_names_1',''); }

            if($("#hotel_names_2").length > 0){
                data.set('hotel_names_2',$("#hotel_names_2").val());
            }else{ data.set('hotel_names_2',''); }							
            
            if($("#hdn_guide_grand_total").length > 0){
                data.set('hdn_guide_grand_total',$("#hdn_guide_grand_total").val());
            }else{ data.set('hdn_guide_grand_total',''); }                         
            
            if($("#hotel_nights").length > 0){
                data.set('hotel_nights',$("#hotel_nights").val());
            }else{ data.set('hotel_nights',''); }                            
            
            if($("#hdn_mandatory_grand_total").length > 0){
                data.set('hdn_mandatory_grand_total',$("#hdn_mandatory_grand_total").val());
            }else{ data.set('hdn_mandatory_grand_total',''); }
            
            if($("#final_transport").length > 0){
                data.set('final_transport',$("#final_transport").val());
            }else{ data.set('final_transport',''); }

            if($("#hdn_final_ticket_price").length > 0){
                data.set('hdn_final_ticket_price',$("#hdn_final_ticket_price").val());
            }else{ data.set('hdn_final_ticket_price',''); }

            if($("#all_day_activities_total").length > 0){
                data.set('all_day_activities_total',$("#all_day_activities_total").val());
            }else{ data.set('all_day_activities_total',''); }

            if($(".grandTotalMeal").length > 0){
                data.set('grandTotalMeal',$(".grandTotalMeal").val());
            }else{ data.set('grandTotalMeal',''); }

            if($("#meal_type_daywise_price").length > 0){
                data.set('meal_type_daywise_price',$("#meal_type_daywise_price").val());
            }else{ data.set('meal_type_daywise_price',''); }
            
            if($("#hotel_costing_category_wise").length > 0){
                data.set('hotel_costing_category_wise',$("#hotel_costing_category_wise").val());
            }else{ data.set('hotel_costing_category_wise',''); }
            
            if($("#hotel_names_category_wise").length > 0){
                data.set('hotel_names_category_wise',$("#hotel_names_category_wise").val());
            }else{ data.set('hotel_names_category_wise',''); }

            if($("#hotel_room_category_names_wise").length > 0){
                data.set('hotel_room_category_names_wise',$("#hotel_room_category_names_wise").val());
            }else{ data.set('hotel_room_category_names_wise',''); }

            // Create a temporary form to submit normally (for page redirect)
            var tempForm = document.createElement("form");
            tempForm.action = "<?php echo site_url('admin/quotation/get_email_body'); ?>";
            tempForm.method = "POST";
            tempForm.target = "_blank";

            // Append all FormData to this form
            data.forEach((value, key) => {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = key;
                input.value = value;
                tempForm.appendChild(input);
            });

            document.body.appendChild(tempForm);
            tempForm.submit();
        });

        $("#frm-timeline").on("click", '.edit-remove', function(e) {
            if (!confirm('Are You Sure?')) {
                return false;
            }
            e.preventDefault();
            $(this).parent().remove();
        });

        $("#btn-submit").on("click", function() {
            event.preventDefault();
            let myForm = document.getElementById("frm-timeline");
            var data = new FormData(myForm);
            data.set('inclusions',CKEDITOR.instances["inclusions"].getData());
            data.set('exclusions',CKEDITOR.instances["exclusions"].getData());
            data.set('important_notes',CKEDITOR.instances["important_notes"].getData());
            data.set('cancellation_policy',CKEDITOR.instances["cancellation_policy"].getData());
            data.set('origin_city',$("#origin_city").val());
            data.set('arrival_city',$("#arrival_city").val());
            data.set('arrival_airline',$("#arrival_airline").val());
            data.set('arrival_time',$("#arrival_time").val());
            data.set('departure_city',$("#departure_city").val());
            data.set('departing_airline',$("#departing_airline").val());
            data.set('departing_time',$("#departing_time").val());
            data.set('airport_pick_drop',$("#airport_pick_drop").val());
            data.set('mandatory_services',$("#mandatory_services").val());
            data.set('driver_cum_guide', $("#driver_cum_guide").val());
            data.set('vehicless', $("#vehicless").val());
            data.set('roe', $("#roe").val());
            data.set('agent_name', $("#agent_name").val());
            data.set('fremark', $("#fremark").val());
            data.set('final_toll_price', $("#final_toll_price").val());
            
            if($("#hotel_total").length > 0){
                data.set('hotel_total',$("#hotel_total").val());
            }else{ data.set('hotel_total','0'); }

            if($("#hotel_total_1").length > 0){
                data.set('hotel_total_1',$("#hotel_total_1").val());
            }else{ data.set('hotel_total_1','0'); }

            if($("#hotel_total_2").length > 0){
                data.set('hotel_total_2',$("#hotel_total_2").val());
            }else{ data.set('hotel_total_2','0'); }

            if($("#hotel_names_1").length > 0){
                data.set('hotel_names_1',$("#hotel_names_1").val());
            }else{ data.set('hotel_names_1',''); }

            if($("#hotel_names_2").length > 0){
                data.set('hotel_names_2',$("#hotel_names_2").val());
            }else{ data.set('hotel_names_2',''); }							
            
            /*if($("#hdn_restaurants_grand_total").length > 0){
                    data.set('hdn_restaurants_grand_total',$("#hdn_restaurants_grand_total").val());
            }else{ data.set('hdn_restaurants_grand_total',''); }*/
            
            if($("#hdn_guide_grand_total").length > 0){
                data.set('hdn_guide_grand_total',$("#hdn_guide_grand_total").val());
            }else{ data.set('hdn_guide_grand_total',''); }                         
            
            if($("#hotel_nights").length > 0){
                data.set('hotel_nights',$("#hotel_nights").val());
            }else{ data.set('hotel_nights',''); }                            
            
            if($("#hdn_mandatory_grand_total").length > 0){
                data.set('hdn_mandatory_grand_total',$("#hdn_mandatory_grand_total").val());
            }else{ data.set('hdn_mandatory_grand_total',''); }
            
            if($("#final_transport").length > 0){
                data.set('final_transport',$("#final_transport").val());
            }else{ data.set('final_transport',''); }

            if($("#hdn_final_ticket_price").length > 0){
                data.set('hdn_final_ticket_price',$("#hdn_final_ticket_price").val());
            }else{ data.set('hdn_final_ticket_price',''); }

            if($("#all_day_activities_total").length > 0){
                data.set('all_day_activities_total',$("#all_day_activities_total").val());
            }else{ data.set('all_day_activities_total',''); }

            if($(".grandTotalMeal").length > 0){
                data.set('grandTotalMeal',$(".grandTotalMeal").val());
            }else{ data.set('grandTotalMeal',''); }

             if($("#meal_type_daywise_price").length > 0){
                data.set('meal_type_daywise_price',$("#meal_type_daywise_price").val());
            }else{ data.set('meal_type_daywise_price',''); }
            
            if($("#hotel_costing_category_wise").length > 0){
                data.set('hotel_costing_category_wise',$("#hotel_costing_category_wise").val());
            }else{ data.set('hotel_costing_category_wise',''); }
            
            if($("#hotel_names_category_wise").length > 0){
                data.set('hotel_names_category_wise',$("#hotel_names_category_wise").val());
            }else{ data.set('hotel_names_category_wise',''); }

            if($("#hotel_room_category_names_wise").length > 0){
                data.set('hotel_room_category_names_wise',$("#hotel_room_category_names_wise").val());
            }else{ data.set('hotel_room_category_names_wise',''); }
            
            $("#btn-submit").html("Sending..").attr("disabled", "disabled");
            $.ajax({
                url: "<?php echo site_url('admin/quotation/save_and_email_new'); ?>",
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#msg_div").html("").html(data.msg);
                    if (data.response === "s") {
                        //window.location.href = "<?php //echo base_url('all-itinerary'); ?>";										
                    } else if (data.response === "e") {
                        
                    }
            $("#btn-submit").html("Save and Email").removeAttr("disabled");
                }
            });
        });
        
        $("#btn-submit-save").on("click", function() {
            event.preventDefault();
            let myForm = document.getElementById("frm-quotation");
            var data = new FormData(myForm);
            $("#btn-submit-save").html("Saving..").attr("disabled", "disabled");
            $.ajax({
                url: "<?php echo site_url('admin/quotation/save_quotation'); ?>",
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#msg_div").html("").html(data.msg);
                    if (data.response === "s") {
                        $("#btn-submit-save").html("<i class='fa fa-check'></i> Saved");
                    } else if (data.response === "e") {
                        $("#btn-submit-save").html("Save").removeAttr("disabled");
                    }

                }
            });
        });
        
        $("#itinerary_template").on("change", function() {
            var id = $(this).val();
            window.location.href =
                "<?php echo base_url('create-itinerary?id=' . $this->input->get('id') . '&temp_id='); ?>" +
                btoa(id);
        });

        //$(".edit").on("click",function(){
        $("#frm-timeline").on("click", '.edit', function(e) {
            $("#btn-edit").show();
            $("#btn-add").hide();
            $("#btn-add-update").hide();
            var id = $(this).attr("id");
            var idx = $(this).index('.edit');
            $("#frm_time").val($(".lbl-edit").eq(idx).html()).parent("div").addClass(
                "is-focused");
            CKEDITOR.instances["title"].setData($(".txt-edit").eq(idx).html());
            $("#itinerary_remarks").val($(".rm-edit").eq(idx).html()).parent("div")
                .addClass("is-focused");
            $("#btn-add").hide();
            $("#btn-edit").show().attr("u_id", btoa(id)).attr("val-idx", idx);
            $('.rdo').prop('checked', false);
            $("#msg, #msg-show").html('');
        });

        $("#btn-edit").on("click", function() {
            const frm_date = new Date($("#frm_date").val());
            const day_Name = new Date(frm_date).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
            var operational_days = ($("#hdn-operational-days").val()!="")?$("#hdn-operational-days").val().split(","):['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            if($.inArray(day_Name, operational_days) === -1){
                alert("Not operational on "+day_Name);
                return false;
            }
            var idx = $(this).attr("val-idx");
            var txt = CKEDITOR.instances["description"].getData();
            var title = CKEDITOR.instances["title"].getData();
            txt = txt.replace(/(<p>|<\/p>)/g, "");
            title = txt.replace(/(<p>|<\/p>)/g, "");
            $(".lbl-edit").eq(idx).html($("#frm_time").val());
            $(".txt-edit").eq(idx).html(txt);
            $(".rm-edit").eq(idx).html($("#itinerary_remarks").val());
            $("input[name='itinerary_title_" + idx + "[]']").val(encodeURI(title));
            $("input[name='itinerary_title_search_" + idx + "[]']").val(cleanText(title));
            $("input[name='itinerary_text_" + idx + "[]']").val(encodeURI(txt));
            $("input[name='itinerary_remarks_" + idx + "[]']").val($("#itinerary_remarks")
                .val());
            $("input[name='itinerary_time_" + idx + "[]']").val($("#frm_time").val());
            CKEDITOR.instances["description"].setData('');
            $("#itinerary_remarks").val('');
            //$("html, body").animate({ scrollTop: 0 }, 3000);
            $("#frm_time").val('');
            $("#msg-show").html(
                '<div class="alert alert-success">Added Successfully</div>');
        });

        $(".rdo").on("click", function() {
            $("#btn-edit").hide();
            $("#btn-add").hide();
            $("#btn-add-update").hide();
            $("#msg, #msg-show").html('');
            if (parseInt($(".rdo").length) === (parseInt($(this).index(".rdo")) + 1)) {
                $("#btn-add").show();
            } else {
                $("#frm_date").val($("input[name='itinerary_date[]']").eq($(this).index(
                    ".rdo")).val()).parent().addClass("is-focused");
                $("#btn-add-update").show();
                $(".dt-date").trigger("change");
            }
        });
        
            var transport_prices='';
        $("#btn-add-update").on("click", function() {
            var idx = $("input:radio.rdo:checked").index(".rdo"); 
            var title = CKEDITOR.instances["title"].getData();
            var sites_id = $("#itinerary_values").find(':selected').attr("data-id");
            if(!sites_id){
                $("#msg-show").html('<div class="alert alert-danger">Itinerary Title Not Selected!</div>');                                
                return false;
            }
            if ($("#frm_time").val() === "" /*|| txt === ""*/ ) {
                $("#msg-show").html(
                    '<div class="alert alert-danger">Date, Time Are Mandatory!</div>');
                return false;
            }
            const day_Name = new Date($("#frm_date").val()).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
            var operational_days = ($("#hdn-operational-days").val()!="")?$("#hdn-operational-days").val().split(","):['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            if($.inArray(day_Name, operational_days) === -1){
                alert("Not operational on "+day_Name);
                return false;
            }
                var transport_prices = '';
                $.ajax({
                url: "<?php echo site_url('admin/quotation/transport_prices'); ?>",
                type: "post",
                    data: {"site_id":sites_id,"transports_id":"<?php echo ($this->input->get('chk_vehicle')<>'')?implode(',',$this->input->get('chk_vehicle')):''; ?>",
                        "checkin_date":"<?=$details->check_in_date ?>","checkout_date":"<?=$details->check_out_date ?>"},
                                    dataType: 'JSON',
                    async: false,
                success: function(data) {									
                $("#msg-show").html("").html(data.msg);
                var q = "<?=implode(",",($this->input->get('vehicle_quantity[]')<>'')?$this->input->get('vehicle_quantity[]'):[]); ?>";
                var qnty = q.split(",");
                var v = "<?=implode(",",($this->input->get('chk_vehicle[]')<>'')?$this->input->get('chk_vehicle[]'):[]); ?>";
                var vehicles = v.split(",");
                if (data.response === "s") {
                var flag_outside = flag_inside = true;
                var ele_name_outside = 'hdn_transportation_outside_'+idx;
                var ele_name_inside = 'hdn_transportation_inside_'+idx;

                $("#frm-timeline .total").each(function(index, element) {
                    if($(this).attr("name") == ele_name_outside) { 
                        flag_outside = false; 
                        return false;
                    }
                });

                $("#frm-timeline .total").each(function(index, element) {
                    if($(this).attr("name") == ele_name_inside){ 
                        flag_inside = false; 
                        return false;
                    }											
                });										

                if(data.details.transportation.length > 0 && flag_outside){
                    transport_prices = '<div class="alert alert-info" style="padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">';
                    transport_prices += '<div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">';
                    transport_prices += '<div class="col-md-5">Vehicle Name</div><div class="col-md-1">Price</div><div class="col-md-1">Toll</div>';
                    transport_prices += '<div class="col-md-2">Parking</div><div class="col-md-1">Qty.</div><div class="col-md-2">Total</div></div>';
                    var transportation_total = 0;
                    $.each(data.details.transportation, function(i, d) {
                            if(vehicles.indexOf(d.id) != -1){
                                    var total = (parseInt(d.price) + parseInt(d.toll_price) + parseInt(d.parking_price))*parseInt(qnty[vehicles.indexOf(d.id)]);
                                    transport_prices += '<div class="row" style="line-height: 15px;margin-top: 2px;">';
                                    transport_prices += '<div class="col-md-5">'+d.vehicle_name+'</div><div class="col-md-1">'+d.price+'</div><div class="col-md-1">'+d.toll_price+'</div>';
                                    transport_prices += '<div class="col-md-2">'+d.parking_price+'</div><div class="col-md-1">'+qnty[vehicles.indexOf(d.id)]+'</div><div class="col-md-2">'+total+'</div></div>';
                                    transportation_total = parseInt(transportation_total) + parseInt(total);
                            }
                    });
                    transport_prices += '<input type="hidden" class="total" name="hdn_transportation_outside_'+idx+'" value="'+transportation_total+'"></div>';
                    //console.log(transport_prices);
                }
                if(data.details.transportation_cost.length > 0 && flag_inside){
                    transport_prices += '<div class="alert alert-info" style="padding:4px;text-transform:capitalize;font-size:12px;text-align:center;">';
                    transport_prices += '<div class="row" style="line-height: 10px;margin-top: 2px;font-weight:600;margin-bottom:6px;">';
                    transport_prices += '<div class="col-md-5">Vehicle Name</div><div class="col-md-2">Full Day Price</div>';
                    transport_prices += '<div class="col-md-1">Qty.</div><div class="col-md-2">Total</div></div>';
                    var transportation_total = 0;
                    $.each(data.details.transportation_cost, function(i, d) {
                            if(vehicles.indexOf(d.id) != -1){
                                    var total = (parseInt(d.price))*parseInt(qnty[vehicles.indexOf(d.id)]);
                                    transport_prices += '<div class="row" style="line-height: 15px;margin-top: 2px;">';
                                    transport_prices += '<div class="col-md-5">'+d.vehicle_name+'</div><div class="col-md-2">'+d.price+'</div>';
                                    transport_prices += '<div class="col-md-1">'+qnty[vehicles.indexOf(d.id)]+'</div><div class="col-md-2">'+total+'</div></div>';
                                    transportation_total = parseInt(transportation_total) + parseInt(total);
                            }
                    });
                    transport_prices += '<input type="hidden" class="total" name="hdn_transportation_inside_'+idx+'" value="'+transportation_total+'"></div>';
                }
                    } else if (data.response === "e") {
                        
                    }
                }
            });
            //console.log(transport_prices);
            title = title.replace(/(<p>|<\/p>)/g, "");
            
            html_li = '<div style="margin:7px 0 0;">';
            html_li +=
                '<i title="Remove" class="fa fa-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>';
            html_li += '<label class="lbl-bold lbl-time">' + $("#frm_time").val() +
                '</label><strong>Hrs</strong> <span style="width:60%">' + title +  '</span>';
            html_li += transport_prices;
            html_li += '<input type="hidden" name="itinerary_title_' + idx + '[]" value="' +
                encodeURI(title) + '" >';
            html_li += '<input type="hidden" name="itinerary_title_search_' + idx + '[]" value="' +
                cleanText(title) + '" >';
            html_li += '<input type="hidden" name="itinerary_sites_id_' + idx + '[]" value="' +
                sites_id + '" >';
            html_li += '<input type="hidden" name="itinerary_time_' + idx + '[]" value="' +
                $("#frm_time").val() + '">';
            html_li += '</div>';
            var flag = false;
            
            /*$("#frm-timeline .lbl-time").each(function(index, element) {
                if ($(this).parent().parent().index('.itinerary_li') === idx) {
                    var start = $(this).html().split(":");
                    var end = $("#frm_time").val().split(":");

                    var lbl_time = new Date(0, 0, 0, start[0], start[1], 0);
                    var new_time = new Date(0, 0, 0, end[0], end[1], 0);
                    //console.log(lbl_time.getTime()+"_____"+new_time.getTime());
                    //if(Date.now($(this).html()) > Date.now($("#frm_time").val())){ 
                    if (lbl_time > new_time) {
                        var p_idx = $(this).parent().index("p");
                        $('#frm-timeline p').eq(p_idx).before(html_li);
                        flag = true;
                        return false;
                    }
                }
            });*/
            if (flag === false) {
                $('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
            }
            //CKEDITOR.instances["description"].setData('');
            CKEDITOR.instances["title"].setData('');
            //$("#itinerary_remarks").val('');
            //$("html, body").animate({ scrollTop: 0 }, 3000);
            $("#frm_time").val('');
            $("#msg-show").html(
                '<div class="alert alert-success">Added Successfully</div>');
        });

        $("#frm-timeline").on("change", ".dt-dateformat", function() {
            var idx = $(this).index(".dt-dateformat");
            const selectedDate = new Date($(".dt-dateformat").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);

            if ($(".dt-dateformat").eq(idx).val() != "" && formattedDate !=
                "Invalid Date") {
                $(".dt-dateformat-show").eq(idx).val(formattedDate).parent().addClass(
                    'is-focused');
            } else {
                $(".dt-dateformat-show").eq(idx).val('');
            }
        });
        $("#frm1").on("change", ".dt-date", function() {
            var idx = $(this).index(".dt-date");
            const selectedDate = new Date($(".dt-date").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);

            if ($(".dt-date").eq(idx).val() != "" && formattedDate != "Invalid Date") {
                $(".dt-date-show").eq(idx).val(formattedDate).parent().addClass(
                    'is-focused');
            } else {
                $(".dt-date-show").eq(idx).val('');
            }
        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInputs = document.querySelectorAll('.dt-dateformat');
        
        dateInputs.forEach((input, index) => {
            const dateValue = input.value;
            if (dateValue) {
                const dayName = new Date(dateValue).toLocaleDateString('en-US', { weekday: 'long' });
                const dayDisplay = document.getElementById(`day-display-${index}`);
                if (dayDisplay) dayDisplay.textContent = dayName;
            }
        });
    });

    function recalcGuideTotals() 
    {
        let allDaysTotal = 0;
        $(".day-total").each(function () {
            let day = $(this).data("day");
            let dayTotal = 0;
            
            $(".guide-qty[data-day='" + day + "']").each(function () {
                let index = $(this).data("index");
                let qty = parseFloat($(this).val()) || 0;

                let cost = 0;
                $(".guide-price[data-day='" + day + "'][data-index='" + index + "']").each(function () {
                    cost += parseFloat($(this).val()) || 0;
                });

                let total = cost * qty;
                $(".guide-total[data-day='" + day + "'][data-index='" + index + "']").val(total);
                dayTotal += total;
            });

            $(this).val(dayTotal);
            allDaysTotal += dayTotal;
        });

        $("#all_days_total").val(allDaysTotal);
        $("#guide_grand_total").val(allDaysTotal);
        $("#hdn_guide_grand_total").val(allDaysTotal);

        let guide_arr = collectGuideData();
        $("#hdn_guide_arr").val(JSON.stringify(guide_arr));
    }

    $(document).on("input", ".guide-price, .guide-qty", recalcGuideTotals);
    
    function collectGuideData() 
    {
        let guides = [];

        $(".guide-qty").each(function () {
            let day = $(this).data("day");
            let index = $(this).data("index");

            let qty   = parseFloat($(this).val()) || 0;
            let total = parseFloat($(".guide-total[data-day='" + day + "'][data-index='" + index + "']").val()) || 0;

            let costs = [];
            $(".guide-price[data-day='" + day + "'][data-index='" + index + "']").each(function () {
                costs.push(parseFloat($(this).val()) || 0);
            });

            if (costs.length === 0) {
                costs = [0];
            }

            guides.push({
                day: day,
                index: index,
                costs: costs,
                qty: qty,
                total: total
            });
        });

        return guides;
    }

    $(document).on("input", ".guide-price, .guide-qty", recalcGuideTotals);
    // 🔹 also run once on page load (so hidden field is always initialized)
    $(document).ready(function () {
        recalcGuideTotals();
    });

    function recalcMandatoryTotals() 
    {
        let grandTotal = 0;
        $(".mandatory-row").each(function () {
            let index = $(this).data("index");

            let cost = parseFloat($(".mandatory-cost[data-index='"+index+"']").val()) || 0;
            let qty  = parseFloat($(".mandatory-qty[data-index='"+index+"']").val()) || 0;

            let total = cost * qty;
            $(".mandatory-total[data-index='"+index+"']").val(total);

            grandTotal += total;
        });

        $("#mandatory_grand_total").val(grandTotal);
        $("#hdn_mandatory_grand_total").val(grandTotal);
    }

    $(document).on("input", ".mandatory-cost, .mandatory-qty", recalcMandatoryTotals);

    function updateFinalTransport() {
        let airport       = parseFloat($("#all_days_airport_total").val())      || 0;
        let luggage       = parseFloat($("#all_day_luggage_total").val())       || 0;
        let travel        = parseFloat($("#day_travel_total").val())            || 0;
        let outside       = parseFloat($("#all_days_outside_transport").val())  || 0;
        let fullDay       = parseFloat($("#all_days_full_day_total").val())     || 0;
        let updown        = parseFloat($("#updown_total").val())                || 0;

        // let total = airport + luggage + travel + outside + fullDay + updown;
        // $("#final_transport_without_toll").val(total);
        let overnightToll = parseFloat($("#overnight_toll_price").val()) || 0;
        let outsideToll   = parseFloat($("#outside_toll_price").val())   || 0;
        let hotelToll     = parseFloat($("#outside_hotel_toll").val())   || 0;

        let total = airport + luggage + travel + outside + fullDay + updown;
        let saved_total_transport_without_tol     = parseFloat($("#saved_total_transport_without_tol").val())   || 0;
        // Subtract tolls to match PHP logic
        let withoutToll = total + (overnightToll + outsideToll + hotelToll);

        $("#final_transport_without_toll").val(total);
        $("#final_transport").val(withoutToll);

    }
    function updateFinalToll() {
        let overnightToll = parseFloat($("#overnight_toll_price").val()) || 0;
        let outsideToll   = parseFloat($("#outside_toll_price").val())   || 0;
        let hotelToll     = parseFloat($("#outside_hotel_toll").val())   || 0;

        let finalToll = overnightToll + outsideToll + hotelToll;

        $("#final_toll_price").val(finalToll);
    }
    
    function updateAirportData() 
    {
        let allRowsData = [];

        // Loop through all airport sections (pickup + drop)
        $(".airport-section").each(function() {
            $(this).find(".airport-row").each(function() {
                let price = parseFloat($(this).find(".airport-price").val()) || 0;
                let qty   = parseFloat($(this).find(".airport-qty").val()) || 0;
                let total = price * qty;

                $(this).find(".airport-total").val(total);

                allRowsData.push({
                    type: $(this).closest(".airport-section").hasClass("airport-pickup") ? "pickup" : "drop",
                    vehicle_name: $(this).find(".col-md-4").text().trim(),
                    price: price,
                    quantity: qty,
                    total: total
                });
            });
        });

        // Store combined rows in a single input
        $("#airport_pic_drop").val(JSON.stringify(allRowsData));

        // Update each section grand total
        $(".airport-section").each(function() {
            let sectionTotal = 0;
            $(this).find(".airport-row").each(function() {
                sectionTotal += parseFloat($(this).find(".airport-total").val()) || 0;
            });
            $(this).find(".airport-grand").val(sectionTotal);
        });

        // Update overall total for all days
        let allDaysTotal = 0;
        $(".airport-grand").each(function() {
            allDaysTotal += parseFloat($(this).val()) || 0;
        });
        $("#all_days_airport_total").val(allDaysTotal);

        updateFinalTransport();
    }

    // Trigger on input changes
    $(document).on("input", ".airport-section .airport-price, .airport-section .airport-qty", updateAirportData);

    updateAirportData();
    
    
   function updateLuggageData() 
    {
        $(".luggage-section").each(function() {
            let section = $(this);
            let sectionTotal = 0;

            section.find(".luggage-row").each(function () {
                let price = parseFloat($(this).find(".luggage-price").val()) || 0;
                let qty   = parseFloat($(this).find(".luggage-qty").val()) || 0;
                let rowTotal = price * qty;

                $(this).find(".luggage-total").val(rowTotal);
                sectionTotal += rowTotal;
            });

            section.find(".luggage-grand").val(sectionTotal);
        });

        let allDaysLuggageTotal = 0;
        $(".luggage-grand").each(function() {
            allDaysLuggageTotal += parseFloat($(this).val()) || 0;
        });
        $("#all_day_luggage_total").val(allDaysLuggageTotal);

        let luggageRows = [];
        $(".luggage-section .luggage-row").each(function() {
            let vehicleName = $(this).find(".col-md-7").contents().filter(function() {
                return this.nodeType === 3;
            }).text().replace(/\s+/g, ' ').trim();
            let price  = parseFloat($(this).find(".luggage-price").val()) || 0;
            let qty    = parseFloat($(this).find(".luggage-qty").val()) || 0;
            let total  = parseFloat($(this).find(".luggage-total").val()) || 0;

            luggageRows.push({
                vehicle_name: vehicleName,
                price: price,
                quantity: qty,
                total: total
            });
        });
        $("#luggage_vehicle_cost").val(JSON.stringify(luggageRows));
        updateFinalTransport();
    }
    $(document).ready(function() {
        updateLuggageData();
    });
    $(document).on("input", ".luggage-section .luggage-price, .luggage-section .luggage-qty", function () {
        updateLuggageData();
    });

    // Listen for changes in travel rows
    // function updateTravelTotals() {
    //     let allDaysTotal = 0;

    //     $(".outside-section").each(function() {
    //         let sectionTotal = 0;
    //         $(this).find(".travel-row").each(function() {
    //             let price = parseFloat($(this).find(".travel-price").val()) || 0;
    //             let toll  = parseFloat($(this).find(".toll-price").val()) || 0;
    //             let qty   = parseFloat($(this).find(".travel-qty").val()) || 0;
    //             let rowTotal = (price + toll) * qty;
    //             $(this).find(".travel-total").val(rowTotal);
    //             sectionTotal += rowTotal;
    //         });
    //         $(this).find(".travel-grand").val(sectionTotal);
    //         allDaysTotal += sectionTotal;
    //     });

    //     $("#day_travel_total").val(allDaysTotal);
    //     updateFinalTransport();
    // }
    function updateTravelTotals() 
    {
        let allDaysTotal = 0;
        let allDaysToll  = 0;
        let overnightArr = [];   

        $(".outside-section").each(function() {
            let sectionTotal = 0;
            let sectionToll  = 0;
            let sectionQty   = 0;
            let day          = $(this).data("day");

            $(this).find(".travel-row").each(function() {
                let price = parseFloat($(this).find(".travel-price").val()) || 0;
                let toll  = parseFloat($(this).find(".toll-price").val())   || 0;
                let qty   = parseFloat($(this).find(".travel-qty").val())   || 0;
                let vehicle_name = $(this).data("vehicle") || "";

                let rowTotal = price * qty;
                $(this).find(".travel-total").val(rowTotal);

                sectionTotal += rowTotal;
                sectionToll  += toll; 
                sectionQty   += qty;  

                // push row wise
                overnightArr.push({
                    day: day,
                    vehicle_name: vehicle_name,
                    travel: rowTotal,
                    toll: toll,
                    qty: qty,
                    total: rowTotal
                });
            });

            $(this).find(".travel-grand").val(sectionTotal);

            allDaysTotal += sectionTotal;
            allDaysToll  += sectionToll;
        });

        // update totals
        $("#day_travel_total").val(allDaysTotal);
        $("#overnight_toll_price").val(allDaysToll);

        $("#overnight_cost").val(JSON.stringify(overnightArr));

        updateFinalTransport();
        updateFinalToll();
    }



    $(document).on("input", ".outside-section .travel-price, .outside-section .toll-price, .outside-section .travel-qty", function() {
        updateTravelTotals();
    });

    $(document).ready(function() {
        updateTravelTotals();
    });

    function updateAllDaysFullDayTotal() {
        var allDaysTotal = 0;
        var fullDayByDay = [];

        $(".alert").each(function () {
            let $alert = $(this);
            let dayNo = parseInt($alert.data("day")) || 0;
            let dayTotal = 0;
            let vehicles = [];

            // Different city full-day rows
            $alert.find(".full-transport-row").each(function () {
                let r = $(this);
                let price = parseFloat(r.find(".full_price").val()) || 0;
                let qty   = parseInt(r.find(".full_qty").val()) || 0;
                let total = parseFloat(r.find(".full_total").val()) || 0;

                vehicles.push({
                    vehicle_name: r.find("div.col-md-4").text().trim(),
                    price: price,
                    qty: qty,
                    total: total
                });

                dayTotal += total;
            });

            // Inside city full-day rows
            $alert.find(".full-transport").each(function () {
                let r = $(this);
                let price = parseFloat(r.find(".full_i_price").val()) || 0;
                let qty   = parseInt(r.find(".full_i_qty").val()) || 0;
                let total = parseFloat(r.find(".full_i_total").val()) || 0;

                vehicles.push({
                    vehicle_name: r.find("div.col-md-4").text().trim(),
                    price: price,
                    qty: qty,
                    total: total
                });

                dayTotal += total;
            });

            if (dayTotal > 0) {
                fullDayByDay.push({
                    day: dayNo,
                    vehicles: vehicles
                });
            }

            allDaysTotal += dayTotal;
            $alert.find("input[type=hidden].total").val(dayTotal);
        });

        // existing logic
        $("#all_days_full_day_total").val(allDaysTotal);

        // new: day-wise array in hidden input
        $("#full_day_cost").val(JSON.stringify(fullDayByDay));

        updateFinalTransport();
    }

    $(document).on("input", ".full_price, .full_qty", function () {
        var row = $(this).closest(".full-transport-row");

        var price = parseFloat(row.find(".full_price").val()) || 0;
        var qty   = parseInt(row.find(".full_qty").val()) || 0;

        var total = price * qty;
        row.find(".full_total").val(total);

        var dayTotal = 0;
        row.closest(".alert").find(".full_total").each(function () {
            dayTotal += parseFloat($(this).val()) || 0;
        });

        row.closest(".alert").find("input[type=hidden].total").val(dayTotal);

        updateAllDaysFullDayTotal();
    });

    $(document).on("input", ".full_i_price, .full_i_qty", function () {
        var row = $(this).closest(".full-transport");

        var price = parseFloat(row.find(".full_i_price").val()) || 0;
        var qty   = parseInt(row.find(".full_i_qty").val()) || 0;

        var total = price * qty;
        row.find(".full_i_total").val(total);

        var dayTotal = 0;
        row.closest(".alert").find(".full_i_total").each(function () {
            dayTotal += parseFloat($(this).val()) || 0;
        });

        row.closest(".alert").find("input[type=hidden].total").val(dayTotal);

        updateAllDaysFullDayTotal();
    });
    $(document).ready(function () {
        updateAllDaysFullDayTotal();
    });



    // $(document).on("input", ".out_price, .out_toll, .out_parking, .out_qty", function () {
    //     var row = $(this).closest(".outside-transport-row");

    //     var price   = parseFloat(row.find(".out_price").val())   || 0;
    //     var toll    = parseFloat(row.find(".out_toll").val())    || 0;
    //     var parking = parseFloat(row.find(".out_parking").val()) || 0;
    //     var qty     = parseInt(row.find(".out_qty").val())       || 0;

    //     var total = (price + toll + parking) * qty;
    //     row.find(".out_total").val(total);

    //     var dayTotal = 0;
    //     row.closest(".alert").find(".out_total").each(function () {
    //         dayTotal += parseFloat($(this).val()) || 0;
    //     });
    //     row.closest(".alert").find("input[type=hidden].total-outside").val(dayTotal);

    //     var allDaysTotal = 0;
    //     $("input[type=hidden].total-outside").each(function() {
    //         allDaysTotal += parseFloat($(this).val()) || 0;
    //     });
    //     $("#all_days_outside_transport").val(allDaysTotal);
    //     updateFinalTransport();
    // });
    $(document).on("input", ".out_price, .out_toll, .out_parking, .out_qty", function () 
    {
        var row = $(this).closest(".outside-transport-row");

        var price   = parseFloat(row.find(".out_price").val())   || 0;
        var toll    = parseFloat(row.find(".out_toll").val())    || 0;
        var parking = parseFloat(row.find(".out_parking").val()) || 0;
        var qty     = parseInt(row.find(".out_qty").val())       || 0;

        var total = (price + parking) * qty;
        row.find(".out_total").val(total);

        var dayTotal     = 0;
        var dayTollTotal = 0;
        row.closest(".alert").find(".outside-transport-row").each(function () {
            let r   = $(this);
            let pr  = parseFloat(r.find(".out_price").val())   || 0;
            let tl  = parseFloat(r.find(".out_toll").val())    || 0;
            let pk  = parseFloat(r.find(".out_parking").val()) || 0;
            let qt  = parseInt(r.find(".out_qty").val())       || 0;

            dayTotal     += (pr + pk) * qt;
            dayTollTotal += tl * qt; 
        });

        row.closest(".alert").find("input[type=hidden].total-outside").val(dayTotal);

        var allDaysTotal = 0;
        var allDaysToll  = 0;
        $(".alert").each(function () {
            let $alert = $(this);

            allDaysTotal += parseFloat($alert.find("input[type=hidden].total-outside").val()) || 0;

            $alert.find(".outside-transport-row").each(function () {
                let r  = $(this);
                let tl = parseFloat(r.find(".out_toll").val()) || 0;
                let qt = parseInt(r.find(".out_qty").val())    || 0;
                allDaysToll += tl;  
            });
        });

        $("#all_days_outside_transport").val(allDaysTotal);
        $("#outside_toll_price").val(allDaysToll);

        var vehiclesByDay = [];
        $(".alert").each(function () {
            let $alert = $(this);
            let dayNo = parseInt($alert.data("day")) || 0;
            let dayVehicles = [];

            $alert.find(".outside-transport-row").each(function () {
                let r = $(this);
                dayVehicles.push({
                    vehicle_name: r.find("div.col-md-3").text().trim(),
                    price: parseFloat(r.find(".out_price").val())   || 0,
                    toll: parseFloat(r.find(".out_toll").val())     || 0,
                    parking: parseFloat(r.find(".out_parking").val()) || 0,
                    qty: parseInt(r.find(".out_qty").val())         || 0,
                    total: parseFloat(r.find(".out_total").val())   || 0
                });
            });

            if (dayVehicles.length > 0) {
                vehiclesByDay.push({ day: dayNo, vehicles: dayVehicles });
            }
        });

        $("#outside_cost").val(JSON.stringify(vehiclesByDay));

        updateFinalTransport();
        updateFinalToll();
    });
    $(document).ready(function () {
        $(".out_price, .out_toll, .out_parking, .out_qty").trigger("input");
    });

    $(document).on("input", ".adult_ticket, .child_ticket, .group_ticket, .group_count", function () 
    {
        var row = $(this).closest(".ticket-row");

        var oldTotal = parseFloat(row.find(".ticket_total").val()) || 0;
        var newTotal = 0;

        if (row.find(".group_ticket").length > 0) {
            // GROUP CALCULATION
            var groupCost = parseFloat(row.find(".group_ticket").val()) || 0;
            var groupCount = parseInt(row.find(".group_count").val()) || 0;
            newTotal = groupCost * groupCount;
        } else {
            // ADULT/CHILD CALCULATION
            var adultPrice = parseFloat(row.find(".adult_ticket").val()) || 0;
            var childPrice = parseFloat(row.find(".child_ticket").val()) || 0;

            var adultsNum = parseInt(row.find(".adult_ticket").data("adults")) || 0;
            var childNum  = parseInt(row.find(".child_ticket").data("children")) || 0;

            newTotal = (adultsNum * adultPrice) + (childNum * childPrice);
        }

        // update row total
        row.find(".ticket_total").val(newTotal);

        // update grand total
        var finalGrand = parseFloat($("#hdn_final_ticket_price").val()) || 0;
        finalGrand = finalGrand - oldTotal + newTotal;
        $("#hdn_final_ticket_price").val(finalGrand);
    });


    // $(document).on("input", ".per-night", function() 
    // {
    //     var perNight = parseFloat($(this).val()) || 0;
    //     var nights   = parseInt($(this).data("nights")) || 1;
    //     var rooms    = parseInt($(this).data("rooms")) || 1; // number of rooms
    //     var index    = $(this).data("index");

    //     // Row total = per-night × nights (do NOT multiply by rooms)
    //     var rowTotal = perNight * nights;
    //     $(".night-total[data-index='" + index + "']").val(rowTotal);

    //     // Hotel sub-total = sum of row totals × rooms
    //     var hotelBlock = $(this).closest(".hotel-block");
    //     var subTotal = 0;
    //     hotelBlock.find(".night-total").each(function() {
    //         subTotal += (parseFloat($(this).val()) || 0) * rooms;
    //     });
    //     hotelBlock.find(".hotel-sub-total").val(subTotal);

    //     // Optional: grand total across all hotels
    //     var grandTotal = 0;
    //     $(".hotel-sub-total").each(function() {
    //         grandTotal += parseFloat($(this).val()) || 0;
    //     });
    //     $("#grand-total").val(grandTotal);
    //      updateHotelCostingJSON();
    // });
    // Only update the row where input changed
    // Universal hotel costing recalculation for individual & family
    // ...existing code...

    $(document).on('input', '.per-night', function() {
        var $row = $(this).closest('li');
        var nights = parseFloat($(this).data('nights')) || 1;
        var rooms = parseFloat($(this).data('rooms')) || 1;
        var price = parseFloat($(this).val()) || 0;

        var rowTotal = nights * price;
        $row.find('.night-total').val(rowTotal);

        var categoryTotal = 0;
        $row.closest('ul').find('li').each(function() {
            var nightTotal = parseFloat($(this).find('.night-total').val()) || 0;
            var roomCount = parseFloat($(this).find('.per-night').data('rooms')) || 1;
            categoryTotal += nightTotal * roomCount;
        });
        $row.closest('ul').find('.hotel-sub-total').val(categoryTotal);

        var hotelTotal = 0;
        $(this).closest('.col-md-6').find('.hotel-sub-total').each(function() {
            hotelTotal += parseFloat($(this).val()) || 0;
        });
        $(this).closest('.col-md-6').find('.hotel-grand-total').val(hotelTotal);
    <?php if($this->input->get('hdn_group_type') == 'individual') { ?>
        updateHotelCostingJSON();
        <?php }?>
        <?php if($this->input->get('hdn_group_type') == 'family'){?>
            updateFamilyHotelCostingJSON();
            <?php
        } ?>
    });

    function updateFamilyHotelCostingJSON() {
        let costingData = {};

        $(".hotel-row").each(function() {
            var parentRow = $(this);
            var category  = parentRow.data("category");   
            var hotelId   = parentRow.data("hotel-id");
            var amount    = parseFloat(parentRow.find(".night-total").val()) || 0;

            if (!category || !hotelId) return;

            if (!costingData[category]) costingData[category] = {};
            if (!costingData[category][hotelId]) costingData[category][hotelId] = 0;

            costingData[category][hotelId] += amount;
        });

        $("#hotel_costing_category_wise").val(JSON.stringify(costingData));
    }

  
    function updateHotelCostingJSON() 
    {
        let costingData = {};

        $(".hotel-row").each(function() 
        {
            var parentRow = $(this);
            var category  = parentRow.data("category");
            var hotel     = parentRow.data("hotel");
            var hotelId   = parentRow.data("hotel-id");
            var hotelCity = parentRow.data("hotel-city");
            var nights    = parentRow.data("nights"); 
            var room      = parentRow.data("room");
            var occupancy = parentRow.data("occupancy");
            var amount    = parseFloat(parentRow.find(".night-total").val()) || 0;

            if (!category || !hotel || !room || !occupancy) return;

            if (!costingData[category]) costingData[category] = {};

            // Only add hotel metadata if data exists
            if (!costingData[category][hotel]) {
                costingData[category][hotel] = {};
                if (nights && hotelId && hotelCity) {
                    costingData[category][hotel].hotel_id   = hotelId;
                    costingData[category][hotel].hotel_city = hotelCity;
                    costingData[category][hotel].nights     = nights;
                }
            } else if (nights) {
                // update nights if greater
                costingData[category][hotel].nights = Math.max(
                    costingData[category][hotel].nights || 0,
                    nights
                );
            }

            if (!costingData[category][hotel][room]) costingData[category][hotel][room] = [];

            let existsIndex = costingData[category][hotel][room]
                .findIndex(val => val.startsWith(occupancy));
            if (existsIndex >= 0) {
                costingData[category][hotel][room][existsIndex] = occupancy + "__" + amount;
            } else {
                costingData[category][hotel][room].push(occupancy + "__" + amount);
            }
        });
        $("#hotel_costing_category_wise").val(JSON.stringify(costingData));
    }

    function updateUpdownTotal() 
    {
        let total = 0;
        let tollTotal = 0;
        $(".transport-row_out_hotel").each(function() {
            let price   = parseFloat($(this).find(".price").val())   || 0;
            let toll    = parseFloat($(this).find(".toll").val())    || 0;
            let parking = parseFloat($(this).find(".parking").val()) || 0;
            let qty     = parseFloat($(this).find(".qty").val())     || 1;

            let oneWay = (price + parking) * qty;
            let upDown = oneWay * 2;

            $(this).find(".total").val(oneWay);
            $(this).find(".updown_total").val(upDown);

            total += upDown; 
            tollTotal += (toll); 
        });

        $("#updown_total").val(total);
        $("#outside_hotel_toll").val(tollTotal);
        updateFinalTransport();
        updateFinalToll();
    }
    $(document).on("input", ".transport-row_out_hotel input.price, .transport-row_out_hotel input.toll, .transport-row_out_hotel input.parking, .transport-row_out_hotel input.qty", function() {
        updateUpdownTotal();
        
    });

    $(document).on("input", "#mandatory_grand_total", function() {
        var value = $(this).val(); 
        $("#hdn_mandatory_grand_total").val(value); 
    });

   function recalcTotal(rowId) 
    {
        let adultPrice = parseFloat(document.querySelector('.adult_price[data-row="'+rowId+'"]').value) || 0;
        let childPrice = parseFloat(document.querySelector('.child_price[data-row="'+rowId+'"]').value) || 0;

        let adults = parseInt(document.querySelector('.adults_count[data-row="'+rowId+'"]').value) || 0;
        let children = parseInt(document.querySelector('.children_count[data-row="'+rowId+'"]').value) || 0;

        let total = (adultPrice * adults) + (childPrice * children);

        document.getElementById(rowId).value = total;

        let allDayTotal = 0;
        document.querySelectorAll(".activity_total").forEach(function(el){
            allDayTotal += parseFloat(el.value) || 0;
        });

        let allDayInput = document.getElementById("all_day_activities_total");
        if (allDayInput) {
            allDayInput.value = Math.round(allDayTotal);
        }
    }
    document.addEventListener("input", function(e) {
        if (e.target.classList.contains("adult_price") || e.target.classList.contains("child_price")) {
            let rowId = e.target.getAttribute("data-row");
            recalcTotal(rowId);
        }
    });
    // When bundle price is changed manually
    $(document).on("input", "#final_transport_without_toll", function () {
        recalcFinalTransport();
    });

    function recalcFinalTransport() {
        let bundle = parseFloat($("#final_transport_without_toll").val()) || 0;
        let toll   = parseFloat($("#final_toll_price").val()) || 0;

        let total = bundle + toll;
        $("#final_transport").val(total);
    }
    
    //   $(document).on('input', '.per-night', function() {
    //     let $input = $(this);
    //     let nights = parseInt($input.data('nights')) || 1;
    //     let indexKey = $input.data('index');
    //     let perNight = parseFloat($input.val()) || 0;

    //     console.log('=== INPUT CHANGED ===', { indexKey, nights, perNight });

    //     // Update the total display
    //     let total = perNight * nights;
    //     $input.closest('.hotel-row').find('.night-total').val(total);

    //     // Get current hotel_arr value
    //     let hotelArrValue = $('input[name="hotel_arr"]').val();
    //     if (!hotelArrValue) {
    //         console.log('No hotel_arr value found');
    //         return;
    //     }

    //     try {
    //         let hotelData = JSON.parse(hotelArrValue);
    //         console.log('Parsed hotelData:', hotelData);
            
    //         // Parse index key: hotel_id_category_tt
    //         // Format: "3_1_Guest Room (King Bed)_0"
    //         let keyParts = indexKey.split('_');
    //         console.log('Key parts:', keyParts);
            
    //         if (keyParts.length < 4) {
    //             console.log('Invalid key format');
    //             return;
    //         }
            
    //         // Extract parts correctly
    //         let targetHotelId = keyParts[0]; 
    //         let targetTt = parseInt(keyParts[keyParts.length - 1]); // Last part "0"
            
    //         // The category is everything between first and last parts
    //         let categoryParts = keyParts.slice(1, keyParts.length - 1); // Remove first and last
    //         let targetCategory = categoryParts.join('_'); // "1_Guest Room (King Bed)"
            
    //         console.log('Looking for:', { 
    //             targetHotelId: targetHotelId, 
    //             targetCategory: targetCategory, 
    //             targetTt: targetTt 
    //         });

    //         let updated = false;

    //         // Find and update the specific record
    //         for (let i = 0; i < hotelData.length; i++) {
    //             let hotel = hotelData[i];
                
    //             console.log('Checking hotel:', hotel.hotel_id, hotel.hotel_name);
                
    //             if (hotel.hotel_id == targetHotelId && hotel.hotel_room_details) {
    //                 console.log('Hotel matched!');
                    
    //                 try {
    //                     let roomDetails = JSON.parse(hotel.hotel_room_details);
    //                     console.log('Room details:', roomDetails);
                        
    //                     if (roomDetails[targetCategory]) {
    //                         console.log('Category found:', targetCategory, roomDetails[targetCategory]);
                            
    //                         // roomDetails[targetCategory] is an array of objects
    //                         let categoryArray = roomDetails[targetCategory];
                            
    //                         if (categoryArray[targetTt]) {
    //                             let roomObj = categoryArray[targetTt];
    //                             console.log('Room object found:', roomObj);
                                
    //                             if (roomObj.room_type && Array.isArray(roomObj.room_type)) {
    //                                 console.log('Room types:', roomObj.room_type);
                                    
    //                                 // Get the occupancy type from the current row
    //                                 let $row = $input.closest('.hotel-row');
    //                                 let occupancyText = $row.data('occupancy'); // "Single Occupancy", "Double Occupancy", etc.
    //                                 console.log('Occupancy text from row:', occupancyText);
                                    
    //                                 // Extract the occupancy word from the text
    //                                 let occupancyWord = occupancyText.split(' ')[0]; // "Single", "Double", "Triple"
                                    
    //                                 // Map to occupancy codes and multipliers
    //                                 let occupancyMap = {
    //                                     'Single': { code: '1(A)', multiplier: 1 },
    //                                     'Double': { code: '2(A)', multiplier: 2 },
    //                                     'Triple': { code: '3(A)', multiplier: 3 }
    //                                 };
                                    
    //                                 let occupancyInfo = occupancyMap[occupancyWord];
    //                                 let targetOccupancyCode = occupancyInfo ? occupancyInfo.code : '';
    //                                 let multiplier = occupancyInfo ? occupancyInfo.multiplier : 1;
                                    
    //                                 console.log('Target occupancy code:', targetOccupancyCode, 'Multiplier:', multiplier);
                                    
    //                                 if (targetOccupancyCode) {
    //                                     // Find and update the specific room type
    //                                     for (let j = 0; j < roomObj.room_type.length; j++) {
    //                                         let rt = roomObj.room_type[j];
    //                                         console.log('Checking room type:', rt);
                                            
    //                                         let parts = rt.trim().split(' ');
    //                                         if (parts.length >= 2) {
    //                                             let occupancyCode = parts[0];
    //                                             let oldPrice = parts[1];
                                                
    //                                             console.log('Parsed:', { occupancyCode, oldPrice });
                                                
    //                                             if (occupancyCode === targetOccupancyCode) {
    //                                                 console.log('Occupancy matched! Updating...');
                                                    
    //                                                 // Update the price - multiply by occupancy multiplier
    //                                                 let updatedPrice = perNight * multiplier;
    //                                                 roomObj.room_type[j] = occupancyCode + ' ' + updatedPrice;
    //                                                 updated = true;
                                                    
    //                                                 console.log('Updated room type:', roomObj.room_type[j]);
    //                                                 break;
    //                                             }
    //                                         }
    //                                     }
    //                                 }
    //                             }
                                
    //                             if (updated) {
    //                                 // Update the room details in the hotel object
    //                                 hotel.hotel_room_details = JSON.stringify(roomDetails);
    //                                 console.log('Updated hotel room details:', hotel.hotel_room_details);
    //                                 break;
    //                             }
    //                         } else {
    //                             console.log('Target TT index not found:', targetTt, 'Available indices: 0 to', categoryArray.length - 1);
    //                         }
    //                     } else {
    //                         console.log('Target category not found:', targetCategory, 'Available categories:', Object.keys(roomDetails));
    //                     }
    //                 } catch (e) {
    //                     console.error('Error parsing room details:', e);
    //                 }
    //             }
                
    //             if (updated) break;
    //         }

    //         if (updated) {
    //             $('input[name="hotel_arr"]').val(JSON.stringify(hotelData));
    //             console.log('SUCCESS: hotel_arr updated');
                
    //             // Verify the update
    //             let updatedValue = $('input[name="hotel_arr"]').val();
    //             console.log('Updated hotel_arr:', updatedValue);
    //         } else {
    //             console.log('No updates were made - check the console logs above for issues');
    //         }
            
    //     } catch (error) {
    //         console.error('Error parsing hotel_arr:', error);
    //     }
    // });
    
     $(document).on('input', '.per-night', function() {
        let $input = $(this);
        let nights = parseInt($input.data('nights')) || 1;
        let indexKey = $input.data('index');
        let perNight = parseFloat($input.val()) || 0;

        console.log('=== INPUT CHANGED ===', { indexKey, nights, perNight });

        // Update the total display
        let total = perNight * nights;
        $input.closest('.hotel-row').find('.night-total').val(total);

        // Get current hotel_arr value
        let hotelArrValue = $('input[name="hotel_arr"]').val();
        if (!hotelArrValue) {
            console.log('No hotel_arr value found');
            return;
        }

        try {
            let hotelData = JSON.parse(hotelArrValue);
            console.log('Parsed hotelData:', hotelData);
            
            // Parse index key: hotel_id_category_tt
            // Format: "3_1_Guest Room (King Bed)_0"
            let keyParts = indexKey.split('_');
            console.log('Key parts:', keyParts);
            
            if (keyParts.length < 4) {
                console.log('Invalid key format');
                return;
            }
            
            // Extract parts correctly
            let targetHotelId = keyParts[0]; 
            let targetTt = parseInt(keyParts[keyParts.length - 1]); // Last part "0"
            
            // The category is everything between first and last parts
            let categoryParts = keyParts.slice(1, keyParts.length - 1); // Remove first and last
            let targetCategory = categoryParts.join('_'); // "1_Guest Room (King Bed)"
            
            console.log('Looking for:', { 
                targetHotelId: targetHotelId, 
                targetCategory: targetCategory, 
                targetTt: targetTt 
            });

            let updated = false;

            // Find and update the specific record
            for (let i = 0; i < hotelData.length; i++) {
                let hotel = hotelData[i];
                
                console.log('Checking hotel:', hotel.hotel_id, hotel.hotel_name);
                
                if (hotel.hotel_id == targetHotelId && hotel.hotel_room_details) {
                    console.log('Hotel matched!');
                    
                    try {
                        let roomDetails = JSON.parse(hotel.hotel_room_details);
                        console.log('Room details:', roomDetails);
                        
                        if (roomDetails[targetCategory]) {
                            console.log('Category found:', targetCategory, roomDetails[targetCategory]);
                            
                            // roomDetails[targetCategory] is an array of objects
                            let categoryArray = roomDetails[targetCategory];
                            
                            if (categoryArray[targetTt]) {
                                let roomObj = categoryArray[targetTt];
                                console.log('Room object found:', roomObj);
                                
                                if (roomObj.room_type && Array.isArray(roomObj.room_type)) {
                                    console.log('Room types:', roomObj.room_type);
                                    
                                    // Get the occupancy type from the current row
                                    let $row = $input.closest('.hotel-row');
                                    let occupancyText = $row.data('occupancy'); // "Single Occupancy", "Double Occupancy", etc.
                                    console.log('Occupancy text from row:', occupancyText);
                                    
                                    // Extract the occupancy word from the text
                                    // let occupancyWord = occupancyText.split(' ')[0]; // "Single", "Double", "Triple"
                                    let occupancyWord = occupancyText ? occupancyText.trim() : '';
                                    console.log('occupancyWord', occupancyWord);

                                    // Map to occupancy codes and multipliers
                                    let group_type = "<?= $this->input->get('hdn_group_type'); ?>";
                                    let occupancyMap = {};

                                    if (group_type === "individual") {
                                        occupancyMap = {
                                            'Single Occupancy': { code: '1(A)', multiplier: 1 },
                                            'Double Occupancy': { code: '2(A)', multiplier: 2 },
                                            'Triple Occupancy': { code: '3(A)', multiplier: 3 }
                                        };
                                    } else if (group_type === "family") {
                                        occupancyMap = {
                                            'Single Occupancy': { code: '1(A)', multiplier: 1 },
                                            'Double Occupancy': { code: '2(A)', multiplier: 1 },  
                                            'Triple Occupancy': { code: '3(A)', multiplier: 1 },
                                            'Single Child Occupancy': { code: '1(C)', multiplier: 1 },
                                            'Double Child Occupancy': { code: '2(C)', multiplier: 1 },
                                            'Triple Child Occupancy': { code: '3(C)', multiplier: 1 }
                                        };
                                    }
                                    
                                    let occupancyInfo = occupancyMap[occupancyWord];
                                    let targetOccupancyCode = occupancyInfo ? occupancyInfo.code : '';
                                    let multiplier = occupancyInfo ? occupancyInfo.multiplier : 1;
                                    
                                    console.log('Target occupancy code:', targetOccupancyCode, 'Multiplier:', multiplier);
                                    
                                    if (targetOccupancyCode) {
                                        // Find and update the specific room type
                                        for (let j = 0; j < roomObj.room_type.length; j++) {
                                            let rt = roomObj.room_type[j];
                                            console.log('Checking room type:', rt);
                                            
                                            let parts = rt.trim().split(' ');
                                            if (parts.length >= 2) {
                                                let occupancyCode = parts[0];
                                                let oldPrice = parts[1];
                                                
                                                console.log('Parsed:', { occupancyCode, oldPrice });
                                                
                                                if (occupancyCode === targetOccupancyCode) {
                                                    console.log('Occupancy matched! Updating...');
                                                    
                                                    // Update the price - multiply by occupancy multiplier
                                                    let updatedPrice = perNight * multiplier;
                                                    roomObj.room_type[j] = occupancyCode + ' ' + updatedPrice;
                                                    updated = true;
                                                    
                                                    console.log('Updated room type:', roomObj.room_type[j]);
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                                
                                if (updated) {
                                    // Update the room details in the hotel object
                                    hotel.hotel_room_details = JSON.stringify(roomDetails);
                                    console.log('Updated hotel room details:', hotel.hotel_room_details);
                                    break;
                                }
                            } else {
                                console.log('Target TT index not found:', targetTt, 'Available indices: 0 to', categoryArray.length - 1);
                            }
                        } else {
                            console.log('Target category not found:', targetCategory, 'Available categories:', Object.keys(roomDetails));
                        }
                    } catch (e) {
                        console.error('Error parsing room details:', e);
                    }
                }
                
                if (updated) break;
            }

            if (updated) {
                $('input[name="hotel_arr"]').val(JSON.stringify(hotelData));
                console.log('SUCCESS: hotel_arr updated');
                
                // Verify the update
                let updatedValue = $('input[name="hotel_arr"]').val();
                console.log('Updated hotel_arr:', updatedValue);
            } else {
                console.log('No updates were made - check the console logs above for issues');
            }
            
        } catch (error) {
            console.error('Error parsing hotel_arr:', error);
        }
    });

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
     let all_day_meal_prices = <?= ($this->input->get('meal') == 'yes') ? json_encode($all_day_meal_prices) : '[]'; ?>;
    // Initialize JS variable with all meal data from PHP
    let allMealData = all_day_meal_prices;

    // Hidden field reference
    const hiddenInput = document.getElementById('meal_type_daywise_price');
    hiddenInput.value = JSON.stringify(allMealData);

    // Function: Update grand total below table
    function updateGrandTotal() {
        let grandTotal = 0;
        document.querySelectorAll('.meal-total').forEach(input => {
            grandTotal += parseFloat(input.value) || 0;
        });

        // Update both text and input field (for flexibility)
        document.querySelectorAll('.grandTotalMeal').forEach(el => {
            // if (el.tagName === 'INPUT') 
            //     el.value = grandTotal.toLocaleString();
            // else el.textContent = grandTotal.toLocaleString();
            if (el.tagName === 'INPUT') {
            // Hidden/input field → plain numeric value (no comma)
            el.value = grandTotal;
            } else {
                // Text display → formatted value with commas
                el.textContent = grandTotal.toLocaleString();
            }
        });
    }

    // Function: Update meal data JSON in hidden field
    function updateMealData(dayKey, buffetType, price, persons) {
        if (!allMealData[dayKey]) allMealData[dayKey] = {};
        allMealData[dayKey][buffetType] = {
            ...allMealData[dayKey][buffetType],
            price: price,
            meal_total: price * persons
        };
        hiddenInput.value = JSON.stringify(allMealData);
    }

    // Function: Get current meal data
    window.getCurrentMealData = function() {
        return allMealData;
    };

    // --- On Page Load: calculate totals for all rows ---
    document.querySelectorAll('.meal-price').forEach(input => {
        const price = parseFloat(input.value) || 0;
        const persons = parseInt(input.dataset.persons) || 0;
        const total = price * persons;

        // Update total field in the same row
        const totalField = input.closest('tr').querySelector('.meal-total');
        if (totalField) totalField.value = total;

        // Extract name parts
        const nameParts = input.name.match(/meal_price\[(.*?)\]\[(.*?)\]/);
        if (nameParts) {
            const dayKey = nameParts[1];
            const buffetType = nameParts[2];
            updateMealData(dayKey, buffetType, price, persons);
        }
    });

    // Initial grand total update
    updateGrandTotal();
    // --- Event Listeners ---

    // When meal price changes
    $(document).on('input', '.meal-price', function () {
        const price = parseFloat($(this).val()) || 0;
        const persons = parseInt($(this).data('persons')) || 0;
        const total = price * persons;

        // Update total field in same row
        $(this).closest('tr').find('.meal-total').val(total);

        // Extract dayKey and buffetType
        const nameParts = $(this).attr('name').match(/meal_price\[(.*?)\]\[(.*?)\]/);
        if (nameParts) {
            const dayKey = nameParts[1];
            const buffetType = nameParts[2];
            updateMealData(dayKey, buffetType, price, persons);
        }

        updateGrandTotal();
        console.log("Updated meal data:", allMealData);
    });

    // When total is edited manually
    $(document).on('input', '.meal-total', function () {
        updateGrandTotal();
    });
});
</script>
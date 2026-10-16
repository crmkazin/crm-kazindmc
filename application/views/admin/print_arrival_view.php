<?php
$cmb_enquiry_id = $this->db
    ->select('combo_enquiry_id')
    ->where('id', $arrivals->id)
    ->get('arrivals')
    ->row();
    
$cmb_nght = $this->db
    ->select('*')
    ->where('id', $cmb_enquiry_id->combo_enquiry_id)
    ->get('combo_enquiry')
    ->row();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $arrivals->enquiry_no; ?> : Arrival Chart</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
        .bg-light-back {
            background-color: #ebebeb !important
        }

        .remove-border {
            background-color: #bfbfbf !important
        }


        @media print {
            html {
                -webkit-print-color-adjust: exact;
            }

            .print-data {
                page-break-after: always;
            }

            .noPrint {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12 text-start logo-left bg-new-file"><img
                    src="<?php echo base_url(); ?>assets/admin/print/images/logo.png" class="mt-2 mb-2"></div>
        </div>
        <div class="row" style="margin:0 0px ">
            <div class="col-lg-12">
                <div class="print-head">FILE ARRIVAL DETAILS</div>
            </div>

            <div class="col-lg-12">
                <div class="in-pl">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name text-danger"><strong>File No. :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->enquiry_no; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Agent Name :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->filename; echo ($arrivals->agent_reference_num<>'')?" ($arrivals->agent_reference_num)":''; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Arrival Date</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->arrival_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Check in Date :</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->check_in_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Check Out Date :</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->check_out_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Number Of Nights :</strong> </div>
                    <label class="lab-data"><?php
                        if (str_starts_with($arrivals->enquiry_no, 'C')) {
                            echo $cmb_nght->no_of_nights;
                        }else{
                            
                            echo $arrivals->number_of_nights;
                        }
                    ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Group Type :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->group_type; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Lead Contact :</strong></div>
                    <label
                        class="lab-data"><?php echo $arrivals->lead_isd_code;
                        echo $arrivals->lead_contact; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Handover to other :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->handover_to_client); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Handover to Kazin :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->handover_to_kazin); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Lead Name :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->lead_name; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Status: :</strong></div>
                    <label class="lab-data text-success"><?php echo ucfirst($arrivals->status); ?></label>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>No Of Adults :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->num_adults); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>No Of Child :</strong></div>
                    <label class="lab-data text-success"><?php echo ucfirst($arrivals->num_child); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Child Ages:</strong></div>
                    <label class="lab-data" style="font-weight:700">
                        <?php 
                        $num_child = $arrivals->num_child ?? 0;
                        $child_ages = $arrivals->child_ages ?? '';

                        // If there are children and child_ages exists
                        if ($num_child > 0 && !empty($child_ages)) {
                            // Try to decode if it's JSON, otherwise use as is
                            if (is_string($child_ages)) {
                                $ages_array = json_decode($child_ages, true) ?? [];
                            } else {
                                $ages_array = is_array($child_ages) ? $child_ages : [];
                            }
                            
                            if (!empty($ages_array)) {
                                $child_age_text = implode(', ', $ages_array) . ' yrs';
                            } else {
                                $child_age_text = $num_child . ' children (ages not specified)';
                            }
                        } else {
                            $child_age_text = 'No children';
                        }

                        echo $child_age_text;
                        ?>
                    </label>
                </div>
            </div>
            
            <?php if (!empty($arrival_hotel_details)) { ?>
                <div class="col-lg-12">
                    <div class="in-pl">
                        <div class="print-sub-head head-space">Hotel Details</div>
                        <?php //if(empty($arrival_room)){ ?><!--div class="print-sub-head head-space text-danger">(Booked Directly By Guest)</div--><?php //} ?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="in-pl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-warning" width="40px"><strong class="text-white">S.No.</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Hotel</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Address</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Check In</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Check Out</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Booking Status</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($arrival_hotel_details as $list) {
                                    ?>
                                    <tr>
                                        <td class="bg-white"><?php echo ++$i; ?></td>
                                        <td class="bg-white"><?php echo $list->hotel; ?></td>
                                        <td class="bg-white">
                                            <?php echo $list->address_1;
                                            echo ", ";
                                            echo $list->address_2;
                                            echo ", ";
                                            echo $list->city;
                                            echo ", ";
                                            echo $list->state; ?>
                                        </td>
                                        <td class="bg-white"><?php echo date('d-M-Y', strtotime($list->checkin_date)); ?></td>
                                        <td class="bg-white"><?php echo date('d-M-Y', strtotime($list->checkout_date)); ?></td>
                                        <td class="bg-white"><?php echo ($list->arrival_room_details_id!='')?'Booked By Kazin':'<strong class="text-danger">Booked Directly By Guest</strong>'; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($arrival_flight)) { ?>
                <div class="col-lg-12">
                    <div class="in-pl">
                        <div class="print-sub-head head-space">Flight Details:</div>
                        <div class="print-sub-head head-space"><strong style="color:#e90606;">Arrivals</strong></div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="in-pl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Airline</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Departure</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Arrival</strong></th>
                                    <th class="bg-warning"><strong class="text-white">No. of Persons</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($arrival_flight as $list) {
                                    if($list->flight_mode == 'inbound'){
                                    ?>
                                    <tr>
                                        <td class="bg-white"><?php echo ++$i; ?></td>
                                        <td class="bg-white"><?php echo $list->name; ?> (<?php echo $list->flight_number; ?>)
                                        </td>
                                        <td class="bg-white"><?php echo $list->departure_city; ?>
                                            <?php echo date('d, M Y', strtotime($list->departure_date)) . '(' . $list->departure_time . ')'; ?>
                                        </td>
                                        <td class="bg-white"><strong style="color:#e90606;"><?php echo $list->arrival_city; ?>
                                            <?php echo date('d, M Y', strtotime($list->arrival_date)) . '(' . $list->arrival_time . ')'; ?>
                                            </strong>
                                        </td>
                                        <td class="bg-white"><?php echo $list->number_persons; ?></td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="in-pl">
                        <div class="print-sub-head head-space">Flight Details:</div>
                        <div class="print-sub-head head-space"><strong style="color:#e90606;">Departures</strong></div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="in-pl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Airline</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Departure</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Arrival</strong></th>
                                    <th class="bg-warning"><strong class="text-white">No. of Persons</strong></th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($arrival_flight as $list) {
                                    if($list->flight_mode == 'outbound'){
                                    ?>
                                    <tr>
                                        <td class="bg-white"><?php echo ++$i; ?></td>
                                        <td class="bg-white"><?php echo $list->name; ?> (<?php echo $list->flight_number; ?>)
                                        </td>
                                        <td class="bg-white"><strong style="color:#e90606;"><?php echo $list->departure_city; ?>
                                            <?php echo date('d, M Y', strtotime($list->departure_date)) . '(' . $list->departure_time . ')'; ?>
                                            </strong>
                                        </td>
                                        <td class="bg-white"><?php echo $list->arrival_city; ?>
                                            <?php echo date('d, M Y', strtotime($list->arrival_date)) . '(' . $list->arrival_time . ')'; ?>
                                        </td>
                                        <td class="bg-white"><?php echo $list->number_persons; ?></td>                                        
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    

            <?php } ?>

            <?php if (!empty($itinerary)) { ?>
                <div class="col-lg-12 head-space">
                    <div class="in-pl">
                        <div class="print-sub-head">Itinerary</div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="in-pl">
                        <?php
                        $i = 0;
                        $itinerary_date = $itinerary[0];
                        foreach ($itinerary as $list) {
                            if ($i == 0 || $itinerary_date != $list->date) {
                                $sr = 0;
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="bg-warning">
                                                <strong
                                                    class="ms-3 text-white"><?php echo date('d M Y (l)', strtotime($list->date)); ?></strong>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="fadetbl" width="10%">
                                                <p class="text-black">Time</p>
                                            </th>
                                            <th class="fadetbl" width="50%">
                                                <p class="text-black">Activities</p>
                                            </th>
                                            <th class="fadetbl" width="25%">
                                                <p class="text-black">Remark</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php } ?>

                                    <tr>
                                        <!--<td class="bg-white"><?= ++$sr; ?></td>-->
                                        <td class="bg-white"><?php echo $list->time; ?> Hrs</td>
                                        <td class="bg-white">
                                            <?php if ($list->title <> '') {
                                                echo ($list->title <> '') ? urldecode($list->title) : '';
                                            } else {
                                                echo urldecode($list->content);
                                            } ?>
                                        </td>
                                        <td class="bg-white"><?php echo urldecode($list->remarks); ?></td>
                                    </tr>

                                    <?php
                                    $itinerary_date = $list->date;
                                    if (!array_key_exists($i + 1, $itinerary) || $itinerary_date != $itinerary[$i + 1]->date) { ?>
                                    </tbody>
                                </table>
                            <?php }
                                    $i++;
                        } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="col-lg-12 head-space">
                <div class="in-pl">
                    <div class="print-sub-head">Transportation Details</div>
                </div>
            </div>
            <?php if ($arrivals->vehicle_name <> '') { ?>
                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Name : </div>
                        <label class="lab-data"><?php echo $arrivals->vehicle_name; ?></label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Vehicle Type : </div>
                        <label class="lab-data"><?php echo $arrivals->vehicle_type; ?></label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Capacity: </div>
                        <label class="lab-data"><?php echo $arrivals->capacity; ?></label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Luggage Vehicle: </div>
                        <label class="lab-data"><?php echo ucfirst($arrivals->luggage_transport); ?></label>
                    </div>
                </div>
                <!--<div class="col-lg-4">-->
                <!--    <div class="in-pl">-->
                <!--        <div class="field-name">Remarks: </div>-->
                <!--        <label class="lab-data"><?php //echo $arrivals->remarks; ?></label>-->
                <!--    </div>-->
                <!--</div>-->
            <?php }
            if (!empty($data_transportation)) {
                foreach ($data_transportation as $list) {
                    ?>
                    <div class="clearfix"></div>
                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">Name : </div>
                            <label class="lab-data"><?php echo $list->vehicle_name; ?> X <?php echo $list->quantity; ?></label>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">Vehicle Type : </div>
                            <label class="lab-data"><?php echo $list->vehicle_type; ?></label>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">Capacity : </div>
                            <label class="lab-data"><?php echo $list->capacity; ?></label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">Luggage Vehicle : </div>
                            <label class="lab-data"><?php echo ucfirst($list->luggage_vehicle); ?></label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">City : </div>
                            <label class="lab-data"><?php echo ucfirst($list->city); ?></label>
                        </div>
                    </div>
                    <!--<div class="col-lg-4">-->
                    <!--    <div class="in-pl">-->
                    <!--        <div class="field-name">Remarks: </div>-->
                    <!--        <label class="lab-data"><?php //echo $list->remarks; ?></label>-->
                    <!--    </div>-->
                    <!--</div>-->
                <?php }
            }
            if ($arrivals->vehicle_name == '' && empty($data_transportation)) {
                ?>
                <div class="col-lg-12">
                    <p style="text-align: center;color: #fda2a2;">No Transportation Details</p>
                </div>
            <?php } ?>
                

            <div class="col-lg-12 head-space">
                <hr>
                <div class="in-pl">
                    <div class="print-sub-head">Guide Details</div>
                </div>
            </div>
            <?php if ($arrivals->guide_id != '0') { ?>
                <div class="col-lg-4">
                    <div class="in-pl">
                        <img src="<?php echo ($arrivals->photo <> '') ? base_url('assets/guide/' . $arrivals->photo) : base_url('assets/admin/images/no-image-icon.png'); ?>"
                            width="75" height="75" class=" fluid mt-2">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Guide Name : </div>
                        <label class="lab-data"><?php echo $arrivals->guide; ?></label>
                    </div>
                    <div class="in-pl">
                        <div class="field-name">Location : </div>
                        <label class="lab-data"><?php echo $arrivals->location; ?></label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Gender : </div>
                        <label class="lab-data"><?php echo ucfirst($arrivals->gender); ?></label>
                    </div>
                    <div class="in-pl">
                        <div class="field-name">Ph No.: </div>
                        <label
                            class="lab-data"><?php echo $arrivals->isd_codes . '-' . $arrivals->contact_number; ?></label>
                    </div>
                </div>

                <div class="col-lg-12">
                    <label class="lab-data"> Other Guides : </label>
                    <?php if (!empty($data_guides)) {
                        foreach ($data_guides as $guide): ?>
                            <?php $arr[] = ucfirst($guide->name); ?>
                        <?php endforeach;
                        echo implode(', ', $arr);

                    } ?>
                </div>
            <?php } else if ($arrivals->guide_id == '0' && !empty($data_guides)) { ?>
                    <div class="col-lg-4">
                        <div class="in-pl">
                            <img src="<?php echo ($data_guides[0]->photo <> '') ? base_url('assets/guide/' . $data_guides[0]->photo) : base_url('assets/admin/images/no-image-icon.png'); ?>"
                                width="75" height="75" class=" fluid mt-2">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">Guide Name : </div>
                            <label class="lab-data"><?php echo $data_guides[0]->name; ?></label>
                        </div>
                        <div class="in-pl">
                            <div class="field-name">Location : </div>
                            <label class="lab-data"><?php echo $data_guides[0]->location; ?></label>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="in-pl">
                            <div class="field-name">Gender : </div>
                            <label class="lab-data"><?php echo ucfirst($data_guides[0]->gender); ?></label>
                        </div>
                        <div class="in-pl">
                            <div class="field-name">Ph No.: </div>
                            <label
                                class="lab-data"><?php echo $data_guides[0]->isd_codes . '-' . $data_guides[0]->contact_number; ?></label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="lab-data"> Other Guides : </label>
                        <?php
                        foreach ($data_guides as $key => $guide) {
                            if ($key > 0) {
                                $arr[] = ucfirst($guide->name);
                            }
                        }
                        if (!empty($arr)) {
                            echo implode(', ', $arr);
                        }
                        ?>
                    </div>
            <?php } else { ?>
                    <div class="col-lg-12">
                        <p style="text-align: center;color: #fda2a2;">No Guide</p>
                    </div>
            <?php } ?>

	        <div class="col-lg-12 head-space">
                <hr>
                <div class="in-pl">
                    <div class="print-sub-head">Driver Details</div>
                </div>
            </div>

             <?php if (!empty($data_drivers)) : ?>
                <div class="col-lg-4">
                    <div class="in-pl">
                        <div class="field-name">Driver Name :</div>
                        <label class="lab-data"><?php echo htmlspecialchars($data_drivers[0]->driver_name, ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    
                    <div class="in-pl">
                        <div class="field-name">Driver Phone Number :</div>
                        <label class="lab-data"><?php echo htmlspecialchars($data_drivers[0]->driver_phone_number, ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <p style="text-align: center;color: #fda2a2;">No driver.</p>
                </div>
            <?php endif; ?>

            		
			<?php if(!empty($arrival_room)){
                    $first_character = substr($arrivals->enquiry_no, 0, 1);
                ?>
            <div class="col-lg-12 head-space">
                <hr>
                <div class="in-pl">
                    <div class="print-sub-head">Room Confirmation</div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="in-pl">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                                <th class="bg-warning"><strong class="text-white">Hotel</strong></th>
                                <th class="bg-warning"><strong class="text-white">Check In</strong></th>
                                <th class="bg-warning"><strong class="text-white">Check Out</strong></th>
                                <th class="bg-warning"><strong class="text-white">Room Category</strong></th>
                                <th class="bg-warning"><strong class="text-white">Adults</strong></th>
                                <th class="bg-warning"><strong class="text-white">Child</strong></th>
                                <th class="bg-warning"><strong class="text-white">Confirmation No.</strong></th>
                                <th class="bg-warning" style="display:<?php echo ($first_character != 'G')?'none':''; ?>;"><strong class="text-white">No. Of Rooms</strong></th>
                                <th class="bg-warning"><strong class="text-white">Person Details</strong></th>
                                <th class="bg-warning"><strong class="text-white">Breakfast</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                             
                            $i=0; 
                                foreach($arrival_room AS $list){
                            ?>
                            <tr>
                                <td class="bg-white"><?php echo ++$i; ?></td>
                                <td class="bg-white"><?php echo $list->hotel; ?></td>
                                <td class="bg-white"><?php echo date('d-M-Y',strtotime($list->checkin_date)); ?></td>
                                <td class="bg-white"><?php echo date('d-M-Y',strtotime($list->checkout_date)); ?></td>
                                <td class="bg-white"><?php echo ucfirst($list->category); ?></td>
                                <td class="bg-white"><?php echo $list->number_adults; ?></td>
                                <td class="bg-white"><?php echo $list->number_child; ?></td>
                                <td class="bg-white"><?php echo $list->hotel_confirmation_num; ?></td>
                                <td class="bg-white" style="display:<?php echo ($first_character != 'G')?'none':''; ?>;"><?php echo $list->number_of_rooms; ?></td>
                                <td class="bg-white"><?php echo (isset($list->persons_details)?$list->persons_details:'<strong>Lead: </strong>'.$arrivals->lead_name); ?></td>
                                <td class="bg-white"><?php echo ucfirst($list->breakfast); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
			
            <!-- Restaurant Menu -->

            <div class="col-lg-12 head-space">
                <hr>
                <div class="in-pl">
                    <div class="print-sub-head">Restaurant Bookings</div>
                </div>
            </div>

            <?php if (!empty($restaurant_menus)) { ?>

                <div class="col-lg-12">
                    <div class="in-pl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Date</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Buffet</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Restaurant</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Restaurant Address</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Start Time</strong></th>
                                    <th class="bg-warning"><strong class="text-white">End Time</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Total Person</strong></th>
                                    <th class="bg-warning"><strong class="text-white">No. Of Veg Person</strong></th>
                                    <th class="bg-warning"><strong class="text-white">No. Of Non Veg Person</strong></th>
                                    <th class="bg-warning"><strong class="text-white">No. Of Vegan Person</strong></th>
                                    <th class="bg-warning"><strong class="text-white">No. Of Jain Meal</strong></th>
                                    <th class="bg-warning"><strong class="text-white">Meal Type</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $prev_date = null;
                                foreach ($restaurant_menus as $menu) {
                                    // Check if the date has changed
                                    $current_date = date('d-M-Y', strtotime($menu->date));
                                    if ($current_date != $prev_date && $prev_date !== null) {
                                        // If date changed, add a row with white background
                                        echo '<tr class="remove-border"><td colspan="13" ></td></tr>';
                                    }
                                    $prev_date = $current_date;
                                    ?>
                                    <tr>
                                        <td class="bg-white"><?php echo ++$i; ?> .</td>
                                        <td class="bg-white"><?php echo $current_date; ?></td>
                                        <td class="bg-white"><?php echo $menu->buffet; 
                                        if($menu->packed == 1){?>
                                            (Packed)
                                        <?php }?>
                                        <td class="bg-white"><?php echo ucfirst($menu->name); ?></td>
                                        <td class="bg-white">
                                            <?php echo ucfirst($menu->r_city) . ', ' . ucfirst($menu->r_country) ?>
                                        </td>
                                        <td class="bg-white"><?php echo $menu->opening_time; ?></td>
                                        <td class="bg-white"><?php echo $menu->closing_time; ?></td>
                                        <td class="bg-white"><?php echo $menu->no_of_person; ?></td>
                                        <td class="bg-white"><?php echo $menu->no_of_veg_person; ?></td>
                                        <td class="bg-white"><?php echo $menu->no_of_non_veg_person; ?></td>
                                        <td class="bg-white"><?php echo $menu->no_of_vegan_person; ?></td>
                                        <td class="bg-white"><?php echo $menu->no_of_jain_meal; ?></td>
                                        <td class="bg-white"><?php echo $menu->meals; ?></td>
                                    </tr>
                                    <?php
                                    $count = 0;
                                    $total_menu_types = count($menu->menu_cuisine_map);
                                    ?>
                                    
                                    <tr>
                                        <td class="bg-light-back text-center" colspan="3"><strong>Final Remarks</strong></td>
                                        <td class="bg-light-back text-center" colspan="10"><strong style="color:#18c30e;"><?php echo $menu->final_remark; ?></strong></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="bg-light-back text-center" colspan="13"><strong>Menus</strong></td>
                                    </tr>
                                    <?php
                                    foreach ($menu->menu_cuisine_map as $menu_type => $cuisine_items) {
                                        $count++;
                                        ?>
                                        <tr>
                                            <td class="bg-light-back" colspan="3">
                                                <strong><?php echo ucfirst(str_replace('_', ' ', $menu_type)); ?></strong>
                                            </td>
                                            <td class="bg-light-back" colspan="10"><?= $cuisine_items ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                <?php } ?>
                            </tbody>


                        </table>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg-12">
                    <p style="text-align: center;color: #fda2a2;">No Restaurant Menu</p>
                </div>
            <?php } ?>

            <!-- partial -->
        </div>
        <?php if($company){ ?>
        <div class="row" style="margin:0 30px ">
            <div class="col-lg-12" style="">
                <hr>
                <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-3 mb-2"><label class="field-name">Company</label></div>
                            <div class="col-lg-9 mb-2"><label class="lab-data"> <?php echo $company->name; ?> </label>
                            </div>
                            <div class="col-lg-3"><label class="field-name">Address</label></div>
                            <div class="col-lg-9"><label class="lab-data"><?php echo $company->address; ?></label></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4 mb-2"><label class="field-name">Contact Person</label></div>
                            <div class="col-lg-8 mb-2"><label class="lab-data"><?php echo $company->person_name; ?>
                                </label></div>
                            <div class="col-lg-4"><label class="field-name">Contact Mobile</label></div>
                            <div class="col-lg-8"><label
                                    class="lab-data"><?php echo $company->contact_number; ?></label> </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-12 text-center mt-3"><label class="field-name"><?php echo $company->country; ?></label></div>-->

                </div>
            </div>
        </div>
        <?php }else{ 
            echo 'No company data available.';?>
        <?php } ?>
        <div class="row" style="margin:0 30px ">
            <div class="print-sub-head head-space ms-2">Welcome to <?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?>: A Guide to Respectful Travel
            </div>
            <p>As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts
                in <?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?>, we kindly request that all visitors observe the following guidelines to
                uphold the
                dignity and cleanliness of the places we are privileged to explore:</p>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>1. Respect Local Traditions:</strong></div>
                    <label class="lab-data"><?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?> is a country rich in culture and traditions. Please
                        show respect
                        towards local customs, rituals, and etiquette. A little research or inquiry about local norms
                        can enrich your travel experience and foster mutual respect.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>2. Environmental Responsibility:</strong></div>
                    <label class="lab-data">Please help us keep <?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?>'s natural landscapes pristine
                        by
                        disposing of
                        litter in designated bins, recycling when possible, and minimizing your environmental footprint
                        during your stay.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>3. Hygiene Practices:</strong></div>
                    <label class="lab-data">Out of respect for future guests and to maintain the high standards of
                        cleanliness that <?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?> is proud of, we urge you to follow hygienic practices
                        in hotels and
                        public spaces. This includes using facilities as intended, being mindful of waste disposal, and
                        maintaining personal cleanliness.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>4. Interactions with Locals:</strong></div>
                    <label class="lab-data">
                        Warmth and hospitality are at the heart of 
                        <?= ($company?->country == 'Kazakhstan') ? 'Kazakh' : ($company?->country ?? '') ?> culture. When interacting
                        with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude,
                        and a smile can bridge the gap between different languages and cultures.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>5. Adherence to Hotel Policies:</strong></div>
                    <label class="lab-data"> Each hotel and accommodation has its own set of rules designed to ensure the comfort and safety of all guests. We ask that you familiarize yourself with and adhere to these policies throughout your stay. Please note that failure to comply with these policies may result in penalties or additional charges imposed by the hotel. Additionally, hotels may request a security deposit upon check-in.</label>
                </div>
            </div>
            <div class="col-lg-12">
                <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual
                    respect and understanding between tourists and the local community. Our goal is to create memorable
                    experiences for you that are respectful of the environment, local culture, and traditions of
                    <?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?>.</label>
            </div>
            <div class="col-lg-12 mt-2 mb-4">
                <label class="lab-data"><strong>Thank you for choosing to explore <?= ($company && $company->country) ? htmlspecialchars($company->country) : '' ?> with Kazin
                        DMC. Let’s make
                        your visit memorable for all the right reasons.</strong></label>
            </div>
        </div>
    </div>

</body>
<br>
<div class="content row noPrint">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
        <button class="btn btn-warning btn-sm"
            onclick="window.open('<?php echo base_url('print_file_arrival?id=' . base64_encode($arrivals->id) . '&print=pdf'); ?>','_blank')">Save
            As Pdf</button>
        <!--<button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button>-->
    </div>
</div>
<br>

</html>
<script>
    function exportHTMLToDoc() {
        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
            "xmlns:w='urn:schemas-microsoft-com:office:word' " +
            "xmlns='http://www.w3.org/TR/REC-html40'>" +
            "<head><meta charset='utf-8'><title>" + '<?php echo $arrivals->enquiry_no; ?>' + "</title></head><body>";
        var footer = "</body></html>";
        var sourceHTML = header + document.getElementById("cnt-print-data").innerHTML + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = '<?php echo $arrivals->enquiry_no . '_arrival_details'; ?>.doc';
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script>
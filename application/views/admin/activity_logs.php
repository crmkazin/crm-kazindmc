    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
        @media print {
            html {
                -webkit-print-color-adjust: exact;
            }

            .noPrint {
                display: none;
            }
        }

        .text-center {
            text-align: center
        }

        .pagination-buttons {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        .pagination-buttons .btn {
            margin-right: 5px;
        }

        body {
            background-image: url('../assets/admin/images/activity_bg.png') !important;
            background-size: cover;
            /* background-position-x: center; */
        }

        .bg-infos {
            background-color: darkblue;
        }
    </style>
    <div class="container-fluid p-0">

        <div class="row" style="margin:0px 10px">
            <div class="col-lg-12 text-start logo-left bg-danger"><img
                    src="<?php echo base_url(); ?>assets/admin/print/images/logo.png" class="mt-2 mb-2"></div>
        </div>

        <div class="row" style="margin:10px 0px ">
            <div class="col-lg-12">
                <div class="in-pl">

                </div>
            </div>
            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name text-danger"><strong>File No. :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->enquiry_no; ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Agent Name :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->filename; ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Arrival Date</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->arrival_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Check in Date :</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->check_in_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Check Out Date :</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->check_out_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Number Of Nights :</strong> </div>
                    <label class="lab-data"><?php echo $arrivals->number_of_nights; ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Group Type :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->group_type; ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Lead Contact :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->lead_isd_code;
                                            echo $arrivals->lead_contact; ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Handover to other :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->handover_to_client); ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Handover to Kazin :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->handover_to_kazin); ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Lead Name :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->lead_name); ?></label>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="in-pl">
                    <div class="field-name"><strong>Status: :</strong></div>
                    <label
                        class="lab-data text-success"><strong><?php echo ucfirst($arrivals->status); ?></strong></label>
                </div>
            </div>
        </div>

        <div class="row" style="margin:0px 0px ">
            <div class="col-lg-6">
                <?php if (!empty($arrival_flight)) { ?>
                    <div class="in-pl">
                        <div class="print-sub-head head-space">Flight Details</div>
                    </div>

                    <div class="col-lg-12">
                        <div class="in-pl">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-danger"><strong class="text-white">S.No.</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Airline</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Departure</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Arrival</strong></th>
                                        <th class="bg-danger"><strong class="text-white">No. of Persons</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Flight Mode</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($arrival_flight as $list) {
                                    ?>
                                        <tr>
                                            <td class="bg-white"><?php echo ++$i; ?></td>
                                            <td class="bg-white"><?php echo $list->name; ?>
                                                (<?php echo $list->flight_number; ?>)
                                            </td>
                                            <td class="bg-white"><?php echo $list->departure_city; ?>
                                                <?php echo date('d, M Y', strtotime($list->departure_date)) . '(' . $list->departure_time . ')'; ?>
                                            </td>
                                            <td class="bg-white"><?php echo $list->arrival_city; ?>
                                                <?php echo date('d, M Y', strtotime($list->arrival_date)) . '(' . $list->arrival_time . ')'; ?>
                                            </td>
                                            <td class="bg-white"><?php echo $list->number_persons; ?></td>
                                            <td class="bg-white"><?php echo ucfirst($list->flight_mode); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>


                <?php if (!empty($arrival_hotel_details)) { ?>
                    <div class="in-pl">
                        <div class="print-sub-head head-space">Hotel Details</div>
                        <?php //if(empty($arrival_room)){ 
                        ?>
                        <!--div class="print-sub-head head-space text-danger">(Booked Directly By Guest)</div--><?php //} 
                                                                                                                ?>
                    </div>

                    <div class="col-lg-12">
                        <div class="in-pl">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-danger" width="40px"><strong class="text-white">S.No.</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Hotel</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Address</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Check In</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Check Out</strong></th>
                                        <th class="bg-danger"><strong class="text-white">Booking Status</strong></th>
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
                                            <td class="bg-white"><?php echo date('d-M-Y', strtotime($list->checkin_date)); ?>
                                            </td>
                                            <td class="bg-white"><?php echo date('d-M-Y', strtotime($list->checkout_date)); ?>
                                            </td>
                                            <td class="bg-white">
                                                <?php echo ($list->arrival_room_details_id != '') ? 'Booked By Kazin' : '<strong class="text-danger">Booked Directly By Guest</strong>'; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 head-space">
                            <div class="in-pl">
                                <div class="print-sub-head">Guide Details</div>
                            </div>
                        </div>
                        <?php if ($arrivals->guide_id != '0') { ?>
                            <div class="col-lg-2">
                                <div class="in-pl">
                                    <img src="<?php echo ($arrivals->photo <> '') ? base_url('assets/guide/' . $arrivals->photo) : base_url('assets/admin/images/no-image-icon.png'); ?>"
                                        width="75" height="75" class=" fluid mt-2">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="in-pl">
                                    <div class="field-name">Guide Name : </div>
                                    <label class="lab-data"><?php echo $arrivals->guide; ?></label>
                                </div>
                                <div class="in-pl">
                                    <div class="field-name">Location : </div>
                                    <label class="lab-data"><?php echo $arrivals->location; ?></label>
                                </div>
                            </div>

                            <div class="col-lg-2">
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
                                    <div class="field-name">Phone No.: </div>
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
                                <p style="text-align: center;" class="bg-danger m-3">No Guide Details</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
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

                            <div class="col-lg-4">
                                <div class="in-pl">
                                    <div class="field-name">Remarks: </div>
                                    <label class="lab-data"><?php echo $arrivals->remarks; ?></label>
                                </div>
                            </div>
                            <?php }

                        if (!empty($data_transportation)) {
                            foreach ($data_transportation as $list) {
                            ?>
                                <div class="clearfix"></div>
                                <div class="col-lg-4">
                                    <div class="in-pl">
                                        <div class="field-name">Name : </div>
                                        <label class="lab-data"><?php echo $list->vehicle_name; ?> X
                                            <?php echo $list->quantity; ?></label>
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
                                        <div class="field-name">Capacity: </div>
                                        <label class="lab-data"><?php echo $list->capacity; ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="in-pl">
                                        <div class="field-name">Luggage Vehicle: </div>
                                        <label class="lab-data"><?php echo ucfirst($list->luggage_vehicle); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="in-pl">
                                        <div class="field-name">Remarks: </div>
                                        <label class="lab-data"><?php echo $list->remarks; ?></label>
                                    </div>
                                </div>
                            <?php }
                        }
                        if ($arrivals->vehicle_name == '' && empty($data_transportation)) {
                            ?>
                            <div class="col-lg-12">
                                <p style="text-align: center;" class="bg-danger m-3">No Transportation Details</p>
                            </div>
                        <?php } ?>

                        <?php if (!empty($data_drivers)) { ?>
                            <div class="col-lg-4">
                                <div class="in-pl">
                                    <div class="field-name">Driver Name :</div>
                                    <label class="lab-data"><?php echo htmlspecialchars($data_drivers[0]->driver_name, ENT_QUOTES, 'UTF-8'); ?></label>
                                </div>
                            </div>
                            <?php } else {?>
                            <div class="col-lg-12">
                                <p style="text-align: center;color:rgb(12, 12, 12);">No driver.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

                  
            <div class="col-lg-6">
                <div class="col-lg-12 head-space">
                    <div class="in-pl">
                        <div class="print-sub-head">Itinerary Details</div>
                    </div>
                </div>
                <br>
                <?php if (!empty($itinerary)) {
            // Group itinerary by date
            $grouped_itinerary = [];
            foreach ($itinerary as $list) {
                $grouped_itinerary[$list->date][] = $list;
            }
            $dates = array_keys($grouped_itinerary);

            // Get today's date
            $today_date = date('Y-m-d');

            // Find the index of today's date in the itinerary
            $today_date_index = array_search($today_date, $dates);

            // Get the current date index from query string, subtract 1 to make it 0-based
            $current_date_index = isset($_GET['day']) ? intval($_GET['day']) - 1 : ($today_date_index !== false ? $today_date_index : 0);

            // Ensure current_date_index is within bounds
            $current_date_index = max(0, min($current_date_index, count($dates) - 1));

            $current_date = $dates[$current_date_index];
            $current_itinerary = $grouped_itinerary[$current_date];

            // Function to format date as 26-June-2024
            function formatDate($date) {
                $dateObj = DateTime::createFromFormat('Y-m-d', $date);
                return $dateObj->format('d-F-Y');
            }
            ?>
                <div class="col-md-12 mt-2">
                    <div class="in-pl">
                        <div class="pagination-buttons">
                            <?php if ($current_date_index > 0) { ?>
                            <a href="?day=<?= $current_date_index ?>" id="btn-prev"
                                class="btn btn-primary btn-xs">Previous</a>
                            <?php } ?>
                            <?php if ($current_date_index < count($dates) - 1) { ?>
                            <a href="?day=<?= $current_date_index + 2 ?>" id="btn-next"
                                class="btn btn-primary btn-xs">Next</a>
                            <?php } ?>
                        </div>

                        <?php
                    $i = 0;
                    $day = $current_date_index + 1; // Day starts from 1 and increments with each date index
                    $sr = 0;
                    $formattedDate = formatDate($current_date);
                ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-danger">
                                    <th colspan="4">
                                        <strong class="ms-3 text-white">Day: <?= $day ?>
                                            (<?= $formattedDate ?>)</strong>
                                    </th>
                                </tr>
                                <tr class="bg-infos">
                                    <th class="" width="10%">
                                        <p class="text-white">Time</p>
                                    </th>
                                    <th class="" width="50%">
                                        <p class="text-white">Activities</p>
                                    </th>
                                    <th class="" width="25%">
                                        <p class="text-white">Remarks</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($current_itinerary as $list) { ?>
                                <tr>
                                    <td class="bg-white"><?= $list->time ?> Hrs</td>
                                    <td class="bg-white">
                                        <?= $list->title !== '' ? urldecode($list->title) . '<br>' : urldecode($list->content) ?>
                                    </td>
                                    <td class="bg-white"><?= urldecode($list->remarks) ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="col-lg-12">
                    <p style="text-align: center;" class="bg-danger m-3">No Activities Found..</p>
                </div>
                <?php }?>
            </div>
        </div>
    </div>

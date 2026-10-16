<?php 
$driver_id = $arrivals->driver_id;

$this->db->select('*');
$this->db->from('arrivals');
$this->db->join('drivers', 'arrivals.driver_id = drivers.id', 'left');
$this->db->where('arrivals.driver_id IS NOT NULL');
$this->db->where('arrivals.driver_id !=', 0);

if (!empty($driver_id) && $driver_id != 0) {
    $this->db->where('arrivals.driver_id', $driver_id);
}

$query = $this->db->get();

if ($query && $query->num_rows() > 0) {
    $result = $query->row();
} else {
    $result = null;
    // Optionally: log error or show a friendly message
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $arrivals->enquiry_no ?>: Arrival Chart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/admin/print/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/admin/print/css/style.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/admin/print/js/bootstrap.js') ?>"></script>
    <style>
        @media print {
            html { -webkit-print-color-adjust: exact; }
            .print-data { page-break-after: always; }
            .noPrint { display: none; }
        }
        strong { font-weight: bold; }
        .tbl-arrivals { margin-bottom: 8px; }
        .tbl-arrivals td { padding: 4px !important; }
        .table td, th { border: 1px solid #000 !important; padding: 4px !important; }
        @page * { margin-top: 2.54cm; }
    </style>
</head>
<body>
<div class="container print-data" id="cnt-print-data">
    <div class="row">
        <div class="col-12 text-start logo-left bg-new">
            <table class="tbl-arrivals" style="border:0;">
                <tbody>
                    <tr>
                        <td style="width:30%;">
                            <img src="<?= base_url('assets/company/'.$arrivals->company_logo) ?>" class="mt-2 mb-2 p-2" height="50">
                        </td>
                        <td style="width:70%; text-align:right; color: #FFF;">
                            <div class="field-name"><strong>Contact Name :</strong> <label class="lab-data"><?= $arrivals->contact_person ?></label></div>
                            <div class="field-name"><strong>Contact Number :</strong> <label class="lab-data"><?= $arrivals->contact_num ?></label></div>
                            <div class="field-name"><strong>Address :</strong> <label class="lab-data"><?= $arrivals->address . (!empty($arrivals->address_2) ? ', ' . $arrivals->address_2 : '') ?></label></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="margin:0 30px">
        <div class="col-lg-12">
            <div class="print-head">SERVICE VOUCHER</div>
        </div>

        <table class="tbl-arrivals" style="border:0;">
            <tbody>
                <tr>
                    <td><strong>File No. :</strong> <label class="lab-data"><?= $arrivals->enquiry_no ?></label></td>
                    <td><strong>Agent Name :</strong> <label class="lab-data"><?= $arrivals->filename . (!empty($arrivals->agent_reference_num) ? " ($arrivals->agent_reference_num)" : '') ?></label></td>
                    <td><strong>Arrival Date :</strong> <label class="lab-data"><?= date('d-M-Y', strtotime($arrivals->arrival_date)) ?></label></td>
                </tr>
                <tr>
                    <td><strong>Check in Date :</strong> <label class="lab-data"><?= date('d-M-Y', strtotime($arrivals->check_in_date)) ?></label></td>
                    <td><strong>Check Out Date :</strong> <label class="lab-data"><?= date('d-M-Y', strtotime($arrivals->check_out_date)) ?></label></td>
                    <td><strong>Number Of Nights :</strong> <label class="lab-data"><?= $arrivals->number_of_nights ?></label></td>
                </tr>
                <tr>
                    <td><strong>Group Type :</strong> <label class="lab-data"><?= $arrivals->group_type ?></label></td>
                    <td><strong>Lead Contact :</strong> <label class="lab-data"><?= $arrivals->lead_isd_code . ' ' . $arrivals->lead_contact ?></label></td>
                    <td><strong>Handover to other :</strong> <label class="lab-data"><?= ucfirst($arrivals->handover_to_client) ?></label></td>
                </tr>
                <tr>
                    <td><strong>Handover to Kazin :</strong> <label class="lab-data"><?= ucfirst($arrivals->handover_to_kazin) ?></label></td>
                    <td><strong>Lead Name :</strong> <label class="lab-data"><?= $arrivals->lead_name ?></label></td>
                    <td><strong>Status :</strong> <label class="lab-data"><?= ucfirst($arrivals->status) ?></label></td>
                </tr>
                <tr>
                    <td><strong>No Of Person :</strong> <label class="lab-data"><?php echo ucfirst($arrivals->num_adults); ?></label></td>
                    <td><strong>No Of Child :</strong> <label class="lab-data"><?php echo ucfirst($arrivals->num_child); ?></label></td>
                    <td><strong>No Of Child Age :</strong> <label class="lab-data"><?php 
                            
                            $child_ages = json_decode($arrivals->child_ages ?? '[]');
                            if (is_array($child_ages) && !empty($child_ages)) {
                                $count = count($child_ages);
                                echo implode(', ', $child_ages) . ' yr' . ($count > 1 ? 's' : '');
                            } else {
                                echo 'No children';
                            }
                        
                        ?>
                        </label></td>
                </tr>
            </tbody>
        </table>

        <?php if (!empty($arrival_hotel_details)) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="6" class="bg-secondary">
                            <strong class="text-white">Hotel Details</strong>
                            <?php if (empty($arrival_room)) {
                                // echo '<strong class="text-danger" style="background-color: #FFF;padding: 3px 4px;">&nbsp;(Booked Directly By Guest)&nbsp;</strong>';
                            } ?>
                        </th>
                    </tr>
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
                    foreach ($arrival_hotel_details as $list) { ?>
                        <tr style="border-bottom: 1px solid #000;">
                            <td class="bg-white"><?= ++$i; ?></td>
                            <td class="bg-white"><?= $list->hotel; ?> <a href="<?= $list->map ?>">Location</a></td>
                            <td class="bg-white"><?= $list->address_1 . ', ' . $list->address_2 . ', ' . $list->city . ', ' . $list->state; ?></td>
                            <td class="bg-white"><?= date('d-M-Y', strtotime($list->checkin_date)); ?></td>
                            <td class="bg-white"><?= date('d-M-Y', strtotime($list->checkout_date)); ?></td>
                            <td class="bg-white"><?= ($list->arrival_room_details_id != '') ? 'Booked By Kazin' : '<strong class="text-danger">Booked Directly By Guest</strong>'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <?php if (!empty($arrival_flight)) { ?>
            <!-- Arrivals -->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="5" class="bg-secondary">
                            <strong class="text-white">Flight Details: </strong>
                            <strong class="text-white" style="background-color:#e90606;">Arrivals</strong>
                        </th>
                    </tr>
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
                        if ($list->flight_mode == 'inbound') { ?>
                            <tr style="border-bottom: 1px solid #000;">
                                <td class="bg-white"><?= ++$i; ?></td>
                                <td class="bg-white" style="border-bottom:1px solid #ff1d1d !important;"><?= $list->name . '(' . $list->flight_number . ')'; ?></td>
                                <td class="bg-white"><?= $list->departure_city . ' ' . date('d, M Y', strtotime($list->departure_date)) . '(' . $list->departure_time . ')'; ?></td>
                                <td class="bg-white"><strong style="color:#e90606;"><?= $list->arrival_city . ' ' . date('d, M Y', strtotime($list->arrival_date)) . '(' . $list->arrival_time . ')'; ?></strong></td>
                                <td class="bg-white"><?= $list->number_persons; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>

            <!-- Departures -->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="5" class="bg-secondary">
                            <strong class="text-white">Flight Details: </strong>
                            <strong class="text-white" style="background-color:#e90606;">Departures</strong>
                        </th>
                    </tr>
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
                        if ($list->flight_mode == 'outbound') { ?>
                            <tr style="border-bottom: 1px solid #000;">
                                <td class="bg-white"><?= ++$i; ?></td>
                                <td class="bg-white" style="border-bottom:1px solid #ff1d1d !important;"><?= $list->name . '(' . $list->flight_number . ')'; ?></td>
                                <td class="bg-white"><strong style="color:#e90606;"><?= $list->departure_city . ' ' . date('d, M Y', strtotime($list->departure_date)) . '(' . $list->departure_time . ')'; ?></strong></td>
                                <td class="bg-white"><?= $list->arrival_city . ' ' . date('d, M Y', strtotime($list->arrival_date)) . '(' . $list->arrival_time . ')'; ?></td>
                                <td class="bg-white"><?= $list->number_persons; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        <?php } ?>

        <?php if (!empty($itinerary)) {
            $i = 0;
            $itinerary_date = $itinerary[0];
            foreach ($itinerary as $list) {
                if ($i == 0 || $itinerary_date != $list->date) {
                    $sr = 0; ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="3" class="bg-secondary">
                                    <strong class="text-white">Itinerary</strong>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" class="bg-warning">
                                    <strong class="ms-3 text-white"><?= date('d M Y (l)', strtotime($list->date)); ?></strong>
                                </th>
                            </tr>
                            <tr>
                                <th class="fadetbl" width="10%"><p class="text-black">Time</p></th>
                                <th class="fadetbl" width="50%"><p class="text-black">Activities</p></th>
                                <th class="fadetbl" width="25%"><p class="text-black">Remark</p></th>
                            </tr>
                        </thead>
                        <tbody>
                <?php } ?>
                <tr style="border-bottom: 1px solid #000;">
                    <td class="bg-white"><?= $list->time; ?> Hrs</td>
                    <td class="bg-white"><?= urldecode($list->title) . ' ' . urldecode($list->content); ?></td>
                    <td class="bg-white"><?= urldecode($list->remarks); ?></td>
                </tr>
                <?php
                $itinerary_date = $list->date;
                if (!array_key_exists($i + 1, $itinerary) || $itinerary_date != $itinerary[$i + 1]->date) { ?>
                        </tbody>
                    </table>
                <?php }
                $i++;
            }
        } ?>

    

    <?php if ($arrivals->vehicle_name != ''): ?>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="bg-secondary">
                    <strong class="text-white">Transportation Details</strong>
                </th>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
                <td class="bg-white">
                    <div class="field-name">Name : <label class="lab-data"><?= $arrivals->vehicle_name ?></label></div>
                </td>
                <td class="bg-white">
                    <div class="field-name">Vehicle Type : <label class="lab-data"><?= $arrivals->vehicle_type ?></label></div>
                </td>
                <td class="bg-white">
                    <div class="field-name">Capacity: <label class="lab-data"><?= $arrivals->capacity ?></label></div>
                </td>
            </tr>
            <tr>
                <td class="bg-white">
                    <div class="field-name">Luggage Vehicle: <label class="lab-data"><?= ucfirst($arrivals->luggage_transport) ?></label></div>
                </td>
                <td class="bg-white">
                    <div class="field-name">Luggage Capacity: <label class="lab-data"><?= ucfirst($arrivals->luggage) ?></label></div>
                </td>
              
            </tr>
        </thead>
    </table>
    <?php endif; ?>

    <?php if (!empty($data_transportation)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="bg-secondary">
                        <strong class="text-white">Transportation Details</strong>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_transportation as $list): ?>
                    <tr style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
                        <td class="bg-white">
                            <div class="field-name">Name : <label class="lab-data"><?= $list->vehicle_name ?> X <?= $list->quantity ?></label></div>
                        </td>
                        <td class="bg-white">
                            <div class="field-name">Vehicle Type : <label class="lab-data"><?= $list->vehicle_type ?></label></div>
                        </td>
                        <td class="bg-white">
                            <div class="field-name">Capacity: <label class="lab-data"><?= $list->capacity ?></label></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-white">
                            <div class="field-name">Luggage Vehicle: <label class="lab-data"><?= ucfirst($list->luggage_vehicle) ?></label></div>
                        </td>
                        <td class="bg-white">
                            <div class="field-name">Luggage Capacity: <label class="lab-data"><?= ucfirst($list->luggage) ?></label></div>
                        </td>
                      
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($arrivals->guide_id != '0'): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="3" class="bg-secondary">
                        <strong class="text-white">Guide Details</strong>
                    </th>
                </tr>
                <tr style="border-bottom: 1px solid #000;">
                    <td rowspan="2" class="bg-white">
                        <img src="<?= ($arrivals->photo != '') ? base_url() . 'assets/guide/' . trim($arrivals->photo) : base_url() . 'assets/admin/images/no-image-icon.png' ?>" width="75" height="75" class="fluid mt-2">
                    </td>
                    <td class="bg-white">
                        <div class="field-name">Guide Name : <label class="lab-data"><?= htmlspecialchars($arrivals->guide) ?></label></div>
                    </td>
                    <td class="bg-white">
                        <div class="field-name">Location : <label class="lab-data"><?= htmlspecialchars($arrivals->location) ?></label></div>
                    </td>
                </tr>
                <tr>
                    <td class="bg-white">
                        <div class="field-name">Gender : <label class="lab-data"><?= ucfirst(htmlspecialchars($arrivals->gender)) ?></label></div>
                    </td>
                    <td class="bg-white">
                        <div class="field-name">Ph No.: <label class="lab-data"><?= htmlspecialchars($arrivals->isd_codes) . '-' . htmlspecialchars($arrivals->contact_number) ?></label></div>
                    </td>
                </tr>
                <!-- NEW: Guide Remarks row (full width) -->
                <tr>
                    <td colspan="3" class="bg-white">
                        <div class="field-name">Remarks : <label class="lab-data"><?= htmlspecialchars($arrivals->remarks) ?></label></div>
                    </td>
                </tr>
                <?php if (!empty($data_guides)): ?>
                    <tr style="border-top: 1px solid #000;">
                        <td class="bg-white" colspan="3">
                            <div class="field-name">Other Guides : <label class="lab-data"><?= implode(', ', array_map(fn($guide) => ucfirst(htmlspecialchars($guide->name)), $data_guides)) ?></label></div>
                        </td>
                    </tr>
                <?php endif; ?>
            </thead>
        </table>

    <?php elseif ($arrivals->guide_id == '0' && !empty($data_guides)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="3" class="bg-secondary">
                        <strong class="text-white">Guide Details</strong>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_guides as $guide): ?>
                    <?php 
                        $photo = trim($guide->photo);
                        $img_src = (!empty($photo)) 
                            ? base_url() . 'assets/guide/' . $photo 
                            : base_url() . 'assets/admin/images/no-image-icon.png';
                    ?>
                    <tr style="border-bottom: 1px solid #000;">
                        <td rowspan="2" class="bg-white text-center align-middle" style="width: 100px;">
                            <img src="<?= $img_src ?>" width="50" height="50" class="img-fluid" alt="Guide photo">
                        </td>
                        <td class="bg-white">
                            <div class="field-name">Guide Name : <label class="lab-data"><?= htmlspecialchars($guide->name) ?></label></div>
                        </td>
                        <td class="bg-white">
                            <div class="field-name">Location : <label class="lab-data"><?= htmlspecialchars($guide->location) ?></label></div>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #000;">
                        <td class="bg-white">
                            <div class="field-name">Gender : 
                                <label class="lab-data"><?= ucfirst(htmlspecialchars($guide->gender)) ?></label>
                            </div>
                        </td>
                        <td class="bg-white">
                            <div class="field-name">Ph No. : 
                                <label class="lab-data"><?= htmlspecialchars($guide->isd_codes) ?>-<?= htmlspecialchars($guide->contact_number) ?></label>
                            </div>
                        </td>
                    </tr>
                    <!-- NEW: Guide Remarks row (full width) for each guide -->
                    <tr>
                        <td colspan="3" class="bg-white">
                            <div class="field-name">Remarks : <label class="lab-data"><?= htmlspecialchars($guide->remarks) ?></label></div>
                        </td>
                    </tr>
                    <!-- Optional separator between guides -->
                    <?php if ($guide !== end($data_guides)): ?>
                        <tr><td colspan="3" style="padding:0; border:0;"><hr style="border-top: 2px dashed #ccc;"></td></tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <table class="" style="padding:4px;">
            <thead>
                <tr>
                    <th class="bg-secondary">
                        <strong class="text-white">Guide Details</strong>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center; color: #fda2a2;">No Guide</td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="col-lg-12 head-space">
        <div class="in-pl">
            <div class="print-sub-head">Driver Details</div>
        </div>
    </div>
    <?php if (!empty($result)) {?>
        <div class="col-lg-4">
            <div class="in-pl">
                <div class="field-name">Driver Name :</div>
                <label class="lab-data"><?php echo htmlspecialchars($result->driver_name, ENT_QUOTES, 'UTF-8');?></label>
            </div>
            <div class="in-pl">
                <div class="field-name">Driver Phone Number :</div>
                <label class="lab-data"><?php echo htmlspecialchars($result->driver_phone_number, ENT_QUOTES, 'UTF-8');?></label>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-lg-4">
            <p>No driver details found.</p>
        </div>
    <?php } ?>

    <?php if (!empty($restaurant_menus)) { ?>
  <table class="table">
    <thead>
    <tr>
      <th colspan="14" class="bg-secondary">
        <strong class="text-white">Restaurant Details</strong>
      </th>
    </tr>
    <tr>
      <th class="bg-warning" width="40px"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Date</strong></th>
      <th class="bg-warning"><strong class="text-white">Buffet</strong></th>
      <th class="bg-warning"><strong class="text-white">Restaurant</strong></th>
      <th class="bg-warning"><strong class="text-white">Restaurant Address</strong></th>
      <th class="bg-warning"><strong class="text-white">Start Time</strong></th>
      <th class="bg-warning"><strong class="text-white">End Time</strong></th>
      <th class="bg-warning"><strong class="text-white">Total Person</strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Veg Person</strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Non Veg Person</strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Vegan Person </strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Jain Meal </strong></th>
      <th class="bg-warning"><strong class="text-white">Meal Type</strong></th>
    </tr>
    </thead>
    <tbody>
      <?php
        $i = 0;
        $prev_date = null;
        foreach ($restaurant_menus as $list) {
          $current_date = date('d-M-Y', strtotime($list->date));
          if ($current_date != $prev_date && $prev_date !== null) {
            echo '<tr class="remove-border"><td colspan="14" ></td></tr>';
          }
          $prev_date = $current_date;
      ?>
      <tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
        <td class="bg-white"><?php echo ++$i; ?></td>
        <td class="bg-white"><?php echo $current_date; ?></td>
        <td class="bg-white"><?php echo $list->buffet . (($list->packed == 1) ? '<br>(Packed)' : ''); ?></td>
        <td class="bg-white"><?php echo ucfirst($list->name); ?></td>
        <td class="bg-white"><?php echo $list->restaurant_address; ?></td>
        <td class="bg-white"><?php echo $list->opening_time; ?></td> 
        <td class="bg-white"><?php echo $list->closing_time; ?></td>
        <td class="bg-white"><?php echo $list->no_of_person; ?></td>
        <td class="bg-white"><?php echo $list->no_of_veg_person; ?></td>
        <td class="bg-white"><?php echo $list->no_of_non_veg_person; ?></td>
        <td class="bg-white"><?php echo $list->no_of_vegan_person; ?></td>
        <td class="bg-white"><?php echo $list->no_of_jain_meal; ?></td>
        <td class="bg-white"><?php echo $list->meals; ?></td>
      </tr>

      <tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
        <td class="bg-light-back text-center" colspan="3"><strong>Final Remarks</strong></td>
        <td class="bg-light-back text-center" colspan="10"><strong style="color:#18c30e;"><?php echo $list->final_remark; ?></strong></td>
      </tr>
      <tr>
        <td class="bg-light-back text-center" colspan="13"><strong>Menus</strong></td>
      </tr>

      <?php foreach ($list->menu_cuisine_map as $menu_type => $cuisine_items) { ?>
        <tr>
          <td class="bg-light-back" colspan="3"><strong><?php echo ucfirst(str_replace('_', ' ', $menu_type)); ?></strong></td>
          <td class="bg-light-back" colspan="10"><?php echo $cuisine_items; ?></td>
        </tr>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>

<table class="tbl-arrivals mt-3" style="border:0;padding:4px;">
  <tbody>
    <tr>    
      <td>
        <div class="field-name"><strong>Company : </strong><label class="lab-data"><?php echo ($company->name ?? ''); ?></label></div>
      </td>
      <td>
        <div class="field-name"><strong>Address : </strong><label class="lab-data"><?php echo ($company->address ?? ''); ?></label></div>
      </td>
    </tr>   
    <tr> 
      <td>
        <div class="field-name"><strong>Contact Person : </strong><label class="lab-data"><?php echo ($company->person_name ?? ''); ?></label></div>
      </td>
      <td>
        <div class="field-name"><strong>Contact Mobile : </strong><label class="lab-data"><?php echo ($company->contact_number ?? ''); ?></label></div>
      </td>        
    </tr>      
  </tbody>
</table>

<table class="table table-bordered">
  <thead>
    <tr style="border-bottom: 1px solid #000;">
      <th class="bg-secondary">
        <strong class="text-white">Welcome to <?php echo ($company->country ?? ''); ?>: A Guide to Respectful Travel</strong>
      </th>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
      <td class="bg-white">As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts in <?php echo ($company->country ?? ''); ?>, we kindly request that all visitors observe the following guidelines to uphold the dignity and cleanliness of the places we are privileged to explore:</td>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>1. Respect Local Traditions:</strong>
    <label class="lab-data"><?php echo ($company->country ?? '');?>' is a country rich in culture and traditions. Please show respect towards local customs, rituals, and etiquette. A little research or inquiry about local norms can enrich your travel experience and foster mutual respect.</label>
    </div>
    </td>                
    </tr> 
    <tr style="border-bottom: 1px solid #000;">
        <td class="bg-white">
        <div class="field-name"><strong>2. Environmental Responsibility:</strong>
        <label class="lab-data">Please help us keep <?php echo ($company->country ?? '');?> '\'s natural landscapes pristine by disposing of litter in designated bins, recycling when possible, and minimizing your environmental footprint during your stay.</label>
        </div>
                    
    </td>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
        <td class="bg-white">
        <div class="field-name"><strong>3. Hygiene Practices:</strong>
        <label class="lab-data">Out of respect for future guests and to maintain the high standards of cleanliness that <?php echo ($company->country ?? ''); ?>  is proud of, we urge you to follow hygienic practices in hotels and public spaces. This includes using facilities as intended, being mindful of waste disposal, and maintaining personal cleanliness.</label>
        </div>
    </td>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
        <div class="field-name"><strong>4. Interactions with Locals:</strong>
        <label class="lab-data">Warmth and hospitality are at the heart of <?php echo (isset($company) && $company->country == 'Kazakhstan') ? 'Kazakh' : ($company->country ?? ''); ?> culture. When interacting with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude, and a smile can bridge the gap between different languages and cultures.</label>
        </div>       
    </td>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>5. Adherence to Hotel Policies:</strong>
        <label class="lab-data">Each hotel and accommodation has its own set of rules designed to ensure the comfort and safety of all guests. We ask that you familiarize yourself with and adhere to these policies throughout your stay. Please note that failure to comply with these policies may result in penalties or additional charges imposed by the hotel. Additionally, hotels may request a security deposit upon check-in.</label>
    </div>            
    </td>
    </tr>

    <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>6. Respect and Cleanliness of Transport Vehicles:</strong>
        <label class="lab-data">To ensure a pleasant journey, please maintain the cleanliness of our transport vehicles. Refrain from consuming alcohol and dispose of any trash responsibly. Kindly note that throwing trash inside the vehicle or disobeying any rules may result in the driver refusing to provide further services. Your cooperation helps keep the vehicle clean and enhances the travel experience for everyone. Thank you for your understanding.</label>
    </div>            
    </td>
    </tr>

    <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>7. Respect Towards Your Guide:</strong>
        <label class="lab-data">Your guide plays a crucial role in making your travel experience enjoyable and informative. Please show respect and consideration towards them, remembering that they are not personal assistants. Be punctual, attentive, and courteous. Your cooperation helps maintain a positive and professional relationship, ensuring a rewarding experience for everyone. Thank you for your understanding and appreciation.</label>
    </div>            
    </td>
    </tr>

    <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>8. For your safety and security:</strong>
        <label class="lab-data">We kindly ask that you do not leave any valuables unattended in the vehicle. We cannot be held responsible for any loss or damage to personal belongings left inside the vehicle. Please ensure you take all necessary precautions to safeguard your items.</label>
    </div>            
    </td>
    </tr>

    <tr style="border-bottom: 1px solid #000;">
        <td class="bg-white">
    <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual respect and understanding between tourists and the local community. Our goal is to create memorable experiences for you that are respectful of the environment, local culture, and traditions of <?php echo ($company->name ?? '');?> </label> 
    </td>
    </tr>
    <tr>
    <td class="bg-white">
    <label class="lab-data"><strong>Thank you for choosing to explore <?php echo ($company->country ?? ''); ?> with Kazin DMC. Let’s make your visit memorable for all the right reasons.</strong></label> 
    </td>
    </tr>
  </thead>
</table>

</div>
</div>
</body>
</html>

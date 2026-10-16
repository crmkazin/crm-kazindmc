<?php //include ('admin_head_css.php'); ?>
   <style>
    .greenText{ background-color:#02d530; }
    .blueText{ background-color:#0f4aff; }
    .orangeText{ background-color:orange; }
    .grayText{ background-color:#bdbdbd; }
    .whiteText{ background-color:#FFF; }

   
    </style>
   <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Agents Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Agents Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php //include('report_links.php'); ?>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                              
                                <div style="display: flex;justify-content: space-between;">
                                    <div class="filter-dropdown">
                                        <h3 class="text-primary">Advance Search</h3>
                                        <form method="get" autocomplete="off" style="margin-top: 0px !important;">
                                        <ul id="accordion" class="accordion ps-0">
                                            <li>
                                                <div Class="acco">
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Country
                                                    </div>
                                                    <div class="content">
                                                        <label for="location">Country</label>
                                                            <div class="input-container">
                                                                <div class="mySelect">
                                                                    <div class="input-container">
                                                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'country input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="country_id" id="country_id" class="country_id" value="">
                                                            </div>

                                                        <label for="staff_id">State</label>
                                                            <div class="input-container">
                                                                <div class="mySelect">
                                                                    <div class="input-container">
                                                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>urldecode($this->input->get('state'))]) ?>
                                                                    </div>                                            
                                                                </div>
                                                                <input type="hidden" name="state_id" id="state_id" class="state_id" value="">
                                                            </div>
                                                        <label for="booking_type">City</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <div class="input-container">
                                                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>urldecode($this->input->get('city'))]) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Company
                                                </div>
                                                <div class="content">
                                                  <label class="mdl-textfield__label">Company</label>
                                                    <div class="input-container">
                                                        <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'company input mdl-textfield__input', 'value'=>($this->input->get('company')<>'')?urldecode($this->input->get('company')):'']) ?>
                                                    </div>
                                                    <input type="hidden" name="company_id" id="company_id" class="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                                </div>
                                            </li>

                                            <!-- <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Email
                                                </div>
                                                <div class="content">
                                                <label class="mdl-textfield__label">Email Address</label>
                                                    <div class="input-container">
                                                        <?php //echo form_input(['name' => 'email', 'type' => 'email', 'id' => 'email', 'placeholder' => 'Agent email', 'class' => 'input mdl-textfield__input','value'=>urldecode($this->input->get('email'))]) ?>
                                                    </div>
                                                </div>
                                            </li> -->

                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Agent
                                                </div>
                                                <div class="content">
                                                    <label for="">Agent</label>
                                                    <div class="myselect">
                                                        <select name="agent" id="agent" class="agent select mdl-textfield__input">
                                                            <option value="">Select..</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Number
                                                </div>
                                                <div class="content">
                                                    <label class="mdl-textfield__label">Contact Number</label>
                                                    <div class="input-container">
                                                        <?php echo form_input(['name' => 'mobile', 'type' => 'text', 'id' => 'mobile', 'placeholder' => 'Agent Contact Details', 'class' => 'input mdl-textfield__input','value'=>urldecode($this->input->get('mobile'))]) ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="filter-buttons">
                                            <button type="" style="background-color:#4f4e4e;">Reset</button>
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-primary w-50', 'style' => '', 'value' => 'Search']); ?>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                <form method="get" autocomplete="off" style="margin-top: 0px !important;" class="content">
                                    <div class="card-body row">
                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Select Country</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'country input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id" class="country_id" value="">
                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">State</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>urldecode($this->input->get('state'))]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="state_id" id="state_id" class="state_id" value="">

                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">City</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>urldecode($this->input->get('city'))]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Company</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'company input mdl-textfield__input', 'value'=>($this->input->get('company')<>'')?urldecode($this->input->get('company')):'']) ?>
                                            </div>
                                            <input type="hidden" name="company_id" id="company_id" class="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                        </div>

                                         <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Pincode</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'pincode', 'type' => 'text', 'id' => 'pincode', 'placeholder' => 'pincode', 'class' => 'input mdl-textfield__input','value'=>urldecode($this->input->get('pincode'))]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                           <label class="mdl-textfield__label">Status</label>
                                           <div class="input-container">
                                               <select onchange="this.className=this.options[this.selectedIndex].className" name="enquiry_status" id="enquiry_status" class="select mdl-textfield__input" style="padding:8px; width:100%; border-radius:4px;">
                                                    <option class="whiteText" value="">All</option>
                                                    <option class="grayText" value="no-query" <?= ($this->input->get('enquiry_status')=='no-query')?'selected':''; ?>></option>
                                                    <option class="blueText" value="query-received-but-not-converted" <?= ($this->input->get('enquiry_status')=='query-received-but-not-converted')?'selected':''; ?>></option>
                                                    <option class="orangeText" value="only-one-query-converted" <?= ($this->input->get('enquiry_status')=='only-one-query-converted')?'selected':''; ?>></option>
                                                    <option class="greenText" value="queries-converted" <?= ($this->input->get('enquiry_status')=='queries-converted')?'selected':''; ?>></option>
                                                </select>    
                                           </div>
                                        </div>

                        
                                        <!-- <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Select Agent</label>
                                            <div class="myselect">
                                                <select name="agent" id="agent" class="agent select mdl-textfield__input">
                                                    <option value="">Select..</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Email Address</label>
                                            <div class="input-container">
                                                <?php //echo form_input(['name' => 'email', 'type' => 'email', 'id' => 'email', 'placeholder' => 'Agent email', 'class' => 'input mdl-textfield__input','value'=>urldecode($this->input->get('email'))]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="mdl-textfield__label">Contact Number</label>
                                            <div class="input-container">
                                                <?php //echo form_input(['name' => 'mobile', 'type' => 'text', 'id' => 'mobile', 'placeholder' => 'Agent Contact Details', 'class' => 'input mdl-textfield__input','value'=>urldecode($this->input->get('mobile'))]) ?>
                                            </div>
                                        </div> -->

                                        <div class="col-lg-12">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-info m-t-20', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                                <?php if (!empty($this->input->get('submit')) && empty($this->input->get('status'))) { ?>
                                                    <a href="<?php echo base_url('agents_report_excel?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                                        class="btn btn-sm btn-info ms-3 m-t-20" style="padding:6px;" title="Download Excel"
                                                        target="_blank">
                                                        <i class="fa fa-download"></i></a>
                                                <?php } else { ?>
                                                        <a href="<?php echo base_url('agents_export_excel?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                                            class="btn btn-sm btn-info ms-3 m-t-20" style="padding:6px;" title="Download Excel"
                                                            target="_blank" id="exportButton">
                                                            <i class="fa fa-download"></i></a>
                                                <?php } ?>

                                                 <a href="javascript:void(0)" class="btn btn-md btn-info m-t-20 ms-3" id="toggleBtn" style="float:left;">Advance Search</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="card-body">

                                    <?php
                                    if (!empty($this->input->get('submit')) && empty($this->input->get('status'))) { ?>
                                        <h3>Agent File Counts</h3>
                                        <div class="table-scrollable">
                                            <table class="table table-hover table-striped border table-checkable order-column full-width w-100"
                                                id="agent_file_count">
                                                <!-- Table header -->
                                                <thead>
                                                    <tr>
                                                        <th class="center">Sr.No </th>
                                                        <th class="center">Agent Name</th>
                                                        <th class="center">Designation</th>
                                                        <th class="center">Email</th>
                                                        <th class="center">Contact Number</th>
                                                        <!-- <th class="center">GST</th> -->
                                                        <th class="center">Address</th>
                                                        <th class="center">City</th>
                                                        <th class="center">State</th>
                                                        <th class="center">Country</th>
                                                        <th class="center">Company Name</th>
                                                        <th class="center remove">Logo</th>
                                                        <th class="center remove">File Counts</th>
                                                    </tr>
                                                </thead>
                                                <!-- Table body -->
                                                <tbody>
                                                    <?php
                                                    $records_cnt = 0;
                                                    if (!empty($agents_data)) {
                                                        $i = $offset + 1;
                                                        foreach ($agents_data as $agents) {
                                                            $records_cnt++;
                                                    ?>
                                                            <tr class="odd gradeX">
                                                                <td class="center"><?= $i++; ?></td>
                                                                <td class="center"><?= ucwords(strtolower($agents->contact_person)); ?></td>
                                                                <td class="center"><?= !empty($agents->designation) ? ucwords(strtolower($agents->designation)) : '-'; ?></td>
                                                                <td class="center"><?= !empty($agents->email) ? strtolower($agents->email) : '-'; ?></td>
                                                                <td class="center"><?= !empty($agents->contact_person_isd_code . $agents->contact_person_number) ? $agents->contact_person_isd_code . $agents->contact_person_number : '-'; ?></td>
                                                                <!-- <td class="center"><?= !empty($agents->gstin) ? strtoupper($agents->gstin) : '-'; ?></td> -->
                                                                <td class="center"><?= !empty($agents->address) ? $agents->address : '-'; ?></td>
                                                                <td class="center"><?= !empty($agents->city) ? ucwords(strtolower($agents->city)) : '-'; ?></td>
                                                                <td class="center"><?= !empty($agents->state) ? ucwords(strtolower($agents->state)) : '-'; ?></td>
                                                                <td class="center"><?= !empty($agents->country) ? ucwords(strtolower($agents->country)) : '-'; ?></td>
                                                                <td class="center"><?= !empty($agents->name) ? ucwords(strtolower($agents->name)) : '-'; ?></td>
                                                                <td class="center remove">
                                                                    <img class="img-width" src="<?= base_url('assets/a/' . $agents->company_logo); ?>" alt="Logo" height="90px">
                                                                </td>

                                                                <!-- Display statuses for the current company -->
                                                                <td class="center" style="display:inline-flex;">
                                                                    <?php
                                                                    // Predefined sequence of statuses
                                                                    $status_sequence = ['total', 'in-progress', 'complete', 'cancel', 'file-closed'];

                                                                    // Check if agent_data has statuses for the current company_id
                                                                    $status_data = !empty($agent_data[$agents->company_id]['statuses']) ? $agent_data[$agents->company_id]['statuses'] : [];

                                                                    // Initialize total count variable
                                                                    $total_count = 0;

                                                                    foreach ($status_data as $status_data_item) {
                                                                        // Add status count to total count
                                                                        $total_count += $status_data_item['status_count'];
                                                                    }

                                                                    foreach ($status_sequence as $status) {
                                                                        $status_count = 0;
                                                                        if ($status === 'total') {
                                                                            // Show total count for 'all-count' status
                                                                            $status_count = $total_count;
                                                                        } else {
                                                                            foreach ($status_data as $status_data_item) {
                                                                                if ($status_data_item['status'] === $status) {
                                                                                    $status_count = $status_data_item['status_count'];
                                                                                    break;
                                                                                }
                                                                            }
                                                                        }

                                                                        // Assign a CSS class based on the status
                                                                        $status_class = str_replace(' ', '-', strtolower($status));
                                                                    ?>
                                                                        <a href="#" class="count-circle mt-3 <?= $status_class; ?>" title="<?= ucfirst($status); ?>" data-agent_id="<?= $agents->company_id ?>" data-status="<?= $status_class ?>">
                                                                            <?= $status_count; ?>
                                                                        </a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>

                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($this->input->get('submit')) && !empty($this->input->get('status'))) { ?>
                                        <h3>Agent File Details</h3>
                                        <div class="table-scrollable">
                                            <table class="table table-hover table-checkable order-column full-width export_sheet" id="agent_report">
                                                <thead>
                                                    <tr>
                                                        <th class="center">S.No.</th>
                                                        <th class="center">Query <br>Number</th>
                                                        <th class="center">Physical <br>Arrival<br>Date</th>
                                                        <th class="center">Number Of<br>Nights</th>
                                                        <th class="center">Agent <br>Name</th>
                                                        <th class="center">Handling <br>Staff <br>Name</th>
                                                        <th class="center">Hotel <br>Name</th>
                                                        <th class="center">Transportation</th>
                                                        <th class="center">Guide</th>
                                                        <th class="center">Group <br>Type</th>
                                                        <th class="center">Handover <br>To <br>Client</th>
                                                        <th class="center">Nos. of<br>Guests</th>
                                                        <th class="center">Company Name</th>
                                                        <?php if ($this->session->userdata('email') != 'vishal@kazindmc.com') { ?>
                                                            <th class="center">Currency</th>
                                                            <th class="center">Client <br>Billing</th>
                                                            <th class="center">Payment <br>Received <br>In India</th>
                                                            <th class="center">Payment <br>Received <br>In Other</th>
                                                            <th class="center">Balance <br>Amount</th>
                                                            <th class="center">Payment Remarks</th>
                                                        <?php } ?>
                                                        <th class="center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $records_cnt = 0;
                                                    if (!empty($result)) {
                                                        $i = $offset + 1;
                                                        foreach ($result as $list) {
                                                            $records_cnt++;

                                                            $enq_id = $list->enquiry_id;

                                                            // Fetch flight details
                                                            $flight_where = 'arrival_flight_details.enquiry_id = ' . $enq_id . ' GROUP BY flight_mode';
                                                            $flight_select = 'SUM(arrival_flight_details.number_persons) AS person_cnt, arrival_flight_details.flight_mode';
                                                            $flight_details = $this->common_model->get_data('arrival_flight_details', '', '', $flight_select, $flight_where, '', false);

                                                            // Fetch hotel details
                                                            $hotel_where = 'arrival_hotel_details.enquiry_id = ' . $enq_id;
                                                            $hotel_select = 'arrival_hotel_details.hotel_name';
                                                            $hotel = $this->common_model->get_data('arrival_hotel_details', '', '', $hotel_select, $hotel_where, ' ORDER BY arrival_hotel_details.id ASC LIMIT 1', false);
                                                            $hotel_name = (!empty($hotel) ? $hotel[0]->hotel_name : '');

                                                            // Fetch payment remarks
                                                            $payment_where = 'payment_details.arrival_id = ' . $list->id;
                                                            $payment_select = 'payment_details.remarks';
                                                            $payment_details_remarks = $this->common_model->get_data('payment_details', '', '', $payment_select, $payment_where, ' ORDER BY payment_details.id DESC LIMIT 1', false);
                                                            $remarks = (!empty($payment_details_remarks) ? $payment_details_remarks[0]->remarks : '');

                                                            // Fetch transportation details
                                                            $trans_where = 'enquiry_transport.enquiry_id = ' . $enq_id . ' ORDER BY enquiry_transport.id ASC LIMIT 1';
                                                            $trans_join = [['type' => '', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id']];
                                                            $trans_details = $this->common_model->get_data('enquiry_transport', '', '', 'transportation.vehicle_type', $trans_where, '', false, $trans_join);

                                                            // Fetch guide details
                                                            $guide_where = 'enquiry_guide.enquiry_id = ' . $enq_id . ' ORDER BY enquiry_guide.id ASC';
                                                            $guide_join = [['type' => '', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id']];
                                                            $guide_details = $this->common_model->get_data('enquiry_guide', '', '', 'guides.name', $guide_where, '', false, $guide_join);
                                                            $guides = array_map(function ($guide){ return $guide->name; }, $guide_details);
                                                            if ($list->guide !== '') {
                                                                $guides[] = $list->guide;
                                                            }

                                                            // Determine status color
                                                            $status_color = [
                                                                'in-progress' => '#663399',
                                                                'complete' => '#18ce0f',
                                                                'cancel' => '#FF3636',
                                                                'file-closed' => '#b20783'
                                                            ];
                                                            $status = $list->status;
                                                    ?>
                                                            <tr class="odd gradeX">
                                                                <td class="center"><?= $i++ ?></td>
                                                                <td class="center" style="<?= $status == 'cancel' ? 'background-color: ' . $status_color[$status] . ';' : '' ?>">
                                                                    <?= $list->enquiry_no ?>
                                                                </td>
                                                                <td class="center" style="<?= $status == 'cancel' ? 'background-color: ' . $status_color[$status] . ';' : '' ?>">
                                                                    <?= date('d-M-Y', strtotime($list->arrival_date)) ?>
                                                                </td>
                                                                <td class="center"><?= $list->number_of_nights ?></td>
                                                                <td class="center"><?= $list->contact_person ?></td>
                                                                <td class="center"><?= $list->staff_name ?></td>
                                                                <td class="center"><?= $hotel_name ?></td>
                                                                <td class="center">
                                                                    <?= $list->vehicle_type ?: (!empty($trans_details) ? $trans_details[0]->vehicle_type : '') ?>
                                                                </td>
                                                                <td class="center">
                                                                    <?php if (!empty($guides)) {
                                                                        if (count($guides) == 1) {
                                                                            echo $guides[0];
                                                                        } else {
                                                                            echo '<div class="guide-hide">' . $guides[0] . ' ..<button class="btn btn-xs btn-primary btn-more">more</button></div>';
                                                                            echo '<div class="guide-show" style="display:none;">' . implode(', ', $guides) . ' <button class="btn btn-xs btn-danger btn-less">less</button></div>';
                                                                        }
                                                                    } else {
                                                                        echo '<i class="fa fa-user-times" aria-hidden="true" title="No Guide" style="color: #ffb1b1;"></i>';
                                                                    } ?>
                                                                </td>
                                                                <td class="center"><?= $list->group_type ?></td>
                                                                <td class="center"><?= $list->handover_to_client ?></td>
                                                                <td class="center">
                                                                    <?= (($list->number_persons ?: '0') + ($list->number_child ?: '0')) ?>
                                                                </td>
                                                                <td class="center"><?= $list->name ?></td>
                                                                <?php if ($this->session->userdata('email') != 'vishal@kazindmc.com') { ?>
                                                                    <td class="center"><?= $list->currency ?></td>
                                                                    <td class="center"><?= $list->client_billing ?></td>
                                                                    <td class="center"><?= (int)$list->payment_received_india + (int)$list->paymentreceived_india ?></td>
                                                                    <td class="center"><?= (int)$list->payment_received_almaty + (int)$list->paymentrecieved_in_other ?></td>
                                                                    <td class="center"><?= $list->balance_amount ?></td>
                                                                    <td class="center"><?= $remarks ?></td>
                                                                <?php } ?>
                                                                <td class="center">
                                                                    <a class="btn btn-xs" style="background-color: <?= $status_color[$status] ?>; color: #FFF;" href="#">
                                                                        <?= ucfirst($status) ?>
                                                                    </a>
                                                                    <?php if ($list->remarks !== '') {
                                                                        echo '<div class="remarks-hide"><span style="font-size: 9px; font-weight: bold;">Remarks..</span> <button class="btn btn-xs btn-primary btn-remarks-show">show</button></div>';
                                                                        echo '<div class="remarks-show" style="display:none;">' . $list->remarks . ' <button class="btn btn-xs btn-danger btn-remarks-hide">hide</button></div>';
                                                                    } ?>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>


                                    <?php if (!empty($this->input->get('submit'))) { ?>
                                        <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                            <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                            <?php echo $links; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page content -->
            </div>
            <!-- end page container -->
        </div>
    </div>
        <!-- end js include path -->
<script>
    var url = new URL(window.location.href);
    $(document).ready(function() {
        // if ($.fn.DataTable.isDataTable("#agent_report")) {
        //     $("#agent_report").DataTable().clear().destroy();
        // }

        $("#agent_report").DataTable({
            responsive: true,
            // paging: false
        });
        $("#agent_file_count").DataTable({
            responsive: true,
            paging: false,
            info: false,
        }); 
        $(".company").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('.company').val(ui.item.label); // display the selected text
                $('.company_id').val(ui.item.company_id); // save selected id to input
                get_agents();
            }
        }).blur(function(event) {
            if($('.company').val()==''){
                $('.company_id').val('');
            }               
        });
        
        if (url.searchParams.has('company_id')) {
            get_agents();                
        }
        
        function get_agents() {
            if ($(".company_id").val() === "") {
                $(".agent").empty();
                return false;
            }
            var id = $('.company_id').val();

            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>get-agent-ajax/' + id,
                dataType: 'json',
                success: function(response) {
                    responseData = response.details; // Store the response data
                    console.log(responseData)
                    $(".agent").empty().parent().addClass("is-dirty");
                    $('.agent').append('<option value="">Select..</option>');
                    $.each(response.details, function(i, agent) {
                        $('.agent').append('<option value="' + agent.company_id +
                            '">' + agent
                            .contact_person + '</option>');
                    });
                },
                complete:function(){ 
                    $('.agent').val(url.searchParams.get('agent')); 
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching agents:", errorThrown);
                }
            });
        }

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $(".country").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                    },
                    success: function(data) {

                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                if (terms.length > 2) {
                    $(".state").val("").attr('disabled', 'disabled');
                } else {
                    $(".state").removeAttr('disabled');
                    $('.country_id').val(ui.item.country_id);
                }
                return false;
            }
        });

        $(".state").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('.country_id').val()
                    },
                    success: function(data) {

                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection

                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                if (terms.length > 2) {
                    $(".city").val("").attr('disabled', 'disabled');
                } else {
                    $(".city").removeAttr('disabled');
                    $('.state_id').val(ui.item.state_id);
                }
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        });

        $(".city").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('.state_id').val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection

                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
        });
    });
</script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const statusSpans = document.querySelectorAll('.count-circle');

        statusSpans.forEach(function(span) {
            span.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                const agent = this.getAttribute('data-agent_id');
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('status', status);

                const country = urlParams.get('country') || '';
                const country_id = urlParams.get('country_id') || '';
                const state = urlParams.get('state') || '';
                const state_id = urlParams.get('state_id') || '';
                const city = urlParams.get('city') || '';
                const company = urlParams.get('company') || '';
                const company_id = urlParams.get('company_id') || '';
                const email = urlParams.get('email') || '';
                const mobile = urlParams.get('mobile') || '';

                // Construct the new URL
                const newUrl = `<?php echo base_url(); ?>agents-report?country=${country}&country_id=${country_id}&state=${state}&state_id=${state_id}&city=${city}&company=${company}&company_id=${company_id}&agent_id=${agent}&email=${email}&mobile=${mobile}&status=${status}&submit=Search`;
                window.open(newUrl, '_blank', 'noopener,noreferrer');
            });
        });
    });
</script>
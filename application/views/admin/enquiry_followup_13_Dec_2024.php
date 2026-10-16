<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<style>
		div.info>div {
        border: 1px solid #efecec;
    }
	</style>
</head>
<!-- END HEAD -->

<div class="modal fade" id="myModalquotation" role="dialog">
	<div class="modal-dialog modal-lg" style="max-width:1150px;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Make Quotation</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body ui-front">
				<div class="row">
					<div class="col-md-12">
						<div id="msgDiv"></div>
						<form method="post" id="frm_1" action="<?php echo base_url('quotation_create'); ?>">
							<div class="card-body">							
								<div class="row">
									<div class="col-lg-12 p-2">
										<div class="row info sbold text-center">
											<div class="offset-1  col-lg-2 p-1">
												<span>Quotation No.</span><br>
												<label class="qdata"></label>
											</div>                                                    
											<div class="col-lg-2 p-1">
												<span>Guests</span> <br>
												<label class="qdata"></label>
											</div>
											<div class="col-lg-2 p-1">
												<span>Check-in Date</span> <br>
												 <label class="qdata"></label>
											</div>
											<div class="col-lg-2 p-1">
												<span>Check-out Date</span> <br>
												<label class="qdata"></label>
											</div>
											<div class="col-lg-2 p-1">
												<span>Duration</span> <br>
												<label class="qdata"></label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row" id="quotation-make-1">
								
									<div class="col-lg-4" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
										<h4 class="m-b-20 thin">Hotel Details</h4>
										<label class="bold">With Hotel </label>
										<div>
											<label>
												<input type="radio" value="yes" name="hotel">
												Yes
											</label>
											<label>
												<input type="radio" value="no" name="hotel" checked>
												No
											</label>
										</div>
										<div id="hotel-details" style="display:none;">
											<label class="bold">Hotel Category</label>
											<div class="form-floating mb-3">
												<select class="form-control form-select" name="hotel_type">
													<option value="">Hotel Category</option>
													<option value="3 Star">3 Star</option>
													<option value="4 Star">4 Star</option>
													<option value="5 Star">5 Star</option>
													<option value="5 Star Luxury">5 Star Luxury</option>
												</select>
											</div>
											<!--label for="">
												Select Hotel
											</label>
											<div class="form-floating mb-3">
												<input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name">
											</div-->
											
											
											<div class="form-floating mb-3 child-age">
												
											</div>
										</div>
									</div>

									<div class="col-lg-4" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
										<h4 class="m-b-20 thin">Vehicle Selection</h4>                                                                 
																	   
										<label class="bold">Airport Pick and Drop</label>
										<div>
											<label>
												<input type="radio" name="choice-radio">
												Yes
											</label>
											<label>
												<input type="radio" name="choice-radio" checked>
												No
											</label>
										</div>
										
										<div class="row" style="border-top:3px solid #FFF;">	
											<div class="col-md-9 mt-2">
												<label class="bold">Suggessted Vehicles</label>
											</div>
											
											<div class="col-md-3 mt-2">
												<label class="bold">Quantity</label>
											</div>
										</div>
										
										<div class="row" id="suggessted_vehicles">	
											
										</div>
										<div class="row" style="border-top:3px solid #FFF;" id="add_vehicles">	
											<div class="col-md-9 mt-2">
												<label class="bold">Select Vehicles</label>
											</div>
											
											<div class="col-md-3 mt-2">
												<label class="bold">Quantity</label>
											</div>
										</div>
										<div class="row">	
											<div class="col-md-9">
												<div class="form-floating mb-3">
													<input type="text" class="form-control" id="search_transportation" placeholder="Search Vehicle">
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-floating mb-3">
													<input type="number" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity">												
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-4" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
										<h4 class="m-b-20 thin">Itinerary Details</h4>
																		
										<div class="form-floating mb-3">
											<label class="bold">Inside City </label>
											<input type="text" class="form-control require" id="" name="insidecity_count" placeholder="Enter Number">
										</div>
										<div class="form-floating mb-3">
											<label class="bold">Outside City </label>
											<input type="text" class="form-control require" id="" name="outsidecity_count" placeholder="Enter Number">
										</div>
																		
									</div>	
									<div class="col-lg-12 mt-4"> 
										<button type="button" class="btn btn-primary float-right hide" id="btn_hotel">Proceed <i class="fa fa-angle-double-right"></i></button>								
									</div>
							
								</div>
								
								<div class="row" id="quotation-make-2" style="display:none;">
								
									<div class="offset-4 col-md-4">
										<select class="form-control form-select" name="quotation_hotels">
											<option value="">Select Hotel</option>
										</select>
									</div>
									
									<div class="col-md-12 mt-4" id="hotel-categories" style="min-height: 100px;border: 1px solid #f1f1f1;border-radius: 9px;">
										<h4 class="text-center">Select hotel to get categories</h4>
									</div>
									
									<div class="col-lg-12 mt-4">
										<button type="button" class="btn btn-primary float-left" id="previous"> <i class="fa fa-angle-double-left"></i> Previous </button>
										
									</div>
								</div>
								
							</div>
							<div class="row">
									<div class="col-lg-12">
										<button type="submit" class="btn btn-primary float-right" id="create_quotation" formtarget="_blank">Create Quotation</button>
									</div>
								</div>
						</form>
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="icon-and-text-button-demo">
                                <a href="enquiry-followup" class="btn btn-info waves-effect" style="margin-left:5px;">
                                    <i class="material-icons">supervisor_account</i><br>
                                    <span>Queryboard</span>
                                </a>

                            </div>
                        </div>
                    </div>


                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Queryboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Queryboard</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Queryboard</header>
                                    <div class="tools"
                                        style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'block'; ?>">
                                        <a href="<?= base_url(); ?>enquiry" class="btn btn-success" style="padding:6px;"
                                            title="Add Query B2B">
                                            <i class="fa fa-plus"></i> Add (B2B)</a>
                                        <a href="<?= base_url(); ?>enquiry_b2c" class="btn btn-success"
                                            style="padding:6px;" title="Add Query B2C">
                                            <i class="fa fa-plus"></i> Add (B2C)</a>
                                        <?php if(($this->session->userdata('type') == 1)){ ?>    
                                        <a href="<?= base_url('enquiry-excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-primary"
                                            style="padding:6px;" title="Download Excel" target="_blank">
                                            <i class="fa fa-download"></i> Download Excel</a>
                                        <?php } ?>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Search</h4>
                                            </div>

                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="location" id="location" class="mdl-textfield__input"
                                                        style="padding: 10px;">
                                                        <option value=""></option>
                                                        <?php
                                                        asort($locations);
                                                        foreach ($locations as $key => $val) { //$val[]='All'; 
                                                            if ($this->session->userdata('locations') == $key || $this->session->userdata('locations') == 'all') {
                                                                ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="staff_id" id="staff_id" class="mdl-textfield__input"
                                                        style="padding: 10px;">
                                                        <option value=""></option>

                                                    </select>
                                                    <label class="mdl-textfield__label">Staff</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="booking_type" id="booking_type"
                                                        class="mdl-textfield__input" style="padding: 10px;">
                                                    </select>
                                                    <label class="mdl-textfield__label">Booking Type</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'from', 'placeholder' => '', 'id' => 'from', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">From</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'to', 'id' => 'to', 'placeholder' => '', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">To</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="followup_status" id="followup_status" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value=""></option>
                                                        <option value="pending">Pending</option>
                                                        <option value="in-progress">In-progress</option>
                                                        <option value="confirm">Confirm</option>
                                                        <option value="cancel-at-arrival">Cancel At Arrival</option>
                                                        <option value="not-materialized">Not materialized</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Status</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'company', 'id' => 'company', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('company'))]); ?>
                                                    <label class="mdl-textfield__label">Company</label>
                                                </div>
                                                <input type="hidden" name="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                            </div>

                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'mdl-textfield__input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                                    <label class="mdl-textfield__label">Query Number</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                                    <label class="mdl-textfield__label">Select Country</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country_id" id="country_id" value="<?=$this->input->get('country_id')?>">
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('state'))]) ?>
                                                    <label class="mdl-textfield__label">State</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state_id" id="state_id" value="<?=$this->input->get('state_id')?>">

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('city'))]) ?>
                                                    <label class="mdl-textfield__label">City</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'value' => 'Search']); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-scrollable">

                                        <div class="row mb-3 prog-4">
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-black"><?php echo (isset($counts['pending']) ? $counts['pending'] : '0'); ?></span>
                                                Pending
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-perp"><?php echo (isset($counts['in-progress']) ? $counts['in-progress'] : '0'); ?></span>
                                                In-Progress
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-green"><?php echo (isset($counts['confirm']) ? $counts['confirm'] : '0'); ?></span>
                                                Confirm
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-orange"><?php echo (isset($counts['not-materialized']) ? $counts['not-materialized'] : '0'); ?></span>
                                                Not Materialized
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-danger"><?php echo (isset($counts['cancel-at-arrival']) ? $counts['cancel-at-arrival'] : '0'); ?></span>
                                                Cancel At Arrival
                                            </div>
                                        </div>

                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No.</th>
                                                    <th class="center">Query Received Date</th>
                                                    <th class="center">Query Entry Date/Time</th>
                                                    <th class="center">Query Number</th>
                                                    <th class="center">Handling File By</th>
                                                    <th class="center">Check-in</th>
                                                    <th class="center">Check-out</th>
                                                    <th class="center">Number Of Guests</th>
                                                    <th class="center">Agent Name</th>
                                                    <th class="center">Company</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($enquiry)) {
                                                    $i = $offset + 1;
                                                    foreach ($enquiry as $enquiries) {
                                                        
                                                        $where = ' arrival_room_details.enquiry_id = '.$enquiries->id;
                                                        $room_details = $this->common_model->get_data('arrival_room_details', '', '', '*', $where, '', $count = false);
                                                        $total_persons_accomodated = 0;
                                                        $actual_total = $enquiries->number_persons + $enquiries->number_child;
                                                        if(!empty($room_details)){
                                                            foreach($room_details AS $list){
                                                                $total_persons_accomodated = $total_persons_accomodated + ($list->number_adults * $list->number_of_rooms + $list->number_child * $list->number_of_rooms);
                                                            }
                                                        }else{
                                                            $total_persons_accomodated = $actual_total;
                                                        }
                                                        
                                                        
                                                        $records_cnt++;
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->query_received_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php 
                                                                $d = explode(' ',$enquiries->date);
                                                                if($d[1] == '00:00:00'){
                                                                    echo date('d-M-Y', strtotime($enquiries->date));
                                                                }else {
                                                                    echo date('d-M-Y (h:i a)', strtotime($enquiries->date));
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo $enquiries->enquiry_no;
                                                                        if($enquiries->split_count > 0){
                                                                            echo ' <span class="badge bg-info" style="text-transform:capitalize;"> Split '.($enquiries->split_number+1).'</span>';
                                                                        }
                                                                ?>
                                                                <?php if(in_array($enquiries->follow_status,['pending','in-progress']) && in_array($this->session->userdata('id'),[14,13])){ 
																		$data_arr = ['qno'=>$enquiries->enquiry_no,
																					'adult_child'=>($enquiries->number_child+$enquiries->number_persons).' ('.$enquiries->number_persons.'A+'.$enquiries->number_child.'C)',
																					'checkin'=>$enquiries->check_in_date,'checkout'=>$enquiries->check_out_date,'nights'=>$enquiries->number_of_nights,'child'=>$enquiries->number_child];
																?>
                                                                    <br><button data-attr='<?=json_encode($data_arr);?>' id="<?=base64_encode($enquiries->id) ?>" class="btn btn-link quotation" title="Make Quotation" style="padding:0 2px;font-size:10px;text-transform:capitalize;">Quotation</button>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="center"><?= $enquiries->staff_name ?></td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->check_in_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->check_out_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= $enquiries->number_persons . ' (A) , ' . $enquiries->number_child . ' (C)' ?>
                                                            </td>
                                                            <td class="center"><?= $enquiries->contact_person ?></td>
                                                            <td class="center"><?= $enquiries->name ?></td>
                                                            <td class="center"><?= $enquiries->city ?></td>
                                                            <td class="center">
                                                                <?php
                                                                $status_color = ['pending' => '#000000', 'in-progress' => '#8795fb', 'confirm' => '#18ce0f', 'not-materialized' => '#f96332', 'cancel-at-arrival' => 'red'];
                                                                $status = $enquiries->follow_status;
                                                                //if(isset($arr[0]) && $arr[0]==''){ $status = 'pending'; }else{ $status = $arr[0]; }  ?>
                                                                <a class="btn btn-xs"
                                                                    style="background-color: <?= $status_color[$status] ?>;color:#FFF;"
                                                                    href="<?= base_url() . $enquiries->id . '/'; ?>followup"><?= ucfirst(str_replace('-', ' ', $status)) ?></a>

                                                            </td>

                                                            <td style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'flex'; ?>;">
                                                                <?php if ($status == 'confirm') {
                                                                    $url = base_url('add_arrival?enq_id=' . base64_encode($enquiries->id));
                                                                    $title = 'Add To Arrival Chart';
                                                                    $style = '';
                                                                    if ($enquiries->arrival_id <> '') {
                                                                        $url = base_url('edit_arrival?id=' . base64_encode($enquiries->arrival_id));
                                                                        $title = 'Edit Arrival Chart';
                                                                        $style = 'background-color:#ff8b47;';
                                                                    }
                                                                    ?>
                                                                    <a href="<?= $url ?>" class="btn btn-tbl-edit btn-xs"
                                                                        title="<?= $title ?>" style="<?= $style ?>"><i
                                                                            class="fa fa-plane"></i></a>
                                                                            
                                                                    <?php if($actual_total - $total_persons_accomodated > 0){ 
                                                                            $split_count = $enquiries->split_count + 1;
                                                                    ?>                                                                        
                                                                        <a href="<?= base_url('add_arrival?enq_id=' . base64_encode($enquiries->id).'&split='.base64_encode($split_count)); ?>" class="badge mt-1 mr-1" title="Split" style="color:#FFF;text-transform: none;"><i class="fa fa-plane"></i> Split</a>                                                                            
                                                                    <?php }} ?>
                                                                    <a href="<?= base_url() . $enquiries->id ?>/edit-enquiry"
                                                                        class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                            class="fa fa-edit"></i></a>
                                                                    <?php if ($this->session->userdata('type') == 1) { ?>
                                                                        <a href="<?= base_url() . $enquiries->id ?>/delete-enquiry"
                                                                            onclick="return confirm('Are you sure you want to delete this Enquiry?');"
                                                                            class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                                class="fa fa-trash-o"></i></a>
                                                                    <?php } ?>
                                                                    
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                    <?php echo $links; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- end js include path -->
    <script>
        url = new URL(window.location.href);
        $(document).ready(function () {
            $("#location").on("change", function () {
                var v = $(this).find(':selected').attr('data-abbr');
                var selected;
                $("#booking_type").empty().parent().removeClass("is-dirty");
                if (v !== "" && v !== undefined) {
                    var opts = v.split(",");
                    $("#booking_type").parent().addClass("is-dirty");
                    $.each(opts, function (i, d) {
                        selected = (url.searchParams.get('booking_type')==d)?'selected="selected"':'';
                        $('#booking_type').append('<option value="' + d + '"'+selected+'>' + d + '</option>');
                    });
                    selected = (url.searchParams.get('booking_type')=="all")?'selected="selected"':'';
                    $('#booking_type').append('<option value="all" '+selected+'>All</option>');
                    get_staff();
                }
            });
            
            if (url.searchParams.has('location')) {
                $("#location").trigger("change");               
            }
            if (url.searchParams.has('followup_status')) {
                $("#followup_status").val(url.searchParams.get('followup_status'));               
            }
            /*$("#from").on("change",function(){
                var el = $(this);
                const selectedDate = new Date(el.val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
                $("#dt-from").val(formattedDate).parent().addClass('is-focused');
            });*/

            $(".dt-search").on("change", function () {
                var idx = $(this).index(".dt-search");
                const selectedDate = new Date($(".dt-search").eq(idx).val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                };
                const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
                $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

                if ($(this).attr("id") === "from" && $("#to").val() === "") {
                    $("#to").attr("min", $(this).val());
                } else if ($(this).attr("id") === "from" && $("#to").val() !== "") {
                    const selectedToDate = new Date($("#to").val());
                    if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                        $("#to").val('').attr("min", $(this).val());
                        $(".dt-search-show").eq($("#to").index(".dt-search")).val('');
                    }
                }
                if ($(this).attr("id") === "to" && $("#from").val() === "") {
                    $("#from").attr("max", $(this).val());
                } else if ($(this).attr("id") === "to" && $("#from").val() !== "") {
                    const selectedFromDate = new Date($("#from").val());
                    if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                        $("#from").val('').attr("max", $(this).val());
                        $(".dt-search-show").eq($("#from").index(".dt-search")).val('');
                    }
                }

            });


        });

        function get_staff() {
            if ($("#location").val() === "") {
                $("#staff_id").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/enquiry/get_staff",
                data: {
                    'location': $("#location").val()
                },
                dataType: "JSON",
                success: function (data) {
                    $("#staff_id").empty().parent().addClass("is-dirty");
                    var opts = data.details;
                    $.each(opts, function (i, d) {
                        $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] +
                            '</option>');
                    });
                    $('#staff_id').append('<option value="all">All</option>');
                },
                complete:function(){
                    $('#staff_id').val(url.searchParams.get('staff_id'));
                },
                error: function (jqXHR, textStatus, errorThrown) { }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#company").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {
                            response(data);
                            dt = data;
                            $(".err").html('');;
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#company').val(ui.item.label); // display the selected text
                    $('#company_id').val(ui.item.company_id); // save selected id to input
                }
            }).blur(function(event) {
                if($('#company').val()==''){
                    $('#company_id').val('');
                }               
            });
            var country_flag = false;
            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                    country_flag = false;
                },
                select: function (event, ui) {
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input
                    country_flag = true;
                    return false;
                }
            }).blur(function(event) {
                if(country_flag==false){
                    $("#country").val("");
                }               
            });

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }
            var state_flag = false;
            $("#state").autocomplete({
                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            country_id: $('#country_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                    state_flag = false;
                },
                select: function (event, ui) {
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
                        $("#city").val("").attr('disabled', 'disabled');
                    } else {
                        $("#city").removeAttr('disabled');
                        $('#state_id').val(ui.item.state_id);
                    } state_flag = true;
                    return false;

                    //$('#state').val(ui.item.label); // display the selected text
                    //$('#state_id').val(ui.item.state_id); // save selected id to input
                    //return false;
                }
            }).blur(function(event) {
                if(state_flag==false){
                     $("#state").val("");
                }               
            });
            
            var city_flag = false;
            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            state_id: $('#state_id').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                    city_flag = false;
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    city_flag = true;
                    return false;

                    //$('#city').val(ui.item.label); // display the selected text
                    //$('#company_id').val(ui.item.company_id); // save selected id to input
                    //return false;
                }
            }).blur(function(event) {
                if(city_flag==false){
                     $("#city").val("");
                }               
            });
			
			// 11 Dec 2024
			var option_html = '';
			var qdata = '';
			$(".quotation").on("click",function(){
				$("#myModalquotation").modal("show");
				qdata = JSON.parse($(this).attr("data-attr"));
				var i = 0;
				$.each(qdata,function(index,val){
					$(".qdata").eq(i).text(val);
					i++;
				});				
				option_html = '';
				for(var i=1;i<=qdata.child;i++){ 
					option_html += '<div class="mt-3 bold">Child  Age '+i+' : <select name="child_age[]" class="form-control">';
					option_html += '<option value="">Select..</option>';
					for(var age=1;age<=12;age++){
						option_html += '<option value="'+age+'">'+age+'</option>';
					}
					option_html += '</select></div>';	
				}
				$(".child-age").html("");
				$("#hotel-details").css("display","none");
				$("#frm_1")[0].reset();
				$("#hotel-categories").html("").html('<h4 class="text-center">Select hotel to get categories</h4>');
				var html='';
				$.ajax({
                    url: "<?php echo site_url('admin/quotation/vehicles_suggesstions'); ?>",
                    type: "post",
                    data: {'capacity': parseInt(qdata.adult_child.split(" ")[0]),'enquiry_num':qdata.qno },
                    dataType: 'JSON',
                    //contentType: false,
                    //processData: false,
                    success: function(data) {
                        if (data.response === "s") {                            
                            if(data.details.transportation.length>0){
                                $.each(data.details.transportation, function(i, val) {
									html += '<div class="col-md-9" style="padding:8px 16px;">';
									html += '<span class=""><input type="checkbox" name="chk_vehicle[]" value="'+val.id+'"> <label for=""> '+val.vehicle_name+'</label>';
									html += '</span></div>';
									html += '<div class="col-md-3">';
									html += '<div class="form-floating mb-3">';
									html += '<input type="number" name="vehicle_quantity[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity"></div></div>';
								});                                
                            }else { 
                                html = 'No Prices Found';
                            }
                            $("#suggessted_vehicles").html(html);
                        } 
                    }
                });
			});
			$("[name=hotel]").on("click",function(){
				($(this).val()=='yes')?$("#hotel-details").fadeIn(1000):$("#hotel-details").fadeOut(1000);
				$(".child-age").html("").html(option_html);
				if($(this).val()=='yes'){
					$("#create_quotation").fadeOut(1000);
					$("#btn_hotel").removeClass("hide").fadeIn(1000);
				}else{
					$("#create_quotation").fadeIn(1000);
					$("#btn_hotel").fadeOut(1000);
				}
			});
			
			$("#search_transportation").autocomplete({
				source: function(request, response) {
					// Fetch data
					$.ajax({
						url: "<?= base_url() ?>admin/arrivalchart/transportation_name_suggesstion",
						type: 'post',
						dataType: "json",
						data: {
							search: request.term,
							'location': qdata.qno
						},
						success: function(data) {
							response(data);
							dt = data;
						}
					});
				},
				select: function(event, ui) {
					var html = '';
					html += '<div class="col-md-9" style="padding:8px 16px;">';
					html += '<span class=""><input type="checkbox" name="chk_vehicle[]" value="'+ui.item.t_id+'"> <label for=""> '+ui.item.label+'</label>';
					html += '</span></div>';
					html += '<div class="col-md-3">';
					html += '<div class="form-floating mb-3">';
					html += '<input type="number" name="vehicle_quantity[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity"></div></div>';
					$("#add_vehicles").append(html);
				}
			});
			
			$("[name=quotation_hotels]").on("change",function(){                
                var html = '';
                var category_arr = [];
                var hotel_id = $('[name="quotation_hotels"] option:selected').val();
				if(hotel_id == ""){
					$("#hotel-categories").html("").html('<h4 class="text-center">Select hotel to get categories</h4>');
					return false;
				}
				$.ajax({
                    url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                    type: "post",
                    data: {'hotel_id':hotel_id,'check_in':qdata.checkin,'check_out':qdata.checkout},
                    dataType: 'JSON',
                    //contentType: false,
                    //processData: false,
                    success: function(data) {
                        if (data.response === "s") {                            
                            if(data.details.result.length>0){
                                //$(".hotel-name").html(data.details.result[0].name);
                                $.each(data.details.result, function(i, val) {
                                    var hotel_prices = chk_persons = is_chk = '';                                    
                                    html += '<div class="row p-2 mt-2" style="border-bottom:1px solid #e9e9e9;">';
                                    html += '<div class="col-md-8"><label class="bold"><input type="checkbox" id="chk_'+val.id+'" value="'+val.id+'_'+val.category_name+'" name="category_ids[]"> '+val.category_name+'</label></div><div class="col-md-1" style="margin:inherit;">Rooms</div><div class="col-md-1"><button type="button" data-id="'+val.id+'" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></div>';
                                    html += '<div class="col-md-12 row prices-div-'+val.id+'" id="prices-div_'+val.id+'"><div style="background-color: #eeeff1;" class="col-md-6 mb-1"><div class="row" style="height:10px;">';
                                    hotel_prices = val.details.split(",");
                                    $.each(hotel_prices, function(i, v) {
                                        /*chk_persons = v.split(" ");
                                        is_chk = '';
                                        if(chk_persons[0] == $("#adults_number").val() || chk_persons[0] == $("#child_number").val()){ 
                                            is_chk = 'checked="checked"'; 
                                            category_arr.push("chk_"+val.id);
                                        }*/
                                        html += '<div class="col-md-1 p-2"><input type="checkbox" class="chk-prices" data-id="'+val.id+'" value="'+v+'" name="'+val.id+'_hotel_prices[0][]"> <label>'+v.split(" ")[0]+'</label></div>';
                                    });
                                    html += '</div></div><div class="col-md-1"><input type="number" min="1" class="form-control" value="1" name="'+val.id+'_room_cnt[0]"></div></div><div class="col-md-1"></div></div>';
                                }); 
								$("#hotel-categories").html("").html(html);								
                            }else { 
                                $("#hotel-categories").html("").html('<h4 class="text-center">Select hotel to get categories</h4>');
                            }
                            
                            /*if(category_arr.length > 0){
                                $.each(category_arr, function(i, v) {
                                    $("#"+v).attr("checked","checked");
                                });
                            }*/
                        } 
                    }
                });
            });
			
			$("#btn_hotel").on("click",function(){
				event.preventDefault();
				for(var i=0;i<$(".require").length;i++){				
					var ele = $('.require:eq('+i+')');
					ele.css("border","");
					if (ele.is("input") && ele.val()=="") { 
						ele.css("border","1px solid red").focus();
						return false;
					}				
				}
				
				$("#quotation-make-1").css("display","none");
				$("#quotation-make-2").css("display","block");
				$("#hotel-categories").html("").html('<h4 class="text-center">Select hotel to get categories</h4>');
				var html='';
				$.ajax({
                    url: "<?php echo site_url('admin/quotation/get_hotels'); ?>",
                    type: "post",
                    data: {'type': $('[name=hotel_type] option:selected').val(),'enquiry_num':qdata.qno },
                    dataType: 'JSON',
                    //contentType: false,
                    //processData: false,
                    success: function(data) {
                        if (data.response === "s") {
							$("[name='quotation_hotels']").empty().append('<option value="">Select Hotel</option>');
                            if(data.details.hotel_min_price){
                                $.each(data.details.hotel_min_price, function(i, val) {
									$("[name='quotation_hotels']").append('<option value="'+val.id+'">'+val.name+'</option>');
								});
								$.each(data.details.hotel_max_price, function(i, val) {
									$("[name='quotation_hotels']").append('<option value="'+val.id+'">'+val.name+'</option>');
								});
                            }else { 
                                
                            }
                        } 
                    }
                });
				
				
			});
			
			$("#previous").on("click",function(){
				$("#quotation-make-1").toggle();
				$("#quotation-make-2").toggle();
				$("#create_quotation").fadeOut(1000);
			});
			
			$("#frm_1").on("click",".chk-prices",function(){
                var category_id = $(this).attr("data-id");
				var flag = false;
                $("#chk_"+category_id).attr("checked",false);
                $("input[name='"+category_id+"_hotel_prices[0][]']").each(function (index, obj) {
                    if(this.checked){ $("#chk_"+category_id).attr("checked","checked"); flag = true; }
                });
				if(flag == true) { 
					$("#create_quotation").fadeIn(1000); 
				}else{ $("#create_quotation").fadeOut(1000); }
            });
			
			$("#frm_1").on("click",".add",function(){
                event.preventDefault();
                var idx = $(this).index(".add");
                var id = $(".add").eq(idx).attr("data-id");
                var x = Math.floor((Math.random() * 10000) + 1);
                var h = $("#prices-div_" + id).clone().attr('id', 'prices-div_' + x);
                h.find('input:checkbox').prop('checked',false);
                h.find("input:checkbox").prop("name",id+"_hotel_prices["+x+"][]");
                h.find("input[type='number']").prop("name",id+"_room_cnt["+x+"]");
                h.append(
                    '<div class="col-md-1"><i title="Remove" class="fa fa-remove div_remove" style="color:red;cursor: pointer;margin-top: -15px;position:relative;"></i></div>'
                );                
                //h.insertAfter($("#prices-div_" + id));
                var l = $(".prices-div-"+ id).length;
                h.insertAfter($(".prices-div-"+ id).eq(l-1));
            });
			
        });
    </script>
</body>

</html>
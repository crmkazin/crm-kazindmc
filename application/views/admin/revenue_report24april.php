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
        .dataTables_scrollHeadInner{
            width:auto !important;
        }
    </style>
</head>
<!-- END HEAD -->

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
                    <?php include ('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Sales Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Sales Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php if($this->session->flashdata('message')<>''){ echo $this->session->flashdata('message'); } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Sales Report</header>
                                    <div class="float-right hide">                                        
                                        <a href="<?php echo base_url('revenue-excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                </div>
                                <form method="get" id="frm_search">
                                    <div class="card-body row">
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">All</option>
                                                    <?php
                                                    asort($locations);													
													foreach ($locations as $key => $val) { 
													if($key!='all'){ 
													?>
                                                    <option value="<?= $key ?>" <?php echo (trim($this->input->get('location')==$key))?'selected="selected"':''; ?> <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                        <?= ucfirst($key) ?>
                                                    </option>
                                                    <?php }} ?>
                                                </select>
                                                <label class="mdl-textfield__label">Location</label>
                                            </div>
                                        </div>
                                        
										<div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input', 'value' => ($this->input->get('company')<>'')?urldecode($this->input->get('company')):'']) ?>
                                                <label class="mdl-textfield__label">Company</label><?php echo form_error('company'); ?>
                                            </div>
                                            <input type="hidden" name="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                        </div>
										
										<div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="agent" id="agent" class="mdl-textfield__input" style="padding:8px;">
                                                </select>
                                                <label class="mdl-textfield__label">Select Agent</label>
                                            </div>
                                        </div>
										
										<div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="sales" id="sales" class="mdl-textfield__input">
                                                    <option value="">All</option>
                                                    <?php foreach($sales_team AS $list){  ?>
                                                        <option value="<?php echo $list->id; ?>" <?php echo ($this->input->get('sales')<>'' && $this->input->get('sales')==$list->id)?'selected="selected"':''; ?>><?php echo $list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label class="mdl-textfield__label">Kazin Sales Team</label>
                                            </div>
                                        </div>
										
										<div class="col-lg-3 p-t-20">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
												<select name="quarter" id="quarter" class="mdl-textfield__input" style="padding: 10px;">
													<option value="">Select Quarter..</option>
													<?php
													$current_year = date('Y');
													$quarters = ['quarter_1'=>$current_year.'-01-01_'.$current_year.'-03-31',
																'quarter_2'=>$current_year.'-04-01_'.$current_year.'-06-30',
																'quarter_3'=>$current_year.'-07-01_'.$current_year.'-09-30',
																'quarter_4'=>$current_year.'-10-01_'.$current_year.'-12-31'];
																
													foreach ($quarters as $key => $val) {
														 ?>
														<option value="<?= $val ?>" <?=($this->input->get('quarter')<>'' && $this->input->get('quarter')==$val)?'selected="selected"':''; ?>>
															<?= ucfirst(str_replace('_',' ',$key)).' ('.$current_year.')' ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										
                                        <div class="col-lg-3 p-t-20">
                                            <!--div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_from')]) ?>
                                                <label class="mdl-textfield__label">From
                                                </label><?php //echo form_error('date_from'); ?>
                                            </div-->
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:90%;"
													value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:20px;float:right;']) ?>
												<label class="mdl-textfield__label">From</label>
											</div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <!--div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_to')]) ?>
                                                <label class="mdl-textfield__label">To
                                                </label><?php //echo form_error('date_to'); ?>
                                            </div-->
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:90%;"
													value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:20px;float:right;']) ?>
												<label class="mdl-textfield__label">To</label>
											</div>
											
                                        </div>
                                        
                                        <div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="status" id="status" class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="">All</option>
                                                    <option value="in-progress"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>
                                                        In-progress</option>
                                                    <option value="complete"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='complete')?'selected="selected"':''; ?>>
                                                        Complete</option>
                                                    <option value="cancel"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel')?'selected="selected"':''; ?>>
                                                        Cancel</option>
                                                    <option value="file-closed"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>
                                                        File Closed</option>
                                                </select>
                                                <label class="mdl-textfield__label">Status</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
									<div class="card-body row">
									<div class="col-lg-12" style="background-color:#f6f6f6;">
                                        <label style="color:#b9b9b9;" class="mt-2">Region Wise</label>
                                    </div>
										<div class="col-lg-3 p-t-20">
											<div
												class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

												<?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input','value'=>$this->input->get('country')]) ?>
												<label class="mdl-textfield__label">Select Country</label>
											</div>
										</div>
										<input type="hidden" name="country_id" id="country_id" value="">
										<div class="col-lg-3 p-t-20">
											<div
												class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

												<?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>$this->input->get('state')]) ?>
												<label class="mdl-textfield__label">State</label>
											</div>
										</div>
										<input type="hidden" name="state_id" id="state_id" value="">

										<div class="col-lg-3 p-t-20">
											<div
												class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

												<?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>$this->input->get('city')]) ?>
												<label class="mdl-textfield__label">City</label>
											</div>
										</div>
										<div class="col-lg-3 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            <a href="revenue-report" class="btn btn-md btn-danger" style="float:left;margin-left:5px;">Clear</a>
                                        </div>
									</div>
                                </form>
								<?php if(isset($total_sales)){ ?>
								<div class="card-body" style="background-color:#f3f3f3;">
									<div class="row">
                                        <div class="col-md-3"><strong>Total Payment In Dollars : </strong><?php echo number_format($total_sales->final_total_dollar); ?></div>
										<!--div class="col-md-3"><strong>Total Payment In Rupees : </strong><?php //echo number_format($total_sales->final_total_inr); ?></div-->
									</div>
								</div>
								<?php } ?>
                                <div class="card-body">
                                    
                                    <div class="table-scrollable">
                                    <a class="btn btn-primary mb-2" style="padding:4px 8px;float:right;" href="<?php echo base_url('revenue-report?excel_download=1&submit=submit&'.$this->input->SERVER('QUERY_STRING')); ?>" target="_blank"><i class="fa fa-download"></i> Excel</a>
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Company Name</strong></th>
													<th class="center"><strong>Pax Count</strong></th>
                                                    <th class="center"><strong>Total Billing In Dollars</strong><?php if($this->input->get('status')<>''){ ?>
                                                            <span class="btn-link" style="text-decoration:none;">(<?=ucfirst($this->input->get('status')); ?>)</span>
                                                            <?php } ?></th>
													<th class="center">
                                                        <strong>Total Files
                                                            <?php if($this->input->get('status')<>''){ ?>
                                                            <span class="btn-link" style="text-decoration:none;">(<?=ucfirst($this->input->get('status')); ?>)</span>
                                                            <?php } ?>
                                                        </strong>
                                                    </th>
                                                    <th class="center"><strong>All Files</strong></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($revenue_report)) {
                                                    $i = $offset + 1;
                                                    foreach ($revenue_report as $list) {
                                                        $records_cnt++;
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center"><?php echo ($list->name=='')?'<strong>B2C Sales</strong>':$list->name; ?></td>
													<td class="center"><?= $list->num_persons ?></td>
                                                    <td class="center"><?= ($list->total_billing_dollar<>'')?$list->total_billing_dollar:'0'; ?></td>
		         									<td class="center">
                                                        <button class="btn btn-sm btn-link files" data-status="<?php echo ($this->input->get('status')<>'' )?$this->input->get('status'):''; ?>" data-company-name="<?=$list->name ?>" data-company-id="<?=$list->company_id ?>" title="View Files" style="padding:5px;"><?= $list->file_cnt ?> <i class="fa fa-file"></i></button>
                                                    </td>
                                                    <td class="center">
                                                        <button class="btn btn-sm btn-link files" data-status="" data-company-name="<?=$list->name ?>" data-company-id="<?=$list->company_id ?>" title="View Files" style="padding:5px;"><i class="fa fa-file"></i></button>
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
        
        <div class="modal fade" id="myModal" role="dialog" >
            <div class="modal-dialog modal-lg" style="max-width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="bold company-name"></h4>&nbsp;
                    <div class="btn btn-sm btn-link p-3">
                        <div class="" style="font-size:13px;">
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a id="export_to_excel">Export to excel</a>
                        </div>
                    </div>
                    <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body ui-front">
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width file-detail-table"
                                id="example4">
                                <thead>
                                    <tr>
                                        <th class="center">Sr.No</th>
                                        <th class="center">Enquiry No.</th>
                                        <th class="center">Checkin Date</th>
                                        <th class="center">Checkout Date</th>
                                        <th class="center">Agent Name</th>
                                        <th class="center">Client Billing</th>
                                        <th class="center">Balance Amount</th>
                                        <th class="center">Arrival's File Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table body content -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->

    <!-- suggesstion Script -->
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#location").on("change", function() {
            var v = $(this).val();
            $("#hotel").empty().parent().removeClass("is-dirty");
             $.ajax({
				type: "POST",
				url: "<?=base_url('get_hotels');?>",
				data: {
					'location': v
				},
				dataType: "JSON",
				success: function(data) {
					var opts = data.details;
					$('#hotel').append('<option value="">Select..</option>');
					$.each(opts, function(i, d) {
						$('#hotel').append('<option value="' + d.id + '">' + d.name + '</option>');
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
            
        });
        
        url = new URL(window.location.href);
        if (url.searchParams.has('company_id')) {
            get_agents();                
        }
        
		$("#company").autocomplete({
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
                $('#company').val(ui.item.label); // display the selected text
                $('#company_id').val(ui.item.company_id); // save selected id to input
                get_agents();                
            }
        }).blur(function(event) {
            if($('#company').val()==''){
                $('#company_id').val('');
            }               
        });
		
		
        $("#country").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {

                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#country').val(ui.item.label); // display the selected text
                $('#country_id').val(ui.item.country_id); // save selected id to input

                return false;
            }
        });

        function split( val ) {
            return val.split( /,\s*/ );
        }        
        function extractLast( term ) {
            return split( term ).pop();
        }
        $("#state").autocomplete({
            source: function(request, response) {
                if($('#country').val() == "" || $('#country_id').val() == ""){ return false; }
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('#country_id').val()
                    },
                    success: function(data) {

                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection

                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                if(terms.length > 2){
                    $("#city").val("").attr('disabled','disabled');
                }else { $("#city").removeAttr('disabled');$('#state_id').val(ui.item.state_id); }
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        });

        $("#city").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('#state_id').val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection

                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );                
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
        });
		
        $(".files").on("click",function(){
            var idx = $(this).index(".files");
            var c_id = $(".files").eq(idx).attr("data-company-id");
            $(".company-name").html($(".files").eq(idx).attr("data-company-name"));
            var st = $(".files").eq(idx).attr("data-status");
            if ($.fn.DataTable.isDataTable('#example4')) {
                $('#example4').DataTable().clear().destroy();
            }
            const urlParams = new URLSearchParams(window.location.search);
            
            $.ajax({
                url: "<?php echo site_url('admin/report/get_files?'); ?>",
                type: "post",
                data: {'c_id':c_id,'date_from':urlParams.get('date_from'),'date_to':urlParams.get('date_to'),'agent':urlParams.get('agent'),'sales':urlParams.get('sales'),'country':urlParams.get('country'),'state':urlParams.get('state'),'city':urlParams.get('city'),'status':st,
                        'location':urlParams.get('location')
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function () { },
                success: function (res) {
                    if (res.response === "s") {
                        var tableBody = $('.file-detail-table tbody');
                        tableBody.empty();
                        const options = {
                                year: 'numeric',
                                month: 'short',
                                day: '2-digit'
                            };
                        var split = '';
                        $.each(res.details, function(index, item) {
                            // Construct the table row
                            const selectedDate_checkin = new Date(item.check_in_date);
                            const selectedDate_checkout = new Date(item.check_out_date);
                            split = '';
                            if(item.split_number != 0){
                                split = " (Split-"+item.split_number+")";
                            }
                            var row = '<tr>' +
                                '<td class="center">' + ++index + '</td>' + 
                                '<td class="center">' + item.enquiry_no + split +'</td>' +
                                '<td class="center">' + selectedDate_checkin.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + selectedDate_checkout.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + item.contact_person + '</td>' + 
                                '<td class="center">' + item.client_billing + '</td>' + 
                                '<td class="center">' + item.balance_amount + '</td>' + 
                                '<td class="center">' + item.arrivals_status.toUpperCase().replace(/[\-\.]/g, " ") + '</td>' +
                                '</tr>';

                            // Append the row to the table body
                            tableBody.append(row);
                        });
                        $("#myModal").modal("toggle");
                        $('#example4').DataTable({
                            "scrollX": true,
                            "scrollY": true,
                            "pageLength": 10
                        });
                        
                    }
                }
            });
        });
        
		$("#export_to_excel").on("click",function(){
            $('<table>').append($('#example4 thead').clone()).append($('#example4').DataTable().$('tr').clone()).table2excel({
                sheetName: 'Sales Report',
                filename: ($(".company-name").html()+"-Sales_Report_" + new Date().toLocaleDateString('en-IN',{year: 'numeric',month: 'short',day: '2-digit'})).replace(/[\ \.]/g, "_"),
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: true
            });
        });
        
        $('.close-modal').on('click', function() {
           // Destroy existing DataTable instance if it exists
           if ($.fn.DataTable.isDataTable('#example4')) {
                $('#example4').DataTable().clear().destroy();
            }
        });
		
		$("#quarter").on("change",function(){
            if($("#quarter").val()!="") $(".dts, .dt-search-show").val('');
        });
        $(".dts").on("change",function(){
            if($(".dts").eq(0).val()!="") $("#quarter").val('');
        });
        
		$(".dt-search").on("change", function () {
			var idx = $(this).index(".dt-search");
			const selectedDate = new Date($(".dt-search").eq(idx).val());
			if(selectedDate == "Invalid Date"){ selectedDate = new Date(); }
			//const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
			const options = {
				year: 'numeric',
				month: 'short',
				day: '2-digit'
			};
			const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
			$(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

			if ($(this).attr("id") === "date_from" && $("#date_to").val() === "") {
				$("#date_to").attr("min", $(this).val());
			} else if ($(this).attr("id") === "date_from" && $("#date_to").val() !== "") {
				const selectedToDate = new Date($("#date_to").val());
				if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
					$("#date_to").val('').attr("min", $(this).val());
					$(".dt-search-show").eq($("#date_to").index(".dt-search")).val('');
				}
			}
			if ($(this).attr("id") === "date_to" && $("#date_from").val() === "") {
				$("#date_from").attr("max", $(this).val());
			} else if ($(this).attr("id") === "date_to" && $("#date_from").val() !== "") {
				const selectedFromDate = new Date($("#date_from").val());
				if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
					$("#date_from").val('').attr("max", $(this).val());
					$(".dt-search-show").eq($("#date_from").index(".dt-search")).val('');
				}
			}

		});
		
    });
	function get_agents() {
        if ($("#company_id").val() === "") {
            $("#agent").empty();
            return false;
        }
        var id = $('#company_id').val();

        $.ajax({
            type: "POST",
            url: '<?= base_url(); ?>get-agent-ajax/' + id,
            dataType: 'json',
            success: function(response) {
                responseData = response.details; // Store the response data
                $("#agent").empty().parent().addClass("is-dirty");
                $('#agent').append('<option value="">All</option>');
                $.each(response.details, function(i, agent) {
                    $('#agent').append('<option value="' + agent.company_id +
                        '">' + agent
                        .contact_person + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching agents:", errorThrown);
            },
            complete: function(){
                $('#agent').val(url.searchParams.get('agent')); 
            },
        });
    }
</script>

</body>

</html>
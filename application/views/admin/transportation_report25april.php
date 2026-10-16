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
                                <div class="page-title">Transportation Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Transportation Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php if($this->session->flashdata('message')<>''){ echo $this->session->flashdata('message'); } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Transportation Report</header>
                                    <div class="float-right hide">                                        
                                        <a href="<?php echo base_url('transportation-report?excel_download=1&'.$this->input->SERVER('QUERY_STRING')); ?>"
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
                                                    <option value="<?= $key ?>" <?php echo (trim($this->input->get('location')==$key))?'selected="selected"':''; ?> >
                                                        <?= ucfirst($key) ?>
                                                    </option>
                                                    <?php }} ?>
                                                </select>
                                                <label class="mdl-textfield__label">Location</label>
                                            </div>
                                        </div>
                                        
										<div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php
                                                echo form_input(['name' => 'transportation', 'id' => 'transportation', 'placeholder' => 'Vehicle Name', 'class' => 'mdl-textfield__input', 'value' => $this->input->get('transportation')]);
                                                ?>
                                                <label class="mdl-textfield__label">Vehicle Name</label>
                                            </div>
                                            <input type="hidden" name="transportation_id" id="transportation_id" value="<?=($this->input->get('transportation_id')<>'' && $this->input->get('transportation')<>'')?$this->input->get('transportation_id'):''; ?>">
                                        </div>
										
                                        <div class="col-lg-3 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
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
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
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
                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="match_capacity" id="match_capacity" class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="=" <?=($this->input->get('match_capacity')<>'' && urldecode($this->input->get('match_capacity'))=="=")?'selected="selected"':''; ?>>Equal To</option>
													<option value="<=" <?=($this->input->get('match_capacity')<>'' && urldecode($this->input->get('match_capacity'))=="<=")?'selected="selected"':''; ?>>Less Than Equal To</option>
													<option value=">=" <?=($this->input->get('match_capacity')<>'' && urldecode($this->input->get('match_capacity'))==">=")?'selected="selected"':''; ?>>Greater Than Equal To</option>
                                                </select>
                                                <label class="mdl-textfield__label">Match Capacity</label>
                                            </div>
                                        </div>
										<div class="col-lg-1 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="capacity" id="capacity" class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="">Select..</option>
													<?php for($i=1;$i<=100;$i++){ ?>
														<option value="<?=$i?>" <?=($this->input->get('capacity')<>'' && urldecode($this->input->get('capacity'))==$i)?'selected="selected"':''; ?>><?=$i?></option>
													<?php } ?>
                                                </select>
                                                <label class="mdl-textfield__label">Capacity</label>
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
                                                    <option value="file-closed"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>
                                                        File Closed</option>
                                                </select>
                                                <label class="mdl-textfield__label">Status</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-t-20 mt-4">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            <a href="transportation-report" class="btn btn-md btn-danger" style="float:left;margin-left:5px;">Clear</a>
                                        </div>
                                    </div>                                    
									
                                </form>
								
                                <div class="card-body">
                                    
                                    <div class="table-scrollable">
                                    <a class="btn btn-primary mb-2" style="padding:4px 8px;float:right;" href="<?php echo base_url('transportation-report?excel_download=1&submit=submit&'.$this->input->SERVER('QUERY_STRING')); ?>" target="_blank"><i class="fa fa-download"></i> Excel</a>
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Vehicle Name</strong></th>
													<th class="center"><strong>Vehicle Type</strong></th>                                                    
                                                    <th class="center"><strong>Location</strong></th>                                                    
													<th class="center">
                                                        <strong>Number of times used
                                                            <?php if($this->input->get('status')<>''){ ?>
                                                            <span class="btn-link" style="text-decoration:none;">(<?=ucfirst($this->input->get('status')); ?>)</span>
                                                            <?php } ?>
                                                        </strong>
                                                    </th>
                                                    <th class="center"><strong>Total Number Of Days Used</strong></th>
                                                    <th class="center"><strong>Quantity</strong></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($transportation_report)) {
                                                    $i = $offset + 1;
                                                    foreach ($transportation_report as $list) {
                                                        $records_cnt++;
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center"><?php echo $list->vehicle_name; ?></td>
                                                    <td class="center"><?= $list->vehicle_type; ?></td>
                                                    <td class="center"><?= $list->country; ?></td>
		         									<td class="center">
                                                        <button class="btn btn-sm btn-link files" data-status="<?php echo ($this->input->get('status')<>'' )?$this->input->get('status'):''; ?>" data-vehicle-name="<?=$list->vehicle_name ?>" data-transporation-id="<?=$list->id ?>" title="View Files" style="padding:5px;"><?= $list->number_used ?> <i class="fa fa-file"></i></button>
                                                    </td>
                                                    <td class="center"><?= $list->num_days; ?></td>
                                                    <td class="center"><?= $list->vehicle_quantity; ?></td>
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
                    <h4 class="bold vehicle-name" style="color:#000;"></h4>&nbsp;
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
                                        <th class="center">Quantity</th>
                                        <!--th class="center">Luggage Vehicle</th-->
                                        <th class="center">Checkin Date</th>
                                        <th class="center">Checkout Date</th>
                                        <th class="center">Arrival Date</th>
                                        <th class="center">Number Of Days</th>
                                        <!--th class="center">Group Type</th-->
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
    var url = new URL(window.location.href);
    $(document).ready(function() {
		$("#transportation").autocomplete({
			source: function(request, response) {
				// Fetch data
				$.ajax({
					url: "<?= base_url() ?>admin/report/get_vehicle_names",
					type: 'post',
					dataType: "json",
					data: {
						search: request.term,
						'location': $("#location").val()
					},
					success: function(data) {
						response(data);
						dt = data;
						$(".err").html('');
					}
				});
			},
			select: function(event, ui) {
				// Set selection
				$('#transportation').val(ui.item.label); // display the selected text
				$('#transportation_id').val(ui.item.t_id); // save selected id to input
				
			}
		}).blur(function(event) {
            if($('#transportation').val()==''){
                $('#transportation_id').val('');
            }               
        });
		
		$("#location").on("change",function(){
			$("#transportation, #transportation_id").val('');
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
            var t_id = $(".files").eq(idx).attr("data-transporation-id");
            $(".vehicle-name").html($(".files").eq(idx).attr("data-vehicle-name"));
            var st = $(".files").eq(idx).attr("data-status");
            if ($.fn.DataTable.isDataTable('#example4')) {
                $('#example4').DataTable().clear().destroy();
            }
            const urlParams = new URLSearchParams(window.location.search);
            
            $.ajax({
                url: "<?php echo site_url('admin/report/get_transportation_files?'); ?>",
                type: "post",
                data: {'t_id':t_id,'date_from':urlParams.get('date_from'),'date_to':urlParams.get('date_to'),
                        'location':urlParams.get('location'),'match_capacity':urlParams.get('match_capacity'),
                        'capacity':urlParams.get('capacity'),'status':st
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
                        $.each(res.details, function(index, item) {
                            // Construct the table row
                            const selectedDate_checkin = new Date(item.check_in_date);
                            const selectedDate_checkout = new Date(item.check_out_date);
                            const selectedDate_arrivals = new Date(item.arrival_date);
                            
                            var row = '<tr>' +
                                '<td class="center">' + ++index + '</td>' + 
                                '<td class="center">' + item.enquiry_no + '</td>' +
                                '<td class="center">' + item.quantity + '</td>' +
                                //'<td class="center">' + item.luggage_vehicle + '</td>' +
                                '<td class="center">' + selectedDate_checkin.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + selectedDate_checkout.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + selectedDate_arrivals.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + item.num_days + '</td>' +  
                                //'<td class="center">' + item.group_type + '</td>' + 
                                '<td class="center">' + item.arrivals_status.toUpperCase() + '</td>' +                                  
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
                filename: ($(".vehicle-name").html()+"-Usage_Report_" + new Date().toLocaleDateString('en-IN',{year: 'numeric',month: 'short',day: '2-digit'})).replace(/[\ \.]/g, "_"),
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
	
    </script>

</body>

</html>
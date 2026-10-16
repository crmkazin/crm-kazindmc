<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                <form method="get">
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
                                                <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input', 'value' => set_value('company')]) ?>
                                                <label class="mdl-textfield__label">Company</label><?php echo form_error('company'); ?>
                                            </div>
                                            <input type="hidden" name="company_id" id="company_id">
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
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_from')]) ?>
                                                <label class="mdl-textfield__label">From
                                                </label><?php echo form_error('date_from'); ?>

                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input','value'=>$this->input->get('date_to')]) ?>
                                                <label class="mdl-textfield__label">To
                                                </label><?php echo form_error('date_to'); ?>

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
                                        </div>
									</div>
                                </form>
								<?php if(isset($total_sales)){ ?>
								<div class="card-body" style="background-color:#f3f3f3;">
									<div class="row">
                                        <div class="col-md-12"><strong>Total Billing: </strong><?php echo number_format($total_sales->final_total); ?></div>
										<div class="col-md-3"><strong>Total Payment In India(Dollar) : </strong><?php echo number_format($total_sales->final_dollar_india); ?></div>
										<div class="col-md-3"><strong>Total Payment In Other(Dollar) : </strong><?php echo number_format($total_sales->final_dollar_other); ?></div>
										<div class="col-md-3"><strong>Total Payment In India(INR) : </strong><?php echo number_format($total_sales->final_inr_india); ?></div>
										<div class="col-md-3"><strong>Total Payment In Other(INR) : </strong><?php echo number_format($total_sales->final_inr_other); ?></div>
									</div>
								</div>
								<?php } ?>
                                <div class="card-body">
                                    
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Company Name</strong></th>
                                                    <th class="center"><strong>Total Billing</strong></th>
													<th class="center"><strong>Payment In India(Dollar)</strong></th>
													<th class="center"><strong>Payment In Other(Dollar)</strong></th>
													<th class="center"><strong>Payment In India(INR)</strong></th>
													<th class="center"><strong>Payment In Other(INR)</strong></th>
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
                                                    <td class="center"><?= $list->name ?></td>
                                                    <td class="center"><?= $list->total_billing ?></td>                                                    
													<td class="center"><?= $list->dollar_india ?></td>
													<td class="center"><?= $list->dollar_other ?></td>
													<td class="center"><?= $list->inr_india ?></td>
													<td class="center"><?= $list->inr_other ?></td>												
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
                    console.log(responseData)
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
                }
            });
        }
    </script>

</body>

</html>
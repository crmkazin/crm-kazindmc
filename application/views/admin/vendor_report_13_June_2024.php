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
                                <div class="page-title">Vendor Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Vendor Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php if($this->session->flashdata('message')<>''){ echo $this->session->flashdata('message'); } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Vendor Report</header>
                                    <div class="float-right">                                        
                                        <a href="<?php echo base_url('vendor-excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>"
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
                                                    style="padding: 10px;" required>
                                                    <option value="">Select..</option>
                                                    <?php
                                                    asort($locations);													
													foreach ($locations as $key => $val) { if($key!='all'){  ?>
                                                    <option value="<?= $key ?>">
                                                        <?= ucfirst($key) ?>
                                                    </option>
                                                    <?php }} ?>
                                                </select>
                                                <label class="mdl-textfield__label">Location</label>
                                            </div>
                                        </div>
                                        
										<div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="hotel" id="hotel" class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value="">Select Hotel</option>
                                                </select>
                                                <label class="mdl-textfield__label">Hotel</label>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input']) ?>
                                                <label class="mdl-textfield__label">From
                                                </label><?php echo form_error('date_from'); ?>

                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input']) ?>
                                                <label class="mdl-textfield__label">To
                                                </label><?php echo form_error('date_to'); ?>

                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-12 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">
                                    
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Hotel Name</strong></th>
                                                    <th class="center"><strong>Address</strong></th>
													<th class="center"><strong>City</strong></th>
													<th class="center"><strong>State</strong></th>
													<th class="center"><strong>Country</strong></th>
                                                    <th class="center"><strong>Number Of Nights</strong></th>
                                                    <th class="center"><strong>Total Adults</strong></th>
                                                    <th class="center"><strong>Total Childs</strong></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($vendor_report)) {
                                                    $i = $offset + 1;
                                                    foreach ($vendor_report as $list) {
                                                        $records_cnt++;
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center"><?= $list->name ?></td>
                                                    <td class="center"><?= $list->address_1 ?></td>                                                    
													<td class="center"><?= $list->city ?></td>
													<td class="center"><?= $list->state ?></td>
													<td class="center"><?= $list->country ?></td>
													<td class="center">
													<?php 
														$number_nights = 0;
														$check_dates =  explode(',',$list->check_dates);
														if(!empty($check_dates)){
															foreach($check_dates AS $date_list){
																$d = explode('to',$date_list);
																$date_checkin = new DateTime(trim($d[0]));
																$date_checkout = new DateTime(trim($d[1]));
																$interval = $date_checkin->diff($date_checkout);
																//echo '<pre>';print_r($interval);
																$number_nights = $number_nights + $interval->d;
															}
														}
														echo $number_nights;
													?>
													</td>
                                                    <td class="center"><?= $list->t_adults ?></td>
                                                    <td class="center"><?= $list->t_child ?></td>
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
        
    });

    </script>

</body>

</html>
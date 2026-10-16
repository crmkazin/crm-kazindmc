<?php //include ('admin_head_css.php'); ?>
<style>
    .dataTables_scrollHeadInner{
        width:auto !important;
    }


</style>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Revenue Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Revenue Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php //include ('report_links.php'); ?>
                    <?php if($this->session->flashdata('message')<>''){ echo $this->session->flashdata('message'); } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                         
                                <div style="display: flex;justify-content: space-between;">
                                    <div class="filter-dropdown">
                                        <h3 class="text-primary">Advance Search</h3>
                                        <form method="get">
                                            <ul id="accordion" class="accordion ps-0">
                                                <li>
                                                    <div Class="acco">
                                                        <div class="link">
                                                            <i class="fa fa-chevron-down"></i>
                                                            Search By Location
                                                        </div>
                                                        <div class="content">
                                                            <label for="location">Location</label>
                                                            <div class="input-container">
                                                                <div class="mySelect">                    
                                                                    <select name="location" id="location" class="select mdl-textfield__input"
                                                                        style="padding: 10px;">
                                                                        <!--<option value=""></option>-->
                                                                        <?php
                                                            $selected_location = $this->input->get('location');
                                                            $user_type = $this->session->userdata('admin_type');
                                                            $user_locations = explode(',', $this->session->userdata('locations')); 
                                                            asort($locations);

                                                            ?>
                                                            <option value="all" data-abbr="<?= implode(',', $locations['all']) ?>" <?= ($selected_location == 'all') ? 'selected="selected"' : '' ?>>
                                                                All
                                                            </option>

                                                            <?php 
                                                            foreach ($locations as $key => $val) {
                                                                if ($key == 'all') continue; 

                                                                if ($user_type == 'user') {
                                                                    if (!in_array($key, $user_locations)) continue;
                                                                }

                                                                $selected = ($selected_location != '' && $selected_location == $key) ? 'selected="selected"' : '';
                                                            ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?= $selected ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php } ?>
                                                                      
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <label for="">Kazin Sales Team</label>
                                                            <div class="input-container">
                                                                <div class="mySelect">
                                                                <select name="sales" id="sales" class="sales select mdl-textfield__input">
                                                                        <option value="">All</option>
                                                                        <?php foreach($sales_team AS $list){  ?>
                                                                            <option value="<?php echo $list->id; ?>" <?php echo ($this->input->get('sales')<>'' && $this->input->get('sales')==$list->id)?'selected="selected"':''; ?>><?php echo $list->name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Region
                                                    </div>
                                                    <div class="content">
                                                        <label for="from">From</label>
                                                            <label class="mdl-textfield__label">Select Country</label>
                                                            <div class="input-container">
                                                                <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'country input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                                            </div>
                                                        <input type="hidden" class="country_id" name="country_id" id="country_id" value="">
                                                    
                                                        <label class="mdl-textfield__label">State</label>
                                                        <div class="input-container">
                                                            <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                                        </div>

                                                        <label class="mdl-textfield__label">City</label>
                                                        <div class="input-container">
                                                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                                        </div>

                                                        <label class="mdl-textfield__label">Fit Files</label>
                                                        <select name="fit_git_files" id="fit_git_files" class="select form-control">
                                                            <option value="">Select Files</option>
                                                            <option value="fit" <?= $this->input->get('fit_git_files') == 'fit' ? 'selected' : '' ?>>FIT</option>
                                                            <option value="git" <?= $this->input->get('fit_git_files') == 'git' ? 'selected' : '' ?>>GIT</option>
                                                        </select>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Arrival Date
                                                    </div>
                                                    <div class="content">
                                                        <label for="from">From</label>
                                                        <div class="input-container">
                                                            <input type="text" name=""
                                                            class="mdl-textfield__input dt-search-show" style="width:100%;"
                                                            value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
                                                            readonly>
                                                        <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'date_from dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:17px;float:right; position: relative;bottom: 22px;right: 10px;border: none;']) ?>
                                                        </div>
                                                    
                                                        <label for="">To</label>
                                                        <div class="input-container">
                                                            <input type="text" name=""
                                                                class="mdl-textfield__input dt-search-show" style="width:100%;"
                                                                value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
                                                                readonly>
                                                            <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'date_to dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:17px;float:right; position: relative;bottom: 22px;right: 10px;border: none;']) ?>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Company
                                                    </div>
                                                    <div class="content">
                                                    <label for="">Company</label>
                                                        <div class="input-container">                            
                                                            <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'company input mdl-textfield__input', 'value' => ($this->input->get('company')<>'')?urldecode($this->input->get('company')):'']) ?>
                                                            <input type="hidden" name="company_id" class="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                                        </div>
                                                    </div>
                                                </li>
                                            
                                                <li>
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Agent
                                                    </div>
                                                    <div class="content">
                                                    <label for="">Agent</label>
                                                        <div class="myselect">                            
                                                        <select name="agent" id="agent" class="agent select mdl-textfield__input" style="padding:8px;">
                                                        </select>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Quarter
                                                    </div>
                                                    <div class="content">
                                                    <label for="">Quarter</label>
                                                        <div class="myselect">                            
                                                                <select name="quarter" id="quarter" class="select mdl-textfield__input" style="padding: 10px;">
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
                                                </li>

                                                <li>
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Status
                                                    </div>
                                                    <div class="content">
                                                        <label for="">Status</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                            <select name="status" id="status" class="select mdl-textfield__input" style="padding: 10px;">
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
                                                                <!-- <span>Status</span> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                            <div class="filter-buttons">
                                                <button type="submit" style="background-color:#4f4e4e;">Reset</button>
                                                <!-- <button style="background-color:#19009d;"></button> -->
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <form method="get" class="content">                                  
                                    <div class="card-body row">
                                        <div class="col-lg-12" style="background-color:#f6f6f6;">
                                            <label style="color:#b9b9b9;" class="">Region Wise</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mdl-textfield__label">Select Country</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'country input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" class="country_id" name="country_id" id="country_id" value="">
                                        <div class="col-md-3">
                                            <label class="mdl-textfield__label">State</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="state_id" class="state_id" id="state_id" value="">
                                        <div class="col-md-3">
                                            <label class="mdl-textfield__label">City</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                            </div>
                                        </div>
                                    

                                        <div class="col-lg-3 p-t-20 text-center">
                                            <div class="input-container">
                                                <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-info', 'style'=>'float:left;', 'value'=>'Search']);?>
                                                <a href="javascript:void(0)" class="btn btn-md btn-info" id="toggleBtn" style="float:left;margin-left:5px;">Advance Search</a>
                                                <!-- <span class="btn btn-info m-1" id="toggleBtn" style="height: 35px; width:150px; color:#fff; padding:5px; margin-left:20px; float:left;">Advance Search</span> -->
                                                <a class="btn btn-info mb-2" style="float:right;" href="<?php echo base_url('revenue-report?excel_download=1&submit=submit&'.$this->input->SERVER('QUERY_STRING')); ?>" target="_blank"><i class="fa fa-download"></i></a>

                                            </div>
                                        </div> 
                                    </div>
                                </form>
								<?php //if(isset($total_sales)){ ?>
								<!--<div class="card-body" style="background-color:#f3f3f3;">-->
								<!--	<div class="row">-->
        <!--                                <div class="col-md-3"><strong>Total Payment In Dollars : </strong><?php echo '$' . number_format($total_sales->final_total_dollar); ?></div>-->
										<!--div class="col-md-3"><strong>Total Payment In Rupees : </strong><?php //echo number_format($total_sales->final_total_inr); ?></div-->
								<!--	</div>-->
								<!--</div>-->
								<?php //} ?>
								<div class="row mt-2">
                                     <div class="col-3"></div>
                                    <?php if(isset($total_sales)){ ?>
                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2 text-dark" style="font-weight: 700;">Total Payment (USD)</h5>
                                                <h4 class="" style="font-weight: 500;">
                                                    <?php echo $is_filter_applied  ? '$' . number_format($total_sales->final_total_dollar) 
                                                                            : '$' . number_format($total_sales_2025->final_total_dollar); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php if(isset($total_persons)){ ?>
                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2" style="font-weight: 700;">Total No. of Pax</h5>
                                                <h4 class="" style="font-weight: 500;">
                                                    <?php echo $is_filter_applied  ? number_format($total_persons->final_total_persons) 
                                                                            : number_format($total_persons_2025->final_total_persons); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php if(isset($total_file_cnt)){ ?>
                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2" style="font-weight: 700;">Total File Count</h5>
                                                <h4 class="" style="font-weight: 500;">
                                                    <?php echo $is_filter_applied  ? number_format($total_file_cnt->final_total_file_cnt) 
                                                                            :  number_format($total_file_cnt_2025->final_total_file_cnt); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-3"></div>
                                </div> 
                                <div class="card-body">
                                    
                                    <div class="table-scrollable">
                                        <table class="table table-striped border table-hover table-checkable order-column full-width"
                                            id="revenue_report">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Company Name</strong></th>
													<th class="center"><strong>Pax Count</strong></th>
                                                    <th class="center"><strong>Agent Since</strong></th>
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
													<td class="center"><?= $list->num_persons; ?></td>
                                                    <td class="center"><?= (!empty($list->date)) ? date('d-M-Y', strtotime($list->date)) : '-'; ?></td>
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
                                    <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' entries'; ?>
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
                    <h4 class="bold company-name"></h4>
                    <div class="btn btn-sm btn-link p-4">
                        <div class="" style="font-size:13px;">
                            <a class="t-collapse btn-color" href="javascript:;"></a>
                            <a id="export_to_excel" style="color:blue!important;"><i class="fa fa-download"></i></a>
                        </div>
                    </div>
                    <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body ui-front">
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width file-detail-table"
                                id="revenue_detail">
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
    </div>

<script>
    $(document).ready(function() {
        $('#myModal').on('shown.bs.modal', function () {
            // Destroy previous instance if already initialized
            if ($.fn.DataTable.isDataTable('#revenue_detail')) {
                $('#revenue_detail').DataTable().destroy();
            }

            // Re-initialize the DataTable
            $('#revenue_detail').DataTable({
                responsive: true,
                
            });
        });

        $("#revenue_report").DataTable({
            responsive: true,
            paging: false,
            info: false,
        }); 
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
		
		
        $(".country").autocomplete({
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
                $('.country').val(ui.item.label); // display the selected text
                $('.country_id').val(ui.item.country_id); // save selected id to input

                return false;
            }
        });

        function split( val ) {
            return val.split( /,\s*/ );
        }        
        function extractLast( term ) {
            return split( term ).pop();
        }
        $(".state").autocomplete({
            source: function(request, response) {
                if($('.country').val() == "" || $('.country_id').val() == ""){ return false; }
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

                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                if(terms.length > 2){
                    $(".city").val("").attr('disabled','disabled');
                }else { $(".city").removeAttr('disabled');$('.state_id').val(ui.item.state_id); }
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

                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );                
                return false;

            }
        });

        // function cleanInput(val) {
        //     return val.trim().replace(/,+$/, '').toLowerCase();
        // }

        // function loadFitGitFiles() {
        //     const country = cleanInput($('#country').val());
        //     const state = cleanInput($('#state').val());
        //     const city = cleanInput($('#city').val());

        //     if (country !== '' && state !== '' && city !== '') {
        //         $.ajax({
        //             url: "<?= base_url('admin/report/get_fit_git_files') ?>",
        //             type: 'POST',
        //             dataType: 'json',
        //             data: {
        //                 country: country,
        //                 state: state,
        //                 city: city
        //             },
        //             success: function (data) {
        //                 const fitVal = "<?= $this->input->get('fit') ?>";
        //                 const gitVal = "<?= $this->input->get('git') ?>";

        //                 $('#fit').empty().append('<option value="">Select Fit File</option>');
        //                 data.fit.forEach(function (item) {
        //                     const selected = (item === fitVal) ? 'selected' : '';
        //                     $('#fit').append('<option value="' + item + '" ' + selected + '>' + item + '</option>');
        //                 });

        //                 $('#git').empty().append('<option value="">Select Git File</option>');
        //                 data.git.forEach(function (item) {
        //                     const selected = (item === gitVal) ? 'selected' : '';
        //                     $('#git').append('<option value="' + item + '" ' + selected + '>' + item + '</option>');
        //                 });
        //             },
        //             error: function (xhr, status, error) {
        //                 console.error('Error fetching FIT/GIT files:', error);
        //             }
        //         });
        //     }
        // }

        // // Trigger on autocompleteselect or change of city
        // $('#city').on('autocompleteselect change', function () {
        //     loadFitGitFiles();
        // });

        // const country = cleanInput($('#country').val());
        // const state = cleanInput($('#state').val());
        // const city = cleanInput($('#city').val());

        // if (country !== '' && state !== '' && city !== '') {
        //     loadFitGitFiles();  // call only if pre-filled from URL
        // }

		
        $(".files").on("click",function(){
            var idx = $(this).index(".files");
            var c_id = $(".files").eq(idx).attr("data-company-id");
            $(".company-name").html($(".files").eq(idx).attr("data-company-name"));
            var st = $(".files").eq(idx).attr("data-status");
            if ($.fn.DataTable.isDataTable('#revenue_detail')) {
                $('#revenue_detail').DataTable().clear().destroy();
            }
            const urlParams = new URLSearchParams(window.location.search);
            // const fit_git_Param = urlParams.get('fit_git_files');
            
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
                            const fit_git_param = urlParams.get('fit_git_files');
                            const enquiryNo = item.enquiry_no.toLowerCase();
                           if ((fit_git_param === 'fit' && enquiryNo.startsWith('f')) ||
                                (fit_git_param === 'git' && enquiryNo.startsWith('g')) ||
                                (fit_git_param === null || fit_git_param === '')) {

                                const selectedDate_checkin = new Date(item.check_in_date);
                                const selectedDate_checkout = new Date(item.check_out_date);
                                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                                let split = '';

                                if(item.split_number != 0){
                                    split = " (Split-" + item.split_number + ")";
                                }

                                var row = '<tr>' +
                                    '<td class="center">' + (index + 1) + '</td>' +
                                    '<td class="center">' + item.enquiry_no + split + '</td>' +
                                    '<td class="center">' + selectedDate_checkin.toLocaleDateString('en-IN', options) + '</td>' +
                                    '<td class="center">' + selectedDate_checkout.toLocaleDateString('en-IN', options) + '</td>' +
                                    '<td class="center">' + item.contact_person + '</td>' +
                                    '<td class="center">' + item.client_billing + '</td>' +
                                    '<td class="center">' + item.balance_amount + '</td>' +
                                    '<td class="center">' + item.arrivals_status.toUpperCase().replace(/[\-\.]/g, " ") + '</td>' +
                                    '</tr>';

                                tableBody.append(row);
                            }
                        });
                        $("#myModal").modal("toggle");
                        // $('#example4').DataTable({
                        //     "scrollX": true,
                        //     "scrollY": true,
                        //     "pageLength": 10
                        // });
                        
                    }
                }
            });
        });

      // Delegate click handler for dynamic .files
// $(document).on("click", ".files", function () {
//     var idx = $(this).index(".files");
//     var c_id = $(".files").eq(idx).attr("data-company-id");
//     var companyName = $(".files").eq(idx).attr("data-company-name");
//     var st = $(".files").eq(idx).attr("data-status");

//     $(".company-name").html(companyName);

//     // Destroy DataTable if exists
//     if ($.fn.DataTable.isDataTable('#revenue_detail')) {
//         $('#revenue_detail').DataTable().clear().destroy();
//     }

//     const urlParams = new URLSearchParams(window.location.search);
//     var fitGitType = urlParams.get('fit_git_files'); // 'fit' or 'git'

//     $.ajax({
//         url: "<?php echo site_url('admin/report/get_files'); ?>",
//         type: "POST",
//         data: {
//             c_id: c_id,
//             date_from: urlParams.get('date_from'),
//             date_to: urlParams.get('date_to'),
//             agent: urlParams.get('agent'),
//             sales: urlParams.get('sales'),
//             country: urlParams.get('country'),
//             state: urlParams.get('state'),
//             city: urlParams.get('city'),
//             status: st,
//             location: urlParams.get('location'),
//             fit_git_files: fitGitType
//         },
//         dataType: 'JSON',
//         beforeSend: function () {
//             $(".file-detail-table tbody").html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');
//         },
//         success: function (res) {
//             var tableBody = $('.file-detail-table tbody');
//             tableBody.empty();

//             if (res.response === "s") {
//                 const options = { year: 'numeric', month: 'short', day: '2-digit' };

//                 var filteredDetails = res.details.filter(item => {
//                     if (!item.enquiry_no) return false;
//                     const no = item.enquiry_no.trim().toUpperCase();
//                     if (fitGitType === 'fit') return no.startsWith('F');
//                     if (fitGitType === 'git') return no.startsWith('G');
//                     return true;
//                 });

//                 if (filteredDetails.length === 0) {
//                     tableBody.append('<tr><td colspan="8" class="text-center text-danger">No matching files found.</td></tr>');
//                 } else {
//                     $.each(filteredDetails, function (index, item) {
//                         const checkin = new Date(item.check_in_date);
//                         const checkout = new Date(item.check_out_date);
//                         const split = (item.split_number != 0) ? " (Split-" + item.split_number + ")" : '';

//                         var row = '<tr>' +
//                             '<td class="center">' + (index + 1) + '</td>' +
//                             '<td class="center">' + item.enquiry_no + split + '</td>' +
//                             '<td class="center">' + checkin.toLocaleDateString('en-IN', options) + '</td>' +
//                             '<td class="center">' + checkout.toLocaleDateString('en-IN', options) + '</td>' +
//                             '<td class="center">' + item.contact_person + '</td>' +
//                             '<td class="center">' + item.client_billing + '</td>' +
//                             '<td class="center">' + item.balance_amount + '</td>' +
//                             '<td class="center">' + item.arrivals_status.toUpperCase().replace(/[\-\.]/g, " ") + '</td>' +
//                             '</tr>';

//                         tableBody.append(row);
//                     });
//                 }

//                 $("#myModal").modal("show"); // Open modal
//             } else {
//                 tableBody.html('<tr><td colspan="8" class="text-center text-danger">Error loading files.</td></tr>');
//             }
//         },
//         error: function (xhr) {
//             console.error("AJAX Error:", xhr.responseText);
//             $(".file-detail-table tbody").html('<tr><td colspan="8" class="text-center text-danger">AJAX error occurred.</td></tr>');
//         }
//     });
// });
       
        
		$("#export_to_excel").on("click",function(){
            $('<table>').append($('#revenue_detail thead').clone()).append($('#revenue_detail').DataTable().$('tr').clone()).table2excel({
                sheetName: 'Sales Report',
                filename: ($(".company-name").html()+"-Sales_Report_" + new Date().toLocaleDateString('en-IN',{year: 'numeric',month: 'short',day: '2-digit'})).replace(/[\ \.]/g, "_"),
                fileext: ".xlsx",
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
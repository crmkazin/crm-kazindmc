<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<style>
    .dataTables_paginate .page-item>.page-link {
        padding: 0 12px !important;
    }

    .form-control {
        border: 1px solid #ede5e5 !important;
    }

    .bg-previous_confirm {
        color: #fff;
        background-color: #2CA8FF;
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
                            <h4 class="text-themecolor">Staff Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Staff Report</li>
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

                                <div class="card-body">
                                    <form method="get" class="content">
                                        <div class="card-body row">

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Location</label>
                                                    <select name="location" id="location" class="mdl-textfield__input bg-white" style="padding: 10px;">
                                                        <option value="">Select..</option>
                                                        <?php if($this->session->userdata('admin_type') == 'user') {
                                                        $user_locations = explode(',', $this->session->userdata('locations')); 
                                                        asort($locations);

                                                        foreach ($locations as $key => $val) {
                                                            if (in_array($key, $user_locations)) {
                                                                $selected = ($this->input->get('location') != '' && $this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?= $selected ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php 
                                                            }
                                                        } 
                                                    } else { ?>
                                                        <?php 
                                                        asort($locations);
                                                        foreach($locations AS $key=>$val){ $val[]='All'; ?>
                                                        <option value="<?=$key?>" data-abbr="<?=implode(',',$val)?>" <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                            <?= ucfirst($key)?></option>
                                                       <?php } ?>
                                                   <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Staff</label>
                                                    <select name="staff_id[]" id="staff_id" class="mdl-textfield__input js-example-basic-multiple bg-white" style="padding: 10px;" multiple="">
                                                        <option value="">Select...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Quarter</label>
                                                    <select name="quarter" id="quarter" class="mdl-textfield__input bg-white" style="padding: 10px;">
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
                                            
                                            <div class="col-lg-2 p-t-20">
                                                <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php //echo form_input(['type' => 'date','value'=>($this->input->get('date_from')<>'')?$this->input->get('date_from'):'' ,'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">From
                                                    </label>
                                                </div-->
												
                                                <label class="mdl-textfield__label">From</label>
                                                <div class="bg-white mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                            class="mdl-textfield__input dt-search-show" style="width:100%;"
                                                            value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
                                                            readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts dt-search', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:17px;float:right;position: absolute; right: 12%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
                                                </div>
												
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php //echo form_input(['type' => 'date','value'=>($this->input->get('date_to')<>'')?$this->input->get('date_to'):'' ,'name' => 'date_to', 'placeholder' => '', 'id' => 'date_to', 'class' => 'dts mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">To
                                                    </label>
                                                    </div-->
                                                    
                                                    <label class="mdl-textfield__label">To</label>
                                                <div class="bg-white mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                            class="mdl-textfield__input dt-search-show" style="width:100%;"
                                                            value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
                                                            readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'dts dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
                                                </div>
												
                                            </div>
                                            
                                            <div class="col-lg-6 p-t-20 text-start">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-info', 'style' => '', 'value' => 'Search']); ?>
                                                <?php if (!empty($status_uri)) { ?>
                                                        <a href="<?php echo base_url('admin/report/staff_export_excel?' . $this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-sm btn-info ms-2" style="padding:8px;" title="Download Excel" target="_blank">
                                                            <i class="fa fa-download"></i></a>
                                                <?php } else { ?>
                                                        <a href="<?php echo base_url('admin/report/staff_count_excel?' . $this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-sm btn-info ms-2" style="padding:8px;" title="Download Excel" target="_blank">
                                                            <i class="fa fa-download"></i></a>
                                                <?php } ?>
                                            </div>
                                            <?php if ($staff_data){ 
                                                    $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
                                            ?>
                                            <div class="col-lg-9 p-t-20 text-right">
                                                <a href="<?=current_url().'?'.$search[0].'&compare_graph=true';?>" class="btn btn-md btn-info" target="_blank">Compare Data</a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                    
                                        <?php if ($staff_data) {
                                            $i = ($this->input->get('per_page')<>'')?$this->input->get('per_page'):0; 
                                            $search = explode('&per_page', $this->input->SERVER('QUERY_STRING'));
                                            if(count($staff_data)==1){
                                                $redirect_url = current_url().'?'.$search[0];
                                            }
                                            else{
                                                $redirect_url = current_url().'?'.str_replace(['&staff_id=all','&staff_id=','staff_id%5B%5D='],'',$search[0]);
                                            }
                                            
                                            ?>
                                            <?php foreach ($staff_data as $staff) { ?>
                                                <div class="row mb-4 border">
                                                    <div class="col-lg-12 p-2" style="background-color:#e7e7e7;">
                                                        <?= ++$i; ?>. <strong><?= $staff->name; ?></strong> 
                                                        <a class="btn-info float-right" href="<?php echo $redirect_url.'&staff_id[]='.$staff->id.'&graph=true'; ?>" style="padding:0px 3px;" target="_blank">View Graph</a>
                                                    </div>
                                                    <div class="col-lg-4 p-2" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center mb-1"><strong>Previous Prospect</strong></div>
                                                            <?php $key = array_search($staff->id, array_column($previous_prospect, 'id'));
                                                                   $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0',
                                                                            'in-progress'=>'0','confirm'=>'0']; 
                                                                  if($key!==false){
                                                                      $result = explode(',',$previous_prospect[$key]->result);
                                                                      foreach($result AS $list){
                                                                          $res = explode('_',$list);
                                                                          $number_cnt[$res[1]] = $res[0];
                                                                          //echo '<div class="col-md-6 mb-2"><span class="line-num text-white status-span '.$span_class[$res[1]].'" style="width:30px;height:30px;line-height:30px;">'.$res[0].'</span> '.ucwords($res[1]).'</div>';
                                                                      }
                                                                  }
                                                            ?>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-danger" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['cancel-at-arrival']?></span> Cancel At Arrival</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-orange" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['not-materialized']?></span> Not Materialized</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-black" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['pending']?></span> Pending</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-perp" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['in-progress']?></span> In-progress</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-green" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['confirm']?></span> Confirm</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 p-2" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center mb-1"><strong>Current Prospect</strong></div>
                                                            <?php $key = array_search($staff->id, array_column($current_prospect, 'id'));
                                                                    $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0',
                                                                            'in-progress'=>'0','confirm'=>'0']; 
                                                                  if($key!==false){
                                                                      $result = explode(',',$current_prospect[$key]->result);
                                                                      foreach($result AS $list){
                                                                          $res = explode('_',$list);
                                                                          $number_cnt[$res[1]] = $res[0];
                                                                          //echo '<div class="col-md-6 mb-2"><span class="line-num text-white status-span '.$span_class[$res[1]].'" style="width:30px;height:30px;line-height:30px;">'.$res[0].'</span> '.ucwords($res[1]).'</div>';
                                                                      }
                                                                      //echo '<pre>';print_r($current_prospect[$key]);
                                                                  }
                                                            ?>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-danger" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['cancel-at-arrival']?></span> Cancel At Arrival</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-orange" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['not-materialized']?></span> Not Materialized</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-black" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['pending']?></span> Pending</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-perp" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['in-progress']?></span> In-progress</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-green" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['confirm']?></span> Confirm</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 p-2" style="background-color:#f7f7f7 !important;">
                                                         <div class="row">
                                                            <div class="col-md-12 text-center mb-1"><strong>Future Prospect</strong></div>
                                                            <?php $key = array_search($staff->id, array_column($future_prospect, 'id'));
                                                                    $number_cnt = ['cancel-at-arrival'=>'0','not-materialized'=>'0','pending'=>'0',
                                                                            'in-progress'=>'0','confirm'=>'0'];
                                                                  if($key!==false){
                                                                      $result = explode(',',$future_prospect[$key]->result);
                                                                      foreach($result AS $list){
                                                                          $res = explode('_',$list);
                                                                          $number_cnt[$res[1]] = $res[0];
                                                                          //echo '<div class="col-md-6 mb-2"><span class="line-num text-white status-span '.$span_class[$res[1]].'" style="width:30px;height:30px;line-height:30px;">'.$res[0].'</span> '.ucwords($res[1]).'</div>';
                                                                      }
                                                                      //echo '<pre>';print_r($future_prospect[$key]);
                                                                  }
                                                            ?>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-danger" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['cancel-at-arrival']?></span> Cancel At Arrival</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-orange" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['not-materialized']?></span> Not Materialized</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-black" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['pending']?></span> Pending</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-perp" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['in-progress']?></span> In-progress</div>
                                                            <div class="col-md-6 mb-2"><span class="line-num text-white status-span bg-green" style="width:30px;height:30px;line-height:30px;"><?=$number_cnt['confirm']?></span> Confirm</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="row mb-3 pt-2">
                                                <div class="col-lg-12 mt-2 text-center">
                                                    <p><strong>No record found !</strong></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php //echo 'Showing ' . count($staff_data) . ' of ' . $total . ' Records'; ?>
                                    <?php //echo $links; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
    
    </div>

    <script>
        $(document).ready(function() {

            $("#location").on("change", function() {
                get_staff();
            });
            
            url = new URL(window.location.href);
            if (url.searchParams.has('location')) {
                get_staff();                
            }
            
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
                    success: function(data) {
                        $("#staff_id").empty().parent().addClass("is-dirty");
                        var opts = data.details;
                        $.each(opts, function(i, d) {
                            $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] +
                                '</option>');
                        });
                        $('#staff_id').append('<option value="all">All</option>');
                    },
                    complete:function(){ 
                        //$('#staff_id').val(url.searchParams.get('staff_id')); 
                        $("#staff_id").val(url.searchParams.getAll('staff_id[]')).select2();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
            }
            
            
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSpans = document.querySelectorAll('.status-span');

            statusSpans.forEach(function(span) {
                span.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    const staff_id = this.getAttribute('data-staff_id');
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('status', status);

                    // If you want to keep other parameters in the URL, you can get them from the current URL
                    const location = urlParams.get('location') || '';
                    const date_from = urlParams.get('date_from') || '';
                    const date_to = urlParams.get('date_to') || '';

                    // Construct the new URL
                    const newUrl = `staff-report?location=${location}&staff_id=${staff_id}&date_from=${date_from}&date_to=${date_to}&status=${status}&submit=Search`;
                    window.open(newUrl, '_blank');
                });
            });
        });
        
        $("#quarter").on("change",function(){
            if($("#quarter").val()!="") $(".dts, .dt-search-show").val('');
        });
        $(".dts").on("change",function(){
            if($(".quarter").eq(0).val()!="") $("#quarter").val('');
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
	$('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'Title',

        });	
    </script>
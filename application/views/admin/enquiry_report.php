 <?php //include('admin_head_css.php');?>

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
                            <h4 class="text-themecolor">Enquiry Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Enquiry Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php //include('report_links.php'); ?>

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
                                                            
                                                                <select name="location" id="location" class="location select mdl-textfield__input"
                                                                    style="padding: 10px;">
                                                                    <option value=""></option>
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

                                                        <label for="booking_type">Booking Type</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                    <select name="booking_type" id="booking_type"
                                                                        class="select mdl-textfield__input booking_type" style="padding: 10px;" data-selected="<?= $this->input->get('booking_type') ?? 'all'; ?>">
                                                                          <option value=""></option>
                                                                    </select>                                                                
                                                                <!-- <span>Booking Type</span> -->
                                                            </div>
                                                        </div>

                                                        <label for="staff_id">Staff</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="staff_id" id="staff_id" class="staff_id select mdl-textfield__input"
                                                                    style="padding: 10px;">
                                                                    <option value=""></option>
                                                                </select>
                                                          
                                                                <!-- <span>Staff</span> -->
                                                            </div>
                                                        </div>

                                                        <label for="">Kazin Sales Team</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="sales" id="sales" class="select mdl-textfield__input">
                                                                    <option value="">Select..</option>
                                                                    <?php foreach($sales_team AS $list){
                                                                    ?>
                                                                        <option value="<?=$list->id ?>" <?php echo ($this->input->get('sales')<>'' && $this->input->get('sales')==$list->id)?'selected="selected"':''; ?>><?=$list->name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <!-- <span>Kazin Sales Team</span> -->
                                                            </div>  
                                                            <input type="hidden" name="company_details_id" id="company_details_id" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Query Date
                                                </div>
                                                <div class="content">
                                                    <label for="from">From</label>
                                                    <div class="input-container">
                                                        <input type="text" name=""
													class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
													value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
													readonly>
												    <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:17px;float:right; position: relative;bottom: 29px;right: 10px;border: none;']) ?>
                                                        <!-- <span>From</span> -->
                                                    </div>
                                                  
                                                    <label for="">To</label>
                                                    <div class="input-container">
                                                        <input type="text" name=""
                                                            class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                                            value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
                                                            readonly>
                                                        <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:17px;float:right; position: relative;bottom: 29px;right: 10px;border: none;']) ?>
                                                     
                                                        <!-- <span>TO</span> -->
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
                                                         <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'class'=>'input mdl-textfield__input', 'value'=>($this->input->get('company')<>'')?urldecode($this->input->get('company')):''])?>
                                                        <input type="hidden" name="company_id" id="company_id"
                                                        value="<?= ($this->input->get('company_id') <> '' && $this->input->get('company') <> '') ? $this->input->get('company_id') : ''; ?>">
                                                        <!-- <span>Company</span> -->
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
                                                            <select name="status" id="status" class="select mdl-textfield__input">
                                                                <option value="">Select Status</option>
                                                                <option value="pending" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='pending')?'selected="selected"':''; ?>>Pending</option>
                                                                <option value="in-progress" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>In-progress</option>
                                                                <option value="confirm" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='confirm')?'selected="selected"':''; ?>>Confirm</option>                                                    
                                                                <option value="cancel-at-arrival" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel-at-arrival')?'selected="selected"':''; ?>>Cancel at Arrival</option>
                                                                <option value="not-materialized" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='not-materialized')?'selected="selected"':''; ?>>Dropped</option>
                                                            </select>
                                                            <!-- <span>Status</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="filter-buttons">
                                            <button type="submit" style="background-color:#4f4e4e;">Reset</button>
                                            <button style="" class="bg-primary">Search</button>
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
                                                <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id" value="">
                                        <div class="col-md-3">
                                            <label class="mdl-textfield__label">State</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'input mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="state_id" id="state_id" value="">
                                        <div class="col-md-3">
                                            <label class="mdl-textfield__label">City</label>
                                            <div class="input-container">
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'input mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20 text-center">
                                            <div class="input-container">
                                                <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-info', 'style'=>'float:left;', 'value'=>'Search']);?>
                                                <a href="javascript:void(0)" class="btn btn-md btn-info" id="toggleBtn" style="float:left;margin-left:5px;">Advance Search</a>
                                                <a class="btn btn-info mb-2" style="" href="<?php echo base_url('enquiry-report?excel_download=1&'.$this->input->SERVER('QUERY_STRING')); ?>" target="_blank"><i class="fa fa-download"></i></a>

                                                <!-- <span class="btn btn-info m-1" id="toggleBtn" style="height: 35px; width:150px; color:#fff; padding:5px; margin-left:20px; float:left;">Advance Search</span> -->
                                            </div>
                                        </div> 
                                    </div>
                                </form>

                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width" id="enquiry_report">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Company</strong></th>
                                                    <th class="center">
                                                        <strong>Total Files</strong>
                                                        <?php if($this->input->get('status')<>''){ ?>
                                                            <span class="btn-link" style="text-decoration:none;">(<?=ucfirst($this->input->get('status')); ?>)</span>
                                                            <?php } ?>
                                                    </th>
                                                    <th class="center"><strong>All Files</strong></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php     
                                                $records_cnt = 0;
                                                if (!empty($enquiry)) {
                                                    $i = $offset + 1;
                                                    foreach ($enquiry as $list) {
                                                        $records_cnt++;
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                    <td class="center"><?php echo ($list->name=='')?'<strong>B2C Sales</strong>':$list->name; ?></td>
                                                    <td class="center">
                                                        <button class="btn btn-sm btn-link files" data-status="<?php echo ($this->input->get('status')<>'' )?$this->input->get('status'):''; ?>" data-company-name="<?=$list->name ?>" data-company-id="<?=$list->company_id ?>" title="View Files" style="padding:5px;"><?=$list->file_cnt ?> <i class="fa fa-file"></i></button>
                                                    </td>
                                                    <td class="center">
                                                        <button class="btn btn-sm btn-link files" data-status="" data-company-name="<?=$list->name ?>" data-company-id="<?=$list->company_id ?>" title="View Files" style="padding:5px;"><i class="fa fa-file"></i></button>
                                                    </td>
                                                </tr>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing '.$records_cnt.' of '.$total.' Records'; ?>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body ui-front">
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width file-detail-table"
                                id="enquiry_detail">
                                <thead>
                                    <tr>
                                        <th class="center">Sr.No</th>
                                        <th class="center">Enquiry No.</th>
                                        <th class="center">Checkin Date</th>
                                        <th class="center">Checkout Date</th>
                                        <th class="center">Number Of Guests</th>
                                        <th class="center">Query Received Date</th>
                                        <th class="center">Agent Name</th>
                                        <th class="center">Sales Person</th>
                                        <th class="center">Remarks</th>
                                        <th class="center">File Status</th>
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
    </div>

 <script>
    var url = new URL(window.location.href);
    $(document).ready(function() {

        var tableInitialized = false;

        $('#myModal').on('shown.bs.modal', function () {
            if (!tableInitialized) {
                $('#enquiry_detail').DataTable({
                    responsive: true
                });
                tableInitialized = true; // So it doesn't reinitialize on every modal open
            }
        });

        $("#company").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?=base_url()?>admin/company/company_name_suggesstion",
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
                //get_sales();
            }
        }).blur(function(event) {
            if($('#company').val()==''){
                $('#company_id').val('');
            }               
        });
        
        if (url.searchParams.has('company_id')) {
            get_agents();                
        }
        
        function get_agents() {
            if ($("#company_id").val() === "") {
                $("#agent").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/company/get_branch_ajax",
                data: {
                    'company': $("#company_id").val()
                },
                success: function(data) {
                    $("#agent").empty().parent().addClass("is-dirty");
                    
                    var opts = $.parseJSON(data);
                    $('#agent').append('<option value="">All</option>');
                    $.each(opts, function(i, d) {                        
                        $('#agent').append('<option value="' + d.company_id + '" data-id="' + d.company_id + '">' + d
                            .contact_person + '</option>');
                    });
                },
                complete:function(){ 
                    $('#agent').val(url.searchParams.get('agent')); 
                },
                
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        }

        /*function get_sales() {
            if ($("#company_id").val() === "") {
                $("#sales").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/company/get_sales",
                data: {
                    'company': $("#company_id").val()
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#sales").empty().append('<option value="0">Select..</option>').parent()
                        .addClass(
                            "is-dirty");
                    $.each(data["details"].sales_team, function(i, d) {
                        $('#sales').append('<option value="' + d.id + '"' + '>' + d.name +'</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        }*/
    });
    </script>

    <script>
        
        // var booking_type = url.searchParams.has('booking_type')?url.searchParams.get('booking_type'):"All";
        
        // $("#location").on("change", function() {
        //     var v = $(this).find(':selected').attr('data-abbr');
        //     $("#booking_type").empty().parent().removeClass("is-dirty");
        //     if (v !== "" && v !== undefined) {
        //         var opts = v.split(",");
        //         $("#booking_type").parent().addClass("is-dirty");
        //         $.each(opts, function(i, d) {
        //             $('#booking_type').append('<option value="' + d + '"'+((d==booking_type)?"selected":"")+'>' + d + '</option>');
        //         });
        //         get_staff();
        //     }
        // });
        
        // if (url.searchParams.has('location')) {
        //     get_staff(); 
        //     $("#location").trigger("change");
        // }
        
        // function get_staff() {
        //     if ($("#location").val() === "") {
        //         $("#staff_id").empty();
        //         return false;
        //     }
        //     $.ajax({
        //         type: "POST",
        //         url: "<?=base_url();?>admin/enquiry/get_staff",
        //         data: {
        //             'location': $("#location").val()
        //         },
        //         dataType: "JSON",
        //         success: function(data) {
        //             $("#staff_id").empty().parent().addClass("is-dirty");
        //             var opts = data.details;
        //             $('#staff_id').append('<option value="all">All</option>');
        //             $.each(opts, function(i, d) {
        //                 $('#staff_id').append('<option value="' + d['id'] + '">' + d[
        //                         'name'] +
        //                     '</option>');
        //             });
        //         },
        //         complete:function(){ 
        //             $('#staff_id').val(url.searchParams.get('staff_id')); 
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {}
        //     });
        // }

    $(document).ready(function() {        
		$(".dts").on("change", function() {
			if ($('.dts:eq(0)').val() === "" || $('.dts:eq(1)').val() === "") {
				return false;
			}
			const pre = new Date($('.dts:eq(0)').val());
			const last = new Date($('.dts:eq(1)').val());
			if (pre > last) {
				alert('Check-in date must be less than Check-out date.');
				$(".dts, .dt-search-show").val('');
			} else {
				const diffInMs = Math.abs(last - pre);
				const diffInDays = Math.round(diffInMs / (1000 * 60 * 60 * 24));
				$("#number_of_nights").val(diffInDays);
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
           
        $(".files").on("click",function(){
            var idx = $(this).index(".files");
            var c_id = $(".files").eq(idx).attr("data-company-id");
            $(".company-name").html($(".files").eq(idx).attr("data-company-name"));
            var st = $(".files").eq(idx).attr("data-status");
            if ($.fn.DataTable.isDataTable('#enquiry_report')) {
                $('#enquiry_report').DataTable().clear().destroy();
            }
            const urlParams = new URLSearchParams(window.location.search);
            
            $.ajax({
                url: "<?php echo site_url('admin/report/get_query_files'); ?>",
                type: "post",
                data: {'c_id':c_id,'date_from':urlParams.get('date_from'),'date_to':urlParams.get('date_to'),'agent':urlParams.get('agent'),'sales':urlParams.get('sales'),'country':urlParams.get('country'),'state':urlParams.get('state'),'city':urlParams.get('city'),'status':st,
                        'booking_type':urlParams.get('booking_type'),'staff_id':urlParams.get('staff_id'),'location':urlParams.get('location')
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
                            
                            var row = '<tr>' +
                                '<td class="center">' + ++index + '</td>' + 
                                '<td class="center">' + item.enquiry_no + '</td>' +
                                '<td class="center">' + selectedDate_checkin.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + selectedDate_checkout.toLocaleDateString('en-IN', options) + '</td>' + 
                                '<td class="center">' + item.number_persons+'(A),'+item.number_child + '(C)</td>' + 
                                '<td class="center">' + item.query_received_date + '</td>' + 
                                '<td class="center">' + item.contact_person + '</td>' +
                                '<td class="center">' + ((item.name != null)?item.name:'') + '</td>' + 
                                '<td class="center">' + item.remarks + '</td>' + 
                                '<td class="center">' + item.status.toUpperCase().replace(/[\-\.]/g, " ") + '</td>' +
                                '</tr>';

                            // Append the row to the table body
                            tableBody.append(row);
                        });
                        $("#myModal").modal("toggle");
                        $('#enquiry_report').DataTable({
                            responsive: true,
                            // "scrollY": true,
                            // "pageLength": 10
                            paging:false,
                            info: false,
                        });
                        
                    }
                }
            });
        });

        $("#export_to_excel").on("click",function(){
            $('<table>').append($('#enquiry_report thead').clone()).append($('#enquiry_report').DataTable().$('tr').clone()).table2excel({
                sheetName: 'Query Report',
                filename: ($(".company-name").html()+"-Query_Report_" + new Date().toLocaleDateString('en-IN',{year: 'numeric',month: 'short',day: '2-digit'})).replace(/[\ \.]/g, "_"),
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: true
            });
        });
        
        $('.close-modal').on('click', function() {
           // Destroy existing DataTable instance if it exists
           if ($.fn.DataTable.isDataTable('#enquiry_report')) {
                $('#enquiry_report').DataTable().clear().destroy();
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
<?php if ($this->session->userdata('type') == '1'){ ?>
<script>
$(document).ready(function () {
    // Utility: Get URL parameter
    const params = new URLSearchParams(window.location.search);
    const bookingTypeFromURL = params.get('booking_type') || "";
    const staffIdFromURL = params.get('staff_id');

    // Function to update Booking Types dropdown based on selected Location
    function updateBookingTypesFromLocation(selectedLocation, selectedBookingType = "") {
        var selectedOption = $(".location option[value='" + selectedLocation + "']");
        var v = selectedOption.attr('data-abbr');

        $(".booking_type").empty().parent().removeClass("is-dirty");

        if (v !== "" && v !== undefined) {
            var opts = v.split(",");
            $(".booking_type").parent().addClass("is-dirty");

            // Append "All" option
            // var selectedAll = (selectedBookingType === "all") ? 'selected="selected"' : '';
            $('.booking_type').append('<option value="all" selected="selected">All</option>');

            // Append other booking type options
            $.each(opts, function (i, d) {
                var selected = (selectedBookingType === d) ? 'selected="selected"' : '';
                $('.booking_type').append('<option value="' + d + '" ' + selected + '>' + d + '</option>');
            });

            // Trigger user fetch if booking type present
            getUsersByBookingType(selectedBookingType, staffIdFromURL);
        }
    }

    // Function to fetch and display users by booking type
    function getUsersByBookingType(bookingType, selectedStaffId = null) {
        const selectedLocation = $(".location").val(); // ⬅️ Get selected location

        if (!bookingType) {
            $('.staff_id').html('<option value="">Select</option>');
            return;
        }

        $('.staff_id').html('<option value="">Loading...</option>');

        $.ajax({
            url: '<?= base_url("admin/enquiry/get_users_by_booking_types") ?>',
            type: 'GET',
            data: { 
                booking_type: bookingType, 
                location: selectedLocation
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    var users = response.data;
                    var options = '<option value="all">All</option>';

                    $.each(users, function (i, user) {
                        var label = user.name + (user.hod === 'yes' ? ' (HOD)' : '');
                        var style = user.status == 2 ? 'style="color:red;"' : '';
                        var title = user.status == 2 ? 'title="User In-active no longer work with us"' : '';
                        var selected = (selectedStaffId && user.id == selectedStaffId) ? 'selected="selected"' : '';
                        options += '<option value="' + user.id + '" ' + style + ' ' + title + ' ' + selected + '>' + label + '</option>';
                    });

                    $('.staff_id').html(options);
                } else {
                    $('.staff_id').html('<option value="">No users found</option>');
                }
            },
            error: function () {
                $('.staff_id').html('<option value="">AJAX error occurred</option>');
            }
        });
    }

    // Initial population on page load
    var selectedLocation = $(".location").val();
    updateBookingTypesFromLocation(selectedLocation, bookingTypeFromURL);

    // When location is changed, update booking type dropdown
    $(".location").on("change", function () {
        var newLocation = $(this).val();
        updateBookingTypesFromLocation(newLocation, "");
        var newBookingType = $('.booking_type').val();
        getUsersByBookingType(newBookingType);
    });

    // When booking type is changed, update users list
    $('.booking_type').on('change', function () {
        var newBookingType = $(this).val();
        getUsersByBookingType(newBookingType);
    });
});
</script>
<?php  } ?>
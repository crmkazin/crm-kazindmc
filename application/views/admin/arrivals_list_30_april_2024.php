<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
<?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
<?php   include('side_bar.php');?>
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="icon-and-text-button-demo">
                        <a href="<?php echo base_url('arrivals'); ?>" class="btn btn-info waves-effect"  style="margin-left:5px;">
                            <i class="material-icons">supervisor_account</i><br>
                            <span>Arrivals</span>
                        </a>
                        
                    </div>
                </div>
                    </div>
                    
                    
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Arrivals</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Arrivals</li>
                            </ol>
                        </div>
                    </div>			
<?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
		
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Arrivals</header>
                                    
                                    <div class="tools" style="display:block">
                                        <a href="<?php echo base_url('excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-sm btn-primary" style="padding:6px;" title="Download Excel" target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                    <div class="row">                                        
                                        <div class="col-lg-12"><h4>Search</h4></div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value=""></option>
                                                    <?php 
                                                    asort($locations);
                                                    foreach($locations AS $key=>$val){ //$val[]='All'; 
                                                    if($this->session->userdata('locations')==$key || $this->session->userdata('locations')=='all'){
                                                    ?>
                                                    <option value="<?=$key?>" data-abbr="<?=implode(',',$val)?>"><?= ucfirst($key)?></option>
                                                    <?php }} ?>
                                                </select>                                                
                                                <label class = "mdl-textfield__label">Location</label>	 	 
                                            </div>
                                        </div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="staff_id" id="staff_id" class="mdl-textfield__input" style="padding: 10px;">
                                                    <option value=""></option>
                                                    
                                                </select>                                                
                                                <label class = "mdl-textfield__label">Staff</label>	 	 
                                            </div>
                                        </div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="booking_type" id="booking_type" class="mdl-textfield__input" style="padding: 10px;">
                                                </select>                                                
                                            <label class = "mdl-textfield__label">Booking Type</label>	 	 
                                            </div>
                                        </div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                <input type="text" name="" class="mdl-textfield__input dt-search-show" style="width:90%;" value="<?php echo ($this->input->get('date_from')<>'')?date('d-M-Y',strtotime($this->input->get('date_from'))):''; ?>" readonly>
                                                <?php echo form_input(['type'=>'date','name'=>'date_from','placeholder'=>'','id'=>'date_from','class'=>'mdl-textfield__input dt-search','value'=>($this->input->get('date_from')<>'')?$this->input->get('date_from'):'','style'=>'width:10%;float:right;'])?>			 
                                            <label class = "mdl-textfield__label">From</label>	 	 
                                        </div>
                                        </div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                <input type="text" name="" class="mdl-textfield__input dt-search-show" value="<?php echo ($this->input->get('date_to')<>'')?date('d-M-Y',strtotime($this->input->get('date_to'))):''; ?>" style="width:90%;" readonly>
                                                <?php echo form_input(['type'=>'date','name'=>'date_to','id'=>'date_to','placeholder'=>'','class'=>'mdl-textfield__input dt-search','value'=>($this->input->get('date_to')<>'')?$this->input->get('date_to'):'','style'=>'width:10%;float:right;'])?>			 
                                            <label class = "mdl-textfield__label">To</label>	 	 
                                        </div>
                                        </div>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="status" id="status" class="mdl-textfield__input" style="padding: 10px;"> 
                                                <option value=""></option>
                                                <option value="in-progress" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>In-progress</option>
                                                <option value="complete" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='complete')?'selected="selected"':''; ?>>Complete</option>
                                                <option value="cancel"   <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel')?'selected="selected"':''; ?>>Cancel</option>
                                                <option value="file-closed" <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>File Closed</option>
                                            </select>  			 
                                            <label class = "mdl-textfield__label">Status</label>	 	 
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name'=>'query_number','id'=>'query_number','class'=>'mdl-textfield__input','value'=>($this->input->get('query_number')<>'')?$this->input->get('query_number'):''])?>			 
                                            <label class = "mdl-textfield__label">Query Number</label>	 	 
                                        </div>
                                        </div>
                                        <?php 
                                        $country =['kazakhstan'=>'K','azerbaijan'=>'A','belarus'=>'B','georgia'=>'G'];                                        
                                        ?>
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="country" id="country" class="mdl-textfield__input" style="padding: 10px;"> 
                                                <option value="">Select..</option>
                                                <?php if($this->session->userdata('locations')=='all'){ ?>
                                                <option value="A" <?php echo ($this->input->get('country')<>'' && $this->input->get('country')=='A')?'selected="selected"':''; ?>>Azerbaijan</option>
                                                <option value="B" <?php echo ($this->input->get('country')<>'' && $this->input->get('country')=='B')?'selected="selected"':''; ?>>Belarus</option>
                                                <option value="G" <?php echo ($this->input->get('country')<>'' && $this->input->get('country')=='G')?'selected="selected"':''; ?>>Georgia</option>
                                                <option value="K" <?php echo ($this->input->get('country')<>'' && $this->input->get('country')=='K')?'selected="selected"':''; ?>>Kazakhstan</option>
                                                <option value="all" <?php echo ($this->input->get('country')<>'' && $this->input->get('country')=='all')?'selected="selected"':''; ?>>All</option>
                                                <?php }else if(array_key_exists(strtolower($this->session->userdata('locations')), $country)){ ?>
                                                <option value="<?php echo $country[$this->session->userdata('locations')]; ?>" <?php echo ($this->input->get('country')<>'' && $this->input->get('country')==$country[$this->session->userdata('locations')])?'selected="selected"':''; ?>><?php echo ucfirst($this->session->userdata('locations')); ?></option>
                                                <?php } ?>
                                            </select>
                                            <label class = "mdl-textfield__label">Country</label>	 	 
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-2"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-primary', 'value'=>'Search']);?>		 	 
                                            
                                            </div>
                                        </div>                                        
                                    </div>
                                    </form>
                                    <div class="table-scrollable">
                                       
                                    
                                    <div class="row mb-3 prog-4">
                                        <div class="col-lg-3">
                                            <span class="line-num text-white bg-perp"><?php echo (isset($counts['in-progress'])?$counts['in-progress']:'0'); ?></span>  In-Progress  
                                        </div>
                                        <div class="col-lg-3">
                                            <span class="line-num text-white bg-green"><?php echo (isset($counts['complete'])?$counts['complete']:'0'); ?></span>  Complete
                                        </div>
                                        <div class="col-lg-3">
                                            <span class="line-num text-white" style="background-color:#b20783;"><?php echo (isset($counts['file-closed'])?$counts['file-closed']:'0'); ?></span>  File Closed
                                        </div>
                                        <div class="col-lg-3">
                                            <span class="line-num text-white bg-danger" ><?php echo (isset($counts['cancel'])?$counts['cancel']:'0'); ?></span> Cancel
                                        </div>
                                    </div>
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">S.No.</th>
                                                <th class="center">Query <br>Number</th>
                                                <th class="center">Physical <br>Arrival<br> Date</th>
                                                <th class="center">Number Of<br> Nights</th>
                                                <th class="center">Handling <br>Staff <br>Name</th>
                                                <th class="center">Transportation</th>
                                                <th class="center">Guide</th>
                                                <th class="center">Group <br>Type</th>
                                                <th class="center">Handover <br>To <br>Client</th>	
                                                <th class="center">Nos. of<br>Guests</th>
                                                <th class="center">Company Name</th>
                                                <?php  if(in_array($this->session->userdata('type'),['1','3'])){ ?>
                                                <th class="center">Currency</th> 
                                                <th class="center">Client <br>Billing</th>
                                                <th class="center">Payment <br>Received <br>In India</th> 
                                                <th class="center">Payment <br>Received <br>In Almaty</th>
                                                <th class="center">Balance <br>Amount</th>
                                                <th class="center">Remarks</th>
                                                <?php } ?>
                                                <th class="center">Status</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php     
                                        $records_cnt=0;
                                        if(!empty($result)) {
                                           $i=$offset+1;
                                        foreach($result as $list) {
                                            $records_cnt++;
                                            $enq_id = $list->enquiry_id;
                                            $where = 'arrival_flight_details.enquiry_id= '.$enq_id;
                                            $flight_details = $this->common_model->get_data('arrival_flight_details','', '', '*',$where,'', $count = false);
                                            //echo '<pre>';print_r($flight_details);
                                            
                                            $arrival_date = date_create($list->arrival_date);
                                            $days_to_add = $list->number_of_nights + 1;
                                            date_add($arrival_date,date_interval_create_from_date_string($days_to_add.' days'));
                                            $d1_arrival = date_format($arrival_date,'Y-m-d');
                                            $d2_today = date('Y-m-d');
                                            $auto_updated = 0;
                                            if($d1_arrival < $d2_today && $list->status == 'in-progress' /*&& $list->enquiry_no=='FAZ3706'*/){
                                                $update_arr = array('status'=>'complete');
                                                $id = $list->id;
                                                $update_data = ['table_name'=>'arrivals','update_data'=>$update_arr,'condition'=>['id'=>$id]];
                                                $affected_rows = $this->common_model->update_data_limit($update_data);
                                                if($affected_rows){
                                                    $list->status = 'complete';
                                                    $auto_updated = 1;
                                                }
                                            }
                                            if($d1_arrival < $d2_today && $list->status == 'complete' && $list->balance_amount == '0' /*&& $list->enquiry_no=='FAZ3706'*/){
                                                $update_arr = array('status'=>'file-closed');
                                                $id = $list->id;
                                                $update_data = ['table_name'=>'arrivals','update_data'=>$update_arr,'condition'=>['id'=>$id]];
                                                $affected_rows = $this->common_model->update_data_limit($update_data);
                                                if($affected_rows){
                                                    $list->status = 'file-closed';
                                                    $auto_updated = 1;
                                                }
                                            }
                                            
                                            $where = 'payment_details.arrival_id= '.$list->id;
                                            $select = 'payment_details.remarks';
                                            $payment_details_remarks = $this->common_model->get_data('payment_details','', '', $select,$where,' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
                                            $remarks = (!empty($payment_details_remarks))?$payment_details_remarks[0]->remarks:'';
                                        ?>
                                             <?php
                                                    $status_color = ['in-progress'=>'#663399','complete'=>'#18ce0f','cancel'=>'#FF3636','file-closed'=>'#b20783'];
                                                    $status = $list->status;
                                                     ?>
                                                     
                                                   <tr class="odd gradeX">
                                                <td class="center"><?=$i++?></td>
                                                                              
                                                  <?php if($status=="cancel") { ?>
                                             
                                                 <td class="center" style="background-color: <?=$status_color[$status]?>;"><?=$list->enquiry_no?></td>
                                                <td class="center" style="background-color: <?=$status_color[$status]?>;"><?= date('d-M-Y',strtotime($list->arrival_date))?></td>
                                            <?php } else { ?>
                                            <td class="center"><?=$list->enquiry_no?></td>
                                                <td class="center"><?= date('d-M-Y',strtotime($list->arrival_date))?></td>
                                            <?php } ?>
                                                <td class="center"><?=$list->number_of_nights?></td>
                                                <td class="center"><?=$list->staff_name?></td>                                                
                                                <td class="center"><?=$list->vehicle_type?></td>
                                                <td class="center"><?php echo ($list->guide<>'')?$list->guide:'<i class="fa fa-user-times" aria-hidden="true" title="No Guide" style="color: #ffb1b1;"></i>' ?></td>
                                                <td class="center"><?=$list->group_type?></td>                                                                                                
                                                <td class="center"><?=$list->handover_to_client?></td>
                                                <td class="center"><?=(($list->number_persons=='')?'0':$list->number_persons) + (($list->number_child=='')?'0':$list->number_child) ?></td>
                                                <td class="center"><?=$list->name?></td>
                                            <?php  if(in_array($this->session->userdata('type'),['1','3'])){ ?>
                                                <td class="center"><?=$list->currency?></td>
                                                <td class="center"><?=$list->client_billing?></td>
                                                <td class="center"><?=$list->payment_received_india?></td>
                                                <td class="center"><?=$list->payment_received_almaty?></td>
                                                <td class="center"><?=$list->balance_amount?></td>
                                                <td class="center"><?=$remarks?></td>
                                            <?php } ?>
                                                <td class="center">
                                                  
                                                     
                                                     
                                                     
                                                    <a class="btn btn-xs" style="background-color: <?=$status_color[$status]?>;color:#FFF;" href="#"><?=ucfirst($status)?></a>
                                                    <?php if($auto_updated){ ?>
                                                    <span class="badge badge-warning"><i class="fa fa-hand-o-right"></i> Auto-updated At <?php echo date('Y-m-d H:i:s'); ?></span>
                                                    <?php } ?>
                                                    </td>
                                                    
                                                  <td style="display:flex;">                                                    
                                                    <?php if(count($flight_details) == 2 && in_array($flight_details[0]->flight_mode,['inbound','outbound']) && in_array($flight_details[1]->flight_mode,['inbound','outbound']) && $flight_details[0]->flight_mode != $flight_details[1]->flight_mode){ ?>
                                                      <a href="<?=base_url('create-itinerary?id='.base64_encode($list->id)) ?>" class="" title="Itinerary" style="margin-right: 10px;margin-top: 3px;" target="_blank"><i class="fa fa-calendar"></i></a>    
                                                    <?php }else{ ?>
                                                      <span class="" data-toggle="tooltip" title="Improper Flight Details" style="margin-right: 10px;margin-top: 3px;color: #ff5555;"><i class="fa fa-calendar"></i></span>
                                                    <?php } ?>
                                                    <a href="<?=base_url('print_service_voucher?id='.base64_encode($list->id)) ?>" class="btn btn-tbl-edit btn-xs" title="Print Service Voucher" style="background-color:#2CA8FF;" target="_blank"><i class="fa fa-print"></i></a> 
                                                    <a href="<?=base_url('print_file_arrival?id='.base64_encode($list->id)) ?>" class="btn btn-tbl-edit btn-xs" title="Print File Arrival Details" style="background-color:#ffc107;" target="_blank"><i class="fa fa-print"></i></a>    
                                                    <a href="<?=base_url('edit_arrival?id='.base64_encode($list->id)) ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>    
                                                    <?php //if($this->session->userdata('type') == 1){?>
                                                    <!--a href="<?php //echo base_url().base64_encode($list->id)?>/delete-arrival" onclick="return confirm('Are you sure you want to delete this Arrival?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o"></i></a-->
                                                    <?php //} ?>
                                                </td>
                                            </tr>
                                        <?php } }?>	
                                        </tbody>
                                    </table>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php //echo 'Showing '.$records_cnt.' of '.$total.' Records'; ?>
                                    <?php echo $links; ?></div>
                            </div>                             
                        </div>                        
                    </div> 					
					
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
<?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
<?php include('admin_footer_js.php');?>
    <!-- end js include path -->
<script>
    $(document).ready(function() {   
        $("#location").on("change",function(){
            var v = $(this).find(':selected').attr('data-abbr');
            $("#booking_type").empty().parent().removeClass("is-dirty");
            if(v !== "" && v !== undefined){
                var opts = v.split(",");
                $("#booking_type").parent().addClass("is-dirty");
                $.each(opts, function(i, d) {
                   $('#booking_type').append('<option value="' + d +'">' + d + '</option>');
                });
                $('#booking_type').append('<option value="all">All</option>');
                get_staff();
            }
        });
        
        $('[data-toggle="tooltip"]').tooltip();
        
        $(".dt-search").on("change",function(){        
            var idx = $(this).index(".dt-search");
            const selectedDate = new Date($(".dt-search").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = { year: 'numeric', month: 'short', day: '2-digit' };
            const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
            $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
            
            if($(this).attr("id") === "date_from" && $("#date_to").val() === ""){
                $("#date_to").attr("min",$(this).val());
            }else if($(this).attr("id") === "date_from" && $("#date_to").val() !== ""){
                const selectedToDate = new Date($("#date_to").val());
                if(parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())){
                    $("#date_to").val('').attr("min",$(this).val());
                    $(".dt-search-show").eq($("#date_to").index(".dt-search")).val('');
                }
            }
            if($(this).attr("id") === "date_to" && $("#date_from").val() === ""){
                $("#date_from").attr("max",$(this).val());
            }else if($(this).attr("id") === "date_to" && $("#date_from").val() !== ""){
                const selectedFromDate = new Date($("#date_from").val());
                if(parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())){
                    $("#date_from").val('').attr("max",$(this).val());
                    $(".dt-search-show").eq($("#date_from").index(".dt-search")).val('');
                }
            }
            
        });
        
    });
    
    function get_staff(){
        if($("#location").val() === "") { $("#staff_id").empty(); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/enquiry/get_staff",
            data:{'location':$("#location").val()},
            dataType:"JSON",
            success: function(data){
                $("#staff_id").empty().parent().addClass("is-dirty");
                var opts = data.details;
                $.each(opts, function(i, d) {
                   $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] + '</option>');
                });
                $('#staff_id').append('<option value="all">All</option>');
            },
                error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
    
    
</script>
</body>
</html>
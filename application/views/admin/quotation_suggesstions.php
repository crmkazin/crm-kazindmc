<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <style>
    .img-width {
        max-width: 80px;
    }
    div.info>div {
        border: 1px solid #efecec;
    }
    </style>
    <!-- Include CSS files -->
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="icon" type="image/png" href="<?=base_url();?>assets/images/favicon.ico" sizes="32x32" />
</head>

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- Include header -->
        <?php include ('header.php'); ?>

        <div class="page-container">
            <!-- Include sidebar menu -->
            <?php include ('side_bar.php'); ?>

            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Quotation</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"><a class="parent-item" href="<?= base_url(); ?>enquiry-followup">Quotation Builder</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Quotation Builder</header>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="" autocomplete="off" onsubmit="">
                                        <div class="card-body row">
                                            <div class="col-lg-12">
                                                <?php echo $this->session->flashdata('message');
                                                    unset($_SESSION['message']);
                                                     ?>
                                            </div>
                                            <div class="col-lg-12 p-2">
                                                <div class="row info bold">
                                                    <div class="offset-1 col-lg-2 p-2">
                                                        <span><?php echo $details->enquiry_no; ?></span>
                                                    </div>                                                    
                                                    <div class="col-lg-2 p-2">
                                                        <span>Guests</span> :
                                                        <?php echo $details->number_persons + $details->number_child; ?>
                                                        (<?php echo $details->number_persons; ?>A+<?php echo $details->number_child; ?>C)                                                        
                                                    </div>
                                                    <div class="col-lg-2 p-2">
                                                        <span>Check-in Date</span> :
                                                        <?php echo $details->check_in_date; ?>
                                                    </div>
                                                    <div class="col-lg-2 p-2">
                                                        <span>Check-out Date</span> :
                                                        <?php echo $details->check_out_date; ?>
                                                    </div>
                                                    <div class="col-lg-2 p-2">
                                                        <span>Duration</span> :
                                                        <?php echo $details->number_of_nights; ?>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-lg-12 p-2 <?=($details->number_child)?'':'hide';?>">
                                                <div class="row info">
                                                    <div class="offset-1 col-lg-10 p-2">
                                                        <?php for($i=1;$i<=$details->number_child;$i++){ ?>
                                                        <span class="mr-2">Child <?php echo $i; ?> Age : <select name="child_age[]">
                                                        <?php for($age=1;$age<=12;$age++){ ?> 
                                                                <option value="<?=$age?>"><?=$age?></option>
                                                        <?php } ?></select></span> 
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
											<div class="col-lg-12 p-t-20">
                                                <div class="panel panel-info">
												  <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Select Itinerary</div>
												  <div class="panel-body row" id="">
                                                    <?php
                                                    foreach($itinerary AS $list){ ?>
                                                        <div class="col-md-1"><input type="radio" value="<?php echo $list->arrival_id; ?>" name="rdo_itinerary"> <a href="<?php echo base_url('print_service_voucher?id='.base64_encode($list->arrival_id)); ?>" target="_blank"><?=$list->enquiry_no?></a></div>
                                                    <?php } ?>
												  </div>
												</div>
                                            </div>
                                            
                                            <div class="col-lg-12 p-t-20">
                                                <div class="panel panel-info">
												  <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Select Transportation</div>
												  <div class="panel-body row" id="">
                                                    <?php
                                                    foreach($transportation AS $list){ ?>
                                                        <!--div class="col-md-4"><input type="checkbox" value="<?php //echo $list->id;  ?>" name="transportations[]"> <label><?php //echo $list->vehicle_name.' (Capacity: '.$list->capacity.')'; ?></label></div-->
                                                        <div class="col-md-4"><input type="radio" value="<?php echo $list->id;  ?>" name="rdo_transportations"> <label><?php echo $list->vehicle_name.' (Capacity: '.$list->capacity.')'; ?></label></div>
                                                    <?php } ?>
												  </div>
												</div>
                                            </div>
                                            
                                            <div class="col-lg-12 p-t-20">
                                                <div class="panel panel-info">
												  <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Select Hotels</div>
												  <div class="panel-body row" id="">
                                                    <?php
                                                    foreach($hotels AS $list){ ?>
                                                        <!--div class="col-md-4"><input type="checkbox" value="<?php //echo $list->id;  ?>" name="hotels[]"> <label><?=$list->name?></label></div-->
                                                        <div class="col-md-4"><input type="radio" value="<?php echo $list->id;  ?>" class="hotel" name="hotels"> <label><?=$list->name?></label></div>
                                                    <?php } ?>
												  </div>
												</div>
                                            </div>
                                            
                                        </div>
                                    </form>
                                    
                                </div>
                               
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        
    <div class="modal fade" id="modalCost-show" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width:1150px;border:5px solid #d6deff;">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#eff3f6;padding:2px 10px">
                    <h4 class="modal-title">Hotel Detail Prices</h4>
                    <button type="button" class="close pricing-modal" data-dismiss="modal" id="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('quotation_create'); ?>" autocomplete="off" id="frm-quotation" onsubmit="">
                    <div id="response-message"></div>
                    <div class="row">
                        <div class="col-lg-12 p-2">
                            <div class="row info">
                                <div class="offset-1 col-lg-2 p-2">
                                    <span><?php echo $details->enquiry_no; ?></span>
                                </div>                                                    
                                <div class="col-lg-2 p-2">
                                    <span>Guests</span> :
                                    <?php echo $details->number_persons + $details->number_child; ?>
                                    (<?php echo $details->number_persons; ?>A+<?php echo $details->number_child; ?>C)                                                        
                                </div>
                                <div class="col-lg-2 p-2">
                                    <span>Check-in Date</span> :
                                    <?php echo $details->check_in_date; ?>
                                </div>
                                <div class="col-lg-2 p-2">
                                    <span>Check-out Date</span> :
                                    <?php echo $details->check_out_date; ?>
                                </div>
                                <div class="col-lg-2 p-2">
                                    <span>Duration</span> :
                                    <?php echo $details->number_of_nights; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12" id="prices">
                            <div class="panel panel-info">                              
                              <div class="panel-body" id="">
                                    <div class="row"><div class="col-md-12 center"><h5 class="hotel-name" style="font-weight:500;"></h5></div></div>
                                    <div class="panel-content">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <input type="hidden" name="check_in" id="check_in" value="<?=$details->check_in_date ?>">
                        <input type="hidden" name="check_out" id="check_out" value="<?=$details->check_out_date ?>">
                        <div class="col-lg-12">
                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:right;', 'value' => 'Proceed','formtarget'=>"_blank"]); ?>
                        </div>
                    </div>
                    <input type="hidden" name="itinerary" id="itinerary">
                    <input type="hidden" name="transportations" id="transportations">
                    
                    </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>


    <script>
        $(document).ready(function() {        
            $(".hotel").on("click",function(){                
                if($("input[name='rdo_itinerary']:checked").val() == undefined || $("input[name='rdo_itinerary']:checked").val()== ""){
                    alert("Select Itinerary To Make Quotation.");
                    return false;
                }
                $("#modalCost-show").modal("toggle");
                $("#itinerary").val($("input[name='rdo_itinerary']:checked").val());
                $("#transportations").val($("input[name='rdo_transportations']:checked").val());
                var html = '';
                var category_arr = [];
                var hotel_id = $('input[name="hotels"]:checked').val();
                $("#prices").removeClass("hide");
                $.ajax({
                    url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                    type: "post",
                    data: {'hotel_id':hotel_id,'check_in':$("#check_in").val(),'check_out':$("#check_out").val()},
                    dataType: 'JSON',
                    //contentType: false,
                    //processData: false,
                    success: function(data) {
                        if (data.response === "s") {                            
                            if(data.details.result.length>0){
                                $(".hotel-name").html(data.details.result[0].name);
                                $.each(data.details.result, function(i, val) {
                                    var hotel_prices = chk_persons = is_chk = '';                                    
                                    html += '<div class="row p-1" style="border-bottom:1px solid #e9e9e9;">';
                                    html += '<div class="col-md-6"><label class="bold"><input type="checkbox" id="chk_'+val.id+'" value="'+val.id+'_'+val.category_name+'" name="category_ids[]"> '+val.category_name+'</label></div><div class="col-md-1" style="margin:inherit;">Rooms</div><div class="col-md-2 text-center">Check In</div><div class="col-md-2 text-center">Check Out</div><div class="col-md-1"><button type="button" data-id="'+val.id+'" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></div>';
                                    html += '<div class="col-md-12 row prices-div-'+val.id+'" id="prices-div_'+val.id+'"><div style="background-color: #eeeff1;" class="col-md-6 mb-1"><div class="row">';
                                    hotel_prices = val.details.split(",");
                                    $.each(hotel_prices, function(i, v) {
                                        /*chk_persons = v.split(" ");
                                        is_chk = '';
                                        if(chk_persons[0] == $("#adults_number").val() || chk_persons[0] == $("#child_number").val()){ 
                                            is_chk = 'checked="checked"'; 
                                            category_arr.push("chk_"+val.id);
                                        }*/
                                        html += '<div class="col-md-4"><input type="checkbox" class="chk-prices" data-id="'+val.id+'" value="'+v+'" name="'+val.id+'_hotel_prices[0][]"> <label>'+v+'</label></div>';
                                    });
                                    html += '</div></div><div class="col-md-1"><input type="number" min="1" class="form-control" value="1" name="'+val.id+'_room_cnt[0]"></div><div class="col-md-2"><input type="date" class="form-control" name="'+val.id+'_checkin_date_cnt[0]"></div><div class="col-md-2"><input type="date" class="form-control" name="'+val.id+'_checkout_date_cnt[0]"></div></div><div class="col-md-1"></div></div>';
                                });                                
                            }else { 
                                $(".hotel-name").html('');
                                html = 'No Prices Found';
                            }
                            $(".panel-content").html(html);
                            if(category_arr.length > 0){
                                $.each(category_arr, function(i, v) {
                                    $("#"+v).attr("checked","checked");
                                });
                            }
                        } 
                    }
                });
            });
            
            $("#frm-quotation").on("click",".add",function(){
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
            
            $("#frm-quotation").on("click", '.div_remove', function(e) {
                 $(this).parent().parent().remove();
            });
            
            $("#frm-quotation").on("click",".chk-prices",function(){
                var category_id = $(this).attr("data-id");
                $("#chk_"+category_id).attr("checked",false);
                $("input[name='"+category_id+"_hotel_prices[0][]']").each(function (index, obj) {
                    if(this.checked){ $("#chk_"+category_id).attr("checked","checked"); }
                });
            });
            
        });
    
    </script>

</body>

</html>
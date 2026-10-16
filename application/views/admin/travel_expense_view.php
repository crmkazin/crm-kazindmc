<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
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
<?php  include('side_bar.php');?>
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    
                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="icon-and-text-button-demo">
                        <a href="<?=base_url();?>expenses/travel" class="btn btn-success waves-effect">
                            <i class="material-icons">local_airport</i><br>
                            <span>Travel</span>
                        </a>
                        <a href="<?=base_url();?>expenses/miscellinous-expenses" class="btn btn-info waves-effect">
                            <i class="material-icons">restaurant</i><br>
                            <span>Miscellaneous</span>
                        </a>
                        <a href="<?=base_url();?>expenses/intercity-expenses" class="btn btn-primary waves-effect">
                            <i class="material-icons">directions_car</i><br>
                            <span>Intercity</span>
                        </a>
                    </div>
                </div>
                    </div>
                    
                    
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Expenses</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>expenses/travel-expenses-details">Expenses</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Travel</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>						
 -->                <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                    <div class="card-head">
                                        <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                        <i class="material-icons">arrow_back</i>
                                        </button>
                                            <header>Travel Expenses</header>
                                            <div class="tools">
                                                <a href="travel-expenses-details" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i> List</a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            </div>
                                    </div>	
                                <form method="post" name="myForm" id="frmtravel" onsubmit="" autocomplete="off" enctype="multipart/form-data">
                                    <div class="card-body row">																																																						

                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <?php echo form_input(['name'=>'claimer_name','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('claimer_name')])?>			 
                                <label class = "mdl-textfield__label">Name</label><?php echo form_error('claimer_name');?>		 	 
                              </div>
                                </div>   
                                          
                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                
                                <select name="grade" id="" class="mdl-textfield__input" Required>
                                        <option value=""></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>	  
                                <label class = "mdl-textfield__label">Grade</label><?php echo form_error('grade');?>		 	 
                              </div>
                                </div>   
                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <?php echo form_input(['name'=>'location','id'=>'location', 'class'=>'mdl-textfield__input', 'value'=>set_value('location')])?>			 
                                <label class = "mdl-textfield__label">Location</label><?php echo form_error('location');?>		 	 
                              </div>
                                </div>      

                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                      <input type="text" name="bill_date" id="bill_date" value="<?php echo date('d-m-Y'); ?>" class="mdl-textfield__input" >
                                <label class = "mdl-textfield__label">Bill Date</label>	 	 
                              </div>
                                </div>

                                
                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                      <input type="text" name="traveled_on" id="traveled_on" value="<?php //echo date('Y-m-d'); ?>" class="mdl-textfield__input dts" >
                                <label class = "mdl-textfield__label">Traveled On</label>	 	 
                              </div>
                                </div>
                              
                                        
                               <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                     <input type="text" name="returned_on" id="returned_on" value="<?php //echo date('Y-m-d'); ?>" class="mdl-textfield__input dts" >
                                <label class = "mdl-textfield__label">Returned On</label>	 	 
                              </div>
                                </div>                                         
                            
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <?php echo form_input(['name'=>'city_visited','id'=>'city_visited', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('city_visited')])?>    
                                    <label class = "mdl-textfield__label">City Visited</label><?php echo form_error('city_visited');?>		 	 
                              </div>
                                </div>									
                            
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <?php echo form_input(['name'=>'duration','id'=>'duration', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('duration')])?>    
                                    <label class = "mdl-textfield__label">Duration</label><?php echo form_error('duration');?>			 	 
                              </div>
                                </div>
                              
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <?php echo form_input(['name'=>'visited_for','id'=>'visited_for', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('visited_for')])?>    
                                    <label class = "mdl-textfield__label">Visited For</label><?php echo form_error('visited_for');?>		 	 
                              </div>
                                </div>									
                            
                            <!--<div class="col-lg-6 p-t-20"> -->
                            <!--      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 -->
                            <!--    <?php echo form_input(['name'=>'bill_amount','id'=>'bill_amount', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('bill_amount')])?>    -->
                            <!--        <label class = "mdl-textfield__label">Bill Amount</label><?php echo form_error('bill_amount');?>		 	 -->
                            <!--  </div>-->
                            <!--    </div>                          -->
                                        
                        </div>
                        <div class="card-header">
                            <div class="col-lg-12"><h4><strong>Intercity Travel</strong></h4></div>
                        </div>						
                        <div class="card-body intercity_cls" id="intercity"> 
                            <div class="row">
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'travel_date[]','id'=>'','placeholder'=>'Travel Date', 'class'=>'mdl-textfield__input datepicker', 'value'=>''])?>		
                        	 
                            <label class = "mdl-textfield__label">Date</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <!-- <?php echo form_input(['name'=>'intercity_travel_mode[]','placeholder'=>'Mode','type'=>'text','id' =>'', 'class'=>'mdl-textfield__input', 'value'=>''])?> -->
                                    <select name="intercity_travel_mode[]" id="" class="mdl-textfield__input" style="padding:9px;">
                                        <option value=""></option>
                                        <option value="By Air">By Air</option>
                                        <option value="By Train">By Train</option>
                                        <option value="By Bus">By Bus</option>
                                        <option value="By Taxi">By Taxi</option>
                                        <option value="By Personal Car">By Personal Car</option>
                                        <option value="By Office Car">By Office Car</option>
                                        <option value="By Ship">By Ship</option>
                                    </select> 			 
                            <label class = "mdl-textfield__label">Mode</label> 	 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'from_place[]','id'=>'from_place','placeholder'=>'From Place',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">From</label>	 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'to_place[]','id'=>'to_place','placeholder'=>'To Place',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">To</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'departure_time[]','id'=>'to_place','placeholder'=>'DP Time',  'class'=>'mdl-textfield__input', 'value'=>'','type'=>'time'])?>			 
                            <label class = "mdl-textfield__label">DP Time</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'arrival_time[]','id'=>'arrival_time','placeholder'=>'AR Time',  'class'=>'mdl-textfield__input', 'value'=>'','type'=>'time'])?>			 
                            <label class = "mdl-textfield__label">AR Time</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'intercity_travel_amount[]','id'=>'amount','placeholder'=>'Amount',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">Amount</label>		 	 
                          </div>
                            </div>
                            </div>
                        </div>								
                        
                        <div class="card-body row">
                            <div class="col-md-2">
                                <label style="font-size: 16px;">Attach Bills:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="block float-right">                                    
                                    <input type="file" name="intercity_travel_bills[]" multiple="">                      
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="block float-right">
                                    <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('intercity')"></i></span>
                                </div>
                            </div>
                        </div>                                    
                                    
                        <div class="card-header">
                                <div class="col-lg-12"><h4><strong>Local Travel</strong></h4></div>
                            </div>						
                            <div class="card-body local_cls" id="local"> 
                                <div class="row">
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'local_travel_date[]','id'=>'','placeholder'=>'Travel Date', 'class'=>'mdl-textfield__input datepicker', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">Date</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-3 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'from_local_place[]','id'=>'','placeholder'=>'From Local Place',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">From</label>	 	 
                              </div>
                                </div>
                                <div class="col-lg-3 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'to_local_place[]','id'=>'','placeholder'=>'To Local Place',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">To</label>		 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <!-- <?php echo form_input(['name'=>'mode[]','id'=>'','placeholder'=>'Mode of Travel',  'class'=>'mdl-textfield__input', 'value'=>''])?>	 -->
                            <select name="mode[]" id="" class="mdl-textfield__input" style="padding:9px;">
                                        <option value=""></option>
                                        <option value="By Local Train / Metro">By Local Train / Metro</option>
                                        <option value="By Bus">By Bus</option>
                                        <option value="By Taxi">By Taxi</option>
                                        <option value="Personal Car">By Personal Car</option>
                                        <option value="By Personal Car">By Office Car</option>
                                        <option value="By Bike">By Bike</option>
                                        <option value="By Auto">By Auto</option>
                                        <option value="By Ship">By Ship</option>
                                    </select>  		 
                                <label class = "mdl-textfield__label">Mode </label>		 	 
                              </div>
                                </div>                                
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'local_amount[]','id'=>'','placeholder'=>'Amount',  'class'=>'mdl-textfield__input', 'value'=>'','type'=>'number'])?>			 
                                <label class = "mdl-textfield__label">Amount</label>		 	 
                              </div>
                                </div>
                                </div>
                                
                            </div>
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-right">                                    
                                        <input type="file" name="local_travel_bills[]" multiple="">                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="block float-right">
                                        <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('local')"></i></span>
                                    </div>
                                </div>
                            </div>                                    
                                    
                            <div class="card-header">
                                <div class="col-lg-12"><h4>Accomodation & Food</h4></div>
                            </div>						
                                    <div class="card-body acc_food_cls" id="acc_food"> 
                                <div class="row">
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'acc_food_city_visited[]','id'=>'acc_food_city_visited','placeholder'=>'City Visited', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">City Visited</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'hotel[]','id'=>'','placeholder'=>'Amount',  'class'=>'cost mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">Hotel (Cost)</label>		 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'food[]','id'=>'','placeholder'=>'Amount',  'class'=>'cost mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">Food (Cost)</label>	 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'hour_day[]','id'=>'','placeholder'=>'No. of Days',  'class'=>'cost mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">No. of Days</label>		 	 
                              </div>
                                </div>                                
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'acc_food_amount[]','id'=>'','placeholder'=>'Amount',  'class'=>'total_amt mdl-textfield__input', 'value'=>'','type'=>'number','readonly'=>'readonly'])?>			 
                                <label class = "mdl-textfield__label">Amount</label>		 	 
                              </div>
                                </div>
                                </div>                                
                            </div>
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-right">                                    
                                        <input type="file" name="accomodation_food_bills[]" multiple="">                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="block float-right">
                                        <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('acc_food')"></i></span>
                                    </div>
                                </div>
                            </div>                                    
                                    
                            <div class="card-header">
                                <div class="col-lg-12"><h4>Miscellaneous</h4></div>
                            </div>						
                            <div class="card-body miscellaneous_cls" id="miscellaneous"> 
                                <div class="row">
                                <div class="col-lg-8 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'expenses[]','id'=>'','placeholder'=>'Expense With Remarks', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                                <label class = "mdl-textfield__label">Expense With Remarks</label>	 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'expense_amount[]','id'=>'','placeholder'=>'Amount',  'class'=>'mdl-textfield__input', 'value'=>'','type'=>'number'])?>			 
                                <label class = "mdl-textfield__label">Amount</label>		 	 
                              </div>
                                </div>
                                </div>                                
                            </div>
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-right">                                    
                                        <input type="file" name="miscellaneous_bills[]" multiple="">                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="block float-right">
                                        <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('miscellaneous')"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-offset-5 col-md-6">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success float-right"/>
                                </div>
                            </div>    
                        </form>
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
    
    $('#bill_date').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY'
    });
    
    $('#traveled_on, #returned_on').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY'
    });
    
    
    
    $(function(){
        $(".row").on('focus', '.datepicker', function(e){
            $(this).datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd-mm-yy',
            });
        });
    });
    
    function add_element(id){
        //alert(id);
        event.preventDefault();
        var x = Math.floor((Math.random() * 1000) + 1);
        var h = $("#"+id).clone().attr('id',id+'_'+x);
        h.find('input').val('');
        h.find('.datepicker').removeClass('hasDatepicker');
        h.find('.datepicker').attr('id','');
        h.append('<i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"></i>');
        h.insertAfter("."+id+"_cls:last");
    }

    $(".dts").on('change',function(){
        var travel_date = $('.dts:eq(0)').val().split(' ');
        var return_date = $('.dts:eq(1)').val().split(' ');
        
        if(travel_date[0] != "" && return_date[0] != ""){
            if(travel_date[0] > return_date[0]){
                alert('Return date must be greater than travel on date.');
                //var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
                $(".dts").val('');
            }
        }
    });
    
</script>	
  <!-- suggesstion Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
	
<script>


$(document).ready(function(){
    
    $(".card-box").on('click', '.fa-remove', function(e){
        e.preventDefault();
        $(this).parent().remove(); //Remove field html
    });
    
    $("#frmtravel").on('keyup', '.cost', function(e){
        var id = $(this).parent().parent().parent().parent().attr('id');
        //alert(id);
        if($("#"+id+" .cost:eq(0)").val() != '' && $("#"+id+" .cost:eq(1)").val() != '' && $("#"+id+" .cost:eq(2)").val() != ''){
            var total_amt = (parseInt($("#"+id+" .cost:eq(0)").val()) + parseInt($("#"+id+" .cost:eq(1)").val())) * parseInt($("#"+id+" .cost:eq(2)").val());
            $("#"+id+" .total_amt").val(total_amt);
        }
    });
    
   /* $("#frmtravel .total_amt").on('click',function(){
        alert($(this).index());
    });*/
    
    
});

</script>	
</body>
</html>
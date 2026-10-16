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
                                <li><a class="parent-item" href="<?=base_url();?>expenses/intercity-expenses">Expenses</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Local Travel</li>
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
                                            <header>Local Travel Expenses</header>
                                            <?php echo $this->session->flashdata('message'); ?>
                                            <div class="tools">
                                                <a href="intercity-list" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i> List</a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                            </div>
                                    </div>	
                                <form method="post" name="myForm" onsubmit="" autocomplete="off" enctype="multipart/form-data">
                                <div class="card-body row">																																																						

<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'name','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('name')])?>			 
<label class = "mdl-textfield__label">Name</label><?php echo form_error('name');?>		 	 
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
                                    <label class = "mdl-textfield__label">Grade</label>	 
                            		 
                                 	 
                              </div>
                                </div>
                                <!-- <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <?php echo form_input(['name'=>'location','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('location')])?>			 
                                <label class = "mdl-textfield__label">Location</label>		 	 
                              </div>
                                </div>            -->

<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
      <input type="text" name="date" id="bill_date" value="<?php echo date('d-m-Y'); ?>" class="mdl-textfield__input" >
<label class = "mdl-textfield__label"> Date</label>	 	 
</div>
</div>
<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'phone','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('phone'),'type'=>'number'])?>			 
<label class = "mdl-textfield__label">Phone No</label><?php echo form_error('phone');?>		 	 
</div>
</div>  
<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'email','id'=>'claimer_name', 'class'=>'mdl-textfield__input','type'=>'email', 'value'=>set_value('email')])?>			 
<label class = "mdl-textfield__label">Email</label><?php echo form_error('email');?>		 	 
</div>
</div>  


<!--<div class="col-lg-6 p-t-20"> -->
<!--  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 -->
<!--<?php echo form_input(['name'=>'bill_amount','id'=>'bill_amount', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('bill_amount')])?>    -->
<!--    <label class = "mdl-textfield__label">Bill Amount</label><?php echo form_error('bill_amount');?>		 	 -->
<!--</div>-->
<!--</div>                          -->
        
</div>

                        <div class="card-header">
                            <div class="col-lg-12"><h4>Local Travel</h4></div>
                        </div>						
                        <div class="card-body intercity_cls" id="intercity"> 
                            <div class="row"><div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'place_visited[]','id'=>'','placeholder'=>'Place Visited', 'class'=>'mdl-textfield__input ','type'=>'text', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">Place Visited</label>		 	 
                          </div>
                            </div>


                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'travel_date[]','id'=>'','placeholder'=>'Travel Date', 'class'=>'mdl-textfield__input datepicker', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">Date</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php /*  echo form_input(['name'=>'intercity_travel_mode[]','placeholder'=>'Mode','type'=>'text','id' =>'', 'class'=>'mdl-textfield__input', 'value'=>'']) */?>	
                           <select name="intercity_travel_mode[]" id="" class="mdl-textfield__input" >
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
                        <?php echo form_input(['name'=>'km[]','id'=>'KM','placeholder'=>'KM',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">Km</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-3 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'departure_time[]','id'=>'to_place','placeholder'=>'DP Time',  'class'=>'mdl-textfield__input', 'value'=>'','type'=>'time'])?>			 
                            <label class = "mdl-textfield__label">DP Time</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-3 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'arrival_time[]','id'=>'arrival_time','placeholder'=>'AR Time',  'class'=>'mdl-textfield__input', 'value'=>'','type'=>'time'])?>			 
                            <label class = "mdl-textfield__label">AR Time</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-5 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'remark[]','id'=>'arrival_time','placeholder'=>'Remark',  'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                            <label class = "mdl-textfield__label">Remark</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'intercity_travel_amount[]','id'=>'amount','placeholder'=>'Amount',  'class'=>'mdl-textfield__input', 'type'=>'number', 'value'=>''])?>			 
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
            time: true,clearButton: true,format: 'YYYY-MM-DD HH:mm:ss'
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
});

</script>	
</body>
</html>
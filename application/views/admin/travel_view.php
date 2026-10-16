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
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Expenses</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>tender-list">Expenses</a></li>
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
                                    </div>	
                                <form method="post" name="myForm" onsubmit="" autocomplete="off" enctype="multipart/form-data">
                                  <?php
                                 //echo '<pre>';print_r($expenses);exit;
                                   foreach($expenses as $expenses_record){
                                    ?>
                                  
                                    <div class="card-body row">																																																						

                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label for="">Name</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->claimer_name ;?></p>
                              </div>
                                </div> 
                                          

                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Bill Date</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->bill_date ;?></p>	 
                              </div>
                                </div>

                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Location</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->location ;?></p>			 	 
                              </div>
                                </div>
                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Travelled On</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->traveled_on ;?></p>	 	 
                              </div>
                                </div>
                                        
                                <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Grade</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->grade ;?></p>
                              </div>
                                </div>
                                        
                               <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Returned On</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->returned_on ;?></p> 	 
                              </div>
                                </div>                                         
                            
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">City Visited</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->city_visited ;?></p>
                              </div>
                                </div>									
                            
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Duration</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->duration;?></p>
                              </div>
                                </div>
                              
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Visited For</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->visited_for ;?></p>	 	 
                              </div>
                                </div>	
                                
                               
                                
                            
                            <div class="col-lg-6 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <label for="">Bill Amount</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $expenses_record->total_bill_amount ;?></p>
                              </div>
                                </div>  
                                                       
                                        <?php } ?>
                        </div>
<?php if(!empty($intercity_travel_expenses)){
  ?>


                        <div class="card-header">
                            <div class="col-lg-12"><h4>Intercity Travel</h4></div>
                        </div>	
                        <?php }?>

                        <?php
                       // echo '<pre>';print_r($local_travel_expenses);exit;
                        foreach($intercity_travel_expenses as $record){
                          ?>
                        				
                        <div class="card-body intercity_cls" id="intercity"> 
                            <div class="row">
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label for=""> Travel Date</label>		 	 
                                    <p style="border-bottom:1px solid #000;"><?php echo $record->travel_date   ;?></p>	 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label for="">Mode</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record->travel_mode   ;?></p>	 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label for="">From Place</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record->from_place   ;?></p> 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label for="">To Place</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record->to_place   ;?></p>		 	 
                          </div>
                            </div>
                            <div class="col-lg-1 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label  style="font-size:11px;" for="">DP Time</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record->departure_time   ;?></p>		 	 
                          </div>
                            </div>
                            <div class="col-lg-1 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label class = "" style="font-size:11px;" for="">AR Time</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record->arrival_time   ;?></p>
                            <!-- <label class = "mdl-textfield__label">AR Time</label>		 	  -->
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label class = ""  for="">Amount</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record->intercity_amount   ;?></p>		 	 
                          </div>
                            </div>
                            </div>
                        </div>	
                        <?php if(!empty($intercity)){
                          
                          ?>
                        
                        
                        <div class="card-body row">
                            <div class="col-md-2">
                                <label style="font-size: 16px;">No. Of Attach Bills:</label>
                            </div>
                            <div class="col-md-4">
                                <div class="block float-left">         
                                    <p><?php echo $intercity ;?></p>                   
                                </div>
                            </div>
                            <?php } ?>
                            <!-- <div class="col-md-6">
                                <div class="block float-right">
                                    <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('intercity')"></i></span>
                                </div>
                            </div> -->
                        </div>   
                        <?php } ?>							                                 
                        <?php if(!empty($local_travel_expenses)){
  ?>
                        <div class="card-header">
                                <div class="col-lg-12"><h4>Local Travel</h4></div>
                            </div>	
                            <?php } ?>	
                            <?php foreach($local_travel_expenses as $record2){
                              ?>
                            			
                            <div class="card-body local_cls" id="local"> 
                                <div class="row">
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Travel date</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record2->travel_date;?></p>	 	 
                              </div>
                                </div>

                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">From Local Place</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record2->from_local_place;?></p>	 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">To Local Place</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record2->to_local_place;?></p>			 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Mode / Remarks</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record2->local_travel_mode;?></p>			 	 
                              </div>
                                </div>                                
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Amount</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record2->local_amount;?></p>		 	 
                              </div>
                                </div>
                                </div>
                                
                            </div>
                            <?php if(!empty($local_travel)){
                          
                          ?>
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">No. Of Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-left">                                    
                                        <p><?php echo $local_travel; ?></p>                    
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- <div class="col-md-6">
                                    <div class="block float-right">
                                        <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('local')"></i></span>
                                    </div>
                                </div> -->
                            </div>  
                            <?php } ?>                                  
                            <?php if(!empty($accomodation_food)){
  ?>
                            <div class="card-header">
                                <div class="col-lg-12"><h4>Accomodation & Food</h4></div>
                            </div>	
                            <?php } ?>
                            <?php foreach($accomodation_food as $record3){
                              ?>
                            				
                                    <div class="card-body acc_food_cls" id="acc_food"> 
                                <div class="row">
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">CityVisited</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record3->city_visited; ?></p>			 	 
                              </div>
                                </div>

                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Hotel</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record3->hotel_amount; ?></p>		 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Food</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record3->food_amount; ?></p>		 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Hr / Dy</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record3->hour_day; ?></p>		 	 
                              </div>
                                </div>                                
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Amount</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record3->amount; ?></p>			 	 
                              </div>
                                </div>
                                </div>                                
                            </div>
                            <?php if(!empty($accomodation_food1)){
                          
                          ?> 
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">No. Of Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-left">   
                                        <p><?php echo $accomodation_food1; ?></p>                    
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- <div class="col-md-6">
                                    <div class="block float-right">
                                        <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('acc_food')"></i></span>
                                    </div>
                                </div> -->
                            </div>                                    
                                   <?php } ?> 
                                   <?php if(!empty($miscellaneous_expenses)){
  ?>
        
                            <div class="card-header">
                                <div class="col-lg-12"><h4>Miscellaneous</h4></div>
                            </div>	
                            <?php } ?>
                            <?php foreach($miscellaneous_expenses as $record4){
                              ?>
                            					
                            <div class="card-body miscellaneous_cls" id="miscellaneous"> 
                                <div class="row">
                                <div class="col-lg-8 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Expense With Remarks</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record4->expenses_with_remarks;?></p>	 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label  for="">Amount</label>		 	 
                                <p style="border-bottom:1px solid #000;"><?php echo $record4->amount;?></p>			 	 
                              </div>
                                </div>
                                </div>                                
                            </div>
                            <?php if(!empty($miscellaneous)){
                          
                          ?> 
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">No. Of Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-left">                         
                                        <p><?php echo $miscellaneous; ?></p>                    
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- <div class="col-md-6">
                                    <div class="block float-right">
                                        <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('miscellaneous')"></i></span>
                                    </div>
                                </div> -->
                            </div>
                            <?php } ?>
                            <div class="card-body row">
                                <div class="col-md-offset-5 col-md-6">
                                <input type="submit" onclick="window.print()" name="Print" value="Print" class="btn btn-success float-right"/>
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
            time: false,clearButton: true
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
                dateFormat: 'yy-mm-dd',
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
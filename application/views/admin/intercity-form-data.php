<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
  .col-lg-6{
    width:50%;
  }
  .col-lg-2{
    width:50%;
  }
</style>
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
                            <div class="card-box" >
                                    <div class="card-head">
                                        <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                        <i class="material-icons">arrow_back</i>
                                        </button>
                                            <header>Intercity Expenses</header>
                                            <?php echo $this->session->flashdata('message'); ?>
                                    </div>	
                                <form method="post" name="myForm" onsubmit="" autocomplete="off" enctype="multipart/form-data">
                                    <?php foreach($intercity as $record){
                                        ?>
                                    
                                <div class="card-body row">																																																						

<div class="col-lg-6 p-t-20" id="printableId"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'name','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$record->name])?>			 
<label class = "mdl-textfield__label">Name</label><?php echo form_error('name');?>		 	 
</div>
</div>            

<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
      <input type="text" name="date" id="bill_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" >
<label class = "mdl-textfield__label"> Date</label>	 	 
</div>
</div>
<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'phone','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$record->phone])?>			 
<label class = "mdl-textfield__label">Phone No</label><?php echo form_error('phone');?>		 	 
</div>
</div>  
<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'email','id'=>'claimer_name', 'required'=>'required', 'class'=>'mdl-textfield__input','type'=>'email', 'value'=>$record->email])?>			 
<label class = "mdl-textfield__label">Email</label><?php echo form_error('email');?>		 	 
</div>
</div>  


<div class="col-lg-6 p-t-20"> 
  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'bill_amount','id'=>'bill_amount', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>$record->amount])?>    
    <label class = "mdl-textfield__label">Bill Amount</label><?php echo form_error('bill_amount');?>		 	 
</div>
</div>                          
        
</div>
<?php } ?>
<?php
                        //print_r($intercity_detail);exit;
                        
                        foreach($intercity_detail as $record2){
                            ?>
                        <div class="card-header">
                            <div class="col-lg-12"><h4>Intercity Travel</h4></div>
                        </div>	
                        
                        					
                        <div class="card-body intercity_cls" id="intercity"> 
                            <div class="row">
                              <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'place_visited[]','id'=>'','placeholder'=>'Place Visited', 'class'=>'mdl-textfield__input ','type'=>'text', 'value'=>$record2->place_visited])?>			 
                            <label class = "mdl-textfield__label">Place Visited</label>		 	 
                          </div>
                            </div>


                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'travel_date[]','id'=>'','placeholder'=>'Travel Date', 'class'=>'mdl-textfield__input ', 'value'=>$record2->travel_date])?>			 
                            <label class = "mdl-textfield__label">Date</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'intercity_travel_mode[]','placeholder'=>'Mode','type'=>'text','id' =>'', 'class'=>'mdl-textfield__input', 'value'=>$record2->mode])?>			 
                            <label class = "mdl-textfield__label">Mode</label> 	 	 
                          </div>
                            </div>

                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'from_place[]','id'=>'from_place','placeholder'=>'From Place',  'class'=>'mdl-textfield__input', 'value'=>$record2->from_place])?>			 
                            <label class = "mdl-textfield__label">From</label>	 	 
                          </div>
                            </div>
                            
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'to_place[]','id'=>'to_place','placeholder'=>'To Place',  'class'=>'mdl-textfield__input', 'value'=>$record2->to_place])?>			 
                            <label class = "mdl-textfield__label">To</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'km[]','id'=>'KM','placeholder'=>'KM',  'class'=>'mdl-textfield__input', 'value'=>$record2->km])?>			 
                            <label class = "mdl-textfield__label">Km</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-3 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'departure_time[]','id'=>'to_place','placeholder'=>'DP Time',  'class'=>'mdl-textfield__input', 'value'=>$record2->dp_time])?>			 
                            <label class = "mdl-textfield__label">DP Time</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-3 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'arrival_time[]','id'=>'arrival_time','placeholder'=>'AR Time',  'class'=>'mdl-textfield__input', 'value'=>$record2->ar_time])?>			 
                            <label class = "mdl-textfield__label">AR Time</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-5 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'remark[]','id'=>'arrival_time','placeholder'=>'Remark',  'class'=>'mdl-textfield__input', 'value'=>$record2->remark])?>			 
                            <label class = "mdl-textfield__label">Remark</label>		 	 
                          </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'intercity_travel_amount[]','id'=>'amount','placeholder'=>'Amount',  'class'=>'mdl-textfield__input', 'type'=>'number', 'value'=>$record2->amount])?>			 
                            <label class = "mdl-textfield__label">Amount</label>		 	 
                          </div>
                            </div>
                            </div>
                        </div>								
                        <?php } ?>
                        <?php if(!empty($intercity_bills)){
                                ?>
                            
                            <div class="card-body row">
                                <div class="col-md-2">
                                    <label style="font-size: 16px;">Attach Bills:</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="block float-right">                                    
                                        <p><?php echo $intercity_bills; ?></p>                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="block float-right">
                                        <!-- <span class="add"><i class="fa fa-plus btn btn-success" onclick="add_element('miscellaneous')"></i></span> -->
                                    </div>
                                </div>
                            </div>
                            <?php }else{
                                ?>
                                <div><p class="text-danger ml-5"> NO bill Attached !  </p></div>

                          <?php  } ?>
            
                            <div class="card-body row">
                                <div class="col-md-offset-5 col-md-6">
                                <input type="button" id="myPrntbtn" name="button" onclick="window.print()" value="Print" class="btn btn-success float-right"/>
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

    <script type="text/javascript">
    function printMyPage() {
        //Get the print button
        var printButton = document.getElementById("myPrntbtn");
        //Hide the print button 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Show back the print button on web page 
        printButton.style.visibility = 'visible';
    }
</script>
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
<script
   src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
   integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
   crossorigin="anonymous"></script>
<script>
     function printPage(){
      alert('hello');
        
        var printHtml = window.open('', 'PRINT', 'height=400,width=600');
    
        printHtml.document.write('<html><head>');
        printHtml.document.write(document.getElementById("printableId").innerHTML);
        printHtml.document.write('</body></html>');
    
        printHtml.document.close(); 
        printHtml.focus(); = 10*/
    
        printHtml.print();
        printHtml.close();
    
        return true;
    
      }
</script>
</body>
</html>
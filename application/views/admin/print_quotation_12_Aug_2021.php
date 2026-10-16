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
    
 #overlay {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 85%;
  z-index: 5000;
  top: 0;
  left: 245px;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}
button {
  margin: 40px;
  padding: 5px 20px;
  cursor: pointer;
}
.spinner {
    margin: 0 auto;
    height: 60px;
    width: 60px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid #2CA8FF;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
.btnHide {
    position: absolute;
    top: 15px;
    color: red;
    right: 25px;
    cursor: pointer;
}
    
</style> 
<script>
CKEDITOR.config.toolbar = [
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize'] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	'/',
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'insert', items: ['Table' ] }
    ];
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
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
<?php include('side_bar.php');?>
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                <!--    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Order Acknowledgement</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Order Acknowledgement</li>
                            </ol>
                        </div>
                    </div> -->			
            <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>
                    <div class="row">

                       <div class="col-md-12">
                           <form method="post" id="frm_quotation" onsubmit="document.getElementById('overlay').style.display='block'">
                           <div class="card card-box" id="print">
                               <div class="card-body">

                                   <table class="table table-hover table-checkable order-column full-width">
                                       <thead>
                                           <tr>
                                               <th style="text-align: left;"><img src="<?=base_url()?>assets/images/logo.png"></th>
                                               <th style="text-align: right;">PAN : AAJCA0972F<br>CIN :U29128DL2011PTC212297</th>
                                           </tr>
                                       </thead>
                                   </table>
                               <?php $quote = $detail->quotation_number;
                               $quot_num = explode("/",$quote)
                               ?>
                                <p>Ref.No : <?=$quot_num[0].'/'.$quot_num[1].'/'.$quot_num[2].'/'.$quot_num[3].'/';?><input type="text" name="quotation_number" value="<?=$quot_num[4]?>" required>
                                    <span style="float:right;"><input type="text" name="qDate" value="Date: <?php echo date('jS F, Y'); ?>" /></span>
                                </p>
                                <input type="hidden" name="quote_prefix" value="<?=$quot_num[0].'/'.$quot_num[1].'/'.$quot_num[2].'/'.$quot_num[3].'/';?>">
                                <p><input type="checkbox" name="chk_abbrevations[]" value="kind"/> <!-- Kind Attn : <?=$detail->contact_person?><br><input type="hidden" name="hdn_preview_kind" value="<?=$detail->contact_person?>"/> -->
                                Kind Attn - <input type="text" name="hdn_preview_kind" placeholder="name" value="<?=$detail->contact_person?>"></p>
                                <p><input type="checkbox" name="chk_abbrevations[]" value="designation"/> Designation - <input type="text" name="designation" placeholder="Designation"></p>
                                <p><input type="checkbox" name="chk_abbrevations[]" value="client_name"/> <!-- <?=$detail->name?> <br><input type="hidden" name="hdn_preview_client_name" value="<?=$detail->name?>"/> -->
                                Company - <input type="text" name="hdn_preview_client_name" placeholder="name" value="<?=$detail->name?>"></p>
                                <p><input type="checkbox" name="chk_abbrevations[]" value="complete_address"/><!--  <?=str_replace('"', '', $detail->address).'<span style="margin-left:15px;">'.$detail->city.', '.$detail->state.', '.$detail->country?></span></p> -->
                                Address - 
                                <textarea name="hdn_preview_complete_address" cols="30" rows="3"><?=str_replace('"', '', $detail->address).''.$detail->city.', '.$detail->state.', '.$detail->country?></textarea>
                                </p>
                                <p><input type="checkbox" name="chk_abbrevations[]" value="subject"/> Sub   : <input type="text" name="email_subject" value="Quotation" required></p>

                               <p><input type="checkbox" name="chk_abbrevations[]" value="salutation1"/> <input type="text" name="salutation1" value="Dear Sir/Madam,"></p>
                               <p><input type="checkbox" name="chk_abbrevations[]" value="salutation2"/> <textarea name="salutation2" class="w-75">We thankfully acknowledge your above referred enquiry and take pleasure in quoting as per under mentioned terms and conditions -</textarea></p>

                                   <table id="Table1" class="table table-hover table-checkable order-column full-width">
                                       <thead>
                                           <tr>
                                                <!--th class="center"></th-->
                                                <!--th class="center">No.</th-->
                                                <th class="center">Item Description</th>
                                                <th class="center" width="15%">Unit Price <select name="currency"><option value="Rs">&#x20B9;</option><option value="$">$</option></select></th>
                                                <th class="center" width="8%">Quantity</th>
                                                <th class="center">Amount</th> 
                                           </tr>
                                       </thead>

                                       <tbody>
                                       <input type="hidden" name="hdn_enquiry_count" value="<?php echo count($multiple_enquiry); ?>"/>
                                       <?php 

                                       if(!empty($multiple_enquiry)){
                                       $i = 1;    
                                       foreach($multiple_enquiry as $enquiry){
                                       ?>
                                            <tr>
                                                <!--td class="center"><input type="checkbox" name="txtChoice[]" value="<?//=$i?>" id="txtChoice"></td-->
                                                <input type="hidden" name="enquiry_id[]" value="<?=$enquiry['enquiry_id']?>" id="enquiry_id<?=$i?>">
                                                <input type="hidden" name="enquiry_for[]" value="<?=$enquiry['enquiry']?>" id="enquiry_for<?=$i?>">
                                                <!--td class="center"><?//=$i?></td-->
                                                <td class="center">
                                                <p>
                                                    <textarea class="form-control txt_description" name="description[]" id="description<?=$i?>"><?=$enquiry['enquiry']?></textarea>
                                                </p>
                                                </td>
                                                <td class="center" width="12%"><input type="text" class="form-control t1" onblur="addamount(this)" onkeypress="return validateNum(event)" name="unitprice[]" id="unitprice_<?=$i?>" required></td>
                                                <td class="center" width="5%"><input type="text" class="form-control t2" onblur="addamount(this)" name="quantity[]" id="quantity_<?=$i?>" required></td>
                                               <td class="center" width="12%"><input type="text" class="form-control t3" name="amount[]" id="amount_<?=$i?>" readonly></td> 
                                            </tr>
                                            <script>CKEDITOR.replace( 'description<?=$i ?>');</script>
                                       <?php $i++;   
                                       }    
                                       }

                                       ?>     

                                       </tbody> 

                                   </table>
           <div class="row form-group table">
               <div class="col-sm-12">
                   <button type="button" id="addMore" class="btn btn-primary btn-xs" style="float:right;"><i class="fa fa-plus"></i>  Add Row</button>                        
               </div>
           </div>
           <table id="tbl_calculation" class="table table-hover table-checkable order-column full-width">

           </table>
           <div class="row form-group table">

               <div class="col-sm-12">
                   <button type="button" id="addCalcRow" class="btn btn-primary btn-xs" style="float:right;"><i class="fa fa-plus"></i>  Add Calculation Row</button>                        
               </div>
           </div>

           <table class="table full-width">
               <tbody>
                   <tr><td><b><u>Information 1:</u></b></td></tr>
                   <tr>
                       <td class="center">
                           <textarea name="information_1" id="information_1">
                            <table>
                              <tr><td>Price:</td><td></td></tr>
                              <tr><td>Payment:</td><td></td></tr>
                              <tr><td>Tax:</td><td></td></tr>
                              <tr><td>Delivery:</td><td></td></tr>
                              <tr><td>Validity:</td><td></td></tr>
                              <tr><td>Warranty:</td><td></td></tr>
                              <tr><td>Installation:</td><td></td></tr>
                              <tr><td>Accommodation:</td><td></td></tr>
                              <tr><td>Note:</td><td></td></tr>

                            </table>     
                            </textarea>
                       </td>
                   </tr>                            
               </tbody>

           </table>                    

               <table class="table full-width">
                   <tbody>
                       <tr><td><b><u>Information 2:</u></b></td></tr>
                       <tr>
                           <td class="center">
                               <textarea name="information_2" id="information_2"></textarea>
                           </td>
                       </tr>                            
                   </tbody>

               </table>
                   <br>
                     <p>Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>

                     <p>Your truly<br>For Intellitest Solutions Pvt. Ltd.</p>

                     <p><input type="text" name="executive_name" value="<?php echo $this->session->userdata('name'); ?>" required></p>
                     <p>Sales Executive - <input type="text" name="executive_number" value="<?php echo $this->session->userdata('contact_number'); ?>" required></p>
                     <p><input type="text" name="executive_email" value="<?php echo $this->session->userdata('email'); ?>" required></p>

                     <hr>
                         <table class=" full-width">
                             <thead>
                                 <tr>
                                     <th class="center"></th>
                                     <th class="center"></th>
                                 </tr>
                             </thead>

                             <tbody> 
                                 <tr>
                                     <td><b>Intellitest Solutions Pvt. Ltd.</b></td>
                                     <td style="text-align: right;"> </td>
                                 </tr>
                                 <tr>
                                     <td>Corp Office - 12A08, Bussiness Hub, Sector-81, Faridabad -121107(Delhi NCR)</td>
                                     <td style="text-align: right;">Telephone : +91-129-4096069</td>
                                 </tr>
                                 <tr>
                                     <td>Regd Office - 119-FF, Vardhman Star City Mall, Sector-7, Dwarka, New Delhi -110075</td>
                                     <td style="text-align: right;">Mobile : +91-92550059892</td>
                                 </tr>
                                 <tr>
                                     <td>Web : www.intellitest.co.in</td>
                                     <td style="text-align: right;">Email : solutions@intellitest.co.in<br>Email : intellitestspl@gmail.com</td>
                                 </tr>
                                 <tr><td colspan="2" style="text-align: center;font-weight: bold;">All Dispute Subject To Faridabad Jurisdiction.</td></tr>
                             </tbody> 

                         </table>                                

                     </div>
                 </div>
     <input type="email" name="email_to" placeholder="Enter email to send quotation" required>
     <input type="text" name="email_cc" placeholder="Enter  cc email to send quotation" value="kpsingh@intellitest.co.in">
     <div class="col-lg-12 p-t-20 text-center"> 
         <input type="button" value="Preview" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info" title="Generate Preview" id="preview" />
         <input type="submit" name="submit" value="Submit" id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink"  />
         <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
     </div>
 </form>      
             </div>
         </div> 					

      </div>
  </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <div id="overlay" style="display:none;">
            <i class="fa fa-close btnHide"></i>
            <div class="spinner"></div>
            <p style="padding-top: 12px;padding-left: 12px;font-weight: bold;">Loading...</p>
        </div>
        
<?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
<?php include('admin_footer_js.php');?>
    <!-- end js include path -->	
<script>

    CKEDITOR.replace( 'information_1');
    CKEDITOR.replace( 'information_2');
    var fieldHTML = '<tr>';
	fieldHTML += '<input type="hidden" name="enquiry_id[]" value="">';
	fieldHTML += '<input type="hidden" name="enquiry_for[]" value="">';
	fieldHTML += '<td class="center">';                                                    
	fieldHTML += '<p><textarea class="form-control txt_description" name="description[]" placeholder="Description"></textarea></p></td>';
	fieldHTML += '<td class="center"><input type="text" class="form-control t1" onblur="addamount(this)" name="unitprice[]" onkeypress="return validateNum(event)"/></td>';
	fieldHTML += '<td class="center"><input type="text" class="form-control t2" onblur="addamount(this)" name="quantity[]" /></td>';
        fieldHTML += '<td class="center"><input type="text" class="form-control t3" name="amount[]" readonly></td><td><i title="Remove" class="fa fa-remove" style="color:red;"></i></td></tr>';

    var fieldHTML_calc = '<tr><td></td><td><input type="text" name="txt_calc[]" class="form-control txtCalc"></td>';
        fieldHTML_calc += '<td><select name="select_calc[]" class="form-control select_c">';
	fieldHTML_calc += '<option value="total">Total</option>';
        fieldHTML_calc += '<option value="subtract">Extra Rebate(-)</option>';
	fieldHTML_calc += '<option value="add">Extra Charges(+)</option>';
	fieldHTML_calc += '<option value="18">GST@18%</option>';
	//fieldHTML_calc += '<option value="9">GST@9%</option>';
        //fieldHTML_calc += '<option value="9">GST@9%</option>';
        fieldHTML_calc += '</select></td>';
        fieldHTML_calc += '<td><input type="text" name="txt_calc_amt[]" class="form-control txtcalcAmt" onkeypress="return validateNum(event)" readonly></td>';
        fieldHTML_calc += '<td><i title="Remove" class="fa fa-remove calc_remove" style="color:red;cursor:pointer;"></i></td></tr>';
                                    
    $(document).ready(function(){
        $("#addMore").on("click",function(){
            $("#Table1 tr:last").after(fieldHTML);
            var x = Math.floor((Math.random() * 1000) + 1);
            $("#Table1 tr:last").find('.txt_description').attr("id",'description_'+x);
            $("#Table1 tr:last").find('.t1').attr("id",'unitprice_'+x);
            $("#Table1 tr:last").find('.t2').attr("id",'quantity_'+x);
            $("#Table1 tr:last").find('.t3').attr("id",'amount_'+x);
            CKEDITOR.replace('description_'+x);
        });
        $(".card-body").on('click', '.fa-remove', function(e){
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
        });
        
        $("#addCalcRow").on("click",function(){
            $("#tbl_calculation").append(fieldHTML_calc);
            //var x = 'description_'+Math.floor((Math.random() * 1000) + 1);
            //$("#Table1 tr:last").find('.txt_description').attr("id",x);
            //CKEDITOR.replace(x);
        });
        $(".card-body").on('click', '.calc_remove', function(e){
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
        });
        
        $(".btnHide").on("click",function(){
            $('#overlay').fadeOut();
        });
        
        var amtBox = ['add','subtract'];
        $("#tbl_calculation").on("change",".select_c",function(){
            if(amtBox.indexOf($(this).val()) !== -1){
                $(this).parent().next().find('.txtcalcAmt').removeAttr('readonly');
            }else{
                $(this).parent().next().find('.txtcalcAmt').attr('readonly','readonly');
            }
        });
        
    });

    function validateNum(event){
        return (event.charCode >= 48 && event.charCode <= 57);
    }
    
    function addamount(elem){
        var num = $(elem).attr("id").split("_"); 
        //var amountid = "amount_".concat(num[1]);
        var unit_price = document.getElementById("unitprice_".concat(num[1])).value;
        var quantity = document.getElementById("quantity_".concat(num[1])).value;
        if(isNaN(quantity)){
            quantity = 1;
        }
        document.getElementById("amount_".concat(num[1])).value= unit_price  *  quantity;
    }

    $(document).ready(function(){
        $("#preview").on('click',function(e){
            e.preventDefault();
            $('#overlay').fadeIn();
            data = populateFormdata();
            $.ajax({
                url: "<?php echo site_url('generate_preview'); ?>",
                type: "post",
                data: data,
                responseType: 'blob',
                //dataType : 'blob',
                contentType : false,
                processData: false,
                success: function (data) {
                    // data should be your response data in base64 format
                    const blob = dataURItoBlob(data);
                    const url = URL.createObjectURL(blob);
                    // to open the PDF in a new window
                    window.open(url, '_blank');
                    $('#overlay').fadeOut();
                 }
            });
        });
    });

    function populateFormdata(){
        let myForm = document.getElementById("frm_quotation");
        var data = new FormData(myForm);
        var i=0;
        $('.txt_description').each(function () {
            data.set('description['+i+']',CKEDITOR.instances[$(this).attr('id')].getData());
            i++;
        });
        i=0;
        $('.t1').each(function () {
            data.set('unitprice['+i+']',$(this).val());
            i++;
        });
        i=0;
        $('.t2').each(function () {
            data.set('quantity['+i+']',$(this).val());
            i++;
        });
        i=0;
        $('.t3').each(function () {
            data.set('amount['+i+']',$(this).val());
        i++;
        });
        i=0;
        $('.txtCalc').each(function () {
            data.set('txt_calc['+i+']',$(this).val());
        i++;
        });
        i=0;
        $('.select_c').each(function () {
            data.set('select_calc['+i+']',$(this).val());
        i++;
        });
        i=0;
        $('.txtcalcAmt').each(function () {
            data.set('txt_calc_amt['+i+']',$(this).val());
        i++;
        });
        data.set('information_1',CKEDITOR.instances['information_1'].getData());
        data.set('information_2',CKEDITOR.instances['information_2'].getData());
        return data;
    }

function dataURItoBlob(dataURI) {
      const byteString = window.atob(dataURI);
      const arrayBuffer = new ArrayBuffer(byteString.length);
      const int8Array = new Uint8Array(arrayBuffer);
      for (let i = 0; i < byteString.length; i++) {
        int8Array[i] = byteString.charCodeAt(i);
      }
      const blob = new Blob([int8Array], { type: 'application/pdf'});
      return blob;
    }

</script>

</body>
</html>
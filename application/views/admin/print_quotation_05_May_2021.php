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
                                <p>Ref.No : <?=$quot_num[0].'/'.$quot_num[1].'/'.$quot_num[2].'/'.$quot_num[3].'/';?><input type="text" name="quotation_number" value="<?=$quot_num[4]?>" required></p>
                                <input type="hidden" name="quote_prefix" value="<?=$quot_num[0].'/'.$quot_num[1].'/'.$quot_num[2].'/'.$quot_num[3].'/';?>">
                                <p><input type="checkbox" name="chk_abbrevations[]" value="kind"/> Kind Attn : <?=$detail->contact_person?><br><input type="hidden" name="hdn_preview_kind" value="<?=$detail->contact_person?>"/>
                                <input type="checkbox" name="chk_abbrevations[]" value="designation"/> Designation - <input type="text" name="designation" placeholder="Designation"><br>
                                <input type="checkbox" name="chk_abbrevations[]" value="client_name"/> <?=$detail->name?> <br><input type="hidden" name="hdn_preview_client_name" value="<?=$detail->name?>"/>
                                <input type="checkbox" name="chk_abbrevations[]" value="complete_address"/> <?=$detail->address.', '.$detail->city.', '.$detail->state.', '.$detail->country?></p>
                                                                    <input type="hidden" name="hdn_preview_complete_address" value="<?=$detail->address.', '.$detail->city.', '.$detail->state.', '.$detail->country?>"/>
                                <p><input type="checkbox" name="chk_abbrevations[]" value="subject"/> Sub   : <input type="text" name="email_subject" value="Quotation" required></p>
                           
                                <p><input type="checkbox" name="chk_abbrevations[]" value="salutation1"/> <input type="text" name="salutation1" value="Dear Sir/Madam,"></p>
                                <p><input type="checkbox" name="chk_abbrevations[]" value="salutation2"/> <textarea name="salutation2" class="w-75">We thankfully acknowledge your above referred enquiry and take pleasure in quoting as per under mentioned terms and conditions -</textarea></p>
                                
                                    <table id="Table1" class="table table-hover table-checkable order-column full-width">
                                        <thead>
                                            <tr>
                                                <th class="center"></th>
                                                    <th class="center">No.</th>
                                                    <th class="center">Item Description</th>
                                                    <th class="center" width="15%">Unit Price <select name="currency"><option value="Rs">Rs</option><option value="$">$</option></select></th>
                                                    <th class="center" width="8%">Quantity</th>
                                                    <th class="center">Amount</th> 
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <input type="hidden" name="hdn_enquiry_count" value="<?php echo count($multiple_enquiry); ?>"/>
                                        <?php if($detail->multiple == "Yes"){
                                        if(!empty($multiple_enquiry)){
                                        $i = 1;    
                                        foreach($multiple_enquiry as $enquiry){
                                        ?>
                                            <tr>
                                                <td class="center"><input type="checkbox" name="txtChoice<?=$i?>" value="<?=$i?>" id="txtChoice"></td>
                                                <input type="hidden" name="enquiry_id<?=$i?>" value="<?=$enquiry['enquiry_id']?>" id="enquiry_id<?=$i?>">
                                                <input type="hidden" name="enquiry_for<?=$i?>" value="<?=$enquiry['enquiry']?>" id="enquiry_for<?=$i?>">
                                                <td class="center"><?=$i?></td>
                                                <td class="center"><?=$enquiry['enquiry']?>
                                                <p><input type="text" class="form-control" name="model<?=$i?>" id="model<?=$i?>" placeholder="model"/></p>
                                                <p><input type="text" class="form-control" name="make<?=$i?>" id="make<?=$i?>" placeholder="make"/><br></p>
                                                <p><input type="text" class="form-control" name="description<?=$i?>" id="description<?=$i?>" placeholder="Description"/></p>
                                                </td>
                                                <td class="center"><input type="text" class="form-control" onblur="addamount(this)" name="unit_price<?=$i?>" id="unit_price<?=$i?>" ></td>
                                                <td class="center"><input type="number" class="form-control" onblur="addamount(this)" name="quantity<?=$i?>" id="quantity<?=$i?>" ></td>
                                               <td class="center"><input type="text" class="form-control" name="amount<?=$i?>" id="amount<?=$i?>" readonly></td> 
                                                
                                            </tr>                                        
                                        <?php $i++;   
                                        }    
                                        }
                                        
                                        }else{
                                        ?>     
                                            <tr>
                                                <td class="center"><input type="checkbox" name="txtChoice1" value="1" id="txtChoice" required></td>
                                                <td class="center">1.</td>
                                                <td class="center"><?=$detail->enquiry_for?>
                                                <p><input type="text" name="model1" id="model1" placeholder="Model" class="form-control"></p>
                                                <p><input type="text" name="make1" id="make1" placeholder="Make" class="form-control"></p>
                                                <p><input type="text" name="description1" id="description1" placeholder="Description" class="form-control"></p>
                                                </td>
                                                <input type="hidden" name="enquiry_id1" value="<?=$detail->enquiry_id?>" id="enquiry_id1">
                                                <input type="hidden" name="enquiry_for1" value="<?=$detail->enquiry_for?>" id="enquiry_for1">                                                
                                                <td class="center"><input type="text" onblur="addamount(this)" class="form-control" name="unit_price1" id="unit_price1"></td>
                                                <td class="center"><input type="number" onblur="addamount(this)" class="form-control" name="quantity1" id="quantity1"></td>
                                                <td class="center"><input type="text" name="amount1" class="form-control" id = "amount1" readonly></td>
                                                
                                            </tr>
                                        <?php }?>    
                                        </tbody> 
                                        
                                    </table>                                
                                
                                <b><u>Term and Conditions</u></b>
                            
                                    <table class="table full-width">
                                        <thead>
                                            <tr>
                                                <td class="center">Price:</td><td><input value="Ex-Works Faridabad" type="text" name="price" required></td>
                                                <td class="center">Payment:</td><td><input value="100% Advance" type="text" name="payment" required></td>
                                            </tr>
                            
                                            <tr>
                                                <td class="center">GST:</td><td><input value="Extra As Applicable" type="text" name="gst" required></td>
                                                <td class="center">Validity:</td><td><input value="20 Days" type="text" name="validity" required></td>
                                            </tr>                                            
                                            
                                            <tr>
                                                <td class="center">Delivery:</td><td><input value="6-8 Weeks" type="text" name="delivery" required></td>
                                                <td class="center">Warranty:</td><td><input value="12 Months From Date Of Delivery" type="text" name="warranty" required></td>
                                            </tr>                                            
                                            
                                        </thead>
                                        
                                    </table>
                              <br>
                                <p>Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                                
                                <p>Your truly<br>For Intellitest Solutions Pvt. Ltd.</p>
                                
                                <p><input type="text" name="executive_name" value="Chandani Mehta" required></p>
                                <p>Sales Executive - <input type="text" name="executive_number" value="+91-9250059893" required></p>
                                <p><input type="text" name="executive_email" value="chandni@intellitest.co.in" required></p>
                                
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

function addamount(elem){

    var id = $(elem).attr("id");
    var lastChar = id[id.length -1];
    
    var amountid = "amount".concat(lastChar);
    var unit_price = document.getElementById("unit_price".concat(lastChar)).value;
    var quantity = document.getElementById("quantity".concat(lastChar)).value;
    // alert(unit_price); 
    document.getElementById("amount".concat(lastChar)).value= unit_price  *  quantity;
}

    $(document).ready(function(){
        $("#preview").on('click',function(e){
            e.preventDefault();
            $('#overlay').fadeIn();
            let myForm = document.getElementById("frm_quotation");
            var data = new FormData(myForm);
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
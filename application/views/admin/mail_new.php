<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<title>Admin Panel</title>
	
    <!-- google font -->
    
	<!-- dropzone -->
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');
		*{margin: 0;padding: 0;}
		html,body,nav,header,footer,main,hgroup,h1,h2,h3,h4,h5,h6,span,strong,p,ol,ul,aside,figure,figcaption{margin:0;padding: 0;}
		body{overflow-x: hidden;background: #fff;font-family: 'Poppins', sans-serif;}
		ol,ul,li{list-style:none;}
		a{text-decoration:none !important;outline:none;}
		a:focus{border:none;}
		a img{border:none;}
		img{width: 100%;}
		.clear{clear:both;}
		.topheader{width: 100%;margin:0;padding: 10px 0px;overflow: hidden;position: fixed;top: 0;left: 0;box-sizing: border-box;}
		.topheader .logo{float: left;width:328px; }
		.topheader .info{display: inline-block;float: right;text-align: right;font-size: 15px;line-height: 18px;color: #000;}
		.pdffooter{width: 100%;margin:0;padding: 10px 0px;overflow: hidden;position: fixed;bottom: 0;left: 0;box-sizing: border-box;}
		.pdffooter .innerfooter{width: 100%;margin:0;padding: 10px 0 0;border-top: 3px solid #e12120;overflow: hidden;}
		.pdffooter .leftpart{display: inline-block;float: left;padding-left: 0px;}
		.pdffooter h1{font-size: 30px;font-weight: 600;color: #000;line-height: 30px;}
		.pdffooter .leftpart p{font-size: 12px;line-height: 17px;color: #414141;}
		.pdffooter .rightpart{display: inline-block;float: right;}
		.pdffooter .rightpart p{font-size: 12px;line-height: 17px;text-align: right;margin:0;padding:0;}
		.contentpart{width: 100%;text-align: left;overflow: hidden;margin-top: 90px;background: #f6f6f6;position: relative;}
		.tableformate{width:100%;max-width:100%; margin:10px 0; text-align: center;}
		.tableformate table{border:1px solid #ddd;border-collapse: collapse; width:100%;}
		.tableformate th{font-size:17px;line-height:24px;color:#000;background:#fff;padding:0 10px;font-weight:500;border:1px solid #ddd;}
		.tableformate td{font-size:16px;line-height:20px;color:#000;background:#fff;padding:10px 10px;border:1px solid #ddd;}

	</style>
    <link href="https://checkmysite.co.in/crm/assets/admin/plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script> 
    window.onload = function () {
 
    var url = $(location).attr('href');
    var segments = url.split( '/' );
    var id = segments[4]; 
    var element = document.getElementById('print');
    var opt = {
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 1 },
      jsPDF:        { unit: 'mm', format: 'letter', orientation: 'portrait' }
    };
    //html2pdf().from(element).set(opt).save();
    html2pdf().from(element).set(opt).toPdf().output('datauristring').then(function (pdfAsString) {
        // The PDF has been converted to a Data URI string and passed to this function.
    var arr = pdfAsString.split(',');
    pdfAsString= arr[1];    
    
					$.ajax({
							 url:"https://checkmysite.co.in/crm/handle-pdf",
							 type:"post",
							 data:{ pdf_data:pdfAsString,
							 		id:id
							 		},
							 success: function(dataResult){
							 	var dataResult=JSON.parse(dataResult);
							 	if(dataResult.statusCode==200)// if data is proccessed on server 
							 	{
							 	window.location.href = 'https://checkmysite.co.in/crm/sent-quotations';
							 	}
							 	else if(dataResult.statusCode==201)//if data process failed
							 	{
                                window.location.href = 'https://checkmysite.co.in/crm/sent-quotations';
							 	}
							 }
					});    
    /*
            var data = new FormData();
            data.append("data" , pdfAsString);
            data.append("id" ,id);
            var xhr = new XMLHttpRequest();
            xhr.open( 'post', 'https://checkmysite.co.in/crm/handle-pdf', true ); //Post the Data URI to php Script to save to server
            xhr.send(data); */
        
            }) 
    //window.location.href = 'https://checkmysite.co.in/crm/sent-quotations'; 
    }        
    </script>  	
</head>
<body >
    <div id ="print" style="position:relative;">
	<div class="topheader">
		<div class="logo"><img src="https://checkmysite.co.in/crm/assets/images/logo.png"></div>
		<div class="info">PAN: AAJCA0972A<br>CIN: U29128DL2011PTC212297</div>
	</div><!--[/topheader]-->

	<div class="contentpart">
		<p style="line-height:20px !important;margin-bottom:5px !important;font-size:14px;padding:0 !important;">Ref.No : <?=$detail[0]->quotation_number?></p>
        <p style="line-height:20px !important;margin-bottom:5px !important;font-size:14px;padding:0 !important;">Kind Attn : <?=$detail[0]->contact_person;?><?php if(!empty($detail[0]->person_designation)){?><br>Designation : <?=$detail[0]->person_designation;?><?php }?> <br><?=$detail[0]->organization;?> <br><?=$detail[0]->address.','.$detail[0]->city.','.$detail[0]->state.','.$detail[0]->country?></p>
        <p style="line-height:20px !important;margin-bottom:15px !important;font-size:14px;padding:0 !important;">Sub   : <?=$detail[0]->email_subject;?></p>
        <p style="line-height:20px !important;margin-bottom:15px !important;font-size:14px;padding:0 !important;">Dear Sir/Madam,<br><br> We thankfully acknowledge your above referred enquiry and take pleasure in quoting as per under mentioned terms and conditions - </p>
        <div class="tableformate">
        	<table>
        		<tr>
					<th class="center">No.</th>
					<th class="center">Item Description</th>
					<th class="center">Unit Price (<?=$detail[0]->currency;?>)</th>
					<th class="center">Quantity</th>
					<th class="center">Amount (<?=$detail[0]->currency;?>)</th> 
                </tr>
                <?php $i =1; foreach($detail as $data){?>
        		<tr>
        			<td><?=$i?></td>
        			<td><?php echo $data->enquiry; if(!empty($data->model)){ echo '<br>Model -'.$data->model;} if(!empty($data->make)){ echo '<br>Make -'.$data->make; } if(!empty($data->description)){ echo '<br><p style="text-align: justify;">'.$data->description.'</p>';}?></td>
        			<td><?=preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data->unit_price); ?></td>
        			<td><?=$data->quantity?></td>
        			<td><?=preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data->amount);?></td>
        		</tr>
        		<?php $i++; } ?> 
        	</table>
        </div>
        <b><u>Term and Conditions :</u></b>
                <table class=" full-width">
                    <tr>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Price:</td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;" width="300"><?=$detail[0]->price?></td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Payment:</td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;"><?=$detail[0]->payment?></td>
                    </tr>
                    <tr>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">GST:</td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;"><?=$detail[0]->gst?></td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Freight:</td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;">Extra as applicable</td>
                    </tr>
                    <tr>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Validity: </td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;"><?=$detail[0]->validity?></td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Installation:</td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;">Extra as applicable if required at your location</td>
                    </tr>
                    <tr>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Delivery: </td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;"><?=$detail[0]->delivery?></td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;font-weight:bold;">Warranty:</td>
                        <td style="line-height:20px !important;margin-bottom:0px !important;font-size:14px;padding:0 !important;"><?=$detail[0]->warranty?></td>
                    </tr>
                    
                </table>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;font-size:14px;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;margin-top:15px !important;font-size:14px;padding:0 !important;">Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                 <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;font-size:14px;padding:0 !important;">&nbsp;</p>
            	<p style="line-height:14px !important;margin-bottom:5px !important;font-size:14px;padding:0 !important;">Your truly: <br>For Intellitest Solutions Pvt. Ltd.</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;font-size:14px;padding:0 !important;"><?=$detail[0]->executive_name?><br>Sales Executive - <?=$detail[0]->executive_mobile?><br><?=$detail[0]->executive_email?></p>
                                
                                   
	</div>

	<div class="pdffooter" style="position: fixed;bottom: 0;left: 0;">
		<div class="innerfooter">
			<div class="leftpart" style="float: left;">
				<h1>Intellitest Solutions Pvt. Ltd.</h1>
				<p>Corp. Office:- BH-12A08 , Business Hub , Sector - 81 , Faridabad-121007(Delhi/NCR)</p>
				<div class="clear"></div>
				<p>Regd. Office:- 119-FF, Vardhman Star City Mall, Sector - 7, Dwarka, New Delhi - 110075</p>
				<div class="clear"></div>
				<p>Web:- www.intellitest.co.in</p>
			</div>
			<div class="rightpart" style="float: right;">
			<!--	<p>Toll Free : 1800123000003</p>
				<div class="clear"></div> -->
				<p>Telephone : +91-129-4096069</p>
				<div class="clear"></div>
				<p>Mobile : +91-9250059892-3</p>
				<div class="clear"></div>
				<p>Email : solutions@intellitest.co.in</p>
				<div class="clear"></div>
				<p>Email : intellitestspl@gmail.com</p>
			</div>
		</div>
	</div><!--[/footer]-->
	</div>
    <script src="https://checkmysite.co.in/crm/assets/admin/plugins/jquery/jquery.min.js" ></script>
    <script src="https://checkmysite.co.in/crm/assets/admin/plugins/popper/popper.min.js" ></script>
    <script src="https://checkmysite.co.in/crm/assets/admin/plugins/jquery-blockui/jquery.blockui.min.js" ></script>
	<script src="https://checkmysite.co.in/crm/assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    
    <script src="https://checkmysite.co.in/crm/assets/admin/plugins/bootstrap/js/bootstrap.min.js" ></script>
   
	<script src="https://checkmysite.co.in/crm/assets/admin/js/app.js" ></script>
    <script src="https://checkmysite.co.in/crm/assets/admin/js/layout.js" ></script>
	<script src="https://checkmysite.co.in/crm/assets/admin/js/theme-color.js" ></script>
	
    <script src="https://checkmysite.co.in/crm/assets/admin/plugins/datatables/jquery.dataTables.min.js" ></script>
 	<script src="https://checkmysite.co.in/crm/assets/admin/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js" ></script>
 	<script src="https://checkmysite.co.in/crm/assets/admin/js/pages/table/table_data.js" ></script>
	
	<script src="https://checkmysite.co.in/crm/assets/admin/plugins/material/material.min.js"></script>
	<script src="https://checkmysite.co.in/crm/assets/admin/js/pages/ui/animations.js" ></script>	
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
	<link href="https://checkmysite.co.in/crm/assets/admin/plugins/summernote/summernote.css" rel="stylesheet" type="text/css" />
    <link href="https://checkmysite.co.in/crm/assets/admin/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://checkmysite.co.in/crm/assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<!--bootstrap -->
	<link href="https://checkmysite.co.in/crm/assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="https://checkmysite.co.in/crm/assets/admin/plugins/material/material.min.css">
	<link rel="stylesheet" href="https://checkmysite.co.in/crm/assets/admin/css/material_style.css">
	<link rel="stylesheet" href="https://checkmysite.co.in/crm/assets/admin/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css">
	<!-- animation -->
	<link href="https://checkmysite.co.in/crm/assets/admin/css/pages/animate_page.css" rel="stylesheet">
	<!-- Template Styles -->
    <link href="https://checkmysite.co.in/crm/assets/admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://checkmysite.co.in/crm/assets/admin/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="https://checkmysite.co.in/crm/assets/admin/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="https://checkmysite.co.in/crm/assets/admin/css/theme-color.css" rel="stylesheet" type="text/css" />
	<!-- dropzone -->
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
      jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
      pageBreak: { mode: 'css', after:'.break-page'}
    };
    //html2pdf().from(element).set(opt).save();
    html2pdf().from(element).set(opt).toPdf().get('pdf').then(function () {
        
            }).save();
    //window.location.href = 'https://checkmysite.co.in/crm/sent-quotations'; 
    }        
    </script> 
<style>
    .table-checkable{}
    @media print{
      .table-checkable{} 
      .table-checkable p{line-height:20px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;}
    }
    body {
  background: rgb(204,204,204); 
}
</style>

<style type="text/css">
    
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  padding: 15px;
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
html, body {
  height: 100%;
  margin: 0;
}
.content {
  min-height: 100%;
}
.content-inside {
  padding: 5px;
  padding-bottom: 10px;
}
.footer {
  height: 50px;
  margin-top: -140px;
}
p {
    font-size: 14px;
    letter-spacing: 0;
    margin: 0 0 0px !important;
}

/*footer {
    position: fixed; 
    bottom: 40px; 
    left: 0px; 
    right: 0px;
    height: 120px; 

    
    background-color: #FFF;
    color:#808080;
    text-align: center;
    line-height: 15px;
    padding: 10px;
}*/
</style>
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
<!--    <div class="page-wrapper">
        
        <div class="page-container">

            <div class="page-content-wrapper">
                <div class="page-content"> -->
<?php 
    //echo '<pre>';
    //print_r($detail);

?>

                    <page size="A4" id="print">
			
                   <!--   <div class="row">
                        <div class="col-md-12"> -->
                            <div class="content" style="border-bottom:0px !important;">
                                <div class="content-inside">
                                    
                                    <table  class="table table-hover table-checkable order-column full-width">
                                        <thead>
                                            <tr>
												<th style="text-align: left;"><img src="https://checkmysite.co.in/crm/assets/images/logo.png" style="width:300px;"></th>
												<th style="text-align: right;">PAN : AAJCA0972F <br>CIN :U29128DL2011PTC212297</th>
                                            </tr>
                                        </thead>
                                    </table>
                                
                                <p style="line-height:20px !important;margin-bottom:5px !important;font-size:13px; font-weight:bold;padding:0 !important;">Ref.No : 123456</p>
                                <p style="line-height:20px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;">Kind Attn : ABC <br>Designation :ABC <br> ABC <br>Delhi, New Delhi , India</p>
                                <p style="line-height:20px !important;margin-bottom:15px !important;font-size:13px;padding:0 !important;">Sub   : Subject Here</p>
                                <p style="line-height:20px !important;margin-bottom:15px !important;font-size:13px;padding:0 !important;">Dear Sir/Madam,<br><br> We thankfully acknowledge your above referred enquiry and take pleasure in quoting as per under mentioned terms and conditions - </p>
                                    <table style="border:1px solid #808080;width:100%; margin-top:10px;  border-collapse: collapse; font-family: sans-serif;" id="Table1" class="table table-hover table-checkable order-column full-width" border="1" border-cossapse="collapse">
                                        <thead>
                                            <tr>
                                                <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 2%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">No.</th>
                                                <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 25%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Item Description</th>
                                                <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 4%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Unit Price (5000)</th>
                                                <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 1%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Quantity</th>
                                                <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 1%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Amount (2)</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        
                                        
                                        for($i=1;$i<=5;$i++){?>    
                                            <tr>
                                                <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;"><?=$i?></td>
                                                <td  style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">Product1 </br> ABC <br> XYZ<br>Make - Make 1 <br><p style="text-align: justify;">Test</p>
                                                </td>                                                
                                                <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">10000</td>
                                                <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">2</td>
                                                <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">20000</td>
                                            </tr>
                                                    
                                            <tr class="break-page"></tr>
                                        <?php } ?>    
                                        </tbody> 
                                    </table>                                
                                <!--<div style="page-break-before:always">&nbsp;</div> -->
                                <b><u>Term and Conditions :</u></b>
                                    <table class=" full-width">
                                        <tr >
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Price: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;" width="300">20000</td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Payment: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">20000</td>
                                        </tr>
                                        <tr >
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">GST: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">18%</td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Freight: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">Extra as applicable</td>
                                        </tr>
                                        <tr>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Validity: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">Life Time</td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Installation: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">Extra as applicable if required at your location</td>
                                        </tr>
                                        <tr>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Delivery: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;"> Done</td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Warranty: </td>
                                            <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">Yes</td>
                                        </tr>
                                        
                                    </table>
                              <br>
                              <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;font-size:13px;padding:0 !important;">&nbsp;</p>
                                <p style="line-height:14px !important;margin-bottom:5px !important;margin-top:15px !important;font-size:13px;padding:0 !important;">Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                                 <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;font-size:13px;padding:0 !important;">&nbsp;</p>
                            <p style="line-height:14px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;"C>Your truly: <br>For Intellitest Solutions Pvt. Ltd.</p>
                                <p style="line-height:14px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;"C>Executive_name<br>Sales Executive - Executive_mobile<br> Executive_email</p>

                       
                                </div>
                            </div>

                                <footer class="footer">
                                <hr style="background:red;height:2px;">
                                    <table class=" full-width" style="position:relative;bottom:0;left:0;border-bottom:none;">
                                        <thead>
                                            <tr>
                                                <th class="center"></th>
                                                <th class="center"></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody> 
                                            <tr>
                                                <td><b>Intellitest Solutions Pvt. Ltd.</b></td>
                                                <td style="text-align: right;font-size:12px;">Telephone : +91-129-4096069</td> 
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">Corp Office - 12A08, Bussiness Hub, Sector-81, Faridabad -121107(Delhi NCR)</td>
                                                <td style="text-align: right;font-size:12px;">Mobile : +91-9250059892</td> 
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">Regd Office - 119-FF, Vardhman Star City Mall, Sector-7, Dwarka, New Delhi -110075</td>
                                               <td style="text-align: right;font-size:12px;">Email : solutions@intellitest.co.in</td> 
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">Web : www.intellitest.co.in</td>
                                                <td style="text-align: right;font-size:12px;">Email : intellitestspl@gmail.com</td>
                                            </tr>                                            
                                        </tbody> 
                                        
                                    </table>                                
                                </footer>
   
                    <!--     </div>
                    </div> 	 -->				
					</page>
          <!--      </div>
            </div>

        </div>
        

    </div> -->

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
    <!-- end js include path -->	
</body>
</html>
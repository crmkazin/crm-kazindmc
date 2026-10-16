<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Guide Details</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
    @media print {
        html {
            -webkit-print-color-adjust: exact;
        }

        .print-data {
            page-break-after: always;
        }

        .noPrint {
            display: none;
        }
    }

    .text-center {
        text-align: center
    }
	
    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="print-head">Guide Details</div>
            </div>
        </div>

        <div class="row" style="margin:0 0px ">
            <div class="col-md-12 mt-2">
                <div class="in-pl">
					<table class="table table-bordered">
					<tr><td>
				
						<table class="table table-bordered">
							<tbody> 
								<tr>
									<th class="fadetbl" width="25%">Name</th>
									<th class="fadetbl" width="25%">Contact Number</th>                                
								</tr>                        
													   
								<tr class="odd gradeX">
									<td class="bg-white"><?= ucfirst($guide->name.' '.$guide->last_name); ?></td>
									<td class="bg-white"><?= ($guide->isd_codes.' '.$guide->contact_number) ?></td>                                
								</tr>  
								<tr>
									<th class="fadetbl" width="25%">Gender</th>
									<th class="fadetbl" width="25%">Languages</th>
									
								</tr>
								<tr>
									<td class="bg-white"><?= ucfirst($guide->gender) ?></td>
									<td class="bg-white"><?= $guide->languages ?></td>
									
								</tr>  
								<tr>
									<th class="fadetbl" width="25%">Location</th>
									<th class="fadetbl" width="25%">City</th>                               
								</tr>                        
													   
								<tr class="odd gradeX">
									<td class="bg-white"><?= $guide->location ?></td>
									<td class="bg-white"><?= $guide->city ?></td>                                
								</tr>  
								<tr>
									
									<th class="fadetbl" width="25%">State</th>
									<th class="fadetbl" width="25%">Country</th>
								</tr>
								 <tr>
									
									<td class="bg-white"><?= $guide->state ?></td>
									<td class="bg-white"><?= $guide->country ?></td>
								</tr>
							</tbody>
						</table>
						</td>
						<td class="text-center">
							<img src="<?php echo base_url('assets/guide/'.$guide->photo); ?>" height="225" width="75%">
						</td>
					</tr>
				 </table>
                    

                </div>
            </div>

        </div>
    </div>

</body>
<br>
<div class="content row noPrint">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
        <button class="btn btn-warning btn-sm"
            onclick="window.open('<?php echo base_url('print-guide-details?id=' . base64_encode($guide->id) . '&print=pdf'); ?>','_blank')">Save
            As Pdf</button>
        <!--<button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button>-->
    </div>
</div>
<br>

</html>
<script>
function exportHTMLToDoc() {
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
        "xmlns:w='urn:schemas-microsoft-com:office:word' " +
        "xmlns='http://www.w3.org/TR/REC-html40'>" +
        "<head><meta charset='utf-8'><title>" + '<?php echo $arrivals->enquiry_no; ?>' + "</title></head><body>";
    var footer = "</body></html>";
    var sourceHTML = header + document.getElementById("cnt-print-data").innerHTML + footer;

    var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
    var fileDownload = document.createElement("a");
    document.body.appendChild(fileDownload);
    fileDownload.href = source;
    fileDownload.download = '<?php echo $arrivals->enquiry_no . '_itinerary_voucher'; ?>.doc';
    fileDownload.click();
    document.body.removeChild(fileDownload);
}
</script>
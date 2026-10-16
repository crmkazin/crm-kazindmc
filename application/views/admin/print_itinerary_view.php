<?php
// Assuming you are in a CodeIgniter controller or using CI's DB instance
$arrival_id = $itinerary[0]->arrival_id;

// Run the query
$query = $this->db->query("
    SELECT * 
    FROM itinerary 
    LEFT JOIN arrivals ON itinerary.arrival_id = arrivals.id 
    WHERE itinerary.arrival_id = $arrival_id
");

// Fetch result
$result = $query->result();
$country_code = $result[0]->lead_isd_code;
$contact_number = $result[0]->lead_contact;
// $lead_num = $country_code . $contact_number;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Itinerary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
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
            text-align: center;
        }

        .table-img{
             border:none !important;
        }

         .table-img td, .table-img th, .table-img tr{
                  border:none;
        }
   
    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="print-head">ITINERARY</div>
            </div>
        </div>

        <div class="row" style="margin:0 0px">
            <?php if (!empty($itinerary)) { 
                ?>
                <div class="col-lg-12 text-center">
                    <div class="in-pl">
                        <label class="lab-data"><?php echo $data[0]->number_of_nights . ' Nights, ' . ($data[0]->number_of_nights + 1) . ' Days'; ?></label>
                        <label class="lab-data"><?php $char = substr($data[0]->enquiry_abbr, 1, 1);
                                                $locations = ['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan', 'U'=>'uzbekistan'];
                                                echo '(' . ucfirst($locations[$char]) . ')';
                                                ?></label>
                    </div>
                </div>
                <!--<div class="col-lg-12 head-space">-->
                <!--    <div class="row">-->
                <!--        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/1.jpg'); ?>" width="100%" height="125" /></div>-->
                <!--        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/2.jpg'); ?>" width="100%" height="125" /></div>-->
                <!--        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/3.jpg'); ?>" width="100%" height="125" /></div>-->
                <!--        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/4.jpg'); ?>" width="100%" height="125" /></div>-->
                <!--    </div>-->
                <!--</div>-->
                
                    <table width="100%" class="table-img" >
                        <tr>
                            <td width="25%" style="padding: 5px;"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/1.jpg'); ?>" width="100%" height="125" /></td>
                            <td width="25%" style="padding: 5px;"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/2.jpg'); ?>" width="100%" height="125" /></td>
                            <td width="25%" style="padding: 5px;"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/3.jpg'); ?>" width="100%" height="125" /></td>
                            <td width="25%" style="padding: 5px;"><img src="<?php echo base_url('assets/images/itinerary/' . $locations[$char] . '/4.jpg'); ?>" width="100%" height="125" /></td>
                        </tr>
                    </table>
                <div class="col-md-12 mt-2">
                    <div class="in-pl">
                        <?php
                        $i = 0;
                        $day = 1;
                        $itinerary_date = $itinerary[0];
                        foreach ($itinerary as $list) {
                            if ($i == 0 || $itinerary_date != $list->date) {
                                $sr = 0;
                        ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="bg-warning">
                                                <strong class="ms-3 text-white"> Day : <?= $day++ ?>
                                                    <?php //echo date('d M Y (l)', strtotime($list->date)); 
                                                    ?></strong>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="fadetbl" width="20%">
                                                <p class="text-black">Time</p>
                                            </th>
                                            <th class="fadetbl" width="55%">
                                                <p class="text-black">Activities</p>
                                            </th>
                                            <th class="fadetbl" width="25%">
                                                <p class="text-black">Remark</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php } ?>

                                    <tr>
                                        <!--<td class="bg-white"><?= ++$sr; ?></td>-->
                                        <td class="bg-white"><?php echo $list->time; ?> Hrs</td>
                                        <td class="bg-white">
                                            <?php if ($list->title <> '') {
                                                echo urldecode($list->title) . '<br>' . urldecode($list->content);
                                            } else {
                                                echo urldecode($list->content);
                                            } ?>
                                        </td>
                                        <td class="bg-white"><?php echo urldecode($list->remarks); ?></td>
                                    </tr>

                                    <?php
                                    $itinerary_date = $list->date;
                                    if (!array_key_exists($i + 1, $itinerary) || $itinerary_date != $itinerary[$i + 1]->date) { ?>
                                    </tbody>
                                </table>
                        <?php }
                                    $i++;
                                } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <br>
    <div class="content row noPrint">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
            <button class="btn btn-warning btn-sm" onclick="window.open('<?php echo base_url('print-itinerary-voucher?arrival_id=' . base64_encode($itinerary[0]->arrival_id) . '&print=pdf'); ?>','_blank')">Save As Pdf</button>
            <button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button>
            <select name="isd_codes" style="border-width: 0 !important;width: 100px;border-radius: 6px;">
                <?php 
                $selected = '+91';
                foreach ($country_isd_codes as $list) { ?>
                    <option value="<?= $list->isd_codes ?>" <?= ($list->isd_codes == $selected) ? 'selected' : '' ?>>
                        <?= $list->isd_codes . ' (' . $list->country . ')' ?>
                    </option>
                <?php } ?>
            </select>
            <input type="text" class="p-1 contact_number" value="" placeholder="Enter WhatsApp Number">
            <button type="button" class="btn btn-success btn-sm sendPdfBtn">Send PDF on WhatsApp</button>
            <div class="loader" style="display:none; position:relative; left: 398px; bottom: 48px;">
                <img src="<?= base_url('assets/images/loader.gif') ?>" width="66" alt="Loading..." />
            </div>

            <!-- <a href="<?php //echo base_url('admin/report/viewItineraryPdf') ?>" target="_blank" class="btn btn-info btn-sm">
            View PDF Page
            </a> -->
        </div>
    </div>
    <br>

    <!-- The Modal -->
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).on('click', '.sendPdfBtn', function(e) {
    e.preventDefault();

    var $parent = $(this).closest('div');
    var contact_number = $parent.find('.contact_number').val();
    var loader = $parent.find('.loader');
    let countryCode = $('select[name="isd_codes"]').val();
    if (!contact_number.trim()) {
        alert('Contact number should not be empty.');
        $('#loader').hide();
        return; // Stop execution
    }
    let fullNumber = countryCode + contact_number;

    loader.show();

    $.ajax({
        url: '<?= base_url('admin/report/sendPdfOnWhatsapp') ?>',
        type: 'POST',
        data: {
            contact_number: fullNumber
        },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            $parent.find('.contact_number').val('');
        },
        error: function(xhr) {
            alert('Failed to send PDF.');
            console.error(xhr.responseText);
        },
        complete: function() {
            loader.hide();
        }
    });
  });
</script>

<script>
    // function exportHTMLToDoc() {
    //     var enquiryNo = "<?php echo isset($arrivals->enquiry_no) ? addslashes($arrivals->enquiry_no) : 'Itinerary'; ?>";
    //     var fileName = enquiryNo + "_service_voucher.doc";

    //     var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
    //         "xmlns:w='urn:schemas-microsoft-com:office:word' " +
    //         "xmlns='http://www.w3.org/TR/REC-html40'>" +
    //         "<head><meta charset='utf-8'><title>" + enquiryNo + "</title></head><body>";

    //     var footer = "</body></html>";

    //     var content = document.getElementById("cnt-print-data").innerHTML;
    //     var sourceHTML = header + content + footer;

    //     var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        
    //     var fileDownload = document.createElement("a");
    //     fileDownload.href = source;
    //     fileDownload.download = fileName;

    //     // Append, trigger click, and remove
    //     document.body.appendChild(fileDownload);
    //     fileDownload.click();
    //     document.body.removeChild(fileDownload);
    // }
    
     function exportHTMLToDoc() {
        var enquiryNo = "<?php echo isset($arrivals->enquiry_no) ? addslashes($arrivals->enquiry_no) : 'Itinerary'; ?>";
        var fileName = enquiryNo + "_service_voucher.doc";

        var header = `
        <html xmlns:o='urn:schemas-microsoft-com:office:office'
            xmlns:w='urn:schemas-microsoft-com:office:word'
            xmlns='http://www.w3.org/TR/REC-html40'>
        <head>
            <meta charset='utf-8'>
            <title>${enquiryNo}</title>
            <style>
                body {
                    font-family: "Segoe UI", sans-serif;
                    background: #f5f5f5;
                    padding: 40px;
                    font-size: 11pt;
                    color: #333;
                }
                .text-center { text-align: center; }
                .print-head {
                    font-size: 26px;
                    font-weight: bold;
                    margin-bottom: 20px;
                }
                .lab-data {
                    font-size: 14px;
                    font-weight: bold;
                    margin: 4px 0;
                    display: block;
                }
                .row {
                    display: flex ;
                    display:inline-block !important;
                    flex-wrap: wrap;
                    margin-bottom: 10px;
                }
                .col-lg-3 {
                    width: 25%;
                    padding: 10px;
                }
                .col-lg-12, .col-md-12 {
                    width: 100%;
                    padding: 10px;
                }
                img {
                    max-width: 100%;
                    height: auto;
                    display: block;
                    border-radius: 4px;
                }
                    .table-img{
             border:none !important;
        }
        .table-img td, th, tr{
            border:none;
        }
            .print-head, .in-pl{
            text-align:center;
            }

            

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                    background: #fff;
                    font-size: 10.5pt;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px 10px;
                    vertical-align: top;
                }
                th {
                    background-color: #d4af37;
                    color: #000;
                    font-weight: bold;
                    text-align: left;
                }
            
                .text-white {
                    color: #fff !important;
                }
                .section {
                    margin-top: 30px;
                }
                .day-heading {
                    background: #bea65d;
                    color: white;
                    font-weight: bold;
                    padding: 8px;
                    font-size: 14pt;
                }
                    .fadetbl{
                    background-color:#e6d295;
                    }
            </style>
        </head>
        <body>
        `;

        var footer = "</body></html>";
        var content = document.getElementById("cnt-print-data").innerHTML;
        var sourceHTML = header + content + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        fileDownload.href = source;
        fileDownload.download = fileName;

        document.body.appendChild(fileDownload);
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }


</script>
</body>
</html>
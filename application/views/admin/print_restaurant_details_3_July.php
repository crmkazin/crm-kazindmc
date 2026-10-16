<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Itinerary</title>
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
                <div class="print-head">Restaurant Details</div>
            </div>
        </div>

        <div class="row" style="margin:0 0px ">


            <div class="col-md-12 mt-2">
                <div class="in-pl">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="fadetbl" width="25%">Restaurant Name</th>
                                <th class="fadetbl" width="25%">Speciality</th>
                                <th class="fadetbl" width="25%">Price Range</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
                                foreach ($result as $results) {
                                    ?>
                            <tr class="odd gradeX">
                                <td class="bg-white"><?= $results->name ?></td>
                                <td class="bg-white"><?= strtoupper($results->cuisine) ?></td>
                                <td class="bg-white"><?= $results->price_range ?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="fadetbl" width="25%">Restaurant Address</th>
                                <th class="fadetbl" width="25%">Restaurant Location</th>
                                <th class="fadetbl" width="25%">Restaurant Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
                                foreach ($result as $results) {
                                    ?>
                            <tr>
                                <td class="bg-white"><?= $results->restaurant_address ?></td>
                                <td class="bg-white"><?= $results->city . ', ' . $results->country ?></td>
                                <td class="bg-white text-center">
                                    <img src="<?php echo ($results->image != '') ? base_url() . 'uploads/restaurants/' . $results->image : 'assets/admin/images/no-image-icon.png'; ?>"
                                        width="90" height="90">
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="fadetbl" width="25%">Restaurant Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
                                foreach ($result as $results) {
                                    ?>
                            <tr>
                                <td class="bg-white" style="font-size: medium">
                                    <?= $results->description ?>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
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
            onclick="window.open('<?php echo base_url('print-restaurant-details?id=' . base64_encode($result[0]->id) . '&print=pdf'); ?>','_blank')">Save
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
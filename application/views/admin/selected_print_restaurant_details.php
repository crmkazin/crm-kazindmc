<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Restaurant Details</title>
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
                    <?php if (!empty($result)) {
                        foreach ($result as $results) { ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl" >Restaurant Name </th>
                                        <th class="bg-white" ><?= $results->name ?></th>
                                    </tr>
                                    <tr class="odd gradeX" >
                                        <th class="fadetbl" style="width:50%">Speciality</th>
                                        <td class="bg-white"><?= strtoupper($results->cuisine) ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl" style="width:50%">Price Range</th>
                                        <td class="bg-white"><?= $results->price_range ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Opening Time</th>
                                        <td class="bg-white"><?= $results->opening_time ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Closing Time</th>
                                        <td class="bg-white"><?= $results->closing_time ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Seating Capacity</th>
                                        <td class="bg-white"><?= $results->seating_capacity ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Address</th>
                                        <td class="bg-white"><?= $results->restaurant_address ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Location</th>
                                        <td class="bg-white"><?= $results->city . ', ' . $results->country ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Image</th>
                                        <td class="bg-white text-center">
                                            <img src="<?php echo ($results->image != '') ? base_url() . 'uploads/restaurants/' . $results->image : 'assets/admin/images/no-image-icon.png'; ?>"
                                                width="90" height="90">
                                        </td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <th class="fadetbl">Description</th>
                                        <td class="bg-white" style="font-size: medium">
                                            <?= $results->description ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

</body>
<br>
<div class="content row noPrint">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
        <?php
        $id_array = [];
        foreach ($result as $results) {
            // Push each id into the array
            array_push($id_array, $results->id);
        }
        $id_string = implode(',', $id_array);
        ?>
        <button class="btn btn-warning btn-sm"
            onclick="window.open('<?php echo base_url('selected-print-restaurant-details?ids=' . base64_encode($id_string) . '&print=pdf'); ?>','_blank')">Save
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
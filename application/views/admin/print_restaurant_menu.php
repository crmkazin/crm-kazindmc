<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $restaurant->name ?> Menu Report</title>
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

        .tr_rows>td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12 text-start logo-left bg-new"><img
                    src="<?php echo base_url(); ?>assets/admin/print/images/logo.png" class="mt-2 mb-2"></div>
        </div>
        <div class="row" style="margin:0 0px ">
            <div class="col-lg-12">
                <div class="print-head">RESTAURANT MENU</div>
            </div>

            <div class="col-lg-12">
                <div class="in-pl">

                </div>
            </div>

            <!-- Restaurant Menu -->

            <?php if (!empty($restaurant)) { ?>
                <div class="col-lg-12">
                    <div class="in-pl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-warning text-center"><strong class="text-white">Restaurant</strong></th>
                                    <th class="bg-warning text-center"><strong class="text-white">Restaurant Address</strong></th>
                                    <th class="bg-warning text-center"><strong class="text-white">City</strong></th>
                                    <th class="bg-warning text-center"><strong class="text-white">Country</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bg-light-back text-center"><strong><?= $restaurant->name ?></strong></td>
                                    <td class="bg-light-back text-center"><strong><?= $restaurant->restaurant_address ?></strong></td>
                                    <td class="bg-light-back text-center"><strong><?= $restaurant->city ?></strong></td>
                                    <td class="bg-light-back text-center"><strong><?= $restaurant->country ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($restaurant_menus)) { ?>
                <div class="col-lg-12">
                    <?php  $menu_count = count($restaurant_menus);
                            $i = 1;
                            foreach ($restaurant_menus as $arr_id => $meals) { 
                                // Only display the heading if there are multiple menus
                                if ($menu_count > 1) { ?>
                                   <h3 class="text-center mb-1"><strong>Menu Type - <?= $i++?> </strong></h3>
                                <?php }?>
                        <div class="in-pl">
                            <!-- Add a table for each Arrival ID -->
                            <table class="table table-bordered">
                                <thead>
                                    <!-- <tr>
                                        <th class="bg-light-back text-center" colspan="2">
                                            <strong>Arrival ID: <?= $arr_id ?></strong>
                                        </th>
                                    </tr> -->
                                    <tr>
                                        <th class="bg-warning text-center" style="width:30%"><strong>Meal Type</strong></th>
                                        <th class="bg-warning text-center"><strong>Cuisines</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($meals as $meal_type => $cuisines) { ?>
                                        <tr>
                                            <td class="bg-light-back text-center" style="width:30%"><strong><?= ucfirst(str_replace('_', ' ', $meal_type)) ?></strong></td>
                                            <td class="bg-light-back text-center"><?= implode(', ', $cuisines) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <!-- partial -->
        </div>

    </div>
</body>

<br>
<div class="content row noPrint">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
        <button class="btn btn-warning btn-sm"
            onclick="window.open('<?php echo base_url('print-restaurant-menu-report?restaurant=' . $this->input->get('restaurant') . '&arrival_id=' . $this->input->get('arrival_id') . '&print=pdf'); ?>', '_blank')">
            Save As Pdf
        </button>
        <!--<button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button>-->
    </div>
</div>
<br>

</html>
<!-- <script>
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

        fileDownload.download = '<?php echo $arrivals->enquiry_no . '_restaurant_voucher'; ?>.doc';

        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script> -->
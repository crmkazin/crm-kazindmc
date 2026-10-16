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
                <div class="print-head">ITINERARY</div>
            </div>
        </div>

        <div class="row" style="margin:0 0px ">

            <?php if (!empty($itinerary)) { ?>

                <div class="col-lg-12 text-center">
                    <div class="in-pl">
                        <label class="lab-data"><?php echo $data[0]->number_of_nights.' Nights, '.($data[0]->number_of_nights + 1) . ' Days'; ?></label>
                        <label class="lab-data"><?php $char = substr($data[0]->enquiry_abbr, 1, 1);
                        $locations = ['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
                        echo '('.ucfirst($locations[$char]).')';
                        ?></label>
                    </div>
                </div>
                <div class="col-lg-12 head-space">
                    
                    <div class="row">
                        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/'.$locations[$char].'/1.jpg'); ?>" width="100%" height="125"/></div>
                        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/'.$locations[$char].'/2.jpg'); ?>" width="100%" height="125"/></div>
                        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/'.$locations[$char].'/3.jpg'); ?>" width="100%" height="125"/></div>
                        <div class="col-lg-3"><img src="<?php echo base_url('assets/images/itinerary/'.$locations[$char].'/4.jpg'); ?>" width="100%" height="125"/></div>
                    </div>
                    
                </div>
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
                                                    <?php //echo date('d M Y (l)', strtotime($list->date)); ?></strong>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="fadetbl" width="10%">
                                                <p class="text-black">Time</p>
                                            </th>
                                            <th class="fadetbl" width="50%">
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

</body>
<br>
<div class="content row noPrint">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
        <button class="btn btn-warning btn-sm"
            onclick="window.open('<?php echo base_url('print-itinerary-voucher?arrival_id=' . base64_encode($itinerary[0]->arrival_id) . '&print=pdf'); ?>','_blank')">Save
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
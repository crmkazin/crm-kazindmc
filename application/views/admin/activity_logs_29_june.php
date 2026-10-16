<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Activity Log</title>
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

    .pagination-buttons {
    margin-bottom: 30px;
    display: flex;
    justify-content:space-between;
}
.pagination-buttons .btn {
    margin-right: 5px;
}

    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="print-head">ACTIVITY LOG</div>
            </div>
        </div>

<div class="row" style="margin:0px 0px">
<?php if (!empty($itinerary)) {
    // Group itinerary by date
    $grouped_itinerary = [];
    foreach ($itinerary as $list) {
        $grouped_itinerary[$list->date][] = $list;
    }
    $dates = array_keys($grouped_itinerary);

    // Get today's date
    $today_date = date('Y-m-d');

    // Find the index of today's date in the itinerary
    $today_date_index = array_search($today_date, $dates);

    // Get the current date index from query string, subtract 1 to make it 0-based
    $current_date_index = isset($_GET['day']) ? intval($_GET['day']) - 1 : ($today_date_index !== false ? $today_date_index : 0);

    // Ensure current_date_index is within bounds
    $current_date_index = max(0, min($current_date_index, count($dates) - 1));

    $current_date = $dates[$current_date_index];
    $current_itinerary = $grouped_itinerary[$current_date];

    // Function to format date as 26-June-2024
    function formatDate($date) {
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        return $dateObj->format('d-F-Y');
    }
?>
<div class="col-md-12 mt-2">
    <div class="in-pl">
        <div class="pagination-buttons">
            <?php if ($current_date_index > 0) { ?>
                <a href="?day=<?= $current_date_index ?>" class="btn btn-primary btn-xs">Previous</a>
            <?php } ?>
            <?php if ($current_date_index < count($dates) - 1) { ?>
                <a href="?day=<?= $current_date_index + 2 ?>" class="btn btn-primary btn-xs">Next</a>
            <?php } ?>
        </div>

        <?php
            $i = 0;
            $day = $current_date_index + 1; // Day starts from 1 and increments with each date index
            $sr = 0;
            $formattedDate = formatDate($current_date);
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="4" class="bg-warning">
                        <strong class="ms-3 text-white">Day: <?= $day ?> (<?= $formattedDate ?>)</strong>
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
                <?php foreach ($current_itinerary as $list) { ?>
                <tr>
                    <td class="bg-white"><?= $list->time ?> Hrs</td>
                    <td class="bg-white">
                        <?= $list->title !== '' ? urldecode($list->title) . '<br>' . urldecode($list->content) : urldecode($list->content) ?>
                    </td>
                    <td class="bg-white"><?= urldecode($list->remarks) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php }else{ ?>
    <div class="col-md-12 mt-2">
    <div class="in-pl">
        <h1 class="text-center">No Record Found...</h1>
    </div>
    </div>
<?php }?>
</div>


</body>

</html>
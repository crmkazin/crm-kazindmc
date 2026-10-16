<!DOCTYPE html>
<html>
<head>
    <title>Company Report</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #bbb; padding: 8px; text-align: left;background-color: #F2EFE7;}
        /* th { background-color: #F2EFE7; } */
        .company_logo{
            top:60px !important;
            max-width: 80px!important;
            max-width: 80px!important;
        }
    </style>
</head>
<body style="background-color:#EEEEEE;">
    <?php //print_r($report)?>

    <!-- <h2 class="" style="text-align:center;">Agent Productivity Report</h2> -->
     <table style="border:none;">
        <tr><th style="border:none; background-color:none;"><img class="company_logo" style="position:absolute; top:200px;" width="10%" height="10%" src="<?= base_url('assets/company/' . $report->company_logo) ?>" alt="Company Logo"></th><td style="border:none; background-color:none;"><h2 class="" style="text-align:center;">Agent Productivity Report</h2></td>
        </tr>
        
    </table>
    <table>
        <tr><th>Company Name</th><td><?= $report->name ?></td></tr>
        <tr><th>Company Address1</th><td><?= $report->address ?></td></tr>
        <tr><th>Company Address2</th><td><?= $report->address_2 ?>(<?= $report->pincode ?>)</td></tr>
        <tr><th>Contact Person Name</th><td><?= $report->contact_person ?></td></tr>
        <tr><th>Contact Person Number</th><td><?= $report->contact_person_isd_code ?><?= $report->contact_person_number ?></td></tr>
        <tr><th>Contact Person Email</th><td><?= $report->email ?></td></tr>
        <tr><th>Agent Since</th><td><?= date('d-M-Y',strtotime($report->date)) ?></td></tr>
        <tr>
        <th>Overall Revenue / Confirmed (Conversion %)</th>
        <td>
            $<?= number_format((float)$report->total_billing, 2) ?> /
            <?= (int)$report->confirm_count ?> 
            (<?= ($report->query_received > 0) ? round(($report->confirm_count / $report->query_received) * 100, 2) : 0 ?>%)
        </td>
    </tr>

    </table>

    <h3 class="center" style="text-align:center;">Synopsis</h3>
    <?php foreach ($yearly_data as $report): ?>
        <h3 style="text-align:center;">Year(<?= htmlspecialchars($report->year) ?>)</h3>
        <hr style="height:2px; background-color:#ccc;">
        <table>
            <tr>
                <th width="50%">Total Queries</th>
                <td width="50%">Total(<?= htmlspecialchars($report->total_queries) ?>) <?= htmlspecialchars($report->query_by_destination) ?></td>
            </tr>
            <tr>
                <th width="50%">Confirmed Files</th>
                <td width="50%">Total(<?= htmlspecialchars($report->confirm_count) ?>) <?= htmlspecialchars($report->confirm_by_destination) ?></td>
            </tr>
            <tr>
                <th width="50%">Cancelled at Arrival</th>
                <td width="50%">Total(<?= htmlspecialchars($report->cancel_at_arrival_count) ?>) <?= htmlspecialchars($report->cancel_by_destination) ?></td>
            </tr>
             <tr>
                <th width="50%">Total Revenue / Confirmed (Conversion %)</th>
                <td width="50%">$<?= number_format((float)$report->total_revenue, 2) ?> /
                <?= (int)$report->confirm_count ?> 
            (<?= ($report->total_queries > 0) ? round(($report->confirm_count / $report->total_queries) * 100, 2) : 0 ?>%)</td>
            </tr>
        </table>

    <?php endforeach; ?>
</body>
</html>

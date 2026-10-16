<!DOCTYPE html>
<html>
<head>
    <title>Company Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #bbb; padding: 8px; text-align: left;background-color: #F2EFE7;}
        /* th { background-color: #F2EFE7; } */
        
        .table-body {
            max-width: 1100px;
            background-color: #eee;
            padding: 65px;
            margin: 0 auto;
        }
        .company_logo{
            top:60px !important;
            max-width: 80px!important;
            max-width: 80px!important;
        }
    </style>
</head>
<body style="background-color:#fff;">
        <div class="table-body">
  <?php //print_r($report)?>
		   	
    <div class="container" style="display: flex;
    align-items: center;" >
        <img class="company_logo" width="10%" height="10%" src="<?= base_url('assets/company/' . $report->company_logo) ?>" alt="Company Logo">
        <h2 class="" style="text-align:center;text-align: center;width: 95%;
">Agent Productivity Report</h2>
    </div>
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
    <?php foreach ($yearly_data as $reports): ?>
        <h3 style="text-align:center;">Year(<?= htmlspecialchars($reports->year) ?>)</h3>
        <hr style="height:2px; background-color:#ccc;">
        <table>
            <tr>
                <th width="50%">Total Queries</th>
                <td width="50%">Total(<?= htmlspecialchars($reports->total_queries) ?>) <?= htmlspecialchars($reports->query_by_destination) ?></td>
            </tr>
            <tr>
                <th width="50%">Confirmed Files</th>
                <td width="50%">Total(<?= htmlspecialchars($reports->confirm_count) ?>) <?= htmlspecialchars($reports->confirm_by_destination) ?></td>
            </tr>
            <tr>
                <th width="50%">Cancelled at Arrival</th>
                <td width="50%">Total(<?= htmlspecialchars($reports->cancel_at_arrival_count) ?>) <?= htmlspecialchars($reports->cancel_by_destination) ?></td>
            </tr>
             <tr>
                <th width="50%">Total Revenue / Confirmed (Conversion %)</th>
                <td width="50%">$<?= number_format((float)$reports->total_revenue, 2) ?> /
                <?= (int)$reports->confirm_count ?> 
            (<?= ($reports->total_queries > 0) ? round(($reports->confirm_count / $reports->total_queries) * 100, 2) : 0 ?>%)</td>
            </tr>
        </table>

    <?php endforeach; ?>
    <?php
$userId = $this->session->userdata('id');

// Check if this user is HOD
$isHod = $this->db
    ->select('id')
    ->from('admin')
    ->where('id', $userId)
    ->where('hod', 'yes')
    ->get()
    ->row();

if (!$isHod): ?>
     <?php if (!empty($report->company)): ?>
        <div style="display:flex; justify-content:center; align-items:center; margin-top:50px;">
            <a href="<?= base_url('admin/report/download_agent_pdf1/' . $report->company) ?>" 
            class="btn btn-sm btn-success ms-2" 
            style="padding:15px; background:#00c292; width:100px; color:#fff; border-radius:10px;" 
            download title="Download PDF">
                <i class="fas fa-download" style="margin-left:5px;"><span style="margin-left:5px;">Save PDF</span></i>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>

    </div>

</body>
</html>

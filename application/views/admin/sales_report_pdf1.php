<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
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
    </style>
</head>
<body style="background-color:#ffff;">
    <div class="table-body" id="content">
    <?php 
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where_in('type', [5,6]);
        $this->db->where_not_in('id', 21);
        $this->db->where("FIND_IN_SET(REPLACE(".$this->db->escape($report->region).", ' ', ''), REPLACE(region, ' ', '')) >", 0, FALSE);
        $query = $this->db->get();
        $result = $query->result();
    ?>
		   	
    <h2 class="" style="text-align:center;">Sales Productivity Report</h2>
    <table>
        <tr><th>Region</th><td><?php echo ucfirst($report->region) ?></td></tr>
        <tr><th>Total query</th><td><?php echo $report->total_query?></td></tr>
        <tr><th>Confirm File</th><td><?php echo $report->confirm_file ?></td></tr>
        <tr><th>Cancel at arrival</th><td><?php echo $report->cancel_at_arrival_file ?></td></tr>
        <tr><th>Pax:</th><td><?php echo $report->total_num_persons ?></td></tr>
        <tr><th>Total revenue</th><td><?php echo '$' . $report->total_billing_dollar ?>/<?php echo $report->confirm_file ?>(<?= ($report->total_query > 0) ? round(($report->confirm_file / $report->total_query) * 100, 2) : 0 ?>%)</td></tr>
        <tr><th>Sales Person Name:</th><td><?php isset($result[0]->name) ? print_r($result[0]->name) :''; ?></td></tr>
        <tr><th>Sales Person Email:</th><td><?php isset($result[0]->email) ? print_r($result[0]->email) : ''; ?></td></tr>
        <tr><th>Sales Person Mobile:</th><td><?php isset($result[0]->isd_code) ? print_r($result[0]->isd_code): ''; ?><?php isset($result[0]->contact_number) ? print_r($result[0]->contact_number) : ''; ?></td></tr>
    </table>

<?php if(!empty($city_report)) : ?>
    <h3 style="margin-top: 40px; text-align:center;">City-wise Data</h3>
    <table>
        <thead>
            <tr>
                <th>City</th>
                <th>Total Queries</th>
                <th>Confirmed</th>
                <th>Cancel at Arrival</th>
                <th>Pax</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($city_report as $city): ?>
                <tr>
                    <td><?= ucfirst($city->city) ?></td>
                    <td><?= $city->total_queries ?></td>
                    <td><?= $city->confirmed_queries ?></td>
                    <td><?= $city->cancel_at_arrival ?></td>
                    <td><?= $city->total_pax ?></td>
                    <td>$<?= $city->total_revenue ?>/<?php echo $city->confirmed_queries ?>(<?= ($city->total_queries > 0) ? round(($city->confirmed_queries / $city->total_queries) * 100, 2) : 0 ?>%)</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    
    <?php if(!empty($yearlyreport)) : ?>
    <h3 style="margin-top: 40px; text-align:center;">Year-wise Data</h3>
    <?php
        $merged = array_merge($yearlyreport,$yearlycitywisedata);

        // Step 1: Group data by year
        $yearlyGrouped = [];
        foreach ($merged as $row) {
            $year = $row->year;
            if (!isset($yearlyGrouped[$year])) {
                $yearlyGrouped[$year] = ['region' => [], 'city' => []];
            }

            if (isset($row->region)) {
                $yearlyGrouped[$year]['region'][] = $row;
            } elseif (isset($row->city)) {
                $yearlyGrouped[$year]['city'][] = $row;
            }
        }
        krsort($yearlyGrouped);

        // Step 2: Output HTML
        foreach ($yearlyGrouped as $year => $types) {
            echo '<hr style="height:2px; background-color:#ccc;">';
            echo "<h2 style='margin-top: 30px; text-align:center;'>Year: $year</h2>";

            // REGION TABLE
            if (!empty($types['region'])) {
                echo "<h4 style='text-align:center;'>Region Summary</h4>";
                echo "<table border='1' cellpadding='6' cellspacing='0' style='border-collapse: collapse; width: 100%; margin-bottom: 20px;'>
                        <thead style='background-color: #f0f0f0;'>
                            <tr>
                                <th>Region</th>
                                <th>Total Queries</th>
                                <th>Confirmed</th>
                                <th>Cancel at Arrival</th>
                                <th>Total Pax</th>
                                <th>Revenue ($) / Confirmed (Ratio)</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($types['region'] as $region) {
                    

                    echo "<tr>
                            <td>" . ucfirst($region->region) . "</td>
                            <td>{$region->total_queries}</td>
                            <td>{$region->confirmed_queries}</td>
                            <td>{$region->cancel_at_arrival}</td>
                            <td>{$region->total_pax}</td>
                            <td>\${$region->total_revenue} / {$region->confirmed_queries}(" . 
                    (($region->total_queries > 0) 
                        ? round(($region->confirmed_queries / $region->total_queries) * 100, 2) . '%' 
                        : '0%') . "
                )</td>
                        </tr>";
                }
                echo "</tbody></table>";
            }

            // CITY TABLE
            if (!empty($types['city'])) {
                echo "<h4 style='text-align:center;'>City Breakdown</h4>";
                echo "<table border='1' cellpadding='6' cellspacing='0' style='border-collapse: collapse; width: 100%; margin-bottom: 40px;'>
                        <thead style='background-color: #f9f9f9;'>
                            <tr>
                                <th>City</th>
                                <th>Total Queries</th>
                                <th>Confirmed</th>
                                <th>Cancel at Arrival</th>
                                <th>Total Pax</th>
                                <th>Revenue ($) / Confirmed (Ratio)</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($types['city'] as $city) {

                    echo "<tr>
                            <td>" . ucfirst($city->city) . "</td>
                            <td>{$city->total_queries}</td>
                            <td>{$city->confirmed_queries}</td>
                            <td>{$city->cancel_at_arrival}</td>
                            <td>{$city->total_pax}</td>
                            <td>\${$city->total_revenue} / {$city->confirmed_queries}(" . 
                    (($city->total_queries > 0) 
                        ? round(($city->confirmed_queries / $city->total_queries) * 100, 2) . '%' 
                        : '0%') . "
                )</td>
                        </tr>";
                }
                echo "</tbody></table>";
            }
        }
        endif;
    ?>
        
    </div>
    <div style="display:flex; justify-content:center; align-items:center; margin-top:50px;">
        <form method="post" action="<?= base_url('admin/report/download_sales_pdf/' . rawurlencode($report->region)) ?>" download>
            <input type="hidden" name="location" value="<?= $filter['location'] ?? '' ?>">
            <input type="hidden" name="country" value="<?= $filter['country'] ?? '' ?>">
            <input type="hidden" name="state" value="<?= $filter['state'] ?? '' ?>">
            <input type="hidden" name="city" value="<?= $filter['city'] ?? '' ?>">
            <input type="hidden" name="date_from" value="<?= $filter['date_from'] ?? '' ?>">
            <input type="hidden" name="date_to" value="<?= $filter['date_to'] ?? '' ?>">
            <input type="hidden" name="quarter" value="<?= $filter['quarter'] ?? '' ?>">
            <input type="hidden" name="sales" value="<?= $filter['sales'] ?? '' ?>">
            <input type="hidden" name="enquiry_type" value="<?= $filter['enquiry_type'] ?? '' ?>">
            <input type="hidden" name="time_period" value="<?= $filter['time_period'] ?? '' ?>">
            <input type="hidden" name="exhibition"   value="<?= html_escape($this->input->get('exhibition')) ?>">
            <input type="hidden" name="acquiring_source"     value="<?= html_escape($this->input->get('acquiring_source')) ?>">                                        
            <button type="submit"
                class="btn btn-sm btn-danger me-2"
                style="padding:15px; background:#00c292; width:100%; color:#fff; border-radius:10px; border:none;" 
            title="Download PDF">
                <i class="fas fa-download" style="margin-left:5px;"><span style="margin-left:5px;">Save PDF</span></i>
            </button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #bbb; padding: 8px; text-align: left;background-color: #F2EFE7;}
    </style>
</head>
<body style="background-color:#EEEEEE;">
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
                    // $ratio = ($region->total_queries > 0)
                    // ? round(($region->confirmed_queries / $region->total_queries) * 100, 2) . '%'
                    // : '0%';

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
                    // $ratio = ($region->total_queries > 0)
                    // ? round(($region->confirmed_queries / $region->total_queries) * 100, 2) . '%'
                    // : '0%';

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
</body>
</html>

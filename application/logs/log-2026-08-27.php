<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-08-27 01:08:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 01:09:36 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 01:09:36 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 01:09:56 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 01:09:56 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 01:19:27 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 01:27:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 01:34:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 01:34:46 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 02:08:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 02:08:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 03:32:24 --> 404 Page Not Found: Media/system
ERROR - 2026-08-27 03:32:27 --> 404 Page Not Found: Wp-includes/js
ERROR - 2026-08-27 08:23:55 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 09:03:09 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 09:17:04 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 09:46:34 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 10:10:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '"GGE5583 \")
                    LEFT JOIN arrival_hotel_details ON arrival_...' at line 7 - Invalid query: 
            SELECT t.status_cnt, t.status 
            FROM (
                SELECT a.status, COUNT(*) AS status_cnt
                FROM (
                    SELECT arrivals.id, arrivals.enquiry_id, arrivals.status
                    FROM arrivals 
                    JOIN enquiry ON (enquiry.id = arrivals.enquiry_id AND enquiry.enquiry_no = "GGE5583 \")
                    LEFT JOIN arrival_hotel_details ON arrival_hotel_details.arrival_id = arrivals.id
                    WHERE 1=1 AND YEAR(enquiry.check_in_date) = 2026 AND enquiry.is_deleted = 0
                    GROUP BY arrivals.id, arrivals.enquiry_id
                ) a
                GROUP BY a.status
            ) t 
            GROUP BY t.status
        
ERROR - 2026-08-27 10:10:00 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:16:59 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 10:17:06 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 10:21:31 --> Severity: Warning --> Undefined variable $details /home/crmkazindmc/public_html/application/controllers/admin/Itinerary.php 735
ERROR - 2026-08-27 10:30:14 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:31:59 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:33:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 10:36:22 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:40:00 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:40:08 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:44:45 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 10:45:29 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 10:45:29 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 10:47:59 --> SQL Query: 
ERROR - 2026-08-27 10:49:17 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 10:49:29 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 10:49:31 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 10:49:59 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 10:50:15 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 10:50:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 10:51:21 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 10:51:21 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 10:53:49 --> SQL Query: 
ERROR - 2026-08-27 10:54:10 --> SQL Query: 
ERROR - 2026-08-27 10:54:21 --> SQL Query: 
ERROR - 2026-08-27 10:54:31 --> Severity: Warning --> Undefined array key 0 /home/crmkazindmc/public_html/application/controllers/admin/Hotel.php 2469
ERROR - 2026-08-27 10:56:11 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:56:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 10:56:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 10:57:57 --> Severity: Warning --> Undefined array key 0 /home/crmkazindmc/public_html/application/controllers/admin/Hotel.php 2469
ERROR - 2026-08-27 11:00:02 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:00:04 --> Severity: Warning --> Undefined array key 0 /home/crmkazindmc/public_html/application/controllers/admin/Hotel.php 2469
ERROR - 2026-08-27 11:01:13 --> Severity: Warning --> Undefined array key 0 /home/crmkazindmc/public_html/application/controllers/admin/Hotel.php 2469
ERROR - 2026-08-27 11:03:27 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:05:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 11:06:03 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 11:06:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:08:50 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:08:53 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:08:55 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 11:09:24 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:09:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:11:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:12:05 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:12:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 11:12:22 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:14:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:16:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:16:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 11:19:54 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 11:21:07 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 11:21:07 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 11:21:07 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:24:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:26:51 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:27:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:28:19 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:28:47 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:28:55 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:29:22 --> SQL Query: 
ERROR - 2026-08-27 11:29:26 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:29:26 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:29:56 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:25 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:30:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:30:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:31:23 --> SQL Query: 
ERROR - 2026-08-27 11:32:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:32:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:32:53 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:33:31 --> SQL Query: 
ERROR - 2026-08-27 11:34:52 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:35:13 --> SQL Query: 
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 11:38:27 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 11:39:11 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 11:40:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:12 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:40:26 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:26 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:40 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:40 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:49 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:49 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:40:49 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:20 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:20 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:20 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 11:41:48 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:41:57 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:43:29 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:43:43 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:44:06 --> SQL Query: 
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:44:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:44:19 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:44:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:45:08 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:45:08 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:45:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:45:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:46:44 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:46:58 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 11:46:58 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 11:47:48 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:48 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:48 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:48 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:47:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:48:00 --> SQL Query: 
ERROR - 2026-08-27 11:48:54 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:30 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:31 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:49:50 --> SQL Query: 
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:49:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:50:10 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:50:14 --> SQL Query: 
ERROR - 2026-08-27 11:50:14 --> SQL Query: 
ERROR - 2026-08-27 11:50:14 --> SQL Query: 
ERROR - 2026-08-27 11:50:14 --> SQL Query: 
ERROR - 2026-08-27 11:50:14 --> SQL Query: 
ERROR - 2026-08-27 11:50:14 --> SQL Query: 
ERROR - 2026-08-27 11:50:14 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:14 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:14 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:14 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:15 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:16 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:19 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:50:33 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:50:34 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:50:39 --> SQL Query: 
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:49 --> SQL Query: 
ERROR - 2026-08-27 11:50:49 --> SQL Query: 
ERROR - 2026-08-27 11:50:49 --> SQL Query: 
ERROR - 2026-08-27 11:50:49 --> SQL Query: 
ERROR - 2026-08-27 11:50:49 --> SQL Query: 
ERROR - 2026-08-27 11:50:49 --> SQL Query: 
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:50:54 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 11:50:54 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 11:50:54 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 11:50:55 --> SQL Query: 
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 11:50:59 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:51:09 --> SQL Query: 
ERROR - 2026-08-27 11:51:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:51:20 --> SQL Query: 
ERROR - 2026-08-27 11:51:20 --> SQL Query: 
ERROR - 2026-08-27 11:51:20 --> SQL Query: 
ERROR - 2026-08-27 11:51:20 --> SQL Query: 
ERROR - 2026-08-27 11:51:20 --> SQL Query: 
ERROR - 2026-08-27 11:51:20 --> SQL Query: 
ERROR - 2026-08-27 11:51:20 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:20 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:20 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:20 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:20 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:21 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:51:30 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:51:36 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:51:36 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:51:38 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:51:52 --> SQL Query: 
ERROR - 2026-08-27 11:51:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:52:08 --> SQL Query: 
ERROR - 2026-08-27 11:52:08 --> SQL Query: 
ERROR - 2026-08-27 11:52:08 --> SQL Query: 
ERROR - 2026-08-27 11:52:08 --> SQL Query: 
ERROR - 2026-08-27 11:52:08 --> SQL Query: 
ERROR - 2026-08-27 11:52:08 --> SQL Query: 
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:08 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:09 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:09 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:27 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> SQL Query: 
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:32 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:33 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:45 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> SQL Query: 
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:53 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:54 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:55 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:55 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:55 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:55 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:55 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:52:55 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:34 --> SQL Query: 
ERROR - 2026-08-27 11:53:34 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> SQL Query: 
ERROR - 2026-08-27 11:53:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:50 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:51 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:52 --> 404 Page Not Found: Uploads/transportation
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:53:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:54:49 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:55:01 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 11:55:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 11:55:51 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 11:55:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:03:04 --> Severity: error --> Exception: Unsupported operand types: int + string /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 7885
ERROR - 2026-08-27 12:03:20 --> Severity: error --> Exception: Unsupported operand types: int + string /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 7885
ERROR - 2026-08-27 12:03:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:03:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:03:29 --> Severity: error --> Exception: Unsupported operand types: int + string /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 7885
ERROR - 2026-08-27 12:03:30 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:03:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:03:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:03:37 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:08:33 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:08:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:08:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 12:08:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:08:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:08:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:08:45 --> Severity: Warning --> Undefined array key "" /home/crmkazindmc/public_html/application/controllers/admin/Arrivalchart.php 2010
ERROR - 2026-08-27 12:08:45 --> Severity: Warning --> Undefined array key "" /home/crmkazindmc/public_html/application/controllers/admin/Arrivalchart.php 2010
ERROR - 2026-08-27 12:08:50 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:09:14 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:09:53 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:10:08 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:10:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:10:29 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:10:43 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:12:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:13:27 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:13:28 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 12:13:28 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 12:13:28 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 12:13:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:14:35 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:15:29 --> Severity: Warning --> Undefined variable $result1 /home/crmkazindmc/public_html/application/models/admin/Company_model.php 547
ERROR - 2026-08-27 12:15:29 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/crmkazindmc/public_html/system/core/Exceptions.php:272) /home/crmkazindmc/public_html/system/helpers/url_helper.php 565
ERROR - 2026-08-27 12:16:11 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:16:31 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:16:34 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:17:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:17:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:17:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:18:18 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:18:39 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:18:39 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:18:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:18:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:18:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:18:52 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:19:03 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:19:05 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:19:18 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '33', '', '108', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '15', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:20:53 --> Query error: Column 'same_time_checkbox' cannot be null - Invalid query: INSERT INTO `train_schedule` (`train_id`, `country`, `train_number`, `departing_station`, `arrival_station`, `type`, `ticket_price`, `economy_ticket_price`, `first_class_ticket_price`, `second_class_ticket_price`, `business_child_ticket_price`, `economy_child_ticket_price`, `first_class_child_ticket_price`, `second_class_child_ticket_price`, `bussines_child_age`, `economy_child_age`, `first_child_age`, `second_child_age`, `sitting_child_age`, `vip_child_age`, `sleeper_child_age`, `coupe_child_age`, `sv_child_age`, `sitting_ticket_price`, `vip_ticket_price`, `sleeper_class_ticket_price`, `coupe_class_ticket_price`, `sv_class_ticket_price`, `sitting_child_ticket_price`, `vip_child_ticket_price`, `sleeper_class_child_ticket_price`, `coupe_class_child_ticket_price`, `sv_class_child_ticket_price`, `same_time_checkbox`, `mon_dep_time`, `mon_arr_time`, `tue_dep_time`, `tue_arr_time`, `wed_dep_time`, `wed_arr_time`, `thu_dep_time`, `thu_arr_time`, `fri_dep_time`, `fri_arr_time`, `sat_dep_time`, `sat_arr_time`, `sun_dep_time`, `sun_arr_time`, `days_of_operations`, `created_by`) VALUES ('5', 'Azerbaijan', '710', 'Baku', 'Gabala', '[\"business_class\",\"first_class\",\"sitting\"]', '33', '', '108', '', '', '', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '15', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '07:30', '11:06', '07:30', '11:06', 'saturday,sunday', '101')
ERROR - 2026-08-27 12:21:38 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 12:21:38 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 12:22:04 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:22:33 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:22:41 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:22:50 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:22:56 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:23:43 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:24:15 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:24:15 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:24:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:24:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:25:14 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:25:16 --> SQL Query: 
ERROR - 2026-08-27 12:25:16 --> SQL Query: 
ERROR - 2026-08-27 12:25:22 --> SQL Query: 
ERROR - 2026-08-27 12:26:11 --> SQL Query: 
ERROR - 2026-08-27 12:26:11 --> SQL Query: 
ERROR - 2026-08-27 12:26:44 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:26:59 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:28:05 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:30:13 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 12:31:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 12:32:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:32:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:33:43 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:33:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:33:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:34:00 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:34:21 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:34:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:35:33 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:34 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:34 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:35:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:36:16 --> SQL Query: 
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:37:40 --> SQL Query: 
ERROR - 2026-08-27 12:37:47 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 12:37:47 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 12:37:47 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 12:38:13 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:38:23 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:39:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:39:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:39:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:39:45 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:39:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:39:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:40:07 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:41:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:41:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:41:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:41:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:41:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:41:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:41:56 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:41:56 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:42:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:42:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:42:12 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 12:42:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:42:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:42:43 --> SQL Query: 
ERROR - 2026-08-27 12:43:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 12:43:30 --> Query error: Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8mb4_general_ci,COERCIBLE) for operation 'like' - Invalid query: SELECT *
FROM `guides`
WHERE `name` like '%То%'
AND `status` = 'active'
AND LOWER(country) = 'kazakhstan'
 LIMIT 10
ERROR - 2026-08-27 12:43:31 --> Query error: Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8mb4_general_ci,COERCIBLE) for operation 'like' - Invalid query: SELECT *
FROM `guides`
WHERE `name` like '%Тог%'
AND `status` = 'active'
AND LOWER(country) = 'kazakhstan'
 LIMIT 10
ERROR - 2026-08-27 12:43:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:43:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:44:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 12:45:01 --> SQL Query: 
ERROR - 2026-08-27 12:45:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:45:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:45:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:45:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:45:52 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 12:45:52 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 12:46:24 --> SQL Query: 
ERROR - 2026-08-27 13:08:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:08:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:08:59 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:09:07 --> Severity: Warning --> Undefined array key "isd_code" /home/crmkazindmc/public_html/application/controllers/admin/BriefItinerary.php 932
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:08 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:09:20 --> SQL Query: 
ERROR - 2026-08-27 13:14:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:15:03 --> Severity: Warning --> Undefined array key "isd_code" /home/crmkazindmc/public_html/application/controllers/admin/BriefItinerary.php 932
ERROR - 2026-08-27 13:15:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:15:40 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:15:40 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:15:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:15:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:16:19 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:16:19 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:16:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:16:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:16:38 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:38 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:38 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:44 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:44 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:48 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:16:48 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:48 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:49 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:16:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:17:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:18:12 --> SQL Query: 
ERROR - 2026-08-27 13:18:31 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:18:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:19:18 --> SQL Query: 
ERROR - 2026-08-27 13:20:03 --> Severity: Warning --> Undefined array key "isd_code" /home/crmkazindmc/public_html/application/controllers/admin/BriefItinerary.php 932
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 13:20:11 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 13:20:49 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:21:03 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:21:05 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:21:12 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:21:29 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:21:30 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:21:46 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:22:02 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:22:09 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:22:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:22:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:22:42 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:22:56 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:23:07 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:23:07 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:23:24 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:23:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:23:33 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:23:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:23:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:23:49 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:23:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:23:54 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:24:01 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:24:03 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:24:03 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:24:03 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:24:12 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:24:46 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:24:47 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:24:53 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:25:21 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:25:23 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:25:54 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:25:55 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:02 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:26:02 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:26:07 --> SQL Query: 
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:26:10 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:26:10 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:26:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:26:25 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:26:35 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:26:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:26:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:27:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:27:25 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:27:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:27:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:27:47 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:47 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:47 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:50 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:50 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:27:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:28:19 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:28:19 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:28:20 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:28:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:28:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:28:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:28:32 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:28:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:29:10 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 13:29:10 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 13:29:10 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:30:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:31:16 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:31:16 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:31:26 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-08-27 13:31:40 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:31:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:31:43 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:31:44 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:31:46 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:31:54 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:14 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:19 --> SQL Query: 
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:32:30 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:32:41 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:32:42 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:32:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:32:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:32:47 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:32:52 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:32:52 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:32:58 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:33:08 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:33:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:33:47 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:33:47 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:34:03 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:34:36 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:34:36 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:34:38 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 13:34:38 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 13:34:45 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 13:34:49 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 13:34:53 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:35:21 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:35:30 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:35:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:36:23 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:36:37 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:36:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:36:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:37:14 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:37:27 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:37:28 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:37:34 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:37:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:37:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:38:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:38:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:38:30 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:38:33 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:38:34 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 13:38:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:38:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> SQL Query: 
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:39:41 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:40:03 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:40:03 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:40:38 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:40:38 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:40:51 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:41:00 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:41:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:41:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:41:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:41:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:41:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:16 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:24 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:41:24 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:41:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> SQL Query: 
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:07 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:42:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:42:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:43:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:43:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:43:09 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:43:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:43:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:43:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:44:09 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:44:09 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:44:10 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:44:10 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:44:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:44:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:44:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:44:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:44:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:44:28 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:44:30 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:44:49 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:44:59 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:44:59 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:45:26 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:45:26 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:46:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:46:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:46:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:46:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:47:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:47:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:49:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:50:36 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:50:46 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:50:47 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:50:57 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:51:07 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:51:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:51:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:51:22 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:51:22 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:51:26 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:51:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 13:52:05 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:13 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:13 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:29 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:29 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:29 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:33 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:33 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:52:33 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:53:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:53:01 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:53:29 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 13:54:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:54:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:55:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:55:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:56:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:56:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:56:25 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:56:48 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 13:57:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:57:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:57:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:57:51 --> SQL Query: 
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:54 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:57:58 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:57:58 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:57:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:58:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:58:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 13:58:08 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:58:08 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:58:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:58:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:58:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:58:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:58:29 --> SQL Query: 
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:58:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:59:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 13:59:46 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry.php 155
ERROR - 2026-08-27 14:01:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:01:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:02:34 --> SQL Query: 
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:03:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:03:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:04:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:05:42 --> SQL Query: 
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:05:59 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:06:14 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:06:15 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:07:22 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:07:22 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:07:39 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:08:20 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:08:20 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:09:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:10:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:10:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:10:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:10:46 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:10:46 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:10:46 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:10:57 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:10:57 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:11:04 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:11:05 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:11:07 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:11:08 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:11:17 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:11:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:11:37 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:11:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:11:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:11:46 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:12:01 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:12:05 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:12:05 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:12:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:12:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:12:10 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:12:10 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:13:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:13:47 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 14:13:47 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 14:13:47 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:14:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:14:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:15:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:15:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:15:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:16:09 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:16:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:16:27 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:16:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:16:40 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:16:41 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:17:04 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 14:17:04 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 14:17:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:19:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:20:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:20:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:21:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:21:27 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:21:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:21:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:21:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:22:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:23:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:25:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:25:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:26:50 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:27:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:28:37 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:28:38 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:28:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:29:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:29:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:30:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:33:22 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:34:16 --> SQL Query: 
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:34:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:39:31 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:40:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:41:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/combo_enquiry_edit.php 153
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:42:02 --> SQL Query: 
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:42:03 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:43:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 14:43:49 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:43:59 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:46:28 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 14:47:57 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:48:56 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:49:53 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 14:52:58 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 14:53:11 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 14:55:06 --> Severity: error --> Exception: Unsupported operand types: int + string /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 7885
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:55:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 14:56:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:00:43 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:01:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:01:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:04:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:07:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:07:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:10:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:10:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:10:55 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:12:03 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:13:33 --> SQL Query: 
ERROR - 2026-08-27 15:14:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:14:25 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:14:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:16:06 --> SQL Query: 
ERROR - 2026-08-27 15:17:22 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:19:06 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:19:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:20:00 --> SQL Query: 
ERROR - 2026-08-27 15:21:25 --> SQL Query: 
ERROR - 2026-08-27 15:24:47 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:25:48 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:26:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:26:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> SQL Query: 
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:27:43 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:29:50 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:31:17 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:31:17 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:31:30 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:31:30 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:32:09 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:32:11 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:32:11 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:32:16 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:32:16 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 15:32:17 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:32:18 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:32:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:33:04 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:33:04 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:34:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:34:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:36:10 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:36:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:36:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:36:39 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:36:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:36:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:40:13 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 15:40:13 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 15:40:31 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:41:00 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:41:17 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 15:41:17 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 15:41:26 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> SQL Query: 
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:42:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:44:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:47:40 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:47:54 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:47:55 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:48:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:48:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:48:25 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:48:40 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:49:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:49:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:49:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:50:28 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:50:28 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:52:07 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:52:07 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:52:07 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 15:52:12 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:52:18 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:52:20 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:52:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 15:52:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 15:52:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:52:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:53:22 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 15:53:22 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 15:53:47 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 15:53:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:53:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:55:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:55:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:56:06 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 15:56:06 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 15:57:29 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 15:57:29 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 15:57:37 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 15:57:37 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 15:57:58 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:58:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:58:35 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 15:58:52 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 15:58:52 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:00:16 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 16:00:16 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 16:00:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:00:40 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:00:40 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:01:20 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:01:20 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:01:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:02:07 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 16:02:07 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 16:02:07 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 16:02:43 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:02:45 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:02:50 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:02:57 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2026-08-27 16:02:57 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:02:57 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:10 --> SQL Query: 
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:05:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:26 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:27 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:36 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:41 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:46 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:05:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:06:02 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:07:33 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:08:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM enquiry WHERE enquiry.id = 
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:08:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:08:51 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> SQL Query: 
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> SQL Query: 
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:09:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:10:15 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:11:03 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:11:06 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:11:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:11:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:11:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:11:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:12:03 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:13:08 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:13:17 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:13:18 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:14:02 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 16:14:02 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 16:14:02 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 16:14:26 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 16:14:28 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 16:14:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:18:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:18:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:19:47 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:19:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:08 --> SQL Query: 
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> SQL Query: 
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:20:55 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:21:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:22:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:22:49 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:22:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:23:13 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:23:17 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:23:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:23:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:24:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:24:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:25:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:27:52 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:28:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:29:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:29:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:29:38 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:29:42 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:30:04 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:30:12 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:32:35 --> Severity: Warning --> Undefined variable $location_masters /home/crmkazindmc/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-08-27 16:32:35 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-08-27 16:34:34 --> SQL Query: 
ERROR - 2026-08-27 16:34:58 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:35:01 --> SQL Query: 
ERROR - 2026-08-27 16:35:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:35:17 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:36:28 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:36:31 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:36:34 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:36:37 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:37:08 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 16:37:09 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:37:09 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:37:38 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:37:38 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:37:43 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:37:44 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 16:37:52 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 16:37:54 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:37:54 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:37:56 --> 404 Page Not Found: Wp-json/batch
ERROR - 2026-08-27 16:37:57 --> 404 Page Not Found: Wp-json/batch
ERROR - 2026-08-27 16:37:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:37:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:37:59 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:37:59 --> 404 Page Not Found: Assets/admin
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 16:38:41 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 16:39:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:39:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:40:00 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:40:00 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:40:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:40:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:40:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:40:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:40:56 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:41:11 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:15 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:18 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:21 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:25 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:25 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:53 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:41:53 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:47 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> SQL Query: 
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:43:54 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:44:06 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:45:53 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:45:53 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:46:58 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:47:30 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:47:37 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:47:48 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:48:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:48:58 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:49:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:49:35 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:49:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:50:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:50:32 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:50:40 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:51:07 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:51:08 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:51:16 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:52:46 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:53:32 --> SQL Query: 
ERROR - 2026-08-27 16:53:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:54:56 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> SQL Query: 
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:00 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 16:55:01 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 16:55:18 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:56:05 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 16:56:33 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:00:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:01:15 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:01:54 --> Severity: Warning --> Undefined variable $location_masters /home/crmkazindmc/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-08-27 17:01:54 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-08-27 17:02:29 --> Severity: Warning --> Undefined variable $Transfer Tashkent - Khiva by Train /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 3569
ERROR - 2026-08-27 17:02:30 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:02:47 --> Severity: Warning --> Undefined variable $location_masters /home/crmkazindmc/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-08-27 17:02:47 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-08-27 17:02:51 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:03:03 --> Severity: Warning --> Undefined variable $Transfer Tashkent - Khiva by Train /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 3569
ERROR - 2026-08-27 17:03:03 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:03:27 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:03:55 --> SQL Query: 
ERROR - 2026-08-27 17:06:06 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 17:06:06 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 17:06:06 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:08:56 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 17:08:56 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 17:08:56 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 17:09:25 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:09:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:09:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:10:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:14:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:14:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:14:40 --> Severity: Warning --> Undefined property: stdClass::$isd_code /home/crmkazindmc/public_html/application/controllers/admin/Login.php 665
ERROR - 2026-08-27 17:14:55 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> SQL Query: 
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:15:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:16:32 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 17:16:32 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 17:16:32 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:16:41 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10437
ERROR - 2026-08-27 17:16:43 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:24 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> SQL Query: 
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:17:56 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:17:56 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:18:12 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:18:12 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:18:12 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:18:18 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:18:19 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:18:23 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:18:23 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:19:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:19:14 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:19:46 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:19:46 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:20:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:20:06 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:21:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:22:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:32 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:22:45 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:23:19 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:23:19 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:23:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:09 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:24:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:24:43 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:25:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '1'
AND `status` = 'active'
 LIMIT 10' at line 3 - Invalid query: SELECT *
FROM `company`
WHERE `name` like '%GETSETGO TOURS&TRAVELS'%'
AND `is_deleted` != '1'
AND `status` = 'active'
 LIMIT 10
ERROR - 2026-08-27 17:26:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '1'
AND `status` = 'active'
 LIMIT 10' at line 3 - Invalid query: SELECT *
FROM `company`
WHERE `name` like '%GETSETGO TOURS&TRAVELS'%'
AND `is_deleted` != '1'
AND `status` = 'active'
 LIMIT 10
ERROR - 2026-08-27 17:26:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:26:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:26:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:26:25 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:26:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:02 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:27:44 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 17:28:15 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:26 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:28:47 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:29:39 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:30:17 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:30:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> SQL Query: 
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:31:26 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:31:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:31:35 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:32:04 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:32:04 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:32:06 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:32:07 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:32:07 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:32:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:32:51 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:33:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:34:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:34:30 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:34:56 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:35:04 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:35:04 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:35:05 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:35:14 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:35:16 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:35:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:35:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:35:24 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:35:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:35:28 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 17:36:12 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 17:36:29 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:38:00 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:38:47 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:38:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:38:55 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:39:09 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:39:09 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:39:10 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:39:24 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:39:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:39:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:39:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:39:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:40:07 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:40:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:40:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:40:57 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:41:48 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:41:59 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:42:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:42:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:42:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:43:23 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:25 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:34 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:34 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:43 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:43 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:43 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:43:58 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:44:01 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:45:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:45:45 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:15 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> SQL Query: 
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:21 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:46:23 --> Severity: Warning --> Undefined array key 0 /home/crmkazindmc/public_html/application/controllers/admin/Hotel.php 2469
ERROR - 2026-08-27 17:46:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:46:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:46:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:46:41 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:46:55 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:47:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:47:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:47:10 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2026-08-27 17:47:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:47:10 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2026-08-27 17:47:12 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:47:12 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:47:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:47:30 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:47:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:47:44 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:48:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:48:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:48:27 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:48:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:48:53 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:48:53 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:49:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:49:00 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:49:06 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:49:23 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:49:32 --> 404 Page Not Found: Dist/manifest.json
ERROR - 2026-08-27 17:49:33 --> 404 Page Not Found: Asset-manifestjson/index
ERROR - 2026-08-27 17:49:33 --> 404 Page Not Found: Assets/manifest.json
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Rcloneconf/index
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Wp-json/index
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Envphpbak/index
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Webpack-statsjson/index
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Config/.env.php
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Authjson/index
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Static/manifest.json
ERROR - 2026-08-27 17:49:34 --> 404 Page Not Found: Configurationphpbak/index
ERROR - 2026-08-27 17:49:35 --> 404 Page Not Found: Envdev/index
ERROR - 2026-08-27 17:49:35 --> 404 Page Not Found: Core/.env
ERROR - 2026-08-27 17:49:35 --> 404 Page Not Found: Z9x8c7v6b5-debug-trigger-crmkazindmccom/index
ERROR - 2026-08-27 17:49:35 --> 404 Page Not Found: Manifestjson/index
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Envswp/index
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Public/.env
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Graphql/index
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Configphpbak/index
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Web/.env
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Wp/.env
ERROR - 2026-08-27 17:49:37 --> 404 Page Not Found: Storage/.env
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Wp-configphp~/index
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Wp-configold/index
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Applicationyml/index
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Applicationproperties/index
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Api/graphql
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Secure/index
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Config/application.properties
ERROR - 2026-08-27 17:49:38 --> 404 Page Not Found: Panel/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Wp-configphpswp/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Bootstrapyml/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: V1/graphql
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Account/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Forgot-password/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Console/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Backoffice/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Portal/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: App/index
ERROR - 2026-08-27 17:49:39 --> 404 Page Not Found: Config/secrets.yml
ERROR - 2026-08-27 17:49:40 --> 404 Page Not Found: Auth/login
ERROR - 2026-08-27 17:49:40 --> 404 Page Not Found: Auth/index
ERROR - 2026-08-27 17:49:40 --> 404 Page Not Found: Reset-password/index
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Actuator/configprops
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Account/login
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Actuator/env
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Actuator/threaddump
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Bootstrapproperties/index
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Signin/index
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Sign-in/index
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: Signup/index
ERROR - 2026-08-27 17:49:41 --> 404 Page Not Found: User/login
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: Users/login
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: AppsettingsDevelopmentjson/index
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: Gradle/gradle.properties
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: Appsettingsjson/index
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: Gradleproperties/index
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: Register/index
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: Webconfig/index
ERROR - 2026-08-27 17:49:42 --> 404 Page Not Found: AppsettingsProductionjson/index
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Config/master.key
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Config/database.yml
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Localsettingsjson/index
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Pypirc/index
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Streamlit/secrets.toml
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Settingspy/index
ERROR - 2026-08-27 17:49:43 --> 404 Page Not Found: Config/storage.yml
ERROR - 2026-08-27 17:49:44 --> 404 Page Not Found: Core/settings.py
ERROR - 2026-08-27 17:49:44 --> 404 Page Not Found: App/settings.py
ERROR - 2026-08-27 17:49:44 --> 404 Page Not Found: Docker/config.json
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:49:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> SQL Query: 
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:06 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 17:50:25 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:50:47 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:50:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:50:49 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:51:06 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:51:06 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:51:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:51:35 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:51:35 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:51:41 --> SQL Query: 
ERROR - 2026-08-27 17:51:41 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:51:42 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:51:49 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:12 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:52:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:52:35 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:53:04 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:53:04 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:53:21 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 17:53:50 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 17:53:50 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:54:06 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:54:14 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:54:18 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:54:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 17:54:47 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:55:00 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:55:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:55:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:55:21 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:55:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:55:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:56:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:56:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:56:48 --> Severity: error --> Exception: syntax error, unexpected token "else" /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 3548
ERROR - 2026-08-27 17:56:48 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:56:57 --> Severity: error --> Exception: syntax error, unexpected token "else" /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 3548
ERROR - 2026-08-27 17:56:57 --> Severity: error --> Exception: syntax error, unexpected token "else" /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 3548
ERROR - 2026-08-27 17:57:03 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 17:57:30 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:57:55 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:13 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:58:46 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 17:58:46 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 17:59:48 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:00:05 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:02:22 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:03:25 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:03:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:03:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:03:49 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:05:17 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 18:05:17 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 18:05:20 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:05:33 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:06:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:06:18 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:07:30 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:07:48 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:08:20 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:08:38 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:08:39 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:09:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:09:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:10:00 --> Severity: Warning --> Undefined variable $response /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 10438
ERROR - 2026-08-27 18:10:02 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:10:13 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:10:58 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 18:11:30 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:13:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:13:33 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:14:19 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:14:24 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:14:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:14:31 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:19 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:15:46 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:17:34 --> Severity: error --> Exception: syntax error, unexpected token "else" /home/crmkazindmc/public_html/application/controllers/admin/Quotation.php 3898
ERROR - 2026-08-27 18:17:34 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:17:39 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:17:57 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> SQL Query: 
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> SQL Query: 
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:09 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:18:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:19:15 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 18:19:20 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 18:19:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:19:27 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:19:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:19:34 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:20:02 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Undefined variable $total_cost /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8912
ERROR - 2026-08-27 18:20:05 --> Severity: Warning --> Undefined variable $day_total /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8919
ERROR - 2026-08-27 18:20:57 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:22:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:23:26 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:24:19 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:24:19 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:24:34 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:17 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:25:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:45 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> SQL Query: 
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:26:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:27:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:27:18 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:27:23 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:24 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:28:44 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:29 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> SQL Query: 
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:31 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:29:35 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 18:29:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:29:54 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:30:12 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:30:12 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:30:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:30:43 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:30:57 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:30:57 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:32:36 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:32:36 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:32:40 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:34:10 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:35:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:35:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:37 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:37:48 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:49 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:37:59 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:38:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:40:14 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 18:40:18 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 18:41:24 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:41:24 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:42:47 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:43:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:42 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:44:50 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:46:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:20 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:33 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:48:36 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:01 --> SQL Query: 
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:02 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 18:49:07 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 18:49:07 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 18:49:23 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 18:49:23 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 18:49:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:49:58 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 18:49:58 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 18:50:38 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:51:02 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:51:04 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 18:51:04 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 18:51:04 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 18:51:13 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:51:25 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:52:40 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:52:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 18:57:32 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:58:19 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 18:58:20 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 19:00:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:01:36 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:01:57 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:05 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:22 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:02:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:04:53 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:05:04 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:11:33 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2026-08-27 19:11:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:11:33 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2026-08-27 19:15:05 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 19:18:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:18:58 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:19:08 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:19:20 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:19:59 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8753
ERROR - 2026-08-27 19:19:59 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9020
ERROR - 2026-08-27 19:19:59 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 9048
ERROR - 2026-08-27 19:23:18 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:27:01 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 19:41:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:03:29 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 20:03:29 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 20:05:20 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 20:09:42 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:20:18 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:25:28 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:36:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 20:36:21 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:38:41 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 20:41:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:30 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> SQL Query: 
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:42:38 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:43:39 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 20:43:39 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> SQL Query: 
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:45:37 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/edit_enquiry.php 118
ERROR - 2026-08-27 20:47:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 20:47:48 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 20:49:37 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 20:49:37 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 20:57:37 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 20:58:42 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 20:58:42 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 20:59:04 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 21:02:57 --> Severity: Warning --> Undefined variable $arrival_persons /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 21:02:57 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/crmkazindmc/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2026-08-27 21:03:15 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 21:03:39 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 21:03:58 --> 404 Page Not Found: Files/index
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:05:52 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:09:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 21:09:11 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:51:59 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:11 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 21:53:42 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 21:53:45 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8834
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Attempt to read property "date" on string /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8844
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Undefined variable $arr_map /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8876
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8877
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Undefined variable $g /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 21:56:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/crmkazindmc/public_html/application/views/admin/quotation_create.php 8911
ERROR - 2026-08-27 22:07:34 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:23:27 --> Severity: Warning --> Undefined variable $selected /home/crmkazindmc/public_html/application/views/admin/enquiry.php 100
ERROR - 2026-08-27 22:38:09 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 22:48:52 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 23:02:33 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2026-08-27 23:02:33 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2026-08-27 23:02:33 --> 404 Page Not Found: Faviconico/index
ERROR - 2026-08-27 23:22:57 --> 404 Page Not Found: Faviconico/index

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-08-06 03:10:33 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 09:38:45 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 09:55:16 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:06:09 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:11:20 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:15:15 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:16:42 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24380
ERROR - 2025-08-06 10:17:17 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:17:17 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:17:36 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:17:36 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:17:41 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:18:09 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Arrivalchart.php 3141
ERROR - 2025-08-06 10:18:48 --> Severity: Warning --> Undefined array key 2 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Arrivalchart.php 3141
ERROR - 2025-08-06 10:19:49 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:20:32 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:23:08 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:24:01 --> SQL Query: SELECT *
FROM `airlines`
WHERE `id` = '49'
ERROR - 2025-08-06 10:24:34 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:26:33 --> SQL Query: SELECT *
FROM `airlines`
WHERE `id` = '49'
ERROR - 2025-08-06 10:26:43 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:28:17 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:29:08 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:30:51 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:31:00 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:31:07 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:34:28 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:35:10 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:36:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '"IGE3559\")
                    LEFT JOIN arrival_hotel_details ON arrival_h...' at line 7 - Invalid query: 
            SELECT t.status_cnt, t.status 
            FROM (
                SELECT a.status, COUNT(*) AS status_cnt
                FROM (
                    SELECT arrivals.id, arrivals.enquiry_id, arrivals.status
                    FROM arrivals 
                    JOIN enquiry ON (enquiry.id = arrivals.enquiry_id AND enquiry.enquiry_no = "IGE3559\")
                    LEFT JOIN arrival_hotel_details ON arrival_hotel_details.arrival_id = arrivals.id
                    WHERE 1=1 AND YEAR(enquiry.check_in_date) = 2025 AND enquiry.is_deleted = 0
                    GROUP BY arrivals.id, arrivals.enquiry_id
                ) a
                GROUP BY a.status
            ) t 
            GROUP BY t.status
        
ERROR - 2025-08-06 10:36:50 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:37:53 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:38:04 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:41:30 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:44:09 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:45:18 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:47:28 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:48:14 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 387
ERROR - 2025-08-06 10:48:14 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 387
ERROR - 2025-08-06 10:48:14 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 387
ERROR - 2025-08-06 10:52:23 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:53:41 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24929
ERROR - 2025-08-06 10:54:09 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:54:09 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:54:23 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:54:23 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 10:54:28 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:55:23 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 10:57:07 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 10:58:19 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:00:20 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:01:40 --> Severity: Warning --> Undefined variable $insert_arr /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Company.php 860
ERROR - 2025-08-06 11:04:17 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:04:32 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:04:52 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:05:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:05:46 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:08:12 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:10:09 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:10:17 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 578
ERROR - 2025-08-06 11:10:48 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 579
ERROR - 2025-08-06 11:10:56 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 579
ERROR - 2025-08-06 11:10:57 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 579
ERROR - 2025-08-06 11:13:54 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:14:28 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:14:51 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:15:06 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 25285
ERROR - 2025-08-06 11:18:23 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:18:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:20:58 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:21:18 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:33 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:21:44 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 11:22:43 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:24:07 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:24:10 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:24:48 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:27:24 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:31:01 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:31:12 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:34:43 --> 404 Page Not Found: Robotstxt/index
ERROR - 2025-08-06 11:35:54 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 521
ERROR - 2025-08-06 11:37:17 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 25288
ERROR - 2025-08-06 11:37:50 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:38:41 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:39:10 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:41:45 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:41:57 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:42:05 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:43:57 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:45:51 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:46:03 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:46:38 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:52:29 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:53:31 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 521
ERROR - 2025-08-06 11:54:04 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 11:57:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 11:58:08 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:04:07 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:05:19 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:06:13 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:06:41 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:08:14 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:09:03 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:12:47 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:13:22 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:13:34 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:13:39 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:15:25 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:20:36 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 12:21:23 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:21:45 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:21:47 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:23:04 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:24:45 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:26:52 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:28:23 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:30:45 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:31:31 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:31:55 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:34:53 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:39:46 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 25298
ERROR - 2025-08-06 12:42:24 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:42:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:44:19 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:46:15 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:48:51 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24125
ERROR - 2025-08-06 12:48:59 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:53:23 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:53:41 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:53:53 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 12:55:28 --> Query error: Table 'u745045551_old.arrivals_guide_costing' doesn't exist - Invalid query: SELECT guides.name,DATE_FORMAT(arrivals_guide_costing.date,"%d-%b-%Y") AS d, arrivals_guide_costing.* FROM arrivals_guide_costing  JOIN guides ON arrivals_guide_costing.guide_id = guides.id WHERE arrivals_guide_costing.arrival_id = 3056 AND arrivals_guide_costing.status = "active"  ORDER BY arrivals_guide_costing.date ASC
ERROR - 2025-08-06 12:56:50 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 12:57:16 --> Query error: Table 'u745045551_old.arrivals_guide_costing' doesn't exist - Invalid query: SELECT guides.name,DATE_FORMAT(arrivals_guide_costing.date,"%d-%b-%Y") AS d, arrivals_guide_costing.* FROM arrivals_guide_costing  JOIN guides ON arrivals_guide_costing.guide_id = guides.id WHERE arrivals_guide_costing.arrival_id = 3056 AND arrivals_guide_costing.status = "active"  ORDER BY arrivals_guide_costing.date ASC
ERROR - 2025-08-06 13:03:22 --> Query error: Table 'u745045551_old.arrivals_guide_costing' doesn't exist - Invalid query: SELECT guides.name,DATE_FORMAT(arrivals_guide_costing.date,"%d-%b-%Y") AS d, arrivals_guide_costing.* FROM arrivals_guide_costing  JOIN guides ON arrivals_guide_costing.guide_id = guides.id WHERE arrivals_guide_costing.arrival_id = 3056 AND arrivals_guide_costing.status = "active"  ORDER BY arrivals_guide_costing.date ASC
ERROR - 2025-08-06 13:07:45 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 25301
ERROR - 2025-08-06 13:07:55 --> Severity: Warning --> Undefined array key "pending" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 134
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:24 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:12:47 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:13:18 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:13:18 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 13:14:00 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:14:07 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:14:30 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:14:59 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:17:02 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:17:19 --> Severity: Warning --> Undefined property: stdClass::$mobile /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/User_model.php 150
ERROR - 2025-08-06 13:17:19 --> Severity: Warning --> Undefined property: stdClass::$region_international /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/User_model.php 152
ERROR - 2025-08-06 13:17:19 --> Severity: Warning --> Undefined property: stdClass::$accounts_usertype /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/User_model.php 153
ERROR - 2025-08-06 13:19:55 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:19:57 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:20:30 --> Severity: Warning --> Undefined property: stdClass::$mobile /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/User_model.php 150
ERROR - 2025-08-06 13:20:30 --> Severity: Warning --> Undefined property: stdClass::$region_international /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/User_model.php 152
ERROR - 2025-08-06 13:20:30 --> Severity: Warning --> Undefined property: stdClass::$accounts_usertype /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/User_model.php 153
ERROR - 2025-08-06 13:20:42 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:21:06 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:21:15 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:21:28 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:22:14 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:22:26 --> 404 Page Not Found: Assets/company
ERROR - 2025-08-06 13:22:29 --> SQL Query: SELECT *
FROM `restaurant_menus`
WHERE `id` = 3134
ERROR - 2025-08-06 13:22:29 --> Severity: Warning --> Undefined variable $update /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Restaurantmenumaster.php 480
ERROR - 2025-08-06 13:22:30 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:23:08 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:23:57 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:24:25 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:24:31 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-08-06 13:25:44 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:26:48 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:27:33 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:29:42 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:31:18 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 521
ERROR - 2025-08-06 13:33:23 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:33:36 --> SQL Query: SELECT *
FROM `restaurant_menus`
WHERE `id` = 3136
ERROR - 2025-08-06 13:34:11 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:35:28 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:35:43 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:35:56 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:36:22 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:37:19 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:38:00 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:38:55 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 13:40:31 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:40:59 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:45:18 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:47:32 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:57:46 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 13:59:24 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:03:47 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:04:38 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:05:00 --> 404 Page Not Found: Uploads/transportation
ERROR - 2025-08-06 14:05:00 --> 404 Page Not Found: Uploads/transportation
ERROR - 2025-08-06 14:05:12 --> 404 Page Not Found: Uploads/transportation
ERROR - 2025-08-06 14:05:12 --> 404 Page Not Found: Uploads/transportation
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:05:24 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 14:09:42 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:10:30 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 21808
ERROR - 2025-08-06 14:12:50 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 14:12:50 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 14:13:44 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 14:13:44 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 14:14:07 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:14:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:15:51 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:16:22 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:17:21 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:28:27 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:31:56 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:34:15 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:34:24 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 16969
ERROR - 2025-08-06 14:34:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:34:46 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:35:41 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:35:44 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:36:08 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:36:58 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 16969
ERROR - 2025-08-06 14:37:43 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:38:42 --> 404 Page Not Found: Assets/guide
ERROR - 2025-08-06 14:40:41 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:40:51 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 252
ERROR - 2025-08-06 14:40:59 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 252
ERROR - 2025-08-06 14:41:00 --> 404 Page Not Found: Assets/guide
ERROR - 2025-08-06 14:41:38 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:42:44 --> SQL Query: SELECT *
FROM `guides`
WHERE `id` = 217
ERROR - 2025-08-06 14:42:51 --> SQL Query: SELECT *
FROM `guides`
WHERE `id` = 217
ERROR - 2025-08-06 14:49:53 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 14:52:55 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:58:32 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 14:59:23 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:04:26 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:05:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '"FGE8108\"
            GROUP BY LOWER(enquiry.status)' at line 5 - Invalid query: 
            SELECT LOWER(enquiry.status) AS status, COUNT(*) AS status_cnt
            FROM enquiry
            LEFT JOIN arrivals ON arrivals.enquiry_id = enquiry.id
            
            WHERE enquiry.is_deleted = 0 AND YEAR(enquiry.check_in_date) = 2025 AND enquiry.enquiry_no = "FGE8108\"
            GROUP BY LOWER(enquiry.status)
        
ERROR - 2025-08-06 15:11:43 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:14:32 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:22:44 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:26:04 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:28:25 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:29:57 --> 404 Page Not Found: Assets/guide
ERROR - 2025-08-06 15:30:10 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:30:58 --> 404 Page Not Found: Assets/guide
ERROR - 2025-08-06 15:37:29 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:38:29 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:39:21 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:39:32 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:40:13 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:40:24 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:40:54 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:41:15 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:44:26 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:47:13 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:49:03 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:49:42 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 15:53:42 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:57:45 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 15:58:28 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:03:31 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:03:38 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:07:06 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:10:22 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 16:10:39 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 16:18:53 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:20:50 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:22:35 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:31:22 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:34:01 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:34:27 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 16:34:40 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 16:34:59 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 16:39:07 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:07 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:07 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:07 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:07 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:07 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:08 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:09 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:09 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:09 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:09 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:09 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:09 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:10 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:10 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:10 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:10 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:11 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:11 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:11 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:11 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:11 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:11 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:11 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:11 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:11 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:11 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:12 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:12 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:12 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:12 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:12 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:12 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:12 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:12 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:12 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:12 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:13 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:13 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:13 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:13 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:13 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:13 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:14 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:14 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:14 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:14 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:14 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:14 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:15 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:15 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:15 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:15 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:16 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:16 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:16 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:16 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:17 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:17 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:17 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:18 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:18 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:18 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:19 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:19 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Resource temporarily unavailable /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:20 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:39 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:39 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:39 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:39 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:39 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:39 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:39 --> Severity: Warning --> mysqli::real_connect(): (08004/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:39 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:40 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/u745045551/domains/crm.kazindmc.com/public_html/system/database/drivers/mysqli/mysqli_driver.php 211
ERROR - 2025-08-06 16:39:40 --> Unable to connect to the database
ERROR - 2025-08-06 16:39:51 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 16:40:35 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:01:23 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 17:01:23 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 17:01:42 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:01:49 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24928
ERROR - 2025-08-06 17:01:55 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 308
ERROR - 2025-08-06 17:01:55 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 17:01:55 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 17:02:01 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 308
ERROR - 2025-08-06 17:02:08 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 17:02:08 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 17:02:12 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 17:04:51 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:05:22 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 17:10:08 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:11:14 --> 404 Page Not Found: Assets/company
ERROR - 2025-08-06 17:13:29 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:23:18 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 17:26:28 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:27:17 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 17:30:16 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:35:27 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:35:55 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:36:04 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 17:36:07 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 521
ERROR - 2025-08-06 17:41:09 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:44:00 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:47:29 --> 404 Page Not Found: Assets/company
ERROR - 2025-08-06 17:47:43 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 17:48:50 --> 404 Page Not Found: Assets/company
ERROR - 2025-08-06 18:03:10 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:03:38 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24928
ERROR - 2025-08-06 18:03:49 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:04:01 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:04:54 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:05:18 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:05:41 --> SQL Query: SELECT *
FROM `restaurant_menus`
WHERE `id` = 3127
ERROR - 2025-08-06 18:05:42 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:06:32 --> SQL Query: SELECT *
FROM `restaurant_menus`
WHERE `id` = 3124
ERROR - 2025-08-06 18:06:33 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:06:52 --> SQL Query: SELECT *
FROM `restaurant_menus`
WHERE `id` = 3125
ERROR - 2025-08-06 18:06:54 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:07:14 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:08:03 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:12:36 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:12:47 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:13:53 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:23:57 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:28:24 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:32:14 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:32:14 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:32:29 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:32:29 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:32:45 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:34:28 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:35:57 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:36:24 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:38:10 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24120
ERROR - 2025-08-06 18:38:16 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:38:31 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:39:07 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:39:59 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:41:19 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:41:21 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:42:13 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-08-06 18:44:18 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24964
ERROR - 2025-08-06 18:44:43 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:44:43 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:45:00 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:45:00 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 18:46:30 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:46:38 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:46:49 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:49:07 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 18:53:05 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:53:18 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 18:56:49 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:00:21 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:00:42 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:03:08 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:03:23 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 19:05:22 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:09:12 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:14:59 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 19:15:14 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 19:17:46 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 25205
ERROR - 2025-08-06 19:18:06 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 19:18:06 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 19:18:21 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 19:18:21 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 19:18:24 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:18:46 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:19:02 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 19:52:44 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 19:57:59 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 21:31:21 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 21:32:28 --> Severity: Warning --> Undefined array key "pending" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 134
ERROR - 2025-08-06 21:32:51 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:32:51 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:33:22 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:33:22 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:33:27 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:35:51 --> Severity: Warning --> Undefined array key 1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Arrivalchart.php 3141
ERROR - 2025-08-06 21:37:40 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 21:40:31 --> Severity: Warning --> Uninitialized string offset 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Hotel_model.php 54
ERROR - 2025-08-06 21:40:39 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 581
ERROR - 2025-08-06 21:41:14 --> SQL Query: SELECT *
FROM `hotels`
WHERE `id` = 581
ERROR - 2025-08-06 21:41:40 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:43:02 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:45:47 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 21:46:24 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:46:35 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:47:13 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24825
ERROR - 2025-08-06 21:49:10 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:49:10 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:49:23 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:49:23 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-08-06 21:49:43 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:55:06 --> SQL Query: SELECT *
FROM `enquiry`
WHERE `id` = 24617
ERROR - 2025-08-06 21:55:12 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:56:14 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 21:56:15 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:00:29 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:00:41 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:01:21 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:02:41 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:03:01 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:06:10 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:06:29 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:07:35 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-08-06 22:09:23 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:09:53 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-08-06 22:12:53 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:13:09 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:13:28 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:14:13 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:14:20 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:15:13 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:15:56 --> 404 Page Not Found: Assets/admin
ERROR - 2025-08-06 22:22:01 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:22:12 --> 404 Page Not Found: Files/index
ERROR - 2025-08-06 22:24:32 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-08-06 22:24:32 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-08-06 22:32:46 --> 404 Page Not Found: Assets/admin

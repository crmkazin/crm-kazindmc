<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-09-22 00:10:23 --> 404 Page Not Found: Robotstxt/index
ERROR - 2025-09-22 00:10:50 --> 404 Page Not Found: Robotstxt/index
ERROR - 2025-09-22 02:09:16 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-22 02:09:17 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-22 03:39:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 04:20:26 --> Severity: Warning --> Undefined property: stdClass::$isd_code /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Login.php 592
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:18:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 10:28:35 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:33:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:35:17 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:35:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:36:41 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:36:59 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:37:36 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:38:11 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:38:25 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:38:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FGE","GGE","IGE") AND enquiry.is_deleted = 0
                    GROUP BY ar...' at line 7 - Invalid query: 
            SELECT t.status_cnt, t.status 
            FROM (
                SELECT a.status, COUNT(*) AS status_cnt
                FROM (
                    SELECT arrivals.id, arrivals.enquiry_id, arrivals.status
                    FROM arrivals 
                    JOIN enquiry ON (enquiry.id = arrivals.enquiry_id AND enquiry.enquiry_no = "FGE8171\")
                    LEFT JOIN arrival_hotel_details ON arrival_hotel_details.arrival_id = arrivals.id
                    WHERE 1=1 AND YEAR(enquiry.check_in_date) = 2025 AND enquiry.enquiry_abbr IN ("FGE","GGE","IGE") AND enquiry.is_deleted = 0
                    GROUP BY arrivals.id, arrivals.enquiry_id
                ) a
                GROUP BY a.status
            ) t 
            GROUP BY t.status
        
ERROR - 2025-09-22 10:39:36 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:41:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:46:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:46:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:47:53 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:48:00 --> SQL Query: 
ERROR - 2025-09-22 10:49:02 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:49:16 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:51:31 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:52:14 --> SQL Query: 
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:52:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 10:54:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:54:48 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:56:04 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 10:56:18 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:03:54 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:05:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:05:27 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:07:23 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:07:53 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:10:07 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:10:30 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:18:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:19:08 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:20:28 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:21:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:21:33 --> Severity: Warning --> Undefined array key "U" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 26
ERROR - 2025-09-22 11:21:35 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:49 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:53 --> SQL Query: 
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:21:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:22:01 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:22:22 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:30:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:31:40 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 11:31:40 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 11:32:10 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 11:32:10 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 11:32:19 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:33:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:27 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 11:33:48 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:35:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:37:52 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:39:28 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-22 11:39:29 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-22 11:39:48 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:43:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:44:22 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:44:40 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-22 11:45:12 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:47:00 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:48:19 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:48:38 --> SQL Query: 
ERROR - 2025-09-22 11:48:48 --> SQL Query: 
ERROR - 2025-09-22 11:48:58 --> SQL Query: 
ERROR - 2025-09-22 11:49:08 --> SQL Query: 
ERROR - 2025-09-22 11:49:24 --> SQL Query: 
ERROR - 2025-09-22 11:49:33 --> SQL Query: 
ERROR - 2025-09-22 11:49:42 --> SQL Query: 
ERROR - 2025-09-22 11:49:52 --> SQL Query: 
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:51:57 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 11:59:43 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:38 --> SQL Query: 
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:03:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:04:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:08:50 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:09:38 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:09:55 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:15 --> SQL Query: 
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:10:21 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:11:01 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:12:26 --> SQL Query: 
ERROR - 2025-09-22 12:12:26 --> Severity: Warning --> Undefined variable $closer_date_from /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Masters.php 365
ERROR - 2025-09-22 12:12:26 --> Severity: Warning --> Undefined variable $closer_date_to /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Masters.php 366
ERROR - 2025-09-22 12:12:26 --> SQL Query: 
ERROR - 2025-09-22 12:16:04 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:16:30 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:19:50 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:20:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:20:38 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:24:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:26:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:28:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:35:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:38:21 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:38:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:39:09 --> 404 Page Not Found: Well-known/traffic-advice
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:39:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:40:57 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:41:10 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:41:17 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:44:07 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:44:21 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:44:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:46:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 12:50:58 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 12:50:58 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 12:51:16 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 12:51:16 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 12:51:23 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:51:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:51:54 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:52:22 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:52:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:52:56 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 12:54:22 --> 404 Page Not Found: Assets/company
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:56:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 12:57:17 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 12:58:23 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 12:59:18 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-22 13:00:32 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:02:22 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:04:54 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:11:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:12:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:14:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:16:47 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:17:16 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:21:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:26:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:28:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:30:47 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 13:30:57 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:31:34 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:40:01 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:42:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:44:27 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:44:45 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:48:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:50:21 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:50:33 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:50:47 --> SQL Query: 
ERROR - 2025-09-22 13:51:00 --> SQL Query: 
ERROR - 2025-09-22 13:51:11 --> SQL Query: 
ERROR - 2025-09-22 13:51:31 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 13:52:34 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:17 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:53:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:55:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:56:55 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 13:57:09 --> 404 Page Not Found: Assets/guide
ERROR - 2025-09-22 13:57:09 --> 404 Page Not Found: Assets/guide
ERROR - 2025-09-22 13:57:09 --> 404 Page Not Found: Assets/guide
ERROR - 2025-09-22 13:57:09 --> 404 Page Not Found: Assets/guide
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 13:57:38 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:01:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:02:07 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:02:49 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:03:02 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:11:04 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 14:11:04 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 14:11:21 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 14:11:21 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 14:11:25 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:12:59 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:17:28 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:17:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:19:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:25:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:36:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:38:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:39:45 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:40:00 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:41:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:42:35 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:43:34 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:48:10 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:49:42 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/hotel_room_category.php 341
ERROR - 2025-09-22 14:49:42 --> Severity: Warning --> Attempt to read property "currency_name" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/hotel_room_category.php 341
ERROR - 2025-09-22 14:49:44 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-22 14:50:09 --> Severity: Warning --> Undefined variable $insert_arr /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Company.php 614
ERROR - 2025-09-22 14:50:22 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/hotel_room_category.php 341
ERROR - 2025-09-22 14:50:22 --> Severity: Warning --> Attempt to read property "currency_name" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/hotel_room_category.php 341
ERROR - 2025-09-22 14:50:29 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:50:58 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:51:15 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:51:58 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:52:12 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:53:43 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:53:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:55:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:56:19 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:56:31 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:58:20 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 14:59:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:10:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:12:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:44 --> SQL Query: 
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:14:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:15:19 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:15:19 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:15:38 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 15:15:51 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:15:51 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:15:56 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:16:16 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:16:30 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:16:58 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:18:12 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:19:17 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:20:20 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:20:20 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:20:51 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:20:51 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:20:55 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:20:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:21:55 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:23:03 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:23:41 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:23:41 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:24:20 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:31 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:24:49 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:25:12 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:26:10 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:30:11 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:31:34 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:39:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:40:49 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:41:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:42:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Attempt to read property "status" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 158
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Attempt to read property "type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Undefined array key "" /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Undefined variable $user /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-09-22 15:44:07 --> Severity: Warning --> Attempt to read property "admin_type" on null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/party_bus.php 168
ERROR - 2025-09-22 15:45:59 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:47:36 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:47:50 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:47:56 --> Severity: Warning --> Undefined array key "U" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 26
ERROR - 2025-09-22 15:47:57 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:48:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:50:49 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:53:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:54:17 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:54:17 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 15:54:49 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:55:37 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:55:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:55:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:56:44 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:22 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:57:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 15:58:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:04:02 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:07:19 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:07:38 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:07:52 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:08:01 --> SQL Query: 
ERROR - 2025-09-22 16:08:05 --> SQL Query: 
ERROR - 2025-09-22 16:08:10 --> SQL Query: 
ERROR - 2025-09-22 16:08:42 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:09:15 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:12:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:13:56 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:20:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:21:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:26:57 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 16:27:13 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:32:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:33:11 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-22 16:33:11 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-22 16:33:11 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-22 16:33:12 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:36:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:38:00 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 16:39:04 --> SQL Query: 
ERROR - 2025-09-22 16:39:04 --> Severity: Warning --> Undefined variable $closer_date_from /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Masters.php 365
ERROR - 2025-09-22 16:39:04 --> Severity: Warning --> Undefined variable $closer_date_to /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Masters.php 366
ERROR - 2025-09-22 16:39:04 --> SQL Query: 
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:41:47 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:43:39 --> Severity: Warning --> Undefined variable $insert_arr /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Company.php 860
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:44:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:45:54 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:47:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:51:27 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:54:34 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 16:57:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:03:30 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:03:38 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:05:51 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:10:25 --> Severity: Warning --> Undefined property: stdClass::$isd_code /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Login.php 592
ERROR - 2025-09-22 17:10:48 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-22 17:10:48 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:12:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:14:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:16:30 --> 404 Page Not Found: Assets/guide
ERROR - 2025-09-22 17:20:12 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:28:28 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:30:18 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:30:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:31:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:34:36 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:36:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:37:39 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:39:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:31 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:41:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:13 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:43:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:44:30 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:45:22 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:46:03 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:47:56 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:48:19 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:48:40 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:48:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:49:29 --> Severity: Warning --> Undefined array key "U" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 26
ERROR - 2025-09-22 17:50:23 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:53:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:54:10 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:55:12 --> Severity: Warning --> Undefined variable $result1 /home/u745045551/domains/crm.kazindmc.com/public_html/application/models/admin/Company_model.php 527
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 17:56:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:06:03 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:07:20 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:10:54 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:11:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:12:25 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:13:20 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> SQL Query: 
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:13:59 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 18:14:06 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:14:12 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:14:12 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:14:56 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:14:56 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:15:05 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:15:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:15:21 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:23:47 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:23:47 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:24:06 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:24:06 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:24:14 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:24:33 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:25:10 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:26:31 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:27:40 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:27:59 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:27 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:37:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:38:15 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:38:26 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:41:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:42:26 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-22 18:45:25 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:48:43 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:48:43 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:49:18 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:49:18 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-22 18:49:23 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:49:56 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:51:02 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:51:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:51:51 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:52:30 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:53:45 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 18:56:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:01:56 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 19:03:44 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 19:04:46 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 19:06:14 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:20:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> SQL Query: 
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:23:39 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 19:23:59 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:28 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:25:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-22 19:34:12 --> Query error: Table 'u745045551_old.arrivals_guide_costing' doesn't exist - Invalid query: SELECT guides.name,DATE_FORMAT(arrivals_guide_costing.date,"%d-%b-%Y") AS d, arrivals_guide_costing.* FROM arrivals_guide_costing  JOIN guides ON arrivals_guide_costing.guide_id = guides.id WHERE arrivals_guide_costing.arrival_id = 2848 AND arrivals_guide_costing.status = "active"  ORDER BY arrivals_guide_costing.date ASC
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:35:45 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 19:37:42 --> Query error: Table 'u745045551_old.arrivals_guide_costing' doesn't exist - Invalid query: SELECT guides.name,DATE_FORMAT(arrivals_guide_costing.date,"%d-%b-%Y") AS d, arrivals_guide_costing.* FROM arrivals_guide_costing  JOIN guides ON arrivals_guide_costing.guide_id = guides.id WHERE arrivals_guide_costing.arrival_id = 2848 AND arrivals_guide_costing.status = "active"  ORDER BY arrivals_guide_costing.date ASC
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:10:08 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:14:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 20:52:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:02:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:09:57 --> 404 Page Not Found: Files/index
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-22 21:11:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93

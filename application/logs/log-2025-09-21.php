<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:28:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 111
ERROR - 2025-09-21 00:37:11 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 00:39:55 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 00:41:15 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 10:47:28 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-21 10:47:28 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-21 12:28:59 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-21 12:28:59 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-21 12:29:57 --> Severity: Warning --> Undefined variable $arrival_persons /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-21 12:29:57 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/add_arrivalchart.php 342
ERROR - 2025-09-21 12:30:04 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 12:30:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 12:30:40 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 12:31:18 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 12:32:24 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 12:33:02 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 12:35:09 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 13:03:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FGE","GGE","IGE") AND enquiry.is_deleted = 0
                    GROUP BY ar...' at line 7 - Invalid query: 
            SELECT t.status_cnt, t.status 
            FROM (
                SELECT a.status, COUNT(*) AS status_cnt
                FROM (
                    SELECT arrivals.id, arrivals.enquiry_id, arrivals.status
                    FROM arrivals 
                    JOIN enquiry ON (enquiry.id = arrivals.enquiry_id AND enquiry.enquiry_no = "FGE8362\")
                    LEFT JOIN arrival_hotel_details ON arrival_hotel_details.arrival_id = arrivals.id
                    WHERE 1=1 AND YEAR(enquiry.check_in_date) = 2025 AND enquiry.enquiry_abbr IN ("FGE","GGE","IGE") AND enquiry.is_deleted = 0
                    GROUP BY arrivals.id, arrivals.enquiry_id
                ) a
                GROUP BY a.status
            ) t 
            GROUP BY t.status
        
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:13:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 13:44:57 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:10:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 15:40:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:09:42 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:24:34 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 16:25:21 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 16:34:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:46:51 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-21 17:46:51 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 17:47:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 93
ERROR - 2025-09-21 19:03:34 --> Severity: Warning --> Undefined property: stdClass::$isd_code /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Login.php 592
ERROR - 2025-09-21 19:54:24 --> 404 Page Not Found: Robotstxt/index
ERROR - 2025-09-21 19:58:24 --> SQL Query: 
ERROR - 2025-09-21 19:58:24 --> Severity: Warning --> Undefined variable $closer_date_from /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Masters.php 365
ERROR - 2025-09-21 19:58:24 --> Severity: Warning --> Undefined variable $closer_date_to /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Masters.php 366
ERROR - 2025-09-21 19:58:24 --> SQL Query: 
ERROR - 2025-09-21 20:06:21 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-21 20:06:21 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-21 20:06:22 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2025-09-21 20:06:22 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2025-09-21 20:20:31 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 20:23:12 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 20:26:55 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 20:27:50 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 373
ERROR - 2025-09-21 20:27:57 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 690
ERROR - 2025-09-21 20:29:06 --> 404 Page Not Found: Files/index
ERROR - 2025-09-21 21:49:02 --> 404 Page Not Found: Robotstxt/index
ERROR - 2025-09-21 21:50:59 --> 404 Page Not Found: Robotstxt/index
ERROR - 2025-09-21 23:54:47 --> 404 Page Not Found: Robotstxt/index

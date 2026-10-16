<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-05-02 00:01:23 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:03:19 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:18:19 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:23:08 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:28:23 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:29:20 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:29:53 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:30:11 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:30:40 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:31:23 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:32:19 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:34:18 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:45:35 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:47:25 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:48:07 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 00:48:19 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 01:02:24 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 01:02:36 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 01:02:36 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 01:02:36 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 01:02:36 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 01:02:36 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 01:02:36 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 01:03:02 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 01:40:40 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 01:55:32 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 04:04:47 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 04:07:59 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 04:07:59 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 04:07:59 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 04:07:59 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:46:28 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:46:28 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:46:28 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:46:30 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:46:31 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:53:43 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:53:43 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:53:43 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:53:43 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 05:53:44 --> 404 Page Not Found: Ip/index
ERROR - 2026-05-02 08:09:52 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 09:57:29 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 09:57:57 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 09:57:57 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 09:57:57 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 09:57:57 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 09:57:57 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 09:57:57 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 09:58:15 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 09:59:08 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 09:59:08 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 09:59:08 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 09:59:08 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 09:59:08 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 09:59:08 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 09:59:11 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 09:59:16 --> Query error: Subquery returns more than 1 row - Invalid query: 
                SELECT itc.*
                FROM itinerary_templates_content itc
                WHERE itc.country = (
                    SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                            WHEN 'A' THEN 'azerbaijan'
                            WHEN 'B' THEN 'belarus'
                            WHEN 'G' THEN 'georgia'
                            WHEN 'K' THEN 'kazakhstan'
                            WHEN 'U' THEN 'uzbekistan'
                        END
                    FROM enquiry e
                    WHERE e.enquiry_no = 'IKZ10736'
                )
                AND itc.status != 'deleted'
                AND itc.day = 'start'  -- Only start day, remove last day
                ORDER BY FIELD(itc.day, 'start')
            
ERROR - 2026-05-02 09:59:29 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:00:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:08:45 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 10:08:48 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:09:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 10:09:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 10:09:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 10:09:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 10:09:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:09:48 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:10:32 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 10:10:57 --> Query error: Subquery returns more than 1 row - Invalid query: 
                SELECT itc.*
                FROM itinerary_templates_content itc
                WHERE itc.country = (
                    SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                            WHEN 'A' THEN 'azerbaijan'
                            WHEN 'B' THEN 'belarus'
                            WHEN 'G' THEN 'georgia'
                            WHEN 'K' THEN 'kazakhstan'
                            WHEN 'U' THEN 'uzbekistan'
                        END
                    FROM enquiry e
                    WHERE e.enquiry_no = 'IKZ10736'
                )
                AND itc.status != 'deleted'
                AND itc.day = 'start'  -- Only start day, remove last day
                ORDER BY FIELD(itc.day, 'start')
            
ERROR - 2026-05-02 10:15:05 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:18:04 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> SQL Query: 
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:20 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:20:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 10:23:20 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 10:23:20 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 10:23:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 10:23:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 10:23:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 10:23:30 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 10:26:49 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 10:26:49 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 10:26:49 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 10:26:49 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 10:26:49 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 10:27:04 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 10:32:38 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:33:45 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:33:58 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:35:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 10:38:03 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:38:19 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 10:38:19 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 10:38:19 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 10:38:19 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 10:38:19 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 10:38:30 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 10:38:48 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 10:39:37 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 10:39:37 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 10:39:37 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 10:39:37 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 10:39:37 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 10:39:49 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 10:39:55 --> Query error: Subquery returns more than 1 row - Invalid query: 
                SELECT itc.*
                FROM itinerary_templates_content itc
                WHERE itc.country = (
                    SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                            WHEN 'A' THEN 'azerbaijan'
                            WHEN 'B' THEN 'belarus'
                            WHEN 'G' THEN 'georgia'
                            WHEN 'K' THEN 'kazakhstan'
                            WHEN 'U' THEN 'uzbekistan'
                        END
                    FROM enquiry e
                    WHERE e.enquiry_no = 'IKZ10736'
                )
                AND itc.status != 'deleted'
                AND itc.day = 'start'  -- Only start day, remove last day
                ORDER BY FIELD(itc.day, 'start')
            
ERROR - 2026-05-02 10:43:03 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 10:43:12 --> Query error: Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8mb4_uca1400_ai_ci,COERCIBLE) for operation 'like' - Invalid query: SELECT *
FROM `guides`
WHERE `name` like '%А%'
AND `status` = 'active'
AND LOWER(country) = 'kazakhstan'
 LIMIT 10
ERROR - 2026-05-02 10:43:13 --> Query error: Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8mb4_uca1400_ai_ci,COERCIBLE) for operation 'like' - Invalid query: SELECT *
FROM `guides`
WHERE `name` like '%Амир%'
AND `status` = 'active'
AND LOWER(country) = 'kazakhstan'
 LIMIT 10
ERROR - 2026-05-02 10:44:12 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:46:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry_edit.php 147
ERROR - 2026-05-02 10:48:58 --> Query error: Subquery returns more than 1 row - Invalid query: 
                SELECT itc.*
                FROM itinerary_templates_content itc
                WHERE itc.country = (
                    SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                            WHEN 'A' THEN 'azerbaijan'
                            WHEN 'B' THEN 'belarus'
                            WHEN 'G' THEN 'georgia'
                            WHEN 'K' THEN 'kazakhstan'
                            WHEN 'U' THEN 'uzbekistan'
                        END
                    FROM enquiry e
                    WHERE e.enquiry_no = 'IKZ10736'
                )
                AND itc.status != 'deleted'
                AND itc.day = 'start'  -- Only start day, remove last day
                ORDER BY FIELD(itc.day, 'start')
            
ERROR - 2026-05-02 10:55:23 --> Query error: Subquery returns more than 1 row - Invalid query: 
            SELECT itc.*
            FROM itinerary_templates_content itc
            WHERE itc.country = (
                SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                        WHEN 'A' THEN 'azerbaijan'
                        WHEN 'B' THEN 'belarus'
                        WHEN 'G' THEN 'georgia'
                        WHEN 'K' THEN 'kazakhstan'
                        WHEN 'U' THEN 'uzbekistan'
                    END
                FROM enquiry e
                WHERE e.enquiry_no = 'IKZ10736'
            )
            AND itc.status != 'deleted'
            AND itc.day IN ('start', 'last')
            ORDER BY FIELD(itc.day, 'start','last')
        
ERROR - 2026-05-02 10:55:33 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 10:55:33 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 10:55:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 10:55:33 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 10:55:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 10:55:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 10:55:42 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:00:20 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:00:28 --> SQL Query: 
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:00:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:38 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:01:56 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:02:19 --> SQL Query: 
ERROR - 2026-05-02 11:02:22 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:07:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $total_cost /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7400
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $day_total /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7407
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 11:11:11 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 11:11:21 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:11:40 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:11:46 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:11:51 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:12:44 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:13:29 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:14:24 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 11:14:24 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 11:14:24 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 11:14:24 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 11:14:24 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 11:14:27 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:21:36 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:22:27 --> Severity: Warning --> Undefined variable $response /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Quotation.php 19779
ERROR - 2026-05-02 11:22:28 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 11:22:39 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 11:26:45 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 11:26:45 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 11:26:45 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 11:26:45 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 11:26:45 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 11:26:55 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:29:53 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:36:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:40:41 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:00 --> SQL Query: 
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:01 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 11:41:05 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 11:41:05 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 11:41:05 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 11:41:05 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 11:41:05 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 11:41:05 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 11:41:18 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:44:07 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:44:27 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:48:15 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:51:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:53:07 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 11:55:28 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 11:55:28 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 11:55:28 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 11:55:28 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 11:55:28 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 11:55:32 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 11:58:57 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 11:58:57 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 11:58:57 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 11:58:57 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 11:58:57 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 11:59:07 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:05:48 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:05:48 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:05:48 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:05:48 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:05:48 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:08:42 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:08:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:17:36 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:17:36 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:17:36 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:17:36 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:17:36 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:17:44 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:26:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:33:44 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:33:44 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:33:44 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:33:44 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:33:44 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:36:30 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:37:08 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:37:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:37:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:41:18 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:41:42 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:41:54 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:44:18 --> 404 Page Not Found: Apple-touch-iconpng/index
ERROR - 2026-05-02 12:44:18 --> 404 Page Not Found: Apple-touch-icon-precomposedpng/index
ERROR - 2026-05-02 12:44:45 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:45:13 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:45 --> SQL Query: 
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:46 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:46:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:47:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:49:40 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:50:02 --> 404 Page Not Found: Assets/company
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:12 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:50:16 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:50:29 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:52:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:53:03 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:53:54 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:53:54 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:53:54 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:53:54 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:53:54 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:54:07 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:54:12 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:15 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> SQL Query: 
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:26 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 12:54:46 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:54:46 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:54:46 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:54:46 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:54:46 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:54:55 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:55:08 --> Severity: Warning --> Undefined array key 0 /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Hotel.php 1875
ERROR - 2026-05-02 12:55:19 --> Severity: Warning --> Undefined variable $location_masters /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-05-02 12:55:19 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/itinerary_masters_create.php 160
ERROR - 2026-05-02 12:55:36 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:55:45 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:56:48 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:56:48 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:56:48 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:56:48 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:56:48 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:57:14 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 12:57:14 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 12:57:14 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 12:57:14 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 12:57:14 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 12:57:23 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:57:34 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:57:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 12:58:10 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:58:26 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 12:58:36 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:58:57 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 12:59:57 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 13:04:47 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:06:03 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:54 --> SQL Query: 
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:55 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:07:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 13:11:39 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:13:52 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:14:12 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:14:24 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:14:37 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:14:45 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:16:24 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:21:11 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 13:21:11 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 13:21:11 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:21:11 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 13:21:11 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:21:11 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:21:25 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:28:07 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:28:07 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:28:07 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:28:07 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:28:07 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:28:10 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:29:09 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:29:09 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:29:09 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:29:09 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:29:09 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:30:25 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:30:25 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:30:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:30:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:30:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:31:09 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:31:36 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:33:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:34:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:35:05 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:35:05 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:35:05 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:35:05 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:35:05 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:35:10 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:35:29 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:38:07 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 13:41:22 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:41:22 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:41:22 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:41:22 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:41:22 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:41:23 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 13:41:23 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 13:41:23 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:41:23 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 13:41:23 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:41:23 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:41:29 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:42:20 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:42:43 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:45:18 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:45:18 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:45:18 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:45:18 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:45:18 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:45:27 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:45:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 13:50:22 --> Severity: Warning --> Undefined variable $meals /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 186
ERROR - 2026-05-02 13:50:22 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 186
ERROR - 2026-05-02 13:50:22 --> Severity: Warning --> Undefined variable $menus /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 203
ERROR - 2026-05-02 13:50:22 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 203
ERROR - 2026-05-02 13:50:30 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 13:50:30 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 13:50:30 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 13:50:30 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 13:50:30 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 13:53:08 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 13:55:05 --> Severity: Warning --> Undefined variable $meals /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 186
ERROR - 2026-05-02 13:55:05 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 186
ERROR - 2026-05-02 13:55:05 --> Severity: Warning --> Undefined variable $menus /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 203
ERROR - 2026-05-02 13:55:05 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 203
ERROR - 2026-05-02 13:55:13 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:01:51 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:02:24 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:04:53 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 14:04:53 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 14:04:53 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 14:04:53 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 14:04:53 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 14:05:03 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 14:05:08 --> 404 Page Not Found: Assets/company
ERROR - 2026-05-02 14:08:48 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:11:45 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:12:42 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:13:07 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:13:31 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:13:48 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:14:10 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:14:24 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:14:38 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:14:53 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:15:12 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:15:30 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:15:49 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:16:11 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:16:25 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:18:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/vendor/mpdf/mpdf/src/Mpdf.php 15977
ERROR - 2026-05-02 14:18:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/vendor/mpdf/mpdf/src/Mpdf.php 15977
ERROR - 2026-05-02 14:21:37 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:22:08 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:31:52 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 14:41:09 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:41:48 --> SQL Query: 
ERROR - 2026-05-02 14:41:49 --> SQL Query: 
ERROR - 2026-05-02 14:41:49 --> Severity: Warning --> Undefined variable $update /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Restaurantmenumaster.php 480
ERROR - 2026-05-02 14:41:54 --> SQL Query: 
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $total_cost /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7400
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $day_total /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7407
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 14:42:06 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 14:42:09 --> SQL Query: 
ERROR - 2026-05-02 14:42:20 --> SQL Query: 
ERROR - 2026-05-02 14:42:29 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 14:42:29 --> SQL Query: 
ERROR - 2026-05-02 14:42:37 --> SQL Query: 
ERROR - 2026-05-02 14:42:49 --> SQL Query: 
ERROR - 2026-05-02 14:42:58 --> SQL Query: 
ERROR - 2026-05-02 14:42:59 --> SQL Query: 
ERROR - 2026-05-02 14:42:59 --> Severity: Warning --> Undefined variable $update /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Restaurantmenumaster.php 480
ERROR - 2026-05-02 14:43:10 --> SQL Query: 
ERROR - 2026-05-02 14:44:21 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:44:27 --> SQL Query: 
ERROR - 2026-05-02 14:44:27 --> Severity: Warning --> Undefined variable $update /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Restaurantmenumaster.php 480
ERROR - 2026-05-02 14:44:50 --> 404 Page Not Found: Files/index
ERROR - 2026-05-02 14:46:06 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 14:46:09 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 14:48:20 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 14:48:20 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 14:48:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 14:48:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 14:48:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 14:49:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 14:49:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 14:49:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 14:49:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 14:49:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 14:49:50 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 14:49:50 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 14:49:50 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 14:49:50 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 14:49:50 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 14:49:56 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 14:50:28 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 14:54:48 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:02:53 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:05:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:05:43 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:05:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:05:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:05:43 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:35 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:06:56 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:06:56 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:06:56 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:06:56 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:06:56 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:06:58 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:06:58 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:06:58 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:06:58 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:06:58 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:07:02 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:07:22 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:07:47 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:08:45 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:08:45 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:08:45 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:08:45 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:08:45 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:08:54 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:09:56 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:10:44 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:11:57 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 15:12:04 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:16:25 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:16:25 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:16:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:16:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:16:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:16:32 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:17:29 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:17:29 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:17:29 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:17:29 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:17:29 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:17:39 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:17:56 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $total_cost /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7400
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $day_total /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7407
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:23:00 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:23:02 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $total_cost /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7400
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $day_total /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7407
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:24:23 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $total_cost /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7400
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $day_total /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7407
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:25:01 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:25:27 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:26:17 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:26:41 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:26:41 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:26:41 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:26:41 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:26:41 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:27:27 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:27:27 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:27:27 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:27:27 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:27:27 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:28:13 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:28:51 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:29:32 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:30:38 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:30:44 --> Severity: Warning --> Undefined array key "MB" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 26
ERROR - 2026-05-02 15:31:31 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:31:31 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:31:31 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:31:31 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:31:31 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:31:33 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 15:31:33 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 15:31:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:31:33 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 15:31:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:31:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:32:14 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 15:32:14 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 15:32:14 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:32:14 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 15:32:14 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:32:14 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:32:23 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:32:32 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 15:33:11 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:35:58 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:54 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:37:55 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 15:42:00 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:42:00 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:42:00 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:42:00 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:42:00 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:42:20 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:45:59 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:45:59 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:45:59 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:45:59 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:45:59 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:46:44 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:48:33 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:48:33 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:48:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:48:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:48:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:48:40 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:50:31 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:50:31 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:50:31 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:50:31 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:50:31 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:51:13 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:51:13 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:51:13 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:51:13 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:51:13 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:52:06 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:52:06 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:52:06 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:52:06 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:52:06 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:52:14 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:53:47 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 15:53:47 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 15:53:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 15:53:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 15:53:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 15:53:57 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:54:10 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:27 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:54:43 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 15:56:41 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:50 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:03:54 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:05:42 --> Severity: Warning --> Undefined variable $response /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Quotation.php 19779
ERROR - 2026-05-02 16:05:47 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:05:47 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:05:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:05:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:05:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:05:48 --> Severity: Warning --> Undefined variable $response /home/u745045551/domains/crm.kazindmc.com/public_html/application/controllers/admin/Quotation.php 19779
ERROR - 2026-05-02 16:05:52 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 16:06:04 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:06:11 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:06:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:07:46 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:05 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:08:25 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:08:25 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:08:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:08:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:08:25 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:08:34 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:08:51 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:08:51 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:08:51 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:08:51 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:08:51 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:10:00 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $arr_map /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7364
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7365
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $g /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Trying to access array offset on value of type null /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7399
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:15:27 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:15:32 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:17:38 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 16:17:38 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 16:17:38 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:17:38 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 16:17:38 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:17:38 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:18:12 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:19:16 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:21:29 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 16:22:38 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:22:38 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:22:38 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:22:38 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:22:38 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:22:44 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 16:22:44 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 16:22:44 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:22:44 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 16:22:44 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:22:44 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:23:05 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:23:15 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:23:18 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:23:18 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:23:18 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:23:18 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:23:18 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:23:28 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:23:39 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:23:55 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:24:25 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:24:37 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:27:30 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:27:42 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:36:13 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 16:36:13 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 16:36:13 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:36:13 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 16:36:13 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:36:13 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:36:38 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:36:55 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 16:37:02 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:38:01 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:38:23 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:40:37 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:47:57 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:48:06 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:49:30 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:53:05 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:53:05 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:53:16 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:54:40 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:55:33 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:58:07 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 16:58:07 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 16:58:07 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 16:58:07 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 16:58:07 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 16:58:25 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 16:59:39 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:03:20 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 17:03:20 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 17:03:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 17:03:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 17:03:20 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 17:03:52 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:07:00 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:09:25 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:10:29 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:12:52 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:14 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> SQL Query: 
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:18 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:13:19 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/edit_enquiry.php 112
ERROR - 2026-05-02 17:15:47 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7241
ERROR - 2026-05-02 17:15:47 --> Severity: Warning --> Undefined variable $quotation_hotel_details /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7508
ERROR - 2026-05-02 17:15:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 17:15:47 --> Severity: Warning --> Undefined variable $hotel_costing_category_wise /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7535
ERROR - 2026-05-02 17:15:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 17:15:47 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 17:16:08 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 17:24:33 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 17:24:33 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 17:24:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 17:24:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 17:24:33 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 17:24:42 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 17:24:55 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:38:21 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 17:44:39 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 17:44:39 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 17:44:39 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 17:44:39 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 17:44:39 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 17:44:59 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 17:45:06 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 18:05:10 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 18:13:53 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 18:13:53 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 18:13:53 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 18:13:53 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 18:13:53 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 19:31:45 --> Severity: Warning --> Undefined variable $meals /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 186
ERROR - 2026-05-02 19:31:45 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 186
ERROR - 2026-05-02 19:31:45 --> Severity: Warning --> Undefined variable $menus /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 203
ERROR - 2026-05-02 19:31:45 --> Severity: Warning --> foreach() argument must be of type array|object, null given /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/drivers_list.php 203
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:11:09 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/enquiry.php 94
ERROR - 2026-05-02 20:13:51 --> 404 Page Not Found: admin/Quotation/checkCityNights
ERROR - 2026-05-02 20:18:34 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7322
ERROR - 2026-05-02 20:18:34 --> Severity: Warning --> Attempt to read property "date" on string /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7332
ERROR - 2026-05-02 20:18:34 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7520
ERROR - 2026-05-02 20:18:34 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 7912
ERROR - 2026-05-02 20:18:34 --> Severity: Warning --> Undefined variable $all_day_entertainment /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/quotation_create.php 8089
ERROR - 2026-05-02 20:19:22 --> Severity: Warning --> Attempt to read property "currency_abbr" on float /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/email_body.php 712
ERROR - 2026-05-02 22:29:01 --> 404 Page Not Found: Assets/company
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:29:11 --> Severity: Warning --> Undefined variable $selected /home/u745045551/domains/crm.kazindmc.com/public_html/application/views/admin/combo_enquiry.php 149
ERROR - 2026-05-02 22:30:00 --> Severity: Warning --> Undefined array key "MB" /home/u745045551/domains/crm.kazindmc.com/public_html/application/helpers/whatsapp_email_messages_helper.php 26
ERROR - 2026-05-02 23:35:58 --> 404 Page Not Found: Robotstxt/index
ERROR - 2026-05-02 23:53:30 --> 404 Page Not Found: Robotstxt/index

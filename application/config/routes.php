<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$this->set_directory( "admin" );
$route['default_controller'] = 'admin/login';
//admin 
$route['login'] = 'admin/login';
$route['dashboard'] = 'admin/dashboard';
$route['company'] = 'admin/company';
$route['clients'] = 'admin/company/clients';
$route['(:any)/delete-client'] = 'admin/company/delete_client';
$route['enquiry'] = 'admin/enquiry';
$route['indiamart-enquiry'] = 'admin/login/indiamart_enquiry';
$route['quotation'] = 'admin/quotation';
$route['awarded-project'] = 'admin/quotation/awarded_project';
$route['awarded-project-bids'] = 'admin/quotation/awarded_project_bids';
$route['(:any)/order-creation'] = 'admin/quotation/order_creation/$1';
$route['old-order-creation'] = 'admin/quotation/old_order_creation';
$route['order-acknowledgement'] = 'admin/quotation/order_acknowledgement';
$route['(:any)/delete-oa'] = 'admin/quotation/delete_oa';
$route['(:any)/edit-oa'] = 'admin/quotation/edit_oa';
$route['(:any)/invoice'] = 'admin/quotation/invoice/$1';
$route['tender'] = 'admin/tender';
$route['tender-list'] = 'admin/tender/tender_list';
$route['tender-list/(:any)'] = 'admin/tender/tender_list';
$route['(:any)/edit-tender'] = 'admin/tender/edit_tender';
$route['(:any)/tender-followup'] = 'admin/followup/tender_followup/$1';
$route['(:any)/delete-tender'] = 'admin/tender/delete_tender/$1';
$route['(:any)/delete-tender-followup'] = 'admin/tender/delete_tender_followup/$1';
$route['bid'] = 'admin/tender/bid';
$route['(:any)/delete-bid'] = 'admin/tender/delete_bid/$1';
$route['(:any)/delete-bid-followup'] = 'admin/tender/delete_bid_followup/$1';
$route['(:any)/bid-followup'] = 'admin/followup/bid_followup/$1';
$route['(:any)/edit-bid'] = 'admin/tender/edit_bid';
$route['search_product'] = 'admin/products/product_name_suggesstion';
$route['user'] = 'admin/user';
$route['(:any)/followup'] = 'admin/followup/detail/$1';
$route['(:any)/quotation-followup'] = 'admin/followup/quotation/$1';
$route['branch'] = 'admin/company/branch';
$route['enquiry-report'] = 'admin/report/enquiry_report';
$route['enquiry-followup'] = 'admin/enquiry/enquiry_followup';
$route['quotation-report'] = 'admin/report/quotation_report';
$route['client-report'] = 'admin/report/client_report';
$route['tender-report'] = 'admin/report/tender_report';
$route['bid-report'] = 'admin/report/bid_report';
$route['oa-report'] = 'admin/report/oa_report';
$route['logout'] = 'admin/login/logout';
$route['(:any)/print-quotation'] = 'admin/quotation/print_quotation';
$route['(:any)/print-quotation2'] = 'admin/quotation/print_quotation2';
$route['other-product'] = 'admin/products/other_product';
$route['(:any)/edit-product'] = 'admin/products/edit_product';
$route['product'] = 'admin/products/product';
$route['(:any)/delete-product'] = 'admin/products/delete_product';
$route['(:any)/edit-client'] = 'admin/report/edit_client';
$route['(:any)/product-edit'] = 'admin/products/edit_added_product';
$route['product-list'] = 'admin/products/product_list';
$route['(:any)/delete-enquiry'] = 'admin/enquiry/delete_enquiry';
$route['indiamart-followup'] = 'admin/enquiry/indiamart_enquiry';
$route['user'] = 'admin/user';
$route['all-user'] = 'admin/user/user_list';
$route['(:any)/delete-user'] = 'admin/user/delete_user';
$route['(:any)/edit-user'] = 'admin/user/edit_user';
$route['(:any)/mail-data'] = 'admin/quotation/mail_data';
$route['handle-pdf'] = 'admin/quotation/handle_pdf';
$route['sent-quotations'] = 'admin/quotation/sent_quotations';
$route['(:any)/resend-quotation'] = 'admin/quotation/resend_quotation';
$route['group'] = 'admin/group';
$route['group-list'] = 'admin/group/group_list';
$route['(:any)/delete-group'] = 'admin/group/delete_group/$1';
$route['(:any)/edit-group'] = 'admin/group/edit_group/$1';
$route['(:any)/edit-enquiry'] = 'admin/enquiry/edit_enquiry/$1';
$route['pending-enquiry'] = 'admin/report/pending_enquiry';
$route['invoice'] = 'admin/invoice';
$route['invoices'] = 'admin/invoice/invoices';
$route['(:any)/delete-invoice'] = 'admin/invoice/delete_invoice';
$route['(:any)/edit-invoice'] = 'admin/invoice/edit_invoice';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//**************************** 16 April 2021 ***********************************
$route['(:any)/edit-enquiry-indiamart'] = 'admin/enquiry/edit_enquiry_indiamart/$1';

// 23 april 2021
$route['generate_preview'] = 'admin/dashboard/pdf_preview';
$route['draft'] = 'admin/quotation/draft_quotation';
$route['(:any)/generate-invoice'] = 'admin/invoice/generate_invoice/$1';

// ********************************** Api URLS *********************************
$route['api/get_license'] = 'admin/krorus_api/check_license/?';

// 06 May 2022
$route['indiamart-enquiry-new'] = 'admin/login/indiamart_enquiry_new';

$route['expenses/travel'] = 'admin/expenses/travel';

$route['expenses/list'] = 'admin/expenses/expenses_list';
$route['expenses/travel-expenses-details'] = 'admin/expenses/expenses_list';
$route['expenses/Miscellaneous-list-expenses'] = 'admin/expenses/miscellinous';
$route['expenses/miscellinous-expenses'] = 'admin/expenses/miscellinous_expenses';
$route['expenses/Miscellaneous-details-expenses/(:any)'] = 'admin/expenses/miscellinous_record/$1';
$route['expenses/expenses-details/(:any)'] = 'admin/expenses/expenses_data/$1';
$route['expenses/expenses-bills-details/(:any)'] = 'admin/expenses/expenses_data2/$1';
$route['expenses/intercity-details/(:any)'] = 'admin/expenses/intercity_data/$1';


$route['expenses/intercity-expenses'] = 'admin/expenses/intercity_form';
$route['expenses/intercity-list'] = 'admin/expenses/list_intercity';

$route['credit/(:any)'] = 'admin/invoice/credit/$1';
$route['debit/(:any)'] = 'admin/invoice/debit/$1';

$route['enquiry-navigate'] = 'admin/enquiry/navigation';

// 09 Feb 2023
$route['emd-report'] = 'admin/report/emd_report';
// 27 March 2023
$route['performance-security-report'] = 'admin/report/performance_security_report';

//08 May 2023
$route['invoice_generate_preview'] = 'admin/invoice/pdf_preview_invoice';

//28 July 2023

$route['change_password'] = 'admin/user/change_password';

// 14 Aug 2023
$route['agentwise-report'] = 'admin/report/agentwise_report';
$route['enquiry_b2c'] = 'admin/enquiry/b2c';

// 11 Oct 2023
$route['add_arrival?(:any)'] = 'admin/arrivalchart/add';
$route['arrivals?(:any)'] = 'admin/arrivalchart/index';
$route['edit_arrival?(:any)'] = 'admin/arrivalchart/edit';
// 18 Oct 2023
$route['personal_details'] = 'admin/arrivalchart/arrival_personal_details';
$route['room_details'] = 'admin/arrivalchart/arrival_room_details';
// 20 Oct 2023
$route['edit_remove_details'] = 'admin/arrivalchart/edit_remove_details';
$route['edit_personal_details'] = 'admin/arrivalchart/edit_arrival_personal_details';
$route['edit_room_details'] = 'admin/arrivalchart/edit_arrival_room_details';
$route['print_file_arrival?(:any)'] = 'admin/arrivalchart/print_arrivals';
// 30 Oct 2023
$route['flight_details'] = 'admin/arrivalchart/arrival_flight_details';
$route['edit_flight_details'] = 'admin/arrivalchart/edit_arrival_flight_details';

//16 Feb 24
$route['print_service_voucher?(:any)'] = 'admin/arrivalchart/print_service_voucher';

// 01 Nov 2023
$route['all-flight'] = 'admin/flight/flight_list';
$route['all-hotel'] = 'admin/hotel/hotel_list';
$route['all-transport'] = 'admin/transport/transport_list';
$route['delete-transport-image'] = 'admin/Transport/delete_transport_image';
$route['all-guide'] = 'admin/guide/guide_list';

// 04 Nov 2023
$route['add-flight'] = 'admin/flight/index';
$route['add-hotel'] = 'admin/hotel/index';
$route['add-transport'] = 'admin/transport/index';
$route['add-guide'] = 'admin/guide/index';

// 26 Nov 2023
$route['edit-airlines?(:any)'] = 'admin/flight/edit';
$route['delete-airlines?(:any)'] = 'admin/flight/delete';

// 28 Nov 2023
$route['room-category-hotel?(:any)'] = 'admin/hotel/room_category';

// 07 Dec 2023
$route['edit-hotel?(:any)'] = 'admin/hotel/edit';
$route['delete-hotel?(:any)'] = 'admin/hotel/delete_hotel';

$route['edit-transport?(:any)'] = 'admin/transport/edit';
$route['delete-transport?(:any)'] = 'admin/transport/delete_transport';

// 08 Dec 2023
$route['edit-guide?(:any)'] = 'admin/guide/edit';
$route['delete-guide?(:any)'] = 'admin/guide/delete_guide';
// 15 Dec 2023

$route['add-flight-schedule'] = 'admin/flight/schedule';
$route['all-flight-schedule?(:any)'] = 'admin/flight/flight_schedule_list';
$route['edit-flight-schedule?(:any)'] = 'admin/flight/edit_schedule';
$route['delete-flight-schedule?(:any)'] = 'admin/flight/delete_schedule';
$route['get_flight_schedule'] = 'admin/flight/get_schedule';
$route['get-airline-code'] = 'admin/flight/get_airline_code';
// 18 Dec 2023
$route['get_flight_numbers'] = 'admin/flight/get_flight_numbers';
// 21 Dec 2023
$route['create-itinerary?(:any)'] = 'admin/itinerary/create';
$route['save-itinerary'] = 'admin/itinerary/save';
$route['all-itinerary?(:any)'] = 'admin/itinerary/index';
$route['edit_itinerary?(:any)'] = 'admin/itinerary/edit';
$route['update_itinerary'] = 'admin/itinerary/update';
$route['add_update_itinerary'] = 'admin/itinerary/add_update';
// 10 Jan 2024
$route['itinerary_template'] = 'admin/itinerary/template';
$route['save-itinerary-template'] = 'admin/itinerary/save_template';
//12 Jan 2024
$route['all-templates'] = 'admin/itinerary/all_templates';
$route['edit_template?(:any)'] = 'admin/itinerary/template_edit';
$route['update_itinerary_template'] = 'admin/itinerary/update_template';
$route['add_update_itinerary_template'] = 'admin/itinerary/add_update_template';
// 15 Jan 2024
$route['get-itinerary-suggesstions'] = 'admin/itinerary/get_suggesstions';
// 16 Jan 2024
$route['itinerary-masters-create'] = 'admin/masters/create';
$route['all-masters'] = 'admin/masters';
$route['edit_masters?(:any)'] = 'admin/masters/edit';
$route['itinerary-masters-create-restaurants'] = 'admin/masters/create_restaurants';
$route['all-masters-restaurants'] = 'admin/masters/restaurants';
$route['edit_restaurants_masters?(:any)'] = 'admin/masters/edit_restaurants';

$route['delete-masters?(:any)'] = 'admin/masters/delete_masters';
$route['delete-restaurants-masters?(:any)'] = 'admin/masters/delete_masters_restaurant';
$route['edit_remove_masters_remarks'] = 'admin/masters/edit_remove_remarks';
$route['get-itinerary-master-remarks'] = 'admin/itinerary/get_itinerary_master_remarks';
$route['remove_remarks_restaurant'] = 'admin/masters/remove_remarks_restaurant';

// 20 March 2024
$route['payment-details?(:any)'] = 'admin/arrivalchart/payment_details';
$route['edit-payment-details'] = 'admin/arrivalchart/edit_payment_details';
$route['get-arrivals-report'] = 'admin/report/arrivals_report';
$route['monitoring-report'] = 'admin/report/monitoring_report';

//02 April
$route['party-bus'] = 'admin/partybus/index';
$route['add-party-bus'] = 'admin/partybus/add';
$route['add-party-bus-data'] = 'admin/partybus/add_data';
$route['(:any)/delete-bus'] = 'admin/partybus/delete_bus';

//06 April
$route['restaurant-menu-master'] = 'admin/restaurantmenumaster/index';
$route['add-restaurant-menu-master'] = 'admin/restaurantmenumaster/add';
$route['(:any)/delete-restaurant-menu-master'] = 'admin/restaurantmenumaster/delete';


// $route['restaurantmenumaster_menu/(:any)/(:any)'] = 'admin/restaurantmenumaster/menu/$1/$2';
$route['restaurantmenumaster_menu/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/menu/$1/$2/$3';
$route['add-master'] = 'admin/restaurantmenumaster/addMaster';
//$route['restaurantmenumaster_show/(:any)/(:any)'] = 'admin/restaurantmenumaster/show_menu/$1/$2';
$route['restaurantmenumaster_show/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/show_menu/$1/$2/$3';
$route['restaurantmenumaster_delete/(:any)'] = 'admin/restaurantmenumaster/remove_menu/$1';

// 15 April 2024
$route['excel-download?(:any)'] = 'admin/arrivalchart/excel_download';


//15 April 2024
$route['check-data-availability/(:any)/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/check_data_availability/$1/$2/$3/$4';
$route['menu-master-cuisine-delete/(:any)'] = 'admin/restaurantmenumaster/menu_master_cuisine_remove/$1';
$route['restaurant-menus-availability/(:any)'] = 'admin/restaurantmenumaster/restaurant_menus_availability/$1';

//18 April
$route['edit-party-bus?(:any)'] = 'admin/partybus/edit';
$route['edit-party-data-bus'] = 'admin/partybus/data_edit';

$route['verify_otp/(:any)/(:any)'] = 'admin/login/verify_otp';
$route['otp_resend'] = 'admin/login/otp_resend';

//21 April
$route['delete-menus-data/(:any)/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/remove_menus_data/$1/$2/$3/$4';

//30 april
$route['add-enquiry-transportation'] = 'admin/arrivalchart/add_enquiry_transportation';
$route['enquiry-transportation-data/(:num)'] = 'admin/arrivalchart/enquiry_transportation_data/$1';
$route['delete-enquiry-transportation-data/(:num)'] = 'admin/arrivalchart/remove_enquiry_transportation_data/$1';
$route['get-agent-ajax/(:any)'] = 'admin/report/get_agent_ajax/$1';
// $route['get-sales-ajax'] = 'admin/report/get_sales_ajax';

//30 april
$route['add-enquiry-guide'] = 'admin/arrivalchart/add_enquiry_guide';
$route['enquiry-guide-data/(:num)'] = 'admin/arrivalchart/enquiry_guide_data/$1';
$route['delete-enquiry-guide-data/(:num)'] = 'admin/arrivalchart/remove_enquiry_guide_data/$1';

$route['update-enquiry-transportation-data/(:num)'] = 'admin/arrivalchart/update_enquiry_transport_data/$1';
$route['update-enquiry-guide-data/(:num)'] = 'admin/arrivalchart/update_enquiry_guide_data/$1';

//07 April
$route['print-restaurant-voucher?(:any)'] = 'admin/arrivalchart/print_restaurant_voucher';
$route['itinerary-report'] = 'admin/report/itinerary_report';

$route['update-itinerary-dates'] = 'admin/itinerary/update_itinerary_dates';

//10 May
$route['room-category-cost?(:any)'] = 'admin/hotel/room_category_cost';
$route['guide-cost?(:any)'] = 'admin/guide/guide_cost';
$route['print-itinerary-voucher?(:any)'] = 'admin/report/print_itinerary_view';
$route['site-cost?(:any)'] = 'admin/masters/site_cost';


$route['(:any)/edit-client-logo'] = 'admin/report/edit_client_logo';
$route['restaurantmenumaster_menu/(:any)/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/menu/$1/$2/$3/$4';
$route['get-sales-ajax/(:any)'] = 'admin/report/get_sales_ajax/$1';
$route['transportation-cost?(:any)'] = 'admin/transport/transportation_cost';
$route['agents_export_excel'] = 'admin/report/agents_export_excel';
$route['agents_report_excel'] = 'admin/report/agents_report_excel';

$route['client-excel-download?(:any)'] = 'admin/company/excel_download';
$route['partybus-excel-download?(:any)'] = 'admin/partybus/excel_download';

$route['add_currency'] = 'admin/currency/add_value';
$route['currency_list'] = 'admin/currency/index';

// 12 June 2024
$route['vendor-report'] = 'admin/report/vendor_report';
$route['get_hotels'] = 'admin/report/get_hotels';
$route['revenue-report'] = 'admin/report/revenue_report';

// 17 June 2024
$route['merge-address'] = 'admin/company/merge';
$route['merge-same-address'] = 'admin/company/merge_same_address';
$route['(:any)/edit-company'] = 'admin/report/edit_company';
$route['company-data/(:any)'] = 'admin/company/company_data';
$route['(:any)/all-company-data'] = 'admin/company/all_company_data';
$route['(:any)/company-all-details'] = 'admin/company/company_all_details';

$route['select-print-restaurant-voucher?(:any)'] = 'admin/arrivalchart/voucher_select_restaurant';

// 20June 2024
$route['add-restaurants'] = 'admin/restaurantmenumaster/add_restaurant';
$route['check-restaurant-availability/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/check_restaurant_availability/$1/$2/$3';
$route['all-restaurant-availability/(:num)'] = 'admin/restaurantmenumaster/all_restaurant_availability/$1';
$route['edit-restaurants/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/restaurantmenumaster/edit_restaurants/$1/$2/$3/$4/$5';

//26 June 2024
$route['restaurant-report'] = 'admin/report/restaurant_report';
$route['print-restaurant-details?(:any)'] = 'admin/report/print_restaurant_details/$1';
$route['selected-print-restaurant-details?(:any)'] = 'admin/report/selected_print_restaurant_details/$1';

$route['live-tracking'] = 'admin/report/live_tracking';
$route['files/(:any)'] = 'admin/report/date_based_files/$1';
// $route['get-file/(:any)'] = 'admin/report/get_file/$1';
$route['(:num)/activity-log'] = 'admin/report/activity_log/$1';

// 04 July 2024
$route['masters'] = 'admin/dashboard/masters';

//04 June 2024
$route['live-tracking-files'] =  'admin/report/live_tracking_files';
$route['live-tracking-all-files/(:any)/(:any)'] =  'admin/report/live_tracking_all_files/$1/$2';

$route['merge-companies'] = 'admin/company/merge_companies';
$route['merge-hotels'] = 'admin/hotel/merge_hotels';

//09 July 2024
$route['database-report'] = 'admin/report/database_report';
$route['agents-report'] ='admin/report/agents_report';
$route['restaurant-menu-report'] ='admin/report/menu_report';

// $route['costing-room-category-estimation?(:any)'] ='admin/hotel/room_category_costing';
// $route['get-costing-data'] = 'admin/hotel/get_costing_data';

$route['costing-room-category-estimation?(:any)'] ='admin/hotel/room_category_costing';
$route['edit-room-category-costing?(:any)'] ='admin/hotel/room_category_costing_edit';
$route['edit-room-category-estimation?(:any)'] = 'admin/hotel/edit_category_costing';
$route['get-costing-data'] = 'admin/hotel/get_costing_data';
$route['add-costing-price'] = 'admin/hotel/add_costing_price';
$route['edit-costing-price'] = 'admin/hotel/edit_costing_price';

$route['blackout-dates'] = 'admin/masters/blackout_dates_list';
$route['delete-blackout-dates'] = 'admin/masters/delete_blackout_dates';

$route['enquiry-excel-download?(:any)'] = 'admin/enquiry/excel_download';

$route['send-whatsapp-message'] = 'admin/login/send_dummy_data';
$route['send-whatsapp-message-otp'] = 'admin/login/send_dummy_whatsapp_message_otp';

$route['staff-report'] = 'admin/report/staff_report';

$route['get_guides_details'] = 'admin/itinerary/guide_details';
$route['add-guide-costing'] = 'admin/itinerary/add_guide_cost';

$route['print-restaurant-menu-report'] = 'admin/report/print_menu_report';
$route['print-guide-details'] = 'admin/guide/print_guide_details';
$route['transportation-report'] = 'admin/report/transportation_report';

$route['vendor-all-reports'] = 'admin/report/vendor_all_reports';

$route['merge-agents'] = 'admin/company/merge_agents';
$route['transfer-agents'] = 'admin/company/transfer_agents';

$route['hotel-pricing-download'] = 'admin/hotel/hotel_pricing_download';
$route['csv-upload'] = 'admin/hotel/csv_upload';

$route['transport-costing'] ='admin/transport/transportation_cost';
$route['add-transportation-cost'] ='admin/transport/transportation_cost_add';
$route['add-outsidecity-transportation-cost'] = 'admin/transport/add_outsidecity_transportation_cost';
$route['location-master'] = 'admin/masters/location_master_list';
$route['location/delete/(:any)'] = 'admin/masters/delete_location/$1';

$route['add-activities-cost'] = 'admin/masters/add_activities_cost';

$route['quotation_create'] = 'admin/quotation/create';

// 21 Jan 2025
$route['comparisons'] = 'admin/comparisons';

$route['auxiliary-master'] = 'admin/masters/auxiliary_master';
$route['auxiliary-guide-master'] = 'admin/masters/auxiliary_guide_list';
$route['auxiliary-guide-create'] = 'admin/masters/auxiliary_guide_create';
$route['auxiliary-guide-edit'] = 'admin/masters/auxiliary_guide_edit';
$route['auxiliary-guide-delete'] = 'admin/masters/auxiliary_guide_delete';

$route['auxiliary-luggage-vehicle'] = 'admin/masters/auxiliary_luggage_vehicle';
$route['auxiliary-luggage-vehicle-create'] = 'admin/masters/auxiliary_luggage_vehicle_create';
$route['auxiliary-luggage-vehicle-edit'] = 'admin/masters/auxiliary_luggage_vehicle_edit';
$route['auxiliary-luggage-vehicle-delete'] = 'admin/masters/auxiliary_luggage_vehicle_delete';

$route['auxiliary-miscellaneous-master'] = 'admin/masters/auxiliary_miscellaneous_master';
$route['auxiliary-miscellaneous-create'] = 'admin/masters/auxiliary_miscellaneous_create';
$route['auxiliary-miscellaneous-edit'] = 'admin/masters/auxiliary_miscellaneous_edit';
$route['auxiliary-miscellaneous-delete'] = 'admin/masters/auxiliary_miscellaneous_delete';

$route['auxiliary-sightseeing-master'] = 'admin/masters/auxiliary_sightseeing_vehicle';
$route['auxiliary-sightseeing-vehicle-create'] = 'admin/masters/auxiliary_sightseeing_vehicle_create';
$route['auxiliary-sightseeing-vehicle-edit'] = 'admin/masters/auxiliary_sightseeing_vehicle_edit';
$route['auxiliary-sightseeing-vehicle-delete'] = 'admin/masters/auxiliary_sightseeing_vehicle_delete';

// state master
$route['state-master'] = 'admin/masters/state_master';
$route['state-master-list'] = 'admin/masters/state_master_list';
$route['state-master-edit/(:num)'] = 'admin/masters/edit_state_master/$1';
$route['state-master-delete/(:num)'] = 'admin/masters/delete_state_master/$1';

// city master
$route['city-master'] = 'admin/masters/city_master';
$route['city-master-list'] = 'admin/masters/city_master_list';
$route['edit-city-master/(:num)'] = 'admin/masters/edit_city_master/$1';
$route['delete-city-master/(:num)'] = 'admin/masters/delete_city_master/$1';

// 5/6/2025
$route['add-driver'] = 'admin/masters/add_driver';
$route['edit-driver?(:any)'] = 'admin/masters/edit_driver/$1';
$route['drivers-list'] = 'admin/masters/list_drivers';
$route['delete-driver?(:any)'] = 'admin/masters/delete_driver/$1';
$route['enquiry-driver-data/(:num)'] = 'admin/arrivalchart/fetch_driver_name/$1';
$route['add-enquiry-driver'] = 'admin/arrivalchart/add_enquiry_driver';

//send whatsapp file
$route['send-whatsapp'] = 'admin/login/send_whatsapp';

//whatsapp pdf
$route['send_pdf_on_whatsapp'] = 'admin/arrivalchart/sendPdfOnWhatsapp';

// 22 july 2025
$route['agents-productivity-report'] = 'admin/report/agent_productivity_report';
$route['admin/report/download_agent_pdf/(:any)'] = 'admin/report/download_agent_pdf/$1';

$route['sales-productivity-report'] = 'admin/report/sales_productivity_report';
$route['admin/report/download_sales_pdf/(:any)'] = 'admin/report/download_sales_pdf/$1';

$route['brief-itinerary/(:any)']='admin/BriefItinerary/index/$1';
$route['generate-download-doc']='admin/BriefItinerary/generate_download_doc/';
$route['schedule-whatsapp-doc']='admin/BriefItinerary/schedule_whatsapp_doc/';
$route['track-hotel-click'] = 'admin/BriefItinerary/track_hotel_click';

// Statewise Tier filter view
$route['tier-filter']='admin/TierController/index';

// overnight itinerary routes
$route['itinerary-masters-create-new'] = 'admin/masters/create_new';

// 05 oct combo arrival
$route['add_arrival_combo?(:any)'] = 'admin/arrivalchart/add_new/$1';
// combo view page
$route['combo'] = 'admin/enquiry/index1';
// combo edit file
$route['combo-edit/(:any)'] = 'admin/enquiry/combo_edit/$1';

$route['room-category-page/(:any)'] = 'admin/BriefItinerary/view_hotel_Category/$1';

//get hotel data 
$route['hotel-details/(:any)'] = 'admin/BriefItinerary/view_hotel_details/$1';

//get transport data 
$route['transport-details/(:any)'] = 'admin/BriefItinerary/view_transport_details/$1';

// Train Master 27/12/2025
$route['all-train'] = 'admin/train/train_list';
$route['add-train'] = 'admin/train/add_train';
$route['add-train-schedule'] = 'admin/train/add_train_schedule';
$route['all-train-schedule'] = 'admin/train/train_schedule_list';

$route['admin/train_schedule/get_trains_by_country'] = 'admin/train/get_trains_by_country';

$route['edit-train?(:any)'] = 'admin/train/train_edit/$1';
$route['delete-train?(:any)'] = 'admin/train/train_delete/$1';
$route['train-schedule-edit?(:any)'] = 'admin/train/edit_train_schedule/$1';
$route['train-schedule-delete?(:any)'] = 'admin/train/delete_train_schedule/$1';

$route['original-budget-report/(:any)'] = 'admin/BudgetReport/original_budget_report/$1';
$route['budget-report/(:any)'] = 'admin/BudgetReport/budget_report/$1';
$route['budget-report-view/(:any)'] = 'admin/BudgetReport/view_saved_budget/$1';
$route['budget-report-tracking'] = 'admin/BudgetReport/budget_tracking_report';

$route['quotes/fetch_similar'] = 'admin/quotation/fetch_similar_quotes';
$route['add-entrance-cost'] = 'admin/masters/add_entrance_cost';

// meal master routes start here
$route['add-meal-price'] = 'admin/enquiry/create_meal_master';
$route['meal-master-list'] = 'admin/enquiry/meal_master_list';
$route['meal-master-edit/(:num)/(:any)'] = 'admin/enquiry/edit_meal_master/$1/$2';
$route['meal-master-update'] = 'admin/enquiry/update_meal_master';
$route['meal-master-delete-row'] = 'admin/enquiry/delete_meal_row';
$route['meal-master-delete/(:num)/(:any)'] = 'admin/enquiry/delete_meal_master/$1/$2';
$route['get-meals-by-country'] = 'admin/enquiry/getMealsByCountry';

// standard meal menu view page routes
$route['meal-menu/(:any)'] = 'admin/BriefItinerary/menu/$1';
$route['agent-active-status'] = 'admin/report/agent_active_status_view';

// Whatsapp acknowledgement routes start here 
$route['q/(:any)/download'] = 'admin/BriefItinerary/download/$1';
$route['q/(:any)/pdf'] = 'admin/BriefItinerary/downloadPdf/$1';
$route['q/(:any)/render'] = 'admin/BriefItinerary/render/$1';
$route['q/(:any)'] = 'admin/BriefItinerary/preview/$1';


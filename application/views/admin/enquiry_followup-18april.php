<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/>  
    <style>
	div.timeline {
            list-style-type: none;
            position: relative;
        }
        div.timeline>div{
                padding: 5px 5px;
                background-color: #f5f5f5;
                border-radius: 10px;
        }
        div.info>div {
            border: 1px solid #efecec;
    	}
    	.select2-container{ width:100% !important;  }
    	.scrollbar
        {
                margin-left: 30px;
                float: left;
                height: 300px;
                width: 65px;
                background: #F5F5F5;
                overflow-y: scroll;
                margin-bottom: 25px;
        }
        #hotel-categories::-webkit-scrollbar-track
        {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
                border-radius: 10px;
        }

        #hotel-categories::-webkit-scrollbar
        {
                width: 6px;
                background-color: #F5F5F5;
        }

        #hotel-categories::-webkit-scrollbar-thumb
        {
                border-radius: 10px;
                background-color: #0ae;
                background-image: -webkit-gradient(linear, 0 0, 0 100%,
                                   color-stop(.5, rgba(255, 255, 255, .2)),
                                                   color-stop(.5, transparent), to(transparent));
        }
        .nav-tabs .show{
            /*background-color: #2CA8FF !important;
            color: #FFF !important;*/
            
            border: 1px solid #e3e0e0;
            border-bottom: 1px solid #FFF;
        }
        .timeline a:after {
            font-family:Fontawesome;
            content:'\f077';
            float:right;
            font-size:10px;
            font-weight:300;
        }
        .timeline a.collapsed:after {
            font-family:Fontawesome;
            content:'\f078';
        }
        .row-bg{
            background-color: #f0f8ff;padding: 10px 5px;
        }
        .row-bg-clone{
            background-color: #fbfbfb;padding: 10px 5px;
        }
    </style>
</head>
<!-- END HEAD -->

<div class="modal fade" id="myModalquotation" role="dialog" style="top:-20px;">
	<div class="modal-dialog modal-lg" style="max-width:1415px;">
		<div class="modal-content">
			<div class="modal-header" style="padding:0 12px;">
				<h4 class="modal-title">Make Quotation</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body ui-front">
                            <div class="row" style="margin-top:-15px;">
                                <div class="col-lg-12 p-2">
                                    <div class="row info sbold text-center">
                                        <div class="offset-1 col-lg-2 p-1">
                                            <span>Quotation No.</span>
                                            <label class="qdata"></label>
                                        </div>                                                    
                                        <div class="col-lg-2 p-1">
                                            <span>Guests</span>
                                            <label class="qdata"></label>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <span>Check-in Date</span>
                                            <label class="qdata"></label>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <span>Check-out Date</span>
                                            <label class="qdata"></label>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <span>Nights</span> 
                                            <label class="qdata"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home" class="show active">Initial</a></li>
                                <li><a data-toggle="tab" href="#menu1">Exact</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-12">
						<div id="msgDiv"></div>
                                        <form method="get" id="frm_1" action="<?php echo base_url('quotation_create'); ?>">
                                            <div class="card-body">							
                                                <input type="hidden" name="enquiry_id" id="enquiry_id" value=""/>
                                                <div class="row" id="quotation-make-1">

                                                        <div class="col-lg-4" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                            <h4 class="m-b-5 thin">Flight Details</h4>
                                                            <div class="row">
                                                                <div class="form-floating mb-3 col-md-6">
                                                                    <label class="bold">City Of Origin </label>
                                                                    <input type="text" class="form-control flight-city" id="origin_city" placeholder="Search City">
                                                                </div>
                                                                <div class="form-floating mb-3 col-md-6">
                                                                    <label class="bold">City Of Arrival </label>
                                                                    <input type="text" class="form-control qtn-city" id="" placeholder="Search City">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-floating col-md-6">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                                        style="display:inline-flex;">
                                                                        <input type="text" name="" class="mdl-textfield__input dt-search-show" style="width:90%;" value="" readonly>
                                                                        <?php echo form_input(['type' => 'date', 'name' => 'qt_arrival_date', 'placeholder' => '', 'id' => '', 'class' => 'mdl-textfield__input dt-search', 'value' => '', 'style' => 'width:20px;float:right;']) ?>
                                                                        <label class="mdl-textfield__label">Arrival Date</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-floating col-md-4">
                                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                                        style="display:inline-flex;">
                                                                        <input type="time" name="" value="" placeholder="" id="flight-arrival" class="mdl-textfield__input">
                                                                        <label class="mdl-textfield__label">Arrival Time</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-floating col-md-2">
                                                                    <div class="mt-2" style="text-align: center;">
                                                                        <input type="checkbox" name="" value="" placeholder="" id="initial_early_checkin" class="" disabled="">
                                                                        <label style="font-size: 9px;">Early Check-in</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-floating city-details mb-3" style="border-top:3px solid #FFF;"> </div>
                                                        </div>

                                                        <div class="col-lg-4" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                            <h4 class="m-b-5 thin">Select Hotels City Wise</h4>
                                                            <label class="bold">With Hotel </label>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" value="yes" name="hotel">
                                                                    Yes
                                                                </label>
                                                                <label>
                                                                    <input type="radio" value="no" name="hotel" checked>
                                                                    No
                                                                </label>
                                                            </div>
                                                            <div id="hotel-details" style="">
                                                                <label class="bold">Hotel Category</label>
                                                                <div class="form-floating mb-5">
                                                                    <label>
                                                                    <input type="checkbox" value="3 Star" name="hotel_category[]">
                                                                            3 Star
                                                                    <input type="checkbox" value="4 Star" name="hotel_category[]">
                                                                            4 Star
                                                                    <input type="checkbox" value="5 Star" name="hotel_category[]">
                                                                            5 Star
                                                                    <input type="checkbox" value="5 Star Luxury" name="hotel_category[]">
                                                                            5 Star Luxury
                                                                    </label>
                                                                </div>
                                                                <div class="form-floating daywise-hotel-details mb-3" style="border-top:3px solid #FFF;">
                                                                </div>
                                                            </div>
                                                        </div>  

                                                        <div class="col-lg-4" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                                <h4 class="m-b-5 thin">Guide Cum Vehicle Selection</h4>                                                                 

                                                                <label class="bold">Airport Pick and Drop</label>
                                                                <div>
                                                                        <label>
                                                                                <input type="radio" value="yes" name="airport_pick_drop">
                                                                                Yes
                                                                        </label>
                                                                        <label>
                                                                                <input type="radio" value="no" name="airport_pick_drop" checked>
                                                                                No
                                                                        </label>
                                                                </div>

                                                                <div class="row" style="border-top:3px solid #FFF;">	
                                                                        <div class="col-md-9 mt-2">
                                                                                <label class="bold">Suggested Vehicles</label>
                                                                        </div>

                                                                        <div class="col-md-3 mt-2">
                                                                                <label class="bold">Quantity</label>
                                                                        </div>
                                                                </div>

                                                                <div class="row" id="suggessted_vehicles">	

                                                                </div>
                                                                <div class="row" style="border-top:3px solid #FFF;" id="add_vehicles">	
                                                                        <div class="col-md-9 mt-2">
                                                                                <label class="bold">Select Vehicles</label>
                                                                        </div>

                                                                        <div class="col-md-3 mt-2">
                                                                                <label class="bold">Quantity</label>
                                                                        </div>
                                                                </div>
                                                                <div class="row">	
                                                                        <div class="col-md-9">
                                                                                <div class="form-floating mb-3">
                                                                                        <input type="text" class="form-control" id="search_transportation" placeholder="Search Vehicle">
                                                                                </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                                <div class="form-floating mb-3">
                                                                                        <input type="number" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity">												
                                                                                </div>
                                                                        </div>
                                                                </div>

                                                                <div class="row" style="border-top:3px solid #FFF;">	
                                                                        <div class="col-md-6 mt-1">
                                                                                <label class="bold">Guide</label>
                                                                                <div>
                                                                                        <label>
                                                                                                <input type="radio" value="yes" name="guide">
                                                                                                Yes
                                                                                        </label>
                                                                                        <label>
                                                                                                <input type="radio" value="no" name="guide" checked>
                                                                                                No
                                                                                        </label>
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-6">											
                                                                            <div id="div_driver_cum_guide" style="display: none;">
                                                                                <label class="mt-2">
                                                                                    <input type="radio" value="driver_guide" name="driver_cum_guide">
                                                                                    Driver Cum Guide
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" value="guide" name="driver_cum_guide" checked>
                                                                                    Only Guide
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                </div>

                                                                <div class="row" style="border-top:3px solid #FFF;">
                                                                    <div class="col-md-8 mt-2 mb-2">												
                                                                        <label class=" bold">
                                                                                Markup (Percentage)
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-4 mt-2 mb-2">												
                                                                        <input type="number" class="form-control" id="" min="1" value="10" name="markup_percentage" placeholder="Enter Markup">
                                                                    </div>
                                                                </div>
                                                        </div>       	
                                                        <div class="col-lg-12 mt-4"> 
                                                                <button type="button" class="btn btn-primary float-right" id="btn_hotel">Proceed <i class="fa fa-angle-double-right"></i></button>								
                                                        </div>

                                                </div>

                                                <div class="row" id="quotation-make-2" style="display:none;">
                                                        <div class="col-md-7">

                                                            <div class="col-md-12 mt-4" id="hotel-categories" class="scrollbar" style="max-height: 480px;border: 1px solid #f1f1f1;border-radius: 9px;overflow-y: scroll;">											
                                                            </div>

                                                            <div class="col-lg-12 mt-4">
                                                                    <button type="button" class="btn btn-primary float-left" id="previous"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <h5 class="bold">Itinerary Details</h5>
                                                            <!--div class="row">
                                                                <div class="col-md-2"><label>Inside City</label></div>
                                                                <div class="col-md-8">
                                                                    <select id="sites_inside" name="sites_inside[]" class="mdl-textfield__input js-example-basic-multiple sites">
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-1"><button type="button" class="btn btn-primary add_itinerary" style="padding:3px 9px;">Add</button></div>
                                                                <div class="col-md-2"><label>Outside City</label></div>
                                                                <div class="col-md-8">
                                                                    <select id="sites_outside" name="sites_outside[]" class="mdl-textfield__input js-example-basic-multiple sites">
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-1"><button type="button" class="btn btn-primary add_itinerary" style="padding:3px 9px;">Add</button></div>
                                                            </div-->

                                                            <div class="row mt-2">
                                                                    <div class="col-md-12">
                                                                    <div class="timeline">                                                    

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    <div class="col-lg-12 mt-2">
                                                        <button type="button" class="btn btn-primary float-right" id="btn_restaurants">Proceed <i class="fa fa-angle-double-right"></i></button>										
                                                    </div>
                                                </div>
                                                
                                                <div class="row" id="quotation-make-3" style="display:none;">
                                                    <div class="col-md-8">
                                                        <h5 class="bold">Restaurants</h5>
                                                        <div class="row mt-2" style="padding:0 5px;">
                                                            <div class="col-md-12" id="show-restaurants" >											
                                                            </div>
                                                            <div class="col-lg-12 mt-2">
                                                                <button type="button" class="btn btn-primary float-left" id="previous-to-hotels"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="bold">Guides</h5>
                                                        <div class="row mt-2" style="">
                                                            <div class="col-md-12" id="show-guides" >                                                                
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="col-lg-12 mt-2">
                                                        <button type="submit" class="btn btn-primary float-right" id="create_quotation" formtarget="_blank">Create Quotation</button>										
                                                    
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                           
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="msgDiv"></div>
						
                                            <div class="card-body">							
                                            <input type="hidden" name="enquiry_id" id="enquiry_id" value=""/>
                                            <form method="get" id="frm_1" action="<?php echo base_url('quotation_create'); ?>">
                                                <div class="row" id="quotation-make-1">

                                                    <div class="col-lg-3" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                            <h4 class="m-b-5 thin">Flight Details</h4>

                                                            <div class="form-floating mb-3">
                                                                    <label class="bold">City Of Origin </label>
                                                                    <input type="text" class="form-control flight-city" id="origin_city" placeholder="Search City">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                    <label class="bold">Airline </label>
                                                                    <select id="origin-airline" name="origin-airline[]" class="mdl-textfield__input js-example-basic-multiple airline" >
                                                                        <option value="">Select..</option>                                                
                                                                    </select>
                                                            </div>

                                                            <div class="form-floating airline-show" style="display:none;">
                                                                    <div class="row" id="">	
                                                                            <div class="col-md-6 mt-2">
                                                                                    <label class="bold">Arrival City</label><br>
                                                                                    <label class="info-city"></label>
                                                                                    <input type="hidden" name="hdn_arrival_city" id="hdn_arrival_city" value="">
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                    <label class="bold">Arrival Time</label><br>
                                                                                    <label class="info-time"></label>
                                                                                    <input type="hidden" name="hdn_arrival_time" id="hdn_arrival_time" value="">
                                                                            </div>												
                                                                    </div>
                                                                    <div class="row">
                                                                            <div class="col-md-6 mt-2">
                                                                                    <label class="bold">Early Check-In</label>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                    <input type="checkbox" name="early_checkin" id="early_checkin">
                                                                            </div>
                                                                    </div>
                                                            </div>

                                                            <div class="form-floating mb-3" style="border-top:3px solid #FFF;"> <br>
                                                                    <label class="bold">City Of Departure </label>
                                                                    <input type="text" class="form-control flight-city" id="departure_city" placeholder="Search City">
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                    <label class="bold">Airline </label>
                                                                    <select id="departure-airline" name="departure-airline[]" class="mdl-textfield__input js-example-basic-multiple airline" >
                                                                        <option value="">Select..</option>                                                
                                                                    </select>
                                                            </div>

                                                            <div class="form-floating mb-3 airline-show" style="display:none;">
                                                                    <div class="row" id="">	
                                                                            <div class="col-md-6">
                                                                                    <label class="bold">Departure Time</label><br>
                                                                                    <label class="info-time"></label>
                                                                                    <input type="hidden" name="hdn_departure_time" id="hdn_departure_time" value="">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                    <label class="bold">Arrival City</label><br>
                                                                                    <label class="info-city"></label>
                                                                            </div>

                                                                    </div>
                                                            </div>

                                                    </div>

                                                    <div class="col-lg-3" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                            <h4 class="m-b-5 thin">Guide Cum Vehicle Selection</h4>                                                                 

                                                            <label class="bold">Airport Pick and Drop</label>
                                                            <div>
                                                                    <label>
                                                                            <input type="radio" value="yes" name="airport_pick_drop">
                                                                            Yes
                                                                    </label>
                                                                    <label>
                                                                            <input type="radio" value="no" name="airport_pick_drop" checked>
                                                                            No
                                                                    </label>
                                                            </div>

                                                            <div class="row" style="border-top:3px solid #FFF;">	
                                                                    <div class="col-md-9 mt-2">
                                                                            <label class="bold">Suggessted Vehicles</label>
                                                                    </div>

                                                                    <div class="col-md-3 mt-2">
                                                                            <label class="bold">Quantity</label>
                                                                    </div>
                                                            </div>

                                                            <div class="row" id="suggessted_vehicles">	

                                                            </div>
                                                            <div class="row" style="border-top:3px solid #FFF;" id="add_vehicles">	
                                                                    <div class="col-md-9 mt-2">
                                                                            <label class="bold">Select Vehicles</label>
                                                                    </div>

                                                                    <div class="col-md-3 mt-2">
                                                                            <label class="bold">Quantity</label>
                                                                    </div>
                                                            </div>
                                                            <div class="row">	
                                                                    <div class="col-md-9">
                                                                            <div class="form-floating mb-3">
                                                                                    <input type="text" class="form-control" id="search_transportation" placeholder="Search Vehicle">
                                                                            </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                            <div class="form-floating mb-3">
                                                                                    <input type="number" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity">												
                                                                            </div>
                                                                    </div>
                                                            </div>

                                                            <div class="row" style="border-top:3px solid #FFF;">	
                                                                    <div class="col-md-6 mt-1">
                                                                            <label class="bold">Guide</label>
                                                                            <div>
                                                                                    <label>
                                                                                            <input type="radio" value="yes" name="guide">
                                                                                            Yes
                                                                                    </label>
                                                                                    <label>
                                                                                            <input type="radio" value="no" name="guide" checked>
                                                                                            No
                                                                                    </label>
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-md-6">											
                                                                            <div id="div_driver_cum_guide" style="display: none;">
                                                                                    <label class="mt-2">
                                                                                            <input type="radio" value="driver_guide" name="driver_cum_guide">
                                                                                            Driver Cum Guide
                                                                                    </label>
                                                                                    <label>
                                                                                            <input type="radio" value="guide" name="driver_cum_guide" checked>
                                                                                            Only Guide
                                                                                    </label>
                                                                            </div>
                                                                    </div>
                                                            </div>

                                                            <div class="row" style="border-top:3px solid #FFF;">
                                                                    <div class="col-md-8 mt-2 mb-2">												
                                                                            <label class=" bold">
                                                                                    Markup (Percentage)
                                                                            </label>
                                                                    </div>
                                                                    <div class="col-md-4 mt-2 mb-2">												
                                                                            <input type="number" class="form-control" id="" min="1" value="10" name="markup_percentage" placeholder="Enter Markup">
                                                                    </div>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-3" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                            <h4 class="m-b-5 thin">Select Hotels City Wise</h4>
                                                            <label class="bold">With Hotel </label>
                                                            <div>
                                                                    <label>
                                                                            <input type="radio" value="yes" name="hotel">
                                                                            Yes
                                                                    </label>
                                                                    <label>
                                                                            <input type="radio" value="no" name="hotel" checked>
                                                                            No
                                                                    </label>
                                                            </div>
                                                            <div id="hotel-details" style="display:none;">
                                                                    <label class="bold">Hotel Category</label>
                                                                    <div class="form-floating mb-3">
                                                                            <label>
                                                                            <input type="checkbox" value="3 Star" name="hotel_category[]">
                                                                                    3 Star
                                                                            <input type="checkbox" value="4 Star" name="hotel_category[]">
                                                                                    4 Star
                                                                            <input type="checkbox" value="5 Star" name="hotel_category[]">
                                                                                    5 Star
                                                                            <input type="checkbox" value="5 Star Luxury" name="hotel_category[]">
                                                                                    5 Star Luxury
                                                                            </label>

                                                                    </div>
                                                                    <div class="form-floating" style="border-top:3px solid #FFF;" >
                                                                            <label class="mt-3">
                                                                                    <input type="radio" value="yes" name="city_visit">
                                                                                    Single City
                                                                                    <input type="radio" value="no" name="city_visit" checked>
                                                                                    Multi City
                                                                            </label>
                                                                    </div>
                                                                    <div class="row" id="">	
                                                                            <div class="col-md-9 mt-2">
                                                                                    <label class="bold">City</label>
                                                                            </div>

                                                                            <div class="col-md-3 mt-2">
                                                                                    <label class="bold">Nights</label>
                                                                            </div>

                                                                    </div>
                                                                    <div class="row">	
                                                                            <div class="col-md-9">
                                                                                    <div class="form-floating mb-3">
                                                                                            <input type="text" class="form-control" id="hotel-city" placeholder="Search City">
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                    <div class="form-floating mb-3">
                                                                                            <input type="number" class="form-control" id="num_nights" min="1" value="1" placeholder="Nights">												
                                                                                    </div>
                                                                            </div>
                                                                    </div>

                                                                    <div class="row">	
                                                                            <div class="col-md-12">
                                                                                    <div class="form-floating mb-3">
                                                                                            <select id="select-hotels" name="select-hotels[]" class="mdl-textfield__input js-example-basic-multiple" multiple="">

                                                </select>
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-12 mb-2">						
                                                                                    <button type="button" class="btn btn-primary" id="add-hotel" style="float:right;">Add <i class="fa fa-angle-double-right"></i></button>
                                                                            </div>
                                                                    </div>

                                                                    <!--div class="form-floating mb-3 child-age">

                                                                    </div-->
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-3" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                            <h4 class="m-b-5 thin">Hotel Details</h4>
                                                            <div id="div-hotels">

                                                            </div>							
                                                    </div>	
                                                    <div class="col-lg-12 mt-4"> 
                                                            <button type="button" class="btn btn-primary float-right" id="btn_hotel">Proceed <i class="fa fa-angle-double-right"></i></button>								
                                                    </div>

                                            </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary float-right hide" id="create_quotation" formtarget="_blank">Create Quotation</button>										
                                                    </div>
                                                </div>
                                            </form>
                                            <form method="get" id="frm_2" action="">
                                                <div class="row" id="quotation-make-2" style="display:none;">
                                                <div class="col-md-7">

                                                        <div class="col-md-12 mt-4" id="hotel-categories" class="scrollbar" style="max-height: 480px;border: 1px solid #f1f1f1;border-radius: 9px;overflow-y: scroll;">											
                                                        </div>

                                                        <div class="col-lg-12 mt-4">
                                                                <button type="button" class="btn btn-primary float-left" id="previous"> <i class="fa fa-angle-double-left"></i> Previous </button>

                                                        </div>
                                                </div>
                                <div class="col-md-5">
                                    <h5 class="bold">Itinerary Details</h5>
                                    <div class="row">
                                        <div class="col-md-2"><label>Inside City</label></div>
                                        <div class="col-md-8">
                                            <select id="sites_inside" name="sites_inside[]" class="mdl-textfield__input js-example-basic-multiple sites">
                                            </select>
                                        </div>
                                        <div class="col-md-1"><button type="button" class="btn btn-primary add_itinerary" style="padding:3px 9px;">Add</button></div>
                                        <div class="col-md-2"><label>Outside City</label></div>
                                        <div class="col-md-8">
                                            <select id="sites_outside" name="sites_outside[]" class="mdl-textfield__input js-example-basic-multiple sites">
                                            </select>
                                        </div>
                                        <div class="col-md-1"><button type="button" class="btn btn-primary add_itinerary" style="padding:3px 9px;">Add</button></div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="timeline">                                                    

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                                    </div>
                                            </form>
                                            </div>
					</div>
                                    </div>
                                </div>
                            </div>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>
    <div class="modal fade" id="modalActivities" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width:1150px;border:5px solid #d6deff;">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#eff3f6;">
                    <h4 class="modal-title">Activities</h4>
                    <button type="button" class="close pricing-modal" data-dismiss="modal" id="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="frm-activities">
                        <div id="response-message"></div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-1">Adults</div>
                            <div class="col-md-1">Child</div>
                            <div class="col-md-4"></div>
                            <div class="col-md-1">Adults</div>
                            <div class="col-md-1">Child</div>
                        </div>
                        <div class="row" id="embed-activities"></div>
                        <input type="hidden" name="hdn-index" id="hdn-index" value="">
                        <div class="row mt-2">
                            <div class="col-md-8 show-msg"></div>
                            <div class="col-md-4"><input class="btn btn-md btn-success float-right" type="button" id="btn-submit" name="btn-submit" value="Add"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="icon-and-text-button-demo">
                                <a href="enquiry-followup" class="btn btn-info waves-effect" style="margin-left:5px;">
                                    <i class="material-icons">supervisor_account</i><br>
                                    <span>Queryboard</span>
                                </a>

                            </div>
                        </div>
                    </div>


                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Queryboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Queryboard</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Queryboard</header>
                                    <div class="tools"
                                        style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'block'; ?>">
                                        <a href="<?= base_url(); ?>enquiry" class="btn btn-success" style="padding:6px;"
                                            title="Add Query B2B">
                                            <i class="fa fa-plus"></i> Add (B2B)</a>
                                        <a href="<?= base_url(); ?>enquiry_b2c" class="btn btn-success"
                                            style="padding:6px;" title="Add Query B2C">
                                            <i class="fa fa-plus"></i> Add (B2C)</a>
                                        <?php if(($this->session->userdata('type') == 1)){ ?>    
                                        <a href="<?= base_url('enquiry-excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>" class="btn btn-primary"
                                            style="padding:6px;" title="Download Excel" target="_blank">
                                            <i class="fa fa-download"></i> Download Excel</a>
                                        <?php } ?>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Search</h4>
                                            </div>

                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="location" id="location" class="mdl-textfield__input"
                                                        style="padding: 10px;">
                                                        <option value=""></option>
                                                        <?php
                                                        asort($locations);
                                                        foreach ($locations as $key => $val) { //$val[]='All'; 
                                                            if ($this->session->userdata('locations') == $key || $this->session->userdata('locations') == 'all') {
                                                                ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="staff_id" id="staff_id" class="mdl-textfield__input"
                                                        style="padding: 10px;">
                                                        <option value=""></option>

                                                    </select>
                                                    <label class="mdl-textfield__label">Staff</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="booking_type" id="booking_type"
                                                        class="mdl-textfield__input" style="padding: 10px;">
                                                    </select>
                                                    <label class="mdl-textfield__label">Booking Type</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'from', 'placeholder' => '', 'id' => 'from', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">From</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'to', 'id' => 'to', 'placeholder' => '', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">To</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'company', 'id' => 'company', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('company'))]); ?>
                                                    <label class="mdl-textfield__label">Company</label>
                                                </div>
                                                <input type="hidden" name="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                                    <label class="mdl-textfield__label">Select Country</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country_id" id="country_id" value="<?=$this->input->get('country_id')?>">
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('state'))]) ?>
                                                    <label class="mdl-textfield__label">State</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state_id" id="state_id" value="<?=$this->input->get('state_id')?>">

                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('city'))]) ?>
                                                    <label class="mdl-textfield__label">City</label>
                                                </div>
                                            </div>
											<div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('checkin_from') <> '') ? date('d-M-Y', strtotime($this->input->get('checkin_from'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'checkin_from', 'placeholder' => '', 'id' => 'checkin_from', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('checkin_from') <> '') ? $this->input->get('checkin_from') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">Arrival From</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-search-show" style="width:90%;"
                                                        value="<?php echo ($this->input->get('checkout_to') <> '') ? date('d-M-Y', strtotime($this->input->get('checkout_to'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'checkout_to', 'id' => 'checkout_to', 'placeholder' => '', 'class' => 'mdl-textfield__input dt-search', 'value' => ($this->input->get('checkout_to') <> '') ? $this->input->get('checkout_to') : '', 'style' => 'width:20px;float:right;']) ?>
                                                    <label class="mdl-textfield__label">Arrival To</label>
                                                </div>
                                            </div>
											
											<div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="followup_status" id="followup_status" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value=""></option>
                                                        <option value="pending">Pending</option>
                                                        <option value="in-progress">In-progress</option>
                                                        <option value="confirm">Confirm</option>
                                                        <option value="cancel-at-arrival">Cancel At Arrival</option>
                                                        <option value="not-materialized">Not materialized</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Status</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="sales" id="sales" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value="">All</option>
                                                        <?php foreach($sales_team AS $list){  ?>
                                                            <option value="<?php echo $list->id; ?>" <?php echo ($this->input->get('sales')<>'' && $this->input->get('sales')==$list->id)?'selected="selected"':''; ?>><?php echo $list->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Kazin Sales Team</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="guests_number" id="guests_number" class="mdl-textfield__input" style="padding: 10px;">
                                                        <option value=""></option>
                                                        <option value="1-10">1-10 pax</option>
                                                        <option value="10-20">10-20 pax</option>
                                                        <option value="20-30">20-30 pax</option>
                                                        <option value="30-40">30-40 pax</option>
                                                        <option value="40-50">40-50 pax</option>
                                                        <option value="50-60">50-60 pax</option>
                                                        <option value="60-70">60-70 pax</option>
                                                        <option value="70-80">70-80 pax</option>
                                                        <option value="80-90">80-90 pax</option>
                                                        <option value="90-100">90-100 pax</option>
                                                        <option value="100-150">100-150 pax</option>
                                                        <option value="150-above">150 (Above) pax</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Number of Guests</label>
                                                </div>
                                            </div>
                                            <?php if($this->input->get('guests_number')<>''){ ?>
                                                    <script>
                                                            const selectElement = document.getElementById('guests_number');
                                                            selectElement.value = '<?php echo $this->input->get('guests_number'); ?>';													
                                                    </script>
                                            <?php } ?>
                                            <div class="col-lg-2">
                                             `   <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'mdl-textfield__input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                                    <label class="mdl-textfield__label">Query Number</label>
                                                </div>`
                                            </div>
											
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'value' => 'Search']); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-scrollable">

                                        <div class="row mb-3 prog-4">
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-black"><?php echo (isset($counts['pending']) ? $counts['pending'] : '0'); ?></span>
                                                Pending
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-perp"><?php echo (isset($counts['in-progress']) ? $counts['in-progress'] : '0'); ?></span>
                                                In-Progress
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-green"><?php echo (isset($counts['confirm']) ? $counts['confirm'] : '0'); ?></span>
                                                Confirm
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-orange"><?php echo (isset($counts['not-materialized']) ? $counts['not-materialized'] : '0'); ?></span>
                                                Not Materialized
                                            </div>
                                            <div class="col-lg-2">
                                                <span
                                                    class="line-num text-white bg-danger"><?php echo (isset($counts['cancel-at-arrival']) ? $counts['cancel-at-arrival'] : '0'); ?></span>
                                                Cancel At Arrival
                                            </div>
                                        </div>

                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No.</th>
                                                    <th class="center">Query Received Date</th>
                                                    <th class="center">Query Entry Date/Time</th>
                                                    <th class="center">Query Number</th>
                                                    <th class="center">Handling File By</th>
                                                    <th class="center">Check-in</th>
                                                    <th class="center">Check-out</th>
                                                    <th class="center">Number Of Guests</th>
                                                    <th class="center">Agent Name</th>
                                                    <th class="center">Company</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($enquiry)) {
                                                    $i = $offset + 1;
                                                    foreach ($enquiry as $enquiries) {
                                                        
                                                        /*$where = ' arrival_room_details.enquiry_id = '.$enquiries->id;
                                                        $room_details = $this->common_model->get_data('arrival_room_details', '', '', '*', $where, '', $count = false);*/
                                                        
                                                        if(substr($enquiries->enquiry_abbr,0,1) == 'G' && $enquiries->split_count != 0){
                                                            $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$enquiries->arrival_id;
                                                            $qry_result = $this->common_model->custom_query($qry);
                                                            
                                                            if(!empty($qry_result)){
                                                               $enquiries->check_in_date = ($qry_result[0]->chk_in <> '')?$qry_result[0]->chk_in:$enquiries->check_in_date;
                                                               $enquiries->check_out_date = ($qry_result[0]->chk_out <> '')?$qry_result[0]->chk_out:$enquiries->check_out_date;
                                                            }
                                                            $split = ' (Split-'.$enquiries->split_number.')';
                                                        }
                                                        
                                                        $where = 'arrivals.enquiry_id= ' . $enquiries->id;
                                                        $check_arrivals = $this->common_model->get_data('arrivals', '', '', 'SUM(arrivals.num_adults+arrivals.num_child) AS arrival_total', $where, ' GROUP BY arrivals.enquiry_id', $count = false);

                                                        $total_persons_accomodated = 0;
                                                        $actual_total = $enquiries->number_persons + (($enquiries->number_child<>'')?$enquiries->number_child:0);
                                                        if(!empty($check_arrivals)){
                                                            /*foreach($room_details AS $list){
                                                                $total_persons_accomodated = $total_persons_accomodated + ($list->number_adults * $list->number_of_rooms + $list->number_child * $list->number_of_rooms);
                                                            }*/
                                                            $total_persons_accomodated = $check_arrivals[0]->arrival_total;
                                                        }else{
                                                            $total_persons_accomodated = $actual_total;
                                                        }
                                                        
                                                        
                                                        $records_cnt++;
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->query_received_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php 
                                                                $d = explode(' ',$enquiries->date);
                                                                if($d[1] == '00:00:00'){
                                                                    echo date('d-M-Y', strtotime($enquiries->date));
                                                                }else {
                                                                    echo date('d-M-Y (h:i a)', strtotime($enquiries->date));
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo $enquiries->enquiry_no;
                                                                        if($enquiries->split_count > 0){
                                                                            echo ' <span class="badge bg-info" style="text-transform:capitalize;"> Split '.($enquiries->split_number).'</span>';
                                                                        }
                                                                ?>
                                                                <?php if(in_array($enquiries->follow_status,['pending','in-progress']) && in_array($this->session->userdata('id'),[14,13])){ 
                                                                        $data_arr = ['qno'=>$enquiries->enquiry_no,
                                                                                    'adult_child'=>($enquiries->number_child+$enquiries->number_persons).' ('.$enquiries->number_persons.'A+'.$enquiries->number_child.'C)',
                                                                                    'checkin'=>$enquiries->check_in_date,'checkout'=>$enquiries->check_out_date,'nights'=>$enquiries->number_of_nights,'child'=>$enquiries->number_child,'adults'=>$enquiries->number_persons];
                                                                    ?>
                                                                    <br><button data-attr='<?=json_encode($data_arr);?>' id="<?=base64_encode($enquiries->id) ?>" class="btn btn-link quotation" title="Make Quotation" style="padding:0 2px;font-size:10px;text-transform:capitalize;">Quotation</button>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="center"><?= $enquiries->staff_name ?></td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->check_in_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= date('d-M-Y', strtotime($enquiries->check_out_date)) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= $enquiries->number_persons . ' (A) , ' . $enquiries->number_child . ' (C)' ?>
                                                            </td>
                                                            <td class="center"><?= $enquiries->contact_person ?></td>
                                                            <td class="center"><?= $enquiries->name ?></td>
                                                            <td class="center"><?= $enquiries->city ?></td>
                                                            <td class="center">
                                                                <?php
                                                                $status_color = ['pending' => '#000000', 'in-progress' => '#8795fb', 'confirm' => '#18ce0f', 'not-materialized' => '#f96332', 'cancel-at-arrival' => 'red'];
                                                                $status = $enquiries->follow_status;
                                                                //if(isset($arr[0]) && $arr[0]==''){ $status = 'pending'; }else{ $status = $arr[0]; }  ?>
                                                                <a class="btn btn-xs"
                                                                    style="background-color: <?= $status_color[$status] ?>;color:#FFF;"
                                                                    href="<?= base_url() . $enquiries->id . '/'; ?>followup"><?= ucfirst(str_replace('-', ' ', $status)) ?></a>

                                                            </td>

                                                            <td style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'flex'; ?>;">
                                                                <?php if ($status == 'confirm') {
                                                                    $split_count = $enquiries->split_count + 1;
                                                                    $type_abbr = substr($enquiries->enquiry_abbr,0,1);
                                                                    if($type_abbr == 'G'){
                                                                            $url = base_url('add_arrival?enq_id=' . base64_encode($enquiries->id).'&split='.base64_encode($split_count));
                                                                    }else{
                                                                            $url = base_url('add_arrival?enq_id=' . base64_encode($enquiries->id));
                                                                    }
                                                                    $title = 'Add To Arrival Chart';
                                                                    $style = '';
                                                                    if ($enquiries->arrival_id <> '') {
                                                                        $url = base_url('edit_arrival?id=' . base64_encode($enquiries->arrival_id));
                                                                        $title = 'Edit Arrival Chart';
                                                                        $style = 'background-color:#ff8b47;';
                                                                    }
                                                                    ?>
                                                                    <a href="<?= $url ?>" class="btn btn-tbl-edit btn-xs"
                                                                        title="<?= $title ?>" style="<?= $style ?>"><i
                                                                            class="fa fa-plane"></i></a>
                                                                            
                                                                    <?php if($actual_total - $total_persons_accomodated > 0 && $type_abbr == 'G' && date('Y-m-d',strtotime($enquiries->date))>='2025-02-04'){ 
                                                                            
                                                                    ?>                                                                        
                                                                        <a href="<?= base_url('add_arrival?enq_id=' . base64_encode($enquiries->id).'&split='.base64_encode($split_count)); ?>" class="badge mt-1 mr-1" title="Split" style="color:#FFF;text-transform: none;"><i class="fa fa-plane"></i> Split</a>                                                                            
                                                                    <?php }} ?>
                                                                    <a href="<?= base_url() . $enquiries->id ?>/edit-enquiry"
                                                                        class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                            class="fa fa-edit"></i></a>
                                                                    <?php if ($this->session->userdata('type') == 1) { ?>
                                                                        <a href="<?= base_url() . $enquiries->id ?>/delete-enquiry"
                                                                            onclick="return confirm('Are you sure you want to delete this Enquiry?');"
                                                                            class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                                class="fa fa-trash-o"></i></a>
                                                                    <?php } ?>
                                                                    
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                    <?php echo $links; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- end js include path -->
    <script>
        url = new URL(window.location.href);
        $(document).ready(function () {
            $("#location").on("change", function () {
                var v = $(this).find(':selected').attr('data-abbr');
                var selected;
                $("#booking_type").empty().parent().removeClass("is-dirty");
                if (v !== "" && v !== undefined) {
                    var opts = v.split(",");
                    $("#booking_type").parent().addClass("is-dirty");
                    $.each(opts, function (i, d) {
                        selected = (url.searchParams.get('booking_type')==d)?'selected="selected"':'';
                        $('#booking_type').append('<option value="' + d + '"'+selected+'>' + d + '</option>');
                    });
                    selected = (url.searchParams.get('booking_type')=="all")?'selected="selected"':'';
                    $('#booking_type').append('<option value="all" '+selected+'>All</option>');
                    get_staff();
                }
            });
            
            if (url.searchParams.has('location')) {
                $("#location").trigger("change");               
            }
            if (url.searchParams.has('followup_status')) {
                $("#followup_status").val(url.searchParams.get('followup_status'));               
            }
            /*$("#from").on("change",function(){
                var el = $(this);
                const selectedDate = new Date(el.val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
                $("#dt-from").val(formattedDate).parent().addClass('is-focused');
            });*/

            $(".dt-search").on("change", function () {
                var idx = $(this).index(".dt-search");
                const selectedDate = new Date($(".dt-search").eq(idx).val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                };
                const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
                $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

                if ($(this).attr("id") === "from" && $("#to").val() === "") {
                    $("#to").attr("min", $(this).val());
                } else if ($(this).attr("id") === "from" && $("#to").val() !== "") {
                    const selectedToDate = new Date($("#to").val());
                    if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                        $("#to").val('').attr("min", $(this).val());
                        $(".dt-search-show").eq($("#to").index(".dt-search")).val('');
                    }
                }
                if ($(this).attr("id") === "to" && $("#from").val() === "") {
                    $("#from").attr("max", $(this).val());
                } else if ($(this).attr("id") === "to" && $("#from").val() !== "") {
                    const selectedFromDate = new Date($("#from").val());
                    if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                        $("#from").val('').attr("max", $(this).val());
                        $(".dt-search-show").eq($("#from").index(".dt-search")).val('');
                    }
                }

            });
            
            $("#frm_1").on("change",".dt-transfer", function () {
                var idx = $(this).index(".dt-transfer");
                const selectedDate = new Date($(".dt-transfer").eq(idx).val());
                //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                const options = {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                };
                const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
                $(".dt-transfer-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
            });
        });

        function get_staff() {
            if ($("#location").val() === "") {
                $("#staff_id").empty();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/enquiry/get_staff",
                data: {
                    'location': $("#location").val()
                },
                dataType: "JSON",
                success: function (data) {
                    $("#staff_id").empty().parent().addClass("is-dirty");
                    var opts = data.details;
                    $.each(opts, function (i, d) {
                        $('#staff_id').append('<option value="' + d['id'] + '">' + d['name'] +
                            '</option>');
                    });
                    $('#staff_id').append('<option value="all">All</option>');
                },
                complete:function(){
                    $('#staff_id').val(url.searchParams.get('staff_id'));
                },
                error: function (jqXHR, textStatus, errorThrown) { }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#company").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {
                            response(data);
                            dt = data;
                            $(".err").html('');;
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#company').val(ui.item.label); // display the selected text
                    $('#company_id').val(ui.item.company_id); // save selected id to input
                }
            }).blur(function(event) {
                if($('#company').val()==''){
                    $('#company_id').val('');
                }               
            });
            var country_flag = false;
            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                    country_flag = false;
                },
                select: function (event, ui) {
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input
                    country_flag = true;
                    return false;
                }
            }).blur(function(event) {
                if(country_flag==false){
                    $("#country").val("");
                }               
            });

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }
            var state_flag = false;
            $("#state").autocomplete({
                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            country_id: $('#country_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                    state_flag = false;
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    if (terms.length > 2) {
                        $("#city").val("").attr('disabled', 'disabled');
                    } else {
                        $("#city").removeAttr('disabled');
                        $('#state_id').val(ui.item.state_id);
                    } state_flag = true;
                    return false;

                    //$('#state').val(ui.item.label); // display the selected text
                    //$('#state_id').val(ui.item.state_id); // save selected id to input
                    //return false;
                }
            }).blur(function(event) {
                if(state_flag==false){
                     $("#state").val("");
                }               
            });
            
            var city_flag = false;
            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: extractLast(request.term),
                            state_id: $('#state_id').val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                    city_flag = false;
                },
                select: function (event, ui) {
                    // Set selection

                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.label);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    city_flag = true;
                    return false;

                    //$('#city').val(ui.item.label); // display the selected text
                    //$('#company_id').val(ui.item.company_id); // save selected id to input
                    //return false;
                }
            }).blur(function(event) {
                if(city_flag==false){
                     $("#city").val("");
                }               
            });
			
        // 11 Dec 2024
        var option_html = '';
        var qdata = '';
        $(".quotation").on("click",function(){
            $("#myModalquotation").modal("show");
            qdata = JSON.parse($(this).attr("data-attr"));
            $("#enquiry_id").val($(this).attr("id"));
            
            var i = 0;
            $.each(qdata,function(index,val){
                $(".qdata").eq(i).text(val);
                i++;
            });				
            option_html = '';
            for(var i=1;i<=qdata.child;i++){ 
                option_html += '<div class="mt-3 bold">Child  Age '+i+' : <select name="child_age[]" class="form-control">';
                option_html += '<option value="">Select..</option>';
                for(var age=1;age<=12;age++){
                    option_html += '<option value="'+age+'">'+age+'</option>';
                }
                option_html += '</select></div>';	
            }
            $(".child-age").html("");
            //$("#hotel-details").css("display","none");
            $("#frm_1")[0].reset();
            var itinerary_html = "";
            var city_details = "";
            var hotel_details = "";
            var restaurants_details = "";
            var guide_details = "";
            var adults_cnt = qdata.adults;
            var child_cnt = qdata.child;
            
            for(var i=0;i<=qdata.nights;i++){ 
                var date = new Date(qdata.checkin);
                date.setDate(date.getDate() + parseInt(i));
                const day_Name = new Date(date).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
                
                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                const formattedDate = date.toLocaleDateString('en-IN',options);
                
                const formattedDate1 = date.toLocaleDateString('en-CA');
                
                itinerary_html += '<div class="mb-1">';
                //itinerary_html += '<span class="bold itinerary_date" style="padding:5px;display:inline-flex;"><input '+((i==0)?"checked":"")+' type="radio" name="rdo-edit" class="rdo" value="'+day_Name+'">&nbsp;&nbsp;Day : '+(parseInt(i)+1)+'</span>';
                itinerary_html += '<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'+(parseInt(i)+1)+'" aria-expanded="true" aria-controls="collapse'+(parseInt(i)+1)+'"><span class="bold itinerary_date" style="padding:5px;display:inline-flex;">Day : '+(parseInt(i)+1)+'</span></a>';
                itinerary_html += '<ul id="collapse'+(parseInt(i)+1)+'" class="panel-collapse collapse in itinerary_ul" style="background-color:inherit;"></ul>';
                itinerary_html += '<input type="text" name="" class="form-control add-itinerary" placeholder="Search & Add Itinerary"></div>';
                
                city_details += '<div class="row mt-2"><div class="col-md-3" style="padding-right:4px;">';
                //city_details += '<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' City ('+day_Name+')</span>';
                city_details += '<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' City </span>';
                city_details += '<input type="text" class="form-control qtn-city" id="" placeholder="City"></div>';
                city_details += '<div class="col-md-3 hide" style="padding-left:0;"><span class="bold">Transfer Mode</span>';
                city_details += '<select class="form-control qtn-transfer"><option></option>';
                city_details += '<option>Road</option>';
                city_details += '<option>Flight</option></select></div>';
                city_details += '<div class="col-md-6 hide" style="padding-left:0;"><span class="bold">Arrival Date</span><span class="bold" style="margin-left:30px;">Arrival Time</span><div class="" style="display:inline-flex;">';
                city_details += '<input type="text" name="" class="mdl-textfield__input qtn-transfer-date-show dt-transfer-show" style="width:90%;height:30px;font-size:13px;" value="'+formattedDate+'" readonly>';
                city_details += '<input type="date" name="" placeholder="" id="" class="mdl-textfield__input qtn-transfer-date dt-transfer" value="'+formattedDate1+'" style="height:30px;width:20px;float:right;">';
                city_details += ' <input type="time" name="" placeholder="" id="" class="mdl-textfield__input" style="padding: 0;margin-left: 5px">';
                city_details += '</div></div></div>';
                
                hotel_details +='<div class="row mt-2"><div class="col-md-12" style="padding-right:4px;">';
                hotel_details +='<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' Hotel ('+day_Name+')</span>';
                hotel_details +='<input type="hidden" name="hdn_hotel_ids[]" class="hdn-hotelids" value="">';
                hotel_details +='<input type="text" class="form-control daywise-hotels" id="" placeholder="Search Hotel" disabled></div></div>';
                
                restaurants_details +='<div class="row mt-2 row-bg r_'+i+'"><div class="col-md-3" style="padding-right:4px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' Restaurant ('+day_Name+')</span>';
                restaurants_details +='<input type="hidden" name="hdn_restaurants_ids_'+i+'[]" class="hdn-restaurants" value="">';
                restaurants_details +='<input type="text" class="form-control daywise-restaurants" data-idx="'+i+'" id="" placeholder="Search Restaurants"></div>';
                restaurants_details +='<div class="col-md-2" style="padding-right:4px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Meals</span>';
                restaurants_details +='<select class="form-control meals" name="restaurants_buffets_'+i+'[]" id="" style="padding:7px;">';
                restaurants_details +='<option value="">Select..</option>';
                restaurants_details +='<option value="Breakfast">Breakfast</option>';
                restaurants_details +='<option value="Lunch">Lunch </option>';
                restaurants_details +='<option value="High-Tea">Sides Or High Tea</option>';
                restaurants_details +='<option value="Early-Dinner">Early-Dinner</option>';
                restaurants_details +='<option value="Dinner">Dinner</option>';
                restaurants_details +='<option value="Gala-Dinner">Gala-Dinner</option>';
                restaurants_details +='<option value="Cocktail-Dinner">Cocktail-Dinner</option>';
                restaurants_details +='<option value="Snacks">Snacks</option>';
                restaurants_details +='<option value="Evening-Snacks">Evening-Snacks</option>';
                restaurants_details +='<option value="Late-Night-Snacks">Late-Night-Snacks</option></select></div>';
                restaurants_details +='<div class="col-md-2" style="padding-right:4px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Type</span><br>';
                restaurants_details +='<select class="form-control meals_type" name="type_'+i+'[]" id="" style="padding:7px;">';
                restaurants_details +='<option value="">Select..</option>';
                restaurants_details +='<option value="buffet">Buffet</option>';
                restaurants_details +='<option value="ala-carte">Ala carte</option>';
                restaurants_details +='</select></div>';
                
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #b1b1b1;border-right: 0;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Adults</span><br>';
                restaurants_details +='<input type="text" class="form-control mb-2" name="num_adults_'+i+'[]" value="'+adults_cnt+'" placeholder="Adults">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #b1b1b1;border-left: 0;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Price</span><br>';
                restaurants_details +='<input type="text" class="form-control" name="price_adults_'+i+'[]" placeholder="Price">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #b1b1b1;border-right: 0;left:5px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Child</span><br>';
                restaurants_details +='<input type="text" class="form-control mb-2" name="num_child_'+i+'[]" value="'+child_cnt+'" placeholder="Child">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #b1b1b1;border-left: 0;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Price</span><br>';
                restaurants_details +='<input type="text" class="form-control" name="price_child_'+i+'[]" placeholder="Price">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding-right:4px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">&nbsp;</span><br>';
                restaurants_details +='<button type="button" style="height:25px;cursor:pointer;" data-id="'+i+'" class="restaurant-add btn-primary">+</button></div>';
                restaurants_details +='</div>';
                
                guide_details +='<div class="row mt-2 row-bg g_'+i+'"><div class="col-md-5" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' Guide ('+day_Name+')</span>';
                guide_details +='<input type="text" class="form-control" name="guides[]" placeholder="Search Guide"></div>';
                guide_details +='<div class="col-md-3" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">Shift Type</span><br>';
                guide_details +='<select class="form-control" name="shift[]" id="" style="padding:7px;">';
                guide_details +='<option value="">Select..</option>';
                guide_details +='<option value="day">Day</option>';
                guide_details +='<option value="night">Night</option>';
                guide_details +='</select></div>';
                guide_details +='<div class="col-md-3" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">Price Type</span><br>';
                guide_details +='<select class="form-control" name="prices_type[]" id="" style="padding:7px;">';
                guide_details +='<option value="">Select..</option>';
                guide_details +='<option value="fixed">Fixed</option>';
                guide_details +='<option value="hourly">Hourly</option>';
                guide_details +='</select></div>';
                guide_details +='<div class="col-md-1" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">&nbsp;</span><br>';
                guide_details +='<button type="button" style="height:25px;cursor:pointer;" data-id="'+i+'" class="guides-add btn-primary">+</button></div>';
                guide_details +='</div>';
            }
            $(".timeline").html(itinerary_html);
            $(".city-details").html(city_details);
            $(".daywise-hotel-details").html(hotel_details);
            $("#show-restaurants").html(restaurants_details);
            $("#show-guides").html(guide_details);
            var html='';
            $.ajax({
                url: "<?php echo site_url('admin/quotation/vehicles_suggesstions'); ?>",
                type: "post",
                data: {'capacity': parseInt(qdata.adult_child.split(" ")[0]),'enquiry_num':qdata.qno },
                dataType: 'JSON',
                //contentType: false,
                //processData: false,
                success: function(data) {
                    if (data.response === "s") {                            
                        if(data.details.transportation.length>0){
                            $.each(data.details.transportation, function(i, val) {
                                html += '<div class="col-md-9" style="padding:8px 16px;">';
                                html += '<span class=""><label for=""><input type="checkbox" class="vehicles" name="chk_vehicle[]" value="'+val.id+'">  '+val.vehicle_name+' (Capacity : '+val.capacity+')</label>';
                                html += '</span></div>';
                                html += '<div class="col-md-3">';
                                html += '<div class="form-floating mb-3">';
                                html += '<input type="number" name="vehicle_quantity[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity" disabled></div></div>';
                            });                                
                        }else { 
                            html = 'No Prices Found';
                        }
                        $("#suggessted_vehicles").html(html);

                        if(data.details.sites_insidecity.length>0){
                            $("#sites_inside").empty().append('<option value=""></option>');
                            $.each(data.details.sites_insidecity, function(i, val) {
                                $("#sites_inside").append('<option data-attr="'+val.days_of_operation+'" value="'+val.id+'">'+val.site_name+'</option>');
                            });
                        }
                        if(data.details.sites_outsidecity.length>0){
                            $("#sites_outside").empty().append('<option value=""></option>');
                            $.each(data.details.sites_outsidecity, function(i, val) {
                                $("#sites_outside").append('<option data-attr="'+val.days_of_operation+'" value="'+val.id+'">'+val.site_name+'</option>');
                            });
                        }
                    } 
                }
            });
            $("input[name='qt_arrival_date']").val(qdata.checkin).trigger("change");
        });
        
        $("#frm_1").on("change",".meals, .meals_type",function(){
            var classes = $(this).attr("class").split(" ");
            var idx = '';
            if(classes.indexOf("meals") !== -1){
                idx = $(this).index(".meals");
            }else if(classes.indexOf("meals_type") !== -1){
                idx = $(this).index(".meals_type");
            }
            
            $(".daywise-restaurants").eq(idx).css("border-color","#ccc");
            if($(".daywise-restaurants").eq(idx).val() === ""){
                alert("Select Restaurant.");
                $(".daywise-restaurants").eq(idx).css("border-color","#ff0000");
            }
        });
        
        
        $("[name=hotel]").on("click",function(){
            //($(this).val()=='yes')?$("#hotel-details").fadeIn(1000):$("#hotel-details").fadeOut(1000);
            ($(this).val()=='yes')?$(".daywise-hotels").removeAttr("disabled"):$(".daywise-hotels").attr("disabled","disabled");
            $(".child-age").html("").html(option_html);
            /*if($(this).val()=='yes'){
                $("#create_quotation").fadeOut(1000);
                $("#btn_hotel").removeClass("hide").fadeIn(1000);
            }else{
                $("#create_quotation").fadeIn(1000);
                $("#btn_hotel").fadeOut(1000);
            }*/
            $(".daywise-hotels").each(function(index, element) {
                $(".daywise-hotels").eq(index).attr("placeholder","Search Hotels In "+$(".qtn-city").eq(index+1).val());
            });
        });
			
        $("#search_transportation").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                        url: "<?= base_url() ?>admin/arrivalchart/transportation_name_suggesstion",
                        type: 'post',
                        dataType: "json",
                        data: {
                                search: request.term,
                                'location': qdata.qno
                        },
                        success: function(data) {
                                response(data);							
                        }
                });
            },
            select: function(event, ui) {
                var html = '';
                html += '<div class="col-md-9" style="padding:8px 16px;">';
                html += '<span class=""><input type="checkbox" class="vehicles" name="chk_vehicle[]" value="'+ui.item.t_id+'"> <label for=""> '+ui.item.label+' (Capacity : '+ui.item.capacity+')</label>';
                html += '</span></div>';
                html += '<div class="col-md-3">';
                html += '<div class="form-floating mb-3">';
                html += '<input type="number" name="vehicle_quantity[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity" disabled></div></div>';
                $("#add_vehicles").append(html);
            }
        });

        $("[name=quotation_hotels]").on("change",function(){                
            var html = '';
            var category_arr = [];
            var hotel_id = $('[name="quotation_hotels"] option:selected').val();
            if(hotel_id == ""){
                $("#hotel-categories").html("").html('<h4 class="text-center">Select hotel to get categories</h4>');
                return false;
            }
        });
			
        $("#btn_hotel").on("click",function(){
            event.preventDefault();
            /*for(var i=0;i<$(".require").length;i++){				
                    var ele = $('.require:eq('+i+')');
                    ele.css("border","");
                    if (ele.is("input") && ele.val()=="") { 
                            ele.css("border","1px solid red").focus();
                            return false;
                    }				
            }*/

            $("#quotation-make-1").css("display","none");
            $("#quotation-make-2").css("display","flex");
            $("#quotation-make-3").css("display","none");
            $("#hotel-categories").html("");
            var html='';
            var i = 0;
            
            $("[name='hdn_hotel_ids[]']").each(function(){
                $.ajax({
                    url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                    type: "post",
                    data: {'hotel_id':$(this).val(),'check_in':qdata.checkin,'check_out':qdata.checkout},
                    dataType: 'JSON',
                    async:false,
                    //contentType: false,
                    //processData: false,
                    success: function(data) {
                        if (data.response === "s") {                            
                            if(data.details.result.length>0){
                                //$(".hotel-name").html(data.details.result[0].name);
                                var mt = (i==0)?"mt-1":"mt-5";
                                html = '<div class="row '+mt+'" style="color: #FFF;background-color: #0088ff;font-size: 14px;font-weight: 600;border-radius: 10px;text-align: center;"><div class="col-md-12">'+data.details.result[0].name+'</div></div>';
                                html += '<div class="row"><div class="offset-9 col-md-2" style="text-align:right;">Rooms</div></div>';
                                $.each(data.details.result, function(i, val) {
                                    var hotel_prices = chk_persons = is_chk = '';                                    
                                    html += '<div class="row mt-2" style="border-bottom:2px solid #000;">';
                                    //html += '<div class="col-md-8"><label class="bold"><input type="checkbox" id="chk_'+val.id+'" value="'+val.id+'_'+val.category_name+'" name="category_ids[]"> '+val.category_name+'</label></div><div class="col-md-1" style="margin:inherit;">Rooms</div><div class="col-md-1"><button type="button" data-id="'+val.id+'" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></div>';
                                    html += '<div class="col-md-12 row prices-div-'+val.id+'" id="prices-div_'+val.id+'"><div class="col-md-5 div-category"><label class="bold"><input type="checkbox" id="chk_'+val.id+'" value="'+val.id+'_'+val.category_name+'" name="category_ids[]"> '+val.category_name+'</label></div><div style="background-color: #eeeff1;" class="col-md-5 mb-1"><div class="row" style="height:10px;">';
                                    hotel_prices = val.details.split(",");
                                    $.each(hotel_prices, function(i, v) {
                                        /*chk_persons = v.split(" ");
                                        is_chk = '';
                                        if(chk_persons[0] == $("#adults_number").val() || chk_persons[0] == $("#child_number").val()){ 
                                            is_chk = 'checked="checked"'; 
                                            category_arr.push("chk_"+val.id);
                                        }*/
                                        html += '<div class="col-md-2 p-1"><input type="checkbox" class="chk-prices" data-id="'+val.id+'" value="'+v+'" name="'+val.id+'_hotel_prices[0][]"> <label>'+v.split(" ")[0]+'</label></div>';
                                    });
                                    html += '</div></div><div class="col-md-2" style="display:flex;"><input type="number" min="1" class="" style="width:65%;" value="1" name="'+val.id+'_room_cnt[0]"><span class="span_btn" style="margin-left:3px;"><button type="button" data-id="'+val.id+'" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></span></div></div><div class="col-md-1"></div></div>';
                                }); 
                                $("#hotel-categories").append(html);								
                            }else { 
                                //$("#hotel-categories").html("").html('<h4 class="text-center">Select hotel to get categories</h4>');
                            }                            

                        } 
                    }
                });
                i++;
            });				
        });
	
        $("#btn_restaurants").on("click",function(){
            $("#quotation-make-1").css("display","none");
            $("#quotation-make-2").css("display","none");
            $("#quotation-make-3").css("display","flex");
            $("#create_quotation").fadeIn(1000);
        });
        
        $("#previous").on("click",function(){
            $("#quotation-make-1").toggle();
            $("#quotation-make-2").toggle();
            $("#create_quotation").fadeOut(1000);
        });
        
        $("#previous-to-hotels").on("click",function(){
            //$("#quotation-make-1").toggle();
            $("#quotation-make-2").toggle();
            $("#quotation-make-3").toggle();
            $("#create_quotation").fadeOut(1000);
        });
        
        $("#frm_1").on("click",".chk-prices",function(){
            var category_id = $(this).attr("data-id");
            var flag = false;
            $("#chk_"+category_id).attr("checked",false);
            $("input[name='"+category_id+"_hotel_prices[0][]']").each(function (index, obj) {
                if(this.checked){ $("#chk_"+category_id).attr("checked","checked"); flag = true; }
            });
            /*if(flag == true) { 
                $("#create_quotation").fadeIn(1000); 
            }else{ $("#create_quotation").fadeOut(1000); }*/
        });
			
        $("#frm_1").on("click",".add",function(){
            event.preventDefault();
            var idx = $(this).index(".add");
            var id = $(".add").eq(idx).attr("data-id");
            var x = Math.floor((Math.random() * 10000) + 1);
            var h = $("#prices-div_" + id).clone().attr('id', 'prices-div_' + x);
            h.find('input:checkbox').prop('checked',false);
            h.find("input:checkbox").prop("name",id+"_hotel_prices["+x+"][]");
            h.find("input[type='number']").prop("name",id+"_room_cnt["+x+"]");
            /*h.append(
                '<div class="col-md-1"><i title="Remove" class="fa fa-remove div_remove" style="color:red;cursor: pointer;margin-top: -15px;position:relative;"></i></div>'
            );*/
            h.find(".span_btn").html('<i title="Remove" class="fa fa-remove div_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            h.find(".div-category").html("");
            //h.insertAfter($("#prices-div_" + id));
            var l = $(".prices-div-"+ id).length;
            h.insertAfter($(".prices-div-"+ id).eq(l-1));
        });
        
        $("#frm_1").on("click",".restaurant-add",function(){
            event.preventDefault();
            var idx = $(this).index(".restaurant-add");
            var id = $(".restaurant-add").eq(idx).attr("data-id");
            var count = $('.r_'+id).length;
            var h = $(this).parent().parent().clone();
            h.find('input:text').val('');
            h.find('select').val('');
            h.removeClass("row-bg").removeClass("mt-2").addClass("row-bg-clone");
            h.find(".restaurant-add").parent().html('<span>&nbsp;</span><br><i title="Remove" class="fa fa-remove restaurant_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            h.insertAfter($(".r_"+id).eq(count-1));
        });
        
        $("#frm_1").on("click",".guides-add",function(){
            event.preventDefault();
            var idx = $(this).index(".guides-add");
            var id = $(".guides-add").eq(idx).attr("data-id");
            var count = $('.g_'+id).length;
            var h = $(this).parent().parent().clone();
            h.removeClass("row-bg").removeClass("mt-2").addClass("row-bg-clone");
            h.find(".guides-add").parent().html('<span>&nbsp;</span><i title="Remove" class="fa fa-remove guides_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            h.insertAfter($(".g_"+id).eq(count-1));
        });
        
        $("#frm_1").on("click", '.div_remove', function(e) {
             $(this).parent().parent().parent().remove();
        });
        
        $("#frm_1").on("click", '.restaurant_remove', function(e) {
             $(this).parent().parent().remove();
        });
        
        $("#frm_1").on("click", '.guides_remove', function(e) {
             $(this).parent().parent().remove();
        });
        
        /*$("#frm_1").on("click",".vehicles",function(){
                alert($(this).checked().index());//[name='chk_vehicle[]']
        });*/
        $("#frm_1").on("change",".vehicles",function(){
                var index = 0;
                var flag = 0;
                $('.vehicles').each(function() {
                        if (this.checked) {
                                if($("[name='guide']:checked").val() == "yes" && ["6","8"].indexOf(this.value) !== -1) {
                                        flag = 1;
                                }
                                $('[name="vehicle_quantity[]"]').eq(index).removeAttr("disabled");
                        }else {
                                $('[name="vehicle_quantity[]"]').eq(index).attr("disabled","disabled");
                        }
                        index++;
                });

                if(flag == 1){
                        $("#div_driver_cum_guide").fadeIn("3000");
                }else { $("#div_driver_cum_guide").fadeOut("3000"); }

        });

        $(".flight-city").autocomplete({
            source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "<?= base_url() ?>admin/quotation/airline_city",
                type: 'POST',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                    dt = data;
                }
                });
            },
            select: function (event, ui) {
                    var idx = $(this).index(".flight-city");
                // Set selection
                $('.flight-city').eq(idx).val(ui.item.label); // display the selected text

                $.ajax({
                    url: "<?php echo site_url('admin/quotation/get_airlines'); ?>",
                    type: "post",
                    data: { 'departure_city': $('.flight-city').eq(idx).val() },
                    dataType: 'JSON',
                    //contentType : false,
                    //processData: false,
                    beforeSend: function () { },
                    success: function (res) {
                        if (res.response === "s") {
                            $(".airline").eq(idx).empty();
                            $(".airline").eq(idx).append("<option data-attr='' value=''>Select Airline..</option>");
                            $.each(res.details.airlines, function (index, item) {
                                $(".airline").eq(idx).append("<option data-attr='"+JSON.stringify(item)+"' value='" + item.id + "'>"+item.name+" ("+item.flight_number+")" +"</option>");
                            });
                        }
                    }
                });

            }
        });

        $(".airline").on("change",function(){
            var idx = $(this).index(".airline");
            $(".airline-show").eq(idx).slideUp("1000").slideDown("2000");
            var d = JSON.parse($(".airline option:selected").eq(idx).attr("data-attr"));
            var city = flight_time = '';
            if(idx == 0){ 
                    city = d.arrival_city;
                    flight_time = d.arrival_time;
                    $("#hdn_arrival_time").val(flight_time);

                    const date1 = new Date();
                    const compare_arrival_time = new Date(date1.getFullYear()+"-"+date1.getMonth()+1+"-"+(date1.getDate() + '').padStart( 2, '0' )+'T08:00:00').getTime();
                    const flight_arrival_time = new Date(date1.getFullYear()+"-"+date1.getMonth()+1+"-"+(date1.getDate() + '').padStart( 2, '0' )+'T'+flight_time+':00').getTime();
                    $("#early_checkin").prop("checked",false).attr("disabled","disabled");
                    if(flight_arrival_time < compare_arrival_time){
                            $("#early_checkin").removeAttr("disabled");
                    }
            }else{ 
                    city = d.arrival_city;
                    flight_time = d.departure_time;
                    $("#hdn_departure_time").val(flight_time);
            }

            $(".info-city").eq(idx).text(city);
            $(".info-time").eq(idx).text(flight_time);
        });

            $("[name='guide']").on('click', function(event) {
                if($(this).val()=="yes"){ 
                        //$("#div_driver_cum_guide").fadeIn("3000"); 
                        $(".vehicles").trigger("change");
                }else { $("#div_driver_cum_guide").fadeOut("3000");  }
            });

            $("#hotel-city").autocomplete({
                    source: function (request, response) {
                            // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/hotel_city",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: request.term,
                            'enquiry_num':qdata.qno
                        },
                        success: function (data) {
                            response(data);
                            dt = data;
                        }
                    });
                },
                select: function (event, ui) {
                $('#hotel-city').val(ui.item.label); // display the selected text
                var type = $("input[name='hotel_category[]']:checked").map(function () {
                    return this.value;
                }).get();

                $.ajax({
                    url: "<?php echo site_url('admin/quotation/get_hotels'); ?>",
                    type: "post",
                    data: { 'hotel_city': $('#hotel-city').val(),'type':type },
                    dataType: 'JSON',
                    //contentType : false,
                    //processData: false,
                    beforeSend: function () { },
                    success: function (res) {
                        if (res.response === "s") {
                            $("#select-hotels").empty();
                            $.each(res.details.hotels, function (index, item) {
                                $("#select-hotels").append("<option value='" + item.id + "'>"+item.name +"</option>");
                            });
                        }
                    }
                });

        }
        });

        $("#add-hotel").on("click",function(){
            event.preventDefault();
            var html = '';
            var d = $('#select-hotels').select2('data');
            var city = $("#hotel-city").val().trim().replace(" ","_").toLowerCase();
            var nights = $("#num_nights").val();
            html = "<div class='form-floating mb-3'><i title='Remove' class='fa fa-close hotels-remove' style='color:red;cursor: pointer;float: right;position:relative;'></i><input type='hidden' name='cities[]' value='"+city+"'><label class='bold'>"+ $("#hotel-city").val()+" ("+$("#num_nights").val() +" Nights) </label><ul>";
            $(d).each(function(i,v){					
                html += "<input type='hidden' name='hdn_hotelcity_ids["+city+"][]' value='"+v.id+"'>";
                html += "<input type='hidden' name='hdn_hotel_nights["+city+"]' value='"+nights+"'>";
                html += "<input type='hidden' name='hdn_hotel_ids[]' value='"+v.id+"'><li>"+v.text+"</li>";

            });
            html += "</ul></div>";
            $("#div-hotels").append(html);
            $('#select-hotels').val("").select2();
            $("#hotel-city").val("");
        });

        $(".add_itinerary").on("click",function(){
            var idx = $(this).index(".add_itinerary");
            var rdo_idx = $(".rdo:checked").index(".rdo");
            if($(".sites option:selected").eq(idx).val()=="") return false;
            $(".itinerary_ul").eq(rdo_idx).append("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+rdo_idx+"][]' value='"+$(".sites option:selected").eq(idx).val()+"'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+rdo_idx+"][]' value='"+$(".sites option:selected").eq(idx).text()+"'>"+$(".sites option:selected").eq(idx).text()+"<i title='Remove' class='fa fa-close edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i><input type='hidden' class='activities-list' name='hdn_activities["+rdo_idx+"][]' value=''></li>");
            $('.sites').eq(idx).val("").select2();
            //$(".sites option:selected").eq(idx).val();
        });
            
        $(document).on('keydown.autocomplete', ".add-itinerary", function() {
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_sites",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            enq_no: $(".qdata").eq(0).text()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    var idx = $(this).index(".add-itinerary");
                    //var act = 'Entry Fee : '+((ui.item.entry_ticket_fee!=0)?ui.item.entry_ticket_fee+' (A) ':'')+ ((ui.item.child_entry_ticket_fee!=0)?ui.item.child_entry_ticket_fee+' (C) ':'')+' | <button type="button" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';
                    var act = 'Entry Fee : '+(ui.item.entry_ticket_fee+' (A) ') + (ui.item.child_entry_ticket_fee+' (C) ')+' | <button type="button" data-site-id="'+ui.item.id+'" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';
                    $(".itinerary_ul").eq(idx).append("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+idx+"][]' value='"+ui.item.id+"'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+idx+"][]' value='"+ui.item.label+"'><div>"+ui.item.label+" <br>("+act+")</div><i title='Remove' class='fa fa-close edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i><input type='hidden' class='activities-list' name='hdn_activities["+idx+"][]' value=''></li>");
                    $(".add-itinerary").eq(idx).val("");
                    return false;
                }
            });
        });
        
        $("#frm_1").on("focus", '.add-itinerary', function(e) {
            var idx = $(this).index(".add-itinerary");            
            if (e.type === 'focusin' && $("#collapse"+(idx+1)).hasClass("show")) {  
                return false;
            }else{
                $(".itinerary_date").eq(idx).trigger("click");
            }
        });
        
        $("#frm-activities").on("click", '.acts', function(e) {
            var idx = $(this).index(".acts");
            if($(".acts").eq(idx).is(":checked")){ 
                $(".acts-adult-cnt").eq(idx).removeAttr("disabled"); 
                $(".acts-child-cnt").eq(idx).removeAttr("disabled"); 
            }
            else{ 
                $(".acts-adult-cnt").eq(idx).attr("disabled","disabled"); 
                $(".acts-child-cnt").eq(idx).attr("disabled","disabled");
            }
        });
        
        $("#frm_1").on("click", '.activities', function(e) {
            var idx = $(this).index(".activities");
            var site_id = $('.activities').eq(idx).attr("data-site-id");
            var html = "";
            var activities_list = $(".activities-list").eq(idx).val().split(",");
            $(".show-msg").html("");
            $.ajax({
                url: "<?php echo site_url('admin/quotation/get_activities'); ?>",
                type: "post",
                data: {
                    'site_id': site_id
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {
                    if (res.response === "s") {
                        $.each(res.details, function(index, item) {
                            var checked = '';
                            var adults_cnt = qdata.adults;
                            var child_cnt = qdata.child;
                            var disabled = 'disabled';
                            if(activities_list.length > 0){
                                $.each(activities_list, function(c,v) {
                                    var activity = v.split("_|_");                                    
                                    if(activity[0] === (item.activity+'__'+item.price+'__'+item.child_price)){
                                        checked = 'checked="checked"';
                                        var n = activity[1].split("__");
                                        adults_cnt = n[0];
                                        child_cnt = n[1];
                                        disabled = '';
                                        return false;
                                    }
                                });
                            }
                            html += '<div class="col-md-4"><input '+checked+' class="acts" type="checkbox" name="chk_activities[]" value="'+item.activity+'__'+item.price+'__'+item.child_price+'"> '+item.activity+' (Price : '+item.price+' (A) | '+item.child_price+' (C))</div>';
                            html += '<div class="col-md-1"><input type="number" class="form-control mt-1 acts-adult-cnt" name="adult_count[]" value="'+adults_cnt+'" '+disabled+'></div>';
                            html += '<div class="col-md-1"><input type="number" class="form-control mt-1 acts-child-cnt" name="child_count[]" value="'+child_cnt+'" '+disabled+'></div>';
                        });
                    }       
                    if(!html){
                        $("#embed-activities").prev("div").hide();
                        html = "<div class='col-md-12 text-center'><h4>No Activity Found!</h4></div>";
                    }else { $("#embed-activities").prev("div").show(); }
                    $("#embed-activities").html(html);
                    $("#hdn-index").val(idx);
                }
            });           
            $("#modalActivities").modal("toggle");
        });
        
        $("#btn-submit").on("click",function(event){
            event.preventDefault();
            var v = [];
            $(".acts").each(function(index,val){
                if($(this).is(":checked")){
                    v.push($(".acts").eq(index).val()+"_|_"+$(".acts-adult-cnt").eq(index).val()+"__"+$(".acts-child-cnt").eq(index).val());                    
                }
            });
            if(v.length > 0){
                $(".activities-list").eq($("#hdn-index").val()).val(v);
                $(".activities").eq($("#hdn-index").val()).text("Edit Activities");
                $(".show-msg").html("").html("<div class='alert alert-success'><i class='fa fa-check'></i> Added Successfully!</div>");
            }
        });
        
        $("#flight-arrival").on("change",function(){
            var flight_time = $(this).val();
            var date1 = new Date();
            var compare_arrival_time = new Date(date1.getFullYear()+"-"+((date1.getMonth()+1)+'').padStart( 2, '0' )+"-"+(date1.getDate() + '').padStart( 2, '0' )+'T08:00:00').getTime();
            var flight_arrival_time = new Date(date1.getFullYear()+"-"+((date1.getMonth()+1)+'').padStart( 2, '0' )+"-"+(date1.getDate() + '').padStart( 2, '0' )+'T'+flight_time+':00').getTime();
            $("#initial_early_checkin").prop("checked",false).attr("disabled","disabled");
            if(flight_arrival_time < compare_arrival_time){
                $("#initial_early_checkin").removeAttr("disabled");
            }
        });
        
        $('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'Select..',
        });
        $("#frm_1").on("click", '.edit-remove', function(e) {
            if (!confirm('Are You Sure?')) {
                    return false;
            }
            e.preventDefault();
            $(this).parent().remove();
        });

        $("#frm_1").on("click", '.hotels-remove', function(e) {
            if (!confirm('Are You Sure?')) {
                    return false;
            }
            e.preventDefault();
            $(this).parent().remove();
        });
        $(document).on('keydown.autocomplete', ".qtn-city", function() {
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_cities",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            enq_no: $(".qdata").eq(0).text()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    var idx = $(this).index(".qtn-city");
                    $(".qtn-city").eq(idx).val(ui.item.label); // display the selected text
                    return false;
                }
            });
        });    
        
        $("#frm_1").on("blur",".qtn-city",function(){
            var idx = $(this).index(".qtn-city");
            if(idx !== 0 && ($(".qtn-city").eq(idx).val() !== $(".qtn-city").eq(idx-1).val())){
                $(".qtn-city").eq(idx).parent().next().next("div").removeClass("hide");
                $(".qtn-city").eq(idx).parent().next("div").removeClass("hide");
            }else if(idx !== 0){
                $(".qtn-city").eq(idx).parent().next().next("div").addClass("hide");
                $(".qtn-city").eq(idx).parent().next("div").addClass("hide");
            }
        });
        
        $(document).on('keydown.autocomplete', ".daywise-hotels", function() {
            var idx = $(this).index(".daywise-hotels");
            var type = $("input[name='hotel_category[]']:checked").map(function () {
                return this.value;
            }).get();
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_hotel_citywise",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            city: $(".qtn-city").eq(idx+1).val(),
                            type: type
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection                    
                    $(".daywise-hotels").eq(idx).val(ui.item.label); // display the selected text
                    $(".hdn-hotelids").eq(idx).val(ui.item.hotel_id); // display the selected text
                    return false;
                }
            });
        });
        
        $(document).on('keydown.autocomplete', ".daywise-restaurants", function() {
            var idx = $(this).index(".daywise-restaurants");
            var actual_idx = $(".daywise-restaurants").eq(idx).attr("data-idx");             
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_restaurants_citywise",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            city: $(".qtn-city").eq(parseInt(actual_idx)+1).val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection                    
                    $(".daywise-restaurants").eq(idx).val(ui.item.label).css("border-color","#ccc"); // display the selected text
                    //$(".hdn-hotelids").eq(idx).val(ui.item.hotel_id); // display the selected text
                    return false;
                }
            });
        });
        
        
    });
    </script>
</body>

</html>
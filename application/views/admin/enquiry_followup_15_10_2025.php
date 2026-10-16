<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/>  
<link rel="stylesheet" href="http://localhost/kazin/assets/admin/plugins/material/material.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<style>
    .dataTable thead th[class*=sorting]:after {
        display:none;
    }
    
    div#config-table_wrapper {
        position: relative;
        right: 19px;
    }

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
            /*margin-left: 30px;*/
            float: left;
            height: 300px;
            width: 600px;
            background: #F5F5F5;
            overflow-y: scroll;
            margin-bottom: 25px;
    }

    .scrollbar::-webkit-scrollbar-track
    {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
            border-radius: 10px;
    }

    .scrollbar::-webkit-scrollbar
    {
            width: 6px;
            background-color: #F5F5F5;
    }

    .scrollbar::-webkit-scrollbar-thumb
    {
            border-radius: 10px;
            background-color: #0ae;
            background-image: -webkit-gradient(linear, 0 0, 0 100%,
                                color-stop(.5, rgba(255, 255, 255, .2)),
                                                color-stop(.5, transparent), to(transparent));
    }
    /* .spinner-border {
    width: 1rem;
    height: 1rem;
    margin-right: 6px;
    vertical-align: middle;
} */


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
    .select2-container--open .select2-dropdown{
        z-index: 9999;
    }
   
</style>
<div class="modal fade" id="myModalquotation" role="dialog" style="top:-20px;">
	<div class="modal-dialog modal-lg" style="max-width:1415px;">
		<div class="modal-content">
			<div class="modal-header" style="padding:0 12px;">
				<h4 class="modal-title">Make Quotation</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                            <label class="qdata"></label><br>
                                            <span style="padding: 2px 5px;font-weight: 500;" class="flight_details"></span>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <span>Check-out Date</span>
                                            <label class="qdata"></label>
                                            <span style="padding: 2px 5px;font-weight: 500;" class="flight_details"></span>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <span>Nights</span> 
                                            <label class="qdata"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-content">
                                <div id="home" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-12">
						                <div id="msgDiv"></div>
                                        <form method="post" id="frm_1" action="<?php echo base_url('quotation_create'); ?>">
                                            <div class="card-body">	
                                                <div class="row mb-2" id="show-quotations"></div>                                             
                                                
                                                <input type="hidden" name="enquiry_id" id="enquiry_id" value=""/>
                                                <input type="hidden" name="number_of_adults" id="number_of_adults" value=""/>
                                                <input type="hidden" name="number_of_child" id="number_of_child" value=""/>
                                                <input type="hidden" name="number_of_nights" id="number_of_nights" value=""/>
                                                <div class="row" id="quotation-make-1">
                                                    <div class="col-lg-6" style="background-color:#f7f7f7 !important;border-right:5px solid #FFF;">
                                                        <h5 style="text-align: center;font-weight: 500;border-bottom: 1px solid;padding: 5px;">Step 1</h5>
                                                        <div class="row mt-3" style="border-bottom: 5px solid #FFF;">
                                                            <div class=" mb-3 col-md-6">
                                                                <span class="bold">ROE</span>
                                                                <input type="text" class="form-control" id="roe" name="roe" placeholder="ROE">
                                                            </div>
                                                            <div class=" col-md-6 p-0">
                                                                <label class="bold">&nbsp;</label>
                                                                <span id="roe_name" class="form-control" style="background-color: #f7f7f7;border: 0;text-transform: capitalize;font-weight: 500;"></span>
                                                                <input type="hidden" name="hdn_roe_name" id="hdn_roe_name" value="">
                                                            </div>
                                                        </div>
                                                        <h4 class="m-b-5 thin">Flight Details</h4>
                                                        <div class="row" style="border-bottom: 5px solid #FFF;">
                                                            <div class="mb-3 col-md-6">
                                                                <span class="bold">City Of Origin </span>
                                                                <input type="text" class="form-control flight-city-initial" name="origin_city" id="origin_city" placeholder="Search City">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <span class="bold">City Of Arrival </sp>
                                                                <input type="text" class="form-control qtn-city flight-city-initial" name="arrival_city" id="flight-city-initial-arrival" placeholder="Search City">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <span class="bold" style="text-transform:capitalize;">Arrival Airline</span>
                                                                <input type="text" class="form-control" id="flight-city-initial-airline" name="arrival_airline" placeholder="Search Airline">
                                                            </div>
                                                            <div class=" mb-3 col-md-6">
                                                                <span class="bold">Arrival Time </span>
                                                                <input type="time" value="" placeholder="" id="initial-airline-departure-time" name="arrival_time" class="form-control" >
                                                            </div>
                                                        </div>

                                                        <div class="row mt-2" style="border-bottom: 5px solid #FFF;">
                                                            <div class="col-md-3" style="padding-right:4px;">
                                                                <span class="bold" style="text-transform:capitalize;">Departure City</span>
                                                                <input type="text" class="form-control departure-city" name="departure_city" id="" placeholder="City">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <span class="bold" style="text-transform:capitalize;">Departing Airline</span>
                                                                <input type="text" class="form-control airline-search" name="departing_airline" id="" placeholder="Search Airline">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="bold" style="text-transform:capitalize;">Departing Time </span>
                                                                <input type="time" name="departing_time" value="" placeholder="" id="" class="form-control airline-search-depart-time">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-2">
                                                            <div class="form-floating col-md-6">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                                    style="display:inline-flex;">
                                                                    <input type="text" name="" class="mdl-textfield__input dt-search-show" style="width:90%;" value="" readonly>
                                                                    <?php echo form_input(['type' => 'date', 'name' => 'qt_arrival_date', 'placeholder' => '', 'id' => '', 'class' => 'form-control dt-search', 'value' => '', 'style' => 'width:20px;float:right;']) ?>
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
                                                        <div class="form-floating city-details mb-3" > </div>
                                                    </div>
                                                    <div class="col-lg-6" style="background-color:#fff5f0 !important;border-right:5px solid #FFF;">
                                                        <h5 style="text-align: center;font-weight: 500;border-bottom: 1px solid;padding: 5px;">Step 2</h5>
                                                            <h4 class="m-b-5 thin">Guide Cum Vehicle Selection</h4>                                                                 

                                                            <span class="bold" style="font-weight:600;">Airport Pick and Drop</span>
                                                            <div>
                                                                    <span>
                                                                            <input type="radio" value="yes" name="airport_pick_drop">
                                                                            Yes
                                                                    </span>
                                                                    <span>
                                                                            <input type="radio" value="no" name="airport_pick_drop" checked>
                                                                            No
                                                                    </span>
                                                            </div>

                                                            <div class="row" style="border-top:3px solid #FFF;">	
                                                                    <div class="col-md-9 mt-2">
                                                                            <span class="bold" style="font-weight:600;">Suggested Vehicles</span>
                                                                    </div>

                                                                    <div class="col-md-3 mt-2">
                                                                            <span class="bold" style="font-weight:600;">Quantity</span>
                                                                    </div>
                                                            </div>

                                                            <div class="row" id="suggessted_vehicles">	

                                                            </div>
                                                            <div class="row" style="border-top:3px solid #FFF;" id="add_vehicles">	
                                                                <div class="col-md-9 mt-2">
                                                                    <span class="bold" style="font-weight:600;">Alternate Vehicles</span>
                                                                </div>

                                                                <div class="col-md-3 mt-2">
                                                                    <span class="bold" style="font-weight:600;">Quantity</span>
                                                                </div>
                                                            </div>

                                                            <div class="row">	
                                                                    <div class="col-md-9">
                                                                            <div class=" mb-3">
                                                                                    <input type="text" class="form-control" id="search_transportation" placeholder="Search Vehicle">
                                                                            </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                            <div class="mb-3">
                                                                                    <input type="number" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity">												
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                            <div class="row" style="border-top:3px solid #FFF;" id="add_lauggage_vehicles">	
                                                                <div class="col-md-12 mt-2">
                                                                    <span class="bold" style="font-weight:600;">Luggage Vehicle Required</span>
                                                                    <div>
                                                                        <span>
                                                                            <input type="radio" value="yes" name="luggage_vehicle">
                                                                            Yes
                                                                        </span>
                                                                        <span>
                                                                            <input type="radio" value="no" name="luggage_vehicle" checked>
                                                                            No
                                                                        </span>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-12" style="display:none;">
                                                                    
                                                                    <div class="col-md-12 mb-2" id="luggage-vehicle" style="border-bottom: 1px solid #dee3e7;">
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <div class=" mb-3">
                                                                                <input type="text" class="form-control" id="search_luggage_vehicle" placeholder="Vehicle Type">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class=" mb-3">
                                                                                <input type="number" class="form-control" id="search_luggage_quantity" min="1" value="1" placeholder="Enter Quantity">												
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="border-top:3px solid #FFF;">	
                                                                <div class="col-md-6 mt-1">
                                                                    <span class="bold" style="font-weight:600;">Guide</span>
                                                                    <div>
                                                                        <span>
                                                                                <input type="radio" value="yes" name="guide" >
                                                                                Yes
                                                                        </span>
                                                                        <span>
                                                                                <input type="radio" value="no" name="guide" checked>
                                                                                No
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">											
                                                                    <div id="div_driver_cum_guide" class="mt-2" style="display: none;">
                                                                        <span>
                                                                            <input type="radio" value="driver_guide" name="driver_cum_guide">
                                                                            Driver Cum Guide
                                                                        </span>
                                                                        <span>
                                                                            <input type="radio" value="guide" name="driver_cum_guide" checked>
                                                                            Only Guide
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <?php $languages = ['kazakh','russian','korean','german','polish','yiddish','ukrainian','turkish','uzbek','uyghur','arabic','english','hindi','azerbaijani',' azeri','azeri turkish','georgian','belarusian']; ?>
                                                                <div class="col-md-12" id="guide-languages" style="display:none;">
                                                                    <div class="row guide-addition">
                                                                        <div class="col-md-8">
                                                                            <div class="form-floating mb-1">
                                                                                <select name="guide_languages_1[]" id="" class="mdl-textfield__input js-example-basic-multiple" multiple=""> 
                                                                                    <option value="all">All</option>
                                                                                    <?php foreach($languages AS $list){ ?>
                                                                                    <option value="<?=$list; ?>" <?php echo (strtolower($list)=='english')?'selected="selected"':''; ?>><?php echo ucfirst($list); ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">											
                                                                            <div class="mb-1" style="display: inline-flex;">
                                                                                <input type="number" class="form-control" id="" value="1" name="guide_quantity[]" placeholder="Qty">
                                                                                <button class="btn btn-info mt-2" id="btn-add-languages" style="height: 21px;margin-left: 5px;cursor: pointer;padding: 0 1px;">+</button>
                                                                            </div>                                                                            
                                                                        </div>
                                                                    </div>                                                                        
                                                                </div>

                                                            </div>

                                                            <div class="row" style="border-top:3px solid #FFF;" id="">
                                                                
                                                                <div class="col-md-8 mt-2">
                                                                    <span class="bold" style="font-weight:600;">Mandatory Services</span>                                                                        
                                                                </div> 
                                                                <div class="col-md-4 mt-2">
                                                                    <span class="bold" style="font-weight:600;">Quantity</span>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row" id="mandatory_services">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-9 mt-2" style="font-weight:600;">
                                                                    <span class="bold">Add Mandatory Services</span>                                                                        
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-11">
                                                                            <div class="mb-3">
                                                                                <input type="text" class="form-control" id="add_mandatory_services" placeholder="Search">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>   
                                                    
                                                    <div class="col-lg-12 mt-4 text-end"> 
                                                        <button type="button" class="btn btn-info float-right" id="btn_hotel">Proceed <i class="fa fa-angle-double-right"></i></button>								
                                                    </div>

                                                </div>

                                                <div class="row" id="quotation-make-2" style="display:none;">                                                    
                                                    <div class="col-lg-12" style="background-color:#fffae0 !important;border-right:5px solid #FFF;">
                                                        <h5 style="text-align: center;font-weight: 500;border-bottom: 1px solid;padding: 5px;">Step 3</h5>
                                                        <h4 class="m-b-5 thin">Select Hotels City Wise</h4>

                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <span class="bold" style="font-weight:600;">With Hotel </span><br>
                                                                <span>
                                                                    <input type="radio" value="yes" name="hotel">
                                                                    Yes
                                                                </span>
                                                                <span>
                                                                    <input type="radio" value="no" name="hotel" checked>
                                                                    No
                                                                </span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div id="hotel-details" style="">                                                            
                                                                    <!-- <div class="form-floating daywise-hotel-details mb-3" style="">
                                                                    </div> -->
                                                                    <div class="row">								
                                                                            <span class=" bold" style="font-weight:600;">
                                                                                Markup (%)
                                                                            </span>
                                                                        <div class="">												
                                                                            <input type="number" class="form-control" id="markup_percentage" min="-50" max="50" value="30" name="markup_percentage" placeholder="Enter Markup">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row markup-split" style="display:none;">
                                                                    <div class="col-md-4">
                                                                        <span class="bold" style="font-weight:600;">Type</span><br>
                                                                        <span>
                                                                            <input type="radio" value="family" name="group_type">
                                                                            Family
                                                                        </span><br>
                                                                        <span>
                                                                            <input type="radio" value="individual" name="group_type">
                                                                            Individual
                                                                        </span>
                                                                        <input type="hidden" name="hdn_group_type" value="family">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <span class="bold" style="font-weight:600;">Split</span><br>
                                                                        <span>
                                                                            <input type="radio" value="yes" name="markup_split">
                                                                            Yes
                                                                        </span>
                                                                        <span>
                                                                            <input type="radio" value="no" name="markup_split" checked>
                                                                            No
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row hotel-markup" style="display:none;">
                                                                            <!-- <div class="offset-10 col-md-1 mt-2 mb-2">												 -->
                                                                                <span class=" bold" style="font-weight:600;">
                                                                                    Hotel Markup (%)
                                                                                </span>
                                                                            <!-- </div> -->
                                                                            <div class="">												
                                                                                <input type="number" class="form-control" id="hotel_markup_percentage" min="-50" max="50" value="15" name="hotel_markup_percentage" placeholder="Enter Hotel Markup">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 hotel-options" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <span class="bold" style="font-weight:600;">Hotel Category</span>                                                                        
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <span class="bold" style="font-weight:600;">Hotel Options Required</span>                                                                        
                                                                    </div>
                                                                    <div class="col-md-4 chk-occupancy hide">
                                                                        <span class="bold" style="font-weight:600;">Occupancy Type</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" value="3 Star" name="hotel_category[]"> 3 Star                                                                      
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select name="num_comparison_hotels[]" id="" class="mb-1" style="height: 20px;padding: inherit;" disabled="">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                        </select>                                                                       
                                                                    </div>
                                                                    <div class="col-md-4 chk-occupancy hide">
                                                                        <div class="form-floating">
                                                                        <input type="checkbox" value="1(A)" name="3_star_room_type[]" disabled>
                                                                                Single
                                                                        <input type="checkbox" value="2(A)" name="3_star_room_type[]" disabled>
                                                                                Twin
                                                                        <input type="checkbox" value="3(A)" name="3_star_room_type[]" disabled>
                                                                                Triple
                                                                    </div>                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" value="4 Star" name="hotel_category[]"> 4 Star                                                                      
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select name="num_comparison_hotels[]" id="" class="mb-1" style="height: 20px;padding: inherit;">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                        </select>                                                                       
                                                                    </div>
                                                                    <div class="col-md-4 chk-occupancy hide">
                                                                        <div class="form-floating">
                                                                        <input type="checkbox" value="1(A)" name="4_star_room_type[]"  >
                                                                                Single
                                                                        <input type="checkbox" value="2(A)" name="4_star_room_type[]" >
                                                                                Twin
                                                                        <input type="checkbox" value="3(A)" name="4_star_room_type[]">
                                                                                Triple
                                                                    </div>                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" value="5 Star" name="hotel_category[]"> 5 Star                                                                      
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select name="num_comparison_hotels[]" id="" class="mb-1" style="height: 20px;padding: inherit;" disabled="">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                        </select>                                                                       
                                                                    </div>
                                                                    <div class="col-md-4 chk-occupancy hide">
                                                                        <div class="form-floating">
                                                                        <input type="checkbox" value="1(A)" name="5_star_room_type[]" disabled>
                                                                                Single
                                                                        <input type="checkbox" value="2(A)" name="5_star_room_type[]" disabled>
                                                                                Twin
                                                                        <input type="checkbox" value="3(A)" name="5_star_room_type[]" disabled>
                                                                                Triple
                                                                    </div>                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" value="5 Star Luxury" name="hotel_category[]"> 5 Star Luxury                                                                      
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select name="num_comparison_hotels[]" id="" class="mb-1" style="height: 20px;padding: inherit;" disabled="">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                        </select>                                                                       
                                                                    </div>
                                                                    <div class="col-md-4 chk-occupancy hide">
                                                                        <div class="form-floating">
                                                                            <input type="checkbox" value="1(A)" name="5_star_luxury_room_type[]" disabled>
                                                                                    Single
                                                                            <input type="checkbox" value="2(A)" name="5_star_luxury_room_type[]" disabled>
                                                                                    Twin
                                                                            <input type="checkbox" value="3(A)" name="5_star_luxury_room_type[]" disabled>
                                                                                    Triple
                                                                        </div>                                                                      
                                                                    </div>                                                                    
                                                                </div>
                                                                <div class="col-md-12 text-center mt-2 mb-2">
                                                                    <button type="button" style="cursor: no-drop;float:left;" id="btn-add-hotels" class="btn-info btn-sm" disabled="">Add Hotels</button>
                                                                    <!-- <button type="button" id="btn-add-more-hotel" class="btn-info btn-sm" style="display:none;cursor: no-drop;float:left;">Add New Hotel</button> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div id="hotel-details mt-2" style="">                                                            
                                                            <div class="form-floating daywise-hotel-details mb-3" style="">
                                                            </div>
                                                            
                                                           <!-- <div class="row" style="border-top:3px solid #FFF;">
                                                                <div class="offset-10 col-md-1 mt-2 mb-2">												
                                                                    <span class=" bold" style="font-weight:600;">
                                                                        Markup (%)
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1 mt-2 mb-2">												
                                                                    <input type="number" class="form-control" id="markup_percentage" min="-50" max="50" value="30" name="markup_percentage" placeholder="Enter Markup">
                                                                </div>
                                                            </div>
                                                            <div class="row hotel-markup" style="border-top:3px solid #FFF;display:none;">
                                                                <div class="offset-10 col-md-1 mt-2 mb-2">												
                                                                    <span class=" bold" style="font-weight:600;">
                                                                        Hotel Markup (%)
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-1 mt-2 mb-2">												
                                                                    <input type="number" class="form-control" id="hotel_markup_percentage" min="-50" max="50" value="15" name="hotel_markup_percentage" placeholder="Enter Hotel Markup">
                                                                </div>
                                                            </div> -->
                                                            
                                                        </div> 
                                                        <div class="row">
                                                            <div class="col-lg-6 mt-2 mb-2">
                                                                <button type="button" class="btn btn-info float-left" id="previous"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                            </div>
                                                            <div class="col-lg-6 mt-2 mb-2 text-end">
                                                                <button type="button" class="btn btn-info float-right" id="btn_restaurants">Proceed <i class="fa fa-angle-double-right"></i></button>										
                                                                <button type="button" class="btn btn-info float-right" id="btn_restaurants_new" style="display:none;">Proceed <i class="fa fa-angle-double-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                   
                                                </div>
                                                <div class="row" id="quotation-make-3" style="display:none;">                                                    
                                                    <div class="col-md-12">
                                                        <h5 style="text-align: center;font-weight: 500;border-bottom: 1px solid;padding: 5px;">Step 4</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h4 class="bold" style="">Family Details 
                                                            <span style="float: right;font-size:15px">
                                                                <label>Family : </label>
                                                                <button type="button" class="btn-sm btn-success mt-1 add-family" style="cursor: pointer;"><i class="fa fa-plus"></i> Add</button>
                                                                <button type="button" class="btn-sm btn-danger mt-1 remove-family" style="cursor: pointer;"><i class="fa fa-minus"></i> Remove</button>
                                                            </span>
                                                        </h4>
                                                    </div>
                                                    
                                                    <div class="col-md-12 mt-2 family " >
                                                        <div class="row mb-2"  style="background-color: #f4f4f5;" id="familydiv">
                                                            <div class="col-md-2">
                                                                <div class="form-floating mt-2">
                                                                    <span class="bold" style="color:#4d88bb;">Family 1 Adults</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="number" name="family_adults[]" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                 <div class="form-floating mt-2">
                                                                    <span class="bold" style="color:#4d88bb;">Family 1 Child</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="number" name="family_child[]" class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span>Room Details</span>
                                                                <button type="button" class="btn-success mt-1 add-rooms-details" title="Add" style="cursor: pointer;"><i class="fa fa-plus"></i></button>
                                                                <button type="button" class="btn-danger mt-1 remove-rooms-details" title="Remove" style="cursor: pointer;"><i class="fa fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div id="families_container">
                                                        </div>                              
                                                    </div>  
                                                    
                                                    <div class="row col-md-12">
                                                        <div class="col-lg-6 mt-2 mb-2">
                                                            <button type="button" class="btn btn-info float-left" id="previous-to-family"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                        </div>
                                                        <div class="col-lg-6 mt-2 mb-2 text-end">
                                                            <button type="button" class="btn btn-info float-right" id="btn_proceed_to_hotels">Proceed <i class="fa fa-angle-double-right"></i></button>										
                                                            <button type="button" class="btn btn-info float-right" id="btn_proceed_to_hotels_new" style="display:none;">Proceed <i class="fa fa-angle-double-right"></i></button>										
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="quotation-make-4" style="display:none;">                                                    
                                                    <div class="col-md-12">
                                                        <h5 style="text-align: center;font-weight: 500;border-bottom: 1px solid;padding: 5px;">Step 5</h5>
                                                        <div class="col-md-12 text-center">
                                                            <h4 class="bold">Hotel Details</h4>
                                                        </div>
                                                        <div class="col-md-12 text-left">
                                                            <div class="row" id="hotel-categories">
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">3 Star</label>                                                                    
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">4 Star</span>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">5 Star</span>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">5 Star Luxury</span>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>                 
                                                    
                                                    <div class="row col-md-12">
                                                        <div class="col-lg-6 mt-2 mb-2">
                                                            <button type="button" class="btn btn-info float-left" id="previous-to-hotels"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                        </div>
                                                        <div class="col-lg-6 mt-2 mb-2 text-end">
                                                            <button type="button" class="btn btn-info float-right" id="btn_proceed_to_itinerary">Proceed <i class="fa fa-angle-double-right"></i></button>										
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="quotation-make-5" style="display:none;">                                                    
                                                    <div class="col-md-8 mt-2" style="border: 1px solid #ebebeb; border-radius: 15px;">
                                                        <h4 class="bold text-center">Itinerary Details <button type="button" style="border:none; background-color:#fff;" class="itinerary_data"><i class="fas fa-sync-alt"></i></button></h4>                                                        
                                                        <div class="row mt-2">
                                                                <div class="col-md-12">
                                                                <div class="timeline">  
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12 row">
                                                        <div class="col-lg-6 mt-2 mb-2">
                                                            <button type="button" class="btn btn-info float-left" move-to="" id="previous-to-hotels-details"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                        </div>

                                                        <div class="col-lg-6 mt-2 mb-2 text-end">
                                                            <button type="submit" class="btn btn-info float-right" id="create_quotation" formtarget="_blank">Create Quotation</button>										
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!--- Individual --->
                                                
                                                <div class="row" id="quotation-make-individual-3" style="display:none;">                                                    
                                                    <div class="col-md-12">
                                                        <h5 style="text-align: center;font-weight: 500;border-bottom: 1px solid;padding: 5px;">Step 4</h5>
                                                        <div class="col-md-12 text-center">
                                                            <h4 class="bold">Hotel Details</h4>
                                                        </div>
                                                        <div class="col-md-12 text-left">
                                                            <div class="row" id="hotel-categories-individual">
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">3 Star</span>                                                                    
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">4 Star</span>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">5 Star</span>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <span class="bold">5 Star Luxury</span>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>                 
                                                    
                                                    <div class="row col-md-12">
                                                        <div class="col-lg-6 mt-2 mb-2">
                                                            <button type="button" class="btn btn-info float-left" id="individual-previous-to-hotels"> <i class="fa fa-angle-double-left"></i> Previous </button>
                                                        </div>
                                                        <div class="col-lg-6 mt-2 mb-2 text-end">
                                                            <button type="button" class="btn btn-info float-right" id="individual_btn_proceed_to_itinerary">Proceed <i class="fa fa-angle-double-right"></i></button>										
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
                    <button type="button" class="btn-close pricing-modal" data-bs-dismiss="modal" id="close-button"></button>
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

<div class="modal fade" id="comboModal" tabindex="-1" aria-labelledby="comboModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-3">
      <div class="modal-header">
        <h5 class="modal-title" id="comboModalLabel">Merge file</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="comboForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="input1" class="form-label">First File</label>
            <input type="text" class="mdl-textfield__input" id="input1" name="input1" required>
          </div>
          <div class="mb-3">
            <label for="input2" class="form-label">Second File</label>
            <input type="text" class="mdl-textfield__input" id="input2" name="input2" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Make Combo</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="agentModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#ef233c;">
        <h5 class="modal-title" style="color:#fff;" id="agentModalLabel">Agent Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#ef233c; border:none;">
         <span style="font-size:24px;">&times;</span>
        </button>      
    </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-7 col-7 align-self-center" style="display: flex;justify-content: space-between; margin-bottom: 5px;">
                <h4 class="text-themecolor mt-2">Queryboard</h4>
            </div>
            
            <div class="col-md-5 col-5 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                        <li class="breadcrumb-item active">Queryboard</li>
                    </ol>
                </div>
            </div>
        </div>
        <div id="combo_success" style="display:none;" class="alert alert-success"></div>

        <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsives m-t-20">
                            <div class="row text-center mb-3">
                                <?php
                                $statuses = [
                                    'pending' => ['label' => 'Pending', 'color' => '#0f4aff'],
                                    'in-progress' => ['label' => 'In-Progress', 'color' => 'orange'],
                                    'confirm' => ['label' => 'Confirm', 'color' => '#02d530'],
                                    'not-materialized' => ['label' => 'Dropped', 'color' => '#bdbdbd'],
                                    'cancel-at-arrival' => ['label' => 'Cancel At Arrival', 'color' => '#bdbdbd'],
                                ];
                                ?>
                                <?php foreach ($statuses as $key => $info): ?>
                                    <div class="col-lg-2 col-md-4 col-6 mb-2">
                                        <div class="card shadow-sm" style="border-top: 4px solid <?= $info['color'] ?>;">
                                            <div class="card-body p-2">
                                                <h5 class="text-dark mb-1"><?= isset($counts[$key]) ? $counts[$key] : '0' ?></h5>
                                                <small class="text-muted"><?= $info['label'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                 <div class="col-lg-2" style="display:<?php echo ($this->session->userdata('type') == 5) ? 'none' : 'flex'; ?>">
                                    <a href="<?= base_url(); ?>enquiry" class="btn bg-success d-lg-block text-white" style="height:30px; width:70px;">
                                        <!-- <i class="fa fa-plus-circle"></i> -->
                                        B2B</a>
                                    <a href="<?= base_url(); ?>enquiry_b2c" class="btn bg-success d-lg-block m-l-15 text-white" style="height:30px; width:70px;">
                                        <!-- <i class="fa fa-plus-circle"></i> -->
                                            B2C</a>
                                </div>
                            </div>

                            <form method="get">
                                <div class="content row" style="padding:8px 0px;">
                                    <div class="col-md-2">
                                        <label for="location">Location</label>
                                        <div class="mySelect">
                                            <select name="location" id="location" class="location select">
                                            <option value="" selected disabled hidden></option>
                                            <?php
                                                    $user_id = $this->session->userdata('id');
                                                    // Run query directly
                                                    $this->db->select('*');
                                                    $this->db->from('admin');
                                                    $this->db->where('id', $user_id);
                                                    $query = $this->db->get();

                                                    // Fetch single row as array
                                                    $user = $query->row_array();

                                                    $locations = $locations;
                                                    $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia', 'armenia','uzbekistan'];
                                                    // $location = $this->session->userdata('locations');

                                                    if ($this->session->userdata('type') == 2) {
                                                        $user_locations = explode(',', $user['location']);
                                                        asort($locations);

                                                        $has_all_access = in_array('all', $user_locations) ||
                                                                        empty(array_diff($main_keys, $user_locations)); // user has all 5 countries

                                                        // Show "All" option only if allowed
                                                        if ($has_all_access) {
                                                            $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                            echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
                                                        }

                                                        foreach ($locations as $key => $val) {
                                                            if ($key === 'all') continue;

                                                            if ($has_all_access || in_array($key, $user_locations)) {
                                                                $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                            }
                                                        }
                                                    } else {
                                                        // Admin or type ≠ 2 users
                                                        asort($locations);

                                                        // Always show "All" for admins
                                                        $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                        echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";

                                                        foreach ($locations as $key => $val) {
                                                            if ($key === 'all') continue;
                                                            $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                            echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                        }
                                                    }
                                                    ?>

                                            </select>
                                        </div>
                                    </div>
                                    
                                   

                                    <div class="col-md-2">
                                        <label for="booking_type">Booking Type</label>
                                        <div class="mySelect">
                                            <select name="booking_type" id="booking_type" class="booking_type select">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="staff_id">Staff</label>
                                                            <div class="mySelect">
                                                                <select name="staff_id" id="staff_id" class="select staff_id">
                                                                    <option value=""></option>
                                                                </select> 
                                    
                                    </div>
                                    </div>

                                    
                                    <div class="col-md-2">
                                        <label for="from">From</label>
                                        <div class="input-container" style="margin:0! important">
                                            <input type="text" name=""
                                                    class="input inputdate mdl-textfield__input dt-search-show" style="background-color:#fff; color:black; width:100%;"
                                                    value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>"
                                                    readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'from', 'placeholder' => '', 'id' => 'from', 'class' => 'dt-search', 'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 'style' => 'width:17px;float:right;']) ?>
                                    
                                            <!-- <span>From</span> -->
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="">To</label>
                                        <div class="input-container" style="margin:0! important">
                                            <input type="text" name="" class="input inputdate mdl-textfield__input dt-search-show" style="background-color:#fff; color:black; width:100%;"
                                                                value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>"
                                                                readonly>
                                                            <?php echo form_input(['type' => 'date', 'name' => 'to', 'id' => 'to', 'placeholder' => '', 'class' => 'dt-search', 'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 'style' => 'width:17px;float:right;']) ?>
                                        
                                            <!-- <span>TO</span> -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                            <label for="">Status</label>
                                            <div class="mySelect">
                                                <!--<div class="mySelect">-->
                                                    <select name="followup_status" id="followup_status"
                                                        class="followup_status select input">
                                                        <option value=""></option>
                                                        <option value="pending">Pending</option>
                                                        <option value="in-progress">In-progress</option>
                                                        <option value="confirm">Confirm</option>
                                                        <option value="cancel-at-arrival">Cancel At Arrival</option>
                                                        <option value="not-materialized">Dropped</option>
                                                    </select> 
                                                     <!--<span>Status</span> -->
                                                 <!--</div>-->
                                            </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label for="">Company</label>
                                        <div class="myselect">                            
                                            <?php echo form_input(['name' => 'company', 'id' => 'company', 'class' => 'company company input mdl-textfield__input', 'value' => urldecode($this->input->get('company')), 'style' => 'background-color:#fff; color:black;']); ?>
                                            <input type="hidden" name="company_id" id="company_id" class="company_id"
                                            value="<?= ($this->input->get('company_id') <> '' && $this->input->get('company') <> '') ? $this->input->get('company_id') : ''; ?>">
                                        
                                            <!-- <span>Company</span> -->
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label for="">Email Exchange</label>
                                        <div class="mySelect">                            
                                            <?php echo form_input(['name' => 'email_exchange', 'id' => 'email_exchange', 'class' => 'input', 'value' => ($this->input->get('email_exchange')<>'')?$this->input->get('email_exchange'):'']) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label for="">Query Number</label>
                                        <div class="mySelect">                            
                                            <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <!--<div class="col-md-2">-->
                                        <!--<label for="">Kazin Sales Team</label>-->
                                        <!--<div class="mySelect">-->
                                            <!--<select name="sales" id="sales" class="select sales"-->
                                                <!--style="padding: 10px;">-->
                                                <!--<option value="">All</option>-->
                                                <?php //foreach ($sales_team as $list) { ?>
                                                    <!--<option value="<?php //echo $list->id; ?>" <?php //echo ($this->input->get('sales') <> '' && $this->input->get('sales') == $list->id) ? 'selected="selected"' : ''; ?>>-->
                                                        <?php //echo $list->name; ?>
                                                    <!--</option>-->
                                                <?php //} ?>
                                             <!--</select> -->
                                             <!--<span>Kazin Sales Team</span> -->
                                         <!--</div>-->
                                    <!--</div>-->
                                    
                                

                                    <div class="col-md-4 mt-3">
                                        <button type="submit" class="btn btn-info mt-3">Search</button>
                                        <span class="btn btn-info mt-3" id="toggleBtn" style="height: 35px; width:150px;">Advance Search</span>
                                        <?php if (($this->session->userdata('type') == 1) || ($this->session->userdata('email') == 'sales@kazindmc.com')) { ?>
                                        <a href="<?= base_url('enquiry-excel-download?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-info text-white mt-3" style="height: 35px;"><i class="fa fa-download"></i>
                                            </a>
                                            <?php } ?>
                                            <button type="button" class="btn btn-primary mt-3 ms-1" style="" data-bs-toggle="modal" data-bs-target="#comboModal">
                                                <i class="fas fa-code-branch"></i>
                                            </button> 
                                    </div>
                                </div>
                            </form>

                            <div style="display: flex;justify-content: space-between;">
                                <div class="filter-dropdown">
                                    <h3 class="text-primary" style="padding:0 !important; margin:0">Advance Search</h3>
                                    <form method="get" id="form">
                                        <ul id="accordion" class="accordion ps-0">
                                             <li> 
                                                 <div Class="acco"> 
                                                     <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Location
                                                    </div>
                                                    <div class="content">
                                                        <label for="location">Location</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">  
                                                                <select name="location" id="location" class="select location">
                                                                <option value="" selected disabled hidden></option>
                                                                <?php
                                                                    $user_id = $this->session->userdata('id');
                                                                    // Run query directly
                                                                    $this->db->select('*');
                                                                    $this->db->from('admin');
                                                                    $this->db->where('id', $user_id);
                                                                    $query = $this->db->get();

                                                                    // Fetch single row as array
                                                                    $user = $query->row_array();

                                                                    $locations = $locations;

                                                                    $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia','armenia', 'uzbekistan'];
                                                                    // $location = $this->session->userdata('locations');

                                                                    if ($this->session->userdata('type') == 2) {
                                                                        $user_locations = explode(',', $user['location']);
                                                                        asort($locations);

                                                                        $has_all_access = in_array('all', $user_locations) ||
                                                                                        empty(array_diff($main_keys, $user_locations)); // user has all 5 countries

                                                                        // Show "All" option only if allowed
                                                                        if ($has_all_access) {
                                                                            $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                                            echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
                                                                        }

                                                                        foreach ($locations as $key => $val) {
                                                                            if ($key === 'all') continue;

                                                                            if ($has_all_access || in_array($key, $user_locations)) {
                                                                                $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                                echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        // Admin or type ≠ 2 users
                                                                        asort($locations);

                                                                        // Always show "All" for admins
                                                                        $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                                        echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";

                                                                        foreach ($locations as $key => $val) {
                                                                            if ($key === 'all') continue;
                                                                            $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                            echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <label for="booking_type">Booking Type</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="booking_type" id="booking_type" class="select booking_type" >
                                                                    <option value=""></option>
                                                                </select>
                                                            
                                                                 <span>Booking Type</span> 
                                                             </div>
                                                        </div>
                                                        <label for="staff_id">Staff</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="staff_id" id="staff_id" class="select staff_id">
                                                                    <option value=""></option>
                                                                </select>
                                                        
                                                                 <span>Staff</span> 
                                                             </div>
                                                        </div>
                                                       
                                                        <label for="">Kazin Sales Team</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="sales" id="sales" class="select sales"
                                                                    style="padding: 10px;">
                                                                    <option value="">All</option>
                                                                    <?php foreach ($sales_team as $list) { ?>
                                                                        <option value="<?php echo $list->id; ?>" <?php echo ($this->input->get('sales') <> '' && $this->input->get('sales') == $list->id) ? 'selected="selected"' : ''; ?>>
                                                                            <?php echo $list->name; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                 </select> 
                                                                 <span>Kazin Sales Team</span> 
                                                             </div>   
                                                         </div>
                                                        
                                                     </div> 
                                                 </div>
                                            </li>
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Region
                                                </div>
                                                <div class="content">
                                                    <!--<label for="from">From</label>-->
                                                        <label class="mdl-textfield__label">Select Country</label>
                                                        <div class="input-container">
                                                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'country input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                                        </div>
                                                    <input type="hidden" class="country_id" name="country_id" id="country_id" value="">
                                                
                                                    <label class="mdl-textfield__label">State</label>
                                                    <div class="input-container">
                                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                                    </div>

                                                    <label class="mdl-textfield__label">City</label>
                                                    <div class="input-container">
                                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                                    </div>

                                                </div>
                                            </li>

                                            <!-- Search By Arrival Date -->
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Arrival Date
                                                </div>
                                                <div class="content">
                                                    <label for="">Check In</label>
                                                    <div class="input-container">
                                                        <input type="text" 
                                                            class="input inputdate mdl-textfield__input dt-search-show" 
                                                            style="width:100%;" 
                                                            data-group="arrival" 
                                                            value="<?php echo ($this->input->get('checkin_from') <> '') ? date('d-M-Y', strtotime($this->input->get('checkin_from'))) : ''; ?>" 
                                                            readonly>
                                                        <?php echo form_input([
                                                            'type' => 'date', 
                                                            'name' => 'checkin_from', 
                                                            'placeholder' => '', 
                                                            'id' => 'checkin_from', 
                                                            'class' => 'dt-search date_from', 
                                                            'data-group' => 'arrival',
                                                            'value' => ($this->input->get('checkin_from') <> '') ? $this->input->get('checkin_from') : '', 
                                                            'style' => 'width:17px;float:right;'
                                                        ]) ?>
                                                    </div>

                                                    <label for="">Checkout</label>
                                                    <div class="input-container">
                                                        <input type="text" 
                                                            class="input inputdate mdl-textfield__input dt-search-show" 
                                                            style="width:100%;" 
                                                            data-group="arrival" 
                                                            value="<?php echo ($this->input->get('checkout_to') <> '') ? date('d-M-Y', strtotime($this->input->get('checkout_to'))) : ''; ?>" 
                                                            readonly>
                                                        <?php echo form_input([
                                                            'type' => 'date', 
                                                            'name' => 'checkout_to', 
                                                            'id' => 'checkout_to', 
                                                            'placeholder' => '', 
                                                            'class' => 'dt-search date_to', 
                                                            'data-group' => 'arrival',
                                                            'value' => ($this->input->get('checkout_to') <> '') ? $this->input->get('checkout_to') : '', 
                                                            'style' => 'width:17px;float:right;'
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- Search By Query Date -->
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Query Date
                                                </div>
                                                <div class="content">
                                                    <label for="from">From</label>
                                                    <div class="input-container" style="margin:0 !important;">
                                                        <input type="text" 
                                                            class="input inputdate mdl-textfield__input dt-search-show bg-white" 
                                                            style="width:100%;" 
                                                            data-group="query"
                                                            value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>" 
                                                            readonly>
                                                        <?php echo form_input([
                                                            'type' => 'date', 
                                                            'name' => 'from', 
                                                            'placeholder' => '', 
                                                            'id' => 'from', 
                                                            'class' => 'dt-search date_from', 
                                                            'data-group' => 'query',
                                                            'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 
                                                            'style' => 'width:17px;float:right;'
                                                        ]) ?>
                                                    </div>

                                                    <label for="">To</label>
                                                    <div class="input-container" style="margin:0 !important;">
                                                        <input type="text" 
                                                            class="input inputdate mdl-textfield__input dt-search-show bg-white" 
                                                            style="width:100%;" 
                                                            data-group="query"
                                                            value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>" 
                                                            readonly>
                                                        <?php echo form_input([
                                                            'type' => 'date', 
                                                            'name' => 'to', 
                                                            'id' => 'to', 
                                                            'placeholder' => '', 
                                                            'class' => 'dt-search date_to', 
                                                            'data-group' => 'query',
                                                            'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 
                                                            'style' => 'width:17px;float:right;'
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Company
                                                </div>
                                                <div class="content">
                                                <label for="">Company</label>
                                                    <div class="input-container">                            
                                                        <?php echo form_input(['name' => 'company', 'id' => 'company', 'class' => 'company input mdl-textfield__input', 'value' => urldecode($this->input->get('company'))]); ?>
                                                        <input type="hidden" name="company_id" id="company_id" class="company_id"
                                                        value="<?= ($this->input->get('company_id') <> '' && $this->input->get('company') <> '') ? $this->input->get('company_id') : ''; ?>">
                                                    
                                                        <!-- <span>Company</span> -->
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Number of Guests
                                                </div>
                                                <div class="content">
                                                    <label class="">Number of Guests</label>
                                                    <div class="input-container">
                                                        <select name="guests_number" id="guests_number" class="select mdl-textfield__input">
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
                                                    </div>
                                                </div>
                                            </li>
                                            

                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Query Number
                                                </div>
                                                <div class="content">
                                                    <label for="">Query Number</label>
                                                    <div class="input-container">
                                                        <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="link">
                                                    <i class="fa fa-chevron-down"></i>
                                                    Search By Status
                                                </div>
                                                <div class="content">
                                                    <label for="">Status</label>
                                                    <div class="input-container">
                                                        <div class="mySelect">
                                                            <select name="followup_status" id="followup_status"
                                                                class="followup_status select mdl-textfield__input">
                                                                <option value=""></option>
                                                                <option value="pending">Pending</option>
                                                                <option value="in-progress">In-progress</option>
                                                                <option value="confirm">Confirm</option>
                                                                <option value="cancel-at-arrival">Cancel At Arrival</option>
                                                                <option value="not-materialized">Dropped</option>
                                                            </select> 
                                                             <span>Status</span> 
                                                         </div>
                                                    </div>
                                                </div>
                                            </li> 
                                        </ul>

                                        <div class="filter-buttons">
                                            <button id="reset-btn" style="background-color:#4f4e4e;">Reset</button>
                                            <button style="" class="bg-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div style="">
                                <table id="config-table" class="table table-hover table-striped table-checkable border order-column full-width"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="center">Sr.No.<br> <br> <br></th>
                                            <th class="center">Query Received <br>Date</th>
                                            <th class="center">Query Entry <br>Date/Time</th>
                                            <th class="center">Company<br> <br> <br></th>
                                            <th class="center">Query No.<br> <br></th>
                                            <th class="center">Guests<br> <br> <br></th>
                                            
                                            <th class="center">Check-in<br> <br></th>
                                            <th class="center">Check-out<br> <br></th>
                                            <th class="center">Handling File By<br> <br></th>
                                            <!-- <th class="center">City<br> <br> <br></th> -->
                                            <th class="center">Agent Name</th>
                                            <th class="center">Status</th>
                                            <!--<th class="center">Mail Exchange</th>-->
                                            <th class="center">Action</th>
                                            <th class="center"></th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php
                                             $records_cnt = 0;
                                            //  print_r($enquiry);
                                            if (!empty($enquiry)) {
                                                $i = $offset + 1;
                                                foreach ($enquiry as $enquiries) {
                                                 $follow_status = $enquiries->follow_status;
                                                    $background = 'color: rgb(8, 8, 8)'; // default

                                                    switch ($follow_status) {
                                                        case 'confirm':
                                                            $background = 'color: #02d530;';
                                                            break;
                                                        case 'in-progress':
                                                            $background = 'color: #orange';
                                                            break;
                                                        case 'pending':
                                                            $background = 'color: #0f4aff';
                                                            break;
                                                        case 'not-materialized':
                                                            $background = 'color: #f96332';
                                                            break;
                                                    }

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
                                                    
                                                    ?>
                                                       
                                                        <?php
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
                                                        <td class="center"><span style="<?php echo $background;?>" class="fw-bold"><?= implode(' ', array_slice(preg_split('/\s+/', trim($enquiries->name)), 0, 2)) ?></span></td>
                                                        <td class="center">
                                                           <?php
                                                                $this->db->where('file1', $enquiries->enquiry_no);
                                                                $this->db->or_where('file2', $enquiries->enquiry_no);
                                                                $combo_query = $this->db->get('arrival_combo');
                                                                $combo_result = $combo_query->row();

                                                                $is_combo = false;
                                                                $tooltip = '';

                                                                if ($combo_result) {
                                                                    if ($combo_result->file1 == $enquiries->enquiry_no) {
                                                                        $is_combo = true;
                                                                        $tooltip = 'Combo with: ' . $combo_result->file2;
                                                                    } elseif ($combo_result->file2 == $enquiries->enquiry_no) {
                                                                        $is_combo = true;
                                                                        $tooltip = 'Combo with: ' . $combo_result->file1;
                                                                    }
                                                                }
                                                                ?>

                                                                <span title="<?= $tooltip ?>">
                                                                    <?= $enquiries->enquiry_no ?>
                                                                    <?php if ($is_combo): ?>
                                                                        <strong>(c)</strong>
                                                                    <?php endif; ?>
                                                                </span>

                                                                <?php
                                                                if ($enquiries->split_count > 0) {
                                                                    echo ' <span class="badge bg-info" style="text-transform:capitalize;"> Split ' . ($enquiries->split_number) . '</span>';
                                                                }
                                                                ?>

                                                                <?php //if (in_array($enquiries->follow_status, ['pending', 'in-progress']) && in_array($this->session->userdata('id'), [14, 13, 8, 33])) {
                                                                    // $data_arr = [
                                                                    //     'qno' => $enquiries->enquiry_no,
                                                                    //     'adult_child' => ($enquiries->number_child + $enquiries->number_persons) . ' (' . $enquiries->number_persons . 'A+' . $enquiries->number_child . 'C)',
                                                                    //     'checkin' => $enquiries->check_in_date,
                                                                    //     'checkout' => $enquiries->check_out_date,
                                                                    //     'nights' => $enquiries->number_of_nights,
                                                                    //     'child' => $enquiries->number_child,
                                                                    //     'adults' => $enquiries->number_persons
                                                                    // ];
                                                                ?>
                                                                    <!-- <br> -->
                                                                    <!-- <button data-attr='<?php //json_encode($data_arr); ?>' id="<?php //base64_encode($enquiries->id) ?>" class="btn btn-link quotation" title="Make Quotation" style="padding:0 2px;font-size:10px;text-transform:capitalize;">Quotation</button> -->
                                                                <?php //} ?>

                                                                <?php if(in_array($enquiries->follow_status,['pending','in-progress']) && in_array($this->session->userdata('id'),[14,13,8,33,21])){ 
                                                                        $data_arr = ['qno'=>$enquiries->enquiry_no,
                                                                                    'adult_child'=>($enquiries->number_child+$enquiries->number_persons).' ('.$enquiries->number_persons.'A+'.$enquiries->number_child.'C)',
                                                                                    'checkin'=>$enquiries->check_in_date,'checkout'=>$enquiries->check_out_date,'nights'=>$enquiries->number_of_nights,'child'=>$enquiries->number_child,'adults'=>$enquiries->number_persons];
                                                                    ?>
                                                                    <!--<br><button data-attr='<?=json_encode($data_arr);?>' id="<?=base64_encode($enquiries->id) ?>" class="btn btn-link quotation" title="Make Quotation" style="padding:0 2px;font-size:10px;text-transform:capitalize;">Quotation</button>-->
                                                                <?php } ?>

                                                        </td>
                                                        <td class="center">
                                                            <?= $enquiries->number_persons . ' (A) , ' . $enquiries->number_child . ' (C)' ?>
                                                        </td>
                                                        
                                                        <td class="center">
                                                            <?= date('d-M-Y', strtotime($enquiries->check_in_date)) ?>
                                                        </td>
                                                        <td class="center">
                                                            <?= date('d-M-Y', strtotime($enquiries->check_out_date)) ?>
                                                        </td>
                                                       
                                                        <td class="center"><?= $enquiries->staff_name ?></td>
                                                        
                                                        <!-- <td class="center" ><?php //echo $enquiries->city ?></td> -->
                                                       <?php
                                                        // Step 1: Find admin based on region (excluding admin.id = 21)
                                                            $this->db->select('company_details.*, 
                                                                admin.name AS sales_admin_name, 
                                                                admin.contact_number AS sales_contact_number, 
                                                                admin.email AS sales_admin_email');
                                                            $this->db->from('company_details');
                                                            $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'left');
                                                            
                                                            $this->db->join('admin', 
                                                                '(FIND_IN_SET(' . $this->db->escape($enquiries->country) . ', admin.region) 
                                                                OR FIND_IN_SET(' . $this->db->escape($enquiries->state) . ', admin.region)) 
                                                                AND admin.id != 21', 
                                                                'left', false); // Important: false prevents automatic escaping of ON clause
                                                            
                                                            $this->db->where('company_details.contact_person', $enquiries->contact_person);
                                                            $this->db->where('enquiry.enquiry_no', $enquiries->enquiry_no);
                                                            
                                                            $agent_detail = $this->db->get();
                                                            $agent = $agent_detail->row();
                                                            
                                                            // Step 2: If no matching region admin (excluding 21), then check with admin.id = 21
                                                            if (empty($agent) || empty($agent->sales_admin_name)) {
                                                                $this->db->select('company_details.*, 
                                                                    admin.name AS sales_admin_name, 
                                                                    admin.contact_number AS sales_contact_number, 
                                                                    admin.email AS sales_admin_email');
                                                                $this->db->from('company_details');
                                                                $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'left');
                                                                $this->db->join('admin', 'admin.id = 21', 'left');
                                                            
                                                                $this->db->where('company_details.contact_person', $enquiries->contact_person);
                                                                $this->db->where('enquiry.enquiry_no', $enquiries->enquiry_no);
                                                            
                                                                $agent_detail = $this->db->get();
                                                                $agent = $agent_detail->row();
                                                            }

                                                            ?>

                                                            <td class="center" 
                                                                data-toggle="modal"
                                                                data-target="#agentModal"
                                                                <?php if ($agent): ?>
                                                                    data-email="<?= $agent->email; ?>"
                                                                    data-contact_person_number="<?= $enquiries->contact_person_number; ?>"
                                                                    data-company="<?= $agent->company; ?>"
                                                                    data-company_id="<?= $agent->company_id; ?>"
                                                                    data-contact_person="<?= $enquiries->contact_person; ?>"
                                                                    data-country="<?= $enquiries->country; ?>"
                                                                    data-state="<?= $enquiries->state; ?>"
                                                                    data-city="<?= $enquiries->city; ?>"
                                                                    data-salesname="<?= $agent->sales_admin_name; ?>"
                                                                    data-salesnumber="<?= $agent->sales_contact_number; ?>"
                                                                    data-salesemail="<?= $agent->sales_admin_email; ?>"
                                                                <?php endif; ?>
                                                            style="color:blue;">
                                                                <?= htmlspecialchars($enquiries->contact_person); ?>
                                                            </td>

                                                       <td class="center">
                                                            <?php
                                                            $this->db->where('enquiry_id',$enquiries->id);
                                                            $followups = $this->db->get('followups');
                                                            $data = $followups->result();
                                                            $vals = array_map(fn($d) => (int) $d->email_exchange, $data);
                                                            $vals = array_filter($vals, fn($v) => $v !== 0);
                                                            // Build the string only with non-zero numbers
                                                            if (!empty($vals)) {
                                                                $title = implode('+', $vals) . ' (' . array_sum($vals) . ')';
                                                            } else {
                                                                $title = '(' . array_sum($vals) . ')'; // if all were zero
                                                            }
                                                            $title_val = array_sum($vals);

                                                            $status_color = ['pending' => '#000000', 'in-progress' => '#8795fb', 'confirm' => '#18ce0f', 'not-materialized' => '#f96332', 'cancel-at-arrival' => 'red'];
                                                            $status = $enquiries->follow_status;
                                                            $label = ucfirst(str_replace('-', ' ', $status));
                                                            if ($status === 'not-materialized') {
                                                                $label = 'Dropped';
                                                            }
                                                            
                                                            //if(isset($arr[0]) && $arr[0]==''){ $status = 'pending'; }else{ $status = $arr[0]; }  ?>
                                                            
                                                            <?php if($status != 'in-progress' || $title_val == '0') { ?>
                                                                <a class="btn btn-xs"
                                                                style="background-color: <?= $status_color[$status] ?>;color:#FFF;"
                                                                href="<?= base_url() . $enquiries->id . '/'; ?>followup"><?= $label ?></a>
                                                            <?php }else{ ?>
                                                                <a class="btn btn-xs"
                                                                style="background-color: <?= $status_color[$status] ?>; color:#FFF;" 
                                                                href="<?= base_url() . $enquiries->id . '/'; ?>followup">
                                                                    <?= $label ?>
                                                                    <span title="Email exchange(<?= $title ?>)"
                                                                        class="zoom-text"
                                                                        style="font-size:9px; padding: 1px 3px; margin-left: 3px; margin-top: 1px; background:#00008B; color:#fff; border-radius:4px; display:inline-block;">
                                                                        <?= $title_val ?>
                                                                    </span>
                                                                </a>

                                                                <style>
                                                                    @keyframes zoomInOut {
                                                                        0%, 100% {
                                                                            transform: scale(1);
                                                                        }
                                                                        50% {
                                                                            transform: scale(1.3);
                                                                        }
                                                                    }
                                                                    .zoom-text {
                                                                        animation: zoomInOut 1s infinite;
                                                                    }
                                                                </style>
                                                                
                                                              <?php } ?>
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
                                                                    <a href="<?= base_url('add_arrival?enq_id=' . base64_encode($enquiries->id).'&split='.base64_encode($split_count)); ?>" class="badge bg-info mt-1 mr-1" title="Split" style="color:#FFF;text-transform: none;"><i class="fa fa-plane"></i> Split</a>                                                                            
                                                                <?php }} ?>
                                                                <a href="<?= base_url() . $enquiries->id ?>/edit-enquiry"
                                                                    class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <?php if ($this->session->userdata('type') == 1) { ?>
                                                                    <a href="<?= base_url() . $enquiries->id ?>/delete-enquiry"
                                                                        onclick="return confirm('Are you sure you want to delete this Enquiry?');"
                                                                        class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                            class="fas fa-trash"></i></a>
                                                                <?php } ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                          <div class="col-md-12 d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <?php echo 'Showing ' . ($offset + 1) . ' to ' . ($offset + $records_cnt) . ' of ' . $total . ' entries'; ?>
                            </div>
                            <div class="pagination-container">
                                <?php echo $links; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="spinnerOverlay"
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.8); z-index: 9999;">
    <div id="spinnerContent"
         style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                display: flex; flex-direction: column; align-items: center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div style="margin-top: 10px; font-weight: bold; color: #1974D2;">
            Itinerary generating, Please wait...
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#agentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var email = button.data('email');
            var company = button.data('company');
            var contact_person = button.data('contact_person');
            var contact_person_number = button.data('contact_person_number');
            var company_id = button.data('company_id');
            var country = button.data('country');
            var state = button.data('state');
            var city = button.data('city');
            var salesname = button.data('salesname');
            var salesnumber = button.data('salesnumber');
            var salesemail = button.data('salesemail');

            var modal = $(this);
            var html = `
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Company ID</th>
                                <td class="fs-4">${company_id}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Contact Person</th>
                                <td class="fs-4">${contact_person}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Email</th>
                                <td class="fs-4">${email}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Contact Number</th>
                                <td class="fs-4">${contact_person_number}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Country</th>
                                <td class="fs-4">${country}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">State</th>
                                <td class="fs-4">${state}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">City</th>
                                <td class="fs-4">${city}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Sales Name</th>
                                <td class="fs-4">${salesname}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Sales Number</th>
                                <td class="fs-4">${salesnumber}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold fs-4">Sales Email</th>
                                <td class="fs-4">${salesemail}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;

            modal.find('.modal-body').html(html);

        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#config-table').DataTable({
            paging: false,
            info: false,
            responsive: {
            details: {
                type: 'column',
                target: -1
            }
            },
            columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets: -1
            }
            ],
            order: [0, 'asc']
        });

        $('#config-table').on('click', '.quotation', function () {
            const data = $(this).attr('data-attr');
            const id = $(this).attr('id');    
            $('#myModalquotation').modal('show');
        });
    });
</script>

<script>
    var url = new URL(window.location.href);
    $(document).ready(function () {
        // $(".location").on("change", function () {
        //     var v = $(this).find(':selected').attr('data-abbr');
        //     var selected;
        //     $(".booking_type").empty().parent().removeClass("is-dirty");
        //     if (v !== "" && v !== undefined) {
        //         var opts = v.split(",");
        //         $(".booking_type").parent().addClass("is-dirty");
        //         $.each(opts, function (i, d) {
        //             selected = (url.searchParams.get('booking_type')==d)?'selected="selected"':'';
        //             $('.booking_type').append('<option value="' + d + '"'+selected+'>' + d + '</option>');
        //         });
        //         selected = (url.searchParams.get('booking_type')=="all")?'selected="selected"':'';
        //         $('.booking_type').append('<option value="all" '+selected+'>All</option>');
        //         get_staff();
        //     }
        // });
        // $(".location").on("change", function () 
        // {
        //     var abbr = $(this).find(':selected').attr('data-abbr');
        //     var locationVal = $(this).val();
        //     // console.log("Selected location from dropdown:", locationVal);
            
        //     $(".booking_type").empty().parent().removeClass("is-dirty");

        //     if (abbr) {
        //         var opts = abbr.split(",");
        //         $(".booking_type").parent().addClass("is-dirty");

        //         $.each(opts, function (i, d) {
        //             let selected = (url.searchParams.get('booking_type') == d) ? 'selected="selected"' : '';
        //             $('.booking_type').append('<option value="' + d + '"' + selected + '>' + d + '</option>');
        //         });

        //         let selected = (url.searchParams.get('booking_type') == "all") ? 'selected="selected"' : '';
        //         $('.booking_type').append('<option value="all" ' + selected + '>All</option>');
        //     }
        //     if (locationVal) {
        //         get_staff(locationVal); 
        //     }

            
        // });

        // function get_staff(locationnew) {
        //     // console.log("Sending location:", locationnew);

        //     if (!locationnew) {
        //         console.warn("Location is empty");
        //         $(".staff_id").empty();
        //         return;
        //     }

        //     $.ajax({
        //         type: "POST",
        //         url: "<?php //echo base_url(); ?>admin/enquiry/get_staff",
        //         data: {
        //             location: locationnew,
        //             '<?php //echo $this->security->get_csrf_token_name(); ?>': '<?php //echo $this->security->get_csrf_hash(); ?>'
        //         },
        //         dataType: "JSON",
        //         success: function (data) {
        //             $(".staff_id").empty().parent().addClass("is-dirty");
        //             $.each(data.details, function (i, d) {
        //                 $('.staff_id').append('<option value="' + d.id + '">' + d.name + '</option>');
        //             });
        //             $('.staff_id').append('<option value="all">All</option>');
        //         },
        //         complete: function () {
        //             $('.staff_id').val(url.searchParams.get('staff_id'));
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.error("AJAX error:", textStatus);
        //         }
        //     });
        // }
        
        // if (url.searchParams.has('location')) {
        //     $(".location").trigger("change");               
        // }
        if (url.searchParams.has('followup_status')) {
            $(".followup_status").val(url.searchParams.get('followup_status'));               
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
            const $this = $(this);
            const group = $this.data("group"); // e.g., "checkin" or "query"
            const type = $this.hasClass("date_from") ? "from" : "to";

            const $fromInput = $(`.date_from[data-group='${group}']`);
            const $toInput = $(`.date_to[data-group='${group}']`);
            const $fromShow = $(`.dt-search-show[data-group='${group}']`).eq(0);
            const $toShow = $(`.dt-search-show[data-group='${group}']`).eq(1);

            const fromVal = $fromInput.val();
            const toVal = $toInput.val();

            const fromDate = fromVal ? new Date(fromVal) : null;
            const toDate = toVal ? new Date(toVal) : null;

            const selectedDate = new Date($this.val());
            const formattedDate = selectedDate.toLocaleDateString("en-IN", {
                year: "numeric",
                month: "short",
                day: "2-digit"
            });

            // Update corresponding display field
            if (type === "from") {
                $fromShow.val(formattedDate).parent().addClass("is-focused");
            } else {
                $toShow.val(formattedDate).parent().addClass("is-focused");
            }

            // Validation logic
            if (type === "from") {
                if (!toVal) {
                    $toInput.attr("min", $this.val());
                } else if (fromDate && toDate && fromDate > toDate) {
                    $toInput.val('').attr("min", $this.val());
                    $toShow.val('');
                }
            } else {
                if (!fromVal) {
                    $fromInput.attr("max", $this.val());
                } else if (fromDate && toDate && fromDate > toDate) {
                    $fromInput.val('').attr("max", $this.val());
                    $fromShow.val('');
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

    // function get_staff() {
    //     if ($(".location").val() === "") {
    //         $(".staff_id").empty();
    //         return false;
    //     }
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php //echo base_url(); ?>admin/enquiry/get_staff",
    //         data: {
    //             'location': $(".location").val()
    //         },
    //         dataType: "JSON",
    //         success: function (data) {
    //             $(".staff_id").empty().parent().addClass("is-dirty");
    //             var opts = data.details;
    //             $.each(opts, function (i, d) {
    //                 $('.staff_id').append('<option value="' + d['id'] + '">' + d['name'] +
    //                     '</option>');
    //             });
    //             $('.staff_id').append('<option value="all">All</option>');
    //         },
    //         complete:function(){
    //             $('.staff_id').val(url.searchParams.get('staff_id'));
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) { }
    //     });
    // }
</script>

<script>
    
    $(document).ready(function () {
        $(".company").autocomplete({
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
                $('.company').val(ui.item.label); // display the selected text
                $('.company_id').val(ui.item.company_id); // save selected id to input
            }
        }).blur(function(event) {
            if($('.company').val()==''){
                $('.company_id').val('');
            }               
        });
        var country_flag = false;
        $(".country").autocomplete({
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
                $('.country').val(ui.item.label); // display the selected text
                $('.country_id').val(ui.item.country_id); // save selected id to input
                country_flag = true;
                return false;
            }
        }).blur(function(event) {
            if(country_flag==false){
                $(".country").val("");
            }               
        });

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }
        var state_flag = false;
        $(".state").autocomplete({
            
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('.country_id').val()
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
                    $(".city").val("").attr('disabled', 'disabled');
                } else {
                    $(".city").removeAttr('disabled');
                    $('.state_id').val(ui.item.state_id);
                } state_flag = true;
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        }).blur(function(event) {
            if(state_flag==false){
                    $(".state").val("");
            }               
        });
        
        var city_flag = false;
        $(".city").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('.state_id').val()
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
                    $(".city").val("");
            }               
        });
        
        // 11 Dec 2024
         var option_html = '';
        var qdata = '';
        var sites_outsidecity = '';
        $(".quotation").on("click",function(){
            $("#myModalquotation").modal("show");
            qdata = JSON.parse($(this).attr("data-attr"));
            $("#enquiry_id").val($(this).attr("id"));
            $("#number_of_adults").val(parseInt(qdata.adults));
            $("#number_of_child").val(parseInt(qdata.child));
            $("#number_of_nights").val(parseInt(qdata.nights));
            
            var i = 0;
            const options_chk = { year: 'numeric', month: 'short', day: '2-digit' };
            $.each(qdata,function(index,val){
                if(i===2 || i===3){
                    var date = new Date(val);
                    const formattedDate_chk = date.toLocaleDateString('en-IN',options_chk);
                    $(".qdata").eq(i).text(formattedDate_chk);
                }else{
                    $(".qdata").eq(i).text(val);
                }
                i++;
            });				
            /*option_html = '<div class="col-md-12 text-center">No Child</div>';
            for(var i=1;i<=qdata.child;i++){
                if(i==1){ option_html = ''; } 
                option_html += '<div class="col-md-6">Child '+i+' Age</div><div class="col-md-6"><select name="child_age[]" class="mb-1" style="padding:2px;">';
                option_html += '<option value="">Select..</option>';
                for(var age=1;age<=12;age++){
                    option_html += '<option value="'+age+'">'+age+'</option>';
                }
                option_html += '</select></div>';	
            }
            $("#child-ages").html(option_html);*/
            //$("#hotel-details").css("display","none");

            $("#frm_1")[0].reset();
            var itinerary_html = "";
            var city_details = "";
            var hotel_details = "";
            var restaurants_details = "";
            var guide_details = "";
            var adults_cnt = qdata.adults;
            var child_cnt = qdata.child;
            var chk_hotel_details = '<div class="row mt-2" style="padding: 5px 1px;font-weight:600;"><div class="col-md-12"><input type="checkbox" name="chk_all_hotels" id="chk_all_hotels"> Same Hotels For All Days</div></div>';
            for(var i=0;i<=qdata.nights;i++){ 
                var date = new Date(qdata.checkin);
                date.setDate(date.getDate() + parseInt(i));
                const day_Name = new Date(date).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
                
                const options = { year: 'numeric', month: 'short', day: '2-digit' };
                const formattedDate = date.toLocaleDateString('en-IN',options);
                
                const formattedDate1 = date.toLocaleDateString('en-CA');
                
                
                //itinerary_html += '<span class="bold itinerary_date" style="padding:5px;display:inline-flex;"><input '+((i==0)?"checked":"")+' type="radio" name="rdo-edit" class="rdo" value="'+day_Name+'">&nbsp;&nbsp;Day : '+(parseInt(i)+1)+'</span>';
                itinerary_html += '<div class="mb-1">';
                itinerary_html += '<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'+(parseInt(i)+1)+'" aria-expanded="true" aria-controls="collapse'+(parseInt(i)+1)+'"><span class="bold itinerary_date" style="padding:5px;display:inline-flex;">Day : '+(parseInt(i)+1)+'</span></a>';
                itinerary_html += '<ul id="collapse'+(parseInt(i)+1)+'" class="panel-collapse collapse in itinerary_ul" style="background-color:inherit;display:grid;"></ul>';
                // itinerary_html += '<input type="text" name="" class="form-control add-itinerary" placeholder="Search & Add Itinerary"></div>';
                itinerary_html += '<input type="text" name="" class="form-control add-itinerary" data-dayname="'+day_Name+'" placeholder="Search & Add Itinerary"></div>';
                
                city_details += '<div class="row mt-2" style="border:3px solid #a9a9a9;border-radius: 8px;"><div class="col-md-9 flights-msg"></div><div class="col-md-3" style="text-align:right;font-weight:600;">'+formattedDate+'</div><div class="col-md-3" style="padding-right:4px;">';
                //city_details += '<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' City ('+day_Name+')</span>';
                city_details += '<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' City </span>';
                city_details += '<input type="text" class="form-control qtn-city" name="arrival_cities[]" id="" placeholder="City" data-suburb="false" data-dayname="'+day_Name+'"></div>';
                city_details += '<div class="col-md-3 hide" style="padding-left:0;"><span class="bold">Transfer Mode</span>';
                city_details += '<select class="form-control qtn-transfer" name="">';
                city_details += '<option value="road">Road</option>';
                city_details += '<option value="flight">Flight</option></select></div>';
                city_details += '<div class="col-md-6 hide" style="padding-left:0;"><span class="bold">Arrival Date</span><span class="bold" style="margin-left:30px;">Arrival Time</span><div class="" style="display:inline-flex;">';
                city_details += '<input type="text" name="" class="mdl-textfield__input qtn-transfer-date-show dt-transfer-show" style="width:90%;height:30px;font-size:13px;" value="'+formattedDate+'" readonly>';
                city_details += '<input type="date" name="" placeholder="" id="" class="mdl-textfield__input qtn-transfer-date dt-transfer" value="'+formattedDate1+'" style="height:30px;width:20px;float:right;">';
                city_details += ' <input type="time" name="" placeholder="" id="" class="mdl-textfield__input city_arrival_time" style="padding: 0;margin-left: 5px">';
                city_details += '</div></div></div>';
                city_details += '<div class="row mt-2 local-flight" style="display:none;border: 1px solid #8589ff;border-radius: 13px;padding: 8px 0px; margin: 0px;"><div class="col-md-8" style="padding-right:12px;">';
                city_details += '<span class="bold" style="text-transform:capitalize;">Airline</span>';
                city_details += '<input type="text" class="form-control airline-search" id="" placeholder="Airline"></div>';
                city_details += '<div class="col-md-4" style="padding-left:0;"><span class="bold" style="margin-left:4px;">Departure Time</span>';
                city_details += '<input type="time" name="" placeholder="" id="" class="mdl-textfield__input airline-search-depart-time" style="padding: 0;margin-left: 5px">';
                city_details += '</div></div>';
                
            /*if(i < qdata.nights){
                if(i===1){
                    hotel_details += chk_hotel_details;
                }
                hotel_details +='<div class="row mt-2">';
                hotel_details +='<div class="col-md-12"><span class="bold" style="text-transform:capitalize;">Night '+(parseInt(i)+1)+' Hotel ('+day_Name+')</span></div>';
                hotel_details +='<div class="col-md-4" style="padding-right:4px;">';                
                hotel_details +='<input type="hidden" name="hdn_hotel_ids_'+i+'[]" class="hdn-hotelids" value="">';
                hotel_details +='<input type="hidden" name="" class="hdn-hotelids-cnt" value="">';
                hotel_details +='<input type="text" name="hotel_names_'+i+'[]" class="form-control daywise-hotels" id="" placeholder="Search Hotel" disabled></div>';
                hotel_details +='<div class="col-md-4" style="padding-right:4px;">';
                //hotel_details +='<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' Hotel ('+day_Name+')</span>';
                hotel_details +='<input type="hidden" name="hdn_hotel_ids_'+i+'[]" class="hdn-hotelids hide" value="">';
                hotel_details +='<input type="text" name="hotel_names_'+i+'[]" class="form-control daywise-hotels hide" id="" placeholder="Search Hotel" disabled></div>';
                hotel_details +='<div class="col-md-4" style="padding-right:4px;">';
                //hotel_details +='<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' Hotel ('+day_Name+')</span>';
                hotel_details +='<input type="hidden" name="hdn_hotel_ids_'+i+'[]" class="hdn-hotelids hide" value="">';
                hotel_details +='<input type="text" name="hotel_names_'+i+'[]" class="form-control daywise-hotels hide" id="" placeholder="Search Hotel" disabled></div>';
                
                hotel_details +='</div>';
            }*/
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
                
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #e5e4e4;border-right: 0;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Adults</span><br>';
                restaurants_details +='<input type="text" class="form-control mb-2" name="num_adults_'+i+'[]" value="'+adults_cnt+'" placeholder="Adults">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #e5e4e4;border-left: 0;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Price</span><br>';
                restaurants_details +='<input type="text" class="form-control adult-price" name="price_adults_'+i+'[]" placeholder="Price">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #e5e4e4;border-right: 0;left:5px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Child</span><br>';
                restaurants_details +='<input type="text" class="form-control mb-2" name="num_child_'+i+'[]" value="'+child_cnt+'" placeholder="Child">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding:0 4px;border: 1px solid #e5e4e4;border-left: 0;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">Price</span><br>';
                restaurants_details +='<input type="text" class="form-control child-price" name="price_child_'+i+'[]" placeholder="Price">';
                restaurants_details +='</div>';
                restaurants_details +='<div class="col-md-1" style="padding-right:4px;">';
                restaurants_details +='<span class="bold" style="text-transform:capitalize;">&nbsp;</span><br>';
                restaurants_details +='<button type="button" style="height:25px;cursor:pointer;" data-id="'+i+'" class="restaurant-add btn-primary">+</button></div>';
                restaurants_details +='</div>';
                
                guide_details +='<div class="row mt-2 row-bg g_'+i+'"><div class="col-md-5" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">Day '+(parseInt(i)+1)+' Guide ('+day_Name+')</span>';
                guide_details +='<input type="hidden" name="hdn_guides_ids_'+i+'[]" class="hdn-guides" value="">';
                guide_details +='<input type="text" class="form-control guides" data-idx="'+i+'" name="guides[]" placeholder="Search Guide"></div>';
                guide_details +='<div class="col-md-3" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">Shift Type</span><br>';
                guide_details +='<select class="form-control guides-shift" name="shift_'+i+'[]" id="" style="padding:7px;">';
                guide_details +='<option value="">Select..</option>';
                guide_details +='<option value="day">Day</option>';
                guide_details +='<option value="night">Night</option>';
                guide_details +='</select></div>';
                guide_details +='<div class="col-md-3" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">Price Type</span><br>';
                guide_details +='<select class="form-control guides-prices" name="prices_type_'+i+'[]" id="" style="padding:7px;">';
                guide_details +='<option value="">Select..</option>';
                guide_details +='<option value="fixed_prices">Fixed</option>';
                guide_details +='<option value="hourly_prices">Hourly</option>';
                guide_details +='</select></div>';
                guide_details +='<div class="col-md-1" style="padding-right:4px;">';
                guide_details +='<span class="bold" style="text-transform:capitalize;">&nbsp;</span><br>';
                guide_details +='<button type="button" style="height:25px;cursor:pointer;" data-id="'+i+'" class="guides-add btn-primary">+</button></div>';
                guide_details +='</div>';
            }
            
            $(".timeline").html(itinerary_html);
            $(".city-details").html(city_details);
            //$(".daywise-hotel-details").html(hotel_details);
            $("#show-restaurants").html(restaurants_details+'<input type="hidden" name="restaurants_cnt" value="'+qdata.nights+'">');
            $("#show-guides").html(guide_details);
            var html='';
            $.ajax({
                url: "<?php echo site_url('admin/quotation/fetch_suggesstions'); ?>",
                type: "post",
                data: {'capacity': parseInt(qdata.adult_child.split(" ")[0]),'enquiry_num':qdata.qno,'enquiry_id':$(this).attr("id") },
                dataType: 'JSON',
                //contentType: false,
                //processData: false,
                success: function(data) {
                    if (data.response === "s") {                            
                        if(data.details.transportation.length>0)
                        {
                            $.each(data.details.transportation, function(i, val) {
                                html += '<div class="col-md-9" style="padding:8px 16px;">';
                                html += '<span class=""><span for=""><input type="checkbox" class="vehicles" name="chk_vehicle[]" data-capacity="'+val.capacity+'" value="'+val.id+'">  '+val.vehicle_name+' (Capacity : '+val.capacity+')</span>';
                                html += '</span></div>';
                                html += '<div class="col-md-3">';
                                html += '<div class="mb-3">';
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
                        if(data.details.currency){
                            $("#roe").val(data.details.currency.country_currency_value);
                            $("#roe_name").html(data.details.currency.currency_name);
                            $("#hdn_roe_name").val(data.details.currency.currency_name);
                        }
                        $(".qtn-city").each(function(){
                            $(this).val(data.details.prefilled_city);
                        });
                        function syncItineraryPlaceholders() {
                            $(".qtn-city").each(function () {
                                if (!$(this).val().trim()) {
                                    updateCityUIWithDefault($(this), data.details.prefilled_city);
                                } else {
                                    updateCityUI($(this));
                                }
                            });
                        }
                        function updateCityUIWithDefault($cityInput, defaultCity) {
                            let dayName  = $cityInput.data("dayname");
                            let $itineraryInput = $('.add-itinerary[data-dayname="'+dayName+'"]');

                            $itineraryInput.attr("placeholder", "Search & Add Itinerary in " + defaultCity);
                            $('.city-label[data-dayname="'+dayName+'"]').text(defaultCity);
                        }
                        function updateCityUI($cityInput) {
                            let cityName = ($cityInput.val() || "").trim();  
                            let dayName  = $cityInput.data("dayname");

                            let $itineraryInput = $('.add-itinerary[data-dayname="'+dayName+'"]');

                            if (cityName) {
                                $itineraryInput.attr("placeholder", "Search & Add Itinerary in " + cityName);
                            } else {
                                $itineraryInput.attr("placeholder", "Search & Add Itinerary");
                            }

                            $('.city-label[data-dayname="'+dayName+'"]').text(cityName);
                        }
                        $(document).ready(function () {
                            syncItineraryPlaceholders();
                        });
                        $(document).on("input change autocompleteselect", ".qtn-city", function (e, ui) {
                            if (ui && ui.item) {
                                $(this).val(ui.item.value); 
                            }
                            updateCityUI($(this));
                        });
                        $(".departure-city").val(data.details.prefilled_city);
                        
                        // if(data.details.mandatory_services){
                        //     var mandatory_html = '';
                        //     $.each(data.details.mandatory_services, function(i, val) {
                        //         mandatory_html += '<div class="col-md-8"><div class="form-floating mb-1">'+val.title+'</div>';
                        //         mandatory_html += '<input type="hidden" name="hdn_mandatory_services[]" value="'+val.title+'_|_'+val.adult_price+'"></div>';
                        //         mandatory_html += '<div class="col-md-4" style="display:inline-flex;"><div class="form-floating mb-1">';
                        //         mandatory_html += '<input style="height:28px;" type="number" name="mandatory_services_qnty[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity"></div>';
                        //         mandatory_html += '<i title="Remove" class="bi bi-x-lg mandatory_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i></div>';
                        //     });
                        //     $("#mandatory_services").html("").html(mandatory_html);
                        // }
                        if(data.details.mandatory_services){
                            var mandatory_html = '';
                            var no_of_nights = parseInt($("#number_of_nights").val()) || 1;
                            var no_of_nights =  no_of_nights + 1;
                            var no_of_guests = (parseInt($("#number_of_adults").val()) || 0) + (parseInt($("#number_of_child").val()) || 0);
                            $.each(data.details.mandatory_services, function(i, val) {
                                let quantity = parseInt(val.quantity) || 1;
                                let cost_by = val.cost_by ? val.cost_by.toLowerCase() : 'entire_trip';
                                let group_type = val.group_type ? val.group_type.toLowerCase() : 'per_person';
                                let adjusted_quantity = quantity;
                                if (cost_by === 'per_day') {
                                    adjusted_quantity *= no_of_nights;
                                }
                                if (group_type === 'per_person') {
                                    adjusted_quantity *= no_of_guests;
                                }
                                mandatory_html += '<div class="col-md-8"><div class="form-floating mb-1">'+val.title+'</div>';
                                mandatory_html += '<input type="hidden" name="hdn_mandatory_services[]" value="'+val.title+'_|_'+val.adult_price+'"></div>';
                                mandatory_html += '<div class="col-md-4" style="display:inline-flex;"><div class="mb-1">';
                                mandatory_html += '<input style="height:28px;" type="number" name="mandatory_services_qnty[]" class="form-control" id="" min="' + adjusted_quantity + '" value="' + adjusted_quantity + '" placeholder="Enter Quantity"></div>';
                                mandatory_html += '<i title="Remove" class="bi bi-x-lg mandatory_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i></div>';
                            });
                            $("#mandatory_services").html("").html(mandatory_html);
                        }
                        if(data.details.luggage_vehicle){
                            var luggage_vehicle_html = '';
                            $.each(data.details.luggage_vehicle, function(i, val) {
                                luggage_vehicle_html += '<div class="row"><div class="col-md-9"><span for="">'+val.vehicle_type+'</span></div>';
                                luggage_vehicle_html += '<div class="col-md-3 text-center"><span for="">1</span>';
                                luggage_vehicle_html += '<input type="hidden" name="hdn_luggage_vehicle[]" value="'+val.vehicle_type+'__'+val.price+'__1">';
                                luggage_vehicle_html += '<i title="Remove" class="bi bi-x-lg luggage-remove" style="color:red;cursor: pointer;float: right;margin-top: 2px;position:relative;"></i></div></div>';
                                $("#luggage-vehicle").append(luggage_vehicle_html);
                            });
                        }
                        
                        // if(data.details.sites_outsidecity){
                        //     sites_outsidecity = data.details.sites_outsidecity;
                        //     for(var i=1;i<=parseInt($(".itinerary_ul").length-2);i++){
                        //         var act = 'Entry Fee : '+data.details.sites_outsidecity[i].entry_ticket_fee+' (A) '+data.details.sites_outsidecity[i].child_entry_ticket_fee+' (C)  | <button type="button" data-site-id="'+data.details.sites_outsidecity[i].id+'" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';
                        //         $(".itinerary_ul").eq(i).append("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+i+"][]' value='"+data.details.sites_outsidecity[i].id+"'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+i+"][]' value='"+data.details.sites_outsidecity[i].site_name+"'><div>"+data.details.sites_outsidecity[i].site_name+" <br>("+act+")</div><i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i><input type='hidden' class='activities-list' name='hdn_activities["+i+"][]' value=''></li>");
                        //     }
                        // }
                    // if (data.details.sites_outsidecity) 
                    // {
                    //         let sites_outsidecity = data.details.sites_outsidecity;
                    //         sites_outsidecity.sort((a, b) => {
                    //             const timeToMinutes = (time) => {
                    //                 if (!time || !time.includes(':')) return 0;
                    //                 const [h, m] = time.split(':').map(Number);
                    //                 return h * 60 + m;
                    //             };
                    //             return timeToMinutes(a.departing_time_from_hotel) - timeToMinutes(b.departing_time_from_hotel);
                    //         });

                    //         let usedSiteIds = new Set();

                    //         for (let i = 1; i <= $(".itinerary_ul").length - 2; i++) {
                    //             let siteCount = 0;
                    //             let currentTime = 9 * 60; 

                    //             for (let j = 0; j < sites_outsidecity.length; j++) {
                    //                 if (siteCount >= 4) break;

                    //                 let site = sites_outsidecity[j];
                    //                 if (usedSiteIds.has(site.id)) continue;

                    //                 let siteTime = 0;
                    //                 if (site.departing_time_from_hotel && site.departing_time_from_hotel.includes(':')) {
                    //                     let [h, m] = site.departing_time_from_hotel.split(':').map(Number);
                    //                     siteTime = h * 60 + m;
                    //                 }

                    //                 let duration = parseFloat(site.duration) || 0;
                    //                 let durationMinutes = duration * 60;

                    //                 if (siteTime >= currentTime) {
                    //                     usedSiteIds.add(site.id);
                    //                     siteCount++;
                    //                     currentTime = siteTime + durationMinutes;

                    //                     let timeLabel = site.departing_time_from_hotel ? `Start Time: ${site.departing_time_from_hotel}` : '';
                    //                     let durationLabel = duration ? ` | Duration: ${duration} hours` : '';

                    //                     let act = `Entry Fee: ${site.entry_ticket_fee} (A) ${site.child_entry_ticket_fee} (C) | ${timeLabel}${durationLabel}
                    //                         <button type="button" data-site-id="${site.id}" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>`;

                    //                     $(".itinerary_ul").eq(i).append(`
                    //                         <li style="display:inline-flex;">
                    //                             <input type="hidden" name="hdn_site_id[${i}][]" value="${site.id}">
                    //                             <i class="fa fa-circle-o" style="margin:6px;"></i>
                    //                             <input type="hidden" name="hdn_itinerary_content[${i}][]" value="${site.site_name}">
                    //                             <div>${site.site_name} <br>(${act})</div>
                    //                             <i title="Remove" class="bi bi-x-lg edit-remove" style="color:red;cursor:pointer;float:right;margin-top:5px;position:relative;"></i>
                    //                             <input type="hidden" class="activities-list" name="hdn_activities[${i}][]" value="">
                    //                         </li>
                    //                     `);
                    //                 }
                    //             }
                    //         }
                    //     }
            //      function buildEverything() {
            //     buildItinerary();
            //     buildItineraryWithSuggestions(data.details);
            // }

            // function buildItinerary() {
            //     const sites_outsidecity = data.details.sites_outsidecity || [];
            //     const getTimeAsMinutes = (str) => {
            //         if (!str || !str.includes(':')) return 0;
            //         const [h, m] = str.split(':').map(Number);
            //         return h * 60 + m;
            //     };

            //     const arrival_time = getTimeAsMinutes($("#initial-airline-departure-time").val() || "00:00");
            //     const departure_time = getTimeAsMinutes($(".airline-search-depart-time").val() || "23:59");
            //     const selectedAirport = $('input[name="airport_pick_drop"]:checked').val();

            //     let usedSiteIds = new Set();
            //     const totalDays = $(".itinerary_ul").length;
            //     const dayWiseLocationId = {};

            //     $(".itinerary_ul").each(function () { $(this).html(''); });

            //     // FIRST DAY
            //     const formatMinutesToTime = (mins) => {
            //         const h = Math.floor(mins / 60).toString().padStart(2, '0');
            //         const m = (mins % 60).toString().padStart(2, '0');
            //         return `${h}:${m}`;
            //     };

            //     const dayOneUL = $(".itinerary_ul").eq(0);
            //     if (selectedAirport === 'yes') {
            //         dayOneUL.append(`<li style='display:inline-flex;'>
            //             <i class="fa fa-car" style='margin:6px;'></i>
            //             <input type='hidden' name='hdn_itinerary_content[0][]' value='Airport Pick'>
            //             <div>Airport Pick</div>
            //             <i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor:pointer;margin-top:5px;'></i>
            //         </li>`);
            //     }

            //     dayOneUL.append(`<li style='display:inline-flex;'>
            //         <i class="fa fa-bed" style='margin:6px;'></i>
            //         <input type='hidden' name='hdn_itinerary_content[0][]' value='Hotel Check-in & Rest'>
            //         <div>Hotel Check-in & Rest</div>
            //         <i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor:pointer;margin-top:5px;'></i>
            //     </li>`);

            //     // ✅ Start from 2hr after arrival
            //     let currentTime = arrival_time + 120;
            //     const endTime = 1200; // 8:00 PM
            //     const insideSites = data.details.sites_insidecity || [];

            //     // Filter and sort sites by start time
            //     let availableInside = insideSites.filter(s => !usedSiteIds.has(s.id));
            //     availableInside.sort((a, b) => getTimeAsMinutes(a.departing_time_from_hotel) - getTimeAsMinutes(b.departing_time_from_hotel));

            //     for (let site of availableInside) {
            //         const start = getTimeAsMinutes(site.departing_time_from_hotel);
            //         const duration = parseInt(site.duration_hours || 0) * 60 + parseInt(site.duration_minutes || 0);

            //         if (start >= currentTime && (start + duration) <= endTime) {
            //             dayOneUL.append(renderSiteLi(site, 0));
            //             usedSiteIds.add(site.id);
            //             currentTime = start + duration + 30; // add 30 min gap
            //         }
            //     }

            //     // MID DAYS
            //     for (let i = 1; i < totalDays - 1; i++) {
            //         const itineraryUL = $(".itinerary_ul").eq(i);
            //         const endOfDay = 22 * 60;
            //         let currentTime = 9 * 60;

            //         for (let site of sites_outsidecity) {
            //             if (usedSiteIds.has(site.id)) continue;

            //             const siteStart = site.departing_time_from_hotel
            //                 ? getTimeAsMinutes(site.departing_time_from_hotel)
            //                 : currentTime;

            //             const duration = ((parseFloat(site.duration_hours || 0) + parseFloat(site.est_hour || 0)) * 60) +
            //                             parseFloat(site.duration_minutes || 0);

            //             if (siteStart + duration <= endOfDay) {
            //                 usedSiteIds.add(site.id);
            //                 itineraryUL.append(renderSiteLi(site, i));
            //                 dayWiseLocationId[i] = site.location_ids;
            //                 break;
            //             }
            //         }
            //     }

            //     // LAST DAY
            //     const lastIndex = totalDays - 1;
            //     const lastDayUL = $(".itinerary_ul").eq(lastIndex);
            //     // Allow inside city activities until 5 hours before departure
            //     const lastDayStartTime = 600; // 10:00 AM
            //     const lastDayEndTime = departure_time - 300; // 5 hours before departure
            //     let currentLastDayTime = lastDayStartTime;
            //     const lastDaySites = (data.details.sites_insidecity || []).filter(s => !usedSiteIds.has(s.id));
            //     lastDaySites.sort((a, b) => getTimeAsMinutes(a.departing_time_from_hotel) - getTimeAsMinutes(b.departing_time_from_hotel));

            //     for (let site of lastDaySites) {
            //         const start = getTimeAsMinutes(site.departing_time_from_hotel);
            //         const duration = parseInt(site.duration_hours || 0) * 60 + parseInt(site.duration_minutes || 0);
            //         if (start >= currentLastDayTime && (start + duration) <= lastDayEndTime) {
            //             lastDayUL.append(renderSiteLi(site, lastIndex));
            //             usedSiteIds.add(site.id);
            //             currentLastDayTime = start + duration + 30; // 30-minute buffer
            //         }
            //     }
            //     // Add Airport Drop if needed
            //     if (selectedAirport === 'yes') {
            //         lastDayUL.append(`<li style='display:inline-flex;'>
            //             <i class="fa fa-car" style='margin:6px;'></i>
            //             <input type='hidden' name='hdn_itinerary_content[${lastIndex}][]' value='Airport Drop'>
            //             <div>Airport Drop</div>
            //             <i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor:pointer;margin-top:5px;'></i>
            //         </li>`);
            //     }

            //     window.dayWiseLocationId = dayWiseLocationId;
            //     window.usedSiteIds = usedSiteIds; // Also share with suggestion builder
            // }

            // function renderSiteLi(site, i) {
            //     const timeLabel = site.departing_time_from_hotel ? `Start Time: ${site.departing_time_from_hotel}` : '';
            //     const totalHours = (parseFloat(site.duration_hours || 0) + parseFloat(site.est_hour || 0)).toFixed(1);
            //     const Hours = parseFloat(site.duration_hours || 0);
            //     const Hourstravel = parseFloat(site.est_hour || 0);
            //     const totalMinutes = parseFloat(site.duration_minutes || 0);
            //     const durationLabel = (Hours || totalMinutes)
            //         ? ` | Duration: ${Hours > 0 ? `${Hours}h` : ''}${totalMinutes > 0 ? ` ${totalMinutes}m` : ''}`
            //         : '';
            //     const durationtravel = (Hourstravel)
            //         ? ` | Travelling Duration: ${Hourstravel}h`
            //         : '';
            //     const act = `Entry Fee: ${site.entry_ticket_fee} (A) ${site.child_entry_ticket_fee} (C) | ${timeLabel}${durationLabel} ${durationtravel}
            //         <button type="button" data-site-id="${site.id}" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>`;
            //     return `<li style="display:inline-flex;">
            //         <input type="hidden" name="hdn_site_id[${i}][]" value="${site.id}">
            //         <i class="fa fa-circle-o" style="margin:6px;"></i>
            //         <input type="hidden" name="hdn_itinerary_content[${i}][]" value="${site.site_name}">
            //         <div>${site.site_name} <br>(${act})</div>
            //         <i title="Remove" class="bi bi-x-lg edit-remove" style="color:red;cursor:pointer;float:right;margin-top:5px;"></i>
            //         <input type="hidden" class="activities-list" name="hdn_activities[${i}][]" value="">
            //     </li>`;
            // }

            // function buildItineraryWithSuggestions(data) {
            //     const days = data.quotations[0]?.total_days || $(".itinerary_ul").length;
            //     const insideSites = data.sites_insidecity || [];
            //     const outsideSites = data.sites_outsidecity || [];
            //     const usedSiteIds = new Set();
            //     const suggestedSiteNames = new Set();
                
            //     // Loop through ALL itinerary items on the page
            //     $(".itinerary_ul").each(function () {
            //         $(this).find("input[name^='hdn_site_id']").each(function () {
            //             const id = parseInt($(this).val());
            //             if (!isNaN(id)) usedSiteIds.add(id);
            //         });

            //         $(this).find("input[name^='hdn_itinerary_content']").each(function () {
            //             const name = $(this).val()?.trim().toLowerCase();
            //             if (name) suggestedSiteNames.add(name);
            //         });
            //     });


            //     const getTimeAsMinutes = (str) => {
            //         if (!str || !str.includes(':')) return 0;
            //         const [h, m] = str.split(':').map(Number);
            //         return h * 60 + m;
            //     };

            //     for (let i = 0; i < days; i++) {
            //         const $itineraryUL = $(".itinerary_ul").eq(i);
            //         if ($itineraryUL.length === 0 || $itineraryUL.next(".suggestions-box").length > 0) continue;
            //         if (i === 0 || i === days - 1) continue; // Skip first & last day

            //         const locId = window.dayWiseLocationId?.[i] || null;

            //         // STEP 1: Calculate used time in day
            //         let totalUsedMinutes = 0;
            //         // let usedStartTimes = new Set(); // <-- Track start times used on this day
            //         let usedStartTimes = new Set();
            //         let latestEndTimeInMinutes = 0;

            //         $itineraryUL.find("input[name^='hdn_site_id']").each(function () {
            //             const siteId = parseInt($(this).val());
            //             const site = [...insideSites, ...outsideSites].find(s => s.id == siteId);
            //             if (!site) return;

            //             const h = parseFloat(site.duration_hours || 0);
            //             const m = parseFloat(site.duration_minutes || 0);
            //             const estH = parseFloat(site.est_hour || 0);
            //             totalUsedMinutes += ((h + estH) * 60) + m;

            //             const startTime = site.departing_time_from_hotel?.trim();
            //             if (startTime) {
            //                 usedStartTimes.add(startTime);

            //                 const startMins = getTimeAsMinutes(startTime);
            //                 const endMins = startMins + ((h + estH) * 60) + m;
            //                 if (endMins > latestEndTimeInMinutes) {
            //                     latestEndTimeInMinutes = endMins;
            //                 }
            //             }
            //         });

            //         const maxDayMinutes = 13 * 60; // Assume 9AM to 10PM = 13 hours
            //         const remainingMinutes = maxDayMinutes - totalUsedMinutes;

            //         let suggestions = [];

            //         // STEP 2: Same location suggestions from outsideSites (if time allows)
            //         const hasSameLocUsed = Object.keys(window.dayWiseLocationId || {}).includes(i.toString());

            //         if (hasSameLocUsed && locId && remainingMinutes > 60) {
            //             const outsideLocSites = outsideSites.filter(site =>
            //             site.location_ids == locId &&
            //             !usedSiteIds.has(site.id) &&
            //             !suggestedSiteNames.has(site.site_name) &&
            //             (!site.departing_time_from_hotel || !usedStartTimes.has(site.departing_time_from_hotel.trim())) &&
            //             (!site.departing_time_from_hotel || getTimeAsMinutes(site.departing_time_from_hotel) >= latestEndTimeInMinutes)
            //         );


            //             for (const site of outsideLocSites) {
            //                 const siteTime = ((parseFloat(site.duration_hours || 0) + parseFloat(site.est_hour || 0)) * 60)
            //                     + parseFloat(site.duration_minutes || 0);
            //                 if (siteTime <= remainingMinutes) {
            //                     suggestions.push(site);
            //                     suggestedSiteNames.add(site.site_name);
            //                     break;
            //                 }
            //             }
            //         }

            //         // STEP 3: Fallback to inside city sites
            //         if (suggestions.length === 0 && remainingMinutes > 45) {
            //             const availableInside = insideSites.filter(site =>
            //                 !usedSiteIds.has(site.id) &&
            //                 !suggestedSiteNames.has(site.site_name) &&
            //                 (!site.departing_time_from_hotel || !usedStartTimes.has(site.departing_time_from_hotel.trim())) &&
            //                 (!site.departing_time_from_hotel || getTimeAsMinutes(site.departing_time_from_hotel) >= latestEndTimeInMinutes)
            //             );


            //             for (const site of availableInside) {
            //                 const siteTime = ((parseFloat(site.duration_hours || 0)) * 60)
            //                     + parseFloat(site.duration_minutes || 0);
            //                 if (siteTime <= remainingMinutes) {
            //                     suggestions.push(site);
            //                     suggestedSiteNames.add(site.site_name);
            //                     break;
            //                 }
            //             }
            //         }

            //         if (!suggestions.length) continue;

            //         // STEP 4: Render suggestion box
            //         const suggestionBox = `<div class="suggestions-box" style="background:#f5f5f5; border-left:4px solid #28a745; padding:10px; margin:5px 0;">
            //             <strong>Suggested Sites:</strong>
            //             ${suggestions.map(site => {
            //                 const hours = parseFloat(site.duration_hours || 0);
            //                 const minutes = parseFloat(site.duration_minutes || 0);
            //                 const estHour = parseFloat(site.est_hour || 0);
            //                 const durationStr = `${hours ? `${hours}h ` : ''}${minutes ? `${minutes}m` : ''}`;
            //                 const travelStr = estHour ? ` | Travelling Duration: ${estHour}h` : '';
            //                 const startTime = site.departing_time_from_hotel ? ` | Start Time: ${site.departing_time_from_hotel}` : '';
            //                 return `<div style="margin:4px 0; display:flex; align-items:center;">
            //                     <span style="flex-grow:1;">${site.site_name} - Entry Fee: ${site.entry_ticket_fee} (A) ${site.child_entry_ticket_fee} (C)${startTime} | Duration: ${durationStr}${travelStr}</span>
            //                     <button type="button" class="btn btn-sm btn-success add-site-btn" 
            //                         data-id="${site.id}"    
            //                         data-name="${site.site_name}" 
            //                         data-entry-ticket="${site.entry_ticket_fee}" 
            //                         data-entry-child="${site.child_entry_ticket_fee}" 
            //                         data-starttime="${site.departing_time_from_hotel || ''}" 
            //                         data-hours="${hours}" 
            //                         data-minutes="${minutes}" 
            //                         data-est-hour="${estHour}" 
            //                         data-day-index="${i}">+</button>
            //                 </div>`;
            //             }).join('')}
            //         </div>`;
            //         $itineraryUL.after(suggestionBox);
            //     }
            // }
            // $(document).on('click', '.add-site-btn', function () {
            //     const btn = $(this);
            //     const siteId = btn.data('id');
            //     const name = btn.data('name');
            //     const hours = btn.data('hours');
            //     const minutes = btn.data('minutes');
            //     const estHour = btn.data('est-hour');
            //     const entry_ticket = btn.data('entry-ticket');
            //     const child_entry_ticket = btn.data('entry-child');
            //     const data_start_time = btn.data('starttime');
            //     const dayIndex = btn.data('day-index');

            //     const durationLabel = (hours || minutes)
            //         ? ` | Duration: ${hours ? `${hours}h` : ''} ${minutes ? `${minutes}m` : ''}` : '';
            //     const travelLabel = estHour ? ` | Travelling Duration: ${estHour}h` : '';

            //     const act = `Entry Fee: -${durationLabel}${travelLabel}
            //         <button type="button" data-site-id="${siteId}" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>`;

            //     const li = `<li style="display:inline-flex; width:100%; margin:4px 0; align-items:flex-start;">
            //         <input type="hidden" name="hdn_site_id[${dayIndex}][]" value="${siteId}">
            //         <i class="fa fa-circle-o" style="margin:6px;"></i>
            //         <input type="hidden" name="hdn_itinerary_content[${dayIndex}][]" value="${name}">
            //         <div style="flex-grow:1;">${name}<br>(${act})</div>
            //         <i title="Remove" class="bi bi-x-lg edit-remove" style="color:red; cursor:pointer; margin-top:5px;"></i>
            //         <input type="hidden" class="activities-list" name="hdn_activities[${dayIndex}][]" value="">
            //     </li>`;

            //     $(".itinerary_ul").eq(dayIndex).append(li);
            // });

            // $(document).on('click', '.edit-remove', function () {
            //     $(this).closest('li').remove();
            // });

            // $(document).ready(function () {
            //     buildEverything();
            //     $('input[name="airport_pick_drop"], #initial-airline-departure-time, .airline-search-depart-time').on('change', buildEverything);
            //     $("#initial-airline-departure-time, .airline-search-depart-time").on("change input", function () {
            //         setTimeout(() => {
            //             const arrivalVal = $("#initial-airline-departure-time").val();
            //             const departVal = $(".airline-search-depart-time").val();
            //             if (arrivalVal && departVal) {
            //                 buildEverything();
            //             }
            //         }, 100);
            //   });
            // }); 
                        if(data.details.quotations){
                            var quotation_html = '';
                            $.each(data.details.quotations, function(i, val) {
                                quotation_html += '<div class="col-md-1"><span class="btn btn-link quotations-made" data-id="'+val.id+'" style="padding: 4px 12px;text-transform: capitalize;"><i class="fa fa-file-text-o"></i> Quotation '+(i+1)+'</span></div>';
                            });
                                        $("#show-quotations").append(quotation_html);
                                    }
                                } 
                            }
                        });
                
            $("input[name='qt_arrival_date']").val(qdata.checkin).trigger("change");
            var num_guests = qdata.adult_child.split(" ")[0];
            if(num_guests > 5){
                $('input[name="guide"][value="yes"]').prop('checked', 'checked').trigger("click");
            }else{
                $('input[name="guide"][value="no"]').prop('checked', 'checked').trigger("click");
            }
            var total_pax = parseInt(qdata.adults)+parseInt(qdata.child);
            if(total_pax > 5){
                $('#div_driver_cum_guide label:first').addClass("hide");
            }else{
                $('#div_driver_cum_guide label:first').removeClass("hide");                
            }
        });
        
        $(document).on('click', '.itinerary_data', function (e) {
                e.preventDefault();

                var firstDay = localStorage.getItem('firstDay') || "";
                var lastDay = localStorage.getItem('lastDay') || "";
                const selectedAirport = $('input[name="airport_pick_drop"]:checked').val();
                const arrival_time = $("#initial-airline-departure-time").val() || "00:00";
                const departure_time = $(".airline-search-depart-time").val() || "23:59";

                if (selectedAirport === 'yes' || selectedAirport === 'no') {                    
                    $("#spinnerOverlay").css("display", "block");
                    $(".itinerary_ul").html(""); 

                    $.ajax({
                        url: "<?php echo site_url('admin/quotation/generate_itinerary'); ?>",
                        type: "POST",
                        data: {
                            'enquiry_num': qdata.qno,
                            'check_in': qdata.checkin,
                            'check_out': qdata.checkout,
                            'arrival_time': arrival_time,
                            'departure_time': departure_time
                        },
                        dataType: 'json',
                        success: function (itinerary) {
                            if (Array.isArray(itinerary)) {
                                itinerary.forEach(function(dayPlan, index) {
                                    var dayIndex = index;
                                    var ul = $(".itinerary_ul").eq(index);

                                    // 👉 Add First Day / Last Day info
                                    if (index === 0 && firstDay) {
                                        ul.append("<li>" + firstDay + "</li>");
                                        if(selectedAirport === 'yes'){ul.append("<li>Airport Pick</li>");}
                                    }
                                    if (index === itinerary.length - 1 && lastDay) {
                                        ul.append("<li>" + lastDay + "</li>");
                                        if(selectedAirport === 'yes'){ul.append("<li>Airport Drop</li>");}
                                    }

                                    // Normal activity rendering
                                    dayPlan.activities.forEach(function(activity) {
                                        var act = 'Entry Fee : ' + (activity.entry_ticket_fee || '0') + ' (A) ' + (activity.child_entry_ticket_fee || '0') + ' (C)  | ' +
                                                'Start Time: ' + (activity.departing_time_from_hotel || '0') + ' | ' +
                                                'Duration: ' + (activity.duration_hours || '0') + 'h ' + 
                                                '<button type="button" data-site-id="' + activity.id + '" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';

                                        var html = "<li style='display:inline-flex;'>"
                                            + "<input type='hidden' name='hdn_site_id[" + dayIndex + "][]' value='" + activity.id + "'>"
                                            + "<i class='fa fa-circle-o' style='margin:6px;'></i>"
                                            + "<input type='hidden' name='hdn_itinerary_content[" + dayIndex + "][]' value='" + activity.site_name + "'>"
                                            + "<div>" + activity.site_name + " <br>(" + act + ")</div>"
                                            + "<i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i>"
                                            + "<input type='hidden' class='activities-list' name='hdn_activities[" + dayIndex + "][]' value=''>"
                                            + "</li>";

                                        ul.append(html);
                                    });
                                });
                            } else {
                                console.error("Itinerary format invalid", itinerary);
                            }
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch itinerary", xhr.responseText);
                        },
                        complete: function () {
                            $("#spinnerOverlay").css("display", "none");
                        }
                    });
                }
            });
        
        
        
        //   $(document).on('click', '.generate_itinerary', function () {
        //         const selectedAirport = $('input[name="airport_pick_drop"]:checked').val();
                
        //         const arrival_time = $("#initial-airline-departure-time").val() || "00:00";
        //         const departure_time = $(".airline-search-depart-time").val() || "23:59";
        //         if (selectedAirport === 'yes' || selectedAirport === 'no') {                    
        //             $("#spinnerOverlay").css("display", "block");
        //             $(".itinerary_ul").html(""); 
        //             $.ajax({
        //                 url: "<?php echo site_url('admin/quotation/generate_itinerary'); ?>",
        //                 type: "POST",
        //                 data: {
        //                     'enquiry_num': qdata.qno,
        //                     'check_in': qdata.checkin,
        //                     'check_out': qdata.checkout,
        //                     'arrival_time': arrival_time,
        //                     'departure_time': departure_time
        //                 },
        //                 dataType: 'json',
        //                 success: function (itinerary) {
        //                      if (Array.isArray(itinerary)) {
        //                         itinerary.forEach(function(dayPlan, index) {
        //                             var dayIndex = index;
        //                             var ul = $(".itinerary_ul").eq(index);

        //                             dayPlan.activities.forEach(function(activity) {
        //                                 var act = 'Entry Fee : ' + (activity.entry_ticket_fee || '0') + ' (A) ' + (activity.child_entry_ticket_fee || '0') + ' (C)  | ' +
        //                                         'Start Time: ' + (activity.departing_time_from_hotel || '0') + ' | ' +
        //                                         'Duration: ' + (activity.duration_hours || '0') + 'h ' + 
        //                                         '<button type="button" data-site-id="' + activity.id + '" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';

        //                                 var html = "<li style='display:inline-flex;'>"
        //                                     + "<input type='hidden' name='hdn_site_id[" + dayIndex + "][]' value='" + activity.id + "'>"
        //                                     + "<i class='fa fa-circle-o' style='margin:6px;'></i>"
        //                                     + "<input type='hidden' name='hdn_itinerary_content[" + dayIndex + "][]' value='" + activity.site_name + "'>"
        //                                     + "<div>" + activity.site_name + " <br>(" + act + ")</div>"
        //                                     + "<i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i>"
        //                                     + "<input type='hidden' class='activities-list' name='hdn_activities[" + dayIndex + "][]' value=''>"
        //                                     + "</li>";

        //                                 ul.append(html);
        //                             });
        //                         });
        //                     }
                          
        //                     else {
        //                         console.error("Itinerary format invalid", itinerary);
        //                     }
        //                 },
        //                 error: function (xhr) {
        //                     console.error("Failed to fetch itinerary", xhr.responseText);
        //                 },
        //                 complete: function () {
        //                     // Hide spinner when done
        //                   $("#spinnerOverlay").css("display", "none");
        //                 }
        //             });
        //         }
        //     });
        
        
        
            //  $(document).on('click', '#individual_btn_proceed_to_itinerary', function () {
            //     const selectedAirport = $('input[name="airport_pick_drop"]:checked').val();
                
            //     const arrival_time = $("#initial-airline-departure-time").val() || "00:00";
            //     const departure_time = $(".airline-search-depart-time").val() || "23:59";
            //     if (selectedAirport === 'yes' || selectedAirport === 'no') {
            //         $("#spinnerOverlay").css("display", "block");
            //         $(".itinerary_ul").html(""); 

            //         $.ajax({
            //             url: "<?php echo site_url('admin/quotation/generate_itinerary'); ?>",
            //             type: "POST",
            //             data: {
            //                 'enquiry_num': qdata.qno,
            //                 'check_in': qdata.checkin,
            //                 'check_out': qdata.checkout,
            //                 'arrival_time': arrival_time,
            //                 'departure_time': departure_time
            //             },
            //             dataType: 'json',
            //             success: function (itinerary) {
            //                 if (Array.isArray(itinerary)) {
            //                     itinerary.forEach(function (dayPlan, index) {
            //                         var ul = $(".itinerary_ul").eq(index);
            //                         dayPlan.activities.forEach(function (activity) {
            //                             var act = 'Entry Fee : ' + (activity.entry_ticket_fee || '0') + ' (A) ' + (activity.child_entry_ticket_fee || '0') + ' (C)  | ' +
            //                                     'Start Time: ' + (activity.departing_time_from_hotel || '0') + ' | ' +
            //                                     'Duration: ' + (activity.duration_hours || '0') + 'h ' + 
            //                                     '<button type="button" data-site-id="' + activity.id + '" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';

            //                             var html = "<li style='display:inline-flex;'>"
            //                                 + "<input type='hidden' name='hdn_site_id[" + (index + 1) + "][]' value='" + activity.id + "'>"
            //                                 + "<i class='fa fa-circle-o' style='margin:6px;'></i>"
            //                                 + "<input type='hidden' name='hdn_itinerary_content[" + (index + 1) + "][]' value='" + activity.site_name + "'>"
            //                                 + "<div>" + activity.site_name + " <br>(" + act + ")</div>"
            //                                 + "<i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i>"
            //                                 + "<input type='hidden' class='activities-list' name='hdn_activities[" + (index + 1) + "][]' value=''>"
            //                                 + "</li>";

            //                             ul.append(html);
            //                         });
            //                     });
            //                 } else {
            //                     console.error("Itinerary format invalid", itinerary);
            //                 }
            //             },
            //             error: function (xhr) {
            //                 console.error("Failed to fetch itinerary", xhr.responseText);
            //             },
            //             complete: function () {
            //                $("#spinnerOverlay").css("display", "none");
            //             }
            //         });
            //     }
            // });
        // var hotels ='';
        $("#frm_1").on("click",".quotations-made",function(){
            var id = $(this).attr('data-id');
            setTimeout(function () {
                $(".qtn-city").each(function (idx) {
                    var idx = $(this).index(".qtn-city");
                    if (idx > 0) { // skip first one
                        var currentVal = $(this).val(); // ✅ current input value
                        var prevVal    = $(".qtn-city").eq(idx - 1).val();
                        var isSuburb   = $(this).attr("data-suburb");

                        console.log("Current:", currentVal, "Prev:", prevVal);

                        if (isSuburb === "false" && currentVal !== prevVal) {
                            $(this).parent().next().next("div").removeClass("hide");
                            $(this).parent().next("div").removeClass("hide");
                        } else {
                            $(this).parent().next().next("div").addClass("hide");
                            $(this).parent().next("div").addClass("hide");
                        }
                    }
                });
            }, 1000);
            $.ajax({
                url: "<?php echo site_url('admin/quotation/fetch_quotation'); ?>",
                type: "post",
                data: {'id': id },
                dataType: 'JSON',
                //contentType: false,
                //processData: false,
                success: function(data) {
                    if (data.response === "s") {           
                                         
                    try {
                        savedHotelRoomDetails = {}; // reset

                        if (data.details.saved_hotels && data.details.saved_hotels.length > 0) {
                            data.details.saved_hotels.forEach(function(hotel){
                                let parsed = {};
                                try {
                                    parsed = JSON.parse(hotel.hotel_room_details);
                                } catch(e){ console.warn("Parse error:", e); }
                                
                                savedHotelRoomDetails[hotel.hotel_id] = {
                                    id: hotel.hotel_id,
                                    name: hotel.hotel_name,
                                    category: hotel.hotel_category,
                                    rooms: parsed
                                };
                            });
                        } 
                        else if (data.details.quotation && data.details.quotation.length > 0) {
                            data.details.quotation.forEach(function(hotel){
                                let parsed = {};
                                try {
                                    parsed = JSON.parse(hotel.hotel_room_details);
                                } catch(e){ console.warn("Parse error:", e); }

                                savedHotelRoomDetails[hotel.hotel_id] = {
                                    id: hotel.hotel_id,
                                    name: hotel.hotel_name,
                                    category: hotel.hotel_category,
                                    rooms: parsed
                                };
                            });
                        }

                    } catch (e) {
                        console.warn("hotel_room_details parse error:", e);
                        savedHotelRoomDetails = {};
                    }
                    
                        if(data.details.quotation.length > 0){
                            var isEditMode = true; // ✅ We are in edit mode
                            if (isEditMode) {
                                $("#btn-add-hotels").hide();
                                $("#btn-add-more-hotel").show();
                                $("#btn_proceed_to_hotels").hide();
                                $("#btn_proceed_to_hotels_new").show();
                                $("#btn_restaurants_new").show();
                                $("#btn_restaurants").hide();
                            } else {
                                $("#btn-add-hotels").show();
                                $("#btn-add-more-hotel").hide();
                                $("#btn_proceed_to_hotels").show();
                                $("#btn_proceed_to_hotels_new").hide();
                                $("#btn_restaurants_new").hide();
                                $("#btn_restaurants").show();
                            }
                            
                            $('#btn_proceed_to_itinerary').removeClass('generate_itinerary');
                            $('#individual_btn_proceed_to_itinerary').removeClass('generate_itinerary');
                            
                            var quotation = data.details.quotation[0];
                            hotels = Array.isArray(data.details.hotels) 
                                ? data.details.hotels 
                                : Object.values(data.details.hotels || {});

                            // Save in localStorage
                            localStorage.setItem("hotels", JSON.stringify(hotels));
                            
                            console.log(hotels);
                            $("#roe").val(quotation.roe);
                            $("#origin_city").val(quotation.city_of_origin);
                            $("#flight-city-initial-arrival").val(quotation.city_of_arrival);
                            $("#flight-city-initial-airline").val(quotation.arrival_airline);
                            $("#initial-airline-departure-time,#flight-arrival").val(quotation.arrival_time);
                            $(".departure-city").val(quotation.departure_city);
                            $(".airline-search").val(quotation.departing_airline);
                            $(".airline-search-depart-time").val(quotation.departing_time);
                            var cities = quotation.city_details.split(",");
                            var no_of_nights = parseInt($("#number_of_nights").val()) || 1;
                            $("input[name='arrival_cities[]']").each(function(i,v){
                                $(this).val(cities[i]);
                            });
                            $("input[name='airport_pick_drop'][value='"+quotation.airport_pick_drop+"']").prop("checked", true);
                            
                            $(".flights-msg").eq(0).html('<span class="label-info" style="color: #FFF;padding: 2px 5px;font-weight: 500;"><strong>Arrival :</strong> '
                                + quotation.arrival_airline + ' , ' + quotation.arrival_time + '</span>');

                            $(".flights-msg").eq(no_of_nights).html('<span class="label-info" style="color: #FFF;padding: 2px 5px;font-weight: 500;"><strong>Departure :</strong> '
                                + quotation.departing_airline + ' , ' + quotation.departing_time + '</span>');


                            
                            const vehicles_arr = JSON.parse(quotation.vehicles);
                            
                            var temp_arr = [];
                            $(vehicles_arr).each(function(j,vl){
                                $("input[name='chk_vehicle[]']").each(function(i,v){
                                    if(vl.vehicle_id == $("input[name='chk_vehicle[]']").eq(i).val()){
                                        $("input[name='chk_vehicle[]']").eq(i).prop("checked",true);
                                        $("input[name='vehicle_quantity[]']").eq(i).removeAttr("disabled").val(vl.qnty);
                                        temp_arr.push(vl.vehicle_id);
                                        return false;
                                    }
                                });
                            });
                            
                            $(vehicles_arr).each(function(j,vl){
                                if(temp_arr.indexOf(vl.vehicle_id) === -1){
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= base_url(); ?>admin/quotation/get_by_id",
                                        data: { 'tname': 'transportation','id':vl.vehicle_id },
                                        dataType: "JSON",
                                        success: function (data) {
                                            if (data.response === "s") {
                                                var result = data.details.result[0];
                                                var html = '';
                                                html += '<div class="col-md-9" style="padding:8px 16px;">';
                                                html += '<span class=""><input type="checkbox" class="vehicles" name="chk_vehicle[]" data-capacity="'+result.capacity+'" value="'+result.id+'" checked> <span for=""> '+result.vehicle_name+' (Capacity : '+result.capacity+')</span>';
                                                html += '</span></div>';
                                                html += '<div class="col-md-3">';
                                                html += '<div class="mb-3">';
                                                html += '<input type="number" name="vehicle_quantity[]" class="form-control" id="" min="1" value="'+vl.qnty+'" placeholder="Enter Quantity"></div></div>';
                                                $("#add_vehicles").append(html);  
                                            }
                                        }
                                    });
                                }
                            });
                             
                        if(quotation.luggage_vehicle != ''){
                            $("input[name='luggage_vehicle'][value='yes']").prop("checked", true).trigger("click");
                            var luggage = quotation.luggage_vehicle.split(",");
                            var html = '';
                            $(luggage).each(function(i,v){  
                                var l = v.split("__");
                                html += '<div class="row"><div class="col-md-9"><span for="">'+l[0]+'</span></div>';
                                html += '<div class="col-md-3 text-center"><span for="">'+l[2]+'</span>';
                                html += '<input type="hidden" name="hdn_luggage_vehicle[]" value="'+v+'">';
                                html += '<i title="Remove" class="bi bi-x-lg luggage-remove" style="color:red;cursor: pointer;float: right;margin-top: 2px;position:relative;"></i></div></div>';
                            });
                            $("#luggage-vehicle").html(html); 
                        }else{
                            $("input[name='luggage_vehicle'][value='no']").prop("checked", true).trigger("click");
                        }

                        if(quotation.guide_details.length > 2){
                            $("input[name='guide'][value='yes']").prop("checked", true).trigger("click");
                            var guides = JSON.parse(quotation.guide_details);

                            var l = $(".guide-addition").length;
                            for(var i=1;i<l;i++){
                                $(".guide-addition").eq(i).remove();
                            }
                            $(guides).each(function(k,v){
                                if(k == 0){
                                    $(".guide-addition").eq(k).find("select").val([v.guide_languages]).select2();
                                    if(v.type){
                                        $("input[name='driver_cum_guide'][value='" + v.type + "']").prop("checked", true);
                                    }
                                }else{
                                    $("#btn-add-languages").trigger("click");  
                                    var g = v.guide_languages.split(",");                                    
                                    $(".guide-addition").eq(k).find("select").val(g).select2();
                                    $("input[name='guide_quantity[]']").eq(k).val(v.qnty);
                                    $("input[name='driver_cum_guide']").eq(k).val(v.type);
                                    if(v.type){
                                        $("input[name='driver_cum_guide'][value='" + v.type + "']").prop("checked", true);
                                    }
                                }
                            });                            
                        }
                        
                        var services = JSON.parse(quotation.mandatory_services);                        
                        if(services.length > 0){
                            var mandatory_html = '';
                            $(services).each(function(i,sr){
                                var s = sr.service.split("_|_");
                                mandatory_html += '<div class="col-md-8"><div class="form-floating mb-1">'+s[0]+'</div>';
                                mandatory_html += '<input type="hidden" name="hdn_mandatory_services[]" value="'+sr.service+'"></div>';
                                mandatory_html += '<div class="col-md-4" style="display:inline-flex;"><div class="form-floating mb-1">';
                                mandatory_html += '<input style="height:28px;" type="number" name="mandatory_services_qnty[]" class="form-control" id="" min="1" value="'+sr.qnty+'" placeholder="Enter Quantity"></div>';
                                mandatory_html += '<i title="Remove" class="bi bi-x-lg mandatory_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i></div>';
                            });
                            $("#mandatory_services").html("").append(mandatory_html);
                        }
                                                
                        var hotel_category = JSON.parse(quotation.hotel_details);
                        if(hotel_category.length > 0){
                            
                            $("input[name='hotel'][value='yes']").prop("checked", true).trigger("click");
                            $(hotel_category).each(function(k,v){
                                let index = $("input[name='hotel_category[]']").index(
                                                $("input[name='hotel_category[]'][value='"+v.category+"']")
                                            );
                                $("input[name='hotel_category[]']").eq(index).prop("checked",true);
                                $("select[name='num_comparison_hotels[]']").eq(index).removeAttr("disabled").val(v.qnty);
                            });
                            $("#btn-add-hotels").trigger("click");
                            
                            setTimeout(function () {
                                $(hotel_category).each(function(k, v) {
                                    let category = v.category.replace(/\s+/g, "_").toLowerCase();
                                    $("input[name='"+category+"_room_type[]']").each(function() {
                                        $(this)
                                            .prop("disabled", false)
                                            .closest(".chk-occupancy")
                                            .removeClass("hide");
                                    });
                                    var groupType = $("input[name='group_type']:checked").trigger("click");
                                    if (quotation.group_type === 'individual') {
                                        if (v.room_type && v.room_type.length > 0) {
                                            v.room_type.forEach(function(rt) {
                                                $("input[name='"+category+"_room_type[]'][value='"+rt+"']")
                                                    .prop("checked", true)
                                                    .prop("disabled", false)
                                                    .closest(".chk-occupancy").removeClass("hide");
                                            });
                                        }
                                    }
                                });
                            }, 300);

                            var quotation_all = data.details.quotation;
                            var c = 0;
                            var pre_category = '';
                            $(quotation_all).each(function(k,q){
                                if(pre_category != q.hotel_category){
                                    c = 0;
                                }                                
                                $("input[name='hdn_night_1_"+q.hotel_category.replaceAll(' ','_').toLowerCase()+"_ids[]']").eq(c).val(q.hotel_id);
                                $("input[name='night_1_"+q.hotel_category.replaceAll(' ','_').toLowerCase()+"[]']").eq(c).val(q.hotel_name);
                                pre_category = q.hotel_category;
                                c++;
                            });
                            
                            if(quotation.same_hotels_all_nights === 'yes'){
                                $("input[name='chk_all_hotels']").trigger("click");
                            }
                            if (quotation.group_type === 'individual') {
                                $("input[name='group_type'][value='individual']").trigger("click");
                            } else if (quotation.group_type === 'family') {
                                $("input[name='group_type'][value='family']").trigger("click");
                            }
                        }else {
                            $("input[name='hotel'][value='no']").prop("checked", true).trigger("click");
                        }
                        
                        $("#btn-add-more-hotel").on("click", function () {
                            var savedHotels = quotation.hotel_details ? JSON.parse(quotation.hotel_details) : [];
                            var categoryConfig = [];

                            if (Array.isArray(savedHotels) && savedHotels.length > 0) {
                                categoryConfig = savedHotels.map(h => ({
                                    category: h.category,
                                    qnty: parseInt(h.qnty || 1)
                                }));
                            }

                            var chk_hotel_details = '<div class="row mt-2" style="padding: 5px 1px;font-weight:600;"><div class="col-md-12"><input type="checkbox" name="chk_all_hotels" id="chk_all_hotels"> Same Hotels For All Days</div></div>';
                                
                            for (var i = 0; i < qdata.nights; i++) {
                                var nightNum = i + 1;
                                var city_name = $(".qtn-city").eq(nightNum).val();
                                var date = new Date(qdata.checkin);
                                date.setDate(date.getDate() + parseInt(i));
                                const day_Name = date.toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();

                                // Add heading if not already present
                                if ($(".hotel-row-wrapper[data-night='" + nightNum + "']").length === 0) {
                                    $(".daywise-hotel-details").append(
                                        `<div class="row col-md-12 mb-1 mt-2" style="border-top: 4px solid #fcb8b8ff;">
                                            <span class="bold mt-2" style="text-transform:capitalize;">
                                                Night ${nightNum} Hotel (${day_Name})
                                            </span>
                                        </div>`
                                    );
                                }

                                $("input[name='hotel_category[]']").each(function () {
                                    var category = $(this).val();
                                    if (!$(this).is(":checked")) return;

                                    var categoryKey = category.replaceAll(" ", "_").toLowerCase();
                                    var ele_name = `night_${nightNum}_${categoryKey}`;
                                    var containerSelector = `.hotel-row-wrapper[data-night='${nightNum}'][data-category='${category}']`;

                                    var dropdownQty = parseInt(
                                        $(`select[name='num_comparison_hotels[]']`).eq(
                                            $("input[name='hotel_category[]']").index($(this))
                                        ).val()
                                    ) || 1;

                                    var savedQtyObj = categoryConfig.find(c => c.category === category);
                                    var savedQty = savedQtyObj ? savedQtyObj.qnty : 0;

                                    var toAdd = 0;
                                    if (savedQty > 0) {
                                        if (dropdownQty > savedQty) {
                                            toAdd = dropdownQty - savedQty;
                                        } else {
                                            return; 
                                        }
                                    } else {
                                        toAdd = dropdownQty; 
                                    }

                                    if (toAdd > 0) {
                                        var newInputsHtml = '';
                                        for (var h = 0; h < toAdd; h++) {
                                            newInputsHtml += `
                                                <div class="col-md-3">
                                                    <input type="hidden" name="hdn_${ele_name}_ids[]" class="hdn-hotelids" value="">
                                                    <input type="text" data-night="${nightNum}" data-category="${category}"
                                                        name="${ele_name}[]" class="form-control daywise-hotels"
                                                        placeholder="Search Hotel In ${city_name}">
                                                </div>
                                            `;
                                        }
                                        if ($(containerSelector).length > 0) {
                                            $(containerSelector).append(newInputsHtml);
                                        } else {
                                            $(".daywise-hotel-details").append(`
                                                <div class="row mb-1 hotel-row-wrapper" data-night="${nightNum}" data-category="${category}">
                                                    <div class="col-md-2">${category}</div>
                                                    ${newInputsHtml}
                                                </div>
                                            `);
                                        }
                                    }
                                });
                            }
                        });
                        
                        const familyDetails = JSON.parse(quotation.family_details);
                            $("#familydiv").hide();
                            let familiesContainer = $('#families_container');
                            familiesContainer.empty();

                            let familyMap = {};
                            let familyTotals = {}; // 🆕 to store sum of adults/children

                            familyDetails.forEach((room) => {
                                let familyIndex = room.family_no - 1;

                                // Sum adults/children per family
                                if (!familyTotals[familyIndex]) {
                                    familyTotals[familyIndex] = { adults: 0, children: 0 };
                                }
                                familyTotals[familyIndex].adults += parseInt(room.adults);
                                familyTotals[familyIndex].children += parseInt(room.children);
                            });

                            // Now generate HTML per family
                            Object.keys(familyTotals).forEach(familyIndex => {
                                let totalAdults = familyTotals[familyIndex].adults;
                                let totalChildren = familyTotals[familyIndex].children;

                                let familyHtml = `
                                    <div class="col-md-12 mt-2 family" data-family="${familyIndex}">
                                        <div class="row mb-2" style="background-color: #f4f4f5;">
                                            <div class="col-md-2">
                                                <div class="form-floating mt-2">
                                                    <span class="bold" style="color:#4d88bb;">Family ${parseInt(familyIndex)+1} Adults</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="family_adults[]" class="form-control" value="${totalAdults}">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-floating mt-2">
                                                    <span class="bold" style="color:#4d88bb;">Family ${parseInt(familyIndex)+1} Child</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="family_child[]" class="form-control" value="${totalChildren}">
                                            </div>
                                            <div class="col-md-4">
                                                <span>Room Details</span>
                                                <button type="button" class="btn-success mt-1 add-rooms-details" title="Add" style="cursor: pointer;"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn-danger mt-1 remove-rooms-details" title="Remove" style="cursor: pointer;"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="family_container"></div>
                                    </div>`;
                                familiesContainer.append(familyHtml);
                            });
                            familyDetails.forEach((room) => {
                                let familyIndex = room.family_no - 1;
                                let roomHtml = `
                                    <div class="row mt-2 room-details">
                                        <div class="col-md-2"><div class="form-floating mt-2">
                                            <span class="bold">Room ${room.room_no} (No. of Adults)</span>
                                        </div></div>
                                        <div class="col-md-2"><input type="number" class="form-control family-adults"  name="family_${familyIndex}_adults[]" value="${room.adults}"></div>
                                        <div class="col-md-2"><div class="form-floating mt-2">
                                            <span class="bold">Room ${room.room_no} (No. of Child)</span>
                                        </div></div>
                                        <div class="col-md-2"><input type="number" class="form-control family-child"  name="family_${familyIndex}_child[]" value="${room.children}"></div>
                                        <div class="col-md-4"></div>
                                    </div>`;
                                $(`.family[data-family="${familyIndex}"] .family_container`).append(roomHtml);
                            });
                            
                            
        $("#btn_proceed_to_hotels_new").on("click", function () {
            // 1️⃣ Validate family details
            var total_adults_num = parseInt($("#number_of_adults").val() || 0, 10);
            var adult_num = 0;
            var total_child_num = parseInt($("#number_of_child").val() || 0, 10);
            var child_num = 0;

            $(".family-adults").each(function () { adult_num += parseInt($(this).val() || 0, 10); });
            $(".family-child").each(function () { child_num += parseInt($(this).val() || 0, 10); });

            if (adult_num != total_adults_num || child_num != total_child_num) {
                alert("Please Enter Complete Family Details. Total Adults: " + total_adults_num + " Total Child: " + total_child_num);
                return false;
            }

            $("#quotation-make-1, #quotation-make-2, #quotation-make-3").hide();
            $("#quotation-make-4").css("display", "flex");
            $("#create_quotation").fadeIn(1000);
            $("#hotel-categories, #hotel-categories-individual").html("");

            var div_ids_arr = [];
            var nights = $("#chk_all_hotels").is(':checked') ? 1 : qdata.nights;

            // --- Helpers ---
            const findSavedRooms = (hotelId, categoryName) => {
                if (!savedHotelRoomDetails || !savedHotelRoomDetails[hotelId]) return [];
                let roomsObj = savedHotelRoomDetails[hotelId].rooms;
                try {
                    const parsed = JSON.parse(roomsObj);
                    for (const key in parsed) {
                        const keyCategory = key.split("_").slice(1).join("_").trim().toLowerCase(); // remove hotel id prefix
                        if (keyCategory === categoryName.trim().toLowerCase()) {
                            return parsed[key]; // array of saved rooms for this category
                        }
                    }
                } catch (e) {
                    console.warn("Error parsing rooms for hotel", hotelId, e);
                }
                return [];
            };

            const isCategoryChecked = (hotelId, categoryName) => {
                return findSavedRooms(hotelId, categoryName).length > 0;
            };

            // 3️⃣ Build hotel category columns (first night)
            var previous_category = '';
            for (var j = 1; j <= 1; j++) {
                $("input[name='hotel_category[]']:checked").each(function () {
                    var category = this.value;
                    $("input[name='hdn_night_" + j + "_" + category.replaceAll(" ", "_").toLowerCase() + "_ids[]']").each(function (index) {
                        var h = (previous_category && previous_category !== category) ? 
                                '<div class="w-100 d-none d-md-block mb-4" style="border: 1px solid;"></div>' : '';
                        var div_html = h + '<div class="col-md-6 scrollbar" style="padding:0px 25px;height: 500px; overflow-y: auto;" id="' + category.replaceAll(" ", "_").toLowerCase() + '_' + index + '"><span class="bold mt-4">' + category + ' (Hotel Option ' + (index + 1) + ')</span></div>';
                        $("#hotel-categories").append(div_html);
                        previous_category = category;
                        div_ids_arr.push(category.replaceAll(" ", "_").toLowerCase() + '_' + index);
                    });
                });
            }

            // 4️⃣ Fetch hotel prices & render checkboxes
            for (var j = 1; j <= nights; j++) {
                $("input[name='hotel_category[]']:checked").each(function () {
                    var category = this.value;
                    $("input[name='hdn_night_" + j + "_" + category.replaceAll(" ", "_").toLowerCase() + "_ids[]']").each(function (ids_index) {
                        var hotel_id = $(this).val();
                        var div_to_append_id = category.replaceAll(" ", "_").toLowerCase() + '_' + ids_index;
                        let hotelName = (savedHotelRoomDetails[hotel_id] && savedHotelRoomDetails[hotel_id].name) || "Hotel";

                        $.ajax({
                            url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                            type: "post",
                            data: { hotel_id, check_in: qdata.checkin, check_out: qdata.checkout, type: category, room_type: '' },
                            dataType: 'JSON',
                            async: false,
                            success: function (data) {
                                if (data.response === "s" && data.details.result.length > 0) {
                                    var html = '<div class="row" style="color:#FFF;background-color:#49a6f5;font-size:14px;font-weight:600;border-radius:10px;">' +
                                            '<div class="col-md-12">' + hotelName + '</div></div>';
                                    html += '<div class="row"><div class="offset-9 col-md-2" style="text-align:right;">Rooms</div></div>';

                                    $.each(data.details.result, function (i, val) {
                                        var r_num = Math.random().toString().split(".")[1];
                                        html += '<div class="row mt-2" style="border-bottom:2px solid #000;">';

                                        let savedCatRooms = findSavedRooms(hotel_id, val.category_name);
                                        // let categoryChecked = isCategoryChecked(hotel_id, val.category_name);

                                        // html += '<div class="col-md-5 div-category"><label class="bold">' +
                                        //     '<input type="checkbox" id="chk_' + val.id + '_' + hotel_id + '" ' +
                                        //     'value="' + val.id + '_' + val.category_name + '" ' +
                                        //     'name="night_' + j + '_category_ids_' + hotel_id + '[]" ' +
                                        //     (categoryChecked ? "checked" : "") + '> ' + val.category_name + '</label></div>';
                                    let savedRoomsObj = savedHotelRoomDetails && savedHotelRoomDetails[hotel_id] ? JSON.parse(savedHotelRoomDetails[hotel_id].rooms || '{}') : {};
                                    let categoryChecked = false;
                                    for (const key in savedRoomsObj) {
                                        let keyCategory = key.split("_").slice(1).join("_").trim().toLowerCase();
                                        if (keyCategory === val.category_name.trim().toLowerCase() && savedRoomsObj[key].length > 0) {
                                            categoryChecked = true;
                                            break;
                                        }
                                    }
                                    if (!(savedHotelRoomDetails && savedHotelRoomDetails[hotel_id])) {
                                        let hotel_prices = (val.details || "").split(",");
                                        let minPrice = Infinity;
                                        hotel_prices.forEach(p => {
                                            let price = parseFloat((p || "").trim().split(" ")[1] || 0);
                                            if (!isNaN(price) && price < minPrice) minPrice = price;
                                        });
                                        if (i === 0) categoryChecked = true;
                                    }

                                    html += '<div class="col-md-5 div-category"><label class="bold">' +
                                        '<input type="checkbox" id="chk_' + val.id + '_' + hotel_id + '" ' +
                                        'value="' + val.id + '_' + val.category_name + '" ' +
                                        'name="night_' + j + '_category_ids_' + hotel_id + '[]" ' +
                                        (categoryChecked ? "checked" : "") + '> ' + val.category_name + '</label></div>';

                                        // Room prices
                                        html += '<div class="col-md-5 mb-1"><div class="row">';
                                        var hotel_prices = (val.details || "").split(",");
                                        var persons_arr = [];

                                        $.each(hotel_prices, function (i, v) {
                                            var vTrim = (v || "").trim();
                                            if (!vTrim) return;
                                            var personToken = vTrim.split(" ")[0];
                                            var priceToken = vTrim.split(" ")[1] || "";
                                            persons_arr.push(personToken);

                                            // ✅ Room type checkbox checked logic
                                            let checked = savedCatRooms.some(sr => (sr.room_type || []).some(rt => rt.trim() === vTrim.trim())) ? "checked" : "";

                                            html += '<div class="col-md-3 p-1">' +
                                                '<input type="checkbox" class="chk-prices" data-person="' + personToken + '" ' +
                                                'data-id="' + val.id + '_' + hotel_id + '" value="' + vTrim + '" ' +
                                                'name="night_' + j + '_' + val.id + '_' + hotel_id + '_hotel_prices[0][]" ' + checked + '> ' +
                                                '<span>' + personToken + '</span>' +
                                                '<input type="textbox" style="width:100%;" class="chk-prices-input" ' +
                                                'name="' + val.id + '_' + hotel_id + '_hotel_prices_input[][]" value="' + priceToken + '">' +
                                                '</div>';
                                        });

                                        html += '<input type="hidden" class="chk-prices-all-night-' + j + '" value="' + persons_arr.join(",") + '" data-chkid="' + val.id + '_' + hotel_id + '">';

                                        let restoredRoomCnt = (savedCatRooms.length > 0) ? parseInt(savedCatRooms[0].room_count || 1, 10) : 1;

                                        html += '</div></div><div class="col-md-2" style="display:flex;">' +
                                            '<input type="number" min="1" class="rooms-cnt rooms_cnt_' + val.id + r_num + '" ' +
                                            'style="width:65%;height:27px;" value="' + restoredRoomCnt + '" ' +
                                            'name="' + val.id + '_room_cnt[]">' +
                                            '<span class="span_btn" style="margin-left:3px;">' +
                                            '<button type="button" data-id="' + val.id + r_num + '" ' +
                                            'style="background-color:#0a87f5;color:#FFF;height:25px;cursor:pointer;float:right;padding:0px 5px;" class="add btn-primary">+</button></span>' +
                                            '</div></div><div class="col-md-1"></div></div>';
                                    });

                                    $("#" + div_to_append_id).append(html);
                                }
                            }
                        });
                    });
                });
            }

            $.each(div_ids_arr, function (index, id) {
                var msg = false, pending_rooms_arr = [];
                for (var j = 1; j <= nights; j++) {
                    var rooms_arr = [];
                    $("input[name='family_adults[]']").each(function (index, obj) {
                        $("input[name='family_" + (index + 1) + "_adults[]']").each(function (idx, ob) {
                            var room_persons = ($(this).val() || "0") + "(A)";
                            if ($("input[name='family_" + (index + 1) + "_child[]']").eq(idx).val() != "" &&
                                $("input[name='family_" + (index + 1) + "_child[]']").eq(idx).val() != "0") {
                                for (var i2 = 1; i2 <= $("input[name='family_" + (index + 1) + "_child[]']").eq(idx).val(); i2++) {
                                    room_persons += ",1(C)";
                                }
                            }
                            rooms_arr.push(room_persons);
                        });
                    });
                    rooms_arr.sort();

                    $("#" + id).find(".chk-prices-all-night-" + j).each(function (n, v) {
                        if (n > 0 && pending_rooms_arr.length == 0) return false;
                        else if (pending_rooms_arr.length > 0) { rooms_arr = pending_rooms_arr; pending_rooms_arr = []; }

                        var arr_all = $(this).val().split(",");
                        var data_idx = $(this).attr("data-chkid");
                        var previous_val = '';
                        var room_cnt_idx = n;

                        $.each(rooms_arr, function (i3, obj) {
                            msg = false; var flag = 0;

                            if (previous_val == obj) {
                                var vl = $("#" + id).find(".rooms-cnt").eq(room_cnt_idx).val();
                                $("#" + id).find(".rooms-cnt").eq(room_cnt_idx).val(parseInt(vl) + 1);
                                flag = 1; previous_val = obj;
                            }

                            if (flag == 0) {
                                var q = obj.split(",");
                                let allPresent = q.every(val => arr_all.includes(val));

                                if (allPresent && i3 == 0) {
                                    var child_idx = 0;
                                    $.each(q, function (w, ob) {
                                        var idx_num = (ob == "1(C)") ? child_idx : 0;
                                        const checkbox = document.querySelectorAll('input[name="night_' + j + '_' + data_idx + '_hotel_prices[' + i3 + '][]"][data-person="' + ob + '"][data-id="' + data_idx + '"]');
                                        if (checkbox && checkbox.length) {
                                            checkbox[idx_num].checked = true;
                                            $("#chk_" + data_idx).prop("checked", true);
                                            if (ob == "1(C)") child_idx++;
                                        }
                                    });
                                    previous_val = obj;
                                } else if (allPresent && i3 > 0) {
                                    var d = $("#" + id).find(".add").eq(n).attr("data-id");
                                    new_row(d, obj, arr_all, data_idx, j);
                                    flag = 1; room_cnt_idx++; previous_val = obj;
                                } else { pending_rooms_arr.push(obj); msg = true; }
                            }
                        });
                    });
                }
                if (msg) $("#" + id).css("border", "3px solid #ff0909");
            });
        });


                            var quotation = data.details.quotation[0];
                            sites = Array.isArray(data.details.sites_table_data) ? data.details.sites_table_data : [];
                            var itinerary_details = JSON.parse(quotation.itinerary_details);
                            var itinerary_html2 = '';

                                if (Object.keys(itinerary_details).length > 0) {
                                $.each(itinerary_details, function(dayKey, data) {
                                    var i = parseInt(dayKey.split('_').pop());
                                    var dayNumber = i + 1;
                                    var firstDay = localStorage.getItem('firstDay');
                                    var lastDay = localStorage.getItem('lastDay');
                                    var airport_pick_drop = $("input[name='airport_pick_drop']:checked").val();

                                    itinerary_html2 += '<div class="mb-1">';
                                    itinerary_html2 += '<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse' + dayNumber + '" aria-expanded="true" aria-controls="collapse' + dayNumber + '">';
                                    itinerary_html2 += '<span class="bold itinerary_date" style="padding:5px;display:inline-flex;">Day : ' + dayNumber + '</span></a>';
                                    itinerary_html2 += '<ul id="collapse' + dayNumber + '" class="panel-collapse collapse in itinerary_ul" style="background-color:inherit;display:grid;">';
                                     // 👉 If it's the FIRST DAY → Add Pick-up / Arrival
                                    if (i === 0) {
                                        itinerary_html2 += "<li style='list-style-type: circle'>" + firstDay +"</li>";
                                        if (airport_pick_drop === "yes") {
                                             itinerary_html2 += "<li style='display:inline-flex;'>"
                                                + "<div><strong><li style='list-style-type: circle'>Airport Pick</li></div>"
                                                + "</li>";
                                        }
                                    }
                                    if (Array.isArray(data.itinerary)) {
                                        data.itinerary.forEach(function(activity) {
                                            var site_id = activity.site_id;
                                            var siteData = sites.find(site => site.id == site_id);
                                            
                                            if (siteData) {
                                                var act = 'Entry Fee: ' + (siteData.entry_ticket_fee || '0') + ' (A) ' +
                                                        (siteData.child_entry_ticket_fee || '0') + ' (C) | ' +
                                                        'Start Time: ' + (siteData.departing_time_from_hotel || '0') + ' | ' +
                                                        'Duration: ' + (siteData.duration_hours || '0') + 'h ' +
                                                        (siteData.duration_minutes || '0') + 'm ' +
                                                        '<button type="button" data-site-id="' + siteData.id + '" class="btn btn-sm btn-link activities" style="padding:0;">Add Activities</button>';

                                                itinerary_html2 += "<li style='display:inline-flex;'>"
                                                    + "<input type='hidden' name='hdn_site_id[" + i + "][]' value='" + siteData.id + "'>"
                                                    + "<i class='fa fa-circle-o' style='margin:6px;'></i>"
                                                    + "<input type='hidden' name='hdn_itinerary_content[" + i + "][]' value='" + siteData.site_name + "'>"
                                                    + "<div>" + siteData.site_name + " <br>(" + act + ")</div>"
                                                    + "<i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor:pointer;float:right;margin-top:5px;position:relative;'></i>"
                                                    + "<input type='hidden' class='activities-list' name='hdn_activities[" + i + "][]' value=''>"
                                                    + "</li>";
                                            }
                                        });
                                    }

                                     if (i === Object.keys(itinerary_details).length - 1) {
                                        itinerary_html2 += "<li style='list-style-type: circle'>" + lastDay +"</li>";
                                        if (airport_pick_drop === "yes") {
                                            itinerary_html2 += "<li style='display:inline-flex;'>"
                                            + "<div><strong><li style='list-style-type: circle'>Airport Drop</li></div>"
                                            + "</li>";
                                        }
                                    }

                                    itinerary_html2 += '</ul>';
                                    itinerary_html2 += '<input type="text" class="form-control add-itinerary mt-2" placeholder="Search & Add Itinerary" data-day="' + dayNumber + '">';
                                    itinerary_html2 += '</div>';
                                });

                                $(".timeline").html(itinerary_html2);
                            }
                        }
                        else 
                            { 
                            html = 'No Prices Found';
                        }
                    } 
                }
            });
        });
        $("#add_mandatory_services").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/quotation/get_mandatory_services",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        'location': qdata.qno,
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                var no_of_nights = parseInt($("#number_of_nights").val()) || 1;
                var no_of_guests = (parseInt($("#number_of_adults").val()) || 0) + (parseInt($("#number_of_child").val()) || 0);

                let quantity = parseInt(ui.item.quantity) || 1;
                let cost_by = ui.item.cost_by ? ui.item.cost_by.toLowerCase() : 'entire_trip';
                let group_type = ui.item.group_type ? ui.item.group_type.toLowerCase() : 'per_group';
                let adjusted_quantity = quantity;

                if (cost_by === 'per_day') {
                    adjusted_quantity *= no_of_nights;
                }
                if (group_type === 'per_person') {
                    adjusted_quantity *= no_of_guests;
                }
                var mandatory_html = '';
                mandatory_html += '<div class="col-md-8"><div class="form-floating mb-1">' + ui.item.label + '</div>';
                mandatory_html += '<input type="hidden" name="hdn_mandatory_services[]" value="' + ui.item.label + '_|_' + ui.item.price + '"></div>';
                mandatory_html += '<div class="col-md-4" style="display:inline-flex;"><div class="mb-1">';
                mandatory_html += '<input style="height:28px;" type="number" name="mandatory_services_qnty[]" class="form-control" min="' + adjusted_quantity + '" value="' + adjusted_quantity + '" placeholder="Enter Quantity"></div>';
                mandatory_html += '<i title="Remove" class="bi bi-x-lg mandatory_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i></div>';
                $("#mandatory_services").append(mandatory_html);
            }
        });
        // $("#add_mandatory_services").autocomplete({
        //     source: function(request, response) {
        //         // Fetch data
        //         $.ajax({
        //             url: "<?= base_url() ?>admin/quotation/get_mandatory_services",
        //             type: 'post',
        //             dataType: "json",
        //             data: {
        //                 search: request.term,
        //                 'location': qdata.qno,                        
        //             },
        //             success: function(data) {
        //                 response(data);							
        //             }
        //         });
        //     },
        //     select: function(event, ui) {
        //         var mandatory_html = '';
        //         mandatory_html += '<div class="col-md-8"><div class="form-floating mb-1">'+ui.item.label+'</div>';
        //         mandatory_html += '<input type="hidden" name="hdn_mandatory_services[]" value="'+ui.item.label+'_|_'+ui.item.price+'"></div>';
        //         mandatory_html += '<div class="col-md-4" style="display:inline-flex;"><div class="form-floating mb-1">';
        //         mandatory_html += '<input style="height:28px;" type="number" name="mandatory_services_qnty[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity"></div>';
        //         mandatory_html += '<i title="Remove" class="bi bi-x-lg mandatory_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i></div>';
        //         $("#mandatory_services").append(mandatory_html);                
        //     }
        // });

        // ---------- helpers ----------
        function findNightHeader(night) {
            return $(".daywise-hotel-details .row").filter(function () {
                var $span = $(this).children("span").first();
                return $span.length && $span.text().indexOf("Night " + night + " ") !== -1;
            }).first();
        }

        function findCategoryRow(night, category) 
        {   
            var $inputs = $(".daywise-hotel-details input.daywise-hotels[data-night='" + night + "'][data-category='" + category + "']");
            if ($inputs.length) return $inputs.first().closest(".row");

            var $start = findNightHeader(night);
            if (!$start.length) return $();

            var $nextHeader = $start.nextAll(".row").filter(function () {
                var $span = $(this).children("span").first();
                return $span.length && $span.text().indexOf("Night ") === 0;
            }).first();

            var $scope = $nextHeader.length ? $start.nextUntil($nextHeader) : $start.nextAll();

            return $scope.filter(function () {
                var $firstCell = $(this).children(".col-md-2").first();
                return $firstCell.length && $.trim($firstCell.text()) === category;
            }).first();
        }

        function sortNightCategoriesByStar($nightHeader){
            var orderMap = {"3 star":0, "4 star":1, "5 star":2, "5 star luxury":3};

            var $nextHeader = $nightHeader.nextAll(".row").filter(function(){
                var $span = $(this).children("span").first();
                return $span.length && /^night\s/i.test($.trim($span.text()));
            }).first();

            var $scope = $nextHeader.length ? $nightHeader.nextUntil($nextHeader) : $nightHeader.nextAll();

            var $catRows = $scope.filter(function(){
                var txt = $.trim($(this).children(".col-md-2").first().text()).toLowerCase();
                return orderMap.hasOwnProperty(txt);
            });

            var rows = $catRows.get().sort(function(a,b){
                var at = $.trim($(a).children(".col-md-2").first().text()).toLowerCase();
                var bt = $.trim($(b).children(".col-md-2").first().text()).toLowerCase();
                return orderMap[at] - orderMap[bt];
            });

            var $after = $nightHeader;
            $(rows).each(function(){
                $(this).insertAfter($after);
                $after = $(this);
            });
        }


        // ---------- category toggle ----------
        $(document).on("change", "[name='hotel_category[]']", function () {
        var $line = $(this).closest(".row");
        var category = $(this).val();
        var categoryKey = category.replaceAll(" ", "_").toLowerCase();
        var $select = $line.find("select[name='num_comparison_hotels[]']");
        var $occ    = $line.find(".chk-occupancy input[type='checkbox']");
        var allowed = parseInt($select.val() || 0, 10);

        if ($(this).is(":checked")) {
            $select.prop("disabled", false);

            if ($('input[name="group_type"]:checked').val() === "individual") {
            $occ.prop("disabled", false);
            }

            for (var night = 1; night <= qdata.nights; night++) {
            var $catRow = findCategoryRow(night, category);
            if (!$catRow.length) {
                var $nightHeader = findNightHeader(night);
                if ($nightHeader.length) {
                var city_name = $(".qtn-city").eq(night).val() || "";
                var html = '<div class="row mb-1">' +
                            '<div class="col-md-2">' + category + '</div>';
                for (var k = 0; k < allowed; k++) {
                    html += '<div class="col-md-3">' +
                            '<input type="hidden" name="hdn_night_' + night + '_' + categoryKey + '_ids[]" class="hdn-hotelids" value="">' +
                            '<input type="text" data-night="' + night + '" data-category="' + category + '"' +
                                ' name="night_' + night + '_' + categoryKey + '[]"' +
                                ' class="form-control daywise-hotels"' +
                                ' placeholder="Search Hotel In ' + city_name + '">' +
                            '</div>';
                }
                html += '</div>';

                $nightHeader.after(html);
                sortNightCategoriesByStar($nightHeader);
                }
            }
            }

        } else {
            $select.prop("disabled", true);

            if ($('input[name="group_type"]:checked').val() === "individual") {
            $occ.prop("disabled", true).prop("checked", false);
            }
            $(".daywise-hotel-details .row").filter(function () {
            var $firstCell = $(this).children(".col-md-2").first();
            return $firstCell.length && $.trim($firstCell.text()) === category;
            }).remove();
        }
        });


        // ---------- hotel options count change (only adjust saved rows) ----------
        $(document).on("change", "[name='num_comparison_hotels[]']", function () {
        var allowed  = parseInt($(this).val() || 0, 10);
        var $line    = $(this).closest(".row");
        var category = $line.find("[name='hotel_category[]']").val();
        var categoryKey = category.replaceAll(" ", "_").toLowerCase();

        for (var night = 1; night <= qdata.nights; night++) {
            var $catRow = findCategoryRow(night, category);
            if (!$catRow.length) continue; 

            var $inputs = $catRow.find("input.daywise-hotels[data-night='" + night + "'][data-category='" + category + "']");
            var current = $inputs.length;

            if (current > allowed) {
            $catRow.find(".col-md-3").slice(allowed).remove();
            }

            if (current < allowed) {
            var city_name = $(".qtn-city").eq(night).val() || ""; 
            for (var k = current; k < allowed; k++) {
                $catRow.append(
                '<div class="col-md-3">' +
                    '<input type="hidden" name="hdn_night_' + night + '_' + categoryKey + '_ids[]" class="hdn-hotelids" value="">' +
                    '<input type="text" data-night="' + night + '" data-category="' + category + '"' +
                    ' name="night_' + night + '_' + categoryKey + '[]"' +
                    ' class="form-control daywise-hotels"' +
                    ' placeholder="Search Hotel In ' + city_name + '">' +
                '</div>'
                );
            }
            }
        }

        if ($("#chk_all_hotels").is(":checked")) {
            var $baseRow = findCategoryRow(1, category);
            if ($baseRow.length) {
            var $baseVals = $baseRow.find("input.daywise-hotels[data-night='1'][data-category='" + category + "']");
            var $baseIds  = $baseRow.find("input.hdn-hotelids[name='hdn_night_1_" + categoryKey + "_ids[]']");

            for (var night2 = 2; night2 <= qdata.nights; night2++) {
                var $row2   = findCategoryRow(night2, category);
                if (!$row2.length) continue;

                var $vals2  = $row2.find("input.daywise-hotels[data-night='" + night2 + "'][data-category='" + category + "']");
                var $ids2   = $row2.find("input.hdn-hotelids[name='hdn_night_" + night2 + "_" + categoryKey + "_ids[]']");

                $baseVals.each(function (i) { $vals2.eq(i).val($(this).val()); });
                $baseIds.each(function (i)  { $ids2.eq(i).val($(this).val());  });
            }
            }
        }
        });


        $("#btn-add-hotels").on("click",function(){
            event.preventDefault();
            var flag = true;
            if($('input[name="group_type"]:checked').val() === "individual"){
                $("input[name='hotel_category[]']").each(function (index) {                
                    if (this.checked) {
                        var v = this.value;
                        if ($('input[name="'+v.replaceAll(" ","_").toLowerCase()+'_room_type[]"]:checked').length === 0) {
                            flag = false;
                            alert("Select Atleast One Occupancy Type For Category "+v+" To Proceed.");
                            return false;
                        }                    
                    }                
                });
            }
            if (!flag) 
            {
                return false;
            }

            var chk_hotel_details = '<div class="row mt-2" style="padding: 5px 1px;font-weight:600;"><div class="col-md-12"><input type="checkbox" name="chk_all_hotels" id="chk_all_hotels"> Same Hotels For All Days</div></div>';
            var hotel_details = '';
                        
            for(var i=0;i<qdata.nights;i++){ 
                var date = new Date(qdata.checkin);
                date.setDate(date.getDate() + parseInt(i));
                const day_Name = new Date(date).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
                //console.log(day_Name);
                var html = '<div class="row col-md-12 mb-1 mt-2" style="border-top: 4px solid #FFF;"><span class="bold mt-2" style="text-transform:capitalize;">Night '+(i+1)+' Hotel ('+day_Name+')</span></div>';
                var city_name = $(".qtn-city").eq(i+1).val();
                $("[name='hotel_category[]']").each(function(){
                    var ele_name = 'night_'+(i+1)+'_';
                    if($(this).prop("checked")){
                        var idx = $(this).index("[name='hotel_category[]']");
                        var num_hotels = $("[name='num_comparison_hotels[]']").eq(idx).val();
                        
                        html +='<div class="row mb-1"><div class="col-md-2">'+$(this).val()+'</div>';
                        ele_name = ele_name+$(this).val().replaceAll(" ","_");
                        for(var j=1;j<=num_hotels;j++)
                        {
                            html +='<div class="col-md-3">';
                            html +='<input type="hidden" name="hdn_'+ele_name.toLowerCase()+'_ids[]" class="hdn-hotelids" value="">';
                            html +='<input type="text" data-night="'+(i+1)+'" data-category="'+$(this).val()+'" name="'+ele_name.toLowerCase()+'[]" class="form-control daywise-hotels" id="" placeholder="Search Hotel In '+city_name+'"></div>';
                        }
                        html +='</div>';
                    }
                });
                hotel_details += html;
                if(i===0){
                    hotel_details += chk_hotel_details;
                }              
            }
            $(".daywise-hotel-details").html(hotel_details);
        });
        
    
        
        /*$("#frm_1").on("change","#num_comparison_hotels",function(){
            var l = $('.hdn-hotelids-cnt').length;
            for(var i=0;i<l;i++){
                $('input[name="hdn_hotel_ids_'+i+'[]"]').eq(1).addClass("hide").val("");
                $('input[name="hotel_names_'+i+'[]"]').eq(1).addClass("hide").val("");
                $('input[name="hdn_hotel_ids_'+i+'[]"]').eq(2).addClass("hide").val("");
                $('input[name="hotel_names_'+i+'[]"]').eq(2).addClass("hide").val("");
            }
            if($("#num_comparison_hotels option:selected").val() == "2"){
                for(var i=0;i<l;i++){
                    $('input[name="hdn_hotel_ids_'+i+'[]"]').eq(1).removeClass("hide").val("");
                    $('input[name="hotel_names_'+i+'[]"]').eq(1).removeClass("hide").val("");
                }
            }else if($("#num_comparison_hotels option:selected").val() == "3"){
                for(var i=0;i<l;i++){
                    $('input[name="hdn_hotel_ids_'+i+'[]"]').eq(1).removeClass("hide").val("");
                    $('input[name="hotel_names_'+i+'[]"]').eq(1).removeClass("hide").val("");
                    $('input[name="hdn_hotel_ids_'+i+'[]"]').eq(2).removeClass("hide").val("");
                    $('input[name="hotel_names_'+i+'[]"]').eq(2).removeClass("hide").val("");
                }
            }
        });*/
        
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
                $(".meals").eq(idx).val("");
                $(".meals_type").eq(idx).val("");
                return false;
            }
            if($(".meals").eq(idx).val() === "" || $(".meals_type").eq(idx).val() === ""){
                return false;
            }
            var restaurant_id = $(".hdn-restaurants").eq(idx).val();
            var meals = $(".meals").eq(idx).val();
            var meals_type = $(".meals_type").eq(idx).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/quotation/get_restaurants_prices",
                data: {
                    'restaurant_id': restaurant_id,'meals':meals,'meals_type':meals_type
                },
                dataType: "JSON",
                success: function (data) {
                    $(".adult-price").eq(idx).val(data.details.adult_price);
                    $(".child-price").eq(idx).val(data.details.child_price);
                }
            });            
        });
        
        // $("#frm_1").on("click","#chk_all_hotels",function(){     
        //       var hotels = JSON.parse(localStorage.getItem('hotels')) || {};
        //       console.log(hotels,'hoteslss');

        //     const night1City = $(".qtn-city").eq(1).val();
        //     for(var i=2;i<=qdata.nights;i++){
        //         const nightCity = $(".qtn-city").eq(i).val();
        //         if (nightCity !== night1City) continue;
        //         var e = '';
        //         $("input[name='hotel_category[]']:checked").map(function () {
        //             e = this.value.replaceAll(" ","_").toLowerCase();
        //             $('input[name="hdn_night_1_'+e+'_ids[]"]').each(function(index, element) {
        //                 if ($('#chk_all_hotels').prop('checked')) {
        //                     $('input[name="hdn_night_'+i+'_'+e+'_ids[]"]').eq(index).val($(element).val());
        //                 }else{
        //                     $('input[name="hdn_night_'+i+'_'+e+'_ids[]"]').eq(index).val("");
        //                 }
        //             });
                    
        //             $('input[name="night_1_'+e+'[]"]').each(function(index, element) {
        //                 if ($('#chk_all_hotels').prop('checked')) {
        //                     $('input[name="night_'+i+'_'+e+'[]"]').eq(index).val($(element).val());
        //                 }else{
        //                     $('input[name="night_'+i+'_'+e+'[]"]').eq(index).val("");
        //                 }
        //             });                    
        //         }).get();
        //     }
            
        // });
        
        // define globally (outside)
        let disableChildCheck = false;

        // If quotation-made button is clicked → disable logic
        $(document).on("click", ".quotations-made", function() {
            disableChildCheck = true;
        });

        // checkbox click event
        $("#frm_1").on("click", "#chk_all_hotels", function () {
            const isChecked = $(this).prop('checked');
            const hotels = JSON.parse(localStorage.getItem('hotels')) || [];
            const night1City = $(".qtn-city").eq(1).val();
            if (isChecked) {
                let day1HotelEmpty = true;
                $('input.daywise-hotels[data-night="1"]').each(function () {
                    if ($(this).val().trim() !== "") {
                        day1HotelEmpty = false;
                        return false;
                    }
                });
                if (day1HotelEmpty) {
                    alert("Please select at least one hotel for Night 1 before checking all hotels.");
                    $(this).prop("checked", false);
                    return false;
                }
            }
            for (let i = 2; i <= qdata.nights; i++) {
                const nightCity = $(".qtn-city").eq(i).val();

                $("input[name='hotel_category[]']:checked").each(function () {
                    let e = this.value.replaceAll(" ", "_").toLowerCase();

                    if (!disableChildCheck) {
                        // 🔹 Previous functionality (old code)
                        if (nightCity !== night1City) return;

                        $('input[name="hdn_night_1_' + e + '_ids[]"]').each(function (index, element) {
                            $('input[name="hdn_night_' + i + '_' + e + '_ids[]"]').eq(index).val(isChecked ? $(element).val() : "");
                        });

                        $('input[name="night_1_' + e + '[]"]').each(function (index, element) {
                            $('input[name="night_' + i + '_' + e + '[]"]').eq(index).val(isChecked ? $(element).val() : "");
                        });

                    } else {
                        // 🔹 New functionality (quotation-made mode)
                        if (nightCity === night1City) {
                            // Same city → copy from night 1
                            $('input[name="hdn_night_1_' + e + '_ids[]"]').each(function (index, element) {
                                $('input[name="hdn_night_' + i + '_' + e + '_ids[]"]').eq(index).val(isChecked ? $(element).val() : "");
                            });

                            $('input[name="night_1_' + e + '[]"]').each(function (index, element) {
                                $('input[name="night_' + i + '_' + e + '[]"]').eq(index).val(isChecked ? $(element).val() : "");
                            });
                        } else {
                            // Different city → load its own hotels from localStorage
                            const nightHotels = hotels.filter(h => h.night == i && h.hotel_category.toLowerCase() === this.value.toLowerCase());

                            if (nightHotels.length > 0) {
                                $('input[name="hdn_night_' + i + '_' + e + '_ids[]"]').each(function (index, element) {
                                    $(element).val(nightHotels[index] ? nightHotels[index].hotel_id : "");
                                });

                                $('input[name="night_' + i + '_' + e + '[]"]').each(function (index, element) {
                                    $(element).val(nightHotels[index] ? nightHotels[index].hotel_name : "");
                                });
                            }
                        }
                    }
                });
            }
        });
                
        $("[name=hotel]").on("click",function(){
            //($(this).val()=='yes')?$("#hotel-details").fadeIn(1000):$("#hotel-details").fadeOut(1000);
            $("[name='hotel_category[]']").prop("checked",false);
            //$("[name='room_type[]']").prop("checked",false);
            function runChildCheck() {
                if (disableChildCheck) {
                    // console.log("Child check disabled because quotation-made was clicked.");
                    return; // stop execution
                }

                var child_data = $("#number_of_child").val();
                if (child_data == 0) {
                    $("[name='group_type'][value='individual']").trigger("click");
                } else {
                    $("[name='group_type'][value='family']").trigger("click");
                }
            }

            runChildCheck();
            
            if($(this).val() === "yes"){ 
                //$(".daywise-hotels").removeAttr("disabled");
                $("#btn-add-hotels").removeAttr("disabled").css("cursor","pointer").addClass("btn-primary").removeClass("btn-danger");
                $(".markup-split").slideDown("1000");
                $("[name='hotel_category[]']").each(function(){
                    if($(this).val() === "4 Star"){
                        $(this).prop("checked","checked");
                    }
                });
                /*$("[name='room_type[]']").each(function(){
                    if($(this).val() === "single" || $(this).val() === "twin"){
                        //$(this).prop("checked","checked");
                    }
                });*/
                $("#markup_percentage").val(15);   
                $(".hotel-options").slideDown("1000");
            }else{ 
                //$(".daywise-hotels").attr("disabled","disabled");
                $(".daywise-hotel-details").html("");
                $("#btn-add-hotels").attr("disabled","disabled").css("cursor","no-drop").addClass("btn-danger").removeClass("btn-primary");
                $('input[type=radio][name="markup_split"][value="no"]').prop("checked","checked").trigger("click");
                $(".markup-split").slideUp("1000");
                $("#markup_percentage").val(30);
                $(".hotel-options").slideUp("1000");
            }
            $(".child-age").html("").html(option_html);
            /*if($(this).val()=='yes'){
                $("#create_quotation").fadeOut(1000);
                $("#btn_hotel").removeClass("hide").fadeIn(1000);
            }else{
                $("#create_quotation").fadeIn(1000);
                $("#btn_hotel").fadeOut(1000);
            }
            $(".daywise-hotels").each(function(index, element) {
                var city_idx = get_index(index);
                $(".daywise-hotels").eq(index).attr("placeholder","Hotels In "+$(".qtn-city").eq(city_idx+1).val());
            });*/
        });
	
        $("[name='hotel_category[]']").on("click",function(){
            var index = $("[name='hotel_category[]']").index(this);
            var isChecked = $(this).is(':checked');
            var v = $(this).val();
            if(isChecked){
                $("[name='num_comparison_hotels[]']").eq(index).removeAttr("disabled");
            }else{
                $("[name='"+v.replaceAll(' ','_').toLowerCase()+"_room_type[]']").prop("checked",false);
                $("[name='num_comparison_hotels[]']").eq(index).attr("disabled","disabled");
            }
        });
        
        $("[name=luggage_vehicle]").on("click",function(){
            if($(this).val() === "yes"){
                $("#add_lauggage_vehicles .col-md-12:nth-child(2)").slideDown("1000");
            }else{
                $("#add_lauggage_vehicles .col-md-12:nth-child(2)").slideUp("1000");
            }
        });

        $("[name=markup_split]").on("click",function(){
            if($(this).val() === "yes"){ 
                $("#markup_percentage").val(25);
                $(".hotel-markup").slideDown(1000);
                $("#hotel_markup_percentage").val(15);
            }else{ 
                $("#markup_percentage").val(25);
                $(".hotel-markup").slideUp("1000");
            }
        });
        
        $("#search_transportation").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/quotation/get_transportation_suggesstion",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        'location': qdata.qno,
                        'city' : $("#flight-city-initial-arrival").val()
                    },
                    success: function(data) {
                        response(data);							
                    }
                });
            },
            select: function(event, ui) {
                var html = '';
                html += '<div class="col-md-9" style="padding:8px 16px;">';
                html += '<span class=""><input type="checkbox" class="vehicles" name="chk_vehicle[]" data-capacity="'+ui.item.capacity+'" value="'+ui.item.t_id+'"> <span for=""> '+ui.item.label+' (Capacity : '+ui.item.capacity+')</span>';
                html += '</span></div>';
                html += '<div class="col-md-3">';
                html += '<div class="mb-3">';
                html += '<input type="number" name="vehicle_quantity[]" class="form-control" id="" min="1" value="1" placeholder="Enter Quantity" disabled></div></div>';
                $("#add_vehicles").append(html);                
            }
        });
        
        $("#search_luggage_vehicle").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/quotation/aux_transportation_suggesstion",
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
                html += '<div class="row"><div class="col-md-9"><span for="">'+ui.item.label+'</span></div>';
                html += '<div class="col-md-3 text-center"><label for="">'+$("#search_luggage_quantity").val()+'</label>';
                html += '<input type="hidden" name="hdn_luggage_vehicle[]" value="'+ui.item.label+'__'+ui.item.price+'__'+$("#search_luggage_quantity").val()+'">';
                html += '<i title="Remove" class="bi bi-x-lg luggage-remove" style="color:red;cursor: pointer;float: right;margin-top: 2px;position:relative;"></i></div></div>';
                $("#luggage-vehicle").append(html);                
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
	
        $("[name=group_type]").on("click",function(){
            if($(this).val() === "individual"){ 
                $(".chk-occupancy").each(function(){
                    $(this).removeClass("hide");
                });
                $("input[name='hdn_group_type']").val('individual');
            }else{
                $("input[name='hdn_group_type']").val('family');
                $(".chk-occupancy").each(function(){
                    $(this).addClass("hide");
                });
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
            
            $(".flight_details").eq(0).html($(".label-info").eq(0).html());
            $(".flight_details").eq(1).html($(".label-info").eq(1).html());     
        });
	
        $("#btn_restaurants").on("click",function(){
            
            var flag = true;
            if($('input[name="group_type"]:checked').val() === "individual"){
                $("input[name='hotel_category[]']").each(function (index) {                
                    if (this.checked) {
                        var v = this.value;
                        if ($('input[name="'+v.replaceAll(" ","_").toLowerCase()+'_room_type[]"]:checked').length === 0) {
                            flag = false;
                            alert("Select Atleast One Occupancy Type For Category "+v+" To Proceed.");
                            return false;
                        }                    
                    }                
                });
            }
            if(!flag){
                return false;
            }
            // if($('input[name="hotel"]:checked').val() === "yes")
            // {
                if($(".hdn-hotelids").length === 0){ 
                    alert("Select Hotels To Proceed.");
                    return false;
                }
                var isHotels = true;
                $(".hdn-hotelids").each(function(){
                    if(this.value == ''){
                        alert("Select All Hotels To Proceed.");
                        isHotels = false;
                        return false;
                    }
                });            
                if(!isHotels){
                    return false;
                }
            // }
            
            
            $("#quotation-make-1").css("display","none");
            $("#quotation-make-2").css("display","none");
            if($('input[name="group_type"]:checked').val() === "family"){
                $("#quotation-make-3").css("display","flex");
            }else{
                $("#quotation-make-individual-3").css("display","flex");
                individual_hotels_categories();
            }
            $("input[name='family_adults[]']").eq(0).val(parseInt(qdata.adults));
            $("input[name='family_child[]']").eq(0).val(parseInt(qdata.child));
        });
        
        $("#btn_restaurants_new").on("click",function()
        {    
            var flag = true;
            if($('input[name="group_type"]:checked').val() === "individual"){
                $("input[name='hotel_category[]']").each(function (index) {                
                    if (this.checked) {
                        var v = this.value;
                        if ($('input[name="'+v.replaceAll(" ","_").toLowerCase()+'_room_type[]"]:checked').length === 0) {
                            flag = false;
                            alert("Select Atleast One Occupancy Type For Category "+v+" To Proceed.");
                            return false;
                        }                    
                    }                
                });
            }
            if(!flag){
                return false;
            }
            // if($('input[name="hotel"]:checked').val() === "yes")
            // {
                if($(".hdn-hotelids").length === 0){ 
                    alert("Select Hotels To Proceed.");
                    return false;
                }
                var isHotels = true;
                $(".hdn-hotelids").each(function(){
                    if(this.value == ''){
                        alert("Select All Hotels To Proceed.");
                        isHotels = false;
                        return false;
                    }
                });            
                if(!isHotels){
                    return false;
                }
            // }
            $("#quotation-make-1").css("display","none");
            $("#quotation-make-2").css("display","none");
            if($('input[name="group_type"]:checked').val() === "family"){
                $("#quotation-make-3").css("display","flex");
            }else{
                $("#quotation-make-individual-3").css("display","flex");
                individual_hotels_categories_new();
            }
            $("input[name='family_adults[]']").eq(0).val(parseInt(qdata.adults));
            $("input[name='family_child[]']").eq(0).val(parseInt(qdata.child));
        });
        
        $("#btn_proceed_to_hotels").on("click",function(){
            var total_adults_num = $("#number_of_adults").val();
            var adult_num = 0;
            var total_child_num = $("#number_of_child").val();
            var child_num = 0;
            $(".family-adults").each(function(i,v){
                adult_num = adult_num + parseInt($(".family-adults").eq(i).val());
            });
            $(".family-child").each(function(i,v){
                child_num = child_num + parseInt($(".family-child").eq(i).val());
            });
            if(adult_num != total_adults_num || child_num != total_child_num){                
                alert("Please Enter Complete Family Details. Total Adults : "+total_adults_num+" Total Child : "+total_child_num);
                return false;
            }
            
            $("#quotation-make-1").css("display","none");
            $("#quotation-make-2").css("display","none");
            $("#quotation-make-3").css("display","none");
            $("#quotation-make-4").css("display","flex");
            $("#create_quotation").fadeIn(1000);
            $("#hotel-categories").html("");
            $("#hotel-categories-individual").html("");
            
            var html='';
            var i = 0;
            var daywise_hotels_cnt = 0;
            $('.daywise-hotels').each(function() {
                if (!$(this).hasClass('hide')) {
                    daywise_hotels_cnt++;
                }
            });            
            let allHotelsArr = [];
            for (let i = 1; i <= qdata.nights; i++) {
                let nightHotels = [];
                $("input[name^='night_"+i+"_'][type='text']").each(function () {
                    let val = $(this).val().trim().toLowerCase();
                    if (val !== "") nightHotels.push(val);
                });
                allHotelsArr.push(nightHotels.join("|")); 
            }
            let allSameHotels = allHotelsArr.every((v, i, a) => v === a[0]);
            var l = qdata.nights;
            if ($("#chk_all_hotels").is(':checked') && allSameHotels) {
                l = 1; 
            }      
            var k = 0;
            var div_colors = ['#f0f8ff','#fff7eb','#dce2ff'];
            var div_colors_head_arr = ['#84c6ff','#ffd391','#92a5ff'];
            var div_colors_head = '';
            var previous_category = '';
            var div_ids_arr = [];

            let displayedHotels = new Set();

                for(var j=1;j<=1;j++){
                    $("input[name='hotel_category[]']").map(function () {
                        if (this.checked) {
                            var category = this.value;
                            $("input[name='hdn_night_"+j+"_"+category.replaceAll(" ","_").toLowerCase()+"_ids[]']").map(function (index) {
                                var h = '';
                                if(previous_category !== "" && previous_category !== category){
                                    h = '<div class="w-100 d-none d-md-block mb-4" style="border: 1px solid;"></div>';
                                }
                                var div_html = h+'<div class="col-md-6 scrollbar" style="padding:0px 25px;height: 500px; overflow-y: auto;" id="'+category.replaceAll(" ","_").toLowerCase()+'_'+index+'"><span class="bold mt-4">'+category+' (Hotel Option '+(index+1)+')</span></div>';
                                $("#hotel-categories").append(div_html);
                                previous_category = category;
                                div_ids_arr.push(category.replaceAll(" ","_").toLowerCase()+'_'+index);
                            });
                            
                        }
                    });
                }
           
            
            for(var j=1;j<=l;j++){            
                
                var ele_chk = [];
                $("input[name='hotel_category[]']").map(function (index) {
                    if (this.checked) {
                        var category = this.value;                        
                        $("input[name='hdn_night_"+j+"_"+category.replaceAll(" ","_").toLowerCase()+"_ids[]']").map(function (ids_index) {
                            var hotel_id = $(this).val();   
                            if (displayedHotels.has(hotel_id)) return;
                                displayedHotels.add(hotel_id);       
                            var div_to_append_id = category.replaceAll(" ","_").toLowerCase()+'_'+ids_index;
                            $.ajax({
                                url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                                type: "post",
                                data: {'hotel_id':hotel_id,'check_in':qdata.checkin,'check_out':qdata.checkout,
                                    'type':category,'room_type':''},
                                dataType: 'JSON',
                                async:false,
                                success: function(data) {
                                    if (data.response === "s") {                            
                                        if(data.details.result.length>0){
                                            var mt = (i==0)?"mt-1":"mt-5";
                                            var day_text = '';
                                            var night_text = '';
                                            html = '<div class="row" style="color: #FFF;background-color:#49a6f5;font-size: 14px;font-weight: 600;border-radius: 10px;"><div class="col-md-12">'+day_text+data.details.result[0].name+'<span class="float-right">'+night_text+'</span></div></div>';
                                            html += '<div class="row"><div class="offset-9 col-md-2" style="text-align:right;">Rooms</div></div>';
                                            var is_chk = '';
                                            var is_chk_flag = false;
                                            var class_chk = '';
                                            $.each(data.details.result, function(i, val) {
                                                var hotel_prices = chk_persons = '';  
                                                var r_num = Math.random().toString();
                                                r_num = r_num.split(".")[1];
                                                class_chk = 'chk_'+val.id+'_'+hotel_id+r_num;                                
                                                html += '<div class="row mt-2" style="border-bottom:2px solid #000;">';
                                                html += '<div class="col-md-12 row prices-div-'+val.id+r_num+'" id="prices-div_'+val.id+r_num+'"><div class="col-md-5 div-category"><label class="bold"><input type="checkbox" class="'+class_chk+'" id="chk_'+val.id+'_'+hotel_id+'" value="'+val.id+'_'+val.category_name+'" name="night_'+j+'_category_ids_'+hotel_id+'[]"> '+val.category_name+'</label></div><div class="col-md-5 mb-1"><div class="row" style="">';
                                                hotel_prices = val.details.split(",");
                                                var persons_arr = [];
                                                $.each(hotel_prices, function(i, v) {
                                                    chk_persons = v.split(" ");
                                                    is_chk = '';
                                                    persons_arr.push(chk_persons[0]);
                                                    if((chk_persons[0] == qdata.adults+"(A)" || chk_persons[0] == qdata.child+"(C)") && is_chk_flag === false ){ 
                                                        is_chk = 'checked="checked"'; 
                                                        is_chk_flag = true;
                                                        ele_chk.push(class_chk);
                                                    }
                                                    html += '<div class="col-md-3 p-1"><input type="checkbox" class="chk-prices" data-person="'+chk_persons[0]+'" data-id="'+val.id+'_'+hotel_id+'" value="'+v+'" name="night_'+j+'_'+val.id+'_'+hotel_id+'_hotel_prices[0][]"> <span>'+v.split(" ")[0]+'</span>';
                                                    html += '<input type="textbox" style="width:100%;" class="chk-prices-input" name="'+val.id+'_'+hotel_id+'_hotel_prices_input[][]" value="'+v.split(" ")[1]+'"></div>';
                                                });
                                                html += '<input type="hidden" class="chk-prices-all-night-'+j+'" value="'+persons_arr.join(",")+'" data-chkid="'+val.id+'_'+hotel_id+'">';
                                                html += '</div></div><div class="col-md-2" style="display:flex;"><input type="number" min="1" class="rooms-cnt rooms_cnt_'+val.id+r_num+'" style="width:65%;height: 27px;" value="1" name="'+val.id+'_room_cnt[]"><span class="span_btn" style="margin-left:3px;"><button type="button" data-id="'+val.id+r_num+'" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></span></div></div><div class="col-md-1"></div></div>';
                                            }); 
                                            $("#"+div_to_append_id).append(html);
                                        }else { 
                                        
                                         } 
                                    } 
                                }
                            });   
                        });
                    }
                });   
                k++;
                
            }
            
            var rdo_guide = $("#quotation-make-1 input[name='guide']:checked").val();
            var rdo_airport_pick_drop = $("#quotation-make-1 input[name='airport_pick_drop']:checked").val();
            var class_arr = [".guides", ".guides-shift", ".guides-prices", ".guides-add", ".hdn-guides"];
            $("#show-guides input, #show-guides select, #show-guides button").prop("disabled", false);
            if(rdo_guide==="no"){
                $("#show-guides input, #show-guides select, #show-guides button").prop("disabled", true);
            }else if($("#quotation-make-1 #div_driver_cum_guide").css("display") !== "none" && $("input[name='driver_cum_guide']:checked").val() === "driver_guide") {
                $("#show-guides input, #show-guides select, #show-guides button").prop("disabled", true);
                    $.each(class_arr, function(index, value) {
                        $(value).eq(0).prop("disabled", false);
                    });
            }
            
            // for(var q=1;q<=$(".qtn-city").length;q++){
            //     if($(".city-details .qtn-city").eq(parseInt(q)).attr("data-suburb") == "true"){                    
            //         $(".itinerary_ul").eq(q).html("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+q+"][]' value='transfer_to_hotel'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+q+"][]' value='Transfer to hotel'><div>Transfer to hotel</div><input type='hidden' class='activities-list' name='hdn_activities["+q+"][]' value=''><i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i></li>");
            //     }
            // }
            if (rdo_airport_pick_drop === "yes") {
                var lastDayIndex = $(".itinerary_ul").length - 1;
                var firstDayIndex = 0;
                $(".itinerary_ul").eq(lastDayIndex).append(
                    "<li style='display:inline-flex;'>" +
                        "<i class='fa fa-circle-o' style='margin:6px;'></i>" +
                        "<div><li style='list-style-type: circle'>Airport Drop</li></div>" +
                    "</li>"
                );

                $(".itinerary_ul").eq(firstDayIndex).append(
                    "<li style='display:inline-flex;'>" +
                        "<i class='fa fa-circle-o' style='margin:6px;'></i>" +
                        "<div><li style='list-style-type: circle'>Airport Pick</li></div>" +
                    "</li>"
                );
            }
            
            $.each(div_ids_arr, function(index, id) {
                var msg = false;
                var pending_rooms_arr = []; 
                for(var j=1;j<=l;j++){
                    
                    var rooms_arr = [];
                    $("input[name='family_adults[]']").each(function (index, obj) {                       
                        $("input[name='family_"+(index+1)+"_adults[]']").each(function (idx, ob) {
                            var room_persons = $(this).val()+"(A)";
                            if($("input[name='family_"+(index+1)+"_child[]']").eq(idx).val() != "" && $("input[name='family_"+(index+1)+"_child[]']").eq(idx).val() != "0"){
                                for(var i=1;i<=$("input[name='family_"+(index+1)+"_child[]']").eq(idx).val();i++){
                                    room_persons = room_persons + ",1(C)";
                                }
                            }
                            rooms_arr.push(room_persons);
                        });
                    });
                    rooms_arr.sort();
                    
                    $("#" + id).find(".chk-prices-all-night-"+j).each(function(n,v) {
                        if(n > 0 && pending_rooms_arr.length == 0){
                            return false;
                        }else if(pending_rooms_arr.length > 0){
                            rooms_arr = pending_rooms_arr;
                            pending_rooms_arr = [];
                        }
                        var arr_all = $("#" + id).find(".chk-prices-all-night-"+j).eq(n).val().split(",");
                        var data_idx = $("#" + id).find(".chk-prices-all-night-"+j).eq(n).attr("data-chkid");
                        var previous_val = '';
                        var room_cnt_idx = n;
                        $.each(rooms_arr, function(i, obj) {
                            msg = false;
                            var flag = 0;
                            if(previous_val == obj){
                                var vl = $("#" + id).find(".rooms-cnt").eq(room_cnt_idx).val();                                
                                $("#" + id).find(".rooms-cnt").eq(room_cnt_idx).val(parseInt(vl)+1);                                
                                flag = 1;
                                previous_val = obj;                                
                            }
                            if(flag == 0){
                                var q = obj.split(",");
                                let allPresent = q.every(val => arr_all.includes(val));
                                var chk_matches = 0;
                                if(allPresent && i==0){
                                    var child_idx = 0;
                                    $.each(q, function(w, ob) {
                                        var idx_num = 0;                                        
                                        if(ob=="1(C)"){
                                            idx_num = child_idx;
                                        }
                                        const checkbox = document.querySelectorAll('input[name="night_'+j+'_'+data_idx+'_hotel_prices['+i+'][]"][data-person="'+ob+'"][data-id="'+data_idx+'"]');
                                        if (checkbox) {                                            
                                            checkbox[idx_num].checked = true;
                                            $("#chk_"+data_idx).attr("checked","checked");
                                            if(ob=="1(C)"){
                                                child_idx++;
                                            }
                                        }
                                    });
                                    
                                    previous_val = obj;
                                }else if(allPresent && i>0){
                                    var d = $("#" + id).find(".add").eq(n).attr("data-id");
                                    new_row(d,obj,arr_all,data_idx,j);
                                    flag = 1;
                                    room_cnt_idx++;
                                    previous_val = obj;
                                }else { 
                                    pending_rooms_arr.push(obj);
                                    msg = true;
                                }                                
                            }
                        });
                        
                    });
                }
                if(msg == true){                    
                    $("#"+id).css("border", "3px solid #ff0909");
                }
            });
        });

       
        
        function individual_hotels_categories(){
            $("#hotel-categories-individual").html("");
            $("#hotel-categories").html("");
            var html='';
            var i = 0;
            
            var daywise_hotels_cnt = 0;
            $('.daywise-hotels').each(function() {
                if (!$(this).hasClass('hide')) {
                    daywise_hotels_cnt++;
                }
            });            
            //var l = parseInt(daywise_hotels_cnt)/parseInt(num_comparison_hotels);
            let allHotelsArr = [];
            for (let i = 1; i <= qdata.nights; i++) {
                let nightHotels = [];
                $("input[name^='night_"+i+"_'][type='text']").each(function () {
                    let val = $(this).val().trim().toLowerCase();
                    if (val !== "") nightHotels.push(val);
                });
                allHotelsArr.push(nightHotels.join("|")); 
            }
            let allSameHotels = allHotelsArr.every((v, i, a) => v === a[0]);
            var l = qdata.nights;
            if ($("#chk_all_hotels").is(':checked') && allSameHotels) {
                l = 1; 
            }

            var k = 0;
            var div_colors = ['#f0f8ff','#fff7eb','#dce2ff'];
            var div_colors_head_arr = ['#5d7183ff','#ffd391','#92a5ff'];
            var div_colors_head = '';
            var previous_category = '';
            var div_ids_arr = [];

            let displayedHotels = new Set();
            
            for(var j=1;j<=1;j++){
                $("input[name='hotel_category[]']").map(function () {
                    if (this.checked) {
                        var category = this.value;
                        $("input[name='hdn_night_"+j+"_"+category.replaceAll(" ","_").toLowerCase()+"_ids[]']").map(function (index) {
                            var h = '';
                            if(previous_category !== "" && previous_category !== category){
                                h = '<div class="w-100 d-none d-md-block mb-4" style="border: 1px solid;"></div>';
                            }
                            var div_html = h+'<div class="col-md-6 scrollbar" style="padding:0px 25px;height: 500px; overflow-y: auto;" id="'+category.replaceAll(" ","_").toLowerCase()+'_'+index+'"><span class="bold mt-4">'+category+' (Hotel Option '+(index+1)+')</span></div>';
                            $("#hotel-categories-individual").append(div_html);
                            previous_category = category;
                            div_ids_arr.push(category.replaceAll(" ","_").toLowerCase()+'_'+index);
                        });

                    }
                });
            }
           
            for(var j=1;j<=l;j++){                
                var ele_chk = [];
                $("input[name='hotel_category[]']").map(function (index) {
                    if (this.checked) {
                        var category = this.value;
                        $("input[name='hdn_night_"+j+"_"+category.replaceAll(" ","_").toLowerCase()+"_ids[]']").map(function (ids_index) {
                            var room_type = $("input[name='"+category.replaceAll(" ","_").toLowerCase()+"_room_type[]']:checked").map(function () {
                                return this.value;
                            }).get();
                            var hotel_id = $(this).val();                        
                            //const newDiv = document.createElement('div');
                             if (displayedHotels.has(hotel_id)) return;
                                displayedHotels.add(hotel_id);
                            var div_to_append_id = category.replaceAll(" ","_").toLowerCase()+'_'+ids_index;
                            //newDiv.className = ($("#chk_all_hotels").is(':checked'))?'col-md-12 scrollbar':'col-md-12 scrollbar';
                            $.ajax({
                                url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                                type: "post",
                                data: {'hotel_id':hotel_id,'check_in':qdata.checkin,'check_out':qdata.checkout,
                                    'type':category,'room_type':''},
                                dataType: 'JSON',
                                async:false,
                                //contentType: false,
                                //processData: false,
                                success: function(data) {
                                    if (data.response === "s") {
                                        if (data.details.result.length > 0) {
                                            let minPriceMap = {};
                                            $.each(data.details.result, function(i, val) {
                                                let hotel_prices = val.details.split(",");
                                                $.each(hotel_prices, function(_, v) {
                                                    let parts = v.trim().split(" ");
                                                    let roomType = parts[0];
                                                    let price = parseFloat(parts[1].replace(/[^\d.]/g, ''));
                                                   if (price > 0) {   
                                                        if (!minPriceMap[roomType] || price < minPriceMap[roomType].price) {
                                                            minPriceMap[roomType] = { price: price, id: val.id };
                                                        }
                                                    }
                                                });
                                            });

                                            var mt = (i==0) ? "mt-1" : "mt-5";
                                            var day_text = '';
                                            var night_text = '';

                                            html = '<div class="row" style="color: #FFF;background-color:#49a6f5;font-size: 14px;font-weight: 600;border-radius: 10px;"><div class="col-md-12">'+day_text+data.details.result[0].name+'<span class="float-right">'+night_text+'</span></div></div>';

                                            var ele_chk = [];

                                            $.each(data.details.result, function(i, val) {
                                                var hotel_prices = val.details.split(",");
                                                var r_num = Math.random().toString().split(".")[1];
                                                var class_chk = 'chk_'+val.id+'_'+hotel_id+r_num;

                                                html += '<div class="row mt-2" style="border-bottom:2px solid #000;">';
                                                html += '<div class="col-md-12 row prices-div-'+val.id+r_num+'" id="prices-div_'+val.id+r_num+'">';
                                                html += '<div class="col-md-5 div-category"><label class="bold"><input type="checkbox" class="'+class_chk+'" id="chk_'+val.id+'_'+hotel_id+'" value="'+val.id+'_'+val.category_name+'" name="night_'+j+'_category_ids_'+hotel_id+'[]"> '+val.category_name+'</label></div><div class="col-md-5 mb-1"><div class="row" style="">';

                                                $.each(hotel_prices, function(_, v) {
                                                    let parts = v.trim().split(" ");
                                                    let roomType = parts[0];
                                                    let price = parseFloat(parts[1].replace(/[^\d.]/g, ''));

                                                    let is_chk = '';
                                                        if (room_type.includes(roomType)) {   
                                                           if (minPriceMap[roomType] 
                                                                && minPriceMap[roomType].price === price 
                                                                && minPriceMap[roomType].id === val.id
                                                                && price > 0) {   
                                                                is_chk = 'checked="checked"';
                                                                ele_chk.push(class_chk);
                                                            }

                                                        }
                                                    html += '<div class="col-md-3 p-1">'
                                                        + '<input '+is_chk+' type="checkbox" class="chk-prices" data-person="'+roomType+'" data-id="'+val.id+'_'+hotel_id+'" value="'+v+'" name="night_'+j+'_'+val.id+'_'+hotel_id+'_hotel_prices[0][]"> <span>'+roomType+'</span>'
                                                        + '<input type="textbox" style="width:100%;" class="chk-prices-input" name="'+val.id+'_'+hotel_id+'_hotel_prices_input[][]" value="'+parts[1]+'">'
                                                        + '</div>';
                                                });

                                                html += '</div></div><div class="col-md-2" style="display:flex;"><span class="span_btn" style="margin-left:3px;"><button type="button" data-id="'+val.id+r_num+'" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></span></div></div><div class="col-md-1"></div></div>';
                                            });

                                            $("#"+div_to_append_id).append(html);
                                            ele_chk.forEach((vl) => {
                                                $("."+vl).prop("checked", true); // NOTE: prop use karo, attr nahi
                                            });

                                        }
                                    }
                                }
                            });   
                        });
                    }
                });   
                k++;                
            }
            
            var rdo_guide = $("#quotation-make-1 input[name='guide']:checked").val();
            var rdo_airport_pick_drop = $("#quotation-make-1 input[name='airport_pick_drop']:checked").val();
            var class_arr = [".guides", ".guides-shift", ".guides-prices", ".guides-add", ".hdn-guides"];
            $("#show-guides input, #show-guides select, #show-guides button").prop("disabled", false);
            if(rdo_guide==="no"){
                $("#show-guides input, #show-guides select, #show-guides button").prop("disabled", true);
            }else if($("#quotation-make-1 #div_driver_cum_guide").css("display") !== "none" && $("input[name='driver_cum_guide']:checked").val() === "driver_guide") {
                $("#show-guides input, #show-guides select, #show-guides button").prop("disabled", true);
                    $.each(class_arr, function(index, value) {
                        $(value).eq(0).prop("disabled", false);
                    });
            }
            // for(var q=1;q<=$(".qtn-city").length;q++){
            //     if($(".city-details .qtn-city").eq(parseInt(q)).attr("data-suburb") == "true"){                    
            //         $(".itinerary_ul").eq(q).html("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+q+"][]' value='transfer_to_hotel'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+q+"][]' value='Transfer to hotel'><div>Transfer to hotel</div><input type='hidden' class='activities-list' name='hdn_activities["+q+"][]' value=''><i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i></li>");
            //     }
            // } 
            if (rdo_airport_pick_drop === "yes") {
                var lastDayIndex = $(".itinerary_ul").length - 1;
                var firstDayIndex = 0;
                $(".itinerary_ul").eq(lastDayIndex).append(
                    "<li style='display:inline-flex;'>" +
                        "<i class='fa fa-circle-o' style='margin:6px;'></i>" +
                        "<div><li style='list-style-type: circle'>Airport Drop</li></div>" +
                    "</li>"
                );

                $(".itinerary_ul").eq(firstDayIndex).append(
                    "<li style='display:inline-flex;'>" +
                        "<i class='fa fa-circle-o' style='margin:6px;'></i>" +
                        "<div><li style='list-style-type: circle'>Airport Pick</li></div>" +
                    "</li>"
                );
            }
        }
        
        $(document).on("click", ".quotation", function() {
            var dataAttr = $(this).data("attr"); 
            var enquiry_no = dataAttr.qno; 

            $.ajax({
                url: "<?= base_url('admin/quotation/getItineraryContent') ?>",
                type: "GET",
                data: { enquiry_no: enquiry_no },  
                dataType: "json",
                success: function(res) {
                    if (res.status === "success") {
                        localStorage.setItem('firstDay',res.firstDay);     
                        localStorage.setItem('lastDay',res.lastDay);                       
                        // Append Day 1
                        $(".itinerary_ul").eq(0).append(
                            "<li><div style='list-style-type: circle'>"+res.firstDay+"</div></li>"
                        );

                        // Append Last Day
                        var lastDayIndex = $(".itinerary_ul").length - 1;
                        $(".itinerary_ul").eq(lastDayIndex).append(
                            "<li><div style='list-style-type: circle'>"+res.lastDay+"</div></li>"
                        );

                    } else {
                        alert(res.message);
                    }
                }
            });
        });
        
        function individual_hotels_categories_new() 
        {
            $("#hotel-categories-individual").html("");
            $("#hotel-categories").html("");
            var html = '';
            var i = 0;

            var daywise_hotels_cnt = 0;
            $('.daywise-hotels').each(function() {
                if (!$(this).hasClass('hide')) {
                    daywise_hotels_cnt++;
                }
            });
            // var l = qdata.nights;
            // if ($("#chk_all_hotels").is(':checked')) {
            //     l = 1;
            // }
            let allHotelsArr = [];
            for (let i = 1; i <= qdata.nights; i++) {
                let nightHotels = [];
                $("input[name^='night_"+i+"_'][type='text']").each(function () {
                    let val = $(this).val().trim().toLowerCase();
                    if (val !== "") nightHotels.push(val);
                });
                allHotelsArr.push(nightHotels.join("|")); 
            }
            let allSameHotels = allHotelsArr.every((v, i, a) => v === a[0]);
            var l = qdata.nights;
            if ($("#chk_all_hotels").is(':checked') && allSameHotels) {
                l = 1; 
            }
            var k = 0;
            var previous_category = '';
            var div_ids_arr = [];
            let displayedHotels = new Set();

            for (var j = 1; j <= 1; j++) {
                $("input[name='hotel_category[]']").map(function() {
                    if (this.checked) {
                        var category = this.value;
                        $("input[name='hdn_night_" + j + "_" + category.replaceAll(" ", "_").toLowerCase() + "_ids[]']").map(function(index) {
                            var h = '';
                            if (previous_category !== "" && previous_category !== category) {
                                h = '<div class="w-100 d-none d-md-block mb-4" style="border: 1px solid;"></div>';
                            }
                            var div_html = h + '<div class="col-md-6 scrollbar" style="padding:0px 25px;height: 500px; overflow-y: auto;" id="' + category.replaceAll(" ", "_").toLowerCase() + '_' + index + '"><span class="bold mt-4">' + category + ' (Hotel Option ' + (index + 1) + ')</span></div>';
                            $("#hotel-categories-individual").append(div_html);
                            previous_category = category;
                            div_ids_arr.push(category.replaceAll(" ", "_").toLowerCase() + '_' + index);
                        });
                    }
                });
            }

            for (var j = 1; j <= l; j++) {
                var ele_chk = [];
                $("input[name='hotel_category[]']").map(function(index) {
                    if (this.checked) {
                        var category = this.value;
                        $("input[name='hdn_night_" + j + "_" + category.replaceAll(" ", "_").toLowerCase() + "_ids[]']").map(function(ids_index) {
                            var room_type = $("input[name='" + category.replaceAll(" ", "_").toLowerCase() + "_room_type[]']:checked").map(function() {
                                return this.value;
                            }).get();
                            var hotel_id = $(this).val();
                             if (displayedHotels.has(hotel_id)) return;
                                displayedHotels.add(hotel_id);
                            var div_to_append_id = category.replaceAll(" ", "_").toLowerCase() + '_' + ids_index;

                            $.ajax({
                                url: "<?php echo site_url('admin/quotation/get_hotel_prices'); ?>",
                                type: "post",
                                data: {
                                    'hotel_id': hotel_id,
                                    'check_in': qdata.checkin,
                                    'check_out': qdata.checkout,
                                    'type': category,
                                    'room_type': ''
                                },
                                dataType: 'JSON',
                                async: false,
                                success: function(data) {
                                    if (data.response === "s") {
                                        if (data.details.result.length > 0) {
                                            var mt = (i == 0) ? "mt-1" : "mt-5";
                                            var day_text = '';
                                            var night_text = '';

                                            html = '<div class="row" style="color: #FFF;background-color:#49a6f5;font-size: 14px;font-weight: 600;border-radius: 10px;"><div class="col-md-12">' + day_text + data.details.result[0].name + '<span class="float-right">' + night_text + '</span></div></div>';

                                            var class_chk = '';
                                            $.each(data.details.result, function(i, val) {
                                                var hotel_prices = '';
                                                var chk_persons = '';
                                                var r_num = Math.random().toString();
                                                r_num = r_num.split(".")[1];
                                                class_chk = 'chk_' + val.id + '_' + hotel_id + r_num;

                                                // 🔹 Restore logic
                                                let savedRoomsObj = {};
                                                if (savedHotelRoomDetails[hotel_id]) {
                                                    try {
                                                        savedRoomsObj = JSON.parse(savedHotelRoomDetails[hotel_id].rooms || "{}");
                                                    } catch (e) {
                                                        console.warn("Invalid saved rooms JSON", e);
                                                    }
                                                }

                                                function normalize(str) {
                                                    return str.replace(/^\d+_/, "").replace(/\s+/g, " ").trim().toLowerCase();
                                                }

                                                let normCategory = normalize(val.category_name);
                                                let savedCatRooms = [];
                                                for (const k in savedRoomsObj) {
                                                    if (normalize(k) === normCategory) {
                                                        savedCatRooms = savedRoomsObj[k];
                                                    }
                                                }

                                                let category_checked = (savedCatRooms.length > 0) ? 'checked="checked"' : "";

                                                html += '<div class="row mt-2" style="border-bottom:2px solid #000;">';
                                                html += '<div class="col-md-12 row prices-div-' + val.id + r_num + '" id="prices-div_' + val.id + r_num + '">';
                                                html += '<div class="col-md-5 div-category"><label class="bold">';
                                                html += '<input type="checkbox" ' + category_checked + ' class="' + class_chk + '" id="chk_' + val.id + '_' + hotel_id + '" value="' + val.id + '_' + val.category_name + '" name="night_' + j + '_category_ids_' + hotel_id + '[]"> ' + val.category_name + '</label></div>';
                                                html += '<div class="col-md-5 mb-1"><div class="row">';

                                                hotel_prices = val.details.split(",");
                                                $.each(hotel_prices, function(i, v) {
                                                    chk_persons = v.split(" ");
                                                    let is_chk = "";
                                                    let savedCount = 1;
                                                    if (savedCatRooms.length > 0) {
                                                        savedCatRooms.forEach(r => {
                                                            if (r.room_type && r.room_type.some(rt => rt.trim() === v.trim())) {
                                                                is_chk = 'checked="checked"';
                                                                savedCount = r.room_count || 1;
                                                            }
                                                        });
                                                    } 
                                                    // else if(!savedHotelRoomDetails[hotel_id]) {
                                                    //     if (room_type.indexOf(chk_persons[0]) !== -1) {
                                                    //         is_chk = 'checked="checked"';
                                                    //         room_type.splice(room_type.indexOf(chk_persons[0]), 1);
                                                    //         ele_chk.push(class_chk);
                                                    //     }
                                                    // } 
                                                                        else if(!savedHotelRoomDetails[hotel_id]) {
                                                        if (!window.minRoomCache) window.minRoomCache = {};
                                                        if (!window.minRoomCache[hotel_id]) {
                                                            let typeWiseMin = {}; 
                                                            $.each(data.details.result, function(_, cat) {
                                                                let pricesArr = cat.details.split(",");
                                                                $.each(pricesArr, function(_, pv) {
                                                                    let pParts = pv.trim().split(" ");
                                                                    let occType = pParts[0]; 
                                                                    let pVal = parseFloat(pParts[1].replace(/[^\d.]/g, ''));

                                                                    if (room_type.indexOf(occType) !== -1 && pVal > 0) {
                                                                        if (!typeWiseMin[occType] || pVal < typeWiseMin[occType].price) {
                                                                            typeWiseMin[occType] = { price: pVal, catId: cat.id };
                                                                        }
                                                                    }
                                                                });
                                                            });

                                                            window.minRoomCache[hotel_id] = typeWiseMin;
                                                        }
                                                        let cache = window.minRoomCache[hotel_id];
                                                        if (cache[chk_persons[0]] && cache[chk_persons[0]].catId === val.id) {
                                                            is_chk = 'checked="checked"';
                                                            ele_chk.push(class_chk);
                                                            $("#chk_" + val.id + "_" + hotel_id).prop("checked", true);
                                                        }
                                                    }
                                                    html += '<div class="col-md-3 p-1">';
                                                    html += '<input ' + is_chk + ' type="checkbox" class="chk-prices" data-person="' + chk_persons[0] + '" data-id="' + val.id + '_' + hotel_id + '" value="' + v + '" name="night_' + j + '_' + val.id + '_' + hotel_id + '_hotel_prices[0][]"> <span>' + v.split(" ")[0] + '</span>';
                                                    html += '<input type="textbox" style="width:100%;" class="chk-prices-input" name="' + val.id + '_' + hotel_id + '_hotel_prices_input[][]" value="' + v.split(" ")[1] + '">';
                                                    html += '</div>';
                                                });
                                                html += '</div></div><div class="col-md-2" style="display:flex;"><span class="span_btn" style="margin-left:3px;"><button type="button" data-id="' + val.id + r_num + '" style="background-color: #0a87f5;color: #FFF;height:25px;cursor:pointer;float:right;padding: 0px 5px;" class="add btn-primary">+</button></span></div></div><div class="col-md-1"></div></div>';
                                            });
                                            $("#" + div_to_append_id).append(html);

                                            ele_chk.forEach((vl, index) => {
                                                $("." + vl).prop("checked", true);
                                            });
                                        }
                                    }
                                }
                            });
                        });
                    }
                });
                k++;
            }
        }
    
        
        function getTimeAsNumberOfMinutes(time){
            var timeParts = time.split(":");
            var timeInMinutes = parseInt((timeParts[0] * 60)) + parseInt(timeParts[1]);
            return timeInMinutes;
        }
        
        $("#frm_1").on("blur",".chk-prices-input",function(){
            var idx = $(this).index(".chk-prices-input");
            var prices = $(".chk-prices").eq(idx).val().split(" ");
            $(".chk-prices").eq(idx).val(prices[0]+" "+parseInt($(".chk-prices-input").eq(idx).val()));
        });
        
        $("#previous").on("click",function(){
            $("#quotation-make-1").toggle();
            $("#quotation-make-2").toggle();
            //$("#create_quotation").fadeOut(1000);
        });
        
        $("#previous-to-hotels").on("click",function(){
            //$("#quotation-make-1").toggle();
            $("#quotation-make-3").toggle();
            $("#quotation-make-4").toggle();
            //$("#create_quotation").fadeOut(1000);
        });
        
        $("#previous-to-family").on("click",function(){
            $("#quotation-make-2").toggle();
            $("#quotation-make-3").toggle();
        });        
        
        $("#btn_proceed_to_itinerary").on("click",function(){
            $("#quotation-make-4").toggle();
            $("#quotation-make-5").toggle();
            $("#previous-to-hotels-details").attr("move-to","family");
        });
        
        $("#individual_btn_proceed_to_itinerary").on("click",function(){
            $("#quotation-make-individual-3").toggle();
            $("#quotation-make-5").toggle();
            $("#previous-to-hotels-details").attr("move-to","individual");
        });
        
        $("#previous-to-hotels-details").on("click",function(){
            if($("#previous-to-hotels-details").attr("move-to") === "individual"){
                $("#quotation-make-individual-3").toggle();                
            }else{
                $("#quotation-make-4").toggle();
            }
            $("#quotation-make-5").toggle();
        });
        
        $("#individual-previous-to-hotels").on("click",function(){
            $("#quotation-make-2").toggle();
            $("#quotation-make-individual-3").toggle();
        });
        
        $("#frm_1").on("click",".chk-prices",function(){
            var category_id = $(this).attr("data-id");
            var rdo_name = $(this).attr("name").split("_");
            
            var flag = false;
            $("#chk_"+category_id).attr("checked",false);
            $("input[name='"+rdo_name[0]+"_"+rdo_name[1]+"_"+category_id+"_hotel_prices[0][]']").each(function (index, obj) {
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
            //h.find("input:checkbox").prop("name",id+"_hotel_prices["+x+"][]");
            //h.find("input[type='number']").prop("name",id+"_room_cnt["+x+"]");
            /*h.append(
                '<div class="col-md-1"><i title="Remove" class="bi bi-x-lg div_remove" style="color:red;cursor: pointer;margin-top: -15px;position:relative;"></i></div>'
            );*/
            
            var n = parseInt($(".rooms_cnt_"+id).length);
            h.find('.chk-prices').each(function() {
                let str = $(this).attr('name');
                let updatedStr = str.replace(/\[\d+\]/, '[' + n + ']');
                $(this).attr('name', updatedStr);
            });
            h.find(".span_btn").html('<i title="Remove" class="bi bi-x-lg div_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            h.find(".div-category").html("");
            //h.insertAfter($("#prices-div_" + id));
            var l = $(".prices-div-"+ id).length;
            h.insertAfter($(".prices-div-"+ id).eq(l-1));
        });
        
        function new_row(id,obj,arr_all,data_idx,j){            
            var n = parseInt($(".rooms_cnt_"+id).length);
            var id = id;
            var x = Math.floor((Math.random() * 10000) + 1);
            var h = $("#prices-div_" + id).clone().attr('id', 'prices-div_' + x);
            h.find('input:checkbox').prop('checked',false);         
            h.find('input[type="number"]').val("1");
            h.find('.chk-prices').each(function() {
                $(this).attr('name', 'night_'+j+'_'+data_idx+'_hotel_prices['+n+'][]');
            });
            var q = obj.split(",");
            let allPresent = q.every(val => arr_all.includes(val));
            if(allPresent){
                var child_idx = 0;
                $.each(q, function(w, ob) {
                    const checkbox = h.find('input:checkbox[name="night_'+j+'_'+data_idx+'_hotel_prices['+n+'][]"][data-person="'+ob+'"][data-id="'+data_idx+'"]');
                    //console.log(checkbox);
                    var idx_num = 0;                                        
                    if(ob=="1(C)"){
                        idx_num = child_idx;
                    }
                    if (checkbox) {                                            
                        checkbox.eq(idx_num).prop('checked','checked');
                        $("#chk_"+data_idx).attr("checked","checked");
                        if(ob=="1(C)"){
                            child_idx++;
                        }
                    }
                });
                
                //rooms_arr.splice(i, 1);
                //rooms_arr[i] = '';
                //return false;
                //previous_val= obj;
            }
            
            //h.find("input:checkbox").prop("name",id+"_hotel_prices["+x+"][]");
            //h.find("input[type='number']").prop("name",id+"_room_cnt["+x+"]");
            /*h.append(
                '<div class="col-md-1"><i title="Remove" class="bi bi-x-lg div_remove" style="color:red;cursor: pointer;margin-top: -15px;position:relative;"></i></div>'
            );*/
            h.find(".span_btn").html('<i title="Remove" class="bi bi-x-lg div_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            h.find(".div-category").html("");
            //h.insertAfter($("#prices-div_" + id));
            var l = $(".prices-div-"+ id).length;
            h.insertAfter($(".prices-div-"+ id).eq(l-1));
        }
        
        
        $("#frm_1").on("click","#btn-add-languages",function(event){
            event.preventDefault();
            //var idx = $(this).index(".guide-addition");
            var h = $(".guide-addition").eq(0).clone();
            h.find('.js-example-basic-multiple').removeAttr('data-select2-id').val('').find('option').removeAttr('data-select2-id').select2(); // Clean inner options;
            h.find('.js-example-basic-multiple').next('.select2').remove(); // just in case
            h.find('.js-example-basic-multiple').select2();
            h.find("input[type='number']").val("");
            h.find("select").attr("name","guide_languages_"+Math.random().toString().replace(".","")+"[]");
            h.find("#btn-add-languages").replaceWith('<i title="Remove" class="bi bi-x-lg guide_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            
            var l = $(".guide-addition").length;
            h.insertAfter($(".guide-addition").eq(l-1));
        });
        
        $("#frm_1").on("click",".restaurant-add",function(){
            event.preventDefault();
            var idx = $(this).index(".restaurant-add");
            var id = $(".restaurant-add").eq(idx).attr("data-id");
            var count = $('.r_'+id).length;
            var h = $(this).parent().parent().clone();
            //h.find('input:text').val('');
            h.find('.daywise-restaurants').val('');
            h.find('.adult-price').val('');
            h.find('.child-price').val('');
            h.find('input[type="hidden"]').val('');
            h.find('select').val('');
            h.removeClass("row-bg").removeClass("mt-2").addClass("row-bg-clone");
            h.find(".restaurant-add").parent().html('<span>&nbsp;</span><br><i title="Remove" class="bi bi-x-lg restaurant_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
            h.insertAfter($(".r_"+id).eq(count-1));
        });
        
        $("#frm_1").on("click",".guides-add",function(){
            event.preventDefault();
            var idx = $(this).index(".guides-add");
            var id = $(".guides-add").eq(idx).attr("data-id");
            var count = $('.g_'+id).length;
            var h = $(this).parent().parent().clone();
            h.find('input').val('');
            h.find('select').val('');
            h.removeClass("row-bg").removeClass("mt-2").addClass("row-bg-clone");
            h.find(".guides-add").parent().html('<span>&nbsp;</span><i title="Remove" class="bi bi-x-lg guides_remove" style="color:red;cursor: pointer;padding:6px 4px;"></i>');
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
        $("#frm_1").on("click", '.mandatory_remove', function(e) {
            $(this).parent().prev("div").remove();
            $(this).parent().remove();
        });
        $("#frm_1").on("click", '.guide_remove', function(e) {
            $(this).parent().parent().parent().remove();
        });
        
        $("#frm_1").on("change", '.qtn-transfer', function(e) {
            var idx = $(this).index(".qtn-transfer");
            if($(".qtn-transfer").eq(idx).val() === "flight"){
                $(".local-flight").eq(idx).slideDown(1000);
            }else{
                $(".local-flight").eq(idx).slideUp(1000);
            }
            
        });
        
        /*$("#frm_1").on("click",".vehicles",function(){
                alert($(this).checked().index());//[name='chk_vehicle[]']
        });*/
        // $("#frm_1").on("change",".vehicles",function(){
        //     var index = 0;
        //     var flag = 0;
        //     $('.vehicles').each(function() {
        //         if (this.checked) {
        //             if($("[name='guide']:checked").val() == "yes" && ["6","8"].indexOf(this.value) !== -1) {
        //                 flag = 1;
        //             }
        //             $('[name="vehicle_quantity[]"]').eq(index).removeAttr("disabled");
        //         }else {
        //             $('[name="vehicle_quantity[]"]').eq(index).attr("disabled","disabled");
        //         }
        //         index++;
        //     });

        //     if(flag == 1){
        //         $("#div_driver_cum_guide").fadeIn("3000");
        //     }else { $("#div_driver_cum_guide").fadeOut("3000"); }
        //     var guests = $(".qdata").eq(1).text().split(" ");
        //     var vehicle_capacity = parseInt($(this).attr("data-capacity"));
        //     if(vehicle_capacity >= parseInt(guests[0]) && parseInt(vehicle_capacity - parseInt(guests[0])) < 2){
        //         $('input[name="luggage_vehicle"][value="yes"]').prop('checked', 'checked').trigger("click");
        //     }
        // });
        $("#frm_1").on("change", ".vehicles, [name='vehicle_quantity[]']", function () {
            var index = 0;
            var flag = 0;

            $('.vehicles').each(function () {
                if (this.checked) {
                    if ($("[name='guide']:checked").val() == "yes" && ["6", "8"].indexOf(this.value) !== -1) {
                        flag = 1;
                    }
                    $('[name="vehicle_quantity[]"]').eq(index).removeAttr("disabled");
                } else {
                    $('[name="vehicle_quantity[]"]').eq(index).attr("disabled", "disabled");
                }
                index++;
            });

            if (flag == 1) {
                $("#div_driver_cum_guide").fadeIn("3000");
            } else {
                $("#div_driver_cum_guide").fadeOut("3000");
            }

            var guests = $(".qdata").eq(1).text().split(" ");
            var guestCount = parseInt(guests[0]);
            var totalCapacity = 0;
            var anyVehicleSelected = false;

            $('.vehicles').each(function (i) {
                if (this.checked) {
                    anyVehicleSelected = true;
                    var vehicle_capacity = parseInt($(this).attr("data-capacity"));
                    var qty = parseInt($('[name="vehicle_quantity[]"]').eq(i).val() || 0);
                    totalCapacity += vehicle_capacity * qty;
                }
            });

            var diff = totalCapacity - guestCount;
            // console.log("Guests:", guestCount, "Total Capacity:", totalCapacity, "Diff:", diff);

            if (!anyVehicleSelected) {
                $('input[name="luggage_vehicle"][value="no"]').prop('checked', true).trigger("click");
            } else if (diff === 0) {
                $('input[name="luggage_vehicle"][value="yes"]').prop('checked', true).trigger("click");
            } else if (diff > 0) {
                $('input[name="luggage_vehicle"][value="no"]').prop('checked', true).trigger("click");
            } else {
                $('input[name="luggage_vehicle"][value="yes"]').prop('checked', true).trigger("click");
            }
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
        
        $(".flight-city-initial").autocomplete({
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
                var idx = $(this).index(".flight-city-initial");
                $('.flight-city-initial').eq(idx).val(ui.item.label); // display the selected text
                
            }
        });
        
        $("#flight-city-initial-airline").autocomplete({     
            source: function (request, response) 
            {
                if ($("#origin_city").val().trim() === "") {
                alert("Please select the city of origin first.");
                $("#flight-city-initial-airline").val('');
                return false; // stop execution
            }
            $.ajax({
                url: "<?= base_url() ?>admin/quotation/get_airlines",
                type: 'POST',
                dataType: "json",
                data: {
                    search: request.term,
                    'departure_city': $('.flight-city-initial').eq(0).val(),'arrival_city': $('.flight-city-initial').eq(1).val(),
                    'start_day' : $(".qtn-city").eq(1).attr("data-dayname")
                },
                success: function (data) {
                    response(data);
                    dt = data;
                }
                });
            },
            select: function (event, ui) {
                $('#flight-city-initial-airline').val(ui.item.label); // display the selected text
                $('#initial-airline-departure-time').val(ui.item.arrival_time);
                $('#flight-arrival').val(ui.item.arrival_time).trigger("change");
            }
        });
        
        $('#flight-city-initial-airline, #initial-airline-departure-time').on('blur', function() {
            if($("#flight-city-initial-airline").val() != "" && $("#initial-airline-departure-time").val() != ""){
                $(".flights-msg").eq(0).html('<span class="label-info" style="color: #FFF;padding: 2px 5px;font-weight: 500;"><strong>Arrival :</strong> '+$("#flight-city-initial-airline").val()+' , '+$("#initial-airline-departure-time").val()+'</span>');
            }
        });

        $('.airline-search, .airline-search-depart-time').on('blur', function() {
            if($(".airline-search").val() != "" && $(".airline-search-depart-time").val() != ""){
                var cnt = $(".flights-msg").length;
                $(".flights-msg").eq(cnt-1).html('<span class="label-info" style="color: #FFF;padding: 2px 5px;font-weight: 500;"><strong>Departure :</strong> '+$(".airline-search").val()+' , '+$(".airline-search-depart-time").val()+'</span>');
            }
        });

        $(document).on('keydown.autocomplete', ".airline-search", function() {
            $(this).autocomplete({ 
                //$(".airline-search").autocomplete({
                source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/quotation/get_airlines",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term,
                        'departure_city': $('.departure-city').eq(0).val(),'arrival_city': '',
                        'end_day': $(".qtn-city").eq(parseInt($('.qtn-city').length-1)).attr("data-dayname")
                    },
                    success: function (data) {
                        response(data);
                        dt = data;
                    }
                    });
                },
                select: function (event, ui) {
                    var idx = $(this).index(".airline-search");
                    $('.airline-search').eq(idx).val(ui.item.label); // display the selected text
                    $('.airline-search-depart-time').eq(idx).val(ui.item.departure_time);
                }
            });
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
                $("#div_driver_cum_guide").fadeIn("3000"); 
                // $(".vehicles").trigger("change");
                $("#guide-languages").slideDown(1000);
            }else { 
                $("#div_driver_cum_guide").fadeOut("3000");
                $("#guide-languages").slideUp(1000);
            }
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
            html = "<div class='form-floating mb-3'><i title='Remove' class='bi bi-x-lg hotels-remove' style='color:red;cursor: pointer;float: right;position:relative;'></i><input type='hidden' name='cities[]' value='"+city+"'><label class='bold'>"+ $("#hotel-city").val()+" ("+$("#num_nights").val() +" Nights) </label><ul>";
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
            $(".itinerary_ul").eq(rdo_idx).append("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+rdo_idx+"][]' value='"+$(".sites option:selected").eq(idx).val()+"'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+rdo_idx+"][]' value='"+$(".sites option:selected").eq(idx).text()+"'>"+$(".sites option:selected").eq(idx).text()+"<i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i><input type='hidden' class='activities-list' name='hdn_activities["+rdo_idx+"][]' value=''></li>");
            $('.sites').eq(idx).val("").select2();
            //$(".sites option:selected").eq(idx).val();
        });
            
        $(document).on('keydown.autocomplete', ".add-itinerary", function() {
             let $this = $(this);
            let dayName = $this.data("dayname");

            // Find the corresponding city input for this day
            let cityName = $('.qtn-city[data-dayname="'+dayName+'"]').val();
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_sites",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            enq_no: $(".qdata").eq(0).text(),
                            city: cityName
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
                    $(".itinerary_ul").eq(idx).append("<li style='display:inline-flex;'><input type='hidden' name='hdn_site_id["+idx+"][]' value='"+ui.item.id+"'><i class='fa fa-circle-o' style='margin:6px;'></i><input type='hidden' name='hdn_itinerary_content["+idx+"][]' value='"+ui.item.label+"'><div>"+ui.item.label+" <br>("+act+")</div><i title='Remove' class='bi bi-x-lg edit-remove' style='color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;'></i><input type='hidden' class='activities-list' name='hdn_activities["+idx+"][]' value=''></li>");
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
        
        $("#frm_1").on("click", '.luggage-remove', function(e) {
            if (!confirm('Are You Sure?')) {
                    return false;
            }
            e.preventDefault();
            $(this).parent().parent().remove();
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
                    $(".qtn-city").eq(idx).attr("data-suburb",ui.item.suburb_flag);
                    if($(".qtn-city").eq(idx).attr("data-suburb") == "true" && idx !== 0 && ($(".qtn-city").eq(idx).val() !== $(".qtn-city").eq(idx-1).val())){
                        $(".qtn-city").eq(idx).parent().next().next("div").removeClass("hide");
                        $(".qtn-city").eq(idx).parent().next("div").removeClass("hide");
                    }else if($(".qtn-city").eq(idx).attr("data-suburb") == "true" && idx !== 0){
                        $(".qtn-city").eq(idx).parent().next().next("div").addClass("hide");
                        $(".qtn-city").eq(idx).parent().next("div").addClass("hide");
                    }else if($(".qtn-city").eq(idx).attr("data-suburb") == "false" && idx !== 0){
                        $(".qtn-city").eq(idx).parent().next().next("div").removeClass("hide");
                        $(".qtn-city").eq(idx).parent().next("div").removeClass("hide");
                    }
                    return false;
                }
            });
        });    
        
        $("#frm_1").on("click",".qtn-city",function(){
            var idx = $(this).index(".qtn-city");
            
            if($(".qtn-city").eq(idx).attr("data-suburb") == "false" && idx !== 0 && ($(".qtn-city").eq(idx).val() !== $(".qtn-city").eq(idx-1).val())){
                $(".qtn-city").eq(idx).parent().next().next("div").removeClass("hide");
                $(".qtn-city").eq(idx).parent().next("div").removeClass("hide");
            }else if($(".qtn-city").eq(idx).attr("data-suburb") == "false" && idx !== 0){
                $(".qtn-city").eq(idx).parent().next().next("div").addClass("hide");
                $(".qtn-city").eq(idx).parent().next("div").addClass("hide");
            }
        });
        
        $(document).on('keydown.autocomplete', ".departure-city", function() {
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
                    $(".departure-city").val(ui.item.label); // display the selected text
                    return false;
                }
            });
        });
        
        function get_index(idx){
            var return_idx = 0;
            if(idx >= 0 && idx <= 2){
                return_idx = 0;
            }else if(idx >= 3 && idx <= 5){
                return_idx = 1;
            }else if(idx >= 6 && idx <= 8){
                return_idx = 2;
            }else if(idx >= 9 && idx <= 11){
                return_idx = 3;
            }else if(idx >= 12 && idx <= 14){
                return_idx = 4;
            }else if(idx >= 15 && idx <= 17){
                return_idx = 5;
            }else if(idx >= 18 && idx <= 20){
                return_idx = 6;
            }else if(idx >= 21 && idx <= 23){
                return_idx = 7;
            }else if(idx >= 24 && idx <= 26){
                return_idx = 8;
            }else if(idx >= 27 && idx <= 29){
                return_idx = 9;
            }
            return return_idx;
        }
        
        $(document).on('keydown.autocomplete', ".daywise-hotels", function() {
            var idx = $(this).index(".daywise-hotels");
            /*var city_idx = get_index(idx);
            var type = $("input[name='hotel_category[]']:checked").map(function () {
                return this.value;
            }).get();*/
            var type = $(this).attr("data-category");
            //hdn_night_1_4_star_ids[]
            var hotel_ids = $("input[name='hdn_night_"+$(this).attr("data-night")+"_"+type.replaceAll(" ","_").toLowerCase()+"_ids[]']").map(function () {
                return this.value;
            }).get();
            var city_name = $(".qtn-city").eq($(this).attr("data-night")).val();
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_hotel_citywise",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            city: city_name,
                            type: type,
                            hotel_ids: hotel_ids
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection                    
                    $(".daywise-hotels").eq(idx).val(ui.item.label); // display the selected text
                    //$(".hdn-hotelids").eq(idx).val(ui.item.hotel_id+'-'+idx);
                    $(".hdn-hotelids").eq(idx).val(ui.item.hotel_id);
                    return false;
                }
            }).blur(function(event) {
                if($(".daywise-hotels").eq(idx).val() === ""){
                    $(".hdn-hotelids").eq(idx).val("");
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
                    $(".hdn-restaurants").eq(idx).val(ui.item.restaurants_id); // display the selected text
                    return false;
                }
            });
        });
        
        $(document).on('keydown.autocomplete', ".guides", function() {
            var idx = $(this).index(".guides");
            var actual_idx = $(".guides").eq(idx).attr("data-idx");             
            $(this).autocomplete({                
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/quotation/get_guides",
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
                    $(".guides").eq(idx).val(ui.item.label).css("border-color","#ccc"); // display the selected text
                    $(".hdn-guides").eq(idx).val(ui.item.guide_id); // display the selected text
                    return false;
                }
            });
        });
        $('#myModalquotation').on('hidden.bs.modal', function () {
            location.reload();
        });
        
        $("#frm_1").on("click",".add-rooms-details",function(){
            event.preventDefault();
            var idx = $(this).index(".add-rooms-details");
            var mainDiv = $(".add-rooms-details").eq(idx).parent().parent().parent();
            var parentDiv = $(".add-rooms-details").eq(idx).closest('div').parent().parent();
            var count = mainDiv.find('div.room-details').length;
            var family_count = $('.family').length;
            var html = '';
            var adults_num = $("input[name='family_adults[]']").eq(idx).val();
            var child_num = $("input[name='family_child[]']").eq(idx).val();
            //alert(family_count);
            if($("input[name='family_"+family_count+"_adults[]']").length > 0){
                $("input[name='family_"+family_count+"_adults[]']").each(function(i,v){
                    adults_num = adults_num - parseInt($("input[name='family_"+family_count+"_adults[]']").eq(i).val());
                    child_num = child_num - parseInt($("input[name='family_"+family_count+"_child[]']").eq(i).val());
                });
            }
            if(adults_num <= 0 || child_num < 0){
                return false;
            }
            
            html += '<div class="row mt-2 room-details">';                                                            
            html += '<div class="col-md-2">';
            html += '<div class="form-floating mt-2">';
            html += '<span class="bold">Room '+(count+1)+' (No. of Adults)</span>';
            html += '</div></div>';
            html += '<div class="col-md-2"><input type="number" class="form-control family-adults" name="family_'+family_count+'_adults[]" value="'+adults_num+'"></div>';
            html += '<div class="col-md-2">';
            html += '<div class="form-floating mt-2">';
            html += '<span class="bold">Room '+(count+1)+' (No. of Child)</span>';
            html += '</div></div>';
            html += '<div class="col-md-2"><input type="number" data-room-cnt= "'+(count+1)+'" class="form-control family-child" name="family_'+family_count+'_child[]" value="'+child_num+'"></div>';
            html += '<div class="col-md-4"></div></div>';
            parentDiv.append(html);            
        });
        
        $("#frm_1").on("click",".remove-rooms-details",function(){
            event.preventDefault();
            var idx = $(this).index(".remove-rooms-details");
            var mainDiv = $(".remove-rooms-details").eq(idx).parent().parent().parent();
            mainDiv.find('.room-details').last().remove();
        });
        
        $(".add-family").on("click",function(){
            event.preventDefault();
            var count = $('.family').length;
            var mainDiv = $('.family').eq(0);
            var clonedDiv = mainDiv.clone();
            
            var adults_num = $("#number_of_adults").val();
            var child_num = $("#number_of_child").val();
            
            $("input[name='family_adults[]']").each(function(i,v){
                adults_num = adults_num - parseInt($("input[name='family_adults[]']").eq(i).val());
                child_num = child_num - parseInt($("input[name='family_child[]']").eq(i).val());
            });
            
            if(adults_num <= 0 || child_num < 0){
                return false;
            }
            clonedDiv.find('.row').not(':first').remove();
            clonedDiv.find('.bold').eq(0).html("Family "+(count+1)+" Adults");
            clonedDiv.find('.bold').eq(1).html("Family "+(count+1)+" Child");
            clonedDiv.find('input[name="family_adults[]"]').val(adults_num);
            clonedDiv.find('input[name="family_child[]"]').val(child_num);
            $(".family").eq(count-1).after(clonedDiv);
        });
        
        $(".remove-family").on("click",function(){
            if($('.family').length > 1) $('.family').last().remove();
        });
        
        $("#frm_1").on("blur",".family-child",function(){ 
            var idx = $(this).index(".family-child");
            var v = $(".family-child").eq(idx).val();            
            var arr_map = ['First','Second','Third','Forth','Fifth','Sixth'];
            $(".family-child").eq(idx).parent().next('div').html("");
            var ele_name = $(".family-child").eq(idx).attr("name").split("_");
            var room_cnt = $(".family-child").eq(idx).attr("data-room-cnt");
            
            if(v > 0){                
                var final_select = '';
                for(var j = 1;j<=v;j++){
                    var ele = ' <select class="" style="padding:6px 6px;" name="'+ele_name[0]+'_'+ele_name[1]+'_room_'+room_cnt+'_child_age[]"><option value="">'+arr_map[j-1]+'</option>';                    
                    for(var i = 1;i<=12;i++){
                        ele += '<option value="'+i+'">'+i+'</option>';
                    }
                    ele += '</select>';
                    final_select +=ele;
                }
                $(".family-child").eq(idx).parent().next('div').append("Child Age : "+final_select);
            }
        });
                
        $("#frm_1").on("keyup",".family-child",function(event){
            var idx = $(this).index(".family-child");
            var total_child_num = $("#number_of_child").val();
            var child_num = 0;
            $(".family-child").each(function(i,v){
                child_num = child_num + parseInt($(".family-child").eq(i).val());
            });
            $(".family-child").css("border-color","");
            if(child_num > total_child_num){                
                $(".family-child").eq(idx).css("border-color","#ff0000 !important").val(0);
                alert("Total child allowed is "+total_child_num+".");
            }
        });
        
        $("#frm_1").on("keyup",".family-adults",function(event){
            var idx = $(this).index(".family-adults");
            var total_adults_num = $("#number_of_adults").val();
            var adult_num = 0;
            $(".family-adults").each(function(i,v){
                adult_num = adult_num + parseInt($(".family-adults").eq(i).val());
            });
            $(".family-adults").css("border-color","");
            if(adult_num > total_adults_num){                
                $(".family-adults").eq(idx).css("border-color","#ff0000").val(0);
                alert("Total adults allowed is "+total_adults_num+".");
            }
        });
        
    });
</script>
    
<script>
    flatpickr("#initial-airline-departure-time", {
        enableTime: false,
        noCalendar: true,
        dateFormat: "H:i",  // 24-hour format
        time_24hr: true,
    });
    flatpickr(".airline-search-depart-time", {
        enableTime: false,
        noCalendar: true,
        dateFormat: "H:i",  // 24-hour format
        time_24hr: true,
    });
    flatpickr("#flight-arrival", {
        enableTime: false,
        noCalendar: true,
        dateFormat: "H:i",  // 24-hour format
        time_24hr: true,
    });
    $('#myModalquotation').on('shown.bs.modal', function () {
        flatpickr(".city_arrival_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 1,
            allowInput: true
        });
    });
</script>

<script>
    $('#comboForm').on('submit', function(e) {
        e.preventDefault();

        var input1 = $('#input1').val().trim();
        var input2 = $('#input2').val().trim();

        $.ajax({
            url: '<?= base_url("admin/arrivalchart/save_combo") ?>',
            type: 'POST',
            data: { input1: input1, input2: input2 },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // alert('Combo saved!');
                    $('#combo_success').text(response.message).show();
                    $('#comboForm')[0].reset();
                    $('#comboModal').modal('hide');
                } else {
                    $('#combo_success').text(response.message).show();
                    $('#comboForm')[0].reset();
                    $('#comboModal').modal('hide');
                    // alert(response.message || 'Failed to save combo');
                }
            }
        });
    });
    $(document).on("change", "input[name='hotel_category[]']", function () 
    {
    var $checkbox = $(this);
    var isChecked = $checkbox.is(":checked");

    // Find the parent row
    var $row = $checkbox.closest(".row");

    // Enable/disable <select> and room type checkboxes
    $row.find("select[name='num_comparison_hotels[]']").prop("disabled", !isChecked);

    // Enable/disable corresponding room types
    var category = $checkbox.val().replace(/\s+/g, "_").toLowerCase(); // e.g. "3 Star" => "3_star"
    $row.find("input[name='" + category + "_room_type[]']").prop("disabled", !isChecked);
});

</script>
<?php if ($this->session->userdata('type') == '1' || $this->session->userdata('type') == '3'){ ?>
<script>
$(document).ready(function () {
    // Utility: Get URL parameter
    const params = new URLSearchParams(window.location.search);
    const bookingTypeFromURL = params.get('booking_type') || "";
    const staffIdFromURL = params.get('staff_id');

    // Function to update Booking Types dropdown based on selected Location
    function updateBookingTypesFromLocation(selectedLocation, selectedBookingType = "") {
        var selectedOption = $(".location option[value='" + selectedLocation + "']");
        var v = selectedOption.attr('data-abbr');

        $(".booking_type").empty().parent().removeClass("is-dirty");

        if (v !== "" && v !== undefined) {
            var opts = v.split(",");
            $(".booking_type").parent().addClass("is-dirty");

            // Append "All" option
            // var selectedAll = (selectedBookingType === "all") ? 'selected="selected"' : '';
            $('.booking_type').append('<option value="all" selected="selected">All</option>');

            // Append other booking type options
            $.each(opts, function (i, d) {
                var selected = (selectedBookingType === d) ? 'selected="selected"' : '';
                $('.booking_type').append('<option value="' + d + '" ' + selected + '>' + d + '</option>');
            });

            // Trigger user fetch if booking type present
            getUsersByBookingType(selectedBookingType, staffIdFromURL);
        }
    }

    // Function to fetch and display users by booking type
    function getUsersByBookingType(bookingType, selectedStaffId = null) {
        const selectedLocation = $(".location").val(); // ⬅️ Get selected location

        if (!bookingType) {
            $('.staff_id').html('<option value="">Select</option>');
            return;
        }

        $('.staff_id').html('<option value="">Loading...</option>');

        $.ajax({
            url: '<?= base_url("admin/enquiry/get_users_by_booking_types") ?>',
            type: 'GET',
            data: { 
                booking_type: bookingType, 
                location: selectedLocation
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    var users = response.data;
                    var options = '<option value="all">All</option>';

                    $.each(users, function (i, user) {
                        var label = user.name + (user.hod === 'yes' ? ' (HOD)' : '');
                        var style = user.status == 2 ? 'style="color:red;"' : '';
                        var title = user.status == 2 ? 'title="User In-active no longer work with us"' : '';
                        var selected = (selectedStaffId && user.id == selectedStaffId) ? 'selected="selected"' : '';
                        options += '<option value="' + user.id + '" ' + style + ' ' + title + ' ' + selected + '>' + label + '</option>';
                    });

                    $('.staff_id').html(options);
                } else {
                    $('.staff_id').html('<option value="">No users found</option>');
                }
            },
            error: function () {
                $('.staff_id').html('<option value="">AJAX error occurred</option>');
            }
        });
    }

    // Initial population on page load
    var selectedLocation = $(".location").val();
    updateBookingTypesFromLocation(selectedLocation, bookingTypeFromURL);

    // When location is changed, update booking type dropdown
    $(".location").on("change", function () {
        var newLocation = $(this).val();
        updateBookingTypesFromLocation(newLocation, "");
        var newBookingType = $('.booking_type').val();
        getUsersByBookingType(newBookingType);
    });

    // When booking type is changed, update users list
    $('.booking_type').on('change', function () {
        var newBookingType = $(this).val();
        getUsersByBookingType(newBookingType);
    });
});
</script>
<?php  } ?>
<?php if ($this->session->userdata('type') == '2'){ ?>
<script>
$(document).ready(function () {
    function fetchBookingTypeAndUsers(location, callback = null) {
        if (!location) return;
        $.ajax({
            url: '<?= base_url("admin/enquiry/get_booking_data_for_hod_user") ?>',
            type: 'GET',
            data: { location: location },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    // Set booking type options
                    var typeOptions = '<option value="">Select</option>';
                    $.each(res.booking_type_options, function (i, val) {
                        var selected = (val === res.selected_booking_type) ? 'selected' : '';
                        typeOptions += '<option value="' + val + '" ' + selected + '>' + val + '</option>';
                    });
                    $('.booking_type').html(typeOptions);

                    // Set users
                    populateUsers(res.users, res.logged_in_user_id);
                    //  trigger callback after DOM update
                    if (typeof callback === 'function') {
                        setTimeout(callback, 10); // slight delay ensures DOM is ready
                    }
                } else {
                    $('.booking_type').html('<option value="all" selected="selected">All</option>');
                    $('.staff_id').html('<option value="">No Users</option>');
                }
            }
        });
    }

    function fetchUsersByBookingType(bookingType, location) {
        if (!bookingType) return;

        $.ajax({
            url: '<?= base_url("admin/enquiry/get_users_by_booking_type_filtered") ?>',
            type: 'GET',
            data: { booking_type: bookingType, location: location },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    populateUsers(res.users, res.logged_in_user_id);
                } else {
                    $('.staff_id').html('<option value="">No users found</option>');
                }
            }
        });
    }

    function populateUsers(users, loggedInUserId) {
        var userOptions = '<option value="">Select User</option>';
        if (users.length > 0) {
            $.each(users, function (i, user) {
                var selected = (user.id == loggedInUserId) ? 'selected' : '';
                var label = user.name;

                if (user.hod === 'yes') {
                    label += '';
                }
                if (user.id == loggedInUserId) {
                    label += '';
                }

                userOptions += '<option value="' + user.id + '" ' + selected + '>' + label + '</option>';
            });
        } else {
            userOptions = '<option value="">No Users</option>';
        }
        $('.staff_id').html(userOptions);
    }

    // On location change
    $('.location').on('change', function () {
        const location = $(this).val();
        if (!location) return;
    
        // Fetch booking types and users first, then load chart using selected booking type
        fetchBookingTypeAndUsers(location, function () {
            const updatedBookingType = $('.booking_type').val(); // get after dropdown updates
            loadSalesTeamChart(); // if needed you can pass updatedBookingType
        });
    });



    // On booking type change
    $('.booking_type').on('change', function () {
        var selectedBookingType = $(this).val();
        var location = $('.location').val();
        fetchUsersByBookingType(selectedBookingType, location);
    });

    // Initial load
    var initialLocation = $('.location').val();
    if (initialLocation) {
        fetchBookingTypeAndUsers(initialLocation);
        setTimeout(function () {
            loadSalesTeamChart();
    }, 300);
    }
});
</script>
<?php } ?>
<script>

</script>

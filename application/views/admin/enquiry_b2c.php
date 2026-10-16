<?php include('admin_head_css.php'); ?>
<style>
    .readonly-check,
    .readonly-check * {
        pointer-events: none !important;
        opacity: 0.7;
    }
</style>
<div class="page-wrapper">
    <!-- start page content -->
    <div class="container-fluid">
      <div class="page-content">
        <div class="page-bar">
          <div class="row page-titles">
                <div class="col-md-5 col-5 align-self-center">
                    <h4 class="text-themecolor">Queryboard</h4>
                </div>
                <div class="col-md-7 col-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url('enquiry-followup');?>">Queryboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> 
        <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?> 
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box">
             
              <form method="post">
                                        <div class="card-body row">
                                        
                                            <div class="col-lg-4 p-t-20"> 
                                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                    <label class = "mdl-textfield__label">Query Type</label>		 	 
                                                    <select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" required>                                                        
                                                        <option value="B2C">B2C</option>                                                        									
                                                    </select>    
                                                </div>
                                            </div>
                                            
                                            
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php
                                            $location_keys = ($this->session->userdata('locations')=='all')?array_keys($locations):[$this->session->userdata('locations')]; ?>
                                                <label class = "mdl-textfield__label">Booking Type</label>		 	 
                                            <select name="booking_type" id="booking_type" class="mdl-textfield__input" required> 
                                                <option value=""></option>
                                                <?php foreach($location_keys AS $list){ 
                                                        foreach($locations[$list] AS $v){
                                                    ?>
                                                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                                <?php }} ?>
                                            </select>    
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                          <label class = "mdl-textfield__label">File No</label><?php echo form_error('enquiry_no');?>
                                        <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=> set_value('enquiry_no'),'readonly'=>True])?>			 
                                    <input type="hidden" name="file_seq" id="file_seq" value=""/>
                                  </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <label class = "mdl-textfield__label">Number Of Persons</label><?php echo form_error('number_persons');?>
                                            <?php echo form_input(['type'=>'number','min'=>0,'name'=>'number_persons','id'=>'number_persons', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('number_persons')])?>			 

                                        </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20" id="childAgeWrapper"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <label class = "mdl-textfield__label">Number Of Child</label><?php echo form_error('number_child');?>
                                            <?php echo form_input(['type'=>'number','min'=>0,'name'=>'number_child','id'=>'number_child', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('number_child')])?>			 

                                        </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20"> 
                                        <label class = "mdl-textfield__label">Check In Date</label><?php echo form_error('check_in');?>
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-search-show" style="width:100%;" readonly>
                                            <?php echo form_input(['type'=>'date', 'name'=>'check_in','placeholder'=>'','id'=>'check_in', 'required'=>'required', 'class'=>'dts dt-search', 'value'=>set_value('check_in'),'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 

                                        </div>
                                    </div>
                                            
                                    <div class="col-lg-2 p-t-20"> 
                                        <label class = "mdl-textfield__label">Check Out Date</label><?php echo form_error('check_out');?>
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-search-show" style="width:100%;" readonly>
                                            <?php echo form_input(['type'=>'date', 'name'=>'check_out','placeholder'=>'','id'=>'check_out', 'required'=>'required', 'class'=>'dts dt-search', 'value'=>set_value('check_out'),'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <label class = "mdl-textfield__label">Number Of Nights</label><?php echo form_error('number_of_nights');?>
                                            <?php echo form_input(['type'=>'number','min'=>0, 'name'=>'number_of_nights','placeholder'=>'','id'=>'number_of_nights', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('number_of_nights')])?>			 

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <label class = "mdl-textfield__label">Query Received Date</label><?php echo form_error('query_received_on');?>
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-querydate-show" value="<?php echo date('d-M-Y',strtotime((set_value('query_received_on')<>'')?set_value('query_received_on'):date('Y-m-d'))); ?>" style="width:100%;" readonly>
                                            <?php echo form_input(['type'=>'date', 'name'=>'query_received_on','placeholder'=>'','id'=>'query_received_on', 'required'=>'required', 'class'=>'dt-querydate readonly-check', 'value'=>(set_value('query_received_on')<>'')?set_value('query_received_on'):date('Y-m-d'),'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 

                                        </div>
                                    </div>                                            
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <label class = "mdl-textfield__label">Select mode</label>		 	 
                                            <select name="mode" id="mode" class="mdl-textfield__input" required> 
                                                <option value="Email">Email</option>
                                                <option value="Phone">Phone</option>									
                                                <option value="Reference">Reference</option>
                                                <option value="Visit">Visit</option>
                                                <option value="Marketing">Marketing</option>                                                
                                            </select>    
                                        </div>
                                    </div>																																																							

                                    <div class="col-lg-4 p-t-20" id="refered_person" style="display:none;"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                          <label class = "mdl-textfield__label">Select Reference</label>		 	 

                                            <select name="reference_by" id="reference_by" class="mdl-textfield__input"> 
                                            <option value=""> </option>
                                            <?php foreach($users AS $list){ ?>
                                                <option value="<?=$list->name?>"><?=$list->name?></option>
                                            <?php } ?>
                                            </select>    
                                  </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <label class = "mdl-textfield__label">Handling File By</label>	 	 
                                                <select name="file_handle_by" id="file_handle_by" class="mdl-textfield__input"> 
                                                <option value=""></option>
                                                <?php if(!empty($users)){
                                                foreach($users as $user){ 
                                                if($user->type != '5'){    
                                                ?>
                                                <option value="<?=$user->id?>"><?=$user->name?></option>
                                                <?php } 
                                                        } }?>
                                                </select> 
                                  </div>
                                    </div>                                     
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <!--	<textarea class="mdl-textfield__input" name="remarks[]" required> </textarea> -->
                                                <label class = "mdl-textfield__label">Remarks</label>	 	 
                                                        <input type="text" class="mdl-textfield__input" name="remarks">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">Sales Team</label>	 	 
                                            <select name="sales" id="sales" class="mdl-textfield__input"> 
                                                <option value="0">Select..</option>
                                                 <?php if(!empty($users)){
                                                    foreach($users as $user){ 
                                                    if($user->type == '5'){    
                                                    ?>
                                                <option value="<?=$user->id?>"><?=$user->name?></option>
                                                <?php } 
                                                        } }?>
                                            </select> 
                                        </div>
                                    </div>
                                            
                    <div class="card-body row">
                        <div class="col-sm-12"><h4 style="background-color: #f9f9f9;padding: 10px 10px;">Client Details</h4></div>
                        <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <label class = "mdl-textfield__label">Company</label><?php echo form_error('company');?>		 	 
                                <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name',  'class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>			 
                            </div>
                            <input type="hidden" name="company_id" id="company_id">
                        </div>
                        
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Client Name</label>
                <?php echo form_input(['name'=>'client_name','id'=>'client_name','placeholder'=>'Client Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_name')])?>			 
                  </div>
                    </div>
                    
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Client Designation</label>
                <?php echo form_input(['name'=>'client_designation','id'=>'client_designation','placeholder'=>'Client Designation', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_designation')])?>			 
                  </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Client Email Address</label> 	 	 
                <?php echo form_input(['name'=>'client_email','placeholder'=>'Client Email Address','type'=>'email','id' =>'client_email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_email')])?>			 
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">               
                          <label class = "mdl-textfield__label">ISD Code</label>	 	 
                     <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                    <?php 
                    $selected = '+91';
                    //$allowed_countries = ['AZ','BY','IN','KZ'];
                    foreach($country_isd_codes AS $list){                          
                        ?>
                              <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                    <?php  } ?>
                  </select>
                  </div>
                    </div>                    
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Client Contact Number</label>	 	 
                <?php echo form_input(['name'=>'client_contact_number','id'=>'client_contact_number','placeholder'=>'Client Contact Number', 'required'=>'required','type'=>'number', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_contact_number')])?>			 
                  </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                          <label class = "mdl-textfield__label">Country</label> 		 	 
                <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
                  </div>
                    </div>
                <input type="hidden" name="country_id" id="country_id" value="">

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                          <label class = "mdl-textfield__label">State</label>		 	 
                <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                  </div>
                    </div>
                <input type="hidden" name="state_id" id="state_id" value="">

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                          <label class = "mdl-textfield__label">City</label>		 	 
                <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                  </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Address</label>	 	 
                        <textarea class="mdl-textfield__input" id="address" name="address" required><?php echo set_value('address');  ?>  </textarea>			
                  </div>
                    </div>									

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Company GSTIN(IF Any)(e.g 18AABCU9603R1ZM )</label>	 	 
                          <?php echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN','class'=>'mdl-textfield__input', 'value'=>set_value('gstin')])?>    
                  </div>
                    </div>                  
                    </div>                       
                    <div class="col-lg-12 p-t-20 text-center"> 
                         <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                         <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
                     </div>                                
                                    
                            </div>						

                        </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end page content -->
  </div>
<script>

$(document).ready(function(){
    generateChildAgeFields();

    $(document).on("input","#number_child",function(){
        generateChildAgeFields();
    });

    function generateChildAgeFields(){

        let count = parseInt($("#number_child").val()) || 0;
        let html = "";
        $("input[name='child_age[]']").closest('.col-lg-2').remove();

        for(let i=0; i<count; i++){

            html += `
            <div class="col-lg-2 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class="mdl-textfield__label">Child ${i+1} Age</label>
                    <input type="number" 
                        name="child_age[]" 
                        value=""
                        class="mdl-textfield__input"
                        min="0" required>
                </div>
            </div>`;
        }

        $("#childAgeWrapper").after(html);
    }
    
    $( "#company" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
             url: "<?=base_url()?>admin/company/company_name_suggesstion",
             type: 'post',
             dataType: "json",
             data: {
              search: request.term
             },
             success: function( data ) {
              response( data );
              dt = data;
              $(".err").html('');;
             }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#company').val(ui.item.label); // display the selected text
            $('#company_id').val(ui.item.company_id); // save selected id to input
            get_agents();
        }
    });
    
    
    $( "#country" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/get_country_ajax",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
		
         response( data );
        }
       });
      },
     
      select: function (event, ui) {
        // Set selection
        $('#country').val(ui.item.label); // display the selected text
        $('#country_id').val(ui.item.country_id); // save selected id to input
        
      }
    });
    
    $("#btn_company").on("click",function(){
        let myForm = document.getElementById("frm_company");
        var data = new FormData(myForm);
        $("#btn_company").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "admin/enquiry/add_new_company",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDiv").html('').html(data.msg);
                $("#btn_company").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_company")[0].reset();
                    //$("#company_id").append('<option value="'+data.details.c_id+'">'+data.details.c_name+'</option>');
                }
            }
        });
    });
    
    $("#btn_agent").on("click",function(){
        if($("#company_id").val()===""){ alert('Please select company to add agents.'); return false; }
        let myForm = document.getElementById("frm_agent");
        var data = new FormData(myForm);
        data.set("company_id",$("#company_id").val());
        $("#btn_agent").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "admin/enquiry/add_new_agent",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDivagent").html('').html(data.msg);
                $("#btn_agent").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_agent")[0].reset();
                    $("#agent").append('<option value="'+data.details.a_id+'">'+data.details.a_name+'</option>');
                }
            }
        });
    });   
    
    $(".dts").on("change",function(){
        if($('.dts:eq(0)').val()==="" || $('.dts:eq(1)').val()==="") { return false; }
        const pre = new Date($('.dts:eq(0)').val());
        const last = new Date($('.dts:eq(1)').val());        
        if(pre > last){
            alert('Check-in date must be less than Check-out date.');
            //$(".dts").val('');
        }else{
            const diffInMs   =  Math.abs(last- pre);
            const diffInDays = Math.round(diffInMs/(1000 * 60 * 60 * 24));
            $("#number_of_nights").val(diffInDays);
        }
    });
    
    $(".dt-search").on("change",function(){
        var idx = $(this).index(".dt-search");
        const selectedDate = new Date($(".dt-search").eq(idx).val());
        //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
        const options = { year: 'numeric', month: 'short', day: '2-digit' };
        const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
        $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
        //alert(selectedDate.getTime());

        if($(this).attr("id") === "check_in" && $("#check_out").val() === ""){
            $("#check_out").attr("min",$(this).val());
        }else if($(this).attr("id") === "check_in" && $("#check_out").val() !== ""){
            const selectedToDate = new Date($("#check_out").val());
            if(parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())){
                $("#check_out").val('').attr("min",$(this).val());
                $(".dt-search-show").eq($("#check_out").index(".dt-search")).val('');
            }
        }
        if($(this).attr("id") === "check_out" && $("#check_in").val() === ""){
            $("#check_in").attr("max",$(this).val());
        }else if($(this).attr("id") === "check_out" && $("#check_in").val() !== ""){
            const selectedFromDate = new Date($("#check_in").val());
            if(parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())){
                $("#check_in").val('').attr("max",$(this).val());
                $(".dt-search-show").eq($("#check_in").index(".dt-search")).val('');
            }
        }
    });
    
    
});  
 
$(document).ready(function(){ 

    $( "#state" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/get_state_ajax",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,
		 country_id : $('#country_id').val()
        },
        success: function( data ) {
		
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#state').val(ui.item.label); // display the selected text
       $('#state_id').val(ui.item.state_id); // save selected id to input
	
       return false;
      }
     });
    $("#booking_type").on("change",function(){
        if($("#booking_type").val() === ''){ $("#enquiry_no").val(''); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/enquiry/get_enquiry_num",
            data:{'booking_type':$("#booking_type").val()},
            dataType: 'JSON',
            success: function(data){
                $("#enquiry_no").parent("div").addClass("is-dirty is-focused");
                $("#enquiry_no").val('').val(data.file_num);
                $("#file_seq").val(data.file_seq);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    });
    
     
});

    function get_agents(){
        if($("#company_id").val() === "") { $("#agent").empty(); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/company/get_branch_ajax",
            data:{'company':$("#company_id").val()},
            success: function(data){
                $("#agent").empty().parent().addClass("is-dirty");
                //$('#branch').append('<option value="">Select Branch</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                   $('#agent').append('<option value="' + d.company_id +'_' +d.contact_person + '">' + d.contact_person + '</option>');
                });
                
            },
                error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }

$(document).ready(function(){ 

     $( "#city" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/get_city_ajax",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,
		 state_id:$('#state_id').val()
        },
        success: function( data ) {
		
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#city').val(ui.item.label); // display the selected text
    //   $('#company_id').val(ui.item.company_id); // save selected id to input
	
       return false;
      }
     });
});
</script>	
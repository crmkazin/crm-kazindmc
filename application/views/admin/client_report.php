<?php include('admin_head_css.php');?> 

    <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">All User</h4>
                        </div>
                        <div class="col-lg-8 only-for-dashbord">
                        </div>
                        <div class="col-lg-2 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">All User</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">                    
                    <?php //include('report_links.php'); ?>	
                    <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>						
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="card-box">
                                            <div class="card-head">
                                                    <header>Search Agents</header>
                                            </div>	
                                    <form method="post">
                                            <div class="card-body row">
                                                
                                        <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'from_date','id'=>'from_date','class'=>'mdl-textfield__input', 'value'=>set_value('from_date')])?>			 
                                        <label class = "mdl-textfield__label">From Date</label><?php echo form_error('from_date');?>		 	 

                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'to_date','id'=>'to_date','class'=>'mdl-textfield__input', 'value'=>set_value('to_date')])?>			 
                                        <label class = "mdl-textfield__label">To Date</label><?php echo form_error('to_date');?>		 	 

                                            </div>
                                        </div>
                                        
                                                
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input', 'value'=>set_value('name')])?>			 
                                        <label class = "mdl-textfield__label">Organization</label><?php echo form_error('name');?>		 	 

                                                      </div>
                                        </div>																																																							
                                    <input type="hidden" name="company_id" id="company_id" value="">							
                                    <!--    <div class="col-lg-6 p-t-20" id="branch_section" style="display:none;"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                                    <select name="branch" id="branch" class="mdl-textfield__input"> 
                                                    <option value=""></option>
                                                    </select>    
                                                            <label class = "mdl-textfield__label">Select Branch</label>	 	 
                                      </div>
                                        </div> -->							

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'contact_person','id'=>'contact_person', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
                                        <label class = "mdl-textfield__label">Contact Person</label><?php echo form_error('contact_person');?>		 	 
                                      </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'email','type'=>'email','id' =>'email', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
                                        <label class = "mdl-textfield__label">Email Address</label> 	 	 
                                      </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'contact_number','id'=>'contact_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_number')])?>			 
                                        <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>		 	 
                                      </div>
                                        </div>

                                        <!--div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select class="chosen-select mdl-textfield__input" name="groups">
                                            <option value=""></option> 
                                            <?php //if(!empty($groups)){ 
                                            //foreach($groups as $group){
                                            ?>
                                            <option value="<? //=$group->group_name?>"><?//=$group->group_name?></option>
                                            <?php //} } ?>
                                            </select>                			 
                                        <label class = "mdl-textfield__label">Group</label>
                                      </div>
                                        </div-->

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                    <?php echo form_input(['name'=>'country','id'=>'country','class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
                                                            <label class = "mdl-textfield__label">Select Country</label> 		 	 
                                      </div>
                                        </div>
<!-- 							<input type="hidden" name="country_id" id="country_id" value="">
-->							
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                    <?php echo form_input(['name'=>'state','id'=>'state', 'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                                                            <label class = "mdl-textfield__label">State</label>		 	 
                                      </div>
                                        </div>
<!-- 							<input type="hidden" name="state_id" id="state_id" value="">
-->							
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                    <?php echo form_input(['name'=>'city','id'=>'city', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                                                            <label class = "mdl-textfield__label">City</label>		 	 
                                      </div>
                                        </div>

                                        <!--div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <textarea class="mdl-textfield__input" id="address" name="address" > </textarea>			
                                        <label class = "mdl-textfield__label">Address</label>	 	 
                                      </div>
                                        </div-->									
                                        
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <?php echo form_input(['name'=>'gst_number','id'=>'gst_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('gst_number')])?>    
                                        <label class = "mdl-textfield__label">GST Number</label>	 	 
                                      </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
                                        </div>
                                            </div>
                                    </form>
                                    </div>
                            </div>
			</div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>Add/Remove Column Fields</header>
                                <input type="checkbox" name="" class="view_all"/>
                                <label style="color:#000 !important;font-weight: 500;font-size: 15px !important;">View All</label>
                            </div>
                            <div class="card-body">
                                <div class="row"> 
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="1" name="oname" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="oname" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" name="group" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="group" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Group</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="3" name="cperson" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="cperson" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Person</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" name="cnumber" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="cnumber" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Number</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" name="email" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="email" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Email</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" name="address" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="address" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Address</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" name="state" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="state" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">State</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" name="country" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="country" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Country</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" name="date" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="date" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Date</label>
                                    </div>
                                </div>
			    </div>                            
                        </div>
                            
                        </div>
                    </div>
                </div> 
 
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Organizations</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a id="export_to_excel">Export to excel</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="client_report">
                                        <thead>
                                            <tr>
                                                <th class="center"><strong>Sr.No</strong></th>
                                                <th class="center"><strong>Organization</strong></th>
                                                <th class="center"><strong>Group</strong></th>
                                                <th class="center"><strong>Contact Person</strong></th>
                                                <th class="center"><strong>Contact Number</strong></th>	
                                                <th class="center"><strong>Email</strong></th>
                                                <th class="center"><strong>Address</strong></th>
                                                <th class="center"><strong>City</strong></th>
                                                <th class="center"><strong>State</strong></th>
                                                <th class="center"><strong>Country</strong></th>
                                                <th class="center"><strong>Date</strong></th>
                                                <!--th class="center noExl">Action</th-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        if(!empty($clients)) {
                                            
                                        foreach($clients as $companies) {
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                        <td class="center">
                                                        <?php if(is_numeric($companies->name)){
                                                        echo "Name Not Found";	
                                                        }else{
                                                        echo $companies->name;	
                                                        }?>
                                                        </td>
                                                        <td class="center"><?=$companies->group_name?></td>
                                                        <td class="center"><?=$companies->contact_person?></td>
                                                        <td class="center"><?=str_replace('+', '', $companies->contact_number) ?></td>
                                                        <td class="center"><?=$companies->email?></td>
                                                        <td class="center"><?=$companies->address ?></td>
                                                        <td class="center"><?=$companies->city ?></td>
                                                        <td class="center"><?=$companies->state ?></td>
                                                        <td class="center"><?=$companies->country ?></td>
                                                        <td class="center"><?=date('d-m-Y',strtotime($companies->date))?></td>
                                                        <!--td class="center noExl"><a href="<?/*=base_url().$companies->branch_id*/?>/edit-client">Edit</a></td-->
                                                </tr>
                                        <?php } }?>	
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>					
					
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
    </div>

<script>

  $(document).ready(function(){
  
     $( "#name" ).autocomplete({
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
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#name').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	   
	   var company_id = ui.item.company_id;
	   
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_branch_ajax",
        data:{'company':$("#company_id").val()},
        success: function(data){
            $("#branch").empty();
			$('#branch').append('<option value="">Select Branch</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
            });
			$('#branch').append('<option value="">Add New Branch</option>');
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });		   
	$("#branch_section").show();	
       return false;
      }
     });

  });

$(document).ready(function(){

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
	
       return false;
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

});

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

    $('#from_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        $(this).parent("div").addClass("is-focused");
        var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
        $('#to_date').val(today).parent("div").addClass("is-focused");
        $(this).parent("div").addClass("is-focused");
    });
    
    $('#to_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        if($('#from_date').val() === ''){
            alert('Select From Date');
            $(this).val('');
            return false;
        }
        $(this).parent("div").addClass("is-focused");
    });
    

});
 
$("#branch").change(function(){

	if($("#branch").val() == ''){

        $('#contact_person').val('');  
		$('#contact_number').val('');
		$('#email').val('');
		$('#address').val('');
		$('#country').val('');
		$('#state').val('');
		$('#city').val('');
		$('#submit').val('Add Branch');	
	
	}
	
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/branch_detail_ajax",
        data:{'branch_id':$("#branch").val()},
        success: function(data){
				
            var opts = $.parseJSON(data);
        $('#contact_person').val(opts.contact_person);  
		$('#contact_number').val(opts.contact_number);
		$('#email').val(opts.email);
		$('#address').val(opts.address);
		$('#country').val(opts.country);
		$('#state').val(opts.state);
		$('#city').val(opts.city);
		$('#submit').val('update');	
			
        },
		 error: function(jqXHR, textStatus, errorThrown) {
          
        }
    });	
});

</script>
<script>
   $(document).ready(function() {
        var table = $('#client_report').DataTable({
                        responsive: true
                });
                
        table.columns( [ 2,3,4,5,6,7,8,9,10 ] ).visible( false, false );
        table.columns.adjust().draw( false );
        $('.mdl-textfield__input').on( 'click', function (e) {
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
            // Toggle the visibility
            column.visible( ! column.visible() );
            table.columns.adjust().draw( false );
            $('.view_all').prop("checked",false);
            $(".dataTables_info").parent().parent('div').show();       
        });
        
        $(".view_all").on('click',function(){
            if($(this).prop("checked") === true){
                $('.mdl-textfield__input').prop('checked',true);
                table.columns( '.center' ).visible( true );
                $(".dataTables_info").parent().parent('div').show();
            }else{
                $('.mdl-textfield__input').prop("checked",false);
                table.columns( '.center' ).visible( false );
                $(".dataTables_info").parent().parent('div').hide();
            }
        });
    });
</script>	
</body>
<script>
    $('#export_to_excel').click(function () {
        $('<table>')
        .append($('<tr><tr><td></td><td></td><td></td><td><strong>Organization Report</strong></td></tr><tr><tr>'))
        .append( $("#example4 thead").clone())
         .append(
            $("#example4").DataTable().$('tr').clone()
         )
         .table2excel({
             preserveColors:true,
            filename: "Organization-report"
        });
        $("#example4").dataTable();
    });
</script>
</html>
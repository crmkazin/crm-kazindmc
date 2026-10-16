  <?php include('admin_head_css.php');?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
  <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
  <style>
      ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
div.info > div { border: 1px solid #efecec; }
.lbl-bold { font-weight:600!important; }
  </style>
<script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>  
  <script>
CKEDITOR.config.toolbar = [
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize'] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	'/',
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'insert', items: ['Table' ] }
    ];
</script>

  
</head>
<!-- END HEAD -->

  <div class="page-wrapper">

    <!-- start page container -->
    <div class="container-fluid">

      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                <h4 class="text-themecolor">Create Itinerary Template</h4>
                </div>
                <div class="col-lg-6 only-for-dashbord">
                </div>
                <div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('all-templates'); ?>">List</a></li>
                        </ol>
                    </div>
                </div>
            </div>	
        </div>		
        <div class="page-content">
          
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); 
          ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">  
                <div class="card-body row">
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <input type="text" class="mdl-textfield__input" name="template_name" id="template_name">
                            <label class="mdl-textfield__label">Name</label>
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>
                            <label class="mdl-textfield__label">Select Country</label>
                            <?php echo form_error('country'); ?>
                        </div>
                        <input type="hidden" name="country_id" id="country_id">
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'city','id'=>'city', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>
                            <label class="mdl-textfield__label">Select City</label>
                            <?php echo form_error('city'); ?>
                        </div>
                    </div>
                  <div class="col-lg-5">
                      <div id="msg"></div>
                      <?php echo form_open_multipart('', ['id'=>'frm1']); ?>
                    <div class="row">
                        
                        <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="itinerary_type" id="itinerary_type" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <option value="sitescene">Site Scene</option>
                                    <option value="activity">Activity</option>
                                    <option value="night-life">Night Life</option>
                                    <option value="restaurants">Restaurants</option>
                                    <!--option value="city1|city2">Cities</option>
                                    <option value="<?php //echo $suggestions[0]->guide; ?>">Guide</option>
                                    <option value="<?php //echo $suggestions[0]->trans; ?>">Transportation</option>
                                    <option value="<?php //echo $suggestions[0]->hotel; ?>">Hotel</option>
                                    <option value="Breakfast|Lunch|Dinner">Food</option>                                    
                                    <option>Good Bye Note</option-->
                                </select>
                                <label class="mdl-textfield__label">Suggestions</label>
                            </div>
                        </div>
                        <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="itinerary_values" id="itinerary_values" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                </select>
                                <label class="mdl-textfield__label">Select..</label>
                            </div>
                        </div>
                        <div class="col-lg-3 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="frm_day" id="frm_day" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <?php for($i=1;$i<=15;$i++){ ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php } ?>
                                </select>
                                <label class="mdl-textfield__label">Day</label>
                            </div>
                        </div>
                        <div class="col-lg-3 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="time" id="frm_time" name="" class="mdl-textfield__input">
                                <label class="mdl-textfield__label">Time</label>
                            </div>
                        </div>
                        <div class="col-lg-12" id="chk_suggestions" style="background-color:#f8fcff;display:none;padding:7px;word-wrap:break-word;line-height: 35px;">
                            
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <textarea class="form-control txt_description" name="description" id="description" required=""></textarea>
                            <script>CKEDITOR.replace( 'description');</script>
                            <br>
                            
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="text" class="mdl-textfield__input" name="itinerary_remarks" id="itinerary_remarks">
                                <label class="mdl-textfield__label">Remarks</label>
                            </div>
                            <button type="button" class="btn btn-primary" id="btn-add" style="float:right;">Add >></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                    
                    <div class="col-lg-7" style="background-color:#f8fcff;">
                        <?php echo form_open_multipart('',['id'=>'frm-timeline']); ?>
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="lbl-bold" style="text-align:center;">Itinerary Timeline</h4>
                            </div>
                            <div class="col-md-2 p-t-20"><label>Remarks</label></div>
                        </div>
                        <div class="row">
                    		<div class="col-md-12">
                                    <ul class="timeline">
                                        
                                    </ul>                                    
                    		</div>
                            <!--div class="col-md-2">Remarks</div-->
                            <div class="col-lg-12 p-t-20 text-right">
                                <button type="button" id="btn-submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Create</button>
                            </div>
                    	</div>
                        
                         <?php echo form_close(); ?>
                    </div>
                </div>
              </div>
            </div>
            <!-- end page content -->
          </div>
          <!-- end page container -->

          
        </div>
        <!-- start js include path -->
        <?php include('admin_footer_js.php');?>
        <!-- end js include path -->
</div>
</div>
</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script>
          $(document).ready(function () {
            
            $("#itinerary_values").on("change",function(){
                var opts = $(this).val().split("|");
                var html = '';
                const v = ["sitescene", "night-life", "activity"];
                if(v.indexOf($("#itinerary_type").val()) !== -1){
                    var labels = ['Name','Description','Departing Time','Entry Ticket'];
                    $.each(opts,function(i,val){
                        html += '<label class="bold">'+labels[i]+': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">'+val+'</span><br>';
                    });
                }else if($("#itinerary_type").val() === "restaurants"){
                    var labels = ['Name','Cuisine'];
                    $.each(opts,function(i,val){
                        html += '<label class="bold">'+labels[i]+': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">'+val+'</span><br>';
                    });
                }
                $("#chk_suggestions").fadeIn().html(html);
            });
            
            $("#itinerary_type").on("change",function(){
                var d = $(this).val();
                $("#chk_suggestions").html("").fadeOut();
                $.ajax({
                    url: "<?php echo site_url('get-itinerary-suggesstions'); ?>",
                    type: "post",
                    data: {"type":d},
                    dataType : 'JSON',
                    //contentType : false,
                    //processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        $("#itinerary_values").empty().append('<option value=""></option>');
                        if(data.response === "s"){
                            const v = ["sitescene", "night-life", "activity"];
                            if(v.indexOf($("#itinerary_type").val()) !== -1){
                                $.each(data.details,function(i,val){
                                    $("#itinerary_values").append('<option value="'+val.site_name+'|'+val.description+'|'+val.departing_time_from_hotel+'|'+val.entry_ticket+'">'+val.site_name+'</option>');
                                });
                            }else if($("#itinerary_type").val() === "restaurants"){
                                $.each(data.details,function(i,val){
                                    $("#itinerary_values").append('<option value="'+val.name+'|'+val.cuisine+'">'+val.name+'</option>');
                                });
                            }
                        }else if(data.response === "e"){
                            
                        }
                     }
                });
            });
            
            $("#frm1").on('click', '.suggesstions', function(){
                CKEDITOR.instances["description"].insertText($(this).html());
            });
            
            $("#btn-add").on("click",function(){
                var txt = CKEDITOR.instances["description"].getData();
                if($("#frm_day").val()=== "" || $("#frm_time").val() === "" || txt === ""){
                    $("#msg").html('<div class="alert alert-danger">Day, Time, Description Fields Are Mandatory!</div>');
                    return false;
                }
                
                var num_class = $('li.itinerary_li').length;
                
                txt = txt.replace(/(<p>|<\/p>)/g, "");
                if(num_class === 0){
                    html = '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">Day : '+$("#frm_day").val()+'</span><br>';
                    html += '<input type="hidden" value="'+$("#frm_day").val()+'" name="itinerary_day[]"></li>';                           
                    $(".timeline").append(html);
                }else if($("input[name='itinerary_day[]']").eq(num_class-1).val() !== $("#frm_day").val()){
                    html = '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">Day : '+$("#frm_day").val()+'</span><br>';
                    html += '<input type="hidden" value="'+$("#frm_day").val()+'" name="itinerary_day[]"></li>';                           
                    $(".timeline").append(html);
                }
                var idx = $('li.itinerary_li').last().index();
                html_li = '<p style="margin:7px 0 0;">';
                html_li += '<i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"></i>';
                html_li += '<label class="lbl-bold">'+$("#frm_time").val()+'Hrs</label> <span style="display:inline-table; width:70%;border-right:1px solid #f3f0ed;padding:3px;">'+txt+'</span>';
                html_li += '<span style="display:inline-flex; width:20%;padding:6px;">'+$("#itinerary_remarks").val()+'</span>';
                html_li += '<input type="hidden" name="itinerary_text_'+idx+'[]" value="'+encodeURI(txt)+'" >';
                html_li += '<input type="hidden" name="itinerary_remarks_'+idx+'[]" value="'+$("#itinerary_remarks").val()+'">';
                html_li += '<input type="hidden" name="itinerary_time_'+idx+'[]" value="'+$("#frm_time").val()+'"></p>';
    
                $('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
                $("#frm_time").val('');
                CKEDITOR.instances["description"].setData('');
                $("#msg").html('');
            });
            
            $("#frm-timeline").on("click",'.edit-remove',function(e){
                if(!confirm('Are You Sure?')){
                    return false;
                }
                e.preventDefault();
                $(this).parent().remove();
            });
            
            $("#btn-submit").on("click",function(){
                event.preventDefault();
                let myForm = document.getElementById("frm-timeline");
                var data = new FormData(myForm);
                data.set('template_name',$("#template_name").val());
                data.set('country',$("#country").val());
                data.set('city',$("#city").val());
                $("#btn-submit").html("Creating..").attr("disabled","disabled");
                $.ajax({
                    url: "<?php echo site_url('save-itinerary-template'); ?>",
                    type: "post",
                    data: data,
                    dataType : 'JSON',
                    contentType : false,
                    processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        if(data.response === "s"){
                            window.location.href = "<?php echo base_url('all-templates'); ?>";
                        }else if(data.response === "e"){
                            $("#btn-submit").html("Create").removeAttr("disabled");
                        }
                     }
                });
            });
            
            $("#country").autocomplete({
                source: function (request, response) {
                  // Fetch data
                  $.ajax({
                    url: "<?=base_url()?>admin/company/get_country_ajax_new",
                    type: 'post',
                    dataType: "json",
                    data: {
                      search: request.term
                    },
                    success: function (data) {

                      response(data);
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
            
            $("#city").autocomplete({
                source: function (request, response) {
                  // Fetch data
                  $.ajax({
                    url: "<?=base_url()?>admin/itinerary/get_city",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        country_id: $('#country_id').val()
                    },
                    success: function (data) {
                        response(data);
                    }
                  });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#city').val(ui.item.label); // display the selected text
                    //$('#company_id').val(ui.item.company_id); // save selected id to input

                    return false;
                }
            });
            
          });
        </script>

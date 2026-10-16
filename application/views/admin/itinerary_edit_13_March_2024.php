<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>KazinDMC CRM</title>
  <?php include('admin_head_css.php');?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
  <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
  <style>
      ul.timeline, ul.timeline_new {
    list-style-type: none;
    position: relative;
}
ul.timeline:before, ul.timeline_new:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li,ul.timeline_new > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before,ul.timeline_new > li:before {
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

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include('header.php');?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include('side_bar.php');?>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); 
          ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Edit Itinerary</header>
                  <div class="tools">
                    <a href="all-itinerary" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                
                <div class="card-body row">
                    <div class="col-lg-12 p-4">
                        <div class="row info">
                            <div class="col-lg-2">
                                <label class="lbl-bold"><?php echo $details->enquiry_no; ?></label>
                            </div>
                            <div class="col-lg-3">
                                <label class="lbl-bold">SOURCE AGENT</label> : <?php echo $details->agent; ?>
                            </div>
                            <div class="col-lg-3">
                                <label class="lbl-bold">Guide</label> : <?php echo $details->guide_name; ?>
                            </div>
                            <div class="col-lg-4">
                                <label class="lbl-bold">Lead PAX Name</label> : <?php echo $details->lead_name; ?> <br>
                                <label class="lbl-bold">Lead Contact</label> : (<?php echo $details->lead_isd_code.' '.$details->lead_contact; ?>)
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Guests</label> : <?php echo $details->number_persons+$details->number_child; ?> (<?php echo $details->number_persons; ?>A+<?php echo $details->number_child; ?>C) <?php echo $details->group_type; ?>
                            </div>
                            
                            <div class="col-lg-2">
                                <label class="lbl-bold">Arrival</label> : <?php echo ($arrival_date<>'')?date('d M, Y',strtotime($arrival_date)):''; ?>
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Departure</label> : <?php echo ($departure_date<>'')?date('d M, Y',strtotime($departure_date)):''; ?>
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Duration</label> : <?php echo $duration; //$details->number_of_nights; ?>
                            </div>
                            <div class="col-lg-4">
                                <label class="lbl-bold">Flight Details</label>
                                <ul>
                                    <?php foreach($flight_details AS $list){ ?>
                                    <li><?php echo $list->flight_number; ?> (<?php echo ucfirst($list->flight_mode); ?>)</li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="col-lg-6"><label class="lbl-bold">Hotel</label> : <?php echo $details->hotel_name; ?></div>
                            <div class="col-lg-6"><label class="lbl-bold">Vehicle</label> : <?php echo $details->vehicle_name.' ('.$details->vehicle_type.')'; ?></div>
                        </div>
                    </div>
                    <br>
                    
                  <div class="col-lg-5">
                      <div id="msg"></div>
                      <?php echo form_open_multipart('', ['id'=>'frm1']); ?>
                    <div class="row">
                        <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="itinerary_type" id="itinerary_type" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <option value="sitescene">Sightseeing</option>
                                    <option value="activity">Activity</option>
                                    <option value="night-life">Night Life</option>
                                    <option value="restaurants">Restaurants</option>
                                    <option value="transfers">Transfers</option>
                                    <option value="miscellaneous">Miscellaneous</option>
                                    <!--option value="city1|city2">Cities</option>
                                    <option value="<?php //echo $suggestions[0]->guide; ?>">Guide</option>
                                    <option value="<?php //echo $suggestions[0]->trans; ?>">Transportation</option>
                                    <option value="<?php //echo $suggestions[0]->hotel; ?>">Hotel</option>
                                    <option value="Breakfast|Lunch|Dinner">Food</option>
                                    <option >Explore The City</option>
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
                                <input type="date" id="frm_date" name="" class="mdl-textfield__input">
                                <label class="mdl-textfield__label">Date</label>
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
                            <button type="button" class="btn btn-primary" id="btn-edit" style="float:right;display:none;">Edit & Update >></button>
                            <button type="button" class="btn btn-primary" id="btn-add-update" style="float:right;display:none;">Add & Update >></button>
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
                                        <?php 
                                        $i = 0;
                                        if(!empty($itinerary)){
                                        $itinerary_date = $itinerary[0];
                                        foreach($itinerary AS $list){ 
                                            if($i==0 || $itinerary_date != $list->date){
                                            ?>
                                        <li class="itinerary_li">
                                            <input type="radio" name="rdo-edit" class="rdo">
                                            <span class="label label-primary itinerary_date" style="padding:5px;">
                                            <?php echo date('d M Y',strtotime($list->date)); ?></span><br>
                                            <input type="hidden" value="<?php echo $list->date; ?>" name="itineraryDate[]">
                                            <?php } ?>
                                            <p style="margin:7px 0 0;">
                                            <i title="Remove" class="fa fa-window-close edit-remove" data-id="<?php echo base64_encode($list->id); ?>" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>
                                            <label class="lbl-bold lbl-edit"><?php echo $list->time;  ?></label><strong>Hrs</strong>
                                            <span><i class="fa fa-edit edit" style="cursor:pointer;display:inline-flex; width:2%;" title="Edit" id="<?php echo $list->id; ?>"></i></span>
                                            <span class="txt-edit" style="display:inline-table; width:68%;border-right:1px solid #f3f0ed;padding:3px;"><?php echo urldecode($list->content); ?></span>
                                            <span class="rm-edit" style="display:inline-flex; width:20%;padding:6px;"><?php echo $list->remarks; ?></span>
                                            </p>
                                        <?php 
                                        $itinerary_date = $list->date;
                                        if(!array_key_exists($i+1,$itinerary) || $itinerary_date != $itinerary[$i+1]->date){ ?>
                                            </li>                          
                                        <?php } $i++; } }?>
                                            <input type="radio" name="rdo-edit" class="rdo" value="new">
                                    </ul> 
                                    <ul class="timeline_new">
                                        
                                    </ul>
                    		</div>
                            
                            <!--div class="col-md-2">Remarks</div-->
                            <div class="col-lg-12 p-t-20 text-right">
                                <button type="button" id="btn-submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Create</button>
                            </div>
                    	</div>
                        <input type="hidden" name="arrival_id" value="<?php echo $this->input->get('id'); ?>">
                         <?php echo form_close(); ?>
                    </div>
                </div>

              </div>
            </div>
            <!-- end page content -->
          </div>
          <!-- end page container -->
          <!-- start footer -->
          <?php include('admin_footer.php');?>
          <!-- end footer -->
          
        </div>
        <!-- start js include path -->
        <?php include('admin_footer_js.php');?>
        <!-- end js include path -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script>
          $(document).ready(function () {
            
            $("#itinerary_values").on("change",function(){
                var opts = $(this).val().split("|");
                var html = '';
                const v = ["sitescene", "night-life", "activity", "transfers", "miscellaneous"];
                if(v.indexOf($("#itinerary_type").val()) !== -1){
                    var labels = ['Name','Description','Departing Time','Entry Ticket'];
                    $.each(opts,function(i,val){
                        html += '<label class="bold">'+labels[i]+': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">'+val+'</span><br>';
                    });
                    $("#frm_time").val(opts[2]).parent("div").addClass("is-focused");
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
                    data: {"type":d,"location":"<?php echo $details->enquiry_abbr; ?>"},
                    dataType : 'JSON',
                    //contentType : false,
                    //processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        $("#itinerary_values").empty().append('<option value=""></option>');
                        if(data.response === "s"){
                            const v = ["sitescene", "night-life", "activity", "transfers", "miscellaneous"];
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
                CKEDITOR.instances["description"].insertHtml($(this).html());
            });
            
            $("#btn-add").on("click",function(){
                var txt = CKEDITOR.instances["description"].getData();
                if($("#frm_date").val()=== "" || $("#frm_time").val() === "" || txt === ""){
                    $("#msg").html('<div class="alert alert-danger">Date, Time, Description Fields Are Mandatory!</div>');
                    return false;
                }
                const frm_date = new Date($("#frm_date").val());
                const formattedDate = frm_date.toLocaleString("en-GB", {
                                        day: "numeric",
                                        month: "short",
                                        year: "numeric"
                                    });
                var num_class = $('li.itinerary_li_new').length;
                txt = txt.replace(/(<p>|<\/p>)/g, "");
                /*if(num_class === 0){
                    html = '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">'+formattedDate+'</span><br>';
                    html += '<input type="hidden" value="'+$("#frm_date").val()+'" name="itinerary_date[]"></li>';                           
                    $(".timeline").append(html);
                }else*/ 
                if($("input[name='itinerary_date[]']").eq(num_class-1).val() !== $("#frm_date").val()){
                    html = '<li class="itinerary_li_new"><span class="label label-primary itinerary_date" style="padding:5px;">'+formattedDate+'</span><br>';
                    html += '<input type="hidden" value="'+$("#frm_date").val()+'" name="itinerary_date[]"></li>';                           
                    $(".timeline_new").append(html);
                }
                var idx = $('li.itinerary_li_new').last().index();
                html_li = '<p style="margin:7px 0 0;">';
                html_li += '<i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>';
                html_li += '<label class="lbl-bold">'+$("#frm_time").val()+'Hrs</label> <span style="display:inline-table; width:70%;border-right:1px solid #f3f0ed;padding:3px;">'+txt+'</span>';
                html_li += '<span style="display:inline-flex; width:20%;padding:6px;">'+$("#itinerary_remarks").val()+'</span>';
                html_li += '<input type="hidden" name="itinerary_text_'+idx+'[]" value="'+encodeURI(txt)+'" >';
                html_li += '<input type="hidden" name="itinerary_remarks_'+idx+'[]" value="'+$("#itinerary_remarks").val()+'">';
                html_li += '<input type="hidden" name="itinerary_time_'+idx+'[]" value="'+$("#frm_time").val()+'"></p>';
                
                $('#frm-timeline li.itinerary_li_new').eq(idx).append(html_li);
                CKEDITOR.instances["description"].setData('');
                $("#frm_time").val('');
                $("#msg").html('');
            });
            
            $("#frm-timeline").on("click",'.edit-remove',function(e){
                if(!confirm('Are You Sure?')){
                    return false;
                }
                e.preventDefault();
                var u_id = $(this).attr("data-id");
                $.ajax({
                    url: "<?php echo site_url('admin/itinerary/update_remove'); ?>",
                    type: "post",
                    data: {"u_id":u_id,"arrival_id":"<?=$this->input->get('id') ?>"},
                    dataType : 'JSON',
                    //contentType : false,
                    //processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        if(data.response === "s"){
                            //$(".lbl-edit").eq(idx).html($("#frm_time").val());
                            //$(".txt-edit").eq(idx).html(txt);
                            //$(".rm-edit").eq(idx).html($("#itinerary_remarks").val());
                            CKEDITOR.instances["description"].setData('');
                            $("#frm_time").val('');
                        }else if(data.response === "e"){
                            //$("#btn-submit").html("Create").removeAttr("disabled");
                        }
                     }
                });
        
                $(this).parent().remove();
            });
            
            $("#btn-submit").on("click",function(){
                event.preventDefault();
                let myForm = document.getElementById("frm-timeline");
                var data = new FormData(myForm);
                $("#btn-submit").html("Creating..").attr("disabled","disabled");
                $.ajax({
                    url: "<?php echo site_url('save-itinerary'); ?>",
                    type: "post",
                    data: data,
                    dataType : 'JSON',
                    contentType : false,
                    processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        if(data.response === "s"){
                            window.location.href = "<?php echo base_url('all-itinerary'); ?>";
                        }else if(data.response === "e"){
                            $("#btn-submit").html("Create").removeAttr("disabled");
                        }
                     }
                });
            });
            
            $(".edit").on("click",function(){
                $("#btn-edit").show();
                $("#btn-add").hide();
                $("#btn-add-update").hide();
                var id = $(this).attr("id");
                var idx = $(this).index('.edit');
                $("#frm_time").val($(".lbl-edit").eq(idx).html()).parent("div").addClass("is-focused");
                CKEDITOR.instances["description"].setData($(".txt-edit").eq(idx).html());
                $("#itinerary_remarks").val($(".rm-edit").eq(idx).html()).parent("div").addClass("is-focused");
                $("#btn-add").hide();
                $("#btn-edit").show().attr("u_id",btoa(id)).attr("val-idx",idx);
            });
            
            $("#btn-edit").on("click",function(){
                var u_id = $(this).attr("u_id");
                var idx = $(this).attr("val-idx");
                var txt = CKEDITOR.instances["description"].getData();
                txt = txt.replace(/(<p>|<\/p>)/g, "");
                $.ajax({
                    url: "<?php echo site_url('update_itinerary'); ?>",
                    type: "post",
                    data: {"u_id":u_id,"time":$("#frm_time").val(),"txt" : encodeURI(txt),
                            "arrival_id":"<?=$this->input->get('id') ?>","remarks":$("#itinerary_remarks").val() },
                    dataType : 'JSON',
                    //contentType : false,
                    //processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        if(data.response === "s"){
                            $(".lbl-edit").eq(idx).html($("#frm_time").val());
                            $(".txt-edit").eq(idx).html(txt);
                            $(".rm-edit").eq(idx).html($("#itinerary_remarks").val());
                            CKEDITOR.instances["description"].setData('');
                            $("#frm_time").val('');
                        }else if(data.response === "e"){
                            //$("#btn-submit").html("Create").removeAttr("disabled");
                        }
                     }
                });
            });
            
            $(".rdo").on("click",function(){
                $("#btn-edit").hide();
                $("#btn-add").hide();
                $("#btn-add-update").hide();
                if(parseInt($(".rdo").length) === (parseInt($(this).index(".rdo"))+1)){
                    $("#btn-add").show();
                }else {
                    $("#frm_date").val($("input[name='itineraryDate[]']").eq($(this).index(".rdo")).val()).parent().addClass("is-focused");
                    $("#btn-add-update").show();
                }
            });
            
            $("#btn-add-update").on("click",function(){
                var idx = $("input:radio.rdo:checked").index(".rdo");
                var txt = CKEDITOR.instances["description"].getData();
                txt = txt.replace(/(<p>|<\/p>)/g, "");                
                $("#msg").html('');
                if($("#frm_date").val() !== $("input[name='itineraryDate[]']").eq(idx).val()){
                    alert('Date Mismatch.');
                    return false;
                }
                $.ajax({
                    url: "<?php echo site_url('add_update_itinerary'); ?>",
                    type: "post",
                    data: {"date":$("#frm_date").val(), "time":$("#frm_time").val(),"txt" : encodeURI(txt),
                            "arrival_id":"<?=$this->input->get('id') ?>","remarks":$("#itinerary_remarks").val() },
                    dataType : 'JSON',
                    //contentType : false,
                    //processData: false,
                    success: function (data) {
                        $("#msg").html("").html(data.msg);
                        if(data.response === "s"){
                            html_li = '<p style="margin:7px 0 0;">';
                            html_li += '<i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>';
                            html_li += '<label class="lbl-bold">'+$("#frm_time").val()+'Hrs</label> <span style="display:inline-table; width:70%;border-right:1px solid #f3f0ed;padding:3px;">'+txt+'</span>';
                            html_li += '<span style="display:inline-flex; width:20%;padding:6px;">'+$("#itinerary_remarks").val()+'</span>';
                            //html_li += '<input type="hidden" name="itinerary_text_'+idx+'[]" value="'+encodeURI(txt)+'" >';
                            //html_li += '<input type="hidden" name="itinerary_remarks_'+idx+'[]" value="'+$("#itinerary_remarks").val()+'">';
                            //html_li += '<input type="hidden" name="itinerary_time_'+idx+'[]" value="'+$("#frm_time").val()+'">';
                            html_li += '</p>';
                            var flag = false;
                            $("#frm-timeline .lbl-edit").each(function(index, element) {
                                if($(this).parent().parent().index('.itinerary_li') === idx){
                                    var start = $(this).html().split(":");
                                    var end = $("#frm_time").val().split(":");

                                    var lbl_time = new Date(0, 0, 0, start[0], start[1], 0);
                                    var new_time = new Date(0, 0, 0, end[0], end[1], 0);
                                    //console.log(lbl_time.getTime()+"_____"+new_time.getTime());
                                    //if(Date.now($(this).html()) > Date.now($("#frm_time").val())){ 
                                    if(lbl_time > new_time){
                                        var p_idx = $(this).parent().index("p");
                                        $('#frm-timeline p').eq(p_idx).before(html_li);
                                        flag = true;
                                        return false;
                                    }
                                }
                            });
                            if(flag === false){
                                $('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
                            }
                            //$('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
                            //$(".lbl-edit").eq(idx).html($("#frm_time").val());
                            //$(".txt-edit").eq(idx).html(txt);
                            //$(".rm-edit").eq(idx).html($("#itinerary_remarks").val());
                            CKEDITOR.instances["description"].setData('');
                            $("#frm_time").val('');
                        }else if(data.response === "e"){
                            //$("#btn-submit").html("Create").removeAttr("disabled");
                        }
                    }
                });
            });
            
          });
        </script>
</body>

</html>
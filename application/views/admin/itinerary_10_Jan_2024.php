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
                  <header>Create Itinerary</header>
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
                                <label class="lbl-bold">Arrival</label> : <?php echo  date('d M, Y',strtotime($details->check_in_date)); ?>
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Departure</label> : <?php echo  date('d M, Y',strtotime($details->check_out_date)); ?>
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Duration</label> : <?php echo  $details->number_of_nights; ?>
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
                                    <option value="">Select..</option>
                                    <option value="city1|city2">Cities</option>
                                    <option value="<?php echo $suggestions[0]->guide; ?>">Guide</option>
                                    <option value="<?php echo $suggestions[0]->trans; ?>">Transportation</option>
                                    <option value="<?php echo $suggestions[0]->hotel; ?>">Hotel</option>
                                    <option value="Breakfast|Lunch|Dinner">Food</option>
                                    <option >Explore The City</option>
                                    <option>Good Bye Note</option>
                                </select>
                                <label class="mdl-textfield__label">Suggestions</label>
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
            
            $("#itinerary_type").on("change",function(){
                var opts = $(this).val().split("|");
                var html = '';
                $.each(opts,function(i,val){
                    html += '<span class="label label-default suggesstions" style="cursor:pointer; margin-right:5px;" title="Click to add">'+val+'</span>';
                });
                $("#chk_suggestions").fadeIn().html(html);
            });
            
            $("#frm1").on('click', '.suggesstions', function(){
                CKEDITOR.instances["description"].insertText($(this).html());
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
                var num_class = $('li.itinerary_li').length;
                
                txt = txt.replace(/(<p>|<\/p>)/g, "");
                if(num_class === 0){
                    html = '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">'+formattedDate+'</span><br>';
                    html += '<input type="hidden" value="'+$("#frm_date").val()+'" name="itinerary_date[]"></li>';                           
                    $(".timeline").append(html);
                }else if($("input[name='itinerary_date[]']").eq(num_class-1).val() !== $("#frm_date").val()){
                    html = '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">'+formattedDate+'</span><br>';
                    html += '<input type="hidden" value="'+$("#frm_date").val()+'" name="itinerary_date[]"></li>';                           
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
            
          });
        </script>
</body>

</html>
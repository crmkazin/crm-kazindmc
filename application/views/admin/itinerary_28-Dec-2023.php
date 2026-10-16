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
          
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Create Itinerary</header>
                  <div class="tools">
                    <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                
                <div class="card-body row">
                    <div class="col-lg-12 p-4">
                        <div class="row info">
                            <div class="col-lg-2">
                                <label class="lbl-bold">FKZ3697</label>
                            </div>
                            <div class="col-lg-3">
                                <label class="lbl-bold">SOURCE AGENT</label> : NIRVANA TOURS
                            </div>
                            <div class="col-lg-3">
                                <label class="lbl-bold">Guide</label> : TBA
                            </div>
                            <div class="col-lg-4">
                                <label class="lbl-bold">Lead PAX Name</label> : Mrs Divyaqqqq Singhwww Bediertyu <br>
                                <label class="lbl-bold">Lead Contact</label> : (91 9810766775)
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Guests</label> : 13 (7A+6C) Family
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Arrival</label> : 22 Dec
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Departure</label> : 27 Dec
                            </div>
                            <div class="col-lg-2">
                                <label class="lbl-bold">Duration</label> : 5
                            </div>
                            <div class="col-lg-4">
                                <label class="lbl-bold">Flight Details</label>
                                <ul>
                                    <li>KC  908    DEL-ALA 1500/1900 (Outbound)</li>
                                    <li>KC  963    ALA-DEL  2230/0130 +1 (Inbound)</li>
                                </ul>
                            </div>
                            <div class="col-lg-6"><label class="lbl-bold">Hotel</label> : Intercontinental Intercontinental Intercontinental Intercontinental</div>
                            <div class="col-lg-6"><label class="lbl-bold">Vehicle</label> : Merc Sprinter Merc Sprinter Merc Sprinter Merc Sprinter</div>
                        </div>
                    </div>
                    <br>
                    
                  <div class="col-lg-6">
                      <?php echo form_open_multipart('', ['id'=>'frm1']); ?>
                    <div class="row">
                        <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="itinerary_type" id="itinerary_type" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value="city1|city2">Cities</option>
                                    <option value="Shrya|9999999999|pic_url">Guide</option>
                                    <option value="Merc Benz|Bus|50">Transportation</option>
                                    <option value="Intercontinental|Almaty|Person Name Here">Hotel</option>
                                    <option value="Breakfast|Lunch|Dinner">Food</option>
                                    <option >Explore The City</option>
                                    <option>Good Bye Note</option>
                                </select>
                                <label class="mdl-textfield__label">Welcome Note</label>
                            </div>
                        </div>
                        <div class="col-lg-3 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="date" name="" class="mdl-textfield__input">
                                <label class="mdl-textfield__label">Date</label>
                            </div>
                        </div>
                        <div class="col-lg-3 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="time" name="" class="mdl-textfield__input">
                                <label class="mdl-textfield__label">Time</label>
                            </div>
                        </div>
                        <div class="col-lg-12" id="chk_suggestions" style="background-color:#f8fcff;display:none;padding:7px;">
                            
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <textarea class="form-control txt_description" name="description" id="description" required=""></textarea>
                            <script>CKEDITOR.replace( 'description');</script>
                            <br>
                            <button class="btn btn-primary" id="add" style="float:right;">Add >></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                    
                    
                    <div class="col-lg-6" style="background-color:#f8fcff;">
                        <?php echo form_open_multipart(); ?>
                        <h4 style="text-align:center;">Itinerary Timeline</h4>
                        
                        <div class="row">
                            
                    		<div class="col-md-8 offset-md-1">
                    			<ul class="timeline">
                    				<li>
                    					<a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                    					<a href="#" class="float-right"><span class="itinerary_date">21 March, 2014</span>
                    					<input type="hidden" name="itinerary_date[]">
                    					</a>
                    					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                    					<input type="hidden" name="itinerary_text_1[]" >
                    				</li>
                    				
                    			</ul>
                    		</div>
                            <div class="col-lg-12 p-t-20 text-right">
                                <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
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
            $("#type").on("change", function () {
              $("#rights").css("display", "none");
              if ($(this).val() === "2") {
                $("#rights").css("display", "block");
              }
            });
          });

          $(document).ready(function () {
            
            $("#itinerary_type").on("change",function(){
                var opts = $(this).val().split("|");
                var html = '';
                $.each(opts,function(index,val){
                    html += '<input type="checkbox" value="'+val+'" class="suggesstions"> <label class="lbl-bold">'+val+'</label> ';
                });
                $("#chk_suggestions").fadeIn().html(html);
                $(".suggesstions").attr("checked",false);
            });
            
            $("#frm1").on('click', '.suggesstions', function(){
                CKEDITOR.instances["description"].insertText($(this).val());
            });


          });
        </script>
</body>

</html>
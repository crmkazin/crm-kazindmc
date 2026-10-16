<?php include('admin_head_css.php');?>  
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
<!-- END HEAD -->
    <div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
      
      <div class="modal fade" id="modalAddRestaurant" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width:1150px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-id">Add Prices</h4>
                    <button type="button" class="close" data-dismiss="modal" id="close-restaurant">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="response-messages" class="text-center"></div>
                            <div id="msgDiv"></div>
                            <form enctype="multipart/form-data" id="frm_prices" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                                <label class="mdl-textfield__label">
                                                    Buffet</label>
                                                <select class="mdl-textfield__input" name="buffets" id="buffets" style="padding:10px;" required>
                                                    <option value="">Select Buffet</option>
                                                    <option value="Breakfast">Breakfast</option>
                                                    <option value="Lunch">Lunch </option>
                                                    <option value="High-Tea">Sides Or High Tea</option>
                                                    <option value="Early-Dinner">Early-Dinner</option>
                                                    <option value="Dinner">Dinner</option>
                                                    <option value="Gala-Dinner">Gala-Dinner</option>
                                                    <option value="Cocktail-Dinner">Cocktail-Dinner</option>
                                                    <option value="Snacks">Snacks</option>
                                                    <option value="Evening-Snacks">Evening-Snacks</option>
                                                    <option value="Late-Night-Snacks">Late-Night-Snacks</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <label class="mdl-textfield__label">Type </label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                                <select class="mdl-textfield__input" name="type" id="type" style="padding:10px;" required>
                                                    <option value="">Select Type</option>
                                                    <option value="buffet">Buffet</option>
                                                    <option value="ala-carte">Ala carte</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Adult Price</label>
                                                <input type="text" name="adult_price" id="adult_price" placeholder="" value="" class="mdl-textfield__input" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Child Price</label>
                                                <input type="text" name="child_price" id="child_price" placeholder="" value="" class="mdl-textfield__input" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                                    <input type="checkbox" value="indian" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Indian</label>
                                                    <input type="checkbox" value="asian" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Asian</label>
                                                    <input type="checkbox" value="pan asian" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Pan Asian</label>
                                                    <input type="checkbox" value="chinese" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Chinese</label>
                                                    <input type="checkbox" value="italian" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Italian</label>
                                                    <input type="checkbox" value="georgian" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Georgian</label>
                                                    <input type="checkbox" value="kazakh" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Kazakh</label>
                                                    <input type="checkbox" value="uzbek" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Uzbek</label>
                                                    <input type="checkbox" value="japanese" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Japanese</label>
                                                    <input type="checkbox" value="fast food" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Fast Food</label>
                                                    <br>
                                                    <input type="checkbox" value="european" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >European</label>
                                                    <input type="checkbox" value="korean" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="" >Korean</label>
                                                    <input type="checkbox" value="azerbaijani" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Azerbaijani</label>
                                                    <input type="checkbox" value="greek" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Greek</label>
                                                    <input type="checkbox" value="night club" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Night club</label>
                                                    <input type="checkbox" value="pub" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Pub</label>
                                                    <input type="checkbox" value="bar" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Bar</label>
                                                    <input type="checkbox" value="mediterranean cusine" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Mediterranean cusine</label>
                                                    <input type="checkbox" value="cafe" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Cafe</label>
                                                    <br>
                                                    <input type="checkbox" value="multi-cusine" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Multi-cusine</label>
                                                    <input type="checkbox" value="turkish" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Turkish</label>
                                                    <input type="checkbox" value="armanian" name="cuisine_prices[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                                    <label for="oname" class="">Armanian</label>
                                                </div>
                                            </div>
                                        </div>  
                                        <input type="hidden" value="" name="hdn_update_id" id="hdn_update_id">
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-primary" id="btn_add_prices" style="float: right;">Submit</button>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Buffet</th>
                                                    <th>Type</th>
                                                    <th>Cuisines</th>
                                                    <th>Adult Price</th>
                                                    <th>Child Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodydata"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
      
      <div class="page-content-wrapper">
          <div class="page-bar">
              <div class="row page-titles">
                  <div class="col-lg-4 col-sm-6  col-6 align-self-center">
                      <h4 class="text-themecolor">Masters Creation Edit Restaurants</h4>
                  </div>
                  <div class="col-lg-3 only-for-dashbord">
                  </div>
                  <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                      <div class="d-flex justify-content-end align-items-center">
                          <ol class="breadcrumb justify-content-end">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                              <li class="breadcrumb-item active"><a href="<?php echo base_url('all-masters-restaurants'); ?>">Restaurant List</a></li>
                              <li class="breadcrumb-item active">Masters Creation Edit Restaurants</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
        <div class="page-content">
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
               
                <?php echo form_open_multipart(current_url().'?'.$_SERVER['QUERY_STRING']); ?>
                <div class="card-body row">
                  
                    <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Select Country</label>
                      <?php 
                      $readonly=[];
                      if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                          $readonly = ['readonly'=>'readonly'];
                      }
                      echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$result->country]+$readonly)?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                    <input type="hidden" name="country_id" id="country_id" value="<?php echo $country_id; ?>">
                    <div class="col-lg-3 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">City</label>
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $result->city]); ?>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
                  <div class="col-lg-3 p-t-20">
                        <div
                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Map</label>
                            <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => $result->map]); ?>
                            <?php echo form_error('map'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Restaurant Name</label>
                      <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->name]); ?>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>
                  
                    <div class="col-lg-3 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Restaurant Address</label>
                            <textarea class="mdl-textfield__input" name="restaurant_address"><?php echo $result->restaurant_address; ?></textarea>
                            <?php echo form_error('restaurant_address'); ?>
                        </div>
                    </div>
                    <div class="col-lg-3 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Restaurant Contact Number</label>
                            <?php echo form_input(['name' => 'contact_number', 'id' => 'restaurant_contact', 'class' => 'mdl-textfield__input', 'value' => $result->contact_number]); ?>
                            <?php echo form_error('contact_number'); ?>
                        </div>
                    </div>

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php //echo form_input(['name' => 'price_range', 'id' => 'price_range', 'class' => 'mdl-textfield__input', 'value' => $result->price_range]); ?>
                        <label class="mdl-textfield__label">Price Range</label>
                        <select name="price_range" id="price_range" class="mdl-textfield__input">
                            <option value="">Select..</option>
                            <?php for($i=5;$i<=150;$i=$i+5){
                                $range = '$'.$i.' To $'.($i+5).' Per Person';
                            ?>
                            <option value="<?php echo $range; ?>" <?php echo ($result->price_range==$range)?'selected="selected"':''; ?>><?php echo $range; ?></option>
                            <?php } ?>
                        </select> 
                        
                        <?php echo form_error('price_range'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-2 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Seating Capacity</label>
                      <?php echo form_input(['name' => 'seating_capacity', 'id' => 'seating_capacity', 'class' => 'mdl-textfield__input', 'value' => $result->seating_capacity]); ?>
                      <?php echo form_error('seating_capacity'); ?>
                    </div>
                  </div>

                  <div class="col-lg-2 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Opening Time</label>
                    <?php echo form_input(['type'=>'time' ,'name' => 'opening_time', 'id' => 'opening_time', 'class' => 'mdl-textfield__input', 'value' => $result->opening_time]); ?>
                      <?php echo form_error('opening_time'); ?>
                    </div>
                  </div>

                  <div class="col-lg-2 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Closing Time</label>
                      <?php echo form_input(['type'=>'time' ,'name' => 'closing_time', 'id' => 'closing_time', 'class' => 'mdl-textfield__input', 'value' => $result->closing_time]); ?>
                      <?php echo form_error('closing_time'); ?>
                    </div>
                  </div>
                  
                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                          <label class="mdl-textfield__label">Image</label>
                        <input type="file" name="image" id="image" class="mdl-textfield__input"/>
                      </div>
                    </div>
                  
                    <div class="col-lg-2 p-t-20">                    
                        <img src="<?php echo ($result->image<>'')?'uploads/restaurants/'.$result->image:'assets/admin/images/no-image-icon.png';  ?>" width="90" height="90">
                    </div>
                    <div class="col-lg-2 p-t-20">                    
                        <button id="add_prices" class="btn btn-md btn-primary" type="button">Add Prices</button>
                    </div>
                <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                            <?php $cuisines = array_map('trim', explode(',',$result->cuisine)); ?>
                            <input <?=(in_array('indian',$cuisines)?'checked="checked"':'')?> type="checkbox" value="indian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Indian</label>
                            <input <?=(in_array('asian',$cuisines)?'checked="checked"':'')?> type="checkbox" value="asian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Asian</label>
                            <input <?=(in_array('pan asian',$cuisines)?'checked="checked"':'')?> type="checkbox" value="pan asian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Pan Asian</label>
                            <input <?=(in_array('chinese',$cuisines)?'checked="checked"':'')?> type="checkbox" value="chinese" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Chinese</label>
                            <input <?=(in_array('italian',$cuisines)?'checked="checked"':'')?> type="checkbox" value="italian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Italian</label>
                            <input <?=(in_array('georgian',$cuisines)?'checked="checked"':'')?> type="checkbox" value="georgian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Georgian</label>
                            <input <?=(in_array('kazakh',$cuisines)?'checked="checked"':'')?> type="checkbox" value="kazakh" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Kazakh</label>
                            <input <?=(in_array('uzbek',$cuisines)?'checked="checked"':'')?> type="checkbox" value="uzbek" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Uzbek</label>
                            <input <?=(in_array('japanese',$cuisines)?'checked="checked"':'')?> type="checkbox" value="japanese" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Japanese</label>
                            <input <?=(in_array('fast food',$cuisines)?'checked="checked"':'')?> type="checkbox" value="fast food" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Fast Food</label>
                            <input <?=(in_array('european',$cuisines)?'checked="checked"':'')?> type="checkbox" value="european" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >European</label>
                            <input <?=(in_array('korean',$cuisines)?'checked="checked"':'')?> type="checkbox" value="korean" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Korean</label>
                            <input <?=(in_array('azerbaijani',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="azerbaijani" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Azerbaijani</label>
                            <br>
                            <input <?=(in_array('greek',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="greek" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Greek</label>
                            <input <?=(in_array('night club',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="night club" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Night club</label>
                            <input <?=(in_array('pub',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="pub" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Pub</label>
                            <input <?=(in_array('bar',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="bar" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Bar</label>
                            <input <?=(in_array('mediterranean cusine',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="mediterranean cusine" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Mediterranean cusine</label>
                            <input <?=(in_array('cafe',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="cafe" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Cafe</label>
                            <input <?=(in_array('multi-cusine',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="multi-cusine" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Multi-cusine</label>
                            <input <?=(in_array('turkish',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="turkish" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Turkish</label>
                             <input <?=(in_array('armanian',$cuisines)?'checked="checked"':'')?>
                                                    type="checkbox" value="armanian" name="cuisine[]"
                                                    class="mdl-textfield__input"
                                                    style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Armanian</label>
                        </div>
                    </div>
                </div>    
                
                <div class="col-lg-12 p-t-20"><label class="bold">Description: </label>
                    <textarea class="form-control txt_description" name="description" id="description"><?php echo $result->description; ?></textarea>
                    <script>CKEDITOR.replace( 'description');</script>
                    <br>
                </div>
                
                <input type="hidden" name="" id="restaurant_id" value="<?php echo $result->id; ?>">
                <?php foreach($result_remarks AS $list){ ?>
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Remarks</label>
                        <input type="text" id="" name="edit_remarks[]" value="<?php echo $list->remarks; ?>" class="mdl-textfield__input">
                        <input type="hidden" id="" name="edit_id_remarks[]" value="<?php echo $list->id; ?>" class="mdl-textfield__input">
                    </div>
                    <i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?=$list->id?>"></i>
                </div>
                <?php } ?>
                
                <div class="col-lg-4 p-t-20" id="div_remarks">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Remarks</label>
                        <input type="text" id="" name="remarks[]" value="" class="mdl-textfield__input">
                    </div>
                </div>  
                
                <div class="col-lg-4 p-t-20" id="addnew">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <button type="button" class="btn btn-success add_new"><i class="fa fa-plus"></i></button>
                    </div>
                </div>  
                  
                  
                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                  </div>
                  <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- end page content -->
          </div>
        </div>
        </div>
        </div>
<script>
$(document).ready(function () {
    $("#type").on("change", function () {
        $("#rights").css("display", "none");
        if ($(this).val() === "2") {
        $("#rights").css("display", "block");
        }
    });
    
    $(".add_new").on("click",function(){
        event.preventDefault();
        $($("#div_remarks").clone()).insertBefore("#addnew"); 
    });
                
    $(".edit-remove").on("click",function(e){
        if(!confirm('Are You Sure?')){
            return false;
        }
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "<?php echo site_url('remove_remarks_restaurant'); ?>",
            type: "post",
            data: { 'id': ele.attr("data-id"),'restaurant_id':$("#restaurant_id").val() },
            dataType : 'JSON',
            //contentType : false,
            //processData: false,
            beforeSend: function(){
            },
            success: function (res) {
                if(res.response === "s"){
                    ele.parent().remove();                     
                }
            }
        });
    });
    
    $("#add_prices").on("click",function(e){
        e.preventDefault();
        $("#modalAddRestaurant").modal("show");
        get_prices();
    });
    
    $("#btn_add_prices").on("click",function(){
        event.preventDefault();
        let myForm = document.getElementById("frm_prices");
        var data = new FormData(myForm);
        data.set('restaurant_id',$("#restaurant_id").val());
        $("#btn_add_prices").html('Submitting').attr('disabled', 'disabled');
        $.ajax({
            url: "<?php echo base_url('admin/masters/add_cuisine_prices'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                $("#msgDiv").html('').html(data.msg);
                $("#btn_add_prices").html('Submit').removeAttr('disabled', 'disabled');
                if (data.response === "e") {} else if (data.response === "s") {
                    $("#frm_prices")[0].reset();
                    $("#hdn_update_id").val("");
                    $('input[name="cuisine_prices[]"]').attr("checked",false);
                    get_prices();
                }
            }                    
        });
    });
    
});

$(document).ready(function () {

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
        //   $('#company_id').val(ui.item.company_id); // save selected id to input

        return false;
        }
    });
    
    $("#frm_prices").on("click",".edit-prices",function(){
        var d = $(this).attr("data-id");
        $.ajax({
            url: "<?php echo base_url('admin/masters/get_cuisine_prices'); ?>",
            type: "post",
            data: {'restaurant_id':$("#restaurant_id").val(),'id':d},
            dataType: 'JSON',
            //contentType: false,
            //processData: false,
            beforeSend: function() {},
            success: function(data) {
                if (data.response === "s") {
                    if(data.details.prices.length > 0){
                        var cuisines = data.details.prices[0].cuisines.split(",");
                        $('input[name="cuisine_prices[]"]').attr("checked",false);
                        $("#buffets").val(data.details.prices[0].buffet_name);
                        $("#type").val(data.details.prices[0].type);
                        $("#adult_price").val(data.details.prices[0].adult_price);
                        $("#child_price").val(data.details.prices[0].child_price);
                        $("#hdn_update_id").val(data.details.prices[0].id);
                        $("#btn_add_prices").html("Update");
                        $('input[name="cuisine_prices[]"]').each(function() {
                            if(cuisines.includes($(this).val())){
                                $(this).attr("checked","checked");
                            }
                        });
                    }
                }
            }
        });
    });
    
});

function get_prices(){
    var html = "";
    $.ajax({
        url: "<?php echo base_url('admin/masters/get_cuisine_prices'); ?>",
        type: "post",
        data: {'restaurant_id':$("#restaurant_id").val()},
        dataType: 'JSON',
        //contentType: false,
        //processData: false,
        beforeSend: function() {},
        success: function(data) {
            if (data.response === "s") {
                $.each(data.details.prices, function(index,item){
                    html += '<tr><td>'+(index+1)+'</td><td>'+item.buffet_name+'</td><td>'+item.type.toUpperCase()+'</td><td>'+item.cuisines.replace(/,/g,' , ').toUpperCase()+'</td><td>'+item.adult_price+'</td><td>'+item.child_price+'</td><td class="text-center"><i title="Edit" data-id="'+btoa(item.id)+'" class="fa fa-edit edit-prices" style="cursor:pointer;"></i></td></tr>';
                });
                $("#tbodydata").html("").html(html);
            }
        }
    });
}

</script>

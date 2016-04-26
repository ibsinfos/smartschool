<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#system" data-toggle="tab"><i class="entypo-menu"></i> 
					System Setting
        </a></li>
			  <li>
          <a href="#theme_setting" data-toggle="tab"><!--<i class="entypo-plus-circled"></i>-->
					 Theme Setting
          </a></li>
		</ul>
    	<!--CONTROL TABS END-->
   <div class="tab-content">
		<!--TABLE LISTING STARTS-->
        <div class="tab-pane box active" id="system">
				<?php echo form_open(base_url() . 'index.php?admin/system_settings/do_update' , 
			  array('class' => 'form-horizontal form-groups-bordered validate','id'=>'system_form','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
				<div class="col-md-12">					
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title">
								<?php echo get_phrase('system_settings');?>
							</div>
						</div>
						
						<div class="panel-body">                    
							<div class="form-group">
							  <label  class="col-sm-3 control-label">System Name</label>
							  <div class="col-sm-9">
								  <input type="text" class="form-control" name="system_name" id="system_name" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly="readonly">
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-3 control-label">Phone</label>
							  <div class="col-sm-9">
                            <select name="phone_code" class="form-control" style="width:95px;float:left; " readonly="readonly">
                            <?php $org_phone_code=explode(',',$this->db->get_where('settings' , array('type' =>'phone'))->row()->description);?>
                            <?php $get_country_code=$this->db->get('country_code')->result_array();
                            foreach ($get_country_code as $row_country_code) { ?>
                            <option value="<?php echo $row_country_code['country_code'] ?>" <?php if($org_phone_code[0]==$row_country_code['country_code']){?>selected<?php } ?>>
                              <?php echo $row_country_code['country_code']; ?>  
                            </option> 
                            <?php } ?>
                          </select>
							      <input type="text" id="phone" class="form-control input" name="phone" value="<?php echo $org_phone_code[1] ;?>" maxlength="11" pattern="\d*" data-validate="required" style="width:85%;" readonly="readonly">
                    <span class="phone" style="color:#cc2424;"></span>
							      </div>
							</div>
							<div class="form-group">
							  <label  class="col-sm-3 control-label">Paypal Email</label>
							  <div class="col-sm-9"> 
								  <input type="text" class="form-control" name="paypal_email" id="paypal_email"  value="<?php echo $this->db->get_where('settings' , array('type' =>'paypal_email'))->row()->description;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly="readonly">
							  </div>
							</div>
							<div class="form-group">
							  <label  class="col-sm-3 control-label">Currency</label>
							  <div class="col-sm-9">
								  <input type="text" class="form-control" name="currency" id="currency"  value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly="readonly">
							  </div>
							</div>
							<div class="form-group">
							  <label  class="col-sm-3 control-label">System Email</label>
							  <div class="col-sm-9">
								  <input type="text" class="form-control" name="system_email" id="system_email" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" readonly="readonly">
							  </div>
							</div>					
						  
						  <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label">Logo</label>                          
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                       <img src="<?php echo $this->crud_model->get_image_url('system' , $this->session->userdata('admin_id'));?>" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new">Select image</span>
                                          <span class="fileinput-exists">Change</span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                  </div>
                              </div>
                          </div>
                      </div>	 	
						  <div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="button" id="edit_form" class="btn btn-info">Edit</button>
                                <button type="submit" id="save_form_button" class="btn btn-info" style="display:none;">Save</button>
                                <button type="button" class="btn btn-info" id="cancel_form_button" onClick="window.location.reload()"
                                 style="display:none;">Cancel</button>
							</div>
						  </div>
							
						</div>
					
					</div>
				
				</div>
		<?php echo form_close();?>	
		<div class="col-md-6">
			<?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_logo' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-primary" >              
              </div>

            <?php echo form_close();?>	
        </div>	
	    <div class="clearfix"></div>
			</div>
		<!--TABLE LISTING ENDS-->
	  
		<!--CREATION FORM STARTS-->
		<div class="tab-pane box" id="theme_setting" style="padding: 5px">
      <?php 
        $skin = $this->db->get_where('settings' , array(
          'type' => 'skin_colour'
        ))->row()->description;
      ?>      
		<div class="col-md-12">			
            <div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('theme_settings');?>
                    </div>
                </div>
                
                <div class="panel-body">

                <div class="gallery-env">
				<div class="row">
                <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="white">
                                    <img src="assets/images/skins/white.png"
                                    <?php if ($skin == 'white') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="white">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>	
                    

                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="green">
                                    <img src="assets/images/skins/green.png"
                                    <?php if ($skin == 'green') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="green">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="purple">
                                    <img src="assets/images/skins/purple.png"
                                    <?php if ($skin == 'purple') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="purple">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                 </div>   
                 <div class="row">	
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="red">
                                    <img src="assets/images/skins/red.png"
                                    <?php if ($skin == 'red') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="red">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="default">
                                    <img src="assets/images/skins/default.png"
                                    <?php if ($skin == 'default') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="default">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('default');?>
                                </a>
                            </header>
                        </article>
                    </div>
                   </div> 

                </div>
                <center>
                  <div class="label label-primary" style="font-size: 12px;">
                    <i class="entypo-check"></i> <?php echo get_phrase('select_a_theme_to_make_changes');?>
                  </div>
                </center>
                </div>
            
            </div>
        </div>
		<div class="clearfix"></div>
        </div>
		<!--CREATION FORM ENDS-->
		</div>
	</div>
</div>
<script type="text/javascript" src="assets/js/formatter.js"></script> 

<script type="text/javascript">
    $(".gallery-env").on('click', 'a', function () {
        skin = this.id;
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/system_settings/change_skin/'+ skin,
            success: window.location = '<?php echo base_url();?>index.php?admin/system_settings/'
        });
});
$("#edit_form").click(function(){
	$("#system_name").attr("readonly", false); 
	$("#phone").attr("readonly", false); 
	$("#paypal_email").attr("readonly", false); 
	$("#currency").attr("readonly", false); 
	$("#system_email").attr("readonly", false); 
	$("#edit_form").hide();
	$("#save_form_button").show();
	$("#cancel_form_button").show();
})
$("#system_form").submit(function() {
		var phone = $("#phone").val();	
		if(phone != "" && phone.length< 11){
			$("span.phone").html("Please enter exactly 9 digits.").addClass('validate');				
			return false;
		}
})
new Formatter(document.getElementById('phone'), {
  'pattern': '{{999}}-{{999}}-{{999}}'
});

</script>
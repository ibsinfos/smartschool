<script src="<?php echo base_url();?>/assets/js/framework/formValidation.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/formatter.js"></script> 

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
new Formatter(document.getElementById('phone_new'), {
  'pattern': '{{999}}-{{999}}-{{999}}'
});
});
</script>
<?php 
$edit_admin=$this->db->get_where('admin',array('admin_id' =>$param2) )->result_array();
foreach ($edit_admin as $row):
?>


<div class="row">
	<div class="col-md-12">
		<div class="tab-content">
            <!----CREATION FORM STARTS---->
		<div class="panel-body">
                	<?php echo form_open(base_url().'index.php?admin/admin/do_update/'.$row['admin_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','id'=>'admin_form_edit','enctype'=>'multipart/form-data'));?>
                        <div class="padded"> 
                        <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                        <input type="hidden" name="user_id" value="<?php echo $row['admin_id'];?>">                        
							<div class="form-group">
                                <label class="col-sm-3 control-label">Full Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="fullname" data-validate="required" data-message-required="Fullname is required" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Father Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                     <input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="Fathername is required" id="father_name" value="<?php echo $row['father_name'];?>"/>
                                </div>
                            </div>                          
					    <div class="form-group">
                                <label class="col-sm-3 control-label">Mother Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="Mothername is required"  value="<?php echo $row['mother_name'];?>"/>
                                </div>
                            </div>
                     <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Birthday<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday"  data-validate="required" data-message-required="Birthday is required"   value="<?php echo $row['birthdate'];?>">
						</div> 
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Sex</label>
						<div class="col-sm-5">
							<input type="radio" name="sex" value="male" checked="checked">Male
							<input type="radio" name="sex" value="female">Female
						</div>
                    </div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?><span class="mandatory">*</span></label>
						<div class="col-sm-5">							
							<textarea rows="3" name="address" style="width:100%" data-validate="required" data-message-required="Address is required"><?php echo $row['address'];?></textarea>
						</div> 
					</div>
                    <div class="form-group">
                                <label class="col-sm-3 control-label">Email<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="email" data-validate="required,email" data-message-required="Email is required" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Password<span class="mandatory">*</span></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="<?php echo $row['pass'];?>" data-validate="required"  data-validate="required" data-message-required="Password is required">
						</div>
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?><span class="mandatory">*</span></label>															  						<div class="col-sm-5">
                        	<select name="phone_code" class="form-control" style="width:70px;float:left; ">
                        		<?php $org_phone_code=explode(',',$row['phone']);?>
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>" <?php if($org_phone_code[0]==$row_country_code['country_code']){?>selected<?php } ?>>
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>
							<input type="text" id="phone_new" class="form-control input" name="phone"  maxlength="11" pattern="\d*" data-validate="required" style="width:118px;" data-message-required="Phone is required" value="<?php echo $org_phone_code[1];?>">
							<span class="phone" style="color:#cc2424;"></span>
						</div> <br/>
                        </div>
						<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <input type="hidden" name="txtoldphoto" value="<?=$row['admin_image'];?>">
									<img src="uploads/admin_image/<?php echo $row['admin_image'];?>" alt="...">
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
                              <div class="col-sm-offset-3 col-sm-5">
                                 <button type="submit" class="btn btn-info">Save</button>
                                 <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
                              </div>
						</div>
                    </form>                
                </div>                
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>
<?php endforeach;?>
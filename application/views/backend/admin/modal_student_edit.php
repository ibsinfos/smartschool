<?php 
$edit_data		=	$this->db->get_where('student' , array('student_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">				
                  <?php echo form_open(base_url() . 'index.php?admin/student/'.$row['class_id'].'/do_update/'.$row['student_id'] , array('class' => 'form-horizontal form-groups-bordered validate','id'=>"edit_student_from", 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
						<div class="col-sm-5">
                        <?php   $imgpath = FCPATH.'uploads/student_image/'.$row['student_image']; ?>
						
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <input type="hidden" name="txtoldphoto" value="<?php echo $row['student_image']; ?>">
                              <?php if(!empty($row['student_image'])){
								  if(file_exists($imgpath)){ ?>
									<img src="uploads/student_image/<?php echo $row['student_image'];?>" alt="...">
                                    <?php }else{ ?>
										 <img src="uploads/user.jpg" alt="...">
									<?php 	} }else{ ?>
                                    <img src="uploads/user.jpg" alt="...">
                                    <?php } ?>
            
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
						<label for="field-1" class="col-sm-3 control-label">Login Id</label>											 						<div class="col-sm-5">
						<label for="field-1" class="col-sm-3 control-label"><b><?php echo $row['student_id'];?></b></label>
						</div>
                        </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Full Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Father's Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['father_name'];?>" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mother's Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['mother_name'];?>" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?><span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row['birthday'];?>" data-start-view="2" data-validate="required" >
						</div> 
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('sex');?></label>
						<div class="col-sm-5">
							<input type="radio" name="sex" value="male" <?php if($row['sex'] == 'male') echo "checked"; ?>>Male
							<input type="radio" name="sex" value="female" <?php if($row['sex'] == 'female') echo "checked"; ?>>Female
						</div>
                    </div>
					<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo get_phrase('blood_group');?><span class="mandatory">*</span></label>
							<div class="col-sm-5">
								<select name="blood_group" class="form-control" style="width:100%;">
									<option value="">Select Group</option>
									<option value="A-" <?php if($row['blood_group'] == 'A-'){ echo "selected"; } ?>>A-</option>
									<option value="B-" <?php if($row['blood_group'] == 'B-'){ echo "selected"; } ?>>B-</option>
									<option value="O−" <?php if($row['blood_group'] == 'O−'){ echo "selected"; } ?>>O−</option>
									<option value="O+" <?php if($row['blood_group'] == 'O+'){ echo "selected"; } ?>>O+</option>
									<option value="A+" <?php if($row['blood_group'] == 'A+'){ echo "selected"; } ?>>A+</option>
									<option value="B+" <?php if($row['blood_group'] == 'B+'){ echo "selected"; } ?>>B+</option>
									<option value="AB+" <?php if($row['blood_group'] == 'AB+'){ echo "selected"; } ?>>AB+</option>
									<option value="AB−" <?php if($row['blood_group'] == 'AB−'){ echo "selected"; } ?>>AB−</option>									
								</select>
							</div>
                    </div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?><span class="mandatory">*</span></label>
						<div class="col-sm-5">							
							<textarea rows="3" name="address" cols="20" data-validate="required" ><?php echo $row['address']; ?></textarea>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Phone<span class="mandatory">*</span></label>         
						<div class="col-sm-5">						
							<select name="phone_code" class="form-control" style="width:80px;float:left;">
                        		<?php $org_phone_code=explode(',',$row['phone']);?>
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>" <?php if($org_phone_code[0]==$row_country_code['country_code']){?>selected<?php } ?>>
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>						
							<input type="text" id="phone_edit" class="form-control input" pattern="\d*" name="phone" maxlength="12"  value="<?php echo $org_phone_code[1] ?>" data-validate="required" style="width:107px;" />
							<span class="phone_edit" style="color:#cc2424;"></span>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email"  data-validate="email" class="form-control" aria-invalid="false" aria-describedby="email-error" value="<?php echo $row['email']; ?>" id="edemail" onBlur="edcheckEmail()" ><span id="edemail-availability-status"></span>
							<img src="<?php echo base_url();?>/assets/images/loader-2.gif" id="loaderIcone" style="display:none" />	
							<span class="email" style="color:#cc2424;"></span>						 
						</div>
					</div>					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Create Password<span class="mandatory">*</span></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="<?php echo $row['real_pass']; ?>">
						</div> 
					</div>
					<!--<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Identification Number</label>                     
						<div class="col-sm-5">
							<input type="text" class="form-control" name="identification_num" value="<?php echo $row['student_id']; ?>" readonly />
						</div> 
					</div>-->
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Roll No.<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">							
							<input name="roll" type="text" class="form-control" id="rolls" class="demoInputBox"  value="<?php echo $row['roll']; ?>" onBlur="checkAvailability()"><span id="rolls-availability-status"></span> 
								<img src="<?php echo base_url();?>/assets/images/loader-2.gif" id="loaderIcon" style="display:none" />							
						</div> 
					</div>	
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?><span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="class_id" class="form-control" data-validate="required" id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $erow):
									?>
                            		<option value="<?php echo $erow['name_numeric'];?>" <?php if($erow['name_numeric'] == $row['class_id'] ){ echo "selected"; } ?>>
										<?php echo $erow['name_numeric'];?>
                                     </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>
                    <!--<div class="form-group">
						<label class="col-sm-3 control-label">Group</label>
							<div class="col-sm-5">
							<select name="group_id" class="form-control" style="width:100%;">
                                    <option value="">Select Group</option>
									 <?php
									 $group =  $this->db->get_where('group' , array('user_type' => 2))->result_array();
									 foreach ($group as $rows):
								?>
                                       <option value="<?php echo $rows['group_id'];?>" <?php if($rows['group_id'] == $row['group_id']){ echo "selected"; } ?>><?php echo $rows['group_name'];?></option>
                                 <?php
                                 endforeach;
                                 ?>  
                            </select>
							</div>
					</div>-->
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Student Status</label>
						<div class="col-sm-5">
							<select name="std_status" class="form-control" style="width:100%;" data-validate="required" >
									<option value="">Select Status</option>
									<option value="0" <?php if($row['std_status'] == '0'){ echo "selected"; } ?>>Active</option>
									<option value="1" <?php if($row['std_status'] == '1'){ echo "selected"; } ?>>Inactive</option>									
							</select>
						</div> 
					</div>					
					<input type="hidden" name="edit_std" id="edit_std" value="<?php echo $row['student_id']; ?>">		
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Save</button>
                            <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
<script type="text/javascript" src="assets/js/formatter.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
$("form").submit(function() {
		var email=$("#edemail").val();	
		/*if(email == "") {
			$("span.email").html("Please enter Email.").addClass('validate');			
			return false;
		}*/
	});
	$("#edemail").keyup(function() {
		if(email != "") {
			$('span.email').html("");
		}	
	});

function checkAvailability() {
	//var roll = document.getElementById("rolls").value;
	
	$("#loaderIcon").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_roll/' ,	
	data: { roll: $("#rolls").val() , id: $("#edit_std").val() },
	type: "POST",
	success:function(data){
		$("#rolls-availability-status").html(data);
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
}
});
function edcheckEmail() {
	//var email = document.getElementById("email").value;
	$("#loaderIcone").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_email/' ,
	//data:'email='+$("#email").val(),
	data: { email: $("#edemail").val() , id: $("#edit_std").val() },
	type: "POST",
	success:function(data){
		$("#edemail-availability-status").html(data);
		$("#loaderIcone").hide();
	},
	error:function (){}
	});
}
</script>
<script type="text/javascript">
$(document).ready(function() {
		$("#edit_student_from").submit(function() { 		
		var capt  			= $("#phone_edit").val();		
		//var cont_regex     = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
	if(capt == "") {
		$("span.phone_edit").html("Please enter contact No.").addClass('validate');			
		return false;
	} else {
		if( document.getElementById("phone_edit").value.length < 12 ){
			$("span.phone_edit").html("Please enter exactly 10 digits.").addClass('validate');				
				return false;
		}
		if(!cont_regex.test(capt)){ // if invalid Contact			
			   $("span.phone_edit").html("Invalid Contact No!").addClass('validate');				
			return false;
		} else {
			$("span.phone_edit").html("");
		}		
	}	
	return true;
});
	new Formatter(document.getElementById('phone_edit'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
}); 
});
	function get_class_sections(class_id) {
	var class_id = $("#class_id").val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }	

</script>
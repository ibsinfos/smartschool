<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
.has-success .form-control{border-color:#cc2424 !important;}
.phone.validate{color:#cc2424;}
.form-group validate-has-error{border-color:0 !important;}
</style>

<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					Manage Profile
                </a>
				<!--<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-lock"></i> 
					Change Password
               </a></li>-->
			</li>
		</ul>
    	<!--CONTROL TABS END-->
		<div class="tab-content">
        	<!--EDITING FORM STARTS-->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">

					<?php foreach($edit_data as $row): 
					 echo form_open(base_url() . 'index.php?admin/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' ,'id'=>'manage_profile' ,'enctype'=>'multipart/form-data'));?>
                            <div class="form-group mandatory"><div class="col-sm-12"> * Fields are mandatory </div></div>
                            <div class="form-group">
				            <label class="col-sm-3 control-label"><?php echo get_phrase('full_name');?><span class="mandatory">*</span></label>
			                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('father_name');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="father_name" value="<?php echo $row['father_name'];?>" data-validate="required"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('mother_name');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="mother_name" value="<?php echo $row['mother_name'];?>" data-validate="required"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('birthday');?><span class="mandatory">*</span></label>
                               <div class="col-sm-5">
									<input type="text" data-start-view="2" value="<?php echo @$row['birthdate'];?>" name="birthdate" class="form-control datepicker">
								</div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sex');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="radio" name="sex" value="male"<?php if($row['sex'] == 'male'){ echo "checked"; } ?> >Male
									<input type="radio" name="sex" value="female" <?php if($row['sex'] == 'female'){ echo "checked"; } ?>>Female
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('blood_group');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									<select name="blood_group" class="form-control" style="width:100%;" data-validate="required">
										<option value="">Select Groop</option>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <textarea placeholder="Textarea" id="field-ta" name="address" class="form-control" data-validate="required"><?php echo $row['address']; ?></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Phone<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'];?>" data-validate="required" maxlength="12"/>
                                    <span class="phone" style="color:#cc2424;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" data-validate="email" name="email" class="form-control" aria-invalid="false" aria-describedby="email-error" value="<?php echo $row['email'];?>" id="email" onBlur="checkEmail()">
                                    <span id="email-availability-status" class="email" style="color:#cc2424;"></span>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value="<?php echo $row['pass'];?>" data-validate="required"/>
                                </div>
                            </div>
								<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                        <input type="hidden" name="txtoldphoto" value="<?=$row['admin_image'];?>">
                                            <img src="<?php echo base_url(); ?>/uploads/admin_image/<?php echo $row['admin_image']; ?>">
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php endforeach; ?>
                </div>
			</div>
            <!--EDITING FORM ENDS-->
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>/assets/js/framework/formValidation.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/formatter.js"></script> 
<script type="text/javascript">
function checkEmail() {
	//var email = document.getElementById("email").value;
	$("#loaderIcone").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_email/' ,
	//data:'email='+$("#email").val(),
	data: { email: $("#email").val() },
	type: "POST",
	success:function(data){
		$("#email-availability-status").html(data);
		$("#loaderIcone").hide();
	},
	error:function (){}
	});
}

$(document).ready(function() {
	$("#regexpEmailForm").submit(function() {
		var email= $("#email").val();		
		if(email == "") {
			$("span.email").html("value required.").addClass('validate');			
			return false;
		}
	}); 
	$("#email").keyup(function() {
		if(email != "") {
			$('span.email').html("");
		}	
	});
	
	$("#editForm").submit(function() {
		var email  			= $("#pemail").val();		
		if(email == "") {
			$("span.pemail").html("Please enter Email.").addClass('validate');			
			return false;
		}
	}); 
	$("#pemail").keyup(function() {
		if(email != "") {
			$('span.pemail').html("");
		}	
	});
	$("#phone").blur(function() {
		var capt = $("#phone").val();		
		var cont_regex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
		
	if(capt == "") {
		$("span.phone").html("Please enter contact No.").addClass('validate');			
		return false;
	} else {
		if(!cont_regex.test(capt)){ // if invalid Contact			
			//$("span.phone").html("Invalid Contact No!").addClass('validate');				
			return false;
		} else {
			if( document.getElementById("phone").value.length < 12 ){
			$("span.phone").html("Not able to more 10.").addClass('validate');				
				return false;
			}
			if(!cont_regex.test(capt)){ // if invalid Contact
			
				//$("span.phone").html("Invalid Contact No!").addClass('validate');				
				return false;
			} else {
				$("span.phone").html("");
			}
		}
	}	
	return true;
});    // click end
$("#manage_profile").submit(function() {
	var phone  = $("#phone").val();		
	if(phone == ""){
		return false;
	}
	else
	{
		if( document.getElementById("phone").value.length < 12 ){
			$("span.phone").html("Please enter exactly 10 digits.").addClass('validate');				
			return false;
		}
		if(!cont_regex.test(phone)){ 	
		    //$("span.phone").html("Invalid Contact No!").addClass('validate');				
			return false;
		}
		else{
			$("span.phone").html("");
		}		
	}	
	return true;
	}); 
new Formatter(document.getElementById('phone'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
}); 
});
</script>

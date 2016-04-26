<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/staff/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'edit_staff_form','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
							<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
							<label for="chkYese">
								<input type="radio" id="chkYese" name="teaching_type" value="1" <?php if($row['teaching_type'] == 1){ echo "checked"; } ?> />
								Teaching Staff
							</label>
							<br/>
							<label for="chkNoe">
								<input type="radio" id="chkNoe" name="teaching_type" value="2" <?php if($row['teaching_type'] == 2){ echo "checked"; } ?> />
								NonTeaching Staff
							</label>									
							<div id="dvPassporte" style="display: none">
								<div class="form-group">
									<div class="col-sm-5">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
												<img src="<?php echo base_url();?>assets/images/document.png" alt="<?php echo $row['file_name']; ?>">
												<label><?php echo $row['file_name']; ?></label>
												<input type="hidden" name="temp_resume" value="<?php echo $row['file_name'];?>"/>
											</div>

											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>

											<div>

												<span class="btn btn-white btn-file">

													<span class="fileinput-new">UploadCV</span>

													<span class="fileinput-exists">Change</span>

													<input type="file" name="uploadcv" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" />

												</span>

												<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>

											</div>

										</div>

									</div>

								</div>

							</div> 

                            <div class="form-group">

                                <label class="col-sm-3 control-label">Full Name<span class="mandatory">*</span></label>

                                <div class="col-sm-5">

                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>

                                </div>

                            </div>

							<div class="form-group">

                                <label class="col-sm-3 control-label">Father's Name<span class="mandatory">*</span></label>

                                <div class="col-sm-5">

                                    <input type="text" class="form-control" name="father_name" value="<?php echo $row['father_name'];?>"/>

                                </div>

                            </div>

							<div class="form-group">

                                <label class="col-sm-3 control-label">Mother's Name<span class="mandatory">*</span></label>

                                <div class="col-sm-5">

                                    <input type="text" class="form-control" name="mother_name" value="<?php echo $row['mother_name'];?>"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-3 control-label"><?php echo get_phrase('birthday');?><span class="mandatory">*</span></label>

                                <div class="col-sm-5">

                                    <input type="text" class="datepicker form-control" name="birthday" value="<?php echo $row['birthday'];?>"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="col-sm-3 control-label">Sex</label>

                                <div class="col-sm-5">

                                    <select name="sex" class="form-control">

                                    	<option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>

                                    	<option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>

                                    </select>

                                </div>

                            </div>

							<div class="form-group">

								<label class="col-sm-3 control-label"><?php echo get_phrase('blood_group');?><span class="mandatory">*</span></label>

								<div class="col-sm-5">

									<select name="blood_group" class="form-control" style="width:100%;">

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

                                <label class="col-sm-3 control-label">Address<span class="mandatory">*</span></label>

                                <div class="col-sm-5">

                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>

                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
							 <select name="phone_code" class="form-control" style="width:70px;float:left; ">
                        		<?php $org_phone_code=explode(',',$row['phone']);?>
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>" <?php if($org_phone_code[0]==$row_country_code['country_code']){?>selected<?php } ?>>
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>							
							<input type="text" id="edit_phone" class="form-control input" pattern="\d*" name="phone" maxlength="12"  value="<?php echo $org_phone_code[1]; ?>" data-validate="required" style="width:117px;" />
							<span class="phone" style="color:#cc2424;"></span>		
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									<input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" id="edemail" onBlur="edcheckEmail()"data-validate="email" ><span id="edemail-availability-status"></span><img src="<?php echo base_url();?>/assets/images/loader-2.gif" id="loaderIcone" style="display:none" />
								<span class="email" style="color:#cc2424;"></span>
								</div>
								<input type="hidden" name="edit_std" id="edit_std" value="<?php echo $row['teacher_id']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Change Password<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value="<?php echo $row['real_pass'];?>"/>
                                </div>
                            </div> 
                             <div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Designation<span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="designation" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['designation'];?>">
										</div>
									</div>
                                    	
							<div class="form-group">

                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

                                <div class="col-sm-5">

                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">

                                            <img src="uploads/teacher_image/<?php echo $row['staff_image'];?>" alt="...">

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

								<label for="field-2" class="col-sm-3 control-label">Status</label>

								<div class="col-sm-5">

									<select name="stf_status" class="form-control" style="width:100%;" data-validate="required">
											<option value="">Select Status</option>
											<option value="0" <?php if(@$row['stf_status'] == '0'){ echo "selected"; } ?>>Active</option>
											<option value="1" <?php if(@$row['stf_status'] == '1'){ echo "selected"; } ?>>Inactive</option>									
									</select>
								</div> 
							</div>
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
 var val = $("input[name='teaching_type']:checked").val();
		if ($("#chkYese").is(":checked")) {				
                $("#dvPassporte").show();
            } else {
                $("#dvPassporte").hide();
            }
    $(function () {
        $("input[name='teaching_type']").click(function () {			
            if ($("#chkYese").is(":checked")) {				
                $("#dvPassporte").show();
            } else {
                $("#dvPassporte").hide();
            }
        });
    });
	function edcheckEmail() {
	$("#loaderIcone").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_email/' ,
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
	$("#edit_staff_form").submit(function() {
	
		var email = $("#edemail").val();		
		var phone  = $("#edit_phone").val();		
		//var cont_regex     = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
		if(phone == "") {
			$("span.phone").html("Please enter contact No.").addClass('validate');			
			return false;
		} 
		if( document.getElementById("edit_phone").value.length < 12 ){
			$("span.phone").html("Please enter exactly 10 digits.").addClass('validate');				
			return false;
		}
		else {
			$("span.phone").html("");
		}
		if(email == "") {
			$("span.email").html("Please enter Email.").addClass('validate');			
			return false;
		}
				
		return true;

	}); 
	$("#edemail").keyup(function() {
		if(email != "") {
			$('span.email').html("");
		}	
	});
	
new Formatter(document.getElementById('edit_phone'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
});
}); 
</script>


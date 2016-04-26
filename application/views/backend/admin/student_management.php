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
            	<a href="#student" data-toggle="tab"><i class="entypo-menu"></i>Create Student </a>
			</li>
			<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-plus-circled"></i>Student Listing</a>
			</li>
			<li>
            	<a href="#parent" data-toggle="tab"><i class="entypo-plus-circled"></i>Parent Profiling</a>
			</li>			
		</ul>
		<!--CONTROL TABS END-->
		
		<div class="tab-content">	
			<!--Create Student-->		
			<div class="tab-pane box active" id="student">
				<?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
                <?php echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>"add_student_form", 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Full Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="Fullname is required" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Father's Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="Father is required" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mother's Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="Mother is required" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?><span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="birthday" value="" data-validate="required" data-message-required="Birthday is required" id="birthday"  data-start-view="2">
						</div> 
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('sex');?></label>
						<div class="col-sm-5">
							<input type="radio" name="sex" value="male" checked="checked">Male
							<input type="radio" name="sex" value="female">Female
						</div>
                    </div>
					<div class="form-group">
							<label class="col-sm-3 control-label">Blood Group<span class="mandatory">*</span></label>
							<div class="col-sm-5">
								<select name="blood_group" class="form-control" style="width:100%;" data-validate="required" data-message-required="Blood group is required">
									<option value="">Select Group</option>
									<option value="A-">A-</option>
									<option value="B-">B-</option>
									<option value="O−">O−</option>
									<option value="O+">O+</option>
									<option value="A+">A+</option>
									<option value="B+">B+</option>
									<option value="AB+">AB+</option>
									<option value="AB−">AB−</option>
								</select>
							</div>
                    </div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?><span class="mandatory">*</span></label>
						<div class="col-sm-5">							
							<textarea rows="3" name="address" style="width:100%" data-validate="required" data-message-required="Address is required"></textarea>
						</div> 
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Roll No.<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">							
							 <input name="roll" type="text" id="roll" class="form-control" data-validate="required" data-message-required="Roll No. is required" onBlur="checkAvailability()"><span id="roll-availability-status"></span><img src="<?php echo base_url();?>/assets/images/loader-2.gif" id="loaderIcone" style="display:none" />							 
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Phone<span class="mandatory">*</span></label>										
						<div class="col-sm-5">
                        	<select name="phone_code" class="form-control" style="width:95px;float:left; ">
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>">
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>
							<input type="text" id="phone" class="form-control input" name="phone" value="" maxlength="12" pattern="\d*" data-validate="required" style="width:285px;" data-message-required="Phone is required">
							<span class="phone" style="color:#cc2424;"></span>
						</div> <br/>
						
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-5">					
							<input type="text" class="form-control"  name="email" class="form-control" aria-invalid="false" aria-describedby="email-error" value="" id="email" onBlur="checkEmail()" data-validate="email" data-message-required="Email is required"><span id="email-availability-status"></span>
							<img src="<?php echo base_url();?>/assets/images/loader-2.gif" id="loaderIcone" style="display:none" />	<span class="email" style="color:#cc2424;"></span>					 
							<?php if(isset($code) && $code == 3){echo "class=errorMsg" ;}?> 
						</div>
					</div>					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Create Password<span class="mandatory">*</span></label>                        
						<div class="col-sm-4">
							<input type="password" class="form-control" name="password" value="1234" data-validate="required" data-message-required="Password is required" readonly>
						</div>
						<div class="col-sm-4">
							E.G :-1234
						</div> 
					</div>
					
						
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?><span class="mandatory">*</span></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control" data-validate="required" id="class_id" 
								data-message-required="Class is required"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
							    $this->db->distinct("name_numeric");
							  	$this->db->select("name_numeric");
								
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['name_numeric'];?>">
											<?php echo $row['name_numeric'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
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
						<label for="field-2" class="col-sm-3 control-label">Student Status</label>
						<div class="col-sm-5">
							<select name="std_status" class="form-control" style="width:100%;">
									<option value="0">Active</option>
									<option value="1">Inactive</option>									
								</select>
						</div> 
					</div>	
					<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">							  
                                  <button class="btn btn-info" type="submit">Save</button>
                                  <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
                              </div>
						</div>		
                <?php echo form_close();?>
            </div>
			<!-- End Student --->
			
			<!--Student list-->	
			<div class="tab-pane box" id="list" style="padding: 5px">
          	<div class="panel-body">
            <div class="form-group">
            <div class="col-sm-3">
           	<select class="form-control" name="class_name_datatable" onchange="return class_data_table(this.value);">
            	<option value="">Select Class</option>
                <option value="0">All Class</option>
                <?php 
								$this->db->distinct("name_numeric");
								$this->db->select("name_numeric");
								$this->db->join('student', 'student.class_id = class.name_numeric');
								$class = $this->db->get('class')->result_array();
								foreach($class as $row):?>
					<option value="<?php echo $row['name_numeric'];?>"><?php echo $row['name_numeric'];?></option>
								<?php endforeach; ?>	
            </select>
            </div>
            </div>
          </div>
               
                  <div id="get_data_table"></div>
			</div>
			<!-- End Student List -->
			
			<!--parent Create -->	
			<div class="tab-pane box" id="parent" style="padding: 5px">
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/parent/create/' , array('class' => 'form-horizontal form-groups-bordered validate','id' => 'editForm', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Class<span class="mandatory">*</span></label>
						<div class="col-sm-5">	
							<select name="class_id"style="width:100%;" class="form-control" data-validate="required" id="class_id"  data-message-required="Class is required"
									onchange="return get_classes(this.value)">
							  <option value="">Select Class</option>
							  <?php 
							  	$this->db->distinct("name_numeric");
							  	$this->db->select("name_numeric");
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
									<option value="<?php echo $row['name_numeric'];?>" <?php if($this->session->userdata('p_class') == $row['name_numeric']){ echo "selected"; } ?>>
											<?php echo $row['name_numeric'];?>
											</option>
								<?php
								endforeach;
							  ?>
						  </select>	
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3 control-label">Student</label>
						<div class="col-sm-5">
							<select name="student_id" style="width:100%;" class="form-control" data-validate="required" data-message-required="Student is required" id="student_listing" disabled="disabled">	
								<option value="">Select Class First</option>					
							</select>
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Father's Name<span class="mandatory">*</span></label>
						<div class="col-sm-5" id="parent_listing">
							<input type="text" class="form-control" name="namedfg" data-validate="required" data-message-required="Fathername is required" autofocus value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mother Name</label>
						<div class="col-sm-5" id="mother_listing">
							<input type="text" class="form-control" name="mother_name" id="mother_name"  data-validate="required" data-message-required="Mothername is required" autofocus value="" disabled>
						</div>
					</div>					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Parent Email<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="email" 
                            name="email"  data-validate="required" data-message-required="Email is required" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?><span class="mandatory">*</span></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="" data-validate="required"  data-message-required="Password is required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Phone<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="phone_code" class="form-control" style="width:95px;float:left; ">
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>">
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>
							<input type="text" id="phone_ed" class="form-control input" name="phone" value="" maxlength="12" pattern="\d*"  style="width:268px;">
							<span class="phone_ed" style="color:#cc2424;"></span>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?><span class="mandatory">*</span></label>
                        
						<div class="col-sm-5">							
							<textarea rows="3" name="address" cols="50" data-validate="required" data-message-required="Address is required"></textarea>
						</div>
					</div>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Photo</label>
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
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
					  <?php echo form_close();?>
				</div>	
			</div>
        </div>
    </div>
</div>

<script type="text/javascript">
function checkAvailability() {
	var roll = document.getElementById("roll").value;

	$("#loaderIcone").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_roll/' + roll ,
	data:'roll='+$("#roll").val(),
	type: "POST",
	success:function(data){
		$("#roll-availability-status").html(data);
		$("#loaderIcone").hide();
	},
	error:function (){}
	});
}

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
function parEmail() {
	//var email = document.getElementById("pemail").value;

	$("#ploaderIcone").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_par_email/' ,
	//data:'email='+$("#email").val(),
	data: { email: $("#pemail").val() },
	type: "POST",
	success:function(data){
		$("#parent-availability-status").html(data);
		$("#ploaderIcone").hide();
	},
	error:function (){}
	});
}
</script>

<script type="text/javascript">
	function get_class_sections(class_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }	
	
	function get_classes(class_id) {   
		if(class_id != ''){			
			 $('#student_listing').removeAttr('disabled');
		}else {
			  $('#student_listing').attr('disabled', 'disabled');
		}
	
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_classes/' + class_id ,
				success: function(response)
				{

					jQuery('#student_listing').html(response);
				}
			});
   }
	
	 $("#student_listing").change(function () {
		var selectedValue = $(this).val();
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_parent_name/' + selectedValue ,
				success: function(response)
				{
					jQuery('#parent_listing').html(response);
				}
			});
		});
		
		$("#student_listing").change(function () {
			var selectedValue = $(this).val();
			$.ajax({
					url: '<?php echo base_url();?>index.php?admin/get_mother_name/' + selectedValue ,
					success: function(response)
					{
						jQuery('#mother_listing').html(response);
					}
				});
			});
</script>
<script src="<?php echo base_url();?>/assets/js/framework/formValidation.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/formatter.js"></script> 

<script type="text/javascript">
$(document).ready(function(e) {
 var FromEndDate = new Date();
    $("#birthday").datepicker({        format: 'mm-dd-yyyy',   endDate: FromEndDate,     autoclose: true});
});
$(document).ready(function() {
	
	
	$("#add_student_form").submit(function() {
		var email = $("#email").val();	
		var capt  = $("#phone").val();		
		//var cont_regex     = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
		
	if(capt == "") {
		//$("span.phone").html("Please enter contact No.").addClass('validate');			
		return false;
	} else {
		if( document.getElementById("phone").value.length < 12 ){
			$("span.phone").html("Please enter exactly 10 digits.").addClass('validate');				
				return false;
		}
		if(!cont_regex.test(capt)){ // if invalid Contact			
			   $("span.phone").html("Invalid Contact No!").addClass('validate');				
			return false;
		} else {
			$("span.phone").html("");
		}		
	}	
	return true;
	}); 
	$("#email").keyup(function() {
		if(email != "") {
			$('span.email').html("");
		}	
	});
	
	$("#editForm").submit(function() {
		var email  			= $("#pemail").val();
		var capt  			= $("#phone_ed").val();		
		//var cont_regex     = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
		if(capt == "") {
			$("span.phone_ed").html("Phone is required").addClass('validate');			
			return false;
		}
		if(capt != ""){
			if( document.getElementById("phone_ed").value.length < 12 ){
				$("span.phone_ed").html("Please enter exactly 10 digits.").addClass('validate');				
					return false;
				}
				if(!cont_regex.test(capt)){ // if invalid Contact
				
					   $("span.phone_ed").html("Invalid Contact No!").addClass('validate');				
					return false;
				} else {
					$("span.phone_ed").html("");
				}
		}	
		if(email == "") {
			$("span.pemail").html("Please enter Email.").addClass('validate');			
			return false;
		}
		
	return true;
	}); 
	$("#pemail").keyup(function() {
		if(email != "") {
			$('span.pemail').html("");
		}	
	});

	new Formatter(document.getElementById('phone'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
});
new Formatter(document.getElementById('phone_ed'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
});
 
});
</script>
<script type='text/javascript'>
 function class_data_table(class_id){
 $.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_data_table/',
				data: { class_id: class_id,list:'student' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});
	 }
</script>

<?php 	
	$edit_data = $this->db->get_where('parent' , array('parent_id' => $param2))->result_array();
	foreach ($edit_data as $row):	
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					Edit Parent
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/parent/edit/' . $row['parent_id'] , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'edit_parent', 'enctype' => 'multipart/form-data'));?>
                <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Photo</label>
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <input type="hidden" name="txtoldphoto" value="<?=$row['parent_image'];?>">
									<img src="uploads/parent_image/<?php echo $row['parent_image'];?>" alt="...">
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
						<label for="field-1" class="col-sm-3 control-label">Father's Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus value="<?php echo $row['name']; ?>" disabled="disabled">
                            <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
						</di
						></div>
					</div>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mother's Name<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus value="<?php echo $row['mother_name']; ?>" disabled="disabled">
                            <input type="hidden" name="mother_name" value="<?php echo $row['mother_name']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Parent Email<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="<?php echo $row['parent_email']; ?>" data-validate="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Parent Password<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="<?php echo $row['real_pass']; ?>" data-validate="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Parent Phone<span class="mandatory">*</span></label>
						<div class="col-sm-5">
                        	<select name="phone_code" class="form-control" style="width:80px;float:left; ">
                        		<?php $org_phone_code=explode(',',$row['phone']);?>
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>" <?php if($org_phone_code[0]==$row_country_code['country_code']){?>selected<?php } ?>>
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>							
							<input type="text" id="phone" class="form-control input" pattern="\d*" name="phone" maxlength="12"  value="<?php echo $org_phone_code[1]; ?>" data-validate="required" style="width:106px;" />
							<span class="phone" style="color:#cc2424;"></span>
						</div>						
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Parent Address<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<textarea rows="3" name="address" cols="25" data-validate="required"><?php echo $row['address']; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default">Save</button>
                            <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<script type="text/javascript" src="assets/js/formatter.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	$("#edit_parent").submit(function() {
		var capt  			= $("#phone").val();		
		//var cont_regex     = /^\d{11}$/; // reg ex contact check
		//var cont_regex     = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
	if(capt == "") {
		$("span.phone").html("Please enter contact No.").addClass('validate');			
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
//});
	});
	new Formatter(document.getElementById('phone'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
});

});
function get_classes(class_id) {   
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_classes/' + class_id ,
				success: function(response)
				{
					jQuery('#student_listing').html(response);
				}
			});
   }
</script>
<style>.DTTT.btn-group{display:none;}</style>	
	<div class="col-md-12">
		<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#staff" data-toggle="tab"><i class="entypo-menu"></i>Create Staff</a>
			</li>
			<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-plus-circled"></i>Staff Listing</a>
			</li>						
		</ul>
		<!--CONTROL TABS END-->
		<div class="tab-content">	
			<!--Create Staff -->		
			<div class="tab-pane box active" id="staff">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary" data-collapsed="0">        	
							<div class="panel-body">
								<?php echo form_open(base_url() . 'index.php?admin/staff/create/' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'add_staff_form', 'enctype' => 'multipart/form-data'));?>
								<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>	
									<label for="chkYes">
										<input type="radio" id="chkYes" name="teaching_type" value="1" onblur="teachingtype_check(this.value);"/>
										Teaching Staff
									</label>
									<br/>
									<label for="chkNo">
										<input type="radio" id="chkNo" name="teaching_type" value="2" onblur="teachingtype_check(this.value);"  checked="checked"/>
                                       NonTeaching Staff
									</label>
									 <div id="dvPassport" style="display: none">
										 <div class="form-group">
											<label for="field-1" class="col-sm-3 control-label">Select File</label>
											<input type="file" name="uploadcv" class="file"  id="input-1" accept=".pdf,.doc,.txt,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" />
										</div>
										 <span id="lblError" style="color: red;"></span>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Full Name<span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="name" data-validate="required" data-message-required="Fullname is required" value="" autofocus>
										</div>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Father's Name<span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="Father's name is required" value="" autofocus>
										</div>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Mother's Name<span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="Mother's name is required" value="" autofocus />
										</div>
									</div>									
									<div class="form-group">
										<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?><span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2" />
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
										<label class="col-sm-3 control-label"><?php echo get_phrase('blood_group');?><span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<select name="blood_group" class="form-control" style="width:100%;" data-validate="required" data-message-required="blood group is required">
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
											<textarea rows="3" name="address" cols="50" data-validate="required" data-message-required="Address is required" /></textarea>
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
							<input type="text" id="phone" class="form-control input" name="phone" value="" maxlength="12" pattern="\d*" data-validate="required" data-message-required="Phone is required" style="width:260px;">
                                            <span class="phone" style="color:#cc2424;"></span>
										</div> 
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Email<span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="email" value="" id="email" onBlur="checkEmail()" data-validate="required,email" data-message-required="Email is required"><span id="email-availability-status"></span>
											<img src="<?php echo base_url();?>/assets/images/loader-2.gif" id="loaderIcone" style="display:none" />	
                                            <span class="email" style="color:#cc2424;"></span>						 
											<?php if(isset($code) && $code == 3){echo "class=errorMsg" ;}?> 
										</div>
									</div>
									<div class="form-group">
										<label for="field-2" class="col-sm-3 control-label">Create Password<span class="mandatory">*</span></label>										
										<div class="col-sm-5">
											<input type="password" class="form-control" name="password" value="1234"data-validate="required" data-message-required="Password is required" readonly>
										</div> 
										<div class="col-sm-4">
							E.G 		:-1234
						</div> 			</div>
                                    
                                    <div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Designation<span class="mandatory">*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="designation" data-validate="required" data-message-required="Designation is required" value="" autofocus>
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

										<label for="field-2" class="col-sm-3 control-label">Status</label>

										<div class="col-sm-5">
											<select name="stf_status" class="form-control" style="width:100%;" data-validate="required">
													<option value="0" >Active</option>
													<option value="1">Inactive</option>									
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

			</div>
			<!---   End Staff create -->
			<div class="tab-pane box" id="list">
            <form action="<?php echo  base_url().'index.php?admin/delete_all_staff'; ?>" method="post">
				 <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                        
							<th><div>Tid</div></th>
							<th><div>Photo</div></th>
                            <th width="80"><div>Name</div></th>
                            <th><div>Email</div></th>
                            <th><div>Address</div></th>
                            <th><div>Staff Detail</div></th>
                            <th><div>Designation</div></th>
							<th><div>Options</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $year_start_date=$this->session->userdata('start_date');
                            $year_end_date=$this->session->userdata('end_date');
                                $teachers	=	$this->db->get_where('teacher',array('created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array();
                                foreach($teachers as $row):?>
                        <tr>
                        
                        <td><?php echo $row['teacher_id'];?></td>
                           <td>
                            <?php if($row['staff_image']!=''){ ?>
                           <img src="<?php echo base_url();?>uploads/teacher_image/<?php echo $row['staff_image'];?>" class="img-circle" width="30" /> 
                           <?php }else{ ?>
                            <img src="<?php echo base_url();?>uploads/user.jpg" class="img-circle" width="30" />
                            <?php }?>
                           </td>
                            <td><?php echo $row['name'];?>  <?php if($row['teaching_type'] == 1 && !empty($row['file_name'])){ ?>&nbsp;<a href="download.php?file_name=<?php echo $row['file_name'];?>" class="links"><i class="fa fa-download"></i><?php } ?></a></td>                           
                            <td><?php echo $row['email'];?></td>
							<td><?php echo $row['address'];?></td>
                             <td><?php   if($row['teaching_type'] == 1){
										echo "Teaching";
									}elseif($row['teaching_type'] == 2){
										echo "Non Teaching"; }
								?>							
							</td>
                            <td><?php echo $row['designation'];?></td>
                          	<td>                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
									<!-- teacher EDITING LINK -->
									<li>
										<a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_staff_edit/<?php echo $row['teacher_id'];?>');">

											<i class="entypo-pencil"></i>
											Edit	
											</a>

									</li>

									<li class="divider"></li>                                        

									<!-- teacher DELETION LINK 

									<li>

										<a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/staff/delete/<?php echo $row['teacher_id'];?>');">

											<i class="entypo-trash"></i>

												<?php echo get_phrase('delete');?>

											</a>

									</li>-->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                
                
                </form>	
                			
			</div>
		</div>	
	</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ----> 
<script>
 jQuery(document).ready(function() {
	   jQuery("#deletesall").click(function(){
		   
		   var student_length =  $(".checkbox1:checked").length;
		
		   if(student_length < 1)
			{
				 alert('Please select at least one!');
				return false;	 
			}
		   
	 			var r = confirm("Do you want to delete selected data?");
								
								if (r == true) {
									
								} else {
								
								   return false;
								}		
								});
  jQuery('#selecctall').click(function(event) {  
 
   if(this.checked) { 
    jQuery('.checkbox1').each(function() { 
     this.checked = true;          
    });
    }else{
    jQuery('.checkbox1').each(function() { 
     this.checked = false;               
    });         
   }
  });
  
  jQuery(".checkbox1").click(function(){
   if($(".checkbox1").length == $(".checkbox1:checked").length) {
    jQuery("#selecctall").prop("checked",true);
    } else {
    jQuery("#selecctall").prop("checked",false);
   }
   
  }); 
  
 });
</script>
<script type="text/javascript" src="assets/js/formatter.js"></script> 
                     
<script type="text/javascript">
function teachingtype_check(teach_type){
		if(teach_type ==1)
		{
			var allowedFiles = [".doc", ".docx", ".pdf"];
			var fileUpload = document.getElementById("input-1");
			var lblError = document.getElementById("lblError");
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
			if (!regex.test(fileUpload.value.toLowerCase())) {
				lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
				return false;
			}
			lblError.innerHTML = "";
			return true;
		}
}
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } },{
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
		});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
 <script type="text/javascript">
    $(function () {
        $("input[name='teaching_type']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
	function checkEmail() {
	$("#loaderIcone").show();
	jQuery.ajax({
	url: '<?php echo base_url();?>index.php?admin/check_email/' ,
	data: { email: $("#email").val() },
	type: "POST",
	success:function(data){
		$("#email-availability-status").html(data);
		$("#loaderIcone").hide();
	},
	error:function (){}
	});
}
</script>
<script src="<?php echo base_url();?>/assets/js/framework/formValidation.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/framework/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#add_staff_form").submit(function() {
		var email = $("#email").val();	
		var capt  			= $("#phone").val();		
		//var cont_regex     = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; // reg ex contact check
		if(capt == "") {
			//$("span.phone").html("Please enter contact No.").addClass('validate');			
			return false;
		}
		else {
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
	
	new Formatter(document.getElementById('phone'), {
  'pattern': '{{999}}-{{999}}-{{9999}}'
});

});
</script>



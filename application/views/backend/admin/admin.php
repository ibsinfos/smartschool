<script src="<?php echo base_url();?>/assets/js/framework/formValidation.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/formatter.js"></script> 

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		$('#example').dataTable( {
				paging: false,
				searching: false
		});
		
new Formatter(document.getElementById('phone'), {
  'pattern': '{{999}}-{{999}}-{{999}}'
});

 var FromEndDate = new Date();
    $("#birthday").datepicker({format:'mm-dd-yyyy',endDate: FromEndDate,autoclose: true});
});
</script>


<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Admin List
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Add Admin 
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>Full Name</div></th>
                    		<th><div>Father Name</div></th>  
                            <th><div>Mother Name</div></th>                   		
                            <th><div>Email</div></th>                   		
                    		<th><div>Options</div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($admin as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['father_name'];?></td>
                            <td><?php echo $row['mother_name'];?></td>
                            <td><?php echo $row['email'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/model_admin_edit/<?php echo $row['admin_id'];?>');">
                                            <i class="entypo-pencil"></i>Edit
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    <!-- DELETION LINK 
                                    <li>
                                        <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/admin/delete/<?php echo $row['admin_id'];?>');">
                                       <i class="entypo-trash"></i>Delete
                                            </a>
                                    </li>-->
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url().'index.php?admin/admin/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','id'=>'admin_form','enctype'=>'multipart/form-data'));?>
                        <div class="padded"> 
                        <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>                           
							<div class="form-group">
                                <label class="col-sm-3 control-label">Full Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="fullname" data-validate="required" data-message-required="Fullname is required"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Father Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                     <input type="text" class="form-control" name="father_name" data-validate="required" data-message-required="Fathername is required" id="father_name"/>
                                </div>
                            </div>                          
					    <div class="form-group">
                                <label class="col-sm-3 control-label">Mother Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="mother_name" data-validate="required" data-message-required="Mothername is required" />
                                </div>
                            </div>
                     <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Birthday<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" id="birthday" value="" data-validate="required" data-message-required="Birthday is required"  data-start-view="2">
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
                                <label class="col-sm-3 control-label">Email<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="email" data-validate="required,email" data-message-required="Email is required" />
                                </div>
                            </div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Password<span class="mandatory">*</span></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="" data-validate="required"  data-validate="required" data-message-required="Password is required">
						</div>
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?><span class="mandatory">*</span></label>															  						<div class="col-sm-5">
                        	<select name="phone_code" class="form-control" style="width:95px;float:left; ">
                        		<?php $get_country_code=$this->db->get('country_code')->result_array();
                        		foreach ($get_country_code as $row_country_code) { ?>
                        		<option value="<?php echo $row_country_code['country_code'] ?>">
                        			<?php echo $row_country_code['country_code']; ?>	
                        		</option>	
                        		<?php } ?>
                        	</select>	
							<input type="text" id="phone" class="form-control input" name="phone" value="" maxlength="11" pattern="\d*" data-validate="required" style="width:280px;" data-message-required="Phone is required">
							<span class="phone" style="color:#cc2424;"></span>
						</div> <br/>
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
                              <div class="col-sm-offset-3 col-sm-5">
                                 <button type="submit" class="btn btn-info">Save</button>
                                 <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
                              </div>
						</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>

<script type="text/javascript">
function get_student(class_id) {   
	$.ajax({
		url: '<?php echo base_url();?>index.php?admin/get_classes/' + class_id ,
		success: function(response)
		{
			jQuery('#student_list').html(response);
		}
	});
}
function get_route(route_id) { 
	$.ajax({
		url: '<?php echo base_url();?>index.php?admin/get_route/' + route_id ,
		success: function(response)
		{
			var json = $.parseJSON(response);
			$('#route_amount').val(json.route_amount);
			$('#seat_capacity1').val(json.seat_capacity);
			$('#stop_name1').html(json.stop_name);
		}
	});
}   
</script>
<div class="row">
	<div class="col-md-12">
		<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-plus-circled"></i>List Transport</a>
			</li>
			<li>
            	<a href="#create_transport" data-toggle="tab"><i class="entypo-menu"></i>Create Transport </a>
			</li>
		</ul>
		<!--CONTROL TABS END-->
		
		<div class="tab-content">	
			<!--Create Transport -->		
			<div class="tab-pane box" id="create_transport">
				<?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
                <?php echo form_open(base_url() . 'index.php?admin/transport/create/' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>"add_student_form", 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Register No.<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="register_no" data-validate="required" data-message-required="Register No. is required" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Vehical Type<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="vehical_type1" class="form-control" data-validate="required" data-message-required="Vehical type is required">
                        		<option value="">Select Vehical</option>
                        		<option value="bus">Bus</option>
                        		<option value="van">Van</option>
                        		<option value="auto">Auto</option>
                        		<option value="car">Car</option>
                        	</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Register Owner<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="register_owner" data-validate="required" data-message-required="Register Owner is required" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Address<span class="mandatory">*</span></label>
						<div class="col-sm-5">							
							<textarea rows="3" name="address" style="width:100%" data-validate="required" data-message-required="Address is required"></textarea>
						</div> 
					</div>
                    
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Seat Capacity<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="seat_capacity" maxlength="2" data-validate="required,number" data-message-required="Seat Capacity is required">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Colour<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="colour" data-validate="required" data-message-required="Colour is required">
						</div> 
					</div>	
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Maker<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="maker" data-validate="required" data-message-required="Maker is required">
						</div> 
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">MFG Year<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="mfg_year" class="form-control" data-validate="required" data-message-required="MFG year is required">
                        		<option value="">Select MFG Year</option>
                        		<?php for($year=1990;$year<=date(Y);$year++){?>
                        			<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        		<?php } ?>
                        	</select>
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
                    	    <button class="btn btn-info" type="submit">Save</button>
                        	<button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
                    	</div>
					</div>		
                <?php echo form_close();?>
            </div>
			<!-- End Transport creation -->
			
			<!--Transport list-->	
			<div class="tab-pane box active" id="list" style="padding: 5px">
          	 <form action="<?php echo  base_url().'index.php?admin/delete_all_transport'; ?>" method="post">
				 <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                        	<th><div>Regn.No</div></th>
							<th><div>Regn Owner</div></th>
							<th><div>Vehical Type</div></th>
							<th><div>Address</div></th>
                            <th><div>Seating Capacity </div></th>
                            <th><div>Maker</div></th>
                            <th><div>MFG Year</div></th>
                            <th><div>Photo</div></th>
                            <th><div>Options</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $transport=$this->db->get('transport')->result_array();
                            foreach($transport as $row_transport):
                        ?>
                        <tr>
                           	<td><?php echo $row_transport['registration_no'];?></td>
                            <td><?php echo $row_transport['register_owner'];?></td>
                            <td><?php echo $row_transport['vehical_type'];?></td>
                            <td><?php echo $row_transport['address'];?></td>	
							<td><?php echo $row_transport['seat_capacity']; ?></td>
							<td><?php echo $row_transport['maker'];?></td>
							<td><?php echo $row_transport['mfg_year'];?></td>
							<td><?php if($row_transport['photo']!=''){ ?>
                            <img src=" <?php echo base_url();?>uploads/transport/<?php echo $row_transport['photo'];?>" class="img-circle" width="30" />
                            <?php }else{ ?>
                            <img src="<?php echo base_url();?>uploads/user.jpg" class="img-circle" width="30" />
                            <?php }?>
                            </td>
							<td>                                
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								<!-- Transport EDITING LINK -->
								<li>
									<a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_edit/<?php echo $row_transport['transport_id'];?>');">
									<i class="entypo-pencil"></i>Edit</a>
								</li>
								</ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               </form>	
			</div>
			<!-- End Transport list -->
			
        </div>
    </div>
</div>
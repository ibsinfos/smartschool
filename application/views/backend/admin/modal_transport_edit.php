<?php 
$edit_data=$this->db->get_where('transport' , array('transport_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body">
            <?php echo form_open(base_url() . 'index.php?admin/transport/transport_do_update/'.$row['transport_id'] , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'edit_transport_form','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
				<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
				<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Register No.<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="register_no" data-validate="required" data-message-required="Register number is required" value="<?php echo $row['registration_no']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Vehical Type<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="vehical_type" class="form-control" data-validate="required" data-message-required="Vehical type is required">
                        		<option value="">Select Vehical</option>
                        		<option value="bus" <?php if($row['vehical_type']=='bus'){echo 'selected';} ?>>Bus</option>
                        		<option value="van" <?php if($row['vehical_type']=='van'){echo 'selected';} ?>>Van</option>
                        		<option value="auto" <?php if($row['vehical_type']=='auto'){echo 'selected';} ?>>Auto</option>
                        		<option value="car" <?php if($row['vehical_type']=='car'){echo 'selected';} ?>>Car</option>
                        	</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Register Owner<span class="mandatory">*</span></label>                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="register_owner" data-validate="required" data-message-required="Register owner is required" value="<?php echo $row['register_owner']; ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Address<span class="mandatory">*</span></label>
						<div class="col-sm-5">							
							<textarea rows="3" name="address" style="width:100%" data-validate="required" data-message-required="Address is required"><?php echo $row['address']; ?></textarea>
						</div> 
					</div>
                   
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Seat Capacity</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="seat_capacity" maxlength="2" data-validate="required,number" data-message-required="Seat capacity is required" value="<?php echo $row['seat_capacity']; ?>">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Colour</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="colour" data-validate="required" data-message-required="Colour is required" value="<?php echo $row['colour']; ?>">
						</div> 
					</div>	
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Maker<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="maker" data-validate="required" data-message-required="Maker is required" value="<?php echo $row['maker']; ?>">
						</div> 
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">MFG Year<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="mfg_year" class="form-control" data-validate="required" data-message-required="MFG year is required">
                        		<option value="">Select MFG Year</option>
                        		<?php for($year=1990;$year<=date(Y);$year++){?>
                        			<option value="<?php echo $year; ?>" <?php if($year==$row['mfg_year']){echo 'selected';} ?>><?php echo $year; ?></option>
                        		<?php } ?>
                        	</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Photo</label>
						<div class="col-sm-5">
                        <?php   $imgpath = FCPATH.'uploads/transport/'.$row['photo']; ?>
						
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <input type="hidden" name="txtoldphoto" value="<?php echo $row['photo']; ?>">
                              <?php if(!empty($row['photo'])){
								  if(file_exists($imgpath)){ ?>
									<img src="uploads/transport/<?php echo $row['photo'];?>" alt="...">
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

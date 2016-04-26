<?php 
$edit_data=$this->db->get_where('transport_route' , array('transport_route_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body">
            <?php echo form_open(base_url() . 'index.php?admin/route/transport_route_do_update/'.$row['transport_route_id'] , array('class' => 'form-horizontal form-groups-bordered validate','id' => 'editForm', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Route Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">	
							<input type="text" class="form-control" name="route_name" data-validate="required" data-message-required="Route name is required" value="<?php echo $row['route_name']; ?>">
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3 control-label">Vehical<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="vehical" class="form-control" data-validate="required" data-message-required="Vehical is required">
                        		<option value="">Select Vehical</option>
                        		<?php 
								$transport1 = $this->db->get('transport')->result_array();
								foreach($transport1 as $row_transport1):
								?>
								<option value="<?php echo $row_transport1['registration_no'];?>"<?php if($row_transport1['registration_no']==$row['vehical']){echo 'selected';} ?>>
								<?php echo $row_transport1['registration_no'].' - '.$row_transport1['vehical_type'];?></option> 
								<?php endforeach; ?>
                        	</select>
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Driver Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="driver_name" data-validate="required" data-message-required="Driver name is required" value="<?php echo $row['driver_name']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mobile Number<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" value="<?php echo $row['mobile_number']; ?>" name="mobile_number" data-validate="required,number" maxlength="10" data-message-required="Mobile Number is required">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Amount<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="amount" value="<?php echo $row['amount']; ?>" data-validate="required,number" data-message-required="Amount is required" >
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
<?php endforeach; ?>

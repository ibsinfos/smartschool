<?php 
$edit_data=$this->db->get_where('transport_route_stop' , array('transport_route_stop_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body">
            <?php echo form_open(base_url() . 'index.php?admin/route/transport_route_stop_update/'.$row['transport_route_stop_id'] , array('class' => 'form-horizontal form-groups-bordered validate','id' => 'editForm', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Route Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="route_id" class="form-control" data-validate="required" data-message-required="Route name is required">
                        		<option value="">Select Route</option>
                        		<?php 
                        		$this->db->select('transport_route_id,route_name');	
								$get_route = $this->db->get('transport_route')->result_array();
								foreach($get_route as $row_route):
								?>
								<option value="<?php echo $row_route['transport_route_id'];?>" <?php if($row_route['transport_route_id']==$row['route_id']){echo 'selected';} ?>><?php echo $row_route['route_name'];?></option> 
								<?php endforeach; ?>
                        	</select>
						</div>
					</div>	
					<div class="form-group">
					<label class="col-sm-3 control-label">Stop Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">	
							<input type="text" class="form-control" name="stop_name1" data-validate="required" data-message-required="Stop name is required" value="<?php echo $row['stop_name'];?>">
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

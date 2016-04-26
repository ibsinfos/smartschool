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
			$('#vehical').val(json.vehical);
			$('#route_amount').val(json.route_amount);
			$('#seat_capacity1').val(json.seat_capacity);
			$('#driver_name').val(json.driver_name);
			$('#mobile_no').val(json.mobile_no);
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
            	<a href="#assign_route_student" data-toggle="tab"><i class="entypo-plus-circled"></i>Assign Student Stop</a>
			</li>
			<li>
            	<a href="#list_route_student" data-toggle="tab"><i class="entypo-plus-circled"></i>Student Stop List</a>
			</li>
		</ul>
		<!--CONTROL TABS END-->
		<div class="tab-content">	
			<!--Assign Student Route -->	
			<div class="tab-pane box active" id="assign_route_student" style="padding: 5px">
			<div class="panel-body">
			    <?php echo form_open(base_url() . 'index.php?admin/route_assign_student/assign_route_student/' , array('class' => 'form-horizontal form-groups-bordered validate','id' => 'editForm', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Class<span class="mandatory">*</span></label>
						<div class="col-sm-5">	
							<select name="class_id" class="form-control"  id="exam_class" onchange="get_student(this.value)"  style="float:left;" data-validate="required" data-message-required="Class is required">
							<option value="">Select Class</option>
							<?php 
								$this->db->select('name_numeric');
								$this->db->distinct();
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
							?>
								<option value="<?php echo $row['name_numeric'];?>">
								<?php echo $row['name_numeric'];?></option> 
								<?php endforeach; ?>
							</select>
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3 control-label">Student<span class="mandatory">*</span></label>
						<div class="col-sm-5">
						<select  class="form-control"  name="student_id" id="student_list" data-validate="required" data-message-required="Student is required">
							<option value="">Select Class First</option>
						</select>	
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Route Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="route_name1" class="form-control" onchange="get_route(this.value)"  style="float:left;" data-validate="required" data-message-required="Route name is required">
							<option value="">Select Route</option>
							<?php 
								$transport_route = $this->db->get('transport_route')->result_array();
								foreach($transport_route as $row_transport_route):
							?>
								<option value="<?php echo $row_transport_route['transport_route_id'];?>">
								<?php echo $row_transport_route['route_name'];?></option> 
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Vehical<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" id="vehical" name="Vehical" data-message-required="Vehical is required" readonly >
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Route Amount<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required,number" id="route_amount" name="route_amount" data-message-required="Route amount is required" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Driver Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" id="driver_name" name="driver_name" data-message-required="Driver name is required" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Driver Mobile No.<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" id="mobile_no" name="mobile_no" data-message-required="Moblie No. is required" readonly>
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Seat Capacity<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" data-validate="required" id="seat_capacity1" name="seat_capacity1" data-message-required="Seat capacity is required" readonly >
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Stop Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<select name="stop_name1" id="stop_name1" class="form-control" style="float:left;" data-validate="required" data-message-required="Stop name is required">
								<option value="">Select Stop</option>
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
			<!-- End Assign Student Route -->	

			<!--List-->	
			<div class="tab-pane box " id="list_route_student" style="padding: 5px">
         		<table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                        	<th><div>class</div></th>
							<th><div>Student Name</div></th>
                            <th><div>Route Name</div></th>
                            <th><div>Vehical</div></th>
                            <th><div>Driver Name</div></th>
                            <th><div>Mobile No.</div></th>
                            <th><div>Route Amount</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $this->db->select('student.name,student.class_id,transport_route.route_name,transport_route.amount,transport_route.driver_name,transport_route.mobile_number,transport.vehical_type'); 
                    $this->db->join('student','student.student_id=transport_assign_student_route.student_id');
                    $this->db->join('transport_route','transport_route.transport_route_id=transport_assign_student_route.route_id');
                    $this->db->join('transport','transport.registration_no=transport_route.vehical');
                    $route_stop=$this->db->get('transport_assign_student_route')->result_array();
                    // echo $this->db->last_query();
                    foreach($route_stop as $row_route_stop):
                    ?>
                        <tr>
                           	<td><?php echo $row_route_stop['class_id'];?></td>
                            <td><?php echo $row_route_stop['name'];?></td>
                            <td><?php echo $row_route_stop['route_name'];?></td>
                            <td><?php echo $row_route_stop['vehical_type'];?></td>
                            <td><?php echo $row_route_stop['driver_name'];?></td>
                            <td><?php echo $row_route_stop['mobile_number'];?></td>
                            <td><?php echo $row_route_stop['amount'];?></td>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table> 
            </div>
			<!-- End Stop list -->
        </div>
    </div>
</div>
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
jQuery(document).ready(function($)
    {   
        var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        }); 
    });
    jQuery(document).ready(function($)
    {   
        var datatable = $("#table_export1").dataTable();
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        }); 
    });

</script>
<div class="row">
	<div class="col-md-12">
		<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#create_route" data-toggle="tab"><i class="entypo-plus-circled"></i>Create Route</a>
			</li>
			<li>
            	<a href="#create_stop" data-toggle="tab"><i class="entypo-plus-circled"></i>Create Stop</a>
			</li>
			<li >
            	<a href="#list_stop" data-toggle="tab"><i class="entypo-plus-circled"></i>List Stop</a>
			</li>
		</ul>
		<!--CONTROL TABS END-->
		
		<div class="tab-content">	
			
			<!--route Create -->	
			<div class="tab-pane box active" id="create_route" style="padding: 5px">
			<div class="panel-body">
				<table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                        	<th><div>Route Name</div></th>
							<th><div>Vehical Type</div></th>
                            <th><div>Driver Name</div></th>
                            <th><div>Mobile No.</div></th>
                            <th><div>Amount</div></th>
                            <th><div>Options</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $transport_route=$this->db->get('transport_route')->result_array();
                            foreach($transport_route as $row_transport_route):
                        ?>
                        <tr>
                           	<td><?php echo $row_transport_route['route_name'];?></td>
                            <td><?php echo $row_transport_route['vehical'];?></td>
							<td><?php echo $row_transport_route['driver_name'];?></td>
                            <td><?php echo $row_transport_route['driver_name']; ?></td>
                            <td><?php echo $row_transport_route['amount'];?></td>
                            <td>                                
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								<li>
									<a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_route_edit/<?php echo $row_transport_route['transport_route_id'];?>');">
									<i class="entypo-pencil"></i>Edit</a>
								</li>
								</ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			    <?php echo form_open(base_url() . 'index.php?admin/route/create_route/' , array('class' => 'form-horizontal form-groups-bordered validate','id' => 'editForm', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Route Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">	
							<input type="text" class="form-control" name="route_name" data-validate="required" data-message-required="Route name is required" value="">
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
								<option value="<?php echo $row_transport1['registration_no'];?>">
								<?php echo $row_transport1['registration_no'].' - '.$row_transport1['vehical_type'];?></option> 
								<?php endforeach; ?>
                        	</select>
						</div>
					</div>	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Driver Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="driver_name" data-validate="required" data-message-required="Driver name is required">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Mobile Number<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mobile_number" data-validate="required,number" maxlength="10" data-message-required="Mobile Number is required">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Amount<span class="mandatory">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="amount" data-validate="required,number" data-message-required="Amount is required" >
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
       	
       		<!--Create Stop-->	
			<div class="tab-pane box" id="create_stop" style="padding: 5px">
			<div class="panel-body">
			    <?php echo form_open(base_url() . 'index.php?admin/route/transport_route_stop_create/' , array('class' => 'form-horizontal form-groups-bordered validate','id' => 'editForm', 'enctype' => 'multipart/form-data'));?>
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
								<option value="<?php echo $row_route['transport_route_id'];?>"><?php echo $row_route['route_name'];?></option> 
								<?php endforeach; ?>
                        	</select>
						</div>
					</div>	
					<div class="form-group">
					<label class="col-sm-3 control-label">Stop Name<span class="mandatory">*</span></label>
						<div class="col-sm-5">	
							<input type="text" class="form-control" name="stop_name1" data-validate="required" data-message-required="Stop name is required" value="">
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

			<!--List Stop-->	
			<div class="tab-pane box " id="list_stop" style="padding: 5px">
         		<table class="table table-bordered datatable" id="table_export1">
                    <thead>
                        <tr>
                        	<th><div>Route Name</div></th>
							<th><div>Stop Name</div></th>
                            <th><div>Options</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        	$this->db->select('transport_route.route_name,transport_route_stop.stop_name,transport_route_stop.transport_route_stop_id'); 
                        	$this->db->join('transport_route','transport_route.transport_route_id=transport_route_stop.route_id');
                            $route_stop=$this->db->get('transport_route_stop')->result_array();
                            foreach($route_stop as $row_route_stop):
                        ?>
                        <tr>
                           	<td><?php echo $row_route_stop['route_name'];?></td>
                            <td><?php echo $row_route_stop['stop_name'];?></td>
                            <td>                                
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								<li>
									<a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_route_stop_edit/<?php echo $row_route_stop['transport_route_stop_id'];?>');">
									<i class="entypo-pencil"></i>Edit</a>
								</li>
								<li>
                                    <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/route/delete/<?php echo $row_route_stop['transport_route_stop_id'];?>');">
                                    <i class="entypo-trash"></i>
                                    Remove</a>
                                </li>
								</ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table> 
            </div>
			<!-- End Stop list -->
        </div>
    </div>
</div>
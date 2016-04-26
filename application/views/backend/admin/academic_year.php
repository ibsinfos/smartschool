<!--  DATA TABLE EXPORT CONFIGURATIONS -->  
<script type="text/javascript">
	jQuery(document).ready(function($){
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>

<script type="text/javascript">
  jQuery(document).ready(function($){
	  var start_date =  $('#from_date').val();
  $('#from_date').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '0',
	autoclose: true
	
});
$('#to_date').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '0',
	    autoclose: true
});


	$("#academic_submit").submit(function(){
		
		
			var start_date =  $('#from_date').val();
			var end_date =  $('#to_date').val();
			if(end_date!="" && start_date!="")
			{
			if(start_date==end_date)
			{
				$("#error_to_date").show();
				$("#error_to_date").html('same date not allowed!');
				return false;
			}
			else{
				
					$("#error_to_date").html('');
				}
			
	}
  });
  });
  </script>
<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					 Academic Year
                </a>
            </li>
            <li>
                <a href="#add2" data-toggle="tab"><i class="entypo-plus-circled"></i>
                     Add Academic Year
                </a>
            </li>
            <li>
                <a href="#add3" data-toggle="tab"><i class="entypo-plus-circled"></i>
                     Set Academic Year
                </a>
            </li>
		</ul>
        

    	<!--CONTROL TABS END-->
		<div class="tab-content">            
            <!--TABLE LISTING STARTS-->
			<!--CREATION FORM STARTS-->
			<div class="tab-pane box active" id="add" style="padding: 5px">
            <table class="table table-bordered datatable" id="table_export">
            <thead>
                <tr>
                    <th><div>#</div></th>
                    <th><div>Start Year</div></th>
                    <th><div>End Year</div></th>  
                    <th ><div>Start Date</div></th>                   		
                    <th><div>End Date</div></th>
				</tr>
			</thead>
                    <tbody>
                    	<?php $count = 1;foreach($academy as $row):
                        if($this->session->userdata('start_date')==$row['start_date'])
                        {
                            $css_class="border:red solid";
                        }
                        else
                        {
                            $css_class="";
                        }
                        ?>
                        <tr style="<?php echo $css_class;?>">
                            <td><?php echo $count++;?></td>							
						              	<td><?php echo $row['start_year'];?></td>
							              <td><?php echo $row['end_year'];?></td>
                            <td><?php echo date("F d, Y",strtotime($row['start_date']));?></td>
                            <td><?php echo date("F d, Y",strtotime($row['end_date']));?></td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>  
            
			<!--CREATION FORM ENDS-->
		</div>
        
        	<div class="tab-pane box inactive" id="add2" style="padding: 5px">
                <div class="box-content">
                	<?php //echo form_open(base_url() . 'index.php?admin/addacademic/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <form action="<?php echo base_url() . 'index.php?admin/addacademic/'; ?>" method="post" class="form-horizontal form-groups-bordered validate" id="academic_submit">
                        <div class="padded">
                         <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                         <div class="form-group">
                                <label class="col-sm-3 control-label">Start Date<span class="mandatory">*</span></label> 
                                <div class="row">
	                                <div class="col-sm-5">
	                                <input type="text" placeholder="From Date" name="from_date" id="from_date" class="form-control " data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                    <span style="color:#F00;" id="error_from_date" for="from_date"></span>
	                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">End Date<span class="mandatory">*</span></label> 
                                <div class="row">
	                                 <div class="col-sm-5">
	                                <input type="text" placeholder="To Date" name="to_date" id="to_date" class="form-control " data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />  
                                      <span style="color:#F00;" id="error_to_date" for="to_date"></span>
	                                </div>
                                </div>                                
                            </div>
                          <div class="form-group">
                                <div class="row">
                                <div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-info" id="addacademi">Submit</button>
                                    </div>
                                </div>                          	
						  </div> 
                        	
                          </div>
                    </form>                
                </div>                
			</div>

            <div class="tab-pane box inactive" id="add3" style="padding: 5px">
                <div class="box-content">
                    <form action="<?php echo base_url() . 'index.php?admin/update_academic_year/'; ?>" method="post" class="form-horizontal form-groups-bordered validate" id="academic_submit">
                        <div class="padded">
                         <div class="form-group">
                                <label class="col-sm-2 control-label">Academic Year</label>
                                <div class="col-sm-5">
                                    <select name="set_academic_year" class="form-control" style="width:100%;" data-validate="required">
                                        <option value="">Select year </option>
                                        <?php 
                                        $academic_year = $this->db->get('academic_year')->result_array();
                                        foreach($academic_year as $row):
                                        ?>
                                            <option value="<?php echo $row['academic_id'];?>" <?php if($row['current_year_status']=="active"){echo "selected";} ?>>
                                            <?php echo date("d-M-Y",strtotime($row['start_date'])) ." TO ".date("d-M-Y",strtotime($row['end_date']));?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">
                                <button type="submit" class="btn btn-info" id="addacademi">Set</button>
                            </div>
                          </div> 
                            
                          </div>
                    </form>                
                </div>                
            </div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>

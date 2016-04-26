<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
.has-success .form-control{border-color:#cc2424 !important;}
.phone.validate{color:#cc2424;}
.form-group validate-has-error{border-color:0 !important;}
</style>

<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Fees Listing
                 </a></li>
			<li>
            	<a href="#student" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Add Fees
                </a></li>
                <li>
            	<a href="#fees" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Receipt
                </a></li>
		</ul>
<div class="tab-content">	

<div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Student Name</div></th>
                    		<th><div>Class</div></th>  
                            <th><div>Paid Amount</div></th>                   		
                    		<th><div>Fees Type</div></th>
                            <th><div>Outstanding</div></th>
                            <th><div>Status</div></th>
                            <th><div>Date</div></th>
                            <th><div>Action</div></th>
                            
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($fees as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>							
							<td><?php echo $row['student_name'];?></td>
							<td><?php echo $row['class'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
                            <td><?php echo $row['invoice_type'];?></td>
                            <td><?php echo $row['outstanding'];?></td>
                            <td><?php echo $row['status'];?></td>
                            <td><?php echo date("F d, Y",strtotime( $row['paid_date']));?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/editfees/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?fees/delete/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
<div class="tab-pane box inactive" id="student">
				<?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
                <?php echo form_open(base_url() . 'index.php?fees/addfees/' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>"add_fees", 'enctype' => 'multipart/form-data'));?>
				<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label">Class Name</label>       
							<div class="col-sm-5">
								<select name="class" class="form-control" style="width:100%;" onchange="return getstudent(this.value);" data-validate="required">
									<option value="">Select Class</option>
                                    <?php 
									$this->db->distinct('name_numeric');
									$get_classes = $this->db->get('class')->result_array();
									foreach($get_classes as $get_class):
									 ?>
                                    <option value="<?php echo $get_class['name_numeric']; ?>"><?php echo $get_class['name_numeric']; ?></option>
                                    <?php endforeach; ?>
                                    
									
								</select>
							</div>
                    </div>
    					
					<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label">Student</label>       
							<div class="col-sm-5">
								<select name="student" class="form-control" style="width:100%;"  id="student_id" data-validate="required">
									<option value="">Select Student</option>
                                    
									
								</select>
							</div>
                    </div>
					<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label">Fees Type</label>       
							<div class="col-sm-5">
								<select name="fees_type" class="form-control" style="width:100%;"  id="student_id" data-validate="required">
									<option value="Exam Fees">Exam Fees</option>
                                    <option value="Quarterly Fees">Quarterly Fees</option>
                                    <option value="Annual Fees">Annual Fees</option>
                                    <option value="Sports Academy Fees">Sports Academy Fees</option>
                                    
									
								</select>
							</div>
                    </div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Amount </label>                        
						<div class="col-sm-5">							
							 <input name="amount_paid" type="text" id="amount_paid" data-validate="required" class="form-control" ><span id="roll-availability-status"></span>			 
						</div>
					</div>                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Outstanding</label>                        
						<div class="col-sm-5">							
							 <input name="outstanding" type="text" id="outstanding" onkeypress="return getoutstand(this.value);"  onchange="return getoutstand(this.value);" class="form-control" value="" placeholder="on full payment add '0'" data-validate="required" ><span id="roll-availability-status"></span>			 
						</div> 
					</div>	
                    <div class="form-group">
								<label for="field-2" class="col-sm-3 control-label">Status</label>       
							<div class="col-sm-5">
								<select name="status" class="form-control" style="width:100%;"  id="status" data-validate="required">
                               
                                </select>
							</div>
                    </div>                    
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Date</label>                        
						<div class="col-sm-5">
							<input name="date" type="text" id="date" data-validate="required" class="form-control datepicker"><span id="roll-availability-status"></span>		
						</div>
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Payment Details</label>                        
						<div class="col-sm-5">
							<textarea data-validate="required" style="width:100%" name="payment_details" rows="3"></textarea>
						</div>
					</div>
					<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">							  
                                  <button class="btn btn-info" type="submit">Save</button>                                
                              </div>
						</div>		
                <?php echo form_close();?>
            </div>
            <div class="tab-pane box inactive" id="fees">
				<?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
             
                <form action="<?php  echo base_url().'index.php?fees/reciept'; ?>" method="post" class="form-horizontal form-groups-bordered validate" target="_blank" >
				<div class="form-group">
								<label for="field-2" class="col-sm-2 control-label">Class Name</label>       
							<div class="col-sm-2">
								<select name="class_id" id="class_id" class="form-control" style="width:100%;" onchange="return getstudentss(this.value);" data-validate="required">
									<option value="">Select Class</option>
                                    <?php 
									$this->db->distinct('name_numeric');
									$get_classes = $this->db->get('class')->result_array();
									foreach($get_classes as $get_class):
									 ?>
                                    <option value="<?php echo $get_class['name_numeric']; ?>"><?php echo $get_class['name_numeric']; ?></option>
                                    <?php endforeach; ?>
                                    
									
								</select>
							</div>
                    </div>
    					
					<div class="form-group">
								<label for="field-2" class="col-sm-2 control-label">Student</label>       
							<div class="col-sm-2">
								<select name="student" class="form-control" style="width:100%;"  id="reciept_student" data-validate="required">
									<option value="">Select Student</option>
                                    
									
								</select>
							</div>
                    </div>
					
					<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">							  
                                  <button class="btn btn-info" id="reciept" type="submit">Save</button>                                
                              </div>
						</div>		
              </form>
              
            </div>
            
            </div></div></div>
                             

            <script type="text/javascript">
			

function getstudentss(class_id)
			{
				

				$.ajax({
						type:"POST",
						url:"<?php echo base_url().'index.php?admin/getstudents/'; ?>"+class_id,
						success: function(response){
							
							$("#reciept_student").html(response);
								
							}
						
					});	
					
			}
            function getstudent(class_id)
			{
				

				$.ajax({
						type:"POST",
						url:"<?php echo base_url().'index.php?admin/getstudents/'; ?>"+class_id,
						success: function(response){
							
							$("#student_id").html(response);
								
							}
						
					});	
					
			}
			
			// <option value="Partially Paid">Partially Paid</option>
  //                              <option value="Paid In Full">Paid In Full</option>
			
			function getoutstand()
			{
				var outstanding = $("#outstanding").val();
				//alert(outstanding);
				
				if(outstanding > 0)
				{
					$("#status").html('<option value="Partially Paid">Partially Paid</option>');
				}
				else
				{
					$("#status").html('<option value="Paid In Full">Paid In Full</option>');
				}
			}
            
            </script>                   

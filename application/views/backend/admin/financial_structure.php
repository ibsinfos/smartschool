<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Create Fee Structure
				</a>
			</li>
			<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Fees listing
              	</a>
			</li>			
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
          
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box active" id="add" style="padding: 5px">
            <?php echo form_open(base_url() . 'index.php?admin/financial_structure/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">                          
                            <div class="panel-body">
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="datepicker form-control" name="date"/>
                                    </div>
                                </div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Class</label>
										<div class="col-sm-5">	
											<select name="class_id"style="width:100%;" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_classes(this.value)">
												  <option value="">Select Class</option>
												  <?php 
													$classes = $this->db->get('class')->result_array();
													foreach($classes as $row):
													?>
														<option value="<?php echo $row['class_id'];?>" <?php if($this->session->userdata('p_class') == $row['class_id']){ echo "selected"; } ?>><?php echo $row['name_numeric'];?></option>
													<?php	endforeach;	  ?>
										  </select>	
										</div>
									</div>					
									<div class="form-group">
										<label class="col-sm-3 control-label">Student</label>
										<div class="col-sm-5">
											<select name="student_id" style="width:100%;" class="form-control" data-validate="required" id="student_listing" data-message-required="<?php echo get_phrase('value_required');?>">	
												<option value="">Select Student</option>					
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Type</label>
										<div class="col-sm-5">
											<select name="type" style="width:100%;" class="form-control" data-validate="required" id="student_listing" data-message-required="<?php echo get_phrase('value_required');?>">	
											 <option value="">Select Type</option>
												<?php 
												$p_type = $this->db->get('payment_type')->result_array();
												foreach($p_type as $prow):
													?>
													<option value="<?php echo $prow['p_type_id'];?>" ><?php echo $prow['p_type_name'];?></option>
                                                <?php
												endforeach;
											  ?>
											</select>
										</div>
									</div>									
                                <!-- <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                                    <div class="col-sm-9">
                                        <select name="student_id" class="form-control" style="" >
                                            <?php 
                                            /*$this->db->order_by('class_id','asc');
                                            $students = $this->db->get('student')->result_array();
                                            foreach($students as $row):
                                            ?>
                                                <option value="<?php echo $row['student_id'];?>">
                                                    class <?php echo $this->crud_model->get_class_name($row['class_id']);?> -
                                                    roll <?php echo $row['roll'];?> -
                                                    <?php echo $row['name'];?>
                                                </option>
                                            <?php
                                            endforeach;*/
                                            ?>
                                        </select>
                                    </div>
                                </div>-->

                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount" placeholder="<?php echo get_phrase('enter_total_amount');?>"/>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-3 control-label">Payment Method</label>
                                    <div class="col-sm-5">
                                        <select name="method" class="form-control" onchange="showDiv(this)">
                                            <option value="">Select Payment Method</option>
                                            <option value="1">Paypal</option>
                                            <option value="2">Credit Card</option>                                            
                                        </select>
                                    </div>
                                </div>
								<div id="hidden_div" style="display: none;">
									<!--<p class="form-label">Email Address:</p>
									<input class="text" id="email" spellcheck="false"></input>-->
									<div class="form-group"> 
										<label class="col-sm-3 control-label">Credit Card Number:</label>
										<div class="col-sm-9">
											<input class="form-control" id="card-number" autocomplete="off"></input>
										</div>	
									</div>
									<div class="form-group">		
										<label class="col-sm-3 control-label">Expiration Date:</label>
											<div class="col-sm-3">
												<select id="expiration-month" class="form-control" data-validate="required">
													<option value="1">January</option>
													<option value="2">February</option>
													<option value="3">March</option>
													<option value="4">April</option>
													<option value="5">May</option>
													<option value="6">June</option>
													<option value="7">July</option>
													<option value="8">August</option>
													<option value="9">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
												</select>
											</div>	
											<div class="col-sm-3">
												<select id="expiration-year" class="form-control" data-validate="required">
													<?php 
														$yearRange = 20;
														$thisYear = date('Y');
														$startYear = ($thisYear + $yearRange);
													 
														foreach (range($thisYear, $startYear) as $year) 
														{
															if ( $year == $thisYear) {
																print '<option value="'.$year.'" selected="selected">' . $year . '</option>';
															} else {
																print '<option value="'.$year.'">' . $year . '</option>';
															}
														}
													?>
												</select>
											</div>	
									</div>
									<div class="form-group"> 
										<label class="col-sm-3 control-label">CVC:</label>
										<div class="col-sm-9">
											<input class="text" class="form-control"  name="card-security-code" id="card-security-code" autocomplete="off"></input>
										</div>	
									</div>		
								</div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <!-- <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo get_phrase('payment_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                               

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo get_phrase('enter_payment_amount');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="paid"><?php echo get_phrase('paid');?></option>
                                            <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control">
                                            <option value="1"><?php echo get_phrase('cash');?></option>
                                            <option value="2"><?php echo get_phrase('check');?></option>
                                            <option value="3"><?php echo get_phrase('card');?></option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>                       
                    </div>-->
					 <div class="form-group">
                            <div class="center-block" style="max-width:400px">
                                <button type="submit" class="btn btn-info">Save</button>
								<button type="reset" id="cancel" name="cancel" class="btn btn-danger">Cancel</button>
                            </div>
                    </div>



                </div>
            <?php echo form_close();?>
			</div>
			<!----CREATION FORM ENDS-->
              <!----TABLE LISTING STARTS-->
            <div class="tab-pane box" id="list">
				
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
							<th><div><?php echo get_phrase('Date');?></div></th>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('Type');?></div></th>
                            <th><div><?php echo get_phrase('total');?></div></th>                          
                            <!--<th><div><?php echo get_phrase('paid');?></div></th>-->
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('MOP');?></div></th>
							<th><div><?php echo get_phrase('Description');?></div></th>                    		
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):
						//echo "<pre/>";
						print_r($row);
						//die;
						?>
                        <tr>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
							<!--<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span>
							</td>-->	
							<td><?php echo $row['payment_method'];?></td>		
							<td><?php echo $row['description'];?></td>							
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <?php if ($row['due'] != 0):?>

                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-bookmarks"></i>
                                                <?php echo get_phrase('take_payment');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <?php endif;?>
                                    
                                    <!-- VIEWING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-credit-card"></i>
                                                <?php echo get_phrase('view_invoice');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
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

            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>
<script type="text/javascript">
function get_classes(class_id) {   
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_classes/' + class_id ,
				success: function(response)
				{
					jQuery('#student_listing').html(response);
				}
			});
   }
</script>
<script type="text/javascript">
function showDiv(elem){
   if(elem.value == 1){
      document.getElementById('hidden_div').style.display = "none";
   }else if(elem.value == 2){
	   document.getElementById('hidden_div').style.display = "block";
   }else{
	  document.getElementById('hidden_div').style.display = "none"; 
   }
}
</script>
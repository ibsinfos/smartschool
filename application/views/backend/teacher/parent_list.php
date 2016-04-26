<div class="row" id="ind_student" >
					<div class="col-md-12">	
						<div class="tabs-vertical-env">
							<div class="tab-content">
								<?php echo form_open(base_url() . 'index.php?teacher/parent_list' , array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                              
									 <div class="form-group">
                    <label class="col-sm-1 control-label">Class</label>
                    <div class="col-sm-2">
                      <select name="class_id" id="class_ids" class="form-control" style="width:100%;" onchange="return getstudent(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        <option value="">Select Class</option>
            <?php 
										
										
										$teacher_id = $this->session->userdata('teacher_id');
										$this->db->where('teacher_id',$teacher_id);
										$this->db->group_by('class_id');
										$student_classes = $this->db->get('teacher_class_association')->result_array();
										foreach($student_classes as $row):
										?>
            <option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
            <?php
										endforeach;
										?>
          </select>
        </div>
      </div>
      
      
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info" id="getstudent_info">Submit</button>
										</div>
									</div> 
								</form>	
							</div>		
						</div>
					</div>
				</div>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    
                        <tr><td colspan="7" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="7" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Parent Listing</td></tr>
                            <tr bgcolor="#000000"><td colspan="7" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php echo ucwords('Class Name : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$class_id.'</span>'); ?></td></tr>                       
                		
                        <tr bgcolor="#2092D0">
                    		<th  style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" >Student name</th>
                            <th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" >Class Name</th>
                            <th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Father name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">Mother name</th>  
                    		 
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Parent Email</th>  
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Phone</th>  
                            
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						
						
						//$exam = $this->db->get_where('parent',array('parent.class_id'=>$class_id))->result_array();
						$parents =   $this->db->get_where('parent',array('parent.class_id'=>$class_id))->result_array();
						
						
						$count = 1;
						
						foreach($parents as $row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo @$this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
                             <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php
							echo $row['class_id']; ?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php
							echo $row['name']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['mother_name'];?></td>
							
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['parent_email'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['phone'];?></td>
							
                        </tr>
                         <?php endforeach;?>
						
                              
                                
                    </tbody>
					
                </table>
                 <?php echo form_open(base_url() . 'index.php?teacher/parent_list_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										<input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
									</div>	
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>




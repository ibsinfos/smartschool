<div class="row" id="exam_mark">
					<div class="col-md-12">		
					<form action="" method="post">
					<div class="form-group">
					<select name="exam_mark_list" style="width:30%;" class="form-control" id="teacher_list">
                         <option value="">Select</option>

          			<option value="subject_wise">Subject Wise</option>
         			 <option value="class_wise">Class Wise</option>
        			  <option value="standard_wise">Standard Wise</option>
                      <option value="all_report">All Teacher</option>
                   </select>
					</div>
                    </form>	
					</div>
				</div>
                
                <div id="main_exam_mark"> 
                
                 <div id="class_wise_sub_1" style="display:none;"> 
                 	<?php echo form_open(base_url() . 'index.php?teacher/teacher_lists/class_wise' , array('class' => 'form-horizontal validate'));?>
                   
                    
                    	<div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select name="class_id" id="class_id" class="form-control" style="width:100%;" onchange="return get_exam(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Class</option>
                                    	<?php 
										$this->db->distinct();
										$this->db->select('class_id');
										$this->db->order_by('class_id','asc');
										$classes = $this->db->get('subject')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info" >Submit</button>
                             </div>
                             </div>   
                    </form>
                 </div>
                 
                 <div id="subject_wise_sub_1" style="display:none;" >
                    
                 <?php  echo form_open(base_url() . 'index.php?teacher/teacher_lists/subject' , array('class' => 'form-horizontal validate'));?>
                    	<div class="form-group">
                                <label class="col-sm-1 control-label">Subject</label>
                                <div class="col-sm-2">
                                <?php 
										$this->db->distinct();
										$this->db->select('name');
										$subjects = $this->db->get('subject')->result_array();
										
										
										?>
                                    <select name="subject_name" id="subject_id" class="form-control" style="width:100%;"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Subject</option>
                                    	<?php foreach($subjects as $row): ?>
                                    		<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Submit</button>
                             </div>
                             </div>   
                    </form>
                 </div>
                 <div id="standard_wise_sub_1" style="display:none;">
                  
                 <?php echo form_open(base_url() . 'index.php?teacher/teacher_lists/standard_wise/' , array('class' => 'form-horizontal validate'));?>
                    	<div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select name="standard_id" id="class_idt3" class="form-control" style="width:100%;" onchange="return get_student_name_exam(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Standard</option>
                                    	<?php 
										$this->db->distinct();
										$this->db->select('std');
										$student_classes = $this->db->get('class')->result_array();
										foreach($student_classes as $row):
										?>
                                    		<option value="<?php echo $row['std'];?>"><?php echo $row['std'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Submit</button>
                             </div>
                             </div>   
                    </form>
                 </div>
                 <div id="all_reports" style="display:none;">
                  
                 <?php echo form_open(base_url() . 'index.php?teacher/teacher_lists/all_teacher' , array('class' => 'form-horizontal validate'));?>
                    	
                            <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Submit</button>
                             </div>
                             </div>   
                    </form>
                 </div>
                </div>

            
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:12px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   
                        <tr>
                        <td colspan="4" style="height:15px;"></td>
                        </tr>
                        <tr bgcolor="#000000">
                        <td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">All Teacher List</td></tr>
                		
                        <tr bgcolor="#2092D0">
                        <th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Full Name</th>	
                       <th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Designation</th>  	
                       <th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Phone</th> 
                       <th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Email</th> 
                    		
						</tr>
                       
					</thead>
                    <tbody>
                    	<?php 
						
					
						
						
						$non_tech = $this->db->get_where('teacher', array('teaching_type' => '1'))->result_array();
					
						$count = 1;
						
					
						foreach($non_tech as $rowtech):	
					
						?>
                        <tr>
                          
							<td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"><?php echo $rowtech['name'];?></td>
							<td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rowtech['designation'];?></td>
							<td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rowtech['phone'];?></td>
                            <td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rowtech['email'];?></td>
                            
                        </tr>
                        
                         <?php endforeach;?>
                      
						
                    </tbody>
                    	
                </table>
               <?php  if(count($non_tech) > 0){ ?>
                 <tr><td >  <?php echo form_open(base_url() . 'index.php?teacher/all_teacher_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form></td></tr>	
                <?php } ?>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



<script type="text/javascript">


$(document).ready(function() {
	    $("#teacher_list").change(function () {
					 if($("#teacher_list").val()=="class_wise"){
						 
						  $("#class_wise_sub_1").show();
						  $("#subject_wise_sub_1").hide();
						  $("#standard_wise_sub_1").hide();
						  $("#all_reports").hide();
						 
						  
					}
					else if($("#teacher_list").val()=="subject_wise"){
						  $("#subject_wise_sub_1").show();
						  $("#class_wise_sub_1").hide();
						    $("#standard_wise_sub_1").hide();
							 $("#all_reports").hide();
						
						 
					}
					else if($("#teacher_list").val()=="standard_wise"){
						  $("#standard_wise_sub_1").show();
							 $("#class_wise_sub_1").hide();
						   $("#subject_wise_sub_1").hide();
						    $("#all_reports").hide();
						 
						  
					}else if($("#teacher_list").val()=="all_report"){
						 $("#all_reports").show();
							$("#standard_wise_sub_1").hide();
						  $("#class_wise_sub_1").hide();
						   $("#subject_wise_sub_1").hide();
						   
						 
					}
				});
        
	
	
				
				
    
        
	          
      
function get_exam(class_id) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_exam/' + class_id,
            success: function(response)
            {
				jQuery('#exam_listing').html(response);
	        }
       });
   }
function get_student_name_exam(class_id) {
	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_exam_list_mark/' + class_id,
            success: function(response)
            {
				jQuery('.exam_listing_mark').html(response);
	        }
       });
   	   $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_student_list_markid/' + class_id,
            success: function(response)
            {
				jQuery('#student_listing').html(response);
            }
       });
} 
});

</script>

<script type="text/javascript">
$('.datepicker').datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});;
</script>

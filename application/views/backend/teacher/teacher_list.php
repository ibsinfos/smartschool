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



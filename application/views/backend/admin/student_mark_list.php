
<style>
.modal-dialog{   width:50%; }
</style> <div class="row" id="exam_mark">
					<div class="col-md-12">		
					<form action="" method="post">
					<div class="form-group">
					<select name="exam_mark_list" style="width:30%;" class="form-control" id="newexamlist">
                        <option value="">Select </option>
                       
                        <option value="student_mark">Student Marks</option>
                        <option value="class_wise_top3_student">Top 3 students</option>
                        <option value="subject_wise_top3_student">Subject wise toppers</option>
                   </select>
					</div>
                    </form>	
					</div>
				</div>
                
                <div id="main_exam_mark"> 
                 
                 
                 <div id="exam_mark_sub_2" style="display:none;" >
                    <form action="" method="post" id="student_mark_list" class="form-horizontal validate">
                 <?php // echo form_open(base_url() . 'index.php?admin/exam_mark/student_mark' , array('class' => 'form-horizontal validate'));?>
                    	<div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-3">
                                    <select name="class_id" id="class_ids" class="form-control" style="width:100%;" onchange="return get_student_name_exam(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Class</option>
                                    	<?php 
										$this->db->distinct();
										$this->db->select('class_id');
										$student_classes = $this->db->get('student')->result_array();
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
                                <label class="col-sm-1 control-label">Exam</label>
                                <div class="col-sm-3">
                                    <select name="exam_id" id="exam_listing_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" class="form-control exam_listing_mark" style="width:100%;">
                                        <option value="">Select exam</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Student</label>
                                <div class="col-sm-3">
                                    <select name="student_id" id="student_listing" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" class="form-control" style="width:100%;">
                                        <option value="">Select Student</option>
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
                 <div id="exam_mark_sub_3" style="display:none;">
                  <form action="" method="post" id="class_wise_top3_student" class="form-horizontal validate">
                 <?php //echo form_open(base_url() . 'index.php?admin/exam_mark/class_wise_top3_student' , array('class' => 'form-horizontal validate'));?>
                    	<div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-3">
                                    <select name="class_id" id="class_idt3" class="form-control" style="width:100%;" onchange="return get_student_name_exam(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Class</option>
                                    	<?php 
										$this->db->distinct();
										$this->db->select('class_id');
										$student_classes = $this->db->get('student')->result_array();
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
                                <label class="col-sm-1 control-label">Exam</label>
                                <div class="col-sm-3">
                                    <select name="exam_id" id="exam_listing_markt3" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" class="form-control exam_listing_mark" style="width:100%;">
                                        <option value="">Select exam</option>
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
                 <div id="exam_mark_sub_4" style="display:none;">
                   <form action="" method="post" id="subject_wise_top3_student" class="form-horizontal validate">
                 <?php //echo form_open(base_url() . 'index.php?admin/exam_mark/subject_wise_top3_student' , array('class' => 'form-horizontal validate'));?>
                    	
                        <div class="form-group">
                                <label class="col-sm-1 control-label">Standard</label>
                                <div class="col-sm-3">
                                    <select name="standard" id="standard" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" class="form-control" style="width:100%;">
                                        <option value="">Select Standard</option>
                                        <?php for($h=1;$h<=12;$h++){ ?>
                                        <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
                                       <?php }?>
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
                </div>
                
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            
          <?php  			$res = $this->db->get_where("student",array("student_id"=>$student_id))->result_array();

		  			if(!empty($res))
					{
						$student_name = $res[0]['name'];
						}
						else{
							$student_name = '';
							}
		   ?>
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    
                        <tr><td colspan="4" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;"><?php echo ucwords("student mark sheet"); ?></td></tr>
                		 <tr bgcolor="#000000">
                            <td colspan="4" style="font-size:1.0em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">
                            <?php 
							$subject = $this->db->get_where("student",array("student_id"=>$student_id))->row();
						
							echo ucwords("Class Name : <span style='text-align:right;color:#2092D0;font-size:1.2em;font-weight:600;'>".$class_id."</span> Exam : <span style='text-align:right;color:#2092D0;font-size:1.2em;font-weight:600;'>".$exam_id."</span> Student Name : <span style='text-align:right;color:#2092D0;font-size:1.2em;font-weight:600;'>".$subject->name."</span>"); ?>
                            </td>
                        </tr>
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" width="20%">Subject</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" width="40%">Marks</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" width="40%">Out Of Marks</th>
                    	</tr>
					</thead>
                    <tbody>
                    	<?php 
						//$this->db->select('subject.name as subject_name,exam.name as exam_name,exam.class_id,exam.subject_id,exam.date,exam.time_start,exam.time_end');
						
				//	$mark = $this->db->get_where('mark',array('class_id'=>$class_id,'exam_id'=>$exam_id,'student_id'=>$student_id))->result_array();
						$mark = $this->db->query("SELECT DISTINCT(mark.subject_name),mark.mark_obtained,exam.out_of_marks FROM mark JOIN exam ON mark.subject_name=exam.subject_id WHERE mark.class_id='".$class_id."' AND mark.exam_id='".$exam_id."' AND student_id='".$student_id."' AND mark.subject_name=exam.subject_id")->result_array();
					
				//	echo $this->db->last_query();
					
						foreach($mark as $row_mark):
						$subject = $this->db->get_where("subject",array("subject_id"=>$row_mark['subject_name']))->row();
						
							?>
                        <tr>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $subject->name;?></td>
							<td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%" ><?php echo $row_mark['mark_obtained'];?></td>
							<td align="center" style="font-size:11px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%"><?php echo $row_mark['out_of_marks'];?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    
                    
                    	
                </table>
                
			</div>
             <?php
			 if($mark > 0){
			  echo form_open(base_url() . 'index.php?admin/exam_mark_pdf/student_mark' , array('class' => 'form-horizontal validate'));?>
              <input type="hidden" name="class_id" value="<?php echo $class_id;  ?>" />
              <input type="hidden" name="exam_id" value="<?php echo $exam_id;  ?>" />
              <input type="hidden" name="student_id" value="<?php echo $student_id;  ?>" />
                <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Export To Pdf</button>
                             </div>
                             </div>   
                    </form>
                    
                    <?php } ?>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


<script type="text/javascript">


$(document).ready(function() {
	$("#class_wise_exam").submit(function(){
					var data = $("#class_wise_exam").serialize();	
					var class_id = $("#class_id").val();
					var exam_listing = $("#exam_listing").val();
					
					
					if(class_id=="" || exam_listing=="")		
					{
						return false;	
					}
					 showAjaxModal('<?php echo base_url();?>index.php?modal/exam/class_wise_exam_list/',data);
					 return false;
				});
				
					$("#student_mark_list").submit(function(){
					var data = $("#student_mark_list").serialize();	
					
					var class_ids = $("#class_ids").val();
					//alert(class_id);
					
					var exam_listing_mark = $("#exam_listing_mark").val();
					var student_listing = $("#student_listing").val();
					if(class_ids=="" || exam_listing_mark=="" || student_listing=="")		
					{
						return false;	
					}		
					 showAjaxModal('<?php echo base_url();?>index.php?modal/exam/student_mark_list/',data);
					 return false;
				});	
				$("#class_wise_top3_student").submit(function(){
					
					var class_idt3 = $("#class_idt3").val();
					var exam_listing_markt3 = $("#exam_listing_markt3").val();
					var data = $("#class_wise_top3_student").serialize();
					if(class_idt3=="" || exam_listing_markt3=="")		
					{
						return false;	
					}			
					 showAjaxModal('<?php echo base_url();?>index.php?modal/exam/class_wise_top3_student_list/',data);
					 return false;
				});	
				$("#subject_wise_top3_student").submit(function(){
					var data = $("#subject_wise_top3_student").serialize();	
					var subject = $("#subject").val();
					var standard = $("#standard").val();
					
					if(subject=="" || standard=="")		
					{
						return false;	
					}		
					 showAjaxModal('<?php echo base_url();?>index.php?modal/exam/subject_wise_top3_student_list/',data);
					 return false;
				});
				
    
            $("#newexamlist").change(function () {
					 if($("#newexamlist").val()=="class_wise_exam"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").show();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						 
					}
					else if($("#newexamlist").val()=="student_mark"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").show();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();	
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  
					}
					else if($("#newexamlist").val()=="class_wise_top3_student"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").show();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						 
					}else if($("#newexamlist").val()=="subject_wise_top3_student"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").show();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						 
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




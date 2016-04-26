
<div class="row" id="attendance">
					<div class="col-md-12">		
						<form action="" method="post">
							<div class="form-group">
					<select name="report_list" style="width:30%;" class="form-control" id="attendance_list" >
                        <option value="">Select Attendance</option>
                        <option value="class_wise_attendance">Class Wise</option>
                        <option value="self_attendance">Self Attendance</option>
                     
                     
					</select>
							</div>
                          </form>	
					</div>
				</div>
                
                
                
                <div id="main_attendance" > 
                          
                          <div id="attendance_sub_1" style="display:none;" > 
                        
                          <?php echo form_open(base_url() . 'index.php?teacher/attendance/class_wise_attendance' , array('class' => 'form-horizontal validate'));?>	
                          
                          <div class="form-group"> 
                          <select name="class_id" style="width:30%;" class="form-control" 
                           data-validate="required" id="class_ids" onchange="return get_student_name_exam(this.value)"  data-message-required="<?php echo get_phrase('value_required');?>" style="display: none">
                          <option value="">Select Class</option>
                           <?php 
						   
						    
						  $teacher_id = $this->session->userdata('teacher_id');
						  $this->db->distinct('class_id'); 
						  $this->db->select('class_id'); 
						  ?>
                           <?php $attandance_class=$this->db->get_where('teacher_class_association',array('teacher_id'=>$teacher_id))->result_array();
						//   $attandance_class=$this->db->get('class')->result_array(); 
						foreach($attandance_class as $attandance_class_row): ?>
                           <option value="<?php echo $attandance_class_row['class_id']; ?>"><?php echo $attandance_class_row['class_id']; ?> </option>
                           <?php endforeach;  ?>				
					</select>
                          </div>
                           <div class="form-group">
                                <select name="student_id" style="width:30%;" class="form-control" 
                           data-validate="required" id="student_listing"  data-message-required="<?php echo get_phrase('value_required');?>" style="display: none">
                          <option value="">Select Student</option>
                          
							</select>
                         
						  </div> 
                          <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Submit</button>
                             </div>
                             </div>   
                          </form>
                           </div>
                           <div id="self_attendance_sub1" style="display:none;" > 
                        
                          <?php echo form_open(base_url() . 'index.php?teacher/attendance/self_attendance' , array('class' => 'form-horizontal validate'));?>	
                          
                          
                          
                          <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Submit</button>
                             </div>
                             </div>   
                          </form>
                          
                          </div>
                          <?php if(!empty($class_id)) { ?>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   
                        <tr><td colspan="11" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="11" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Student Absent Listing</td></tr>
                        <?php $students = $this->db->get_where('student',array('student_id'=>$student_id))->row(); ?>
                         <tr bgcolor="#000000"><td colspan="5" style="font-size:1.0em; border-top:1px solid #EEE; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php echo ucwords('Class Name : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$class_id.'</span> Student Name : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$students->name.'</span>'); ?></td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center;   text-align:center;">Roll no</th>
                    		<th style="color:#FFF;border-right:1px solid #EEE; text-align:center;   text-align:center;">Student Name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center;text-align:center;">Absent Date</th>  
                             <th style="color:#FFF;  border-right:1px solid #EEE; text-align:center;" >Reason for Absence</th> 							
                            <th style="color:#FFF; border-right:1px solid #EEE;text-align:center;"   >Type of Leave</th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$this->db->join('student', 'student.student_id = attendance.student_id');
						$this->db->where('attendance.attandence_class', $class_id);
						$this->db->where('attendance.student_id',$student_id);
						$this->db->where('attendance.status',2);
						$attendance = $this->db->get('attendance')->result_array();
						
						$count = 1;
						
						foreach($attendance as $row_attendance):
						
						?>
                        <tr>
                            <td valign="middle" align="center"  style="font-size:13px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $row_attendance['roll'];?></td>							
							<td valign="middle" align="center" style="font-size:13px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $row_attendance['name'].' '.$row_attendance['father_name'] ;?></td>
							<td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo date("F d, Y",strtotime($row_attendance['date']));?></td>
                             <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_attendance['description'];?></td>							
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_attendance['leave_type'];?></td>							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
					
                </table>
                <?php if($attendance > 0){ ?>
                <?php echo form_open(base_url() . 'index.php?teacher/student_attendance_pdf' , array('class' => 'form-horizontal validate'));?>
                  <div class="form-group">
                  <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
                  
				  <div class="col-md-12 text-center">
				  <button type="submit" class="btn btn-info">Export To Pdf</button>
				  </div>
						  </div> 
                          </form>
                <?php } ?>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>

<?php  } ?>
                 <script type="text/javascript">
     $(document).ready(function() {
        
   
		
		
		$("#class_ids").change(function(){
	var class_id = $("#class_ids").val();
	
   	   $.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_student_list_markid/' + class_id,
            success: function(response)
            {
				jQuery('#student_listing').html(response);
            }
       });
});
	 });
		
		
	 $(function () {
            $("#attendance_list").change(function () {
					 if($("#attendance_list").val()=="class_wise_attendance"){
						  $("#attendance_sub_1").show();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").show();
						  $("#self_attendance_sub1").hide();
						  
					}
					else if($("#attendance_list").val()=="self_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#self_attendance_sub1").show();
						  
					}
					else if($("#attendance_list").val()=="all_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").show();
						  $("#attendance").show();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
				});
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
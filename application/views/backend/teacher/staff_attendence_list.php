

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
                           <?php $attandance_class=$this->db->get_where('teacher_class_association',array('teacher_id'=>$teacher_id))->result_array();?>
                           <?php //$attandance_class=$this->db->get('class')->result_array();
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

<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                  
                        <tr><td colspan="4" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Staff Attendance Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE;   text-align:center;" >No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;   text-align:center;" >Absent Date</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center;" >Staff</th> 				
                            <th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;">Reason for Absence</th> 							
                            <th style="color:#FFF; border-right:1px solid #EEE;text-align:center;" >Type of Leave</th> 
						</tr>
					</thead>
                    <tbody>
                    	<?php 
					$teacher_id =	$this->session->userdata('teacher_id');
						$array = array("attendance.status"=>2,"attendance.teacher_id"=>$teacher_id);
						$this->db->select('*');
						$this->db->from('attendance');
						$this->db->join('teacher', 'teacher.teacher_id = attendance.teacher_id');
						$this->db->where($array);
						$this->db->order_by('date','asc');
						$query = $this->db->get();
						$attendance =$query->result();
						$count = 1;
						
						foreach($attendance as $att_row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $count++;?></td>
							<td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  ><?php echo date("F d, Y",strtotime($att_row->date));?></td>
							<td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $att_row->name;?></td>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $att_row->description;?></td>
                               <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $att_row->leave_type;?></td>
                        </tr>
                       <?php 						
						endforeach;  
						
						?>	
						
                    </tbody>
                    
                    	
                </table>
                <?php 
				if(count($attendance) > 0){
				
				echo form_open(base_url() . 'index.php?teacher/staff_attendence_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									
									<div class="form-group">
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
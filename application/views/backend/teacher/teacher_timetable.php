
     
                <div id="main_timetable"> 
                          
                          <div id="timetable_sub_1" > 
                          <?php echo form_open(base_url() . 'index.php?teacher/timetables/class_wise_timetable' , array('class' => 'form-horizontal validate'));?>	
                          
                          	<div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select name="class_id" id="class_id" class="form-control"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"   style="width:100%;">
                                        <option value="">Select Class</option>
                                    	<?php 
										$this->db->distinct();
										$this->db->select('class_id');
										$classes = $this->db->get('time_table')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                                </div>
                                <div id="getmonth" style="display:none;">
                                <div class="form-group">
                                <label class="col-sm-1 control-label">Month</label>
                                <div class="col-sm-2">
                                 <select name="month" id="month" onchange="return weekCount(this.value);"  class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                 <option value="">Select Month</option>
                        		 <option value="1">January </option>
                                 <option value="2">February </option>
                                 <option value="3">March</option>
                                 <option value="4">April</option>
                                 <option value="5">May </option>
                                 <option value="6">June</option>
                                 <option value="7">July </option>
                                 <option value="8">August </option>
                                 <option value="9">Septmber </option>
                                 <option value="10">October </option>	
                                 <option value="11">November</option>	
                                 <option value="12">December </option>	
                                 
                        		 </select>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-1 control-label">Week</label>
                                <div class="col-sm-2">
                                 <select name="week" id="week" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                     <option value="">Select Week</option>
                                     
                                    
                                 </select>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-2">
                                <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                                </div>
                                </div>
                      	  </form>
                           </div>
                           
                          
                 </div>         
			<!-- End Time Table report -->
<?php if(isset($class_id)){ ?>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                        <tr><td colspan="5" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Class Wise Time Table</td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;">  <?php
						
$monthName = date("F", mktime(0, 0, 0, $month, 10));
//echo $monthName; //output: May
// 

	 echo ucwords('Class Name : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$class_id.'</span> Month : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$monthName.'</span>
	  Week : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$week.'</span>'); ?></td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF;   text-align:center;">Date</th>
                    		<th style="color:#FFF;   text-align:center;">Day</th>
                    		<th style="color:#FFF;   text-align:center;">Subject</th>  
                            <th style="color:#FFF;   text-align:center;">Class</th> 
                            <th style="color:#FFF;   text-align:center;">Time</th>   
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$teacher_id = $this->session->userdata("teacher_id");
						$this->db->select('date,day,month,week,subject.name as subject_name,teacher.name as teacher_name,time_start,time_end,time_table.subject_id,time_table.teacher_id,time_table.class_id');
						$this->db->join('subject', 'subject.subject_id = time_table.subject_id');
						
						$this->db->join('teacher', 'teacher.teacher_id = time_table.teacher_id');
						$this->db->where('time_table.class_id', $class_id);
						$this->db->where('time_table.month', $month);
						$this->db->where('time_table.week', $week);
						$this->db->where('teacher.teacher_id', $teacher_id);
						$timetable = $this->db->get('time_table')->result_array();
					//	echo $this->db->last_query(); die;
						
						$count = 1;
						foreach($timetable as $row_timetable):
						
						?>
                        <tr>
                            <td valign="middle" align="center"  style="font-size:13px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_timetable['date'];?></td>							
							<td valign="middle" align="center" style="font-size:13px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"><?php echo $row_timetable['day'];?></td>
							<td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_timetable['subject_name'];?></td>			
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_timetable['class_id'];?></td>			
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_timetable['time_start'].'  TO  '.$row_timetable['time_end'];?></td>							
                        </tr>
                        <?php endforeach;?>
                       
                    </tbody>
					<tr>
                       
                </table>
              
			</div>
              <?php if($timetable > 0){ ?>
                <?php echo form_open(base_url() . 'index.php?teacher/class_wise_timetable_pdf' , array('class' => 'form-horizontal validate'));?>	
                <div class="form-group">
                <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                <input type="hidden" name="month" value="<?php echo $month; ?>" />
                <input type="hidden" name="week" value="<?php echo $week; ?>" />
                                <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info">Export To Pdf</button>
                                </div>
                                </div>
                          </form>
                <?php } ?>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
function weekCount(month_number) 
	 {
		$('#week').find('option:not(:first)').remove();
		   $.ajax({
			type:"POST",
					url: '<?php echo base_url();?>index.php?admin/getweeks/',
		   data:'month='+month_number,
		   success: function(response)
					{
		  //  alert(response);
			//var week =  response;
			for(var i=1; i<=response;i++)
			 {
			 
			 $("#week").append('<option value='+i+'>'+i+'</option>');
			  
			 }
				 }
			   });
	}
	 function weekCount2(month_number) 
	 {
		$('#weekt').find('option:not(:first)').remove();
		   $.ajax({
			type:"POST",
					url: '<?php echo base_url();?>index.php?admin/getweeks/',
		   data:'month='+month_number,
		   success: function(response)
					{
		  //  alert(response);
			//var week =  response;
			for(var i=1; i<=response;i++)
			 {
			 
			 $("#weekt").append('<option value='+i+'>'+i+'</option>');
			  
			 }
				 }
			   });
	}
	$(document).ready(function(e) {
                  $("#class_id").change(function(){
     $("#getmonth").show();
    });
					
            $("#newtimetable").change(function () {
				//alert('dsd');
					 if($("#newtimetable").val()=="class_wise_timetable"){
						  $("#timetable").show();
					      $("#timetable_sub_1").show();
					      $("#timetable_sub_2").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						 
					}else if($("#newtimetable").val()=="teacher_wise_timetable"){
						  $("#timetable").show();
					      $("#timetable_sub_2").show();	
						  $("#timetable_sub_1").hide();
					      $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						 
					}
					
				});
        
                });

     $(function () {
		 
		 		 $("#class_wise_timetable").submit(function(){
			 
					var data = $("#class_wise_timetable").serialize();			
					var class_id = $("#class_id").val();
					var month  = $("#month").val();
					var week = $("#week").val();
					
					if(class_id=="" || month=="" || week=="")
					{
						return false;	
					}
					
					
					 showAjaxModal('<?php echo base_url();?>index.php?modal/timetable/timetable_class_wise_list/',data);
					 return false;
				});
				
			
				
				$("#teacher_wise_timetable").submit(function(){
					
					var data = $("#teacher_wise_timetable").serialize();				
					var teacher_id = $("#teacher_id").val();
					var weekt = $("#weekt").val();
					var montht = $("#montht").val();
					if(teacher_id=="" || weekt=="" || montht=="")
					{
						return false;
					}
			 		showAjaxModal('<?php echo base_url();?>index.php?modal/timetable/timetable_teacher_wise_list/',data);
					 return false;
				});  
				
				
				
			$("#report_list").change(function () {
				
				
				



				//window.location.href = "<?php //echo (base_url() . 'index.php?admin/reportnew/'+repost_list); ?>";
                if ($(this).val() == "non_teaching") {
                    $("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").show();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#attendance_sub_3").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#attendance").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();					
                } else if ($(this).val() == "holiday_list") {
                    $("#holiday").show();
					$("#ind_student").hide();
					$("#notification").hide();
					$("#non_teaching").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#group_list").hide();
					$("#attendance").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#attendance_sub_3").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "notification_list") {
                    $("#notification").show();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#fees_listing").hide();
					 $("#non_teaching").hide();
					 $("#study_materials").hide();
					 $("#staff_attendence").hide();
					 $("#group_list").hide();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "group_list") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#study_materials").hide();
					 $("#staff_attendence").hide();
					 $("#group_list").show();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "fees_listing") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();
					 $("#staff_attendence").hide();
					 $("#study_materials").hide();
					 $("#fees_listing").show();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "study_materials") {
                     $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();	
					 $("#staff_attendence").hide();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();					 
					 $("#study_materials").show();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "staff_attendence") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();	
					 $("#staff_attendence").show();					 
					 $("#study_materials").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "ind_student") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").show();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();	
					 $("#staff_attendence").hide();					 
					 $("#study_materials").hide();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "attendance") {
					$("#attendance").show();
					$("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
		
				}else if ($(this).val() == "timetable") {
					$("#timetable").show();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#attendance").hide();
					$("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
			    }else if ($(this).val() == "exam_mark") {
					$("#exam_mark").show();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#attendance").hide();
					$("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					}		
				else{
					  $("#notification").hide();
					  $("#holiday").hide();
					  $("#ind_student").hide();
					  $("#non_teaching").hide();
					  $("#group_list").hide();
					  $("#fees_listing").hide();
					  $("#staff_attendence").hide();
					  $("#study_materials").hide();
					  $("#attendance").hide();
					  $("#attendance_sub_1").hide();
					  $("#attendance_sub_2").hide();
					  $("#attendance_sub_3").hide();
					  $("#timetable").hide();
					  $("#timetable_sub_1").hide();
					  $("#timetable_sub_2").hide();
					  $("#exam_mark").hide();
					  $("#exam_mark_sub_1").hide();
					  $("#exam_mark_sub_2").hide();
					  $("#exam_mark_sub_3").hide();
					  $("#exam_mark_sub_4").hide();
					  $("#exam_mark_sub_5").hide();
					  
				}
            });
        });
		
		
	 $(function () {
            $("#attendance_list").change(function () {
					 if($("#attendance_list").val()=="class_wise_attendance"){
						  $("#attendance_sub_1").show();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
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
					else if($("#attendance_list").val()=="standard_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").show();
						  $("#attendance_sub_3").hide();
						  $("#attendance").show();
						  $("#notification").hide();
						  
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#attendance_list").val()=="all_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").show();
						  $("#attendance").show();
						
					}
				});
        });
		
		 $(function () {
            $("#timetable_list").change(function () {
					 if($("#timetable_list").val()=="class_wise_timetable"){
						  $("#timetable").show();
					      $("#timetable_sub_1").show();
					      $("#timetable_sub_2").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  
					}else if($("#timetable_list").val()=="teacher_wise_timetable"){
						  $("#timetable").show();
					      $("#timetable_sub_2").show();	
						  $("#timetable_sub_1").hide();
					      $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						 
					}
					
				});
        });
		
		 $(function () {
            $("#exam_mark_list").change(function () {
					 if($("#exam_mark_list").val()=="class_wise_exam"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").show();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
					
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#exam_mark_list").val()=="student_mark"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").show();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();	
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
					
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#exam_mark_list").val()=="class_wise_top3_student"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").show();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
					
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}else if($("#exam_mark_list").val()=="subject_wise_top3_student"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").show();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
				
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
				});
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
            url: '<?php echo base_url();?>index.php?admin/get_student_list_mark/' + class_id,
            success: function(response)
            {
				jQuery('#student_listing').html(response);
            }
       });
}
    </script>
<script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
						<?php 
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							/*start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>)*/ 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>

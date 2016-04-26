
<div id="main_exam_mark">
	
	<div id="exam_mark_sub_2">
		<form action="<?php echo base_url() . 'index.php?student/exam_mark/student_mark'; ?>" method="post" id="student_mark_list" class="form-horizontal validate">
			
			<?php							
				$this->db->group_by('name');
				$this->db->where('class_id',intval($this->session->userdata('class_name')));
				$q=$this->db->get('exam');
				$exam=$q->result();
			?>
			<div class="form-group">
				<label class="col-sm-1 control-label">Exam</label>
				<div class="col-sm-2">
					<select name="exam_id" id="exam_listing" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" class="form-control" style="width:100%;">
						<option value="">Select exam</option>
						<?php
							
							foreach ($exam as $row) {
							?>
							<option value="<?=$row->name ?>"><?=$row->name;?></option>
							<?php
							}
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
	
	
</div>



<?php if(isset($exam_id)){ ?>
	<div class="row">
		<div class="col-md-12"> 
			<div class="tab-content">
				<!----TABLE LISTING STARTS-->
				
				<?php  $res = $this->db->get_where("student",array("student_id"=>$student_id))->result_array();
					
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
							<tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Student mark sheet </td></tr>
							<tr bgcolor="#000000"><td colspan="7" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php  echo ucwords('Exam : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$exam_id.'</span>'); ?></td></tr>
							<tr bgcolor="#2092D0">
								<th class="sorting_asc" style="color:#FFF; padding:6px 0px; border-right:1px solid #EEE;  text-align:center;" width="20%">Subject</th>
								<th style="color:#FFF; padding:6px 0px; border-right:1px solid #EEE;  text-align:center;" width="40%">Mark</th>
								<th style="color:#FFF; padding:6px 0px; border-right:1px solid #EEE;  text-align:center;" width="40%">Out of Marks</th>
								<th style="color:#FFF; padding:6px 0px; border-right:1px solid #EEE;  text-align:center;" width="20%">Grade</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$this->db->group_by('mark.subject_id');
								$this->db->select('mark.subject_id as subject_name,mark.mark_obtained,exam.out_of_marks');
								$this->db->join('exam','mark.subject_name=exam.subject_id');
								$mark = $this->db->get_where('mark',array('mark.class_id'=>$class_id,'mark.exam_id'=>$exam_id,'student_id'=>$student_id))->result_array();
								
							foreach($mark as $row_mark):
							$grade=$this->db->get_where('grade',array('from_mark <='=>$row_mark['mark_obtained'],'to_mark>='=>$row_mark['mark_obtained']))->row();	
							?>
							<tr>
								<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $row_mark['subject_name'];?></td>
								<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%" ><?php echo $row_mark['mark_obtained'];?></td>
								<td align="center" style="font-size:11px;padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%"><?php echo $row_mark['out_of_marks'];?></td>
								<td align="center" style="font-size:11px;padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%"><?php echo $grade->grade_name;?></td>
							</tr>
							<?php endforeach; ?>
							<tr>
            <?php
                $this->db->select_min('to_mark');
                $grade_second_minimum=$this->db->get_where('grade',array())->row();

                $this->db->select_sum('out_of_marks');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $mark_out_of=$this->db->get_where('mark' , array('student_id' =>$student_id,'mark.exam_id' => $exam_id))->result_array();

                $this->db->select_sum('mark_obtained');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $mark_total=$this->db->get_where('mark' , array('student_id' =>$student_id,'mark.exam_id' => $exam_id))->result_array();

                $this->db->select('subject_name');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $count_subject=$this->db->get_where('mark' , array('student_id' =>$student_id,'mark.exam_id' => $exam_id))->num_rows();

                $final_avg_mark=$mark_total[0][mark_obtained]/$count_subject;
                $final_grade=$this->db->get_where('grade',array('from_mark <='=>$final_avg_mark,'to_mark>='=>$final_avg_mark))->row();
               
             ?>
            <td><label style="font-weight:900;">Total</label></td>
            <td><label style="font-weight:900;"><?php echo $mark_total[0][mark_obtained]."/".$mark_out_of[0][out_of_marks];?></label></td>
            <td><label style="font-weight:900;">Result:-</label><label><?php if($row_mark['mark_obtained']<=$grade_second_minimum->to_mark){echo "Failed";}else{echo"Pass";} ?></label></td>
            <td><label style="font-weight:900;">Final Grade:-</label>
                <label><?php  
                if($row_mark['mark_obtained']<=$grade_second_minimum->to_mark)
                {
                    echo "None";
                }
                else 
                {
                    echo $final_grade->grade_name;
                }
                ?></label></td>
       			</tr>
				</tbody>
				</table>					
				</div>
				<?php
					if($mark > 0){
					echo form_open(base_url() . 'index.php?student/marks_pdf' , array('class' => 'form-horizontal validate'));?>
					<input type="hidden" name="class_id" value="<?php echo $class_id;  ?>" />
					<input type="hidden" name="exam_id" value="<?php echo $exam_id;  ?>" />
					<input type="hidden" name="student_id" value="<?php echo $student_id;  ?>" />
					<div class="form-group">
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-info">Export To Pdf</button>
						</div>
					</div>   
				</form>
				
			<?php } ?>
            <!--TABLE LISTING ENDS-->
		</div>
	</div>
</div><?php } ?>



<script type="text/javascript">
	
	
	$(document).ready(function() {
		
		
		$("#newexamlist").change(function () {
			//	alert('hi');
			
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
				$("#attendance").hide();
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
				$("#attendance").hide();
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
				$("#attendance").hide();
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
				$("#attendance").hide();
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
		
		/*$("#class_wise_exam").submit(function(){
			var data = $("#class_wise_exam").serialize();	
			var class_id = $("#class_id").val();
			var exam_listing = $("#exam_listing").val();
			
			
			if(class_id=="" || exam_listing=="")		
			{
			return false;	
			}
			showAjaxModal('<?php echo base_url();?>index.php?modal/exam/class_wise_exam_list/',data);
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
			});
			
		*/
		
        
		
		
	});
	
	$(function () {
		
		
		
		
		$("#report_list").change(function () {
			var repost_list = $(this).val();
			
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
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
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
	
	$(function () {
		$("#timetable_list").change(function () {
			if($("#timetable_list").val()=="class_wise_timetable"){
				$("#timetable").show();
				$("#timetable_sub_1").show();
				$("#timetable_sub_2").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				}else if($("#timetable_list").val()=="teacher_wise_timetable"){
				$("#timetable").show();
				$("#timetable_sub_2").show();	
				$("#timetable_sub_1").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
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
				$("#attendance").hide();
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
				$("#attendance").hide();
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
</script>




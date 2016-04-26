<?php if($list == 'subject'){
				  $this->db->select('subject.name as subject_name,teacher.name as teacher_name,subject.class_id,subject.teacher_id as subject_teacher_id');	
				  $this->db->join('teacher', 'teacher.teacher_id= subject.teacher_id');
        $subjects=$this->db->get_where('subject' , array('class_id' => $class_id,'subject.teacher_id' => $this->session->userdata('teacher_id')))->result_array();
		//echo $this->db->last_query();
		
		?> 
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>Subject Name</div></th>
                    		<th><div>Teacher</div></th>
                  		</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($subjects as $row):?>
                        <tr>
							<td><?php echo $row['subject_name'];?></td>
							<td><?php echo $row['teacher_name'];
							$teacher=$this->db->get_where('teacher',array('teaching_type'=>1,
							'teacher_id'=>$row['subject_teacher_id']) )->row();		
								if($teacher->file_name != ""){ ?>
								<a href="download.php?file_name=<?php echo $teacher->file_name;?>" class="links"><i class="fa fa-download"></i></a>	
								<?php }?></td>
				        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
        <?php } if($list =='exam_result'){
		$this->db->select('mark.class_id,mark.subject_id,mark.mark_obtained,mark.mark_total,mark.mark_id,exam.out_of_marks');
		$this->db->join('exam','exam.subject_id= mark.subject_name');
	  	$mark=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->result_array();
		?>
                <label>Class:</label>
                <label><?php echo $mark[0]['class_id']; ?></label><br/>
                
                 <table  class="table table-bordered datatable" id="table_export_exam_result">
                	<thead>
                		<tr>
                    		<th><div>Subject</div></th>
                            <th><div>Mark obtained</div></th>
                            <th><div>Out of Marks</div></th>
                            <!--<th><div>Marks Percentage</div></th>-->
                            <th><div>Grade</div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($mark as $row):?>
                        <tr>
							<td><?php echo $row['subject_id'];?></td>
                            <td><?php echo $row['mark_obtained'];?>
                             <td><?php echo $row['out_of_marks'];?>
                            <!--<td><?php $t=$row['mark_obtained']/$row['out_of_marks']*100;
							echo number_format($t, 1, '.', '');
							?></td>-->  
                            </td>
                            <td><?php 
                                $grade=$this->db->get_where('grade',array('from_mark <='=>$row['mark_obtained'],'to_mark>='=>$row['mark_obtained']))->result_array();
                                foreach ($grade as $grade_row):
                                        echo $grade_row['grade_name'];
                                endforeach;   
                            ?></td>
					    </tr> 
                        <?php endforeach;?>
                    </tbody>

                    <tbody>
            <tr>
            <?php
                $this->db->select_min('to_mark');
                $grade_second_minimum=$this->db->get_where('grade',array())->row();

                $this->db->select_sum('out_of_marks');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $mark_out_of=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->result_array();

                $this->db->select_sum('mark_obtained');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $mark_total=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->result_array();    

                $this->db->select('subject_name');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $count_subject=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->num_rows();    

                $final_avg_mark=$mark_total[0][mark_obtained]/$count_subject;
                $final_grade=$this->db->get_where('grade',array('from_mark <='=>$final_avg_mark,'to_mark>='=>$final_avg_mark))->row();
               
             ?>
            <td><label style="font-weight:900;">Total</label></td>
            <td><label style="font-weight:900;"><?php echo $mark_total[0][mark_obtained]."/".$mark_out_of[0][out_of_marks];?></label></td>
            <td><label style="font-weight:900;">Result:-</label><label><?php if($row['mark_obtained']<=$grade_second_minimum->to_mark){echo "Failed";}else{echo"Pass";} ?></label></td>
            <td><label style="font-weight:900;">Final Grade:-</label>
                <label><?php  
                if($row['mark_obtained']<=$grade_second_minimum->to_mark)
                {
                    echo "None";
                }
                else 
                {
                    echo $final_grade->grade_name;
                }
                6?></label></td>
        </tr>
    </tbody>
                </table>
                <?php } if($list =='exam_schedule'){
		$teacher_class_asso=$this->db->get_where('teacher_class_association' , array('teacher_id' => $this->session->userdata('teacher_id')))->result_array();
		foreach($teacher_class_asso as $teacher_class_asso_row):
		?>
                <label>Class:</label>
                <label><?php echo $teacher_class_asso_row['class_id']; ?></label><br/>
                <table  class="table table-bordered datatable" id="table_export_exam_schedule">
                	<thead>
                		<tr>
                    		<th><div>Subject</div></th>
                            <th><div>Date</div></th>
                            <th><div>Start Date</div></th>
							<th><div>End Date</div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
                        $exam=$this->db->get_where('exam' , array('name' => $exam_name,'class_id'=>$teacher_class_asso_row['class_id']))->result_array();
		//echo $this->db->last_query();
		foreach($exam as $exam_row): 
						$subject_name=$this->db->get_where('subject' , array('subject_id' =>$exam_row['subject_id']))->row();
						?>
                        <tr>
							<td><?php echo $subject_name->name;?></td>
                            <td><?php echo date("F d, Y",strtotime($exam_row['date']));?></td>
                            <td><?php echo $exam_row['time_start'];?></td>
                            <td><?php echo $exam_row['time_end'];?></td>
					    </tr> 
                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php endforeach; } if($list =='assessment'){?>
                 <table class="table table-bordered datatable" id="table_export_assessment" >
                 <thead>
                  <?php $this->db->join('student', 'student.student_id = assessment.student_id');
				  		$this->db->where('assessment.student_id',$class_id);
						$this->db->order_by("assessment_id", "desc");
						$this->db->limit(2);
						$assessment_list1=$this->db->get('assessment')->row();?>
                        <tr>
                            <th width="80"><div>class</div></th>
                            <td style="background-color:#FFF;"><?php echo $assessment_list1->class_id;?></td>
                         </tr>
                         <tr>    <th style="background-color: rgb(255, 255, 255); border-right: medium none;"><div></div></th>
                    	    <th width="" style="background-color: rgb(255, 255, 255); border: medium none ! important;"><div></div></th>
                        </tr>
                         <tr>
                            <th width="100"><div>Student</div></th>
                            <td style="background-color:#FFF;"><?php echo $assessment_list1->name;?></td>
                         </tr>
                         <tr>    <th style="background-color: rgb(255, 255, 255); border-right: medium none;"><div></div></th>
                    	    <th width="" style="background-color: rgb(255, 255, 255); border: medium none ! important;"><div></div></th>
                        </tr>
                    </thead>
                    <thead>
                    <tr>    <th><div>Behaviour</div></th>
                            <th width="150"><div>Date</div></th>
                            <th width="80"><div>Action</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						$this->db->join('student', 'student.student_id = assessment.student_id');
						$this->db->where('assessment.student_id',$class_id);
						$this->db->order_by("assessment_id", "desc");
						$this->db->limit(2);
						$assessment_list=$this->db->get('assessment')->result_array();
					$count=1;	
					foreach($assessment_list as $row): ?>
                    <tr>
                    	<td><?php echo $row['behaviour'];?></td>
                        <td><?php echo date("F d, Y h:i", strtotime($row['created_date']));?></td>
                        <td><?php if($count==1){  ?>
                      		<div class="btn-group">
                      		<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
         		            Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">                                        
									<!-- teacher EDITING LINK -->
									<li>
										<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_assessment/<?php echo $row['assessment_id'];?>');">
											<i class="entypo-pencil"></i>
                                            Edit
										</a>
									</li>
									<li class="divider"></li>
                                        
									<!-- teacher DELETION LINK -->
									<li>
										<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/assessment/delete/<?php echo $row['assessment_id'];?>');">
											<i class="entypo-trash"></i>
											Remove														
											</a>
									</li>
                                    </ul>
                                </div>
                             <?php } ?>
                        </td>
                    </tr>
                    <?php $count++;  endforeach; ?>
                    </tbody>
				</table>
                <?php } if($list =='yearly_absentism'){ ?>
                	<table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
						    <th><div>Absent Date</div></th>
                            <th><div>Description</div></th>
				        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$this->db->select('attandence_class,date,description');
                        $this->db->where('year(date)' ,$year);
						$this->db->where('status',2);
						$this->db->where('teacher_id',$this->session->userdata('teacher_id'));
						$student=$this->db->get('attendance')->result_array();
						//echo $this->db->last_query();
                        foreach($student as $row):?>
                        <tr>
                            <td><?php echo date("F d, Y", strtotime($row['date']));?></td> 
                            <td><?php echo $row['description'];?></td>   
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
             
			        <?php } if($list =='parent_list'){?>
                    <table class="table table-bordered datatable" id="table_export_parent_list">
                    <thead>
                        <tr>
                            <th><div>Name</div></th>
                            <th><div>Email</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $parent=$this->db->get_where('parent',array('student_id'=>$student_name))->result_array();
                            foreach($parent as $row):?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['parent_email'];?></td>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
					<?php }?>	               
<!-- DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export").dataTable({bFilter: false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
		
		var datatable = $("#table_export_parent_list").dataTable({bInfo:false,bPaginate: false,bFilter: false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		var datatable = $("#table_export_exam_result").dataTable({bFilter: false,bInfo: false, bPaginate:false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		$("#change_mark_form").submit(function( event ) {
		  event.preventDefault();
		  var mark_id=$("#mark_id").val();
		  var mark_obtained=$("#mark_obtained").val();
		  var mark_total=$("#mark_total").val();
		 	$.ajax({
				url: '<?php echo base_url();?>index.php?teacher/update_student_mark/',
				data: {mark_id:mark_id,mark_obtained:mark_obtained,mark_total:mark_total},
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});
		});
			
	});
</script>                
<?php if($list =='exam_result'){
	$get_student=$this->db->get_where('student',array('student_id'=>$student_name))->row();
	
	
	$this->db->select('mark.class_id,mark.subject_id,mark.mark_obtained,exam.out_of_marks');
	$this->db->join('exam','exam.subject_id= mark.subject_name');
$mark=$this->db->get_where('mark' , array('mark.exam_id' => $exam_name,'student_id'=>$student_name))->result_array();

?>
<label>Class:</label>
<label><?php echo $get_student->class_id; ?></label><br/>
<table  class="table table-bordered datatable" id="table_export_exam_result">
	<thead>
		<tr>
			<th><div>Subject</div></th>
			<th><div>Marks Obtained/Out of mark</div></th>
			<th><div>Marks Percentage</div></th>
			<th><div>Grade</div></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($mark as $row):?>
		<tr>
			<td><?php echo $row['subject_id'];?></td>
			<td><?php echo $row['mark_obtained'].'/'.$row['out_of_marks'];?></td>
			<td><?php $t=$row['mark_obtained']/$row['out_of_marks']*100;
				echo number_format($t, 1, '.', '');
			?></td>
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
                $this->db->join('exam','exam.subject_id=mark.subject_name');
                $mark_out_of=$this->db->get_where('mark' , array('mark.exam_id' => $exam_name,'student_id'=>$student_name))->result_array();

                $this->db->select_sum('mark_obtained');
                $mark_total=$this->db->get_where('mark' , array('mark.exam_id' => $exam_name,'student_id'=>$student_name))->result_array();

                $this->db->select('subject_name');
                $count_subject=$this->db->get_where('mark' , array('exam_id' => $exam_name,'student_id'=>$student_name))->num_rows();

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

	
<?php }if($list == 'subject'){
	$student_query=$this->db->get_where('student',array('student_id'=>$student_id))->result_array();
	
	 $this->db->select('subject.name as subject_name,teacher.name as teacher_name,subject.class_id,subject.teacher_id as subject_teacher_id');	
	$this->db->where('class_id',intval($student_query[0]['class_id']));
	$this->db->join('teacher', 'teacher.teacher_id= subject.teacher_id');
	$subjects=$this->db->get('subject')->result_array();
	
	
	
?> 
<table class="table table-bordered datatable" id="table_export_subject">
	<thead>
		<tr>
			<th><div>Subject Name</div></th>
			<th><div>Class Name</div></th>
			<th><div>Teacher</div></th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 1;foreach($subjects as $rowa):?>
		<tr>
			<td><?php echo $rowa['subject_name'];?></td>
			<td><?php echo $student_query[0]['class_id'];?></td>
			<td><?php echo $rowa['teacher_name'];
				$teacher=$this->db->get_where('teacher',array('teaching_type'=>1,
				'teacher_id'=>$row['subject_teacher_id']) )->row();		
				if($teacher->file_name != ""){ ?>
				<a href="download.php?file_name=<?php echo $teacher->file_name;?>" class="links"><i class="fa fa-download"></i></a>	
			<?php }?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php } if($list =='assessment'){?>
<table class="table table-bordered datatable" id="table_export_assessment" >
	<thead>
		<?php 
			$this->db->select('student.name,assessment.*');
			$this->db->join('student', 'student.student_id = assessment.student_id');
			$this->db->limit(2);
			$this->db->where('student.student_id',$student_id);
			$assessment_list1=$this->db->get('assessment')->row();
			//echo $this->db->last_query();
		?>
		<tr>
			<th width="80"><div>class</div></th>
			<td style="background-color:#FFF;"><?php echo $assessment_list1->class_id;?></td>
		</tr>
		<tr>
			<th width="100"><div>Student</div></th>
			<td style="background-color:#FFF;"><?php echo $assessment_list1->name;?></td>
		</tr>
	</thead>
	<thead>
		<tr>    <th><div>Behaviour</div></th>
			<th width="150"><div>Date</div></th>
		</tr>
	</thead>
	<tbody>
		<?php
			
			$this->db->select('student.name,assessment.*');
			$this->db->join('student', 'student.student_id = assessment.student_id');
			$this->db->limit(2);
			$this->db->where('assessment.student_id',$student_id);
			$assessment_list=$this->db->get('assessment')->result_array();	
			$count=1;	
			foreach($assessment_list as $row){
			?>
			<tr>
				<td><?php echo $row['behaviour'];?></td>
				<td><?php echo date("F d, Y h:i", strtotime($row['created_date']));?></td>
				
			</tr>
		<?php $count++;} ?>
	</tbody>
</table>
<?php } if($list =='exam_schedule'){
		//echo $student_name;
	$exam=$this->db->get_where('exam',array('name'=>$exam_name,'class_id'=>intval($student_name)))->result_array();
?>
<label>Class:</label>
<label><?php echo $student_name; ?></label><br/>
<table  class="table table-bordered datatable" id="table_export_exam_schedule">
	<thead>
		<tr>
			<th><div>Subject</div></th>
			<th><div>Date</div></th>
			<th><div>Start Time</div></th>
			<th><div>End End</div></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($exam as $exam_row):
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
<?php }if($list == 'share_materail'){?>

<table class="table table-bordered datatable" id="table_export">
                	<thead>
                	   <tr>
                    		<th><div>Class Name</div></th>
				<th><div>Subjects</div></th>
                    		<th><div>Topic Name</div></th> 
                            	<th><div>File Name</div></th>
				<th><div>Download</div></th> 							
                   	   </tr>
			</thead>
                    <tbody>
                    	<?php 
			$get_student=$this->db->get_where('student',array('student_id'=>$student_id))->row();
			$share_material=$this->db->get_where('share_material',array('class_id'=>$get_student->class_id))->result_array();	
			foreach($share_material as $row):?>
                        <tr>
  				<td><?php echo $row['class_id']; ?></td>
				<td><?php $subjectName=$this->db->get_where('subject',array('subject_id'=>$row['subject_id']))->row();  echo $subjectName->name;?></td>
				<td><?php echo $row['topic_name'];?></td>
                                <td><?php echo $row['m_filename']; ?></td>
							<td><a href="material_download.php?file_name=<?php echo $row['m_filename'];?>" class="links"><button type="button" class="btn btn-info">Download</button></a></td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
<?php }?>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	
	jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export").dataTable({bFilter: false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
		var datatable = $("#table_export_exam_result").dataTable({bFilter: false,bInfo:false, bPaginate:false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
		var datatable = $("#table_export_subject").dataTable({bFilter: false,bInfo:false, bPaginate:false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>                

        <?php if($list =='exam_result'){
		$get_student=$this->db->get_where('student' , array('student_id' =>$this->session->userdata('student_id')))->row();
		
		$this->db->select('mark.class_id,mark.subject_id,mark.mark_obtained,exam.out_of_marks');
		$this->db->join('exam','exam.subject_id= mark.subject_name');
	  	$mark=$this->db->get_where('mark' , array('student_id' =>$this->session->userdata('student_id'),'mark.exam_id' => $exam_name))->result_array();?>
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
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $mark_out_of=$this->db->get_where('mark' , array('student_id' =>$this->session->userdata('student_id'),'mark.exam_id' => $exam_name))->result_array();

                $this->db->select_sum('mark_obtained');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $mark_total=$this->db->get_where('mark' , array('student_id' =>$this->session->userdata('student_id'),'mark.exam_id' => $exam_name))->result_array();

                $this->db->select('subject_name');
                $this->db->join('exam','exam.subject_id= mark.subject_name');
                $count_subject=$this->db->get_where('mark' , array('student_id' =>$this->session->userdata('student_id'),'mark.exam_id' => $exam_name))->num_rows();

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
		$exam=$this->db->get_where('exam' , array('class_id' =>intval($this->session->userdata('class_name')),'name' => $exam_name))->result_array();?> 
                <label>Class:</label>
                <label><?php echo $exam[0]['class_id']; ?></label><br/>
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
                    	<?php foreach($exam as $exam_row):
						$subject_name=$this->db->get_where('subject' , array('subject_id' =>$exam_row['subject_id']))->row();
						?>
                        <tr>
							<td><?php echo $subject_name->name;?></td>
                            <td><?php echo $exam_row['date'];?></td>
                            <td><?php echo $exam_row['time_start'];?></td>
                            <td><?php echo $exam_row['time_end'];?></td>
					    </tr> 
                        <?php endforeach;?>
                    </tbody>
                </table>

                <?php } if($list =='yearly_absentism'){ ?>
                	<table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
							<th><div>class</div></th>
                            <th><div>Absent Date</div></th>
                            <th><div>Description</div></th>
				        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$this->db->select('attandence_class,date,description');
                        $this->db->where('year(date)' ,$year);
						$this->db->where('status',2);
						$this->db->where('student_id',$this->session->userdata('student_id'));
						$student=$this->db->get('attendance')->result_array();
						//echo $this->db->last_query();
                        foreach($student as $row):?>
                        <tr>
                            <td><?php echo $row['attandence_class'];?></td>
                            <td><?php echo date("d-M-Y", strtotime($row['date']));?></td> 
                            <td><?php echo $row['description'];?></td>   
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
             
                <?php } ?>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export_exam_result").dataTable({bFilter: false,bInfo: false, "bPaginate": false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
			
	});
	jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export_exam_schedule").dataTable({bFilter: false, bInfo: false,bPaginate: false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
			
	});
</script>                
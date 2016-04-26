<div class="row">
	<div class="col-md-12">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
              <?php
			  $get_student=$this->db->get_where('student' , array('student_id' =>$this->session->userdata
			  ('student_id')))->row();
			    $this->db->select('subject.name as subject_name,teacher.name as teacher_name,subject.class_id,subject.teacher_id as subject_teacher_id');	
				  $this->db->join('teacher', 'teacher.teacher_id= subject.teacher_id');
        $subjects=$this->db->get_where('subject' , array('class_id' =>intval($get_student->class_id)))->result_array();?> 
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
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">
	jQuery(document).ready(function($){
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
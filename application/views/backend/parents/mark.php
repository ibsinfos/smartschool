<div class="row">
	<div class="col-md-12">
    
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            <?php echo form_open(base_url() . 'index.php?parents/exam' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'exam_result_form','target'=>'_top'));?>
                            <div class="form-group">
                             <label class="col-sm-1 control-label">Student</label>
                                <div class="col-sm-2">
                                    <select name="student_name" id="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Student</option>
                                   <?php 
									$this->db->select('student.student_id,student.name,student.class_id');
									$this->db->join('parent', 'parent.parent_email = student.parent_email');
									$this->db->group_by('student.student_id');
									$this->db->where('student.parent_email',$this->session->userdata('parent_email'));
									$parent_query=$this->db->get('student')->result();
								foreach ($parent_query as $parent_row): ?>
								<option value="<?php echo $parent_row->student_id;?>"><?php echo $parent_row->name;?></option>
                                	<?php endforeach; ?>	
                                     </select>
                                </div>
                                <label class="col-sm-1 control-label">Exam</label>
                                <div class="col-sm-2">
                                    <select name="exam_name" id="exam_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Exam</option>
                                   <?php 
                  								  $this->db->select('exam.name');
                  								  $this->db->distinct('exam.name');
                  									$this->db->group_by('exam.name');	
                  									$exam_query = $this->db->get('exam')->result_array();
                                    echo $this->db->last_query();
									                  foreach ($exam_query as $exam_row): ?>
                                    <option value="<?php echo $exam_row['name'];?>"><?php echo $exam_row['name'];?></option>
                                	<?php endforeach; ?>	
                                     </select>
                                </div>
                              <div class="col-sm-2">
                                  <button type="submit" class="btn btn-info">Search</button>
                              </div>
						</div>
                    </form> 
                <div id="get_data_table">
                </div>				
			</div>
            <!----TABLE LISTING ENDS--->
            


            </div>
	</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
   function get_student_ajax(class_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?parents/get_student_name/' + class_id ,
            success: function(response)
            {
                jQuery('#student_listing').html(response);
            }
        });
   }
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
$("#exam_result_form").submit(function( event ) {
	event.preventDefault();
  var exam_name=$("#exam_name").val();
  var student_name=$("#student_name").val();
  if(exam_name != ""){
		$.ajax({
				url: '<?php echo base_url();?>index.php?parents/get_mark_data_table/',
				data: { exam_name:exam_name,student_name:student_name,list:'exam_result' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});
  }
		});

	});
	
</script>
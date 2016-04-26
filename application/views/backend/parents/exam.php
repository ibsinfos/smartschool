<div class="row">
	<div class="col-md-12">
		
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				<?php echo form_open(base_url() . 'index.php?parents/exam' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'exam_result_form','target'=>'_top'));?>
				<div class="form-group">
					<label class="col-sm-1 control-label">Student</label>
					<div class="col-sm-2">
						<select name="student_name" id="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
							<option value="">Select Student</option>
							<?php 
								$this->db->select('student.student_id,student.name,student.class_id');
								$this->db->join('parent', 'parent.parent_email = student.parent_email');
								$this->db->group_by('student.student_id');
								$this->db->where('student.parent_email',$this->session->userdata('parent_email'));
								$parent_query=$this->db->get('student')->result();
							foreach ($parent_query as $parent_row): ?>
							<option value="<?php echo $parent_row->class_id;?>"><?php echo $parent_row->name;?></option>
							<?php endforeach; ?>	
						</select>
					</div>
					<label class="col-sm-1 control-label">Exam</label>
					<div class="col-sm-2">
						<select name="exam_name" id="exam_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
							<option value="">Select Exam</option>
							<?php
								$this->db->distinct('name');
								$this->db->group_by('name');
								//$this->db->where('class_id',$this->input->post('class_id'));
								$q=$this->db->get('exam')->result_array();	
								
							foreach ($q as $exam): ?>
							<option value="<?php echo $exam['name'];?>"><?php echo $exam['name'];?></option>
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
<script>
	function get_exam(class_id)
	{		
		$.ajax({		
            url: '<?php echo base_url();?>index.php?parents/get_exam/',
			type: 'POST',
			data: { 
				class_id :class_id 
			},			 
			dataType:'json',			
            success: function(response)
            {
			    for(var i=0;i<response.length;i++)
				{
					$("#exam_name").append("<option value="+$.trim(response[i].name)+">"+response[i].name+" </option>");
				} 
			}
		});
		
	}
</script>
<script type="text/javascript">
	function get_student_ajax(class_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?student/get_student_name/' + class_id ,
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
			if(exam_name != "" && student_name != ""){
				$.ajax({
					url: '<?php echo base_url();?>index.php?parents/get_exam_data_table/',
					data: { exam_name:exam_name,student_name:student_name,list:'exam_schedule' },
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
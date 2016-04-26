<div class="row">
	<div class="col-md-12">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				<div class="padded">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-sm-1 control-label">Student</label>
							<div class="col-sm-3">
								<select name="class_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_subject_list(this.value);">
									<option value="">Select Student</option>									
									<?php 
										$this->db->select('student.student_id,student.name');
										$this->db->join('parent', 'parent.parent_email = student.parent_email');
										$this->db->group_by('student.student_id');
										$this->db->where('student.parent_email',$this->session->userdata('parent_email'));
										$parent_query=$this->db->get('student')->result();
									foreach ($parent_query as $parent_row): ?>
									<option value="<?php echo $parent_row->student_id;?>"><?php echo $parent_row->name;?></option>
									<?php endforeach; ?>	
								</select>
							</div>
						</div>
					</form>
				</div>
				
                <div id="get_data_table">
				</div>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">
	function get_subject_list(student_id) {
		$.ajax({
			url: '<?php echo base_url();?>index.php?parents/get_subject_data_table/',
			data: { student_id:student_id,list:'subject' },
			type: "POST",
			success: function(response)
			{
				jQuery('#get_data_table').html(response);
			}
		});
	}
	jQuery(document).ready(function($){
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
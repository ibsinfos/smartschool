<div class="row">
	<div class="col-md-12">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
				<div class="panel-body">
					<form action="" method="post" id="search_dropdown">
						<div class="form-group">
							<div class="col-sm-3">								
								<select name="student_name" id="student_name" class="form-control" 
								style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
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
							<button type="submit" class="btn btn-info" name="search_dropdown" id="search_dropdown">Search</button>
						</div>
					</form>
				</div>
				
				<div id="get_data_table"></div>
			</div>
		</div>
	</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->  
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({bFilter: false, bInfo: false,"bPaginate": false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});
	$(document).ready(function() {	 
		$("#search_dropdown").submit(function( event ) {
			event.preventDefault();
			var student_id=$("#student_name").val();
			$.ajax({
				url: '<?php echo base_url();?>index.php?parents/get_subject_data_table/',
				data: {student_id:student_id,list: 'assessment' },
				type: "POST",
				async:false,
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});		
		});
	});
	
</script>
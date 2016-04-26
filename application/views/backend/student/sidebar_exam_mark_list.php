
<div id="main_exam_mark">
	<div id="exam_mark_sub_1">
		<?php //echo form_open(base_url() . 'index.php?admin/exam_mark/class_wise_exam' , array('class' => 'form-horizontal validate'));?>
		<form action="<?php echo base_url() . 'index.php?student/exam_mark'; ?>" method="post" id="class_wise_exam"  class="form-horizontal validate">			
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
								<option value="<?=$row->exam_id ?>"><?=$row->name;?></option>
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


<script type="text/javascript">
	
	
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

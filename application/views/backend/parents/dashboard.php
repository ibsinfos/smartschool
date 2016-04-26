<div class="row">
	<div class="col-md-12">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">	
			<!----TABLE LISTING ENDS--->
            <?php echo form_open(base_url() . 'index.php?parents/student_attendance/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Student</label>
                                <div class="col-sm-3">
                             <select name="student_name" id="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return search_student_name(this.value);">
                                    <option value="">Select Student</option>
                                    						
                                   <?php 
								 $this->db->select('student.student_id,student.name');
									$this->db->join('parent', 'parent.parent_email = student.parent_email');
									$this->db->group_by('student.student_id');
									$this->db->where('student.parent_email',$this->session->userdata('parent_email'));
									$parent_query=$this->db->get('student')->result_array();
								foreach ($parent_query as $parent_row): ?>
								<option value="<?php echo $parent_row['student_id'];?>"><?php echo $parent_row['name'];?></option>
                                	<?php endforeach; ?>	
                                     </select>
                            	</div>
                            </div>
                             
                  	</form>  
    <div class="row" id="attendance_list">
    <div class="col-sm-offset-3 col-md-6">
        <table class="table table-bordered">
           <thead>
                <tr>
                    <td>Absent Date</td>
                    <td>Description</td>
					<td>Type of Leave</td>
                </tr>
            </thead>
            <tbody id="student_attendance_listing">
						
          </tbody>
        </table>
    </div>
	</div>              
                </div>                
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function search_student_name(search_value){
if(search_value != ""){
 			$.ajax({
            url: '<?php echo base_url();?>index.php?parents/get_month_attendance_student_name/' + search_value ,
            success: function(response)
            {
				jQuery('#student_attendance_listing').html(response);
            }
        });
        }
}
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});
</script>

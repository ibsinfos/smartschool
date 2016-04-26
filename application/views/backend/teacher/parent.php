<div class="row">
	<div class="col-md-12">
    
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            <?php echo form_open(base_url() . 'index.php?teacher/parent' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'parent_list_form','target'=>'_top'));?>
            				<div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select name="class_id" id="class_id" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return class_data_table(this.value);">
                                    <option value="">Select Class</option>
                                   <?php
								    $this->db->distinct("class_id");
									$this->db->group_by("class_id");
								 	$class_query = $this->db->get_where('teacher_class_association',array('teacher_id'=>$this->session->userdata('teacher_id')))->result_array();
									foreach ($class_query as $class_row):
                                    ?>
                                    <option value="<?php echo $class_row['class_id'];?>"><?php echo $class_row['class_id'];?></option>
                                	<?php
                                	endforeach;
                                	?>	
                                     </select>
                                </div>
                            
                                <label class="col-sm-1 control-label">Student</label>
                                <div class="col-sm-2">
                                    <select name="student_name" id="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Student</option>
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
   function class_data_table(class_id){
		    $.ajax({
				url: '<?php echo base_url();?>index.php?teacher/get_student_id/'+class_id,
				success: function(response)
				{
					jQuery('#student_name').html(response);
				}
			});
	 }


	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({bFilter: false, bInfo: false,bPaginate: false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
		$("#parent_list_form").submit(function( event ) {
		event.preventDefault();
   	  	  var class_id=$("#class_id").val();
		  var student_name=$("#student_name").val();
		  if(class_id != ""){
		$.ajax({
				url: '<?php echo base_url();?>index.php?teacher/get_parent_data_table/',
				data: { class_id:class_id,student_name:student_name,list:'parent_list' },
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


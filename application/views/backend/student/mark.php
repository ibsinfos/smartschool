<div class="row">
	<div class="col-md-12">
    
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            <?php echo form_open(base_url() . 'index.php?student/exam' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'exam_result_form','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Exam</label>
                                <div class="col-sm-2">
                                    <select name="exam_name" id="exam_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Exam</option>
                                   <?php 
								  		$this->db->distinct('name');
										$this->db->group_by('name');		  
								    $exam_query = $this->db->get_where('exam',
									array('class_id'=>intval($this->session->userdata('class_name'))))->result_array();
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
  if(exam_name != ""){
		$.ajax({
				url: '<?php echo base_url();?>index.php?student/get_mark_data_table/',
				data: { exam_name:exam_name,list:'exam_result' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});
  }
		});

	});
	
function validation_download()
{
	var class_id=document.getElementById("class_id").value;
	var err=true;
	if (document.getElementById("year_name").value == "")
	{
		document.getElementById("year_name_Err").innerHTML="Value Required";
		err=false;
	}
	else{document.getElementById("year_name_Err").innerHTML="";}
	if (document.getElementById("class_id").value == "")
	{
		document.getElementById("class_id_Err").innerHTML="Value Required";
		err=false;
	}
	else{document.getElementById("class_id_Err").innerHTML="";
	$("#testtest").append("<input type='hidden' value="+class_id+" name='test'>");}
	if(err=false)
	{	return false; }
	else
	{	
		location.href = '<?php echo base_url(); ?>index.php?student/download_mark_excelsheet/'+class_id ;
		return true;
		//window.location = '<?php echo base_url(); ?>index.php?admin/download_mark_excelsheet/'+class_id;
	}
	
}
</script>
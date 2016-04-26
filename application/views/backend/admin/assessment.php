<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			
			<li class="active">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Create Assessment
                    	</a></li>
            <li>
            	<a href="#list" data-toggle="tab"><i class="entypo-plus-circled"></i>Assessment Listing</a>
			</li>            
		</ul>
    	<!--CONTROL TABS END-->
		<div class="tab-content">            
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box" id="list" style="padding: 5px">
          	<div class="panel-body">
            <form action="" method="post" id="search_dropdown">
                <div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-3">
                                    <select name="classes" id="classes" class="form-control" style="width:100%;" onchange="return get_classes(this.value)" data-validate="required" data-message-required="Class is required">
                                    <option value="">Select Class</option>
                                  <?php
                                  $class = $this->db->get('class')->result_array();
                                  foreach ($class as $row):
                                    ?>
                                       <option value="<?php echo $row['name_numeric'];?>"><?php echo $row['name_numeric'];?></option>
                                  <?php
                                  endforeach;
                                  ?>  
                                    </select>
                                </div>
                            </div>
                        <div class="form-group">          
                    <label class="col-sm-1 control-label">Student</label>
                <div class="col-sm-3">
                  <select class="form-control" style="width:100%;" id="student_listing1" data-validate="required" data-message-required="Student is required" name="student">
                              <option value="">Select Student</option>
                                    </select>
                </div>
              </div>

                <button type="submit" class="btn btn-info" name="search_dropdown" id="search_dropdown">Search</button>
                
             </form>
          	</div>
               
                  <div id="get_data_table"></div>
			</div>
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box active" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/assessment/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                          <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Class Name<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="class_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_student_ajax(this.value);">
                                    <option value="">Select Class Name</option>
                                  <?php
                								  $this->db->distinct("name_numeric");
                									$this->db->select("name_numeric");
                								  $this->db->join('student', 'student.class_id = class.name_numeric');
                									$class_query = $this->db->get('class')->result_array();
                									foreach ($class_query as $class_row):
                                  ?>
                                    <option value="<?php echo $class_row['name_numeric'];?>"><?php echo $class_row['name_numeric'];?></option>
                                	<?php
                                	endforeach;
                                	?>	
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Student Name<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="student_listing">
                                    <option value="">Select Student Name</option>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Behaviour<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <textarea name="behaviour" id="behaviour" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"> </textarea>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-3">
                                  <button type="submit" class="btn btn-info">Save</button>
                                  <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
                              </div>
						   </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>

<script type="text/javascript">
   function get_student_ajax(class_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_classes/' + class_id ,
            success: function(response)
            {
                jQuery('#student_listing').html(response);
            }
        });
   }
</script>

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
  var student_name_datatable=$("#student_listing1").val();
  $.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_alldata_table/',
				data: {student_id:student_name_datatable,list: 'assessment' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});		
});
});

function get_classes(class_id) {
    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_classes/' + class_id ,
            success: function(response)
            {
                jQuery('#student_listing1').html(response);
            }
        });
   }

</script>
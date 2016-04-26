<?php 
$edit_data		=	$this->db->get_where('assessment' , array('assessment_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
                    Edit Subject
				</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/assessment/do_update/'.$row['assessment_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                  <div class="padded">
                 <div class="form-group">
                                <label class="col-sm-3 control-label">Class Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="class_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_student_ajax(this.value);">
                                    <option value="">Select Class Name</option>
                                   <?php
								 	$this->db->distinct("name_numeric");
									$this->db->select("name_numeric");
								    $this->db->join('student', 'student.class_id = class.name_numeric');
									$class_query = $this->db->get('class')->result_array();
									foreach ($class_query as $class_row):
                                    ?>
                                    <option value="<?php echo $class_row['name_numeric'];?>"
                                     <?php if($row['class_id'] == $class_row['name_numeric'])echo 'selected';?>><?php echo $class_row['name_numeric'];?></option>
                                	<?php
                                	endforeach;
                                	?>	
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Student Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="student_listing">
                                    <option value="">Select Student Name</option>
                                  	<?php  $this->db->join('student', 'student.student_id = assessment.student_id');
										   $student_list=$this->db->get_where('assessment')->result_array();
									foreach($student_list as $row_student):?>
                                    <option value="<?php echo $row_student['student_id'] ?>"
                                    <?php if($row['student_id'] == $row_student['student_id'])echo 'selected';?>><?php echo $row_student['name'] ?></option>
                                    <?php endforeach; ?>					
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Behaviour<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <textarea name="behaviour" id="behaviour" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"><?php echo $row['behaviour']; ?> </textarea>
                                </div>
                            </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                       <button type="submit" class="btn btn-info">Save</button>
                    </div>
                 </div>
        		</form>
            </div>
        </div>
    </div>
</div>
<?php
endforeach;
?>
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








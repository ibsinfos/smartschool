<?php 
$edit_data		=	$this->db->get_where('exam' , array('exam_id' => $param2) )->result_array();
foreach ( $edit_data as $edrow):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_exam');?>
            	</div>
            </div>
			<div class="panel-body">
				 <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/exam/edit/do_update/'.$edrow['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','id'=>'ips' ));?>
                       <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $edrow['name'];?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('select_class');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									<select name="class_id" class="form-control"  id="exam_class" onchange="get_subject(this.value)"  style="float:left;">
										<?php 
												$this->db->select('name_numeric');
												$this->db->distinct();
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
											<option value="<?php echo $row['name_numeric'];?>" <?php if($row['name_numeric'] == $edrow['class_id'])echo 'selected';?>>
													<?php echo $row['name_numeric'];?></option> 
										<?php
										endforeach;
										?>
									</select>
									 
								</div>
							</div>	
							<div class="form-group">
                                <label class="col-sm-3 control-label">Select subject<span class="mandatory">*</span></label>
									<div class="col-sm-5">
									<select name="subject_id"  id="subject_listing_edit" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">		  									<?php 
										$subject = $this->db->get_where('subject',array('class_id'=>$edrow['class_id']))->result_array();
										foreach($subject as $row):
										?>
											<option value="<?php echo $row['subject_id'];?>" <?php if($row['subject_id'] == $edrow['subject_id'])echo 'selected';?>>
													<?php echo $row['name'];?></option> 
										<?php
										endforeach;
										?>
									</select>
								</div>
							</div>	
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="date" value="<?php echo $edrow['date'];?>"/>
                                </div>
                            </div>
                           <div class="form-group">
                                <label class="col-sm-3 control-label">Start Time<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" name="time_start" id="start_time" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $edrow['time_start'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">End Time<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" name="time_end" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $edrow['time_end'];?>" />  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" >Maximum marks<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="out_of_marks" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $edrow['out_of_marks'];?>" maxlength="3"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label" >Minimum passing marks<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="minimum_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $edrow['minimum_mark'];?>" maxlength="3"/>
                                </div>
                            </div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
								  <button type="submit" class="btn btn-info">Save</button>
                                  <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
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
function get_subject(class_id) {   
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
				success: function(response)
				{
					$('#subject_listing_edit').html(response);
				}
			});
   }
</script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css">
<script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>

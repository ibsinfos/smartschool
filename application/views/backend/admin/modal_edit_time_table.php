<?php 
$edit_data		=	$this->db->get_where('time_table' , array('time_table_id' => $param2) )->result_array();
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/time_table/do_update/'.$row['time_table_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?><span class="mandatory">*</span></label>
                    <div class="col-sm-5">
                        <select name="class_id" class="form-control">
                            <?php 
                            $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['name_numeric'];?>" <?php if($row['class_id']==$row2['name_numeric'])echo 'selected';?>>
                                    <?php echo $row2['name_numeric'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?><span class="mandatory">*</span></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control">
                            <?php 
                            $subjects = $this->db->get('subject')->result_array();
                            foreach($subjects as $row2):
                            ?>
                                <option value="<?php echo $row2['subject_id'];?>" <?php if($row['subject_id']==$row2['subject_id'])echo 'selected';?>>
                                    <?php echo $row2['name'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                                <label class="col-sm-3 control-label">Teacher<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="teacher_id" class="form-control" style="width:100%;"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Teacher</option>
                                    	<?php 
										$teacher = $this->db->get_where('teacher',array("teaching_type"=>1))->result_array();
										foreach($teacher as $row3):
										?>
                                    		<option value="<?php echo $row3['teacher_id'];?>" <?php
											 if($row['teacher_id']==$row3['teacher_id'])echo 'selected';?>><?php echo $row3['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                <div class="form-group">
                                <label class="col-sm-3 control-label">Date<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="date" id="date" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['date']; ?>">
                                </div>
                            </div>
                <div class="form-group">
                                <label class="col-sm-3 control-label">Start Time<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" name="time_start" id="start_time" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['time_start']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">End Time<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" name="time_end" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['time_end']; ?>" />  
                                </div>
                            </div>
                
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info">Save</button>
                  </div>
                </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css">
<script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>
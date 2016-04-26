<?php $edit_data=$this->db->get_where('grade' , array('grade_id' => $param2) )->result_array();
foreach ( $edit_data as $row):?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					 Edit Grade
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/grade/do_update/'.$row['grade_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Grade Name<span class="mandatory">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="grade_name" maxlength="2" value="<?php echo $row['grade_name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3 control-label">From Marks<span class="mandatory">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" placeholder="In (%)" maxlength="3" value="<?php echo $row['from_mark'];?>" name="from_mark" data-validate="required,number" data-message-required="From mark is required"/>
                        </div>
                    </div>                          
                    <div class="form-group">
                    <label class="col-sm-3 control-label">To Marks<span class="mandatory">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="to_mark" placeholder="In (%)" maxlength="3" value="<?php echo $row['to_mark'];?>" data-validate="required,number" data-message-required="To mark is required"/>
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






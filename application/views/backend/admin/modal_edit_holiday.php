<?php $edit_data		=	$this->db->get_where('holiday' , array('h_id' => $param2) )->result_array();
foreach ( $edit_data as $row):?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					 Edit holiday
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/holiday/do_update/'.$row['h_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Holiday Name<span class="mandatory">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="holiday_name" value="<?php echo $row['holiday_name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
					<div class="form-group">

                        <label class="col-sm-3 control-label">Date<span class="mandatory">*</span></label>

							<div class="col-sm-5">

                                <input type="text" value="<?php echo $row['holiday_date'];?>" class="datepicker form-control" name="holiday_date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>

                            </div>

                    </div>

					<input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>">					

					<div class="form-group">
                                <label class="col-sm-3 control-label">Holiday Detail</label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="holiday_detail" value="<?php echo $row['holiday_detail'];?>"/>
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






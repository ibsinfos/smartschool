<?php 
$edit_data=$this->db->get_where('teacher_class_association' , array('tca_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					 Edit Class
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/classes/do_update/'.$row['tca_id'] , array('class' => 'form-horizontal validate','target'=>'_top'));?>
                    <!--<div class="form-group">
                        <label class="col-sm-3 control-label">Class Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>-->
                    <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
					<div id="drop1">
							<!--<div class="form-group">
                                <label class="col-sm-3 control-label">Std</label>
                                <div class="col-sm-5">
                                    <select style="width:100%;" class="form-control" name="std" id="dpstd1">
										<option value="">Select Standard </option>
									<option <?php if($row['std'] == "1"){ echo "Selected"; } ?> value="1">1 </option>
									<option <?php if($row['std'] == "2"){ echo "Selected"; } ?> value="2">2 </option>
									<option <?php if($row['std'] == "3"){ echo "Selected"; } ?> value="3">3 </option>
									<option <?php if($row['std'] == "4"){ echo "Selected"; } ?> value="4">4 </option>
									<option <?php if($row['std'] == "5"){ echo "Selected"; } ?> value="5">5 </option>
									<option <?php if($row['std'] == "6"){ echo "Selected"; } ?> value="6">6 </option>
									<option <?php if($row['std'] == "7"){ echo "Selected"; } ?> value="7">7 </option>
									<option <?php if($row['std'] == "8"){ echo "Selected"; } ?> value="8">8 </option>
									<option <?php if($row['std'] == "9"){ echo "Selected"; } ?> value="9">9 </option>
									<option <?php if($row['std'] == "10"){ echo "Selected"; } ?> value="10">10 </option>
									<option <?php if($row['std'] == "11"){ echo "Selected"; } ?> value="11">11 </option>
									<option <?php if($row['std'] == "12"){ echo "Selected"; } ?> value="12">12 </option>
									</select>
                                </div>
                            </div>-->
							<!--<div class="form-group">
                                <label class="col-sm-3 control-label">Division</label>
                                <div class="col-sm-5">
                                    <select style="width:100%;" class="form-control" name="division" id="dpdiv1">
											<option value="">Select Division </option>
									<option <?php if($row['division'] == "A"){ echo "Selected"; } ?> value="A">A </option>
									<option <?php if($row['division'] == "B"){ echo "Selected"; } ?> value="B">B </option>
									<option <?php if($row['division'] == "C"){ echo "Selected"; } ?> value="C">C </option>
									<option <?php if($row['division'] == "D"){ echo "Selected"; } ?> value="D">D </option>
									<option <?php if($row['division'] == "E"){ echo "Selected"; } ?> value="E">E </option>
									<option <?php if($row['division'] == "F"){ echo "Selected"; } ?> value="F">F </option>
									<option <?php if($row['division'] == "G"){ echo "Selected"; } ?> value="G">G </option>
									<option <?php if($row['division'] == "H"){ echo "Selected"; } ?> value="H">H </option>
									<option <?php if($row['division'] == "I"){ echo "Selected"; } ?> value="I">I </option>
									<option <?php if($row['division'] == "J"){ echo "Selected"; } ?> value="J">J </option>										
									</select>
                                </div>
                            </div>-->
                            
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Class<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" style="width:100%;" data-validate="required">
												<option value="">Select Class </option>
								    	<?php 
										$class = $this->db->get('class')->result_array();
										foreach($class as $row1):
										?>
                                    		<option value="<?php echo $row1['name_numeric'];?>"
                                             <?php if($row['class_id'] == $row1['name_numeric']){?> selected="selected" <?php } ?>>
											<?php echo $row1['name_numeric'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?><span class="mandatory">*</span></label>
                        <div class="col-sm-5">
                            <select name="teacher_id" class="form-control">
                                <option value=""> Select Teacher</option>	
                                <?php 
                                $teachers = $this->db->get_where('teacher',array('teaching_type'=>1))->result_array();
                                foreach($teachers as $row2):
                                ?>
                                    <option value="<?php echo $row2['teacher_id'];?>"
                                        <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
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
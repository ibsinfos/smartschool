<div class="row">
<!-- Start option 1  --> 
	<div class="col-md-12">
        	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Bulk Upload
                </a>
			</li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Update Student Mark
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>

		<div class="panel panel-primary" data-collapsed="0">
        	<div class="tab-content">
             <div class="tab-pane box active" id="list">
				<?php echo form_open(base_url() . 'index.php?admin/mark/import_excel/' , array('class' => 'form-horizontal validate', 'enctype' => 'multipart/form-data'));?>
						
    				<div class="form-group">
                                <label class="col-sm-3 control-label">Select Year</label>
                                <div class="col-sm-3">
                                    <select name="year_name" id="year_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Year</option>
                                    <option value="<?php echo date("Y",strtotime("-1 year")); ?>"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    <option value="<?php echo date("Y"); ?>" ><?php echo date("Y"); ?></option>
                                    <?php
									 $total_next_year=1;
									 for($i=1; $i<=$total_next_year; $i++){ ?>
                                    <option value="<?php echo date("Y",strtotime("+".$i."year")); ?>"><?php echo date("Y",strtotime("+".$i."year")); ?></option>
                                    <?php } ?>
                                     </select>
                                     <div class="error-msg" id="year_name_Err"></div>
                                </div>
                                
                            </div>
                         <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Select Class</label>
                        <div class="col-sm-3">
							<select name="class_id" id="class_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_exam(this.value);">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
											?>
                                    		<option value="<?php echo $row['name_numeric'];?>">
													<?php echo $row['name_numeric'];?>
                                                    </option>
                                        <?php endforeach; ?>
                          </select>
                          <div class="error-msg" id="class_id_Err"></div>
						</div> 
                        </div>
                        <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Select Exam</label>
                        <div class="col-sm-3">
							<select name="exam_id" id="exam_list" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_exam1(this.value);">
                              <option value="">Select Exam</option>
                          </select>
                          <div class="error-msg" id="class_id_Err"></div>
						</div> 
					</div>
                   
                    <div style="display:none;" id="download_show-hode">
                    <label for="field-1" class="col-sm-3 control-label"></label>
                     <div class="form-group">
                     <div class="col-sm-3">
                         <button type="button" name="download" class="links" id="download_button" style="background:none; border:none; " onclick="return validation_download(); this.form.submit();"><img style="height:40px; width:120px;" src="<?php echo base_url();?>assets/images/download.png" /></button>
                         <div class="error-msg"><i>Download student excel sheet</i></div>
                         </div>
                         </div>
                         </div>
                    <div id="choose_excel" style="display:none;">
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Choose Marksheet</label>
						<div class="col-sm-3">
                        	<input type="file" name="userfile" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="userfile">
							<div class="error-msg" id="userfile_Err"></div>
                            <br>
                            <div id="testtest"></div>
                            
						</div>
					</div>
                    </div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-info" onclick="return validation();" id="Upload" style="display:none;">Upload</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
            
             		<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/mark/do_update' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'mark_update_form','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select name="class_name" id="class_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_student_ajax(this.value);">
                                    <option value="">Select Class</option>
                                   <?php $class_query = $this->db->get('class')->result_array();
									foreach ($class_query as $class_row): ?>
                                    <option value="<?php echo $class_row['name_numeric'];?>"><?php echo $class_row['name_numeric'];?></option>
                                	<?php endforeach; ?>	
                                     </select>
                                </div>
                            
                                <label class="col-sm-1 control-label">Student</label>
                                <div class="col-sm-2">
                                    <select name="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="student_listing">
                                    <option value="">Select Student</option>
                                  	
                                    </select>
                                </div>
                                <label class="col-sm-1 control-label">Exam</label>
                                <div class="col-sm-2">
                                    <select name="exam_name" id="exam_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Exam</option>
                                   <?php
								                  $this->db->distinct('name');
												  $this->db->group_by('name');
								    $exam_query = $this->db->get('exam')->result_array();
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
			</div>
			<!----CREATION FORM ENDS-->
        </div>
      </div>
    </div>
<!-- End option 1  -->   
 
<!-- Start option 2  -->    
    <!--<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		Option 2
            	</div>
            </div>
			<div class="panel-body">
				<?php echo form_open(base_url() . 'index.php?admin/mark/import_excel/' , array('class' => 'form-horizontal validate', 'enctype' => 'multipart/form-data'));?>
						<div class="error-msg"><i>Use provided template</i></div>
    				<div class="form-group">
                                <label class="col-sm-3 control-label">Select Year</label>
                                <div class="col-sm-3">
                                    <select name="year_name" id="year_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Year</option>
                                    <option value="<?php echo date("Y",strtotime("-1 year")); ?>"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    <option value="<?php echo date("Y"); ?>" selected="selected"><?php echo date("Y"); ?></option>
                                    <?php
									 $total_next_year=1;
									 for($i=1; $i<=$total_next_year; $i++){ ?>
                                    <option value="<?php echo date("Y",strtotime("+".$i."year")); ?>"><?php echo date("Y",strtotime("+".$i."year")); ?></option>
                                    <?php } ?>
                                     </select>
                                     <div class="error-msg" id="year_name_Err"></div>
                                </div>
                                
                            </div>
                            <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Select Class</label>
                        <div class="col-sm-3">
							<select name="class_id" id="class_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
											?>
                                    		<option value="<?php echo $row['name_numeric'];?>">
													<?php echo $row['name_numeric'];?>
                                                    </option>
                                        <?php
										endforeach;
								  ?>
                          </select>
                          <div class="error-msg" id="class_id_Err"></div>
						</div> 
                        
					</div>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Choose Marksheet</label>
						<div class="col-sm-3">
                        	<input type="file" name="userfile" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="userfile">
                            <div class="error-msg" id="userfile_Err"></div>
                        </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-info" onclick="return validation();">Upload</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>

    </div>-->
<!-- End option 2  --> 
    
</div>

<script type="text/javascript">

function get_exam(class_id){
$.ajax({
	url: '<?php echo base_url();?>index.php?admin/get_exam_name/' + class_id,
	type: "POST",
	success: function(response)
	{
		jQuery('#exam_list').html(response);
	}
});
}

function get_student_ajax(class_id) {
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_student_name/' + class_id ,
            success: function(response)
            {
                jQuery('#student_listing').html(response);
            }
        });
   }
$("#mark_update_form").submit(function( event ) {
	event.preventDefault();
  var class_name=$("#class_name").val();
  var student_name=$("#student_listing").val();
  var exam_name=$("#exam_name").val();
  if(class_name !="" && student_name != "" && exam_name != ""){
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_exam_data_table/',
				data: { student_name:student_name,exam_name:exam_name,list:'exam_result' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});
 		 }
		});


function validation(){
	var err=true;
	if (!(/\.(xlsx|xls|xlsm)$/i).test(document.getElementById("userfile").value) && document.getElementById("userfile").value != ""){ 
		document.getElementById("userfile_Err").innerHTML="Please upload excel file format.";
		err=false;
	}
	else{document.getElementById("userfile_Err").innerHTML="";}
	if(err=false)
	{ return false; }
	else
	{	return true;  }
	
}
function validation_download()
{
	var class_id=document.getElementById("class_id").value;
	var exam_list=document.getElementById("exam_list").value;
	var year_name=document.getElementById("year_name").value;
	
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
	 	var myurl='<?php echo base_url(); ?>index.php?admin/download_mark_excelsheet/'+class_id+'/'+encodeURIComponent(exam_list)+'/'+encodeURIComponent(year_name);
		location.href = myurl;
		return true;
	}
	
}
$(document).ready(function() {
	$("#download_show-hode").hide();
		$(document).click(function(){
   			if($("#year_name").val()!="" && $("#class_id").val()!="" && $("#exam_list").val()!="" ){
				$("#download_show-hode").show();
				$("#choose_excel").show();
	  		 }else{$("#download_show-hode").hide(); $("#choose_excel").hide();}
			 
	   });
	   $("#download_button").click(function(){
		   $("#Upload").show();
		});   
	});
var timeout = setTimeout(reloadChat, 1000);
function reloadChat () {
	if($("#year_name").val()!="" && $("#class_id").val()!="" && $("#exam_list").val()!="" ){
	$("#download_show-hode").show();
	}else{$("#download_show-hode").hide();}
}
function get_exam1(exam){}

</script>

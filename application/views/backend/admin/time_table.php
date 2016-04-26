

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			
			<li class="active">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Create Time Table
                    	</a></li>
            <li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					 Time Table Listing
                    	</a></li>
            <li>
           	  <a href="#replicate" data-toggle="tab"><i class="entypo-menu"></i> 
					 Replicate  Subject
           	  </a></li>           
</ul>
    	<!------CONTROL TABS END------>
        
	
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane" id="list">
			<form action="" method="post" id="time_table_form_list" class="form-horizontal validate"> 

            <div class="form-group">
                                <label class="col-sm-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select name="class_filter" id="class_id" class="form-control" style="width:100%;">
                                        <option value="">Select Class</option>
                                    	<?php 
										$this->db->distinct();
										$this->db->select('class_id');
                    $this->db->order_by('class_id');
										$classes = $this->db->get('time_table')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                                <label class="col-sm-1 control-label">Month</label>
                                <div class="col-sm-2">
                                 <select name="month" id="month" class="form-control" onchange="return weekCount(this.value);">
                                 <option value="">Select Month</option>
                        		 <option value="1">January </option>
                                 <option value="2">February </option>
                                 <option value="3">March</option>
                                 <option value="4">April</option>
                                 <option value="5">May </option>
                                 <option value="6">June</option>
                                 <option value="7">July </option>
                                 <option value="8">August </option>
                                 <option value="9">Septmber </option>
                                 <option value="10">October </option>	
                                 <option value="11">November</option>	
                                 <option value="12">December </option>	
                                 
                        		 </select>
                                </div>
                                <label class="col-sm-1 control-label">Week</label>
                                <div class="col-sm-2">
                                 <select name="week" id="week" class="form-control">
                                     <option value="">Select Week</option>
                                 </select>
                                </div>
                                <div class="col-sm-2">
                                <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                      		<div id="get_data_table"></div>
            </form>
            </div>
            <!----TABLE LISTING ENDS--->
            
             <!----Replicate  Subject STARTS-->
            <div class="tab-pane" id="replicate">
			<?php echo form_open(base_url() . 'index.php?admin/time_table/replicate' , array('class' => 'form-horizontal validate','target'=>'_top'));?>
            			<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                  <div class="form-group">
                                <label class="col-sm-2 control-label">Class<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="class_id_replicate" id="class_id_replicate" class="form-control" style="width:100%;"   data-validate="required">
                                        <option value="">Select Class</option>
                                    	<?php 
										$classes_replicate = $this->db->get('class')->result_array();
										foreach($classes_replicate as $row):
										?>
                                    		<option value="<?php echo $row['name_numeric'];?>"><?php echo $row['name_numeric'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                                 </div>
                                <div class="form-group">
                                <label class="col-sm-2 control-label">Old Date<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                 <input type="text" name="old_date" id="old_date" class="form-control datepicker" 
                                     data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-2 control-label">New Date<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                 <input type="text" name="new_date" id="new_date" class="form-control datepicker" 
                                     data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-2">
                                <button type="submit" class="btn btn-info">Replicate</button>
                                </div>
                            </div>
                      		<div id="get_data_table"></div>
            </form>
            </div>
            <!----Replicate  Subject ENDS--->
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box active" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/time_table/create' , array('class' => 'form-horizontal validate','target'=>'_top'));?>
                            <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Class<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="class_id" class="form-control" style="width:100%;"
                                        onchange="return get_class_subject(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Class</option>
                                    	<?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['name_numeric'];?>"><?php echo $row['name_numeric'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subject<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="subject_id" class="form-control" style="width:100%;" id="subject_selection_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value="">Select Class First</option>
                                    	
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teacher<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="teacher_id" class="form-control" style="width:100%;"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="get_teacher">
                                        <option value="">Select Teacher</option>
                                    	
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" name="date" id="date" class="form-control datepicker" 
                                     data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Start Time<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                <input type="text" name="time_start" id="start_time" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">End Time<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                <input type="text" name="time_end" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />  
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
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
$("#time_table_form_list").submit(function(e){
    e.preventDefault();
  
  var class_id=$("#class_id").val();
  var month=$("#month").val();
  var week=$("#week").val();
    $.ajax({
        url: '<?php echo base_url();?>index.php?admin/get_time_table_data/',
        data: { class_id:class_id,month:month,week:week},
        type: "POST",
        success: function(response)
        {
          jQuery('#get_data_table').html(response);
        }
      });   
});
$('#subject_selection_holder').change(function() {
  var subject=$("#subject_selection_holder").val();
  $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_teacher_using_subject/' + subject ,
            success: function(response)
            {
                jQuery('#get_teacher').html(response);
            }
        });
});

function weekCount(month_number) {
  $('#week').find('option:not(:first)').remove();
   $.ajax({
    type:"POST",
            url: '<?php echo base_url();?>index.php?admin/getweeks/',
   data:'month='+month_number,
   success: function(response)
            {
   // alert(response);
    //var week =  response;
    for(var i=1; i<=response;i++)
     {
     
     $("#week").append('<option value='+i+'>'+i+'</option>');
      
     }
         }
       });
}


</script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css">
<script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>

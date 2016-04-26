
<script type="text/javascript">
	jQuery(document).ready(function($){
		var datatable = $("#table_export").dataTable();		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});	
	});
	</script>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Subject List
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					Add Subject
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">	
				 <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?><span class="mandatory">*</span></label>
                    <div class="col-sm-5">
                    <select name="class_id" class="form-control" style="width:100%;" data-validate="required" onchange="return get_class(this.value);">
                        <option value="">Select Class</option>
                        <?php 
                        for($i=1;$i<=12;$i++){?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div> 
            <div id="get_data_table">
            </div>
				
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject_name');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" style="width:100%;" data-validate="required" >
										<option value="">Select Class</option>
                                    	<?php 
										for($i=1;$i<=12;$i++){
										?>
                                    		<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php
										}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?><span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="teacher_id" class="form-control" style="width:100%;" data-validate="required" >
										<option value="">Select Teacher</option>
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
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
</script>
<script>
 jQuery(document).ready(function() {
	  jQuery("#deletesall").click(function(){
		var student_length =  $(".checkbox1:checked").length;
		
		   if(student_length < 1)
			{
				 alert('Please select at least one!');
				return false;	 
			}
			  
			var r = confirm("Do you want to delete selected data?");
								
								if (r == true) {
									
								} else {
								
								   return false;
								}		
								});
  jQuery('#selecctall').click(function(event) {  
 
   if(this.checked) { 
    jQuery('.checkbox1').each(function() { 
     this.checked = true;          
    });
    }else{
    jQuery('.checkbox1').each(function() { 
     this.checked = false;               
    });         
   }
  });
  
  jQuery(".checkbox1").click(function(){
   if($(".checkbox1").length == $(".checkbox1:checked").length) {
    jQuery("#selecctall").prop("checked",true);
    } else {
    jQuery("#selecctall").prop("checked",false);
   }
   
  }); 
  
 });
 function get_class(class_id){
    $.ajax({
                url: '<?php echo base_url();?>index.php?admin/get_data_table/',
                data: { class_id: class_id,list:'subject' },
                type: "POST",
                success: function(response)
                {
                    jQuery('#get_data_table').html(response);
                }
            });
 }
</script>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      

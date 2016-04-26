
<script type="text/javascript">
function get_subject(class_id) {   
		$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
				success: function(response)
				{
					jQuery('#subject_listing').html(response);
				}
			});
   }
</script>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css">
<script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_exam');?>
                </a>            	
			</li>
			<li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('exam_list');?>
                </a>
			</li>
            <li>
            	<a href="#exam_master" data-toggle="tab"><i class="entypo-menu"></i> 
					Master Exam
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box" id="list">
            <form action="<?php echo  base_url().'index.php?admin/delete_exam'; ?>" method="post">	
              
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<!--<tr>
                    		<th>Select Exam</th>                    		
                    		<th>Select Class</th>                    		
						</tr>-->
						<tr>
                                      
                         </th>
                    		<th><div>Exam name</div></th>                    		
                    		<th><div>Class</div></th>
                    		<th><div>subject</div></th>
							<th><div>Date</div></th>
                            <th><div>Start time</div></th>
                            <th><div>End time</div></th>
                            <th><div>Maximum marks</div></th>
                    		<th><div>Options</div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                        $year_start_date=$this->session->userdata('start_date');
                        $year_end_date=$this->session->userdata('end_date');
                           $exams=$this->db->get_where('exam',array('created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array();  
                         foreach($exams as $row):
					       $exam_sub=$this->db->get_where('subject' , array('subject_id' => $row['subject_id']) )->row();
						?>
                        <tr>
                          
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['class_id'];?></td>
							<td><?php echo $exam_sub->name;?></td>
							<td><?php echo date("F d, Y",strtotime($row['date']));?></td>
                            <td><?php  $string = str_replace(' ', '', $row['time_start']);
							echo $string;
							?></td>
                            <td><?php  $string2 = str_replace(' ', '', $row['time_end']);
							echo  $string2;
							?></td>
                            <td><?php echo $row['out_of_marks'];?></td>
							<td>
                             <?php $get_exam=$this->db->get_where('mark',array('exam_id'=>$row['name'],'subject_name'=>$row['subject_id']))->num_rows(); 
							if($get_exam>0){
							}else{
							?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-pencil"></i><?php echo get_phrase('edit');?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="javascript:void(0)" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam/delete/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-trash"></i><?php echo get_phrase('remove');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php }?>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>	
                 
                </form>
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
</script>			
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box  active" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/exam/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                       <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Exam<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <select name="name"style="width:100%;" class="form-control" data-validate="required" id="name" data-message-required="<?php echo get_phrase('value_required');?>">
										<option value="">Select Name</option>
											<?php 
										$exam_master = $this->db->get('exam_master')->result_array();
											foreach($exam_master as $row1):
											?>
											<option value="<?php echo $row1['master_exam_name'];?>"><?php echo $row1['master_exam_name'];?></option>
											<?php endforeach;  ?>
									</select>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Class<span class="mandatory">*</span></label>
								<div class="col-sm-5">	
									<select name="class_id"style="width:100%;" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_subject(this.value)">
										<option value="">Select Class</option>
											<?php 
												$this->db->select('class_id');
												$this->db->distinct();
												$classes = $this->db->get('subject')->result_array();
												foreach($classes as $row):
											?>
											<option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
											<?php endforeach;  ?>
									</select>	
								</div>
							</div>		
							<div class="form-group">
								<label class="col-sm-3 control-label">Subject<span class="mandatory">*</span></label>
								<div class="col-sm-5">
									<select name="subject_id" style="width:100%;" class="form-control" data-validate="required" id="subject_listing" data-message-required="<?php echo get_phrase('value_required');?>">	
										<option value="">Select Subject</option>					
									</select>
								</div>
							</div>	
                            <div class="form-group">
                                <label class="col-sm-3 control-label" >Date<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                           <div class="form-group">
                                <label class="col-sm-3 control-label">Start Time<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" name="time_start" id="start_time" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">End Time<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" name="time_end" class="form-control timepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" >Maximum marks<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="out_of_marks" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" maxlength="3"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" >Minimum passing marks<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="minimum_mark" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" maxlength="3"/>
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
           <div class="tab-pane box" id="exam_master" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/exam/exam_master' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                       <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Exam Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="master_exam_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
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
</div>

<style>
#uploadForm {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
#uploadForm label {margin:2px; font-size:1em; font-weight:bold;}
.demoInputBox{padding:5px; border:#F0F0F0 1px solid; border-radius:4px; background-color:#FFF;}
#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
.btnSubmit{background-color:#09f;border:0;padding:10px 40px;color:#FFF;border:#F0F0F0 1px solid; border-radius:4px;}
#progress-div {    border-radius: 4px; float: right;   text-align: center; width: 50%;}
#targetLayer{width:100%;text-align:center;}
#loader-icon {display:none;}
</style>
<div class="row">
	<div class="col-md-12">        
			  
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?teacher/share_material/create' , array('class' => 'form-horizontal form-groups-bordered validate','id'=>'uploadForm','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        <div class="padded">                            
							<div class="form-group">                              
									<label class="col-sm-3 control-label">Upload File:</label>									
										<div class="col-sm-5">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="width:100px;height:50px;" data-trigger="fileinput">
													<img src="<?php echo base_url();?>/assets/images/upload_bk.png" alt="...">
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;height:20px"></div>
												<div>
													<span class="btn btn-white btn-file">
														<span class="fileinput-new">Select Material</span>
														<span class="fileinput-exists">Change</span>
														<input type="file" id="userImage" name="m_filename" accept=".pdf,.doc,.txt,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" />
													</span>
													<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>										
										</div>
                                        <div class="form-group">
                                    <div class="col-sm-5">     	
									<div id="progress-div"><div id="progress-bar"></div></div>
									<div id="targetLayer"></div>
                                    </div>
                                    </div>
									<!--<div id="loader-icon" style="display:none;"><img src="<?php echo base_url();?>/assets/images/upload.gif" /></div>-->
                            </div>							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" style="width:100%;" onchange="return get_class_subject(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                    	<?php 
										$this->db->select('class_id');
										$this->db->distinct();
										$classes = $this->db->get('subject')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                                <div class="col-sm-5">
                                    <select name="subject_id" class="form-control" style="width:100%;" id="subject_selection_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
                                    </select>
                                </div>
                            </div>					
							<div class="form-group">
                                <label class="col-sm-3 control-label">Topic Name</label>
                                <div class="col-sm-5">
                                     <input type="text" class="form-control" name="topic_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>                          
							<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('login_user_id'); ?>">
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">							  
                                  <button type="submit" id="btnSubmit" class="btn btn-info">Click to Upload</button>
                              </div>
						</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
			
			
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Class Name</div></th>
							<th><div>Subjects</div></th>
                    		<th><div>Topic Name</div></th> 
                            <th><div>File Name</div></th>
							<th><div>Download</div></th> 							
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach(@$share_material as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>							
							<td><?php echo $row['class_id']; ?></td>
							<td><?php $subjectName=$this->db->get_where('subject',array('subject_id'=>$row['subject_id']))->row();  echo $subjectName->name;?>					</td>
							<td><?php echo $row['topic_name'];?></td>
                            <td><?php echo $row['m_filename']; ?></td>
							<td><a href="material_download.php?file_name=<?php echo $row['m_filename'];?>" class="links"><button type="button" class="btn btn-info">Download</button></a></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu"> 
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/share_material/delete/<?php echo $row['material_id'];?>');">
                                            <i class="entypo-trash"></i>
                                               Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
	</div>
</div>

<!---- Class  Subject Filter ---->

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
</script>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		jQuery('#progress-div').hide();
		var datatable = $("#table_export").dataTable({"bFilter": false});
			$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		$('#example').dataTable( {
				paging: false,
				searching: false
		} );
		
	});	

</script>
<script src="<?php echo base_url();?>assets/js/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() { 
    jQuery('#uploadForm').submit(function(e) {	
	jQuery('#progress-div').show();
        if(jQuery('#userImage').val()) {
            e.preventDefault();
            jQuery('#loader-icon').show();
            jQuery(this).ajaxSubmit({ 			
                target:   '#targetLayer', 
                beforeSubmit: function() {
                    jQuery("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){	
                    jQuery("#progress-bar").width(percentComplete + '%');
                    jQuery("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                success:function (){
                    //jQuery('#loader-icon').hide();
                    jQuery('#progress-status').hide();
					jQuery('#progress-div').hide();
					window.location.href = '<?php echo base_url();?>index.php?teacher/share_material';
                },
                resetForm: true 				
				
            }); 
            return false; 
        }
    });
});	
</script>
<div class="row">
	<div class="col-md-12">        
           <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Module Name</div></th>
							<th><div>Download</div></th> 
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;
						$modules = $this->db->get('csv_import')->result_array();
						foreach ($modules as $modules_rows): 
						?>
                        <tr>
                            <td><?php echo $count++;?></td>	
							<td><?php echo $modules_rows['module_name'];?></td>
							<td><a class="links" href="<?php echo base_url(); ?>/index.php?admin/import/download/<?php echo $modules_rows['module_name_file'];?>"><button title="Download" class="btn btn-info" id="btnSubmit" type="button">Download</button></a>
							</td>
					    </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->	
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                <?php echo form_open(base_url() . 'index.php?admin/import/data' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    <div class="padded">
							<div class="form-group">
                                <label class="col-sm-3 control-label">Select Module</label>
                                <div class="col-sm-3">
                                    <select name="module_id" class="form-control" id="module_selection_holder" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Module</option>
                                    <?php $import_csv=$this->db->get('csv_import')->result_array();foreach($import_csv as $import_csv_row):  ?>
                                    
                                    <option value="<?php echo $import_csv_row['module_name_file'];?>_sample"><?php echo $import_csv_row['module_name'] ;?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>  	
							<div class="form-group">                              
									<label class="col-sm-3 control-label">CSV Imoport:</label>								
										<div class="col-sm-5">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
													<img src="<?php echo base_url();?>/assets/images/upload_bk.png" alt="...">
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
												<div>
													<span class="btn btn-white btn-file">
														<span class="fileinput-new">Select CSV</span>
														<span class="fileinput-exists">Change</span>
														<input type="file" id="userImage" name="userfile" accept=".csv"/>
													</span>
													<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
												</div>
											</div>										
										</div>	
									<!--<div id="progress-div"><div id="progress-bar"></div></div>
									<div id="targetLayer"></div>
									<div id="loader-icon" style="display:none;"><img src="<?php echo base_url();?>/assets/images/upload.gif" /></div>-->
                            </div>       
							<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('login_user_id'); ?>">
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">							  
                                  <button type="submit" id="btnSubmit" class="btn btn-info">Click to Upload</button>
                              </div>
						</div>
                </form>
            
            <br><br>
			   </div>                
			</div>
			<!----CREATION FORM ENDS-->
	</div>
</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		//jQuery('#progress-div').hide();
		var datatable = $("#table_export").dataTable({paging: true,searching: true});
			$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});	
</script>

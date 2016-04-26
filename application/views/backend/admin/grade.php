
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		$('#example').dataTable( {
				paging: false,
				searching: false
		});
		$("#holiday_date").datepicker({
                minDate: 0
        });
    });
</script>
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Grade List
                </a>
            </li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
			     	Add Grade 
                </a>
            </li>
		</ul>
    	<!--CONTROL TABS END-->
		<div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            <form action="<?php echo  base_url().'index.php?admin/delete_grade'; ?>" method="post">	
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                           <th>Select All<input type="checkbox" id="selecctall" name="class_ids"  />                      
                         </th>
                    		<th><div>#</div></th>
                    		<th><div>Grade Name</div></th>
                    		<th><div>From Mark</div></th>  
                            <th><div>To Mark</div></th>
                    		<th><div>Options</div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;
                         $grade=$this->db->get('grade')->result_array();   
                         foreach($grade as $row):?>
                        <tr>
                           <td><input type="checkbox" name="delete_id[]" value="<?php echo $row['grade_id'];?>" class="checkbox1" /></td>
                            <td><?php echo $count++;?></td>							
							<td><?php echo $row['grade_name'];?></td>
							<td><?php echo $row['from_mark']."%";?></td>
                            <td><?php echo $row['to_mark']."%";?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_grade/<?php echo $row['grade_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/grade/delete/<?php echo $row['grade_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('Remove');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                 <table>
                <tr><td><input type="submit" name="delete_all" id="deletesall" class="btn btn-info"  value="Remove All"  /></td></tr>
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
			if (r == true) 
            {
			
            }
            else
            {
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
            <!--TABLE LISTING ENDS-->
			<!-- CREATION FORM STARTS-->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/grade/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">                            
							<div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Grade Name<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
									 <input type="text" class="form-control" name="grade_name" data-validate="required" maxlength="2" data-message-required="Grade name is required"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">From Marks<span class="mandatory">*</span></label>
                                <div class="col-sm-5">
                                     <input type="text" class="form-control" placeholder="In (%)" maxlength="3" name="from_mark" data-validate="required,number" data-message-required="From mark is required"/>
                                </div>
                            </div>                          
					   </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">To Marks<span class="mandatory">*</span></label>
                            <div class="col-sm-5">
								<input type="text" class="form-control" name="to_mark" placeholder="In (%)" maxlength="3" data-validate="required,number" data-message-required="To mark is required"/>
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
			<!--CREATION FORM ENDS-->
		</div>
	</div>
</div>
<!--DATA TABLE EXPORT CONFIGURATIONS-->                      

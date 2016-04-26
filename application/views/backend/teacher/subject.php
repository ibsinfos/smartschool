<div class="row">
	<div class="col-md-12">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            <div class="padded">
			  <form action="" method="post">
                 <div class="form-group">
                   <label class="col-sm-1 control-label">Class</label>
                <div class="col-sm-3">
              	<select name="class_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_subject_list(this.value);">
                   <option value="">Select Class</option>
                        <?php 
                        for($i=1;$i<=12;$i++){?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php } ?>
                 </select>
                 </div>
                 <div class="col-sm-9">
                 </div>
                </div>
              </form>
             </div>
              
                <div id="get_data_table">
                </div>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">
	function get_subject_list(class_id) {
    	 $.ajax({
				url: '<?php echo base_url();?>index.php?teacher/get_subject_data_table/',
				data: { class_id: class_id,list:'subject' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});
	 }
	jQuery(document).ready(function($){
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>
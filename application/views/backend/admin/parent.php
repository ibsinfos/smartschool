<style>
.DTTT.btn-group{display:none;}
</style>
	<p id="renderingEngineFilter"></p>
            <!--<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_parent_add/');" 
                class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
                <?php echo get_phrase('add_new_parent');?>
                </a> 
                <br><br>-->
                <div class="panel-body">
            <div class="form-group">
            <div class="col-sm-3">
            <form action="" method="post" id="search_dropdown">
           	<select class="form-control" name="class_name_datatable" id="class_name_datatable" onchange="return class_data_table(this.value);">
            	<option value="">Select Class</option>
                <option value="0">All Class</option>
                <?php 
								$this->db->distinct("name_numeric");
								$this->db->select("name_numeric");
								$this->db->join('parent', 'parent.class_id = class.name_numeric');
								$classes =$this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
				<option value="<?php echo $row['name_numeric'];?>"><?php echo $row['name_numeric'];?></option>
								<?php endforeach; ?>	
            </select>
            </div>
             <div class="col-sm-3">
           	<select class="form-control" name="student_name_datatable" id="student_name_datatable">
            	<option value="">Select Student</option>
                <!--<option value="0">All Student</option>-->
            </select>
             </div>
              <div class="col-sm-3">
            <button type="submit" class="btn btn-info" name="search_dropdown" id="search_dropdown">Search</button>
            </div>
            </form>
             <div id="test_div"></div>
            </div>
          </div>
          <div id="get_data_table"></div>
               

<!---  DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">
    jQuery(document).ready(function($)
    {
        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    
                    {
                        "sExtends": "xls",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(5, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(5, true);
                                  }
                            });
                        },
                        
                    },
                ]
            },
            
        });
        
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

 function class_data_table(class_id){
		    $.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_student_name/'+class_id,
				success: function(response)
				{
					jQuery('#student_name_datatable').html(response);
				}
			});
	 }
$( document ).ready(function() {	 
$("#search_dropdown").submit(function( event ) {
	event.preventDefault();
  var class_name_datatable=$("#class_name_datatable").val();
  var student_name_datatable=$("#student_name_datatable").val();
 $.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_alldata_table/',
				data: { class_id: class_name_datatable,student_id:student_name_datatable,list: 'parent' },
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});		
});
});
</script>



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
            url: '<?php echo base_url();?>index.php?student/get_class_subject/' + class_id ,
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
					window.location.href = '<?php echo base_url();?>index.php?student/share_material';
                },
                resetForm: true 				
				
            }); 
            return false; 
        }
    });
});	
</script>
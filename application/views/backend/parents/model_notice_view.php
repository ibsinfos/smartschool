
<?php 
 $edit_data		=	$this->db->get_where('noticeboard' , array('notice_id' => $param2))->result_array();
 $data['notice_read']          = 1; 
 $this->db->where('notice_id' , $param2);
 $this->db->update('noticeboard' , $data);
foreach ( $edit_data as $edrow):
?>
<style>
.modal-header{visibility:hidden;}
</style>
<div class="row">
	<div class="col-md-12 smnoti">	
		<div class="modal-header12">
			<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			<h4 class="modal-title">Smart School system</h4>
		</div>		
		<!--<div class="panel-heading">
            	<div class="panel-title" >            	
					Read Notification
            	</div>
       </div>-->
		<div class="modal-dialog">					
			<!-- Modal content-->				
				 <div class="form-group">									 
					  <p><textarea readonly="" class="form-control wysihtml5" row="2"><?php echo $edrow['notice'];?></textarea></p>
				</div>			  
		</div>
	</div>
</div>
<?php
endforeach;
?>	
<script>
$(function () {
    $(".close").on('click', function() {		
        window.location.reload();
        return false;
    });
});
</script>
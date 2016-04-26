<?php 
 $edit_data		=	$this->db->get_where('noticeboard' , array('notice_id' => $param2))->result_array();
 $data['notice_read']          = 1; 
 $this->db->where('notice_id' , $param2);
 $this->db->update('noticeboard' , $data);
foreach ( $edit_data as $edrow):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
               <i class="entypo-plus-circled"></i>
					Notification
            	</div>
            </div>
			<div class="panel-body">
            <div class="form-group">									 
					  <p><textarea readonly="" class="form-control wysihtml5" row="2"><?php echo $edrow['notice'];?></textarea></p>
				</div>
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
	$("#close").on('click', function() {		
        window.location.reload();
        return false;
    });
});
</script>

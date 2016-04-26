    <script type="text/javascript">
	function showAjaxModal(url,data)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		// LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
			type:"POST",	
			url: url,	
			data : data,
			success: function(response)
         	{
        		jQuery('#modal_ajax .modal-body').html(response);
                //jQuery('.tab-content .panel-body .padded').append('<div class="form-group mandatory"> * Fields are mandatory </div>');
	   		}
		});
	}
	</script>
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $system_name;?></h4>
                </div>
                <div class="modal-body" style="height:500px; overflow:auto;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	</script>
    <!--(Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"> Are you sure of deletion ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">Remove</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-5">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"> Do You Want To Save This Report?</h4>
                </div>
                 <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button type="button" class="btn btn-info" data-dismiss="modal" value="yes" id="yes"    ><?php echo get_phrase('Yes');?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" value="no" id="no"><?php echo get_phrase('No');?></button>
                </div>
            </div>
        </div>
    </div>
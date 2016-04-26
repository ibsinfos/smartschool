	<div class="modal-dialog">					
			
			<!-- Modal content-->
			<form name="frmreply" id="frmreply" method="post" action="<?=base_url()?>/index.php?student/message/send_reply/<?=$msg[0]->message_thread_code ?>" >
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<input type="hidden" id="txttype" name="txttype" value=""/>
					<input type="hidden" id="txttypeid" name="txttypeid" value=""/>
				</div>
				
				<div class="modal-body">
					
					<p>Name : <span id="mail_name"></span></p>	
					
					<p>Message: <textarea class="form-control wysihtml5" id="message"  name="message" cols="30" rows="15" placeholder="reply"></textarea></p>
					<input type="submit" name="btnreply" id="btnreply" value="Reply" class="btn btn-success btn-icon pull-right" >
				</div>
			</div>								  
			</form>
		</div>
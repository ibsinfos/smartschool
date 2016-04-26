<div class="modal-dialog">					
								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
									  <p><input type="text" value="<?php //echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>"/></p>	
									  <p><textarea class="form-control wysihtml5" row="2"><?php 
									  //echo "<pre/>";
									  //print_r($_POST);
									  //die;
									   ?></textarea></p>
									</div>
								  </div>								  
								</div>
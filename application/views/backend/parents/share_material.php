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
                 <?php echo form_open(base_url() . 'index.php?parents/get_share_material_data_table' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Student</label>
                                <div class="col-sm-3">
                             <select name="student_name" id="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_subject_list(this.value);">
                                    <option value="">Select Student</option>
                                    						
                                   <?php 
								 $this->db->select('student.student_id,student.name');
									$this->db->join('parent', 'parent.parent_email = student.parent_email');
									$this->db->group_by('student.student_id');
									$this->db->where('student.parent_email',$this->session->userdata('parent_email'));
									$parent_query=$this->db->get('student')->result_array();
								foreach ($parent_query as $parent_row): ?>
								<option value="<?php echo $parent_row['student_id'];?>"><?php echo $parent_row['name'];?></option>
                                	<?php endforeach; ?>	
                                     </select>
                            	</div>
                            </div>
                             
                  	</form>  
			</div>
            <!----TABLE LISTING ENDS--->
	</div>
</div>
<div id="get_data_table">
<!---- Class  Subject Filter ---->

<script type="text/javascript">
   function get_subject_list(student_id) {
		$.ajax({
			url: '<?php echo base_url();?>index.php?parents/get_share_material_data_table/',
			data: { student_id:student_id,list:'share_materail' },
			type: "POST",
			success: function(response)
			{
				jQuery('#get_data_table').html(response);
			}
		});
	}
</script>



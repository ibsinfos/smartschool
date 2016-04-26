
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div>Photo</div></th>
                            <th><div>Teacher Name</div></th>
                            <th><div>Teacher Email</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $teachers=$this->db->get('teacher' )->result_array();
                       		  foreach($teachers as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['name'];
							$teacher=$this->db->get_where('teacher',array('teaching_type'=>1,
							'teacher_id'=>$row['teacher_id']) )->row();		
								if($teacher->file_name != ""){ ?>
								<a href="download.php?file_name=<?php echo $teacher->file_name;?>" class="links"><i class="fa fa-download"></i></a><?php }?></td>
                            <td><?php echo $row['email'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage":{"sSearch": "Filter:"}});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>


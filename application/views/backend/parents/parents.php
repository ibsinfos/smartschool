
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div>Photo</div></th>
                            <th><div>Name</div></th>
                            <th><div>Email</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $parent	=$this->db->get('parent')->result_array();
                                foreach($parent as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('parent',$row['parent_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['name'];?></td>
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


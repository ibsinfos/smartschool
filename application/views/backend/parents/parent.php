
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>Name</div></th>
                            <th><div>Email</div></th>
                            <th><div>Phone</div></th>
                            <th><div>Address</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						        $parent=$this->db->get_where('parent',array('parent_id'=>$this->session->userdata('parent_id')))->result_array();
                                foreach($parent as $row):?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['parent_email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['address'];?></td>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({bFilter: false, bInfo: false,bPaginate: false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>


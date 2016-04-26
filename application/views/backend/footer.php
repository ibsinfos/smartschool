<!-- Footer -->
<footer class="main">
<?php $get_system_name=$this->db->get('settings')->row();  ?>
	&copy; <?php echo date("Y"); ?> <strong><?php echo $get_system_name->description;   ?></strong>. 
    Developed by 
	<a href="http://searchnative.in/hosting/loreBrain/" 
    	target="_blank">Lorebrain</a>
</footer>


			</div>
			<div id="push"></div>
			<!-- End of wrap -->
		</div>
		<div class="container no-padding">
			<div id="footer">
			<p>&copy; 2014 UygunCart All rights reserved.
			<span class="pull-right">
				Page: <a href="#">Home</a> <a href="#">About</a> <a href="#">Contact</a> <a href="#">Terms and Conditions</a>
			</span></p>
			</div>
			<!-- end of footer -->
		</div>
		<script type="text/javascript">
			var base_url = '<?php echo base_url() ?>';
		</script>
		<script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.10.2.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('public/templates/default/js/bootstrap.min.js');?>"></script>
		<?php
		if(isset($js)){
			foreach ($js as $value) {
				echo '<script type="text/javascript" src="'.base_url('public/templates/default/js/'.$value).'"></script>';
			}
		}
		?>
	</body>
</html>

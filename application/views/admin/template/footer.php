			</div>
			<div id="push"></div>
	    	<!-- End of wrap -->
		</div>
		<div id="footer">
	      	<div class="container-fluid">
	        	<p class="muted credit">UygunCart</p>
	      	</div>
	      	<!-- end of footer -->
	    </div>
		<script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.10.2.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js');?>"></script>
		<?php
		if(isset($js)){
			foreach ($js as $value) {
				echo '<script type="text/javascript" src="'.base_url($value).'"></script>';
			}
		}
		?>
	</body>
</html>
			</div>
			<div id="push"></div>
			<!-- End of wrap -->
		</div>
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<h4>Information</h4>
						<ul class="list-unstyled">
							<li><a href="#">About</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">Help</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h4>Follow us on</h4>
						<ul class="list-unstyled">
							<li><a href="#">Facebook</a></li>
							<li><a href="#">Twitter</a></li>
							<li><a href="#">Google+</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h4>Categories</h4>
						<ul class="list-unstyled">
							<li><a href="#">Software</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Electronic</a></li>
							<li><a href="#">Gift</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h4>Payment</h4>
						<ul class="list-unstyled">
							<li><a href="#">Payment method</a></li>
						</ul>
					</div>
				</div>
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
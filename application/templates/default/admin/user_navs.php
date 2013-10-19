<ul class="nav nav-tabs nav-stacked">
	<li <?php echo $this->router->method == "account"  ? 'class="active"' : '' ?>><a href="<?php echo base_url('admin/user/account'); ?>">Account</a></li>
	<li <?php echo $this->router->method == "password" ? 'class="active"' : '' ?>><a href="<?php echo base_url('admin/user/password'); ?>">Password</a></li>
</ul>

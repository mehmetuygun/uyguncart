<ul class="nav nav-tabs nav-stacked">
	<li <?php echo $this->router->method == "account"  ? 'class="active"' : '' ?>><a href="<?php echo base_url('admin/setting/account'); ?>">Account</a></li>
	<li <?php echo $this->router->method == "password" ? 'class="active"' : '' ?>><a href="<?php echo base_url('admin/setting/password'); ?>">Password</a></li>
</ul>

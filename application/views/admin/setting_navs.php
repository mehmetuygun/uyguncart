<ul class="nav nav-tabs nav-stacked">
    <li <?php if($this->router->method == "account") echo 'class="active"' ?> ><a href="<?php echo base_url('admin/setting/account'); ?>">Account</a></li>
    <li <?php if($this->router->method == "password") echo 'class="active"' ?>><a href="<?php echo base_url('admin/setting/password'); ?>">Password</a></li>
</ul>
<div class="row">
    <div class="col-lg-3">
    <div class="category">
        <div class="head">Category</div>
        <ul class="nav">
            
    <?php
    $cat_list = isset($categories['']) ? $categories[''] : array();
    foreach ($cat_list as $cat) {
        echo '<li><a href="#">'.$cat['name'].'</a></li>';
    }
    ?>
        </ul>
    </div>
    </div>
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-4">
                    <select class="form-control" id="option_product">
                        <option value="latestproduct">Latest Products</option>
                        <option value="latestproduct2">Latest Products</option>
                    </select>
                </div>
                <div class="display_products">
                    
                </div>
            </div>
        </div>
    </div>
</div>
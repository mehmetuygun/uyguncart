<div class="row">
    <div class="col-lg-3">
    <?php
    $cat_list = isset($categories['']) ? $categories[''] : array();
    foreach ($cat_list as $cat) {
        echo $cat['categoryName'], '<br />';
    }
    ?>
    </div>
    <div class="col-lg-9">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Recently Added</a></li>
        </ul>
        <div id="myTabContent" class="tab-content with-frame">
            <div class="tab-pane fade active in" id="home">
            <?php
            $i = 0;
            $img_200_path = 'public/images/200/';
            $cart_url = base_url('cart');
            foreach ($products as $p) {
                if ($i % 3 == 0 && $i < 9) {
                    echo '<div class="row f-space">';
                }

                $p_url = base_url('product/id/' . $p['productID']);
                $img_src = base_url('public/images/135/' . 'noimage.jpg');
                if (isset($p['imageFullName']) && file_exists($img_200_path . $p['imageFullName'])) {
                    $img_src = base_url($img_200_path . $p['imageFullName']);
                }

                echo <<<HTML
                <div class="col-lg-4">
                    <div class="thumbnail">
                        <a class="thumbnail" href="{$p_url}">
                            <img alt="200x150" src="{$img_src}" />
                        </a>
                        <div class="caption">
                            <h4><a href="{$p_url}">{$p['productName']}</a></h4>
                            <h4><span class="price">\${$p['productPrice']}</span></h4>
                            <form action="{$cart_url}" method="post">
                                <input type="hidden" value="{$p['productID']}" name="productID" />
                                <button type="submit" class="btn btn-danger" style="width:100%">
                                    Add To Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
HTML;
                if ($i % 2 == 0 && $i > 0) {
                    echo '</div>';
                }
                $i++;
            }
            ?>
            </div>
        </div>
    </div>
</div>

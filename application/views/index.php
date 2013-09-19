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
            $i=0;
            while ($i<9) {
                if($i%3 == 0)
                    echo '</div>';

                if($i == 0 or $i%3 == 0 and $i!=9)
                    echo '<div class="row f-space">';

                echo '<div class="col-lg-4">
                        <div class="thumbnail">
                            <img  alt="200x150"/>
                            <div class="caption">
                                <h4><a href="#">Maclaren Rocker Black Champaigne</h4>
                                <h4><span class="price">500 $</span></h4>
                                <p><a href="#" class="btn btn-danger" style="width:100%">Add To Cart</a></p>
                            </div>
                        </div>
                    </div>';

                // echo '<div class="col-lg-4">
                //         <div class="thumbnail">
                //             <img  alt="200x150" src="'.$recenltyAdded[$i]["imgSrc"].'"/>
                //             <div class="caption">
                //                 <h4><a href="'.base_url('product/id/'.$recenltyAdded[$i]["productId"]).'">'.$recenltyAdded[$i]["productName"].'</h4>
                //                 <h4><span class="price">'.$recenltyAdded[$i]["productPrice"].'</span></h4>
                //                 <p><a href="#" class="btn btn-danger .f-add-to-cart ">Add To Cart</a></p>
                //             </div>
                //         </div>
                //     </div>';

                $i++;
            } // end while
            ?>
            </div>
        </div>
    </div>
</div>

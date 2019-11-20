<?php include "header.php"; ?>

<!-- breadcrumb -->
<div id="breadcrumb" class="container">
    <a href="<?php echo $set['url']; ?>" class=" cl8 hov-cl1 trans-04">
        Home
    </a>
    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    <span class=" cl4">
        Category
    </span>
</div>
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Category
            </h3>
        </div>

        <!-- Banner -->
        <div class="sec-banner bg0 p-t-80 p-b-50">
            <div class="container">
                <div class="row">
                    <?php
                    $category_query = $mysqli->query("SELECT * FROM category_product");
                    while ($catdata = $category_query->fetch_array()) {
                        $id = $catdata['id'];
                        $url = $catdata['category_url'];
                        $name = $catdata['category_name'];
                        $icon = $catdata['category_icon'];

                        echo '
                        <div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
                            <!-- Block1 -->
                            <div class="block1 wrap-pic-w">
                                <img src="' . $set['url'] . 'images/source/' . $icon . '" alt="' . $name . '">

                                <a href="'.$set['url'].'category/'.$url.'" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                    <div class="block1-txt-child1 flex-col-l">
                                        <span class="block1-name ltext-102 trans-04 p-b-8">
                                            ' . $name . '
                                        </span>

                                        <!-- <span class="block1-info stext-102 trans-04">
                                                Spring 2018
                                            </span> -->
                                    </div>

                                    <div class="block1-txt-child2 p-b-4 trans-05">
                                        <div class="block1-link stext-101 cl0 trans-09">
                                            Shop Now
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        ';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
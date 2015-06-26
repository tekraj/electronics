        <div class="container">
            <div class="products">
    <!--             <div class="col-md-12 brand_product">
                    <div class="col-md-8">
                        <h2 class=" products-in"><?php echo !empty($categoryData) ? ucfirst($categoryData->title) : '';
                    echo !empty($brandData) ?' / '.ucfirst($brandData->name) :''; ?></h2>
                        
                    </div>
                    <div class="col-md-2 brand_image">
                        <img src='<?php echo $brandData->image; ?>' class="img-responsive">
                    </div>
                    <div class="col-md-2"></div>
                </div> -->

                    <div class=" top-products">
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-offset-4">
                        <img src='<?php echo !empty($brandData) ? $brandData->image : ''; ?>' class="img-responsive">
                        </div>
                    </div>
                    
                    <h2 class="products-in">All <?php echo !empty($brandData) ? $brandData->name : ' '; echo !empty($categoryData) ? ' '.ucfirst($categoryData->title) : 'Products' ?> </h2>
                    <?php
                    $divCount=1;
                    foreach($allProducts as $product):
                    ?>
                        <div class="col-md-3 md-col">
                            <div class="col-md">
                                <a href="<?php echo link_url.'product/'.$product->url; ?>" class="compare-in"><img  src="<?php echo $product->featured_image; ?>" alt="" />
                                <div class="compare">
                                </div>
                                </a>    
                                <div class="top-content">
                                    <h5><a href="<?php echo link_url.'product/'.$product->url; ?>"><?php echo $product->name; ?></a></h5>
                                    <div class="white">
                                        <a href="<?php echo link_url.'product/'.$product->url; ?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2">Buy Now</a>
                                        <p class="dollar"><span class="in-dollar">$</span><span><?php echo $product->price; ?></span></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    <?php if($divCount % 4==0): ?>
                        <div class="clear"></div>
                    <?php endif; ?>
                    <?php
                    $divCount++;
                    endforeach; 
                     ?>
                    <div class="clearfix"></div>
                    </div>
            </div>
        </div>



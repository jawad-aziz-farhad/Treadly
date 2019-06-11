<?php get_header(); ?>    

    

<div class="content-section mb-4">
    <div class="container">        
    
        <div class="row" id="filterRow">
            <div class="col text-center">
                <button type="button" class="btn btn-block full-specs" data-target="#filterSection"
                data-toggle="collapse" aria-expanded="false" aria-controls="filterSection" id="filterBtn" style="font-size: 16px;">
                <i class="fa fa-chevron-down" style="float: right;"></i>
                Find out your bike
                </button>            
            </div>
        </div>

        <!-- START COLLAPSE SECTION -->
        <div class="collapse" id="filterSection">
            <?php get_template_part('filter-section'); ?>
        </div>


        <div class="row" id="main_container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="col-md-3">
                    <div class="top product" data-toggle="tooltip" title="<?php echo get_the_title(); ?>">
                        <div class="prod-img"> 
                            <?php 
                            if ( has_post_thumbnail() ) {
                               echo the_post_thumbnail();
                            }
                            ?>
                        </div>
                        <div class="prod-name"> <span><?php  echo ((strlen(get_the_title()) < 27) ? get_the_title() : substr(get_the_title(), 0, 24).'..'); ?></span> </div>
                        <?php $price = get_post_meta( get_the_ID(), 'price', true ); ?>
                        <div class="prod-price"> 
                        <span>$ 
                            <?php echo get_field( "price_details" )?>
                        </span> </div>                        
                    </div>
                </div>

            <?php endwhile; else: ?>
               <hr>
               <div class="row align-items-center">                     
                    <div class="col-sm"><img src="<?php echo site_url();?>/wp-content/themes/treadly/images/empty_product.svg" alt="No_Product"></div>
                    <div class="w-100"></div>
                    <div class="col-sm"> <span>Sorry! No Product Found.</span></div>
                </div>
                <hr>
            <?php endif; ?>
                
            </div>
                                 
            <div class="row" id="filteredProducts"></div>
            
        </div>
    </div> 
    

<?php get_footer(); ?>
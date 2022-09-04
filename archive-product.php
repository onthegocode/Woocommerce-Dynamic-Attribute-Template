<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
 
// Sort categories, match parents and childrens
function add_cats_to_bag(&$child_bag, $cats_by_parent, &$children)
{
	foreach ($children as $child_cat) 
	{
		$temp = sizeof($cats_by_parent);
		$child_id = $child_cat->cat_ID;
		if (array_key_exists($child_id, $cats_by_parent)) 
		{
			$child_cat->children = array();
			$cats_by_parent = add_cats_to_bag($child_cat->children, $cats_by_parent, $cats_by_parent[$child_id]);
		}
		$child_bag[$child_id] = $child_cat;
	}
	return $cats_by_parent;
}

// Determine which category should stay expanded or folded
function cat_expand($cat_tree, $key){
	foreach($cat_tree AS $cat){
		// The current category didn't expand yet, just highlight it
		if ($cat->term_id == $key) {
			$cat->highlight = 1;
			return true;
		} 
		// Expand all its parent categories
		else if (cat_expand($cat->children, $key))
		{
			$cat->expand = 1;
			return true;
		}
	}
	return false;
}

// Generate hierarchical collapsable list
$site_url = site_url();
function recurse_cat($cat)
{
	global $site_url;
	$cat_url = "$site_url/product-category/$cat->slug";
	$cat_lowercase_name = strtolower($cat->name);
	$cat_size = sizeof($cat->children);
	
	// Create icon to indicate expandable/collapsable
	if($cat_size > 0)
	{
		$cat_icon = "<i id='icon{$cat->term_id}' class='typkup-icon icofont-plus'></i>";
	}
	
	$highlight = $cat->highlight == 1 ? "foldable-highlight" : ""; // Determine which is the current category and highlight it	
	$expand = $cat->expand != 1 ? "foldable-sub test" : ""; // Expand all the parents of the current category
	echo "<ul class='thisismytestclass'><li class='foldable foldable-list $highlight' target='{$cat->term_id}'><a href='$cat_url'>$cat_lowercase_name</a> $cat_icon</li>\n";
	echo "<li id='cat{$cat->term_id}' class='$expand foldable-list {$cat->description}'>";
	
	// End condition
	if($cat_size == 0)
	{
		echo "</ul>\n";
		return;
	}
	// Go deeper if there's children
	// Add spacing for children
	foreach($cat->children AS $child)
	{
		recurse_cat($child);
	}
	echo "</li></ul>\n";
} 
?>
<style>
.woof_show_auto_form{display:none!important}.made__in--usa-input1[type=checkbox]{height:0;width:0;visibility:hidden;display:none!important}.made__in--usa-label1{cursor:pointer;text-indent:-9999px;width:60px;height:30px;background:grey;display:block;border-radius:100px;position:relative}.made__in--usa-label1:after{content:'';position:absolute;top:5px;left:5px;width:20px;height:20px;background:#fff;border-radius:90px;transition:.3s}.made__in--usa-input1:checked + .made__in--usa-label1{background:#182c69}.made__in--usa-input1:checked + .made__in--usa-label1:after{left:calc(100% - 5px);transform:translateX(-100%)}.made__in--usa-label1:active:after{width:30px}.wpf_item_wpf_tag{padding:0!important}.usa-form--container1{display:flex;justify-content:space-between;align-items:center;padding:2rem 0}.wpf_product_tag_6391{margin:0!important}.usa-form--container1-head{font-family:inherit;color:#182c69;font-size:22px;margin-bottom:16px}.foldable-text span{display:none}
</style>
<section class="page-header">shop</section>
<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="shop-sb">
                    <div class="ssb-search text-center">
                        <span class="ssb-title">product search</span>
                        <form method="get" action="/">
                            <div class="input-group">
                                <input type="text" name="s" class="form-control" placeholder="search for products...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fa fa-search"></i></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="ssb-pad">
<!-- 			USA		Short Code	 -->
<div class="usa-form--container1">
  	<h5 class="usa-form--container1-head">USA Made</h5>
	<input type="checkbox" id="switch" class="made__in--usa-input1" /><label for="switch" class="made__in--usa-label1">Toggle</label>
</div>
<script>
const usaMadeInInput=document.querySelector(".made__in--usa-input1"),madeInTheUSAInput=document.querySelector(".made__in--usa-label1"),madeInUSACount=document.querySelector(".wpf_item_count");let usaSwitchFunc=()=>{document.querySelector(".iCheck-helper")?.click()};madeInTheUSAInput.addEventListener("click",usaSwitchFunc);let isUSACheck;isUSACheck="https://typkup.com/shop/"!==window.location.href&&(!0===JSON.parse(localStorage.getItem("isUSACheck"))||window.location.href.indexOf("product_tag=usa")>0),localStorage.setItem("isUSACheck",isUSACheck),console.log(isUSACheck),document.querySelector(".made__in--usa-label1").addEventListener("click",()=>console.log("clicked"));let isUSACheck_d=JSON.parse(localStorage.getItem("isUSACheck"));isUSACheck_d&&0>window.location.href.indexOf("product_tag=usa")&&window.location.assign(window.location.href+"?swoof=1&product_tag=usa"),window.location.href.indexOf("product_tag=usa")>0&&(document.getElementById("switch").checked=!0,madeInTheUSAInput.addEventListener("click",()=>{isUSACheck=!1,localStorage.setItem("isUSACheck",isUSACheck),window.location.href.indexOf("&really_curr_tax=")>0?window.location.replace(window.location.href.split("?")[0]):window.location.assign(window.location.href.split("?")[0])}))
</script>
                        <div class="ssb-categories text-center">
                            <?php												
								$args = array(
									'taxonomy'     		=> 'product_cat',
									'orderby'      		=> 'name',								
									'hide_empty'   		=> 0,
									'hierarchical'		=> 1,
									'show_option_all' 	=> 'all products'
								);
								
								$all_categories = get_categories( $args ); 
								// First index all categories by parent id, for easy lookup later
								$cats_by_parent = array();
								foreach ($all_categories as $cat)
								{
									
									
									$parent_id = $cat->category_parent;
									if (!array_key_exists($parent_id, $cats_by_parent)) 
									{
										$cats_by_parent[$parent_id] = array();
									}
									$cat->children = array();
									$cats_by_parent[$parent_id][] = $cat;
								}

								// Then build a hierarchical tree
								$cat_tree = array();				
								add_cats_to_bag($cat_tree, $cats_by_parent, $cats_by_parent[0]);
								
								$curr_cat = get_queried_object();
								cat_expand($cat_tree, $curr_cat->term_id);								
							?>
							<div class="ssb-cat-title">product categories</div>
							<div class='foldable-link text-left'><a href="/shop">all products</a>
								<div class="foldable-text">
								<?php
								foreach($cat_tree AS $cat) {
									recurse_cat($cat);
									?><span class="<?php echo $cat->cat_ID; ?>"> <?php echo category_description( $cat );?> </span><?php
								}; 
								?>
								</div>
<script> 
let catDescriptionID=document.querySelector(".foldable-link").querySelectorAll("span"),nUSA="notusa";for(let i of catDescriptionID)if(i.querySelector("p")&&i.querySelector("p").textContent===nUSA){console.log(i.querySelector("p").textContent);let a="cat"+i.classList.value;document.getElementById(a).parentElement.classList.add("usa-remove__cat")}let catSubDescriptionID=document.getElementsByClassName(nUSA);for(let i of catSubDescriptionID)i.parentElement.classList.add("usa-remove__cat");let madeUSANONE=document.getElementsByClassName("usa-remove__cat");if(usaMadeInInput.checked)for(let i of madeUSANONE)i.style.display="none"
</script>
							</div>
                            <div class="ssb-links">
                                <div class="ssb-cat-title">quick links</div>
                                <?php
                                wp_nav_menu( 
                                    array(
                                        'container_class' => 'shop-links',
                                        'menu' => 'shopquicklinks',
                                        'walker' => new description_walker()
                                    )
                                ); 
                                ?>
                            </div>
							<?php echo do_shortcode('[contact-form-7 id="53039" title="Deals Signup"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
<!-- 		 -->
            <div class="col-12 col-lg-9">
                <img src="<?php echo get_bloginfo('template_url'); ?>/assets/src/img/shop-bar.png" class="mb-2">
                <h4 class="shop-headline mb-5">
                    <?php if(is_product_category()): ?>
                    <?php echo single_term_title(); ?>
                    <?php else: ?>
                    all products
                    <?php endif; ?>
                </h4>
            <?php
// 				Start of the product loop
            if ( woocommerce_product_loop() ) {

                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );

                woocommerce_product_loop_start();
// 				
                if ( wc_get_loop_prop( 'total' ) ) { //checks how many products are in te database
					//the actual loop
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );
						//This grabs the template from content-product.php
                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
// 				Pagination
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            }

            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
            ?>
            </div>
        </div>
    </div>
</section>



<?php get_footer( 'shop' ); ?>

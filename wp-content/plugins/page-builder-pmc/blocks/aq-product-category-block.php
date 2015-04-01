<?php
/** "News" block 
 * 
 * Optional to use horizontal lines/images
**/
class AQ_Product_Category_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Prod. Categories',
			'size' => 'span12',
			'resizable' => 1,
			'icon' => 'fa-shopping-cart',
			'icon_color' => 'FFF',
			'category' => 'Ecommerce',
			'help' => 'Block that adds products categories to the page.'
			
		);
		
		//create the block
		parent::__construct('aq_product_category_block', $block_options);
	}
	
	function form($instance) {
		$product_categories_default = ($temp = get_terms('product_cat')) ? $temp : array();
		$product_options_default = array();
		$i = 0;
		foreach($product_categories_default as $cat_default) {
			$product_options_default[$i++] = $cat_default->term_id;
		}	
				
		$defaults = array(
			'number_product' => '12',
			'rows_product' => '4',
			'product_order' => 'desc',
			'product_sort_by' => 'date',			
			'categories_product' => $product_options_default,
			'show_sorting' => 1,
			'show_navigation' => 1,
		);
		
		$order_options = array(
			'asc' => 'ASC',
			'desc' => 'DESC',
		);
		
		$sort_by_options = array(
			'date' => 'Date',
			'title' => 'Title',
		
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		if (pmc_woo() && PMC_SHOP){ 
			$port_categories = ($temp = get_terms('product_cat')) ? $temp : array();
			$categories_options = array();
			foreach($port_categories as $cat) {
				$categories_options[$cat->term_id] = $cat->name;
			}

			?>
			<p class="description note">
				<?php _e('Use this block to create product categories block.', 'framework') ?>
			</p>	
			<p class="description half ">
				<label for="<?php echo $this->get_field_id('categories_product') ?>">
				Product Category<br/>
				<?php echo aq_field_multiselect('categories_product', $block_id, $categories_options, $categories_product); ?>
				</label>			
				<label for="<?php echo $this->get_field_id('number_product') ?>">
					Number of product to show
					<?php echo aq_field_input('number_product', $block_id, $number_product, $size = 'medium') ?>
				</label>
				<label for="<?php echo $this->get_field_id('rows_product') ?>">
					Number of rows
					<?php echo aq_field_input('rows_product', $block_id, $rows_product, $size = 'medium') ?>
				</label>	

			</p>

			<p class="description half last">		
				<label for="<?php echo $this->get_field_id('product_order') ?>">
					Products order<br/>
					<?php echo aq_field_select('product_order', $block_id, $order_options, $product_order); ?>
				</label>				
				<label for="<?php echo $this->get_field_id('product_sort_by') ?>" style="width:100%;float: left;margin-bottom: 10px;">
					Products order<br/>
					<?php echo aq_field_select('product_sort_by', $block_id, $sort_by_options, $product_sort_by); ?>
				</label>
				<label for="<?php echo $this->get_field_id('show_navigation') ?>" style="width:100%;float: left;margin-bottom: 10px;">
					<?php echo aq_field_checkbox('show_navigation', $block_id, $show_navigation); ?>
					Show navigation?
				</label>
				<label for="<?php echo $this->get_field_id('show_sorting') ?>" style="width:100%;float: left;margin-bottom: 10px;">
					<?php echo aq_field_checkbox('show_sorting', $block_id, $show_sorting); ?>
					Show sorting?
				</label>				
				
			</p>		
			

			<?php
		}		
	}
	
	function block($instance) {
		
		if (pmc_woo() && PMC_SHOP){ 
		
			$product_categories_default = ($temp = get_terms('product_cat')) ? $temp : array();
			$product_options_default = array();
			$i = 0;
			foreach($product_categories_default as $cat_default) {
				$product_options_default[$i++] = $cat_default->term_id;
			}
			
			$defaults = array(
				'number_product' => '12',
				'rows_product' => '4',
				'product_order' => 'desc',
				'product_sort_by' => 'date',			
				'categories_product' => $product_options_default,
				'show_sorting' => 1,
				'show_navigation' => 1,
			);
			

			$instance = wp_parse_args($instance, $defaults);	
			extract($instance);
			?>
			
			<?php 
			if(!defined('SHOP_ROWS')) define( 'SHOP_ROWS', intval($rows_product) );
			/* set number of rows*/
			add_filter('loop_shop_columns', 'loop_columns');
			if (!function_exists('loop_columns')) {
				function loop_columns() {
					return SHOP_ROWS; 
				}
			}
			if(get_query_var('orderby')){
				if(get_query_var('orderby') == 'price-desc' || get_query_var('orderby') == 'price'){
					$order_by = 'meta_value_num';
					$meta_key ='_'.get_query_var('orderby');
					if(get_query_var('orderby') == 'price-desc'){
						$order_by = 'meta_value_num';
						$meta_key = '_price';
						$product_order ='DESC';				
					}				
				}
			}
			else{
				$order_by = 'product_sort_by';
				$meta_key = '';
			}
			

			?>
			
			<div class="woocommerce columns-<?php echo $rows_product ?>">
			<?php
			global $wp_query;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array('post_type' => 'product',
					'tax_query' => array( 
						 array (
						  'taxonomy' => 'product_cat',
						  'field' => 'id',
						  'terms' => $categories_product
						 ), 
						 
					 ),
					'order' => $product_order,
					'orderby' => $order_by,
					'meta_key' => $meta_key,					
					'showposts'     => $number_product,
					'paged'    => $paged);

			query_posts($args);	 
				 /*
				$query = new WP_Query( array ( 'post_type' => 'product', 'orderby' => 'meta_value', 'meta_key' => 'price' ) );
				 
				$args['meta_key'] = '_price';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'desc'; 
				return $args;	*/		 		

			?>
			<?php if ( have_posts() ) : ?>

				<?php
					if($show_sorting){
						do_action( 'woocommerce_before_shop_loop' );
					}
				?>

				<?php woocommerce_product_loop_start(); ?>

					<?php while ( have_posts() ) :  the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				
				<?php	
					if($show_navigation){
						do_action( 'woocommerce_after_shop_loop' );
					}
				?>				
			
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>


			<?php endif; wp_reset_query();?>
			</div>

		<?php
		}
	}
	
	function update($new_instance, $old_instance) {
		$new_instance = aq_recursive_sanitize($new_instance);
		return $new_instance;
	}

}
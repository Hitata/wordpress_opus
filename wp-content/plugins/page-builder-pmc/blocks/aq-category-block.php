<?php
/** "News" block 
 * 
 * Optional to use horizontal lines/images
**/
class AQ_Category_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Shop categor.',
			'size' => 'span12',
			'resizable' => 1,
			'icon' => 'fa-shopping-cart',
			'icon_color' => 'FFF',
			'category' => 'Ecommerce',
			'help' => 'Block that adds shop categories to the page.'
			
		);
		
		//create the block
		parent::__construct('aq_category_block', $block_options);
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
			'hide_empty' => 1,

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
				<?php _e('Block that adds shop categories to the page', 'framework') ?>
			</p>	
			<p class="description half ">
				<label for="<?php echo $this->get_field_id('categories_product') ?>">
				Category<br/>
				<?php echo aq_field_multiselect('categories_product', $block_id, $categories_options, $categories_product); ?>
				</label>			
				<label for="<?php echo $this->get_field_id('number_product') ?>">
					Number of category to show
					<?php echo aq_field_input('number_product', $block_id, $number_product, $size = 'medium') ?>
				</label>
				<label for="<?php echo $this->get_field_id('rows_product') ?>">
					Number of rows
					<?php echo aq_field_input('rows_product', $block_id, $rows_product, $size = 'medium') ?>
				</label>				
			</p>

			<p class="description half last">		
				<label for="<?php echo $this->get_field_id('product_order') ?>" style="width:100%;float: left;margin-bottom: 10px;">
					Category order<br/>
					<?php echo aq_field_select('product_order', $block_id, $order_options, $product_order); ?>
				</label>				
				<label for="<?php echo $this->get_field_id('product_sort_by') ?>" style="width:100%;float: left;margin-bottom: 10px;">
					Category order<br/>
					<?php echo aq_field_select('product_sort_by', $block_id, $sort_by_options, $product_sort_by); ?>
				</label>
				<label for="<?php echo $this->get_field_id('hide_empty') ?>" style="width:100%;float: left;margin-bottom: 10px;">
					<?php echo aq_field_checkbox('hide_empty', $block_id, $hide_empty); ?>
					Hide empty?
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
				'hide_empty' => 1,

			);
			

			$instance = wp_parse_args($instance, $defaults);	
			extract($instance);
			$product_options = join(',', $categories_product);
			echo do_shortcode( stripslashes('[product_categories ids="'.$product_options.'"  number="'.$number_product.'" columns="'.$rows_product.'" orderby="'.$product_sort_by.'" order="'.$product_order.'" hide_empty="'.$hide_empty.'" ]') );

		}
	}
	
	function update($new_instance, $old_instance) {
		$new_instance = aq_recursive_sanitize($new_instance);
		return $new_instance;
	}

}
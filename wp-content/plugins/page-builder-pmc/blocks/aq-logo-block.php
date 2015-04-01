<?php
class AQ_Logo_Block extends AQ_Block {
		//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Logo',
			'size' => 'span4',
			'icon' => 'fa-th-list',
			'icon_color' => 'FFF',
			'category' => 'Menu',
			'help' => 'Logo is set here. '
		);
		
		//create the block
		parent::__construct('aq_logo_block', $block_options);
					
	}
		function form($instance) {
		
		$defaults = array(
			'position' => 'logo-center',
			'use_scroll_menu' => 0,			
		);		
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$position_options = array(
			'logo-left' => 'Left',
			'logo-right' => 'Right',
			'logo-center' => 'Center',			
		);		
		
		?>
		<p class="description note">
			<?php _e('This block is used to display logo and menu.', 'framework') ?>
		</p>		
		<p class="description third">
			<label for="<?php echo $this->get_field_id('position') ?>">
				Logo align<br/>
				<?php echo aq_field_select('position', $block_id, $position_options, $position); ?>
			</label>
		</p>		
		<div class="description">
			<label for="<?php echo $this->get_field_id('use_scroll_menu') ?>">
				Show alternative logo for scroll menu (if you are using transparent menu)<br/>
				<?php echo aq_field_checkbox('use_scroll_menu', $block_id, $use_scroll_menu); ?>
			</label>
		</div>			
		<?php
		
	}
		function block($instance) {
		$defaults = array(
			'position' => 'logo-center',
			'use_scroll_menu' => 0,	
		);		
		$instance = wp_parse_args($instance, $defaults);	
		extract($instance);
		$pmc_theme_name = wp_get_theme();		
		$pmc_theme_name = $pmc_theme_name->get( 'Name' );						
			global $pmc_data;			
			?>			


			<div class="<?php echo $position ?>">
					<?php 
					if($use_scroll_menu == 1){
						if(isset($pmc_data['scroll_logo'])){
							$logo = $pmc_data['scroll_logo']; 
						} else {
							$logo = $pmc_data['logo']; 
						}
					} else {
						$logo = $pmc_data['logo']; 
					} ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php if ($logo != '') {?>
				<?php echo $logo; ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" /></a>
			</div>

		<?php		
		
	}
		
	function update($new_instance, $old_instance) {

		$new_instance = aq_recursive_sanitize($new_instance);

		return $new_instance;

	}	
}
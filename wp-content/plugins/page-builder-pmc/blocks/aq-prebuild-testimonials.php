<?php
class PMC_Prebuild_Testimonials extends AQ_Block {
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Preb. Testimoni.',
			'size' => 'span12',
			'resizable' => 0,
			'icon' => 'fa-quote-right',
			'icon_color' => 'FFF',
			'category' => 'Prebuild',
			'help' => 'This is prebuild contact block with sidebar.',
			'resizable' => 0,
		);
		
		//create the block
		parent::__construct('pmc_prebuild_testimonials', $block_options);
		
	}
	
	function form($instance) {
	
		/*start block*/
		$start = new AQ_Start_Content_Block();
		
		/*testimonilas*/
		$testimonials_p = new AQ_Testimonial_Block();	
		
		
		$defaults = array(
			'block_id' => rand(0,99999),
			'backgroundimage' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/quote-blurred-background-1.jpg',
			'paddingtop' => '100',
			'paddingbottom' => '150',			
			'speed' => 12000,
			'testimonials'		=> array(
				1 => array(
					'author' => '&#8213; Charles Eames &#8213;',
					'link' => 'http://premiumcoding.com',
					'text' => 'Recognizing the need is the primary condition for design'
				),
				2 => array(
					'author' => '&#8213; Timothy Samara &#8213;',
					'link' => 'http://premiumcoding.com',
					'text' => 'Use two typeface families maximum. OK, maybe three'
				))					
			
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		pmc_inner_block($start,$instance,'Start block with title (here you can set block background, video ...)','fa-dot-circle-o'); 
		pmc_inner_block($testimonials_p,$instance,'Testiminials (here you can add unllimited testiminials)','fa-comments'); 				
				
		
	}
	
	function block($instance) {
	
		$defaults = array(
			'block_id' => rand(0,99999),
			'backgroundimage' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/quote-blurred-background-1.jpg',
			'paddingtop' => '100',
			'paddingbottom' => '150',			
			'speed' => 12000,
			'testimonials'		=> array(
				1 => array(
					'author' => '- Charles Eames -',
					'link' => 'http://premiumcoding.com',
					'text' => 'Recognizing the need is the primary condition for design'
				),
				2 => array(
					'author' => '- Timothy Samara -',
					'link' => 'http://premiumcoding.com',
					'text' => 'Use two typeface families maximum. OK, maybe three'
				))					
			
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		/*start block*/
		$start = new AQ_Start_Content_Block();
		
		/*testimonilas*/
		$testimonials = new AQ_Testimonial_Block();				
		
		/*end block*/
		$end = new AQ_End_Content_Block();	
		
		
		
		?>
		<div class="aq-block aq-block-aq_start_content_block aq_span12 aq-first cf">
		<?php $start -> block($instance); ?>
		</div>			
		<div class="aq-block aq-block-aq_testimonial_block aq_span12 aq-first cf">
		<?php $testimonials -> block($instance); ?>
		</div>		
		<div class="prebuild-contact aq-block aq-block-aq_end_content_block aq_span12 aq-first cf">
		<?php $end -> block($instance); ?>
		</div>		
		<?php
	}
}
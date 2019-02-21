/*--------------------------------------------------------------
 Renovation Theme
 --------------------------------------------------------------*/
'use strict';

var tmRenovation;

(
	function( $ ) {

		tmRenovation = (
			function() {

				var $document = $( document ),
					$body     = $( 'body' ),
					$window   = $( window );

				return {

					init: function() {

						this.stickyMenu();

						this.scrollToTop();

						this.mobileMenu();

						this.initParallax();

						this.mfnPopup();

						this.galleryProject();

						this.miniCart();

						this.searchBox();

						this.megaMenuHeader02();

						this.header03();

						this.generateResponsiveSpacing();

						this.testimonialCarousel();

						this.costCalculatorSlider();

						this.shop();

					},

					rtl: function() {

						if ( ! tmRenovationConfigs.is_sticky ) {
							return
						}

						var left = jQuery( '[data-vc-full-width="true"]' ).css( 'left' );

						jQuery( '[data-vc-full-width="true"]' ).css( {
							'left': 'auto',
							'right': left
						} );

						var ess_left = jQuery( '.esg-container-fullscreen-forcer' ).css( 'left' );

						jQuery( '.esg-container-fullscreen-forcer' ).css( {
							'left': 'auto',
							'right': ess_left
						} );
					},

					stickyMenu: function() {

						if ( 'header03' == tmRenovationConfigs.header_type ) {

							$( 'body.sticky-menu .header' ).headroom( {
								offset: 52
							} )
						} else {

							$( 'body.sticky-menu #site-navigation' ).headroom( {
								offset: 130
							} )
						}
					},

					scrollToTop: function() {

						// Scroll up
						var $scrollup = $( '.scrollup' );

						$window.scroll( function() {
							if ( $window.scrollTop() > 100 ) {
								$scrollup.addClass( 'show' );
							} else {
								$scrollup.removeClass( 'show' );
							}
						} );

						$scrollup.on( 'click', function( evt ) {
							$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
							evt.preventDefault();
						} );
					},

					/**
					 * Mobile Menu
					 */
					mobileMenu: function() {

						var $mobileBtn     = $( '.mobile-menu-btn' ),
							$mobileMenu    = $( '#site-mobile-menu' ),
							$pageContainer = $( '#page' );

						var caculateRealHeight = function( $ul ) {

							var height = 0;

							$ul.find( '>li' ).each( function() {
								height += $( this ).outerHeight();
							} );

							return height;
						};

						var setUpOverflow = function( h1, h2 ) {

							if ( h1 < h2 ) {
								$( '.site-mobile-menu' ).css( 'overflow-y', 'hidden' );
							} else {
								$( '.site-mobile-menu' ).css( 'overflow-y', 'auto' );
							}
						};

						var setTopValue = function() {

							var $adminBar = $( '#wpadminbar' ),
								w         = $window.width(),
								h         = $adminBar.height(),
								top       = h;

							if ( $adminBar.length ) {

								if ( $adminBar.css( 'position' ) == 'absolute' && w <= 600 ) {

									var t = $adminBar[ 0 ].getBoundingClientRect().top;

									// get the top value for mobile menu
									// t always negative or equal 0
									if ( t >= 0 - h ) {
										// E.g: t = -30px, h = 46px => top = 46 + (-30) = 46 - 30 = 13
										top = h + t;
									} else {
										top = 0;
									}
								}
							}

							$( '.site-mobile-menu' ).css( 'top', top );
						};

						var buildSlideOut = function() {

							if ( typeof $mobileMenu !== 'undefined' && typeof $pageContainer !== 'undefined' ) {

								$body.on( 'click', '.mobile-menu-btn', function() {

									$( this ).toggleClass( 'is-active' );

									$body.toggleClass( 'mobile-menu-opened' );

									setTopValue();

								} );

								// Close menu if click on the site
								$pageContainer.on( 'click touchstart', function( e ) {

									if ( ! $( e.target ).closest( '.mobile-menu-btn' ).length ) {

										if ( $body.hasClass( 'mobile-menu-opened' ) ) {

											$body.removeClass( 'mobile-menu-opened' );

											$mobileBtn.removeClass( 'is-active' );
											$mobileMenu.find( '#searchform input[type="text"]' ).blur();

											e.preventDefault();
										}

									}
								} );

								// re-calculate the top value of mobile menu when resize
								$window.on( 'resize', function() {
									setTopValue();
								} );

								setUpOverflow( $mobileMenu.height(), $( '.site-mobile-menu' ).height() );
							}
						};

						var buildDrillDown = function() {

							var level  = 0,
								opener = '<span class="open-child">open</span>',
								height = $( '.site-mobile-menu' ).height();

							$mobileMenu.find( 'li:has(ul)' ).each( function() {

								var $this   = $( this ),
									allLink = $this.find( '> a' ).clone();

								$this.prepend( opener );

								$this.find( '> ul' )
									.prepend( '<li class="menu-back">' + allLink.wrap( '<div>' )
											.parent()
											.html() + '</a></li>' );
							} );

							$mobileMenu.on( 'click', '.open-child', function() {

								var $parent = $( this ).parent();

								if ( $parent.hasClass( 'over' ) ) {

									$parent.removeClass( 'over' );

									level --;

									if ( level == 0 ) {
										setUpOverflow( $mobileMenu.height(), height );
									}
								} else {

									$parent.parent().find( '>li.over' ).removeClass( 'over' );
									$parent.addClass( 'over' );

									level ++;

									setUpOverflow( caculateRealHeight( $parent.find( '>.sub-menu' ) ), height );
								}

								$mobileMenu.parent().scrollTop( 0 );
							} );

							$mobileMenu.on( 'click', '.menu-back', function() {

								var $grand = $( this ).parent().parent();

								if ( $grand.hasClass( 'over' ) ) {

									$grand.removeClass( 'over' );

									level --;

									if ( level == 0 ) {
										setUpOverflow( $mobileMenu.height(), height );
									}
								}

								$mobileMenu.parent().scrollTop( 0 );

							} );
						};

						buildSlideOut();
						buildDrillDown();
					},

					/**
					 * init parallax page title image
					 */
					initParallax: function() {

						$.stellar( {
							horizontalScrolling: false,
							scrollProperty: 'scroll',
							responsive: true,
							positionProperty: 'position'
						} );
					},

					/**
					 * Magnific Popup
					 */
					mfnPopup: function() {

						// project details page
						$( '.gallery,.single-featured' ).magnificPopup( {
							delegate: 'a', // child items selector, by clicking on it popup will open
							type: 'image',
							removalDelay: 300,
							mainClass: 'mfp-fade',
							gallery: {
								enabled: true
							},
							zoom: {
								enabled: true,
								duration: 300,
								easing: 'ease-in-out'
							}
						} );

					},

					/**
					 * Gallery on project page
					 */
					galleryProject: function() {
						$( ".single-project .gallery" ).owlCarousel( {
							nav: false,
							dots: false,
							autoplay: true,
							autoplayHoverPause: true,
							autoplayTimeout: 3000,
							margin: 15,
							responsive: {
								0: {
									items: 2
								},
								768: {
									items: 3
								},
								1024: {
									items: 6
								}
							}
						} );
					},

					/**
					 * Mini Cart
					 */
					miniCart: function() {

						var $mini_cart = $( '.mini-cart' );

						var events = function() {

							$mini_cart.find( '.widget_shopping_cart_content .cart_list' )
								.perfectScrollbar( { suppressScrollX: true } );

							initRemoveAction();

							setTimeout( function() {
								$( '.add_to_cart_button.added' ).removeClass( 'added' );
							}, 3000 );
						}

						$mini_cart.on( 'click', function() {
							openMinicart();
						} );

						var openMinicart = function() {
							$mini_cart.addClass( 'open' );
							$body.addClass( 'minicart-opened' );
						};

						$document.on( 'click', function( e ) {
							if ( $( e.target ).closest( $mini_cart ).length == 0 ) {
								$mini_cart.removeClass( 'open' );
								$body.removeClass( 'minicart-opened' );
							}
						} );

						$body.on( 'added_to_cart wc_fragments_refreshed wc_fragments_loaded', function() {

							events();
						} );

						// ajax remove item
						var initRemoveAction = function() {

							$mini_cart.find( '.mini_cart_item .remove' ).on( 'click', function( e ) {

								e.preventDefault();

								$( this ).parent().addClass( 'loading' );

								var cart_item_key = $( this ).attr( 'data-cart_item_key' );

								$.ajax( {
									type: 'POST',
									dataType: 'json',
									url: tmRenovationConfigs.ajax_url,
									data: {
										action: 'tm_renovation_remove_cart_item',
										cart_item_key: cart_item_key
									}, success: function( response ) {

										$body.trigger( 'wc_fragment_refresh' );
										$body.trigger( 'wc_fragments_refreshed' );
									},
									timeout: 6000
								} );
							} );
						}

						// move the minicart to .mobile-buttons
						var moveOnMobile = function() {

							if ( $window.width() < 1200 ) {

								if ( ! $( '.mobile-buttons' ).find( '.mini-cart' ).length ) {
									$mini_cart.prependTo( '.mobile-buttons' );
								}
							} else {

								if ( ! $( '.header-right' ).find( '.mini-cart' ).length ) {
									$mini_cart.appendTo( '.header-right > .row > .col-xs-12.col-lg-2.end-sm' );
								}
							}
						};

						$window.on( 'resize', function() {
							moveOnMobile();
						} );

						setTimeout( function() {
							$mini_cart.addClass( 'loaded' );
						}, 500 );

						events();
						moveOnMobile();
					},

					searchBox: function() {

						var $search_btn  = $( '.search-box > i' ),
							$search_form = $( 'form.search-form' );

						$search_btn.on( 'click', function() {
							$search_form.toggleClass( 'open' );

							setTimeout( function() {
								$( '.search-field', $search_form ).focus();
							}, 300 );
						} );

						$document.on( 'click', function( e ) {
							if ( $( e.target ).closest( $search_btn ).length == 0
								 && $( e.target ).closest( 'input.search-field' ).length == 0
								 && $search_form.hasClass( 'open' ) ) {
								$search_form.removeClass( 'open' );
							}
						} );

						$search_form.find( 'input[type="search"]' ).on( 'keyup', function() {

							if ( event.altKey || event.ctrlKey || event.shiftKey || event.metaKey ) {
								return;
							}
							var keys = [ 9, 16, 17, 18, 19, 20, 33, 34, 35, 36, 37, 39, 45, 46 ];

							if ( keys.indexOf( event.keyCode ) != - 1 ) {
								return;
							}

							switch ( event.which ) {

								case 27:// escape

									// close search
									if ( $( this ).val() == '' ) {
										$search_form.removeClass( 'open' );
									}

									break;
								default:
									break;
							}
						} );

					},

					/**
					 * Calculating position of MegaMenu for header02
					 */
					megaMenuHeader02: function() {

						var $leftVal = 0;

						$( '.header02 #site-navigation .menu > li' ).each( function() {
							if ( ! $( this ).hasClass( 'mega-menu' ) ) {
								$leftVal += $( this ).outerWidth();
							} else {
								$( '.header02 #site-navigation li.mega-menu > .sub-menu' )
									.css( 'left', '-' + $leftVal + 'px' );
								return;
							}
						} );

					},

					/**
					 * Calculating dynamic padding top value for navigation of header03
					 */
					header03: function() {

						var caculatePaddingTop = function( element ) {

							var $this          = $( element );
							var $header_height = $( '.site-header' )[ 0 ].getBoundingClientRect().top;
							var $height        = $this[ 0 ].getBoundingClientRect().top;
							var $padding_top   = (
								$height - $header_height
							);

							if ( ! $this.parent().hasClass( 'menu-item-has-children' ) ) {
								$padding_top -= 1;
							}

							return $padding_top;

						}

						$( '.header03 #site-navigation .menu > li > a' ).each( function() {
							$( this ).css( 'padding-top', caculatePaddingTop( $( this ) ) + 'px' );
						} );
					},

					generateResponsiveSpacing: function() {

						var lg_css_tmp      = {}, md_css_tmp = {}, sm_css_tmp = {}, xs_css_tmp = {};
						var lg_only_css_tmp = {}, md_only_css_tmp = {}, sm_only_css_tmp = {}, xs_only_css_tmp = {};
						var css             = '';

						$( '[class*=padding-], [class*=margin-]' ).each( function() {

							var matches = this.className.match( /(padding|margin)-(xs|sm|md|lg)(-only)?(-top|-right|-bottom|-left)?-{1,2}\d+(-important)?/gi );

							if ( matches != null ) {
								for ( var i = 0; i < matches.length; i ++ ) {
									var match   = matches[ i ];
									var css_tmp = '';

									var arr                       = match.split( '-' );
									var num, direction, important = '';

									// check media-only CSS
									if ( arr[ 2 ] == 'only' ) {

										direction = arr[ 3 ];

										// check spacing for all directions
										if ( direction != 'top' && direction != 'right' && direction != 'bottom' && direction != 'left' ) {

											direction = '';

											// check negative value
											if ( arr[ 3 ] == '' ) {
												num = '-' + arr[ 4 ];
											} else {
												num = arr[ 3 ];
											}

										} else {

											// check negative value
											if ( arr[ 4 ] == '' ) {
												num = '-' + arr[ 5 ];
											} else {
												num = arr[ 4 ];
											}
										}
									} else {

										direction = arr[ 2 ];

										// check spacing for all directions
										if ( direction != 'top' && direction != 'right' && direction != 'bottom' && direction != 'left' ) {

											direction = '';

											// check negative value
											if ( arr[ 2 ] == '' ) {
												num = '-' + arr[ 3 ];
											} else {
												num = arr[ 2 ];
											}

										} else {

											// check negative value
											if ( arr[ 3 ] == '' ) {
												num = '-' + arr[ 4 ];
											} else {
												num = arr[ 3 ];
											}
										}
									}

									// chech !important tag
									if ( arr[ arr.length - 1 ] == 'important' ) {
										important = ' !important';
									}

									if ( ! $( this ).hasClass( 'wpb_content_element vc_column_container' ) ) {
										css_tmp = '.' + match + '{' + arr[ 0 ] + (
												direction ? '-' + direction : ''
											) + ':' + num + 'px' + (
													  important ? important : ''
												  ) + ';}';
									}

									if ( $( this ).hasClass( 'wpb_content_element' ) ) {
										css_tmp = '.wpb_content_element.' + match + '{' + arr[ 0 ] + (
												direction ? '-' + direction : ''
											) + ':' + num + 'px' + (
													  important ? important : ''
												  ) + ';}';
										match += '-wpb_content_element';
									}

									if ( $( this ).hasClass( 'vc_column_container' ) ) {

										var important_tag = $( this )
											.hasClass( 'vc_col-has-fill' ) ? ' !important' : '';

										if ( important ) {
											important_tag = important;
										}

										css_tmp = '.vc_column_container.' + match + ' > .vc_column-inner' + '{' + arr[ 0 ] + (
												direction ? '-' + direction : ''
											) + ':' + num + 'px' + important_tag + ';}';
										css_tmp += '.vc_column_container.' + match + '{' + arr[ 0 ] + (
												direction ? '-' + direction : ''
											) + ':' + '0px;}';
										match += '-vc_column_container';
									}

									if ( arr[ 2 ] != 'only' ) {

										switch ( arr[ 1 ] ) {
											case 'lg':
												if ( typeof lg_css_tmp[ match ] == 'undefined' ) {
													lg_css_tmp[ match ] = css_tmp;
												}
												break;
											case 'md':
												if ( typeof md_css_tmp[ match ] == 'undefined' ) {
													md_css_tmp[ match ] = css_tmp;
												}
												break;
											case 'sm':
												if ( typeof sm_css_tmp[ match ] == 'undefined' ) {
													sm_css_tmp[ match ] = css_tmp;
												}
												break;
											case 'xs':
												if ( typeof xs_css_tmp[ match ] == 'undefined' ) {
													xs_css_tmp[ match ] = css_tmp;
												}
												break;
											default:
												break;
										}
									} else {

										switch ( arr[ 1 ] ) {
											case 'lg':
												if ( typeof lg_only_css_tmp[ match ] == 'undefined' ) {
													lg_only_css_tmp[ match ] = css_tmp;
												}
												break;
											case 'md':
												if ( typeof md_only_css_tmp[ match ] == 'undefined' ) {
													md_only_css_tmp[ match ] = css_tmp;
												}
												break;
											case 'sm':
												if ( typeof sm_only_css_tmp[ match ] == 'undefined' ) {
													sm_only_css_tmp[ match ] = css_tmp;
												}
												break;
											case 'xs':
												if ( typeof xs_only_css_tmp[ match ] == 'undefined' ) {
													xs_only_css_tmp[ match ] = css_tmp;
												}
												break;
											default:
												break;
										}

									}
								}
							}
						} );

						var xs_css      = '', sm_css = '', md_css = '', lg_css = '';
						var xs_only_css = '', sm_only_css = '', md_only_css = '', lg_only_css = '';

						$.each( xs_css_tmp, function( k, v ) {
							xs_css += v;
						} );

						$.each( sm_css_tmp, function( k, v ) {
							sm_css += v;
						} );

						$.each( md_css_tmp, function( k, v ) {
							md_css += v;
						} );

						$.each( lg_css_tmp, function( k, v ) {
							lg_css += v;
						} );

						$.each( xs_only_css_tmp, function( k, v ) {
							xs_only_css += v;
						} );

						$.each( sm_only_css_tmp, function( k, v ) {
							sm_only_css += v;
						} );

						$.each( md_only_css_tmp, function( k, v ) {
							md_only_css += v;
						} );

						$.each( lg_only_css_tmp, function( k, v ) {
							lg_only_css += v;
						} );

						if ( xs_css != '' ) {
							css += '@media (min-width: 20em){' + xs_css + '}';
						}
						if ( sm_css != '' ) {
							css += '@media (min-width: 48em){' + sm_css + '}';
						}

						if ( md_css != '' ) {
							css += '@media (min-width: 64em){' + md_css + '}';
						}
						if ( lg_css != '' ) {
							css += '@media (min-width: 80em){' + lg_css + '}';
						}

						if ( xs_only_css != '' ) {
							css += '@media (min-width: 20em) and (max-width: 47.9em){' + xs_only_css + '}';
						}
						if ( sm_only_css != '' ) {
							css += '@media (min-width: 48em) and (max-width: 63.9em){' + sm_only_css + '}';
						}

						if ( md_only_css != '' ) {
							css += '@media (min-width: 64em) and (max-width: 79.9em){' + md_only_css + '}';
						}
						if ( lg_only_css != '' ) {
							css += '@media (min-width: 80em){' + lg_only_css + '}';
						}

						var tm_renovation_style = document.getElementById( 'tm-renovation-inline-css' );
						if ( tm_renovation_style !== null ) {
							tm_renovation_style.textContent += css;
						}
					},

					testimonialCarousel: function() {

						$( '.thememove-testimonials' ).each( function() {

							var $this            = $( this ),
								$testimonailList = $this.find( '.testimonials-list' ),
								atts             = JSON.parse( $this.attr( 'data-atts' ) ),
								number_per_slide,
								carouselConfigs  = {
									'navigation': false,
									'margin': 30,
									'autoplayHoverPause': true,

								};

							if ( ! atts.enable_carousel || atts.enable_carousel != 'yes' ) {
								return;
							}

							if ( 'undefined' == typeof atts.number_per_slide ) {
								number_per_slide = 1;
							} else {
								number_per_slide = parseInt( atts.number_per_slide );
							}

							if ( number_per_slide > 1 ) {
								carouselConfigs[ 'responsive' ] = {
									0: {
										items: 1,
									},
									768: {
										items: number_per_slide
									}
								}
							} else {
								carouselConfigs[ 'items' ] = 1;
							}

							carouselConfigs[ 'dots' ]   = atts.display_bullets == 'yes';
							// carouselConfigs[ 'autoplay' ] = atts.enable_autoplay == 'yes';
							carouselConfigs[ 'loop' ]   = parseInt( atts.number ) > 1;
							carouselConfigs[ 'is_rtl' ] = atts.is_rtl;

							$testimonailList.owlCarousel( carouselConfigs );

						} );
					},

					costCalculatorSlider: function() {

						if ( ! $( '.btQuoteSlider' ).length ) {
							return;
						}

						// hack JS for slider of Cost Calulator plugin
						$( '.btQuoteSlider' ).each( function() {

							var $this = $( this );

							$this.slider( 'option', {
								range: 'min',
								animate: true
							} );
						} );
					},

					shop: function() {
						$( '.products' ).find( '.product-category.category-item' ).appendTo( '.categories.row' );
					}
				}
			}
		)( jQuery );

	}
)( jQuery );

jQuery( document ).ready( function() {

	tmRenovation.init();

} );

jQuery( window ).load( function() {

	tmRenovation.rtl();

} );
<div id="tm-import-page">
	<div class="wrap">
		<div class="body">

			<?php
			if ( ! empty( $_POST['import_sample_data'] ) ) { ?>

				<div id="import-working">

					<h2 class="tm-page-title"
					    style="color: <? echo esc_attr( $style['title_color'] ); ?>"><?php echo esc_html__( 'The importer is working', 'tm-core' ); ?>
						<?php if ( $style['logo'] ) { ?>
							<img class="logo" src="<?php echo esc_url( $style['logo'] ) ?>" alt="import logo"/>
						<?php } ?>
					</h2>

					<div id="error-import-msg"></div>
					<span id="import-status"><?php esc_html_e( 'Preparing to connect to server', 'tm-core' ); ?>
						...</span>
					<div class="progress" style="height:35px;">
						<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"
						     aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" id="tm-import-progressbar"
						     style="width: 0%;height:35px;line-height: 35px;">
							0% Complete
						</div>
					</div>
					<div>
						<strong style="color: darkred">
							<?php esc_html_e( 'Please do not navigate away while importing. It may take up to 10 minutes.', 'tm-core' ) ?>
						</strong>
					</div>
				</div>
				<script type="text/javascript">

					var docTitle = document.title;
					var importing = true;
					var el = document.getElementById('tm-import-progressbar');

					function progress_status(is) {

						var perc = parseInt(is * 100) + '%';
						el.style.width = perc;

						if (perc != '100%') {
							el.innerHTML = perc + ' Complete';
						}
						else {
							el.innerHTML = 'Initializing...';
							el.className = el.className.replace(/\bprogress-bar-info\b/, 'progress-bar-success');
						}
						document.title = el.innerHTML + '  - ' + docTitle;
					}

					function text_status(t) {
						document.getElementById('import-status').innerHTML = t;
					}

					function is_error(msg) {
						document.getElementById('error-import-msg').innerHTML += '<div class="notice notice-error">' + msg + '</div>';
						document.getElementById('error-import-msg').style.display = 'inline-block';
						text_status('');
						importing = false;
					}

					window.onbeforeunload = function (evt) {
						if (true == importing) {
							if (!evt) {
								evt = window.event;
							}

							evt.cancelBubble = true;
							evt.returnValue = '<?php esc_html_e( 'The importer is running. Please don\'t navigate away from this page.', 'tm-core' )?>';

							if (evt.stopPropagation) {
								evt.stopPropagation();
								evt.preventDefault();
							}
						}
					};

				</script>
			<?php

			include_once( TM_IMPORT_PATH . DS . 'run.importer.php' );

			?>
				<script type="text/javascript">
					document.getElementById('import-working').style.display = 'none';
					document.title = '<?php echo esc_html__( 'Import has completed', 'tm-core' ) ?> ';
				</script>

				<h2 class="tm-page-title"
				    style="color: <? echo esc_attr( $style['title_color'] ); ?>"><?php echo esc_html__( 'Import has completed', 'tm-core' ); ?>
					<?php if ( $style['logo'] ) { ?>
						<img class="logo" src="<?php echo esc_url( $style['logo'] ) ?>" alt="import logo"/>
					<?php } ?>
				</h2>

				<div class="success-message">
					<div class="content">
						<span id="total-time"></span>
						<p>
							<?php esc_html_e( 'Import is successful! Now customization is as easy as pie. Enjoy it!', 'tm-core' ) ?>
						</p>
					</div>
				</div>
				<script type="text/javascript">importing = false;</script>
			<?php

			} else {
			?>

				<h2 class="tm-page-title"
				    style="color: <? echo esc_attr( $style['title_color'] ); ?>"><?php echo esc_html( sprintf( __( 'Welcome to %s', 'tm-core' ), TM_THEME_NAME ) ); ?>
					<?php if ( $style['logo'] ) { ?>
						<img class="logo" src="<?php echo esc_url( $style['logo'] ) ?>" alt="import logo"/>
					<?php } ?>
				</h2>

				<div class="notice import-notice"
				     style="border-left-color: <?php echo esc_attr( $style['notice_color'] ) ?>;">
					<h4><?php esc_html_e( 'Sample Data', 'tm-core' ); ?></h4>
					<div class="content">
						<p>
							<?php esc_html_e( 'Our demo data import lets you have the whole data package in minutes, delivering all kinds of essential things quickly and simply. You may not have enough time for a coffee as the import is too fast!', 'tm-core' ) ?>
						</p>
					</div>
				</div>

				<div onclick="showSystemRequirements();"
				     style="cursor:pointer;"><?php echo esc_html_e( 'Show System Requirements', 'tm-molly' ); ?></div>

				<div id="system-requirements">
					<?php
					$dir                      = wp_upload_dir();
					$mem_limit                = ini_get( 'memory_limit' );
					$mem_limit_byte           = wp_convert_hr_to_bytes( $mem_limit );
					$upload_max_filesize      = ini_get( 'upload_max_filesize' );
					$upload_max_filesize_byte = wp_convert_hr_to_bytes( $upload_max_filesize );
					$post_max_size            = ini_get( 'post_max_size' );
					$post_max_size_byte       = wp_convert_hr_to_bytes( $post_max_size );

					$writeable_boolean                = wp_is_writable( $dir['basedir'] . '/' );
					$mem_limit_byte_boolean           = $mem_limit_byte < 268435456;
					$upload_max_filesize_byte_boolean = ( $upload_max_filesize_byte < 33554432 );
					$post_max_size_byte_boolean       = ( $post_max_size_byte < 33554432 );
					?>

					<h2><?php echo esc_html_e( 'System Requirements', 'tm-core' ); ?></h2>

					<table>
						<tr>
							<td>
								<?php esc_html_e( 'Uploads folder writable', 'tm-core' ); ?>
							</td>
							<td>
								<?php if ( $writeable_boolean ) { ?>
									<i class="dashicons dashicons-yes"></i>
								<?php } else { ?>
									<i class="dashicons dashicons-no"></i>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php esc_html_e( 'Memory Limit', 'tm-core' ); ?>
							</td>
							<td>
								<?php if ( $mem_limit_byte_boolean ) { ?>
									<i class="dashicons dashicons-no"></i>
								<?php } else { ?>
									<i class="dashicons dashicons-yes"></i>
								<?php } ?>
								<strong><?php echo esc_html_e( 'Currently: ', 'tm-core' ) . $mem_limit; ?></strong>
							</td>
						</tr>
						<tr>
							<td>
								<?php esc_html_e( 'Upload Max. Filesize', 'tm-core' ); ?>
							</td>
							<td>
								<?php if ( $upload_max_filesize_byte_boolean ) { ?>
									<i class="dashicons dashicons-no"></i>
								<?php } else { ?>
									<i class="dashicons dashicons-yes"></i>
								<?php } ?>
								<strong><?php echo esc_html_e( 'Currently: ', 'tm-core' ) . $upload_max_filesize; ?></strong>
							</td>
						</tr>
						<tr>
							<td>
								<?php esc_html_e( 'Max. Post Size', 'tm-core' ); ?>
							</td>
							<td>
								<?php if ( $upload_max_filesize_byte_boolean ) { ?>
									<i class="dashicons dashicons-no"></i>
								<?php } else { ?>
									<i class="dashicons dashicons-yes"></i>
								<?php } ?>
								<strong><?php echo esc_html_e( 'Currently: ', 'tm-core' ) . $post_max_size; ?></strong>
							</td>
						</tr>
					</table>

				</div>

				<div class="tm-demo-source-container">
					<h3><?php esc_html_e( 'Full Demo', 'tm-core' ); ?></h3>
					<p class="description"><?php esc_html_e( 'You can import one of Molly\'s demos. After importing, you site will look exactly the same with that demo from pictures to content, etc...', 'tm-core' ); ?>
						<br/>
						<?php esc_html_e( 'You should use this option if your website data is empty (posts, pages, menus...etc...).', 'tm-core' ); ?>
						<?php esc_html_e( 'We suggest you use the plugin', 'tm-core' ); ?>
						<a href="<?php echo esc_url( SITE_URI ); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=wordpress-reset&from=<?php echo strtolower( TM_THEME_NAME ); ?>-theme&TB_iframe=true&width=800&height=550"
						   class="thickbox" title="Install Wordpress Reset">"Wordpress Reset"</a>
						<?php esc_html_e( 'to reset your website before import.', 'tm-core' ); ?><br>
						<?php esc_html_e( 'If you want to install another demo, you\'ll need to reset website.', 'tm-core' ); ?>
					</p><br>
					<?php foreach ( $demos as $demo_id => $demo ) { ?>
						<?php
						$option   = TM_THEME_SLUG . '_' . $demo_id . '_imported';
						$imported = get_option( $option );
						?>
						<form class="tm-demo-source<?php echo( '1' == $imported ? ' imported' : '' ); ?>"
						      id="<?php echo esc_attr( $demo_id ); ?>" method="post" action=""
						      onsubmit="doSubmit(this);">
							<div class="tm-demo-source-screenshot">
								<?php if ( '1' == $imported ) { ?>
									<span><?php echo esc_html( 'Imported', 'tm-core' ); ?></span>
								<?php } ?>
								<img src="<?php echo esc_url( $demo['screenshot'] ); ?>"
								     alt="<?php echo esc_attr( $demo['name'] ); ?>">
							</div>
							<div class="tm-demo-source-heading">
								<h3 class="tm-demo-source-title"><?php echo esc_html( $demo['name'] ); ?></h3>

								<?php if ( '1' != $imported ) { ?>
									<input type="submit" id="submitbtn-<?php echo esc_attr( $demo_id ) ?>"
									       class="tm-demo-source-install submit-btn"
									       value="<?php echo esc_attr( 'Import', 'tm-core' ); ?>"/>
								<?php } ?>
								<input type="hidden" value="1" name="import_sample_data"/>
								<input type="hidden" value="<?php echo esc_attr( $demo_id ) ?>" name="demo"/>
							</div>
						</form>
					<?php } ?>
				</div>

				<?php if ( sizeof( $dummies ) > 0 ) { ?>
				<div class="tm-dummy-source-container">
					<h3><?php esc_html_e( 'Dummy Demo', 'tm-core' ); ?></h3>
					<p class="description"><?php esc_html_e( 'You can import pages optionally. This way is suitable if you want to get new homepages after updating.', 'tm-core' ) ?></p>
					<br>
					<form action="#" method="post" id="dummy-form">
						<div id="dummy-response"></div>
						<table>
							<tr>
								<th>
									<label
										for="dummy-select"><?php esc_html_e( 'Choose page to import', 'tm-core' ) ?></label>

									<select name="dummy" id="dummy-select">
										<option value=""><?php esc_html_e( '-- Select --' ); ?></option>
										<?php foreach ( $dummies as $dummy_id => $dummy ) {
											$option   = TM_THEME_SLUG . '_' . $dummy_id . '_imported';
											$imported = get_option( $option );
											?>
											<option value="<?php echo esc_attr( $dummy_id ); ?>"
											        data-screenshot="<?php echo esc_attr( $dummy['screenshot'] ); ?>"
												<?php echo $imported ? ( 'data-imported="true"' ) : ''; ?>><?php esc_html_e( $dummy['name'] ); ?></option>
										<?php } ?>
									</select>
								</th>
								<td>
									<div class="page-preview"><img
											src="<?php echo esc_attr( reset( $dummies )['screenshot'] ) ?>" alt=""/>
									</div>

									<input type="submit" name="dummy-submit" id="dummy-submit"
									       class="button button-primary" disabled="disabled"
									       value="<?php echo esc_attr( 'Import', 'tm-core' ); ?>">

									<div class="progress">
										<div class="progress-bar progress-bar-success progress-bar-striped active"
										     role="progressbar"
										     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
										     id="tm-dummy-progressbar"
										     style="width: 0%;">
										</div>
									</div>
								</td>
							</tr>
						</table>

					</form>
				</div>
			<?php } ?>
				<?php
			}
			?>
		</div><!--body-->
		<div class="footer">
			<?php echo TM_THEME_NAME; ?> <?php esc_html__( 'version', 'tm-core' ); ?> <?php echo TM_THEME_VERSION ?> &copy;
			by
			<a href="<?php echo esc_attr( $support['author_url'] ); ?>"
			   target="_blank"><?php echo $support['name']; ?></a>
			| <?php _e( 'Question?', 'tm-core' ); ?>
			<a href="<?php echo esc_url( $support['url'] ); ?>" target="_blank"><? echo $support['text']; ?></a>
		</div>
	</div><!-- /wrap -->
	<style type="text/css">
		#tm-import-page .import-notice a, #tm-import-page .footer a:not(.button) {
			color: <?php echo esc_attr($style['link_color']); ?>
		}
	</style>
	<script type="text/javascript">
		function doSubmit(form) {
			var id = form.id;
			var btn = document.getElementById('submitbtn-' + id);

			btn.className += ' disable';
			btn.disable = true;
			btn.value = 'Importing...';
		}
		function showSystemRequirements() {
			var sys = document.getElementById('system-requirements');

			if (sys.style.display == 'inline-block') {
				sys.style.display = 'none';
			} else {
				sys.style.display = 'inline-block';
			}
		}
		<?php
		if (isset( $time_elapsed_secs )) { ?>
		document.getElementById('total-time').innerHTML = '<?php echo sprintf( esc_html__( 'Total time: %s', 'tm-core' ), $time_elapsed_secs ); ?>';
		<?php } ?>
	</script>
</div><!-- /section -->
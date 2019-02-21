<?php
/**
 * Shortcode attributes
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Project_Details
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $post;

// Categories
$categories = get_the_term_list($post->ID, 'project-category', '<li>', ',</li><li>', '</li>');

// Meta
$date_completed = esc_attr(get_post_meta($post->ID, '_date_completed', true));
$client         = esc_attr(get_post_meta($post->ID, '_client', true));
$url            = esc_url(get_post_meta($post->ID, '_url', true));
$location       = esc_attr(get_post_meta($post->ID, '_location', true));
$value          = esc_attr(get_post_meta($post->ID, '_value', true));

?>
<div class="tm-project-details<?php echo esc_attr($el_class ? ' ' . $el_class : ''); ?>">
	<?php if ($post->post_type != 'project') {?>
		<div class="tm_project_details__warning">
			<?php esc_html_e('Project Details Shortcode only available for "Projects" content type.', 'tm-renovation'); ?>
		</div>
	<?php } else { ?>
		<table>
			<?php if ($date_completed) { ?>
				<tr class="date-completed">
					<td>
						<span class="date-completed__title meta-title"><?php esc_html_e('Date', 'tm-renovation'); ?></span>
						<span class="meta-value"><?php echo $date_completed; ?></span>
					</td>
				</tr>
			<?php } ?>
			<?php if ($client) { ?>
				<tr class="client">
					<td>
						<span class="client__title meta-title"><?php esc_html_e('Client', 'tm-renovation'); ?></span>
						<span class="meta-value"><?php echo $client; ?></span>
					</td>
				</tr>
			<?php } ?>
			<?php if ($location) { ?>
				<tr class="location">
					<td>
						<span class="meta-title"><?php esc_html_e('Location', 'tm-renovation'); ?></span>
						<span class="meta-value"><?php echo $location; ?></span>
					</td>
				</tr>
			<?php } ?>
			<?php if ($value) { ?>
				<tr class="value">
					<td>
						<span class="meta-title"><?php esc_html_e('Value', 'tm-renovation'); ?></span>
						<span class="meta-value"><?php echo $value; ?></span>
					</td>
				</tr>
			<?php } ?>
			<?php if($categories) { ?>
				<tr class="categories">
					<td>
						<span class="meta-title"><?php esc_html_e('Categories', 'tm-renovation'); ?></span>
						<div><ul class="meta-value"><?php echo $categories; ?></ul></div>
					</td>
				</tr>
			<?php } ?>
			<?php if ($url) { ?>
				<tr class="url">
					<td>
						<span class="meta-title"><?php esc_html_e('Link', 'tm-renovation'); ?></span>
						<span class="meta-value"><a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('projects_visit_project_link', esc_html_e('Visit project', 'tm-renovation')); ?></a></span>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php } ?>
</div>
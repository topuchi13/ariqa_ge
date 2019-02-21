<?php
/**
 * Single Project Meta
 *
 * @author      WooThemes
 * @package     Projects/Templates
 * @version     1.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $post;
?>
<div class="project-meta col-md-6">
  <h3><?php echo __('Project Details','tm-renovation'); ?></h3>
  <div class="project-meta__content">
  <?php
  // Categories
  $terms_as_text = get_the_term_list($post->ID, 'project-category', '<li>', ',</li><li>', '</li>');

  // Meta
  $client         = esc_attr(get_post_meta($post->ID, '_client', true));
  $url            = esc_url(get_post_meta($post->ID, '_url', true));
  $location       = esc_attr(get_post_meta($post->ID, '_location', true));
  $date_completed = esc_attr(get_post_meta($post->ID, '_date_completed', true));
  $value          = esc_attr(get_post_meta($post->ID, '_value', true));

  do_action('projects_before_meta');

//  if ($terms_as_text) {
//    echo '<div class="categories">';
//    echo '<span class="categories__title meta-title">' . __('Categories', 'tm-renovation') . ':</span>';
//    echo '<ul class="single-project-categories">';
//    echo $terms_as_text;
//    echo '</ul>';
//    echo '</div>';
//  }

  /**
   * Display client if set
   */

  if ($date_completed) {
    echo '<div class="date-completed">';
    echo '<span class="date-completed__title meta-title">' . __('Date Completed', 'tm-renovation') . ':</span>';
    echo '<span class="meta-value">' . $date_completed . '</span>';
    echo '</div>';
  }

  if ($client) {
    echo '<div class="client">';
    echo '<span class="client__title meta-title">' . __('Client', 'tm-renovation') . ':</span>';
    echo '<span class="meta-value">' . $client . '</span>';
    echo '</div>';
  }

  if ($location) {
    echo '<div class="location">';
    echo '<span class="location__title meta-title">' . __('Location', 'tm-renovation') . ':</span>';
    echo '<span class="meta-value">' . $location . '</span>';
    echo '</div>';
  }

  if ($value) {
    echo '<div class="value">';
    echo '<span class="value__title meta-title">' . __('Value', 'tm-renovation') . ':</span>';
    echo '<span class="meta-value">' . $value . '</span>';
    echo '</div>';
  }

  if ($url) {
    echo '<div class="url">';
    echo '<span class="url__title meta-title">' . __('Link:', 'tm-renovation') . '</span>';
    echo '<span class="meta-value"><a href="' . esc_url($url) . '">' . apply_filters('projects_visit_project_link', __('Visit project', 'tm-renovation')) . '</a></span>';
    echo '</div>';
  }

  do_action('projects_after_meta');
  ?>
  </div>
</div>
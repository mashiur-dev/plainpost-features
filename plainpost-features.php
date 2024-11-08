<?php
/**
 * Plugin Name:       Plain Post Features
 * Description:       Additional blocks for the Plain Post Theme.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Mashiur Rahman
 * Author URI:		  https://mashiurz.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       plainpost-features
 *
 * @package           plainpost-features
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function plainPostBlockInit() {
	$blocks = array(
		'categories-list',
		'trending-posts',
	);

	foreach ($blocks as $block) {
		register_block_type(__DIR__ . "/build/{$block}");
	}
}
add_action( 'init', 'plainPostBlockInit' );


/**
 * Post View count
 */

function plainpostSetPostViews($postID = null)
{
	if (!is_single() || 'post' !== get_post_type() || current_user_can('administrator'))
		return;

	if (empty($postID)) {
		global $post;
		$postID = $post->ID;
	}

	$postID = !empty($postID) ? $postID : get_the_ID();
	$countKey = 'plainpost_post_views_count';
	$count = get_post_meta($postID, $countKey, true);

	//update_post_meta($postID, $countKey, ((int) $count) + 1);

	if ($count == '') {
		$count = 0;
		delete_post_meta($postID, $countKey);
		add_post_meta($postID, $countKey, '0');
	} else {
		$count++;
		update_post_meta($postID, $countKey, $count);
	}

}
add_action('template_redirect', 'plainpostSetPostViews');
<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<div class="plainpost-trending-posts">

		<?php
		$numberOfCategories = isset($attributes['numberOfPosts']) ? $attributes['numberOfPosts'] : '3';

		$trendingPosts = new WP_Query(
			array(
				"post_status" => "publish",
				'post__not_in' => get_option("sticky_posts"),
				'posts_per_page' => sanitize_text_field($numberOfCategories),
				'meta_key' => 'plainpost_post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
			)
		);

		if ($trendingPosts->have_posts()):
			while ($trendingPosts->have_posts()):
				$trendingPosts->the_post();

				$featuredImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
		?>
		
			<a class="plainpost-trending-post" href="<?php the_permalink(); ?>">
				<img src="<?php echo esc_attr($featuredImg); ?>">
				<h1><?php the_title(); ?></h1>
				<h5><?php echo get_the_date('j F Y'); ?></h5>
			</a>
		
		<?php
			endwhile;
		endif;

		?>
	</div>
</div>
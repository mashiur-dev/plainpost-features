<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<div class="plainpost-category-list">
		<?php

		$numberOfCategories = isset($attributes['numberOfCategories']) ? $attributes['numberOfCategories'] : '12';

		$categoriesList = get_categories(array(
				'orderby' => 'name',
				'order' => 'ASC',
				'number' => sanitize_text_field($numberOfCategories),
			));

		foreach ($categoriesList as $category) {

		?>

			<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" alt="<?php echo esc_attr(sprintf(__('View all posts in %s', 'plainpost-features'), $category->name)); ?>" class="category">

				<h4><?php echo esc_html($category->name); ?></h4>
				<p><?php echo esc_html($category->description); ?></p>

			</a>

		<?php
		
		}

		?>
		
	</div>
</div>

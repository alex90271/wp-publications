<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
get_header();
while (have_posts()):
	the_post();
	?>
	<main id="content" <?php post_class('site-main'); ?>>
		<header class="page-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</header>
		<div class="page-content">
			<?php the_content(); ?>
			<div class="post-tags">
				<p>
					<strong>Author(s):</strong>
					<?php echo get_post_meta(get_the_id(), 'wpap_publication-option-authors', true); ?>
				</p>
				<p>
					<strong>Published:</strong>
					<?php echo get_the_date(); ?>
				</p>
				<p>
					<?php echo implode(',',get_the_taxonomies( get_the_id(), array('publication-category','template' => '%z%l', 'term_template' => '%2$s' )) ) ?>
				</p>

				<?php
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-paperpdf', true))) {
					echo '<a class="wpap-button-link" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-paperpdf', true) . '"><button class="wpap-button">' . __('PDF', 'wpap') . '</button></a>';
				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-bibtex', true))) {
					echo '<a class="wpap-button-link" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-bibtex', true) . '"><button class="wpap-button">' . __('BibTex', 'wpap') . '</button></a>';

				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-slidesppt', true))) {
					echo '<a class="wpap-button-link" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-slidesppt', true) . '"><button class="wpap-button">' . __('PPT', 'wpap') . '</button></a>';

				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-website', true))) {
					echo '<a class="wpap-button-link" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-website', true) . '"><button class="wpap-button">' . __('Website', 'wpap') . '</button></a>';

				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-doi', true))) {
					echo '<a class="wpap-button-link" href="https://doi.org/' . get_post_meta(get_the_id(), 'wpap_publication-option-doi', true) . '"><button class="wpap-button">' . get_post_meta(get_the_id(), 'wpap_publication-option-doi', true) . '</button>';

				}
				?>
			</div>
			<?php wp_link_pages(); ?>
		</div>

	</main>

	<?php
endwhile;
get_footer();
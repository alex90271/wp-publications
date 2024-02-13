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
					<strong>Published(s):</strong>
					<?php echo get_the_date(); ?>
				</p>

				<?php
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-paperpdf', true))) {
					echo '<button class="wpap-button" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-paperpdf', true) . '">' . __('PDF', 'wpap') . '</button>';
				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-bibtex', true))) {
					echo '<button class="wpap-button" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-bibtex', true) . __('BibTex', 'wpap') . '</button>';

				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-slidesppt', true))) {
					echo '<button class="wpap-button" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-slidesppt', true) . '">' . __('PPT', 'wpap') . '</button>';

				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-website', true))) {
					echo '<button class="wpap-button" href="' . get_post_meta(get_the_id(), 'wpap_publication-option-website', true) . '">' . __('Website', 'wpap') . '</button>';

				}
				if (!empty(get_post_meta(get_the_id(), 'wpap_publication-option-doi', true))) {
					echo '<button class="wpap-button" href="https://doi.org/' . get_post_meta(get_the_id(), 'wpap_publication-option-doi', true) . '">' . get_post_meta(get_the_id(), 'wpap_publication-option-doi', true) . '</button>';

				}
				?>
			</div>
			<?php wp_link_pages(); ?>
		</div>

	</main>

	<?php
endwhile;
get_footer();
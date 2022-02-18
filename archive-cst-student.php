<?php
/**
 * The template for displaying the Student archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coraschooltheme
 */

get_header();
?>

	<main id="primary" class="site-main">

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$args = array(
				'post_type'         => 'cst-student',
				'posts_per_page'    => -1,
				'tax_query'         => array(
					array(
						'taxonomy' 	=> 'cst-student-category',
						'field'	   	=> 'slug',
						'terms'		=> array('designer', 'developer')
					)
                ),
                'order'             => 'ASC',
                'orderby'           => 'title'
			);
			$query = new WP_Query($args);
			if ($query -> have_posts()) {
				while($query -> have_posts()) {
					$query -> the_post();
					?>

					<article>
						<a href="<?php the_permalink(); ?>" >
							<h2> <?php the_title(); ?> </h2>
							<?php the_post_thumbnail('medium'); ?>
						</a>
						<?php the_excerpt(); ?>

                        <p class="specialty">Specialty: 
                            <?php 

                                $terms = get_the_terms( $query->ID, 'cst-student-category' );
                                foreach($terms as $term) {
                                    $term_link = get_term_link($term);
                                    echo '<a href="'. esc_url($term_link) . '">' . $term->name . '</a>';
                                }

                            ?>
                        </p>

					</article>
 
					<?php
				}
				wp_reset_postdata();
		
			}
			?>

	</main><!-- #primary -->

<?php
// get_sidebar();
get_footer();

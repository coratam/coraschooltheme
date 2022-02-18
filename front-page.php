<?php
/**
 * The template for displaying the Home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coraschooltheme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<!-- get_template_part( 'template-parts/content', 'page' ); -->
		<!-- ?> -->

        <h1><?php the_title(); ?></h1>

        <section class="home-intro">
			<?php
			// Load the intro section from a separate page using WP_Query()
			// The page_id is the ID of the About page, where we added text 
			$args = array( 'page_id' => 25 );

			$intro_query = new WP_Query( $args );
			
			if( $intro_query -> have_posts() ) {
				while( $intro_query -> have_posts() ) {
					$intro_query -> the_post();
					the_post_thumbnail();
					the_content();
					// the_post_thumbnail();
				}
				wp_reset_postdata();
			}

			?>																
		</section>
		

		<section class="home-blog">
			<h2>Latest News Scoop</h2>
			<?php
			$args = array(
				'post_type'		 => 'post',
				'posts_per_page' => 3
			);
			$blog_query = new WP_Query($args);
			if( $blog_query -> have_posts() ) {
				echo "<section class='home-news'>";
				while( $blog_query -> have_posts() ) {
					$blog_query -> the_post();
					?>
					<article>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
							<h3><?php the_title(); ?></h3>
						</a>	
					</article>
					<?php
				}
				wp_reset_postdata();
				echo "</section>";
			}
			?>
		</section>
		
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
// get_sidebar();
get_footer();
<?php
/**
 * The taxonomy template for displaying either Designer or Developer students
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coraschooltheme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1><?php single_term_title(); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
				
				<article>
					<a href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
						<?php 
						the_post_thumbnail( 'student-post', array( 'class' => 'alignleft' ) ); 
						?>
					</a>
					<?php the_content(); ?>
				</article>

				<?php
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #primary -->

<?php
get_footer();

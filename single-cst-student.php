<?php
/**
 * The template for displaying single Student posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package coraschooltheme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php


		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

            $terms = get_the_terms( $query->ID, 'cst-student-category' );
            
            foreach($terms as $term) {
                wp_reset_query();
                $args = array(  
                    'post_type' => 'cst-student',
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'cst-student-category',
                            'field' => 'slug',
                            'terms' => $term->slug,
                        ),
                    ),
                );


                $loop = new WP_Query($args);
                if($loop->have_posts()) {
                    ?>
                    <section class="single-students">
                        <h3>Meet Other <?php echo $term->name; ?>s</h3>
                        <?php
                        while( $loop->have_posts() ) : $loop->the_post();
                            echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
                        endwhile;
                    echo "</section>";
                };
                wp_reset_query();
                
            }


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
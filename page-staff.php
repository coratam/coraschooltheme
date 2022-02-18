<?php
/**
 * The template for displaying Staff pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coraschooltheme
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>

                <div class="entry-content">
                <?php the_content(); ?>

                <?php 

                $args = array(
                    'post_type'      => 'cst-staff',
                    'posts_per_page' => -1, 
                    'order'          => 'ASC',
                    'orderby'        => 'title'
                );
                
                $query = new WP_QUERY( $args );
                if($query -> have_posts()) {
                    while($query -> the_post()) {
                        $query -> the_post();
                    }
                    wp_reset_postdata();
                }

                ?>

                <?php

                $taxonomy = 'cst-staff-category';
                $terms    = get_terms(
                    array(
                        'taxonomy' => $taxonomy
                    )
                );
                if($terms && ! is_wp_error($terms)) {
                    foreach($terms as $term) {
                        $args = array(
                            'post-type' => 'cst-staff',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'orderby' => 'title',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field' => 'slug',
                                    'terms' => $term->slug,
                                )
                            ),
                        );

                        $query = new WP_Query( $args );
						
						if ( $query -> have_posts() ) {
							echo '<h2>' . $term->name . '</h2>';

                            echo "<section class='staff-grid'>";
                            while ( $query -> have_posts() ) {
								$query -> the_post();
								if ( function_exists( 'get_field' ) ) {
                                echo "<article>";
									if ( get_field( 'bio' ) ) {
										echo '<h3 id="'. get_the_ID() .'">'. get_the_title() .'</h3>';
										echo '<p>'. the_field( 'bio' ) .'</p>';
									};
                                    if( get_field('courses') ) {
                                        echo '<p>'. the_field('courses') .'</p>';
                                    }
                                    if( get_field('website-link') ) {
                                        ?>
                                        <a href="<?php echo the_field('website-link'); ?>">Instructor's Website</a>
                                        <?php
                                    }
                                echo "</article>";
    
					        	};
							};
                            wp_reset_postdata();
                            echo "</section>";
                        };
                    };
                }

                ?>
                </div>

            </article>

        <?php endwhile; ?>

        <!-- Calls in work-categories.php, which outputs links to each term -->
	    <?php 
        // get_template_part('template-parts/staff', 'categories') 
        ?>


	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();

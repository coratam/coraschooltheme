<?php
/**
 * The template for displaying the Schedule
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
        <h2>Course Schedule</h2>

		<?php

        // Check rows exists.
        if( have_rows('course-schedule') ):
            echo "<table>";
            echo "<tr>";
                echo "<th>Date</th>";
                echo "<th>Course</th>";
                echo "<th>Instructor</th>";
            echo "</tr>";
            // Loop through rows.
            while( have_rows('course-schedule') ) : the_row();

                $date = get_sub_field('date');
                $course = get_sub_field('course');
                $instructor = get_sub_field('instructor');
                
                echo "<tr>";
                echo "<td>$date</td>";
                echo "<td>$course</td>";
                echo "<td>$instructor</td>";
                echo "</tr>";

            // End loop.
            endwhile;
            echo "</table>";

        else :
            echo "<p>The course schedule will be updated shortly...</p>";
        endif;

		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();

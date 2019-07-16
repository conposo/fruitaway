<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SinglePost extends Controller
{
    use Partials\Testimonials;
    protected $acf = true;

    public static function related_posts() {
        $args = array(
            'posts_per_page' => 4,
            'post_in' => get_the_tag_list(),
        );
        $the_query = new \WP_Query( $args );

        while ( $the_query->have_posts() ) : $the_query->the_post();
            echo '<div class="col-6 col-md-3">';
            echo '<div class="post-thumbnail">';
            echo '<a href="' . get_permalink() . '" title="';
            echo the_title_attribute();
            echo '">';

            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'related-post' );
            }

            echo '</a></div>'; // closing related post
            echo '<div class="pt-content">';
            echo '<a href="' . get_permalink() . '" title="';
            echo the_title_attribute();
            echo '">';
            echo '<p>' . get_the_author_meta('display_name') . ' | ' . get_the_date('d.m.Y') . '</p>';
            echo '<p>';
            the_title();
            echo '</p>';
            echo '</a></div></div>'; // closing rp-content
        endwhile;
        wp_reset_postdata();
    }

}

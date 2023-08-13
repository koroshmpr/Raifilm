<?php
/** Template Name: Blog Page */

get_header(); ?>

<!--    <section class="container py-3">-->
<!--        <div class="row row-cols-1 row-cols-lg-3 justify-content-between g-4">-->
<!--            --><?php
//            $j = 0;
//            $args = array(
//                'post_type' => 'post',
//                'post_status' => 'publish',
//                'posts_per_page' => '-1',
//                'ignore_sticky_posts' => true
//            );
//            $loop = new WP_Query($args);
//            if ($loop->have_posts()) : $i = 0;
//                /* Start the Loop */
//                while ($loop->have_posts()) :
//                    $loop->the_post();
//                    get_template_part('template-parts/useful/blog-card');
//                    $j++;
//                endwhile;
//            endif;
//             ?>
<!--        </div>-->
<!--        --><?php //get_template_part('template-parts/useful/pagination');
//        wp_reset_postdata();?>
<!--    </section>-->
<?php get_footer(); ?>
<?php /* Template Name: Home */
/**
 * Front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Macan
 */

get_header();


if (have_posts())
    the_post();
//hero
get_template_part('template-parts/homePage/hero');


get_footer();
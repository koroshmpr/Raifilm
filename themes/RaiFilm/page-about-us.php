<?php
/**
 * Template Name: about-us
 **/
get_header(); ?>
    <section class="container-fluid swiper page-swiper vh-100">
        <div class="px-3 px-lg-0 swiper-wrapper">
            <!--            description -->
            <div class="swiper-slide row align-content-center justify-content-start">
                    <h1 class="page-title display-2 fw-bolder lh-1 mb-0"> <?php the_title(); ?></h1>
                    <p class="text-white mb-0 fs-5 text-justify ps-5 ps-lg-0"><?= get_field('excerpt'); ?></p>
            </div>
            <!--            details-->
            <div class="swiper-slide row justify-content-start align-content-center mt-4 mt-lg-0" style="direction: initial;">
                <h5 class="text-white fw-bold"><?= get_field('detail_title_one') ?></h5>
                <p class="text-white-50 text-justify small hover-text lazy"><?= get_field('detail_content_one') ?></p>
                <h5 class="text-white fw-bold"><?= get_field('detail_title_two') ?></h5>
                <p class="text-white-50 text-justify small hover-text lazy"><?= get_field('detail_content_two') ?></p>
            </div>
            <!--            our team-->
            <div class="swiper-slide row justify-content-start align-content-center">
                <h2 class="page-title display-1 fw-bolder w-auto"><?= get_field('team_title') ?></h2>
                <img class="img-fluid" src="<?= get_field('team_image')['url'] ?>"
                     alt="<?= get_field('team_image')['alt'] ?>">
            </div>
        </div>
        <div class="navigation position-fixed bottom-0 start-0 d-flex gap-3 mb-3 ms-5 z-top justify-content-end align-content-center">
            <div class="swiper-button-prev swiper__nav text-primary position-static"></div>
            <div class="swiper-button-next swiper__nav text-primary position-static"></div>
        </div>
    </section>
<?php get_footer();
<?php
/**
 * Template Name: contact-us
 **/
get_header(); ?>
    <section class="container-fluid page-swiper vh-100">
        <div class="px-3 px-lg-0 swiper-wrapper">
<!--            contact information-->
            <div class="swiper-slide row justify-content-center justify-content-start">
                <div class="pe-4 d-flex flex-column justify-content-center align-items-start">
                    <h1 class="page-title display-2 fw-bolder lh-1 mb-0"> <?php the_title(); ?></h1>
                    <p class="text-white-50 mb-0 fs-5"><?= get_field('excerpt'); ?></p>
                    <h5 class="text-white-50 mb-0">Address:</h5>
                    <p class="mb-0 fs-5"><?= get_field('address', 'option') ?></p>
                    <h5 class="text-white-50 mb-0">Phone:</h5>
                    <a class="text-white fs-5" href="tel:<?= get_field('phone', 'option') ?>"> <?= get_field('phone', 'option') ?></a>
                    <h5 class="text-white-50 mb-0">Email:</h5>
                    <a class="text-white fs-5" href="mailto:<?= get_field('email', 'option') ?>"><?= get_field('email', 'option') ?></a>
                </div>
            </div>
<!--            contact form-->
            <div class="swiper-slide align-content-center row ">
                <h5 class="display-2 text-white fw-bold">HIT IT UP</h5>
                <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
            </div>
<!--            map-->
            <div class="swiper-slide row align-content-center justify-content-center pt-5">
                <?= get_field('map' , 'option')?>
            </div>
        </div>
        <div class="navigation position-fixed bottom-0 start-0 d-flex gap-3 mb-3 ms-5 z-top justify-content-end align-content-center">
            <div class="swiper-button-prev swiper__nav text-primary position-static"></div>
            <div class="swiper-button-next swiper__nav text-primary position-static"></div>
        </div>
    </section>
<?php get_footer();
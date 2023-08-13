<?php get_header(); ?>
<section class="container-fluid">
    <div class="row vh-100 justify-content-center gap-lg-5 align-items-start align-items-lg-stretch">
        <div class="col-lg-4 order-2 order-lg-1 pt-4 pt-lg-0 row align-content-lg-center align-content-start justify-content-center h-sm-50">
            <div class="py-lg-5 mx-3 px-3 d-flex flex-column justify-content-lg-center align-items-lg-start align-items-center gap-3">
                <h1 class="cat-title display-2 fw-bolder lh-1 text-center text-lg-end"> <?php the_title(); ?></h1>
                <p class="text-white-50"> <?= get_the_excerpt(); ?></p>
            </div>
        </div>
        <div class="order-1 order-lg-2 col-lg-6 row pt-5 g-4 align-content-start px-lg-4">
            <?php if (get_field('content_type') == 'picture') { ?>
                <img class="object-fit single-image border border-primary p-2 img-fluid mt-1"
                     src="<?= get_field('portfolio_picture')['url']; ?>"
                     alt="<?php the_title(); ?>">
            <?php } ?>
            <?php if (get_field('content_type') == 'video') { ?>
                <video class="w-100 modal-video border border-primary p-2 img-fluid mt-1"
                       src="<?= get_field('portfolio_video')['url']; ?>"
                       controls>
                </video>
            <?php } ?>
            <?php
            $portfolio_category = get_the_terms($post->ID, 'portfolio_categories');
            $current_post_id = get_the_ID();
            $current_category_id = $portfolio_category[0]->term_id;

            $next_post = get_next_post($current_category_id, '', 'portfolio_categories');
            $prev_post = get_previous_post($current_category_id, '', 'portfolio_categories');

            // Get the category permalink
            $category_permalink = get_term_link($current_category_id, 'portfolio_categories');
            ?>
            <div class="mt-lg-5 mt-0 order-first order-lg-last d-grid d-lg-inline col-12 position-relative h-auto">
                <?php if ($next_post) { ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="page-title fs-5 float-end fw-bold next-post-link text-primary d-flex align-content-center justify-content-center gap-2">
                        <i class="bi bi-chevron-left lh-0"></i>
                        <?php echo get_the_title($next_post->ID); ?>
                    </a>
                <?php  } else { ?>
                <p class="float-end mb-0"></p>
                <?php } ?>

                <a href="<?= $category_permalink; ?>" class="cat-link start-50 top-0 py-3 py-lg-0 text-center lh-0">
                    <i class="bi bi-grid-3x3-gap page-title fs-3 lh-0"></i>
                </a>
                <?php if ($prev_post) { ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="page-title fs-5 float-start fw-bold prev-post-link text-primary d-flex align-content-center justify-content-center gap-2">
                        <?php echo get_the_title($prev_post->ID); ?>
                        <i class="bi bi-chevron-right lh-0"></i>
                    </a>
                <?php } else { ?>
                    <p class="float-start mb-0"></p>
               <?php } ?>

            </div>

        </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>

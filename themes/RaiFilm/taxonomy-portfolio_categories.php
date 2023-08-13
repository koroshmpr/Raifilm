<?php get_header(); ?>
<section class="container-fluid">
    <div class="row vh-100 bg-dark justify-content-center justify-content-lg-evenly gap-lg-2 align-items-start align-items-lg-stretch">
        <div class="col-lg-4 order-2 order-lg-1 bg-dark position-relative row align-content-lg-center align-content-start justify-content-center h-sm-50">
            <div class="py-lg-5 d-flex p-0 flex-column justify-content-lg-center align-items-lg-start align-items-center gap-3">
                <h1 class="cat-title display-1 fw-bolder lh-1 text-center text-lg-end"> <?php single_cat_title(); ?></h1>
                <?php
                $category = get_queried_object();
                $excerpt = category_description($category->term_id); ?>
                <p class="text-white-50"> <?= $excerpt ?></p>
            </div>
            <div class="cat-section swiper hero-swiper position-absolute start-0 end-0 mb-lg-5">
                <div class="swiper-wrapper">
                    <?php
                    $terms = get_terms('portfolio_categories');
                    foreach ($terms as $category) :
                        // Get the value of the 'my_field' ACF field for the current category
                        $thumbnail = get_field('taxonomy_thumbnail', 'category_' . $category->term_id);
                        $excerpt = $category->description;
                        $permalink = get_term_link($category);
                        ?>
                        <div class="swiper-slide"
                             data-title="<?= $category->name; ?>"
                             data-excerpt="<?= $excerpt; ?>"
                             data-url="<?= $permalink; ?>"
                             data-image="<?php if (!empty($thumbnail)) {
                                 echo $thumbnail['url'];
                             } ?>">
                            <div class="d-flex justify-content-center">
                                <a href="<?= $permalink; ?>"
                                   class="mb-0 title-slider text-center fw-bold caption"><?= strtoupper($category->name); ?></a>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 posts_section order-1 order-lg-2 row row-cols-lg-3 row-cols-1-5 pt-5 g-4 align-content-start px-lg-4 overflow-y-scroll">
            <?php
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_categories',
                        'field' => 'slug',
                        'terms' => get_queried_object()->slug,
                    ),
                ),
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $post_id = get_the_ID(); ?>
                    <div class="position-relative post-card">
                        <?php if (get_field('content_type') == 'picture') { ?>
                            <img height="200" class="w-100 object-fit-scale"
                                 src="<?= get_field('portfolio_picture')['url']; ?>"
                                 alt="<?php the_title(); ?>">
                            <div class="post-detail z-top position-absolute top-50 start-50 translate-middle d-flex gap-2 align-content-center">
                                    <span data-bs-toggle="modal"
                                          data-bs-target="#post-<?= $post_id; ?>"
                                          class="text-white fs-1 lh-1">
                                        <i class="bi bi-zoom-in"></i>
                                    </span>
                                <a class="text-white fs-2 lh-sm"
                                   href="<?php the_permalink(); ?>">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        <?php } ?>
                        <?php if (get_field('content_type') == 'video') { ?>
                            <img height="200" class="w-100 object-fit-scale"
                                 src="<?= get_field('portfolio_video_cover')['url']; ?>"
                                 alt="<?php the_title(); ?>">
                            <div class="post-detail z-top position-absolute top-50 start-50 translate-middle d-flex gap-2 align-content-center">
                                   <span data-bs-toggle="modal"
                                         data-bs-target="#post-<?= $post_id; ?>"
                                         class="text-white fs-1 lh-1">
                                       <i class="bi bi-play"></i>
                                   </span>
                                <a class="text-white fs-2 lh-sm"
                                   href="
                                    <?php the_permalink(); ?>">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="post-detail position-absolute top-0 end-0 bottom-0 mx-2 start-0 bg-primary bg-opacity-75 row align-content-end justify-content-start">
                            <p class="text-white text-start fs-5 uppercase"><?php the_title(); ?></p>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <h6 class="page-title fs-2 w-100 text-center fw-bold"> there is no portfolio , try another
                    categories</h6>
            <?php endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer();
$query = new WP_Query($args);
if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
        $post_id = get_the_ID(); ?>
        <!-- Modal -->
        <div class="modal fade" id="post-<?= $post_id; ?>" tabindex="-1" aria-labelledby="post-<?= $post_id; ?>-label"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border bg-primary bg-opacity-50 border-primary rounded-0 py-2">
                        <button type="button" class="btn-close bg-primary rounded-0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        <a href="<?php the_permalink(); ?>" class="modal-title fs-4 text-white px-4 pt-1 bg-opacity-75 fs-bolder uppercase"
                            id="post-<?= $post_id; ?>-label"><?= get_the_title(); ?></a>
                    </div>
                    <div class="modal-body p-0">
                        <?php if (get_field('content_type') == 'picture') { ?>
                            <img class="modal-img object-fit border border-primary p-2 img-fluid"
                                 src="<?= get_field('portfolio_picture')['url']; ?>"
                                 alt="<?php the_title(); ?>">
                        <?php } ?>
                        <?php if (get_field('content_type') == 'video') { ?>
                            <video class="w-100 modal-video border border-primary p-2 img-fluid"
                                   src="<?= get_field('portfolio_video')['url']; ?>"
                                   controls>
                            </video>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <script>
            var modal = document.getElementById('post-<?= $post_id; ?>');
            var video = modal.querySelector('.modal-video');

            modal.addEventListener('hidden.bs.modal', function () {
                // Pause the video when the modal is closed
                video.pause();
                video.currentTime = 0; // reset video to start
            });
        </script>
    <?php endwhile;
    wp_reset_postdata();
else :
    ?>
    <h6 class="page-title fs-2 w-100 text-center fw-bold"> no data, try another</h6>
<?php
endif; ?>

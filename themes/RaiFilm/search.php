<?php get_header();
// Modify search query to only search for products
$search_query = new WP_Query(array(
    'post_type' => 'portfolio',
    's' => get_search_query()
));
?>
<div class="container py-5 min-vh-100">
    <div class="row justify-content-center align-content-center h-100">
        <div class="col-lg-6 mt-3 mt-lg-4">
            <form class="input-group overflow-hidden"
                  method="get"
                  action="<?php echo esc_url(home_url('/')); ?>">
                <input id="search-form" type="search" name="s"
                       class="form-control bg-transparent rounded-0 text-white"
                       placeholder="Search for portfolios"
                       aria-label="Search">
                <button type="submit" class="btn btn-primary search-submit rounded-0">
                    <i class="bi bi-search fs-5 small-sm-down lh-1"></i>
                </button>
            </form>
            <div class="d-block d-lg-flex align-items-center gap-3 py-4 justify-content-center">
                Searched for :
                <h1 class="fw-bold text-primary mb-0"> <?= the_search_query(); ?> </h1>
            </div>

        </div>
    </div>
    <?php
    if (have_posts()) { ?>
        <div class="row my-3 row-cols-lg-3 justify-content-evenly row-cols-1">
            <?php while (have_posts()) {
                the_post();
                if (get_post_type() === 'portfolio') { ?>
                    <div class="p-2 animate__animated animate__fadeInRight">
                        <a class="p-2 d-flex justify-content-evenly gap-3 align-items-center border border-primary border-opacity-50 rounded-0"
                           href="<?php the_permalink(); ?>">
                            <img style="height: 100px" class="col-3 rounded-0 border-opacity-75 img-thumbnail object-fit bg-transparent border-primary" src="<?php echo the_post_thumbnail_url(); ?>"
                                 alt="<?php the_title(); ?>">
                            <div class="col">
                                <h5 class="fw-bolder text-primary"> <?= get_the_title(); ?></h5>
                                <p class="text-white"><?= wp_trim_words(get_the_content(), 18); ?></p>
                            </div>
                        </a>
                    </div>
                <?php }
            } ?>
        </div>
        <?php
        $links = paginate_links(array(
            'type' => 'array',
            'prev_next' => false,

        ));
        if ($links) : ?>
            <nav class=" animate__animated animate__fadeInUp" aria-label="age navigation example">
                <?php echo '<ul class="pagination justify-content-center align-items-center gap-3">';
                // get_previous_posts_link will return a string or void if no link is set.
                if ($prev_posts_link = get_previous_posts_link(__('Previous'))) :
                    echo '<li class="prev-list-item page-item me-4 bg-primary py-2 px-3 rounded text-white">';
                    echo $prev_posts_link;
                    echo '</li>';
                endif;
                echo '<li class="page-item me-4 ">';
                echo join('</li><li class="page-item me-4">', $links);
                echo '</li>';

                // get_next_posts_link will return a string or void if no link is set.
                if ($next_posts_link = get_next_posts_link(__('Next'))) :
                    echo '<li class="next-list-item page-item me-4 bg-primary py-2 px-3 rounded text-white">';
                    echo $next_posts_link;
                    echo '</li>';
                endif;
                echo '</ul>';
                ?>
            </nav>
        <?php endif;
    } else {
        echo '<h2 class="headline headline--small-plus text-center">نتیجه ای یافت نشد</h2>';
    }
    ?>

</div>


<?php get_footer(); ?>

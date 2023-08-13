<section class="container-fluid">
    <div class="row position-relative vh-100 bg-dark justify-content-center justify-content-lg-end gap-lg-5">
        <div class="col-lg-4 gap-5 order-2 order-lg-1 category-detail_section overflow-hidden z-1 bg-dark position-relative px-0 row align-content-end mb-4 mb-lg-0">
            <div class="my-5 mx-lg-3 px-lg-2 d-flex flex-column justify-content-center align-items-lg-start align-items-center gap-4"
                 style="direction: ltr">
                <p class="slide-index text-light fw-bolder mb-0"></p>
                <h1 class="main-title display-1 fw-bolder lh-1 animate__animated animate__bounceInRight"></h1>
                <p class="main-excerpt text-white-50 mb-0 animate__animated animate__bounceInRight animate__delay-1s"></p>
                <a href="" class="btn bg-primary text-white main-bottom rounded-2 pt-2 fs-4 fw-bolder animate__animated animate__bounceInRight animate__delay-2s">SEE PROJECT</a>
            </div>
            <div class="cat-section swiper hero-swiper pt-2 pb-1 mb-lg-n3 animate__animated animate__bounceInUp animate__delay-3s">
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
                                <p class="mb-0 title-slider text-center fw-bold caption"><?= strtoupper($category->name); ?></p>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-7 order-1 order-lg-2 full-screen-section h-100 animate__animated animate__bounceInLeft"></div>
    </div>
</section>


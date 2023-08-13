<div id="sideNavigation" class="sidenav d-flex flex-column justify-content-between">
    <div class="closeBtn">&times;</div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'headerMenuLocation',
        'menu_class' => 'navbar-nav gap-3 align-items-start list-unstyled',
        'container' => false,
        'menu_id' => 'navbarTogglerMenu',
        'item_class' => 'nav-item',
        'link_class' => 'pe-3 pe-lg-0 lazy text-decoration-none fw-bold',
        'depth' => 1,
    ));
    wp_reset_postdata();
    ?>
    <form class="search-box d-lg-none m-3" method="get"
          action="<?php echo esc_url(home_url('/')); ?>">
        <button type="button" aria-label="search-button" aria-labelledby="search-button" class="btn-search d-flex align-content-center justify-content-center"><i class="bi bi-search px-2 pt-2"></i></i></button>
        <input type="text" aria-label="search" class="input-search" placeholder="Type to Search..." id="search-form" type="search" name="s" aria-label="Search">
    </form>
</div>
<div class="topNav-mob d-lg-none position-absolute top-0 start-0 w-100 bg-transparent text-end px-3 pt-2 z-2">
    <a class="text-white fs-4" aria-label="menu-button-mobile" href="#" id="svg-link-mob"><i class="bi bi-list"></i></a>
</div>
<nav class="animate__animated animate__slideInRight topNav position-absolute end-0 top-0 bottom-0 row flex-column justify-content-between align-content-center d-none d-lg-flex">
    <p></p>
    <a href="#" aria-label="menu-button" id="svg-link">
        <?php get_template_part('template-parts/svg/logo');?>
    </a>
    <div class="overflow-hidden pe-4"><p class="fw-bolder text-dark">MENU</p></div>
</nav>
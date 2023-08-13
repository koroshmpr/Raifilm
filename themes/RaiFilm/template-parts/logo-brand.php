  <div class="logo-container d-flex align-content-center">
    <?php if (get_field('logo_type', 'option') == 'image') { ?>
        <a class="logo-brand" href="/">
            <img width="150" class="h-auto mt-2"
                 src="<?= get_field('logo_image', 'option')['url']; ?>"
                 alt="<?= get_field('logo_image', 'option')['title']; ?>">
        </a>
    <?php }
    if (get_field('logo_type', 'option') == 'svg') { ?>
        <a class="logo-brand" href="/">
            <?= get_field('logo_svg', 'option'); ?>
        </a>
    <?php } ?>
    <form class="search-box d-none d-lg-inline z-2 me-3" method="get"
          action="<?php echo esc_url(home_url('/')); ?>">
        <button type="button" aria-label="search-button" aria-labelledby="search-button" class="btn-search d-flex align-content-center justify-content-center"><i class="bi bi-search px-2 pt-2"></i></i></button>
        <input type="text" class="input-search" placeholder="Type to Search..."  type="search" name="s" aria-label="Search">
    </form>
  </div>
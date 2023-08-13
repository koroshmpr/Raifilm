<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="<?= get_bloginfo('name'); ?>">
    <meta name="description" content="<?= get_bloginfo('description'); ?>">
    <meta name="author" content="<?= get_bloginfo('author'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="<?= get_field('favicon', 'option')['url']; ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php //get_template_part('template-parts/layout/backToTop'); ?>
<!-- Navbar STart -->
<header>
    <?php
    get_template_part('template-parts/logo-brand');
    get_template_part('template-parts/layout/header/index');
    ?>
</header>

<main id="main">
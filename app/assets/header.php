<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
	<meta name="theme-color" content="#000000" />
	<?php if( is_front_page() ){ ?>
		<title><?= get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' ) ?></title>
		<meta name="description" content="<?= get_bloginfo( 'description' ) ?>">
	<?php }else{ ?>
		<title><?= wp_title( ' - ', true, 'right' ) . get_bloginfo( 'name' ) ?></title>
	<?php } ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class( is_front_page() ) ? 'home' : '' ); ?>>

<header>

</header>

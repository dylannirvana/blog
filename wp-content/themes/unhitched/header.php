<?php
/**
 * @package unhitched
 */
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!-- fonts Josefin Sans, Raleway, Open Sans-->
    <!-- <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600|Raleway:400,300|Open+Sans:400italic,400' rel='stylesheet' type='text/css'> -->    <!-- Bootstrap -->
    <!-- <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet"> -->  
    
    
    <!-- <?php wp_enqueue_script("jquery"); ?>     -->
    <?php wp_head(); ?>
  </head>
  
  <body <?php body_class(); ?>>
    <section class="container">
        
 
        <header class="content row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                 <section id="branding">
                        <?php if ( get_header_image() ) : ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <img src="<?php header_image(); ?>"  alt="">
                            </a>
                        <?php endif; // End header image check. ?>
                 </section> <!-- branding -->
            </div>
            <div class="col-md-6"></div>
         </header> <!-- content row -->
                
       


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>

    <!-- fonts Josefin Sans, Raleway, Open Sans-->
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600|Raleway:400,300|Open+Sans:400italic,400' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">  
    
    
    <!-- <?php wp_enqueue_script("jquery"); ?>     -->
    <?php wp_head(); ?>
  </head>
  
  <body>
    <section class="container">
        
        <header class="content row">
                    <div class="clearfix">
                        
                        <div class="col-md-4">
                            <section id="branding">
                                <a href="index.php" alt="living unhitched logo"> 
                                    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/livingLogo.png"></a>
                                    
                            
                            
                            </section> <!-- branding -->
                        </div> <!-- col-md-4 -->
                        <div class="col-md-8">
                          <nav class="navbar navbar-default navbar-right" role="navigation">
                              <div class="navbar-header">
                                  <button type="button" class="navbar-toggle"
                                  data-toggle="collapse" data-target="#collapse">
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                  </button> <!-- navbar-toggle -->
                              </div> <!-- navbar-header -->
                              <div class="collapse navbar-collapse" id="collapse">
                                  <ul class="nav navbar-nav">
                                      
                                        <?php wp_list_pages(array('title_li' => '')); ?>

                                  </ul> <!-- navbar-nav -->
                              </div> <!-- collapse -->
                          </nav> <!-- navbar navbar-default --> 
                        </div> <!-- col-md-8 -->
                    </div>
                </header> <!-- content row -->
                
       


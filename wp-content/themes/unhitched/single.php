<?php get_header(); ?>

 <!-- 3 COLUMN LAYOUT, MAIN content area for BLOG, left and right SIDEBARS -->            
            <div class="content row">
                <section class="leftside col col-md-2"></section> <!-- EMPTY LEFT sidebar col -->
                <section class="main col col-md-8"> <!-- MAIN BLOG OR ARTICLE --> 
                   
                     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    
                    <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                                   
                </section>    
                <section class="rightside col col-md-2">
                    <p></p>
                </section> <!-- USE RIGHT sidebar col -->
            </div> <!-- content row -->
                    



<?php get_footer(); ?>
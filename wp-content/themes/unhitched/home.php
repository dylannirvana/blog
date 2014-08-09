<?php get_header(); ?>


     <!-- 3 COLUMN LAYOUT, MAIN content area for BLOG, left and right SIDEBARS -->            
        <div class="content row">
            <section class="leftside col col-md-2"></section> <!-- EMPTY LEFT sidebar col -->
            <section class="main col col-md-8"> <!-- MAIN BLOG OR ARTICLE --> 
                <!-- <div class="jumbotron">
                    <h2>"Life begins at the end of your comfort zone."</h2>
                    <p>Neale Donald Walsch</p>
                </div> -->
                <?php get_sidebar('carousel'); ?>
                
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              	<p><?php the_content(); ?><em><?php the_time('l, F jS, Y'); ?></em></p>
              	<hr>
                
                <?php endwhile; else: ?>
                  <p><?php _e('Sorry, there are no posts.'); ?></p>
                <?php endif; ?>
            </section>
            <section class="rightside col col-md-2">
                <p></p>
            </section> <!-- USE RIGHT sidebar col -->
        </div> <!-- content row -->


<?php get_footer(); ?>
<?php get_header(); ?>
<?php get_sidebar('carousel') ?>
<div class="row">
    
</div>

     <!-- 3 COLUMN LAYOUT, MAIN content area for BLOG, left and right SIDEBARS -->            
        <div class="content row">
            <section class="leftside col col-md-2"></section> <!-- EMPTY LEFT sidebar col -->
            <section class="main col col-md-8"> <!-- MAIN BLOG OR ARTICLE --> 
    
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              	<p><?php the_content(); ?><em><?php the_time('l, F jS, Y'); ?></em></p>
              	<hr>
                
                <?php endwhile; else: ?>
                  <p><?php _e('Sorry, there are no posts.'); ?></p>
                <?php endif; ?>
            </section>
            <section class="rightside col col-md-2">
                <p><?php get_sidebar() ?></p>
            </section> <!-- USE RIGHT sidebar col -->
        </div> <!-- content row -->


<?php get_footer(); ?>
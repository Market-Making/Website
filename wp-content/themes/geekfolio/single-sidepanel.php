<?php
/*
Single Footer
*/
get_header(); ?>
        
    <?php while (have_posts()) : the_post(); ?>
        
        <div class="geekfolio-custom-sidepanel clearfix">
        	<?php the_content(); ?>
        </div>

    <?php endwhile; ?>
        
<?php  get_footer(); ?>
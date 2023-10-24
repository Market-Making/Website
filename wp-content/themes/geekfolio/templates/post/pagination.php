<div class="img-pagination">
    <?php $geekfolio_prevPost = get_previous_post();
    if($geekfolio_prevPost) {?>
        <div class="pagi-nav-box previous">
            <?php $geekfolio_prevthumbnail = get_the_post_thumbnail($geekfolio_prevPost->ID, array(150,150) ); $geekfolio_prev = esc_html__('Previous post', 'geekfolio'); ?>
            <?php previous_post_link('%link',"<div class='img-pagi'><i class='lnr lnr-arrow-left'></i> 
            $geekfolio_prevthumbnail</div>  <div class='imgpagi-box'><p>$geekfolio_prev</p> <h4 class='pagi-title'>%title</h4> </div>"); ?> 
        </div>

    <?php } $geekfolio_nextPost = get_next_post();  
    if($geekfolio_nextPost) { ?>
        <div class="pagi-nav-box next">
            <?php $geekfolio_nextthumbnail = get_the_post_thumbnail($geekfolio_nextPost->ID, array(150,150) ); $geekfolio_next = esc_html__('Next post', 'geekfolio'); ?>
            <?php next_post_link('%link',"<div class='imgpagi-box'><p>$geekfolio_next</p><h4 class='pagi-title'>%title</h4> </div> <div class='img-pagi'><i class='lnr lnr-arrow-right'></i>
            $geekfolio_nextthumbnail</div> "); ?>
        </div>
    <?php } ?>
</div><!--/.img-pagination-->
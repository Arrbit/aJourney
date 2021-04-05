<?php get_header();?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();?><!-- loop just for pagination-->
<div class="card card_container flex-column d-flex super-round">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="card_img member_card_img">
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <a target="_blank" href="<?php echo $url ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail("large"); ?>
        </a>
        </div>
    <?php endif; ?>

    <div class="index_content">
        <div class="card_title font--righteous">
            <?php the_title(); ?>
        </div>
        <div class="card_time">
                        <?php echo get_post_meta(get_the_ID(), 'hh', TRUE); ?>:<?php echo get_post_meta(get_the_ID(), 'mm', TRUE); ?>ST on <?php echo date('l', strtotime(get_post_meta(get_the_ID(), 'date', TRUE))); ?> <?php echo date('d.m.Y',strtotime(get_post_meta(get_the_ID(), 'date', TRUE))); ?>
        </div>
        <?php the_content();?>
        <?php render_pagination();  ?>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer();?>
<?php
/**
 * Frontpage
 * Theme Name: New Sleeping Dragons
 * Template Name: Frontpage
 */?>
<?php include_once "php/frontpage_functions.php";?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>

<?php custom_frontpage_shapes(); ?>

<div> <!-- Header div, without the container, do not close -->
    <div id="frontpage_eyecatcher" class="d-flex flex-nowrap flex-column flex-lg-row">



        <div class="logo align-self-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logos/VectorRed_Transparent.png" alt="SDS-Logo">
        </div>

        <div class="frontpage_center align-self-center flex-column d-flex"> 
            <h1 class="font--righteous frontpage-title">
                    <?php echo get_bloginfo()?>
            </h1>
            <div class="d-flex flex-row frontpage_menu  font--firasans">

                <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
            </div>
             <!-- If there is no event, dont display this, you need to check for 2 null querys >:( -->
        <div class="frontpage_card_collection">
            <?php if (!$args['value'] == null) 
                $args = array(
                    'meta_key'          => 'date',
                    'orderby'           => 'meta_value',
                    'order'             => 'ASC',
                    'post_type'        => 'form_events', // the post type 
                    'post_status' => 'publish',
                    'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                        array(
                            'key' => 'date', // Check the start date field
                            'value' => date("Y-m-d"), // Set today's date (note the similar format)
                            'compare' => '==', // Return the ones greater than today's date
                            'type' => 'DATE' // Let WordPress know we're working with date
                        )
                    ),
                );
                else
                // Loop for a single event (see post per page) to today
                $args = array(
                    'meta_key'          => 'date',
                    'orderby'           => 'meta_value',
                    'order'             => 'ASC',
                    'post_type'        => 'form_events', // the post type 
                    'post_status' => 'publish',
                    'posts_per_page'=>1,
                    'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                        array(
                            'key' => 'date', // Check the start date field
                            'value' => date("Y-m-d"), // Set today's date (note the similar format)
                            'type' => 'DATE', // Let WordPress know we're working with date
                            'compare' => '>=', //get date closest to today 
                        )
                    ),
                );

            $loop = new WP_Query( $args ); //check codex if you dont know args takes the query above and enqueessseszes all posts fitting the requirement in the array

            if( ($loop->have_posts())) { ?>  
            <h3 class="next_event"> Next Event </h3> 
            <?php
            }  ## This checks if the query above is empty or not :)

            while ( $loop->have_posts() ) : $loop->the_post(); ?> 

            <div class="frontpage_card frontpage_card_container flex-column d-flex super-round">
            <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('medium_large'); ?>
            <?php else : ?>
            <img sizes="(max-width: 768px) 100vw, 768px"  width="768" height="432"   loading="lazy" class="attachment-medium_large size-medium_large wp-post-image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/404.png">
            <?php endif; ?>
                <div class="frontpage_index_content">
                    <div class="frontpage_card_title frontpage_event_title font--righteous">
                        <?php the_title(); ?>
                    </div>
                    <div class="frontpage_card_time">
                        <?php echo get_post_meta(get_the_ID(), 'hh', TRUE); ?>:<?php echo get_post_meta(get_the_ID(), 'mm', TRUE); ?>ST on <?php echo date('l', strtotime(get_post_meta(get_the_ID(), 'date', TRUE))); ?> <?php echo date('d.m.Y',strtotime(get_post_meta(get_the_ID(), 'date', TRUE))); ?>
                    </div>
                    <?php the_content();?>
                    <div class="frontpage_event_author"> by <?php echo get_post_meta(get_the_ID(), 'your_name', TRUE);?> </div>
                </div>
            </div>                         
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
        </div>  
    </div>
    
    
        <div class="frontpage_footer d-flex flex-column">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down updown" viewBox="0 0 16 16">
            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
            </svg>
            <hr role="separator">
        </div>

</div>


 


<?php get_footer();?>


<style>

.next_event{
    font-size:1.2em;
}

.frontpage_card_time{
    margin-bottom: .5em;
}

.frontpage_event_title{
    margin-bottom: 0.2em !important;
}

.frontpage_card_collection{
    padding-bottom:10px;
    margin-top: 10%;
}

.frontpage_card_title{
    margin-top:10px;
    font-size: 1.5em;
    width: fit-content;
    padding-right: 10%;
    border-bottom: solid 3px #8A0707;
    margin-bottom: unset;
}

.frontpage_card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 5px; 
  margin-bottom: 10px;
  width: 50%;
  min-width: 400px;
  height: auto;
}

.frontpage_card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.card_content{
    padding:10px;
}

.frontpage_card img{
    height: auto;
    border-radius: 5px 5px 0 0;
}
.frontpage_index_content{
    padding: 0.5em;
}
.frontpage_card_title{
    margin-top:0;
    margin-bottom:1em;
}
.frontpage_card figure{
    margin:auto;
    padding-top:1em;
    padding-bottom: 1em;
}

.frontpage_card figcaption{
    font-size: 0.9em;
    margin:auto;
    padding-left: 1em;
}

.frontpage_event_author{
    float:right;
    font-weight: 500;
}

/* Bootstrap MD Breakpoint */
@media (min-width: 768px) { 
.card_img{
    width: 50%;
    margin: auto;
    }

.card_content{
    padding-left: 20px;
    width: 50%;
    line-height: 2em;
    }
}
</style>
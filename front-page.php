<?php
/**
 * Frontpage
 * Theme Name: New Sleeping Dragons
 * Template Name: Frontpage
 */?>
<?php include_once "php/frontpage_functions.php";?>
<!DOCTYPE html>
<html class="font--firasans" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<?php custom_frontpage_shapes(); ?>

<div class="d-flex flex-column"> <!-- Header div, without the container, do not close -->
    <div class="frontpage_eyecatcher high-zindex d-flex flex-nowrap flex-column flex-lg-row font--firasans">

        <div class="logo align-self-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logos/VectorRed_Transparent.png"
                alt="SDS-Logo">
        </div>

        <div class="frontpage_center align-self-center flex-column d-flex">
            <h1 class="frontpage_title font--righteous">
                <?php echo get_bloginfo()?>
            </h1>
            
            <div class="frontpage_menu d-flex flex-row font--firasans">

                <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
            </div>

            <div class="ce_container">
                <div>Next Event</div>
                <?php custom_frontpage_event_query(); ?>
            </div>
        </div>
    </div>

    <div class="eyecatcher_footer high-zindex d-flex flex-column">
        <div class="eyecatcher_footer_text font--firasans">A Phoenix-based FC.</div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down updown"
            viewBox="0 0 16 16">
            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
        </svg>
        <hr role="separator">
    </div>

    <div class="frontpage_content container d-flex flex-column">

        <!-- Widget -->
        <div class="fp_news_text card_title font--firasans">News</div>
        <div class="fp_news font--righteous">
            <div class="d-flex flex-column flex-lg-row card_collection" style="margin-bottom:20px">
                <?php if ( dynamic_sidebar('Frontpage News') ) : else : endif; ?>
            </div>
        </div>

    <!-- Group Pic -->
        <div class="fp_img super-round slight-shadow">
            <img
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/company.jpg"
                alt="SDS-GroupPic" class="super-round" id="groupPic" onclick="changeImage()"/>
                <div class="today"> Click me! </div> 
        </div>
        <div class="fp_img_text font--firasans" style="margin-top:10px;">Our latest company photo! December 2020. Feels like a long time ago.</div> 



    <!-- Newest Letter & Member -->
        <div class="fp_new_collection d-flex flex-column flex-lg-row justify-content-center font--firasans">
            <div>Our Newest Letter 
            <?php custom_frontpage_letter_query(); ?>
            </div> 

            <div>Our Newest Member 
            <?php custom_frontpage_member_query(); ?>
            </div>
        </div>
    <!-- Content -->        
        <div class="fp_content font--firasans"> 
            <?php echo get_the_content(); ?>
        </div> 

    </div>

<?php get_footer();?>

<script language="javascript">
var images = [
'<?php echo get_stylesheet_directory_uri(); ?>/assets/img/company.jpg',
'<?php echo get_stylesheet_directory_uri(); ?>/assets/img/company_names.jpg'
];

    function changeImage() {

        if (document.getElementById("groupPic").src == images[0]) 
        {
            document.getElementById("groupPic").src = images[1];
        }
        else 
        {
            document.getElementById("groupPic").src = images[0];
        }
    }

    var img = new Image();
    img.src = images[1];
    img.onload=function(){jQuery(img);}
</script>



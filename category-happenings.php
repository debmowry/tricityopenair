<?php
/**
 * @package tricityopenair
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">

    <?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

    <div class="site-content" role="main" id="content">

    <?php if ( have_posts() ) : ?>

        <?php
            // Sorts the exhibit/happenings by ACF event_order.
            global $query_string; query_posts($query_string . '&orderby=event_order&order=ASC');
        ?>
	<header class="tricity-header">
        	<h1 class="tricity-title">Upcoming Exhibits, Calls and Special Happenings</h1>
	</header><!-- .entry-header -->

        <?php while ( have_posts() ) : the_post(); ?>

            <?php if (!(in_category('Call for Art'))) : ?>
                        <?php get_template_part( 'content', 'single' ); ?>
                <hr />
 
            <?php endif; ?>

        <?php endwhile; ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php if (in_category('Call for Art')) : ?>
                <?php get_template_part( 'content', 'single' ); ?>
                <hr />
            <?php endif; ?>

        <?php endwhile; ?>

    <?php else : ?>
        <h1><?php _e( 'Not Found', 'twentythirteen' );?></h1>
        <div class="hentry">
            <p><?php _e( 'We\'re sorry.  The posts you were looking for could not be found.', 'twentythirteen' ); ?></p>
            <p> <?php _e( 'Perhaps using the search form below would help?', 'twentythirteen' ); ?> </p>
            <?php get_search_form(); ?>
    <?php endif; ?>
    </div><!--.hentry-->

   
       <?php
//added the following to display calendar list 
 get_sidebar("list"); 
// php get_sidebar(); 

?>

</div><!--site-content-->



</div><!--primary-->
<?php get_footer(); ?>
                                                                  
<?php
/**
 * @package tricityopenair
 */
?>

<?php get_header(); ?>

<!-- <div id="main" class="site-main"> -->

<div id="primary" class="content-area">


    <div class="site-content" role="main" id="content">
    <?php if ( have_posts() ) : ?>

        <?php
            // Sorts the on mission posts by order of appearance field.
            global $query_string; query_posts($query_string . '&orderby=mission_order&order=ASC');
        ?>
		<header class="tricity-header">
						
		<h1 class="tricity-title">On Mission</h1>
		</header><!-- .entry-header -->
 

        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle === 'On Mission Category Introduction') : ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>"> 

                    <div class="tricity-content">
                        <?php
                            echo apply_filters('the_content', $post->post_content);
                            $editpost =  sprintf( __('Edit This Intro' , 'twentythirteen') );
                            edit_post_link($editpost, '<p class="button editlink">', '</p>');
                        ?>
                   </div><!--.tricity-content-->
                </article>
                <hr />
            <?php endif; ?>
        <?php endwhile; ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle !== 'On Mission Category Introduction') : ?>
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
    </div><!--site-content-->

        <?php
//added the following to display calendar list 
 get_sidebar("list"); 
// php get_sidebar(); 

?>
</div><!--primary-->

   


<?php get_footer(); ?>

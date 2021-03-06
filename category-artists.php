<?php
/**
 * @package tricityopenair
 */
?>

<?php get_header(); ?>

<!--<div id="main" class="site-main">-->

<div id="primary" class="content-area">

    <?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

    <div class="site-content" role="main" id="content">

    <?php if ( have_posts() ) : ?>

        <?php
            // Sorts the artists posts by post title.
            global $query_string; query_posts($query_string . '&orderby=title&order=ASC');
        ?>
<header class="tricity-header">
        <h1 class="tricity-title">Artists</h1>
</header><!-- .entry-header -->

        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle === 'Artist Listing Introduction') : ?>
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <div class="tricity-content">
                        <?php
                            echo apply_filters('the_content', $post->post_content);
                            $editpost =  sprintf( __('Edit This Intro' , 'a11yall') );
                            edit_post_link($editpost, '<p class="button editlink">', '</p>');
                        ?>
                    </div><!--.tricity-content-->
                </article>
                <hr />
            <?php endif; ?>
        <?php endwhile; ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle !== 'Artist Listing Introduction') : ?>
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



<?php get_sidebar(); ?>
</div><!--.site-content-->


</div><!--primary-->

<?php get_footer(); ?>

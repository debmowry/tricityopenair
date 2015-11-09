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
            // Sorts the Grants posts by post title.
            global $query_string; query_posts($query_string . '&orderby=title&order=ASC');
        ?>
<header class="tricity-header">
        <h1 class="tricity-title">Grants</h1>
</header><!-- .entry-header -->
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle === 'Program and Grant Introduction') : ?>
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
            <?php if ($posttitle !== 'Program and Grant Introduction') : ?>
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <div class="tricity-content">
                        <?php get_template_part( 'content', 'single' ); ?>
                    </div><!--.entry-->
                    <?php
                        if (comments_open()) {
                            echo '<p class="postmetadata">';
                            if (!post_password_required() AND (comments_open() OR (get_comments_number() > 0))) {
                                echo '<span class="commentlink">';
                                $one =  sprintf( __('1 Comment' , 'twentythirteen') );
                                $more = sprintf( __('Comments' , 'twentythirteen') );
                                comments_popup_link($more, $one, '% '.$more);
                                echo '</span>';
                            }
                            echo '</p>';
                        }
                    ?>
                </article>
                <hr />
            <?php endif; ?>
        <?php endwhile; ?>

    <?php else : ?>
        <h1><?php _e( 'Not Found', 'a11yall' );?></h1>
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

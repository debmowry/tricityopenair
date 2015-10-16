<?php
/**
 * @package tricitysamora
 */
?>
<?php get_header(); ?>

<div class="sixteen columns" id="main">
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p id="breadcrumbs">','</p>');
        }
    ?>
    <div class="twelve columns alpha" role="main">
    <?php if ( have_posts() ) : ?>
        <h1 id="category-title">Engage</h1>
        <p><span class="engagequestion">Are you ready to engage in the Imagine Art community?</span> Whether you are seeking to be a studio artist, a partner or donor or an arts collector, we invite you to plug into our community and make yourself at home.</p>
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <div class="entry">
                    <?php get_template_part( 'content', 'single' ); ?>
                </div><!--.entry-->

                <?php
                    if (comments_open()) {
                        echo '<p class="postmetadata">';
                        if (!post_password_required() AND (comments_open() OR (get_comments_number() > 0))) {
                            echo '<span class="commentlink">';
                            $one =  sprintf( __('1 Comment' , 'a11yall') );
                            $more = sprintf( __('Comments' , 'a11yall') );
                            comments_popup_link($more, $one, '% '.$more);
                            echo '</span>';
                        }
                        echo '</p>';
                    }
                ?>
            </article>
            <hr />
        <?php endwhile; ?>

    <?php else : ?>
        <h1><?php _e( 'Not Found', 'a11yall' );?></h1>
        <div class="hentry">
            <p><?php _e( 'We\'re sorry.  The posts you were looking for could not be found.', 'a11yall' ); ?></p>
            <p> <?php _e( 'Perhaps using the search form below would help?', 'a11yall' ); ?> </p>
            <?php get_search_form(); ?>
    <?php endif; ?>
    </div><!--.twelve.columns-->

    <div class="four columns omega">
        <?php get_sidebar(); ?>
    </div><!--.four.columns-->
</div><!--.sixteen.columns-->

<?php get_footer(); ?>

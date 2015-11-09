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
            // Sorts the donors posts by post title.
            global $query_string; query_posts($query_string . '&orderby=title&order=ASC');
        ?>
        <header class="tricity-header">
            <h1 id="category-title">Donors Hall of Fame</h1>
        </header><!-- .entry-header -->
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle === 'Donor Listing Introduction') : ?>
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

        <?php $isdonorlevelused = ''; ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
                $donorlevel = get_post_field('donor_level');
                if ($donorlevel !== '') {
                    $isdonorlevelused .= $donorlevel;
                }
            ?>
        <?php endwhile; ?>

        <?php
            $isgold = $issilver = $isbronze = $isdonorlevelused;
            // Makes sure that no headings are displayed if no donor has been entered.
            if ($isdonorlevelused === 'Do Not List') { $isdonorlevelused = '';}
        ?>
        <div class="tricity-content">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
                <?php if ($posttitle !== 'Donor Listing Introduction') : ?>
                    <?php get_template_part( 'content', 'single' ); ?>
                    <hr />
                <?php endif; ?>
        <?php endwhile; ?>
        </ul></section>

    <?php else : ?>
        <h1><?php _e( 'Not Found', 'twentythirteen' );?></h1>
        <div class="hentry">
            <p><?php _e( 'We\'re sorry.  The posts you were looking for could not be found.', 'twentythirteen' ); ?></p>
            <p> <?php _e( 'Perhaps using the search form below would help?', 'twentythirteen' ); ?> </p>
            <?php get_search_form(); ?>
    <?php endif; ?>
    </div><!--hentry-->


</div><!--.site-content-->

<?php get_sidebar(); ?>
</div><!--.site-content-->
</div><!--primary-->
<?php get_footer(); ?>

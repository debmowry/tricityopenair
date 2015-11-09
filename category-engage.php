<?php
/**
 * @package tricityopenair
 */
?>

<?php get_header(); ?>

 <div id="primary" class="content-area">
<!--<div id="main" class="site-main">  -->

    <div class="site-content" role="main" id="content">

    <?php if ( have_posts() ) : ?>

        <?php
            // Sorts the engage posts by post title.
            global $query_string; query_posts($query_string . '&orderby=title&order=ASC');
        ?>
<header class="tricity-header">
        <h1 class="tricity-title">Engage</h1>
</header><!-- .entry-header -->
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle === 'Engage Category Introduction') : ?>
                <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <div class="tricity-content">
                        <?php
                            echo apply_filters('the_content', $post->post_content);
                            $editpost =  sprintf( __('Edit This Intro' , 'twentythirteen') );
                            edit_post_link($editpost, '<p class="button editlink">', '</p>');
                        ?>
		</div><!-- tricity-content -->
                </article>
                <hr />
                    
            <?php endif; ?>
   
        <?php endwhile; ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php $posttitle = get_post_field('post_title'); ?>
            <?php if ($posttitle !== 'Engage Category Introduction') : ?>
                <?php 

                if ((in_category('Volunteers')) && ($posttitle === 'Volunteer Listing Introduction') ) :
                ?>
                <header class="tricity-header">
                <h1 class="tricity-title">Volunteers</h1>
                </header><!-- tricity-header-->
                <?php 
              
                echo apply_filters('the_content', $post->post_content);
                $editpost =  sprintf( __('Edit This Intro' , 'twentythirteen') );
                edit_post_link($editpost, '<p class="button editlink">', '</p>');

                endif; 

                if ((in_category('Donors')) && ($posttitle === 'Donor Listing Introduction') ) :
                ?>
                <header class="tricity-header">
                <h1 class="tricity-title">Donors</h1>
                </header><!-- tricity-header-->
                <?php 
              
                echo apply_filters('the_content', $post->post_content);
                $editpost =  sprintf( __('Edit This Intro' , 'twentythirteen') );
                edit_post_link($editpost, '<p class="button editlink">', '</p>');

                endif;  

			if (!(in_category('Artists')) && !(in_category('Donors')) && !(in_category('Volunteers'))) : ?>
                    <?php get_template_part( 'content', 'single' ); ?>
                    <hr />
                <?php endif; ?>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php the_posts_pagination( array('mid_size' => 1, 'screen_reader_text' => 'Posts navigation') ); ?>

    <?php else : ?>
        <h1><?php _e( 'Not Found', 'twentythirteen' );?></h1>
        <div class="hentry">
            <p><?php _e( 'We\'re sorry.  The posts you were looking for could not be found.', 'twentythirteen' ); ?></p>
            <p> <?php _e( 'Perhaps using the search form below would help?', 'twentythirteen' ); ?> </p>
            <?php get_search_form(); ?>
    <?php endif; ?>
    </div><!-- hentry -->
   

 <?php
//added the following to display calendar list 
 get_sidebar("list"); 
// php get_sidebar(); 
?>


</div><!--.site-content-->

</div><!--primary-->
<?php get_footer(); ?>



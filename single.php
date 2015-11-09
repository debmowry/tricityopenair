<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<div id="content" class="site-content" role="main">

<?php /* The loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php
        if (get_the_post_thumbnail()) {
            echo '<figure>'. get_the_post_thumbnail() .'</figure>';
        }
        $event_subtitle = get_post_meta($post->ID, "event_subtitle", true);
        $mission_subtitle = get_post_meta($post->ID, "mission_subtitle", true);
        $event_date = get_post_meta($post->ID, "event_date", true);
        $event_begin = get_post_meta($post->ID, "event_begin", true);
        $event_end = get_post_meta($post->ID, "event_end", true);
        $event_btime = get_post_meta($post->ID, "event_btime", true);
        $event_etime = get_post_meta($post->ID, "event_etime", true);
        $event_artist = get_post_meta($post->ID, "event_artist", true);
        $artist_disability = get_post_meta($post->ID, "artist_disability", true);
        $artist_medium = get_post_meta($post->ID, "artist_medium", true);
        $grant_name = get_post_meta($post->ID, "grant_name", true);
        $grant_num_served = get_post_meta($post->ID, "grant_num_served", true);
        $grant_impact = get_post_meta($post->ID, "grant_impact", true);
        $grant_status = get_post_meta($post->ID, "grant_status", true);
    ?>

    <div class="tricity-text">
        <header class="tricity-header">
            <h1 id="post-title"><?php the_title(); ?></h1>
            <?php
                // Check for post_category = exhibit subtitle
                if( $event_subtitle ) {
                    echo '<h2 class="subtitle">'.$event_subtitle.'</h2>';
                }
                if ($mission_subtitle) {
                    echo '<h2 class="subtitle">'.$mission_subtitle.'</h2>';
                }
            ?>
        </header>

        <div class="tricity-content">
            <?php
                // Check for post_category = exhibit date and times
                if ($event_date) {
                    echo '<h3 class="eventdate">';
                    $datevalues = explode("/", $event_date);
                    echo '<time datetime="'. $datevalues[0] .'">'. $datevalues[1] .'</time>';
                    if ($event_btime) {
                        echo ' at <span>'. $event_btime;
                        if ($event_etime) { echo ' - '. $event_etime; }
                        echo '</span>';
                    }
                    echo '</h3>';
                }

                // Check for post_category = exhibit begin date, end date and times
                if ($event_begin) {
                    echo '<h3 class="eventdate">';
                    $beginvalues = explode("/", $event_begin);
                    $begindate = explode(" ", $beginvalues[1]);
                    echo '<time datetime="'. $beginvalues[0] .'">'. $begindate[0] .'., '. $begindate[1] .'. '. $begindate[2] .'</time>';
                    if ($event_end) {
                        $endvalues = explode("/", $event_end);
                        $enddate = explode(" ", $endvalues[1]);
                        echo ' - <time datetime="'. $endvalues[0] .'">'. $enddate[0] .'., '. $enddate[1] .'. '. $enddate[2] .'</time>';
                    }
                    echo ', ';
                    if ($endvalues) { echo $enddate[3]; } else { $begindate[3]; }
                    if ($event_btime) {
                        echo ' at <span>'.$event_btime;
                        if ($event_etime) { echo ' - '.$event_etime; }
                        echo '</span>';
                    }
                    echo '</h3>';
                }

                // Check for post_category = exhibit featured artist
                if ($event_artist) {
                    echo '<h3 class="theartist">'.$event_artist.'</h3>';
                }

                // Check for post_category = artist disability and medium
                if ($artist_disability) {
                    echo '<p class="artist-info disability"><strong>Disability: </strong>'.$artist_disability.'</p>';
                }
                if ($artist_medium) {
                    echo '<p class="artist-info medium"><strong>Medium: </strong>'.$artist_medium.'</p>';
                }

                // Check for post_category = grant name and grant details
                if ($grant_name) {
                    echo '<p class="artist-info disability"><strong>Grant Name: </strong>'.$grant_name.'</p>';
                }
                if ($grant_num_served) {
                    echo '<p class="artist-info medium"><strong>Grant Details: </strong>'.$grant_num_served.'</p>';
                }
                if ($grant_impact) {
                    echo '<p class="artist-info medium"><strong>Impact of Grant: </strong>'.$grant_impact.'</p>';
                }
                if ($grant_status) {
                    echo '<p class="artist-info medium"><strong>Grant Status: </strong>'.$grant_status.'</p>';
                }

                // Used on all post pages.
                the_content();
            ?>
        </div><!--.tricity-content-->

        <?php
            $editpost =  sprintf( __('Edit This Post' , 'twentythirteen') );
            edit_post_link($editpost, '<p class="button editlink">', '</p>');
        ?>
    </div><!--.tricity-text-->

    <?php
        // get_template_part( 'content', get_post_format() );
        // twentythirteen_post_nav();
        // comments_template();
    ?>

<?php endwhile; ?>

</div><!-- #content -->

<?php
    $sidebar = get_post_meta($post->ID, "sidebar", true);
    get_sidebar($sidebar);
?>
<?php get_footer(); ?>

<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<section id="front-page-intro" class="clear">
			<article id="intro-elements">
				<div class="entry-content">
					<?php
					$welcome = get_page_by_title( 'Welcome' );
					$editlink = get_edit_post_link($welcome);
					echo $welcome->post_content;
					?>
				</div>
				<footer class="entry-meta">
					<span class="edit-link"><a href="<?php echo $editlink ?>">Edit</a></span>
				</footer>
			</article>
		</section>
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
	$sidebar = get_post_meta($post->ID, "sidebar", true);
	get_sidebar($sidebar);
?>
<?php get_footer(); ?>

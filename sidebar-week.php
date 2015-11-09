<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

//if ( is_active_sidebar( 'sidebar-2' ) ) : 
?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<div id="text-2" class="widget widget_text">
					<div class="textwidget">
					<?php 
					dynamic_sidebar( 'sidebar-2' );
					$array = array("format" => "weekly","calendar" => "default");
					echo displayGCalender_func($array);
					?>
					</div><!-- .textwidget-area -->
				</div><!-- .div-area -->		
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php 
//endif; 
?>

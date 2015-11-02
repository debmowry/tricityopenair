<?php
add_filter('widget_text', 'do_shortcode');

// global variables

define(MAX_RESULTS,8);

// import styles, fonts and scripts for child theme plus moved "add_action" below function for consistency
function tricityopenair_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'tricityopenair_google_fonts', '//fonts.googleapis.com/css?family=Lato:400,700,300|Raleway:700,400,300,200,100|Muli:400,300' );
    // Not sure if the following will be used so commenting out instead of removing
    //wp_register_script( 'tricityopenair_menu_custom', get_bloginfo('stylesheet_directory') . '/js/menu.js', array( 'jquery' ) );
    //wp_enqueue_script( 'tricityopenair_menu_custom' );
}
add_action( 'wp_enqueue_scripts', 'tricityopenair_enqueue_styles' );

// Custom Function to include favicon
function favicon_link() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'. get_bloginfo('stylesheet_directory') .'/favicon.ico" />' . "\n";
}
add_action( 'wp_head', 'favicon_link' );

function tricityopenair_create_body_class() {
    $pagetitle = get_post_field('post_title');
    $pagetype = get_post_field('post_type');
    if ($pagetype == 'page') {
        //$bodyclass = str_replace(' ', '', strtolower($pagetitle));
        if (strpos($pagetitle, 'About') !== FALSE) {
            $bodyclass = 'about';
        } elseif (strpos($pagetitle, 'Contact') !== FALSE) {
            $bodyclass = 'contact';
        } elseif (strpos($pagetitle, 'Give') !== FALSE) {
            $bodyclass = 'give';
        } else {
            $bodyclass = 'no-custom-banner';
        }
        return $bodyclass;
    }
}
add_shortcode('tricityopenair_create_body_class', 'tricityopenair_create_body_class');

// function to display embedded google calendar
function displayDayCalendar(){
  $today = date("Ymd");
  $tomorrow  = date('Ymd', strtotime('+24 hours'));

  $calendar_url = "https://www.google.com/calendar/embed?mode=DAY&amp;dates=".$today."%2F".$tomorrow."&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=3citysamoraseller%40gmail.com&amp;color=%231B887A&amp;ctz=America%2FChicago;";
  return  $calendar_url;

}
add_shortcode('displayDayCalendar', 'displayDayCalendar');

function check_browser(){


$displayHTML = '<b>Nice modern browser you got there!</b>';
$displayHTML =  $_SERVER['HTTP_USER_AGENT']."<br>";
$browser = get_browser();
$displayHTML .= $browser;



  return  $displayHTML;
}


add_shortcode('check_browser', 'check_browser');

//SET the following variables in wp-config file
// public or limited calendar to view ie google account
//define('CALENDAR_ID', 'ENTERADDRESSHERE@gmail.com');

//SET the following variables in wp-config file
// this is for SUB calendars find the address within calendar settings
//public or limited calendar to view ie google account
//define('CALENDAR_ID_2', 'ENTERHERE@gmail.com');


//The Google API to access the google account above from this from console.developer.google.com
//define('GOOGLE_API', 'ENTERAPICODE_HERE');

// The Google client files  stored on the webserver*/
//define('GOOGLE_CLIENT_FILES', 'ENTER YOUR install location here/google-api-php-client/src');


$clientLibraryPath = GOOGLE_CLIENT_FILES;
$oldPath = set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);

// use this when debugging
/* echo get_include_path();
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors', 1);
//echo "<br>";
*/
// this is a file from the following location google-api-php-client/src
require 'Google/autoload.php';


function displayGCalender_func($atts){
 $atts = shortcode_atts(
    array(
      'format' => 'list',
      'calendar' => 'default'
    ), $atts, 'displayListFormat_func' );

if ($atts['calendar']  == 'default'){
   $calendarToWorkWith = CALENDAR_ID;
}
else if ($atts['calendar']  == 'special_happenings'){
  $calendarToWorkWith = CALENDAR_ID_2;
}


 $client = new Google_Client();
 $client->setDeveloperKey(GOOGLE_API);
 date_default_timezone_set('America/Chicago');
 $today = date(DATE_ISO8601, strtotime("now",mktime(0, 0, 0)));
 $tomorrow  = date(DATE_ISO8601, strtotime("+1 day",mktime(0, 0, 0)));
 $weekly  = date(DATE_ISO8601, strtotime("+7 day",mktime(0, 0, 0)));
 $yesterday  = date(DATE_ISO8601, strtotime("-1 day",mktime(0, 0, 0)));
 $previousStart = $yesterday;


  $gdataCal = new Google_Service_Calendar($client);

if ($atts['format']  == 'list'){

    $displayHTML = "<b>List of Next ".MAX_RESULTS." Activities</b> <br>";
    $optParams = array(
    'maxResults' => MAX_RESULTS,
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => date('c'),
    );
    $results = $gdataCal->events->listEvents($calendarToWorkWith, $optParams);
  }// end if list

  if ($atts['format']  == 'weekly'){


  $displayHTML = "<b>Activities this Week</b> <br>";

  $optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $today,
    'timeMax' => $weekly,
  );
  $results = $gdataCal->events->listEvents($calendarToWorkWith, $optParams);
  }// end if weekly

if ($atts['format']  == 'day'){


 $displayHTML = "<b>Today's Activities </b></br>";
  $optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $today,
    'timeMax' => $tomorrow,
  );
  $results = $gdataCal->events->listEvents($calendarToWorkWith, $optParams);
}//end if day

    if (count($results->getItems()) == 0) {
              $displayHTML .= "No upcoming events found.";
      } //end if count
    else {
      foreach ($results->getItems() as $event) {
        $eventVisibility = $event->visibility;
        //$displayHTML .= $eventVisibility;
        if ($eventVisibility=='public' || $eventVisibility==null){
        $start = $event->start->dateTime;
        $end = $event->end->dateTime;
        if (empty($start))
          $start = $event->start->date;
        if (empty($end))
          $end = $event->end->date;

        $start = new DateTime($start);
        $end = new DateTime($end);

        $firstDate = date_format($previousStart, 'Ymd');
        $secondDate = date_format($start, 'Ymd');

          if ($firstDate == $secondDate){
            $displayHTML .= date_format($start,'H:i')." to ".date_format($start,'H:i');
            $displayHTML .= "<a href=\"" .$event->getHtmlLink()."\" target=\"_blank\">";
            $displayHTML .= $event->getSummary(). "</a><br>";

         }
         else {
            $displayHTML .= "". date_format($start,'l F jS Y')."<br> ";
            $displayHTML .= date_format($start,'H:i')." to ".date_format($start,'H:i');
            $displayHTML .= "  <a href=\"" .$event->getHtmlLink()."\" target=\"_blank\">";
            $displayHTML .= $event->getSummary(). "</a><br>";

            $previousStart = $start;
          }//end else date heading
        }//end if visibility

      }//end for each
    }//end else

$displayHTML .=  "<a href =\"https://calendar.google.com/calendar/embed?src=".$calendarToWorkWith."&amp;ctz=America/Chicago\" target=\"_blank\"> Link to Calendar</a>";
return $displayHTML;
}//end of function

add_shortcode('displayGCalender_func', 'displayGCalender_func');

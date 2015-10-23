<?php


function displayOneWeek_func(){


    $calendarID = "3citysamoraseller@gmail.com";
    $key = "AIzaSyBcSX2QJtx4Bf1InL0r5d4ekoMt0WJ6pAs";    
    $client = new Google_Client();
    $client->setDeveloperKey($key);

  $today = date('c');
  $tomorrow  = date('c', strtotime('+7 days'));

  $gdataCal = new Google_Service_Calendar($client);
    
 
  $optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $today,
    'timeMax' => $tomorrow,
  );
  $results = $gdataCal->events->listEvents($calendarId, $optParams);


  $displayHTML = "";

  if (count($results->getItems()) == 0) {
      $displayHTML .= "No upcoming events found.";
    } //end if count
  else {
    foreach ($results->getItems() as $event) {
      $start = $event->start->dateTime;
      $end = $event->end->dateTime;
      if (empty($start)) 
        $start = $event->start->date;
      if (empty($end)) 
        $end = $event->end->date;

      $start = new DateTime($start);
      $end = new DateTime($end);

      $displayHTML .= "Date: ". date_format($start,'l jS F Y')."<br>";
      $displayHTML .= date_format($start,'H:i')." to ".date_format($start,'H:i')."<br>";
      $displayHTML .= "<a href=\"" .$event->getHtmlLink()."\">";
      $displayHTML .= $event->getSummary(). "</a><br>";
    }
  }//end else echo
return $displayHTML;
}//end of function




add_shortcode('displayOneWeek_func', 'displayOneWeek_func');


<?php
/**
* Plugin Name: Custom Facbook Feed
* Plugin URI:https://github.com/Schifty
* Description:  this is  a function to display a custom facebook feed
* Version: 1.0
* Author:Anthony Schifferns
* Author URI: http://www.aswebdeveloper.com/
**/

session_start();



/*****************************************                           NEEDED FUNCTIONS                   *****************************************************************************/








////////////////////////////////////////////////////////////add admin settings  for our plugin//////////////////////////////////////////////////////

require_once(dirname(__FILE__) . "/admin/admin_options.php");


/////////////////////////////////////////////////////load the need facebook files in to the plugin folder////////////////////////////////////////////////////
	

require_once(dirname(__FILE__) . '/Facebook/FacebookSession.php' );
require_once(dirname(__FILE__) . '/Facebook/FacebookRedirectLoginHelper.php' );
require_once(dirname(__FILE__) . '/Facebook/FacebookRequest.php' );
require_once(dirname(__FILE__) . '/Facebook/GraphObject.php' );
require_once(dirname(__FILE__) . '/Facebook/GraphUser.php' );
require_once(dirname(__FILE__) . '/Facebook/FacebookSDKException.php' );
require_once(dirname(__FILE__) . '/Facebook/FacebookRequestException.php' );
require_once(dirname(__FILE__) . '/Facebook/HttpClients/FacebookHttpable.php' );
require_once(dirname(__FILE__) . '/Facebook/HttpClients/FacebookCurl.php' );
require_once(dirname(__FILE__) . '/Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once(dirname(__FILE__) . '/Facebook/Entities/AccessToken.php' );
require_once(dirname(__FILE__) . '/Facebook/Entities/SignedRequest.php' );
require_once(dirname(__FILE__) . '/Facebook/FacebookResponse.php' );
require_once(dirname(__FILE__) . '/Facebook/FacebookPermissionException.php');
require_once(dirname(__FILE__) . '/Facebook/FacebookAuthorizationException.php');
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookResponse;
use Facebook\FacebookPermissionException;
use Facebook\GraphUser;
use Facebook\FacebookAuthorizationException;




//echo get_option( 'extendedToken' ); exit;

//////////////////////////////////////////////////////////// this is the main function/////////////////////////////////////////////////////////////////////////////
function custom_facebook_feed(){
	
	//save the variables
	$numberOfPosts = get_option( 'numberOfPosts' );
	$applicationId = get_option( 'applicationId' );
	$secretPasscode = get_option( 'secretPasscode' );
	$extendedToken = get_option( 'extendedToken' );

	
  //create a session with facebook, application id and secret passcode
  FacebookSession::setDefaultApplication($applicationId, $secretPasscode);
	
	
  //starts a new session using the extened token for facebook login
  $session = new FacebookSession($extendedToken);

	//if we have a sesson with facebook we're going to make a request for user name
  if ( $session) {
	  //print_r($session);
	  
  
  //try2 get my user profile
  try {
	  //request for the ifo. we are getting nae howmtown nad picture to the specified size
    $request = new FacebookRequest($session, 'GET', '/865981470142418?fields=name,hometown,picture.width(800).height(800)');
    $response = $request -> execute();
    $me = $response-> getGraphObject();
	$name=$me->getProperty("name");
	$hometowninfo=$me->getProperty("hometown");

	//$hometown=$hometowninfo->getProperty("name");
	$pictureinfo=$me->getProperty("picture");
	$picture=$pictureinfo->getProperty("url");
	//var_dump($me);
	
	
	//echoes the hometown
	echo "<h3>Latest News From ".$name."</h3>";
	//echo the profile pic
	echo "<img src='".$picture."' alt='profile'/>";

			
 ///catch2 needed for every try otherwise the the app stops working and you get no error message when there is an error
  } catch(FacebookRequestException $e) {
 
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
 
  }//ends catch2
  
  // try3 get my recent posts
   try {
    $request2 = new FacebookRequest($session, 'GET', '/865981470142418/feed?limit='.$numberOfPosts);
    $response2 = $request2 -> execute();
    $posts = $response2-> getGraphObject()->asArray();
	
	//var_dump($posts); exit;
	
	
	//start the table

	echo '<table>';
   
   
   
	foreach($posts["data"] as $post){
		//try4 request for the post picture
		try{
			$postid='/'.$post->id;
			//echo $postid; 
			$request3 = new FacebookRequest($session, 'GET',$postid."/?fields=full_picture,link,source");
			//echo $request3; exit;
			$response3 = $request3 -> execute();
			$graphObject3 = $response3->getGraphObject();
			$postpicture = $graphObject3-> getProperty("full_picture");
			$postsource = $graphObject3-> getProperty("source");
			//var_dump($postsource);
			$postlink = $graphObject3-> getProperty("link");
			//var_dump($response3); exit;
		}//ends try4
		
		 ///catch3 needed for every try otherwise the the app stops working and you get no error message when there is an error
		catch(FacebookRequestException $e) {
			echo "Exception occured, code: " . $e->getCode();
			echo " with message: " . $e->getMessage();
		}//ends catch3
		
		

		
	echo '<tr>';
	
	
	//second column for data
	echo '<td>';
	//check to see if the object contains a message or a story
	if(isset($post->message)){
		echo '<p>'.$post->message.'</p>';
	}
	if(isset($post->story)){
		echo '<p>'.$post->story.'</p>';
	}if(!empty($postsource)){
		echo '<iframe src="'.$postsource.'" alt="post picture"></iframe>';
	}else if(!empty($postpicture)){
		echo '<a href="'.$postlink.'"><img src="'.$postpicture.'" alt="post picture"/></a>';
	}
	if(isset($post->created_time)){
		echo '<p><em style="font-size:small;">'.$post->created_time.'</em></p>';
	}
	echo '</td></tr>';//closes the row
	}//ends foreach
	echo "</table>";
 
  }//ends try3
  
  //ctach4
  catch(FacebookRequestException $e) {
 
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
 
  }//ends catch4
 
}//ends if $session

}//ends main function

// regster a new shortcode: [custom_registration]
function custom_facebook_feed_shortcode(){
	
	// prevents ascending of any data through the page until fucntion below has executed
	ob_start();
	
	// name of our main plugin function
	custom_facebook_feed();
	
	// allows ascending of data once loaded
	return ob_get_clean();
}



// first parameter is the shorcode tag you pput in your post
// seconf parameter is function to execute with shortcode
add_shortcode('custom_facebook_feed', 'custom_facebook_feed_shortcode');
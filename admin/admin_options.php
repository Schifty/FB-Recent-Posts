<?php 
//function for creating a custom menu for our plugin in the setttings page
function fb_custom_feed_admin() {
	//**PARAMETERS**//
	// first parameter is the name of basic title,
	// second parameter is the name that appears in the settings menu,
	// third option is the capability-manags options means the user can change these options,
	// fourth parameter is the location of the page __file__,
	// last one is the function that processes the option page actions	
	add_options_page('FbCustomFeed', 'Fb Custom Feed', 'manage_options', __FILE__ , 'fb_custom_feed');
}
// hook to add menu to settings in dashboard
add_action('admin_menu', 'fb_custom_feed_admin');

function fb_custom_feed(){
	//this will sve the default number of posts
		if(isset($_POST["submit"])){
		
		//saves the selected display # of latest posts
		$numberOfPosts=$_POST["numberOfPosts"];
		//echo $numberOfPosts; exit;
		
		// insert user selection into the options meta table
		update_option("numberOfPosts", $numberOfPosts);
			//echo $numberOfPosts; exit;
		


		//saves the info and inserts the option for application id
		$applicationId=$_POST["applicationId"];
		//echo $numberOfPosts; exit;
		
		// insert user selection into the options meta table
		update_option("applicationId", $applicationId);
			//echo $numberOfPosts; exit;
		

		//saves the option and enters the passcode 
		$secretPasscode=$_POST["secretPasscode"];
		//echo $numberOfPosts; exit;
		
		// insert user selection into the options meta table
		update_option("secretPasscode", $secretPasscode);
			//echo $numberOfPosts; exit;
			
			
		//saves the extened token and enters the value for the optin
		$extendedToken=$_POST["extendedToken"];
		//echo $numberOfPosts; exit;
		
		// insert user selection into the options meta table
		update_option("extendedToken", $extendedToken);
			//echo $numberOfPosts; exit;
			
	}//ends if isset post
	else{

			//check to see the option and value already exist
			$existingnumberOfPosts=get_option("numberOfPosts");
			
				//var_dump($existingnumberOfPosts);  exit;
				//echo $existingnumberOfPosts; exit;
			//check to see if the option exists if not then insert
		if(empty($existingnumberOfPosts)){
			//var_dump($existingnumberOfPosts);
			//saves the default as 10
			$numberOfPosts=10;
				//echo $numberOfPosts; exit;
			//insert the defaut value for the frameworks group
			add_option("numberOfPosts", 10);
			}//ends if empty
			else{$numberOfPosts=$existingnumberOfPosts;}	
		}	//ends else for # of posts
		
		//check to see the applicationId and value already exist
			$existingapplicationId=get_option("applicationId");
			
				//var_dump($existingapplicationId);  exit;
				//echo $existingapplicationId; exit;
			//check to see if the applicationId exists if not then insert
		if(empty($existingapplicationId)){
			//var_dump($existingapplicationId);
			//saves the default as 10
			$applicationId="";
				//echo $applicationId; exit;
			//insert the defaut value for the applicationId
			add_option("applicationId", $applicationId);
			}//ends if empty
			else{$applicationId=$existingapplicationId;}
			
		//check to see the secretPasscode and value already exist
			$existingsecretPasscode=get_option("secretPasscode");
			
				//var_dump($existingsecretPasscode);  exit;
				//echo $existingsecretPasscode; exit;
			//check to see if the secretPasscode exists if not then insert
		if(empty($existingsecretPasscode)){
			//var_dump($existingsecretPasscode);
			//saves the default as 10
			$secretPasscode="";
				//echo $secretPasscode; exit;
			//insert the defaut value for the secretPasscode
			add_option("secretPasscode", $secretPasscode);
			}//ends if empty
			else{$secretPasscode=$existingsecretPasscode;}
			
			
			//check to see the extendedToken and value already exist
			$existingextendedToken=get_option("extendedToken");
			
				//var_dump($existingextendedToken);  exit;
				//echo $existingextendedToken; exit;
			//check to see if the extendedToken exists if not then insert
		if(empty($existingextendedToken)){
			//var_dump($existingextendedToken);
			//saves the default as 10
			$extendedToken="";
				//echo $extendedToken; exit;
			//insert the defaut value for the extendedToken
			add_option("extendedToken", $extendedToken);
			}//ends if empty
			else{$extendedToken=$existingextendedToken;}
		
			//save the variables
	$numberOfPosts = get_option( 'numberOfPosts' );
	$applicationId = get_option( 'applicationId' );
	$secretPasscode = get_option( 'secretPasscode' );
	$extendedToken = get_option( 'extendedToken' );
	//echo $extendedToken; exit;
?>
	<h1>Choose your feed options:</h1>
	<form name="facebookfeed_options" action="" method="post">
	<label for="numberOfPosts"># Of Posts To Display</label>
	<input type="text" name="numberOfPosts" id="numberOfPosts"  value="<?php echo $numberOfPosts; ?>"/>
	<br>
	<h1>Plugin User Fields</h1>
	<label for="fbCustomPost">Application ID</label>
	<input type="text" name="applicationId" id="applicationId" value="<?php echo $applicationId; ?>" />
	<br>
	<label for="fbCustomPost">Secret Passcode</label>
	<input type="text" name="secretPasscode" id="secretPasscode"   value="<?php echo $secretPasscode; ?>" />
	<br>
	<label for="fbCustomPost">Extended Token</label>
	<textarea name="extendedToken" id="extendedToken"><?php echo $extendedToken; ?></textarea>
	<br>
	<input type="submit" name="submit" value="submit">
	</form> 
<?php
}
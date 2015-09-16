<?php 
//function for creating a custom menu for our plugin in the setttings page
function custom_registration_admin() {
	//**PARAMETERS**//
	// first parameter is the name of basic title,
	// second parameter is the name that appears in the settings menu,
	// third option is the capability-manags options means the user can change these options,
	// fourth parameter is the location of the page __file__,
	// last one is the function that processes the option page actions	
	add_options_page('CustomRegistration', 'Custom Registration', 'manage_options', __file__, 'custom_registration_process');
}
// hook to add menu to settings in dashboard
add_action('admin_menu', 'custom_registration_admin');

//fnction to process our form when submitted
function custom_registration_process(){
	
	////////////////choses and saves the correct framework////////////////////////////////////
	if(isset($_POST["submit"])){
		
		//saves the selected framework choice 
		$selected=$_POST["frameworkgroup"];
		//echo $selected; exit;
		
		//saves the show selected choice
		if(empty($_POST["hidebio"])){
		$hide_bio="no";
		}else{
		$hide_bio=$_POST["hidebio"];}
		//echo $hide_bio; //exit;
		
		//saves the show selected choice
		if(empty($_POST["hidenic"])){
		$hide_nic="no";
		}else{
		$hide_nic=$_POST["hidenic"];}
		//echo $hide_nic; //exit;
		
		//saves the show selected choice
		if(empty($_POST["hidelname"])){
		$hide_lname="no";
		}else{
		$hide_lname=$_POST["hidelname"];}
		//echo $hide_lname; //exit;
		
		//saves the show selected choice
		if(empty($_POST["hidefname"])){
		$hide_fname="no";
		}else{
		$hide_fname=$_POST["hidefname"];}
		//echo $hide_fname; //exit;
		
		//saves the show selected choice
		if(empty($_POST["hidewebsite"])){
		$hide_website="no";
		}else{
		$hide_website=$_POST["hidewebsite"];}
		//echo $hide_website; //exit;
		
		//saves the show selected choice
		if(empty($_POST["hexnumber"])){
		$hexnumber="";
		}else{
		$hexnumber=$_POST["hexnumber"];}
		//echo $hexnumber; //exit;
		
		// insert user selection into the options meta table
		update_option("frameworkgroup", $selected);
	
	
	// insert user selection into the options meta table
		update_option("hidebio", $hide_bio);
		
	
	// insert user selection into the options meta table
		update_option("hidenic", $hide_nic);
		
	// insert user selection into the options meta table
		update_option("hidelname", $hide_lname);
		
	// insert user selection into the options meta table
		update_option("hidefname", $hide_fname);
		
	// insert user selection into the options meta table
		update_option("hidewebsite", $hide_website);
	
	// insert user selection into the options meta table
		update_option("hexnumber", $hexnumber);
	
	}//ends if isset post
	else{
			
			//check to see the option and value already exist
			$existing=get_option("frameworkgroup", $selected);
			
			//check to see the option and value already exist
			$existinghidebio=get_option("hidebio", $hide_bio);
			
			//check to see the option and value already exist
			$existinghidenic=get_option("hidenic", $hide_nic);
			
			//check to see the option and value already exist
			$existinghidelname=get_option("hidelname", $hide_lname);
			
			//check to see the option and value already exist
			$existinghidefname=get_option("hidefname", $hide_fname);
			
			//check to see the option and value already exist
			$existinghidewebsite=get_option("hidewebsite", $hide_website);
			
			//check to see the option and value already exist
			$existinghexnumber=get_option("hexnumber", $hexnumber);
			
			//check to see if the option exists if not then insert
		if(empty($existing)){
			//saves the default as html5
			$selected="html5";
			//insert the defaut value for the frameworks group
			add_option("frameworkgroup", $selected);
			}//ends if empty
			else{$selected=$existing;}
			
			
			//check to see if the option exists if not then insert
		 if(empty($existinghidebio)){
			
			//saves the default as html5
			$hide_bio="no";
			
			//insert the defaut value for the frameworks group
			add_option("hidebio", $hide_bio);
			}//ends if empty
			else{$hide_bio=$existinghidebio;}
			
			
			//check to see if the option exists if not then insert
		 if(empty($existinghidenic)){
			
			//saves the default as html5
			$hide_nic="no";
			
			//insert the defaut value for the frameworks group
			add_option("hidenic", $hide_nic);
			}//ends if empty
		else{$hide_nic=$existinghidenic;}
		
		//check to see if the option exists if not then insert
		 if(empty($existinghidelname)){
			
			//saves the default as html5
			$hide_lname="no";
			
			//insert the defaut value for the frameworks group
			add_option("hidelname", $hide_lname);
			}//ends if empty
		else{$hide_lname=$existinghidelname;}
			
		//check to see if the option exists if not then insert
		 if(empty($existinghidefname)){
			
			//saves the default as html5
			$hide_fname="no";
			
			//insert the defaut value for the frameworks group
			add_option("hidelname", $hide_fname);
			}//ends if empty
		else{$hide_fname=$existinghidefname;}	
		
		
		//check to see if the option exists if not then insert
		 if(empty($existinghidewebsite)){
			
			//saves the default as html5
			$hide_website="no";
			
			//insert the defaut value for the frameworks group
			add_option("hidewebsite", $hide_website);
			}//ends if empty
		else{$hide_website=$existinghidewebsite;}
			
		
	
	}//ends if issset else
	
?>
	<h1>Choose Your Framework</h1>
	<form name="registration_options" action="" method="post">
	<label for="html5">HTML5</label>
	<input type="radio" name="frameworkgroup" id="html5" value="html5" <?php if($selected=="html5"){echo 'checked="checked"';} ?> />
	<br>
	<label for="bootstrap">Bootstrap</label>
	<input type="radio" name="frameworkgroup" id="bootstrap" value="bootstrap"  <?php if($selected=="bootstrap"){echo 'checked="checked"';} ?>  />
	<br>
	<label for="foundation">Foundation</label>
	<input type="radio" name="frameworkgroup" id="foundation" value="foundation"  <?php if($selected=="foundation"){echo 'checked="checked"';} ?>  />
	<br>
	<h1>Select fields to hide</h1>
	<label for="bio">Bio Field</label>
	<input type="checkbox" name="hidebio" id="hidebio" value="yes"  <?php if($hide_bio=="yes"){echo 'checked="checked"';} ?> />
	<br>
	<label for="nickname">Nick Name Field</label>
	<input type="checkbox" name="hidenic" id="hidenic" value="yes"  <?php if($hide_nic=="yes"){echo 'checked="checked"';} ?> />
	<br>
	<label for="lastname">Last Name Field</label>
	<input type="checkbox" name="hidelname" id="hidelname" value="yes"  <?php if($hide_lname=="yes"){echo 'checked="checked"';} ?> />
	<br>
	<label for="firstname">First Name Field</label>
	<input type="checkbox" name="hidefname" id="hidefname" value="yes"  <?php if($hide_fname=="yes"){echo 'checked="checked"';} ?> />
	<br>
	<label for="website">Web Site Field</label>
	<input type="checkbox" name="hidewebsite" id="hidewebsite" value="yes"  <?php if($hide_website=="yes"){echo 'checked="checked"';} ?> />
	<br>
	
	<input type="submit" name="submit" value="submit">
	</form> 
<?php
}//ends the main function custom_registration
?>
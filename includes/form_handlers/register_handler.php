<?php
//Declaring variable to prevent errors
$fname = "";//first name
$lname = "";//last name
$em = "";//email
$em2 = "";//email2
$password = "";//password
$password2 = "";//password2
$date = "";//sign up date
$error_array = array();//holds error

if(isset($_POST['register_button'])){
	//Registration form values
	//for first name
	$fname = strip_tags($_POST['reg_fname']); //remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //convert first letter to lower and then capitalise the first letter
	$_SESSION['reg_fname'] = $fname; //stores first name in session variable

	//for last name
	$lname = strip_tags($_POST['reg_lname']); //remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //convert first letter to lower and then capitalise the first letter
	$_SESSION['reg_lname'] = $lname; //stores first name in session variable

	$em = strip_tags($_POST['reg_email']); //remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //convert first letter to lower and then capitalise the first letter
	$_SESSION['reg_email'] = $em; //stores first name in session variable

	$em2 = strip_tags($_POST['reg_email2']); //remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //convert first letter to lower and then capitalise the first letter
	$_SESSION['reg_email2'] = $em2; //stores first name in session variable

	//password
	$password = strip_tags($_POST['reg_password']); //remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //remove html tags

	$date = date("Y-m-d"); //gets current date
	
	if($em == $em2){
		//CHECK if email is in valid format
		if(filter_var($em, FILTER_VALIDATE_EMAIL)){
			$em = filter_var($em,FILTER_VALIDATE_EMAIL);

			//check if email already exist
			$e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$em'");
			//Count number of row returned
			$num_rows= mysqli_num_rows($e_check);

			if($num_rows>0){
				array_push($error_array,"Email already in use<br>") ;
			}
		}
		else{
			array_push($error_array,"Invalid format for Email<br>");
		}
	}
	else{
		array_push($error_array,"Emails don't match<br>");
	}

	if(strlen($fname) > 25 || strlen($fname)<2) {
		array_push($error_array,"Your first name should be between 2 and 25<br>");
	}
	if(strlen($lname) > 25 || strlen($lname)<2) {
		array_push($error_array,"Your last name should be between 2 and 25<br>");
	}
	if($password != $password2){
		array_push($error_array,"Password do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Your password can only contain english character or numbers<br>");
		}
	}
	if(strlen($password)>30 || strlen($password)<5) {
		array_push($error_array, "Your password should be between 5 and 30 characters<br>");
	}

	if(empty($error_array)){
		$password = md5($password); //encrypt password before sending to database

		//generate username by concatenating first name and last name
		$username = strtolower($fname."_".$lname);
		$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username = '$username'");
		$i = 0;
		while(mysqli_num_rows($check_username_query)!=0){
			$i++;
			$username = $username."_".$i;
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username = '$username'");
		}

		//Profile picture assignment
		// for random picture, $rand = rand(1,2);//random number between 1 and 2
		// if rand = 1 do this else do different 
		$profile_pic = "assets/images/profile_pics/defaults/default.jpg";

		$query = mysqli_query($con,"INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");
		array_push($error_array,"<span style= 'color:#14C800'>You're all set to meme</span><br>");
		//clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
		
	}

}
?>
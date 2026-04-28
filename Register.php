<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	
	$host=""; // Host name
	$username=""; // username
	$password=""; // password
	$db_name="357ltd"; // Database name
	$tbl_name="customer"; // Table name
//left in for now but can be changed for an include statement

	$con=mysqli_connect($host,$username,$password,$db_name);

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>
<?php
	//Collect the post form html page
	$myForename=$_POST['forename'];
	$mySurname=$_POST['surname'];
	$myStudentNumber=$_POST['student_number'];
    $myHouse=$_POST['house'];
    $myStreet=$_POST['street'];
	$myTown=$_POST['town'];
	$myPostcode=$_POST['postcode'];
    $myEmail=$_POST['email'];
    $myPassword=$_POST['password'];

	// To protect MySQL injection (more detail about MySQL injection)
	$myForename = stripslashes($myForename);
	$myPassword = stripslashes($myPassword);
	$myForename = mysqli_real_escape_string($con, $myForename);
	$myPassword = mysqli_real_escape_string($con, $myPassword);

	//Salt and hash password
	$salt = "staybackdemon";
	$hash = crypt($myPassword, $salt);

	//Insert into table.
	$query = "INSERT INTO `customer` (`forename` ,`surname`, `student_number`, `house`, `street`, `town`, `postcode`,`email`,`password` ) VALUES ('$myForename', '$mySurname', '$myStudentNumber','$myHouse','$myStreet','$myTown','$myPostcode','$myEmail', '$myPassword', '$myEmail', '$hash')";

	
	// Connect to server and select database.

	//mysql_connect("$host", "$username", "$password")or die("cannot connect");
	//mysql_select_db("$db_name")or die("cannot select DB");
	
	//submit query
	mysqli_query($con, $query)or die(mysqli_error($con));
	
	//close database
	mysqli_close($con);
	//homepage left empty to be filled with ref of homepage
	echo "New user, $myForename, successfully entered in database.";
	echo"<br/>";
    echo"<a href = ''>Go to home</a>";

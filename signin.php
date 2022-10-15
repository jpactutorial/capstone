<?php
header("Location: signin-v2.php");
include_once("common.php");
$jpac=new JpacObject();
$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";

if($type == "register"){
	if($_REQUEST['password']==$_REQUEST['repassword']){
		$sql="SELECT COUNT(*) as Count FROM user WHERE username='".$_REQUEST['Username']."' or email='".$_REQUEST['email']."'";
		$check=$jpac->SQLQuery($sql);
		if($check[0]['Count']>0){
			echo "Username/Email already Exists!";
			exit;
		}
		$data['email']=$_REQUEST['email'];
		$data['username']=$_REQUEST['Username'];
		$data['password']=password_hash($_REQUEST['password'], PASSWORD_BCRYPT);$_REQUEST['password'];
		$data['first_name']=$_REQUEST['first_name'];
		$data['middle_name']=$_REQUEST['middle_name'];
		$data['last_name']=$_REQUEST['last_name'];
		$data['date_created']=date("Y-m-d H:i:s");
		$data['date_updated']=date("Y-m-d H:i:s");
		$data['status']="Inactive";
		$id=$jpac->SQLInsert('user',$data);
		$msg="Failed! Please contact the developer!";
		if($id>0){
			$msg="Success";
		}
		echo $msg;
	}else{
		echo "Password did not match!";
	}
	exit;
}
if($type == "login"){
	$sql="SELECT * FROM user WHERE username='".$_REQUEST['Username']."'";
	$check=$jpac->SQLQuery($sql);
	if(count($check)>0){
		if(password_verify($_REQUEST['password'],$check[0]['password'])){
			if($check[0]['status']=="Inactive"){
				echo "Account is inactive! Please contact the administrator!";
			}else{
				echo "Success";
				$_SESSION['userData']=$check;	
			}
		}else{
			echo "Wrong Password!";
		}
	}else{
		echo "Wrong username/password!";
	}
	exit;
}
?>
<!--
Author: Colorlib
Author URL: https://colorlib.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Class Record System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?= icon ?>" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/loginstyle.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Class Record System</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" id="frm_register" style="display:none" method="post">
					<input type="hidden" name="type" id="type" value="register">
					<input class="text" type="text" name="Username" id="Username" placeholder="Username" required="">
					<input class="text email" type="email" name="email" id="email" placeholder="Email" required="">
					<input class="text" type="text" name="first_name" id="first_name" placeholder="First Name" required=""><br/>
					<input class="text" type="text" name="middle_name" id="middle_name" placeholder="Middle Name" required=""><br/>
					<input class="text" type="text" name="last_name" id="last_name" placeholder="Last Name" required=""><br/>
					<input class="text" type="password" name="password" id="password" placeholder="Password" required="">
					<input class="text w3lpass" type="password" name="repassword" name="repassword" placeholder="Confirm Password" required="">
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGN UP">
				<p>Already have an Account? <a href="#" onclick="showLogin()"> Login Now!</a></p>
				</form>
				<form action="#" method="post" id="frm_login">
					<input type="hidden" name="type" id="type" value="login">
					<input class="text" type="text" name="Username" placeholder="Username" required=""><br/>
					<input class="text" type="password" name="password" placeholder="Password" required=""><br/>
					<input type="submit" value="LOGIN">
				<p>Don't have an Account? <a href="#" onclick="showRegister()"> Sign up Now!</a></p>
				</form>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
	<script>
	function showRegister(){
		$("#frm_login").hide();
		$("#frm_register").fadeIn(1000);
	}
	function showLogin(){
		$("#frm_register").hide();
		$("#frm_login").fadeIn(1000);
	}
	
$("#frm_register").submit(function(e) {
	e.preventDefault(); // avoid to execute the actual submit of the form.
	var form = $(this);
	var url = form.attr('action');
	$.ajax({
		type: "POST",
		url: window.location,
		data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false, 
		cache: false, 
		processData:false,
		success: function(data)
		{
			if(data.includes("Success")){
				alert(data);
				window.location.reload();
				return;
			}
			alert(data); // show response from the php script.
		}
	 });
});
$("#frm_login").submit(function(e) {
	e.preventDefault(); // avoid to execute the actual submit of the form.
	var form = $(this);
	var url = form.attr('action');
	$.ajax({
		type: "POST",
		url: window.location,
		data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false, 
		cache: false, 
		processData:false,
		success: function(data)
		{
			if(data.includes("Success")){
				//alert(data);
				window.location.replace("index.php");
				return;
			}
			alert(data); // show response from the php script.
		}
	 });
});
	</script>
</body>
</html>
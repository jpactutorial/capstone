<?php

include_once("common.php");
$jpac=new JpacObject();
$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
$form=isset($_REQUEST['form']) ? $_REQUEST['form'] : "Login";

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
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/bootstrap.min.css" rel="stylesheet" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Class Record System</title>
  </head>
  <body>
    <div class="text-center mt-5">
        <div class="card" style="width: 500px;;margin:auto">
            <div class="card-header">
                <h1 class="h3 mb-3"><?= $form ?> Form</h1>
            </div>
            <div class="card-body">
              <?php if($form=="Login") {  ?>
              <form id="frm_login">
                  <input type="hidden" id="type" name="type" value="login">
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Email/Username</label>
                </div>
                <div class="col-sm">
                  <input type="text" id="Username" name="Username" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Password</label>
                </div>
                <div class="col-sm">
                  <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline" required>
                </div>
              </div>
              <div class="row mb-3 text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
              <div class=""style="float:right"><small>Not yet registered ? <a href="?form=Register">click here!</a></small></div>
              <?php }else{ ?>
              <form id="frm_register">
                  <input type="hidden" id="type" name="type" value="register">
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Username</label>
                </div>
                <div class="col-sm">
                  <input type="text" id="Username" name="Username" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Email</label>
                </div>
                <div class="col-sm">
                  <input type="text" id="email" name="email" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">First Name</label>
                </div>
                <div class="col-sm">
                  <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Middle Name</label>
                </div>
                <div class="col-sm">
                  <input type="text" id="middle_name" name="middle_name" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Last Name</label>
                </div>
                <div class="col-sm">
                  <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Password</label>
                </div>
                <div class="col-sm">
                  <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-left">
                  <label for="inputPassword6" class="col-form-label">Confirm Password</label>
                </div>
                <div class="col-sm">
                  <input type="password" id="repassword" name="repassword" class="form-control" aria-describedby="passwordHelpInline" required>
                </div>
              </div>
              <div class="row mb-3 text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
              <div class=""style="float:right"><small>Already have an account ? <a href="?form=Login">click here!</a></small></div>
              <?php } ?>
            </div>
        </div>
        
        <script>
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
				alert(data);
				window.location.replace("admin/index.php");
				return;
			}
			alert(data); // show response from the php script.
		}
	 });
});
	
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
        </script>
    </div>
  </body>
</html>
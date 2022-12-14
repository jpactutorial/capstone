<?php
$page="Users";
$manage="yes";
include_once("../common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;

$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
if($type == "addUsers"){
	$checkExists=$jpac->CheckExists("user","lrn",$_REQUEST['lrn']);
	if(count($checkExists)>0){
		echo "LRN already exists!";
		exit;
	}
    $dateTimeNow=date("Y-m-d H:i:s");
    $password=$_REQUEST['password'];
    if($password==""){
        $password="abcd1234";
    }
    $dataInsert['gender']=$_REQUEST['gender'];
    $dataInsert['email']=$_REQUEST['email'];
    $dataInsert['lrn']=$_REQUEST['lrn'];
	$dataInsert['username']=$_REQUEST['username'];
	$dataInsert['password']=password_hash($password,PASSWORD_BCRYPT);
	$dataInsert['first_name']=$_REQUEST['first_name'];
	$dataInsert['middle_name']=$_REQUEST['middle_name'];
	$dataInsert['last_name']=$_REQUEST['last_name'];
	$dataInsert['role']=$_REQUEST['role'];
	$dataInsert['date_created']=$dateTimeNow;
	$dataInsert['date_updated']=$dateTimeNow;
	$dataInsert['status']=$_REQUEST['status'];
	$id=$jpac->SQLInsert('user',$dataInsert);
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}
if($type == "editUsers"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $password=$_REQUEST['password'];
    if($password==""){
        $password="abcd1234";
    }
    $dataUpdate['email']=$_REQUEST['email'];
    $dataUpdate['lrn']=$_REQUEST['lrn'];
	$dataUpdate['username']=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    if($password!=""){
        $dataUpdate['password']=password_hash($password,PASSWORD_BCRYPT);
    }
   	$dataUpdate['first_name']=$_REQUEST['first_name'];
	$dataUpdate['middle_name']=$_REQUEST['middle_name'];
	$dataUpdate['last_name']=$_REQUEST['last_name'];
	$dataUpdate['role']=$_REQUEST['role'];
	$dataUpdate['date_updated']=$dateTimeNow;
	$dataUpdate['gender']=$_REQUEST['gender'];
	$dataUpdate['status']=$_REQUEST['status'];
	$id=$jpac->SQLUpdate('user',$dataUpdate," WHERE userId='".$_REQUEST['userId']."'");
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
  </head>
  <body>
<main class="d-flex flex-nowrap">
    <?php include_once("sidebar.php"); ?>
<div class="b-example-divider b-example-vr" style="width:1px;"></div>

<div class="row" style="overflow-x: scroll;">
    <div class="card">
        <div class="card-header text-right">
            <button class="btn btn-primary" onclick="showModalUsers('addUsers')"  data-toggle="modal" data-target="#modalUsers">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
        </div>
        <div class="modal fade" id="modalUsers" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Users</h5>
                        <button type="button" class="close" data-dismiss="modal" style="border:none;" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_users" name="form_users">
                    
                    <div class="modal-body">
                            <input type="hidden" id="type" name="type">
                            <input type="hidden" id="userId" name="userId">
                            
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">LRN</label>
                                <div class="col-sm-9">
                                    <input type="text" id="lrn" name="lrn" class="form-control" placeholder="LRN">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="mb-3 row">

                                <label class="col-form-label col-sm-3 text-sm-left">Password</label>
                                <div class="col-sm-9"> 
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    <small class="text-danger">Leave blank if you dont want to change password.</small>   
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Middle Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Middle Name" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Gender</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="gender" name="gender" value="" required>
                                        <option></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="role" name="role" value="" required>
                                        <option></option>
                                        <option>Student</option>
                                        <option>Teacher</option>
                                        <option>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="status" name ="status"value="Active">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <!--<option value="Deleted">Deleted</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 float-right">
                                <label class="form-check m-0">
                                <input type="checkbox" class="form-check-input" required>
                                <span class="form-check-label">Confirm</span>
                                </label>
                            </div>
                            <br/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            
$("#form_users").submit(function(e) {
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
            function showModalUsers(action,id=0,email='',lrn='',username='',first_name='',middle_name='',last_name='',role='',status='',gender=''){
                $('#type').val(action);
                $('#userId').val(id);
                $('#email').val(email);
                $('#lrn').val(lrn);
                $('#username').val(username);
                $('#password').val("");
                $('#first_name').val(first_name);
                $('#middle_name').val(middle_name);
                $('#last_name').val(last_name);
                $('#role').val(role);
                $('#status').val(status);
                //$('#gender').val(gender);
                if(gender=="Male"){
                    document.getElementById("gender").options.selectedIndex=1;
                }else{
                    document.getElementById("gender").options.selectedIndex=2;
                }
            }
        </script>
        <div class="card-body table-responsive">
        <table class="table table-striped table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>LRN</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th>Date Last Updated</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result=$jpac->SQLQuery("SELECT * FROM user");
                    for($i=0;$i<count($result);$i++){
                    ?>
                    <tr>
                        <td><?= ($i+1) ?></td>
                        <td><?= $result[$i]['email'] ?></td>
                        <td><?= $result[$i]['lrn'] ?></td>
                        <td><?= $result[$i]['username'] ?></td>
                        <td><?= $result[$i]['first_name'] ?></td>
                        <td><?= $result[$i]['middle_name'] ?></td>
                        <td><?= $result[$i]['last_name'] ?></td>
                        <td><?= $result[$i]['gender'] ?></td>
                        <td><?= $result[$i]['role'] ?></td>
                        <td><?= $result[$i]['date_created'] ?></td>
                        <td><?= $result[$i]['date_updated'] ?></td>
                        <td><?= $result[$i]['status'] ?></td>
                        <td class="table-action">
                            <a href="#" data-toggle="modal" data-target="#modalUsers" onclick="showModalUsers('editUsers','<?= $result[$i]['userId'] ?>','<?= $result[$i]['email'] ?>','<?= $result[$i]['lrn'] ?>','<?= $result[$i]['username'] ?>','<?= $result[$i]['first_name'] ?>','<?= $result[$i]['middle_name'] ?>','<?= $result[$i]['last_name'] ?>','<?= $result[$i]['role'] ?>','<?= $result[$i]['status'] ?>','<?= $result[$i]['gender'] ?>')">
                            <i class="fa fa-edit"></i></a>
                            
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
    
</div>

</main>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<script>
$(document).ready(function() {
    $('#usersTable').DataTable();
});

</script>

    <script src="js/bootstrap.bundle.min.js"></script>

      <script src="sidebars/sidebars.js"></script>
  </body>
</html>

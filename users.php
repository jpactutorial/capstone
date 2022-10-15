<?php
$page="Users";
$manage="yes";
include_once("common.php");
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
<?php include_once("includes/header.php"); ?>
	<div class="wrapper">
		<?php include_once("menu.php") ?>
		<div class="main">
			<?php include_once("navbar.php") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Manage Users</h1>

					<div class="row">
                        <div class="card">
                            <div class="card-header text-right">
                                <button class="btn btn-primary" onclick="showModalUsers('addUsers')"  data-toggle="modal" data-target="#modalUsers">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
                            </div>
							<div class="modal fade" id="modalUsers" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Users</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
								function showModalUsers(action,id=0,email='',lrn='',username='',first_name='',middle_name='',last_name='',role='',status=''){
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
											<td><?= $result[$i]['role'] ?></td>
											<td><?= $result[$i]['date_created'] ?></td>
											<td><?= $result[$i]['date_updated'] ?></td>
											<td><?= $result[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#modalUsers" onclick="showModalUsers('editUsers','<?= $result[$i]['userId'] ?>','<?= $result[$i]['email'] ?>','<?= $result[$i]['lrn'] ?>','<?= $result[$i]['username'] ?>','<?= $result[$i]['first_name'] ?>','<?= $result[$i]['middle_name'] ?>','<?= $result[$i]['last_name'] ?>','<?= $result[$i]['role'] ?>','<?= $result[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
												<a href="#"><i class="align-middle" data-feather="trash"></i></a>
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

			<?php include_once("includes/footer.php") ?>
		</div>
	</div>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<script>
$(document).ready(function() {
    $('#usersTable').DataTable();
});

</script>
	<script src="js/app.js"></script>
</body>

</html>
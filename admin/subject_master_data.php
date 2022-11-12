<?php
$page="Subjects Master Data";
$manage="yes";
include_once("../common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;
if($userData[0]['role']=="Teacher"){
    header("Location: teacher_subject.php");
}
$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
if($type == "add"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $dataInsert['subjects']=$_REQUEST['subjects'];
	$dataInsert['description']=$_REQUEST['description'];
	$dataInsert['status']=$_REQUEST['status'];
	$dataInsert['datecreated']=$dateTimeNow;
	$dataInsert['dateupdated']=$dateTimeNow;
	$dataInsert['userId']=$userData[0]['userId'];
	$id=$jpac->SQLInsert('subjects',$dataInsert);
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}
if($type == "edit"){
    $dateTimeNow=date("Y-m-d H:i:s");
  

    $dataUpdate['subjects']=$_REQUEST['subjects'];
	$dataUpdate['description']=$_REQUEST['description'];
    $dataUpdate['dateupdated']=$dateTimeNow;
	$dataUpdate['status']=$_REQUEST['status'];   
	$dataInsert['userId']=$userData[0]['userId']; 

	$id=$jpac->SQLUpdate('subjects',$dataUpdate," WHERE subjectId='".$_REQUEST['id']."'");
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
  
  <div class="container-fluid p-0" style="margin:20px;">

<h1 class="h3 mb-3">Manage Subjects</h1>

<div class="row">
    <div class="card">
        <div class="card-header text-right">
            <button class="btn btn-primary" onclick="showModalData('add')"  data-toggle="modal" data-target="#modalData">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
        </div>
        <div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data</h5>
                        <button type="button" class="close"  style="border:none;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_data" name="form_data">
                    
                    <div class="modal-body">
                            <input type="hidden" id="type" name="type">
                            <input type="hidden" id="id" name="id">
                            
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Subjects</label>
                                <div class="col-sm-9">
                                    <input type="text" id="subjects" name="subjects" class="form-control" placeholder="Subjects" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-left">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="status" name ="status"value="Active">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Deleted">Deleted</option>
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
            
$("#form_data").submit(function(e) {
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
function showModalData(action,id=0,grade='',section='',status=''){
$('#type').val(action);
$('#id').val(id);
$('#subjects').val(grade);
$('#description').val(section);
$('#status').val(status);
}
        </script>
        <div class="card-body table-responsive">
        <table class="table table-striped table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subjects</th>
                        <th>Descriptions</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result=$jpac->SQLQuery("SELECT * FROM subjects");
                    for($i=0;$i<count($result);$i++){
                    ?>
                    <tr>
                        <td><?= ($i+1) ?></td>
                        <td><?= $result[$i]['subjects'] ?></td>
                        <td><?= $result[$i]['description'] ?></td>
                        <td><?= $result[$i]['status'] ?></td>
                        <td class="table-action">
                            <a href="#" data-toggle="modal" data-target="#modalData" onclick="showModalData('edit','<?= $result[$i]['subjectId'] ?>','<?= $result[$i]['subjects'] ?>','<?= $result[$i]['description'] ?>','<?= $result[$i]['status'] ?>')">
                                <i class="fa fa-edit"></i>
                            </a> 
                            &nbsp;
                           <!-- <a href="#">
                                <i class="fa fa-trash-o"></i>
                            </a> -->
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
    $('#usersTable').DataTable({
        lengthMenu: [
            [11, 25, 50, -1],
            [11, 25, 50, 'All'],
        ],
    });
});

</script>

    <script src="js/bootstrap.bundle.min.js"></script>

      <script src="sidebars/sidebars.js"></script>
  </body>
</html>

<?php
$page="Teacher Exam";
$manage="yes";
include_once("common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;

$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
$typeItems=isset($_REQUEST['typeItems']) ? $_REQUEST['typeItems'] : "";
if($type == "add"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $dataInsert['description']=$_REQUEST['description'];
	$dataInsert['status']=$_REQUEST['status'];
	$dataInsert['datecreated']=$dateTimeNow;
	$dataInsert['dateupdated']=$dateTimeNow;
	$dataInsert['userId']=$userData[0]['userId'];
	$id=$jpac->SQLInsert('computation_master',$dataInsert);
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}
if($type == "edit"){
    $dateTimeNow=date("Y-m-d H:i:s");
  

    $dataUpdate['subjectId']=$_REQUEST['subjectId'];
	$dataUpdate['teacherId']=$_REQUEST['teacherId'];
    $dataUpdate['dateupdated']=$dateTimeNow;
	$dataUpdate['statusItems']=$_REQUEST['statusItems'];   
	$dataInsert['userId']=$userData[0]['userId']; 

	$id=$jpac->SQLUpdate('subjects_assign',$dataUpdate," WHERE subjectAssignId='".$_REQUEST['id']."'");
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}

if($typeItems == "add"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $dataInsert['computationMasterId']=$_REQUEST['computationMasterId'];
	$dataInsert['description']=$_REQUEST['descriptionItems'];
	$dataInsert['percentage']=$_REQUEST['percentage'];
	$dataInsert['status']=$_REQUEST['statusItems'];
	$dataInsert['datecreated']=$dateTimeNow;
	$dataInsert['dateupdated']=$dateTimeNow;
	$dataInsert['userId']=$userData[0]['userId'];
	$id=$jpac->SQLInsert('computation_items',$dataInsert);
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    exit;
}

if($typeItems == "edit"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $data['computationMasterId']=$_REQUEST['computationMasterId'];
	$data['description']=$_REQUEST['descriptionItems'];
	$data['percentage']=$_REQUEST['percentage'];
	$data['status']=$_REQUEST['statusItems'];
	$data['dateupdated']=$dateTimeNow;
	$data['userId']=$userData[0]['userId'];
	$id=$jpac->SQLUpdate('computation_items',$data," WHERE computationItemsId='".$_REQUEST['idItems']."'");
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    exit;
}
if($type == "getComputationItems"){
    $returnArr=$jpac->SQLQuery("SELECT * FROM computation_items WHERE computationItemsId='".$_REQUEST['computationItemsId']."'");
    echo json_encode($returnArr);
    exit;
}
$examMasterData=$jpac->SQLQuery("SELECT * FROM exam_master_data WHERE userId='".$userData[0]['userId']."' ");
$computationItems=$jpac->SQLQuery("SELECT t0.*,t1.description as computation_description FROM computation_items t0 LEFT JOIN computation_master t1 on t0.computationMasterId=t1.computationMasterId WHERE t0.userId='".$userData[0]['userId']."' ORDER BY t0.computationMasterId ASC");
?>
<?php include_once("includes/header.php"); ?>
	<div class="wrapper">
		<?php include_once("menu.php") ?>
		<div class="main">
			<?php include_once("navbar.php") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Manage Exams</h1>

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
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="form_data" name="form_data">
										
										<div class="modal-body">
												<input type="hidden" id="type" name="type">
												<input type="hidden" id="id" name="id">
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Subject</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="subjectId" name ="subjectId"value="" onchange="updateComputationItems()">
                                                            <option value=""> - </option>
                                                            <?php
                                                            $subjectDatas=$jpac->SQLQuery("SELECT t0.subjectId,t1.description FROM subjects_assign t0 left join subjects t1 on t0.subjectId=t1.subjectId WHERE t0.teacherId='".$userData[0]['userId']."'");
                                                            for($i=0;$i<count($subjectDatas);$i++){ ?>
                                                                <option value="<?= $subjectDatas[$i]['subjectAssignId'] ?>"><?= $subjectDatas[$i]['description'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <script>
                                                    function updateComputationItems(id){
                                                        $.ajax({
                                                            type:"POST",
                                                            url:window.location,
                                                            data:{
                                                                type:"getComputationItems",
                                                                computationMasterId:id
                                                            },
                                                            async:false,
                                                            success:function(data){
                                                                $('#computationItemsId').empty();
                                                                var data=JSON.parse(data);
                                                                for(i=0;i<data.length;i++){
                                                                    var opt = document.createElement('option');
                                                                    opt.text = data[i]['description'];
                                                                    opt.value = data[i]['computationItemsId'];
                                                                    document.getElementById("computationItemsId").append(opt);
                                                                }
                                                            }
                                                        });
                                                    }
                                                </script>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Computation Item</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="computationItemsId" name ="computationItemsId"value="">
                                                            <option value=""> - </option>    
                                                        </select>
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
function showModalData(action,id=0,description='',status=''){
    $('#type').val(action);
    $('#id').val(id);
    $('#description').val(description);
    $('#status').val(status);
}
							</script>
                            <div class="card-body table-responsive">
                            <table class="table table-striped table-hover" id="usersTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Description</th>
											<th>Subject</th>
											<th>Computation Items</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php
                                        $result=$examMasterData;
                                        for($i=0;$i<count($result);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['description'] ?></td>
											<td><?= $result[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#modalData" onclick="showModalData('edit','<?= $result[$i]['subjectAssignId'] ?>','<?= $result[$i]['subjectId'] ?>','<?= $result[$i]['teacherId'] ?>','<?= $result[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
												<a href="#"><i class="align-middle" data-feather="trash"></i></a>
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
                            </div>
                        </div>
						
					</div>

                    <h1 class="h3 mb-3">Manage Exam Items</h1>

					<div class="row">
                        <div class="card">
                            <div class="card-header text-right">
                                <button class="btn btn-primary" onclick="showModalDataItems('add')"  data-toggle="modal" data-target="#modalDataItems">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
                            </div>
							<div class="modal fade" id="modalDataItems" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Data Items</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="form_dataItems" name="form_dataItems">
										
										<div class="modal-body">
												<input type="hidden" id="typeItems" name="typeItems">
												<input type="hidden" id="idItems" name="idItems">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Computation</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="computationMasterId" name ="computationMasterId"value="<?= $computationMasterId[0]['computationMasterId'] ?>">
                                                            <?php for($c=0;$c<count($computationMaster);$c++){ ?>
                                                                <option value="<?= $computationMaster[$c]['computationMasterId'] ?>"><?= $computationMaster[$c]['description'] ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="descriptionItems" name="descriptionItems" class="form-control" placeholder="Description" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Percentage</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="percentage" name="percentage" class="form-control" placeholder="Percentage" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="statusItems" name ="statusItems" value="Active">
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
                                
$("#form_dataItems").submit(function(e) {
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
function showModalDataItems(action,id=0,description='',percentage='',status=''){
    $('#typeItems').val(action);
    $('#idItems').val(id);
    $('#descriptionItems').val(description);
    $('#percentage').val(percentage);
    $('#statusItems').val(status);
}
							</script>
                            <div class="card-body table-responsive">
                            <table class="table table-striped table-hover" id="usersTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Computation</th>
											<th>Description</th>
											<th>Percentage</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php
                                        $result=$computationItems;
                                        for($i=0;$i<count($result);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['computation_description'] ?></td>
											<td><?= $result[$i]['description'] ?></td>
											<td><?= $result[$i]['percentage'] ?></td>
											<td><?= $result[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#modalDataItems" onclick="showModalDataItems('edit','<?= $result[$i]['computationItemsId'] ?>','<?= $result[$i]['description'] ?>','<?= $result[$i]['percentage'] ?>','<?= $result[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
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
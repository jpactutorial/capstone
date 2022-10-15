<?php
$page="Subjects";
$manage="yes";
include_once("common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;

$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
if($type == "add"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $dataInsert['subjectId']=$_REQUEST['subjectId'];
	$dataInsert['teacherId']=$_REQUEST['teacherId'];
	$dataInsert['classMasterId']=$_REQUEST['classMasterId'];
	$dataInsert['status']=$_REQUEST['status'];
	$dataInsert['datecreated']=$dateTimeNow;
	$dataInsert['dateupdated']=$dateTimeNow;
	$dataInsert['userId']=$userData[0]['userId'];
	$id=$jpac->SQLInsert('subjects_assign',$dataInsert);
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
	$dataUpdate['classMasterId']=$_REQUEST['classMasterId'];
	$dataUpdate['teacherId']=$_REQUEST['teacherId'];
    $dataUpdate['dateupdated']=$dateTimeNow;
	$dataUpdate['status']=$_REQUEST['status'];   
	$dataInsert['userId']=$userData[0]['userId']; 

	$id=$jpac->SQLUpdate('subjects_assign',$dataUpdate," WHERE subjectAssignId='".$_REQUEST['id']."'");
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}

$subjectData=$jpac->SQLQuery("SELECT * FROM subjects ");
$gradeSectionData=$jpac->SQLQuery("SELECT * FROM classes_master_data ");
$teacherData=$jpac->SQLQuery("SELECT * FROM user WHERE role='Teacher' and status='Active' ORDER BY first_name ASC");
?>
<?php include_once("includes/header.php"); ?>
	<div class="wrapper">
		<?php include_once("menu.php") ?>
		<div class="main">
			<?php include_once("navbar.php") ?>

			<main class="content">
				<div class="container-fluid p-0">

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
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="form_data" name="form_data">
										
										<div class="modal-body">
												<input type="hidden" id="type" name="type">
												<input type="hidden" id="id" name="id">
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Subject</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="subjectId" name ="subjectId" value="">
                                                            <option value="-"> - </option>
                                                            <?php for($i=0;$i<count($subjectData);$i++) { ?>
                                                            <option value="<?= $subjectData[$i]['subjectId'] ?>"><?= $subjectData[$i]['subjects'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Grade & Section</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="classMasterId" name ="classMasterId" value="">
                                                            <option value="-"> - </option>
                                                            <?php for($i=0;$i<count($gradeSectionData);$i++) { ?>
                                                            <option value="<?= $gradeSectionData[$i]['classMasterId'] ?>"><?= $gradeSectionData[$i]['grade']." - ".$gradeSectionData[$i]['section'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Teacher</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="teacherId" name ="teacherId" value="">
                                                            <option value="-"> - </option>
                                                            <?php for($i=0;$i<count($teacherData);$i++) { ?>
                                                            <option value="<?= $teacherData[$i]['userId'] ?>"><?= $teacherData[$i]['first_name']." ".$teacherData[$i]['middle_name']." ".$teacherData[$i]['last_name'] ?></option>
                                                            <?php } ?>
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
function showModalData(action,id=0,subjectId='',teacherId='',status='',classMasterId=''){
    $('#type').val(action);
    $('#id').val(id);
    $('#subjectId').val(subjectId);
    $('#teacherId').val(teacherId);
    $('#status').val(status);
    $('#classMasterId').val(classMasterId);
}
							</script>
                            <div class="card-body table-responsive">
                            <table class="table table-striped table-hover" id="usersTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Subjects</th>
											<th>Grade & Section</th>
											<th>Teacher</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php
										$sql="SELECT t0.classMasterId,t0.subjectAssignId,t0.subjectId,t3.grade,t3.section,t0.teacherId,t1.subjects,t2.first_name,t2.middle_name,t2.last_name,t0.status 
										FROM `subjects_assign` t0 
										LEFT JOIN subjects t1 on t0.subjectId=t1.subjectId 
										LEFT JOIN `user` t2 on t0.teacherId=t2.userId 
										LEFT JOIN `classes_master_data` t3 on t0.classMasterId=t3.classMasterId";
                                        $result=$jpac->SQLQuery($sql);
                                        for($i=0;$i<count($result);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['subjects'] ?></td>
											<td><?= $result[$i]['grade']." - ".$result[$i]['section'] ?></td>
											<td><?= $result[$i]['first_name']." ".$result[$i]['middle_name']." ".$result[$i]['last_name'] ?></td>
											<td><?= $result[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#modalData" onclick="showModalData('edit','<?= $result[$i]['subjectAssignId'] ?>','<?= $result[$i]['subjectId'] ?>','<?= $result[$i]['teacherId'] ?>','<?= $result[$i]['status'] ?>','<?= $result[$i]['classMasterId'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
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
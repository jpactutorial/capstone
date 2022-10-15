<?php
$page="Teacher Subject Classes";
$manage="yes";
include_once("common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;

$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
if($type == "edit"){
    $dateTimeNow=date("Y-m-d H:i:s");

    $dataUpdate['computationMasterId']=$_REQUEST['computationMasterId'];
	$dataUpdate['dateupdated']=$dateTimeNow;
	$dataUpdate['status']=$_REQUEST['status'];   

	$id=$jpac->SQLUpdate('subjects_assign',$dataUpdate," WHERE subjectAssignId='".$_REQUEST['id']."'");
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}
$subjectClassesLists=$jpac->SQLQuery("SELECT sa.subjectAssignId,s.subjects,s.description,cmd.grade,cmd.section,IFNULL((SELECT COUNT(*) FROM class WHERE classMasterId=cmd.classMasterId),0) as totalStudent,cmd.classMasterId,sa.subjectId FROM subjects_assign sa LEFT JOIN subjects s on sa.subjectId=s.subjectId LEFT JOIN classes_master_data cmd on sa.classMasterId=cmd.classMasterId WHERE sa.teacherId='".$userData[0]['userId']."'");
$computationMaster=$jpac->SQLQuery("SELECT * FROM computation_master WHERE userId='".$userData[0]['userId']."' ORDER BY description ASC");
?>
<?php include_once("includes/header.php"); ?>
	<div class="wrapper">
		<?php include_once("menu.php") ?>
		<div class="main">
			<?php include_once("navbar.php") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Subject Classes</h1>

					<div class="row">
                        <div class="card">
                            <!--
                            <div class="card-header text-right">
                                <button class="btn btn-primary" onclick="showModalData('add')"  data-toggle="modal" data-target="#modalData">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
                            </div>-->
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
                                                    <label class="col-form-label col-sm-3 text-sm-left">Computation</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="computationMasterId" name ="computationMasterId" value="">
                                                            <option value="-"> - </option>
                                                            <?php 
                                                            $result=$computationMaster;
                                                            for($i=0;$i<count($result);$i++) { ?>
                                                            <option value="<?= $result[$i]['computationMasterId'] ?>"><?= $result[$i]['description'] ?></option>
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
function showModalData(action,id=0,subjectId='',computationMasterId='',status=''){
    $('#type').val(action);
    $('#id').val(id);subjectId
    $('#subjectId').val(subjectId);
    $('#computationMasterId').val(computationMasterId);
    $('#status').val(status);
}
							</script>
                            <div class="card-body table-responsive">
                            <table class="table table-striped table-hover" id="usersTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Grade & Section</th>
											<th>Subjects</th>
											<th>Total Students</th>
											<th>1st</th>
											<th>2nd</th>
											<th>3rd</th>
											<th>4th</th>
                                        </tr>
									</thead>
									<tbody>
										<?php
                                        $result=$subjectClassesLists;
                                        for($i=0;$i<count($result);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['grade']." - ".$result[$i]['section'] ?></td>
											<td><?= $result[$i]['subjects'] ?></td>
											<td><?= $result[$i]['totalStudent'] ?></td>
											<?php for($q=1;$q<=4;$q++){ ?>
											<td class="table-action">
												<a href="teacher_class_grading.php?classMasterId=<?= $result[$i]['classMasterId'] ?>&subjectId=<?= $result[$i]['subjectId'] ?>&quarter=<?= $q ?>" ><i class="align-middle" data-feather="edit-2"></i></a>
											</td>
											<?php } ?>
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
<?php
$page="Teacher Subjects";
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

$subjectData=$jpac->SQLQuery("SELECT t0.*,t1.*,t2.description as computation_description FROM subjects_assign t0 LEFT JOIN subjects t1 on t0.subjectId=t1.subjectId LEFT JOIN computation_master t2 on t0.computationMasterId=t2.computationMasterId WHERE t0.teacherId='".$userData[0]['userId']."' ");
$computationMaster=$jpac->SQLQuery("SELECT * FROM computation_master WHERE userId='".$userData[0]['userId']."' ORDER BY description ASC");
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
											<th>Subjects</th>
											<th>Computation</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php
                                        $result=$subjectData;
                                        for($i=0;$i<count($result);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['subjects'] ?></td>
											<td><?= $result[$i]['computation_description'] ?></td>
											<td><?= $result[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#modalData" onclick="showModalData('edit','<?= $result[$i]['subjectAssignId'] ?>','<?= $result[$i]['subjectId'] ?>','<?= $result[$i]['computationMasterId'] ?>','<?= $result[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
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
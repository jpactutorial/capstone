<?php
$page="Classes";
$manage="yes";
include_once("common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;
$id=isset($_REQUEST['id']) ? $_REQUEST['id'] : "";


$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
if($type == "add"){
    $dateTimeNow=date("Y-m-d H:i:s");
    $dataInsert['grade']=$_REQUEST['grade'];
	$dataInsert['section']=$_REQUEST['section'];
	$dataInsert['status']=$_REQUEST['status'];
	$dataInsert['datecreated']=$dateTimeNow;
	$dataInsert['dateupdated']=$dateTimeNow;
	$dataInsert['userId']=$userData[0]['userId'];
	$id=$jpac->SQLInsert('classes_master_data',$dataInsert);
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
    
	exit;
}
if($type == "edit"){
	$dateTimeNow=date("Y-m-d H:i:s");
	$checkIfExists=$jpac->SQLQuery("SELECT * FROM class WHERE studentId='".$_REQUEST['id']."'");
	if(count($checkIfExists)>0){
		$dataUpdate['classMasterId']=$_REQUEST['section'];
		$dataUpdate['dateupdated']=$dateTimeNow;
		$dataInsert['userId']=$userData[0]['userId']; 
		$id=$jpac->SQLUpdate('class',$dataUpdate," WHERE studentId='".$_REQUEST['id']."'");
	}else{
		$dataInsert['studentId']=$_REQUEST['id'];
		$dataInsert['classMasterId']=$_REQUEST['section'];
		$dataInsert['dateupdated']=$dateTimeNow;
		$dataInsert['datecreated']=$dateTimeNow;   
		$dataInsert['userId']=$userData[0]['userId'];
		$id=$jpac->SQLInsert('class',$dataInsert);
	}
	if($id>0){
		echo "Success";
	}else{
		echo json_encode($_REQUEST);
		echo "Nothing change!";
	}
	exit;
}
$gradeVal="";
$sectionVal="";
if($id==""){	
	$sqlStudent="SELECT t0.*,IFNULL(t2.grade,'') as grade,IFNULL(t2.section,'') as section from user t0 LEFT JOIN class t1 on t0.userId=t1.studentId LEFT JOIN classes_master_data t2 on t1.classMasterId=t2.classMasterId WHERE role='Student'";
	$studentData=$jpac->SQLQuery($sqlStudent);
}else{
	$sqlStudent="SELECT t0.*,IFNULL(t2.grade,'') as grade,IFNULL(t2.section,'') as section from user t0 LEFT JOIN class t1 on t0.userId=t1.studentId LEFT JOIN classes_master_data t2 on t1.classMasterId=t2.classMasterId WHERE role='Student' and t2.classMasterId='".$id."'";
	$studentData=$jpac->SQLQuery($sqlStudent);
	$gradeVal="( Grade: " .$studentData[0]['Grade'];
	$sectionVal=" Section: ".$studentData[0]['Section'] ." ) ";
}
if($type == "showSectionData"){
	echo json_encode($jpac->SQLQuery("SELECT * FROM classes_master_data WHERE grade='".$_REQUEST['grade']."'"));
	exit;
}
$classMasterData=$jpac->SQLQuery("SELECT grade FROM classes_master_data GROUP BY grade ORDER BY grade ASC");
?>
<?php include_once("includes/header.php"); ?>
	<div class="wrapper">
		<?php include_once("menu.php") ?>
		<div class="main">
			<?php include_once("navbar.php") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Manage Classes <?= $gradeVal ?> - <?= $sectionVal ?></h1>

					<div class="row">
                        <div class="card">
                            <div class="card-header text-right">
                                <!--<button class="btn btn-primary" onclick="showModalData('add')"  data-toggle="modal" data-target="#modalData">Add <i class="align-middle" data-feather="plus-circle"></i> </button> -->
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
                                                    <label class="col-form-label col-sm-3 text-sm-left">Grade</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" onchange="showSection()" id="grade" name ="grade"value="">
                                                            <option value=""> - </option>
															<?php for($i=0;$i<count($classMasterData);$i++){ ?>
                                                            <option value="<?= $classMasterData[$i]['grade'] ?>"><?= $classMasterData[$i]['grade'] ?></option>
															<?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
												<div class="mb-3 row">
                                                    <label class="col-form-label col-sm-3 text-sm-left">Section</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="section" name ="section"value="">
                                                            <option value=""> - </option>
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
function showSection(){
	$.ajax({
		type:"POST",
		url:window.location,
		data:{
			type:"showSectionData",
			grade:$('#grade').val()
		},
		success:function(data){
			var data=JSON.parse(data);
			for(i=0;i<data.length;i++){
				var x = document.getElementById("section");
				var option = document.createElement("option");
				option.text = data[i]['section'];
				option.value= data[i]['classMasterId'];
				x.add(option);
			}
		}
	});
}   
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
    $('#grade').val(grade);
    $('#section').val(section);
    $('#status').val(status);
}
							</script>
                            <div class="card-body table-responsive">
                            <table class="table table-striped table-hover" id="usersTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Student FName</th>
											<th>Student MName</th>
											<th>Student LName</th>
											<th>Grade</th>
											<th>Section</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<tbody>
										<?php
                                        $result=$studentData;
                                        for($i=0;$i<count($result);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['first_name'] ?></td>
											<td><?= $result[$i]['middle_name'] ?></td>
											<td><?= $result[$i]['last_name'] ?></td>
											<td><?= $result[$i]['grade'] ?></td>
											<td><?= $result[$i]['section'] ?></td>
											<td><?= $result[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#modalData" onclick="showModalData('edit','<?= $result[$i]['userId'] ?>','<?= $result[$i]['grade'] ?>','<?= $result[$i]['section'] ?>','<?= $result[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
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
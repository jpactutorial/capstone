<?php
$page="Teacher Student List";
$manage="yes";
include_once("common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;

$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
$classMasterId=isset($_REQUEST['classMasterId']) ? $_REQUEST['classMasterId'] : "";
$subjectId=isset($_REQUEST['subjectId']) ? $_REQUEST['subjectId'] : "";
$quarter=isset($_REQUEST['quarter']) ? $_REQUEST['quarter'] : "";

if($type == "saveGrade"){
	$dataPost['classMasterId']=$_REQUEST['classMasterId'];
	$dataPost['subjectId']=$_REQUEST['subjectId'];
	$dataPost['quarter']=$_REQUEST['quarter'];
	$dataPost['columnNumber']=$_REQUEST['columnNumber'];
	$dataPost['grade_score']=$_REQUEST['score'];
	$dataPost['studentId']=$_REQUEST['studentId'];
	$dataPost['computationItemsId']=$_REQUEST['computationItemsId'];
	$checkIfExists=$jpac->SQLQuery("SELECT COUNT(*) as Count FROM class_grade WHERE classMasterId='".$_REQUEST['classMasterId']."' and subjectId='".$_REQUEST['subjectId']."' and quarter='".$_REQUEST['quarter']."' and columnNumber='".$_REQUEST['columnNumber']."' and studentId='".$_REQUEST['studentId']."' and computationItemsId='".$dataPost['computationItemsId']."'");
	if($checkIfExists[0]['Count']>0){
		$successId=$jpac->SQLUpdate("class_grade",$dataPost," WHERE classMasterId='".$_REQUEST['classMasterId']."' and subjectId='".$_REQUEST['subjectId']."' and quarter='".$_REQUEST['quarter']."' and columnNumber='".$_REQUEST['columnNumber']."' and studentId='".$_REQUEST['studentId']."'  and computationItemsId='".$_REQUEST['computationItemsId']."'");
	}else{
		$successId=$jpac->SQLInsert("class_grade",$dataPost);
	}
	exit;
}

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
if($type == "saveTotalItems"){
	$datas=($_REQUEST['datas']);
	for($i=0;$i<count($datas);$i++){
		if($datas[$i]['objectValue']>0){
			$dataPost['classMasterId']=$datas[$i]['classMasterId'];
			$dataPost['subjectId']=$datas[$i]['subjectId'];
			$dataPost['quarter']=$datas[$i]['quarter'];
			$dataPost['totalItems']=$datas[$i]['objectValue'];
			$dataPost['columnNumber']=$i;
			$dataPost['computationItemsId']=$datas[$i]['computationItemsId'];
			$checkExists=$jpac->SQLQuery("SELECT COUNT(*) as Count FROM class_total_items WHERE classMasterId='".$dataPost['classMasterId']."' and subjectId='".$dataPost['subjectId']."' and quarter='".$dataPost['quarter']."' and columnNumber='".$i."' and computationItemsId='".$dataPost['computationItemsId']."'");
	
			if($checkExists[0]['Count']>0){
				$successId=$jpac->SQLUpdate("class_total_items",$dataPost," WHERE classMasterId='".$dataPost['classMasterId']."' and subjectId='".$dataPost['subjectId']."' and quarter='".$dataPost['quarter']."' and columnNumber='".$i."' and computationItemsId='".$dataPost['computationItemsId']."' ");
			}else{
				$successId=$jpac->SQLInsert("class_total_items",$dataPost);
			}
		}
	}
	echo "Success!";
	exit;
}
if($type == "getTotalItems"){
	$totalItems=$jpac->SQLQuery("SELECT * FROM computation_items WHERE computationItemsId='".$_REQUEST['computationItemsId']."'");
	echo $totalItems[0]['total_exams'];
	exit;
}
$subjectClassLists=$jpac->SQLQuery("SELECT u.userId,u.first_name,u.middle_name,u.last_name,cmd.grade,cmd.section,c.studentId FROM class c LEFT JOIN classes_master_data cmd on c.classMasterId=cmd.classMasterId LEFT JOIN user u on c.studentId=u.userId WHERE c.classMasterId='".$classMasterId."'");
$computationMaster=$jpac->SQLQuery("SELECT ci.computationItemsId,ci.description,ci.percentage,ci.total_exams FROM computation_items ci LEFT JOIN subjects_assign sa ON ci.computationMasterId=sa.computationMasterId WHERE sa.teacherId='".$userData[0]['userId']."' and sa.subjectId='".$subjectId."' and sa.classMasterId='".$classMasterId."' ORDER BY ci.percentage ASC");
//echo "<pre>".json_encode($computationMaster,JSON_PRETTY_PRINT);
?>
<?php include_once("includes/header.php"); ?>
	<div class="wrapper">
		<?php include_once("menu.php") ?>
		<div class="main">
			<?php include_once("navbar.php") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Grade: <?= $subjectClassLists[0]['grade']." - ".$subjectClassLists[0]['section'] ?> -> Student List(s)</h1>

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
									<!--<thead>
										</thead> -->
									<thead>
										<tr>
											<th></th>
											<th></th>
											<?php
											$thWidth=50;
											$data=$computationMaster;
											for($i=0;$i<count($data);$i++){ ?> 
												<th colspan="<?= ($data[$i]['total_exams']+1) ?>" style="text-align:center;border:1px solid black"><?= $data[$i]['description']." - ".$data[$i]['percentage']."%" ?></th>
											<?php  
											} ?>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th></th>
											<th></th>
											<?php
											$data=$computationMaster;
											for($i=0;$i<count($data);$i++){ 
												for($n=0;$n<$data[$i]['total_exams'];$n++){ ?>
												<th><?= ($n+1) ?></th>
											<?php } echo "<th>Total</th>";
											} ?>
										</tr>
										<tr>
											<th>#</th>
											<th>Total Items</th>
											<?php
											$data=$computationMaster;
											$totalItemsArray=[];
											for($i=0;$i<count($data);$i++){ 
												for($n=0;$n<$data[$i]['total_exams'];$n++){ 
													$objectName="totalItems_".$data[$i]['computationItemsId'].'_'.$n;
													$checkExists=$jpac->SQLQuery("SELECT * FROM class_total_items WHERE classMasterId='".$classMasterId."' and subjectId='".$subjectId."' and quarter='".$quarter."' and columnNumber='".$n."' and computationItemsId='".$data[$i]['computationItemsId']."'");
													$totalItemsArray[]=array("computationItemsId"=>$data[$i]['computationItemsId'],"columnNumber"=>$n,"totalItems"=>(count($checkExists)>0 ? (int)$checkExists[0]['totalItems']: 0 ));
													?>
												<th><input type="text" name="<?= $objectName ?>" id="<?= $objectName ?>" value="<?= (count($checkExists)>0 ? $checkExists[0]['totalItems'] : 0 ) ?>" style="width:<?= $thWidth ?>px"></th>
											<?php } echo '<th>
														<div class="mb-2">
															<button onclick="saveTotalItems('.$data[$i]['computationItemsId'].','.$data[$i]['total_exams'].')"class="align-middle mr-2" data-feather="save" style="cursor:pointer">Save</button> 
														</div>
														</th>';
											} ?>
											<th>Final</th>
											<th>Action</th>
                                        </tr>
									</thead>
									<script>
										function saveTotalItems(computationItemsId,total_exams){	
											var dataPost=[];
											for(i=0;i<total_exams;i++){
												//alert(computationItemsId);
												var objectName="totalItems_"+computationItemsId+'_'+i;
												dataPost.push({
													objectName:objectName,
													objectValue:$("#"+objectName).val(),
													computationItemsId:computationItemsId,
													classMasterId:'<?= $classMasterId ?>',
													subjectId:'<?= $subjectId ?>',
													quarter:'<?= $quarter ?>'
												});
											}
											$.ajax({
												type:"POST",
												url:window.location,
												data:{
													type:"saveTotalItems",
													datas:dataPost
												},
												success:function(data){
													if(data.includes("Success")){
														alert(data);
														window.location.reload();
														return;
													}
													alert(data); 
												}
											});
										
										}
									</script>
									<tbody>
										<?php
										
										$result=$subjectClassLists;
                                        for($i=0;$i<count($result);$i++){
											$finalGrade=0;
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $result[$i]['last_name'].", ".$result[$i]['first_name']." ".$result[$i]['middle_name'] ?></td>
											<?php
											$data=$computationMaster;
											for($z=0;$z<count($data);$z++){ 

												$totalGetValue=0;
												$totalTest=0;
												for($a=0;$a<count($totalItemsArray);$a++){
													if($totalItemsArray[$a]['computationItemsId']==$data[$z]['computationItemsId']){
														$totalTest+=$totalItemsArray[$a]['totalItems'];
													}
												}
												for($n=0;$n<$data[$z]['total_exams'];$n++){ 
												$sqlcheck="SELECT * FROM class_grade WHERE classMasterId='".$classMasterId."' and subjectId='".$subjectId."' and quarter='".$quarter."' and columnNumber='".$n."' and computationItemsId='".$data[$z]['computationItemsId']."' and studentId='".$result[$i]['studentId']."'";
												$gradeValue=0;	
												$getValue=$jpac->SQLQuery($sqlcheck);
												if(count($getValue)>0){$gradeValue=$getValue[0]['grade_score'];}
												$totalGetValue=$totalGetValue+$gradeValue;
												?>
												<td>	
													<div class="col-12">
														<input value="<?= $gradeValue ?>" type="text" id="studentId<?= $result[$i]['userId']."_itemsId".$data[$z]['computationItemsId']."_exam".$n ?>" onchange="autoCompute('<?= $result[$i]['userId'] ?>','<?= $data[$z]['computationItemsId'] ?>','<?= $data[$z]['total_exams'] ?>','<?= $n ?>')" class="form-control mb-2 "  style="width:<?= $thWidth ?>px">
													</div>
												</td>
											
											<?php }
												$itemsTotalGrade=0;
												if($totalTest>0){$itemsTotalGrade=round(($totalGetValue/$totalTest)*100,2);}
												$finalGrade+= $itemsTotalGrade*($data[$z]['percentage']*.01);
												echo '<td id="computationItemsId'.$data[$z]['computationItemsId'].'_studentId'.$result[$i]['userId'].'">'.$itemsTotalGrade.'</td>';
											} ?>
											<td><?= $finalGrade ?></td>
											<td>
												<div class="mb-2">
													<button class="align-middle mr-2"onclick= "saveRow('<?= $result[$i]['studentId'] ?>')" data-feather="save" style="cursor:pointer">Save</button> 
												</div>
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
    $('#usersTable').DataTable({
		
		"ordering": false
	});
});
function autoCompute(studentId,computationItemsId,totalExams,columnNumber){m
	var total=0;
	var totalItems=0;
	for(i=0;i<totalExams;i++){
		total+=parseInt($('#studentId'+studentId+'_itemsId'+computationItemsId+'_exam'+i).val() || 0); 
		totalItems+=parseInt($("#totalItems_"+computationItemsId+'_'+i).val() || 0);
	}
	total=(total/(totalItems))*100;
	document.getElementById('computationItemsId'+computationItemsId+'_studentId'+studentId).innerHTML=total.toFixed(2);
}
function saveRow(studentId){
	var categoryArray=[];
	<?php
	$data=$computationMaster;
	for($z=0;$z<count($data);$z++){ 
		echo "categoryArray.push({computationItemsId:".$data[$z]['computationItemsId'].",total_exams:".$data[$z]['total_exams']."});
	";
	}
	?>
	for(i=0;i<categoryArray.length;i++){
		for(z=0;z<categoryArray[i]['total_exams'];z++){
			$.ajax({
				type:"POST",
				url:window.location,
				async:false,
				data:{
					type:"saveGrade",
					classMasterId:'<?= $classMasterId ?>',
					subjectId:'<?= $subjectId ?>',
					quarter:'<?= $quarter ?>',
					columnNumber:z,
					computationItemsId:categoryArray[i]['computationItemsId'],
					score:$('#studentId'+studentId+"_itemsId"+categoryArray[i]['computationItemsId']+"_exam"+z).val(),
					studentId:studentId,
					rowActive:i,
				},
				success:function(data){
					console.log(data);
				}
			});
		}
		if(i== (categoryArray.length-1)){
			alert('Saved!');
		}
	}
	/*
	var total=0;
	var totalItems=0;
	for(i=0;i<totalExams;i++){
		total+=parseInt($('#studentId'+studentId+'_itemsId'+computationItemsId+'_exam'+i).val() || 0); 
		totalItems+=parseInt($("#totalItems_"+computationItemsId+'_'+i).val() || 0);
	}
	total=(total/(totalItems))*100;
	document.getElementById('computationItemsId'+computationItemsId+'_studentId'+studentId).innerHTML=total;
	*/
}
</script>
	<script src="js/app.js"></script>
</body>

</html>
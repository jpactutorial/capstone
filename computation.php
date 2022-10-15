<?php
$page="Computation";
$manage="yes";
include_once("common.php");
$jpac=new JpacObject();

$userData=isset($_SESSION['userData']) ? $_SESSION['userData'] : [] ;

$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
if($type == "addCategoryMaster"){
	$dataInsert['description']=$_REQUEST['description'];
	$dataInsert['percentage']=$_REQUEST['percentage'];
	$dataInsert['datecreated']=date("Y-m-d H:i:s");
	$dataInsert['dateupdated']=date("Y-m-d H:i:s");
	$dataInsert['status']=$_REQUEST['status'];;
	$dataInsert['userId']=$userData[0]['userId'];
	$id=$jpac->SQLInsert('category_master',$dataInsert);
	if($id>0){
		echo "Success";
	}else{
		echo "Something went wrong please contact the developer!";
	}
	exit;
}
if($type == "editCategoryMaster"){
	$dateUpdate['description']=$_REQUEST['description'];
	$dateUpdate['percentage']=$_REQUEST['percentage'];
	$dateUpdate['dateupdated']=date("Y-m-d H:i:s");
	$dateUpdate['status']=$_REQUEST['status'];;
	$dateUpdate['userId']=$userData[0]['userId'];
	$id=$jpac->SQLUpdate('category_master',$dateUpdate," WHERE categoryId='".$_REQUEST['categoryId']."'");
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

					<h1 class="h3 mb-3">Category Master Lists</h1>

					<div class="row">
                        <div class="card">
                            <div class="card-header text-right">
                                <button class="btn btn-primary" onclick="showModalCategory('addCategoryMaster')"  data-toggle="modal" data-target="#categoryMaster">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
                            </div>
							<div class="modal fade" id="categoryMaster" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Category Master</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form onsubmit="categoryAction();" id="form_category" name="form_category">
										
										<div class="modal-body m-3">
												<input type="hidden" id="categorytype" name="categorytype">
												<input type="hidden" id="categoryId" name="categoryId">
												<div class="mb-3">
													<label class="form-label">Description</label>
													<input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
												</div>
												<div class="mb-3">
													<label class="form-label">Percentage</label>
													<input type="number" id="percentage" name="percentage" class="form-control" placeholder="Percentage" required>
												</div>
												<div class="mb-3">
													<label class="form-label">Status</label>
													<select class="form-select" id="status" name ="status"value="Active">
														<option>Active</option>
														<option>Inactive</option>
														<option>Deleted</option>
													</select>
												</div>
												<div class="mb-3">
													<label class="form-check m-0">
													<input type="checkbox" class="form-check-input" required>
													<span class="form-check-label">Confirm</span>
													</label>
												</div>
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
								function categoryAction(){
									event.preventDefault();
									$.ajax({
										type:"POST",
										url:window.location,
										data:{
											type:$('#categorytype').val(),
											description:$('#description').val(),
											percentage:$('#percentage').val(),
											status:$('#status').val(),
											categoryId:$('#categoryId').val()
										},
										success:function(data){
											if(data=="Success"){
												alert(data);
												window.location.reload();
											}else{
												alert(data);
											}
										}
									});
								}
								function showModalCategory(action,id=0,description='',percentage='',status=''){
									$('#categorytype').val(action);
									$('#categoryId').val(id);
									$('#description').val(description);
									$('#percentage').val(percentage);
									$('#status').val(status);
								}
							</script>
                            <div class="card-body">
                            <table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Description</th>
											<th>Percentage</th>
											<th>Items</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        $categoryData=$jpac->SQLQuery("SELECT * FROM category_master WHERE userId='".$userData[0]['userId']."'");
                                        for($i=0;$i<count($categoryData);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $categoryData[$i]['description'] ?></td>
											<td><?= $categoryData[$i]['percentage'] ?></td>
											<td><?= 0 ?></td>
											<td><?= $categoryData[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#categoryMaster" onclick="showModalCategory('editCategoryMaster','<?= $categoryData[$i]['categoryId'] ?>','<?= $categoryData[$i]['description'] ?>','<?= $categoryData[$i]['percentage'] ?>','<?= $categoryData[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
												<a href="#"><i class="align-middle" data-feather="trash"></i></a>
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
                            </div>
                        </div>

					</div>

					<h1 class="h3 mb-3">Category Items</h1>

					<div class="row">
                        <div class="card">
                            <div class="card-header text-right">
                                <button class="btn btn-primary" onclick="showModalCategoryItems('addCategoryItems')"  data-toggle="modal" data-target="#categoryItems">Add <i class="align-middle" data-feather="plus-circle"></i> </button>
                            </div>
							<div class="modal fade" id="categoryItems" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Category Items</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form onsubmit="categoryItemsAction();" id="form_categoryItems" name="form_categoryItems">
										
										<div class="modal-body m-3">
												<input type="hidden" id="categoryItemstype" name="categoryItemstype">
												<input type="hidden" id="categoryItemsId" name="categoryItemsId">
												<div class="mb-3">
													<label class="form-label">Description</label>
													<input type="text" id="descriptionItems" name="descriptionItems" class="form-control" placeholder="Description" required>
												</div>
												<div class="mb-3">
													<label class="form-label">Percentage</label>
													<input type="number" id="percentageItems" name="percentageItems" class="form-control" placeholder="Percentage" required>
												</div>
												<div class="mb-3">
													<label class="form-label">Category Master</label>
													<select class="form-select" id="categoryId_selected" name ="categoryId_selected" value="" required>
														<option></option>
														<?php for($i=0;$i<count($categoryData);$i++){ ?>
														<option value="<?= $categoryData[$i]['categoryId'] ?>"><?= $categoryData[$i]['description'] ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="mb-3">
													<label class="form-label">Status</label>
													<select class="form-select" id="statusItems" name ="statusItems"value="Active">
														<option>Active</option>
														<option>Inactive</option>
														<option>Deleted</option>
													</select>
												</div>
												<div class="mb-3">
													<label class="form-check m-0">
													<input type="checkbox" class="form-check-input" required>
													<span class="form-check-label">Confirm</span>
													</label>
												</div>
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
								function categoryItemsAction(){
									event.preventDefault();
									$.ajax({
										type:"POST",
										url:window.location,
										data:{
											type:$('#categoryItemstype').val(),
											categoryItemsId:$('#categoryItemsId').val(),
											description:$('#descriptionItems').val(),
											percentage:$('#percentageItems').val(),
											status:$('#statusItems').val(),
											categoryId:$('#categoryId_selected').val()
										},
										success:function(data){
											if(data=="Success"){
												alert(data);
												window.location.reload();
											}else{
												alert(data);
											}
										}
									});
								}
								function showModalCategoryItems(action,id=0,description='',percentage='',status='',categoryId_selected=''){
									$('#categoryItemstype').val(action);
									$('#categoryItemsId').val(id);
									$('#descriptionItems').val(description);
									$('#percentageItems').val(percentage);
									$('#statusItems').val(status);
									$('#categoryId_selected').val(categoryId_selected);
								}
							</script>
                            <div class="card-body">
                            <table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Description</th>
											<th>Percentage</th>
											<th>Category</th>
											<th>Items</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        $categoryItemsData=$jpac->SQLQuery("SELECT * FROM category_items WHERE userId='".$userData[0]['userId']."'");
                                        for($i=0;$i<count($categoryItemsData);$i++){
                                        ?>
										<tr>
											<td><?= ($i+1) ?></td>
											<td><?= $categoryItemsData[$i]['description'] ?></td>
											<td><?= $categoryItemsData[$i]['percentage'] ?></td>
											<td><?= 0 ?></td>
											<td><?= $categoryItemsData[$i]['status'] ?></td>
											<td class="table-action">
												<a href="#" data-toggle="modal" data-target="#categoryItems" onclick="showModalCategoryItems('editCategoryItems','<?= $categoryData[$i]['categoryId'] ?>','<?= $categoryData[$i]['description'] ?>','<?= $categoryData[$i]['percentage'] ?>','<?= $categoryData[$i]['status'] ?>')"><i class="align-middle" data-feather="edit-2"></i></a>
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

	<script src="js/app.js"></script>
</body>

</html>
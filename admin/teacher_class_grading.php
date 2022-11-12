<?php
$page="Teacher Student List";
$manage="yes";
include_once("../common.php");
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
        body{
            overflow: auto;
        }
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
    <h1 class="h3 mb-3">Grade: <?= $subjectClassLists[0]['grade']." - ".$subjectClassLists[0]['section'] ?> -> Student List(s)</h1>

<div class="row" style="overflow: auto;
  width: 100%;
  height: 100%;">
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
                        echo json_encode($computationMaster);
                        for($i=0;$i<count($data);$i++){ ?> 
                            <th colspan="<?= ($data[$i]['total_exams']+1) ?>" style="text-align:center;border:1px solid black"><?= $data[$i]['description']." - ".$data[$i]['percentage']."%" ?></th>
                        <?php  
                        } ?>
                        <th></th>
                        <th></th>
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
                        $lastColumn=0;
                        for($i=0;$i<count($data);$i++){ 
                            for($n=0;$n<$data[$i]['total_exams'];$n++){ 
                                $lastColumn++;
                                $objectName="totalItems_".$data[$i]['computationItemsId'].'_'.$n;
                                $checkExists=$jpac->SQLQuery("SELECT * FROM class_total_items WHERE classMasterId='".$classMasterId."' and subjectId='".$subjectId."' and quarter='".$quarter."' and columnNumber='".$n."' and computationItemsId='".$data[$i]['computationItemsId']."'");
                                $totalItemsArray[]=array("computationItemsId"=>$data[$i]['computationItemsId'],"columnNumber"=>$n,"totalItems"=>(count($checkExists)>0 ? (int)$checkExists[0]['totalItems']: 0 ));
                                ?>
                            <th><input type="text" name="<?= $objectName ?>" id="<?= $objectName ?>" value="<?= (count($checkExists)>0 ? $checkExists[0]['totalItems'] : 0 ) ?>" style="width:<?= $thWidth ?>px"></th>
                        <?php } echo '<th>
                                    <div class="mb-2">
                                        <button onclick="saveTotalItems('.$data[$i]['computationItemsId'].','.$data[$i]['total_exams'].')"class="btn btn-primary align-middle mr-2" data-feather="save" style="cursor:pointer">Save</button> 
                                    </div>
                                    </th>';
                        } 
                        $lastColumn=($lastColumn+count($data))+1;
                        ?>
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
                        $col=0;
                        $categoryCount=1;
                        for($z=0;$z<count($data);$z++){ 
                            $categoryCount=($categoryCount+$data[$z]['total_exams']);
                            $totalGetValue=0;
                            $totalTest=0;
                            for($a=0;$a<count($totalItemsArray);$a++){
                                if($totalItemsArray[$a]['computationItemsId']==$data[$z]['computationItemsId']){
                                    $totalTest+=$totalItemsArray[$a]['totalItems'];
                                }
                            }
                            for($n=0;$n<$data[$z]['total_exams'];$n++){ 
                                $col++;
                                $sqlcheck="SELECT * FROM class_grade WHERE classMasterId='".$classMasterId."' and subjectId='".$subjectId."' and quarter='".$quarter."' and columnNumber='".$n."' and computationItemsId='".$data[$z]['computationItemsId']."' and studentId='".$result[$i]['studentId']."'";
                                $gradeValue=0;	
                                $getValue=$jpac->SQLQuery($sqlcheck);
                                if(count($getValue)>0){$gradeValue=$getValue[0]['grade_score'];}
                                $totalGetValue=$totalGetValue+$gradeValue;
                                ?>
                                <td>	
                                    <div class="col-12">
                                        <input type="text" id="row<?= ($i+1)."_".($col) ?>" oninput="autoCompute('<?= ($i+1) ?>','<?= ($n+1) ?>','<?= $categoryCount ?>','<?= $data[$z]['total_exams'] ?>','<?= $totalTest ?>','<?= $lastColumn ?>')" class="form-control mb-2 " value="<?= $gradeValue ?>"   style="width:<?= $thWidth ?>px">
                                    </div>
                                </td>
                        <?php }
                            $col++;
                            $itemsTotalGrade=0;
                            if($totalTest>0){$itemsTotalGrade=round(($totalGetValue/$totalTest)*100,2);}
                            $finalGrade+= $itemsTotalGrade*($data[$z]['percentage']*.01);
                            echo '<td id="row'.($i+1)."_".($categoryCount).'">'.$itemsTotalGrade.'</td>';
                            $categoryCount++;
                        } ?>
                        <td id="row<?= ($i+1)."_".$lastColumn ?>"><?= $finalGrade ?></td>
                        <td>
                            <div class="mb-2">
                                <button class="btn btn-danger align-middle mr-2"onclick= "saveRow('<?= $result[$i]['studentId'] ?>')" data-feather="save" style="cursor:pointer">Save</button> 
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
  
    </div>

</main>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<script>
$(document).ready(function() {
    $('#usersTable').DataTable();
});
function autoCompute(row,col,total,totalExams,totalTest,finalColumn){
    var totalGrade=0;
    for(i=(total-totalExams);i<total;i++){
        totalGrade=totalGrade+parseInt($('#row'+row+'_'+i).val());        
    }
    console.log(finalColumn);
    var finalGrade=((totalGrade/totalTest)*100).toFixed(2);;
    $('#row'+row+'_'+total).html(finalGrade);
    $('#row'+row+'_'+finalColumn).html(finalGrade);
}
</script>

    <script src="js/bootstrap.bundle.min.js"></script>

      <script src="sidebars/sidebars.js"></script>
  </body>
</html>

<?php
$page="Dashboard";
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

<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
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
    <div class="b-example-divider b-example-vr" style="width:1px;">
    
    </div>

    <div class="container-fluid p-0" style="margin:20px;">
    
    <h1 class="h3 mb-3">Dashboard</h1>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    <script>
<?php
  $sql="SELECT SUM(CASE WHEN gender='Male' THEN 1 ELSE 0 END) as MaleCount, SUM(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as FemaleCount  FROM `user` WHERE role='Student'";
  $count=$jpac->SQLQuery($sql);
?>
    var xValues = ["GIRLS", "BOYS"];
    var yValues = [<?= $count[0]['FemaleCount'] ?>,<?= $count[0]['MaleCount'] ?>];
    var barColors = [
        "#b91d47",
        "#2b5797",
        ];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "Students"
            }
        }
    });
    </script>
    <br/><br/>
    <canvas id="gradeChart" style="width:100%;max-width:600px"></canvas>

    <script>
<?php
$sql="SELECT t0.classMasterId,t0.grade,(SELECT COUNT(*) FROM class WHERE classMasterId=t0.classMasterId) as TotalStudents FROM `classes_master_data` t0";
$data=$jpac->SQLQuery($sql);
$label=array();
$studentCount=array();
for($i=0;$i<count($data);$i++){
  array_push($label,'"'.$data[$i]['grade'].'"');
  array_push($studentCount,'"'.$data[$i]['TotalStudents'].'"');
}
?>
    var xValues = [<?= implode(',',$label) ?>];
    var yValues = [<?= implode(',',$studentCount) ?>];
    var barColors = ["red", "green","blue","orange","brown","violet"];

    new Chart("gradeChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Grade Chart"
        }
    }
    });
    </script>
    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="sidebars/sidebars.js"></script>
</body>
</html>

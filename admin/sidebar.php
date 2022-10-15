<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">

      <span class="fs-4">Class Record System</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="index.php" class="nav-link <?php if($page=="Dashboard") { echo 'active'; }else{ echo 'text-white';}?>" aria-current="page">
        <i class="fa fa-database"></i>&nbsp;
            Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="subject_master_data.php" class="nav-link <?php if($page=="Subjects Master Data" || $page=="Teacher Subjects") { echo 'active'; }else{ echo 'text-white';}?>" aria-current="page">
        <i class="fa fa-database"></i>&nbsp;
            Subject Master Data
        </a>
      </li>
      <?php if($userData[0]['role']=="Teacher"){ ?><li>
        <a href="teacher_computation.php" class="nav-link <?php if($page=="Teacher Computation") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-newspaper-o"></i>&nbsp;
          Computation
        </a>
      </li>
      <li>
        <a href="teacher_subject_class.php" class="nav-link <?php if($page=="Teacher Subject Classes") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-newspaper-o"></i>&nbsp;
          Subject Classes
        </a>
      </li>
      <li>
        <a href="teacher_student_list.php" class="nav-link <?php if($page=="Teacher Student List") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-newspaper-o"></i>&nbsp;
          Students
        </a>
      </li>
      <?php }else{ ?>
      <li>
        <a href="subject_action.php" class="nav-link <?php if($page=="Subjects") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-newspaper-o"></i>&nbsp;
          Subject Assign
        </a>
      </li>
      <li>
        <a href="classes_action.php" class="nav-link <?php if($page=="Classes Master Data") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-sign-out"></i>&nbsp;
          Classess Master Data
        </a>
      </li>
      <li>
        <a href="classes.php" class="nav-link <?php if($page=="Classes") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-sign-out"></i>&nbsp;
          Classes
        </a>
      </li>
      <li>
        <a href="users.php" class="nav-link <?php if($page=="Users") { echo 'active'; }else{ echo 'text-white';}?>">
        <i class="fa fa-users"></i>&nbsp;
          Users
        </a>
      </li>
      <?php } ?>
      <li>
        <a href="logout.php" class="nav-link text-white">
        <i class="fa fa-sign-out"></i>&nbsp;
          Sign Out
        </a>
      </li>
    </ul>
    <hr>
  </div>

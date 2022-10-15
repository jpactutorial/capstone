<?php
if(count($userData)>0){

}else{
    header("Location: signin.php");
}
?>
<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Class Record</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item <?php if(strtolower($page)=="profile") echo "active"; ?>">
                <a class="sidebar-link" href="<?= link_profile ?>">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">List of Schedule</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-target="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Manage</span>
                </a>
                
                <?php if($userData[0]['role']=="Admin") { ?>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse <?php if(strtolower($manage) == "yes") echo "show";  ?>" data-parent="#sidebar">
                    <?php if($userData[0]['role']=="Teacher") { ?>
                        <li class="sidebar-item <?php if(strtolower($page) == "computation") echo "active"; ?>"><a class="sidebar-link" href="computation.php">Computation Table</a></li>
                    <?php } ?>
                    <?php if($userData[0]['role']=="Admin") { ?>
                        <li class="sidebar-item <?php if(strtolower($page) == "subjects master data") echo "active"; ?>"><a class="sidebar-link" href="subject_master_data_action.php">Subjects Master Data</a></li>
                        <li class="sidebar-item <?php if(strtolower($page) == "subjects") echo "active"; ?>"><a class="sidebar-link" href="subject_action.php">Subjects Assign</a></li>
                        <!--<li class="sidebar-item"><a class="sidebar-link" href="#">Courses</a></li> 
                        <li class="sidebar-item"><a class="sidebar-link" href="#">Class Schedules</a></li>-->
                    <?php } ?>
                    <li class="sidebar-item <?php if(strtolower($page) == "classes master data") echo "active"; ?>"><a class="sidebar-link" href="classes_action.php">Classes Master Data</a></li>
                    <li class="sidebar-item <?php if(strtolower($page) == "classes") echo "active"; ?>"><a class="sidebar-link" href="classes.php">Classes</a></li>
                    <!--<li class="sidebar-item"><a class="sidebar-link" href="#">Quizzes</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Leave Message</a></li>-->
                    <?php if($userData[0]['role']=="Admin") { ?>
                        <li class="sidebar-item <?php if(strtolower($page) == "users") echo "active"; ?>"><a class="sidebar-link" href="users.php">Users</a></li> 
                    <?php } ?>
                </ul>
                <?php } ?>

                <?php if($userData[0]['role']=="Teacher") { ?>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse <?php if(strtolower($manage) == "yes") echo "show";  ?>" data-parent="#sidebar">
                    <li class="sidebar-item <?php if(strtolower($page) == "teacher subjects") echo "active"; ?>"><a class="sidebar-link" href="teacher_subject.php">Subjects Master Data</a></li>    
                    <li class="sidebar-item <?php if(strtolower($page) == "teacher computation") echo "active"; ?>"><a class="sidebar-link" href="teacher_computation.php">Computation</a></li>
                    <li class="sidebar-item <?php if(strtolower($page) == "teacher subject classes") echo "active"; ?>"><a class="sidebar-link" href="teacher_subject_class.php">Subject Classes</a></li>   
                    <li class="sidebar-item <?php if(strtolower($page) == "teacher student list") echo "active"; ?>"><a class="sidebar-link" href="teacher_student_list.php">Students</a></li>     
                </ul>
                <?php } ?>
            </li>
            <!--
            <?php if($userData[0]['role']=="Student"){ ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="inbox"></i> <span class="align-middle">Inbox</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Create Message</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="search"></i> <span class="align-middle">View Grades</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="paperclip"></i> <span class="align-middle">Take Exam</span>
                </a>
            </li>
            <?php } ?>
            <?php if($userData[0]['role']!="Student") { ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?= link_reports ?>">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Reports</span>
                </a>
            </li>
            <?php } ?>
            -->
        </ul>
    </div>
</nav>

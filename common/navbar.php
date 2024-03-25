<?php
session_start();
$userEmail = $_SESSION['userEmail'];
$userRole = $_SESSION['userRole'];

// Check if the form has been submitted
if (isset($_POST['logOut'])) {

    session_start();
    session_unset();
    session_destroy();

    header("Location: ../page/logIn.php");
    exit();
}

?>
<header class="">
    <div class="navbar bg-blue-500">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 text-xl font-semibold">
                    <li><a href="../page/home.php">Home</a></li>
                    <li>
                        <?php
if ($userRole == 'teacher') {?>
                            <a href="../page/findTuition.php">Find Tuition</a>
                    </li>
                    <li>
                        <a href="../page/publishTeacherGig.php">Publish Gig</a>
                    </li>
                     <li>
                    <a href="../page/teacherDashboard.php">My Dashboard</a>
                    </li>
                    <?php
} else if ($userRole == "student") {?>
                    <li>
                        <a href="../page/findTutors.php">Find Tutors</a>
                    </li>
                    <li>
                        <a href="../page/publishStudentGig.php">Publish Gig</a>
                    </li>
                    <li>
                    <a href="../page/studentDashboard.php">My Dashboard</a>
                    </li>
                    <?php
} else if($userRole == "admin") {?>

                    <li>
                    <a href="../page/adminDashboard.php">My Dashboard</a>
                    </li>
<?php

}?>



                </ul>
            </div>
            <a class="btn btn-ghost normal-case text-xl">Genious Guide</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 text-xl font-semibold">
                <li><a href="../page/home.php">Home</a></li>
                <li>
                    <?php
if ($userRole == 'teacher') {?>
                        <a href="../page/findTuition.php">Find Tuition</a>
                </li>
                <li>
                    <a href="../page/publishTeacherGig.php">Publish Gig</a>
                </li>
                <li>
                    <a href="../page/teacherDashboard.php">My Dashboard</a>
                </li>

            <?php
} else if ($userRole == "student") {?>
                <li>
                    <a href="../page/findTutors.php">Find Tutors</a>
                </li>
                <li>
                    <a href="../page/publishStudentGig.php">Publish Gig</a>
                </li>
                <li>
                    <a href="../page/studentDashboard.php">My Dashboard</a>
                </li>
            <?php
}
else if($userRole == "admin") {?>

                    <li>
                    <a href="../page/adminDashboard.php">My Dashboard</a>
                    </li>
                    <li>
                    <a href="../page/generateReport.php">Generate Report</a>
                    </li>
<?php

}?>

            </ul>
        </div>
        <div class="navbar-end">

            <?php
// session_start();

if ($_SESSION['userEmail']) {
    echo $_SESSION['userRole'];
    // echo $_SESSION['userEmail'];
    // echo $_SESSION['userID'];

    ?>
                <form action="" method="POST"><button class="btn bg-blue-600 btn-primary" name="logOut" type="submit" onclick="logOut()">Log Out</button></form>


            <?php
} else {
    ?>
                <a class="btn btn-primary" href="../page/register.php">Log In</a>

            <?php
}

?>
            <!-- <a class="btn" href="../page/register.php">Register</a> -->
        </div>
    </div>
</header>
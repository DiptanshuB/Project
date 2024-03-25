<?php
include '../common/header.html';
include '../common/navbar.php';
include '../common/OOP.php';

$allQueryFunction = new AllQueryFunction();

$studentEmail = $_SESSION['userEmail'];
$userID = $_SESSION['userID'];

$allTeacherRequest = $allQueryFunction->allTeacherRequest();
$allStudentRequest = $allQueryFunction->allStudentRequest();

// ------------------ handle accept
if (isset($_POST['approve'])) {

    $table = 'Advertise';
    $updatedColumn = 'admin_approval';
    $value = 'approved';
    $field = 'advertise_id';
    $fieldValue = $_POST['advertiseID'];

    // echo $fieldValue;

    $updateSingleValue = $allQueryFunction->updateSingleValue($table, $updatedColumn, $value, $field, $fieldValue);

    header('location:../page/adminDashboard.php');

}
// ------------------ handle delete
if (isset($_POST['delete'])) {

    $table = 'Advertise';
    $field = 'advertise_id';
    $fieldValue = $_POST['advertiseID'];

    echo $fieldValue;

    // after clicking delete button the specific request will deleted from the advertise table
    $deleteSingleValue = $allQueryFunction->deleteSingleValue($table, $field, $fieldValue);
    header('location:../page/adminDashboard.php');

    // echo $table. $field. $fieldValue;
}

?>



<!--------------------------- HTML part start here -------------->
<div>

    <!----------- Request from teacher--------------->

    <div>
        <h1 class='text-3xl text-center font-bold my-6'>Request from teacher</h1>
        <div>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10'>
                <?php
if (mysqli_num_rows($allTeacherRequest) != 0) {

    while ($row = mysqli_fetch_assoc($allTeacherRequest)) {
        ?>
                        <div class='card card-side bg-base-100 shadow-xl'>
                            <figure><img src='../person.jpg' alt='student' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>
                                    <div>

                                        <h2 class='card-title' name='email'><?php echo $allQueryFunction->fetchSingleValue('Students', 'name', 'email', $row['email']) ?></h2>
                                    </div>

                                    <p><span class="font-semibold text-lg">Subject : </span><?php echo $row['subject'] ?></p>
                                    <p><span class="font-semibold text-lg">Weekly : </span><?php echo $row['weekly'] ?></p>
                                    <p><span class="font-semibold text-lg">Hour : </span><?php echo $row['hour'] ?></p>
                                    <p><span class="font-semibold text-lg">Type : </span><?php echo $row['tuition_type'] ?></p>
                                    <p><span class="font-semibold text-lg">Salary : </span><?php echo $row['salary'] ?></p>
                                    <div class='card-actions justify-end'>
                                        <input class='hidden' type='text' name='advertiseID' value="<?php echo $row['advertise_id'] ?>">
                                        <button class='btn bg-blue-500 ' name='approve'>Approve</button>
                                        <button class='btn btn-warning ' name='delete'>Delete</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                <?php

    }
} else {
    echo 'No request from teacher available right now.';
}

?>
            </div>
        </div>
    </div>

    <!----------- Request from Student--------------->
    <div>
        <h1 class='text-3xl text-center font-bold my-6'>Request from student</h1>
        <div>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10'>
                <?php
if (mysqli_num_rows($allStudentRequest) != 0) {

    // echo  mysqli_num_rows( $result );

    while ($row = mysqli_fetch_assoc($allStudentRequest)) {
        // Process and display the data
        // echo '<br>' . $row[ 'password' ] . '<br>';
        ?>
                        <div class='card card-side bg-base-100 shadow-xl'>
                            <figure><img src='../student.jpg' alt='student' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>
                                    <div>

                                        <h2 class='card-title' name='email'><?php echo $allQueryFunction->fetchSingleValue('Students', 'name', 'email', $row['email']) ?>
</h2>
                                    </div>
                                    <p><span class="font-semibold text-lg"></span>Subject :
<?php echo $row['subject'] ?></p>
                                    <p><span class="font-semibold text-lg"></span>Weekly :
<?php echo $row['weekly'] ?></p>
                                    <p><span class="font-semibold text-lg"></span>Hour :
<?php echo $row['hour'] ?></p>
                                    <p><span class="font-semibold text-lg"></span>Type :
<?php echo $row['tuition_type'] ?></p>
                                    <p><span class="font-semibold text-lg"></span>Salary :
<?php echo $row['salary'] ?></p>
                                    <div class='card-actions justify-end'>
                                        <input class='hidden' type='text' name='advertiseID' value="<?php echo $row['advertise_id'] ?>">
                                        <button class='btn bg-blue-500 ' name='approve'>Approve</button>
                                        <button class='btn btn-warning ' name='delete'>Delete</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                <?php

    }
} else {
    echo 'No request from student available right now.';
}

?>
            </div>
        </div>
    </div>

</div>

<?php
include '../common/footer.php';
?>

<?php
include '../common/footer.html'

?>
<?php
include '../common/header.html';
include '../common/navbar.php';
include '../common/OOP.php';

$allQueryFunction = new AllQueryFunction();

$studentEmail = $_SESSION['userEmail'];
$userID = $_SESSION['userID'];

$myAllAdvertise = $allQueryFunction->myAdvertise($userEmail);
$responseToMyAdvertise = $allQueryFunction->responseToMyAdvertise($userEmail);

// ------------------ handle accept
if (isset($_POST['accept'])) {

    $table = 'Advertise';
    $updatedColumn = 'status';
    $value = 'unavailable';
    $field = 'advertise_id';
    $fieldValue = $_POST['advertiseID'];
    $teacherEmail = $_POST['teacherEmail'];
    $startDate = date("d-m-Y");
    $advertiseID = $_POST['advertiseID'];
    $teachingSubject = $_POST['teachingSubject'];
    // echo $advertiseID . $teachingSubject;

    // when a student accept a teacher it update the value of status in advertising table to unavailable
    $updateSingleValue = $allQueryFunction->updateSingleValue($table, $updatedColumn, $value, $field, $fieldValue);

    // find teacher ID
    $ID = "";

    $getTeacherID = $allQueryFunction->findUser($teacherEmail, $ID);

    if (mysqli_num_rows($getTeacherID) != 0) {
        while ($row = mysqli_fetch_assoc($getTeacherID)) {
            $teacherID = $row['student_id'];
        }
    }
    // find student ID
    $getStudentID = $allQueryFunction->findUser($studentEmail, $ID);

    if (mysqli_num_rows($getStudentID) != 0) {
        while ($row = mysqli_fetch_assoc($getStudentID)) {
            $studentID = $row['student_id'];
        }
    }
    // echo $teacherEmail . $studentEmail . $teacherID ."  st".  $studentID;

    // insert to teaching table
    $acceptRequest = $allQueryFunction->acceptRequest($teacherID, $studentID, $teachingSubject, $advertiseID, $startDate);
    $deletedTable = 'Apply';
    $deletedField = 'apply_id';
    $deletedFieldValue = $_POST['applyID'];
    //  the specific request will deleted from the apply table
    $deleteSingleValue = $allQueryFunction->deleteSingleValue($deletedTable, $deletedField, $deletedFieldValue);
    header('location:../page/studentDashboard.php');

}
// ------------------ handle delete
if (isset($_POST['delete'])) {

    $table = 'Apply';
    $field = 'apply_id';
    $fieldValue = $_POST['applyID'];
    // after clicking delete button the specific request will deleted from the apply table
    $deleteSingleValue = $allQueryFunction->deleteSingleValue($table, $field, $fieldValue);
    header('location:../page/studentDashboard.php');

    // echo $table. $field. $fieldValue;
}

// ------------------ handle complete
if (isset($_POST['complete'])) {
    $teacher_rating = $_POST['rating'];
    $finish_date = $_POST['finishDate'];
    $teaching_id = $_POST['teachingID'];
    $teacher_feedback = $_POST['feedback'];
    if ($finish_date == '') {
        $finish_date = date("d-m-Y");

    }

    $studentClickComplete = $allQueryFunction->studentClickComplete($teaching_id, $finish_date, $teacher_rating, $teacher_feedback);
    header('location:../page/studentDashboard.php');

    // echo $finish_date . ' ' . $teaching_id . ' ' . $teacher_feedback . ' ' . $teacher_rating;
}

// -------------- my all teaching
$myCurrentTeacher = $allQueryFunction->myCurrentTeaching("student_id", $userID);

?>



<!--------------------------- HTML part start here -------------->
<div>

     <!----------- My  ALL Gig--------------->

    <div>
        <h1 class='text-3xl text-center font-bold my-6'>My All Publishes</h1>
        <div>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10'>
                <?php
if (mysqli_num_rows($myAllAdvertise) != 0) {

    // echo  mysqli_num_rows( $result );

    while ($row = mysqli_fetch_assoc($myAllAdvertise)) {
        // Process and display the data
        // echo '<br>' . $row[ 'password' ] . '<br>';
        ?>
                        <div class='card card-side bg-base-100 shadow-xl'>
                            <figure><img src='../student.jpg' alt='student' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>
                                    <div>
                                        <h2 class='card-title'>Subject : <?php echo $row['subject'] ?></h2>
                                    </div>
                                    <p><span class="font-semibold text-lg">Weekly : </span><?php echo $row['weekly'] ?></p>
                                    <p><span class="font-semibold text-lg">Hour : </span><?php echo $row['hour'] ?></p>
                                    <p><span class="font-semibold text-lg">Type : </span><?php echo $row['tuition_type'] ?></p>
                                    <p><span class="font-semibold text-lg">Salary : </span><?php echo $row['salary'] ?></p>
                                    <p><span class="font-semibold text-lg">Status : </span><?php echo ($row['admin_approval'] == '') ? 'Waiting for admin approval' : $row['status'] ?></p>
                                    <div class='card-actions justify-end'>

                                        <button class='btn bg-blue-500 ' name=''>Edit</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                <?php

    }
} else {
    echo 'No GIG available right now.';
}

?>
            </div>
        </div>
    </div>

     <!----------- Response To My Gig--------------->

    <div>
        <h1 class='text-3xl text-center font-bold my-6'>Response To My Publishes</h1>
        <div>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10'>
                <?php
if (mysqli_num_rows($responseToMyAdvertise) != 0) {

    // echo  mysqli_num_rows( $result );

    while ($row = mysqli_fetch_assoc($responseToMyAdvertise)) {
        // Process and display the data
        // echo '<br>' . $row[ 'password' ] . '<br>';
        ?>
                        <div class='card card-side bg-base-100 shadow-xl'>
                            <figure><img src='../person.jpg' alt='Teacher' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>

                                    <p class='card-title'>Subject : <?php echo $row['subject'] ?></p>

                                    <p>Interested Teacher : <?php echo $row['requester_email'] ?></p>

                                    <div class='card-actions justify-end'>

                                        <form method='post'>
                                            <input class='hidden' type='text' name='advertiseID' value="<?php echo $row['advertise_id'] ?>">

                                              <input class='hidden' type='text' name='teacherEmail' value="<?php echo $row['requester_email'] ?>">

                                               <input class='hidden' type='text' name='applyID' value="<?php echo $row['apply_id'] ?>">
                                               <input class='hidden' type='text' name='teachingSubject' value="<?php echo $row['subject'] ?>">

                                            <button class='btn bg-blue-500 ' name='accept' type='submit'>Accept</button>
                                        </form>

                                        <form method='post'>
                                            <input class='hidden' type='text' name='applyID' value="<?php echo $row['apply_id'] ?>">

                                            <button class='btn btn-danger ' name='delete' type='submit'>Delete</button>
                                        </form>


                                    </div>
                                </div>
                            </form>

                        </div>
                <?php

    }
} else {
    echo 'No One is interested Yet.';
}

?>
            </div>
        </div>

    </div>

        <!----------- My current Teacher--------------->

    <div>
        <h1 class='text-3xl text-center font-bold my-6'>My current Teacher</h1>
                <div>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10'>
                <?php
if (mysqli_num_rows($myCurrentTeacher) != 0) {

    // echo  mysqli_num_rows( $result );

    while ($row = mysqli_fetch_assoc($myCurrentTeacher)) {
        // Process and display the data
        // echo '<br>' . $row[ 'password' ] . '<br>';

        $tableName = "Students";
        $rowName = "name";
        $searchField = "student_id";
        $searchValue = $row['teacher_id'];

        $teacherName = $allQueryFunction->fetchSingleValue($tableName, $rowName, $searchField, $searchValue);

        ?>
                        <div class='card card-side bg-base-100 shadow-xl'>
                            <figure><img src='../person.jpg' alt='Teacher' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>

                                    <p class='card-title'>Subject : <?php echo $row['subject'] ?></p>
                                    <p><span class="font-semibold text-lg">Teacher  : </span>
<?php echo $teacherName ?></p>
                                    <p><span class="font-semibold text-lg">Start Date : </span>
<?php echo $row['start_date'] ?></p>
                                    <p><span class="font-semibold text-lg">Finish Date : </span>
<?php echo ($row['finish_date'] == '') ? 'Still Teaching' : $row['finish_date'] ?></p>
                                    <p><span class="font-semibold text-lg">Teacher Gave Ratings: </span>
<?php echo ($row['student_rating'] == 0) ? 'Not Yet given' : $row['student_rating'] ?> <span class="text-xl text-yellow-400">★</span> ratings</p>
                                    <p><span class="font-semibold text-lg">Teacher Feedback  : </span>
<?php echo ($row['student_feedback'] == '') ? 'Not yet Given' : $row['student_feedback'] ?></p>

                                     <form method='post'>
                                            <input class='hidden' type='text' name='teachingID' value="<?php echo $row['teaching_id'] ?>">
                                            <input class='hidden' type='text' name='finishDate' value="<?php echo $row['finish_date'] ?>">

                                              <input class='input border-2 border-blue-300 mr-4' type='text' name='feedback' placeholder='<?php echo ($row['teacher_feedback'] == '') ? 'Give Teacher a Feedback' : $row['teacher_feedback'] ?>'>

<div class='rating rating-md rating-half'>

                                            <?php
$j = 0;
        for ($i = 0; $i <= 10; $i++, $j += 0.5) {

            if ($i == 0) {
                ?><input type='radio' name='rating' class='bg-orange-500 mask mask-star-2 mask-half-1 hidden' <?php echo ($j == $row['teacher_rating']) ? 'checked' : '';
                ?> value="<?php echo $j; ?>" /><?php

            } else {

                if ($i % 2 == 1) {
                    ?><input type='radio' name='rating' class='bg-orange-500 mask mask-star-2 mask-half-1' <?php echo ($j == $row['teacher_rating']) ? 'checked' : '';
                    ?> value="<?php echo $j; ?>" /><?php
} else {
                    ?><input type='radio' name='rating' class='bg-orange-500 mask mask-star-2 mask-half-2 ' <?php echo ($j == $row['teacher_rating']) ? 'checked' : '';
                    ?> value="<?php echo $j; ?>" /><?php
}
            }
        }

        ?>

                                        </div>
                                            <button class='btn bg-blue-500 ' name='complete' type='submit'>Complete</button>
                                        </form>
                                </div>
                            </form>

                        </div>
                <?php

    }
} else {
    echo 'No teacher YET';
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
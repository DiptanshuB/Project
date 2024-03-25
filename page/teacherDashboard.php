<?php
include '../common/header.html';
include '../common/navbar.php';
include '../common/OOP.php';

$allQueryFunction = new AllQueryFunction();

$teacherEmail = $_SESSION['userEmail'];
$userID = $_SESSION['userID'];
// echo $TeacherEmail.$userID;
$myAllAdvertise = $allQueryFunction->myAdvertise($userEmail);
$responseToMyAdvertise = $allQueryFunction->responseToMyAdvertise($userEmail);

// // ------------------ handle accept
if (isset($_POST['accept'])) {

    $table = 'Advertise';
    $updatedColumn = 'status';
    $value = 'unavailable';
    $field = 'advertise_id';
    $fieldValue = $_POST['advertiseID'];
    $studentEmail = $_POST['studentEmail'];
    $startDate = date('d-m-Y');
    $advertiseID = $_POST['advertiseID'];
    $teachingSubject = $_POST['teachingSubject'];

    // echo $TeacherEmail . $fieldValue . $teachingSubject . $studentEmail;

    // when a teacher accept a student it update the value of 'status' in advertising table to unavailable and this advertise wont showing in the student page

    $updateSingleValue = $allQueryFunction->updateSingleValue($table, $updatedColumn, $value, $field, $fieldValue);

    // find teacher ID
    $ID = '';
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
    echo $teacherEmail . $studentEmail . $teacherID . '  st' . $studentID;

    // insert to teaching table
    $acceptRequest = $allQueryFunction->acceptRequest($teacherID, $studentID, $teachingSubject, $advertiseID, $startDate);
    $deletedTable = 'Apply';
    $deletedField = 'apply_id';
    $deletedFieldValue = $_POST['applyID'];
    //  the specific request will deleted from the apply table
    $deleteSingleValue = $allQueryFunction->deleteSingleValue($deletedTable, $deletedField, $deletedFieldValue);
    header('location:../page/teacherDashboard.php');
}

// ------------------ handle delete
if (isset($_POST['delete'])) {

    $table = 'Apply';
    $field = 'apply_id';
    $fieldValue = $_POST['applyID'];

    // after clicking delete button the specific request will deleted from the apply table
    $deleteSingleValue = $allQueryFunction->deleteSingleValue($table, $field, $fieldValue);
    header('location:../page/teacherDashboard.php');

    // echo $table. $field. $fieldValue;
}

// -------------- my all teaching
$myCurrentStudent = $allQueryFunction->myCurrentTeaching('teacher_id', $userID);

// ------------------ handle complete
if (isset($_POST['complete'])) {
    $student_rating = $_POST['rating'];

    $finish_date = $_POST['finishDate'];
    $teaching_id = $_POST['teachingID'];
    $student_feedback = $_POST['feedback'];

    if ($finish_date == '') {
        $finish_date = date("d-m-Y");
    }

    $teacherClickComplete = $allQueryFunction->teacherClickComplete($teaching_id, $finish_date, $student_rating, $student_feedback);
    header('location:../page/teacherDashboard.php');

    // echo $finish_date . ' ' . $teaching_id . ' ' . $student_feedback . ' ' . $student_rating;
}

?>

<!--------------------------- HTML part start here -------------->
<div>

    <!----------- My  ALL publishes--------------->

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
                            <figure><img src='../person.jpg' alt='teacher' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>
                                    <div>

                                        <h2 class='card-title'>Subject : <?php echo $row['subject'] ?></h2>
                                    </div>
                                    <p><span class="font-semibold text-lg">Weekly : </span><?php echo $row['weekly']  ?> Day</p>
                                    <p><span class="font-semibold text-lg">Hour : </span><?php echo $row['hour'] ?></p>
                                    <p><span class="font-semibold text-lg">Type : </span><?php echo $row['tuition_type'] ?></p>
                                    <p><span class="font-semibold text-lg">Salary : </span><?php echo $row['salary'] ?> TK</p>
                                    <p><span class="font-semibold text-lg">Status : </span><?php echo ($row['admin_approval'] == '') ? 'Waiting for admin approval' :  $row['status'] ?></p>
                                    <div class='flex'>

                                        <button class='btn bg-blue-500 w-36' name=''>Edit</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                <?php

                    }
                } else {
                    echo 'No publishes available right now.';
                }

                ?>
            </div>
        </div>
    </div>

    <!----------- Response To My publishes--------------->

    <div>
        <h1 class='text-3xl text-center font-bold my-6'>Show Interested Students</h1>
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
                            <figure><img src='../student.jpg' alt='Teacher' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>

                                    <p class='card-title'>Subject : <?php echo $row['subject'] ?></p>

                                    <p><span class="font-semibold text-lg">Interested Student : </span><?php echo $allQueryFunction->fetchSingleValue('Students', 'name', 'email', $row['requester_email']) ?></p>

                                    <div class='flex gap-4'>

                                        <form method='post'>
                                            <input class='hidden' type='text' name='advertiseID' value="<?php echo $row['advertise_id'] ?>">

                                            <input class='hidden' type='text' name='studentEmail' value="<?php echo $row['requester_email'] ?>">

                                            <input class='hidden' type='text' name='applyID' value="<?php echo $row['apply_id'] ?>">
                                            <input class='hidden' type='text' name='teachingSubject' value="<?php echo $row['subject'] ?>">

                                            <button class='btn bg-blue-500 ' name='accept' type='submit'>Accept</button>
                                        </form>

                                        <form method='post'>
                                            <input class='hidden' type='text' name='applyID' value="<?php echo $row['apply_id'] ?>">

                                            <button class='btn bg-red-800 ' name='delete' type='submit'>Delete</button>
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

    <!----------- My current Student--------------->

    <div>
        <h1 class='text-3xl text-center font-bold my-6 '>My current Student</h1>
        <div>
            <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-10'>
                <?php
                if (mysqli_num_rows($myCurrentStudent) != 0) {

                    // echo  mysqli_num_rows( $result );
                    // kkhih

                    while ($row = mysqli_fetch_assoc($myCurrentStudent)) {
                        // Process and display the data
                        // echo '<br>' . $row[ 'password' ] . '<br>';

                        $tableName = 'Students';
                        $rowName = 'name';
                        $searchField = 'student_id';
                        $searchValue = $row['student_id'];

                        $studentName = $allQueryFunction->fetchSingleValue($tableName, $rowName, $searchField, $searchValue);

                ?>
                        <div class='card card-side bg-base-100 shadow-xl'>
                            <figure><img src='../student.jpg' alt='Student' class='h-40 w-60 rounded-md' /></figure>
                            <form method='post'>
                                <div class='card-body'>

                                    <p class='card-title'>Subject : <?php echo $row['subject'] ?></p>
                                    <p><span class="font-semibold text-lg">Student:
                                        </span>
                                        <?php echo $studentName ?></p>
                                    <p><span class="font-semibold text-lg">Start Date : </span>
                                        <?php echo $row['start_date'] ?></p>
                                    <p><span class="font-semibold text-lg">Finish Date : </span>
                                        <?php echo ($row['finish_date'] == '') ? 'Still Teaching' : $row['finish_date'] ?></p>
                                    <p><span class="font-semibold text-lg">Student Gave you : </span>
                                        <?php echo ($row['teacher_rating'] == 0) ? 'Not Yet given' : $row['teacher_rating'] ?> <span class="text-xl text-yellow-400">★</span> ratings</p>
                                    <p><span class="font-semibold text-lg">Student Feedback : </span>
                                        <?php echo ($row['teacher_feedback'] == '') ? 'Not yet Given' : $row['teacher_feedback'] ?></p>
                                    <form method='post'>
                                        <input class='hidden' type='text' name='teachingID' value="<?php echo $row['teaching_id'] ?>">

                                        <input class='input border-2 border-blue-300 mr-4' type='text' name='feedback' placeholder='<?php echo ($row['student_feedback'] == '') ? 'Give Student a Feedback' : $row['student_feedback'] ?>'>

                                        <div class='rating rating-md rating-half'>

                                            <?php
                                            $j = 0;
                                            for ($i = 0; $i <= 10; $i++, $j += 0.5) {

                                                if ($i == 0) {
                                            ?><input type='radio' name='rating' class='bg-orange-500 mask mask-star-2 mask-half-1 hidden' <?php echo ($j == $row['student_rating']) ? 'checked' : '';
                                                                                                                                            ?> value="<?php echo $j; ?>" /><?php

                                                                                                                                                                        } else {

                                                                                                                                                                            if ($i % 2 == 1) {
                                                                                                                                                                            ?><input type='radio' name='rating' class='bg-orange-500 mask mask-star-2 mask-half-1' <?php echo ($j == $row['student_rating']) ? 'checked' : '';
                                                                                                                                                                                                                                                                    ?> value="<?php echo $j; ?>" /><?php
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    ?><input type='radio' name='rating' class='bg-orange-500 mask mask-star-2 mask-half-2 ' <?php echo ($j == $row['student_rating']) ? 'checked' : '';
                                                                                                                                                                                                                                                                                                                                                                ?> value="<?php echo $j; ?>" /><?php
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                                                                ?>

                                        </div>

                                        <button class='btn bg-blue-500' name='complete' type='submit'>Complete</button>
                                    </form>
                                </div>
                            </form>

                        </div>
                <?php

                    }
                } else {
                    echo 'No student YET';
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
<?php include '../common/header.html';
include "../common/navbar.php";
include "../common/OOP.php";
$allQueryFunction = new AllQueryFunction();

//session_start();


if (isset($_POST['submit'])) {

    $email = $_SESSION['userEmail'];
    $role = $_SESSION['userRole'];
    $status = 'available';
    $subject = $_POST['subject'];
    $weekly = $_POST['weekly'];
    $salary = $_POST['salary'];
    $type = $_POST['type'];
    $hour = $_POST['hour'];
    $description = $_POST['description'];

    // echo  $email . " " . $role . " " . $subject . " " . $weekly . " " . $type . " " . $hour . " " . $salary . " " . $status . " " . $description;

    $result =
        $allQueryFunction->advertise(
            $email,
            $role,
            $subject,
            $weekly,
            $salary,
            $type,
            $hour,
            $description,
            $status
        );

    if ($result) {

        echo '<script>alert("Data inserted successfully!");</script>';
        header('location:../page/teacherDashboard.php');


    } else {
        $error = "insert is not success.";
    }
}

?>

<div>
    <div class="hero min-h-screen bg-gray-200">
        <div class="hero-content flex flex-col ">
            <div class="text-center ">
                <h1 class="text-4xl font-bold">Look for tutions!</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">

                <div>


                    <div id="loggedAsTeacher" class="tabcontent border-t py-2 px-4">
                        <form action="" class="card-body" method="post">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Subject</span>
                                </label>
                                <input required type="text" name="subject" placeholder="subject" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Day Per Week</span>
                                </label>
                                <input required name="weekly" type="number" placeholder="Day Per week" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Expected Salary</span>
                                </label>
                                <input required type="number" name="salary" placeholder="Expected Salary" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label" for="type">
                                    <span class="label-text">Tuition Type (Online/ Onsite)</span>
                                </label>

                                <select name="type" id="type" class="input input-bordered">
                                    <option value="online" class="input input-bordered">Online</option>
                                    <option value="onsite" class="input input-bordered">Onsite</option>

                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Hour Per Day</span>
                                </label>
                                <input required type="text" name="hour" placeholder="Hour Per Day" class="input input-bordered" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Short Description</span>
                                </label>
                                <input required type="text" name="description" placeholder="Short Description" class="input input-bordered" />
                            </div>




                            <div class="form-control mt-6">
                                <button class="btn bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500hover:to-yellow-500 text-black" name="submit" type="submit" id="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function successAlert() {
        alert("Success");
    }
</script>
<?php
include "../common/footer.php";
include '../common/footer.html';

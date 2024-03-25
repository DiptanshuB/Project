<?php
include '../common/header.html';
include "../common/OOP.php";

$allQueryFunction = new AllQueryFunction();
$error = '';
$role = "";
$experience = '';
$status = '';
$result = '';
if (isset($_POST['submit'])) {

    // echo "hello";
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $institution = $_POST['institution'];
    $address = $_POST['address'];
    $session = $_POST['session'];
    $experience = $_POST['experience'];
    $status = "yes";
    $status = $_POST['status'];
    $result = $_POST['result'];

    $file_name = "";
    // $file_name = $_FILES['uploadePhoto']['name'];
    // print_r($_FILES['uploadePhoto']);
    // $tempname = $_FILES['uploadePhoto']['tmp_name'];
    // $folder = '/home/joymondal/My Desktop/documents/WEB/IT_Park_Project/images/'.$file_name;
    // echo $folder." ".$tempname;

    // if (move_uploaded_file($tempname, $folder)) {
    //     $error = "Photo Upload Success";
    //     echo "success";
    // } else {
    //     $error = "Photo Upload not Success";
    //     echo "Temporary file: " . $_FILES["uploadePhoto"]["tmp_name"];

    //     echo "Error moving file: " . $_FILES["uploadePhoto"]["error"];

    //     echo "not success";

    // }

    // echo $name . $email . $password . $role . $phone . $institution . $address . $session . $experience . $status . $result;

    $ID = "";

    $user = $allQueryFunction->findUser($email, $ID);
    if (mysqli_num_rows($user) != 0) {

        $error = "User Email Already Exist.";
    } else {
        $result = $allQueryFunction->addUser($name, $email, $password, $role, $phone, $institution, $address, $session, $experience, $status, $result, $file_name);

        if ($result) {

            session_start();
            // Set a session variable
            $_SESSION['userEmail'] = $email;
            $_SESSION['userRole'] = $role;
            header('location:../page/logIn.php');

            exit();
            // echo "register success";

        } else {
            $error = "insert is not success.";
        }
    }
}

?>
<div>
    <div class="hero min-h-screen bg-base-200 ">
        <div class="hero-content flex flex-col">
            <div class="text-center ">
                <h1 class="text-4xl font-bold">Register now !</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">

                <div>

                    <div class="border rounded overflow-hidden w-fit text-center p-3">
                        <button class="tablinks py-2 px-4 bg-gray-400 rounded-md" onclick="openCity(event, 'loggedAsTeacher')">Register as Teacher </button>
                        <button class="tablinks py-2 px-4 bg-gray-400 rounded-md" onclick="openCity(event, 'loggedAsStudent')">Register as Student</button>

                    </div>

                    <div id="loggedAsTeacher" class="tabcontent border-t py-2 px-4">
                        <form  class="card-body" method="POST" enctype="multipart/form-data">

                        <p class="text-xl font-bold text-green-600">You are register as Teacher</p>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Teacher Name</span>
                                </label>
                                <input required type="text" name="name" placeholder="teacher name" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input required type="email" name="email" placeholder="email" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Phone Number</span>
                                </label>
                                <input required type="text" name="phone" placeholder="Phone Number" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Address</span>
                                </label>
                                <input required type="text" name="address" placeholder="Address" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">institution</span>
                                </label>
                                <input required type="text" name="institution" placeholder="institution" class="input input-bordered" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Year</span>
                                </label>
                                <input required type="text" name="session" placeholder="Your Educational Qualification" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Experience</span>
                                </label>
                                <input required type="text" name="experience" placeholder="Experience" class="input input-bordered" />
                            </div>
                            <!-- <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Photo</span>
                                </label>
                                <input  type="file" name="uploadePhoto" placeholder="Upload your photo" class="input input-bordered pt-[8px]" />
                            </div> -->

                            <div class="form-control hidden">
                                <label class="label">
                                    <span class="label-text">Status</span>
                                </label>
                                <input type="text" name="status" placeholder="Status" class="input input-bordered" />
                            </div>


                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Password</span>
                                </label>
                                <input required type="password" name="password" placeholder="password" class="input input-bordered" minlength="6"/>

                            </div>

                            <div class="form-control ">
                                <select name="role" id="role" class="input input-bordered hidden">
                                    <option value="teacher" class="text-xl font-semibold">Teacher</option>
                                </select>
                                <label class="my-5 ">
                                    Already have an account?
                                    <a a href="logIn.php" class="text-blue-800 font-bold text-lg cursor-pointer">
                                        Log in now!
                                    </a>
                                </label>
                            </div>
                            <p class="text-red-500 font-semibold ">
                                <?php echo $error ?>
                            </p>
                            <div class="form-control mt-6">
                                <button class="btn bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500hover:to-yellow-500 text-black" name="submit" type="submit" id="submit">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="loggedAsStudent" class="tabcontent border-t py-2 px-4 hidden">
                        <form action="" class="card-body" method="post">
                            <p class="text-xl font-bold text-green-600">You are register as Student</p>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Student Name</span>
                                </label>
                                <input required type="text" name="name" placeholder="student name" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input required type="email" name="email" placeholder="email" class="input input-bordered" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Phone Number</span>
                                </label>
                                <input required type="text" name="phone" placeholder="Phone Number" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Address</span>
                                </label>
                                <input required type="text" name="address" placeholder="Address" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">institution</span>
                                </label>
                                <input required type="text" name="institution" placeholder="institution" class="input input-bordered" />
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Class</span>
                                </label>
                                <input required type="text" name="session" placeholder="Your Educational Qualification" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Result</span>
                                </label>
                                <input required type="text" name="result" placeholder="Your Result" class="input input-bordered" />
                            </div>
                            <!-- <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Photo</span>
                                </label>
                                <input  type="file" name="photo" placeholder="Upload your photo" class="input input-bordered pt-[8px]" />
                            </div> -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Password</span>
                                </label>
                                <input required type="password" name="password" placeholder="password" class="input input-bordered" />

                            </div>

                            <div class="form-control ">
                                <select name="role" id="role" class="input input-bordered hidden">
                                    <option value="student" class="text-xl font-semibold ">Student</option>
                                </select>
                                <label class="my-5 ">
                                    Already have an account?
                                    <a a href="logIn.php" class="text-blue-800 font-bold text-lg cursor-pointer">
                                        Log in now!
                                    </a>
                                </label>
                            </div>
                            <p class="text-red-500 font-semibold ">
                                <?php echo $error ?>
                            </p>
                            <div class="form-control mt-6">
                                <button class="btn bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500hover:to-yellow-500 text-black" name="submit" type="submit" id="submit">
                                    Register
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
    // Simulate a click on the first button when the page loads
    document.querySelector('.tablinks').click();

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("bg-gray-300");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.classList.add("bg-gray-300");
    }
</script>

<?php include '../common/footer.html';?>
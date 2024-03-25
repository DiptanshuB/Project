<?php
include '../common/header.html';
include "../common/OOP.php";
// include "../page/home.php";

$allQueryFunction = new AllQueryFunction();
$error = '';
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    // echo $email;
    $ID = "";
    $user = $allQueryFunction->findUser($email, $ID);

    if (mysqli_num_rows($user) != 0) {

        // echo  mysqli_num_rows($user);

        while ($row = mysqli_fetch_assoc($user)) {

            // Process and display the data
            // echo "<br>" . $row['password'] . "<br>";
            if ($row['password'] == $password) {
                session_start();
                $_SESSION['userEmail'] = $row['email'];
                $_SESSION['userRole'] = $row['role'];
                $_SESSION['userID'] = $row['student_id'];
                header('location:../page/home.php');

                exit();
            } else {
                $error = "Password Does not match.";
            }
        }
    } else {
        echo
        $error = "Email Not found";
    }
}

?>
<div>
    <div class="hero min-h-screen bg-gray-300">
        <div class="hero-content flex flex-col ">
            <div class="text-center ">
                <h1 class="text-4xl font-bold">Log In Now !</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-200">
                <form action="" class="card-body" method="post">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input required type="email" name="email" placeholder="email" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input required type="password" name="password" placeholder="password" class="input input-bordered" />
                        <label class="my-2 ">
                            Don't have an account?
                            <a href="register.php" class="text-blue-800 font-bold text-lg cursor-pointer">
                                Register Now
                            </a>
                        </label>
                    </div>
                    <p class="text-red-500 font-semibold ">
                        <?php echo $error ?>
                    </p>
                    <div class="form-control mt-6">
                        <button class="btn bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500hover:to-yellow-500 text-black" type="submit" id="submit" name="submit">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../common/footer.html';?>
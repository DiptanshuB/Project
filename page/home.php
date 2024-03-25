<?php include '../common/header.html';
include "../common/navbar.php"; ?>

<?php
// session_start();

// Your code here
// echo "Welcome, " . $_SESSION['userEmail'];

if ($_SESSION['userEmail']) { ?>
    <div class="container mx-auto">
        <div>
            <div class="carousel w-full">
                <div id="slide1" class="carousel-item relative w-full">
                    <img src="../images/tutor-service.jpg" class="w-full h-[70vh]" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide4" class="btn btn-circle">❮</a>
                        <a href="#slide2" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide2" class="carousel-item relative w-full">
                    <img src="../images/teaching2.jpg" class="w-full h-[70vh]" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide1" class="btn btn-circle">❮</a>
                        <a href="#slide3" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide3" class="carousel-item relative w-full">
                    <img src="../images/student1.jpg" class="w-full h-[70vh]" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide2" class="btn btn-circle">❮</a>
                        <a href="#slide4" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide4" class="carousel-item relative w-full">
                    <img src="../images/teaching1.jpg" class="w-full h-[70vh]" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide3" class="btn btn-circle">❮</a>
                        <a href="#slide1" class="btn btn-circle">❯</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php } else {

    header("Location: ../page/logIn.php ");
} ?>

<?php
include "../common/footer.php";
include '../common/footer.html';

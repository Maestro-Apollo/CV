<?php
session_start();

if (isset($_SESSION['name'])) {
} else {
    header('location:login.php');
}
include('class/database.php');
class profile extends database
{
    protected $link;
    public function showProfile()
    {
        $username = $_SESSION['name'];
        $sql = "select * from student_tbl where username = '$username' ";
        $res = mysqli_query($this->link, $sql);

        $row = mysqli_fetch_assoc($res);
        $id = $row['student_id'];

        $sqlFind = "SELECT * from info_tbl where student_id = '$id' ";
        $resFind = mysqli_query($this->link, $sqlFind);

        if (mysqli_num_rows($resFind) > 0) {
            return $resFind;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
$row = mysqli_fetch_assoc($objShow);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <style>
    .profileImage {
        height: 200px;
        width: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
        cursor: pointer;

    }



    .upload_btn {
        background-color: #EEA11D;
        color: #05445E;
        transition: 0.7s;
    }

    .upload_btn:hover {
        background-color: #05445E;
        color: #EEA11D;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }

    .gap {
        margin-bottom: 95px;
    }

    body {
        font-family: 'Raleway', sans-serif;
    }
    </style>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $row['full_name'] ?>
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <div id="output"></div>

                        <h3 class="font-weight-bold mb-5" style="color: #05445E">Account Details</h3>
                        <form action="" id="myForm" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <label for="fullname" class="font-weight-bold">Full Name</label>
                                    <input type="text" id="fullname" name="fullname"
                                        value="<?php echo $row['full_name']; ?>" class="form-control border-0 bg-light">

                                    <label for="summary" class="font-weight-bold mt-4">Summary</label>
                                    <div name="" id="editor" cols="30" rows="10"></div>




                                </div>
                                <div class="col-md-5 text-center">

                                    <img class="profileImage" onclick="triggerClick()" id="profileDisplay"
                                        src="user_img/<?php echo $rowInfo['image']; ?>" alt="">
                                    <input type="file" accept="image/*" name="image" id="profileImage"
                                        onchange="displayImage(this)" style="display: none;">
                                    <p class="lead gap">Tap to upload image</p>
                                    <input class="btn font-weight-bold log_btn btn-lg mt-5" type="submit"
                                        value="Confirm Changes">
                                    </input>

                                </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>
    //This ajax call will take the user info to update.php
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "update.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#output').fadeIn().html(response);
                    setTimeout(() => {
                        $('#output').fadeOut('slow');
                    }, 2000);
                }
            });

        });
    })
    </script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
    var container = document.getElementById('editor');
    var editor = new Quill(container);
    </script>
</body>

</html>
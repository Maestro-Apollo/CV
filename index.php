<?php
session_start();
include('class/database.php');
class profile extends database
{
    protected $link;
    public function showProfile()
    {
        $sql = "select * from info_tbl";
        $res = mysqli_query($this->link, $sql);


        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>


    <style>
    .navbar-brand {
        width: 10% !important;
    }

    .bg_color {
        background-color: #fff !important;
    }

    body {
        font-family: 'Raleway', sans-serif;
    }

    .carousel-caption {
        top: 50%;
        transform: translateY(-50%);
        bottom: initial;
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    .carousel .carousel-item {
        height: 80vh;
    }

    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        min-height: 80vh;
        object-fit: cover;

    }

    section {
        padding: 60px 0;
    }

    .carousel-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
    }
    </style>


</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>






    <section>
        <div class="container">
            <div class="row">
                <?php if (isset($objShow)) { ?>
                <?php while ($row = mysqli_fetch_assoc($objShow)) { ?>
                <div class="col-md-6 mt-4">
                    <h3><?php echo $row['full_name']; ?> Summary</h3>
                    <p><?php echo $row['summary']; ?></p>
                </div>
                <?php } ?>
                <?php } ?>

            </div>
        </div>
    </section>




    <?php include('layout/script.php') ?>


</body>

</html>
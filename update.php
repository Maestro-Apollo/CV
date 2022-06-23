<?php
session_start();

include('class/database.php');
class profile extends database
{
    protected $link;

    public function insertProfileInfo()
    {
        if (isset($_POST['student_id'])) {
            $student_id = $_POST['student_id'];
            $full_name = $_POST['fullname'];
            $skill = $_POST['skill'];
            $qualification = $_POST['qualification'];
            $summary = $_POST['summary'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = 'user_img/' . $img;

            if ($_FILES['image']['name'] == '') {
                //Update query will update all the data inside user_info table
                $sql = "UPDATE `info_tbl` SET `full_name`= '$full_name',`summary`='$summary',`skill`='$skill',`qualification`='$qualification', `date` = CURRENT_TIMESTAMP WHERE student_id = '$student_id'";
            } else {
                $sql = "UPDATE `info_tbl` SET `full_name`= '$full_name',`summary`='$summary',`skill`='$skill',`image` = '$img',`qualification`='$qualification', `date` = CURRENT_TIMESTAMP WHERE student_id = '$student_id'";
            }


            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                echo '<div class="alert alert-success">
                <strong>Successfully Updated!</strong>
            </div>';
            } else {
                echo "Not added";
            }
        }
        # code...
    }
}
$obj = new profile;
$objInsertInfo = $obj->insertProfileInfo();
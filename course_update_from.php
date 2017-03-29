<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 2/21/2017
 * Time: 10:42 PM
 */

include_once("database.php");

#Passing These as I may need them
$crs_ID = $_POST['crs_ID'];
$crs_code = $_POST['crs_code'];
$crs_title = $_POST['crs_title'];
$crs_credits = $_POST['crs_credits'];
$crs_description = $_POST['crs_description'];
$departmentID = $_POST['departmentID'];


#Getting all Departments

$queryAllDepartments = $db->prepare("SELECT * 
                        FROM department");
$queryAllDepartments->execute();
$departments = $queryAllDepartments->fetchall();
$queryAllDepartments->closecursor();


?>

<!DOCTYPE html>
<html>
<!-- the header section -->
<head>
    <title>My University Schema</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>

<!-- the body section -->
<body>
<main>
    <h1 class="title">University Courses Manager</h1>
    <hr/>
    <h1>Update Course</h1>

    <form action="course_Update.php" method="post">

        <label>Department: <select name="department">
                <?php foreach ($departments as $department) : ?>{

                    <?php if ($department['departmentID'] == $departmentID) : ?>
                        <option selected='selected' value="<?= $department['departmentID'] ?>"><?= $department['departmentName'] ?></option>
                  <?php  else : ?>
                        <option value="<?= $department['departmentID'] ?>"><?= $department['departmentName'] ?></option>

                    }
                <?php endif; endforeach; ?>
            </select></label><br/>
        <label>Code:<input type="text" name="crs_code" value="<?= $crs_code ?>"></label><br/>
        <label>Title:<input type="text" name="crs_title" value="<?= $crs_title ?>"></label><br/>
        <label>Credits:<input type="text" name="crs_credits" value="<?= $crs_credits ?>"></label><br/><br/>
        <label>Description:<textarea name="crs_description" rows="10" cols="50">
               <?= $crs_description ?>
            </textarea></label><br/> <br/> <br/>
        <input type="hidden" name="crs_id" value="<?= $crs_ID ?>">

        <button type="submit">Update Course</button>
    </form>
    <br/>

    <a href="index.php">View Courses List</a> <br/> <br/>

</main>
</body>
</html>

<?php


#Require the database so that we can use the $db variable to reach the database
#This is setup in database.php
require_once("database.php");

#Grabbing Necessary Components from Database

// Get Department ID for displaying particular department information
$departmentID = filter_input(INPUT_GET, 'departmentID', FILTER_VALIDATE_INT);
#If departmentID is null or false set it to the default value 1 which is Engineering
if ($departmentID == NULL || $departmentID == FALSE) {
    $departmentID = 1;
}

// Get name for currently selected Department
#Query calls for all elements from department table that match the current departmentID from GET
$queryDepartments = "SELECT * FROM department
                      WHERE departmentID = :departmentID";
$queryDepartmentName = $db->prepare($queryDepartments);
$queryDepartmentName->execute(array(
    'departmentID' => $departmentID
));
#Fetches from the query and places in arry department
$department = $queryDepartmentName->fetch();
#Takes the current DepartmentName from the Query and stores as an isolated variable
$department_name = $department['departmentName'];
$queryDepartmentName->closeCursor();
//print_r($department);


//Get All From Departments
#Select all from departments and store in departments array (For use of Name and ID together in ForEach
$queryAllDepartments = $db->prepare("SELECT * 
                        FROM department");
$queryAllDepartments->execute();
$departments = $queryAllDepartments->fetchall();
$queryAllDepartments->closecursor();
//print_r($departments);


// Select all Courses Depending on departmentID or selected department
$queryAllCourses = $db->prepare("SELECT *
                                FROM courses
                                WHERE dep_id = :departmentID
                                ORDER BY crs_ID");
# I use arrays within excute staments instead of bindParam
$queryAllCourses->execute(array(
    ':departmentID' => $departmentID
));
#Create an array of all of the courses for use (By using a fetchAll)
$courses = $queryAllCourses->fetchAll();
$queryAllCourses->closeCursor();


?>

<html>
<link rel="stylesheet" type="text/css" href="styles.css"/>

<h1>My Courses</h1>
<hr/>



<table>
    <tr>
        <th>Code</th>
        <th>Title</th>
        <th>Credits</th>
        <th>Description</th>
        <!--Delete-->
        <th></th>
        <!--Update-->
        <th></th>
    </tr>

    <?php foreach ($courses as $course) : ?>
        <tr>
            <td><?php echo $course['crs_code']; ?></td>
            <td><?php echo $course['crs_title']; ?></td>
            <td><?php echo $course['crs_credits']; ?></td>
            <td><?php echo $course['crs_description']; ?></td>

            <td>
                <form action="course_Delete.php" method="post">
                    <input type="hidden" name="crs_id" value="<?= $course['crs_ID'] ?>">
                    <input type="hidden" name="crs_code" value="<?= $course['crs_code'] ?>">
                    <input type="hidden" name="crs_title" value="<?= $course['crs_title'] ?>">
                    <input type="hidden" name="crs_credits" value="<?= $course['crs_credits'] ?>">
                    <input type="hidden" name="crs_description" value="<?= $course['crs_description']?>">
                    <input type="hidden" name="departmentID" value="<?= $departmentID ?>">

                    <button type="submit">Drop</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<a href="index.php">Back To Registration</a>

</html>

<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 2/26/2017
 * Time: 8:55 PM
 */

include_once('database.php');


$crs_ID = $_POST['crs_ID'];
$crs_code = $_POST['crs_code'];
$crs_title = $_POST['crs_title'];
$crs_credits = $_POST['crs_credits'];
$crs_description = $_POST['crs_description'];
$dep_id = $_POST['department'];



#Create Database Query to Insert into courses
$query = $db->prepare("INSERT INTO courses (crs_code, crs_title, crs_credits, crs_description, dep_id)
        VALUES
        ( :crs_ID, :crs_title, :crs_credits, :crs_description, :dep_id );");
$query->execute(array(
    ":crs_ID" => $crs_ID,
    ":crs_title" => $crs_title,
    ":crs_credits" => $crs_credits,
    ":crs_description" => $crs_description,
    ":dep_id" => $dep_id
));
$query->closeCursor();
header('Location:index.php?departmentID='.$dep_id);
exit();

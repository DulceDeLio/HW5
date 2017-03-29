<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 2/26/2017
 * Time: 11:29 PM
 */


require_once("database.php");

#Get Variables with POST
$crs_ID = $_POST['crs_id'];
$crs_code = $_POST['crs_code'];
$crs_title = $_POST['crs_title'];
$crs_credits = $_POST['crs_credits'];
$crs_description = $_POST['crs_description'];
$dep_id = $_POST['department'];





$updateQuery = $db->prepare("UPDATE courses
        SET crs_code = :crs_code, 
        crs_title = :crs_title, 
        crs_credits = :crs_credits,
        dep_id = :dep_id,
        crs_description = :crs_description
              
        WHERE crs_id = :crs_ID;");

$updateQuery->execute(array(
    ":crs_code" => $crs_code,
    ":crs_title" => $crs_title,
    ":crs_credits" => $crs_credits,
    ":dep_id" => $dep_id,
    ":crs_description" => $crs_description,
    ":crs_ID" => $crs_ID
));
$updateQuery->closeCursor();
header('Location:index.php?departmentID='.$dep_id);
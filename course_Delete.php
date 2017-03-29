<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 2/26/2017
 * Time: 10:20 PM
 */


require_once("database.php");

#Get the passed variables with POST
$crs_ID = $_POST["crs_id"];
$dep_id = $_POST['departmentID'];

#Initiate Query to delete a row from the departments table
$query = $db->prepare("DELETE FROM courses
                       WHERE crs_ID = :crs_ID;");
#Execute and bind param through array
$query->execute(array(
    "crs_ID" => $crs_ID
));
$query->closeCursor();
header('Location:index.php?departmentID='.$dep_id);
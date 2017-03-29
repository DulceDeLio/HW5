<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 2/26/2017
 * Time: 6:36 PM
 */


require_once("database.php");

#Get the passed variables with POST
$departmentID = $_POST["departmentID"];

#Initiate Query to delete a row from the departments table
$query = $db->prepare("DELETE FROM department
                       WHERE departmentID = :departmentID;");
#Execute and bind param through array
$query->execute(array(
    "departmentID" => $departmentID
));
$query->closeCursor();
include("department_list.php");
//header("location:department_list.php");
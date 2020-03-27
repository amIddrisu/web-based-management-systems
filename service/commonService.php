<?php
require_once '../include/header.php';
require_once '../util/uuid.php';

function isUniqueField($tbl, $col, $val) {
     global $link;
        $isUnique = FALSE;
        $query = "select * from $tbl where $col ='$val';";
        
        $result = mysqli_query($link, $query);
        if ($result) {
            $count = mysqli_num_rows($result);
            
            if ($count == 1) {
               
                $isUnique=TRUE;
                return $isUnique;
            }
        }
        return $isUnique;
    }
   function getItem($tbl, $col, $val) {
     global $link;
       $row=NULL;
        $query = "select * from $tbl where $col ='$val';";
        
        $result = mysqli_query($link, $query);
        if ($result) {
            $count = mysqli_num_rows($result);
            
            if ($count == 1) {
               
                $row = mysqli_fetch_assoc($result);
                return $row;
            }
        }
        return $row;
    }
    function getItems($tbl,$col,$startDate,$endDate) {
         global $link;
        //sql to return all user objects
        $sql = "SELECT * FROM $tbl WHERE $col >= '$startDate' AND $col <= '$endDate';";
        $result = mysqli_query($link, $sql);
        $itemsData = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $itemsData[] = $rows;
        }
        return $itemsData;
    }

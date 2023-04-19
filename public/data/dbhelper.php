<?php
require_once('config.php');
function execute($sql){
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    mysqli_query($con, $sql);
    mysqli_close($con);
}
function excuteResult($sql){
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    $result = mysqli_query($con,$sql);
    $data = [];
    while ($row = mysqli_fetch_array($result,1)){
        $data[] = $row;
    }
    mysqli_close($con);
    return $data;
}
function excuteSingleResult($sql){
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    $result = mysqli_query($con, $sql);
    $row =mysqli_fetch_array($result, 1);
    mysqli_close($con);
    return $row;
}
function executeSingleResult($sql) {
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);
	mysqli_close($con);
	return $row;
}


function excuteShop($query){
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    $result = mysqli_query($con, $query);
    $row =mysqli_fetch_array($result);
    return $row;
}



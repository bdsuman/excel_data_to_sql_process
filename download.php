<?php
$con = mysqli_connect('localhost','root','suman','eschool_vidamoyee');
mysqli_query($con,"SET NAMES 'utf8mb4';");
mysqli_set_charset($con,"utf8mb4") or die('Problem Set UTF8 Charset');
function sanitize($data){
    $data=str_replace("\r\n",'', $data);
    $data=addslashes($data);
    $data=strip_tags($data);
    return $data;
}
//header to give the order to the browser
//header('Content-Type: text/csv');

//header('Content-Transfer-Encoding: binary');
//header("Content-Type: text/csv; charset=utf-8");
//header('Content-Disposition: attachment;filename=exported-data.csv');
//header('Content-type: text/csv; charset=UTF-8');
//header('Content-Disposition: attachment; filename=Customers_Export.csv');
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=file.csv');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

//select table to export the data

$select_table=mysqli_query($con ,"SELECT roll,student_name_bn,student_name_en,brid,date_of_birth,gender,religion,disability_status,student_mobile_no,father_name_bn,father_mobile_no,mother_name_bn,mother_mobile_no,guardian_name_bn,guardian_mobile_no FROM `noipunno` WHERE shift='Morning' AND class='Seven' and 
section='A' order by roll");
$rows = mysqli_fetch_assoc($select_table);

if ($rows)
{
    getcsv(array_keys($rows));
}
while($rows)
{
    getcsv($rows);
    $rows = mysqli_fetch_assoc($select_table);
}

// get total number of fields present in the database
function getcsv($no_of_field_names)
{
    $separate = '';


// do the action for all field names as field name
    foreach ($no_of_field_names as $field_name)
    {
        if (preg_match('/\\r|\\n|,|"/', $field_name))
        {
            $field_name = '' .  sanitize($field_name) . '';
        }
        echo $separate . sanitize($field_name);

//sepearte with the comma
        $separate = ',';
    }

//make new row and line
    echo "\r\n";
}
?>
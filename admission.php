<?php
#XLSX Library
require("simplexlsx/SimpleXLSX.php");
    use Shuchkin\SimpleXLSX;
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', true);
    function debug($data){
        echo '<pre>';
            print_r($data);
        echo '</pre>';
    }
    function sanitize($data){
        $data=str_replace("\r\n",'', $data);
        $data=addslashes($data);
        $data=strip_tags($data);
        return $data;
    }
class Converter
{
    public static $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
    public static $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

    public static function bn2en($number)
    {
        return str_replace(self::$bn, self::$en, $number);
    }

    public static function en2bn($number)
    {
        return str_replace(self::$en, self::$bn, $number);
    }
}

// [0] => 1
    // [1] => Tuha aker
    // [2] => Polash houladar
    // [3] => Rina houladar
    // [4] => 01712-389733
    // [5] => Islam
$con = mysqli_connect('localhost','root','suman','eschool_vidamoyee');
$data_path = 'data/morning new.xlsx';

$id = 230325;
            if ($xlsx = SimpleXLSX::parse($data_path)) {       
                    foreach($xlsx->rows() as $key=>$value) {
//                         debug($value);
//                         echo '<br>';
                        $userId = $value[0];
                        $data['userId'] = $userId;
                        $name = $value[1];
                        $data['name'] = $name;
                        $birthRegistrationNo = $value[2];
                        $data['birthRegistrationNo'] = $birthRegistrationNo;
                        $dateOfBirth = $value[3];
                        $data['dateOfBirth'] = $dateOfBirth;
                        $fatherName= $value[4];
                        $data['fatherName'] = $fatherName;
                        $fatherNid= $value[5];
                        $data['fatherNid'] = $fatherNid;
                        $motherName= $value[6];
                        $data['motherName'] = $motherName;
                        $motherNid= $value[7];
                        $data['motherNid'] = $motherNid;
                        $guardianName= $value[8];
                        $data['guardianName'] = $guardianName;
                        $class= $value[9];
                        $data['class'] = $class;
                        $shift= $value[10];
                        $data['shift'] = $shift;
                        $version= $value[11];
                        $data['version'] = $version;
                        $gender= $value[12];
                        $data['gender'] = $gender;
                        $group= $value[13];
                        $data['group'] = $group;

                        debug($data);
                         $sql="INSERT INTO `admission`(`id`, `userId`, `name`, `birthRegistrationNo`, `dateOfBirth`, `fatherName`, `fatherNid`, `motherName`, `motherNid`, `guardianName`, `class`, `shift`, `version`, `gender`, `group`) VALUES 
                        (null,'$userId','$name','$birthRegistrationNo','$dateOfBirth','$fatherName','$fatherNid','$motherName','$motherNid','$guardianName','$class','$shift','$version','$gender','$group')";
//                           echo '<br><br>';
                      $result=$con->query($sql);
                    }
            }else {
                echo SimpleXLSX::parseError();
            }
                   
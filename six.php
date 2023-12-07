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
$data_path = 'data/Noipunno Information  (Responses).xlsx';
exit();
$id = 230325;
            if ($xlsx = SimpleXLSX::parse($data_path)) {       
                    foreach($xlsx->rows() as $key=>$value) {
                        // debug($value);
                         //echo '<br>';
                         $shift = $value[0];
                        $data['shift'] = $shift;
                        $class = $value[1];
                        $data['class'] = $class;
                        $section = $value[2];
                        $data['section'] = $section;
                        $roll = intval(Converter::bn2en($value[3]));
                        $data['roll'] = $roll;
                        $student_name_bn= strtoupper($value[4]);
                        $data['student_name_bn'] = $student_name_bn;
                        $student_name_en= strtoupper(sanitize($value[5]));
                        $data['student_name_en'] = $student_name_en;

                        $brid =intval(Converter::bn2en($value[6]));
                        $data['brid'] = $brid;
                        $date_of_birth =$value[7];
                        $data['date_of_birth'] = $date_of_birth;
                        $religion = ucwords($value[9]);
                        $data['religion'] = $religion;
                        $disability_status = ucwords($value[10]);
                        $data['disability_status'] = $disability_status;
                        $student_mobile_no = empty($value[11])?intval(Converter::bn2en($value[15])):intval(Converter::bn2en($value[11]));
                        $data['student_mobile_no'] = $student_mobile_no;
                        $father_name_bn = strtoupper($value[12]);
                        $data['father_name_bn'] = $father_name_bn;
                        $father_mobile_no = intval(Converter::bn2en($value[13]));
                        $data['father_mobile_no'] = $father_mobile_no;

                        $mother_name_bn = strtoupper($value[14]);
                        $data['mother_name_bn'] = $mother_name_bn;
                        $mother_mobile_no = intval(Converter::bn2en($value[15]));
                        $data['mother_mobile_no'] = $mother_mobile_no;

                        $guardian_name_bn = strtoupper($value[16]);
                        $data['guardian_name_bn'] = $guardian_name_bn;
                        $guardian_mobile_no = intval(Converter::bn2en($value[17]));
                        $data['guardian_mobile_no'] = $guardian_mobile_no;

                        //debug($data);
                         $sql="INSERT INTO `noipunno`(`id`, `ins_id`,`stu_year`, `shift`, `class`, `section`, `roll`, `student_name_bn`, `student_name_en`, `brid`, `date_of_birth`, `gender`, `religion`, `disability_status`, `student_mobile_no`, `father_name_bn`, `father_mobile_no`, `mother_name_bn`, `mother_mobile_no`, `guardian_name_bn`, `guardian_mobile_no`) values
                        (null,111842,2023,'$shift','$class','$section','$roll','$student_name_bn','$student_name_en','$brid','$date_of_birth','Female','$religion','$disability_status','$student_mobile_no','$father_name_bn','$father_mobile_no','$mother_name_bn','$mother_mobile_no','$guardian_name_bn','$guardian_mobile_no')";
//                           echo '<br><br>';
                       //$result=$con->query($sql);
                    }
            }else {
                echo SimpleXLSX::parseError();
            }
                   
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

$con = mysqli_connect('localhost','root','suman','eschool_vidamoyee');
$data_path = 'data/ix-all-result-science.xlsx';
            if ($xlsx = SimpleXLSX::parse($data_path)) {       
                    foreach($xlsx->rows() as $key=>$value) {
                        if(0==$key){
                            continue;
                        }

                         //debug($value);
                       //  echo '<br>';
                        $StuID = $value[0];
                        $data['StuID'] = $StuID;
                        $shift = $value[1];
                        $data['shift'] = $shift;
                        $group = $value[2];

                        $class = 'IX';//change korte hobe kheyal rekhe kaj korte hobe
                        $data['class'] = $class;

                        $data['group'] = $group;
                        $section = $value[3];
                        $data['section'] = $section;
                        $roll = intval(Converter::bn2en($value[4]));
                        $data['roll'] = $roll;
                        $SubCode = $value[7];
                        $data['SubCode'] = $SubCode;
                        $ca = $value[8];
                        $data['ca'] = $ca;
                        $mcq = $value[9];
                        $data['mcq'] = $mcq;
                        $cq = $value[10];
                        $data['cq'] = $cq;
                        $pra = $value[11];
                        $data['pra'] = $pra;

                       // debug($data);
                        $sql="INSERT INTO `marksinfo`(`ID`, `InsID`, `Shift`, `StuYear`, `ExamType`, `ClassName`, `Section`, `StuGroup`, `StuID`, `StuRoll`, `SubCode`, `SubMarks`, `ObjMarks`, `PraMarks`, `CT`, `CA`, `TotMarks`, `GP`, `LG`, `Fail`, `ExtraFourthGP`) VALUES
                        (null,111842,'$shift',2023,'Half Yearly','$class','$section','$group','$StuID','$roll','$SubCode','$cq','$mcq','$pra',null,'$ca',0,0,'','',0)";
                           //echo '<br><br>';
                      // $result=$con->query($sql);
                    }
            }else {
                echo SimpleXLSX::parseError();
            }
                   
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

$con = mysqli_connect('localhost','root','suman','eschool_vidamoyee');
$data_path = 'data/Morning All.xlsx';
$id = mysqli_fetch_assoc(mysqli_query($con,'SELECT max(StuID)+1 as id FROM `stuinfo`'))['id'];
//debug($max_id);
////exit;
//$id = 231144;
if ($xlsx = SimpleXLSX::parse($data_path)) {
    foreach($xlsx->rows() as $key=>$value) {
//                         debug($value);
//                         echo '<br>';
        $StuId = $id++;
        $data['StuID'] = $StuId;
        $Roll = intval($value[0]);
        $data['Roll'] = $Roll;
        $StuName= strtoupper($value[1]);
        $data['StuName'] = $StuName;
        $Section = $value[2];
        $data['section'] = $Section;
        $blood_group = str_replace("\r\n",'', $value[3]);
        $data['blood_group'] =  $blood_group;
        $StuGroup = empty($value[4])?'General':$value[4];
        $data['StuGroup'] = $StuGroup;
        $Shift = $value[6];
        $data['shift'] = $Shift;
        $mobile = intval(str_replace('-','',$value[7]))??0;
        $data['mobile'] = $mobile;
        $class = $value[8];
        $data['class'] = $class;
        $FName =strtoupper($value[9]);
        $data['FName'] = $FName;
        $MName = strtoupper($value[10]);
        $data['MName'] = $MName;
        $religion =  $value[11];
        $data['Religion'] = $religion;
        $fourth =  $value[12]??'';
        $data['fourth'] = $fourth;
        $co_curriculum_activities = empty($value[13])?'':str_replace("\r\n",'',strip_tags($value[13])??'');
        $data['co_curriculum_activities'] = $co_curriculum_activities;
        $gurdian_profession = '';
        $data['gurdian_profession'] =  $gurdian_profession;
        $quota ='';
        $data['quota'] =  $quota;

//        $fourth = '138';
        //$gender = ucwords($value[4]);

        $dataPer['per_address']=[
            'per_district'=>'',
            'per_upazila'=>'',
            'per_post_office'=>'',
            'per_village'=>''
        ];
        $PerAdd= json_encode($dataPer,JSON_FORCE_OBJECT);

        debug($data);
        $sql="INSERT INTO `stuinfo`(`ID`, `InsID`, `StuYear`, `StuID`, `StuName`, `FName`, `MName`, `mobile`, `DOB`, `Religion`, `Gender`, `blood_group`, `gurdian_profession`, `co_curriculum_activities`, `PreAdd`, `PerAdd`, `AdmissionDate`, `image`, `entryBy`) values
                        (null,111842,2023,'$StuId','$StuName','$FName','$MName','$mobile','0000-00-00','$religion','Female','$blood_group','$gurdian_profession','$co_curriculum_activities','$PerAdd','$PerAdd','2023-01-01','','admin')";
//                           echo '<br><br>';
      // $result=$con->query($sql);
        $sqlClass="INSERT INTO `stuclassinfo`(`ID`, `InsID`, `StuYear`, `ClassName`, `StuID`, `Roll`, `Section`, `Shift`, `StuGroup`, `FourthSub`, `SubjectsTaken`, `PromotionType`,`Status`,`entryBy`) VALUES
                        (null,111842,2023,'$class','$StuId','$Roll','$Section','$Shift','$StuGroup','$fourth','','Admited','Regular','admin')";
        // $resultClass=$con->query($sqlClass);
    }
}else {
    echo SimpleXLSX::parseError();
}
                   
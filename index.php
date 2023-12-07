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
    // [0] => 1
    // [1] => Tuha aker
    // [2] => Polash houladar
    // [3] => Rina houladar
    // [4] => 01712-389733
    // [5] => Islam
$con = mysqli_connect('localhost','root','suman','eschool_vidamoyee');
$data_path = 'data/Vidamoyee Student Data 2023 Class (4_5_6_7_8) (Responses).xlsx';
exit();
$id = 230325;
            if ($xlsx = SimpleXLSX::parse($data_path)) {       
                    foreach($xlsx->rows() as $key=>$value) {
                         //debug($value);
                         //echo '<br>';
                        $StuId = $id++;
                        $data['shift'] = $value[1];
                        $class = $value[2];
                        $data['class'] = $value[2];
                        $Shift = $value[1];
                        $data['section'] = $value[3];
                        $Section = $value[3];
                        $data['roll'] = intval($value[4]);
                        $Roll = intval($value[4]);
                        $data['blood_group'] =  str_replace("\r\n",'', $value[9]);
                        $blood_group = str_replace("\r\n",'', $value[9]);
                        $data['gurdian_profession'] = strtoupper($value[10]);
                        $gurdian_profession = addslashes($value[10]);
                        $data['quota'] = $value[11];
                        $quota = $value[11]??'';
                        $data['co_curriculum_activities'] = addslashes(strtoupper($value[12]));
                        $co_curriculum_activities = addslashes(strtoupper($value[12]))??'';
                        $StuGroup = $value[14]??'General';
                        //$StuGroup = 'General';
                        $fourth = intval($value[13])??'';
                        $data['fourth'] = $fourth;
                        $data['StuGroup'] = $StuGroup;
                        $StuName= strtoupper($value[0]);
                        $data['StuName'] = $StuName;
                        $FName = strtoupper($value[6]);
                        $data['FName'] = $FName;
                        $MName = strtoupper($value[7]);
                        $data['MName'] = $MName;
                        //$gender = ucwords($value[4]);
                        $religion = ucfirst($value[5]);
                        $mobile = intval(str_replace('-','',$value[8]))??0;
                        $data['mobile'] = $mobile;
                        $data['Religion'] = ucwords($value[5]);
                        $dataPer['per_address']=[
                            'per_district'=>'',
                            'per_upazila'=>'',
                            'per_post_office'=>'',
                            'per_village'=>''
                          ];
                        $PerAdd= json_encode($dataPer,JSON_FORCE_OBJECT);

                        //debug($data);
                         $sql="INSERT INTO `stuinfo`(`ID`, `InsID`, `StuYear`, `StuID`, `StuName`, `FName`, `MName`, `mobile`, `DOB`, `Religion`, `Gender`, `blood_group`, `gurdian_profession`, `co_curriculum_activities`, `PreAdd`, `PerAdd`, `AdmissionDate`, `image`, `entryBy`) values
                        (null,111842,2023,'$StuId','$StuName','$FName','$MName','$mobile','0000-00-00','$religion','Female','$blood_group','$gurdian_profession','$co_curriculum_activities','$PerAdd','$PerAdd','2023-01-01','','admin')";
//                           echo '<br><br>';
                       $result=$con->query($sql);
                       $sqlClass="INSERT INTO `stuclassinfo`(`ID`, `InsID`, `StuYear`, `ClassName`, `StuID`, `Roll`, `Section`, `Shift`, `StuGroup`, `FourthSub`, `SubjectsTaken`, `PromotionType`,`Status`,`entryBy`) VALUES
                        (null,111842,2023,'$class','$StuId','$Roll','$Section','$Shift','$StuGroup','$fourth','','Admited','Regular','admin')";
                      $resultClass=$con->query($sqlClass);
                    }
            }else {
                echo SimpleXLSX::parseError();
            }
                   
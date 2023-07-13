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
$con = mysqli_connect('localhost','root','suman','jahanara');
$data_path = 'data/Class-10.xlsx';
$id = 230203;
            if ($xlsx = SimpleXLSX::parse($data_path)) {       
                    foreach($xlsx->rows() as $key=>$value) {
                        // debug($value);
                        $StuId = $id++;
                        $data['roll'] = $value[0];
                        $StuGroup = $value[7]??'General';
                        $fourth = $value[6]??'';
                        $data['StuGroup'] = $StuGroup;
                        $StuName= ucwords($value[1]);
                        $data['StuName'] = $StuName;
                        $FName = ucwords($value[2]);
                        $data['FName'] = $FName;
                        $MName = ucwords($value[3]);
                        $data['MName'] = $MName;
                        $mobile = str_replace('-','',$value[4])??0;
                        $data['mobile'] = $mobile;
                        $data['Religion'] = $value[5];
                        $dataPer['per_address']=[
                            'per_district'=>'Netrokona',
                            'per_upazila'=>'Sadar',
                            'per_post_office'=>'Sadar',
                            'per_village'=>''
                          ];
                        $PerAdd= json_encode($dataPer,JSON_FORCE_OBJECT);

                        // debug($data);
                        $sql="INSERT INTO `stuinfo`(`ID`, `InsID`, `StuYear`, `StuID`, `StuName`, `FName`, `MName`,`mobile`, `DOB`, `Religion`, `Gender`, `PreAdd`, `PerAdd`, `AdmissionDate`,`image`,`entryBy`) VALUES 
                        (null,113139,2023,'$StuId','$StuName','$FName','$MName','$mobile','0000-00-00','$value[5]','Female','$PerAdd','$PerAdd','2023-01-01','','jahanara')";
                        //   echo '<br><br>';
                        $result=$con->query($sql);
                        $sqlClass="INSERT INTO `stuclassinfo`(`ID`, `InsID`, `StuYear`, `ClassName`, `StuID`, `Roll`, `Section`, `Shift`, `StuGroup`, `FourthSub`, `SubjectsTaken`, `PromotionType`,`Status`,`entryBy`) VALUES 
                        (null,113139,2023,'X','$StuId','$value[0]','A','Day','$StuGroup','$fourth','','Admited','Regular','jahanara')";
                        $resultClass=$con->query($sqlClass);
                    }
            }else {
                echo SimpleXLSX::parseError();
            }
                   
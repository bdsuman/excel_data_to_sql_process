<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

</head>
<body>
<div class="card">
    <div class="card-body">
<table id="example" class="table table-striped" style="width:100%">
    <thead>
    <tr>
        <th>SL</th>
        <th>UserId</th>
        <th>Name</th>
        <th>BR</th>
        <th>DOB</th>
        <th>Old</th>
        <th>FatherName</th>
        <th>FatherNid</th>
        <th>MotherName</th>
        <th>MotherNid</th>
        <th>GuardianName</th>
        <th>Shift</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $con = mysqli_connect('localhost','root','suman','eschool_vidamoyee');
    $result = mysqli_query($con,'SELECT *  FROM `admission`');
    foreach ($result as $key=>$row){
        $datetime1 = new DateTime(date('Y-m-d',strtotime($row['dateOfBirth'])));
        $datetime2 = new DateTime("2024-01-01");
        $difference = $datetime1->diff($datetime2);
        $year =$difference->y.' years, '
            .$difference->m.' months, '
            .$difference->d.' days';



        echo '<tr>
                <td>'.++$key.'</td>
                <td>'.$row['userId'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['birthRegistrationNo'].'</td>
               <td>'.date('d-m-Y',strtotime($row['dateOfBirth'])).'</td>
                <td>'.$year.'</td>
                <td>'.$row['fatherName'].'</td>
                <td>'.$row['fatherNid'].'</td>
                <td>'.$row['motherName'].'</td>
                <td>'.$row['motherNid'].'</td>
                <td>'.$row['guardianName'].'</td>
                <td>'.$row['shift'].'</td>
             </tr>';
    }
    ?>

    </tbody>
</table>
</div>
</div>
</body>

<script>
    new DataTable('#example');
</script>

</html>
<?php
include('header.php');
include('database.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="text-align:center">
            <table class="table table-bordered">
                <tr>
                    <th>Number</th>
                    <th>yearMade</th>
                    <th>model</th>
                    <th>currentManager</th>
                    <th>beforeManager</th>
                    <th>carStatus</th>
                </tr>
                <?php
                $sql = "SELECT number, year_made, model,
                max(IF(car_management.date_to >= NOW(), users.name, null)) AS currentManager,
                max(IF(car_management.date_to < NOW(), users.name, null)) AS beforeManager,
                statuses.name AS statusName
                FROM cars
                LEFT JOIN car_management ON car_management.cars_id = cars.id
                LEFT JOIN users ON users.id = car_management.user_id
                LEFT JOIN car_status ON car_status.cars_id = cars.id
                LEFT JOIN statuses ON statuses.id = car_status.status_id
                GROUP BY number, year_made, model, statuses.name";
                $stmt = $dbc->prepare($sql);    
                $stmt->execute();
                $result = $stmt->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($result))
                    {  
                        ?> 
                        <tr>
                            <td><?php echo $row['number'];?></td>
                            <td><?php echo $row['year_made'];?></td>
                            <td><?php echo $row['model'];?></td>
                            <td><?php echo $row['currentManager'];?></td>
                            <td><?php echo $row['beforeManager'];?></td>
                            <td><?php echo $row['statusName'];?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <?php
                }
                else
                {
                    ?>
                    <tr style="text-align:center">
                        <td colspan="7">Irašų nėra</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
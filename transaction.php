<?php
include "dbh.php";
$sql = "SELECT * FROM `transaction`";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);
if ($resultcheck > 0) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sparks National Bank</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="view">
        <button class="button" onclick="location.href='index.html'">HOME</button>
        <section class="display-table">
            <table class='content-table'>
                <caption style="font-size: 2.5em;">Customers</caption>
                <thead>
                    <th>ID</th>
                    <th>SENDER</th>
                    <th>RECIEVER</th>
                    <th>AMOUNT</th>
                    <th>TIME STAMP</th>
                </thead>
                <?php
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rows['tid'];  ?></td>
                            <td><?php echo $rows['Sender']; ?></td>
                            <td><?php echo $rows['Reciever']; ?></td>
                            <td><?php echo $rows['Amount']; ?></td>
                            <td><?php echo $rows['Date_and_Time']; ?></td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
        </section>
    </body>
    <footer class="footer">
        <p>&#169 Copyright - Faris</p>
    </footer>

    </html>
<?php
} else {
    echo "<script>
    window.location.href='admindash.php';
    alert('NO CUSTOMER'S TO DISPLAY!');
    </script>";
    exit();
}
?>
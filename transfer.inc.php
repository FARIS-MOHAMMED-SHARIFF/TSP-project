<?php
    include "dbh.php";
	if(isset($_POST["submitted"]))
	{
        
        $sender = $_POST["sender"];   
        $reciever = $_POST["reciever"]; 
        $amount = $_POST["amount"]; 

        $sender = stripcslashes($sender);  
        $reciever = stripcslashes($reciever);
        $amount = stripcslashes($amount);  

        $sender = mysqli_real_escape_string($conn,$sender);  
        $reciever = mysqli_real_escape_string($conn,$reciever);  
        $amount = mysqli_real_escape_string($conn,$amount);  

        $sql1= "SELECT * FROM `users` where `name`='$sender' " ;
        $result1 = mysqli_query($conn, $sql1);
        $rows1 = mysqli_fetch_assoc($result1);
        $amt1 =  $rows1['balance'] - $amount;

        $conn->next_result();

        $sql2= "UPDATE `users` SET `balance`= '$amt1' WHERE `name`='$sender'";
        $result2 = mysqli_query($conn, $sql2);
        $conn->next_result();

        // $sql3= "SELECT balance FROM `users` where `name`='$reciever' ;" ;
        // $result3 = mysqli_query($conn, $sql3);
        // $amt2 = $result3 + $amount;
        // $conn->next_result();

        // $sql4= "UPDATE `users` SET `balance`='$amt2' WHERE `name`='$reciever'";
        // $result4 = mysqli_query($conn, $sql4);
        // $conn->next_result();
        $sql3= "SELECT * FROM `users` where `name`='$reciever' " ;
        $result3 = mysqli_query($conn, $sql3);
        $rows2 = mysqli_fetch_assoc($result3);
        $amt2 =  $rows2['balance'] + $amount;

        $conn->next_result();

        $sql4= "UPDATE `users` SET `balance`= '$amt2' WHERE `name`='$reciever'";
        $result4 = mysqli_query($conn, $sql4);
        $conn->next_result();


        $sql5= "INSERT INTO `transaction`( `Sender`, `Reciever`, `Amount`) VALUES ('$sender','$reciever','$amount')";
        $result5 = mysqli_query($conn, $sql5);
        $conn->next_result();

        if($result5 && $result2 && $result4){
                    echo "<script>
                    window.location.href='transaction.php';
                    alert('Transaction completed!');
                    </script>";
                    exit();


        }
        else{
                echo "<script>
                window.location.href='transfer.html';
                alert('Kindly fill in the details correctly');
                </script>";
                exit();
                // $message = "ERROR: Could not execute $sql5. " . mysqli_error($conn);
                // echo '<script language="Javascript" type="text/javascript">';
                // echo     'alert('. json_encode($message) .');';
                // echo '</script>';
                // exit();
        }
    }
    else {
        echo "<script>
        window.location.href='transfer.html';
        alert('There was a error!!! ');
        </script>";
        exit();
    }
?>
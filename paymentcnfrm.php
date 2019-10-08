<?php
    require $_SERVER['DOCUMENT_ROOT']."/connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["OrderId"])) {
            $mysqli->query('update orders set
                             verification = "yes",
                             test_notification = "Paid"
                            where id = ' . $_POST["OrderId"] . '
                            ');
        }

    } else {
        if (isset($_SESSION['ordid'])){
            echo "Ваш заказ номер " . $_SESSION['ordid'] . " оплачен. ";
            $mysqli->query('update orders set
                             verification = "yes",
                             test_notification = "Paid"
                            where id = ' . $_SESSION['ordid'] . '
                            ');
            unset($_SESSION['ordid']);
        }
    }
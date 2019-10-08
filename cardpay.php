<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

include 'TinkoffMerchantAPI.php';

$api = new TinkoffMerchantAPI(
    '1564674119737DEMO',  //Ваш Terminal_Key
    'oez8396pzn4eobe8'   //Ваш Secret_Key
);

$sql = 'SELECT * FROM `bankyd` WHERE `id`=1';
$bank = $mysqli->query($sql);
if($bank_row = $bank->num_rows)$bank_res = $bank->fetch_assoc();


        $sum_all=0;

        if (isset($_SESSION['ordid'])){
            $ordid = $_SESSION['ordid'];
            $sql2 = 'SELECT * FROM `shopping` WHERE  ordid = '.$ordid;
            $data = $mysqli->query($sql2);
            $row = $data->num_rows;
            while ($res = $data->fetch_assoc()) {
                $sum_prom = (int)$res['kolvo'] * (int)$res['sum_p'];
                $sum_all += $sum_prom;
            }

        } else {

            if (isset($_SESSION['email'])) {
                if ($_SESSION['email'] != '')
                    if ($_SESSION['email'] != '')
                        $sql2 = 'SELECT * FROM `shopping` WHERE (`email` ="' . $_SESSION['email'] . '" OR `session_id` ="' . session_id() . '") and ordid is null;';
            } else {
                $sql2 = 'SELECT * FROM `shopping` WHERE `session_id` ="' . session_id() . '" and `check`="no";';
            }

            $data = $mysqli->query($sql2);
            $row = $data->num_rows;
            while ($res = $data->fetch_assoc()) {
                $sum_prom = (int)$res['kolvo'] * (int)$res['sum_p'];
                $sum_all += $sum_prom;
            }

            if ($sum_all > 0) {
                $mysqli->begin_transaction();
                $mysqli->query('insert into orders 
                                    (label, notification_type, withdraw_amount,  verification) values
                                    ("' . $_SESSION['email'] . '", "Карта", "' . $sum_all . '",  "no")  
                                    ');
                $ordid = $mysqli->insert_id;
                $mysqli->query('update shopping set ordid = ' . $ordid . ' 
                                where email =  "' . $_SESSION['email'] . '" and ordid is null ');
                $_SESSION['ordid'] = $ordid;
                $mysqli->commit();
            }
        }

        $enabledTaxation = true;

        $params = [
            'OrderId' => $ordid,
            'Amount'  => $sum_all*100,
            'NotificationURL'=>'https://bionika-market.com/paymentcnfrm.php',
            'SuccessURL'=>'https://bionika-market.com/paymentcnfrm.php',
            'DATA'    => [
                'Email'           => $_SESSION['email'],
                'Connection_type' => 'example'
            ],
        ];

//        if ($enabledTaxation) {
//            $params['Receipt'] = $receipt;
//        }

        $api->init($params);
        if ($api->error) : ?>
            <span class="error"><?= $api->error ?></span>
        <?php else:

            header('Location: '.$api->paymentUrl);
            die();
        endif; ?>

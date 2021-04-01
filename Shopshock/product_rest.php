<?php
session_start();
?>
<?php
include_once("class.db.php");
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    echo json_encode(product_list(), JSON_UNESCAPED_UNICODE);
} else if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    echo json_encode(open_bill());
}
function product_list()
{
    $db = new database();
    $db->connect();
    $sql = "SELECT Product_id,Product_code,Product_Name,
                       brand.Brand_name, unit.Unit_name,
                       product.Cost, product.Stock_Quantity
                FROM  product,brand,unit 
                WHERE product.Brand_ID = brand.Brand_id
                and   product.Unit_ID  = unit.Unit_id";
    $result = $db->query($sql);
    $db->close();
    return $result;
}
function open_bill()
{
    //1. check have spme openbill?
    //1.1a no  : create new open_bile
    //1.1b yes : check staus openbill = 1
    //1.1a yes:
    //1.2.1 check product id exist no : add product to bill_detail
    //1.2.2 check product id exist yes: update aty in bill_detail
    //1.1b no:
    $bill_id = "1";
    $step = 1;
    $bill_head = "";
    $bill_detail = "";
    $db = new database();
    $db->connect();
    $sql = "SELECT Bill_id,Bill_status FROM bill WHERE Cus_ID = '{$_SESSION['cus_id']}' ORDER BY Bill_id DESC LIMIT 1";
    $bill_result = $db->query($sql);
    $p_id = $_POST['p_id'];
    $p_qty = $_POST['p_qty'];
    $p_price = $_POST['p_price'];
    if (sizeof($bill_result) == 0) {
        //insert new
        $step = "2:insert new";
        $sql = "INSERT INTO `bill`(`Bill_id`, `Cus_ID`, `Bill_Status`) 
                VALUES ({$bill_id},'{$_SESSION['cus_id']},0)";
        $result = $db->exec($sql);
        $sql = "INSERT INTO bill_detail (Bill_id, Product_ID, Quantity, Unit_Price) 
                VALUES (1,'{$p_id}','{$p_qty}','{$p_price}')";
        $result = $db->exec($sql);
    } else {
        $step = "3: add new item";
        //check [0][0] bill_id
        //      [0][1] bill status
        if ($bill_result[0][1] == 0) {
            // $sql = "SELECT Bill_id, Product_ID FROM bill_detail 
            //         WHERE Bill_id ='{$_SESSION['cus_id']}' 
            //         AND Product_ID = '{$p_id}'";
            // $result = $db->query($sql);
            $sql = "INSERT INTO bill_detail (Bill_id, Product_ID, Quantity, Unit_Price) 
                        VALUES ({$bill_result[0][0]},'{$p_id}','{$p_qty}','{$p_price}')";
            $result = $db->exec($sql);
            // if (sizeof($result) == 0) {
            //     //add new product
            //     $sql = "INSERT INTO bill_detail (Bill_id, Product_ID, Quantity, Unit_Price) 
            //             VALUES ({$bill_result[0][0]},'{$p_id}','{$p_qty}','{$p_price}')";
            //     $result = $db->exec($sql);
            // } else {             
            // }
            // $step="4: update item";
            // //update current item
            // $sql = "UPDATE `bill_detail` SET `Bill_id`={$bill_result[0][0]},`Product_ID`={$p_id},`Quantity`={$p_qty},`Unit_Price`={$p_price} WHERE Product_ID = {$p_id}";
            // $result = $db->exec($sql);
            if ($result == 0) {
                $step = "4: update item";
                $bill_id = $bill_result[0][0];
                $sql2 = "UPDATE `bill_detail` 
                         SET `Quantity`={$p_qty},`Unit_Price`={$p_price} 
                         WHERE Bill_id = {$bill_id} 
                         AND Product_ID = {$p_id}";
                $result = $db->exec($sql2);
                $step = "5: update complete";
            }
            $sql = "SELECT * FROM `bill` WHERE Bill_Id={$bill_result[0][0]}";
            $bill_head = $db->query($sql,MYSQLI_NUM);
            $sql = " SELECT * FROM `bill_detail` WHERE Bill_Id={$bill_result[0][0]}";
            $bill_detail = $db->query($sql,MYSQLI_NUM);
        }
    }
    $db->close();
    return ["step" => $step, "bill" => json_encode($bill_head), "bill_detail" => $bill_detail];
}

?>
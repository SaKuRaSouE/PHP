<?php 
    session_start();
?>
<?php
    include_once("class.db.php");
    if($_SERVER["REQUEST_METHOD"]=='GET'){
        echo json_encode(product_list(),JSON_UNESCAPED_UNICODE);
    }else if($_SERVER["REQUEST_METHOD"]=='POST'){

        echo json_encode(print_r(open_bill()));

    }
    function product_list(){
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
    function open_bill(){
        $db = new database();
        $db->connect();
        //1. check have spme openbill?
        //1.1a no  : create new open_bile
        //1.1b yes : check staus openbill = 1
            //1.1a yes:
                //1.2.1 check product id exist no : add product to bill_detail
                //1.2.2 check product id exist yes: update aty in bill_detail
            //1.1b no:
            $sql = "SELECT Bill_id FROM bill WHERE Cus_ID ="+$_SESSION['cus_id']+" ORDER BY Bill_id DESC LIMIT 1";
            $result = $db->query($sql);
            return $result;

    }
    
?>
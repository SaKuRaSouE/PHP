<?php
 include_once "db.php";
 $debug_mode = false;

if ($_SERVER['REQUEST_METHOD']=='GET'){
     debug_text("GET METHOD Process...",$debug_mode);
    echo json_encode(show_data($debug_mode));
 
}else if ($_SERVER['REQUEST_METHOD']=='POST'){
     debug_text("POST METHPD May be implemnet soon...",$debug_mode);
    //  $message = array ("Status"=>print_r($_POST));
        echo json_encode(add_data($debug_mode));
     echo json_encode($message);
    }else{
     debug_text("Error this site Unsupport This reqest",$debug_mode);
     http_response_code(405);
}
function product_list(){
     $db = new database();
     $db->connect();
     $result = $db->query(" SELECT product.Product_id, product.Product_code, product.Product_Name,
                               unit.Unit_name, brand.Brand_name, product.Cost, product.Stock_Quantity
                             FROM product,unit,brand
                             WHERE product.Unit_ID = unit.Unit_id AND product.Brand_ID = brand.Brand_id");
     $db->close();
     return $result;
 }
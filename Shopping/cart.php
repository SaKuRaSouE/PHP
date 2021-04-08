<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        <?php
						$mysql = new mysqli("localhost", "root", "", "shopshock");
						$mysql->set_charset("UTF8");
						$sql = "SELECT product.Product_code, product.Product_Name, product.Cost , product.Stock_Quantity FROM `product`";
						$result = $mysql->query($sql);
						$rows = $result->fetch_all(MYSQLI_NUM);
                        show_detail();
                        $Total = 99;
                       
                        function show_detail($product_code='11', $product_name='T-Shirt', $price='12', $demand='1', $stock_quantity='5'){
                        ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/home/product2.jpg" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?=$product_name ?></a></h4>
								<p>Product ID : <?= $product_code ?></p>
							</td>
							<td class="cart_price">
								<p><?= $price ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="number" name="quantity" min="1" max="<?=$stock_quantity ?>" value="<?= $demand ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?= $price * $demand ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
                           
						</tr>
                        <?php } ?>
                            <tr><th colspan="6"><center><h1>ToTal <?= $Total ?></h1></center></th></tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
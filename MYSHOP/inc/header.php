 <?php
    // session_start();
    include 'lib/session.php';
    // Session::init();
    ?>
 <?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';
    include 'classes/category.php';
    include 'classes/product1.php';
    include 'classes/user.php';
    include 'classes/customer.php';
    include 'classes/banner.php';
    include 'classes/cart.php';
    include 'classes/comment.php';
    include 'classes/brand.php';
    // spl_autoload_register(function ($className) {
    //     include_once "classes/" . $className . ".php";
    // });
    $comment = new comment();
    $banner = new banner();
    $cus = new customer();
    $db = new Database();
    $fm = new Format();
    $ct = new category();
    $cart = new cart();
    $us = new user();
    $cat = new category();
    $pd = new product1();
    ?>
 <!DOCTYPE HTML>

 <head>
     <title>Store Website</title>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
     <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
     <script src="js/jquerymain.js"></script>
     <script src="js/script.js" type="text/javascript"></script>
     <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
     <script type="text/javascript" src="js/nav.js"></script>
     <script type="text/javascript" src="js/move-top.js"></script>
     <script type="text/javascript" src="js/easing.js"></script>
     <script type="text/javascript" src="js/nav-hover.js"></script>
     <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
     <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script type="text/javascript">
         $(document).ready(function($) {
             $('#dc_mega-menu-orange').dcMegaMenu({
                 rowItems: '4',
                 speed: 'fast',
                 effect: 'fade'
             });
         });
     </script>
 </head>

 <body>
     <div class="wrap">
         <div class="header_top">
             <div class="logo">
                 <a href="index.php"><img src="images/logo.png" alt="" /></a>
             </div>
             <div class="header_top_right">
                 <!-- <div class="search_box">
                     <form>
                         <input type="text" value="Search for Products" onfocus="this.value = '';"
                             onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit"
                             value="SEARCH">
                     </form>
                 </div> -->
                 <div class="shopping_cart">
                     <div class="cart">
                         <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '';
                            } else {
                                echo '
                            <a href="cart.php" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                            ';
                            }
                            ?>
                         <?php
                            $check_Cart = $cart->check_Cart();
                            if ($check_Cart) {
                                $sum = Session::get("sum");
                                echo $fm->format_currency($sum) . "VNĐ ";
                                $qty = Session::get('qty');
                                echo $qty . "Cái";
                            } else {
                                echo "0 VNĐ";
                            }
                            ?>
                         </span>
                         </a>
                     </div>
                 </div>
                 <?php
                    if (isset($_GET['customerId'])) {
                        $delCart = $ct->delAllDataCat();
                        Session::destroy();
                    }
                    ?>
                 <div class="login">
                     <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check == false) {
                            echo '<a href="login.php">Login</a>';
                        } else {
                            echo '<a href="?customerId=' . Session::get('customer_id') . '">Logout</a>';
                        }
                        ?>
                 </div>
                 <div class="clear"></div>
             </div>
             <div class="clear"></div>
         </div>
         <div class="menu">
             <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                 <li><a href="index.php">Home</a></li>
                 <li><a href="products.php">Products</a> </li>
                 <?php
                    $check_cart = $cart->check_Cart();
                    $login_check = Session::get('customer_login');
                    if ($login_check == false) {
                        echo '';
                    } elseif ($check_Cart == true) {

                        echo '
                 <li><a href="cart.php">Cart</a></li>
                        ';
                    } else {
                        echo '';
                    }
                    // echo '
                    // <input type="submit" class="buysubmit" name="compare" value="Compare Product" /> <br>
                    // ';



                    ?>

                 <li><a href="contact.php">Contact</a> </li>

                 <?php
                    $login_check = Session::get('customer_login');
                    if ($login_check == false) {
                        echo '';
                    } else {
                        echo "<li><a href='profile.php'>Profile</a> </li>";
                    }

                    ?>
                 <?php
                    $customer_id = Session::get('customer_id');

                    $check_order = $cart->check_order($customer_id);
                    if ($check_order == false) {
                        echo '';
                    } else {
                        echo "<li><a href='orderdetails.php'>My Order</a> </li>";
                    }

                    ?>
                 <?php
                    $login_check = Session::get('customer_login');
                    if ($login_check == false) {
                        echo '';
                    } else {
                        echo '<li> <a href="compare.php">Favorite product</a></li>';
                    }


                    ?>

                 <div class=" clear">
                 </div>
             </ul>
         </div>

<?php
echo'

    <header>
        <div class="nav">
            <div class="flex">
                <div class="img">
                    <h2>I-Wears</h2>
                </div>
                <div class="menu">
                    <ul class="nav-items">
                        <li><a href="/I-Wears/iwear.php">Home</a></li>
                            <li><a href="/I-Wears/about.php">About</a></li>
                            <li><a href="/I-Wears/product.php">Products</a></li>
                           <li> <a href="/I-Wears/contact.php">Contact-Us</a> </li> 
                    
                        
                       ';
                       if(!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin']!=true){
                           
                           echo'
                           </ul>
                </div>
                           
                           <div class="login_signup_Btn">
                            <button class="login_btn"><a href="/I-Wears/partials/login.php">LOGIN</a></button>
                            <button class="signup_btn"><a href="/I-Wears/partials/signup.php">SIGNUP</a></button>
                           </div>';
                           
                        }
                        else{	
                            
                            $user = $_SESSION['user'];
                                        include "./php/database.php";
                                    
                                        $sql = "SELECT *
                                                FROM `usercart` 
                                                WHERE `users` =  '" . $user["id"] . "'";
                                                
                                        $query = mysqli_query($conn, $sql); 
                                       $mycartcount = mysqli_num_rows($query);
                                       
                                       $sql2 = "SELECT *
                                       FROM `wishlist` 
                                       WHERE `user` =  '" . $user["id"] . "'";
                                       
                               $query2 = mysqli_query($conn, $sql2);
                              $mywishlistcount = mysqli_num_rows($query2);
                        
                        echo'
                        
                                        <li><a>My Account <i class="fas fa-caret-down"></i></a>
                                                    <div  class="nav-dropdown">
                                                                    <ul>
                                                                        <li class="myaccDropDownLists"><a href="myprofile.php">My Profile</a></li>
                                                                        <li class="myaccDropDownLists"><a href="mycart.php">My Cart</a></li>
                                                                        <li class="myaccDropDownLists"><a href="logout.php">Log Out</a></li>
                                                                    </ul>
                                                    </div>
                                        </li> 
                        </ul>
                        </div>
                        <div class="cart_wishlist_icon">
                            <a href="./wishlist.php"><i class="fa-solid fa-rectangle-list"></i>('.$mywishlistcount.')</a>
                            <a href="./mycart.php"><i class="fa-solid fa-cart-plus"></i>('.$mycartcount.')</a>
                        </div>
                        ';
                                    
                                    }

                                        echo'
                                       
                                   
                        
            </div>
           
        </div>
    </header>  
';
?>


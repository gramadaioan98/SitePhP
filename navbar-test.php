    <div class="navbar-container"> 

    <div class="navbar">
    <div class="navbar-left">
        <!-- <div class="navbar-right-item"> 
    <!-- <img src="images/search.png" style="width:22px;
    
    position:relative;
    top:6px;
    ">  
    <input  type="text" placeholder="Search..
    
    " name="search"> -->
        </div> -->

    </div>
    <div class="navbar-right">
    <b> 
    <ul>
   
    <li class="navbar-item" id="Logout"><a href="logout.php"> Logout </a></li>
    <li class="navbar-item"><a href="home.php"> Home </li></a>
   <li class="navbar-item"> <a href="shoppingCart.php"> Shopping Cart </a></li>
    <li class="navbar-item"><a href="contact.php"> Contacts </a></li>
    <li class="navbar-item"><a href="Market.php"> Market </a> </li>
    <li class="navbar-item" id="SignUp"><a href="signup.php"> Sign Up </a> </li>
    <div  class="nameBar"><li >  <?php  if($_SESSION['login'] ===0 )
                    {   echo   'Guest!';
                        
                    }
                    else
                    {
                        echo ''.$_SESSION['name'];
                    }
    
     ?></li>
     </div>

    </ul></b>
    <ul>
    <li class="navbar-item2" id="Logout"><a href="logout.php"> L </a></li>
    <li class="navbar-item2"><a href="home.php"> H </li></a>
   <li class="navbar-item2"> <a href="shoppingCart.php"> SC </a></li>
    <li class="navbar-item2"><a href="contact.php"> C </a></li>
    <li class="navbar-item2"><a href="Market.php"> M </a> </li>
   
</ul>


    </div>

    </div>







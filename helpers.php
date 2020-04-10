<?php 


function printLogout()
{
    echo '<style>';
    echo '#Logout {display:none;}';
    echo '</style>';

}
function printSession() {
    echo '<hr>';
    echo '<h3> SESSION </h3>';
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
}

function printSignUp()
{
    echo '<style>';
    echo '#SignUp {display:none;}';
    echo '</style>';

}
function printAdmin()
{
    echo '<style>';
    echo '.admin {display:block;}';
    echo '</style>';
}
 function stock( $stock)
 {
    if($stock==0)
    
    echo '<b style="color:red; font-family:Courier;font-size: 14px;"> Stoc indisponibil</b>';
    else
    echo '<b style="color:green;font-family:Courier;font-size: 14px;"> Stoc disponibil</b>';
   
 }
 function stock1( $stock)
 {
    if($stock===0){
    // echo '<b style="color:red; font-family:Courier;font-size: 14px;"> Stoc indisponibil</b>';
    return false;
    }
    else
    { 
        //echo '<b style="color:green;font-family:Courier;font-size: 14px;"> Stoc disponibil</b>';
    return true;
    }
 }



 function getProductByID($products,$val)
 {
    foreach($products as $product)
    {       
        if($product->getId()===intval($val)){
            return $product;
    }
    }
     return null;     //------------de ce se pune null-------------

 }



?>


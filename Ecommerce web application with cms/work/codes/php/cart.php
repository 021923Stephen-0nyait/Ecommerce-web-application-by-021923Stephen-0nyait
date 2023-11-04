<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!---Link for social media icons-->
<!--- STYLING THE CART PAGE-->
<style>
  .cart{
    width: 100%;
  }

  h1{
    text-transform: uppercase;
    letter-spacing: 3px;
  }

  .cart .fa{
    font-size: 40px;
  }

  .cart .fa:hover{
    background: none;
  }


</style>

<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->
<?php
    include 'common.php';
    outputheader("Home");
    outputnav("cart") 
?>
<title>Cart</title>

<!-- Adding a DIV named CART, with a header-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/work/codes/css/cart.css">
<!DOCTYPE html>

<html>
    <body>
        <div class="cart">
          <h1 style="text-align: center;">Your cart<i class="fa fa-shopping-cart"></i></h1>
          <p id="cart_items"></p>
          <div id="basketDiv" hidden></div>
          <div class="checkout"><button onclick="checkoutUpdates();showRecommendation()"> Checkout</button></div>
          <div class="basket"><button onclick='clearBasket(); emptyBasket()'>Empty Basket</button></div>
          <div id="checkOutput"></div>
          <div id="ReccomendThis" hidden></div>
        </div>
    </body>
    <script>
        let outputof = JSON.parse(sessionStorage.basket)
        let details = " "

        for(let i=0; i<outputof.length; ++i){
            details+=outputof[i].name
            details+=" "
            details+=outputof[i].count
            details+=" "
            details+=outputof[i].price
            details+="</br>"
            
        }
        document.getElementById("cart_items").innerHTML = details
    </script>

</html>
<?php
  outputfooter() 
?>


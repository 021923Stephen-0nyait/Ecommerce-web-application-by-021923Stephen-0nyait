<style>   /**STYLING THE NAVIGATION BAR AND FOOTER USING CSS  */
  *{
    margin: 0;
    padding: 0;
  }
  /**STYLING THE NAVIGATION BAR */
 /**position the navigation bar with a transpareny background and placing the logo of the website */
  #navbar{
    width: 100%;
    height: 15vh;
    margin: auto;
    display: flex;
    align-items: center;
  }

  #logo{
    width: 160px;
    cursor: pointer;
  }

  #icon_nav{
    height: 20px;
    width: 20px;
  }

  #logo1{
    position: absolute;
    width: 200px;
    cursor: pointer;
    left: 0px;
  }

  nav{
    flex: 1;
    padding-left: 10px;
  }
  
  nav ul li{
    display: inline-block;
    list-style-type: none;
    margin: 2px 20px;
  }
  
  nav ul li a{
    text-decoration: none;
    color: #333;
  }

  .dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 2px 10px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: white;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 1px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}

  /**Position the model and using transition and transform so that when it hovers, the model moves on the x-axis to the left by 20px */
  .model{
    height: 90%;
    position: absolute;
    bottom: 0px;
    right: 90px;
    transition: transform 0.5s;
  }

  .model:hover{
    transform: translateX(-20px);
  }

    /**creating container to add a background image to the age */
  #home_container{
    height: 100vh;
    width: auto;
    padding-right: 0%;
    padding-left: 0%;
    box-sizing: border-box;
    position: relative;
    background-image: url("/work1/img/bg4.png");
    background-position: center;
    background-size: cover;
  }

  /** FOOTER STYLING */
  .footer{
    margin: 0;
    padding: 0;
    background-color: #E3CDC7;
  }

  .container{
    max-width: 1170px;
    margin: auto;
  }

  .row{
    display: flex;
    flex-wrap: wrap;
  }

  ul{
    list-style: none;
  }

  .footer{
    padding: 25px 0;
  }

  .footer-col{
    width: 22%;
    padding: 0 17px;
  }

  .footer-col h4{
    font-size: 18px;
    color: #A25736;
    text-transform: capitalize;
    margin-bottom: 35px;
    font-weight: 500;
    position: relative;
  }

  .footer-col ul li:not(:last-child){
    margin-bottom: 10px;
  }

  /** Social media icons for the footer */
  
  .fa-facebook, .fa-twitter, .fa-twitter, .fa-instagram, .fa-snapchat-ghost{
    padding: 10px;
    font-size: 20px;
    width: 20px;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    border-radius: 60%;
    background: #E3CDC7;
    color: black;
  }

  .fa-facebook:hover, .fa-twitter:hover, .fa-twitter:hover, .fa-instagram:hover, .fa-snapchat-ghost:hover{
      opacity: 0.4;
      color: #24262b;
	    background-color: #ffffff;
  }

  #footerbottom{
    margin-top: 30px;
    color: maroon;
  }

  /** staff login link on the footer  */
  .staff_login{
    position: absolute;
    right: 310px;
    margin-top: 140px;
    color: #A25736;
    text-decoration: none;
  }
  .search{
    position: absolute;
    right: 10px;
    top: 40px;
  }

  #productSearch{
    padding: 6px;
    font-size: 17px;
    border-color: rgba(175, 126, 126, 0.606);
    border-radius: 15px;
    
  }

  #submitBtn{
    background: rgba(221, 221, 221, 0);
    color: rgb(174, 155, 131);
    font-size: 20px;
    border: none;

  }

  #submitBtn:hover {
    color: rgba(175, 126, 126, 0.905);
  }

</style>


<?php


# php function to output header, that is the title of each page (all the duplicated codes of all the other pages) 

function outputheader($title){  

  echo '<!DOCTYPE html>  
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>'.$title.' Page</title>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <script src="basket.js"></script>
  
  
  </head>
  <body>
  ';}


  // function to output the navigation bar using associative array, assigning each page name to its link
  // Then comparing whether the current page is equal to the page name clicked by the user,
  // if current page is equal to page name selected by the user, it stays on the same page,
  // else it redirects the user to the page he/she selected,
  // then this page becomes the current page and so on...

function outputnav($currentpage){
    echo '
    <div id="home_container">
    <div id="navbar">
      <img src="/work1/img/logo1.png" id="logo">
      <nav>
            <ul>
            <li><a href="home.php"><img src="/work/img/home.png" id="icon_nav"></a></li>

            <div class="dropdown">
            <button class="dropbtn"><img src="/work/img/account.png" id="icon_nav"><i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="profile.php">Profile</a>
              <a href="Login.php">Register</a>
              <a href="logout.php">Logout</a>
            </div>
          </div> 
            <li><a href="cart.php"><img src="/work/img/cart.png" id="icon_nav"></a></li>

            </ul>
      </nav>
     </div>';
  
  }

  // function to output the footer of the page
function outputfooter(){
  echo '<footer class="footer">
  <img src="/work1/img/logo1.png" id="logo1">
  	 <div class="container">
  	 	<div class="row">
  	 		<div class="footer-col">
  	 			<h4>About us</h4>
  	 			<ul>
  	 			<p>Our mission is to make shirts <br>which help people to express<br> themselves</p><br>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>get help</h4>
  	 			<ul>
  	 				<li>FAQ</li>
  	 				<li>Shipping</li>
  	 				<li>Returns</li>
  	 				<li>Order status</li>
  	 				<li>Payment options</li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>Contact Us</h4>
  	 			<ul>
  	 				<li>shop.Gateway@gmail.com </li>
  	 				<li>(+230) 465 1009</li>
  	 				<li>72, Avenue Buswell,</li>
  	 				<li>Based in Quatre Bornes</li>
            <li>Mauritius</li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>follow us</h4>
  	 			<div class="social-links">
           <a href="#" class="fa fa-facebook"></a>
           <a href="#" class="fa fa-twitter"></a>
           <a href="#" class="fa fa-instagram"></a>
           <a href="#" class="fa fa-snapchat-ghost"></a>
  	 			</div>
  	 		</div>
         <a href="../cms/php/StaffLogin.php" class="staff_login">Are you a staff? Login</a>
  	 	</div>
       
  	 </div>
     <div id="footerbottom"><p style="text-align: center;">Copyright &copy; 2022 Gateway Designed by <span>NEESHITHA RAMNEEHORAH & STEPHEN ONYAIT</span></p></div>
  </footer>

    </body>
    </html>
  ';
}

function outputSearch(){
  echo'
  <div class ="search">
    <input type="text" placeholder="Search.." name="name" id="productSearch">
    <button id="submitBtn" onclick="searchresults(); addKeywords()"><i class="fa fa-search" ></i></button>
  </div>
  ';
  
}
?>

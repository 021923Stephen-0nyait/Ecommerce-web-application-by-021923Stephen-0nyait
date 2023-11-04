<style> /** STYLING OF NAV BAR OF THE CMS PAGES*/
  *{
  padding: 0px;
  margin: 0px;
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

  .navbar{
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

#pic{
  background-size: cover;
  width: 100%;
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

#icon_nav{
    height: 20px;
    width: 20px;
  }

</style>


<?php

# php function to output header, that is the title of each page, and the nav bar 
# with link for each page of the CMS (all the duplicated codes of all the other pages) 

function outputheader_and_navbar($title){  
  
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

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Crete+Round&family=DM+Sans&display=swap" rel="stylesheet">
  
  
  </head>
  <body>
  
  <div class="navbar">
    <img src="/work1/img/logo1.png" id="logo">
  <nav>

    <ul>
      <li><a href="../php/cms_home.php">Home</a></li>

      <div class="dropdown">
        <button class="dropbtn"><img src="/work/img/account.png" id="icon_nav"><i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="../php/StaffLogin.php">Login</a>
          <a href="../php/logout.php">Logout</a>
        </div>
      </div> 

      <li><a href="../php/addproduct.php">Add Product</a></li>
      <li><a href="../php/viewproduct.php">View Product</a></li>
      <li><a href="../php/editproduct.php">Edit Product</a></li>
      <li><a href="../php/vieworder.php">View Customer Order</a></li>
      <li><a href="../php/deleteorder.php">Delete Customer Order</a></li>
    </ul>

  </nav>

</div>

  ';}
  #<li><a href="/work1/codes/php/Home.php">Home</a></li>

  
<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->

<?php
        include 'common_cms.php';
        outputheader_and_navbar("Home") 
?>

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above-->

<title>Staff Login Page</title>
<link rel="stylesheet" href="../css/staff_loginpage.css">

</head>

<body>

<!-- Adding a header using style to align the header in the center of the page 
and using form to add some input fields for the staff to login -->

<h1 style="text-align: center">STAFF LOGIN PAGE</h1>
  <div class="loginform">

    <form action="checkLogin.php" method="post">
      <i class="fa fa-user-circle"></i>
      <input type="text" id="text" name="text" placeholder="User ID">
      <input type="password" id="password" name="password" placeholder="Password">
      <input type="submit" name="" placeholder="Sign Up">

    </form>

  </div>


  
</body>
</html>
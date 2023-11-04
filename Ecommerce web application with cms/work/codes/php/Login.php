<!-- Linking css file and adding a title to the page 
which will be pass along the php function above -->
<title>Registration</title>
<link rel="stylesheet" href="/work/codes/css/LoginPageStyling.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  <!---Link for social media icons-->
</head>
    <body>
        <!-- Calling php function to output navigataion bar 
            and it pass along the page title  -->
        <?php
            include 'common.php';
            outputnav("Login");
        ?>

            <!-- Login and signup button on top of the form each having a function once one of the button is pressed  -->
            <div class="user-form">
                <div class="login-buttons">
                    <div id="btn"></div>
                    <button type="button" class="our-buttons" onclick="sign_in()">LOG IN</button>
                    <button type="button" class="our-buttons" onclick="sign_up()">SIGN-UP</button>
                    
                </div>
                
                <!-- Login form that dispalys the logo of the website, and input-fields for the user to login  -->
                <div id="login" class="input-group">
                    <div class="center"><img src="/work/img/logo1.png" class="logo_form"></div>
                    <div id="login_user">
                        <input type="email" class="input-field" id="login_mail" placeholder="Email Address" required>
                        <input type="password" class="input-field" id="login_password" placeholder="Enter Password" required>
                        <button type="submit" class="submitting" onclick="logining()"> LOG IN</button>
                        <div><p style="color: red" id="ErrorMessages"></p></div>   
                    </div>  
                            
                </div>

                <!-- input-fields for the user to signup  -->
                <div id="register" class="input-group" >
                    <input type="text" class="input-field" id="signup_Fname" placeholder="First Name" required>
                    <input type="text" class="input-field" id="signup_Lname" placeholder="Last Name" required>
                    <input type="email" class="input-field" id="signup_mail" placeholder="Email" required>
                    <input type="text" class="input-field" id="signup_street" placeholder="Street" required> 
                    <input type="text" class="input-field" id="signup_city" placeholder="City" required>
                    <input type="text" class="input-field" id="signup_country" placeholder="Country" required>
                    <input type="number" class="input-field" id="signup_zip" placeholder="ZIP Code" required> 
                    <input type="tel" class="input-field" id="signup_num" placeholder="Phone Number" required>
                    <input type="password" class="input-field" id="signup_password" placeholder="Enter Password" required> 
                    <button type="submit" class="submitting" onclick="registering()">SIGN UP</button>
                    <p>
                       <span id="ServerResponse"></span>
                    </p>             
                </div>
            </div>

            <!-- displays a model image  -->
            <img src="/work/img/girl2.png" class="model">

            <!-- Linking javascript file  -->
            <script>
                let userLogin = document.getElementById("login");
                let userRegister = document.getElementById("register");
                let colorMove = document.getElementById("btn");

                function sign_up(){
                    userLogin.style.left ="-400px";
                    userRegister.style.left ="50px";
                    colorMove.style.left ="110px";
                }
                function sign_in(){
                    userLogin.style.left ="50px";
                    userRegister.style.left ="450px";
                    colorMove.style.left ="0px";
}
            </script>
        </div>

        <!-- php function that outputs the footer-->
        <?php
            outputfooter() 
        ?>
    </body>
    <script>
    function registering(){
        //Create request object 
        let request = new XMLHttpRequest();

        //Create event handler that specifies what should happen when server responds
        request.onload = () => {
            //Check HTTP status code
            if(request.status === 200){
                //Get data from server
                let responseData = request.responseText;
                console.log(responseData)
                //Add data to page
                document.getElementById("ServerResponse").innerHTML = responseData;
                let first_name = document.getElementById("signup_Fname").value="";
                let last_name = document.getElementById("signup_Lname").value="";
                let email = document.getElementById("signup_mail").value="";
                let street = document.getElementById("signup_street").value="";
                let city = document.getElementById("signup_city").value="";
                let country= document.getElementById("signup_country").value="";
                let zip = document.getElementById("signup_zip").value="";
                let tel_no = document.getElementById("signup_num").value="";
                let password = document.getElementById("signup_password").value="";
            }
            else
                alert("Error communicating with server: " + request.status);
                let first_name = document.getElementById("signup_Fname").value="";
                let last_name = document.getElementById("signup_Lname").value="";
                let email = document.getElementById("signup_mail").value="";
                let street = document.getElementById("signup_street").value="";
                let city = document.getElementById("signup_city").value="";
                let country= document.getElementById("signup_country").value="";
                let zip = document.getElementById("signup_zip").value="";
                let tel_no = document.getElementById("signup_num").value="";
                let password = document.getElementById("signup_password").value="";
        };

        //Set up request with HTTP method and URL 
        request.open("POST", "registration.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        //Extract registration data
        let first_name = document.getElementById("signup_Fname").value;
        let last_name = document.getElementById("signup_Lname").value;
        let email = document.getElementById("signup_mail").value;
        let street = document.getElementById("signup_street").value;
        let city = document.getElementById("signup_city").value;
        let country= document.getElementById("signup_country").value;
        let zip = document.getElementById("signup_zip").value;
        let tel_no = document.getElementById("signup_num").value;
        let password = document.getElementById("signup_password").value;

        //Send request
        request.send("&signup_Fname=" + first_name + "&signup_Lname=" + last_name + "&signup_mail=" + email + "&signup_street=" + street + "&signup_city=" + city+ "&signup_country=" + country + "&signup_zip=" + zip + "&signup_num=" + tel_no + "&signup_password=" + password);
        
        }

    </script>

<script>
    let loggedInStr = "Logged in <button onclick='logout()'>Logout</button>";
    let loginStr = document.getElementById("login_user").innerHTML;
    let request = new XMLHttpRequest();

    window.onload = checklogin(); //when page loads , run method checklogin

    function checklogin() {
   
    //Create event handler that specifies what should happen when server responds
        request.onload = () => {
            //Check HTTP status code
            if(request.responseText === "ok"){
                document.getElementById("login_user").innerHTML = loggedInStr;
            }
            else{
                console.log(request.responseText);
                document.getElementById("login_user").innerHTML  = loginStr;
            }
    };
    //Set up and send request
    request.open("GET", "check_login.php");
    request.send();
    }

    function logining() {

        //Create event handler that specifies what should happen when server responds
        let request = new XMLHttpRequest();
        request.onload = () => {
            //Check HTTP status code
            if(request.status === 200) {
                //Get data from server
                var responseData = request.responseText;

            //Add data to page
                if(responseData === "ok"){
                        document.getElementById("login_user").innerHTML = loggedInStr;
                        document.getElementById("ErrorMessages").innerHTML = "";//Clear error messages
                        let email1 = document.getElementById("login_mail").value="";
                        let password1 = document.getElementById("login_password").value="";
                    }
                    else
                        document.getElementById("ErrorMessages").innerHTML = request.responseText;
                        let email1 = document.getElementById("login_mail").value="";
                        let password1 = document.getElementById("login_password").value="";
                }
                else
                    document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
                    let email1 = document.getElementById("login_mail").value="";
                    let password1 = document.getElementById("login_password").value="";
            };

        //Extract registration data
        let email1 = document.getElementById("login_mail").value;
        let password1 = document.getElementById("login_password").value;

        //Set up request with HTTP method and URL 
        request.open("POST", "Login_page.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        //Send request
        request.send("Email=" + email1 + "&Password=" + password1);
    }

//Logs the user out.
    function logout(){
        //Create event handler that specifies what should happen when server responds
        request.onload = function(){
            checklogin();
        };
        //Set up and send request
        request.open("GET", "logout.php");
        request.send();
    }

</script>
    </body>
</html>
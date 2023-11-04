<!-- Linking css file and adding a title to the page 
which will be pass along the php function above -->
<title>Registration</title>
<link rel="stylesheet" href="LoginPageStyling.css">
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

                <!-- Login form that dispalys the logo of the website, and input-fields for the user to login  -->
                <div id="login" class="input-group" >
                    <p id=login_user>
                        <input type="email" class="input-field" id="login_mail" placeholder="Email Address" required>
                        <input type="password" class="input-field" id="login_password" placeholder="Enter Password" required>
                        <button type="submit" class="submitting" onclick="logining()"> LOG IN</button>   
                    </p>  
                    <p style="color: red" id="ErrorMessages"></p>          
                </div>


            </div>

            <!-- displays a model image  -->


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
                        }
                        else
                            document.getElementById("ErrorMessages").innerHTML = request.responseText;
                    }
                    else
                        document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
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
                checkLogin();
            };
            //Set up and send request
            request.open("GET", "logout.php");
            request.send();
        }

    </script>
    </body>
</html>
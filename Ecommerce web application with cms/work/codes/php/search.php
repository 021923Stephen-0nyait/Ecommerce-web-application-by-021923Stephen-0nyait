<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!---Link for social media icons-->

    <!-- Linking css file and adding a title to the page 
    which will be pass along the php function above -->

    <title>Search page</title>
    <link rel="stylesheet" href="/work/codes/css/home.css">
    <link rel="stylesheet" href="search.css">
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;                
                width: 950px;
                text-align: center;
            }
            .toleft{
                position: relative;
                left: 270px;
                
            }
        </style>
</head>
    <body>
        <div class="contain">
            <div class="main">
                <?php
                        include 'common.php';
                        outputnav("Home")
                ?>
                <?php
                    outputSearch() 
                ?>
                <div><h1>SEARCH RESULTS:</h1></div>
                <div id="thingsFound">
            </div>
        </div>
        <footer>
            <?php
                outputfooter() 
            ?>
        </footer>
    </body>



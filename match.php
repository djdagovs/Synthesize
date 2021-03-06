<?php
session_start();
?>
<html>
<head>
    <title>Match</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="styles/synthesize_home_styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/processing.js/1.6.3/processing.min.js"></script>

  <style>
        #matchTitle img {
            width:225px;
            margin-top:40px;
          }
        .cuteform-elt.cuteform-selected {
            border-width: 4px;
            border-style: solid;
            border-color: white;
        }
        .header-temp{
            color:#82caed;
            font-family: 'Letter Gothic Std';
            font-size: 19pt;
            text-align:center;
            opacity:0.7;
        }
        .header-temp-body {
            color:#ed82ca;
            font-family: 'Letter Gothic Std';
            font-size: 15pt;
            opacity:0.7;
            font-weight:900;
        }
        .header-temp-body-col {
            color:#ed82ca;
            font-family: 'Letter Gothic Std';
            font-size: 13pt;
            width: 100%;
            opacity:0.7;
        }
        #inputURL {
            width:250px;
            height: 30px;
            opacity:0.8;
            border: 1px solid #82caed;
            background:none;
            font-family: 'Letter Gothic Std';
            font-size: 12pt;
            padding: 2px;
            color: #82caed;
            padding-left: 7px;

        }

        #inputURL {
            position: relative;
            margin-left:50px;
        }


        #submit {width: 250px;
            height: 30px;
            border: none;
            background:none;
            font-family: 'Letter Gothic Std';
            font-size: 12pt;
            padding: 2px;
            color: #82caed;
            /*margin-left:930px;*/
            opacity: 0.7;
            margin-left: 60px;}

        #submit:hover {width: 250px;
            height: 30px;
            border: none;
            background:none;
            font-family: 'Letter Gothic Std';
            font-size: 12pt;
            padding: 2px;
            color: #82caed;
            cursor:pointer;
            font-style: italic;
            opacity: 1;
            margin-left: 60px;
        }      #canvass{
                overflow: hidden;
                width:100%;
                border:none;
                height:100%;
                position:absolute;
                z-index:-1;
            }

    </style>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-93512293-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body style="margin:0;">
  <canvas id="canvass" data-processing-sources="portfoliobg.pde" >

  </canvas>

<div id="nav">


<ul>
    <li><a href="temphome.php">Home</a></li>
    <li><a href="match.php">Match</a></li>
    <li><a href="synthesize_home.php">Profile</a></li>

    <li><a href="explore.php">Explore</a></li>
    <li><a href="about.php">About</a></li>
    <?php
    if($_SESSION['admin'] == "yes") {
        echo "<li><a href='admin/search.php'>Admin</a></li>";
    }

    ?>
    <?php

    if($_SESSION["loggedin"] == "yes") {
        echo "<li><a href='logout.php'>Logout</a></li>";
    } else {
        echo "<li><a href='login2.php'>Login</a></li>";
    }

    ?>


</ul>
    </div>

<div id="outercontainer">
    <center>


    <div id="matchTitle">
        <img src="assets/home/match_title.png"/>
    </div>

        <?php
        // LATER: FOR SECURITY
        // require_once('db_credentials.php');
        // $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to mySQL: " . mysqli_connect_errno();
            exit();
        }
        ?>
        <div style="margin: 50px 0 50px 0"></div>
        <div style="margin: 50px 0 50px 0"></div>
        <div style="margin: 50px 0 50px 0"></div>
        <!--  STEP 1: pick a processing sketch to be loaded into the visualization  -->
        <div class="header-temp" style="text-align:center;">Step 1: Select a Visualization</div>
        <form action="loadSketch.php">
            <!--    <form action="loadSketch.php">-->
            <div style="margin-left:auto;margin-right:auto;text-align:center">
                <select class="test" name="sketch" data-cuteform="true">
                    <?php
                    $sql = "SELECT * FROM Sketches";
                    $results = mysqli_query($conn, $sql);
                    if(!$results) {
                        echo "Your SQL: " . $sql . "<br><br>";
                        echo "SQL Error: " . mysqli_error($conn);
                        exit();
                    }
                    while($currentrow = mysqli_fetch_array($results)) {
                        $thumbnail = $currentrow['thumbnail'];
                        $name = $currentrow['name'];
                        echo "<option value='" . $name . "' data-cuteform-image='assets/SketchThumbnails/" . $thumbnail . "'></option>";
                    }
                    ?>
        </select>
            <div style="margin: 50px 0 50px 0"></div>
        </div>
        <div class="header-temp" style="text-align:center;">Step 2: Enter a Soundcloud URL</div>
        <br><div style="margin-bottom:7px;"></div>
<!--        https://soundcloud.com/djxyz/miguel-do-you-cashmere-cat-remix-with-extra-vocals-->
        <div class="header-temp-body">Don't have a URL? Try this one! </div><div style="margin-bottom:7px;"></div>
        <p class="header-temp-body-col"><em>https://soundcloud.com/djxyz/miguel-do-you-cashmere-cat-remix-with-extra-vocals</em></p>
<br><br>
        <center>
        <input id="inputURL" type="text" name="inputURL" placeholder="URL"><br>
            <div style="margin-bottom:7px;"></div>
    <input id="submit" type="submit" value="Generate Visualization">
</center>
    </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="scripts/cuteform.min.js"></script>
</body>
</html>

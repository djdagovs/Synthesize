
<html>
<head>
    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">


    <link href="styles/adminstyles.css" rel="stylesheet">

</head>


<body style="background-color: #201d1b;
             font-family: 'Letter Gothic Std';
			">
<a href="search.php"><img src = "assets/back-04.png" id="back"></a>


<center>

    <div id="outercontainer">


        <div id="mainHead">

            <div id="logo">
                <img src="main_logo.png"/>
            </div>


            <?php

            $conn = mysqli_connect("uscitp.com","jahaberm","8787266053", "jahaberm_synthesize");

            if(mysqli_connect_errno()){
                echo "the error is " . mysqli_connect_errno()."";
                exit();

            }

            $sql = " SELECT * FROM Sketches";



            $results = mysqli_query($conn, $sql);

            if(!$results) {
                echo "SQL: " . $sql;                    // this shows you sql you tried to submit
                echo "db error ".mysqli_error($conn);   // notice $conn and NOT $results inside mysqli_error()
                exit();
            }


            ?>



<div id="results">
            <?php
            while($currentrow = mysqli_fetch_array($results)) {


                echo "<div class='firstname'>" .  $currentrow['name'] . "</div>" .
                    " <div class='lastname'><a href = 'sketchedit.php?id=" .
                    $currentrow['id_sketch'] .
                    "'>[Edit]</a>" .
                    " <a href = 'sketchdelete.php?id=" .
                    $currentrow['id_sketch'] .
                    "'>[Delete]</a>" .
                    " <a href = 'sketchadd.php?id=" .
                    $currentrow['id_sketch'] .
                    "'>[Add]</a>" .
                    "</div>"  .
                    "<br style='clear:both;'>";
            }
            ?>

</div>



        </div><!-- close outercontainer -->
        <!---->
        <!---->


        <?php
        //
        //session_start();
        //
        //if ($_SESSION['loggedin'] == 'yes'){
        //    include "synthesize.php";
        //} else {
        //
        //    if (empty($_REQUEST['username']) || empty($_REQUEST['password'])) {
        //        echo "<form action ='login2.php' method='post'> Username: <input id='user' type='text' name='username'> Password: <input id='pass' type='text' name='password'><input type='submit'></form>";
        //        exit();
        //    }
        //
        //
        //    // LATER: FOR SECURITY
        //    // require_once('db_credentials.php');
        //    // $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        //    $conn = mysqli_connect("uscitp.com", "jahaberm", "8787266053", "jahaberm_synthesize");
        //
        //    if (mysqli_connect_errno()) {
        //        echo "Failed to connect to mySql: " . mysqli_connect_errno();
        //        exit();
        //    }
        //    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
        //    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
        //
        //    $sql = "SELECT user_id FROM User WHERE username = '$myusername' and password = '$mypassword'";
        ////    echo $sql;
        //    $results = mysqli_query($conn, $sql);
        //
        ////    echo mysqli_num_rows($results);
        //
        //
        //    if (!$results) {
        //        echo "SQL error " . mysqli_error($conn);
        //    }
        //
        //    if (mysqli_num_rows($results) == 1) {
        //        $_SESSION['loggedin'] = 'yes';
        //        include "synthesize.php";
        //    } else{
        //        echo "<form action ='login2.php' method='post'> Username: <input type='text' name='username'> Password: <input type='text' name='password'>
        //<input type='submit'></form>";
        //        exit();
        //    }
        //}
        //
        //?>
</center>
</body>
</html>








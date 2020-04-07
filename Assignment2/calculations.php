<?php
$con = mysqli_connect("localhost", "root", "", "practise"); 


if (isset($_POST['buttonPRESS'])) {
    
    if($con->connect_error){
        die("Failed");
    }
  

    //var_dump($_POST);
    if($_POST["Given:"]=="MF"){
        
        // Mass and Force were selected. So now I only need two things
        // Check what values are in the boxes, and multiply/divide them with the next thing

        // So have to check nf_unit
       



        // Solving for nf_unit
        $sql = "SELECT * FROM nf_unit WHERE unit='".$_POST["nf_unit"]."'";//String append 
        //echo $sql;
        $result = $con->query($sql);
        //echo $result["unit"];    
       
        $row = $result->fetch_assoc();
        // This is your value $row["value"];
        // This is your operation $row["operation"];

        
        
        // If the person selects Newton giga newton wagera 
        // It is converted to Newtons--


        $x = floatval($_POST["netforce"]);
        if($row["operation"] != ""){
            if($row["operation"] == "*"){
                $x = floatval($_POST["netforce"]) * floatval($row["value"]);
            }else{
                $x = floatval($_POST["netforce"]) / floatval($row["value"]);
            }
        }



        // Solving for mass_unit
        $sql = "SELECT * FROM mass_unit WHERE unit='".$_POST["mass_unit"]."'";
        //ßecho $sql;
        $result = $con->query($sql);
        //echo $result["unit"];    
      
        $row = $result->fetch_assoc();
        // This is your value $row["value"];
        // This is your operation $row["operation"];
        // varchar in DB is for variable characters. setting char means you always use the exact number of characters

        // Now youve made all those
        // If the person selects Newton giga newton wagera 

        $y = floatval($_POST["mass"]);
        if($row["operation"] != ""){
            // How to create variables? 
            if($row["operation"] == "*"){
                $y = floatval($_POST["mass"]) * floatval($row["value"]);
            }else{
                $y = floatval($_POST["mass"]) / floatval($row["value"]);
            }
        }

        // Now converted Mass into basic woh too
      

        // F = M A hota tha // so A = F/M
      
       // echo '<br>'.$x . '<br>' . $y .'<br>';
        $op = $x / $y;
        echo $op;


    }

    
    //if distance was selected
    if($_POST["Given:"]=="DT"){
        //var_dump($_POST);
        $sql = "SELECT * FROM ds_unit WHERE unit='".$_POST["ds_unit"]."'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();                                  //fetching

        
        $distance = floatval($_POST["distance"]);  // conversion of distance
        if($row["operation"] != ""){
            if($row["operation"] == "*"){
                $distance = floatval($_POST["distance"]) * floatval($row["value"]);
            }else{
                $distance = floatval($_POST["distance"]) / floatval($row["value"]);
            }
        }
    // The boxes
        // Solving for initial speed
        $sql = "SELECT * FROM is_unit WHERE unit='".$_POST["is_unit"]."'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();

        $ini_speed= floatval($_POST["initialSpeed"]);   // conversion of initial_speed
        if($row["operation"] != ""){
            if($row["operation"] == "*"){
                $ini_speed = floatval($_POST["initialSpeed"]) * floatval($row["value"]);
            }else{
                $ini_speed = floatval($_POST["initialSpeed"]) / floatval($row["value"]);
            }
        }

    

    // Solving for time
    $sql = "SELECT * FROM time_unit WHERE unit='".$_POST["time_unit"]."'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    $time= floatval($_POST["time"]); 
    if($row["operation"] != ""){
        if($row["operation"] == "*"){
            $time = floatval($_POST["time"]) * floatval($row["value"]);
        }else{
            $time = floatval($_POST["time"]) / floatval($row["value"]);
        }

    
        }
       // echo $distance. "....." . $ini_speed . "....." . $time;
        $result = 2 * ($distance - $ini_speed * $time) / ($time * $time);     //final calculation with formula
        echo   $result;
    }

    /************************************************************************************************************/ 
      //if speeddifference was selected  (Note: Initial speed+time copied from the preceding fetch above)^
    if($_POST["Given:"]=="SD"){
        $sql = "SELECT * FROM fs_unit WHERE unit='".$_POST["fs_unit"]."'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
       // var_dump($_POST);
        $finalspeed = floatval($_POST["finalSpeed"]);
        //echo $finalspeed; // Should it be 0 // Yeh fs_unit ki value me tou nai aega
        if($row["operation"] != ""){
            if($row["operation"] == "*"){
                $final_speed  = floatval($_POST["finalSpeed"]) * floatval($row["value"]);
            }else{
                $final_speed  = floatval($_POST["finalSpeed"]) / floatval($row["value"]);
            }
        }
        //echo $finalspeed;

        // Solving for initial speed
        $sql = "SELECT * FROM is_unit WHERE unit='".$_POST["is_unit"]."'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();

        $ini_speed= floatval($_POST["initialSpeed"]);   // conversion of initial_speed
        if($row["operation"] != ""){
            if($row["operation"] == "*"){
                $ini_speed = floatval($_POST["initialSpeed"]) * floatval($row["value"]);
            }else{
                $ini_speed = floatval($_POST["initialSpeed"]) / floatval($row["value"]);
            }
        }
       // echo $ini_speed;

     // Solving for time
     $sql = "SELECT * FROM time_unit WHERE unit='".$_POST["time_unit"]."'";
     $result = $con->query($sql);
     $row = $result->fetch_assoc();
 
     $time= floatval($_POST["time"]); 
     if($row["operation"] != ""){
         if($row["operation"] == "*"){
             $time = floatval($_POST["time"]) * floatval($row["value"]);
         }else{
             $time = floatval($_POST["time"]) / floatval($row["value"]);
         }
 
        }
        
        echo $time;

         $speedselectedresult = (($finalspeed   - $ini_speed) / ($time));
         echo    $speedselectedresult;
        
    }

    //if()

    // got things from the database
    
    
    /*$initialSpeed = $_POST['initialSpeed'];
    $finalSpeed = $_POST['finalSpeed'];
    $time = $_POST['time'];
    $is_unit = $_POST['is_unit'];
    $fs_unit = $_POST['fs_unit'];
    $time_unit = $_POST['time_unit'];
    $acc_unit = $_POST['acc_unit'];

    switch ($is_unit) {
        case "m/s":
            break;

        case "km/h":
            $initialSpeed /= 3.6;
            break;

        case "ft/s":
            $initialSpeed /= 3.281;
            break;

        case "mph":
            $initialSpeed /= 2.23694;
            break;

        case "knots":
            $initialSpeed /= 1.944; 

        case "km/s":
            $initialSpeed *= 1000;
            break;

        case "mi/s":
            $initialSpeed *= 1609;
            break;

        case "c":
            $initialSpeed *= 299792458;
            break;

        default:
            echo "Initial Unit Error Alert";
            break;
    }
    switch ($fs_unit) {
        case "m/s":
            break;

        case "km/h":
            $initialSpeed /= 3.6;
            break;

        case "ft/s":
            $initialSpeed /= 3.281;
            break;

        case "mph":
            $initialSpeed /= 2.237;
            break;

        case "knots":
            $initialSpeed /= 1.944;
            break;

        case "km/s":
            $initialSpeed *= 1000;
            break;

        case "mi/s":
            $initialSpeed *= 1609;
            break;

        case "c":
            $initialSpeed *= 299792458;
            break;

        default:
            echo "Final Unit Error Alert";
            break;
    }

    switch ($time_unit) {
        case "sec":
            break;

        case "min":
            $time *= 60;
            break;
        case "day":
            $time *= 86400;
            break;
        case "hour":
            $time *= 3600;
            break;
        case "year":
            $time *= 31536000;
            break;
        case "week":
            $time *= 60;
            break;
        case "month":
            $time *= 2592000;
            break;

        case "milisec":
            $time /= 1000;
            break;

        default:
            echo "Final Unit Error Alert";
            break;
    }
    $result = (($finalSpeed - $initialSpeed) / ($time));

    switch ($acc_unit) {
        case "m/s2":
            break;

        case "g":
            $result *= 0.101972;
            break;

        case "ft/s2":
            $result *= 3.28084;
            break;

        default:
            echo "Acceleration Unit error";
            break;
    
    echo "Acceleration: " . $result . $acc_unit;*/
}
if (isset($_POST['massandforce'])) {
    $mass = $_POST['mass'];
    $netforce = $_POST['netforce'];
    $mass_unit = $_POST['mass_unit'];
    $nf_unit = $_POST['nf_unit'];
    $acc_unit = $_POST['acc_unit'];

    switch ($mass_unit) {
        case "kg":
            $mass /= 1000;
            break;

        case "gram":
            break;

        case "metrictons":
            $mass *= 1000000;
            break;

        case "grain":
            $mass /= 15.432;
            break;

        case "drachms":
            $mass *= 1.771;
            break;

        case "ounces":
            $mass *= 28.35;
            break;

        case "pounds":
            $mass *= 454;
            break;

        case "stones":
            $mass *= 6350;
            break;

        case "USshortstons":
            $mass *= 907184.74;
            break;

        case "imperialtons":
            $mass *= 1016046.91;
            break;

        default:
            echo "Mass Unit Error Alert";
            break;
    }

    switch ($nf_unit) {
        case "Newton":
            break;

        case "MegaN":
            $netforce *= 1000000;
            break;

        case "GigaN":
            $netforce *= 1000000000;
            break;

        case "TeraN":
            $netforce *= 1000000000000;
            break;

        case "Kilo":
            $netforce *= 1000;
            break;

        case "poundals":
            $netforce /= 7.233;
            break;

        case "poundsforce":
            $netforce *= 4.448;
            break;

        case "dynes":
            $netforce /= 100000;
            break;

        default:
            echo "Net Force Error Alert!";
            break;
    }
    $mass *= 1000;
    $result = ($netforce / $mass);

    switch ($acc_unit) {
        case "m/s2":
            break;

        case "g":
            $result *= 0.101972;
            break;

        case "ft/s2":
            $result *= 3.28084;
            break;

        default:
            echo "Error alert!";
            break;
    }
    echo "Acceleration: " . $result . $acc_unit;
}
if (isset($_POST['distance_traveled'])) {
    $initialSpeed = $_POST['initialSpeed'];
    $distance = $_POST['distance'];
    $time = $_POST['time'];
    $is_unit = $_POST['is_unit'];
    $ds_unit = $_POST['ds_unit'];
    $time_unit = $_POST['time_unit'];
    $acc_unit = $_POST['acc_unit'];

    switch ($is_unit) {
        case "m/s":
            break;

        case "km/h":
            $initialSpeed /= 3.6;
            break;

        case "ft/s":
            $initialSpeed /= 3.281;
            break;

        case "mph":
            $initialSpeed /= 2.23694;
            break;

        case "knots":
            $initialSpeed /= 1.944;
            break;

        case "km/s":
            $initialSpeed *= 1000;
            break;

        case "mi/s":
            $initialSpeed *= 1609;
            break;

        case "c":
            $initialSpeed *= 299792458;
            break;

        default:
            echo "Initial Unit error";
            break;
    }
    switch ($ds_unit) {
        case "m":
            break;

        case "mm":
            $distance /= 1000;
            break;

        case "cm":
            $distance *= 10;  
            break;

        case "km":
            $distance *= 1000000;
            break;

        case "inches":
            $distance *= 25.4;
            break;

        case "feet":
            $distance *= 305;
            break;

        case "miles":
            $distance *= 1609;
            break;

        case "yard":
            $distance *= 914;
            break;

        default:
            echo "Distance Unit Error Alert";
            break;
    }

    switch ($time_unit) {
        case "sec":
            break;

        case "min":
            $time *= 60;
            break;
        case "day":
            $time *= 86400;
            break;
        case "hour":
            $time *= 3600;
            break;
        case "year":
            $time *= 31536000;
            break;
        case "week":
            $time *= 60;
            break;
        case "month":
            $time *= 2592000;
            break;
        case "milisec":
            $time /= 1000;
            break;

        default:
            echo "Final Unit Error Alert";
            break;
    }

    $result = 2 * ($distance - $initialSpeed * $time) / ($time * $time);

    switch ($acc_unit) {
        case "m/s2":
            break;

        case "g":
            $result *= 0.101972;
            break;

        case "ft/s2":
            $result *= 3.28084;
            break;

        default:
            echo "Acceleration Unit error";
            break;
    }
    echo "Acceleration: " . $result . $acc_unit;
}

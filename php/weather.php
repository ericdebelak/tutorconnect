<?php
    //first establish base URL for the API
    $baseUrl = "http://api.openweathermap.org/data/2.5/weather";
    
    if(empty($_GET['city']) === true)
    {
        echo "<p>No city detected</p>";
        exit;
    }
    
    //retrieve the city from a Get parameter
    //use html specialchars to eliminate any cross site scripting
    $city = urlencode(htmlspecialchars($_GET["city"]));
    
    //then, put the parameters into the query
    $query = "q=$city&units=metric";
    
    //next, glue the URL togeter
    $urlGlue = "$baseUrl?$query";
    
    //download the JSON data //goes out to web server and down loads it for us 
    $json = file_get_contents($urlGlue);
    if($json === false)
    {
        echo "<p>Unable to download JSON data </p>";
        exit;
    }
        
    //convert the raw JSON data to an associate array    
    $weather = json_decode($json, true);
    
    //for now, just see the new array
    //var_dump($weather);
    
    //use the array to get "interesting" data
    if($weather['cod'] == 200)
    {
    $temperature = $weather ["main"]["temp"];
    $condition   = $weather ["weather"][0]["main"];
    $observed    = date("Y-m-d, H:i:s", $weather["dt"]);    
    echo "<p>Current Temperature: $temperature &deg;C<br />";
    echo "Condition: $condition<br />";
    echo "Observed at: $observed</p>";
    }
    //city not found, or maybe another API error...
    else
    {
        echo "<p>OpenWeather API error " . $weather["cod"] . ": ". $weather["message"] . "</p>";
    }
    
     
?>
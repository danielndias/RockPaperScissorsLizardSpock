<?php
session_start();
?>
<!DOCTYPE html>
<!--
    Name: Daniel Dias
    Version: 1.0
    Date created: July 18 2017
    Date updated: July 18 2017
    Description: Website developed to check the knowledge acquired in the 
first three weeks of PHP classes on the Web Programming course on Sheridan College.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rock, Paper, Scissors v2.0: Daniel Dias</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>

        <!-- ## 1 ## -->
        <?php
        //Inserting the arrays.php file
        include "content/arrays.php";

        //Unseting the sessions when clicking on the New Game Button
        $newGame = isset($_POST["newGame"]) ? htmlentities($_POST["newGame"]) : null; 
        if (!is_null($newGame)) {
            session_unset();
        }
        
        
        //Code for the when the player had made a movement.
        if (isset($_SESSION['playerScore'])) {

            //Storing the player movement in a variable
            $playerChoice = htmlentities($_POST["lstMoves"]);
            
            //Enhacement: Using a Session variable to determine which element will
            //selected by default
            for ($i = 0; $i < count($values); $i++) {
                $values[$i] == $playerChoice ? 
                        $_SESSION["selection"][$i] = "selected" : $_SESSION["selection"][$i] = "";
            }

            //Created a $random variable to be able to use the same number 
            //on the $computerChoice and $computerChoiceStr variables
            $random = rand(0, 4);
            $computerChoice = $values[$random];

            //Assigning the player and computer choices to a variable for
            //print for the user, because the player may not recognize the 
            //images for lizard and spock.
            $playerChoiceStr = $moves[array_search($playerChoice, $values)];
            $computerChoiceStr = $moves[$random];

            //Check if it is a draw
            if ($playerChoice == $computerChoice) {
                $result = $results[0];
            }

            //check all the possible scenarios for a player win
            //Did all the different combinations separately because 
            //I wanted to show Sheldon's line about each combination
            else if ($winner[$playerChoice][0] == $computerChoice) {
                $result = $results[1];
                $sheldon = $sheldonResult[$playerChoice][0];
                $_SESSION['playerScore']++;
            } else if ($winner[$playerChoice][1] == $computerChoice) {
                $result = $results[1];
                $sheldon = $sheldonResult[$playerChoice][1];
                $_SESSION['playerScore']++;
            } else if ($winner[$computerChoice][0] == $playerChoice) {
                $result = $results[2];
                $sheldon = $sheldonResult[$computerChoice][0];
                $_SESSION['computerScore']++;
            } else if ($winner[$computerChoice][1] == $playerChoice) {
                $result = $results[2];
                $sheldon = $sheldonResult[$computerChoice][1];
                $_SESSION['computerScore']++;
            }
        }

        //Setting the empty variables if the page is loading for the first time
        else {
            $playerChoice = "none";
            $computerChoice = "none";
            $result = "Waiting for results...";
            $playerChoiceStr = "";
            $computerChoiceStr = "";

            $_SESSION['playerScore'] = 0;
            $_SESSION['computerScore'] = 0;
        }
        ?>

        <h1>Play Rock, Paper, Scissors, Lizard, Spock</h1>
        <form method="POST">

            <!-- Due the game complexity, the button was created to show all  
            possible combinations to the player.
            -->
            <div>
                <button name="newGame" class="buttons">New Game</button>
                <a href="#" id="rulesLink" class="buttons">Show Rules</a>
                <figure  id="rulesImg">                    
                    <img src="images/rules.png">
                    <figcaption>Click on the image to close
                </figure>
            </div>

            <div class="play-container">
                <p class="game-header">Choose your move:</p>
                <select name="lstMoves">

                    <!-- ## 2 ## -->
                    <?php
                    for ($i = 0; $i < count($moves); $i++) {
                        echo "<option value='$values[$i]' ".$_SESSION["selection"][$i].">$moves[$i]</option>";
                    }
                    ?>

                </select>
                <input type="submit"  class="buttons">
                <p>

                    <!-- ## 3 ## -->
                    <?php
                    echo "<img src=\"images/$playerChoice.png\"  alt=\"$playerChoiceStr\">";
                    echo "<p class=\"choice\">$playerChoiceStr</p>"
                    ?>

                </p>
            </div>
            <div class="play-container">
                <p class="game-header">The computer chose:</p>

                <!-- ## 4 ## -->
                <?php
                echo "<img src=\"images/$computerChoice.png\" alt=\"$computerChoiceStr\">";
                echo "<p class=\"choice\">$computerChoiceStr</p>"
                ?>

            </div>

        </form>

        <p class="game-header">

            <!-- ## 6 ## -->
            <?php
            echo "$sheldon<br>";
            echo "$result";
            ?>

        </p>

        <div class="score">
            <div>Score:</div>
            <div>Computer: <!-- ## 7 ## --> <?php echo $_SESSION['computerScore'] ?></div>
            <div>Player: <!-- ## 8 ## --> <?php echo $_SESSION['playerScore'] ?></div>    
        </div>

        <!-- JavaScript code to show and hide the rules Image -->
        <script type="text/javascript">
            document.getElementById("rulesLink").addEventListener("click", function () {
                displayWin(true);
            });

            document.getElementById("rulesImg").addEventListener("click", function () {
                displayWin(false);
            });

            function displayWin(show) {
                if (show) {
                    document.getElementById("rulesImg").style.display = "block";
                    document.getElementById("overlay").style.display = "block";
                    document.getElementById("rulesClose").style.display = "block";
                } else {
                    document.getElementById("rulesImg").style.display = "none";
                    document.getElementById("overlay").style.display = "none";
                    document.getElementById("rulesClose").style.display = "none";
                }
            }
        </script>
    </body>
</html>

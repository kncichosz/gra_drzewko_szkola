<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 10%;
        }
        a, a:hover{
            color:black;
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php

    $now = time();
    $day = date('d', $now);
    $month = date('m', $now);
    $year = date('Y', $now);
    $seconds = date('s', $now);
    $minuts = date('i', $now);
    $hours = date('H', $now);

    $dataPodlania = "$year-$month-$day $hours:$minuts:$seconds";
    $dataWyrosniecia = "$year-$month-$day ".($hours+1).":$minuts:$seconds";

    $czasRobaczka = rand(1, 59);
    $czasRobaczka = mktime($hours, $minuts+$czasRobaczka, $seconds, $month, $day, $year);

    $day = date('d', $czasRobaczka);
    $month = date('m', $czasRobaczka);
    $year = date('Y', $czasRobaczka);
    $seconds = date('s', $czasRobaczka);
    $minuts = date('i', $czasRobaczka);
    $hours = date('H', $czasRobaczka);
    $dataRobaczek = "$year-$month-$day $hours:$minuts:$seconds";

    $db = new PDO('mysql:dbname=drzewko_v2;host=localhost', 'root', '');

    $select = "SELECT * FROM `drzewka` WHERE 1";
    $std = $db->prepare($select);
    $std->execute();
    $count = $std->rowCount();

    if($count == 0){
        echo "<a href='index.php?zasadzic'>Zasadź drzewko🌳</a><br>";
    }else{

        $select = "SELECT * FROM `drzewka`";
        $std = $db->prepare($select);
        $std->execute();
        $result = $std->fetch();

        $czasPodlania2 = $result["czas_podlania"];
        $czasPodlania = strtotime($czasPodlania2);
        $czasWyrosniecia2 = $result["czas_wyrosniecia"];
        $czasWyrosniecia = strtotime($czasWyrosniecia2);
        $czasRobaka2 = $result["czas_robaczka"];
        $czasRobaka = strtotime($czasRobaka2);

        $czasDojrzewania = $czasWyrosniecia - $now;

        if($czasWyrosniecia < $now){

            if($czasRobaka != null){
                echo "<img src='2.png'><br>";
                echo "Robaczek zjadł twoje plony🐛🐜🐞🦟<br>";
                echo "<a href='index.php?odnowa'>Od nowa?🤔</a>";
            }else{
                echo "<img src='2.png'><br>";
                echo "<a href='index.php?zebrane'>Zbierz owoce🍎</a>";
            }

        }else if($czasDojrzewania < 1800){
            echo "<img src='1.png'><br>";
            echo "<a href='index.php?podlej=".$result["id_drzewka"]."'>Podlej drzewko💧🌳</a><br>";
            echo "Czas wyrośnięcia: ".$czasWyrosniecia2;
            echo "<br>Czas podlania: ".$czasPodlania2;

            if($czasRobaka < $now && $czasRobaka != null){
                echo "<br><a href='index.php?robal=".$result["id_drzewka"]."'>Zbierz robaczka🐛</a><br>";
            }

        }else{
            echo "<img src='0.png'><br>";
            echo "<a href='index.php?podlej=".$result["id_drzewka"]."'>Podlej drzewko💧🌳</a><br>";
            echo "Czas wyrośnięcia: ".$czasWyrosniecia2;
            echo "<br>Czas podlania: ".$czasPodlania2;

            if($czasRobaka < $now && $czasRobaka != null){
                echo "<br><a href='index.php?robal=".$result["id_drzewka"]."'>Zbierz robaczka🐛</a><br>";
            }

        }

        //echo "<img src='1.png'><br>";

    }

    if(isset($_GET['zasadzic'])){
        $sql = "INSERT INTO `drzewka`(`czas_wyrosniecia`, `czas_robaczka`, `czas_podlania`) VALUES ('$dataWyrosniecia', '$dataRobaczek', '$dataPodlania')";
        $std = $db->prepare($sql);
        $std -> execute();
        header('Location: index.php');
    }

    if(isset($_GET['podlej'])){

        if($czasPodlania<$now){
            $sql = "UPDATE `drzewka` SET `czas_wyrosniecia` = `czas_wyrosniecia` - INTERVAL 15 MINUTE, `czas_podlania`= `czas_podlania` + INTERVAL 10 MINUTE WHERE `id_drzewka`=".$_GET['podlej'];
            $std = $db->prepare($sql);
            $std -> execute();
            header('Location: index.php');
        }else{
            echo "<p style='color:red'>Nie można podlać drzewka</p>";
        }

    }

    if(isset($_GET['robal'])){

        $sql = "UPDATE `drzewka` SET `czas_robaczka` = null WHERE `id_drzewka`=".$_GET['robal'];
        $std = $db->prepare($sql);
        $std -> execute();
        header('Location: index.php');

    }

    if(isset($_GET['zebrane'])){
        echo "<br>Zebrałeś owocki🍎🍏🍑🥭🍍<br>";
        echo "<a href='index.php?odnowa'>Od nowa?🤔</a>";
    }

    if(isset($_GET['odnowa'])){
        $sql = "DELETE FROM `drzewka`";
        $std = $db->prepare($sql);
        $std -> execute();

        header('Location: index.php');
    }

?>
</body>
</html>
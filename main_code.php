<?php
declare(strict_types=1);
require "Money_exchange.php";

// Fetch exchange rates
$url = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
$content = file_get_contents($url);

$usd = json_decode($content, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Conversion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div class="container mt-8">
    <div class="card">
        <div class="card-header text-center">
            Exchange Money
        </div>
        <div class="card-body">
            <form action="main_code.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text">UZS</span>
                    <input type="text" name="uzs" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="currencySelect"> Select a currency </label>
                    <select class="form-select" id="currencySelect" name="ID" required>
                        <option selected disabled>Currencies</option>
                        <?php
                        foreach ($usd as $item) {
                            echo "<option value='{$item['id']}'>{$item['CcyNm_UZ']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>

            <?php
            if (!empty($_POST['ID']) && !empty($_POST['uzs'])) {
                $ID = $_POST['ID'];
                $UZS = $_POST['uzs'];

                foreach ($usd as $item) {
                    if ($item['id'] == $ID) {
                        $num = $item['Rate'];
                        $pul_birligi = $item['CcyNm_UZ'];
                        $exchange = new Money_exchenge($UZS, $num);
                        echo "<div class='alert alert-success mt-5'>";
                        echo "Converted Amount: " . $exchange->Exchange(). $pul_birligi;
                        echo "</div>";
                        break;
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

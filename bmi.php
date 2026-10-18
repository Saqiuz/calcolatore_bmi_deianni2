<?php
$nome = $_POST['nome'] ?? '';
$peso = $_POST['peso'] ?? '';
$altezza = $_POST['altezza'] ?? '';

$altezza_m = $altezza / 100;
$bmi = $peso / ($altezza_m * $altezza_m);
$bmi_formatted = number_format($bmi,2);

if ($bmi<18.5){
    $categoria="SOTTOPESO";
    $classe = "sottopeso";
}
elseif ($bmi<=24.9){
    $categoria="NORMOPESO"
    $classe="normopeso"
}
elseif (bmi<=29.9){
    $categoria="SOVRAPPESO"
    $classe="sovrappeso"
}
elseif($bmi>=30){
    $categoria="OBESITÀ"
    $classe="obesita"
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Il tuo BMI</h1>

        <div class="card <?php echo $classe; ?>">
            <div class="name><?php echo htmlspecialchars($nome); ?></div>
            <div class="details">Peso <?php echo $peso; ?> kg · Altezza <?php echo $altezza; ?> cm</div>
            <div class="bmi-value"><?php echo $bmi_formatted; ?></div>
            <div class="bmi-status"><?php echo $categoria; ?></div>
        </div>

        <a href="index.html" class="back-link">Calcola di nuovo</a>
    </main>
</body>
</html>
    
    
    
    </div>

    
</body>
</html>l
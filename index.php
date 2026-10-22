<?php
$nome = '';
$peso = '';
$altezza = '' ;
$bmi=null;
$categoria='';
$classe_css='';
$errori=[];

if ($_SERVER['REQUEST_METHOD']==='POST'){

    $nome= trim($_POST['nome']??'');
    $peso_grezzo=trim($_POST['peso']??'');
    $altezza_grezza=trim($_POST['peso']??'');

    if($nome===''){
        $errori[]="Il campo Nome è obbligatorio";
        
    }

    if ($peso_grezzo===''){
        $errori[]="Il campo Peso è obbligatorio.";
    }elseif(!is_numeric($altezza_grezza)||floatval($altezza_grezza)<=0){
        $errori[]="L'altezza deve essere un numero positivo maggiore di zero";
    }else{
        $altezza=floatval($altezza_grezza);
    }


    if(empty($errori)){
        $altezza_m=$altezza/100;
        $bmi=$peso/pow(($altezza_m/100),2);
        $bmi=round($bmi,2);

        if($bmi < 18.5) {
            $categoria = 'SOTTOPESO';
            $classe_css='sottopeso';
        }elseif ($bmi<=24.9){
            $categoria='NORMOPESO';
            $classe_css='normopeso';
        }elseif ($bmi<=29.9){
            $categoria='SOVRAPPESO';
            $classe_css='sovrappeso';
        }else{
            $categoria='OBESITA';
            $classe_css='obesità';
        }                                           
}

}






?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatore BMI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f7;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        h1 {
            color: #1a1a1a;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 380px;
            box-sizing: border-box;
        }

        .error-box {
            background-color: #fde8e8;
            border: 1px solid #f8b4b4;
            color: #9b1c1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #1a1a1a;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            color: #333;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #1f242d;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .result-card {
            border-width: 2px;
            border-style: solid;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
        }

        .result-card .name {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .result-card .details {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 16px;
        }

        .result-card .bmi-value {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .result-card .category {
            font-weight: bold;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .sottopeso {
            background-color: #E3EEF9;
            border-color: #2F6FB3;
            color: #2F6FB3;
        }

        .normopeso {
            background-color: #E3F4E6;
            border-color: #256D34;
            color: #256D34;
        }

        .sovrappeso {
            background-color: #FCEBD7;
            border-color: #9A4F06;
            color: #9A4F06;
        }

        .obesita {
            background-color: #FBE2E2;
            border-color: #B32D2D;
            color: #B32D2D;
        }

        .btn-reset {
            display: inline-block;
            margin-top: 20px;
            color: #1a1a1a;
            text-decoration: underline;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <?php if ($bmi === null): ?>
        <h1>Calcolatore BMI</h1>

        <div class="card">
            
            <?php if (!empty($errori)): ?>
                <div class="error-box">
                    <ul>
                        <?php foreach ($errori as $errore): ?>
                            <li><?php echo htmlspecialchars($errore); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Luca" value="<?php echo htmlspecialchars($nome); ?>">
                </div>

                <div class="form-group">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" id="peso" name="peso" step="any" placeholder="70" value="<?php echo htmlspecialchars($_POST['peso'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="altezza">Altezza (cm)</label>
                    <input type="number" id="altezza" name="altezza" step="any" placeholder="178" value="<?php echo htmlspecialchars($_POST['altezza'] ?? ''); ?>">
                </div>

                <button type="submit" class="btn-submit">Calcola</button>
            </form>
        </div>

    <?php else: ?>
        <h1>Il tuo BMI</h1>

        <div class="card">
            <div class="result-card <?php echo $classe_css; ?>">
                <div class="name"><?php echo htmlspecialchars($nome); ?></div>
                <div class="details">Peso <?php echo $peso; ?> kg · Altezza <?php echo $altezza; ?> cm</div>
                <div class="bmi-value"><?php echo number_format($bmi, 2, '.', ''); ?></div>
                <div class="category"><?php echo $categoria; ?></div>
            </div>

            <div style="text-align: center;">
                <a href="index.php" class="btn-reset">Calcola di nuovo</a>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
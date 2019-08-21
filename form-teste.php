<?php
    require 'PagSeguroLibrary.php';
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Comprar produto</h1>
    <form method="post">

        <input type="hidden" name="code" value="823EAD5B47471BCEE4864FB7F1A1DA1C" />

        <div>
            <input type="text" name="nome" placeholder="Nome">
        </div><br>

        <div>
            <input type="email" name="email" placeholder="Email">
        </div><br>

        <div>
            <input type="text" name="ddd" placeholder="DDD">
        </div><br>

        <div>
            <input type="text" name="telefone" placeholder="Telefone">
        </div><br>

        <div>
            <input type="text" name="cpf" placeholder="CPF Válido">
        </div><br>

        <div>
            <input type="text" name="produto" placeholder="Produto">
        </div><br>

        <div>
            <input type="text" name="qtd" placeholder="Quantidade">
        </div><br>

        <div>
            <input type="text" name="valor" placeholder="Valor">
        </div><br>
        


     <button name="comprar" type="submit">Contrate nossos serviço</button>
    
    </form>

    <?php

    
        
if (isset($_POST["comprar"])){

$nome = filter_input(INPUT_POST,'nome');
$email = filter_input(INPUT_POST,'email');
$produto = filter_input(INPUT_POST,'produto');
$qtd = filter_input(INPUT_POST,'qtd');
$valor = filter_input(INPUT_POST,'valor');
$cpf = filter_input(INPUT_POST,'cpf');
$ddd = filter_input(INPUT_POST,'ddd');
$telefone = filter_input(INPUT_POST,'telefone');
$code = filter_input(INPUT_POST,'code');
$ref = rand(100,100000);


$valorTotal = $qtd*$valor;

$paymentRequest = new PagSeguroPaymentRequest();  
$paymentRequest->addItem($ref, $valorTotal,$qtd, $code);
$paymentRequest->setSender(
    $nome,
    $email,
    $ddd,
    $telefone,
    'cpf',
    $cpf
);

$paymentRequest->setCurrency("BRL");
$paymentRequest->setReference($ref);

try {
$credentials = PagSeguroConfig::getAccountCredentials();
$checkoutUrl = $paymentRequest->register($credentials);
echo '<script>window.location="'.$checkoutUrl.'"</script>';

}
catch (PagSeguroServiceException $e){
 die($e->getMessage());
}

}




?>
    

   

</body>
</html>


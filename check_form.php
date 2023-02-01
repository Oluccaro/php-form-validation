<?php
function verifica_campo($texto){
  $texto = trim($texto);
  $texto = stripslashes($texto);
  $texto = htmlspecialchars($texto);
  return $texto;
}

$nome = verifica_campo($_POST["nome"]);
$email = verifica_campo($_POST["email"]);
$data = verifica_campo($_POST["data"]);
$senha = verifica_campo($_POST["senha"]);
$confirmaSenha = verifica_campo($_POST["confirmaSenha"]);
$exito_upload = "";

$erro = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tmp = $_POST["nome"];

  if(empty($tmp)){
    $erro_nome = "Nome é obrigatório.";
    $erro = true;
  }
  else {
    $nome = verifica_campo($tmp);
  }

  $tmp = $_POST["email"];
  if(empty($tmp)){
    $erro_email = "Email é obrigatório";
    $erro = true;
  } else if (!filter_var($tmp,FILTER_VALIDATE_EMAIL)){
    $erro_email = "Email inválido";
    $erro = true;
  } else {
    $email = verifica_campo($email);
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
  }

  $tmp = $_POST["data"];
  $pattern = "/\d{4}\-\d{2}\-\d{2}/";
  if(empty($data)){
    $erro_data = "Data inválida";
    $erro = true;
  } else if (preg_match($pattern,$tmp) == 0){
    $erro_data = "O formato da data deve ser YYYY-MM-DD";
    $erro = true;
  } else {
    $data = $tmp;
  }

  if(empty($senha) or empty($confirmaSenha)){
    $erro_senha = "Ambos os campos de senha precisam ser preenchidos!";
    $erro = true;

  } else if($senha != $confirmaSenha){
    $erro_senha = "As senhas não conferem";
    $erro = true;
  } else {
    $senha = verifica_campo($senha);
  }

  #Lidando com o upload de imagem
  $img_pattern = "/(jpg|png)/";
  $imagem = $_FILES["imagem"];
  $target_dir = "./imagens/";
  $target_file = $target_dir . basename($imagem["name"]);
  $is_upload_ok = 1;
  $image_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  #Checando se é uma imagem de verdade
  if($image["size"] != 0) 
  if($imagem["size"] == 0) {
    $erro_imagem = "Por favor selecione um arquivo para upload";
    $erro = true;
  } else if($imagem["size"] > 1000000){
    $erro_imagem = "Tamanho máximo suportado é 1MB";
    $erro = true;
  } else if (preg_match($img_pattern,$image_extension) == 0){
    $erro_imagem = "o formato do arquivo de imagem precisa ser .png ou .jpg";
    $erro = true;
  } else if(file_exists($target_file)) {
    $erro_imagem = "Arquivo já existente no nosso diretório";
    $erro = true;
  };

  if($erro){
    $is_upload_ok = 0;
  }
  if($is_upload_ok == 1){
    if(move_uploaded_file($imagem["tmp_name"],$target_file)){
      $exito_upload = "O upload de" . htmlspecialchars(basename($imagem["name"])) . " foi concluído";
    } else {
      $erro_imagem = "Ocorreu um erro com o upload da imagem";
      $erro = true;
    }
  }

} 
?>

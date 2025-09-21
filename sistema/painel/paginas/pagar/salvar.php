<?php 
require_once("../../../conexao.php");
$tabela = 'pagar';
@session_start();
$id_usuario = $_SESSION['id'];

$id = $_POST['id'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$pessoa = @$_POST['pessoa'];
$data_venc = $_POST['data_venc'];
$data_pgto = $_POST['data_pgto'];
$funcionario = @$_POST['funcionario'];
$forma_pgto = @$_POST['pgto'];

if($descricao == ""){
	echo 'Insira uma descrição!';
	exit();
}

if($funcionario == ""){
	$funcionario = 0;
}

if($pessoa == ""){
	$pessoa = 0;
}


if($data_pgto != ''){
	$usuario_pgto = $id_usuario;
	$pago = 'Sim';
	$pgto = " ,data_pgto = '$data_pgto'";
}else{
	$usuario_pgto = 0;
	$pago = 'Não';
	$pgto = "";
}


//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/contas/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../img/contas/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



if($funcionario == ""){
	$funcionario = 0;
}

//verificar caixa aberto
$query1 = $pdo->query("SELECT * from caixas where operador = '$id_usuario' and data_fechamento is null order by id desc limit 1");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if(@count($res1) > 0){
	$id_caixa = @$res1[0]['id'];
}else{
	$id_caixa = 0;
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET descricao = :descricao, tipo = 'Conta', valor = :valor, data_lanc = curDate(), data_venc = '$data_venc',  usuario_lanc = '$id_usuario', usuario_baixa = '$usuario_pgto', foto = '$foto', pessoa = '$pessoa', pago = '$pago', funcionario = '$funcionario', caixa = '$id_caixa', hora = curTime(), pgto = '$forma_pgto' $pgto");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET descricao = :descricao, valor = :valor, data_venc = '$data_venc', data_pgto = '$data_pgto', foto = '$foto', pessoa = '$pessoa', funcionario = '$funcionario', pgto = '$forma_pgto', caixa = '$id_caixa', hora = curTime() WHERE id = '$id'");
}

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->execute();
$ultima_conta = $pdo->lastInsertId();

echo 'Salvo com Sucesso';



$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$valorF = @number_format($valor, 2, ',', '.');

//mensagem de agendamento de pagamento da conta
if($msg_agendamento == 'Api'){
	if($id == ""){
		$mensagem = '💰 *'.$nome_sistema.'*%0A';
		$mensagem .= '_Conta Vencendo Hoje_ %0A';
		$mensagem .= 'Descrição: *'.$descricao.'* %0A';
		$mensagem .= 'Valor: *'.$valorF.'* %0A';
		$mensagem .= 'Vencimento: *'.$data_vencF.'* %0A';

		$data_mensagem = $data_venc.' 09:00:00';
		$telefone = $tel_whatsapp;	

		require("../../../../ajax/api-agendar.php");
		$query = $pdo->query("UPDATE pagar SET hash = '$hash' WHERE id = '$ultima_conta'");
	}
}


 ?>
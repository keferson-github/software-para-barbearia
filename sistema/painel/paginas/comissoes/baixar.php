<?php 
require_once("../../../conexao.php");
$tabela = 'pagar';
@session_start();
$id_usuario = $_SESSION['id'];


$id = $_POST['id'];
$valor = $_POST['valor'];
$data_pgto = $_POST['data_pgto'];
$pgto = $_POST['pgto'];

//verificar caixa aberto
$query1 = $pdo->query("SELECT * from caixas where operador = '$id_usuario' and data_fechamento is null order by id desc limit 1");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if(@count($res1) > 0){
	$id_caixa = @$res1[0]['id'];
}else{
	$id_caixa = 0;
}

$pdo->query("UPDATE $tabela SET pgto = '$pgto', valor = '$valor', pago = 'Sim', usuario_baixa = '$id_usuario', data_pgto = '$data_pgto', caixa = '$id_caixa', hora = curTime() where id = '$id'");

echo 'Baixado com Sucesso';
 ?>
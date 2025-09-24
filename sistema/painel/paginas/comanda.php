<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'comanda';


//verificar se ele tem a permissão de estar nessa página
if(@$comanda == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}


$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";

if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
	$dia_final_mes = '30';
}else if($mes_atual == '2'){
	$dia_final_mes = '28';
}else{
	$dia_final_mes = '31';
}

$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;


?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Comanda</a>
</div>

<div class="bs-example" style="padding:15px">

	<div class="row" style="margin-top: -15px; margin-bottom: 15px;">
		<div class="col-md-5" style="margin-bottom: 8px;">
			<div style="float:left; margin-right:10px; margin-top: 8px;"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
			<div style="float:left; margin-right:20px;">
				<input type="date" class="form-control" name="data-inicial" id="data-inicial-caixa" value="<?php echo $data_hoje ?>" required style="height: 34px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; width: 140px;">
			</div>

			<div style="float:left; margin-right:10px; margin-top: 8px;"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
			<div style="float:left; margin-right:30px;">
				<input type="date" class="form-control" name="data-final" id="data-final-caixa" value="<?php echo $data_hoje ?>" required style="height: 34px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; width: 140px;">
			</div>
		</div>


		
		<div class="col-md-2" style="margin-top:5px;" align="center">	
			<div > 
				<small >
					<a title="Conta de Ontem" class="text-muted" href="#" onclick="valorData('<?php echo $data_ontem ?>', '<?php echo $data_ontem ?>')"><span>Ontem</span></a> / 
					<a title="Conta de Hoje" class="text-muted" href="#" onclick="valorData('<?php echo $data_hoje ?>', '<?php echo $data_hoje ?>')"><span>Hoje</span></a> / 
					<a title="Conta do Mês" class="text-muted" href="#" onclick="valorData('<?php echo $data_inicio_mes ?>', '<?php echo $data_final_mes ?>')"><span>Mês</span></a>
				</small>
			</div>
		</div>



	<div class="col-md-3" style="margin-top:5px;" align="center">	
			<div > 
				<small >
					<a title="Todas as Comandas" class="text-muted" href="#" onclick="buscarContas('')"><span>Todas</span></a> / 
					<a title="Abertas" class="text-muted" href="#" onclick="buscarContas('Aberta')"><span>Abertas</span></a> / 
					<a title="Fechadas" class="text-muted" href="#" onclick="buscarContas('Fechada')"><span>Fechadas</span></a>
				</small>
			</div>
		</div>

		<input type="hidden" id="buscar-contas" value="Aberta">

	</div>

	
	<div class="container" id="listar">

	</div>
	
</div>






<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="">
	<div class="modal-dialog modal-lg" role="document" style="width:90%; max-width:1400px;" id="modal_scrol">
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 15px;">
				<h4 class="modal-title" style="margin: 0;"><span id="titulo_comanda">Nova Comanda</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			<form id="form_salvar">
				<div class="modal-body" style="padding: 20px 15px;">

					<div class="row" style="margin: 0;">
						<div class="col-md-8" style="border-right: 1px solid #6e6d6d; overflow-y: auto; height:auto; max-height: 450px; scrollbar-width: thin; padding-right: 15px;">
							
							<!-- Seção Cliente e Observações -->
							<div class="row" style="margin-bottom: 12px; margin-top: 8px;">
								<div class="col-md-6" style="padding-right: 8px;">			
									<div class="form-group" style="margin-bottom: 12px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Cliente *</label> 
										<select class="form-control sel2" id="cliente" name="cliente" style="width:100%; height: 34px; border: 1px solid #ddd; border-radius: 4px;" required> 
											<option value="">Selecionar Cliente</option>
											<?php 
											$query = $pdo->query("SELECT * FROM clientes ORDER BY nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>

								<div class="col-md-6" style="padding-left: 8px;">						
									<div class="form-group" style="margin-bottom: 12px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Observações</label> 
										<input maxlength="1000" type="text" class="form-control" name="obs" id="obs2" style="height: 34px; border: 1px solid #ddd; border-radius: 4px;" placeholder="Digite observações..."> 
									</div>						
								</div>
							</div>

							<!-- Divisor -->
							<div style="border-top: 1px solid #e0e0e0; margin: 15px 0;"></div>

							<!-- Seção Serviços -->
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-5" style="padding-right: 8px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Serviço *</label> 
										<select class="form-control sel2" id="servico" name="servico" style="width:100%; height: 34px; border: 1px solid #ddd; border-radius: 4px;" required> 
											<?php 
											$query = $pdo->query("SELECT * FROM servicos ORDER BY nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>

								<div class="col-md-5" style="padding-left: 8px; padding-right: 8px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Profissional *</label> 
										<select class="form-control sel2" id="funcionario" name="funcionario" style="width:100%; height: 34px; border: 1px solid #ddd; border-radius: 4px;" required> 
											<?php 
											$query = $pdo->query("SELECT * FROM usuarios where atendimento = 'Sim' ORDER BY nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>

								<div class="col-md-2" style="padding-left: 8px; display: flex; align-items: end;">	
									<a href="#" onclick="inserirServico()" class="btn btn-primary btn-sm" style="height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 4px;" title="Adicionar Serviço"><i class="fa fa-plus"></i></a>
								</div>
							</div>

							<!-- Lista de Serviços -->
							<div class="row" style="margin-bottom: 12px;">
								<div class="col-md-12">
									<div style="border: 1px solid #ddd; margin-bottom: 10px; min-height: 45px; padding: 8px; border-radius: 4px; background-color: #f9f9f9;" id="listar_servicos"></div>
								</div>
							</div>

							<!-- Seção Produtos -->
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-4" style="padding-right: 8px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Produtos</label> 
										<select class="form-control sel2" id="produto" name="produto" style="width:100%; height: 34px; border: 1px solid #ddd; border-radius: 4px;" required onchange="listarServicos()"> 
											<?php 
											$query = $pdo->query("SELECT * FROM produtos where estoque > 0 ORDER BY nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>

								<div class="col-md-2" style="padding-left: 8px; padding-right: 8px;">					
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Qtd</label> 
										<input type="number" class="form-control" name="quantidade" id="quantidade" value="1" style="height: 34px; border: 1px solid #ddd; border-radius: 4px; text-align: center;" min="1"> 
									</div>						
								</div>

								<div class="col-md-4" style="padding-left: 8px; padding-right: 8px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Profissional</label> 
										<select class="form-control sel2" id="funcionario2" name="funcionario2" style="width:100%; height: 34px; border: 1px solid #ddd; border-radius: 4px;" required onchange="listarServicos()"> 
											<option value="0">Nenhum</option>
											<?php 
											$query = $pdo->query("SELECT * FROM usuarios where nivel != 'Administrador' ORDER BY nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>

								<div class="col-md-2" style="padding-left: 8px; display: flex; align-items: end;">	
									<a href="#" onclick="inserirProduto()" class="btn btn-primary btn-sm" style="height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 4px;" title="Adicionar Produto"><i class="fa fa-plus"></i></a>
								</div>
							</div>

							<!-- Lista de Produtos -->
							<div class="row" style="margin-bottom: 12px;">
								<div class="col-md-12">
									<div style="border: 1px solid #ddd; margin-bottom: 10px; min-height: 45px; padding: 8px; border-radius: 4px; background-color: #f9f9f9;" id="listar_produtos"></div>
								</div>
							</div>

						</div>

						<!-- Painel Lateral de Pagamento -->
						<div class="col-md-4" style="padding-left: 15px;">
							
							<!-- Valor e Data de Pagamento -->
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-5" style="padding-right: 5px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 13px; font-weight: 500; color: #333;">Valor</label> 
										<input type="text" class="form-control inputs_form" name="valor_serv" id="valor_serv" style="height: 32px; font-size: 13px; border: 1px solid #ddd; border-radius: 4px; text-align: right;" placeholder="0,00"> 
									</div>						
								</div>

								<div class="col-md-7" style="padding-left: 5px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Data PGTO</label> 
										<input type="date" class="form-control inputs_form" name="data_pgto" id="data_pgto" value="<?php echo date('Y-m-d') ?>" style="height: 34px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; width: 100%;"> 
									</div>						
								</div>	
							</div>

							<!-- Forma de Pagamento -->
							<div class="row" style="margin-bottom: 12px;">
								<div class="col-md-12">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 13px; font-weight: 500; color: #333;">Forma PGTO</label> 
										<select class="form-control inputs_form" id="pgto" name="pgto" style="width:100%; height: 32px; font-size: 13px; border: 1px solid #ddd; border-radius: 4px;" required> 
											<?php 
											$query = $pdo->query("SELECT * FROM formas_pgto");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['nome'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>
							</div>

							<!-- Divisor -->
							<div style="border-bottom: 1px solid #e0e0e0; margin: 12px 0;"></div>

							<!-- Valor Restante -->
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-5" style="padding-right: 5px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 13px; font-weight: 500; color: #333;">Vl. Restante</label> 
										<input type="text" class="form-control inputs_form" name="valor_serv_agd_restante" id="valor_serv_agd_restante" onkeyup="abaterValor()" style="height: 32px; font-size: 13px; border: 1px solid #ddd; border-radius: 4px; text-align: right;" placeholder="0,00"> 
									</div>						
								</div>

								<div class="col-md-7" style="padding-left: 5px;">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 14px; font-weight: 500; color: #333;">Data PGTO Restante</label> 
										<input type="date" class="form-control inputs_form" name="data_pgto_restante" id="data_pgto_restante" value="" style="height: 34px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; width: 100%;"> 
									</div>						
								</div>
							</div>

							<!-- Forma PGTO Restante -->
							<div class="row" style="margin-bottom: 12px;">
								<div class="col-md-12">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 13px; font-weight: 500; color: #333;">Forma PGTO Restante</label> 
										<select class="form-control inputs_form" id="pgto_restante" name="pgto_restante" style="width:100%; height: 32px; font-size: 13px; border: 1px solid #ddd; border-radius: 4px;"> 
											<option value="">Selecionar Pgto</option>
											<?php 
											$query = $pdo->query("SELECT * FROM formas_pgto");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['nome'].'">'.$res[$i]['nome'].'</option>';
												}
											}
											?>
										</select>    
									</div>						
								</div>
							</div>

							<!-- Divisor -->
							<div style="border-bottom: 1px solid #e0e0e0; margin: 12px 0;"></div>

							<!-- Fechar Comanda -->
							<div class="row" style="margin-bottom: 12px;">
								<div class="col-md-12">						
									<div class="form-group" style="margin-bottom: 10px;"> 
										<label style="margin-bottom: 5px; font-size: 13px; font-weight: 500; color: #333;">Fechar comanda ao Salvar</label> 
										<select class="form-control inputs_form" id="salvar_comanda" name="salvar_comanda" style="width:100%; height: 32px; font-size: 13px; border: 1px solid #ddd; border-radius: 4px;"> 
											<option value="">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>						
								</div>
							</div>

							<!-- Botões de Ação -->
							<div class="row">
								<div class="col-md-12" style="text-align: right; padding-top: 10px;">
									<a href="#" id="btn_fechar_comanda" onclick="fecharComanda()" class="btn btn-success btn-sm" style="margin-right: 8px; padding: 6px 12px; border-radius: 4px;">Fechar Comanda</a>
									<button type="submit" class="btn btn-primary btn-sm" style="padding: 6px 12px; border-radius: 4px;">Salvar</button>	
								</div>	
							</div>

						</div>
					</div>

					<!-- Campos Hidden -->
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="valor_servicos" id="valor_servicos">
					<input type="hidden" name="valor_produtos" id="valor_produtos">

					<!-- Mensagem -->
					<div style="margin-top: 10px;">
						<small><div id="mensagem" align="center"></div></small>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>






<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Informações da Comanda</h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-8">						
						<span><b>Cliente: </b></span>
						<span id="cliente_dados"></span>						
					</div>
					<div class="col-md-4">						
						<span><b>Valor: </b></span>
						<span id="valor_dados"></span>
					</div>					

				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-8">						
						<span><b>Aberta Por: </b></span>
						<span id="func_dados"></span>						
					</div>
					<div class="col-md-4">						
						<span><b>Data: </b></span>
						<span id="data_dados"></span>
					</div>					

				</div>

				<div class="row">
				<div class="col-md-12" style="border: 1px solid #5c5c5c; margin-bottom: 5px;" id="listar_servicos_dados">
							
						</div>
				</div>

				<div class="row">
					<div class="col-md-12" style="border: 1px solid #5c5c5c; margin-bottom: 5px; " id="listar_produtos_dados">
							
						</div>
					</div>


			</div>

			
		</div>
	</div>
</div>






<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		
		var id = $("#id").val();
		listarServicos(id)
		listarProdutos(id)
		calcular()

		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
	});
</script>



<script type="text/javascript">
	function valorData(dataInicio, dataFinal){
	 $('#data-inicial-caixa').val(dataInicio);
	 $('#data-final-caixa').val(dataFinal);	
	listar();
	
}
</script>



<script type="text/javascript">
	$('#data-inicial-caixa').change(function(){
			//$('#tipo-busca').val('');
			listar();
		});

		$('#data-final-caixa').change(function(){						
			//$('#tipo-busca').val('');
			listar();
		});	
</script>





<script type="text/javascript">
	function listar(){

	var dataInicial = $('#data-inicial-caixa').val();
	var dataFinal = $('#data-final-caixa').val();	
	var status = $('#buscar-contas').val();	
	
    $.ajax({
        url: 'paginas/' + pag + "/listar.php",
        method: 'POST',
        data: {dataInicial, dataFinal, status},
        dataType: "html",

        success:function(result){
            $("#listar").html(result);
            $('#mensagem-excluir').text('');
        }
    });
}
</script>



<script type="text/javascript">
	function buscarContas(status){
	 $('#buscar-contas').val(status);
	 listar();
	}
</script>






<script type="text/javascript">
	function calcular(){

		setTimeout(function() {
	  		var produtos = $('#valor_produtos').val();
			var servicos = $('#valor_servicos').val();

			var total = parseFloat(produtos) + parseFloat(servicos);
			$('#valor_serv').val(total.toFixed(2));

			abaterValor();

		}, 500)



}
</script>


<script type="text/javascript">
	function inserirServico(){	
		$("#mensagem").text('');
		var servico = $("#servico").val();
		var funcionario = $("#funcionario").val();
		var cliente = $("#cliente").val();
		var id = $("#id").val();

		if(cliente == ""){
			alert("Selecione um Cliente")
			return;
		}

		if(servico == ""){
			alert("Selecione um Serviço")
			return;
		}
		$.ajax({
			url: 'paginas/' + pag + "/inserir_servico.php",
			method: 'POST',
			data: {servico, funcionario, cliente, id},
			dataType: "text",

			success:function(result){
				if(result.trim() === 'Salvo com Sucesso'){
					listarServicos(id)
					calcular();
				}else{
					$("#mensagem").text(result);
				}
			}
		});
	}
</script>



<script type="text/javascript">
	function listarServicos(id){
	
		$.ajax({
			url: 'paginas/' + pag + "/listar_servicos.php",
			method: 'POST',
			data: {id},
			dataType: "text",

			success:function(result){
				$("#listar_servicos").html(result);
			}
		});
	}
</script>



<script type="text/javascript">
	function inserirProduto(){	
		$("#mensagem").text('');
		var produto = $("#produto").val();
		var funcionario = $("#funcionario2").val();
		var cliente = $("#cliente").val();
		var quantidade = $("#quantidade").val();
		var id = $("#id").val();

		if(produto == ""){
			alert("Selecione um Produto")
			return;
		}
		$.ajax({
			url: 'paginas/' + pag + "/inserir_produto.php",
			method: 'POST',
			data: {produto, funcionario, cliente, quantidade, id},
			dataType: "text",

			success:function(result){
				if(result.trim() === 'Salvo com Sucesso'){
					listarProdutos(id);
					calcular();
					$("#quantidade").val('1');
				}else{
					$("#mensagem").text(result);
				}
			}
		});
	}
</script>



<script type="text/javascript">
	function listarProdutos(id){
	
		$.ajax({
			url: 'paginas/' + pag + "/listar_produtos.php",
			method: 'POST',
			data: {id},
			dataType: "text",

			success:function(result){
				$("#listar_produtos").html(result);
			}
		});
	}
</script>


<script type="text/javascript">
	function fecharComanda(){

		var cliente = $("#cliente").val();
		var valor = $("#valor_serv").val();
		var valor_restante = $("#valor_serv_agd_restante").val();
		var data_pgto = $("#data_pgto").val();
		var data_pgto_restante = $("#data_pgto_restante").val();
		var pgto_restante = $("#pgto_restante").val();
		var pgto = $("#pgto").val();
		var id = $("#id").val();

		if(valor_restante > 0){
			if(data_pgto_restante == "" ||  pgto_restante == ""){
				alert('Preencha a Data de Pagamento Restante e o tipo de Pagamento Restante');
				return;
			}
		}

		$.ajax({
			url: 'paginas/' + pag + "/fechar_comanda.php",
			method: 'POST',
			data: {id, valor, valor_restante, data_pgto, data_pgto_restante, pgto_restante, pgto, cliente},
			dataType: "text",

			success:function(result){

				if(result.trim() === 'Salvo com Sucesso'){
					$('#btn-fechar').click();
					listar();	

					$('#data_pgto').val('<?=$data_hoje?>');	
					$('#valor_serv_agd_restante').val('');
					$('#data_pgto_restante').val('');
					$('#pgto_restante').val('').change();		
					
				}else{
					$("#mensagem").text(result);
				}
			}
		});
	}
</script>




<script type="text/javascript">
	function listarProdutosDados(id){
	
		$.ajax({
			url: 'paginas/' + pag + "/listar_produtos_dados.php",
			method: 'POST',
			data: {id},
			dataType: "text",

			success:function(result){
				$("#listar_produtos_dados").html(result);
			}
		});
	}
</script>


<script type="text/javascript">
	function listarServicosDados(id){
	
		$.ajax({
			url: 'paginas/' + pag + "/listar_servicos_dados.php",
			method: 'POST',
			data: {id},
			dataType: "text",

			success:function(result){
				$("#listar_servicos_dados").html(result);
			}
		});
	}
</script>


<script type="text/javascript">
	$("#form_salvar").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
        	var msg = mensagem.split("*");
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (msg[0].trim() == "Salvo com Sucesso") {

            	var salvar = $('#salvar_comanda').val();
            	
            	if(salvar == 'Sim'){
            		$("#id").val(msg[1]);            		
            		fecharComanda();
            	}
                $('#btn-fechar').click();
                listar();          

            } else {

                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(msg[0])
            }


           


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


</script>



<script type="text/javascript">
	function abaterValor(){

		var produtos = $('#valor_produtos').val();
		var servicos = $('#valor_servicos').val();

		var total_valores = parseFloat(produtos) + parseFloat(servicos);

		var valor = $("#valor_serv").val(); 
		var valor_rest = $("#valor_serv_agd_restante").val();

		if(valor == ""){
			valor = 0;
		} 

		if(valor_rest == ""){
			valor_rest = 0;
		} 

		var total = parseFloat(total_valores) - parseFloat(valor_rest);
			$('#valor_serv').val(total.toFixed(2));

	}
</script>
<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'funcionarios';

//verificar se ele tem a permissão de estar nessa página
if(@$funcionarios == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Funcionário</a>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>






<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			<form id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>    
							</div> 	
						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email"  required>    
							</div> 	
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" >    
							</div> 	
						</div>
						<div class="col-md-4">
							
							<div class="form-group">
								<label for="exampleInputEmail1">CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" >    
							</div> 	
						</div>

						<div class="col-md-4">
							
							<div class="form-group">
								<label for="exampleInputEmail1">Cargo</label>
								<select class="form-control sel2" id="cargo" name="cargo" style="width:100%;" > 

									<?php 
									$query = $pdo->query("SELECT * FROM cargos where nome != 'Administrador' ORDER BY nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){
										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){}
												echo '<option value="'.$res[$i]['nome'].'">'.$res[$i]['nome'].'</option>';
										}
									}else{
										echo '<option value="0">Cadastre um Cargo</option>';
									}
									?>
									

								</select>   
							</div> 	
						</div>
					</div>

					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Atendimento</label>
								<select class="form-control" name="atendimento" id="atendimento">
									<option value="Sim">Sim</option>
									<option value="Não">Não</option>
								</select>  
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Tipo Chave Pix</label>
								<select class="form-control" name="tipo_chave" id="tipo_chave">
									<option value="">Selecionar Chave</option>
									<option value="CPF">CPF</option>
									<option value="Telefone">Telefone</option>
									<option value="Email">Email</option>
									<option value="Código">Código</option>
									<option value="CNPJ">CNPJ</option>
								</select>  
							</div> 	
						</div>



						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Chave Pix</label>
								<input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Chave Pix" > 
							</div> 	
						</div>



					</div>

					

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua X Número 1 Bairro xxx" >    
							</div> 	
						</div>

										
						
					</div>



					<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Intervalo Minutos</label>
								<input type="number" class="form-control" id="intervalo" name="intervalo" placeholder="Intervalo Horários" required>    
							</div> 	
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Comissão <small>(Se for Diferente do Padrão)</small></label>
								<input type="number" class="form-control" id="comissao" name="comissao" placeholder="Valor R$ ou %" >    
							</div> 	
						</div>
						
						
					</div>





					<div class="row">
						<div class="col-md-8">						
							<div class="form-group"> 
								<label>Foto</label> 
								<input class="form-control" type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>
						<div class="col-md-4">
							<div id="divImg">
								<img src="img/perfil/sem-foto.jpg"  width="80px" id="target">									
							</div>
						</div>

					</div>


					
					<input type="hidden" name="id" id="id">

					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>

				<div class="modal-footer">      
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

			
		</div>
	</div>
</div>





<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">
					<i class="fa fa-eye mr-2"></i>
					<span id="nome_dados"></span>
				</h4>
				<button id="btn-fechar-perfil" type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body p-4" style="max-height: 70vh; overflow-y: auto;">
				<!-- Informações Principais -->
				<div class="card">
					<div class="card-header bg-light">
						<h6 class="mb-0"><i class="fa fa-user mr-2"></i>Informações do Funcionário</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<!-- Coluna das Informações -->
							<div class="col-md-7">
								<!-- Lista de Dados em Coluna -->
								<div class="employee-info-list">
									<!-- Email -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-primary d-block mb-1">
											<i class="fa fa-envelope mr-2"></i>Email:
										</label>
										<span id="email_dados" class="text-break text-muted"></span>
									</div>

									<!-- CPF -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-info d-block mb-1">
											<i class="fa fa-id-card mr-2"></i>CPF:
										</label>
										<span id="cpf_dados" class="text-muted"></span>
									</div>

									<!-- Telefone -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-success d-block mb-1">
											<i class="fa fa-phone mr-2"></i>Telefone:
										</label>
										<span id="telefone_dados" class="text-success"></span>
									</div>

									<!-- Nível -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-warning d-block mb-1">
											<i class="fa fa-star mr-2"></i>Nível:
										</label>
										<span id="nivel_dados" class="badge badge-warning"></span>
									</div>

									<!-- Status Ativo -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-info d-block mb-1">
											<i class="fa fa-check-circle mr-2"></i>Status:
										</label>
										<span id="ativo_dados" class="badge badge-info"></span>
									</div>

									<!-- Atendimento -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-primary d-block mb-1">
											<i class="fa fa-calendar mr-2"></i>Atendimento:
										</label>
										<span id="atendimento_dados" class="badge badge-primary"></span>
									</div>

									<!-- Data de Cadastro -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-secondary d-block mb-1">
											<i class="fa fa-calendar-plus mr-2"></i>Data de Cadastro:
										</label>
										<span id="data_dados" class="text-muted"></span>
									</div>

									<!-- Senha -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-secondary d-block mb-1">
											<i class="fa fa-lock mr-2"></i>Senha:
										</label>
										<span id="senha_dados" class="text-muted">••••••••</span>
									</div>

									<!-- Tipo Chave PIX -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-success d-block mb-1">
											<i class="fa fa-credit-card mr-2"></i>Tipo Chave PIX:
										</label>
										<span id="tipo_chave_dados" class="text-muted"></span>
									</div>

									<!-- Chave PIX -->
									<div class="info-item mb-3 pb-3 border-bottom">
										<label class="font-weight-bold text-success d-block mb-1">
											<i class="fa fa-key mr-2"></i>Chave PIX:
										</label>
										<span id="chave_pix_dados" class="text-break text-muted"></span>
									</div>

									<!-- Endereço -->
									<div class="info-item">
										<label class="font-weight-bold text-secondary d-block mb-2">
											<i class="fa fa-map-marker mr-2"></i>Endereço Completo:
										</label>
										<div class="p-3 bg-light rounded border-left border-primary" style="border-left-width: 4px !important;">
											<span id="endereco_dados" class="text-muted"></span>
										</div>
									</div>
								</div>
							</div>

							<!-- Coluna da Imagem Ampliada -->
							<div class="col-md-5">
								<div class="employee-image-section h-100 d-flex flex-column">
									<div class="text-center mb-3">
										<label class="font-weight-bold text-secondary">
											<i class="fa fa-camera mr-2"></i>Foto do Funcionário
										</label>
									</div>
									<div class="employee-image-container text-center flex-grow-1 d-flex align-items-center justify-content-center">
										<img id="target_mostrar" class="rounded shadow-lg border" style="width: 300px; height: 300px; object-fit: cover; border-width: 3px !important;">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer bg-light">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					<i class="fa fa-times mr-2"></i>Fechar
				</button>
			</div>
		</div>
	</div>
</div>






<!-- Modal Horarios-->
<div class="modal fade" id="modalHorarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_horarios"></span></h4>
				<button id="btn-fechar-horarios" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form id="form-horarios">
				<div class="row">
					<div class="col-md-4">						
						<div class="form-group">
							<label for="exampleInputEmail1">Horário</label>
							<input type="time" class="form-control" id="horario" name="horario" required>    
						</div> 	
					</div>

					<div class="col-md-4">						
						<button type="submit" class="btn btn-primary" style="margin-top:20px">Salvar</button>
					</div>

					<input type="hidden" name="id" id="id_horarios">

				</div>
				</form>

				<hr>
				<div class="" id="listar-horarios">
					
				</div>

				<br>
				<small><div id="mensagem-horarios"></div></small>

			</div>

			
		</div>
	</div>
</div>





<!-- Modal Dias-->
<div class="modal fade" id="modalDias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:80%" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_dias"></span></h4>
				<button id="btn-fechar-dias" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				
				<form id="form-dias">
				<div class="row">
					<div class="col-md-2">						
						<div class="form-group">
							<label for="exampleInputEmail1">Dia</label>
							<select class="form-control" id="dias" name="dias"  required> 
                                    <option value="Segunda-Feira">Segunda-Feira</option>    
                                    <option value="Terça-Feira">Terça-Feira</option>
                                    <option value="Quarta-Feira">Quarta-Feira</option>
                                    <option value="Quinta-Feira">Quinta-Feira</option>
                                    <option value="Sexta-Feira">Sexta-Feira</option>
                                    <option value="Sábado">Sábado</option>
                                    <option value="Domingo">Domingo</option>
                                                    

                                </select>      
						</div>

                      

                   
					</div>

                      <div class="col-md-4" align="center">  
                      <label for="exampleInputEmail1">(Início) Jornada de Trabalho (Final)</label>                  
                            <div class="row" style="margin-top: 2px">
                                <div class="col-md-6">
 <input type="time" name="inicio" class="form-control" id="inicio" required>
                                </div>

                                <div class="col-md-6">
                                    
                                     <input type="time" name="final" class="form-control" id="final" required>

                                </div>
                            </div>                         
                         
                    </div>

                    <div class="col-md-4" align="center">  
                      <label for="exampleInputEmail1">(Início) Intervalo de Almoço (Final)</label>                  
                            <div class="row" style="margin-top: 2px">
                                <div class="col-md-6">
 <input type="time" name="inicio_almoco" class="form-control" id="inicio_almoco" >
                                </div>

                                <div class="col-md-6">
                                    
                                     <input type="time" name="final_almoco" class="form-control" id="final_almoco" >

                                </div>
                            </div>                         
                         
                    </div>

					<div class="col-md-2">						
						<button type="submit" class="btn btn-primary" style="margin-top:22px">Salvar</button>
					</div>

					<input type="hidden" name="id" id="id_dias" value="<?php echo $id_usuario ?>">

                    <input type="hidden" name="id_d" id="id_d">

				</div>
				</form>

<small><div id="mensagem-dias"></div></small>

<big>
<div class="bs-example widget-shadow" style="padding:15px" id="listar-dias">
	
</div>
</big>


			</div>

			
		</div>
	</div>
</div>






<!-- Modal Servicos-->
<div class="modal fade" id="modalServicos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_servico"></span></h4>
				<button id="btn-fechar-servico" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form id="form-servico">
				<div class="row">
					<div class="col-md-6">						
						<div class="form-group">
							<label for="exampleInputEmail1">Serviço</label>
							<select class="form-control sel3" id="servico" name="servico" style="width:100%;" required> 

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

					<div class="col-md-4">						
						<button type="submit" class="btn btn-primary" style="margin-top:20px">Salvar</button>
					</div>

					<input type="hidden" name="id" id="id_servico">

				</div>
				</form>

				<hr>
				<div class="" id="listar-servicos">
					
				</div>

				<br>
				<small><div id="mensagem-servicos"></div></small>

			</div>

			
		</div>
	</div>
</div>






<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
	});
</script>


<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>



<script type="text/javascript">
	

$("#form-dias").submit(function () {

	var func = $("#id_dias").val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/inserir-dias.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-dias').text('');
            $('#mensagem-dias').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                //$('#btn-fechar-horarios').click();
                $("#id_d").val('');   
                listarDias(func);


            } else {

                $('#mensagem-dias').addClass('text-danger')
                $('#mensagem-dias').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


</script>


<script type="text/javascript">
	function listarDias(func){
		
    $.ajax({
        url: 'paginas/' + pag + "/listar-dias.php",
        method: 'POST',
        data: {func},
        dataType: "html",

        success:function(result){
            $("#listar-dias").html(result);
            $('#mensagem-dias-excluir').text('');
        }
    });
}

</script>

<script type="text/javascript">


$("#form-servico").submit(function () {

	var func = $("#id_servico").val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/inserir-servico.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-servicos').text('');
            $('#mensagem-servicos').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                //$('#btn-fechar-horarios').click();
                listarServicos(func);          

            } else {

                $('#mensagem-servicos').addClass('text-danger')
                $('#mensagem-servicos').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


</script>


<script type="text/javascript">
	function listarServicos(func){
		
    $.ajax({
        url: 'paginas/' + pag + "/listar-servicos.php",
        method: 'POST',
        data: {func},
        dataType: "html",

        success:function(result){
            $("#listar-servicos").html(result);
            $('#mensagem-servico-excluir').text('');
        }
    });
}

</script>





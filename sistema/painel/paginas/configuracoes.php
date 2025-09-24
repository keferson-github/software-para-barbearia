<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'configuracoes';
$data_atual = date('Y-m-d');

//verificar se ele tem a permissão de estar nessa página
if(@$configuracoes == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>

<div class="configuracoes-container">
	<div class="configuracoes-header">
		<h2><i class="fa fa-cogs"></i> Configurações do Sistema</h2>
		<p>Gerencie as configurações gerais da sua barbearia</p>
	</div>

	<form method="post" id="form-config">
		
		<!-- Seção: Informações da Barbearia -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-building"></i> Informações da Barbearia</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="fa fa-home"></i> Nome da Barbearia</label>
							<input type="text" class="form-control" id="nome_sistema" name="nome_sistema" placeholder="Nome da Barbearia" value="<?php echo $nome_sistema ?>" required>    
						</div> 	
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="fa fa-envelope"></i> Email da Barbearia</label>
							<input type="email" class="form-control" id="email_sistema" name="email_sistema" placeholder="Email" value="<?php echo $email_sistema ?>" required>    
						</div> 	
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="fa fa-whatsapp"></i> WhatsApp da Barbearia</label>
							<input type="text" class="form-control" id="whatsapp_sistema" name="whatsapp_sistema" placeholder="WhatsApp" value="<?php echo $whatsapp_sistema ?>" required>    
						</div> 	
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-phone"></i> Telefone Fixo</label>
							<input type="text" class="form-control" id="telefone_fixo_sistema" name="telefone_fixo_sistema" placeholder="Telefone Fixo" value="<?php echo $telefone_fixo_sistema ?>" required>    
						</div> 	
					</div>
					<div class="col-md-7">
						<div class="form-group">
							<label><i class="fa fa-map-marker"></i> Endereço Completo</label>
							<input type="text" class="form-control" id="endereco_sistema" name="endereco_sistema" placeholder="Rua X Numero X Bairro Cidade" value="<?php echo $endereco_sistema ?>">    
						</div> 	
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-file-pdf-o"></i> Tipo Relatório</label>
							<select class="form-control" name="tipo_rel" id="tipo_rel">
								<option value="PDF" <?php if($tipo_rel == 'PDF'){?> selected <?php } ?> >PDF</option>
								<option value="HTML" <?php if($tipo_rel == 'HTML'){?> selected <?php } ?> >HTML</option>
							</select>   
						</div> 	
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-id-card"></i> CNPJ</label>
							<input type="text" class="form-control" id="cnpj_sistema" name="cnpj_sistema" value="<?php echo $cnpj_sistema ?>">    
						</div> 
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-map-pin"></i> Cidade</label>
							<input type="text" class="form-control" id="cidade_sistema" name="cidade_sistema" value="<?php echo $cidade_sistema ?>" placeholder="Cidade para o contrato">    
						</div> 
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label><i class="fa fa-instagram"></i> Instagram</label>
							<input type="text" class="form-control" id="instagram_sistema" name="instagram_sistema" placeholder="Link do Perfil no Instagram" value="<?php echo $instagram_sistema ?>">   
						</div> 	
					</div>
				</div>
			</div>
		</div>

		<!-- Seção: Configurações do Site -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-globe"></i> Configurações do Site</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label><i class="fa fa-map"></i> Mapa do Site <small>(URL incorporada)</small></label>
							<input type="text" class="form-control" id="mapa" name="mapa" placeholder="URL do Google Maps incorporada" value='<?php echo $mapa ?>'>  
						</div> 	
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label><i class="fa fa-text-width"></i> Texto Rodapé Site <small>(255 caracteres)</small></label>
							<input maxlength="255" type="text" class="form-control" id="texto_rodape" name="texto_rodape" placeholder="Texto para o Rodapé do site" value="<?php echo $texto_rodape ?>">   
						</div> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label><i class="fa fa-info-circle"></i> Texto Sobre (Site) <small>(600 caracteres)</small></label>
							<input maxlength="255" type="text" class="form-control" id="texto_sobre" name="texto_sobre" placeholder="Texto para a área Sobre a empresa no site" value="<?php echo $texto_sobre ?>">   
						</div> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><i class="fa fa-video-camera"></i> URL do Vídeo Index</label>
							<input type="text" class="form-control" id="url_video" name="url_video" value="<?php echo $url_video ?>" placeholder="URL do YouTube incorporada">    
						</div> 
					</div>	
					<div class="col-md-6">
						<div class="form-group">
							<label><i class="fa fa-arrows"></i> Posição do Vídeo</label>
							<select class="form-control" name="posicao_video" id="posicao_video">
								<option value="sobre" <?php if($posicao_video == 'sobre'){?> selected <?php } ?> >Encima da Imagem Sobre</option>
								<option value="abaixo" <?php if($posicao_video == 'abaixo'){?> selected <?php } ?> >Abaixo da Área Sobre</option>
							</select>      
						</div> 
					</div>
				</div>
			</div>
		</div>

		<!-- Seção: Sistema de Agendamento -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-calendar"></i> Sistema de Agendamento</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label><i class="fa fa-gift"></i> Texto Cartão Fidelidade</label>
							<input maxlength="255" type="text" class="form-control" id="texto_fidelidade" name="texto_fidelidade" placeholder="Parabéns, você completou seus cartões, você ganhou ..." value="<?php echo @$texto_fidelidade ?>">   
						</div> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-credit-card"></i> Cartões Troca</label>
							<input type="number" class="form-control" id="quantidade_cartoes" name="quantidade_cartoes" placeholder="Quantidade" value="<?php echo $quantidade_cartoes ?>">   
						</div> 
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-user"></i> Texto Agendamento</label>
							<input maxlength="30" type="text" class="form-control" id="texto_agendamento" name="texto_agendamento" placeholder="Selecionar Profissional" value="<?php echo $texto_agendamento ?>">   
						</div> 
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-bell"></i> Notificações</label>
							<select class="form-control" name="msg_agendamento" id="msg_agendamento">
								<option value="Sim" <?php if($msg_agendamento == 'Sim'){?> selected <?php } ?> >Sim</option>
								<option value="Não" <?php if($msg_agendamento == 'Não'){?> selected <?php } ?> >Não</option>
								<option value="Api" <?php if($msg_agendamento == 'Api'){?> selected <?php } ?> >API Paga</option>
							</select>      
						</div> 
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-clock-o"></i> Horas Confirmação</label>
							<input type="number" class="form-control" id="minutos_aviso" name="minutos_aviso" placeholder="Horas" value="<?php echo @$minutos_aviso ?>">   
						</div> 
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-calendar-times-o"></i> Manter Agendamento (Dias)</label>
							<input type="number" class="form-control" id="agendamento_dias" name="agendamento_dias" value="<?php echo $agendamento_dias ?>" placeholder="Dias no banco">    
						</div> 
					</div>
				</div>
			</div>
		</div>

		<!-- Seção: API WhatsApp -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-whatsapp"></i> Configurações API WhatsApp</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-cog"></i> Seletor de API</label>
							<select class="form-control" name="api" id="api">
								<option value="menuia" <?php if($api == 'menuia'){?> selected <?php } ?> >Menuia</option>
								<option value="outros" <?php if($api == 'outros'){?> selected <?php } ?> >Word Mensagens</option>
							</select>      
						</div> 
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="fa fa-key"></i> Token (authkey)</label>
							<input type="text" class="form-control" id="token" name="token" placeholder="Token API WhatsApp" value="<?php echo @$token ?>">   
						</div> 
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label><i class="fa fa-server"></i> Instância (appkey)</label>
							<input type="text" class="form-control" id="instancia" name="instancia" placeholder="Instância API WhatsApp" value="<?php echo @$instancia ?>">   
						</div> 
					</div>
				</div>
			</div>
		</div>

		<!-- Seção: Configurações Financeiras -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-money"></i> Configurações Financeiras</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-credit-card"></i> Taxa Pgto Serviço</label>
							<select class="form-control" name="taxa_sistema" id="taxa_sistema">
								<option value="Cliente" <?php if(@$taxa_sistema == 'Cliente'){?> selected <?php } ?> >Cliente Paga</option>
								<option value="Empresa" <?php if(@$taxa_sistema == 'Empresa'){?> selected <?php } ?> >Salão Paga</option>
							</select>      
						</div> 
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-percent"></i> Tipo Comissão</label>
							<select class="form-control" name="tipo_comissao" id="tipo_comissao">
								<option value="Porcentagem" <?php if($tipo_comissao == 'Porcentagem'){?> selected <?php } ?> >Porcentagem</option>
								<option value="R$" <?php if($tipo_comissao == 'R$'){?> selected <?php } ?> >R$ Reais</option>
							</select>   
						</div> 	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label><i class="fa fa-list"></i> Lançamento Comissão</label>
							<select class="form-control" name="lanc_comissao" id="lanc_comissao">
								<option value="Sempre" <?php if($lanc_comissao == 'Sempre'){?> selected <?php } ?> >Serviço Pendente e Pago</option>
								<option value="Pago" <?php if($lanc_comissao == 'Pago'){?> selected <?php } ?> >Serviço Pago</option>
							</select>   
						</div> 	
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-percent"></i> % Agendamento</label>
							<input type="number" class="form-control" id="porc_servico" name="porc_servico" placeholder="%" value="<?php echo $porc_servico ?>">   
						</div> 
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label><i class="fa fa-credit-card"></i> API Pgto</label>
							<select class="form-control" name="pgto_api" id="pgto_api">
								<option value="Sim" <?php if($pgto_api == 'Sim'){?> selected <?php } ?> >Sim</option>
								<option value="Não" <?php if($pgto_api == 'Não'){?> selected <?php } ?> >Não</option>
							</select>      
						</div> 
					</div>
				</div>
			</div>
		</div>

		<!-- Seção: Configurações do Sistema -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-cogs"></i> Configurações do Sistema</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><i class="fa fa-list"></i> Itens por Página</label>
							<input type="number" class="form-control" id="itens_pag" name="itens_pag" value="<?php echo $itens_pag ?>" placeholder="Número de itens">    
						</div> 
					</div>
				</div>
			</div>
		</div>

		<!-- Seção: Imagens do Sistema -->
		<div class="config-card">
			<div class="card-header">
				<h4><i class="fa fa-image"></i> Imagens do Sistema</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">						
						<div class="form-group"> 
							<label><i class="fa fa-picture-o"></i> Logo (*PNG)</label> 
							<input class="form-control" type="file" name="foto-logo" onChange="carregarImgLogo();" id="foto-logo">
						</div>						
					</div>
					<div class="col-md-2">
						<div class="image-preview">
							<img src="../img/<?php echo $logo_sistema ?>" width="80px" id="target-logo">									
						</div>
					</div>
					<div class="col-md-3">						
						<div class="form-group"> 
							<label><i class="fa fa-star"></i> Ícone (*PNG)</label> 
							<input class="form-control" type="file" name="foto-icone" onChange="carregarImgIcone();" id="foto-icone">
						</div>						
					</div>
					<div class="col-md-2">
						<div class="image-preview">
							<img src="../img/<?php echo $icone_sistema ?>" width="50px" id="target-icone">									
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">						
						<div class="form-group"> 
							<label><i class="fa fa-file-pdf-o"></i> Logo Relatório (*JPG)</label> 
							<input class="form-control" type="file" name="foto-logo-rel" onChange="carregarImgLogoRel();" id="foto-logo-rel">
						</div>						
					</div>
					<div class="col-md-2">
						<div class="image-preview">
							<img src="../img/<?php echo $logo_rel ?>" width="80px" id="target-logo-rel">									
						</div>
					</div>
					<div class="col-md-3">						
						<div class="form-group"> 
							<label><i class="fa fa-globe"></i> Ícone Site (*PNG)</label> 
							<input class="form-control" type="file" name="foto-icone-site" onChange="carregarImgIconeSite();" id="foto-icone-site">
						</div>						
					</div>
					<div class="col-md-2">
						<div class="image-preview">
							<img src="../../images/<?php echo $icone_site ?>" width="50px" id="target-icone-site">									
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">						
						<div class="form-group"> 
							<label><i class="fa fa-info"></i> Imagem Área Sobre (Site)</label> 
							<input class="form-control" type="file" name="foto-sobre" onChange="carregarImgSobre();" id="foto-sobre">
						</div>						
					</div>
					<div class="col-md-2">
						<div class="image-preview">
							<img src="../../images/<?php echo $imagem_sobre ?>" width="80px" id="target-sobre">									
						</div>
					</div>
					<div class="col-md-3">						
						<div class="form-group"> 
							<label><i class="fa fa-picture-o"></i> Banner Index <small>(1500x1000)</small></label> 
							<input class="form-control" type="file" name="foto-banner-index" onChange="carregarImgBannerIndex();" id="foto-banner-index">
						</div>						
					</div>
					<div class="col-md-2">
						<div class="image-preview">
							<img src="../../images/<?php echo $img_banner_index ?>" width="80px" id="target-banner-index">									
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-actions">
			<div id="mensagem-config" class="alert-message"></div>
			<button type="submit" class="btn btn-primary btn-save">
				<i class="fa fa-save"></i> Salvar Configurações
			</button>
		</div>
	</form>	
</div>

<style>
/* Container principal das configurações */
.configuracoes-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

/* Cabeçalho da página */
.configuracoes-header {
    text-align: center;
    margin-bottom: 30px;
    padding: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.configuracoes-header h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 700;
}

.configuracoes-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

/* Cards de configuração */
.config-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
}

.config-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

/* Cabeçalho dos cards */
.card-header {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    padding: 20px 25px;
    border-bottom: none;
}

.card-header h4 {
    color: white;
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header i {
    font-size: 1.2rem;
}

/* Corpo dos cards */
.card-body {
    padding: 25px;
}

/* Grupos de formulário */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
}

.form-group label i {
    color: #3498db;
    width: 16px;
}

/* Estilos dos inputs */
.form-control {
    height: 45px !important;
    padding: 12px 15px !important;
    border-radius: 10px !important;
    border: 2px solid #e1e8ed !important;
    font-size: 14px !important;
    transition: all 0.3s ease !important;
    background: #f8f9fa !important;
}

.form-control:focus {
    border-color: #4facfe !important;
    box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25) !important;
    background: white !important;
    outline: none !important;
}

.form-control:hover:not(:focus) {
    border-color: #bdc3c7 !important;
    background: white !important;
}

/* Inputs de arquivo */
input[type="file"].form-control {
    height: auto !important;
    padding: 10px 15px !important;
    background: white !important;
}

/* Selects */
select.form-control {
    background: #f8f9fa url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") no-repeat right 12px center/16px 16px !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
}

select.form-control:focus {
    background-color: white !important;
}

/* Preview de imagens */
.image-preview {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 2px dashed #dee2e6;
    min-height: 80px;
}

.image-preview img {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    max-width: 100%;
    height: auto;
}

/* Ações do formulário */
.form-actions {
    text-align: center;
    padding: 30px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    margin-top: 20px;
}

.btn-save {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border: none !important;
    padding: 15px 40px !important;
    font-size: 1.1rem !important;
    font-weight: 600 !important;
    border-radius: 50px !important;
    color: white !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3) !important;
}

.btn-save:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4) !important;
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
}

.btn-save:active {
    transform: translateY(0) !important;
}

/* Mensagem de alerta */
.alert-message {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 10px;
    font-weight: 500;
}

/* Responsividade */
@media (max-width: 768px) {
    .configuracoes-container {
        padding: 15px;
    }
    
    .configuracoes-header {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .configuracoes-header h2 {
        font-size: 2rem;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .form-actions {
        padding: 20px;
    }
    
    .btn-save {
        width: 100%;
        padding: 12px 20px !important;
    }
}

@media (max-width: 576px) {
    .configuracoes-header h2 {
        font-size: 1.8rem;
    }
    
    .card-header h4 {
        font-size: 1.1rem;
    }
    
    .form-control {
        height: 40px !important;
        font-size: 13px !important;
    }
}

/* Animações */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.config-card {
    animation: fadeInUp 0.6s ease forwards;
}

.config-card:nth-child(1) { animation-delay: 0.1s; }
.config-card:nth-child(2) { animation-delay: 0.2s; }
.config-card:nth-child(3) { animation-delay: 0.3s; }
.config-card:nth-child(4) { animation-delay: 0.4s; }
.config-card:nth-child(5) { animation-delay: 0.5s; }
.config-card:nth-child(6) { animation-delay: 0.6s; }
.config-card:nth-child(7) { animation-delay: 0.7s; }

/* Melhorias de acessibilidade */
.form-control:focus {
    outline: 2px solid #4facfe;
    outline-offset: 2px;
}

/* Estados de validação */
.form-control.is-valid {
    border-color: #28a745 !important;
}

.form-control.is-invalid {
    border-color: #dc3545 !important;
}

/* Tooltips personalizados */
.form-group small {
    color: #6c757d;
    font-style: italic;
}
</style>
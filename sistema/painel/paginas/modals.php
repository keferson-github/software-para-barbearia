<?php
/**
 * Arquivo Centralizado de Modais
 * Sistema de Barbearia - Modais Responsivos
 * 
 * Este arquivo contém todos os modais utilizados no sistema,
 * centralizados para facilitar manutenção e consistência.
 */
?>

<!-- ========== MODAL FORM (Inserir/Editar) ========== -->


<!-- ========== MODAL FORM LARGE (Inserir/Editar - Versão Grande) ========== -->
<div class="modal fade" id="modalFormLarge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titulo_inserir_large"></span></h4>
                <button id="btn-fechar-large" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-large">
                <div class="modal-body" id="modal-form-large-body">
                    <!-- Conteúdo dinâmico será inserido aqui -->
                </div>
                <div class="modal-footer">      
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========== MODAL DADOS (Visualizar Detalhes) ========== -->

</div>

<!-- ========== MODAL DADOS LARGE (Visualizar Detalhes - Versão Grande) ========== -->
<div class="modal fade" id="modalDadosLarge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-eye mr-2"></i>
                    <span id="nome_dados_large"></span>
                </h4>
                <button id="btn-fechar-perfil-large" type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="modal-dados-large-body">
                <!-- Conteúdo dinâmico será inserido aqui -->
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times mr-2"></i>Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL ENTRADA (Entrada de Estoque) ========== -->

</div>

<!-- ========== MODAL SAÍDA (Saída de Estoque) ========== -->

</div>

<!-- ========== MODAL BAIXAR (Baixar Conta/Pagamento) ========== -->

                    <input type="hidden" name="id" id="id_baixar">
                    <br>
                    <small><div id="mensagem-baixar" align="center"></div></small>
                </div>
                <div class="modal-footer">      
                    <button id="btn_baixar" type="submit" class="btn btn-success">Baixar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========== MODAL PERMISSÕES (Gerenciar Permissões de Usuário) ========== -->

</div>

<!-- ========== MODAL HORÁRIOS (Gerenciar Horários) ========== -->
<div class="modal fade" id="modalHorarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titulo_horarios"></span></h4>
                <button id="btn-fechar-horarios" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-horarios-body">
                <!-- Conteúdo dinâmico será inserido aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL DIAS (Gerenciar Dias) ========== -->
<div class="modal fade" id="modalDias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titulo_dias"></span></h4>
                <button id="btn-fechar-dias" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-dias-body">
                <!-- Conteúdo dinâmico será inserido aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL SERVIÇOS (Gerenciar Serviços) ========== -->
<div class="modal fade" id="modalServicos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titulo_servicos"></span></h4>
                <button id="btn-fechar-servicos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-servicos-body">
                <!-- Conteúdo dinâmico será inserido aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL SERVIÇO (Modal específico para serviço individual) ========== -->

</div>

<!-- ========== MODAL WHATSAPP - QR CODE ========== -->
<div class="modal fade" id="modalWhatsappQR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Realize a leitura do QRcode</h4>
                <button id="btn-fechar-qr" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="loadingIndicator" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Carregando...</span>
                    </div>
                    <p>Carregando...</p>
                </div>
                <div id="qrCodeContainer" style="display: none;"></div>
                <div id="statusMessage" style="display: none;">
                    <!-- Mensagem de erro será exibida aqui -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL LOGIN (WhatsApp) ========== -->
<div class="modal fade" id="conectar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Realize o login ou registre-se</h4>
                <button id="btn-fechar-login" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="https://chatbot.menuia.com/uploads/23/06/1686025726jWJDAMCm2dJrxAb4XNNX.png" class="img-fluid" alt="Logo" style="width: 30%;">
                <form id="loginForm">
                    <div class="form-group text-left">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required placeholder="Digite seu email">
                    </div>
                    <div class="form-group text-left">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" required placeholder="Digite sua senha">
                    </div>
                </form>
                <div id="statusMessageLogar" style="display: none;"></div>
                <button type="button" class="btn btn-primary mt-2" onclick="login()">Login</button>
                <p class="mt-3">Não tem uma conta? <a href="#" onclick="abrirModalRegistro()">Registre-se</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL REGISTRO (WhatsApp) ========== -->
<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registre-se</h4>
                <button id="btn-fechar-registrar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="https://chatbot.menuia.com/uploads/23/06/1686025726jWJDAMCm2dJrxAb4XNNX.png" class="img-fluid" alt="Logo" style="width: 30%;">
                <form id="registroForm">
                    <div class="form-group text-left">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" required placeholder="Digite seu nome">
                    </div>
                    <div class="form-group text-left">
                        <label for="emailRegistro">Email</label>
                        <input type="email" class="form-control" id="emailRegistro" required placeholder="Digite seu email">
                    </div>
                    <div class="form-group text-left">
                        <label for="senhaRegistro">Senha</label>
                        <input type="password" class="form-control" id="senhaRegistro" required placeholder="Digite sua senha">
                    </div>
                    <div class="form-group text-left">
                        <label for="telefone">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" required placeholder="Ex: 5581989769960">
                    </div>
                    <div class="form-group form-check text-left">
                        <input type="checkbox" class="form-check-input" id="termosAceitos" required>
                        <label class="form-check-label" for="termosAceitos">Eu li e concordo com os <a href="https://chatbot.menuia.com/page/politica-de-privacidade-e-termos-de-uso" target="_blank">termos de uso e política de privacidade</a>.</label>
                    </div>
                </form>
                <div id="statusMessageRegistrar" style="display: none;"></div>
                <button type="button" class="btn btn-primary mt-2" onclick="registrar()">Registrar</button>
                <p class="mt-3">Já tem uma conta? <a href="#" onclick="abrirModalLogar()">Logar</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL CONFIRMAÇÃO (Modal genérico para confirmações) ========== -->

</div>

<!-- ========== ESTILOS RESPONSIVOS PARA MODAIS ========== -->
<style>
/* Otimizações para modais em dispositivos móveis */
@media (max-width: 767px) {
    .modal-dialog {
        margin: 10px;
        max-width: calc(100% - 20px);
    }
    
    .modal-content {
        border-radius: 8px;
    }
    
    .modal-header {
        padding: 15px;
    }
    
    .modal-body {
        padding: 15px;
    }
    
    .modal-footer {
        padding: 15px;
        flex-direction: column;
    }
    
    .modal-footer .btn {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .modal-footer .btn:last-child {
        margin-bottom: 0;
    }
    
    /* Ajustes para formulários em modais */
    .modal .form-group {
        margin-bottom: 15px;
    }
    
    .modal .form-control {
        font-size: 16px; /* Evita zoom no iOS */
        padding: 12px;
    }
    
    .modal .btn {
        padding: 12px 20px;
        font-size: 16px;
        touch-action: manipulation;
    }
}

/* Melhorias gerais para todos os modais */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.6);
}

.modal-content {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: none;
}

.modal-header {
    border-bottom: 1px solid #e9ecef;
    background-color: #f8f9fa;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    background-color: #f8f9fa;
}

/* Loading states para modais */
.modal-loading {
    pointer-events: none;
    opacity: 0.7;
}

.modal-loading .modal-body::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 30px;
    height: 30px;
    margin: -15px 0 0 -15px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
/**
 * Funções JavaScript para gerenciar modais centralizados
 */

// Função para abrir modal de confirmação
function abrirModalConfirmacao(titulo, mensagem, callback) {
    $('#titulo_confirmacao').text(titulo);
    $('#mensagem_confirmacao').html(mensagem);
    $('#modalConfirmacao').modal('show');
    
    $('#btn-confirmar').off('click').on('click', function() {
        $('#modalConfirmacao').modal('hide');
        if (typeof callback === 'function') {
            callback();
        }
    });
}

// Função para mostrar loading em modal
function mostrarLoadingModal(modalId) {
    $('#' + modalId).addClass('modal-loading');
}

// Função para esconder loading em modal
function esconderLoadingModal(modalId) {
    $('#' + modalId).removeClass('modal-loading');
}

// Função para limpar formulários em modais
function limparFormularioModal(formId) {
    $('#' + formId)[0].reset();
    $('#' + formId + ' .is-invalid').removeClass('is-invalid');
    $('#' + formId + ' .invalid-feedback').remove();
}

// Função para exibir mensagem em modal
function exibirMensagemModal(elementoId, mensagem, tipo = 'success') {
    const classe = tipo === 'success' ? 'text-success' : 'text-danger';
    $('#' + elementoId).html('<div class="' + classe + '">' + mensagem + '</div>');
    
    setTimeout(function() {
        $('#' + elementoId).html('');
    }, 5000);
}

// Inicialização quando o documento estiver pronto
$(document).ready(function() {
    // Configurar Select2 para todos os modais
    $('.sel2').select2({
        dropdownParent: $('#modalForm')
    });
    
    // Configurar fechamento de modais com ESC
    $(document).keydown(function(e) {
        if (e.keyCode === 27) { // ESC key
            $('.modal').modal('hide');
        }
    });
    
    // Configurar auto-focus no primeiro input quando modal abrir
    $('.modal').on('shown.bs.modal', function() {
        $(this).find('input:text:visible:first').focus();
    });
    
    // Limpar formulários quando modal fechar
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0]?.reset();
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
    });
});
</script>

<?php 
require_once("../../../conexao.php");
$tabela = 'usuarios';

if($tipo_comissao == 'Porcentagem'){
		$tipo_comissao = '%';
	}


$query = $pdo->query("SELECT * FROM $tabela where nivel != 'Administrador' ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
<style>
/* Estilização moderna da tabela de funcionários */
.usuarios-table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-top: 20px;
    padding: 25px;
}

/* Container superior com busca e seletor de registros */
.top-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    gap: 20px;
}

/* Estilização do campo de busca integrado */
.search-container {
    display: flex;
    justify-content: flex-end;
    flex: 1;
}

.search-input-wrapper {
    position: relative;
    max-width: 350px;
    width: 100%;
}

.search-input {
    width: 100%;
    padding: 12px 45px 12px 20px;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    font-size: 14px;
    background: #f8f9fa;
    transition: all 0.3s ease;
    outline: none;
}

.search-input:focus {
    border-color: #667eea;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.search-input.searching {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    background-color: #f8f9ff;
}

.search-input.searching + .search-icon {
    color: #007bff;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.search-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 16px;
    pointer-events: none;
    transition: color 0.3s ease;
}

.search-input:focus + .search-icon {
    color: #667eea;
}

/* Estilização das informações de paginação */
.bottom-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #f1f3f4;
}

.dataTables_info {
    color: #6c757d;
    font-size: 14px;
    margin: 0;
}

.dataTables_paginate {
    margin: 0;
}

/* Estilos para o seletor de quantidade de registros */
.dataTables_length {
    margin: 0;
}

.dataTables_length select {
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    background: #fff;
    color: #495057;
    margin: 0 8px;
    font-size: 14px;
}

.dataTables_length label {
    color: #6c757d;
    font-size: 14px;
    font-weight: normal;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Botões padrão (Anterior/Próximo) como links simples */
.dataTables_paginate .paginate_button {
    margin: 0 8px;
    padding: 0;
    border: none;
    background: transparent;
    color: #6c757d;
    text-decoration: none;
    transition: color 0.2s ease;
}

.dataTables_paginate .paginate_button:hover {
    color: #343a40;
    text-decoration: underline;
}

/* Página atual como "pill" com leve sombra */
.dataTables_paginate .paginate_button.current {
    padding: 8px 16px;
    border-radius: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    text-decoration: none;
    transform: translateY(-1px);
}

.dataTables_paginate .paginate_button.disabled {
    color: #adb5bd;
    cursor: not-allowed;
    text-decoration: none;
}

.usuarios-table {
    margin-bottom: 0;
    border: none;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
}

.usuarios-table thead th {
            background-color: #fff;
            color: #000;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 18px 15px;
            border: none;
            border-right: none;
            border-left: none;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

.usuarios-table thead th:first-child {
    border-top-left-radius: 8px;
}

.usuarios-table thead th:last-child {
    border-top-right-radius: 8px;
}

.usuarios-table thead th::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #fff;
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    z-index: -1;
}

.usuarios-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f3f4;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
}

.usuarios-table tbody tr:hover {
    background: linear-gradient(135deg, rgba(248, 249, 255, 0.95) 0%, rgba(240, 242, 255, 0.95) 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.usuarios-table tbody td {
    padding: 18px 15px;
    vertical-align: middle;
    border: none;
    font-size: 0.9rem;
}

.usuarios-table .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    margin-right: 12px;
}

.usuarios-table .user-name {
    font-weight: 600;
    color: #2d3748;
    display: flex;
    align-items: center;
}

.usuarios-table .action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.usuarios-table .action-buttons a {
    display: inline-flex;
    gap: 8px;
    align-items: center;
}

.usuarios-table .action-buttons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.usuarios-table .action-buttons a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Cores específicas para cada ação */
.usuarios-table .action-buttons .btn-edit:hover {
    background: rgba(0, 123, 255, 0.1);
    border-color: #007bff;
}

.usuarios-table .action-buttons .btn-view:hover {
    background: rgba(23, 162, 184, 0.1);
    border-color: #17a2b8;
}

.usuarios-table .action-buttons .btn-delete:hover {
    background: rgba(220, 53, 69, 0.1);
    border-color: #dc3545;
}

.usuarios-table .action-buttons .btn-toggle:hover {
    background: rgba(40, 167, 69, 0.1);
    border-color: #28a745;
}

.usuarios-table .action-buttons .btn-permissions:hover {
    background: rgba(255, 193, 7, 0.1);
    border-color: #ffc107;
}

.usuarios-table .action-buttons .btn-whatsapp:hover {
    background: rgba(37, 211, 102, 0.1);
    border-color: #25d366;
}

.usuarios-table .action-buttons .btn-days:hover {
    background: rgba(255, 193, 7, 0.1);
    border-color: #ffc107;
}

.usuarios-table .action-buttons .btn-services:hover {
    background: rgba(102, 16, 242, 0.1);
    border-color: #6610f2;
}

.usuarios-table .status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.usuarios-table .status-active {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.usuarios-table .status-inactive {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
}

@media (max-width: 768px) {
    .usuarios-table-container {
        padding: 15px;
        margin-top: 15px;
    }
    
    .top-controls {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .search-container {
        justify-content: center;
    }
    
    .search-input-wrapper {
        max-width: 100%;
    }
    
    .search-input {
        padding: 10px 40px 10px 15px;
        font-size: 13px;
    }
    
    .bottom-controls {
        flex-direction: column;
        gap: 15px;
        align-items: center;
        text-align: center;
    }
    
    .usuarios-table .esc {
        display: none;
    }
    
    .usuarios-table .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .usuarios-table .action-buttons a {
        width: 30px;
        height: 30px;
    }
    
    .usuarios-table tbody td {
        padding: 12px 10px;
    }
    
    .usuarios-table thead th {
        padding: 15px 10px;
        font-size: 0.8rem;
    }
}
</style>

<div class="usuarios-table-container">
    <!-- Container superior com seletor de registros e busca -->
    <div class="top-controls">
        <div class="search-container">
            <div class="search-input-wrapper">
                <input type="text" class="search-input" id="searchUsuarios" placeholder="Buscar funcionários...">
                <i class="bi bi-search search-icon"></i>
            </div>
        </div>
    </div>
    
    <table class="table usuarios-table" id="tabela">
        <thead> 
            <tr> 
                <th>Usuário</th>	
                <th class="esc">Email</th> 	
                <th class="esc">Senha</th> 	
                <th class="esc">Nível</th> 	
                <th class="esc">Comissão</th>
                <th>Ações</th>
            </tr> 
        </thead> 
        <tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$email = $res[$i]['email'];
	$cpf = $res[$i]['cpf'];
	$senha = $res[$i]['senha'];
	$nivel = $res[$i]['nivel'];
	$data = $res[$i]['data'];
	$ativo = $res[$i]['ativo'];
	$telefone = $res[$i]['telefone'];
	$endereco = $res[$i]['endereco'];
	$foto = $res[$i]['foto'];
	$atendimento = $res[$i]['atendimento'];
	$tipo_chave = $res[$i]['tipo_chave'];
	$chave_pix = $res[$i]['chave_pix'];
	$intervalo = $res[$i]['intervalo'];
	$comissao = $res[$i]['comissao'];

	$dataF = implode('/', array_reverse(explode('-', $data)));
	
	
	$senha = '*******';
	

	if($ativo == 'Sim'){
			$icone = 'bi bi-toggle-on';
			$titulo_link = 'Desativar Item';
			$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'bi bi-toggle-off';
			$titulo_link = 'Ativar Item';
			$acao = 'Sim';
			$classe_linha = 'text-muted';
		}

		$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

		if($tipo_comissao == '%'){
			$comissaoF = @number_format($comissao, 0, ',', '.').'%';
			
			}else{
				$comissaoF = 'R$ '.@number_format($comissao, 2, ',', '.');
			}

			if($comissao == ""){
				$comissaoF = "";
			}


echo <<<HTML
<tr class="{$classe_linha}">
<td>
<div class="user-name">
<img src="img/perfil/{$foto}" class="user-avatar">
{$nome}
</div>
</td>
<td class="esc">{$email}</td>
<td class="esc">{$senha}</td>
<td class="esc">{$nivel}</td>
<td class="esc">{$comissaoF}</td>
<td>
<div class="action-buttons">
		<a href="#" onclick="editar('{$id}','{$nome}', '{$email}', '{$telefone}', '{$cpf}', '{$nivel}', '{$endereco}', '{$foto}', '{$atendimento}', '{$tipo_chave}', '{$chave_pix}', '{$intervalo}', '{$comissao}')" title="Editar Dados" class="btn-edit"><i class="bi bi-pencil-square text-primary"></i></a>

		<a href="#" onclick="mostrar('{$nome}', '{$email}', '{$cpf}', '{$senha}', '{$nivel}', '{$dataF}', '{$ativo}', '{$telefone}', '{$endereco}', '{$foto}', '{$atendimento}', '{$tipo_chave}', '{$chave_pix}', '{$intervalo}', '{$comissao}')" title="Ver Dados" class="btn-view"><i class="bi bi-info-circle-fill text-info"></i></a>

		<a href="#" onclick="excluir('{$id}')" title="Excluir" class="btn-delete"><i class="bi bi-trash3-fill text-danger"></i></a>

		<a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}" class="btn-toggle"><i class="{$icone} text-success"></i></a>

		<a href="http://api.whatsapp.com/send?1=pt_BR&phone={$whats}&text=" target="_blank" title="Abrir WhatsApp" class="btn-whatsapp"><i class="bi bi-whatsapp text-success"></i></a>

		<a href="#" onclick="dias('{$id}', '{$nome}')" title="Ver Dias" class="btn-days"><i class="bi bi-calendar-fill text-warning"></i></a>

		<a href="#" onclick="servico('{$id}', '{$nome}')" title="Definir Serviços" class="btn-services"><i class="bi bi-briefcase-fill text-info"></i></a>
</div>
</td>
</tr>
HTML;

}

echo <<<HTML
</tbody>
</table>



<small><div align="center" id="mensagem-excluir"></div></small>
</div>

<script type="text/javascript">
$(document).ready(function () {
    var table = $('#tabela').DataTable({
        "ordering": false,
        "stateSave": true,
        "searching": true, // Habilita a busca do DataTables
        "dom": 'lrtip', // Layout com length, info e paginação (sem filtro nativo)
        "pageLength": 10, // Define quantos registros por página
        "lengthChange": true, // Permite alterar o número de registros por página
        "info": true, // Mostra informações de paginação
        "paging": true, // Habilita paginação
        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Opções do seletor de páginas
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nenhum funcionário encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros totais)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            }
        }
    });

    // Implementa busca personalizada
    $('#searchUsuarios').on('keyup', function() {
        var searchValue = this.value;
        table.search(searchValue).draw();
        
        // Feedback visual durante a busca
        if(searchValue.length > 0) {
            $(this).addClass('searching');
        } else {
            $(this).removeClass('searching');
        }
    });
    
    // Limpa a busca quando o campo estiver vazio
    $('#searchUsuarios').on('input', function() {
        if(this.value === '') {
            table.search('').draw();
            $(this).removeClass('searching');
        }
    });
    
    // Foca no campo de busca personalizado
    $('#searchUsuarios').focus();
});
</script>
HTML;


}else{
	echo '<div class="usuarios-table-container"><small>Não possui nenhum registro Cadastrado!</small></div>';
}

?>


<script type="text/javascript">
	function editar(id, nome, email, telefone, cpf, nivel, endereco, foto, atendimento, tipo_chave, chave_pix, intervalo, comissao){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#telefone').val(telefone);
		$('#cpf').val(cpf);
		$('#cargo').val(nivel).change();
		$('#endereco').val(endereco);
		$('#atendimento').val(atendimento).change();
		$('#chave_pix').val(chave_pix);
		$('#tipo_chave').val(tipo_chave).change();
		$('#intervalo').val(intervalo);
		$('#comissao').val(comissao);
		
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#foto').val('');
		$('#target').attr('src','img/perfil/' + foto);
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#email').val('');
		$('#cpf').val('');
		$('#endereco').val('');
		$('#foto').val('');
		$('#chave_pix').val('');
		$('#target').attr('src','img/perfil/sem-foto.jpg');
		$('#intervalo').val('');
		$('#comissao').val('');
	}
</script>



<script type="text/javascript">
	function mostrar(nome, email, cpf, senha, nivel, data, ativo, telefone, endereco, foto, atendimento, tipo_chave, chave_pix){

		$('#nome_dados').text(nome);
		$('#email_dados').text(email);
		$('#cpf_dados').text(cpf);
		$('#senha_dados').text(senha);
		$('#nivel_dados').text(nivel);
		$('#data_dados').text(data);
		$('#ativo_dados').text(ativo);
		$('#telefone_dados').text(telefone);
		$('#endereco_dados').text(endereco);
		$('#atendimento_dados').text(atendimento);
		$('#tipo_chave_dados').text(tipo_chave);
		$('#chave_pix_dados').text(chave_pix);

		$('#target_mostrar').attr('src','img/perfil/' + foto);

		$('#modalDados').modal('show');
	}
</script>




<script type="text/javascript">
	function horarios(id, nome){

		$('#nome_horarios').text(nome);		
		$('#id_horarios').val(id);		

		$('#modalHorarios').modal('show');
		listarHorarios(id);
	}
</script>


<script type="text/javascript">
	function dias(id, nome){

		$('#nome_dias').text(nome);		
		$('#id_dias').val(id);		

		$('#modalDias').modal('show');
		listarDias(id);
	}
</script>



<script type="text/javascript">
	function servico(id, nome){

		$('#nome_servico').text(nome);		
		$('#id_servico').val(id);		

		$('#modalServicos').modal('show');
		listarServicos(id);
	}
</script>

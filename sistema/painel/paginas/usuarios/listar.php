<?php 
require_once("../../../conexao.php");
$tabela = 'usuarios';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
<style>
/* Estilização moderna da tabela de usuários */
.usuarios-table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-top: 20px;
    padding: 25px;
}

/* Estilização do campo de busca integrado */
.search-container {
    margin-bottom: 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
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

.search-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
        
        .search-container {
            margin-bottom: 15px;
        }
        
        .search-input-wrapper {
            max-width: 100%;
        }
        
        .search-input {
            padding: 10px 40px 10px 15px;
            font-size: 13px;
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

        /* Paginação DataTables — estilo consistente com Funcionários */
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

        .dataTables_paginate .paginate_button.current {
            padding: 8px 16px;
            border-radius: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: #fff !important; /* garante precedência sobre CSS base do DataTables */
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            text-decoration: none;
            transform: translateY(-1px);
        }
}
</style>

<div class="usuarios-table-container">
    <!-- Campo de busca integrado -->
    <div class="search-container">
        <div class="search-input-wrapper">
            <input type="text" class="search-input" id="searchUsuarios" placeholder="Buscar usuários...">
            <i class="bi bi-search search-icon"></i>
        </div>
    </div>
    
	<table class="table usuarios-table" id="tabela">
	<thead> 
	<tr> 
	<th>Usuário</th>	
	<th class="esc">Email</th> 	
	<th class="esc">Senha</th> 	
	<th class="esc">Nível</th> 	
	<th class="esc">Cadastro</th>
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

	$dataF = implode('/', array_reverse(explode('-', $data)));
	
	if($nivel == 'Administrador'){
		$senhaF = '******';
	}else{
		$senhaF = $senha;
	}


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


echo <<<HTML
<tr class="{$classe_linha}">
<td>
<div class="user-name">
<img src="img/perfil/{$foto}" class="user-avatar">
{$nome}
</div>
</td>
<td class="esc">{$email}</td>
<td class="esc">{$senhaF}</td>
<td class="esc">{$nivel}</td>
<td class="esc">{$dataF}</td>
<td>
<div class="action-buttons">
		<a href="#" onclick="editar('{$id}','{$nome}', '{$email}', '{$telefone}', '{$cpf}', '{$nivel}', '{$endereco}', '{$foto}', '{$atendimento}')" title="Editar Dados" class="btn-edit"><i class="bi bi-pencil-square text-primary"></i></a>

		<a href="#" onclick="mostrar('{$nome}', '{$email}', '{$cpf}', '{$senhaF}', '{$nivel}', '{$dataF}', '{$ativo}', '{$telefone}', '{$endereco}', '{$foto}', '{$atendimento}')" title="Ver Dados" class="btn-view"><i class="bi bi-info-circle-fill text-info"></i></a>

		<a href="#" onclick="excluir('{$id}', '{$nome}')" title="Excluir" class="btn-delete"><i class="bi bi-trash3-fill text-danger"></i></a>

		<a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}" class="btn-toggle"><i class="{$icone} text-success"></i></a>

		<a href="#" onclick="permissoes('{$id}', '{$nome}')" title="Definir Permissões" class="btn-permissions"><i class="bi bi-shield-lock-fill text-warning"></i></a>
</div>
</td>
</tr>
HTML;

}

echo <<<HTML
</tbody>
</table>
</div>
<small><div align="center" id="mensagem-excluir"></div></small>
HTML;


}else{
	echo '<small>Não possui nenhum registro Cadastrado!</small>';
}

?>

<script type="text/javascript">
	$(document).ready( function () {
    var table = $('#tabela').DataTable({
    		"ordering": false,
			"stateSave": true,
			"searching": true, // Habilita a busca do DataTables
			"dom": 'lrtip', // Layout padrão com length menu, info e paginação
			"pageLength": 10, // Define quantos registros por página
			"lengthChange": true, // Permite alterar o número de registros por página
			"info": true, // Mostra informações de paginação
			"paging": true, // Habilita paginação
			"lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Opções do seletor de páginas
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Nenhum usuário encontrado",
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
} );
</script>


<script type="text/javascript">
	function editar(id, nome, email, telefone, cpf, nivel, endereco, foto, atendimento){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#telefone').val(telefone);
		$('#cpf').val(cpf);
		$('#cargo').val(nivel).change();
		$('#endereco').val(endereco);
		$('#atendimento').val(atendimento).change();

		
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
		$('#target').attr('src','img/perfil/sem-foto.jpg');
	}
</script>



<script type="text/javascript">
	function mostrar(nome, email, cpf, senha, nivel, data, ativo, telefone, endereco, foto, atendimento){

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

		$('#target_mostrar').attr('src','img/perfil/' + foto);

		$('#modalDados').modal('show');
	}
</script>

<script type="text/javascript">
	function permissoes(id, nome){		
    $('#id-usuario').val(id);        
    $('#nome-usuario').text(nome);   
    $('#modalPermissoes').modal('show');
    $('#mensagem-permissao').text(''); 
    listarPermissoes(id);
}
</script>
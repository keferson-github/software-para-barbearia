<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

//verificar se ele tem a permissão de estar nessa página
if(@$home == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}




$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));

//deletar agendamentos temp com mais de 2 dias
$query = $pdo->query("DELETE FROM agendamentos_temp where data_lanc < '$data_ontem'");


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



$query = $pdo->query("SELECT * FROM clientes ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_clientes = @count($res);

$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate() and pago != 'Sim' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagar_hoje = @count($res);


$query = $pdo->query("SELECT * FROM receber where data_venc = curDate() and pago != 'Sim' and valor > 0 ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_receber_hoje = @count($res);


$query = $pdo->query("SELECT * FROM produtos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$estoque_baixo = 0;
if($total_reg > 0){
    for($i=0; $i < $total_reg; $i++){
    foreach ($res[$i] as $key => $value){}
        $estoque = $res[$i]['estoque'];
        $nivel_estoque = $res[$i]['nivel_estoque'];

        if($nivel_estoque >= $estoque){
            $estoque_baixo += 1;
        }
    }
}


//totalizando agendamentos
$query = $pdo->query("SELECT * FROM agendamentos where data = curDate() ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_agendamentos_hoje = @count($res);

$query = $pdo->query("SELECT * FROM agendamentos where data = curDate() and status = 'Concluído'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_agendamentos_concluido_hoje = @count($res);


if($total_agendamentos_concluido_hoje > 0 and $total_agendamentos_hoje > 0){
    $porcentagemAgendamentos = ($total_agendamentos_concluido_hoje / $total_agendamentos_hoje) * 100;
}else{
    $porcentagemAgendamentos = 0;
}





//totalizando agendamentos pagos
$query = $pdo->query("SELECT * FROM receber where data_lanc = curDate() and tipo = 'Serviço'  ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_servicos_hoje = @count($res);

$query = $pdo->query("SELECT * FROM receber where data_lanc = curDate() and tipo = 'Serviço' and pago = 'Sim'  ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_servicos_pago_hoje = @count($res);


if($total_servicos_pago_hoje > 0 and $total_servicos_hoje > 0){
    $porcentagemServicos = ($total_servicos_pago_hoje / $total_servicos_hoje) * 100;
}else{
    $porcentagemServicos = 0;
}




//totalizando comissoes pagas mes
$query = $pdo->query("SELECT * FROM pagar where data_lanc >= '$data_inicio_mes' and data_lanc <= '$data_final_mes' and tipo = 'Comissão' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_comissoes_mes = @count($res);

$query = $pdo->query("SELECT * FROM pagar where data_lanc >= '$data_inicio_mes' and data_lanc <= '$data_final_mes' and tipo = 'Comissão' and pago = 'Sim' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_comissoes_mes_pagas = @count($res);


if($total_comissoes_mes_pagas > 0 and $total_comissoes_mes > 0){
    $porcentagemComissoes = ($total_comissoes_mes_pagas / $total_comissoes_mes) * 100;
}else{
    $porcentagemComissoes = 0;
}






//TOTALIZAR CONTAS DO DIA
$total_debitos_dia = 0;
$query = $pdo->query("SELECT * FROM pagar where data_pgto = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_debitos_dia += $res[$i]['valor'];
    }
}

$total_ganhos_dia = 0;
$query = $pdo->query("SELECT * FROM receber where data_pgto = curDate() and valor > 0 ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_ganhos_dia += $res[$i]['valor'];
    }
}

$saldo_total_dia = $total_ganhos_dia - $total_debitos_dia;
$saldo_total_diaF = number_format($saldo_total_dia, 2, ',', '.');

if($saldo_total_dia < 0){
    $classe_saldo_dia = 'user1';
}else{
    $classe_saldo_dia = 'dollar2';
}






//dados para o gráfico
$dados_meses_despesas =  '';
$dados_meses_servicos =  '';
$dados_meses_vendas =  '';
        //ALIMENTAR DADOS PARA O GRÁFICO
        for($i=1; $i <= 12; $i++){

            if($i < 10){
                $mes_atual = '0'.$i;
            }else{
                $mes_atual = $i;
            }

        if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
            $dia_final_mes = '30';
        }else if($mes_atual == '2'){
            $dia_final_mes = '28';
        }else{
            $dia_final_mes = '31';
        }


        $data_mes_inicio_grafico = $ano_atual."-".$mes_atual."-01";
        $data_mes_final_grafico = $ano_atual."-".$mes_atual."-".$dia_final_mes;


        //DESPESAS
        $total_mes_despesa = 0;
        $query = $pdo->query("SELECT * FROM pagar where pago = 'Sim' and tipo = 'Conta' and data_pgto >= '$data_mes_inicio_grafico' and data_pgto <= '$data_mes_final_grafico' ORDER BY id asc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);
        if($total_reg > 0){
            for($i2=0; $i2 < $total_reg; $i2++){
                foreach ($res[$i2] as $key => $value){}
            $total_mes_despesa +=  $res[$i2]['valor'];
        }
        }

        $dados_meses_despesas = $dados_meses_despesas. $total_mes_despesa. '-';





         //VENDAS
        $total_mes_vendas = 0;
        $query = $pdo->query("SELECT * FROM receber where pago = 'Sim' and tipo = 'Venda' and data_pgto >= '$data_mes_inicio_grafico' and data_pgto <= '$data_mes_final_grafico' and valor > 0 ORDER BY id asc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);
        if($total_reg > 0){
            for($i2=0; $i2 < $total_reg; $i2++){
                foreach ($res[$i2] as $key => $value){}
            $total_mes_vendas +=  $res[$i2]['valor'];
        }
        }

        $dados_meses_vendas = $dados_meses_vendas. $total_mes_vendas. '-';





        //SERVICOS
        $total_mes_servicos = 0;
        $query = $pdo->query("SELECT * FROM receber where pago = 'Sim' and tipo = 'Serviço' and data_pgto >= '$data_mes_inicio_grafico' and data_pgto <= '$data_mes_final_grafico'  ORDER BY id asc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);
        if($total_reg > 0){
            for($i2=0; $i2 < $total_reg; $i2++){
                foreach ($res[$i2] as $key => $value){}
                    $valor_do_serv = $res[$i2]['valor'];
                    if($valor_do_serv == 0){
                        $valor_do_serv = $res[$i2]['valor2'];
                    }
            $total_mes_servicos += $valor_do_serv;
        }
        }

        $dados_meses_servicos = $dados_meses_servicos. $total_mes_servicos. '-';



    }



 ?>

  <input type="hidden" id="dados_grafico_despesa">
   <input type="hidden" id="dados_grafico_venda">
    <input type="hidden" id="dados_grafico_servico">
<div class="main-page">

 <?php if($ativo_sistema == ''){ ?>
<div style="background: #ffc341; color:#3e3e3e; padding:10px; font-size:14px; margin-bottom:10px">
<div><i class="fa fa-info-circle"></i> <b>Aviso: </b> Prezado Cliente, não identificamos o pagamento de sua última mensalidade, entre em contato conosco o mais rápido possivel para regularizar o pagamento, caso contário seu acesso ao sistema será desativado.</div>
</div>
<?php } ?>

	<div class="dashboard-grid">
        <!-- Card 1: Total de Clientes -->
        <div class="grid-item">
            <a href="clientes" class="modern-card-link">
                <div class="modern-stat-card modern-card-blue clientes-card">
                    <div class="modern-card-content">
                        <div class="stats-icon-container">
                            <i class="fa fa-users stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="modern-card-info">
                            <div class="modern-card-number"><?php echo $total_clientes ?></div>
                            <div class="modern-card-label">Total de Clientes</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 2: Contas à Pagar Hoje -->
        <div class="grid-item">
            <a href="pagar" class="modern-card-link">
                <div class="modern-stat-card modern-card-red pagar-card">
                    <div class="modern-card-content">
                        <div class="stats-icon-container">
                            <i class="fa fa-credit-card stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="modern-card-info">
                            <div class="modern-card-number"><?php echo $contas_pagar_hoje ?></div>
                            <div class="modern-card-label">Contas à Pagar Hoje</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 3: Contas à Receber Hoje -->
        <div class="grid-item">
            <a href="receber" class="modern-card-link">
                <div class="modern-stat-card modern-card-green receber-card">
                    <div class="modern-card-content">
                        <div class="stats-icon-container">
                            <i class="fa fa-money stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="modern-card-info">
                            <div class="modern-card-number"><?php echo $contas_receber_hoje ?></div>
                            <div class="modern-card-label">Contas à Receber Hoje</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 4: Produtos Estoque Baixo -->
        <div class="grid-item">
            <a href="estoque" class="modern-card-link">
                <div class="modern-stat-card modern-card-orange estoque-card">
                    <div class="modern-card-content">
                        <div class="stats-icon-container">
                            <i class="fa fa-cubes stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="modern-card-info">
                            <div class="modern-card-number"><?php echo $estoque_baixo ?></div>
                            <div class="modern-card-label">Produtos Estoque Baixo</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 5: R$ Saldo do Dia -->
        <div class="grid-item">
            <div class="modern-stat-card modern-card-purple saldo-card">
                <div class="modern-card-content">
                    <div class="stats-icon-container">
                        <i class="fa fa-dollar stats-icon" aria-hidden="true"></i>
                    </div>
                    <div class="modern-card-info">
                        <div class="modern-card-number"><?php echo @$saldo_total_diaF ?></div>
                        <div class="modern-card-label">R$ Saldo do Dia</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container Flex para os 3 Cards de Estatísticas -->
        <div class="flex-stats-container">
            <!-- Cards de Estatísticas Modernos com Gráficos -->
            <div class="flex-stats-item">
                <div class="modern-stats-card agendamentos-card" role="article" aria-labelledby="stats-title-agendamentos">
                    <div class="stats-card-header">
                        <div class="stats-icon-container">
                            <i class="fa fa-calendar-check-o stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="stats-badge">
                            <span class="badge-text">Hoje</span>
                        </div>
                    </div>
                    <div class="stats-content">
                        <div class="stats-main">
                            <h3 class="stats-title" id="stats-title-agendamentos">Agendamentos</h3>
                            <div class="stats-number-container">
                                <span class="stats-number" data-count="<?php echo $total_agendamentos_hoje ?>"><?php echo $total_agendamentos_hoje ?></span>
                                <span class="stats-plus" aria-hidden="true">+</span>
                            </div>
                            <div class="stats-progress" role="progressbar" aria-valuenow="<?php echo $porcentagemAgendamentos ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Progresso de agendamentos concluídos">
                                <div class="progress-bar" data-percent="<?php echo $porcentagemAgendamentos ?>"></div>
                            </div>
                            <p class="stats-subtitle">Agendamentos confirmados <span class="visually-hidden">(<?php echo $porcentagemAgendamentos ?>% concluído)</span></p>
                        </div>
                        <div class="stats-chart">
                            <div class="chart-container">
                                <canvas id="modern-pie-1" class="modern-chart" data-percent="<?php echo $porcentagemAgendamentos ?>" role="img" aria-label="Gráfico: <?php echo $porcentagemAgendamentos ?>% de agendamentos concluídos"></canvas>
                            </div>
                            <div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $porcentagemAgendamentos ?>" style="display: none;"> <span class="pie-value"></span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-stats-item">
                <div class="modern-stats-card servicos-card" role="article" aria-labelledby="stats-title-servicos">
                    <div class="stats-card-header">
                        <div class="stats-icon-container">
                            <i class="fa fa-check-circle stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="stats-badge">
                            <span class="badge-text">Hoje</span>
                        </div>
                    </div>
                    <div class="stats-content">
                        <div class="stats-main">
                            <h3 class="stats-title" id="stats-title-servicos">Serviços Pagos</h3>
                            <div class="stats-number-container">
                                <span class="stats-number" data-count="<?php echo $total_servicos_hoje ?>"><?php echo $total_servicos_hoje ?></span>
                                <span class="stats-plus" aria-hidden="true">+</span>
                            </div>
                            <div class="stats-progress" role="progressbar" aria-valuenow="<?php echo $porcentagemServicos ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Progresso de serviços pagos">
                                <div class="progress-bar" data-percent="<?php echo $porcentagemServicos ?>"></div>
                            </div>
                            <p class="stats-subtitle">Serviços finalizados <span class="visually-hidden">(<?php echo $porcentagemServicos ?>% pagos)</span></p>
                        </div>
                        <div class="stats-chart">
                            <div class="chart-container">
                                <canvas id="modern-pie-2" class="modern-chart" data-percent="<?php echo $porcentagemServicos ?>" role="img" aria-label="Gráfico: <?php echo $porcentagemServicos ?>% de serviços pagos"></canvas>
                            </div>
                            <div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $porcentagemServicos ?>" style="display: none;"> <span class="pie-value"></span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-stats-item">
                <div class="modern-stats-card comissoes-card" role="article" aria-labelledby="stats-title-comissoes">
                    <div class="stats-card-header">
                        <div class="stats-icon-container">
                            <i class="fa fa-money stats-icon" aria-hidden="true"></i>
                        </div>
                        <div class="stats-badge">
                            <span class="badge-text">Mês</span>
                        </div>
                    </div>
                    <div class="stats-content">
                        <div class="stats-main">
                            <h3 class="stats-title" id="stats-title-comissoes">Comissões</h3>
                            <div class="stats-number-container">
                                <span class="stats-number" data-count="<?php echo $total_comissoes_mes ?>"><?php echo $total_comissoes_mes ?></span>
                                <span class="stats-plus" aria-hidden="true">+</span>
                            </div>
                            <div class="stats-progress" role="progressbar" aria-valuenow="<?php echo $porcentagemComissoes ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Progresso de comissões pagas">
                                <div class="progress-bar" data-percent="<?php echo $porcentagemComissoes ?>"></div>
                            </div>
                            <p class="stats-subtitle">Comissões pagas <span class="visually-hidden">(<?php echo $porcentagemComissoes ?>% pagas)</span></p>
                        </div>
                        <div class="stats-chart">
                            <div class="chart-container">
                                <canvas id="modern-pie-3" class="modern-chart" data-percent="<?php echo $porcentagemComissoes ?>" role="img" aria-label="Gráfico: <?php echo $porcentagemComissoes ?>% de comissões pagas"></canvas>
                            </div>
                            <div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $porcentagemComissoes ?>" style="display: none;"> <span class="pie-value"></span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico Demonstrativo Financeiro -->
        <div class="grid-item grid-chart">
            <div class="modern-stats-card financial-chart-card" role="article" aria-labelledby="financial-chart-title">
                <div class="stats-card-header">
                    <div class="stats-icon-container financial-icon">
                        <i class="fa fa-line-chart stats-icon" aria-hidden="true"></i>
                    </div>
                    <div class="stats-badge financial-badge">
                        <span class="badge-text">Anual</span>
                    </div>
                </div>
                <div class="stats-content financial-content">
                    <div class="stats-main financial-main">
                        <h3 class="stats-title" id="financial-chart-title">Demonstrativo Financeiro</h3>
                        <p class="stats-subtitle">Comparativo mensal de receitas e despesas</p>
                    </div>
                </div>
                <div class="financial-chart-container">
                    <canvas id="Linegraph" width="800" height="350" style="width: 100%; height: 350px;">
                    </canvas>
                </div>
            </div>
        </div>
    </div>


	
	<!-- for amcharts js -->
	<script src="js/amcharts.js"></script>
	<script src="js/serial.js"></script>
	<script src="js/export.min.js"></script>
	<link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
	<script src="js/light.js"></script>
	<!-- for amcharts js -->

	<script  src="js/index1.js"></script>
	

</div>
<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>

</div>

</div>







<!-- for index page weekly sales java script -->
	<script src="js/Chart.js"></script>
    <script>
        // Preparar dados PHP para o gráfico
        $('#dados_grafico_despesa').val('<?=$dados_meses_despesas?>'); 
        var dados = $('#dados_grafico_despesa').val();
        saldo_mes = dados.split('-'); 

        $('#dados_grafico_venda').val('<?=$dados_meses_vendas?>'); 
        var dados_venda = $('#dados_grafico_venda').val();
        saldo_mes_venda = dados_venda.split('-'); 

        $('#dados_grafico_servico').val('<?=$dados_meses_servicos?>'); 
        var dados_servico = $('#dados_grafico_servico').val();
        saldo_mes_servico = dados_servico.split('-'); 

        // Função para criar gráfico com Chart.js v1.0.2
        function createFinancialChart() {
            // Labels dos meses
            var labels = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
                          "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
            
            // Datasets com os mesmos dados PHP
            var datasets = [
                {
                    label: "Serviços",
                    fillColor: "rgba(14,36,138,0.2)",
                    strokeColor: "#0e248a",
                    pointColor: "#0e248a",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#0e248a",
                    data: saldo_mes_servico.map(function(v) { return parseFloat(v) || 0; })
                },
                {
                    label: "Vendas",
                    fillColor: "rgba(16,148,71,0.2)",
                    strokeColor: "#109447",
                    pointColor: "#109447",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#109447",
                    data: saldo_mes_venda.map(function(v) { return parseFloat(v) || 0; })
                },
                {
                    label: "Despesas",
                    fillColor: "rgba(227,36,36,0.2)",
                    strokeColor: "#e32424",
                    pointColor: "#e32424",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#e32424",
                    data: saldo_mes.map(function(v) { return parseFloat(v) || 0; })
                }
            ];

            // Opções do Chart.js v1.0.2
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                scaleShowGridLines: true,
                scaleGridLineColor: "#E6E6E6",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                animation: true,
                animationSteps: 60,
                animationEasing: "easeOutQuart",
                showTooltips: true,
                tooltipTemplate: "<%if (label){%><%=label%>: <%}%>R$ <%= value.toLocaleString ? value.toLocaleString('pt-BR', {minimumFractionDigits: 2}) : value.toFixed(2) %>",
                multiTooltipTemplate: "<%= datasetLabel %>: R$ <%= value.toLocaleString ? value.toLocaleString('pt-BR', {minimumFractionDigits: 2}) : value.toFixed(2) %>"
            };

            // Criar o gráfico
            var ctx = document.getElementById("Linegraph").getContext("2d");
            var financialChart = new Chart(ctx).Line({
                labels: labels,
                datasets: datasets
            }, options);

            return financialChart;
        }

        // Inicializar gráfico quando documento estiver pronto
        $(function () {
            try {
                createFinancialChart();
            } catch (error) {
                console.error('Erro ao criar gráfico financeiro:', error);
                // Fallback: mostrar mensagem de erro
                document.getElementById('Linegraph').style.display = 'none';
                var errorDiv = document.createElement('div');
                errorDiv.innerHTML = '<p style="text-align: center; color: #e32424; padding: 20px;">Erro ao carregar gráfico. Verifique os dados.</p>';
                document.getElementById('Linegraph').parentNode.appendChild(errorDiv);
            }
        });
    </script>
	<!-- //for index page weekly sales java script -->
	
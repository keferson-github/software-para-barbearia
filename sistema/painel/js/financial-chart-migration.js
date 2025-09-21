/**
 * Exemplo de Migração: SimpleChart.js → Chart.js v1.0.2
 * Demonstrativo Financeiro - Sistema Barbearia
 * 
 * Este arquivo mostra como migrar o gráfico atual mantendo
 * os mesmos dados PHP sem quebrar a funcionalidade
 */

// ========================================
// VERSÃO ATUAL (SimpleChart.js)
// ========================================
/*
var graphdata1 = {
    linecolor: "#e32424",
    title: "Despesas",
    values: [
        { X: "Janeiro", Y: parseFloat(saldo_mes[0]) },
        { X: "Fevereiro", Y: parseFloat(saldo_mes[1]) },
        // ... outros meses
    ]
};

$("#Linegraph").SimpleChart({
    ChartType: "Line",
    data: [graphdata3, graphdata2, graphdata1],
    showlegends: true,
    xaxislabel: 'Meses',
    yaxislabel: 'Totais R$'
});
*/

// ========================================
// VERSÃO MIGRADA (Chart.js v1.0.2)
// ========================================

function createFinancialChart() {
    // Converter dados PHP para formato Chart.js v1.0.2
    var labels = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
                  "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    
    // Preparar datasets mantendo os mesmos dados PHP
    var datasets = [
        {
            label: "Serviços",
            fillColor: "rgba(14,36,138,0.2)",
            strokeColor: "#0e248a",
            pointColor: "#0e248a",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "#0e248a",
            data: [
                parseFloat(saldo_mes_servico[0]),
                parseFloat(saldo_mes_servico[1]),
                parseFloat(saldo_mes_servico[2]),
                parseFloat(saldo_mes_servico[3]),
                parseFloat(saldo_mes_servico[4]),
                parseFloat(saldo_mes_servico[5]),
                parseFloat(saldo_mes_servico[6]),
                parseFloat(saldo_mes_servico[7]),
                parseFloat(saldo_mes_servico[8]),
                parseFloat(saldo_mes_servico[9]),
                parseFloat(saldo_mes_servico[10]),
                parseFloat(saldo_mes_servico[11])
            ]
        },
        {
            label: "Vendas",
            fillColor: "rgba(16,148,71,0.2)",
            strokeColor: "#109447",
            pointColor: "#109447",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "#109447",
            data: [
                parseFloat(saldo_mes_venda[0]),
                parseFloat(saldo_mes_venda[1]),
                parseFloat(saldo_mes_venda[2]),
                parseFloat(saldo_mes_venda[3]),
                parseFloat(saldo_mes_venda[4]),
                parseFloat(saldo_mes_venda[5]),
                parseFloat(saldo_mes_venda[6]),
                parseFloat(saldo_mes_venda[7]),
                parseFloat(saldo_mes_venda[8]),
                parseFloat(saldo_mes_venda[9]),
                parseFloat(saldo_mes_venda[10]),
                parseFloat(saldo_mes_venda[11])
            ]
        },
        {
            label: "Despesas",
            fillColor: "rgba(227,36,36,0.2)",
            strokeColor: "#e32424",
            pointColor: "#e32424",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "#e32424",
            data: [
                parseFloat(saldo_mes[0]),
                parseFloat(saldo_mes[1]),
                parseFloat(saldo_mes[2]),
                parseFloat(saldo_mes[3]),
                parseFloat(saldo_mes[4]),
                parseFloat(saldo_mes[5]),
                parseFloat(saldo_mes[6]),
                parseFloat(saldo_mes[7]),
                parseFloat(saldo_mes[8]),
                parseFloat(saldo_mes[9]),
                parseFloat(saldo_mes[10]),
                parseFloat(saldo_mes[11])
            ]
        }
    ];

    // Configurações do Chart.js v1.0.2
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
        tooltipTemplate: "<%if (label){%><%=label%>: <%}%>R$ <%= value.toLocaleString('pt-BR', {minimumFractionDigits: 2}) %>",
        multiTooltipTemplate: "<%= datasetLabel %>: R$ <%= value.toLocaleString('pt-BR', {minimumFractionDigits: 2}) %>"
    };

    // Criar o gráfico
    var ctx = document.getElementById("Linegraph").getContext("2d");
    var financialChart = new Chart(ctx).Line({
        labels: labels,
        datasets: datasets
    }, options);

    return financialChart;
}

// ========================================
// FUNÇÃO DE MIGRAÇÃO SEGURA
// ========================================

function migrateToChartJS() {
    try {
        // Verificar se Chart.js está disponível
        if (typeof Chart === 'undefined') {
            console.error('Chart.js não está carregado');
            return false;
        }

        // Verificar se os dados PHP existem
        if (typeof saldo_mes === 'undefined' || 
            typeof saldo_mes_venda === 'undefined' || 
            typeof saldo_mes_servico === 'undefined') {
            console.error('Dados PHP não encontrados');
            return false;
        }

        // Limpar gráfico anterior se existir
        var canvas = document.getElementById("Linegraph");
        if (canvas) {
            // Se for canvas, limpar contexto
            if (canvas.tagName === 'CANVAS') {
                var ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            } else {
                // Se for div, converter para canvas
                canvas.innerHTML = '<canvas id="financial-chart-canvas"></canvas>';
                canvas = document.getElementById("financial-chart-canvas");
            }
        }

        // Criar novo gráfico
        var chart = createFinancialChart();
        
        console.log('Migração para Chart.js concluída com sucesso');
        return true;

    } catch (error) {
        console.error('Erro na migração:', error);
        return false;
    }
}

// ========================================
// INSTRUÇÕES DE USO
// ========================================

/*
PASSOS PARA MIGRAÇÃO:

1. Substituir no home.php:
   - Remover: <script src="js/SimpleChart.js"></script>
   - Adicionar: <script src="js/Chart.js"></script>

2. Alterar elemento HTML:
   - De: <div id="Linegraph"></div>
   - Para: <canvas id="Linegraph" width="400" height="200"></canvas>

3. Substituir JavaScript:
   - Remover todo código SimpleChart
   - Adicionar: migrateToChartJS();

4. Testar funcionalidade:
   - Verificar se dados PHP são carregados
   - Confirmar exibição do gráfico
   - Validar interatividade

COMPATIBILIDADE:
✅ Mantém os mesmos dados PHP
✅ Preserva cores originais
✅ Mantém funcionalidade de legendas
✅ Adiciona tooltips melhorados
✅ Responsivo por padrão
*/
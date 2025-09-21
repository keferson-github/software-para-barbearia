/**
 * Gráficos Modernos para Dashboard - Barbearia
 * Compatível com Chart.js v1.0.2
 */

// Função para criar gráfico de pizza moderno (Chart.js v1.x)
function createModernPieChart(elementId, percentage, color, label) {
    console.log(`🎨 Criando gráfico: ${elementId} com ${percentage}% na cor ${color}`);
    
    const ctx = document.getElementById(elementId);
    if (!ctx) {
        console.error(`❌ Elemento canvas ${elementId} não encontrado!`);
        return;
    }

    console.log(`📋 Canvas encontrado:`, ctx);

    // Limpar canvas existente se houver
    if (ctx.chart) {
        console.log(`🧹 Destruindo gráfico existente em ${elementId}`);
        ctx.chart.destroy();
    }

    const remainingPercentage = 100 - percentage;
    console.log(`📊 Dados do gráfico: ${percentage}% preenchido, ${remainingPercentage}% restante`);
    
    try {
        // Dados para Chart.js v1.x (formato diferente)
        const data = [
            {
                value: percentage,
                color: color,
                highlight: color,
                label: "Concluído"
            },
            {
                value: remainingPercentage,
                color: "rgba(238, 238, 238, 0.3)",
                highlight: "rgba(238, 238, 238, 0.5)",
                label: "Restante"
            }
        ];

        // Opções para Chart.js v1.x
        const options = {
            responsive: true,
            maintainAspectRatio: false,
            showTooltips: false,
            showScale: false,
            scaleShowLabels: false,
            segmentShowStroke: false,
            animateRotate: true,
            animateScale: false,
            percentageInnerCutout: 70,
            animation: true,
            animationSteps: 60,
            animationEasing: "easeOutQuart",
            onAnimationComplete: function() {
                // Adicionar texto no centro após animação
                addCenterText(this, percentage, color, label);
            }
        };

        // Criar gráfico usando sintaxe Chart.js v1.x
        const chart = new Chart(ctx.getContext('2d')).Doughnut(data, options);

        // Salvar referência do chart no elemento
        ctx.chart = chart;
        console.log(`✅ Gráfico ${elementId} criado com sucesso!`);
        
        return chart;
    } catch (error) {
        console.error(`❌ Erro ao criar Chart.js para ${elementId}:`, error);
        return null;
    }
}

// Função para adicionar texto no centro do gráfico
function addCenterText(chart, percentage, color, label) {
    const ctx = chart.chart.ctx;
    const centerX = chart.chart.width / 2;
    const centerY = chart.chart.height / 2;
    
    ctx.save();
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    // Texto da porcentagem
    ctx.font = 'bold 18px "Segoe UI", Arial, sans-serif';
    ctx.fillStyle = color;
    ctx.fillText(percentage + '%', centerX, centerY - 5);
    
    // Texto do label (opcional)
    if (label) {
        ctx.font = '10px "Segoe UI", Arial, sans-serif';
        ctx.fillStyle = '#666';
        ctx.fillText(label, centerX, centerY + 15);
    }
    
    ctx.restore();
}

// Função para criar gráfico de barras moderno (alternativa para Chart.js v1.x)
function createModernBarChart(elementId, percentage, color, label) {
    console.log(`📊 Criando gráfico de barras: ${elementId} com ${percentage}%`);
    
    const ctx = document.getElementById(elementId);
    if (!ctx) {
        console.error(`❌ Elemento canvas ${elementId} não encontrado!`);
        return;
    }

    // Limpar canvas existente se houver
    if (ctx.chart) {
        ctx.chart.destroy();
    }

    try {
        const data = {
            labels: [""],
            datasets: [
                {
                    fillColor: color,
                    strokeColor: color,
                    highlightFill: color,
                    highlightStroke: color,
                    data: [percentage]
                }
            ]
        };

        const options = {
            responsive: true,
            maintainAspectRatio: false,
            showTooltips: false,
            showScale: false,
            scaleShowLabels: false,
            scaleShowGridLines: false,
            barShowStroke: false,
            animation: true,
            animationSteps: 60,
            animationEasing: "easeOutQuart"
        };

        const chart = new Chart(ctx.getContext('2d')).Bar(data, options);
        ctx.chart = chart;
        
        return chart;
    } catch (error) {
        console.error(`❌ Erro ao criar gráfico de barras para ${elementId}:`, error);
        return null;
    }
}

// Função para inicializar todos os gráficos modernos
function initModernCharts() {
    console.log('🔄 Iniciando gráficos modernos...');
    
    // Aguardar o DOM estar pronto
    if (document.readyState === 'loading') {
        console.log('⏳ DOM ainda carregando, aguardando...');
        document.addEventListener('DOMContentLoaded', initModernCharts);
        return;
    }

    // Verificar se Chart.js está disponível
    if (typeof Chart === 'undefined') {
        console.error('❌ Chart.js não está carregado!');
        return;
    }
    console.log('✅ Chart.js carregado com sucesso (versão 1.x)');

    // Configurações dos gráficos baseadas nos elementos existentes
    const charts = [
        {
            id: 'modern-pie-1',
            oldId: 'demo-pie-1',
            color: '#2dde98',
            label: 'Agendamentos'
        },
        {
            id: 'modern-pie-2', 
            oldId: 'demo-pie-2',
            color: '#8e43e7',
            label: 'Serviços'
        },
        {
            id: 'modern-pie-3',
            oldId: 'demo-pie-3', 
            color: '#e32424',
            label: 'Comissões'
        }
    ];

    charts.forEach(config => {
        console.log(`🔍 Processando gráfico: ${config.id}`);
        
        const oldElement = document.getElementById(config.oldId);
        const newElement = document.getElementById(config.id);
        
        console.log(`📊 Elemento antigo (${config.oldId}):`, oldElement);
        console.log(`📊 Elemento novo (${config.id}):`, newElement);
        
        if (oldElement && newElement) {
            // Pegar a porcentagem do elemento antigo
            const percentage = parseFloat(oldElement.getAttribute('data-percent')) || 0;
            console.log(`📈 Porcentagem para ${config.id}: ${percentage}%`);
            
            // Criar o novo gráfico
            try {
                createModernPieChart(config.id, percentage, config.color, config.label);
                console.log(`✅ Gráfico ${config.id} criado com sucesso`);
            } catch (error) {
                console.error(`❌ Erro ao criar gráfico ${config.id}:`, error);
            }
        } else {
            console.warn(`⚠️ Elementos não encontrados para ${config.id}`);
            if (!oldElement) console.warn(`   - Elemento antigo ${config.oldId} não encontrado`);
            if (!newElement) console.warn(`   - Elemento novo ${config.id} não encontrado`);
        }
    });
    
    console.log('🎯 Inicialização dos gráficos concluída');
}

// Função para atualizar gráfico específico
function updateModernChart(chartId, newPercentage) {
    const element = document.getElementById(chartId);
    if (element && element.chart) {
        // Para Chart.js v1.x, precisamos recriar o gráfico
        const config = getChartConfig(chartId);
        if (config) {
            createModernPieChart(chartId, newPercentage, config.color, config.label);
        }
    }
}

// Função auxiliar para obter configuração do gráfico
function getChartConfig(chartId) {
    const configs = {
        'modern-pie-1': { color: '#2dde98', label: 'Agendamentos' },
        'modern-pie-2': { color: '#8e43e7', label: 'Serviços' },
        'modern-pie-3': { color: '#e32424', label: 'Comissões' }
    };
    return configs[chartId];
}

// Exportar funções para uso global
window.ModernCharts = {
    init: initModernCharts,
    createPie: createModernPieChart,
    createBar: createModernBarChart,
    update: updateModernChart
};

// Auto-inicializar quando o script for carregado
initModernCharts();

// Função para criar gráfico de barras moderno (alternativa)
function createModernBarChart(elementId, percentage, color, label) {
    const ctx = document.getElementById(elementId);
    if (!ctx) return;

    // Limpar canvas existente se houver
    if (ctx.chart) {
        ctx.chart.destroy();
    }

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [''],
            datasets: [{
                data: [percentage],
                backgroundColor: [color],
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    display: false
                },
                x: {
                    display: false
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart'
            }
        },
        plugins: [{
            id: 'centerText',
            afterDraw: function(chart) {
                const ctx = chart.ctx;
                const centerX = chart.chartArea.left + (chart.chartArea.right - chart.chartArea.left) / 2;
                const centerY = chart.chartArea.top + (chart.chartArea.bottom - chart.chartArea.top) / 2;
                
                ctx.save();
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                
                // Texto da porcentagem
                ctx.font = 'bold 16px "Segoe UI"';
                ctx.fillStyle = '#fff';
                ctx.fillText(percentage + '%', centerX, centerY);
                
                ctx.restore();
            }
        }]
    });

    ctx.chart = chart;
    return chart;
}

// Função para inicializar todos os gráficos modernos
function initModernCharts() {
    console.log('🔄 Iniciando gráficos modernos...');
    
    // Aguardar o DOM estar pronto
    if (document.readyState === 'loading') {
        console.log('⏳ DOM ainda carregando, aguardando...');
        document.addEventListener('DOMContentLoaded', initModernCharts);
        return;
    }

    // Verificar se Chart.js está disponível
    if (typeof Chart === 'undefined') {
        console.error('❌ Chart.js não está carregado!');
        return;
    }
    console.log('✅ Chart.js carregado com sucesso');

    // Configurações dos gráficos baseadas nos elementos existentes
    const charts = [
        {
            id: 'modern-pie-1',
            oldId: 'demo-pie-1',
            color: '#2dde98',
            label: 'Agendamentos'
        },
        {
            id: 'modern-pie-2', 
            oldId: 'demo-pie-2',
            color: '#8e43e7',
            label: 'Serviços'
        },
        {
            id: 'modern-pie-3',
            oldId: 'demo-pie-3', 
            color: '#e32424',
            label: 'Comissões'
        }
    ];

    charts.forEach(config => {
        console.log(`🔍 Processando gráfico: ${config.id}`);
        
        const oldElement = document.getElementById(config.oldId);
        const newElement = document.getElementById(config.id);
        
        console.log(`📊 Elemento antigo (${config.oldId}):`, oldElement);
        console.log(`📊 Elemento novo (${config.id}):`, newElement);
        
        if (oldElement && newElement) {
            // Pegar a porcentagem do elemento antigo
            const percentage = parseFloat(oldElement.getAttribute('data-percent')) || 0;
            console.log(`📈 Porcentagem para ${config.id}: ${percentage}%`);
            
            // Criar o novo gráfico
            try {
                createModernPieChart(config.id, percentage, config.color, config.label);
                console.log(`✅ Gráfico ${config.id} criado com sucesso`);
            } catch (error) {
                console.error(`❌ Erro ao criar gráfico ${config.id}:`, error);
            }
        } else {
            console.warn(`⚠️ Elementos não encontrados para ${config.id}`);
            if (!oldElement) console.warn(`   - Elemento antigo ${config.oldId} não encontrado`);
            if (!newElement) console.warn(`   - Elemento novo ${config.id} não encontrado`);
        }
    });
    
    console.log('🎯 Inicialização dos gráficos concluída');
}

// Função para atualizar gráfico específico
function updateModernChart(chartId, newPercentage) {
    const element = document.getElementById(chartId);
    if (element && element.chart) {
        element.chart.data.datasets[0].data = [newPercentage, 100 - newPercentage];
        element.chart.update('active');
    }
}

// Exportar funções para uso global
window.ModernCharts = {
    init: initModernCharts,
    createPie: createModernPieChart,
    createBar: createModernBarChart,
    update: updateModernChart
};

// Auto-inicializar quando o script for carregado
initModernCharts();
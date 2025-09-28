<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo - Cards com Ícones Lucide</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Font Awesome (fallback) -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Lucide Icons CSS personalizado -->
    <link href="css/lucide-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        
        .demo-section {
            margin-bottom: 40px;
        }
        
        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .stats-card {
            text-align: center;
            padding: 20px;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
        }
        
        .service-card {
            border-left: 4px solid #007bff;
        }
        
        .price-tag {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5">
                    <i data-lucide="scissors" class="lucide lucide-lg lucide-primary"></i>
                    Exemplo de Cards com Ícones Lucide
                </h1>
            </div>
        </div>

        <!-- Seção: Cards de Estatísticas -->
        <div class="demo-section">
            <h2 class="mb-4">
                <i data-lucide="bar-chart" class="lucide"></i>
                Cards de Estatísticas
            </h2>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <i data-lucide="users" class="lucide lucide-xl lucide-primary mb-3"></i>
                            <div class="stats-number">247</div>
                            <p class="text-muted">Clientes Ativos</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <i data-lucide="calendar" class="lucide lucide-xl lucide-success mb-3"></i>
                            <div class="stats-number">89</div>
                            <p class="text-muted">Agendamentos Hoje</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <i data-lucide="dollar-sign" class="lucide lucide-xl lucide-warning mb-3"></i>
                            <div class="stats-number">R$ 3.2k</div>
                            <p class="text-muted">Faturamento Hoje</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <i data-lucide="trending-up" class="lucide lucide-xl lucide-info mb-3"></i>
                            <div class="stats-number">+15%</div>
                            <p class="text-muted">Crescimento Mensal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção: Cards de Serviços -->
        <div class="demo-section">
            <h2 class="mb-4">
                <i data-lucide="scissors" class="lucide"></i>
                Cards de Serviços
            </h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card service-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i data-lucide="scissors" class="lucide"></i>
                                Corte Masculino
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Corte moderno e estiloso com acabamento profissional.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price-tag">R$ 35,00</span>
                                <div>
                                    <i data-lucide="clock" class="lucide lucide-sm"></i>
                                    <small class="text-muted">45 min</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card service-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i data-lucide="user" class="lucide"></i>
                                Barba Completa
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Aparar, modelar e finalizar com produtos premium.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price-tag">R$ 25,00</span>
                                <div>
                                    <i data-lucide="clock" class="lucide lucide-sm"></i>
                                    <small class="text-muted">30 min</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card service-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i data-lucide="star" class="lucide"></i>
                                Combo Premium
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Corte + Barba + Sobrancelha + Tratamento capilar.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price-tag">R$ 80,00</span>
                                <div>
                                    <i data-lucide="clock" class="lucide lucide-sm"></i>
                                    <small class="text-muted">90 min</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção: Cards de Agendamentos -->
        <div class="demo-section">
            <h2 class="mb-4">
                <i data-lucide="calendar" class="lucide"></i>
                Cards de Agendamentos
            </h2>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i data-lucide="check-circle" class="lucide lucide-success"></i>
                                Próximos Agendamentos
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i data-lucide="user" class="lucide lucide-primary me-3"></i>
                                <div>
                                    <strong>João Silva</strong><br>
                                    <small class="text-muted">
                                        <i data-lucide="clock" class="lucide lucide-sm"></i>
                                        14:30 - Corte + Barba
                                    </small>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i data-lucide="user" class="lucide lucide-primary me-3"></i>
                                <div>
                                    <strong>Pedro Santos</strong><br>
                                    <small class="text-muted">
                                        <i data-lucide="clock" class="lucide lucide-sm"></i>
                                        15:00 - Corte Masculino
                                    </small>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i data-lucide="user" class="lucide lucide-primary me-3"></i>
                                <div>
                                    <strong>Carlos Lima</strong><br>
                                    <small class="text-muted">
                                        <i data-lucide="clock" class="lucide lucide-sm"></i>
                                        15:30 - Combo Premium
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i data-lucide="settings" class="lucide"></i>
                                Ações Rápidas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i data-lucide="plus" class="lucide lucide-sm"></i>
                                    Novo Agendamento
                                </button>
                                
                                <button class="btn btn-outline-secondary">
                                    <i data-lucide="search" class="lucide lucide-sm"></i>
                                    Buscar Cliente
                                </button>
                                
                                <button class="btn btn-outline-info">
                                    <i data-lucide="calendar" class="lucide lucide-sm"></i>
                                    Ver Agenda Completa
                                </button>
                                
                                <button class="btn btn-outline-success">
                                    <i data-lucide="download" class="lucide lucide-sm"></i>
                                    Relatório do Dia
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção: Cards de Contato -->
        <div class="demo-section">
            <h2 class="mb-4">
                <i data-lucide="phone" class="lucide"></i>
                Cards de Contato
            </h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i data-lucide="phone" class="lucide lucide-xl lucide-primary mb-3"></i>
                            <h5>Telefone</h5>
                            <p class="text-muted">(45) 99988-2100</p>
                            <button class="btn btn-primary btn-sm">
                                <i data-lucide="phone" class="lucide lucide-sm"></i>
                                Ligar
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i data-lucide="mail" class="lucide lucide-xl lucide-success mb-3"></i>
                            <h5>E-mail</h5>
                            <p class="text-muted">contato@barbearia.com</p>
                            <button class="btn btn-success btn-sm">
                                <i data-lucide="mail" class="lucide lucide-sm"></i>
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i data-lucide="map-pin" class="lucide lucide-xl lucide-warning mb-3"></i>
                            <h5>Localização</h5>
                            <p class="text-muted">Rua das Flores, 123</p>
                            <button class="btn btn-warning btn-sm">
                                <i data-lucide="map-pin" class="lucide lucide-sm"></i>
                                Ver Mapa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    
    <!-- Lucide Icons JavaScript -->
    <script src="js/lucide-icons.js"></script>
    
    <script>
        // Exemplo de como adicionar ícones dinamicamente
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Página carregada! Ícones Lucide inicializados.');
            
            // Exemplo de adição dinâmica de ícone
            setTimeout(() => {
                const button = document.querySelector('.btn-primary');
                if (button && window.LucideIcons) {
                    console.log('Adicionando ícone dinamicamente...');
                }
            }, 2000);
        });
    </script>
</body>
</html>
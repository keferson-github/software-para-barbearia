/**
 * Animações e Interatividade para Cards Modernos de Estatísticas
 * Sistema de Barbearia - Dashboard
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== ANIMAÇÃO DE CONTADORES ===== //
    function animateCounters() {
        const counters = document.querySelectorAll('.stats-number[data-count]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000; // 2 segundos
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 16);
        });
    }
    
    // ===== ANIMAÇÃO DAS BARRAS DE PROGRESSO ===== //
    function animateProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar[data-percent]');
        
        progressBars.forEach(bar => {
            const percent = parseInt(bar.getAttribute('data-percent'));
            
            // Delay para criar efeito sequencial
            setTimeout(() => {
                bar.style.width = percent + '%';
            }, Math.random() * 500 + 200);
        });
    }
    
    // ===== OBSERVER PARA ANIMAÇÕES ON SCROLL ===== //
    function setupScrollAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    
                    // Trigger animações específicas quando o card entra na tela
                    if (entry.target.classList.contains('modern-stats-card')) {
                        setTimeout(() => {
                            animateCounters();
                            animateProgressBars();
                        }, 300);
                    }
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        });
        
        // Observar todos os cards modernos
        document.querySelectorAll('.modern-stats-card').forEach(card => {
            observer.observe(card);
        });
    }
    
    // ===== EFEITOS DE HOVER AVANÇADOS ===== //
    function setupAdvancedHoverEffects() {
        const cards = document.querySelectorAll('.modern-stats-card');
        
        cards.forEach(card => {
            // Efeito de paralaxe no mouse
            card.addEventListener('mousemove', (e) => {
                if (window.innerWidth > 768) { // Apenas em desktop
                    // Removido efeito 3D de movimento
                    // const rect = card.getBoundingClientRect();
                    // const x = e.clientX - rect.left;
                    // const y = e.clientY - rect.top;
                    
                    // const centerX = rect.width / 2;
                    // const centerY = rect.height / 2;
                    
                    // const rotateX = (y - centerY) / 10;
                    // const rotateY = (centerX - x) / 10;
                    
                    // card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px) scale(1.02)`;
                }
            });
            
            card.addEventListener('mouseleave', () => {
                if (window.innerWidth > 768) {
                    // Removido reset do transform
                    // card.style.transform = '';
                }
            });
            
            // Efeito de ripple no clique
            card.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                ripple.classList.add('ripple-effect');
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }
    
    // ===== ANIMAÇÃO DE LOADING DOS GRÁFICOS ===== //
    function setupChartLoadingAnimation() {
        const charts = document.querySelectorAll('.chart-container');
        
        charts.forEach(container => {
            const canvas = container.querySelector('.modern-chart');
            const percentText = container.querySelector('.chart-percent');
            
            if (canvas && percentText) {
                // Adicionar loading spinner
                const loader = document.createElement('div');
                loader.classList.add('chart-loader');
                loader.innerHTML = '<div class="spinner"></div>';
                container.appendChild(loader);
                
                // Simular carregamento do gráfico
                setTimeout(() => {
                    loader.style.opacity = '0';
                    canvas.style.opacity = '1';
                    percentText.style.opacity = '1';
                    
                    setTimeout(() => {
                        loader.remove();
                    }, 300);
                }, 1000 + Math.random() * 1000);
            }
        });
    }
    
    // ===== TOOLTIP INTERATIVO ===== //
    function setupTooltips() {
        const cards = document.querySelectorAll('.modern-stats-card');
        
        cards.forEach(card => {
            const title = card.querySelector('.stats-title').textContent;
            const number = card.querySelector('.stats-number').textContent;
            const subtitle = card.querySelector('.stats-subtitle').textContent;
            
            card.setAttribute('title', `${title}: ${number}+ ${subtitle}`);
            
            // Tooltip customizado
            card.addEventListener('mouseenter', function(e) {
                if (window.innerWidth > 768) {
                    const tooltip = document.createElement('div');
                    tooltip.classList.add('custom-tooltip');
                    tooltip.innerHTML = `
                        <strong>${title}</strong><br>
                        <span class="tooltip-number">${number}+</span><br>
                        <small>${subtitle}</small>
                    `;
                    
                    document.body.appendChild(tooltip);
                    
                    const updateTooltipPosition = (e) => {
                        tooltip.style.left = e.pageX + 10 + 'px';
                        tooltip.style.top = e.pageY - 10 + 'px';
                    };
                    
                    updateTooltipPosition(e);
                    
                    this.addEventListener('mousemove', updateTooltipPosition);
                    
                    this.addEventListener('mouseleave', () => {
                        tooltip.remove();
                    }, { once: true });
                }
            });
        });
    }
    
    // ===== INICIALIZAÇÃO ===== //
    function init() {
        // Verificar se os elementos existem antes de inicializar
        if (document.querySelectorAll('.modern-stats-card').length > 0) {
            setupScrollAnimations();
            setupAdvancedHoverEffects();
            setupChartLoadingAnimation();
            setupTooltips();
            
            // Trigger inicial das animações se os cards já estão visíveis
            setTimeout(() => {
                const firstCard = document.querySelector('.modern-stats-card');
                if (firstCard && isElementInViewport(firstCard)) {
                    animateCounters();
                    animateProgressBars();
                }
            }, 500);
        }
    }
    
    // ===== UTILITÁRIOS ===== //
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Inicializar quando o DOM estiver pronto
    init();
    
    // Re-inicializar em mudanças de tamanho da tela
    window.addEventListener('resize', () => {
        // Removido reset de transform - cards devem permanecer estáticos
        // if (window.innerWidth <= 768) {
        //     document.querySelectorAll('.modern-stats-card').forEach(card => {
        //         card.style.transform = '';
        //     });
        // }
    });
});
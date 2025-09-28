/**
 * Lucide Icons - Sistema de Ícones SVG Modernos
 * Carregamento dinâmico via CDN para melhor performance
 */

// Configuração dos ícones Lucide
const LucideIcons = {
    // CDN da biblioteca Lucide
    cdnUrl: 'https://unpkg.com/lucide@latest/dist/umd/lucide.js',
    
    // Ícones específicos para barbearia
    barbearia: {
        'scissors': 'scissors',
        'calendar': 'calendar',
        'clock': 'clock',
        'user': 'user',
        'users': 'users',
        'phone': 'phone',
        'mail': 'mail',
        'map-pin': 'map-pin',
        'star': 'star',
        'heart': 'heart',
        'check-circle': 'check-circle',
        'x-circle': 'x-circle',
        'alert-circle': 'alert-circle',
        'info': 'info',
        'settings': 'settings',
        'edit': 'edit',
        'trash-2': 'trash-2',
        'plus': 'plus',
        'minus': 'minus',
        'search': 'search',
        'filter': 'filter',
        'download': 'download',
        'upload': 'upload',
        'eye': 'eye',
        'eye-off': 'eye-off',
        'lock': 'lock',
        'unlock': 'unlock',
        'credit-card': 'credit-card',
        'dollar-sign': 'dollar-sign',
        'trending-up': 'trending-up',
        'trending-down': 'trending-down',
        'bar-chart': 'bar-chart',
        'pie-chart': 'pie-chart'
    },

    // Inicializar os ícones
    init: function() {
        this.loadLucideLibrary();
    },

    // Carregar biblioteca Lucide via CDN
    loadLucideLibrary: function() {
        const script = document.createElement('script');
        script.src = this.cdnUrl;
        script.onload = () => {
            console.log('Lucide Icons carregados com sucesso!');
            this.replaceIcons();
        };
        script.onerror = () => {
            console.warn('Erro ao carregar Lucide Icons. Mantendo Font Awesome como fallback.');
        };
        document.head.appendChild(script);
    },

    // Substituir ícones Font Awesome por Lucide onde apropriado
    replaceIcons: function() {
        if (typeof lucide === 'undefined') return;

        // Mapeamento de classes Font Awesome para Lucide
        const iconMap = {
            'fa-scissors': 'scissors',
            'fa-calendar': 'calendar',
            'fa-clock-o': 'clock',
            'fa-user': 'user',
            'fa-users': 'users',
            'fa-phone': 'phone',
            'fa-envelope': 'mail',
            'fa-map-marker': 'map-pin',
            'fa-star': 'star',
            'fa-heart': 'heart',
            'fa-check-circle': 'check-circle',
            'fa-times-circle': 'x-circle',
            'fa-exclamation-circle': 'alert-circle',
            'fa-info-circle': 'info',
            'fa-cog': 'settings',
            'fa-edit': 'edit',
            'fa-trash': 'trash-2',
            'fa-plus': 'plus',
            'fa-minus': 'minus',
            'fa-search': 'search',
            'fa-filter': 'filter',
            'fa-download': 'download',
            'fa-upload': 'upload',
            'fa-eye': 'eye',
            'fa-eye-slash': 'eye-off',
            'fa-lock': 'lock',
            'fa-unlock': 'unlock',
            'fa-credit-card': 'credit-card',
            'fa-dollar': 'dollar-sign'
        };

        // Substituir ícones nos cards
        document.querySelectorAll('.card i[class*="fa-"]').forEach(icon => {
            const classes = Array.from(icon.classList);
            const faClass = classes.find(cls => cls.startsWith('fa-') && iconMap[cls]);
            
            if (faClass && iconMap[faClass]) {
                this.replaceWithLucide(icon, iconMap[faClass]);
            }
        });

        // Inicializar todos os ícones Lucide
        lucide.createIcons();
    },

    // Substituir elemento Font Awesome por Lucide
    replaceWithLucide: function(element, iconName) {
        const lucideIcon = document.createElement('i');
        lucideIcon.setAttribute('data-lucide', iconName);
        lucideIcon.className = 'lucide';
        
        // Preservar classes adicionais (cores, tamanhos, etc.)
        const additionalClasses = Array.from(element.classList)
            .filter(cls => !cls.startsWith('fa'))
            .join(' ');
        
        if (additionalClasses) {
            lucideIcon.className += ' ' + additionalClasses;
        }

        element.parentNode.replaceChild(lucideIcon, element);
    },

    // Criar ícone Lucide programaticamente
    createIcon: function(iconName, className = '') {
        const icon = document.createElement('i');
        icon.setAttribute('data-lucide', iconName);
        icon.className = 'lucide ' + className;
        return icon;
    },

    // Adicionar ícone a um elemento
    addIconToElement: function(element, iconName, position = 'before') {
        const icon = this.createIcon(iconName);
        
        if (position === 'before') {
            element.insertBefore(icon, element.firstChild);
        } else {
            element.appendChild(icon);
        }

        // Reinicializar ícones se Lucide estiver carregado
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
};

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    LucideIcons.init();
});

// Disponibilizar globalmente
window.LucideIcons = LucideIcons;
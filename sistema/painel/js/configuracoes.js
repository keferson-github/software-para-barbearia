/**
 * JavaScript para página de configurações
 * Responsável por melhorar a UX com feedback visual e validações
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Elementos do DOM
    const form = document.getElementById('form-config');
    const btnSalvar = document.querySelector('.btn-save');
    const inputs = document.querySelectorAll('.config-section .form-control');
    const sections = document.querySelectorAll('.config-section');
    
    // Inicialização
    initializeConfigPage();
    initFooterButtons();
    initTooltips();
    
    /**
     * Inicializa a página de configurações
     */
    function initializeConfigPage() {
        setupFormValidation();
        setupImagePreviews();
        setupSaveButton();
        setupInputFeedback();
        showWelcomeMessage();
    }
    
    /**
     * Configura validação do formulário
     */
    function setupFormValidation() {
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                submitForm();
            }
        });
    }
    
    /**
     * Configura preview de imagens
     */
    function setupImagePreviews() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const previewContainer = input.closest('.form-group').querySelector('.image-preview');
                
                if (file && previewContainer) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" style="max-height: 60px;">
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }
    
    /**
     * Configura o botão de salvar
     */
    function setupSaveButton() {
        if (!btnSalvar) return;
        
        btnSalvar.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                submitForm();
            }
        });
    }
    
    /**
     * Configura feedback visual nos inputs
     */
    function setupInputFeedback() {
        inputs.forEach(input => {
            // Feedback ao digitar
            input.addEventListener('input', function() {
                clearInputError(this);
            });
            
            // Validação ao sair do campo
            input.addEventListener('blur', function() {
                validateInput(this);
            });
        });
    }
    
    /**
     * Inicializa animações das seções
     */
    function initSectionAnimations() {
        sections.forEach((section, index) => {
            // Animação de entrada
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 150);
        });
        
        // Efeito de foco nas seções
        sections.forEach(section => {
            const sectionInputs = section.querySelectorAll('input, select, textarea');
            
            sectionInputs.forEach(input => {
                input.addEventListener('focus', () => {
                    section.classList.add('section-focused');
                });
                
                input.addEventListener('blur', () => {
                    setTimeout(() => {
                        const focusedInput = section.querySelector('input:focus, select:focus, textarea:focus');
                        if (!focusedInput) {
                            section.classList.remove('section-focused');
                        }
                    }, 100);
                });
            });
        });
    }
    
    /**
     * Inicializa recursos avançados
     */
    function initAdvancedFeatures() {
        setupNotificationSystem();
        setupProgressIndicator();
        setupAutoSave();
        setupKeyboardShortcuts();
    }
    
    /**
     * Sistema de notificações
     */
    function setupNotificationSystem() {
        window.showConfigNotification = function(message, type = 'info') {
            const existingNotification = document.querySelector('.config-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            const notification = document.createElement('div');
            notification.className = `config-notification notification-${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button type="button" class="notification-close" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        };
    }
    
    /**
     * Indicador de progresso
     */
    function setupProgressIndicator() {
        const totalSections = sections.length;
        let completedSections = 0;
        
        // Criar barra de progresso
        const progressContainer = document.createElement('div');
        progressContainer.className = 'config-progress-container';
        progressContainer.innerHTML = `
            <div class="config-progress-bar">
                <div class="config-progress-fill" style="width: 0%"></div>
            </div>
            <span class="config-progress-text">0% completo</span>
        `;
        
        const pageHeader = document.querySelector('.page-header');
        if (pageHeader) {
            pageHeader.appendChild(progressContainer);
        }
        
        // Atualizar progresso
        function updateProgress() {
            completedSections = 0;
            
            sections.forEach(section => {
                const requiredInputs = section.querySelectorAll('input[required], select[required], textarea[required]');
                const filledInputs = Array.from(requiredInputs).filter(input => input.value.trim() !== '');
                
                if (requiredInputs.length === 0 || filledInputs.length === requiredInputs.length) {
                    completedSections++;
                }
            });
            
            const percentage = Math.round((completedSections / totalSections) * 100);
            const progressFill = document.querySelector('.config-progress-fill');
            const progressText = document.querySelector('.config-progress-text');
            
            if (progressFill && progressText) {
                progressFill.style.width = `${percentage}%`;
                progressText.textContent = `${percentage}% completo`;
            }
        }
        
        // Monitorar mudanças nos inputs
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
            input.addEventListener('change', updateProgress);
        });
        
        // Atualização inicial
        updateProgress();
    }
    
    /**
     * Auto-salvamento (draft)
     */
    function setupAutoSave() {
        let autoSaveTimeout;
        
        function saveFormData() {
            const formData = new FormData(form);
            const data = {};
            
            for (let [key, value] of formData.entries()) {
                if (value && typeof value === 'string') {
                    data[key] = value;
                }
            }
            
            localStorage.setItem('config_draft', JSON.stringify(data));
            
            // Mostrar indicador de salvamento
            const indicator = document.createElement('div');
            indicator.className = 'auto-save-indicator';
            indicator.innerHTML = '<i class="fas fa-save"></i> Rascunho salvo';
            document.body.appendChild(indicator);
            
            setTimeout(() => {
                if (indicator.parentElement) {
                    indicator.remove();
                }
            }, 2000);
        }
        
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(saveFormData, 3000);
            });
        });
        
        // Carregar dados salvos
        const savedData = localStorage.getItem('config_draft');
        if (savedData) {
            try {
                const data = JSON.parse(savedData);
                Object.keys(data).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && !input.value) {
                        input.value = data[key];
                    }
                });
            } catch (e) {
                console.log('Erro ao carregar rascunho:', e);
            }
        }
    }
    
    /**
     * Atalhos de teclado
     */
    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', function(e) {
            // Ctrl + S para salvar
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                if (btnSalvar) {
                    btnSalvar.click();
                }
            }
            
            // Ctrl + R para resetar formulário
            if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                if (confirm('Deseja realmente resetar o formulário?')) {
                    form.reset();
                    localStorage.removeItem('config_draft');
                    window.showConfigNotification('Formulário resetado', 'info');
                }
            }
        });
    }
    function validateInput(input) {
        const value = input.value.trim();
        const isRequired = input.hasAttribute('required');
        
        if (isRequired && !value) {
            showInputError(input, 'Este campo é obrigatório');
            return false;
        }
        
        // Validações específicas por tipo
        if (input.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                showInputError(input, 'Digite um email válido');
                return false;
            }
        }
        
        if (input.type === 'url' && value) {
            try {
                new URL(value);
            } catch {
                showInputError(input, 'Digite uma URL válida');
                return false;
            }
        }
        
        clearInputError(input);
        return true;
    }
    
    /**
     * Valida todo o formulário
     */
    function validateForm() {
        let isValid = true;
        const requiredInputs = document.querySelectorAll('.config-section .form-control[required]');
        
        requiredInputs.forEach(input => {
            if (!validateInput(input)) {
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    /**
     * Mostra erro em um input
     */
    function showInputError(input, message) {
        clearInputError(input);
        
        input.style.borderColor = '#dc3545';
        input.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'input-error';
        errorDiv.style.cssText = `
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        `;
        errorDiv.textContent = message;
        
        input.parentNode.appendChild(errorDiv);
    }
    
    /**
     * Remove erro de um input
     */
    function clearInputError(input) {
        input.style.borderColor = '';
        input.style.boxShadow = '';
        
        const errorDiv = input.parentNode.querySelector('.input-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
    
    /**
     * Submete o formulário com loading
     */
    function submitForm() {
        // Ativa loading no botão
        btnSalvar.classList.add('loading');
        btnSalvar.disabled = true;
        
        // Simula envio (aqui você pode fazer a requisição AJAX)
        setTimeout(() => {
            // Remove loading
            btnSalvar.classList.remove('loading');
            btnSalvar.disabled = false;
            
            // Mostra mensagem de sucesso
            showSuccessMessage('Configurações salvas com sucesso!');
            
            // Submete o formulário real
            form.submit();
        }, 1500);
    }
    
    /**
     * Mostra mensagem de sucesso
     */
    function showSuccessMessage(message) {
        const messageArea = document.querySelector('.message-area');
        if (!messageArea) return;
        
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success';
        alertDiv.style.cssText = `
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        `;
        alertDiv.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        `;
        
        messageArea.innerHTML = '';
        messageArea.appendChild(alertDiv);
        
        // Remove a mensagem após 5 segundos
        setTimeout(() => {
            alertDiv.style.opacity = '0';
            setTimeout(() => alertDiv.remove(), 300);
        }, 5000);
    }
    
    /**
     * Mostra mensagem de boas-vindas
     */
    function showWelcomeMessage() {
        // Adiciona animação suave ao carregar a página
        const sections = document.querySelectorAll('.config-section');
        sections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                section.style.transition = 'all 0.5s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }
    
    /**
     * Smooth scroll para seções
     */
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
    
    // Expõe funções globalmente se necessário
    window.ConfigPage = {
        scrollToSection,
        showSuccessMessage
    };
});

/**
 * Utilitários para formatação de campos
 */
function formatPhone(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.length <= 11) {
        value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
    }
    
    input.value = value;
}

function formatCEP(input) {
    let value = input.value.replace(/\D/g, '');
    value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
    input.value = value;
}

function formatCurrency(input) {
    let value = input.value.replace(/\D/g, '');
    value = (value / 100).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });
    input.value = value;
}
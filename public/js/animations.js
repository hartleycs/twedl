/**
 * Enhanced animations for Twedl.com
 * This script adds interactive animations and effects to the UI
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initHeaderAnimation();
    initScrollAnimations();
    initHoverEffects();
    initFormAnimations();
    initDarkModeToggle();
});

/**
 * Header animation that changes on scroll
 */
function initHeaderAnimation() {
    const header = document.querySelector('.enhanced-header');
    if (!header) return;
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });
}

/**
 * Scroll-triggered animations for elements
 */
function initScrollAnimations() {
    // Check if Intersection Observer is supported
    if (!('IntersectionObserver' in window)) return;
    
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Optionally unobserve after animation
                // observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

/**
 * Enhanced hover effects for interactive elements
 */
function initHoverEffects() {
    // Card hover effects
    const cards = document.querySelectorAll('.enhanced-card, .event-card-enhanced');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('card-hover');
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('card-hover');
        });
    });
    
    // Button ripple effect
    const buttons = document.querySelectorAll('.btn-enhanced');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
}

/**
 * Form field animations
 */
function initFormAnimations() {
    const formInputs = document.querySelectorAll('.form-input-enhanced');
    
    formInputs.forEach(input => {
        // Handle focus state
        input.addEventListener('focus', function() {
            const label = this.previousElementSibling;
            if (label && label.classList.contains('form-label-enhanced')) {
                label.classList.add('label-focus');
            }
        });
        
        // Handle blur state
        input.addEventListener('blur', function() {
            const label = this.previousElementSibling;
            if (label && label.classList.contains('form-label-enhanced')) {
                if (!this.value) {
                    label.classList.remove('label-focus');
                }
            }
        });
        
        // Initialize with value
        if (input.value) {
            const label = input.previousElementSibling;
            if (label && label.classList.contains('form-label-enhanced')) {
                label.classList.add('label-focus');
            }
        }
    });
}

/**
 * Dark mode toggle functionality
 */
function initDarkModeToggle() {
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    if (!darkModeToggle) return;
    
    // Check for saved user preference
    const darkModeSaved = localStorage.getItem('darkMode') === 'true';
    
    // Set initial state
    if (darkModeSaved) {
        document.documentElement.classList.add('dark');
        darkModeToggle.setAttribute('aria-checked', 'true');
    }
    
    // Toggle dark mode
    darkModeToggle.addEventListener('click', function() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', isDark);
        this.setAttribute('aria-checked', isDark);
    });
}

/**
 * Parallax effect for hero section
 */
function initParallaxEffect() {
    const parallaxElements = document.querySelectorAll('.parallax');
    
    window.addEventListener('scroll', function() {
        const scrollY = window.scrollY;
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            const yPos = -(scrollY * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });
}

/**
 * Staggered animation for list items
 */
function initStaggeredAnimations() {
    const staggerContainers = document.querySelectorAll('.stagger-container');
    
    staggerContainers.forEach(container => {
        const items = container.querySelectorAll('.stagger-item');
        
        items.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
    });
}

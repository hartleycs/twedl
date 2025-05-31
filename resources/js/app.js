// Import jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Dark mode functionality
document.addEventListener('DOMContentLoaded', function() {
    // On page load, set the theme based on localStorage or system preference
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});

// Any other global JavaScript can go here

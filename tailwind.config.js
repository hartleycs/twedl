/* Tailwind CSS configuration for Twedl.com */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#6366F1',
          hover: '#4F46E5',
          light: '#EEF2FF',
        },
        secondary: {
          DEFAULT: '#EC4899',
          hover: '#DB2777',
          light: '#FCE7F3',
        },
        neutral: {
          background: '#FFFFFF',
          card: '#F9FAFB',
          'dark-bg': '#111827',
          'dark-card': '#1F2937',
        },
        text: {
          primary: '#111827',
          secondary: '#4B5563',
          light: '#9CA3AF',
          dark: '#F9FAFB',
          'dark-secondary': '#D1D5DB',
        },
        status: {
          success: '#10B981',
          warning: '#F59E0B',
          error: '#EF4444',
          info: '#3B82F6',
        },
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        heading: ['Poppins', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      boxShadow: {
        card: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      },
      transitionDuration: {
        fast: '150ms',
        normal: '300ms',
      },
      borderRadius: {
        'card': '0.5rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

/* Tailwind CSS configuration for Twedl.com with updated brighter colors */
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
          DEFAULT: '#27667B',
          hover: '#143D60',
          light: '#DDEB9D',
        },
        secondary: {
          DEFAULT: '#A0C878',
          hover: '#8BB562',
          light: '#E9F5D0',
        },
        neutral: {
          background: '#FFFFFF',
          card: '#F9FAFB',
          'dark-bg': '#0F2A45',
          'dark-card': '#1A3A5A',
        },
        text: {
          primary: '#143D60',
          secondary: '#27667B',
          light: '#6B8A9C',
          dark: '#F9FAFB',
          'dark-secondary': '#D1D5DB',
        },
        status: {
          success: '#A0C878',
          warning: '#F5D76E',
          error: '#E74C3C',
          info: '#27667B',
        },
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        heading: ['Poppins', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      boxShadow: {
        card: '0 4px 6px -1px rgba(20, 61, 96, 0.1), 0 2px 4px -1px rgba(20, 61, 96, 0.06)',
        'card-hover': '0 10px 15px -3px rgba(20, 61, 96, 0.1), 0 4px 6px -2px rgba(20, 61, 96, 0.05)',
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

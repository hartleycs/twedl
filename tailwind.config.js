module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#10B981',
        'primary-dark': '#059669',
        'primary-light': '#34D399',
        secondary: '#6B7280',
        'secondary-dark': '#4B5563',
        'secondary-light': '#9CA3AF',
        'neutral-dark-bg': '#111827',
        'neutral-dark-card': '#1F2937',
        'text-primary': '#111827',
        'text-secondary': '#6B7280',
        'text-dark': '#F9FAFB',
        'text-dark-secondary': '#E5E7EB',
      },
    },
  },
  plugins: [],
  safelist: [
    'grid',
    'gap-2',
    'outline-none',
    'ring-2',
    'ring-primary',
    '!mb-0',
    '!leading-tight'
  ]
}

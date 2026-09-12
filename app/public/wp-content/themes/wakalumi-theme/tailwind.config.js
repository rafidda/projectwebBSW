const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './assets/src/**/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          50:  '#F0FDFA',
          100: '#CCFBF1',
          200: '#99F6E4',
          300: '#5EEAD4',
          400: '#2DD4BF',
          500: '#14B8A6',
          600: '#0D9488',
          700: '#0F766E',
          800: '#115E59',
          900: '#134E4A',
          950: '#042F2E',
        },
        dark: {
          DEFAULT: '#0B1120',
          surface: '#131C31',
          'surface-alt': '#1A2742',
          border: '#1E3A5F',
          'border-light': '#2A4A6B',
        },
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
      },
      animation: {
        'fade-in': 'fadeIn 0.6s ease-out forwards',
        'slide-up': 'slideUp 0.6s ease-out forwards',
        'slide-down': 'slideDown 0.3s ease-out forwards',
        'glow-pulse': 'glowPulse 3s ease-in-out infinite',
        'float': 'float 6s ease-in-out infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        slideDown: {
          '0%': { opacity: '0', transform: 'translateY(-10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        glowPulse: {
          '0%, 100%': { boxShadow: '0 0 20px rgba(45, 212, 191, 0.2), 0 0 60px rgba(45, 212, 191, 0.05)' },
          '50%': { boxShadow: '0 0 30px rgba(45, 212, 191, 0.4), 0 0 80px rgba(45, 212, 191, 0.15)' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-10px)' },
        },
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'hero-pattern': 'linear-gradient(135deg, rgba(13,148,136,0.08) 25%, transparent 25%, transparent 50%, rgba(13,148,136,0.08) 50%, rgba(13,148,136,0.08) 75%, transparent 75%)',
        'hero-pattern-dark': 'linear-gradient(135deg, rgba(45,212,191,0.05) 25%, transparent 25%, transparent 50%, rgba(45,212,191,0.05) 50%, rgba(45,212,191,0.05) 75%, transparent 75%)',
      },
      backgroundSize: {
        'pattern': '60px 60px',
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            '--tw-prose-links': theme('colors.primary.600'),
            maxWidth: 'none',
          },
        },
        invert: {
          css: {
            '--tw-prose-links': theme('colors.primary.400'),
          },
        },
      }),
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
};


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
          50:  '#ECFEFF',
          100: '#CFFAFE',
          200: '#A5F3FC',
          300: '#5DF8D8',
          400: '#24B1B1',
          500: '#0E9AAA',
          600: '#088395',
          700: '#066E7D',
          800: '#055564',
          900: '#044350',
          950: '#032E35',
        },
        accent: {
          light: '#FEF3C7',
          DEFAULT: '#F59E0B',
          dark: '#B45309',
        },
        dark: {
          DEFAULT: '#121212',
          surface: '#1e1e1e',
          'surface-alt': '#2a2a2a',
          border: '#333333',
          'border-light': '#444444',
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
          '0%, 100%': { boxShadow: '0 0 20px rgba(93, 248, 216, 0.2), 0 0 60px rgba(93, 248, 216, 0.05)' },
          '50%': { boxShadow: '0 0 30px rgba(93, 248, 216, 0.4), 0 0 80px rgba(93, 248, 216, 0.15)' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-10px)' },
        },
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'hero-pattern': 'linear-gradient(135deg, rgba(8,131,149,0.08) 25%, transparent 25%, transparent 50%, rgba(8,131,149,0.08) 50%, rgba(8,131,149,0.08) 75%, transparent 75%)',
        'hero-pattern-dark': 'linear-gradient(135deg, rgba(93,248,216,0.05) 25%, transparent 25%, transparent 50%, rgba(93,248,216,0.05) 50%, rgba(93,248,216,0.05) 75%, transparent 75%)',
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

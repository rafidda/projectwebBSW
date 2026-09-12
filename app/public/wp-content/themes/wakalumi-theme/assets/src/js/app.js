/* ========================================================================
   BPRS Wakalumi Theme — Main JavaScript
   Swup page transitions, AOS animations, dark mode, navbar, interactions
   ======================================================================== */

import '../css/main.css';
import 'aos/dist/aos.css';
import Swup from 'swup';
import SwupHeadPlugin from '@swup/head-plugin';
import AOS from 'aos';

// ========================================================================
// DARK MODE
// ========================================================================
const DarkMode = {
  STORAGE_KEY: 'wakalumi-dark-mode',

  init() {
    const saved = localStorage.getItem(this.STORAGE_KEY);
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (saved === 'true' || (saved === null && prefersDark)) {
      document.documentElement.classList.add('dark');
    }

    // Listen for system preference changes
    window.matchMedia('(prefers-color-scheme: dark)')
      .addEventListener('change', (e) => {
        if (localStorage.getItem(this.STORAGE_KEY) === null) {
          document.documentElement.classList.toggle('dark', e.matches);
        }
      });

    this.bindToggle();
  },

  bindToggle() {
    document.querySelectorAll('[data-dark-toggle]').forEach(btn => {
      btn.addEventListener('click', () => this.toggle());
    });
  },

  toggle() {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem(this.STORAGE_KEY, isDark);

    // Update toggle icons
    document.querySelectorAll('[data-dark-toggle]').forEach(btn => {
      const sunIcon = btn.querySelector('.icon-sun');
      const moonIcon = btn.querySelector('.icon-moon');
      if (sunIcon && moonIcon) {
        sunIcon.classList.toggle('hidden', !isDark);
        moonIcon.classList.toggle('hidden', isDark);
      }
    });
  }
};

// ========================================================================
// NAVBAR
// ========================================================================
const Navbar = {
  navbar: null,
  lastScroll: 0,
  scrollThreshold: 50,

  init() {
    this.navbar = document.getElementById('main-navbar');
    if (!this.navbar) return;

    this.handleScroll();
    window.addEventListener('scroll', () => this.handleScroll(), { passive: true });
    this.initDropdowns();
  },

  handleScroll() {
    const currentScroll = window.scrollY;

    // Add/remove scrolled state (glass effect)
    if (currentScroll > this.scrollThreshold) {
      this.navbar.classList.add('scrolled');
      this.navbar.classList.add('shadow-lg', 'shadow-slate-900/5');
      this.navbar.classList.add('dark:shadow-black/20');
    } else {
      this.navbar.classList.remove('scrolled');
      this.navbar.classList.remove('shadow-lg', 'shadow-slate-900/5');
      this.navbar.classList.remove('dark:shadow-black/20');
    }

    this.lastScroll = currentScroll;
  },

  initDropdowns() {
    // Close dropdowns on click outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown.open').forEach(d => {
          d.classList.remove('open');
        });
      }
    });

    // Toggle dropdown on click (mobile-friendly)
    document.querySelectorAll('.dropdown > .dropdown-trigger').forEach(trigger => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        const dropdown = trigger.closest('.dropdown');
        const isOpen = dropdown.classList.contains('open');

        // Close all other dropdowns
        document.querySelectorAll('.dropdown.open').forEach(d => {
          if (d !== dropdown) d.classList.remove('open');
        });

        dropdown.classList.toggle('open', !isOpen);
      });
    });
  }
};

// ========================================================================
// MOBILE MENU
// ========================================================================
const MobileMenu = {
  init() {
    const toggle = document.getElementById('mobile-menu-toggle');
    const close = document.getElementById('mobile-menu-close');
    const overlay = document.getElementById('mobile-menu-overlay');
    const panel = document.getElementById('mobile-menu-panel');

    if (!toggle || !panel) return;

    toggle.addEventListener('click', () => this.open(overlay, panel));
    close?.addEventListener('click', () => this.close(overlay, panel));
    overlay?.addEventListener('click', () => this.close(overlay, panel));

    // Close on ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') this.close(overlay, panel);
    });

    // Mobile dropdown toggles
    document.querySelectorAll('.mobile-dropdown-trigger').forEach(trigger => {
      trigger.addEventListener('click', () => {
        const submenu = trigger.nextElementSibling;
        const icon = trigger.querySelector('.dropdown-icon');
        submenu?.classList.toggle('hidden');
        icon?.classList.toggle('rotate-180');
      });
    });
  },

  open(overlay, panel) {
    overlay?.classList.add('active');
    panel?.classList.add('active');
    document.body.style.overflow = 'hidden';
  },

  close(overlay, panel) {
    overlay?.classList.remove('active');
    panel?.classList.remove('active');
    document.body.style.overflow = '';
  }
};

// ========================================================================
// COUNTER ANIMATION (Intersection Observer)
// ========================================================================
const Counter = {
  init() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.animate(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));
  },

  animate(el) {
    const target = parseInt(el.getAttribute('data-counter'), 10);
    const suffix = el.getAttribute('data-counter-suffix') || '';
    const prefix = el.getAttribute('data-counter-prefix') || '';
    const duration = 2000;
    const start = performance.now();

    const step = (timestamp) => {
      const progress = Math.min((timestamp - start) / duration, 1);
      // Ease out cubic
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.floor(eased * target);
      el.textContent = prefix + current.toLocaleString('id-ID') + suffix;

      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = prefix + target.toLocaleString('id-ID') + suffix;
      }
    };

    requestAnimationFrame(step);
  }
};

// ========================================================================
// LAZY IMAGE LOADING
// ========================================================================
const LazyImages = {
  init() {
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
      if (img.complete) {
        img.classList.add('loaded');
      } else {
        img.addEventListener('load', () => img.classList.add('loaded'));
      }
    });
  }
};

// ========================================================================
// SMOOTH SCROLL for Anchor Links
// ========================================================================
const SmoothScroll = {
  init() {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', (e) => {
        const targetId = link.getAttribute('href');
        if (targetId === '#') return;

        const target = document.querySelector(targetId);
        if (target) {
          e.preventDefault();
          const navbarHeight = document.getElementById('main-navbar')?.offsetHeight || 0;
          const top = target.getBoundingClientRect().top + window.scrollY - navbarHeight - 20;
          window.scrollTo({ top, behavior: 'smooth' });
        }
      });
    });
  }
};

// ========================================================================
// INITIALIZE ALL MODULES
// ========================================================================
function initAllModules() {
  DarkMode.bindToggle();
  Navbar.init();
  MobileMenu.init();
  Counter.init();
  LazyImages.init();
  SmoothScroll.init();

  AOS.init({
    duration: 700,
    offset: 80,
    once: true,
    easing: 'ease-out-cubic',
  });
}

// ========================================================================
// SWUP INITIALIZATION
// ========================================================================
function initSwup() {
  const swup = new Swup({
    containers: ['#swup'],
    animationSelector: '[class*="transition-"]',
    plugins: [
      new SwupHeadPlugin({
        persistAssets: true,
      }),
    ],
  });

  // Re-initialize modules after page transition
  swup.hooks.on('page:view', () => {
    initAllModules();
  });

  return swup;
}

// ========================================================================
// DOM READY
// ========================================================================
document.addEventListener('DOMContentLoaded', () => {
  DarkMode.init();
  initAllModules();
  initSwup();
});


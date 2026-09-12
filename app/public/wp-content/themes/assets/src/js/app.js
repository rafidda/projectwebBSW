/* ========================================================================
   BPRS Wakalumi Theme — Main JavaScript
   Swup page transitions, AOS animations, dark mode, navbar, hero slider
   ======================================================================== */

import '../css/main.css';
import 'aos/dist/aos.css';
import Swup from 'swup';
import SwupHeadPlugin from '@swup/head-plugin';
import AOS from 'aos';

// ========================================================================
// PRELOADER
// ========================================================================
const Preloader = {
  init() {
    const preloader = document.getElementById('wakalumi-preloader');
    const liquid = document.getElementById('preloader-liquid');
    const bar = document.getElementById('preloader-bar');
    
    if (preloader && liquid && bar) {
      // Start liquid fill & bar progress
      setTimeout(() => {
        liquid.style.transform = 'translateY(0%)';
        bar.style.width = '100%';
      }, 50);

      // Hide after animation finishes (1.5s animation + 0.2s padding)
      setTimeout(() => {
        preloader.classList.add('opacity-0');
        setTimeout(() => {
          preloader.style.display = 'none';
          document.body.classList.remove('overflow-hidden');
        }, 700);
      }, 1700);
    }
  }
};

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
    const btn = document.getElementById('dark-mode-toggle');
    if (btn) {
      // Remove old listeners to prevent duplicates on swup transition
      const newBtn = btn.cloneNode(true);
      btn.parentNode.replaceChild(newBtn, btn);
      newBtn.addEventListener('click', () => this.toggle());
    }
  },

  toggle() {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem(this.STORAGE_KEY, isDark);
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
// HERO SLIDER — Auto-rotate carousel with fade-in-up text
// ========================================================================
const HeroSlider = {
  slides: [],
  dots: [],
  progress: null,
  currentIndex: 0,
  intervalId: null,
  progressId: null,
  INTERVAL_MS: 6000,  // 6 seconds per slide
  PROGRESS_INTERVAL: 30,  // ~30fps for progress bar
  isPaused: false,

  init() {
    const container = document.getElementById('hero-slider');
    if (!container) return;

    this.slides = container.querySelectorAll('.hero-slide');
    this.dots = container.querySelectorAll('.slider-dot');
    this.progress = container.querySelector('.slider-progress');

    if (this.slides.length <= 1) return;

    // Set first slide as active
    this.goToSlide(0, false);

    // Bind dot clicks
    this.dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        this.goToSlide(index);
        this.restartAutoplay();
      });
    });

    // Pause on hover
    container.addEventListener('mouseenter', () => {
      this.isPaused = true;
      this.stopAutoplay();
    });

    container.addEventListener('mouseleave', () => {
      this.isPaused = false;
      this.startAutoplay();
    });

    // Arrow clicks
    const prevBtn = container.querySelector('.slider-arrow.prev');
    const nextBtn = container.querySelector('.slider-arrow.next');
    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        this.prev();
        this.restartAutoplay();
      });
    }
    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        this.next();
        this.restartAutoplay();
      });
    }

    // Touch events for mobile swipe
    let touchStartX = 0;
    let touchEndX = 0;

    container.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    container.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      const diff = touchStartX - touchEndX;
      if (Math.abs(diff) > 50) {
        if (diff > 0) {
          this.next();
        } else {
          this.prev();
        }
        this.restartAutoplay();
      }
    }, { passive: true });

    // Start autoplay
    this.startAutoplay();
  },

  goToSlide(index, animate = true) {
    // Deactivate current slide
    this.slides.forEach(s => s.classList.remove('active'));
    this.dots.forEach(d => d.classList.remove('active'));

    // Activate new slide
    this.currentIndex = index;
    this.slides[index].classList.add('active');
    if (this.dots[index]) {
      this.dots[index].classList.add('active');
    }

    // Reset progress bar
    this.resetProgress();
  },

  next() {
    const nextIndex = (this.currentIndex + 1) % this.slides.length;
    this.goToSlide(nextIndex);
  },

  prev() {
    const prevIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
    this.goToSlide(prevIndex);
  },

  startAutoplay() {
    if (this.slides.length <= 1) return;
    this.stopAutoplay();

    // Progress bar animation
    let elapsed = 0;
    this.progressId = setInterval(() => {
      elapsed += this.PROGRESS_INTERVAL;
      const pct = (elapsed / this.INTERVAL_MS) * 100;
      if (this.progress) {
        this.progress.style.width = pct + '%';
        this.progress.style.transitionDuration = this.PROGRESS_INTERVAL + 'ms';
      }
    }, this.PROGRESS_INTERVAL);

    // Auto-advance
    this.intervalId = setInterval(() => {
      this.next();
    }, this.INTERVAL_MS);
  },

  stopAutoplay() {
    if (this.intervalId) {
      clearInterval(this.intervalId);
      this.intervalId = null;
    }
    if (this.progressId) {
      clearInterval(this.progressId);
      this.progressId = null;
    }
  },

  restartAutoplay() {
    if (!this.isPaused) {
      this.startAutoplay();
    }
  },

  resetProgress() {
    if (this.progress) {
      this.progress.style.transitionDuration = '0ms';
      this.progress.style.width = '0%';
    }
  }
};

// ========================================================================
// ANNOUNCEMENT BAR
// ========================================================================
const AnnouncementBar = {
  init() {
    const bar = document.getElementById('announcement-bar');
    const dismiss = document.getElementById('announcement-dismiss');
    if (!bar || !dismiss) return;

    dismiss.addEventListener('click', () => {
      bar.style.maxHeight = bar.scrollHeight + 'px';
      requestAnimationFrame(() => {
        bar.style.transition = 'max-height 0.3s ease-out, opacity 0.3s ease-out';
        bar.style.maxHeight = '0';
        bar.style.opacity = '0';
        bar.style.overflow = 'hidden';
      });
      // Store dismissal (reset on new announcement text)
      sessionStorage.setItem('wakalumi-announcement-dismissed', bar.dataset.hash || 'true');
    });

    // Check if already dismissed this session
    const dismissed = sessionStorage.getItem('wakalumi-announcement-dismissed');
    if (dismissed === (bar.dataset.hash || 'true')) {
      bar.style.display = 'none';
    }
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
  HeroSlider.init();
  AnnouncementBar.init();
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
  // Initial setup for the first page load
  DarkMode.init();
  Preloader.init();
  initAllModules();
  initSwup();
});

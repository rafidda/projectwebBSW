/* ========================================================================
   BPRS Wakalumi Theme — Main JavaScript
   Swup page transitions, AOS animations, dark mode, navbar, hero slider
   ======================================================================== */

import '../css/main.css';
import 'aos/dist/aos.css';
import Swup from 'swup';
import SwupHeadPlugin from '@swup/head-plugin';
import AOS from 'aos';
import * as pdfjsLib from 'pdfjs-dist';
import pdfWorker from 'pdfjs-dist/build/pdf.worker.min.js?url';

let cachedPdfWorkerBlobUrl = null;
async function getPdfWorkerSrc() {
  if (cachedPdfWorkerBlobUrl) return cachedPdfWorkerBlobUrl;
  try {
    const res = await fetch('/wp-content/themes/wakalumi-theme/assets/build/assets/pdf.worker.min.js');
    if (res.ok) {
      const blob = await res.blob();
      cachedPdfWorkerBlobUrl = URL.createObjectURL(blob);
      return cachedPdfWorkerBlobUrl;
    }
  } catch (e) {
    // fallback to relative path
  }
  return '/wp-content/themes/wakalumi-theme/assets/build/assets/pdf.worker.min.js';
}

try {
  pdfjsLib.GlobalWorkerOptions.workerSrc = '/wp-content/themes/wakalumi-theme/assets/build/assets/pdf.worker.min.js';
} catch (e) {
  // worker initialization fallback
}

// ========================================================================
// PRELOADER & PAGE TRANSITION LOADER
// ========================================================================
const Preloader = {
  el: null,
  liquid: null,
  bar: null,
  progressBar: null,
  transitionStartTime: 0,
  isTransitioning: false,

  init() {
    this.el = document.getElementById('wakalumi-preloader');
    this.liquid = document.getElementById('preloader-liquid');
    this.bar = document.getElementById('preloader-bar');
    this.progressBar = document.getElementById('swup-progress-bar');
    
    if (this.el && this.liquid && this.bar) {
      // Start initial liquid fill & bar progress
      setTimeout(() => {
        this.liquid.style.transform = 'translateY(0%)';
        this.bar.style.width = '100%';
      }, 50);

      // Hide after animation finishes (1.4s animation + 0.2s padding)
      setTimeout(() => {
        this.hide(600);
      }, 1400);
    }
  },

  startTransition() {
    if (!this.el || !this.liquid || !this.bar) {
      this.el = document.getElementById('wakalumi-preloader');
      this.liquid = document.getElementById('preloader-liquid');
      this.bar = document.getElementById('preloader-bar');
      this.progressBar = document.getElementById('swup-progress-bar');
    }
    if (!this.el) return;

    this.isTransitioning = true;
    this.transitionStartTime = Date.now();

    // Reset without transition
    this.liquid.style.transition = 'none';
    this.bar.style.transition = 'none';
    this.liquid.style.transform = 'translateY(100%)';
    this.bar.style.width = '0%';

    // Top progress bar
    if (this.progressBar) {
      this.progressBar.style.transition = 'none';
      this.progressBar.style.width = '0%';
      this.progressBar.style.opacity = '1';
    }

    // Display overlay
    this.el.style.display = 'flex';
    this.el.style.transition = 'opacity 200ms ease-out';
    void this.el.offsetWidth; // Force DOM reflow

    this.el.classList.remove('opacity-0');
    this.el.style.opacity = '1';

    // Swift smooth progress to ~70%
    this.liquid.style.transition = 'transform 400ms cubic-bezier(0.16, 1, 0.3, 1)';
    this.bar.style.transition = 'width 400ms cubic-bezier(0.16, 1, 0.3, 1)';
    if (this.progressBar) {
      this.progressBar.style.transition = 'width 400ms cubic-bezier(0.16, 1, 0.3, 1)';
    }

    requestAnimationFrame(() => {
      this.liquid.style.transform = 'translateY(25%)';
      this.bar.style.width = '70%';
      if (this.progressBar) {
        this.progressBar.style.width = '70%';
      }
    });
  },

  finishTransition(callback) {
    if (!this.isTransitioning && (!this.el || this.el.style.display === 'none')) {
      if (callback) callback();
      return;
    }

    const elapsed = Date.now() - this.transitionStartTime;
    const minDisplayTime = 380; // Smooth minimal duration so animation is visible and graceful
    const delay = Math.max(0, minDisplayTime - elapsed);

    setTimeout(() => {
      // Complete to 100%
      if (this.liquid) {
        this.liquid.style.transition = 'transform 250ms cubic-bezier(0.16, 1, 0.3, 1)';
        this.liquid.style.transform = 'translateY(0%)';
      }
      if (this.bar) {
        this.bar.style.transition = 'width 250ms cubic-bezier(0.16, 1, 0.3, 1)';
        this.bar.style.width = '100%';
      }
      if (this.progressBar) {
        this.progressBar.style.transition = 'width 250ms cubic-bezier(0.16, 1, 0.3, 1)';
        this.progressBar.style.width = '100%';
      }

      // Smooth fade out
      setTimeout(() => {
        this.hide(300);
        this.isTransitioning = false;
        if (this.progressBar) {
          this.progressBar.style.transition = 'opacity 300ms ease-out';
          this.progressBar.style.opacity = '0';
          setTimeout(() => {
            if (this.progressBar) this.progressBar.style.width = '0%';
          }, 350);
        }
        if (callback) callback();
      }, 200);
    }, delay);
  },

  hide(duration = 400) {
    if (!this.el) return;
    this.el.style.transition = `opacity ${duration}ms ease-out`;
    this.el.classList.add('opacity-0');
    this.el.style.opacity = '0';
    setTimeout(() => {
      this.el.style.display = 'none';
      document.body.classList.remove('overflow-hidden');
    }, duration);
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
    this.initMegaMenuHover();
    this.updateActiveState();
  },

  updateActiveState() {
    const rawPath = window.location.pathname;
    const currentPath = rawPath.replace(/\/$/, '') || '/';
    const isHome = currentPath === '/' || currentPath === '';

    // 1. Reset Desktop active states
    const desktopLinks = document.querySelectorAll('#main-navbar .nav-link');
    const dropdownItems = document.querySelectorAll('#main-navbar .dropdown a, #main-navbar .dropdown-item, #main-navbar .mega-link');

    desktopLinks.forEach(link => link.classList.remove('active'));
    dropdownItems.forEach(item => item.classList.remove('active'));

    // 2. Determine Desktop active
    if (isHome) {
      desktopLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (!href) return;
        try {
          const url = new URL(href, window.location.origin);
          const path = url.pathname.replace(/\/$/, '') || '/';
          if (path === '/') link.classList.add('active');
        } catch (e) {}
      });
    } else {
      let matchedDropdown = null;

      // Find matching dropdown child item across all dropdown links
      dropdownItems.forEach(item => {
        const href = item.getAttribute('href');
        if (!href || href === '#' || href.startsWith('javascript:')) return;
        try {
          const itemUrl = new URL(href, window.location.origin);
          const itemPath = itemUrl.pathname.replace(/\/$/, '') || '/';
          if (itemPath === currentPath) {
            item.classList.add('active');
            matchedDropdown = item.closest('.dropdown');
          }
        } catch (e) {}
      });

      if (matchedDropdown) {
        const trigger = matchedDropdown.querySelector('.dropdown-trigger');
        if (trigger) trigger.classList.add('active');
      } else {
        // Match top-level non-dropdown links
        let directMatchFound = false;
        desktopLinks.forEach(link => {
          if (link.classList.contains('dropdown-trigger')) return;
          const href = link.getAttribute('href');
          if (!href) return;
          try {
            const linkUrl = new URL(href, window.location.origin);
            const linkPath = linkUrl.pathname.replace(/\/$/, '') || '/';
            if (linkPath !== '/' && currentPath === linkPath) {
              link.classList.add('active');
              directMatchFound = true;
            }
          } catch (e) {}
        });

        // Fallback match by section prefix for parent dropdown triggers
        if (!directMatchFound) {
          if (currentPath.startsWith('/profil')) {
            const trigger = Array.from(desktopLinks).find(l => l.classList.contains('dropdown-trigger') && l.textContent.trim().toLowerCase().startsWith('profil'));
            if (trigger) trigger.classList.add('active');
          } else if (currentPath.startsWith('/produk') || currentPath.startsWith('/brosur') || currentPath === '/brosur') {
            const trigger = Array.from(desktopLinks).find(l => l.classList.contains('dropdown-trigger') && l.textContent.trim().toLowerCase().startsWith('produk'));
            if (trigger) trigger.classList.add('active');
          } else if (currentPath.startsWith('/informasi') || currentPath.startsWith('/berita')) {
            const trigger = Array.from(desktopLinks).find(l => l.classList.contains('dropdown-trigger') && l.textContent.trim().toLowerCase().startsWith('informasi'));
            if (trigger) trigger.classList.add('active');
          } else if (currentPath.startsWith('/kontak')) {
            const link = Array.from(desktopLinks).find(l => l.getAttribute('href') && l.getAttribute('href').includes('/kontak'));
            if (link) link.classList.add('active');
          }
        }
      }
    }

    // 3. Mobile Menu Synchronisation
    this.updateMobileActiveState(currentPath, isHome);
  },

  updateMobileActiveState(currentPath, isHome) {
    const mobilePanel = document.getElementById('mobile-menu-panel');
    if (!mobilePanel) return;

    const topLinks = mobilePanel.querySelectorAll('.mobile-nav-link');
    const triggers = mobilePanel.querySelectorAll('.mobile-dropdown-trigger');
    const sublinks = mobilePanel.querySelectorAll('.mobile-nav-sublink, .mobile-dropdown-content a');

    // Reset styles
    topLinks.forEach(link => {
      link.classList.remove('bg-primary-50', 'text-primary-700', 'font-semibold', 'dark:bg-primary-400/20', 'dark:text-primary-300');
      link.classList.add('text-slate-700', 'dark:text-slate-300');
    });

    triggers.forEach(t => {
      t.classList.remove('bg-primary-50/70', 'text-primary-700', 'font-semibold', 'dark:bg-primary-400/15', 'dark:text-primary-300');
      t.classList.add('text-slate-700', 'dark:text-slate-300');
    });

    sublinks.forEach(sub => {
      sub.classList.remove('text-primary-600', 'font-bold', 'dark:text-primary-400');
      sub.classList.add('text-slate-500', 'dark:text-slate-400');
    });

    if (isHome) {
      const homeLink = Array.from(topLinks).find(l => {
        try {
          return (new URL(l.href, window.location.origin)).pathname.replace(/\/$/, '') === '';
        } catch (e) { return false; }
      });
      if (homeLink) {
        homeLink.classList.remove('text-slate-700', 'dark:text-slate-300');
        homeLink.classList.add('bg-primary-50', 'text-primary-700', 'font-semibold', 'dark:bg-primary-400/20', 'dark:text-primary-300');
      }
      return;
    }

    let matchedGroup = null;
    sublinks.forEach(sub => {
      try {
        const subPath = (new URL(sub.href, window.location.origin)).pathname.replace(/\/$/, '') || '/';
        if (subPath === currentPath) {
          sub.classList.remove('text-slate-500', 'dark:text-slate-400');
          sub.classList.add('text-primary-600', 'font-bold', 'dark:text-primary-400');
          matchedGroup = sub.closest('.mobile-nav-group');
        }
      } catch (e) {}
    });

    if (!matchedGroup && (currentPath.startsWith('/brosur') || currentPath.startsWith('/produk'))) {
      const produkTrigger = Array.from(triggers).find(t => t.textContent.trim().toLowerCase().startsWith('produk'));
      if (produkTrigger) {
        matchedGroup = produkTrigger.closest('.mobile-nav-group');
      }
    }

    if (matchedGroup) {
      const trigger = matchedGroup.querySelector('.mobile-dropdown-trigger');
      if (trigger) {
        trigger.classList.remove('text-slate-700', 'dark:text-slate-300');
        trigger.classList.add('bg-primary-50/70', 'text-primary-700', 'font-semibold', 'dark:bg-primary-400/15', 'dark:text-primary-300');
      }
      const submenu = matchedGroup.querySelector('.mobile-dropdown-content');
      const icon = matchedGroup.querySelector('.dropdown-icon');
      if (submenu) submenu.classList.remove('hidden');
      if (icon) icon.classList.add('rotate-180');
    } else {
      topLinks.forEach(link => {
        try {
          const linkPath = (new URL(link.href, window.location.origin)).pathname.replace(/\/$/, '') || '/';
          if (linkPath !== '/' && currentPath.startsWith(linkPath)) {
            link.classList.remove('text-slate-700', 'dark:text-slate-300');
            link.classList.add('bg-primary-50', 'text-primary-700', 'font-semibold', 'dark:bg-primary-400/20', 'dark:text-primary-300');
          }
        } catch (e) {}
      });
    }
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
    // Smooth hover with grace period (so dropdown does not vanish when moving cursor down)
    document.querySelectorAll('.dropdown').forEach(dropdown => {
      let closeTimer = null;

      const openDropdown = () => {
        if (closeTimer) {
          clearTimeout(closeTimer);
          closeTimer = null;
        }
        document.querySelectorAll('.dropdown.open, .dropdown.is-open').forEach(d => {
          if (d !== dropdown) {
            d.classList.remove('open', 'is-open', 'hovered');
          }
        });
        dropdown.classList.add('is-open', 'hovered');
      };

      const scheduleClose = () => {
        if (closeTimer) clearTimeout(closeTimer);
        closeTimer = setTimeout(() => {
          dropdown.classList.remove('open', 'is-open', 'hovered');
        }, 220);
      };

      dropdown.addEventListener('mouseenter', openDropdown);
      dropdown.addEventListener('mouseleave', scheduleClose);

      // Keyboard accessibility (focus)
      dropdown.addEventListener('focusin', openDropdown);
      dropdown.addEventListener('focusout', (e) => {
        if (!dropdown.contains(e.relatedTarget)) {
          scheduleClose();
        }
      });
    });

    // Close dropdown immediately when any link inside is clicked
    document.querySelectorAll('.dropdown-menu a').forEach(link => {
      link.addEventListener('click', () => {
        document.querySelectorAll('.dropdown.open, .dropdown.is-open, .dropdown.hovered').forEach(d => {
          d.classList.remove('open', 'is-open', 'hovered');
        });
      });
    });

    // Close dropdown on click outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown.open, .dropdown.is-open, .dropdown.hovered').forEach(d => {
          d.classList.remove('open', 'is-open', 'hovered');
        });
      }
    });

    // Toggle dropdown on trigger click (touch / click support)
    document.querySelectorAll('.dropdown > .dropdown-trigger').forEach(trigger => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        const dropdown = trigger.closest('.dropdown');
        const isOpen = dropdown.classList.contains('open') || dropdown.classList.contains('is-open');

        document.querySelectorAll('.dropdown.open, .dropdown.is-open, .dropdown.hovered').forEach(d => {
          if (d !== dropdown) d.classList.remove('open', 'is-open', 'hovered');
        });

        if (isOpen) {
          dropdown.classList.remove('open', 'is-open', 'hovered');
        } else {
          dropdown.classList.add('open', 'is-open');
        }
      });
    });
  },

  initMegaMenuHover() {
    const previewContainer = document.getElementById('mega-preview-container');
    const previewImg       = document.getElementById('mega-preview-img');
    const previewBadge     = document.getElementById('mega-preview-badge');
    const previewTitle     = document.getElementById('mega-preview-title');
    const previewTagline   = document.getElementById('mega-preview-tagline');

    if (!previewContainer || !previewImg) return;
    if (previewContainer.dataset.hoverInitialized === 'true') return;
    previewContainer.dataset.hoverInitialized = 'true';

    const hoverItems = document.querySelectorAll('.product-hover-item');
    const megaMenu = previewContainer.closest('.dropdown-mega-menu');
    let hideTimer = null;

    const showPreview = (item) => {
      if (hideTimer) {
        clearTimeout(hideTimer);
        hideTimer = null;
      }
      const img = item.getAttribute('data-image');
      const name = item.getAttribute('data-name') || '';
      const badge = item.getAttribute('data-badge') || '';
      const tagline = item.getAttribute('data-tagline') || '';

      if (!img || img.trim() === '') {
        hidePreview();
        return;
      }

      previewImg.src = img;
      previewImg.alt = name;
      if (previewBadge) previewBadge.textContent = badge;
      if (previewTitle) previewTitle.textContent = name;
      if (previewTagline) previewTagline.textContent = tagline;

      previewContainer.classList.remove('hidden');
      // Trigger reflow for smooth transition
      void previewContainer.offsetWidth;
      previewContainer.classList.remove('opacity-0', 'scale-95');
      previewContainer.classList.add('opacity-100', 'scale-100');
    };

    const hidePreview = (immediate = false) => {
      if (hideTimer) clearTimeout(hideTimer);
      const delay = immediate ? 0 : 150;
      hideTimer = setTimeout(() => {
        previewContainer.classList.remove('opacity-100', 'scale-100');
        previewContainer.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
          if (previewContainer.classList.contains('opacity-0')) {
            previewContainer.classList.add('hidden');
          }
        }, 300);
      }, delay);
    };

    hoverItems.forEach(item => {
      item.addEventListener('mouseenter', () => showPreview(item));
      item.addEventListener('focus', () => showPreview(item));
      item.addEventListener('mouseleave', () => hidePreview(false));
      item.addEventListener('blur', () => hidePreview(false));
    });

    if (megaMenu) {
      megaMenu.addEventListener('mouseleave', () => hidePreview(true));
    }
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

    this.stopAutoplay();
    this.currentIndex = 0;
    this.slides = container.querySelectorAll('.hero-slide');
    this.dots = container.querySelectorAll('.slider-dot');
    this.progress = container.querySelector('.slider-progress');

    if (this.slides.length <= 1) {
      if (this.slides.length === 1) {
        this.slides[0].classList.add('active');
      }
      return;
    }

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
    }, { threshold: 0.15 });

    counters.forEach(el => observer.observe(el));
  },

  animate(el) {
    const target = parseInt(el.getAttribute('data-counter'), 10);
    if (isNaN(target)) return;

    const suffix = el.getAttribute('data-counter-suffix') || '';
    const prefix = el.getAttribute('data-counter-prefix') || '';
    const duration = 1800;
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
// INTERACTIVE SPOTLIGHT & 3D TILT EFFECT
// ========================================================================
const SpotlightTilt = {
  init() {
    const cards = document.querySelectorAll('.spotlight-card');
    cards.forEach(card => {
      card.onpointermove = (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);

        if (card.classList.contains('tilt-card') && window.innerWidth > 768) {
          const centerX = rect.width / 2;
          const centerY = rect.height / 2;
          const tiltX = ((centerY - y) / centerY) * 4;
          const tiltY = ((x - centerX) / centerX) * 4;
          card.style.transform = `perspective(1000px) rotateX(${tiltX.toFixed(2)}deg) rotateY(${tiltY.toFixed(2)}deg) translateY(-3px)`;
        }
      };

      card.onpointerleave = () => {
        if (card.classList.contains('tilt-card')) {
          card.style.transform = '';
        }
      };
    });
  }
};

// ========================================================================
// ONE-CLICK COPY TO CLIPBOARD WITH FEEDBACK
// ========================================================================
function showCopyToast(message = 'Berhasil disalin ke clipboard!') {
  let toast = document.getElementById('wkl-copy-toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'wkl-copy-toast';
    toast.className = 'copy-toast px-5 py-2.5 rounded-full bg-slate-900/95 text-white dark:bg-dark-surface/95 dark:text-teal-300 border border-teal-500/40 shadow-xl shadow-slate-950/30 backdrop-blur-md flex items-center gap-2.5 text-xs sm:text-sm font-semibold pointer-events-none select-none';
    document.body.appendChild(toast);
  }
  toast.innerHTML = `
    <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
    <span>${message}</span>
    <svg class="w-4 h-4 text-teal-400 ml-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
  `;
  toast.classList.add('show');
  clearTimeout(toast._timeout);
  toast._timeout = setTimeout(() => {
    toast.classList.remove('show');
  }, 2200);
}

const CopyClipboard = {
  init() {
    const copyButtons = document.querySelectorAll('.btn-copy-code');
    copyButtons.forEach(btn => {
      btn.onclick = async (e) => {
        e.preventDefault();
        const textToCopy = btn.getAttribute('data-copy');
        if (!textToCopy) return;

        const copySuccess = () => {
          const originalHTML = btn.innerHTML;
          const label = btn.querySelector('.copy-label');
          btn.classList.add('bg-teal-50', 'text-teal-700', 'border-teal-400', 'dark:bg-teal-900/40', 'dark:text-teal-300', 'scale-105');
          if (label) {
            label.textContent = 'Tersalin! ✓';
          } else {
            btn.innerHTML = '<span>Tersalin! ✓</span>';
          }

          showCopyToast('Nomor registrasi berhasil disalin!');

          setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('bg-teal-50', 'text-teal-700', 'border-teal-400', 'dark:bg-teal-900/40', 'dark:text-teal-300', 'scale-105');
          }, 2000);
        };

        try {
          if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(textToCopy);
            copySuccess();
          } else {
            const textarea = document.createElement('textarea');
            textarea.value = textToCopy;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            copySuccess();
          }
        } catch (err) {
          console.warn('Copy failed:', err);
        }
      };
    });
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
// EXECUTIVE PARALLAX: Stage & Floating Dock (Susunan Pengurus)
// ========================================================================
const ExecutiveParallax = {
  section: null,
  members: [],
  currentIndex: 0,
  isManualScrolling: false,
  scrollTimeout: null,

  init() {
    this.section = document.getElementById('executive-spotlight-section');
    const mobSection = document.getElementById('exec-mobile-showcase');
    const dataScript = document.getElementById('wkl-pengurus-data');

    if (!dataScript || (!this.section && !mobSection)) return;

    try {
      this.members = JSON.parse(dataScript.textContent);
    } catch (e) {
      console.warn('Failed to parse pengurus data:', e);
      return;
    }

    if (!this.members || this.members.length === 0) return;

    if (this.section) {
      this.initDesktop();
    }

    if (mobSection) {
      this.initMobile();
    }
  },

  initDesktop() {
    this.stage = document.getElementById('executive-sticky-stage');
    this.cards = Array.from(document.querySelectorAll('.exec-morph-card'));
    this.currentIndex = 0;
    this.currentMode = 'overview';

    // Apply initial overview state
    this.applyMorphLayout('overview', 0);
    this.bindDesktopEvents();
  },

  setStageMode(mode) {
    if (!this.stage) return;
    if (mode === 'overview') {
      this.stage.classList.add('is-overview');
      this.stage.classList.remove('is-spotlight');
    } else {
      this.stage.classList.remove('is-overview');
      this.stage.classList.add('is-spotlight');
    }
  },

  applyMorphLayout(mode, activeIndex = 0) {
    if (!this.cards || this.cards.length === 0) return;
    const n = this.cards.length;

    if (mode === 'overview') {
      this.currentMode = 'overview';
      this.setStageMode('overview');

      const gap = 2; // % gap between cards
      const w = (100 - gap * (n - 1)) / n;

      this.cards.forEach((card, i) => {
        card.style.left = `${i * (w + gap)}%`;
        card.style.top = '0%';
        card.style.width = `${w}%`;
        card.style.height = '100%';
        card.style.zIndex = '10';
        card.setAttribute('data-card-mode', 'overview');
      });
    } else {
      this.currentMode = 'spotlight';
      this.currentIndex = activeIndex;
      this.setStageMode('spotlight');

      const spotW = 63; // 63% width for active card
      const dockLeft = 66; // 66% left coordinate for dock
      const dockW = 34; // 34% width for dock cards
      const totalDock = Math.max(1, n - 1);
      const gapPx = 12; // 12px vertical gap in dock stack

      let dockIdx = 0;
      this.cards.forEach((card, i) => {
        if (i === activeIndex) {
          card.style.left = '0%';
          card.style.top = '0%';
          card.style.width = `${spotW}%`;
          card.style.height = '100%';
          card.style.zIndex = '25';
          card.setAttribute('data-card-mode', 'spotlight');
        } else {
          card.style.left = `${dockLeft}%`;
          card.style.width = `${dockW}%`;
          card.style.height = `calc((100% - ${(totalDock - 1) * gapPx}px) / ${totalDock})`;
          card.style.top = `calc((${dockIdx} * ((100% - ${(totalDock - 1) * gapPx}px) / ${totalDock})) + ${dockIdx * gapPx}px)`;
          card.style.zIndex = '10';
          card.setAttribute('data-card-mode', 'dock');
          dockIdx++;
        }
      });

      // Update counter
      const counter = document.getElementById('exec-current-counter');
      if (counter) {
        counter.textContent = String(activeIndex + 1).padStart(2, '0');
      }

      // Update Steppers
      const btnPrev = document.getElementById('exec-btn-prev');
      const btnNext = document.getElementById('exec-btn-next');
      if (btnPrev) btnPrev.disabled = activeIndex === 0;
      if (btnNext) btnNext.disabled = activeIndex === n - 1;

      // Update category pill active state
      const member = this.members[activeIndex];
      if (member) {
        const filterBtns = document.querySelectorAll('.exec-filter-btn');
        filterBtns.forEach((btn) => {
          const filter = btn.getAttribute('data-filter');
          if (filter === member.kategori) {
            btn.classList.add('active', 'bg-primary-600', 'text-white', 'shadow-sm');
            btn.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300');
          } else if (filter !== 'all') {
            btn.classList.remove('active', 'bg-primary-600', 'text-white', 'shadow-sm');
            btn.classList.add('bg-slate-100', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300');
          }
        });
      }
    }
  },

  scrollToMember(index) {
    if (!this.section) return;
    this.isManualScrolling = true;

    const sectionTop = this.section.getBoundingClientRect().top + window.scrollY;
    const stageHeight = this.section.offsetHeight - window.innerHeight;

    if (index < 0) {
      // Return to overview
      this.applyMorphLayout('overview', 0);
      window.scrollTo({ top: sectionTop, behavior: 'smooth' });
    } else {
      this.applyMorphLayout('spotlight', index);
      const targetProgress = 0.14 + (index / (this.members.length - 1 || 1)) * 0.82;
      const targetScroll = sectionTop + targetProgress * stageHeight;
      window.scrollTo({ top: targetScroll, behavior: 'smooth' });
    }

    clearTimeout(this.scrollTimeout);
    this.scrollTimeout = setTimeout(() => {
      this.isManualScrolling = false;
    }, 1050);
  },

  bindDesktopEvents() {
    const onScroll = () => {
      if (this.isManualScrolling || !this.section) return;

      const rect = this.section.getBoundingClientRect();
      const stageHeight = this.section.offsetHeight - window.innerHeight;
      if (stageHeight <= 0) return;

      const scrolled = -rect.top;
      if (scrolled >= 0 && scrolled <= stageHeight) {
        const progress = scrolled / stageHeight;

        // Phase 1: 0% - 12% = Overview Mode (comfortable top runway)
        if (progress < 0.12) {
          if (this.currentMode !== 'overview') {
            this.applyMorphLayout('overview', 0);
          }
        } else {
          // Phase 2: 12% - 100% = Spotlight Mode (Smooth Sequential Handoff)
          const spotlightProgress = (progress - 0.12) / 0.88;
          const targetIndex = Math.min(
            this.members.length - 1,
            Math.max(0, Math.floor(spotlightProgress * this.members.length))
          );
          if (this.currentMode !== 'spotlight' || targetIndex !== this.currentIndex) {
            this.applyMorphLayout('spotlight', targetIndex);
          }
        }
      } else if (scrolled < 0) {
        if (this.currentMode !== 'overview') {
          this.applyMorphLayout('overview', 0);
        }
      }
    };

    window.addEventListener('scroll', onScroll, { passive: true });

    // Morph Cards Click (Works in both Overview and Dock states)
    this.cards.forEach((card) => {
      card.addEventListener('click', (e) => {
        if (e.target.closest('a, button, input, textarea')) return;

        const idx = parseInt(card.getAttribute('data-index'), 10);
        if (this.currentMode === 'overview') {
          this.scrollToMember(idx);
        } else if (this.currentMode === 'spotlight') {
          if (card.getAttribute('data-card-mode') === 'dock') {
            this.scrollToMember(idx);
          }
        }
      });
    });

    // Back to overview button
    const btnBackOverview = document.getElementById('exec-btn-back-overview');
    if (btnBackOverview) {
      btnBackOverview.addEventListener('click', () => {
        this.scrollToMember(-1);
      });
    }

    // Stepper buttons
    const btnPrev = document.getElementById('exec-btn-prev');
    const btnNext = document.getElementById('exec-btn-next');
    if (btnPrev) {
      btnPrev.addEventListener('click', () => {
        if (this.currentIndex > 0) {
          this.scrollToMember(this.currentIndex - 1);
        }
      });
    }
    if (btnNext) {
      btnNext.addEventListener('click', () => {
        if (this.currentIndex < this.members.length - 1) {
          this.scrollToMember(this.currentIndex + 1);
        }
      });
    }

    // Category filter pills
    const filterBtns = document.querySelectorAll('.exec-filter-btn');
    filterBtns.forEach((btn) => {
      btn.addEventListener('click', () => {
        filterBtns.forEach((b) => {
          b.classList.remove('active', 'bg-primary-600', 'text-white', 'shadow-sm');
          b.classList.add('bg-slate-100', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300');
        });
        btn.classList.add('active', 'bg-primary-600', 'text-white', 'shadow-sm');
        btn.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300');

        const filter = btn.getAttribute('data-filter');
        if (filter === 'all') {
          this.scrollToMember(0);
        } else {
          const foundIdx = this.members.findIndex((m) => m.kategori === filter);
          if (foundIdx !== -1) {
            this.scrollToMember(foundIdx);
          }
        }
      });
    });
  },

  initMobile() {
    let mobIndex = 0;

    const updateMob = (idx) => {
      if (idx < 0 || idx >= this.members.length) return;
      mobIndex = idx;
      const m = this.members[idx];

      const img = document.getElementById('mob-exec-img');
      const name = document.getElementById('mob-exec-name');
      const role = document.getElementById('mob-exec-role');
      const kat = document.getElementById('mob-exec-kategori');
      const karir = document.getElementById('mob-exec-karir');
      const pend = document.getElementById('mob-exec-pendidikan');
      const sertif = document.getElementById('mob-exec-sertifikasi');
      const quote = document.getElementById('mob-exec-quote');
      const quoteWrap = document.getElementById('mob-exec-quote-wrap');
      const counter = document.getElementById('mob-exec-counter');
      const card = document.getElementById('mob-exec-card');

      if (card) {
        card.classList.add('exec-transitioning');
        setTimeout(() => card.classList.remove('exec-transitioning'), 300);
      }

      if (img) img.src = m.foto || '';
      if (name) name.textContent = m.nama || '';
      if (role) role.textContent = m.jabatan || '';
      if (kat) kat.textContent = m.kategori || '';
      if (karir) karir.textContent = m.riwayat_karir || '';
      if (pend) pend.textContent = m.pendidikan || '—';
      if (sertif) sertif.textContent = m.sertifikasi || '—';

      if (quote && quoteWrap) {
        if (m.kutipan && m.kutipan.trim() !== '') {
          quote.textContent = `"${m.kutipan}"`;
          quoteWrap.style.display = '';
        } else {
          quoteWrap.style.display = 'none';
        }
      }

      if (counter) {
        counter.textContent = `${idx + 1} dari ${this.members.length}`;
      }

      const pills = document.querySelectorAll('.mob-exec-pill');
      pills.forEach((p) => {
        const pIdx = parseInt(p.getAttribute('data-mob-index'), 10);
        if (pIdx === idx) {
          p.className = 'mob-exec-pill shrink-0 px-3 py-1.5 rounded-full text-xs font-semibold transition-all bg-primary-600 text-white shadow-sm';
          p.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        } else {
          p.className = 'mob-exec-pill shrink-0 px-3 py-1.5 rounded-full text-xs font-semibold transition-all bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400';
        }
      });

      const prev = document.getElementById('mob-btn-prev');
      const next = document.getElementById('mob-btn-next');
      if (prev) prev.disabled = idx === 0;
      if (next) next.disabled = idx === this.members.length - 1;
    };

    document.querySelectorAll('.mob-exec-pill').forEach((pill) => {
      pill.addEventListener('click', () => {
        const idx = parseInt(pill.getAttribute('data-mob-index'), 10);
        updateMob(idx);
      });
    });

    const prev = document.getElementById('mob-btn-prev');
    const next = document.getElementById('mob-btn-next');
    if (prev) {
      prev.addEventListener('click', () => {
        if (mobIndex > 0) updateMob(mobIndex - 1);
      });
    }
    if (next) {
      next.addEventListener('click', () => {
        if (mobIndex < this.members.length - 1) updateMob(mobIndex + 1);
      });
    }

    const card = document.getElementById('mob-exec-card');
    if (card) {
      let touchStartX = 0;
      let touchEndX = 0;
      card.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      card.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 45) {
          if (diff > 0 && mobIndex < this.members.length - 1) {
            updateMob(mobIndex + 1);
          } else if (diff < 0 && mobIndex > 0) {
            updateMob(mobIndex - 1);
          }
        }
      }, { passive: true });
    }
  }
};

// ========================================================================
// ORG CHART LIGHTBOX (Susunan Pengurus page)
// ========================================================================
const OrgChartLightbox = {
  init() {
    const container = document.getElementById('orgchart-container');
    if (!container) return;

    container.addEventListener('click', () => {
      const img = container.querySelector('img');
      if (!img) return;

      // Create lightbox overlay
      const overlay = document.createElement('div');
      overlay.className = 'fixed inset-0 z-[9999] flex items-center justify-center p-4 md:p-8 cursor-zoom-out';
      overlay.style.cssText = 'background: rgba(0,0,0,0.9); backdrop-filter: blur(12px); animation: fadeIn 0.3s ease;';
      
      const lightboxImg = document.createElement('img');
      lightboxImg.src = img.src;
      lightboxImg.alt = img.alt;
      lightboxImg.className = 'max-w-full max-h-full object-contain rounded-lg shadow-2xl';
      lightboxImg.style.cssText = 'animation: scaleIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);';

      // Close button
      const closeBtn = document.createElement('button');
      closeBtn.className = 'absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors';
      closeBtn.innerHTML = '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';
      
      overlay.appendChild(lightboxImg);
      overlay.appendChild(closeBtn);
      document.body.appendChild(overlay);
      document.body.style.overflow = 'hidden';

      const closeLightbox = () => {
        overlay.style.animation = 'fadeOut 0.2s ease forwards';
        setTimeout(() => {
          overlay.remove();
          document.body.style.overflow = '';
        }, 200);
      };

      overlay.addEventListener('click', (e) => {
        if (e.target === overlay || e.target === closeBtn || closeBtn.contains(e.target)) {
          closeLightbox();
        }
      });

      document.addEventListener('keydown', function escHandler(e) {
        if (e.key === 'Escape') {
          closeLightbox();
          document.removeEventListener('keydown', escHandler);
        }
      });
    });
  }
};

// ========================================================================
// SMOOTH SCROLL for Anchor Links
// ========================================================================
// GLOBAL ACCURATE SMOOTH SCROLL HELPER
// ========================================================================
function performSmoothScrollToTarget(targetSelector, withPulse = true) {
  if (!targetSelector || targetSelector === '#') return;
  try {
    let selector = targetSelector;
    if (!selector.startsWith('#')) selector = '#' + selector;
    const targetEl = document.querySelector(selector);
    if (!targetEl) return;

    const navbar = document.getElementById('main-navbar');
    const navbarHeight = navbar ? navbar.offsetHeight : 70;
    const rect = targetEl.getBoundingClientRect();
    const top = rect.top + window.scrollY - navbarHeight - 20;

    window.scrollTo({
      top: Math.max(0, top),
      behavior: 'smooth'
    });

    if (withPulse) {
      targetEl.classList.remove('ring-4', 'ring-teal-500/80', 'ring-offset-4', 'ring-offset-white', 'dark:ring-offset-slate-900');
      void targetEl.offsetWidth; // force DOM reflow
      targetEl.classList.add('ring-4', 'ring-teal-500/80', 'ring-offset-4', 'ring-offset-white', 'dark:ring-offset-slate-900', 'transition-all', 'duration-500');
      setTimeout(() => {
        targetEl.classList.remove('ring-4', 'ring-teal-500/80', 'ring-offset-4', 'ring-offset-white', 'dark:ring-offset-slate-900');
      }, 2500);
    }
  } catch (e) {
    console.warn('Scroll to target failed:', e);
  }
}
window.performSmoothScrollToTarget = performSmoothScrollToTarget;
window.wklScrollToSection = performSmoothScrollToTarget;

const SmoothScroll = {
  initialized: false,

  init() {
    if (this.initialized) return;
    this.initialized = true;

    // Universal delegated click handler for anchor links
    document.addEventListener('click', (e) => {
      const link = e.target.closest('a');
      if (!link) return;
      const hrefAttr = link.getAttribute('href');
      if (!hrefAttr || hrefAttr === '#' || hrefAttr.startsWith('javascript:')) return;

      try {
        const url = new URL(link.href, window.location.origin);
        const linkPath = url.pathname.replace(/\/$/, '') || '/';
        const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
        const hash = url.hash;

        // If link points to an anchor on the CURRENT page
        if (hash && hash.length > 1 && (linkPath === currentPath || hrefAttr.startsWith('#'))) {
          const targetEl = document.querySelector(hash);
          if (targetEl) {
            e.preventDefault();

            // Close desktop dropdowns immediately
            document.querySelectorAll('.dropdown.open, .dropdown.is-open, .dropdown.hovered').forEach(d => {
              d.classList.remove('open', 'is-open', 'hovered');
            });

            // Close mobile menu if open
            const overlay = document.getElementById('mobile-menu-overlay');
            const panel = document.getElementById('mobile-menu-panel');
            if (panel && panel.classList.contains('active') && typeof MobileMenu !== 'undefined') {
              MobileMenu.close(overlay, panel);
            }

            performSmoothScrollToTarget(hash, true);

            if (history.pushState) {
              history.pushState(null, null, hash);
            }
          }
        }
      } catch (err) {}
    }, true);

    // Initial page load with hash in URL
    if (window.location.hash) {
      setTimeout(() => {
        performSmoothScrollToTarget(window.location.hash, true);
      }, 400);
    }
  }
};

// ========================================================================
// INSTAGRAM FEED SLIDER
// ========================================================================
const InstagramSlider = {
  init() {
    const track = document.getElementById('ig-scroll-track');
    const prevBtn = document.getElementById('ig-scroll-prev');
    const nextBtn = document.getElementById('ig-scroll-next');
    if (!track) return;

    // Trigger Instagram Embed API parsing for new blockquotes
    this.processEmbeds();

    if (!prevBtn || !nextBtn) return;

    const scrollAmount = () => (window.innerWidth < 768 ? Math.min(340, window.innerWidth * 0.88) + 24 : 374);

    const updateArrowVisibility = () => {
      const maxScroll = track.scrollWidth - track.clientWidth - 10;
      if (track.scrollLeft <= 10) {
        prevBtn.style.opacity = '0.3';
        prevBtn.style.pointerEvents = 'none';
      } else {
        prevBtn.style.opacity = '1';
        prevBtn.style.pointerEvents = 'auto';
      }

      if (track.scrollLeft >= maxScroll) {
        nextBtn.style.opacity = '0.3';
        nextBtn.style.pointerEvents = 'none';
      } else {
        nextBtn.style.opacity = '1';
        nextBtn.style.pointerEvents = 'auto';
      }
    };

    prevBtn.onclick = (e) => {
      e.preventDefault();
      track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
    };

    nextBtn.onclick = (e) => {
      e.preventDefault();
      track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
    };

    track.addEventListener('scroll', updateArrowVisibility, { passive: true });
    updateArrowVisibility();
  },

  processEmbeds() {
    const blockquotes = document.querySelectorAll('blockquote.instagram-media');
    if (!blockquotes.length) return;

    if (window.instgrm && window.instgrm.Embeds && typeof window.instgrm.Embeds.process === 'function') {
      window.instgrm.Embeds.process();
    } else {
      let script = document.querySelector('script[src*="instagram.com/embed.js"]');
      if (!script) {
        script = document.createElement('script');
        script.src = '//www.instagram.com/embed.js';
        script.async = true;
        script.defer = true;
        script.onload = () => {
          if (window.instgrm && window.instgrm.Embeds && typeof window.instgrm.Embeds.process === 'function') {
            window.instgrm.Embeds.process();
          }
        };
        document.body.appendChild(script);
      } else {
        setTimeout(() => {
          if (window.instgrm && window.instgrm.Embeds && typeof window.instgrm.Embeds.process === 'function') {
            window.instgrm.Embeds.process();
          }
        }, 300);
      }
    }
  }
};

// ========================================================================
// JARINGAN KANTOR INTERACTIONS (Filter, Copy Address, & Map Modal Lightbox)
// ========================================================================
const KantorModule = {
  init() {
    this.initFilter();
    this.initCopyAddress();
    this.initMapModal();
  },

  initFilter() {
    const filterGroup = document.getElementById('kantor-filter-group');
    if (!filterGroup) return;

    const buttons = filterGroup.querySelectorAll('.kantor-filter-btn');
    const cards = document.querySelectorAll('.kantor-card');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.getAttribute('data-filter');

        // Update active buttons styling
        buttons.forEach(b => {
          b.classList.remove('active', 'bg-primary-600', 'text-white', 'shadow-sm');
          b.classList.add('text-slate-600', 'dark:text-slate-300');
        });
        btn.classList.add('active', 'bg-primary-600', 'text-white', 'shadow-sm');
        btn.classList.remove('text-slate-600', 'dark:text-slate-300');

        // Filter cards smoothly
        cards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            card.style.display = 'flex';
            requestAnimationFrame(() => {
              card.style.opacity = '1';
              card.style.transform = 'none';
            });
          } else {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.96)';
            setTimeout(() => {
              if (card.style.opacity === '0') {
                card.style.display = 'none';
              }
            }, 220);
          }
        });
      });
    });
  },

  initCopyAddress() {
    document.querySelectorAll('.copy-kantor-alamat-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const textToCopy = btn.getAttribute('data-copy');
        if (!textToCopy) return;

        const label = btn.querySelector('.btn-copy-label');
        const origText = label ? label.textContent : '';

        const onSuccess = () => {
          if (label) label.textContent = 'Tersalin!';
          btn.classList.add('text-teal-600', 'font-extrabold');
          showCopyToast('Alamat kantor berhasil disalin!');
          setTimeout(() => {
            if (label) label.textContent = origText;
            btn.classList.remove('text-teal-600', 'font-extrabold');
          }, 2000);
        };

        if (navigator.clipboard && window.isSecureContext) {
          navigator.clipboard.writeText(textToCopy).then(onSuccess).catch(() => {
            fallbackCopy(textToCopy, onSuccess);
          });
        } else {
          fallbackCopy(textToCopy, onSuccess);
        }
      });
    });

    function fallbackCopy(text, cb) {
      const ta = document.createElement('textarea');
      ta.value = text;
      ta.style.position = 'fixed';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.focus();
      ta.select();
      try {
        document.execCommand('copy');
        cb();
      } catch (err) {}
      ta.remove();
    }
  },

  initMapModal() {
    const modal = document.getElementById('kantor-map-modal');
    if (!modal) return;

    const backdrop = document.getElementById('kantor-map-backdrop');
    const container = document.getElementById('kantor-map-container');
    const iframe = document.getElementById('kantor-map-iframe');
    const loading = document.getElementById('map-modal-loading');
    const titleEl = document.getElementById('map-modal-title');
    const tipeEl = document.getElementById('map-modal-tipe');
    const alamatEl = document.getElementById('map-modal-alamat');
    const extLink = document.getElementById('map-modal-external-link');
    const gmapsBtn = document.getElementById('map-modal-gmaps-btn');
    const closeBtn = document.getElementById('kantor-map-close-btn');
    const footerClose = document.getElementById('kantor-map-footer-close');

    const openModal = (btn) => {
      const title = btn.getAttribute('data-title') || 'Peta Kantor';
      const tipe = btn.getAttribute('data-tipe') || 'Kantor Operasional';
      const alamat = btn.getAttribute('data-alamat') || '';
      const gmaps = btn.getAttribute('data-gmaps') || '#';
      const query = btn.getAttribute('data-query') || encodeURIComponent(title + ' ' + alamat);

      if (titleEl) titleEl.textContent = title;
      if (tipeEl) tipeEl.textContent = tipe;
      if (alamatEl) alamatEl.textContent = alamat;
      if (extLink) extLink.href = gmaps;
      if (gmapsBtn) gmapsBtn.href = gmaps;

      // Show loader
      if (loading) {
        loading.style.display = 'flex';
        loading.style.opacity = '1';
      }

      // Set embed src
      if (iframe) {
        iframe.onload = () => {
          if (loading) {
            loading.style.opacity = '0';
            setTimeout(() => { loading.style.display = 'none'; }, 300);
          }
        };
        // Standard clean Google Maps Embed without API key
        iframe.src = `https://maps.google.com/maps?q=${query}&t=&z=15&ie=UTF8&iwloc=&output=embed`;
      }

      // Open Modal Animation
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';

      requestAnimationFrame(() => {
        if (backdrop) {
          backdrop.classList.remove('opacity-0');
          backdrop.classList.add('opacity-100');
        }
        if (container) {
          container.classList.remove('scale-95', 'opacity-0');
          container.classList.add('scale-100', 'opacity-100');
        }
      });
    };

    const closeModal = () => {
      if (backdrop) {
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
      }
      if (container) {
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
      }

      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        if (iframe) iframe.src = 'about:blank';
      }, 250);
    };

    // Attach open triggers
    document.querySelectorAll('.open-map-modal-btn').forEach(btn => {
      btn.addEventListener('click', () => openModal(btn));
    });

    // Close triggers
    closeBtn?.addEventListener('click', closeModal);
    footerClose?.addEventListener('click', closeModal);
    backdrop?.addEventListener('click', closeModal);

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });
  }
};

// ========================================================================
// SAVINGS CALCULATOR MODULE (TABUNGAN SYARIAH)
// ========================================================================
const SavingsCalculator = {
  init() {
    const productSelect = document.getElementById('wkl-calc-product');
    const targetRange   = document.getElementById('wkl-calc-target-range');
    const targetDisplay = document.getElementById('wkl-calc-target-display');
    const monthsRange   = document.getElementById('wkl-calc-months-range');
    const monthsDisplay = document.getElementById('wkl-calc-months-display');
    const monthlyResult = document.getElementById('wkl-calc-result-monthly');
    const waBtn         = document.getElementById('wkl-calc-wa-btn');
    const presetBtns    = document.querySelectorAll('.wkl-calc-preset-btn');
    const gotoCalcBtns  = document.querySelectorAll('.wkl-goto-calc');

    if (!targetRange || !monthsRange || !monthlyResult) return;

    const formatRupiah = (num) => {
      return 'Rp ' + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    };

    const selectProductByName = (prodName) => {
      if (!productSelect || !prodName) return;
      const cleanTarget = prodName.trim().toLowerCase();
      for (let i = 0; i < productSelect.options.length; i++) {
        const val = productSelect.options[i].value.trim().toLowerCase();
        if (val === cleanTarget || val.includes(cleanTarget) || cleanTarget.includes(val)) {
          productSelect.selectedIndex = i;
          break;
        }
      }
    };

    const calculateSavings = () => {
      const targetVal = parseInt(targetRange.value, 10) || 0;
      const monthsVal = parseInt(monthsRange.value, 10) || 12;
      const selectedProduct = productSelect ? productSelect.value : 'Tabungan Syariah';

      if (targetDisplay) targetDisplay.textContent = formatRupiah(targetVal);

      const years = (monthsVal / 12);
      const yearText = years >= 1 ? ` (${years} Tahun)` : '';
      if (monthsDisplay) monthsDisplay.textContent = `${monthsVal} Bulan${yearText}`;

      const monthlyVal = Math.ceil(targetVal / monthsVal);
      monthlyResult.textContent = formatRupiah(monthlyVal);

      if (waBtn) {
        const waNumber = waBtn.getAttribute('data-phone') || '6281517380388';
        const msg = `Halo BPRS Wakalumi, saya tertarik membuka ${selectedProduct} dengan target ${formatRupiah(targetVal)} selama ${monthsVal} bulan (estimasi sisihan ${formatRupiah(monthlyVal)}/bln). Mohon panduannya.`;
        waBtn.href = `https://wa.me/${waNumber}?text=${encodeURIComponent(msg)}`;
      }
    };

    targetRange.addEventListener('input', calculateSavings);
    monthsRange.addEventListener('input', calculateSavings);
    if (productSelect) {
      productSelect.addEventListener('change', calculateSavings);
    }

    presetBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const val = parseInt(this.getAttribute('data-val'), 10);
        const months = parseInt(this.getAttribute('data-months'), 10);
        const prod = this.getAttribute('data-prod');

        if (targetRange && val) {
          targetRange.value = val;
        }
        if (monthsRange && months) {
          monthsRange.value = months;
        }
        if (prod) {
          selectProductByName(prod);
        }

        presetBtns.forEach(b => {
          b.classList.remove('border-teal-500/50', 'text-teal-300', 'bg-teal-950/60');
          b.classList.add('border-slate-700', 'text-slate-200');
        });
        this.classList.remove('border-slate-700', 'text-slate-200');
        this.classList.add('border-teal-500/50', 'text-teal-300', 'bg-teal-950/60');

        calculateSavings();
      });
    });

    gotoCalcBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        const targetProd = this.getAttribute('data-calc-select');
        if (targetProd) {
          selectProductByName(targetProd);
          calculateSavings();
        }
      });
    });

    calculateSavings();
  }
};

// ========================================================================
// VIDEO POPUP MODAL (BERANDA)
// ========================================================================
const VideoModal = {
  _escBound: false,

  init() {
    const openBtn = document.getElementById('open-video-modal');
    const closeBtn = document.getElementById('close-video-modal');
    const modal = document.getElementById('video-modal');
    const iframe = document.getElementById('video-modal-iframe');

    if (!openBtn || !modal || !iframe) return;

    const closeModal = () => {
      iframe.src = '';
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    };

    openBtn.onclick = (e) => {
      e.preventDefault();
      const src = iframe.getAttribute('data-src');
      if (src && iframe.src !== src) {
        iframe.src = src;
      }
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    };

    if (closeBtn) closeBtn.onclick = closeModal;

    modal.onclick = (e) => {
      if (e.target === modal) closeModal();
    };

    if (!this._escBound) {
      this._escBound = true;
      document.addEventListener('keydown', (e) => {
        const curModal = document.getElementById('video-modal');
        const curIframe = document.getElementById('video-modal-iframe');
        if (e.key === 'Escape' && curModal && !curModal.classList.contains('hidden')) {
          if (curIframe) curIframe.src = '';
          curModal.classList.add('hidden');
          curModal.classList.remove('flex');
        }
      });
    }
  }
};

// ========================================================================
// DEPOSITO MUDHARABAH MODULE (TABS, KALKULATOR, NISBAH OBSERVER)
// ========================================================================
const DepositoPage = {
  init() {
    const nominalRange = document.getElementById('wkl-dep-nominal-range');
    const btnInd = document.getElementById('tab-btn-ind');
    const nisbahTableWrap = document.querySelector('.wkl-nisbah-table-wrap');

    // If none of the deposito elements exist on this page, exit immediately
    if (!nominalRange && !btnInd && !nisbahTableWrap) return;

    this.initTabs();
    this.initNisbahAnimation();
    this.initCalculator();
  },

  initTabs() {
    const btnInd = document.getElementById('tab-btn-ind');
    const btnLem = document.getElementById('tab-btn-lem');
    const cntInd = document.getElementById('content-ind');
    const cntLem = document.getElementById('content-lem');

    if (!btnInd || !btnLem || !cntInd || !cntLem) return;

    btnInd.onclick = () => {
      btnInd.className = 'px-6 py-2.5 rounded-full bg-teal-600 text-white font-bold text-xs sm:text-sm shadow-md transition-all inline-flex items-center gap-2';
      btnLem.className = 'px-6 py-2.5 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 shadow-sm transition-all inline-flex items-center gap-2';
      cntInd.classList.remove('hidden');
      cntLem.classList.add('hidden');
    };

    btnLem.onclick = () => {
      btnLem.className = 'px-6 py-2.5 rounded-full bg-teal-600 text-white font-bold text-xs sm:text-sm shadow-md transition-all inline-flex items-center gap-2';
      btnInd.className = 'px-6 py-2.5 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 shadow-sm transition-all inline-flex items-center gap-2';
      cntLem.classList.remove('hidden');
      cntInd.classList.add('hidden');
    };
  },

  initNisbahAnimation() {
    const nisbahTableWrap = document.querySelector('.wkl-nisbah-table-wrap');
    if (!nisbahTableWrap) return;

    let hasAnimatedNisbah = false;

    const triggerNisbahAnimation = () => {
      if (hasAnimatedNisbah) return;
      hasAnimatedNisbah = true;

      // Animate Progress Bars
      const ratioBars = nisbahTableWrap.querySelectorAll('.wkl-ratio-bar, .wkl-ratio-bar-bank');
      ratioBars.forEach((bar) => {
        const targetWidth = bar.getAttribute('data-width');
        if (targetWidth) {
          setTimeout(() => {
            bar.style.width = targetWidth;
          }, 120);
        }
      });

      // Animate Numbers / Counters
      const counters = nisbahTableWrap.querySelectorAll('.wkl-counter');
      counters.forEach((el) => {
        const target = parseFloat(el.getAttribute('data-target')) || 0;
        const decimals = parseInt(el.getAttribute('data-decimals'), 10) || 0;
        const suffix = el.getAttribute('data-suffix') || '';
        const duration = 1200;
        let startTime = null;

        const step = (timestamp) => {
          if (!startTime) startTime = timestamp;
          const progress = Math.min((timestamp - startTime) / duration, 1);
          // Smooth cubic ease-out
          const ease = 1 - Math.pow(1 - progress, 3);
          const current = ease * target;
          el.textContent = (decimals > 0 ? current.toFixed(decimals) : Math.round(current)) + suffix;
          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            el.textContent = (decimals > 0 ? target.toFixed(decimals) : Math.round(target)) + suffix;
          }
        };
        requestAnimationFrame(step);
      });
    };

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            triggerNisbahAnimation();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15 });
      observer.observe(nisbahTableWrap);
    } else {
      triggerNisbahAnimation();
    }
  },

  initCalculator() {
    const nominalRange  = document.getElementById('wkl-dep-nominal-range');
    const nominalInput  = document.getElementById('wkl-dep-nominal-input');
    const resultMonthly = document.getElementById('wkl-dep-result-monthly');
    const resultTotal   = document.getElementById('wkl-dep-result-total');
    const depWaBtn      = document.getElementById('wkl-dep-wa-btn');
    const presetBtns    = document.querySelectorAll('.wkl-dep-preset-btn');
    const tenorBtns     = document.querySelectorAll('.wkl-dep-tenor-btn');
    const rateLabel     = document.getElementById('wkl-dep-active-tenor-label');

    if (!nominalRange || !resultMonthly || !resultTotal) return;

    let waNumber = '6281517380388';
    if (depWaBtn) {
      waNumber = depWaBtn.getAttribute('data-phone') || waNumber;
    }

    const activeTenorBtn = document.querySelector('.wkl-dep-tenor-btn.active');
    let currentMonths = activeTenorBtn ? parseInt(activeTenorBtn.getAttribute('data-months'), 10) : 12;
    let currentRate   = activeTenorBtn ? parseFloat(activeTenorBtn.getAttribute('data-rate')) : 4.23;
    let currentEquiv  = activeTenorBtn ? activeTenorBtn.getAttribute('data-equiv') : '4.23%';

    let minSim = parseInt(nominalRange.getAttribute('min'), 10) || 500000;
    let maxSim = parseInt(nominalRange.getAttribute('max'), 10) || 2000000000;
    let defaultSim = parseInt(nominalRange.value, 10) || 50000000;
    if (minSim <= 0) minSim = 500000;
    if (maxSim <= 0) maxSim = 2000000000;
    if (defaultSim <= 0) defaultSim = 50000000;

    const formatRupiah = (num) => {
      return 'Rp ' + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    };

    const parseNominal = (str) => {
      const clean = String(str).replace(/[^0-9]/g, '');
      const val = parseInt(clean, 10);
      return isNaN(val) ? 0 : val;
    };

    const calculateDeposit = () => {
      let nominal = parseNominal(nominalInput ? nominalInput.value : nominalRange.value);
      if (nominal < minSim) {
        nominal = minSim;
      }

      if (nominalRange) {
        if (nominal <= maxSim) {
          nominalRange.value = nominal;
        } else {
          nominalRange.value = maxSim;
        }
      }

      const annualReturn  = nominal * (currentRate / 100);
      const monthlyReturn = Math.round(annualReturn / 12);
      const totalReturn   = Math.round(monthlyReturn * currentMonths);

      resultMonthly.textContent = formatRupiah(monthlyReturn);
      resultTotal.textContent   = formatRupiah(totalReturn);

      if (rateLabel) {
        rateLabel.textContent = `${currentMonths} Bulan (Eqv. ${currentEquiv})`;
      }

      if (depWaBtn) {
        const msg = `Halo BPRS Wakalumi, saya berminat membuka Deposito Mudharabah sebesar ${formatRupiah(nominal)} dengan tenor ${currentMonths} bulan (indikasi eqv. ${currentEquiv}, estimasi bagi hasil ${formatRupiah(monthlyReturn)}/bln). Mohon panduan pembukaannya.`;
        depWaBtn.href = `https://wa.me/${waNumber}?text=${encodeURIComponent(msg)}`;
      }
    };

    nominalRange.oninput = function() {
      const val = parseInt(this.value, 10) || defaultSim;
      if (nominalInput) {
        nominalInput.value = formatRupiah(val);
      }
      calculateDeposit();
    };

    if (nominalInput) {
      nominalInput.oninput = function() {
        const num = parseNominal(this.value);
        if (num > 0) {
          if (nominalRange) {
            if (num <= maxSim) {
              nominalRange.value = num;
            } else {
              nominalRange.value = maxSim;
            }
          }
          calculateDeposit();
        }
      };

      nominalInput.onblur = function() {
        let num = parseNominal(this.value);
        if (num < minSim) num = defaultSim;
        this.value = formatRupiah(num);
        calculateDeposit();
      };
    }

    presetBtns.forEach((btn) => {
      btn.onclick = function() {
        const val = parseInt(this.getAttribute('data-val'), 10);
        if (val) {
          if (nominalInput) {
            nominalInput.value = formatRupiah(val);
          }
          if (nominalRange) {
            nominalRange.value = val;
          }
          presetBtns.forEach((b) => {
            b.classList.remove('border-teal-500/60', 'text-teal-300');
            b.classList.add('border-slate-700', 'text-slate-200');
          });
          this.classList.remove('border-slate-700', 'text-slate-200');
          this.classList.add('border-teal-500/60', 'text-teal-300');
          calculateDeposit();
        }
      };
    });

    const setTenor = (months, btnElem) => {
      currentMonths = parseInt(months, 10);
      if (!btnElem) {
        btnElem = document.querySelector(`.wkl-dep-tenor-btn[data-months="${currentMonths}"]`);
      }
      if (btnElem) {
        tenorBtns.forEach((b) => {
          b.className = 'wkl-dep-tenor-btn py-2.5 px-2 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-all text-center';
          const subSpan = b.querySelector('span:last-child');
          if (subSpan) subSpan.className = 'text-[10px] text-slate-400 font-normal';
        });
        btnElem.className = 'wkl-dep-tenor-btn active py-2.5 px-2 rounded-xl bg-teal-600 border border-teal-500 text-xs font-bold text-white shadow-md transition-all text-center';
        const activeSubSpan = btnElem.querySelector('span:last-child');
        if (activeSubSpan) activeSubSpan.className = 'text-[10px] text-teal-100 font-normal';

        currentRate  = parseFloat(btnElem.getAttribute('data-rate')) || 4.23;
        currentEquiv = btnElem.getAttribute('data-equiv') || (currentRate + '%');
      }
      calculateDeposit();
    };

    tenorBtns.forEach((btn) => {
      btn.onclick = function() {
        const m = this.getAttribute('data-months');
        setTenor(m, this);
      };
    });

    // Expose global helper wklSelectTenor
    window.wklSelectTenor = (months) => {
      setTenor(months);
      const simElem = document.getElementById('simulasi');
      if (simElem) {
        simElem.scrollIntoView({ behavior: 'smooth' });
      }
    };

    calculateDeposit();
  }
};
window.DepositoPage = DepositoPage;
window.initDepositoPage = () => DepositoPage.init();
window.VideoModal = VideoModal;
window.InstagramSlider = InstagramSlider;

// ========================================================================
// ========================================================================
// PURE HTML5 CANVAS PDF VIEWER ENGINE (POWERED BY PDF.JS)
// 100% IMMUNE TO IDM INTERCEPTION & MICROSOFT EDGE OOPIF IFRAME ERRORS
// ========================================================================
function createWakalumiCanvasViewer(cfg) {
  const {
    containerEl,
    loadingEl,
    loadingDetailEl,
    emptyNoticeEl,
    downloadBtnEl,
    toolbarEl,
    pageSelectEl,
    totalPagesEl,
    zoomOutBtn,
    zoomLevelEl,
    zoomInBtn,
    fitBtn,
  } = cfg;

  let currentDoc = null;
  let currentPdfUrl = '';
  let abortController = null;
  let activeRenderTasks = [];
  let isCancelled = false;
  let currentScale = 1.0;
  let isAutoFit = true;
  let totalNumPages = 0;
  let scrollListenerAttached = false;

  const cancelActiveTasks = () => {
    isCancelled = true;
    activeRenderTasks.forEach((task) => {
      try {
        if (task && typeof task.cancel === 'function') {
          task.cancel();
        }
      } catch (e) {
        // ignore cancellation
      }
    });
    activeRenderTasks = [];
  };

  const cleanup = () => {
    cancelActiveTasks();
    if (abortController) {
      abortController.abort();
      abortController = null;
    }
    if (currentDoc) {
      try {
        currentDoc.destroy();
      } catch (e) {
        // ignore
      }
      currentDoc = null;
    }
    // Bebaskan blob URL dari memori
    if (load._blobUrl) {
      try { URL.revokeObjectURL(load._blobUrl); } catch(e) {}
      load._blobUrl = null;
    }
    if (containerEl) {
      containerEl.innerHTML = '';
    }
    if (pageSelectEl) {
      pageSelectEl.innerHTML = '<option value="1">1</option>';
      pageSelectEl.value = '1';
    }
    if (totalPagesEl) {
      totalPagesEl.textContent = '1';
    }
    if (zoomLevelEl) {
      zoomLevelEl.textContent = '100%';
    }
    if (toolbarEl) {
      toolbarEl.classList.add('hidden');
      toolbarEl.classList.remove('flex');
    }
    currentPdfUrl = '';
    totalNumPages = 0;
  };

  const calculateFitScale = (firstPageWidth) => {
    if (!containerEl || !firstPageWidth) return 1.0;
    const containerWidth = containerEl.clientWidth || (window.innerWidth > 900 ? 840 : window.innerWidth - 40);
    const availableWidth = Math.max(containerWidth - 64, 280);
    const scale = availableWidth / firstPageWidth;
    return Math.min(Math.max(scale, 0.45), 2.2);
  };

  const renderSinglePage = async (pageNum, scale) => {
    if (isCancelled || !currentDoc) return;

    const pageCard = containerEl ? containerEl.querySelector(`[data-page-num="${pageNum}"]`) : null;
    if (!pageCard) return;

    const canvas = pageCard.querySelector('canvas');
    if (!canvas) return;

    try {
      const page = await currentDoc.getPage(pageNum);
      if (isCancelled) return;

      const pixelRatio = window.devicePixelRatio || 1;
      const cssViewport = page.getViewport({ scale });
      const canvasViewport = page.getViewport({ scale: scale * pixelRatio });

      canvas.width = Math.floor(canvasViewport.width);
      canvas.height = Math.floor(canvasViewport.height);
      canvas.style.width = Math.floor(cssViewport.width) + 'px';
      canvas.style.height = Math.floor(cssViewport.height) + 'px';

      const ctx = canvas.getContext('2d', { alpha: false });
      const renderContext = {
        canvasContext: ctx,
        viewport: canvasViewport,
      };

      const renderTask = page.render(renderContext);
      activeRenderTasks.push(renderTask);
      await renderTask.promise;

      const idx = activeRenderTasks.indexOf(renderTask);
      if (idx !== -1) activeRenderTasks.splice(idx, 1);
    } catch (err) {
      if (err && err.name !== 'RenderingCancelledException') {
        console.warn(`Halaman ${pageNum} render notice:`, err);
      }
    }
  };

  const reRenderAllPages = async () => {
    if (!currentDoc || totalNumPages === 0) return;
    cancelActiveTasks();
    isCancelled = false;

    for (let p = 1; p <= totalNumPages; p++) {
      if (isCancelled) break;
      await renderSinglePage(p, currentScale);
    }
  };

  const initScrollSpy = () => {
    if (scrollListenerAttached || !containerEl || !pageSelectEl) return;
    scrollListenerAttached = true;

    let ticking = false;
    containerEl.addEventListener('scroll', () => {
      if (!ticking) {
        requestAnimationFrame(() => {
          ticking = false;
          const cards = containerEl.querySelectorAll('.wkl-pdf-page-card');
          if (!cards.length) return;
          const containerTop = containerEl.getBoundingClientRect().top;
          let activePage = 1;
          let minDiff = Infinity;

          cards.forEach((card) => {
            const rect = card.getBoundingClientRect();
            const diff = Math.abs(rect.top - containerTop - 16);
            if (diff < minDiff) {
              minDiff = diff;
              activePage = parseInt(card.getAttribute('data-page-num'), 10) || 1;
            }
          });

          if (pageSelectEl.value !== String(activePage)) {
            pageSelectEl.value = String(activePage);
          }
        });
        ticking = true;
      }
    }, { passive: true });
  };

  // Wire Toolbar Events Once
  if (pageSelectEl && !pageSelectEl._viewerBound) {
    pageSelectEl._viewerBound = true;
    pageSelectEl.addEventListener('change', () => {
      const pageNum = parseInt(pageSelectEl.value, 10);
      const target = containerEl ? containerEl.querySelector(`[data-page-num="${pageNum}"]`) : null;
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  if (zoomInBtn && !zoomInBtn._viewerBound) {
    zoomInBtn._viewerBound = true;
    zoomInBtn.addEventListener('click', () => {
      if (!currentDoc) return;
      isAutoFit = false;
      currentScale = Math.min(Number((currentScale + 0.15).toFixed(2)), 2.5);
      if (zoomLevelEl) zoomLevelEl.textContent = Math.round(currentScale * 100) + '%';
      reRenderAllPages();
    });
  }

  if (zoomOutBtn && !zoomOutBtn._viewerBound) {
    zoomOutBtn._viewerBound = true;
    zoomOutBtn.addEventListener('click', () => {
      if (!currentDoc) return;
      isAutoFit = false;
      currentScale = Math.max(Number((currentScale - 0.15).toFixed(2)), 0.45);
      if (zoomLevelEl) zoomLevelEl.textContent = Math.round(currentScale * 100) + '%';
      reRenderAllPages();
    });
  }

  if (fitBtn && !fitBtn._viewerBound) {
    fitBtn._viewerBound = true;
    fitBtn.addEventListener('click', async () => {
      if (!currentDoc) return;
      isAutoFit = true;
      try {
        const p1 = await currentDoc.getPage(1);
        const unscaled = p1.getViewport({ scale: 1.0 });
        currentScale = Number(calculateFitScale(unscaled.width).toFixed(2));
        if (zoomLevelEl) zoomLevelEl.textContent = Math.round(currentScale * 100) + '%';
        reRenderAllPages();
      } catch (e) {
        // fallback
      }
    });
  }

  // ─── Helper: render PDF langsung via <object> embed (hard-tempel universal) ───
  const renderHardEmbed = (directUrl) => {
    if (!containerEl) return;
    // Sembunyikan loading
    if (loadingEl) {
      loadingEl.style.opacity = '0';
      setTimeout(() => { if (loadingEl) loadingEl.classList.add('hidden'); }, 200);
    }
    if (emptyNoticeEl) emptyNoticeEl.classList.add('hidden');
    containerEl.classList.remove('hidden');

    containerEl.innerHTML = `
      <div class="w-full h-full flex flex-col bg-white" style="min-height:70vh;">
        <object
          data="${directUrl}"
          type="application/pdf"
          class="w-full flex-1 border-0"
          style="min-height:70vh;"
        >
          <div class="flex flex-col items-center justify-center h-full p-8 text-center">
            <svg class="w-12 h-12 text-teal-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            <p class="text-slate-700 font-semibold mb-3">Peramban Anda tidak mendukung tampilan PDF bawaan.</p>
            <a href="${directUrl}" target="_blank" rel="noopener" class="px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm inline-flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
              Buka / Unduh PDF
            </a>
          </div>
        </object>
      </div>
    `;
  };

  const load = async (pdfUrl) => {
    cleanup();
    currentPdfUrl = pdfUrl;

    // Bersihkan blob URL lama
    if (load._blobUrl) {
      try { URL.revokeObjectURL(load._blobUrl); } catch(e) {}
      load._blobUrl = null;
    }

    if (!pdfUrl || pdfUrl.length < 5 || pdfUrl.startsWith('#')) {
      if (loadingEl) loadingEl.classList.add('hidden');
      if (emptyNoticeEl) emptyNoticeEl.classList.remove('hidden');
      if (containerEl) containerEl.classList.add('hidden');
      return;
    }

    if (emptyNoticeEl) emptyNoticeEl.classList.add('hidden');
    if (containerEl) containerEl.classList.remove('hidden');

    // Loading spinner
    if (loadingEl) {
      loadingEl.classList.remove('hidden');
      loadingEl.style.opacity = '1';
    }
    if (loadingDetailEl) loadingDetailEl.textContent = 'Memuat dokumen...';

    // Set download button ke URL asli (bukan trigger download, hanya href)
    if (downloadBtnEl) {
      downloadBtnEl.setAttribute('href', pdfUrl);
      downloadBtnEl.removeAttribute('download'); // hapus download attribute supaya tidak trigger IDM
      downloadBtnEl.classList.remove('opacity-50', 'pointer-events-none');
    }

    // Toolbar disembunyikan (tidak digunakan tanpa PDF.js)
    if (toolbarEl) {
      toolbarEl.classList.add('hidden');
      toolbarEl.classList.remove('flex');
    }

    // Ambil path relatif dari URL penuh
    let docPath = pdfUrl;
    try {
      const parsed = new URL(pdfUrl, window.location.origin);
      docPath = parsed.pathname;
    } catch(e) {}

    const viewerEndpoint = '/wp-content/themes/wakalumi-theme/pdf-view.php?f=' + encodeURIComponent(docPath);

    const showFallback = (errMsg) => {
      if (loadingEl) {
        loadingEl.style.opacity = '0';
        setTimeout(() => { if (loadingEl) loadingEl.classList.add('hidden'); }, 200);
      }
      if (containerEl) {
        const safeUrl = pdfUrl.replace(/\\/g, '\\\\').replace(/'/g, "\\'");
        containerEl.innerHTML = `
          <div style="width:100%;height:75vh;display:flex;flex-direction:column;align-items:center;justify-content:center;background:#0f172a;gap:20px;padding:32px;text-align:center;">
            <div style="width:64px;height:64px;border-radius:16px;background:#1e293b;display:flex;align-items:center;justify-content:center;">
              <svg style="width:32px;height:32px;color:#14b8a6;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
            <div>
              <p style="color:#94a3b8;font-size:13px;margin:0 0 4px;">Pratinjau tidak tersedia.</p>
              <p style="color:#64748b;font-size:11px;margin:0;">${errMsg}</p>
            </div>
            <button onclick="window.open('${safeUrl}','_blank','noopener')"
               style="display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:#0d9488;color:white;border:none;border-radius:12px;font-weight:700;font-size:13px;cursor:pointer;">
              <svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              Buka PDF di Tab Baru
            </button>
          </div>`;
      }
    };

    try {
      // ── Minta PDF dalam format base64 JSON ──
      // IDM TIDAK mengintervensi response ber-Content-Type: application/json
      if (loadingDetailEl) loadingDetailEl.textContent = 'Mengambil dokumen...';

      const res = await fetch(viewerEndpoint, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-Wkl-Fmt': 'b64',       // ← Mode base64: PHP kirim JSON, bukan PDF langsung
        },
      });

      if (!res.ok) throw new Error('HTTP ' + res.status);

      const json = await res.json();

      if (!json.ok || !json.data) throw new Error('Respons tidak valid: ' + (json.error || 'unknown'));

      if (loadingDetailEl) loadingDetailEl.textContent = 'Memproses dokumen...';

      // ── Decode base64 → Uint8Array ──
      const b64 = json.data;
      const binaryStr = atob(b64);
      const bytes = new Uint8Array(binaryStr.length);
      for (let i = 0; i < binaryStr.length; i++) {
        bytes[i] = binaryStr.charCodeAt(i);
      }

      // Validasi magic bytes %PDF (25 50 44 46)
      if (bytes.length < 4 || bytes[0] !== 0x25 || bytes[1] !== 0x50 || bytes[2] !== 0x44 || bytes[3] !== 0x46) {
        throw new Error('Bukan file PDF valid');
      }

      // ── Buat blob: URL — IDM tidak bisa intercept blob: URLs ──
      const blob = new Blob([bytes], { type: 'application/pdf' });
      const blobUrl = URL.createObjectURL(blob);
      load._blobUrl = blobUrl;

      // Sembunyikan spinner
      if (loadingEl) {
        loadingEl.style.opacity = '0';
        setTimeout(() => { if (loadingEl) loadingEl.classList.add('hidden'); }, 200);
      }

      // ── EMBED via iframe dengan blob: URL ──
      if (containerEl) {
        containerEl.innerHTML = `<iframe
          src="${blobUrl}"
          style="width:100%;height:100%;min-height:75vh;border:none;display:block;"
          title="Pratinjau Dokumen Resmi BPRS Wakalumi"
        ></iframe>`;
      }

    } catch(err) {
      console.warn('[WKL PDF] Gagal:', err.message);
      showFallback(err.message);
    }
  };



  return {
    load,
    reset: cleanup,
  };
}

// ========================================================================
// BROSUR & KATALOG DOKUMEN MODULE (FILTER, SEARCH, & PDF LIGHTBOX MODAL)
// ========================================================================
const BrosurModule = {
  activeCategory: 'all',
  searchQuery: '',
  _escBound: false,

  init() {
    const gridContainer = document.getElementById('brosur-grid-container');
    const modal = document.getElementById('brosur-preview-modal');
    if (!gridContainer && !modal) return;

    this.initFilter();
    this.initPdfModal();
  },

  initFilter() {
    const filterGroup = document.getElementById('brosur-filter-group');
    const searchInput = document.getElementById('brosur-search-input');
    const searchClear = document.getElementById('brosur-search-clear');
    const resetBtn = document.getElementById('brosur-reset-btn');
    const cards = document.querySelectorAll('.brosur-card');
    const countEl = document.getElementById('brosur-count');
    const emptyState = document.getElementById('brosur-empty-state');

    if (!cards.length) return;

    const applyFilters = () => {
      let visibleCount = 0;
      const query = this.searchQuery.toLowerCase().trim();

      cards.forEach(card => {
        const cat = card.getAttribute('data-category') || '';
        const keywords = card.getAttribute('data-keywords') || '';
        const title = card.getAttribute('data-title') || '';

        const matchesCat = (this.activeCategory === 'all' || cat === this.activeCategory);
        const matchesSearch = !query || keywords.includes(query) || title.includes(query);

        if (matchesCat && matchesSearch) {
          card.classList.remove('hidden');
          card.style.display = 'flex';
          card.style.opacity = '1';
          card.style.visibility = 'visible';
          visibleCount++;
        } else {
          card.classList.add('hidden');
          card.style.display = 'none';
        }
      });

      if (countEl) {
        countEl.textContent = visibleCount;
      }

      if (emptyState) {
        if (visibleCount === 0) {
          emptyState.classList.remove('hidden');
        } else {
          emptyState.classList.add('hidden');
        }
      }

      if (searchClear) {
        if (query.length > 0) {
          searchClear.classList.remove('hidden');
        } else {
          searchClear.classList.add('hidden');
        }
      }
    };

    // Category button clicks
    if (filterGroup) {
      const buttons = filterGroup.querySelectorAll('.brosur-filter-btn');
      buttons.forEach(btn => {
        btn.addEventListener('click', () => {
          this.activeCategory = btn.getAttribute('data-category') || 'all';

          buttons.forEach(b => {
            b.classList.remove('active-filter', 'bg-teal-600', 'text-white', 'shadow-md');
            b.classList.add('text-slate-600', 'dark:text-slate-300');
          });

          btn.classList.add('active-filter', 'bg-teal-600', 'text-white', 'shadow-md');
          btn.classList.remove('text-slate-600', 'dark:text-slate-300');

          applyFilters();
        });
      });
    }

    // Live search input
    if (searchInput) {
      searchInput.addEventListener('input', (e) => {
        this.searchQuery = e.target.value;
        applyFilters();
      });
    }

    // Clear search button
    if (searchClear && searchInput) {
      searchClear.addEventListener('click', () => {
        searchInput.value = '';
        this.searchQuery = '';
        applyFilters();
        searchInput.focus();
      });
    }

    // Reset button in empty state
    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        this.activeCategory = 'all';
        this.searchQuery = '';
        if (searchInput) searchInput.value = '';

        if (filterGroup) {
          const buttons = filterGroup.querySelectorAll('.brosur-filter-btn');
          buttons.forEach((b, idx) => {
            if (idx === 0) {
              b.classList.add('active-filter', 'bg-teal-600', 'text-white', 'shadow-md');
              b.classList.remove('text-slate-600', 'dark:text-slate-300');
            } else {
              b.classList.remove('active-filter', 'bg-teal-600', 'text-white', 'shadow-md');
              b.classList.add('text-slate-600', 'dark:text-slate-300');
            }
          });
        }

        applyFilters();
      });
    }
  },

  initPdfModal() {
    const modal = document.getElementById('brosur-preview-modal');
    if (!modal) return;

    const backdrop = document.getElementById('brosur-modal-backdrop');
    const container = document.getElementById('brosur-modal-container');
    const canvasContainer = document.getElementById('brosur-pdf-canvas-container');
    const loading = document.getElementById('brosur-modal-loading');
    const loadingDetail = document.getElementById('brosur-pdf-loading-detail');
    const emptyNotice = document.getElementById('brosur-modal-empty');
    const titleEl = document.getElementById('brosur-modal-title');
    const sizeEl = document.getElementById('brosur-modal-size');
    const downloadBtn = document.getElementById('brosur-modal-download');
    const closeBtn = document.getElementById('brosur-modal-close');
    const fallbackWa = document.getElementById('brosur-modal-wa-fallback');
    const emptyDocTitle = document.getElementById('brosur-empty-doc-title');

    // Toolbar elements
    const toolbar = document.getElementById('brosur-pdf-toolbar');
    const pageSelect = document.getElementById('brosur-pdf-page-select');
    const totalPages = document.getElementById('brosur-pdf-total-pages');
    const zoomOut = document.getElementById('brosur-pdf-zoom-out');
    const zoomLevel = document.getElementById('brosur-pdf-zoom-level');
    const zoomIn = document.getElementById('brosur-pdf-zoom-in');
    const fitBtn = document.getElementById('brosur-pdf-fit');

    const pdfViewer = createWakalumiCanvasViewer({
      containerEl: canvasContainer,
      loadingEl: loading,
      loadingDetailEl: loadingDetail,
      emptyNoticeEl: emptyNotice,
      downloadBtnEl: downloadBtn,
      toolbarEl: toolbar,
      pageSelectEl: pageSelect,
      totalPagesEl: totalPages,
      zoomOutBtn: zoomOut,
      zoomLevelEl: zoomLevel,
      zoomInBtn: zoomIn,
      fitBtn: fitBtn,
    });

    const openModal = (btn) => {
      const pdfUrl = btn.getAttribute('data-pdf') || '';
      const title = btn.getAttribute('data-title') || 'Pratinjau Brosur';
      const size = btn.getAttribute('data-size') || '';

      if (titleEl) titleEl.textContent = title;
      if (sizeEl) sizeEl.textContent = size ? `• ${size}` : '';
      if (emptyDocTitle) emptyDocTitle.textContent = `"${title}"`;

      if (fallbackWa) {
        const defaultWa = '6281517380388';
        const msg = `Halo BPRS Wakalumi, saya ingin menanyakan dan meminta berkas PDF resmi untuk: ${title}.`;
        fallbackWa.href = `https://wa.me/${defaultWa}?text=${encodeURIComponent(msg)}`;
      }

      pdfViewer.load(pdfUrl);

      // Animasi Buka Modal
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';

      requestAnimationFrame(() => {
        if (backdrop) {
          backdrop.classList.remove('opacity-0');
          backdrop.classList.add('opacity-100');
        }
        if (container) {
          container.classList.remove('scale-95', 'opacity-0');
          container.classList.add('scale-100', 'opacity-100');
        }
      });
    };

    const closeModal = () => {
      if (backdrop) {
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
      }
      if (container) {
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
      }

      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        pdfViewer.reset();
        if (emptyNotice) emptyNotice.classList.add('hidden');
      }, 250);
    };

    // Pasang pemicu buka modal ke semua tombol pratinjau
    document.querySelectorAll('.brosur-preview-btn').forEach(btn => {
      if (btn._brosurBound) return;
      btn._brosurBound = true;
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(btn);
      });
    });

    // Pemicu tutup modal
    if (closeBtn && !closeBtn._brosurBound) {
      closeBtn._brosurBound = true;
      closeBtn.addEventListener('click', closeModal);
    }
    if (backdrop && !backdrop._brosurBound) {
      backdrop._brosurBound = true;
      backdrop.addEventListener('click', closeModal);
    }

    if (!this._escBound) {
      this._escBound = true;
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
          closeModal();
        }
      });
    }
  }
};

window.BrosurModule = BrosurModule;

// ========================================================================
// LAPORAN PUBLIKASI & GCG MODULE
// ========================================================================
const LaporanModule = {
  activeTab: 'all',
  activeYear: 'all',
  activeTW: 'all',
  searchQuery: '',
  _escBound: false,

  init() {
    const gridContainer = document.getElementById('laporan-grid-container');
    const modal = document.getElementById('laporan-preview-modal');
    if (!gridContainer && !modal) return;

    this.initTabs();
    this.initFilters();
    this.initPdfModal();
    this.updateYearCounts();
    this.applyFilters();
  },

  initTabs() {
    const tabButtons = document.querySelectorAll('.laporan-tab-btn');
    const twGroup = document.getElementById('laporan-tw-group');
    if (!tabButtons.length) return;

    tabButtons.forEach(btn => {
      if (btn._wklTabBound) return;
      btn._wklTabBound = true;
      btn.addEventListener('click', () => {
        const tab = btn.getAttribute('data-tab') || 'all';
        this.activeTab = tab;

        // Auto-reset year filter & TW filter whenever switching categories
        // This ensures the user immediately sees all documents of the new category
        // without getting stuck in a zero-result state from a previously clicked year
        this.activeYear = 'all';
        this.activeTW = 'all';

        tabButtons.forEach(b => {
          const activeClasses = (b.getAttribute('data-active-classes') || '').split(/\s+/).filter(Boolean);
          const inactiveClasses = (b.getAttribute('data-inactive-classes') || '').split(/\s+/).filter(Boolean);
          const iconActive = (b.getAttribute('data-icon-active') || 'bg-white/20 text-white').split(/\s+/).filter(Boolean);
          const iconInactive = (b.getAttribute('data-icon-inactive') || '').split(/\s+/).filter(Boolean);
          const iconBox = b.querySelector('.tab-icon-box');

          b.classList.remove('active-tab', ...activeClasses);
          b.classList.add(...inactiveClasses);
          if (iconBox) {
            iconBox.classList.remove(...iconActive);
            if (iconInactive.length) iconBox.classList.add(...iconInactive);
          }
        });

        const activeClasses = (btn.getAttribute('data-active-classes') || '').split(/\s+/).filter(Boolean);
        const inactiveClasses = (btn.getAttribute('data-inactive-classes') || '').split(/\s+/).filter(Boolean);
        const iconActive = (btn.getAttribute('data-icon-active') || 'bg-white/20 text-white').split(/\s+/).filter(Boolean);
        const iconInactive = (btn.getAttribute('data-icon-inactive') || '').split(/\s+/).filter(Boolean);
        const activeIconBox = btn.querySelector('.tab-icon-box');

        btn.classList.remove(...inactiveClasses);
        btn.classList.add('active-tab', ...activeClasses);
        if (activeIconBox) {
          if (iconInactive.length) activeIconBox.classList.remove(...iconInactive);
          activeIconBox.classList.add(...iconActive);
        }

        // Reset Year Buttons UI to "Semua Tahun"
        const yearButtons = document.querySelectorAll('.laporan-year-btn');
        yearButtons.forEach(b => {
          const isAll = b.getAttribute('data-year') === 'all';
          if (isAll) {
            b.classList.add('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            b.classList.remove('text-slate-600', 'dark:text-slate-300');
          } else {
            b.classList.remove('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            b.classList.add('text-slate-600', 'dark:text-slate-300');
          }
        });

        // Show or hide Triwulan sub-filter pills
        if (twGroup) {
          if (tab === 'triwulan') {
            twGroup.classList.remove('hidden');
            twGroup.classList.add('flex');
            twGroup.style.display = 'flex';
          } else {
            twGroup.classList.remove('flex');
            twGroup.classList.add('hidden');
            twGroup.style.display = 'none';
          }
        }

        // Reset TW buttons UI to "Semua TW"
        const twButtons = document.querySelectorAll('.laporan-tw-btn');
        twButtons.forEach(b => {
          const isAll = b.getAttribute('data-tw') === 'all';
          if (isAll) {
            b.classList.remove('text-emerald-800', 'dark:text-emerald-300');
            b.classList.add('active-tw', 'bg-emerald-600', 'text-white', 'font-black', 'shadow-sm', 'shadow-emerald-600/30');
          } else {
            b.classList.remove('active-tw', 'bg-emerald-600', 'text-white', 'font-black', 'shadow-sm', 'shadow-emerald-600/30');
            b.classList.add('text-emerald-800', 'dark:text-emerald-300', 'font-bold');
          }
        });

        this.updateYearCounts();
        this.applyFilters();
      });
    });
  },

  updateYearCounts() {
    const cards = document.querySelectorAll('.laporan-card');
    const yearButtons = document.querySelectorAll('.laporan-year-btn');
    if (!cards.length || !yearButtons.length) return;

    const yearCounts = {};
    let totalInActiveTab = 0;
    const curTab = (this.activeTab || 'all').trim();

    cards.forEach(card => {
      const kat = (card.getAttribute('data-kategori') || '').trim();
      const yr = (card.getAttribute('data-tahun') || '').trim();
      const matchTab = (curTab === 'all' || kat === curTab || (curTab === 'berkelanjutan' && (kat === 'lkb' || kat === 'berkelanjutan')));

      if (matchTab && yr) {
        yearCounts[yr] = (yearCounts[yr] || 0) + 1;
        totalInActiveTab++;
      }
    });

    // Jika tahun yang sedang aktif tidak memiliki dokumen sama sekali di tab ini, otomatis reset ke 'all'
    if (this.activeYear !== 'all' && !(yearCounts[this.activeYear] > 0)) {
      this.activeYear = 'all';
    }

    yearButtons.forEach(btn => {
      const yr = (btn.getAttribute('data-year') || '').trim();
      const isCurrentActive = (this.activeYear === yr);

      if (isCurrentActive) {
        btn.classList.add('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
        btn.classList.remove('text-slate-600', 'dark:text-slate-300');
      } else {
        btn.classList.remove('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
        btn.classList.add('text-slate-600', 'dark:text-slate-300');
      }

      const badgeClass = isCurrentActive 
        ? 'bg-teal-100 dark:bg-teal-900/80 text-teal-800 dark:text-teal-200' 
        : 'bg-slate-200/80 dark:bg-slate-700/80 text-slate-700 dark:text-slate-300';

      if (yr === 'all') {
        btn.style.display = '';
        btn.innerHTML = `Semua Tahun <span class="year-count-badge ml-1 px-1.5 py-0.5 rounded-full text-[10px] font-bold ${badgeClass}">${totalInActiveTab}</span>`;
      } else {
        const count = yearCounts[yr] || 0;
        btn.innerHTML = `${yr} <span class="year-count-badge ml-1 px-1.5 py-0.5 rounded-full text-[10px] font-bold ${badgeClass}">${count}</span>`;
        if (count === 0) {
          // Sembunyikan tombol tahun jika tidak ada data untuk kategori ini
          btn.style.display = 'none';
        } else {
          btn.style.display = '';
          btn.classList.remove('opacity-40', 'cursor-not-allowed');
          btn.removeAttribute('title');
        }
      }
    });
  },

  initFilters() {
    const yearButtons = document.querySelectorAll('.laporan-year-btn');
    const twButtons = document.querySelectorAll('.laporan-tw-btn');
    const searchInput = document.getElementById('laporan-search-input');
    const searchClear = document.getElementById('laporan-search-clear');
    const resetBtn = document.getElementById('laporan-reset-btn');
    const resetYearBtn = document.getElementById('laporan-reset-year-btn');

    // Year filters
    yearButtons.forEach(btn => {
      if (btn._wklYearBound) return;
      btn._wklYearBound = true;
      btn.addEventListener('click', () => {
        this.activeYear = (btn.getAttribute('data-year') || 'all').trim();
        yearButtons.forEach(b => {
          b.classList.remove('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
          b.classList.add('text-slate-600', 'dark:text-slate-300');
        });
        btn.classList.remove('text-slate-600', 'dark:text-slate-300');
        btn.classList.add('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
        this.updateYearCounts();
        this.applyFilters();
      });
    });

    // TW filters
    twButtons.forEach(btn => {
      if (btn._wklTWBound) return;
      btn._wklTWBound = true;
      btn.addEventListener('click', () => {
        this.activeTW = (btn.getAttribute('data-tw') || 'all').trim();
        twButtons.forEach(b => {
          b.classList.remove('active-tw', 'bg-emerald-600', 'text-white', 'font-black', 'shadow-sm', 'shadow-emerald-600/30');
          b.classList.add('text-emerald-800', 'dark:text-emerald-300', 'font-bold');
        });
        btn.classList.remove('text-emerald-800', 'dark:text-emerald-300');
        btn.classList.add('active-tw', 'bg-emerald-600', 'text-white', 'font-black', 'shadow-sm', 'shadow-emerald-600/30');
        this.applyFilters();
      });
    });

    // Search input
    if (searchInput && !searchInput._wklSearchBound) {
      searchInput._wklSearchBound = true;
      searchInput.addEventListener('input', (e) => {
        this.searchQuery = e.target.value;
        this.applyFilters();
      });
    }

    // Search clear
    if (searchClear && searchInput && !searchClear._wklClearBound) {
      searchClear._wklClearBound = true;
      searchClear.addEventListener('click', () => {
        searchInput.value = '';
        this.searchQuery = '';
        searchInput.focus();
        this.applyFilters();
      });
    }

    // Reset Year Only Button (inside empty state)
    if (resetYearBtn && !resetYearBtn._wklResetYrBound) {
      resetYearBtn._wklResetYrBound = true;
      resetYearBtn.addEventListener('click', () => {
        this.activeYear = 'all';
        yearButtons.forEach(b => {
          const isAll = (b.getAttribute('data-year') || '').trim() === 'all';
          if (isAll) {
            b.classList.add('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            b.classList.remove('text-slate-600', 'dark:text-slate-300');
          } else {
            b.classList.remove('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            b.classList.add('text-slate-600', 'dark:text-slate-300');
          }
        });
        this.updateYearCounts();
        this.applyFilters();
      });
    }

    // Reset button
    if (resetBtn && !resetBtn._wklResetBound) {
      resetBtn._wklResetBound = true;
      resetBtn.addEventListener('click', () => {
        this.activeTab = 'all';
        this.activeYear = 'all';
        this.activeTW = 'all';
        this.searchQuery = '';
        if (searchInput) searchInput.value = '';

        // Reset Tab UI
        const tabButtons = document.querySelectorAll('.laporan-tab-btn');
        tabButtons.forEach(b => {
          const isAllTab = (b.getAttribute('data-tab') || '').trim() === 'all';
          const activeClasses = (b.getAttribute('data-active-classes') || '').split(/\s+/).filter(Boolean);
          const inactiveClasses = (b.getAttribute('data-inactive-classes') || '').split(/\s+/).filter(Boolean);
          const iconActive = (b.getAttribute('data-icon-active') || 'bg-white/20 text-white').split(/\s+/).filter(Boolean);
          const iconInactive = (b.getAttribute('data-icon-inactive') || '').split(/\s+/).filter(Boolean);
          const iconBox = b.querySelector('.tab-icon-box');

          if (isAllTab) {
            b.classList.remove(...inactiveClasses);
            b.classList.add('active-tab', ...activeClasses);
            if (iconBox) {
              if (iconInactive.length) iconBox.classList.remove(...iconInactive);
              iconBox.classList.add(...iconActive);
            }
          } else {
            b.classList.remove('active-tab', ...activeClasses);
            b.classList.add(...inactiveClasses);
            if (iconBox) {
              iconBox.classList.remove(...iconActive);
              if (iconInactive.length) iconBox.classList.add(...iconInactive);
            }
          }
        });

        // Reset Year UI
        yearButtons.forEach(b => {
          const isAll = (b.getAttribute('data-year') || '').trim() === 'all';
          if (isAll) {
            b.classList.add('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            b.classList.remove('text-slate-600', 'dark:text-slate-300');
          } else {
            b.classList.remove('active-year', 'bg-white', 'dark:bg-dark-card', 'text-teal-700', 'dark:text-teal-300', 'shadow-xs');
            b.classList.add('text-slate-600', 'dark:text-slate-300');
          }
        });

        // Reset TW UI
        twButtons.forEach(b => {
          const isAll = (b.getAttribute('data-tw') || '').trim() === 'all';
          if (isAll) {
            b.classList.remove('text-emerald-800', 'dark:text-emerald-300');
            b.classList.add('active-tw', 'bg-emerald-600', 'text-white', 'font-black', 'shadow-sm', 'shadow-emerald-600/30');
          } else {
            b.classList.remove('active-tw', 'bg-emerald-600', 'text-white', 'font-black', 'shadow-sm', 'shadow-emerald-600/30');
            b.classList.add('text-emerald-800', 'dark:text-emerald-300', 'font-bold');
          }
        });

        const twGroup = document.getElementById('laporan-tw-group');
        if (twGroup) {
          twGroup.classList.remove('flex');
          twGroup.classList.add('hidden');
          twGroup.style.display = 'none';
        }

        this.updateYearCounts();
        this.applyFilters();
      });
    }
  },

  applyFilters() {
    const cards = document.querySelectorAll('.laporan-card');
    const countEl = document.getElementById('laporan-count');
    const emptyState = document.getElementById('laporan-empty-state');
    const searchClear = document.getElementById('laporan-search-clear');
    const query = this.searchQuery.toLowerCase().trim();
    const curTab = (this.activeTab || 'all').trim();
    const curYear = (this.activeYear || 'all').trim();
    const curTW = (this.activeTW || 'all').trim();

    let visibleCount = 0;

    cards.forEach(card => {
      const kat = (card.getAttribute('data-kategori') || '').trim();
      const tahun = (card.getAttribute('data-tahun') || '').trim();
      const periode = (card.getAttribute('data-periode') || '').trim();
      const keywords = (card.getAttribute('data-keywords') || '').trim();
      const title = (card.getAttribute('data-title') || '').trim();

      const matchTab = (curTab === 'all' || kat === curTab || (curTab === 'berkelanjutan' && (kat === 'lkb' || kat === 'berkelanjutan')));
      const matchYear = (curYear === 'all' || tahun === curYear);
      const matchTW = (curTab !== 'triwulan' || curTW === 'all' || periode.includes(curTW));
      const matchSearch = !query || keywords.includes(query) || title.includes(query);

      if (matchTab && matchYear && matchTW && matchSearch) {
        card.classList.remove('hidden');
        card.style.display = 'flex';
        card.style.opacity = '1';
        card.style.visibility = 'visible';
        visibleCount++;
      } else {
        card.classList.add('hidden');
        card.style.display = 'none';
      }
    });

    if (countEl) countEl.textContent = visibleCount;
    if (emptyState) {
      if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
        emptyState.classList.add('flex');
        emptyState.style.display = 'flex';

        const descEl = document.getElementById('laporan-empty-desc');
        if (descEl) {
          if (query) {
            descEl.textContent = `Tidak ditemukan dokumen laporan yang cocok dengan pencarian "${query}".`;
          } else if (this.activeYear !== 'all') {
            descEl.textContent = `Tidak ada dokumen laporan untuk tahun ${this.activeYear} pada kategori yang dipilih. Silakan klik tombol di bawah untuk melihat arsip lengkap tahun lainnya.`;
          } else {
            descEl.textContent = 'Tidak ditemukan dokumen laporan untuk kriteria pencarian atau filter yang dipilih.';
          }
        }
      } else {
        emptyState.classList.add('hidden');
        emptyState.classList.remove('flex');
        emptyState.style.display = 'none';
      }
    }
    if (searchClear) {
      if (query.length > 0) {
        searchClear.classList.remove('hidden');
      } else {
        searchClear.classList.add('hidden');
      }
    }
  },

  initPdfModal() {
    const modal = document.getElementById('laporan-preview-modal');
    if (!modal) return;

    const backdrop = document.getElementById('laporan-modal-backdrop');
    const container = document.getElementById('laporan-modal-container');
    const canvasContainer = document.getElementById('laporan-pdf-canvas-container');
    const loading = document.getElementById('laporan-modal-loading');
    const loadingDetail = document.getElementById('laporan-pdf-loading-detail');
    const emptyNotice = document.getElementById('laporan-modal-empty');
    const titleEl = document.getElementById('laporan-modal-title');
    const sizeEl = document.getElementById('laporan-modal-size');
    const downloadBtn = document.getElementById('laporan-modal-download');
    const closeBtn = document.getElementById('laporan-modal-close');
    const fallbackWa = document.getElementById('laporan-modal-wa-fallback');
    const emptyDocTitle = document.getElementById('laporan-empty-doc-title');

    // Toolbar elements
    const toolbar = document.getElementById('laporan-pdf-toolbar');
    const pageSelect = document.getElementById('laporan-pdf-page-select');
    const totalPages = document.getElementById('laporan-pdf-total-pages');
    const zoomOut = document.getElementById('laporan-pdf-zoom-out');
    const zoomLevel = document.getElementById('laporan-pdf-zoom-level');
    const zoomIn = document.getElementById('laporan-pdf-zoom-in');
    const fitBtn = document.getElementById('laporan-pdf-fit');

    const pdfViewer = createWakalumiCanvasViewer({
      containerEl: canvasContainer,
      loadingEl: loading,
      loadingDetailEl: loadingDetail,
      emptyNoticeEl: emptyNotice,
      downloadBtnEl: downloadBtn,
      toolbarEl: toolbar,
      pageSelectEl: pageSelect,
      totalPagesEl: totalPages,
      zoomOutBtn: zoomOut,
      zoomLevelEl: zoomLevel,
      zoomInBtn: zoomIn,
      fitBtn: fitBtn,
    });

    const openModal = (btn) => {
      const pdfUrl = btn.getAttribute('data-pdf') || '';
      const title = btn.getAttribute('data-title') || 'Pratinjau Laporan';
      const size = btn.getAttribute('data-size') || '';

      if (titleEl) titleEl.textContent = title;
      if (sizeEl) sizeEl.textContent = size ? `• ${size}` : '';
      if (emptyDocTitle) emptyDocTitle.textContent = `"${title}"`;

      if (fallbackWa) {
        const defaultWa = '6281517380388';
        const msg = `Halo Sekretariat BPRS Wakalumi, saya ingin menanyakan dan meminta berkas laporan resmi untuk: ${title}.`;
        fallbackWa.href = `https://wa.me/${defaultWa}?text=${encodeURIComponent(msg)}`;
      }

      pdfViewer.load(pdfUrl);

      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';

      requestAnimationFrame(() => {
        if (backdrop) backdrop.style.opacity = '1';
        if (container) {
          container.style.opacity = '1';
          container.style.transform = 'scale(1)';
        }
      });
    };

    const closeModal = () => {
      if (backdrop) backdrop.style.opacity = '0';
      if (container) {
        container.style.opacity = '0';
        container.style.transform = 'scale(0.95)';
      }
      setTimeout(() => {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        pdfViewer.reset();
        if (emptyNotice) emptyNotice.classList.add('hidden');
      }, 300);
    };

    // Bind preview buttons
    const previewButtons = document.querySelectorAll('.laporan-preview-btn');
    previewButtons.forEach(btn => {
      if (btn._laporanBound) return;
      btn._laporanBound = true;
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(btn);
      });
    });

    if (closeBtn && !closeBtn._laporanBound) {
      closeBtn._laporanBound = true;
      closeBtn.addEventListener('click', closeModal);
    }
    if (backdrop && !backdrop._laporanBound) {
      backdrop._laporanBound = true;
      backdrop.addEventListener('click', closeModal);
    }

    if (!this._escBound) {
      this._escBound = true;
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
          closeModal();
        }
      });
    }
  }
};

window.LaporanModule = LaporanModule;

// ========================================================================
// INITIALIZE ALL MODULES
// ========================================================================
function initAllModules() {
  DarkMode.bindToggle();
  Navbar.init();
  MobileMenu.init();
  HeroSlider.init();
  InstagramSlider.init();
  VideoModal.init();
  AnnouncementBar.init();
  Counter.init();
  SpotlightTilt.init();
  CopyClipboard.init();
  LazyImages.init();
  SmoothScroll.init();
  OrgChartLightbox.init();
  ExecutiveParallax.init();
  KantorModule.init();
  SavingsCalculator.init();
  DepositoPage.init();
  BrosurModule.init();
  LaporanModule.init();
  if (window.FinancingPage && typeof window.FinancingPage.init === 'function') {
    window.FinancingPage.init();
  }

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

  // Page navigation start: trigger preloader & loading line, close mobile & desktop menus
  swup.hooks.on('visit:start', (visit) => {
    const overlay = document.getElementById('mobile-menu-overlay');
    const panel = document.getElementById('mobile-menu-panel');
    if (panel && panel.classList.contains('active')) {
      MobileMenu.close(overlay, panel);
    }

    // Close desktop dropdowns
    document.querySelectorAll('.dropdown.open, .dropdown.is-open, .dropdown.hovered').forEach(d => {
      d.classList.remove('open', 'is-open', 'hovered');
    });

    try {
      const targetUrl = new URL(visit.to.url, window.location.origin);
      window._swupTargetHash = visit.to.hash || targetUrl.hash || '';
    } catch (e) {
      window._swupTargetHash = (visit && visit.to ? visit.to.hash : '') || '';
    }

    Preloader.startTransition();
  });

  // Prevent Swup's default scroll-to-top if we have a target hash
  swup.hooks.replace('visit:scroll', (visit, { next }) => {
    const hasHash = (visit && visit.to && visit.to.hash) || window._swupTargetHash;
    if (hasHash) {
      return Promise.resolve();
    }
    return next();
  });

  // Re-initialize modules and finish preloader after page transition
  swup.hooks.on('page:view', () => {
    // 1. Re-execute dynamic inline scripts inside #swup container if any
    const swupContainer = document.getElementById('swup');
    if (swupContainer) {
      const inlineScripts = swupContainer.querySelectorAll('script');
      inlineScripts.forEach((oldScript) => {
        const newScript = document.createElement('script');
        Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
        if (oldScript.src) {
          newScript.src = oldScript.src;
        } else {
          newScript.textContent = oldScript.textContent;
        }
        oldScript.parentNode.replaceChild(newScript, oldScript);
      });
    }

    // 2. Re-initialize all theme modules
    initAllModules();
    Preloader.finishTransition();

    // Scroll to top only if there is no hash
    const targetHash = window._swupTargetHash || window.location.hash;
    if (!targetHash) {
      window.scrollTo(0, 0);
    }

    setTimeout(() => {
      if (typeof AOS !== 'undefined') {
        AOS.refreshHard();
      }
    }, 100);
  });

  // When transition animation finishes completely, smooth scroll to the target section
  swup.hooks.on('visit:end', (visit) => {
    const targetHash = window._swupTargetHash || (visit && visit.to ? visit.to.hash : '') || window.location.hash;
    window._swupTargetHash = null;

    if (targetHash && targetHash.length > 1) {
      setTimeout(() => {
        performSmoothScrollToTarget(targetHash, true);
      }, 100);
    }
  });

  // In case visit is cancelled/aborted
  swup.hooks.on('visit:abort', () => {
    Preloader.hide(200);
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

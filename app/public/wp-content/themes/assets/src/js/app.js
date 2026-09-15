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
    this.updateActiveState();
  },

  updateActiveState() {
    const rawPath = window.location.pathname;
    const currentPath = rawPath.replace(/\/$/, '') || '/';
    const isHome = currentPath === '/' || currentPath === '';

    // 1. Reset Desktop active states
    const desktopLinks = document.querySelectorAll('#main-navbar .nav-link');
    const dropdownItems = document.querySelectorAll('#main-navbar .dropdown-item');

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

      // Find matching dropdown child item
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
          } else if (currentPath.startsWith('/produk')) {
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
    const sublinks = mobilePanel.querySelectorAll('.mobile-nav-sublink');

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
    this.currentIndex = 0;
    this.updateSpotlight(0, false);
    this.bindDesktopEvents();
  },

  updateSpotlight(index, animate = true) {
    if (index < 0 || index >= this.members.length) return;
    this.currentIndex = index;
    const member = this.members[index];

    const card = document.getElementById('exec-spotlight-card');
    const img = document.getElementById('exec-spotlight-img');
    const name = document.getElementById('exec-spotlight-name');
    const role = document.getElementById('exec-spotlight-role');
    const category = document.getElementById('exec-spotlight-category');
    const karir = document.getElementById('exec-spotlight-karir');
    const pendidikan = document.getElementById('exec-spotlight-pendidikan');
    const sertifikasi = document.getElementById('exec-spotlight-sertifikasi');
    const quote = document.getElementById('exec-spotlight-quote');
    const quoteWrap = document.getElementById('exec-spotlight-quote-wrap');
    const counter = document.getElementById('exec-current-counter');
    const progressBar = document.getElementById('exec-stage-progress-bar');
    const statusText = document.getElementById('exec-spotlight-status-text');
    const statusDot = document.getElementById('exec-spotlight-status-dot');
    const bar = document.getElementById('exec-spotlight-bar');

    if (animate && card) {
      card.classList.add('exec-transitioning');
      setTimeout(() => card.classList.remove('exec-transitioning'), 300);
    }

    if (img) img.src = member.foto || '';
    if (img) img.alt = member.nama || '';
    if (name) name.textContent = member.nama || '';
    if (role) role.textContent = member.jabatan || '';
    if (category) category.textContent = member.kategori || '';
    if (karir) karir.textContent = member.riwayat_karir || '';
    if (pendidikan) pendidikan.textContent = member.pendidikan || '—';
    if (sertifikasi) sertifikasi.textContent = member.sertifikasi || '—';

    if (quote && quoteWrap) {
      if (member.kutipan && member.kutipan.trim() !== '') {
        quote.textContent = `"${member.kutipan}"`;
        quoteWrap.style.display = '';
      } else {
        quoteWrap.style.display = 'none';
      }
    }

    if (counter) {
      counter.textContent = String(index + 1).padStart(2, '0');
    }

    if (progressBar) {
      const pct = ((index + 1) / this.members.length) * 100;
      progressBar.style.width = `${pct}%`;
    }

    if (statusDot && statusText) {
      const isPending = member.status === 'Proses Perizinan OJK';
      statusText.textContent = member.status || 'Aktif';
      if (isPending) {
        statusDot.className = 'absolute -bottom-2 -right-2 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-500 text-white shadow-md flex items-center gap-1.5 border-2 border-white dark:border-dark-border';
      } else {
        statusDot.className = 'absolute -bottom-2 -right-2 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500 text-white shadow-md flex items-center gap-1.5 border-2 border-white dark:border-dark-border';
      }
    }

    if (bar) {
      if (member.kategori === 'Dewan Pengawas Syariah') {
        bar.className = 'absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-400 to-teal-500 transition-all duration-500';
      } else if (member.kategori === 'Dewan Komisaris') {
        bar.className = 'absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-400 to-primary-600 transition-all duration-500';
      } else {
        bar.className = 'absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-400 to-orange-500 transition-all duration-500';
      }
    }

    const dockCards = document.querySelectorAll('.exec-dock-card');
    dockCards.forEach((c) => {
      const cIdx = parseInt(c.getAttribute('data-index'), 10);
      const dot = c.querySelector('.dock-active-dot');
      if (cIdx === index) {
        c.classList.add('active', 'bg-white', 'dark:bg-dark-surface', 'shadow-lg', 'ring-2', 'ring-primary-500/80', 'dark:ring-teal-400/80');
        c.classList.remove('bg-white/60', 'dark:bg-dark-surface/60', 'opacity-75');
        if (dot) dot.classList.remove('hidden');
        if (dot) dot.classList.add('flex');
        c.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      } else {
        c.classList.remove('active', 'bg-white', 'dark:bg-dark-surface', 'shadow-lg', 'ring-2', 'ring-primary-500/80', 'dark:ring-teal-400/80');
        c.classList.add('bg-white/60', 'dark:bg-dark-surface/60', 'opacity-75');
        if (dot) dot.classList.remove('flex');
        if (dot) dot.classList.add('hidden');
      }
    });

    const btnPrev = document.getElementById('exec-btn-prev');
    const btnNext = document.getElementById('exec-btn-next');
    if (btnPrev) btnPrev.disabled = index === 0;
    if (btnNext) btnNext.disabled = index === this.members.length - 1;
  },

  scrollToMember(index) {
    if (!this.section) return;
    this.isManualScrolling = true;
    this.updateSpotlight(index, true);

    const sectionTop = this.section.getBoundingClientRect().top + window.scrollY;
    const stageHeight = this.section.offsetHeight - window.innerHeight;
    const targetScroll = sectionTop + (index / (this.members.length - 1 || 1)) * stageHeight;

    window.scrollTo({ top: targetScroll, behavior: 'smooth' });

    clearTimeout(this.scrollTimeout);
    this.scrollTimeout = setTimeout(() => {
      this.isManualScrolling = false;
    }, 700);
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
        const targetIndex = Math.min(this.members.length - 1, Math.floor(progress * this.members.length));
        if (targetIndex !== this.currentIndex) {
          this.updateSpotlight(targetIndex, true);
        }
      }
    };

    window.addEventListener('scroll', onScroll, { passive: true });

    const dockCards = document.querySelectorAll('.exec-dock-card');
    dockCards.forEach((card) => {
      card.addEventListener('click', () => {
        const idx = parseInt(card.getAttribute('data-index'), 10);
        this.scrollToMember(idx);
      });
    });

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
// INSTAGRAM FEED SLIDER
// ========================================================================
const InstagramSlider = {
  init() {
    const track = document.getElementById('ig-scroll-track');
    const prevBtn = document.getElementById('ig-scroll-prev');
    const nextBtn = document.getElementById('ig-scroll-next');
    if (!track || !prevBtn || !nextBtn) return;

    const scrollAmount = () => (window.innerWidth < 768 ? window.innerWidth * 0.85 + 24 : 374);

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
  InstagramSlider.init();
  AnnouncementBar.init();
  Counter.init();
  SpotlightTilt.init();
  CopyClipboard.init();
  LazyImages.init();
  SmoothScroll.init();
  OrgChartLightbox.init();
  ExecutiveParallax.init();

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

  // Page navigation start: trigger preloader & loading line, close mobile menu
  swup.hooks.on('visit:start', () => {
    const overlay = document.getElementById('mobile-menu-overlay');
    const panel = document.getElementById('mobile-menu-panel');
    if (panel && panel.classList.contains('active')) {
      MobileMenu.close(overlay, panel);
    }

    Preloader.startTransition();
  });

  // Re-initialize modules and finish preloader after page transition
  swup.hooks.on('page:view', () => {
    window.scrollTo(0, 0);
    initAllModules();
    Preloader.finishTransition();
    setTimeout(() => {
      if (typeof AOS !== 'undefined') {
        AOS.refreshHard();
      }
    }, 100);
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

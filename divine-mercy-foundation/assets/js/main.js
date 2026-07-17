/* Divine Mercy Foundation — Main JS */

// Mobile nav toggle
const navToggle = document.getElementById('nav-toggle');
const siteNav   = document.getElementById('site-nav');

if (navToggle && siteNav) {
  navToggle.addEventListener('click', () => {
    const isOpen = siteNav.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });
  // Close on backdrop click
  siteNav.addEventListener('click', (e) => {
    if (e.target === siteNav) {
      siteNav.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
  });
}

// Mobile dropdown toggle — tap the parent link to open/close submenu
document.querySelectorAll('.has-dropdown > a').forEach(link => {
  link.addEventListener('click', (e) => {
    // Only intercept on mobile (nav toggle visible)
    if (window.getComputedStyle(navToggle || document.body).display === 'none') return;
    e.preventDefault();
    const li = link.closest('.has-dropdown');
    // Close siblings
    document.querySelectorAll('.has-dropdown.open').forEach(el => {
      if (el !== li) el.classList.remove('open');
    });
    li.classList.toggle('open');
  });
});

// Sticky header shadow on scroll
const header = document.getElementById('site-header');
if (header) {
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 30);
  }, { passive: true });
}

// Animate stat counters when visible
function animateCounters() {
  const stats = document.querySelectorAll('.stat-value');
  stats.forEach(el => {
    const text = el.textContent.trim();
    const num  = parseInt(text.replace(/\D/g, ''), 10);
    const suffix = text.replace(/[\d,]/g, '');
    if (!num || el.dataset.animated) return;
    el.dataset.animated = '1';
    let start = 0;
    const duration = 1600;
    const step = (timestamp) => {
      if (!start) start = timestamp;
      const progress = Math.min((timestamp - start) / duration, 1);
      const ease = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(ease * num).toLocaleString() + suffix;
      if (progress < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  });
}

// Intersection Observer for animations
const observerOptions = { threshold: 0.15 };
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('in-view');
      if (entry.target.closest('.stats-strip')) animateCounters();
    }
  });
}, observerOptions);

// Observe elements for entrance animation
document.querySelectorAll(
  '.program-card, .news-card, .value-card, .step-card, .stat-item, .section-split, .dash-stat'
).forEach(el => {
  el.classList.add('fade-up');
  observer.observe(el);
});

// Add CSS for fade-up animation
const style = document.createElement('style');
style.textContent = `
  .fade-up { opacity: 0; transform: translateY(28px); transition: opacity .55s ease, transform .55s ease; }
  .fade-up.in-view { opacity: 1; transform: translateY(0); }
  .program-card:nth-child(2).fade-up { transition-delay: .1s; }
  .program-card:nth-child(3).fade-up { transition-delay: .2s; }
  .news-card:nth-child(2).fade-up { transition-delay: .1s; }
  .news-card:nth-child(3).fade-up { transition-delay: .2s; }
`;
document.head.appendChild(style);

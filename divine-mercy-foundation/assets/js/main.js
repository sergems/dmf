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

// Dropdown: hover on desktop (CSS handles it), click-toggle on mobile only
document.querySelectorAll('.has-dropdown > a').forEach(link => {
  link.addEventListener('click', (e) => {
    // On desktop the nav-toggle is hidden — hover handles the dropdown, let the link navigate normally
    const toggle = document.getElementById('nav-toggle');
    const isMobile = toggle && window.getComputedStyle(toggle).display !== 'none';
    if (!isMobile) return; // let browser follow the href
    e.preventDefault();
    const li = link.closest('.has-dropdown');
    const isOpen = li.classList.contains('open');
    document.querySelectorAll('.has-dropdown.open').forEach(el => el.classList.remove('open'));
    if (!isOpen) li.classList.add('open');
  });
});

// Close .open class when pressing Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    document.querySelectorAll('.has-dropdown.open').forEach(el => el.classList.remove('open'));
  }
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

/* ============================================================
   DMF Lightbox — vanilla JS, no dependencies
   Triggers on: a.gallery-item, a[data-gallery]
   ============================================================ */
(function () {
  'use strict';

  // Build overlay HTML once
  const overlay = document.createElement('div');
  overlay.className = 'dmf-lightbox-overlay';
  overlay.innerHTML = `
    <button class="dmf-lb-close" aria-label="Close">&times;</button>
    <button class="dmf-lb-btn dmf-lb-prev" aria-label="Previous">&#8592;</button>
    <div class="dmf-lightbox-img-wrap">
      <img src="" alt="" id="dmf-lb-img">
    </div>
    <div class="dmf-lightbox-caption" id="dmf-lb-caption"></div>
    <div class="dmf-lightbox-counter" id="dmf-lb-counter"></div>
    <button class="dmf-lb-btn dmf-lb-next" aria-label="Next">&#8594;</button>
  `;
  document.body.appendChild(overlay);

  const lbImg     = document.getElementById('dmf-lb-img');
  const lbCaption = document.getElementById('dmf-lb-caption');
  const lbCounter = document.getElementById('dmf-lb-counter');
  const btnClose  = overlay.querySelector('.dmf-lb-close');
  const btnPrev   = overlay.querySelector('.dmf-lb-prev');
  const btnNext   = overlay.querySelector('.dmf-lb-next');

  let items = [];   // [{src, alt}]
  let cur   = 0;

  function open(list, index) {
    items = list;
    cur   = index;
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    show(cur);
  }

  function close() {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    lbImg.src = '';
  }

  function show(idx) {
    cur = (idx + items.length) % items.length;
    lbImg.classList.add('fading');
    setTimeout(() => {
      lbImg.src = items[cur].src;
      lbImg.alt = items[cur].alt || '';
      lbCaption.textContent = items[cur].alt || '';
      lbCounter.textContent = items.length > 1 ? (cur + 1) + ' / ' + items.length : '';
      lbImg.classList.remove('fading');
    }, 180);
    btnPrev.classList.toggle('hidden', items.length <= 1);
    btnNext.classList.toggle('hidden', items.length <= 1);
  }

  // Collect items from a clicked link's gallery group
  function collectGroup(clicked) {
    const group = clicked.dataset.gallery;
    if (!group) return [{ src: clicked.href, alt: clicked.querySelector('img') ? clicked.querySelector('img').alt : '' }];
    const siblings = Array.from(document.querySelectorAll(`a[data-gallery="${group}"]`));
    return siblings.map(a => ({
      src: a.href,
      alt: a.querySelector('img') ? a.querySelector('img').alt : (a.dataset.caption || '')
    }));
  }

  function clickedIndex(clicked) {
    const group = clicked.dataset.gallery;
    if (!group) return 0;
    return Array.from(document.querySelectorAll(`a[data-gallery="${group}"]`)).indexOf(clicked);
  }

  // Intercept clicks on gallery links
  document.addEventListener('click', function (e) {
    const link = e.target.closest('a.gallery-item, a[data-gallery]');
    if (!link) return;
    // Only hijack links that point to an image
    if (!/\.(jpg|jpeg|png|gif|webp)(\?|$)/i.test(link.href)) return;
    e.preventDefault();
    const list = collectGroup(link);
    open(list, clickedIndex(link));
  });

  btnClose.addEventListener('click', close);
  btnPrev.addEventListener('click',  () => show(cur - 1));
  btnNext.addEventListener('click',  () => show(cur + 1));

  // Close on overlay backdrop click
  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) close();
  });

  // Keyboard nav
  document.addEventListener('keydown', function (e) {
    if (!overlay.classList.contains('active')) return;
    if (e.key === 'Escape')      close();
    if (e.key === 'ArrowLeft')   show(cur - 1);
    if (e.key === 'ArrowRight')  show(cur + 1);
  });

  // Touch swipe support
  let touchStartX = 0;
  overlay.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
  overlay.addEventListener('touchend',   e => {
    const dx = e.changedTouches[0].clientX - touchStartX;
    if (Math.abs(dx) > 50) show(cur + (dx < 0 ? 1 : -1));
  });

  // Tag all gallery-item links with data-gallery based on their parent section
  document.querySelectorAll('.gallery-grid, .orphanage-photo-grid').forEach((grid, gi) => {
    const gid = 'g' + gi;
    grid.querySelectorAll('a.gallery-item').forEach(a => {
      if (!a.dataset.gallery) a.dataset.gallery = gid;
    });
  });
})();

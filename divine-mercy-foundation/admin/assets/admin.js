/* Divine Mercy Foundation — Admin JS */

// Sidebar mobile toggle
const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebarClose  = document.getElementById('sidebar-close');
const adminSidebar  = document.getElementById('admin-sidebar');

if (sidebarToggle && adminSidebar) {
  sidebarToggle.addEventListener('click', () => {
    adminSidebar.classList.toggle('open');
  });
}
if (sidebarClose && adminSidebar) {
  sidebarClose.addEventListener('click', () => {
    adminSidebar.classList.remove('open');
  });
}

// Rich text editor for news-edit.php
const editorEl  = document.getElementById('editor');
const hiddenEl  = document.getElementById('content');
const toolbar   = document.querySelector('.editor-toolbar');

if (editorEl && hiddenEl && toolbar) {
  // Sync editor to hidden textarea on any input
  editorEl.addEventListener('input', () => {
    hiddenEl.value = editorEl.innerHTML;
  });

  // Sync before form submit
  editorEl.closest('form')?.addEventListener('submit', () => {
    hiddenEl.value = editorEl.innerHTML;
  });

  // Toolbar buttons
  toolbar.querySelectorAll('button[data-cmd]').forEach(btn => {
    btn.addEventListener('mousedown', (e) => {
      e.preventDefault(); // prevent focus loss
      const cmd = btn.dataset.cmd;
      if (cmd === 'h2' || cmd === 'h3') {
        document.execCommand('formatBlock', false, cmd);
      } else if (cmd === 'createLink') {
        const url = prompt('Enter URL:');
        if (url) document.execCommand('createLink', false, url);
      } else {
        document.execCommand(cmd);
      }
      editorEl.focus();
      hiddenEl.value = editorEl.innerHTML;
    });
  });
}

// Auto-dismiss flash messages after 5s
const alerts = document.querySelectorAll('.alert');
alerts.forEach(alert => {
  setTimeout(() => {
    alert.style.transition = 'opacity .4s';
    alert.style.opacity = '0';
    setTimeout(() => alert.remove(), 400);
  }, 5000);
});

// Confirm delete on all danger actions
document.querySelectorAll('[data-confirm]').forEach(el => {
  el.addEventListener('click', e => {
    if (!confirm(el.dataset.confirm)) e.preventDefault();
  });
});

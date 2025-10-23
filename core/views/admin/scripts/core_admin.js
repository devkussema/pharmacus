// Core Admin JS
(() => {
    const body = document.body;
    const toggleDarkBtn = document.getElementById('toggleDarkBtn');
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('coreSidebar');
    const overlay = document.getElementById('coreOverlay');

    // Dark mode persistence
    const darkKey = 'core_admin_dark_mode';
    if (localStorage.getItem(darkKey) === '1') body.classList.add('dark-mode');
    toggleDarkBtn?.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem(darkKey, body.classList.contains('dark-mode') ? '1' : '0');
    });

    // Sidebar persistence
    const sideKey = 'core_admin_sidebar_collapsed';
    if (localStorage.getItem(sideKey) === '1') sidebar.style.display = 'none';
    toggleSidebarBtn?.addEventListener('click', () => {
        if (sidebar.style.display === 'none') {
            sidebar.style.display = '';
            localStorage.setItem(sideKey, '0');
        } else {
            sidebar.style.display = 'none';
            localStorage.setItem(sideKey, '1');
        }
    });

    // Overlay helper
    window.coreOverlay = {
        show() { overlay && (overlay.style.display = 'flex'); },
        hide() { overlay && (overlay.style.display = 'none'); }
    };

    // fetch helper with overlay
    window.coreFetch = async (url, opts={}) => {
        try {
            window.coreOverlay.show();
            const res = await fetch(url, opts);
            const data = await res.json();
            return data;
        } finally {
            window.coreOverlay.hide();
        }
    };
})();

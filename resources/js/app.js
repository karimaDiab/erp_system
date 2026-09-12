import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('app-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const openBtn = document.getElementById('sidebar-open');
    const closeBtn = document.getElementById('sidebar-close');

    if (!sidebar || !overlay || !openBtn || !closeBtn) return;

    const openSidebar = () => {
        sidebar.classList.add('sidebar-open');
        overlay.classList.remove('hidden');
    };

    const closeSidebar = () => {
        sidebar.classList.remove('sidebar-open');
        overlay.classList.add('hidden');
    };

    openBtn.addEventListener('click', openSidebar);
    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
});

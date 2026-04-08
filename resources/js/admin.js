/* Wathba Admin JS */
document.addEventListener('DOMContentLoaded', () => {
    // Sidebar toggle on mobile
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.admin-sidebar');
    if (toggle && sidebar) {
        toggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    }
    // Auto-dismiss alerts
    document.querySelectorAll('.alert').forEach(a => {
        setTimeout(() => { a.style.opacity='0'; setTimeout(()=>a.remove(),400); }, 4000);
    });
    // Confirm deletes
    document.querySelectorAll('form[onsubmit]').forEach(f => {
        // already handled inline
    });
    // Tab switching (YAIN page)
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p=>{p.classList.add('hidden');p.classList.remove('active');});
            btn.classList.add('active');
            const panel = document.getElementById('tab-'+btn.dataset.tab);
            if (panel) { panel.classList.remove('hidden'); panel.classList.add('active'); }
        });
    });
    // Filter tabs (events/library/news pages)
    document.querySelectorAll('.filter-tab').forEach(btn => {
        btn.addEventListener('click', () => {
            const group = btn.closest('.filter-tabs');
            group.querySelectorAll('.filter-tab').forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            const gridId = group.dataset.grid;
            if (gridId) {
                document.querySelectorAll('#'+gridId+' [data-type], #'+gridId+' [data-category]').forEach(card => {
                    const val = card.dataset.type || card.dataset.category;
                    card.style.display = (filter==='all' || val===filter) ? '' : 'none';
                });
            }
        });
    });
    // Library search
    const libSearch = document.getElementById('libSearch');
    if (libSearch) {
        libSearch.addEventListener('input', () => {
            const q = libSearch.value.toLowerCase();
            document.querySelectorAll('.library-card').forEach(card => {
                card.style.display = card.dataset.title.includes(q) ? '' : 'none';
            });
        });
    }
});

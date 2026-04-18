(function() {
    "use strict";

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarClose = document.getElementById('sidebarClose');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', openSidebar);
    }
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar on window resize if screen becomes large
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            closeSidebar();
        }
    });

    // Image preview for add project page (if exists)
    const imageUpload = document.getElementById('imageUpload');
    if (imageUpload) {
        imageUpload.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            if (preview) {
                preview.innerHTML = '';
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });
    }
})();
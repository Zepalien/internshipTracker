<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
    :root {
        --bg-body: #f4fcf7; 
        --sidebar-bg: #112620; 
        --sidebar-text: #93a29e;
        --text-main: #0f172a;
        --card-bg: #ffffff;
        --border-accent: rgba(0, 0, 0, 0.04);
        --navbar-bg: transparent;
    }

    [data-bs-theme="dark"] {
        --bg-body: #050c09; 
        --sidebar-bg: #09120f; 
        --sidebar-text: #687f79;
        --text-main: #f1f5f9;
        --card-bg: #111f1a; 
        --border-accent: rgba(255, 255, 255, 0.03);
    }
   
    body { 
        font-family: 'Inter', 'Open Sans', sans-serif; 
        background: var(--bg-body); 
        color: var(--text-main); 
        transition: background 0.3s ease; 
        margin: 0;
        overflow-x: hidden;
    }

    #wrapper { display: flex; width: 100%; min-height: 100vh; position: relative; }

    /* --- SIDEBAR ENHANCEMENTS --- */
    #sidebar-wrapper {
        width: 260px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: var(--sidebar-bg) !important;
        color: #ffffff;
        z-index: 1000;
        transition: transform 0.3s ease;
    }

    .sidebar-heading {
        padding: 2rem 1.5rem;
        font-size: 1.1rem;
        letter-spacing: 2px;
        font-weight: 800;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .list-group-item {
        background: transparent !important;
        color: rgba(255, 255, 255, 0.6) !important;
        border: none !important;
        padding: 0.9rem 1.5rem !important;
        font-size: 0.9rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
    }

    .list-group-item:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.05) !important;
    }

    .list-group-item.active {
        background-color: var(--bg-body) !important; 
        color: #10b981 !important; 
        font-weight: 700;
        border-radius: 30px 0 0 30px !important;
        margin-left: 15px;
        box-shadow: -5px 5px 15px rgba(0,0,0,0.2);
        position: relative;
    }

    .list-group-item.active i {
        color: #10b981 !important;
    }

    /* --- CONTENT AREA REFINEMENT --- */
    #page-content-wrapper { 
        flex: 1; 
        margin-left: 260px; 
        width: calc(100% - 260px); 
        min-height: 100vh;
        transition: margin-left 0.3s ease, width 0.3s ease;
    }

    .navbar { 
        background: var(--navbar-bg) !important; 
        backdrop-filter: blur(10px); 
        padding: 1rem 2rem !important; 
    }

    .search-control {
        background: var(--card-bg) !important;
        color: var(--text-main) !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }

    /* --- TOGGLE STATES --- */
    #wrapper.toggled #sidebar-wrapper {
        transform: translateX(-260px);
    }

    #wrapper.toggled #page-content-wrapper {
        margin-left: 0;
        width: 100%;
    }

    /* Mobile handling */
    @media (max-width: 768px) {
        #sidebar-wrapper {
            transform: translateX(-260px);
        }
        #page-content-wrapper {
            margin-left: 0;
            width: 100%;
        }
        #wrapper.toggled #sidebar-wrapper {
            transform: translateX(0);
        }
        #wrapper.toggled #page-content-wrapper {
            margin-left: 0; /* Keep main content static on mobile when sidebar opens */
        }
    }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading d-flex justify-content-between align-items-center">
                <span><i class="bi bi-briefcase-fill me-2 text-success"></i>TRACKER</span>
            </div>
            
            <div class="px-4 py-4 text-center">
                <div class="rounded-circle bg-success bg-opacity-25 d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                    <i class="bi bi-person-fill text-success fs-3"></i>
                </div>
                <p class="small mb-0 fw-bold text-white">Aulya</p>
                <span class="badge bg-light text-dark fw-light" style="font-size: 0.6rem;">Info Management</span>
            </div>

            <div class="list-group list-group-flush mt-2">
                <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>" 
                   class="list-group-item <?= $this->request->getParam('controller') == 'Dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill me-3"></i>Dashboard
                </a>
                <a href="<?= $this->Url->build(['controller' => 'Applications', 'action' => 'index']) ?>" 
                   class="list-group-item <?= $this->request->getParam('controller') == 'Applications' ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-text me-3"></i>Applications
                </a>
                <a href="<?= $this->Url->build(['controller' => 'Documents', 'action' => 'index']) ?>" 
                   class="list-group-item <?= $this->request->getParam('controller') == 'Documents' ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-text me-3"></i>Documents
                </a>
            </div>

            <div class="position-absolute bottom-0 w-100 p-4 border-top border-white border-opacity-10">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="text-white-50 text-decoration-none small">
                    <i class="bi bi-power me-2"></i>Logout
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary border-0 rounded-circle" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    
                    <div class="search-wrapper d-none d-sm-block" style="width: 350px;">
                        <input class="form-control rounded-pill px-4 search-control shadow-sm" type="text" placeholder="Search (Ctrl + K)">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-link text-muted p-0" id="themeToggle">
                        <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                    </button>



                    <div class="position-relative d-inline-block">
    <button type="button" class="btn btn-link p-1 text-decoration-none" id="notificationBellBtn" title="View Notifications">
        <i class="bi bi-bell text-muted fs-5"></i>
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
    </button>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-bell-fill text-success me-2"></i>
            <strong class="me-auto">System Notification</strong>
            <small class="text-muted">Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            You have 1 new internship application status update!
        </div>
    </div>
</div>
                  
                </div>
            </nav>
            
            <main class="container-fluid px-4 pt-2">
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>

    <script>
        // Sidebar Toggle Logic
        const sidebarToggle = document.getElementById('sidebarToggle');
        const wrapper = document.getElementById('wrapper');

        // Check local storage for user's sidebar preference
        if (localStorage.getItem('sidebar-hidden') === 'true') {
            wrapper.classList.add('toggled');
        }

        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            wrapper.classList.toggle('toggled');
            // Store preference
            localStorage.setItem('sidebar-hidden', wrapper.classList.contains('toggled'));
        });

        // Theme Toggle Logic
        const btn = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        const html = document.documentElement;

        const updateThemeUI = (theme) => {
            html.setAttribute('data-bs-theme', theme);
            icon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
        };

        btn.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', newTheme);
            updateThemeUI(newTheme);
        });

        // Initialize theme on load
        const savedTheme = localStorage.getItem('theme') || 'light';
        updateThemeUI(savedTheme);

        document.addEventListener("DOMContentLoaded", function () {
    const bellBtn = document.getElementById('notificationBellBtn');
    const toastElement = document.getElementById('notificationToast');

    if (bellBtn && toastElement) {
        // Initialize the Bootstrap Toast instance
        const bootstrapToast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 5000 // Stays visible for 5 seconds before sliding out
        });

        // Trigger toast on bell icon click
        bellBtn.addEventListener('click', function () {
            bootstrapToast.show();
            
            // Optional Aesthetic Touch: Remove the red alert badge dot once viewed
            const badge = bellBtn.querySelector('.bg-danger');
            if (badge) {
                badge.remove();
            }
        });
    }
});
    </script>
</body>
</html>
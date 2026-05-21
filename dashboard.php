<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-body shadow-sm" id="sidebar-wrapper">
            <div class="sidebar-heading p-4 fw-bold text-success border-bottom">
                <i class="bi bi-briefcase-fill me-2"></i>TRACKER
            </div>
            <div class="list-group list-group-flush p-3">
                <h6 class="text-uppercase text-muted fw-bold mb-3 small">Main Menu</h6>
                <a href="#" class="list-group-item list-group-item-action active mb-1">
                    <i class="bi bi-grid-1x2-fill me-2"></i>Dashboard
                </a>
                <a href="applications.php" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-file-earmark-text me-2"></i>Applications
                </a>
                <a href="schedule.php" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-calendar-event me-2"></i>Schedule
                </a>
                
                <h6 class="text-uppercase text-muted fw-bold mt-4 mb-3 small">Account</h6>
                <a href="profile.php" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-person me-2"></i>Profile
                </a>
                <a href="settings.php" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-gear me-2"></i>Settings
                </a>
            </div>
        </div>

        <div id="page-content-wrapper" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg border-bottom bg-body py-2">
                <div class="container-fluid">
                    <button class="btn btn-link text-success me-3" id="sidebarToggle">
                        <i class="bi bi-list fs-3"></i>
                    </button>
                    
                    <div class="search-wrapper flex-grow-1 mx-2" style="max-width: 400px;">
                        <input class="form-control" type="text" class="search-input" placeholder="Search (Ctrl + K)">
                    </div>
                    <i class="bi bi-search text-muted"></i>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <button class="btn btn-link nav-link text-body p-0" id="darkModeToggle">
                            <i class="bi bi-moon-stars-fill" id="darkModeIcon"></i>
                        </button>

                        <span class="fw-semibold">Aulya</span>
                        <i class="bi bi-person-circle fs-4 text-success"></i>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-0">Overview</h2>
                        <p class="text-muted">Welcome back, Aulya!</p>
                    </div>
                    <button class="btn btn-success rounded-pill px-4">
                        <?= $this->Html->link(
    '<i class="bi bi-plus-lg me-2"></i>Add New', 
    ['controller' => 'Applications', 'action' => 'add'], 
    [
        'class' => 'btn btn-success rounded-pill px-4', 
        'escape' => false
    ]
) ?>
                    </button>
                </div>
                <div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100 bg-success text-white">
            <div class="card-body">
                <h6 class="small fw-bold opacity-75">TOTAL APPLIED</h6>
                <h2 class="fw-bold mb-0">12</h2>
                <i class="bi bi-send fs-1 position-absolute end-0 bottom-0 m-3 opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100 bg-body">
            <div class="card-body">
                <h6 class="text-muted small fw-bold">INTERVIEWS</h6>
                <h2 class="fw-bold mb-0">3</h2>
                <i class="bi bi-chat-dots fs-1 position-absolute end-0 bottom-0 m-3 text-success opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100 bg-body border-start border-success border-4">
            <div class="card-body">
                <h6 class="text-success small fw-bold">OFFERS RECEIVED</h6>
                <h2 class="fw-bold mb-0 text-success">2</h2>
                <i class="bi bi-check-circle fs-1 position-absolute end-0 bottom-0 m-3 text-success opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100 bg-body">
            <div class="card-body">
                <h6 class="text-muted small fw-bold">PENDING</h6>
                <h2 class="fw-bold mb-0">7</h2>
                <i class="bi bi-hourglass-split fs-1 position-absolute end-0 bottom-0 m-3 text-warning opacity-25"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 bg-body h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Recent Applications</h5>
                    <a href="applications.php" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Company</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Telekom Malaysia (TM)</strong></td>
                                <td class="small">IT Intern</td>
                                <td><span class="badge bg-warning text-dark">Interview</span></td>
                                <td><button class="btn btn-sm btn-light border"><i class="bi bi-eye"></i></button></td>
                            </tr>
                            <tr>
                                <td><strong>Petronas Digital</strong></td>
                                <td class="small">Systems Admin</td>
                                <td><span class="badge bg-success">Offered</span></td>
                                <td><button class="btn btn-sm btn-light border"><i class="bi bi-eye"></i></button></td>
                            </tr>
                            <tr>
                                <td><strong>Shopee Malaysia</strong></td>
                                <td class="small">Backend Dev</td>
                                <td><span class="badge bg-secondary">Applied</span></td>
                                <td><button class="btn btn-sm btn-light border"><i class="bi bi-eye"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 bg-body mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Quick Documents</h5>
                <div class="list-group list-group-flush">
                    <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-file-earmark-pdf text-danger me-2"></i>Updated_Resume.pdf</span>
                        <i class="bi bi-download text-muted"></i>
                    </button>
                    <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-file-earmark-word text-primary me-2"></i>Cover_Letter.docx</span>
                        <i class="bi bi-download text-muted"></i>
                    </button>
                    <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                        <span><i class="bi bi-link-45deg text-success me-2"></i>Github Portfolio</span>
                        <i class="bi bi-box-arrow-up-right text-muted"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body">
                <h6 class="fw-bold mb-2 small"><i class="bi bi-lightbulb me-2"></i>Career Tip</h6>
                <p class="small mb-0">Sentiasa susun resume anda mengikut kehendak jawatan syarikat yang dipohon (Customized Resume).</p>
            </div>
        </div>
    </div>
</div>
                
                </div>
        </div>
        
    </div>
    
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>document.addEventListener('DOMContentLoaded', () => {
    // 1. Sidebar Toggle Logic
    const wrapper = document.getElementById('wrapper');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', (e) => {
            e.preventDefault();
            wrapper.classList.toggle('toggled');
        });
    }

    // 2. Dark Mode Logic
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const htmlElement = document.documentElement;

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            // Tukar tema pada tag <html>
            htmlElement.setAttribute('data-bs-theme', newTheme);
            
            // Tukar ikon matahari/bulan
            if (newTheme === 'dark') {
                darkModeIcon.className = 'bi bi-sun-fill';
            } else {
                darkModeIcon.className = 'bi bi-moon-stars-fill';
            }
        });
    }
});
</script>
<script src="js/dashboard.js"></script>

</body>
</html>
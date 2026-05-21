<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    .flip-card-perspective {
        perspective: 1000px;
        background-color: transparent;
        /* Aligned precisely to match the native content-height threshold of the right container */
        min-height: 185px; 
    }
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: left;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
    }
    
    .flip-card-inner.is-flipped {
        transform: rotateY(180deg);
    }
    
    .flip-card-front, .flip-card-back {
        position: relative;
        width: 100%;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
    .flip-card-back {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        transform: rotateY(180deg);
        z-index: 2;
    }
    .framework-matrix p {
        font-size: 0.74rem !important;
        line-height: 1.45 !important;
    }

    /* THEME VARIABLES AND THEMED OVERRIDES FOR THE SIMULATOR */
    :root, [data-bs-theme="light"] {
        --text-simulator-muted: #6c757d; 
        --text-simulator-white-50: rgba(33, 37, 41, 0.75); 
        --text-simulator-highlight: #10b981; 
        --card-simulator-bg-light-grad-start: #ffffff;
        --card-simulator-bg-light-grad-end: #f8fafc;
        --card-simulator-border-light: 1px solid rgba(0,0,0,0.08);
        --box-simulator-bg-light: rgba(0, 0, 0, 0.025);
        --box-simulator-border-light: 1px solid rgba(0, 0, 0, 0.04);
    }

    [data-bs-theme="dark"] {
        --text-simulator-muted: #adb5bd; 
        --text-simulator-white-50: rgba(255, 255, 255, 0.65); 
        --text-simulator-highlight: #10b981; 
        --card-simulator-bg-dark-grad-start: #061c16;
        --card-simulator-bg-dark-grad-end: #020705;
        --card-simulator-border-dark: 1px solid rgba(16, 185, 129, 0.15);
        --box-simulator-bg-dark: rgba(255, 255, 255, 0.03);
        --box-simulator-border-dark: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Fallbacks linked to master themes */
    [data-bs-theme="light"] .sim-card-front,
    [data-bs-theme="light"] .sim-card-back {
        background: var(--bs-card-bg, #ffffff) !important;
        border: 1px solid var(--bs-card-border-color, rgba(0,0,0,0.125)) !important;
    }
    [data-bs-theme="dark"] .sim-card-front,
    [data-bs-theme="dark"] .sim-card-back {
        background: linear-gradient(135deg, var(--card-simulator-bg-dark-grad-start) 0%, var(--card-simulator-bg-dark-grad-end) 100%) !important;
        border: var(--card-simulator-border-dark) !important;
    }

    /* Content Box Theming */
    [data-bs-theme="light"] .sim-content-box {
        background-color: var(--box-simulator-bg-light) !important;
        border: var(--box-simulator-border-light) !important;
    }
    [data-bs-theme="dark"] .sim-content-box {
        background-color: var(--box-simulator-bg-dark) !important;
        border: var(--box-simulator-border-dark) !important;
    }
</style>

<?php
/**
 * DIAGNOSTIC FALLBACK PROTECTION LAYER
 */
if (!isset($upcomingInterviews) || empty($upcomingInterviews)) {
    try {
        $applicationsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Applications');
        $upcomingInterviews = $applicationsTable->find('all')
            ->where(['status' => 2])
            ->order(['interview_date' => 'ASC'])
            ->toArray();
    } catch (\Exception $e) {
        $upcomingInterviews = [];
    }
}

$isCarousel = count($upcomingInterviews) > 1; 
?>

<div class="container-fluid py-2 px-1">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down" data-aos-duration="600">
        <div>
            <h1 class="fw-bold tracking-tight mb-1" style="color: var(--text-main); font-size: 1.85rem; font-weight: 800;">Overview</h1>
            <p class="text-muted small mb-0">Welcome back, <span class="text-success fw-semibold">Aulya</span>. Here is your dashboard breakdown.</p>
        </div>
        <div>
            <?= $this->Html->link(__('<i class="bi bi-plus-lg me-2"></i>New Application'), ['controller' => 'Applications', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-success shadow-sm rounded-pill px-4 py-2 fw-semibold small', 'style' => 'font-size: 0.8rem; background: #10b981; border: none;']) ?>
        </div>
    </div>

    <?php if (!empty($upcomingInterviews)): ?>
        <div id="interviewCarousel" class="carousel slide mb-4" <?= $isCarousel ? 'data-bs-ride="carousel" data-bs-interval="6000"' : '' ?> style="min-height: 220px; clear: both; display: block; overflow: visible !important;">
            
            <?php if ($isCarousel): ?>
                <div class="carousel-indicators mb-3" style="z-index: 5;">
                    <?php foreach ($upcomingInterviews as $index => $interview): ?>
                        <button type="button" data-bs-target="#interviewCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>" style="width: 8px; height: 8px; border-radius: 50%; margin: 0 4px;"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="carousel-inner" style="overflow: visible !important; display: block; width: 100%;">
                <?php foreach ($upcomingInterviews as $index => $interview): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" style="transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out; float: left; width: 100%; <?= $index === 0 ? 'display: block !important;' : '' ?>">
                        <div class="card card-container-premium border-0 rounded-4 text-white w-100" 
                             style="background: linear-gradient(135deg, #061c16 0%, #020705 100%); border: 1px solid rgba(16, 185, 129, 0.15) !important; position: relative; display: block; overflow: hidden;" 
                             data-aos="zoom-in-up" data-aos-duration="750" data-aos-timing-function="cubic-bezier(0.34, 1.56, 0.64, 1)">
                            
                            <div class="position-absolute" style="width: 350px; height: 350px; background: radial-gradient(circle, rgba(16, 185, 129, 0.18) 0%, rgba(0,0,0,0) 70%); right: -50px; top: -50px; pointer-events: none;"></div>

                            <div class="card-body p-4 p-md-5 position-relative">
                                <div class="position-absolute end-0 top-0 p-5 opacity-10 d-none d-lg-block" style="transform: translate(-10%, 15%) scale(1.1); transition: transform 0.5s ease;">
                                    <i class="bi bi-rocket-takeoff-fill" style="font-size: 9rem; color: #10b981;"></i>
                                </div>

                                <div class="row align-items-center position-relative">
                                    <div class="col-md-8">
                                        <span class="badge mb-3 rounded-pill px-3 py-2 fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1.5px; background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2);">
                                            Upcoming Interview <?= $isCarousel ? '('.($index + 1).'/'.count($upcomingInterviews).')' : '' ?>
                                        </span>
                                        <h2 class="fw-extrabold mb-1 text-white" style="font-size: 2.6rem; font-weight: 800; letter-spacing: -0.5px;"><?= h($interview->company_name) ?></h2>
                                        <p class="text-white-50 fw-medium mb-4 small">
                                            <i class="bi bi-briefcase me-2 text-success"></i><?= h($interview->role) ?>
                                            <span class="mx-3 opacity-20">|</span>
                                            <i class="bi bi-geo-alt me-1 text-white-50"></i> <?= h($interview->interview_location) ?>
                                        </p>
                                        
                                        <div class="d-flex gap-3 mt-4">
                                            <a href="#toolkit-section" class="btn btn-success rounded-pill px-4 py-2 fw-semibold small shadow-sm" style="background: #10b981; border: none; font-size: 0.8rem;">Start Preparation</a>
                                            <?= $this->Html->link(__('View Details'), ['controller' => 'Applications', 'action' => 'view', $interview->id], ['class' => 'btn btn-outline-light rounded-pill px-4 py-2 small fw-semibold', 'style' => 'border-color: rgba(255,255,255,0.15); font-size: 0.8rem;']) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 text-center d-none d-md-block position-relative">
                                        <div class="d-flex justify-content-center gap-2">
                                            <div class="card bg-black bg-opacity-30 border-0 p-3 rounded-4 min-w-80" style="backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.03) !important;">
                                                <i class="bi bi-calendar3 text-success mb-2 fs-4"></i>
                                                <div class="small fw-bold tracking-wide text-uppercase text-white-50" style="font-size: 0.55rem;">Date</div>
                                                <div class="fw-bold small text-white mt-1">
                                                    <?= !empty($interview->interview_date) ? $interview->interview_date->format('M d, Y') : 'TBD' ?>
                                                </div>
                                            </div>
                                            <div class="card bg-black bg-opacity-30 border-0 p-3 rounded-4 min-w-80" style="backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.03) !important;">
                                                <i class="bi bi-clock-history text-warning mb-2 fs-4"></i>
                                                <div class="small fw-bold tracking-wide text-uppercase text-white-50" style="font-size: 0.55rem;">Time</div>
                                                <div class="fw-bold small text-white mt-1">
                                                    <?= !empty($interview->interview_date) ? $interview->interview_date->format('h:i A') : 'TBD' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($isCarousel): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#interviewCarousel" data-bs-slide="prev" style="width: 5%; justify-content: flex-start; left: -25px; z-index: 10;">
                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-dark bg-opacity-75 shadow" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.1);"><i class="bi bi-chevron-left text-white fs-6"></i></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#interviewCarousel" data-bs-slide="next" style="width: 5%; justify-content: flex-end; right: -25px; z-index: 10;">
                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-dark bg-opacity-75 shadow" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.1);"><i class="bi bi-chevron-right text-white fs-6"></i></span>
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3" data-aos="zoom-in-up" data-aos-delay="50" data-aos-duration="600">
            <div class="card card-stat-clean stat-applied border-0">
                <div class="card-body d-flex align-items-center justify-content-between p-3 p-md-4">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Total Applied</p>
                        <h3 class="fw-bold mb-0" style="color: var(--text-main); font-size: 2rem; font-weight: 800;"><?= isset($totalApplied) ? $totalApplied : '28' ?></h3>
                    </div>
                    <div class="icon-box"><i class="bi bi-send-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="600">
            <div class="card card-stat-clean stat-interviews border-0">
                <div class="card-body d-flex align-items-center justify-content-between p-3 p-md-4">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Interviews</p>
                        <h3 class="fw-bold mb-0" style="color: var(--text-main); font-size: 2rem; font-weight: 800;"><?= isset($totalInterviews) ? $totalInterviews : count($upcomingInterviews) ?></h3>
                    </div>
                    <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3" data-aos="zoom-in-up" data-aos-delay="150" data-aos-duration="600">
            <div class="card card-stat-clean stat-offers border-0">
                <div class="card-body d-flex align-items-center justify-content-between p-3 p-md-4">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Offers</p>
                        <h3 class="fw-bold mb-0" style="color: var(--text-main); font-size: 2rem; font-weight: 800;"><?= isset($totalOffers) ? $totalOffers : '1' ?></h3>
                    </div>
                    <div class="icon-box"><i class="bi bi-patch-check-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3" data-aos="zoom-in-up" data-aos-delay="200" data-aos-duration="600">
            <div class="card card-stat-clean stat-documents border-0">
                <div class="card-body d-flex align-items-center justify-content-between p-3 p-md-4">
                    <div>
                        <p class="text-muted mb-1 small fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Documents</p>
                        <h3 class="fw-bold mb-0" style="color: var(--text-main); font-size: 2rem; font-weight: 800;"><?= isset($totalDocuments) ? $totalDocuments : '2' ?></h3>
                    </div>
                    <div class="icon-box"><i class="bi bi-file-earmark-text-fill"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4" id="toolkit-section">
        <div class="col-lg-7" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="700">
            
            <div class="card card-container-premium rounded-4 mb-4 border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Preparation Toolkit</h5>
                </div>
                <div class="card-body pt-1 px-4 pb-4">
                    <div class="d-flex align-items-center justify-content-between p-3 mb-2 rounded-4 list-item-clean position-relative">
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-primary p-2 rounded-3 bg-primary bg-opacity-10 d-flex"><i class="bi bi-github fs-5"></i></div>
                            <div>
                                <h6 class="mb-0 fw-semibold" style="color: var(--text-main); font-size: 0.9rem;">Update Technical Portfolio</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Link your best active live projects</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" style="font-size: 0.75rem; position: relative; z-index: 2;">
                            Review
                            <a href="https://github.com/Zepalien" target="_blank" class="stretched-link"></a>
                        </button>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-3 mb-0 rounded-4 list-item-clean position-relative">
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-success p-2 rounded-3 bg-success bg-opacity-10 d-flex"><i class="bi bi-file-person fs-5"></i></div>
                            <div>
                                <h6 class="mb-0 fw-semibold" style="color: var(--text-main); font-size: 0.9rem;">Review Resume & CV</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Check active contact details</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" style="font-size: 0.75rem; position: relative; z-index: 2;">
                            View
                            <a href="<?= $this->Url->build(['controller' => 'Documents', 'action' => 'index']) ?>" class="stretched-link"></a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="card card-container-premium rounded-4 overflow-hidden mb-4 border-0" data-aos="zoom-in-up" data-aos-delay="200" data-aos-duration="700">
                <div class="card-header bg-transparent border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Recent Applications</h5>
                    <?= $this->Html->link(__('View All'), ['controller' => 'Applications', 'action' => 'index'], ['class' => 'text-muted small text-decoration-none fw-medium']) ?>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Company</th>
                                <th>Role</th>
                                <th class="text-end pe-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (!empty($recentApplications)): ?>
                                <?php foreach ($recentApplications as $app): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold bg-success bg-opacity-10 text-success" style="width: 36px; height: 36px; font-size: 0.8rem; border: 1px solid rgba(16, 185, 129, 0.15);">
                                                <?= strtoupper(substr(h($app->company_name), 0, 1)) ?>
                                            </div>
                                            <span class="fw-semibold" style="color: var(--text-main); font-size: 0.9rem;"><?= h($app->company_name) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-muted" style="font-size: 0.85rem;"><?= h($app->role) ?></td>
                                    <td class="text-end pe-4">
                                        <?php 
                                            switch($app->status) {
                                                case 1: echo '<span class="badge bg-success-subtle text-success rounded-pill fw-bold px-3 py-2" style="font-size: 0.65rem; border: 1px solid rgba(25,135,84,0.15);">Offer</span>'; break;
                                                case 2: echo '<span class="badge bg-warning-subtle text-warning rounded-pill fw-bold px-3 py-2" style="font-size: 0.65rem; border: 1px solid rgba(255,193,7,0.15);">Interview</span>'; break;
                                                case 3: echo '<span class="badge bg-danger-subtle text-danger rounded-pill fw-bold px-3 py-2" style="font-size: 0.65rem; border: 1px solid rgba(220,53,69,0.15);">Rejected</span>'; break;
                                                default: echo '<span class="badge bg-primary-subtle text-primary rounded-pill fw-bold px-3 py-2" style="font-size: 0.65rem; border: 1px solid rgba(13,110,253,0.15);">Applied</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php if (!empty($upcomingInterviews)): ?>
                                    <?php foreach (array_slice($upcomingInterviews, 0, 3) as $app): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold bg-success bg-opacity-10 text-success" style="width: 36px; height: 36px; font-size: 0.8rem; border: 1px solid rgba(16, 185, 129, 0.15);">
                                                    <?= strtoupper(substr(h($app->company_name), 0, 1)) ?>
                                                </div>
                                                <span class="fw-semibold" style="color: var(--text-main); font-size: 0.9rem;"><?= h($app->company_name) ?></span>
                                            </div>
                                        </td>
                                        <td class="text-muted" style="font-size: 0.85rem;"><?= h($app->role) ?></td>
                                        <td class="text-end pe-4"><span class="badge bg-warning-subtle text-warning rounded-pill fw-bold px-3 py-2" style="font-size: 0.65rem; border: 1px solid rgba(255,193,7,0.15);">Interview</span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted small">No recent applications found.</td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-container-premium rounded-4 border-0 mb-4" data-aos="zoom-in-up" data-aos-delay="220" data-aos-duration="700">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-1 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-0" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Corporate Internship Target Tracker</h5>
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">Live market capitalization metrics</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1.5 small fw-bold" style="font-size: 0.65rem; border: 1px solid rgba(16, 185, 129, 0.15); position: relative; z-index: 2;">
                        <i class="bi bi-graph-up-arrow me-1"></i> Live Market Index
                        <a href="https://companiesmarketcap.com/malaysia/largest-companies-in-malaysia-by-market-cap/" target="_blank" class="stretched-link"></a>
                    </span>
                </div>
                <div class="card-body px-4 pb-4 pt-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-7 position-relative" style="height: 140px;">
                            <canvas id="marketLiveBarChart"></canvas>
                            <div id="chart-loading-spinner" class="text-muted small py-2 position-absolute top-50 start-50 translate-middle w-100 text-center">
                                <span class="spinner-border spinner-border-sm me-2 text-success"></span>Streaming index values...
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="h-100 p-3 rounded-4 bg-success bg-opacity-5 d-flex flex-column justify-content-between" style="border: 1px dashed rgba(16, 185, 129, 0.2); min-height: 125px;">
                                <div>
                                    <span class="text-uppercase text-success fw-bold d-block mb-1" style="font-size: 0.55rem; letter-spacing: 1.5px;">Strategic Insight</span>
                                    <h6 class="fw-bold mb-1" style="color: var(--text-main); font-size: 0.82rem;"><i class="bi bi-lightning-charge-fill text-warning me-1"></i>Live Data Synchronization</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.7rem; line-height: 1.4;">Tracking top-tier capitalization anchors helps align preparation with market demand.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flip-card-perspective mb-4" data-aos="zoom-in-up" data-aos-delay="240" data-aos-duration="700">
                <div class="flip-card-inner" id="interactiveFlipElement">
                    
                    <div class="flip-card-front">
                        <div class="card card-container-premium rounded-4 sim-card-front shadow-sm" style="min-height: 185px; border: var(--bs-card-border-color) !important;">
                            <div class="card-body p-3 d-flex flex-column justify-content-between" style="min-height: 185px;">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h5 class="fw-bold mb-0" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Prep Simulator</h5>
                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-0.5 small fw-bold" id="questionNumberBadge" style="font-size: 0.6rem;">
                                           Question 1 / 13
                                        </span>
                                    </div>
                                    <p class="small mb-2" style="color: var(--text-muted); font-size: 0.72rem;">Controlled Toggle</p>

                                    <div class="p-2 rounded-3 sim-content-box mb-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-uppercase text-danger fw-bold" style="font-size: 0.55rem; letter-spacing: 0.5px;">What they ask</span>
                                            <span class="small" style="font-size: 0.6rem; color: var(--text-muted);"><i class="bi bi-shield-check text-success me-1"></i>Reeracoen Guide</span>
                                        </div>
                                        <h6 class="fw-bold mb-1" id="frontQuestionBox" style="color: var(--text-main); font-size: 0.85rem; line-height: 1.35;">
                                            1. Tell me about yourself.
                                        </h6>
                                        <p class="small mb-0" id="frontContextBox" style="font-size: 0.74rem; line-height: 1.3; color: var(--text-simulator-white-50);">
                                            A brief summary of your professional background.
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center px-1">
                                    <button class="btn btn-sm btn-success rounded-pill px-3 py-1 fw-bold" onclick="toggleFlipState();" style="font-size: 0.7rem; background-color: #10b981; border: none;">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Flip
                                    </button>
                                    <button class="btn btn-sm btn-link text-success p-0 small text-decoration-none fw-bold" onclick="cycleNextQuestion();" style="font-size: 0.75rem;">
                                        Next <i class="bi bi-arrow-right ms-0.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flip-card-back w-100">
                        <div class="card card-container-premium rounded-4 sim-card-back shadow-sm h-100" style="min-height: 185px;">
                            <div class="card-body p-3 d-flex flex-column justify-content-between h-100" style="min-height: 185px;">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h5 class="text-success fw-bold mb-0" style="font-size: 1.05rem; font-weight: 700;"><i class="bi bi-lightning-charge-fill me-1"></i>Answer Guide</h5>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-0.5 small fw-bold" id="backStrategyBadge" style="font-size: 0.6rem;">STAR Alignment</span>
                                    </div>
                                    <p class="small mb-2" id="backInstructionBox" style="font-size: 0.72rem; color: var(--text-muted);">Highlight relevant experience and goals.</p>
                                    
                                    <div class="framework-matrix p-2 rounded-3 mb-0 sim-content-box" style="font-size: 0.74rem; line-height: 1.35;">
                                        <div class="mb-1" style="color: var(--text-main);"><strong class="text-danger">Avoid:</strong> <span id="backAvoidBox" style="color: var(--text-simulator-white-50);">“I like cooking and watching Netflix.”</span></div>
                                        <div style="color: var(--text-main);"><strong class="text-success">Example:</strong> <span id="backExampleBox" style="color: var(--text-simulator-white-50);">"I'm a finance graduate with two years experience..."</span></div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center px-1">
                                    <button class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-bold" onclick="toggleFlipState();" style="font-size: 0.7rem;">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Back
                                    </button>
                                    <button class="btn btn-sm btn-link text-success p-0 small text-decoration-none fw-bold" onclick="cycleNextQuestion();" style="font-size: 0.75rem;">
                                        Next <i class="bi bi-arrow-right ms-0.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-5">
            <div class="card card-container-premium rounded-4 mb-4 border-0" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="700">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Interview Readiness Score</h5>
                    <p class="text-muted small mb-4">Core professional matrix parameters</p>
                    <div style="height: 200px; position: relative;">
                        <canvas id="readinessRadarChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card card-container-premium rounded-4 mb-4 border-0" data-aos="zoom-in-up" data-aos-delay="150" data-aos-duration="700">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Corporate Intake Status</h5>
                    <p class="text-muted small mb-3">Program placement distribution channels</p>
                    <div style="height: 175px; position: relative;">
                        <canvas id="corporateIntakeChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card card-container-premium rounded-4 border-0 mb-4" data-aos="zoom-in-up" data-aos-delay="200" data-aos-duration="700">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h5 class="fw-bold mb-0" style="color: var(--text-main); font-size: 1.1rem; font-weight: 700;">Document Checklist</h5>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 small fw-bold" style="font-size: 0.65rem;">
                           <i class="bi bi-folder-check me-1"></i> Requirements
                        </span>
                    </div>
                    <p class="text-muted small mb-3">Required documents before application and interview sessions</p>

                    <?php if (!empty($upcomingInterviews)): ?>
                        <?php $activeCompany = $upcomingInterviews[0]; ?>
                        <div class="p-3 rounded-4 mb-3" style="background: rgba(16, 185, 129, 0.04); border: 1px solid rgba(16, 185, 129, 0.1); border-color: var(--bs-border-color);">
                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.55rem; letter-spacing: 0.5px;">Target Company</small>
                            <span class="fw-bold text-success" style="font-size: 0.95rem;">
                                <i class="bi bi-building me-1.5"></i><?= h($activeCompany->company_name) ?> 
                            </span>
                            <span class="text-muted small">─ <?= h($activeCompany->role) ?></span>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check d-flex align-items-center justify-content-between p-3 rounded-4 list-item-clean m-0" style="border: 1px solid var(--border-accent);">
                                <div class="d-flex align-items-center gap-2">
                                    <input class="form-check-input text-success m-0 custom-checkbox" type="checkbox" id="docResume" checked style="width: 18px; height: 18px; cursor: pointer;">
                                    <label class="form-check-label fw-semibold small ms-1" for="docResume" style="color: var(--text-main); cursor: pointer;">Updated Resume / CV</label>
                                </div>
                                <span class="badge bg-success-subtle text-success rounded-pill fw-bold" style="font-size: 0.6rem;">Ready</span>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-between p-3 rounded-4 list-item-clean m-0" style="border: 1px solid var(--border-accent);">
                                <div class="d-flex align-items-center gap-2">
                                    <input class="form-check-input text-success m-0 custom-checkbox" type="checkbox" id="docTranscript" checked style="width: 18px; height: 18px; cursor: pointer;">
                                    <label class="form-check-label fw-semibold small ms-1" for="docTranscript" style="color: var(--text-main); cursor: pointer;">Latest Academic Transcript</label>
                                </div>
                                <span class="badge bg-success-subtle text-success rounded-pill fw-bold" style="font-size: 0.6rem;">Ready</span>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-between p-3 rounded-4 list-item-clean m-0" style="border: 1px solid var(--border-accent);">
                                <div class="d-flex align-items-center gap-2">
                                    <input class="form-check-input text-success m-0 custom-checkbox" type="checkbox" id="docCoverLetter" style="width: 18px; height: 18px; cursor: pointer;">
                                    <label class="form-check-label fw-semibold small ms-1" for="docCoverLetter" style="color: var(--text-main); cursor: pointer;">Internship Cover Letter</label>
                                </div>
                                <span class="badge bg-warning-subtle text-warning rounded-pill fw-bold" style="font-size: 0.6rem;">Pending</span>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-between p-3 rounded-4 list-item-clean m-0" style="border: 1px solid var(--border-accent);">
                                <div class="d-flex align-items-center gap-2">
                                    <input class="form-check-input text-success m-0 custom-checkbox" type="checkbox" id="docUniLetter" style="width: 18px; height: 18px; cursor: pointer;">
                                    <label class="form-check-label fw-semibold small ms-1" for="docUniLetter" style="color: var(--text-main); cursor: pointer;">University Confirmation Letter</label>
                                </div>
                                <span class="badge bg-danger-subtle text-danger rounded-pill fw-bold" style="font-size: 0.6rem;">Missing</span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-folder-x d-block mb-2 opacity-40 fs-4"></i> Please add an active application layout checklist parameters.
                        </div>
                    <?php endif; ?>

                    <div class="mt-3 pt-3 border-top border-black border-opacity-5">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="text-success p-1.5 rounded-3 bg-success bg-opacity-5 border border-success border-opacity-10 d-flex"><i class="bi bi-file-earmark-check-fill fs-6"></i></div>
                                <span class="text-uppercase text-success fw-bold" style="font-size: 0.55rem; letter-spacing: 1px;">Preparation Progress</span>
                            </div>
                            <span class="fw-bold text-success small" style="font-size: 0.75rem;">2 / 4 Complete</span>
                        </div>
                        <div class="progress rounded-pill bg-black bg-opacity-10" style="height: 7px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill bg-success" role="progressbar" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    AOS.init({ 
        duration: 700, 
        once: false, 
        offset: 15,
        mirror: true,
        easing: 'cubic-bezier(0.34, 1.56, 0.64, 1)'
    });

    // DATA MATRIX: 13 REERACOEN QUESTIONS
    const reeracoenQuestions = [
        {
            num: "1 / 13",
            question: "1. Tell me about yourself.",
            ask: "A brief summary of your professional background.",
            strategy: "Experience & Focus",
            how: "Highlight your most relevant experience, skills, and goals.",
            avoid: "“I'm 25 years old, I like cooking and watching Netflix.”",
            example: "“I'm a finance graduate with two years of experience as an accounts executive, handling monthly reports, audits, and budgeting. I enjoy working with data and am now looking to grow in a role that allows me to deepen my expertise in financial planning.”"
        },
        {
            num: "2 / 13",
            question: "2. Why do you want to work here?",
            ask: "Why you're interested in this company.",
            strategy: "Company Value Fit",
            how: "Show knowledge of the company's values, culture, or projects.",
            avoid: "“Because I need a job” or “The salary is high.”",
            example: "“I'm impressed by your company's innovation in digital solutions and your focus on employee development. I'd love to contribute to a forward-thinking team that values both performance and learning.”"
        },
        {
            num: "3 / 13",
            question: "3. What are your strengths?",
            ask: "Skills that make you a strong candidate.",
            strategy: "Value Proposition",
            how: "Pick 2–3 relevant strengths with concrete workspace examples.",
            avoid: "“I'm perfect at everything” or vague claims without proof.",
            example: "“One of my key strengths is adaptability. In my previous role, I quickly adjusted to a new CRM system and trained others within a week. I'm also highly detail-oriented, especially when managing data or reports.”"
        },
        {
            num: "4 / 13",
            question: "4. What is your biggest weakness?",
            ask: "A test of self-awareness and growth mindset.",
            strategy: "Growth Mindset",
            how: "Share a real workspace weakness and explain the steps you are taking to improve it.",
            avoid: "“I work too hard” or “I don't have any weaknesses.”",
            example: "“I used to struggle with public speaking, but I've joined internal training sessions and volunteered for team presentations to build confidence.”"
        },
        {
            num: "5 / 13",
            question: "5. Why did you leave your last job?",
            ask: "Understand your career trajectory changes.",
            strategy: "Professional Pivot",
            how: "Be constructive and honest. Focus entirely on future growth and learning paths.",
            avoid: "Speaking negatively about your former manager or teammates.",
            example: "“I'm grateful for my previous role, but I'm looking for more challenging opportunities in a company that supports long-term career development.”"
        },
        {
            num: "6 / 13",
            question: "6. What are your salary expectations?",
            ask: "Check if expectations align with their budget limits.",
            strategy: "Market Standards",
            how: "Provide a realistic salary range backed by industry market research.",
            avoid: "“Whatever you can give” or naming an unverified high budget without justification.",
            example: "“Based on my technical skills and current Malaysian market data, I believe a range between RM3,000 to RM3,500 would be fair for this position.”"
        },
        {
            num: "7 / 13",
            question: "7. Describe a challenge you faced and how you handled it.",
            ask: "Your critical problem-solving capabilities.",
            strategy: "STAR Framework Alignment",
            how: "Structure clearly using the STAR method (Situation, Task, Action, Result).",
            avoid: "Stories with no clear resolution outcome or blame-shifting.",
            example: "“In my previous role, our system crashed before a product launch (Situation). I coordinated with the IT team (Action) and we resolved the issue in 2 hours, ensuring the launch went smoothly (Result).”"
        },
        {
            num: "8 / 13",
            question: "8. What motivates you?",
            ask: "Understand what drives your consistent performance.",
            strategy: "Core Drivers",
            how: "Focus on meaningful indicators like skill optimization, achievements, or group purpose.",
            avoid: "“Money only” or stating “I don't really know.”",
            example: "“I'm motivated by continuous learning and seeing how my work impacts the company. I enjoy setting goals and exceeding them.”"
        },
        {
            num: "9 / 13",
            question: "9. Where do you see yourself in 5 years?",
            ask: "Your career vision and internal alignment.",
            strategy: "Long-term Vision",
            how: "Show strategic ambition that runs parallel to the company's growth trajectory.",
            avoid: "“I want to be in another company” or “I haven't thought about it.”",
            example: "“In five years, I hope to have advanced into a senior marketing role, mentoring others and leading larger campaigns.”"
        },
        {
            num: "10 / 13",
            question: "10. How do you handle stress or pressure?",
            ask: "Your functional emotional resilience.",
            strategy: "Resilience Matrix",
            how: "Share proactive stress reduction frameworks alongside real workspace examples.",
            avoid: "“I don't get stressed” or admitting “I panic immediately.”",
            example: "“I ruthlessly prioritize structural tasks and take brief mental breaks to stay focused. During peak cycles, I communicate early with my team to guarantee smooth execution.”"
        },
        {
            num: "11 / 13",
            question: "11. Why should we hire you?",
            ask: "Your unique value proposition.",
            strategy: "Value Pitch",
            how: "Summarize your perfect fit for the core requirements and voice real enthusiasm.",
            avoid: "“Because I really need a job” or reciting your resume word-for-word.",
            example: "“You should hire me because my technical stack bridges developer tracking with stakeholder requirements, matching what this operational roadmap demands.”"
        },
        {
            num: "12 / 13",
            question: "12. Are you applying for other jobs?",
            ask: "Determine your marketplace positioning.",
            strategy: "Honest Alignment",
            how: "Acknowledge active searches confidently while maintaining that this specific role is your priority.",
            avoid: "“Yes, I've applied everywhere” or acting overly defensive and secretive.",
            example: "“Yes, I'm exploring a few select roles, but your company stands out due to your direct focus on streaming analytics systems development.”"
        },
        {
            num: "13 / 13",
            question: "13. Do you have any questions for us?",
            ask: "Gauge your authentic curiosity about the venture.",
            strategy: "Strategic Closing",
            how: "Ask insightful, role-specific questions regarding team operations or success targets.",
            avoid: "“No questions” or jumping straight to benefits/salary parameters on round one.",
            example: "“Yes, could you share more about the typical day-to-day cycle for this role and how success is quantified during the first 90 days?”"
        }
    ];

    let currentQuestionIndex = 0;
    const flipCardInner = document.getElementById("interactiveFlipElement");

    function toggleFlipState() {
        flipCardInner.classList.toggle("is-flipped");
    }

    function cycleNextQuestion() {
        currentQuestionIndex = (currentQuestionIndex + 1) % reeracoenQuestions.length;
        const q = reeracoenQuestions[currentQuestionIndex];

        // Front Card Content Updates
        document.getElementById("questionNumberBadge").innerText = "Question " + q.num;
        document.getElementById("frontQuestionBox").innerText = q.question;
        document.getElementById("frontContextBox").innerText = q.ask;

        // Back Card Content Updates
        document.getElementById("backStrategyBadge").innerText = q.strategy;
        document.getElementById("backInstructionBox").innerText = q.how;
        document.getElementById("backAvoidBox").innerText = q.avoid;
        document.getElementById("backExampleBox").innerText = q.example;
    }

    // Charting definitions
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0,0,0,0.04)';
    const textMainColor = isDark ? '#687f79' : '#475569';
    
    // Radar Engine initialization
    const radarCtx = document.getElementById('readinessRadarChart').getContext('2d');
    new Chart(radarCtx, {
        type: 'radar',
        data: {
            labels: ['Resume', 'Technical', 'Soft Skills', 'Portfolio', 'Mock', 'Research'],
            datasets: [{
                label: 'Progress (%)',
                data: [85, 70, 75, 60, 50, 65],
                backgroundColor: 'rgba(16, 185, 129, 0.12)',
                borderColor: '#10b981',
                pointBackgroundColor: '#10b981',
                pointBorderColor: isDark ? '#111f1a' : '#fff',
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                r: {
                    angleLines: { color: gridColor },
                    grid: { color: gridColor },
                    pointLabels: {
                        color: textMainColor,
                        font: { size: 10, weight: '600', family: 'Plus Jakarta Sans' }
                    },
                    ticks: { display: false },
                    suggestedMin: 0,
                    suggestedMax: 100
                }
            },
            plugins: { legend: { display: false } }
        }
    });

    // Doughnut Engine initialization
    const corporateCtx = document.getElementById('corporateIntakeChart').getContext('2d');
    new Chart(corporateCtx, {
        type: 'doughnut',
        data: {
            labels: ['Google', 'Petronas', 'Shopee', 'Intel', 'Maybank'],
            datasets: [{
                data: [15, 35, 25, 40, 30],
                backgroundColor: ['#10b981', '#059669', '#f59e0b', '#0d9488', '#3b82f6'],
                borderWidth: isDark ? 2 : 1,
                borderColor: isDark ? '#111f1a' : '#ffffff'
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '73%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: textMainColor,
                        boxWidth: 10,
                        font: { size: 10, weight: '600', family: 'Plus Jakarta Sans' }
                    }
                }
            }
        }
    });

    // Async Live Asset Bar Feed Tracker
    document.addEventListener("DOMContentLoaded", function() {
        const spinner = document.getElementById('chart-loading-spinner');
        const ctx = document.getElementById('marketLiveBarChart').getContext('2d');
        
        fetch('<?= $this->Url->build(["controller" => "Dashboard", "action" => "marketData"]) ?>')
            .then(response => response.json())
            .then(dataset => {
                if(spinner) spinner.remove();

                const topCompanies = dataset.slice(0, 3);
                const labels = topCompanies.map(c => c.name);
                const values = topCompanies.map(c => {
                    let cleanString = c.market_cap.replace(/[^0-9.]/g, '');
                    let numericVal = parseFloat(cleanString) || 0;
                    if (numericVal === 1 && c.name.toLowerCase().includes('maybank')) {
                        return 115.4; 
                    }
                    return numericVal;
                });

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: ['rgba(220, 53, 69, 0.75)', 'rgba(13, 202, 240, 0.75)', 'rgba(255, 193, 7, 0.75)'],
                            borderColor: ['#dc3545', '#0dcaf0', '#ffc107'],
                            borderWidth: 1.5,
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: { color: gridColor },
                                ticks: {
                                    color: textMainColor,
                                    font: { size: 9, family: 'Plus Jakarta Sans' },
                                    callback: function(value) { return '$' + value + 'B'; }
                                }
                            },
                            y: {
                                grid: { display: false },
                                ticks: {
                                    color: textMainColor,
                                    font: { size: 10, weight: '600', family: 'Plus Jakarta Sans' }
                                }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) { return ' Market Cap: $' + context.raw + ' Billion'; }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Data sync failed:', error);
                if(spinner) {
                    spinner.innerHTML = `<span class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>Market Index offline.</span>`;
                }
            });
    });
</script>
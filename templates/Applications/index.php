<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php
/**
 * UI for My Applications - Information Management System
 * Integrated with Premium CSS architecture.
 */
$this->Html->css('style', ['block' => true]);
?>

<div class="container-fluid p-4 main-wrapper-documents overflow-hidden">
    
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4" data-aos="fade-down" data-aos-duration="600">
        <div>
            <h3 class="fw-bold mb-1" style="color: #10b981; letter-spacing: -0.5px;">
                <i class="bi bi-briefcase-fill me-2"></i>My Applications
            </h3>
            <p class="text-muted small mb-0">Manage, monitor, and accelerate your internship application lifecycles.</p>
        </div>
        <?= $this->Html->link('<i class="bi bi-plus-lg me-1"></i> New Application', 
            ['action' => 'add'], 
            ['escape' => false, 'class' => 'btn btn-success rounded-pill px-4 py-2 fw-medium shadow-sm action-link-hub', 'style' => 'background-color: #10b981; border-color: #10b981; font-size: 0.9rem;']) 
        ?>
    </div>

    <div class="card card-container-premium p-3 mb-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
        <form action="<?= $this->Url->build(['action' => 'index']) ?>" method="get" class="row g-3 align-items-center">
            
            <div class="col-12 col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px; border-color: var(--border-accent);"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control bg-light border-start-0 premium-focus" style="border-radius: 0 12px 12px 0; border-color: var(--border-accent); font-size: 0.9rem;" placeholder="Search company name..." value="<?= h($this->request->getQuery('q')) ?>">
                </div>
            </div>

            <div class="col-12 col-md-3">
                <select name="status" class="form-select bg-light text-secondary premium-focus" style="border-radius: 12px; border-color: var(--border-accent); font-size: 0.9rem;" onchange="this.form.submit()">
                    <option value="">-- Filter Status --</option>
                    <option value="0" <?= $this->request->getQuery('status') === '0' ? 'selected' : '' ?>>Applied</option>
                    <option value="2" <?= $this->request->getQuery('status') === '2' ? 'selected' : '' ?>>Interview</option>
                    <option value="1" <?= $this->request->getQuery('status') === '1' ? 'selected' : '' ?>>Accepted</option>
                    <option value="3" <?= $this->request->getQuery('status') === '3' ? 'selected' : '' ?>>Rejected</option>
                </select>
            </div>

            <div class="col-12 col-md-5 d-flex gap-2 justify-content-md-end">
                <button type="submit" class="btn btn-success px-4 rounded-pill fw-medium shadow-sm" style="background-color: #10b981; border-color: #10b981; font-size: 0.9rem;">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
                <?php if($this->request->getQuery('q') || $this->request->getQuery('status') !== null && $this->request->getQuery('status') !== ''): ?>
                    <?= $this->Html->link('<i class="bi bi-x-circle me-1"></i>Clear', 
                        ['action' => 'index'], 
                        ['escape' => false, 'class' => 'btn btn-light border px-3 rounded-pill text-secondary fw-medium', 'style' => 'font-size: 0.9rem;']) 
                    ?>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card card-container-premium mb-4 p-0" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700">
        <div class="table-responsive">
            <table class="table table-premium align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Company</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Interview Date</th>
                        <th>Last Modified</th>
                        <th class="text-center pe-4" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($applications) || (method_exists($applications, 'isEmpty') && $applications->isEmpty())): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x fs-1 d-block mb-2 opacity-25" style="color: #10b981;"></i>
                                No application records found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($applications as $application): ?>
                        <tr>
                            <td class="ps-4 company-col">
                                <span class="fw-semibold d-block text-main mb-0" style="font-size: 0.95rem;"><?= h($application->company_name) ?></span>
                                <small class="text-muted d-inline-block text-truncate" style="max-width: 180px; font-size: 0.75rem;">
                                    <i class="bi bi-geo-alt me-1"></i><?= h($application->company_address) ?>
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1 fw-medium" style="font-size: 0.75rem;">
                                    <?= h($application->role ?: '-') ?>
                                </span>
                            </td>
                            <td>
                                <?php 
                                    $statusMap = [0 => 'Applied', 1 => 'Accepted', 2 => 'Interview', 3 => 'Rejected'];
                                    $badgeClasses = [
                                        0 => 'bg-info-subtle text-info', 
                                        1 => 'bg-success-subtle text-success', 
                                        2 => 'bg-warning-subtle text-dark', 
                                        3 => 'bg-danger-subtle text-danger'
                                    ];
                                ?>
                                <span class="badge rounded-pill <?= $badgeClasses[$application->status] ?? 'bg-secondary-subtle text-secondary' ?>">
                                    <?= $statusMap[$application->status] ?? 'Unknown' ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column" style="font-size: 0.85rem;">
                                    <span class="fw-semibold text-main"><?= $application->interview_date ? $application->interview_date->timeAgoInWords() : '-' ?></span>
                                    <small class="text-muted" style="font-size: 0.72rem; opacity: 0.8;"><?= $application->interview_date ? $application->interview_date->format('d M Y, g:i A') : '' ?></small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column" style="font-size: 0.85rem;">
                                    <span class="fw-semibold text-main"><?= $application->modify ? $application->modify->timeAgoInWords() : '-' ?></span>
                                    <small class="text-muted" style="font-size: 0.72rem; opacity: 0.8;"><?= $application->modify ? $application->modify->format('d M Y, g:i A') : '' ?></small>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <?= $this->Html->link('<i class="bi bi-eye"></i>', 
                                        ['action' => 'view', $application->id], 
                                        ['escape' => false, 'class' => 'btn-action-premium btn-action-view-premium', 'title' => 'View Application']) 
                                    ?>
                                    
                                    <?= $this->Html->link('<i class="bi bi-pencil"></i>', 
                                        ['action' => 'edit', $application->id], 
                                        ['escape' => false, 'class' => 'btn-action-premium btn-action-edit-premium', 'title' => 'Edit Application']) 
                                    ?>
                                    
                                    <?= $this->Form->postLink('<i class="bi bi-trash"></i>', 
                                        ['action' => 'delete', $application->id], 
                                        ['confirm' => 'Are you sure you want to delete this application?', 'escape' => false, 'class' => 'btn-action-premium btn-action-delete-premium', 'title' => 'Delete Record']) 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="card-footer border-top-0 px-4 py-3" style="background: transparent;" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="500">
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-6 text-center text-md-start">
                    <span class="text-muted fw-medium" style="font-size: 0.825rem; letter-spacing: 0.2px;">
                        <i class="bi bi-layers-fill me-1 text-success opacity-75"></i>
                        <?= $this->Paginator->counter('{{count}} items found') ?>
                    </span>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                    <nav aria-label="Application table navigation">
                        <ul class="pagination pagination-premium mb-0">
                            <?php
                                $this->Paginator->setTemplates([
                                    'prevActive' => '<li class="page-item prev"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                    'prevDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
                                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                    'current' => '<li class="page-item active"><span class="page-link">{{text}}</span></li>',
                                    'nextActive' => '<li class="page-item next"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                    'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
                                    'first' => '<li class="page-item first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                    'last' => '<li class="page-item last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                ]);

                                echo $this->Paginator->first('<i class="bi bi-chevron-double-left"></i>', ['escape' => false]);
                                echo $this->Paginator->prev('<i class="bi bi-chevron-left"></i>', ['escape' => false]);
                                echo $this->Paginator->numbers(['modulus' => 2]);
                                echo $this->Paginator->next('<i class="bi bi-chevron-right"></i>', ['escape' => false]);
                                echo $this->Paginator->last('<i class="bi bi-chevron-double-right"></i>', ['escape' => false]);
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ 
            duration: 700, 
            once: true,
            offset: 5,
            easing: 'cubic-bezier(0.25, 1, 0.5, 1)'
        });
    });
</script>
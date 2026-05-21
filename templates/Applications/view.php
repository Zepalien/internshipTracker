<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Application $application
 */
?>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="<?= $this->Url->build(['action' => 'index']) ?>" class="text-decoration-none text-success">Applications</a></li>
                    <li class="breadcrumb-item active">View Details</li>
                </ol>
            </nav>
            <h2 class="fw-bold text-dark m-0"><?= h($application->company_name) ?></h2>
        </div>
        <div class="btn-group shadow-sm rounded-pill overflow-hidden">
            <?= $this->Html->link(__('<i class="bi bi-pencil-square"></i> Edit'), ['action' => 'edit', $application->id], ['class' => 'btn btn-white text-primary fw-semibold border-end', 'escape' => false]) ?>
            <?= $this->Form->postLink(__('<i class="bi bi-trash"></i> Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id), 'class' => 'btn btn-white text-danger fw-semibold', 'escape' => false]) ?>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold border-bottom pb-3 mb-4">
                        <i class="bi bi-info-circle-fill text-success me-2"></i>Company Information
                    </h5>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted fw-semibold small text-uppercase">Company Name</div>
                        <div class="col-sm-8 fw-bold text-dark fs-5"><?= h($application->company_name) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted fw-semibold small text-uppercase">Address / Location</div>
                        <div class="col-sm-8 text-dark">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i><?= h($application->company_address) ?>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-4 text-muted fw-semibold small text-uppercase">Role / Position</div>
                        <div class="col-sm-8">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill"><?= h($application->role ?: 'Internship Position') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <div class="row">
                        <div class="col-6 border-end">
                            <p class="text-muted small fw-bold text-uppercase mb-1">Created At</p>
                            <p class="text-dark fw-semibold mb-0"><?= h($application->created->format('d M Y, h:i A')) ?></p>
                        </div>
                        <div class="col-6">
                            <p class="text-muted small fw-bold text-uppercase mb-1">Last Modified</p>
                            <p class="text-dark fw-semibold mb-0"><?= h($application->modify->format('d M Y, h:i A')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                <div class="card-body p-4 text-center">
                    <h6 class="text-muted fw-bold text-uppercase small mb-3 text-start">Application Status</h6>
                    
                    <?php 
                        $status_class = 'bg-info-subtle text-info';
                        $status_label = 'Applied';
                        $status_icon = 'bi-send';

                        if($application->status == 1) {
                            $status_class = 'bg-success-subtle text-success';
                            $status_label = 'Offer / Accepted';
                            $status_icon = 'bi-check-circle-fill';
                        } elseif($application->status == 2) {
                            $status_class = 'bg-warning-subtle text-warning';
                            $status_label = 'Interview Scheduled';
                            $status_icon = 'bi-people-fill';
                        } elseif($application->status == 3) {
                            $status_class = 'bg-danger-subtle text-danger';
                            $status_label = 'Rejected';
                            $status_icon = 'bi-x-circle-fill';
                        }
                    ?>

                    <div class="py-4 rounded-4 <?= $status_class ?> mb-3">
                        <i class="bi <?= $status_icon ?> display-4 mb-2 d-block"></i>
                        <h4 class="fw-bold m-0"><?= $status_label ?></h4>
                    </div>
                </div>
            </div>

            <div class="card border-0 bg-dark text-white rounded-4 shadow">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 small"><i class="bi bi-lightning-fill text-warning me-2"></i>Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-light btn-sm rounded-pill text-start">
                            <i class="bi bi-arrow-left-short me-2"></i>Back to List
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Documents', 'action' => 'index']) ?>" class="btn btn-outline-light btn-sm rounded-pill text-start">
                            <i class="bi bi-file-earmark-pdf me-2"></i>Attach Documents
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling for View Page */
    .breadcrumb-item + .breadcrumb-item::before { color: #ccc; }
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    .card { transition: transform 0.2s ease-in-out; }
    .card:hover { transform: translateY(-3px); }
</style>
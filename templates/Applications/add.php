<div class="p-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <?= $this->Html->link('<i class="bi bi-arrow-left me-2"></i>Back to List', 
            ['action' => 'index'], 
            ['escape' => false, 'class' => 'text-success fw-bold text-decoration-none']) 
        ?>
    </nav>

    <div class="row">
        <div class="col-xl-10"> <div class="card shadow-sm border-0 rounded-3">
                
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-briefcase text-success fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">Add New Application</h4>
                            <small class="text-muted">Fill in the details to track your internship journey</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <?= $this->Form->create($application) ?>
                    
                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted">Company Name</label>
                                <?= $this->Form->control('company_name', [
                                    'class' => 'form-control border-light-subtle bg-light',
                                    'label' => false,
                                    'placeholder' => 'e.g. Telekom Malaysia',
                                    'required' => true
                                ]) ?>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted">Role / Position</label>
                                <?= $this->Form->control('role', [
                                    'class' => 'form-control border-light-subtle bg-light',
                                    'label' => false,
                                    'placeholder' => 'e.g. System Analyst',
                                    'required' => true
                                ]) ?>
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-bold small text-uppercase text-muted">Company Address</label>
                                <?= $this->Form->control('company_address', [
                                    'type' => 'textarea',
                                    'class' => 'form-control border-light-subtle bg-light',
                                    'label' => false,
                                    'placeholder' => 'Enter full address...',
                                    'rows' => '4',
                                    'required' => true
                                ]) ?>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card bg-light border-0 p-4 h-100">
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-uppercase text-muted">Application Status</label>
                                    <?= $this->Form->control('status', [
                                        'options' => [0 => 'Applied', 1 => 'Accepted', 2 => 'Interview', 3 => 'Rejected'],
                                        'class' => 'form-select border-0 shadow-sm',
                                        'label' => false,
                                        'default' => 0
                                    ]) ?>
                                </div>

                                <div class="alert alert-info border-0 small mb-4">
                                    <i class="bi bi-info-circle me-2"></i>
                                    The submission date and time will be recorded automatically once you save.
                                </div>

                                <div class="mt-auto">
                                    <?= $this->Form->button(__('Save Application'), [
                                        'class' => 'btn btn-success w-100 py-3 fw-bold rounded-3 shadow-sm border-0'
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
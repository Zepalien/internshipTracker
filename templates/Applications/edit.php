<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate-slide-up" style="background: #ffffff;">
                
                <div class="card-header bg-white px-4 py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                    <div class="d-flex align-items-center gap-2">
                        <span class="status-indicator-pulse"></span>
                        <h5 class="fw-bold mb-0 text-dark tracking-tight">Update Application</h5>
                    </div>
                    <div class="d-flex gap-2">
                        <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-light text-secondary btn-sm px-3 rounded-3 fw-medium transition-all']) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $application->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $application->id), 'class' => 'btn btn-user-delete btn-sm px-3 rounded-3 fw-medium transition-all']
                        ) ?>
                    </div>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <?= $this->Form->create($application) ?>
                    <fieldset class="border-0 p-0 m-0">
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">Company Name</label>
                                    <?= $this->Form->control('company_name', ['class' => 'form-control form-control-custom rounded-3', 'label' => false]) ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">Role / Position</label>
                                    <?= $this->Form->control('role', ['class' => 'form-control form-control-custom rounded-3', 'label' => false]) ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">Status</label>
                                    <?= $this->Form->control('status', [
                                        'options' => [0 => 'Applied', 1 => 'Offer', 2 => 'Interview', 3 => 'Rejected'],
                                        'class' => 'form-select form-select-custom rounded-3',
                                        'id' => 'statusSelect',
                                        'label' => false
                                    ]) ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group-custom">
                                    <label class="form-label-custom">Company Address</label>
                                    <?= $this->Form->control('company_address', [
                                        'class' => 'form-control form-control-custom rounded-3 pt-2', 
                                        'type' => 'textarea', 
                                        'rows' => 2,
                                        'label' => false
                                    ]) ?>
                                </div>
                            </div>
                            
                            <div id="interviewFieldsWrapper" class="col-md-12" style="display: none;">
                                <div class="interview-card p-4 border rounded-4">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-event text-success" viewBox="0 0 16 16">
                                            <path d="M11 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5 $.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                                        </svg>
                                        <h6 class="fw-bold mb-0 text-success" style="font-size: 0.95rem;">Interview Schedule & Logistics</h6>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom text-muted">Interview Date</label>
                                                <?= $this->Form->control('interview_date', ['type' => 'datetime-local', 'class' => 'form-control form-control-custom rounded-3', 'label' => false]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom text-muted">Type</label>
                                                <?= $this->Form->control('interview_type', [
                                                    'options' => ['Online' => 'Online', 'Physical' => 'Physical'],
                                                    'class' => 'form-select form-select-custom rounded-3',
                                                    'empty' => 'Select Type',
                                                    'label' => false
                                                ]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom text-muted">Location / Meeting Link</label>
                                                <?= $this->Form->control('interview_location', ['placeholder' => 'Zoom Link or Office Address', 'class' => 'form-control form-control-custom rounded-3', 'label' => false]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="d-flex justify-content-end mt-4 pt-2">
                        <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-gradient-success px-4 py-2 rounded-3 shadow-sm fw-semibold transition-all']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* Utilities & Resets */
.transition-all {
    transition: all 0.25s ease-in-out;
}
.tracking-tight {
    letter-spacing: -0.025em;
}

/* Animations */
.animate-slide-up {
    animation: slideUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(16px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Pulse Badge Style Indicator */
.status-indicator-pulse {
    width: 10px;
    height: 10px;
    background-color: #198754;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.4);
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.5); }
    70% { box-shadow: 0 0 0 6px rgba(25, 135, 84, 0); }
    100% { box-shadow: 0 0 0 0 rgba(25, 135, 84, 0); }
}

/* Form Styles Override */
.form-group-custom {
    position: relative;
    display: flex;
    flex-direction: column;
}
.form-label-custom {
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #6c757d;
    margin-bottom: 6px;
}
.form-control-custom, .form-select-custom {
    border: 1.5px solid #e9ecef !important;
    padding: 0.6rem 0.85rem;
    font-size: 0.925rem;
    color: #212529;
    background-color: #f8f9fa;
    transition: all 0.2s ease-in-out;
}
.form-control-custom:focus, .form-select-custom:focus {
    background-color: #ffffff;
    border-color: #198754 !important;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.12) !important;
}

/* Custom Interactive Blocks */
.interview-card {
    background: linear-gradient(145deg, #fdfdfd, #f7f9f8);
    border-color: rgba(25, 135, 84, 0.15) !important;
    animation: revealExpand 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
@keyframes revealExpand {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Custom Buttons styling */
.btn-user-delete {
    background-color: #fff5f5;
    color: #e53e3e;
    border: none;
}
.btn-user-delete:hover {
    background-color: #fed7d7;
    color: #c53030;
}
.btn-gradient-success {
    background: linear-gradient(135deg, #198754, #146c43);
    color: #ffffff;
    border: none;
}
.btn-gradient-success:hover {
    background: linear-gradient(135deg, #157347, #105636);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2) !important;
}
.btn-gradient-success:active {
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    const interviewWrapper = document.getElementById('interviewFieldsWrapper');

    function toggleInterview() {
        if (statusSelect.value == "2") {
            // Apply flex directly through JS display properties safely via block wrap layout rule
            interviewWrapper.style.display = 'block';
        } else {
            interviewWrapper.style.display = 'none';
        }
    }

    statusSelect.addEventListener('change', toggleInterview);
    toggleInterview(); 
});
</script>
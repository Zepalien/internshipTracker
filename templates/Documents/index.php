<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Document> $documents
 */

// 1. SET TEMPLATE PAGINATOR KAPSUL (Gaya Premium Bersih)
$this->Paginator->setTemplates([
    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><span class="page-link">{{text}}</span></li>',
]);

$this->Html->css('style', ['block' => true]);
?>

<div class="documents index content main-wrapper-documents overflow-hidden">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down" data-aos-duration="600">
        <div>
            <h3 class="fw-bold mb-1" style="color: #10b981;">
                <i class="bi bi-folder2-open me-2"></i><?= __('My Documents') ?>
            </h3>
            <small class="text-muted">Manage, track, and filter your application attachments seamlessly.</small>
        </div>
        <?= $this->Html->link(__('<i class="bi bi-plus-lg me-1"></i> New Document'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success rounded-pill px-4 py-2 fw-medium shadow-sm']) ?>
    </div>

    <div class="card card-container-premium p-3 mb-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3 align-items-center']) ?>
            <div class="col-12 col-md-3">
                <div class="input-group">
                    <span class="input-group-text bg-light text-secondary border-end-0" style="border-radius: 10px 0 0 10px;"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-start-0" style="border-radius: 0 10px 10px 0;" placeholder="Search by name..." value="<?= h($this->request->getQuery('search')) ?>">
                </div>
            </div>
            
            <div class="col-12 col-md-3">
                <select name="category" class="form-select bg-light text-secondary" style="border-radius: 10px;">
                    <option value=""><?= __('-- Filter Category --') ?></option>
                    <option value="Resume" <?= $this->request->getQuery('category') === 'Resume' ? 'selected' : '' ?>>Resume</option>
                    <option value="Academic Transcript" <?= $this->request->getQuery('category') === 'Academic Transcript' ? 'selected' : '' ?>>Academic Transcript</option>
                    <option value="Cover Letter" <?= $this->request->getQuery('category') === 'Cover Letter' ? 'selected' : '' ?>>Cover Letter</option>
                    <option value="Certificate" <?= $this->request->getQuery('category') === 'Certificate' ? 'selected' : '' ?>>Certificate</option>
                    <option value="Other Documents" <?= $this->request->getQuery('category') === 'Other Documents' ? 'selected' : '' ?>>Other Documents</option>
                </select>
            </div>
            
            <div class="col-12 col-md-4">
                <select name="application_id" class="form-select bg-light text-secondary" style="border-radius: 10px;">
                    <option value=""><?= __('-- Filter Company --') ?></option>
                    <option value="general" <?= $this->request->getQuery('application_id') === 'general' ? 'selected' : '' ?>>General (No Company)</option>
                    <?php if (isset($applications)): ?>
                        <?php foreach ($applications as $id => $company_name): ?>
                            <option value="<?= $id ?>" <?= $this->request->getQuery('application_id') == $id ? 'selected' : '' ?>><?= h($company_name) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="col-12 col-md-2 d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success px-4 rounded-pill fw-medium"><i class="bi bi-funnel-fill me-1"></i> Filter</button>
                <?php if ($this->request->getQuery('search') || $this->request->getQuery('category') || $this->request->getQuery('application_id')): ?>
                    <?= $this->Html->link('<i class="bi bi-x-circle"></i> Clear', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-light border px-3 rounded-pill text-secondary']) ?>
                <?php endif; ?>
            </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="shadow-lg p-3 mb-4 bg-body-tertiary rounded" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700">
        <div class="card card-container-premium overflow-hidden mb-0 p-0">
            <div class="table-responsive">
                <table class="table table-premium align-middle mb-0">
                    <thead>
                        <tr style="background-color: #f8fafc;">
                            <th class="ps-4 py-3"><?= $this->Paginator->sort('name', 'Document Name <i class="bi bi-arrow-down-up small opacity-50 ms-1"></i>', ['escape' => false, 'class' => 'text-decoration-none']) ?></th>
                            <th class="py-3"><?= $this->Paginator->sort('application_id', 'Linked Company <i class="bi bi-arrow-down-up small opacity-50 ms-1"></i>', ['escape' => false, 'class' => 'text-decoration-none']) ?></th>
                            <th class="py-3"><?= $this->Paginator->sort('category', 'Category <i class="bi bi-arrow-down-up small opacity-50 ms-1"></i>', ['escape' => false, 'class' => 'text-decoration-none']) ?></th>
                            <th class="py-3"><?= $this->Paginator->sort('created', 'Uploaded Date <i class="bi bi-arrow-down-up small opacity-50 ms-1"></i>', ['escape' => false, 'class' => 'text-decoration-none']) ?></th>
                            <th class="text-center py-3 text-secondary" style="width: 150px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;"><?= __('ACTIONS') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($documents) === 0): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-file-earmark-text fs-1 d-block mb-2 opacity-20" style="color: #10b981;"></i>
                                    No documents matched your tracking criteria.
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php foreach ($documents as $document): ?>
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <?php if (strpos(strtolower($document->type), 'pdf') !== false): ?>
                                        <div class="p-2 bg-danger-subtle rounded-3 me-3 d-flex align-items-center justify-content-center" style="width:38px; height:38px;"><i class="bi bi-file-earmark-pdf text-danger fs-5"></i></div>
                                    <?php else: ?>
                                        <div class="p-2 bg-primary-subtle rounded-3 me-3 d-flex align-items-center justify-content-center" style="width:38px; height:38px;"><i class="bi bi-file-earmark-text text-primary fs-5"></i></div>
                                    <?php endif; ?>
                                    <div>
                                        <span class="fw-semibold d-block text-dark mb-0" style="font-size: 0.95rem;"><?= h(ucwords(strtolower($document->name))) ?></span>
                                        <small class="text-muted text-opacity-50 small font-monospace" style="font-size: 0.72rem;"><?= h($document->file_path) ?></small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <?php if ($document->hasValue('application')): 
                                    $comp = strtolower($document->application->company_name);
                                    $badgeClass = 'bg-primary-subtle text-primary';
                                    if (strpos($comp, 'petronas') !== false) $badgeClass = 'bg-success-subtle text-success';
                                    elseif (strpos($comp, 'aeon') !== false) $badgeClass = 'bg-info-subtle text-info';
                                    elseif (strpos($comp, 'deloitte') !== false) $badgeClass = 'bg-warning-subtle text-dark';
                                ?>
                                    <?= $this->Html->link(h($document->application->company_name), 
                                        ['controller' => 'Applications', 'action' => 'view', $document->application->id],
                                        ['class' => 'badge ' . $badgeClass . ' rounded-pill text-decoration-none']) ?>
                                <?php else: ?>
                                    <span class="badge bg-light text-secondary border rounded-pill">General</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3">
                                <?php
                                    $cat = $document->category;
                                    $catBadge = 'bg-secondary-subtle text-secondary';
                                    if ($cat === 'Resume') $catBadge = 'bg-success-subtle text-success';
                                    elseif ($cat === 'Academic Transcript') $catBadge = 'bg-primary-subtle text-primary';
                                    elseif ($cat === 'Certificate') $catBadge = 'bg-warning-subtle text-dark';
                                    elseif ($cat === 'Cover Letter') $catBadge = 'bg-info-subtle text-info';
                                ?>
                                <span class="badge <?= $catBadge ?> rounded-pill">
                                    <?= h($cat) ?>
                                </span>
                            </td>
                            <td class="text-secondary small py-3">
                                <div class="d-flex align-items-center gap-1 text-muted" style="font-size: 0.85rem;">
                                    <i class="bi bi-clock-history opacity-50"></i>
                                    <span><?= $document->created->setTimezone('Asia/Kuala_Lumpur')->format('d M Y, g:i A') ?></span>
                                </div>
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= $this->Url->build('/uploads/documents/' . $document->file_path) ?>" 
                                       target="_blank" class="btn-action-premium btn-action-view-premium" title="View File">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <?= $this->Html->link(__('<i class="bi bi-pencil"></i>'), 
                                        ['action' => 'edit', $document->id], 
                                        ['escape' => false, 'class' => 'btn-action-premium btn-action-edit-premium', 'title' => 'Edit Details']) 
                                    ?>
                                    
                                    <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), 
                                        ['action' => 'delete', $document->id], 
                                        ['confirm' => __('Delete {0}?', $document->name), 'escape' => false, 'class' => 'btn-action-premium btn-action-delete-premium', 'title' => 'Delete']) 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white border-top-0 px-4 py-3" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="500">
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-6 text-center text-md-start">
                    <span class="text-muted fw-medium" style="font-size: 0.825rem; letter-spacing: 0.2px;">
                        <i class="bi bi-layers me-1 text-success opacity-75"></i>
                        <?= $this->Paginator->counter(__('Showing {{current}} of {{count}} total documents')) ?>
                    </span>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                    <nav aria-label="Document table navigation">
                        <ul class="pagination pagination-premium mb-0">
                            <?= $this->Paginator->first('<i class="bi bi-chevron-double-left"></i>', ['escape' => false]) ?>
                            <?= $this->Paginator->prev('<i class="bi bi-chevron-left"></i>', ['escape' => false]) ?>
                            <?= $this->Paginator->numbers(['modulus' => 2]) ?>
                            <?= $this->Paginator->next('<i class="bi bi-chevron-right"></i>', ['escape' => false]) ?>
                            <?= $this->Paginator->last('<i class="bi bi-chevron-double-right"></i>', ['escape' => false]) ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ 
        duration: 700, 
        once: true,
        offset: 5,
        easing: 'cubic-bezier(0.25, 1, 0.5, 1)'
    });

    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0,0,0,0.04)';
    const textMainColor = isDark ? '#687f79' : '#475569';
</script>
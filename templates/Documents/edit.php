<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document $document
 * @var \Cake\Collection\CollectionInterface|string[] $applications
 */
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-success">
                        <i class="bi bi-pencil-square me-2"></i><?= __('Edit Document') ?>
                    </h5>
                    <div class="btn-group">
                        <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $document->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $document->id), 'class' => 'btn btn-outline-danger btn-sm']
                        ) ?>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?= $this->Form->create($document, ['type' => 'file']) ?>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <?php echo $this->Form->control('application_id', [
                                    'options' => $applications,
                                    'empty' => '-- Select Linked Company (Optional) --',
                                    'class' => 'form-select',
                                    'label' => ['class' => 'form-label fw-bold']
                                ]); ?>
                            </div>

                            <div class="col-md-12 mb-3">
                                <?php echo $this->Form->control('name', [
                                    'class' => 'form-control',
                                    'label' => ['class' => 'form-label fw-bold']
                                ]); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <?php echo $this->Form->control('submitted_file', [
                                    'type' => 'file',
                                    'class' => 'form-control',
                                    'label' => ['class' => 'form-label fw-bold', 'text' => 'Replace File (Optional)'],
                                    'required' => false
                                ]); ?>
                                <div class="form-text text-muted xsmall">Current: <span class="text-primary"><?= h($document->file_path) ?></span></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <?php echo $this->Form->control('category', [
                                    'options' => [
                                        'Resume' => 'Resume',
                                        'Transcript' => 'Academic Transcript',
                                        'Cover Letter' => 'Cover Letter',
                                        'Certificate' => 'Certificate',
                                        'Other' => 'Other Documents'
                                    ],
                                    'class' => 'form-select',
                                    'label' => ['class' => 'form-label fw-bold']
                                ]); ?>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="d-grid mt-4">
                        <?= $this->Form->button(__('Update Document'), ['class' => 'btn btn-success fw-bold']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
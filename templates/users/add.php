<div id="bgindex" class="d-flex flex-column justify-content-center align-items-center vh-100 w-100" style="position: relative; z-index: 1;">
    
    <h1 class="text-white text-uppercase mb-4" style="font-family: 'Arial Black', sans-serif; font-size: 2.5rem; letter-spacing: 4px; text-shadow: 2px 4px 10px rgba(0,0,0,0.5);">
        CREATE ACCOUNT
    </h1>

    <div class="card login-card shadow" style="width: 100%; max-width: 550px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-1">SIGN UP</h3>
            <p class="text-center text-muted mb-4" style="font-size: 0.85rem; letter-spacing: 1px;">
                Start tracking your professional journey.
            </p>

            <?= $this->Form->create($user, ['class' => 'row g-3 needs-validation', 'novalidate' => true]) ?>
                
                <div class="col-12">
                    <label class="form-label">Full Name</label>
                    <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Your Name', 'required' => true]) ?>
                </div>

                <div class="col-12">
                    <label class="form-label">Email Address</label>
                    <?= $this->Form->control('emel_adress', ['type' => 'email', 'label' => false, 'class' => 'form-control', 'placeholder' => 'name@example.com', 'required' => true]) ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <?= $this->Form->control('password', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Minimum 8 chars', 'required' => true]) ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Course Code</label>
                    <?= $this->Form->control('course_code', ['label' => false, 'class' => 'form-control', 'placeholder' => 'e.g. CS230', 'required' => true]) ?>
                </div>

                <div class="col-12 text-end mt-4">
                    <?= $this->Html->link('Back to Login', ['action' => 'login'], ['class' => 'btn btn-outline-secondary px-4 me-2']) ?>
                    <button type="submit" class="btn btn-success px-4">Register</button>
                </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
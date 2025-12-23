<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>

<style>
.section-title {
    font-weight: 600;
    font-size: 15px;
    color: #0d6efd;
    border-bottom: 1px solid #e3e3e3;
    margin-bottom: 10px;
    padding-bottom: 4px;
}

.form-label {
    font-weight: 600 !important;
    font-size: 14px !important;
}

.form-check-label {
    font-size: 12px !important;
}

.survey-card {
    background: #f8f9fa;
    border: 1px dashed #cfd4da;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
}

.add-btn {
    font-size: 13px;
}
</style>

<main class="main-content">
<div class="container-fluid mt-2">

 <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

<div class="card shadow-sm mb-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">భూమి వివరాల నమోదు</h5>
        <a href="<?= base_url('land/list') ?>" class="btn btn-sm btn-light">
            <i class="bi bi-arrow-left"></i> వెనుకకు
        </a>
    </div>

    <div class="card-body">
    <form method="post" action="<?= base_url('land/store') ?>">

        <!-- ================= OWNER DETAILS ================= -->
        <div class="section-title">పట్టాదారు వివరాలు</div>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">ఖాతా నంబర్</label>
                <input type="text" name="khata_no" class="form-control" required>
            </div>

            <div class="col-md-8">
                <label class="form-label">పట్టాదారు పేరు (తండ్రి / భర్త పేరు)</label>
                <input type="text" name="pattadar_name" class="form-control" required>
            </div>
        </div>

        <!-- ================= SURVEY DETAILS ================= -->
        <div class="section-title d-flex justify-content-between align-items-center">
            <span>సర్వే నంబర్ వివరాలు</span>
            <button type="button" class="btn btn-sm btn-primary add-btn" onclick="addSurveyRow()">
                <i class="bi bi-plus-circle"></i> కొత్త సర్వే
            </button>
        </div>

        <div id="surveyContainer">

            <!-- Survey Row -->
            <div class="survey-card survey-row">
                <div class="row g-3 align-items-end">

                    <div class="col-md-2">
                        <label class="form-label">పాత సర్వే నం</label>
                        <input type="text" name="old_survey_no[]" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">L.P నం</label>
                        <input type="text" name="lp_number[]" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">ULPIN</label>
                        <input type="text" name="ulpin[]" class="form-control ">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">విస్తీర్ణం (ఎకరాలు)</label>
                        <input type="text" name="lp_extent[]" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">పన్ను మొత్తం (₹)</label>
                        <input type="number" step="0.01" name="tax_amount[]" class="form-control">
                    </div>

                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSurveyRow(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- ================= LAND DETAILS ================= -->
        <div class="section-title mt-4 ">భూమి వివరాలు</div>

        <div class="row g-3 px-5">

            <div class="col-md-6">
                <label class="form-label">భూమి స్వభావం</label>
                <div class="row">
                    <?php foreach (['పట్టా','జిరాయితీ భూమి'] as $v): ?>
                    <div class="col-md-6 form-check">
                        <input class="form-check-input" type="checkbox" name="land_nature[]" value="<?= $v ?>" checked>
                        <label class="form-check-label"><?= $v ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">భూమి ఉప స్వభావం</label>
                <div class="row">
                    <?php foreach (['పల్లం','మెరక'] as $v): ?>
                    <div class="col-md-4 form-check">
                        <input class="form-check-input" type="checkbox" name="land_sub_nature[]" value="<?= $v ?>" checked>
                        <label class="form-check-label"><?= $v ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label">అనుభవ స్వభావం</label>
                <div class="row">
                    <?php foreach (['వారసత్వం','కొనుగోలు','క్రయం','బహుమతి','విభజన'] as $v): ?>
                    <div class="col-md-3 form-check">
                        <input class="form-check-input" type="checkbox" name="possession_type[]" value="<?= $v ?>" checked>
                        <label class="form-check-label"><?= $v ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">ఆధార్ / మొబైల్ / ఇమెయిల్</label>
                <input type="text" name="contact_details" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">రిమార్కులు</label>
                <textarea name="remarks" class="form-control" rows="1"></textarea>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> సేవ్ చేయి
            </button>
            <a href="<?= base_url('land/list') ?>" class="btn btn-secondary">రద్దు</a>
        </div>

    </form>
    </div>
</div>

</div>
</main>

<?= $this->include('/dashboard/layouts/footer') ?>

<script>
function addSurveyRow() {
    const container = document.getElementById('surveyContainer');
    const row = document.querySelector('.survey-row').cloneNode(true);
    row.querySelectorAll('input').forEach(i => i.value = '');
    container.appendChild(row);
}

function removeSurveyRow(btn) {
    const rows = document.querySelectorAll('.survey-row');
    if (rows.length > 1) {
        btn.closest('.survey-row').remove();
    }
}
</script>

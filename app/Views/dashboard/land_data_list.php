<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>
<style>
    /* Card spacing */
    .card {
        border-radius: 12px;
    }

    .card-header {
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
    }

    .card-body {
        padding: 15px 18px;
    }

    /* Table font & spacing */
    .table {
        font-size: 13px;          /* 🔹 Adjust font size */
    }

    .table thead th {
        padding: 10px 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 8px 8px;         /* 🔹 Row padding */
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    /* Row hover smooth */
    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* Responsive fix */
    .table-responsive {
        overflow-x: auto;
    }

    /* Optional: compact table */
    .table-sm tbody td,
    .table-sm thead th {
        padding: 6px 6px;
        font-size: 12.5px;
    }
</style>

<main class="main-content" id="mainContent">
   
    <div class="container-fluid mt-1">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">భూమి వివరాల జాబితా</h5>

                <a href="<?= base_url('land/create') ?>" class="btn btn-sm btn-light">
                    <i class="bi bi-plus-circle"></i> కొత్త నమోదు
                </a>
            </div>

            <div class="card-body table-responsive">

           <form method="post" action="<?= base_url('land/list') ?>" class="mb-3">

    <div class="row g-2 align-items-end">

<div class="col-md-4">
    <label class="form-label small fw-semibold">పట్టాదారు పేరు</label>

    <select name="pattadar_name"
            class="form-select form-select-sm telugu-font">
        <option value="">-- అన్ని పేర్లు --</option>

        <?php
            function engToTelugu(string $text): string
            {
                if (!class_exists('Transliterator')) {
                    return $text;
                }
                $trans = \Transliterator::create('Any-Latin; Latin-Telugu');
                return $trans ? $trans->transliterate($text) : $text;
            }
        
        
        foreach ($pattadarList as $row): ?>
            <?php
                $fullName = trim($row['pattadar_name']);
                $engname = explode('/', $fullName)[0];
                $displayName = $engname ." / ". engToTelugu($engname); // 👈 before '/'
            ?>

            <option value="<?= esc($fullName) ?>"
                <?= (($_POST['pattadar_name'] ?? '') === $fullName) ? 'selected' : '' ?>>
                <?= esc($displayName) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

        <div class="col-md-3">
    <label class="form-label small fw-semibold">ఖాతా నంబర్</label>
    <input type="text"
           name="khata_no"
           value="<?= esc($_POST['khata_no'] ?? '') ?>"
           class="form-control"
           placeholder="ఖాతా నంబర్ నమోదు చేయండి">
</div>

<div class="col-md-3">
    <label class="form-label small fw-semibold">సర్వే నంబర్</label>
    <input type="text"
           name="survey_no"
           value="<?= esc($_POST['survey_no'] ?? '') ?>"
           class="form-control"
           placeholder="సర్వే నంబర్ నమోదు చేయండి">
</div>


       <div class="col-md-2 d-flex gap-2">
    <!-- Search Button -->
    <button type="submit" class="btn btn-sm btn-primary w-100">
        <i class="bi bi-search me-1"></i>
    </button>

    <!-- Reload Button -->
    <a href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary w-100">
        <i class="bi bi-arrow-clockwise me-1"></i>
    </a>
</div>

    </div>
</form>


<div class="card shadow">
    <div class="card-body p-2">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead class="table-light text-center">
                <tr>
                    <th>క్రమం</th>
                    <th>ఖాతా నెం.</th>
                    <th>పట్టాదారు పేరు</th>
                    <th>ఎల్‌పీ నెం.</th>
                    <th>పాత సర్వే నెం.</th>
                    <th>ULPIN</th>
                    <th>భూమి స్వభావం</th>
                    <th>ఉప స్వభావం</th>
                    <th>వర్గీకరణ</th>
                    <th>ఉప వర్గీకరణ</th>
                    <th>విస్తీర్ణం</th>
                    <th>స్వాధీన విధానం</th>
                    <th>సంప్రదింపు వివరాలు</th>
                    <th>గమనికలు</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $i => $row): ?>
                        <tr>
                            <td class="text-center"><?= $i + 1 ?></td>
                            <td><?= esc($row['khata_no']) ?></td>
                            <td><?= esc($row['pattadar_name']) ?></td>
                            <td><?= esc($row['lp_number']) ?></td>
                            <td><?= esc($row['old_survey_no']) ?></td>
                            <td><?= esc($row['ulpin']) ?></td>
                            <td><?= esc($row['land_nature']) ?></td>
                            <td><?= esc($row['land_sub_nature']) ?></td>
                            <td><?= esc($row['land_classification']) ?></td>
                            <td><?= esc($row['land_sub_classification']) ?></td>
                            <td class="text-end"><?= esc($row['lp_extent']) ?></td>
                            <td><?= esc($row['possession_type']) ?></td>
                            <td><?= esc($row['contact_details']) ?></td>
                            <td><?= esc($row['remarks']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" class="text-center text-muted">
                            ఫలితాలు లేవు
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</main>

<?= $this->include('/dashboard/layouts/footer') ?>

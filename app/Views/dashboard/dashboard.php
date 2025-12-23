<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>

<style>
.form-label { font-weight:600; }
.table td, .table th { vertical-align: middle; }
.amount-input { width:120px; }
</style>

<main class="main-content" id="mainContent">
<div class="container-fluid mt-2">

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">భూమి పన్ను చెల్లింపు</h5>
    </div>

    <div class="card-body">

    <!-- 🔹 FILTER FORM -->
    <form method="post" action="<?= base_url('land/pattadarDetails') ?>" class="mb-4">
        <div class="row g-3 align-items-end">

            <div class="col-md-4">
                <label class="form-label">పట్టాదారు పేరు</label>
                <select name="pattadar_name" class="form-select">
                    <option value="">-- ఎంచుకోండి --</option>
                    <?php foreach ($pattadarList as $p): ?>
                        <option value="<?= esc($p['pattadar_name']) ?>"
                            <?= (($p['pattadar_name'] ?? '') == ($_POST['pattadar_name'] ?? '')) ? 'selected' : '' ?>>
                            <?= esc($p['pattadar_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">ఖాతా నంబర్</label>
                <input type="text" name="khata_no"
                       value="<?= esc($_POST['khata_no'] ?? '') ?>"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> వెతకండి
                </button>
            </div>

            <div class="col-md-2">
                <a href="<?= current_url() ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>

        </div>
    </form>

<?php if (!empty($records)): ?>
<hr>

<div class="card shadow-sm mt-3">
    <div class="card-header bg-success text-white">
        <h6 class="mb-0">పన్ను చెల్లింపు వివరాలు</h6>
    </div>

    <div class="card-body table-responsive">
    
<table class="table table-bordered table-hover table-sm align-middle text-nowrap">

    <thead class="table-light text-center">
        <tr>
            <th style="width:40px;">#</th>
            <th style="width:90px;">ఖాతా నెం.</th>
            <th style="min-width:200px;">పట్టాదారు పేరు</th>
            <th style="width:90px;">ఎల్‌పీ నెం.</th>
            <th style="width:110px;">సర్వే నెం.</th>
            <th style="width:80px;">విస్తీర్ణం</th>
            <th style="width:130px;">పన్ను మొత్తం</th>
            <th style="width:120px;">Action</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($records as $i => $r): ?>
        <tr id="row-<?= $r['id'] ?>">

            <!-- Serial -->
            <td class="text-center fw-semibold"><?= $i + 1 ?></td>

            <!-- Khata -->
            <td class="text-center"><?= esc($r['khata_no']) ?></td>

            <!-- Name -->
            <td><?= esc($r['pattadar_name']) ?></td>

            <!-- LP -->
            <td class="text-center"><?= esc($r['lp_number']) ?></td>

            <!-- Survey -->
            <td class="text-center"><?= esc($r['old_survey_no']) ?></td>

            <!-- Extent -->
            <td class="text-end"><?= esc($r['lp_extent']) ?></td>

            <!-- Amount -->
            <td class="text-center">
                <?php if ($r['pay_status'] === 'Paid'): ?>
                    <span class="badge bg-success fs-6 px-3">
                        ₹ <?= esc($r['pay_amount']) ?>
                    </span>
                <?php else: ?>
                    <input type="number"
                           class="form-control form-control-sm text-end"
                           id="amount-<?= $r['id'] ?>"
                           placeholder="₹ మొత్తం"
                           min="1"
                           style="max-width:110px;margin:auto;">
                <?php endif; ?>
            </td>

            <!-- Action -->
            <td class="text-center" id="action-<?= $r['id'] ?>">
                <?php if ($r['pay_status'] === 'Paid'): ?>
                    <a href="<?= base_url('land/receipt/'.$r['id']) ?>"
                       class="btn btn-sm btn-outline-success">
                        <i class="bi bi-file-earmark-pdf"></i>
                        Receipt
                    </a>
                <?php else: ?>
                    <button class="btn btn-sm btn-primary px-3"
                            onclick="payTax(<?= $r['id'] ?>)">
                        <i class="bi bi-cash-coin"></i>
                        Pay
                    </button>
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

    </div>
</div>
<?php endif; ?>



</div>
</main>

<?= $this->include('/dashboard/layouts/footer') ?>
<script>
function payTax(id) {

    const amountInput = document.getElementById('amount-' + id);
    const amount = amountInput.value;

    if (!amount || amount <= 0) {
        alert('దయచేసి సరైన మొత్తం నమోదు చేయండి');
        return;
    }

    if (!confirm('చెల్లింపు నిర్ధారించాలా?')) {
        return;
    }

    fetch("<?= base_url('land/payUpdate') ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": "<?= csrf_hash() ?>"
        },
        body: JSON.stringify({
            id: id,
            amount: amount
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {

            // Replace action column
            document.getElementById('action-' + id).innerHTML =
                '<span class="badge bg-success">Paid</span>';

            // Replace amount input
            amountInput.parentElement.innerHTML =
                '<span class="text-success fw-semibold">₹ ' + amount + '</span>';

        } else {
            alert(data.message || 'Payment failed');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error occurred');
    });
}
</script>

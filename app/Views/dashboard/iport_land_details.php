<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>

<main class="main-content" id="mainContent">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Import Land Records (Excel)</h5>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form id="importForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="excel_file" class="form-label">Select Excel File</label>
                                <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xls,.xlsx" required>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-upload"></i> Import Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->include('/dashboard/layouts/footer') ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('importForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    Swal.fire({
        title: 'Importing...',
        text: 'Please wait while data is being imported',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('<?= base_url("land/import-excel") ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        Swal.close();

        if (res.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Import Completed',
                html: `
                    <b>Imported:</b> ${res.imported} <br>
                    <b>Failed:</b> ${res.failed.length}
                `
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Import Failed',
                text: res.message
            });
        }
    })
    .catch(err => {
        Swal.close();
        Swal.fire('Error', 'Server error occurred', 'error');
        console.error(err);
    });
});
</script>

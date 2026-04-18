<?php
$message = '';
if (isset($_SESSION['upload_success'])) {
    $message = '<div class="alert alert-success">' . $_SESSION['upload_success'] . '</div>';
    unset($_SESSION['upload_success']);
}
if (isset($_SESSION['upload_error'])) {
    $message = '<div class="alert alert-error">' . $_SESSION['upload_error'] . '</div>';
    unset($_SESSION['upload_error']);
}
?>
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-cloud-upload-alt"></i> Shto Projekt të Ri</h2>
    </div>
    <div class="card-body">
        <?php echo $message; ?>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="admin-form">
            <div class="form-group">
                <label>Imazhi *</label>
                <div class="file-upload">
                    <input type="file" name="image" id="imageUpload" accept="image/*" required>
                    <label for="imageUpload" class="file-label"><i class="fas fa-cloud-upload-alt"></i> Zgjidhni Imazhin</label>
                    <div class="image-preview" id="imagePreview"></div>
                </div>
            </div>
            <div class="form-group">
                <label>Titulli *</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Përshkrimi *</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Kategoria *</label>
                <select name="category" required>
                    <option value="">Zgjidhni kategorinë</option>
                    <option value="indoor">Indoor (Lyerje Brendshme)</option>
                    <option value="outdoor">Outdoor (Fasada)</option>
                    <option value="decor">Decorative (Dekorative)</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Ruaj Projektin</button>
        </form>
    </div>
</div>

<script>
// Image preview script (will be enhanced in admin.js)
document.getElementById('imageUpload').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
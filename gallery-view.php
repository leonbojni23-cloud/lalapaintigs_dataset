<?php
// Handle deletion message
$message = '';
if (isset($_SESSION['delete_success'])) {
    $message = '<div class="alert alert-success">' . $_SESSION['delete_success'] . '</div>';
    unset($_SESSION['delete_success']);
}
if (isset($_SESSION['delete_error'])) {
    $message = '<div class="alert alert-error">' . $_SESSION['delete_error'] . '</div>';
    unset($_SESSION['delete_error']);
}

$projects = mysqli_query($conn, "SELECT * FROM projects ORDER BY created_at DESC");
?>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-list"></i> Të gjitha Projektet</h2>
        <a href="dashboard.php?page=gallery-add" class="btn btn-primary"><i class="fas fa-plus"></i> Shto të Re</a>
    </div>
    <div class="card-body">
        <?php echo $message; ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Imazhi</th>
                        <th>Titulli</th>
                        <th>Përshkrimi</th>
                        <th>Kategoria</th>
                        <th>Data</th>
                        <th>Veprime</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($projects) > 0): ?>
                        <?php while ($project = mysqli_fetch_assoc($projects)): ?>
                            <tr>
                                <td><img src="../uploads/<?php echo htmlspecialchars($project['image']); ?>" alt="" style="width:60px; height:60px; object-fit:cover; border-radius:8px;"></td>
                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                <td><?php echo htmlspecialchars(substr($project['description'], 0, 50)) . '...'; ?></td>
                                <td><span class="badge badge-<?php echo $project['category']; ?>"><?php echo ucfirst($project['category']); ?></span></td>
                                <td><?php echo date('d M Y', strtotime($project['created_at'])); ?></td>
                                <td class="actions">
                                    <a href="#" class="btn-icon" title="Edito" onclick="alert('Funksioni i editimit do të shtohet së shpejti.')"><i class="fas fa-edit"></i></a>
                                    <a href="delete-project.php?id=<?php echo $project['id']; ?>" class="btn-icon btn-delete" onclick="return confirm('Jeni të sigurt që doni të fshini këtë projekt?')"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center;">Nuk ka projekte ende.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
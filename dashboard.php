<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-images"></i></div>
        <div class="stat-info">
            <h3><?php echo $totalProjects; ?></h3>
            <p>Projekte Gjithsej</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-eye"></i></div>
        <div class="stat-info">
            <h3>--</h3>
            <p>Vizita Mujore</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <h3>--</h3>
            <p>Mesazhe të Reja</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-clock"></i> Aktiviteti i Fundit</h2>
    </div>
    <div class="card-body">
        <p>Mirësevini në panelin e administrimit. Përdorni menunë anësore për të menaxhuar përmbajtjen.</p>
        <p>Projekte të fundit:</p>
        <ul>
            <?php
            $recent = mysqli_query($conn, "SELECT title, created_at FROM projects ORDER BY created_at DESC LIMIT 5");
            while ($row = mysqli_fetch_assoc($recent)) {
                echo "<li><strong>{$row['title']}</strong> - {$row['created_at']}</li>";
            }
            ?>
        </ul>
    </div>
</div>
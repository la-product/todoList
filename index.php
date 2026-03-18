<?php
    require_once __DIR__ . '/db.php';

    $filter = $_GET['filter'] ?? "";

    if ($filter == "1"){
        $sql = "SELECT * FROM tasklist WHERE stav = 1 ORDER BY id DESC";
    } elseif ($filter == "0"){
        $sql = "SELECT * FROM tasklist WHERE stav = 0 ORDER BY id DESC";
    } else {
        $sql = "SELECT * FROM tasklist ORDER BY id DESC";
    }

    $result = $conn->query($sql);    
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light"> <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h1 class="text-center fw-bold mb-4">To Do List</h1>
                    
                    <form method="GET" action="index.php" class="mb-0">
                        <label for="filter" class="form-label small text-muted">Filtrovat úkoly:</label>
                        <select name="filter" id="filter" onchange="this.form.submit()" class="form-select form-select-sm">
                            <option value="">Všechny úkoly</option>
                            <option value="1" <?= $filter === "1" ? "selected" : "" ?>>Hotovo</option>
                            <option value="0" <?= $filter === "0" ? "selected" : "" ?>>Čeká</option>
                        </select>
                    </form>
                </div>
            </div>

            <form action="process.php" method="POST" class="my-5">
                <div class="input-group input-group-lg shadow-lg">
                    <input type="text" name="task" placeholder="Co je potřeba udělat?" class="form-control border-0" required>
                    <button type="submit" name="submit" class="btn btn-primary px-4">
                        <i class="bi bi-plus-lg"></i> Přidat
                    </button>
                </div>
            </form>

            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Úkol</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Akce</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="<?= $row['stav'] == 1 ? 'text-decoration-line-through text-muted' : 'fw-medium' ?>">
                                            <?= htmlspecialchars($row['nazev']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row['stav'] == 1): ?>
                                            <span class="badge rounded-pill bg-success-subtle text-success border border-success">Hotovo</span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning">Čeká</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <?php if ($row['stav'] == 0): ?>
                                                <a href="status.php?id=<?= $row['id']; ?>&status=1" class="btn btn-outline-success" title="Splnit">
                                                    <i class="bi bi-check-lg"></i>
                                                </a>
                                            <?php endif; ?> 
                                            <a href="delete.php?id=<?= $row['id']; ?>" 
                                               onclick="return confirm('Opravdu smazat?')" 
                                               class="btn btn-outline-danger" title="Smazat">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
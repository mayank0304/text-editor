<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Table</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 ps-4 text-dark text-center" href="#" style="color: #002244; ">Text-Editor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto pt-3 pe-4">
                    <li class="nav-item">
                        <button class="btn"><a href="<?= site_url('/editor') ?>"
                                class="btn text-light text-center"
                                style="background-color: #002244;">Editor</a></button>
                    </li>
                    <li class="nav-item">
                        <button class="btn">
                            <a href="<?= site_url('/logout') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Logout</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
    <div class="text-center">
            <h2 class="text-center pe-4 ps-4 pt-2 pb-2 mb-4 d-inline-block" style="color: #ffffff; background-color:#002244;">
                Content</h2>
        </div>
        <table class="table table-bordered table-hover table-striped table-light shadow-sm" style="border:2px solid #002244;">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($content)): ?>
            <?php foreach ($content as $item): ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td><?= esc($item['content']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2" class="text-center text-muted"></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quill Editor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">
    <!-- Navbar -->
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
                        <button class="btn"><a href="<?= site_url('/editor/content') ?>"
                                class="btn text-light text-center"
                                style="background-color: #002244;">Content</a></button>
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

    <!-- Content Section -->
    <div class="container my-4">
        <div class="text-center">
            <h2 class="text-center pe-4 ps-4 pt-2 pb-2 d-inline-block"
                style="color: #ffffff; background-color:#002244;">Create and Save
                Content</h2>
        </div>
        <!-- Input for Name -->
        <div class="mb-3">
            <label for="name" class="form-label fs-4">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name" required
                style="background-color: #ffffff; border: 2px solid #002244;">
        </div>

        <!-- Editor Container -->
        <div id="editor-container"
            style="height: 550px; background-color: #ffffff; border: 2px solid #002244; padding: 10px;"></div>

        <!-- Save Button -->
        <div class="d-flex justify-content-center mt-3">
            <button id="save-content" class="btn p-2" style="background-color: #002244; color: #ffffff">Save
                Content</button>
        </div>
    </div>

    <!-- Quill and Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Quill editor with optional toolbar
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6,  false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'list': 'check' }],
                    [{ 'script': 'sub' }, { 'script': 'super' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['code-block', 'formula']
                ]
            }
        });
        // Event listener for save button
        document.getElementById('save-content').addEventListener('click', () => {
            const name = document.getElementById('name').value; // Get the name input
            const content = quill.getText(); // Get the editor content as Delta

            // Prepare the JSON payload
            const payload = {
                name: name,
                content: content
            };

            // Send data to the server
            fetch('/editor/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload) // Send JSON string
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Content saved successfully!');
                    } else {
                        alert('Failed to save content: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error.message || error);
                    alert('An error occurred while saving the content.');
                });
        });
    </script>
</body>

</html>
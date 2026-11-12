<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilo.css">
    <title>Bem-Vindo!</title>
</head>
<body class="container min-vh-100 d-flex flex-column justify-content-center py-4 bg-white text-dark">
    <h1 class="mb-4 text-center">Bem-vindo ao</h1>
    <h1 class="mb-4 text-center">Pet Center Animal</h1>
    <div class="row w-100 justify-content-center g-4">
        <section class="col-12 col-sm-8 col-md-4 col-lg-3" aria-labelledby="menu-veterinario">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-grid p-4">
                    <a class="btn btn-success btn-lg py-4 fs-3" id="menu-veterinario" href="HTML/telaVeterinario.php">Veterinário</a>
                </div>
            </div>
        </section>
        <section class="col-12 col-sm-8 col-md-4 col-lg-3" aria-labelledby="menu-tutor">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-grid p-4">
                    <a class="btn btn-primary btn-lg py-4 fs-3" id="menu-tutor" href="HTML/telaTutor.php">Tutor</a>
                </div>
            </div>
        </section>
        <section class="col-12 col-sm-8 col-md-4 col-lg-3" aria-labelledby="menu-animal">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-grid p-4">
                    <a class="btn btn-danger btn-lg py-4 fs-3" id="menu-animal" href="HTML/telaAnimal.php">Animal</a>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

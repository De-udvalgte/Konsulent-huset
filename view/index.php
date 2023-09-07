<?php include 'components/header.php';

?>
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <h1>Velkommen til Konsulent-Huset<?php if (!empty($_SESSION["userId"])){echo ", " . $_SESSION["firstName"] . " " . $_SESSION["lastName"];} ?></h1>
        </div>
    </div>
</main>
<?php include 'components/footer.php'; ?>
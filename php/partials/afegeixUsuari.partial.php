<main id="contingut">
    <h3>DADES USUARI NOU </h3>
    <div class="container px-5 my-5">
        <form id="contactForm" action="./php/processaAfegeixUsuari.php" method="POST">
            <div class="form-floating mb-3">
                <input class="form-control" id="nom" type="text" placeholder="Nom" name="nom" required />
                <label for="nom">Nom</label>

            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="cognom" type="text" placeholder="Cognom" name="cognom" required />
                <label for="cognom">Cognom</label>

            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="poblacio" type="text" placeholder="Poblacio" name="poblacio" required />
                <label for="poblacio">Poblacio</label>

            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="email" type="email" placeholder="Email " name="email" required />
                <label for="email">Email </label>

            </div>
            <?php

            $error = "";
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
            }


            if ($error == "alumne") {
                echo '    <span class="errorMsg" id="validation">El alumnat ja existeix </span>';
            }
            if ($error == "professorat") {
                echo '    <span class="errorMsg" id="validation">El professorat ja existeix </span>';
            }

            ?>
            <div class="form-floating mb-3">
                <input class="form-control" id="contrasenya" type="password"" placeholder=" Contrasenya" name="contrasenya1" minlength="6" required />
                <label for="contrasenya">Contrasenya</label>

            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="confirmaCotrasena" type="password" placeholder="Confirma contraseña" name="contrasenya2" minlength="6" required />
                <label for="confirmaCotrasena">Confirma contraseña</label>
            </div>
            <?php

            $parametre = "";
            if (isset($_GET['parametre'])) {
                $parametre = $_GET['parametre'];
            }


            if ($parametre == "error") {
                echo '    <span class="errorMsg" id="validation">Les contrasenyes han de coincidir</span>';
            }


            ?>

            <div class="form-floating mb-3">
                <select class="form-select" id="newField8" aria-label="New Field 8" name="tipus">
                    <option value="Alumnat">Alumnat</option>
                    <option value="Professorat">Professorat</option>
                </select>
                <label for="newField8">Tipus d'usuari</label>
            </div>

    </div>
    <div class="d-none" id="submitErrorMessage">
        <div class="text-center text-danger mb-3">Error sending message!</div>
    </div>
    <div class="d-grid">
        <button class="btn btn-primary btn-lg " id="submitButton" type="submit">Submit</button>
    </div>
    </form>
    </div>

    <br>
    <div>
        <a href="./admin.php?visualitza=true&&crud=true" class="btn btn-danger" role="button">Volver atras</a>
    </div>
    <?php


    ?>
</main>
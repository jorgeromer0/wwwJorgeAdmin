<main id="contingut">
    <h3>Administració::Login </h3>
    <form id="contactForm" action="../php/processaLoginAdmin.php" method="POST">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Usuari</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Usuari" name="usuari">
            </div>
        </div>

        <?php

        $parametre = "";
        if (isset($_GET['parametre'])) {
            $parametre = $_GET['parametre'];
        }


        if ($parametre == "errorusuari") {
            echo '    <span class="errorMsg" id="validation">L \'usuari no és valid.</span>';
        }


        ?>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Contrasenya</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
            </div>
        </div>

        <?php

        $parametre = "";
        if (isset($_GET['parametre'])) {
            $parametre = $_GET['parametre'];
        }


        if ($parametre == "errorc") {
            echo '    <span class="errorMsg" id="validation">La contraseña no és correcta.</span>';
        }


        ?>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Envia</button>
            </div>
        </div>
    </form>


</main>
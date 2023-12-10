<!DOCTYPE html>
<html lang="pt" xml:lang="pt" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>CDC</title>
        <meta charset="utf8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <link
            rel="stylesheet"
            href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"
        />
        <script src="js-webshim/minified/polyfiller.js"></script>
        
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <fieldset
            id="cdcfieldset"
            class="draggable ui-widget-content"
            style="
                border: 1px black solid;
                background-color: #cac3ba;
                width: 400px;
            "
        >
            <legend
                style="
                    border: 5px lightblue solid;
                    margin-left: 1em;
                    background-color: #ff6347;
                    padding: 0.2em 0.8em;
                "
            >
                <strong>Crédito Direto ao Consumidor</strong>
            </legend>

            <form action="tabela.php" method="post">
                <div class="box">
                    <span class="input-group-addon" style="color: antiquewhite"
                        >$</span
                    >
                    <label for="parc">Parcelamento:</label>
                    <input
                        id="parc"
                        type="number"
                        name="np"
                        size="5"
                        value="36"
                        min="1"
                        max="72000"
                        step="1"
                        required
                    />meses<br />

                    <span class="input-group-addon" style="color: antiquewhite"
                        >$</span
                    >
                    <label for="itax">Taxa de juros:</label>
                    <input
                        id="itax"
                        type="number"
                        name="tax"
                        size="10"
                        value="0.50"
                        min="0.0"
                        max="100.0"
                        step="any"
                        required
                    />% mês<br />

                    <span class="input-group-addon">$</span>
                    <label for="ipv">Valor Financiado[Vista]: </label>
                    <input
                        id="ipv"
                        type="number"
                        name="pv"
                        value="1000"
                        min="0.0"
                        step="0.01"
                        class="form-control currency"
                        required
                    /><br />

                    <span class="input-group-addon">$</span>
                    <label for="ipp">Valor Final(opcional):</label>
                    <input
                        id="ipp"
                        type="number"
                        name="pp"
                        value="0"
                        min="0"
                        step="1"
                        class="form-control currency"
                        required
                    /><br />

                    <span class="input-group-addon">$</span>
                    <label for="ipb">Meses a Voltar(opcional):</label>
                    <input
                        id="ipb"
                        type="number"
                        name="pb"
                        value="0"
                        min="0"
                        max="72000"
                        step="1.0"
                        class="form-control currency"
                        required
                    /><br />

                    <label for="idp">Entrada?</label>

                    <input name="dp" value="0" type="hidden"><!-- Valor pra caso a checkbox esteja vazia -->
                    <input id="idp" type="checkbox" name="dp" value="1" /><br />

                    <!-- <label for="ipr">Imprimir?</label>
                    <input id="ipr" type="checkbox" name="pr" value="1" /><br /> -->
                </div>
                <div class="messages">
                    
                  
                    <input type="submit" name="submit" id="submitButton" class="button" type="button" value="Calcular" style="display: block;" />

                    <p>(arraste-me para reposicionar a janela)</p>
                </div>
            </form>

            <div id="errorMessage" class="messages"></div>
            <div id="successMessage" class="messages">
                <p>
                    Se não souber a taxa de juros coloque 0%, e forneça o valor
                    final.
                </p>
            </div>
        </fieldset>

      

        <script src="LCG.js"></script>

        <!-- <script type="module" src="funcoesFront.js"></script> -->
        <script type="text/javascript">
            $("#submitButton").on("click", function (event) {
                var errorMessage = "";
                if ($("#parc").val() <= 2) {
                    errorMessage +=
                        "<p>Número de parcelas deve ser maior do que 1.</p>";
                }
                if ($("#itax").val() <= 0 && $("#ipp").val() <= 0) {
                    errorMessage +=
                        "<p>Taxa de juros e valor final não podem ser ambos nulos.</p>";
                }
                if ($("#itax").val() <= 0 && $("#ipv").val() <= 0) {
                    errorMessage +=
                        "<p>Taxa de juros e valor financiado não podem ser ambos nulos.</p>";
                }
                if ($("#ipv").val() <= 0 && $("#ipp").val() <= 0) {
                    errorMessage +=
                        "<p>Valor financiado e valor final não podem ser ambos nulos.</p>";
                }
                if (
                    $("#inb").val() < 0 ||
                    +$("#inb").val() > $("#parc").val()
                ) {
                    errorMessage +=
                        "<p>Meses a voltar deve ser positivo e menor ou igual ao número de parcelas.</p>";
                }
                if (errorMessage != "") {
                    $("#errorMessage").html(errorMessage);
                    $("#errorMessage").show();
                    $("#successMessage").hide();
                    event.preventDefault();
                } else {
                    $("#successMessage").show();
                    $("#errorMessage").hide();
                }
            });
            dragAndSave("#cdcfieldset"); // $("#cdcfieldset").draggable()

           
        </script>

    </body>
</html>
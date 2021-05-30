<!DOCTYPE html>
<html>
    <head>
        <title>Create Project</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <form method="post" action="./createProgetto.php">
            <h1>Create Project</h1>
            <input type="text" id="nomeProgetto" placeholder="Nome Progetto" name="nomeProgetto" maxlength="50" required>
            <input type="text"  style="height:7vh;" id="descrizione" placeholder="Descrizione" name="descrizione" maxlength="500" required>
            <label for="posti">Numero Posti (2-10):</label>
            <input type="number" id="posti" name="posti"min="2" max="10">
            <button type="submit" name="crea">Create project</button>
            <br>
            <br>
        </form>
    </body>
</html>

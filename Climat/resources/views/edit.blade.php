<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Métier</title>
</head>
<body>
    <h1>Modifier Métier</h1>

    <form action="{{ url('/metiers/' . $metier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="code_metier">Code Métier</label>
            <input type="text" id="code_metier" name="code_metier" value="{{ $metier->code_metier }}" required>
        </div>

        <div>
            <label for="nom_usuel">Nom Usuel</label>
            <input type="text" id="nom_usuel" name="nom_usuel" value="{{ $metier->nom_usuel }}">
        </div>

        <div>
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ $metier->adresse }}">
        </div>

        <div>
            <label for="code_postal">Code Postal</label>
            <input type="text" id="code_postal" name="code_postal" value="{{ $metier->code_postal }}">
        </div>

        <div>
            <label for="code_insee">Code INSEE</label>
            <input type="text" id="code_insee" name="code_insee" value="{{ $metier->code_insee }}">
        </div>

        <div>
            <label for="code_dpt">Code DPT</label>
            <input type="text" id="code_dpt" name="code_dpt" value="{{ $metier->code_dpt }}">
        </div>

        <div>
            <label for="code_reg">Code Région</label>
            <input type="text" id="code_reg" name="code_reg" value="{{ $metier->code_reg }}">
        </div>

        <div>
            <label for="nom_commune">Nom Commune</label>
            <input type="text" id="nom_commune" name="nom_commune" value="{{ $metier->nom_commune }}">
        </div>

        <div>
            <label for="x_wgs84">Coordonnée X (WGS84)</label>
            <input type="text" id="x_wgs84" name="x_wgs84" value="{{ $metier->x_wgs84 }}">
        </div>

        <div>
            <label for="y_wgs84">Coordonnée Y (WGS84)</label>
            <input type="text" id="y_wgs84" name="y_wgs84" value="{{ $metier->y_wgs84 }}">
        </div>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>

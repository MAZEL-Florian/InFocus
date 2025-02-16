<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 16px; color: #333;">
    <div style="background-color: #f3f3f3; padding: 20px; border-radius: 5px;">
        <h2 style="color: #333;">Nouveau message de contact</h2>
        <p><strong>Nom :</strong> {{ $request->nom }}</p>
        <p><strong>Prénom :</strong> {{ $request->prenom }}</p>
        <p><strong>Email :</strong> {{ $request->email }}</p>
        <p><strong>Message :</strong></p>
        <p style="white-space: pre-line;">{{ $request->message }}</p>
    </div>
</body>

</html>
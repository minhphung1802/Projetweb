<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-Vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page">

  <div class="container">

    <h1 class="h-accent">
      Prennez-vous un rdv pour avoir plus d'infos !!!
    </h1>


    <form class="candidature-form" id="form" action="candidature.php" method="post" enctype="multipart/form-data">

      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" required>

      <label for="email">Email</label>
      <input id="email" name="email" type="email" required>

      <label for="sujet">Sujet</label>
      <input id="sujet" name="sujet" type="text" required>

      <label for="horaires">Créneaux disponibles</label>
      <select id="horaires" name="horaires" required>
        <option value="" disabled selected>Choisir un horaire</option>
        <option value="09:00">09h00 - 09h30</option>
        <option value="09:30">09h30 - 10h00</option>
        <option value="10:00">10h00 - 10h30</option>
        <option value="10h30">10h30 - 11h00</option>
        <option value="14:00">14h00 - 14h30</option>
        <option value="14:30">14h30 - 15h00</option>
        <option value="15:00">15h00 - 15h30</option>
        <option value="15:30">15h30 - 16h00</option>
      </select>

      <label for="message">Message</label>
      <textarea id="message" name="message" required></textarea>

      <button
        type="submit"
        class="pill"
      >
        Envoyer
      </button>
      <a href="accueil.html" style="text-decoration: none; color: #666; display: flex; align-items: center; margin-bottom: 20px;">
      <span>&#8592; Retour à la page d'acceuil</span>
      </a>

    </form>


    <p
      id="success-message"
      style="display:none; color:#43bfe9; margin-top:12px;"
    >
      Message envoyé avec succès !
    </p>


  </div>

</main>
</body>
</html>
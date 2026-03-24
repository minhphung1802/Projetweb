<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>


<main class="page">
  <div class="container">

    <h1 class="h-accent">Dossier de candidature</h1>

    <div class="progress-bar">
      <div class="progress" id="progress"></div>
    </div>

    <form class="candidature-form" id="form">
      <h2>Informations personnelles</h2>

      <input type="text" name="nom" placeholder="Nom" required />
      <input type="text" name="prenom" placeholder="Prénom" required />
      <input type="text" name="ine" placeholder="INE (Identifiant National Étudiant)" required />
      <input type="date" name="naissance" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="tel" name="tel" placeholder="Téléphone" required />
      <input type="text" name="adresse" placeholder="Adresse" required />

      <h2>Formation souhaitée</h2>

      <select name="formation" required>
        <option value="">Choisir</option>
        <option value="pge">Programme Grande École</option>
        <option value="tn">Technologie &amp; Numérique</option>
        <option value="dm">Digital &amp; Management</option>
      </select>

      <select name="campus" required>
        <option value="">Campus souhaité</option>
        <option value="paris">Paris</option>
        <option value="bordeaux">Bordeaux</option>
      </select>

      <h2>CV</h2>
      <input type="file" id="cv" name="cv" accept="application/pdf" required />
      <iframe id="cv-preview" title="Aperçu du CV"></iframe>

      <h2>Lettre de motivation</h2>
      <input type="file" id="lm" name="lm" accept="application/pdf" required />
      <iframe id="lm-preview" title="Aperçu de la lettre de motivation"></iframe>

      <button class="pill" type="submit">Soumettre la candidature</button>
    </form>

    <div class="success-box" id="success">
      <h2>Candidature envoyée ✓</h2>
      <p>Votre dossier a bien été enregistré.</p>
    </div>

  </div>
</main>

<script>
  const form = document.getElementById("form");
  const progress = document.getElementById("progress");
  const success = document.getElementById("success");

  const cv = document.getElementById("cv");
  const lm = document.getElementById("lm");

  const cvPreview = document.getElementById("cv-preview");
  const lmPreview = document.getElementById("lm-preview");

  function updateProgress() {
    const fields = form.querySelectorAll("input, textarea, select");

    let filled = 0;
    fields.forEach((el) => {
      if (el.type === "file") {
        if (el.files && el.files.length > 0) filled++;
      } else {
        if (el.value.trim() !== "") filled++;
      }
    });

    progress.style.width = (filled / fields.length * 100) + "%";
  }

  form.addEventListener("input", updateProgress);
  form.addEventListener("change", updateProgress);

  cv.addEventListener("change", function () {
    const file = this.files && this.files[0];
    if (file) cvPreview.src = URL.createObjectURL(file);
  });

  lm.addEventListener("change", function () {
    const file = this.files && this.files[0];
    if (file) lmPreview.src = URL.createObjectURL(file);
  });

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    form.style.display = "none";
    success.style.display = "block";
  });

  updateProgress();
</script>
<script src="bonus.js"></script>
</body>


<?php include 'includes/footer.php'; ?>

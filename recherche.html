<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EFREI - Recherche</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header">
  <div class="container">
    <div class="navbar">

      <a class="brand" href="accueil.html">
        <img class="brand-logo" src="assets/image 1.png" alt="Logo EFREI">
      </a>

      <div class="nav-actions">
        <a class="pill" href="about.html">L’école</a>
        <a class="pill" href="formations.html">Formations</a>
        <a class="pill" href="campus.html">Campus</a>
        <a class="pill" href="enseignants.html">Enseignants</a>
        <a class="pill" href="contact.html">Contact</a>
        <a class="pill" href="candidature.html">Candidater</a>
      </div>

      <form class="search" role="search" action="recherche.html" method="get">

        <input
          id="qInput"
          type="search"
          name="q"
          placeholder="Recherche"
          aria-label="Recherche"
          required
        >

        <button type="submit" class="search-btn" aria-label="Rechercher">

          <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">

            <path
              d="M10.5 18a7.5 7.5 0 1 1 0-15"
              stroke="white"
              stroke-width="2"
              fill="none"
            />

            <path
              d="M16.2 16.2 21 21"
              stroke="white"
              stroke-width="2"
              stroke-linecap="round"
              fill="none"
            />

          </svg>

        </button>

      </form>

    </div>
  </div>
</header>


<main class="page">

  <div class="container">

    <div class="page-head">

      <h1 class="h-accent">
        Résultats de recherche
      </h1>

      <p class="page-sub" id="subtitle"></p>

    </div>

    <div id="results" class="results-grid"></div>

  </div>

</main>


<script>
const DATA = [
  { title: "Formations", text: "Programme Grande École, Technologie & Numérique, Digital & Management, Executive Education", url: "formations.html" },
  { title: "Programme Grande École", text: "Bac+5 ingénieur, spécialités numérique, IA, cybersécurité", url: "formations.html#ge" },
  { title: "Technologie & Numérique", text: "Développement, data, cloud, projets, alternance possible", url: "formations.html#tn" },
  { title: "Digital & Management", text: "Management du numérique, produit, transformation digitale", url: "formations.html#dm" },
  { title: "Executive Education", text: "Formations courtes pour professionnels, certifications", url: "formations.html#exec" },
  { title: "Campus", text: "Campus de Paris et Bordeaux, vie étudiante, associations", url: "campus.html" },
  { title: "Enseignants", text: "Équipe enseignante, matières, permanences", url: "enseignants.html" },
  { title: "Contact", text: "Formulaire de contact, coordonnées, rendez-vous", url: "contact.html" },
  { title: "Candidature", text: "Dossier de candidature, INE, CV, lettre de motivation", url: "candidature.html" }
];

const params = new URLSearchParams(location.search);
const q = (params.get("q") || "").trim();
const qLower = q.toLowerCase();

const subtitle = document.getElementById("subtitle");
const results = document.getElementById("results");
const qInput = document.getElementById("qInput");

qInput.value = q;

function escapeHTML(str){
  return str.replace(/[&<>"']/g, (c) => ({
    "&":"&amp;",
    "<":"&lt;",
    ">":"&gt;",
    '"':"&quot;",
    "'":"&#039;"
  }[c]));
}

const safeQ = escapeHTML(q);

subtitle.textContent = q
  ? `Recherche : "${q}"`
  : "Tapez un mot-clé dans la barre de recherche.";

function score(item){
  const hay = (item.title + " " + item.text).toLowerCase();
  if(!qLower) return 0;

  let s = 0;
  if(item.title.toLowerCase().includes(qLower)) s += 3;
  if(hay.includes(qLower)) s += 1;
  return s;
}

const found = q
  ? DATA.map(x => ({ ...x, s: score(x) }))
      .filter(x => x.s > 0)
      .sort((a,b) => b.s - a.s)
  : [];

if(!q){
  results.innerHTML = `<div class="result-empty">Aucun terme recherché.</div>`;
}
else if(found.length === 0){
  results.innerHTML = `<div class="result-empty">Aucun résultat pour "${safeQ}".</div>`;
}
else{
  results.innerHTML = found.map(item => `
    <a class="result-card" href="${item.url}">
      <div class="result-title">${item.title}</div>
      <div class="result-text">${item.text}</div>
      <div class="result-link">Ouvrir →</div>
    </a>
  `).join("");
}
</script>


<script src="bonus.js"></script>


<!-- FOOTER STANDARD -->
<footer class="footer">

  <div class="container">

    <div class="footer-grid">

      <div class="footer-logo-block">

        <img src="assets/image 1.png" class="footer-logo" alt="Logo EFREI">

        <ul>

          <li>+33 188 289 000</li>

          <li class="update">Dernière mise à jour</li>
          <li>10/02/2026</li>

          <li class="update">
            Projet réalisé par
            <a href="equipe.html" class="footer-link">
              Sean MOY et Duy Minh PHUNG
            </a>
          </li>

        </ul>

      </div>


      <div>
        <h4>L’école</h4>
        <ul>
          <li><a href="about.html">À propos</a></li>
          <li><a href="campus.html">Campus</a></li>
          <li><a href="equipe.html">Notre équipe</a></li>
        </ul>
      </div>


      <div>
        <h4>Formations</h4>
        <ul>
          <li><a href="formations.html">Voir formations</a></li>
        </ul>
      </div>


      <div>
        <h4>Contact</h4>
        <ul>
          <li><a href="contact.html">Nous contacter</a></li>
          <li><a href="equipe.html">Infos développeurs</a></li>
        </ul>
      </div>

    </div>

  </div>

</footer>


</body>
</html>
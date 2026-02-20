<?php
// candidature.php — réception + validation + sauvegarde des fichiers PDF et des données.

// ====== Helpers ======
function clean($v) {
  return trim(htmlspecialchars($v ?? "", ENT_QUOTES, "UTF-8"));
}

function fail($msg, $code = 400) {
  http_response_code($code);
  echo "<!doctype html><html lang='fr'><head>
  <meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Erreur candidature</title><link rel='stylesheet' href='style.css'></head><body>
  <main class='page'><div class='container'>
  <h1 class='h-accent'>Erreur</h1>
  <p style='margin-top:10px;color:var(--muted)'>" . $msg . "</p>
  <a class='pill' style='margin-top:14px;display:inline-flex' href='candidature.html'>Retour</a>
  </div></main></body></html>";
  exit;
}

function ensureDir($path) {
  if (!is_dir($path)) {
    if (!mkdir($path, 0777, true)) {
      fail("Impossible de créer le dossier serveur.");
    }
  }
}

// ====== Basic POST check ======
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  fail("Méthode non autorisée.", 405);
}

// ====== Read fields ======
$nom      = clean($_POST["nom"] ?? "");
$prenom   = clean($_POST["prenom"] ?? "");
$ine      = clean($_POST["ine"] ?? "");
$naissance= clean($_POST["naissance"] ?? "");
$email    = clean($_POST["email"] ?? "");
$tel      = clean($_POST["tel"] ?? "");
$adresse  = clean($_POST["adresse"] ?? "");
$formation= clean($_POST["formation"] ?? "");
$campus   = clean($_POST["campus"] ?? "");

// ====== Validate fields ======
$errors = [];

if ($nom === "") $errors[] = "Nom manquant.";
if ($prenom === "") $errors[] = "Prénom manquant.";
if ($ine === "") $errors[] = "INE manquant.";
if ($naissance === "") $errors[] = "Date de naissance manquante.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
if ($tel === "") $errors[] = "Téléphone manquant.";
if ($adresse === "") $errors[] = "Adresse manquante.";
if ($formation === "") $errors[] = "Formation non sélectionnée.";
if ($campus === "") $errors[] = "Campus non sélectionné.";

// ====== Validate uploads ======
$maxBytes = 5 * 1024 * 1024; // 5 Mo
$allowedExt = ["pdf"];
$allowedMime = ["application/pdf"]; // simple (peut varier selon navigateur)

function checkUpload($key, $label, $maxBytes, $allowedExt, $allowedMime) {
  if (!isset($_FILES[$key]) || $_FILES[$key]["error"] !== UPLOAD_ERR_OK) {
    return $label . " manquant ou upload échoué.";
  }

  $f = $_FILES[$key];

  if ($f["size"] <= 0 || $f["size"] > $maxBytes) {
    return $label . " : taille invalide (max 5 Mo).";
  }

  $name = $f["name"];
  $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  if (!in_array($ext, $allowedExt, true)) {
    return $label . " : format invalide (PDF seulement).";
  }

  // MIME check (best-effort)
  $mime = $f["type"] ?? "";
  if ($mime && !in_array($mime, $allowedMime, true)) {
    // On ne bloque pas à 100% car certains serveurs renvoient application/octet-stream,
    // mais on peut quand même être strict si tu veux.
    // return $label . " : type de fichier invalide.";
  }

  return ""; // ok
}

$e1 = checkUpload("cv", "CV", $maxBytes, $allowedExt, $allowedMime);
$e2 = checkUpload("lm", "Lettre de motivation", $maxBytes, $allowedExt, $allowedMime);

if ($e1) $errors[] = $e1;
if ($e2) $errors[] = $e2;

if (count($errors) > 0) {
  fail("Merci de corriger :<br><ul><li>" . implode("</li><li>", $errors) . "</li></ul>");
}

// ====== Save files ======
$uploadsDir = __DIR__ . "/uploads";
$dataDir    = __DIR__ . "/data";
ensureDir($uploadsDir);
ensureDir($dataDir);

// slug safe
$stamp = date("Ymd_His");
$base = preg_replace("/[^a-zA-Z0-9_-]+/", "_", strtolower($nom . "_" . $prenom . "_" . $ine));
$base = trim($base, "_");
if ($base === "") $base = "candidat";

$cvTmp = $_FILES["cv"]["tmp_name"];
$lmTmp = $_FILES["lm"]["tmp_name"];

$cvName = $base . "_" . $stamp . "_CV.pdf";
$lmName = $base . "_" . $stamp . "_LM.pdf";

$cvPath = $uploadsDir . "/" . $cvName;
$lmPath = $uploadsDir . "/" . $lmName;

if (!move_uploaded_file($cvTmp, $cvPath)) {
  fail("Impossible d'enregistrer le CV côté serveur.");
}
if (!move_uploaded_file($lmTmp, $lmPath)) {
  fail("Impossible d'enregistrer la lettre de motivation côté serveur.");
}

// ====== Save data in CSV ======
$csv = $dataDir . "/candidatures.csv";
$exists = file_exists($csv);

$fp = fopen($csv, "a");
if (!$fp) fail("Impossible d'ouvrir le fichier de candidatures.");

if (!$exists) {
  fputcsv($fp, ["date", "nom", "prenom", "ine", "naissance", "email", "tel", "adresse", "formation", "campus", "cv_file", "lm_file"]);
}

fputcsv($fp, [
  date("Y-m-d H:i:s"),
  $nom, $prenom, $ine, $naissance, $email, $tel, $adresse, $formation, $campus,
  $cvName, $lmName
]);

fclose($fp);

// ====== Success page ======
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidature envoyée</title>
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
        <a class="pill" href="formations.html">Formations</a>
        <a class="pill" href="campus.html">Campus</a>
        <a class="pill" href="enseignants.html">Enseignants</a>
        <a class="pill" href="contact.html">Contact</a>
        <a class="pill" href="candidature.html">Candidater</a>
      </div>
    </div>
  </div>
</header>

<main class="page">
  <div class="container">
    <h1 class="h-accent">Candidature envoyée ✓</h1>
    <p style="margin-top:10px;color:var(--muted);line-height:1.6;">
      Merci <b><?php echo $prenom . " " . $nom; ?></b> !<br>
      Votre dossier a été enregistré.
    </p>

    <div style="margin-top:14px; padding:14px; border-radius:14px; border:1px solid rgba(255,255,255,.12); background:rgba(0,0,0,.10);">
      <div><b>Formation</b> : <?php echo $formation; ?></div>
      <div><b>Campus</b> : <?php echo $campus; ?></div>
      <div style="margin-top:8px;color:var(--muted);font-size:12px;">
        Fichiers enregistrés : <?php echo $cvName; ?>, <?php echo $lmName; ?>
      </div>
    </div>

    <a class="pill" style="margin-top:14px; display:inline-flex;" href="accueil.html">Retour à l’accueil</a>
  </div>
</main>

</body>
</html>

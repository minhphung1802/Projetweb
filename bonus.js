// BONUS 1 — Animation header au scroll
window.addEventListener("scroll", function(){

  const header = document.querySelector(".header");

  if(window.scrollY > 50){
    header.style.background = "#1e1e24";
    header.style.transition = "0.3s";
  }
  else{
    header.style.background = "transparent";
  }

});


// BONUS 2 — Bouton retour en haut
const btn = document.createElement("button");

btn.textContent = "↑";
btn.style.position = "fixed";
btn.style.bottom = "20px";
btn.style.right = "20px";
btn.style.padding = "10px";
btn.style.borderRadius = "50%";
btn.style.border = "none";
btn.style.cursor = "pointer";
btn.style.display = "none";

document.body.appendChild(btn);

window.addEventListener("scroll", function(){

  if(window.scrollY > 300){
    btn.style.display = "block";
  }
  else{
    btn.style.display = "none";
  }

});

btn.addEventListener("click", function(){

  window.scrollTo({
    top:0,
    behavior:"smooth"
  });

});


// BONUS 3 — Animation au hover des cards
const cards = document.querySelectorAll(".card");

cards.forEach(card => {

  card.addEventListener("mouseenter", () => {
    card.style.transform = "scale(1.05)";
    card.style.transition = "0.3s";
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "scale(1)";
  });

});

// Reveal on scroll (premium, léger)
(function(){
  const els = document.querySelectorAll(".reveal");
  if(!els.length) return;

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if(e.isIntersecting) e.target.classList.add("is-in");
    });
  }, { threshold: 0.12 });

  els.forEach(el => io.observe(el));
})();

// =========================
// CARROUSEL (Accueil)
// =========================
(function(){
  const root = document.querySelector("[data-carousel]");
  if(!root) return;

  const track = root.querySelector(".carousel-track");
  const slides = Array.from(root.querySelectorAll(".carousel-slide"));
  const prev = root.querySelector(".carousel-btn--prev");
  const next = root.querySelector(".carousel-btn--next");
  const dots = Array.from(document.querySelectorAll(".carousel-dots .dot"));

  let index = 0;
  let timer = null;

  function go(i){
    index = (i + slides.length) % slides.length;
    track.style.transform = `translateX(-${index * 100}%)`;

    dots.forEach((d, k) => d.classList.toggle("is-active", k === index));
  }

  function start(){
    stop();
    timer = setInterval(() => go(index + 1), 4500);
  }

  function stop(){
    if(timer) clearInterval(timer);
    timer = null;
  }

  prev.addEventListener("click", () => { go(index - 1); start(); });
  next.addEventListener("click", () => { go(index + 1); start(); });

  dots.forEach((d, i) => {
    d.addEventListener("click", () => { go(i); start(); });
  });

  // Pause au survol
  root.addEventListener("mouseenter", stop);
  root.addEventListener("mouseleave", start);

  // Touch (mobile)
  let x0 = null;
  root.addEventListener("touchstart", (e) => { x0 = e.touches[0].clientX; }, { passive:true });
  root.addEventListener("touchend", (e) => {
    if(x0 === null) return;
    const x1 = e.changedTouches[0].clientX;
    const dx = x1 - x0;
    x0 = null;
    if(Math.abs(dx) > 40){
      go(index + (dx < 0 ? 1 : -1));
      start();
    }
  });

  // Init
  go(0);
  start();
})();
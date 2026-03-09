// =========================
// BONUS 1 — Header animation au scroll
// =========================
(function(){

  const header = document.querySelector(".header");
  if(!header) return;

  window.addEventListener("scroll", () => {

    if(window.scrollY > 50){
      header.style.background = "#1e1e24";
      header.style.transition = "background 0.3s ease";
    }
    else{
      header.style.background = "transparent";
    }

  });

})();



// =========================
// BONUS 2 — Bouton retour en haut
// =========================
(function(){

  const btn = document.createElement("button");

  btn.textContent = "↑";

  btn.style.position = "fixed";
  btn.style.bottom = "20px";
  btn.style.right = "20px";
  btn.style.width = "40px";
  btn.style.height = "40px";
  btn.style.borderRadius = "50%";
  btn.style.border = "none";
  btn.style.background = "#43bfe9";
  btn.style.color = "#fff";
  btn.style.fontSize = "18px";
  btn.style.cursor = "pointer";
  btn.style.display = "none";
  btn.style.zIndex = "999";
  btn.style.boxShadow = "0 4px 10px rgba(0,0,0,0.3)";

  document.body.appendChild(btn);

  window.addEventListener("scroll", () => {

    if(window.scrollY > 300){
      btn.style.display = "block";
    }
    else{
      btn.style.display = "none";
    }

  });

  btn.addEventListener("click", () => {

    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });

  });

})();



// =========================
// BONUS 3 — Hover animation cards
// =========================
(function(){

  const cards = document.querySelectorAll(".card");

  cards.forEach(card => {

    card.style.transition = "transform 0.3s ease";

    card.addEventListener("mouseenter", () => {
      card.style.transform = "scale(1.05)";
    });

    card.addEventListener("mouseleave", () => {
      card.style.transform = "scale(1)";
    });

  });

})();



// =========================
// BONUS 4 — Reveal animation
// =========================
(function(){

  const els = document.querySelectorAll(".reveal");
  if(!els.length) return;

  const observer = new IntersectionObserver((entries) => {

    entries.forEach(entry => {

      if(entry.isIntersecting){
        entry.target.classList.add("is-in");
        observer.unobserve(entry.target);
      }

    });

  }, { threshold: 0.15 });

  els.forEach(el => observer.observe(el));

})();



// =========================
// BONUS 5 — CARROUSEL PREMIUM
// =========================
(function(){

  const root = document.querySelector("[data-carousel]");
  if(!root) return;

  const track = root.querySelector(".carousel-track");
  const slides = Array.from(root.querySelectorAll(".carousel-slide"));
  const prev = root.querySelector(".carousel-btn--prev");
  const next = root.querySelector(".carousel-btn--next");

  let dots = Array.from(document.querySelectorAll(".carousel-dots .dot"));

  let index = 0;
  let timer = null;



  // Sécurité : créer dots si pas assez
  const dotsContainer = document.querySelector(".carousel-dots");

  if(dotsContainer && dots.length !== slides.length){

    dotsContainer.innerHTML = "";

    slides.forEach((_, i) => {

      const dot = document.createElement("button");
      dot.className = "dot";
      if(i === 0) dot.classList.add("is-active");

      dotsContainer.appendChild(dot);

    });

    dots = Array.from(dotsContainer.querySelectorAll(".dot"));

  }



  function update(){

    track.style.transform = `translateX(-${index * 100}%)`;

    dots.forEach((dot, i) => {
      dot.classList.toggle("is-active", i === index);
    });

  }



  function go(i){

    index = (i + slides.length) % slides.length;
    update();

  }



  function nextSlide(){

    go(index + 1);

  }



  function start(){

    stop();
    timer = setInterval(nextSlide, 5000);

  }



  function stop(){

    if(timer){
      clearInterval(timer);
      timer = null;
    }

  }



  // Boutons
  if(prev){
    prev.addEventListener("click", () => {
      go(index - 1);
      start();
    });
  }

  if(next){
    next.addEventListener("click", () => {
      go(index + 1);
      start();
    });
  }



  // Dots
  dots.forEach((dot, i) => {

    dot.addEventListener("click", () => {

      go(i);
      start();

    });

  });



  // Pause hover
  root.addEventListener("mouseenter", stop);
  root.addEventListener("mouseleave", start);



  // Touch mobile
  let startX = null;

  root.addEventListener("touchstart", e => {

    startX = e.touches[0].clientX;

  }, { passive: true });



  root.addEventListener("touchend", e => {

    if(startX === null) return;

    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;

    if(Math.abs(diff) > 40){

      if(diff > 0) nextSlide();
      else go(index - 1);

      start();

    }

    startX = null;

  });



  // Init
  update();
  start();

})();
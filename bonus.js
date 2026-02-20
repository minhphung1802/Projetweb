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

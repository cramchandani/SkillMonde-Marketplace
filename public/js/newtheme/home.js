const slider = document.querySelector('.featuredright');
const featuredbutton = document.querySelector('.featuredactiveback');
const featuredactiveforword = document.querySelector('.featuredactiveforword');

let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) * 3;
  slider.scrollLeft = scrollLeft - walk;
});

function scrollForward() {
  slider.scrollLeft += 200;
}

function scrollBack() {
  slider.scrollLeft -= 200;
}

featuredbutton.onmouseover = function() {
  featuredbutton.classList.remove('border-dark') 
  featuredbutton.classList.add('border-success') 
}

featuredactiveforword.onmouseover = function() {
  featuredactiveforword.classList.remove('border-dark') 
  featuredactiveforword.classList.add('border-success') 
}

featuredbutton.mouseleave  = function() {
  featuredbutton.classList.remove('border-success') 
  featuredbutton.classList.add('border-dark') 
}

featuredactiveforword.mouseleave  = function() {
  featuredactiveforword.classList.remove('border-success') 
  featuredactiveforword.classList.add('border-dark') 
}

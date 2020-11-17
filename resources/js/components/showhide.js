let pickButtons = document.querySelectorAll('.pick--extended--button');

pickButtons.forEach((button) => {
  button.addEventListener('click',(e)=>{
    e.target.previousElementSibling.classList.toggle('expanded');
    e.target.innerText = (e.target.innerText == 'Read more') ? 'Hide' : 'Read more';
  });
});
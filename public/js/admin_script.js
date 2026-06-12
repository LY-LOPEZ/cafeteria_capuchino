let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active')
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}

subImages = document.querySelectorAll('.update-product .image-container .sub-images img');
mainImage = document.querySelector('.update-product .image-container .main-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      let src = images.getAttribute('src');
      mainImage.src = src;
   }
});

document.querySelectorAll('.table_header').forEach((header) => {
   const input = header.querySelector('input');
   const button = header.querySelector('button');
   const table = header.nextElementSibling?.querySelector('table');

   if (!input || !table) return;

   const filterTable = () => {
      const query = input.value.toLowerCase().trim();
      table.querySelectorAll('tbody tr').forEach((row) => {
         row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
      });
   };

   input.addEventListener('input', filterTable);
   button?.addEventListener('click', filterTable);
});

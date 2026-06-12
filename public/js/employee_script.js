let profile = document.querySelector(".header .flex .profile");
let navbar = document.querySelector(".header .flex .navbar");
let userBtn = document.querySelector("#user-btn");
let menuBtn = document.querySelector("#menu-btn");

if (userBtn && profile && navbar) {
  userBtn.onclick = () => {
    profile.classList.toggle("active");
    navbar.classList.remove("active");
  };
}

if (menuBtn && profile && navbar) {
  menuBtn.onclick = () => {
    navbar.classList.toggle("active");
    profile.classList.remove("active");
  };
}

window.onscroll = () => {
  profile?.classList.remove("active");
  navbar?.classList.remove("active");
};

const subImages = document.querySelectorAll(
  ".update-product .image-container .sub-images img"
);
const mainImage = document.querySelector(
  ".update-product .image-container .main-image img"
);

subImages.forEach((images) => {
  images.onclick = () => {
    let src = images.getAttribute("src");
    if (mainImage) mainImage.src = src;
  };
});

document.querySelectorAll(".table_header").forEach((header) => {
  const input = header.querySelector("input");
  const button = header.querySelector("button");
  const table = header.nextElementSibling?.querySelector("table");

  if (!input || !table) return;

  const filterTable = () => {
    const query = input.value.toLowerCase().trim();
    table.querySelectorAll("tbody tr").forEach((row) => {
      row.style.display = row.textContent.toLowerCase().includes(query) ? "" : "none";
    });
  };

  input.addEventListener("input", filterTable);
  button?.addEventListener("click", filterTable);
});

// Modal Logic
document.querySelectorAll('.js-order-open').forEach(btn => {
   btn.addEventListener('click', () => {
      const modalId = btn.getAttribute('data-modal-target');
      const modal = document.getElementById(modalId);
      if (modal) {
         modal.setAttribute('aria-hidden', 'false');
         modal.classList.add('active');
      }
   });
});

document.querySelectorAll('.js-proof-open').forEach(btn => {
   btn.addEventListener('click', () => {
      const src = btn.getAttribute('data-proof-src');
      const ref = btn.getAttribute('data-proof-ref');
      const modal = document.getElementById('payment-proof-modal');
      if (modal) {
         const img = modal.querySelector('#payment-proof-img');
         const refSpan = modal.querySelector('#payment-proof-ref');
         if (img) img.src = src;
         if (refSpan) refSpan.textContent = ref ? 'Ref: ' + ref : 'Comprobante QR';
         modal.setAttribute('aria-hidden', 'false');
         modal.classList.add('active');
      }
   });
});

document.querySelectorAll('.js-modal-close').forEach(btn => {
   btn.addEventListener('click', (e) => {
      const modal = e.target.closest('.order-modal');
      if (modal) {
         modal.setAttribute('aria-hidden', 'true');
         modal.classList.remove('active');
      }
   });
});


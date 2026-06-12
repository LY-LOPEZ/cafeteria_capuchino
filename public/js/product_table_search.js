const productTableSearch = document.getElementById('productTableSearch');
const productTableSearchBtn = document.getElementById('productTableSearchBtn');
const productsTable = document.getElementById('productsTable');

function filterProductRows() {
   if (!productTableSearch || !productsTable) return;

   const query = productTableSearch.value.trim().toLowerCase();
   const rows = productsTable.querySelectorAll('tbody tr');

   rows.forEach((row) => {
      const rowText = row.textContent.toLowerCase();
      row.style.display = rowText.includes(query) ? '' : 'none';
   });
}

productTableSearch?.addEventListener('input', filterProductRows);
productTableSearchBtn?.addEventListener('click', filterProductRows);

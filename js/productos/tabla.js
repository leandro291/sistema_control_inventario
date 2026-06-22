// ── tabla.js ──
// Renderizado dinámico de la tabla de productos
console.log(productos)
const tbody = document.getElementById('tbody');

function getBadgeStock(stock) {
  if (stock === 0)      return 'bg-gray-100 text-gray-500';
  if (stock <= 5)       return 'bg-red-100 text-red-600';
  if (stock <= 10)      return 'bg-yellow-100 text-yellow-700';
  return 'bg-green-100 text-green-700';
}

const renderTabla = (productos) => {
  tbody.innerHTML = '';

  productos.forEach(producto => {
    const tr = document.createElement('tr');
    tr.classList.add('hover:bg-gray-50', 'transition');

    tr.innerHTML = `
      <td class="px-5 py-3 text-gray-400 font-mono">${producto.id}</td>
      <td class="px-5 py-3 font-medium text-gray-800">${producto.nombre}</td>
      <td class="px-5 py-3 text-gray-600">$${producto.precio}</td>
      <td class="px-5 py-3">
        <span class="${getBadgeStock(producto.stock)} text-xs px-2 py-0.5 rounded-full">
          ${producto.stock}
        </span>
      </td>
      <td class="px-5 py-3 text-gray-600">${producto.categoria}</td>
      <td class="px-5 py-3 text-gray-600">${producto.marca}</td>
      <td class="px-5 py-3 text-gray-600">${producto.zona}</td>
    `;

      tbody.appendChild(tr);
  });
};

// Renderizar al cargar la página
renderTabla(productos);

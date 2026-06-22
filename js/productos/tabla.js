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
      <td class="px-5 py-3 text-center">
        <button onclick='abrirModalEditarProducto(${JSON.stringify(producto)})' class="text-blue-500 hover:text-blue-700 mr-2" title="Editar">✏️</button>
        <button onclick="confirmarEliminarProducto(${producto.id})" class="text-red-500 hover:text-red-700" title="Eliminar">🗑️</button>
      </td>
    `;

      tbody.appendChild(tr);
  });
};

// Renderizar al cargar la página
renderTabla(productos);

function abrirModalEditarProducto(prod) {
  document.getElementById('edit_id_producto').value = prod.id;
  document.getElementById('edit_nombre_producto').value = prod.nombre;
  document.getElementById('edit_precio_producto').value = prod.precio;
  document.getElementById('edit_stock_producto').value = prod.stock;
  
  const selectCategoria = document.getElementById('edit_categoria_producto');
  Array.from(selectCategoria.options).forEach(opt => { if(opt.text === prod.categoria) selectCategoria.value = opt.value; });
  
  const selectMarca = document.getElementById('edit_marca_producto');
  Array.from(selectMarca.options).forEach(opt => { if(opt.text === prod.marca) selectMarca.value = opt.value; });

  const selectZona = document.getElementById('edit_zona_producto');
  Array.from(selectZona.options).forEach(opt => { if(opt.text === prod.zona) selectZona.value = opt.value; });

  document.getElementById('modal-editar').style.display = 'flex';
}

function confirmarEliminarProducto(id) {
  if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
    document.getElementById('delete_id_producto').value = id;
    document.getElementById('form-eliminar-producto').submit();
  }
}

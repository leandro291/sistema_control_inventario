// ── tabla.js ──
// Renderizado dinámico de la tabla de proveedores

const tbody = document.getElementById('tbody');

const renderTabla = (datos) => {
  tbody.innerHTML = '';

  datos.forEach(proveedor => {
    const tr = document.createElement('tr');
    tr.classList.add('hover:bg-gray-50', 'transition');

    tr.innerHTML = `
      <td class="px-5 py-3 text-gray-400 font-mono">${proveedor.id}</td>
      <td class="px-5 py-3 text-gray-600">${proveedor.ruc}</td>
      <td class="px-5 py-3 font-medium text-gray-800">${proveedor.nombre}</td>
      <td class="px-5 py-3 text-gray-600">${proveedor.correo}</td>
    `;

    tbody.appendChild(tr);
  });
};

// Renderizar al cargar la página
renderTabla(proveedores);

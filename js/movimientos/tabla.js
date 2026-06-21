// ── tabla.js ──
// Renderizado dinámico de la tabla de movimientos

const tbody = document.getElementById('tbody');

const getBadgeTipo = (tipo) => {
  if (tipo === 'Entrada') return 'bg-green-100 text-green-700';
  if (tipo === 'Salida')  return 'bg-red-100 text-red-700';
  return 'bg-gray-100 text-gray-700';
};

const renderTabla = (datos) => {
  tbody.innerHTML = '';

  datos.forEach(movimiento => {
    const tr = document.createElement('tr');
    tr.classList.add('hover:bg-gray-50', 'transition');

    tr.innerHTML = `
      <td class="px-5 py-3 text-gray-400 font-mono">${movimiento.id}</td>
      <td class="px-5 py-3 text-gray-600">${movimiento.fecha}</td>
      <td class="px-5 py-3">
        <span class="${getBadgeTipo(movimiento.tipo)} text-xs px-2 py-0.5 rounded-full">
          ${movimiento.tipo}
        </span>
      </td>
      <td class="px-5 py-3 font-medium text-gray-800">${movimiento.proveedor}</td>
    `;

    tbody.appendChild(tr);
  });
};

// Renderizar al cargar la página
renderTabla(movimientos);

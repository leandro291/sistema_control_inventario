// ── tabla.js ──
// Renderizado dinámico de la tabla de proveedores

const tbody = document.getElementById('tbody');

const renderTabla = (proveedores) => {
  tbody.innerHTML = '';

  proveedores.forEach(proveedor => {
    const tr = document.createElement('tr');
    tr.classList.add('hover:bg-gray-50', 'transition');

    tr.innerHTML = `
      <td class="px-5 py-3 text-gray-400 font-mono">${proveedor.id}</td>
      <td class="px-5 py-3 text-gray-600">${proveedor.ruc_dni}</td>
      <td class="px-5 py-3 font-medium text-gray-800">${proveedor.nombre}</td>
      <td class="px-5 py-3 text-gray-600">${proveedor.correo}</td>
      <td class="px-5 py-3 text-center">
        <button onclick='abrirModalEditarProveedor(${JSON.stringify(proveedor)})' class="text-blue-500 hover:text-blue-700 mr-2" title="Editar">✏️</button>
        <button onclick="confirmarEliminarProveedor(${proveedor.id})" class="text-red-500 hover:text-red-700" title="Eliminar">🗑️</button>
      </td>
    `;

    tbody.appendChild(tr);
  });
};

// Renderizar al cargar la página
renderTabla(proveedores);

function abrirModalEditarProveedor(prov) {
  document.getElementById('edit_id_proveedor').value = prov.id;
  document.getElementById('edit_ruc').value = prov.ruc_dni;
  document.getElementById('edit_nombre').value = prov.nombre;
  document.getElementById('edit_correo').value = prov.correo;
  
  document.getElementById('modal-editar').style.display = 'flex';
}

function confirmarEliminarProveedor(id) {
  if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
    document.getElementById('delete_id_proveedor').value = id;
    document.getElementById('form-eliminar-proveedor').submit();
  }
}

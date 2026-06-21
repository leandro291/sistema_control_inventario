// ── productos.js ──
// Lógica de la página de Productos

// ── Referencias del DOM ──────────────────────────────────────────
const input         = document.getElementById('search-input');
const filas         = document.querySelectorAll('#tbody tr');
const sinResultados = document.getElementById('sin-resultados');
const contador      = document.getElementById('contador');
const modal         = document.getElementById('modal');
const btnAbrir      = document.getElementById('btn-registrar');
const btnCerrar     = document.getElementById('btn-cerrar-modal');
const backdrop      = document.getElementById('modal-backdrop');
const formProducto  = document.getElementById('form-producto');

// ── Búsqueda en tiempo real ──────────────────────────────────────
input.addEventListener('input', () => {
  const query = input.value.toLowerCase().trim();
  let visibles = 0;

  filas.forEach(fila => {
    const texto    = fila.textContent.toLowerCase();
    const coincide = texto.includes(query);
    fila.classList.toggle('hidden', !coincide);
    if (coincide) visibles++;
  });

  sinResultados.classList.toggle('hidden', visibles > 0);
  contador.innerHTML = `Mostrando <strong class="text-gray-600">${visibles}</strong> producto${visibles !== 1 ? 's' : ''}`;
});

// ── Modal: abrir / cerrar ────────────────────────────────────────
function abrirModal() {
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function cerrarModal() {
  modal.classList.add('hidden');
  document.body.style.overflow = '';
  formProducto.reset();
  // Ocultar todos los campos de "añadir nuevo"
  ['categoria', 'marca', 'zona'].forEach(campo => {
    document.getElementById(`nueva-${campo}`).classList.add('hidden');
    document.getElementById(`input-nueva-${campo}`).value = '';
  });
}

btnAbrir.addEventListener('click', abrirModal);
btnCerrar.addEventListener('click', cerrarModal);
backdrop.addEventListener('click', cerrarModal);

// Cerrar con tecla Escape
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') cerrarModal();
});

// ── Campos dinámicos: mostrar input de nuevo valor ───────────────
function mostrarAgregar(campo) {
  const div = document.getElementById(`nueva-${campo}`);
  const input = document.getElementById(`input-nueva-${campo}`);
  div.classList.toggle('hidden');
  if (!div.classList.contains('hidden')) {
    input.focus();
  }
}

// ── Campos dinámicos: confirmar y añadir al select ───────────────
function confirmarAgregar(campo) {
  const input  = document.getElementById(`input-nueva-${campo}`);
  const select = document.getElementById(`f-${campo}`);
  const valor  = input.value.trim();

  if (!valor) return;

  // Verificar que no exista ya
  const existe = Array.from(select.options).some(
    opt => opt.text.toLowerCase() === valor.toLowerCase()
  );

  if (!existe) {
    const nuevaOpcion = new Option(valor, valor);
    select.add(nuevaOpcion);
  }

  // Seleccionar la opción recién añadida
  select.value = valor;

  // Limpiar y ocultar el input
  input.value = '';
  document.getElementById(`nueva-${campo}`).classList.add('hidden');
}

// Confirmar con Enter en los inputs de nuevo valor
['categoria', 'marca', 'zona'].forEach(campo => {
  document.getElementById(`input-nueva-${campo}`)
    .addEventListener('keydown', e => {
      if (e.key === 'Enter') {
        e.preventDefault();
        confirmarAgregar(campo);
      }
    });
});

// ── Envío del formulario ─────────────────────────────────────────
formProducto.addEventListener('submit', e => {
  e.preventDefault();

  const nombre    = document.getElementById('f-nombre').value.trim();
  const precio    = document.getElementById('f-precio').value.trim();
  const stock     = document.getElementById('f-stock').value.trim();
  const categoria = document.getElementById('f-categoria').value;
  const marca     = document.getElementById('f-marca').value;
  const zona      = document.getElementById('f-zona').value;

  if (!nombre || !precio || !stock || !categoria || !marca || !zona) {
    alert('Por favor completa todos los campos.');
    return;
  }

  // Generar ID correlativo
  const totalFilas = document.querySelectorAll('#tbody tr:not(.hidden)').length;
  const nuevoId    = `#${String(totalFilas + 1).padStart(3, '0')}`;

  // Color del stock
  const stockNum = parseInt(stock);
  let badgeColor = 'bg-green-100 text-green-700';
  if (stockNum === 0)       badgeColor = 'bg-gray-100 text-gray-500';
  else if (stockNum <= 5)   badgeColor = 'bg-red-100 text-red-600';
  else if (stockNum <= 10)  badgeColor = 'bg-yellow-100 text-yellow-700';

  // Insertar fila en la tabla
  const tbody = document.getElementById('tbody');
  const fila  = document.createElement('tr');
  fila.className = 'hover:bg-gray-50 transition';
  fila.innerHTML = `
    <td class="px-5 py-3 text-gray-400 font-mono">${nuevoId}</td>
    <td class="px-5 py-3 font-medium text-gray-800">${nombre}</td>
    <td class="px-5 py-3 text-gray-600">$${parseFloat(precio).toFixed(2)}</td>
    <td class="px-5 py-3"><span class="${badgeColor} text-xs px-2 py-0.5 rounded-full">${stock}</span></td>
    <td class="px-5 py-3 text-gray-600">${categoria}</td>
    <td class="px-5 py-3 text-gray-600">${marca}</td>
    <td class="px-5 py-3 text-gray-600">${zona}</td>
  `;
  tbody.appendChild(fila);

  // Actualizar contador
  const totalVisible = document.querySelectorAll('#tbody tr').length;
  contador.innerHTML = `Mostrando <strong class="text-gray-600">${totalVisible}</strong> producto${totalVisible !== 1 ? 's' : ''}`;

  cerrarModal();
});

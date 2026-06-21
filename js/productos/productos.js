// ── productos.js ──
// Lógica de la página de Productos

// ── Búsqueda en tiempo real ──────────────────────────────────────
const input         = document.getElementById('search-input');
const filas         = document.querySelectorAll('#tbody tr');
const sinResultados = document.getElementById('sin-resultados');
const contador      = document.getElementById('contador');

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

// ── Modal secundario (Categoría / Marca / Zona) ──────────────────
const titulos = {
  categoria: 'Registro de Categoría',
  marca:     'Registro de Marca',
  zona:      'Registro de Zona',
};

const labels = {
  categoria: 'Nombre de la categoría',
  marca:     'Nombre de la marca',
  zona:      'Nombre de la zona',
};

const placeholders = {
  categoria: 'Ej. Electrónica',
  marca:     'Ej. Samsung',
  zona:      'Ej. Bodega C',
};

// Campo activo en el modal secundario
let campoActivo = '';

function abrirModalSecundario(campo) {
  campoActivo = campo;

  // Actualizar textos del modal según el campo
  document.getElementById('modal-sec-titulo').textContent = titulos[campo];
  document.getElementById('modal-sec-label').textContent  = labels[campo];
  document.getElementById('modal-sec-input').placeholder  = placeholders[campo];
  document.getElementById('modal-sec-input').value        = '';

  document.getElementById('modal-secundario').style.display = 'flex';
  document.getElementById('modal-sec-input').focus();
}

function cerrarModalSecundario() {
  document.getElementById('modal-secundario').style.display = 'none';
  document.getElementById('modal-sec-input').value = '';
  campoActivo = '';
}

function confirmarModalSecundario() {
  const inputEl  = document.getElementById('modal-sec-input');
  const valor    = inputEl.value.trim();

  if (!valor) return;

  const selectEl = document.getElementById(`f-${campoActivo}`);

  // No duplicar
  const existe = Array.from(selectEl.options).some(
    opt => opt.text.toLowerCase() === valor.toLowerCase()
  );

  if (!existe) {
    selectEl.add(new Option(valor, valor));
  }

  // Seleccionar automáticamente la nueva opción
  selectEl.value = valor;

  cerrarModalSecundario();
}

// Confirmar con Enter desde el input del modal secundario
document.getElementById('modal-sec-input').addEventListener('keydown', e => {
  if (e.key === 'Enter') confirmarModalSecundario();
});

import { getCurrentYear } from './utils/getYear.js';

/**
 * Inicializa la aplicación y agrega el año actual al pie de página
 *
 * @function iniciarApp
 */
document.addEventListener('DOMContentLoaded', iniciarApp);

/**
 * Agrega el año actual al pie de página
 *
 * @function addYearToFooter
 */
function addYearToFooter() {
    const dateSlot = document.querySelector('footer span');
    dateSlot.textContent = getCurrentYear();
}

/**
 * Inicializa la aplicación
 *
 * @function iniciarApp
 */
function iniciarApp() {
    addYearToFooter();
}

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

/**
 * Funcion que hace un console.warn con un mensaje de prueba
 * 
 * @function testWarningWorkflow
 * @param {String} message 
 * @param {Boolean} throwWarning 
 * @throws {Error} 
 * @returns {String} 
 */
export function testWarningWorkflow(message, throwWarning) {
    if (throwWarning) {
        console.warn('Este es un warning de prueba');
    }
    console.log(message);
    return 'La prueba de warning termino exitosamente';
}

/**
 * Funcion que hace un console.log con un mensaje de prueba
 * 
 * @function testWorkflow
 * @param {String} message 
 * @param {Boolean} throwError 
 * @throws {Error} 
 * @returns {String} 
 */
export function testWorkflow(message, throwError) {
    if (throwError) {
        throw new Error('Este es un error de prueba');
    }
    console.log(message);
    return 'La prueba termino exitosamente';
}

/**
 * Calculate the diference of two numbers
 * 
 * @function sum
 * @param {Number} a - The first number
 * @param {Number} b - The second number
 * @returns {Number} The diference of a and b
 */
export function restar(a, b) {
    return a - b;
}


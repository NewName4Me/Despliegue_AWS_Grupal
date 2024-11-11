/**
 * Funcion que devuelve la suma de dos numeros
 * @param {number} num1 - primer numero
 * @param {number} num2 - segundo numero
 * @returns {number} suma de los dos numeros
 */
function suma(num1, num2) {
    return num1 + num2;
}

/**
 * Funcion que concatena dos strings
 * @param {string} str1 - primer string
 * @param {string} str2 - segundo string
 * @returns {string} concatenacion de los dos strings
 */
function concatenar(str1, str2) {
    return str1 + str2;
}

/**
 * Funcion que devuelve el mayor de dos numeros
 * @param {number} num1 - primer numero
 * @param {number} num2 - segundo numero
 * @returns {number} mayor de los dos numeros
 */
function mayor(num1, num2) {
    return num1 > num2 ? num1 : num2;
}

/**
 * Funcion que devuelve la longitud de un string
 * @param {string} str - string
 * @returns {number} longitud del string
 */
function longitud(str) {
    return str.length;
}

/**
 * Funcion que devuelve el tipo de dato de una variable
 * @param {*} variable - variable a evaluar
 * @returns {string} tipo de dato de la variable
 */
function tipoDato(variable) {
    return typeof variable;
}

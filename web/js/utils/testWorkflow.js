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


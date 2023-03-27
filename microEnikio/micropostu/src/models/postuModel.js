const mysql = require('mysql2/promise');
const connection = mysql.createPool({
host: 'localhost',
user: 'root',
password: '',
database: 'enikio'
});

async function crearPostulacion(id_apto, cc_postulado, ocupacion, interes) {
const result = await connection.query('INSERT INTO postulaciones VALUES (?, ?, Now(), ?, ?, "pendiente")', [id_apto, cc_postulado, ocupacion, interes]);
return result;
} 

async function postuPorApto(id) {
    const result = await connection.query('SELECT * FROM postulaciones WHERE id_apto = ?', id);
    return result;
}

async function getPostulaciones(id) {
    const result = await connection.query('SELECT u.nombre, u.email, u.celular, p.cc_postulado, p.fecha, p.ocupacion, p.interes, p.estado FROM postulaciones p JOIN usuarios u ON p.cc_postulado = u.cc WHERE p.id_apto = ?', id);
    return result[0];
}

//falta meterle la columna de estado y asi mismo el query y la parte en controller que deje de mostrar aquellos que estan en "rezhazado"


module.exports = {
    postuPorApto,
    crearPostulacion,
    getPostulaciones
};

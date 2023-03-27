const express = require('express');
const postuController = require('./controllers/postuController');
const morgan = require('morgan');
const app = express();
app.use(morgan('dev'));
app.use(express.json());
app.use(postuController);
app.listen(3003, () => {
console.log('Microservicio Postulaciones escuchando en el puerto 3003');
});
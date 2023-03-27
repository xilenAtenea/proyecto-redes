const express = require('express');
const router = express.Router();
const axios = require('axios');
const postuModel = require('../models/postuModel');


router.get('/postu/aptos/:id_apto', async (req, res) => {
    const id_apto = req.params.id_apto;
    result = await postuModel.getPostulaciones(id_apto);
    res.json(result);
});


router.get('/postu/:id_apto', async (req, res) => {
    const id_apto = req.params.id_apto;
    result = await postuModel.postuPorApto(id_apto);
    res.json(result);
});

router.post('/postu/crearpostulacion', async (req, res) => {
    const id_apto = req.body.id_apto;
    const cc_postulado = req.body.cc_postulado;
    const ocupacion = req.body.ocupacion;
    const interes = req.body.interes;
    var result = await postuModel.crearPostulacion(id_apto, cc_postulado, ocupacion, interes);
    res.json(result);
}); 

module.exports = router;
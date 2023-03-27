const express = require('express');
const router = express.Router();
const axios = require('axios');
const aptosModel = require('../models/aptosModel');



router.get('/aptos/usuarios/:cc', async (req, res) => {
  const cc = req.params.cc;
  var result = await aptosModel.getPropiedadesArr(cc);
  res.json(result);
});

router.get('/apartamentos', async (req, res) => {
  var result = await aptosModel.getAllAptos();
  res.json(result);
});


router.put('/aptos/:id_apto', async (req, res) => {
  const id_apto = req.params.id_apto;
  const hab_disponibles = req.body.hab_disponibles;
  if (hab_disponibles < 0) {
    res.send("hab_disponibles no puede ser menor de cero");
    return;
  }
  var result = await aptosModel.actualizarApto(id_apto, hab_disponibles);
  res.send("inventario de producto actualizado");
});


router.get('/aptos/:id_apto', async (req, res) => {
  const id_apto = req.params.id_apto;
  var result;
  result = await aptosModel.traerApto(id_apto);
  res.json(result[0]);
});

router.get('/aptos/coords/:nombre', async (req, res) => {
  const nombre = req.params.nombre;
  var result; 
  result = await aptosModel.getCoords(nombre);
  res.json(result[0]);
});

router.get('/universidades', async (req, res) => {
  var result;
  result = await aptosModel.getUniversidad();
  res.json(result);
});

router.get('/metrics', async (req, res) => {
  var result;
  result = await aptosModel.getMetrics();
  res.json(result);
});

router.post('/coords', async (req, res) => {
  const coord = req.body.coord
  var result;
  result = await aptosModel.getCloseAptos(coord);
  res.json(result);
});



module.exports = router;
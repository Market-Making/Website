const request = require('request')
const express = require('express')

const router = express.Router()
const qs = require('qs')

router.all('/', (req, res) => {
  const { method } = req
  const basePath = 'http://147.182.251.92:3001'
  const url = basePath + req.baseUrl.replace('api','')

  const opt = {
    method: req.method,
    url,
    headers: {
      'Content-Type': 'application/json; charset=UTF-8',
      'Accept': '*/*', 
      'Host': basePath.split('//')[1], 
      'Connection': 'keep-alive'
    },
  }
  if (method === 'GET') {
    opt.qs = req.query
  } else {
    opt.body = JSON.stringify(req.body.body)
    delete req.body.body
    opt.qs = req.body
  }
  request(opt, (error, response, body) => {
    try {
      if (!error) {
        if (response && response.statusCode) {
          res.status(response.statusCode)
        }
        res.json(body)
      } else {
        res.json({ code: 1, message: typeof error === 'string' ? error : JSON.stringify(error), data: [] })
      }
    } catch (error) { // eslint-disable-line
      res.json({ code: 1, message: '发生错误!', error, data: [] });
    }
  })

})

module.exports = router

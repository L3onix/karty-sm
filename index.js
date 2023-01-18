// import { Redis } from './src/services/Redis';
const Redis = require('./src/services/Redis');

/*
require('dotenv').config()
const express = require('express')
const app = express()
const port = process.env.APP_PORT

app.get('/', (req, res) => {
    res.send('hello world')
})

app.listen(port, () => {
    console.log('Running application!')
})
*/

const redis = new Redis();
const queue = redis.getQueue('teste');
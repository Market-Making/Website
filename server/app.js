const express = require('express')
const path = require('path')
const logger = require('morgan')
const cookieParser = require('cookie-parser')
const bodyParser = require('body-parser')
const compression = require('compression')
const ejs = require('ejs')

const initRoute = require('./route')

const app = express({env:'development'})

// view engine setup
app.set('views', path.join(__dirname, 'views'))
app.engine('html', ejs.__express) 
app.set('view engine', 'html')

app.use(compression())
app.use(logger('dev'))

app.use(bodyParser.json({limit: '100mb'}))
app.use(bodyParser.urlencoded({limit: '100mb', extended: true}))
app.use(cookieParser())
app.use(express.static(path.join(__dirname, '..', 'public'), {
  maxAge: '1y',
}))

initRoute(app)

// catch 404 and forward to error handler
app.use((req, res, next) => {
  const err = new Error('Not Found')
  err.status = 404
  next(err)
})

// error handler
app.use((err, req, res) => {
  // set locals, only providing error in development
  res.locals.message = err.message
  res.locals.error = app.get('env') === 'development' ? err : {}

  // render the error page
  res.status(err.status || 500)
  res.render('error')
})

module.exports = app

/**
 * 根据axios封装的接口数据请求工具
 */
 import axios from 'axios'
 import { message } from 'antd'
 
 const CancelToken = axios.CancelToken// eslint-disable-line
 
 export default {
   post(opts) {
     const params = opts.data || opts.body || {}
     const showError = opts.showError === undefined ? true : opts.showError
     const rSymbol = opts.rSymbol || params.rSymbol
     delete params.successTip
     delete params.rSymbol
     const optsUrl = opts.url
     const { token, cancel } = CancelToken.source()
     if (rSymbol) {
       window.GLOBAL.requestSymbols[rSymbol] = cancel
     }
     return axios.post(optsUrl, params, {
       timeout: 1000 * 120,
       cancelToken: token,
     }).then((res) => {
       if (res.status == 200) {
         if(typeof res.data == 'string') {
          return JSON.parse(res.data).output
         } 
         return false
       } else {
         if(typeof res.data == 'string') {
           opts.failed ? opts.failed(JSON.parse(res.data)) : message.error(JSON.parse(res.data).msg)
         } else {
           opts.failed ? opts.failed(JSON.parse(res.data)) : message.error(JSON.parse(res.data).msg)
         }
       }
     }, (err) => {
       opts.failed ? opts.failed(err) : console.log(err) // eslint-disable-line
       return false
     }).catch((e) => {
       if (axios.isCancel(e)) {
         console.log('Request canceled', e.message) // eslint-disable-line
       } else {
         showError && message.error('请求数据错误') // eslint-disable-line
         console.log(`Error happened:${e}`) // eslint-disable-line
       }
       return false
     })
   },
 
   /**
    * GET
    * opts.url
    * opts.data
    * opts.success
    * opts.failed
    */
   get(opts) {
     const params = opts.data || opts.body || {}
     const rSymbol = opts.rSymbol || params.rSymbol
     const showError = opts.showError === undefined ? true : opts.showError
     const { cancel } = CancelToken.source()
     if (rSymbol) {
       window.GLOBAL.requestSymbols[rSymbol] = cancel
     }
     return axios.get(opts.url, {
       params: opts.data || opts.params || {},
     }, {
       timeout: 1000 * 120,
     }).then((res) => {
       if (res.status == 200) {
         return JSON.parse(res.data).output
       } else {
         opts.failed ? opts.failed(JSON.parse(res.data)) : message.error(JSON.parse(res.data).msg)
       }
     }).catch((err) => {
       if (axios.isCancel(err)) {
         console.log('Request canceled', err.message) // eslint-disable-line
         return Promise.reject(err) // 停止继续执行await/yield后代码
       } else {
         opts.failed ? opts.failed(err) : console.error(err) // eslint-disable-line
         showError && message.error('系统异常，请稍后重试') // eslint-disable-line
         return false
       }
     })
   },
 }
 
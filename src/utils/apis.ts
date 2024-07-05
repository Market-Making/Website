const request = require('./request')

export function getActiveCoins(data: any) {
  return request.default.get({
    url: 'api/get-active-coins',
    data,
  })
}
export function getConfigData(data: any) {
  return request.default.get({
    url: 'api/get-config',
    data,
  })
}

export function startBot(data: any) {
  return request.default.get({
    url: 'api/start-bot',
    data,
  })
}

export function stopBot(data: any) {
  return request.default.get({
    url: 'api/stop',
    data,
  })
}

export function cancelBot(data: any) {
  return request.default.get({
    url: 'api/cancel',
    data,
  })
}

export function transfer(data: any) {
  return request.default.get({
    url: 'api/transfer',
    data,
  })
}

export function create_order(data: any) {
  return request.default.get({
    url: 'api/create-order',
    data,
  })
}

export function getStatus(data: any) {
  return request.default.get({
    url: 'api/get-all-status',
    data,
  })
}

export function startOtc(data: any) {
  return request.default.get({
    url: 'api/start-otc',
    data,
  })
}

export function stopOtc(data: any) {
  return request.default.get({
    url: 'api/stop-otc',
    data,
  })
}

export function getOtc(data: any) {
  return request.default.get({
    url: 'api/get-otc',
    data,
  })
}

export function getOtcStatus(data: any) {
  return request.default.get({
    url: 'api/get-otc-status',
    data,
  })
}

export function updateConfigData(data: any) {
  return request.default.post({
    url: 'api/update-config',
    data,
  })
}
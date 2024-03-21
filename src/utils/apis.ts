const request = require('./request')

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

export function getStatus(data: any) {
  return request.default.get({
    url: 'api/get-all-status',
    data,
  })
}

export function updateConfigData(data: any) {
  return request.default.post({
    url: 'api/update-config',
    data,
  })
}
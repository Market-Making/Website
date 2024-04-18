import React, { useState, useEffect } from 'react'
import { Table, Button, Tag, message, Spin } from 'antd'
import { getOtc, getOtcStatus } from '@/utils/apis'
import styles from '../MM/styles.less'

const OTC = (props: any) => {

  const [statusLoading, setStatusLoading] = useState(false)
  const [botStatus, setBotStatus] = useState([])
  const [otcRunning, setOtcRunning] = useState(false)

  const getBotStatus = async () => {
    setStatusLoading(true)
    setBotStatus([])
    const running = await getOtc({ key: 1234 })
    const data = await getOtcStatus({ key: 1234 })
    if (data) {
      let res = []
      data.map((item: any) => {
        res.push({
          exchange: item["ExchangeID"],
          uid: item["uid"],
          running: item["status"] == "Running",
          base_balance: item["balances"].find(item => item["coin"] == "USDT")["balance"],
          quote_balance: item["balances"].filter(item => item["coin"] != "USDT").map(item => `${item.balance.toFixed(2)}${item.coin}`).join(', ') || '—',
        })
      })
      setBotStatus(res)
      setOtcRunning(running)
      setStatusLoading(false)
      return res
    } else {
      setBotStatus([])
    }
  }

  const otc = async () => {
    if (otcRunning) {
      const data = await stopOtc({ key: 1234 })
      if (data == 'Successful') {
        setOtcRunning(false)
        message.success('OTC Strategy Stopped')
      }
    } else {
      const data = await startOtc({ key: 1234 })
      if (data == 'Successful') {
        setOtcRunning(true)
        message.success('OTC Strategy Started')
      }
    }
  }

  useEffect(() => {
    getBotStatus()
  }, [])

  return (
    <div>
      <div style={{ padding: '50px 250px' }}>
        <Button
          style={{ color: 'white', backgroundColor: 'black', border: '0.75px solid #333333', width: 150, height: 40, marginBottom: 20}}
          onClick={() => { otc() }}
        >
          {otcRunning ? 'Stop OTC' : 'Start OTC'}
        </Button>
        <Spin spinning={statusLoading}>
          <Table
            className={styles.nobgTable}
            dataSource={botStatus}
            columns={[
              {
                title: '#',
                dataIndex: 'id',
                render: (_, entry, index) => {
                  return (
                    <>{index + 1}</>
                  )
                },
              },
              {
                title: 'Exchange',
                dataIndex: 'exchange',
                render: (_, entry: any) => {
                  return (
                    <div>{entry.exchange}</div>
                  )
                }
              },
              {
                title: 'Uid',
                dataIndex: 'uid',
                render: (_, entry: any) => {
                  return (
                    <div>{entry.uid}</div>
                  )
                }
              },
              {
                title: 'USDT',
                dataIndex: 'base_balance',
                render: (_, entry: any) => {
                  return (
                    <div>$ {entry.base_balance}</div>
                  )
                }
              },
              {
                title: 'Coin',
                dataIndex: 'quote_balance',
                render: (_, entry: any) => {
                  return (
                    <div>{entry.quote_balance}</div>
                  )
                }
              },
              {
                title: 'Status',
                dataIndex: 'status',
                render: (_, entry) => {
                  return (
                    <>
                      {entry.running
                        ? <Tag color='green' style={{ background: 'transparent' }}>RUNNING</Tag>
                        : <Tag color='red' style={{ background: 'transparent' }}>STOPPED</Tag>
                      }
                    </>
                  )
                },
              },
            ]}
            pagination={false}
          />
        </Spin>
      </div>
    </div>
  )
}

export default OTC
import React, { useState, useEffect } from 'react'
import { Table, Button, Tag, message, Spin, Tooltip } from 'antd'
import { PauseOutlined, CaretRightOutlined, EditOutlined, TransactionOutlined, DollarOutlined, CopyrightOutlined } from '@ant-design/icons'
import { getConfigData, startBot, stopBot, cancelBot, getStatus, updateConfigData } from '@/utils/apis'
import EditModal from './EditModal'
import styles from './styles.less'

const MM = (props: any) => {

  const [showEditModal, setShowEditModal] = useState(false)
  const [strategies, setStrategies] = useState([])
  const [selectedRow, setSelectedRow] = useState()
  const [activeStrategy, setActiveStrategy] = useState('Bitmart')
  const [activeCoin, setActiveCoin] = useState('QH')
  const [configLoading, setConfigLoading] = useState(false)
  const [statusLoading, setStatusLoading] = useState(false)
  const [botStatus, setBotStatus] = useState([])
  const [totalRunning, setTotalRunning] = useState(false)

  const configTable = [
    {
      title: '#',
      dataIndex: 'id',
      render: (_, __, index) => {
        return index + 1
      },
    },
    {
      title: 'Name',
      dataIndex: 'name',
      render: (_, entry: any) => {
        return (
          <div>{entry.name}</div>
        )
      }
    },
    {
      title: 'Grid',
      dataIndex: 'grid',
      render: (_, entry) => {
        return (
          <div>{entry.name == 'Maker' ? entry.buygrid : '—'}</div>
        )
      },
    },
    {
      title: 'Order Number',
      dataIndex: 'OrderNum',
      render: (_, entry) => {
        return (
          <div>{entry.name == 'Maker' ? entry.BuyOrderNum : '—'}</div>
        )
      },
    },
    {
      title: 'Buy Ratio',
      dataIndex: 'buyAmountRatio',
      render: (_, entry) => {
        return (
          <div>{entry.name == 'Maker' ? '—' : entry.buyratio}</div>
        )
      },
    },
    {
      title: 'Sell Ratio',
      dataIndex: 'sellAmountRatio',
      render: (_, entry) => {
        return (
          <div>{entry.name == 'Maker' ? '—' : entry.sellratio}</div>
        )
      },
    },
    {
      title: 'Order Amount',
      dataIndex: 'orderAmount',
      render: (_, entry) => {
        return (
          <div>{entry.OrderAmount} USDT</div>
        )
      },
    },
    {
      title: 'Upper Boundary',
      dataIndex: 'upperBound',
      render: (_, entry) => {
        return (
          <div>{parseFloat(entry.UpperBound).toPrecision(4)}</div>
        )
      },
    },
    {
      title: 'Lower Boundary',
      dataIndex: 'lowerBound',
      render: (_, entry) => {
        return (
          <div>{parseFloat(entry.LowerBound).toPrecision(4)}</div>
        )
      },
    },
    {
      title: ' ',
      render: (_, entry, index) => (
        <Button
          type="link"
          style={{ marginLeft: -50 }}
          onClick={() => {
            setSelectedRow(entry)
            setShowEditModal(true)
          }}
        >
          <EditOutlined style={{ color: !entry.running ? 'white' : 'red' }} />
        </Button>
      ),
    }
  ]

  const save = async (row: any) => {
    setConfigLoading(true)
    let newConfig
    if (row.name == 'Maker') {
      newConfig = {
        "MakerUpperBound": parseFloat(row.UpperBound),
        "MakerLowerBound": parseFloat(row.LowerBound),
        "Maker": {
          "BuyGrid": parseFloat(row.buygrid),
          "SellGrid": parseFloat(row.sellgrid),
          "BuyOrderNum": parseFloat(row.BuyOrderNum),
          "SellOrderNum": parseFloat(row.SellOrderNum),
          "OrderAmount": parseFloat(row.OrderAmount),
          "Ask1Ratio": parseFloat(row.Ask1Ratio),
          "Ask2Ratio": parseFloat(row.Ask2Ratio),
          "Ask3Ratio": parseFloat(row.Ask3Ratio),
          "MinAsk1Ratio": parseFloat(row.MinAsk1Ratio),
          "TargetRatio": parseFloat(row.TargetRatio),
          "FillNum": parseFloat(row.FillNum),
        }
      }
    } else {
      newConfig = {
        "UpperBound": parseFloat(row.UpperBound),
        "LowerBound": parseFloat(row.LowerBound),
        "BuyAmountRatio": parseFloat(row.buyratio),
        "SellAmountRatio": parseFloat(row.sellratio),
      }
      newConfig[row.name] = {
        "OrderAmount": parseFloat(row.OrderAmount),
        "Ask1Ratio": parseFloat(row.Ask1Ratio),
        "Ask2Ratio": parseFloat(row.Ask2Ratio),
        "Ask3Ratio": parseFloat(row.Ask3Ratio),
        "Bid1Ratio": parseFloat(row.Bid1Ratio),
        "Bid2Ratio": parseFloat(row.Bid2Ratio),
        "Bid3Ratio": parseFloat(row.Bid3Ratio),
      }
    }
    const data = await updateConfigData({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeCoin,
      body: newConfig,
    })
    if (data) {
      await getConfig()
      setConfigLoading(false)
    }
  }

  const pause = async (name: string) => {
    setStatusLoading(true)
    const data = await stopBot({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeCoin,
      bot_type: name
    })
    if (data == 'Successful') {
      botStatus.find(item => item.name == name)['running'] = false
      setStatusLoading(false)
    }
  }

  const restart = async (name: string) => {
    setStatusLoading(true)
    const data = await startBot({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeCoin,
      bot_type: name
    })
    if (data == 'Successful') {
      botStatus.find(item => item.name == name)['running'] = true
      setStatusLoading(false)
    }
  }

  const cancel = async (name: string, side = "all") => {
    setStatusLoading(true)
    const data = await cancelBot({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeCoin,
      bot_type: name,
      side: side,
    })
    if (data == 'Successful') {
      setStatusLoading(false)
      message.success('Order Canceled')
    }
  }

  const pauseAll = async () => {
    botStatus.map(async item => {
      if (item.running && item.uid != 'Total Balance') {
        await stopBot({
          key: 1234,
          exchange_name: activeStrategy.toLowerCase(),
          coin_name: activeCoin,
          bot_type: item.name
        })
      }
    })
    getBotStatus()
  }

  const restartAll = async () => {
    botStatus.map(async item => {
      if (!item.running && item.uid != 'Total Balance') {
        await startBot({
          key: 1234,
          exchange_name: activeStrategy.toLowerCase(),
          coin_name: activeCoin,
          bot_type: item.name
        })
      }
    })
    getBotStatus()
  }

  const cancelAll = async (side = "all") => {
    botStatus.map(async item => {
      if (item.uid == 'Total Balance') {
        return
      }
      if (item.running) {
        await stopBot({
          key: 1234,
          exchange_name: activeStrategy.toLowerCase(),
          coin_name: activeCoin,
          bot_type: item.name
        })
      }
      await cancelBot({
        key: 1234,
        exchange_name: activeStrategy.toLowerCase(),
        coin_name: activeCoin,
        bot_type: item.name,
        side: side,
      })
      await startBot({
        key: 1234,
        exchange_name: activeStrategy.toLowerCase(),
        coin_name: activeCoin,
        bot_type: item.name
      })
    })
    getBotStatus()
  }

  const getBotStatus = async () => {
    setStatusLoading(true)
    setBotStatus([])
    const data = await getStatus({ key: 1234, exchange_name: activeStrategy.toLowerCase(), coin_name: activeCoin })
    if (data) {
      let res = []
      for (let key in data[0]) {
        res.push({
          name: key,
          uid: data[0][key]["uid"],
          subaccount: data[0][key]["subaccount"],
          running: data[0][key]["status"] == "Running",
          base_balance: data[0][key]["BaseBalance"],
          quote_balance: data[0][key]["QuoteBalance"],
        })
      }
      res.push({
        name: '',
        uid: 'Total Balance',
        subaccount: '',
        running: '',
        base_balance: data[1],
        quote_balance: data[2],
      })
      setTotalRunning(res[0].running)
      setBotStatus(res)
      setStatusLoading(false)
      return res
    } else {
      setBotStatus([])
    }
  }

  const getConfig = async () => {
    setConfigLoading(true)
    const data = await getConfigData({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeCoin
    })
    if (data.Maker) {
      const list = [
        {
          name: 'Maker',
          buygrid: data.Maker.BuyGrid,
          sellgrid: data.Maker.SellGrid,
          BuyOrderNum: data.Maker.BuyOrderNum,
          SellOrderNum: data.Maker.SellOrderNum,
          OrderAmount: data.Maker.OrderAmount,
          UpperBound: data.MakerUpperBound,
          LowerBound: data.MakerLowerBound,
          Ask1Ratio: data.Maker.Ask1Ratio,
          Ask2Ratio: data.Maker.Ask2Ratio,
          Ask3Ratio: data.Maker.Ask3Ratio,
          MinAsk1Ratio: data.Maker.MinAsk1Ratio,
          TargetRatio: data.Maker.TargetRatio,
          FillNum: data.Maker.FillNum,
        },
      ]
      if (data.Taker1) {
        list.push({
          name: 'Taker1',
          ref_pair: data.Taker1.refPair,
          OrderAmount: data.Taker1.OrderAmount,
          buyratio: data.BuyAmountRatio,
          sellratio: data.SellAmountRatio,
          UpperBound: data.UpperBound,
          LowerBound: data.LowerBound,
          Ask1Ratio: data.Taker1.Ask1Ratio,
          Ask2Ratio: data.Taker1.Ask2Ratio,
          Ask3Ratio: data.Taker1.Ask3Ratio,
          Bid1Ratio: data.Taker1.Bid1Ratio,
          Bid2Ratio: data.Taker1.Bid2Ratio,
          Bid3Ratio: data.Taker1.Bid3Ratio,
        })
      }
      setStrategies(list)
    } else {
      setStrategies([])
    }
    setConfigLoading(false)
  }

  useEffect(() => {
    activeStrategy == 'Bitmart' ? setActiveCoin('QH') :
      activeStrategy == 'XT' ? setActiveCoin('GAME') :
        activeStrategy == 'Toobit' || activeStrategy == 'MEXC' ? setActiveCoin('MAKA') :
          setActiveCoin('HUNTER')
  }, [activeStrategy])

  useEffect(() => {
    getConfig()
    getBotStatus()
  }, [activeCoin])

  return (
    <div>
      <div style={{ padding: '10px 250px 10px', display: 'grid' }}>
        <div style={{ borderBottom: '1px solid #333333', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
          <div style={{ float: 'left', display: 'flex' }}>
            <h3
              style={{ cursor: 'pointer', fontFamily: 'unset', color: activeStrategy == 'Bitmart' ? 'white' : '#ffffffb3' }}
              onClick={() => setActiveStrategy("Bitmart")}
            >
              Bitmart
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: activeStrategy == 'Digifinex' ? 'white' : '#ffffffb3' }}
              onClick={() => setActiveStrategy("Digifinex")}
            >
              Digifinex
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: activeStrategy == 'Toobit' ? 'white' : '#ffffffb3' }}
              onClick={() => setActiveStrategy("Toobit")}
            >
              Toobit
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: activeStrategy == 'MEXC' ? 'white' : '#ffffffb3' }}
              onClick={() => setActiveStrategy("MEXC")}
            >
              MEXC
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: activeStrategy == 'XT' ? 'white' : '#ffffffb3' }}
              onClick={() => setActiveStrategy("XT")}
            >
              XT.COM
            </h3>
          </div>
        </div>
        {activeStrategy == 'Digifinex' && <div style={{ float: 'left', display: 'flex', marginTop: 20 }}>
          {['HUNTER', 'MAKA', 'SEND', 'KEEP'].map(coin => {
            return <span
              style={{ cursor: 'pointer', fontFamily: 'unset', color: activeCoin == coin ? 'white' : '#ffffffb3', marginRight: 20 }}
              onClick={() => { setActiveCoin(coin) }}
            >
              {coin}
            </span>
          })}
        </div>}
        {activeStrategy == 'Bitmart' && <div style={{ float: 'left', display: 'flex', marginTop: 20 }}>
          {['QH'].map(coin => {
            return <span
              style={{ cursor: 'pointer', fontFamily: 'unset', color: activeCoin == coin ? 'white' : '#ffffffb3', marginRight: 20 }}
              onClick={() => { setActiveCoin(coin) }}
            >
              {coin}
            </span>
          })}
        </div>}
        {activeStrategy == 'Toobit' && <div style={{ float: 'left', display: 'flex', marginTop: 20 }}>
          {['MAKA'].map(coin => {
            return <span
              style={{ cursor: 'pointer', fontFamily: 'unset', color: activeCoin == coin ? 'white' : '#ffffffb3', marginRight: 20 }}
              onClick={() => { setActiveCoin(coin) }}
            >
              {coin}
            </span>
          })}
        </div>}
        {activeStrategy == 'MEXC' && <div style={{ float: 'left', display: 'flex', marginTop: 20 }}>
          {['MAKA', 'SEND', 'KEEP', 'GAME', 'GRE'].map(coin => {
            return <span
              style={{ cursor: 'pointer', fontFamily: 'unset', color: activeCoin == coin ? 'white' : '#ffffffb3', marginRight: 20 }}
              onClick={() => { setActiveCoin(coin) }}
            >
              {coin}
            </span>
          })}
        </div>}
        {activeStrategy == 'XT' && <div style={{ float: 'left', display: 'flex', marginTop: 20 }}>
          {['GAME'].map(coin => {
            return <span
              style={{ cursor: 'pointer', fontFamily: 'unset', color: activeCoin == coin ? 'white' : '#ffffffb3', marginRight: 20 }}
              onClick={() => { setActiveCoin(coin) }}
            >
              {coin}
            </span>
          })}
        </div>}
      </div>
      <div style={{ padding: '10px 250px' }}>
        <Spin spinning={configLoading}>
          <Table
            className={styles.nobgTable}
            dataSource={strategies}
            columns={configTable.filter(e => !e.hidden)}
            pagination={false}
          />
        </Spin>
      </div>
      <div style={{ padding: '20px 250px' }}>
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
                    <>{entry.uid != 'Total Balance' ? index + 1 : <></>}</>
                  )
                },
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
                title: 'SubAccount',
                dataIndex: 'subaccount',
                render: (_, entry: any) => {
                  return (
                    <div>{entry.subaccount}</div>
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
                title: activeCoin,
                dataIndex: 'quote_balance',
                render: (_, entry: any) => {
                  return (
                    <div>$ {entry.quote_balance}</div>
                  )
                }
              },
              {
                title: 'Status',
                dataIndex: 'status',
                render: (_, entry) => {
                  return (
                    <>
                      {entry.uid != 'Total Balance'
                        ? entry.running
                          ? <Tag color='green' style={{ background: 'transparent' }}>RUNNING</Tag>
                          : <Tag color='red' style={{ background: 'transparent' }}>STOPPED</Tag>
                        : <></>
                      }
                    </>
                  )
                },
              },
              {
                title: 'Operation',
                render: (_, entry, index) => (
                  <div>
                    <Button
                      type="link"
                      onClick={() => {
                        if (entry.uid == 'Total Balance') {
                          totalRunning ? pauseAll() : restartAll()
                          return
                        }
                        entry.running ? pause(entry.name) : restart(entry.name)
                      }}
                    >
                      {entry.uid == 'Total Balance' ? totalRunning
                        ? <Tooltip title="stop all"><PauseOutlined style={{ color: 'white' }} /></Tooltip>
                        : <Tooltip title="start all"><CaretRightOutlined style={{ color: 'white' }} /></Tooltip> : entry.running
                        ? <Tooltip title="stop bot"><PauseOutlined style={{ color: 'white' }} /></Tooltip>
                        : <Tooltip title="start bot"><CaretRightOutlined style={{ color: 'white' }} /></Tooltip>
                      }
                    </Button>
                    <Button
                      type="link"
                      onClick={async () => {
                        if (entry.uid == 'Total Balance') {
                          cancelAll()
                          return
                        }
                        if (entry.running) {
                          await pause(entry.name)
                        }
                        await cancel(entry.name)
                        await restart(entry.name)
                      }}
                    >
                      <Tooltip title="free all"><TransactionOutlined style={{ color: 'white' }} /></Tooltip>
                    </Button>
                    <Button
                      type="link"
                      onClick={async () => {
                        if (entry.uid == 'Total Balance') {
                          cancelAll('buy')
                          return
                        }
                        if (entry.running) {
                          await pause(entry.name)
                        }
                        await cancel(entry.name, 'buy')
                        await restart(entry.name)
                      }
                      }
                    >
                      <Tooltip title="free USDT"><DollarOutlined style={{ color: 'white' }} /></Tooltip>
                    </Button>
                    <Button
                      type="link"
                      onClick={async () => {
                        if (entry.uid == 'Total Balance') {
                          cancelAll('sell')
                          return
                        }
                        if (entry.running) {
                          await pause(entry.name)
                        }
                        await cancel(entry.name, 'sell')
                        await restart(entry.name)
                      }
                      }
                    >
                      <Tooltip title={`free ${activeCoin}`}><CopyrightOutlined style={{ color: 'white' }} /></Tooltip>
                    </Button>
                  </div>
                ),
              },
            ]}
            pagination={false}
          />
        </Spin>
      </div>
      <EditModal showModal={showEditModal} setShowModal={setShowEditModal} row={selectedRow} setRow={setSelectedRow} save={save} />
    </div>
  )
}

export default MM
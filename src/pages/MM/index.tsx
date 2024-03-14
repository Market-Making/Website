import React, { useState, useEffect } from 'react'
import { Table, Button, Tag, Space, message, Spin } from 'antd'
import { PauseOutlined, CaretRightOutlined, EditOutlined } from '@ant-design/icons'
import { getConfigData, startBot, stopBot, getStatus, updateConfigData } from '@/utils/apis'
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
      bot_type: name.replace('Taker1', 'taker_1').replace('Taker2', 'taker_2').replace('Taker3', 'taker_3')
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
      bot_type: name.replace('Taker1', 'taker_1').replace('Taker2', 'taker_2').replace('Taker3', 'taker_3')
    })
    if (data == 'Successful') {
      botStatus.find(item => item.name == name)['running'] = true
      setStatusLoading(false)
    }
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
          email: data[0][key]["email"],
          running: data[0][key]["status"] == "Running",
          base_balance: data[0][key]["BaseBalance"],
          quote_balance: data[0][key]["QuoteBalance"],
        })
      }
      res.push({
        name: '',
        uid: 'Total Balance',
        email: '',
        running: '',
        base_balance: data[1],
        quote_balance: data[2],
      })
      setBotStatus(res)
      setStatusLoading(false)
      return res
    } else {
      setBotStatus([])
    }
  }

  const getConfig = async () => {
    // const status =await getBotStatus()
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
          // running: status?.find(item => item.name == 'maker')?.running,
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
          // running: status?.find(item => item.name == 'taker_1')?.running,
        })
      }
      if (data.Taker2) {
        list.push({
          name: 'Taker2',
          ref_pair: data.Taker2.refPair,
          OrderAmount: data.Taker2.OrderAmount,
          buyratio: data.BuyAmountRatio,
          sellratio: data.SellAmountRatio,
          UpperBound: data.UpperBound,
          LowerBound: data.LowerBound,
          Ask1Ratio: data.Taker2.Ask1Ratio,
          Ask2Ratio: data.Taker2.Ask2Ratio,
          Ask3Ratio: data.Taker2.Ask3Ratio,
          Bid1Ratio: data.Taker2.Bid1Ratio,
          Bid2Ratio: data.Taker2.Bid2Ratio,
          Bid3Ratio: data.Taker2.Bid3Ratio,
          // running: status?.find(item => item.name == 'taker_2')?.running,
        })
      }
      if (data.Taker3) {
        list.push({
          name: 'Taker3',
          ref_pair: data.Taker3.refPair,
          OrderAmount: data.Taker3.OrderAmount,
          buyratio: data.BuyAmountRatio,
          sellratio: data.SellAmountRatio,
          UpperBound: data.UpperBound,
          LowerBound: data.LowerBound,
          Ask1Ratio: data.Taker3.Ask1Ratio,
          Ask2Ratio: data.Taker3.Ask2Ratio,
          Ask3Ratio: data.Taker3.Ask3Ratio,
          Bid1Ratio: data.Taker3.Bid1Ratio,
          Bid2Ratio: data.Taker3.Bid2Ratio,
          Bid3Ratio: data.Taker3.Bid3Ratio,
          // running: status?.find(item => item.name == 'taker_3')?.running,
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
      <div style={{ padding: '60px 250px 20px 250px', display: 'grid' }}>
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
          {['MAKA', 'SEND', 'KEEP', 'GAME'].map(coin => {
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
                    <>{ entry.uid != 'Total Balance' ? index + 1 : <></> }</>
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
                title: 'Email',
                dataIndex: 'email',
                render: (_, entry: any) => {
                  return (
                    <div>{entry.email}</div>
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
                  <Button
                    type="link"
                    onClick={() => {
                      entry.running ? pause(entry.name) : restart(entry.name)
                    }}
                  >
                    {entry.uid != 'Total Balance' ? entry.running ? <PauseOutlined /> : <CaretRightOutlined /> : <></>}
                  </Button>
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
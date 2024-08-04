import React, { useState, useEffect } from 'react'
import { useSearchParams } from 'react-router-dom'
import { Table, Button, Tag, message, Spin, Tooltip, Form, Input, Modal } from 'antd'
import { PauseOutlined, CaretRightOutlined, EditOutlined, TransactionOutlined, DollarOutlined, CopyrightOutlined, LinkOutlined } from '@ant-design/icons'
import { getConfigData, startBot, stopBot, cancelBot, transfer, getStatus, updateConfigData, getActiveCoins, create_order } from '@/utils/apis'
import EditModal from './EditModal'
import styles from './styles.less'

const MM = (props: any) => {

  const [params] = useSearchParams()
  const exchange = params.getAll('exchange')[0] || ''
  const coin = params.getAll('coin')[0] || ''

  const [showEditModal, setShowEditModal] = useState(false)
  const [strategies, setStrategies] = useState([])
  const [selectedRow, setSelectedRow] = useState()
  const [activeCoinList, setActiveCoinList] = useState([])
  const [configLoading, setConfigLoading] = useState(false)
  const [statusLoading, setStatusLoading] = useState(false)
  const [botStatus, setBotStatus] = useState([])
  const [totalRunning, setTotalRunning] = useState(false)

  const [showBuySell, setShowBuySell] = useState('')
  const [balance, setBalance] = useState('0')
  const [buyPrice, setBuyPrice] = useState('0')
  const [sellPrice, setSellPrice] = useState('0')
  const [buySellAmount, setBuySellAmount] = useState('0')
  const [usdtAmount, setUsdtAmount] = useState('0')
  const [botIdx, setBotIdx] = useState(0)

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
          "AskRatio": row.AskRatio.map(e => parseFloat(e)),
          "BidRatio": row.BidRatio.map(e => parseFloat(e))
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
      exchange_name: exchange.toLowerCase(),
      coin_name: coin,
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
      exchange_name: exchange.toLowerCase(),
      coin_name: coin,
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
      exchange_name: exchange.toLowerCase(),
      coin_name: coin,
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
      exchange_name: exchange.toLowerCase(),
      coin_name: coin,
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
          exchange_name: exchange.toLowerCase(),
          coin_name: coin,
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
          exchange_name: exchange.toLowerCase(),
          coin_name: coin,
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
          exchange_name: exchange.toLowerCase(),
          coin_name: coin,
          bot_type: item.name
        })
      }
      await cancelBot({
        key: 1234,
        exchange_name: exchange.toLowerCase(),
        coin_name: coin,
        bot_type: item.name,
        side: side,
      })
      await startBot({
        key: 1234,
        exchange_name: exchange.toLowerCase(),
        coin_name: coin,
        bot_type: item.name
      })
    })
    getBotStatus()
  }

  const transferToFuture = async (name: string, amount: string) => {
    await transfer({
      key: 1234,
      exchange_name: exchange.toLowerCase(),
      coin_name: coin,
      bot_type: name,
      amount: amount,
    })
    getBotStatus()
  }

  const getBotStatus = async () => {
    setStatusLoading(true)
    setBotStatus([])
    const data = await getStatus({ key: 1234, exchange_name: exchange.toLowerCase(), coin_name: coin })
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
      setSellPrice(data[3])
      setBuyPrice(data[4])
      return res
    } else {
      setBotStatus([])
    }
  }

  const getConfig = async () => {
    setConfigLoading(true)
    const data = await getConfigData({
      key: 1234,
      exchange_name: exchange.toLowerCase(),
      coin_name: coin
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
          AskRatio: data.Maker.AskRatio,
          BidRatio: data.Maker.BidRatio,
          AskNum: data.Maker.AskRatio?.filter(e => e != 0).length,
          BidNum: data.Maker.BidRatio?.filter(e => e != 0).length,
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

  const getCoins = async () => {
    const data = await getActiveCoins({ key: 1234, exchange_name: exchange.toLowerCase() })
    if (data) {
      setActiveCoinList(data)
    }
  }

  useEffect(() => {
    getCoins()
  }, [exchange])

  useEffect(() => {
    if (coin) {
      getConfig()
      getBotStatus()
    }
  }, [coin])

  useEffect(() => {
    if (showBuySell == 'Buy') {
      setBuySellAmount(usdtAmount / buyPrice)
    } else if (showBuySell == 'Sell') {
      setBuySellAmount(usdtAmount / sellPrice)
    }
  }, [usdtAmount])

  return (
    <div>
      <div style={{ padding: '10px 250px 10px', display: 'grid' }}>
        <div style={{ borderBottom: '1px solid #333333', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
          <div style={{ float: 'left', display: 'flex' }}>
            <h3
              style={{ cursor: 'pointer', fontFamily: 'unset', color: exchange == 'bitmart' ? 'white' : '#ffffffb3' }}
              onClick={() => { window.location.href = '/mm?exchange=bitmart&coin=QH' }}
            >
              Bitmart
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: exchange == 'digifinex' ? 'white' : '#ffffffb3' }}
              onClick={() => { window.location.href = '/mm?exchange=digifinex&coin=HUNTER' }}
            >
              Digifinex
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: exchange == 'toobit' ? 'white' : '#ffffffb3' }}
              onClick={() => { window.location.href = '/mm?exchange=toobit&coin=MAKA' }}
            >
              Toobit
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: exchange == 'mexc' ? 'white' : '#ffffffb3' }}
              onClick={() => { window.location.href = '/mm?exchange=mexc&coin=SNRN' }}
            >
              MEXC
            </h3>
            <h3
              style={{ marginLeft: 20, cursor: 'pointer', fontFamily: 'unset', color: exchange == 'xt' ? 'white' : '#ffffffb3' }}
              onClick={() => { window.location.href = '/mm?exchange=xt&coin=MAKA' }}
            >
              XT.COM
            </h3>
          </div>
        </div>
        <div style={{ float: 'left', display: 'flex', marginTop: 20, justifyContent: 'space-between' }}>
          <div>
            {activeCoinList.map(item => {
              return <span
                style={{ cursor: 'pointer', fontFamily: 'unset', color: coin == item ? 'white' : '#ffffffb3', marginRight: 20 }}
                onClick={() => { window.location.href = `/mm?exchange=${exchange}&coin=${item}` }}
              >
                {item}
              </span>
            })}
          </div>
          {exchange == 'mexc' && <LinkOutlined style={{ color: 'white', marginRight: 10 }} onClick={() => { window.open(`https://www.mexc.com/exchange/${coin}_USDT`) }} />}
        </div>
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
                title: coin,
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
                      <Tooltip title={`free ${coin}`}><CopyrightOutlined style={{ color: 'white' }} /></Tooltip>
                    </Button>
                    {exchange == 'mexc' && entry.name != '' && <Button
                      type="link"
                      style={{ color: 'white' }}
                      onClick={() => {
                        setBotIdx(index)
                        setBalance(entry.base_balance)
                        setShowBuySell('Buy')
                      }}
                    >
                      buy
                    </Button>}
                    {exchange == 'mexc' && entry.name != '' && <Button
                      type="link"
                      style={{ color: 'white', marginLeft: -8 }}
                      onClick={() => {
                        setBotIdx(index)
                        setBalance(entry.quote_balance)
                        setShowBuySell('Sell')
                      }}
                    >
                      sell
                    </Button>}
                  </div>
                ),
              },
            ]}
            pagination={false}
          />
        </Spin>
      </div>
      <EditModal showModal={showEditModal} setShowModal={setShowEditModal} row={selectedRow} setRow={setSelectedRow} save={save} />
      <Modal
        open={showBuySell != ''}
        className={styles.transferModal}
        footer={null}
        onCancel={() => { setShowBuySell(''); setBuySellAmount('0'); setUsdtAmount('0'); }}
      >
        <Form layout='horizontal' style={{ marginTop: 30 }}>
          {showBuySell == 'Buy'
            ? <div style={{ fontSize: 15, color: '#b6b6b5', marginBottom: 20 }}>Available: <span style={{ color: 'white' }}>{balance}</span> USDT</div>
            : <div style={{ fontSize: 15, color: '#b6b6b5', marginBottom: 20 }}>Available: <span style={{ color: 'white' }}>{(balance / sellPrice).toFixed(2)}</span> {coin} ({balance} USDT)</div>
          }
          <Form.Item>
            <div style={{ fontSize: 15, color: '#b6b6b5' }}>Price</div>
            <Input
              className={styles.myInput}
              value={showBuySell == 'Buy' ? buyPrice : sellPrice}
              onChange={(e: any) => { showBuySell == 'Buy' ? setBuyPrice(e.target.value) : setSellPrice(e.target.value) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              suffix={'USDT'}
            />
          </Form.Item>
          <Form.Item>
            <div style={{ fontSize: 15, color: '#b6b6b5' }}>
              Amount
              <span style={{ fontSize: 14, color: '#b6b6b5', marginLeft: 5 }}>( {Number(buySellAmount).toFixed(4)} {coin} )</span>
            </div>
            <Input
              className={styles.myInput}
              value={usdtAmount}
              onChange={(e: any) => { setUsdtAmount(e.target.value) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              suffix="USDT"
            />

          </Form.Item>
        </Form>
        <Button
          className={styles.confirmButton}
          disabled={!Number(buyPrice) || buyPrice == '0' || !Number(sellPrice) || sellPrice == '0' || !Number(buySellAmount) || buySellAmount == '0'}
          onClick={async () => {
            if (usdtAmount < 5) {
              message.error('Amount cannot be less than 5 USDT')
              return
            }
            if (showBuySell == 'Buy' && balance < usdtAmount) {
              message.error('Insufficient balance')
              return
            }
            setShowBuySell('')
            setBuySellAmount('0')
            setUsdtAmount('0')
            setStatusLoading(true)
            const data = await create_order({
              key: 1234,
              exchange_name: exchange.toLowerCase(),
              coin_name: coin,
              bot_type: botIdx,
              side: showBuySell.toLowerCase(),
              amount: buySellAmount,
              price: showBuySell == 'Buy' ? buyPrice : sellPrice,
            })
            if (data) {
              message.success('Order placed successfully')
            }
            setStatusLoading(false)
          }}
        >
          {showBuySell} {coin}
        </Button>
      </Modal>
    </div>
  )
}

export default MM
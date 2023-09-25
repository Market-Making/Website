import React, { useState, useEffect } from 'react'
import { Table, Button, Tag, Space, message } from 'antd'
import { PauseOutlined, CaretRightOutlined, EditOutlined } from '@ant-design/icons'
import { getConfigData, startBot, stopBot, getStatus, updateConfigData } from '@/utils/apis'
import EditModal from './EditModal'
import styles from './styles.less'

const MM = (props: any) => {

  const [showAddModal, setShowAddModal] = useState(false)
  const [showEditModal, setShowEditModal] = useState(false)
  const [configs, setConfigs] = useState()
  const [strategies, setStrategies] = useState([])
  const [selectedRow, setSelectedRow] = useState()
  const [activeStrategy, setActiveStrategy] = useState('Bitmart')

  const edit = (row: any) => {
    const list = strategies.map(e => {
      if (row.name != 'Maker' && e.name != 'Maker') {
        e.buyratio = row.buyratio
        e.sellratio = row.sellratio
        e.UpperBound = row.UpperBound
        e.LowerBound = row.LowerBound
      }
      if (e.name == row.name) {
        return row
      }
      return e
    })
    setStrategies(list)
    save(row)
  }

  const save = async (row: any) => {
    let newConfig
    if (row.name == 'Maker') {
      newConfig = {
        "MakerUpperBound": row.UpperBound,
        "MakerLowerBound": row.LowerBound,
        "Maker": {
          "BuyGrid": row.buygrid,
          "SellGrid": row.sellgrid,
          "BuyOrderNum": row.BuyOrderNum,
          "SellOrderNum": row.SellOrderNum,
          "OrderAmount": row.OrderAmount
        }
      }
    } else {
      newConfig = {
        "UpperBound": row.UpperBound,
        "LowerBound": row.LowerBound,
        "BuyAmountRatio": row.buyratio,
        "SellAmountRatio": row.sellratio,
      }
      newConfig[row.name] = {
        "OrderAmount": row.OrderAmount
      }
    }
    const data = await updateConfigData({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
      body: newConfig,
    })
    if (data) {
      await getConfig()
    }
  }

  const pause = async (name: string) => {
    const data = await stopBot({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
      bot_type: name.toLowerCase().replace('1', '_1').replace('2', '_2').replace('3', '_3')
    })
    if (data) {
      await getConfig()
    }
  }

  const restart = async (name: string) => {
    const data = await startBot({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
      bot_type: name.toLowerCase().replace('1', '_1').replace('2', '_2').replace('3', '_3')
    })
    if (data) {
      await getConfig()
    }
  }

  const getBotStatus = async () => {
    const data = await getStatus({key:1234})
    if(data) {
      const coin_name = activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER'
      return data[activeStrategy.toLowerCase()][coin_name]
    }
  }

  const getConfig = async () => {
    const data = await getConfigData({
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
    })
    if (data) {
      const status = await getBotStatus()
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
          running: status?.maker == 'Running',
        },
        {
          name: 'Taker1',
          ref_pair: data.Taker1.refPair,
          OrderAmount: data.Taker1.OrderAmount,
          buyratio: data.BuyAmountRatio,
          sellratio: data.SellAmountRatio,
          UpperBound: data.UpperBound,
          LowerBound: data.LowerBound,
          running: status?.taker_1 == 'Running',
        },
        {
          name: 'Taker2',
          ref_pair: data.Taker2.refPair,
          OrderAmount: data.Taker2.OrderAmount,
          buyratio: data.BuyAmountRatio,
          sellratio: data.SellAmountRatio,
          UpperBound: data.UpperBound,
          LowerBound: data.LowerBound,
          running: status?.taker_2 == 'Running',
        }
      ]
      if (data.Taker3) {
        list.push({
          name: 'Taker3',
          ref_pair: data.Taker3.refPair,
          OrderAmount: data.Taker3.OrderAmount,
          buyratio: data.BuyAmountRatio,
          sellratio: data.SellAmountRatio,
          UpperBound: data.UpperBound,
          LowerBound: data.LowerBound,
          running: status?.taker_3 == 'Running',
        })
      }
      setConfigs(data)
      setStrategies(list)
    }
  }

  useEffect(() => {
    getConfig()
  }, [activeStrategy])

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
          </div>
        </div>
      </div>
      <div style={{ padding: '10px 250px' }}>
        <Table
          className={styles.nobgTable}
          dataSource={strategies}
          columns={[
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
            {
              title: ' ',
              render: (_, entry, index) => (
                <Space size="middle">
                  <Button
                    type="link"
                    onClick={() => {
                      entry.running ? pause(entry.name) : restart(entry.name)
                    }}
                  >
                    {entry.running ? <PauseOutlined /> : <CaretRightOutlined />}
                  </Button>
                  <Button
                    type="link"
                    style={{ marginLeft: -10 }}
                    onClick={() => {
                      setSelectedRow(entry)
                      setShowEditModal(true)
                    }}
                  >
                    <EditOutlined style={{ color: !entry.running ? 'white' : 'red' }} />
                  </Button>
                </Space>
              ),
            }
          ]}
          pagination={false}
        />
      </div>
      <EditModal showModal={showEditModal} setShowModal={setShowEditModal} row={selectedRow} setRow={setSelectedRow} save={save} />
    </div>
  )
}

export default MM
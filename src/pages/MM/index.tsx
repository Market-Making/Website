import React, { useState, useEffect } from 'react'
import axios from 'axios'
import { Table, Button, Tag, Space, message } from 'antd'
import { PauseOutlined, CaretRightOutlined, EditOutlined } from '@ant-design/icons'
import AddModal from './AddModal'
import EditModal from './EditModal'
import styles from './styles.less'

async function get_data(path: string, params: Object) {
  const basePath = 'http://147.182.251.92:3001/'
  const paramArr = []
  JSON.stringify(params).split(',').map(e => {
    paramArr.push(e.split(':')[0].replaceAll('"', '').replaceAll('{', '') + '=' + e.split(':')[1].replaceAll('"', '').replaceAll('}', ''))
  })
  const config = {
    method: 'get',
    url: basePath + path + '?' + paramArr.join('&'),
    headers: {
      'Accept': '*/*',
      'Host': '147.182.251.92:3001',
      'Connection': 'keep-alive',
    },
  }
  const data = await axios(config)
    .then(function (response) {
      return response.data;
    }).catch(function (error) {
      console.log(error);
    });
  return data
}

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
  }

  const save = (name:string) => {
    if(name == 'Maker') {

    }
    // const newConfig = {
    //   "BaseCoin": configs.BaseCoin,
    //   "QuoteCoin": configs.QuoteCoin,
    //   "Pair": configs.Pair,
    //   "UpperBound": parseFloat(strategies[1].UpperBound),
    //   "LowerBound": parseFloat(strategies[1].LowerBound),
    //   "MakerUpperBound": parseFloat(strategies[0].UpperBound),
    //   "MakerLowerBound": parseFloat(strategies[0].LowerBound),
    //   "BalUpperBound": configs.BalUpperBound,
    //   "BalLowerBound": configs.BalLowerBound,
    //   "BuyAmountRatio": parseFloat(strategies[1].buyratio),
    //   "SellAmountRatio": parseFloat(strategies[1].sellratio),
    //   "Maker": {
    //     "BuyGrid": parseFloat(strategies[0].buygrid),
    //     "SellGrid": parseFloat(strategies[0].sellgrid),
    //     "BuyOrderNum": parseFloat(strategies[0].BuyOrderNum),
    //     "SellOrderNum": parseFloat(strategies[0].SellOrderNum),
    //     "OrderAmount": parseFloat(strategies[0].OrderAmount),
    //   },
    //   "Taker1": {
    //     "refPair": strategies[1].ref_pair,
    //     "OrderAmount": parseFloat(strategies[1].OrderAmount),
    //     "BuyRatio": configs.Taker1.BuyRatio,
    //     "SellRatio": configs.Taker1.SellRatio,
    //   },
    //   "Taker2": {
    //     "refPair": strategies[2].ref_pair,
    //     "OrderAmount": parseFloat(strategies[2].OrderAmount),
    //     "BuyRatio": configs.Taker2.BuyRatio,
    //     "SellRatio": configs.Taker2.SellRatio,
    //   },
    // }
    // if (configs.Taker3) {
    //   newConfig['Taker3'] = {
    //     "refPair": strategies[3].ref_pair,
    //     "OrderAmount": parseFloat(strategies[3].OrderAmount),
    //     "BuyRatio": configs.Taker3.BuyRatio,
    //     "SellRatio": configs.Taker3.SellRatio,
    //   }
    // }
    // console.log('joy', newConfig)
  }

  const pause = async (name:string) => {
    const data = await get_data('stop', {
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
      bot_type: name.toLowerCase().replace('1','_1').replace('2','_2').replace('3','_3')
    })
    if(data) {
      return true
    }
  }

  const restart = async (name:string) => {
    const data = await get_data('start-bot', {
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
      bot_type: name.toLowerCase().replace('1','_1').replace('2','_2').replace('3','_3')
    })
    if(data) {
      return true
    }
  }

  const getConfig = async () => {
    const data = await get_data('get-config', {
      key: 1234,
      exchange_name: activeStrategy.toLowerCase(),
      coin_name: activeStrategy == 'Bitmart' ? 'QH' : 'HUNTER',
    })
    if (data) {
      const configs = data.output
      const list = [
        {
          name: 'Maker',
          buygrid: configs.Maker.BuyGrid,
          sellgrid: configs.Maker.SellGrid,
          BuyOrderNum: configs.Maker.BuyOrderNum,
          SellOrderNum: configs.Maker.SellOrderNum,
          OrderAmount: configs.Maker.OrderAmount,
          UpperBound: configs.MakerUpperBound,
          LowerBound: configs.MakerLowerBound,
          running: true,
        },
        {
          name: 'Taker1',
          ref_pair: configs.Taker1.refPair,
          OrderAmount: configs.Taker1.OrderAmount,
          buyratio: configs.BuyAmountRatio,
          sellratio: configs.SellAmountRatio,
          UpperBound: configs.UpperBound,
          LowerBound: configs.LowerBound,
          running: true,
        },
        {
          name: 'Taker2',
          ref_pair: configs.Taker2.refPair,
          OrderAmount: configs.Taker2.OrderAmount,
          buyratio: configs.BuyAmountRatio,
          sellratio: configs.SellAmountRatio,
          UpperBound: configs.UpperBound,
          LowerBound: configs.LowerBound,
          running: true,
        }
      ]
      if (configs.Taker3) {
        list.push({
          name: 'Taker3',
          ref_pair: configs.Taker3.refPair,
          OrderAmount: configs.Taker3.OrderAmount,
          buyratio: configs.BuyAmountRatio,
          sellratio: configs.SellAmountRatio,
          UpperBound: configs.UpperBound,
          LowerBound: configs.LowerBound,
          running: true,
        })
      }
      setConfigs(configs)
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
                      : <Tag color='red' style={{ background: 'transparent' }}>PAUSED</Tag>
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
                      const flag = entry.running ? pause(entry.name) : restart(entry.name)
                      if(flag) {
                        entry.running = !entry.running
                        edit(entry)
                      }
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
      <AddModal showModal={showAddModal} setShowModal={setShowAddModal} />
      <EditModal showModal={showEditModal} setShowModal={setShowEditModal} row={selectedRow} setRow={setSelectedRow} edit={edit} />
    </div>
  )
}

export default MM
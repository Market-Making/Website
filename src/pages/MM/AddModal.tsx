import { useState } from 'react'
import { Button, Tag, Space, Modal, Form, Input, Select, Radio } from 'antd';
import styles from './styles.less'

const AddModal = (props: any) => {

  const {
    showModal,
    setShowModal,
  } = props

  const [name, setName] = useState('')
  const [exchange, setExchange] = useState('Bitmart')
  const [accountKey, setAccountKey] = useState('')
  const [refPair, setRefPair] = useState('BTC/USDT')
  const [grid, setGrid] = useState(0.01)
  const [ratio, setRatio] = useState(0.5)
  const [orderNum, setOrderNum] = useState(50)
  const [OrderAmount, setOrderAmount] = useState(50)
  const [mode, setMode] = useState('taker')

  return (
    <Modal
      open={showModal}
      footer={null}
      onCancel={() => { setShowModal(false) }}
      className={styles.myModal}
    >
      <div style={{ marginTop: 30, fontSize: 16 }}>
        <span
          style={{ cursor: 'pointer', color: mode == 'taker' ? 'white' : '#b6b6b5' }}
          onClick={() => { setMode('taker') }}
        >
          Taker
        </span>
        <span
          style={{ marginLeft: 10, cursor: 'pointer', color: mode == 'maker' ? 'white' : '#b6b6b5' }}
          onClick={() => { setMode('maker') }}
        >
          Maker
        </span>
      </div>
      <Form style={{ marginTop: 10 }}>
        <Form.Item>
          <div style={{ fontSize: 15, color: '#b6b6b5' }}>Name</div>
          <Input
            value={name}
            onChange={(e: any) => { setName(e.target.value) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
          />
        </Form.Item>
        <Form.Item>
          <div style={{ fontSize: 15, color: '#b6b6b5' }}>Exchange</div>
          <Select
            value={exchange}
            onChange={e => { setExchange(e) }}
            className={styles.mySelect}
            dropdownClassName={styles.dropDownMenu}
          >
            {['Bitmart', 'Deepcoin'].map(e => (
              <Select.Option className={styles.optionItem} value={e}>
                {e}
              </Select.Option>
            ))}
          </Select>
        </Form.Item>
        <Form.Item>
          <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Accout Api Key</div>
          <Input
            value={accountKey}
            onChange={(e: any) => { setAccountKey(e.target.value) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
          />
        </Form.Item>
        {mode == "taker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Reference Pair</div>
            <Input
              value={refPair}
              onChange={(e: any) => { setRefPair(e.target.value) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
            />
          </Form.Item>}
        {mode == "maker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Grid</div>
            <Input
              value={grid}
              onChange={(e: any) => { setGrid(e.target.value) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
            />
          </Form.Item>}
        <Form.Item>
          <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Order Number</div>
          <Input
            value={orderNum}
            onChange={(e: any) => { setOrderNum(e.target.value) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
          />
        </Form.Item>
        <Form.Item>
          <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Order Amount</div>
          <Input
            value={OrderAmount}
            onChange={(e: any) => { setOrderAmount(e.target.value) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
          />
        </Form.Item>
        {mode == "taker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Ratio</div>
            <Input
              value={ratio}
              onChange={(e: any) => { setRatio(e.target.value) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333' }}
            />
          </Form.Item>}
      </Form>
      <Button className={styles.confirmButton} onClick={() => { setShowModal(false) }}>
        Submit
      </Button>
    </Modal>
  )
}

export default AddModal
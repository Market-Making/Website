import { useState } from 'react'
import { Button, Modal, Form, Input, Select, Radio } from 'antd';
import styles from './styles.less'

const EditModal = (props: any) => {

  const {
    showModal,
    setShowModal,
    row,
    setRow,
    edit,
  } = props

  return (
    <Modal
      open={showModal}
      footer={null}
      onCancel={() => { setShowModal(false) }}
      className={styles.myModal}
    >
      <Form layout='horizontal' style={{ marginTop: 30 }}>
        <Form.Item>
          <div style={{ fontSize: 15, color: '#b6b6b5' }}>Name</div>
          <Input
            value={row?.name}
            // onChange={(e: any) => { setRow({ ...row, name: e.target.value }) }}
            disabled={true}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
          />
        </Form.Item>
        {row?.name != "Maker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Reference Pair</div>
            <Input
              value={row?.ref_pair}
              // onChange={(e: any) => { setRow({ ...row, ref_pair: e.target.value }) }}
              disabled={true}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>}
        {row?.name == "Maker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Grid</div>
            <Input
              value={row?.buygrid}
              onChange={(e: any) => { setRow({ ...row, buygrid: e.target.value, sellgrid: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>}
        {row?.name == "Maker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Order Number</div>
            <Input
              value={row?.BuyOrderNum}
              onChange={(e: any) => { setRow({ ...row, BuyOrderNum: e.target.value, SellOrderNum: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>}
        {row?.name != "Maker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Buy Ratio</div>
            <Input
              value={row?.buyratio}
              onChange={(e: any) => { setRow({ ...row, buyratio: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>}
        {row?.name != "Maker" &&
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Sell Ratio</div>
            <Input
              value={row?.sellratio}
              onChange={(e: any) => { setRow({ ...row, sellratio: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>}
        <Form.Item>
          <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Upper Boundary</div>
          <Input
            value={row?.UpperBound}
            onChange={(e: any) => { setRow({ ...row, UpperBound: e.target.value }) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
          />
        </Form.Item>
        <Form.Item>
          <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Lower Boundary</div>
          <Input
            value={row?.LowerBound}
            onChange={(e: any) => { setRow({ ...row, LowerBound: e.target.value }) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
          />
        </Form.Item>

        <Form.Item>
          <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Order Amount</div>
          <Input
            value={row?.OrderAmount}
            onChange={(e: any) => { setRow({ ...row, OrderAmount: e.target.value }) }}
            style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
          />
        </Form.Item>

      </Form>
      <Button
        className={styles.confirmButton}
        onClick={() => {
          edit(row)
          setShowModal(false)
        }}
      >
        Save
      </Button>
    </Modal>
  )
}

export default EditModal
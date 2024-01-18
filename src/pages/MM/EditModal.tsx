import { useState } from 'react'
import { Button, Modal, Form, Input, Select, Radio } from 'antd';
import styles from './styles.less'

const EditModal = (props: any) => {

  const {
    showModal,
    setShowModal,
    row,
    setRow,
    save,
  } = props

  const [showMore, setShowMore] = useState(false)

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

        {showMore && <>
          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Ask1Ratio</div>
            <Input
              value={row?.Ask1Ratio}
              onChange={(e: any) => { setRow({ ...row, Ask1Ratio: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>

          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Ask2Ratio</div>
            <Input
              value={row?.Ask2Ratio}
              onChange={(e: any) => { setRow({ ...row, Ask2Ratio: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>

          <Form.Item>
            <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Ask3Ratio</div>
            <Input
              value={row?.Ask3Ratio}
              onChange={(e: any) => { setRow({ ...row, Ask3Ratio: e.target.value }) }}
              style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
            />
          </Form.Item>

          {row?.name == "Maker" &&
            <Form.Item>
              <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>MinAsk1Ratio</div>
              <Input
                value={row?.MinAsk1Ratio}
                onChange={(e: any) => { setRow({ ...row, MinAsk1Ratio: e.target.value }) }}
                style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              />
            </Form.Item>
          }

          {row?.name == "Maker" &&
            <Form.Item>
              <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>TargetRatio</div>
              <Input
                value={row?.TargetRatio}
                onChange={(e: any) => { setRow({ ...row, TargetRatio: e.target.value }) }}
                style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              />
            </Form.Item>
          }

          {row?.name == "Maker" &&
            <Form.Item>
              <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>FillNum</div>
              <Input
                value={row?.FillNum}
                onChange={(e: any) => { setRow({ ...row, FillNum: e.target.value }) }}
                style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              />
            </Form.Item>
          }

          {row?.name != "Maker" &&
            <Form.Item>
              <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Bid1Ratio</div>
              <Input
                value={row?.Bid1Ratio}
                onChange={(e: any) => { setRow({ ...row, Bid1Ratio: e.target.value }) }}
                style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              />
            </Form.Item>
          }

          {row?.name != "Maker" &&
            <Form.Item>
              <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Bid2Ratio</div>
              <Input
                value={row?.Bid2Ratio}
                onChange={(e: any) => { setRow({ ...row, Bid2Ratio: e.target.value }) }}
                style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              />
            </Form.Item>
          }

          {row?.name != "Maker" &&
            <Form.Item>
              <div style={{ fontSize: 15, marginBottom: 5, color: '#b6b6b5' }}>Bid3Ratio</div>
              <Input
                value={row?.Bid3Ratio}
                onChange={(e: any) => { setRow({ ...row, Bid3Ratio: e.target.value }) }}
                style={{ height: 40, background: 'transparent', border: '1px solid #333333', color: 'white' }}
              />
            </Form.Item>
          }
        </>}

        <div style={{ cursor: 'pointer', textAlign: 'center', color: '#b6b6b5' }} onClick={() => setShowMore(!showMore)}>
          {showMore ? "Collapse" : "See More"}
        </div>

      </Form>
      <Button
        className={styles.confirmButton}
        onClick={() => {
          save(row)
          setShowModal(false)
        }}
      >
        Save
      </Button>
    </Modal>
  )
}

export default EditModal
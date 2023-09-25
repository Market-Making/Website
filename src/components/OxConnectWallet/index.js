import { useState, useEffect } from "react";
import styles from './style.less';
import { Row, Col, Modal, Dropdown, message } from 'antd';
import { DisconnectOutlined, DownOutlined } from '@ant-design/icons';
import { useWeb3React } from "@web3-react/core";
import { injected } from '@/connectors';

const OxConnectWallet = props => {

  const { account, activate, deactivate, chainId } = useWeb3React();

  const [visibleMetaMask, setVisibleMetaMask] = useState(false);

  const deactivateTest = () => {
    deactivate();
    localStorage.setItem("login_status", 'off')
  }

  const selectWallet = () => {
    try {
      ethereum;
      activate(injected);
    } catch (error) {
      message.info('No provider was found');
      if (account) {
        localStorage.setItem("login_status", "on");
      }
      return
    }
  };

  const sortAddress = (text) => {
    // 转为string
    text = text + "";
    const length = text.length;
    if (text.length > 10) {
      return text.substring(0, 4) + "..." + text.substring(length - 4, length);
    }
    else {
      return text;
    }
  }

  useEffect(() => {
    if (window.ethereum) {
      window.ethereum.on("chainChanged", (newChainId) => {
        document.location.reload();
      })
    }
  }, [])

  useEffect(() => {
    const connectWalletOnPageLoad = async () => {
      if (localStorage?.getItem("login_status") === "on") {
        selectWallet()
      }
    }
    connectWalletOnPageLoad()
  }, [])

  console.log('joy', localStorage.getItem('login_status'), account)

  return (
    <div className={styles.right}>
      <Row wrap={false} style={{ display: "inline-flex", fontSize: "0.7rem" }}>
        <Col flex="auto">
          <div className={styles.connect}>
            <div className={styles.wrap}>
              <div>
                {account &&
                  <div className={styles.address} onClick={() => setVisibleMetaMask(true)} >
                    {sortAddress(account)}
                  </div>
                }
                {!account &&
                  <div className={styles.address} onClick={() => selectWallet()} >
                    Connect Wallet
                  </div>
                }
              </div>
            </div>
          </div>
        </Col>
      </Row>
      {account && <div>
        <Modal
          width={150}
          height={100}
          visible={visibleMetaMask}
          onCancel={() => setVisibleMetaMask(false)}
          footer={null}
          closable={false}
        >
          <div type="primary" shape="round" className={styles.disconnectBtn} onClick={deactivateTest} style={{ margin: -30 }}>
            <DisconnectOutlined /> Disconnect
          </div>
        </Modal>
      </div>}
    </div>
  );
};
export default OxConnectWallet;

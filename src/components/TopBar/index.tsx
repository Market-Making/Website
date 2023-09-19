import { useWeb3React } from "@web3-react/core";
import OxConnectWallet from '../OxConnectWallet'
import styles from './index.less';

const whiteListedAccounts = [
  '0x07298580CB2E76180965eF147be67e71883AeAc6',
  '0x08bf2999C67a807FD1708670E4C48Ada46aABAc5',
  '0x0754f7fC90F842a6AcE8B6Ec89e4eDadeb2A9bA5',
]

const TopBar = () => {
  const { account } = useWeb3React();
  return (
    <div className={styles.warp}>
      <div>
        <img width={90} src="/logo.svg" style={{margin: 10, cursor: 'pointer'}} onClick={()=>{window.location.href='/'}}/>
      </div>
      <div style={{width: '70%'}} hidden={!account || !whiteListedAccounts.includes(account)}>
        <span className={styles.menuItem} onClick={()=>{window.location.href='/mm'}}>Market Making</span>
      </div>
      <div>
        <OxConnectWallet />
      </div>
    </div>
  );
};
export default TopBar;

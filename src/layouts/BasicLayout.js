import React from 'react'
import { Web3ReactProvider } from '@web3-react/core';
import { Web3Provider } from '@ethersproject/providers';
import { Layout } from 'antd'
import { Outlet } from 'umi';
import TopBar from '@/components/TopBar';

const { Content } = Layout;
function getLibrary(provider) {
  const library = new Web3Provider(provider);
  library.pollingInterval = 8000;
  return library;
}

const BasicLayout = (props) => {
  return (
    <Web3ReactProvider getLibrary={getLibrary}>
      <Layout>
        <Content>
          <Layout>
            <Layout style={{ background: '#010101' }}>
              <TopBar />
              <Outlet />
            </Layout>
          </Layout>
        </Content>
      </Layout>
    </Web3ReactProvider>
  );
};
export default BasicLayout;

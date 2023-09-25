import { defineConfig } from "umi";

const path = require('path')

function dir(d: string) {
  return path.resolve(__dirname, d)
}

function defineProperty() {
  const dev = {
    test: 'test',
    prod: 'prod',
  }
  return {
    'process.env.NODE_MODEL': process.env.NODE_MODEL ? 'mock' : '',
    'process.env.UMI_APP_DEV': dev[process.env.UMI_ENV] || 'dev',
  }
}

export default defineConfig({
  links: [{ rel: 'icon', href: '/favico.png' },
  ],
  routes: [{
    path: "/",
    component: '../layouts/BasicLayout',
    routes: [
      {
        path: "/",
        component: "@/pages/home"
      },
      {
        path: "/mm",
        component: '@/pages/MM',
      }
    ]
  }],
  proxy: {
    '/api/': { target: 'http://147.182.251.92:6602/', changeOrigin: true },
  },
  define: defineProperty(),
  alias: {
    '@': dir('./src'),
  },
  hash: true,
  npmClient: 'yarn',
  title: 'Hash Capital',
  esbuildMinifyIIFE: true,
});

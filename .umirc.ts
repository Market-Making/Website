import { defineConfig } from "umi";

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
  npmClient: 'yarn',
  title: 'Hash Capital',
  esbuildMinifyIIFE: true,
});

import { defineConfig } from "umi";

export default defineConfig({
  links: [{ rel: 'icon', href: '/favico.png' },
],
  routes: [
    { path: "/", component: "index" }
  ],
  npmClient: 'yarn',
});

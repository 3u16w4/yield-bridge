import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: '.',

  build: {
    outDir: 'assets/dist',
    emptyOutDir: true,

    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'assets/js/main.js'),
        dashboard: path.resolve(__dirname, 'assets/js/dashboard.js'),
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: 'assets/[name].[ext]',
      }
    }
  },

  server: {
    port: 5173,
    strictPort: true,
    origin: 'http://localhost:5173',
  }
});
import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  build: {
    outDir: resolve(__dirname, 'assets/build'),
    emptyOutDir: true,
    manifest: false,
    sourcemap: false,
    rollupOptions: {
      input: {
        app: resolve(__dirname, 'assets/src/js/app.js'),
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'css/[name].css';
          }
          return 'assets/[name].[ext]';
        },
      },
    },
  },
});


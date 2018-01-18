<template>
  <div id="app">
    <header id="header">
      <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand h1"><i class="fa fa-space-shuttle"></i> CMS Electron</span>
        <div class="btn-group btn-group-sm">
          <button class="btn btn-secondary" @click="minimize()">
            <i class="fa fa-window-minimize"></i>
          </button>
          <button class="btn btn-secondary" @click="maximize()">
            <i class="fa fa-window-maximize"></i>
          </button>
          <button class="btn btn-dark" @click="close()">
            <i class="fa fa-window-close"></i>
          </button>
        </div>
      </nav>
    </header>

    <div id="content">
      <transition enter-active-class="animated fadeIn" leave-active-class="animated zoomOut">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>

<script>
  import electron from 'electron'

  export default {
    name: 'electron-cms',
    data() {
      return {
        mainWindow: null
      }
    },
    methods: {
      minimize() {
        this.mainWindow.minimize()
      },
      maximize() {
        this.mainWindow.setFullScreen(!this.mainWindow.isFullScreen())
      },
      close() {
        this.mainWindow.close()
      },
    },
    mounted() {
      this.mainWindow = electron.remote.BrowserWindow.getFocusedWindow()
    }
  }
</script>

<style>
  body {
    background-color: rgba(236, 240, 241, 1.0);
  }
  #header {
    margin-bottom: 10px;
    -webkit-app-region: drag;
  }
  #header .btn {
    -webkit-app-region: no-drag;
  }
  #content {
    position: relative;
  }
  #content .animated{
    position: absolute;
    top: 0;
  }
</style>

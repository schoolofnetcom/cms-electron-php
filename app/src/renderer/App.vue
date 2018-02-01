<template>
  <div id="app">
    <loader></loader>
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
          <button class="btn btn-secondary" @click="fullScreen()">
            <i class="fa fa-arrows-alt"></i>
          </button>
          <button class="btn btn-dark" @click="close()">
            <i class="fa fa-window-close"></i>
          </button>
        </div>
      </nav>
    </header>

    <div class="container-fluid" id="content">
      <div class="row">
        <div id="nav" class="col-1 bg-dark">
          <p class="display-6 text-light">
            <small>MENU</small>
          </p>

          <p>
            <router-link to="/pages" class="btn btn-secondary"><i class="fa fa-file-text-o"></i></router-link>
          </p>

          <p>
            <router-link to="/posts" class="btn btn-secondary"><i class="fa fa-rss"></i></router-link>
          </p>

          <p>
            <router-link to="/users" class="btn btn-secondary"><i class="fa fa-user"></i></router-link>
          </p>

          <p>
            <a href="" class="btn btn-secondary" @click.prevent="logout()"><i class="fa fa-sign-out"></i></a>
          </p>

        </div>
        <div class="col-11">
          <transition enter-active-class="animated fadeIn" leave-active-class="animated zoomOut">
            <router-view></router-view>
          </transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import electron from 'electron'
  import loader from './components/Loader/Loader'

  export default {
    name: 'electron-cms',
    components: {
      loader: loader
    },
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
        if (this.mainWindow.isMaximized()) {
          this.mainWindow.unmaximize()
        } else {
          this.mainWindow.maximize()
        }
      },
      fullScreen() {
        this.mainWindow.setFullScreen(!this.mainWindow.isFullScreen())
      },
      close() {
        this.mainWindow.close()
      },
      logout() {
        window.axios.defaults.headers.common['Authorization'] = null;
        window.localStorage.removeItem('token')
        this.$router.push({path: '/auth'})
      },
    },
    mounted() {
      this.mainWindow = electron.remote.BrowserWindow.getFocusedWindow()
    }
  }
</script>

<style>
  html, body, #app {
    height: 100%;
  }

  #app {
    display: flex;
    flex-direction: column;
  }
  #content {
    flex: 1;
  }
  #content > .row {
    height: 100%;
  }
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

  #nav, .nav {
    padding-top: 15px;
    margin-top: -10px;
  }

  .nav {
    display: block !important;
  }

  .router-link-active {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
  }
</style>

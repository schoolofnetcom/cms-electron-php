import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: require('@/components/Pages').default
    },
    {
      path: '/pages',
      name: 'pages',
      component: require('@/components/Pages').default
    },
    {
      path: '/pages/add',
      name: 'new-page',
      component: require('@/components/Pages/Add').default
    },
    {
      path: '*',
      redirect: '/'
    }
  ]
})

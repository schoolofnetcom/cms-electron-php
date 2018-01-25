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
      path: '/pages/:id',
      name: 'view-pages',
      component: require('@/components/Pages/View').default
    },
    {
      path: '/pages/edit/:id',
      name: 'edit-pages',
      component: require('@/components/Pages/Edit').default
    },
    {
      path: '/pages/remove/:id',
      name: 'remove-pages',
      component: require('@/components/Pages/Remove').default
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

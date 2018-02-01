import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/pages'
    },
    {
      path: '/auth',
      name: 'auth',
      component: require('@/components/Auth').default
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
      path: '/posts',
      name: 'posts',
      component: require('@/components/Posts').default
    },
    {
      path: '/posts/add',
      name: 'posts-add',
      component: require('@/components/Posts/Add').default
    },
    {
      path: '/posts/:id',
      name: 'posts-view',
      component: require('@/components/Posts/View').default
    },
    {
      path: '/posts/edit/:id',
      name: 'posts-edit',
      component: require('@/components/Posts/Edit').default
    },
    {
      path: '/posts/remove/:id',
      name: 'posts-remove',
      component: require('@/components/Posts/Remove').default
    },
    {
      path: '/users',
      name: 'users',
      component: require('@/components/Users').default
    },
    {
      path: '/users/add',
      name: 'users-add',
      component: require('@/components/Users/Add').default
    },
    {
      path: '/users/:id',
      name: 'users-view',
      component: require('@/components/Users/View').default
    },
    {
      path: '/users/edit/:id',
      name: 'users-edit',
      component: require('@/components/Users/Edit').default
    },
    {
      path: '/users/remove/:id',
      name: 'users-remove',
      component: require('@/components/Users/Remove').default
    },
    {
      path: '*',
      redirect: '/'
    }
  ]
})

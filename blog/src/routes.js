import Vue from 'vue'
import Router from 'vue-router'
import homePage from '@/views/layout/home.vue'
import articleList from '@/views/article/articleList.vue'
import article from '@/views/article/article.vue'
import outline from '@/views/components/outline.vue'
import write from '@/views/components/write.vue'
import user from '@/views/components/user.vue'

import store from '@/store'
import home from '@/views/home/home.vue'
import register from '@/views/register.vue'
import mylogin from '@/views/mylogin.vue'
import usercenter from '@/views/user/usercenter.vue'
import uploadimg from '@/views/user/uploadimg.vue'
import imgupload from '@/views/components/imgupload.vue'
import imgList from '@/views/img/imgList.vue'
import img from '@/views/img/imgdetail.vue'
import userside from '@/views/components/userside.vue'
import writearticle from '@/views/components/writearticle.vue'
import author from '@/views/user/author.vue'
Vue.use(Router)

const routes = [
  {
    path: '/',
    component: homePage,
    children: [
      {
        path: '/',
        name: 'home1',
        redirect: '/articleList'
      },
      {
            path : 'home', 
            name:'home',
            component : home
        },
        {
            path : '/register', 
            name:'register',
            component : register
        },
        {
            path : '/mylogin', 
            name:'mylogin',
            component : mylogin
        },
        {
            path : '/usercenter', 
            name:'usercenter',
            component : usercenter
        },
            {
            path : '/uploadimg', 
            name:'uploadimg',
            component : uploadimg
        },
        {
        path: 'articleList',
        name: 'articleList',
        component: articleList
      },
      {
        path: 'imgupload',
        name: 'imgupload',
        component: imgupload
      },
      {
        path: 'imgList',
        name: 'imgList',
        component: imgList
      },
        {
        path: 'imgList/img/:id',
        name: 'img',
        component: img
      },
      {
        path: 'userside',
        name: 'userside',
        component: userside
      },
      {
        path: 'articleList/article/:id',
        name: 'article',
        component: article
      },
      {
        path: 'writearticle',
        name: 'writearticle',
        component: writearticle
      },
      {
        path: 'author/:id',
        name: 'author',
        component: author
      },

      ]

  },
]

const router = new Router({
  routes,
  mode: 'history',
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return new Promise((resolve, reject) => {
        setTimeout(() => {
          resolve({ x: 0, y: 0 })
        }, 50)
      })
    }
  }
})

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth) { // 判断该路由是否需要登录权限
    if (store.getters.token) { // 获取当前的token是否存在
      next()
    } else {
      store.commit('SHOW_LOGIN_BOX')
      store.dispatch('logOut')
      next({
        path: from.fullPath,
        query: { redirect: from.fullPath } // 将跳转的路由path作为参数，登录成功后跳转到该路由
      })
    }
  } else {
    next()
  }
})
export default router

  <transition name="show-nav">
      <nav class="nav-content" v-show="showHeaderNav">
        <ul class="header-nav">
          <li @click="goHome">
            <router-link to="/articleList">
              <i class="glyphicon glyphicon-home"></i>
              <span>主页</span>
            </router-link>
          </li>
          <li>
            <router-link to="/msgborder">
              <i class="glyphicon glyphicon-comment"></i>
              <span>留言板</span>
            </router-link>
          </li>
          <li>
            <router-link to="/timer">
              <i class="glyphicon glyphicon-calendar"></i>
              <span>时间轴</span>
            </router-link>
          </li>
          <li>
            <router-link to="/about">
              <i class="glyphicon glyphicon-info-sign"></i>
              <span>关于</span>
            </router-link>
          </li>
          <li @click="getBing" class="search">
            <a href="javascript:;">
              <i class="glyphicon glyphicon-search"></i>
              <span>搜索</span>
            </a>
          </li>
          <li class="login_user">
            <a href="javascript:;" @click="checkLogin">
              <i class="glyphicon glyphicon-user"></i>
              <span>{{ user.user_name }}</span>
            </a>
          </li>
          <li class="logout_user" :class="{'touch-logout': if_touch }" v-show="logout_register">
            <a href="javascript:;" @click="logOut">
              <i class="glyphicon glyphicon-off"></i>
              <span>退出登录</span>
            </a>
          </li>
          <li class="register" v-show="!logout_register">
            <a href="javascript:;" @click="showRegisterBox">
              <i class="glyphicon glyphicon-plus-sign"></i>
              <span>注册</span>
            </a>
          </li>
        </ul>
      </nav>
    </transition>
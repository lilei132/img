# Image-blog

vue.js+php(TP5)

## Build Setup
前端：
``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build
```
后端：
1.  将tvcms.sql导入到mysql数据库中
2.  修改请到MySQL中修改
3.  后台改用thinkPHP5框架，进入servers文件夹，composer install，或者请自行下载tp5的核心文件thinkphp文件夹，放到\bianquan-blog\servers下。
4.  到\bianquan-blog\servers\application下修改database.php文件的数据库地址、名称和密码为自己的。
5.  若后端地址为非localhost：80，前台请求地址需相应修改，请到\bianquan-blog\src\vuex下的state.js和actions.js中(共两处URL)修改请求地址URL。
6.  回复邮件自动提醒功能，需在\bianquan-blog\servers\application\common.php的send_mail函数中填写相应邮箱参数。


**项目简介**：
> * 名称：图片站；
> * 前端：Vue+Vuex+Vue-Router+axios；
> * 后端：PHP+MySQL；
> * 兼容性：ie9+，移动端，PC端；

**主要功能**：


**目前存在问题**：
1.  页面响应式布局方面，还有一些元素在特殊窗口尺寸中显示不协调；
2.  虽然开放注册功能，但未加入验证码、邮箱验证功能，并且关闭普通会员文章操作权限，普通会员投稿默认为不发布，并且无法编辑状态，需管理员发布和编辑。
3.  评论被回复邮件通知还是半成品；
4.  搜索功能未完成；




**引用：**
> [vue-simplemde](https://github.com/F-loat/vue-simplemde)
> [PHP-JWT](https://packagist.org/packages/firebase/php-jwt)
> sendMail

**参考文章：**
> [Vue.js实现文章评论和回复评论功能](https://blog.csdn.net/weixin_35987513/article/details/53748707)

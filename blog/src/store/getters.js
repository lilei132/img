const getters = {
  user: state => state.user.user,
  token: state => state.user.token,
  loginBox: state => state.loginBox.loginBox,
  registerLoginBtn: state => state.loginBox.registerLoginBtn,
  loginNotice: state => state.loginBox.loginNotice,
  logoutBox: state => state.loginBox.logoutBox,
  articleList: state => state.article.articleList,
  articleListInfo: state => state.article.listInfo,
  imgList: state => state.img.imgList,
  imgListInfo: state => state.img.listInfo,
  //imglist:state=>state.img.listInfo
}
export default getters

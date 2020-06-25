<template>
  <div class="">
    <el-carousel indicator-position="outside">
      <el-carousel-item v-for="item in 4" :key="item">

      </el-carousel-item>
    </el-carousel>

    <el-col >
      <el-row :gutter="10">
        <el-col :span="6" v-for="item in imgList.data" :key="item.i_id" class="imgcard">
          <el-card :body-style="{ padding: '0px' }"  shadow="never" class="imgcard">
            <el-image :src="item.i_img" fit='cover' style="height:150px"></el-image>
            <div style="padding: 7px;">
              <a @click="showImgDetail(item.i_id)" href="javascript:scroll(0,0)">
                <span style="font-size:12px">{{item.i_title}}</span>
              </a>
            </div>
            <div class="bottom clearfix" style="padding:5px ">
              <i class="el-icon-view font-12" style="margin-right: 1rem !important;">{{item.viewer_num}}</i>
              <i class="el-icon-star-off font-12" style="margin-right: 1rem !important;" >{{item.praise_num}}</i>
            </div>
            <div style="padding:7px">
              <el-avatar style="width: 19px; height: 19px; vertical-align:middle;" src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" ></el-avatar><span class="font-12">{{item.user.user_name}}</span>
            </div>
          </el-card>
        </el-col>
      </el-row>

      
  </el-col>
  <el-col>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
    <span>推荐作品</span>
  </div>
      <div class="text item">
        <div class="row py-3" style="padding-left: 9px ;padding-right: 9px">


          <a href="/#" target="_blank" class="d-block   col-4 col-lg-2 p-2 ">
            <div class="bg-light2   w-100 position-relative   overflow-hidden setgray" style="
            padding-top:72%;
            background-size: 100%;
            background-image: url(https://photo7n.gracg.com/1579776093_1_a313ed94177dedacf1d6e15c2cc784ac_crop_.jpg!400x300);
            background-position: center;
            background-repeat: no-repeat;">
          </div>

        </a>


        
        <a href="/#" target="_blank" class="d-block   col-4 col-lg-2 p-2 ">
          <div class="bg-light2   w-100 position-relative   overflow-hidden setgray" style="
          padding-top:72%;
          background-size: 100%;
          background-image: url(https://photo7n.gracg.com/2408_1_339174faeaddb956d12a17361a8bb232.png!400x300);
          background-position: center;
          background-repeat: no-repeat;">
        </div>

      </a>



      <a href="/#" target="_blank" class="d-block   col-4 col-lg-2 p-2 ">
        <div class="bg-light2   w-100 position-relative   overflow-hidden setgray" style="
        padding-top:72%;
        background-size: 100%;
        background-image: url(https://photo7n.gracg.com/1574531773_1_8f629dd90f3e112866d3fb8f9cd6f0db_crop_.jpg!400x300);
        background-position: center;
        background-repeat: no-repeat;">
      </div>

    </a>



    <a href="/#" target="_blank" class="d-block   col-4 col-lg-2 p-2 ">
      <div class="bg-light2   w-100 position-relative   overflow-hidden setgray" style="
      padding-top:72%;
      background-size: 100%;
      background-image: url(https://photo7n.gracg.com/1574175461_1_1a6123d772f113c1f5d4491da18dea50_crop_.jpg!400x300);
      background-position: center;
      background-repeat: no-repeat;">
    </div>

  </a>



  <a href="/#" target="_blank" class="d-block   col-4 col-lg-2 p-2 ">
    <div class="bg-light2   w-100 position-relative   overflow-hidden setgray" style="
    padding-top:72%;
    background-size: 100%;
    background-image: url(https://photo7n.gracg.com/591140_1_009fc205a5613b7309dfdfe1e66d0bb8_crop_.jpg!400x300);
    background-position: center;
    background-repeat: no-repeat;">
  </div>

</a>



<a href="/#" target="_blank" class="d-block   col-4 col-lg-2 p-2 ">
  <div class="bg-light2   w-100 position-relative   overflow-hidden setgray" style="
  padding-top:72%;
  background-size: 100%;
  background-image: url(https://photo7n.gracg.com/2001311245_1_73a5b746ac179dfd9459fc7414b778e0.png!400x300);
  background-position: center;
  background-repeat: no-repeat;">
</div>

</a>
]



</div>
</div>
</el-card>
<div class="page t-c">
        <ul>
          <li>
            <a href="javascript:scroll(0,0);" @click="changePage(1)">首页</a>
          </li>
          <li class="list-before">
            <a href="javascript:scroll(0,0);" @click="changePage(imgList.current_page-1)">上一页</a>
          </li>
          <li
          v-for="(count,index) in imgList.last_page"
          @click="changePage(index+1)"
          :key="index"
          >
          <a
          href="javascript:scroll(0,0); "
          v-show="range(index)"
          :class="{actived:(index+1)==imgList.current_page}"
          >{{ count }}</a>
        </li>
        <li class="list-next">
          <a href="javascript:scroll(0,0);" @click="changePage(imgList.current_page+1)">下一页</a>
        </li>
        <li>
          <a href="javascript:scroll(0,0);" @click="changePage(imgList.last_page)">末页</a>
        </li>
      </ul>
    </div>
</el-col>
</div>
</template>

<script> 
import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'
export default {
  name: 'ImgList',
  data() {
    return {
    }
  },
  methods: {
    ...mapActions(['getImgList']),
    ...mapMutations(['SET_IMG_LIST_INFO', 'CHANGE_CRUMBS']),
    //翻页
    changePage(page) {
      if (page <= 0 || page > this.imgList.last_page) {
        return
      }
      const obj = {
        page
      }
      this.$store.commit('SET_IMG_LIST_INFO', obj)
      this.getImgList()
    },
    //通过类别来获取列表
    getListByTag(tagID, tagName) {
      const listObj = {
        page: 1,
        tagID
      }
      this.$store.commit('SET_IMG_LIST_INFO', listObj)
      this.getImgList()
      const obj = {
        tagName,
        tagID,
        title: ''
      }
      this.CHANGE_CRUMBS(obj)
    },
    //文章详情页
    showImgDetail(id) {
      this.$router.push({
        name: 'img', params: { id }
      })
    },
    //范围，下一页
    range: function(k) {
      let pageStart
      let pageEnd
      const pageRange = 5
      const x = (pageRange - 1) / 2
      const max = this.imgList.last_page - 1
      const index = this.imgList.current_page - 1
      // 尾部区间
      if (index > max - x) {
        pageStart = max - x - 2
        pageEnd = max
      }
      // 中间区间
      if (index >= x && index <= max - x) {
        pageStart = index - x
        pageEnd = index + x
      }
      // 开始区间
      if (index <= x) {
        pageStart = 0
        pageEnd = pageRange
      }

      if (pageStart && pageEnd) {
        return k <= pageEnd && k >= pageStart
      } else {
        return k < pageRange
      }
    }
  },
  computed: {
    ...mapState(['crumbs']),
    ...mapGetters(['imgList', 'imgListInfo'])
  },
  created: function() {
    this.getImgList()
  },
  components: {}
}
</script>

<style>

.el-carousel__item h3 {
  color: #475669;
  font-size: 18px;
  opacity: 0.75;
  line-height: 300px;
  margin: 0;
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
  background-image:url('../../assets/imgs/2.gif');
  background-size:100% 100%;
}

.el-carousel__item:nth-child(2n+1) {
  background-color: #d3dce6;
  background-image:url('../../assets/imgs/1.jpg');
  background-size:100% 100%;
}
.font-12{
  font-size:12px;
}
.imgcard{
  padding-left:12px; padding-right: 12px ;
  margin-bottom: 1.5rem !important;
}
main .page ul {
  margin: 20px;
}

main .page ul li {
  display: inline-block;
}
main .page ul li a {
  display: block;
  height: 25px;
  padding: 0 8px;
  margin: 0 5px;
  line-height: 25px;
  font-size: 16px;
  border-radius: 5px;
  background: #fff;
  box-shadow: 3px 3px 8px 2px #ccc;
  color: #111;
  text-decoration: none;
}
main .page ul li a:hover,
main .page ul li .actived {
  background: rgba(33, 33, 33, 0.8);
  color: rgba(230, 230, 230, 0.8);
}
.bannerImg{
  width: 100%;
  height: inherit;
  min-height: 360px;
  min-width: 1400px;
}

</style>

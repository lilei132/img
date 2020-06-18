<template>
  <el-row :gutter="24">
    <el-col :span="16">
  <div class="main f-l">
    <article class="clearfix" v-for="item in articleList.data" :key="item.a_id">
<!--       <div class="pic f-l t-c">
        <a href="javascript:;">
          <img :src="item.a_img" alt>
        </a>
      </div> -->
      <div class="content">
        <el-row :gutter="20">
          <el-col :span="16">
            <div style="padding:10px">
          <a @click="showArticle(item.a_id)" href="javascript:scroll(0,0)">
          <h3 class="title">{{item.a_title}}</h3>
        </a>
        <p class="summary" v-html="item.outline"></p>
        </div>
          </el-col>
          <el-col :span="8">
            <el-row class="tag">
          <el-col class="icon" >
            <a @click="getListByTag(item.tag_id,item.tag.tag_name)">
            <i class="el-icon-price-tag"></i>
            {{item.tag.tag_name}}</a>
          </el-col>
          <el-col class="icon">
            <i class="el-icon-user"></i>
            {{item.user.user_name}}
          </el-col>
          <el-col class="icon">
            <i class="el-icon-timer"></i>
            {{item.create_time}}
          </el-col>
          <el-col class="icon">
            <i class="el-icon-chat-dot-square"></i>
            {{item.comment_num}}
          </el-col>
        </el-row>
          </el-col>
        </el-row>


      </div>
    </article>

    <div class="page t-c">
      <ul>
        <li>
          <a href="javascript:scroll(0,0);" @click="changePage(1)">首页</a>
        </li>
        <li class="list-before">
          <a href="javascript:scroll(0,0);" @click="changePage(articleList.current_page-1)">上一页</a>
        </li>
        <li
          v-for="(count,index) in articleList.last_page"
          @click="changePage(index+1)"
          :key="index"
        >
          <a
            href="javascript:scroll(0,0); "
            v-show="range(index)"
            :class="{actived:(index+1)==articleList.current_page}"
          >{{ count }}</a>
        </li>
        <li class="list-next">
          <a href="javascript:scroll(0,0);" @click="changePage(articleList.current_page+1)">下一页</a>
        </li>
        <li>
          <a href="javascript:scroll(0,0);" @click="changePage(articleList.last_page)">末页</a>
        </li>
      </ul>
    </div>
  </div>
</el-col>
<el-col style="float:right" class="contain">
<AsideBar></AsideBar>
<el-button type="danger" plain style="position:absolute;right:35px;top:310px" @click="uploadArtcile()">发布文章或需求</el-button>
</el-col>
</el-row>

</template>

<script>
import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'
import AsideBar from '@/views/layout/aside.vue'
export default {
  name: 'ArticleList',
  data() {
    return {}
  },
  methods: {
    ...mapActions(['getArticleList']),
    ...mapMutations(['SET_ARTICLE_LIST_INFO', 'CHANGE_CRUMBS']),
    //翻页
    changePage(page) {
      if (page <= 0 || page > this.articleList.last_page) {
        return
      }
      const obj = {
        page
      }
      this.$store.commit('SET_ARTICLE_LIST_INFO', obj)
      this.getArticleList()
    },
    //通过类别来获取列表
    getListByTag(tagID, tagName) {
      const listObj = {
        page: 1,
        tagID
      }
      this.$store.commit('SET_ARTICLE_LIST_INFO', listObj)
      this.getArticleList()
      const obj = {
        tagName,
        tagID,
        title: ''
      }
      this.CHANGE_CRUMBS(obj)
    },
    //文章详情页
    showArticle(id) {
      this.$router.push({
        name: 'article', params: { id }
      })
    },
    uploadArtcile(){
      this.$router.push({
        name: 'writearticle', 
    })
    },
    //范围，下一页
    range: function(k) {
      let pageStart
      let pageEnd
      const pageRange = 5
      const x = (pageRange - 1) / 2
      const max = this.articleList.last_page - 1
      const index = this.articleList.current_page - 1
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
    ...mapGetters(['articleList', 'articleListInfo'])
  },
  created: function() {
    this.getArticleList()
  },
  components: {
    AsideBar
  }
}
</script>

<style scoped>
.main article {
  width: 100%;
  margin: 15px 0;
  background: #fff;
  border-radius: 10px;
  box-shadow: 3px 3px 8px 2px #ccc;
}



.main article .content {
  width: 100%;
}
.main article .content a {
  text-decoration: none;
}

.main article .content .title {
  color: rgba(33, 33, 33, 0.8);
  cursor: pointer;
  height: 30px;
  text-shadow: 3px 3px 2px #ccc;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.main article .content .title:hover {
  color: #008888;
}

.main article .content .summary {
  height: 70px;
  margin-bottom: 10px;
  border-top: 1px solid #aaa;
  white-space: pre-line;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  word-break: break-all;
}

.main article .content .tag li {
  display: inline-block;
  padding: 0 10px;
  cursor: pointer;
}
.main article .content .tag li i {
  margin-right: 5px;
}
.icon{
  padding:7px;

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

@media only screen and (min-width: 768px) and (max-width: 1024px) {
  .main article .content .tag li:nth-child(2) {
    display: none;
  }
  .main article .content .tag li {
    padding: 0 5px;
  }
}

@media only screen and (min-width: 560px) and (max-width: 760px) {
  .main article .content .tag li {
    padding: 0 5px;
  }
  .main article .content .tag li:nth-child(2) {
    display: none;
  }

  .list-before,
  .list-next {
    display: none !important;
  }
}

@media only screen and (max-width: 560px) {
  .main article .pic {
    float: none !important;
    margin: 0 auto;
    margin-top: 20px;
    width: 90%;
  }
  .main article .content {
    float: none !important;
    margin: 0 auto;
    width: 90%;
  }

  .main article .content .title {
    text-shadow: none;
    font-size: 18px;
    margin-top: 10px;
    margin-bottom: 5px;
    height: 20px;
    line-height: 20px;
  }

  .main article .content .summary {
    height: 50px;
  }
  .main article .content .tag li {
    float: left;
    width: 50%;
  }
  .main article .content .tag li:nth-child(4),
  .main article .content .tag li:nth-child(5) {
    width: 25%;
  }

  .list-before,
  .list-next,
  main .page ul li:first-child,
  main .page ul li:last-child {
    display: none !important;
  }
}
</style>

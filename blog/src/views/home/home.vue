<template>
	<div>
		<el-carousel indicator-position="outside">
			<el-carousel-item v-for="item in 4" :key="item">
				<h3>{{ item }}</h3>
			</el-carousel-item>
		</el-carousel>
		<el-row :gutter="20">
			<el-col :span="6" v-for="(o, index) in 8" :key="o" class="imgcard">
				<el-card :body-style="{ padding: '0px' }"  shadow="never">
					<el-image :src="url"></el-image>
					<div style="padding: 7px;">
						<span style="font-size:12px">飞天敦煌</span>

					</div><div class="bottom clearfix" style="padding:5px ">
						<i class="el-icon-view font-12" style="margin-right: 1rem !important;">7923</i>
						<i class="el-icon-chat-line-round font-12" style="margin-right: 1rem !important;" >72</i>
						<i class="el-icon-star-off font-12" style="margin-right: 1rem !important;" >2</i>
					</div>
					<div style="padding:7px">
						<el-avatar style="width: 19px; height: 19px; vertical-align:middle;" src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"></el-avatar><span class="font-12">木子三十</span>
					</div>
				</el-card>
			</el-col>
		</el-row>
		<el-row>
			<el-col>
			<span>热门作品</span>
		</el-col>
			<el-col :span="4" v-for="(o, index) in 16" :key="o" class="imgcard">
				<el-card :body-style="{ padding: '0px' }"  shadow="never">
					<el-image :src="url"></el-image>
				</el-card>
			</el-col>
		</el-row>
	</div>
</template>
<script type="text/ecmascript-6">
    export default {
        data(){
            return {
            	url:'https://fuss10.elemecdn.com/e/5d/4a731a90594a4af544c0c25941171jpeg.jpeg'
            }
        }
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
  }
  
  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
 .font-12{
 	font-size:12px;
 }
 .imgcard{
 	padding-left:12px; padding-right: 12px ;
 	margin-bottom: 1.5rem !important;
 }
</style>
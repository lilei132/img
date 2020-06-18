import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/blog/Imgupload/getList',
    method: 'get',
    params: query
  })
}

export function getOne(ID) {
  return request({
    url: '/blog/Imgupload/getOne',
    method: 'get',
    params: { ID }
  })
}

export function getAll(query = null) {
  return request({
    url: '/blog/Imgupload/getAllPublished',
    method: 'get',
    params: query
  })
}

export function getimgTitleList(query = null) {
  return request({
    url: '/blog/Imgupload/getimgTitleList',
    method: 'get',
    params: query
  })
}

export function changePublish(data) {
  return request({
    url: '/blog/Imgupload/changePublish',
    method: 'post',
    data
  })
}

export function delImg(data) {
  return request({
    url: '/blog/Imgupload/del',
    method: 'post',
    data
  })
}


export function addImg(data) {
  return request({
    url: '/blog/Imgupload/addImg',
    method: 'post',
    data
  })
}
export function updateArticle(data) {
  return request({
    url: '/blog/Imgupload/update',
    method: 'post',
    data
  })
}
export function addimgPraise(data) {
  return request({
    url: 'blog/Imgupload/addimgPraise',
    method: 'post',
    data
  })
}
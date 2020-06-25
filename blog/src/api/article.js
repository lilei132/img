import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/blog/article/getList',
    method: 'get',
    params: query
  })
}

export function getOne(ID) {
  return request({
    url: '/blog/article/getOne',
    method: 'get',
    params: { ID }
  })
}

export function getAll(query = null) {
  return request({
    url: '/blog/article/getAllPublished',
    method: 'get',
    params: query
  })
}

export function getTitleList(query = null) {
  return request({
    url: '/blog/article/getTitleList',
    method: 'get',
    params: query
  })
}

export function changePublish(data) {
  return request({
    url: '/blog/article/changePublish',
    method: 'post',
    data
  })
}

export function delArticle(data) {
  return request({
    url: '/blog/article/del',
    method: 'post',
    data
  })
}

export function addArticle(data) {
  return request({
    url: '/blog/article/add',
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
export function addwatch(data) {
  return request({
    url: '/blog/Follow/addwatch',
    method: 'post',
    data
  })
}
export function getauthor(data) {
  return request({
    url: '/blog/Follow/getauthor',
    method: 'post',
    data
  })
}
export function updateArticle(data) {
  return request({
    url: '/blog/article/update',
    method: 'post',
    data
  })
}
export function addpageview(data) {
  return request({
    url: '/blog/article/addpageview',
    method: 'post',
    data
  })
}

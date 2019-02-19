import request from '@/utils/request'

export function getList(query) {
  return request({
    url: 'blogApi/tags/getList',
    method: 'get',
    params: query
  })
}
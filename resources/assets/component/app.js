layui.use(['context', 'table', 'select'], function () {
  var context = layui.context;

  var layadmin = JSON.parse(context.get('layadmin'));

  var pageConfig = layadmin.page;

  if (pageConfig.layout === 'table') {
    var table = layui.table;
    var tableConfig = layadmin.table;

    table.set({
      parseData: function (res) {
        return {
          code: _.get(res,tableConfig.parseData.code,res.code),
          msg: _.get(res,tableConfig.parseData.msg,res.msg),
          count: _.get(res,tableConfig.parseData.count,res.count),
          data: _.get(res,tableConfig.parseData.data,res.data)
        }
      },
      response: {
        statusName: tableConfig.response.statusName,
        statusCode: tableConfig.response.statusCode,
      },
      defaultToolbar: tableConfig.defaultToolbar,
      page: tableConfig.page,
      skin: tableConfig.skin,
      even: tableConfig.even,
    })
  }
})

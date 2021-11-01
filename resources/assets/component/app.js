layui.use(['context', 'table', 'select', 'toast'], function () {
  var context = layui.context;
  var toast = layui.toast;

  try {
    var layadmin = JSON.parse(context.get('layadmin'));

    var pageConfig = layadmin.page;// 页面配置

    if (pageConfig.layout === 'table') {
      var table = layui.table;
      var tableConfig = layadmin.table;

      table.set({
        parseData: function (res) {
          return {
            code: _.get(res, tableConfig.parseData.code, res.code),
            msg: _.get(res, tableConfig.parseData.msg, res.msg),
            count: _.get(res, tableConfig.parseData.count, res.count),
            data: _.get(res, tableConfig.parseData.data, res.data)
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

      var pageTableConfig = _.get(pageConfig, 'config.table', false)
      if (!pageTableConfig) {
        throw new Error('请检查页面配置中是否有准确设置 table')
      }

      table.render(pageConfig.config.table);
    }
  } catch (exception) {
    toast.error({title: "页面错误", position: 'topRight', message: exception.message})
  }
})

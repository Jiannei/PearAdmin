layui.use(['table', 'select', 'treetable'], function () {
  try {
    let layadmin = layui.sessionData('layadmin');

    layui.select.config(layadmin.config.select);

    var pageConfig = layadmin[layadmin.current.id];// 页面配置

    if (pageConfig === undefined) {
      throw new Error('页面配置参数错误！')
    }

    if (pageConfig.layout === 'table' || pageConfig.layout === 'treetable') {
      var table = layui.table;
      var tableConfig = layadmin.config.table;
      var tableGlobalSet = {
        parseData: eval(tableConfig.parseData),
        response: {
          statusName: tableConfig.response.statusName,
          statusCode: tableConfig.response.statusCode,
        },
        defaultToolbar: tableConfig.defaultToolbar,
        page: tableConfig.page,
        skin: tableConfig.skin,
        even: tableConfig.even,
      }

      const pageTableConfig = pageConfig.components.table.config || false;
      if (!pageTableConfig) {
        throw new Error('表格配置参数错误！')
      }

      layui.each(pageTableConfig.cols[0], function (key, item) {
        if (item.templet !== undefined && layui._typeof(item.templet) === 'string' && item.templet.startsWith('(') && item.templet.endsWith(')')) {
          item.templet = eval(item.templet)
          pageTableConfig.cols[0][key] = item
        }
      })

      table.set(tableGlobalSet);

      if (pageConfig.layout === 'table') {
        table.render(pageTableConfig);
      } else if (pageConfig.layout === 'treetable') {
        pageTableConfig.parseData = tableGlobalSet.parseData;

        layui.treetable.render(pageTableConfig);
      }
    }
  } catch (exception) {
    layui.hint().error(exception.message)
  }
})

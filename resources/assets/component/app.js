layui.use(['table', 'select','treetable'], function () {
  try {
    let layadmin = layui.data('layadmin');

    layui.select.config(layadmin.select);

    var pageConfig = layadmin.page;// 页面配置

    if (pageConfig === undefined) {
      throw new Error('页面配置参数错误！')
    }

    if (pageConfig.layout === 'table' || pageConfig.layout === 'treetable') {
      var table = layui.table;
      var tableConfig = layadmin.table;
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

      var pageTableConfig = pageConfig.components.table.config || false;
      if (!pageTableConfig) {
        throw new Error('表格配置参数错误！')
      }

      table.set(tableGlobalSet);

      if (pageConfig.layout === 'table') {
        table.render(pageTableConfig);
      }else if (pageConfig.layout === 'treetable'){
        pageTableConfig.parseData = tableGlobalSet.parseData;

        layui.treetable.render(pageTableConfig);
      }
    }
  } catch (exception) {
    layui.hint().error(exception.message)
  }
})

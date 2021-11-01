layui.use(['context', 'table', 'select'], function () {
  var table = layui.table;
  var context = layui.context;

  table.set({
    parseData: function (res) {
      return {
        code: res.code,
        msg: res.message,
        count: res.data.meta.pagination.total,
        data: res.data.list
      }
    },
    response: {
      statusName: "code",
      statusCode: 200,
    },
    defaultToolbar: [
      {
        layEvent: 'refresh',
        icon: 'layui-icon-refresh',
      },
      'filter', 'print', 'exports'
    ],
    page: true,
    skin: "line",
    even: true,
  })
})

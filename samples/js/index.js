layui.use(['admin', 'popup'], function () {
  var admin = layui.admin;
  var popup = layui.popup;

  admin.setConfigType("json");
  admin.setConfigPath("/admin/config/admin.config.json");

  admin.render();

  // 登出逻辑
  admin.logout(function () {
    popup.success("注销成功", function () {
      location.href = "login.html";
    })
    // 注销逻辑 返回 true / false
    return true;
  })

  // 初始化消息回调
  admin.message();

  // 实现消息回调 [消息列表点击事件]
  // admin.message(function(id, title, context, form) {});
})

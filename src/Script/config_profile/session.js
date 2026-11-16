var app = {
  register: function () {
    app.config.autoload();
  },
  config: {
    autoload: function () {
      $ummu.func.location_hash();
      app.controllers.getSession();
    },
  },
  controllers: {
    getSession: function () {
      var params = {
        function: "session_get",
        type: "get",
        action: "get",
        data: [],
        cache: true,
        contentType: "application/json",
        dataType: "json",
        loader: false,
      };

      var ali = $ummu.ajax.ummu4(params);
      ali
        .done(function (result) {
          // if (result.status == true) {
          //     app.views.set_siteproject_to_option(result.rows);
          //     console.log(result);
          // }
          // return result;
          // console.log(result)

          var editor = new JsonEditor("#json_session", result);
          // $('#translate').on('click', function () {
          editor.load(sesult);
          // });
        })
        .fail(function () {
          // An error occurred
        });
    },
  },
  views: {
    //
  },
};

$(document).ready(function () {
  app.register.apply();
});

var page = 0;
var all_page = 0;
var data_history = [];
var limit_page = 5;

function call_data_My_PA_Goal() {
  var settings = setting_ajax();
  console.log(page)
  $.ajax(settings).done(function (response) {
    console.log(response);
    data_history = response.data;
    if (data_history.length > 0) {
      all_page = Math.ceil(response.total_records / limit_page);
      page_check();
      render_data(data_history);
    }else{
      null_data_My_PA_Goal();
    }
  });
}

$(document).ready(function () {
    call_data_My_PA_Goal();
});
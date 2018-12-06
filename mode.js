var pc_width = 1080;
var device = (screen.width < 600 ? 'sp' : 'pc');
var view_mode = (device == 'pc' || document.cookie.indexOf('view_mode=pc') != -1 ? 'pc' : 'sp');
if (device == 'sp' && view_mode == 'pc') {
    document.getElementsByName('viewport')[0].setAttribute('content', 'width=' + pc_width + ',initial-scale=1');
}

$(function () {
      if (device == 'sp') {
        if (view_mode == 'pc') {
            $('.sp-mode').on('click', function () {
              var date = new Date();
              date.setTime(0);
              document.cookie = 'view_mode=;expires='+date.toGMTString();
              location.reload(false);
            }).show();
        } else {
          $('.pc-mode').on('click', function () {
            document.cookie = 'view_mode=pc';
            location.reload(false);
          }).show();
        }
      }
  });

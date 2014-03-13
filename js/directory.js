function change(n,i) {
  if (document[n] && eval('typeof ' + i + ' != "undefined"')) {
    document[n].src = eval(i + '.src');
  }
}

function watchVideo(sHtml) {
  var oWin = window.open('', 'videoWindow',
   'width=300,height=300,resizable=yes');
  oWin.document.write('<!DOCTYPE html PUBLIC\
   "-//W3C//DTD XHTML 1.0 Transitional//EN"\
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\
   <html xmlns="http://www.w3.org/1999/xhtml">\
   <head><title>Watch Video</title></head>\
   <body style="margin:0px"><table cellpadding="0" cellspacing="0"><tr><td>' +
   sHtml + '</td></tr></table></body></html>');
  var oDiv = oWin.document.body.getElementsByTagName('table')[0];
  oWin.resizeBy(oDiv.offsetWidth - 300, oDiv.offsetHeight - 300);
}

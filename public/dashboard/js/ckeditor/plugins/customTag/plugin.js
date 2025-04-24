// پلاگین رو تعریف میکنیم
CKEDITOR.plugins.add('customTag', {
  init: function(editor) {
    // اضافه کردن دستور به ادیتور
    editor.addCommand('insertCustomTag', {
      exec: function(editor) {
        // گرفتن متن انتخاب‌شده
        var selectedText = editor.getSelection().getSelectedText();

        if (!selectedText) {
          alert('لطفاً اول یک متن انتخاب کنید!');
          return;
        }

        // گرفتن مقدار data-description
        var descriptionValue = prompt('لطفاً توضیحات (data-description) را وارد کنید:');
        if (descriptionValue === null) return; // اگه کنسل کرد خارج میشه

        if (descriptionValue) {
          // ساخت تگ با کلاس ثابت x-hint و data-description
          var tag = '<span class="x-hint" data-description="' + descriptionValue + '">' + selectedText + '</span>';
          editor.insertHtml(tag);
        }
      }
    });

    // اضافه کردن دکمه به نوار ابزار
    editor.ui.addButton('CustomTag', {
      label: 'درج تگ توضیحات',
      command: 'insertCustomTag',
      toolbar: 'insert',
      icon: 'span' // میتونی آیکن دلخواه بذاری
    });
  }
});

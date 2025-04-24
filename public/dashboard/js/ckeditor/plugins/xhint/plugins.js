CKEDITOR.plugins.add('xhint', {
  icons: 'xhint', // نام آیکنی که باید بسازید
  init: function(editor) {
    // اضافه کردن دستور
    editor.addCommand('xhintCommand', {
      exec: function(editor) {
        // گرفتن متن انتخاب‌شده
        var selection = editor.getSelection();
        var selectedText = selection.getSelectedText();

        if (!selectedText) {
          alert('لطفاً ابتدا متنی را انتخاب کنید!');
          return;
        }

        // ساخت دیالوگ
        editor.openDialog('xhintDialog');
      }
    });

    // اضافه کردن دکمه به نوار ابزار
    editor.ui.addButton('Xhint', {
      label: 'اضافه کردن x-hint',
      command: 'xhintCommand',
      toolbar: 'insert'
    });

    // تعریف دیالوگ
    CKEDITOR.dialog.add('xhintDialog', function(editor) {
      return {
        title: 'اضافه کردن توضیحات',
        minWidth: 400,
        minHeight: 200,
        contents: [
          {
            id: 'tab1',
            label: 'تنظیمات',
            elements: [
              {
                type: 'textarea', // نوع textarea
                id: 'description',
                label: 'توضیحات (data-description)',
                default: '', // مقدار پیش‌فرض اگه نیاز داری
                setup: function(element) {
                  this.setValue(element.getAttribute('data-description') || '');
                },
                commit: function(element) {
                  element.setAttribute('data-description', this.getValue());
                },
                validate: CKEDITOR.dialog.validate.regex(/^.+$/, 'لطفاً توضیحات را وارد کنید!') // اعتبارسنجی ساده
              }
            ]
          }
        ],
        onOk: function() {
          var dialog = this;
          var description = dialog.getValueOf('tab1', 'description');
          var selection = editor.getSelection();
          var selectedText = selection.getSelectedText();

          // ساخت المنت جدید
          var element = new CKEDITOR.dom.element('span');
          element.addClass('x-hint');
          element.setAttribute('data-description', description);
          element.setText(selectedText);

          // جایگزین کردن متن انتخاب‌شده با المنت جدید
          var range = selection.getRanges()[0];
          range.deleteContents();
          range.insertNode(element);
        }
      };
    });
  }
});

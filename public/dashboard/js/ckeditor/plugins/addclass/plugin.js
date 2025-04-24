CKEDITOR.plugins.add('addclass', {
  init: function(editor) {
    // تعریف دستور برای اضافه کردن کلاس
    editor.addCommand('addClassCommand', {
      exec: function(editor) {
        // گرفتن تگ انتخاب‌شده
        var selection = editor.getSelection();
        var element = selection.getStartElement();

        if (!selection) {
          alert('لطفاً اول یک متن انتخاب کنید!');
          return;
        }


        if (element) {
          // گرفتن اسم کلاس از کاربر
          var className = prompt('اسم کلاس رو وارد کنید (مثلاً my-class):');
          if (className) {
            // اضافه کردن کلاس به تگ
            element.addClass(className);
            editor.fire('change'); // به‌روزرسانی ویرایشگر
          }
        } else {
          alert('لطفاً یه تگ یا متن رو انتخاب کنید!');
        }
      }
    });

    // اضافه کردن دکمه به نوار ابزار
    editor.ui.addButton('AddClass', {
      label: 'اضافه کردن کلاس', // توضیح دکمه
      command: 'addClassCommand', // دستور مرتبط
      toolbar: 'insert', // محل قرارگیری توی نوار ابزار
      icon: this.path + 'icons/addclass.png' // مسیر آیکون (اختیاری)
    });
  }
});

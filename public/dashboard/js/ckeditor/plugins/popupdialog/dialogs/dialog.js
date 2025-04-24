CKEDITOR.dialog.add('dialog', function (editor) {
  return {
    title: 'توضیحات درباره متن انتخاب شده',
    minWidth: 400,
    minHeight: 200,

    onOk: function () {
      var dialog = this;
      var description = dialog.getValueOf('main-tab', 'description');
      var selectedText = editor.getSelection().getSelectedText();

      var element = new CKEDITOR.dom.element('span');

      element.addClass("popup-dialog");
      var time = Date.now();
      element.setAttribute("id", "myDialog_" + time);
      element.setStyle("border", "1px dashed #44f");
      element.data("description", description);
      element.appendHtml(selectedText);

      element.setAttribute("onclick", function () {
        alert(this.data("description"))
        //todo
        //show this
      });
      editor.insertElement(element);

    },

    contents: [
      {
        id: 'main-tab',
        elements: [
          {
            type: 'textarea',
            id: 'description',
            label: 'توضیحات',
            validate: CKEDITOR.dialog.validate.notEmpty("توضیحات نباید خالی باشد")
          },
        ]
      },
    ]
  };
});
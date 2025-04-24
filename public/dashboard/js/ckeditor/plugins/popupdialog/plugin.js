CKEDITOR.plugins.add("popupdialog", {
  icons: "popup",
  init: function (editor) {

    editor.ui.addButton("popup", {
      label: "افزودن دیالگ",
      command: "addDialog",
      toolbar: "insert"
    });

    CKEDITOR.dialog.add('dialog', this.path + 'dialogs/dialog.js');
    // CKEDITOR.dialog.add('dialog', this.path + 'dialogs/dialog.js');

    editor.addCommand("addDialog", {
      exec: function (editor) {
        editor.openDialog('dialog');
      }
    });


  }
});

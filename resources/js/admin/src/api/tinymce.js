export default {
  height: 400,
  language: 'ru',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable charmap quickbars emoticons',
  menubar: 'file edit view insert format tools table',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  file_picker_callback: function(callback, value, meta) {
    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

    var cmsURL = '/laravel-filemanager?editor=' + meta.fieldname
    if (meta.filetype === 'image') {
      cmsURL = cmsURL + '&type=Images'
    } else {
      cmsURL = cmsURL + '&type=Files'
    }

    // eslint-disable-next-line no-undef
    tinyMCE.activeEditor.windowManager.openUrl({
      url: cmsURL,
      title: 'Filemanager',
      width: x * 0.8,
      height: y * 0.8,
      resizable: 'yes',
      close_previous: 'no',
      onMessage: (api, message) => {
        callback(message.content)
      }
    })
  }
}

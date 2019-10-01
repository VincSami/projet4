tinymce.init({
  selector:'#title',
  height: 200,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks fullscreen',
    'insertdatetime media table paste help wordcount'
  ],
  toolbar: 'undo redo | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ]
});

tinymce.init({
  selector:'#content',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks fullscreen',
    'insertdatetime media table paste help wordcount'
  ],
  toolbar: 'undo redo | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ]
});
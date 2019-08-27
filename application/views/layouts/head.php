<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title ?></title>
  
  <!-- Boostrap Select -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">

  <!-- TinyMCE -->
  <script src="<?php echo base_url() ?>assets/vendor/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: '.editor',
      height: 230,
      menubar: true,
      plugins: [
        'autolink lists link preview anchor',
        'searchreplace visualblocks fullscreen',
        'insertdatetime table contextmenu',
        'wordcount'
      ],
      toolbar: 'undo redo | insert | styleselect | bold italic formatpainter permanentpen pageembed | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | advcode spellchecker a11ycheck | code | checklist',
      toolbar_drawer: 'sliding',
      permanentpen_properties: {
        fontname: 'arial,helvetica,sans-serif',
        forecolor: '#FF0000',
        fontsize: '18pt',
        hilitecolor: '',
        bold: true,
        italic: false,
        strikethrough: false,
        underline: false
      },
      table_toolbar: "tableprops cellprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
      powerpaste_allow_local_images: true,
      powerpaste_word_import: 'prompt',
      powerpaste_html_import: 'prompt',
      spellchecker_language: 'en',
      spellchecker_dialog: true,
    });
  </script>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>


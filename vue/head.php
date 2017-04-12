

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Forteroche</title>
    <meta name="forteroche" content="Blog Roman Episodique">
    <link href="<?php echo(HOST.'blog/assets/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo(HOST.'blog/assets/css/style.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arimo|Playfair+Display+SC" rel="stylesheet">
    <link rel="stylesheet" href="//localhost/blog/assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="//localhost/blog/assets/js/jquery-ui/jquery-ui.theme.css">
    <link rel="stylesheet" href="//localhost/blog/assets/js/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="//localhost/blog/assets/js/jquery-ui/jquery-ui.structure">
    <script type="text/javascript" src="<?php echo(HOST.'blog/assets/js/tests/vendor/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo(HOST.'blog/assets/js/bootstrap.js');?>"></script>
    <script type="text/javascript" src="<?php echo(HOST.'blog/assets/js/blog.js');?>"></script>
    <script type="text/javascript" src="<?php echo(HOST.'blog/assets/js/customE.js');?>"></script>
    <script type="text/javascript" src="<?php echo(HOST.'blog/assets/js/jquery-ui/jquery-ui.js');?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fps3y9l4erw7zgwdffjno3ppzxkfzl8rxb9u4kndv95djvwx"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#chapter_body,#chapter_modify',
            theme: 'modern',
            height: 600,
            plugins: [
                'advlist link spellchecker',
                'searchreplace wordcount visualchars fullscreen insertdatetime nonbreaking',
                'save contextmenu directionality emoticons paste'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview  fullpage | forecolor  emoticons'
        });
    </script>
</head>

<body>

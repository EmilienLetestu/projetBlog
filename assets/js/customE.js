

$(document).ready(function () {

/**----------------------------------------date picker---------------------------------------------**/
    // date picker settings
    $('.publish_on').datepicker({

        dateFormat : 'dd/mm/yy',
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        minDate : 1,
        nextText:"Après",
        prevText:"Avant",
        maxDate : '31/12/2030'
    });

/**----------------------------------------login form ---------------------------------------------**/

    // set variables use in function below
    var error = $('#pswd_error').val();
    var posted_email = $('#posted_email').val();
    var fill_up = $('#fill_up').val();

    // if a php variable is detected in an hidden type input this function will display error message
    //if fill_up variable is detected this function will fill email input with newly registered member
    $(window).load(function() {

        if (error == 1)
        {

            $('#pswd').css("border-color", "#FF0000");
            $('#pswd_error_message').show();
            $('#email').val(posted_email).css("border-color", "#0dbe3d");

        }
        else
        {
            $('#pswd_error_message').hide();
        }

        if (error == 2)
        {
            $('#email_error_message').show().css("color", "#FF0000");
            $('#email').val(posted_email).css("border-color", "#FF0000");
        }
        else
        {
            $('#email_error_message').hide();
        }
        if(fill_up !== null)
        {
            $('#email').val(fill_up).css("boder-color","#0dbe3d" );
        }
    });

    //prevent data to be submitted if an input does'nt match the prerequisites
    $("#apply_login").click(function() {

        var validate = true;
        var password = $('#pswd').val();
        var email    = $('#email').val();

        if(password.length < 4 || password == " ")
        {
            $('#pswd_informations').show().css("color", "#FF0000");
            $('#pswd').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $('#pswd_error_message').hide();
        }
        if(email == "")
        {
            $('#empty_email').show().css("color", "#FF0000");
            $('#email').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $('#pswd_error_message').hide();
        }
        return validate;
    });
/**----------------------------------------register form ---------------------------------------------**/

    $(window).load(function() {

        var name             = $('#posted_register_name').val();
        var surname          = $('#posted_register_surname').val();
        var email            = $('#posted_register_email').val();
        var register_error   = $('#register_error').val();

        if(register_error == 1)
        {
            $('#email').val(email).css("border-color", "#FF0000");
            $("#empty_register_email").text('Cette adresse email est déjà utilisé').show().css("color", "#FF0000");
            $('#name').val(name).css("border-color", "#0dbe3d");
            $('#surname').val(surname).css("border-color", "#0dbe3d");
        }
        else
        {
            $("#empty_register_email").hide();
        }
    });


    $("#apply_register").click(function(){

        var validate  = true;
        var password  = $('#pswd').val();
        var password2 = $('#confirm_pswd').val();
        var email     = $('#email').val();
        var name      = $('#name').val();
        var surname   = $('#surname').val();


        if(surname == "")
        {
            $("#empty_surname").show().css("color", "#FF0000");
            $('#surname').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $("#empty_surname").hide();
            $('#surname').css("border-color", "#0dbe3d");
        }
        if(name == "")
        {
            $("#empty_name").show().css("color", "#FF0000");
            $('#name').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $("#empty_name").hide();
            $('#name').css("border-color", "#0dbe3d");
        }
        if(email == "")
        {
            $("#empty_register_email").show().css("color", "#FF0000");
            $('#email').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $("#empty_register_email").hide();
            $('#email').css("border-color", "#0dbe3d");
        }
        if(password.length < 4 || password == "")
        {
            $("#weak_pswd").show().css("color", "#FF0000");
            $('#pswd').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $("#weak_pswd").hide();
            $('#pswd').css("border-color", "#0dbe3d");

        }
        if(password2 !== password || password2 == "")
        {
            $('#pswd_matches').show().css("color", "#FF0000");
            $('#confirm_pswd').css("border-color", "#FF0000");
            validate = false;
        }
        else
        {
            $('#pswd_matches').hide();
            $('#confirm_pswd').css("border-color", "#0dbe3d");

        }

       return validate;

    });

/**-----------------------------------------create new novel(admin)----------------------------------------------**/
    //makes a text input appear
    $('#novel_form').hide();

    $('#new_novel').click(function() {
        $('#novel_form').show();
        $('#new_novel').hide();
    });

    //check data before submit
    $('#create_novel').click(function(){
        var validate = true;

        if($("#novel_title").val() == "")
        {
            $('#novel_title').css("border-color","#FF0000");
            $('#novel_title_error').show().css("color", "#FF0000");
              validate = false;
        }
        else
         {
            $('#novel_form').hide();
             $('#novel_title_error').hide();
            $('#new_novel').show();
         }
        return validate;
    });

/**-----------------------------------------create/modify chapter(admin)-----------------------------------------**/

    //display error message
    $('.publish_on').focus(function ()
    {
        $('#date_error').show().hide();

    });

/**---------------------------------------------chapter comments-------------------------------------------------**/

    //if user click answer button on any comments,
    // the comment text area will be moved from its former place to appear under the comment to answer
    $('.send_answer').click(function (e) {
       e.preventDefault();
       var id = $(this).attr('id');
       var form = $('#edit_comment');
       var parent =  $('#comments-'+id);
       parent.after(form);
       $('#parent_id').val(id);


    });

    //prevent a comment to be empty
    $('#submit_cmt').click(function () {

        var validate = true;
        var cmt_area = $('#cmt_body').val();
        var parent_id = $('#parent_id').val();
        if(cmt_area == "")
        {
            $('#empty_cmt').show().css("color","#FF0000");
            validate = false;
        }
        else
        {

            $('#empty_cmt').hide();
        }

        return validate;
    });

/**---------------------------------------------validate data submitted data-------------------------------------------------**/

    //create new chapter

    $('#save_chapter').click(function(){

        var validate = true;
        var body =$('#chapter_body').val();

        if($('#chapter_title').val() == "" )
        {
            $('#chapter_title').css("border-color","#FF0000");
            $('#title_error').show().css("color", "#FF0000");
            validate = false;
        }
        else
        {
            $('#chapter_title').css("border-color","#0dbe3d");
            $('#title_error').hide();
        }


        if($('input:radio[name = publish]:checked').val() == 'laterOn' && $('.publish_on').val() == "" )
        {

            $('.publish_on').css("border-color", "#FF0000");
            $('#date_error').show().css("color", "#FF0000");
            validate = false;
        }
        else
        {
            $('.publish_on').css("border-color", "#0dbe3d");
            $('#date_error').hide();
        }

        return validate;
    });

     //update chapter
    $('#update_chapter').click(function(){

        var validate = true;


        if($('#chapter_title').val() == "" )
        {
            $('#chapter_title').css("border-color","#FF0000");
            $('#title_error').show().css("color", "#FF0000");
            validate = false;
        }
        else
        {
            $('#chapter_title').css("border-color","#0dbe3d");
            $('#title_error').show().hide();
        }

        if($('input:radio[name = publish]:checked').val() == 'laterOn' && $('.publish_on').val() == "" )
        {

            $('.publish_on').css("border-color", "#FF0000");
            $('#date_error').show().css("color", "#FF0000");
            validate = false;
        }

        else
        {
            $('.publish_on').css("border-color", "#0dbe3d");
            $('#date_error').show().hide();
        }

        return validate;
    });

/**--------------------------------------------- submit select option on change--------------------------------------**/

    $('#sel').change(function(){
        this.form.submit();
    });


});



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title ?? "STUDENT INDUSTRIAL TRAINING REGISTRATION FORM (IT-UI-011)"; ?></title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>

  <style>
    .form-required{
        color:red;
    }

    #main-content{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
    }

    label{
        display:block;
        margin-bottom:2px;
        font-weight:600;
    }

    .form-control:focus{
        box-shadow:none !important;
    }

    #form-2-3 > div{
        margin-bottom:50px;
    }

    #content-header{
        margin-top:20px;
        padding-bottom:40px;
        font-weight:700 !important;
        position:relative;
    }

    #department-block{
        display:none;
    }

    .dropdown-content li>span{
        color:#574b4b !important
    }

    [type='file']{
        display:none;
    }

    .upload-container img{
        height:100px !important;
        width:100px !important;
        cursor:pointer;
        object-fit:cover;
    }

    .upload-container{
        display:flex;
        justify-content:space-around;
        width:100%;
        height:120px;
        font-size:110%;
    }

    #submit-block{
        display:flex;
        justify-content:center;
        margin-top:30px;
    }

    #ui-below{
        text-align:center;
        font-size:110%;
    }

    #ui-logo{
        display:flex;
        justify-content:center;
        margin-top:20px;
    }

    #indus{
        text-align:center;
        font-weight:700;
        font-size:130%;
    }

    #student-indus{
        font-weight:700 !important;
        font-size:100%;
    }

    #indus-content{
        margin-top:40px;
        font-size:100%;
        display:grid;
        grid-template-columns:1fr 1fr 1fr;
        grid-gap:50px 0;
    }

    #indus-content>div>div{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        text-align:center;
    }

    body{
        text-transform:uppercase;
        overflow-x:hidden;
    }


    .text-bold{
        font-weight:700;
        margin-right:10px;
    }

    #preview-content{
        width:1005 !important;
    }

    #indus-footer{
        margin-top:80px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        font-size:100%;
    }

    #indus-footer img{
        width:80px;
    }

    #email-value{
        text-transform:lowercase;
    }

    #passport-block{
        position:absolute;
        right:0;
        bottom:0;
        transition:0.3s all linear;
    }

    #passport{
        width:120px;
        height:150px;
    }


    #print-block{
        display:flex;
        justify-content:center;
        padding-top:70px;
        padding-bottom:50px;
    }


    #print{
        position:fixed;
        left:50px;
        top:70px;
    }

    @media print{
        #print{
            display:none;
        }
        
    }
</style>
</head>

<body>
  <!-- <div class="background"> </div> -->


    <?php echo $content ?>
        

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>

  
  <script>

    $('#passport-block').css({
        right:0
    })


    if($('#if-yes-where').html().trim().length===0){
        $('#if-yes-where').parents('#if-yes-where-block').remove()
    }


    $('#print').click(function(){
        window.print()
    })

</script>


</body>

</html>
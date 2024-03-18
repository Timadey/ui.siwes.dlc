<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title ?? "ITCC - DLC"; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="/siwes/dlc/assets/styles/profile.css">
</head>

<body>
  <div class="background"> </div>


    <?php echo $content ?>
        

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/siwes/dlc/assets/js/create.js"></script>
  <script src="/siwes/dlc/assets/js/profile/create-profile.js" type="module"></script>

</body>

</html>
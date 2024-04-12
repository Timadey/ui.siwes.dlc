<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title ?? "ITCC - DLC"; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.css" />
  <!-- <link rel="stylesheet" href="/siwes/dlc/assets/styles/profile.css"> -->
  <link rel="stylesheet" href="/siwes/dlc/assets/styles/my-datatable.css">

</head>

<body>
  <div class="background"> </div>


    <?php echo $content ?>
        

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://code.jquery.com/jquery-migrate-3.3.0.js" ></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" ></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.js" ></script>
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js" ></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js" ></script>
  <script src="/siwes/dlc/assets/js/dataTables.altEditor.free.js" ></script>
  <?php if (isset($_SESSION['user_id'])) { ?>
  <script src="/siwes/dlc/assets/js/company/company.backdoor.js" ></script>

  <?php } else {?>
  <script src="/siwes/dlc/assets/js/company/company.client.js" ></script>

  <?php }?>
  <script src="/siwes/dlc/assets/js/company/company.js"></script>

  
</body>

</html>
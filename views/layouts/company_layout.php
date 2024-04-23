<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title ?? "ITCC - DLC"; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" /> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.css" /> -->
  <!-- <link rel="stylesheet" href="/siwes/dlc/assets/styles/profile.css"> -->

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- DataTables Search Panes CSS -->
    <link href="https://cdn.datatables.net/searchpanes/2.2.9/css/searchPanes.bootstrap5.min.css" rel="stylesheet">


  <link rel="stylesheet" href="/siwes/dlc/assets/styles/my-datatable.css">

</head>

<body>
  <div class="background"> </div>


    <?php echo $content ?>
        

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- <script src="https://code.jquery.com/jquery-migrate-3.3.0.js" ></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" ></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js" ></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js" ></script>  -->

   <!-- Bootstrap Bundle JS (required for Bootstrap 5) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <!-- DataTables Search Panes JS -->
    <script src="https://cdn.datatables.net/searchpanes/2.2.9/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.2.9/js/searchPanes.bootstrap5.min.js"></script>
    
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
  <!-- <script src="/siwes/dlc/assets/js/dataTables.altEditor.free.js" ></script> -->

    
  <?php if (isset($_SESSION['user_id'])) { ?>
  <script src="/siwes/dlc/assets/js/company/company.backdoor.js" type="module"></script>

  <?php } else {?>
  <script src="/siwes/dlc/assets/js/company/company.client.js" ></script>

  <?php }?>
  <script src="/siwes/dlc/assets/js/company/company.js" type="module"></script>

  
</body>

</html>
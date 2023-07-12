<!DOCTYPE html>
<html>
<head>
    <title>Print Section</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" media='screen,print'>
    <script src="{{url('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <style>
      /* @media print{
        *{
          text-shadow:none !important;color:#000 !important;background:transparent !important;box-shadow:none !important;
      }} */
    </style>
</head>
<body>
  <div class="card bg-primary card-outlined ccc" style="cursor: pointer;width:255px;position:fixed;top:10%;left:50%;transform:translate(-50%,-50%);">
    {!!$d!!}
  </div>
</body>
<script>
// window.onfocus = function () { window.close(); }
$(document).ready(function () {
  window.print()
})
</script>
</html>

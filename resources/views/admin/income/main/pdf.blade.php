<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center fs-4">PUMA</h1>
    <h3 class="text-center fs-6">Dhobaura.Mymensingh</h3>
  <table class="table table-bordered table-striped">
  <thead>
        <tr class="table-dark">
            <th>Date</th>
            <th>Title</th>
            <th>Category</th>
            <th>Amount</th>          
        </tr>
    </thead>
    <tbody>
        @foreach($all as $data)
            <tr>
              <td>{{date ('d-m-Y',strtotime($data->income_date))}}</td>
              <td>{{$data->income_title}}</td>
              <td>{{$data->incate_name}}</td>
              <td>{{number_format($data->income_amount,2)}}</td>
            </tr>
        @endforeach
  </tbody>
  </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
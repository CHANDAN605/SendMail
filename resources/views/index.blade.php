<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    
    </head>
    


    <body class="antialiased">
        <div class="card mx-5 my-5" style="padding:3px;">
        <table id="datatable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key=> $user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>{{$user['age']}}</td>
                    <td>{{$user['gender']}}</td>
                    <td>{{$user['address']}}</td>
                    @if($user['email_status'] == '1')
                    <td><button class="btn btn-primary" disabled style="padding: 7px! important;" >Send Mail</button></td>
                    <td><i class="fa fa-envelope" style="color: greenyellow;font-size: 24px;    margin: 18px;" aria-hidden="true"></i></td>
                    @else
                    <td>
                        <button class="btn btn-primary" style="padding: 7px !important;" onclick="sendDataToAPI({{ $user['id'] }})">Send Mail</button>
                    </td>

                        <td><i class="fa fa-paper-plane" style="color: #8f8f1f;font-size: 22px;    margin: 18px;" aria-hidden="true"></i></td>
                    @endif
                </tr>
            @endforeach
           
            </tbody>
        </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
        function sendDataToAPI(id) {
            console.log(id);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://127.0.0.1:8000/api/sendEmail', true); // Replace with your actual API endpoint URL
            xhr.setRequestHeader('Content-Type', 'application/json');
            const requestData = {
                id: id,
            };
            const jsonData = JSON.stringify(requestData);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if(response.status == '200'){
                        window.location.reload();
                    }
                } else {
                    console.error('Request failed:', xhr.status, xhr.statusText);
                }
            };

            // Handle network errors
            xhr.onerror = function () {
                console.error('Network error occurred');
            };

            // Send the XHR request with the JSON data
            xhr.send(jsonData);
        }

        </script>
    </body>
</html>


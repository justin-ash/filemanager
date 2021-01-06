<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h2>Files</h2>
            <div style="float: right; margin-bottom: 5px ">
                <a class="btn btn-primary" href="/file-manager">File Manager</a>
                <a class="btn btn-success" href="/history?type=1">Uploaded</a>
                <a class="btn btn-danger" href="/history?type=2">Deleted</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                    <table class="table table-striped table-hover table-fw-widget" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>File Type</th>
                                <th>File Size</th>
                                <th>Created At</th>
                                <th>Action</th>s
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $key => $item)
                            <tr class="gradeX">
                                <td>{{$key+1}}</td>
                                <td>{{$item->file_name}}</td>
                                <td>{{$item->file_type}}</td>
                                <td>{{$item->file_size}}</td>
                                <td class="center">{{date('Y-m-d', strtotime($item->created_at))}}</td>
                                <td class="center"><a href="history/delete?file={{$item->file_path}}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$history->links()}}
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

    </body>
</html>

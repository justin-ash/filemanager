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
                <a class="btn btn-primary" href="/history?type=1">History</a>
            </div>
        </div>
        <div class="row">
            <form method="POST" action="file-manager" enctype="multipart/form-data">
                <div class="col-md-2"></div>
                <div class="col-md-6">

                    @csrf
                    <div class="form-control">
                        <input type="file" name="file">
                         @if($errors->has('file'))
                            <div class="error btn-danger" style="margin: 6px;">{{ $errors->first('file') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-2"><input type="submit" name="submit" class="btn btn-primary" value="Submit"></div>
            </form>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $key => $item)
                                <tr class="gradeX">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item}}</td>
                                    <td class="center"><a href="file-manager/delete?file={{$item}}">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$files->links()}}
                    </div>
                </div>

            </div>
            <div class="col-md-2"></div>
        </div>

    </body>
</html>

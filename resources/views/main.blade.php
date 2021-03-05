<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="p-5" style="display: flex;flex-direction:column;width: 100%;height: 100%;">
        <div class="pt-2 pb-2 pr-4 pl-4" style="background-color: steelblue;">
            <span class="navbar-brand text-white">{{ Session::get('name') }}</span>
            <a href="/logout" class="btn btn-light float-right ">Logout</a>
        </div>

        @if(Session::get('role') == "user")
                <!--User -->
                <div style="flex-grow: 1;display: flex;flex-direction:row wrap;">
                    
                    
                    <div class="bg-light p-4" style="flex-grow: 1;display: flex;flex-direction: column;justify-content: center;">
                        @if (Session::get('status') == "1" )
                            <div class="alert alert-warning" role="alert">
                                Your Conversation Has Been Overed
                            </div>
                        @else
                            <h2 class="text-center mb-2">Feedback</h2>

                            @if(Session::has('datasaved'))
                                <div class="alert alert-success" role="alert">{{ Session::get('datasaved') }}</div>
                            @endif
                            @if(Session::has('datafailed'))
                                <div class="alert alert-danger" role="alert">{{ Session::get('datafailed') }}</div>
                            @endif
                            <form action="/addfeedback" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control mt-2" type="text" placeholder="subject" name="subject">                                
                                    @if ($errors->has('subject'))
                                       <small class="text-danger">{{$errors->first('subject')}}</small> 
                                    @endif
                                <textarea class="form-control mt-2" id="exampleFormControlTextarea1" placeholder="Description" rows="3" name="description"></textarea>
                                    @if ($errors->has('description'))
                                        <small class="text-danger">{{$errors->first('description')}}</small> 
                                    @endif
                                <div class="form-group mt-2">
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="img">
                                </div>
                                    @if ($errors->has('img'))
                                        <small class="text-danger">{{$errors->first('img')}}</small> 
                                    @endif
                                <input type="submit" class="btn btn-block btn-light text-white mt-2" style="background-color: steelblue;" value="Submit">
                            </form>
                        @endif
                    </div>

                    <div class="bg-white p-4" style="flex-grow: 6;overflow-y:auto;max-height:85vh;">
                        @if ($data == null || !$data || $data->count() < 1)
                            <h1>No Data Found</h1>
                        @else
                        @foreach ($data as $d)
                            <div class="card mb-4">
                                <div class="card-body">
                                <h4 class="card-title">{{ $d->subject }}</h4>
                                <hr>
                                {{ $d->description }}
                                <br>
                                <a href="{{ asset('images/' . $d->img) }}" class="card-link" target="blank">Attached file</a>
                                <br>
                                @if ($d->reply == null)
                                    <br>
                                <small class="text-muted mt-5"> - No Reply Yet</small> 
                                @else
                                <div class="card mt-2 bg-light">
                                    <div class="card-body">
                                    <h4 class="card-title">Admin Replies:</h4>
                                        {{ $d->reply }}
                                    </div>
                                </div>                            
                                @endif


                                </div>
                            </div>
                        @endforeach
                        @endif

                    </div>


                </div>
        @else

        <!--Admin -->
        <div class="bg-white p-2" style="flex-grow: 1;display: flex;flex-flow:row wrap;align-items: flex-start;overflow-y:auto;max-height:85vh;">

            @if ($data->count() < 1)
            <h1>No Data Found</h1>
        @else


        @foreach ($data as $d)
        <div class="card m-2" style="flex-basis: 450px;flex-grow: 1;max-width: 600px;">
            <div class="card-body">
            <h4 class="card-title" style="display: flex;flex-flow: row wrap;justify-content: space-between">{{ $d->subject }}
                @foreach ($userdata as $us)
                    @if ($us->id == $d->user_id)
                        @if ($us->status == "0")
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-light" disabled>{{ $us->email }}</button>
                                <a href="/block/{{ $us->id }}" class="btn btn-sm btn-outline-success" title="Click To Close">Open</a>
                            </div>
                            @break
                        @else
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-light" disabled>{{ $us->email }}</button>
                                <a href="/unblock/{{ $us->id }}" class="btn btn-sm btn-outline-secondary" title="Click To Open">Closed</a>
                            </div>
                            @break
                        @endif
                    @endif
            
                @endforeach
            </h4>
            
            <hr>
                {{ $d->description }}
                <br>
                <a href="{{ asset('images/' . $d->img) }}" class="card-link" target="blank">Attached file</a>
                <br>
                @if ($d->reply == null)
                    <div class="card mt-2 bg-light mt-4">
                        <div class="card-body">
                            <form action="/reply/{{ $d->id }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="reply here" aria-label="Recipient's username" aria-describedby="basic-addon2" name="reply">
                                    <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Reply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                <div class="card mt-2 bg-light">
                    <div class="card-body">
                    <h4 class="card-title">Admin Replies:</h4>
                        {{ $d->reply }}
                    </div>
                </div>
                @endif

            </div>
        </div>
        @endforeach
        @endif


        </div>
@endif

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
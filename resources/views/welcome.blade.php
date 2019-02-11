<html>
    <head></head>
    <body>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
        <form name="uploadPhotos" enctype="multipart/form-data" action="/upload" method="post">
            {{ csrf_field() }}
        <table>
        @foreach($content as $item)
            <tr>
                <td>
                    {{$item->id}}
                </td>
                <td>
                    {{$item->descr}}
                </td>
                <td>
                    @if(isset($photos[$item->id]))
                        DONE
                    @else
                        <input type="file" name="photos[{{$item->id}}]" />
                    @endif
                </td>
                <td>
                    @if(isset($photos[$item->id]))
                        <img src="{{asset('storage/'.$photos[$item->id])}}" height="85px" />

                    @endif
                </td>
            </tr>
        @endforeach
            <tr>
                <td colspan="3" id="upload">
                    <input type="submit" value="Upload File" />
                </td>
                <td></td>
            </tr>
        </table>
        </form>
    </body>
</html>
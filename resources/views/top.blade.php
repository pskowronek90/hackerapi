@foreach($topStories as $story)
    <img src="{{ (new App\Http\Controllers\DashboardController)->getThumbnail($story->Url) }}" style="width: 50px; height: 50px">
    <a href="{{$story->Url}}">{{$story->Title}}</a><br>
@endforeach

{{$topStories->links()}}
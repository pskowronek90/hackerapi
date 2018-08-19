@foreach($topStories as $story)
    <a href="{{$story->Url}}">{{$story->Title}}</a><br>
@endforeach

{{$topStories->links()}}
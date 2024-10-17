<?php $tags = explode(',', $listing->tags); ?>
<ul class="flex">
@foreach($tags as $tag)
    <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
        <a href="/?tag=<?php echo strtolower($tag); ?>">{{$tag}}</a>
    </li>
@endforeach
</ul>
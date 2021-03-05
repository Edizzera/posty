@props(['post'=> $post])

<div class="mb-4">                        
    <a href="{{ route('users.posts', $post->user)}}" class="font-bold">{{ $post->user->username }}</a> <span class="text-gray-600
    text-sm">{{ $post->created_at->diffForHumans() }}</span>
    
    <p class="mb-2">{{ $post->body }}</p> 
    
    @can('delete', $post)                            
    <form action="{{ route('posts.destroy',$post)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-green-500"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </form>
    @endcan
        
    

    <div class="flex items-center">
        @auth
        @if (!$post->likedBy(auth()->user()))
            <form action="{{route('posts.likes', $post)}}" method="post" class="mr-1">
                @csrf
                <button type="submit" class="text-green-500"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
            </form>
        @else
            <form action="{{route('posts.likes', $post)}}" method="post" class="mt-1 ">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-green-500"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
            </form>
        @endif
        @endauth
        <span class="ml-2">{{ $post->likes->count() }} {{ Str::plural('like',
        $post->likes->count()) }}</span>
    </div>

</div>                   